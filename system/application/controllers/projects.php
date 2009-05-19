<?php
include_once('BaseController.php');
class Projects extends BaseController {
  function index()
  {
    $this->slots['menu'] = $this->load->view('menu', '', TRUE);
    $this->slots['nav'] = 'projects';
    $this->slots['content'] = "Projektek, heee!";
    $this->render();
  }
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */