<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnnouncementRequest;
use App\Http\Requests\UpdateAnnouncementRequest;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        $query = Announcement::query();

        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($query) use ($search) {
                $query
                    ->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where(
                'category',
                $request->category
            );
        }

        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->status
            );
        }

        $announcements = $query
            ->orderByDesc('announcement_date')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        $totalAnnouncements =
            Announcement::count();

        $publishedAnnouncements =
            Announcement::where(
                'status',
                'Published'
            )->count();

        $draftAnnouncements =
            Announcement::where(
                'status',
                'Draft'
            )->count();

        return view(
            'announcements.index',
            compact(
                'announcements',
                'totalAnnouncements',
                'publishedAnnouncements',
                'draftAnnouncements'
            )
        );
    }

    public function create()
    {
        return view('announcements.create');
    }

    public function store(
        StoreAnnouncementRequest $request
    ) {
        Announcement::create(
            $request->validated()
        );

        return redirect()
            ->route('announcements.index')
            ->with(
                'success',
                'Announcement created successfully.'
            );
    }

    public function show(
        Announcement $announcement
    ) {
        return view(
            'announcements.show',
            compact('announcement')
        );
    }

    public function edit(
        Announcement $announcement
    ) {
        return view(
            'announcements.edit',
            compact('announcement')
        );
    }

    public function update(
        UpdateAnnouncementRequest $request,
        Announcement $announcement
    ) {
        $announcement->update(
            $request->validated()
        );

        return redirect()
            ->route('announcements.index')
            ->with(
                'success',
                'Announcement updated successfully.'
            );
    }

    public function destroy(
        Announcement $announcement
    ) {
        $announcement->delete();

        return redirect()
            ->route('announcements.index')
            ->with(
                'success',
                'Announcement deleted successfully.'
            );
    }
}