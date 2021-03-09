<?php
class TravelsBackController extends BackController
{
 public function display()
 {
  $posts = $this->_postsModel->getAllPosts();
  $template = 'travelsBack.phtml';
  include $this->_layout;
 }

 public function upload()
 {
  $this->_postsModel->addPost($_POST["name"], $_POST["title1"], $_POST["text1"], $_POST["title2"], $_POST["text2"]);
  header('location:travelsBack');
 }

 public function delete()
 {
  $this->_postsModel->deletePost($_GET["id"]);
  header('location:travelsBack');
 }

 public function confirm()
 {
  $id = $_GET["id"];
  $this->_postsModel->modifyPost($_POST["name"], $_POST["title1"], $_POST["text1"], $_POST["title2"], $_POST["text2"], $_POST["display-$id"], $id);
  header('location:travelsBack');
 }
}