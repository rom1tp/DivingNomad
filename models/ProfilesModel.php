<?php

class ProfilesModel extends ModelManager
{
 public function getAllProfiles()
 {
  $req =
   "SELECT
    profiles.id AS id,
    email AS email,
    password,
    rank
    FROM profiles
    INNER JOIN ranks
    ON profiles.rank_id = ranks.id
    ";
  return $this->queryFetchAll($req);
 }

 public function getProfile($email)
 {
  $req =
   "SELECT
    profiles.id AS id,
    email,
    password,
    rank
    FROM profiles
    INNER JOIN ranks
    ON profiles.rank_id = ranks.id
    WHERE email = ?";
  return $this->queryFetch($req, [$email]);
 }

 public function addProfile($id)
 {
  $req = "INSERT
    INTO
    profiles
    (user_id)
    VALUES (?)";
  return $this->query($req, [$id]);
 }
}