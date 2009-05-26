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
  }

  function index()
  {
    $posts = $this->blog_model->get_first(4);
    $this->slots['content'] = '';
    foreach ($posts as $post)
      $this->slots['content'] .= $this->load->view('post_short', $post, true);
    $this->render();
  }

  function post($title)
  {
    $post = $this->blog_model->get_post($title);
    $this->slots['content'] = $this->load->view('post_long', $post, true);
    $this->render();
  }

  function tag($tag)
  {
    $posts = $this->blog_model->get_posts_by_tag($tag);
    $this->slots['content'] = '';
    foreach ($posts as $post)
      $this->slots['content'] .= $this->load->view('post_short', $post, true);
    $this->render();
  }
}
