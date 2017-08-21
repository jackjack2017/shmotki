<?php


namespace Webmagic\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Webmagic\Users\Http\Requests\CreateUserRequest;
use Webmagic\Users\UserService;
use Collective\Html\FormBuilder;
use Illuminate\Foundation\Validation\ValidatesRequests;

class UserController extends Controller
{
    use ValidatesRequests;

    /**
     * Show all users
     *
     * @param UserService $user_service
     *
     * @return Factory|\Illuminate\View\View
     */
    public function index(UserService $user_service)
    {
        $users = $user_service->getAll();

        $menu_control = view()->shared('menu_control');
        $menu_control['page'] = 'all_users';
        $menu_control['category'] = 'users';

        return view('users::users', ['menu_control' => $menu_control, 'users' => $users]);
    }

    /**
     * Return form for creating new user
     *
     * @param UserService $userService
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(UserService $userService, FormBuilder $formBuilder)
    {
        $menu_control = view()->shared('menu_control');
        $menu_control['page'] = 'all_users';
        $menu_control['category'] = 'users';

        $user = '';
        $roles = $userService->getRolesForSelect();
        $permissions = $userService->getPermissionsForSelect();

        return view('users::create', compact('user', 'roles', 'permissions', 'formBuilder', 'menu_control'));

    }

    /**
     * Create new user
     *
     * @param Request|CreateUserRequest $request
     * @param UserService $userService
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request, UserService $userService)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:users,name',
            'password' => 'required|string',
            'password_confirm' => 'same:password'
        ]);

        $request = $this->prepareMultipleValues(['roles', 'permissions'], $request);

        if(!$userService->create($request->all())){
            return response('При создании возникли ошибки', 500);
        }
    }

    /**
     * Return form for edit user
     *
     * @param             $user_id
     * @param UserService $userService
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($user_id, UserService $userService, FormBuilder $formBuilder)
    {
        $menu_control = view()->shared('menu_control');
        $menu_control['page'] = 'all_users';
        $menu_control['category'] = 'users';

        $user = $userService->getUserByID($user_id);
        if(count($user->roles)) {
            $user['user_roles'] = $user->roles->groupBy('id')->toArray();
        }

        if(count($user['additionalPermissions'])){
            $user['user_permissions'] = $user['additionalPermissions']->groupBy('id');
        }

        $roles = $userService->getRolesForSelect();
        $permissions = $userService->getPermissionsForSelect();

        return view('users::update', compact('user', 'roles', 'permissions', 'formBuilder', 'menu_control'));
    }

    /**
     * Update user
     *
     * @param $user_id
     * @param Request $request
     * @param UserService $userService
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @internal param UserRequest $userRequest
     */
    public function update($user_id, Request $request, UserService $userService)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:users,name,'.$user_id,
            'password' => 'required|string',
            'password_confirm' => 'same:password'
        ]);

        $request = $this->prepareMultipleValues(['roles', 'permissions'], $request);

        if(!$userService->updateUser($user_id, $request->all())){
            return response('При обновлении возникли ошибки', 500);
        }
    }

    /**
     * Remove user
     *
     * @param $user_id
     * @param UserService $userService
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy($user_id, UserService $userService)
    {
        if(!$userService->removeUser($user_id)){
            return response('При удалении возникли ошибки', 500);
        }
    }

    /**
     * Prepare request for multiple options
     *
     * @param array   $values_names
     * @param Request $request
     *
     * @return Request
     */
    protected function prepareMultipleValues(Array $values_names, Request $request)
    {
        foreach ($values_names as $value_name){
            if(is_null($request[$value_name]) || $request[$value_name] === 'null'){
                unset($request[$value_name]);
            } else {
                $request[$value_name] = explode(',', $request[$value_name]);
            }
        }

        return $request;
    }
}