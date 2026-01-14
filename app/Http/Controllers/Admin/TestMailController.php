<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use App\Services\EmailLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestMailController extends Controller
{
    public function __construct(
        protected EmailLogService $emailLogService
    ) {}

    public function index(): View
    {
        $this->authorize('users.manage');

        return view('admin.test-mail.index');
    }

    public function send(Request $request): RedirectResponse
    {
        $this->authorize('users.manage');

        $validated = $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            $this->emailLogService->sendAndLog(
                $validated['email'],
                new TestMail($validated['subject'], $validated['message']),
                null,
                null,
                null,
                ['type' => 'test_mail']
            );

            return redirect()->route('admin.test-mail.index')->with('success', 'Test email sent successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.test-mail.index')
                ->with('error', 'Failed to send test email: ' . $e->getMessage())
                ->withInput();
        }
    }
}
