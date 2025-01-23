<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Meeting;

class MeetingNotification extends Notification
{
    protected $meeting;

    public function __construct(Meeting $meeting)
    {
        $this->meeting = $meeting;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Meeting Invitation: ' . $this->meeting->title)
            ->line('You have been invited to a meeting.')
            ->line('Title: ' . $this->meeting->title)
            ->line('Description: ' . $this->meeting->description)
            ->line('Start Time: ' . $this->meeting->start_time)
            ->line('End Time: ' . $this->meeting->end_time)
            ->action('View Meeting', url('/meetings/' . $this->meeting->id))
            ->line('Thank you!');
    }
}
