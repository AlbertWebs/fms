<?php

namespace App\Http\Controllers;

use App\Models\EmailLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailLogController extends Controller
{
    public function index(Request $request): View
    {
        $this->authorize('users.manage');

        $query = EmailLog::latest();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('recipient_email')) {
            $query->where('recipient_email', 'like', '%' . $request->recipient_email . '%');
        }

        if ($request->has('mail_class')) {
            $query->where('mail_class', 'like', '%' . $request->mail_class . '%');
        }

        if ($request->has('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $emailLogs = $query->paginate(50);

        return view('email-logs.index', compact('emailLogs'));
    }
}
