<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Invoices;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 


class InvoicesController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'invoices';
	static $per_page	= '10';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Invoices();
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'invoices',
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
		$pagination->setPath('invoices');
		
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
		return view('invoices.index',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_invoices'); 
		}
		
		$getinvoice = \DB::table('tb_invoices')->where('id',$id)->first();
		$getproducts = \DB::table('tb_invoice_products')->where('invoice_id',$id)->get();
		
		$invoice_num = \DB::table('tb_settings')->where('key_value', 'default_invoice_num')->first();
		$exp_num = $invoice_num->content;
		$this->data['def_invoice_num'] = ++$exp_num;
		
		$this->data['def_tax'] = \DB::table('tb_settings')->where('key_value', 'default_tax_amount')->first();
		$this->data['def_currency'] = \DB::table('tb_settings')->where('key_value', 'default_currency')->first();
		$this->data['billFrom'] = \DB::table('tb_user_company_details')->select('company_logo', 'company_name', 'company_address', 'company_address2', 'company_email', 'company_phone')->where('user_id', \Auth::user()->id )->first();
		
		$this->data['invoice'] = $getinvoice;
		$this->data['products'] = $getproducts;
		$this->data['id'] = $id;
		return view('invoices.form',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_invoices'); 
		}
		
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		return view('invoices.view',$this->data);	
	}	

	function postSave( Request $request)
	{
		
		$rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data = $this->validatePost('tb_invoices');
			$data['user_id'] = \Auth::user()->id;
			$data['invoice_sub_total'] = $request->input('subtotal');
			$data['invoice_total_price'] = $request->input('totalBill');
			if($request->input('id') =='')
			{
				$data['created'] = date('Y-m-d h:i:s');
			}
			else
			{
				$data['updated'] = date('Y-m-d h:i:s');
			}
			
			if(is_null(Input::file('invoice_logo')))
			{
				if($request->input('company_logo')!="")
				{
					$data['invoice_logo'] = $request->input('company_logo');
					$dirPath = public_path().'/uploads/users/company/';
					$copytofolder = public_path().'/uploads/invoices_logos/';
					$successfile = \File::copy($dirPath.$request->input('company_logo'), $copytofolder.$request->input('company_logo'));
				}
			}
			
			$id = $this->model->insertRow($data , $request->input('id'));
			
			$product_title = $request->input('proName');
			if(!empty($product_title))
			{
				\DB::table('tb_invoice_products')->where('invoice_id', $id)->delete();
				for($p=0;$p<count($product_title);$p++)
				{
					if($product_title[$p]!='')
					{
						$pdata['invoice_id'] = $id;
						$pdata['product_title'] = Input::get('proName')[$p];
						$pdata['product_desc'] = Input::get('proDesc')[$p];
						$pdata['product_qty'] = Input::get('amount')[$p];
						$pdata['product_price'] = Input::get('price')[$p];
						$pdata['product_tax'] = Input::get('vat')[$p];
						$pdata['product_discount'] = Input::get('discount')[$p];
						$pdata['product_total'] = Input::get('total')[$p];
						$pdata['created'] = date('y-m-d h:i:s');
						\DB::table('tb_invoice_products')->insert($pdata);
					}
				}
			}
			
			\DB::table('tb_settings')->where('key_value', 'default_invoice_num')->update(['content' => $request->input('invoice_number')]);
			
			if(Input::get('generate')=="pdf")
			{
				return Redirect::to('generateInvoicePdf/'.$id);
			}
			
			if(!is_null($request->input('apply')))
			{
				$return = 'invoices/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'invoices?return='.self::returnUrl();
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

			return Redirect::to('invoices/update/'.$id)->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
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
			return Redirect::to('invoices')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success'); 
	
		} else {
			return Redirect::to('invoices')
        		->with('messagetext','No Item Deleted')->with('msgstatus','error');				
		}

	}

	function generateInvoicePdf($invId)
	{
		$downFileName = 'invoice-'.date('d-m-Y').'.pdf';
		$currency = \DB::table('tb_settings')->where('key_value', 'default_currency')->first();
		$bankdetails = \DB::table('tb_settings')->where('key_value', 'bank_details')->first();
		$regdetail = \DB::table('tb_settings')->where('key_value', 'reg_detail')->first();
		$contactdetail = \DB::table('tb_settings')->where('key_value', 'contact_detail')->first();
		$companydet = \DB::table('tb_user_company_details')->where('user_id', \Auth::user()->id )->first();
		if($invId!='' && $invId>0)
		{
			$invInfo = \DB::table('tb_invoices')->where('id', $invId)->first();
			
			$html = '<style>.page-break { page-break-after: always; } .header,.footer {width: 100%; position:fixed;}.header {top: 0px;}.footer {bottom: 150px;}.pagenum:after {content: counter(page);}.title {text-align:center; width:700px; font-size:30px; font-weight:bold;} .clrgrey{ color:#3f3f3f;} .alnRight{text-align:right;} .alnCenter{text-align:center;} td{font-size:12px; padding:5px;} th{background-color:#999; color:#fff; text-align:left; padding:5px; font-size:14px;}.totl{background-color:#999; color:#fff; font-weight:bold;} .main{ font-family:Lato, sans-serif;} h2{padding-bottom:0px; margin-bottom:0px;} .valin{ vertical-align:top;} .valinbt{ vertical-align:bottom; text-align:right;}</style>';
			
			$html .= '<div class="main"><div class="footer"><table><tr><td width="170"><h2>BANKVERBINDUNG</h2></td><td width="170"><h2>REGISTEREINTRAG</h2></td><td width="170"><h2>KONTAKT</h2></td></tr><tr><td class="valin">';
			if(!empty($bankdetails))
			{
				$html .= nl2br($bankdetails->content);
			}
			$html .= '</td><td class="valin">';
			if(!empty($regdetail))
			{
				$html .= nl2br($regdetail->content);
			}
			$html .= '</td><td class="valin">';
			if(!empty($contactdetail))
			{
				$html .= nl2br($contactdetail->content);
			}
			$html .= '</td></tr></table></div>';
			
			$html .= '<table style="border-bottom:1px solid #000; margin-bottom:10px;"><tr><td width="260">';
			if(!empty($companydet) && $companydet->company_logo!='')
			{
				$html .= '<img src="'. \URL::to('uploads/users/company/'.$companydet->company_logo).'" />';
			}
			else
			{
				$html .= '<img src="'. \URL::to('sximo/images/logo-sximo.png').'" style="background-color:#000;"/>';
			}
			$html .= '</td><td width="260" class="valinbt">';
			if(!empty($companydet))
			{
				$html .= $companydet->company_address .' . '.$companydet->company_address2 .' . '.$companydet->company_city .' . '.$companydet->company_postal_code .' . '.$companydet->company_country;
			}
			$html .= '</td></tr></table>';
			
			if(!empty($invInfo))
			{
				$html .= '<div class="title">'.$invInfo->invoice_title.'</div>';
				$html .= '<div><table><tr><td width="450" class="alnRight"><span class="clrgrey">INVOICE ID: </span></td><td width="70" class="alnRight">'.$invInfo->invoice_number.'</td></tr><tr><td width="450" class="alnRight"><span class="clrgrey">BILLING DATE: </span></td><td width="70" class="alnRight">'. date("d.m.Y", strtotime($invInfo->billing_date)).'</td></tr><tr><td width="450" class="alnRight"><span class="clrgrey">DUE DATE: </span></td><td width="70" class="alnRight">'. date("d.m.Y", strtotime($invInfo->due_date)).'</td></tr></table></div><br><br>';
				
				$html .= '<div><table><tr><th width="260">BILLING FROM</th><th width="260">BILLING TO</th></tr><tr><td><b>'.$invInfo->from_business_name.'</b></td><td><b>'.$invInfo->to_business_name.'</b></td></tr><tr><td>'.$invInfo->from_address.'</td><td>'.$invInfo->to_address.'</td></tr><tr><td>'.$invInfo->from_address2.'</td><td>'.$invInfo->to_address2.'</td></tr><tr><td>'.$invInfo->from_phone.'</td><td>'.$invInfo->to_phone.'</td></tr><tr><td>'.$invInfo->from_email.'</td><td>'.$invInfo->to_email.'</td></tr><tr><td>'.$invInfo->from_additional_info.'</td><td>'.$invInfo->to_additional_info.'</td></tr></table></div><br><br>';
				
				$html .= '<div><table><tr><th width="180">PRODUCT</th><th width="65" class="alnCenter">QUANTITY </th><th width="55" class="alnCenter">PRICE </th><th width="50" class="alnCenter">TAX </th><th width="60" class="alnCenter">DISCOUNT </th><th width="75" class="alnCenter">TOTAL </th></tr>';
				
				$products = \DB::table('tb_invoice_products')->where('invoice_id', $invId)->get();
				foreach($products as $product)
				{
					$html .= '<tr style="background:#f5f5f5;"><td><b>'.$product->product_title.'</b><br><br>'.$product->product_desc.'</td><td class="alnCenter">'.$product->product_qty.'</td><td class="alnCenter">'.$currency->content.' '.$product->product_price.'</td><td class="alnCenter">'.$product->product_tax.' %</td><td class="alnCenter">'.$product->product_discount.' %</td><td class="alnCenter">'.$currency->content.' '.$product->product_total.'</td></tr>';
				}
				$html .= '<tr style="background:#f5f5f5;"><td colspan="4">&nbsp;</td><td><b>Sub Total</b></td><td class="alnCenter">'.$currency->content.' '.$invInfo->invoice_sub_total.'</td></tr>';
				$html .= '<tr class="totl"><td colspan="4">&nbsp;</td><td><b>Total</b></td><td class="alnCenter">'.$currency->content.' '.$invInfo->invoice_total_price.'</td></tr>';
				$html .= '</table></div>';
				$html .= '</div>';
			}
			
			$savePdfpath = public_path(). '/uploads/invoice_pdfs/';
			$retfolderpath = public_path(). '/uploads/invoice_pdfs/';
			$folder = \DB::table('tb_container')->where('name', 'Rechnungen')->first();
			if(!empty($folder))
			{
				$downfolder = (new ContainerController)->getContainerUserPath($folder->id);
				if( is_dir($downfolder) === true )
				{
					$curr_yr = date('Y');
					$curr_mon = date('m');
					$yearfolder = \DB::table('tb_container')->where('name', $curr_yr)->where('parent_id', $folder->id)->first();
					if(!empty($yearfolder))
					{
						$yrfoldid = $yearfolder->id;
					}
					else
					{
						$yrfoldid = $this->madeFolder($downfolder, $curr_yr, $folder->id);
					}
					if($yrfoldid!='' && $yrfoldid>0)
					{
						$monfolder = \DB::table('tb_container')->where('name', $curr_mon)->where('parent_id', $yrfoldid)->first();
						if(!empty($monfolder))
						{
							$monfoldid = $monfolder->id;
						}
						else
						{
							$monfoldid = $this->madeFolder($downfolder.$curr_yr.'/', $curr_mon, $yrfoldid);
						}
						if($monfoldid!='' && $monfoldid>0)
						{
							$savePdfpath = $downfolder.$curr_yr.'/'.$curr_mon.'/';
							$retfolderpath = (new ContainerController)->getThumbpath($monfoldid);
							
							$fldata['folder_id'] = $monfoldid;
							$fldata['file_name'] = $downFileName;
							$fldata['file_type'] = 'application/pdf';
							$fldata['user_id'] = \Auth::user()->id;
							$fldata['created'] = date('y-m-d h:i:s');
							$fldata['path'] = $savePdfpath;
							\DB::table('tb_container_files')->insertGetId($fldata);
						}
					}
				}
			}
			
			$pdf = \App::make('dompdf.wrapper');
			$pdf->loadHTML($html);
			$pdf->save($savePdfpath.$downFileName);
			//return $pdf->stream();
			return $pdf->download($downFileName);
			
		}
		else
		{
			return Redirect::to('invoices')->with('messagetext','Please Select Files First.')->with('msgstatus','error');
		}
	}
	
	function madeFolder($downfolder, $curr_yr, $folderId)
	{
		$result = \File::makeDirectory($downfolder.$curr_yr, 0777, true);
		$ydata['parent_id'] = $folderId;
		$ydata['name'] = $curr_yr;
		$ydata['file_type'] = 'folder';
		$ydata['user_id'] = 1;
		$ydata['created'] = date('y-m-d h:i:s');
		$foldid = \DB::table('tb_container')->insertGetId($ydata);
		return $foldid;
	}
	
	function fetchuserinfoForbillto($query)
	{
		if($query!="")
		{
			$bilinfo = array();
			$billTo = \DB::table('tb_users')->join('tb_user_company_details', 'tb_users.id', '=', 'tb_user_company_details.user_id')->select('tb_user_company_details.company_name')->where('tb_users.group_id', 3)->where('tb_users.active', 1)->where('tb_user_company_details.company_name', 'like', '%'.$query.'%')->get();

			foreach($billTo as $bill)
			{
				$bilinfo[] = $bill->company_name;
			}
			echo json_encode($bilinfo);
		}
		else
		{
			echo "";
		}
	}
	
	function fetchprofileForbillto(Request $request)
	{
		$user = $request->input('usercompnay');
		if($user!="")
		{
			$bilinfo = array();
			$billTo = \DB::table('tb_user_company_details')->select('company_name', 'company_address', 'company_address2', 'company_email', 'company_phone')->where('company_name', $user )->first();
			if(!empty($billTo))
			{
				return json_encode($billTo);
			}
			else
			{
				return "error";
			}
			
		}
		else
		{
			return "error";
		}
	}


}