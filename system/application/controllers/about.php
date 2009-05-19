<?php
include_once('BaseController.php');
class About extends BaseController {
  function index()
  {
    $this->slots['menu'] = $this->load->view('menu', '', TRUE);
    $this->slots['nav'] = 'about';
    $this->slots['content'] = "heeeeeeee";
    $this->render();
  }
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */