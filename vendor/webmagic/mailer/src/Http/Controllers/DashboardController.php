<?php


namespace Webmagic\Mailer\Http\Controllers;

use Illuminate\Routing\Controller;
use Webmagic\Mailer\MailerRepo;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show all emails lists
     *
     * @param MailerRepo $mailerService
     * @return Factory|\Illuminate\View\View
     */
    public function emailsLists(MailerRepo $mailerService)
    {
        $lists = $mailerService->getAll();

        $menu_control = view()->shared('menu_control');
        $menu_control['page'] = 'emails';
        $menu_control['category'] = 'options';

        return view('mailer::emails', compact('lists','menu_control'));
    }


    /**
     * Update information by id
     *
     * @param $id
     * @param Request $request
     * @param MailerRepo $mailerService
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update($id, Request $request, MailerRepo $mailerService)
    {
        if(!$mailerService->update($id, $request->all())){
            return response('При обновлении страницы возникли ошибки', 500);
        }
    }

    
    /**
     * Show form for creating with information from db
     *
     * @param $id
     * @param MailerRepo $mailerService
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|
     */
    public function edit($id, MailerRepo $mailerService)
    {
        if(!($list = $mailerService->getByID($id))){
            return response('Товар не найден', 404);
        }

        $menu_control = view()->shared('menu_control');
        $menu_control['page'] = 'emails';
        $menu_control['category'] = 'options';

        $templates = $mailerService->findTemplates();
        $events = $mailerService->findEvents();

        return view('mailer::edit', compact('menu_control', 'templates', 'events',  'list'));
    }


    /**
     * Show empty form for creating
     *
     * @param MailerRepo $mailerService
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(MailerRepo $mailerService)
    {
        $menu_control = view()->shared('menu_control');
        $menu_control['page'] = 'emails';
        $menu_control['category'] = 'options';

        $list = '';
        $templates = $mailerService->findTemplates();
        $events = $mailerService->findEvents();

        return view('mailer::create', compact('menu_control', 'templates','events', 'list'));
    }


    /**
     * Saving information in db
     *
     * @param Request $request
     * @param MailerRepo $mailerService
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request, MailerRepo $mailerService)
    {
        if(!$list = $mailerService->create($request->all())){
            return response('При создании страницы возникли ошибки', 500);
        }
    }


    /**
     * Delete information by id
     *
     * @param $id
     * @param MailerRepo $mailerService
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy($id, MailerRepo $mailerService)
    {
        if(!($list = $mailerService->destroy($id))){
            return response('Список не найден', 404);
        }
    }
}