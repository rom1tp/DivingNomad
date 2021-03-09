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
   $this->_projectsModel->addProject($_POST["name"], $_POST["subtitle"], $_POST["description"], $_POST["url"]);
   header('location:projectsBack');
  }
 }

 public function delete()
 {
  $this->_projectsModel->deleteProject($_GET["id"]);
  header('location:projectsBack');
 }

 public function confirm()
 {
  $id = $_GET["id"];
  $this->_projectsModel->modifyProject($_POST["name"], $_POST["subtitle"], $_POST["description"], $_POST["url"], $_POST["display-$id"], $id);
  header('location:projectsBack');
 }
}