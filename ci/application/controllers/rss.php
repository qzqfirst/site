<?php
class Rss extends Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('blog_model');
    $this->load->helper('xml');
    $this->load->helper('url');
    $this->load->helper('date');
  }

  function index()
  {
    header("Content-Type: application/rss+xml");
    $data['encoding'] = 'utf-8';
    $data['posts'] = array();
    foreach ($this->blog_model->get_first(10) as $entry) {
      $entry['text'] = $entry['short_text'];
      // Take care of the limited length lines
      $entry['text'] = str_replace(array("\r", "\r\n", "\n"), " ", $entry['text']);
      // Multiple spaces: bad
      $entry['text'] = preg_replace("/ +/", " ", $entry['text']);
      // Spaces at start of line
      $entry['text'] = preg_replace(array("/(\n|<br>|<\/br>|<p>|<\/p>) */", "/ *(\n|<br>|<\/br>|<p>|<\/p>)/"), "$1", $entry['text']);
      // I don't want more than one empty line
      $entry['text'] = preg_replace("/\n\n\n*/", "\n\n", $entry['text']);
      if ($entry['more'])
        $entry['text'] .= "<p>Read the rest at Abesto's woes.</p>";
      $triple = explode('-', $entry['published']);
      $entry['pubdate'] = date('D, d M Y H:i:s \U\T\C', $entry['unix_published']);
      $data['posts'][] = $entry;
    }
    $this->load->view('blog/rss', $data);
  }
}
?>
