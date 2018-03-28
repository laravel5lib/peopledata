<?php

use GuzzleHttp\Client;
use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('people:tabs', function () {
    $client = new Client();
    $res    = $client->get('https://api.planningcenteronline.com/people/v2/tabs', ['auth' => [config('services.people.id'), config('services.people.secret')]]);
    if ($res->getStatusCode() == 200) {
        $response = json_decode($res->getBody(), true);
        if (isset($response['data'])) {
            foreach ($response['data'] as $row) {
                $this->line($row['id']);
                $tab = \App\PCO\Tab::firstOrCreate(['id'=>$row['id']],$row['attributes']);
                $tab->update($row['attributes']);
            }
        }
    }
})->describe('Sync tabs information');

Artisan::command('people:fields', function () {
    $client = new Client();
    $res    = $client->get('https://api.planningcenteronline.com/people/v2/field_definitions?per_page=100', ['auth' => [config('services.people.id'), config('services.people.secret')]]);
    if ($res->getStatusCode() == 200) {
        $response = json_decode($res->getBody(), true);
        if (isset($response['data'])) {
            foreach ($response['data'] as $row) {
                $this->line($row['id']);
                $field = \App\PCO\Field::firstOrCreate(['id'=>$row['id']],$row['attributes']);
                $field->update($row['attributes']);
            }
        }
    }
})->describe('Sync field definitions information');
