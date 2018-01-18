<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Socialize;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator,
    Input,
    Redirect;

class CustomerController extends Controller {

    protected $layout = "layouts.main";

    public function __construct() {
        parent::__construct();
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
                            return Redirect::to('dashboard');
                        else :
                            $getusercompany = \DB::table('tb_user_company_details')->where('user_id', $row->id)->first();
                            if (!empty($getusercompany)) {
                                return Redirect::to('dashboard');
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

    public function getProfile() {

        if (!\Auth::check())
            return redirect('customer/login');


        $info = User::find(\Auth::user()->id);
        $extra = \DB::table('tb_user_company_details')->where('user_id', \Auth::user()->id)->first();
        $ads_info = \DB::table('tb_advertisement')->where('user_id', \Auth::user()->id)->where('adv_status', 1)->first();
        $ads_expiry_days = \DB::table('tb_settings')->where('key_value', 'default_advertisement_expiry_days')->first();
        $ads_price = \DB::table('tb_settings')->where('key_value', 'default_advertisement_price')->first();
        $def_currency = \DB::table('tb_settings')->where('key_value', 'default_currency')->first();
        $this->data = array(
            'pageTitle' => 'My Profile',
            'pageNote' => 'View Detail My Info',
            'info' => $info,
            'extra' => $extra,
            'ads_expiry_days' => $ads_expiry_days,
            'ads_price' => $ads_price,
            'def_currency' => $def_currency,
            'ads_info' => $ads_info,
        );
        return view('customer.profile', $this->data);
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
            'password' => 'required',
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
                $emlData['frmemail'] = 'info@design-locations.biz';
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

                return Redirect::to('customer/login')->with('message', \SiteHelpers::alert('success', 'Please check your email'));
            } else {
                return Redirect::to('customer/login')->with('message', \SiteHelpers::alert('error', 'Cant find email address'));
            }
        } else {
            return Redirect::to('customer/login')->with('message', \SiteHelpers::alert('error', 'The following errors occurred')
                    )->withErrors($validator)->withInput();
        }
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
            $user = User::where('reminder', '=', $token);
            if ($user->count() >= 1) {
                $data = $user->get();
                $user = User::find($data[0]->id);
                $user->reminder = '';
                $user->password = \Hash::make($request->input('password'));
                $user->save();
            }

            return Redirect::to('customer/login')->with('message', \SiteHelpers::alert('success', 'Password has been saved!'));
        } else {
            return Redirect::to('customer/reset/' . $token)->with('message', \SiteHelpers::alert('error', 'The following errors occurred')
                    )->withErrors($validator)->withInput();
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

}