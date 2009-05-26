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

  function post($title)
  {
    $post = $this->blog_model->get_post($title);
    $this->slots['posts'] = $this->load->view('post_long', $post, true);
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

  function _post_list($result)
  {
    $this->slots['posts'] = '';
    foreach ($result as $post)
      $this->slots['posts'] .= $this->load->view('post_short', $post, true);
  }


  function render()
  {
    $this->slots['content'] = $this->load->view('blog_skeleton', $this->slots, true);
    parent::render();
  }
}
