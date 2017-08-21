<?php

namespace Webmagic\Request\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Webmagic\Request\RequestService;
use Illuminate\Http\Request;


class RequestTypeDashboardController extends BaseController
{
    use ValidatesRequests;

    /**
     * Show list of request types
     *
     * @param RequestService $requestService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(RequestService $requestService)
    {
        $menu_control = view()->shared('menu_control');
        $menu_control['page'] = 'types_and_fields';
        $menu_control['category'] = 'requests';

        $types = $requestService->getAllTypes();
        $fields = $requestService->getAllFields();

        return view('request::request-types.request-types', compact('menu_control', 'types', 'fields'));
    }


    /**
     * Show form for creating type and fields
     *
     * @param RequestService $requestService
     *
     * @return mixed
     */
    public function create(RequestService $requestService)
    {
        $menu_control = view()->shared('menu_control');
        $menu_control['page'] = 'types_and_fields';
        $menu_control['tab'] = '';
        $menu_control['category'] = 'requests';

        $fields = [];

        $types = config('webmagic.dashboard.request.types');
        $events = $requestService->findEvents();

        return view('request::request-types.create', compact('menu_control', 'fields', 'types', 'events'));
    }


    /**
     * Creating type and fields
     *
     * @param Request $request
     * @param RequestService $requestService
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request, RequestService $requestService)
    {
        $valid = $this->validateData($request);
        if ($valid == 1)
            return response('Нет ни одного поля', 404);

        if (!$type = $requestService->create($request->all()))
            return response('При создании возникли ошибки', 404);
    }


    /**
     * Validation
     *
     * @param $request
     * @param bool $temp
     * @return null
     */
    protected function validateData($request, $temp = false)
    {
        if($temp)
            $this->validate($request, [
                'alias' => 'required|regex:/^[a-zA-Z0-9-]+$/',
                'name' => 'required',]);

        else $this->validate($request, [
                'alias' => 'unique:req_types|required|regex:/^[a-zA-Z0-9-]+$/',
                'name' => 'required',]);

        $position = '';

        foreach ($request->all() as $key => $value) {
            if (strrpos($key, '_name')) {
                $position = preg_split('/field_name_/', $key);
            }
            if ($position) {
                $i = $position[1];

                if (isset($request['field_name_' . $i . ''])) {
                    $rules['field_name_' . $i . ''] = 'required|regex:/^[a-zA-Z0-9_]+$/';
                }
            }
            $position = '';
        }
        if (!isset($rules))
            return 1;

        $this->validate($request, $rules);
    }


    /**
     * Show form for creating with information
     *
     * @param $id
     * @param RequestService $requestService
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function edit($id, RequestService $requestService)
    {
        if (!($type = $requestService->getTypeByID($id))) {
            return response('Тип заявки не найден', 404);
        }

        $menu_control = view()->shared('menu_control');
        $menu_control['page'] = 'types_and_fields';
        $menu_control['tab'] = '';
        $menu_control['category'] = 'requests';

        $fields = $requestService->getFieldsByTypeID($id);
        $types = config('webmagic.dashboard.request.types');
        $events = $requestService->findEvents();

        return view('request::request-types.edit', compact('menu_control', 'type', 'fields', 'types', 'events'));

    }


    /**
     * Update type and fields
     *
     * @param Request $request
     * @param $id
     * @param RequestService $requestService
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update(Request $request, $id, RequestService $requestService)
    {
        $valid = $this->validateData($request, true);
        if ($valid == 1)
            return response('Нет ни одного поля', 404);

        $requestService->update($request->all(), $id);
    }


    /**
     * Destroy type, fields and drop table
     *
     * @param $id
     * @param $alias
     * @param RequestService $requestService
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy($id, $alias, RequestService $requestService)
    {
        if (!$temp = $requestService->destroyTypeWithFields($id, $alias))
            return response('Не удалось удалить', 404);
    }


}
