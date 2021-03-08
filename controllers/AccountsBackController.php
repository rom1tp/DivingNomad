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
  // TODO add all user and profile info
  $usersModel->modifyUser($_POST["key"]);

  // instantiate users AND profiles Model
 }
}