<?php
class DashboardController extends SessionController
{
  public function display()
  {
    
    $template = 'view_dashboard.phtml';
    include 'views/backLayout.phtml';
  }
}