<?php

class UsersModel extends ModelManager
{
  public function getAllUsers()
  {
    $req =
    "SELECT
    email AS email,
    -- mot_de_passe AS password,
    password,
    -- roles.role AS rank
    rank
    FROM users
    INNER JOIN ranks
    ON users.rank_id = ranks.id
    -- FROM utilisateurs
    -- INNER JOIN roles
    -- ON utilisateurs.id_role = roles.id_role
    ";
    return $this->queryFetchAll($req);
  }

  public function getUser($email)
  {
    $req =
    "SELECT
    -- id_user AS id,
    email,
    -- mot_de_passe AS password,
    password,
    -- roles.role AS rank,
    rank
    -- utilisateurs.id_role
    -- FROM utilisateurs
    FROM users
    INNER JOIN ranks
    ON users.rank_id = ranks.id
    -- INNER JOIN roles
    -- ON utilisateurs.id_role = roles.id_role
    WHERE email = ?";
    return $this->queryFetch($req, [$email]);
  }

  public function addUser($email, $password, $id = 2)
  {
    $req = "INSERT
    INTO
    -- utilisateurs
    users
    -- (email, mot_de_passe, id_role)
    (email, password, rank_id)
    VALUES (?, ?, ?)";
    return $this -> query($req, [$email, $password, $id]);
  }
}