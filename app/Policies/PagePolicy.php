<?php

namespace App\Policies;

use App\Models\Page;
use App\Models\User;
use App\Models\Role;

class PagePolicy
{
    public function before(User $user, string $ability): bool|null
    {
        //get role
        $userRole = Role::findOrFail($user->role_id);
        //check active
        if ($userRole->active == false) return false;

        $userPermissions = $this->getRolePermissions($userRole);

        if (in_array('manage_ALL_pages', $userPermissions)) return true;

        if (in_array('manage_OWN_pages', $userPermissions)) return null;

        return false;
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

    public function index(User $user): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function actionOwn(User $user, Page $page)
    {
        return $page->created_by === $user->id;
    }

}
