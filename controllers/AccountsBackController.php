<?php
class AccountsBackController extends BackController
{
 public function display()
 {
  $usersModel = new UsersModel();
  $user = $usersModel->getUser($_SESSION["email"]);
  $template = 'accountBack.phtml';
  include $this->layout;
 }

 public function confirmProfile()
 {
  $usersModel = new UsersModel();
  $user = $usersModel->getUser($_POST["email"]);

  if (!empty($_POST["oldPassword"]) && !empty($_POST["newPassword"]) && !empty($_POST["confirmPassword"])) {
   if ($_POST["newPassword"] == $_POST["confirmPassword"]) {
    $password = password_hash($_POST["confirmPassword"], PASSWORD_DEFAULT);
    if (password_verify($_POST["oldPassword"], $user["password"])) {
     $usersModel->modifyPassword($password, $_SESSION["userId"]);
     $usersModel->modifyUser($_POST["firstName"], $_POST["lastName"], $_POST["dob"], $_POST["email"], $_POST["address"], $_SESSION["userId"]);
     header('location:accountBack');
    } else {
     $errorMsg = 'Old password is incorrect!';
     header("location:accountBack-errorMsg-$errorMsg");
    }
   } else {
    $errorMsg = 'Passwords don\'t match!';
    header("location:accountBack-errorMsg-$errorMsg");
   }
  } else {
   $usersModel = new UsersModel();
   $usersModel->modifyUser($_POST["firstName"], $_POST["lastName"], $_POST["dob"], $_POST["email"], $_POST["address"], $_SESSION["userId"]);
   header('location:accountBack');
  }
 }
}