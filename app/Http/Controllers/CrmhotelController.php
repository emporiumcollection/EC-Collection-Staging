<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Crmhotel;
use App\Models\Properties;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ;  
use App\Helpers\CrmLayoutHelper;
use App\Models\ModelsModcustomfieldgroup;
use App\Models\ModelsModcustomfieldrows;
use App\Models\ModelsModcustomfieldvalue;
use App\Models\ModelsModcustomfieldelements;
use App\Models\ModelsModcustomfield;


class CrmhotelController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	//public $module = 'crmhotel';
    public $module = 'properties';
	static $per_page	= '50';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Properties();
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'properties',
			'return'	=> self::returnUrl()
			
		);
		
	}

	public function getIndex( Request $request )
	{
        /*
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
		$pagination->setPath('crmhotel');
		
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
		return view('crmhotel.index',$this->data); */ 
        
        
        /*$this->data['access']		= $this->access;
        $this->data['i']=0;
        $this->data['rowData'] = \DB::table('tb_properties')->where('property_status', 0)->simplePaginate(static::$per_page);
        //print_r($properties);
        return view('crmhotel.hotelleadlisting',$this->data);*/
        
        if ($this->access['is_view'] == 0)
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');

        $sort = (!is_null($request->input('sort')) ? $request->input('sort') : (!is_null($request->input('search')) ? 'id' : 'property_status'));
        $order = (!is_null($request->input('order')) ? $request->input('order') : 'desc');
        // End Filter sort and order for query 
        // Filter Search for query		
        $filter = (!is_null($request->input('search')) ? $this->buildSearch() : '');
        $filter .= " AND tb_properties.property_status = '0'" ;
        
		$this->data['curntcat'] =  '';
		$this->data['curstatus'] =  '';
		if(!is_null($request->input('selcat')) && $request->input('selcat')!='')
		{
			$filter .= ' AND FIND_IN_SET('.$request->input('selcat').', property_category_id)';
			$this->data['curntcat'] = $request->input('selcat');
		}
		if(!is_null($request->input('selstatus')) && $request->input('selstatus')!='')
		{
			$pstatus = ($request->input('selstatus')=='active') ? 1 : 0;
			$filter .= ' AND property_status = '.$pstatus;
			$this->data['curstatus'] = $request->input('selstatus');
		}

        if(\Session::get('gid')!=1 && \Session::get('gid')!=2){
                $uid = \Auth::user()->id;

                $filter .= " AND user_id = '".$uid."'" ;

        }
        $page = $request->input('page', 1);
        $params = array(
            'page' => $page,
            'limit' => (!is_null($request->input('rows')) ? filter_var($request->input('rows'), FILTER_VALIDATE_INT) : static::$per_page ),
            'sort' => $sort,
            'order' => $order,
            'params' => $filter,
            'global' => (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
        );
        // Get Query 
        $results = $this->model->getRows($params);

        // Build pagination setting
        $page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;
        $pagination = new Paginator($results['rows'], $results['total'], $params['limit']);
        $pagination->setPath('crmhotel');
		
        $this->data['rowData'] = $results['rows'];
        // Build Pagination 
        $this->data['pagination'] = $pagination;
        // Build pager number and append current param GET
        $this->data['pager'] = $this->injectPaginate();
        // Row grid Number 
        $this->data['i'] = ($page * $params['limit']) - $params['limit'];
        // Grid Configuration 
        $this->data['tableGrid'] = $this->info['config']['grid'];
        $this->data['tableForm'] = $this->info['config']['forms'];
        $this->data['colspan'] = \SiteHelpers::viewColSpan($this->info['config']['grid']);
        // Group users permission
        $this->data['access'] = $this->access;
        // Detail from master if any
        // Master detail link if any 
        $this->data['subgrid'] = (isset($this->info['config']['subgrid']) ? $this->info['config']['subgrid'] : array());
        // Render into template
		$this->data['fetch_cat'] = \DB::table('tb_categories')->get();
        
        //$is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        //$file_name = (strlen($is_demo6) > 0)?$is_demo6.'.properties.index':'properties.index';
        
        return view('crmhotel.hotelleadlisting',$this->data);
	}	



	function _getUpdate(Request $request, $id = null)
	{
	
            $module_id = 83;
            
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
			$this->data['row'] = $this->model->getColumnTable('tb_crm_prop'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['forms']);
		
                
                /*
                 * CRM Layout: Fetch page layout
                 */

                $this->data['all_rows'] = CrmLayoutHelper::fetchCrmLayout($module_id);

                /********************************/
                
		$this->data['id'] = $id;
		return view('crmhotel.form',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_crm_prop'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['grid']);
		
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		return view('crmhotel.view',$this->data);	
	}	

	function _postSave( Request $request)
	{
		
		$rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data = $this->validatePost('tb_crmhotel');
			$data['is_company'] = $request->input('is_company');
				
			$id = $this->model->insertRow($data , $request->input('id'));
			
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
                                    $modcustomfieldvalue->record_id_mfv = $id;
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
				$return = 'crmhotel/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'crmhotel?return='.self::returnUrl();
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

			return Redirect::to('crmhotel/update/')->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
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
			return Redirect::to('crmhotel')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success'); 
	
		} else {
			return Redirect::to('crmhotel')
        		->with('messagetext','No Item Deleted')->with('msgstatus','error');				
		}

	}


	public function fetch_property_info(Request $request)
	{
		$propertyid = $request->input('propid');
		if($propertyid > 0)
		{
			$checkprop =  \DB::table('tb_properties')->select('property_name','city','country','website','phone','email')->where('id', $propertyid)->first();
			if(!empty($checkprop))
			{
				$ret['status'] = 'success';
				$ret['prop'] = $checkprop;
			}
			else
			{
				$ret['status'] = 'error';
			}
		}
		else
		{
			$ret['status'] = 'error';
		}
		return $ret;
	}

	public function pull_property_hotels(Request $request)
	{
		$checkprop =  \DB::table('tb_properties')->select('id','property_name','city','country','website','phone','email')->where('script_status',0)->take(100)->get();
		if(!empty($checkprop))
		{
			foreach($checkprop as $prop)
			{
				$data['hotel_name'] = $prop->property_name;
				$data['hotel_city'] = $prop->city;
				$data['hotel_country'] = $prop->country;
				$data['hotel_website'] = $prop->website;
				$data['hotel_main_phone'] = $prop->phone;
				$data['hotel_email'] = $prop->email;
				$data['propr_id'] = $prop->id;
				
				$ins = \DB::table('tb_crm_prop')->insert($data);
				if($ins)
				{
					\DB::table('tb_properties')->where('id',$prop->id)->update(['script_status'=>'1']);
				}
			}
			echo "success";
		}
		else
		{
			echo "error";
		}
	}
	
	//Email to CRM 
    public function emailCRM(Request $request)
    {
        $crmemail = trim($request->input('crm_email_popup'));
        
		if($crmemail!='')
		{
            $expo_to = explode(',', $crmemail);
            
			$ccemail = trim($request->input('cc_email_popup'));
			$crmId = $request->input('crmId_email_popup');
			$propertyId = $request->input('propertyid_email_popup');
			$subjectemail = trim($request->input('subject_email_popup'));
			$templateemail = trim($request->input('template_email_popup'));
			$emailArr['msg'] = $request->input('message_email_popup');
			$destinationPath = public_path().'/uploads/varients_imgs/';
			$actimgpath = '';
			$actimgname = '';
			if(!is_null($request->file('upload_email_popup')))
			{
				$filepos7 = $request->file('upload_email_popup');
				$filenamepos7 = $filepos7->getClientOriginalName();
				$extensionpos7 = $filepos7->getClientOriginalExtension(); //if you need extension of the file
				$filenamepos7 = rand(11111111, 99999999).'-'.rand(11111111, 99999999).'.'.$extensionpos7;
				$uploadSuccesspos7 = $filepos7->move($destinationPath, $filenamepos7);
				if($uploadSuccesspos7)
				{
					$actimgpath = $destinationPath.$filenamepos7;
					$actimgname = $filenamepos7;
				}
			}			
			elseif(is_null($request->file('upload_email_popup')))
			{
				if($request->input('container_image_pos_1')!="")
				{
					$container_image_pos_7 = $request->input('container_image_pos_1');
					$explode_imagepos7 = explode('/', $container_image_pos_7);
					$filename_pos7 = rand(11111, 99999).'-'. end($explode_imagepos7);
					$successfile7 = \File::copy($container_image_pos_7, $destinationPath.$filename_pos7);
					if($successfile7)
					{
						$actimgpath = $destinationPath.$filename_pos7;
						$actimgname = $filename_pos7;
					}
				}
			}		
			
            $batch_com_data = array();
            if($propertyId != ""){
                $expo_prop = explode(',', $propertyId);
                for($i=0; $i < count($expo_prop); $i++) {
                    
                    //$toouser['email'] = $crmemail;
                    $toouser['email'] = $expo_to[$i];
        			$toouser['cc_email_popup'] = $ccemail;
        			$toouser['subject'] = $subjectemail;
        			$toouser['attchfle'] = $actimgpath;
        			$emailArr['attchflename'] = $actimgname;
        			$ucode = rand(11111111, 99999999).rand(11111111, 99999999);
        			$emailArr['link'] = 'download-document/'.$ucode;
        			$tempe = 'crm_email';
        			if($templateemail!='')
        			{
        				$tempe = $templateemail;
        			}
        			\Mail::send('user.emails.'.$tempe, $emailArr, function($message) use ($toouser)
        			{
        				$message->from('sales@emporium-voyage.com', CNF_APPNAME);
        
        				$message->to( $toouser['email']);
        				if($toouser['cc_email_popup']!='')
        				{
        					$message->cc($toouser['cc_email_popup']);
        				}
        				$message->subject($toouser['subject']);
        			});
                    
                    $data['crm_id'] = $expo_prop[$i];
        			$data['user_id'] = \Auth::user()->id;
        			$data['property_id'] = $expo_prop[$i];
        			$data['email_address'] = $expo_to[$i];
        			$data['cc_email_address'] = $ccemail;
        			$data['email_subject'] = $subjectemail;
        			$data['email_template'] = $templateemail;
        			$data['email_message'] = $request->input('message_email_popup');
        			$data['email_attachfile'] = $actimgname;
        			$data['email_uniquescode'] = $ucode;
                    //$batch_com_data[] = $data;
                    $ins = \DB::table('tb_crm_emailcommunication')->insert($data);
                }                
            }
            //print_r($batch_com_data); die;
            //$ins = \DB::table('tb_crm_emailcommunication')->insert($batch_com_data);
            
			/*$data['crm_id'] = $crmId;
			$data['user_id'] = \Auth::user()->id;
			$data['property_id'] = $propertyId;
			$data['email_address'] = $crmemail;
			$data['cc_email_address'] = $ccemail;
			$data['email_subject'] = $subjectemail;
			$data['email_template'] = $templateemail;
			$data['email_message'] = $request->input('message_email_popup');
			$data['email_attachfile'] = $actimgname;
			$data['email_uniquescode'] = $ucode;
			$ins = \DB::table('tb_crm_emailcommunication')->insert($data); */
			
			$ret['status'] = "success";
		}
		else{
			$ret['status'] = "error";
		}
		return $ret;
    }
	
	public function fetch_company_info(Request $request)
	{
		$crmid = $request->input('crmid');
		if($crmid > 0)
		{
			$checkcrm =  \DB::table('tb_crm_prop')->select('propr_id','hotel_email','hotel_address')->where('id', $crmid)->first();
			if(!empty($checkcrm))
			{
				$ret['status'] = 'success';
				$ret['crm'] = $checkcrm;
				$ret['crmemails'] = array();
				$checkcrmemails =  \DB::table('tb_crm_emailcommunication')->select('email_subject',\DB::raw("DATE_FORMAT(created_at, '%M %d') as created_at"),'id','email_message')->where('crm_id', $crmid)->get();
				if(!empty($checkcrmemails))
				{
					$ret['crmemails'] = $checkcrmemails;
				}
			}
			else
			{
				$ret['status'] = 'error';
			}
		}
		else
		{
			$ret['status'] = 'error';
		}
		return json_encode($ret);
	}
    
    public function fetch_property_company_info(Request $request)
	{
		$crmid = $request->input('crmid');
        $ids = $request->input('ids');
        //echo $ids;
        $checkcrms = array();
        if ($ids != '') {
            $expo = explode(',', $ids);
            if(count($expo) > 0 ) {
                $checkcrms =  \DB::table('tb_properties')->select('id','email','hotelinfo_address')->whereIn('id', $expo)->get();
                $emails = '';
                $p_ids = '';
                $hotelinfo_address = "";
                foreach($checkcrms as $chk){
                    if(trim($chk->email) !="" ){
                        $emails.= ($emails =='') ? trim($chk->email) : ((trim($chk->email)!='') ? ", ".trim($chk->email) : '');
                        $p_ids.= ($p_ids =='') ? trim($chk->id) : ",".trim($chk->id);
                        if($chk->id==$crmid){
                            $hotelinfo_address = trim($chk->hotelinfo_address);
                        }
                    }
                }
                //print_r($checkcrms);
                $ret['status'] = 'success';
				$ret['crm']['email'] = $emails;
                $ret['crm']['id'] = $p_ids;
                $ret['crm']['hotelinfo_address'] = $hotelinfo_address;
                $ret['crmemails'] = array();
				$checkcrmemails =  \DB::table('tb_crm_emailcommunication')->select('email_subject',\DB::raw("DATE_FORMAT(created_at, '%M %d') as created_at"),'id','email_message')->where('crm_id', $crmid)->get();
				if(!empty($checkcrmemails))
				{
					$ret['crmemails'] = $checkcrmemails;
				}
            }            
        }else{
            if($crmid > 0)
    		{
    			$checkcrm =  \DB::table('tb_properties')->select('id','email','hotelinfo_address')->where('id', $crmid)->first();
    			if(!empty($checkcrm))
    			{
    				$ret['status'] = 'success';
    				$ret['crm'] = $checkcrm;
    				$ret['crmemails'] = array();
    				$checkcrmemails =  \DB::table('tb_crm_emailcommunication')->select('email_subject',\DB::raw("DATE_FORMAT(created_at, '%M %d') as created_at"),'id','email_message')->where('crm_id', $crmid)->get();
    				if(!empty($checkcrmemails))
    				{
    					$ret['crmemails'] = $checkcrmemails;
    				}
    			}
    			else
    			{
    				$ret['status'] = 'error';
    			}
    		}
    		else
    		{
    			$ret['status'] = 'error';
    		}
        } 
		/*if($crmid > 0)
		{
			$checkcrm =  \DB::table('tb_properties')->select('id','email','hotelinfo_address')->where('id', $crmid)->first();
			if(!empty($checkcrm))
			{
				$ret['status'] = 'success';
				$ret['crm'] = $checkcrm;
				$ret['crmemails'] = array();
				$checkcrmemails =  \DB::table('tb_crm_emailcommunication')->select('email_subject',\DB::raw("DATE_FORMAT(created_at, '%M %d') as created_at"),'id','email_message')->where('crm_id', $crmid)->get();
				if(!empty($checkcrmemails))
				{
					$ret['crmemails'] = $checkcrmemails;
				}
			}
			else
			{
				$ret['status'] = 'error';
			}
		}
		else
		{
			$ret['status'] = 'error';
		}*/
		return json_encode($ret);
	}
    
    function getLead(Request $request, $id = null)
	{
	
       /*     $module_id = 83;
            
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
			$this->data['row'] = $this->model->getColumnTable('tb_crm_prop'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['forms']);
		*/
                
                /*
                 * CRM Layout: Fetch page layout
                 */

       /*         $this->data['all_rows'] = CrmLayoutHelper::fetchCrmLayout($module_id); */

                /********************************/
        $gp_id = \CommonHelper::getusertype('new-lead'); 
        $this->data['group_id'] =  $gp_id;     
		$this->data['id'] = $id;
		return view('crmhotel.lead',$this->data);
	}
    function getUpdatelead(Request $request, $id = null)
	{	
        $gp_id = \CommonHelper::getusertype('new-lead'); 
        $this->data['group_id'] =  $gp_id;     
		$this->data['id'] = $id;
        
        $this->data['users'] = \DB::table('tb_users')->where('id', $id)->first();
        $this->data['company'] = \DB::table('tb_user_company_details')->where('user_id', $id)->first();
        
		return view('crmhotel.updatelead',$this->data);
	}
    function postUpdatelead(Request $request, $id = null)
	{	
        $gp_id = \CommonHelper::getusertype('new-lead'); 
        $this->data['group_id'] =  $gp_id;     
		$this->data['id'] = $id;
        
        $rules = array(
            'firstname' => 'required',
            'lastname' => 'required',
            'phonecode' => 'required',
            'email' => 'required|email',
            'phone' =>'required',
            'company_name' =>'required',
            'company_email' =>'required',
        );
        $messages = array(
            'firstname.required' => 'The first name field is required.',
            'lastname.required' => 'The last name field is required.',
            'phonecode.required' => 'The phone code field is required.',
            'email.required' => 'The email field is required.',
            'phone.required' => 'The phone field is required.',
            'company_name.required' => 'The company name field is required.',
            'company_email.required' => 'The company email field is required.',
        );
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) { 
            $hotel_type='';
            if(!is_null($request->input('hotel_type')))
			{
				$hotel_type = implode(',',$request->input('hotel_type'));
			}
            $user_data = array(
                'first_name' => $request->input('firstname'),
                'last_name' => $request->input('lastname'),
                'email' => trim($request->input('email')),
                'lead_type' => trim($request->input('lead_type')),                
                'hotel_type' => trim($hotel_type),
                
                'mobile_code'=>trim($request->input('phonecode')),
                'mobile_number'=>trim($request->input('phone')),
                
                'instagram' => trim($request->input('instagram')),
                'facebook' => trim($request->input('facebook')),
                'linkedin' => trim($request->input('linkedin')),                      
                'active' => '0'                
            );
            
            \DB::table('tb_users')->where('id', $id)->update($user_data);
                                                
            //$ucdata['user_id'] = $id;
            $ucdata['company_name'] = trim($request->input('company_name'));
            $ucdata['company_address'] = trim($request->input('company_address'));
            $ucdata['company_city'] = trim($request->input('company_city'));
            $ucdata['company_postal_code'] = trim($request->input('company_postal_code'));
            $ucdata['company_country'] = trim($request->input('company_country'));
            $ucdata['company_phone'] = trim($request->input('company_phone'));
            $ucdata['company_website'] = trim($request->input('company_website'));
            $ucdata['company_email'] = trim($request->input('company_email'));
            $ucdata['company_status'] = trim($request->input('crm_prop_status'));
            
             \DB::table('tb_user_company_details')->where('user_id', $id)->update($ucdata);
            
            $response = array('status' => 'success', 'message' => 'New Lead updated successfully');
            
        } else {
            $response = array('status' => 'error', 'message' => 'The following errors occurred', 'errors' => $validator->errors()->all());
        }
        print_r($response);
		//return view('crmhotel.updatelead',$this->data);
	}
    public function fetch_user_info(Request $request)
	{
		$crm_uid = $request->input('crmuid');
        $ids = $request->input('ids');
        //echo $ids;
        $checkcrms = array();
        if ($ids != '') {
            $expo = explode(',', $ids);
            if(count($expo) > 0 ) {
                $checkcrms =  \DB::table('tb_users')->select('id','email','address')->whereIn('id', $expo)->get();
                $emails = '';
                $p_ids = '';
                $address = "";
                foreach($checkcrms as $chk){
                    if(trim($chk->email) !="" ){
                        $emails.= ($emails =='') ? trim($chk->email) : ((trim($chk->email)!='') ? ", ".trim($chk->email) : '');
                        $p_ids.= ($p_ids =='') ? trim($chk->id) : ",".trim($chk->id);
                        if($chk->id==$crm_uid){
                            $address = trim($chk->address);
                        }
                    }
                }
                //print_r($checkcrms);
                $ret['status'] = 'success';
				$ret['crm']['email'] = $emails;
                $ret['crm']['id'] = $p_ids;
                $ret['crm']['address'] = $address;
                $ret['crmemails'] = array();
				$checkcrmemails =  \DB::table('tb_crm_emailcommunication')->select('email_subject',\DB::raw("DATE_FORMAT(created_at, '%M %d') as created_at"),'id','email_message')->where('crm_id', $crm_uid)->get();
				if(!empty($checkcrmemails))
				{
					$ret['crmemails'] = $checkcrmemails;
				}
            }            
        }
        else
        {
	        if($crm_uid > 0)
    		{
    			$checkcrm =  \DB::table('tb_users')->select('id','email','address')->where('id', $crm_uid)->first();
    			if(!empty($checkcrm))
    			{
    				$ret['status'] = 'success';
    				$ret['crm'] = $checkcrm;
    				$ret['crmemails'] = array();
    				$checkcrmemails =  \DB::table('tb_crm_emailcommunication')->select('email_subject',\DB::raw("DATE_FORMAT(created_at, '%M %d') as created_at"),'id','email_message')->where('crm_id', $crm_uid)->get();
    				if(!empty($checkcrmemails))
    				{
    					$ret['crmemails'] = $checkcrmemails;
    				}
    			}
    			else
    			{
    				$ret['status'] = 'error';
    			}
    		}
    		else
    		{
    			$ret['status'] = 'error';
    		}
        }
		return json_encode($ret);
	}
    //Email to CRM 
    public function emailInviteCRM(Request $request)
    {
        $crmemail = trim($request->input('crm_email_popup'));
        
		if($crmemail!='')
		{
            $expo_to = explode(',', $crmemail);
            
			$ccemail = trim($request->input('cc_email_popup'));
			$crmId = $request->input('crmId_email_popup');
			$propertyId = $request->input('propertyid_email_popup');
			$subjectemail = trim($request->input('subject_email_popup'));
			$templateemail = trim($request->input('template_email_popup'));
			$emailArr['msg'] =$request->input('message_email_popup');
			$destinationPath = public_path().'/uploads/varients_imgs/';
			$actimgpath = '';
			$actimgname = '';
            
			if(!is_null($request->file('upload_email_popup')))
			{
				$filepos7 = $request->file('upload_email_popup');
				$filenamepos7 = $filepos7->getClientOriginalName();
				$extensionpos7 = $filepos7->getClientOriginalExtension(); //if you need extension of the file
				$filenamepos7 = rand(11111111, 99999999).'-'.rand(11111111, 99999999).'.'.$extensionpos7;
				$uploadSuccesspos7 = $filepos7->move($destinationPath, $filenamepos7);
				if($uploadSuccesspos7)
				{
					$actimgpath = $destinationPath.$filenamepos7;
					$actimgname = $filenamepos7;
				}
			}			
			elseif(is_null($request->file('upload_email_popup')))
			{
				if($request->input('container_image_pos_1')!="")
				{
					$container_image_pos_7 = $request->input('container_image_pos_1');
					$explode_imagepos7 = explode('/', $container_image_pos_7);
					$filename_pos7 = rand(11111, 99999).'-'. end($explode_imagepos7);
					$successfile7 = \File::copy($container_image_pos_7, $destinationPath.$filename_pos7);
					if($successfile7)
					{
						$actimgpath = $destinationPath.$filename_pos7;
						$actimgname = $filename_pos7;
					}
				}
			}
			
			
			$toouser['cc_email_popup'] = $ccemail;
			$toouser['subject'] = $subjectemail;
			$toouser['attchfle'] = $actimgpath;
			$emailArr['attchflename'] = $actimgname;
			$ucode = rand(11111111, 99999999).rand(11111111, 99999999);
			$emailArr['link'] = 'download-document/'.$ucode;
			$tempe = 'crm_email';
            
            $referral_code = strtoupper(uniqid());
            
			if($templateemail!='')
			{
				$tempe = $templateemail;
			}
            
            $emailArr['byfirstname'] = \Auth::user()->first_name;
            $emailArr['bylastname'] = \Auth::user()->last_name;
            $emailArr['byemail'] = \Auth::user()->email;
            
            
            
            if($propertyId != ""){
                
                $expo_prop = explode(',', $propertyId);
                
                for($i=0; $i < count($expo_prop); $i++) {
                    
                    $toouser['email'] = $expo_to[$i];
                    
                    $lead_user = \DB::table('tb_users')->where('id', $expo_prop[$i])->first();
                    
                    $today =  date("Y-m-d");    
                    $emailArr['tofirstname'] = $lead_user->first_name;
                    $emailArr['tolastname'] = $lead_user->last_name;
                    $emailArr['todate'] = $today;
                    $expiry_date = date("Y-m-d", strtotime("+30 day", strtotime($today)));
                    $emailArr['todays'] = 30;
                    $emailArr['referral_code'] = $referral_code;            
                    
                    //echo view('user.emails.'.$tempe, $emailArr); die;
                     
        			\Mail::send('user.emails.'.$tempe, $emailArr, function($message) use ($toouser)
        			{
        				$message->from('sales@emporium-voyage.com', CNF_APPNAME);
        
        				$message->to( $toouser['email']);
                        //$message->to($expo_to[$i]);
        				if($toouser['cc_email_popup']!='')
        				{
        					$message->cc($toouser['cc_email_popup']);
        				}
        				$message->subject($toouser['subject']);
        			}); 
    			
        			$data['crm_id'] =  $expo_prop[$i];
        			$data['user_id'] = \Auth::user()->id;
        			$data['invitee_id'] = $expo_prop[$i];
        			$data['email_address'] = $expo_to[$i];
        			$data['cc_email_address'] = $ccemail;
        			$data['email_subject'] = $subjectemail;
        			$data['email_template'] = $templateemail;
        			$data['email_message'] = $request->input('message_email_popup');
        			$data['email_attachfile'] = $actimgname;
        			$data['email_uniquescode'] = $ucode;                    
        			$ins = \DB::table('tb_crm_emailcommunication')->insert($data);                
                
                    //$user = User::find(\Session::get('uid'));
                    $invitee_data['user_id'] = \Auth::user()->id;
                    $invitee_data['first_name'] = $lead_user->first_name;
                    $invitee_data['last_name'] = $lead_user->last_name;;            
                    $invitee_data['email'] = $lead_user->email;
                    $invitee_data['message'] = $request->input('message_email_popup');
                    $invitee_data['referral_code'] = $referral_code;
                    $invitee_data['created'] = $today;
                    
                    $invitee_data['expired_on'] = $expiry_date;
                    
                    $inviteeId = \DB::table('tb_invitee')->insertGetId($invitee_data);
                 }    
            }
            
			$ret['status'] = "success";
		}
		else{
			$ret['status'] = "error";
		}
		return $ret;
    }
    public function getHotellisting(Request $request){
        /*$this->data['access']		= $this->access;
        $this->data['i']=0;
        $this->data['rowData'] = \DB::table('tb_properties')->where('property_status', 1)->simplePaginate(static::$per_page);;
        //print_r($properties);
        return view('crmhotel.hotellisting',$this->data);*/
        
        if ($this->access['is_view'] == 0)
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');

        $sort = (!is_null($request->input('sort')) ? $request->input('sort') : (!is_null($request->input('search')) ? 'id' : 'property_status'));
        $order = (!is_null($request->input('order')) ? $request->input('order') : 'desc');
        // End Filter sort and order for query 
        // Filter Search for query		
        $filter = (!is_null($request->input('search')) ? $this->buildSearch() : '');
        $filter .= " AND tb_properties.property_status = '1'" ;
        
		$this->data['curntcat'] =  '';
		$this->data['curstatus'] =  '';
		if(!is_null($request->input('selcat')) && $request->input('selcat')!='')
		{
			$filter .= ' AND FIND_IN_SET('.$request->input('selcat').', property_category_id)';
			$this->data['curntcat'] = $request->input('selcat');
		}
		if(!is_null($request->input('selstatus')) && $request->input('selstatus')!='')
		{
			$pstatus = ($request->input('selstatus')=='active') ? 1 : 0;
			$filter .= ' AND property_status = '.$pstatus;
			$this->data['curstatus'] = $request->input('selstatus');
		}

        if(\Session::get('gid')!=1 && \Session::get('gid')!=2){
                $uid = \Auth::user()->id;

                $filter .= " AND user_id = '".$uid."'" ;

        }
        $page = $request->input('page', 1);
        $params = array(
            'page' => $page,
            'limit' => (!is_null($request->input('rows')) ? filter_var($request->input('rows'), FILTER_VALIDATE_INT) : static::$per_page ),
            'sort' => $sort,
            'order' => $order,
            'params' => $filter,
            'global' => (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
        );
        // Get Query 
        $results = $this->model->getRows($params);

        // Build pagination setting
        $page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;
        $pagination = new Paginator($results['rows'], $results['total'], $params['limit']);
        $pagination->setPath('hotellisting');
		
        $this->data['rowData'] = $results['rows'];
        // Build Pagination 
        $this->data['pagination'] = $pagination;
        // Build pager number and append current param GET
        $this->data['pager'] = $this->injectPaginate();
        // Row grid Number 
        $this->data['i'] = ($page * $params['limit']) - $params['limit'];
        // Grid Configuration 
        $this->data['tableGrid'] = $this->info['config']['grid'];
        $this->data['tableForm'] = $this->info['config']['forms'];
        $this->data['colspan'] = \SiteHelpers::viewColSpan($this->info['config']['grid']);
        // Group users permission
        $this->data['access'] = $this->access;
        // Detail from master if any
        // Master detail link if any 
        $this->data['subgrid'] = (isset($this->info['config']['subgrid']) ? $this->info['config']['subgrid'] : array());
        // Render into template
		$this->data['fetch_cat'] = \DB::table('tb_categories')->get();
        
        //$is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        //$file_name = (strlen($is_demo6) > 0)?$is_demo6.'.properties.index':'properties.index'; 
        
        return view('crmhotel.hotellisting',$this->data);
        
    }
    /*public function getHoteluserlisting(Request $request){
        $this->data['access']		= $this->access;
        $this->data['i']=0;
        $this->data['rowData'] = \DB::table('tb_users')->join('tb_groups', 'tb_groups.group_id', '=', 'tb_users.group_id')->where('tb_users.group_id', 5)->where('active', 1)->get();        
        return view('crmhotel.hoteluserlisting',$this->data);
    }*/
    /*public function getTravelleruserlisting(Request $request){
        $this->data['access']		= $this->access;
        $this->data['i']=0;
        $this->data['rowData'] = \DB::table('tb_users')->join('tb_groups', 'tb_groups.group_id', '=', 'tb_users.group_id')->where('tb_users.group_id', 3)->where('active', 1)->get();        
        return view('crmhotel.travelleruserlisting',$this->data);
    }*/
    public function getSearch( $mode = 'native')
	{        
		$this->data['tableForm'] 	= $this->info['config']['forms'];	
		$this->data['tableGrid'] 	= $this->info['config']['grid'];
		$this->data['searchMode'] = 'native';
		$this->data['pageUrl']		= url('crmhotel/hotellisting');
		return view('sximo.module.utility.search',$this->data);	
	}
    public function getHotelleadsearch( $mode = 'native')
	{        
		$this->data['tableForm'] 	= $this->info['config']['forms'];	
		$this->data['tableGrid'] 	= $this->info['config']['grid'];
		$this->data['searchMode'] = 'native';
		$this->data['pageUrl']		= url('crmhotel');
		return view('sximo.module.utility.search',$this->data);
	
	}	
    
    function getUpdate(Request $request, $id = null) {

        if ($id == '') {
            if ($this->access['is_add'] == 0)
                return Redirect::to('dashboard')->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');
        }

        if ($id != '') {
            if ($this->access['is_edit'] == 0)
                return Redirect::to('dashboard')->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');
        }

        $row = $this->model->find($id);
        if ($row) {
            $this->data['row'] = $row;
        } else {
            $this->data['row'] = $this->model->getColumnTable('tb_properties');
        }
        $this->data['fields'] = \SiteHelpers::fieldLang($this->info['config']['forms']);

        $this->data['id'] = $id;
        $fetch_cat = \DB::table('tb_categories')->get();
        $parent_cat = array();
        if (!empty($fetch_cat)) {
            foreach ($fetch_cat as $cat) {
                $parent_cat[$cat->id] = $cat;
            }
        }

        $this->data['categories'] = $parent_cat;

        $this->data['amenties'] = \DB::table('tb_amenities')->where('amenity_status', '1')->get();
        $this->data['designers'] = \DB::table('tb_designers')->where('designer_status', '1')->get();
		if(\Session::get('gid')!=1 && \Session::get('gid')!=2){
			$uid = \Auth::user()->id;
			$this->data['restaurants'] = \DB::table('tb_restaurants')->select('id', 'title')->where('user_id', $uid)->get();
			$this->data['bars'] = \DB::table('tb_bars')->select('id', 'title')->where('user_id', $uid)->get();
			$this->data['spas'] = \DB::table('tb_spas')->select('id', 'title')->where('user_id', $uid)->get();
		}
		else
		{
			$this->data['restaurants'] = \DB::table('tb_restaurants')->select('id', 'title')->get();
			$this->data['bars'] = \DB::table('tb_bars')->select('id', 'title')->get();
			$this->data['spas'] = \DB::table('tb_spas')->select('id', 'title')->get();
		}
        $row_reservations = \DB::select(\DB::raw("SELECT COUNT(*) AS total_reservations FROM tb_reservations WHERE property_id = '$id' "));
        $row_reserved_rooms = \DB::select(\DB::raw("SELECT COUNT(*) AS total_reserved_rooms FROM td_reserved_rooms LEFT JOIN tb_reservations ON tb_reservations.id = td_reserved_rooms.reservation_id WHERE tb_reservations.property_id = '$id' "));
        $row_turnover = \DB::select(\DB::raw("SELECT SUM(number_of_nights * price) AS total_turnover FROM td_reserved_rooms LEFT JOIN tb_reservations ON tb_reservations.id = td_reserved_rooms.reservation_id WHERE tb_reservations.property_id = '$id' "));
		
		$this->data['total_turnover'] = 0;
		$this->data['total_reservations'] = 0;
		$this->data['total_commissions'] =0;
		$this->data['total_rooms_booked'] =0;
		if ($id != '') {
			$this->data['total_turnover'] = (isset($row_turnover[0]->total_turnover))? $row_turnover[0]->total_turnover : 0;
			$this->data['total_reservations'] = (isset($row_reservations[0]->total_reservations))? $row_reservations[0]->total_reservations : 0;
			$this->data['total_commissions'] = (isset($row_turnover[0]->total_turnover))? ($row_turnover[0]->total_turnover * ($this->data['row']->commission / 100)) : 0;
			$this->data['total_rooms_booked'] = (isset($row_reserved_rooms[0]->total_reserved_rooms))? $row_reserved_rooms[0]->total_reserved_rooms : 0;
		}
        
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.crmhotel.form':'crmhotel.form'; 
        //echo $file_name; die;
        return view($file_name, $this->data);
    }
    function postSave(Request $request) {
        $uid = \Auth::user()->id;
        $id = $request->input('id');
        $rules = $this->validateForm();
        $rules['owner_name'] = 'required';
        $rules['owner_last_name'] = 'required';
        $rules['owner_address'] = 'required';
        $rules['owner_city'] = 'required';
        $rules['owner_postal_code'] = 'required';
        $rules['owner_country'] = 'required';
        $rules['owner_phone_primary'] = 'required';
        $rules['owner_email_primary'] = 'required';
        /* if($request->input('owner_contact_person')!='Owner')
          {
          $rules['agent_name'] = 'required';
          $rules['agent_last_name'] = 'required';
          $rules['agent_address'] = 'required';
          $rules['agent_city'] = 'required';
          $rules['agent_postal_code'] = 'required';
          $rules['agent_country'] = 'required';
          $rules['agent_phone_primary'] = 'required';
          $rules['agent_phone_emergency'] = 'required';
          $rules['agent_email_primary'] = 'required';
          $rules['agent_email_secondary'] = 'required';
          $rules['agent_website'] = 'required';
          } */
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $data = $this->validatePost('tb_properties');
            $alias = \SiteHelpers::seoUrl(Input::get('property_short_name'));
            $exha = false;
            for ($f = 1; $exha != true; $f++) {
                if ($request->input('id') == '') {
                    $check_alias = \DB::table('tb_properties')->where('property_slug', $alias)->count();
                } else {
                    $check_alias = \DB::table('tb_properties')->where('property_slug', $alias)->where('id', '!=', $id)->count();
                }
                if ($check_alias > 0) {
                    $alias = $alias . '-' . $f;
                } else {
                    $alias = $alias;
                    $exha = true;
                }
            }
            $data['user_id'] = $uid;
            $data['property_slug'] = $alias;

            if ($request->input('id') == '') {
                $data['created'] = date('Y-m-d h:i:s');
            } else {
                $data['updated'] = date('Y-m-d h:i:s');
            }

            $data['commission'] = $request->input('commission');
            $data['about_property'] = $request->input('about_property');
            $data['property_usp'] = $request->input('property_usp');
            $data['detail_section1_title'] = $request->input('detail_section1_title');
            $data['detail_section1_description_box1'] = $request->input('detail_section1_description_box1');
            $data['detail_section1_description_box2'] = $request->input('detail_section1_description_box2');
            $data['detail_section2_title'] = $request->input('detail_section2_title');
            $data['detail_section2_description_box1'] = $request->input('detail_section2_description_box1');
            $data['detail_section2_description_box2'] = $request->input('detail_section2_description_box2');
            $data['assign_detail_city'] = $request->input('assign_detail_city');

            $data['social_status'] = $request->input('social_status');
            $data['social_facebook'] = $request->input('social_facebook');
            $data['social_twitter'] = $request->input('social_twitter');
            $data['social_google'] = $request->input('social_google');
            $data['social_youtube'] = $request->input('social_youtube');
            $data['social_pinterest'] = $request->input('social_pinterest');
            $data['social_vimeo'] = $request->input('social_vimeo');
            $data['social_instagram'] = $request->input('social_instagram');

            if (!empty($request->input('assigned_amenities'))) {
                $data['assign_amenities'] = implode(',', $request->input('assigned_amenities'));
            } else {
                $data['assign_amenities'] = '';
            }

            if (!is_null($request->input('copy_amenities_rooms'))) {
                $data['copy_amenities_rooms'] = $request->input('copy_amenities_rooms');
            } else {
                $data['copy_amenities_rooms'] = 0;
            }

            if (!is_null($request->input('default_seasons'))) {
                $data['default_seasons'] = $request->input('default_seasons');
            } else {
                $data['default_seasons'] = 0;
            }
			
			if (!is_null($request->input('feature_property'))) {
                $data['feature_property'] = $request->input('feature_property');
            } else {
                $data['feature_property'] = 0;
            }
			
			if (!is_null($request->input('editor_choice_property'))) {
                $data['editor_choice_property'] = $request->input('editor_choice_property');
            } else {
                $data['editor_choice_property'] = 0;
            }

            if (!empty($request->input('destinations'))) {
                $data['property_category_id'] = implode(',', $request->input('destinations'));
            } else {
                $data['property_category_id'] = '';
            }
			
			if (!empty($request->input('spaids'))) {
                $data['spa_ids'] = implode(',', $request->input('spaids'));
            } else {
                $data['spa_ids'] = '';
            }
			
			if (!empty($request->input('restaurantids'))) {
                $data['restaurant_ids'] = implode(',', $request->input('restaurantids'));
            } else {
                $data['restaurant_ids'] = '';
            }
			
			if (!empty($request->input('barids'))) {
                $data['bar_ids'] = implode(',', $request->input('barids'));
            } else {
                $data['bar_ids'] = '';
            }

            $data['owner_name'] = $request->input('owner_name');
            $data['owner_last_name'] = $request->input('owner_last_name');
            $data['owner_address'] = $request->input('owner_address');
            $data['owner_city'] = $request->input('owner_city');
            $data['owner_postal_code'] = $request->input('owner_postal_code');
            $data['owner_country'] = $request->input('owner_country');
            $data['owner_phone_primary'] = $request->input('owner_phone_primary');
            $data['owner_phone_emergency'] = $request->input('owner_phone_emergency');
            $data['owner_email_primary'] = $request->input('owner_email_primary');
            $data['owner_email_secondary'] = $request->input('owner_email_secondary');
            $data['owner_website'] = $request->input('owner_website');
            $data['owner_contact_person'] = $request->input('owner_contact_person');
            /* if($request->input('owner_contact_person')!='Owner')
              {
              $data['agent_name'] = $request->input('agent_name');
              $data['agent_last_name'] = $request->input('agent_last_name');
              $data['agent_address'] = $request->input('agent_address');
              $data['agent_city'] = $request->input('agent_city');
              $data['agent_postal_code'] = $request->input('agent_postal_code');
              $data['agent_country'] = $request->input('agent_country');
              $data['agent_phone_primary'] = $request->input('agent_phone_primary');
              $data['agent_phone_emergency'] = $request->input('agent_phone_emergency');
              $data['agent_email_primary'] = $request->input('agent_email_primary');
              $data['agent_email_secondary'] = $request->input('agent_email_secondary');
              $data['agent_website'] = $request->input('agent_website');
              $data['agent_linked_in'] = $request->input('agent_linked_in');
              } */


            // Yachts info tab
            if ($request->input('property_type') == 'Yachts') {
                $yacht_category = $request->input('yacht_category');
                $data['yacht_category'] = implode(', ', $yacht_category);
                $data['yacht_build_year'] = $request->input('yacht_build_year');
                $data['yachts_guest'] = $request->input('yachts_guest');
                $data['yacht_length'] = $request->input('yacht_length');
                if (!empty($request->input('yacht_builder'))) {
                    $data['yacht_builder'] = implode(',', $request->input('yacht_builder'));
                }
                $data['yacht_beam'] = $request->input('yacht_beam');
                $data['yacht_draft'] = $request->input('yacht_draft');
                $data['yacht_grt'] = $request->input('yacht_grt');
                $data['yacht_cabins'] = $request->input('yacht_cabins');
                $data['yacht_crew'] = $request->input('yacht_crew');
                $data['yacht_for_sale'] = $request->input('yacht_for_sale');
                $data['yacht_for_charter'] = $request->input('yacht_for_charter');
            }

            $destinationPath = public_path() . '/uploads/properties_subtab_imgs/';

            //room & suites tab
            $data['rooms_suites_title'] = $request->input('rooms_suites_title');
            $data['rooms_suites_desciription'] = $request->input('rooms_suites_desciription');
            if ($request->input('rooms_suites_video_type') != '') {
                $data['rooms_suites_video_type'] = $request->input('rooms_suites_video_type');
            }
            if ($request->input('rooms_suites_video_link_type') != '') {
                $data['rooms_suites_video_link_type'] = $request->input('rooms_suites_video_link_type');
            }
            $data['rooms_suites_video_link'] = $request->input('rooms_suites_video_link');
            if (!is_null($request->file('rooms_suites_image'))) {
                $file = $request->file('rooms_suites_image');
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension(); //if you need extension of the file
                $room_suites_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $extension;
                $uploadSuccess = $file->move($destinationPath, $room_suites_filename);
                if ($uploadSuccess) {
                    $data['rooms_suites_image'] = $room_suites_filename;
                }
            }

            if (!is_null($request->file('rooms_suites_video'))) {
                $room_suites_vfile = $request->file('rooms_suites_video');
                $room_suites_vfilename = $room_suites_vfile->getClientOriginalName();
                $room_suites_vextension = $room_suites_vfile->getClientOriginalExtension(); //if you need extension of the file
                $room_suites_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $room_suites_vextension;
                $room_suites_vuploadSuccess = $room_suites_vfile->move($destinationPath, $room_suites_videofilename);
                if ($room_suites_vuploadSuccess) {
                    $data['rooms_suites_video'] = $room_suites_videofilename;
                }
            }
            //room & suites end
            // Architechure 
            $data['architecture_title'] = $request->input('architecture_title');
            $data['architecture_desciription'] = $request->input('architecture_desciription');
            if ($request->input('architecture_video_type') != '') {
                $data['architecture_video_type'] = $request->input('architecture_video_type');
            }
            if ($request->input('architecture_video_link_type') != '') {
                $data['architecture_video_link_type'] = $request->input('architecture_video_link_type');
            }
            $data['architecture_video_link'] = $request->input('architecture_video_link');
            if (!empty($request->input('assigned_architecture_designer'))) {
                $data['assigned_architecture_designer'] = implode(',', $request->input('assigned_architecture_designer'));
            }
            if (!is_null($request->file('architecture_image'))) {
                $architecture_file = $request->file('architecture_image');
                $architecture_filename = $architecture_file->getClientOriginalName();
                $architecture_extension = $architecture_file->getClientOriginalExtension(); //if you need extension of the file
                $architecture_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_extension;
                $architecture_uploadSuccess = $architecture_file->move($destinationPath, $architecture_filename);
                if ($architecture_uploadSuccess) {
                    $data['architecture_image'] = $architecture_filename;
                }
            }

            if (!is_null($request->file('architecture_video'))) {
                $architecture_vfile = $request->file('architecture_video');
                $architecture_vfilename = $architecture_vfile->getClientOriginalName();
                $architecture_vextension = $architecture_vfile->getClientOriginalExtension(); //if you need extension of the file
                $architecture_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_vextension;
                $architecture_vuploadSuccess = $architecture_vfile->move($destinationPath, $architecture_videofilename);
                if ($architecture_vuploadSuccess) {
                    $data['architecture_video'] = $architecture_videofilename;
                }
            }

            // Design 
            $data['architecture_design_title'] = $request->input('architecture_design_title');
            $data['architecture_design_desciription'] = $request->input('architecture_design_desciription');
            $data['architecture_design_url'] = $request->input('architecture_design_url');
            if ($request->input('architecture_design_video_type') != '') {
                $data['architecture_design_video_type'] = $request->input('architecture_design_video_type');
            }
            if ($request->input('architecture_design_video_link_type') != '') {
                $data['architecture_design_video_link_type'] = $request->input('architecture_design_video_link_type');
            }
            $data['architecture_design_video_link'] = $request->input('architecture_design_video_link');
            if (!is_null($request->file('architecture_design_image'))) {
                $architecture_design_file = $request->file('architecture_design_image');
                $architecture_design_filename = $architecture_design_file->getClientOriginalName();
                $architecture_design_extension = $architecture_design_file->getClientOriginalExtension(); //if you need extension of the file
                $architecture_design_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_design_extension;
                $architecture_design_uploadSuccess = $architecture_design_file->move($destinationPath, $architecture_design_filename);
                if ($architecture_design_uploadSuccess) {
                    $data['architecture_design_image'] = $architecture_design_filename;
                }
            }

            if (!is_null($request->file('architecture_design_video'))) {
                $architecture_design_vfile = $request->file('architecture_designer_video');
                $architecture_design_vfilename = $architecture_design_vfile->getClientOriginalName();
                $architecture_design_vextension = $architecture_design_vfile->getClientOriginalExtension(); //if you need extension of the file
                $architecture_design_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_design_vextension;
                $architecture_design_vuploadSuccess = $architecture_design_vfile->move($destinationPath, $architecture_design_videofilename);
                if ($architecture_design_vuploadSuccess) {
                    $data['architecture_design_video'] = $architecture_design_videofilename;
                }
            }

            // Designer
            $data['architecture_designer_title'] = $request->input('architecture_designer_title');
            $data['architecture_designer_desciription'] = $request->input('architecture_designer_desciription');
            $data['architecture_designer_url'] = $request->input('architecture_designer_url');
            if (!empty($request->input('architecture_designer_designer'))) {
                $data['architecture_designer_designer'] = implode(',', $request->input('architecture_designer_designer'));
            }
            if ($request->input('architecture_designer_video_type') != '') {
                $data['architecture_designer_video_type'] = $request->input('architecture_designer_video_type');
            }
            if ($request->input('architecture_designer_video_link_type') != '') {
                $data['architecture_designer_video_link_type'] = $request->input('architecture_designer_video_link_type');
            }
            $data['architecture_designer_video_link'] = $request->input('architecture_designer_video_link');

            if (!is_null($request->file('architecture_designer_image'))) {
                $architecture_designer_file = $request->file('architecture_designer_image');
                $architecture_designer_filename = $architecture_designer_file->getClientOriginalName();
                $architecture_designer_extension = $architecture_designer_file->getClientOriginalExtension(); //if you need extension of the file
                $architecture_designer_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_designer_extension;
                $architecture_designer_uploadSuccess = $architecture_designer_file->move($destinationPath, $architecture_designer_filename);
                if ($architecture_designer_uploadSuccess) {
                    $data['architecture_designer_image'] = $architecture_designer_filename;
                }
            }

            if (!is_null($request->file('architecture_designer_video'))) {
                $architecture_designer_vfile = $request->file('architecture_designer_video');
                $architecture_designer_vfilename = $architecture_designer_vfile->getClientOriginalName();
                $architecture_designer_vextension = $architecture_designer_vfile->getClientOriginalExtension(); //if you need extension of the file
                $architecture_designer_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_designer_vextension;
                $architecture_designer_vuploadSuccess = $architecture_designer_vfile->move($destinationPath, $architecture_designer_videofilename);
                if ($architecture_designer_vuploadSuccess) {
                    $data['architecture_designer_video'] = $architecture_designer_videofilename;
                }
            }

            // Spas
            $data['spa_title'] = $request->input('spa_title');
            $data['spa_desciription'] = $request->input('spa_desciription');
            $data['spa_url'] = $request->input('spa_url');
            $data['spa_usp_text'] = $request->input('spa_usp_text');
            $data['spa_usp_person'] = $request->input('spa_usp_person');
            $data['spa_manager_text'] = $request->input('spa_manager_text');
            $data['spa_opening_hours'] = $request->input('spa_opening_hours');
            $data['spa_phone_number'] = $request->input('spa_phone_number');
            if (!empty($request->input('spa_designer'))) {
                $data['spa_designer'] = implode(',', $request->input('spa_designer'));
            }
            if ($request->input('spa_video_type') != '') {
                $data['spa_video_type'] = $request->input('spa_video_type');
            }
            if ($request->input('spa_video_link_type') != '') {
                $data['spa_video_link_type'] = $request->input('spa_video_link_type');
            }
            $data['spa_video_link'] = $request->input('spa_video_link');
            if (!is_null($request->file('spa_image1'))) {
                $spa_file = $request->file('spa_image1');
                $spa_filename = $spa_file->getClientOriginalName();
                $spa_extension = $spa_file->getClientOriginalExtension(); //if you need extension of the file
                $spa_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $spa_extension;
                $spa_uploadSuccess = $spa_file->move($destinationPath, $spa_filename);
                if ($spa_uploadSuccess) {
                    $data['spa_image1'] = $spa_filename;
                }
            }

            if (!is_null($request->file('spa_image2'))) {
                $spa_file2 = $request->file('spa_image2');
                $spa_filename2 = $spa_file2->getClientOriginalName();
                $spa_extension2 = $spa_file2->getClientOriginalExtension(); //if you need extension of the file
                $spa_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $spa_extension2;
                $spa_uploadSuccess2 = $spa_file2->move($destinationPath, $spa_filename2);
                if ($spa_uploadSuccess2) {
                    $data['spa_image2'] = $spa_filename2;
                }
            }

            if (!is_null($request->file('spa_image3'))) {
                $spa_file3 = $request->file('spa_image3');
                $spa_filename3 = $spa_file3->getClientOriginalName();
                $spa_extension3 = $spa_file3->getClientOriginalExtension(); //if you need extension of the file
                $spa_filename3 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $spa_extension3;
                $spa_uploadSuccess3 = $spa_file3->move($destinationPath, $spa_filename3);
                if ($spa_uploadSuccess3) {
                    $data['spa_image3'] = $spa_filename3;
                }
            }

            if (!is_null($request->file('spa_image4'))) {
                $spa_file4 = $request->file('spa_image4');
                $spa_filename4 = $spa_file4->getClientOriginalName();
                $spa_extension4 = $spa_file4->getClientOriginalExtension(); //if you need extension of the file
                $spa_filename4 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $spa_extension4;
                $spa_uploadSuccess4 = $spa_file4->move($destinationPath, $spa_filename4);
                if ($spa_uploadSuccess4) {
                    $data['spa_image4'] = $spa_filename4;
                }
            }

            if (!is_null($request->file('spa_video'))) {
                $spa_vfile = $request->file('spa_video');
                $spa_vfilename = $spa_vfile->getClientOriginalName();
                $spa_vextension = $spa_vfile->getClientOriginalExtension(); //if you need extension of the file
                $spa_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $spa_vextension;
                $spa_vuploadSuccess = $spa_vfile->move($destinationPath, $spa_videofilename);
                if ($spa_vuploadSuccess) {
                    $data['spa_video'] = $spa_videofilename;
                }
            }

            // Resturants
            $data['restaurant_title'] = $request->input('restaurant_title');
            $data['restaurant_desciription'] = $request->input('restaurant_desciription');
            $data['restaurant_url'] = $request->input('restaurant_url');
            $data['restaurant_usp_text'] = $request->input('restaurant_usp_text');
            $data['restaurant_usp_person'] = $request->input('restaurant_usp_person');
            if (!empty($request->input('restaurant_designer'))) {
                $data['restaurant_designer'] = implode(',', $request->input('restaurant_designer'));
            }
            if ($request->input('restaurant_video_type') != '') {
                $data['restaurant_video_type'] = $request->input('restaurant_video_type');
            }
            if ($request->input('restaurant_video_link_type') != '') {
                $data['restaurant_video_link_type'] = $request->input('restaurant_video_link_type');
            }
            $data['restaurant_video_link'] = $request->input('restaurant_video_link');
            if (!is_null($request->file('restaurant_image'))) {
                $restaurant_file = $request->file('restaurant_image');
                $restaurant_filename = $restaurant_file->getClientOriginalName();
                $restaurant_extension = $restaurant_file->getClientOriginalExtension(); //if you need extension of the file
                $restaurant_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant_extension;
                $restaurant_uploadSuccess = $restaurant_file->move($destinationPath, $restaurant_filename);
                if ($restaurant_uploadSuccess) {
                    $data['restaurant_image'] = $restaurant_filename;
                }
            }

            if (!is_null($request->file('restaurant_image2'))) {
                $restaurant_file2 = $request->file('restaurant_image2');
                $restaurant_filename2 = $restaurant_file2->getClientOriginalName();
                $restaurant_extension2 = $restaurant_file2->getClientOriginalExtension(); //if you need extension of the file
                $restaurant_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant_extension2;
                $restaurant_uploadSuccess2 = $restaurant_file2->move($destinationPath, $restaurant_filename2);
                if ($restaurant_uploadSuccess2) {
                    $data['restaurant_image2'] = $restaurant_filename2;
                }
            }

            if (!is_null($request->file('restaurant_video'))) {
                $restaurant_vfile = $request->file('restaurant_video');
                $restaurant_vfilename = $restaurant_vfile->getClientOriginalName();
                $restaurant_vextension = $restaurant_vfile->getClientOriginalExtension(); //if you need extension of the file
                $restaurant_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant_vextension;
                $restaurant_vuploadSuccess = $restaurant_vfile->move($destinationPath, $restaurant_videofilename);
                if ($restaurant_vuploadSuccess) {
                    $data['restaurant_video'] = $restaurant_videofilename;
                }
            }

            //resturant 2

            $data['restaurant2_title'] = $request->input('restaurant2_title');
            $data['restaurant2_desciription'] = $request->input('restaurant2_desciription');
            $data['restaurant2_url'] = $request->input('restaurant2_url');
            $data['restaurant2_usp_text'] = $request->input('restaurant2_usp_text');
            $data['restaurant2_usp_person'] = $request->input('restaurant2_usp_person');
            if (!empty($request->input('restaurant2_designer'))) {
                $data['restaurant2_designer'] = implode(',', $request->input('restaurant2_designer'));
            }
            if ($request->input('restaurant2_video_type') != '') {
                $data['restaurant2_video_type'] = $request->input('restaurant2_video_type');
            }
            if ($request->input('restaurant2_video_link_type') != '') {
                $data['restaurant2_video_link_type'] = $request->input('restaurant2_video_link_type');
            }
            $data['restaurant2_video_link'] = $request->input('restaurant2_video_link');
            if (!is_null($request->file('restaurant2_image'))) {
                $restaurant2_file = $request->file('restaurant2_image');
                $restaurant2_filename = $restaurant2_file->getClientOriginalName();
                $restaurant2_extension = $restaurant2_file->getClientOriginalExtension(); //if you need extension of the file
                $restaurant2_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant2_extension;
                $restaurant2_uploadSuccess = $restaurant2_file->move($destinationPath, $restaurant2_filename);
                if ($restaurant2_uploadSuccess) {
                    $data['restaurant2_image'] = $restaurant2_filename;
                }
            }

            if (!is_null($request->file('restaurant2_image2'))) {
                $restaurant2_file2 = $request->file('restaurant2_image2');
                $restaurant2_filename2 = $restaurant2_file2->getClientOriginalName();
                $restaurant2_extension2 = $restaurant2_file2->getClientOriginalExtension(); //if you need extension of the file
                $restaurant2_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant2_extension2;
                $restaurant2_uploadSuccess2 = $restaurant2_file2->move($destinationPath, $restaurant2_filename2);
                if ($restaurant2_uploadSuccess2) {
                    $data['restaurant2_image2'] = $restaurant2_filename2;
                }
            }

            if (!is_null($request->file('restaurant2_video'))) {
                $restaurant2_vfile = $request->file('restaurant2_video');
                $restaurant2_vfilename = $restaurant2_vfile->getClientOriginalName();
                $restaurant2_vextension = $restaurant2_vfile->getClientOriginalExtension(); //if you need extension of the file
                $restaurant2_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant2_vextension;
                $restaurant2_vuploadSuccess = $restaurant2_vfile->move($destinationPath, $restaurant2_videofilename);
                if ($restaurant2_vuploadSuccess) {
                    $data['restaurant2_video'] = $restaurant2_videofilename;
                }
            }
			
			//resturant 3

            $data['restaurant3_title'] = $request->input('restaurant3_title');
            $data['restaurant3_desciription'] = $request->input('restaurant3_desciription');
            $data['restaurant3_url'] = $request->input('restaurant3_url');
            $data['restaurant3_usp_text'] = $request->input('restaurant3_usp_text');
            $data['restaurant3_usp_person'] = $request->input('restaurant3_usp_person');
            if (!empty($request->input('restaurant3_designer'))) {
                $data['restaurant3_designer'] = implode(',', $request->input('restaurant3_designer'));
            }
            if ($request->input('restaurant3_video_type') != '') {
                $data['restaurant3_video_type'] = $request->input('restaurant3_video_type');
            }
            if ($request->input('restaurant3_video_link_type') != '') {
                $data['restaurant3_video_link_type'] = $request->input('restaurant3_video_link_type');
            }
            $data['restaurant3_video_link'] = $request->input('restaurant3_video_link');
            if (!is_null($request->file('restaurant3_image'))) {
                $restaurant3_file = $request->file('restaurant3_image');
                $restaurant3_filename = $restaurant3_file->getClientOriginalName();
                $restaurant3_extension = $restaurant3_file->getClientOriginalExtension(); //if you need extension of the file
                $restaurant3_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant3_extension;
                $restaurant3_uploadSuccess = $restaurant3_file->move($destinationPath, $restaurant3_filename);
                if ($restaurant3_uploadSuccess) {
                    $data['restaurant3_image'] = $restaurant3_filename;
                }
            }

            if (!is_null($request->file('restaurant3_image2'))) {
                $restaurant3_file2 = $request->file('restaurant3_image2');
                $restaurant3_filename2 = $restaurant3_file2->getClientOriginalName();
                $restaurant3_extension2 = $restaurant3_file2->getClientOriginalExtension(); //if you need extension of the file
                $restaurant3_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant3_extension2;
                $restaurant3_uploadSuccess2 = $restaurant3_file2->move($destinationPath, $restaurant3_filename2);
                if ($restaurant3_uploadSuccess2) {
                    $data['restaurant3_image2'] = $restaurant3_filename2;
                }
            }

            if (!is_null($request->file('restaurant3_video'))) {
                $restaurant3_vfile = $request->file('restaurant3_video');
                $restaurant3_vfilename = $restaurant3_vfile->getClientOriginalName();
                $restaurant3_vextension = $restaurant3_vfile->getClientOriginalExtension(); //if you need extension of the file
                $restaurant3_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant3_vextension;
                $restaurant3_vuploadSuccess = $restaurant3_vfile->move($destinationPath, $restaurant3_videofilename);
                if ($restaurant3_vuploadSuccess) {
                    $data['restaurant3_video'] = $restaurant3_videofilename;
                }
            }

            // bar
            $data['bar_title'] = $request->input('bar_title');
            $data['bar_sub_title'] = $request->input('bar_sub_title');
            $data['bar_desciription'] = $request->input('bar_desciription');
            $data['bar_url'] = $request->input('bar_url');
            $data['bar_usp_text'] = $request->input('bar_usp_text');
            $data['bar_usp_person'] = $request->input('bar_usp_person');
            if (!empty($request->input('bar_designer'))) {
                $data['bar_designer'] = implode(',', $request->input('bar_designer'));
            }
            if ($request->input('bar_video_type') != '') {
                $data['bar_video_type'] = $request->input('bar_video_type');
            }
            if ($request->input('bar_video_link_type') != '') {
                $data['bar_video_link_type'] = $request->input('bar_video_link_type');
            }
            $data['bar_video_link'] = $request->input('bar_video_link');
            if (!is_null($request->file('bar_image'))) {
                $bar_file = $request->file('bar_image');
                $bar_filename = $bar_file->getClientOriginalName();
                $bar_extension = $bar_file->getClientOriginalExtension(); //if you need extension of the file
                $bar_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar_extension;
                $bar_uploadSuccess = $bar_file->move($destinationPath, $bar_filename);
                if ($bar_uploadSuccess) {
                    $data['bar_image'] = $bar_filename;
                }
            }

            if (!is_null($request->file('bar_image2'))) {
                $bar_file2 = $request->file('bar_image2');
                $bar_filename2 = $bar_file2->getClientOriginalName();
                $bar_extension2 = $bar_file2->getClientOriginalExtension(); //if you need extension of the file
                $bar_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar_extension2;
                $bar_uploadSuccess2 = $bar_file2->move($destinationPath, $bar_filename2);
                if ($bar_uploadSuccess2) {
                    $data['bar_image2'] = $bar_filename2;
                }
            }

            if (!is_null($request->file('bar_image3'))) {
                $bar_file3 = $request->file('bar_image3');
                $bar_filename3 = $bar_file3->getClientOriginalName();
                $bar_extension3 = $bar_file3->getClientOriginalExtension(); //if you need extension of the file
                $bar_filename3 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar_extension3;
                $bar_uploadSuccess3 = $bar_file3->move($destinationPath, $bar_filename3);
                if ($bar_uploadSuccess3) {
                    $data['bar_image3'] = $bar_filename3;
                }
            }

            if (!is_null($request->file('bar_video'))) {
                $bar_vfile = $request->file('bar_video');
                $bar_vfilename = $bar_vfile->getClientOriginalName();
                $bar_vextension = $bar_vfile->getClientOriginalExtension(); //if you need extension of the file
                $bar_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar_vextension;
                $bar_vuploadSuccess = $bar_vfile->move($destinationPath, $bar_videofilename);
                if ($bar_vuploadSuccess) {
                    $data['bar_video'] = $bar_videofilename;
                }
            }
			
			// bar 2
            $data['bar2_title'] = $request->input('bar2_title');
            $data['bar2_sub_title'] = $request->input('bar2_sub_title');
            $data['bar2_desciription'] = $request->input('bar2_desciription');
            $data['bar2_url'] = $request->input('bar2_url');
            $data['bar2_usp_text'] = $request->input('bar2_usp_text');
            $data['bar2_usp_person'] = $request->input('bar2_usp_person');
            if (!empty($request->input('bar2_designer'))) {
                $data['bar2_designer'] = implode(',', $request->input('bar2_designer'));
            }
            if ($request->input('bar2_video_type') != '') {
                $data['bar2_video_type'] = $request->input('bar2_video_type');
            }
            if ($request->input('bar2_video_link_type') != '') {
                $data['bar2_video_link_type'] = $request->input('bar2_video_link_type');
            }
            $data['bar2_video_link'] = $request->input('bar2_video_link');
            if (!is_null($request->file('bar2_image'))) {
                $bar2_file = $request->file('bar2_image');
                $bar2_filename = $bar2_file->getClientOriginalName();
                $bar2_extension = $bar2_file->getClientOriginalExtension(); //if you need extension of the file
                $bar2_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar2_extension;
                $bar2_uploadSuccess = $bar2_file->move($destinationPath, $bar2_filename);
                if ($bar2_uploadSuccess) {
                    $data['bar2_image'] = $bar2_filename;
                }
            }

            if (!is_null($request->file('bar2_image2'))) {
                $bar2_file2 = $request->file('bar2_image2');
                $bar2_filename2 = $bar2_file2->getClientOriginalName();
                $bar2_extension2 = $bar2_file2->getClientOriginalExtension(); //if you need extension of the file
                $bar2_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar2_extension2;
                $bar2_uploadSuccess2 = $bar2_file2->move($destinationPath, $bar2_filename2);
                if ($bar2_uploadSuccess2) {
                    $data['bar2_image2'] = $bar2_filename2;
                }
            }

            if (!is_null($request->file('bar2_image3'))) {
                $bar2_file3 = $request->file('bar2_image3');
                $bar2_filename3 = $bar2_file3->getClientOriginalName();
                $bar2_extension3 = $bar2_file3->getClientOriginalExtension(); //if you need extension of the file
                $bar2_filename3 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar2_extension3;
                $bar2_uploadSuccess3 = $bar2_file3->move($destinationPath, $bar2_filename3);
                if ($bar2_uploadSuccess3) {
                    $data['bar2_image3'] = $bar2_filename3;
                }
            }

            if (!is_null($request->file('bar2_video'))) {
                $bar2_vfile = $request->file('bar2_video');
                $bar2_vfilename = $bar2_vfile->getClientOriginalName();
                $bar2_vextension = $bar2_vfile->getClientOriginalExtension(); //if you need extension of the file
                $bar2_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar2_vextension;
                $bar2_vuploadSuccess = $bar2_vfile->move($destinationPath, $bar2_videofilename);
                if ($bar2_vuploadSuccess) {
                    $data['bar2_video'] = $bar2_videofilename;
                }
            }
			
			// bar 3
            $data['bar3_title'] = $request->input('bar3_title');
            $data['bar3_sub_title'] = $request->input('bar3_sub_title');
            $data['bar3_desciription'] = $request->input('bar3_desciription');
            $data['bar3_url'] = $request->input('bar3_url');
            $data['bar3_usp_text'] = $request->input('bar3_usp_text');
            $data['bar3_usp_person'] = $request->input('bar3_usp_person');
            if (!empty($request->input('bar3_designer'))) {
                $data['bar3_designer'] = implode(',', $request->input('bar3_designer'));
            }
            if ($request->input('bar3_video_type') != '') {
                $data['bar3_video_type'] = $request->input('bar3_video_type');
            }
            if ($request->input('bar3_video_link_type') != '') {
                $data['bar3_video_link_type'] = $request->input('bar3_video_link_type');
            }
            $data['bar3_video_link'] = $request->input('bar3_video_link');
            if (!is_null($request->file('bar3_image'))) {
                $bar3_file = $request->file('bar3_image');
                $bar3_filename = $bar3_file->getClientOriginalName();
                $bar3_extension = $bar3_file->getClientOriginalExtension(); //if you need extension of the file
                $bar3_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar3_extension;
                $bar3_uploadSuccess = $bar3_file->move($destinationPath, $bar3_filename);
                if ($bar3_uploadSuccess) {
                    $data['bar3_image'] = $bar3_filename;
                }
            }

            if (!is_null($request->file('bar3_image2'))) {
                $bar3_file2 = $request->file('bar3_image2');
                $bar3_filename2 = $bar3_file2->getClientOriginalName();
                $bar3_extension2 = $bar3_file2->getClientOriginalExtension(); //if you need extension of the file
                $bar3_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar3_extension2;
                $bar3_uploadSuccess2 = $bar3_file2->move($destinationPath, $bar3_filename2);
                if ($bar3_uploadSuccess2) {
                    $data['bar3_image2'] = $bar3_filename2;
                }
            }

            if (!is_null($request->file('bar3_image3'))) {
                $bar3_file3 = $request->file('bar3_image3');
                $bar3_filename3 = $bar3_file3->getClientOriginalName();
                $bar3_extension3 = $bar3_file3->getClientOriginalExtension(); //if you need extension of the file
                $bar3_filename3 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar3_extension3;
                $bar3_uploadSuccess3 = $bar3_file3->move($destinationPath, $bar3_filename3);
                if ($bar3_uploadSuccess3) {
                    $data['bar3_image3'] = $bar3_filename3;
                }
            }

            if (!is_null($request->file('bar3_video'))) {
                $bar3_vfile = $request->file('bar3_video');
                $bar3_vfilename = $bar3_vfile->getClientOriginalName();
                $bar3_vextension = $bar3_vfile->getClientOriginalExtension(); //if you need extension of the file
                $bar3_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar3_vextension;
                $bar3_vuploadSuccess = $bar3_vfile->move($destinationPath, $bar3_videofilename);
                if ($bar3_vuploadSuccess) {
                    $data['bar3_video'] = $bar3_videofilename;
                }
            }

            // Video section
            $data['video_title'] = $request->input('video_title');
            $data['video_desciription'] = $request->input('video_desciription');
            $data['video_sub_title'] = $request->input('video_sub_title');
            if ($request->input('video_type') != '') {
                $data['video_type'] = $request->input('video_type');
            }
            if ($request->input('video_link_type') != '') {
                $data['video_link_type'] = $request->input('video_link_type');
            }
            $data['video_link'] = $request->input('video_link');
            if (!is_null($request->file('video_image'))) {
                $video_file = $request->file('video_image');
                $video_filename = $video_file->getClientOriginalName();
                $video_extension = $video_file->getClientOriginalExtension(); //if you need extension of the file
                $video_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $video_extension;
                $video_uploadSuccess = $video_file->move($destinationPath, $video_filename);
                if ($video_uploadSuccess) {
                    $data['video_image'] = $video_filename;
                }
            }

            if (!is_null($request->file('video_video'))) {
                $video_vfile = $request->file('video_video');
                $video_vfilename = $video_vfile->getClientOriginalName();
                $video_vextension = $video_vfile->getClientOriginalExtension(); //if you need extension of the file
                $video_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $video_vextension;
                $video_vuploadSuccess = $video_vfile->move($destinationPath, $video_videofilename);
                if ($video_vuploadSuccess) {
                    $data['video_video'] = $video_videofilename;
                }
            }

            $id = $this->model->insertRow($data, $request->input('id'));

            if (!is_null($request->input('copy_amenities_rooms')) && !empty($request->input('assigned_amenities'))) {
                $check_pcats = \DB::table('tb_properties_category_types')->where('property_id', $id)->get();
                if (!empty($check_pcats)) {
                    foreach ($check_pcats as $pcats) {
                        $check_pcats_exist = \DB::table('tb_properties_category_amenities')->where('property_id', $id)->where('cat_id', $pcats->id)->first();
                        $Amdata['property_id'] = $id;
                        $Amdata['cat_id'] = $pcats->id;
                        $Amdata['user_id'] = $uid;
                        $Amdata['amenity_ids'] = implode(',', $request->input('assigned_amenities'));
                        if (!empty($check_pcats_exist)) {
                            $Amdata['updated'] = date('Y-m-d h:i:s');
                            \DB::table('tb_properties_category_amenities')->where('id', $check_pcats_exist->id)->update($Amdata);
                        } else {
                            $Amdata['created'] = date('Y-m-d h:i:s');
                            \DB::table('tb_properties_category_amenities')->insertGetId($Amdata);
                        }
                    }
                }
            }


            if (!is_null($request->input('apply'))) {
                $return = 'crmhotel/update/' . $id . '?return=' . self::returnUrl();
            } else {
                $return = 'crmhotel/hotellisting?return=' . self::returnUrl();
            }

            // Insert logs into database
            if ($request->input('id') == '') {
                \SiteHelpers::auditTrail($request, 'New Data with ID ' . $id . ' Has been Inserted !');
            } else {
                \SiteHelpers::auditTrail($request, 'Data with ID ' . $id . ' Has been Updated !');
            }

            return Redirect::to($return)->with('messagetext', \Lang::get('core.note_success'))->with('msgstatus', 'success');
        } else {

            return Redirect::to('crmhotel/update/' . $id)->with('messagetext', \Lang::get('core.note_error'))->with('msgstatus', 'error')
                            ->withErrors($validator)->withInput();
        }
    }
    function getLeadupdate(Request $request, $id = null) {

        if ($id == '') {
            if ($this->access['is_add'] == 0)
                return Redirect::to('dashboard')->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');
        }

        if ($id != '') {
            if ($this->access['is_edit'] == 0)
                return Redirect::to('dashboard')->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');
        }

        $row = $this->model->find($id);
        if ($row) {
            $this->data['row'] = $row;
        } else {
            $this->data['row'] = $this->model->getColumnTable('tb_properties');
        }
        $this->data['fields'] = \SiteHelpers::fieldLang($this->info['config']['forms']);

        $this->data['id'] = $id;
        $fetch_cat = \DB::table('tb_categories')->get();
        $parent_cat = array();
        if (!empty($fetch_cat)) {
            foreach ($fetch_cat as $cat) {
                $parent_cat[$cat->id] = $cat;
            }
        }

        $this->data['categories'] = $parent_cat;

        $this->data['amenties'] = \DB::table('tb_amenities')->where('amenity_status', '1')->get();
        $this->data['designers'] = \DB::table('tb_designers')->where('designer_status', '1')->get();
		if(\Session::get('gid')!=1 && \Session::get('gid')!=2){
			$uid = \Auth::user()->id;
			$this->data['restaurants'] = \DB::table('tb_restaurants')->select('id', 'title')->where('user_id', $uid)->get();
			$this->data['bars'] = \DB::table('tb_bars')->select('id', 'title')->where('user_id', $uid)->get();
			$this->data['spas'] = \DB::table('tb_spas')->select('id', 'title')->where('user_id', $uid)->get();
		}
		else
		{
			$this->data['restaurants'] = \DB::table('tb_restaurants')->select('id', 'title')->get();
			$this->data['bars'] = \DB::table('tb_bars')->select('id', 'title')->get();
			$this->data['spas'] = \DB::table('tb_spas')->select('id', 'title')->get();
		}
        $row_reservations = \DB::select(\DB::raw("SELECT COUNT(*) AS total_reservations FROM tb_reservations WHERE property_id = '$id' "));
        $row_reserved_rooms = \DB::select(\DB::raw("SELECT COUNT(*) AS total_reserved_rooms FROM td_reserved_rooms LEFT JOIN tb_reservations ON tb_reservations.id = td_reserved_rooms.reservation_id WHERE tb_reservations.property_id = '$id' "));
        $row_turnover = \DB::select(\DB::raw("SELECT SUM(number_of_nights * price) AS total_turnover FROM td_reserved_rooms LEFT JOIN tb_reservations ON tb_reservations.id = td_reserved_rooms.reservation_id WHERE tb_reservations.property_id = '$id' "));
		
		$this->data['total_turnover'] = 0;
		$this->data['total_reservations'] = 0;
		$this->data['total_commissions'] =0;
		$this->data['total_rooms_booked'] =0;
		if ($id != '') {
			$this->data['total_turnover'] = (isset($row_turnover[0]->total_turnover))? $row_turnover[0]->total_turnover : 0;
			$this->data['total_reservations'] = (isset($row_reservations[0]->total_reservations))? $row_reservations[0]->total_reservations : 0;
			$this->data['total_commissions'] = (isset($row_turnover[0]->total_turnover))? ($row_turnover[0]->total_turnover * ($this->data['row']->commission / 100)) : 0;
			$this->data['total_rooms_booked'] = (isset($row_reserved_rooms[0]->total_reserved_rooms))? $row_reserved_rooms[0]->total_reserved_rooms : 0;
		}
        
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.crmhotel.hotelleadupdate':'crmhotel.hotelleadupdate'; 
        //echo $file_name; die;
        return view($file_name, $this->data);
    }
    function postHotelleadsave(Request $request) {
        $uid = \Auth::user()->id;
        $id = $request->input('id');
        $rules = $this->validateForm();
        $rules['owner_name'] = 'required';
        $rules['owner_last_name'] = 'required';
        $rules['owner_address'] = 'required';
        $rules['owner_city'] = 'required';
        $rules['owner_postal_code'] = 'required';
        $rules['owner_country'] = 'required';
        $rules['owner_phone_primary'] = 'required';
        $rules['owner_email_primary'] = 'required';
        /* if($request->input('owner_contact_person')!='Owner')
          {
          $rules['agent_name'] = 'required';
          $rules['agent_last_name'] = 'required';
          $rules['agent_address'] = 'required';
          $rules['agent_city'] = 'required';
          $rules['agent_postal_code'] = 'required';
          $rules['agent_country'] = 'required';
          $rules['agent_phone_primary'] = 'required';
          $rules['agent_phone_emergency'] = 'required';
          $rules['agent_email_primary'] = 'required';
          $rules['agent_email_secondary'] = 'required';
          $rules['agent_website'] = 'required';
          } */
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $data = $this->validatePost('tb_properties');
            $alias = \SiteHelpers::seoUrl(Input::get('property_short_name'));
            $exha = false;
            for ($f = 1; $exha != true; $f++) {
                if ($request->input('id') == '') {
                    $check_alias = \DB::table('tb_properties')->where('property_slug', $alias)->count();
                } else {
                    $check_alias = \DB::table('tb_properties')->where('property_slug', $alias)->where('id', '!=', $id)->count();
                }
                if ($check_alias > 0) {
                    $alias = $alias . '-' . $f;
                } else {
                    $alias = $alias;
                    $exha = true;
                }
            }
            $data['user_id'] = $uid;
            $data['property_slug'] = $alias;

            if ($request->input('id') == '') {
                $data['created'] = date('Y-m-d h:i:s');
            } else {
                $data['updated'] = date('Y-m-d h:i:s');
            }

            $data['commission'] = $request->input('commission');
            $data['about_property'] = $request->input('about_property');
            $data['property_usp'] = $request->input('property_usp');
            $data['detail_section1_title'] = $request->input('detail_section1_title');
            $data['detail_section1_description_box1'] = $request->input('detail_section1_description_box1');
            $data['detail_section1_description_box2'] = $request->input('detail_section1_description_box2');
            $data['detail_section2_title'] = $request->input('detail_section2_title');
            $data['detail_section2_description_box1'] = $request->input('detail_section2_description_box1');
            $data['detail_section2_description_box2'] = $request->input('detail_section2_description_box2');
            $data['assign_detail_city'] = $request->input('assign_detail_city');

            $data['social_status'] = $request->input('social_status');
            $data['social_facebook'] = $request->input('social_facebook');
            $data['social_twitter'] = $request->input('social_twitter');
            $data['social_google'] = $request->input('social_google');
            $data['social_youtube'] = $request->input('social_youtube');
            $data['social_pinterest'] = $request->input('social_pinterest');
            $data['social_vimeo'] = $request->input('social_vimeo');
            $data['social_instagram'] = $request->input('social_instagram');

            if (!empty($request->input('assigned_amenities'))) {
                $data['assign_amenities'] = implode(',', $request->input('assigned_amenities'));
            } else {
                $data['assign_amenities'] = '';
            }

            if (!is_null($request->input('copy_amenities_rooms'))) {
                $data['copy_amenities_rooms'] = $request->input('copy_amenities_rooms');
            } else {
                $data['copy_amenities_rooms'] = 0;
            }

            if (!is_null($request->input('default_seasons'))) {
                $data['default_seasons'] = $request->input('default_seasons');
            } else {
                $data['default_seasons'] = 0;
            }
			
			if (!is_null($request->input('feature_property'))) {
                $data['feature_property'] = $request->input('feature_property');
            } else {
                $data['feature_property'] = 0;
            }
			
			if (!is_null($request->input('editor_choice_property'))) {
                $data['editor_choice_property'] = $request->input('editor_choice_property');
            } else {
                $data['editor_choice_property'] = 0;
            }

            if (!empty($request->input('destinations'))) {
                $data['property_category_id'] = implode(',', $request->input('destinations'));
            } else {
                $data['property_category_id'] = '';
            }
			
			if (!empty($request->input('spaids'))) {
                $data['spa_ids'] = implode(',', $request->input('spaids'));
            } else {
                $data['spa_ids'] = '';
            }
			
			if (!empty($request->input('restaurantids'))) {
                $data['restaurant_ids'] = implode(',', $request->input('restaurantids'));
            } else {
                $data['restaurant_ids'] = '';
            }
			
			if (!empty($request->input('barids'))) {
                $data['bar_ids'] = implode(',', $request->input('barids'));
            } else {
                $data['bar_ids'] = '';
            }

            $data['owner_name'] = $request->input('owner_name');
            $data['owner_last_name'] = $request->input('owner_last_name');
            $data['owner_address'] = $request->input('owner_address');
            $data['owner_city'] = $request->input('owner_city');
            $data['owner_postal_code'] = $request->input('owner_postal_code');
            $data['owner_country'] = $request->input('owner_country');
            $data['owner_phone_primary'] = $request->input('owner_phone_primary');
            $data['owner_phone_emergency'] = $request->input('owner_phone_emergency');
            $data['owner_email_primary'] = $request->input('owner_email_primary');
            $data['owner_email_secondary'] = $request->input('owner_email_secondary');
            $data['owner_website'] = $request->input('owner_website');
            $data['owner_contact_person'] = $request->input('owner_contact_person');
            /* if($request->input('owner_contact_person')!='Owner')
              {
              $data['agent_name'] = $request->input('agent_name');
              $data['agent_last_name'] = $request->input('agent_last_name');
              $data['agent_address'] = $request->input('agent_address');
              $data['agent_city'] = $request->input('agent_city');
              $data['agent_postal_code'] = $request->input('agent_postal_code');
              $data['agent_country'] = $request->input('agent_country');
              $data['agent_phone_primary'] = $request->input('agent_phone_primary');
              $data['agent_phone_emergency'] = $request->input('agent_phone_emergency');
              $data['agent_email_primary'] = $request->input('agent_email_primary');
              $data['agent_email_secondary'] = $request->input('agent_email_secondary');
              $data['agent_website'] = $request->input('agent_website');
              $data['agent_linked_in'] = $request->input('agent_linked_in');
              } */


            // Yachts info tab
            if ($request->input('property_type') == 'Yachts') {
                $yacht_category = $request->input('yacht_category');
                $data['yacht_category'] = implode(', ', $yacht_category);
                $data['yacht_build_year'] = $request->input('yacht_build_year');
                $data['yachts_guest'] = $request->input('yachts_guest');
                $data['yacht_length'] = $request->input('yacht_length');
                if (!empty($request->input('yacht_builder'))) {
                    $data['yacht_builder'] = implode(',', $request->input('yacht_builder'));
                }
                $data['yacht_beam'] = $request->input('yacht_beam');
                $data['yacht_draft'] = $request->input('yacht_draft');
                $data['yacht_grt'] = $request->input('yacht_grt');
                $data['yacht_cabins'] = $request->input('yacht_cabins');
                $data['yacht_crew'] = $request->input('yacht_crew');
                $data['yacht_for_sale'] = $request->input('yacht_for_sale');
                $data['yacht_for_charter'] = $request->input('yacht_for_charter');
            }

            $destinationPath = public_path() . '/uploads/properties_subtab_imgs/';

            //room & suites tab
            $data['rooms_suites_title'] = $request->input('rooms_suites_title');
            $data['rooms_suites_desciription'] = $request->input('rooms_suites_desciription');
            if ($request->input('rooms_suites_video_type') != '') {
                $data['rooms_suites_video_type'] = $request->input('rooms_suites_video_type');
            }
            if ($request->input('rooms_suites_video_link_type') != '') {
                $data['rooms_suites_video_link_type'] = $request->input('rooms_suites_video_link_type');
            }
            $data['rooms_suites_video_link'] = $request->input('rooms_suites_video_link');
            if (!is_null($request->file('rooms_suites_image'))) {
                $file = $request->file('rooms_suites_image');
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension(); //if you need extension of the file
                $room_suites_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $extension;
                $uploadSuccess = $file->move($destinationPath, $room_suites_filename);
                if ($uploadSuccess) {
                    $data['rooms_suites_image'] = $room_suites_filename;
                }
            }

            if (!is_null($request->file('rooms_suites_video'))) {
                $room_suites_vfile = $request->file('rooms_suites_video');
                $room_suites_vfilename = $room_suites_vfile->getClientOriginalName();
                $room_suites_vextension = $room_suites_vfile->getClientOriginalExtension(); //if you need extension of the file
                $room_suites_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $room_suites_vextension;
                $room_suites_vuploadSuccess = $room_suites_vfile->move($destinationPath, $room_suites_videofilename);
                if ($room_suites_vuploadSuccess) {
                    $data['rooms_suites_video'] = $room_suites_videofilename;
                }
            }
            //room & suites end
            // Architechure 
            $data['architecture_title'] = $request->input('architecture_title');
            $data['architecture_desciription'] = $request->input('architecture_desciription');
            if ($request->input('architecture_video_type') != '') {
                $data['architecture_video_type'] = $request->input('architecture_video_type');
            }
            if ($request->input('architecture_video_link_type') != '') {
                $data['architecture_video_link_type'] = $request->input('architecture_video_link_type');
            }
            $data['architecture_video_link'] = $request->input('architecture_video_link');
            if (!empty($request->input('assigned_architecture_designer'))) {
                $data['assigned_architecture_designer'] = implode(',', $request->input('assigned_architecture_designer'));
            }
            if (!is_null($request->file('architecture_image'))) {
                $architecture_file = $request->file('architecture_image');
                $architecture_filename = $architecture_file->getClientOriginalName();
                $architecture_extension = $architecture_file->getClientOriginalExtension(); //if you need extension of the file
                $architecture_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_extension;
                $architecture_uploadSuccess = $architecture_file->move($destinationPath, $architecture_filename);
                if ($architecture_uploadSuccess) {
                    $data['architecture_image'] = $architecture_filename;
                }
            }

            if (!is_null($request->file('architecture_video'))) {
                $architecture_vfile = $request->file('architecture_video');
                $architecture_vfilename = $architecture_vfile->getClientOriginalName();
                $architecture_vextension = $architecture_vfile->getClientOriginalExtension(); //if you need extension of the file
                $architecture_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_vextension;
                $architecture_vuploadSuccess = $architecture_vfile->move($destinationPath, $architecture_videofilename);
                if ($architecture_vuploadSuccess) {
                    $data['architecture_video'] = $architecture_videofilename;
                }
            }

            // Design 
            $data['architecture_design_title'] = $request->input('architecture_design_title');
            $data['architecture_design_desciription'] = $request->input('architecture_design_desciription');
            $data['architecture_design_url'] = $request->input('architecture_design_url');
            if ($request->input('architecture_design_video_type') != '') {
                $data['architecture_design_video_type'] = $request->input('architecture_design_video_type');
            }
            if ($request->input('architecture_design_video_link_type') != '') {
                $data['architecture_design_video_link_type'] = $request->input('architecture_design_video_link_type');
            }
            $data['architecture_design_video_link'] = $request->input('architecture_design_video_link');
            if (!is_null($request->file('architecture_design_image'))) {
                $architecture_design_file = $request->file('architecture_design_image');
                $architecture_design_filename = $architecture_design_file->getClientOriginalName();
                $architecture_design_extension = $architecture_design_file->getClientOriginalExtension(); //if you need extension of the file
                $architecture_design_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_design_extension;
                $architecture_design_uploadSuccess = $architecture_design_file->move($destinationPath, $architecture_design_filename);
                if ($architecture_design_uploadSuccess) {
                    $data['architecture_design_image'] = $architecture_design_filename;
                }
            }

            if (!is_null($request->file('architecture_design_video'))) {
                $architecture_design_vfile = $request->file('architecture_designer_video');
                $architecture_design_vfilename = $architecture_design_vfile->getClientOriginalName();
                $architecture_design_vextension = $architecture_design_vfile->getClientOriginalExtension(); //if you need extension of the file
                $architecture_design_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_design_vextension;
                $architecture_design_vuploadSuccess = $architecture_design_vfile->move($destinationPath, $architecture_design_videofilename);
                if ($architecture_design_vuploadSuccess) {
                    $data['architecture_design_video'] = $architecture_design_videofilename;
                }
            }

            // Designer
            $data['architecture_designer_title'] = $request->input('architecture_designer_title');
            $data['architecture_designer_desciription'] = $request->input('architecture_designer_desciription');
            $data['architecture_designer_url'] = $request->input('architecture_designer_url');
            if (!empty($request->input('architecture_designer_designer'))) {
                $data['architecture_designer_designer'] = implode(',', $request->input('architecture_designer_designer'));
            }
            if ($request->input('architecture_designer_video_type') != '') {
                $data['architecture_designer_video_type'] = $request->input('architecture_designer_video_type');
            }
            if ($request->input('architecture_designer_video_link_type') != '') {
                $data['architecture_designer_video_link_type'] = $request->input('architecture_designer_video_link_type');
            }
            $data['architecture_designer_video_link'] = $request->input('architecture_designer_video_link');

            if (!is_null($request->file('architecture_designer_image'))) {
                $architecture_designer_file = $request->file('architecture_designer_image');
                $architecture_designer_filename = $architecture_designer_file->getClientOriginalName();
                $architecture_designer_extension = $architecture_designer_file->getClientOriginalExtension(); //if you need extension of the file
                $architecture_designer_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_designer_extension;
                $architecture_designer_uploadSuccess = $architecture_designer_file->move($destinationPath, $architecture_designer_filename);
                if ($architecture_designer_uploadSuccess) {
                    $data['architecture_designer_image'] = $architecture_designer_filename;
                }
            }

            if (!is_null($request->file('architecture_designer_video'))) {
                $architecture_designer_vfile = $request->file('architecture_designer_video');
                $architecture_designer_vfilename = $architecture_designer_vfile->getClientOriginalName();
                $architecture_designer_vextension = $architecture_designer_vfile->getClientOriginalExtension(); //if you need extension of the file
                $architecture_designer_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_designer_vextension;
                $architecture_designer_vuploadSuccess = $architecture_designer_vfile->move($destinationPath, $architecture_designer_videofilename);
                if ($architecture_designer_vuploadSuccess) {
                    $data['architecture_designer_video'] = $architecture_designer_videofilename;
                }
            }

            // Spas
            $data['spa_title'] = $request->input('spa_title');
            $data['spa_desciription'] = $request->input('spa_desciription');
            $data['spa_url'] = $request->input('spa_url');
            $data['spa_usp_text'] = $request->input('spa_usp_text');
            $data['spa_usp_person'] = $request->input('spa_usp_person');
            $data['spa_manager_text'] = $request->input('spa_manager_text');
            $data['spa_opening_hours'] = $request->input('spa_opening_hours');
            $data['spa_phone_number'] = $request->input('spa_phone_number');
            if (!empty($request->input('spa_designer'))) {
                $data['spa_designer'] = implode(',', $request->input('spa_designer'));
            }
            if ($request->input('spa_video_type') != '') {
                $data['spa_video_type'] = $request->input('spa_video_type');
            }
            if ($request->input('spa_video_link_type') != '') {
                $data['spa_video_link_type'] = $request->input('spa_video_link_type');
            }
            $data['spa_video_link'] = $request->input('spa_video_link');
            if (!is_null($request->file('spa_image1'))) {
                $spa_file = $request->file('spa_image1');
                $spa_filename = $spa_file->getClientOriginalName();
                $spa_extension = $spa_file->getClientOriginalExtension(); //if you need extension of the file
                $spa_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $spa_extension;
                $spa_uploadSuccess = $spa_file->move($destinationPath, $spa_filename);
                if ($spa_uploadSuccess) {
                    $data['spa_image1'] = $spa_filename;
                }
            }

            if (!is_null($request->file('spa_image2'))) {
                $spa_file2 = $request->file('spa_image2');
                $spa_filename2 = $spa_file2->getClientOriginalName();
                $spa_extension2 = $spa_file2->getClientOriginalExtension(); //if you need extension of the file
                $spa_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $spa_extension2;
                $spa_uploadSuccess2 = $spa_file2->move($destinationPath, $spa_filename2);
                if ($spa_uploadSuccess2) {
                    $data['spa_image2'] = $spa_filename2;
                }
            }

            if (!is_null($request->file('spa_image3'))) {
                $spa_file3 = $request->file('spa_image3');
                $spa_filename3 = $spa_file3->getClientOriginalName();
                $spa_extension3 = $spa_file3->getClientOriginalExtension(); //if you need extension of the file
                $spa_filename3 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $spa_extension3;
                $spa_uploadSuccess3 = $spa_file3->move($destinationPath, $spa_filename3);
                if ($spa_uploadSuccess3) {
                    $data['spa_image3'] = $spa_filename3;
                }
            }

            if (!is_null($request->file('spa_image4'))) {
                $spa_file4 = $request->file('spa_image4');
                $spa_filename4 = $spa_file4->getClientOriginalName();
                $spa_extension4 = $spa_file4->getClientOriginalExtension(); //if you need extension of the file
                $spa_filename4 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $spa_extension4;
                $spa_uploadSuccess4 = $spa_file4->move($destinationPath, $spa_filename4);
                if ($spa_uploadSuccess4) {
                    $data['spa_image4'] = $spa_filename4;
                }
            }

            if (!is_null($request->file('spa_video'))) {
                $spa_vfile = $request->file('spa_video');
                $spa_vfilename = $spa_vfile->getClientOriginalName();
                $spa_vextension = $spa_vfile->getClientOriginalExtension(); //if you need extension of the file
                $spa_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $spa_vextension;
                $spa_vuploadSuccess = $spa_vfile->move($destinationPath, $spa_videofilename);
                if ($spa_vuploadSuccess) {
                    $data['spa_video'] = $spa_videofilename;
                }
            }

            // Resturants
            $data['restaurant_title'] = $request->input('restaurant_title');
            $data['restaurant_desciription'] = $request->input('restaurant_desciription');
            $data['restaurant_url'] = $request->input('restaurant_url');
            $data['restaurant_usp_text'] = $request->input('restaurant_usp_text');
            $data['restaurant_usp_person'] = $request->input('restaurant_usp_person');
            if (!empty($request->input('restaurant_designer'))) {
                $data['restaurant_designer'] = implode(',', $request->input('restaurant_designer'));
            }
            if ($request->input('restaurant_video_type') != '') {
                $data['restaurant_video_type'] = $request->input('restaurant_video_type');
            }
            if ($request->input('restaurant_video_link_type') != '') {
                $data['restaurant_video_link_type'] = $request->input('restaurant_video_link_type');
            }
            $data['restaurant_video_link'] = $request->input('restaurant_video_link');
            if (!is_null($request->file('restaurant_image'))) {
                $restaurant_file = $request->file('restaurant_image');
                $restaurant_filename = $restaurant_file->getClientOriginalName();
                $restaurant_extension = $restaurant_file->getClientOriginalExtension(); //if you need extension of the file
                $restaurant_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant_extension;
                $restaurant_uploadSuccess = $restaurant_file->move($destinationPath, $restaurant_filename);
                if ($restaurant_uploadSuccess) {
                    $data['restaurant_image'] = $restaurant_filename;
                }
            }

            if (!is_null($request->file('restaurant_image2'))) {
                $restaurant_file2 = $request->file('restaurant_image2');
                $restaurant_filename2 = $restaurant_file2->getClientOriginalName();
                $restaurant_extension2 = $restaurant_file2->getClientOriginalExtension(); //if you need extension of the file
                $restaurant_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant_extension2;
                $restaurant_uploadSuccess2 = $restaurant_file2->move($destinationPath, $restaurant_filename2);
                if ($restaurant_uploadSuccess2) {
                    $data['restaurant_image2'] = $restaurant_filename2;
                }
            }

            if (!is_null($request->file('restaurant_video'))) {
                $restaurant_vfile = $request->file('restaurant_video');
                $restaurant_vfilename = $restaurant_vfile->getClientOriginalName();
                $restaurant_vextension = $restaurant_vfile->getClientOriginalExtension(); //if you need extension of the file
                $restaurant_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant_vextension;
                $restaurant_vuploadSuccess = $restaurant_vfile->move($destinationPath, $restaurant_videofilename);
                if ($restaurant_vuploadSuccess) {
                    $data['restaurant_video'] = $restaurant_videofilename;
                }
            }

            //resturant 2

            $data['restaurant2_title'] = $request->input('restaurant2_title');
            $data['restaurant2_desciription'] = $request->input('restaurant2_desciription');
            $data['restaurant2_url'] = $request->input('restaurant2_url');
            $data['restaurant2_usp_text'] = $request->input('restaurant2_usp_text');
            $data['restaurant2_usp_person'] = $request->input('restaurant2_usp_person');
            if (!empty($request->input('restaurant2_designer'))) {
                $data['restaurant2_designer'] = implode(',', $request->input('restaurant2_designer'));
            }
            if ($request->input('restaurant2_video_type') != '') {
                $data['restaurant2_video_type'] = $request->input('restaurant2_video_type');
            }
            if ($request->input('restaurant2_video_link_type') != '') {
                $data['restaurant2_video_link_type'] = $request->input('restaurant2_video_link_type');
            }
            $data['restaurant2_video_link'] = $request->input('restaurant2_video_link');
            if (!is_null($request->file('restaurant2_image'))) {
                $restaurant2_file = $request->file('restaurant2_image');
                $restaurant2_filename = $restaurant2_file->getClientOriginalName();
                $restaurant2_extension = $restaurant2_file->getClientOriginalExtension(); //if you need extension of the file
                $restaurant2_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant2_extension;
                $restaurant2_uploadSuccess = $restaurant2_file->move($destinationPath, $restaurant2_filename);
                if ($restaurant2_uploadSuccess) {
                    $data['restaurant2_image'] = $restaurant2_filename;
                }
            }

            if (!is_null($request->file('restaurant2_image2'))) {
                $restaurant2_file2 = $request->file('restaurant2_image2');
                $restaurant2_filename2 = $restaurant2_file2->getClientOriginalName();
                $restaurant2_extension2 = $restaurant2_file2->getClientOriginalExtension(); //if you need extension of the file
                $restaurant2_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant2_extension2;
                $restaurant2_uploadSuccess2 = $restaurant2_file2->move($destinationPath, $restaurant2_filename2);
                if ($restaurant2_uploadSuccess2) {
                    $data['restaurant2_image2'] = $restaurant2_filename2;
                }
            }

            if (!is_null($request->file('restaurant2_video'))) {
                $restaurant2_vfile = $request->file('restaurant2_video');
                $restaurant2_vfilename = $restaurant2_vfile->getClientOriginalName();
                $restaurant2_vextension = $restaurant2_vfile->getClientOriginalExtension(); //if you need extension of the file
                $restaurant2_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant2_vextension;
                $restaurant2_vuploadSuccess = $restaurant2_vfile->move($destinationPath, $restaurant2_videofilename);
                if ($restaurant2_vuploadSuccess) {
                    $data['restaurant2_video'] = $restaurant2_videofilename;
                }
            }
			
			//resturant 3

            $data['restaurant3_title'] = $request->input('restaurant3_title');
            $data['restaurant3_desciription'] = $request->input('restaurant3_desciription');
            $data['restaurant3_url'] = $request->input('restaurant3_url');
            $data['restaurant3_usp_text'] = $request->input('restaurant3_usp_text');
            $data['restaurant3_usp_person'] = $request->input('restaurant3_usp_person');
            if (!empty($request->input('restaurant3_designer'))) {
                $data['restaurant3_designer'] = implode(',', $request->input('restaurant3_designer'));
            }
            if ($request->input('restaurant3_video_type') != '') {
                $data['restaurant3_video_type'] = $request->input('restaurant3_video_type');
            }
            if ($request->input('restaurant3_video_link_type') != '') {
                $data['restaurant3_video_link_type'] = $request->input('restaurant3_video_link_type');
            }
            $data['restaurant3_video_link'] = $request->input('restaurant3_video_link');
            if (!is_null($request->file('restaurant3_image'))) {
                $restaurant3_file = $request->file('restaurant3_image');
                $restaurant3_filename = $restaurant3_file->getClientOriginalName();
                $restaurant3_extension = $restaurant3_file->getClientOriginalExtension(); //if you need extension of the file
                $restaurant3_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant3_extension;
                $restaurant3_uploadSuccess = $restaurant3_file->move($destinationPath, $restaurant3_filename);
                if ($restaurant3_uploadSuccess) {
                    $data['restaurant3_image'] = $restaurant3_filename;
                }
            }

            if (!is_null($request->file('restaurant3_image2'))) {
                $restaurant3_file2 = $request->file('restaurant3_image2');
                $restaurant3_filename2 = $restaurant3_file2->getClientOriginalName();
                $restaurant3_extension2 = $restaurant3_file2->getClientOriginalExtension(); //if you need extension of the file
                $restaurant3_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant3_extension2;
                $restaurant3_uploadSuccess2 = $restaurant3_file2->move($destinationPath, $restaurant3_filename2);
                if ($restaurant3_uploadSuccess2) {
                    $data['restaurant3_image2'] = $restaurant3_filename2;
                }
            }

            if (!is_null($request->file('restaurant3_video'))) {
                $restaurant3_vfile = $request->file('restaurant3_video');
                $restaurant3_vfilename = $restaurant3_vfile->getClientOriginalName();
                $restaurant3_vextension = $restaurant3_vfile->getClientOriginalExtension(); //if you need extension of the file
                $restaurant3_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant3_vextension;
                $restaurant3_vuploadSuccess = $restaurant3_vfile->move($destinationPath, $restaurant3_videofilename);
                if ($restaurant3_vuploadSuccess) {
                    $data['restaurant3_video'] = $restaurant3_videofilename;
                }
            }

            // bar
            $data['bar_title'] = $request->input('bar_title');
            $data['bar_sub_title'] = $request->input('bar_sub_title');
            $data['bar_desciription'] = $request->input('bar_desciription');
            $data['bar_url'] = $request->input('bar_url');
            $data['bar_usp_text'] = $request->input('bar_usp_text');
            $data['bar_usp_person'] = $request->input('bar_usp_person');
            if (!empty($request->input('bar_designer'))) {
                $data['bar_designer'] = implode(',', $request->input('bar_designer'));
            }
            if ($request->input('bar_video_type') != '') {
                $data['bar_video_type'] = $request->input('bar_video_type');
            }
            if ($request->input('bar_video_link_type') != '') {
                $data['bar_video_link_type'] = $request->input('bar_video_link_type');
            }
            $data['bar_video_link'] = $request->input('bar_video_link');
            if (!is_null($request->file('bar_image'))) {
                $bar_file = $request->file('bar_image');
                $bar_filename = $bar_file->getClientOriginalName();
                $bar_extension = $bar_file->getClientOriginalExtension(); //if you need extension of the file
                $bar_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar_extension;
                $bar_uploadSuccess = $bar_file->move($destinationPath, $bar_filename);
                if ($bar_uploadSuccess) {
                    $data['bar_image'] = $bar_filename;
                }
            }

            if (!is_null($request->file('bar_image2'))) {
                $bar_file2 = $request->file('bar_image2');
                $bar_filename2 = $bar_file2->getClientOriginalName();
                $bar_extension2 = $bar_file2->getClientOriginalExtension(); //if you need extension of the file
                $bar_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar_extension2;
                $bar_uploadSuccess2 = $bar_file2->move($destinationPath, $bar_filename2);
                if ($bar_uploadSuccess2) {
                    $data['bar_image2'] = $bar_filename2;
                }
            }

            if (!is_null($request->file('bar_image3'))) {
                $bar_file3 = $request->file('bar_image3');
                $bar_filename3 = $bar_file3->getClientOriginalName();
                $bar_extension3 = $bar_file3->getClientOriginalExtension(); //if you need extension of the file
                $bar_filename3 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar_extension3;
                $bar_uploadSuccess3 = $bar_file3->move($destinationPath, $bar_filename3);
                if ($bar_uploadSuccess3) {
                    $data['bar_image3'] = $bar_filename3;
                }
            }

            if (!is_null($request->file('bar_video'))) {
                $bar_vfile = $request->file('bar_video');
                $bar_vfilename = $bar_vfile->getClientOriginalName();
                $bar_vextension = $bar_vfile->getClientOriginalExtension(); //if you need extension of the file
                $bar_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar_vextension;
                $bar_vuploadSuccess = $bar_vfile->move($destinationPath, $bar_videofilename);
                if ($bar_vuploadSuccess) {
                    $data['bar_video'] = $bar_videofilename;
                }
            }
			
			// bar 2
            $data['bar2_title'] = $request->input('bar2_title');
            $data['bar2_sub_title'] = $request->input('bar2_sub_title');
            $data['bar2_desciription'] = $request->input('bar2_desciription');
            $data['bar2_url'] = $request->input('bar2_url');
            $data['bar2_usp_text'] = $request->input('bar2_usp_text');
            $data['bar2_usp_person'] = $request->input('bar2_usp_person');
            if (!empty($request->input('bar2_designer'))) {
                $data['bar2_designer'] = implode(',', $request->input('bar2_designer'));
            }
            if ($request->input('bar2_video_type') != '') {
                $data['bar2_video_type'] = $request->input('bar2_video_type');
            }
            if ($request->input('bar2_video_link_type') != '') {
                $data['bar2_video_link_type'] = $request->input('bar2_video_link_type');
            }
            $data['bar2_video_link'] = $request->input('bar2_video_link');
            if (!is_null($request->file('bar2_image'))) {
                $bar2_file = $request->file('bar2_image');
                $bar2_filename = $bar2_file->getClientOriginalName();
                $bar2_extension = $bar2_file->getClientOriginalExtension(); //if you need extension of the file
                $bar2_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar2_extension;
                $bar2_uploadSuccess = $bar2_file->move($destinationPath, $bar2_filename);
                if ($bar2_uploadSuccess) {
                    $data['bar2_image'] = $bar2_filename;
                }
            }

            if (!is_null($request->file('bar2_image2'))) {
                $bar2_file2 = $request->file('bar2_image2');
                $bar2_filename2 = $bar2_file2->getClientOriginalName();
                $bar2_extension2 = $bar2_file2->getClientOriginalExtension(); //if you need extension of the file
                $bar2_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar2_extension2;
                $bar2_uploadSuccess2 = $bar2_file2->move($destinationPath, $bar2_filename2);
                if ($bar2_uploadSuccess2) {
                    $data['bar2_image2'] = $bar2_filename2;
                }
            }

            if (!is_null($request->file('bar2_image3'))) {
                $bar2_file3 = $request->file('bar2_image3');
                $bar2_filename3 = $bar2_file3->getClientOriginalName();
                $bar2_extension3 = $bar2_file3->getClientOriginalExtension(); //if you need extension of the file
                $bar2_filename3 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar2_extension3;
                $bar2_uploadSuccess3 = $bar2_file3->move($destinationPath, $bar2_filename3);
                if ($bar2_uploadSuccess3) {
                    $data['bar2_image3'] = $bar2_filename3;
                }
            }

            if (!is_null($request->file('bar2_video'))) {
                $bar2_vfile = $request->file('bar2_video');
                $bar2_vfilename = $bar2_vfile->getClientOriginalName();
                $bar2_vextension = $bar2_vfile->getClientOriginalExtension(); //if you need extension of the file
                $bar2_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar2_vextension;
                $bar2_vuploadSuccess = $bar2_vfile->move($destinationPath, $bar2_videofilename);
                if ($bar2_vuploadSuccess) {
                    $data['bar2_video'] = $bar2_videofilename;
                }
            }
			
			// bar 3
            $data['bar3_title'] = $request->input('bar3_title');
            $data['bar3_sub_title'] = $request->input('bar3_sub_title');
            $data['bar3_desciription'] = $request->input('bar3_desciription');
            $data['bar3_url'] = $request->input('bar3_url');
            $data['bar3_usp_text'] = $request->input('bar3_usp_text');
            $data['bar3_usp_person'] = $request->input('bar3_usp_person');
            if (!empty($request->input('bar3_designer'))) {
                $data['bar3_designer'] = implode(',', $request->input('bar3_designer'));
            }
            if ($request->input('bar3_video_type') != '') {
                $data['bar3_video_type'] = $request->input('bar3_video_type');
            }
            if ($request->input('bar3_video_link_type') != '') {
                $data['bar3_video_link_type'] = $request->input('bar3_video_link_type');
            }
            $data['bar3_video_link'] = $request->input('bar3_video_link');
            if (!is_null($request->file('bar3_image'))) {
                $bar3_file = $request->file('bar3_image');
                $bar3_filename = $bar3_file->getClientOriginalName();
                $bar3_extension = $bar3_file->getClientOriginalExtension(); //if you need extension of the file
                $bar3_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar3_extension;
                $bar3_uploadSuccess = $bar3_file->move($destinationPath, $bar3_filename);
                if ($bar3_uploadSuccess) {
                    $data['bar3_image'] = $bar3_filename;
                }
            }

            if (!is_null($request->file('bar3_image2'))) {
                $bar3_file2 = $request->file('bar3_image2');
                $bar3_filename2 = $bar3_file2->getClientOriginalName();
                $bar3_extension2 = $bar3_file2->getClientOriginalExtension(); //if you need extension of the file
                $bar3_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar3_extension2;
                $bar3_uploadSuccess2 = $bar3_file2->move($destinationPath, $bar3_filename2);
                if ($bar3_uploadSuccess2) {
                    $data['bar3_image2'] = $bar3_filename2;
                }
            }

            if (!is_null($request->file('bar3_image3'))) {
                $bar3_file3 = $request->file('bar3_image3');
                $bar3_filename3 = $bar3_file3->getClientOriginalName();
                $bar3_extension3 = $bar3_file3->getClientOriginalExtension(); //if you need extension of the file
                $bar3_filename3 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar3_extension3;
                $bar3_uploadSuccess3 = $bar3_file3->move($destinationPath, $bar3_filename3);
                if ($bar3_uploadSuccess3) {
                    $data['bar3_image3'] = $bar3_filename3;
                }
            }

            if (!is_null($request->file('bar3_video'))) {
                $bar3_vfile = $request->file('bar3_video');
                $bar3_vfilename = $bar3_vfile->getClientOriginalName();
                $bar3_vextension = $bar3_vfile->getClientOriginalExtension(); //if you need extension of the file
                $bar3_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar3_vextension;
                $bar3_vuploadSuccess = $bar3_vfile->move($destinationPath, $bar3_videofilename);
                if ($bar3_vuploadSuccess) {
                    $data['bar3_video'] = $bar3_videofilename;
                }
            }

            // Video section
            $data['video_title'] = $request->input('video_title');
            $data['video_desciription'] = $request->input('video_desciription');
            $data['video_sub_title'] = $request->input('video_sub_title');
            if ($request->input('video_type') != '') {
                $data['video_type'] = $request->input('video_type');
            }
            if ($request->input('video_link_type') != '') {
                $data['video_link_type'] = $request->input('video_link_type');
            }
            $data['video_link'] = $request->input('video_link');
            if (!is_null($request->file('video_image'))) {
                $video_file = $request->file('video_image');
                $video_filename = $video_file->getClientOriginalName();
                $video_extension = $video_file->getClientOriginalExtension(); //if you need extension of the file
                $video_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $video_extension;
                $video_uploadSuccess = $video_file->move($destinationPath, $video_filename);
                if ($video_uploadSuccess) {
                    $data['video_image'] = $video_filename;
                }
            }

            if (!is_null($request->file('video_video'))) {
                $video_vfile = $request->file('video_video');
                $video_vfilename = $video_vfile->getClientOriginalName();
                $video_vextension = $video_vfile->getClientOriginalExtension(); //if you need extension of the file
                $video_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $video_vextension;
                $video_vuploadSuccess = $video_vfile->move($destinationPath, $video_videofilename);
                if ($video_vuploadSuccess) {
                    $data['video_video'] = $video_videofilename;
                }
            }

            $id = $this->model->insertRow($data, $request->input('id'));

            if (!is_null($request->input('copy_amenities_rooms')) && !empty($request->input('assigned_amenities'))) {
                $check_pcats = \DB::table('tb_properties_category_types')->where('property_id', $id)->get();
                if (!empty($check_pcats)) {
                    foreach ($check_pcats as $pcats) {
                        $check_pcats_exist = \DB::table('tb_properties_category_amenities')->where('property_id', $id)->where('cat_id', $pcats->id)->first();
                        $Amdata['property_id'] = $id;
                        $Amdata['cat_id'] = $pcats->id;
                        $Amdata['user_id'] = $uid;
                        $Amdata['amenity_ids'] = implode(',', $request->input('assigned_amenities'));
                        if (!empty($check_pcats_exist)) {
                            $Amdata['updated'] = date('Y-m-d h:i:s');
                            \DB::table('tb_properties_category_amenities')->where('id', $check_pcats_exist->id)->update($Amdata);
                        } else {
                            $Amdata['created'] = date('Y-m-d h:i:s');
                            \DB::table('tb_properties_category_amenities')->insertGetId($Amdata);
                        }
                    }
                }
            }


            if (!is_null($request->input('apply'))) {
                $return = 'crmhotel/leadupdate/' . $id . '?return=' . self::returnUrl();
            } else {
                $return = 'crmhotel?return=' . self::returnUrl();
            }

            // Insert logs into database
            if ($request->input('id') == '') {
                \SiteHelpers::auditTrail($request, 'New Data with ID ' . $id . ' Has been Inserted !');
            } else {
                \SiteHelpers::auditTrail($request, 'Data with ID ' . $id . ' Has been Updated !');
            }

            return Redirect::to($return)->with('messagetext', \Lang::get('core.note_success'))->with('msgstatus', 'success');
        } else {

            return Redirect::to('crmhotel/leadupdate/' . $id)->with('messagetext', \Lang::get('core.note_error'))->with('msgstatus', 'error')
                            ->withErrors($validator)->withInput();
        }
    }
}