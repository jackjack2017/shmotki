<?php

namespace Webmagic\EcommerceLight\DashboardIntegration\Http\Controllers;


use Webmagic\EcommerceLight\Category\Category;
use Webmagic\EcommerceLight\DashboardIntegration\Http\Requests\CategoryRequest as Request;
use Illuminate\Routing\Controller;
use Webmagic\EcommerceLight\Ecommerce;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CategoryDashboardController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param Ecommerce $ecommerce
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Ecommerce $ecommerce)
    {
        $menu_control = view()->shared('menu_control');
        $menu_control['page'] = 'products_category';
        $menu_control['category'] = 'ecommerce';

        $nodes = $ecommerce->categoryGetTree(false);
        $result = $this->treeRender($nodes);
        $categories = isset($result['array']) ? $result['array'] : [];

        return view('ecommerce::categories.categories', compact('menu_control', 'categories'));

    }


    /**
     * Generate one level array with categories and their level
     *
     * @param $list
     * @param string $render
     * @param array $array
     * @param int $level
     *
     * @return array|string
     */
    protected function treeRender($list, $render = '', $array = [], $level = 0)
    {
        if(count($list) == 0){
            return '';
        }

        $start_string = '<ul><li>';
        $middle_string = '</li><li>';
        $end_string = '</li></ul>';

        $render .= $start_string;

        foreach ($list as $item){
            $item['level'] = $level;
            $array[] = $item;
            $render .= $item->name;

            if(count($item['children']) > 0 ){
                $level++;
                $result = $this->treeRender($item['children'], $render, $array, $level);
                $render = $result['render'];
                $array = $result['array'];

                $level--;

                $render .= $middle_string;
            }
        }

        $render .= $end_string;

        return [
            'render' => $render,
            'array' => $array
        ];
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Ecommerce $ecommerce)
    {
        $menu_control = view()->shared('menu_control');
        $menu_control['page'] = 'products_category';
        $menu_control['category'] = 'ecommerce';

        $category = new Category();
        $filters = $ecommerce->filterGetForSelect('name', 'id');
        $options = $ecommerce->optionGroupGetAll();
        $categories = $ecommerce->categoryGetForSelect();

        return view('ecommerce::categories.create', compact('category', 'categories', 'menu_control', 'filters', 'options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request|Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Ecommerce $ecommerceService)
    {
        $request = $this->imagesPrepare($request);

        if(!$ecommerceService->categoryCreate($request->all())){
          return response('Ошибка создания категории', 500);
        };
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Ecommerce $ecommerce)
    {
        $menu_control = view()->shared('menu_control');
        $menu_control['page'] = 'products_category';
        $menu_control['category'] = 'ecommerce';

        $category = $ecommerce->categoryGetByID($id, true);
        $categories = $ecommerce->categoryGetForSelect();
        unset($categories[$id]);
        $filters = $ecommerce->filterGetForSelect('name', 'id');
        $options = $ecommerce->optionGroupGetAll();

        return view('ecommerce::categories.edit', compact('category', 'categories', 'menu_control', 'filters', 'options'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request|Request $request
     * @param  int $id
     * @param Ecommerce $ecommerceService
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Ecommerce $ecommerceService)
    {
        $request = $this->imagesPrepare($request);

        if(!$ecommerceService->categoryUpdate($id, $request->all())){
          return response('Ошибка обновления', 500);
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param Ecommerce $ecommerceService
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Ecommerce $ecommerceService)
    {
        if(!$ecommerceService->categoryDestroy($id)){
            return response('Ошибка при удалении', 500);
        }
    }

    /**
     * Move images and prepare URLs for DB saving
     *
     * @param Request $request
     * @return Request
     */
    protected function imagesPrepare(Request $request, $uniq = false)
    {
        if(isset($request['img_update']) && $request['img_update'] === 'true' && isset($request['img0'])){
            $file_name = $uniq ? $this->makeFileName($request['img0']) : $request['img0']->getClientOriginalName();
            $request['img'] = $request['img0']->move(public_path(config('webmagic.ecommerce.categories_img_path')), $file_name)->getFilename();
        } else {
            unset($request['img']);
        }

        if(isset($request['images']) && $request['images_update'] === 'true' && isset($request['images0'])){
            $request['images'] = '';
            foreach($request->files as $file_name => $file){
                if(strpos($file_name, 'images') !== false){
                    $file_name = $uniq ? $this->makeFileName($file) : $file->getClientOriginalName();
                    $request['images'] .= $file->move(public_path(config('webmagic.ecommerce.categories_img_path')), $file_name)->getFilename() . "|";
                }
            }
            $request['images'] = rtrim($request['images'], '|');
        } else {
            unset($request['images']);
        }

        return $request;
    }

    /**
     * Prepare uniq filename
     *
     * @param UploadedFile $image_file
     *
     * @return string
     */
    protected function makeFileName(UploadedFile $image_file)
    {
        $file_extension = $image_file->getClientOriginalExtension();
        $origin_fn = basename($image_file->getClientOriginalName(), '.' . $file_extension);

        return uniqid($origin_fn . '_') . '.' . $file_extension ;
    }

    /**
     * Update category position
     *
     * @param Request   $request
     * @param Ecommerce $ecommerce
     */
    public function positionUpdate(Request $request, Ecommerce $ecommerce)
    {
        $this->validate($request, [
            'reference_type' => "required|in:before,after",
            'entity_id' => "required|exists:ecom_categories,id",
            'reference_entity_id' => "required|exists:ecom_categories,id"
        ]);

        //Change after to before because it specific js script work
        if($request['reference_type'] === 'after'){
            $ecommerce->categoryMoveBefore($request['entity_id'], $request['reference_entity_id']);
        } else {
            $ecommerce->categoryMoveAfter($request['entity_id'], $request['reference_entity_id']);
        }
    }
}
