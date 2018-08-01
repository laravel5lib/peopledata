<?php

namespace App\Mail\Courses;

use App\Member;
use App\PCO\Course;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CourseSummaryMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $course;
    public $professor;

    /**
     * Create a new message instance.
     *
     * @param Course $course
     * @param Member $professor
     */
    public function __construct(Course $course, Member $professor)
    {
        $this->course = $course;
        $this->professor = $professor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = url('courses/'.$this->course->id . '/summary/'.$this->professor->id);
        return $this->subject('Lista de estudiantes inscritos: '.$this->course->name)
//            ->cc(['jcorrego@gmail.com','isabelorozcoalvarez@gmail.com','sramos7785@gmail.com'])
//            ->bcc(['jcorrego@gmail.com'])
            ->markdown('emails.courses.summary', compact('url'));
    }
}
