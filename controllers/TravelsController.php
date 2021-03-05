<?php
class TravelsController extends FrontController
{
  public function display()
  {
    $photosModel = new PhotosModel();
    $photos = $photosModel->getAllPhotos();
    $template = 'travels.phtml';
    include $this->layout;
  }  
}