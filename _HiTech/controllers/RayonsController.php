<?php
class RayonsController extends SessionController
{
  public function display()
  {
    $model = new RayonsModel();
    $rayons = $model -> getAllRayons();

    $template = 'view_rayons.phtml';
    include 'views/backLayout.phtml';
  }
  
  public function deleteRayon()
  {
    $model = new RayonsModel();
    $model -> deleteRayon($_GET['RayonID']);
    header('location:rayons');
  }
}