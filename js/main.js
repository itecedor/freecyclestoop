(function() {
		
	events = {

		_add_item: function() {


	    var options = { 
				type: 'POST',
				url:'submit_new_item.php', // this used to have the full URL, http://www.keimdesign.com/stoop/submit_new_item.php
				dataType: "html",
				success:function(response){
				 	$('.db-response').html("Anyone ever tell you, you're beautiful?<br />Thanks for contributing.");
				 	$('.loading-icon').hide();
				},
				error:function(){
					$('.db-response').html('Something happened, please try again.');
				 	$('.loading-icon').hide();
				}
	    }; 
	 
	    // bind form using 'ajaxForm' 
	    $('#item-entry').ajaxSubmit(options);
	    $('#item-entry').hide();
	    $('.loading').show();
    },
    
    _grab_item: function(item_id){
			$.ajax({
				type: 'POST',
				url:'grab_item.php',
        data: ({id: item_id}),
				success:function(response){
					$('.toggle-view').hide();
					$('#map').hide();
					$('#grid').hide();
					$('#item-details').html(response);
					$('#item-details').show();  
				}
			});	    
    },
    
    _claim_item: function(e){
    	e.preventDefault();
    	var item_id = $(this).attr('data-item-id');
			$.ajax({
				type: 'POST',
				url:'claim_item.php',
        data: ({id: item_id}),
				success:function(response){
					delMarker(item_id);
					$('#map').show();
					$('#item-details').hide();
				}
			});	    
    },
    
    show_map: function(e){
    	e.preventDefault();
			$('#item-details').hide();  
			$('#grid').hide();
			$('.toggle-view').show();
			$('#map').show();
    },

    show_grid: function(e){
    	e.preventDefault();
			$('#item-details').hide();  
			$('#map').hide();
			$('.toggle-view').show();
			$('#grid').show();
    }
		
	}	
	$(function() {
	
		$('.submit-item').bind('click', events._add_item);
		$('.back-to-map').live('click', events.show_map);
		$('.claim-item').live('click', events._claim_item);
		$('.show-map').live('click', events.show_map);
		$('.show-grid').live('click', events.show_grid);
		$('#grid img').click(function() {
			var item_id = $(this).attr('data-item-id');
			events._grab_item(item_id);
		});
 
  });
  
})();

function successHandler(location) {
		$('#latitude-value').val(location.coords.latitude);
		$('#longitude-value').val(location.coords.longitude);
}
function errorHandler(error) {
    alert('Attempt to get location failed: ' + error.message);
}
navigator.geolocation.getCurrentPosition(successHandler, errorHandler);