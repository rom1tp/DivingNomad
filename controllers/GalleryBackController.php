<?php
class GalleryBackController extends BackController
{
  
  public function display()
  {
    $galleryModel = new GalleryModel();
    $photos = $galleryModel->getAllPhotos();
    $template = 'galleryBack.phtml';
    include $this->layout;
  }
  
  public function upload()
  {

    if (isset($_POST['submit']) && isset($_FILES['img'])) {
      $img_name = $_FILES['img']['name'];
      $img_size = $_FILES['img']['size'];
      $tmp_name = $_FILES['img']['tmp_name'];
      $error = $_FILES['img']['error'];
      
      if ($error == 0) {
        if ($img_size > 5000000) {
          $errorMsg = 'Sorry, your file is too large!';
          header("location:galleryBack-errorMsg-$errorMsg");
        }
        else {
          $img_extension = pathinfo($img_name, PATHINFO_EXTENSION);
          $img_extension = strtolower($img_extension);
          $allowedExtensions = array('jpg', 'png', 'jpeg');
          
          if (in_array($img_extension, $allowedExtensions)) {
            $img_name = uniqid("IMG-", true).'.'.$img_extension;
            $img_upload_path = 'assets/img/'.$img_name;
            move_uploaded_file($tmp_name, $img_upload_path);
            echo '<pre>' . var_export($_POST, true) . '</pre>';

            $galleryModel = new GalleryModel();
            $galleryModel->addPhoto($_POST["name"], $img_name, $_POST["caption"], $_POST["date"]);
            header('location:galleryBack');
          } else {
            $errorMsg = 'You can\'t upload files of this type!';
            header("location:galleryBack-errorMsg-$errorMsg");
          }
        }
      }
      else {
        $errorMsg = 'Unknown error occurred!';
        header("location:galleryBack-errorMsg-$errorMsg");
      }
    }
  }

  public function delete()
  {
    $galleryModel = new GalleryModel();
    $galleryModel->deletePhoto($_GET["id"]);
    header('location:galleryBack');
  }

  public function confirm()
  {
    $id = $_GET["id"];
    $galleryModel = new GalleryModel();
    $galleryModel->modifyPhoto($_POST["name"], $_POST["caption"], $_POST["date"], $_POST["display-$id"], $id);
    header('location:galleryBack');
  }
}