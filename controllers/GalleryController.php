<?php
class GalleryController extends FrontController
{
 public function display()
 {
  $photos = $this->_photosModel->getAllPhotos();
  $template = 'gallery.phtml';
  include $this->_layout;
 }
}