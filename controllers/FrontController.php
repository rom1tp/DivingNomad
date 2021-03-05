<?php
class FrontController
{
  protected $layout;

  public function __construct()
  {
    $this->layout = 'views/layoutFront.phtml';
  }
}