<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Advertisements;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect , File; 


class AdvertisementsController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'advertisements';
	static $per_page	= '10';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Advertisements();
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'advertisements',
			'return'	=> self::returnUrl()
			
		);
		
	}

	public function getIndex( Request $request )
	{

		if($this->access['is_view'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');

		$sort = (!is_null($request->input('sort')) ? $request->input('sort') : 'id'); 
		$order = (!is_null($request->input('order')) ? $request->input('order') : 'asc');
		// End Filter sort and order for query 
		// Filter Search for query		
		$filter = (!is_null($request->input('search')) ? $this->buildSearch() : '');

		
		$page = $request->input('page', 1);
		$params = array(
			'page'		=> $page ,
			'limit'		=> (!is_null($request->input('rows')) ? filter_var($request->input('rows'),FILTER_VALIDATE_INT) : static::$per_page ) ,
			'sort'		=> $sort ,
			'order'		=> $order,
			'params'	=> $filter,
			'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		// Get Query 
		$results = $this->model->getRows( $params );		
		
		// Build pagination setting
		$page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;	
		$pagination = new Paginator($results['rows'], $results['total'], $params['limit']);	
		$pagination->setPath('advertisements');
		
		$this->data['rowData']		= $results['rows'];
		// Build Pagination 
		$this->data['pagination']	= $pagination;
		// Build pager number and append current param GET
		$this->data['pager'] 		= $this->injectPaginate();	
		// Row grid Number 
		$this->data['i']			= ($page * $params['limit'])- $params['limit']; 
		// Grid Configuration 
		$this->data['tableGrid'] 	= $this->info['config']['grid'];
		$this->data['tableForm'] 	= $this->info['config']['forms'];
		$this->data['colspan'] 		= \SiteHelpers::viewColSpan($this->info['config']['grid']);		
		// Group users permission
		$this->data['access']		= $this->access;
		// Detail from master if any
		
		// Master detail link if any 
		$this->data['subgrid']	= (isset($this->info['config']['subgrid']) ? $this->info['config']['subgrid'] : array()); 
		// Render into template
		return view('advertisements.index',$this->data);
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
				
		$row = $this->model->find($id);
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('tb_advertisement'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['forms']);
		
		$this->data['id'] = $id;
		$this->data['membershipplans'] = \DB::table('tb_membership')->where('status', 1)->get();
		
		return view('advertisements.form',$this->data);
	}	

	public function getShow( $id = null)
	{
	
		if($this->access['is_detail'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
					
		$row = $this->model->getRow($id);
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('tb_advertisement'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['grid']);
		
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		return view('advertisements.view',$this->data);	
	}	

	function postSave( Request $request)
	{
		
		$rules = $this->validateForm();
		$rules['adv_link'] = 'required';
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data = $this->validatePost('tb_advertisements');
			if($request->input('id') =='')
			{
				$data['created'] = date('y-m-d h:i:s');
			}
			else
			{
				$data['updated'] = date('y-m-d h:i:s');
			}
			$data['adv_expire'] = Date('Y-m-d', strtotime("+".$request->input('ads_duration')." months"));
			$data['ads_cat_id'] = ($request->input('ads_cat_id')!='') ? $request->input('ads_cat_id') : 'Hotel';
			$data['ads_duration'] = $request->input('ads_duration');
			$data['ads_plan'] = $request->input('ads_plan');
			$id = $this->model->insertRow($data , $request->input('id'));
			
			if($request->input('adv_type')=="slider")
			{
				$slidData['user_id'] = $request->input('user_id');
				$slidData['slider_link'] = $request->input('adv_link');
				$slidData['slider_title'] = $request->input('adv_title');
				$slidData['slider_description'] = $request->input('adv_desc');
				$slidData['slider_category'] = ($request->input('ads_cat_id')!='') ? $request->input('ads_cat_id') : 'Hotel';
				if(!is_null(Input::file('adv_img')))
				{
					$dirPath = public_path().'/uploads/users/advertisement/';
					$destinationPath_slider = public_path().'/uploads/slider_images/';
					$file = $request->file('adv_img');
					$filename_slider = $file->getClientOriginalName();
					$extension_slider = $file->getClientOriginalExtension(); //if you need extension of the file
					$newfilename_slider = rand(00000000,99999999).'-'.rand(00000000,99999999).'.'.$extension_slider;
					$uploadSuccess_slider = File::copy($dirPath.$data['adv_img'], $destinationPath_slider.$newfilename_slider);	
					
					if( $uploadSuccess_slider ) {
						$slidData['slider_img'] = $newfilename_slider;
					}
				}
				if($request->input('id') !='')
				{
					$slidData['updated'] = date('y-m-d h:i:s');
					\DB::table('tb_sliders')->where('advert_id', $request->input('id'))->update($slidData);
				}
				else
				{
					$slidData['created'] = date('y-m-d h:i:s');
					$slidData['advert_id'] = $id;
					\DB::table('tb_sliders')->insertGetId($slidData);
				}
			}
			
			if(!is_null($request->input('apply')))
			{
				$return = 'advertisements/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'advertisements?return='.self::returnUrl();
			}

			// Insert logs into database
			if($request->input('id') =='')
			{
				\SiteHelpers::auditTrail( $request , 'New Data with ID '.$id.' Has been Inserted !');
			} else {
				\SiteHelpers::auditTrail($request ,'Data with ID '.$id.' Has been Updated !');
			}

			return Redirect::to($return)->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
			
		} else {

			return Redirect::to('advertisements/update/'.$request->input('id'))->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
			->withErrors($validator)->withInput();
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
			$this->model->destroy($request->input('ids'));
			
			\SiteHelpers::auditTrail( $request , "ID : ".implode(",",$request->input('ids'))."  , Has Been Removed Successfull");
			// redirect
			return Redirect::to('advertisements')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success'); 
	
		} else {
			return Redirect::to('advertisements')
        		->with('messagetext','No Item Deleted')->with('msgstatus','error');				
		}

	}			


}