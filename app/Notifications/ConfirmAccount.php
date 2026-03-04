<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConfirmAccount extends Notification implements ShouldQueue
{
    use Queueable;
    public $name;
    public $token;


    /**
     * Create a new notification instance.
     */
    public function __construct($name, $token)
    {
        $this->name = $name;
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Confirma tu cuenta en UpTask')
            ->greeting('Hola: ' . $notifiable->name)
            ->line('Has creado tu cuenta en UpTask, ya casi está todo listo.')
            ->line('Solo debes confirmar tu cuenta.')
            ->action('Confirmar Cuenta', url('/confirm-account'))
            ->line('E ingresa el código:')
            ->line('**' . $this->token . '**')
            ->line('Este token expira en 10 minutos.')
            ->salutation('Saludos, el equipo de UpTask');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
