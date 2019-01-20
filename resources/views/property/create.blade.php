@extends('layouts.site')

@section('content')

<div class="container">
	<div class="section"></div>
	<h3 align="center">New Property</h3>
	<div class="divider"></div>
	<div class="section"></div>
	<div>
		<form action="{{ route('property.store') }}" method="post">
			{{ csrf_field() }}
			<div class="col s12 m3">
				@include('property._form')
				<button class="btn grey">Create</button>
			</div>
		</form>
	</div>
</div>

@endsection