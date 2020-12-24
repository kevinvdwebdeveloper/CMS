<?php

class DashboardController extends Controller {

  function runBeforeAction(){
    if($_SESSION['is_admin'] ?? false == true){
      return true;
    }

    $action = $_GET['action'] ?? $_POST['action'] ?? 'default';

    if($action != 'login'){
      header('Location: /admin/index.php?module=dashboard&action=login');
    } else {
      return true;
    }
  }

  function defaultAction(){

    $dbh = DatabaseConnection::getInstance();
    $dbc = $dbh->getConnection();

    $variables['pageObj'] = '';

    $template = new Template('default');
    $template->view('dashboard/admin/views/dashboard', $variables);

  }

  function loginAction(){
    if($_POST['postAction'] ?? 0 == 1){
      $username = $_POST['username'] ?? '';
      $password = $_POST['password'] ?? '';

      $auth = new Auth();
      if($auth->checkLogin($username, $password)){
        $_SESSION['is_admin'] = 1;
        header('Location: /admin/');
        var_dump('loged in');
      }

      var_dump('bad login');
    }

    include VIEW_PATH . 'admin/login.html';
  }

  function pagesAction(){

    $dbh = DatabaseConnection::getInstance();
    $dbc = $dbh->getConnection();

    $pageObj = new Pages($dbc, 'pages');
    $pageObj->findAll();

    $variables['pageObj'] = $pageObj;

    $template = new Template('default');
    $template->view('dashboard/admin/views/pages', $variables);

  }

  function pageAddAction(){
    if($_POST['postActionPage'] ?? 0 == 1){
      $pageTitle = $_POST['page-title'];

      $dbh = DatabaseConnection::getInstance();
      $dbc = $dbh->getConnection();

      $DBQuery = new DatabaseQuery($dbc, 'pages');
      if($DBQuery->addValue($pageTitle)){
          header('Location: /admin/index.php?module=dashboard&action=pages');
      }
    }
  }

  function pageRemoveAction(){
    $pageId = $_GET['id'];

    $dbh = DatabaseConnection::getInstance();
    $dbc = $dbh->getConnection();

    $DBQuery = new DatabaseQuery($dbc, 'pages');
    if($DBQuery->removeValue($pageId)){
        header('Location: /admin/index.php?module=dashboard&action=pages');
    }
  }

  function pageEditAction(){
    $pageId = $_GET['id'];

    $dbh = DatabaseConnection::getInstance();
    $dbc = $dbh->getConnection();

    $pageObj = new Page($dbc);
    $pageObj->findBy('id', $pageId);
    $variables['pageObj'] = $pageObj;

    $template = new Template('default');
    $template->view('dashboard/admin/views/editpage', $variables);
  }

  function saveEditedPageAction($data){

    $response = array();
    $response = array('status' => true, 'message' => 'method doet het');

    echo json_encode($response);

    // $pageData = $_POST['data'];
    //
    // $dbh = DatabaseConnection::getInstance();
    // $dbc = $dbh->getConnection();
    //
    // $DBQuery = new DatabaseQuery($dbc, 'pages');
    // $DBQuery->replaceValue($pageData);

  }
}

?>
