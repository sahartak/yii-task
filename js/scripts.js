$(document).ready(function() {


	$('#add_field').click(function() {
	   var template = $('#field_template').html();
		$(this).parent().before(template);
	});

	$('body').on('click', '.delete_field', function() {
		$(this).closest('.row').remove();
	});

	if($('.tour-form').length) {
		$('input[name="Tour[field_names]"]').attr('name', 'Tour[field_names][]');
		$('input[name="Tour[field_sorts]"]').attr('name', 'Tour[field_sorts][]');
	}

	$('#booking-time').datepicker({
		dateFormat: 'yy-mm-dd'
	});
});