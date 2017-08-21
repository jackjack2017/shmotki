<?php

namespace Webmagic\EcommerceLight\DashboardIntegration\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Webmagic\EcommerceLight\Ecommerce;
use Webmagic\EcommerceLight\DashboardIntegration\Http\Requests\ProductRequest as Request;
use Webmagic\EcommerceLight\Product\Product;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Http\Request as BaseRequest;

class ProductDashboardController extends Controller
{
    use ValidatesRequests;

    /**
     * Show products list
     *
     * @param Ecommerce $ecommerce
     * @param BaseRequest $request
     * @return \Illuminate\View\View|Factory
     *
     * @internal param Ecommerce $productService
     */
    public function index(Ecommerce $ecommerce, BaseRequest $request)
    {
        $menu_control = view()->shared('menu_control');
        $menu_control['page'] = 'products';
        $menu_control['category'] = 'ecommerce';

        $request_params = $request->all();

        $categories = $ecommerce->categoryGetForSelect('name', 'id');

        //Total information about all products
        if(!$products_data = $ecommerce->productGetData()){
            $products_data = [];
        }

        //Quantity products on page
        if(config('webmagic.dashboard.ecommerce.pagination_use')){
            $paginate_num = $request['size'] != null ? $request['size'] : 25;
        } else {
            $paginate_num = false;
        }

        //Filter by name or category
        if(isset($request_params['categories']) || isset($request_params['product_name']))
        {
            $product_name = isset($request_params['product_name']) ? $request_params['product_name'] : null;
            $categories_id = isset($request_params['categories']) ? $request_params['categories'] : null;

            $products = $ecommerce->productSearchByNameInCategories($product_name, $categories_id, $paginate_num);

        } else{
            $products = $ecommerce->productGetAll($paginate_num);
        }

        $filter['categories'] = isset($request_params['categories']) ? $request_params['categories'] : [0 => 0];
        $filter['product_name'] = isset($request_params['product_name']) ? $request_params['product_name'] : '';

        return view('ecommerce::products.products', compact('products', 'menu_control', 'categories', 'filter', 'products_data'));

    }

    /**
     * Export products to excel
     *
     * @param Request   $request
     * @param Ecommerce $ecommerce
     *
     */
    public function export(Request $request, Ecommerce $ecommerce)
    {
        $request_params = $request->all();
        $categories_id = null;

        if(isset($request_params['categories']) && !isset($request_params['all_categories']) ){
            $categories_id = $request_params['categories'];
        }

        $export_fields = [];
        if(isset($request_params['fields']) && !isset($request_params['all_fields']) ){
            $export_fields = $request_params['fields'];
        }

        return $ecommerce->productExportToExcel($categories_id, $export_fields);
    }


    /**
     * Import products from excel file
     *
     * @param Request $request
     * @param Ecommerce $ecommerce
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     *
     */
    public function import(Request $request, Ecommerce $ecommerce)
    {
        $this->validate($request, [
            'product_import0' => 'required',
        ]);
        $import_file = $request->file('product_import0');

        if(!$ecommerce->productCreateTableCopy()){
            return response('Не удалось создать копию таблицы', 500);
        }
        
        if(!$ecommerce->productImportFromExcel($import_file->getRealPath())){
            return response('При импорте возникли ошибки', 500);
        }
    }


    /**
     * Show page for product creating
     *
     * @param Ecommerce $ecommerce
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Ecommerce $ecommerce)
    {
        $menu_control['page'] = 'products';
        $menu_control['category'] = 'ecommerce';
        $menu_control['tab'] = '';

        $product = new Product();
        $categories = $ecommerce->categoryGetForSelect('name', 'id');
        $filter = [];

        return view('ecommerce::products.create', compact('menu_control', 'product', 'categories', 'filter'));
    }


    /**
     * Create product
     *
     * @param Request $request
     * @param Ecommerce $ecommerce
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request, Ecommerce $ecommerce)
    {
        $request = $this->imagesPrepare($request);
        $request = $this->filesPrepare($request);
        $request['additional_categories'] = explode(',', $request['additional_categories']);

        if(!$ecommerce->productCreate($request->all())){
            return response('При создании товара возникли ошибки', 500);
        }
    }


    /**
     * Show form for edit product
     *
     * @param $product_id
     * @param Ecommerce $ecommerce
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function edit($product_id, Ecommerce $ecommerce)
    {
        if(!$product = $ecommerce->productGetByID($product_id)){
            return response('Товар не найден', 404);
        }

        $product['options'] = collect($product['options'])->groupBy('id');

        $menu_control['page'] = 'products';
        $menu_control['category'] = 'ecommerce';
        $menu_control['tab'] = '';

        $categories = $ecommerce->categoryGetForSelect('name', 'id');

        if (config('webmagic.ecommerce.filter_use')) {
            $filter = $ecommerce->filterGetForProductConfig($product['id']);
        } else
            $filter = false;

        $product['additionalCategories'] = $product['additionalCategories']->groupBy('id');

        return view('ecommerce::products.edit', compact('menu_control', 'product', 'categories', 'filter'));
    }

    /**
     * Update product by ID
     *
     * @param $product_id
     * @param Request $request
     * @param Ecommerce $ecommerce
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update($product_id, Request $request, Ecommerce $ecommerce)
    {
        $request = $this->imagesPrepare($request);
        $request = $this->filesPrepare($request);
        $request['additional_categories'] = explode(',', $request['additional_categories']);

        if(!$ecommerce->productUpdate($product_id, $request->all())){
            return response('При обновлении товара возникли ошибки', 500);
        }
    }

    /**
     * Destroy product
     *
     * @param $product_id
     * @param Ecommerce $ecommerce
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy($product_id, Ecommerce $ecommerce)
    {
        if(!$ecommerce->productDestroy($product_id)){
            return response('Не удалось удалить товар', 500);
        }
    }


    /**
     * Create copy product by id and show edit form
     *
     * @param $product_id
     * @param Ecommerce $ecommerce
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function copy($product_id, Ecommerce $ecommerce)
    {
        $product = $ecommerce->productGetByID($product_id)->toArray();
        $product['name'] .= " <Копия>";

        if(isset($product['options']) && !empty($product['options'])) {
            foreach ($product['options'] as $option)
            {
                $options[] = (string)$option['id'];
            }
            $product['options'] = $options;
        }

        if(isset($product['additional_categories']) && !empty($product['additional_categories'])) {
            foreach ($product['additional_categories'] as $additional_category)
            {
                $additional_categories[] = (string)$additional_category['id'];
            }
            $product['additional_categories'] = $additional_categories;
        }

        if(!$product = $ecommerce->productCreate($product)){
            return response('При копировании товара возникли ошибки');
        }

        $product['options'] = collect($product['options'])->groupBy('id');

        $menu_control['page'] = 'products';
        $menu_control['category'] = 'ecommerce';
        $menu_control['tab'] = '';

        $categories = $ecommerce->categoryGetForSelect('name', 'id');

        if (config('webmagic.ecommerce.filter_use')) {
            $filter = $ecommerce->filterGetForProductConfig($product['id']);
        } else
            $filter = false;

        $product['additionalCategories'] = $product['additionalCategories']->groupBy('id');

        return view('ecommerce::products.edit', compact('menu_control', 'product', 'categories', 'filter'));
    }


    /**
     * Move images and prepare URLs for DB saving
     *
     * @param Request $request
     * @param bool $uniq
     *
     * @return Request
     */
    protected function imagesPrepare(Request $request, $uniq = false)
    {
        if(isset($request['main_image_update']) && $request['main_image_update'] === 'true' && isset($request['main_image0'])){
            $file_name = $uniq ? $this->makeFileName($request['main_image0']) : $request['main_image0']->getClientOriginalName();
            $request['main_image'] = $request['main_image0']->move(public_path(config('webmagic.ecommerce.products_img_path')), $file_name)->getFilename();
        } else {
            unset($request['main_image']);
        }

        if(isset($request['images']) && $request['images_update'] === 'true' && isset($request['images0'])){
            $request['images'] = '';
            foreach($request->files as $file_name => $file){
                if(strpos($file_name, 'images') !== false){
                    $file_name = $uniq ? $this->makeFileName($file) : $file->getClientOriginalName();
                    $request['images'] .= $file->move(public_path(config('webmagic.ecommerce.products_img_path')), $file_name)->getFilename() . "|";
                }
            }
            $request['images'] = rtrim($request['images'], '|');
        } else {
            unset($request['images']);
        }

        return $request;
    }


    /**
     * Move files and prepare URLs for DB saving
     *
     * @param Request $request
     * @param bool $uniq
     *
     * @return Request
     */
    protected function filesPrepare(Request $request, $uniq = false)
    {
        if(isset($request['file_update']) && $request['file_update'] === 'true' && isset($request['file0'])){
            $file_name = $uniq ? $this->makeFileName($request['file0']) : $request['file0']->getClientOriginalName();
            $request['file'] = $request['file0']->move(public_path(config('webmagic.ecommerce.products_file_path')), $file_name)->getFilename();
        } else {
            unset($request['file']);
        }

        if(isset($request['files']) && $request['files_update'] === 'true' && isset($request['files0'])){
            $request['files'] = '';
            foreach($request->files as $file_name => $file){
                if(strpos($file_name, 'files') !== false){
                    $file_name = $uniq ? $this->makeFileName($file) : $file->getClientOriginalName();
                    $request['files'] .= $file->move(public_path(config('webmagic.ecommerce.products_file_path')), $file_name)->getFilename() . "|";
                }
            }
            $request['files'] = rtrim($request['files'], '|');
        } else {
            unset($request['files']);
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
     * Export product images in .zip
     *
     * @param Ecommerce $ecommerceService
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function imgExport(Ecommerce $ecommerceService)
    {
        return response()->download($ecommerceService->productExportImages());
    }

    /**
     * Import images
     *
     * @param Request   $request
     * @param Ecommerce $ecommerce
     */
    public function imgImport(Request $request, Ecommerce $ecommerce)
    {
        $this->validate($request, [
           'images_import0' => 'required'
        ]);

        $ecommerce->productUpdateImages($request->file('images_import0')->getRealPath());
    }


    /**
     * Return all information before last import
     *
     * @param Ecommerce $ecommerce
     * @return mixed
     */
    public function backup(Ecommerce $ecommerce)
    {
        if(!$ecommerce->productBackupImport()){
            return response('При отмене импорта возникли ошибки', 500);
        }
    }

    /**
     * Update product status
     *
     * @param $product_id
     * @param Ecommerce $ecommerce
     * @param Request   $request
     */
    public function changeStatus($product_id, Ecommerce $ecommerce, Request $request)
    {
        $this->validate($request, ['active' => 'required|boolean']);

        if(!$ecommerce->productChangeStatus($product_id, (bool)$request['active'])){
            abort(500, 'При обновлении возникли ошибки');
        }
    }

    /**
     * Update product position
     *
     * @param Request   $request
     * @param Ecommerce $ecommerce
     */
    public function positionUpdate(Request $request, Ecommerce $ecommerce)
    {
        $this->validate($request, [
            'reference_type' => "required|in:before,after",
            'entity_id' => "required|exists:ecom_products,id",
            'reference_entity_id' => "required|exists:ecom_products,id"
        ]);

        //Change after to before because it specific js script work
        if($request['reference_type'] === 'after'){
            $ecommerce->productMoveBefore($request['entity_id'], $request['reference_entity_id']);
        } else {
            $ecommerce->productMoveAfter($request['entity_id'], $request['reference_entity_id']);
        }
    }

    public function getFile($file_name)
    {
        $file_path = public_path(config('webmagic.ecommerce.products_file_path') . '/' . $file_name);

        $headers = array(
            'Content-Type: application/octet-stream',
        );

        return response()->download($file_path, $file_name);

    }


}