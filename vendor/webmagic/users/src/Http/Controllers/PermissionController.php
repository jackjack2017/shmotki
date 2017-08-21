<?php


namespace Webmagic\Users\Http\Controllers;

use Illuminate\Routing\Controller;
use Webmagic\Users\PermissionService;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Webmagic\Users\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    use ValidatesRequests;


    /**
     * Show all permissions
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $permissions = Permission::all();

        $menu_control = view()->shared('menu_control');
        $menu_control['page'] = 'all_permissions';
        $menu_control['category'] = 'users';

        return view('users::permissions.permissions', compact('permissions', 'menu_control'));
    }


    /**
     * Return form for create permission
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $menu_control = view()->shared('menu_control');
        $menu_control['page'] = 'all_permissions';
        $menu_control['category'] = 'users';

        $permission = '';

        return view('users::permissions.create', compact('menu_control', 'permission'));
    }


    /**
     * Return form for edit permission
     *
     * @param $permission_id
     * @param PermissionService $permissionService
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function edit($permission_id, PermissionService $permissionService)
    {
        if (!($permission = $permissionService->getByID($permission_id))) {
            return response('Права не найдены', 404);
        }

        $menu_control = view()->shared('menu_control');
        $menu_control['page'] = 'all_permissions';
        $menu_control['category'] = 'users';

        return view('users::permissions.edit', compact('menu_control', 'permission'));
    }

    /**
     * Create new permission
     *
     * @param Request $request
     * @param PermissionService $permissionService
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request, PermissionService $permissionService)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:permissions',
            'slug' => 'required|string|unique:permissions'
            ]);

        if(!$permissionService->create($request->all())){
            return response('При создании акции возникли ошибки', 500);
        }
    }

    /**
     * Update permission
     *
     * @param Request $request
     * @param $id
     * @param PermissionService $permissionService
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update(Request $request, $id, PermissionService $permissionService)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required'
        ]);

        if(!$permissionService->update($id, $request->all())){
            return response('Ошибка обновления', 500);
        };
    }


    /**
     * Delete permission
     *
     * @param $permission_id
     * @param PermissionService $permissionService
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy($permission_id, PermissionService $permissionService)
    {
        if(!($permission = $permissionService->destroy($permission_id))) {
            return response ('Регион не найден', 804);
        }
    }

}
