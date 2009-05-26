<?php include('post_header.php');
echo $short_text;
if ($more == true)
  echo anchor($permalink.'#more', 'Read more...'); ?>
<div class="comments"><?php echo sizeof($comments); ?> comments</div>
<hr />
