<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use App\Models\UserRole;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        $roles = Roles::all();
        return view('home', compact('users', 'roles'));
    }

    public function unauthorized() {
        return view('index')->with([
            'message' => "Geen bevoegdheid, neem contact op met de beheerder",
            'method' => "error"
        ]);
    }

    public function create(Request $request)
    {

    }

    public function edit($id)
    {
        //
    }
}
