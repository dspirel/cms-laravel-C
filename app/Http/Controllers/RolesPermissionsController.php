<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RolesPermissionsController extends Controller
{
    public function test()
    {
        $this->createNewRole();
        //$this->addPermissionsToRole(1, ['manage_own_comments']);
        //add new permission
        //Permission::create(['name'=>'manage_own_pages','description'=>'Create and edit own pages.']);

        //remove from pivot table detach(id from permission)
        // $roles = Role::find(1);
        // $roles->permissions()->detach(2);
    }

    public function showRoles()
    {
        $roles = Role::all();
        return view('admin.show-roles', compact('roles'));
    }

    public function showRoleForm()
    {
        return view('admin.create-role');
    }

    public function createNewRole()//TODO !!! form request
    {
        $newRoleName = 'journalist';

        Role::create(['name'=> $newRoleName]);

        $role = Role::where('name', $newRoleName)->first();
        $this->addPermissionsToRole($role->id, ['manage_own_pages','manage_own_comments']);

    }

    public function addPermissionsToRole(int $roleId, array $permissions)
    {
        $role = Role::findOrFail($roleId);

        foreach ($permissions as $p) {
            $role->permissions()->attach($this->getPermissionId($p));
        }
    }

    public function getPermissionId(string $name)
    {
        //TODO get all permissions than return needed ids
        $permission = Permission::where('name', $name)->first();
        return $permission->id;
    }
}
