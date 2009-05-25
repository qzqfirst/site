<?xml version="1.1" encoding="utf-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="hu">
  <head>
    <title><?php echo $title; ?> | Abesto's woes</title>
    <meta name="Content-Type" content="text/html; charset=UTF-8" />
    <?php echo link_tag("css/style.css")."\n"; ?>
<?php if (isset($style)): ?>
    <?php echo link_tag("css/".$nav.".css")."\n"; ?>
<?php endif; ?>
<?php if ($nav == 'projects'):?>
    <script type="text/javascript" src="<?php echo site_url('script/jquery-1.3.2.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('script/projects.js'); ?>"></script>
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
    <div id="contact">
      Contact: abesto0.at.gmail.com
    </div>
    <h2 class="page-title"><?php echo $title; ?></h2>
    <hr />
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
      <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/2.5/hu/">
        <img alt="Creative Commons License" style="border-width:0"
             src="http://i.creativecommons.org/l/by-nc-sa/2.5/hu/88x31.png" />
      </a>
    </div>
  </div>
  <div id="license">
    This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/2.5/hu/">Creative Commons Attribution-Noncommercial-Share Alike 2.5 Hungary License</a>.
  </div>
</body>
</html>