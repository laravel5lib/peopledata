<?php

namespace App;

use App\PCO\Field;
use Illuminate\Support\Facades\Log;
use MediaUploader;
use Carbon\Carbon;
use App\PCO\Course;
use GuzzleHttp\Client;
use Plank\Mediable\Mediable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 */
class Member extends Model
{
    use Mediable, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'avatar', 'first_name', 'last_name', 'nickname', 'birthdate', 'child', 'gender', 'name', 'remote_id', 'status', 'created_at', 'updated_at'];


    public function user()
    {
        return $this->hasOne(User::class);
    }
    /**
     * Updates member info from remote
     * @return mixed
     */
    public function updateFromPeople()
    {
        $client = new Client();
        $res    = $client->get('https://api.planningcenteronline.com/people/v2/people/' . $this->id . '?include=emails,phone_numbers,marital_status,field_data', ['auth' => [config('services.people.id'), config('services.people.secret')]]);
        if ($res->getStatusCode() == 200) {
            $response = json_decode($res->getBody(), true);
            return $this->updateWithJson($response);
        }
        return $this;
    }
    
    public function updateWithJson($response)
    {
//        dd(array_keys($response['included']));
        if (isset($response['data'])) {
            $data = $response['data'];
            if (isset($data['attributes'])) {
                $attributes               = $data['attributes'];
                $attributes['created_at'] = Carbon::parse($attributes['created_at']);
                $attributes['updated_at'] = Carbon::parse($attributes['updated_at']);
                $this->update($attributes);
                if ($attributes['avatar']) {
                    foreach ($this->getMedia('avatar') as $media) {
                        $media->delete();
                    }
                    $media = MediaUploader::fromSource($attributes['avatar'])->toDisk('public')->toDirectory('members/' . $this->id)->upload();
                    $this->syncMedia($media, 'avatar');
                }
            }
            if (isset($data['relationships'])) {
                $relationships = $data['relationships'];
                if (isset($relationships['marital_status'])) {
                    if (!$relationships['marital_status']['data']) {
                        $this->marital_status_id = null;
                        $this->save();
                    } elseif (isset($relationships['marital_status']['data']['id'])) {
                        $this->marital_status_id = $relationships['marital_status']['data']['id'];
                        $this->save();
                    }
                }
            }
        }
        if (isset($response['included'])) {
            foreach ($response['included'] as $included) {
                if (($included['type'] == 'Email') && isset($included['attributes']) && isset($included['attributes']['address'])) {
                    $this->email = $included['attributes']['address'];
                    $this->save();
                } elseif (($included['type'] == 'PhoneNumber') && isset($included['attributes']) && isset($included['attributes']['number'])) {
                    $this->phone = $included['attributes']['number'];
                    $this->save();
                } elseif (($included['type'] == 'MaritalStatus')) {
                    // processed above
                } elseif (($included['type'] == 'FieldDatum')) {
                    if ($field = Field::find(data_get($included, 'relationships.field_definition.data.id'))) {
                        $value = data_get($included, 'attributes.value');
//                        $fields                  = $this->fields()->where('field_id', $field->id)->get()->pluck('pivot.value', 'pivot.id');
                        $this->fields()->syncWithoutDetaching([$field->id => ['id' => $included['id'], 'value' => $value]]);
//                        if($field->id==178703) dd($fields);
//                        $fields[$included['id']] = $value;
//                        $this->fields()->detach($field->id);
//                        foreach ($fields as $key => $val) {
//                            $this->fields()->attach($field->id, ['id' => $key, 'value' => $val]);
//                            $this->fields()->syncWithoutDetaching([$field->id => ['id' => $key, 'value' => $val]]);
//                        }
//                        $this->fields()->syncWithoutDetaching([$field->id => ['id' => $included['id'], 'value' => $value]]);
                    } else {
//                        dd($included);
                        Log::error('Field Not found: ' . data_get($included, 'relationships.field_definition.data.id') );    
                    }
                } else {
                    
                }
            }
        }
        return $this;
    }

    /**
     * Related fields
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fields()
    {
        return $this->belongsToMany(Field::class)->withPivot(['id', 'value'])->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class)->withPivot(['status', 'payment', 'notes'])->withTimestamps();
    }

    public function professorCourses()
    {
        return $this->hasMany(Course::class,'professor_id');
    }

    /**
     * Generates image url
     * @return mixed|string
     */
    public function getImageAttribute()
    {
        if (($media = $this->firstMedia('avatar')) && $media->aggregate_type == 'image') {
            $image = '/img/public/' . $media->getDiskPath() . '?w=240&h=240&fit=crop';
        } else {
            $image = $this->avatar;
        }
        return $image;
    }

    /**
     * @param $field_id
     * @param $value
     */
    public function updateFieldValue($field_id, $value)
    {
        $data   = $this->fields()->where('fields.id', $field_id)->first();
        $client = new Client();
        if ($data_id = data_get($data, 'pivot.id')) {
            $res = $client->patch('https://api.planningcenteronline.com/people/v2/field_data/' . $data_id,
                ['auth' => [config('services.people.id'), config('services.people.secret')],
                 'json' => ['data' => [
                     'type' => 'FieldDatum', 'id' => $data_id, 'attributes' => ['value' => $value]
                 ]]
                ]
            );
            if ($res->getStatusCode() == 200) {
                $this->fields()->syncWithoutDetaching([$field_id => ['value' => $value]]);
//                $this->fields()->updateExistingPivot($field_id, ['value' => $value]);
            }
        } else {
            $res = $client->post('https://api.planningcenteronline.com/people/v2/people/' . $this->id . '/field_data',
                ['auth' => [config('services.people.id'), config('services.people.secret')],
                 'json' => ['data' => [
                     'type' => 'FieldDatum', 'attributes' => ['value' => $value, 'field_definition_id' => $field_id]
                 ]]
                ]
            );
            if ($res->getStatusCode() == 200 || $res->getStatusCode() == 201) {
                $this->fields()->syncWithoutDetaching([$field_id => ['value' => $value]]);
            }
        }
    }

    /**
     * Calculates profession field value
     * @return string
     */
    public function getProfessionAttribute()
    {
        if ($field = $this->fields()->where('fields.id', 167052)->first()) {
            return $field->pivot->value;
        }
        return '';
    }

    /**
     * Updates related field value
     * @param $value
     */
    public function setProfessionAttribute($value)
    {
        $this->updateFieldValue(167052, $value);
    }

    /**
     * Calculates profession field value
     * @return string
     */
    public function getWorkingAttribute()
    {
        if ($field = $this->fields()->where('fields.id', 178703)->first()) {
            return $field->pivot->value;
        }
        return '';
    }

    /**
     * Updates related field value
     * @param $value
     */
    public function setWorkingAttribute($value)
    {
        $this->updateFieldValue(178703, $value);
    }

    /**
     * Calculates profession field value
     * @return string
     */
    public function getCompanyAttribute()
    {
        if ($field = $this->fields()->where('fields.id', 187252)->first()) {
            return $field->pivot->value;
        }
        return '';
    }

    /**
     * Updates related field value
     * @param $value
     */
    public function setCompanyAttribute($value)
    {
        $this->updateFieldValue(187252, $value);
    }

    /**
     * Calculates courses values
     * @return \Illuminate\Support\Collection
     */
    public function getFieldCoursesAttribute()
    {
        $results = collect([]);
        foreach ($this->fields()->where('tab_id', 47880)->get() as $field) {
            $results[$field->id] = $field->pivot->value;
        }
        return $results;
    }

    /**
     * Calculates courses values
     * @return \Illuminate\Support\Collection
     */
    public function getFieldCoursesTakenAttribute()
    {
        $results = collect([]);
        foreach ($this->fields()->where('tab_id', 47880)->wherePivotIn('value', ['Si', 'En curso actualmente'])->get() as $field) {
            $results[$field->id] = $field->pivot->value;
        }
        return $results;
    }

    /**
     * @param $status
     * @return string
     */
    public function calculateClass($status)
    {
        if ($status == 'completed') return 'success';
        elseif ($status == 'didnt_start') return 'danger';
        elseif ($status == 'didnt_finish') return 'warning';
        else return '';
    }

    /**
     * @return string
     */
    public function recommendCourse()
    {
        if ($past = $this->courses()->where('period', '2018-1')->first()) {
            if ($past->pivot->status == 'didnt_start') return $past->name;
            elseif ($past->pivot->status == 'didnt_finish') return $past->name;
            elseif ($past->pivot->status == 'completed') {
                if ($past->name == 'Tiempos Peligrosos') return 'Mateo 1';
                elseif ($past->name == 'Mateo 1') return 'Mateo 2';
                elseif ($past->name == 'Mateo 2') return 'Mateo 3';
                elseif ($past->name == 'Mateo 3') return 'Mateo 4';
                elseif ($past->name == 'Mateo 4') return 'Mateo 5';
                elseif ($past->name == 'Mateo 5') return 'Mateo 6';
                elseif ($past->name == 'Vida Nueva') return 'Ser discípulo implica compromiso devocional';
                elseif ($past->name == 'Ser discípulo implica compromiso devocional') return 'Cristo - Espíritu Santo';
                elseif ($past->name == 'Buscándole a Él') return 'Cristo - Espíritu Santo';
                elseif ($past->name == 'Pentateuco') return 'Mateo 1';
                elseif ($past->name == 'Misión Integral') return 'Cristo - Espíritu Santo';
            }
        } else {
            $fields = $this->field_courses_taken;
            if (!count($fields)) return 'Vida Nueva';
            if (isset($fields['178678']) && $fields['178680'] == 'Si') return 'Cristo - Espíritu Santo';
            if (isset($fields['178678']) && $fields['178678'] == 'Si') return 'Ser discípulo implica compromiso devocional';
        }
        return 'Cristo - Espíritu Santo';
    }
}
