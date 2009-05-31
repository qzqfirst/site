<?php
function display_projects($list)
{
foreach ($list as $proj): ?>
<h4><span><?php echo $proj->name; ?></span></h4>
<p>
  <a href="<?php echo $proj->url; ?>"><?php echo $proj->link_text; ?></a><br />
<?php echo $proj->text; ?>
</p>
<?php endforeach;
}
?>

<p>
  The projects are listed in reverse chronologic order of their completion
  (ie. newest first). If you have javascript enabled, the descriptions will be
  hidden to make the page easier to read. Clicking on a project name will
  show you the details.
</p>
<?php display_projects($projects['np']); ?>
<h3>Private</h3>
<p>
  These are usually more interesting than useful. They mostly work, but the were
  just a way to try out an idea or learn something new.
</p>
<?php display_projects($projects['p']); ?>
