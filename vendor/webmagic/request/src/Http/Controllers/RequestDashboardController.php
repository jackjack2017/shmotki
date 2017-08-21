<?php

namespace Webmagic\Request\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Webmagic\Request\RequestService;

class RequestDashboardController extends BaseController
{

    /**
     * Show list of requests
     *
     * @param RequestService $requestService
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(RequestService $requestService)
    {
        $types = $requestService->getAllTypes();

        $menu_control = view()->shared('menu_control');
        $menu_control['page'] = 'requests';
        $menu_control['category'] = 'requests';

        foreach($types as $type)
        {
            $req_fields = $requestService->getRequestFieldsData($type['alias']);
            $count[$type['id']] = count($req_fields);
            $type['count'] = count($req_fields);
        }

        return view('request::request.all-requests', ['menu_control' => $menu_control, 'types' => $types]);
    }


    /**
     * Show request with fields and data by type id
     *
     * @param $type_id
     * @param RequestService $requestService
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($type_id, RequestService $requestService)
    {
        $type = $requestService->getTypeById($type_id);
        $fields = $requestService->getFieldsByTypeId($type_id);
        $req_fields = $requestService->getRequestFieldsData($type['alias']);
        
        $menu_control = view()->shared('menu_control');
        $menu_control['page'] = 'requests';
        $menu_control['category'] = 'requests';

        return view('request::request.request', ['menu_control'=> $menu_control, 'name' => $type['alias'], 'fields'=>$fields, 'req_fields'=>$req_fields, 'id'=>$type_id]);
    }


    /**
     * Export request to excel by type id
     * 
     * @param $type_id
     * @param RequestService $requestService
     */
    public function export($type_id, RequestService $requestService)
    {
        $type = $requestService->getTypeById($type_id);
        $fields = $requestService->getFieldsByTypeId($type_id);
        $req_fields = $requestService->getRequestFieldsData($type['alias']);
        $requestService->exportToExcel($type, $fields, $req_fields);
    }

    /**
     * Delete selective request
     *
     * @param $req_id
     * @param $table_name
     * @param RequestService $requestService
     * @return mixed
     */
    public function destroy($req_id, $table_name, RequestService $requestService)
    {
        if(!$request = $requestService->destroyRequest($req_id, $table_name))
            return response('Заявка не найдена', 404);
    }


    /**
     * Delete all requests in type
     *
     * @param $table_name
     * @param RequestService $requestService
     * @return mixed
     */
    public function destroyAll($table_name, RequestService $requestService)
    {
        if(!$request = $requestService->destroyAllRequestsInType($table_name))
            return response('Тип запросов не найден', 404);
    }

}