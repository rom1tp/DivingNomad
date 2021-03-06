<?php

class GalleryModel extends ModelManager
{
  public function getAllPhotos()
  {
    $req =
    "SELECT
    id,
    name,
    src,
    caption,
    date,
    location_id,
    display
    FROM gallery";
    return $this->queryFetchAll($req);
  }
  
  
  public function addPhoto($name, $src, $caption, $date)
  {
    $req =
    "INSERT
    INTO gallery
    (name, src, caption, date)
    VALUES
    (?, ?, ?, ?)";
    return $this->query($req, [$name, $src, $caption, $date]);
  }

  public function deletePhoto($id)
  {
    $req =
    "DELETE
    FROM gallery
    WHERE id = ?";
    return $this -> query($req, [$id]);
  }

  public function modifyPhoto($name, $caption, $date, $display, $id)
  {
    $req =
    "UPDATE
    gallery
    SET
    name=?,
    caption=?,
    date=?,
    display=?
    WHERE id=?";
    return $this -> query($req, [$name, $caption, $date, $display, $id]);
  }
}