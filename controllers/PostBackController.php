<?php
class PostBackController extends BackController
{
  public function display(bool $modify = false)
  {
    $this->_modify = $modify == 'modify' ? true : false;
    $modify ? $post = $this->_postsModel->getPost($_GET["id"]) : '';
    $photos = $this->_photosModel->getAllPhotos();
    $template = 'postBack.phtml';
    include $this->_layout;
  }


  public function upload()
  {
   $this->_postsModel->addPost($_POST["name"], $_POST["date"], $_POST["title1"], $_POST["text1"], $_POST["title2"], $_POST["text2"], $_POST["display"]);
   $id = $this->_postsModel->getLastId();
   $this->_postsPhotosModel->addPhotos($id, $_POST["main_img_id"], $_POST["img1_id"], $_POST["img2_id"]);
  //  header('location:travelsBack');
  }

  public function confirm()
  {
   $this->_postsModel->modifyPost($_POST["name"], $_POST["date"], $_POST["title1"], $_POST["text1"], $_POST["title2"], $_POST["text2"], $_POST["display"], $_GET["id"]);
   $this->_postsPhotosModel->deletePhotos($_GET["id"]);
   $this->_postsPhotosModel->addPhotos($_GET["id"], $_POST["main_img_id"], $_POST["img1_id"], $_POST["img2_id"]);
   header('location:travelsBack');
  }

  public function loadImg()
  {
    $photosModel = new PhotosModel();
    $photo = $photosModel->getPhoto($_GET["id"]);
    $src = $photo['src'];
    echo $src;
  }

  public function getImgId()
  {
    $photosModel = new PhotosModel();
    $photo = $photosModel->getPhoto($_GET["id"]);
    $id = $photo['id'];
    echo json_encode($id);
  }
}