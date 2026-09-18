<?php

namespace App\Http\Controllers;

use App\Models\Household;
use App\Models\Resident;

class DashboardController extends Controller
{
    public function index()
    {
        $totalHouseholds = Household::count();

        $totalResidents = Resident::count();

        $registeredVoters = Resident::where('is_voter', true)->count();

        $householdHeads = Resident::where('is_household_head', true)->count();

        $recentResidents = Resident::with('household')
            ->latest()
            ->take(5)
            ->get();

        $recentHouseholds = Household::latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalHouseholds',
            'totalResidents',
            'registeredVoters',
            'householdHeads',
            'recentResidents',
            'recentHouseholds'
        ));
    }
}