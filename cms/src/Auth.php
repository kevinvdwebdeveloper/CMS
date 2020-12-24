<?php

class Auth {
  function checkLogin($username, $password){
    $dbh = DatabaseConnection::getInstance();
    $dbc = $dbh->getConnection();

    $userObj = new User($dbc);
    $userObj->findBy('username', $username);

    var_dump($userObj->password);
    $checkPassword = (md5($password . ENCRYPTION_SALT . $userObj->password_hash));

    if(property_exists($userObj, 'id')){
      if($checkPassword == $userObj->password){
        return true;
      }
    }
  }

  function changeUserPassword($userObj, $newPassword){
    $tmp = date('YmdHis') . 'stringofsecrets101';
    $hash = md5($tmp);
    $hashedPassword = md5($newPassword . ENCRYPTION_SALT . $hash);

    $userObj->password = $hashedPassword;
    $userObj->password_hash = $hash;
    return $userObj;
  }
}

?>
