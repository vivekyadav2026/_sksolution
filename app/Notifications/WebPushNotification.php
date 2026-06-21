<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;

class WebPushNotification extends Notification
{
    use Queueable;

    public $title;
    public $body;
    public $actionUrl;
    public $image;

    /**
     * Create a new notification instance.
     */
    public function __construct($title, $body, $actionUrl = null, $image = null)
    {
        $this->title = $title;
        $this->body = $body;
        $this->actionUrl = $actionUrl ?? url('/');
        $this->image = $image;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [WebPushChannel::class];
    }

    public function toWebPush($notifiable, $notification)
    {
        $message = (new WebPushMessage)
            ->title($this->title)
            ->icon('/logo.png')
            ->body($this->body)
            ->action('View', 'view', $this->actionUrl)
            ->options(['TTL' => 1000]);

        if ($this->image) {
            $message->image($this->image);
        }

        return $message;
    }
}
