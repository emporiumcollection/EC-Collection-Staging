<?php 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect, URL, DB, CommonHelper, Mail ;
use Config, Session;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Plan;
use App\User;

class StripepaymentController extends Controller
{

	const API_KEY = "sk_test_C0Mmp1B1ZzxMbnpq4EJLNoOg";

    private $mock;

    protected static function authorizeFromEnv()
    {
        $apiKey = getenv('STRIPE_API_KEY');
        if (!$apiKey) {
            $apiKey = self::API_KEY;
        }

        Stripe::setApiKey($apiKey);
    }

     public function __construct() {
            
        //$this->middleware('auth');
        parent::__construct();
        $this->data['pageTitle'] = '';
        $this->data['data'] = CommonHelper::getInfo();
        $this->data['pageslider'] = \DB::table('tb_pages_sliders')->select( 'slider_title', 'slider_description', 'slider_img', 'slider_link', 'slider_video', 'slide_type')->where('slider_page_id', 107)->get();
        $this->data['currency'] = \DB::table('tb_settings')->select('content')->where('key_value', 'default_currency')->first();
        $this->data['pageTitle'] = "Payment for  Membership";
        $this->data['pageMetakey'] = "Payment for  Membership";
        $this->data['pageMetadesc'] = "Payment for  Membership";
            
        }
    

    public function index(){

        self::authorizeFromEnv();
        
        $response=\Stripe\Plan::all(array("limit" => 3));
      

        $invoiceList=\Stripe\Invoice::all(array("limit" => 3));

        dd($response);
    }

    public function checkout(){



        dd();

        self::authorizeFromEnv();       
        
        $this->data['about_text'] = "";
        $stripePackagesList = \Stripe\Plan::all();
       
         $stripePackages[] = '';
        foreach ($stripePackagesList->data as $TBkey => $TBValue) {
            $stripePackages[$TBValue->id] = $TBValue->name."&nbsp;&euro;&nbsp;".($TBValue->amount/100);
        }
        $this->data['stripePackagesData'] = $stripePackages;
         $page="checkout.choosepackage";
        return view($page,$this->data);
       

        
    }

    protected function setUp()
    {
        ApiRequestor::setHttpClient(HttpClient\CurlClient::instance());
        $this->mock = null;
        $this->call = 0;
    }

    protected function mockRequest($method, $path, $params = array(), $return = array('id' => 'myId'), $rcode = 200)
    {
        $mock = $this->setUpMockRequest();
        $mock->expects($this->at($this->call++))
             ->method('request')
             ->with(strtolower($method), 'https://api.stripe.com' . $path, $this->anything(), $params, false)
             ->willReturn(array(json_encode($return), $rcode, array()));
    }

    private function setUpMockRequest()
    {
        if (!$this->mock) {
            self::authorizeFromEnv();
            $this->mock = $this->getMock('\Stripe\HttpClient\ClientInterface');
            ApiRequestor::setHttpClient($this->mock);
        }
        return $this->mock;
    }

    /**
     * Create a valid test charge.
     */
    protected static function createTestCharge($id=0)
    {
        self::authorizeFromEnv();

        return Charge::create(
            $attributes = array(
                'amount' => 2000,
                'currency' => 'EUR',
                'description' => 'Charge for EVTEST.com',
                'card' => array(
                    'number' => '4242424242424242',
                    'exp_month' => 5,
                    'exp_year' => date('Y') + 3,
                ),
            )
        );
    }

    /**
     * Create a valid test charge.
     */
    protected static function createTestTransfer(array $attributes = array())
    {
        self::authorizeFromEnv();

        $recipient = self::createTestRecipient();

        return Transfer::create(
            $attributes + array(
                'amount' => 2000,
                'currency' => 'usd',
                'description' => 'Transfer to test@example.com',
                'recipient' => $recipient->id
            )
        );
    }

    /**
     * Create a valid test customer.
     */
    protected static function createTestCustomer(array $attributes = array())
    {
        self::authorizeFromEnv();

        return Customer::create(
            $attributes + array(
                'card' => array(
                    'number' => '4242424242424242',
                    'exp_month' => 5,
                    'exp_year' => date('Y') + 3,
                ),
            )
        );
    }

    /**
     * Create a valid test recipient
     */
    protected static function createTestRecipient(array $attributes = array())
    {
        self::authorizeFromEnv();

        return Recipient::create(
            $attributes + array(
                'name' => 'PHP Test',
                'type' => 'individual',
                'tax_id' => '000000000',
                'bank_account' => array(
                    'country'    => 'US',
                    'routing_number' => '110000000',
                    'account_number'  => '000123456789'
                ),
            )
        );
    }

    /**
     * Create a test account
     */
    protected static function createTestAccount(array $attributes = array())
    {
        self::authorizeFromEnv();

        return Account::create(
            $attributes + array(
                'managed' => false,
                'country' => 'US',
                'email' => self::generateRandomEmail(),
            )
        );
    }

    /**
     * Verify that a plan with a given ID exists, or create a new one if it does
     * not.
     */
    protected static function retrieveOrCreatePlan($id)
    {
        self::authorizeFromEnv();

        try {
            $plan = Plan::retrieve($id);
        } catch (Error\InvalidRequest $exception) {
            $plan = Plan::create(
                array(
                    'id' => $id,
                    'amount' => 0,
                    'currency' => 'usd',
                    'interval' => 'month',
                    'name' => 'Gold Test Plan',
                )
            );
        }
    }

    /**
     * Verify that a plan with a given ID exists, or create a new one if it does
     * not.
     */
    protected static function createPlan($id)
    {
        self::authorizeFromEnv();

        try {


            $plan = Plan::create(
                array(
                    'id' => $id,
                    'amount' => 0,
                    'currency' => 'eur',
                    'interval' => 'month',
                    'name' => 'Gold Test Plan',
                )
            );


        } catch (Error\InvalidRequest $exception) {
            $plan = Plan::create(
                array(
                    'id' => $id,
                    'amount' => 0,
                    'currency' => 'usd',
                    'interval' => 'month',
                    'name' => 'Gold Test Plan',
                )
            );
        }
    }

    /**
     * Verify that a coupon with a given ID exists, or create a new one if it
     * does not.
     */
    protected static function retrieveOrCreateCoupon($id)
    {
        self::authorizeFromEnv();

        try {
            $coupon = Coupon::retrieve($id);
        } catch (Error\InvalidRequest $exception) {
            $coupon = Coupon::create(
                array(
                    'id' => $id,
                    'duration' => 'forever',
                    'percent_off' => 25,
                )
            );
        }
    }

    /**
     * Genereate a semi-random string
     */
    protected static function generateRandomString($length = 24)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTU';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Generate a semi-random email.
     */
    protected static function generateRandomEmail($domain = 'bar.com')
    {
        return self::generateRandomString().'@'.$domain;
    }

    protected static function createTestBitcoinReceiver($email)
    {
        $receiver = BitcoinReceiver::create(
            array(
                'amount' => 100,
                'currency' => 'usd',
                'description' => 'some details',
                'email' => $email
            )
        );
        return $receiver;
    
}


public function checkoutPost(Request $request)
    {
            
        $userID=\Session::get('uid'); 
            $user = User::find($userID);
           
            $input = $request->all();
    
            self::authorizeFromEnv();

            \Stripe\Stripe::setApiKey("sk_test_C0Mmp1B1ZzxMbnpq4EJLNoOg");

            // Token is created using Checkout or Elements!
            // Get the payment token ID submitted by the form:
            $token = $_POST['stripeToken'];

           try {

                        
                        $orddta['status'] = 'Pending'; 
                        $orddta['comments'] = $request->input('order_comments'); 
                        $orddta['user_id'] = \Session::get('uid'); 
                        $orddta['created'] = date('y-m-d h:i:s'); 
                        $ord_id = \DB::table('tb_orders')->insertGetId($orddta);
                        $package_idsarr = array();
                        foreach ($request->session()->get('hotel_cart') as $cartkey => $cartValue) {



                            $orditemdta['order_id'] = $ord_id; 
                           
                            if($cartValue['package']['type']=='hotel'){
                                 $orditemdta['package_type'] = $cartValue['package']['type']; 
                                 $orditemdta['package_id'] = $cartValue['package']['id'];
                                 $package_idsarr[] = $orditemdta['package_id'];
                                
                                $packgeDataDetalis = DB::table('tb_packages')->where('id',$cartValue['package']['id'])->get();
                                $orditemdta['package_data'] = json_encode($packgeDataDetalis);
                            }
                            if($cartValue['package']['type']=='advert'){
                                 $orditemdta['package_type'] = $cartValue['package']['type']; 
                                 $orditemdta['package_id'] = $cartValue['package']['content']['id'];
                                 $orditemdta['package_data'] = json_encode($cartValue['package']['content']);
                                 $package_idsarr[] = $orditemdta['package_id'];
                            }
                            
                            $orditemdta['user_id'] = \Session::get('uid'); 
                            $orditemdta['created'] = date('y-m-d h:i:s'); 
                            \DB::table('tb_order_items')->insertGetId($orditemdta);
                        }

                // Charge the user's card:
                   $charge = \Stripe\Charge::create(array(
                      "amount" =>((int)$request->input("finalAmount")*100),
                      "currency" => "EUR",
                      "description" => "Package Charges",
                      "source" => $token,
                      "metadata" => array("order_id" => $ord_id),
                    ));

                    $jsnonString=$charge;
                    $stringFromOb=str_replace("Stripe\Charge JSON: ", "", $jsnonString);
                    $jarray=json_decode($stringFromOb);
                    //print_r($catArray);
                    //echo "<pre>";
                   // print_r ($jarray->outcome->network_status);

                    if($jarray->outcome->network_status=="approved_by_network"){
						
						$invoice_num = \DB::table('tb_settings')->where('key_value', 'default_invoice_num')->first();
						$exp_num = $invoice_num->content;

                        $orddta['status'] = 'Success'; 
                        $orddta['comments'] = $request->input('order_comments'); 
                        $orddta['user_id'] = \Session::get('uid'); 
                        $orddta['updated'] = date('y-m-d h:i:s'); 
						$orddta['invoice_num'] = $exp_num; 
                        \DB::table('tb_orders')->where('id',$ord_id)->update($orddta);
						
						\DB::table('tb_settings')->where('key_value', 'default_invoice_num')->update(['content' => ++$exp_num]);
                        
                        if(count($package_idsarr) > 0){
                            $usersContracts = \DB::table('tb_users_contracts')->select('tb_users_contracts.id','tb_users_contracts.contract_id','tb_users_contracts.title','tb_users_contracts.description')->where('tb_users_contracts.contract_type','packages')->orderBy('tb_users_contracts.contract_id','DESC')->where('tb_users_contracts.status',1)->where('tb_users_contracts.is_expried',0)->where('tb_users_contracts.deleted',0)->get();
                            $resetContracts = array();
                            foreach($usersContracts as $si_contract){
                                $resetContracts[$si_contract->contract_id] = $si_contract;
                            }
                            $this->data['userContracts'] = $resetContracts;
                            $contracts = \CommonHelper::get_default_contracts('packages','tb_contracts.*',0,$package_idsarr);
                            $common_contracts = $contracts['common'];
                            $tpackage_contracts = $contracts['packages_wise'];
                            $package_contracts = array();
                            foreach($package_idsarr as $si_pack){
                                if(isset($tpackage_contracts[$si_pack])){
                                    foreach($tpackage_contracts[$si_pack] as $su_con){
                                        $tobj = $su_con;
                                        $tobj->package_id = $si_pack;
                                        $tobj->order_id = $ord_id;
                                        $package_contracts[$su_con->contract_id] = $tobj;
                                    }                                    
                                }
                            }
                            
                            foreach($common_contracts as $sicommon){
                                if(!isset($package_contracts[$sicommon->contract_id])){
                                    $sicommon->order_id = $ord_id;
                                    $package_contracts[$sicommon->contract_id] = $sicommon;
                                }                                
                            }
                            //echo "<pre>";print_r($package_contracts);die;
                            if(count($package_contracts) > 0){
                                //insert contracts
                                $package_idsarr[] = null;
                                \CommonHelper::submit_contracts($package_contracts,'packages',$package_idsarr);
                                //End
                            }
                        }
                       
                        $userinfom = User::find(\Session::get('uid'));

                           $pathToFile['path'] = $this->generateInvoice($ord_id);
                            //echo $pathToFile; die;
                            $pathToFile['name'] = 'invoice-'.date('d-m-Y-h:i:s').'.pdf';
                            $pathToFile['useremail'] = $userinfom->email;
                            if($pathToFile)
                            {
                                $data = array();
                                \Mail::send('user.emails.invoice', $data, function($message) use ($pathToFile)
                                {
                                    $message->from(CNF_EMAIL, CNF_APPNAME);
                                    $message->subject("Your Order Invoice");
                                    $message->to( $pathToFile['useremail']);

                                    $message->attach($pathToFile['path'], ['as' => $pathToFile['name'], 'mime' => 'pdf']);
                                    
                                });
                            }


                            $this->data['pageTitle'] = 'Thank you Page';
                            $this->data['data'] = CommonHelper::getInfo();
                            $this->data['pageslider'] = "";
                            $this->data['currency'] = \DB::table('tb_settings')->select('content')->where('key_value', 'default_currency')->first();

                            return view('frontend.hotel_membership.thanks', $this->data);
                    }else{

                        return back()->with('success','Subscription is completed.');
                    }
                  

                
            } catch (Exception $e) {
                return back()->with('success',$e->getMessage());
            }
            
    }




public function generateInvoice($ordid)
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
                        .main { margin:2px; width:100%; font-family: arial, sans-serif; } 
                        .page-break { page-break-after: always; } 
                        
                        .header{ width: 100%; position:fixed; top: -35px; text-align:center; height:200px;} 
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
                        td{font-size:12px; padding:1px;} 
                        th{background-color:#999; color:#000000; text-align:left; padding:1px; font-size:14px;}
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
                        
                        @media print {
                          body, page {
                            margin: 0;
                            box-shadow: 0;
                          }
                        }

                </style>';
                
                $i=1;
                $html .= '
            
                    
                <div class="main">
                  <div class="header">

                      <table width="100%">
                     
                         <tr>
                            <td class="title" align="center">
                                
                                <center><img src="'. \URL::to('sximo/assets/images/logo-design_1.png').'" width="250px;" height="50px;"></center>
                                 
                            </td>
                         </tr>
                            <tr>
                            <td class="title" align="center">
                                <center> &nbsp;</center>
                            </td>
                         </tr>
                    
                        
                     </table>
                        
                  </div>
                  <div style="clear:both;"> &nbsp;</div>
                    <div class="footer">

                            <table width="100%">
                            <tr>
                                <td colspan="3">
                                        <hr  style="border-top:1px solid #000;"/>
                                 </td>
                             </tr>
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
                
                $html .= '
                <div>
                <table width="100%">
                 <tr>
                    <td colspan="2" align="right">
                        <hr  style="border-top:1px solid #000; width:100%"/>
                    </td>
                 </tr>
                    <tr style="border-top:1px solid #000;">
                        <td width="50%">';
                            $html .= 'Tel: '.$invoice_phone_num->content . ' email: ' .$invoice_email_id->content;
                $html .= '</td>

                <td width="50%" class="valinbt">';
                $html .= $invoice_address->content;
                $html .= '</td></tr>

                </table></div>';
                
                $html .= '';
                $html .= '
                <div class="Mrgtop20 font13">
                
                <table width="100%" border="0px">
                 <tr>
                    <td colspan="2" align="right"  height="60px;">&nbsp;</td>
                 </tr>
                 <tr>
                    <td colspan="2" class="title" align="right">Invoice</td>
                 </tr>
                        <tr>
                            <td width="48%" align="left">
                                    

                                <table width="100%" >
                                    <tr>                                         
                                        <td>


                                        <p>'. $companydet->company_address .' . '.$companydet->company_address2 .'

                                        <br/>'.$companydet->company_city .'<br/>

                                        '. $companydet->company_postal_code.' . '.$companydet->company_country .'
                                        </p>

                                        </td>
                                    </tr>
                                    
                                </table>
                                 
                                 </td>
                                 <td width="48%" align="right">

                                    
                                        <table width="100%" >
                                            <tr>
                                                
                                                <td  align="right">Date:</td>
                                                <td  align="right" width="10px">&nbsp;&nbsp;</td>
                                                <td  class="alnRight" class="alnRight">'.date('Y.m.d').'</td>
                                            </tr>
                                            <tr>
                                                
                                                <td  align="right">Invoice Number:</td>
                                                <td  align="right" width="10px">&nbsp;&nbsp;</td>
                                                <td  align="right" class="alnRight" >'. $invoice_num->content .'</td>
                                            </tr>
                                            <tr>
                                            
                                            <td   align="right" width="200px">Contact&nbsp;Person:</td>
                                            <td  align="right" width="10px">&nbsp;&nbsp;</td>
                                            <td  align="right" class="alnRight">'. $userInfo->first_name .' '. $userInfo->last_name .'<br>'. $userInfo->email .'</td>
                                            </tr>
                                        </table>
                                     
                                    </td>
                                </tr>
                            </table>
                         </div>
                         <div style="clear:both;"></div>
                         ';
            
                
                $html .= '<div style="clear:both;"></div><div class="Mrgtop20 font13"><table width="100%">
                 <tr>
                    <td colspan="4" align="right"  height="25px;">&nbsp;</td>
                 </tr>
                <tr style="background:#eeeeee;"><th width="10%">No.</th><th width="50%" >Item </th><th width="20%" class="algCnt">Quantity </th><th width="20%" class="algRgt">Price(Excl.VAT) </th></tr>';
                
                
                
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
                        $html .= '<tr><td>'.$nos.'</td><td><b>'.$title.'</b></td><td class="algCnt">'.$qty.'</td><td class="algRgt">'.$currency->content . $pacpric.'</td></tr>';
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
                        
                        $html .= '<tr><td>'.$nos.'</td><td><b>Advertisement</b><br>'.$adsdata.'</td><td class="algCnt">'.$dsqty.'</td><td class="algRgt">'.$currency->content . $pacpric.'</td></tr>';
                    }
                    $nos++;
                    $qtyPr = $pacpric * $qty;
                    $Totprice = $Totprice + $qtyPr;
                }
                $html .= '<tr><td colspan="3" style="text-align:right;"><b>Total(Excl.VAT)<b></td><td class="algRgt font13"><b>'.$currency->content .' '.($Totprice -(($Totprice*$this->data['data']['vatsettings']->content)/100)).'<b></td></tr>';
                $html .= '<tr><td colspan="3" style="text-align:right;"><b>VAT('. $this->data['data']['vatsettings']->content .'%)<b></td><td class="algRgt font13"><b>'.$currency->content .' '.(($Totprice*$this->data['data']['vatsettings']->content)/100).'<b></td></tr>';

                $html .= '<tr><td colspan="4"><hr  style="border-top:1px solid #000; width:100%"/></td>';

                $html .= '<tr><td colspan="3" class="algRgt font13"><b>Total<b></td><td class="algRgt font13"><b>'.$currency->content .' '.number_format($Totprice, 2, '.', ',').'<b></td></tr>';
                $html .= '<tr><td colspan="4"><hr  style="border-top:1px solid #000; width:100%"/></td>';
                $html .= '</table></div>';
            
			
				$savePdfpath = public_path() . '/uploads/invoice_pdfs/';
                $pdf = \App::make('dompdf.wrapper');                
                $pdf->loadHTML($html);
                $pdf->save($savePdfpath . $downFileName);
                return $savePdfpath . $downFileName;
			}
            else{
                return 'error';
            }
        }
        else{
            return 'error';
        }
    }

    public function wizardcheckoutPost(Request $request)
    {
            
        $userID=\Session::get('uid'); 
            $user = User::find($userID);
           
            $input = $request->all();
    
            self::authorizeFromEnv();

            \Stripe\Stripe::setApiKey("sk_test_C0Mmp1B1ZzxMbnpq4EJLNoOg");

            // Token is created using Checkout or Elements!
            // Get the payment token ID submitted by the form:
            $token = $_POST['stripeToken'];

           try {

                        
                        $orddta['status'] = 'Pending'; 
                        $orddta['comments'] = $request->input('order_comments'); 
                        $orddta['user_id'] = \Session::get('uid'); 
                        $orddta['created'] = date('y-m-d h:i:s'); 
                        $ord_id = \DB::table('tb_orders')->insertGetId($orddta);
                        $package_idsarr = array();
                        foreach ($request->session()->get('hotel_cart') as $cartkey => $cartValue) {



                            $orditemdta['order_id'] = $ord_id; 
                           
                            if($cartValue['package']['type']=='hotel'){
                                 $orditemdta['package_type'] = $cartValue['package']['type']; 
                                 $orditemdta['package_id'] = $cartValue['package']['id'];
                                 $package_idsarr[] = $orditemdta['package_id'];
                                
                                $packgeDataDetalis = DB::table('tb_packages')->where('id',$cartValue['package']['id'])->get();
                                $orditemdta['package_data'] = json_encode($packgeDataDetalis);
                            }
                            if($cartValue['package']['type']=='advert'){
                                 $orditemdta['package_type'] = $cartValue['package']['type']; 
                                 $orditemdta['package_id'] = $cartValue['package']['content']['id'];
                                 $orditemdta['package_data'] = json_encode($cartValue['package']['content']);
                                 $package_idsarr[] = $orditemdta['package_id'];
                            }
                            
                            $orditemdta['user_id'] = \Session::get('uid'); 
                            $orditemdta['created'] = date('y-m-d h:i:s'); 
                            \DB::table('tb_order_items')->insertGetId($orditemdta);
                        }

                // Charge the user's card:
                   $charge = \Stripe\Charge::create(array(
                      "amount" =>((int)$request->input("finalAmount")*100),
                      "currency" => "EUR",
                      "description" => "Package Charges",
                      "source" => $token,
                      "metadata" => array("order_id" => $ord_id),
                    ));

                    $jsnonString=$charge;
                    $stringFromOb=str_replace("Stripe\Charge JSON: ", "", $jsnonString);
                    $jarray=json_decode($stringFromOb);
                    //print_r($catArray);
                    //echo "<pre>";
                   // print_r ($jarray->outcome->network_status);

                    if($jarray->outcome->network_status=="approved_by_network"){
						
						$invoice_num = \DB::table('tb_settings')->where('key_value', 'default_invoice_num')->first();
						$exp_num = $invoice_num->content;

                        $orddta['status'] = 'Success'; 
                        $orddta['comments'] = $request->input('order_comments'); 
                        $orddta['user_id'] = \Session::get('uid'); 
                        $orddta['updated'] = date('y-m-d h:i:s'); 
						$orddta['invoice_num'] = $exp_num; 
                        \DB::table('tb_orders')->where('id',$ord_id)->update($orddta);
						
						\DB::table('tb_settings')->where('key_value', 'default_invoice_num')->update(['content' => ++$exp_num]);
                        
                        if(count($package_idsarr) > 0){
                            $usersContracts = \DB::table('tb_users_contracts')->select('tb_users_contracts.id','tb_users_contracts.contract_id','tb_users_contracts.title','tb_users_contracts.description')->where('tb_users_contracts.contract_type','packages')->orderBy('tb_users_contracts.contract_id','DESC')->where('tb_users_contracts.status',1)->where('tb_users_contracts.is_expried',0)->where('tb_users_contracts.deleted',0)->get();
                            $resetContracts = array();
                            foreach($usersContracts as $si_contract){
                                $resetContracts[$si_contract->contract_id] = $si_contract;
                            }
                            $this->data['userContracts'] = $resetContracts;
                            $contracts = \CommonHelper::get_default_contracts('packages','tb_contracts.*',0,$package_idsarr);
                            $common_contracts = $contracts['common'];
                            $tpackage_contracts = $contracts['packages_wise'];
                            $package_contracts = array();
                            foreach($package_idsarr as $si_pack){
                                if(isset($tpackage_contracts[$si_pack])){
                                    foreach($tpackage_contracts[$si_pack] as $su_con){
                                        $tobj = $su_con;
                                        $tobj->package_id = $si_pack;
                                        $tobj->order_id = $ord_id;
                                        $package_contracts[$su_con->contract_id] = $tobj;
                                    }                                    
                                }
                            }
                            
                            foreach($common_contracts as $sicommon){
                                if(!isset($package_contracts[$sicommon->contract_id])){
                                    $sicommon->order_id = $ord_id;
                                    $package_contracts[$sicommon->contract_id] = $sicommon;
                                }                                
                            }
                            //echo "<pre>";print_r($package_contracts);die;
                            if(count($package_contracts) > 0){
                                //insert contracts
                                $package_idsarr[] = null;
                                \CommonHelper::submit_contracts($package_contracts,'packages',$package_idsarr);
                                //End
                            }
                        }
                       
                        \DB::table('tb_users')->where('id', \Session::get('uid'))->update(array('new_user'=>0, 'form_wizard'=>5));
                       
                        /*$userinfom = User::find(\Session::get('uid'));

                           $pathToFile['path'] = $this->generateInvoice($ord_id);
                            //echo $pathToFile; die;
                            $pathToFile['name'] = 'invoice-'.date('d-m-Y-h:i:s').'.pdf';
                            $pathToFile['useremail'] = $userinfom->email;
                            if($pathToFile)
                            {
                                $data = array();
                                \Mail::send('user.emails.invoice', $data, function($message) use ($pathToFile)
                                {
                                    $message->from(CNF_EMAIL, CNF_APPNAME);
                                    $message->subject("Your Order Invoice");
                                    $message->to( $pathToFile['useremail']);

                                    $message->attach($pathToFile['path'], ['as' => $pathToFile['name'], 'mime' => 'pdf']);
                                    
                                });
                            }
*/
                            $this->data['user'] = $user;
                            $this->data['pageTitle'] = 'Thank you Page';
                            $this->data['data'] = CommonHelper::getInfo();
                            $this->data['pageslider'] = "";
                            $this->data['currency'] = \DB::table('tb_settings')->select('content')->where('key_value', 'default_currency')->first();
                            
                            $group_id = \Session::get('gid');
                            $is_demo6 = trim(\CommonHelper::isHotelDashBoard($group_id));
                            
                            $file_name = (strlen($is_demo6) > 0)?$is_demo6.'/frontend.hotel_membership.thanks':'frontend.hotel_membership.thanks';   
                            return view($file_name, $this->data);
                    }else{

                        return back()->with('success','Subscription is completed.');
                    }
                  

                
            } catch (Exception $e) {
                return back()->with('success',$e->getMessage());
            }
            
    }


}