<?php

require_once 'Record.php';

class Category extends Record
{
    protected static $tableName = 'categories';

    /**
     * Array with values that equals field names from db
     */
    protected $fieldNames = array('id' => 'categories_id', 'name' => 'name', 'dateCreate' => 'date_create');
}