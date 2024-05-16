<?php
namespace App\Notifications;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $token = $this->token;
        return (new MailMessage)
        ->subject('Reset Your Password')
        ->greeting('Hi there !')
        ->line('You are receiving this email because we received a password reset request for your account.')
        ->action('Reset Password', url(config('app.url').route('password.reset', $this->token, false)))
        ->line('This password reset link will expire in 60 minutes.')
        ->line('If you did not request a password reset, no further action is required.');
}
}
