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
	});
},250);
