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

 public function upload()
 {

  if (isset($_POST['submit']) && isset($_FILES['img'])) {
   $img_name = $_FILES['img']['name'];
   $img_size = $_FILES['img']['size'];
   $tmp_name = $_FILES['img']['tmp_name'];
   $error = $_FILES['img']['error'];

   if ($error == 0) {
    if ($img_size > 5000000) {
     $errorMsg = 'Sorry, your file is too large!';
     header("location:galleryBack-errorMsg-$errorMsg");
    } else {
     $img_extension = pathinfo($img_name, PATHINFO_EXTENSION);
     $img_extension = strtolower($img_extension);
     $allowedExtensions = array('jpg', 'png', 'jpeg');

     if (in_array($img_extension, $allowedExtensions)) {
      $img_name = uniqid("IMG-", true) . '.' . $img_extension;
      $img_upload_path = 'assets/img/' . $img_name;
      move_uploaded_file($tmp_name, $img_upload_path);

      if (!empty($_POST["location_id"])) {
       if (ctype_digit($_POST["location_id"])) {
        $this->_photosModel->addPhoto($_POST["name"], $img_name, $_POST["caption"], $_POST["date"], $_POST["location_id"], $_POST["display"]);
        echo '<pre>' . var_export($_POST, true) . '</pre>';
        echo 'location chosen';
        // header('location:galleryBack');

       } else {
        $errorMsg = 'No continent or country selected!';
        header("location:galleryBack-errorMsg-$errorMsg");
       }
      } else {
       if (!empty($_POST["newLocation"])) {
        if ( // new continent
         $_POST["continent"] == 'new' &&
         !empty($_POST["newContinent"]) &&
         $_POST["country"] == 'new' &&
         !empty($_POST["newCountry"])
        ) {
         $this->_continentsModel->addContinent($_POST["newContinent"]);
         $continentId = $this->_continentsModel->getLastId();
         $this->_countriesModel->addCountry($_POST["newCountry"], $continentId);
         $countryId = $this->_countriesModel->getLastId();
         $this->_locationsModel->addLocation($_POST["newLocation"], $countryId);
         $locationId = $this->_locationsModel->getLastId();
         $this->_photosModel->addPhoto($_POST["name"], $img_name, $_POST["caption"], $_POST["date"], $locationId, $_POST["display"]);
         header('location:galleryBack');
        } elseif ( // new country
         ctype_digit($_POST["continent"]) &&
         $_POST["country"] == 'new' &&
         !empty($_POST["newCountry"])
        ) {
         $this->_countriesModel->addCountry($_POST["newCountry"], $_POST["continent"]);
         $countryId = $this->_countriesModel->getLastId();
         $this->_locationsModel->addLocation($_POST["newLocation"], $countryId);
         $locationId = $this->_locationsModel->getLastId();
         $this->_photosModel->addPhoto($_POST["name"], $img_name, $_POST["caption"], $_POST["date"], $locationId, $_POST["display"]);
         header('location:galleryBack');
        } elseif ( // new location
         ctype_digit($_POST["continent"]) &&
         ctype_digit($_POST["country"])
        ) {
         $this->_locationsModel->addLocation($_POST["newLocation"], $_POST["country"]);
         $locationId = $this->_locationsModel->getLastId();
         $this->_photosModel->addPhoto($_POST["name"], $img_name, $_POST["caption"], $_POST["date"], $locationId, $_POST["display"]);
         header('location:galleryBack');
        } else {
         $errorMsg = 'An input is missing!';
         header("location:galleryBack-errorMsg-$errorMsg");
        }
       } else {
        $errorMsg = 'Select a location!';
        header("location:galleryBack-errorMsg-$errorMsg");
       }
      }
     } else {
      $errorMsg = 'You can\'t upload files of this type!';
      header("location:galleryBack-errorMsg-$errorMsg");
     }
    }
   } else {
    $errorMsg = 'Unknown error occurred!';
    header("location:galleryBack-errorMsg-$errorMsg");
   }
  }
 }

 public function delete()
 {
  $this->_photosModel->deletePhoto($_GET["id"]);
  header('location:galleryBack');
 }

 public function confirm()
 {
  $this->_photosModel->modifyPhoto($_POST["name"], $_POST["caption"], $_POST["date"], $_POST["display"], $_GET["id"]);
  header('location:galleryBack');
 }
}