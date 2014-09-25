<?php
require_once 'controllers/BaseController.php';
require_once 'model/Category.php';
require_once 'model/Product.php';

class CatalogController extends BaseController
{
    public function indexAction()
    {
        $categories = Category::getAllCategories();
        $content = $this->renderTemplate('views/categories.php', array('categories' => $categories));
        $layout = $this->renderTemplate('views/layout.php', array('content' => $content));

        return $layout;
    }

    public function showAction($request)
    {
        $category = Category::findOne(array('categories_id' => $request['id']));
        $products = Product::findAll(array('category_fk' => $request['id']));
        $content = $this->renderTemplate('views/products.php', array('products' => $products, 'category' => $category));
        $layout = $this->renderTemplate('views/layout.php', array('content' => $content));

        return $layout;
    }

    public function showProductAction($request)
    {
        $product = Product::findOne(array('product_id' => $request['id']));
        $category = Category::findOne(array('categories_id' => $product->getCategoryId()));
        $content = $this->renderTemplate('views/product.php', array('product' => $product, 'category' => $category));
        $layout = $this->renderTemplate('views/layout.php', array('content' => $content));

        return $layout;
    }

}