<?php

class UsersModel extends ModelManager
{
 public function getAllUsers()
 {
  $req =
   "SELECT
    users.id AS id,
    email AS email,
    password,
    rank
    FROM users
    INNER JOIN ranks
    ON users.rank_id = ranks.id
    ";
  return $this->queryFetchAll($req);
 }

 public function getUser($id)
 {
  $req =
   "SELECT
    users.id AS id,
    email,
    password,
    rank
    FROM users
    INNER JOIN ranks
    ON users.rank_id = ranks.id
    WHERE users.id = ?";
  return $this->queryFetch($req, [$id]);
 }

 public function addUser($email, $password, $id = 5)
 {
  $req = "INSERT
    INTO
    users
    (email, password, rank_id)
    VALUES (?, ?, ?)";
  return $this->query($req, [$email, $password, $id]);
 }
}