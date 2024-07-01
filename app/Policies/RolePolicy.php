<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
    public function before(User $user, string $ability): bool|null
    {
        //protect user and admin role from updating
        // dump($ability);
        // if ($ability == 'update') return null;

        $userPermissions = $this->getRolePermissions($user->role_id);

        return in_array('manage_roles', $userPermissions);
    }

    private function getRolePermissions($roleId): array
    {
        $p = Role::findOrFail($roleId)->permissions()->get();
        return $p->pluck('name')->toArray();
    }

    public function all(User $user)
    {
        //
    }

    public function update(User $user, Role $role)
    {
        dump($role);
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
        //
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
