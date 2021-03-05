<?php
class AccueilController extends FrontController
{

  public function display()
  {
    $template = 'view_accueil.phtml';
    include $this->layout;
  }
}