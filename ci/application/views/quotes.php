<h2 class="page-title">Quotes</h2>
<hr />
<p>
  Here's a list of the quotes that keep appearing up in the header. In case you
  liked one and can't remember it exactly.
</p>
<ul id="quotes">
<?php foreach ($quotes as $quote): ?>
  <li>"<?php echo $quote->text; ?>"
    <div class="author">&mdash; <?php echo $quote->author; ?></div>
    <hr />
  </li>
<?php endforeach; ?>
</ul>
