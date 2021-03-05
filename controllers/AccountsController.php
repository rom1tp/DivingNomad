<?php
  class AccountsController extends FrontController
{
  public function display()
  {
    $usersModel = new UsersModel();
    $users = $usersModel->getAllUsers();
    
    if (isset($_SESSION["user"]))
    {
      if ($_SESSION["user"] == 'superadmin')
      {
        header('location:dashboard');
      }
      else
      {  
        $template = 'accounts.phtml';
        include $this->layout;
      }
    }
    else
    {  
      $template = 'accounts.phtml';
      include $this->layout;
    }
  }

  public function login()
  {
    if (isset($_POST))
    {
      $_POST["email"];
      $_POST["password"];
      
      $usersModel = new UsersModel();
      $user = $usersModel->getUser($_POST["email"]);

      if ($user)
      {
        if (password_verify($_POST["password"], $user["password"]))
        {
          if ($user['rank'] == 'superadmin')
          {
            $_SESSION['user'] = 'superadmin';
            header("location:dashboard");
          }
          else
          {
            $_SESSION["user"] = 'customer';
            header("location:home");
          }
          $_SESSION["email"] = $_POST["email"];

        }
        else
        {
          $errorMsg = 'Password is incorrect!';
          header("location:accounts-errorMsg-$errorMsg");
        }
      }
      else
      {
        $errorMsg = 'Email is incorrect!';
        header("location:accounts-errorMsg-$errorMsg");
      }
    }
  }

  public function signup()
  {
    $usersModel = new UsersModel();
    
    if (isset($_POST))
    {
      if ($_POST["password"] == $_POST["passwordConfirm"])
      {
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $usersModel->addUser($_POST["email"], $password);
        header("location:accounts");
      } else
      {
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