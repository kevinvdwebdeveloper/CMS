<?php
// Define PATH's
define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH . 'view' . DIRECTORY_SEPARATOR);
define('MODULE_PATH', ROOT_PATH . 'modules' . DIRECTORY_SEPARATOR);

// Include files
require_once ROOT_PATH . 'src/Controller.php';
require_once ROOT_PATH . 'src/DatabaseConnection.php';
require_once ROOT_PATH . 'src/Entity.php';
require_once ROOT_PATH . 'src/Router.php';
require_once ROOT_PATH . 'src/Template.php';
require_once MODULE_PATH . 'page/models/Page.php';

// Connect to MYSQL database
DatabaseConnection::connect('localhost', 'cms', 'root', '');

// Routing
$action = $_GET['seo_name'] ?? 'home';

$dbh = DatabaseConnection::getInstance();
$dbc = $dbh->getConnection();

$router = new Router($dbc);

$router->findBy('pretty_url', $action);

$action = $router->action != '' ? $router->action : 'default';
$moduleName = ucfirst($router->module) . 'Controller';

$controllerFile = MODULE_PATH . $router->module . '/controllers/' . $moduleName . '.php';

if(file_exists($controllerFile)){
  include $controllerFile;
  $controller = new $moduleName();
  $controller->setEntityId($router->entity_id);
  $controller->runAction($action);
}



?>
