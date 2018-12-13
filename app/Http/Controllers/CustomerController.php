<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use App\Models\Userorder;
use Socialize;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator,Input, Redirect;
use App\Models\Contract;
use DB, CommonHelper;
class CustomerController extends Controller {

    protected $layout = "layouts.main";

    public function __construct() {
        parent::__construct();
        $this->data['pageTitle'] = '';
        $this->data['data'] = CommonHelper::getInfo();
        $this->data['pageslider'] = \DB::table('tb_pages_sliders')->select( 'slider_title', 'slider_description', 'slider_img', 'slider_link', 'slider_video', 'slide_type')->where('slider_page_id', 107)->get();


        $this->data['pageTitle'] = "Front end dashboard";
        $this->data['pageMetakey'] = "Front end dashboard";
        $this->data['pageMetadesc'] = "Front end dashboard";
    }

    public function getRegister($pid) {

        if (CNF_REGIST == 'false') :
            if (\Auth::check()):
                return Redirect::to('')->with('message', \SiteHelpers::alert('success', 'Youre already login'));
            else:
                return Redirect::to('customer/login');
            endif;

        else :
            $this->data['planId'] = $pid;
            $plan = \DB::table('tb_membership')->where('status', 1)->get();
            $this->data['plans'] = $plan;
            return view('customer.register', $this->data);
        endif;
    }

    public function postCreate(Request $request) {

        $rules = array(
//            'firstname' => 'required|alpha_num|min:2',
//            'lastname' => 'required|alpha_num|min:2',
                'email' => 'required|email|unique:tb_users',
                'password' => 'required',
                'mobile_code' => 'required',                
                'mobile_number' => 'required',
//            'password' => 'required|confirmed',
//            'password_confirmation' => 'required',
            //'membership_plan'=>'required',
//            'company_name' => 'required',
//            'company_address' => 'required',
//            'company_address2' => 'required',
//            'company_phone' => 'required',
            //'company_website'=>'required',
            //'company_tax_no'=>'required',
//            'accept_terms' => 'required'
        );
        if (CNF_RECAPTCHA == 'true')
            $rules['recaptcha_response_field'] = 'required|recaptcha';

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            $code = rand(10000, 10000000);

            $authen = new User;
//            $authen->first_name = $request->input('firstname');
//            $authen->last_name = $request->input('lastname');
            $authen->email = trim($request->input('email'));
            $authen->activation = $code;
            $authen->group_id = 3;
            $authen->password = \Hash::make($request->input('password'));
            $authen->active = '0';
            $authen->save();

            $ucdata['user_id'] = $authen->id;
//            $ucdata['company_name'] = Input::get('company_name');
//            $ucdata['company_address'] = Input::get('company_address');
//            $ucdata['company_address2'] = Input::get('company_address2');
            //$ucdata['company_phone'] = Input::get('company_phone');
            //$ucdata['company_website'] = Input::get('company_website');
            //$ucdata['company_tax_number'] = Input::get('company_tax_no');
            if (Input::get('accept_terms')) {
//                $ucdata['accept_terms'] = Input::get('accept_terms');
            }

            \DB::table('tb_user_company_details')->insert($ucdata);

            /* $umdata['user_id'] = $authen->id;
              $umdata['membership_id'] = $request->input('membership_plan');
              $umdata['created'] = date('Y-m-d h:i:s');
              $umId = \DB::table('tb_users_membership')->insertGetId($umdata); */

            //return Redirect::to('choose/'.$umId);

            return Redirect::to('customer/login')->with('message', \SiteHelpers::alert('success', 'Registered successfully.'));
        } else {
            return Redirect::to('customer/register/' . $request->input('membership_plan'))->with('message', \SiteHelpers::alert('error', 'The following errors occurred')
                    )->withErrors($validator)->withInput();
        }
    }

    public function ajaxPostCreate(Request $request) {

        $rules = array(
            'user_type' => 'required|integer',
            'email' => 'required|email|ignore_lead_user',
            'password' => 'required|min:8|has_letters|has_one_upper_case|has_special_chars',
            'txtmobileNumber' =>'required',
        );
        if (CNF_RECAPTCHA == 'true')
            $rules['recaptcha_response_field'] = 'required|recaptcha';
        
        Validator::extend('has_letters', function ($attribute, $value, $parameters, $validator) {
            return preg_match( '/[a-zA-Z]/', $value );
        });
        
        Validator::extend('has_one_upper_case', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/[A-Z]+/', $value);
        });
        
        Validator::extend('has_numbers', function ($attribute, $value, $parameters, $validator) {
            return preg_match( '/\d/', $value );
        });
        
        Validator::extend('has_special_chars', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/[^a-zA-Z\d]/', $value);
        });
        
        Validator::extend('ignore_lead_user', function ($attribute, $value, $parameters, $validator) {
            return $this->check_lead_user($value);
        });
        
        $messages = array(
            'has_letters' => 'The :attribute field must be at least one alpha character.',
            'has_numbers' => 'The :attribute field must be at least one numeric character.',
            'has_special_chars' => 'The :attribute field must be at least one non-alphanumeric (!, @, # etc.) character.',
            'has_one_upper_case' => 'The :attribute field must be at least one uppercase character.',
            'ignore_lead_user' => 'Email is already exist',
        );
        
        if($request->input('user_type') == '3'):
            $rules['referral_code'] = 'required'; 
        endif;
        
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {
            $code = rand(10000, 10000000);
                        
    		$obj_user  = \DB::table('tb_users')->where('email', trim($request->input('email')))->first();
 
            $user_data['email'] = trim($request->input('email'));
            $user_data['activation'] = $code;
            $user_data['group_id'] = (int) $request->input('user_type');
            $user_data['mobile_number'] =trim($request->input('txtmobileNumber'));
            $user_data['mobile_code'] =trim($request->input('txtmobileDialcode'));
            $user_data['password'] = \Hash::make($request->input('password'));
            
            if($request->input('user_type') == '3'):
                $user_data['new_user'] = '1';
            endif;
            
            if($request->input('user_type') == '3'){
                $referral_code = trim($request->input('referral_code'));
                $ref_code = true;
                $inv_id = '';
                $today = date('Y-m-d');
                $invitee = \DB::table('tb_invitee')->where('email', trim($request->input('email')))->where('status', 0)->where('expired_on', '>', $today)->get();
                
                if(count($invitee)>0){
                    foreach($invitee as $invite){                        
                        if($invite->referral_code==$referral_code){
                            $inv_id = $invite->id;
                            $inv_uid = $invite->user_id;
                            $ref_code = false;
                        }
                    }
                    if($ref_code){
                        $response = array('status' => 'error', 'message' => 'Refferal Code not matched', 'gid' => $authen->group_id, 'errors'=>true);
                    }else{
                        
                        $user_data['active'] = '1';
                        if(isset($obj_user->id)){
                             $user_id = \DB::table('tb_users')->where('id', $obj_user->id)->update($user_data); 
                             $user_id = $obj_user->id;                          
                        }else{                        
                            //$authen->save();
                            $user_id = \DB::table('tb_users')->insertGetId($user_data);
                        }    
                            $ucdata['user_id'] = $user_id;
                            $userId = $user_id;
                            
                            $clint_number = date('y')."101".str_pad($userId, 5, 0, STR_PAD_LEFT);
                            
                            \Auth::loginUsingId($userId);
                            \DB::table('tb_users')->where('id', '=', $userId)->update(array('last_login' => date("Y-m-d H:i:s"), 'client_number'=>$clint_number));
                            \Session::put('uid', $userId);
                            \Session::put('gid', $user_data['group_id']);
                            \Session::put('eid', $user_data['email']);
                            \Session::put('ll', date("Y-m-d H:i:s"));
                
                            \DB::table('tb_user_company_details')->insert($ucdata);
                            
                            $disdata['user_id']=$inv_uid;
                            $disdata['invitee_id']=$inv_id;
                            $disdata['availability']= 1;
                            
                            \DB::table('tb_user_invitee_discount')->insert($disdata);
                            
                            $edata = array();
                            $edata['email'] = $request->input('email');
                            $edata['password'] = $request->input('password');
                            $edata['firstname'] = '';
                            $emlData['frmemail'] = 'marketing@emporium-voyage.com';
                            //$emlData['email'] = 'riaan@number7even.com';
                            $emlData['email'] = trim($request->input('email'));
                            $emlData['subject'] = 'Registration';
                            
                            $etemp = 'registration';
                            
                            \Mail::send('user.emails.' . $etemp, $edata, function($message) use ($emlData) {
                                $message->from($emlData['frmemail'], CNF_APPNAME);
                
                                $message->to($emlData['email']);
                
                                $message->subject($emlData['subject']);
                            });
                            
                            $response = array('status' => 'success', 'message' => 'Registered successfully', 'gid' => $user_data['group_id']);
                        
                    }
                }else{
                    $response = array('status' => 'error', 'message' => 'Please connect with your referrer to resend your invitation or write us an email on <a href="mailto:marketing@emporium-voyage.com">marketing@emporium-voyage.com', 'gid' => $user_data['group_id'], 'errors'=>true);
                }
            }else{                
                    $user_data['active'] = '1';
                    if(isset($obj_user->id)){
                        $user_id = \DB::table('tb_users')->where('id', $obj_user->id)->update($user_data);
                        $user_id = $obj_user->id;
                    }else{                        
                        //$authen->save();
                        $user_id = \DB::table('tb_users')->insertGetId($user_data);
                    }
                    $ucdata['user_id'] = $user_id;
                    $userId = $user_id; 
                    
                    $clint_number = date('y')."101".str_pad($userId, 5, 0, STR_PAD_LEFT);
                     
                    \Auth::loginUsingId($userId);
                    \DB::table('tb_users')->where('id', '=', $userId)->update(array('last_login' => date("Y-m-d H:i:s"), 'client_number'=>$clint_number));
                    \Session::put('uid', $userId);
                    \Session::put('gid', $user_data['group_id']);
                    \Session::put('eid', $user_data['email']);
                    \Session::put('ll', date("Y-m-d H:i:s"));     
                    
       
                    if (Input::get('accept_terms')) {
        //                $ucdata['accept_terms'] = Input::get('accept_terms');
                    }
        
                    \DB::table('tb_user_company_details')->insert($ucdata);                        
                    
                    $edata = array();
                    $edata['email'] = $request->input('email');
                    $edata['password'] = $request->input('password');
                    $edata['firstname'] = '';
                    $emlData['frmemail'] = 'marketing@emporium-voyage.com';
                    //$emlData['email'] = 'riaan@number7even.com';
                    $emlData['email'] = trim($request->input('email'));
                    $emlData['subject'] = 'Registration';
                    
                    $etemp = 'registration';
                    
                    \Mail::send('user.emails.' . $etemp, $edata, function($message) use ($emlData) {
                        $message->from($emlData['frmemail'], CNF_APPNAME);
        
                        $message->to($emlData['email']);
        
                        $message->subject($emlData['subject']);
                    });
                    $response = array('status' => 'success', 'message' => 'Registered successfully', 'gid' => $user_data['group_id']);
            }
        } else {
            $response = array('status' => 'error', 'message' => 'The following errors occurred', 'errors' => $validator->errors()->all());
//            return Redirect::to('customer/register/' . $request->input('membership_plan'))->with('message', \SiteHelpers::alert('error', 'The following errors occurred')
//                    )->withErrors($validator)->withInput();
        }
        
        echo json_encode($response);
    }
    
    public function check_lead_user($email){
        $gp_id = trim(\CommonHelper::getusertype('new-lead'));
		$obj_user  = \DB::table('tb_users')->where('email', $email)->first();
        if(!empty($obj_user)){
            if($obj_user->group_id==$gp_id){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
	}
    
    public function chosepay($mid) {
        $this->data['umid'] = $mid;
        return view('customer.choosepay', $this->data);
    }

    public function showBankDetails($uid) {
        $this->data['userid'] = $uid;
        return view('customer.show_bank_detail', $this->data);
    }

    function bankAgree(Request $request) {
        $rules = array(
            'accept_terms' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {

            $userId = $request->input('usid');
            if ($userId != '') {
                \DB::table('tb_users')->where('id', $userId)->update(['active' => 1]);

                $odata['orderDate'] = date('Y-m-d');
                $odata['status'] = ' Order Placed';
                $odata['comments'] = ' New Signup';
                $odata['customerNumber'] = $userId;
                $ordId = \DB::table('orders')->insertGetId($odata);

                $billTo = \DB::table('tb_user_company_details')->where('user_id', $userId)->first();
                $def_pro_price = \DB::table('tb_membership')->join('tb_users_membership', 'tb_users_membership.membership_id', '=', 'tb_membership.id')->where('tb_users_membership.user_id', $userId)->select('package_price')->first();
                $total = $def_pro_price->package_price;
                $invoice_num = \DB::table('tb_settings')->where('key_value', 'default_invoice_num')->first();
                $exp_num = $invoice_num->content;

                $indata['order_id'] = $ordId;
                $indata['invoice_title'] = 'Invoice';
                $indata['invoice_number'] = ++$exp_num;
                $indata['billing_date'] = date('Y-m-d');
                $indata['from_business_name'] = 'michael hirschel computer publishing gmbh';
                $indata['from_address'] = 'widderbergstr. 23';
                $indata['from_address2'] = '';
                $indata['from_phone'] = '08152 966 714';
                $indata['from_email'] = 'micheal@hirschel.de';

                if (!empty($billTo)) {
                    $indata['to_business_name'] = $billTo->company_name;
                    $indata['to_address'] = $billTo->company_address;
                    $indata['to_address2'] = $billTo->company_address2;
                    $indata['to_phone'] = $billTo->company_phone;
                    $indata['to_email'] = $billTo->company_email;
                }
                $indata['user_id'] = $userId;
                $indata['invoice_sub_total'] = $total;
                $indata['invoice_total_price'] = $total;
                $indata['created'] = date('Y-m-d h:i:s');
                $invId = \DB::table('tb_invoices')->insertGetId($indata);

                \DB::table('tb_settings')->where('key_value', 'default_invoice_num')->update(['content' => $indata['invoice_number']]);

                $userinfom = \DB::table('tb_users')->where('id', $userId)->first();
                $pdata['invoice_id'] = $invId;
                $pdata['product_title'] = 'Signup';
                $pdata['product_desc'] = $userinfom->first_name . ' ' . $userinfom->last_name;
                $pdata['product_qty'] = 1;
                $pdata['product_price'] = $total;
                $pdata['product_tax'] = 0;
                $pdata['product_total'] = $total;
                $pdata['created'] = date('y-m-d h:i:s');
                \DB::table('tb_invoice_products')->insert($pdata);

                $pathToFile['path'] = $this->generateInvoicePdfsave($invId, $userId);
                //echo $pathToFile; die;
                $pathToFile['name'] = 'invoice-' . date('d-m-Y-h:i:s') . '.pdf';
                $pathToFile['useremail'] = $userinfom->email;
                if ($pathToFile) {
                    $data = array();
                    \Mail::send('customer.emails.invoice', $data, function($message) use ($pathToFile) {
                        $message->from(CNF_EMAIL, CNF_APPNAME);

                        $message->to($pathToFile['useremail']);

                        $message->attach($pathToFile['path'], ['as' => $pathToFile['name'], 'mime' => 'pdf']);
                    });
                }

                \Auth::loginUsingId($userId);
                \DB::table('tb_users')->where('id', '=', $userId)->update(array('last_login' => date("Y-m-d H:i:s")));
                \Session::put('uid', $userId);
                \Session::put('gid', 3);
                \Session::put('eid', $userinfom->email);
                \Session::put('ll', date("Y-m-d H:i:s"));

                return Redirect::to('dashboard')->with('messagetext', 'Thanks for registering! . Your account is active now.')->with('msgstatus', 'error');
            }
        }
    }

    function generateInvoicePdfsave($invId, $userId) {
        $downFileName = 'invoice-' . date('d-m-Y-h-i-s') . '.pdf';
        $currency = \DB::table('tb_settings')->where('key_value', 'default_currency')->first();
        $bankdetails = \DB::table('tb_settings')->where('key_value', 'bank_details')->first();
        $regdetail = \DB::table('tb_settings')->where('key_value', 'reg_detail')->first();
        $contactdetail = \DB::table('tb_settings')->where('key_value', 'contact_detail')->first();
        $companydet = \DB::table('tb_user_company_details')->where('user_id', $userId)->first();
        if ($invId != '' && $invId > 0) {
            $invInfo = \DB::table('tb_invoices')->where('id', $invId)->first();

            $html = '<style>.page-break { page-break-after: always; } .header,.footer {width: 100%; position:fixed;}.header {top: 0px;}.footer {bottom: 150px;}.pagenum:after {content: counter(page);}.title {text-align:center; width:700px; font-size:30px; font-weight:bold;} .clrgrey{ color:#3f3f3f;} .alnRight{text-align:right;} .alnCenter{text-align:center;} td{font-size:12px; padding:5px;} th{background-color:#999; color:#fff; text-align:left; padding:5px; font-size:14px;}.totl{background-color:#999; color:#fff; font-weight:bold;} .main{ font-family:Lato, sans-serif;} h2{padding-bottom:0px; margin-bottom:0px;} .valin{ vertical-align:top;} .valinbt{ vertical-align:bottom; text-align:right;}</style>';

            $html .= '<div class="main"><div class="footer"><table><tr><td width="170"><h2>BANKVERBINDUNG</h2></td><td width="170"><h2>REGISTEREINTRAG</h2></td><td width="170"><h2>KONTAKT</h2></td></tr><tr><td class="valin">';
            if (!empty($bankdetails)) {
                $html .= nl2br($bankdetails->content);
            }
            $html .= '</td><td class="valin">';
            if (!empty($regdetail)) {
                $html .= nl2br($regdetail->content);
            }
            $html .= '</td><td class="valin">';
            if (!empty($contactdetail)) {
                $html .= nl2br($contactdetail->content);
            }
            $html .= '</td></tr></table></div>';

            $html .= '<table style="border-bottom:1px solid #000; margin-bottom:10px;"><tr><td width="260">';
            if (!empty($companydet) && $companydet->company_logo != '') {
                $html .= '<img src="' . \URL::to('uploads/users/company/' . $companydet->company_logo) . '" />';
            } else {
                $html .= '<img src="' . \URL::to('sximo/images/logo-sximo.png') . '" style="background-color:#000;"/>';
            }
            $html .= '</td><td width="260" class="valinbt">';
            if (!empty($companydet)) {
                $html .= $companydet->company_address . ' . ' . $companydet->company_address2 . ' . ' . $companydet->company_city . ' . ' . $companydet->company_postal_code . ' . ' . $companydet->company_country;
            }
            $html .= '</td></tr></table>';

            if (!empty($invInfo)) {
                $html .= '<div class="title">' . $invInfo->invoice_title . '</div>';
                $html .= '<div><table><tr><td width="450" class="alnRight"><span class="clrgrey">INVOICE ID: </span></td><td width="70" class="alnRight">' . $invInfo->invoice_number . '</td></tr><tr><td width="450" class="alnRight"><span class="clrgrey">BILLING DATE: </span></td><td width="70" class="alnRight">' . date("d.m.Y", strtotime($invInfo->billing_date)) . '</td></tr><tr><td width="450" class="alnRight"><span class="clrgrey">DUE DATE: </span></td><td width="70" class="alnRight">' . date("d.m.Y", strtotime($invInfo->due_date)) . '</td></tr></table></div><br><br>';

                $html .= '<div><table><tr><th width="260">BILLING FROM</th><th width="260">BILLING TO</th></tr><tr><td><b>' . $invInfo->from_business_name . '</b></td><td><b>' . $invInfo->to_business_name . '</b></td></tr><tr><td>' . $invInfo->from_address . '</td><td>' . $invInfo->to_address . '</td></tr><tr><td>' . $invInfo->from_address2 . '</td><td>' . $invInfo->to_address2 . '</td></tr><tr><td>' . $invInfo->from_phone . '</td><td>' . $invInfo->to_phone . '</td></tr><tr><td>' . $invInfo->from_email . '</td><td>' . $invInfo->to_email . '</td></tr><tr><td>' . $invInfo->from_additional_info . '</td><td>' . $invInfo->to_additional_info . '</td></tr></table></div><br><br>';

                $html .= '<div><table><tr><th width="180">PRODUCT</th><th width="65" class="alnCenter">QUANTITY </th><th width="55" class="alnCenter">PRICE </th><th width="50" class="alnCenter">TAX </th><th width="60" class="alnCenter">DISCOUNT </th><th width="75" class="alnCenter">TOTAL </th></tr>';

                $products = \DB::table('tb_invoice_products')->where('invoice_id', $invId)->get();
                foreach ($products as $product) {
                    $html .= '<tr style="background:#f5f5f5;"><td><b>' . $product->product_title . '</b><br><br>' . $product->product_desc . '</td><td class="alnCenter">' . $product->product_qty . '</td><td class="alnCenter">' . $currency->content . ' ' . $product->product_price . '</td><td class="alnCenter">' . $product->product_tax . ' %</td><td class="alnCenter">' . $product->product_discount . ' %</td><td class="alnCenter">' . $currency->content . ' ' . $product->product_total . '</td></tr>';
                }
                $html .= '<tr style="background:#f5f5f5;"><td colspan="4">&nbsp;</td><td><b>Sub Total</b></td><td class="alnCenter">' . $currency->content . ' ' . $invInfo->invoice_sub_total . '</td></tr>';
                $html .= '<tr class="totl"><td colspan="4">&nbsp;</td><td><b>Total</b></td><td class="alnCenter">' . $currency->content . ' ' . $invInfo->invoice_total_price . '</td></tr>';
                $html .= '</table></div>';
                $html .= '</div>';
            }

            $savePdfpath = public_path() . '/uploads/invoice_pdfs/';
            $retfolderpath = public_path() . '/uploads/invoice_pdfs/';
            $folder = \DB::table('tb_container')->where('name', 'Rechnungen')->first();
            if (!empty($folder)) {
                $downfolder = (new ContainerController)->getContainerUserPath($folder->id);
                if (is_dir($downfolder) === true) {
                    $curr_yr = date('Y');
                    $curr_mon = date('m');
                    $yearfolder = \DB::table('tb_container')->where('name', $curr_yr)->where('parent_id', $folder->id)->first();
                    if (!empty($yearfolder)) {
                        $yrfoldid = $yearfolder->id;
                    } else {
                        $yrfoldid = $this->madeFolder($downfolder, $curr_yr, $folder->id);
                    }
                    if ($yrfoldid != '' && $yrfoldid > 0) {
                        $monfolder = \DB::table('tb_container')->where('name', $curr_mon)->where('parent_id', $yrfoldid)->first();
                        if (!empty($monfolder)) {
                            $monfoldid = $monfolder->id;
                        } else {
                            $monfoldid = $this->madeFolder($downfolder . $curr_yr . '/', $curr_mon, $yrfoldid);
                        }
                        if ($monfoldid != '' && $monfoldid > 0) {
                            $savePdfpath = $downfolder . $curr_yr . '/' . $curr_mon . '/';
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
            $pdf->save($savePdfpath . $downFileName);
            return $retfolderpath . $downFileName;
        } else {
            return Redirect::to('customer/login')->with('messagetext', 'Invoice not generated.')->with('msgstatus', 'error');
        }
    }

    function madeFolder($downfolder, $curr_yr, $folderId) {
        $result = \File::makeDirectory($downfolder . $curr_yr, 0777, true);
        $ydata['parent_id'] = $folderId;
        $ydata['name'] = $curr_yr;
        $ydata['file_type'] = 'folder';
        $ydata['user_id'] = 1;
        $ydata['created'] = date('y-m-d h:i:s');
        $foldid = \DB::table('tb_container')->insertGetId($ydata);
        return $foldid;
    }

    public function getActivation(Request $request) {
        $num = $request->input('code');
        if ($num == '')
            return Redirect::to('customer/login')->with('message', \SiteHelpers::alert('error', 'Invalid Code Activation!'));

        $user = User::where('activation', '=', $num)->get();
        if (count($user) >= 1) {
            \DB::table('tb_users')->where('activation', $num)->update(array('active' => 1, 'activation' => ''));
            return Redirect::to('customer/login')->with('message', \SiteHelpers::alert('success', 'Your account is active now!'));
        } else {
            return Redirect::to('customer/login')->with('message', \SiteHelpers::alert('error', 'Invalid Code Activation!'));
        }
    }

    public function getLogin() {

        if (\Auth::check()) {
            return Redirect::to('')->with('message', \SiteHelpers::alert('success', 'Youre already login'));
        } else {
            $this->data['socialize'] = config('services');
            return View('customer.login', $this->data);
        }
    }

    public function postSignin(Request $request) {

        $rules = array(
            'email' => 'required|email',
            'password' => 'required',
        );
        if (CNF_RECAPTCHA == 'true')
            $rules['captcha'] = 'required|captcha';
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->passes()) {

            $remember = (!is_null($request->get('remember')) ? 'true' : 'false' );

            if (\Auth::attempt(array('email' => $request->input('email'), 'password' => $request->input('password')), $remember)) {
                if (\Auth::check()) {
                    $row = User::find(\Auth::user()->id);

                    if ($row->active == '0') {
                        // inactive 
                        \Auth::logout();
                        return Redirect::to('customer/login')->with('message', \SiteHelpers::alert('error', 'Your Account is not active'));
                    } else if ($row->active == '2') {
                        // BLocked users
                        \Auth::logout();
                        return Redirect::to('customer/login')->with('message', \SiteHelpers::alert('error', 'Your Account is BLocked'));
                    } else {
                        \DB::table('tb_users')->where('id', '=', $row->id)->update(array('last_login' => date("Y-m-d H:i:s")));
                        \Session::put('uid', $row->id);
                        \Session::put('gid', $row->group_id);
                        \Session::put('eid', $row->email);
                        \Session::put('ll', $row->last_login);
                        \Session::put('fid', $row->first_name . ' ' . $row->last_name);
                        if (!is_null($request->input('language'))) {
                            \Session::put('lang', $request->input('language'));
                        } else {
                            \Session::put('lang', 'Deutsch');
                        }
                        if (CNF_FRONT == 'false') :
                            return Redirect::to('customer/profile');
                        else :
                            $getusercompany = \DB::table('tb_user_company_details')->where('user_id', $row->id)->first();
                            if (!empty($getusercompany)) {
                                return Redirect::to('customer/profile');
                            } else {
                                if($row->group_id == 4) {
                                    return Redirect::to('customer/profile')->with('messagetext', 'Please complete your profile and company details')->with('msgstatus', 'error');
                                }
                                return Redirect::to('user/profile')->with('messagetext', 'Please complete your profile and company details')->with('msgstatus', 'error');
                            }

                        endif;
                    }
                }
            } else {
                return Redirect::to('customer/login')
                                ->with('message', \SiteHelpers::alert('error', 'Your username/password combination was incorrect'))
                                ->withInput();
            }
        } else {

            return Redirect::to('customer/login')
                            ->with('message', \SiteHelpers::alert('error', 'The following  errors occurred'))
                            ->withErrors($validator)->withInput();
        }
    }

    public function ajaxPostSignin(Request $request) {

        $rules = array(
            'email' => 'required|email',
            'password' => 'required',
        );
        if (CNF_RECAPTCHA == 'true')
            $rules['captcha'] = 'required|captcha';
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->passes()) {

            $remember = (!is_null($request->get('remember')) ? 'true' : 'false' );

            if (\Auth::attempt(array('email' => $request->input('email'), 'password' => $request->input('password')), $remember)) {
                if (\Auth::check()) {
                    $row = User::find(\Auth::user()->id);
                    //print_r($row);
                    if ($row->active == '0') {
                        // inactive 
                        \Auth::logout();
                        $response = array('status' => 'error', 'message' => 'Your Account is not active', 'errors' => array());
                    } else if ($row->active == '2') {
                        // BLocked users
                        \Auth::logout();
                        $response = array('status' => 'error', 'message' => 'Your Account is BLocked', 'errors' => array());
                    } else {
                        \DB::table('tb_users')->where('id', '=', $row->id)->update(array('last_login' => date("Y-m-d H:i:s")));
                        \Session::put('uid', $row->id);
                        \Session::put('gid', $row->group_id);
                        \Session::put('eid', $row->email);
                        \Session::put('ll', $row->last_login);
                        \Session::put('fid', $row->first_name . ' ' . $row->last_name);
                        
                        if (!is_null($request->input('language'))) {
                            \Session::put('lang', $request->input('language'));
                        } else {
                            \Session::put('lang', 'en');
                        }
                        if (CNF_FRONT == 'false') :
                            $response = array('status' => 'success', 'message' => 'Logged in successfully', 'errors' => array());
                        else :
                            
                            $getusercompany = \DB::table('tb_user_company_details')->where('user_id', $row->id)->first();
                            if (!empty($getusercompany)) {
                                if($row->group_id == 3){
                                    $response = array('status' => 'success', 'message' => 'Please complete your profile', 'errors' => array(), 'gid'=>$row->group_id, 'new_user'=>$row->new_user);                             
                                }elseif($row->group_id == 5){
                                    $response = array('status' => 'success', 'message' => 'Please complete your profile', 'errors' => array(), 'gid'=>$row->group_id, 'new_user'=>$row->new_user); 
                                }else{
                                    $response = array('status' => 'success', 'message' => 'Logged in successfully', 'errors' => array(), 'gid'=>$row->group_id);
                                }                                
                            } else {
                                
                                if($row->group_id == 4) {
                                    $response = array('status' => 'success', 'message' => 'Please complete your profile and company details', 'errors' => array(),'gid'=>$row->group_id);
                                }elseif($row->group_id == 3){
                                    $response = array('status' => 'success', 'message' => 'Please complete your profile', 'errors' => array(), 'gid'=>$row->group_id, 'new_user'=>$row->new_user);
                                }elseif($row->group_id == 5){
                                    $response = array('status' => 'success', 'message' => 'Please complete your profile', 'errors' => array(), 'gid'=>$row->group_id, 'new_user'=>$row->new_user);
                                }else{
                                    $response = array('status' => 'success', 'message' => 'Please complete your profile and company details', 'errors' => array(),'gid'=>$row->group_id );
                                }
                            }

                        endif;
                    }
                }
            } else {
                $response = array('status' => 'error', 'message' => 'Your username/password combination was incorrect', 'errors' => array());
            }
        } else {
            $response = array('status' => 'error', 'message' => 'The following  errors occurred', 'errors' => $validator->errors()->all());
        }
        
        echo json_encode($response);
        
    }

    public function getProfile() {

        if (!\Auth::check())
            return redirect('customer/login');


        $info = User::find(\Auth::user()->id);
        $extra = \DB::table('tb_user_company_details')->where('user_id', \Auth::user()->id)->first();
        $ads_info = \DB::table('tb_advertisement')->where('user_id', \Auth::user()->id)->where('adv_status', 1)->first();
        $ads_expiry_days = \DB::table('tb_settings')->where('key_value', 'default_advertisement_expiry_days')->first();
        $ads_price = \DB::table('tb_settings')->where('key_value', 'default_advertisement_price')->first();
        $def_currency = \DB::table('tb_settings')->where('key_value', 'default_currency')->first();
        
        

        $this->data['pageslider'] = \DB::table('tb_sliders')->select( 'slider_title', 'slider_description', 'slider_img', 'slider_link', 'slider_video', 'slide_type')->where('slider_category', 'Customer Dashboard')->get();

        $this->data2 = array(
            'pageTitle' => 'My Profile',
            'pageNote' => 'View Detail My Info',
            'info' => $info,
            'extra' => $extra,
            'ads_expiry_days' => $ads_expiry_days,
            'ads_price' => $ads_price,
            'def_currency' => $def_currency,
            'ads_info' => $ads_info,
        );
		
		$this->data['orders'] = \DB::table('tb_orders')->where('user_id', \Auth::user()->id)->get();
		
        return view('customer.profile', $this->data2,$this->data);
    }

    public function postSaveprofile(Request $request) {

           
        if (!\Auth::check())
            return Redirect::to('customer/login');
        $rules = array(
            'first_name' => 'required|alpha_num|min:2',
            'last_name' => 'required|alpha_num|min:2',
        );

        if ($request->input('email') != \Session::get('eid')) {
            $rules['email'] = 'required|email|unique:tb_users';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {


            if (!is_null(Input::file('avatar'))) {
                $file = $request->file('avatar');
                $destinationPath = './uploads/users/';
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension(); //if you need extension of the file
                $newfilename = \Session::get('uid') . '.' . $extension;
                $uploadSuccess = $request->file('avatar')->move($destinationPath, $newfilename);
                if ($uploadSuccess) {
                    $data['avatar'] = $newfilename;
                }
            }

            $user = User::find(\Session::get('uid'));
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            if (isset($data['avatar']))
                $user->avatar = $newfilename;
            $user->save();

            return Redirect::to('customer/profile')->with('messagetext', 'Profile has been saved!')->with('msgstatus', 'success');
        } else {
            return Redirect::to('customer/profile')->with('messagetext', 'The following errors occurred')->with('msgstatus', 'error')
                            ->withErrors($validator)->withInput();
        }
    }

    public function postSavepassword(Request $request) {
        $rules = array(
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $user = User::find(\Session::get('uid'));
            $user->password = \Hash::make($request->input('password'));
            $user->save();

            return Redirect::to('customer/profile')->with('message', \SiteHelpers::alert('success', 'Password has been saved!'));
        } else {
            return Redirect::to('customer/profile')->with('message', \SiteHelpers::alert('error', 'The following errors occurred')
                    )->withErrors($validator)->withInput();
        }
    }

    public function getReminder() {

        return view('customer.remind');
    }

    public function postRequest(Request $request) {

        $rules = array(
            'credit_email' => 'required|email'
        );

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->passes()) {

            $user = User::where('email', '=', $request->input('credit_email'));
            if ($user->count() >= 1) {
                $user = $user->get();
                $user = $user[0];
                /* $data = array('token'=>$request->input('_token'));	
                  $to = $request->input('credit_email');
                  $subject = "[ " .CNF_APPNAME." ] REQUEST PASSWORD RESET ";
                  $message = view('customer.emails.auth.reminder', $data);
                  $headers  = 'MIME-Version: 1.0' . "\r\n";
                  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                  $headers .= 'From: '.CNF_APPNAME.' <'.CNF_EMAIL.'>' . "\r\n";
                  mail($to, $subject, $message, $headers); */

                $token = base64_encode(rand(10000, 10000000));
                $edata = array();
                $emlData['frmemail'] = CNF_EMAIL;//'info@design-locations.biz';
                $edata['token'] = $token;
                $emlData['email'] = $request->input('credit_email');
                $emlData['subject'] = 'REQUEST PASSWORD RESET';
                $etemp = 'auth.reminder';
                if (\Session::get('newlang') == 'English') {
                    $etemp = 'auth.reminder_eng';
                }
                //echo view('customer.emails.' . $etemp, $edata); die;
                \Mail::send('customer.emails.' . $etemp, $edata, function($message) use ($emlData) {
                    $message->from($emlData['frmemail'], CNF_APPNAME);

                    $message->to($emlData['email']);

                    $message->subject($emlData['subject']);
                });


                $affectedRows = User::where('email', '=', $user->email)
                        ->update(array('reminder' => $token));

                return Redirect::to('user/login')->with('message', \SiteHelpers::alert('success', 'Please check your email'));
            } else {
                return Redirect::to('user/login')->with('message', \SiteHelpers::alert('error', 'Cant find email address'));
            }
        } else {
            return Redirect::to('user/login')->with('message', \SiteHelpers::alert('error', 'The following errors occurred')
                    )->withErrors($validator)->withInput();
        }
    }

    public function ajaxPostRequest(Request $request) {

        $rules = array(
            'credit_email' => 'required|email'
        );

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->passes()) {

            $user = User::where('email', '=', $request->input('credit_email'));
            if ($user->count() >= 1) {
                $user = $user->get();
                $user = $user[0];
                /* $data = array('token'=>$request->input('_token'));	
                  $to = $request->input('credit_email');
                  $subject = "[ " .CNF_APPNAME." ] REQUEST PASSWORD RESET ";
                  $message = view('customer.emails.auth.reminder', $data);
                  $headers  = 'MIME-Version: 1.0' . "\r\n";
                  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                  $headers .= 'From: '.CNF_APPNAME.' <'.CNF_EMAIL.'>' . "\r\n";
                  mail($to, $subject, $message, $headers); */

                $token = base64_encode(rand(10000, 10000000));
                $edata = array();
                $emlData['frmemail'] = 'info@emporium-voyage.com';
                $edata['token'] = $token;
                $emlData['email'] = $request->input('credit_email');
                $emlData['subject'] = 'REQUEST PASSWORD RESET';
                $etemp = 'auth.reminder';
                if (\Session::get('newlang') == 'English') {
                    $etemp = 'auth.reminder_eng';
                }
                \Mail::send('customer.emails.' . $etemp, $edata, function($message) use ($emlData) {
                    $message->from($emlData['frmemail'], CNF_APPNAME);

                    $message->to($emlData['email']);

                    $message->subject($emlData['subject']);
                });


                $affectedRows = User::where('email', '=', $user->email)
                        ->update(array('reminder' => $request->input('_token')));

                $response = array('status' => 'success', 'message' => 'Please check your email', 'errors' => array());
            } else {
                $response = array('status' => 'error', 'message' => 'Cant find email address', 'errors' => array());
            }
        } else {
            $response = array('status' => 'error', 'message' => 'The following  errors occurred', 'errors' => $validator->errors()->all());
        }
        
        echo json_encode($response);
    }

    public function getReset(Request $request, $token = '') {
        if (\Auth::check())
            return Redirect::to('dashboard');
        $token = $request->input('token');
        $user = User::where('reminder', '=', $token);
        if ($user->count() >= 1) {
            $data = array('verCode' => $token);
            return view('customer.remind', $data);
        } else {
            return Redirect::to('customer/login')->with('message', \SiteHelpers::alert('error', 'Cant find your reset code'));
        }
    }

    public function postDoreset(Request $request, $token = '') {
        $rules = array(
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        );
        
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            if($request->input('userID')!=null && $request->input('userID')>0 ){
                $user = User::where('id', '=', $request->input('userID'));
            }else{
                $user = User::where('reminder', '=', $token);
            }
            
            if ($user->count() >= 1) {
                $data = $user->get();
                $user = User::find($data[0]->id);
                $user->reminder = '';
                $user->password = \Hash::make($request->input('password'));
                $user->save();
            }
            if($request->input('userID')!=null && $request->input('userID')>0 ){
                return Redirect::to('customer/profile')->with('message', \SiteHelpers::alert('success', 'Password has been saved!'));
            }else{

            return Redirect::to('customer/login')->with('message', \SiteHelpers::alert('success', 'Password has been saved!'));
            }
        } else {

            if( $request->input('userID')!=null && $request->input('userID')>0 ){
return Redirect::to('customer/profile')->with('message', \SiteHelpers::alert('error', 'The following errors occurred')
                                    )->withErrors($validator)->withInput();
            }else{
            return Redirect::to('customer/reset/' . $token)->with('message', \SiteHelpers::alert('error', 'The following errors occurred')
                    )->withErrors($validator)->withInput();
          }
        }
    }

    public function getLogout() {
        \Auth::logout();
        \Session::flush();
        return Redirect::to('')->with('message', \SiteHelpers::alert('info', 'Sie sind derzeit nicht eingeloggt'));
    }

    function getSocialize($social) {
        return Socialize::with($social)->redirect();
    }

    function getAutosocial($social) {
        $user = Socialize::with($social)->user();
        $user = User::where('email', $user->email)->first();
        return self::autoSignin($user);
    }

    function autoSignin($user) {

        if (is_null($user)) {
            return Redirect::to('customer/login')
                            ->with('message', \SiteHelpers::alert('error', 'You have not registered yet '))
                            ->withInput();
        } else {

            Auth::login($user);
            if (Auth::check()) {
                $row = User::find(\Auth::user()->id);

                if ($row->active == '0') {
                    // inactive 
                    Auth::logout();
                    return Redirect::to('customer/login')->with('message', \SiteHelpers::alert('error', 'Your Account is not active'));
                } else if ($row->active == '2') {
                    // BLocked users
                    Auth::logout();
                    return Redirect::to('customer/login')->with('message', \SiteHelpers::alert('error', 'Your Account is BLocked'));
                } else {
                    Session::put('uid', $row->id);
                    Session::put('gid', $row->group_id);
                    Session::put('eid', $row->group_email);
                    Session::put('fid', $row->first_name . ' ' . $row->last_name);
                    if (CNF_FRONT == 'false') :
                        return Redirect::to('dashboard');
                    else :
                        return Redirect::to('');
                    endif;
                }
            }
        }
    }

    public function postSavecompanydetails(Request $request) {
        if (!\Auth::check())
            return Redirect::to('customer/login');

        $rules = array(
            'company_name' => 'required',
            'company_owner' => 'required',
            'contact_person' => 'required',
            'company_phone' => 'required',
            'company_website' => 'required',
            'company_tax_no' => 'required',
            'company_logo' => 'mimes:jpeg,png'
        );

        if ($request->input('company_email') != \Session::get('eid')) {
            $rules['company_email'] = 'required|email';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {


            if (!is_null(Input::file('company_logo'))) {
                $file = $request->file('company_logo');
                $destinationPath = './uploads/users/company/';
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension(); //if you need extension of the file
                $newfilename = \Session::get('uid') . '.' . $extension;
                $uploadSuccess = $request->file('company_logo')->move($destinationPath, $newfilename);
                if ($uploadSuccess) {
                    $data['company_logo'] = $newfilename;
                }
            }

            $data['user_id'] = \Auth::user()->id;
            $data['company_name'] = Input::get('company_name');
            $data['company_owner'] = Input::get('company_owner');
            $data['contact_person'] = Input::get('contact_person');
            $data['company_email'] = Input::get('company_email');
            $data['company_address'] = Input::get('company_address');
            $data['company_address2'] = Input::get('company_address2');
            $data['company_city'] = Input::get('company_city');
            $data['company_postal_code'] = Input::get('company_postal_code');
            $data['company_country'] = Input::get('company_country');
            $data['company_phone'] = Input::get('company_phone');
            $data['company_website'] = Input::get('company_website');
            $data['company_tax_number'] = Input::get('company_tax_no');
            $data['steuernummer'] = Input::get('steuernummer');
            $data['umsatzsteuer_id'] = Input::get('umsatzsteuer_id');
            $data['geschäftsführer'] = Input::get('geschäftsführer');
            $data['handelsregister'] = Input::get('handelsregister');
            $data['amtsgericht'] = Input::get('amtsgericht');

            if (Input::get('compedit_id') != "" && Input::get('compedit_id') > 0) {
                $data['updated'] = date('y-m-d h:i:s');
                \DB::table('tb_user_company_details')->where('id', Input::get('compedit_id'))->update($data);
            } else {
                $data['created'] = date('y-m-d h:i:s');
                \DB::table('tb_user_company_details')->insert($data);
            }

            return Redirect::to('customer/profile')->with('messagetext', 'Company details has been saved!')->with('msgstatus', 'success');
        } else {
            return Redirect::to('customer/profile')->with('messagetext', 'The following errors occurred')->with('msgstatus', 'error')
                            ->withErrors($validator)->withInput();
        }
    }

    public function postSaveshippingbilling(Request $request) {
        if (!\Auth::check())
            return Redirect::to('customer/login');

        $data['user_id'] = \Auth::user()->id;
        $data['shipping_address'] = Input::get('shipping_address');
        $data['shipping_address2'] = Input::get('shipping_address2');
        $data['shipping_city'] = Input::get('shipping_city');
        $data['shipping_postal_code'] = Input::get('shipping_postal_code');
        $data['shipping_country'] = Input::get('shipping_country');
        $data['billing_address'] = Input::get('billing_address');
        $data['billing_address2'] = Input::get('billing_address2');
        $data['billing_city'] = Input::get('billing_city');
        $data['billing_postal_code'] = Input::get('billing_postal_code');
        $data['billing_country'] = Input::get('billing_country');
        if (Input::get('shipedit_id') != "" && Input::get('shipedit_id') > 0) {
            $data['updated'] = date('y-m-d h:i:s');
            \DB::table('tb_user_company_details')->where('id', Input::get('shipedit_id'))->update($data);
        } else {
            $data['created'] = date('y-m-d h:i:s');
            \DB::table('tb_user_company_details')->insert($data);
        }

        return Redirect::to('customer/profile')->with('messagetext', 'Shipping/Billing details has been saved!')->with('msgstatus', 'success');
    }

    function getUserprofile() {
        if (Input::get('customer') != '') {
            $custId = md5(Input::get('customer'));

            $sen = file_get_contents("https://www.rodenstock.net/net/stage/de/de/optikerjson?customerId=" . $custId);
            return $sen;
        } else {
            return "error";
        }
    }

    public function traveller(){
        $user = User::find(\Session::get('uid'));
        $this->data["guestUserData"]=$user;
        $this->data['pageTitle'] = "Whoiam User Membership Type Selection";
        $this->data['pageMetakey'] = "Whoiam User Membership";
        $this->data['pageMetadesc'] = "Whoiam User Membership";
        $contractObject =new Contract();
        
        $u_id = \Session::get('uid');  
        $this->data['logged_user'] = \DB::table('tb_users')->where('id', $u_id)->first();
        
        $params = array(
            
        );
        $resultContract= $contractObject->getRows($params); 
        
        $temp = $this->get_destinations_new();
        
        //print_r($temp);
        
        $this->data['destinations'] = $temp;
        $this->data['inspirations'] = \DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name', 'category_image', 'category_custom_title')->where('category_published', 1)->where('parent_category_id', 627)->get();
        $this->data['experiences'] = \DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name', 'category_image', 'category_custom_title')->where('category_published', 1)->where('parent_category_id', 8)->get();
        
        $extra = \DB::table('tb_properties')->where('user_id', $user->id)->first();
        $this->data['extra'] = $extra;
        //print_r($extra); die;
        $this->data['user'] = $user;
        //$this->data['contractdata']=$resultContract["rows"];
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard($user->group_id));
        
        $t_f = 'whoiam';
        if(isset($extra->approved)){ if(!((bool) $extra->approved)){ $t_f = 'approval_pending'; }}
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.customer.'.$t_f:'customer.whoiam';      
        return view($file_name, $this->data);
    }
    
    public function get_destinations_new($parent = 0, $spacing = '', $folder_tree_array = '') {

        if (!is_array($folder_tree_array))
		  $folder_tree_array = array();          
		
		  $filter = " AND parent_category_id='".$parent."'";
		  $params = array(
			'params'	=> $filter,
			'order'		=> 'asc'
		  );
		  // Get Query 
    	  $results = \DB::table('tb_categories')->where('parent_category_id', $parent)->where('id', '!=', 8)->get();
          //print_r($results); die;
          if ($results) {
    		foreach($results as $row) {
    		  $folder_tree_array[] = array("id" => $row->id, "name" => $spacing . $row->category_name);
    		  $folder_tree_array = $this->get_destinations_new($row->id, $spacing . '', $folder_tree_array);
    		}
    	  }          
    	  return $folder_tree_array;
    }
    
    public function whoIam() {
        if (!\Auth::check())
            return Redirect::to('/');
            
        $user = User::find(\Session::get('uid'));
        $this->data["guestUserData"]=$user;
        $this->data['pageTitle'] = "Whoiam User Membership Type Selection";
        $this->data['pageMetakey'] = "Whoiam User Membership";
        $this->data['pageMetadesc'] = "Whoiam User Membership";
        
        /** sign up contracts start **/
        //get contract during signup
        $usersContracts = \DB::table('tb_users_contracts')->select('tb_users_contracts.id','tb_users_contracts.contract_id','tb_users_contracts.title','tb_users_contracts.description','tb_users_contracts.is_required','tb_users_contracts.is_agree','tb_users_contracts.sort_num')->where('tb_users_contracts.contract_type','sign-up')->where('tb_users_contracts.accepted_by', \Auth::user()->id)->where('tb_users_contracts.status',1)->where('tb_users_contracts.is_expried',0)->where('tb_users_contracts.deleted',0)->orderBy('tb_users_contracts.contract_id','DESC')->get();
        $resetContracts = array();
        foreach($usersContracts as $si_contract){
            $resetContracts[$si_contract->contract_id] = $si_contract;
        }
        $this->data['userContracts'] = $resetContracts;        
        $this->data['contractdata'] = \CommonHelper::get_default_contracts('sign-up');        
        /** sign up contracts end **/
        
        /** commission contracts start **/
        $usersContracts = \DB::table('tb_users_contracts')->select('tb_users_contracts.*')->where('tb_users_contracts.contract_type','commission')->where('tb_users_contracts.accepted_by', \Auth::user()->id)->where('tb_users_contracts.status',1)->where('tb_users_contracts.is_expried',0)->where('tb_users_contracts.deleted',0)->orderBy('tb_users_contracts.contract_id','DESC')->first();
        $contractdata = \CommonHelper::get_default_contracts('commission');
        
        if(isset($usersContracts->contract_id)){ $this->data['commision_contractdata'] = $usersContracts; $this->data['commission_contract_selected']=true; }
        else{ $this->data['commision_contractdata'] = ((isset($contractdata["common"]))?$contractdata["common"]:array()); $this->data['commission_contract_selected']=false; }
        /** commission contracts end **/
        
        
        $extra = \DB::table('tb_properties')->where('user_id', $user->id)->first();
        $this->data['extra'] = $extra;
        //print_r($extra); die;
        $this->data['user'] = $user;
        $property_assigned = \DB::table("tb_properties_users")->join('tb_properties', 'tb_properties_users.property_id', '=', 'tb_properties.id')->where('tb_properties_users.user_id', \Auth::user()->id)->first();
        //$property_assigned = \DB::table('tb_properties')->where('assigned_user_id', $user->id)->first();
        
        $propid = '';
        if(!empty($property_assigned)){
            $propid = $property_assigned->id;
        }
        
        $this->data['property_assigned'] = $property_assigned;
        $this->data['assigned_propid'] = $propid;
        
        $this->data['pageslider'] = \DB::table('tb_pages_sliders')->join('tb_pages_content', 'tb_pages_sliders.slider_page_id', '=' , 'tb_pages_content.pageID')->select( 'slider_title', 'slider_description', 'slider_img', 'slider_link', 'slider_video', 'slide_type')->where('tb_pages_content.alias', 'hotel-dashboard')->where('slider_status', 1)->get();
        
        $group_id = \Session::get('gid');
        $this->data['packages'] = \DB::table('tb_packages')->where('allow_user_groups', $group_id)->where('package_status', 1)->get();
        if($propid!=''){
            $this->data['hotelcontacts'] = (new PropertiesController)->get_property_files($propid, 'Hotel Contracts');
            $this->data['hotel_broch'] = (new PropertiesController)->get_property_files($propid, 'Hotel Brochure');
        }        
        
        $this->data['active_tab']=$user->form_wizard;
        
        $this->data['fid'] = \Session::get('uid');
        
        $this->data['company_details'] = \DB::table('tb_user_company_details')->where('user_id', $user->id)->first();
        
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard($user->group_id));
        $t_f = 'whoiam';
        //if(isset($extra->approved)){ if(!((bool) $extra->approved)){ $t_f = 'approval_pending'; }}
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.customer.'.$t_f:'customer.whoiam';      
        return view($file_name, $this->data);
    }
        

    public function postSavewhoiam(Request $request) {

           
        
        $rules = array(
            'first_name' => 'required|alpha_num|min:2',
            'last_name' => 'required|alpha_num|min:2',
            'contractSignCheckFinal'=>'required',
        );



       /* if ($request->input('userEmail') != \Session::get('eid')) {
            $rules['email'] = 'required|email|unique:tb_users';
        }*/


        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {

            $user = User::find(\Session::get('uid')); 

                 
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->mobile_number=$request->input('txtPhoneNumber');

            $user->contracts= $this->getDownloadContractPdf($user->id);

            if (isset($data['avatar']))
                $user->avatar = $newfilename;




            if($request->input('usertype')=="guests" && $request->input('personalize')=="on" ){


                $user->group_id=3;
                $user->save();
                

                return Redirect::to('personalized-service')->with('messagetext', 'Profile has been saved!')->with('msgstatus', 'success'); 
             }


            if($request->input('usertype')=="hotel" ){
                $user->group_id=5;
                $user->save();
                return Redirect::to('hotel/membership')->with('messagetext', 'Profile has been saved!')->with('msgstatus', 'success'); 
             }

              if($request->input('usertype')=="advertiser" ){
                $user->group_id=7;
                $user->save();
                return Redirect::to('advertiser/package')->with('messagetext', 'Profile has been saved!')->with('msgstatus', 'success'); 
             }


           return Redirect::to('customer/profile')->with('messagetext', 'Profile has been saved!')->with('msgstatus', 'success');
          


            
        } else {
            return Redirect::to('whoiam')->with('messagetext', 'The following errors occurred')->with('msgstatus', 'error')
                            ->withErrors($validator)->withInput();
        }
    }
	
	public function getOrderdetail($ordid) {

        if (!\Auth::check())
            return redirect('customer/login');
		
		$this->data['pageslider'] = \DB::table('tb_sliders')->select( 'slider_title', 'slider_description', 'slider_img', 'slider_link', 'slider_video', 'slide_type')->where('slider_category', 'Customer Dashboard')->get();

        $this->data['def_currency'] = \DB::table('tb_settings')->where('key_value', 'default_currency')->first();
        
        $this->data['order'] = \DB::table('tb_orders')->where('id', $ordid)->first();
		$order_item_detail = array();
		$order_item = \DB::table('tb_order_items')->where('order_id', $ordid)->get();
		if(!empty($order_item))
		{
			$o=0;
			foreach($order_item as $oitem)
			{
				$order_item_detail[$o] = $oitem;
				$order_item_detail[$o]->pckname = 'Advertisement';
				$order_item_detail[$o]->pckprice = 0;
				$order_item_detail[$o]->pckcontent = '';

                $order_item_detail[$o]->package_modules = '';
                
				$order_item_detail[$o]->qty = 1;
				if($oitem->package_type=='hotel')
				{
					$pchkdet = \DB::table('tb_packages')->select('package_title','package_price')->where('id', $oitem->package_id)->first();
					if(!empty($pchkdet))
					{
						$order_item_detail[$o]->pckname = $pchkdet->package_title;
						$order_item_detail[$o]->pckprice = $pchkdet->package_price;
                        $moduleDetailFromOrder="";
                        foreach (json_decode($oitem->package_data) as $key => $value) {
                             
                                     $order_item_detail[$o]->pckname = $value->package_title;
                                   
                                   
                                     $order_item_detail[$o]->pckprice = $value->package_price;                                

                                
                                     $order_item_detail[$o]->package_modules = $value->package_modules;
                           }
                       
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
						$adsdata .= ', price: '.$this->data['def_currency']->content .$getspac->space_cpc_price . '/'.$getspac->space_cpc_num_clicks .' Clicks';
					}
					elseif($pacdata['ads_pacakge_type']=='cpm')
					{
						$order_item_detail[$o]->pckprice = $getspac->space_cpm_price;
						$adsdata .= ', price: '.$this->data['def_currency']->content .$getspac->space_cpm_price . '/'.$getspac->space_cpm_num_view .' Views';
					}
					elseif($pacdata['ads_pacakge_type']=='cpd')
					{
						$order_item_detail[$o]->qty = $pacdata['ads_days'];
						$order_item_detail[$o]->pckprice = CommonHelper::calc_price($getspac->space_cpd_price,$getspac->space_cpm_num_days,$pacdata['ads_days']);
						$adsdata .= ', price: '.$this->data['def_currency']->content .$getspac->space_cpd_price . '/'.$getspac->space_cpm_num_days .' Days';
					}
					$order_item_detail[$o]->pckcontent = $adsdata;
				}
				$o++;
			}
		}
		$this->data['order_item_detail'] = $order_item_detail;
		
        return view('customer.orderview', $this->data);
    }
	
	public function getDownloadinvoicepdf($ordid) {

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

                $html .= '<tr><td colspan="4"><hr  style="border-top:1px solid #000; width:100%"/></td></tr>';

                $html .= '<tr><td colspan="3" class="algRgt font13"><b>Total<b></td><td class="algRgt font13"><b>'.$currency->content .' '.number_format($Totprice, 2, '.', ',').'<b></td></tr>';
                $html .= '<tr><td colspan="4"><hr  style="border-top:1px solid #000; width:100%"/></td></tr>';
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



 /* Function By Ram To generate Contract PDF */
  public function getDownloadContractPdf($userID) {

       $downFileName = 'user-contract-'.$userID."-".date('d-m-Y').'.pdf';
    
        if($userID!="")
        {
        $html = '
        <style> 
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
                td{font-size:12px; padding:0px;} 
                th{background-color:#999; color:#000000; text-align:left; padding:0px; font-size:12px;}
           
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
                <td>
                    &nbsp;
                </td>
            </tr>
        ';

        $html .= '</table>
        </div>';

/* Add Contract Data here */
$html .= '<div style="clear:both;"></div>
            <div class="Mrgtop20 font13">
            <table width="100%">
                 <tr>
                    <td colspan="2" align="right"  height="25px;">&nbsp;</td>
                 </tr>
                ';

              
      $contractObject =new Contract();
      $params = array(         
        );
      $resultContract= $contractObject->getRows($params); 
      $sn = 1;
       foreach ($resultContract["rows"] as $row) {
   
                $html .= '
                  <tr style="background:#eeeeee;">
                    <th width="10%">'.$sn.'</th>
                    <th width="90%" ><h4>'.$row->title.'</h4></th>
            
                </tr>
                    ';


                $html .= '
                     <tr>
                        <td colspan="2">'.nl2br($row->description).'</td>
                      </tr>';
      
                    $sn++;
       }

     $html .= '</table>';
/* End  Contract Data here */
$html .= '</div>';
                $pdf = \App::make('dompdf.wrapper');
                $pdf->loadHTML($html);
                $fileGenerated=$pdf->download($downFileName);
                $pdf->save(public_path(). '/uploads/users/'.$downFileName);
                return $downFileName;
        }
        
    }

 /* End function by Ram to generate PDF*/   
 
    public function skipPreferences(Request $request){
        $_user = User::find(\Session::get('uid'));
        $_user->form_wizard = $request->input('form_wizard');
        $_user->new_user = 0;
        $_user->save();
        $return_array['status'] = 'success';
        $return_array['message'] = 'Successfully completed wizard!';
        echo json_encode($return_array);
        exit;
    }
    
    public function ajaxSendMail(Request $request) {

        $rules = array( 
            'email' => 'required|email|unique:tb_users',
        );        
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {            
            
            $edata = array();
            $edata['email'] = $request->input('email');
            $mobile = '';
            $mobile_number =trim($request->input('txtmobileNumber'));
            $mobile_code =trim($request->input('txtmobileDialcode'));
            $mobile = $mobile_code."".$mobile_number;
            $edata['mobile'] = $mobile;
            
            $emlData['frmemail'] = 'marketing@emporium-voyage.com';
            //$emlData['email'] = 'riaan@number7even.com';
            $emlData['email'] = CNF_SUPERADMIN_EMAIL;
            $emlData['subject'] = 'Request for referral code by '.$request->input('email');
            
            $etemp = 'request_referral';
            
            \Mail::send('user.emails.' . $etemp, $edata, function($message) use ($emlData) {
                $message->from($emlData['frmemail'], CNF_APPNAME);

                $message->to($emlData['email']);

                $message->subject($emlData['subject']);
            });
                    
            $euserdata = array();
            $euserdata['email'] = $request->input('email');
            $emlData['frmemail'] = 'marketing@emporium-voyage.com';
            //$emlData['email'] = 'riaan@number7even.com';
            $emlData['email'] = trim($request->input('email'));
            $emlData['subject'] = 'Request for referral';
            
            $etemp = 'request_referral_user';
            
            \Mail::send('user.emails.' . $etemp, $euserdata, function($message) use ($emlData) {
                $message->from($emlData['frmemail'], CNF_APPNAME);

                $message->to($emlData['email']);

                $message->subject($emlData['subject']);
            });
                    
            
            $response = array('status' => 'success', 'message' => 'Your request send to administrator. They will contact with you shortly', 'errors'=>false);
            
        } else {
            $response = array('status' => 'error', 'message' => 'The following errors occurred', 'errors' => $validator->errors()->all());
        }
        
        echo json_encode($response);
    }   
    public function skipPackage(Request $request){
        $_user = User::find(\Session::get('uid'));
        $_user->form_wizard = $request->input('form_wizard');
        $_user->new_user = 0;
        $_user->save();
        $return_array['status'] = 'success';
        $return_array['message'] = 'Successfully completed wizard!';
        echo json_encode($return_array);
        exit;
    }
    public function priceonrequest(Request $request){
        $firstname = $request->input('onrequest_firstname'); 
        $lastname = $request->input('onrequest_lastname'); 
        $email = $request->input('onrequest_email'); 
        $phoneumber = $request->input('onrequest_phoneumber'); 
        $message = $request->input('onrequest_message');           
                            
        $edata = array();        
        $edata['firstname'] = $firstname;
        $edata['lastname'] = $lastname;
        $edata['email'] = $email;
        $edata['phoneumber'] = $phoneumber;
        $edata['message'] = $message;
        
        $emlData['frmemail'] = 'marketing@emporium-voyage.com';
        $emlData['email'] = CNF_SUPERADMIN_EMAIL;
        //$emlData['email'] = trim($request->input('email'));
        $emlData['subject'] = 'Price on Request';
        
        $etemp = 'price_on_request';
        
        \Mail::send('user.emails.' . $etemp, $edata, function($message) use ($emlData) {
            $message->from($emlData['frmemail'], CNF_APPNAME);

            $message->to($emlData['email']);

            $message->subject($emlData['subject']);
        });
        
        $response = array('status' => 'success', 'message' => 'Mail sent successfully');
        
        echo json_encode($response);
        
        exit;
    }
}