<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<style type="text/css">
  html { height: 100% }
  body { height: 100%; margin: 0; padding: 0 }
  #map_canvas { height: 100% }
</style>


<?php $address = (isset($_REQUEST["address"])) ? $_REQUEST["address"] : "" ; ?>
<script src="http://flowartz.dev:8080/template/js/jquery.min.js"></script>
<!-- json2 jquery -->
<script type="text/javascript" src="http://flowartz.dev:8080/template/js/jquery.base64.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false">
</script>
<script type="text/javascript">
	var marker;
	var map;
	function initialize() {
		var address = "<?php echo $address;?>";
                address = $.base64.decode(address);
		var geo = new google.maps.Geocoder;
		var gmap = null;
		geo.geocode({'address':address},function(results, status){
			if (status == google.maps.GeocoderStatus.OK) {
				gmap = results[0].geometry.location;
				lat = gmap.lat();
				lng = gmap.lng();

				var latlng = new google.maps.LatLng(lat, lng);
				var myOptions = {
					zoom: 15,
					center: latlng,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};

				map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

				marker = new google.maps.Marker({
				  map:map,
				  draggable:true,
				  animation: google.maps.Animation.DROP,
				  position: latlng
				});
				google.maps.event.addListener(marker, 'click', toggleBounce);
			} else {
				alert("Geocode was not successful for the following reason: " + status);
				return;
			}

		});
	}
	function toggleBounce() {
		if (marker.getAnimation() != null) {
			marker.setAnimation(null);
		} else {
			marker.setAnimation(google.maps.Animation.BOUNCE);
		}
	}
</script>
</head>
<body onload="initialize()">
  <div id="map_canvas" style="width:100%; height:100%"></div>
</body>
</html>