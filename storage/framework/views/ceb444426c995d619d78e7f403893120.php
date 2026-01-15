<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($emailSubject); ?></title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: linear-gradient(to right, #4f46e5, #6366f1); padding: 30px; text-align: center; border-radius: 8px 8px 0 0;">
        <h1 style="color: white; margin: 0; font-size: 24px;">Test Email</h1>
        <p style="color: rgba(255,255,255,0.9); margin: 5px 0 0 0;">Mail Delivery Test</p>
    </div>

    <div style="background: white; padding: 30px; border: 1px solid #e5e7eb; border-top: none; border-radius: 0 0 8px 8px;">
        <p style="margin-top: 0;">Hello,</p>

        <div style="background: #f9fafb; border-left: 4px solid #4f46e5; padding: 15px; margin: 20px 0; border-radius: 4px;">
            <?php echo nl2br(e($emailMessage)); ?>

        </div>

        <p style="color: #6b7280; font-size: 14px; margin-top: 20px;">
            This is a test email sent from the File Management System.
        </p>

        <p style="margin-top: 30px;">Best regards,<br>
        <strong>File Management System</strong></p>
    </div>

    <div style="text-align: center; margin-top: 20px; color: #9ca3af; font-size: 12px;">
        <p>This is an automated test message. Please do not reply to this email.</p>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\fms\resources\views/emails/test-mail.blade.php ENDPATH**/ ?>