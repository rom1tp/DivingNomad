<?php

class PostsPhotosModel extends ModelManager
{
  public function getAllPhotos($id)
  {
    $req =
      "SELECT
    post_id AS id,
    src
    FROM posts_photos
    INNER JOIN photos
    ON photo_id = photos.id
    WHERE post_id = ?
    ";
    return $this->queryFetchAll($req, [$id]);
  }

  public function deletePhotos($id)
  {
    $req=
    "DELETE FROM posts_photos
    WHERE post_id = ?";
    return $this->query($req, [$id]);
  }

  public function addPhotos($post_id, $main_img_id, $img1_id, $img2_id)
  {
    $req =
      "INSERT
    INTO posts_photos
    (
    post_id,
    photo_id
    )
    VALUES
    (?, ?),
    (?, ?),
    (?, ?)
    ";
    return $this->query($req, [$post_id, $main_img_id, $post_id, $img1_id, $post_id, $img2_id]);
  }
}