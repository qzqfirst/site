<table id="split">
  <tr>
    <td id="posts">
      <?php echo $posts; ?>
    </td>
    <td id="sideboxes">
      <div class="box" id="tags">
        <h3>Tags</h3>
        <table>
<?php foreach($tags as $tag):?>
          <tr>
            <td><?php echo anchor('blog/tag/'.$tag->name, $tag->name); ?></td>
            <td>(<?php echo $tag->c; ?>)</td>
          </tr>
<?php endforeach; ?>
        </table>
      </div>
      <div class="box" id="archive">
        <h3>Archive</h3>
        <table>
<?php foreach($dates as $date):?>
          <tr>
            <td><?php echo anchor('blog/'.$date->url, str_replace(' ', '&nbsp;', $date->label)); ?></td>
            <td>(<?php echo $date->c; ?>)</td>
          </tr>
<?php endforeach; ?>
        </table>
      </div>
    </td>
  </tr>
</table>
