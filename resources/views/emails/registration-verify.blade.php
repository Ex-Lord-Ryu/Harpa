<!DOCTYPE html>
<html>
<head>
    <title>Registration Verification</title>
    <style>
        .verification-code {
            font-size: 24px;
            font-weight: bold;
            color: #4a5568;
            padding: 10px;
            background-color: #f7fafc;
            border-radius: 5px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <h2>Welcome to {{ config('app.name') }}!</h2>
    <p>Hello {{ $name }},</p>
    <p>Thank you for registering. To complete your registration, please use the following verification code:</p>

    <div class="verification-code">
        {{ $otp }}
    </div>

    <p>This verification code will expire in 15 minutes.</p>
    <p>If you did not create an account, no further action is required.</p>

    <p>Best regards,<br>
    {{ config('app.name') }} Team</p>
</body>
</html>
