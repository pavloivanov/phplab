<?php
require_once 'AdminBaseController.php';
require_once '../model/Record.php';
require_once '../model/Product.php';

class AdminProductsController extends AdminBaseController
{
    public function indexAction()
    {
        $products = Product::getAll();
        $content = $this->renderTemplate('views/products.php', array('products' => $products));
        $layout = $this->renderTemplate('views/layout.php', array('content' => $content));

        return $layout;
    }


    public function showFormAction($request) {
        $product = (isset($request['id'])) ? Product::findOne(array('product_id' => $request['id'])) : new Product();
        $content = $this->renderTemplate('views/productForm.php', array('product' => $product));
        $layout = $this->renderTemplate('views/layout.php', array('content' => $content));

        return $layout;
    }


    public function addAction($request) {
        if (isset($request['id'])) {
            $product = Product::findOne(array('product_id' => $request['id']));
            $product->bind($request);
        } else {
            $product = new Product($request);
            $product->setCategoryId(1);
        }
        $product->save();
        header("Location: index.php");
        exit();
    }
}
