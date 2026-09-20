<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResidentAuthController extends Controller
{
    public function showLogin()
    {
        return view(
            'resident_portal.auth.login'
        );
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => [
                'required',
                'email',
            ],

            'password' => [
                'required',
                'string',
            ],
        ]);

        $remember =
            $request->boolean('remember');

        if (!Auth::attempt(
            $credentials,
            $remember
        )) {

            return back()
                ->withErrors([
                    'email' =>
                        'The email or password is incorrect.',
                ])
                ->onlyInput('email');
        }

        $request
            ->session()
            ->regenerate();

        $user =
            $request->user();

        /*
        |--------------------------------------------------------------------------
        | Resident Portal only accepts linked resident accounts
        |--------------------------------------------------------------------------
        */

        if (
            !$user->isResident()
            || !$user->resident_id
            || !$user->resident
        ) {

            Auth::logout();

            $request
                ->session()
                ->invalidate();

            $request
                ->session()
                ->regenerateToken();

            return back()
                ->withErrors([
                    'email' =>
                        'This account is not linked to a resident record.',
                ])
                ->onlyInput('email');
        }

        return redirect()
            ->intended(
                route('resident.portal')
            );
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request
            ->session()
            ->invalidate();

        $request
            ->session()
            ->regenerateToken();

        return redirect()
            ->route(
                'resident.login'
            );
    }
}