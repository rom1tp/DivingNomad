<?php
class TravelsController extends FrontController
{
 public function display()
 {
  $posts = $this->_postsModel->getAllPosts();
  $template = 'travels.phtml';
  include $this->_layout;
 }
}