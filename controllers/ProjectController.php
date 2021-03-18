<?php
class ProjectController extends FrontController
{
 public function display()
 {
  $project = $this->_projectsModel->getProject($_GET["id"]);
  $template = 'project.phtml';
  include $this->_layout;
 }
}