(function() {
		
	var events = {

		_request: function(api_method, success, error) {

      $.ajax({
        type: 'GET',
        dataType: 'json',
        url: 'js/hotspots.json',
        success: function(response) {
					var data = response.areas.area[0];
					
					var hotspot_html = hotspot_template(data);
          $('#main_container').html(hotspot_html);
          					
					var thumb_html = hotspot_thumb_template(data);
          $('.hotspot-thumbs').html(thumb_html);

					$('.hotspot-thumbs li').hoverIntent(events.show_hotspot_thumb, events.hide_hotspot_thumb);

			    $imagePan.unbind("mousemove");
			    $imagePan_container.css("top",0).css("left",0);
			    $(window).load();
        },
        error: function() {
        }
      });
    }
		
	}	
	$(function() {
	
		$('.asset-downloads li').bind('mouseover', events.mouseover_asset);
		$('.asset-downloads li').bind('mouseout', events.mouseout_asset);
  
  });
  
})();

function successHandler(location) {
    var message = document.getElementById("message"), html = [];
    html.push("<img width='256' height='256' src='http://maps.google.com/maps/api/staticmap?center=", location.coords.latitude, ",", location.coords.longitude, "&markers=size:small|color:blue|", location.coords.latitude, ",", location.coords.longitude, "&zoom=14&size=256x256&sensor=false' />");
    html.push("<p>Longitude: ", location.coords.longitude, "</p>");
    html.push("<p>Latitude: ", location.coords.latitude, "</p>");
    html.push("<p>Accuracy: ", location.coords.accuracy, " meters</p>");
    message.innerHTML = html.join("");
}
function errorHandler(error) {
    alert('Attempt to get location failed: ' + error.message);
}
navigator.geolocation.getCurrentPosition(successHandler, errorHandler);