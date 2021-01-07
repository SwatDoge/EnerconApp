<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use App\Models\RoleUser;
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

    public function create(Request $request)
    {
        $this->validate($request, [
            'addRole' => 'required',
        ]);

        $Role = new Roles;
        $Role->role = $request->input('addRole');
        $Role->save();

        return redirect('/home');

    }

    public function edit($id)
    {
        $role = Roles::find($id);
        return view('show')->with('role', $role);
    }

    public function edit1(Request $request, $role)
    {
        $newRole = Roles::find($role);
       $this->validate($request, [
           'newrolename' => 'required',
       ]);
        $newRole->role = $request->input('newrolename');
        $newRole->save();
        
        return view('show')->with('role', $role);
    }

    public function insert(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'rolename' => 'required',
        ]); 
        
        $newRole = new RoleUser;
        $newRole->user_id = $request->input('username');
        $newRole->role_id = $request->input('rolename');
        $newRole->save();
        return redirect('/home');

        
    }
}
