<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Customplanitems;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 


class CustomplanitemsController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'customplanitems';
	static $per_page	= '10';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Customplanitems();
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'customplanitems',
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
		$pagination->setPath('customplanitems');
		
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
		return view('customplanitems.index',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_custom_plan_items'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['forms']);
		
		$this->data['id'] = $id;
		return view('customplanitems.form',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_custom_plan_items'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['grid']);
		
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		return view('customplanitems.view',$this->data);	
	}	

	function postSave( Request $request)
	{
		
		$rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data = $this->validatePost('tb_customplanitems');
				
			$id = $this->model->insertRow($data , $request->input('id'));
			
			if(!is_null($request->input('apply')))
			{
				$return = 'customplanitems/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'customplanitems?return='.self::returnUrl();
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

			return Redirect::to('customplanitems/update/'.$id)->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
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
			return Redirect::to('customplanitems')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success'); 
	
		} else {
			return Redirect::to('customplanitems')
        		->with('messagetext','No Item Deleted')->with('msgstatus','error');				
		}

	}			
    function postAdditem( Request $request){
        $uid = \Auth::user()->id;
		$rules['title'] = 'required';
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data['title'] = $request->input('title');
			$data['description'] = $request->input('description');
            $data['price'] = $request->input('price');
			$data['image'] = $request->input('image');
            
            $data['status'] = 1;
            $destinationPath = public_path() . '/uploads/customplan_items/';
            if (!is_null($request->file('item_img'))) {
                $cplan_file = $request->file('item_img');
                $cplan_filename = $cplan_file->getClientOriginalName();
                $cplan_extension = $cplan_file->getClientOriginalExtension(); //if you need extension of the file
                $cplan_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $cplan_extension;
                $cplan_uploadSuccess = $cplan_file->move($destinationPath, $cplan_filename);
                if ($cplan_uploadSuccess) {
                    $data['image'] = $cplan_filename;
                }
            }  			
			if(!is_null($request->input('property_id')))
			{
				$data['property_id'] = $request->input('property_id');
			}
			if($request->input('edit_id')=='')
			{
				$data['created'] = date('Y-m-d h:i:s');
				$instype = 'add';
				$id = \DB::table('tb_custom_plan_items')->insertGetId($data);                
			}
			else
			{
				$data['updated'] = date('Y-m-d h:i:s');
				$instype = 'update';
				$id = \DB::table('tb_custom_plan_items')->where('id', $request->input('edit_id'))->update($data);
			}		
			
			$res['status'] = 'success';
			//$res['season'] = $cplandata;
			$res['type'] = $instype;
			return json_encode($res);
			
		} else {
			$res['status'] = 'error';
			$res['errors'] = $validator->errors()->all();
			return json_encode($res);
		}    
    }
    function getEdititem(Request $request){
        $bid = $request->input('bid');        
        $items = array();        
        if($bid > 0){ 
            $items = \DB::table('tb_custom_plan_items')->where('id', $bid)->first();            
        }
        
        if(!empty($items)){
            $res['status'] = 'success';
            $res['items'] = $items;                       
        }else{
            $res['status'] = 'error';            
        }
        
        echo json_encode($res);
    }
    
    function postUpdateitem( Request $request){
        $uid = \Auth::user()->id;
		$rules['etitle'] = 'required';
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data['title'] = $request->input('etitle');
			$data['description'] = $request->input('edescription');
            $data['price'] = $request->input('eprice');
			//$data['image'] = $request->input('eitem_img');
            
            $data['status'] = 1;
            $destinationPath = public_path() . '/uploads/customplan_items/';
            if (!is_null($request->file('eitem_img'))) {
                $cplan_file = $request->file('eitem_img');
                $cplan_filename = $cplan_file->getClientOriginalName();
                $cplan_extension = $cplan_file->getClientOriginalExtension(); //if you need extension of the file
                $cplan_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $cplan_extension;
                $cplan_uploadSuccess = $cplan_file->move($destinationPath, $cplan_filename);
                if ($cplan_uploadSuccess) {
                    $data['image'] = $cplan_filename;
                }
            }  			
			if(!is_null($request->input('eproperty_id')))
			{
				$data['property_id'] = $request->input('eproperty_id');
			}
			if($request->input('e_id')!='')
			{				
				$data['updated'] = date('Y-m-d h:i:s');
				$instype = 'update';
				$id = \DB::table('tb_custom_plan_items')->where('id', $request->input('e_id'))->update($data);		
			
    			$res['status'] = 'success';
    			//$res['season'] = $cplandata;
    			$res['type'] = $instype;
    			return json_encode($res);
			}
		} else {
			$res['status'] = 'error';
			$res['errors'] = $validator->errors()->all();
			return json_encode($res);
		}    
    }
    public function postDeleteitem( Request $request)
	{		
		$bId = $request->input('bId');
        if($bId > 0){
            $deleteB = \DB::table('tb_custom_plan_items')->where('id', $bId)->delete();            
        }
		if($deleteB >0 )
		{			
			$res['status'] = 'success';
			return json_encode($res);
		}
		else
		{
			$res['status'] = 'error';
			return json_encode($res);
		}
	}

}