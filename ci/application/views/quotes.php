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
<?php $col++; ?>
<?php if ($col == 3): $col = 0; ?>
  </tr>
<?php endif; ?>
<?php endforeach; ?>
<?php if ($col != 3): ?>
  </tr>
<?php endif; ?>
</table>
