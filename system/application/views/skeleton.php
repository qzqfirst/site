<?xml version="1.1" encoding="utf-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="hu" lang="hu">
  <head>
    <title>Oldal</title>
    <meta name="Content-Type" content="text/html; charset=UTF-8" />
    <?php echo link_tag("css/style.css"); ?>
  </head>
  <body>
    <div id="header">
      <div class="wrapper">
        <?php echo img("img/header.jpg"); ?>
        <ul>
          <?php foreach ($pagelinks as $link => $caption): ?>
          <li<?php if ($nav == $link) echo ' class="current"';?>><?php echo anchor($link, $caption); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
    <div id="main" class="wrapper">
<!--Main content-->
<?php echo $content ?>
<?php echo $menu ?>
    </div>
  </body>
</html>
