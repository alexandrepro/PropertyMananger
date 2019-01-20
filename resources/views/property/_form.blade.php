@if(!empty($errors->first()))
	@php( 
		// Laravel Validation - if the form request validation return error it will be shown on $errors - app/Http/Requests/PropertyRequestValidation
		\Session::flash('message', ['msg'=>$errors->first(), 'class'=>'red white-text']) 
	)
@endif
<div class="input-field">
	<input type="text" name="address_line_1" id="address_line_1" value="{{ isset($properties->address_line_1) ? old('address_line_1', $properties->address_line_1) : old('address_line_1', '') }}" class="validate" required oninvalid="javascript: Materialize.toast('Fill the Address Line 1 field.', 4000, 'red');"></input>
	<label for="address_line_1">Address Line 1</label>
</div>
<div class="input-field">
	<input type="text" name="address_line_2" id="address_line_2" value="{{ isset($properties->address_line_2) ? old('address_line_2', $properties->address_line_2) : old('address_line_2', '') }}"></input>
	<label for="address_line_2">Address Line 2</label>
</div>
<div class="input-field">
	<select name="city_id" id="city_id" required oninvalid="javascript: Materialize.toast('Select a city.', 4000, 'red');">
		<option value="">All cities</option>
		@foreach($cities as $city)
			@if($action == "create")
				<option value="{{ $city->id }}" {{ old("city_id") == $city->id ? "selected" : "" }}>{{ $city->name }}</option>
			@else
				<option value="{{ $city->id }}" {{ isset($properties->city_id) && $properties->city_id == $city->id ? "selected" : "" }}>{{ $city->name }}</option>
			@endif
		@endforeach
	</select>
	<label>City</label>
</div>
<div class="input-field">
	<input type="text" name="postcode" id="postcode" value="{{ isset($properties->postcode) ? old('postcode', $properties->postcode) : old('postcode', '') }}" class="validate" required oninvalid="javascript: Materialize.toast('Fill the Postcode.', 4000, 'red');"></input>
	<label for="postcode">Postcode</label>
</div>