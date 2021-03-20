<?php
class ProjectBackController extends BackController
{
  public function display()
  {
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
}