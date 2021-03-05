<?php
class PhotosModel extends ModelManager
{
  public function getAllPhotos()
  {
    $req = "
    SELECT *
    FROM photos
    ORDER BY id_photo";
    return $this -> queryFetchAll($req);
  }
  // fonction qui ajoute une photo dans la base de données
  public function insertPhoto($id_produit, $src)
  {
    $req = "INSERT INTO photos (id_produit, src)
    VALUES(?,?)";
    
    return $this -> query($req, [$id_produit, $src]);
  }
}