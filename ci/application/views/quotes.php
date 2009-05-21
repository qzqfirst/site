<h2 class="page-title">Quotes</h2>
<hr />
<p>
  Here's a list of the quotes that keep appearing up in the header. In case you
  liked one and can't remember it exactly.
</p>
<ul>
<?php foreach ($quotes as $quote): ?>
  <li>"<?php echo $quote->text; ?>" &mdash; <?php echo $quote->author; ?></li>
<?php endforeach; ?>
</ul>
