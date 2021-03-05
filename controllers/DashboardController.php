<?php
class DashboardController extends BackController
{
  public function display()
  {
    $template = 'dashboard.phtml';
    include $this->layout;
  }

}