<?php


namespace Webmagic\EcommerceLight\Product;


interface ProductExporterContract extends ProductSearchContract
{
    /**
     * Export products to excel
     *
     * @param array $categories_id
     * @param array $selected_export_fields
     */
    public function exportToExcel(Array $categories_id = null,  Array $selected_export_fields = []);

    /**
     * Import products from excel
     *
     * @param $file_path
     * @return bool
     */
    public function importFromExcel($file_path);


    /**
     * Export all products as .zip
     *
     * @return string
     */
    public function exportImages();

    /**
     * Update all images from .zip
     *
     * @param $zip_file_path
     */
    public function updateImages($zip_file_path);


    /**
     * Create backup before inserting
     */
    public function createTableCopy();


    /**
     * Return previous information about products
     */
    public function backupImport();
}