<?php

class CountriesModel extends ModelManager
{
 public function getAllCountries()
 {
  $req =
   "SELECT
    countries.id AS id,
    countries.name AS country,
    continents.name AS continent,
    continent_id
    FROM countries
    INNER JOIN continents
    ON continent_id = continents.id
    ";
  return $this->queryFetchAll($req);
 }

 public function addCountry($name, $continentId)
 {
  $req =
   "INSERT
    INTO countries
    (name, continent_id)
    VALUES
    (?, ?)";
  return $this->query($req, [$name, $continentId]);
 }

 public function deleteCountry($id)
 {
  $req =
   "DELETE
    FROM countries
    WHERE id = ?";
  return $this->query($req, [$id]);
 }

 public function modifyCountry($name, $continentId, $id)
 {
  $req =
   "UPDATE
    countries
    SET
    name=?,
    continent_id=?
    WHERE id=?";
  return $this->query($req, [$name, $continentId, $id]);
 }
}