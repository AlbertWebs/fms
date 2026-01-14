<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RequireMfa
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && $user->mfa_enabled && !$request->session()->get('mfa_verified')) {
            return redirect()->route('mfa.verify');
        }

        return $next($request);
    }
}