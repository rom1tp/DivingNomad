<?php
class PagesController
{
 protected $_errors;
 protected $_errorMsg;
 protected $_layout;
 protected $_mainNav;
 protected $_usersModel;
 protected $_profilesModel;
 protected $_postsModel;
 protected $_photosModel;
 protected $_postsPhotosModel;
 protected $_projectsModel;
 protected $_locationsModel;
 protected $_countriesModel;
 protected $_continentsModel;

 protected function __construct()
 {
  $this->errors = false;
  $this->_usersModel = new UsersModel();
  $this->_profilesModel = new ProfilesModel();
  $this->_postsModel = new PostsModel();
  $this->_photosModel = new PhotosModel();
  $this->_postsPhotosModel = new PostsPhotosModel();
  $this->_projectsModel = new ProjectsModel();
  $this->_locationsModel = new LocationsModel();
  $this->_countriesModel = new CountriesModel();
  $this->_continentsModel = new ContinentsModel();
  $this->_users = $this->_usersModel->getAllUsers();
  $this->_profiles = $this->_profilesModel->getAllProfiles();
  $this->_posts = $this->_postsModel->getAllPosts();
  $this->_photos = $this->_photosModel->getAllPhotos();
  $this->_projects = $this->_projectsModel->getAllProjects();
  $this->_locations = $this->_locationsModel->getAllLocations();
  $this->_countries = $this->_countriesModel->getAllCountries();
  $this->_continents = $this->_continentsModel->getAllContinents();
 }
}