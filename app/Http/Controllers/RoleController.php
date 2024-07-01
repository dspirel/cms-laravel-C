<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function index(): View
    {
        $roles = Role::all();
        //sort by active column
        $sorted = $roles->sortByDesc('active');
        //$sorted->values()->all();

        return view('dashboard.roles.index', ['roles' => $sorted]);
    }

    public function edit($id): View
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $current_permissions = $role->permissions()->get();

        return view('dashboard.roles.edit', compact('role', 'permissions', 'current_permissions'));
    }

    public function update($id, Request $request): RedirectResponse
    {
        $permissions = $request->except('_token', '_method', 'name', 'active');
        //check if atleast one permission checkbox ticked
        if (empty($permissions)) {
            return back()->withErrors(['err' => 'Atleast one permission required.']);
        }

        $request->validate([
            'name' => ['required', Rule::unique('roles')->ignore($id)]
        ]);

        $role = Role::findOrFail($id);
        $role->update(['name' => $request->name, 'active' => $request->has('active')]);
        $role->permissions()->sync(array_values($permissions));

        return redirect('/dashboard/roles');
    }

    public function create(): View
    {
        $permissions = Permission::all();

        return view('dashboard.roles.create', compact('permissions'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:roles'
        ]);
        //check if atleast one permission checkbox ticked
        if (empty($request->except('_token', 'name'))) {
            return back()->withErrors(['err' => 'Atleast one permission required.']);
        }

        //insert new role
        $role = Role::create(['name' => $request->name]);

        //assign permissions to role
        $permissions = $request->except(['_token', 'name']);
        $role->permissions()->attach(array_values($permissions));

        return redirect('/dashboard/roles');
    }

    public function destroy($id): RedirectResponse
    {
        $role = Role::findOrFail($id);
        //clean pivot table
        $role->permissions()->detach();

        //change users with this role to 'user' role
        $this->changeUsersRoleBeforeDelete($role);

        $role->delete();
        return redirect('/dashboard/roles');
    }

    private function changeUsersRoleBeforeDelete($role): void
    {
        $users = User::where('role_id', $role->id)->get();

        foreach ($users as $user) {
            $user->role_id = 1;
            $user->save();
        }
    }

}
