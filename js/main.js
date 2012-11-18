(function() {
		
	var events = {

		_add_item: function() {


	    var options = { 
				type: 'POST',
				url:'submit_new_item.php', // this used to have the full URL, http://www.keimdesign.com/stoop/submit_new_item.php
				dataType: "html",
				success:function(response){
				 	$('.db-response').html(response);
				},
				error:function(){
					$('.db-response').html('Something happened, please try again.');
				}
	    }; 
	 
	    // bind form using 'ajaxForm' 
	    $('#item-entry').ajaxSubmit(options)
    }
		
	}	
	$(function() {
	
		$('.submit-item').bind('click', events._add_item);
  
  });
  
})();

function successHandler(location) {
		$('#latitude-value').val(location.coords.latitude);
		$('#longitude-value').val(location.coords.longitude);

    var message = document.getElementById("message"), html = [];
    html.push("<img width='256' height='256' src='http://maps.google.com/maps/api/staticmap?center=", location.coords.latitude, ",", location.coords.longitude, "&markers=size:small|color:blue|", location.coords.latitude, ",", location.coords.longitude, "&zoom=14&size=256x256&sensor=false' />");
    message.innerHTML = html.join("");
}
function errorHandler(error) {
    alert('Attempt to get location failed: ' + error.message);
}
navigator.geolocation.getCurrentPosition(successHandler, errorHandler);