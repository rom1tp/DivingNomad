<?php
class ProjectsBackController extends BackController
{
  public function display()
  {
    $projectsModel = new ProjectsModel();
    $projects = $projectsModel->getAllProjects();
    $template = 'projectsBack.phtml';
    include $this->layout;
  }

  public function upload()
  {
    if (isset($_POST["submit"])) {
      $projectsModel = new ProjectsModel();
      $projectsModel->addProject($_POST["name"], $_POST["subtitle"], $_POST["description"], $_POST["url"]);
      header('location:projectsBack');
    }  
  }

  
  public function delete()
  {
    $projectsModel = new ProjectsModel();
    $projectsModel->deleteProject($_GET["id"]);
    header('location:projectsBack');
  }

  public function confirm()
  {
    $id = $_GET["id"];
    $projectsModel = new ProjectsModel();
    $projectsModel->modifyProject($_POST["name"], $_POST["subtitle"], $_POST["description"], $_POST["url"], $_POST["display-$id"], $id);
    header('location:projectsBack');
  }
}