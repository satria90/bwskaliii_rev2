<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AccountVerifiedNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
        // Anda bisa menambahkan data yang perlu dikirimkan ke notifikasi ini.
    }

    public function via($notifiable)
    {
        return ['mail']; // Mengirim melalui email
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Akun Anda Telah Diverifikasi')
                    ->line('Kami ingin memberitahukan bahwa akun Anda telah berhasil diverifikasi dan siap digunakan.')
                    ->action('Login', url('/login'))  // Menambahkan tautan untuk login
                    ->line('Terima kasih telah menggunakan layanan kami!');
    }
}
