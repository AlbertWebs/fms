<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\MfaService;
use App\Services\AuditLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class MfaVerificationController extends Controller
{
    public function __construct(
        protected MfaService $mfaService,
        protected AuditLogService $auditLogService
    ) {}

    public function show(): View
    {
        $user = Auth::user();

        if (!$user || !$user->mfa_enabled) {
            return redirect()->route('dashboard');
        }

        $this->mfaService->generateOtp($user);

        return view('auth.verify-mfa');
    }

    public function verify(Request $request): RedirectResponse
    {
        $request->validate([
            'otp' => ['required', 'string', 'size:6'],
        ]);

        $user = Auth::user();

        if (!$user || !$user->mfa_enabled) {
            return redirect()->route('dashboard');
        }

        if ($this->mfaService->verifyOtp($user, $request->otp)) {
            $request->session()->put('mfa_verified', true);
            $this->auditLogService->log('mfa_verified', User::class, $user->id, 'MFA verification successful');
            
            return redirect()->intended(route('dashboard', absolute: false));
        }

        $this->auditLogService->log('mfa_failed', User::class, $user->id, 'MFA verification failed');
        
        throw ValidationException::withMessages([
            'otp' => ['The provided OTP is invalid or expired.'],
        ]);
    }
}