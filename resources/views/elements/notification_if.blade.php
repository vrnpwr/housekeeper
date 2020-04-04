@foreach($notifications as $key=>$value)

<div class="row">
	<div class="col-4">
		<div class="option">
			{{ $value->title }}
		</div>
	</div>
	<!-- Notification Center -->
	<div class="col-2">


		<div class="custom-control custom-checkbox">			
			<!-- Hidden field to enter title in the array -->
			<input type="hidden" name="notification[{{$key}}][title]" 
			value="{{ $value->title }}">
			<!-- Hidden field to enter title in the array -->
			@if($value->notification == 1)
			<input class="custom-control-input case_notification" id="customCheckbox_{{$key}}" checked="" 
			type="checkbox" name="notification[{{$key}}][notification]" value="1">
			<label for="customCheckbox_{{$key}}" class="custom-control-label"></label>		
			@else
			<input class="custom-control-input case_notification" id="customCheckbox_{{$key}}" 
			type="checkbox" name="notification[{{$key}}][notification]" value="1">
			<label for="customCheckbox_{{$key}}" class="custom-control-label"></label>		
			@endif

		</div>
	</div>
	<!-- Notification Center -->
	<!-- Email -->

	<div class="col-2">
		<div class="custom-control custom-checkbox">
			@if($value->email == 1)
			<input class="custom-control-input case_email" checked="" 
			id="customCheckbox__{{$key}}" type="checkbox" 
			name="notification[{{$key}}][email]"  value="1">
			<label for="customCheckbox__{{$key}}"  class="custom-control-label"></label>
			@else
			<input class="custom-control-input case_email" 
			id="customCheckbox__{{$key}}" type="checkbox"
			name="notification[{{$key}}][email]"  value="1">
			<label for="customCheckbox__{{$key}}"  class="custom-control-label"></label>
			@endif
		</div>
	</div>
	<!-- Email -->
	<!-- MObile -->

	<div class="col-2">
		<div class="custom-control custom-checkbox">
			@if($value->mobile == 1)
			<input class="custom-control-input case_mobile" type="checkbox" id="customCheckbox___{{$key}}" checked="" 
			name="notification[{{$key}}][mobile]"  value="1">
			<label for="customCheckbox___{{$key}}" class="custom-control-label"></label>
			@else
			<input class="custom-control-input case_mobile" type="checkbox" id="customCheckbox___{{$key}}" name="notification[{{$key}}][mobile]"  value="1">
			<label for="customCheckbox___{{$key}}" class="custom-control-label"></label>
			@endif
		</div>
	</div>
	<!-- MObile -->

	<!-- Sms -->

	<div class="col-2">

		<div class="custom-control custom-checkbox">
			@if($value->sms == 1)
			<input class="custom-control-input case_sms" type="checkbox" checked="" 
			id="customCheckbox____{{$key}}" name="notification[{{$key}}][sms]" value="1">
			<label for="customCheckbox____{{$key}}" class="custom-control-label"></label>
			@else
			<input class="custom-control-input case_sms" type="checkbox" 
			id="customCheckbox____{{$key}}" name="notification[{{$key}}][sms]" value="1">
			<label for="customCheckbox____{{$key}}" class="custom-control-label"></label>
			@endif
		</div>

	</div>
	<!-- Sms -->

</div>


@endforeach