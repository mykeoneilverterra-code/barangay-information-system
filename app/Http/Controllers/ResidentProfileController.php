<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ResidentProfileController extends Controller
{
    /**
     * Display the logged-in resident's profile.
     */
    public function show()
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Must Be A Linked Resident Account
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $user
            && $user->role === 'resident'
            && $user->resident_id
            && $user->resident,
            403
        );


        $resident = $user->resident;


        return view(
            'resident_portal.profile',
            compact('resident')
        );
    }
}