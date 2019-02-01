<table id="datatableobject" class="mdl-data-table striped highlight responsive-table" style="width:100%">
	<thead>
		<tr>
			<th>Address Line 1</th>
			<th>Address Line 2</th>
			<th>City</th>
			<th>Postcode</th>
			<th>Latitude</th>
			<th>Longitude</th>
			<th>&nbsp</th>
			<th>&nbsp</th>
			<th>&nbsp</th>
		</tr>
	</thead>
	<tbody>
		@foreach($properties as $property)
		<tr>
			<td>{{ $property->address_line_1 }}</td>
			<td>{{ $property->address_line_2 }}</td>
			<td>{{ $property->city_name }}</td>
			<td>{{ $property->postcode }}</td>
			<td>{{ $property->lat }}</td>
			<td>{{ $property->lng }}</td>
			<td><a class="btn blue" href="{{ route('property.view', $property->id) }}">View</a></td>
			<td><a class="btn orange" href="{{ route('property.edit', $property->id) }}">Edit</a></td>
			<td><a class="btn red" href="{{ route('property.delete', $property->id) }}">Delete</a></td>
		</tr>
		@endforeach
	</tbody>
</table>

