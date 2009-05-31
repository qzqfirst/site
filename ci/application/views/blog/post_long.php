 <?php include('post_header.php'); ?>
<div class="post">
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
<h3>Post a Comment</h3>
<?php if (!empty($errors)): ?>
<div id="errors">
<?php echo $errors; ?>
</div>
<?php endif; ?>
<?php
 echo form_open('blog/comment', '', array('post' => uri_string()));
 echo "Name: " . form_input('user', $set['user']) . "<br />";
 echo "Url (optional): " . form_input('url', $set['url']) . "<br />";
 echo "Message (max. 500 characters):<br />";
 echo form_textarea(array('name' => 'message', 'cols' => '60', 'value' => $set['message'])) . "<br />";
echo "[code] and [/code] will be converted to &lt;pre&gt; and &lt;/pre&gt; tags.<br />";
 echo form_submit('submit', 'Post comment');
 echo form_close();
?>
</div>
