<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Crmhotel;
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
	public $module = 'crmhotel';
	static $per_page	= '50';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Crmhotel();
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'crmhotel',
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
		return view('crmhotel.index',$this->data);
	}	



	function getUpdate(Request $request, $id = null)
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

	function postSave( Request $request)
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
			
			$toouser['email'] = $crmemail;
			$toouser['cc_email_popup'] = $ccemail;
			$toouser['subject'] = $subjectemail;
			$toouser['attchfle'] = $actimgpath;
			$emailArr['attchflename'] = $actimgname;
			$ucode = rand(11111111, 99999999).'-'.rand(11111111, 99999999);
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
			
			$data['crm_id'] = $crmId;
			$data['user_id'] = \Auth::user()->id;
			$data['property_id'] = $propertyId;
			$data['email_address'] = $crmemail;
			$data['cc_email_address'] = $ccemail;
			$data['email_subject'] = $subjectemail;
			$data['email_template'] = $templateemail;
			$data['email_message'] = $request->input('message_email_popup');
			$data['email_attachfile'] = $actimgname;
			$data['email_uniquescode'] = $ucode;
			$ins = \DB::table('tb_crm_emailcommunication')->insert($data);
			
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
}