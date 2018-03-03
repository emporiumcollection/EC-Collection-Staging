<?php

namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Properties;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect,File;

class ImportdataController extends Controller {



	public function getResto(Request $request) {
		$data = Properties::paginate(1);
		dd($data);
	}

	public function getSpa(Request $request) {

	}

	public function getBar(Request $request) {

	}
}