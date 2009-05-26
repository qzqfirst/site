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
