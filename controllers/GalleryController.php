<?php
class GalleryController extends FrontController
{
  public function display()
  {
    $galleryModel = new GalleryModel();
    $photos = $galleryModel->getAllPhotos();
    $template = 'gallery.phtml';
    include $this->layout;
  }
}