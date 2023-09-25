jQuery(document).ready(function($) {
	/**
	 * Binnacle remove
	 */  
	$('a[data-binnacle-remove]').click(function(e) {
		e.preventDefault();
		var binid = $(this).attr('data-binnacle-remove');

		$.ajax({
		   type : "post",
		   url : ajax_object.ajax_url,
		   data : {
			   action: "acgs_binnacle_remove",
			   bid: binid,
		   },
		   error: function(response){
		   },
		   success: function(response) {
			  if(response.success == true) {

				$('a[id='+binid+'], button[id='+binid+']').closest('tr').remove();

				M.toast({html: 'Binnacle item removed', classes: 'teal darken-1'})
			  }
		   }
	   });

	});

});