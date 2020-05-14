<div class="card-body">
	<div class="tab-content" id="general_tab_box">
		<div class="tab-pane fade show active" id="general_tab" role="tabpanel" aria-labelledby="general_tab">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<input type="hidden" value="{{ $user->id }}" id="user_id" name="">
						<label for="property_name">Property Name <span class="required">*</span></label>
						<input type="text" value="" name="property_name" required="" id="property_name" class="form-control">
					</div>
				</div>
				<div class="col-md-6">
					<label for="property_address">Street Address <span class="required">*</span></label>
					<input type="text" name="property_address" id="autocomplete" placeholder="Enter your address"
						onFocus="geolocate()" class="form-control property_address">

				</div>
			</div>
			<table id="address" style="display: none;">
				<tr>
					<td class="label">Street address</td>
					<td class="slimField"><input class="field" id="street_number" /></td>
					<td class="wideField" colspan="2"><input class="field" id="route" /></td>
				</tr>

			</table>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="city">City <span class="required">*</span></label>
						<input type="text" name="city" value="" required="" id="locality" class="city form-control">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="state">State</label>
						<input type="text" name="state" value="" id="administrative_area_level_1" class="state form-control" />
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="country">Country <span class="required">*</span></label>
						<input type="text" name="country" required="" value="" id="country" class="country form-control " />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="zipcode">Zip Code</label>
						<input type="text" name="zipcode" value="" id="postal_code" class="zipcode form-control" />
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="unit">Unit or Name</label>
						<input type="text" name="unit" value="" id="unit" class="form-control">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="access_code">Access Code</label>
						<input type="text" name="access_code" value="" id="access_code" class="form-control">
					</div>
				</div>
			</div>


			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="currency">Currency <span class="required">*</span></label>
						<select id="currency" name="currency" class="form-control custom-select">
							<option value="inr">INR (Indian Rupee)</option>
							<option value="euro">EUR (EURO)</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="property_color">Property Color</label>
						<div class="">
							<input type="text" name="property_color" id="colorpicker-full"
								class="color_picker form-control example custom-select">
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="property_color">Propert Type</label>
						<div class="">
							<select name="property_type" class="form-control" id="property_type">
								<option disabled selected>Select property type</option>
								@if(isset($propertyTypes ))
								@foreach ($propertyTypes as $type)
								<option value='{{ $type }}'>{{ $type }}</option>
								@endforeach
								@endif
							</select>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="bedrooms">Number of Bedrooms <span class="required">*</span></label>
						<input type="text" value="" name="bedrooms" id="bedrooms" class="form-control">

					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="bathrooms">Number of Bathrooms <span class="required">*</span></label>
						<input type="text" value="" name="bathrooms" id="bathrooms" class="form-control">

					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="unit_of_measurement">Unit of Measurement</label>
						<select id="unit_of_measurement" name="unit_of_measurement" class="form-control custom-select">
							<option value="square_feet">Square Feet</option>
							<option value="square_meter">Square Meter</option>
						</select>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">

						<label for="size">Size</label>
						<input type="text" value="" name="size" id="size" class="form-control">
					</div>
				</div>

			</div>

			<div class="row">
				<div class="col-6">
					<div class="form-group">
						<label for="property_description">Property Description (visible to cleaners)</label>
						<textarea name="property_description" id="property_description" class="form-control" rows="4"></textarea>
					</div>
				</div>
				<div class="col-6">
					<label>Property Image</label>
					<input type="file" name="image" multiple>
					<input type="hidden" name="image1" id="image_0" value="">
				</div>
			</div>

		</div>


	</div>

	<div class="row">
		<div class="col-12">
			<button class="btn btn-success float-right" id="property-btn">Submit</button>
		</div>
	</div>


</div>
<!-- /.row -->

<!-- Google API functions -->
@push('script')
<script>
	// This sample uses the Autocomplete widget to help the user select a
// place, then it retrieves the address components associated with that
// place, and then it populates the form fields with those details.
// This sample requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script
// src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

var placeSearch, autocomplete;

var componentForm = {
	street_number: 'short_name',
	route: 'long_name',
	locality: 'long_name',
	administrative_area_level_1: 'short_name',
	country: 'long_name',
	postal_code: 'short_name'
};

function initAutocomplete() {
  // Create the autocomplete object, restricting the search predictions to
  // geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
  	document.getElementById('autocomplete'), {types: ['geocode']});

  // Avoid paying for data that you don't need by restricting the set of
  // place fields that are returned to just the address components.
  autocomplete.setFields(['address_component']);

  // When the user selects an address from the drop-down, populate the
  // address fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
  	document.getElementById(component).value = '';
  	document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details,
  // and then fill-in the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
  	var addressType = place.address_components[i].types[0];
  	if (componentForm[addressType]) {
  		var val = place.address_components[i][componentForm[addressType]];
  		document.getElementById(addressType).value = val;
  	}
  }
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
			var geolocation = {
				lat: position.coords.latitude,
				lng: position.coords.longitude
			};
			var circle = new google.maps.Circle(
				{center: geolocation, radius: position.coords.accuracy});
			autocomplete.setBounds(circle.getBounds());
		});
	}
}
</script>
@endpush