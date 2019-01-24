

<?php 

// FRONT_CONTROLLER 

// 1. Загальны налаштування 
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
// 2. Підключення файлів системи 

define('ROOT', dirname(__FILE__));
require_once ROOT.'/components/Autoload.php';
//require_once ROOT.'/components/Router.php';
//require_once(ROOT.'/components/Db.php');


// 3. Підключення бази даних 

// 4. Виклик Router
$router = new Router();
$router->run();
