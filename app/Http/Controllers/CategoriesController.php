<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Http\Controllers\Frontend\DestinationController;
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
        $this->data['metatags'] = \DB::table('tb_category_metatags')->where('category_id', $id)->first();
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
            $data['category_instagram_tag'] = Input::get('category_instagram_tag');
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
			
            /** Start Meta tags **/
            $meta_data['category_id'] = $id;
            $meta_data['meta_title'] = $request->input('meta_title');
            $meta_data['meta_description'] = $request->input('meta_description');
            $meta_data['meta_keywords'] = $request->input('meta_keywords');
            $meta_data['canonical_link'] = $request->input('canonical_link');
            
            $meta_data['og_title'] = $request->input('og_title');
            $meta_data['og_description'] = $request->input('og_description');
            $meta_data['og_url'] = $request->input('og_url');
            
            $meta_data['og_type'] = $request->input('og_type');
            //$meta_data['og_image'] = $request->input('og_image');
            //$meta_data['og_image_width'] = $request->input('og_image_width');
            //$meta_data['og_image_height'] = $request->input('og_image_height');
            $meta_data['og_sitename'] = $request->input('og_sitename');
            $meta_data['og_locale'] = $request->input('og_locale');
            $meta_data['article_section'] = $request->input('article_section');
            $meta_data['article_tags'] = $request->input('article_tags');
            $meta_data['twitter_url'] = $request->input('twitter_url');
            $meta_data['twitter_title'] = $request->input('twitter_title');
            $meta_data['twitter_description'] = $request->input('twitter_description');
            $meta_data['twitter_image'] = $request->input('twitter_image');
            $meta_data['twitter_domain'] = $request->input('twitter_domain');
            $meta_data['twitter_card'] = $request->input('twitter_card');
            $meta_data['twitter_creator'] = $request->input('twitter_creator');
            $meta_data['twitter_site'] = $request->input('twitter_site');                       
            
            $meta_data['og_upload_type'] =  $request->input('og_image_type');
            if (!is_null($request->file('og_image_type_upload'))) {
                $og_image_type_file = $request->file('og_image_type_upload');
                $og_image_type_filename = $og_image_type_file->getClientOriginalName();
                $og_image_type_extension = $og_image_type_file->getClientOriginalExtension(); //if you need extension of the file
                $og_image_type_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $og_image_type_extension;
                $og_image_type_uploadSuccess = $og_image_type_file->move($destinationPath, $og_image_type_filename);
                if ($og_image_type_uploadSuccess) {
                    $meta_data['og_image'] = $og_image_type_filename;
                    $meta_data['og_image_width'] = $request->input('og_image_width');
                    $meta_data['og_image_height'] = $request->input('og_image_height');
                }
            }
            $meta_data['og_image_link'] =  $request->input('og_image_type_link');
            
            $meta_data['twitter_upload_type'] =  $request->input('twitter_image_type');
            if (!is_null($request->file('twitter_image_type_upload'))) {
                $twitter_image_type_file = $request->file('twitter_image_type_upload');
                $twitter_image_type_filename = $twitter_image_type_file->getClientOriginalName();
                $twitter_image_type_extension = $twitter_image_type_file->getClientOriginalExtension(); //if you need extension of the file
                $twitter_image_type_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $twitter_image_type_extension;
                $twitter_image_type_uploadSuccess = $twitter_image_type_file->move($destinationPath, $twitter_image_type_filename);
                if ($twitter_image_type_uploadSuccess) {
                    $meta_data['twitter_image'] = $twitter_image_type_filename;
                    //$meta_data['twitter_image_width'] = $request->input('twitter_image_width');
                    //$meta_data['twitter_image_height'] = $request->input('twitter_image_height');
                }
            }
            $meta_data['twitter_image_link'] =  $request->input('twitter_image_type_link');
            
            $check_meta = \DB::table('tb_category_metatags')->where('category_id', $id)->get();
            if(!empty($check_meta)){
                \DB::table('tb_category_metatags')->where('category_id', $id)->update($meta_data);
            }else{
                $meta_data['created'] = date('Y-m-d H:i:s');
                \DB::table('tb_category_metatags')->insertGetId($meta_data);    
            }
              
            /** End Meta tags **/
            
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

    
    function fetchDestinationTree($parent = 0, $folder_tree_array = '') 
	{
	  if (!is_array($folder_tree_array))
		$folder_tree_array = array();
		$uid = \Auth::user()->id;
		$filter = " AND parent_category_id='".$parent."' AND id != 8";
		$params = array(
			'params'	=> $filter,
			'order'		=> 'asc'
		);
		// Get Query 
		$results = $this->model->getRows( $params );
        //print_r($results); die;
		if ($results) {
    		foreach($results['rows'] as $row) {
    		  $parent = (new DestinationController())->fetchcategoryaliaspath($row->id); 
                //print_r($parent);
              $path = implode('/',array_reverse($parent));
    		  $folder_tree_array[] = array("id" => $row->id, "name" => $path . $row->category_name);
              
    		  $folder_tree_array = $this->fetchDestinationTree($row->id, $folder_tree_array);
    		}
        }
	  return $folder_tree_array;
	}
    
}