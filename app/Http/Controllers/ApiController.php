<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 
use File;
use DB, Response;
use App\User;
use App\Http\Controllers\ContainerController; 

class ApiController extends Controller {

	protected $data = array();	
	
	public function __construct()
	{
		
	}

	public function getAuthent( Request $request)
	{
		$usr = md5('optikerjson');
		$pass = md5('folgt');
		
		$pro_user = $request->input('login');
		$pro_pass = $request->input('password');
		if($pro_user!='' && $pro_pass!='')
		{
			if($pro_user==$usr && $pro_pass==$pass)
			{
				return 'success';
			}
			else
			{
				return Response::json(['status' => 'error', 'message' => 'Wrong username/password']);
			}
		}
		else
		{
			return Response::json(['status' => 'error', 'message' => 'Authentication Error']);
		}
	}

	public function retriveUserprofile( Request $request, $uid)
	{
		$ath = $this->getAuthent($request);
		if($ath=='success')
		{
			if($uid>0)
			{
				$getuser = DB::table('tb_user_company_details')->where('user_id', $uid)->first();
				if(!empty($getuser))
				{
					return Response::json(['status' => 'success', 'message' => 'Customer found', 'customer' => $getuser]);
				}
				else
				{
					return Response::json(['status' => 'error', 'message' => 'Customer not found']);
				}
				
			}
			else
			{
				return Response::json(['status' => 'error', 'message' => 'Invalid customer id provided.']);
			}
		}
		else
		{
			return $ath;
		}
	}	
	
	
	public function userProfileSave( Request $request)
	{
		$ath = $this->getAuthent($request);
		if($ath=='success')
		{
			if($request->input('user_id')=='' && $request->input('user_id')==0)
			{
				return Response::json(['status' => 'error', 'message' => 'Customer id not provided.']);
			}
			elseif($request->input('client_id')=='')
			{
				return Response::json(['status' => 'error', 'message' => 'Client id not provided.']);
			}
			elseif($request->input('company_name')=='')
			{
				return Response::json(['status' => 'error', 'message' => 'Company name not provided.']);
			}
			elseif($request->input('company_email')=='')
			{
				return Response::json(['status' => 'error', 'message' => 'Company email address not provided.']);
			}
			elseif($request->input('contact_person')=='')
			{
				return Response::json(['status' => 'error', 'message' => 'Contact person not provided.']);
			}
			else
			{
				$data['user_id'] = $request->input('user_id');
				$data['client_id'] = $request->input('client_id');
				$data['company_name'] = $request->input('company_name');
				$data['company_owner'] = $request->input('company_owner');
				$data['contact_person'] = $request->input('contact_person');
				$data['company_email'] = $request->input('company_email');
				$data['company_address'] = $request->input('company_address');
				$data['company_address2'] = $request->input('company_address2');
				$data['company_city'] = $request->input('company_city');
				$data['company_postal_code'] = $request->input('company_postal_code');
				$data['company_country'] = $request->input('company_country');
				$data['shipping_address'] = $request->input('shipping_address');
				$data['shipping_address2'] = $request->input('shipping_address2');
				$data['shipping_city'] = $request->input('shipping_city');
				$data['shipping_postal_code'] = $request->input('shipping_postal_code');
				$data['shipping_country'] = $request->input('shipping_country');
				$data['billing_address'] = $request->input('billing_address');
				$data['billing_address2'] = $request->input('billing_address2');
				$data['billing_city'] = $request->input('billing_city');
				$data['billing_postal_code'] = $request->input('billing_postal_code');
				$data['billing_country'] = $request->input('billing_country');
				$data['company_phone'] = $request->input('company_phone');
				$data['company_website'] = $request->input('company_website');
				$data['company_tax_number'] = $request->input('company_tax_no');
				$data['steuernummer'] = $request->input('steuernummer');
				$data['umsatzsteuer_id'] = $request->input('umsatzsteuer_id');
				$data['geschäftsführer'] = $request->input('geschäftsführer');
				$data['handelsregister'] = $request->input('handelsregister');
				$data['amtsgericht'] = $request->input('amtsgericht');
				$data['created'] = date('y-m-d h:i:s');
				
				DB::table('tb_user_company_details')->insert($data);
				
				return Response::json(['status' => 'success', 'message' => 'Customer\'s company details saved.']);
			}
		}
	}
	
	
	public function userProfileUpdate( Request $request, $uid)
	{
		$ath = $this->getAuthent($request);
		if($ath=='success')
		{
			if($uid>0)
			{
				$getuser = DB::table('tb_user_company_details')->where('user_id', $uid)->first();
				if(!empty($getuser))
				{
					if($request->input('client_id')=='')
					{
						return Response::json(['status' => 'error', 'message' => 'Client id not provided.']);
					}
					elseif($request->input('company_name')=='')
					{
						return Response::json(['status' => 'error', 'message' => 'Company name not provided.']);
					}
					elseif($request->input('company_email')=='')
					{
						return Response::json(['status' => 'error', 'message' => 'Company email address not provided.']);
					}
					elseif($request->input('contact_person')=='')
					{
						return Response::json(['status' => 'error', 'message' => 'Contact person not provided.']);
					}
					else
					{
						$data['client_id'] = $request->input('client_id');
						$data['company_name'] = $request->input('company_name');
						$data['company_owner'] = $request->input('company_owner');
						$data['contact_person'] = $request->input('contact_person');
						$data['company_email'] = $request->input('company_email');
						$data['company_address'] = $request->input('company_address');
						$data['company_address2'] = $request->input('company_address2');
						$data['company_city'] = $request->input('company_city');
						$data['company_postal_code'] = $request->input('company_postal_code');
						$data['company_country'] = $request->input('company_country');
						$data['shipping_address'] = $request->input('shipping_address');
						$data['shipping_address2'] = $request->input('shipping_address2');
						$data['shipping_city'] = $request->input('shipping_city');
						$data['shipping_postal_code'] = $request->input('shipping_postal_code');
						$data['shipping_country'] = $request->input('shipping_country');
						$data['billing_address'] = $request->input('billing_address');
						$data['billing_address2'] = $request->input('billing_address2');
						$data['billing_city'] = $request->input('billing_city');
						$data['billing_postal_code'] = $request->input('billing_postal_code');
						$data['billing_country'] = $request->input('billing_country');
						$data['company_phone'] = $request->input('company_phone');
						$data['company_website'] = $request->input('company_website');
						$data['company_tax_number'] = $request->input('company_tax_no');
						$data['steuernummer'] = $request->input('steuernummer');
						$data['umsatzsteuer_id'] = $request->input('umsatzsteuer_id');
						$data['geschäftsführer'] = $request->input('geschäftsführer');
						$data['handelsregister'] = $request->input('handelsregister');
						$data['amtsgericht'] = $request->input('amtsgericht');
						$data['updated'] = date('y-m-d h:i:s');
						
						DB::table('tb_user_company_details')->where('user_id', $uid)->update($data);
						
						return Response::json(['status' => 'success', 'message' => 'Customer\'s company details updated.']);
					}
				}
				else
				{
					return Response::json(['status' => 'error', 'message' => 'Customer not found']);
				}
			}
			else
			{
				return Response::json(['status' => 'error', 'message' => 'Invalid customer id provided.']);
			}
		}
	}
	
	public function getloggedIn( Request $request)
	{
		$pro_user = trim($request->input('username'));
		$pro_customer = trim($request->input('customerId'));
		$pro_pass = trim($request->input('password'));
		$newuid=0;
		if($pro_user!='' && $pro_pass!='')
		{
			if(!\Auth::check())
			{
				if (\Auth::attempt(array('email'=>$pro_user, 'password'=> $pro_pass, 'customer_number'=>$pro_customer))) 
				{
					if(\Auth::check())
					{
						DB::table('tb_users')->where('id', '=',$getuser->id )->update(array('last_login' => date("Y-m-d H:i:s")));
						\Session::put('uid', $getuser->id);
						\Session::put('gid', $getuser->group_id);
						\Session::put('eid', $getuser->email);
						\Session::put('ll', $getuser->last_login);
						\Session::put('fid', $getuser->first_name.' '. $getuser->last_name);
						$newuid = $getuser->id;
						\Auth::loginUsingId($newuid);
					}
				}
				else
				{
					$code = rand(10000,10000000);
					$authen = new User;
					$authen->email = $pro_user;
					$authen->activation = $code;
					$authen->group_id = 3;
					$authen->password = $pro_pass;
					$authen->active = '1';
					$authen->customer_number = $pro_customer;
					$authen->save();
					$newuid = $authen->id;
					\Auth::loginUsingId($newuid);
					DB::table('tb_users')->where('id', '=',$authen->id )->update(array('last_login' => date("Y-m-d H:i:s")));
					\Session::put('uid', $authen->id);
					\Session::put('gid', 3);
					\Session::put('eid', $pro_user);
					\Session::put('ll', date("Y-m-d H:i:s"));
				}
				
				if($newuid>0)
				{
					$userProfile = file_get_contents("https://www.rodenstock.net/net/stage/de/de/optikerjson?customerId=".$pro_customer);
					
					$decodeData = json_decode($userProfile);
					$getprofile = DB::table('tb_user_company_details')->where('user_id', $newuid)->first();
					
					$pdata['user_id'] = $newuid;
					$pdata['client_id'] = $decodeData->customerId;
					$pdata['company_name'] = $decodeData->shoptitle;
					$pdata['company_email'] = $decodeData->email;
					$pdata['company_address'] = $decodeData->street;
					$pdata['company_city'] = $decodeData->city;
					$pdata['company_postal_code'] = $decodeData->zip;
					
					$folder = DB::table('tb_container')->where('name', 'CI')->first();
					if(!empty($folder))
					{
						if($decodeData->logoFrontLowRes!='')
						{
							$filename = $newuid.'.png';
							$downfolder = (new ContainerController)->getContainerUserPath($folder->id);
							if( is_dir($downfolder) === true )
							{
								$destinationPath = './uploads/users/company/';
								$successcompfile = \File::copy($decodeData->logoFrontLowRes, $destinationPath.$filename);
								$successlowfile = \File::copy($decodeData->logoFrontLowRes, $downfolder.$filename);
								// open an image file
								$thimg = \Image::make($downfolder.$filename);
								// now you are able to resize the instance
								$thimg->resize(128, 130);
								// finally we save the image as a new file
								$thumbfile = 'thumb_'.$filename;
								$thimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
								
								// open an image file
								$mdimg = \Image::make($downfolder.$filename);
								// now you are able to resize the instance
								$mdimg->resize(320, 320);
								// finally we save the image as a new file
								$thumbfile = 'medium_'.$filename;
								$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
								
								// open an image file
								$mdimg = \Image::make($downfolder.$filename);
								// now you are able to resize the instance
								$mdimg->resize(1000, 1000);
								// finally we save the image as a new file
								$thumbfile = 'large_'.$filename;
								$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
								
								$fldata['folder_id'] = $folder->id;
								$fldata['file_name'] = $filename;
								$fldata['file_type'] = 'image/png';
								$fldata['user_id'] = $newuid;
								$fldata['created'] = date('y-m-d h:i:s');
								$fldata['path'] = $downfolder;
								DB::table('tb_container_files')->insert($fldata);
								
								$pdata['company_logo'] = $filename;
							}
						}
						if($decodeData->logoFrontHighRes!='')
						{
							$filename = $newuid.'.eps';
							$downfolder = (new ContainerController)->getContainerUserPath($folder->id);
							if( is_dir($downfolder) === true )
							{
								$successhighfile = \File::copy($decodeData->logoFrontHighRes, $downfolder.$filename);
								$fldata['folder_id'] = $folder->id;
								$fldata['file_name'] = $filename;
								$fldata['file_type'] = 'application/postscript';
								$fldata['user_id'] = $newuid;
								$fldata['created'] = date('y-m-d h:i:s');
								$fldata['path'] = $downfolder;
								DB::table('tb_container_files')->insert($fldata);
							}
						}
					}
					if(!empty($getprofile))
					{
						$pdata['updated'] = date('y-m-d h:i:s');
						DB::table('tb_user_company_details')->where('id', $getprofile->id)->update($pdata);
					}
					else
					{
						$pdata['created'] = date('y-m-d h:i:s');
						DB::table('tb_user_company_details')->insert($pdata);
					}
				}
			}
			return Redirect::to('user/profile');
		}
		else
		{
			return Response::json(['status' => 'error', 'message' => 'Authentication Error']);
		}
	}

}