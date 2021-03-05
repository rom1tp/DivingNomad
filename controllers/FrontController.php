<?php
class FrontController
{
  protected $layout;
  protected $mainNav;

  public function __construct()
  {
    $this->mainNav = 'mainNav.phtml';
    $this->layout = 'views/layoutFront.phtml';
  }
}