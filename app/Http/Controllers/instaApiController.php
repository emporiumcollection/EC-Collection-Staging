<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 
use File;
use DB, Response;
use App\User;
use App\Http\Controllers\ContainerController; 

class instaApiController extends Controller {

	protected $data = array();	
	
	public function __construct()
	{
		
	}

	public function runInsta( Request $request)
	{
		include(public_path() . '/sximo/instajs/instashow/api/index.php');
	}

}