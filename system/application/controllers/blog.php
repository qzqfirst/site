<?php
include_once('BaseController.php');
class Blog extends BaseController {
  function index()
  {
    $this->slots['menu'] = $this->load->view('menu', '', TRUE);
    $this->slots['nav'] = 'blog';
    $this->slots['content'] = "blog\n";
    $this->render();
  }
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */