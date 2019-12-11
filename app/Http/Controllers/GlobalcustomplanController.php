<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Globalcustomplan;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 


class GlobalcustomplanController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'globalcustomplan';
	static $per_page	= '10';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Globalcustomplan();
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'globalcustomplan',
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
		$pagination->setPath('globalcustomplan');
		
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
		return view('globalcustomplan.index',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_global_custom_plan'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['forms']);
		
        $this->data['properties'] = \DB::table('tb_properties')->select('id', 'property_name')->where('property_status', 1)->get();
        
        $assigned_properties = array();
        if($id!=null){
            $obj_assigned_properties = \DB::table('tb_global_custom_plan_assined')->select('property_id')->where('global_plan_id', $id)->get();
            if(!empty($obj_assigned_properties)){
                foreach($obj_assigned_properties as $si){
                    $assigned_properties[] = $si->property_id;        
                }        
            }
        }
        $this->data['assigned_properties'] = $assigned_properties; 
        
        $this->data['categories'] = (new CategoriesController)->fetchCategoryTree();
        
        $assigned_categories = array();
        if($id!=null){
            $obj_assigned_categories = \DB::table('tb_global_custom_plan_assined_category')->select('category_id')->where('global_plan_id', $id)->get();
            if(!empty($obj_assigned_categories)){
                foreach($obj_assigned_categories as $si){
                    $assigned_categories[] = $si->category_id;        
                }        
            }
        }
        $this->data['assigned_categories'] = $assigned_categories;        
        //echo "<pre>";
        //print_r($this->data['categories']); die;
        
		$this->data['id'] = $id;
		return view('globalcustomplan.form',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_global_custom_plan'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['grid']);
		
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		return view('globalcustomplan.view',$this->data);	
	}	

	function postSave( Request $request)
	{
		
		$rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data = $this->validatePost('tb_globalcustomplan');
            $properties = $request->input('assignedtoproperty');
            $categories  =  $request->input('assignedtocategory');
			//print_r($properties); print_r($data); die;			
            $id = $this->model->insertRow($data , $request->input('id'));
			
            if(!empty($properties)){
                if($request->input('id')!='')
                {
                    \DB::table('tb_global_custom_plan_assined')->where('global_plan_id', $request->input('id'))->delete();                       
                    foreach($properties as $si){                            
                        $s_p = array(
                            'global_plan_id'=>$request->input('id'),
                            'property_id'=>$si,       
                        );
                        \DB::table('tb_global_custom_plan_assined')->insert($s_p);      
                    }                            
                }else{
                    foreach($properties as $si){                            
                        $s_p = array(
                            'global_plan_id'=>$id,
                            'property_id'=>$si,       
                        );
                        \DB::table('tb_global_custom_plan_assined')->insert($s_p);      
                    }   
                }            
            }
            
            if(!empty($categories)){
                if($request->input('id')!='')
                {
                    \DB::table('tb_global_custom_plan_assined_category')->where('global_plan_id', $request->input('id'))->delete();                       
                    foreach($categories as $si){                            
                        $s_p = array(
                            'global_plan_id'=>$request->input('id'),
                            'category_id'=>$si,       
                        );
                        \DB::table('tb_global_custom_plan_assined_category')->insert($s_p);      
                    }                            
                }else{
                    foreach($categories as $si){                            
                        $s_p = array(
                            'global_plan_id'=>$id,
                            'category_id'=>$si,       
                        );
                        \DB::table('tb_global_custom_plan_assined_category')->insert($s_p);      
                    }   
                }            
            }
            
			if(!is_null($request->input('apply')))
			{
				$return = 'globalcustomplan/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'globalcustomplan?return='.self::returnUrl();
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

			return Redirect::to('globalcustomplan/update/'.$id)->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
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
			return Redirect::to('globalcustomplan')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success'); 
	
		} else {
			return Redirect::to('globalcustomplan')
        		->with('messagetext','No Item Deleted')->with('msgstatus','error');				
		}

	}			


}