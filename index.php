<?php
// TODO
/** // # GENERAL
 *- img caption
 *- show/hide
 *- modify
 *- delete
 *- change db posts => travels
 *- store nav in property
 *- htmlspecialchars peco modify or create snippet
 *- display => checkbox
 *- locations select in GalleryBack
 *- bootstrap forms
 *- new models as properties
 *- back and front extend pageController
 *- thmg thms => this->Model->get/set
 * like comment img and posts
 * change locations select js document selector to jquery
 * display none all hidden inputs on page load with hidden class
 * add image as url or upload
 * check form enctype
 * social oAuth
 * page redirections based on user
 * page transitions
 * 
 */ // #

/** // ? QUESTIONS
 *- fix table relationships
 * IDE problem with img uploads
 * how to make multilingual website ? JSON ? db ?
 * 
 */ // ?

/** // * CRUD
 *- confirm delete
 *- image picker popup
 *- imgPicker double click to confirm
 *- reset active on open
 * click on overlay to close
 * click on column title to sort
 * CRUD icons as buttons
 * add Item as icon
 * icon hover show action name
 * visibility icon ajax
 * vue data bind visibility icon to text
 * multiple images default null
 * change submit button => icon
 * CRUD as popup from anywhere on the website
 */ // *

/** // * USERS
 * AccountsController => SessionController // ? not sure if necessary
 * delete account
 * 
 */ // *

/** // * FORMS
 * show password button in login/sign-up
 * 
 */ // *

/** // * GALLERY
 *- add continent / country / location
 *- disable countries with js
 * check if new continent/country/location already exists
 * view photo on map
 * map marker CRUD
 * 
 */ // *

/** // * TRAVELS
 *- individual post page
 *- big image .text change spacing from flex to margin/padding
 * -add assets/img to img upload filepath
 * 
 */ // *

/** // * POST
 *- post date
 * shadow on next icon
 * 
 */ // *

/** // * PROJECTS
 * big image on hover
 * 
 */ // *

//  ! FINAL CHECKS
/**
 * htmlspecialchars
 * account shenanigans
 * upload shenanigans
 * file types
 * accessibility
 * image alts
 * code commenting
 * README.md
 * .gitignore
 * no <br>
 * method typing
 */ // !

session_start();
spl_autoload_register(function ($class) {
  if (stristr($class, 'model')) {
    include 'models/' . $class . '.php';
  } else {
    include 'controllers/' . $class . '.php';
  }
});

if (!isset($_GET['page']) || $_GET['page'] == 'home') {
  $controller = new HomeController();
  $controller->display();
} else {
  switch ($_GET['page']) {

      // #   ////////////////
      // *  ////FRONTEND////
      // ! ////////////////
      // # ABOUT
    case 'about':
      $controller = new AboutController();
      $controller->display();
      break;

      // # ACCOUNTS
    case 'accounts':
      $controller = new AccountsController();
      $controller->display();
      break;

    case 'signup':
      $controller = new AccountsController();
      $controller->signup();
      break;

    case 'login':
      $controller = new AccountsController();
      $controller->login();
      break;

    case 'logout':
      $controller = new AccountsController();
      $controller->logout();
      break;

    // # PROJECTS
    case 'projects':
      $controller = new ProjectsController();
      $controller->display();
      break;
    
    case 'project':
      $controller = new ProjectController();
      $controller -> display();
      break;

    // # TRAVELS
    case 'travels':
      $controller = new TravelsController();
      $controller->display();
      break;

    
    // # POST
    case 'post':
      $controller = new PostController();
      $controller->display();
      break;

    // # GALLERY
    case 'gallery':
      $controller = new GalleryController();
      $controller->display();
      break;

    // #   ///////////////
    // *  ////BACKEND////
    // ! ///////////////
    case 'dashboard':
      $controller = new DashboardController();
      $controller->display();
      break;

    // # PROJECTS BACK
    case 'projectsBack':
      $controller = new ProjectsBackController();
      $controller->display();
      break;

    case 'deleteProject':
      $controller = new ProjectsBackController();
      $controller->delete();
      break;

    // # PROJECT BACK
    case 'addProject':
      $controller = new ProjectBackController();
      $controller -> display();
      break;

    case 'uploadProject':
      $controller = new ProjectBackController();
      $controller->upload();
      break;

    case 'modifyProject':
      $controller = new ProjectBackController();
      $controller -> display('modify');
      break;
  
    case 'confirmProject':
      $controller = new ProjectBackController();
      $controller->confirm();
      break;    

    // # TRAVELS BACK
    case 'travelsBack':
      $controller = new TravelsBackController();
      $controller->display();
      break;

    case 'deletePost':
      $controller = new TravelsBackController();
      $controller->delete();
      break;
  
    // # POST BACK
    case 'addPost':
      $controller = new PostBackController();
      $controller -> display();
      break;
  
    case 'uploadPost':
      $controller = new PostBackController();
      $controller->upload();
      break;
      
    case 'modifyPost':
      $controller = new PostBackController();
      $controller -> display('modify');
      break;

    case 'confirmPost':
      $controller = new PostBackController();
      $controller->confirm();
      break;  


    // # GALLERY BACK
    case 'galleryBack':
      $controller = new GalleryBackController();
      $controller->display();
      break;

    case 'deletePhoto':
      $controller = new GalleryBackController();
      $controller->delete();
      break;
  
    case 'getImgSrc':
      $controller = new GalleryBackController();
      $controller -> getImgSrc();
      break;
  

    // # PHOTO BACK
    case 'addPhoto':
      $controller = new PhotoBackController();
      $controller -> display();
      break;

    case 'uploadPhoto':
      $controller = new PhotoBackController();
      $controller->upload();
      break;

    case 'modifyPhoto':
      $controller = new PhotoBackController();
      $controller->display('modify');
      break;

    case 'confirmPhoto':
      $controller = new PhotoBackController();
      $controller->confirm();
      break;


    // # ACCOUNT BACK
    case 'accountBack':
      $controller = new AccountsBackController();
      $controller->display();
      break;

    case 'confirmProfile':
      $controller = new AccountsBackController();
      $controller->confirmProfile();
      break;
      
    // # LOCATIONS BACK
    case 'locationsBack':
      $controller = new LocationsBackController();
      $controller->display();
      break;

    // # LOCATION BACK
    case 'addLocation':
      $controller = new LocationBackController();
      $controller -> display();
      break;

    case 'uploadLocation':
      $controller = new LocationBackController();
      $controller->upload();
      break;

    case 'modifyLocation':
      $controller = new LocationBackController();
      $controller->display('modify');
      break;

    case 'confirmLocation':
      $controller = new LocationBackController();
      $controller->confirm();
      break;
      
    // # TEST
    case 'test':
      $controller = new TestController();
      $controller->display();
      break;
  }
}