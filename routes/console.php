<?php

use App\Mail\Courses\CoursePreRegisteredMail;
use App\Mail\Courses\CourseRegisteredMail;
use App\Mail\Courses\CourseSummaryMail;
use App\Member;
use App\PCO\Course;
use GuzzleHttp\Client;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Mail;

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
    $res    = $client->get('https://api.planningcenteronline.com/people/v2/people?per_page=' . $limit . '&offset=' . $offset, ['auth' => [config('services.people.id'), config('services.people.secret')]]);
    if ($res->getStatusCode() == 200) {
        $response = json_decode($res->getBody(), true);
        if (isset($response['data'])) {
            foreach ($response['data'] as $row) {
                if (!Member::find($row['id'])) $new = true;
                else $new = false;
                $member = Member::firstOrCreate(['id' => $row['id']]);
                $member->updateFromPeople();
                $member->syncCourses();
                if($new) $this->info((++$count + $offset) . '. ' . $row['id'] . ' ' . $member->name . ($new?' (Nuevo)':''));
                else $this->line((++$count + $offset) . '. ' . $row['id'] . ' ' . $member->name);
            }
        }
    }
})->describe('Sync tabs information');

Artisan::command('people:invite {limit?} {offset?}', function ($limit = 25, $offset = 0) {
    $members = Member::where('child', 0)
                     ->whereNotNull('email')
                     ->whereNotIn('id', ['32461976', '32462095'])
                     ->doesntHave('courses')
                     ->orderBy('name')->skip($offset)->take($limit)->get();
    $i       = 0;
    foreach ($members as $member) {
        $this->line(++$i . '. ' . $member->first_name . ' ' . $member->last_name);
        Mail::to($member->email)->send(new \App\Mail\Courses\PickYourCourseMail($member));
    }

})->describe('Invite people to courses');

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

Artisan::command('people:registered-mail', function () {
    $period  = '2020-1';
    $members = Member::whereHas('courses', function ($query) use ($period) {
        $query->where('period', $period);
    })->get();
    foreach ($members as $member) {
        if ($member->email) {
            $course = $member->courses()->where('period', $period)->first();
            $this->line($member->name . ': ' . $course->name);
            Mail::to($member->email)->send(new CourseRegisteredMail($course, $member));
//            Mail::to('jcorrego@gmail.com')->send(new CoursePreRegisteredMail($course, $member));
        } else {
            $this->error($member->name . ': No Email');
        }
    }
})->describe('Send emails to registered students');

Artisan::command('courses:professor-mail', function () {
    $period  = '2020-1';
    $courses = Course::where('period', $period)->has('members')->get();
    foreach ($courses as $course) {
        if ($prof = $course->professor) {
            if ($prof->email && $prof->id == 35918102) {
                $this->line($prof->id . '. ' . $prof->name . ': ' . $course->name);
                Mail::to($prof->email)->send(new CourseSummaryMail($course, $prof));
//            Mail::to('jcorrego@gmail.com')->send(new CoursePreRegisteredMail($course, $member));
            } else {
                $this->error($prof->id . '. ' . $prof->name . ': No Email');
            }
        } else {
            $this->error($course->name . ': No Professor');
        }
    }
})->describe('Send emails to professor with course summary');
