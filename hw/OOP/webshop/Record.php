<?php

abstract class Record
{
    protected static $tableName;

    protected $recordData;


    public function __construct($externalData=array())
    {
        $properties = array_keys($this->fieldNames);
        $this->recordData = array_fill_keys($properties, '');

        if (count($externalData)) {
            $this->bind($externalData);
        }
    }

    /**
     * Builds methods getters and setters
     */
    public function __call($methodName, array $arguments)
    {
        $methodType = substr($methodName, 0, 3);
        $varName = substr($methodName, 3);

        if ($methodType === 'get') {
            return $this->recordData[lcfirst($varName)];
        } elseif ($methodType === 'set') {
            $this->recordData[$varName] = $arguments[0];
        }
    }


    public static function getAll()
    {
        $db = self::getDatabase();
        $data = $db->query('SELECT * FROM ' . static::$tableName);
        $items = self::buildItems($data);

        return $items;
    }

    public static function findAll(array $params)
    {
        $db = self::getDatabase();
        $where = self::buildConditionDb($params);
        $query = "SELECT * FROM " . static::$tableName . " " . $where;
        $data = $db->query($query);
        $items = self::buildItems($data);

        return $items;
    }

    public static function findOne(array $params)
    {
        $db = self::getDatabase();
        $where = self::buildConditionDb($params);
        $query = "SELECT * FROM " . static::$tableName . " " . $where;
        $data = $db->query($query);
        $items = self::buildItems($data);

        return $items[0];
    }

    protected static function getDatabase()
    {
        return new Database();
    }

    /**
     * Builds objects from data of database
     */
    protected static function buildItems($data)
    {
        $items = array();
        foreach ($data as $row) {
            $items[] = new static($row);
        }

        return $items;
    }

    protected static function buildConditionDb(array $params)
    {
        $where = '';
        if (!empty($params)) {
            $where = " WHERE ";
            foreach ($params as $key => $param){
                $where .= $key . " = '" . $param . "' AND ";
            }
            $where = substr($where, 0, -5);
        }

        return $where;
    }

    public function bind($data)
    {

        foreach ($data as $fieldName => $fieldValue ) {
            if ($property = (array_search($fieldName, $this->fieldNames))) {
                $this->recordData[$property] = $fieldValue;
            }
        };

        return true;
    }
}