<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;



class LinkController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            if ((Auth::user()->user_type == 0 || Auth::user()->user_type == 2) && Auth::user()->email_verified_at != NULL) {
                $links = Link::all();
                return view('links.index', compact('links'));
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

                return view('links.create');
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
                    'subtitle' => 'required|max:255',
                    'hyperlink' => 'required|max:255',
                    'title' => 'required|max:255',
                    'file' => 'required|image|mimes:jpeg,jpg,png,gif|max:4096'
                ]);
                $link = new Link();
                $link->title = $request->title;
                $link->subtitle = $request->subtitle;
                $link->hyperlink = $request->hyperlink;

                $image = $request->file('file');
                $imageName = time() . '.' . $image->extension();
                $image->move(public_path('img'), $imageName);
                $link->image = $imageName;
                $link->save();
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

                $link = Link::find($id);
                return view('links.edit', compact('link'));
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

                $link = Link::find($id);
                $request->validate([
                    'title' => 'required|max:255',
                    'subtitle' => 'required|max:255',
                    'hyperlink' => 'required|max:255',
                    'title' => 'required|max:255',
                    'file' => 'required|image|mimes:jpeg,jpg,png,gif|max:4096'
                ]);
                $link->title = $request->title;
                $link->subtitle = $request->subtitle;
                $link->hyperlink = $request->hyperlink;

                $image = $request->file('file');
                $imageName = time() . '.' . $image->extension();
                $image->move(public_path('img'), $imageName);
                $link->image = $imageName;
                $link->save();
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

                $link = Link::find($id);
                $directory = 'img/' . $link->image;
                if (File::exists($directory)) {
                    File::delete($directory);
                }
                $link->delete();
                return back()->with('deleted', '');
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
}
