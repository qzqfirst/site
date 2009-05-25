<?php
/**
 * @file   base_controller.php
 * @author Zoltán Nagy <abesto0@gmail.com>
 * @date   Tue May 19 15:03:10 2009
 *
 * @brief  Base controller that loads the skeleton common to all pages
 */

class BaseController extends Controller
{
  public function __constructor()
  {
    parent::__constructor();
    $this->slots = array();
  }

  public function render()
  {
    $this->load->helper('html');
    $this->load->helper('url');
    $this->slots['pagelinks'] = array('blog' => 'Blog',
                                      'projects' => 'Projects',
                                      'quotes' => 'Quotes',
                                      'links' => 'Links',
                                      'about' => 'About');

    $this->load->model('quotes_model');
    $this->slots['quote'] = $this->quotes_model->get_random_quote();
    $this->load->view('skeleton', $this->slots);
  }
}
?>