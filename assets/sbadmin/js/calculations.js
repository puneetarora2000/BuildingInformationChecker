/**
 * Scripts for Admin Panel
 */

jQuery(document).ready(function ($) {
	//console.log("Admin Panel");
	if($('#field-inspection_stage').val() == 'first') {
		$('#reserved_distance_deducted_field_box').hide();

		$('input[name="reserved_distance_correct"]').on('change', function() {
			if(this.value == 0)
			{
				$('#reserved_distance_deducted_field_box').show();
			} else {
				$('#reserved_distance_deducted_field_box').hide();
			}
		});
	}
	

	$('#field-estimated_yield').on('keyup', function () {
		var result = $('#field-certified_area').val() * $('#field-estimated_yield').val();
		$('#field-total_quantity').val( result.toFixed(2) );
		$('#field-total_quantity').attr("readonly","readonly");
	});
	$('#field-certified_area').on('keyup', function () {
		var result = $('#field-certified_area').val() * $('#field-estimated_yield').val();
		$('#field-total_quantity').val( result.toFixed(2) );
		$('#field-total_quantity').attr("readonly","readonly");
	});

	$('#field-cancelled_reserved_distance').on('keyup', function (e) {
		var result = parseFloat($('#field-cancelled_reserved_distance').val()) + 
				parseFloat($('#field-cancelled_due_to_damage').val()) +
				parseFloat($('#field-cancelled_cut_before_inspection').val()) +
				parseFloat($('#field-cancelled_less_than_set_quality').val())
				;
		$('#field-cancelled_total_area').val( result );
		$('#field-cancelled_total_area').attr("readonly","readonly");
	});

	$('#field-cancelled_due_to_damage').on('keyup', function () {
		var result = parseFloat($('#field-cancelled_reserved_distance').val()) + 
				parseFloat($('#field-cancelled_due_to_damage').val()) +
				parseFloat($('#field-cancelled_cut_before_inspection').val()) +
				parseFloat($('#field-cancelled_less_than_set_quality').val())
				;
		$('#field-cancelled_total_area').val( result );
		$('#field-cancelled_total_area').attr("readonly","readonly");
	});

	$('#field-cancelled_cut_before_inspection').on('keyup', function () {
		var result = parseFloat($('#field-cancelled_reserved_distance').val()) + 
				parseFloat($('#field-cancelled_due_to_damage').val()) +
				parseFloat($('#field-cancelled_cut_before_inspection').val()) +
				parseFloat($('#field-cancelled_less_than_set_quality').val())
				;
		$('#field-cancelled_total_area').val( result );
		$('#field-cancelled_total_area').attr("readonly","readonly");
	});

	$('#field-cancelled_less_than_set_quality').on('keyup', function () {
		var result = parseFloat($('#field-cancelled_reserved_distance').val()) + 
				parseFloat($('#field-cancelled_due_to_damage').val()) +
				parseFloat($('#field-cancelled_cut_before_inspection').val()) +
				parseFloat($('#field-cancelled_less_than_set_quality').val())
				;
		$('#field-cancelled_total_area').val( result ).trigger('change');
		$('#field-cancelled_total_area').attr("readonly","readonly");
	});

	$('#field-cancelled_total_area').bind('change paste', function() {
		var result = 
			parseFloat($('#field-area_inspected').text()) - 
				(parseFloat($('#field-reserved_distance_deducted').text()) +  parseFloat($('#field-cancelled_total_area').val())
				);
			console.log(result);
		$('#field-certified_area').val( result );
		$('#field-certified_area').attr("readonly","readonly");
	});


});