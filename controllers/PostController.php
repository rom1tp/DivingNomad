<?php
class PostController extends FrontController
{
 public function display()
 {
  $post = $this->_postsModel->getPost($_GET["id"]);
  $template = 'post.phtml';
  include $this->_layout;
 }
}