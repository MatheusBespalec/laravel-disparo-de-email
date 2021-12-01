<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;
    public $email;
    public $name;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, $email, $name)
    {
        $this->token = $token;
        $this->email = $email;
        $this->name = $name;
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
        $url = "http://localhost:8000/password/reset/$this->token?email=$this->email";
        $minutes = config('auth.passwords.'.config('auth.defaults.passwords').'.expire');
        return (new MailMessage)
            ->subject('Redefinição de senha!')
            ->greeting('Olá, '.$this->name)
            ->line('Caso tenha solicitado uma redefinição de senha clique no link abaixo para altera-la:')
            ->action('Atualizar Senha', $url)
            ->line("Esse link de redefinição de senha expira em $minutes minutos.")
            ->line('Se não tiver solicitado uma redefinição de senha, ignore este email.')
            ->salutation('Até Breve!');
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
