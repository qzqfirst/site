<div class="short-post">
<?php include("permalink.php"); ?>
<h3><?php echo anchor($permalink, $title); ?></h3>
<?php include('post_header.php'); ?>
<?php
echo $short_text;
if ($more == true)
  echo anchor($permalink.'#more', 'Read more...'); ?>
<div class="comments"><?php echo sizeof($comments); ?> comments</div>
</div>
