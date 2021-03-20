<?php
class GalleryBackController extends BackController
{

  public function display()
  {
    $photos = $this->_photosModel->getAllPhotos();
    $locations = $this->_locationsModel->getAllLocations();
    $countries = $this->_countriesModel->getAllCountries();
    $continents = $this->_continentsModel->getAllContinents();
    $template = 'galleryBack.phtml';
    include $this->_layout;
  }

  public function delete()
  {
    $photo = $this->_photosModel->getPhoto($_GET["id"]);
    unlink($photo['src']);
    $this->_photosModel->deletePhoto($_GET["id"]);
    header('location:galleryBack');
  }

  public function confirm()
  {
    $this->_photosModel->modifyPhoto($_POST["name"], $_POST["caption"], $_POST["date"], $_POST["display"], $_GET["id"]);
    header('location:galleryBack');
  }
}