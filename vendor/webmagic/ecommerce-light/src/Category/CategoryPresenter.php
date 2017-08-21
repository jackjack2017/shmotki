<?php


namespace Webmagic\EcommerceLight\Category;

use Webmagic\Core\Presenter\Presenter;

class CategoryPresenter extends Presenter
{
    /**
     * Prepare URL
     *
     * @return mixed
     */
    public function url()
    {
        $url_generation_rule = config('webmagic.ecommerce.categories_url_generation_rule');
        $url = str_replace('{slug}', $this->slug, $url_generation_rule);
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
        return $this->prepareImageURL($this->img);
    }


    /**
     * Prepare URLs for gallery images
     *
     * @return array
     */
    public function gallery()
    {
        if (!isset($this->gallery)) {
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
        return asset(config('webmagic.ecommerce.categories_img_path') . '/' . $file_name);
    }
}