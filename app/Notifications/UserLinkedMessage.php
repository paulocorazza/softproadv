<?php

namespace App\Notifications;


use App\Models\Message;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserLinkedMessage extends Notification
{
    use Queueable;

    private Message $message;
    private string $uuid;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(
        string $uuid,
        Message $message
    )
    {
        $this->message = $message;
        $this->uuid = $uuid;
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
        $data = $this->message;

        return [
            'data' => $data->load('user')
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'id' => $this->id,
            'user_id' => $this->uuid,
            'read_at' => null,
            'data' => $this->message->load('user')
        ] );
    }

    public function broadcastOn()
    {
        return new PrivateChannel('notification-created.' . $this->uuid);
    }
}
