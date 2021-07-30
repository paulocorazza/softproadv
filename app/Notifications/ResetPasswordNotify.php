<?php

namespace App\Notifications;

use App\Tenant\ManagerTenant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotify extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @param $token
     */
    public function __construct(private $token)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $manager = app(ManagerTenant::class);

       if (!$manager->domainIsMain()) {
           $url = 'https://' .  $manager->subDomain() .  config('app.url_client') . '/password/reset/' . $this->token;
       } else {
           $url =  config('app.url') . '/password/reset/' . $this->token;
       }

        return (new MailMessage)
            ->subject('Alterar Senha')
            ->greeting('Olá,')
            ->line('Você está recebendo este e-mail porque recebemos um pedido de redefinição de senha para sua conta.')
            ->action('Resetar Senha',  $url)
            ->line('Se você não solicitou uma alteração da senha, nenhuma ação adicional é necessária.')
            ->salutation('Conte com a gente sempre!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
