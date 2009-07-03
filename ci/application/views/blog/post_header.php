<?php include("permalink.php"); ?>
<div class="date">Published: <span><?php echo substr($published, 0, 10); ?></span></div>

<?php if (sizeof($tags) > 0): ?>
<div class="tags">
Tags:
<?php foreach($tags as $tag): ?>
  <?php echo anchor('blog/tag/'.$tag['name'], $tag['name'])."\n"; ?>
<?php endforeach;?>
</div>
<?php endif; ?>
