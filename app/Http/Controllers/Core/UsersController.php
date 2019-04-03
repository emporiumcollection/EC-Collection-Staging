<?php namespace App\Http\Controllers\core;

use App\Http\Controllers\controller;
use App\Models\Core\Users;
use App\Models\Core\Groups;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 
use App\Helpers\CrmLayoutHelper;
use App\Models\ModelsModcustomfieldgroup;
use App\Models\ModelsModcustomfieldrows;
use App\Models\ModelsModcustomfieldvalue;
use App\Models\ModelsModcustomfieldelements;
use App\Models\ModelsModcustomfield;


class UsersController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'users';
	static $per_page	= '10';

	public function __construct()
	{
		parent::__construct();
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Users();
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'core/users',
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
		$pagination->setPath('users');
		
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
		return view('core.users.index',$this->data);
	}	



	function getUpdate(Request $request, $id = null)
	{
            
            $module_id = 1;
	
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

                /*
                 * CRM Layout: Fetch page layout
                 */

                $this->data['all_rows'] = CrmLayoutHelper::fetchCrmLayout($module_id);

                /********************************/
                
		$this->data['id'] = $id;
		return view('core.users.form',$this->data);
	}	
    
    function getCrmupdate(Request $request, $id = null)
	{
            
            $module_id = 1;
	
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

                /*
                 * CRM Layout: Fetch page layout
                 */

                $this->data['all_rows'] = CrmLayoutHelper::fetchCrmLayout($module_id);

                /********************************/
                
		$this->data['id'] = $id;
		return view('core.users.crmform',$this->data);
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
		return view('core.users.view',$this->data);	
	}	

	function postSave( Request $request, $id =0)
	{
		
		$rules = $this->validateForm();
		if($request->input('id') =='')
		{
			$rules['password'] 				= 'required|between:6,12';
			$rules['password_confirmation'] = 'required|between:6,12';
			$rules['email'] 				= 'required|email|unique:tb_users';
			$rules['username'] 				= 'required|alpha_num||min:2|unique:tb_users';
			
		} else {
			if($request->input('password') !='')
			{
				$rules['password'] 				='required|between:6,12';
				$rules['password_confirmation'] ='required|between:6,12';			
			}
		}

		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data = $this->validatePost('tb_users');

			$data = $this->validatePost('tb_users');
			if($request->input('id') =='')
			{
				$data['password'] = \Hash::make(Input::get('password'));
			} else {
				if(Input::get('password') !='')
				{
					$data['password'] = \Hash::make(Input::get('password'));
				} else {
					unset($data['password']);
				}
			}
			$data['new_user'] = 0;		
			
			$id = $this->model->insertRow($data , $request->input('id'));



			if(!is_null(Input::file('avatar')))
			{
				$updates = array();
				$file = $request->file('avatar'); 
				$destinationPath = './uploads/users/';
				$filename = $file->getClientOriginalName();
				$extension = $file->getClientOriginalExtension(); //if you need extension of the file
				 $newfilename = $id.'.'.$extension;
				$uploadSuccess = $request->file('avatar')->move($destinationPath, $newfilename);				 
				if( $uploadSuccess ) {
				    $updates['avatar'] = $newfilename; 
				} 
				$this->model->insertRow($updates , $id );
			}	

                        if (!is_null($request->input('customFields'))) {

                            $mod_slug = $request->segment(2);
                            $cstfields = $request->input('customFields');
                            foreach ($request->input('customFields') as $key => $valu) {
                                if (isset($valu['value']) && !empty($valu['value'])) {
                                    $fieltype = $valu['type'];
                                    if ($fieltype == 'checkbox') {
                                        $fieldArrLabel = array();
                                        $fieldArrValue = array();
                                        foreach ($valu['value'] as $valueStr) {
                                            $exlpodeStrFieldValue = explode('||', $valueStr);
                                            $fieldArrValue[] = $exlpodeStrFieldValue[0];
                                            $fieldArrLabel[] = $exlpodeStrFieldValue[1];
                                        }
                                        $fieldValue = implode(',', $fieldArrValue);
                                        $fieldLabel = implode(',', $fieldArrLabel);
                                    } else {
                                        $exlpodeFieldValue = explode('||', $valu['value']);
                                        $fieldValue = isset($exlpodeFieldValue[0]) ? $exlpodeFieldValue[0] : '';
                                        $fieldLabel = isset($exlpodeFieldValue[1]) ? $exlpodeFieldValue[1] : '';
                                    }
                                    $modcustomfieldvalue = new ModelsModcustomfieldvalue;
                                    $modcustomfieldvalue->idmob_mfv = $mod_slug;
                                    $modcustomfieldvalue->record_id_mfv = $request->input('id');
                                    $modcustomfieldvalue->option_type_mfv = $fieltype;
                                    $modcustomfieldvalue->option_name_mfv = $key;
                                    $modcustomfieldvalue->option_label_mfv = $fieldLabel;
                                    $modcustomfieldvalue->option_value_mfv = $fieldValue;
                                    $modcustomfieldvalue->save();
                                }
                            }
                        }

                        if(!is_null($request->input('apply')))
			{
				$return = 'core/users/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'core/users?return='.self::returnUrl();
			}
			
			return Redirect::to($return)->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
			
		} else {

			return Redirect::to('core/users/update/'.$id)->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
			->withErrors($validator)->withInput();
		}	
	
	}	
    
    function postCrmsave( Request $request, $id =0)
	{
		$id = $request->input('id');
		$rules = $this->validateForm();
		if($request->input('id') =='')
		{
			$rules['password'] 				= 'required|between:6,12';
			$rules['password_confirmation'] = 'required|between:6,12';
			$rules['email'] 				= 'required|email|unique:tb_users';
			$rules['username'] 				= 'required|alpha_num||min:2|unique:tb_users';
			
		} else {
			if($request->input('password') !='')
			{
				$rules['password'] 				='required|between:6,12';
				$rules['password_confirmation'] ='required|between:6,12';			
			}
		}

		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data = $this->validatePost('tb_users');

			$data = $this->validatePost('tb_users');
			if($request->input('id') =='')
			{
				$data['password'] = \Hash::make(Input::get('password'));
			} else {
				if(Input::get('password') !='')
				{
					$data['password'] = \Hash::make(Input::get('password'));
				} else {
					unset($data['password']);
				}
			}
					
			
			$id = $this->model->insertRow($data , $request->input('id'));



			if(!is_null(Input::file('avatar')))
			{
				$updates = array();
				$file = $request->file('avatar'); 
				$destinationPath = './uploads/users/';
				$filename = $file->getClientOriginalName();
				$extension = $file->getClientOriginalExtension(); //if you need extension of the file
				 $newfilename = $id.'.'.$extension;
				$uploadSuccess = $request->file('avatar')->move($destinationPath, $newfilename);				 
				if( $uploadSuccess ) {
				    $updates['avatar'] = $newfilename; 
				} 
				$this->model->insertRow($updates , $id );
			}	

                        if (!is_null($request->input('customFields'))) {

                            $mod_slug = $request->segment(2);
                            $cstfields = $request->input('customFields');
                            foreach ($request->input('customFields') as $key => $valu) {
                                if (isset($valu['value']) && !empty($valu['value'])) {
                                    $fieltype = $valu['type'];
                                    if ($fieltype == 'checkbox') {
                                        $fieldArrLabel = array();
                                        $fieldArrValue = array();
                                        foreach ($valu['value'] as $valueStr) {
                                            $exlpodeStrFieldValue = explode('||', $valueStr);
                                            $fieldArrValue[] = $exlpodeStrFieldValue[0];
                                            $fieldArrLabel[] = $exlpodeStrFieldValue[1];
                                        }
                                        $fieldValue = implode(',', $fieldArrValue);
                                        $fieldLabel = implode(',', $fieldArrLabel);
                                    } else {
                                        $exlpodeFieldValue = explode('||', $valu['value']);
                                        $fieldValue = isset($exlpodeFieldValue[0]) ? $exlpodeFieldValue[0] : '';
                                        $fieldLabel = isset($exlpodeFieldValue[1]) ? $exlpodeFieldValue[1] : '';
                                    }
                                    $modcustomfieldvalue = new ModelsModcustomfieldvalue;
                                    $modcustomfieldvalue->idmob_mfv = $mod_slug;
                                    $modcustomfieldvalue->record_id_mfv = $request->input('id');
                                    $modcustomfieldvalue->option_type_mfv = $fieltype;
                                    $modcustomfieldvalue->option_name_mfv = $key;
                                    $modcustomfieldvalue->option_label_mfv = $fieldLabel;
                                    $modcustomfieldvalue->option_value_mfv = $fieldValue;
                                    $modcustomfieldvalue->save();
                                }
                            }
                        }

            if(!is_null($request->input('apply')))
			{
				$return = 'core/users/crmupdate/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'crmhotel/leadlisting?return='.self::returnUrl();
			}
			
			return Redirect::to($return)->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
			
		} else {            
			return Redirect::to('core/users/crmupdate/'.$id)->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
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
			
			// redirect
			return Redirect::to('core/users')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success'); 
	
		} else {
			return Redirect::to('core/users')
        		->with('messagetext','No Item Deleted')->with('msgstatus','error');				
		}

	}

	public function getSearch( $mode = 'native')
	{

		$this->data['tableForm'] 	= $this->info['config']['forms'];	
		$this->data['tableGrid'] 	= $this->info['config']['grid'];
		$this->data['searchMode'] = 'native';
		$this->data['pageUrl']		= url('core/users');
		return view('sximo.module.utility.search',$this->data);
	
	}	

	function getBlast()
	{
		$this->data = array(
			'groups'	=> Groups::all(),
			'pageTitle'	=> 'Blast Email',
			'pageNote'	=> 'Send email to users'
		);	
		return view('core.users.blast',$this->data);		
	}

	function postDoblast( Request $request)
	{

		$rules = array(
			'subject'		=> 'required',
			'message'		=> 'required|min:10',
			'groups'		=> 'required',				
		);	
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) 
		{	

			if(!is_null($request->input('groups')))
			{
				$groups = $request->input('groups');
				for($i=0; $i<count($groups); $i++)
				{
					if($request->input('uStatus') == 'all')
					{
						$users = \DB::table('tb_users')->where('group_id','=',$groups[$i])->get();
					} else {
						$users = \DB::table('tb_users')->where('active','=',$request->input('uStatus'))->where('group_id','=',$groups[$i])->get();
					}
					$count = 0;
					foreach($users as $row)
					{

						$to = $row->email;
						$subject = $request->input('subject');
						$message = $request->input('message');
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= 'From: '.CNF_APPNAME.' <'.CNF_EMAIL.'>' . "\r\n";
							mail($to, $subject, $message, $headers);
						
						$count = ++$count;					
					} 
					
				}
				return Redirect::to('core/users/blast')->with('messagetext','Total '.$count.' Message has been sent')->with('msgstatus','success');

			}
			return Redirect::to('core/users/blast')->with('messagetext','No Message has been sent')->with('msgstatus','info');
			

		} else {

			return Redirect::to('core/users/blast')->with('messagetext', 'The following errors occurred')->with('msgstatus','error')
			->withErrors($validator)->withInput();

		}	

	}

    function getInvite()
	{
		$this->data = array(
			'groups'	=> Groups::all(),
			'pageTitle'	=> 'Invite Email',
			'pageNote'	=> 'Send invitation to users'
		);	
		return view('core.users.invite',$this->data);		
	}
    
    function postDoinvite( Request $request)
	{

		$rules = array(
			'first_name' => 'required|alpha_num|min:2',
            'last_name' => 'required|alpha_num|min:2',
            'email' => 'required'		
		);	
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) 
		{	

			//if(!is_null($request->input('groups')))
			//{
				$referral_code = strtoupper(uniqid());
            
                $user = \DB::table('tb_users')->where('id',\Session::get('uid'))->first();
                
                $invitee_data['user_id'] = $user->id;
                $invitee_data['first_name'] = $request->input('first_name');
                $invitee_data['last_name'] = $request->input('last_name');            
                $invitee_data['email'] = $request->input('email');
                $invitee_data['message'] = $request->input('message');
                $invitee_data['referral_code'] = $referral_code;
                $invitee_data['created'] = date("Y-m-d");
                $today =  date("Y-m-d");            
                $expiry_date = date("Y-m-d", strtotime("+1 month", strtotime($today)));
                
                $invitee_data['expired_on'] = $expiry_date;
                
                $inviteeId = \DB::table('tb_invitee')->insertGetId($invitee_data);             
                if($inviteeId > 0){
                    
                    $edata = array();
                    $emlData['frmemail'] = 'marketing@emporium-voyage.com';
                    $edata['referral_code'] = $referral_code;
                    $edata['emessage'] = $request->input('message');
                    $edata['first_name'] = $request->input('first_name');
                    $edata['last_name'] = $request->input('last_name');
                    $emlData['email'] = $request->input('email');
                    $emlData['subject'] = 'Invitation send by '.$request->input('email');
                    
                    //if (\Session::get('newlang') == 'English') {
                    //    $etemp = 'auth.reminder_eng';
                    //}
                    
                    $etemp = 'invite';
                    //echo view('user.emails.invites.' . $etemp, $edata); die;
                    try{ 
                    \Mail::send('user.emails.invites.' . $etemp, $edata, function($message) use ($emlData) {
                        $message->from($emlData['frmemail'], CNF_APPNAME);
    
                        $message->to($emlData['email']);
    
                        $message->subject($emlData['subject']);
                    });
                    }catch(Exception $ex){
                        //print_r($ex); 
                    }
                }
				return Redirect::to('core/users/invite')->with('messagetext', 'Invitation has been sent')->with('msgstatus','success');

			//}
			//return Redirect::to('core/users/blast')->with('messagetext','No Message has been sent')->with('msgstatus','info');
			

		} else {

			return Redirect::to('core/users/invite')->with('messagetext', 'The following errors occurred')->with('msgstatus','error')
			->withErrors($validator)->withInput();

		}	

	}
    public function leadlisting( Request $request )
	{

		if($this->access['is_view'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
						
		$sort = (!is_null($request->input('sort')) ? $request->input('sort') : 'id'); 
		$order = (!is_null($request->input('order')) ? $request->input('order') : 'asc');
        $gp_id = \CommonHelper::getusertype('new-lead');        
		// End Filter sort and order for query 
		// Filter Search for query		
		$filter = (!is_null($request->input('search')) ? $this->buildSearch() : '');
		$filter .= " AND tb_users.group_id >= '".$gp_id."'" ;

		
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
		$pagination->setPath('leadlisting');
		
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
		return view('core.users.leadlisting',$this->data);
	}
    public function getCrmsearch( $mode = 'native')
	{

		$this->data['tableForm'] 	= $this->info['config']['forms'];	
		$this->data['tableGrid'] 	= $this->info['config']['grid'];
		$this->data['searchMode'] = 'native';
		$this->data['pageUrl']		= url('crmhotel/leadlisting');
		return view('sximo.module.utility.search',$this->data);
	
	}
    
    public function hoteluserlisting( Request $request )
	{

		if($this->access['is_view'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
						
		$sort = (!is_null($request->input('sort')) ? $request->input('sort') : 'id'); 
		$order = (!is_null($request->input('order')) ? $request->input('order') : 'asc');
        $gp_id = \CommonHelper::getusertype('hotel-b2b');        
		// End Filter sort and order for query 
		// Filter Search for query		
		$filter = (!is_null($request->input('search')) ? $this->buildSearch() : '');
		$filter .= " AND tb_users.group_id = '".$gp_id."'" ;

		
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
		$pagination->setPath('hoteluserlisting');
		
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
		return view('core.users.hoteluserlisting',$this->data);
	}	
    public function travelleruserlisting( Request $request )
	{

		if($this->access['is_view'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
						
		$sort = (!is_null($request->input('sort')) ? $request->input('sort') : 'id'); 
		$order = (!is_null($request->input('order')) ? $request->input('order') : 'asc');
        $gp_id = \CommonHelper::getusertype('users-b2c');        
		// End Filter sort and order for query 
		// Filter Search for query		
		$filter = (!is_null($request->input('search')) ? $this->buildSearch() : '');
		$filter .= " AND tb_users.group_id = '".$gp_id."'" ;

		
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
		$pagination->setPath('travelleruserlisting');
		
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
		return view('core.users.travelleruserlisting',$this->data);
	}
    public function getCrmhotelusersearch( $mode = 'native')
	{
		$this->data['tableForm'] 	= $this->info['config']['forms'];	
		$this->data['tableGrid'] 	= $this->info['config']['grid'];
		$this->data['searchMode'] = 'native';
		$this->data['pageUrl']		= url('crmhotel/hoteluserlisting');
		return view('sximo.module.utility.search',$this->data);	
	}
    public function getCrmtravellerusersearch( $mode = 'native')
	{
		$this->data['tableForm'] 	= $this->info['config']['forms'];	
		$this->data['tableGrid'] 	= $this->info['config']['grid'];
		$this->data['searchMode'] = 'native';
		$this->data['pageUrl']		= url('crmhotel/travelleruserlisting');
		return view('sximo.module.utility.search',$this->data);	
	}
}