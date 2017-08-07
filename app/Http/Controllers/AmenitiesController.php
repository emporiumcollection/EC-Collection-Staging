<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Amenities;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 


class AmenitiesController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'amenities';
	static $per_page	= '100';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Amenities();
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'amenities',
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
		$pagination->setPath('amenities');
		
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
		
		$fetch_amen = \DB::table('tb_amenities')->get();
		$parent_amen = array();
		if(!empty($fetch_amen))
		{
			foreach($fetch_amen as $amen)
			{
				$parent_amen[$amen->id] = $amen;
			}
		}
		
		$this->data['parent_amenities'] = $parent_amen;
		// Render into template
		return view('amenities.index',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_amenities'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['forms']);
		
		$this->data['id'] = $id;
		$this->data['parent_amenity'] = $this->fetchAmentiesTree();
		return view('amenities.form',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_amenities'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['grid']);
		
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		return view('amenities.view',$this->data);	
	}	

	function postSave( Request $request)
	{
		
		$rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data = $this->validatePost('tb_amenities');
			
			if($request->input('id') =='')
			{
				$data['created'] = date('y-m-d h:i:s');
			}
			else
			{
				$data['updated'] = date('y-m-d h:i:s');
			}

			$slug = \SiteHelpers::seoUrl( trim($request->input('amenity_title')));
			$exha = false;
			for($f=1;$exha!=true;$f++)
			{
				$check_amty = \DB::table('tb_amenities')->where('amenity_slug', $slug)->count();
				if($check_amty==0)
				{
					$slug = $slug;
					$exha = true;
				}
				else{
					$slug = $slug.'-'.$f;
				}
			}
			$data['amenity_slug'] = $slug;
			$data['parent_amenity_id'] = $request->input('parent_amenity_id');
			$pdata['user_id'] = \Auth::user()->id;
			$id = $this->model->insertRow($data , $request->input('id'));
			
			if(!is_null($request->input('apply')))
			{
				$return = 'amenities/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'amenities?return='.self::returnUrl();
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

			return Redirect::to('amenities/update/'.$id)->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
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
			
			return Redirect::to(\URL::previous())
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success'); 
	
		} else {
			return Redirect::to(\URL::previous())
        		->with('messagetext','No Item Deleted')->with('msgstatus','error');				
		}

	}			

	function fetchAmentiesTree($parent = 0, $spacing = '', $folder_tree_array = '') 
	{
	  if (!is_array($folder_tree_array))
		$folder_tree_array = array();
		$uid = \Auth::user()->id;
		$filter = " AND amenity_status = '1' AND parent_amenity_id='".$parent."'";
		$params = array(
			'params'	=> $filter,
			'order'		=> 'asc'
		);
		// Get Query 
		$results = $this->model->getRows( $params );
		if ($results) {
		foreach($results['rows'] as $row) {
		  $folder_tree_array[] = array("id" => $row->id, "name" => $spacing . $row->amenity_title);
		  $folder_tree_array = $this->fetchAmentiesTree($row->id, $spacing . '>>>', $folder_tree_array);
		}
	  }
	  return $folder_tree_array;
	}
	
}