<?php

namespace App\Services;

use App\Models\MfaVerification;
use App\Models\User;
use App\Mail\MfaOtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class MfaService
{
    public function __construct(
        protected EmailLogService $emailLogService
    ) {}
    public function generateOtp(User $user): MfaVerification
    {
        $otp = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $verification = MfaVerification::create([
            'user_id' => $user->id,
            'otp' => $otp,
            'expires_at' => now()->addMinutes(10),
            'used' => false,
        ]);

        $this->sendOtpEmail($user, $otp);

        return $verification;
    }

    public function verifyOtp(User $user, string $otp): bool
    {
        $verification = MfaVerification::where('user_id', $user->id)
            ->where('otp', $otp)
            ->where('used', false)
            ->where('expires_at', '>', now())
            ->latest()
            ->first();

        if (!$verification) {
            return false;
        }

        $verification->update(['used' => true]);

        return true;
    }

    protected function sendOtpEmail(User $user, string $otp): void
    {
        try {
            $this->emailLogService->sendAndLog(
                $user->email,
                new MfaOtpMail($otp),
                $user->name,
                User::class,
                $user->id,
                ['type' => 'mfa_otp']
            );
        } catch (\Exception $e) {
            Log::error('Failed to send MFA email to ' . $user->email . ': ' . $e->getMessage());
            // Don't throw - allow the OTP to be generated even if email fails
            // The user can request a new code if needed
        }
    }
}