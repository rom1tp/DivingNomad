<?php
class GalleryController extends FrontController
{
 public function display()
 {
  $photos = $this->_photosModel->getAllPhotos();
  $continents = $this->_continentsModel->getAllContinents();
  $countries = $this->_countriesModel->getAllCountries();
  $template = 'gallery.phtml';
  include $this->_layout;
 }
}