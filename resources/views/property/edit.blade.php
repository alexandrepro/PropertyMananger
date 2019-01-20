@extends('layouts.site')

@section('content')

<div class="container">
	<div class="section"></div>
	<h3 align="center">Edit Property</h3>
	<div class="divider"></div>
	<div class="section"></div>
	<div>
		<form action="{{ route('property.update', $properties->id) }}" method="post">
			{{ csrf_field() }}
			<div>
				@include('property._form')
				<button class="btn grey">Update</button>
			</div>
		</form>
	</div>
</div>

@endsection