<?php

class PostsModel extends ModelManager
{
  public function getAllPosts()
  {
    $req =
    "SELECT
    posts.id,
    posts.name,
    posts.date,
    p1.src AS src1,
    p2.src AS src2,
    p3.src AS src3,
    p1.caption,
    title1,
    text1,
    title2,
    text2,
    posts.display
    FROM posts
    INNER JOIN photos AS p1
    ON main_img_id = p1.id
    INNER JOIN photos AS p2
    ON img1_id = p2.id
    INNER JOIN photos AS p3
    ON img2_id = p3.id
    ORDER BY posts.date DESC
    ";
    return $this->queryFetchAll($req);
  }

  public function getPost($id)
  {
    $req =
    "SELECT
    posts.id,
    posts.name,
    posts.date,
    p1.src AS src1,
    p2.src AS src2,
    p3.src AS src3,
    p1.caption,
    title1,
    text1,
    title2,
    text2,
    posts.display
    FROM posts
    INNER JOIN photos AS p1
    ON main_img_id = p1.id
    INNER JOIN photos AS p2
    ON img1_id = p2.id
    INNER JOIN photos AS p3
    ON img2_id = p3.id
    WHERE posts.id = ?
    ";
    return $this->queryFetch($req, [$id]);
  }

  public function addPost($name, $date, $main_img_id, $title1, $text1, $img1_id, $title2, $text2, $img2_id)
  {
    $req =
    "INSERT
    INTO posts
    (name, date, main_img_id, title1, text1, img1_id, title2, text2, img2_id)
    VALUES
    (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    return $this->query($req, [$name, $date, $main_img_id, $title1, $text1, $img1_id, $title2, $text2, $img2_id]);
  }

  public function deletePost($id)
  {
    $req =
    "DELETE
    FROM posts
    WHERE id = ?";
    return $this -> query($req, [$id]);
  }

  public function modifyPost($name, $date, $title1, $text1, $title2, $text2, $display, $id)
  {
    $req =
    "UPDATE
    posts
    SET
    name=?,
    date=?,
    title1=?,
    text1=?,
    title2=?,
    text2=?,
    display=?
    WHERE id=?";
    return $this -> query($req, [$name, $date, $title1, $text1, $title2, $text2, $display, $id]);
  }
}