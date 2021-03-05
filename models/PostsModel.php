<?php

class PostsModel extends ModelManager
{
  public function getAllPosts()
  {
    $req =
    "SELECT
    id,
    name,
    title1,
    text1,
    title2,
    text2,
    display
    FROM posts";
    return $this->queryFetchAll($req);
  }

  public function addPost($src, $caption)
  {
    $req =
    "INSERT
    INTO posts
    (src, caption)
    VALUES
    (?, ?)";
    return $this->query($req, [$src, $caption]);
  }

  public function deletePost($id)
  {
    $req =
    "DELETE
    FROM posts
    WHERE id = ?";
    return $this -> query($req, [$id]);
  }

  public function modifyPost($caption, $display, $id)
  {
    $req =
    "UPDATE
    posts
    SET
    caption=?,
    display=?
    WHERE id=?";
    return $this -> query($req, [$caption, $display, $id]);
  }
}