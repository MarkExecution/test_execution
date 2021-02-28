<?php

use Mark\Models;
use Mark\Controllers;

include_once $_SERVER['DOCUMENT_ROOT'].'/../conf.php';

spl_autoload_register(function ($class_name) {
    try {
        $directoryPath = LIB_DIR . str_replace('Mark/', '', str_replace('\\', '/', $class_name));
        include_once $directoryPath . '.php';

    } catch (Exception $e) {
        throw new \Exception($e->getMessage());
    }
});

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo file_get_contents(TEMPLATES.'index.html');
    exit();
}

$db = new Models\DatabaseClass($host, $my_db, $user, $passw);

$arguments =  json_decode(file_get_contents('php://input'), true);

$controller = new Controllers\Core($db, $arguments);

$controller->run();

