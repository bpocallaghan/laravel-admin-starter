$(document).ready(function(){
	$("#LanguageSwitcher").change(function(){
		var locale = $(this).val();
		var _token = $("input[name=_token]").val();

		$.ajax({
			url: "/language",
			type: 'POST',
			data: {locale: locale, _token: _token},
			datatype: 'json',
			success: function (data) {
				
			},
			error: function (data) {
				
			},
			beforeSend: function () {
				
			},
			complete: function (data) {
				window.location.reload(true);
			}
		});
	});
});