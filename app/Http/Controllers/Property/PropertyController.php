<?php

namespace PropertyManager\Http\Controllers\Property;

use Illuminate\Http\Request;
use PropertyManager\Http\Controllers\Controller;

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

		$properties = Property::select('properties.id', 'properties.address_line_1', 'properties.address_line_2', 'properties.city_id', 'cities.name AS city_name', 'properties.postcode')
			->join('cities', 'cities.id', '=', 'properties.city_id')
			->get();
		
		$coordinates = [];

		foreach ($properties as $property) {
			$coordinates = PropertyController::googleGeocodeApi($property->address_line_1);

			$property->lat = $coordinates['lat'];
			$property->lng = $coordinates['lng'];
		}

		return view('property.property', compact('postcodes', 'properties'));
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
	
	public function view($propertyId)
	{

		$action = "view";

		$properties = Property::where('id', '=', $propertyId)->first();
		
		$coordinates = [];
		$coordinates = PropertyController::googleGeocodeApi($properties->address_line_1);

		$properties->lat = $coordinates['lat'];
		$properties->lng = $coordinates['lng'];

		$cities = City::orderBy('cities.name')
			->get();
		
		return view('property.view', compact('action', 'properties', 'cities'));
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
			
		$properties = Property::select('properties.id', 'properties.address_line_1', 'properties.address_line_2', 'cities.name AS city_name', 'properties.postcode')
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

	public function postProperties(Request $request)
	{
		$property = Property::create($request->all());

		return response()->json($property, 201);
	}

	// Through an address, get the latitude and longitude
	public static function googleGeocodeApi($address){
	
		// First: Generate and a Google Maps API Key.
		// Second: Open .env file and insert the generated key on GOOGLE_MAPS_KEY instance.
		// Third: You have to access the https://console.developers.google.com, click on "Enable APIS and Services", select maps on left menu, select Geocoding API and click "Activate".
		
		// Builds the URL and request to the Google Maps API
		$url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&key='.env("GOOGLE_MAPS_KEY");

		// Creates a Guzzle Client to make the Google Maps request.
		$client = new \GuzzleHttp\Client();

		// Send a GET request to the Google Maps API and get the body of the response.
		$geocodeResponse = $client->get($url)->getBody();

		$geocodeData = json_decode($geocodeResponse);

		$coordinates['lat'] = null;
		$coordinates['lng'] = null;

		if(!empty($geocodeData)
				&& $geocodeData->status != 'ZERO_RESULTS' 
				&& isset( $geocodeData->results ) 
				&& isset( $geocodeData->results[0] ) ){
			$coordinates['lat'] = $geocodeData->results[0]->geometry->location->lat;
			$coordinates['lng'] = $geocodeData->results[0]->geometry->location->lng;
		}

		return $coordinates;

	}

}