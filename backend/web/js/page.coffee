cookie = 'menuResize'
navActive = '#479BD7'

if $.cookie(cookie) == 'false'
	$('#menu-resize').html('ขยาย >')
	$('aside').addClass('resize-in')
	$('li.dropdown.active').addClass('resize-in')
	$('li.dropdown.active').removeClass('active')
	$('scetion').css('left', '50px')
else
	$('#menu-resize').html('< ย่อเมนู')
	$('aside').removeClass('resize-in')
	$('scetion').css('left', '180px')


$('#menu-resize').on('click',  ->
	if $('aside').hasClass('resize-in')
		$.cookie(cookie,true)
		$(@).html('< ย่อเมนู')
		$('aside').removeClass('resize-in')
		$('li.dropdown.resize-in').addClass('active')
		$('li.dropdown.resize-in').removeClass('resize-in')
		$('scetion').css('left', '180px')
	else
		$.cookie(cookie,false)
		$(@).html('ขยาย >')
		$('aside').addClass('resize-in')
		$('li.dropdown.active').addClass('resize-in')
		$('li.dropdown.active').removeClass('active')
		$('scetion').css('left', '50px')
	return
)

