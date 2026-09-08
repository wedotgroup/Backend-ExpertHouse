<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $guard = Auth::guard('super_admin');
        if (!$guard->check()) {
            return redirect('/');
        }

        $user = $guard->user();

        $currentSessionId = $request->session()->getId();

        $loginSessionId = $user->login_session_id;

        if ($currentSessionId !== $loginSessionId) {

            $guard->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/')
                ->with(
                    'error',
                    'Your account has been logged in on another device.'
                );
        }

        return $next($request);
    }
}
