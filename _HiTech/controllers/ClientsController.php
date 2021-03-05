<?php
class ClientsController extends FrontController
{
  public function display()
  {
    $model = new ClientsModel();
    $clients = $model -> getAllClients();
    $nav = 'view_nav.phtml';
    $template = 'view_clients.phtml';
    include 'views/layout.phtml';
  }
}
