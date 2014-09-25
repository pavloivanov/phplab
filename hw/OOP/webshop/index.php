<?php

require_once 'Database.php';
require_once 'Product.php';
require_once 'Category.php';

$products = Product::getAll();

$products = Product::getAll();
var_dump(count($products) );

$products = Product::findAll(array('price' => '250', 'name' => 'apple'));

$product = Product::findOne(array('product_id' => '1'));

$product = Product::getMostCheap();
echo $product->getId();
echo $product->getName();

$products = Product::getByCategoryId(Category::findOne(array('categories_id'=>'1'))->getId());

$categories = Category::getAll();