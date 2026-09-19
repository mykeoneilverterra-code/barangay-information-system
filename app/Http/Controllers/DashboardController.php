<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Main Statistics
        |--------------------------------------------------------------------------
        */

        $totalResidents =
            Resident::count();


        $registeredVoters =
            Resident::where(
                'is_voter',
                true
            )->count();


        $totalAreas =
            Resident::whereNotNull('area')
                ->where('area', '!=', '')
                ->distinct()
                ->count('area');


        $maleResidents =
            Resident::where(
                'sex',
                'Male'
            )->count();


        $femaleResidents =
            Resident::where(
                'sex',
                'Female'
            )->count();


        /*
        |--------------------------------------------------------------------------
        | Recent Residents
        |--------------------------------------------------------------------------
        */

        $recentResidents =
            Resident::latest()
                ->take(6)
                ->get();


        /*
        |--------------------------------------------------------------------------
        | Residents by Area
        |--------------------------------------------------------------------------
        */

        $areaDistribution =
            Resident::select(
                'area',
                DB::raw('COUNT(*) as total')
            )

            ->whereNotNull('area')
            ->where('area', '!=', '')

            ->groupBy('area')

            ->orderByDesc('total')
            ->orderBy('area')

            ->get();


        return view(
            'dashboard',
            compact(
                'totalResidents',
                'registeredVoters',
                'totalAreas',
                'maleResidents',
                'femaleResidents',
                'recentResidents',
                'areaDistribution'
            )
        );
    }
}