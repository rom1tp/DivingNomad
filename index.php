<?php
// echo '<pre>' . var_export($variable, true) . '</pre>';

// TODO
/**
 * TRAVELS
 *- img caption
 *- show/hide
 *- modify
 *- delete
 * confirm delete
 * change db photos => travels
 * 
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

    case 'uploadPhoto':
      $controller = new TravelsBackController();
      $controller -> upload();
      break;

    case 'deletePhoto':
      $controller = new TravelsBackController();
      $controller -> delete();
      break;

    case 'confirmPhoto':
      $controller = new TravelsBackController();
      $controller -> confirm();
      break;

      
  }
}