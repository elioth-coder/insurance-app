<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::all();

        return view('announcements.index', [
            'announcements' => $announcements,
        ]);
    }

    public function create()
    {
        return view('announcements.create');
    }

    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);

        return view('announcements.edit', [
            'announcement' => $announcement
        ]);
    }
    public function store(Request $request)
    {
        $announcementAttributes = $request->validate([
            'title'   => ['required'],
            'content' => ['required'],
            'color'   => ['required'],
        ]);

        $announcement = Announcement::create($announcementAttributes);

        return redirect('/settings/announcements/create')->with([
            'message' => "Successfully added $announcement->title to announcements"
        ]);
    }

    public function update(Request $request, $id)
    {
        $announcement = Announcement::findOrFail($id);

        $announcementAttributes = $request->validate([
            'title'   => ['required'],
            'content' => ['required'],
            'color'   => ['required'],
        ]);

        $announcement->update($announcementAttributes);

        return redirect("/settings/announcements")->with([
            'message' => "Successfully updated announcement $announcement->title"
        ]);
    }

    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();

        return redirect("/settings/announcements")
            ->with([
                'message' => 'Successfully deleted the announcement ' . $announcement->title . '.',
            ]);
    }
}
