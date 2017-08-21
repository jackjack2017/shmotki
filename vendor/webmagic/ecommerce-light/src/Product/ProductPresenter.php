<?php


namespace Webmagic\EcommerceLight\Product;

use Webmagic\Core\Presenter\Presenter;

class ProductPresenter extends Presenter
{
    /**
     * Prepare URL
     *
     * @return mixed
     */
    public function url()
    {
        $url_generation_rule = config('webmagic.ecommerce.products_url_generation_rule');
        $url = str_replace('{tag}', $this->tag, $url_generation_rule);
        $url = str_replace('{id}', $this->id, $url);

        return url($url);
    }

    /**
     * Main image
     *
     * @return string
     */
    public function mainImage()
    {
        return $this->prepareImageURL($this->main_image);
    }


    /**
     * Main image
     *
     * @return string
     */
    public function fileLink()
    {
        return $this->prepareFileURL($this->entity->file);
    }

    /**
     * Prepare URLs for gallery images
     *
     * @return array
     */
    public function gallery()
    {
        if(!isset($this->gallery)) {
            if ($product_images = explode('|', $this->images)) {
                foreach ($product_images as &$image) {
                    if (strlen($image) > 0) {
                        $image = $this->prepareImageURL($image);
                    } else {
                        $image = '';
                    }
                }

                $this->gallery = strlen($product_images[0]) > 0 ? $product_images : [];
            }
        }

        return $this->gallery;
    }


    /**
     * Prepare url for images
     *
     * @param $file_name
     *
     * @return string
     */
    protected function prepareImageURL($file_name)
    {
        return asset(config('webmagic.ecommerce.products_img_path') . '/' . $file_name);
    }


    /**
     * Prepare url for files
     *
     * @param $file_name
     *
     * @return string
     */
    protected function prepareFileURL($file_name)
    {
        return asset(config('webmagic.ecommerce.products_file_path') . '/' . $file_name);
    }



    /**
     * Prepare price for showing
     *
     * @param $price
     *
     * @return string
     */
    public function formatPrice($price)
    {
        $number_format = config('webmagic.ecommerce.product.number_format');

        return number_format($price, $number_format['decimals'], $number_format['dec_point'], $number_format['thousands_sep']);
    }





}