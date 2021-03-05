<?php
class ProductsModel extends ModelManager
{
  public function getAllProducts()
  {
    $req = "SELECT
    statut AS Statut,
    boutique.nom AS Boutique,
    boutique.id_boutique AS BoutiqueID,
    rayon.nom AS Rayon,
    rayon.id_rayon AS RayonID,
    produits.nom AS Produit,
    produits.marque AS Marque,
    produits.reference AS Ref,
    produits.etiquettes AS Etiquette,
    produits.prix AS Prix,
    produits.ecoparticipation AS Ecopart,
    produits.description_principale AS DescPrincipale,
    produits.titre_1 AS Titre1,
    produits.image_1 AS Image1,
    produits.description_1 AS Desc1,
    produits.titre_2 AS Titre2,
    produits.image_2 AS Image2,
    produits.description_2 AS Desc2,
    produits.titre_3 AS Titre3,
    produits.image_3 AS Image3,
    produits.description_3 AS Desc3,
    produits.id_produit AS ProductID
      
    FROM produits
    INNER JOIN rayon ON produits.id_rayon = rayon.id_rayon
    INNER JOIN boutique ON rayon.id_boutique = boutique.id_boutique";
    return $this -> queryFetchAll($req);
  }

  public function getProduct($id_produit)
  {
    $req = "SELECT
    statut AS Statut,
    boutique.nom AS Boutique,
    boutique.id_boutique AS BoutiqueID,
    rayon.nom AS Rayon,
    rayon.id_rayon AS RayonID,
    produits.nom AS Produit,
    produits.marque AS Marque,
    produits.reference AS Ref,
    produits.etiquettes AS Etiquette,
    produits.prix AS Prix,
    produits.ecoparticipation AS Ecopart,
    produits.description_principale AS DescPrincipale,
    produits.titre_1 AS Titre1,
    produits.image_1 AS Image1,
    produits.description_1 AS Desc1,
    produits.titre_2 AS Titre2,
    produits.image_2 AS Image2,
    produits.description_2 AS Desc2,
    produits.titre_3 AS Titre3,
    produits.image_3 AS Image3,
    produits.description_3 AS Desc3,
    produits.id_produit AS ProductID
      
    FROM produits
    INNER JOIN rayon ON produits.id_rayon = rayon.id_rayon
    INNER JOIN boutique ON rayon.id_boutique = boutique.id_boutique
    WHERE produits.id_produit=?";
    return $this -> queryFetch($req, [$id_produit]);
  }

  //récupérer les inputs du formulaire AddProducts
  public function insertProduct($nom,
    $marque,$reference,$etiquettes,$prix,$ecoparticipation,
    $statut,$description_principale,
    $titre_1,$image_1,$description_1,
    $titre_2,$image_2,$description_2,
    $titre_3,$image_3,$description_3,$id_rayon)
  {
        //envoyer les données a la base de données
        $req = "INSERT INTO produits (nom,
        marque,reference,etiquettes,prix,ecoparticipation,
        statut,description_principale,
        titre_1,image_1,description_1,
        titre_2,image_2,description_2,
        titre_3,image_3,description_3,id_rayon)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        
        return $this -> query($req, [$nom,
        $marque,$reference,$etiquettes,$prix,$ecoparticipation,
        $statut,$description_principale,
        $titre_1,$image_1,$description_1,
        $titre_2,$image_2,$description_2,
        $titre_3,$image_3,$description_3,$id_rayon]);
  }
  
  //fonction supprimer un produit selon l'id fournit par le bouton
  public function deleteProduct($id_produit)
  {
        $req = "DELETE FROM produits WHERE id_produit = ?";
        return $this -> query($req, [$id_produit]);
  }

  public function modifyProduct($statut, $id_rayon, $nom, $marque, $reference, $etiquettes, $prix, $ecoparticipation, $description_principale, $titre_1, $image_1, $description_1, $titre_2, $image_2, $description_2, $titre_3, $image_3, $description_3, $id_produit)
  {
    $req = "UPDATE produits SET statut=?, id_rayon=?, nom=?, marque=?, reference=?, etiquettes=?, prix=?, ecoparticipation=?, description_principale=?, titre_1=?, image_1=?, description_1=?, titre_2=?, image_2=?, description_2=?, titre_3=?, image_3=?, description_3=? WHERE id_produit=?";
    return $this -> query($req, [$statut, $id_rayon, $nom, $marque, $reference, $etiquettes, $prix, $ecoparticipation, $description_principale, $titre_1, $image_1, $description_1, $titre_2, $image_2, $description_2, $titre_3, $image_3, $description_3, $id_produit]);
  }

  public function changeStatut($action, $id_produit)
  {
    switch ($action) {
      case 'remettre':
        $statut = 'En attente';
        break;
      
      case 'retirer':
        $statut = 'Retiré';
        break;

      case 'boutique':
        $statut = 'En boutique';
        break;

      default:
        # code...
        break;
    }
    $req = "UPDATE produits SET statut=? WHERE id_produit=?";
    return $this->query($req, [$statut, $id_produit]);
    
  }
}