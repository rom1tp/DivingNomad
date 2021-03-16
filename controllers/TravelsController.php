<?php
class TravelsController extends FrontController
{
 public function display()
 {
  $posts = $this->_postsModel->getAllPosts();
  $template = 'travels.phtml';
  include $this->_layout;
 }

 public function displayPost()
 {
   $post = $this->_postsModel->getPost($_GET["id"]);
   $template = 'post.phtml';
   include $this->_layout;
 }
}