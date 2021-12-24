<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class SystemNotification extends Notification
{
    use Queueable;

    public $notification;
    public $user;
    public $is_system;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$message,$is_system = false)
    {
        $this->notification = $message;
        $this->user = $user;
        $this->is_system = $is_system;
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

    public function toDatabase($notifiable)
    {
        // return ['message' => $this->notification['message'] ?? ''];
        return [
            'user' => $this->user,
            'message' => $this->notification,
            'is_system' => $this->is_system,
        ];
    }

    public function toArray($notifiable)
    {
        return [
            'user' => $this->user,
            'message' => $this->notification,
            'is_system' => $this->is_system,
        ];
    }
}
