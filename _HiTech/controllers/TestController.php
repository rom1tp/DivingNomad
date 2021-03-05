<?php
class TestController extends FrontController
{
  public function display()
  {
    $template = 'view_test.phtml';
    include 'views/layout.phtml';
  }

  public function displayTest()
  {
    $this->display();
  }
}