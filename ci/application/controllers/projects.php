<?php
include_once('BaseController.php');
class Projects extends BaseController {
  function index()
  {
    $this->slots['nav'] = 'projects';
    $this->load->model('projects_model');
    $projects = Array('projects' => $this->projects_model->get_projects());
    $this->slots['content'] = $this->load->view('projects', $projects, true);
    $this->slots['title'] = 'Projects';
    $this->slots['style'] = 'projects';
    $this->render();
  }
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */