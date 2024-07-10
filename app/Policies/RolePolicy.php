<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;

class RolePolicy
{
    public function before(User $user, string $ability): bool|null
    {
        //get role
        $userRole = Role::findOrFail($user->role_id);
        //check active
        if ($userRole->active == false) return false;
        //get permissions
        $userPermissions = $this->getRolePermissions($userRole);
        //if has permission continue
        if (!in_array('manage_roles', $userPermissions)) return false;
        //protect user and admin role from updating,deleting
        $actions = ['update','delete']; //forceDelete???
        if (in_array($ability, $actions)) return null;

        return true;
    }

    private function getRolePermissions(Role $userRole): array
    {
        $permissions = $userRole->permissions()->get();
        return $permissions->pluck('name')->toArray();
    }

    public function all(User $user)
    {
        //
    }

    public function update(User $user, Role $role)
    {
        $protectedRoles = [1,2];
        return !in_array($role->id, $protectedRoles);
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Role $role)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        //
    }


    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Role $role)
    {
        $protectedRoles = [1,2];
        return !in_array($role->id, $protectedRoles);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Role $role)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Role $role)
    {
        //
    }
}
