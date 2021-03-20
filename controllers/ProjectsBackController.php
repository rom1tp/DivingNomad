<?php
class ProjectsBackController extends BackController
{
  public function display()
  {
    $projects = $this->_projectsModel->getAllProjects();
    $template = 'projectsBack.phtml';
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

  public function delete()
  {
    $project = $this->_projectsModel->getProject($_GET["id"]);
    unlink($project['src']);
    $this->_projectsModel->deleteProject($_GET["id"]);
    header('location:projectsBack');
  }

}