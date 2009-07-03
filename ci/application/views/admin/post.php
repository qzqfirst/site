<?php
$this->load->helper('form');
echo form_open('admin/save', '', array('id' => $post['id']));
echo "Title: " . form_input(array(
                                  'name' => 'title',
                                  'value' => $post['title'],
                                  'size' => 50)) . "<br />\n";
echo "Date: " . form_input('date', isset($post['published'])?$post['published']:'') . "<br />\n";
echo "Tags: ";
$tags = array();
foreach ($post['tags'] as $tag)
  $tags[] = $tag['name'];
echo form_input('tags', implode(', ', $tags)) . "<br />\n";
echo "Short text:<br />" . form_textarea('short_text', $post['short_text']) . "<br />\n";
echo "Long text:<br />" . form_textarea('more_text', $post['more_text']) . "<br />\n";
echo form_submit('submit', 'Save');
echo form_submit('submit', 'Cancel').'<br />';
echo form_submit('submit', 'Delete');
echo form_close();
?>