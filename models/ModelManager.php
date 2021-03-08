<?php

class ModelManager
{
 protected $_bdd;

 public function __construct()
 {
  try
  {
   // * LOCAL BLOG
   $this->bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');

   // VOIR ERREURES MYSQL
   $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  } catch (Exception $e) {
   echo $e;
  }
 }

 public function queryFetchAll($req, $params = [])
 {
  $query = $this->bdd->prepare($req);
  $query->execute($params);
  return $query->fetchAll(PDO::FETCH_ASSOC);
 }

 public function queryFetch($req, $params = [])
 {
  $query = $this->bdd->prepare($req);
  $query->execute($params);
  return $query->fetch(PDO::FETCH_ASSOC);
 }

 public function query($req, $params = [])
 {
  $query = $this->bdd->prepare($req);
  return $query->execute($params);
 }

 public function getLastId()
 {
  return $this->bdd->lastInsertId();
 }
}