<?php
class TestController extends BackController
{
 public function display()
 {
  $template = 'test.phtml';
  include $this->_layout;
 }

}
