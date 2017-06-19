<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Designerdetails;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 


class DesignerdetailsController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'designerdetails';
	static $per_page	= '10';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Designerdetails();
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'designerdetails',
			'return'	=> self::returnUrl()
			
		);
		
	}

	public function getIndex( Request $request )
	{

		if($this->access['is_view'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');

		$this->data['assigned_designers'] = \DB::table('tb_container_designers')->join('tb_designers', 'tb_designers.id', '=', 'tb_container_designers.designer_id')->select('tb_container_designers.*', 'tb_designers.designer_name', 'tb_designers.designer_description')->where('tb_container_designers.container_type', 'folder')->where('tb_designers.designer_status', 1)->groupBy('tb_container_designers.designer_id')->get();
		
		$this->data['access'] = $this->access;
		
		return view('designerdetails.index',$this->data);
	}	



	function getUpdate(Request $request, $id = null)
	{
	
		if($id =='')
		{
			if($this->access['is_add'] ==0 )
			return Redirect::to('dashboard')->with('messagetext',\Lang::get('core.note_restric'))->with('msgstatus','error');
		}	
		
		if($id !='')
		{
			if($this->access['is_edit'] ==0 )
			return Redirect::to('dashboard')->with('messagetext',\Lang::get('core.note_restric'))->with('msgstatus','error');
		}				
				
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		
		$designers_product = \DB::table('tb_container_designers')->join('tb_container', 'tb_container.id', '=', 'tb_container_designers.container_id')->select('tb_container.*')->where('tb_container_designers.container_type', 'folder')->where('tb_container_designers.designer_id', $id)->get();
		
		$this->data['assigned_products'] = array();
		foreach($designers_product as $product)
		{
			if($product->cover_img=="")
			{
				$default_front_design = \DB::table('tb_settings')->where('key_value', 'frontend_design')->first();
				if(!empty($default_front_design) && $default_front_design->content=="masonry")
				{
					$product->cover_img = $product->temp_cover_img_masonry;
				}
				elseif(!empty($default_front_design) && $default_front_design->content=="grid")
				{
					$product->cover_img = $product->temp_cover_img;
				}
				else{
					$product->cover_img = $product->cover_img;
				}
			}
			else
			{
				$product->cover_img = $product->cover_img;
			}
			
			$this->data['assigned_products'][] = $product;
		}		
		
		return view('designerdetails.form',$this->data);
	}	

	public function getShow( $id = null)
	{
	
		if($this->access['is_detail'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
					
		
		$this->data['access']		= $this->access;
		return view('designerdetails.view',$this->data);	
	}	

	function postSave( Request $request)
	{
		$uid = \Auth::user()->id;
		$id = $request->input('id');
		if($id!='' && $id>0)
		{
			\DB::table('tb_container_designers')->where('designer_id', $id)->delete();
			$comsep = $request->input('compont');
			foreach($comsep as $sepr)
			{
				$ftdata['user_id'] = $uid;
				$ftdata['designer_id'] = $id ;
				$ftdata['container_id'] = $sepr;
				$ftdata['container_type'] = 'folder';
				$ftdata['created'] = date('Y-m-d h:i:s');
				\DB::table('tb_container_designers')->insertGetId($ftdata);
			}
			
			if(!is_null($request->input('apply')))
			{
				$return = 'designerdetails/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'designerdetails?return='.self::returnUrl();
			}

			// Insert logs into database
			\SiteHelpers::auditTrail($request ,'Data with Desinger ID '.$id.' Has been Updated !');
			
			return Redirect::to($return)->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
		}
		else
		{
			return Redirect::to('designerdetails')->with('messagetext', 'Designer Not Found')->with('msgstatus','error');
		}
	}	

	public function postDelete( Request $request)
	{
		
		if($this->access['is_remove'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
		
		// delete multipe rows 
		if(count($request->input('ids')) >=1)
		{
			\DB::table('tb_container_designers')->whereIn('designer_id', $request->input('ids'))->delete();
			
			\SiteHelpers::auditTrail( $request , "ID : ".implode(",",$request->input('ids'))."  , Has Been Removed Successfull");
			// redirect
			return Redirect::to('designerdetails')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success'); 
	
		} else {
			return Redirect::to('designerdetails')
        		->with('messagetext','No Item Deleted')->with('msgstatus','error');				
		}
	}			


}