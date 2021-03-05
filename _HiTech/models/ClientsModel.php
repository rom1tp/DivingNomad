<?php
class ClientsModel extends CM_ModelManager
{
  public function getAllClients()
  {
    $req = "SELECT
    customerName AS Customer,
    customers.customerNumber AS Number,
    customers.city AS City,
    customers.country AS Country
    FROM customers
    ORDER BY customerName";
    return $this -> queryFetchAll($req);
  }
}