<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DocumentTemplate;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        $templates = DocumentTemplate::all()->keyBy('type');
        return view('admin.users.index', compact('users', 'templates'));
    }

    public function dashboard()
    {
        $users = User::with('roles')->orderBy('created_at', 'desc')->paginate(5);
        return view('admin.dashboard', compact('users'));
    }
    
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'nullable|string|max:100',
            'position'   => 'required|string|max:100',
            'nik'        => 'required|string|max:50|unique:users,nik',
            'desc'       => 'nullable|string',
            'email'      => 'required|email|unique:users,email',
            'role'       => 'required|string|in:admin,analis,supervisor',
            'password'   => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name'  => $validated['last_name'],
            'position'   => $validated['position'],
            'nik'        => $validated['nik'],
            'desc'       => $validated['desc'] ?? null,
            'name'       => $validated['first_name'] . ' ' . $validated['last_name'],
            'email'      => $validated['email'],
            'password'   => Hash::make($validated['password']),
        ]);

        $user->assignRole($validated['role']); // pake spatie

        return redirect()->route('users.index')->with('success','User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'role' => 'required|in:admin,analis,supervisor',
            'first_name' => 'nullable|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'position' => 'nullable|string|max:100',
            'nik' => 'nullable|string|max:50',
            'desc' => 'nullable|string',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);
        $user->syncRoles([$validated['role']]); // update role

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('ok', 'User berhasil dihapus');
    }
}
