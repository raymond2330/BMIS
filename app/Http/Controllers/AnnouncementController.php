<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Link;
use App\Models\Video;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class AnnouncementController extends Controller
{
    // CLIENT SIDE
    public function history()
    {
        $announcements = Announcement::all();
        $links = Link::all();
        $videos = Video::all();
        return view('about.history', compact('announcements', 'links', 'videos'));
    }
    public function logo()
    {
        $announcements = Announcement::all();
        $links = Link::all();
        $videos = Video::all();
        return view('about.logo', compact('announcements', 'links', 'videos'));
    }
    public function mission_vision()
    {
        $announcements = Announcement::all();
        $links = Link::all();
        $videos = Video::all();
        return view('about.mission-vision', compact('announcements', 'links', 'videos'));
    }
    public function key_officials()
    {
        $announcements = Announcement::all();
        $links = Link::all();
        $videos = Video::all();
        return view('about.key-officials', compact('announcements', 'links', 'videos'));
    }
    public function secretary()
    {
        $announcements = Announcement::all();
        $links = Link::all();
        $videos = Video::all();
        return view('about.secretary', compact('announcements', 'links', 'videos'));
    }
    public function org_structure()
    {
        $announcements = Announcement::all();
        $links = Link::all();
        $videos = Video::all();
        return view('about.org-structure', compact('announcements', 'links', 'videos'));
    }
    public function view($id)
    {
        $announcements = Announcement::all();
        $links = Link::all();
        $videos = Video::all();
        $announcement = Announcement::find($id);
        return view('barangay-385.announcement', compact('announcement', 'announcements', 'links', 'videos'));
    }
    // SERVER SIDE
    public function admin_panel()
    {
        return view('barangay-385.admin-panel');
    }
    public function index()
    {
        if (Auth::id()) {
            if ((Auth::user()->user_type == 0 || Auth::user()->user_type == 2) && Auth::user()->email_verified_at != NULL) {
                $announcements = Announcement::all();
                return view('announcements.index', compact('announcements'));
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function create()
    {
        if (Auth::id()) {
            if ((Auth::user()->user_type == 0 || Auth::user()->user_type == 2) && Auth::user()->email_verified_at != NULL) {
                return view('announcements.create');
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function store(Request $request)
    {
        if (Auth::id()) {
            if ((Auth::user()->user_type == 0 || Auth::user()->user_type == 2) && Auth::user()->email_verified_at != NULL) {
                $request->validate([
                    'title' => 'required|max:255',
                    'announcement' => 'required|max:30000'
                ]);
                $announcement = new Announcement();
                $announcement->title = $request->title;
                $announcement->announcement = $request->announcement;
                $announcement->save();
                return back()->with('success', '');
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function edit($id)
    {
        if (Auth::id()) {
            if ((Auth::user()->user_type == 0 || Auth::user()->user_type == 2) && Auth::user()->email_verified_at != NULL) {
                $announcement = Announcement::find($id);
                return view('announcements.edit', compact('announcement'));
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function update(Request $request, $id)
    {
        if (Auth::id()) {
            if ((Auth::user()->user_type == 0 || Auth::user()->user_type == 2) && Auth::user()->email_verified_at != NULL) {
                $request->validate([
                    'title' => 'required|max:255',
                    'announcement' => 'required|max:30000'
                ]);
                $announcement = Announcement::find($id);
                $announcement->title = $request->title;
                $announcement->announcement = $request->announcement;
                $announcement->save();
                return back()->with('success', '');
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function destroy($id)
    {
        if (Auth::id()) {
            if ((Auth::user()->user_type == 0 || Auth::user()->user_type == 2) && Auth::user()->email_verified_at != NULL) {
                $announcement = Announcement::find($id);
                $announcement->delete();
                return back()->with('deleted', '');
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
}
