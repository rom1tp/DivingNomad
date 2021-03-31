<?php
class LocationsBackController extends BackController
{
  public function display()
  {
    $locations = $this->_locationsModel->getAllLocations();
    $template = 'locationsBack.phtml';
    include $this->_layout;
  }
}