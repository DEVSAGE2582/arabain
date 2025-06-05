<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    // Show all users
    public function index()
    {
        $users = User::with('roles')->get();
        return view('manage_user.index', compact('users'));
    }

    // Show form to create user
    public function create()
{
    $roles = Role::all();
    return view('manage_user.create', compact('roles'));
}


public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('users.index')->with('success', 'User deleted successfully.');
}



public function generateUsername()
{
    $prefix = 'HJS';
    $random = rand(100, 999);

    $username = $prefix . $random;

    // Check uniqueness
    $original = $username;
    $counter = 1;
    while (\App\Models\User::where('username', $username)->exists()) {
        $username = $original . $counter;
        $counter++;
    }

    return response()->json(['username' => $username]);
}


    // Store new user
    public function store(Request $request)
{
    // dd($request->all());
    $request->validate([
        'username' => 'required|string|unique:users,username',
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
        'role' => 'required|string|exists:roles,name',
        'active_date' => 'required',

    ]);

    $user = User::create([
        'username' => $request->username,
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'active'=>$request->active,
        'active_date'=>$request->active_date,

    ]);

    $user->assignRole($request->role);

    return redirect()->route('users.index')->with('success', 'User created successfully.');
}

    public function edit(User $user)
{
    $roles = \Spatie\Permission\Models\Role::all();
    return view('manage_user.edit', compact('user', 'roles'));
}


    public function update(Request $request, User $user)
{
    // dd($request->all());
    $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        'email' => 'required|email|unique:users,email,' . $user->id,
        'roles' => 'nullable|array',
    ]);

    $user->update([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'active'=>$request->active,
        'active_date'=>$request->active_date,


    ]);
    $user->syncRoles($request->role ?? []);
    // dd($user->syncRoles($request->roles ?? []));
    

    return redirect()->route('users.index')->with('success', 'User updated successfully.');
}

}
