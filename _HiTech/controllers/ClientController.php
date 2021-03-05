<?php
class ClientController extends FrontController
{
  public function display()
  {
    $customerNumber = $_GET['customerNumber'];
    $model = new ClientModel();
    $orders = $model -> getClientOrders();
    $nav = 'view_nav.phtml';
    $template = 'view_client.phtml';
    include 'views/layout.phtml';
  }
}
