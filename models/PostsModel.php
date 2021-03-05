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

  public function addPost($name, $title1, $text1, $title2, $text2)
  {
    $req =
    "INSERT
    INTO posts
    (name, title1, text1, title2, text2)
    VALUES
    (?, ?, ?, ?, ?)";
    return $this->query($req, [$name, $title1, $text1, $title2, $text2]);
  }

  public function deletePost($id)
  {
    $req =
    "DELETE
    FROM posts
    WHERE id = ?";
    return $this -> query($req, [$id]);
  }

  public function modifyPost($name, $title1, $text1, $title2, $text2, $display, $id)
  {
    $req =
    "UPDATE
    posts
    SET
    name=?,
    title1=?,
    text1=?,
    title2=?,
    text2=?,
    display=?
    WHERE id=?";
    return $this -> query($req, [$name, $title1, $text1, $title2, $text2, $display, $id]);
  }
}