<?php
class AccountsBackController extends BackController
{
 public function display()
 {
  $template = 'accountBack.phtml';
  include $this->layout;
 }

 public function getAccount()
 {
  $usersModel = new UsersModel();
  $user = $usersModel->getUser($_SESSION["userId"]);

  $template = 'accountBack.phtml';
  include $this->layout;
 }
}