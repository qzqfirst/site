<?php
class Projects_model extends Model {
  function get_projects()
  {
    $this->load->database();
    $this->db->from('projects')->where('priv', true)->order_by('id', 'DESC');
    $p = $this->db->get()->result();
    foreach ($p as $proj)
      $proj->text = str_replace("\n", "<br />\n", $proj->text);

    $this->db->from('projects')->where('priv', false)->order_by('id', 'DESC');
    $np = $this->db->get()->result();
    foreach ($np as $proj)
      $proj->text = str_replace("\n", "<br />\n", $proj->text);
    return array('p' => $p, 'np' => $np);
  }
}
?>