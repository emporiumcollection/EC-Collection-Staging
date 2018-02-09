<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Userorder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect, CommonHelper ; 


class UserorderController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'userorder';
	static $per_page	= '10';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Userorder();
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'userorder',
			'return'	=> self::returnUrl()
			
		);
		
		$this->data['vatsettings'] = \DB::table('tb_settings')->where('key_value', 'default_tax_amount')->first();
		
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
		$pagination->setPath('userorder');
		
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
		return view('userorder.index',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_orders'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['forms']);
		
		$this->data['id'] = $id;
		return view('userorder.form',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_orders'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['grid']);
		
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		
		$orderdetail = $this->data['row'];
		$order_item_detail = array();
		$this->data['currency'] = \DB::table('tb_settings')->select('content')->where('key_value', 'default_currency')->first();
		$order_item = \DB::table('tb_order_items')->where('order_id', $id)->get();
		if(!empty($order_item))
		{
			$o=0;
			foreach($order_item as $oitem)
			{
				$order_item_detail[$o] = $oitem;
				$order_item_detail[$o]->pckname = 'Advertisement';
				$order_item_detail[$o]->pckprice = 0;
				$order_item_detail[$o]->pckcontent = '';
				$order_item_detail[$o]->qty = 1;
				if($oitem->package_type=='hotel')
				{
					$pchkdet = \DB::table('tb_packages')->select('package_title','package_price')->where('id', $oitem->package_id)->first();
					if(!empty($pchkdet))
					{
						$order_item_detail[$o]->pckname = $pchkdet->package_title;
						$order_item_detail[$o]->pckprice = $pchkdet->package_price;
					}
				}
				elseif($oitem->package_type=='advert')
				{
					$pacdata = json_decode($oitem->package_data, true);
					$getspac = \DB::table('tb_advertisement_space')->where('id', $pacdata['id'])->first();
					$adsdata = '';
					$catdet = \DB::table('tb_categories')->select('category_name')->where('id', $pacdata['ads_category_id'])->first();
					if(!empty($catdet))
					{
						$adsdata .= 'Category: '.$catdet->category_name.', ';
					}
					$adsdata .= 'position: '.$pacdata['ads_position'];
					$adsdata .= ', Type: '.$pacdata['ads_pacakge_type'];
					$adsdata .= ', Start Date: '.$pacdata['ads_start_date'];
					if($pacdata['ads_pacakge_type']=='cpc')
					{
						$order_item_detail[$o]->pckprice = $getspac->space_cpc_price;
						$adsdata .= ', price: '.$this->data['currency']->content .$getspac->space_cpc_price . '/'.$getspac->space_cpc_num_clicks .' Clicks';
					}
					elseif($pacdata['ads_pacakge_type']=='cpm')
					{
						$order_item_detail[$o]->pckprice = $getspac->space_cpm_price;
						$adsdata .= ', price: '.$this->data['currency']->content .$getspac->space_cpm_price . '/'.$getspac->space_cpm_num_view .' Views';
					}
					elseif($pacdata['ads_pacakge_type']=='cpd')
					{
						$order_item_detail[$o]->qty = $pacdata['ads_days'];
						$order_item_detail[$o]->pckprice = CommonHelper::calc_price($getspac->space_cpd_price,$getspac->space_cpm_num_days,$pacdata['ads_days']);
						$adsdata .= ', price: '.$this->data['currency']->content .$getspac->space_cpd_price . '/'.$getspac->space_cpm_num_days .' Days';
					}
					$order_item_detail[$o]->pckcontent = $adsdata;
				}
				$o++;
			}
		}
		$this->data['order_item_detail'] = $order_item_detail;
		
		$this->data['userDetail'] = \DB::table('tb_user_company_details')->where('user_id', $orderdetail->user_id)->first();
		
		return view('userorder.view',$this->data);	
	}	

	function postSave( Request $request)
	{
		
		$rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data = $this->validatePost('tb_userorder');
				
			$id = $this->model->insertRow($data , $request->input('id'));
			
			if(!is_null($request->input('apply')))
			{
				$return = 'userorder/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'userorder?return='.self::returnUrl();
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

			return Redirect::to('userorder/update/'.$id)->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
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
			return Redirect::to('userorder')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success'); 
	
		} else {
			return Redirect::to('userorder')
        		->with('messagetext','No Item Deleted')->with('msgstatus','error');				
		}

	}			

	public function ordersdownloadinvoicepdf(Request $request, $ordid)
	{
		$downFileName = 'order-invoice-'.date('d-m-Y').'.pdf';
		//$cid = $request->input('contentId');
		if($ordid!="" && $ordid>0)
		{
			$order_item_detail = array();
			$order_item = \DB::table('tb_order_items')->where('order_id', $ordid)->get();
			if(!empty($order_item))
			{
				$currency = \DB::table('tb_settings')->where('key_value', 'default_currency')->first();
				$bankdetails = \DB::table('tb_settings')->where('key_value', 'bank_details')->first();
				$regdetail = \DB::table('tb_settings')->where('key_value', 'reg_detail')->first();
				$contactdetail = \DB::table('tb_settings')->where('key_value', 'contact_detail')->first();
				$invoice_phone_num = \DB::table('tb_settings')->where('key_value', 'invoice_phone_num')->first();
				$invoice_email_id = \DB::table('tb_settings')->where('key_value', 'invoice_email_id')->first();
				$invoice_address = \DB::table('tb_settings')->where('key_value', 'invoice_address')->first();
				$invoice_num = \DB::table('tb_settings')->where('key_value', 'default_invoice_num')->first();
				
				$userInfo = \DB::table('tb_users')->where('id', $order_item[0]->user_id)->first();
				$companydet = \DB::table('tb_user_company_details')->where('user_id', $order_item[0]->user_id )->first();
				
				$html = '<style> 
						.main { margin:0 15px; width:98%; font-family: arial, sans-serif; } 
						.page-break { page-break-after: always; } 
						.header{ width: 100%; position:fixed; top: 0px; text-align:center;} 
						.footer {width: 100%; position:fixed;} 
						.pagenum:after {content: counter(page);} 
						.imgBox { text-align:center; width:400px; } 
						.nro { text-align:center; font-size:12px; } 
						.header img { width:250px; height: 50px; } 
						.Mrgtop80 {margin-top:80px;} 
						.Mrgtop40 {margin-top:40px;}
						.Mrgtop20 {margin-top:10px;} 
						.monimg img { width:125px; height:80px; }  
						.font13 { font-size:13px; } 
						.font12 { font-size:12px; } 
						.algRgt { text-align:right; } 
						.algCnt { text-align:center; } 
						.footer {bottom: 150px;}
						.pagenum:after {content: counter(page);}
						.title {text-align:right; width:100%; font-size:30px; font-weight:bold;} 
						.clrgrey{ color:#3f3f3f;} 
						.alnRight{text-align:right;} 
						.alnCenter{text-align:center;} 
						td{font-size:12px; padding:5px;} 
						th{background-color:#999; color:#000000; text-align:left; padding:5px; font-size:14px;}
						.totl{background-color:#999; color:#000000; font-weight:bold;} 
						h2{padding-bottom:0px; margin-bottom:0px;} 
						.valin{ vertical-align:top;} 
						.valinbt{ vertical-align:bottom; text-align:right;}

					
						
						.page {
						  background: white;
						  display: block;
						  margin: 0 auto;
						  margin-bottom: 0.5cm;
						  
						}
						.page[size="A4"] {  
						  width: 21cm;
						  height: 29.7cm; 
						}
						.page[size="A4"][layout="portrait"] {
						  width: 29.7cm;
						  height: 21cm;  
						}
						.page[size="A3"] {
						  width: 29.7cm;
						  height: 42cm;
						}
						.page[size="A3"][layout="portrait"] {
						  width: 42cm;
						  height: 29.7cm;  
						}
						.page[size="A5"] {
						  width: 14.8cm;
						  height: 21cm;
						}
						.page[size="A5"][layout="portrait"] {
						  width: 21cm;
						  height: 14.8cm;  
						}
						@media print {
						  body, page {
						    margin: 0;
						    box-shadow: 0;
						  }
						}

				</style>';
				
				$i=1;
				$html .= '
				<div class="page">
					
				<div class="main">
				  <div class="header">
						<center><img src="'. \URL::to('sximo/assets/images/logo-design_1.png').'"></center>

						<div style="height:100px;clear:both;"><hr></div>
					</div>
					<div class="footer">
							<table width="100%">
								<tr style="border-bottom:1px solid #000;">
									<td width="33%"><h2>Bank Details</h2></td>
										<td width="33%"><h2>Company Details</h2></td>
										<td width="33%"><h2>Contact Information</h2></td>
								</tr>
							   <tr><td class="valin">';
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
				
				$html .= '<div><hr  style="border-top:1px solid #000;"></div>

				<table width="100%">
					<tr>
						<td width="50%">';
							$html .= 'Tel: '.$invoice_phone_num->content . ' email: ' .$invoice_email_id->content;
				$html .= '</td>

				<td width="50%" class="valinbt">';
				$html .= $invoice_address->content;
				$html .= '</td></tr></table>';
				
				$html .= '<div style=" height:10px;clear:both;">&nbsp;</div><div class="title" style="float:right;">Invoice</div>';
				$html .= '<div style="width:100%">

				<table width="100%">
						<tr>
							<td width="60%" align="left">
									

								<table width="100%">
									<tr>									     
										<td width="100%">'. $companydet->company_address .' . '.$companydet->company_address2 .'</td>
							        </tr>
									<tr>
									   <td width="100%"> '.$companydet->company_city .'</td>										
									</tr>
									<tr>
									 <td width="100%">'. $companydet->company_postal_code.' . '.$companydet->company_country .'</td>
									</tr>
								</table>
								 
								 </td>
								 <td width="40%" class="alnRight" align="right">

								 	
										<table width="100%">
											<tr>
												
												<td  align="right"class="alnRight" >Date:</td>
												<td  class="alnRight">'.date('Y.m.d').'</td>
										    </tr>
											<tr>
												
												<td  align="right" class="alnRight">Invoice Number:</td>
												<td  align="right" class="alnRight">'. $invoice_num->content .'</td>
											</tr>
											<tr>
											
											<td   class="alnRight" width="200px">Contact&nbsp;Person:</td>
											<td  align="right" class="alnRight">'. $userInfo->first_name .' '. $userInfo->last_name .'<br>'. $userInfo->email .'</td>
											</tr>
										</table>
						   			 
						 			</td>
						 		</tr>
						 	</table>
						 </div>
						 <br><br>';
			
				
				$html .= '<div class="Mrgtop40 font13"><table width="100%"><tr style="background:#eeeeee;"><th width="10%">No.</th><th width="50%" >Item </th><th width="20%" class="algCnt">Quantity </th><th width="20%" class="algCnt">Price(Excl.VAT) </th></tr>';
				$qtyPr = 1;
				$Totprice = 0;
				$qty=1;
				$nos = 1;
				foreach($order_item as $oitem)
				{
					if($oitem->package_type=='hotel')
					{
						$title = '';
						$pacpric = 0;
						$pchkdet = \DB::table('tb_packages')->select('package_title','package_price')->where('id', $oitem->package_id)->first();
						if(!empty($pchkdet))
						{
							$title = $pchkdet->package_title;
							$pacpric = $pchkdet->package_price;
						}
						$html .= '<tr><td>'.$nos.'</td><td><b>'.$title.'</b></td><td class="algCnt">'.$qty.'</td><td class="algCnt">'.$currency->content . $pacpric.'</td></tr>';
					}
					elseif($oitem->package_type=='advert')
					{
						$dsqty = 1;
						$pacdata = json_decode($oitem->package_data, true);
						$getspac = \DB::table('tb_advertisement_space')->where('id', $pacdata['id'])->first();
						$adsdata = '';
						$catdet = \DB::table('tb_categories')->select('category_name')->where('id', $pacdata['ads_category_id'])->first();
						if(!empty($catdet))
						{
							$adsdata .= 'Category: '.$catdet->category_name.', ';
						}
						$adsdata .= 'position: '.$pacdata['ads_position'];
						$adsdata .= ', Type: '.$pacdata['ads_pacakge_type'];
						$adsdata .= ', Start Date: '.$pacdata['ads_start_date'];
						if($pacdata['ads_pacakge_type']=='cpc')
						{
							$pacpric = $getspac->space_cpc_price;
							$adsdata .= ', price: '.$currency->content .$getspac->space_cpc_price . '/'.$getspac->space_cpc_num_clicks .' Clicks';
						}
						elseif($pacdata['ads_pacakge_type']=='cpm')
						{
							$pacpric = $getspac->space_cpm_price;
							$adsdata .= ', price: '.$currency->content .$getspac->space_cpm_price . '/'.$getspac->space_cpm_num_view .' Views';
						}
						elseif($pacdata['ads_pacakge_type']=='cpd')
						{
							$dsqty = $pacdata['ads_days'];
							$pacpric = CommonHelper::calc_price($getspac->space_cpd_price,$getspac->space_cpm_num_days,$pacdata['ads_days']);
							$adsdata .= ', price: '.$currency->content .$getspac->space_cpd_price . '/'.$getspac->space_cpm_num_days .' Days';
						}
						
						$html .= '<tr><td>'.$nos.'</td><td><b>Advertisement</b><br>'.$adsdata.'</td><td class="algCnt">'.$dsqty.'</td><td class="algCnt">'.$currency->content . $pacpric.'</td></tr>';
					}
					$nos++;
					$qtyPr = $pacpric * $qty;
					$Totprice = $Totprice + $qtyPr;
				}
				$html .= '<tr><td colspan="3" style="text-align:right;"><b>Total(Excl.VAT)<b></td><td class="algCnt font13"><b>'.$currency->content .' '.($Totprice -(($Totprice*$this->data['vatsettings']->content)/100)).'<b></td></tr>';
				$html .= '<tr><td colspan="3" style="text-align:right;"><b>VAT(. '. $this->data['vatsettings']->content .'%)<b></td><td class="algCnt font13"><b>'.$currency->content .' '.(($Totprice*$this->data['vatsettings']->content)/100).'<b></td></tr>';
				$html .= '<tr><td colspan="3" style="text-align:right;"><b>Total<b></td><td class="algCnt font13"><b>'.$currency->content .' '.number_format($Totprice, 2, '.', ',').'<b></td></tr>';
				$html .= '</table></div></div>';
			
				$pdf = \App::make('dompdf.wrapper');
				$pdf->loadHTML($html);
				return $pdf->download($downFileName);
			}
			else{
				return 'error';
			}
		}
		else{
			return 'error';
		}
	}
}