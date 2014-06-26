<?php
/**
 * Created by JetBrains PhpStorm.
 * User: USER
 * Date: 26.06.14
 * Time: 12:25
 * To change this template use File | Settings | File Templates.
 */

class ModelExportCSV extends Model{

    public function getProductData()
    {
        $this->load()->model('catalog/product');

        $products = $this->model_catalog_product->getProducts();

        $data = array();

        foreach($products as $product)
        {
            $data[] = array(
                $product['product_id'],
                $product['name'],
                $product['description'],
                $product['ean'],
                $product['category'],
                $product['price'],
                $product['quantity'],
                $product['status'],
                $product['comment'],
                $product['image'],

            );
        }

        return $data;
    }
}