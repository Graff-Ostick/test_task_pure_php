<?php
require_once __DIR__ . '/etc/config.php';
spl_autoload_register(function ($className) {
    $classPath = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';
    if (file_exists($classPath)) {
        require_once $classPath;
    }
});

$connect = new Model\Connect($host, $db_name, $db_username, $db_password);
$category = new Model\Category($connect);
$product = new Model\Product($connect);

$controller = new Controller\Controller($category, $product);
$controller->execute();
