<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\DocumentRequest;
use App\Models\Resident;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today =
            now('Asia/Manila')
                ->startOfDay();


        $totalResidents =
            Resident::count();


        $registeredVoters =
            Resident::query()
                ->where(
                    'is_voter',
                    true
                )
                ->count();


        $totalAreas =
            Resident::query()
                ->whereNotNull('area')
                ->where('area', '!=', '')
                ->distinct()
                ->count('area');


        $skOldestBirthDate =
            $today
                ->copy()
                ->subYears(31)
                ->addDay()
                ->toDateString();


        $skYoungestBirthDate =
            $today
                ->copy()
                ->subYears(15)
                ->toDateString();


        $regularVoterCutoff =
            $today
                ->copy()
                ->subYears(18)
                ->toDateString();


        $skVoters =
            Resident::query()
                ->where(
                    'is_voter',
                    true
                )
                ->whereNotNull(
                    'birth_date'
                )
                ->whereBetween(
                    'birth_date',
                    [
                        $skOldestBirthDate,
                        $skYoungestBirthDate,
                    ]
                )
                ->count();


        $regularVoters =
            Resident::query()
                ->where(
                    'is_voter',
                    true
                )
                ->whereNotNull(
                    'birth_date'
                )
                ->whereDate(
                    'birth_date',
                    '<=',
                    $regularVoterCutoff
                )
                ->count();


        $skVoterPercentage =
            $totalResidents > 0
                ? round(
                    (
                        $skVoters
                        / $totalResidents
                    ) * 100
                )
                : 0;


        $regularVoterPercentage =
            $totalResidents > 0
                ? round(
                    (
                        $regularVoters
                        / $totalResidents
                    ) * 100
                )
                : 0;


        $areaDistribution =
            Resident::query()
                ->select(
                    'area',
                    DB::raw(
                        'COUNT(*) as total'
                    )
                )
                ->whereNotNull('area')
                ->where('area', '!=', '')
                ->groupBy('area')
                ->orderByDesc('total')
                ->orderBy('area')
                ->take(6)
                ->get();


        $maxAreaCount =
            max(
                1,
                (int) (
                    $areaDistribution
                        ->max('total')
                    ?? 1
                )
            );


        $latestDocumentRequests =
            DocumentRequest::query()
                ->with('resident')
                ->orderByDesc(
                    'date_requested'
                )
                ->orderByDesc('id')
                ->take(5)
                ->get();


        $pendingDocumentRequests =
            DocumentRequest::query()
                ->where(
                    'status',
                    'Pending'
                )
                ->count();


        /*
        |--------------------------------------------------------------------------
        | Latest Published Announcements
        |--------------------------------------------------------------------------
        |
        | Dashboard preview only.
        | Complete list is available in Announcements management.
        |
        */

        $announcements =
            Announcement::query()
                ->published()
                ->orderByDesc(
                    'announcement_date'
                )
                ->orderByDesc('id')
                ->take(2)
                ->get();


        return view(
            'dashboard',
            compact(
                'totalResidents',
                'registeredVoters',
                'totalAreas',
                'skVoters',
                'regularVoters',
                'skVoterPercentage',
                'regularVoterPercentage',
                'areaDistribution',
                'maxAreaCount',
                'latestDocumentRequests',
                'pendingDocumentRequests',
                'announcements'
            )
        );
    }
}