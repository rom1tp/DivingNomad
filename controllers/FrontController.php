<?php
class FrontController extends PagesController
{
 protected $_layout;

 public function __construct()
 {
  parent::__construct();
  $this->_layout = 'views/layoutFront.phtml';
 }
}