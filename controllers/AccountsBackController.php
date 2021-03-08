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
  if ($_POST["newPassword"] == $_POST["confirmPassword"]) {
   $password = password_hash($_POST["confirmPassword"], PASSWORD_DEFAULT);
   if (password_verify($_POST["oldPassword"], $user["password"])) {
    $usersModel->modifyUser($_POST["firstName"], $_POST["lastName"], $_POST["dob"], $_POST["email"], $_POST["address"], $password, $_SESSION["userId"]);
    header('location:accountBack');
   }
  }
 }
}