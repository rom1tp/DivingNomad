<?php

class PhotosModel extends ModelManager
{
  public function getAllPhotos()
  {
    $req =
      "SELECT
    photos.id AS id,
    photos.name AS name,
    src,
    caption,
    date,
    locations.name AS location,
    countries.name AS country,
    continents.name AS continent,
    display
    FROM photos
    INNER JOIN locations
    ON location_id = locations.id
    INNER JOIN countries
    ON country_id = countries.id
    INNER JOIN continents
    ON continent_id = continents.id
    ";
    return $this->queryFetchAll($req);
  }

  public function getPhoto($id)
  {
    $req =
      "SELECT
    photos.id AS id,
    photos.name AS name,
    src,
    caption,
    date,
    locations.name AS location,
    countries.name AS country,
    continents.name AS continent,
    display
    FROM photos
    INNER JOIN locations
    ON location_id = locations.id
    INNER JOIN countries
    ON country_id = countries.id
    INNER JOIN continents
    ON continent_id = continents.id
    WHERE photos.id = ?
    ";
    return $this->queryFetch($req, [$id]);
  }

  public function addPhoto($name, $src, $caption, $date, $locationId, $display)
  {
    $req =
      "INSERT
    INTO photos
    (name, src, caption, date, location_id, display)
    VALUES
    (?, ?, ?, ?, ?, ?)";
    return $this->query($req, [$name, $src, $caption, $date, $locationId, $display]);
  }

  public function deletePhoto($id)
  {
    $req =
      "DELETE
    FROM photos
    WHERE id = ?";
    return $this->query($req, [$id]);
  }

  public function modifyPhoto($name, $caption, $date, $display, $id)
  {
    $req =
      "UPDATE
    photos
    SET
    name=?,
    caption=?,
    date=?,
    display=?
    WHERE id=?";
    return $this->query($req, [$name, $caption, $date, $display, $id]);
  }
}