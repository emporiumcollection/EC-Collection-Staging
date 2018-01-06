<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Shoporders;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 


class ShopordersController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'shoporders';
	static $per_page	= '10';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Shoporders();
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'shoporders',
			'return'	=> self::returnUrl()
			
		);
		
	}

	public function getIndex( Request $request )
	{
		$uid = \Auth::user()->id;
		if($this->access['is_view'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');

		$sort = (!is_null($request->input('sort')) ? $request->input('sort') : 'id'); 
		$order = (!is_null($request->input('order')) ? $request->input('order') : 'asc');
		// End Filter sort and order for query 
		// Filter Search for query		
		$filter = (!is_null($request->input('search')) ? $this->buildSearch() : '');
		if(\Auth::user()->group_id!=1)
		{
			$filter .= " AND (user_id='".$uid."')";
		}
		
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
		$pagination->setPath('shoporders');
		
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
		
		$userDetails = \DB::table('tb_user_company_details')->get();
		$usersdetail = array();
		if(!empty($userDetails))
		{
			foreach($userDetails as $userDetail)
			{
				$usersdetail[$userDetail->user_id] = $userDetail;
			}
		}
		
		$this->data['userDtl'] = $usersdetail;
			
		return view('shoporders.index',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_shop_order'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['forms']);
		
		$this->data['id'] = $id;
		return view('shoporders.form',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_shop_order'); 
		}
		$orderdetail = $this->data['row'];
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['grid']);
		
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		
		$this->data['order_item_detail'] = \DB::table('tb_shop_order_products')->join('tb_shop_products', 'tb_shop_products.id','=','tb_shop_order_products.product_id')->join('tb_shop_product_categories', 'tb_shop_product_categories.id','=','tb_shop_order_products.shop_cat_id')->select('tb_shop_order_products.*','tb_shop_products.title','tb_shop_products.description', 'tb_shop_products.image','tb_shop_products.price', 'tb_shop_product_categories.cat_name')->where('tb_shop_order_products.shop_order_id', $id)->get();
		
		$this->data['userDetail'] = \DB::table('tb_user_company_details')->where('user_id', $orderdetail->user_id)->first();
		
		return view('shoporders.view',$this->data);	
	}	

	function postSave( Request $request)
	{
		
		$rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data = $this->validatePost('tb_shoporders');
			
			$data['order_status'] = $request->input('order_status');
				
			$id = $this->model->insertRow($data , $request->input('id'));
			
			if($request->input('order_status')=='Versendet')
			{
				$order_item_detail = \DB::table('tb_shop_order_products')->join('tb_shop_products', 'tb_shop_products.id','=','tb_shop_order_products.product_id')->join('tb_shop_product_categories', 'tb_shop_product_categories.id','=','tb_shop_order_products.shop_cat_id')->select('tb_shop_order_products.*','tb_shop_products.title','tb_shop_products.description', 'tb_shop_products.image','tb_shop_products.price', 'tb_shop_product_categories.cat_name')->where('tb_shop_order_products.shop_order_id', $id)->get();
				
				//email to user
				$check_userd = \DB::table('tb_shop_order')->join('tb_users', 'tb_users.id', '=', 'tb_shop_order.user_id')->select('tb_users.email', 'tb_users.first_name', 'tb_users.last_name', 'tb_shop_order.*')->where('tb_shop_order.id', $id)->first();
				if(!empty($check_userd))
				{
					$msg = 'vielen Dank für Ihre Bestellung über unsere Homepage www.janua-moebel.com.<br>Sie haben folgendes Produkt mit der Nummer: <br>';
					if(!empty($order_item_detail))
					{
						foreach($order_item_detail as $pdetail)
						{
							$msg .= '<b>'.$pdetail->title.'</b><br><p>'.$pdetail->description.'</p><br>';
						}
					}
					
					$msg .='<br>Ihr JANUA® -Team';
					
					$data['msg'] = $msg;
					$toouser['email'] = $check_userd->email;
					$toouser['subject'] = 'Order update';
					\Mail::send('user.emails.lightbox_order_confirm', $data, function($message) use ($toouser)
					{
						$message->from(CNF_EMAIL, CNF_APPNAME);

						$message->to( $toouser['email']);
						
						$message->subject($toouser['subject']);
					});
				}
				
				//email to admin
				$uid = \Auth::user()->id;
				$check_adminuserd = \DB::table('tb_users')->where('id', $uid)->first();
				if(!empty($check_adminuserd))
				{
					$adata['msg'] = $msg;
					$adminuser['email'] = $check_adminuserd->email;
					$adminuser['subject'] = 'Order update';
					\Mail::send('user.emails.lightbox_order_confirm', $adata, function($message) use ($adminuser)
					{
						$message->from(CNF_EMAIL, CNF_APPNAME);

						$message->to( $adminuser['email']);
						
						$message->subject($adminuser['subject']);
					});
				}
			}
			
			if(!is_null($request->input('apply')))
			{
				$return = 'shoporders/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'shoporders?return='.self::returnUrl();
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

			return Redirect::to('shoporders/update/'.$id)->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
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
			\DB::table('tb_shop_order_products')->whereIn('shop_order_id', $request->input('ids'))->delete();
			\SiteHelpers::auditTrail( $request , "ID : ".implode(",",$request->input('ids'))."  , Has Been Removed Successfull");
			// redirect
			return Redirect::to('shoporders')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success'); 
	
		} else {
			return Redirect::to('shoporders')
        		->with('messagetext','No Item Deleted')->with('msgstatus','error');				
		}

	}			


}