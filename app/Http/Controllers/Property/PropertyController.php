<?php

namespace PropertyManager\Http\Controllers\Property;

//\Exception\GuzzleException;
//use GuzzleHttp\Client;

use Illuminate\Http\Request;
use PropertyManager\Http\Controllers\Controller;
//use GuzzleHttp;

// models
use PropertyManager\City;
use PropertyManager\Property;

// form validation
use PropertyManager\Http\Requests\PropertyRequestValidation;

class PropertyController extends Controller
{

	public function index()
	{
		$postcodes = Property::select('postcode')
			->orderBy('postcode');

		$cities = City::select('id', 'name')
			->orderBy('name');
			
		$properties = Property::select('properties.id', 'properties.address_line_1', 'properties.address_line_2', 'properties.city_id', 'cities.name', 'properties.postcode')
			->join('cities', 'cities.id', '=', 'properties.city_id')
			->get();
			
		return view('property.property', compact('postcodes', 'cities', 'properties'));
	}
	
	public function create()
	{
		$action = "create";
		$cities = City::orderBy('cities.name')
			->get();

		return view('property.create', compact('action', 'cities'));
	}
	
	public function store(PropertyRequestValidation $request)
	{
		$data = $request->all();
		
		$property = new Property();

		$property->address_line_1 = $data['address_line_1'];
		$property->address_line_2 = $data['address_line_2'];
		$property->city_id = $data['city_id'];
		$property->postcode = $data['postcode'];
		$property->save();
		
		\Session::flash('message',['msg'=>'Property created successfully.','class'=>'green white-text']);
		
		return redirect()->route('property.home');
	}
	
	public function update(PropertyRequestValidation $request, $PropertyId)
	{
		$property = Property::find($PropertyId);

		$data = $request->all();
		
		$property->address_line_1 = $data['address_line_1'];
		$property->address_line_2 = $data['address_line_2'];
		$property->city_id = $data['city_id'];
		$property->postcode = $data['postcode'];
		$property->update();
		
		\Session::flash('message',['msg'=>'Property updated successfully.','class'=>'green white-text']);
		
		return redirect()->route('property.home');
	}
	
	public function edit($propertyId)
	{
		$action = "edit";
		
		$properties = Property::where('id', '=', $propertyId)->first();
		
		$cities = City::orderBy('cities.name')
			->get();

		return view('property.edit', compact('action', 'properties', 'cities'));
	}
	
	public function search(Request $request)
	{
		$filter = $request->all();
		
		if($filter['city_id'] == '') {
			$filterCity = [
				['cities.id', '<>', null]
			];
		} else {
			$filterCity = [
				['cities.id', '=', $filter['city_id']]
			];
		}
		
		if($filter['postcode'] == '') {
			$filterPostcode = [
				['postcode', '<>', null]
			];
		} else {
			$filterPostcode = [
				['postcode', '=', $filter['postcode']]
			];
		}
		
		$postcodes = Property::select('postcode')
			->where($filterPostcode)
			->orderBy('postcode')
			->paginate(10);

		$cities = City::select('id', 'name')
			->where($filterCity)
			->orderBy('name','desc')
			->paginate(10);
			
		$properties = Property::select('properties.id', 'properties.address_line_1', 'properties.address_line_2', 'cities.name', 'properties.postcode')
			->join('cities', 'cities.id', '=', 'properties.city_id')
			->get();

		return view('property.property', compact('filter', 'postcodes', 'cities', 'properties'));
	}

	public function delete($propertyId)
	{
		$property = Property::find($propertyId);
		$property->delete();

		\Session::flash('message',['msg'=>'Property deleted successfully.','class'=>'green white-text']);

		return redirect()->route('property.home');
	}

	public function getProperties()
	{
		$properties = Property::select('properties.id', 'properties.address_line_1', 'properties.address_line_2', 'properties.city_id', 'cities.name AS city_name', 'properties.postcode')
			->join('cities', 'cities.id', '=', 'properties.city_id')
			->get();

/*
		$client = new Client(); // GuzzleHttp\Client

		foreach($properties as $property){
			$uri = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$property['address_line_1'];
			$result = (string)$client->post($uri, ['form_params' => ['key'=>'AIzaSyAhZvBzhWt0IimiGTXC3UjbvMdkTAx6zvs']])->getBody();
			$json =json_decode($result);
			$property->latitude = $json->results[0]->geometry->location->lat;
			$property->longitude = $json->results[0]->geometry->location->lng;
		}
*/
		return $properties;
	}

	public function getPropertiesById($propertyId)
	{
		$properties = Property::select('properties.id', 'properties.address_line_1', 'properties.address_line_2', 'properties.city_id', 'cities.name AS city_name', 'properties.postcode')
			->join('cities', 'cities.id', '=', 'properties.city_id')
			->where('properties.id', '=', $propertyId)
			->get();

		return $properties;
	}

	public function putProperties(Request $request)
	{
		$data = $request->all();
		
		$property = new Property();

		$property->address_line_1 = $data['address_line_1'];

		$property->save();

		return response()->json($property, 201);
	}
}