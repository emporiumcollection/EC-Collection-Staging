<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Properties;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect,File;

class ImportdataController extends Controller { 



	public function getResto(Request $request) {

		$data = Properties::paginate(5);
		$count = 1; 
		foreach($data as $val){
			echo $val->property_name;
			echo '<br>';
			$count++;
		}
		if($count>5){
			header("refresh: 3;");
		}
	}

	public function getSpa(Request $request) {

	}

	public function getBar(Request $request) {

	}
}