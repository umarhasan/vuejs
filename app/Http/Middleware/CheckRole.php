<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            Log::info('User is not authenticated.');
            return redirect('/login')->with('error', 'You must be logged in to access this page.');
        }

        $user = Auth::user();
        Log::info('Authenticated user: ', ['user' => $user]);

        if (!$user->RoleHas($roles)) {
            Log::info('User does not have the required role.', ['required_roles' => $roles]);
            // return response()->json(['error' => 'You do not have the required permissions to access this page.'], 403); // Forbidden
            return redirect('/home')->with('error', 'You do not have the required permissions to access this page.');
        }

        Log::info('User has the required role, proceeding with request.');
        return $next($request);
    }
}