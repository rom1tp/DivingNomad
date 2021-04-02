<?php
class AboutController extends FrontController
{
 public function display()
 {
  $template = 'about.phtml';
  include $this->_layout;
 }
}