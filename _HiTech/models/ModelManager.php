<?php

class ModelManager
{
  protected $bdd;

  public function __construct()
  {
   try
   {
      // * IDE CECILE
      $this -> bdd = new PDO('mysql:host=home.3wa.io:3307;dbname=live-44_itech;charset=utf8','cecilev','MjUwYjQwOTgxMTg5NzAwYTRjNDc5OTA23Wa!');

      // * LOCAL CECILE
      //  $this -> bdd = new PDO('mysql:host=localhost;dbname=live-44_itech;charset=utf8','cecilev','MjUwYjQwOTgxMTg5NzAwYTRjNDc5OTA23Wa!');
      
      // * LOCAL ROMAIN
      //  $this -> bdd = new PDO('mysql:host=localhost;dbname=3wa_iTech;charset=utf8','root','');
      
      // * LOCAL MOHAMED
      //   $this -> bdd = new PDO('mysql:host=localhost;dbname=itech;charset=utf8','root','');
      
      // * LOCAL MATTHIEU
      //  $this -> bdd = new PDO('mysql:host=localhost;dbname=3WA_Itech_bdd;charset=utf8','root','');

      // VOIR ERREURES MYSQL
      $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
   }

   catch (Exception $e)
   {
      echo $e;
   }
  }

  public function queryFetchAll($req, $params = [])
  {
     $query = $this -> bdd -> prepare($req);
     $query -> execute($params);
     return $query -> fetchAll(PDO::FETCH_ASSOC);
  }

  public function queryFetch($req, $params = [])
  {
     $query = $this -> bdd -> prepare($req);
     $query -> execute($params);
     return $query -> fetch(PDO::FETCH_ASSOC);
  }

  public function query($req, $params = [])
  {
     $query = $this -> bdd -> prepare($req);
     return $query -> execute($params);
  }

  public function getLastId()
  {
      return $this -> bdd -> lastInsertId();
  }
}  