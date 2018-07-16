<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title"><b><?php echo $this->Session->read('Auth.User.name'); ?></b></h3>
	</div>
	<div class="panel-body">
		<?php 
			echo $this->Form->create('User', $options = array(
				'url' => array(
					'controller' => 'users',
					'action' => 'edit',
					$this->Session->read('Auth.User.id')
				),
				'inputDefaults' => array(
					'class' => 'form-control',
					'div' => array(
						'class' => 'form-group'
					)
				)
			));
			echo $this->Form->input('id', $options = array(
				'value' => $this->Session->read('Auth.User.id')
			));
			echo $this->Form->input('username', $options = array(
				'value' => $this->Session->read('Auth.User.username')
			));
			echo $this->Form->input('name', $options = array(
				'value' => $this->Session->read('Auth.User.name')
			));
			echo $this->Form->input('email', $options = array(
				'value' => $this->Session->read('Auth.User.email')
			));
			echo $this->Form->input('phone', $options = array(
				'value' => $this->Session->read('Auth.User.phone')
			));
			echo $this->Form->input('birthday', $options = array(
				'value' => $this->Session->read('Auth.User.birthday'),
				'type' => 'text',
				'class' => 'form-control date'
			));
			echo $this->Form->input('address', $options = array(
				'value' => $this->Session->read('Auth.User.address')
			));
		?>
		<div id="map"></div>
		<?php
			echo $this->Form->button('<i class="glyphicon glyphicon-floppy-disk"></i> '.__d('croogo', 'Update'), $options = array(
				'class' => 'btn btn-info btn-sm'
			));
			echo $this->Form->end($options = null);
		?>
	</div>
</div>
<script>
	function initMap() {
	    var map = new google.maps.Map(document.getElementById('map'), {
	      center: {lat: 16.075188, lng: 108.223013},
	      zoom: 18
	    });
	    var input = document.getElementById('UserAddress');
	    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

	    var autocomplete = new google.maps.places.Autocomplete(input);
	    autocomplete.bindTo('bounds', map);

	    var infowindow = new google.maps.InfoWindow();
	    var marker = new google.maps.Marker({
	        map: map,
	        anchorPoint: new google.maps.Point(0, -29)
	    });

	    autocomplete.addListener('place_changed', function() {
	        infowindow.close();
	        marker.setVisible(false);
	        var place = autocomplete.getPlace();
	        if (!place.geometry) {
	            window.alert("Vui lòng điền đầy đủ địa chỉ!");
	            return;
	        }
	        // If the place has a geometry, then present it on a map.
	        if (place.geometry.viewport) {
	            map.fitBounds(place.geometry.viewport);
	        } else {
	            map.setCenter(place.geometry.location);
	            map.setZoom(17);
	        }
	        marker.setIcon(({
	            url: place.icon,
	            size: new google.maps.Size(71, 71),
	            origin: new google.maps.Point(0, 0),
	            anchor: new google.maps.Point(17, 34),
	            scaledSize: new google.maps.Size(35, 35)
	        }));
	        marker.setPosition(place.geometry.location);
	        marker.setVisible(true);
	        var address = '';
	        if (place.address_components) {
	            address = [
	              (place.address_components[0] && place.address_components[0].short_name || ''),
	              (place.address_components[1] && place.address_components[1].short_name || ''),
	              (place.address_components[2] && place.address_components[2].short_name || '')
	            ].join(' ');
	        }
	        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
	        infowindow.open(map, marker);
	    });
	}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3Yq6qsh0X5iYHk4F0cPqEaU2vvnHWENc&libraries=places&callback=initMap&language=vn&region=VN" async defer></script>