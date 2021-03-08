<?php
class GalleryController extends FrontController
{
 public function display()
 {
  $photosModel = new PhotosModel();
  $photos = $photosModel->getAllPhotos();
  $template = 'gallery.phtml';
  include $this->layout;
 }
}