<?php
class TestController extends FrontController
{
 public function display()
 {
  $template = 'test.phtml';
  include $this->layout;
 }

}