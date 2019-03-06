<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Packages;
use App\Models\Packagegroups;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 

use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Plan;
class PackagesController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'packages';
	static $per_page	= '10';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Packages();
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'packages',
			'return'	=> self::returnUrl()
			
		);
		
	}

	public function getIndex( Request $request )
	{

		if($this->access['is_view'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');

		$sort = (!is_null($request->input('sort')) ? $request->input('sort') : 'order_num'); 
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
		$pagination->setPath('packages');
		
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
		return view('packages.index',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_packages'); 
		}
		$this->data['fields'] =  \SiteHelpers::fieldLang($this->info['config']['forms']);
		
		$this->data['id'] = $id;
		$this->data['mods'] = \DB::table('tb_module')->select('module_id','module_title')->get();
		return view('packages.form',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_packages'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['grid']);
		
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		return view('packages.view',$this->data);	
	}	

	function postSave( Request $request)
	{
		$uid = \Auth::user()->id;
	 	$rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data = $this->validatePost('tb_packages');
			$data['user_id'] = $uid;
			$data['package_category'] = $request->input('package_category');
			$data['package_usp'] = $request->input('package_usp');
            if($request->input('id') =='')
			{
				$check_ordering = \DB::table('tb_packages')->orderBy('order_num', 'desc')->first();
				if(!empty($check_ordering)){
					$data['order_num'] = $check_ordering->order_num + 1;
				}
				else{
					$data['order_num'] = 1;
				}
			}
            if ($request->input('id') == '') {
                $data['created_at'] = date('Y-m-d h:i:s');
            } else {
                $data['updated_at'] = date('Y-m-d h:i:s');
            }
			if(!is_null($request->input('package_modules')))
			{
				$data['package_modules'] = implode(',',$request->input('package_modules'));
			}
            
            $data['package_for'] = $request->input('package_for');
            
            $userGroups = array();
            if(!is_null($request->input('allow_user_groups')))
			{
				if(is_array($request->input('allow_user_groups'))){ $userGroups = $request->input('allow_user_groups'); }
                $data['allow_user_groups'] = implode(',',$request->input('allow_user_groups'));
			}
            
            $B2BGroupID = (int) \CommonHelper::getusertype("users-b2c");
            if(!in_array($B2BGroupID,$userGroups)){ $data['is_public'] = 0; }
            
			$id = $this->model->insertRow($data , $request->input('id'));
            
            //insert user groups in related table packages_user_groups
            if((count($userGroups) > 0) && ($id > 0)){
                $packagegroupsmodel = new Packagegroups();
                
                $groupsData = array();
                foreach($userGroups as $si_group){
                    $row = $packagegroupsmodel->select('id')->where(array('group_id'=>$si_group,'package_id'=>$id))->first();
                    $rowid = ((isset($row->id))?$row->id:null);
                    $groupsData[] = array('id'=>$rowid,'group_id'=>$si_group,'package_id'=>$id);
                }
                
                if(count($groupsData) > 0){
                    $packagegroupsmodel->where(array('package_id'=>$id))->delete();
                    $packagegroupsmodel->insert($groupsData); 
                }
            }
            //End
			
			if(!is_null($request->input('apply')))
			{
				$return = 'packages/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'packages?return='.self::returnUrl();
			}



			// Insert logs into database
			if($request->input('id') =='')
			{
				$insertedID=$id;

				   if($request->package_price_type==0){
						$this->createPlan($request,$insertedID);
					}

				\SiteHelpers::auditTrail( $request , 'New Data with ID '.$id.' Has been Inserted !');
			} else {
				\SiteHelpers::auditTrail($request ,'Data with ID '.$id.' Has been Updated !');
			}

			return Redirect::to($return)->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
			
		} else {

			return Redirect::to('packages/update/'.$request->input('id'))->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
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
			return Redirect::to('packages')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success'); 
	
		} else {
			return Redirect::to('packages')
        		->with('messagetext','No Item Deleted')->with('msgstatus','error');				
		}

	}	



	 /**
     * Verify that a plan with a given ID exists, or create a new one if it does
     * not.
     */
    protected static function createPlan( Request $request, $insertedID)
    {
       //$stripeObj=New StripepaymentController();
		//$stripeObj->authorizeFromEnv();
		$intervalForPackage="";//day, week, month or year
		$intervalForPackageValue="";
		if($request->package_duration_type=="Months"){

			$intervalForPackageValue='month';
		}

		if($request->package_duration_type=="Days"){

			$intervalForPackageValue='day';
		}
		if($request->package_duration_type=="Year"){

			$intervalForPackageValue='year';
		}

        try {

			$apiKey = env('STRIPE_API_KEY');
			Stripe::setApiKey($apiKey);
	          $plan = Plan::create(
	                array(
	                    'id' => $insertedID,
	                    'amount' =>$request->package_price,
	                    'currency' => 'EUR',
	                    'interval' => $intervalForPackageValue,
	                    'interval_count' => $request->package_duration,
	                    'name' => $request->package_title,
	                    'metadata'=>$request->package_descriptionx,
	                )
	            );
        } catch (Error\InvalidRequest $exception) {

        	return Redirect::to('packages')
        		->with('messagetext','No package created in Stripe')->with('msgstatus','error');	
            
        }
    }		
    public function get_setup(){
        $group_id = \Session::get('gid');
        $setup_package = \DB::table('tb_packages')->where('allow_user_groups', $group_id)->where('package_status', 1)->where('package_for', 1)->first();
        echo json_encode(array('id'=>$setup_package->id));
        exit();
    }
    function change_ordering(Request $request)
	{
		$uid = \Auth::user()->id;
		$filed_id = Input::get('fieldID');
		$action = Input::get('order_type');
		$ret_url = Input::get('curnurl');
		if($filed_id!='' && $filed_id>0)
		{
			$exist = \DB::table('tb_packages')->where('id', $filed_id)->first();
			if(!empty($exist))
			{
				if($action=='up')
				{
					$previous = \DB::table('tb_packages')->where('order_num', '<', $exist->order_num)->orderBy('order_num','desc')->first();
					if(!empty($previous))
					{
						$previous_order = $previous->order_num + 1;
						$update_ordering = \DB::table('tb_packages')->where('id',$previous->id)->update(['order_num'=>$previous_order]);
					}
					$new_ord_num = $exist->order_num - 1;
				}
				elseif($action=='down')
				{
					$next = \DB::table('tb_packages')->where('order_num', '>', $exist->order_num)->orderBy('order_num','asc')->first();
					if(!empty($next))
					{
						$next_order = $next->order_num - 1;
						$update_ordering = \DB::table('tb_packages')->where('id',$next->id)->update(['order_num'=>$next_order]);
					}
					
					$new_ord_num = $exist->order_num + 1;
				}
				
				$update_ordering = \DB::table('tb_packages')->where('id',$filed_id)->update(['order_num'=>$new_ord_num]);
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

