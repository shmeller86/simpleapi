<?php
// Front Controller
//1. Settings
ini_set('display_errors', 1);
error_reporting(E_ALL);
//2. connecting files
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/Autoload.php');
//3. run Router
$router = new Router();
$router->run();

