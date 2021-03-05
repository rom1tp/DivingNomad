<?php
class productsController extends SessionController
{
  private array $products;

  public function __construct() {
    $this->products = array();
  }

  public function display()
  {
    $model = new ProductsModel();
    $this->products = $model -> getAllProducts();

    $template = 'view_products.phtml';
    include 'views/backLayout.phtml';
  }

  public function setButton($statut, $index): string
  {
    switch ($statut) {
      case 'En boutique':
        // TODO: stocker productID dans une propriété
        return "<a href='deleteProduct-ProductID-{$this->products[$index]['ProductID']}'
        class='btn btn-outline-danger shadow-none me-2 delete'
        data-action='retirer' data-id='{$this->products[$index]['ProductID']}'
        data-bs-toggle='modal' data-bs-target='#deleteModal'>
        <i class='fas fa-archive me-1'></i>Retirer</a>";
        break;

      case 'Retiré':
        return "<a data-action='remettre' data-id='{$this->products[$index]['ProductID']}'
        class='btn btn-outline-success shadow-none mx-2'>
        <i class='fas fa-check-square me-1'></i>Remettre</a>";
        break;

      case 'En attente':
        return "<a data-action='boutique' data-id='{$this->products[$index]['ProductID']}'
        class='btn btn-outline-success shadow-none mx-2'>
        <i class='fas fa-check-square me-1'></i>Mettre en boutique</a>";
        break;
        
      default:
      return "";
        break;
    }
  }

  public function setColor($statut): string
  {
    switch ($statut) {
      case 'En boutique':
        return "text-success";
        break;

      case 'Retiré':
        return "text-danger";
        break;

      case 'En attente':
        return "text-secondary";
        break;
        
      default:
        return '';
        break;
   }
  }

    public function deleteProduct()
  {
    $model = new ProductsModel();
    $model -> deleteProduct($_GET['ProductID']);
    header('location:products');
  }

  public function changeStatut()
  {
    $action = $_GET['action'];
    echo $action;
    $productID = $_GET['ProductID'];
    echo $productID;
    
    $model = new ProductsModel();
    $model -> changeStatut($_GET['action'], $_GET['ProductID']);
    // FIXME: le statut ne se recharge pas automatiquement
    header('location:products');
  }
}