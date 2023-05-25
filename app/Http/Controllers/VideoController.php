<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAnnouncement');
    }
    public function index()
    {
        $videos = Video::all();
        $videos_count = Video::count();
        return view('videos.index', compact('videos', 'videos_count'));
    }
    public function create()
    {
        return view('videos.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255'
        ]);
        $video = new Video();
        $video->title = $request->title;
        $video->save();
        return back()->with('success', '');
    }
    public function edit($id)
    {
        $video = Video::find($id);
        return view('videos.edit', compact('video'));
    }
    public function update(Request $request, $id)
    {
        $video = Video::find($id);
        $request->validate([
            'title' => 'required|max:255'
        ]);
        $video->title = $request->title;
        $video->save();
        return back()->with('success', '');
    }
    public function destroy($id)
    {
        $video = Video::find($id);
        $video->delete();
        return back()->with('deleted', '');
    }
}
