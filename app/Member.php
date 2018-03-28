<?php

namespace App;

use App\PCO\Field;
use MediaUploader;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Plank\Mediable\Mediable;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use Mediable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'avatar', 'first_name', 'last_name', 'nickname', 'birthdate', 'child', 'gender', 'name', 'remote_id', 'status', 'created_at', 'updated_at'];

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

    /**
     * @param $response
     * @return Member
     */
    public function updateWithJson($response)
    {
        if (isset($response['data'])) {
            $data = $response['data'];
            if (isset($data['attributes'])) {
                $attributes               = $data['attributes'];
                $attributes['created_at'] = Carbon::parse($attributes['created_at']);
                $attributes['updated_at'] = Carbon::parse($attributes['updated_at']);
                $this->update($attributes);
                if ($attributes['avatar']) {
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
                        $this->fields()->syncWithoutDetaching([$field->id => ['id' => $included['id'], 'value' => $value]]);
//                        dd($this->fields);
                    }
                } else {
//                    dd($included);
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
        $data = $this->fields()->where('fields.id', $field_id)->first();
        $client = new Client();
        if ($data_id = data_get($data, 'pivot.id')) {
            $res    = $client->patch('https://api.planningcenteronline.com/people/v2/field_data/' . $data_id,
                ['auth' => [config('services.people.id'), config('services.people.secret')],
                 'json' => ['data' => [
                     'type' => 'FieldDatum', 'id' => $data_id, 'attributes' => ['value' => $value]
                 ]]
                ]
            );
            if ($res->getStatusCode() == 200) {
                $this->fields()->syncWithoutDetaching([$field_id=> ['value' => $value]]);
//                $this->fields()->updateExistingPivot($field_id, ['value' => $value]);
            }
        } else{
            $res    = $client->post('https://api.planningcenteronline.com/people/v2/people/'. $this->id.'/field_data',
                ['auth' => [config('services.people.id'), config('services.people.secret')],
                 'json' => ['data' => [
                     'type' => 'FieldDatum', 'attributes' => ['value' => $value, 'field_definition_id'=>$field_id]
                 ]]
                ]
            );
            if ($res->getStatusCode() == 200 || $res->getStatusCode() == 201) {
                $this->fields()->syncWithoutDetaching([$field_id=> ['value' => $value]]);
            }
        }
    }

    /**
     * Calculates profession field value
     * @return string
     */
    public function getProfessionAttribute()
    {
        if($field = $this->fields()->where('fields.id',167052)->first()){
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
        if($field = $this->fields()->where('fields.id',178703)->first()){
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
        if($field = $this->fields()->where('fields.id',187252)->first()){
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
}
