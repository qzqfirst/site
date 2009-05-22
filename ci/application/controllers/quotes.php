<?php
include_once('BaseController.php');
class Quotes extends BaseController {
  function index()
  {
    $this->load->model('quote');
    $this->slots['content'] = $this->load->view('quotes',
                                                array('quotes' => $this->quote->get_all_quotes()),
                                                TRUE);
    $this->slots['nav'] = 'quotes';
    $this->slots['style'] = true;
    $this->slots['title'] = 'Quotes';
    $this->render();
  }
}
