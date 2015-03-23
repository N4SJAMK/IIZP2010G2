<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');


date_default_timezone_set('Europe/Helsinki');
header('Content-Type: application/json;charset=utf-8');
mb_internal_encoding('UTF-8');



spl_autoload_register(
    function($class) {
        include_once '..'.DIRECTORY_SEPARATOR.str_replace('\\', DIRECTORY_SEPARATOR, $class).'.class.php';
    }
);



unset($_GET, $_POST, $_COOKIE, $_SERVER, $_ENV);

$router = new \api\Router();
$response = $router->getResponse(filter_input(INPUT_GET, 'path', FILTER_SANITIZE_URL));

echo json_encode($response);

