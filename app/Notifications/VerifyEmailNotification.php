<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;


class VerifyEmailNotification extends VerifyEmail
{
    public function toMail($notifiable): MailMessage
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Bitte bestätige deine E-Mail-Adresse')
            ->view('emails.custom-verify-email', [
                'url' => $verificationUrl,
                'user' => $notifiable,
            ]);

    }

    protected function verificationUrl($notifiable)
    {
        $temporarySignedURL = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );

        $frontendUrl = config('app.frontend_url') . '/verify-email';

        return $frontendUrl . '?url=' . urlencode($temporarySignedURL);
    }
}
