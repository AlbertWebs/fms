<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload Request</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: linear-gradient(to right, #4f46e5, #6366f1); padding: 30px; text-align: center; border-radius: 8px 8px 0 0;">
        <h1 style="color: white; margin: 0; font-size: 24px;">File Upload Request</h1>
        <p style="color: rgba(255,255,255,0.9); margin: 5px 0 0 0;">Ngunzi & Associates</p>
    </div>

    <div style="background: white; padding: 30px; border: 1px solid #e5e7eb; border-top: none; border-radius: 0 0 8px 8px;">
        <p style="margin-top: 0;">Dear {{ $fileRequest->client->name }},</p>

        <p>We are requesting that you upload the following file(s) to our secure system:</p>

        <div style="background: #f9fafb; border-left: 4px solid #4f46e5; padding: 15px; margin: 20px 0;">
            <h2 style="margin: 0 0 10px 0; color: #1f2937; font-size: 18px;">{{ $fileRequest->title }}</h2>
            @if($fileRequest->description)
                <p style="margin: 0; color: #6b7280;">{{ $fileRequest->description }}</p>
            @endif
        </div>

        @if($fileRequest->category || $fileRequest->financial_year)
            <div style="margin: 20px 0;">
                @if($fileRequest->category)
                    <p style="margin: 5px 0;"><strong>Category:</strong> {{ $fileRequest->category->name }}</p>
                @endif
                @if($fileRequest->financial_year)
                    <p style="margin: 5px 0;"><strong>Financial Year:</strong> {{ $fileRequest->financial_year }}</p>
                @endif
            </div>
        @endif

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('file-requests.upload', $fileRequest->token) }}" 
               style="display: inline-block; background: #4f46e5; color: white; padding: 12px 30px; text-decoration: none; border-radius: 6px; font-weight: 600;">
                Upload File
            </a>
        </div>

        <p style="color: #6b7280; font-size: 14px;">
            <strong>Important:</strong> This link will expire on {{ $fileRequest->expires_at->format('F d, Y') }}.
        </p>

        <p style="color: #6b7280; font-size: 14px; margin-top: 20px;">
            If you have any questions or concerns, please contact us directly.
        </p>

        <p style="margin-top: 30px;">Best regards,<br>
        <strong>Ngunzi & Associates</strong></p>
    </div>

    <div style="text-align: center; margin-top: 20px; color: #9ca3af; font-size: 12px;">
        <p>This is an automated message. Please do not reply to this email.</p>
    </div>
</body>
</html>
