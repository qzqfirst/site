<?php
include_once('BaseController.php');
class Links extends BaseController {
  function index()
  {
    $this->slots['content'] = $this->load->view('links', '', TRUE);
    $this->slots['nav'] = 'links';
    $this->slots['title'] = 'Links';
    $this->render();
  }
}
