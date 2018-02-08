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
                        foreach ($request->session()->get('hotel_cart') as $cartkey => $cartValue) {



                            $orditemdta['order_id'] = $ord_id; 
                           
                            if($cartValue['package']['type']=='hotel'){
                                 $orditemdta['package_type'] = $cartValue['package']['type']; 
                                 $orditemdta['package_id'] = $cartValue['package']['id'];
                            }
                            if($cartValue['package']['type']=='advert'){
                                 $orditemdta['package_type'] = $cartValue['package']['type']; 
                                 $orditemdta['package_id'] = $cartValue['package']['content']['id'];
                                 $orditemdta['package_data'] = json_encode($cartValue['package']['content']);
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

                        $orddta['status'] = 'Success'; 
                        $orddta['comments'] = $request->input('order_comments'); 
                        $orddta['user_id'] = \Session::get('uid'); 
                        $orddta['created'] = date('y-m-d h:i:s'); 
                        \DB::table('tb_orders')->where('id',$ord_id)->update($orddta);
                       
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
                $html = '<style> .main { margin:0 25px; width:700px; font-family: arial, sans-serif; } .page-break { page-break-after: always; } .header,.footer {width: 100%; position:fixed;} .header { top: 20px; text-align:center;} .footer {bottom: 30px; font-size:10px;} .pagenum:after {content: counter(page);} .imgBox { text-align:center; width:400px; margin:50px auto 30px auto;} .nro { text-align:center; font-size:12px; } .header img { width:250px; height: 50px; } .Mrgtop80 {margin-top:80px;} .Mrgtop40 {margin-top:40px;} .Mrgtop20 {margin-top:10px;} .monimg img { width:125px; height:80px; }  .font13 { font-size:13px; } .font12 { font-size:12px; } .algRgt { text-align:right; } .algCnt { text-align:center; }</style>';
                $i=1;
                $html .= '<div class="main"><div class="header"><img src="'. \URL::to('sximo/assets/images/logo-design_1.png').'"></div><br><br><br><div class="footer">© Copyright: Emporium Voyage</div>';
                
                $userInfo = \DB::table('tb_users')->where('id', $order_item[0]->user_id)->first();
                $companydet = \DB::table('tb_user_company_details')->where('user_id', $order_item[0]->user_id )->first();
                $html .= '<div class="Mrgtop40 font13"><table><tr><td width="250"> Emporium-Daten : </td> <td width="20"></td> <td width="250"> User-Daten : </td> </tr> <tr><td valign="top"> Emporium voyage <br><br> Am Klosterpark 1 <br> 84427, Armstorf <br> Deutschland <br><br> Telefon: +49 (0)80 81 - 95 46 80 <br> Telefax: +49 (0)80 81 - 95 43 31 <br> E-Mail: info@emporium-voyage.com </td> <td></td>';
                if(!empty($companydet))
                {
                    $html .= '<td> '.$companydet->company_name.'<br><br>'.$companydet->company_address .' . '.$companydet->company_address2 .' <br> '. $companydet->company_postal_code .', '.$companydet->company_city .' <br> '.$companydet->company_country.'<br><br>Telefon: '.$companydet->company_phone.'<br>E-Mail: '.$companydet->company_email.'</td>';
                }
                else{
                    $html .= '<td></td>';
                }
                $html .='</tr> </table></div>';
                $html .= '<div class="Mrgtop80 font13"><table><tr style="background:#eeeeee;"><th width="50">No.</th><th width="320" >PACKAGES </th><th width="50" class="algCnt">QTY </th><th width="80" class="algCnt">PRICE </th></tr>';
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
                        
                        $html .= '<tr><td>'.$nos.'</td><td><b>Advertisement</b><br>'.$adsdata.'</td><td class="algCnt">'.$qty.'</td><td class="algCnt">'.$currency->content . $pacpric.'</td></tr>';
                    }
                    $nos++;
                    $qtyPr = ((int)$pacpric * $qty);
                    $Totprice = $Totprice + $qtyPr;
                }
                $html .= '<tr><td colspan="3" style="text-align:right;"><b>Gesammtsumme<b></td><td class="algCnt font13"><b>'.$currency->content .' '.number_format($Totprice, 2, '.', ',').'<b></td></tr>';
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



}