<?php
class Quotes_model extends Model {
  function get_random_quote()
  {
    $this->load->database();
    $this->db->select('text, author')->from('quotes')->order_by('Rand()', 'ASC')->limit(1);
    return $this->db->get()->row();
  }

  function get_all_quotes()
  {
    $this->load->database();
    $this->db->select('text, author')->from('quotes')->order_by('author');
    return $this->db->get()->result();
  }
}
?>