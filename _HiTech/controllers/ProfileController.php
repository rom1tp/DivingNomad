<?php
// FIXME: delete if unused

class ProfileController extends SessionController
{
  public function display()
  {
    $model = new ProfileModel();
    $info = $model -> getUserProfile();
    $template = 'view_profile.phtml';
    include 'views/layout.phtml';
  }
}