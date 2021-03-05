<?php
class RayonsModel extends ModelManager
{
  public function getAllRayons()
  {
    $req = "SELECT
    rayon.id_rayon AS RayonID,
    rayon.nom AS Nom,
    boutique.nom AS Boutique
    FROM rayon
    INNER JOIN boutique ON rayon.id_boutique = boutique.id_boutique";
    return $this -> queryFetchAll($req);
  }
  
  public function getRayon($id_rayon)
  {
    $req = "SELECT
    rayon.id_rayon AS RayonID,
    rayon.nom AS Nom,
    id_boutique AS BoutiqueID
    FROM rayon
    WHERE rayon.id_rayon = ?";
    return $this -> queryFetch($req, [$id_rayon]);
  }
  
  public function insertRayon($nom, $id_boutique)
  {
    $req = "INSERT INTO rayon (nom, id_boutique) VALUES (?, ?)";

    return $this -> query($req, [$nom, $id_boutique]);
  }

  public function deleteRayon($id_rayon)
    {
      $req = "DELETE FROM rayon WHERE id_rayon = ?";
      return $this -> query($req,[$id_rayon]);
    }
    
  public function modifyRayon($nom,$id_boutique,$id_rayon)
  {
    $req = "UPDATE rayon SET nom=?,id_boutique=? WHERE id_rayon=?";
    return $this -> query($req, [$nom,$id_boutique, $id_rayon]);
  }
}