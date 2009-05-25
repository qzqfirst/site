<?php
include_once('BaseController.php');
class Quotes extends BaseController {
  function index()
  {
    $this->load->model('quotes_model');
    $this->load->library('table');
    $this->slots['content'] = $this->load->view('quotes',
                                                array('quotes' => $this->quotes_model->get_all_quotes()),
                                                TRUE);
    $this->slots['nav'] = 'quotes';
    $this->slots['style'] = true;
    $this->slots['title'] = 'Quotes';
    $this->render();
  }
}
