<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Show Admin Login
    |--------------------------------------------------------------------------
    */

    public function showLogin()
    {
        return view(
            'admin.auth.login'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Admin Login
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $credentials =
            $request->validate([
                'email' => [
                    'required',
                    'email',
                ],

                'password' => [
                    'required',
                    'string',
                ],
            ]);


        /*
        |--------------------------------------------------------------------------
        | Attempt Authentication
        |--------------------------------------------------------------------------
        */

        if (
            !Auth::attempt(
                $credentials,
                $request->boolean('remember')
            )
        ) {

            return back()

                ->withErrors([
                    'email' =>
                        'The email or password is incorrect.',
                ])

                ->onlyInput(
                    'email'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Regenerate Session
        |--------------------------------------------------------------------------
        */

        $request
            ->session()
            ->regenerate();


        $user =
            Auth::user();


        /*
        |--------------------------------------------------------------------------
        | Admin Role Check
        |--------------------------------------------------------------------------
        |
        | Even if the email/password is correct,
        | a resident account cannot use the Admin Portal.
        |
        */

        if (
            !$user
            || $user->role !== 'admin'
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
                        'This account does not have administrator access.',
                ])

                ->onlyInput(
                    'email'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Successful Admin Login
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->intended(
                route('dashboard')
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Admin Logout
    |--------------------------------------------------------------------------
    */

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
            ->route('admin.login')
            ->with(
                'success',
                'You have been signed out successfully.'
            );
    }
}