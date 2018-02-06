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
            
           // $this->middleware('auth');
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
            $user = User::find(1);
           
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
                      "amount" => $request->input("finalAmount"),
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



}