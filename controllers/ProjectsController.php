<?php
class ProjectsController extends FrontController
{
 public function display()
 {
  $projects = $this->_projectsModel->getAllProjects();
  $template = 'projects.phtml';
  include $this->_layout;
 }
}