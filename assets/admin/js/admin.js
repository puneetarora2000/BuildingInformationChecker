/**
 * Scripts for Admin Panel
 */

jQuery(document).ready(function ($) {
	//console.log("Admin Panel");
	
	// Sortable
	var el = $('.sortable');
	for (var i=0; i<el.length; i++) {
		var sortable = Sortable.create(el[i]);
	}

	$("#field-suffix").val("S.");
/*
	$('#field-Rate').on('change', function() {
		    //	alert('check');
		       var rate = $(this).val();
		       var qty = $('#field-Quantity').val();
		       var amount = rate * qty;
		       $('#field-Amount').val(amount);
		       //alert(amount);
	});

	//http://gurilocal.com/cicurd/admin/bill/billdetails/add/35001

	var url = $(location).attr('href');
	if (url.indexOf("billdetails/add") >= 0) {
		parts = url.split('/'),
	    lastPart = parts.pop();
		//alert(lastPart);

		$('#field-BillID').val(lastPart);

		$("#field-BillID").attr('disabled', true).trigger("liszt:updated");
		//alert('works');
	}*/
/*
	function print_popup(data){
		var divContents = $("#bill").html();
		var css_url =  asset_url + 'grocery_crud/themes/bootstrap/css/bootstrap/bootstrap.css';
            var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title>DIV Contents</title>');
            printWindow.document.write('<link rel="stylesheet" href="'+ css_url + '" type="text/css" />');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
	}

	var css_url =  asset_url + 'grocery_crud/themes/bootstrap/css/bootstrap/bootstrap.css';
*/
	 $("#print").click(function () {
	 	 	$('#receipt').printThis({
	 	 		importCSS: true,
	 	 		printContainer: true, 	
	 	 		pageTitle: 'Bill',
	 	 		removeInline: false
	 	 	});

     });

});