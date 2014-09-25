    <?php
    require_once '../Authentication.php';

    Authentication::adminPanelAuth();

    require_once '../config.php';
    require_once '../model/Database.php';
    require_once 'controllers/AdminProductsController.php';


    $router = array(
        'products'   => 'AdminProductsController'
    );

    $request = isset($_REQUEST) ? $_REQUEST : array();
    $request['controller'] = isset($request['controller']) ? $request['controller'] : 'products';

    try {
        if (!array_key_exists($request['controller'], $router)) {
            throw new Exception('404: page not found - Controller');
        }
    } catch (Exception $e) {
        echo $e->getMessage();
        exit;
    }

    $action = isset($request['action']) ? $request['action'] : 'index';
    $key = $request['controller'];
    $controllerClass = $router[$key];
    $methodName = $action . 'Action';
    $controller = new $controllerClass();

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
