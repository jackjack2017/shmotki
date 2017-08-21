<?php


namespace Webmagic\EcommerceLight\DashboardIntegration\Http\Controllers;


use Illuminate\Routing\Controller;
use Webmagic\EcommerceLight\Ecommerce;
use Webmagic\EcommerceLight\DashboardIntegration\Http\Requests\FilterRequest as Request;

class FilterDashboardController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param Ecommerce $ecommerce
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Ecommerce $ecommerce)
    {
        $filters = $ecommerce->filterGetAll();

        $menu_control = view()->shared('menu_control');
        $menu_control['page'] = 'filters';
        $menu_control['category'] = 'ecommerce';

        return view('ecommerce::filters.filters', compact('filters', 'menu_control'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Ecommerce $ecommerce)
    {
        $filter = '';
        $option_groups = $ecommerce->optionGroupGetForSelect('name', 'id');

        $menu_control = view()->shared('menu_control');
        $menu_control['page'] = 'filters';
        $menu_control['category'] = 'ecommerce';

        return view('ecommerce::filters.create', compact('filter', 'option_groups', 'menu_control'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Ecommerce $ecommerce
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Ecommerce $ecommerce)
    {
        $request['option_groups'] = explode(',', $request['option_groups']);

        if(!$ecommerce->filterCreate($request->all())){
            return response('Creating error', 500);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @param Ecommerce $ecommerce
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Ecommerce $ecommerce)
    {
        $filter = $ecommerce->filterGetByID($id);
        $filter['option_groups'] = $filter['optionGroups']->groupBy('id')->toArray();

        $option_groups = $ecommerce->optionGroupGetForSelect('name', 'id');

        $menu_control = view()->shared('menu_control');
        $menu_control['page'] = 'filters';
        $menu_control['category'] = 'ecommerce';

        return view('ecommerce::filters.edit', compact('filter', 'menu_control', 'option_groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @param Ecommerce $ecommerce
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Ecommerce $ecommerce)
    {
        $request['option_groups'] = explode(',', $request['option_groups']);

        if(!$ecommerce->filterUpdate($id, $request->all())){
            return response('Update error', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param Ecommerce $ecommerce
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Ecommerce $ecommerce)
    {
       if(!$ecommerce->filterDestroy($id)){
           return response('Update error', 500);
       }
    }
}