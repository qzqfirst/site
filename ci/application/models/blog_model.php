<?php
class Blog_model extends Model {
  function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  function get_first($limit)
  {
    $this->db->select('id, title, date, short_text, more')->from('posts')->order_by('date', 'desc')->limit($limit);
    $posts = $this->db->get()->result_array();
    for ($i = 0; $i < sizeof($posts); $i++)
      $this->_get_details($posts[$i]);
    return $posts;
  }

  function get_post($title)
  {
    $this->db->from('posts')->where('url_title', $title);
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

    $this->db->from('posts')->where_in('id', $ids)->order_by('date', 'desc');
    $posts = $this->db->get()->result_array();
    for ($i = 0; $i < sizeof($posts); $i++)
      $this->_get_details($posts[$i]);
    return $posts;
  }

  function get_posts_by_date($year, $month)
  {
    $this->db->from('posts')->like('date', $year.'-'.$month)->order_by('date', 'desc');
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
    $this->db->select("COUNT(`title`) AS c, DATE_FORMAT(`date`, '%M, %Y') AS label, DATE_FORMAT(`date`, '%Y/%m') AS url", false);
    $this->db->from('posts')->group_by("EXTRACT(YEAR_MONTH FROM `date`)");
    return $this->db->get()->result();
  }

  function _get_details(&$post)
  {
    $this->db->select('name')->from('posts');
    $this->db->join('tags_join', 'posts.id = tags_join.post_id')->join('tags', 'tags_join.tag_id = tags.id');
    $this->db->where('posts.id', $post['id']);
    $post['tags'] = $this->db->get()->result_array();
    $post['comments'] = array();
  }
}
?>