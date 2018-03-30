<?php

namespace App\PCO;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Field extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','data_type','name','sequence','slug','tab_id'];

    /**
     * Field Options
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function options()
    {
        return $this->hasMany(FieldOption::class);
    }
    /**
     * Updates options relations
     */
    public function updateOptions()
    {
        $client = new Client();
        $res    = $client->get('https://api.planningcenteronline.com/people/v2/field_definitions/'. $this->id .'/field_options', ['auth' => [config('services.people.id'), config('services.people.secret')]]);
        if ($res->getStatusCode() == 200) {
            $response = json_decode($res->getBody(), true);
            foreach ($response['data'] as $data){
                $option = FieldOption::firstOrCreate(['id'=>$data['id']]);
                $option->update($data['attributes']);
                $this->options()->save($option);
            }
        }
    }
}
