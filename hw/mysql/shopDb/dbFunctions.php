<?php
require_once('config.php');
require_once('dbManager.php');

function getProducts($categoryId = null)
{
	$query = "SELECT product_id, name, price FROM products";
	if($categoryId){
		$query .= " WHERE category_fk = " . (int) $categoryId;
	}
	$query .= " ORDER BY name";
    $products = dbGetItemList($query);

	return $products;
}

function getAllCategories()
{
	$query = "SELECT categories.categories_id, categories.name, COUNT( products.category_fk ) AS quantity " .
             "FROM categories " .
             "LEFT JOIN products ON categories.categories_id = products.category_fk " .
             "GROUP BY products.category_fk, categories.name ";
	 $categories = dbGetItemList($query);

	 return $categories;
}