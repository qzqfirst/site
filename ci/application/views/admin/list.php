<?php
foreach ($posts as $post)
  $table->add_row(anchor('admin/post/'.$post['id'], $post['title']), $post['published']);
$table->set_heading('Title', 'Published');
echo $table->generate();
echo '<p>'.anchor('admin/new_post', 'New Post').'</p>';
?>
<p>
<?php
if ($page > 0) {
  $page -= 1;
  echo anchor("admin/index/$page", "Previous page", array('style' => 'margin-right: 50px;'));
  $page += 1;
}
$page += 1;
echo anchor("admin/index/$page", "Next page");
?>
</p>