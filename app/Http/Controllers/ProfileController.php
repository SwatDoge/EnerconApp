<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function index() {
        $user = Auth::user();
        return view('profile.index')->with([
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user) {
        User::find($request->id)->update($request->validate([
            'name' => 'required',
            'email' => 'required'
        ]));

        return view('profile.index')->with([
            'user' => Auth::user(),
            'message' => "Profiel bijgewerkt",
            'method' => "success"
        ]);
    }
}
