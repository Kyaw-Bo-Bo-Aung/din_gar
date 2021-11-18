<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GeneralNotification extends Notification
{
    use Queueable;

    protected $title, $message, $sourceId, $sourceType, $web_link;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($title, $message, $sourceId, $sourceType, $web_link)
    {
        $this->title = $title;
        $this->message = $message;
        $this->sourceId = $sourceId;
        $this->sourceType = $sourceType;
        $this->web_link = $web_link;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'title' => $this->title,
            'message' => $this->message,
            'sourceId' => $this->sourceId,
            'sourceType' => $this->sourceType,
            'web_link' => $this->web_link
        ];
    }
}
