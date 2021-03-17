<?php
class PostController extends FrontController
{
 public function display()
 {
  $post = $this->_postsModel->getPost($_GET["id"]);
  $day = date("j", strtotime($post['date']));
  $month = date("M", strtotime($post['date']));
  $year = date("Y", strtotime($post['date']));
  $template = 'post.phtml';
  include $this->_layout;
 }
}