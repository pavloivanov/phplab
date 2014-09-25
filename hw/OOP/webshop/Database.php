<?php

require_once 'config.php';

class Database
{
    protected $dbConnection = null;


    public function __construct()
    {
        if($this->dbConnection === null ) {
            $this->dbConnection = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
            if (!$this->dbConnection) {
                throw new Exception('Unable to connect to host');
            }
            mysql_select_db(DB_NAME, $this->dbConnection);
        }

        return $this->dbConnection;
    }

    public function query($query)
    {
        $results = mysql_query($query, $this->dbConnection);

        $this->dbCheckError($query);

        $items = array();
        while($row = mysql_fetch_assoc($results)){
            $items[] = $row;
        }

        return $items;
    }


    protected function dbCheckError($query)
    {
        if (mysql_error($this->dbConnection)) {
            $error = mysql_error($this->dbConnection);
            $errorNum = mysql_errno($this->dbConnection);

            throw new Exception("Unable to execute query: {$query}."
                . " Error text: {$error}."
                . " Error details: {$errorNum}");
        }

        return true;
    }
}