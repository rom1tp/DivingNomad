<?php

class ProjectsModel extends ModelManager
{
  public function getAllProjects() // FIXME => getAllProjects *
  {
    $req =
    "SELECT
    id,
    name,
    subtitle,
    description,
    url,
    display
    FROM projects";
    return $this->queryFetchAll($req);
  }

  public function addProject($name, $subtitle, $description, $url)
  {
    $req =
    "INSERT
    INTO projects
    (name, subtitle, description, url)
    VALUES
    (?, ?, ?, ?)";
    return $this->query($req, [$name, $subtitle, $description, $url]);
  }

  public function deleteProject($id)
  {
    $req =
    "DELETE
    FROM projects
    WHERE id = ?";
    return $this -> query($req, [$id]);
  }

  public function modifyProject($name, $subtitle, $description, $url, $display, $id)
  {
    $req =
    "UPDATE
    projects
    SET
    name=?,
    subtitle=?,
    description=?,
    url=?,
    display=?
    WHERE id=?";
    return $this -> query($req, [$name, $subtitle, $description, $url, $display, $id]);
  }
}