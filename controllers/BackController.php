<?php
class BackController extends PagesController
{
  protected $_layout;

  public function __construct()
  {
    parent::__construct();
    $this->_layout = 'views/layoutBack.phtml';
  }

  protected function uploadImg($page, $folder, $name, $img)
  {
    $img_name = $img['name'];
    $img_size = $img['size'];
    $tmp_name = $img['tmp_name'];
    $error = $img['error'];
    $img_extension = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_extension = strtolower($img_extension);
    $allowedExtensions = array('jpg', 'png', 'jpeg');
    $img_name = uniqid($name . "-", true) . '.' . $img_extension;
    $error = false;

    if (
      $error == 0 &&
      $img_size < 5000000 &&
      in_array($img_extension, $allowedExtensions)
      ) {
      $error = false;
    } else {
      $error = true;
    }

    if ($error) {
      return 'Error';
    } else {
      if (!file_exists("assets/img/$page/$folder/")) {
        mkdir("assets/img/$page/$folder/", 0777, true);
      }
      $img_upload_path = "assets/img/$page/$folder/$img_name";
      move_uploaded_file($tmp_name, $img_upload_path);
      return $img_upload_path;
    }
  }
}