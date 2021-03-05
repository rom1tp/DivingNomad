<?php
class GalleryBackController extends BackController
{
  public function display()
  {
    $galleryModel = new GalleryModel();
    $posts = $galleryModel->getAllPosts();
    $template = 'galleryBack.phtml';
    include $this->layout;
  }
  
  public function upload()
  {

    if (isset($_POST['submit']) && isset($_FILES['img'])) {
    // if (false) {
      $img_name = $_FILES['img']['name'];
      $img_size = $_FILES['img']['size'];
      $tmp_name = $_FILES['img']['tmp_name'];
      $error = $_FILES['img']['error'];

      if ($error == 0) {
        if ($img_size > 5000000) {
          $errorMsg = 'Sorry, your file is too large!';
          header("location:travelsBack-errorMsg-$errorMsg");
        }
        else {
          $img_extension = pathinfo($img_name, PATHINFO_EXTENSION);
          $img_extension = strtolower($img_extension);
          $allowedExtensions = array('jpg', 'png', 'jpeg');
          
          if (in_array($img_extension, $allowedExtensions)) {
            $img_name = uniqid("IMG-", true).'.'.$img_extension;
            $img_upload_path = 'assets/img/'.$img_name;
            move_uploaded_file($tmp_name, $img_upload_path);

            $galleryModel = new GalleryModel();
            $galleryModel->addPhoto($img_name, $_POST["caption"]);
            
            header('location:travelsBack');

          } else {

            $errorMsg = 'You can\'t upload files of this type!';
            header("location:travelsBack-errorMsg-$errorMsg");
          }
        }
      }
      else {
        $errorMsg = 'Unknown error occurred!';
        header("location:travelsBack-errorMsg-$errorMsg");
      }
    }
  }

  public function delete()
  {
    $galleryModel = new GalleryModel();
    $galleryModel->deletePhoto($_GET["id"]);
    header('location:travelsBack');
  }

  public function confirm()
  {
    $id = $_GET["id"];
    // echo $_POST["display-$id"];
    $galleryModel = new GalleryModel();
    $galleryModel->modifyPhoto($_POST["caption"], $_POST["display-$id"], $id);
    header('location:travelsBack');
  }
}