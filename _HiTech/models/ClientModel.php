<?php
class ClientModel extends CM_ModelManager
{
  public function getClientOrders()
  {
    $req = "SELECT
    orders.orderNumber AS `Order #`,
    orderDate AS OrderDate,
    status AS Status

    FROM orders

    WHERE orders.customerNumber = ?

    ORDER BY orderDate    
    ";

    return $this -> queryFetchAll($req, [$_GET['customerNumber']]);
  }
}