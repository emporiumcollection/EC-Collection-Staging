<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Tagmanager;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 


class TagmanagerController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'tagmanager';
	static $per_page	= '10';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Tagmanager();
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'tagmanager',
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
		$pagination->setPath('tagmanager');
		
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
		return view('tagmanager.index',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_tags_manager'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['forms']);
		
		$this->data['id'] = $id;
		$this->data['parent_tags'] = $this->fetchTagTree();
		return view('tagmanager.form',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_tags_manager'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['grid']);
		
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		return view('tagmanager.view',$this->data);	
	}	

	function postSave( Request $request)
	{	
		$rules = $this->validateForm();
        /*if($request->input('id')==''){
            $rules['tag_title'] = 'required';
        }else{
            $rules['tag_title_u'] = 'required'; 
        }*/
        $rules['tag_status'] = 'required'; 
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data = $this->validatePost('tb_tagmanager');
			
            $tag_title = $request->input('tag_title');
            $tag_status = $request->input('tag_status');
            $arr_title = array();
            if($tag_title != ''){
                $arr_title = explode(',', $tag_title);
            }
            //print_r($request->input('id'));
			if($request->input('id')=='')
			{                
                if(!empty($arr_title)){
                    $tag_array = array();
                    foreach($arr_title as $ttl){
                        $chk_ttl = \DB::table('tb_tags_manager')->where('tag_title', $ttl)->first();
                        if(empty($chk_ttl)){
                            $tag_array[] = array('tag_title'=>$ttl, 'tag_status'=>$tag_status, 'created'=>date('y-m-d h:i:s'));
                        }            
                    } 
                    if(!empty($tag_array)){ \DB::table('tb_tags_manager')->insert($tag_array); }       
                }                
				//$data['created'] = date('y-m-d h:i:s');
			}
			else
			{    //print_r("fff"); die;
			    $data['tag_title'] = $request->input('tag_title_u'); 
				$data['updated'] = date('y-m-d h:i:s');
                //print_r($data); die;
                \DB::table('tb_tags_manager')->where('id', $request->input('id'))->update($data);
			} //die;
            //print_r($data); die;
			//$data['parent_tag_id'] = $request->input('parent_tag_id');
			//$id = $this->model->insertRow($data , $request->input('id'));
			
			if(!is_null($request->input('apply')))
			{
				$return = 'tagmanager?return='.self::returnUrl();//$return = 'tagmanager/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'tagmanager?return='.self::returnUrl();
			}
            
			// Insert logs into database
			if($request->input('id') =='')
			{
				\SiteHelpers::auditTrail( $request , 'New Data Has been Inserted !');
			} else {
				\SiteHelpers::auditTrail($request ,'Data Has been Updated !');
			}

			return Redirect::to($return)->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
			
		} else {

			return Redirect::to('tagmanager/update/')->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
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
			return Redirect::to('tagmanager')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success'); 
	
		} else {
			return Redirect::to('tagmanager')
        		->with('messagetext','No Item Deleted')->with('msgstatus','error');				
		}

	}

	function fetchtagTree($parent = 0, $spacing = '', $folder_tree_array = '') 
	{
	  if (!is_array($folder_tree_array))
		$folder_tree_array = array();
		$uid = \Auth::user()->id;
		$filter = " AND parent_tag_id='".$parent."' AND tag_status='1'";
		$params = array(
			'params'	=> $filter,
			'order'		=> 'asc'
		);
		// Get Query 
		$results = $this->model->getRows( $params );
		if ($results) {
		foreach($results['rows'] as $row) {
		  $folder_tree_array[] = array("id" => $row->id, "name" => $spacing . $row->tag_title);
		  $folder_tree_array = $this->fetchtagTree($row->id, $spacing . '>>>', $folder_tree_array);
		}
	  }
	  return $folder_tree_array;
	}
    
    function addtagtitle(Request $request){
        //$mid = $request->input('mID');  
        $data['tag_title'] = $request->input('menuTitle');
        $data['tag_status'] = 1;
        $data['created'] = date('y-m-d h:i:s');
        
        $id = \DB::table('tb_tags_manager')->insertGetId($data);
        if($id > 0){
            $res['status']='success';
            $res['newtag'] = \DB::table('tb_tags_manager')->where('id', $id)->first();    
        }else{
            $res['status']='error'; 
        }
        /*$arr_title = array();
        if($tag_title != ''){
            $arr_title = explode(',', $tag_title);
        }
        if(!empty($arr_title)){
            $tag_array = array();
            foreach($arr_title as $ttl){
                $chk_ttl = \DB::table('tb_tags_manager')->where('tag_title', $ttl)->first();
                if(empty($chk_ttl)){
                    $tag_array[] = array('tag_title'=>$ttl, 'tag_status'=>$tag_status, 'created'=>date('y-m-d h:i:s'));
                }            
            } 
            if(!empty($tag_array)){ \DB::table('tb_tags_manager')->insert($tag_array); }       
        }                
		//$data['created'] = date('y-m-d h:i:s');
		*/    
        echo json_encode($res);
    }

}