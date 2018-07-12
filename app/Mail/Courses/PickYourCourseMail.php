<?php

namespace App\Mail\Courses;

use App\Member;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PickYourCourseMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $member;

    /**
     * Create a new message instance.
     *
     * @param $course_name
     * @param Member $member
     */
    public function __construct(Member $member)
    {
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
        return $this->subject($this->member->first_name . ', no te quedes sin estudiar este semestre!')
//            ->bcc(['jcorrego@gmail.com','isabelorozcoalvarez@gmail.com','sramos7785@gmail.com'])
            ->bcc(['jcorrego@gmail.com'])
            ->markdown('emails.courses.pickcourse', compact('url'));
    }
}
