<div class="post">
<?php include("permalink.php"); ?>
<h3><?php echo anchor($permalink, $title); ?></h3>
<?php include('post_header.php'); ?>
<?php
echo $short_text;
if ($more == true)
  echo '<span class="more">'.anchor($permalink.'#more', 'Read more...').'</span>'; ?>
<span class="comments"><?php echo anchor($permalink.'#comments', sizeof($comments)." comments"); ?></span>
</div>
