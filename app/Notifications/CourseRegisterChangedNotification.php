<?php

namespace App\Notifications;

use App\Member;
use App\PCO\Course;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CourseRegisterChangedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $member;
    public $course;
    public $status;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @param Member $member
     * @param Course $course
     * @param $status
     * @param User $user
     */
    public function __construct(Member $member, Course $course, $status, User $user)
    {
        $this->member = $member;
        $this->course = $course;
        $this->status = $status;
        $this->user   = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Cambio en registro de clase: ' . $this->member->id . '-' . $this->course->id . '-' . $this->status)
            ->line('El usuario (' . $this->user->id . ') ' . $this->user->name . ' ha realizado un cambio en la inscripción de una clase.')
            ->line('Estudiante: (' . $this->member->id . ') ' . $this->member->first_name . ' ' . $this->member->last_name)
            ->line('Clase: (' . $this->course->id . ') ' . $this->course->name)
            ->line('Estado: ' . $this->status)
            ->action('Ver clases', url('/courses'))
            ->line('Gracias!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'user_id'   => $this->user->id,
            'member_id' => $this->member->id,
            'course_id' => $this->course->id,
            'status'    => $this->status,
        ];
    }
}
