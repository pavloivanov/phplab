<?php

require_once 'config.php';

class DbConnection
{
    static private $instance = null;

    private function __construct() {}

    private function __clone() {}

    static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
            if (!self::$instance){
                throw new Exception('Unable to connect to host');
            }
            mysql_select_db(DB_NAME, self::$instance);
        }
        return self::$instance;
    }
}
?>
