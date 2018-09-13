<?php 
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\controller;
use App\Models\Presentationslider;
use App\Models\Presentation;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use DB,Validator, Input, Redirect, CommonHelper, Mail;


class PresentationController extends Controller {



	public function __construct()
	{
		
		parent::__construct();
        if(!isset(\Auth::user()->id)){
            Redirect::to('/')->send();
        }
		$this->data['pageTitle'] = '';
		$this->data['data'] = CommonHelper::getInfo();
		$this->data['pageslider'] = "";
		$this->data['currency'] = \DB::table('tb_settings')->select('content')->where('key_value', 'default_currency')->first();
		
	}
  
	public function getIndex( Request $request )
	{
		$this->data['pageslider']="";

		$this->data['presentationPageDetails'] = \DB::table('tb_presentation_pages')->select('id', 'page_name', 'page_title','page_keyword','page_meta_description','page_description', 'page_image', 'page_slug', 'presentation_mode')->where('page_slug', $request->slug)->get();
		if(!$this->data['presentationPageDetails']){

			return Redirect::to('')
                                    ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
		}
			
		$this->data['presentatiomode']=(int)$this->data['presentationPageDetails'][0]->presentation_mode;

		$this->data['presentationslider'] = \DB::table('tb_presentation_sliders')->select( 'id','slider_title', 'slider_description','slider_sub_title','slider_sub_description','slider_img', 'slider_link', 'slider_video', 'slide_type')->where('presentation_page_id', $this->data['presentationPageDetails'][0]->id)->get();
//dd(	$this->data['presentationslider']);
		 return view('frontend.presentation.presentation_detail', $this->data);
	}	



	

}