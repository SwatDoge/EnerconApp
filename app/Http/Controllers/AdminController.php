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
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Roles::all();
        $userRoles = UserRole::all()->where('user_id', );
        return view('admin.index')->with([
            'users' => User::paginate(5),
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);

    }

    public function roles() 
    {
        $roles = Roles::all();
        return view('admin.roles.roles')->with('roles', $roles);
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

        return redirect('/admin/roles');

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
        return redirect('/admin/roles');
    }

    public function deleterole($id)
    {
        $role = Roles::find($id);
        $role->delete();
        return redirect('/admin/roles');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        return redirect()->route('aIndex');
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
        return redirect()->route('aIndex');
    }
}
