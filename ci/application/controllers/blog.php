<?php
include_once('BaseController.php');
class Blog extends BaseController {
  function __construct()
  {
    parent::__construct();
    $this->slots['nav'] = 'blog';
    $this->slots['style'] = 'blog';
    $this->load->helper('url');
    $this->load->model('blog_model');

    $this->slots['tags'] = $this->blog_model->get_tags();
    $this->slots['dates'] = $this->blog_model->get_dates();
  }

  function index()
  {
    $this->slots['title'] = "Recent posts";
    $posts = $this->blog_model->get_first(4);
    $this->_post_list($posts);
    $this->render();
  }

  function post($title, $errors='')
  {
    session_start();
    $post = $this->blog_model->get_post($title);
    if (!isset($_SESSION['errors']))
      $_SESSION['errors'] = '';
    $post['errors'] = $_SESSION['errors'];

    if (!isset($_SESSION['set']))
      $_SESSION['set'] = array('user'    => '',
                               'url'     => '',
                               'message' => '',
                               'title'   => '',
                               'url'     => '');
    $post['set'] = $_SESSION['set'];

    $this->load->library('form_validation');
    $this->slots['posts'] = $this->load->view('blog/post_long', $post, true);
    $this->render();
  }

  function tag($tag)
  {
    $this->slots['title'] = "Posts tagged '$tag'";
    $posts = $this->blog_model->get_posts_by_tag($tag);
    $this->_post_list($posts);
    $this->render();
  }

  function date($year, $month)
  {
    $this->slots['title'] = "Posts of " . date('F', mktime(0,0,0,$month,1)) . ", $year";
    $posts = $this->blog_model->get_posts_by_date($year, $month);
    $this->_post_list($posts);
    $this->render();
  }

  function comment()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('user', 'Name', 'trim|required|min_length[3]|max_length[50]');
    $this->form_validation->set_rules('url', 'Url', 'trim|max_length[300]|prep_url');
    $this->form_validation->set_rules('message', 'Message', 'trim|required|max_length[500]');

    session_start();
    $_SESSION['set'] = array('user'    => $this->input->post('user'),
                             'url'     => $this->input->post('url'),
                             'message' => $this->input->post('message'),
                             'title'   => $this->input->post('post'));

    if ($this->form_validation->run()) {
      $this->blog_model->post_comment($_SESSION['set']);
      $_SESSION['set']['message'] = '';
    }
    $_SESSION['errors'] = validation_errors();
    redirect($this->input->post('post').'#post-comment');
  }

  function _post_list($result)
  {
    $this->slots['posts'] = '';
    foreach ($result as $post)
      $this->slots['posts'] .= $this->load->view('blog/post_short', $post, true);
  }


  function render()
  {
    $this->slots['content'] = $this->load->view('blog/skeleton', $this->slots, true);
    parent::render();
  }
}
