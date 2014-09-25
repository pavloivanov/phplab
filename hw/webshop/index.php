<?php
require_once 'config.php';
require_once 'model/Database.php';
require_once 'controllers/CatalogController.php';


$request = isset($_REQUEST) ? $_REQUEST : array();

$action = isset($request['action']) ? $request['action'] : 'index';
$methodName = $action . 'Action';
$controller = new CatalogController();

try {
    if(!method_exists($controller, $methodName)) {
        throw new Exception('404: page not found - Method');
    }
} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}


$layout = $controller->$methodName($request);

echo $layout;
