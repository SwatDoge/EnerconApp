<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Roles;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Roles::all();
        $userRoles = UserRole::all();
        return view('admin.index')->with([
            'users' => User::all(),
            'roles' => $roles,
            'userRoles' => $userRoles,
            'message' => "Gebruikers geladen",
            'method' => "info"
        ]);

    }

    public function roles()
    {
        $roles = Roles::all();
        return view('admin.roles.roles')->with([
            'roles'=> $roles,
            'message' => "Rollen geladen",
            'method' => "success"
        ]);
    }

    public function createrole()
    {
        return view('admin.roles.createrole');
    }

    public function insertrole(Request $request)
    {

        $this->validate($request, [
            'addRole' => 'required',
        ]);

        $Role = new Roles;
        $Role->role = $request->input('addRole');
        $Role->save();

        return view('admin.roles.roles')->with([
            'roles' => Roles::all(),
            'message' => "Rol toegevoegd",
            'method' => "success"
        ]);

    }

    public function editrole($id)
    {
        $role = Roles::find($id);
        return view('admin.roles.editrole')->with('role', $role);
    }

    public function changerole(Request $request, $role)
    {
        $newRolename = Roles::find($role);
        $this->validate($request, [
            'newrolename' => 'required',
        ]);

        $newRolename->role = $request->input('newrolename');
        $newRolename->save();
        return view('admin.roles.roles')->with([
            'roles' => Roles::all(),
            'message' => "Rol bijgewerkt",
            'method' => "success"
        ]);
    }

    public function deleterole($id)
    {
        $role = Roles::find($id);
        $role->delete();
        return view('admin.roles.roles')->with([
            'roles' => Roles::all(),
            'message' => "Rol verwijderd",
            'method' => "success"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Roles::all();
        return view('admin.users.create')->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'pnumber' => 'required',

        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make('Welkom123');
        $user->phonenumber = $request->input('pnumber');
        $user->save();

        if(!empty($role)) {
            $newRole = new UserRole;
            $newRole->user_id = $user->id;
            $newRole->role_id = $request->roles[0];
            $newRole->save();
        }


        return view('admin.index')->with([
            'roles' => Roles::all(),
            'userRoles' => UserRole::all(),
            'users' => User::all(),
            'message' => "Gebruiker toegevoegd",
            'method' => "success"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.edit')->with([
            'user' => $user,
            'roles' => Roles::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        User::find($request->id)->update($request->validate([
            'name' => 'required',
            'email' => 'required'
        ]));

        if(!empty($role)) {
            $newRole = new UserRole;
            $newRole->user_id = $request->id;
            $newRole->role_id = $request->roles[0];
            $newRole->save();
        }
        return view('admin.index')->with([
            'roles' => Roles::all(),
            'userRoles' => UserRole::all(),
            'users' => User::all(),
            'message' => "Gebruiker bijgewerkt",
            'method' => "success"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return view('admin.index')->with([
            'roles' => Roles::all(),
            'userRoles' => UserRole::all(),
            'users' => User::all(),
            'message' => "Gebruiker verwijderd",
            'method' => "success"
        ]);
    }
}
