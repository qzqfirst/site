<?php
include_once('BaseController.php');
class About extends BaseController {
  function index()
  {
    $this->slots['content'] = $this->load->view('about', '', TRUE);
    $this->slots['nav'] = 'about';
    $this->slots['title'] = 'About';
    $this->render();
  }
}
