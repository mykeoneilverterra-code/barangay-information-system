<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(
        Request $request,
        Closure $next,
        string $role
    ): Response {

        $user =
            $request->user();


        /*
        |--------------------------------------------------------------------------
        | Unauthenticated User
        |--------------------------------------------------------------------------
        */

        if (!$user) {

            if ($role === 'admin') {

                return redirect()
                    ->route('admin.login');
            }


            return redirect()
                ->route('resident.login');
        }


        /*
        |--------------------------------------------------------------------------
        | Correct Role
        |--------------------------------------------------------------------------
        */

        if ($user->role === $role) {

            return $next($request);
        }


        /*
        |--------------------------------------------------------------------------
        | Resident Attempting Admin Access
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'resident') {

            return redirect()
                ->route('resident.portal')
                ->with(
                    'error',
                    'You are not authorized to access the administration area.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Admin Attempting Resident Access
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'admin') {

            return redirect()
                ->route('dashboard')
                ->with(
                    'error',
                    'Administrator accounts cannot access the Resident Portal.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Unknown Role
        |--------------------------------------------------------------------------
        */

        abort(
            403,
            'Unauthorized account role.'
        );
    }
}