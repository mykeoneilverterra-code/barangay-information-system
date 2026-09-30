<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class ResidentAnnouncementController extends Controller
{
    public function index(Request $request)
    {
        $announcements = Announcement::query()
            ->published()
            ->orderByDesc('announcement_date')
            ->orderByDesc('id')
            ->paginate(12);

        return view(
            'resident_portal.announcements.index',
            compact('announcements')
        );
    }
}