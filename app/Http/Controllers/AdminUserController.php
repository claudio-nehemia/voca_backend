<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    /**
     * Display a listing of admin users.
     */
    public function index()
    {
        $admins = User::where('role', 'admin')->latest()->paginate(10);
        return view('admin.users.index', compact('admins'));
    }

    /**
     * Store a newly created admin user in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', Password::defaults()],
            'is_active' => 'boolean',
        ]);

        $validatedData['password'] = Hash::make($request->password);
        $validatedData['role'] = 'admin';
        $validatedData['is_active'] = $request->has('is_active');

        User::create($validatedData);

        return redirect()
            ->route('admin-users.index')
            ->with('success', 'Admin user created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $adminUser)
    {
        return response()->json($adminUser);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $adminUser)
    {
        return response()->json($adminUser);
    }

    /**
     * Update the specified admin user in storage.
     */
    public function update(Request $request, User $adminUser)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $adminUser->id,
            'is_active' => 'boolean',
        ];

        if ($request->filled('password')) {
            $rules['password'] = ['required', Password::defaults()];
        }

        $validatedData = $request->validate($rules);

        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        } else {
            unset($validatedData['password']);
        }

        $validatedData['is_active'] = $request->has('is_active');

        $adminUser->update($validatedData);

        return redirect()
            ->route('admin-users.index')
            ->with('success', 'Admin user updated successfully.');
    }

    /**
     * Remove the specified admin user from storage.
     */
    public function destroy(User $adminUser)
    {
        // Prevent deleting self
        if (Auth::id() === $adminUser->id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $adminUser->delete();

        return redirect()
            ->route('admin-users.index')
            ->with('success', 'Admin user deleted successfully.');
    }
}
