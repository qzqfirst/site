<?php
class Blog_model extends Model {
  function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  function get_first($limit)
  {
    $this->db->select('*, UNIX_TIMESTAMP(`published`) AS unix_published')->from('posts')->order_by('published', 'desc')->limit($limit);
    $posts = $this->db->get()->result_array();
    for ($i = 0; $i < sizeof($posts); $i++)
      $this->_get_details($posts[$i]);
    return $posts;
  }

  function get_post($title)
  {
    $this->db->select('*, UNIX_TIMESTAMP(`published`) AS unix_published')->from('posts')->where('url_title', $title);
    $post = $this->db->get()->row_array();
    $this->_get_details($post);
    return $post;
  }

  function get_posts_by_tag($tag)
  {
    $this->db->select('posts.id')->from('posts');
    $this->db->join('tags_join', 'posts.id = tags_join.post_id')->join('tags', 'tags_join.tag_id = tags.id');
    $this->db->where('tags.name', $tag);
    $ids = array();
    foreach($this->db->get()->result() as $row)
      $ids[] = $row->id;

    $this->db->from('posts')->where_in('id', $ids)->order_by('published', 'desc');
    $posts = $this->db->get()->result_array();
    for ($i = 0; $i < sizeof($posts); $i++)
      $this->_get_details($posts[$i]);
    return $posts;
  }

  function get_posts_by_date($year, $month)
  {
    $this->db->from('posts')->like('published', $year.'-'.$month)->order_by('published', 'desc');
    $posts = $this->db->get()->result_array();
    for ($i = 0; $i < sizeof($posts); $i++)
      $this->_get_details($posts[$i]);
    return $posts;
  }

  function get_tags()
  {
    $this->db->select('tags.name, COUNT(tags_join.tag_id) AS c');
    $this->db->from('tags')->join('tags_join', 'tags.id = tags_join.tag_id');
    $this->db->group_by('tags.name');
    return $this->db->get()->result();
  }

  function get_dates()
  {
    $this->db->select("COUNT(`title`) AS c, DATE_FORMAT(`published`, '%M, %Y') AS label, DATE_FORMAT(`published`, '%Y/%m') AS url", false);
    $this->db->from('posts')->group_by("EXTRACT(YEAR_MONTH FROM `published`)");
    $this->db->order_by('published', 'desc');
    return $this->db->get()->result();
  }

  function post_comment($data)
  {
    $title = explode('/', $data['title']);
    $title = $title[sizeof($title)-1];
    $id = $this->db->select('id')->from('posts')->where('url_title', $title)->get()->row()->id;
    $this->db->insert('comments', array('post_id' => $id,
                                        'name' => $data['user'],
                                        'url'  => $data['url'],
                                        'time' => 'UTC_TIMESTAMP()',
                                        'text' => $this->process_message($data['message'])));

    include('mail_settings.php');

    $this->load->library('email', array('protocol' => 'smtp',
                                        'smtp_host' => 'ssl://smtp.gmail.com',
                                        'smtp_port' => 465,
                                        'smtp_user' => GMAIL_USER,
                                        'smtp_pass' => GMAIL_PASS,
                                        'smtp_timeout' => 10));

    $this->email->set_newline("\r\n");
    $this->email->from('comment.abesto@gmail.com', $data['user']);
    $this->email->to('abesto0@gmail.com');

    $this->email->subject('Blog comment');
    $this->email->message($data['message']."\n\n\nURL: ".base_url().$data['title']);

    $this->email->send();
  }

  function process_message($str)
  {
    $code = 0;
    $new = '';
    foreach (explode("\n", $str) as $line) {
      if ((preg_match('[code]', $line) === 1) && ($code == 0)) {
        $line = str_replace('[code]', '<pre>', $line);
        $code = 1;
      } else if ((preg_match('[/code]', $line) === 1) && ($code)) {
        $line = str_replace('[/code]', '</pre>', $line);
        $code = 2;
      }
      $new .= $line . "\n";
      if ($code == 0) $new .= "<br />";
      if ($code == 2) $code = 0;
    }
    return $new;
  }

  function _get_details(&$post)
  {
    $this->db->select('name')->from('posts');
    $this->db->join('tags_join', 'posts.id = tags_join.post_id')->join('tags', 'tags_join.tag_id = tags.id');
    $this->db->where('posts.id', $post['id'])->order_by('tags.name');
    $post['tags'] = $this->db->get()->result_array();
    $this->db->from('comments')->where('post_id', $post['id'])->order_by('time', 'asc');
    $post['comments'] = $this->db->get()->result_array();
  }
}