<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Myusers;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 
use Maatwebsite\Excel\Facades\Excel;


class MyusersController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'myusers';
	static $per_page	= '10';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Myusers();
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'myusers',
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
		$filter = (!is_null($request->input('search')) ? '': '');
		$filter .= " AND tb_users.group_id >= '".\Session::get('gid')."'" ;

		
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
		$pagination->setPath('myusers');
		
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
		return view('myusers.index',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_users'); 
		}

		
		$this->data['id'] = $id;
		return view('myusers.form',$this->data);
	}	

	public function getShow( $id = null)
	{
	
		if($this->access['is_detail'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', Lang::get('core.note_restric'))->with('msgstatus','error');
					
		$row = $this->model->getRow($id);
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('tb_users'); 
		}
		
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		return view('myusers.view',$this->data);	
	}	

	function postSave( Request $request)
	{
		$rules = $this->validateForm();
		$id = $request->input('id');
		if($request->input('id') =='')
		{
			$rules['password'] 				= 'required|between:6,100';
			$rules['password_confirmation'] = 'required|between:6,100';
			$rules['email'] 				= 'required|email|unique:tb_users';
			$rules['username'] 				= 'required|alpha_num||min:2|unique:tb_users';
			
		} else {
			if($request->input('password') !='')
			{
				$rules['password'] 				='required|between:6,100';
				$rules['password_confirmation'] ='required|between:6,100';			
			}
		}
		
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data = $this->validatePost('tb_myusers');

			if($request->input('id') =='')
			{
				$data['password'] = \Hash::make(Input::get('password'));
			} else {
				if(Input::get('password') !='')
				{
					$data['password'] = \Hash::make(Input::get('password'));
				}
			}
			
			$data['commission'] = $request->input('commission');
			$data['currency'] = $request->input('currency');
			if (!is_null($request->file('contracts'))) {
				$usercomm = \DB::table('tb_users')->select('username')->where('id', $id)->first();
				$checkDir = \DB::table('tb_container')->select('id')->where('name', 'dl-contracts')->first();
				if (!empty($checkDir)) {
					$foldVal = trim($usercomm->username);
					if ($foldVal != "") {
						$foldName = trim($foldVal);
						$slug = \SiteHelpers::seoUrl(trim($foldName));
						$dirPath = (new ContainerController)->getContainerUserPath($checkDir->id);

						$checkUsrFold = \DB::table('tb_container')->select('id')->where('name', $slug)->where('parent_id', $checkDir->id)->first();
						if (!empty($checkUsrFold)) {
							$usrFoldId = $checkUsrFold->id;
						} else {
							$newUsrFolder = $this->createNewFolder($foldName, $checkDir->id);
							if ($newUsrFolder !== false) {
								$usrFoldId = $newUsrFolder;
							}
						}

						// SET UPLOAD PATH
						$destinationPath = (new ContainerController)->getContainerUserPath($usrFoldId);
						$file = $request->file('contracts');
						// GET THE FILE EXTENSION
						$extension = $file->getClientOriginalExtension();
						// RENAME THE UPLOAD WITH RANDOM NUMBER
						$fileName = rand(11111111111, 99999999999) . '-' .rand(11111111111, 99999999999) . '.' . $extension;
						$fileNamedis = $file->getClientOriginalName();
						$ftname = explode('.', $fileName);
						$exha = false;

						for ($f = 1; $exha != true; $f++) {
							if (\File::exists($destinationPath . $fileName)) {
								$fileName = $ftname[0] . '(' . $f . ').' . $extension;
							} else {
								$fileName = $fileName;
								$exha = true;
							}
						}
						// MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
						$upload_success = $file->move($destinationPath, $fileName);
						$data['contracts'] = $fileName;
						$ftype = $file->getClientMimeType();
						$exFtype = explode('/', $ftype);
						if ($exFtype[0] == "image") {
							// open an image file
							$thimg = \Image::make($destinationPath . $fileName);
							// now you are able to resize the instance
							$thimg->resize(128, 130);
							// finally we save the image as a new file
							$thumbfile = 'thumb_' . $usrFoldId . '_' . $fileName;
							$thimg->save(public_path() . '/uploads/thumbs/' . $thumbfile);

							// open an image file
							$mdimg = \Image::make($destinationPath . $fileName);
							// now you are able to resize the instance
							$thactualsize = getimagesize($destinationPath . $fileName);
							if ($thactualsize[0] > $thactualsize[1]) {
								$mdimg->resize(320, null, function ($constraint) {
									$constraint->aspectRatio();
								});
							} else {
								$mdimg->resize(null, 320, function ($constraint) {
									$constraint->aspectRatio();
								});
							}
							// finally we save the image as a new file
							$thumbfile = 'format_' . $usrFoldId . '_' . $fileName;
							$mdimg->save(public_path() . '/uploads/thumbs/' . $thumbfile);

							// open an image file
							$mdimg = \Image::make($destinationPath . $fileName);
							// now you are able to resize the instance
							$hfactualsize = getimagesize($destinationPath . $fileName);
							if ($hfactualsize[0] > $hfactualsize[1]) {
								$mdimg->resize(1000, null, function ($constraint) {
									$constraint->aspectRatio();
								});
							} else {
								$mdimg->resize(null, 1000, function ($constraint) {
									$constraint->aspectRatio();
								});
							}
							// finally we save the image as a new file
							$thumbfile = 'highflip_' . $usrFoldId . '_' . $fileName;
							$mdimg->save(public_path() . '/uploads/thumbs/' . $thumbfile);

							// Set main image if uploaded file is first in folder
							$countfile = \DB::table('tb_container_files')->where('folder_id', $usrFoldId)->where(function ($query) {
										$query->where('file_type', 'image/jpeg')->orWhere('file_type', 'image/png')->orWhere('file_type', 'image/gif');
									})->count();
							if ($countfile == 0) {
								$copytofolder = public_path() . '/uploads/folder_cover_imgs/';
								// image for backend
								$bkimg = \Image::make($destinationPath . $fileName);
								$bkimg->resize(128, 130);
								$bkimgfile = 'thumb_' . $fileName;
								$bkimg->save($copytofolder . $bkimgfile);

								// open an image file
								$mdimg = \Image::make($destinationPath . $fileName);
								$thactualsize = getimagesize($destinationPath . $fileName);
								if ($thactualsize[0] > $thactualsize[1]) {
									$mdimg->resize(320, null, function ($constraint) {
										$constraint->aspectRatio();
									});
								} else {
									$mdimg->resize(null, 320, function ($constraint) {
										$constraint->aspectRatio();
									});
								}
								$thumbfile = 'format_' . $fileName;
								$mdimg->save($copytofolder . $thumbfile);

								$cmdata['temp_cover_img'] = $fileName;
								$cmdata['temp_cover_img_masonry'] = $fileName;
								$cmdata['updated'] = date('y-m-d');
								\DB::table('tb_container')->where('id', $usrFoldId)->update($cmdata);
							}
						}

						$mudata['folder_id'] = $usrFoldId;
						$mudata['file_name'] = $fileName;
						$mudata['file_display_name'] = $fileNamedis;
						$mudata['file_type'] = $file->getClientMimeType();
						$mudata['file_size'] = $file->getClientSize();
						$mudata['user_id'] = \Auth::user()->id;
						$mudata['created'] = date('y-m-d h:i:s');
						$mudata['path'] = $destinationPath;
						$fileID = \DB::table('tb_container_files')->insertGetId($mudata);
					}
				}
			}
			$id = $this->model->insertRow($data , $request->input('id'));
			
			if($request->input('id') =='')
			{
				$newlight['box_name'] = 'Lightbox 1';
				$newlight['user_id'] = $id;
				$newlight['created'] = date('Y-m-d h:i:s');
				$light_id = \DB::table('tb_lightbox')->insertGetId($newlight);
			}
			
			if(!is_null($request->input('apply')))
			{
				$return = 'myusers/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'myusers?return='.self::returnUrl();
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

			return Redirect::to('myusers/update/'.$id)->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
			->withErrors($validator)->withInput();
		}	
	
	}	

	public function postDelete( Request $request)
	{
		
		if($this->access['is_remove'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
		// delete multipe rows 
		if(count($request->input('id')) >=1)
		{
			$this->model->destroy($request->input('id'));
			
			\SiteHelpers::auditTrail( $request , "ID : ".implode(",",$request->input('id'))."  , Has Been Removed Successfull");
			// redirect
			return Redirect::to('myusers')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success'); 
	
		} else {
			return Redirect::to('myusers')
        		->with('messagetext','No Item Deleted')->with('msgstatus','error');				
		}

	}
	
	function createNewFolder($Foldername, $ParentfolderId) {
        if ($Foldername != '') {
            $dirPath = (new ContainerController)->getContainerUserPath($ParentfolderId);
            $slug = \SiteHelpers::seoUrl(trim($Foldername));
            $result = \File::makeDirectory($dirPath . $slug, 0777, true);
            $fdata['parent_id'] = $ParentfolderId;
            $fdata['name'] = $slug;
            $fdata['display_name'] = $Foldername;
            $fdata['file_type'] = 'folder';
            $fdata['user_id'] = \Auth::user()->id;
            $fdata['created'] = date('y-m-d h:i:s');
            $fID = \DB::table('tb_container')->insertGetId($fdata);
            return $fID;
        } else {
            return false;
        }
    }

	function importUsersCsv( Request $request)
	{
		$rules['user_csv'] 	= 'required|mimes:csv,xls,xlsx';
		
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			
			try {
				Excel::load(Input::file('user_csv'), function ($reader) {

					foreach ($reader->toArray() as $row) {
						foreach($row as $single)
						{
							if(!empty($single))
							{
								$user['group_id'] = 3;
								if($single['kundennr']!='')
								{
									$user['password'] = \Hash::make($single['kundennr']);
								}
								if($single['email']!='')
								{
									$user['email'] = $single['email'];
								}
								$user['active'] = 1;
								$uid = \DB::table('tb_users')->insertGetId($user);
								
								if($single['email']!='')
								{
									$crm['Email'] = $single['email'];
								}
								$crm['Status'] = 1;
								\DB::table('employee')->insert($crm);
								
								$usercom['user_id'] = $uid;
								if($single['kundennr']!='')
								{
									$usercom['client_id'] = $single['kundennr'];
								}
								if($single['name1']!='')
								{
									$usercom['company_name'] = $single['name1'];
								}
								if($single['name2']!='')
								{
									$usercom['company_owner'] = $single['name2'];
								}
								if($single['strasse']!='')
								{
									$usercom['company_address'] = $single['strasse'];
								}
								if($single['email']!='')
								{
									$usercom['company_email'] = $single['email'];
								}
								if($single['postleitz']!='')
								{
									$usercom['company_postal_code'] = $single['postleitz'];
								}
								if($single['ort']!='')
								{
									$usercom['company_city'] = $single['ort'];
								}
								if($single['telefon']!='')
								{
									$usercom['company_phone'] = $single['telefon'];
								}
								if($single['land']!='')
								{
									$usercom['company_country'] = $single['land'];
								}
								$usercom['created'] = date('Y-m-d h:i:s');
								$usercom['accept_terms'] = 1;
								\DB::table('tb_user_company_details')->insertGetId($usercom);
								
								/*if($single['membership']!='')
								{
									$fetch_member = \DB::table('tb_membership')->where('package_name',$single['membership'])->where('status',1)->first();
									if(!empty($fetch_member))
									{
										$member['user_id'] = $uid;
										$member['membership_id'] = $fetch_member->id;
										$member['created'] = date('Y-m-d h:i:s');
										\DB::table('tb_users_membership')->insert($member);
									}
								}*/
							}
						}
					}
				});
				return Redirect::to('myusers')->with('messagetext','Users uploaded successfully.')->with('msgstatus','success');
			} catch (\Exception $e) {
				return Redirect::to('myusers')->with('messagetext',$e->getMessage())->with('msgstatus','error');
			}
		} else {

			return Redirect::to('myusers')->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
			->withErrors($validator)->withInput();
		}	
	
	}


}