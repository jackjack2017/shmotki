<?php


namespace Webmagic\Users;

use Webmagic\Users\Models\Permission;
use Webmagic\Users\Models\User;
use Webmagic\Users\Models\Role;

class UserService
{
    /**
     * Return all users with roles
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return User::with('roles')->get();
    }

    /**
     * Create new user
     *
     * @param array $user_data
     *
     * @return static
     */
    public function create(Array $user_data)
    {
        if(isset($user_data['password'])){
            $user_data['password'] = $this->passwordPrepare($user_data['password']);
        }

        $user = User::create($user_data);

        if (!$user) {
            return false;
        }

        //Update roles
        if(isset($user_data['roles'])) {
            foreach ($user_data['roles'] as $role_id) {
                $role = Role::where('id', $role_id)->first();
                $user->attachRole($role);
            }
        }

        //Update additional permissions
        if(isset($user_data['permissions'])){
            foreach ($user_data['permissions'] as $permission_id){
                $permission = Permission::where('id', $permission_id)->first();
                $user->attachPermission($permission);
            }
        }

        return true;
    }

    /**
     * Update user info
     *
     * @param $user_id
     * @param array $user_data
     *
     * @return mixed
     */
    public function updateUser($user_id, Array $user_data)
    {
        if(isset($user_data['password'])){
            $user_data['password'] = $this->passwordPrepare($user_data['password']);
        }

        $user = User::find($user_id);
        $user->update($user_data);

        //Update roles
        $user->detachAllRoles();
        if(isset($user_data['roles'])) {
            foreach ($user_data['roles'] as $role_id) {
                $role = Role::where('id', $role_id)->first();
                $user->attachRole($role);
            }
        }

        //Update additional permissions
        $user->detachAllPermissions();
        if(isset($user_data['permissions'])){
            foreach ($user_data['permissions'] as $permission_id){
                $permission = Permission::where('id', $permission_id)->first();
                $user->attachPermission($permission);
            }
        }

        return true;
    }


    /**
     * Prepare password
     *
     * @param $password
     *
     * @return string
     */
    protected function passwordPrepare($password){
        return bcrypt($password);
    }


    /**
     * Remove User by ID
     *
     * @param $user_id
     *
     * @return int
     */
    public function removeUser($user_id)
    {
        return User::destroy($user_id);
    }

    /**
     * Return all available roles
     */
    public function getRolesForSelect()
    {

     return Role::pluck('name', 'id');
    }

    /**
     * Return all available permissions
     */
    public function getPermissionsForSelect()
    {
        return Permission::pluck('name', 'id');
    }

    /**
     * Return user by id
     *
     * @param $user_id
     *
     * @return mixed
     */
    public function getUserByID($user_id)
    {
        $user = User::with('additionalPermissions')
            ->where('id', $user_id)
            ->first();

        if(!$user){
            return $user;
        }

        return $user;
    }


}