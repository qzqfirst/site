<h2 class="page-title">Quotes</h2>
<hr />
<p>
  Here's a list of the quotes that keep appearing up in the header. In case you
  liked one and can't remember it exactly.
</p>
<table id="quotes">
<?php $col = 0; ?>
<?php foreach ($quotes as $quote): ?>
<?php if ($col == 0): ?>
  <tr>
<?php endif; ?>
    <td>"<?php echo $quote->text; ?>"
      <div class="author">&mdash; <?php echo $quote->author; ?></div>
    </td>
<?php if ($col == 2): $col = 0; ?>
  </tr>
<?php endif; ?>
<?php $col++; ?>
<?php endforeach; ?>
</table>
