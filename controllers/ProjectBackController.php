<?php
class ProjectBackController extends BackController
{
  public function display(bool $modify = false)
  {
    $this->_modify = $modify == 'modify' ? true : false;
    $modify ? $project = $this->_projectsModel->getProject($_GET["id"]) : '';
    $photos = $this->_photosModel->getAllPhotos();
    $template = 'projectBack.phtml';
    include $this->_layout;
  }

  public function upload()
  {
    if (isset($_POST["submit"])) {
      $src = $this->uploadImg('projects', $_POST["name"], $_POST["name"], $_FILES['img']);
      $this->_projectsModel->addProject($_POST["name"], $_POST["subtitle"], $_POST["description"], $_POST["url"], $src);
       header('location:projectsBack');
    }
  }

  public function confirm()
  {
    $this->_projectsModel->modifyProject($_POST["name"], $_POST["subtitle"], $_POST["description"], $_POST["url"],  $_POST["display"], $_GET["id"]);
    header('location:projectsBack'); 
  }

}