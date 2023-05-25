<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('isMaster');
    }
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
    public function create()
    {
        return view('users.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_type' => 'required|in:0,1,2,3',
            'name' => 'required|regex:/^[\pL\s]+$/u|max:255',
            'email' => 'email',
            'password' => ['required', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised(5)],
            'admin_password' => 'required|current_password'
        ]);
        $user = new User();
        $user->user_type = $request->user_type;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->email_verified_at = now();
        if ($request) {
            $user->save();
            return back()->with('success', "");
        }
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_type' => 'required|in:0,1,2,3',
            'name' => 'required|regex:/^[\pL\s]+$/u|max:255',
            'email' => 'email',
            'password' => ['required', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised(5)],
            'admin_password' => 'required|current_password'
        ]);
        $user = User::find($id);
        $user->user_type = $request->user_type;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->email_verified_at = now();
        if ($request) {
            $user->save();
            return back()->with('success', "");
        }
    }
    public function destroy(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'password' => 'required|current_password'
        ]);
        if ($request) {
            $user->delete();
            return back()->with('deleted', "");
        } else {
            return back()->with('failed', "");
        }
    }
}
