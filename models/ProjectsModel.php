<?php

class ProjectsModel extends ModelManager
{
  public function getAllProjects()
  {
    $req =
      "SELECT
    id,
    name,
    subtitle,
    description,
    url,
    src,
    display
    FROM projects";
    return $this->queryFetchAll($req);
  }

  public function getProject($id)
  {
    $req =
      "SELECT
    id,
    name,
    subtitle,
    description,
    url,
    src,
    display
    FROM projects
    WHERE id = ?
    ";
    return $this->queryFetch($req, [$id]);
  }

  public function addProject($name, $subtitle, $description, $url, $src)
  {
    $req =
      "INSERT
    INTO projects
    (name, subtitle, description, url, src)
    VALUES
    (?, ?, ?, ?, ?)";
    return $this->query($req, [$name, $subtitle, $description, $url, $src]);
  }

  public function deleteProject($id)
  {
    $req =
      "DELETE
    FROM projects
    WHERE id = ?";
    return $this->query($req, [$id]);
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
    return $this->query($req, [$name, $subtitle, $description, $url, $display, $id]);
  }
}