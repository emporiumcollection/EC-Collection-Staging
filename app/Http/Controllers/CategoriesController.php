<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 


class CategoriesController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'categories';
	static $per_page	= '100';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Categories();
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'categories',
			'return'	=> self::returnUrl()
			
		);
		
	}

	public function getIndex( Request $request )
	{

		if($this->access['is_view'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');

		$sort = (!is_null($request->input('sort')) ? $request->input('sort') : 'category_order_num'); 
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
		$pagination->setPath('categories');
		
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

		$fetch_cat = \DB::table('tb_categories')->get();
		$parent_cat = array();
		if(!empty($fetch_cat))
		{
			foreach($fetch_cat as $cat)
			{
				$parent_cat[$cat->id] = $cat;
			}
		}
		
		$this->data['parent_categories'] = $parent_cat;
		// Render into template
		return view('categories.index',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_categories'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['forms']);
		
		$this->data['id'] = $id;
		$this->data['parent_categories'] = $this->fetchCategoryTree();
		return view('categories.form',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_categories'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['grid']);
		
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		return view('categories.view',$this->data);	
	}	

	function postSave( Request $request)
	{
		$uid = \Auth::user()->id;
		$id = $request->input('id');
		$rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data = $this->validatePost('tb_categories');
			
			$alias = \SiteHelpers::seoUrl(Input::get('category_name'));
			$exha = false;
			for($f=1;$exha!=true;$f++)
			{
				if($request->input('id') =='')
				{
					$check_alias = \DB::table('tb_categories')->where('category_alias', $alias)->count();
				}
				else
				{
					$check_alias = \DB::table('tb_categories')->where('category_alias', $alias)->where('id', '!=', $id)->count();
				}
				if ($check_alias>0)
				{
					$alias = $alias.'-'.$f;
				}
				else
				{
					$alias = $alias;
					$exha = true;
				}
			}
			if($request->input('id') =='')
			{
				$check_ordering = \DB::table('tb_categories')->orderBy('category_order_num', 'desc')->first();
				if(!empty($check_ordering)){
					$data['category_order_num'] = $check_ordering->category_order_num + 1;
				}
				else{
					$data['category_order_num'] = 1;
				}
			}
			$data['category_youtube_channel_url'] = Input::get('category_youtube_channel_url');
			$data['category_instagram_channel'] = Input::get('category_instagram_channel');
			$data['category_alias'] = $alias;
			$data['user_id'] = $uid;
			if($request->input('id') =='')
			{
				$data['created'] = date('Y-m-d h:i:s');
			}
			else
			{
				$data['updated'] = date('Y-m-d h:i:s');
			}
				
			$id = $this->model->insertRow($data , $request->input('id'));
			
			if(!is_null($request->input('apply')))
			{
				$return = 'categories/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'categories?return='.self::returnUrl();
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

			return Redirect::to('categories/update/'.$id)->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
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
			return Redirect::to('categories')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success'); 
	
		} else {
			return Redirect::to('categories')
        		->with('messagetext','No Item Deleted')->with('msgstatus','error');				
		}

	}

	function fetchCategoryTree($parent = 0, $spacing = '', $folder_tree_array = '') 
	{
	  if (!is_array($folder_tree_array))
		$folder_tree_array = array();
		$uid = \Auth::user()->id;
		$filter = " AND parent_category_id='".$parent."'";
		$params = array(
			'params'	=> $filter,
			'order'		=> 'asc'
		);
		// Get Query 
		$results = $this->model->getRows( $params );
		if ($results) {
		foreach($results['rows'] as $row) {
		  $folder_tree_array[] = array("id" => $row->id, "name" => $spacing . $row->category_name);
		  $folder_tree_array = $this->fetchCategoryTree($row->id, $spacing . '>>>', $folder_tree_array);
		}
	  }
	  return $folder_tree_array;
	}
	
	function enable_diable_category_option()
	{
		$uid = \Auth::user()->id;
		$items = Input::get('row_id');
		$filed_name = Input::get('filed_name');
		$action = Input::get('action');
		if($items!='')
		{
			$exist = \DB::table('tb_categories')->where('id', $items)->count();
			if($exist>0)
			{
				\DB::table('tb_categories')->where('id',$items)->update([$filed_name=>$action]);

				return "success";
			}
			else
			{
				return "error";
			}
		}
		else
		{
			return "error";
		}
	}
	
	function change_category_ordering( Request $request )
	{
		$uid = \Auth::user()->id;
		$filed_id = Input::get('fieldID');
		$action = Input::get('order_type');
		$ret_url = Input::get('curnurl');
		if($filed_id!='' && $filed_id>0)
		{
			$exist = \DB::table('tb_categories')->where('id', $filed_id)->first();
			if(!empty($exist))
			{
				if($action=='up')
				{
					$previous = \DB::table('tb_categories')->where('category_order_num', '<', $exist->category_order_num)->orderBy('category_order_num','desc')->first();
					if(!empty($previous))
					{
						$previous_order = $previous->category_order_num + 1;
						$update_ordering = \DB::table('tb_categories')->where('id',$previous->id)->update(['category_order_num'=>$previous_order]);
					}
					$new_ord_num = $exist->category_order_num - 1;
				}
				elseif($action=='down')
				{
					$next = \DB::table('tb_categories')->where('category_order_num', '>', $exist->category_order_num)->orderBy('category_order_num','asc')->first();
					if(!empty($next))
					{
						$next_order = $next->category_order_num - 1;
						$update_ordering = \DB::table('tb_categories')->where('id',$next->id)->update(['category_order_num'=>$next_order]);
					}
					
					$new_ord_num = $exist->category_order_num + 1;
				}
				
				$update_ordering = \DB::table('tb_categories')->where('id',$filed_id)->update(['category_order_num'=>$new_ord_num]);
				if($update_ordering)
				{
					return Redirect::to($ret_url)->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
				}
			}
			else
			{
				return Redirect::to($ret_url)->with('messagetext','No record found')->with('msgstatus','error');
			}
		}
		else
		{
			return Redirect::to($ret_url)->with('messagetext','No record found')->with('msgstatus','error');
		}
	}


}