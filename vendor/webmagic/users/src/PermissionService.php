<?php


namespace Webmagic\Users;

use Webmagic\Users\Models\Role;
use Webmagic\Users\Models\Permission;

class PermissionService
{
    /**
     * Return all users with roles
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return Permission::all();
    }


    /**
     * Create new permission
     *
     * @param $permission_data
     * @return static
     */
    public function create($permission_data)
    {
        return  Permission::create($permission_data);
    }

    /**
     * Update permission
     *
     * @param $permission_id
     * @param $permission_data
     * @return mixed
     */
    public function update($permission_id, $permission_data)
    {
        return Permission::find($permission_id)->update($permission_data);
    }


    /**
     * Remove Permission by ID
     *
     * @param $permission_id
     * @return int
     */
    public function destroy($permission_id)
    {
        return Permission::destroy($permission_id);
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
     * Return permission by id
     *
     * @param $permission_id
     * @return
     */
    function getByID($permission_id)
    {
        $permission = Permission::find($permission_id);
        return $permission;

    }

    /**
     * Return all available permissions
     */
    public function getPermissionForSelect()
    {
        $permissions =  Permission::all();
        $result_permissions = [];
        foreach($permissions as $permission){
            $result_permissions[$permission['slug']] = $permission['name'];
        }

        return $result_permissions;
    }

}