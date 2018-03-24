<?php 
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use DB,Validator, Input, Redirect, CommonHelper, Mail;


class PresentationController extends Controller {



	public function __construct()
	{
		
		parent::__construct();
		$this->data['pageTitle'] = '';
		$this->data['data'] = CommonHelper::getInfo();
		$this->data['pageslider'] = \DB::table('tb_pages_sliders')->select( 'slider_title', 'slider_description', 'slider_img', 'slider_link', 'slider_video', 'slide_type')->where('slider_page_id', 107)->get();
		$this->data['currency'] = \DB::table('tb_settings')->select('content')->where('key_value', 'default_currency')->first();
		
	}

	public function getIndex( Request $request )
	{
		$this->data['pageslider']="";
		$this->data['presentatiomode']=false;
		 return view('frontend.presentation.presentation_detail', $this->data);
	}	



	

}