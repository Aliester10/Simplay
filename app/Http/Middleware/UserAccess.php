<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $userType)
    {
        if (auth()->check() && auth()->user()->type == $userType) {
            return $next($request);
        }

        // Use match expression for role-based messages with translation
        $message = match ($userType) {
            'admin' => __('messages.admin_access'),
            'member' => __('messages.member_access'),
            'distributor' => __('messages.distributor_access'),
            default => __('messages.no_permission'),
        };
        // Redirect with the error message
return redirect()->back()->with('error', $message);
    }
}
