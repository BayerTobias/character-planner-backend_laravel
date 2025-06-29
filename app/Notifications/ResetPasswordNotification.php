<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;


class ResetPasswordNotification extends ResetPassword
{
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $url = url(config('app.frontend_url') . '/reset-password?token=' . $this->token . '&email=' . urlencode($notifiable->email));

        return (new MailMessage)
            ->subject('Dein Passwort zurücksetzen')
            ->view('emails.custom-reset-password', [
                'url' => $url,
                'notifiable' => $notifiable
            ]);
    }


}
