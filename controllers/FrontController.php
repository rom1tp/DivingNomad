<?php
class FrontController extends PagesController
{
 protected $_layout;
 protected $_navFront;

 public function __construct()
 {
  parent::__construct();
  $this->_navFront = 'navFront.phtml';
  $this->_layout = 'views/layoutFront.phtml';
 }
}