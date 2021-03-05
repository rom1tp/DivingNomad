<?php
class BackController
{
  protected $layout;

  public function __construct()
  {
    $this->layout = 'views/layoutBack.phtml';
  }
}