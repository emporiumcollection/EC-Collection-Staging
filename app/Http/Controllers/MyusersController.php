<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Myusers;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 
use Maatwebsite\Excel\Facades\Excel;


class MyusersController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'myusers';
	static $per_page	= '10';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Myusers();
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'myusers',
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
		$filter = (!is_null($request->input('search')) ? '': '');
		$filter .= " AND tb_users.group_id >= '".\Session::get('gid')."'" ;

		
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
		$pagination->setPath('myusers');
		
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
		return view('myusers.index',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_users'); 
		}

		
		$this->data['id'] = $id;
		return view('myusers.form',$this->data);
	}	

	public function getShow( $id = null)
	{
	
		if($this->access['is_detail'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', Lang::get('core.note_restric'))->with('msgstatus','error');
					
		$row = $this->model->getRow($id);
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('tb_users'); 
		}
		
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		return view('myusers.view',$this->data);	
	}	

	function postSave( Request $request)
	{
		$rules = $this->validateForm();
		$id = $request->input('id');
		if($request->input('id') =='')
		{
			$rules['password'] 				= 'required|between:6,100';
			$rules['password_confirmation'] = 'required|between:6,100';
			$rules['email'] 				= 'required|email|unique:tb_users';
			$rules['username'] 				= 'required|alpha_num||min:2|unique:tb_users';
			
		} else {
			if($request->input('password') !='')
			{
				$rules['password'] 				='required|between:6,100';
				$rules['password_confirmation'] ='required|between:6,100';			
			}
		}
		
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data = $this->validatePost('tb_myusers');

			if($request->input('id') =='')
			{
				$data['password'] = \Hash::make(Input::get('password'));
			} else {
				if(Input::get('password') !='')
				{
					$data['password'] = \Hash::make(Input::get('password'));
				}
			}
			
			$id = $this->model->insertRow($data , $request->input('id'));
			
			if($request->input('id') =='')
			{
				$newlight['box_name'] = 'Lightbox 1';
				$newlight['user_id'] = $id;
				$newlight['created'] = date('Y-m-d h:i:s');
				$light_id = \DB::table('tb_lightbox')->insertGetId($newlight);
			}
			
			if(!is_null($request->input('apply')))
			{
				$return = 'myusers/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'myusers?return='.self::returnUrl();
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

			return Redirect::to('myusers/update/'.$id)->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
			->withErrors($validator)->withInput();
		}	
	
	}	

	public function postDelete( Request $request)
	{
		
		if($this->access['is_remove'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
		// delete multipe rows 
		if(count($request->input('id')) >=1)
		{
			$this->model->destroy($request->input('id'));
			
			\SiteHelpers::auditTrail( $request , "ID : ".implode(",",$request->input('id'))."  , Has Been Removed Successfull");
			// redirect
			return Redirect::to('myusers')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success'); 
	
		} else {
			return Redirect::to('myusers')
        		->with('messagetext','No Item Deleted')->with('msgstatus','error');				
		}

	}

	function importUsersCsv( Request $request)
	{
		$rules['user_csv'] 	= 'required|mimes:csv,xls,xlsx';
		
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			
			try {
				Excel::load(Input::file('user_csv'), function ($reader) {

					foreach ($reader->toArray() as $row) {
						foreach($row as $single)
						{
							if(!empty($single))
							{
								$user['group_id'] = 3;
								if($single['kundennr']!='')
								{
									$user['password'] = \Hash::make($single['kundennr']);
								}
								if($single['email']!='')
								{
									$user['email'] = $single['email'];
								}
								$user['active'] = 1;
								$uid = \DB::table('tb_users')->insertGetId($user);
								
								if($single['email']!='')
								{
									$crm['Email'] = $single['email'];
								}
								$crm['Status'] = 1;
								\DB::table('employee')->insert($crm);
								
								$usercom['user_id'] = $uid;
								if($single['kundennr']!='')
								{
									$usercom['client_id'] = $single['kundennr'];
								}
								if($single['name1']!='')
								{
									$usercom['company_name'] = $single['name1'];
								}
								if($single['name2']!='')
								{
									$usercom['company_owner'] = $single['name2'];
								}
								if($single['strasse']!='')
								{
									$usercom['company_address'] = $single['strasse'];
								}
								if($single['email']!='')
								{
									$usercom['company_email'] = $single['email'];
								}
								if($single['postleitz']!='')
								{
									$usercom['company_postal_code'] = $single['postleitz'];
								}
								if($single['ort']!='')
								{
									$usercom['company_city'] = $single['ort'];
								}
								if($single['telefon']!='')
								{
									$usercom['company_phone'] = $single['telefon'];
								}
								if($single['land']!='')
								{
									$usercom['company_country'] = $single['land'];
								}
								$usercom['created'] = date('Y-m-d h:i:s');
								$usercom['accept_terms'] = 1;
								\DB::table('tb_user_company_details')->insertGetId($usercom);
								
								/*if($single['membership']!='')
								{
									$fetch_member = \DB::table('tb_membership')->where('package_name',$single['membership'])->where('status',1)->first();
									if(!empty($fetch_member))
									{
										$member['user_id'] = $uid;
										$member['membership_id'] = $fetch_member->id;
										$member['created'] = date('Y-m-d h:i:s');
										\DB::table('tb_users_membership')->insert($member);
									}
								}*/
							}
						}
					}
				});
				return Redirect::to('myusers')->with('messagetext','Users uploaded successfully.')->with('msgstatus','success');
			} catch (\Exception $e) {
				return Redirect::to('myusers')->with('messagetext',$e->getMessage())->with('msgstatus','error');
			}
		} else {

			return Redirect::to('myusers')->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
			->withErrors($validator)->withInput();
		}	
	
	}


}