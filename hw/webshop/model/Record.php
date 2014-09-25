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
            $this->recordData[lcfirst($varName)] = $arguments[0];
        }
    }


    public function save() {
        $data = $this->toArray();
        $db = self::getDatabase();
        unset($data['date']);

        if ($this->getId() == null) {
            unset($data['id']);
            $insertStatementString = "INSERT INTO " . static::$tableName . " SET " . $this->buildSetStatement($data);
            $result = $db->query($insertStatementString);
            $this->setId(mysql_insert_id());
        } else {
            $updateStatementString = "UPDATE " . static::$tableName . " SET " . $this->buildSetStatement($data) .
                " WHERE product_id = '" . $data['id'] . "'";
            $result = $db->query($updateStatementString);
        }

        return $result;
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

    public function toArray()
    {
        return $this->recordData;
    }

    public function translitUa($string) {

        $arr = array(
            'а' => 'a', 'б' => 'b', 'в' => 'v' , 'г' => 'g' , 'д' => 'd'  , 'е' => 'e', 'є' => 'je', 'ж' => 'zh',
            'з' => 'z', 'и' => 'u', 'і' => 'i' , 'ї' => 'j' , 'й' => 'jj' , 'к' => 'k', 'л' => 'l' , 'м' => 'm' ,
            'н' => 'n', 'о' => 'o', 'п' => 'p' , 'р' => 'r' , 'с' => 's'  , 'т' => 't', 'у' => 'y' , 'ф' => 'f' ,
            'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shh', 'ь' => '' , 'ю' => 'jy', 'я' => 'ja',
            ' ' => '-'
        );

        $key = array_keys($arr);
        $val = array_values($arr);
        $translate = str_ireplace($key, $val, mb_strtolower($string, 'UTF-8'));

        return $translate;
    }

    private function buildSetStatement($data) {
        $query = '';
        foreach ($data as $fieldName => $fieldValue) {
            $query .= $this->fieldNames[$fieldName] . " = '" . mysql_real_escape_string($fieldValue) . "', ";
        }

        return substr($query, 0, -2);
    }
}