<?php


namespace Webmagic\EcommerceLight\DashboardIntegration\Http\Controllers;


use Illuminate\Routing\Controller;
use Webmagic\EcommerceLight\Ecommerce;
use Webmagic\EcommerceLight\DashboardIntegration\Http\Requests\OptionRequest as Request;

class OptionDashboardController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @param Ecommerce $ecommerce
     *
     * @return \Illuminate\Http\Response
     */
    public function create($option_group_id, Ecommerce $ecommerce)
    {
        $menu_control = view()->shared('menu_control');
        $menu_control['page'] = 'option-groups';
        $menu_control['category'] = 'ecommerce';

        $option['option_group_id'] = $option_group_id;
        $option_groups = $ecommerce->optionGroupGetForSelect('name', 'id');

        return view('ecommerce::options.create', compact('option', 'option_groups', 'menu_control'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @param Ecommerce $ecommerce
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Ecommerce $ecommerce)
    {
        if(!$ecommerce->optionCreate($request->all())){
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
        if(!$option = $ecommerce->optionGetByID($id)){
            return response('Option not found', 404);
        }
        $option_groups = $ecommerce->optionGroupGetForSelect('name', 'id');

        $menu_control = view()->shared('menu_control');
        $menu_control['page'] = 'option-groups';
        $menu_control['category'] = 'ecommerce';

        return view('ecommerce::options.edit', compact('option', 'option_groups', 'menu_control'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @param Ecommerce $ecommerce
     *
     * @return \Illuminate\Http\Response|bool
     */
    public function update($id, Request $request, Ecommerce $ecommerce)
    {
        if(!$ecommerce->optionUpdate($id, $request->all())){
            return response('Update error', 500);
        } else
            return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param Ecommerce $ecommerce
     *
     * @return \Illuminate\Http\Response|bool
     */
    public function destroy($id, Ecommerce $ecommerce)
    {
       if(!$ecommerce->optionDestroy($id)){
           return response('Destroy error', 500);
       } else
           return true;
    }


    /**
     * Update Option position
     *
     * @param Request   $request
     * @param Ecommerce $ecommerce
     */
    public function positionUpdate(Request $request, Ecommerce $ecommerce)
    {
        $this->validate($request, [
            'reference_type' => "required|in:before,after",
            'entity_id' => "required|exists:ecom_options,id",
            'reference_entity_id' => "required|exists:ecom_options,id"
        ]);

        //Change after to before because it specific js script work
        if($request['reference_type'] === 'after'){
            $ecommerce->optionMoveBefore($request['entity_id'], $request['reference_entity_id']);
        } else {
            $ecommerce->optionMoveAfter($request['entity_id'], $request['reference_entity_id']);
        }
    }
}