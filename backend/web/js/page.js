(function() {
  var cookie, navActive;

  cookie = 'menuResize';

  navActive = '#479BD7';

  if ($.cookie(cookie) === 'false') {
    $('#menu-resize').html('ขยาย >');
    $('aside').addClass('resize-in');
    $('li.dropdown.active').addClass('resize-in');
    $('li.dropdown.active').removeClass('active');
    $('section').css('left', '50px');
  } else {
    $('#menu-resize').html('< ย่อเมนู');
    $('aside').removeClass('resize-in');
    $('section').css('left', '180px');
  }

  $('#menu-resize').on('click', function() {
    if ($('aside').hasClass('resize-in')) {
      $.cookie(cookie, true);
      $(this).html('< ย่อเมนู');
      $('aside').removeClass('resize-in');
      $('li.dropdown.resize-in').addClass('active');
      $('li.dropdown.resize-in').removeClass('resize-in');
      $('section').css('left', '180px');
    } else {
      $.cookie(cookie, false);
      $(this).html('ขยาย >');
      $('aside').addClass('resize-in');
      $('li.dropdown.active').addClass('resize-in');
      $('li.dropdown.active').removeClass('active');
      $('section').css('left', '50px');
    }
  });

}).call(this);
