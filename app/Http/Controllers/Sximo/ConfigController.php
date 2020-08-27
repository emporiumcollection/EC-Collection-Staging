<?php namespace App\Http\Controllers\sximo;

use App\Http\Controllers\controller;
use App\Models\Core\Groups;
use App\User;
use Illuminate\Http\Request;
use Validator, Input, Redirect; 

class ConfigController extends Controller {

    public function __construct()
    {
    	parent::__construct();
		if( \Auth::check() or \Session::get('gid') != '1')
		{
		//	echo 'redirect';
			return Redirect::to('dashboard');
		};
       
    }

	public function getIndex()
	{	
		$this->data['active'] = '';
        
        $gId = \CommonHelper::getusertype("users-b2c");
        
        $this->data['b2c_packages'] = \DB::table('tb_packages')->select('tb_packages.id','tb_packages.package_title', 'tb_packages.is_public')->join('tb_packages_user_groups', 'tb_packages.id', '=', 'tb_packages_user_groups.package_id')->where('tb_packages_user_groups.group_id', $gId)->get();
        
		return view('sximo.config.index',$this->data);	
	}


	static function postSave( Request $request )
	{	    
		$rules = array(
			'cnf_appname'=>'required|min:2',
			'cnf_appdesc'=>'required|min:2',
			'cnf_comname'=>'required|min:2',
			'cnf_email'=>'required|email',
		);
		$validator = Validator::make($request->all(), $rules);	
		if (!$validator->fails()) 
		{
			$logo = '';
			if(!is_null(Input::file('logo')))
			{

				$file = Input::file('logo'); 
			 	$destinationPath = public_path().'/sximo/images/'; 
				$filename = $file->getClientOriginalName();
				$extension =$file->getClientOriginalExtension(); //if you need extension of the file
				$logo = 'backend-logo.'.$extension;
				$uploadSuccess = $file->move($destinationPath, $logo);
			}
            
            $front_logo = '';
			if(!is_null(Input::file('frontlogo')))
			{

				$file2 = Input::file('frontlogo'); 
			 	$destinationPath = public_path().'/sximo/images/'; 
				$filename2 = $file2->getClientOriginalName();
				$extension =$file2->getClientOriginalExtension(); //if you need extension of the file
				$front_logo = 'front-logo.'.$extension;
				$uploadSuccess = $file2->move($destinationPath, $front_logo);
			}

			$val  =		"<?php \n"; 
			$val .= 	"define('CNF_APPNAME','".$request->input('cnf_appname')."');\n";
			$val .= 	"define('CNF_APPDESC','".$request->input('cnf_appdesc')."');\n";
			$val .= 	"define('CNF_COMNAME','".$request->input('cnf_comname')."');\n";
			$val .= 	"define('CNF_EMAIL','".$request->input('cnf_email')."');\n";	
			$val .= 	"define('CNF_METAKEY','".$request->input('cnf_metakey')."');\n";	
			$val .= 	"define('CNF_METADESC','".$request->input('cnf_metadesc')."');\n";		
			$val .= 	"define('CNF_GROUP','".CNF_GROUP."');\n";	
			$val .= 	"define('CNF_ACTIVATION','".CNF_ACTIVATION."');\n";	
			$val .= 	"define('CNF_MULTILANG','".(!is_null($request->input('cnf_multilang')) ? 1 : 0 )."');\n";
            $val .= 	"define('CNF_SUBTRACT_FEE','".(!is_null($request->input('cnf_subtract_fee_first_booking')) ? 1 : 0 )."');\n";
			$val .= 	"define('CNF_LANG','".$request->input('cnf_lang')."');\n";
			$val .= 	"define('CNF_REGIST','".CNF_REGIST."');\n";	
			$val .= 	"define('CNF_FRONT','".CNF_FRONT."');\n";            		
			$val .= 	"define('CNF_RECAPTCHA','".CNF_RECAPTCHA."');\n";	
			$val .= 	"define('CNF_THEME','".$request->input('cnf_theme')."');\n";		
			$val .= 	"define('CNF_RECAPTCHAPUBLICKEY','".CNF_RECAPTCHAPUBLICKEY."');\n";
			$val .= 	"define('CNF_RECAPTCHAPRIVATEKEY','".CNF_RECAPTCHAPRIVATEKEY."');\n";
			$val .= 	"define('CNF_MODE','".(!is_null($request->input('cnf_mode')) ? 'production' : 'development' )."');\n";	
			$val .= 	"define('CNF_LOGO','".($logo !=''  ? $logo : CNF_LOGO )."');\n";
            $val .= 	"define('CNF_FRONTEND_LOGO','".($front_logo !=''  ? $front_logo : CNF_FRONTEND_LOGO )."');\n";		
			$val .= 	"define('CNF_ALLOWIP','".CNF_ALLOWIP."');\n";
			$val .= 	"define('CNF_RESTRICIP','".CNF_RESTRICIP."');\n";									
			$val .= 	"define('CNF_YOUTUBE_API_KEY','".$request->input('cnf_youtube_api_key')."');\n";
            $val .= 	"define('CNF_SUPERADMIN_EMAIL','".$request->input('cnf_superadmin_email')."');\n";
            $val .= 	"define('CNF_GOOGLE_ANALYTIC_KEY','".$request->input('cnf_google_analytic_key')."');\n";
			$val .= 	"?>";
	
			$filename = base_path().'/setting.php';
			$fp=fopen($filename,"w+"); 
			fwrite($fp,$val); 
			fclose($fp); 
            
            $gId = \CommonHelper::getusertype("users-b2c");        
            $b2c_packages = \DB::table('tb_packages')->select('tb_packages.id','tb_packages.package_title', 'tb_packages.is_public')->join('tb_packages_user_groups', 'tb_packages.id', '=', 'tb_packages_user_groups.package_id')->where('tb_packages_user_groups.group_id', $gId)->get();
            $pkgs = array();
    		$pkg = $request->input('public_package');
            if(!empty($pkg)){
                $pkgs = $pkg;
            }            
            if(!empty($b2c_packages)){
                foreach($b2c_packages as $pkg){
                    if(in_array($pkg->id, $pkgs)) 
                    \DB::table('tb_packages')->where('id', $pkg->id)->update(array('is_public'=>1));
                    else
                    \DB::table('tb_packages')->where('id', $pkg->id)->update(array('is_public'=>0));
                }
            }
            
			return Redirect::to('sximo/config')->with('messagetext','Setting Has Been Save Successful')->with('msgstatus','success');
		} else {
			return Redirect::to('sximo/config')->with('messagetext', 'The following errors occurred')->with('msgstatus','success')
			->withErrors($validator)->withInput();
		}			
	
	}




	public function getEmail()
	{
		
		$regEmail = base_path()."/resources/views/user/emails/registration.blade.php";
		$bookingEmail = base_path()."/resources/views/user/emails/booking_notification.blade.php";
		$resetEmail = base_path()."/resources/views/user/emails/auth/reminder.blade.php";
		$invoiceEmail = base_path()."/resources/views/user/emails/invoice.blade.php";
		$container_template1 = base_path()."/resources/views/user/emails/container_template1.blade.php";
		$user_import = base_path()."/resources/views/user/emails/user_import.blade.php";
		$lightbox_template1 = base_path()."/resources/views/user/emails/lightbox_template1.blade.php";
		$lghtboxorderconfirm = base_path()."/resources/views/user/emails/lightbox_order_confirm.blade.php";
		$enquiry = base_path()."/resources/views/user/emails/enquiry.blade.php";
		$crmEmail = base_path()."/resources/views/user/emails/crm_email.blade.php";
		$frontendUpload = base_path()."/resources/views/user/emails/frontend_upload.blade.php";
		$frontendDownload = base_path()."/resources/views/user/emails/frontend_download.blade.php";
		$removalreminder = base_path()."/resources/views/user/emails/removal_reminder.blade.php";
        
		$refferalInvitation = base_path()."/resources/views/user/emails/invite.blade.php";
        $requestReferralEmailtoSuperAdmin = base_path()."/resources/views/user/emails/request_referral.blade.php";
        $requestReferralEmailtoUser = base_path()."/resources/views/user/emails/request_referral_user.blade.php";
        
        $priceOnRequestEmailtoSuperAdmin = base_path()."/resources/views/user/emails/price_on_request_admin.blade.php";
        $priceOnRequestEmailtoUser = base_path()."/resources/views/user/emails/price_on_request_user.blade.php";
        
		$this->data = array(
			'groups'	=> Groups::all(),
			'pageTitle'	=> 'Blast Email',
			'pageNote'	=> 'Send email to users',
			'regEmail' 	=> file_get_contents($regEmail),
			'bookingEmail' 	=> file_get_contents($bookingEmail),
			'resetEmail'	=> 	file_get_contents($resetEmail),
			'invoiceEmail'	=> 	file_get_contents($invoiceEmail),
			'container_template1'	=> 	file_get_contents($container_template1),
			'user_import'	=> 	file_get_contents($user_import),
			'lightbox_template1'	=> 	file_get_contents($lightbox_template1),
			'lghtboxorderconfirm'	=> 	file_get_contents($lghtboxorderconfirm),
			'enquiry'	=> 	file_get_contents($enquiry),
			'crmEmail'	=> 	file_get_contents($crmEmail),
			'frontendUpload'	=> 	file_get_contents($frontendUpload),
			'frontendDownload'	=> 	file_get_contents($frontendDownload),
			'removalreminder'	=> 	file_get_contents($removalreminder),
			'active'		=> 'email',
            'refferalInvitation'	=> 	file_get_contents($refferalInvitation),
            'requestReferralEmailtoSuperAdmin'	=> 	file_get_contents($requestReferralEmailtoSuperAdmin),
            'requestReferralEmailtoUser'	=> 	file_get_contents($requestReferralEmailtoUser),
            
            'priceOnRequestEmailtoSuperAdmin'	=> 	file_get_contents($priceOnRequestEmailtoSuperAdmin),
            'priceOnRequestEmailtoUser'	=> 	file_get_contents($priceOnRequestEmailtoUser),
		);	
		return view('sximo.config.email',$this->data);		
	
	}
	
	function postEmail( Request $request)
	{
		
		//print_r($_POST);exit;
		$rules = array(
			'regEmail'		=> 'required|min:10',
			'resetEmail'		=> 'required|min:10',
			'invoiceEmail'		=> 'required|min:10',
		);	
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) 
		{
			$regEmailFile = base_path()."/resources/views/user/emails/registration.blade.php";
			$bookingEmailFile = base_path()."/resources/views/user/emails/booking_notification.blade.php";
			$resetEmailFile = base_path()."/resources/views/user/emails/auth/reminder.blade.php";
			$invoiceEmailFile = base_path()."/resources/views/user/emails/invoice.blade.php";
			$container_template1 = base_path()."/resources/views/user/emails/container_template1.blade.php";
			$user_import = base_path()."/resources/views/user/emails/user_import.blade.php";
			$lightbox_template1 = base_path()."/resources/views/user/emails/lightbox_template1.blade.php";
			$lghtboxorderconfirm = base_path()."/resources/views/user/emails/lightbox_order_confirm.blade.php";
			$enquiry = base_path()."/resources/views/user/emails/enquiry.blade.php";
			$crmEmail = base_path()."/resources/views/user/emails/crm_email.blade.php";
			$frontendUpload = base_path()."/resources/views/user/emails/frontend_upload.blade.php";
			$frontendDownload = base_path()."/resources/views/user/emails/frontend_download.blade.php";
			$removalreminder = base_path()."/resources/views/user/emails/removal_reminder.blade.php";
            
            $refferalInvitation = base_path()."/resources/views/user/emails/invite.blade.php";
			
			$fp=fopen($regEmailFile,"w+"); 				
			fwrite($fp,$_POST['regEmail']); 
			fclose($fp);	
			
			$fp=fopen($bookingEmailFile,"w+"); 				
			fwrite($fp,$_POST['bookingEmail']); 
			fclose($fp);	
			
			$fp=fopen($resetEmailFile,"w+"); 				
			fwrite($fp,$_POST['resetEmail']); 
			fclose($fp);
			
			$fp=fopen($invoiceEmailFile,"w+"); 				
			fwrite($fp,$_POST['invoiceEmail']); 
			fclose($fp);
			
			$fp=fopen($container_template1,"w+"); 				
			fwrite($fp,$_POST['container_temp1']); 
			fclose($fp);
			
			$fp=fopen($user_import,"w+"); 				
			fwrite($fp,$_POST['user_import']); 
			fclose($fp);
			
			$fp=fopen($lightbox_template1,"w+"); 				
			fwrite($fp,$_POST['lightbox_template1']); 
			fclose($fp);
			
			$lp=fopen($lghtboxorderconfirm,"w+"); 				
			fwrite($lp,$_POST['lghtboxorderconfirm']); 
			fclose($lp);
			
			$lp=fopen($enquiry,"w+"); 				
			fwrite($lp,$_POST['enquiry']); 
			fclose($lp);
			
			$crm=fopen($crmEmail,"w+"); 				
			fwrite($crm,$_POST['crmEmail']); 
			fclose($crm);
			
			$fum=fopen($frontendUpload,"w+"); 				
			fwrite($fum,$_POST['frontendUpload']); 
			fclose($fum);
			
			$fdm=fopen($frontendDownload,"w+"); 				
			fwrite($fdm,$_POST['frontendDownload']); 
			fclose($fdm);
			
			$rrm=fopen($removalreminder,"w+"); 				
			fwrite($rrm,$_POST['removalreminder']); 
			fclose($rrm);
			
            $rim=fopen($refferalInvitation,"w+"); 				
			fwrite($rim,$_POST['refferalInvitation']); 
			fclose($rim);
            
			return Redirect::to('sximo/config/email')->with('messagetext', 'Email Has Been Updated')->with('msgstatus','success');	
			
		}	else {

			return Redirect::to('sximo/config/email')->with('messagetext', 'The following errors occurred')->with('msgstatus','success')
			->withErrors($validator)->withInput();
		}
	
	}
	
	public function getSecurity()
	{
		
		$this->data = array(
			'groups'	=> Groups::all(),
			'pageTitle'	=> 'Login And Security',
			'pageNote'	=> 'Login Configuration and Setting',
			'active'	=> 'security'
			
		);
	
		return view('sximo.config.security',$this->data);		
	
	}	
	
		

	
	public function postLogin( Request $request)
	{

		$rules = array(

		);
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$val  =		"<?php \n"; 
			$val .= 	"define('CNF_APPNAME','".CNF_APPNAME."');\n";
			$val .= 	"define('CNF_APPDESC','".CNF_APPDESC."');\n";
			$val .= 	"define('CNF_COMNAME','".CNF_COMNAME."');\n";
			$val .= 	"define('CNF_EMAIL','".CNF_EMAIL."');\n";
			$val .= 	"define('CNF_METAKEY','".CNF_METAKEY."');\n";	
			$val .= 	"define('CNF_METADESC','".CNF_METADESC."');\n";					
			$val .= 	"define('CNF_GROUP','".$request->input('CNF_GROUP')."');\n";	
			$val .= 	"define('CNF_ACTIVATION','".$request->input('CNF_ACTIVATION')."');\n";	
			$val .= 	"define('CNF_MULTILANG','".CNF_MULTILANG."');\n";
			$val .= 	"define('CNF_LANG','".CNF_LANG."');\n";		
			$val .= 	"define('CNF_REGIST','".(!is_null($request->input('CNF_REGIST')) ? 'true':'false')."');\n";		
			$val .= 	"define('CNF_FRONT','".(!is_null($request->input('CNF_FRONT')) ? 'true':'false')."');\n";		
			$val .= 	"define('CNF_RECAPTCHA','".(!is_null($request->input('CNF_RECAPTCHA')) ? 'true':'false')."');\n";	
			$val .= 	"define('CNF_THEME','".CNF_THEME."');\n";	
			$val .= 	"define('CNF_RECAPTCHAPUBLICKEY','');\n";
			$val .= 	"define('CNF_RECAPTCHAPRIVATEKEY','');\n";
			$val .= 	"define('CNF_MODE','".CNF_MODE."');\n";	
			$val .= 	"define('CNF_LOGO','".CNF_LOGO."');\n";
			$val .= 	"define('CNF_ALLOWIP','".$request->input('CNF_ALLOWIP')."');\n";
			$val .= 	"define('CNF_RESTRICIP','".$request->input('CNF_RESTRICIP')."');\n";									
			$val .= 	"?>";
	
			$filename = '../setting.php';
			$fp=fopen($filename,"w+"); 
			fwrite($fp,$val); 
			fclose($fp); 
			return Redirect::to('sximo/config/security')->with('messagetext','Setting Has Been Save Successful')->with('msgstatus','success');
		} else {
			return Redirect::to('sximo/config/security')->with('messagetext', 'The following errors occurred')->with('msgstatus','error')
			->withErrors($validator)->withInput();
		}	
	}
	
	public function getLog( $type = null)
	{
	
		
		$this->data = array(
			'pageTitle'	=> 'Help Manual',
			'pageNote'	=> 'Documentation',
			'active'	=> 'log'
		);	
		return view('sximo.config.log',$this->data);	
	}
		
	
	public function getClearlog()
	{
		
		$dir = base_path()."/storage/logs";	
		foreach(glob($dir . '/*') as $file) {
			if(is_dir($file))
			{
				//removedir($file);
			} else {

				unlink($file);
			}
		}

		$dir = base_path()."/storage/framework/views";	
		foreach(glob($dir . '/*') as $file) {
			if(is_dir($file))
			{
				//removedir($file);
			} else {
				
				unlink($file);
			}
		}		

		return Redirect::to('sximo/config/log')->with('messagetext','Cache has been cleared !')->with('msgstatus','success');	
	}
	
	function removeDir($dir) {
		foreach(glob($dir . '/*') as $file) {
			if(is_dir($file))
				removedir($file);
			else
				unlink($file);
		}
		rmdir($dir);
	}
	
	public function getTranslation( Request $request, $type = null)
	{
		if(!is_null($request->input('edit')))
		{
			$file = (!is_null($request->input('file')) ? $request->input('file') : 'core.php'); 
			$files = scandir(base_path()."/resources/lang/".$request->input('edit')."/");

			//$str = serialize(file_get_contents('./protected/app/lang/'.$request->input('edit').'/core.php'));
			$str = \File::getRequire(base_path()."/resources/lang/".$request->input('edit').'/'.$file);
			
			
			$this->data = array(
				'pageTitle'	=> 'Help Manual',
				'pageNote'	=> 'Documentation',
				'stringLang'	=> $str,
				'lang'			=> $request->input('edit'),
				'files'			=> $files ,
				'file'			=> $file ,
			);	
			$template = 'edit';
		
		} else {

			$this->data = array(
				'pageTitle'	=> 'Help Manual',
				'pageNote'	=> 'Documentation',
			);	
			$template = 'index';		
		
		}

		return view('sximo.config.translation.'.$template,$this->data);	
	}
	
	public function getAddtranslation()
	{
		return view("sximo.config.translation.create");
	} 
	
	public function postAddtranslation( Request $request)
	{
		$rules = array(
			'name'		=> 'required',
			'folder'	=> 'required|alpha',
			'author'	=> 'required',
		);
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {

			$template = base_path();

			$folder = $request->input('folder');
			mkdir( $template."/resources/lang/".$folder ,0777 );	
			
			$info = json_encode(array("name"=> $request->input('name'),"folder"=> $folder , "author" => $request->input('author')));
			$fp=fopen(  $template.'/resources/lang/'.$folder.'/info.json',"w+"); 
			fwrite($fp,$info); 
			fclose($fp); 	
					
			$files = scandir( $template .'/resources/lang/en/');
			foreach($files as $f)
			{
				if($f != "." and $f != ".." and $f != 'info.json')
				{
					copy( $template .'/resources/lang/en/'.$f, $template .'/resources/lang/'.$folder.'/'.$f);
				}
			}
			return Redirect::to('sximo/config/translation')->with('messagetect','New Translation has been added !')->with('msgstatus','success');	;			
			
		} else {
			return Redirect::to('sximo/config/translation')->with('messagetext','Failed to add translation !' )->with('msgstatus','error')->withErrors($validator)->withInput();
		}		
	
	}
	
	public function postSavetranslation( Request $request)
	{
		$template = base_path();
		
		$form  	= "<?php \n"; 
		$form 	.= "return array( \n";
		foreach($_POST as $key => $val)
		{
			if($key !='_token' && $key !='lang' && $key !='file') 
			{
				if(!is_array($val))
				{
					$form .= '"'.$key.'"			=> "'.strip_tags($val).'", '." \n ";
				
				} else {
					$form .= '"'.$key.'"			=> array( '." \n ";
					foreach($val as $k=>$v)
					{
							$form .= '      "'.$k.'"			=> "'.strip_tags($v).'", '." \n ";
					}
					$form .= "), \n";
				}
			}		
		
		}
		$form .= ');';
		//echo $form; exit;
		$lang = $request->input('lang');
		$file	= $request->input('file');
		$filename = $template .'/resources/lang/'.$lang.'/'.$file;
	//	$filename = 'lang.php';
		$fp=fopen($filename,"w+"); 
		fwrite($fp,$form); 
		fclose($fp); 	
		return Redirect::to('sximo/config/translation?edit='.$lang.'&file='.$file)
		->with('messagetext','Translation has been saved !')->with('msgstatus','success');	
	
	} 	
	
	public function getRemovetranslation( $folder )
	{
		self::removeDir( base_path()."/resources/lang/".$folder);
		return Redirect::to('sximo/config/translation')->with('messagetext','Translation has been removed !')->with('msgstatus','success');	
		
	}

	public function getInvoice()
	{
		$this->data = array(
			'pageTitle'	=> 'Help Manual',
			'pageNote'	=> 'Documentation',
			'active'	=> 'invoice'
		);	
		
		$this->data['invoice_num'] = \DB::table('tb_settings')->where('key_value', 'default_invoice_num')->first();
		$this->data['tax_amount'] = \DB::table('tb_settings')->where('key_value', 'default_tax_amount')->first();
		$this->data['currency'] = \DB::table('tb_settings')->where('key_value', 'default_currency')->first();
		$this->data['bankDet'] = \DB::table('tb_settings')->where('key_value', 'bank_details')->first();
		$this->data['regDet'] = \DB::table('tb_settings')->where('key_value', 'reg_detail')->first();
		$this->data['contDet'] = \DB::table('tb_settings')->where('key_value', 'contact_detail')->first();
		$this->data['invoice_phone_num'] = \DB::table('tb_settings')->where('key_value', 'invoice_phone_num')->first();
		$this->data['invoice_email_id'] = \DB::table('tb_settings')->where('key_value', 'invoice_email_id')->first();
		$this->data['invoice_address'] = \DB::table('tb_settings')->where('key_value', 'invoice_address')->first();
        
        $this->data['invoice_total_footer_message'] = \DB::table('tb_settings')->where('key_value', 'invoice_total_footer_message')->first();
		$this->data['invoice_footer_message'] = \DB::table('tb_settings')->where('key_value', 'invoice_footer_message')->first();
		
		return view('sximo.config.invoice',$this->data);	
	}	
	
	
	function postInvoice( Request $request)
	{
		
		//print_r($_POST);exit;
		$rules = array(
			'invoice_num'		=> 'required',			
		);	
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) 
		{
			\DB::table('tb_settings')->where('key_value', 'default_invoice_num')->update(['content' => Input::get('invoice_num')]);
			
			\DB::table('tb_settings')->where('key_value', 'default_tax_amount')->update(['content' => Input::get('tax_amt')]);
			
			\DB::table('tb_settings')->where('key_value', 'default_currency')->update(['content' => Input::get('tax_currency')]);
			
			\DB::table('tb_settings')->where('key_value', 'bank_details')->update(['content' => Input::get('bankDetail')]);
			\DB::table('tb_settings')->where('key_value', 'reg_detail')->update(['content' => Input::get('regDetail')]);
			\DB::table('tb_settings')->where('key_value', 'contact_detail')->update(['content' => Input::get('contactDetail')]);
			
			\DB::table('tb_settings')->where('key_value', 'invoice_phone_num')->update(['content' => Input::get('invoice_phone_num')]);
			\DB::table('tb_settings')->where('key_value', 'invoice_email_id')->update(['content' => Input::get('invoice_email_id')]);
			\DB::table('tb_settings')->where('key_value', 'invoice_address')->update(['content' => Input::get('invoice_address')]);
            
            \DB::table('tb_settings')->where('key_value', 'invoice_total_footer_message')->update(['content' => Input::get('invoice_total_footer_message')]);
			\DB::table('tb_settings')->where('key_value', 'invoice_footer_message')->update(['content' => Input::get('invoice_footer_message')]);
			
			return Redirect::to('sximo/config/invoice')->with('messagetext', 'Invoice settings Has Been Updated')->with('msgstatus','success');	
			
		}	else {

			return Redirect::to('sximo/config/invoice')->with('messagetext', 'The following errors occurred')->with('msgstatus','success')
			->withErrors($validator)->withInput();
		}
	
	}
	
	public function getAdvertisement()
	{
		$this->data = array(
			'pageTitle'	=> 'Help Manual',
			'pageNote'	=> 'Documentation',
			'active'	=> 'advertisement'
		);	
		
		$this->data['sidebar_ads_days'] = \DB::table('tb_settings')->where('key_value', 'sidebar_advertisement_expiry_days')->first();
		$this->data['sidebar_ads_price'] = \DB::table('tb_settings')->where('key_value', 'sidebar_advertisement_price')->first();
		$this->data['slider_ads_days'] = \DB::table('tb_settings')->where('key_value', 'slider_advertisement_expiry_days')->first();
		$this->data['slider_ads_price'] = \DB::table('tb_settings')->where('key_value', 'slider_advertisement_price')->first();
		
		return view('sximo.config.advertisement',$this->data);	
	}
	
	function postAdvertisement( Request $request)
	{
		
		//print_r($_POST);exit;
		$rules = array(
			'sidebar_ads_days'		=> 'required',	
			'sidebar_ads_price'		=> 'required',
			'slider_ads_days'		=> 'required',
			'slider_ads_price'		=> 'required',			
		);	
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) 
		{
			\DB::table('tb_settings')->where('key_value', 'sidebar_advertisement_expiry_days')->update(['content' => Input::get('sidebar_ads_days')]);
			
			\DB::table('tb_settings')->where('key_value', 'sidebar_advertisement_price')->update(['content' => Input::get('sidebar_ads_price')]);
			
			\DB::table('tb_settings')->where('key_value', 'slider_advertisement_expiry_days')->update(['content' => Input::get('slider_ads_days')]);
			
			\DB::table('tb_settings')->where('key_value', 'slider_advertisement_price')->update(['content' => Input::get('slider_ads_price')]);
			
			return Redirect::to('sximo/config/advertisement')->with('messagetext', 'Default Printer Has Been Updated')->with('msgstatus','success');	
			
		}	else {

			return Redirect::to('sximo/config/advertisement')->with('messagetext', 'Please select a printer.')->with('msgstatus','success')
			->withErrors($validator)->withInput();
		}
	
	}
	
	public function getKontakte()
	{
		$this->data = array(
			'pageTitle'	=> 'Help Manual',
			'pageNote'	=> 'Documentation',
			'active'	=> 'kontakte'
		);

		$this->data['head_office'] = \DB::table('tb_settings')->where('key_value', 'head_office')->first();
		$this->data['gesamtvertrieb'] = \DB::table('tb_settings')->where('key_value', 'gesamtvertrieb')->first();
		$this->data['presse'] = \DB::table('tb_settings')->where('key_value', 'presse')->first();
		$this->data['footer_text'] = \DB::table('tb_settings')->where('key_value', 'footer_text')->first();
        $this->data['about_header_text'] = \DB::table('tb_settings')->where('key_value', 'about_header_text')->first();
		$this->data['about_text'] = \DB::table('tb_settings')->where('key_value', 'about_text')->first();
		
		$this->data['services_titles'] = \DB::table('tb_services')->select('id','title')->where('status', 1)->get();
		$services_column1 = \DB::table('tb_settings')->where('key_value', 'services_column1')->first();
		if(!empty($services_column1) && $services_column1->content!='')
		{
			$this->data['services_column1'] = explode(',',$services_column1->content);
		}
		
		$services_column2 = \DB::table('tb_settings')->where('key_value', 'services_column2')->first();
		if(!empty($services_column2) && $services_column2->content!='')
		{
			$this->data['services_column2'] = explode(',',$services_column2->content);
		}
		$services_column3 = \DB::table('tb_settings')->where('key_value', 'services_column3')->first();
		if(!empty($services_column3) && $services_column3->content!='')
		{
			$this->data['services_column3'] = explode(',',$services_column3->content);
		}
		
		return view('sximo.config.kontakte',$this->data);	
	}
	
	function postKontakte( Request $request)
	{
		
		//print_r($request->all());exit;
		$rules = array(
			'head_office'		=> 'required',
			'gesamtvertrieb'		=> 'required',
			'presse'		=> 'required',			
		);
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) 
		{
			\DB::table('tb_settings')->where('key_value', 'head_office')->update(['content' => Input::get('head_office')]);
			\DB::table('tb_settings')->where('key_value', 'gesamtvertrieb')->update(['content' => Input::get('gesamtvertrieb')]);
			\DB::table('tb_settings')->where('key_value', 'presse')->update(['content' => Input::get('presse')]);
			\DB::table('tb_settings')->where('key_value', 'footer_text')->update(['content' => Input::get('footerText')]);
            \DB::table('tb_settings')->where('key_value', 'about_header_text')->update(['content' => Input::get('aboutHeaderText')]);
			\DB::table('tb_settings')->where('key_value', 'about_text')->update(['content' => Input::get('aboutText')]);
			if(!empty(Input::get('services_column1')))
			{
				\DB::table('tb_settings')->where('key_value', 'services_column1')->update(['content' => implode(',',Input::get('services_column1'))]);
			}
			if(!empty(Input::get('services_column2')))
			{
				\DB::table('tb_settings')->where('key_value', 'services_column2')->update(['content' => implode(',',Input::get('services_column2'))]);
			}
			if(!empty(Input::get('services_column3')))
			{
				\DB::table('tb_settings')->where('key_value', 'services_column3')->update(['content' => implode(',',Input::get('services_column33'))]);
			}
			
			return Redirect::to('sximo/config/kontakte')->with('messagetext', 'Kontakte settings Has Been Updated')->with('msgstatus','success');	
			
		}	else {

			return Redirect::to('sximo/config/kontakte')->with('messagetext', 'The following errors occurred')->with('msgstatus','success')
			->withErrors($validator)->withInput();
		}
	}
	
	public function getContainer()
	{
		$this->data = array(
			'pageTitle'	=> 'Help Manual',
			'pageNote'	=> 'Documentation',
			'active'	=> 'container'
		);

		$this->data['front_design'] = \DB::table('tb_settings')->where('key_value', 'frontend_design')->first();
		$this->data['produktinformation'] = \DB::table('tb_settings')->where('key_value', 'produktinformation')->first();
		
		return view('sximo.config.container',$this->data);	
	}
	
	function postContainer( Request $request)
	{
		
		//print_r($_POST);exit;
		$rules = array(
			'front_design'		=> 'required',		
		);
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) 
		{
			\DB::table('tb_settings')->where('key_value', 'frontend_design')->update(['content' => Input::get('front_design')]);
			
			\DB::table('tb_settings')->where('key_value', 'produktinformation')->update(['content' => Input::get('produktinformation')]);
			
			return Redirect::to('sximo/config/container')->with('messagetext', 'Container settings Has Been Updated')->with('msgstatus','success');	
			
		}	else {

			return Redirect::to('sximo/config/container')->with('messagetext', 'The following errors occurred')->with('msgstatus','success')
			->withErrors($validator)->withInput();
		}
	}
	
	public function getDesigner()
	{
		$this->data = array(
			'pageTitle'	=> 'Help Manual',
			'pageNote'	=> 'Documentation',
			'active'	=> 'designer'
		);	
		
		$this->data['designer_title'] = \DB::table('tb_settings')->where('key_value', 'designer_title')->first();
		$this->data['designer_desc'] = \DB::table('tb_settings')->where('key_value', 'designer_desc')->first();
		$this->data['designer_title_eng'] = \DB::table('tb_settings')->where('key_value', 'designer_title_eng')->first();
		$this->data['designer_desc_eng'] = \DB::table('tb_settings')->where('key_value', 'designer_desc_eng')->first();
		
		return view('sximo.config.designer',$this->data);	
	}	
	
	
	function postDesigner( Request $request)
	{
		
		//print_r($_POST);exit;
		$rules = array(
			'designer_title'		=> 'required',
			'designer_desc'		=> 'required',
		);	
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) 
		{
			\DB::table('tb_settings')->where('key_value', 'designer_title')->update(['content' => Input::get('designer_title')]);
			
			\DB::table('tb_settings')->where('key_value', 'designer_desc')->update(['content' => Input::get('designer_desc')]);
			
			\DB::table('tb_settings')->where('key_value', 'designer_title_eng')->update(['content' => Input::get('designer_title_eng')]);
			
			\DB::table('tb_settings')->where('key_value', 'designer_desc_eng')->update(['content' => Input::get('designer_desc_eng')]);
			
			return Redirect::to('sximo/config/designer')->with('messagetext', 'Designer settings Has Been Updated')->with('msgstatus','success');	
			
		}	else {

			return Redirect::to('sximo/config/designer')->with('messagetext', 'The following errors occurred')->with('msgstatus','success')
			->withErrors($validator)->withInput();
		}
	
	}
    
    public function getContract()
	{
		$this->data = array(
			'pageTitle'	=> 'Help Manual',
			'pageNote'	=> 'Documentation',
			'active'	=> 'contract'
		);	
		
        $this->data['contract_first_name'] = \DB::table('tb_settings')->where('key_value', 'contract_first_name')->first();
        $this->data['contract_last_name'] = \DB::table('tb_settings')->where('key_value', 'contract_last_name')->first();  
		$this->data['contract_logo'] = \DB::table('tb_settings')->where('key_value', 'contract_logo')->first();
        $this->data['contract_company'] = \DB::table('tb_settings')->where('key_value', 'contract_company')->first();
		$this->data['contract_title1'] = \DB::table('tb_settings')->where('key_value', 'contract_title1')->first();
		$this->data['contract_title2'] = \DB::table('tb_settings')->where('key_value', 'contract_title2')->first();
		$this->data['contract_title3'] = \DB::table('tb_settings')->where('key_value', 'contract_title3')->first();
        $this->data['contract_paragraph'] = \DB::table('tb_settings')->where('key_value', 'contract_paragraph')->first();
        
        $this->data['contract_company_eng'] = \DB::table('tb_settings')->where('key_value', 'contract_company_eng')->first();
		$this->data['contract_title1_eng'] = \DB::table('tb_settings')->where('key_value', 'contract_title1_eng')->first();
		$this->data['contract_title2_eng'] = \DB::table('tb_settings')->where('key_value', 'contract_title2_eng')->first();
		$this->data['contract_title3_eng'] = \DB::table('tb_settings')->where('key_value', 'contract_title3_eng')->first();
        $this->data['contract_paragraph_eng'] = \DB::table('tb_settings')->where('key_value', 'contract_paragraph_eng')->first();
        
        $this->data['contract_block1'] = \DB::table('tb_settings')->where('key_value', 'contract_block1')->first();
		$this->data['contract_block2'] = \DB::table('tb_settings')->where('key_value', 'contract_block2')->first();
		$this->data['contract_block3'] = \DB::table('tb_settings')->where('key_value', 'contract_block3')->first();
		
		return view('sximo.config.contract',$this->data);	
	}	
	
	
	function postContract( Request $request)
	{
		
		//print_r($_POST);exit;
		$rules = array(
			'contract_company'		=> 'required',			
		);	
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) 
		{
		    $logo = '';
			if(!is_null(Input::file('contract_logo')))
			{
				$file = Input::file('contract_logo');                
			 	$destinationPath = public_path().'/sximo/images/'; 
				$filename = $file->getClientOriginalName();
				$extension =$file->getClientOriginalExtension(); //if you need extension of the file
				$logo = 'contract-logo.'.$extension;
				$uploadSuccess = $file->move($destinationPath, $logo);
                
                \DB::table('tb_settings')->where('key_value', 'contract_logo')->update(['content' => $logo]);
			}
            
            \DB::table('tb_settings')->where('key_value', 'contract_first_name')->update(['content' => Input::get('contract_first_name')]);			
			\DB::table('tb_settings')->where('key_value', 'contract_last_name')->update(['content' => Input::get('contract_last_name')]);
            
			\DB::table('tb_settings')->where('key_value', 'contract_company')->update(['content' => Input::get('contract_company')]);			
			\DB::table('tb_settings')->where('key_value', 'contract_title1')->update(['content' => Input::get('contract_title1')]);
            \DB::table('tb_settings')->where('key_value', 'contract_title2')->update(['content' => Input::get('contract_title2')]);			
			\DB::table('tb_settings')->where('key_value', 'contract_title3')->update(['content' => Input::get('contract_title3')]);
            \DB::table('tb_settings')->where('key_value', 'contract_paragraph')->update(['content' => Input::get('contract_paragraph')]);
			
			\DB::table('tb_settings')->where('key_value', 'contract_company_eng')->update(['content' => Input::get('contract_company_eng')]);			
			\DB::table('tb_settings')->where('key_value', 'contract_title1_eng')->update(['content' => Input::get('contract_title1_eng')]);
            \DB::table('tb_settings')->where('key_value', 'contract_title2_eng')->update(['content' => Input::get('contract_title2_eng')]);			
			\DB::table('tb_settings')->where('key_value', 'contract_title3_eng')->update(['content' => Input::get('contract_title3_eng')]);
            \DB::table('tb_settings')->where('key_value', 'contract_paragraph_eng')->update(['content' => Input::get('contract_paragraph_eng')]);
            
            \DB::table('tb_settings')->where('key_value', 'contract_block1')->update(['content' => Input::get('contract_block1')]);			
			\DB::table('tb_settings')->where('key_value', 'contract_block2')->update(['content' => Input::get('contract_block2')]);
            \DB::table('tb_settings')->where('key_value', 'contract_block3')->update(['content' => Input::get('contract_block3')]);
			
			return Redirect::to('sximo/config/contract')->with('messagetext', 'Contract settings Has Been Updated')->with('msgstatus','success');	
			
		}	else {

			return Redirect::to('sximo/config/contract')->with('messagetext', 'The following errors occurred')->with('msgstatus','success')
			->withErrors($validator)->withInput();
		}
	
	}
    
    public function getSeason()
	{
		$this->data = array(
			'pageTitle'	=> 'Help Manual',
			'pageNote'	=> 'Documentation',
			'active'	=> 'season'
		);	
		
        $this->data['season_start_date'] = \DB::table('tb_settings')->where('key_value', 'season_start_date')->first();
        $this->data['season_end_date'] = \DB::table('tb_settings')->where('key_value', 'season_end_date')->first();  
		
		
		return view('sximo.config.season',$this->data);	
	}	
	
	
	function postSeason( Request $request)
	{
		
		//print_r($_POST);exit;
		$rules = array(
			'season_start_date'		=> 'required',
            'season_end_date'		=> 'required',			
		);	
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) 
		{            
            \DB::table('tb_settings')->where('key_value', 'season_start_date')->update(['content' => Input::get('season_start_date')]);			
			\DB::table('tb_settings')->where('key_value', 'season_end_date')->update(['content' => Input::get('season_end_date')]);            
			
			return Redirect::to('sximo/config/season')->with('messagetext', 'Default season settings has been updated')->with('msgstatus','success');	
			
		}	else {

			return Redirect::to('sximo/config/season')->with('messagetext', 'The following errors occurred')->with('msgstatus','success')
			->withErrors($validator)->withInput();
		}
	
	}
    public function getCitytax()
	{
		$this->data = array(
			'pageTitle'	=> 'Help Manual',
			'pageNote'	=> 'Documentation',
			'active'	=> 'designer'
		);	
		
		$this->data['adult_citytax'] = \DB::table('tb_settings')->where('key_value', 'adult_citytax')->first();
		$this->data['adult_citytax_eng'] = \DB::table('tb_settings')->where('key_value', 'adult_citytax_eng')->first();
		$this->data['baby_citytax'] = \DB::table('tb_settings')->where('key_value', 'baby_citytax')->first();
		$this->data['baby_citytax_eng'] = \DB::table('tb_settings')->where('key_value', 'baby_citytax_eng')->first();
        $this->data['junior_citytax'] = \DB::table('tb_settings')->where('key_value', 'junior_citytax')->first();
		$this->data['junior_citytax_eng'] = \DB::table('tb_settings')->where('key_value', 'junior_citytax_eng')->first();
		
		return view('sximo.config.citytax',$this->data);	
	}	
	
	function postCitytax( Request $request)
	{
		
		//print_r($_POST);exit;
		$rules = array(
			'adult_citytax'		=> 'required',			
		);	
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) 
		{
			\DB::table('tb_settings')->where('key_value', 'adult_citytax')->update(['content' => Input::get('adult_citytax')]);			
			\DB::table('tb_settings')->where('key_value', 'adult_citytax_eng')->update(['content' => Input::get('adult_citytax_eng')]);			
			\DB::table('tb_settings')->where('key_value', 'baby_citytax')->update(['content' => Input::get('baby_citytax')]);			
			\DB::table('tb_settings')->where('key_value', 'baby_citytax_eng')->update(['content' => Input::get('baby_citytax_eng')]);            
            \DB::table('tb_settings')->where('key_value', 'junior_citytax')->update(['content' => Input::get('junior_citytax')]);			
			\DB::table('tb_settings')->where('key_value', 'junior_citytax_eng')->update(['content' => Input::get('junior_citytax_eng')]);
			
			return Redirect::to('sximo/config/citytax')->with('messagetext', 'City tax settings has been updated')->with('msgstatus','success');	
			
		}	else {

			return Redirect::to('sximo/config/citytax')->with('messagetext', 'The following errors occurred')->with('msgstatus','success')
			->withErrors($validator)->withInput();
		}
	
	}
    
    public function getSuppliercommission()
	{
		$this->data = array(
			'pageTitle'	=> 'Supplier commission',
			'pageNote'	=> 'Documentation',
			'active'	=> 'suppliercommission'
		);	
		
		$this->data['supplier_commission'] = \DB::table('tb_settings')->where('key_value', 'supplier_commission')->first();
		$this->data['supplier_commission_eng'] = \DB::table('tb_settings')->where('key_value', 'supplier_commission_eng')->first();
				
		return view('sximo.config.suppliercommission',$this->data);	
	}	
	
	function postSuppliercommission( Request $request)
	{
		
		//print_r($_POST);exit;
		$rules = array(
			'supplier_commission'		=> 'required',			
		);	
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) 
		{
			\DB::table('tb_settings')->where('key_value', 'supplier_commission')->update(['content' => Input::get('supplier_commission')]);			
			\DB::table('tb_settings')->where('key_value', 'supplier_commission_eng')->update(['content' => Input::get('supplier_commission_eng')]);		
			
			return Redirect::to('sximo/config/suppliercommission')->with('messagetext', 'Supplier commission settings has been updated')->with('msgstatus','success');	
			
		}	else {

			return Redirect::to('sximo/config/suppliercommission')->with('messagetext', 'The following errors occurred')->with('msgstatus','success')
			->withErrors($validator)->withInput();
		}
	
	}
}