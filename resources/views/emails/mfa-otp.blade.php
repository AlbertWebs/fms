<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MFA Verification Code</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: linear-gradient(to right, #4f46e5, #6366f1); padding: 30px; text-align: center; border-radius: 8px 8px 0 0;">
        <h1 style="color: white; margin: 0; font-size: 24px;">Two-Factor Authentication</h1>
        <p style="color: rgba(255,255,255,0.9); margin: 5px 0 0 0;">Verification Code</p>
    </div>

    <div style="background: white; padding: 30px; border: 1px solid #e5e7eb; border-top: none; border-radius: 0 0 8px 8px;">
        <p style="margin-top: 0;">Hello,</p>

        <p>Your verification code for two-factor authentication is:</p>

        <div style="text-align: center; margin: 30px 0;">
            <div style="display: inline-block; background: #f3f4f6; border: 2px solid #4f46e5; border-radius: 8px; padding: 20px 40px;">
                <div style="font-size: 32px; font-weight: bold; letter-spacing: 8px; color: #4f46e5; font-family: monospace;">
                    {{ $otp }}
                </div>
            </div>
        </div>

        <p style="color: #6b7280; font-size: 14px;">
            <strong>Important:</strong> This code will expire in 10 minutes. Do not share this code with anyone.
        </p>

        <p style="color: #6b7280; font-size: 14px; margin-top: 20px;">
            If you did not request this code, please ignore this email or contact support if you have concerns.
        </p>

        <p style="margin-top: 30px;">Best regards,<br>
        <strong>Ngunzi & Associates</strong></p>
    </div>

    <div style="text-align: center; margin-top: 20px; color: #9ca3af; font-size: 12px;">
        <p>This is an automated message. Please do not reply to this email.</p>
    </div>
</body>
</html>
