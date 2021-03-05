<?php

class AddBoutiqueController extends SessionController
{
  private bool $modifyMode;
  private array $boutique;

  public function __construct() {
    $this->modifyMode = false;
    $this->boutique = array();
  }

  public function display()
  {
    $template = 'view_addBoutique.phtml';
    include 'views/backLayout.phtml';
  }

   public function validateBoutique()
  {
    
    $model = new BoutiquesModel();
    $boutiques = $model -> insertBoutique($_POST['nomBoutique']);

    header('location:boutiques');
  }

  public function modifyBoutique()
  {
    $this->modifyMode = !$this->modifyMode;
    $model = new BoutiquesModel();
    $this->boutique = $model -> getBoutique($_GET['BoutiqueID']);
    $this->display();
  }

  public function validateChangesBoutique()
  {
    $this->modifyMode = !$this->modifyMode;
    $model = new BoutiquesModel();
    $model -> modifyBoutique($_POST['nomBoutique'], $_GET['BoutiqueID']);
    header('location:boutiques');
  }
}
  