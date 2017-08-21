<?php

namespace Webmagic\Log\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Rap2hpoutre\LaravelLogViewer\LogViewerController;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;

use Rap2hpoutre\LaravelLogViewer\LaravelLogViewer;

class LogController extends LogViewerController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Show log page in dashboard
     *
     */
    public function index()
    {
        $menu_control = view()->shared('menu_control');
        $menu_control['page'] = 'log';
        $menu_control['category'] = 'options';

        if (Request::input('l')) {
            LaravelLogViewer::setFile(base64_decode(Request::input('l')));
        }

        if (Request::input('dl')) {
            return Response::download(LaravelLogViewer::pathToLogFile(base64_decode(Request::input('dl'))));
        } elseif (Request::has('del')) {
            File::delete(LaravelLogViewer::pathToLogFile(base64_decode(Request::input('del'))));
            return Redirect::to(Request::url());
        }

        $logs = LaravelLogViewer::all();

        return View::make('log::log', [
            'logs' => $logs,
            'files' => LaravelLogViewer::getFiles(true),
            'current_file' => LaravelLogViewer::getFileName(),
            'menu_control' => $menu_control
        ]);
    }

}
