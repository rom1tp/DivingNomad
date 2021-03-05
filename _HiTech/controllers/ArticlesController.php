<?php
class ArticlesController extends FrontController
{
  private int $articleNumber;
  
  public function __construct() {
    parent::__construct();
    $this->articleNumber = $_GET['articleNumber'];
  }

  public function display()
  {
    $model = new ProductsModel();
    $product = $model -> getProduct($this->articleNumber);
    $template = 'view_article.phtml';
    include $this->layout;
  }
}