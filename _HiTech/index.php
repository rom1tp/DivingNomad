<?php
// TODO
/**
 * ajouter nav dans le login
 * ajouter bouton supprimer dans actions
 * bouton de statut dans actions de products justify-start
 * search bar filter on every keypress
 * search bar add auto-complete
 * modification product : afficher nom d'image enregistrée
 * double check mockup de products
 * table header darker
 * actions th center right
 * ajouter un icône pour l'onglet du site
 * ajout de produit: montrer que les rayons de la boutique sélectionnée
 * modal supprimer affiche nom de ce qu'on veut supprimer
 * product caractéristiques.onclick => new page with product info
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

if(!isset($_GET['page']) || $_GET['page'] == 'accueil' )
{
  $controller = new AccueilController();
  $controller -> display();
}
else
{
  switch ($_GET['page'])
  {
    //*   /////////////
    //!  ////ADMIN////
    //? /////////////
    case 'cookieAccept':
      $controller = new FrontController();
      $controller -> createCookie();
      break;

    //*   /////////////
    //!  ////ADMIN////
    //? /////////////
    case 'admin':
      $controller = new AdminController();
      $controller -> display();
      break;
      
    case 'connect':
      $controller = new AdminController();
      $controller -> connect();
      break;
            
    case 'logout':
      $controller = new SessionController();
      $controller -> logout();
      break;
      
    case 'dashboard':
      $controller = new DashboardController();
      $controller -> display();
      break;

    //*   ////////////////
    //!  ////PRODUCTS////
    //? ////////////////
    case 'products':
      $controller = new ProductsController();
      $controller -> display();
      break;

    case 'deleteProduct':
      $controller = new ProductsController();
      $controller -> deleteProduct();
      break;
      
    case 'addProduct':
      $controller = new AddProductController();
      $controller -> display();
      break;
      
    case 'validateProduct':
      $controller = new AddProductController();
      $controller -> validateProduct();
      break;

    case 'modifyProduct':
      $controller = new AddProductController();
      $controller -> modifyProduct();
      break;

    case 'validateChangesProduct':
      $controller = new AddProductController();
      $controller -> validateChangesProduct();
      break;

    case 'changeStatut':
      $controller = new ProductsController();
      $controller -> changeStatut();
      break;

    //*   /////////////////
    //!  ////BOUTIQUES////
    //? /////////////////
    case 'boutiques':
      $controller = new BoutiquesController();
      $controller -> display();
      break;

    case 'deleteBoutique':
      $controller = new BoutiquesController();
      $controller -> deleteBoutique();
      break;

    case 'addBoutique':
      $controller = new AddBoutiqueController();
      $controller -> display();
      break;
    
    case 'validateBoutique':
      $controller = new AddBoutiqueController();
      $controller -> validateBoutique();
      break;

    case 'modifyBoutique':
      $controller = new AddBoutiqueController();
      $controller -> modifyBoutique();
      break;

    case 'validateChangesBoutique':
      $controller = new AddBoutiqueController();
      $controller -> validateChangesBoutique();
      break;
  
    //*   //////////////
    //!  ////RAYONS////
    //? //////////////
    case 'rayons':
      $controller = new RayonsController();
      $controller -> display();
      break;

    case 'deleteRayon':
      $controller = new RayonsController();
      $controller -> deleteRayon();
      break;
      
    case 'addRayon':
      $controller = new AddRayonController();
      $controller -> display();
      break;
  
    case 'validateRayon':
      $controller = new AddRayonController();
      $controller -> validateRayon();
      break;
       
    case 'modifyRayon':
      $controller = new AddRayonController();
      $controller -> modifyRayon();
      break;

    case 'validateChangesRayon':
      $controller = new AddRayonController();
      $controller -> validateChangesRayon();
      break;

    //*   ////////////////
    //!  ////ARTICLES////
    //? ////////////////
    case 'article':
      $controller = new ArticlesController();
      $controller -> display();
      break;
      
    case 'addToBasket':
      $controller = new BasketController();
      $controller -> addToBasket();
      break;


      // FIXME: delete if unused
    case 'profile':
      $controller = new ProfileController();
      $controller -> display();
      break;
      
    // FIXME: delete if unused
    case 'clients':
      $controller = new ClientsController();
      $controller -> display();
      break;

    case 'client':
      $controller = new ClientController();
      $controller -> display();
      break;

    case 'test':
      $controller = new TestController();
      $controller -> display();
      break;

    case 'testUn':
      $controller = new TestController();
      $controller -> displayTest();
      break;

    default:
      # code...
      break;
  }
}