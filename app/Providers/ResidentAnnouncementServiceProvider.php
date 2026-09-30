<?php

namespace App\Providers;

use App\Models\Announcement;
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
            base_path(
                'routes/resident_announcements.php'
            )
        );


        /*
        |--------------------------------------------------------------------------
        | Resident Dashboard Announcements
        |--------------------------------------------------------------------------
        |
        | Automatically provides the latest four published announcements
        | whenever the resident dashboard is rendered.
        |
        */

        View::composer(
            'resident_portal.dashboard',
            function ($view) {

                $latestAnnouncements =
                    Announcement::query()
                        ->published()
                        ->orderByDesc(
                            'announcement_date'
                        )
                        ->orderByDesc('id')
                        ->take(4)
                        ->get();


                $view->with(
                    'latestAnnouncements',
                    $latestAnnouncements
                );
            }
        );
    }
}