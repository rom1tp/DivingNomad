<?php
class TravelsBackController extends BackController
{
  public function display()
  {
    $postsModel = new PostsModel();
    $posts = $postsModel->getAllPosts();
    $template = 'travelsBack.phtml';
    include $this->layout;
  }
  
  public function upload()
  {
    $postsModel = new PostsModel();
    $postsModel->addPost($_POST["name"], $_POST["title1"], $_POST["text1"], $_POST["title2"], $_POST["text2"]);
    header('location:travelsBack');
  }

  public function delete()
  {
    $postsModel = new PostsModel();
    $postsModel->deletePost($_GET["id"]);
    header('location:travelsBack');
  }

  public function confirm()
  {
    $id = $_GET["id"];
    // echo $_POST["display-$id"];
    $postsModel = new PostsModel();
    $postsModel->modifyPost($_POST["name"], $_POST["title1"], $_POST["text1"], $_POST["title2"], $_POST["text2"], $_POST["display-$id"], $id);
    header('location:travelsBack');
  }
}