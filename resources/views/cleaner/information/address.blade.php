@extends('layouts.cleaner')

@section('content')


@push('styles')

<style type="text/css">
  .add-property {
    float: right;
  }

  .mdtp__wrapper {
    bottom: 120px !important;
  }

  .heading {
    font-size: 1.2em;
    margin-bottom: 25px;
  }

  .option {
    margin: 35px 7px;
    font-size: 18px;
  }

  .custom-control.custom-checkbox {
    margin: 35px 7px;
    font-size: 18px;
  }

  .has-error {
    border: 1.5px solid tomato !important;
  }
</style>


@endpush


<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        {{-- <h1 class="m-0 text-dark">
          <h3><i class="fas fa-cog mr-3"></i>Notification Setting</h3>
        </h1> --}}
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">General Information</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    {{-- <div class="card"> --}}
    <div class="row">
      <div class="col-12">
        <div class="card card-primary">
          <div class="card-body">
            <form method="post" action="/cleaner/address/create">
              {{ csrf_field() }}
              <div class="card-body">
                <div class="tab-content" id="general_tab_box">
                  <div class="tab-pane fade show active" id="general_tab" role="tabpanel" aria-labelledby="general_tab">
                    <div class="row">
                      <div class="col-12">
                        <label for="address">Street Address <span class="required">*</span></label>
                        <input type="text" name="address" id="autocomplete" value="{{ $address->address }}"
                          placeholder="We are using google auto complete form" onFocus="geolocate()"
                          class="form-control address">
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
                          <input type="text" name="city" value="{{ $address->city }}" id="locality" placeholder="City"
                            class="city form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="state">State</label>
                          <input type="text" name="state" placeholder="State" value="{{ $address->state }}"
                            id="administrative_area_level_1" class="state form-control" />
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="country">Country <span class="required">*</span></label>
                          <input type="text" name="country" placeholder="Country" value="{{ $address->country }}"
                            id="country" class="country form-control " />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="pincode">Zip Code</label>
                          <input type="text" name="pincode" value="{{ $address->pincode }}" placeholder="pincode"
                            id="postal_code" class="pincode form-control" />
                        </div>
                      </div>
                    </div>

                  </div>


                </div>

                <div class="row">
                  <div class="col-12">
                    <button class="btn btn-success float-right" id="property-btn">Next</button>
                  </div>
                </div>


              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    {{-- </div> --}}
  </div>

  </div>
  <!-- /.container-fluid -->
</section>
<!-- /. content -->
</div>
<!-- /. content-wrapper -->


@push('script')
<script>
  $('form').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});
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
  return false;
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
  return false;
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
<script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkSvueCGWz_a316NvJf7oDC6VD-MGwkOs&libraries=places&callback=initAutocomplete"
  async defer></script>
@endpush


@endsection