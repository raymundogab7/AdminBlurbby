function ajaxCall(type, url, params, data = [], opt1 = [])
{
	$.ajax({
		url: url,
		data: data,
		success: function(result) {
			showUniversalModal(result.message);
		},
		error: function(result) {
			
		},
		complete: function(result) {

		}
	});
}

function showUniversalModal(message = '', title = 'Success')
{
	$('.universal_modal').modal('show');
	$('.universal-modal-title').html(title);
	$('.universal-modal-body').html(message);
}