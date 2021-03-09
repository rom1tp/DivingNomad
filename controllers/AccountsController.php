<?php
class AccountsController extends FrontController
{
 public function display()
 {
  $usersModel = new UsersModel();
  $users = $usersModel->getAllUsers();

  if (isset($_SESSION["user"])) {
   if ($_SESSION["user"] == 'owner') {
    header('location:dashboard');
   } else {
    $template = 'accounts.phtml';
    include $this->layout;
   }
  } else {
   $template = 'accounts.phtml';
   include $this->layout;
  }
 }

 public function login()
 {
  if (isset($_POST)) {
   $_POST["email"];
   $_POST["password"];

   $usersModel = new UsersModel();
   $user = $usersModel->getUser($_POST["email"]);
   if ($user) {
    if (password_verify($_POST["password"], $user["password"])) {
     if ($user['rank'] == 'owner') {
      $_SESSION['user'] = 'owner';
      header("location:dashboard");
     } else {
      $_SESSION["user"] = 'customer';
      header("location:home");
     }
     $_SESSION["email"] = $_POST["email"];
     $_SESSION["userId"] = $user['id'];

    } else {
     $errorMsg = 'Password is incorrect!';
     header("location:accounts-errorMsg-$errorMsg");
    }
   } else {
    $errorMsg = 'Email is incorrect!';
    header("location:accounts-errorMsg-$errorMsg");
   }
  }
 }

 public function signup()
 {

  if (isset($_POST)) {
   if ($_POST["password"] == $_POST["confirmPassword"]) {
    $usersModel = new UsersModel();
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $usersModel->addUser($_POST["email"], $password);
    $id = $usersModel->getLastId();
    $profilesModel = new ProfilesModel();
    $profilesModel->addProfile($id);
    header("location:accounts");
   } else {
    $errorMsg = 'Passwords don\'t match!';
    header("location:accounts-errorMsg-$errorMsg");
   }
  }
 }

 public function logout()
 {
  header('location:accounts');
  session_destroy();
 }

}