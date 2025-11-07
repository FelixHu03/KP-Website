<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class PpdbResetPasswordNotification extends Notification
{
    use Queueable;


    /**
     * Token reset password.
     *
     * @var string
     */
    public $token;
    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
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
        // INI ADALAH BAGIAN PENTING
        // Kita membuat URL menggunakan rute 'ppdb.password.reset' kita yang benar
        $url = route('ppdb.password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]);

        return (new MailMessage)
            ->subject(Lang::get('Notifikasi Reset Password PPDB'))
            ->line(Lang::get('Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda.'))
            ->action(Lang::get('Reset Password'), $url)
            ->line(Lang::get('Link reset password ini akan kedaluwarsa dalam :count menit.', ['count' => config('auth.passwords.user_ppdbs.expire')]))
            ->line(Lang::get('Jika Anda tidak merasa meminta reset password, abaikan email ini.'));
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
