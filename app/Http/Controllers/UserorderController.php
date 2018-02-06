<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Userorder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 


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
				if($oitem->package_type=='Hotel')
				{
					$pchkdet = \DB::table('tb_packages')->select('package_title','package_price')->where('id', $oitem->package_id)->first();
					if(!empty($pchkdet))
					{
						$order_item_detail[$o]->pckname = $pchkdet->package_title;
						$order_item_detail[$o]->pckprice = $pchkdet->package_price;
					}
				}
				elseif($oitem->package_type=='Advertisement')
				{
					$pacdata = json_decode($oitem->package_data, true);
					$order_item_detail[$o]->pckprice = $pacdata['ads_package_total_price'];
					$adsdata = '';
					$catdet = \DB::table('tb_categories')->select('category_name')->where('id', $pacdata['ads_category_id'])->first();
					if(!empty($catdet))
					{
						$adsdata .= 'Category: '.$catdet->category_name.', ';
					}
					$adsdata .= 'position: '.$pacdata['ads_position'];
					$adsdata .= ', Type: '.$pacdata['ads_pacakge_type'];
					$adsdata .= ', Start Date: '.$pacdata['ads_start_date'];
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
			$order_item = \DB::table('tb_order_items')->where('order_id', $id)->get();
			if(!empty($order_item))
			{
				$currency = \DB::table('tb_settings')->where('key_value', 'default_currency')->first();
				$html = '<style> .main { margin:0 25px; width:700px; font-family: arial, sans-serif; } .page-break { page-break-after: always; } .header,.footer {width: 100%; position:fixed;} .header { top: 20px; text-align:center;} .footer {bottom: 30px; font-size:10px;} .pagenum:after {content: counter(page);} .imgBox { text-align:center; width:400px; margin:50px auto 30px auto;} .nro { text-align:center; font-size:12px; } .header img { width:250px; height: 50px; } .Mrgtop80 {margin-top:80px;} .Mrgtop40 {margin-top:40px;} .Mrgtop20 {margin-top:10px;} .monimg img { width:125px; height:80px; }  .font13 { font-size:13px; } .font12 { font-size:12px; } .algRgt { text-align:right; } .algCnt { text-align:center; }</style>';
				$i=1;
				$html .= '<div class="main"><div class="header"><img src="'. \URL::to('sximo/images/logo_janua_pdf.png').'"></div><br><br><br><div class="footer">© Copyright: Christian Seisenberger Gmbh</div>';
				
				$userInfo = \DB::table('tb_users')->where('id', $order_item[0]->user_id)->first();
				$companydet = \DB::table('tb_user_company_details')->where('user_id', $order_item[0]->user_id )->first();
				$html .= '<div class="Mrgtop40 font13"><table><tr><td width="250"> JANUA-Daten : </td> <td width="20"></td> <td width="250"> User-Daten : </td> </tr> <tr><td valign="top"> Christian Seisenberger GmbH <br><br> Am Klosterpark 1 <br> 84427, Armstorf <br> Deutschland <br><br> Telefon: +49 (0)80 81 - 95 46 80 <br> Telefax: +49 (0)80 81 - 95 43 31 <br> E-Mail: info@emporium-voyage.com </td> <td></td>';
				if(!empty($companydet))
				{
					$html .= '<td> '.$companydet->company_name.'<br><br>'.$companydet->company_address .' . '.$companydet->company_address2 .' <br> '. $companydet->company_postal_code .', '.$companydet->company_city .' <br> '.$companydet->company_country.'<br><br>Telefon: '.$companydet->company_phone.'<br>E-Mail: '.$companydet->company_email.'</td>';
				}
				else{
					$html .= '<td></td>';
				}
				$html .='</tr> </table></div>';
				$html .= '<div class="Mrgtop80 font13"><table><tr style="background:#eeeeee;"><th width="100" class="alnCenter">No.</th><th width="280" class="alnCenter">PACKAGES </th><th width="50" class="alnCenter">QTY </th><th width="80" class="alnCenter">PRICE </th></tr>';
				$qtyPr = 1;
				$Totprice = 0;
				$qty=1;
				$nos = 1;
				foreach($order_item as $oitem)
				{
					if($oitem->package_type=='Hotel')
					{
						$title = '';
						$pacpric = 0;
						$pchkdet = \DB::table('tb_packages')->select('package_title','package_price')->where('id', $oitem->package_id)->first();
						if(!empty($pchkdet))
						{
							$title = $pchkdet->package_title;
							$pacpric = $pchkdet->package_price;
						}
						$html .= '<tr><td>'.$nos.'</td><td><b>'.$title.'</b></td><td class="alnCenter">'.$qty.'</td><td class="alnCenter">'.$pacpric.'</td></tr>';
					}
					elseif($oitem->package_type=='Advertisement')
					{
						$pacdata = json_decode($oitem->package_data, true);
						$pacpric = $pacdata['ads_package_total_price'];
						$adsdata = '';
						$catdet = \DB::table('tb_categories')->select('category_name')->where('id', $pacdata['ads_category_id'])->first();
						if(!empty($catdet))
						{
							$adsdata .= 'Category: '.$catdet->category_name.', ';
						}
						$adsdata .= 'position: '.$pacdata['ads_position'];
						$adsdata .= ', Type: '.$pacdata['ads_pacakge_type'];
						$adsdata .= ', Start Date: '.$pacdata['ads_start_date'];
						$order_item_detail[$o]->pckcontent = $adsdata;
						
						$html .= '<tr><td>'.$nos.'</td><td><b>'.$title.'</b><br>'.$adsdata.'</td><td class="alnCenter">'.$qty.'</td><td class="alnCenter">'.$pacpric.'</td></tr>';
					}
					$nos++;
					$qtyPr = $pacpric * $qty;
					$Totprice = $Totprice + $qtyPr;
				}
				$html .= '<tr><td colspan="3" style="text-align:right;"><b>Gesammtsumme<b></td><td class="algCnt font13"><b>'.$currency->content .' '.number_format($Totprice, 2, '.', ',').'<b></td></tr>';
				$html .= '</table></div>';
				
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