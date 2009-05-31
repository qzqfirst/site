$('document').ready(
  function() {
    $('h4 + p').css('display', 'none');
    $('h4 > span').click(function () {
                    $(this).parent().next('p').slideToggle();
                    animate($(this).children('span'));
                  }).prepend( '<span class="icon">[+]</span>' );
    $('h4 > span').hover(function () { $(this).css('color', '#252');},
                  function () { $(this).css('color', 'inherit');}).css('cursor', 'default');
  });

function animate($tag)
{
  var old = $tag.html()[1];
  var c = '';
  if (old == '-') c = '+';
  else if (old == '+') c = '-';
  $tag.html('['+c+']');
}
