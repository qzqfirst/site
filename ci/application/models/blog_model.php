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
    $this->db->select('posts.id')->from('posts')->join('tags_join', 'posts.id = tags_join.post_id')->join('tags', 'tags_join.tag_id = tags.id')->where('tags.name', $tag);
    $ids = array();
    foreach($this->db->get()->result() as $row)
      $ids[] = $row->id;

    $this->db->from('posts')->where_in('id', $ids)->order_by('date', 'desc');
    $posts = $this->db->get()->result_array();
    for ($i = 0; $i < sizeof($posts); $i++)
      $this->_get_details($posts[$i]);
    return $posts;
  }

  function _get_details(&$post)
  {
    $this->db->select('name')->from('posts')->join('tags_join', 'posts.id = tags_join.post_id')->join('tags', 'tags_join.tag_id = tags.id')->where('posts.id', $post['id']);
    $post['tags'] = $this->db->get()->result_array();
    $post['comments'] = array();
  }
}
?>