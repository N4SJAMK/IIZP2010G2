<?php
ob_start('ob_gzhandler');
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


include_once 'Password-lib.php';

if (!isset($_POST) || empty($_POST)) {
    $_POST = json_decode(file_get_contents("php://input"), true);
}


$router = new \api\Router();
$response = $router->getResponse(filter_input(INPUT_GET, 'path', FILTER_SANITIZE_URL));

if ($response !== false) {
    echo json_encode($response);
}

