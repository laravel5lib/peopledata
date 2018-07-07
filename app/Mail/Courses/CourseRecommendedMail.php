<?php

namespace App\Mail\Courses;

use App\Member;
use App\PCO\Course;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CourseRecommendedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $course_name;
    public $member;

    /**
     * Create a new message instance.
     *
     * @param $course_name
     * @param Member $member
     */
    public function __construct($course_name, Member $member)
    {
        $this->course_name = $course_name;
        $this->member = $member;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = url('members/'.$this->member->id.'/courses');
        return $this->subject('Tenemos el curso perfecto para tí!')
            ->cc(['jcorrego@gmail.com','isabelorozcoalvarez@gmail.com','sramos7785@gmail.com'])
            ->markdown('emails.courses.recommended', compact('url'));
    }
}
