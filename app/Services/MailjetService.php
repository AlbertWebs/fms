<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MailjetService
{
    protected string $apiKey;
    protected string $apiSecret;
    protected string $fromEmail;
    protected string $fromName;

    public function __construct()
    {
        $this->apiKey = config('services.mailjet.api_key') ?: env('MAILJET_API_KEY') ?: env('MAIL_USERNAME');
        $this->apiSecret = config('services.mailjet.api_secret') ?: env('MAILJET_API_SECRET') ?: env('MAIL_PASSWORD');
        $this->fromEmail = config('mail.from.address');
        $this->fromName = config('mail.from.name');
    }

    /**
     * Send an email via Mailjet API
     */
    public function sendEmail(
        string $toEmail,
        string $toName,
        string $subject,
        string $htmlContent,
        ?string $textContent = null
    ): array {
        $response = Http::withBasicAuth($this->apiKey, $this->apiSecret)
            ->post('https://api.mailjet.com/v3.1/send', [
                'Messages' => [
                    [
                        'From' => [
                            'Email' => $this->fromEmail,
                            'Name' => $this->fromName,
                        ],
                        'To' => [
                            [
                                'Email' => $toEmail,
                                'Name' => $toName ?? '',
                            ],
                        ],
                        'Subject' => $subject,
                        'HTMLPart' => $htmlContent,
                        'TextPart' => $textContent ?? strip_tags($htmlContent),
                    ],
                ],
            ]);

        if ($response->successful()) {
            return [
                'success' => true,
                'message_id' => $response->json('Messages.0.To.0.MessageID') ?? null,
                'response' => $response->json(),
            ];
        }

        return [
            'success' => false,
            'error' => $response->body(),
            'status' => $response->status(),
        ];
    }

    /**
     * Send email from a Mailable instance
     */
    public function sendMailable(string $toEmail, $mailable): array
    {
        $envelope = $mailable->envelope();
        $content = $mailable->content();
        
        // Get view data
        $viewData = $mailable->buildViewData();
        
        // Render the HTML content
        $htmlContent = view($content->view, $viewData)->render();
        
        // Get text content if available
        $textContent = $content->textView ? view($content->textView, $viewData)->render() : null;

        return $this->sendEmail(
            $toEmail,
            '',
            $envelope->subject,
            $htmlContent,
            $textContent
        );
    }
}
