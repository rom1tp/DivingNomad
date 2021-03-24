<?php
class PhotoBackController extends BackController
{

  public function display(bool $modify = false)
  {
    $this->_modify = $modify == 'modify' ? true : false;
    $modify ? $photo = $this->_photosModel->getPhoto($_GET["id"]) : '';
    $locations = $this->_locationsModel->getAllLocations();
    $countries = $this->_countriesModel->getAllCountries();
    $continents = $this->_continentsModel->getAllContinents();
    $template = 'photoBack.phtml';
    include $this->_layout;
  }

  private function uploadFile($name, $extension, $category, $tmp_name)
  {
    $img_name = uniqid($name . "-", true) . '.' . $extension;
    if (!file_exists("assets/img/gallery/$category/")) {

      mkdir("assets/img/gallery/$category/", 0777, true);
    }
    $img_upload_path = "assets/img/gallery/$category/$img_name";
    move_uploaded_file($tmp_name, $img_upload_path);
    return $img_upload_path;
  }

  public function upload()
  {
    if (isset($_POST['submit']) && isset($_FILES['img'])) {
      $img_name = $_FILES['img']['name'];
      $img_size = $_FILES['img']['size'];
      $tmp_name = $_FILES['img']['tmp_name'];
      $error = $_FILES['img']['error'];

      if ($error == 0) {
        if ($img_size > 10000000) {
          $errorMsg = 'Sorry, your file is too large!';
          header("location:galleryBack-errorMsg-$errorMsg");
        } else {
          $img_extension = pathinfo($img_name, PATHINFO_EXTENSION);
          $img_extension = strtolower($img_extension);
          $allowedExtensions = array('jpg', 'png', 'jpeg');

          if (in_array($img_extension, $allowedExtensions)) {
            if (!empty($_POST["location_id"])) {
              if ( // location
                ctype_digit($_POST["location_id"])
              ) {
                $country = $this->_locationsModel->getLocation($_POST["location_id"])['country'];
                $src = $this->uploadFile($_POST["name"], $img_extension, $country, $tmp_name);
                $this->_photosModel->addPhoto($_POST["name"], $src, $_POST["caption"], $_POST["date"], $_POST["location_id"], $_POST["display"]);
                header('location:galleryBack');
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
                  $country = $this->_locationsModel->getLocation($locationId)['country'];
                  $src = $this->uploadFile($_POST["name"], $img_extension, $country, $tmp_name);
                  $this->_photosModel->addPhoto($_POST["name"], $src, $_POST["caption"], $_POST["date"], $locationId, $_POST["display"]);
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
                  $country = $this->_locationsModel->getLocation($_POST["location_id"])['country'];
                  $src = $this->uploadFile($_POST["name"], $img_extension, $country, $tmp_name);
                  $this->_photosModel->addPhoto($_POST["name"], $src, $_POST["caption"], $_POST["date"], $locationId, $_POST["display"]);
                  header('location:galleryBack');
                } elseif ( // new location
                  ctype_digit($_POST["continent"]) &&
                  ctype_digit($_POST["country"])
                ) {

                  $this->_locationsModel->addLocation($_POST["newLocation"], $_POST["country"]);
                  $locationId = $this->_locationsModel->getLastId();
                  $country = $this->_locationsModel->getLocation($_POST["location_id"])['country'];
                  $src = $this->uploadFile($_POST["name"], $img_extension, $country, $tmp_name);
                  $this->_photosModel->addPhoto($_POST["name"], $src, $_POST["caption"], $_POST["date"], $locationId, $_POST["display"]);
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

  public function confirm()
  {
    if (!empty($_POST["location_id"])) {
      if ( // location
        ctype_digit($_POST["location_id"])
      ) {
        $this->_photosModel->modifyPhoto($_POST["name"], $_POST["caption"], $_POST["date"], $_POST["location_id"], $_POST["display"], $_GET["id"]);
        header('location:galleryBack');
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
          $this->_photosModel->modifyPhoto($_POST["name"], $_POST["caption"], $_POST["date"], $locationId, $_POST["display"], $_GET["id"]);
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
          $this->_photosModel->modifyPhoto($_POST["name"], $_POST["caption"], $_POST["date"], $locationId, $_POST["display"], $_GET["id"]);
          header('location:galleryBack');
        } elseif ( // new location
          ctype_digit($_POST["continent"]) &&
          ctype_digit($_POST["country"])
        ) {

          $this->_locationsModel->addLocation($_POST["newLocation"], $_POST["country"]);
          $locationId = $this->_locationsModel->getLastId();
          $this->_photosModel->modifyPhoto($_POST["name"], $_POST["caption"], $_POST["date"], $locationId, $_POST["display"], $_GET["id"]);
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
  }
}