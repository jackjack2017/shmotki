<?php


namespace Webmagic\Users\Http\Controllers;

use Illuminate\Routing\Controller;
use Webmagic\Users\RoleService;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Webmagic\Users\Models\Role;
use Webmagic\Users\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    use ValidatesRequests;


    /**
     * Show all roles
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        $menu_control = view()->shared('menu_control');
        $menu_control['page'] = 'all_roles';
        $menu_control['category'] = 'users';

        return view('users::roles.roles', compact('roles', 'menu_control','permissions'));
    }


    /**
     * Return form for create new role
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $menu_control = view()->shared('menu_control');
        $menu_control['page'] = 'all_roles';
        $menu_control['category'] = 'users';

        $permissions = Permission::all();
        $role = '';
        $attached_permissions = [];

        return view('users::roles.create', compact('menu_control', 'role','permissions', 'attached_permissions'));
    }


    /**
     * Return form for edit role
     *
     * @param $role_id
     * @param RoleService $roleService
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function edit($role_id, RoleService $roleService)
    {
        if (!($role = $roleService->getByID($role_id))) {
            return response('Права не найдены', 404);
        }

        $menu_control = view()->shared('menu_control');
        $menu_control['page'] = 'all_roles';
        $menu_control['category'] = 'users';

        $permissions = Permission::all();
        $attached_permissions = $roleService->getPermissionsForCheck($role_id);

        return view('users::roles.edit', compact('menu_control', 'role','permissions','attached_permissions'));
    }

    /**
     * Create new role
     *
     * @param Request $request
     * @param RoleService $roleService
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request, RoleService $roleService)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:roles',
            'slug' => 'required|string|unique:roles'
        ]);

        if(!$roleService->create($request->all())){
            return response('При создании акции возникли ошибки', 500);
        }
    }

    /**
     * Update role
     *
     * @param Request $request
     * @param $id
     * @param RoleService $roleService
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update(Request $request, $id, RoleService $roleService)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required'
        ]);

        if(!$roleService->update($id, $request->all())){
            return response('Ошибка обновления', 500);
        };
    }

    /**
     * Delete role
     *
     * @param $role_id
     * @param RoleService $roleService
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy($role_id, RoleService $roleService)
    {
        if(!($role = $roleService->destroy($role_id))) {
            return response ('Регион не найден', 804);
        }
    }

}
