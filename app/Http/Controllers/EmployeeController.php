<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 
use App\Http\Controllers\ContainerController;


class EmployeeController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'employee';
	static $per_page	= '10';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Employee();
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'employee',
			'return'	=> self::returnUrl()
			
		);
		
	}

	public function getIndex( Request $request )
	{

		if($this->access['is_view'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');

		$sort = (!is_null($request->input('sort')) ? $request->input('sort') : 'EmployeeId'); 
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
		$pagination->setPath('employee');
		
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
		return view('employee.index',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('employee'); 
		}

		$this->data['id'] = $id;
		
		if($id!='')
		{
			$shared_files = \DB::table('tb_container_employee_share')->where('share_email', $row->Email)->get();
			if(!empty($shared_files))
			{
				$ct=0;
				foreach($shared_files as $sharef)
				{
					$fids = explode(',',$sharef->file_ids);
					$fetchfiles = \DB::table('tb_container_files')->whereIn('id', $fids)->get();
					foreach($fetchfiles as $filesObj ){
						$this->data['rowData'][$ct]['id'] = $filesObj->id;
						$this->data['rowData'][$ct]['folderid'] = $filesObj->folder_id;
						$this->data['rowData'][$ct]['name'] = $filesObj->file_name;
						$this->data['rowData'][$ct]['ftype'] = 'file';
						$imgsrc = (new ContainerController)->getThumbpath($filesObj->folder_id);
						$this->data['rowData'][$ct]['imgsrc'] = $imgsrc;
						$this->data['rowData'][$ct]['file_display_name'] = $filesObj->file_display_name;
						
						$ct++;
					}
				}
			}
		}
				
		return view('employee.form',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('employee'); 
		}
		
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		return view('employee.view',$this->data);	
	}	

	function postSave( Request $request)
	{
		
		$rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data = $this->validatePost('tb_employee');
			$data['flag_status'] = $request->input('flag_status');
			$id = $this->model->insertRow($data , $request->input('EmployeeId'));
			if($request->input('EmployeeId') =='')
			{
				$userdata['group_id'] = 3;
				$userdata['username'] = $request->input('FirstName').$request->input('LastName').$id;
				$userdata['password'] = \Hash::make('user123');
				$userdata['email'] = $request->input('Email');
				$userdata['first_name'] = $request->input('FirstName');
				$userdata['last_name'] = $request->input('LastName');
				$userdata['active'] = 1;
				
				\DB::table('tb_users')->insert($userdata);
			}
			
			if(!is_null($request->input('apply')))
			{
				$return = 'employee/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'employee?return='.self::returnUrl();
			}

			// Insert logs into database
			if($request->input('EmployeeId') =='')
			{
				\SiteHelpers::auditTrail( $request , 'New Data with ID '.$id.' Has been Inserted !');
			} else {
				\SiteHelpers::auditTrail($request ,'Data with ID '.$id.' Has been Updated !');
			}

			return Redirect::to($return)->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
			
		} else {

			return Redirect::to('employee/update/'.$id)->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
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
			return Redirect::to('employee')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success'); 
	
		} else {
			return Redirect::to('employee')
        		->with('messagetext','No Item Deleted')->with('msgstatus','error');				
		}

	}

	function postDoemail( Request $request)
	{
		$rules = array(
			'subject'		=> 'required',
			'message'		=> 'required|min:10'			
		);	
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) 
		{	
			if(!empty($request->input('selectedusers')))
			{
				$selectedusers = $request->input('selectedusers');
				$users = explode(',',$selectedusers);
				for($i=0; $i<count($users); $i++)
				{
					$crm = \DB::table('employee')->where('EmployeeId','=',$users[$i])->first();
					$uname = $crm->FirstName.$crm->LastName.$crm->EmployeeId;
					
					$user = \DB::table('tb_users')->where('username','=',$uname)->first();
					if(!empty($user))
					{
						$newPass = $this->generateRandomString();
						$msg = $request->input('message');
						$fnameConvertmsg = str_replace('[first_name]',$crm->FirstName,$msg);
						$lnameConvertmsg = str_replace('[last_name]',$crm->LastName,$fnameConvertmsg);
						$emailConvertmsg = str_replace('[email]',$user->email,$lnameConvertmsg);
						$passConvertmsg = str_replace('[password]',$newPass,$emailConvertmsg);
						
						$to = $crm->Email;
						$subject = $request->input('subject');
						$message = $passConvertmsg;
						$headers = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= 'From: '.CNF_APPNAME.' <'.CNF_EMAIL.'>' . "\r\n";
						mail($to, $subject, $message, $headers);
						
						$updatePass = \Hash::make($newPass);
						\DB::table('tb_users')->where('id',$user->id)->update(['password' => $updatePass]);

					}
				}
				return Redirect::to(Input::get('curnurl'))->with('messagetext','Message has been sent')->with('msgstatus','success');

			}
			return Redirect::to(Input::get('curnurl'))->with('messagetext','Please select atleast one CRM')->with('msgstatus','error');
			

		} else {

			return Redirect::to(Input::get('curnurl'))->with('messagetext', 'The following errors occurred')->with('msgstatus','error')->withErrors($validator)->withInput();

		}	

	}
	
	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}


}