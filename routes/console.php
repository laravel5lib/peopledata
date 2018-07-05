<?php

use App\Member;
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
Artisan::command('people:sync {limit?} {offset?}', function ($limit = 25, $offset = 0) {
    $client = new Client();
    $count  = 0;
    $res    = $client->get('https://api.planningcenteronline.com/people/v2/people?per_page='.$limit.'&offset=' . $offset, ['auth' => [config('services.people.id'), config('services.people.secret')]]);
    if ($res->getStatusCode() == 200) {
        $response = json_decode($res->getBody(), true);
        if (isset($response['data'])) {
            foreach ($response['data'] as $row) {
                $member = Member::firstOrCreate(['id' => $row['id']]);
                $member->updateFromPeople();
                $this->line(++$count . '. ' . $row['id'] . ' ' . $member->name);
            }
        }
    }

})->describe('Sync tabs information');

Artisan::command('people:analyze {limit?} {offset?}', function ($limit = 25, $offset = 0) {
    $members = Member::has('courses')->orderBy('name')->get();
    $i = 0;
    foreach ( $members as $member){
        $this->line(++$i . '. ' . $member->first_name . ' ' . $member->last_name);
        foreach ($member->courses as $course){
            if($course->pivot->status == 'completed') $this->info('     (' . $course->period . ') '. $course->name);
            elseif(starts_with($course->pivot->status, 'didnt_')) $this->error('     (' . $course->period . ') '. $course->name);
            else $this->comment('     -(' . $course->period . ') '. $course->name);
        }
    }

})->describe('Display people analysis');

Artisan::command('people:tabs', function () {
    $client = new Client();
    $res    = $client->get('https://api.planningcenteronline.com/people/v2/tabs', ['auth' => [config('services.people.id'), config('services.people.secret')]]);
    if ($res->getStatusCode() == 200) {
        $response = json_decode($res->getBody(), true);
        if (isset($response['data'])) {
            foreach ($response['data'] as $row) {
                $this->line($row['id']);
                $tab = \App\PCO\Tab::firstOrCreate(['id' => $row['id']], $row['attributes']);
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
                $field = \App\PCO\Field::firstOrCreate(['id' => $row['id']], $row['attributes']);
                $field->update($row['attributes']);
                $field->updateOptions();
            }
        }
    }
})->describe('Sync field definitions information');
