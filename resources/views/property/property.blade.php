@extends('layouts.site')

@section('content')

<div class="container">
	<div class="section"></div>
	<h3 align="center">Properties</h3>
	<div class="divider"></div>
	<div class="section"></div>
	@include('layouts._property._table_property')
	@include('layouts._property._filter_property')
</div>

@endsection