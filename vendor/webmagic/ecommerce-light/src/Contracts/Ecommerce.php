<?php


namespace Webmagic\EcommerceLight\Contracts;


interface Ecommerce
{
    /**
     * Need to use for any calls
     *
     * @param $method
     * @param $args
     * @return mixed
     */
    public function __call($method, $args);
}