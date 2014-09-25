<?php

require_once 'model/Record.php';

class Category extends Record
{
    protected static $tableName = 'categories';

    /**
     * Array with values that equals field names from db
     */
    protected $fieldNames = array(
        'id'         => 'categories_id',
        'name'       => 'name',
        'dateCreate' => 'date_create',
        'quantity'   => 'quantity'
    );

    public static function getAllCategories()
    {
        $query = "SELECT categories.categories_id, categories.name, COUNT( products.category_fk ) AS quantity " .
            "FROM categories " .
            "LEFT JOIN products ON categories.categories_id = products.category_fk " .
            "GROUP BY products.category_fk, categories.name ";
        $db = self::getDatabase();
        $data = $db->query($query);
        $categories = self::buildItems($data);

        return $categories;
    }
}