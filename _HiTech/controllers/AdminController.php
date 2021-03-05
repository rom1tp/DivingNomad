<?php
class AdminController extends FrontController
{
  private string $userIdentifiant;
  private string $userPassword;
  private string $bddIdentifiant;
  private string $bddPassword;
  private bool $tentative;

  public function __construct() {
    $this->tentative = false;
    parent::__construct();

  }

  public function display()
  {
    
    if(isset($_SESSION['user']))
    {
      header('location:dashboard');
      exit;
    }
    if(isset($_POST['submit']))
    {
    $identifiant = $_POST['identifiant'];
    }
    
    $template = 'view_admin.phtml';
    include 'views/layout.phtml';
  }

  public function connect()
  {
    if(isset($_POST))
    {
      //récupérer ce qu'envoie le formulaire
      $this -> userIdentifiant = $_POST['identifiant'];
      $this -> userPassword = $_POST['password'];
      $this -> tentative = true;
      
      //chercher les informations en base de donnée
      $model = new ProfileModel();
      $user = $model -> getUserProfiles($this -> userIdentifiant);
      var_dump($user);
      
      //soit tu as les infos // soit on a false
      if($user){
        $this -> bddPassword = $user['mdp'];
        if(password_verify($this -> userPassword, $this -> bddPassword))
          {
            //créer une session
            $_SESSION['user'] = 'admin';
            header("location:dashboard");
          }
        else
          {
            $this -> display();
            session_destroy();
          }
      }
      else
      {
        $this -> display();
        session_destroy();
      }
    }
  }
}