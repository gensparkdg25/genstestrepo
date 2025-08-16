<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//We added session to turn off other sessions locally
session_name('gsparktest_session');
session_start();
//Database connection
require_once __DIR__ . '/../app/Config/Config.php';
//Load php class without re declaring Models/class
require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\App;

$app = new App();
