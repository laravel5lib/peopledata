<?php

namespace App\Mail\Courses;

use App\Member;
use App\PCO\Course;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CoursePreRegisteredMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $course;
    public $member;

    /**
     * Create a new message instance.
     *
     * @param Course $course
     * @param Member $member
     */
    public function __construct(Course $course, Member $member)
    {
        $this->course = $course;
        $this->member = $member;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = url('members/'.$this->member->id . '/courses');
        return $this->subject('Ya estás inscrito(a) en un curso de Educación Cristiana')
//            ->cc(['jcorrego@gmail.com','isabelorozcoalvarez@gmail.com','sramos7785@gmail.com'])
            ->bcc(['jcorrego@gmail.com'])
            ->markdown('emails.courses.preregistered', compact('url'));
    }
}
