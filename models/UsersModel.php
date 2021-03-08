<?php

class UsersModel extends ModelManager
{
 public function getAllUsers()
 {
  $req =
   "SELECT
    users.id AS id,
    firstName,
    lastName,
    dob,
    address,
    zip,
    city,
    country,
    telephone,
    email,
    password,
    rank
    FROM users
    INNER JOIN ranks
    ON users.rank_id = ranks.id
    INNER JOIN profiles
    ON users.id = profiles.user_id
    ";
  return $this->queryFetchAll($req);
 }

 public function getUser($email)
 {
  $req =
   "SELECT
    users.id AS id,
    firstName,
    lastName,
    dob,
    address,
    zip,
    city,
    country,
    telephone,
    email,
    password,
    rank
    FROM users
    INNER JOIN ranks
    ON users.rank_id = ranks.id
    INNER JOIN profiles
    ON users.id = profiles.user_id
    WHERE email = ?";
  return $this->queryFetch($req, [$email]);
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

 public function modifyUser($firstName, $lastName, $dob, $email, $address, $password, $id)
 {
  $req =
   "UPDATE
  users
  INNER JOIN profiles
  ON users.id = user_id
  SET
  firstName=?,
  lastName=?,
  dob=?,
  email=?,
  address=?,
  password=?
  WHERE users.id=?";
  return $this->query($req, [$firstName, $lastName, $dob, $email, $address, $password, $id]);
 }
}