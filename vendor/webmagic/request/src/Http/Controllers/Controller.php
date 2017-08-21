<?php

namespace Webmagic\Request\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Webmagic\Request\RequestService;
use Webmagic\Request\Http\Requests\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;


class Controller extends BaseController
{
    use ValidatesRequests;


    /**
     * Show requested form
     *
     * @param RequestService $requestService
     * @param $req_type
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showForm(RequestService $requestService, $req_type)
    {
        $form = $requestService->getTypeByAlias($req_type);

        if(!$form['status'])
            dump($check = 'выкл');

        else return view('request::'.$req_type.'');
    }

    
    /**
     * Creating request
     *
     * @param $req_type
     * @param RequestService $requestService
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function create($req_type, RequestService $requestService, Request $request)
    {
        if(!$req_type)
            return response('Не задан тип заявки', 500);

        if(!$req = $requestService->createRequest($req_type))
            return response('Заявки с таким именем не существует', 500);

        $rules = $req->getValidationRules();
        $this->validate($request, $rules);

        if($req_id = $requestService->saveRequest($req, $request, $req_type)){
            return response()->json(['id' => $req_id]);
        };
    }

}