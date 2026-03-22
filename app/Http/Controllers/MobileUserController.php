<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class MobileUserController extends Controller
{
    /**
     * Display a listing of all mobile users.
     */
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->latest()->paginate(10);
        return view('admin.mobile_users.index', compact('users'));
    }

    /**
     * Display a listing of users requesting activation (not yet active).
     */
    public function activationRequests()
    {
        $users = User::where('role', '!=', 'admin')
                     ->where('is_active', false)
                     ->latest()
                     ->paginate(10);
        return view('admin.mobile_users.requests', compact('users'));
    }

    /**
     * Quickly activate a user account.
     */
    public function activate(User $user)
    {
        $user->update(['is_active' => true]);
        
        return back()->with('success', "Akun {$user->name} berhasil diaktivasi.");
    }

    /**
     * Store a new mobile user.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', Password::defaults()],
            'class' => 'nullable|string|max:50',
            'is_active' => 'boolean',
        ]);

        $validatedData['password'] = Hash::make($request->password);
        $validatedData['role'] = 'user';
        $validatedData['is_active'] = $request->has('is_active');

        User::create($validatedData);

        return redirect()
            ->route('mobile-users.index')
            ->with('success', 'Mobile user created successfully.');
    }

    /**
     * Show/Edit data.
     */
    public function edit(User $mobileUser)
    {
        return response()->json($mobileUser);
    }

    /**
     * Update mobile user.
     */
    public function update(Request $request, User $mobileUser)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $mobileUser->id,
            'class' => 'nullable|string|max:50',
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

        $mobileUser->update($validatedData);

        return redirect()
            ->route('mobile-users.index')
            ->with('success', 'Mobile user updated successfully.');
    }

    /**
     * Delete user.
     */
    public function destroy(User $mobileUser)
    {
        $mobileUser->delete();
        return redirect()
            ->route('mobile-users.index')
            ->with('success', 'Mobile user deleted successfully.');
    }
}
