<!DOCTYPE html>
<html>
<head>
    <title>Password Baru</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: #fff; padding: 20px;">
        <h2 style="color: #333; text-align: center;">Password Baru Anda</h2>

        <p>Halo {{ $user->name }},</p>

        <p>Password baru Anda telah digenerate:</p>

        <div style="background: #f9f9f9; padding: 20px; border-radius: 5px; margin: 20px 0;">
            <p style="margin: 0; text-align: center; font-size: 24px; font-family: monospace; letter-spacing: 2px;">
                {{ $password }}
            </p>
        </div>

        <p>Silakan gunakan password ini untuk login ke sistem.</p>
        <p>Demi keamanan, segera ubah password ini setelah Anda berhasil login.</p>

        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee;">
            <p style="margin: 0; color: #666; font-size: 12px; text-align: center;">
                Email ini berisi informasi rahasia. Jangan teruskan email ini kepada siapapun.
            </p>
        </div>
    </div>
</body>
</html>
