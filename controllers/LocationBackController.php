<?php
class LocationBackController extends BackController
{

  public function display(bool $modify = false)
  {
    $this->_modify = $modify == 'modify' ? true : false;
    $modify ? $location = $this->_locationsModel->getLocation($_GET["id"]) : '';
    $locations = $this->_locationsModel->getAllLocations();
    $countries = $this->_countriesModel->getAllCountries();
    $continents = $this->_continentsModel->getAllContinents();
    $template = 'locationBack.phtml';
    include $this->_layout;
  }

  public function upload()
  {
    if (isset($_POST['submit'])) {

      if (!empty($_POST["location_id"])) {
        if ( // location
          ctype_digit($_POST["location_id"])
        ) {
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