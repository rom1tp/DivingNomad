<?php

class ContinentsModel extends ModelManager
{
 public function getAllContinents()
 {
  $req =
   "SELECT
    id,
    name AS continent
    FROM continents";
  return $this->queryFetchAll($req);
 }

 public function getContinent($id)
 {
  $req =
   "SELECT
    name AS continent
    FROM continents
    WHERE id=?";
  return $this->queryFetchAll($req, [$id]);
 }

 public function addContinent($name)
 {
  $req =
   "INSERT
    INTO continents
    (name)
    VALUES
    (?)";
  return $this->query($req, [$name]);
 }

 public function deleteContinent($id)
 {
  $req =
   "DELETE
    FROM continents
    WHERE id = ?";
  return $this->query($req, [$id]);
 }

 public function modifyContinent($name, $id)
 {
  $req =
   "UPDATE
    continents
    SET
    name=?
    WHERE id=?";
  return $this->query($req, [$name, $id]);
 }
}