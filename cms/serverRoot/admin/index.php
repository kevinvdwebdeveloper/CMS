<?php
session_start();

// Define PATH's
define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH . 'view' . DIRECTORY_SEPARATOR);
define('MODULE_PATH', ROOT_PATH . 'modules' . DIRECTORY_SEPARATOR);
define('ASSET_PATH', ROOT_PATH . 'assets' . DIRECTORY_SEPARATOR);

define('ENCRYPTION_SALT', 'asaiosedfgfrdg03233324');

// Include files
require_once ROOT_PATH . 'src/Controller.php';
require_once ROOT_PATH . 'src/DatabaseConnection.php';
require_once ROOT_PATH . 'src/Entity.php';
require_once ROOT_PATH . 'src/Router.php';
require_once ROOT_PATH . 'src/Template.php';
require_once ROOT_PATH . 'src/Auth.php';
require_once ROOT_PATH . 'src/DatabaseQuery.php';
require_once MODULE_PATH . 'page/models/Page.php';
require_once MODULE_PATH . 'user/models/User.php';
require_once MODULE_PATH . 'dashboard/admin/models/Pages.php';

// Connect to MYSQL database
DatabaseConnection::connect('localhost', 'cms', 'root', '');

// Routing
$section = $_GET['section'] ?? $_POST['section'] ?? 'dashboard';
$action = $_GET['action'] ?? $_POST['action'] ?? 'default';

var_dump($action);

if ($section=='dashboard') {

    include MODULE_PATH . 'dashboard/admin/controllers/DashboardController.php';

    $dashboardController = new DashboardController();
    $dashboardController->runAction($action);

}



?>
