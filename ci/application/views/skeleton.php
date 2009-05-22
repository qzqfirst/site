<?xml version="1.1" encoding="utf-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="hu">
  <head>
    <title><?php echo $title; ?> | Abesto's woes</title>
    <meta name="Content-Type" content="text/html; charset=UTF-8" />
    <?php echo link_tag("css/style.css")."\n"; ?>
<?php if (isset($style)): ?>
    <?php echo link_tag("css/".$nav)."\n"; ?>
<?php endif; ?>
  </head>
  <body>
    <div id="header" style="background-image: url('<?php echo site_url("img/header_fill.jpg"); ?>')">
    <div style="width: 1000px; margin: auto">
      <?php echo img(array('src' => 'img/header.jpg', 'alt' => 'Abesto\'s woes'))."\n"; ?>
      <table id="quote"><tr><td>
        <div id="text">"<?php echo $quote->text; ?>"</div>
        <div class="author">- <?php echo $quote->author; ?></div>
      </td></tr></table>
      <ul>
        <?php foreach ($pagelinks as $link => $caption): ?>
        <li<?php if ($nav == $link) echo ' class="current"';?>><?php echo anchor($link, $caption); ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
  <div id="main">
<!-- Main content -->
<?php echo $content ?>
<!--End of main content -->
    <div id="widgets">
      <a href="http://codeigniter.com/">
        <?php echo img(array('src' => 'img/ciFuel.gif', 'style' => 'border:0', 'alt' => 'Fueled by CodeIgniter'))."\n"; ?>
      </a>
      <a href="http://validator.w3.org/check?uri=referer"><img
      style="border:0"
      src="http://www.w3.org/Icons/valid-xhtml11"
      alt="Valid XHTML 1.1" height="31" width="88" /></a>
      <a href="http://jigsaw.w3.org/css-validator/check/referer">
        <img style="border:0;width:88px;height:31px"
             src="http://jigsaw.w3.org/css-validator/images/vcss"
             alt="Valid CSS!" />
      </a>
    </div>
  </div>
</body>
</html>
