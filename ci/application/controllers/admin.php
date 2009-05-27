<?php
include_once('BaseController.php');
class Admin extends BaseController {
  function __construct()
  {
    parent::__construct();
    $this->load->model('admin_model');
    $this->load->helper('url');
    session_start();
    $this->check();
    $this->slots['nav'] = 'admin';
  }

  function check()
  {
    if ((!$this->admin_model->is_logged_in()) && (uri_string() != "/admin/login") && (uri_string() != "/admin/do_login"))
      redirect('admin/login');
    return true;
  }

  function index($page=0)
  {
    $posts = $this->admin_model->get_posts($page);
    $this->load->library('table');
    $this->slots['title'] = 'Blog posts';
    $this->slots['content'] = $this->load->view('admin/list', array('posts' => $posts,
                                                                    'table' => $this->table,
                                                                    'page'  => $page), true);
    $this->render();
  }

  function post($id)
  {
    $post = $this->admin_model->get_post_by_id($id);
    $this->slots['title'] = 'Edit post';
    $this->slots['content'] = $this->load->view('admin/post', array('post' => $post), true);
    $this->render();
  }

  function login()
  {
    $this->slots['content'] = $this->load->view('admin/login', '', true);
    $this->slots['title'] = 'Admin login';
    $this->render();
  }

  function do_login()
  {
    $this->admin_model->login();
    if ($this->check()) redirect('/admin/index');
  }

  function logout()
  {
    $this->admin_model->logout();
    redirect('blog');
  }

  function save()
  {
    $submit = $this->input->post('submit');
    if ($submit == 'Delete')
      $this->admin_model->delete();
    else if ($submit == 'Save')
      $this->admin_model->save();
    redirect('admin/index');
  }

  function new_post()
  {
    $data = array('id'    => -1,
                  'title'=> '',
                  'url_title' => '',
                  'date' => date("Y-m-d"),
                  'tags' => array(),
                  'short_text' => '',
                  'more_text' => ''
                  );
    $this->slots['content'] = $this->load->view('admin/post', array('post' => $data), true);
    $this->slots['title'] = 'New post';
    $this->render();
  }

  function render()
  {
    if (uri_string() != "/admin/login")
      $this->slots['content'] .= '<p>' . anchor("admin/logout", 'Log out') . '</p>';
    parent::render();
  }
}
