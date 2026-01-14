<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New File Request Notification</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: linear-gradient(to right, #dc2626, #ef4444); padding: 30px; text-align: center; border-radius: 8px 8px 0 0;">
        <h1 style="color: white; margin: 0; font-size: 24px;">New File Request Created</h1>
        <p style="color: rgba(255,255,255,0.9); margin: 5px 0 0 0;">Ngunzi & Associates</p>
    </div>

    <div style="background: white; padding: 30px; border: 1px solid #e5e7eb; border-top: none; border-radius: 0 0 8px 8px;">
        <p style="margin-top: 0;">Hello Admin,</p>

        <p>A new file request has been created in the system:</p>

        <div style="background: #fef2f2; border-left: 4px solid #dc2626; padding: 15px; margin: 20px 0;">
            <h2 style="margin: 0 0 10px 0; color: #1f2937; font-size: 18px;">{{ $fileRequest->title }}</h2>
            @if($fileRequest->description)
                <p style="margin: 0; color: #6b7280;">{{ $fileRequest->description }}</p>
            @endif
        </div>

        <div style="background: #f9fafb; padding: 15px; margin: 20px 0; border-radius: 6px;">
            <p style="margin: 5px 0;"><strong>Client:</strong> {{ $fileRequest->client->name }}</p>
            @if($fileRequest->client->email)
                <p style="margin: 5px 0;"><strong>Client Email:</strong> {{ $fileRequest->client->email }}</p>
            @endif
            @if($fileRequest->requester)
                <p style="margin: 5px 0;"><strong>Requested By:</strong> {{ $fileRequest->requester->name }}</p>
            @endif
            @if($fileRequest->category)
                <p style="margin: 5px 0;"><strong>Category:</strong> {{ $fileRequest->category->name }}</p>
            @endif
            @if($fileRequest->financial_year)
                <p style="margin: 5px 0;"><strong>Financial Year:</strong> {{ $fileRequest->financial_year }}</p>
            @endif
            <p style="margin: 5px 0;"><strong>Expires:</strong> {{ $fileRequest->expires_at->format('F d, Y g:i A') }}</p>
        </div>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('file-requests.show', $fileRequest) }}" 
               style="display: inline-block; background: #dc2626; color: white; padding: 12px 30px; text-decoration: none; border-radius: 6px; font-weight: 600;">
                View File Request
            </a>
        </div>

        <p style="color: #6b7280; font-size: 14px; margin-top: 20px;">
            The client has been notified via email and can upload the requested file using the secure upload link.
        </p>

        <p style="margin-top: 30px;">Best regards,<br>
        <strong>File Management System</strong></p>
    </div>

    <div style="text-align: center; margin-top: 20px; color: #9ca3af; font-size: 12px;">
        <p>This is an automated notification. Please do not reply to this email.</p>
    </div>
</body>
</html>
