<?php
class HomeController extends FrontController
{
  public function display()
  {
    
    $template = 'home.phtml';
    include $this->layout;
  }
}