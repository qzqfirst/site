<?php
echo '<?xml version="1.0" encoding="utf-8" ?>' . "\n";
?>
<rss version="2.0"
     xmlns:dc="http://purl.org/dc/elements/1.1/"
     xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
     xmlns:admin="http://webns.net/mvcb/"
     xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
     xmlns:content="http://purl.org/rss/1.0/modules/content/">

  <channel>

    <title>Abesto's woes</title>

    <link><?php echo base_url(); ?></link>
    <description>Abesto's woes: a way too serious blog on web development and Linux</description>
    <dc:creator>Zoltán Nagy is abesto0 at gmail dot com</dc:creator>

    <dc:rights>Copyright <?php echo gmdate("Y", time()); ?></dc:rights>
    <admin:generatorAgent rdf:resource="http://www.codeigniter.com/" />

<?php
  foreach($posts as $entry):
    $title = $entry['title'];
    $published = $entry['published'];
    include('permalink.php');
    $published = $entry['pubdate'];
?>
    <item>
      <title><?php echo xml_convert($entry['title']); ?></title>
      <link><?php echo $permalink; ?></link>
      <guid><?php echo $permalink; ?></guid>
      <description><![CDATA[
      <?php echo $entry['text']; ?>
      ]]></description>
      <pubDate><?php echo $published; ?></pubDate>
    </item>
<?php endforeach; ?>
  </channel>
</rss>
<!--</body>-->