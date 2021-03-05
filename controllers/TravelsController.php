<?php
class TravelsController extends FrontController
{
  public function display()
  {
    $postsModel = new PostsModel();
    $posts = $postsModel->getAllPosts();
    $template = 'travels.phtml';
    include $this->layout;
  }  
}