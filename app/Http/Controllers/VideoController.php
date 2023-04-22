<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            if ((Auth::user()->user_type == 0 || Auth::user()->user_type == 2) && Auth::user()->email_verified_at != NULL) {

                $videos = Video::all();
                $videos_count = Video::count();
                return view('videos.index', compact('videos', 'videos_count'));
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

                return view('videos.create');
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
                    'title' => 'required|max:255'
                ]);
                $video = new Video();
                $video->title = $request->title;
                $video->save();
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

                $video = Video::find($id);
                return view('videos.edit', compact('video'));
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

                $video = Video::find($id);
                $request->validate([
                    'title' => 'required|max:255'
                ]);
                $video->title = $request->title;
                $video->save();
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
                $video = Video::find($id);
                $video->delete();
                return back()->with('deleted', '');
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
}
