<?php include("permalink.php"); ?>
<h2><?php echo anchor($permalink, $title); ?></h2>
<div class="date">Published: <span><?php echo $date; ?></span></div>

<div class="tags">
Tags:
<?php foreach($tags as $tag): ?>
  <?php echo anchor('blog/tag/'.$tag['name'], $tag['name'])."\n"; ?>
<?php endforeach;?>
</div>
