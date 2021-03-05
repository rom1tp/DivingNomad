<?php
class BasketController extends FrontController
{
  public function addToBasket()
  {
    $productId = $_GET["ProductID"];
    $productModel = new ProductsModel();
    $product = $productModel->getProduct($productId);
    $basketModel = new BasketModel();
    $basketModel->addProduct($product, 1);
    // var_dump($_SESSION['basket']);
    header("location:article-articleNumber-$productId");
  }
}