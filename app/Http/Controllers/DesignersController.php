<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Designers;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 


class DesignersController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'designers';
	static $per_page	= '10';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Designers();
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'designers',
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
		$pagination->setPath('designers');
		
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
		return view('designers.index',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_designers'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['forms']);
		
        $this->data['creatives'] =  \DB::table('tb_creatives')->where('status', '1')->get();
        
		$this->data['id'] = $id;
		return view('designers.form',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_designers'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['grid']);
		
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		return view('designers.view',$this->data);	
	}	

	function postSave( Request $request)
	{
		$uid = \Auth::user()->id;
		$rules = $this->validateForm();
		$rules['featured_image'] = 'mimes:jpg,png,jpeg';
		$rules['designer_image'] = 'mimes:jpg,png,jpeg';
		$rules['designer_image2'] = 'mimes:jpg,png,jpeg';
		$rules['designer_image3'] = 'mimes:jpg,png,jpeg';
		$rules['designer_image4'] = 'mimes:jpg,png,jpeg';
		
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			
			if(!is_null($request->file('featured_image')))
			{
				$featuredfileover = $_FILES["featured_image"]['tmp_name'];
				list($width, $height) = getimagesize($featuredfileover);

				if($width > "632" || $height > "464") {
					return Redirect::to('designers/update/'.$request->input('id'))->with('messagetext','bitte beachten die Bilder soll 632 by 464 haben')->with('msgstatus','error')->withErrors($validator)->withInput();
				}
			}
			
			$data = $this->validatePost('tb_designers');
			if($request->input('id') =='')
			{
				$data['created'] = date('y-m-d h:i:s');
			}
			else
			{
				$data['updated'] = date('y-m-d h:i:s');
			}
			$data['user_id'] = $uid;
			
            
            if(!is_null($request->file('image1')))
			{
				$image1 = $request->file('image1'); 
				$destinationPath = './uploads/designer_images/';
				$filename_image1 = $image1->getClientOriginalName();
				$extension_image1 = $image1->getClientOriginalExtension(); //if you need extension of the file
				$newfilenameimage1 = rand(1111111111, 9999999999).'-'.rand(11111111, 99999999).'.'.$extension_image1;
				$uploadSuccessimage1 = $image1->move($destinationPath, $newfilenameimage1);				 
				if( $uploadSuccessimage1 ) {
					$data['image1'] = $newfilenameimage1; 
				}
			}
            
            if(!is_null($request->file('image2')))
			{
				$image2 = $request->file('image2'); 
				$destinationPath = './uploads/designer_images/';
				$filename_image2 = $image2->getClientOriginalName();
				$extension_image2 = $image2->getClientOriginalExtension(); //if you need extension of the file
				$newfilenameimage2 = rand(1111111111, 9999999999).'-'.rand(11111111, 99999999).'.'.$extension_image2;
				$uploadSuccessimage2 = $image2->move($destinationPath, $newfilenameimage2);				 
				if( $uploadSuccessimage2 ) {
					$data['image2'] = $newfilenameimage2; 
				}
			}
            
            if(!is_null($request->file('image3')))
			{
				$image3 = $request->file('image3'); 
				$destinationPath = './uploads/designer_images/';
				$filename_image3 = $image3->getClientOriginalName();
				$extension_image3 = $image3->getClientOriginalExtension(); //if you need extension of the file
				$newfilenameimage3 = rand(1111111111, 9999999999).'-'.rand(11111111, 99999999).'.'.$extension_image3;
				$uploadSuccessimage3 = $image3->move($destinationPath, $newfilenameimage3);				 
				if( $uploadSuccessimage3 ) {
					$data['image3'] = $newfilenameimage3; 
				}
			}
            
			if(!is_null($request->file('featured_image')))
			{
				$featured_image = $request->file('featured_image'); 
				$destinationPath = './uploads/designer_images/';
				$filename = $featured_image->getClientOriginalName();
				$extension = $featured_image->getClientOriginalExtension(); //if you need extension of the file
				$newfilenamefeature = rand(1111111111, 9999999999).'-'.rand(11111111, 99999999).'.'.$extension;
				$uploadSuccess = $featured_image->move($destinationPath, $newfilenamefeature);				 
				if( $uploadSuccess ) {
					$data['featured_image'] = $newfilenamefeature; 
				}
			}
			
			if(!is_null($request->file('designer_image2')))
			{
				$designer_image2 = $request->file('designer_image2'); 
				$destinationPath = './uploads/designer_images/';
				$filename = $designer_image2->getClientOriginalName();
				$extension = $designer_image2->getClientOriginalExtension(); //if you need extension of the file
				$newfilename2 = rand(1111111111, 9999999999).'-'.rand(11111111, 99999999).'.'.$extension;
				$uploadSuccess = $designer_image2->move($destinationPath, $newfilename2);				 
				if( $uploadSuccess ) {
					$data['designer_image2'] = $newfilename2; 
				}
			}
			
			if(!is_null($request->file('designer_image3')))
			{
				$designer_image3 = $request->file('designer_image3'); 
				$destinationPath = './uploads/designer_images/';
				$filename = $designer_image3->getClientOriginalName();
				$extension = $designer_image3->getClientOriginalExtension(); //if you need extension of the file
				$newfilename3 = rand(1111111111, 9999999999).'-'.rand(11111111, 99999999).'.'.$extension;
				$uploadSuccess = $designer_image3->move($destinationPath, $newfilename3);				 
				if( $uploadSuccess ) {
					$data['designer_image3'] = $newfilename3; 
				}
			}
			
			if(!is_null($request->file('designer_image4')))
			{
				$designer_image4 = $request->file('designer_image4');
				$destinationPath = './uploads/designer_images/';
				$filename = $designer_image4->getClientOriginalName();
				$extension = $designer_image4->getClientOriginalExtension(); //if you need extension of the file
				$newfilename4 = rand(1111111111, 9999999999).'-'.rand(11111111, 99999999).'.'.$extension;
				$uploadSuccess = $designer_image4->move($destinationPath, $newfilename4);				 
				if( $uploadSuccess ) {
					$data['designer_image4'] = $newfilename4;
				}
			}
			
			if(!is_null($request->file('designer_video')))
			{
				$designer_video = $request->file('designer_video');
				$destinationPath = './uploads/designer_images/';
				$filename = $designer_video->getClientOriginalName();
				$extension = $designer_video->getClientOriginalExtension(); //if you need extension of the file
				$videofilename = rand(1111111111, 9999999999).'-'.rand(11111111, 99999999).'.'.$extension;
				$uploadSuccess = $designer_video->move($destinationPath, $videofilename);				 
				if( $uploadSuccess ) {
					$data['designer_video'] = $videofilename;
				}
			}
			
            $data['creative_id'] = $request->input('creatives');
            $data['image1_hover'] = $request->input('image1_hover');
            $data['image1_hover_eng'] = $request->input('image1_hover_eng');
            $data['image2_description'] = $request->input('image2_description');
            $data['image2_description_eng'] = $request->input('image2_description_eng');
            
			$data['designer_url'] = $request->input('designer_url');
			$data['designer_num'] = $request->input('designer_num');
			$data['designer_name_eng'] = $request->input('designer_name_eng');
			$data['designer_description_eng'] = $request->input('designer_description_eng');
			$data['designer_intro_text'] = $request->input('designer_intro_text');
			$data['designer_intro_text_eng'] = $request->input('designer_intro_text_eng');
			
			$id = $this->model->insertRow($data , $request->input('id'));
			
			if(!is_null($request->input('apply')))
			{
				$return = 'designers/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'designers?return='.self::returnUrl();
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

			return Redirect::to('designers/update/'.$request->input('id'))->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
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
			return Redirect::to('designers')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success'); 
	
		} else {
			return Redirect::to('designers')
        		->with('messagetext','No Item Deleted')->with('msgstatus','error');				
		}

	}			


}