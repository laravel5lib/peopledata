<?php

namespace App;

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
        $res    = $client->get('https://api.planningcenteronline.com/people/v2/people/' . $this->id . '?include=emails,phone_numbers,marital_status', ['auth' => [config('services.people.id'), config('services.people.secret')]]);
        if ($res->getStatusCode() == 200) {
            $response = json_decode($res->getBody(), true);
            return $this->updateWithJson($response);
        }
        return $this;
    }

    /**
     * @param $response
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
            if(isset($data['relationships'])){
                $relationships = $data['relationships'];
                if(isset($relationships['marital_status'])){
                    if(!$relationships['marital_status']['data']){
                        $this->marital_status_id = null;
                        $this->save();
                    } elseif(isset($relationships['marital_status']['data']['id'])) {
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
                } else {
//                    dd($included);
                }
            }
        }
        return $this;
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
}
