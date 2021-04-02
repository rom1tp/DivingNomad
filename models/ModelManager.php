<?php

class ModelManager
{
 protected $_bdd;

 public function __construct()
 {
   // * PRODUCTION BLOG
   $host = 'localhost';
   $db = 'blog';
   $user = 'root';
   $pwd = '';
   $charset = 'utf8';
   $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
   
   // * IDE BLOG
  //  $host = 'localhost';
  //  $db = 'live-44_romaintan_blog';
  //  $user = 'romaintan';
  //  $pwd = '93edfa6fMjZjNzk4NDk5Y2NjYjRhNWRlNzg0Zjlk2712ff64';
  //  $charset = 'utf8';
  //  $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

  // * DEPLOYMENT BLOG
  // $host = 'freedb.tech';
  // $db = 'freedbtech_divingnomad';
  // $user = 'freedbtech_Aarkans';
  // $pwd = 'DivingNomad17';
  // $charset = 'utf8';
  // $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
  
  try
  {
   $this->bdd = new PDO($dsn, $user, $pwd);
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