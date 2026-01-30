<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Company;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::all();
        $users = User::with('company');

        if ($request->has('role')) {
            $users->whereHas('roles', function ($query) use ($request) {
                $query->where('name', $request->role);
            });
        }

        $users = $users->get();

        return view('users.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();
        $companies = Company::all();
        return view('users.create', compact('roles', 'companies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|exists:roles,id',
            'company_id' => 'nullable|exists:companies,id',
        ]);
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'company_id' => $request->company_id,
        ]);
        $user->roles()->attach($validated['role']);
        return redirect('/users')->with('success', 'Usuario creado correctamente');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $companies = Company::all();
        return view('users.edit', compact('user', 'roles', 'companies'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'company_id' => 'nullable|exists:companies,id',
        ]);
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'company_id' => $request->company_id,
        ]);
        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
            $user->save();
        }
        return redirect('/users')->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/users')->with('success', 'Usuario eliminado correctamente');
    }
}
