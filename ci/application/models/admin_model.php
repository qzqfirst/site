<?php
include('blog_model.php');
class Admin_model extends Blog_model {

  function is_logged_in()
  {
    $this->load->database();
    $this->db->from('admin')->where('sid', sha1(session_id()));
    return ($this->db->get()->num_rows() == 1);
  }

  function login()
  {
    $user = $this->input->post('user');
    $pass = sha1($this->input->post('pass'));
    $this->db->where('user', $user)->where('pass', $pass);
    $this->db->update('admin', array('sid' => sha1(session_id())));
  }

  function logout()
  {
    $this->db->where('sid', sha1(session_id()));
    $this->db->update('admin', array('sid' => ''));
  }

  function get_posts($page)
  {
    $this->db->select('id, title, date')->from('posts')->limit(10, $page*10);
    $this->db->order_by('date', 'desc');
    $posts = $this->db->get()->result_array();
    for ($i = 0; $i < sizeof($posts); $i++)
      $this->_get_details($posts[$i]);
    return $posts;
  }

  function get_post_by_id($id)
  {
    $this->db->from('posts')->where('id', $id);
    $post = $this->db->get()->row_array();
    $this->_get_details($post);
    return $post;
  }

  function save()
  {
    $this->load->helper('url');
    $data = $_POST;

    // posts table
    $post = array('title'      => $data['title'],
                  'url_title'  => url_title($data['title'], 'dash', true),
                  'date'       => $data['date'],
                  'short_text' => $data['short_text'],
                  'more_text'  => $data['more_text'],
                  'more'       => ($data['more_text'] != '')
                  );

    if ($data['id'] > -1) {
      $this->db->where('id', $data['id']);
      $this->db->update('posts', $post);
    } else {
      $this->db->insert('posts', $post);
      $data['id'] = $this->db->insert_id();
    }

    // tags table
    $tags = array_map('trim', explode(',', $data['tags']));
    if ($tags[0] != '') {
      // tags.name is unique, so there'll be no duplicates
      foreach ($tags as $tag)
        $this->db->query("INSERT IGNORE INTO `tags` (`name`) VALUES ('$tag')");
      $tag_ids = array();
      foreach ($tags as $tag) {
        $this->db->select('id')->from('tags')->where('name', $tag);
        $tag_ids[] = $this->db->get()->row()->id;
      }

      // tags_join table
      // (tags_join.post_id, tags_join.tag_id) is unique, so there'll be no duplicates
      foreach ($tag_ids as $tag_id)
        $this->db->query("INSERT IGNORE INTO `tags_join` (`post_id`, `tag_id`) VALUES ('{$data['id']}', '$tag_id')");
    }

  }

  function delete()
  {
    $this->db->delete('posts', array('id' => $_POST['id']));
  }
}
?>