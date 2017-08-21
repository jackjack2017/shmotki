<?php


namespace Webmagic\EcommerceLight\DashboardIntegration\Http\Controllers;


use Illuminate\Routing\Controller;
use Webmagic\EcommerceLight\Ecommerce;
use Webmagic\EcommerceLight\DashboardIntegration\Http\Requests\OptionGroupRequest as Request;

class OptionGroupDashboardController extends Controller
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
        $option_groups = $ecommerce->optionGroupGetAll();

        $menu_control = view()->shared('menu_control');
        $menu_control['page'] = 'option-groups';
        $menu_control['category'] = 'ecommerce';

        return view('ecommerce::option-groups.option-groups', compact('option_groups', 'menu_control'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $option_group = '';

        $menu_control = view()->shared('menu_control');
        $menu_control['page'] = 'option-groups';
        $menu_control['category'] = 'ecommerce';

        return view('ecommerce::option-groups.create', compact('option_group', 'menu_control'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Ecommerce $ecommerce)
    {
        if(!$ecommerce->optionGroupCreate($request->all())){
            return response('Creating error', 500);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int      $id
     * @param Ecommerce $ecommerce
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Ecommerce $ecommerce)
    {
        if(!$option_group = $ecommerce->optionGroupGetByID($id)){
            abort(404);
        }

        $option_group['options'] = $option_group->options->sortBy('position');

        $menu_control = view()->shared('menu_control');
        $menu_control['page'] = 'option-groups';
        $menu_control['category'] = 'ecommerce';

        return view('ecommerce::option-groups.edit', compact('option_group', 'menu_control'));
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
        if(!$ecommerce->optionGroupUpdate($id, $request->all())){
            return response('Update error', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param Ecommerce $ecommerce
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Ecommerce $ecommerce)
    {
       if(!$ecommerce->optionGroupDestroy($id)){
           return response('Update error', 500);
       }
    }

    /**
     * Update Option position
     *
     * @param Request   $request
     *
     * @param Ecommerce $ecommerce
     */
    public function positionUpdate(Request $request, Ecommerce $ecommerce)
    {
        $this->validate($request, [
            'reference_type' => "required|in:before,after",
            'entity_id' => "required|exists:ecom_option_groups,id",
            'reference_entity_id' => "required|exists:ecom_option_groups,id"
        ]);

        //Change after to before because it specific js script work
        if($request['reference_type'] === 'after'){
            $ecommerce->optionGroupMoveBefore($request['entity_id'], $request['reference_entity_id']);
        } else {
            $ecommerce->optionGroupMoveAfter($request['entity_id'], $request['reference_entity_id']);
        }
    }
}