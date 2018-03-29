<?php 
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use DB, Input, Redirect;


class RestaurantFrontController extends Controller {



	public function __construct()
	{
		parent::__construct();
		
	}

	public function propertyRestrurant( Request $request )
	{
		return view('frontend.themes.emporium.properties.resto', $this->data);
	}


}