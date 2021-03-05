<?php
class AddProductController extends SessionController
{
  private bool $modifyMode;
  private array $product;

  public function __construct() {
    $this->modifyMode = false;
    $this->product = array();
  }

  public function display()
  {
    $model = new RayonsModel();
    $rayons = $model -> getAllRayons();

    $model2 = new BoutiquesModel();
    $boutiques = $model2 -> getAllBoutiques();

    $model3 = new ProductsModel();
    $products = $model3 -> getAllProducts();

    
    
    $template = 'view_addProduct.phtml';
    include 'views/backLayout.phtml';
  }
    //fonction pour ajouter un produit a la base de donnée
  public function validateProduct()
  {
    $model = new ProductsModel();
    $products = $model -> insertProduct
    ($_POST['Nom'],
    $_POST['Marque'],
    $_POST['Ref'],
    $_POST['Etiquette'],
    $_POST['Prix'],
    $_POST['Ecopart'],
    $_POST['statut'],
    $_POST['DescPrincipale'],
    $_POST['Titre1'],
    "assets/img/".$_FILES['Image1']['name'],
    $_POST['Desc1'],
    $_POST['Titre2'],
    "assets/img/".$_FILES['Image2']['name'],
    $_POST['Desc2'],
    $_POST['Titre3'],
    "assets/img/".$_FILES['Image3']['name'],
    $_POST['Desc3'],
    $_POST['rayon']);
    //fonction qui récupère le dernier Id enregistré dans ModelManager
    $id = $model -> getLastId();
    $model2 = new PhotosModel();
    
    //boucle pour chaque images/input(photo1,photo2,photo3,photo4,photo5)
    $i = 1;
     while($i < 6)
     {
       if(isset($_FILES["photos$i"])){
         //récupération du nom temporaire
        $tmpName = $_FILES["photo$i"]['tmp_name'];
        //déterminer la source
        //TODO uniqueid + extension avec $_FILES
        $src = "assets/img/".$_FILES["photo$i"]['name'];
        //uploader
        move_uploaded_file($tmpName,$src);
        //fonction pour envoyer une photo dans PhotoModel
        $model2 -> insertPhoto($id,$src);
       }
       $i++;
     }
     /*
     foreach($_FILES as $photo) {
       //récupération du nom temporaire
        $tmpName = $_FILES["photo$i"]['tmp_name'];
        //déterminer la source
        $src = "assets/img/".$_FILES["photo$i"]['name'];
        //uploader
        move_uploaded_file($tmpName,$src);
        //fonction pour envoyer une photo dans PhotoModel
        $model2 -> insertPhoto($id,$src);
     }
     */
    //  FIXME: photo n'est pas ajoutée dans le dossier assets/img
      //redirection
     header('location:products');
  }
  
  public function modifyProduct()
  {
    $this->modifyMode = !$this->modifyMode;
    $model = new ProductsModel();
    $this->product = $model -> getProduct($_GET['ProductID']);
    $this->display();
  }

  public function validateChangesProduct()
  {
    $this->modifyMode = !$this->modifyMode;
    $model = new ProductsModel();
    $model -> modifyProduct(
    $_POST['statut'],
    $_POST['rayon'],
    $_POST['Nom'],
    $_POST['Marque'],
    $_POST['Ref'],
    $_POST['Etiquette'],
    $_POST['Prix'],
    $_POST['Ecopart'],
    $_POST['DescPrincipale'],
    $_POST['Titre1'],
    "assets/img/".$_FILES['Image1']['name'],
    $_POST['Desc1'],
    $_POST['Titre2'],
    "assets/img/".$_FILES['Image2']['name'],
    $_POST['Desc2'],
    $_POST['Titre3'],
    "assets/img/".$_FILES['Image3']['name'],
    $_POST['Desc3'],
    $_GET['ProductID']);
    header('location:products');
  }

}