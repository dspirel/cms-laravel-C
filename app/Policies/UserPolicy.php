<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Role;

class UserPolicy
{
    public function before(User $user, string $ability): bool|null
    {
        //get role
        $userRole = Role::findOrFail($user->role_id);
        //check active
        if ($userRole->active == false) return false;

        $userPermissions = $this->getRolePermissions($userRole);

        return in_array('manage_users', $userPermissions);
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
    public function view(User $user, User $model)
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
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }
}
