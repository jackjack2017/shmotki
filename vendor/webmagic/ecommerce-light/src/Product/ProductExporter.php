<?php


namespace Webmagic\EcommerceLight\Product;


use Chumper\Zipper\Zipper;
use Illuminate\Support\Facades\DB;
use IvanLemeshev\Laravel5CyrillicSlug\Slug;
use Webmagic\EcommerceLight\Ecommerce;
use Maatwebsite\Excel\Facades\Excel;
use Webmagic\EcommerceLight\Filtering\Option;

class ProductExporter extends ProductSearch implements ProductExporterContract
{

    protected $export_errors = [
        'price' => [
            'Неца указана в неверном формате',
            'Цена сликом большая',
            'Нам нужна другая цена'
        ],

        'category' => [
            'Указанная категория не найдена'
        ],

        'option' => [
            'Опция не найдена'
        ],

        'group' => [
            'Группа опций с таким именем не найдена'
        ],

        'id' => [
            'Товар с таким id не найден'
        ]
    ];

    /**
     * Export products to excel
     *
     * @param array $categories_id
     * @param array $selected_export_fields
     *
     */
    public function exportToExcel(Array $categories_id = null, Array $selected_export_fields = [])
    {
        //Preparing export fields
        $prepared_export_fields = config('webmagic.ecommerce.export_labels');

        //Delete option adding
        if (config('webmagic.ecommerce.export_del_mark')) {
            $prepared_export_fields['delete'] = 'Удалить';
        }


        //Category option config
        if (!config('webmagic.ecommerce.additional_category_use')) {
            if(isset($prepared_export_fields['additional_categories'])){
                unset($prepared_export_fields['additional_categories']);
            }
        }

        //Filtering export fields if needs
        if (count($selected_export_fields)) {
            $prepared_export_fields = array_filter($prepared_export_fields, function ($key) use ($selected_export_fields) {
                return in_array($key, $selected_export_fields);

            }, ARRAY_FILTER_USE_KEY);
        }

        //Preparing products for export
        $products = $this->getProductsForExport($categories_id);

        $prepared_products = [];
        foreach ($products as $product) {
            $tmp_product = [];
            foreach ($prepared_export_fields as $key => $title) {
                if ($key == 'delete') {
                    $tmp_product[$title] = null;
                } else {
                    $tmp_product[$title] = $product[$key];
                }
            }
            $prepared_products[] = $tmp_product;
        }

        //Prepared and send excel
        Excel::create(config('webmagic.ecommerce.export_file_name'), function ($excel) use ($prepared_products) {
            $excel->sheet(config('webmagic.ecommerce.export_sheet_name'), function ($sheet) use ($prepared_products) {
                $sheet->fromArray($prepared_products);
            });
        })->download('xls');
    }

    /**
     * Get and prepare products for export
     *
     * @param array $categories_id
     * @return mixed
     */
    protected function getProductsForExport(Array $categories_id = null)
    {
        $products_query = null;
        if (config('webmagic.ecommerce.filter_use')) {
            $products_query = Product::leftJoin('ecom_product_option', 'ecom_product_option.product_id', '=', 'ecom_products.id')
                ->leftJoin('ecom_options', 'ecom_options.id', '=', 'ecom_product_option.option_id')
                ->leftJoin('ecom_option_groups', 'ecom_option_groups.id', '=', 'ecom_options.option_group_id')
                ->leftJoin('ecom_product_category', 'ecom_product_category.product_id', '=', 'ecom_products.id')
                ->leftJoin('ecom_categories as add_cats', 'add_cats.id', '=', 'ecom_product_category.category_id')

                ->select('ecom_products.*',
                    DB::raw("GROUP_CONCAT( DISTINCT CONCAT(ecom_option_groups.name, '::', ecom_options.value) SEPARATOR ';') as options"),
                    DB::raw("GROUP_CONCAT( DISTINCT add_cats.name SEPARATOR ';') as additional_categories"))
                ->distinct()
                ->groupBy('ecom_products.id');

            $this->joined_tables[] = 'ecom_product_option';
            $this->joined_tables[] = 'ecom_product_category';
            $this->joined_tables[] = 'ecom_option_groups';
            $this->joined_tables[] = 'ecom_options';
            $this->joined_tables[] = 'ecom_product_option';
        }

        if(!is_null($categories_id)){
            $products_query = $this->addCategoryFilter($products_query, $categories_id);
        }

        return $this->realGetMany($products_query);
    }

    /**
     * Import products from excel
     *
     * @param $file_path
     *
     * @return bool
     */
    public function importFromExcel($file_path)
    {
        //Off convection titles to ANSI when converting excel
        config(['excel.import.heading' => 'original']);

        //todo Add file validation
        $import_products = Excel::load($file_path, function ($reader) {
        })->get()->toArray();

        //tmp for fix null value error
        $import_products = array_filter($import_products, function ($product) {
            $is_empty_array = true;
            foreach ($product as $value) {
                if ($value !== null && strlen(trim($value))) {
                    $is_empty_array = false;
                }
            }
            return !$is_empty_array;
        });

        $products = [];
        $productsId = $this->getForSelect('name', 'id');

        foreach ($import_products as $product) {

            // Check correct id
            if($product['ID'] && !isset($productsId[$product['ID']])){

                $tmp_product['id'] = $product['ID'];
                $tmp_product['errors'][$tmp_product['id']] = $this->export_errors['id'][0];

            } else{

                if(isset($product['Удалить']) && $product['Удалить']) {

                    $tmp_product['id'] = $product['ID'];
                    $tmp_product['status'] = 'delete';

                    if (isset($product['Опции']) && $product['Опции']) {
                        $tmp_product['options'] = $product['Опции'];
                    }

                } else{

                    $tmp_product = $this->prepareProductDataForImport($product);


                    $tmp_product['status'] = isset($productsId[$tmp_product['id']]) ? 'update' : 'create';

                    // Generate url
                    if($tmp_product['status'] == 'create'){
                        $slug = new Slug();
                        $tmp_product['slug'] = $slug->make($tmp_product['name'], '-');
                    }

                }
                if (config('webmagic.ecommerce.filter_use')) {
                    $tmp_product = $this->prepareProductOptionsForImport($tmp_product);
                }
            }

            $products[] = $tmp_product;
        }

        foreach($products as $product_data) {
            if(isset($product_data['errors'])) {
                $errors[] = $product_data['errors'];
            }
        }

        if(isset($errors)) {
//            dump('Все ошибки', $errors);
            return false;
        }

        $this->saveDBChangesForImport($products);
        return true;
    }


    /**
     * Prepare product options form imported array for saving into DB
     *
     * @param array $product
     * @return array
     */
    protected function prepareProductOptionsForImport(Array $product)
    {
        if (!isset($product['options']) || !$product['options']) {
            return $product;
        }

        $ecommerce = new Ecommerce();
        $groups = $ecommerce->optionGroupGetForSelect('id', 'name');

        //Generate array with options and their groups
        $option_groups = explode(';', $product['options']);
        $product_options = [];

        foreach ($option_groups as $option_group) {
            $group_and_option = explode('::', $option_group);

            //Check group
            if (!isset($groups[$group_and_option[0]])) {
                $product['errors'][$product['id']] = $this->export_errors['group'][0] . ' (' . $option_group . ')';
            } else {
                $group_id = $groups[$group_and_option[0]];
                $option = Option::where('option_group_id', $group_id)
                    ->where('value', $group_and_option[1])
                    ->select('id')
                    ->first();

                if(!$option){
                    $product['errors'][$product['id']] = $this->export_errors['option'][0] . ' -> ' . $group_and_option[1];
                } else {
                    $product_options[] = $option['id'];
                }
            }
        }

        $product['options'] = $product_options;

        return $product;
    }



    /**
     * Prepare data from import array for saving into DB
     *
     * @param array $product
     *
     * @return array
     */
    protected function prepareProductDataForImport(Array $product)
    {
        $import_order = array_flip(config('webmagic.ecommerce.export_labels'));

        $ecommerce = new Ecommerce();
        $categories = array_flip($ecommerce->categoryGetForSelect('name', 'id'));


        $prepared_product = [];

        foreach ($product as $key => $value) {
            if (isset($import_order[$key])) {

                $prepared_product[$import_order[$key]] = strpos($import_order[$key], 'id') !== false ? (int)$value : $value;

                //Check category
                if ($import_order[$key] === 'category') {
                    if (isset($categories[$value])) {
                        $prepared_product['category_id'] = $categories[$value];
                    } else {
                        $prepared_product['errors'][$product['ID']] = $this->export_errors['category'][0];
                    }
                }

                //Check additional categories
                if($import_order[$key] === 'additional_categories'){
                    $add_cats = explode(';', trim($value));
                    $prepared_product['additional_categories'] = [];

                    if($add_cats[0]) {
                        foreach ($add_cats as $add_cat_name) {
                            if (isset($categories[$add_cat_name])) {
                                $prepared_product['additional_categories'][] = $categories[$add_cat_name];
                            } else {
                                $prepared_product['errors'][$product['ID']] = $this->export_errors['category'][0];
                            }
                        }
                    }
                }
            }
        }

        return $prepared_product;
    }

    /**
     * Save all DB changes needs for import
     *
     * All products in array must have key "status" with one of: delete, update, create
     *
     * @param array $products
     *
     * @return bool
     */
    protected function saveDBChangesForImport(Array $products)
    {
        foreach ($products as $product_data) {
            switch ($product_data['status']) {
                case 'update':
                    $this->update($product_data['id'], $product_data);
                    break;

                case 'create':
                    $this->create($product_data);
                    break;

                case 'delete':
                    $this->destroy($product_data['id'], $product_data);
                    break;
            }

        }
        return true;
    }



    /**
     * Export all products as .zip
     *
     * @return string
     */
    public function exportImages()
    {
        $zipper = new Zipper();

        return $zipper->make(storage_path() . '/vendor/ecommerce/export/' . config('webmagic.ecommerce.images_export_filename') . '.zip')
            ->add(public_path(config('webmagic.ecommerce.products_img_path')))
            ->getFilePath();
    }

    /**
     * Update all images from .zip
     *
     * @param $zip_file_path
     */
    public function updateImages($zip_file_path)
    {
        $zipper = new Zipper();
        $zipper->make($zip_file_path)->extractTo(public_path(config('webmagic.ecommerce.products_img_path')));
    }


    /**
     * Create backup before inserting
     */
    public function createTableCopy()
    {
        DB::statement('DROP TABLE IF EXISTS ecom_products_copy');

        DB::statement('CREATE TABLE ecom_products_copy LIKE ecom_products');

        DB::statement('INSERT INTO ecom_products_copy SELECT * FROM ecom_products');

    }


    /**
     * Return previous information about products
     */
    public function backupImport()
    {
        DB::statement('DROP TABLE IF EXISTS ecom_products');

        DB::statement('CREATE TABLE ecom_products LIKE ecom_products_copy');

        DB::statement('INSERT INTO ecom_products SELECT * FROM ecom_products_copy');

        return true;
    }

}