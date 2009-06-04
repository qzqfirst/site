 <?php include('post_header.php'); ?>
<div class="long post">
<?php echo $short_text;
if ($more == true): ?>
<a id="more"></a>
<?php
   echo $more_text;
   endif;
 ?>
</div>
<hr />
<a id="comments"></a>
<h2>Comments</h2>
<?php foreach ($comments as $comment): ?>
<div class="box comment">
  <span class="author"> <?php echo empty($comment['url']) ? $comment['name'] : anchor($comment['url'], $comment['name']); ?> </span>
  <p><?php echo $comment['text']; ?></p>
  <div class="date"><?php echo $comment['time'];?></div>
</div>
<?php endforeach; ?>
<div id="post-comment">
<?php if (!empty($errors)): ?>
<div id="errors">
<?php echo $errors; ?>
</div>
<?php endif; ?>
<?php
echo form_open('blog/comment');
echo form_fieldset('Post a comment');
echo form_hidden('post', uri_string());
echo "Name: " . form_input('user', $set['user']) . "<br />";
echo "Url (optional): " . form_input('url', $set['url']) . "<br />";
echo "Message (max. 500 characters):<br />";
echo form_textarea(array('name' => 'message', 'cols' => '60', 'value' => $set['message'])) . "<br />";
echo "[code] and [/code] will be converted to &lt;pre&gt; and &lt;/pre&gt; tags. Tags with &lt; and &gt; will be preserved.<br />";
echo form_submit('submit', 'Post comment');
echo form_fieldset_close();
echo form_close();
?>
</div>
