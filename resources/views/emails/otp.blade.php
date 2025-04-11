<!DOCTYPE html>
<html>
<head>
    <title>OTP Verification</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: #fff; padding: 20px;">
        <h2 style="color: #333; text-align: center;">Kode OTP untuk Melihat Password</h2>

        <div style="background: #f9f9f9; padding: 20px; border-radius: 5px; margin: 20px 0;">
            <p style="margin: 0; text-align: center; font-size: 24px; letter-spacing: 5px; font-weight: bold;">
                {{ $otp }}
            </p>
        </div>

        <p>Kode OTP ini akan kadaluarsa dalam 5 menit.</p>
        <p>Jika Anda tidak meminta kode OTP ini, abaikan email ini.</p>

        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee; text-align: center; color: #666; font-size: 12px;">
            <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
        </div>
    </div>
</body>
</html>
