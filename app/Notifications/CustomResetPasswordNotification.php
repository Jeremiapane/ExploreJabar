<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPasswordNotification extends Notification
{
    protected $token;

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
        return (new MailMessage())
            ->subject('Permintaan Reset Password - Dinas Pariwisata dan Kebudayaan Provinsi Jawa Barat')
            ->line('Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda di Explore Jabar.')
            ->action('Reset Password', url(route('pegawai.password.reset', ['token' => $this->token, 'email' => $notifiable->email], false)))
            ->line('Jika Anda tidak meminta reset password, tidak perlu melakukan tindakan lebih lanjut.')
            ->line('Terima kasih,')
            ->line('Tim Dinas Pariwisata dan Kebudayaan Provinsi Jawa Barat');
    }
}
