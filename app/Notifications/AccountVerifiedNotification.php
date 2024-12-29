<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;

class AccountVerifiedNotification extends Notification
{
    use Queueable;

    protected $user;

    public function __construct($user)
    {
        $this->user = $user; // Menyimpan objek user yang akan diverifikasi
    }     

    public function via($notifiable)
    {
        return ['mail']; // Mengirim melalui email
    }

    public function toMail($notifiable)
    {
        $data = [
        'name' => $this->user->name,
        'loginUrl' => url('http://127.0.0.1:8000/login'), // Ganti dengan URL login aplikasi Anda
    ];

    return (new MailMessage)
        ->view('email.notif', $data)
        ->subject('Akun Anda Telah Diverifikasi');
    }
}
