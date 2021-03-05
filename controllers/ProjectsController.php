<?php
class ProjectsController extends FrontController
{
  public function display()
  {
    $projectsModel = new ProjectsModel();
    $projects = $projectsModel->getAllProjects();
    $template = 'projects.phtml';
    include $this->layout;
  }
}