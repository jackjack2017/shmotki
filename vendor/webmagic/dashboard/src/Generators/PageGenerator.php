<?php


namespace Webmagic\Dashboard\Generators;


class PageGenerator
{
    protected $tmp_fields = [
        'fields' => [
            'id' =>  'ID',
            'name' => 'Название',
        ],
        'actions' => [
            'delete' => [
                'url' => '/product/1',
                'method' => 'DELETE',
                'credentials' => false
            ],
            'edit' => [
                'url' => 'dashboard/ecommerce/product/1/edit',
                'ajax' => false
            ]
        ]
    ];




    public function makeDataTablePage($collection)
    {
        return view('dashboard::generators.data_table', ['collection' => $collection, 'fields_data' => $this->tmp_fields]);
    }
}