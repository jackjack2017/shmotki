<?php


namespace Webmagic\Users;

use Webmagic\Users\Models\Role;
use Webmagic\Users\Models\Permission;

class RoleService
{
    /**
     * Return all users with roles
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return Role::all();
    }


    /**
     * Create new role
     *
     * @param $role_data
     * @return static
     */
    public function create($role_data)
    {
        $role = Role::create($role_data);

        foreach($role_data['permissions'] as $slug => $status){
            $permission = Permission::where('slug', $slug)->first();

            if($status){
                $role->attachPermission($permission);
            }
        }

        return  true;
    }

    /**
     * Update role
     *
     * @param $role_id
     * @param $role_data
     * @return mixed
     */
    public function update($role_id, $role_data)
    {
        if(!$role = Role::find($role_id)){
            return false;
        }

        $role->update($role_data);
        foreach($role_data['permissions'] as $slug => $status){
            $permission = Permission::where('slug', $slug)->first();
            if($status){
                $role->attachPermission($permission);
            } else {
                $role->detachPermission($permission);
            }
        }
        return true;
    }


    /**
     * Remove Role by ID
     *
     * @param $role_id
     * @return int
     */
    public function destroy($role_id)
    {
        return Role::destroy($role_id);
    }

    /**
     * Return all available roles
     */
    public function getRolesForSelect()
    {
        $roles =  Role::all();
        $result_roles = [];
        foreach($roles as $role){
            $result_roles[$role['slug']] = $role['name'];
        }

        return $result_roles;
    }

    /**
     * Return role by id
     *
     * @param $role_id
     * @return
     */
    function getByID($role_id)
    {
        $role = Role::find($role_id);
        return $role;

    }

    /**
     * Return all available permissions
     * @param string $key
     * @param string $value
     * @return array
     */
    public function getPermissionForSelect($key = 'slug', $value = 'name'): array
    {
        $permissions =  Permission::all();
        $result_permissions = [];

        foreach($permissions as $permission){
            $result_permissions[$permission[$key]] = $permission[$value];
        }

        return $result_permissions;
    }

    /**
     * Return role with permissions
     *
     * @param $slug
     * @internal param $role_id
     */
    public function getRoleWithPermissions($slug)
    {
        $role = Role::where('slug', $slug)->with('permissions')->get();
         return $role->toArray();
    }


    /**
     * Return permissions for check
     *
     * @param $role_id
     * @return mixed
     */
    public function getPermissionsForCheck($role_id)
    {
        return $permission = Role::distinct()
            ->join('permission_role', 'permission_role.role_id', '=', 'roles.id')
            ->join('permissions', 'permissions.id', '=', 'permission_role.permission_id')
            ->where('roles.id', $role_id)
            ->pluck('permissions.id', 'permissions.slug');
    }
}