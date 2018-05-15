$('textarea').keyup(function() {
	$.post("set.meth", {
		key: $(this).attr('id'),
		value: $(this).val()
	});
});

setInterval(function() {
	$.getJSON("get.meth").done(function(json) {
		$('textarea[readonly]').each(function() {
			$(this).val(json[$(this).attr('id')]);
		});
		$('.emoji-picker[readonly]').each(function() {
			$(this).attr('class', 'emoji-picker em');
			$(this).addClass(json[$(this).attr('id')]);
		});
	});
},250);

$('.emoji-picker:not([readonly])').click(function() {
	$('.emoji-list[data-input="'+$(this).attr('id')+'"]').css('display', 'flex');
});

$('.emoji-list .em').click(function() {
	$.post("set.meth", {
		key: $(this).parent('.emoji-list').data('input'),
		value: $(this).data('value')
	});

	$('.emoji-picker[id="'+$(this).parent('.emoji-list').data('input')+'"]').attr('class', 'emoji-picker em');
	$('.emoji-picker[id="'+$(this).parent('.emoji-list').data('input')+'"]').addClass($(this).data('value'));


	$(this).parent('.emoji-list').css('display', 'none');
});
