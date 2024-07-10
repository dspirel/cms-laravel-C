<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Role;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Policy
        Gate::authorize('all', User::class);

        $users = User::all();
        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Policy
        Gate::authorize('all', User::class);

        $roles = Role::all();
        return view('dashboard.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
    {
        //Policy
        Gate::authorize('all', User::class);

        //check if role selected
        if (empty($request->role)) return back()->withErrors(['err' => 'Role required.']);

        $user = User::create($request->validated());
        $user->role_id = $request->role;
        $user->save();

        return redirect('/dashboard/users');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //Policy
        Gate::authorize('all', User::class);

        $roles = Role::all();
        return view('dashboard.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //Policy
        Gate::authorize('all', User::class);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:16'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => ['required']
        ]);
        //TODO  ----- use fill() -------------
        $user->update($validated);
        $user->role_id = $validated['role'];
        $user->save();

        return redirect('/dashboard/users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //Policy
        Gate::authorize('all', User::class);

        $user->delete();

        return redirect('/dashboard/users');
    }
}
