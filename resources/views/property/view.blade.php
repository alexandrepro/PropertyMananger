@extends('layouts.site')

@section('content')

<div class="container">
	<div class="section"></div>
	<h3 align="center">View Property</h3>
	<div class="divider"></div>
	<div class="section"></div>
	<div>
		<form>
			{{ csrf_field() }}
			<div>
				@include('property._form')
				<a href="javascript:history.back()" class="btn grey">Back</a>
			</div>
		</form>
	</div>
</div>

@endsection