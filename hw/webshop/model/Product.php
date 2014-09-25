<?php

require_once 'Record.php';

class Product extends Record
{
    protected static $tableName = 'products';

    /**
     * Array with values that equals field names from db
     */
    protected $fieldNames = array(
        'id' => 'product_id', 'categoryId' => 'category_fk', 'name' => 'name', 'description' => 'description',
        'price' => 'price', 'date' => 'date', 'quantity' => 'quantity'
    );


    public static function getMostCheap()
    {
        $db = self::getDatabase();
        $query = "SELECT * FROM products ORDER BY price ASC LIMIT 1";
        $data = $db->query($query);
        $items = self::buildItems($data);

        return $items[0];
    }

    public static function getByCategoryId($categoryId)
    {
        $db = self::getDatabase();
        $query = "SELECT * FROM products WHERE category_fk = '" . $categoryId . "' LIMIT 1";
        $data = $db->query($query);
        $items = self::buildItems($data);

        return $items[0];
    }
}