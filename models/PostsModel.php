<?php

class PostsModel extends ModelManager
{
  public function getAllPosts()
  {
    $req =
    "SELECT 
    po.id,
    po.name,
    po.date,
    title1,
    text1,
    title2,
    text2,
    po.display,
    (
    SELECT ph1.src
    FROM posts_photos pp1
    INNER JOIN photos ph1
    ON pp1.photo_id = ph1.id
    WHERE pp1.post_id = po.id
    ORDER BY pp1.photo_id LIMIT 0,1
    ) AS src1,
    
    (
    SELECT ph2.src
    FROM posts_photos pp2
    INNER JOIN photos ph2
    ON pp2.photo_id = ph2.id
    WHERE pp2.post_id = po.id 
    ORDER BY pp2.photo_id LIMIT 1,1
    ) AS src2,
    
    (
    SELECT ph3.src
    FROM posts_photos pp3
    INNER JOIN photos ph3
    ON pp3.photo_id = ph3.id
    WHERE pp3.post_id = po.id 
    ORDER BY pp3.photo_id LIMIT 2,1
    ) AS src3
    
    FROM posts po
    ORDER BY po.date DESC    
    ";
    return $this->queryFetchAll($req);
  }

  public function getPost($id)
  {
    $req =
    "SELECT 
    po.id,
    po.name,
    po.date,
    title1,
    text1,
    title2,
    text2,
    po.display,
    (
    SELECT ph1.id
    FROM posts_photos pp1
    INNER JOIN photos ph1
    ON pp1.photo_id = ph1.id
    WHERE pp1.post_id = po.id
    ORDER BY pp1.photo_id LIMIT 0,1
    ) AS id1,
    
    (
    SELECT ph1.src
    FROM posts_photos pp1
    INNER JOIN photos ph1
    ON pp1.photo_id = ph1.id
    WHERE pp1.post_id = po.id
    ORDER BY pp1.photo_id LIMIT 0,1
    ) AS src1,
    
    (
    SELECT ph2.id
    FROM posts_photos pp2
    INNER JOIN photos ph2
    ON pp2.photo_id = ph2.id
    WHERE pp2.post_id = po.id 
    ORDER BY pp2.photo_id LIMIT 1,1
    ) AS id2,
    
    (
    SELECT ph2.src
    FROM posts_photos pp2
    INNER JOIN photos ph2
    ON pp2.photo_id = ph2.id
    WHERE pp2.post_id = po.id 
    ORDER BY pp2.photo_id LIMIT 1,1
    ) AS src2,
    
    (
    SELECT ph3.id
    FROM posts_photos pp3
    INNER JOIN photos ph3
    ON pp3.photo_id = ph3.id
    WHERE pp3.post_id = po.id 
    ORDER BY pp3.photo_id LIMIT 2,1
    ) AS id3,
    
    (
    SELECT ph3.src
    FROM posts_photos pp3
    INNER JOIN photos ph3
    ON pp3.photo_id = ph3.id
    WHERE pp3.post_id = po.id 
    ORDER BY pp3.photo_id LIMIT 2,1
    ) AS src3
    
    FROM posts po
    WHERE po.id = ?
    ORDER BY po.date DESC
    ";
    return $this->queryFetch($req, [$id]);
  }

  public function addPost($name, $date, $title1, $text1, $title2, $text2)
  {
    $req =
    "INSERT
    INTO posts
    (name, date, title1, text1, title2, text2)
    VALUES
    (?, ?, ?, ?, ?, ?)";
    return $this->query($req, [$name, $date, $title1, $text1, $title2, $text2]);
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