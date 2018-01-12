<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect, URL ;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use Config, Session;

class PaypalController extends Controller
{
	
	private $_api_context;
	public function __construct()
	{
		// setup PayPal api context
		$paypal_conf = Config::get('paypal');
		$this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
		$this->_api_context->setConfig($paypal_conf['settings']);
	}
	
	public function choosePayment(Request $request)
	{
		$method = $request->input('method');
		$mid = $request->input('umid');
		if($method!='')
		{
			$umdata = \DB::table('tb_users_membership')->join('tb_membership', 'tb_membership.id', '=', 'tb_users_membership.membership_id')->where('tb_users_membership.id',$mid)->first();
			if($method=='paypal')
			{
				$payer = new Payer();
				$payer->setPaymentMethod('paypal');
			 
				$item_1 = new Item();
				$item_1->setName($umdata->package_name) // item name
					->setCurrency('USD')
					->setQuantity(1)
					->setPrice($umdata->package_price); // unit price
			 
				// add item to list
				$item_list = new ItemList();
				$item_list->setItems(array($item_1));
			 
				$amount = new Amount();
				$amount->setCurrency('USD')->setTotal($umdata->package_price);
			 
				$transaction = new Transaction();
				$transaction->setAmount($amount)
					->setItemList($item_list)
					->setDescription('Your transaction description');
			 
				$redirect_urls = new RedirectUrls();
				$redirect_urls->setReturnUrl(URL::to('payment/status')) // Specify return URL
					->setCancelUrl(URL::to('payment/status'));
			 
				$payment = new Payment();
				$payment->setIntent('Sale')
					->setPayer($payer)
					->setRedirectUrls($redirect_urls)
					->setTransactions(array($transaction));
			 
				try {
					$payment->create($this->_api_context);
				} catch (\PayPal\Exception\PPConnectionException $ex) {
					if (\Config::get('app.debug')) {
						echo "Exception: " . $ex->getMessage() . PHP_EOL;
						$err_data = json_decode($ex->getData(), true);
						exit;
					} else {
						die('Some error occur, sorry for inconvenient');
					}
				}
			 
				foreach($payment->getLinks() as $link) {
					if($link->getRel() == 'approval_url') {
						$redirect_url = $link->getHref();
						break;
					}
				}
			 
				// add payment ID to session
				Session::put('paypal_payment_id', $payment->getId());
				Session::put('newuser_id', $umdata->user_id);
			 
				if(isset($redirect_url)) {
					// redirect to paypal
					return Redirect::away($redirect_url);
				}
			 
				return Redirect::route('original.route')
					->with('error', 'Unknown error occurred');
			}
			elseif($method=='bank')
			{
				return Redirect::to('bankdetails/'.$umdata->user_id);
			}elseif($method=='stripe')
			{
				return Redirect::to('stripedetails/'.$umdata->user_id);
			}
		}
		else
		{
			return Redirect::to('choose/'.$mid)->with('messagetext','Choose payment method first.')->with('msgstatus','error');
		}
	}
	
	public function getPaymentStatus()
	{
		// Get the payment ID before session clear
		$payment_id = Session::get('paypal_payment_id');
		$newuser_id = Session::get('newuser_id');
	 
		// clear the session payment ID
		Session::forget('paypal_payment_id');
		Session::forget('newuser_id');
	 
		if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
			return Redirect::to('plans')->with('messagetext','Payment failed.')->with('msgstatus','error');
		}
	 
		$payment = Payment::get($payment_id, $this->_api_context);
	 
		// PaymentExecution object includes information necessary 
		// to execute a PayPal account payment. 
		// The payer_id is added to the request query parameters
		// when the user is redirected from paypal back to your site
		$execution = new PaymentExecution();
		$execution->setPayerId(Input::get('PayerID'));
	 
		//Execute the payment
		$result = $payment->execute($execution, $this->_api_context);
	 
		echo '<pre>';print_r($result);echo '</pre>';exit; // DEBUG RESULT, remove it later
	 
		if ($result->getState() == 'approved') { // payment made
			\DB::table('tb_users')->where('id',$newuser_id)->update(['active'=>1]);
			
			$odata['orderDate'] = date('Y-m-d');
			$odata['status'] = ' Order Placed';
			$odata['comments'] = ' New Signup';
			$odata['customerNumber'] = $newuser_id;
			$ordId = \DB::table('orders')->insertRow($odata);
			
			$billTo = \DB::table('tb_user_company_details')->where('user_id', $newuser_id )->first();
			$def_pro_price = \DB::table('tb_membership')->join('tb_users_membership', 'tb_users_membership.membership_id', '=', 'tb_membership.id')->where('tb_users_membership.user_id', $newuser_id)->select('package_price')->first();
			$total = $def_pro_price->package_price;
			$invoice_num = \DB::table('tb_settings')->where('key_value', 'default_invoice_num')->first();
			$exp_num = $invoice_num->content;
			
			$indata['order_id'] = $ordId;
			$indata['invoice_title'] = 'Invoice';
			$indata['invoice_number'] = ++$exp_num;
			$indata['billing_date'] = date('Y-m-d');
			$indata['from_business_name'] = 'Johnnyshare';
			$indata['from_address'] = 'Johnnyshare';
			$indata['from_address2'] = 'Johnnyshare';
			$indata['from_phone'] = '';
			$indata['from_email'] = '';
			
			if(!empty($billTo))
			{
				$indata['to_business_name'] = $billTo->company_name;
				$indata['to_address'] = $billTo->company_address;
				$indata['to_address2'] = $billTo->company_address2;
				$indata['to_phone'] = $billTo->company_phone;
				$indata['to_email'] = $billTo->company_email;
			}
			$indata['user_id'] = $newuser_id;
			$indata['invoice_sub_total'] = $total;
			$indata['invoice_total_price'] = $total;
			$indata['created'] = date('Y-m-d h:i:s');
			$invId = \DB::table('tb_invoices')->insertRow($indata);
			
			\DB::table('tb_settings')->where('key_value', 'default_invoice_num')->update(['content' => $indata['invoice_number']]);
			
			$userinfom = \DB::table('tb_users')->where('id', $newuser_id )->first();
			$pdata['invoice_id'] = $invId;
			$pdata['product_title'] = 'Signup';
			$pdata['product_desc'] = $userinfom->first_name .' '.$userinfom->last_name;
			$pdata['product_qty'] = 1;
			$pdata['product_price'] = $total;
			$pdata['product_tax'] = 0;
			$pdata['product_total'] = $total;
			$pdata['created'] = date('y-m-d h:i:s');
			\DB::table('tb_invoice_products')->insert($pdata);
			
			$pathToFile['path'] = $this->generateInvoicePdfsave($invId,$newuser_id);
			//echo $pathToFile; die;
			$pathToFile['name'] = 'invoice-'.date('d-m-Y-h:i:s').'.pdf';
			$pathToFile['useremail'] = $userinfom->email;
			if($pathToFile)
			{
				$data = array();
				\Mail::send('user.emails.invoice', $data, function($message) use ($pathToFile)
				{
					$message->from(CNF_EMAIL, CNF_APPNAME);

					$message->to( $pathToFile['useremail']);

					$message->attach($pathToFile['path'], ['as' => $pathToFile['name'], 'mime' => 'pdf']);
					
				});
			}
			
			\Auth::loginUsingId($newuser_id);
			DB::table('tb_users')->where('id', '=',$newuser_id )->update(array('last_login' => date("Y-m-d H:i:s")));
			\Session::put('uid', $newuser_id);
			\Session::put('gid', 3);
			\Session::put('eid', $userinfom->email);
			\Session::put('ll', date("Y-m-d H:i:s"));
			
			return Redirect::to('dashboard')->with('messagetext','Thanks for registering! . Your account is active now.')->with('msgstatus','error');
		}
		return Redirect::to('plans')->with('messagetext','Payment failed.')->with('msgstatus','error');
	}
	
	function generateInvoicePdfsave($invId, $userId)
	{
		$downFileName = 'invoice-'.date('d-m-Y-h-i-s').'.pdf';
		$currency = \DB::table('tb_settings')->where('key_value', 'default_currency')->first();
		$bankdetails = \DB::table('tb_settings')->where('key_value', 'bank_details')->first();
		$regdetail = \DB::table('tb_settings')->where('key_value', 'reg_detail')->first();
		$contactdetail = \DB::table('tb_settings')->where('key_value', 'contact_detail')->first();
		$companydet = \DB::table('tb_user_company_details')->where('user_id', $userId )->first();
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
				$html .= '<tr style="background:#f5f5f5;"><td colspan="4">&nbsp;</td><td><b>Shipping</b></td><td class="alnCenter">'.$currency->content.' '.$invInfo->invoice_shipping_price.'</td></tr>';
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
							$fldata['user_id'] = $userId;
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
			return $retfolderpath.$downFileName;
			
		}
		else
		{
			return Redirect::to('user/login')->with('messagetext','Invoice not generated.')->with('msgstatus','error');
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
	
	public function advertisementPayment(Request $request)
	{
		$rules = array(
			'adslink'=>'required',
			'advertise_img'  => 'mimes:jpeg,png,jpg,mp4',
		);
		
		if(Input::get('advedit_id')=="" && Input::get('advedit_id')==0)
		{
			$rules['advertise_img'] = 'required';
		}
		
		$validator = Validator::make($request->all(), $rules);

		if ($validator->passes()) {
			
			if(!is_null(Input::file('advertise_img')))
			{
				$file = $request->file('advertise_img'); 
				$destinationPath = './uploads/users/advertisement/';
				$filename = $file->getClientOriginalName();
				$extension = $file->getClientOriginalExtension(); //if you need extension of the file
				$newfilename = \Session::get('uid').'.'.$extension;
				$uploadSuccess = $request->file('advertise_img')->move($destinationPath, $newfilename);				 
				if( $uploadSuccess ) {
				    $advData['adv_img'] = $newfilename;
					if($request->input('adsType')=="slider")
					{
						$destinationPath_slider = './uploads/slider_images/';
						$filename_slider = $file->getClientOriginalName();
						$extension_slider = $file->getClientOriginalExtension(); //if you need extension of the file
						$newfilename_slider = rand(00000000,99999999).'-'.rand(00000000,99999999).'.'.$extension_slider;
						$uploadSuccess_slider = $request->file('advertise_img')->move($destinationPath_slider, $newfilename_slider);				 
						if( $uploadSuccess_slider ) {
							$slidData['slider_img'] = $newfilename_slider;
						}
					}
				} 
				
			}
		
			$curdate = date('y-m-d');
			$advData['user_id'] = \Auth::user()->id;
			$advData['adv_link'] = $request->input('adslink');
			$advData['adv_title'] = $request->input('adstitle');
			$advData['adv_desc'] = $request->input('adsdesc');
			$advData['adv_type'] = $request->input('adsType');
			if($request->input('adsType')=="slider")
			{
				$advData['ads_slider_cat'] = $request->input('ads_slider_cat');
				$slidData['user_id'] = \Auth::user()->id;
				$slidData['slider_link'] = $request->input('adslink');
				$slidData['slider_title'] = $request->input('adstitle');
				$slidData['slider_description'] = $request->input('adsdesc');
				$slidData['slider_category'] = $request->input('ads_slider_cat');
			}
			else
			{
				$advData['ads_cat_id'] = $request->input('adsCat');
				$advData['adv_position'] = $request->input('adspos');
			}
			if(Input::get('advedit_id')!="" && Input::get('advedit_id')>0)
			{
				$advData['updated'] = date('y-m-d h:i:s');
				\DB::table('tb_advertisement')->where('id', Input::get('advedit_id'))->update($advData);
				
				if($request->input('adsType')=="slider")
				{
					$slidData['updated'] = date('y-m-d h:i:s');
					\DB::table('tb_sliders')->where('advert_id', Input::get('advedit_id'))->update($slidData);
				}
				
				return Redirect::to('user/profile')->with('messagetext','update successfully.')->with('msgstatus','success');
			}
			else
			{
				$advData['adv_status'] = 0;
				$advData['created'] = date('y-m-d h:i:s');
				$advId = \DB::table('tb_advertisement')->insertGetId($advData);
				
				if($request->input('adsType')=="slider")
				{
					$slidData['created'] = date('y-m-d h:i:s');
					$slidData['advert_id'] = $advId;
					\DB::table('tb_sliders')->insertGetId($slidData);
				}
			}
			if($request->input('pay')=='yes'){
				$currncy = 'USD';
				if($request->input('adscurrency')=='€')
				{
					$currncy = 'EUR';
				}
				elseif($request->input('adscurrency')=='£')
				{
					$currncy = 'GBP';
				}
				$payer = new Payer();
				$payer->setPaymentMethod('paypal');
			 
				$item_1 = new Item();
				$item_1->setName('Purchase Advertisement') // item name
					->setCurrency($currncy)
					->setQuantity(1)
					->setPrice($request->input('adsprice')); // unit price
			 
				// add item to list
				$item_list = new ItemList();
				$item_list->setItems(array($item_1));
			 
				$amount = new Amount();
				$amount->setCurrency($currncy)->setTotal($request->input('adsprice'));
			 
				$transaction = new Transaction();
				$transaction->setAmount($amount)
					->setItemList($item_list)
					->setDescription('Your transaction description');
			 
				$redirect_urls = new RedirectUrls();
				$redirect_urls->setReturnUrl(URL::to('adspayment/status')) // Specify return URL
					->setCancelUrl(URL::to('adspayment/status'));
			 
				$payment = new Payment();
				$payment->setIntent('Sale')
					->setPayer($payer)
					->setRedirectUrls($redirect_urls)
					->setTransactions(array($transaction));
			 
				try {
					$payment->create($this->_api_context);
				} catch (\PayPal\Exception\PPConnectionException $ex) {
					if (\Config::get('app.debug')) {
						echo "Exception: " . $ex->getMessage() . PHP_EOL;
						$err_data = json_decode($ex->getData(), true);
						exit;
					} else {
						die('Some error occur, sorry for inconvenient');
					}
				}
			 
				foreach($payment->getLinks() as $link) {
					if($link->getRel() == 'approval_url') {
						$redirect_url = $link->getHref();
						break;
					}
				}
			 
				// add payment ID to session
				Session::put('paypal_payment_id', $payment->getId());
				Session::put('newads_id', $advId);
			 
				if(isset($redirect_url)) {
					// redirect to paypal
					return Redirect::away($redirect_url);
				}
			 
				return Redirect::route('original.route')
					->with('error', 'Unknown error occurred');
			}
			elseif($request->input('adsprice')==0)
			{
				\DB::table('tb_advertisement')->where('id',$advId)->update(['adv_status'=>1, 'adv_expire'=> Date('Y-m-d', strtotime("+".$request->input('adsvalidation')." days"))]);
				
				return Redirect::to('user/profile')->with('messagetext','added successfully.')->with('msgstatus','success');
			}
		}
		else
		{
			return Redirect::to('user/profile')
					->with('message', \SiteHelpers::alert('error','The following  errors occurred'))
					->withErrors($validator)->withInput();
		}
	}
	
	public function getadsPaymentStatus()
	{
		// Get the payment ID before session clear
		$payment_id = Session::get('paypal_payment_id');
		$newads_id = Session::get('newads_id');
	 
		// clear the session payment ID
		Session::forget('paypal_payment_id');
		Session::forget('newads_id');
	 
		if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
			return Redirect::to('user/profile')->with('messagetext','Payment failed.')->with('msgstatus','error');
		}
	 
		$payment = Payment::get($payment_id, $this->_api_context);
	 
		// PaymentExecution object includes information necessary 
		// to execute a PayPal account payment. 
		// The payer_id is added to the request query parameters
		// when the user is redirected from paypal back to your site
		$execution = new PaymentExecution();
		$execution->setPayerId(Input::get('PayerID'));
	 
		//Execute the payment
		$result = $payment->execute($execution, $this->_api_context);
	 
		echo '<pre>';print_r($result);echo '</pre>';exit; // DEBUG RESULT, remove it later
	 
		if ($result->getState() == 'approved') { // payment made
			
			\DB::table('tb_advertisement')->where('id',$newads_id)->update(['adv_status'=>1, 'adv_expire'=> Date('Y-m-d', strtotime("+".$request->input('adsvalidation')." days"))]);
			
			return Redirect::to('user/profile')->with('messagetext','Payment successful, Thanks for purchasing!')->with('msgstatus','error');
		}
		return Redirect::to('user/profile')->with('messagetext','Payment failed.')->with('msgstatus','error');
	}
}
?>