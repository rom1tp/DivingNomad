<?php
class BoutiquesModel extends ModelManager
{
  public function getAllBoutiques()
  {
    $req = "SELECT
    boutique.id_boutique AS BoutiqueID,
    boutique.nom AS Nom
    FROM boutique";
    return $this -> queryFetchAll($req);
  }

  public function getBoutique($id_boutique)
  {
    $req = "SELECT
    boutique.id_boutique AS BoutiqueID,
    boutique.nom AS Nom
    FROM boutique
    WHERE boutique.id_boutique = ?";
    return $this -> queryFetch($req, [$id_boutique]);
  }

  public function insertBoutique($nom)
  {
      $req = "INSERT INTO boutique (nom) VALUES (?)";
      return $this -> query($req, [$nom]);
  }

  public function deleteBoutique($id_boutique)
  {
    $req = "DELETE FROM boutique WHERE id_boutique = ?";
    return $this -> query($req,[$id_boutique]);
  }

  public function modifyBoutique($nom, $id_boutique)
  {
    $req = "UPDATE boutique SET nom=? WHERE id_boutique=?";
    return $this -> query($req, [$nom, $id_boutique]);
  }
}