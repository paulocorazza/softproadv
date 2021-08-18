<?php

namespace App\Notifications;

use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegisterNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @param Company $company
     * @param string $password
     */
    public function __construct(
        private Company $company,
        private string $password)
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
        $dominio = 'https://' . $this->company->subdomain .  config('app.url_client');
        $appName = 'SoftPro Advogado';

        return (new MailMessage)
            ->subject('Registro no ' . $appName )
            ->greeting('Olá, ' . $this->company->name )

            ->line('Obrigado por escolher o ' . $appName . '!')
            ->line('Criamos um domínio seguro especialmente para você.')
            ->line('Para acessar o sistema com seu domínio personalizado clique no botão abaixo.')
            ->action($dominio,  $dominio)
            ->line('Caso o link ainda não esteja disponível, aguarde mais alguns minutos para a liberação do sistema.')

            ->line('E-mail de acesso: ' . $this->company->email)
            ->line('Sua senha para o primeiro acesso: ' . $this->password)

            ->line('Agora você pode gerenciar os processos, agenda e financeiro em um único lugar.')
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
