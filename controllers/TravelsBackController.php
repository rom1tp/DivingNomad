<?php
class TravelsBackController extends BackController
{
 public function display()
 {
  $posts = $this->_postsModel->getAllPosts();
  $photos = $this->_photosModel->getAllPhotos();
  $template = 'travelsBack.phtml';
  include $this->_layout;
 }

 public function delete()
 {
  $this->_postsModel->deletePost($_GET["id"]);
  header('location:travelsBack');
 }

}