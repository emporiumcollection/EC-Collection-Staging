<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 
use File;
use DB, Response;
use App\User;
use App\Http\Controllers\ContainerController; 


class UserimportController extends Controller {

	protected $data = array();	
	
	public function __construct()
	{
		
	}
	
	public function userImportFromDB( Request $request)
	{
		$clientusers = DB::table('fe_users')->where('imported', 0)->get();
		if(!empty($clientusers))
		{
			foreach($clientusers as $cuser)
			{
				$existusers = DB::table('tb_users')->where('email', $cuser->email)->count();
				if($existusers==0)
				{
					if($cuser->usergroup==1 || $cuser->usergroup==2)
					{
						$group = 2;
					}
					else{
						$group = $cuser->usergroup;
					}
					$udata['group_id'] = $group;
					$udata['username'] = $cuser->username;
					$udata['password'] = 'user'.rand(10000,10000000);
					$udata['email'] = $cuser->email;
					$udata['first_name'] = $cuser->first_name;
					$udata['last_name'] = $cuser->last_name;
					$udata['active'] = 1;
					$udata['created_at'] = date('Y-m-d h:i:s');
					$new_userid = DB::table('tb_users')->insertGetId($udata);
					
					$pdata['user_id'] = $new_userid;
					$pdata['company_name'] = $cuser->company;
					$pdata['company_email'] = $cuser->email;
					$pdata['company_address'] = $cuser->address;
					$pdata['company_city'] = $cuser->city;
					$pdata['company_postal_code'] = $cuser->zip;
					$pdata['company_phone'] = $cuser->telephone;
					DB::table('tb_user_company_details')->insertGetId($pdata);
					
					$existCRM = DB::table('employee')->where('Email', $cuser->email)->count();
					if($existCRM==0)
					{
						$edata['Phone'] = $cuser->telephone;
						$edata['Email'] = $cuser->email;
						$edata['FirstName'] = $cuser->first_name;
						$edata['LastName'] = $cuser->last_name;
						$edata['Status'] = 1;
						$new_crm = DB::table('employee')->insertGetId($edata);
					}
					
					DB::table('fe_users')->where('uid',$cuser->uid)->update(array('imported' => 1));
					
					$data['password'] = $udata['password'];
					$toouser['email'] = $cuser->email;
					$toouser['subject'] = 'Regarding New Passowrd';
					\Mail::send('user.emails.user_import', $data, function($message) use ($toouser)
					{
						$message->from(CNF_EMAIL, CNF_APPNAME);

						$message->to( $toouser['email']);
						
						$message->subject($toouser['subject']);
					});
				}
				
			}
			echo "Users Imported Sucessfully";
		}
		else
		{
			echo "Not Found New Users";
		}
	}
}