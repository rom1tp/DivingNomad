<?php
class BackController
{
 protected $_layout;
 protected $_mainNav;
 protected $_usersModel;
 protected $_profilesModel;
 protected $_photosModel;
 protected $_postsModel;
 protected $_projectsModel;
 protected $_locationsModel;
 protected $_countriesModel;
 protected $_continentsModel;

 public function __construct()
 {
  $this->_usersModel = new UsersModel();
  $this->_profilesModel = new ProfilesModel();
  $this->_photosModel = new PhotosModel();
  $this->_postsModel = new PostsModel();
  $this->_projectsModel = new ProjectsModel();
  $this->_locationsModel = new LocationsModel();
  $this->_countriesModel = new CountriesModel();
  $this->_continentsModel = new ContinentsModel();
  $this->_mainNav = 'mainNav.phtml';
  $this->_layout = 'views/layoutBack.phtml';
 }
}