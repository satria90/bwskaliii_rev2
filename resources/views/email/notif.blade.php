<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Akun Anda Telah Diverifikasi</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <p>Halo {{ $name }},</p>

    <p>Selamat! Akun Anda telah berhasil diverifikasi dan sekarang siap untuk digunakan. 😊</p>

    <p>Silakan klik tombol di bawah ini untuk login:</p>

    <p style="text-align: center;">
        <a href="{{ $loginUrl }}" style="background-color: #4CAF50; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; font-weight: bold;">
            Login ke Akun Saya
        </a>
    </p>

    <p>Terima kasih telah bergabung dengan layanan kami!</p>

    <p>Salam hangat,</p>
    <p><strong>Tim Anda</strong></p>
</body>
</html>
