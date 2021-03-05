<?php
class ProfileModel extends ModelManager
{
  public function getUserProfiles($userIdentifiant)
  {
    $req = "SELECT
    utilisateurs.email AS `identifiant`,
    mot_de_passe AS 'mdp'
    FROM utilisateurs
    WHERE utilisateurs.email = ?
    ORDER BY id_user";
    $params = [$userIdentifiant];
    return $this -> queryFetch($req, $params);
  }
}