<?php

namespace App\Notifications;

use App\Models\Event;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserLinkedEvent extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(
        private Event $event,
        private string $uuid,
    )
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        $data = $this->event->load('user', 'process.person');

        return [
          'data' => $data
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
           'id' => $this->id,
           'user_id' => $this->uuid,
           'read_at' => null,
           'data' => [
             'data' => $this->event->load('user', 'process.person')
           ]
        ]);
    }

    public function broadcastOn()
    {
        return new PrivateChannel('notification-created.' . $this->uuid);
    }
}
