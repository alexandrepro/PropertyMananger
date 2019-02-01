<?php

namespace PropertyManager;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
	/**
	* Get the city record associated with the property.
	*/
	public function city()
	{
		return $this->hasOne('PropertyManager\City');
	}
}
