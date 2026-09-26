<?php

namespace App\Http\Controllers;

use App\Models\DocumentRequest;
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

        $totalResidents = Resident::count();


        $registeredVoters = Resident::query()
            ->where('is_voter', true)
            ->count();


        $totalAreas = Resident::query()
            ->whereNotNull('area')
            ->where('area', '!=', '')
            ->distinct()
            ->count('area');


        /*
        |--------------------------------------------------------------------------
        | Voter Classification
        |--------------------------------------------------------------------------
        |
        | SK group:
        | Registered voters aged 15–30.
        |
        | Regular voter group:
        | Registered voters aged 18 and above.
        |
        | Note:
        | Residents aged 18–30 can belong to both groups.
        |
        */

        $skVoters = Resident::query()
            ->where('is_voter', true)
            ->whereNotNull('birth_date')
            ->whereRaw(
                'TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 15 AND 30'
            )
            ->count();


        $regularVoters = Resident::query()
            ->where('is_voter', true)
            ->whereNotNull('birth_date')
            ->whereRaw(
                'TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) >= 18'
            )
            ->count();


        $skVoterPercentage = $totalResidents > 0
            ? round(($skVoters / $totalResidents) * 100)
            : 0;


        $regularVoterPercentage = $totalResidents > 0
            ? round(($regularVoters / $totalResidents) * 100)
            : 0;


        /*
        |--------------------------------------------------------------------------
        | Resident Distribution By Location
        |--------------------------------------------------------------------------
        */

        $areaDistribution = Resident::query()
            ->select(
                'area',
                DB::raw('COUNT(*) as total')
            )
            ->whereNotNull('area')
            ->where('area', '!=', '')
            ->groupBy('area')
            ->orderByDesc('total')
            ->orderBy('area')
            ->take(6)
            ->get();


        $maxAreaCount = max(
            1,
            (int) ($areaDistribution->max('total') ?? 1)
        );


        /*
        |--------------------------------------------------------------------------
        | Latest Document Requests
        |--------------------------------------------------------------------------
        */

        $latestDocumentRequests = DocumentRequest::query()
            ->with('resident')
            ->latest('date_requested')
            ->latest('id')
            ->take(5)
            ->get();


        $pendingDocumentRequests = DocumentRequest::query()
            ->where('status', 'Pending')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Dashboard Announcements
        |--------------------------------------------------------------------------
        |
        | Temporary dashboard content.
        | We can convert this into a database-backed module later.
        |
        */

        $announcements = [

            [
                'title' => 'Clean-Up Drive',
                'description' =>
                    'Barangay-wide clean-up drive this Saturday. Let’s keep our community clean and green!',
                'date' => 'Sep 25, 2026',
                'category' => 'Community',
                'type' => 'community',
                'icon' => 'leaf',
            ],

            [
                'title' => 'SK Assembly',
                'description' =>
                    'SK Assembly Meeting on September 28, 2026 at the Barangay Hall.',
                'date' => 'Sep 24, 2026',
                'category' => 'Youth',
                'type' => 'youth',
                'icon' => 'people',
            ],

            [
                'title' => 'Vaccination Day',
                'description' =>
                    'Free vaccination program for children and senior citizens. See schedules for more details.',
                'date' => 'Sep 22, 2026',
                'category' => 'Health',
                'type' => 'health',
                'icon' => 'health',
            ],

            [
                'title' => 'Council Meeting',
                'description' =>
                    'Regular Barangay Council Meeting on September 30, 2026 at 9:00 AM.',
                'date' => 'Sep 20, 2026',
                'category' => 'Government',
                'type' => 'government',
                'icon' => 'document',
            ],

        ];


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