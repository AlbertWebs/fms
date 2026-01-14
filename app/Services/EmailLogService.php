<?php

namespace App\Services;

use App\Models\EmailLog;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class EmailLogService
{
    /**
     * Log an email before sending
     */
    public function logEmail(
        string $recipientEmail,
        string $subject,
        string $mailClass,
        ?string $recipientName = null,
        ?string $relatedModelType = null,
        ?int $relatedModelId = null,
        ?array $metadata = null
    ): EmailLog {
        return EmailLog::create([
            'recipient_email' => $recipientEmail,
            'recipient_name' => $recipientName,
            'subject' => $subject,
            'mail_class' => $mailClass,
            'status' => 'pending',
            'related_model_type' => $relatedModelType,
            'related_model_id' => $relatedModelId,
            'metadata' => $metadata,
        ]);
    }

    /**
     * Send email and log it
     */
    public function sendAndLog(
        string $recipientEmail,
        Mailable $mailable,
        ?string $recipientName = null,
        ?string $relatedModelType = null,
        ?int $relatedModelId = null,
        ?array $metadata = null
    ): EmailLog {
        $mailClass = get_class($mailable);
        $subject = $mailable->envelope()->subject;

        // Create log entry before sending
        $emailLog = $this->logEmail(
            $recipientEmail,
            $subject,
            $mailClass,
            $recipientName,
            $relatedModelType,
            $relatedModelId,
            $metadata
        );

        try {
            // Send the email
            Mail::to($recipientEmail)->send($mailable);
            
            // Mark as sent
            $emailLog->markAsSent();
        } catch (\Exception $e) {
            // Mark as failed
            $emailLog->markAsFailed($e->getMessage());
            throw $e;
        }

        return $emailLog;
    }
}
