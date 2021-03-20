<?php
class ProjectBackController extends BackController
{
  public function display(bool $modify = false)
  {
    $this->_modify = $modify;
    $modify ? $project = $this->_projectsModel->getProject($_GET["id"]) : '';
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
    echo '<pre>' . var_export($_POST, true) . '</pre>';
    $this->_projectsModel->modifyProject($_POST["name"], $_POST["subtitle"], $_POST["description"], $_POST["url"],  $_POST["display"], $_GET["id"]);
    header('location:projectsBack'); 
  }
}