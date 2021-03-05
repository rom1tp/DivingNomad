<?php
// echo '<pre>' . var_export($variable, true) . '</pre>';

// TODO
/**
 *- img caption
 *- show/hide
 *- modify
 *- delete
 * confirm delete
 *- change db posts => travels
 *- store nav in property
 * check form enctype
 * locations select in GalleryBack
 * make css for accounts form useable on all forms
 * htmlspecialchars peco modify or create snippet
 */

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
 */

session_start();
spl_autoload_register(function ($class)
{
  if (stristr($class, 'model'))
  {
    include 'models/' . $class . '.php';
  }
  else
  {
    include 'controllers/' . $class . '.php';
  }
});



if(!isset($_GET['page']) || $_GET['page'] == 'home' )
{
  $controller = new HomeController();
  $controller -> display();
}
else {
  switch ($_GET['page']) {

    // #   ////////////////
    // *  ////FRONTEND////
    // ! ////////////////
    
    // # ACCOUNTS
    case 'accounts':
      $controller = new AccountsController();
      $controller -> display();
      break;
      
    case 'signup':
      $controller = new AccountsController();
      $controller -> signup();
      break;
      
    case 'login':
      $controller = new AccountsController();
      $controller -> login();
      break;
      
    case 'logout':
      $controller = new AccountsController();
      $controller -> logout();
      break;

    // # PROJECTS
    case 'projects':
      $controller = new ProjectsController();
      $controller -> display();
      break;

    // # TRAVELS
    case 'travels':
      $controller = new TravelsController();
      $controller -> display();
      break;

    // # GALLERY
    case 'gallery':
      $controller = new GalleryController();
      $controller -> display();
      break;

    // #   ///////////////
    // *  ////BACKEND////
    // ! ///////////////
    case 'dashboard':
      $controller = new DashboardController();
      $controller -> display();
      break;

    // # PROJECTS BACK
    case 'projectsBack':
      $controller = new ProjectsBackController();
      $controller -> display();
      break;

    case 'uploadProject':
      $controller = new ProjectsBackController();
      $controller -> upload();
      break;

    case 'deleteProject':
      $controller = new ProjectsBackController();
      $controller -> delete();
      break;

    case 'confirmProject':
      $controller = new ProjectsBackController();
      $controller -> confirm();
      break;

    // # TRAVELS BACK
    case 'travelsBack':
      $controller = new TravelsBackController();
      $controller -> display();
      break;

    case 'uploadPost':
      $controller = new TravelsBackController();
      $controller -> upload();
      break;

    case 'deletePost':
      $controller = new TravelsBackController();
      $controller -> delete();
      break;

    case 'confirmPost':
      $controller = new TravelsBackController();
      $controller -> confirm();
      break;

    // # GALLERY BACK
    case 'galleryBack':
      $controller = new GalleryBackController();
      $controller -> display();
      break;

    case 'uploadPhoto':
      $controller = new GalleryBackController();
      $controller -> upload();
      break;

    case 'deletePhoto':
      $controller = new GalleryBackController();
      $controller -> delete();
      break;

    case 'confirmPhoto':
      $controller = new GalleryBackController();
      $controller -> confirm();
      break;

      // # TEST
    case 'test':
      $controller = new TestController();
      $controller -> display();
      break;

  }
}