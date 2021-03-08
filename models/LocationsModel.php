<?php

class LocationsModel extends ModelManager
{
 public function getAllLocations()
 {
  $req =
   "SELECT
    locations.id AS id,
    locations.name AS location,
    countries.name AS country,
    country_id,
    continents.name AS continent
    FROM locations
    INNER JOIN countries
    ON country_id = countries.id
    INNER JOIN continents
    ON continent_id = continents.id
    ";
  return $this->queryFetchAll($req);
 }

 public function addLocation($name, $countryId)
 {
  $req =
   "INSERT
    INTO locations
    (name, country_id)
    VALUES
    (?, ?)";
  return $this->query($req, [$name, $countryId]);
 }

 public function deleteLocation($id)
 {
  $req =
   "DELETE
    FROM locations
    WHERE id = ?";
  return $this->query($req, [$id]);
 }

 public function modifyLocation($name, $countryId, $id)
 {
  $req =
   "UPDATE
    locations
    SET
    name=?,
    country_id=?
    WHERE id=?";
  return $this->query($req, [$name, $countryId, $id]);
 }
}