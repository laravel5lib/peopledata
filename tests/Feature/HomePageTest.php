<?php

namespace Tests\Feature;

use App\PCO\Course;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class HomePageTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function home_page_requires_login()
    {
        $response = $this->get('/');
        $response->assertRedirect('login');
    }

    /** @test */
    function authenticated_user_can_see_courses_list()
    {
        $user   = factory(User::class)->create([
            'email' => 'jcorrego@gmail.com',
        ]);
        $course = factory(Course::class)->create([
            'name' => 'Test Course',
            'day' => 0,
            'period' => '2019-1',
        ]);
        $response = $this->followingRedirects()->actingAs($user)->get('/');
        $response->assertSee($course->name);
    }
}
