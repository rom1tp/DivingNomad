<?php
class AddRayonController extends SessionController
{
  private bool $modifyMode;
  private array $rayon;
  
  public function __construct() {
    $this->modifyMode = false;
    $this->rayon = array();
  }
  
  public function display()
  {
    $model = new RayonsModel();
    $rayons = $model -> getAllRayons();

    $model2 = new BoutiquesModel();
    $boutiques = $model2 -> getAllBoutiques();

    $template = 'view_addRayon.phtml';
    include 'views/backLayout.phtml';
  }
  
   public function validateRayon()
  {
    $model = new RayonsModel();
    $rayons = $model -> insertRayon($_POST['nom'], $_POST['boutique']);

    header('location:rayons');
  }
  
  public function modifyRayon()
  {
    $this->modifyMode = !$this->modifyMode;
    $model = new RayonsModel();
    $this->rayon = $model -> getRayon($_GET['RayonID']);
    $this->display();
  }
  
  public function validateChangesRayon()
  {
    $this->modifyMode = !$this->modifyMode;
    $model = new RayonsModel();
    $model -> modifyRayon($_POST['nom'], $_POST['boutique'], $_GET['RayonID']);
    header('location:rayons');
  }
}