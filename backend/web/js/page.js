(function() {
  var cookie, navActive;

  cookie = 'menuResize';

  navActive = '#479BD7';

  if ($.cookie(cookie) === 'true') {
    $('#menu-resize').html('< ย่อเมนู');
    $('aside').removeClass('resize-in');
  } else {
    $('#menu-resize').html('ขยาย >');
    $('aside').addClass('resize-in');
    $('li.dropdown.active').addClass('resize-in');
    $('li.dropdown.active').removeClass('active');
  }

  $('#menu-resize').on('click', function() {
    if ($('aside').hasClass('resize-in')) {
      $.cookie(cookie, true);
      $(this).html('< ย่อเมนู');
      $('aside').removeClass('resize-in');
      $('li.dropdown.resize-in').addClass('active');
      $('li.dropdown.resize-in').removeClass('resize-in');
      $('scetion').css('left', '180px');
    } else {
      $.cookie(cookie, false);
      $(this).html('ขยาย >');
      $('aside').addClass('resize-in');
      $('li.dropdown.active').addClass('resize-in');
      $('li.dropdown.active').removeClass('active');
      $('scetion').css('left', '50px');
    }
  });

}).call(this);
