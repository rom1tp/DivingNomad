<?php
class BoutiquesController extends SessionController
{
  public function display()
  {
    $model = new BoutiquesModel();
    $boutiques = $model -> getAllBoutiques();
    $template = 'view_boutiques.phtml';
    include 'views/backLayout.phtml';
  }

  public function deleteBoutique()
  {
    $model = new BoutiquesModel();
    $model -> deleteBoutique($_GET['BoutiqueID']);
    header('location:boutiques');
  }
}