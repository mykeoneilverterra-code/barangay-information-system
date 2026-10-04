<?php

namespace App\Providers;

use App\Models\Announcement;
use App\Models\DocumentRequest;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ResidentAnnouncementServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Resident Announcement Routes
        |--------------------------------------------------------------------------
        */

        $this->loadRoutesFrom(
            base_path('routes/resident_announcements.php')
        );


        /*
        |--------------------------------------------------------------------------
        | Resident Dashboard Data
        |--------------------------------------------------------------------------
        */

        View::composer(
            'resident_portal.dashboard',
            function ($view) {

                /*
                |--------------------------------------------------------------------------
                | Latest Published Announcements
                |--------------------------------------------------------------------------
                */

                $latestAnnouncements =
                    Announcement::query()
                        ->published()
                        ->orderByDesc('announcement_date')
                        ->orderByDesc('id')
                        ->take(4)
                        ->get();


                /*
                |--------------------------------------------------------------------------
                | Default
                |--------------------------------------------------------------------------
                */

                $readyForPickupRequests =
                    collect();


                /*
                |--------------------------------------------------------------------------
                | Logged-In Resident
                |--------------------------------------------------------------------------
                */

                $user =
                    auth()->user();


                if (
                    $user
                    &&
                    $user->resident
                ) {

                    $residentId =
                        $user
                            ->resident
                            ->id;


                    /*
                    |--------------------------------------------------------------------------
                    | Ready for Release Requests
                    |--------------------------------------------------------------------------
                    |
                    | Do not filter payment here.
                    |
                    | The alert view will determine whether:
                    |
                    | - cash is still unpaid
                    | - payment is already completed
                    | - payment is not required
                    |
                    */

                    $readyForPickupRequests =
                        DocumentRequest::query()
                            ->where(
                                'resident_id',
                                $residentId
                            )
                            ->where(
                                'status',
                                'Ready for Release'
                            )
                            ->orderByDesc(
                                'date_requested'
                            )
                            ->orderByDesc('id')
                            ->get();

                }


                /*
                |--------------------------------------------------------------------------
                | Pass Data
                |--------------------------------------------------------------------------
                */

                $view->with([
                    'latestAnnouncements' =>
                        $latestAnnouncements,

                    'readyForPickupRequests' =>
                        $readyForPickupRequests,
                ]);
            }
        );
    }
}