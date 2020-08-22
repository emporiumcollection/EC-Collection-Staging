<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Container;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 
use File;
use DB;
use Zipper;


class ContainerController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'container';
	static $per_page	= '10';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Container();
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'container',
			'return'	=> self::returnUrl()
			
		);
		
	}

	public function getIndex( Request $request, $id = 0, $wnd = '' )
	{
		if($this->access['is_view'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
		$uid = \Auth::user()->id;
		
		$filter = " AND parent_id='".$id."'";
		if(\Auth::user()->group_id==3 && $wnd!='iframe')
		{
			$filter .= " AND (id in (select folder_id from tb_permissions where user_id='".$uid."' and no_permission='0') or global_permission='1')";
		}
		if(\Auth::user()->group_id==2 && $wnd!='iframe')
		{
			//$filter .= " AND (user_id='".$uid."' or (user_id!='".$uid."' and global_permission='1'))";
		}
		$params = array(
			'params'	=> $filter
		);
		// Get Query 
		$results = $this->model->getRows( $params );
		
		$foldername = DB::table('tb_container')->where('id',$id);
		$this->data['foldername'] = $foldername->select('display_name','parent_id','user_id', 'global_permission', 'title', 'description','display_name_eng','title_eng','description_eng')->first();
		
		$this->data['parentArr'] = array_reverse($this->fetchFolderParentListArray($id));

		$filess_temp = DB::table('tb_container_files')->select('id','file_name','folder_id','file_title','file_description','file_display_name','file_sort_num','file_type')->where('folder_id',$id);
		if(\Auth::user()->group_id==2 && (!empty($this->data['foldername'] && $this->data['foldername']->global_permission==0)) && $wnd!='iframe')
		{
			//$filess_temp->where('user_id',$uid);
		}
		$filess = $filess_temp->get();
	
		$ct=0; 
		$this->data['rowData'] = array();
		
		foreach($results['rows'] as $folderObj ){
			if($wnd=='iframe')
			{
				/*$childs = $this->fetchFolderChildListIds(30);
				if($folderObj->id==30 || in_array($folderObj->id,$childs))
				{*/
					$totfiles = DB::table('tb_container_files')->select('id')->where('folder_id',$folderObj->id)->count();
					$totfolders = DB::table('tb_container')->select('id')->where('parent_id',$folderObj->id)->count();
					$this->data['rowData'][$ct]['id'] = $folderObj->id;
					$this->data['rowData'][$ct]['name'] = $folderObj->display_name;
					$this->data['rowData'][$ct]['ftype'] = 'folder';
					$this->data['rowData'][$ct]['imgsrc'] = '';
					$this->data['rowData'][$ct]['foldercount'] = $totfolders;
					$this->data['rowData'][$ct]['filecount'] = $totfiles;
					$this->data['rowData'][$ct]['tiff_files'] = '';
					$this->data['rowData'][$ct]['title'] = $folderObj->title;
					$this->data['rowData'][$ct]['description'] = $folderObj->description;
					$this->data['rowData'][$ct]['file_display_name'] = '';
					$this->data['rowData'][$ct]['cover_img'] = $folderObj->cover_img;
					$this->data['rowData'][$ct]['sort_num'] = $folderObj->sort_num;
					$this->data['rowData'][$ct]['imgpath'] = '';
					$this->data['rowData'][$ct]['hotel_help_update'] = $folderObj->hotel_help_update;
					$ct++;
				//}
			}
			else
			{
				$totfiles = DB::table('tb_container_files')->select('id')->where('folder_id',$folderObj->id)->count();
				$totfolders = DB::table('tb_container')->select('id')->where('parent_id',$folderObj->id)->count();
				$frontend = DB::table('tb_frontend_container')->select('id')->where('container_id',$folderObj->id)->where('container_type','folder')->first();
				$this->data['rowData'][$ct]['id'] = $folderObj->id;
				$this->data['rowData'][$ct]['name'] = $folderObj->display_name;
				$this->data['rowData'][$ct]['ftype'] = 'folder';
				$this->data['rowData'][$ct]['imgsrc'] = '';
				$this->data['rowData'][$ct]['foldercount'] = $totfolders;
				$this->data['rowData'][$ct]['filecount'] = $totfiles;
				$this->data['rowData'][$ct]['tiff_files'] = '';
				$this->data['rowData'][$ct]['title'] = $folderObj->title;
				$this->data['rowData'][$ct]['description'] = $folderObj->description;
				$this->data['rowData'][$ct]['file_display_name'] = '';
				$this->data['rowData'][$ct]['sort_num'] = $folderObj->sort_num;
				$this->data['rowData'][$ct]['assign_front'] = 'no';
				$this->data['rowData'][$ct]['assign_lightbox'] = 'no';
				$this->data['rowData'][$ct]['hotel_help_update'] = $folderObj->hotel_help_update;
				if(!empty($frontend))
				{
					$this->data['rowData'][$ct]['assign_front'] = 'yes';
				}
				
				if($folderObj->cover_img=="" && $folderObj->temp_cover_img=="")
				{
					$default_front_design = \DB::table('tb_settings')->select('content')->where('key_value', 'frontend_design')->first();
					
					// Set main image first image in folder
					$checkfile = DB::table('tb_container_files')->select('file_name')->where('folder_id', $folderObj->id)->where(function ($query) { $query->where('file_type', 'image/jpeg')->orWhere('file_type', 'image/png')->orWhere('file_type', 'image/gif');})->orderBy('file_sort_num', 'asc')->first();
					if(!empty($checkfile))
					{
						$destinationPath = $this->getContainerUserPath($folderObj->id);
						$copytofolder = public_path().'/uploads/folder_cover_imgs/';
						$find_prd=false;
						$this->data['rowData'][$ct]['cover_img'] = '';
						$fileName = $checkfile->file_name;
													
						$find_actualsize = getimagesize($destinationPath.$fileName);
						if($find_actualsize[0]>$find_actualsize[1])
						{
							// image for backend
							if (! \File::exists($copytofolder.'thumb_'.$fileName))
							{
								$bkimg = \Image::make($destinationPath.$fileName);
								$bkimg->resize(128, 130);
								$bkimgfile = 'thumb_'. $fileName;
								$bkimg->save($copytofolder.$bkimgfile);
							}
							
							if (! \File::exists($copytofolder.'format_'.$fileName))
							{
								$mdimg = \Image::make($destinationPath.$fileName);
								$thactualsize = getimagesize($destinationPath.$fileName);
								if($thactualsize[0]>$thactualsize[1])
								{
									$mdimg->resize(320, null, function ($constraint) {
										$constraint->aspectRatio();
									});
								}
								else
								{
									$mdimg->resize(null, 320, function ($constraint) {
										$constraint->aspectRatio();
									});
								}
								$thumbfile = 'format_'.$fileName;
								$mdimg->save($copytofolder.$thumbfile);
							}
							
							$tcmdata['temp_cover_img'] = $fileName;
							$tcmdata['updated'] = date('y-m-d');
							DB::table('tb_container')->where('id', $folderObj->id)->update($tcmdata);
							
							if(!empty($default_front_design) && $default_front_design->content=="grid")
							{
								$this->data['rowData'][$ct]['cover_img'] = $fileName;
							}
							$find_prd=true;
						}
					}
					else{
						$this->data['rowData'][$ct]['cover_img'] = '';
					}
				}
				else
				{
					$this->data['rowData'][$ct]['cover_img'] = ($folderObj->cover_img!='') ? $folderObj->cover_img : $folderObj->temp_cover_img ;
				}
				
				$ct++;
			}
			
		}
		if(!empty($filess))
		{
			$imgsrc = $this->getThumbpath($filess[0]->folder_id);
			$imgpath = $this->getContainerUserPath($filess[0]->folder_id);
			if(\Auth::user()->group_id!=3 || (!empty($this->data['foldername'] && $this->data['foldername']->global_permission==1)) || $wnd=='iframe')
			{
				foreach($filess as $filesObj ){
					$this->data['rowData'][$ct]['id'] = $filesObj->id;
					$this->data['rowData'][$ct]['name'] = $filesObj->file_name;
					$this->data['rowData'][$ct]['ftype'] = 'file';
					$this->data['rowData'][$ct]['imgsrc'] = $imgsrc;
					$this->data['rowData'][$ct]['filecount'] = '';
					$this->data['rowData'][$ct]['foldercount'] = '';
					$this->data['rowData'][$ct]['tiff_files'] = '';
					$this->data['rowData'][$ct]['title'] = $filesObj->file_title;
					$this->data['rowData'][$ct]['description'] = $filesObj->file_description;
					$this->data['rowData'][$ct]['file_display_name'] = $filesObj->file_display_name;
					$this->data['rowData'][$ct]['cover_img'] = '';
					$this->data['rowData'][$ct]['sort_num'] = $filesObj->file_sort_num;
					$this->data['rowData'][$ct]['assign_front'] = 'no';
					$this->data['rowData'][$ct]['imgpath'] = $imgpath;
					$this->data['rowData'][$ct]['assign_lightbox'] = 'no';
					$this->data['rowData'][$ct]['hotel_help_update'] = '';
					
					$frontend_files = DB::table('tb_frontend_container')->select('id')->where('container_id',$filesObj->id)->where('container_type','file')->first();
					if(!empty($frontend_files))
					{
						$this->data['rowData'][$ct]['assign_front'] = 'yes';
					}
					$frontend_lightbox = DB::table('tb_frontend_lightbox')->select('id')->where('container_id',$filesObj->id)->where('container_type','file')->first();
					if(!empty($frontend_lightbox))
					{
						$this->data['rowData'][$ct]['assign_lightbox'] = 'yes';
					}
					
					$exFtype = explode('/',$filesObj->file_type);
					if($exFtype[1]=="tiff")
					{
						$this->data['rowData'][$ct]['tiff_files'] = DB::table('tb_container_tiff_files')->select('id','file_name')->where('file_id', $filesObj->id)->get();
					}
					if($exFtype[0]=="image")
					{
						if (!File::exists(public_path(). '/uploads/thumbs/thumb_'.$filesObj->folder_id.'_'.$filesObj->file_name))
						{
							$mdimg = \Image::make($imgpath.$filesObj->file_name);
							$mdimg->resize(128, 130);
							$thumbfile = 'thumb_'.$filesObj->folder_id.'_'.$filesObj->file_name;
							$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
						}
						
						if (!File::exists(public_path(). '/uploads/thumbs/format_'.$filesObj->folder_id.'_'.$filesObj->file_name))
						{
							$mdimg = \Image::make($imgpath.$filesObj->file_name);
							$actualsize = getimagesize($imgpath.$filesObj->file_name);
							if($actualsize[0]>$actualsize[1])
							{
								$mdimg->resize(320, null, function ($constraint) {
									$constraint->aspectRatio();
								});
							}
							else
							{
								$mdimg->resize(null, 320, function ($constraint) {
									$constraint->aspectRatio();
								});
							}
							$thumbfile = 'format_'.$filesObj->folder_id.'_'.$filesObj->file_name;
							$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
						}
						if (!File::exists(public_path(). '/uploads/thumbs/highflip_'.$filesObj->folder_id.'_'.$filesObj->file_name))
						{
							$mdimg = \Image::make($imgpath.$filesObj->file_name);
							$actualsize = getimagesize($imgpath.$filesObj->file_name);
							if($actualsize[0]>$actualsize[1])
							{
								$mdimg->resize(1000, null, function ($constraint) {
									$constraint->aspectRatio();
								});
							}
							else
							{
								$mdimg->resize(null, 1000, function ($constraint) {
									$constraint->aspectRatio();
								});
							}
							$thumbfile = 'highflip_'.$filesObj->folder_id.'_'.$filesObj->file_name;
							$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
						}
					}
					
					// delete landing_info view
					if( File::exists(public_path() . '/uploads/thumbs/landing_info_'. $filesObj->folder_id.'_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/thumbs/landing_info_'. $filesObj->folder_id.'_'.$filesObj->file_name);
					}
					
					// delete front_slider view
					if( File::exists(public_path() . '/uploads/thumbs/front_slider_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/thumbs/front_slider_'.$filesObj->file_name);
					}
					
					// delete product_detail_list 
					if( File::exists(public_path() . '/uploads/thumbs/product_detail_list_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/thumbs/product_detail_list_'.$filesObj->file_name);
					}
					
					// delete product file
					if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name);
					}
					
					// delete material file
					if( File::exists(public_path() . '/uploads/folder_cover_imgs/material_file_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/folder_cover_imgs/material_file_'.$filesObj->file_name);
					}
					
					// delete masonry_product_file
					if( File::exists(public_path() . '/uploads/folder_cover_imgs/masonry_product_file_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/folder_cover_imgs/masonry_product_file_'.$filesObj->file_name);
					}
					
					// delete product file
					if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name);
					}
					
					// delete folder cover front file
					if( File::exists(public_path() . '/uploads/folder_cover_imgs/front_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/folder_cover_imgs/front_'.$filesObj->file_name);
					}
					
					// delete folder cover product file
					if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/folder_cover_imgs/product_'.$filesObj->file_name);
					}
					
					// delete folder cover masonry_product file
					if( File::exists(public_path() . '/uploads/folder_cover_imgs/masonry_product_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/folder_cover_imgs/masonry_product_'.$filesObj->file_name);
					}
					
					// delete folder cover product_detail_cover file
					if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_detail_cover_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/folder_cover_imgs/product_detail_cover_'.$filesObj->file_name);
					}
					$ct++;
				}
			}
			else{
				$selfiles = DB::table('tb_permissions')->select('view','inherit')->where('folder_id',$id)->where('user_id',$uid)->first();
				if(!empty($selfiles))
				{
					if($selfiles->view==1 || $selfiles->inherit==1)
					{
						foreach($filess as $filesObj ){
							$this->data['rowData'][$ct]['id'] = $filesObj->id;
							$this->data['rowData'][$ct]['name'] = $filesObj->file_name;
							$this->data['rowData'][$ct]['ftype'] = 'file';
							$this->data['rowData'][$ct]['imgsrc'] = $imgsrc;
							$this->data['rowData'][$ct]['filecount'] = '';
							$this->data['rowData'][$ct]['foldercount'] = '';
							$this->data['rowData'][$ct]['tiff_files'] = '';
							$this->data['rowData'][$ct]['title'] = $filesObj->file_title;
							$this->data['rowData'][$ct]['description'] = $filesObj->file_description;
							$this->data['rowData'][$ct]['file_display_name'] = $filesObj->file_display_name;
							$this->data['rowData'][$ct]['cover_img'] = '';
							$this->data['rowData'][$ct]['sort_num'] = $filesObj->file_sort_num;
							$this->data['rowData'][$ct]['hotel_help_update'] = '';
							
							$exFtype = explode('/',$filesObj->file_type);
							if($exFtype[1]=="tiff")
							{
								$this->data['rowData'][$ct]['tiff_files'] = DB::table('tb_container_tiff_files')->select('id','file_name')->where('file_id', $filesObj->id)->get();
							}
							if($exFtype[0]=="image")
							{
								if (!File::exists(public_path(). '/uploads/thumbs/thumb_'.$filesObj->folder_id.'_'.$filesObj->file_name))
								{
									$mdimg = \Image::make($imgpath.$filesObj->file_name);
									$mdimg->resize(128, 130);
									$thumbfile = 'thumb_'.$filesObj->folder_id.'_'.$filesObj->file_name;
									$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
								}
								
								if (!File::exists(public_path(). '/uploads/thumbs/format_'.$filesObj->folder_id.'_'.$filesObj->file_name))
								{
									$mdimg = \Image::make($imgpath.$filesObj->file_name);
									$actualsize = getimagesize($imgpath.$filesObj->file_name);
									if($actualsize[0]>$actualsize[1])
									{
										$mdimg->resize(320, null, function ($constraint) {
											$constraint->aspectRatio();
										});
									}
									else
									{
										$mdimg->resize(null, 320, function ($constraint) {
											$constraint->aspectRatio();
										});
									}
									$thumbfile = 'format_'.$filesObj->folder_id.'_'.$filesObj->file_name;
									$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
								}
								if (!File::exists(public_path(). '/uploads/thumbs/highflip_'.$filesObj->folder_id.'_'.$filesObj->file_name))
								{
									$mdimg = \Image::make($imgpath.$filesObj->file_name);
									$actualsize = getimagesize($imgpath.$filesObj->file_name);
									if($actualsize[0]>$actualsize[1])
									{
										$mdimg->resize(1000, null, function ($constraint) {
											$constraint->aspectRatio();
										});
									}
									else
									{
										$mdimg->resize(null, 1000, function ($constraint) {
											$constraint->aspectRatio();
										});
									}
									$thumbfile = 'highflip_'.$filesObj->folder_id.'_'.$filesObj->file_name;
									$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
								}
							}
							
							// delete landing_info view
							if( File::exists(public_path() . '/uploads/thumbs/landing_info_'. $filesObj->folder_id.'_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/thumbs/landing_info_'. $filesObj->folder_id.'_'.$filesObj->file_name);
							}
							
							// delete front_slider view
							if( File::exists(public_path() . '/uploads/thumbs/front_slider_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/thumbs/front_slider_'.$filesObj->file_name);
							}
							
							// delete product_detail_list 
							if( File::exists(public_path() . '/uploads/thumbs/product_detail_list_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/thumbs/product_detail_list_'.$filesObj->file_name);
							}
							
							// delete product file
							if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name);
							}
							
							// delete material file
							if( File::exists(public_path() . '/uploads/folder_cover_imgs/material_file_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/folder_cover_imgs/material_file_'.$filesObj->file_name);
							}
							
							// delete masonry_product_file
							if( File::exists(public_path() . '/uploads/folder_cover_imgs/masonry_product_file_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/folder_cover_imgs/masonry_product_file_'.$filesObj->file_name);
							}
							
							// delete product file
							if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name);
							}
							
							// delete folder cover front file
							if( File::exists(public_path() . '/uploads/folder_cover_imgs/front_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/folder_cover_imgs/front_'.$filesObj->file_name);
							}
							
							// delete folder cover product file
							if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/folder_cover_imgs/product_'.$filesObj->file_name);
							}
							
							// delete folder cover masonry_product file
							if( File::exists(public_path() . '/uploads/folder_cover_imgs/masonry_product_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/folder_cover_imgs/masonry_product_'.$filesObj->file_name);
							}
							
							// delete folder cover product_detail_cover file
							if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_detail_cover_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/folder_cover_imgs/product_detail_cover_'.$filesObj->file_name);
							}
							$ct++;
						}
					}
				}
			}
		}
        $this->data['check_images'] = true;
		//print "<pre>";
		//print_r($this->data['rowData']);
		if(!empty($this->data['rowData']))
		{
			usort($this->data['rowData'], function($a, $b) {
				return $a['sort_num'] - $b['sort_num']; 
			});
		}
		
				
		if(\Auth::user()->group_id!=3 || $wnd=='iframe')
		{
			$spaceAllowed = \Auth::user()->storage_space;
			if($spaceAllowed==0){ $spaceAllowed = 1; }
			$usedSpaceBytes_temp = DB::table('tb_container_files');
			if(\Auth::user()->group_id==2)
			{
				//$usedSpaceBytes_temp->where('user_id',$uid);
			}
			$usedSpaceBytes = $usedSpaceBytes_temp->sum('file_size');
			$usedSpaceMb = ($usedSpaceBytes/(1000*1000));
			$usedSpace = round($usedSpaceMb,2,PHP_ROUND_HALF_UP);
			$usedSpacePercentage = ($usedSpace*100)/$spaceAllowed;
		}
		
		$subfoldertotal = DB::table('tb_container')->select('id')->where('parent_id',$id);
		if(\Auth::user()->group_id==2 && (!empty($this->data['foldername'] && $this->data['foldername']->global_permission==0)))
		{
			//$subfoldertotal->where('user_id',$uid);
		}
		$this->data['subfoldertotal'] = $subfoldertotal->count();
				
		$subfilestotal = DB::table('tb_container_files')->select('id')->where('folder_id',$id);
		if(\Auth::user()->group_id==2 && (!empty($this->data['foldername'] && $this->data['foldername']->global_permission==0)))
		{
			//$subfilestotal->where('user_id',$uid);
		}
		$this->data['subfilestotal'] = $subfilestotal->count();
		
		$subfileBytes_temp = DB::table('tb_container_files')->where('folder_id',$id);
		if(\Auth::user()->group_id==2 && (!empty($this->data['foldername'] && $this->data['foldername']->global_permission==0)))
		{
			//$subfileBytes_temp->where('user_id',$uid);
		}
		$subfileBytes = $subfileBytes_temp->sum('file_size');
		
		$subfileMb = ($subfileBytes/(1000*1000));
		$this->data['subfileSpace'] = round($subfileMb,2,PHP_ROUND_HALF_UP);
		
		$this->data['users'] = DB::table('tb_users')->select('id','first_name','last_name')->where('group_id',3)->where('active',1)->get();
		$emp = DB::table('employee')->select('Email')->where('Status',1)->get();
		$this->data['crmusers'] = '';
		if(!empty($emp))
		{
			$this->data['crmusers'] = $emp;
		}
		$permiss = array();
		$permission = DB::table('tb_permissions')->where('folder_id',$id)->get();
		foreach($permission as $permit)
		{
			$permiss[$permit->user_id] = $permit;
		}
		
		if(isset($_REQUEST['show']) && trim($_REQUEST['show'])!="")
		{
			$showType = trim($_REQUEST['show']);
		}
		else
		{
			$showType = "thumb";
		}
        
        $pid = '';
        if(isset($_REQUEST['pid']) && trim($_REQUEST['pid'])!="")
		{
			$pid = trim($_REQUEST['pid']);
		}
		
        $this->data['pid'] = $pid;
        
		$this->data['showType'] = $showType;
		$this->data['permissions'] = $permiss;
		//$this->data['tree'] = $this->fetchFolderTreeList('','',$wnd, $showType);
		//$this->data['seloptions'] = $this->fetchFolderTreeOptions();
		$this->data['tree'] = array();
		$this->data['fid'] = $id;
		$this->data['group'] = \Auth::user()->group_id;
		$sel_attributes = DB::table('tb_attributes')->select('attr_type','id','attr_title','attr_cat')->where('attr_status',1);
		if(\Auth::user()->group_id==2 || \Auth::user()->group_id==3)
		{
			$sel_attributes->where('attr_permission',1);
		}
		$this->data['sel_attributes'] = $sel_attributes->get();
		
		$this->data['sel_tags'] = DB::table('tb_tags_manager')->select('id','tag_title')->where('tag_status',1)->get();
		
		$this->data['sel_designer'] = DB::table('tb_designers')->select('id','designer_name')->where('designer_status',1)->get();
		
		$this->data['lightboxes'] = \DB::table('tb_lightbox')->select('id','box_name')->where('user_id', $uid)->get();
		
		$this->data['parent_tags'] = (new TagmanagerController)->fetchTagTree();
		
		$boxcontent = \DB::table('tb_lightbox_content')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_lightbox_content.file_id')->select('tb_lightbox_content.id', 'tb_container_files.file_name', 'tb_container_files.folder_id', 'tb_container_files.file_display_name', 'tb_container_files.file_title','tb_lightbox_content.lightbox_id')->where('tb_lightbox_content.user_id', $uid)->get();
		$boxcont = array();
		if(!empty($boxcontent))
		{
			foreach($boxcontent as $bcontent)
			{
				$boxcont[$bcontent->lightbox_id][] = $bcontent;
			}
		}
		$this->data['lightcontent'] = $boxcont;
		
		if(\Auth::user()->group_id!=3 || $wnd=='iframe')
		{
			$this->data['allowStorage'] = $spaceAllowed;
			$this->data['usedStorage'] = $usedSpace;
			$this->data['usedStoragePerct'] = round($usedSpacePercentage,2,PHP_ROUND_HALF_UP);
		}
		if(\Auth::user()->group_id==3 && $wnd!='iframe')
		{
			$this->data['userpermissions'] = DB::table('tb_permissions')->where('user_id',$uid)->where('folder_id',$id)->first();
			return view('container.user_index',$this->data);
		}
		else
		{
			if($wnd=='iframe')
			{
				return view('container.iframe',$this->data);
			}
			else
			{    
			    $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
                $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.container.index':'container.index';
                
				return view($file_name,$this->data);
			}
		}
	}	
	
	function fetchFolderTreeOptions($parent = 0, $spacing = '', $folder_tree_array = '') {
	 
	  if (!is_array($folder_tree_array))
		$folder_tree_array = array();
		$uid = \Auth::user()->id;
		$filter = " AND parent_id='".$parent."'";
		if(\Auth::user()->group_id==2)
		{
			//$filter .= " AND (user_id='".$uid."' or (user_id!='".$uid."' and global_permission='1'))";
		}
		if(\Auth::user()->group_id==3)
		{
			$filter .= " AND (id in (select folder_id from tb_permissions where user_id='".$uid."' and no_permission='0') or global_permission='1')";
		}
		$params = array(
			'params'	=> $filter,
			'order'		=> 'asc'
		);
		// Get Query 
		$results = $this->model->getRows( $params );
		if ($results) {
		foreach($results['rows'] as $row) {
		  $folder_tree_array[] = array("id" => $row->id, "name" => $spacing . $row->display_name);
		  $folder_tree_array = $this->fetchFolderTreeOptions($row->id, $spacing . '>>>', $folder_tree_array);
		}
	  }
	  return $folder_tree_array;
	}
	
	function fetchFolderTreeList($parent = 0, $user_tree_array = '', $wnd = '', $showType='thumb') {
 
		if (!is_array($user_tree_array))
		$user_tree_array = array();
	
		$uid = \Auth::user()->id;
		$filter = " AND parent_id='".$parent."'";
		if(\Auth::user()->group_id==3  && $wnd!='iframe')
		{
			$filter .= " AND (id in (select folder_id from tb_permissions where user_id='".$uid."' and no_permission='0') or global_permission='1')";
		}
		if(\Auth::user()->group_id==2  && $wnd!='iframe')
		{
			//$filter .= " AND (user_id='".$uid."' or (user_id!='".$uid."' and global_permission='1'))";
		}
		$params = array(
			'params'	=> $filter,
			'order'		=> 'asc'
		);
		// Get Query 
		$results = $this->model->getRows( $params );
		
	  if ($results) {
		 $user_tree_array[] = '<ul class="folders parent'.$parent.'" rel="pr_'.$parent.'">';
		 
		if(!empty($results['rows']))
		{
			usort($results['rows'], function($a, $b) {
				return $a->sort_num - $b->sort_num; 
			});
		}
		
		foreach($results['rows'] as $row) {
			$totfiles_temp = DB::table('tb_container_files')->select('id')->where('folder_id',$row->id);
			if(\Auth::user()->group_id==2 && $wnd!='iframe')
			{
				//$totfiles_temp->where('user_id',$uid);
			}
			$totfiles = $totfiles_temp->count();
			
			$totfolder_temp = DB::table('tb_container')->select('id')->where('parent_id',$row->id);
			if(\Auth::user()->group_id==2 && $wnd!='iframe')
			{
				//$totfolder_temp->where('user_id',$uid);
			}
			$totfolders = $totfolder_temp->count();
			if($wnd=='iframe')
			{
				$url = \URL::to('foldersiframe/'.$row->id.'/iframe');
			}
			else{
				$url = \URL::to('getFolderListAjax/'.$row->id.'?show='.$showType);
			}
			
			$active_cls = '';
			if($parent==$row->id){
				$active_cls = 'class="active"';
			}
			if($wnd=='iframe')
			{
				/*$childs = $this->fetchFolderChildListIds(30);
				if($row->id==30 || in_array($row->id,$childs))
				{*/ 
					$user_tree_array[] = '<li '.$active_cls.'><a href="'.$url.'" data-action="expend-folder-tree-iframe" class="expand" title="" rel="'.$row->id.'"><span>'. $row->display_name.'<span>('.$totfolders.', '.$totfiles.')</span></span></a></li>';
				//}
			}
			else
			{
				$user_tree_array[] = '<li '.$active_cls.'><a href="'.$url.'" class="expand" title="" data-action="expend-folder-tree" rel="'.$row->id.'"><span>'. $row->display_name.'<span>('.$totfolders.', '.$totfiles.')</span></span></a></li>';
			}
		 // $user_tree_array = $this->fetchFolderTreeList($row->id, $user_tree_array, $wnd, $showType);
		}
	$user_tree_array[] = "</ul>";
	  }
	  return $user_tree_array;
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
				
		$this->data['access']		= $this->access;
		return view('container.form',$this->data);
	}	

	public function getShow( $id = null)
	{
	
		if($this->access['is_detail'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', Lang::get('core.note_restric'))->with('msgstatus','error');
					
		
		$this->data['access']		= $this->access;
		return view('container.view',$this->data);	
	}	

	function postSave( Request $request)
	{
		
	
	}	

	public function postDelete( Request $request)
	{
		
		if($this->access['is_remove'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
		
	}

	public function createfolder(Request $request)
	{
		if(\Auth::check() == true)
        {
			$foldVal = trim(Input::get('folder'));
			if($foldVal!="")
			{
				$exp_fold = explode(',',$foldVal);
				foreach($exp_fold as $folds)
				{
					$foldName = trim($folds);
					$slug = \SiteHelpers::seoUrl( trim($foldName));
					$dirPath = $this->getContainerUserPath(Input::get('fold_id'));
					if($foldName!="")
					{
						$exha = false;
						for($f=1;$exha!=true;$f++)
						{
							if (is_dir($dirPath.$slug) === true)
							{
								$slug = $slug.'('.$f.')';
							}
							else
							{
								$slug = $slug;
								$exha = true;
							}
						}
						if( is_dir($dirPath.$slug) === false )
						{
							$result = File::makeDirectory($dirPath.$slug, 0777, true);
							$data['parent_id'] = Input::get('fold_id');
							$data['name'] = $slug;
							$data['display_name'] = $foldName;
							$data['file_type'] = 'folder';
							if(\Auth::user()->group_id!=3)
							{
								$data['user_id'] = \Auth::user()->id;
							}
							else
							{
								$data['child_id'] = \Auth::user()->id;
								$data['user_id'] = Input::get('administrator_id');
							}
							$data['created'] = date('y-m-d h:i:s');
							$fldid = $this->model->insertRow($data , Input::get('id'));
							if(\Auth::user()->group_id==3)
							{
								$pdata['user_id'] = \Auth::user()->id;
								$pdata['folder_id'] = $fldid;
								$pdata['inherit'] = 0;
								$pdata['no_permission'] = 0;
								$pdata['view'] = 1;
								$pdata['download'] = 1;
								$pdata['upload'] = 1;
								$pdata['delete'] = 1;
								$pdata['created'] = date('y-m-d h:i:s');
								\DB::table('tb_permissions')->insert($pdata);
							}
							
						}
					}
				}
				return Redirect::to(Input::get('curnurl'))->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
			}
			else
			{
				return Redirect::to(Input::get('curnurl'))->with('messagetext','Enter Folder Name.')->with('msgstatus','error');
			}
		}
		else
		{
			return Redirect::to('user/login');
		}
	}
	
	public function editfolder(Request $request)
	{
		if(\Auth::check() == true)
        {
			$foldName = trim(Input::get('editfolder'));
			$oldfoldName = Input::get('oldfolder');
			$foldTitle = htmlentities(Input::get('folder_title'));
			$foldDesc = htmlentities(Input::get('folder_desc'));
			$editfolder_eng = htmlentities(Input::get('editfolder_eng'));
			$folder_title_eng = htmlentities(Input::get('folder_title_eng'));
			$folder_desc_eng = htmlentities(Input::get('folder_desc_eng'));
			$dirPath = rtrim($this->getContainerUserPath(Input::get('fold_id')));
			if( is_dir($dirPath) === true )
			{
				//$fld = DB::table('tb_container')->where('id', Input::get('fold_id'))->first();
				//$parentdirPath = $this->getContainerUserPath($fld->parent_id);
				//$result = File::makeDirectory($dirPath.$foldName, 0777, true);
				//rename($dirPath, $parentdirPath.$foldName);
				$data['display_name'] = $foldName;
				$data['title'] = $foldTitle;
				$data['description'] = $foldDesc;
				$data['display_name_eng'] = $editfolder_eng;
				$data['title_eng'] = $folder_title_eng;
				$data['description_eng'] = $folder_desc_eng;
				$data['updated'] = date('y-m-d h:i:s');
				
				DB::table('tb_container')->where('id', Input::get('fold_id'))->update($data);
				
				return Redirect::to(Input::get('curnurl'))->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
			}
			else
			{
				return Redirect::to(Input::get('curnurl'))->with('messagetext','Folder not found.')->with('msgstatus','error');
			}
		}
		else
		{
			return Redirect::to('user/login');
		}
	}
	
	public function folderdelete()
	{
		$uid = \Auth::user()->id;
		$items = Input::get('fold_id');
		if($items!='')
		{
			$childs = $this->fetchFolderChildListIds(Input::get('fold_id'));
			$dirPath = $this->getContainerUserPath(Input::get('fold_id'));

			if( is_dir($dirPath) === true )
			{
				$fld = DB::table('tb_container')->where('id', Input::get('fold_id'))->first();
				array_unshift($childs, Input::get('fold_id'));
				$deleteEfiles = $this->delete_allextra_files($childs,'folder');
				
				File::deleteDirectory($dirPath);
				//DB::table('tb_container')->where('id', Input::get('fold_id'))->delete();
				DB::table('tb_container')->whereIn('id', $childs)->delete();
				//DB::table('tb_container_files')->where('folder_id', Input::get('fold_id'))->delete();
				DB::table('tb_container_files')->whereIn('folder_id', $childs)->delete();
				
				if($fld->parent_id>0)
				{
					return Redirect::to('folders/'.$fld->parent_id)->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
				}
				else
				{
					return Redirect::to('container')->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
				}
			}
			else
			{
				return Redirect::to(Input::get('curnurl'))->with('messagetext','Folder not exist.')->with('msgstatus','error');
			}
		}
		else
		{
			return Redirect::to(Input::get('curnurl'))->with('messagetext','Folder not found.')->with('msgstatus','error');
		}
	}
	
	public function delete_allextra_files($childs, $type='')
	{
		if($type=="folder"){
			$fetc_fold_files = DB::table('tb_container_files')->whereIn('folder_id', $childs)->get();
		}
		elseif($type=="file")
		{
			$fetc_fold_files = DB::table('tb_container_files')->where('id', $childs)->get();
		}
		if(!empty($fetc_fold_files))
		{
			foreach($fetc_fold_files as $filedt)
			{
				// delete thumb
				if( File::exists(public_path() . '/uploads/thumbs/thumb_'. $filedt->folder_id.'_'.$filedt->file_name))
				{
					File::delete(public_path() . '/uploads/thumbs/thumb_'. $filedt->folder_id.'_'.$filedt->file_name);
				}
				
				// delete format hover image
				if( File::exists(public_path() . '/uploads/thumbs/format_'. $filedt->folder_id.'_'.$filedt->file_name))
				{
					File::delete(public_path() . '/uploads/thumbs/format_'. $filedt->folder_id.'_'.$filedt->file_name);
				}
				
				// delete flipbook view
				if( File::exists(public_path() . '/uploads/thumbs/highflip_'. $filedt->folder_id.'_'.$filedt->file_name))
				{
					File::delete(public_path() . '/uploads/thumbs/highflip_'. $filedt->folder_id.'_'.$filedt->file_name);
				}
				
				// delete landing_info view
				if( File::exists(public_path() . '/uploads/thumbs/landing_info_'. $filedt->folder_id.'_'.$filedt->file_name))
				{
					File::delete(public_path() . '/uploads/thumbs/landing_info_'. $filedt->folder_id.'_'.$filedt->file_name);
				}
				
				// delete front_slider view
				if( File::exists(public_path() . '/uploads/thumbs/front_slider_'.$filedt->file_name))
				{
					File::delete(public_path() . '/uploads/thumbs/front_slider_'.$filedt->file_name);
				}
				
				// delete product_detail_list 
				if( File::exists(public_path() . '/uploads/thumbs/product_detail_list_'.$filedt->file_name))
				{
					File::delete(public_path() . '/uploads/thumbs/product_detail_list_'.$filedt->file_name);
				}
				
				// delete product file
				if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filedt->file_name))
				{
					File::delete(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filedt->file_name);
				}
				
				// delete material file
				if( File::exists(public_path() . '/uploads/folder_cover_imgs/material_file_'.$filedt->file_name))
				{
					File::delete(public_path() . '/uploads/folder_cover_imgs/material_file_'.$filedt->file_name);
				}
				
				// delete masonry_product_file
				if( File::exists(public_path() . '/uploads/folder_cover_imgs/masonry_product_file_'.$filedt->file_name))
				{
					File::delete(public_path() . '/uploads/folder_cover_imgs/masonry_product_file_'.$filedt->file_name);
				}
				
				// delete product file
				if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filedt->file_name))
				{
					File::delete(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filedt->file_name);
				}
				
				// delete folder cover thumb file
				if( File::exists(public_path() . '/uploads/folder_cover_imgs/thumb_'.$filedt->file_name))
				{
					File::delete(public_path() . '/uploads/folder_cover_imgs/thumb_'.$filedt->file_name);
				}
				
				// delete folder cover hover file
				if( File::exists(public_path() . '/uploads/folder_cover_imgs/format_'.$filedt->file_name))
				{
					File::delete(public_path() . '/uploads/folder_cover_imgs/format_'.$filedt->file_name);
				}
				
				// delete folder cover front file
				if( File::exists(public_path() . '/uploads/folder_cover_imgs/front_'.$filedt->file_name))
				{
					File::delete(public_path() . '/uploads/folder_cover_imgs/front_'.$filedt->file_name);
				}
				
				// delete folder cover product file
				if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_'.$filedt->file_name))
				{
					File::delete(public_path() . '/uploads/folder_cover_imgs/product_'.$filedt->file_name);
				}
				
				// delete folder cover masonry_product file
				if( File::exists(public_path() . '/uploads/folder_cover_imgs/masonry_product_'.$filedt->file_name))
				{
					File::delete(public_path() . '/uploads/folder_cover_imgs/masonry_product_'.$filedt->file_name);
				}
				
				// delete folder cover product_detail_cover file
				if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_detail_cover_'.$filedt->file_name))
				{
					File::delete(public_path() . '/uploads/folder_cover_imgs/product_detail_cover_'.$filedt->file_name);
				}
				
				// delete property file
				if( File::exists(public_path() . '/uploads/property_imgs_thumbs/'.$filedt->file_name))
				{
					File::delete(public_path() . '/uploads/property_imgs_thumbs/'.$filedt->file_name);
				}
				
				// delete property front file
				if( File::exists(public_path() . '/uploads/property_imgs_thumbs/front_property_'.$filedt->folder_id.'_'.$filedt->file_name))
				{
					File::delete(public_path() . '/uploads/property_imgs_thumbs/front_property_'.$filedt->folder_id.'_'.$filedt->file_name);
				}
				
				// delete property large front file
				if( File::exists(public_path() . '/uploads/property_imgs_thumbs/front_property_large_'.$filedt->folder_id.'_'.$filedt->file_name))
				{
					File::delete(public_path() . '/uploads/property_imgs_thumbs/front_property_large_'.$filedt->folder_id.'_'.$filedt->file_name);
				}
			}
		}
	}

	function fetchFolderParentList($id = 0, $parent_folders_array = '') {
 
		if (!is_array($parent_folders_array))
		$parent_folders_array = array();
	
		$filter = " AND id='".$id."'";
		
		$params = array(
			'params'	=> $filter,
			'order'		=> 'asc'
		);
		// Get Query 
		$results = $this->model->getRows( $params );
	  if ($results) {
		foreach($results['rows'] as $row) {
			$parent_folders_array[] = $row->name;
			$parent_folders_array = $this->fetchFolderParentList($row->parent_id, $parent_folders_array);
		}
	  }
	  return $parent_folders_array;
	}

	function fetchFolderParentListIds($id = 0, $parent_folders_array = '') {
 
		if (!is_array($parent_folders_array))
		$parent_folders_array = array();
	
		$uid = \Auth::user()->id;
		$filter = " AND id='".$id."'";
		if(\Auth::user()->group_id==2)
		{
			$filter .= " AND (user_id='".$uid."' or (user_id!='".$uid."' and global_permission='1'))";
		}
		$params = array(
			'params'	=> $filter,
			'order'		=> 'asc'
		);
		// Get Query 
		$results = $this->model->getRows( $params );
	  if ($results) {
		foreach($results['rows'] as $row) {
			$parent_folders_array[] = $row->id;
			$parent_folders_array = $this->fetchFolderParentListIds($row->parent_id, $parent_folders_array);
		}
	  }
	  return $parent_folders_array;
	}	
	
	public function uploadFile(Request $request)
	{
		if(\Auth::check() == true)
        {
			$input = Input::all();
			$dirPath = $this->getContainerUserPath(Input::get('fold_id'));
			/*if( is_dir($dirPath) === true )
			{*/
				$file = Input::file('file');
			   // SET UPLOAD PATH
				$destinationPath = $dirPath;
				// GET THE FILE EXTENSION
				$extension = $file->getClientOriginalExtension();
				// RENAME THE UPLOAD WITH RANDOM NUMBER
				//$fileName = rand(11111, 99999) . '.' . $extension;
				$fileName = $file->getClientOriginalName();
				$ftname = explode('.',$fileName);
				$exha = false;
				
				for($f=1;$exha!=true;$f++)
				{
					if (File::exists($destinationPath.$fileName))
					{
						$fileName = $ftname[0].'('.$f.').'.$extension;
					}
					else
					{
						$fileName = $fileName;
						$exha = true;
					}
				}
				// MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
				$upload_success = $file->move($destinationPath, $fileName);
				$ftype = Input::file('file')->getClientMimeType();
				$exFtype = explode('/',$ftype);
				if($exFtype[0]=="image")
				{
					// open an image file
					$thimg = \Image::make($destinationPath.$fileName);
					// now you are able to resize the instance
					$thimg->resize(128, 130);
					// finally we save the image as a new file
					$thumbfile = 'thumb_'. Input::get('fold_id') .'_'.$fileName;
					$thimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
					
					// open an image file
					$mdimg = \Image::make($destinationPath.$fileName);
					// now you are able to resize the instance
					$thactualsize = getimagesize($destinationPath.$fileName);
					if($thactualsize[0]>$thactualsize[1])
					{
						$mdimg->resize(320, null, function ($constraint) {
							$constraint->aspectRatio();
						});
					}
					else
					{
						$mdimg->resize(null, 320, function ($constraint) {
							$constraint->aspectRatio();
						});
					}
					// finally we save the image as a new file
					$thumbfile = 'format_'. Input::get('fold_id') .'_'.$fileName;
					$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
					
					// open an image file
					$mdimg = \Image::make($destinationPath.$fileName);
					// now you are able to resize the instance
					$hfactualsize = getimagesize($destinationPath.$fileName);
					if($hfactualsize[0]>$hfactualsize[1])
					{
						$mdimg->resize(1000, null, function ($constraint) {
							$constraint->aspectRatio();
						});
					}
					else
					{
						$mdimg->resize(null, 1000, function ($constraint) {
							$constraint->aspectRatio();
						});
					}
					// finally we save the image as a new file
					$thumbfile = 'highflip_'. Input::get('fold_id') .'_'.$fileName;
					$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
					
					// Set main image if uploaded file is first in folder
					$countfile = DB::table('tb_container_files')->where('folder_id', Input::get('fold_id'))->where(function ($query) { $query->where('file_type', 'image/jpeg')->orWhere('file_type', 'image/png')->orWhere('file_type', 'image/gif');})->count();
					if($countfile==0)
					{
						$copytofolder = public_path().'/uploads/folder_cover_imgs/';
						// image for backend
						$bkimg = \Image::make($destinationPath.$fileName);
						$bkimg->resize(128, 130);
						$bkimgfile = 'thumb_'. $fileName;
						$bkimg->save($copytofolder.$bkimgfile);
						
						// open an image file
						$mdimg = \Image::make($destinationPath.$fileName);
						$thactualsize = getimagesize($destinationPath.$fileName);
						if($thactualsize[0]>$thactualsize[1])
						{
							$mdimg->resize(320, null, function ($constraint) {
								$constraint->aspectRatio();
							});
						}
						else
						{
							$mdimg->resize(null, 320, function ($constraint) {
								$constraint->aspectRatio();
							});
						}
						$thumbfile = 'format_'.$fileName;
						$mdimg->save($copytofolder.$thumbfile);
						
						$cmdata['temp_cover_img'] = $fileName;
						$cmdata['temp_cover_img_masonry'] = $fileName;
						$cmdata['updated'] = date('y-m-d');
						DB::table('tb_container')->where('id', Input::get('fold_id'))->update($cmdata);
					}
				}
				
				$data['folder_id'] = Input::get('fold_id');
				$data['file_name'] = $fileName;
				$data['file_type'] = Input::file('file')->getClientMimeType();
				$data['file_size'] = Input::file('file')->getClientSize();
				if(\Auth::user()->group_id!=3)
				{
					$data['user_id'] = \Auth::user()->id;
				}
				else
				{
					$data['child_id'] = \Auth::user()->id;
					$data['user_id'] = Input::get('administrator_id');
				}
				$data['created'] = date('y-m-d h:i:s');
				$data['path'] = $destinationPath;
				$fileID = $this->model->insertRowFile($data);
				
				if($extension=='tif' || $extension=='cad')
				{
					$newtfname = $destinationPath.$fileName;
					$typArr = array('jpg','png');
					foreach($typArr as $imgtype)
					{
						$fileName = $ftname[0].'.'.$imgtype;
						$exha = false;
						for($f=1;$exha!=true;$f++)
						{
							if (File::exists($destinationPath.$fileName))
							{
								$fileName = $ftname[0].'('.$f.').'.$imgtype;
							}
							else
							{
								$fileName = $fileName;
								$exha = true;
							}
						}
						\Image::make($newtfname)->encode($imgtype, 100)->save($destinationPath.$fileName);
						
						$data['folder_id'] = Input::get('fold_id');
						$data['file_id'] = $fileID;
						$data['file_name'] = $fileName;
						if($imgtype=='jpg')
						{
							$data['file_type'] = 'image/jpeg';
						}
						else
						{
							$data['file_type'] = 'image/png';
						}
						
						$data['file_size'] = Input::file('file')->getClientSize();
						if(\Auth::user()->group_id!=3)
						{
							$data['user_id'] = \Auth::user()->id;
						}
						else
						{
							$data['child_id'] = \Auth::user()->id;
							$data['user_id'] = Input::get('administrator_id');
						}
						$data['created'] = date('y-m-d h:i:s');
						$data['path'] = $destinationPath;
						\DB::table('tb_container_tiff_files')->insert($data);
					}
					
				}
				
				return "success";
				//return Redirect::to(Input::get('curnurl'))->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
			/*}
			else
			{
				return "notfound";
				//return Redirect::to(Input::get('curnurl'))->with('messagetext','Folder not found.')->with('msgstatus','error');
			}*/
		}
		else
		{
			return "login";
			//return Redirect::to('user/login');
		}
	}
	
	function getThumbpath($id)
	{
		$fpath = \URL::to('uploads/container_user_files').'/';
		//echo $fpath; die;
		$folds = array_reverse($this->fetchFolderParentList($id));
		if(!empty($folds))
		{
			foreach($folds as $fold)
			{
				$fpath .= $fold.'/';
			}
		}
		return $fpath;
	}
	
	function getContainerUserPath($id)
	{
		$publicpath = public_path();
		$fpath = '';
		$folds = array_reverse($this->fetchFolderParentList($id));
		if(!empty($folds))
		{
			foreach($folds as $fold)
			{
				$fpath .= $fold.'/';
			}
		}
		$actPath = $publicpath.'/uploads/container_user_files/'.$fpath;
		return $actPath;
	}
	
	function fetchFolderChildListIds($id = 0, $child_folders_array = '') {
 
		if (!is_array($child_folders_array))
		$child_folders_array = array();
		$uid = \Auth::user()->id;
		$filter = " AND parent_id='".$id."'";
		if(\Auth::user()->group_id==2)
		{
			$filter .= " AND (user_id='".$uid."' or (user_id!='".$uid."' and global_permission='1'))";
		}
		$params = array(
			'params'	=> $filter,
			'order'		=> 'asc'
		);
		// Get Query 
		$results = $this->model->getRows( $params );
	  if ($results) {
		foreach($results['rows'] as $row) {
			$child_folders_array[] = $row->id;
			$child_folders_array = $this->fetchFolderChildListIds($row->id, $child_folders_array);
		}
	  }
	  return $child_folders_array;
	}
	
	function deleteFilesFolders()
	{
		$uid = \Auth::user()->id;
		$items = Input::get('selecteditems');
		if($items!='')
		{
			$comsep = explode(',',$items);
			foreach($comsep as $sepr)
			{
				$undsep = explode('-',$sepr);
				if($undsep[0]=='folder')
				{
					$childs = $this->fetchFolderChildListIds($undsep[1]);
					$dirPath = $this->getContainerUserPath($undsep[1]);

					if( is_dir($dirPath) === true )
					{
						array_unshift($childs, $undsep[1]);
						$deleteEfiles = $this->delete_allextra_files($childs,'folder');
						
						File::deleteDirectory($dirPath);
						//DB::table('tb_container')->where('id', $undsep[1])->delete();
						DB::table('tb_container')->whereIn('id', $childs)->delete();
						//DB::table('tb_container_files')->where('folder_id', $undsep[1])->delete();
						DB::table('tb_container_files')->whereIn('folder_id', $childs)->delete();
						DB::table('tb_container_tiff_files')->where('folder_id', $undsep[1])->delete();
						
					}
				}
				if($undsep[0]=='file')
				{
					$file = DB::table('tb_container_files')->where('id', $undsep[1])->first();
					$dirPath = $this->getContainerUserPath($file->folder_id);
					$deleteEfiles = $this->delete_allextra_files($undsep[1],'file');
					
					DB::table('tb_container_files')->where('id', $undsep[1])->delete();
					if($file->file_type=="image/tiff")
					{
						$tiff_file = DB::table('tb_container_tiff_files')->where('file_id', $undsep[1])->get();
						if(!empty($tiff_file))
						{
							foreach($tiff_file as $tif)
							{
								DB::table('tb_container_tiff_files')->where('id', $tif->id)->delete();
								File::delete($dirPath.$tif->file_name);
							}
						}
					}
					
					File::delete($dirPath.$file->file_name);
					//File::delete(public_path().'/uploads/thumbs/thumb_'.$file->file_name);
					//File::delete(public_path().'/uploads/thumbs/medium_'.$file->file_name);
				}
			}
			return Redirect::to(Input::get('curnurl'))->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
		}
		else
		{
			return Redirect::to(Input::get('curnurl'))->with('messagetext','Please Select Folders/Files First.')->with('msgstatus','error');
		}
	}
	
	function copyFilesFolders()
	{
		$uid = \Auth::user()->id;
		$items = Input::get('selecteditems');
		if($items!='')
		{
			$comsep = explode(',',$items);
			foreach($comsep as $sepr)
			{
				$undsep = explode('-',$sepr);
				if($undsep[0]=='folder')
				{
					$selfolder = $this->getContainerUserPath($undsep[1]);
					$copytofolder = $this->getContainerUserPath(Input::get('copy_to'));
					
					$childList = $this->fetchFolderChildListIds($undsep[1]);
					if (in_array(Input::get('copy_to'), $childList)) {
						return Redirect::to(Input::get('curnurl'))->with('messagetext','You cannot move the folder into itself.')->with('msgstatus','error');
					}
					else
					{
						if( is_dir($selfolder) === true )
						{
							$selectfolder = DB::table('tb_container')->where('id', $undsep[1])->first();
							$successfolder = File::copyDirectory($selfolder, $copytofolder.$selectfolder->name);
							if($successfolder)
							{
								array_unshift($childList, $undsep[1]);
								$newfold = Input::get('copy_to');
								foreach($childList as $child_list)
								{
									$folder = DB::table('tb_container')->where('id', $child_list)->first();
									$data['parent_id'] = $newfold;
									$data['name'] = $folder->name;
									$data['display_name'] = $folder->display_name;
									$data['file_type'] = 'folder';
									if(\Auth::user()->group_id!=3)
									{
										$data['user_id'] = \Auth::user()->id;
									}
									else
									{
										$data['child_id'] = \Auth::user()->id;
										$data['user_id'] = Input::get('administrator_id');
									}
									$data['created'] = date('y-m-d h:i:s');
									$newfold = $this->model->insertRow($data , Input::get('id'));
									$file_oldfolder = DB::table('tb_container_files')->where('folder_id', $child_list)->get();
									if(!empty($file_oldfolder))
									{
										foreach ($file_oldfolder as $oldfile)
										{
											$fdata['folder_id'] = $newfold;
											$fdata['file_name'] = $oldfile->file_name;
											$fdata['file_type'] = $oldfile->file_type;
											$fdata['file_size'] = $oldfile->file_size;
											if(\Auth::user()->group_id!=3)
											{
												$fdata['user_id'] = \Auth::user()->id;
											}
											else
											{
												$fdata['child_id'] = \Auth::user()->id;
												$fdata['user_id'] = Input::get('administrator_id');
											}
											$fdata['created'] = date('y-m-d h:i:s');
											$fdata['path'] = $copytofolder;
											$fileID = $this->model->insertRowFile($fdata);
											
											if($oldfile->file_type=="image/tiff")
											{
												$file_oldtiff = DB::table('tb_container_tiff_files')->where('file_id', $oldfile->id)->get();
												if(!empty($file_oldtiff))
												{
													foreach ($file_oldtiff as $oldtifffile)
													{
														$tfdata['folder_id'] = $newfold;
														$tfdata['file_id'] = $fileID;
														$tfdata['file_name'] = $oldtifffile->file_name;
														$tfdata['file_type'] = $oldtifffile->file_type;
														$tfdata['file_size'] = $oldtifffile->file_size;
														if(\Auth::user()->group_id!=3)
														{
															$tfdata['user_id'] = \Auth::user()->id;
														}
														else
														{
															$tfdata['child_id'] = \Auth::user()->id;
															$tfdata['user_id'] = Input::get('administrator_id');
														}
														$tfdata['created'] = date('y-m-d h:i:s');
														$tfdata['path'] = $copytofolder;
														\DB::table('tb_container_tiff_files')->insert($tfdata);
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
				if($undsep[0]=='file')
				{
					$file = DB::table('tb_container_files')->where('id', $undsep[1])->first();
					$dirPath = $this->getContainerUserPath($file->folder_id);
					$copytofolder = $this->getContainerUserPath(Input::get('copy_to'));
					if( is_dir($copytofolder) === true )
					{
						$successfile = File::copy($dirPath.$file->file_name, $copytofolder.$file->file_name);
						if($successfile)
						{
							$data['folder_id'] = Input::get('copy_to');
							$data['file_name'] = $file->file_name;
							$data['file_type'] = $file->file_type;
							$data['file_size'] = $file->file_size;
							if(\Auth::user()->group_id!=3)
							{
								$data['user_id'] = \Auth::user()->id;
							}
							else
							{
								$data['child_id'] = \Auth::user()->id;
								$data['user_id'] = Input::get('administrator_id');
							}
							$data['created'] = date('y-m-d h:i:s');
							$data['path'] = $copytofolder;
							$fileID = $this->model->insertRowFile($data);
							
							if($file->file_type=="image/tiff")
							{
								$file_oldtiff = DB::table('tb_container_tiff_files')->where('file_id', $oldfile->id)->get();
								if(!empty($file_oldtiff))
								{
									foreach ($file_oldtiff as $oldtifffile)
									{
										$tfdata['folder_id'] = Input::get('copy_to');
										$tfdata['file_id'] = $fileID;
										$tfdata['file_name'] = $oldtifffile->file_name;
										$tfdata['file_type'] = $oldtifffile->file_type;
										$tfdata['file_size'] = $oldtifffile->file_size;
										if(\Auth::user()->group_id!=3)
										{
											$tfdata['user_id'] = \Auth::user()->id;
										}
										else
										{
											$tfdata['child_id'] = \Auth::user()->id;
											$tfdata['user_id'] = Input::get('administrator_id');
										}
										$tfdata['created'] = date('y-m-d h:i:s');
										$tfdata['path'] = $copytofolder;
										\DB::table('tb_container_tiff_files')->insert($tfdata);
									}
								}
							}
						}
					}
				}
			}
			return Redirect::to(Input::get('curnurl'))->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
		}
		else
		{
			return Redirect::to(Input::get('curnurl'))->with('messagetext','Please Select Folders/Files First.')->with('msgstatus','error');
		}
	}
	
	
	function moveFilesFolders()
	{
		$uid = \Auth::user()->id;
		$items = Input::get('selecteditems');
		if($items!='')
		{
			$comsep = explode(',',$items);
			foreach($comsep as $sepr)
			{
				$undsep = explode('-',$sepr);
				if($undsep[0]=='folder')
				{
					$selfolder = $this->getContainerUserPath($undsep[1]);
					$movetofolder = $this->getContainerUserPath(Input::get('move_to'));
					
					$childList = $this->fetchFolderChildListIds($undsep[1]);
					if (in_array(Input::get('move_to'), $childList)) {
						return Redirect::to(Input::get('curnurl'))->with('messagetext','You cannot move the folder into itself.')->with('msgstatus','error');
					}
					else
					{
						if( is_dir($selfolder) === true )
						{
							$selectfolder = DB::table('tb_container')->where('id', $undsep[1])->first();
							$successcopyfolder = File::copyDirectory($selfolder, $movetofolder.$selectfolder->name);
							$successdeletefolder = File::deleteDirectory($selfolder);
							if($successdeletefolder)
							{
								DB::table('tb_container')->where('id', $undsep[1])->update(['parent_id' => Input::get('move_to')]);
							}
						}
					}
				}
				if($undsep[0]=='file')
				{
					$file = DB::table('tb_container_files')->where('id', $undsep[1])->first();
					$dirPath = $this->getContainerUserPath($file->folder_id);
					$movetofolder = $this->getContainerUserPath(Input::get('move_to'));
					if( is_dir($movetofolder) === true )
					{
						$successfile = File::move($dirPath.$file->file_name, $movetofolder.$file->file_name);
						if($successfile)
						{
							DB::table('tb_container_files')->where('id', $undsep[1])->update(['folder_id' => Input::get('move_to'), 'path' => $movetofolder]);
							if($file->file_type=="image/tiff")
							{
								DB::table('tb_container_tiff_files')->where('file_id', $undsep[1])->update(['folder_id' => Input::get('move_to')]);
							}
						}
					}
				}
			}
			return Redirect::to(Input::get('curnurl'))->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
		}
		else
		{
			return Redirect::to(Input::get('curnurl'))->with('messagetext','Please Select Folders/Files First.')->with('msgstatus','error');
		}
	}
	
	public function Showfiles( $fid = 0, $id = 0)
	{
		$uid = \Auth::user()->id;
		if($this->access['is_detail'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
					
		
		$file_temp = DB::table('tb_container_files')->join('tb_container', 'tb_container.id', '=', 'tb_container_files.folder_id')->join('tb_users', 'tb_users.id', '=', 'tb_container_files.user_id')->select('tb_users.first_name', 'tb_users.last_name', 'tb_container_files.*', 'tb_container.display_name as folderName')->where('tb_container_files.id', $id);
		
		$file = $file_temp->first();
		
		$spaceAllowed = \Auth::user()->storage_space;
		if($spaceAllowed==0){ $spaceAllowed = 1; }
		$usedSpaceBytes_temp = DB::table('tb_container_files');
		if(\Auth::user()->group_id==2)
		{
			$usedSpaceBytes_temp->where('user_id',$uid);
		}
		$usedSpaceBytes = $usedSpaceBytes_temp->sum('file_size');
		if(\Auth::user()->group_id!=3)
		{
			$usedSpaceMb = ($usedSpaceBytes/(1000*1000));
			$usedSpace = round($usedSpaceMb,2,PHP_ROUND_HALF_UP);
			$usedSpacePercentage = ($usedSpace*100)/$spaceAllowed;
			$this->data['allowStorage'] = $spaceAllowed;
			$this->data['usedStorage'] = $usedSpace;
			$this->data['usedStoragePerct'] = round($usedSpacePercentage,2,PHP_ROUND_HALF_UP);
		}
		
		if(isset($_REQUEST['show']) && trim($_REQUEST['show'])!="")
		{
			$showType = trim($_REQUEST['show']);
		}
		else
		{
			$showType = "thumb";
		}
		
		$this->data['showType'] = $showType;
		$this->data['tree'] = $this->fetchFolderTreeList('','','', $showType);
		$this->data['access'] = $this->access;
		$this->data['prevfolder'] = $fid;
		$this->data['fileId'] = $id;
		$this->data['group'] = \Auth::user()->group_id;
		$this->data['rowFile'] = $file;
		$imgsrc = $this->getThumbpath($file->folder_id);
		$this->data['rowFile']->imgsrc = $imgsrc;
		if(\Auth::user()->group_id==3)
		{
			$this->data['userpermissions'] = \DB::table('tb_permissions')->where('user_id',$uid)->where('folder_id',$fid)->first();
		}
		$this->data['rel_files'] = '';
		if($file->file_type=="image/tiff")
		{
			$this->data['rel_files'] = \DB::table('tb_container_tiff_files')->where('file_id',$file->id)->get();
		}
		
		$AttrArr = array();
		$TagArr = array();
		$parentList = $this->fetchFolderParentListIds($fid);
		array_unshift($parentList, $id, $fid);
		foreach($parentList as $attrList)
		{
			$checkattr = \DB::table('tb_container_attributes')->where('container_id',$attrList)->get();
			if(!empty($checkattr))
			{
				$a=0;
				foreach($checkattr as $fetchattr)
				{
					$AttrArr[$a]['AttrType'] = $fetchattr->attr_type;
					$AttrArr[$a]['Attrs'] = \DB::table('tb_attributes')->where('id',$fetchattr->attr_id)->first();
					if($fetchattr->attr_type=="checkboxes" || $fetchattr->attr_type=="dropdown" || $fetchattr->attr_type=="radio")
					{
						$expAttrval = explode(',',$fetchattr->attr_value);
						$AttrArr[$a]['AttrVal'] = \DB::table('tb_attributes_options')->whereIn('id',$expAttrval)->get();
					}
					else{
						$AttrArr[$a]['AttrVal'] = $fetchattr->attr_value;
					}
					$a++;
				}
			}
			
			$checktag = \DB::table('tb_container_tags')->where('container_id',$attrList)->get();
			if(!empty($checktag))
			{
				foreach($checktag as $fetchtag)
				{
					$checktag = \DB::table('tb_tags_manager')->where('id',$fetchtag->tag_id)->first();
					if(!empty($checktag))
					{
						$TagArr[] = $checktag ;
					}
				}
			}
		}
		
		$this->data['sub_images'] = DB::table('tb_file_subimages')->where('file_id',$file->id)->get();
		$this->data['parentArr'] = array_reverse($this->fetchFolderParentListArray($fid));
		
		$this->data['AttrArr'] = $AttrArr;
		$this->data['TagArr'] = $TagArr;
		$sel_attributes = DB::table('tb_attributes')->where('attr_status',1);
		if(\Auth::user()->group_id==2 || \Auth::user()->group_id==3)
		{
			$sel_attributes->where('attr_permission',1);
		}
		$this->data['sel_attributes'] = $sel_attributes->get();
		
		$this->data['varients'] = DB::table('tb_file_varients')->where('file_id',$file->id)->get();
		$check_varint_attr = DB::table('tb_varient_attributes')->where('file_id',$file->id)->get();
		$var_attr = array();
		if(!empty($check_varint_attr))
		{
			foreach($check_varint_attr as $varint_attr)
			{
				$var_attr[$varint_attr->varient_id][$varint_attr->attr_id]['AttrType'] = $varint_attr->attr_type;
				$var_attr[$varint_attr->varient_id][$varint_attr->attr_id]['AttrId'] = $varint_attr->attr_id;
				$var_attr[$varint_attr->varient_id][$varint_attr->attr_id]['VarAttrId'] = $varint_attr->id;
				$var_attr[$varint_attr->varient_id][$varint_attr->attr_id]['Attrs'] = \DB::table('tb_attributes')->where('id',$varint_attr->attr_id)->where('attr_status',1)->first();
				if($varint_attr->attr_type=="checkboxes" || $varint_attr->attr_type=="dropdown" || $varint_attr->attr_type=="radio")
				{
					$var_attr[$varint_attr->varient_id][$varint_attr->attr_id]['AttrVal'] = $varint_attr->attr_value;
					$var_attr[$varint_attr->varient_id][$varint_attr->attr_id]['AttrOpts'] = DB::table('tb_attributes_options')->where('attr_id',$varint_attr->attr_id)->get();
				}
				else{
					$var_attr[$varint_attr->varient_id][$varint_attr->attr_id]['AttrVal'] = $varint_attr->attr_value;
				}
			}
		}
		
		//print "<pre>";
		//print_r($var_attr);
		
		$this->data['varient_attrs'] = $var_attr;
		
		$this->data['sel_tags'] = DB::table('tb_tags_manager')->where('tag_status',1)->get();
		
		return view('container.view',$this->data);	
	}

	function DownloadZipSelected()
	{
		$downFileName = 'zip-'.date('d-m-Y').'.zip';
		if( File::exists(public_path() . '/uploads/zip/'.$downFileName))
		{
			File::delete(public_path() . '/uploads/zip/'.$downFileName);
		}
		$items = Input::get('selectedfiles');
		if($items!='')
		{
			$comsep = explode(',',$items);
			foreach($comsep as $sepr)
			{
				$undsep = explode('-',$sepr);
				if($undsep[0]=='folder')
				{
					$folderdirPath = $this->getContainerUserPath($undsep[1]);
					$files[] = $folderdirPath;
				}
				if($undsep[0]=='file')
				{
					$file = DB::table('tb_container_files')->where('id', $undsep[1])->first();
					$filedirPath = $this->getContainerUserPath($file->folder_id);
					$files[] = $filedirPath.$file->file_name;
				}
			}
			Zipper::make('uploads/zip/'.$downFileName)->add($files);
			
			$headers = array(
				'Content-Type' => 'application/octet-stream',
			);
			
			$dopath = Zipper::getFilePath();
			Zipper::close();
			// Download .zip file.
			return Redirect::away(\URL::to($dopath));
			//return \Response::download( public_path() . '/'.$dopath, $downFileName, $headers );
		}
		else
		{
			return Redirect::to(Input::get('curnurl'))->with('messagetext','Please Select Folders/Files First.')->with('msgstatus','error');
		}
		
	}
	
	function DownloadZipEntire()
	{
		$downFileName = 'zip-'.date('d-m-Y').'.zip';
		if( File::exists(public_path() . '/uploads/zip/'.$downFileName))
		{
			File::delete(public_path() . '/uploads/zip/'.$downFileName);
		}
		
		$folderdirPath = $this->getContainerUserPath(Input::get('fold_id'));
		Zipper::make('uploads/zip/'.$downFileName)->add($folderdirPath);
			
		$headers = array(
			'Content-Type' => 'application/octet-stream',
		);
		
		$dopath = Zipper::getFilePath();
		Zipper::close();
		// Download .zip file.
		return Redirect::away(\URL::to($dopath));
		//$response = \Response::download( public_path() . '/'.$dopath, $downFileName, $headers );
		//return $response;
	}
	
	function DownloadlowPdfSelected()
	{
		$downFileName = 'lowres-'.date('d-m-Y').'.pdf';
		$items = Input::get('selectedfiles');
		if(($items!='') && strpos($items, 'file') !== false)
		{
			$folderInfo = DB::table('tb_container')->join('tb_users', 'tb_users.id', '=', 'tb_container.user_id')->select('tb_users.first_name', 'tb_users.last_name', 'tb_container.display_name as folderName')->where('tb_container.id', Input::get('fold_id'))->first();
			
			$html = '<style>.page-break { page-break-after: always; } .header,.footer {width: 100%; position:fixed;}.header {top: 0px;}.footer {bottom: 0px;}.pagenum:after {content: counter(page);}.imgBox {	border:1px solid #000;padding:20px; text-align:center; width:320px; margin:0 auto;}</style>';
			$html .= '<div class="header"><span>'.$folderInfo->first_name.' '.$folderInfo->last_name.'</span><br><span>Folder: '.$folderInfo->folderName.'</span></div><br><br><br><div class="footer"><span class="pagenum">Page </span></div>';
			
			$comsep = explode(',',$items);
			$i=0;
			$countArr = count($comsep);
			
			foreach($comsep as $sepr)
			{
				$i++;
				$undsep = explode('-',$sepr);
				if($undsep[0]=='folder')
				{
					$i--;
				}
				if($undsep[0]=='file')
				{
					$file = DB::table('tb_container_files')->where('id', $undsep[1])->first();
					$filedirPath = $this->getContainerUserPath($file->folder_id);
					$html .='<div class="imgBox"><img src="'.$filedirPath.$file->file_name.'" style="width:270px;"></div><p style="text-align:center;">'.$file->file_name.'</p><br>';
					if(($i%2)==0)
					{
						$html .='<div class="page-break"></div>';
					}
				}
			}
			
			$pdf = \App::make('dompdf.wrapper');
			$pdf->loadHTML($html);
			return $pdf->download($downFileName);
			
		}
		else
		{
			return Redirect::to(Input::get('curnurl'))->with('messagetext','Please Select Files First.')->with('msgstatus','error');
		}
	}
	
	function DownloadhighPdfSelected()
	{
		$downFileName = 'highres-'.date('d-m-Y').'.pdf';
		$items = Input::get('selectedfiles');
		if(($items!='') && strpos($items, 'file') !== false)
		{
			$folderInfo = DB::table('tb_container')->join('tb_users', 'tb_users.id', '=', 'tb_container.user_id')->select('tb_users.first_name', 'tb_users.last_name', 'tb_container.display_name as folderName')->where('tb_container.id', Input::get('fold_id'))->first();
			
			$html = '<style>.page-break { page-break-after: always; } .header,.footer {width: 100%; position:fixed;}.header {top: 0px;}.footer {bottom: 0px;}.pagenum:after {content: counter(page);}.imgBox {	border:1px solid #000;padding:20px; text-align:center; width:580px; margin:0 auto;}</style>';
			$html .= '<div class="header"><span>'.$folderInfo->first_name.' '.$folderInfo->last_name.'</span><br><span>Folder: '.$folderInfo->folderName.'</span></div><br><br><br><div class="footer"><span class="pagenum">Page </span></div>';
			
			$comsep = explode(',',$items);
			$i=0;
			$countArr = count($comsep);
			
			foreach($comsep as $sepr)
			{
				$i++;
				$undsep = explode('-',$sepr);
				if($undsep[0]=='folder')
				{
					$i--;
				}
				if($undsep[0]=='file')
				{
					$file = DB::table('tb_container_files')->where('id', $undsep[1])->first();
					$filedirPath = $this->getContainerUserPath($file->folder_id);
					$html .='<div class="imgBox"><img src="'.$filedirPath.$file->file_name.'" style="max-width:540px;"></div><p style="text-align:center;">'.$file->file_name.'</p><br>';
					if($i<$countArr)
					{
						$html .='<div class="page-break"></div>';
					}
				}
			}
			
			$pdf = \App::make('dompdf.wrapper');
			$pdf->loadHTML($html);
			return $pdf->download($downFileName);
			
		}
		else
		{
			return Redirect::to(Input::get('curnurl'))->with('messagetext','Please Select Files First.')->with('msgstatus','error');
		}
	}
	
	function Directorypermission()
	{
		$folderId = Input::get('fold_id');
		if($folderId!='' && $folderId>0)
		{
			$childList = $this->fetchFolderChildListIds($folderId);
			$parent_id = Input::get('parent_id');
			if($parent_id!=0)
			{
				$parentList = $this->fetchFolderParentListIds($folderId);
			}
			$users = Input::get('user');
			for($u=0;$u<count($users);$u++)
			{
				$data['folder_id'] = $folderId;
				$data['user_id'] = $users[$u]['id'];
				if (!array_key_exists('no_permission', $users[$u]) && !array_key_exists('view', $users[$u]) && !array_key_exists('down', $users[$u]) && !array_key_exists('up', $users[$u]) && !array_key_exists('del', $users[$u]) && !array_key_exists('inherit', $users[$u])) {
					if($parent_id==0)
					{
						$data['no_permission'] = 1;
					}
					else
					{
						$data['inherit'] = 1;
						$data['no_permission'] = 0;
					}
					$data['view'] = 0;
					$data['download'] = 0;
					$data['upload'] = 0;
					$data['delete'] = 0;	
				}
				else
				{
					if($parent_id==0)
					{
						if (array_key_exists('no_permission', $users[$u])) {
							$data['no_permission'] = 1;
							$data['view'] = 0;
							$data['download'] = 0;
							$data['upload'] = 0;
							$data['delete'] = 0;
							$data['inherit'] = 0;							
						}
						else
						{
							$data['no_permission'] = 0;
							$data['view'] = (array_key_exists('view', $users[$u]))? 1 : 0;
							$data['download'] = (array_key_exists('down', $users[$u]))? 1 : 0;
							$data['upload'] = (array_key_exists('up', $users[$u]))? 1 : 0;
							$data['delete'] = (array_key_exists('del', $users[$u]))? 1 : 0;
							$data['inherit'] = (array_key_exists('inherit', $users[$u]))? 1 : 0;
						}
					}
					else
					{
						if (array_key_exists('inherit', $users[$u])) {
							$data['inherit'] = 1;
							$data['no_permission'] = 0;
							$data['view'] = 0;
							$data['download'] = 0;
							$data['upload'] = 0;
							$data['delete'] = 0;	
						}
						else
						{
							if (array_key_exists('no_permission', $users[$u]))
							{
								$data['inherit'] = 0;
								$data['no_permission'] = 1;
								$data['view'] = 0;
								$data['download'] = 0;
								$data['upload'] = 0;
								$data['delete'] = 0;
							}
							else
							{
								$data['inherit'] = 0;
								$data['no_permission'] = 0;
								$data['view'] = (array_key_exists('view', $users[$u]))? 1 : 0;
								$data['download'] = (array_key_exists('down', $users[$u]))? 1 : 0;
								$data['upload'] = (array_key_exists('up', $users[$u]))? 1 : 0;
								$data['delete'] = (array_key_exists('del', $users[$u]))? 1 : 0;
							}
						}
					}
				}
				
				if($users[$u]['per_id']!="" && $users[$u]['per_id']>0)
				{
					$data['updated'] = date('y-m-d h:i:s');
					\DB::table('tb_permissions')->where('id', $users[$u]['per_id'])->update($data);
				}
				else
				{
					$data['created'] = date('y-m-d h:i:s');
					\DB::table('tb_permissions')->insert($data);
				}
				
				if($parent_id!=0)
				{
					if(!empty($parentList))
					{
						foreach($parentList as $parent)
						{
							$fparent = \DB::table('tb_permissions')->where('folder_id', $parent)->where('user_id', $users[$u]['id'])->first();
							$data['folder_id'] = $parent;
							$data['inherit'] = 0;
							$data['no_permission'] = 0;
							$data['view'] = 0;
							$data['download'] = 0;
							$data['upload'] = 0;
							$data['delete'] = 0;
							if(empty($fparent))
							{
								$data['created'] = date('y-m-d h:i:s');
								\DB::table('tb_permissions')->insert($data);
							}
							else
							{
								$data['updated'] = date('y-m-d h:i:s');
								\DB::table('tb_permissions')->where('id', $fparent->id)->update($data);
							}
						}
					}
				}
				
				if(!empty($childList))
				{
					foreach($childList as $child)
					{
						$subchild = \DB::table('tb_permissions')->where('folder_id', $child)->where('user_id', $users[$u]['id'])->first();
						$data['folder_id'] = $child;
						$data['inherit'] = 1;
						$data['no_permission'] = 0;
						$data['view'] = (array_key_exists('view', $users[$u]))? 1 : 0;
						$data['download'] = (array_key_exists('down', $users[$u]))? 1 : 0;
						$data['upload'] = (array_key_exists('up', $users[$u]))? 1 : 0;
						$data['delete'] = (array_key_exists('del', $users[$u]))? 1 : 0;
						if(empty($subchild))
						{
							$data['created'] = date('y-m-d h:i:s');
							\DB::table('tb_permissions')->insert($data);
						}
						else
						{
							$data['updated'] = date('y-m-d h:i:s');
							\DB::table('tb_permissions')->where('id', $subchild->id)->update($data);
						}
					}
				}
			}
			return Redirect::to(Input::get('curnurl'))->with('messagetext','Permissions are updated')->with('msgstatus','success');
		}
		else
		{
			return Redirect::to(Input::get('curnurl'))->with('messagetext','Folder not found.')->with('msgstatus','error');
		}
	}
	
	
	function makeFlipbook()
	{
		$items = Input::get('selectedfiles');
		if($items!='')
		{
			$comsep = explode(',',$items);
			$fimgs = array();
			foreach($comsep as $sepr)
			{
				$undsep = explode('-',$sepr);
				if($undsep[0]=='folder')
				{
				}
				if($undsep[0]=='file' && $undsep[2]=='pdf')
				{
					$fimgs[] = $undsep[1];
				}
			}
			
			if(!empty($fimgs))
			{
				$uniq = md5(uniqid(rand(), true));
				$fdata['img_ids'] = implode(',',$fimgs);
				$fdata['unique_code'] = $uniq;
				$fdata['flip_type'] = Input::get('fliptype');
				
				\DB::table('tb_flipbooks')->insert($fdata);
			
				return Redirect::to('getflipbook/'.$uniq);
			}
			else
			{
				return Redirect::to(Input::get('curnurl'))->with('messagetext','For your selection of images, only slideshow allowed. flipbook viewing works for pdf\'s only')->with('msgstatus','error');
			}
		}
		else
		{
			return Redirect::to(Input::get('curnurl'))->with('messagetext','Please Select Files First.')->with('msgstatus','error');
		}
	}
	
	function getFlipbook($uniq)
	{
		$red = '/';
		if(\Auth::check() == true)
        {
			$red = 'container';
		}
		if($uniq!='')
		{
			$flp = DB::table('tb_flipbooks')->where('unique_code', $uniq)->first();
			if(!empty($flp))
			{
				$imgs = explode(',',$flp->img_ids);
				$flipimgs = array();
				$fl=0;
				foreach($imgs as $file)
				{
					$file = DB::table('tb_container_files')->where('id', $file)->first();
					$dirPath = $this->getThumbpath($file->folder_id);
					
					$flipimgs[$fl]['imgpath'] = $dirPath.$file->file_name;
					$flipimgs[$fl]['imgname'] = $file->file_name;
					$flipimgs[$fl]['file_type'] = $file->file_type;
					$flipimgs[$fl]['folder'] = $file->folder_id;
					$fl++;
				}
				$this->data['flips'] = $flipimgs;
				$this->data['fliptype'] = $flp->flip_type;
				return view('container.flipbook',$this->data);
			}
			else
			{
				return Redirect::to($red)->with('messagetext','NO files selected.')->with('msgstatus','error');
			}
		}
		else
		{
			return Redirect::to($red)->with('messagetext','Invalid link.')->with('msgstatus','error');
		}
	}

	function DoflipbookEmail( Request $request)
	{
		$rules = array(
			'emailType'		=> 'required',
			'emailids'		=> 'required',
			'subject'		=> 'required',
			'emailTemplate'		=> 'required',
			'message'		=> 'required'			
		);
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) 
		{
			$items = Input::get('selecteditems');
			if($items!='')
			{
				if($request->input('emailids')!='')
				{
					$comsep = explode(',',$items);
					$fimgs = array();
					foreach($comsep as $sepr)
					{
						$undsep = explode('-',$sepr);
						if($undsep[0]=='folder')
						{
						}
						if($undsep[0]=='file')
						{
							$fimgs[] = $undsep[1];
						}
					}
					
					if(!empty($fimgs))
					{
						//$msg = preg_replace('/[^A-Za-z0-9!@#$%^&*()<>]/u','', $request->input('message'));
						$msg = $request->input('message');
						$linkConvertmsg = $msg;
						$fltype = 'high';
						$etype = $request->input('emailType');
						$fltype = $request->input('flipType');
						$uniq = md5(uniqid(rand(), true));
						$fdata['img_ids'] = implode(',',$fimgs);
						$fdata['unique_code'] = $uniq;
						$fdata['flip_type'] = $fltype;
						\DB::table('tb_flipbooks')->insert($fdata);
						
						foreach($etype as $Type)
						{
							if($Type=='flipbook')
							{
								$linkConvertmsg .= ' <br> Als Flipbook ansehen <a href="'. \URL::to('getflipbook/'.$uniq).'">hier klicken</a>';
								$share_type = 'Flipbook';
								$share_url = \URL::to('getflipbook/'.$uniq);
							}
							
							if($Type=='slideshow')
							{
								$linkConvertmsg .= ' <br> Als Slideshow ansehen <a href="'. \URL::to('getslideshow/'.$uniq).'">hier klicken</a>';
								$share_type = 'Slideshow';
								$share_url = \URL::to('getslideshow/'.$uniq);
							}
							
							if($Type=='download')
							{
								$exp_type = explode('-',$request->input('downType'));
								if($exp_type[0]=="zip")
								{
									$downFileName = 'zip-'.date('d-m-Y-h-i-s').'.zip';
									foreach($fimgs as $files)
									{
										$file = DB::table('tb_container_files')->where('id', $files)->first();
										$filedirPath = $this->getContainerUserPath($file->folder_id);
										$imgfiles[] = $filedirPath.$file->file_name;
									}
									Zipper::make('uploads/zip/'.$downFileName)->add($imgfiles);
									$dopath = Zipper::getFilePath();
									Zipper::close();
									$linkConvertmsg .= ' <br> Link bitte Hier <a href="'.\URL::to($dopath).'">Runterladen</a>';
									$share_type = 'Download as Zip';
									$share_url = \URL::to($dopath);
								}
								elseif($exp_type[0]=="pdf")
								{
									if($exp_type[1]=="high")
									{
										$width = '580'; 
										$maxwidth = '540';
									}
									elseif($exp_type[1]=="low")
									{
										$width = '320'; 
										$maxwidth = '270';
									}
									$downFileName = 'download-'.date('d-m-Y-h-i-s').'.pdf';
									$items = Input::get('selecteditems');
									if(($items!='') && strpos($items, 'file') !== false)
									{
										$folderInfo = DB::table('tb_container')->join('tb_users', 'tb_users.id', '=', 'tb_container.user_id')->select('tb_users.first_name', 'tb_users.last_name', 'tb_container.display_name as folderName')->where('tb_container.id', Input::get('fold_id'))->first();
										
										$html = '<style>.page-break { page-break-after: always; } .header,.footer {width: 100%; position:fixed;}.header {top: 0px;}.footer {bottom: 0px;}.pagenum:after {content: counter(page);}.imgBox {	border:1px solid #000;padding:20px; text-align:center; width:'.$width.'px; margin:0 auto;}</style>';
										$html .= '<div class="header"><span>'.$folderInfo->first_name.' '.$folderInfo->last_name.'</span><br><span>Folder: '.$folderInfo->folderName.'</span></div><br><br><br><div class="footer"><span class="pagenum">Page </span></div>';
										
										$comsep = explode(',',$items);
										$i=0;
										$countArr = count($comsep);
										
										foreach($comsep as $sepr)
										{
											$i++;
											$undsep = explode('-',$sepr);
											if($undsep[0]=='folder')
											{
												$i--;
											}
											if($undsep[0]=='file')
											{
												$file = DB::table('tb_container_files')->where('id', $undsep[1])->first();
												$filedirPath = $this->getContainerUserPath($file->folder_id);
												$html .='<div class="imgBox"><img src="'.$filedirPath.$file->file_name.'" style="max-width:'.$maxwidth.'px;"></div><p style="text-align:center;">'.$file->file_name.'</p><br>';
												if($i<$countArr)
												{
													$html .='<div class="page-break"></div>';
												}
											}
										}
										
										$pdf = \App::make('dompdf.wrapper');
										$pdf->loadHTML($html);
										$pdf->save(public_path(). '/uploads/container_pdfs/'.$downFileName);
										
										$linkConvertmsg .= ' <br> Link bitte Hier <a href="'.\URL::to('uploads/container_pdfs/'.$downFileName).'">Runterladen</a>';
										$share_type = 'Download as Pdf';
										$share_url = \URL::to('uploads/container_pdfs/'.$downFileName);
									}
								}
								
							}
						}
						
						$data['msg'] = html_entity_decode($linkConvertmsg);				
						$usersemail = $request->input('emailids');
						$users = explode(',',$usersemail);
						for($i=0; $i<count($users); $i++)
						{
							$emp = DB::table('employee')->where('Email',$users[$i])->where('Status',1)->first();
							if(empty($emp))
							{
								$emdata['Status'] = 1;
								$emdata['flag_status'] = 'Shared';
								$emdata['Email'] = $users[$i];
								\DB::table('employee')->insert($emdata);
								
								$invite_exist = DB::table('tb_share_emails')->where('email_id',$users[$i])->where('user_id', \Auth::user()->id)->first();
								if(empty($invite_exist))
								{
									$invdata['user_id'] = \Auth::user()->id;
									$invdata['email_id'] = $users[$i];
									\DB::table('tb_share_emails')->insert($invdata);
								}
							}
							
							$toouser['email'] = $users[$i];
							$toouser['subject'] = $request->input('subject');
							$etemp = $request->input('emailTemplate');
							\Mail::send('user.emails.'.$etemp, $data, function($message) use ($toouser)
							{
								$message->from(CNF_EMAIL, CNF_APPNAME);

								$message->to( $toouser['email']);
								
								$message->subject($toouser['subject']);
							});
							
							$to = $users[$i];
							$subject = $request->input('subject');
							$message = view('user.emails.'.$request->input('emailTemplate'), $data);
							$headers = 'MIME-Version: 1.0' . "\r\n";
							$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
							$headers .= 'From: '.CNF_APPNAME.' <'.CNF_EMAIL.'>' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
							mail($to, $subject, $message, $headers);
							
							$sharedata['file_ids'] = implode(',',$fimgs);
							$sharedata['share_type'] = $share_type;
							$sharedata['share_email'] = $users[$i];
							$sharedata['share_template'] = $request->input('emailTemplate');
							$sharedata['share_url'] = $share_url;
							$sharedata['user_id'] = \Auth::user()->id;
							$sharedata['created'] = date('Y-m-d h:i:s');
							\DB::table('tb_container_employee_share')->insert($sharedata);
						}
						return Redirect::to(Input::get('curnurl'))->with('messagetext','Message has been sent')->with('msgstatus','success');
					}
					else
					{
						return Redirect::to(Input::get('curnurl'))->with('messagetext','Please Select Files First.')->with('msgstatus','error');
					}	
				}
				else{
					return Redirect::to(Input::get('curnurl'))->with('messagetext','Please fill the email id')->with('msgstatus','error');
				}
			}
			else
			{
				return Redirect::to(Input::get('curnurl'))->with('messagetext','Please Select Files First.')->with('msgstatus','error');
			}
			

		} else {

			return Redirect::to(Input::get('curnurl'))->with('messagetext', 'The following errors occurred')->with('msgstatus','error')->withErrors($validator)->withInput();

		}	

	}
	
	function globalDirectorypermission()
	{
		$folderId = Input::get('fold_id');
		if($folderId!='' && $folderId>0)
		{
			$childs = $this->fetchFolderChildListIds($folderId);
			\DB::table('tb_container')->where('id',$folderId)->update(['global_permission' => 1]);
			\DB::table('tb_container')->whereIn('id',$childs)->update(['global_permission' => 1]);
			return Redirect::to(Input::get('curnurl'))->with('messagetext','Folder becomes global now.')->with('msgstatus','success');
		}
		else
		{
			return Redirect::to(Input::get('curnurl'))->with('messagetext','Folder not found.')->with('msgstatus','error');
		}
	}
	
	function removeglobalDirectorypermission()
	{
		$folderId = Input::get('fold_id');
		if($folderId!='' && $folderId>0)
		{
			$childs = $this->fetchFolderChildListIds($folderId);
			\DB::table('tb_container')->where('id',$folderId)->update(['global_permission' => 0]);
			\DB::table('tb_container')->whereIn('id',$childs)->update(['global_permission' => 0]);
			return Redirect::to(Input::get('curnurl'))->with('messagetext','Now, the folder is not global.')->with('msgstatus','success');
		}
		else
		{
			return Redirect::to(Input::get('curnurl'))->with('messagetext','Folder not found.')->with('msgstatus','error');
		}
	}
	
	function getSlideshow($uniq)
	{
		$red = '/';
		if(\Auth::check() == true)
        {
			$red = 'container';
		}
		if($uniq!='')
		{
			$flp = DB::table('tb_flipbooks')->where('unique_code', $uniq)->first();
			if(!empty($flp))
			{
				$imgs = explode(',',$flp->img_ids);
				$flipimgs = array();
				$fl=0;
				foreach($imgs as $file)
				{
					$file = DB::table('tb_container_files')->where('id', $file)->first();
					$dirPath = $this->getThumbpath($file->folder_id);
					
					$flipimgs[$fl]['imgpath'] = $dirPath.$file->file_name;
					$fl++;
				}
				$this->data['imgfancy'] = $flipimgs;
				return view('container.slideshow',$this->data);
			}
			else
			{
				return Redirect::to($red)->with('messagetext','NO files selected.')->with('msgstatus','error');
			}
		}
		else
		{
			return Redirect::to($red)->with('messagetext','Invalid link.')->with('msgstatus','error');
		}
	}
	
	public function ShowTiffFiles( $fid = 0, $id = 0)
	{
		$uid = \Auth::user()->id;
		if($this->access['is_detail'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', Lang::get('core.note_restric'))->with('msgstatus','error');
					
		
		$file_temp = DB::table('tb_container_tiff_files')->join('tb_container', 'tb_container.id', '=', 'tb_container_tiff_files.folder_id')->join('tb_users', 'tb_users.id', '=', 'tb_container_tiff_files.user_id')->select('tb_users.first_name', 'tb_users.last_name', 'tb_container_tiff_files.*', 'tb_container.display_name as folderName')->where('tb_container_tiff_files.id', $id);
		
		$file = $file_temp->first();
		
		$spaceAllowed = \Auth::user()->storage_space;
		if($spaceAllowed==0){ $spaceAllowed = 1; }
		$usedSpaceBytes_temp = DB::table('tb_container_files');
		if(\Auth::user()->group_id==2)
		{
			$usedSpaceBytes_temp->where('user_id',$uid);
		}
		$usedSpaceBytes = $usedSpaceBytes_temp->sum('file_size');
		if(\Auth::user()->group_id!=3)
		{
			$usedSpaceMb = ($usedSpaceBytes/(1000*1000));
			$usedSpace = round($usedSpaceMb,2,PHP_ROUND_HALF_UP);
			$usedSpacePercentage = ($usedSpace*100)/$spaceAllowed;
			$this->data['allowStorage'] = $spaceAllowed;
			$this->data['usedStorage'] = $usedSpace;
			$this->data['usedStoragePerct'] = round($usedSpacePercentage,2,PHP_ROUND_HALF_UP);
		}
		$this->data['tree'] = $this->fetchFolderTreeList();
		$this->data['access'] = $this->access;
		$this->data['prevfolder'] = $fid;
		$this->data['group'] = \Auth::user()->group_id;
		$this->data['rowFile'] = $file;
		$imgsrc = $this->getThumbpath($file->folder_id);
		$this->data['rowFile']->imgsrc = $imgsrc;
		$this->data['rel_files'] = '';
		
		return view('container.view',$this->data);	
	}
	
	function assignAttributefolderfile(Request $request)
	{
		$uid = \Auth::user()->id;
		$rules = array(
			'assigned_attributes' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) 
		{
			$items = Input::get('selecteditems');
			if($items!='')
			{
				$attr_sel = $request->input('assigned_attributes');
				if(!empty($attr_sel))
				{
					foreach($attr_sel as $selectedAttr)
					{
						$cadata['attr_value'] = '';
						$exp_attr_sel = explode('-',$selectedAttr);
						$attrType=$exp_attr_sel[0];
						$attrId=$exp_attr_sel[1];
						$attrCat=$exp_attr_sel[2];
						
						if($attrType=='text')
						{
							$cadata['attr_value'] = $request->input('assigned_text')[$attrId];
						}
						elseif($attrType=='textarea')
						{
							$cadata['attr_value'] = $request->input('assigned_textarea')[$attrId];
						}
						elseif($attrType=='file')
						{
							if(!empty($request->file('assigned_file')[$attrId]))
							{
								$assigned_files = $request->file('assigned_file')[$attrId];
								for($af=0;$af<count($assigned_files);$af++)
								{
									if(!is_null($assigned_files[$af]))
									{
										$file = $assigned_files[$af]; 
										$destinationPath = './uploads/attributes_imgs/';
										$filename = $file->getClientOriginalName();
										$extension = $file->getClientOriginalExtension(); //if you need extension of the file
										$newfilename = rand(11111, 99999).'.'.$extension;
										$uploadSuccess = $file->move($destinationPath, $newfilename);				 
										if( $uploadSuccess ) {
											$imgarr[] = $newfilename; 
										}
									}
								}
								$cadata['attr_value'] = implode(' :: ',$imgarr);
							}	
						}
						elseif($attrType=='dropdown' || $attrType=='radio' || $attrType=='checkboxes')
						{
							$choosedAttr = $request->input('selected_attributes')[$attrId];
							
							if(!empty($request->input('opt_values')[$attrId]))
							{
								$opt_val = $request->input('opt_values')[$attrId];
								$opt_name = $request->input('opt_name')[$attrId];
								if(!empty($request->file('opt_imgs')[$attrId]))
								{
									$opt_imgs = $request->file('opt_imgs')[$attrId];
								}
								
								for($op=0;$op<count($opt_val);$op++)
								{
									if($opt_name[$op]!='' && $opt_val[$op]!='')
									{
										$check_attr = \DB::table('tb_attributes_options')->where('option_name', $opt_name[$op])->where('option_value', $opt_val[$op])->first();
										if(!empty($check_attr))
										{
											array_push($choosedAttr, $check_attr->id);
										}
										else
										{
											if($attrCat=='Materialien' || $attrCat=='Materialien_additional')
											{
												if(!is_null($opt_imgs[$op]))
												{
													$file = $opt_imgs[$op]; 
													$destinationPath = './uploads/attributes_imgs/';
													$filename = $file->getClientOriginalName();
													$extension = $file->getClientOriginalExtension();
													$newfilename = $opt_val[$op].$attrId.'.'.$extension;
													$uploadSuccess = $opt_imgs[$op]->move($destinationPath, $newfilename);
													if( $uploadSuccess ) {
														$opdata['attr_img'] = $newfilename;
													}
												}
											}
											$opdata['user_id'] = $uid;
											$opdata['attr_id'] = $attrId;
											$opdata['attr_type'] = $attrType;
											$opdata['option_name'] = $opt_name[$op];
											$opdata['option_value'] = $opt_val[$op];
											$opdata['created'] = date('Y-m-d h:i:s');
											$optId = \DB::table('tb_attributes_options')->insertGetId($opdata);
											array_push($choosedAttr, $optId);
										}
									}
								}
							}
							
							$cadata['attr_value'] = implode(',',$choosedAttr);
						}
						
						$comsep = explode(',',$items);
						foreach($comsep as $sepr)
						{
							if($sepr!='')
							{
								$undsep = explode('-',$sepr);
								\DB::table('tb_container_attributes')->where('attr_id',$attrId)->where('container_id',$undsep[1])->delete();
								if($undsep[0]=='folder')
								{
									$cadata['user_id'] = $uid;
									$cadata['attr_id'] = $attrId;
									$cadata['attr_type'] = $attrType;
									$cadata['container_id'] = $undsep[1];
									$cadata['container_type'] = 'folder';
									$cadata['product_description'] = $request->input('product_desc');
									$cadata['created'] = date('Y-m-d h:i:s');
									$con_attr_id = \DB::table('tb_container_attributes')->insertGetId($cadata);
								}
								if($undsep[0]=='file')
								{
									$cadata['user_id'] = $uid;
									$cadata['attr_id'] = $attrId;
									$cadata['attr_type'] = $attrType;
									$cadata['container_id'] = $undsep[1];
									$cadata['container_type'] = 'file';
									$cadata['product_description'] = $request->input('product_desc');
									$cadata['created'] = date('Y-m-d h:i:s');
									$con_attr_id = \DB::table('tb_container_attributes')->insertGetId($cadata);
								}
							}
						}
					}
				}
				
				
				return Redirect::to(Input::get('curnurl'))->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
			}
			else
			{
				return Redirect::to(Input::get('curnurl'))->with('messagetext','Please Select Folders/Files First.')->with('msgstatus','error');
			}
		}
		else
		{
			return Redirect::to(Input::get('curnurl'))->with('messagetext','Please select attribute first')->with('msgstatus','error');
		}
	}
	
	function getAttributeOptions(Request $request)
	{
		$attr_id = $request->input('attr_id');
		$attr_opts = DB::table('tb_attributes_options')->where('attr_id',$attr_id)->get();
		if(!empty($attr_opts))
		{
			return $attr_opts;
		}
		else{
			return 'error';
		}
		
	}
	
	function addNewTag(Request $request)
	{
		$title = trim($request->input('addtag'));
		$parent_tag = trim($request->input('parent_tag'));
		if($title!='')
		{
			$titleArr = explode(',',$title);
			foreach($titleArr as $newtag)
			{
				$tdata['tag_title'] = $newtag;
				$tdata['parent_tag_id'] = $parent_tag;
				$tdata['tag_status'] = 1;
				$tdata['created'] = date('Y-m-d h:i:s');
				$con_attr_id = \DB::table('tb_tags_manager')->insertGetId($tdata);
			}
			
			$alltags = DB::table('tb_tags_manager')->where('tag_status',1)->get();
			return $alltags;
		}
		else
		{
			return "error";
		}
	}
	
	function assignTagsfolderfile(Request $request)
	{
		$uid = \Auth::user()->id;
		$rules = array(
			'selTag' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) 
		{
			$items = Input::get('selecteditems');
			if($items!='')
			{
				$comsep = explode(',',$items);
				foreach($comsep as $sepr)
				{
					if($sepr!='')
					{
						$undsep = explode('-',$sepr);
						if($undsep[0]=='folder')
						{
							DB::table('tb_container_tags')->where('container_id', $undsep[1])->where('container_type', 'folder')->delete();
						}
						elseif($undsep[0]=='file')
						{
							DB::table('tb_container_tags')->where('container_id', $undsep[1])->where('container_type', 'file')->delete();
						}
						
						$tag_sel = $request->input('selTag');
						if(!empty($tag_sel))
						{
							foreach($tag_sel as $selectedTag)
							{
								if($undsep[0]=='folder')
								{
									$tdata['user_id'] = $uid;
									$tdata['tag_id'] = $selectedTag;
									$tdata['container_id'] = $undsep[1];
									$tdata['container_type'] = 'folder';
									$tdata['created'] = date('Y-m-d h:i:s');
									$con_attr_id = \DB::table('tb_container_tags')->insertGetId($tdata);
								}
								if($undsep[0]=='file')
								{
									$tdata['user_id'] = $uid;
									$tdata['tag_id'] = $selectedTag;
									$tdata['container_id'] = $undsep[1];
									$tdata['container_type'] = 'file';
									$tdata['created'] = date('Y-m-d h:i:s');
									$con_attr_id = \DB::table('tb_container_tags')->insertGetId($tdata);
								}
							}
						}
					}
				}
				return Redirect::to(Input::get('curnurl'))->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
			}
			else
			{
				return Redirect::to(Input::get('curnurl'))->with('messagetext','Please Select Folders/Files First.')->with('msgstatus','error');
			}
		}
		else
		{
			return Redirect::to(Input::get('curnurl'))->with('messagetext','Please select Tag(s) first')->with('msgstatus','error');
		}
	}
	
	function search_tag(Request $request)
	{
		$searchword = trim($request->input('keyword_tag'));
		if($searchword!='')
		{
			$alltags = DB::table('tb_tags_manager')->where('tag_status', '=', '1')->where(function ($query) use ($searchword) { return $query->where('tag_title', 'like', '%'.$searchword.'%')->orWhere('tag_image', 'like', '%'.$searchword.'%'); })->get();
			return $alltags;
		}
		else
		{
			return "error";
		}
	}
	
	function remove_exist_tag(Request $request)
	{
		$tagid = trim($request->input('tag_id'));
		$contid = trim($request->input('cont_id'));
		if($tagid>0)
		{
			\DB::table('tb_container_tags')->where('container_id',$contid)->where('tag_id',$tagid)->delete();
			return "true";
		}
		else
		{
			return "error";
		}
	}
	
	public function editfile(Request $request)
	{
		if(\Auth::check() == true)
        {
			$fileName = htmlentities(Input::get('file_display_name'));
			$fileTitle = htmlentities(Input::get('file_title'));
			$fileDesc = htmlentities(Input::get('file_desc'));
			
			$file_display_name_eng = htmlentities(Input::get('file_display_name_eng'));
			$file_title_eng = htmlentities(Input::get('file_title_eng'));
			$file_desc_eng = htmlentities(Input::get('file_desc_eng'));
			
			$data['file_display_name'] = $fileName;
			$data['file_title'] = $fileTitle;
			$data['file_description'] = $fileDesc;
			$data['file_display_name_eng'] = $file_display_name_eng;
			$data['file_title_eng'] = $file_title_eng;
			$data['file_description_eng'] = $file_desc_eng;
			$data['updated'] = date('y-m-d h:i:s');
			
			DB::table('tb_container_files')->where('id', Input::get('file_id'))->update($data);
				
			return Redirect::to(Input::get('curnurl'))->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
		}
		else
		{
			return Redirect::to('user/login');
		}
	}
	
	function remove_exist_attribute(Request $request)
	{
		$attrid = trim($request->input('attr_id'));
		$contid = trim($request->input('cont_id'));
		if($attrid>0)
		{
			\DB::table('tb_container_attributes')->where('container_id',$contid)->where('attr_id',$attrid)->delete();
			return "true";
		}
		else
		{
			return "error";
		}
	}
	
	function assignMainImage()
	{
		$uid = \Auth::user()->id;
		$items = Input::get('selecteditems');
		if($items!='')
		{
			$comsep = explode(',',$items);
			foreach($comsep as $sepr)
			{
				$undsep = explode('-',$sepr);
				if($undsep[0]=='folder')
				{
					if(!is_null(Input::file('main_img')))
					{
						$file = Input::file('main_img'); 
						$destinationPath = './uploads/folder_cover_imgs/';
						$filename = $file->getClientOriginalName();
						$extension = $file->getClientOriginalExtension(); //if you need extension of the file
						$newfilename = rand(11111, 99999).'.'.$extension;
						$uploadSuccess = $file->move($destinationPath, $newfilename);
						// image for backend
						$bkimg = \Image::make($destinationPath.$newfilename);
						$bkimg->resize(128, 130);
						$bkimgfile = 'thumb_'. $newfilename;
						$bkimg->save($destinationPath.$bkimgfile);
						
						//image for popup
						$mdimg = \Image::make($destinationPath.$newfilename);
						$thactualsize = getimagesize($destinationPath.$newfilename);
						if($thactualsize[0]>$thactualsize[1])
						{
							$mdimg->resize(320, null, function ($constraint) {
								$constraint->aspectRatio();
							});
						}
						else
						{
							$mdimg->resize(null, 320, function ($constraint) {
								$constraint->aspectRatio();
							});
						}
						$thumbfile = 'format_'.$newfilename;
						$mdimg->save($destinationPath.$thumbfile);
						
						// IMage for frontend
						$ftimg = \Image::make($destinationPath.$newfilename);
						$ftimg->resize(320, 385);
						$ftimgfile = 'front_'.$newfilename;
						$ftimg->save($destinationPath.$ftimgfile);
						
						// IMage for Product page
						$pdimg = \Image::make($destinationPath.$newfilename);
						$pdimg->resize(660, 471);
						$pdimgfile = 'product_'.$newfilename;
						$pdimg->save($destinationPath.$pdimgfile);
						
						$msnproductimg = \Image::make($destinationPath.$newfilename);
						$mpactualsize = getimagesize($destinationPath.$newfilename);
						if($mpactualsize[0]>$mpactualsize[1])
						{
							$msnproductimg->resize(349, 228);
						}
						else
						{
							$msnproductimg->resize(349, 527);
						}
						$msnproductfile = 'masonry_product_'.$newfilename;
						$msnproductimg->save($destinationPath.$msnproductfile);
						
						// image for product detail page
						if (! \File::exists($destinationPath.'product_detail_cover_'.$newfilename))
						{
							$pdcimg = \Image::make($destinationPath.$newfilename);
							$pdcimg->resize(null, 600, function ($constraint) {
											$constraint->aspectRatio();
										});
							$pdcimgfile = 'product_detail_cover_'. $newfilename;
							$pdcimg->save($destinationPath.$pdcimgfile);
						}
						
						if( $uploadSuccess ) {
							$cmdata['cover_img'] = $newfilename;
							$cmdata['updated'] = date('y-m-d');
							DB::table('tb_container')->where('id', $undsep[1])->update($cmdata);
						}
					}
					else
					{
						return Redirect::to(Input::get('curnurl'))->with('messagetext','Please select image for upload first.')->with('msgstatus','error');
					}
				}
				if($undsep[0]=='file')
				{
					if(Input::get('cover_fold')!="")
					{
						$file = DB::table('tb_container_files')->where('id', $undsep[1])->first();
						$dirPath = $this->getContainerUserPath($file->folder_id);
						$copytofolder = public_path().'/uploads/folder_cover_imgs/';
						if( is_dir($copytofolder) === true )
						{
							$successfile = File::copy($dirPath.$file->file_name, $copytofolder.$file->file_name);
							// image for backend
							$bkimg = \Image::make($dirPath.$file->file_name);
							$bkimg->resize(128, 130);
							$bkimgfile = 'thumb_'. $file->file_name;
							$bkimg->save($copytofolder.$bkimgfile);
							
							//image for popup
							$mdimg = \Image::make($dirPath.$file->file_name);
							$thactualsize = getimagesize($dirPath.$file->file_name);
							if($thactualsize[0]>$thactualsize[1])
							{
								$mdimg->resize(320, null, function ($constraint) {
									$constraint->aspectRatio();
								});
							}
							else
							{
								$mdimg->resize(null, 320, function ($constraint) {
									$constraint->aspectRatio();
								});
							}
							$thumbfile = 'format_'.$file->file_name;
							$mdimg->save($copytofolder.$thumbfile);
							
							// IMage for frontend
							$ftimg = \Image::make($dirPath.$file->file_name);
							$ftimg->resize(320, 385);
							$ftimgfile = 'front_'.$file->file_name;
							$ftimg->save($copytofolder.$ftimgfile);
							
							// IMage for Product page
							$pdimg = \Image::make($dirPath.$file->file_name);
							$pdimg->resize(660, 471);
							$pdimgfile = 'product_'.$file->file_name;
							$pdimg->save($copytofolder.$pdimgfile);
							
							$msnproductimg = \Image::make($dirPath.$file->file_name);
							$mpactualsize = getimagesize($dirPath.$file->file_name);
							if($mpactualsize[0]>$mpactualsize[1])
							{
								$msnproductimg->resize(349, 228);
							}
							else
							{
								$msnproductimg->resize(349, 527);
							}
							$msnproductfile = 'masonry_product_'.$file->file_name;
							$msnproductimg->save($copytofolder.$msnproductfile);
							
							// image for product detail page
							if (! \File::exists($copytofolder.'product_detail_cover_'.$file->file_name))
							{
								$pdcimg = \Image::make($dirPath.$file->file_name);
								$pdcimg->resize(null, 600, function ($constraint) {
											$constraint->aspectRatio();
										});
								$pdcimgfile = 'product_detail_cover_'. $file->file_name;
								$pdcimg->save($copytofolder.$pdcimgfile);
							}
							
							if($successfile)
							{
								$cmdata['cover_img'] = $file->file_name;
								$cmdata['updated'] = date('y-m-d');
								DB::table('tb_container')->where('id', Input::get('cover_fold'))->update($cmdata);
							}
						}
					}
					else
					{
						return Redirect::to(Input::get('curnurl'))->with('messagetext','Please select folder first.')->with('msgstatus','error');
					}
				}
			}
			return Redirect::to(Input::get('curnurl'))->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
		}
		else
		{
			return Redirect::to(Input::get('curnurl'))->with('messagetext','Please Select Folders/Files First.')->with('msgstatus','error');
		}
	}
	
	
	function assignDesignercontainer()
	{
		$uid = \Auth::user()->id;
		$items = Input::get('selecteditems');
		if($items!='')
		{
			$comsep = explode(',',$items);
			foreach($comsep as $sepr)
			{
				$undsep = explode('-',$sepr);
				if($undsep[0]=='folder')
				{
					$exist_assign = DB::table('tb_container_designers')->where('designer_id', Input::get('designer'))->where('container_id', $undsep[1])->where('container_type', 'folder')->count();
					if($exist_assign==0)
					{
						$ftdata['user_id'] = $uid;
						$ftdata['designer_id'] = Input::get('designer');
						$ftdata['container_id'] = $undsep[1];
						$ftdata['container_type'] = 'folder';
						$ftdata['created'] = date('Y-m-d h:i:s');
						DB::table('tb_container_designers')->insertGetId($ftdata);
					}
				}
				if($undsep[0]=='file')
				{
					$exist_assign_file = DB::table('tb_container_designers')->where('designer_id', Input::get('designer'))->where('container_id', $undsep[1])->where('container_type', 'folder')->count();
					if($exist_assign_file==0)
					{
						$ftdata['user_id'] = $uid;
						$ftdata['designer_id'] = Input::get('designer');
						$ftdata['container_id'] = $undsep[1];
						$ftdata['container_type'] = 'file';
						$ftdata['created'] = date('Y-m-d h:i:s');
						\DB::table('tb_container_designers')->insertGetId($ftdata);
					}
				}
			}
			return Redirect::to(Input::get('curnurl'))->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
		}
		else
		{
			return Redirect::to(Input::get('curnurl'))->with('messagetext','Please Select Folders/Files First.')->with('msgstatus','error');
		}
	}
	
	
	function seletedFilesFrontend()
	{
		$uid = \Auth::user()->id;
		$items = Input::get('selectedfiles');
		if($items!='')
		{
			$comsep = explode(',',$items);
			foreach($comsep as $sepr)
			{
				$undsep = explode('-',$sepr);
				if($undsep[0]=='folder')
				{
					/*$slvr_exists = DB::table('tb_container')->where('id', $undsep[1])->where(function ($query) { $query->where('name', 'slider')->orWhere('name', 'produktvarianten');})->count();
					if($slvr_exists==0)
					{*/
						$check_fold = DB::table('tb_frontend_container')->where('container_id', $undsep[1])->where('container_type', 'folder')->first();
						if(empty($check_fold))
						{
							$ftdata['user_id'] = $uid;
							$ftdata['container_id'] = $undsep[1];
							$ftdata['container_type'] = 'folder';
							$ftdata['created'] = date('Y-m-d h:i:s');
							\DB::table('tb_frontend_container')->insertGetId($ftdata);
							
							$curfoldfiles = DB::table('tb_container_files')->where('folder_id', $undsep[1])->get();
							if(!empty($curfoldfiles))
							{
								foreach($curfoldfiles as $curfiles)
								{
									$check_file = DB::table('tb_frontend_container')->where('container_id', $curfiles->id)->where('container_type', 'file')->first();
									if(empty($check_file))
									{
										$ftdata['user_id'] = $uid;
										$ftdata['container_id'] = $curfiles->id;
										$ftdata['container_type'] = 'file';
										$ftdata['created'] = date('Y-m-d h:i:s');
										\DB::table('tb_frontend_container')->insertGetId($ftdata);
									}
								}
							}
							
							$childList = $this->fetchFolderChildListIds($undsep[1]);
							if(!empty($childList))
							{
								foreach($childList as $child)
								{
									/*$slvr_exists = DB::table('tb_container')->where('id', $child)->where(function ($query) { $query->where('name', 'slider')->orWhere('name', 'produktvarianten');})->count();
									if($slvr_exists==0)
									{*/
										$cftdata['user_id'] = $uid;
										$cftdata['container_id'] = $child;
										$cftdata['container_type'] = 'folder';
										$cftdata['created'] = date('Y-m-d h:i:s');
										\DB::table('tb_frontend_container')->insertGetId($cftdata);
										
										$files = DB::table('tb_container_files')->where('folder_id', $child)->get();
										if(!empty($files))
										{
											foreach($files as $file)
											{
												$check_file = DB::table('tb_frontend_container')->where('container_id', $file->id)->where('container_type', 'file')->first();
												if(empty($check_file))
												{
													$ftdata['user_id'] = $uid;
													$ftdata['container_id'] = $file->id;
													$ftdata['container_type'] = 'file';
													$ftdata['created'] = date('Y-m-d h:i:s');
													\DB::table('tb_frontend_container')->insertGetId($ftdata);
												}
											}
										}
									/* } */
								}
							}
						}
					/* } */
				}
				if($undsep[0]=='file')
				{
					$check_file = DB::table('tb_frontend_container')->where('container_id', $undsep[1])->where('container_type', 'file')->first();
					if(empty($check_file))
					{
						$file = DB::table('tb_container_files')->where('id', $undsep[1])->first();
						$ftdata['user_id'] = $uid;
						$ftdata['container_id'] = $undsep[1];
						$ftdata['container_type'] = 'file';
						$ftdata['created'] = date('Y-m-d h:i:s');
						\DB::table('tb_frontend_container')->insertGetId($ftdata);
						
						$parentList = $this->fetchFolderParentListIds($file->folder_id);
						if(!empty($parentList))
						{
							foreach($parentList as $parent)
							{
								/*$slvr_exists = DB::table('tb_container')->where('id', $parent)->where(function ($query) { $query->where('name', 'slider')->orWhere('name', 'produktvarianten');})->count();
								if($slvr_exists==0)
								{*/
									$check_parent = DB::table('tb_frontend_container')->where('container_id', $parent)->where('container_type', 'folder')->first();
									if(empty($check_parent))
									{
										$cftdata['user_id'] = $uid;
										$cftdata['container_id'] = $parent;
										$cftdata['container_type'] = 'folder';
										$cftdata['created'] = date('Y-m-d h:i:s');
										\DB::table('tb_frontend_container')->insertGetId($cftdata);
									}
								/* } */
							}
						}
					}
				}
			}
			return Redirect::to(Input::get('curnurl'))->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
		}
		else
		{
			return Redirect::to(Input::get('curnurl'))->with('messagetext','Please Select Folders/Files First.')->with('msgstatus','error');
		}
	}
	
	function UnassignSeletedFilesFrontend()
	{
		$uid = \Auth::user()->id;
		$items = Input::get('selectedfiles');
		if($items!='')
		{
			$comsep = explode(',',$items);
			foreach($comsep as $sepr)
			{
				$undsep = explode('-',$sepr);
				if($undsep[0]=='folder')
				{
					$check_fold = DB::table('tb_frontend_container')->where('container_id', $undsep[1])->where('container_type', 'folder')->first();
					if(!empty($check_fold))
					{
						DB::table('tb_frontend_container')->where('container_id', $undsep[1])->where('container_type', 'folder')->delete();
						$curfoldfilesdel = DB::table('tb_container_files')->where('folder_id', $undsep[1])->get();
						if(!empty($curfoldfilesdel))
						{
							foreach($curfoldfilesdel as $curfilesdel)
							{
								$check_file = DB::table('tb_frontend_container')->where('container_id', $curfilesdel->id)->where('container_type', 'file')->first();
								if(!empty($check_file))
								{
									DB::table('tb_frontend_container')->where('container_id', $curfilesdel->id)->where('container_type','file')->delete();
								}
							}
						}
						$childList = $this->fetchFolderChildListIds($undsep[1]);
						if(!empty($childList))
						{
							DB::table('tb_frontend_container')->whereIn('container_id', $childList)->where('container_type','folder')->delete();
							
							foreach($childList as $child)
							{	
								$files = DB::table('tb_container_files')->where('folder_id', $child)->get();
								if(!empty($files))
								{
									foreach($files as $file)
									{
										$check_file = DB::table('tb_frontend_container')->where('container_id', $file->id)->where('container_type', 'file')->first();
										if(!empty($check_file))
										{
											DB::table('tb_frontend_container')->where('container_id', $file->id)->where('container_type','file')->delete();
										}
									}
								}
							}
						}
						
						if(!empty($childList))
						{
							DB::table('tb_frontend_container')->whereIn('container_id', $childList)->where('container_type','folder')->delete();
							DB::table('tb_frontend_container')->whereIn('container_id', $childList)->where('container_type','file')->delete();
						}
					}
				}
				if($undsep[0]=='file')
				{
					$check_file = DB::table('tb_frontend_container')->where('container_id', $undsep[1])->where('container_type', 'file')->first();
					if(!empty($check_file))
					{
						DB::table('tb_frontend_container')->where('container_id', $undsep[1])->where('container_type', 'file')->delete();
					}
				}
			}
			return Redirect::to(Input::get('curnurl'))->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
		}
		else
		{
			return Redirect::to(Input::get('curnurl'))->with('messagetext','Please Select Folders/Files First.')->with('msgstatus','error');
		}
	}
	
	
	function ActivateDeactivateProductFrontend(Request $request)
	{
		$uid = \Auth::user()->id;
		$item = Input::get('cont_id');
		$cont_type = Input::get('cont_type');
		$action = Input::get('action');
		if($item!='' && $item>0)
		{
			if($cont_type=='folder')
			{
				/*$slvr_exists = DB::table('tb_container')->where('id', $item)->where(function ($query) { $query->where('name', 'slider')->orWhere('name', 'produktvarianten');})->count();
				if($slvr_exists==0)
				{*/
					$check_fold = DB::table('tb_frontend_container')->where('container_id', $item)->where('container_type', 'folder')->first();
					$childList = $this->fetchFolderChildListIds($item);
					if($action==0)
					{
						if(empty($check_fold))
						{
							$ftdata['user_id'] = $uid;
							$ftdata['container_id'] = $item;
							$ftdata['container_type'] = 'folder';
							$ftdata['created'] = date('Y-m-d h:i:s');
							\DB::table('tb_frontend_container')->insertGetId($ftdata);
							
							$curfoldfiles = DB::table('tb_container_files')->where('folder_id', $item)->get();
							if(!empty($curfoldfiles))
							{
								foreach($curfoldfiles as $curfiles)
								{
									$check_file = DB::table('tb_frontend_container')->where('container_id', $curfiles->id)->where('container_type', 'file')->first();
									if(empty($check_file))
									{
										$ftdata['user_id'] = $uid;
										$ftdata['container_id'] = $curfiles->id;
										$ftdata['container_type'] = 'file';
										$ftdata['created'] = date('Y-m-d h:i:s');
										\DB::table('tb_frontend_container')->insertGetId($ftdata);
									}
								}
							}
							
							
							if(!empty($childList))
							{
								foreach($childList as $child)
								{
									/*$slvr_exists = DB::table('tb_container')->where('id', $child)->where(function ($query) { $query->where('name', 'slider')->orWhere('name', 'produktvarianten');})->count();
									if($slvr_exists==0)
									{*/
										$cftdata['user_id'] = $uid;
										$cftdata['container_id'] = $child;
										$cftdata['container_type'] = 'folder';
										$cftdata['created'] = date('Y-m-d h:i:s');
										\DB::table('tb_frontend_container')->insertGetId($cftdata);
										
										$files = DB::table('tb_container_files')->where('folder_id', $child)->get();
										if(!empty($files))
										{
											foreach($files as $file)
											{
												$check_file = DB::table('tb_frontend_container')->where('container_id', $file->id)->where('container_type', 'file')->first();
												if(empty($check_file))
												{
													$ftdata['user_id'] = $uid;
													$ftdata['container_id'] = $file->id;
													$ftdata['container_type'] = 'file';
													$ftdata['created'] = date('Y-m-d h:i:s');
													\DB::table('tb_frontend_container')->insertGetId($ftdata);
												}
											}
										}
									/* } */
								}
							}
						}
					}
					elseif($action==1)
					{
						if(!empty($check_fold))
						{
							DB::table('tb_frontend_container')->where('container_id', $item)->where('container_type', 'folder')->delete();
							
							$curfoldfilesdel = DB::table('tb_container_files')->where('folder_id', $item)->get();
							if(!empty($curfoldfilesdel))
							{
								foreach($curfoldfilesdel as $curfilesdel)
								{
									$check_file = DB::table('tb_frontend_container')->where('container_id', $curfilesdel->id)->where('container_type', 'file')->first();
									if(!empty($check_file))
									{
										DB::table('tb_frontend_container')->where('container_id', $curfilesdel->id)->where('container_type','file')->delete();
									}
								}
							}
							if(!empty($childList))
							{
								DB::table('tb_frontend_container')->whereIn('container_id', $childList)->where('container_type','folder')->delete();
								
								foreach($childList as $child)
								{	
									$files = DB::table('tb_container_files')->where('folder_id', $child)->get();
									if(!empty($files))
									{
										foreach($files as $file)
										{
											$check_file = DB::table('tb_frontend_container')->where('container_id', $file->id)->where('container_type', 'file')->first();
											if(!empty($check_file))
											{
												DB::table('tb_frontend_container')->where('container_id', $file->id)->where('container_type','file')->delete();
											}
										}
									}
								}
							}
						}
					}
				/* } */
			}
			if($cont_type=='file')
			{
				$check_file = DB::table('tb_frontend_container')->where('container_id', $item)->where('container_type', 'file')->first();
				if($action==0)
				{
					if(empty($check_file))
					{
						$file = DB::table('tb_container_files')->where('id', $item)->first();
						
						$ftdata['user_id'] = $uid;
						$ftdata['container_id'] = $item;
						$ftdata['container_type'] = 'file';
						$ftdata['created'] = date('Y-m-d h:i:s');
						\DB::table('tb_frontend_container')->insertGetId($ftdata);
						
						$parentList = $this->fetchFolderParentListIds($file->folder_id);
						if(!empty($parentList))
						{
							foreach($parentList as $parent)
							{
								/*$slvr_exists = DB::table('tb_container')->where('id', $parent)->where(function ($query) { $query->where('name', 'slider')->orWhere('name', 'produktvarianten');})->count();
								if($slvr_exists==0)
								{*/
									$check_parent = DB::table('tb_frontend_container')->where('container_id', $parent)->where('container_type', 'folder')->first();
									if(empty($check_parent))
									{
										$cftdata['user_id'] = $uid;
										$cftdata['container_id'] = $parent;
										$cftdata['container_type'] = 'folder';
										$cftdata['created'] = date('Y-m-d h:i:s');
										\DB::table('tb_frontend_container')->insertGetId($cftdata);
									}
								/* } */
							}
						}
					}
				}
				elseif($action==1)
				{
					if(!empty($check_file))
					{
						DB::table('tb_frontend_container')->where('container_id', $item)->where('container_type', 'file')->delete();
					}
				}
				
			}
			echo 'success';
		}
		else
		{
			echo 'error';
		}
	}
	
	public function addSubImageContainerFile(Request $request)
	{
		if(\Auth::check() == true)
        {
			$input = Input::all();
			$file_id = Input::get('file_id');
			$file = Input::file('file');
		   // SET UPLOAD PATH
			$destinationPath = public_path(). '/uploads/file_sub_images/';
			// GET THE FILE EXTENSION
			$extension = $file->getClientOriginalExtension();
			// RENAME THE UPLOAD WITH RANDOM NUMBER
			//$fileName = rand(1111111, 9999999) . '.' . $extension;
			$fileName = $file_id.'_'. rand(1111111, 9999999).'_'.$file->getClientOriginalName();
			// MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
			$upload_success = $file->move($destinationPath, $fileName);
			
			$ftype = Input::file('file')->getClientMimeType();
			$exFtype = explode('/',$ftype);
			if($exFtype[0]=="image")
			{
				// open an image file
				$thimg = \Image::make($destinationPath.$fileName);
				// now you are able to resize the instance
				$thimg->resize(80, 80);
				// finally we save the image as a new file
				$thumbfile = 'thumb_'. $fileName;
				$thimg->save($destinationPath. 'thumbs/'.$thumbfile);
			}		
			
			$data['file_id'] = $file_id;
			$data['sub_image'] = $fileName;
			$data['image_type'] = Input::file('file')->getClientMimeType();
			$data['image_size'] = Input::file('file')->getClientSize();
			$data['user_id'] = \Auth::user()->id;
			$data['created'] = date('y-m-d h:i:s');
			$subimageID = DB::table('tb_file_subimages')->insertGetId($data);	
				
			return "success";
			//return Redirect::to(Input::get('curnurl'))->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
		}
		else
		{
			return "login";
			//return Redirect::to('user/login');
		}
	}
	
	function ActivateDeactivateProductSliderImages(Request $request)
	{
		$uid = \Auth::user()->id;
		$item = Input::get('img_id');
		$action = Input::get('action');
		if($item!='' && $item>0)
		{
			$check_subimage = DB::table('tb_file_subimages')->where('id', $item)->first();
			if(!empty($check_subimage))
			{
				$subdata['status'] = $action;
				$subdata['updated'] = date('Y-m-d h:i:s');
				DB::table('tb_file_subimages')->where('id', $item)->update($subdata);
				echo 'success';
			}
		}
		else
		{
			echo 'error';
		}
	}
	
	function RemoveSubimage(Request $request)
	{
		$uid = \Auth::user()->id;
		$item = Input::get('img_id');
		if($item!='' && $item>0)
		{
			$check_subimage = DB::table('tb_file_subimages')->where('id', $item)->first();
			if(!empty($check_subimage))
			{
				$delete = DB::table('tb_file_subimages')->where('id', $item)->delete();
				echo 'success';
			}
		}
		else
		{
			echo 'error';
		}
	}
	
	function fetchFolderParentListArray($id = 0, $parent_folders_array = '') {
 
		if (!is_array($parent_folders_array))
		$parent_folders_array = array();
	
		$filter = " AND id='".$id."'";
		
		$params = array(
			'params'	=> $filter,
			'order'		=> 'asc'
		);
		// Get Query 
		$results = $this->model->getRows( $params );
        
      if(\Auth::check() == true)
      {  
          if(\Auth::user()->group_id==5)
    	  {  
    	       foreach($results['rows'] as $row) {
        			$parent_folders_array[] = $row;    			
        	   }
          }else{
        	  if ($results) {
        		foreach($results['rows'] as $row) {
        			$parent_folders_array[] = $row;
        			$parent_folders_array = $this->fetchFolderParentListArray($row->parent_id, $parent_folders_array);
        		}
        	  }
           }
      }else{
            foreach($results['rows'] as $row) {
    			$parent_folders_array[] = $row;    			
    	   }  
      }
	  return $parent_folders_array;
	}
	
	function UpdateContainerSortnum()
	{
		$uid = \Auth::user()->id;
		$items = Input::get('items');
		$foldr = Input::get('foldId');
		if($items!='')
		{
			$comsep = explode(',',$items);
			$snum = 1;
			foreach($comsep as $sepr)
			{
				$undsep = explode('-',$sepr);
				if($undsep[0]=='folder')
				{
					$check_sfold = DB::table('tb_container')->where('id', $undsep[1])->first();
					if(!empty($check_sfold))
					{
						DB::table('tb_container')->where('id', $undsep[1])->update(["sort_num"=>$snum]);
					}
				}
				if($undsep[0]=='file')
				{
					$check_sfile = DB::table('tb_container_files')->where('id', $undsep[1])->first();
					if(!empty($check_sfile))
					{
						DB::table('tb_container_files')->where('id', $undsep[1])->update(["file_sort_num"=>$snum]);
					}
				}
				$snum++;
			}
			
			$folderObj = DB::table('tb_container')->where('id', $foldr)->first();
			if(!empty($folderObj))
			{
				if($folderObj->cover_img=="")
				{
					// Set main image first image in folder
					$checkfile = DB::table('tb_container_files')->where('folder_id', $folderObj->id)->where(function ($query) { $query->where('file_type', 'image/jpeg')->orWhere('file_type', 'image/png')->orWhere('file_type', 'image/gif');})->orderBy('file_sort_num', 'asc')->get();
					if(!empty($checkfile))
					{
						$destinationPath = $this->getContainerUserPath($folderObj->id);
						$copytofolder = public_path().'/uploads/folder_cover_imgs/';
						$find_prd=false;
						for($chk=0;$find_prd!=true;$chk++)
						{
							$fileName = $checkfile[$chk]->file_name;
							if($chk==0)
							{
								// image for backend
								if (! \File::exists($copytofolder.'thumb_'.$fileName))
								{
									$bkimg = \Image::make($destinationPath.$fileName);
									$bkimg->resize(128, 130);
									$bkimgfile = 'thumb_'. $fileName;
									$bkimg->save($copytofolder.$bkimgfile);
								}
								
								//image for popup
								if (! \File::exists($copytofolder.'format_'.$fileName))
								{
									$mdimg = \Image::make($destinationPath.$fileName);
									$thactualsize = getimagesize($destinationPath.$fileName);
									if($thactualsize[0]>$thactualsize[1])
									{
										$mdimg->resize(320, null, function ($constraint) {
											$constraint->aspectRatio();
										});
									}
									else
									{
										$mdimg->resize(null, 320, function ($constraint) {
											$constraint->aspectRatio();
										});
									}
									$thumbfile = 'format_'.$fileName;
									$mdimg->save($copytofolder.$thumbfile);
								}
								
								// IMage for frontend
								if (! \File::exists($copytofolder.'front_'.$fileName))
								{
									$ftimg = \Image::make($destinationPath.$fileName);
									$ftimg->resize(320, 385);
									$ftimgfile = 'front_'.$fileName;
									$ftimg->save($copytofolder.$ftimgfile);
								}
								
								if (! \File::exists($copytofolder.'masonry_product_'.$fileName))
								{
									$msnproductimg = \Image::make($destinationPath.$fileName);
									$mpactualsize = getimagesize($destinationPath.$fileName);
									if($mpactualsize[0]>$mpactualsize[1])
									{
										$msnproductimg->resize(349, 228);
									}
									else
									{
										$msnproductimg->resize(349, 527);
									}
									$msnproductfile = 'masonry_product_'.$fileName;
									$msnproductimg->save($copytofolder.$msnproductfile);
								}
								
								// image for product detail page
								if (! \File::exists($copytofolder.'product_detail_cover_'.$fileName))
								{
									$pdcimg = \Image::make($destinationPath.$fileName);
									$pdcimg->resize(null, 600, function ($constraint) {
											$constraint->aspectRatio();
										});
									$pdcimgfile = 'product_detail_cover_'. $fileName;
									$pdcimg->save($copytofolder.$pdcimgfile);
								}
								
								$mcmdata['temp_cover_img_masonry'] = $fileName;
								$mcmdata['updated'] = date('y-m-d');
								DB::table('tb_container')->where('id', $folderObj->id)->update($mcmdata);
								
							}
							
							$find_actualsize = getimagesize($destinationPath.$fileName);
							if($find_actualsize[0]>$find_actualsize[1])
							{
								// image for backend
								if (! \File::exists($copytofolder.'thumb_'.$fileName))
								{
									$bkimg = \Image::make($destinationPath.$fileName);
									$bkimg->resize(128, 130);
									$bkimgfile = 'thumb_'. $fileName;
									$bkimg->save($copytofolder.$bkimgfile);
								}
								
								//image for popup
								if (! \File::exists($copytofolder.'format_'.$fileName))
								{
									$mdimg = \Image::make($destinationPath.$fileName);
									$thactualsize = getimagesize($destinationPath.$fileName);
									if($thactualsize[0]>$thactualsize[1])
									{
										$mdimg->resize(320, null, function ($constraint) {
											$constraint->aspectRatio();
										});
									}
									else
									{
										$mdimg->resize(null, 320, function ($constraint) {
											$constraint->aspectRatio();
										});
									}
									$thumbfile = 'format_'.$fileName;
									$mdimg->save($copytofolder.$thumbfile);
								}
								
								// IMage for frontend
								if (! \File::exists($copytofolder.'front_'.$fileName))
								{
									$ftimg = \Image::make($destinationPath.$fileName);
									$ftimg->resize(320, 385);
									$ftimgfile = 'front_'.$fileName;
									$ftimg->save($copytofolder.$ftimgfile);
								}
								
								// IMage for Product page
								if (! \File::exists($copytofolder.'product_'.$fileName))
								{
									$pdimg = \Image::make($destinationPath.$fileName);
									$pdimg->resize(660, 471);
									$pdimgfile = 'product_'.$fileName;
									$pdimg->save($copytofolder.$pdimgfile);
								}
								
								// image for product detail page
								if (! \File::exists($copytofolder.'product_detail_cover_'.$fileName))
								{
									$pdcimg = \Image::make($destinationPath.$fileName);
									$pdcimg->resize(null, 600, function ($constraint) {
											$constraint->aspectRatio();
										});
									$pdcimgfile = 'product_detail_cover_'. $fileName;
									$pdcimg->save($copytofolder.$pdcimgfile);
								}
								
								$tcmdata['temp_cover_img'] = $fileName;
								$tcmdata['updated'] = date('y-m-d');
								DB::table('tb_container')->where('id', $folderObj->id)->update($tcmdata);
								$find_prd=true;
							}
						}
					}
				}
			}
			echo "success";
		}
		else
		{
			echo "error";
		}
	}
	
	
	function AddVarientsfile(Request $request)
	{
		//print "<pre>";
		//print_r($request->all()); //die;
		$uid = \Auth::user()->id;
		$rules = array(
			'varient_code' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) 
		{
			$items = trim(Input::get('file_id'));
			if($items!='')
			{
				$varint_code = $request->input('varient_code');
				$varint_name = $request->input('varient_name');
				$varint_image = $request->file('varient_image');
				for($v=1;$v<=count($varint_code);$v++)
				{
					$fvdata = array();
					if(!is_null($varint_image[$v]))
					{
						$file = $varint_image[$v]; 
						$destinationPath = './uploads/varients_imgs/';
						$filename = $file->getClientOriginalName();
						$extension = $file->getClientOriginalExtension(); //if you need extension of the file
						$newfilename = rand(11111, 99999).'.'.$extension;
						$uploadSuccess = $file->move($destinationPath, $newfilename);				 
						if( $uploadSuccess ) {
							$fvdata['varient_image'] = $newfilename; 
						}
					}
					$fvdata['user_id'] = $uid;
					$fvdata['file_id'] = $items;
					$fvdata['varient_code'] = trim($varint_code[$v]);
					$fvdata['varient_name'] = trim($varint_name[$v]);
					if(isset($request->input('edit_varient_id')[$v]))
					{
						$fvdata['updated'] = date('Y-m-d h:i:s');
						\DB::table('tb_file_varients')->where('id', $request->input('edit_varient_id')[$v])->update($fvdata);
						$varient_id = $request->input('edit_varient_id')[$v];
					}
					else
					{
						$fvdata['created'] = date('Y-m-d h:i:s');
						$varient_id = \DB::table('tb_file_varients')->insertGetId($fvdata);
					}
					
					
					$attr_sel = $request->input('assigned_attributes')[$v];
					if(!empty($attr_sel))
					{
						foreach($attr_sel as $selectedAttr)
						{
							$vadata['attr_value'] = '';
							$exp_attr_sel = explode('-',$selectedAttr);
							$attrType=$exp_attr_sel[0];
							$attrId=$exp_attr_sel[1];
							$attrCat=$exp_attr_sel[2];
							
							if($attrType=='text')
							{
								$vadata['attr_value'] = $request->input('assigned_text')[$v][$attrId];
							}
							elseif($attrType=='textarea')
							{
								$vadata['attr_value'] = $request->input('assigned_textarea')[$v][$attrId];
							}
							elseif($attrType=='file')
							{
								$imgarr = array();
								if(!empty($request->file('assigned_file')[$v][$attrId]))
								{
									$assigned_files = $request->file('assigned_file')[$v][$attrId];
									for($af=0;$af<count($assigned_files);$af++)
									{
										if(!is_null($assigned_files[$af]))
										{
											$file = $assigned_files[$af]; 
											$destinationPath = './uploads/varients_imgs/attributes_imgs/';
											$filename = $file->getClientOriginalName();
											$extension = $file->getClientOriginalExtension(); //if you need extension of the file
											$newfilename = rand(11111, 99999).'.'.$extension;
											$uploadSuccess = $file->move($destinationPath, $newfilename);				 
											if( $uploadSuccess ) {
												$imgarr[] = $newfilename; 
											}
										}
										elseif(isset($request->input('edit_assigned_file')[$v][$attrId][$af]))
										{
											$edit_assigned_files = $request->input('edit_assigned_file')[$v][$attrId][$af];
											$imgarr[] = $edit_assigned_files;
										}
									}
									$vadata['attr_value'] = implode(' :: ',$imgarr);
								}
							}
							elseif($attrType=='dropdown' || $attrType=='radio' || $attrType=='checkboxes')
							{
								$choosedAttr = $request->input('selected_attributes')[$v][$attrId];
								
								if(!empty($request->input('opt_values')[$v][$attrId]))
								{
									$opt_val = $request->input('opt_values')[$v][$attrId];
									$opt_name = $request->input('opt_name')[$v][$attrId];
									if(!empty($request->file('opt_imgs')[$v][$attrId]))
									{
										$opt_imgs = $request->file('opt_imgs')[$v][$attrId];
									}
									
									for($op=0;$op<count($opt_val);$op++)
									{
										if($opt_name[$op]!='' && $opt_val[$op]!='')
										{
											$check_attr = \DB::table('tb_attributes_options')->where('option_name', $opt_name[$op])->where('option_value', $opt_val[$op])->first();
											if(!empty($check_attr))
											{
												array_push($choosedAttr, $check_attr->id);
											}
											else
											{
												if($attrCat=='Materialien' || $attrCat=='Materialien_additional')
												{
													if(!is_null($opt_imgs[$op]))
													{
														$file = $opt_imgs[$op]; 
														$destinationPath = './uploads/attributes_imgs/';
														$filename = $file->getClientOriginalName();
														$extension = $file->getClientOriginalExtension();
														$newfilename = $opt_val[$op].$attrId.'.'.$extension;
														$uploadSuccess = $opt_imgs[$op]->move($destinationPath, $newfilename);
														if( $uploadSuccess ) {
															$opdata['attr_img'] = $newfilename;
														}
													}
												}
												$opdata['user_id'] = $uid;
												$opdata['attr_id'] = $attrId;
												$opdata['attr_type'] = $attrType;
												$opdata['option_name'] = $opt_name[$op];
												$opdata['option_value'] = $opt_val[$op];
												$opdata['created'] = date('Y-m-d h:i:s');
												$optId = \DB::table('tb_attributes_options')->insertGetId($opdata);
												array_push($choosedAttr, $optId);
											}
										}
									}
								}
								
								$vadata['attr_value'] = implode(',',$choosedAttr);
							}
							
							
							// \DB::table('tb_varient_attributes')->where('attr_id',$attrId)->where('varient_id',$varient_id)->delete();
							$vadata['user_id'] = $uid;
							$vadata['attr_id'] = $attrId;
							$vadata['attr_type'] = $attrType;
							$vadata['varient_id'] = $varient_id;
							$vadata['file_id'] = $items;
							if(isset($request->input('edit_attr_id')[$v][$attrId]))
							{
								$vadata['updated'] = date('Y-m-d h:i:s');
								$con_attr_id = \DB::table('tb_varient_attributes')->where('id',$request->input('edit_attr_id')[$v][$attrId])->update($vadata);
							}
							else
							{
								$vadata['created'] = date('Y-m-d h:i:s');
								$con_attr_id = \DB::table('tb_varient_attributes')->insertGetId($vadata);
							}
						}
					}
				}
				return Redirect::to(Input::get('curnurl'))->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
			}
			else
			{
				return Redirect::to(Input::get('curnurl'))->with('messagetext','Please Select Folders/Files First.')->with('msgstatus','error');
			}
		}
		else
		{
			return Redirect::to(Input::get('curnurl'))->with('messagetext','Please select attribute first')->with('msgstatus','error');
		}
	}
	
	function RemoveExistVarients(Request $request)
	{
		$varnt_id = trim($request->input('varnt_id'));
		$contid = trim($request->input('cont_id'));
		if($varnt_id>0)
		{
			\DB::table('tb_file_varients')->where('file_id',$contid)->where('id',$varnt_id)->delete();
			\DB::table('tb_varient_attributes')->where('file_id',$contid)->where('varient_id',$varnt_id)->delete();
			return "true";
		}
		else
		{
			return "error";
		}
	}
	
	
	public function containerSearch( Request $request)
	{
		if($this->access['is_view'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
		$uid = \Auth::user()->id;
		
		$keyword = trim($request->input('searchkeyword'));
		
		$filter = " AND (display_name like '%".$keyword."%' or file_type like '%".$keyword."%' or title like '%".$keyword."%' or description like '%".$keyword."%')";
		if(\Auth::user()->group_id==3)
		{
			$filter .= " AND (id in (select folder_id from tb_permissions where user_id='".$uid."' and no_permission='0') or global_permission='1')";
		}
		if(\Auth::user()->group_id==2)
		{
			$filter .= " AND (user_id='".$uid."' or (user_id!='".$uid."' and global_permission='1'))";
		}
		$params = array(
			'params'	=> $filter
		);
		// Get Query 
		$results = $this->model->getRows( $params );
		
		$filess_temp = DB::table('tb_container_files')->where(function ($query) use ($keyword) { $query->where('file_name', 'like' ,'%'.$keyword.'%')->orWhere('file_type', 'like' ,'%'.$keyword.'%')->orWhere('file_title', 'like' ,'%'.$keyword.'%')->orWhere('file_description', 'like' ,'%'.$keyword.'%')->orWhere('file_display_name', 'like' ,'%'.$keyword.'%');});
		if(\Auth::user()->group_id==2)
		{
			$filess_temp->where('user_id',$uid);
		}
		$filessTotal = $filess_temp_full->get();

		$totalRecord = $resultsTotal['total'] + count($filessTotal);
		$this->data['pagination']['total'] = $totalRecord;
		$this->data['pagination']['current_page'] = $page_number;
		$this->data['pagination']['prev_page'] = ($page_number>0)?($page_number - 1):0;
		$this->data['pagination']['next_page'] = ($page_number>0)?($page_number + 1):0;
		$filess = array();
		if(count($results['rows'])<$record_per_page){
			if($resultsTotal['total']>0){
				$startOffset = 0;
				$limitFiles = count($results['rows']) - $record_per_page;
			}else{
				$startOffset = ($page_number - 1) * $record_per_page;
				$limitFiles = $record_per_page;
			}
			$filess = $filess_temp->offset($startOffset)->limit($limitFiles)->get();
		}
	
		$ct=0; 
		$this->data['rowData'] = array();
		
		foreach($results['rows'] as $folderObj ){
			$totfiles = DB::table('tb_container_files')->where('folder_id',$folderObj->id)->count();
			$totfolders = DB::table('tb_container')->where('parent_id',$folderObj->id)->count();
			$frontend = DB::table('tb_frontend_container')->where('container_id',$folderObj->id)->where('container_type','folder')->first();
			$this->data['rowData'][$ct]['id'] = $folderObj->id;
			$this->data['rowData'][$ct]['folder_id'] = $folderObj->id;
			$this->data['rowData'][$ct]['name'] = $folderObj->display_name;
			$this->data['rowData'][$ct]['ftype'] = 'folder';
			$this->data['rowData'][$ct]['imgsrc'] = '';
			$this->data['rowData'][$ct]['foldercount'] = $totfolders;
			$this->data['rowData'][$ct]['filecount'] = $totfiles;
			$this->data['rowData'][$ct]['tiff_files'] = '';
			$this->data['rowData'][$ct]['title'] = $folderObj->title;
			$this->data['rowData'][$ct]['description'] = $folderObj->description;
			$this->data['rowData'][$ct]['file_display_name'] = '';
			$this->data['rowData'][$ct]['cover_img'] = $folderObj->cover_img;
			$this->data['rowData'][$ct]['sort_num'] = $folderObj->sort_num;
			$this->data['rowData'][$ct]['assign_front'] = 'no';
			if(!empty($frontend))
			{
				$this->data['rowData'][$ct]['assign_front'] = 'yes';
			}
			$ct++;
		}
		
		foreach($filess as $filesObj ){
			$this->data['rowData'][$ct]['id'] = $filesObj->id;
			$this->data['rowData'][$ct]['folder_id'] = $filesObj->folder_id;
			$this->data['rowData'][$ct]['name'] = $filesObj->file_name;
			$this->data['rowData'][$ct]['ftype'] = 'file';
			$imgsrc = $this->getThumbpath($filesObj->folder_id);
			$this->data['rowData'][$ct]['imgsrc'] = $imgsrc;
			$this->data['rowData'][$ct]['filecount'] = '';
			$this->data['rowData'][$ct]['foldercount'] = '';
			$this->data['rowData'][$ct]['tiff_files'] = '';
			$this->data['rowData'][$ct]['title'] = $filesObj->file_title;
			$this->data['rowData'][$ct]['description'] = $filesObj->file_description;
			$this->data['rowData'][$ct]['file_display_name'] = $filesObj->file_display_name;
			$this->data['rowData'][$ct]['cover_img'] = '';
			$this->data['rowData'][$ct]['sort_num'] = $filesObj->file_sort_num;
			if(\Auth::user()->group_id!=3)
			{
				$this->data['rowData'][$ct]['assign_front'] = 'no';
				
				$frontend_files = DB::table('tb_frontend_container')->where('container_id',$filesObj->id)->where('container_type','file')->first();
				if(!empty($frontend_files))
				{
					$this->data['rowData'][$ct]['assign_front'] = 'yes';
				}
			}
			
			$exFtype = explode('/',$filesObj->file_type);
			if($exFtype[1]=="tiff")
			{
				$this->data['rowData'][$ct]['tiff_files'] = DB::table('tb_container_tiff_files')->where('file_id', $filesObj->id)->get();
			}
			$ct++;
		}
		
		/*print "<pre>";
		print_r($this->data['rowData']);
		die;*/		
		if(\Auth::user()->group_id!=3)
		{
			$spaceAllowed = \Auth::user()->storage_space;
			if($spaceAllowed==0){ $spaceAllowed = 1; }
			$usedSpaceBytes_temp = DB::table('tb_container_files');
			if(\Auth::user()->group_id==2)
			{
				$usedSpaceBytes_temp->where('user_id',$uid);
			}
			$usedSpaceBytes = $usedSpaceBytes_temp->sum('file_size');
			$usedSpaceMb = ($usedSpaceBytes/(1000*1000));
			$usedSpace = round($usedSpaceMb,2,PHP_ROUND_HALF_UP);
			$usedSpacePercentage = ($usedSpace*100)/$spaceAllowed;
		}
		
		$emp = DB::table('employee')->where('Status',1)->get();
		$this->data['crmusers'] = '';
		if(!empty($emp))
		{
			$this->data['crmusers'] = $emp;
		}
				
		if(isset($_REQUEST['show']) && trim($_REQUEST['show'])!="")
		{
			$showType = trim($_REQUEST['show']);
		}
		else
		{
			$showType = "thumb";
		}
		
		$this->data['showType'] = $showType;
		$this->data['tree'] = $this->fetchFolderTreeList('','','', $showType);
		$this->data['seloptions'] = $this->fetchFolderTreeOptions();
		$this->data['fid'] = '';
		$this->data['group'] = \Auth::user()->group_id;
		$sel_attributes = DB::table('tb_attributes')->where('attr_status',1);
		if(\Auth::user()->group_id==2 || \Auth::user()->group_id==3)
		{
			$sel_attributes->where('attr_permission',1);
		}
		$this->data['sel_attributes'] = $sel_attributes->get();
		
		$this->data['sel_tags'] = DB::table('tb_tags_manager')->where('tag_status',1)->get();
		
		$this->data['sel_designer'] = DB::table('tb_designers')->where('designer_status',1)->get();
		
		if(\Auth::user()->group_id!=3)
		{
			$this->data['allowStorage'] = $spaceAllowed;
			$this->data['usedStorage'] = $usedSpace;
			$this->data['usedStoragePerct'] = round($usedSpacePercentage,2,PHP_ROUND_HALF_UP);
		}
		
		$this->data['searchedkeyword'] = $keyword;
		
		return view('container.search',$this->data);
	}
	
	public function containerSearchAjax( Request $request)
	{
		
		$record_per_page = 50;
		$page_number = 1;
		if(isset($_GET['page'])){
			$page_number = $_GET['page'];
		}

		if($this->access['is_view'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
		$uid = \Auth::user()->id;
		
		$keyword = trim($request->input('searchkeyword'));
		
		$filter = " AND (display_name like '%".$keyword."%' or file_type like '%".$keyword."%' or title like '%".$keyword."%' or description like '%".$keyword."%')";
		if(\Auth::user()->group_id==3)
		{
			$filter .= " AND (id in (select folder_id from tb_permissions where user_id='".$uid."' and no_permission='0') or global_permission='1')";
		}
		if(\Auth::user()->group_id==2)
		{
			$filter .= " AND (user_id='".$uid."' or (user_id!='".$uid."' and global_permission='1'))";
		}
		$params = array(
			'params'	=> $filter,
			'page'=> $page_number,
			'limit' => $record_per_page
		);

		$params1 = array(
			'params'	=> $filter
		);
		// Get Query 
		$results = $this->model->getRows( $params );

		$resultsTotal = $this->model->getRows($params1 );
		
		$filess_temp = DB::table('tb_container_files')->where(function ($query) use ($keyword) { $query->where('file_name', 'like' ,'%'.$keyword.'%')->orWhere('file_type', 'like' ,'%'.$keyword.'%')->orWhere('file_title', 'like' ,'%'.$keyword.'%')->orWhere('file_description', 'like' ,'%'.$keyword.'%')->orWhere('file_display_name', 'like' ,'%'.$keyword.'%');});
		$filess_temp_full = DB::table('tb_container_files')->where(function ($query) use ($keyword) { $query->where('file_name', 'like' ,'%'.$keyword.'%')->orWhere('file_type', 'like' ,'%'.$keyword.'%')->orWhere('file_title', 'like' ,'%'.$keyword.'%')->orWhere('file_description', 'like' ,'%'.$keyword.'%')->orWhere('file_display_name', 'like' ,'%'.$keyword.'%');});
		if(\Auth::user()->group_id==2)
		{
			$filess_temp->where('user_id',$uid);
			$filess_temp_full->where('user_id',$uid);
		}
		$filess = $filess_temp->get();

		$filessTotal = $filess_temp_full->get();

		$totalRecord = $resultsTotal['total'] + count($filessTotal);
		$this->data['pagination']['total_folder'] = $totalRecord;
		$this->data['pagination']['total_page'] = ($totalRecord>0)?(ceil($totalRecord/$record_per_page)):0;
		$this->data['pagination']['current_page'] = $page_number;
		$this->data['pagination']['prev_page'] = ($page_number>0)?($page_number - 1):0;
		$this->data['pagination']['next_page'] = ($page_number>0)?($page_number + 1):0;
		$filess = array();
		if(count($results['rows'])<$record_per_page){
			if($resultsTotal['total']>0){
				$startOffset = 0;
				$limitFiles = count($results['rows']) - $record_per_page;
			}else{
				$startOffset = ($page_number - 1) * $record_per_page;
				$limitFiles = $record_per_page;
			}
			//$filess = $filess_temp->offset($startOffset)->limit($limitFiles)->get();
		}
	
		$ct=0; 
		$this->data['rowData'] = array();
		
		foreach($results['rows'] as $folderObj ){
			$totfiles = DB::table('tb_container_files')->select('id')->where('folder_id',$folderObj->id)->count();
			$totfolders = DB::table('tb_container')->select('id')->where('parent_id',$folderObj->id)->count();
			$frontend = DB::table('tb_frontend_container')->select('id')->where('container_id',$folderObj->id)->where('container_type','folder')->first();

			$this->data['rowData'][$ct]['id'] = $folderObj->id;
			$this->data['rowData'][$ct]['folder_id'] = $folderObj->id;
			$this->data['rowData'][$ct]['name'] = $folderObj->display_name;
			$this->data['rowData'][$ct]['ftype'] = 'folder';
			$this->data['rowData'][$ct]['imgsrc'] = '';
			$this->data['rowData'][$ct]['foldercount'] = $totfolders;
			$this->data['rowData'][$ct]['filecount'] = $totfiles;
			$this->data['rowData'][$ct]['tiff_files'] = '';
			$this->data['rowData'][$ct]['title'] = $folderObj->title;
			$this->data['rowData'][$ct]['description'] = $folderObj->description;
			$this->data['rowData'][$ct]['file_display_name'] = '';
			$this->data['rowData'][$ct]['cover_img'] = $folderObj->cover_img;
			$this->data['rowData'][$ct]['sort_num'] = $folderObj->sort_num;
			$this->data['rowData'][$ct]['assign_front'] = 'no';
			if(!empty($frontend))
			{
				$this->data['rowData'][$ct]['assign_front'] = 'yes';
			}
			$ct++;
		}
		
		foreach($filess as $filesObj ){
			$this->data['rowData'][$ct]['id'] = $filesObj->id;
			$this->data['rowData'][$ct]['folder_id'] = $filesObj->folder_id;
			$this->data['rowData'][$ct]['name'] = $filesObj->file_name;
			$this->data['rowData'][$ct]['ftype'] = 'file';
			$imgsrc = $this->getThumbpath($filesObj->folder_id);
			$this->data['rowData'][$ct]['imgsrc'] = $imgsrc;
			$this->data['rowData'][$ct]['filecount'] = '';
			$this->data['rowData'][$ct]['foldercount'] = '';
			$this->data['rowData'][$ct]['tiff_files'] = '';
			$this->data['rowData'][$ct]['title'] = $filesObj->file_title;
			$this->data['rowData'][$ct]['description'] = $filesObj->file_description;
			$this->data['rowData'][$ct]['file_display_name'] = $filesObj->file_display_name;
			$this->data['rowData'][$ct]['cover_img'] = '';
			$this->data['rowData'][$ct]['sort_num'] = $filesObj->file_sort_num;
			if(\Auth::user()->group_id!=3)
			{
				$this->data['rowData'][$ct]['assign_front'] = 'no';
				
				$frontend_files = DB::table('tb_frontend_container')->where('container_id',$filesObj->id)->where('container_type','file')->first();
				if(!empty($frontend_files))
				{
					$this->data['rowData'][$ct]['assign_front'] = 'yes';
				}
			}
			
			$exFtype = explode('/',$filesObj->file_type);
			if($exFtype[1]=="tiff")
			{
				$this->data['rowData'][$ct]['tiff_files'] = DB::table('tb_container_tiff_files')->where('file_id', $filesObj->id)->get();
			}
			$ct++;
		}
		
		
				
		if(isset($_REQUEST['show']) && trim($_REQUEST['show'])!="")
		{
			$showType = trim($_REQUEST['show']);
		}
		else
		{
			$showType = "thumb";
		}
		$this->data['group'] = \Auth::user()->group_id;
		$this->data['showType'] = $showType;
		
		$this->data['searchedkeyword'] = $keyword;
		
		return view('container.search_ajax',$this->data);
	}
	
	function assignTagsFile(Request $request)
	{
		$uid = \Auth::user()->id;
		$rules = array(
			'selTag' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) 
		{
			$fileId = $request->input('file_id');
			$tag_sel = $request->input('selTag');
			if(!empty($tag_sel))
			{
				foreach($tag_sel as $selectedTag)
				{
					$check_tag = DB::table('tb_container_tags')->where('container_id', $fileId)->where('container_type', 'file')->where('tag_id', $selectedTag)->count();
					if($check_tag==0)
					{
						$tdata['user_id'] = $uid;
						$tdata['tag_id'] = $selectedTag;
						$tdata['container_id'] = $fileId;
						$tdata['container_type'] = 'file';
						$tdata['created'] = date('Y-m-d h:i:s');
						$con_attr_id = \DB::table('tb_container_tags')->insertGetId($tdata);
					}
					
				}
			}
			
			return Redirect::to(Input::get('curnurl'))->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
		}
		else
		{
			return Redirect::to(Input::get('curnurl'))->with('messagetext','Please select Tag(s) first')->with('msgstatus','error');
		}
	}
	
	function seletedFrontendSlider()
	{
		$uid = \Auth::user()->id;
		$items = Input::get('selectedfiles');
		$folder = Input::get('fold_id');
		if($items!='')
		{
			DB::table('tb_frontend_container_slider')->where('folder_id', $folder)->delete();
			$comsep = explode(',',$items);
			foreach($comsep as $sepr)
			{
				$undsep = explode('-',$sepr);
				if($undsep[0]=='folder')
				{
				}
				if($undsep[0]=='file')
				{
					$stdata['user_id'] = $uid;
					$stdata['file_id'] = $undsep[1];
					$stdata['folder_id'] = $folder;
					$stdata['created'] = date('Y-m-d h:i:s');
					DB::table('tb_frontend_container_slider')->insertGetId($stdata);
				}
			}
			return Redirect::to(Input::get('curnurl'))->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
		}
		else
		{
			return Redirect::to(Input::get('curnurl'))->with('messagetext','Please Select Files First.')->with('msgstatus','error');
		}
	}
	
	public function create_slider_variant_folders(Request $request)
	{
		if(\Auth::check() == true)
        {
			$foldVal = trim(Input::get('folder'));
			if($foldVal!="")
			{
				$dirPath = $this->getContainerUserPath(Input::get('fold_id'));
				$slug = \SiteHelpers::seoUrl( $foldVal);
				if( is_dir($dirPath.$foldVal) === false )
				{
					$result = File::makeDirectory($dirPath.$slug, 0777, true);
					$exists = DB::table('tb_container')->where('parent_id', Input::get('fold_id'))->where('name', $foldVal)->count();
					if($exists==0)
					{
						$data['parent_id'] = Input::get('fold_id');
						$data['name'] = $slug;
						$data['display_name'] = $foldVal;
						$data['file_type'] = 'folder';
						if(\Auth::user()->group_id!=3)
						{
							$data['user_id'] = \Auth::user()->id;
						}
						else
						{
							$data['child_id'] = \Auth::user()->id;
							$data['user_id'] = Input::get('administrator_id');
						}
						$data['created'] = date('y-m-d h:i:s');
						$fldid = $this->model->insertRow($data , Input::get('id'));
						if(\Auth::user()->group_id==3)
						{
							$pdata['user_id'] = \Auth::user()->id;
							$pdata['folder_id'] = $fldid;
							$pdata['inherit'] = 0;
							$pdata['no_permission'] = 0;
							$pdata['view'] = 1;
							$pdata['download'] = 1;
							$pdata['upload'] = 1;
							$pdata['delete'] = 1;
							$pdata['created'] = date('y-m-d h:i:s');
							\DB::table('tb_permissions')->insert($pdata);
						}
					}
				}
				
				return Redirect::to(Input::get('curnurl'))->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
			}
			else
			{
				return Redirect::to(Input::get('curnurl'))->with('messagetext','Enter Folder Name.')->with('msgstatus','error');
			}
		}
		else
		{
			return Redirect::to('user/login');
		}
	}
	
	function landingPageProducts(Request $request)
	{
		$uid = \Auth::user()->id;
		$rules = array(
			'selecteditems' => 'required',
			'product_pos' => 'required',
			'product_message' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) 
		{
			$items = Input::get('selecteditems');
			$folder = Input::get('fold_id');
			$pos = Input::get('product_pos');
			if($items!='')
			{
				$comsep = explode(',',$items);
				foreach($comsep as $sepr)
				{
					$undsep = explode('-',$sepr);
					if($undsep[0]=='folder')
					{
						$ldata['container_id'] = $undsep[1];
						break;
					}
					if($undsep[0]=='file')
					{
					}
				}
				
				$ldata['user_id'] = $uid;
				$ldata['product_pos'] = $pos;
				$ldata['product_title'] = trim(Input::get('product_title'));
				$ldata['product_desc'] = trim(Input::get('product_desc'));
				$ldata['product_url'] = trim(Input::get('product_url'));
				$ldata['product_message'] = trim(Input::get('product_message'));
				if(!is_null(Input::file('product_img')))
				{
					$file = Input::file('product_img'); 
					$destinationPath = './uploads/folder_cover_imgs/';
					$filename = $file->getClientOriginalName();
					$extension = $file->getClientOriginalExtension(); //if you need extension of the file
					$newfilename = rand(11111111, 99999999).'-'.rand(11111111, 99999999).'.'.$extension;
					$uploadSuccess = $file->move($destinationPath, $newfilename);
					if( $uploadSuccess ) {
						$ldata['product_img'] = $newfilename;
					}
				}
				
				$get_prod = DB::table('tb_landing_product')->where('product_pos', $pos)->first();
				if(!empty($get_prod))
				{
					$ldata['updated'] = date('Y-m-d');
					DB::table('tb_landing_product')->where('id', $get_prod->id)->update($ldata);
				}
				else
				{
					$ldata['created'] = date('Y-m-d');
					DB::table('tb_landing_product')->insertGetId($ldata);
				}
				
				
				return Redirect::to(Input::get('curnurl'))->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
			}
			else
			{
				return Redirect::to(Input::get('curnurl'))->with('messagetext','Please Select Product First.')->with('msgstatus','error');
			}
		}
		else
		{
			return Redirect::to(Input::get('curnurl'))->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
			->withErrors($validator)->withInput();
		}
	}
	
	function seletedfilesActivatelightbox(Request $request)
	{
		$uid = \Auth::user()->id;
		$items = Input::get('selectedfiles');
		if($items!='')
		{
			$comsep = explode(',',$items);
			foreach($comsep as $sepr)
			{
				$undsep = explode('-',$sepr);
				if($undsep[0]=='folder')
				{					
				}
				if($undsep[0]=='file')
				{
					$check_file = DB::table('tb_frontend_lightbox')->where('container_id', $undsep[1])->where('container_type', 'file')->first();
					if(empty($check_file))
					{
						$fldata['user_id'] = $uid;
						$fldata['container_id'] = $undsep[1];
						$fldata['container_type'] = 'file';
						$fldata['created'] = date('Y-m-d h:i:s');
						\DB::table('tb_frontend_lightbox')->insertGetId($fldata);
					}
				}
			}
			return Redirect::to(Input::get('curnurl'))->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
		}
		else
		{
			return Redirect::to(Input::get('curnurl'))->with('messagetext','Please Select Folders/Files First.')->with('msgstatus','error');
		}
	}
	
	function seletedfilesDeactivatelightbox(Request $request)
	{
		$uid = \Auth::user()->id;
		$items = Input::get('selectedfiles');
		if($items!='')
		{
			$comsep = explode(',',$items);
			foreach($comsep as $sepr)
			{
				$undsep = explode('-',$sepr);
				if($undsep[0]=='folder')
				{
					
				}
				if($undsep[0]=='file')
				{
					$check_file = DB::table('tb_frontend_lightbox')->where('container_id', $undsep[1])->where('container_type', 'file')->first();
					if(!empty($check_file))
					{
						DB::table('tb_frontend_lightbox')->where('container_id', $undsep[1])->where('container_type', 'file')->delete();
					}
				}
			}
			return Redirect::to(Input::get('curnurl'))->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
		}
		else
		{
			return Redirect::to(Input::get('curnurl'))->with('messagetext','Please Select Folders/Files First.')->with('msgstatus','error');
		}
	}
	
	function ActivateDeactivateProductLightbox(Request $request)
	{
		$uid = \Auth::user()->id;
		$item = Input::get('cont_id');
		$action = Input::get('action');
		if($item!='' && $item>0)
		{
			$check_file = DB::table('tb_frontend_lightbox')->where('container_id', $item)->where('container_type', 'file')->first();
			if($action==0)
			{
				if(empty($check_file))
				{
					$file = DB::table('tb_container_files')->where('id', $item)->first();
					$fldata['user_id'] = $uid;
					$fldata['container_id'] = $item;
					$fldata['container_type'] = 'file';
					$fldata['created'] = date('Y-m-d h:i:s');
					\DB::table('tb_frontend_lightbox')->insertGetId($fldata);
				}
			}
			elseif($action==1)
			{
				if(!empty($check_file))
				{
					DB::table('tb_frontend_lightbox')->where('container_id', $item)->where('container_type', 'file')->delete();
				}
			}
			echo 'success';
		}
		else
		{
			echo 'error';
		}
	}
	
	public function lightboxAddcontentsContainer(Request $request)
	{
		$rep = array();
		$lid = $request->input('lightboxId');
		$lfileArr = $request->input('fileId');
		$lfiles = explode(',',$lfileArr);
		if($lfileArr!='')
		{
			foreach($lfiles as $lfile)
			{
				$lfileid = $lfiles = explode('-',$lfile);
				$l=1;
				$uid = \Auth::user()->id;
				$check_light = \DB::table('tb_lightbox')->where('id', $lid)->count();
				if($check_light>0)
				{
					$lightcontent['lightbox_id'] = $lid;
					$lightcontent['file_id'] = $lfileid[1];
					$lightcontent['user_id'] = $uid;
					$lightcontent['created'] = date('Y-m-d h:i:s');
					$content_id[] = \DB::table('tb_lightbox_content')->insertGetId($lightcontent);
				}
				else
				{
					$rep['status'] = 'error';
					$rep['errors'] = 'lightbox not found';
					return json_encode($rep);
				}
			}
			
			$fetch_lightcontent = \DB::table('tb_lightbox_content')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_lightbox_content.file_id')->select('tb_lightbox_content.*', 'tb_container_files.file_name', 'tb_container_files.folder_id', 'tb_container_files.file_display_name', 'tb_container_files.file_title')->whereIn('tb_lightbox_content.id', $content_id)->get();
			$rep['status'] = 'success';
			$rep['lightboxcontent'] = $fetch_lightcontent;
			return json_encode($rep);
		}
		else{
			$rep['status'] = 'error';
			$rep['errors'] = 'please select files first.';
			return json_encode($rep);
		}
	}
	
	function assignPdfImage()
	{
		$uid = \Auth::user()->id;
		$items = Input::get('selecteditems');
		if($items!='')
		{
			$comsep = explode(',',$items);
			foreach($comsep as $sepr)
			{
				$undsep = explode('-',$sepr);
				if($undsep[0]=='file')
				{
					if(!is_null(Input::file('pdf_img')))
					{
						$file = Input::file('pdf_img'); 
						$destinationPath = './uploads/pdf_imgs/';
						$filename = $file->getClientOriginalName();
						$extension = $file->getClientOriginalExtension(); //if you need extension of the file
						$newfilename = rand(1111111, 9999999).'-'.rand(1111111, 9999999).'.'.$extension;
						$uploadSuccess = $file->move($destinationPath, $newfilename);
						
						// image for icon
						$bkimg = \Image::make($destinationPath.$newfilename);
						$bkimg->resize(240, 240);
						$bkimgfile = 'thumb_'. $newfilename;
						$bkimg->save($destinationPath.$bkimgfile);
						
						// image for pdf icon small
						$sbkimg = \Image::make($destinationPath.$newfilename);
						$sbkimg->resize(148, 197);
						$sbkimgfile = 'smallthumb_'. $newfilename;
						$sbkimg->save($destinationPath.$sbkimgfile);
						
						
						if( $uploadSuccess ) {
							$check_img = DB::table('td_pdf_images')->where('file_id', $undsep[1])->first();
							
							$pdfdata['user_id'] = $uid;
							$pdfdata['file_id'] = $undsep[1];
							$pdfdata['image_name'] = $newfilename;
							if(!empty($check_img))
							{
								$pdfdata['updated'] = date('Y-m-d h:i:s');
								DB::table('td_pdf_images')->where('id', $check_img->id)->update($pdfdata);
							}
							else
							{
								$pdfdata['created'] = date('Y-m-d h:i:s');
								DB::table('td_pdf_images')->insert($pdfdata);
							}
						}
					}
					else
					{
						return Redirect::to(Input::get('curnurl'))->with('messagetext','Please select image for upload first.')->with('msgstatus','error');
					}
				}
				if($undsep[0]=='folder')
				{
					
				}
			}
			return Redirect::to(Input::get('curnurl'))->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
		}
		else
		{
			return Redirect::to(Input::get('curnurl'))->with('messagetext','Please Select Folders/Files First.')->with('msgstatus','error');
		}
	}
	
	function assign_landing_products()
	{
		$uid = \Auth::user()->id;
		$items = Input::get('selectedfiles');
		if($items!='')
		{
			$comsep = explode(',',$items);
			foreach($comsep as $sepr)
			{
				$undsep = explode('-',$sepr);
				if($undsep[0]=='folder')
				{
					$check_fold = DB::table('tb_landing_container')->where('container_id', $undsep[1])->where('container_type', 'folder')->first();
					if(empty($check_fold))
					{
						$ftdata['user_id'] = $uid;
						$ftdata['container_id'] = $undsep[1];
						$ftdata['container_type'] = 'folder';
						$ftdata['created'] = date('Y-m-d h:i:s');
						\DB::table('tb_landing_container')->insertGetId($ftdata);
					}
				}
			}
			return Redirect::to(Input::get('curnurl'))->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
		}
		else
		{
			return Redirect::to(Input::get('curnurl'))->with('messagetext','Please Select Categories First.')->with('msgstatus','error');
		}
	}

	public function getFoldersAjax( $id = 0, $wnd = '' )
	{
		$record_per_page = 50;
		$page_number = 1;
		if(isset($_GET['page'])){
			$page_number = $_GET['page'];
		}
		
		if($this->access['is_view'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
		$uid = \Auth::user()->id;
		
		$filter = " AND parent_id='".$id."'";
		if(\Auth::user()->group_id==3 && $wnd!='iframe')
		{
			$filter .= " AND (id in (select folder_id from tb_permissions where user_id='".$uid."' and no_permission='0') or global_permission='1')";
		}
		if(\Auth::user()->group_id==2 && $wnd!='iframe')
		{
			//$filter .= " AND (user_id='".$uid."' or (user_id!='".$uid."' and global_permission='1'))";
		}
		$params = array(
			'params'	=> $filter,
			'page'=> $page_number,
			'limit' => $record_per_page
		);

		$params1 = array(
			'params'	=> $filter
		);
		// Get Query 
		$results = $this->model->getRows( $params );

		$resultsTotal = $this->model->getRows($params1 );


		
		$foldername = DB::table('tb_container')->where('id',$id);
		$this->data['foldername'] = $foldername->select('display_name','parent_id','user_id', 'global_permission', 'title', 'description','display_name_eng','title_eng','description_eng')->first();
		
		$this->data['parentArr'] = array_reverse($this->fetchFolderParentListArray($id));

		$filess_temp = DB::table('tb_container_files')->select('id','file_name','folder_id','file_title','file_description','file_display_name','file_sort_num','file_type')->where('folder_id',$id);
		$filess_temp_full = DB::table('tb_container_files')->select('id')->where('folder_id',$id);
		
		if(\Auth::user()->group_id==2 && (!empty($this->data['foldername'] && $this->data['foldername']->global_permission==0)) && $wnd!='iframe')
		{
			//$filess_temp->where('user_id',$uid);
		}
		$filessTotal = $filess_temp_full->get();

		$totalRecord = $resultsTotal['total'] + count($filessTotal);
		$this->data['pagination']['total_folder'] = $totalRecord;
		$this->data['pagination']['total_page'] = ($totalRecord>0)?(ceil($totalRecord/$record_per_page)):0;
		$this->data['pagination']['current_page'] = $page_number;
		$this->data['pagination']['prev_page'] = ($page_number>0)?($page_number - 1):0;
		$this->data['pagination']['next_page'] = ($page_number>0)?($page_number + 1):0;
		$filess = array();
		if(count($results['rows'])<$record_per_page){
			if($resultsTotal['total']>0){
				$startOffset = 0;
				$limitFiles = count($results['rows']) - $record_per_page;
			}else{
				$startOffset = ($page_number - 1) * $record_per_page;
				$limitFiles = $record_per_page;
			}
			$filess = $filess_temp->get();
		}


		$ct=0; 
		$this->data['rowData'] = array();
		
		foreach($results['rows'] as $folderObj ){
			if($wnd=='iframe')
			{
				/*$childs = $this->fetchFolderChildListIds(30);
				if($folderObj->id==30 || in_array($folderObj->id,$childs))
				{*/
					$totfiles = DB::table('tb_container_files')->select('id')->where('folder_id',$folderObj->id)->count();
					$totfolders = DB::table('tb_container')->select('id')->where('parent_id',$folderObj->id)->count();
					$this->data['rowData'][$ct]['id'] = $folderObj->id;
					$this->data['rowData'][$ct]['name'] = $folderObj->display_name;
					$this->data['rowData'][$ct]['ftype'] = 'folder';
					$this->data['rowData'][$ct]['imgsrc'] = '';
					$this->data['rowData'][$ct]['foldercount'] = $totfolders;
					$this->data['rowData'][$ct]['filecount'] = $totfiles;
					$this->data['rowData'][$ct]['tiff_files'] = '';
					$this->data['rowData'][$ct]['title'] = $folderObj->title;
					$this->data['rowData'][$ct]['description'] = $folderObj->description;
					$this->data['rowData'][$ct]['file_display_name'] = '';
					$this->data['rowData'][$ct]['cover_img'] = $folderObj->cover_img;
					$this->data['rowData'][$ct]['sort_num'] = $folderObj->sort_num;
					$this->data['rowData'][$ct]['imgpath'] = '';
					$this->data['rowData'][$ct]['hotel_help_update'] = $folderObj->hotel_help_update;
					$ct++;
				//}
			}
			else
			{
				$totfiles = DB::table('tb_container_files')->select('id')->where('folder_id',$folderObj->id)->count();
				$totfolders = DB::table('tb_container')->select('id')->where('parent_id',$folderObj->id)->count();
				$frontend = DB::table('tb_frontend_container')->select('id')->where('container_id',$folderObj->id)->where('container_type','folder')->first();
				$this->data['rowData'][$ct]['id'] = $folderObj->id;
				$this->data['rowData'][$ct]['name'] = $folderObj->display_name;
				$this->data['rowData'][$ct]['ftype'] = 'folder';
				$this->data['rowData'][$ct]['imgsrc'] = '';
				$this->data['rowData'][$ct]['foldercount'] = $totfolders;
				$this->data['rowData'][$ct]['filecount'] = $totfiles;
				$this->data['rowData'][$ct]['tiff_files'] = '';
				$this->data['rowData'][$ct]['title'] = $folderObj->title;
				$this->data['rowData'][$ct]['description'] = $folderObj->description;
				$this->data['rowData'][$ct]['file_display_name'] = '';
				$this->data['rowData'][$ct]['sort_num'] = $folderObj->sort_num;
				$this->data['rowData'][$ct]['assign_front'] = 'no';
				$this->data['rowData'][$ct]['assign_lightbox'] = 'no';
				$this->data['rowData'][$ct]['hotel_help_update'] = $folderObj->hotel_help_update;
				if(!empty($frontend))
				{
					$this->data['rowData'][$ct]['assign_front'] = 'yes';
				}
				
				if($folderObj->cover_img=="" && $folderObj->temp_cover_img=="")
				{
					$default_front_design = \DB::table('tb_settings')->select('content')->where('key_value', 'frontend_design')->first();
					
					// Set main image first image in folder
					$checkfile = DB::table('tb_container_files')->select('file_name')->where('folder_id', $folderObj->id)->where(function ($query) { $query->where('file_type', 'image/jpeg')->orWhere('file_type', 'image/png')->orWhere('file_type', 'image/gif');})->orderBy('file_sort_num', 'asc')->first();
					if(!empty($checkfile))
					{
						$destinationPath = $this->getContainerUserPath($folderObj->id);
						$copytofolder = public_path().'/uploads/folder_cover_imgs/';
						$find_prd=false;
						$this->data['rowData'][$ct]['cover_img'] = '';
						$fileName = $checkfile->file_name;
													
						$find_actualsize = getimagesize($destinationPath.$fileName);
						if($find_actualsize[0]>$find_actualsize[1])
						{
							// image for backend
							if (! \File::exists($copytofolder.'thumb_'.$fileName))
							{
								$bkimg = \Image::make($destinationPath.$fileName);
								$bkimg->resize(128, 130);
								$bkimgfile = 'thumb_'. $fileName;
								$bkimg->save($copytofolder.$bkimgfile);
							}
							
							if (! \File::exists($copytofolder.'format_'.$fileName))
							{
								$mdimg = \Image::make($destinationPath.$fileName);
								$thactualsize = getimagesize($destinationPath.$fileName);
								if($thactualsize[0]>$thactualsize[1])
								{
									$mdimg->resize(320, null, function ($constraint) {
										$constraint->aspectRatio();
									});
								}
								else
								{
									$mdimg->resize(null, 320, function ($constraint) {
										$constraint->aspectRatio();
									});
								}
								$thumbfile = 'format_'.$fileName;
								$mdimg->save($copytofolder.$thumbfile);
							}
							
							$tcmdata['temp_cover_img'] = $fileName;
							$tcmdata['updated'] = date('y-m-d');
							DB::table('tb_container')->where('id', $folderObj->id)->update($tcmdata);
							
							if(!empty($default_front_design) && $default_front_design->content=="grid")
							{
								$this->data['rowData'][$ct]['cover_img'] = $fileName;
							}
							$find_prd=true;
						}
					}
					else{
						$this->data['rowData'][$ct]['cover_img'] = '';
					}
				}
				else
				{
					$this->data['rowData'][$ct]['cover_img'] = ($folderObj->cover_img!='') ? $folderObj->cover_img : $folderObj->temp_cover_img ;
				}
				
				$ct++;
			}
			
		}

		if(!empty($filess))
		{
			$imgsrc = $this->getThumbpath($filess[0]->folder_id);
			$imgpath = $this->getContainerUserPath($filess[0]->folder_id);
			if(\Auth::user()->group_id!=3 || (!empty($this->data['foldername'] && $this->data['foldername']->global_permission==1)) || $wnd=='iframe')
			{
				foreach($filess as $filesObj ){
					$this->data['rowData'][$ct]['id'] = $filesObj->id;
					$this->data['rowData'][$ct]['name'] = $filesObj->file_name;
					$this->data['rowData'][$ct]['ftype'] = 'file';
					$this->data['rowData'][$ct]['imgsrc'] = $imgsrc;
					$this->data['rowData'][$ct]['filecount'] = '';
					$this->data['rowData'][$ct]['foldercount'] = '';
					$this->data['rowData'][$ct]['tiff_files'] = '';
					$this->data['rowData'][$ct]['title'] = $filesObj->file_title;
					$this->data['rowData'][$ct]['description'] = $filesObj->file_description;
					$this->data['rowData'][$ct]['file_display_name'] = $filesObj->file_display_name;
					$this->data['rowData'][$ct]['cover_img'] = '';
					$this->data['rowData'][$ct]['sort_num'] = $filesObj->file_sort_num;
					$this->data['rowData'][$ct]['assign_front'] = 'no';
					$this->data['rowData'][$ct]['imgpath'] = $imgpath;
					$this->data['rowData'][$ct]['assign_lightbox'] = 'no';
					$this->data['rowData'][$ct]['hotel_help_update'] = '';
					
					$frontend_files = DB::table('tb_frontend_container')->select('id')->where('container_id',$filesObj->id)->where('container_type','file')->first();
					if(!empty($frontend_files))
					{
						$this->data['rowData'][$ct]['assign_front'] = 'yes';
					}
					$frontend_lightbox = DB::table('tb_frontend_lightbox')->select('id')->where('container_id',$filesObj->id)->where('container_type','file')->first();
					if(!empty($frontend_lightbox))
					{
						$this->data['rowData'][$ct]['assign_lightbox'] = 'yes';
					}
					
					$exFtype = explode('/',$filesObj->file_type);
					if($exFtype[1]=="tiff")
					{
						$this->data['rowData'][$ct]['tiff_files'] = DB::table('tb_container_tiff_files')->select('id','file_name')->where('file_id', $filesObj->id)->get();
					}
					if($exFtype[0]=="image")
					{
						if (!File::exists(public_path(). '/uploads/thumbs/thumb_'.$filesObj->folder_id.'_'.$filesObj->file_name))
						{
							$mdimg = \Image::make($imgpath.$filesObj->file_name);
							$mdimg->resize(128, 130);
							$thumbfile = 'thumb_'.$filesObj->folder_id.'_'.$filesObj->file_name;
							$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
						}
						
						if (!File::exists(public_path(). '/uploads/thumbs/format_'.$filesObj->folder_id.'_'.$filesObj->file_name))
						{
							$mdimg = \Image::make($imgpath.$filesObj->file_name);
							$actualsize = getimagesize($imgpath.$filesObj->file_name);
							if($actualsize[0]>$actualsize[1])
							{
								$mdimg->resize(320, null, function ($constraint) {
									$constraint->aspectRatio();
								});
							}
							else
							{
								$mdimg->resize(null, 320, function ($constraint) {
									$constraint->aspectRatio();
								});
							}
							$thumbfile = 'format_'.$filesObj->folder_id.'_'.$filesObj->file_name;
							$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
						}
						if (!File::exists(public_path(). '/uploads/thumbs/highflip_'.$filesObj->folder_id.'_'.$filesObj->file_name))
						{
							$mdimg = \Image::make($imgpath.$filesObj->file_name);
							$actualsize = getimagesize($imgpath.$filesObj->file_name);
							if($actualsize[0]>$actualsize[1])
							{
								$mdimg->resize(1000, null, function ($constraint) {
									$constraint->aspectRatio();
								});
							}
							else
							{
								$mdimg->resize(null, 1000, function ($constraint) {
									$constraint->aspectRatio();
								});
							}
							$thumbfile = 'highflip_'.$filesObj->folder_id.'_'.$filesObj->file_name;
							$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
						}
					}
					
					// delete landing_info view
					if( File::exists(public_path() . '/uploads/thumbs/landing_info_'. $filesObj->folder_id.'_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/thumbs/landing_info_'. $filesObj->folder_id.'_'.$filesObj->file_name);
					}
					
					// delete front_slider view
					if( File::exists(public_path() . '/uploads/thumbs/front_slider_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/thumbs/front_slider_'.$filesObj->file_name);
					}
					
					// delete product_detail_list 
					if( File::exists(public_path() . '/uploads/thumbs/product_detail_list_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/thumbs/product_detail_list_'.$filesObj->file_name);
					}
					
					// delete product file
					if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name);
					}
					
					// delete material file
					if( File::exists(public_path() . '/uploads/folder_cover_imgs/material_file_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/folder_cover_imgs/material_file_'.$filesObj->file_name);
					}
					
					// delete masonry_product_file
					if( File::exists(public_path() . '/uploads/folder_cover_imgs/masonry_product_file_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/folder_cover_imgs/masonry_product_file_'.$filesObj->file_name);
					}
					
					// delete product file
					if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name);
					}
					
					// delete folder cover front file
					if( File::exists(public_path() . '/uploads/folder_cover_imgs/front_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/folder_cover_imgs/front_'.$filesObj->file_name);
					}
					
					// delete folder cover product file
					if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/folder_cover_imgs/product_'.$filesObj->file_name);
					}
					
					// delete folder cover masonry_product file
					if( File::exists(public_path() . '/uploads/folder_cover_imgs/masonry_product_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/folder_cover_imgs/masonry_product_'.$filesObj->file_name);
					}
					
					// delete folder cover product_detail_cover file
					if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_detail_cover_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/folder_cover_imgs/product_detail_cover_'.$filesObj->file_name);
					}
					$ct++;
				}
			}
			else{
				$selfiles = DB::table('tb_permissions')->select('view','inherit')->where('folder_id',$id)->where('user_id',$uid)->first();
				if(!empty($selfiles))
				{
					if($selfiles->view==1 || $selfiles->inherit==1)
					{
						foreach($filess as $filesObj ){
							$this->data['rowData'][$ct]['id'] = $filesObj->id;
							$this->data['rowData'][$ct]['name'] = $filesObj->file_name;
							$this->data['rowData'][$ct]['ftype'] = 'file';
							$this->data['rowData'][$ct]['imgsrc'] = $imgsrc;
							$this->data['rowData'][$ct]['filecount'] = '';
							$this->data['rowData'][$ct]['foldercount'] = '';
							$this->data['rowData'][$ct]['tiff_files'] = '';
							$this->data['rowData'][$ct]['title'] = $filesObj->file_title;
							$this->data['rowData'][$ct]['description'] = $filesObj->file_description;
							$this->data['rowData'][$ct]['file_display_name'] = $filesObj->file_display_name;
							$this->data['rowData'][$ct]['cover_img'] = '';
							$this->data['rowData'][$ct]['sort_num'] = $filesObj->file_sort_num;
							$this->data['rowData'][$ct]['hotel_help_update'] = '';
							
							$exFtype = explode('/',$filesObj->file_type);
							if($exFtype[1]=="tiff")
							{
								$this->data['rowData'][$ct]['tiff_files'] = DB::table('tb_container_tiff_files')->select('id','file_name')->where('file_id', $filesObj->id)->get();
							}
							if($exFtype[0]=="image")
							{
								if (!File::exists(public_path(). '/uploads/thumbs/thumb_'.$filesObj->folder_id.'_'.$filesObj->file_name))
								{
									$mdimg = \Image::make($imgpath.$filesObj->file_name);
									$mdimg->resize(128, 130);
									$thumbfile = 'thumb_'.$filesObj->folder_id.'_'.$filesObj->file_name;
									$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
								}
								
								if (!File::exists(public_path(). '/uploads/thumbs/format_'.$filesObj->folder_id.'_'.$filesObj->file_name))
								{
									$mdimg = \Image::make($imgpath.$filesObj->file_name);
									$actualsize = getimagesize($imgpath.$filesObj->file_name);
									if($actualsize[0]>$actualsize[1])
									{
										$mdimg->resize(320, null, function ($constraint) {
											$constraint->aspectRatio();
										});
									}
									else
									{
										$mdimg->resize(null, 320, function ($constraint) {
											$constraint->aspectRatio();
										});
									}
									$thumbfile = 'format_'.$filesObj->folder_id.'_'.$filesObj->file_name;
									$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
								}
								if (!File::exists(public_path(). '/uploads/thumbs/highflip_'.$filesObj->folder_id.'_'.$filesObj->file_name))
								{
									$mdimg = \Image::make($imgpath.$filesObj->file_name);
									$actualsize = getimagesize($imgpath.$filesObj->file_name);
									if($actualsize[0]>$actualsize[1])
									{
										$mdimg->resize(1000, null, function ($constraint) {
											$constraint->aspectRatio();
										});
									}
									else
									{
										$mdimg->resize(null, 1000, function ($constraint) {
											$constraint->aspectRatio();
										});
									}
									$thumbfile = 'highflip_'.$filesObj->folder_id.'_'.$filesObj->file_name;
									$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
								}
							}
							
							// delete landing_info view
							if( File::exists(public_path() . '/uploads/thumbs/landing_info_'. $filesObj->folder_id.'_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/thumbs/landing_info_'. $filesObj->folder_id.'_'.$filesObj->file_name);
							}
							
							// delete front_slider view
							if( File::exists(public_path() . '/uploads/thumbs/front_slider_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/thumbs/front_slider_'.$filesObj->file_name);
							}
							
							// delete product_detail_list 
							if( File::exists(public_path() . '/uploads/thumbs/product_detail_list_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/thumbs/product_detail_list_'.$filesObj->file_name);
							}
							
							// delete product file
							if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name);
							}
							
							// delete material file
							if( File::exists(public_path() . '/uploads/folder_cover_imgs/material_file_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/folder_cover_imgs/material_file_'.$filesObj->file_name);
							}
							
							// delete masonry_product_file
							if( File::exists(public_path() . '/uploads/folder_cover_imgs/masonry_product_file_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/folder_cover_imgs/masonry_product_file_'.$filesObj->file_name);
							}
							
							// delete product file
							if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name);
							}
							
							// delete folder cover front file
							if( File::exists(public_path() . '/uploads/folder_cover_imgs/front_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/folder_cover_imgs/front_'.$filesObj->file_name);
							}
							
							// delete folder cover product file
							if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/folder_cover_imgs/product_'.$filesObj->file_name);
							}
							
							// delete folder cover masonry_product file
							if( File::exists(public_path() . '/uploads/folder_cover_imgs/masonry_product_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/folder_cover_imgs/masonry_product_'.$filesObj->file_name);
							}
							
							// delete folder cover product_detail_cover file
							if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_detail_cover_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/folder_cover_imgs/product_detail_cover_'.$filesObj->file_name);
							}
							$ct++;
						}
					}
				}
			}
		}
		//print "<pre>";
		//print_r($this->data['rowData']);
		if(!empty($this->data['rowData']))
		{
			usort($this->data['rowData'], function($a, $b) {
				return $a['sort_num'] - $b['sort_num']; 
			});
		}
		
		$subfoldertotal = DB::table('tb_container')->select('id')->where('parent_id',$id);
		$this->data['subfoldertotal'] = $subfoldertotal->count();
				
		$subfilestotal = DB::table('tb_container_files')->select('id')->where('folder_id',$id);
				$this->data['subfilestotal'] = $subfilestotal->count();
		
		$subfileBytes_temp = DB::table('tb_container_files')->where('folder_id',$id);
		$subfileBytes = $subfileBytes_temp->sum('file_size');
		
		$subfileMb = ($subfileBytes/(1000*1000));
		$this->data['subfileSpace'] = round($subfileMb,2,PHP_ROUND_HALF_UP);
		
		
		if(isset($_REQUEST['show']) && trim($_REQUEST['show'])!="")
		{
			$showType = trim($_REQUEST['show']);
		}
		else
		{
			$showType = "thumb";
		}
		
		$this->data['showType'] = $showType;
		$this->data['parent_tags'] = (new TagmanagerController)->fetchTagTree();
		$this->data['fid'] = $id;
		$this->data['group'] = \Auth::user()->group_id;
		
		$sel_attributes = DB::table('tb_attributes')->where('attr_status',1);
		if(\Auth::user()->group_id==2 || \Auth::user()->group_id==3)
		{
			$sel_attributes->where('attr_permission',1);
		}
		$this->data['sel_attributes'] = $sel_attributes->get();
		
		$this->data['sel_tags'] = DB::table('tb_tags_manager')->where('tag_status',1)->get();
		
		$this->data['sel_designer'] = DB::table('tb_designers')->where('designer_status',1)->get();
		
		if(\Auth::user()->group_id==3 && $wnd!='iframe')
		{
			$this->data['userpermissions'] = DB::table('tb_permissions')->where('user_id',$uid)->where('folder_id',$id)->first();
			return view('container.user_index_ajax',$this->data);
		}
		else
		{
			if($wnd=='iframe')
			{
				return view('container.iframe_ajax',$this->data);
			}
			else
			{
			    $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
                $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.container.index_ajax':'container.index_ajax';  
				return view($file_name,$this->data);
			}
		}
	}

	public function getFolderListAjax(Request $request, $id = 0){
		$folderList = $this->fetchFolderTreeList($id, '', '', $request->input('show'));
		$treeList = '';
		foreach ($folderList as $r) {
			echo $r;
		} 

	}
	
    
    
	public function getFolderListAjaxonload(Request $request, $id = 0){
	   if(\Auth::user()->group_id==5)
	   {
	       $obj_par_id = \DB::table('tb_container')->select('parent_id')->where('id', $id)->first();
           $par_id = $obj_par_id->parent_id;
           //$partarr = array_reverse($this->fetchFolderParentListIds($id));
           $folderList = $this->fetchFolderTreeListonload($par_id, $id, '', $request->input('show'));
       }else{            
            $partarr = array_reverse($this->fetchFolderParentListIds($id));
            $folderList = $this->fetchFolderTreeListonload(0, $id, '', $request->input('show'), $partarr);
       }
		$treeList = '';
		foreach ($folderList as $r) {
			echo $r;
		} 

	}

	function fetchFolderTreeListonload($parent = 0, $id, $user_tree_array = '', $showType='thumb', $partarrt = array()) {
		
		if (!is_array($user_tree_array))
		$user_tree_array = array();
	
		$uid = \Auth::user()->id;
		$filter = " AND parent_id='".$parent."'";
		if(\Auth::user()->group_id==3)
		{
			$filter .= " AND (id in (select folder_id from tb_permissions where user_id='".$uid."' and no_permission='0') or global_permission='1')";
		}
		$params = array(
			'params'	=> $filter,
			'order'		=> 'asc'
		);
		// Get Query 
		$results = $this->model->getRows( $params );
		
		  if ($results) {
			 $user_tree_array[] = '<ul class="folders parent'.$parent.'" rel="pr_'.$parent.'" style="display:block;">';
			 
			if(!empty($results['rows']))
			{
				usort($results['rows'], function($a, $b) {
					return $a->sort_num - $b->sort_num; 
				});
			}
			
			foreach($results['rows'] as $row) {
				$totfiles = DB::table('tb_container_files')->select('id')->where('folder_id',$row->id)->count();
				
				$totfolders = DB::table('tb_container')->select('id')->where('parent_id',$row->id)->count();
				$url = \URL::to('getFolderListAjax/'.$row->id.'?show='.$showType);
				
				$active_cls = '';
				if($parent==$row->id){
					$active_cls = 'class="active"';
				}
				$user_tree_array[] = '<li '.$active_cls.'><a href="'.$url.'" class="expand" title="" data-action="expend-folder-tree" rel="'.$row->id.'"><span>'. $row->display_name.'<span>('.$totfolders.', '.$totfiles.')</span></span></a></li>';
				if(!empty($partarrt))
				{
					if($partarrt[0]==$row->id)
					{
						array_shift($partarrt);
						$user_tree_array = $this->fetchFolderTreeListonload($row->id, $id, $user_tree_array, $showType,$partarrt);
					}
				}
			}
			$user_tree_array[] = "</ul>";
		  }
	  return $user_tree_array;
	}
	
	public function getUserListAjax(){
		$this->data['users'] = DB::table('tb_users')->select('last_name','first_name','id')->where('group_id',3)->where('active',1)->get();
		return view('container.user_list_ajax',$this->data);
	
	}
	
	function deactivateHotelhelp(Request $request)
	{
		$uid = \Auth::user()->id;
		$item = Input::get('cont_id');
		$cont_type = Input::get('cont_type');
		$action = Input::get('action');
		if($item!='' && $item>0)
		{
			if($cont_type=='folder')
			{
				$slvr_exists = DB::table('tb_container')->where('id', $item)->count();
				if($slvr_exists>0)
				{
					$humdata['hotel_help_update'] = 0;
					$humdata['updated'] = date('y-m-d');
					\DB::table('tb_container')->where('id', $item)->update($humdata);
				}
			}
		}
		else
		{
			echo 'error';
		}
	}
    
    public function media_relations( Request $request, $id = 0, $wnd = '' )
	{
		/*if($this->access['is_view'] ==1) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
		$uid = \Auth::user()->id;
		
		$filter = " AND parent_id='".$id."'";*/
        /*$filter = '';
		if(\Auth::user()->group_id==3 && $wnd!='iframe')
		{
			$filter .= " AND (id in (select folder_id from tb_permissions where user_id='".$uid."' and no_permission='0') or global_permission='1')";
		}
		
		$params = array(
			'params'	=> $filter
		);
		// Get Query 
		$results = $this->model->getRows( $params );*/
		//print_r($results);
		$foldername = DB::table('tb_container')->where('name','media-relations');
        
		$this->data['foldername'] = $foldername->select('id', 'display_name','parent_id','user_id', 'global_permission', 'title', 'description','display_name_eng','title_eng','description_eng')->first();
		
        $id = $this->data['foldername']->id;
        
		$this->data['parentArr'] = array_reverse($this->fetchFolderParentListArray($id));

		$filess_temp = DB::table('tb_container_files')->select('id','file_name','folder_id','file_title','file_description','file_display_name','file_sort_num','file_type')->where('folder_id',$id);
		
		$filess = $filess_temp->get();
	//print_r($filess); die;
		$ct=0; 
		$this->data['rowData'] = array();
		
		/*foreach($results['rows'] as $folderObj ){
			
			$totfiles = DB::table('tb_container_files')->select('id')->where('folder_id',$folderObj->id)->count();
			$totfolders = DB::table('tb_container')->select('id')->where('parent_id',$folderObj->id)->count();
			$frontend = DB::table('tb_frontend_container')->select('id')->where('container_id',$folderObj->id)->where('container_type','folder')->first();
			$this->data['rowData'][$ct]['id'] = $folderObj->id;
			$this->data['rowData'][$ct]['name'] = $folderObj->display_name;
			$this->data['rowData'][$ct]['ftype'] = 'folder';
			$this->data['rowData'][$ct]['imgsrc'] = '';
			$this->data['rowData'][$ct]['foldercount'] = $totfolders;
			$this->data['rowData'][$ct]['filecount'] = $totfiles;
			$this->data['rowData'][$ct]['tiff_files'] = '';
			$this->data['rowData'][$ct]['title'] = $folderObj->title;
			$this->data['rowData'][$ct]['description'] = $folderObj->description;
			$this->data['rowData'][$ct]['file_display_name'] = '';
			$this->data['rowData'][$ct]['sort_num'] = $folderObj->sort_num;
			$this->data['rowData'][$ct]['assign_front'] = 'no';
			$this->data['rowData'][$ct]['assign_lightbox'] = 'no';
			$this->data['rowData'][$ct]['hotel_help_update'] = $folderObj->hotel_help_update;
			if(!empty($frontend))
			{
				$this->data['rowData'][$ct]['assign_front'] = 'yes';
			}
			
			if($folderObj->cover_img=="" && $folderObj->temp_cover_img=="")
			{
				$default_front_design = \DB::table('tb_settings')->select('content')->where('key_value', 'frontend_design')->first();
				
				// Set main image first image in folder
				$checkfile = DB::table('tb_container_files')->select('file_name')->where('folder_id', $folderObj->id)->where(function ($query) { $query->where('file_type', 'image/jpeg')->orWhere('file_type', 'image/png')->orWhere('file_type', 'image/gif');})->orderBy('file_sort_num', 'asc')->first();
				if(!empty($checkfile))
				{
					$destinationPath = $this->getContainerUserPath($folderObj->id);
					$copytofolder = public_path().'/uploads/folder_cover_imgs/';
					$find_prd=false;
					$this->data['rowData'][$ct]['cover_img'] = '';
					$fileName = $checkfile->file_name;
												
					$find_actualsize = getimagesize($destinationPath.$fileName);
					if($find_actualsize[0]>$find_actualsize[1])
					{
						// image for backend
						if (! \File::exists($copytofolder.'thumb_'.$fileName))
						{
							$bkimg = \Image::make($destinationPath.$fileName);
							$bkimg->resize(128, 130);
							$bkimgfile = 'thumb_'. $fileName;
							$bkimg->save($copytofolder.$bkimgfile);
						}
						
						if (! \File::exists($copytofolder.'format_'.$fileName))
						{
							$mdimg = \Image::make($destinationPath.$fileName);
							$thactualsize = getimagesize($destinationPath.$fileName);
							if($thactualsize[0]>$thactualsize[1])
							{
								$mdimg->resize(320, null, function ($constraint) {
									$constraint->aspectRatio();
								});
							}
							else
							{
								$mdimg->resize(null, 320, function ($constraint) {
									$constraint->aspectRatio();
								});
							}
							$thumbfile = 'format_'.$fileName;
							$mdimg->save($copytofolder.$thumbfile);
						}
						
						$tcmdata['temp_cover_img'] = $fileName;
						$tcmdata['updated'] = date('y-m-d');
						DB::table('tb_container')->where('id', $folderObj->id)->update($tcmdata);
						
						if(!empty($default_front_design) && $default_front_design->content=="grid")
						{
							$this->data['rowData'][$ct]['cover_img'] = $fileName;
						}
						$find_prd=true;
					}
				}
				else{
					$this->data['rowData'][$ct]['cover_img'] = '';
				}
			}
			else
			{
				$this->data['rowData'][$ct]['cover_img'] = ($folderObj->cover_img!='') ? $folderObj->cover_img : $folderObj->temp_cover_img ;
			}
			
			$ct++;
			
			
		}*/
		if(!empty($filess))
		{
			$imgsrc = $this->getThumbpath($filess[0]->folder_id);
			$imgpath = $this->getContainerUserPath($filess[0]->folder_id);
            //print_r($imgsrc);
            //print_r($imgpath);
            //echo "<pre>";
			//print_r($filess); die;
			//$selfiles = DB::table('tb_permissions')->select('view','inherit')->where('folder_id',$id)->where('user_id',$uid)->first();
			//if(!empty($selfiles))
			//{
				//if($selfiles->view==1 || $selfiles->inherit==1)
				//{
					foreach($filess as $filesObj ){
						$this->data['rowData'][$ct]['id'] = $filesObj->id;
						$this->data['rowData'][$ct]['name'] = $filesObj->file_name;
						$this->data['rowData'][$ct]['ftype'] = 'file';
						$this->data['rowData'][$ct]['imgsrc'] = $imgsrc;
						$this->data['rowData'][$ct]['filecount'] = '';
						$this->data['rowData'][$ct]['foldercount'] = '';
						$this->data['rowData'][$ct]['tiff_files'] = '';
						$this->data['rowData'][$ct]['title'] = $filesObj->file_title;
						$this->data['rowData'][$ct]['description'] = $filesObj->file_description;
						$this->data['rowData'][$ct]['file_display_name'] = $filesObj->file_display_name;
						$this->data['rowData'][$ct]['cover_img'] = '';
						$this->data['rowData'][$ct]['sort_num'] = $filesObj->file_sort_num;
						$this->data['rowData'][$ct]['hotel_help_update'] = '';
						
						$exFtype = explode('/',$filesObj->file_type);
						if($exFtype[1]=="tiff")
						{
							$this->data['rowData'][$ct]['tiff_files'] = DB::table('tb_container_tiff_files')->select('id','file_name')->where('file_id', $filesObj->id)->get();
						}
						if($exFtype[0]=="image")
						{
							if (!File::exists(public_path(). '/uploads/thumbs/thumb_'.$filesObj->folder_id.'_'.$filesObj->file_name))
							{
								$mdimg = \Image::make($imgpath.$filesObj->file_name);
								$mdimg->resize(128, 130);
								$thumbfile = 'thumb_'.$filesObj->folder_id.'_'.$filesObj->file_name;
								$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
							}
							
							if (!File::exists(public_path(). '/uploads/thumbs/format_'.$filesObj->folder_id.'_'.$filesObj->file_name))
							{
								$mdimg = \Image::make($imgpath.$filesObj->file_name);
								$actualsize = getimagesize($imgpath.$filesObj->file_name);
								if($actualsize[0]>$actualsize[1])
								{
									$mdimg->resize(320, null, function ($constraint) {
										$constraint->aspectRatio();
									});
								}
								else
								{
									$mdimg->resize(null, 320, function ($constraint) {
										$constraint->aspectRatio();
									});
								}
								$thumbfile = 'format_'.$filesObj->folder_id.'_'.$filesObj->file_name;
								$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
							}
							if (!File::exists(public_path(). '/uploads/thumbs/highflip_'.$filesObj->folder_id.'_'.$filesObj->file_name))
							{
								$mdimg = \Image::make($imgpath.$filesObj->file_name);
								$actualsize = getimagesize($imgpath.$filesObj->file_name);
								if($actualsize[0]>$actualsize[1])
								{
									$mdimg->resize(1000, null, function ($constraint) {
										$constraint->aspectRatio();
									});
								}
								else
								{
									$mdimg->resize(null, 1000, function ($constraint) {
										$constraint->aspectRatio();
									});
								}
								$thumbfile = 'highflip_'.$filesObj->folder_id.'_'.$filesObj->file_name;
								$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
							}
						}
						
						// delete landing_info view
						if( File::exists(public_path() . '/uploads/thumbs/landing_info_'. $filesObj->folder_id.'_'.$filesObj->file_name))
						{
							File::delete(public_path() . '/uploads/thumbs/landing_info_'. $filesObj->folder_id.'_'.$filesObj->file_name);
						}
						
						// delete front_slider view
						if( File::exists(public_path() . '/uploads/thumbs/front_slider_'.$filesObj->file_name))
						{
							File::delete(public_path() . '/uploads/thumbs/front_slider_'.$filesObj->file_name);
						}
						
						// delete product_detail_list 
						if( File::exists(public_path() . '/uploads/thumbs/product_detail_list_'.$filesObj->file_name))
						{
							File::delete(public_path() . '/uploads/thumbs/product_detail_list_'.$filesObj->file_name);
						}
						
						// delete product file
						if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name))
						{
							File::delete(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name);
						}
						
						// delete material file
						if( File::exists(public_path() . '/uploads/folder_cover_imgs/material_file_'.$filesObj->file_name))
						{
							File::delete(public_path() . '/uploads/folder_cover_imgs/material_file_'.$filesObj->file_name);
						}
						
						// delete masonry_product_file
						if( File::exists(public_path() . '/uploads/folder_cover_imgs/masonry_product_file_'.$filesObj->file_name))
						{
							File::delete(public_path() . '/uploads/folder_cover_imgs/masonry_product_file_'.$filesObj->file_name);
						}
						
						// delete product file
						if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name))
						{
							File::delete(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name);
						}
						
						// delete folder cover front file
						if( File::exists(public_path() . '/uploads/folder_cover_imgs/front_'.$filesObj->file_name))
						{
							File::delete(public_path() . '/uploads/folder_cover_imgs/front_'.$filesObj->file_name);
						}
						
						// delete folder cover product file
						if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_'.$filesObj->file_name))
						{
							File::delete(public_path() . '/uploads/folder_cover_imgs/product_'.$filesObj->file_name);
						}
						
						// delete folder cover masonry_product file
						if( File::exists(public_path() . '/uploads/folder_cover_imgs/masonry_product_'.$filesObj->file_name))
						{
							File::delete(public_path() . '/uploads/folder_cover_imgs/masonry_product_'.$filesObj->file_name);
						}
						
						// delete folder cover product_detail_cover file
						if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_detail_cover_'.$filesObj->file_name))
						{
							File::delete(public_path() . '/uploads/folder_cover_imgs/product_detail_cover_'.$filesObj->file_name);
						}
						$ct++;
					}
				//}
			//}
			
		}
        		
		if(!empty($this->data['rowData']))
		{
			usort($this->data['rowData'], function($a, $b) {
				return $a['sort_num'] - $b['sort_num']; 
			});
		}
		
		$subfoldertotal = DB::table('tb_container')->select('id')->where('parent_id',$id);
		
		$this->data['subfoldertotal'] = $subfoldertotal->count();
				
		$subfilestotal = DB::table('tb_container_files')->select('id')->where('folder_id',$id);
		
		$this->data['subfilestotal'] = $subfilestotal->count();
		
		$subfileBytes_temp = DB::table('tb_container_files')->where('folder_id',$id);
		
		$subfileBytes = $subfileBytes_temp->sum('file_size');
		
		$subfileMb = ($subfileBytes/(1000*1000));
		$this->data['subfileSpace'] = round($subfileMb,2,PHP_ROUND_HALF_UP);
		
		$this->data['users'] = DB::table('tb_users')->select('id','first_name','last_name')->where('group_id',3)->where('active',1)->get();
		$emp = DB::table('employee')->select('Email')->where('Status',1)->get();
		$this->data['crmusers'] = '';
		if(!empty($emp))
		{
			$this->data['crmusers'] = $emp;
		}
		$permiss = array();
		$permission = DB::table('tb_permissions')->where('folder_id',$id)->get();
		foreach($permission as $permit)
		{
			$permiss[$permit->user_id] = $permit;
		}
		
		if(isset($_REQUEST['show']) && trim($_REQUEST['show'])!="")
		{
			$showType = trim($_REQUEST['show']);
		}
		else
		{
			$showType = "thumb";
		}
		
		$this->data['showType'] = $showType;
		$this->data['permissions'] = $permiss;
		
		$this->data['tree'] = array();
		$this->data['fid'] = $id;
		//$this->data['group'] = \Auth::user()->group_id;
		$sel_attributes = DB::table('tb_attributes')->select('attr_type','id','attr_title','attr_cat')->where('attr_status',1);
		
		$this->data['sel_attributes'] = $sel_attributes->get();
		
		$this->data['sel_tags'] = DB::table('tb_tags_manager')->select('id','tag_title')->where('tag_status',1)->get();
		
		$this->data['sel_designer'] = DB::table('tb_designers')->select('id','designer_name')->where('designer_status',1)->get();
		
		$this->data['lightboxes'] = \DB::table('tb_lightbox')->select('id','box_name')->where('user_id', $uid)->get();
		
		$this->data['parent_tags'] = (new TagmanagerController)->fetchTagTree();
		
        
		$this->data['slider'] = \DB::table('tb_sliders')->where('slider_category', 'Hotel')->where('slider_status',1)->orderBy('sort_num','asc')->get();
        $this->data['slug'] = '';
        
        $this->data['destination_category'] =0;
        
		$boxcontent = \DB::table('tb_lightbox_content')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_lightbox_content.file_id')->select('tb_lightbox_content.id', 'tb_container_files.file_name', 'tb_container_files.folder_id', 'tb_container_files.file_display_name', 'tb_container_files.file_title','tb_lightbox_content.lightbox_id')->where('tb_lightbox_content.user_id', $uid)->get();
		$boxcont = array();
		if(!empty($boxcontent))
		{
			foreach($boxcontent as $bcontent)
			{
				$boxcont[$bcontent->lightbox_id][] = $bcontent;
			}
		}
		$this->data['lightcontent'] = $boxcont;
		
		
		$is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.frontend.themes.emporium.press.media_relations':'frontend.themes.emporium.press.media_relations';
                
		return view('frontend.themes.emporium.press.media_relations',$this->data);
	}
    
    public function media_relations_old( Request $request, $id = 0, $wnd = '' )
	{
		if($this->access['is_view'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
		$uid = \Auth::user()->id;
		
		$filter = " AND parent_id='".$id."'";
		if(\Auth::user()->group_id==3 && $wnd!='iframe')
		{
			$filter .= " AND (id in (select folder_id from tb_permissions where user_id='".$uid."' and no_permission='0') or global_permission='1')";
		}
		
		$params = array(
			'params'	=> $filter
		);
		// Get Query 
		$results = $this->model->getRows( $params );
		
		$foldername = DB::table('tb_container')->where('name','media-relations');
        
		$this->data['foldername'] = $foldername->select('id', 'display_name','parent_id','user_id', 'global_permission', 'title', 'description','display_name_eng','title_eng','description_eng')->first();
		
        $id = $this->data['foldername']->id;
        
		$this->data['parentArr'] = array_reverse($this->fetchFolderParentListArray($id));

		$filess_temp = DB::table('tb_container_files')->select('id','file_name','folder_id','file_title','file_description','file_display_name','file_sort_num','file_type')->where('folder_id',$id);
		
		$filess = $filess_temp->get();
	
		$ct=0; 
		$this->data['rowData'] = array();
		
		foreach($results['rows'] as $folderObj ){
			
			$totfiles = DB::table('tb_container_files')->select('id')->where('folder_id',$folderObj->id)->count();
			$totfolders = DB::table('tb_container')->select('id')->where('parent_id',$folderObj->id)->count();
			$frontend = DB::table('tb_frontend_container')->select('id')->where('container_id',$folderObj->id)->where('container_type','folder')->first();
			$this->data['rowData'][$ct]['id'] = $folderObj->id;
			$this->data['rowData'][$ct]['name'] = $folderObj->display_name;
			$this->data['rowData'][$ct]['ftype'] = 'folder';
			$this->data['rowData'][$ct]['imgsrc'] = '';
			$this->data['rowData'][$ct]['foldercount'] = $totfolders;
			$this->data['rowData'][$ct]['filecount'] = $totfiles;
			$this->data['rowData'][$ct]['tiff_files'] = '';
			$this->data['rowData'][$ct]['title'] = $folderObj->title;
			$this->data['rowData'][$ct]['description'] = $folderObj->description;
			$this->data['rowData'][$ct]['file_display_name'] = '';
			$this->data['rowData'][$ct]['sort_num'] = $folderObj->sort_num;
			$this->data['rowData'][$ct]['assign_front'] = 'no';
			$this->data['rowData'][$ct]['assign_lightbox'] = 'no';
			$this->data['rowData'][$ct]['hotel_help_update'] = $folderObj->hotel_help_update;
			if(!empty($frontend))
			{
				$this->data['rowData'][$ct]['assign_front'] = 'yes';
			}
			
			if($folderObj->cover_img=="" && $folderObj->temp_cover_img=="")
			{
				$default_front_design = \DB::table('tb_settings')->select('content')->where('key_value', 'frontend_design')->first();
				
				// Set main image first image in folder
				$checkfile = DB::table('tb_container_files')->select('file_name')->where('folder_id', $folderObj->id)->where(function ($query) { $query->where('file_type', 'image/jpeg')->orWhere('file_type', 'image/png')->orWhere('file_type', 'image/gif');})->orderBy('file_sort_num', 'asc')->first();
				if(!empty($checkfile))
				{
					$destinationPath = $this->getContainerUserPath($folderObj->id);
					$copytofolder = public_path().'/uploads/folder_cover_imgs/';
					$find_prd=false;
					$this->data['rowData'][$ct]['cover_img'] = '';
					$fileName = $checkfile->file_name;
												
					$find_actualsize = getimagesize($destinationPath.$fileName);
					if($find_actualsize[0]>$find_actualsize[1])
					{
						// image for backend
						if (! \File::exists($copytofolder.'thumb_'.$fileName))
						{
							$bkimg = \Image::make($destinationPath.$fileName);
							$bkimg->resize(128, 130);
							$bkimgfile = 'thumb_'. $fileName;
							$bkimg->save($copytofolder.$bkimgfile);
						}
						
						if (! \File::exists($copytofolder.'format_'.$fileName))
						{
							$mdimg = \Image::make($destinationPath.$fileName);
							$thactualsize = getimagesize($destinationPath.$fileName);
							if($thactualsize[0]>$thactualsize[1])
							{
								$mdimg->resize(320, null, function ($constraint) {
									$constraint->aspectRatio();
								});
							}
							else
							{
								$mdimg->resize(null, 320, function ($constraint) {
									$constraint->aspectRatio();
								});
							}
							$thumbfile = 'format_'.$fileName;
							$mdimg->save($copytofolder.$thumbfile);
						}
						
						$tcmdata['temp_cover_img'] = $fileName;
						$tcmdata['updated'] = date('y-m-d');
						DB::table('tb_container')->where('id', $folderObj->id)->update($tcmdata);
						
						if(!empty($default_front_design) && $default_front_design->content=="grid")
						{
							$this->data['rowData'][$ct]['cover_img'] = $fileName;
						}
						$find_prd=true;
					}
				}
				else{
					$this->data['rowData'][$ct]['cover_img'] = '';
				}
			}
			else
			{
				$this->data['rowData'][$ct]['cover_img'] = ($folderObj->cover_img!='') ? $folderObj->cover_img : $folderObj->temp_cover_img ;
			}
			
			$ct++;
			
			
		}
		if(!empty($filess))
		{
			$imgsrc = $this->getThumbpath($filess[0]->folder_id);
			$imgpath = $this->getContainerUserPath($filess[0]->folder_id);
			
			$selfiles = DB::table('tb_permissions')->select('view','inherit')->where('folder_id',$id)->where('user_id',$uid)->first();
			if(!empty($selfiles))
			{
				if($selfiles->view==1 || $selfiles->inherit==1)
				{
					foreach($filess as $filesObj ){
						$this->data['rowData'][$ct]['id'] = $filesObj->id;
						$this->data['rowData'][$ct]['name'] = $filesObj->file_name;
						$this->data['rowData'][$ct]['ftype'] = 'file';
						$this->data['rowData'][$ct]['imgsrc'] = $imgsrc;
						$this->data['rowData'][$ct]['filecount'] = '';
						$this->data['rowData'][$ct]['foldercount'] = '';
						$this->data['rowData'][$ct]['tiff_files'] = '';
						$this->data['rowData'][$ct]['title'] = $filesObj->file_title;
						$this->data['rowData'][$ct]['description'] = $filesObj->file_description;
						$this->data['rowData'][$ct]['file_display_name'] = $filesObj->file_display_name;
						$this->data['rowData'][$ct]['cover_img'] = '';
						$this->data['rowData'][$ct]['sort_num'] = $filesObj->file_sort_num;
						$this->data['rowData'][$ct]['hotel_help_update'] = '';
						
						$exFtype = explode('/',$filesObj->file_type);
						if($exFtype[1]=="tiff")
						{
							$this->data['rowData'][$ct]['tiff_files'] = DB::table('tb_container_tiff_files')->select('id','file_name')->where('file_id', $filesObj->id)->get();
						}
						if($exFtype[0]=="image")
						{
							if (!File::exists(public_path(). '/uploads/thumbs/thumb_'.$filesObj->folder_id.'_'.$filesObj->file_name))
							{
								$mdimg = \Image::make($imgpath.$filesObj->file_name);
								$mdimg->resize(128, 130);
								$thumbfile = 'thumb_'.$filesObj->folder_id.'_'.$filesObj->file_name;
								$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
							}
							
							if (!File::exists(public_path(). '/uploads/thumbs/format_'.$filesObj->folder_id.'_'.$filesObj->file_name))
							{
								$mdimg = \Image::make($imgpath.$filesObj->file_name);
								$actualsize = getimagesize($imgpath.$filesObj->file_name);
								if($actualsize[0]>$actualsize[1])
								{
									$mdimg->resize(320, null, function ($constraint) {
										$constraint->aspectRatio();
									});
								}
								else
								{
									$mdimg->resize(null, 320, function ($constraint) {
										$constraint->aspectRatio();
									});
								}
								$thumbfile = 'format_'.$filesObj->folder_id.'_'.$filesObj->file_name;
								$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
							}
							if (!File::exists(public_path(). '/uploads/thumbs/highflip_'.$filesObj->folder_id.'_'.$filesObj->file_name))
							{
								$mdimg = \Image::make($imgpath.$filesObj->file_name);
								$actualsize = getimagesize($imgpath.$filesObj->file_name);
								if($actualsize[0]>$actualsize[1])
								{
									$mdimg->resize(1000, null, function ($constraint) {
										$constraint->aspectRatio();
									});
								}
								else
								{
									$mdimg->resize(null, 1000, function ($constraint) {
										$constraint->aspectRatio();
									});
								}
								$thumbfile = 'highflip_'.$filesObj->folder_id.'_'.$filesObj->file_name;
								$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
							}
						}
						
						// delete landing_info view
						if( File::exists(public_path() . '/uploads/thumbs/landing_info_'. $filesObj->folder_id.'_'.$filesObj->file_name))
						{
							File::delete(public_path() . '/uploads/thumbs/landing_info_'. $filesObj->folder_id.'_'.$filesObj->file_name);
						}
						
						// delete front_slider view
						if( File::exists(public_path() . '/uploads/thumbs/front_slider_'.$filesObj->file_name))
						{
							File::delete(public_path() . '/uploads/thumbs/front_slider_'.$filesObj->file_name);
						}
						
						// delete product_detail_list 
						if( File::exists(public_path() . '/uploads/thumbs/product_detail_list_'.$filesObj->file_name))
						{
							File::delete(public_path() . '/uploads/thumbs/product_detail_list_'.$filesObj->file_name);
						}
						
						// delete product file
						if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name))
						{
							File::delete(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name);
						}
						
						// delete material file
						if( File::exists(public_path() . '/uploads/folder_cover_imgs/material_file_'.$filesObj->file_name))
						{
							File::delete(public_path() . '/uploads/folder_cover_imgs/material_file_'.$filesObj->file_name);
						}
						
						// delete masonry_product_file
						if( File::exists(public_path() . '/uploads/folder_cover_imgs/masonry_product_file_'.$filesObj->file_name))
						{
							File::delete(public_path() . '/uploads/folder_cover_imgs/masonry_product_file_'.$filesObj->file_name);
						}
						
						// delete product file
						if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name))
						{
							File::delete(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name);
						}
						
						// delete folder cover front file
						if( File::exists(public_path() . '/uploads/folder_cover_imgs/front_'.$filesObj->file_name))
						{
							File::delete(public_path() . '/uploads/folder_cover_imgs/front_'.$filesObj->file_name);
						}
						
						// delete folder cover product file
						if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_'.$filesObj->file_name))
						{
							File::delete(public_path() . '/uploads/folder_cover_imgs/product_'.$filesObj->file_name);
						}
						
						// delete folder cover masonry_product file
						if( File::exists(public_path() . '/uploads/folder_cover_imgs/masonry_product_'.$filesObj->file_name))
						{
							File::delete(public_path() . '/uploads/folder_cover_imgs/masonry_product_'.$filesObj->file_name);
						}
						
						// delete folder cover product_detail_cover file
						if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_detail_cover_'.$filesObj->file_name))
						{
							File::delete(public_path() . '/uploads/folder_cover_imgs/product_detail_cover_'.$filesObj->file_name);
						}
						$ct++;
					}
				}
			}
			
		}
        		
		if(!empty($this->data['rowData']))
		{
			usort($this->data['rowData'], function($a, $b) {
				return $a['sort_num'] - $b['sort_num']; 
			});
		}
		
		$subfoldertotal = DB::table('tb_container')->select('id')->where('parent_id',$id);
		
		$this->data['subfoldertotal'] = $subfoldertotal->count();
				
		$subfilestotal = DB::table('tb_container_files')->select('id')->where('folder_id',$id);
		
		$this->data['subfilestotal'] = $subfilestotal->count();
		
		$subfileBytes_temp = DB::table('tb_container_files')->where('folder_id',$id);
		
		$subfileBytes = $subfileBytes_temp->sum('file_size');
		
		$subfileMb = ($subfileBytes/(1000*1000));
		$this->data['subfileSpace'] = round($subfileMb,2,PHP_ROUND_HALF_UP);
		
		$this->data['users'] = DB::table('tb_users')->select('id','first_name','last_name')->where('group_id',3)->where('active',1)->get();
		$emp = DB::table('employee')->select('Email')->where('Status',1)->get();
		$this->data['crmusers'] = '';
		if(!empty($emp))
		{
			$this->data['crmusers'] = $emp;
		}
		$permiss = array();
		$permission = DB::table('tb_permissions')->where('folder_id',$id)->get();
		foreach($permission as $permit)
		{
			$permiss[$permit->user_id] = $permit;
		}
		
		if(isset($_REQUEST['show']) && trim($_REQUEST['show'])!="")
		{
			$showType = trim($_REQUEST['show']);
		}
		else
		{
			$showType = "thumb";
		}
		
		$this->data['showType'] = $showType;
		$this->data['permissions'] = $permiss;
		
		$this->data['tree'] = array();
		$this->data['fid'] = $id;
		$this->data['group'] = \Auth::user()->group_id;
		$sel_attributes = DB::table('tb_attributes')->select('attr_type','id','attr_title','attr_cat')->where('attr_status',1);
		
		$this->data['sel_attributes'] = $sel_attributes->get();
		
		$this->data['sel_tags'] = DB::table('tb_tags_manager')->select('id','tag_title')->where('tag_status',1)->get();
		
		$this->data['sel_designer'] = DB::table('tb_designers')->select('id','designer_name')->where('designer_status',1)->get();
		
		$this->data['lightboxes'] = \DB::table('tb_lightbox')->select('id','box_name')->where('user_id', $uid)->get();
		
		$this->data['parent_tags'] = (new TagmanagerController)->fetchTagTree();
		
        
		$this->data['slider'] = \DB::table('tb_sliders')->where('slider_category', 'Hotel')->where('slider_status',1)->orderBy('sort_num','asc')->get();
        $this->data['slug'] = '';
        
        $this->data['destination_category'] =0;
        
		$boxcontent = \DB::table('tb_lightbox_content')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_lightbox_content.file_id')->select('tb_lightbox_content.id', 'tb_container_files.file_name', 'tb_container_files.folder_id', 'tb_container_files.file_display_name', 'tb_container_files.file_title','tb_lightbox_content.lightbox_id')->where('tb_lightbox_content.user_id', $uid)->get();
		$boxcont = array();
		if(!empty($boxcontent))
		{
			foreach($boxcontent as $bcontent)
			{
				$boxcont[$bcontent->lightbox_id][] = $bcontent;
			}
		}
		$this->data['lightcontent'] = $boxcont;
		
		
		$is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.frontend.themes.emporium.press.media_relations':'frontend.themes.emporium.press.media_relations';
                
		return view('frontend.themes.emporium.press.media_relations',$this->data);
	}
    
   	function fetchPressFolderTreeList($parent = 0, $user_tree_array = '', $wnd = '', $showType='thumb') {
 
		if (!is_array($user_tree_array))
		$user_tree_array = array();
	
		$uid = \Auth::user()->id;
		$filter = " AND parent_id='".$parent."'";
		
		$params = array(
			'params'	=> $filter,
			'order'		=> 'asc'
		);
		// Get Query 
		$results = $this->model->getRows( $params );
		
        if ($results) {
            $user_tree_array[] = '<ul class="folders parent'.$parent.'" rel="pr_'.$parent.'">';
    		 
    		if(!empty($results['rows']))
    		{
    			usort($results['rows'], function($a, $b) {
    				return $a->sort_num - $b->sort_num; 
    			});
    		}
    		
    		foreach($results['rows'] as $row) {
    			$totfiles_temp = DB::table('tb_container_files')->select('id')->where('folder_id',$row->id);
    			
    			$totfiles = $totfiles_temp->count();
    			
    			$totfolder_temp = DB::table('tb_container')->select('id')->where('parent_id',$row->id);
    			
    			$totfolders = $totfolder_temp->count();
    			
    			$url = \URL::to('getPressFolderListAjax/'.$row->id.'?show='.$showType);
    						
    			$active_cls = '';
    			if($parent==$row->id){
    				$active_cls = 'class="active"';
    			}
    			
    			$user_tree_array[] = '<li '.$active_cls.'><a href="'.$url.'" class="expand" title="" data-action="expend-folder-tree" rel="'.$row->id.'"><span>'. $row->display_name.'<span>('.$totfolders.', '.$totfiles.')</span></span></a></li>';			
    		}
            $user_tree_array[] = "</ul>";
	   }
	   return $user_tree_array;
	}

    
    public function getPressFolderListAjax(Request $request, $id = 0){
		$folderList = $this->fetchPressFolderTreeList($id, '', '', $request->input('show'));
		$treeList = '';
		foreach ($folderList as $r) {
			echo $r;
		} 

	}
    
    public function getPressFolderListAjaxonload(Request $request, $fid=0){	   
        
        /*$folderList = $this->fetchPressFolderTreeListonload($fid);
       
		$treeList = '';
		foreach ($folderList as $r) {
			echo $r;
		} */
        
        $tree = '';
        $main_folder = \DB::table('tb_container')->where('name', 'media-relations')->first();
        if(!empty($main_folder)){
            $selected = ($fid == $main_folder->id) ? 'selected' : ''; 
            $tree .= '<ul class="folders parent'.$main_folder->id.'" rel="pr_'.$main_folder->id.'" style="display:block;">';
            $url = \URL::to('getPressFolderListAjax/'.$main_folder->id);                
            $tree .= '<li><a href="'.$url.'" class="expand '.$selected.'" title="" data-action="expend-folder-tree" rel="'.$main_folder->id.'"><span>'. $main_folder->display_name.'<span></span></span></a>';
            
                $tree .= $this->fetchPressFolderTreeListonload($main_folder->id, $fid);
            
            $tree .= '</li>';               
             
            $tree .= '</ul>';
        }
        echo $tree;
	}

    function fetchPressFolderTreeListonload($fid, $sel=0) {
		
        $uid = \Auth::user()->id;
		$filter = " AND parent_id=".$fid;
		
		$params = array(
			'params'	=> $filter,
			'order'		=> 'asc'
		);
        
		// Get Query 
        $user_tree_array = '<ul class="folders parent'.$fid.'" rel="pr_'.$fid.'" style="display:block;">';
        
		$results = $this->model->getRows( $params );
		
        if ($results) {
			
			foreach($results['rows'] as $row) {
				$totfiles = DB::table('tb_container_files')->select('id')->where('folder_id',$row->id)->count();
				
				$totfolders = DB::table('tb_container')->select('id')->where('parent_id',$row->id)->count();
				$url = \URL::to('getPressFolderListAjax/'.$row->id.'?show=');
                
                $selected = ($sel == $row->id) ? 'selected' : ''; 
                
				$user_tree_array .= '<li><a href="'.$url.'" class="expand '.$selected.'" title="" data-action="expend-folder-tree" rel="'.$row->id.'"><span>'. $row->display_name.'<span>('.$totfolders.', '.$totfiles.')</span></span></a>';
				
                
                $user_tree_array .= $this->fetchPressFolderTreeListonload($row->id, $sel);
                
                $user_tree_array .= '</li>';
			}
                        
		}
        $user_tree_array .= "</ul>";
        return $user_tree_array;
        
		/*$user_tree_array = array();
 
		$uid = \Auth::user()->id;
		$filter = " AND name='media-relations'";
		
		$params = array(
			'params'	=> $filter,
			'order'		=> 'asc'
		);
        $parent = 1;
		// Get Query 
		$results = $this->model->getRows( $params );
		
		  if ($results) {
			 $user_tree_array[] = '<ul class="folders parent'.$parent.'" rel="pr_'.$parent.'" style="display:block;">';
			 
			if(!empty($results['rows']))
			{
				usort($results['rows'], function($a, $b) {
					return $a->sort_num - $b->sort_num; 
				});
			}
			
			foreach($results['rows'] as $row) {
				$totfiles = DB::table('tb_container_files')->select('id')->where('folder_id',$row->id)->count();
				
				$totfolders = DB::table('tb_container')->select('id')->where('parent_id',$row->id)->count();
				$url = \URL::to('getPressFolderListAjax/'.$row->id.'?show=');
				
				$active_cls = '';
                $str_folder = '';
				if($parent==$row->id){
					$active_cls = 'class="active"';
				}
                
                $selected = ($fid==0)? 'selected' : '';
                
				$str_folder = '<li '.$active_cls.'><a href="'.$url.'" class="expand '.$selected.'" title="" data-action="expend-folder-tree" rel="'.$row->id.'"><span>'. $row->display_name.'<span>('.$totfolders.', '.$totfiles.')</span></span></a>';
				
                
                $results2 = DB::table('tb_container')->where('parent_id', $row->id)->get();
		
                if ($results2) {
                    $str_folder .= '<ul class="folders parent'.$parent.'" rel="pr_'.$parent.'" style="display:block;">';
            		 
            		if(!empty($results2))
            		{
            			usort($results2, function($a, $b) {
            				return $a->sort_num - $b->sort_num; 
            			});
            		}
            		
            		foreach($results2 as $row2) {
            			$totfiles_temp = DB::table('tb_container_files')->select('id')->where('folder_id',$row2->id);
            			
            			$totfiles = $totfiles_temp->count();
            			
            			$totfolder_temp = DB::table('tb_container')->select('id')->where('parent_id',$row2->id);
            			
            			$totfolders = $totfolder_temp->count();
            			
            			$url = \URL::to('getPressFolderListAjax/'.$row2->id.'?show=');
            						
            			$active_cls = '';
            			if($parent==$row2->id){
            				$active_cls = 'class="active"';
            			}
            			
            			$str_folder .= '<li '.$active_cls.'><a href="'.$url.'" class="expand '.($fid==$row2->id ? 'selected' : '').'" title="" data-action="expend-folder-tree" rel="'.$row2->id.'"><span>'. $row2->display_name.'<span>('.$totfolders.', '.$totfiles.')</span></span></a></li>';			
            		}
                    $str_folder .= "</ul>";
        	    }
                
                $str_folder .= '</li>';
                $user_tree_array[] = $str_folder; 
			}
			$user_tree_array[] = "</ul>"; 
   	    }
        return $user_tree_array;*/
	}
    public function getPressFoldersAjax( $id = 0, $wnd = '' )
	{
		$record_per_page = 50;
		$page_number = 1;
		if(isset($_GET['page'])){
			$page_number = $_GET['page'];
		}
		
		if($this->access['is_view'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
		$uid = \Auth::user()->id;
		
		$filter = " AND parent_id='".$id."'";
		if(\Auth::user()->group_id==3 && $wnd!='iframe')
		{
			$filter .= " AND (id in (select folder_id from tb_permissions where user_id='".$uid."' and no_permission='0') or global_permission='1')";
		}
		if(\Auth::user()->group_id==2 && $wnd!='iframe')
		{
			//$filter .= " AND (user_id='".$uid."' or (user_id!='".$uid."' and global_permission='1'))";
		}
		$params = array(
			'params'	=> $filter,
			'page'=> $page_number,
			'limit' => $record_per_page
		);

		$params1 = array(
			'params'	=> $filter
		);
		// Get Query 
		$results = $this->model->getRows( $params );

		$resultsTotal = $this->model->getRows($params1 );


		
		$foldername = DB::table('tb_container')->where('id',$id);
		$this->data['foldername'] = $foldername->select('display_name','parent_id','user_id', 'global_permission', 'title', 'description','display_name_eng','title_eng','description_eng')->first();
		
		$this->data['parentArr'] = array_reverse($this->fetchFolderParentListArray($id));

		$filess_temp = DB::table('tb_container_files')->select('id','file_name','folder_id','file_title','file_description','file_display_name','file_sort_num','file_type')->where('folder_id',$id);
		$filess_temp_full = DB::table('tb_container_files')->select('id')->where('folder_id',$id);
		
		if(\Auth::user()->group_id==2 && (!empty($this->data['foldername'] && $this->data['foldername']->global_permission==0)) && $wnd!='iframe')
		{
			//$filess_temp->where('user_id',$uid);
		}
		$filessTotal = $filess_temp_full->get();

		$totalRecord = $resultsTotal['total'] + count($filessTotal);
		$this->data['pagination']['total_folder'] = $totalRecord;
		$this->data['pagination']['total_page'] = ($totalRecord>0)?(ceil($totalRecord/$record_per_page)):0;
		$this->data['pagination']['current_page'] = $page_number;
		$this->data['pagination']['prev_page'] = ($page_number>0)?($page_number - 1):0;
		$this->data['pagination']['next_page'] = ($page_number>0)?($page_number + 1):0;
		$filess = array();
		if(count($results['rows'])<$record_per_page){
			if($resultsTotal['total']>0){
				$startOffset = 0;
				$limitFiles = count($results['rows']) - $record_per_page;
			}else{
				$startOffset = ($page_number - 1) * $record_per_page;
				$limitFiles = $record_per_page;
			}
			$filess = $filess_temp->get();
		}


		$ct=0; 
		$this->data['rowData'] = array();
		
		foreach($results['rows'] as $folderObj ){
			if($wnd=='iframe')
			{
				/*$childs = $this->fetchFolderChildListIds(30);
				if($folderObj->id==30 || in_array($folderObj->id,$childs))
				{*/
					$totfiles = DB::table('tb_container_files')->select('id')->where('folder_id',$folderObj->id)->count();
					$totfolders = DB::table('tb_container')->select('id')->where('parent_id',$folderObj->id)->count();
					$this->data['rowData'][$ct]['id'] = $folderObj->id;
					$this->data['rowData'][$ct]['name'] = $folderObj->display_name;
					$this->data['rowData'][$ct]['ftype'] = 'folder';
					$this->data['rowData'][$ct]['imgsrc'] = '';
					$this->data['rowData'][$ct]['foldercount'] = $totfolders;
					$this->data['rowData'][$ct]['filecount'] = $totfiles;
					$this->data['rowData'][$ct]['tiff_files'] = '';
					$this->data['rowData'][$ct]['title'] = $folderObj->title;
					$this->data['rowData'][$ct]['description'] = $folderObj->description;
					$this->data['rowData'][$ct]['file_display_name'] = '';
					$this->data['rowData'][$ct]['cover_img'] = $folderObj->cover_img;
					$this->data['rowData'][$ct]['sort_num'] = $folderObj->sort_num;
					$this->data['rowData'][$ct]['imgpath'] = '';
					$this->data['rowData'][$ct]['hotel_help_update'] = $folderObj->hotel_help_update;
					$ct++;
				//}
			}
			else
			{
				$totfiles = DB::table('tb_container_files')->select('id')->where('folder_id',$folderObj->id)->count();
				$totfolders = DB::table('tb_container')->select('id')->where('parent_id',$folderObj->id)->count();
				$frontend = DB::table('tb_frontend_container')->select('id')->where('container_id',$folderObj->id)->where('container_type','folder')->first();
				$this->data['rowData'][$ct]['id'] = $folderObj->id;
				$this->data['rowData'][$ct]['name'] = $folderObj->display_name;
				$this->data['rowData'][$ct]['ftype'] = 'folder';
				$this->data['rowData'][$ct]['imgsrc'] = '';
				$this->data['rowData'][$ct]['foldercount'] = $totfolders;
				$this->data['rowData'][$ct]['filecount'] = $totfiles;
				$this->data['rowData'][$ct]['tiff_files'] = '';
				$this->data['rowData'][$ct]['title'] = $folderObj->title;
				$this->data['rowData'][$ct]['description'] = $folderObj->description;
				$this->data['rowData'][$ct]['file_display_name'] = '';
				$this->data['rowData'][$ct]['sort_num'] = $folderObj->sort_num;
				$this->data['rowData'][$ct]['assign_front'] = 'no';
				$this->data['rowData'][$ct]['assign_lightbox'] = 'no';
				$this->data['rowData'][$ct]['hotel_help_update'] = $folderObj->hotel_help_update;
				if(!empty($frontend))
				{
					$this->data['rowData'][$ct]['assign_front'] = 'yes';
				}
				
				if($folderObj->cover_img=="" && $folderObj->temp_cover_img=="")
				{
					$default_front_design = \DB::table('tb_settings')->select('content')->where('key_value', 'frontend_design')->first();
					
					// Set main image first image in folder
					$checkfile = DB::table('tb_container_files')->select('file_name')->where('folder_id', $folderObj->id)->where(function ($query) { $query->where('file_type', 'image/jpeg')->orWhere('file_type', 'image/png')->orWhere('file_type', 'image/gif');})->orderBy('file_sort_num', 'asc')->first();
					if(!empty($checkfile))
					{
						$destinationPath = $this->getContainerUserPath($folderObj->id);
						$copytofolder = public_path().'/uploads/folder_cover_imgs/';
						$find_prd=false;
						$this->data['rowData'][$ct]['cover_img'] = '';
						$fileName = $checkfile->file_name;
													
						$find_actualsize = getimagesize($destinationPath.$fileName);
						if($find_actualsize[0]>$find_actualsize[1])
						{
							// image for backend
							if (! \File::exists($copytofolder.'thumb_'.$fileName))
							{
								$bkimg = \Image::make($destinationPath.$fileName);
								$bkimg->resize(128, 130);
								$bkimgfile = 'thumb_'. $fileName;
								$bkimg->save($copytofolder.$bkimgfile);
							}
							
							if (! \File::exists($copytofolder.'format_'.$fileName))
							{
								$mdimg = \Image::make($destinationPath.$fileName);
								$thactualsize = getimagesize($destinationPath.$fileName);
								if($thactualsize[0]>$thactualsize[1])
								{
									$mdimg->resize(320, null, function ($constraint) {
										$constraint->aspectRatio();
									});
								}
								else
								{
									$mdimg->resize(null, 320, function ($constraint) {
										$constraint->aspectRatio();
									});
								}
								$thumbfile = 'format_'.$fileName;
								$mdimg->save($copytofolder.$thumbfile);
							}
							
							$tcmdata['temp_cover_img'] = $fileName;
							$tcmdata['updated'] = date('y-m-d');
							DB::table('tb_container')->where('id', $folderObj->id)->update($tcmdata);
							
							if(!empty($default_front_design) && $default_front_design->content=="grid")
							{
								$this->data['rowData'][$ct]['cover_img'] = $fileName;
							}
							$find_prd=true;
						}
					}
					else{
						$this->data['rowData'][$ct]['cover_img'] = '';
					}
				}
				else
				{
					$this->data['rowData'][$ct]['cover_img'] = ($folderObj->cover_img!='') ? $folderObj->cover_img : $folderObj->temp_cover_img ;
				}
				
				$ct++;
			}
			
		}

		if(!empty($filess))
		{
			$imgsrc = $this->getThumbpath($filess[0]->folder_id);
			$imgpath = $this->getContainerUserPath($filess[0]->folder_id);
			if(\Auth::user()->group_id!=3 || (!empty($this->data['foldername'] && $this->data['foldername']->global_permission==1)) || $wnd=='iframe')
			{
				foreach($filess as $filesObj ){
					$this->data['rowData'][$ct]['id'] = $filesObj->id;
					$this->data['rowData'][$ct]['name'] = $filesObj->file_name;
					$this->data['rowData'][$ct]['ftype'] = 'file';
					$this->data['rowData'][$ct]['imgsrc'] = $imgsrc;
					$this->data['rowData'][$ct]['filecount'] = '';
					$this->data['rowData'][$ct]['foldercount'] = '';
					$this->data['rowData'][$ct]['tiff_files'] = '';
					$this->data['rowData'][$ct]['title'] = $filesObj->file_title;
					$this->data['rowData'][$ct]['description'] = $filesObj->file_description;
					$this->data['rowData'][$ct]['file_display_name'] = $filesObj->file_display_name;
					$this->data['rowData'][$ct]['cover_img'] = '';
					$this->data['rowData'][$ct]['sort_num'] = $filesObj->file_sort_num;
					$this->data['rowData'][$ct]['assign_front'] = 'no';
					$this->data['rowData'][$ct]['imgpath'] = $imgpath;
					$this->data['rowData'][$ct]['assign_lightbox'] = 'no';
					$this->data['rowData'][$ct]['hotel_help_update'] = '';
					
					$frontend_files = DB::table('tb_frontend_container')->select('id')->where('container_id',$filesObj->id)->where('container_type','file')->first();
					if(!empty($frontend_files))
					{
						$this->data['rowData'][$ct]['assign_front'] = 'yes';
					}
					$frontend_lightbox = DB::table('tb_frontend_lightbox')->select('id')->where('container_id',$filesObj->id)->where('container_type','file')->first();
					if(!empty($frontend_lightbox))
					{
						$this->data['rowData'][$ct]['assign_lightbox'] = 'yes';
					}
					
					$exFtype = explode('/',$filesObj->file_type);
					if($exFtype[1]=="tiff")
					{
						$this->data['rowData'][$ct]['tiff_files'] = DB::table('tb_container_tiff_files')->select('id','file_name')->where('file_id', $filesObj->id)->get();
					}
					if($exFtype[0]=="image")
					{
						if (!File::exists(public_path(). '/uploads/thumbs/thumb_'.$filesObj->folder_id.'_'.$filesObj->file_name))
						{
							$mdimg = \Image::make($imgpath.$filesObj->file_name);
							$mdimg->resize(128, 130);
							$thumbfile = 'thumb_'.$filesObj->folder_id.'_'.$filesObj->file_name;
							$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
						}
						
						if (!File::exists(public_path(). '/uploads/thumbs/format_'.$filesObj->folder_id.'_'.$filesObj->file_name))
						{
							$mdimg = \Image::make($imgpath.$filesObj->file_name);
							$actualsize = getimagesize($imgpath.$filesObj->file_name);
							if($actualsize[0]>$actualsize[1])
							{
								$mdimg->resize(320, null, function ($constraint) {
									$constraint->aspectRatio();
								});
							}
							else
							{
								$mdimg->resize(null, 320, function ($constraint) {
									$constraint->aspectRatio();
								});
							}
							$thumbfile = 'format_'.$filesObj->folder_id.'_'.$filesObj->file_name;
							$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
						}
						if (!File::exists(public_path(). '/uploads/thumbs/highflip_'.$filesObj->folder_id.'_'.$filesObj->file_name))
						{
							$mdimg = \Image::make($imgpath.$filesObj->file_name);
							$actualsize = getimagesize($imgpath.$filesObj->file_name);
							if($actualsize[0]>$actualsize[1])
							{
								$mdimg->resize(1000, null, function ($constraint) {
									$constraint->aspectRatio();
								});
							}
							else
							{
								$mdimg->resize(null, 1000, function ($constraint) {
									$constraint->aspectRatio();
								});
							}
							$thumbfile = 'highflip_'.$filesObj->folder_id.'_'.$filesObj->file_name;
							$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
						}
					}
					
					// delete landing_info view
					if( File::exists(public_path() . '/uploads/thumbs/landing_info_'. $filesObj->folder_id.'_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/thumbs/landing_info_'. $filesObj->folder_id.'_'.$filesObj->file_name);
					}
					
					// delete front_slider view
					if( File::exists(public_path() . '/uploads/thumbs/front_slider_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/thumbs/front_slider_'.$filesObj->file_name);
					}
					
					// delete product_detail_list 
					if( File::exists(public_path() . '/uploads/thumbs/product_detail_list_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/thumbs/product_detail_list_'.$filesObj->file_name);
					}
					
					// delete product file
					if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name);
					}
					
					// delete material file
					if( File::exists(public_path() . '/uploads/folder_cover_imgs/material_file_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/folder_cover_imgs/material_file_'.$filesObj->file_name);
					}
					
					// delete masonry_product_file
					if( File::exists(public_path() . '/uploads/folder_cover_imgs/masonry_product_file_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/folder_cover_imgs/masonry_product_file_'.$filesObj->file_name);
					}
					
					// delete product file
					if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name);
					}
					
					// delete folder cover front file
					if( File::exists(public_path() . '/uploads/folder_cover_imgs/front_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/folder_cover_imgs/front_'.$filesObj->file_name);
					}
					
					// delete folder cover product file
					if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/folder_cover_imgs/product_'.$filesObj->file_name);
					}
					
					// delete folder cover masonry_product file
					if( File::exists(public_path() . '/uploads/folder_cover_imgs/masonry_product_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/folder_cover_imgs/masonry_product_'.$filesObj->file_name);
					}
					
					// delete folder cover product_detail_cover file
					if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_detail_cover_'.$filesObj->file_name))
					{
						File::delete(public_path() . '/uploads/folder_cover_imgs/product_detail_cover_'.$filesObj->file_name);
					}
					$ct++;
				}
			}
			else{
				$selfiles = DB::table('tb_permissions')->select('view','inherit')->where('folder_id',$id)->where('user_id',$uid)->first();
				if(!empty($selfiles))
				{
					if($selfiles->view==1 || $selfiles->inherit==1)
					{
						foreach($filess as $filesObj ){
							$this->data['rowData'][$ct]['id'] = $filesObj->id;
							$this->data['rowData'][$ct]['name'] = $filesObj->file_name;
							$this->data['rowData'][$ct]['ftype'] = 'file';
							$this->data['rowData'][$ct]['imgsrc'] = $imgsrc;
							$this->data['rowData'][$ct]['filecount'] = '';
							$this->data['rowData'][$ct]['foldercount'] = '';
							$this->data['rowData'][$ct]['tiff_files'] = '';
							$this->data['rowData'][$ct]['title'] = $filesObj->file_title;
							$this->data['rowData'][$ct]['description'] = $filesObj->file_description;
							$this->data['rowData'][$ct]['file_display_name'] = $filesObj->file_display_name;
							$this->data['rowData'][$ct]['cover_img'] = '';
							$this->data['rowData'][$ct]['sort_num'] = $filesObj->file_sort_num;
							$this->data['rowData'][$ct]['hotel_help_update'] = '';
							
							$exFtype = explode('/',$filesObj->file_type);
							if($exFtype[1]=="tiff")
							{
								$this->data['rowData'][$ct]['tiff_files'] = DB::table('tb_container_tiff_files')->select('id','file_name')->where('file_id', $filesObj->id)->get();
							}
							if($exFtype[0]=="image")
							{
								if (!File::exists(public_path(). '/uploads/thumbs/thumb_'.$filesObj->folder_id.'_'.$filesObj->file_name))
								{
									$mdimg = \Image::make($imgpath.$filesObj->file_name);
									$mdimg->resize(128, 130);
									$thumbfile = 'thumb_'.$filesObj->folder_id.'_'.$filesObj->file_name;
									$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
								}
								
								if (!File::exists(public_path(). '/uploads/thumbs/format_'.$filesObj->folder_id.'_'.$filesObj->file_name))
								{
									$mdimg = \Image::make($imgpath.$filesObj->file_name);
									$actualsize = getimagesize($imgpath.$filesObj->file_name);
									if($actualsize[0]>$actualsize[1])
									{
										$mdimg->resize(320, null, function ($constraint) {
											$constraint->aspectRatio();
										});
									}
									else
									{
										$mdimg->resize(null, 320, function ($constraint) {
											$constraint->aspectRatio();
										});
									}
									$thumbfile = 'format_'.$filesObj->folder_id.'_'.$filesObj->file_name;
									$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
								}
								if (!File::exists(public_path(). '/uploads/thumbs/highflip_'.$filesObj->folder_id.'_'.$filesObj->file_name))
								{
									$mdimg = \Image::make($imgpath.$filesObj->file_name);
									$actualsize = getimagesize($imgpath.$filesObj->file_name);
									if($actualsize[0]>$actualsize[1])
									{
										$mdimg->resize(1000, null, function ($constraint) {
											$constraint->aspectRatio();
										});
									}
									else
									{
										$mdimg->resize(null, 1000, function ($constraint) {
											$constraint->aspectRatio();
										});
									}
									$thumbfile = 'highflip_'.$filesObj->folder_id.'_'.$filesObj->file_name;
									$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
								}
							}
							
							// delete landing_info view
							if( File::exists(public_path() . '/uploads/thumbs/landing_info_'. $filesObj->folder_id.'_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/thumbs/landing_info_'. $filesObj->folder_id.'_'.$filesObj->file_name);
							}
							
							// delete front_slider view
							if( File::exists(public_path() . '/uploads/thumbs/front_slider_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/thumbs/front_slider_'.$filesObj->file_name);
							}
							
							// delete product_detail_list 
							if( File::exists(public_path() . '/uploads/thumbs/product_detail_list_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/thumbs/product_detail_list_'.$filesObj->file_name);
							}
							
							// delete product file
							if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name);
							}
							
							// delete material file
							if( File::exists(public_path() . '/uploads/folder_cover_imgs/material_file_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/folder_cover_imgs/material_file_'.$filesObj->file_name);
							}
							
							// delete masonry_product_file
							if( File::exists(public_path() . '/uploads/folder_cover_imgs/masonry_product_file_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/folder_cover_imgs/masonry_product_file_'.$filesObj->file_name);
							}
							
							// delete product file
							if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name);
							}
							
							// delete folder cover front file
							if( File::exists(public_path() . '/uploads/folder_cover_imgs/front_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/folder_cover_imgs/front_'.$filesObj->file_name);
							}
							
							// delete folder cover product file
							if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/folder_cover_imgs/product_'.$filesObj->file_name);
							}
							
							// delete folder cover masonry_product file
							if( File::exists(public_path() . '/uploads/folder_cover_imgs/masonry_product_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/folder_cover_imgs/masonry_product_'.$filesObj->file_name);
							}
							
							// delete folder cover product_detail_cover file
							if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_detail_cover_'.$filesObj->file_name))
							{
								File::delete(public_path() . '/uploads/folder_cover_imgs/product_detail_cover_'.$filesObj->file_name);
							}
							$ct++;
						}
					}
				}
			}
		}
		//print "<pre>";
		//print_r($this->data['rowData']);
		if(!empty($this->data['rowData']))
		{
			usort($this->data['rowData'], function($a, $b) {
				return $a['sort_num'] - $b['sort_num']; 
			});
		}
		
		$subfoldertotal = DB::table('tb_container')->select('id')->where('parent_id',$id);
		$this->data['subfoldertotal'] = $subfoldertotal->count();
				
		$subfilestotal = DB::table('tb_container_files')->select('id')->where('folder_id',$id);
				$this->data['subfilestotal'] = $subfilestotal->count();
		
		$subfileBytes_temp = DB::table('tb_container_files')->where('folder_id',$id);
		$subfileBytes = $subfileBytes_temp->sum('file_size');
		
		$subfileMb = ($subfileBytes/(1000*1000));
		$this->data['subfileSpace'] = round($subfileMb,2,PHP_ROUND_HALF_UP);
		
		
		if(isset($_REQUEST['show']) && trim($_REQUEST['show'])!="")
		{
			$showType = trim($_REQUEST['show']);
		}
		else
		{
			$showType = "thumb";
		}
		
		$this->data['showType'] = $showType;
		$this->data['parent_tags'] = (new TagmanagerController)->fetchTagTree();
		$this->data['fid'] = $id;
		$this->data['group'] = \Auth::user()->group_id;
		
		$sel_attributes = DB::table('tb_attributes')->where('attr_status',1);
		if(\Auth::user()->group_id==2 || \Auth::user()->group_id==3)
		{
			$sel_attributes->where('attr_permission',1);
		}
		$this->data['sel_attributes'] = $sel_attributes->get();
		
		$this->data['sel_tags'] = DB::table('tb_tags_manager')->where('tag_status',1)->get();
		
		$this->data['sel_designer'] = DB::table('tb_designers')->where('designer_status',1)->get();
		
		if(\Auth::user()->group_id==3 && $wnd!='iframe')
		{
			$this->data['userpermissions'] = DB::table('tb_permissions')->where('user_id',$uid)->where('folder_id',$id)->first();
			return view('container.user_index_ajax',$this->data);
		}
		else
		{
			if($wnd=='iframe')
			{
				return view('container.iframe_ajax',$this->data);
			}
			else
			{
			    $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
                $file_name = (strlen($is_demo6) > 0)?$is_demo6.'frontend.themes.emporium.press.media_relation_ajax':'frontend.themes.emporium.press.media_relation_ajax';  
				return view('frontend.themes.emporium.press.media_relation_ajax',$this->data);
			}
		}
	}
    
    function PressDownloadZipSelected()
	{
		$downFileName = 'zip-'.date('d-m-Y').'.zip';
		if( File::exists(public_path() . '/uploads/zip/'.$downFileName))
		{
			File::delete(public_path() . '/uploads/zip/'.$downFileName);
		}
		$items = Input::get('selectedfiles');
		if($items!='')
		{
			$comsep = explode(',',$items);
			foreach($comsep as $sepr)
			{
				$undsep = explode('-',$sepr);
				if($undsep[0]=='folder')
				{
					$folderdirPath = $this->getContainerUserPath($undsep[1]);
					$files[] = $folderdirPath;
				}
				if($undsep[0]=='file')
				{
					$file = DB::table('tb_container_files')->where('id', $undsep[1])->first();
					$filedirPath = $this->getContainerUserPath($file->folder_id);
					$files[] = $filedirPath.$file->file_name;
				}
			}
			Zipper::make('uploads/zip/'.$downFileName)->add($files);
			
			$headers = array(
				'Content-Type' => 'application/octet-stream',
			);
			
			$dopath = Zipper::getFilePath();
			Zipper::close();
			// Download .zip file.
			return Redirect::away(\URL::to($dopath));
			//return \Response::download( public_path() . '/'.$dopath, $downFileName, $headers );
		}
		else
		{
			return Redirect::to('press')->with('messagetext','Please Select Folders/Files First.')->with('msgstatus','error');
		}
		
	}
	
    function PressDownloadlowPdfSelected()
	{
		$downFileName = 'lowres-'.date('d-m-Y').'.pdf';
		$items = Input::get('selectedfiles');
		if(($items!='') && strpos($items, 'file') !== false)
		{
			$folderInfo = DB::table('tb_container')->join('tb_users', 'tb_users.id', '=', 'tb_container.user_id')->select('tb_users.first_name', 'tb_users.last_name', 'tb_container.display_name as folderName')->where('tb_container.id', Input::get('fold_id'))->first();
			
			$html = '<style>.page-break { page-break-after: always; } .header,.footer {width: 100%; position:fixed;}.header {top: 0px;}.footer {bottom: 0px;}.pagenum:after {content: counter(page);}.imgBox {	border:1px solid #000;padding:20px; text-align:center; width:320px; margin:0 auto;}</style>';
			$html .= '<div class="header"><span>'.$folderInfo->first_name.' '.$folderInfo->last_name.'</span><br><span>Folder: '.$folderInfo->folderName.'</span></div><br><br><br><div class="footer"><span class="pagenum">Page </span></div>';
			
			$comsep = explode(',',$items);
			$i=0;
			$countArr = count($comsep);
			
			foreach($comsep as $sepr)
			{
				$i++;
				$undsep = explode('-',$sepr);
				if($undsep[0]=='folder')
				{
					$i--;
				}
				if($undsep[0]=='file')
				{
					$file = DB::table('tb_container_files')->where('id', $undsep[1])->first();
					$filedirPath = $this->getContainerUserPath($file->folder_id);
					$html .='<div class="imgBox"><img src="'.$filedirPath.$file->file_name.'" style="width:270px;"></div><p style="text-align:center;">'.$file->file_name.'</p><br>';
					if(($i%2)==0)
					{
						$html .='<div class="page-break"></div>';
					}
				}
			}
			
			$pdf = \App::make('dompdf.wrapper');
			$pdf->loadHTML($html);
			return $pdf->download($downFileName);
			
		}
		else
		{
			return Redirect::to('press')->with('messagetext','Please Select Files First.')->with('msgstatus','error');
		}
	}
	
	function PressDownloadhighPdfSelected()
	{
		$downFileName = 'highres-'.date('d-m-Y').'.pdf';
		$items = Input::get('selectedfiles');
		if(($items!='') && strpos($items, 'file') !== false)
		{
			$folderInfo = DB::table('tb_container')->join('tb_users', 'tb_users.id', '=', 'tb_container.user_id')->select('tb_users.first_name', 'tb_users.last_name', 'tb_container.display_name as folderName')->where('tb_container.id', Input::get('fold_id'))->first();
			
			$html = '<style>.page-break { page-break-after: always; } .header,.footer {width: 100%; position:fixed;}.header {top: 0px;}.footer {bottom: 0px;}.pagenum:after {content: counter(page);}.imgBox {	border:1px solid #000;padding:20px; text-align:center; width:580px; margin:0 auto;}</style>';
			$html .= '<div class="header"><span>'.$folderInfo->first_name.' '.$folderInfo->last_name.'</span><br><span>Folder: '.$folderInfo->folderName.'</span></div><br><br><br><div class="footer"><span class="pagenum">Page </span></div>';
			
			$comsep = explode(',',$items);
			$i=0;
			$countArr = count($comsep);
			
			foreach($comsep as $sepr)
			{
				$i++;
				$undsep = explode('-',$sepr);
				if($undsep[0]=='folder')
				{
					$i--;
				}
				if($undsep[0]=='file')
				{
					$file = DB::table('tb_container_files')->where('id', $undsep[1])->first();
					$filedirPath = $this->getContainerUserPath($file->folder_id);
					$html .='<div class="imgBox"><img src="'.$filedirPath.$file->file_name.'" style="max-width:540px;"></div><p style="text-align:center;">'.$file->file_name.'</p><br>';
					if($i<$countArr)
					{
						$html .='<div class="page-break"></div>';
					}
				}
			}
			
			$pdf = \App::make('dompdf.wrapper');
			$pdf->loadHTML($html);
			return $pdf->download($downFileName);
			
		}
		else
		{
			return Redirect::to('press')->with('messagetext','Please Select Files First.')->with('msgstatus','error');
		}
	}
    
    public function pressSearchAjax( Request $request)
	{
		
		$record_per_page = 50;
		$page_number = 1;
		if(isset($_GET['page'])){
			$page_number = $_GET['page'];
		}

		if($this->access['is_view'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
		$uid = \Auth::user()->id;
		
		$keyword = trim($request->input('searchkeyword'));
		//$filter = " AND 'name','media-relations'";
        $filter = " AND name='media-relations'"; 
		$filter .= " AND (display_name like '%".$keyword."%' or file_type like '%".$keyword."%' or title like '%".$keyword."%' or description like '%".$keyword."%')";
		
		$params = array(
			'params'	=> $filter,
			'page'=> $page_number,
			'limit' => $record_per_page
		);

		$params1 = array(
			'params'	=> $filter
		);
		// Get Query 
		$results = $this->model->getRows( $params );

		$resultsTotal = $this->model->getRows($params1 );
		
        $cont = \DB::table('tb_container')->where('name', 'media-relations')->first();
        $cont_id = (int)$cont->id;
       //echo $id; die;
		$filess_temp = DB::table('tb_container_files')->join('tb_container', 'tb_container.id', '=', 'tb_container_files.folder_id')->where(function ($query) use ($cont_id) { $query->where('tb_container.parent_id', $cont_id); })->where(function ($query) use ($keyword) { $query->where('file_name', 'like' ,'%'.$keyword.'%')->orWhere('tb_container_files.file_type', 'like' ,'%'.$keyword.'%')->orWhere('file_title', 'like' ,'%'.$keyword.'%')->orWhere('file_description', 'like' ,'%'.$keyword.'%')->orWhere('file_display_name', 'like' ,'%'.$keyword.'%');});
		$filess_temp_full = DB::table('tb_container_files')->join('tb_container', 'tb_container.id', '=', 'tb_container_files.folder_id')->where(function ($query) use ($cont_id) { $query->where('tb_container.parent_id', $cont_id); })->where(function ($query) use ($keyword) { $query->where('file_name', 'like' ,'%'.$keyword.'%')->orWhere('tb_container_files.file_type', 'like' ,'%'.$keyword.'%')->orWhere('file_title', 'like' ,'%'.$keyword.'%')->orWhere('file_description', 'like' ,'%'.$keyword.'%')->orWhere('file_display_name', 'like' ,'%'.$keyword.'%');});
		if(\Auth::user()->group_id==2)
		{
			$filess_temp->where('user_id',$uid);
			$filess_temp_full->where('user_id',$uid);
		}
		$filess = $filess_temp->get();

		$filessTotal = $filess_temp_full->get();

		$totalRecord = $resultsTotal['total'] + count($filessTotal);
        //print_r($totalRecord); die;
		$this->data['pagination']['total_folder'] = $totalRecord;
		$this->data['pagination']['total_page'] = ($totalRecord>0)?(ceil($totalRecord/$record_per_page)):0;
		$this->data['pagination']['current_page'] = $page_number;
		$this->data['pagination']['prev_page'] = ($page_number>0)?($page_number - 1):0;
		$this->data['pagination']['next_page'] = ($page_number>0)?($page_number + 1):0;
		$filess = array();
		if(count($results['rows'])<$record_per_page){
			if($resultsTotal['total']>0){
				$startOffset = 0;
				$limitFiles = count($results['rows']) - $record_per_page;
			}else{
				$startOffset = ($page_number - 1) * $record_per_page;
				$limitFiles = $record_per_page;
			}
			//$filess = $filess_temp->offset($startOffset)->limit($limitFiles)->get();
		}
	
		$ct=0; 
		$this->data['rowData'] = array();
		
		foreach($results['rows'] as $folderObj ){
			$totfiles = DB::table('tb_container_files')->select('id')->where('folder_id',$folderObj->id)->count();
			$totfolders = DB::table('tb_container')->select('id')->where('parent_id',$folderObj->id)->count();
			$frontend = DB::table('tb_frontend_container')->select('id')->where('container_id',$folderObj->id)->where('container_type','folder')->first();

			$this->data['rowData'][$ct]['id'] = $folderObj->id;
			$this->data['rowData'][$ct]['folder_id'] = $folderObj->id;
			$this->data['rowData'][$ct]['name'] = $folderObj->display_name;
			$this->data['rowData'][$ct]['ftype'] = 'folder';
			$this->data['rowData'][$ct]['imgsrc'] = '';
			$this->data['rowData'][$ct]['foldercount'] = $totfolders;
			$this->data['rowData'][$ct]['filecount'] = $totfiles;
			$this->data['rowData'][$ct]['tiff_files'] = '';
			$this->data['rowData'][$ct]['title'] = $folderObj->title;
			$this->data['rowData'][$ct]['description'] = $folderObj->description;
			$this->data['rowData'][$ct]['file_display_name'] = '';
			$this->data['rowData'][$ct]['cover_img'] = $folderObj->cover_img;
			$this->data['rowData'][$ct]['sort_num'] = $folderObj->sort_num;
			$this->data['rowData'][$ct]['assign_front'] = 'no';
			if(!empty($frontend))
			{
				$this->data['rowData'][$ct]['assign_front'] = 'yes';
			}
			$ct++;
		}
		
		foreach($filess as $filesObj ){
			$this->data['rowData'][$ct]['id'] = $filesObj->id;
			$this->data['rowData'][$ct]['folder_id'] = $filesObj->folder_id;
			$this->data['rowData'][$ct]['name'] = $filesObj->file_name;
			$this->data['rowData'][$ct]['ftype'] = 'file';
			$imgsrc = $this->getThumbpath($filesObj->folder_id);
			$this->data['rowData'][$ct]['imgsrc'] = $imgsrc;
			$this->data['rowData'][$ct]['filecount'] = '';
			$this->data['rowData'][$ct]['foldercount'] = '';
			$this->data['rowData'][$ct]['tiff_files'] = '';
			$this->data['rowData'][$ct]['title'] = $filesObj->file_title;
			$this->data['rowData'][$ct]['description'] = $filesObj->file_description;
			$this->data['rowData'][$ct]['file_display_name'] = $filesObj->file_display_name;
			$this->data['rowData'][$ct]['cover_img'] = '';
			$this->data['rowData'][$ct]['sort_num'] = $filesObj->file_sort_num;
			if(\Auth::user()->group_id!=3)
			{
				$this->data['rowData'][$ct]['assign_front'] = 'no';
				
				$frontend_files = DB::table('tb_frontend_container')->where('container_id',$filesObj->id)->where('container_type','file')->first();
				if(!empty($frontend_files))
				{
					$this->data['rowData'][$ct]['assign_front'] = 'yes';
				}
			}
			
			$exFtype = explode('/',$filesObj->file_type);
			if($exFtype[1]=="tiff")
			{
				$this->data['rowData'][$ct]['tiff_files'] = DB::table('tb_container_tiff_files')->where('file_id', $filesObj->id)->get();
			}
			$ct++;
		}
		
		
				
		if(isset($_REQUEST['show']) && trim($_REQUEST['show'])!="")
		{
			$showType = trim($_REQUEST['show']);
		}
		else
		{
			$showType = "thumb";
		}
		$this->data['group'] = \Auth::user()->group_id;
		$this->data['showType'] = $showType;
		
		$this->data['searchedkeyword'] = $keyword;
		
		return view('container.presssearch_ajax',$this->data);
	}
    
    public function PressShowfiles( $fid = 0, $id = 0)
	{
		$uid = \Auth::user()->id;
		if($this->access['is_detail'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
					
		
		$file_temp = DB::table('tb_container_files')->join('tb_container', 'tb_container.id', '=', 'tb_container_files.folder_id')->join('tb_users', 'tb_users.id', '=', 'tb_container_files.user_id')->select('tb_users.first_name', 'tb_users.last_name', 'tb_container_files.*', 'tb_container.display_name as folderName')->where('tb_container_files.id', $id);
		
		$file = $file_temp->first();
		
		$spaceAllowed = \Auth::user()->storage_space;
		if($spaceAllowed==0){ $spaceAllowed = 1; }
		$usedSpaceBytes_temp = DB::table('tb_container_files');
		if(\Auth::user()->group_id==2)
		{
			$usedSpaceBytes_temp->where('user_id',$uid);
		}
		$usedSpaceBytes = $usedSpaceBytes_temp->sum('file_size');
		if(\Auth::user()->group_id!=3)
		{
			$usedSpaceMb = ($usedSpaceBytes/(1000*1000));
			$usedSpace = round($usedSpaceMb,2,PHP_ROUND_HALF_UP);
			$usedSpacePercentage = ($usedSpace*100)/$spaceAllowed;
			$this->data['allowStorage'] = $spaceAllowed;
			$this->data['usedStorage'] = $usedSpace;
			$this->data['usedStoragePerct'] = round($usedSpacePercentage,2,PHP_ROUND_HALF_UP);
		}
		
		if(isset($_REQUEST['show']) && trim($_REQUEST['show'])!="")
		{
			$showType = trim($_REQUEST['show']);
		}
		else
		{
			$showType = "thumb";
		}
		
		$this->data['showType'] = $showType;
		$this->data['tree'] = $this->fetchPressTreeList('','','', $showType);
		$this->data['access'] = $this->access;
		$this->data['prevfolder'] = $fid;
		$this->data['fileId'] = $id;
		$this->data['group'] = \Auth::user()->group_id;
		$this->data['rowFile'] = $file;
		$imgsrc = $this->getThumbpath($file->folder_id);
		$this->data['rowFile']->imgsrc = $imgsrc;
		if(\Auth::user()->group_id==3)
		{
			$this->data['userpermissions'] = \DB::table('tb_permissions')->where('user_id',$uid)->where('folder_id',$fid)->first();
		}
		$this->data['rel_files'] = '';
		if($file->file_type=="image/tiff")
		{
			$this->data['rel_files'] = \DB::table('tb_container_tiff_files')->where('file_id',$file->id)->get();
		}
		
		$AttrArr = array();
		$TagArr = array();
		$parentList = $this->fetchFolderParentListIds($fid);
		array_unshift($parentList, $id, $fid);
		foreach($parentList as $attrList)
		{
			$checkattr = \DB::table('tb_container_attributes')->where('container_id',$attrList)->get();
			if(!empty($checkattr))
			{
				$a=0;
				foreach($checkattr as $fetchattr)
				{
					$AttrArr[$a]['AttrType'] = $fetchattr->attr_type;
					$AttrArr[$a]['Attrs'] = \DB::table('tb_attributes')->where('id',$fetchattr->attr_id)->first();
					if($fetchattr->attr_type=="checkboxes" || $fetchattr->attr_type=="dropdown" || $fetchattr->attr_type=="radio")
					{
						$expAttrval = explode(',',$fetchattr->attr_value);
						$AttrArr[$a]['AttrVal'] = \DB::table('tb_attributes_options')->whereIn('id',$expAttrval)->get();
					}
					else{
						$AttrArr[$a]['AttrVal'] = $fetchattr->attr_value;
					}
					$a++;
				}
			}
			
			$checktag = \DB::table('tb_container_tags')->where('container_id',$attrList)->get();
			if(!empty($checktag))
			{
				foreach($checktag as $fetchtag)
				{
					$checktag = \DB::table('tb_tags_manager')->where('id',$fetchtag->tag_id)->first();
					if(!empty($checktag))
					{
						$TagArr[] = $checktag ;
					}
				}
			}
		}
		
		$this->data['sub_images'] = DB::table('tb_file_subimages')->where('file_id',$file->id)->get();
		$this->data['parentArr'] = array_reverse($this->fetchFolderParentListArray($fid));
		
		$this->data['AttrArr'] = $AttrArr;
		$this->data['TagArr'] = $TagArr;
		$sel_attributes = DB::table('tb_attributes')->where('attr_status',1);
		if(\Auth::user()->group_id==2 || \Auth::user()->group_id==3)
		{
			$sel_attributes->where('attr_permission',1);
		}
		$this->data['sel_attributes'] = $sel_attributes->get();
		
		$this->data['varients'] = DB::table('tb_file_varients')->where('file_id',$file->id)->get();
		$check_varint_attr = DB::table('tb_varient_attributes')->where('file_id',$file->id)->get();
		$var_attr = array();
		if(!empty($check_varint_attr))
		{
			foreach($check_varint_attr as $varint_attr)
			{
				$var_attr[$varint_attr->varient_id][$varint_attr->attr_id]['AttrType'] = $varint_attr->attr_type;
				$var_attr[$varint_attr->varient_id][$varint_attr->attr_id]['AttrId'] = $varint_attr->attr_id;
				$var_attr[$varint_attr->varient_id][$varint_attr->attr_id]['VarAttrId'] = $varint_attr->id;
				$var_attr[$varint_attr->varient_id][$varint_attr->attr_id]['Attrs'] = \DB::table('tb_attributes')->where('id',$varint_attr->attr_id)->where('attr_status',1)->first();
				if($varint_attr->attr_type=="checkboxes" || $varint_attr->attr_type=="dropdown" || $varint_attr->attr_type=="radio")
				{
					$var_attr[$varint_attr->varient_id][$varint_attr->attr_id]['AttrVal'] = $varint_attr->attr_value;
					$var_attr[$varint_attr->varient_id][$varint_attr->attr_id]['AttrOpts'] = DB::table('tb_attributes_options')->where('attr_id',$varint_attr->attr_id)->get();
				}
				else{
					$var_attr[$varint_attr->varient_id][$varint_attr->attr_id]['AttrVal'] = $varint_attr->attr_value;
				}
			}
		}
		
		//print "<pre>";
		//print_r($var_attr);
		
		$this->data['varient_attrs'] = $var_attr;
		
		$this->data['sel_tags'] = DB::table('tb_tags_manager')->where('tag_status',1)->get();
        
		$this->data['slider'] = \DB::table('tb_sliders')->where('slider_category', 'Hotel')->where('slider_status',1)->orderBy('sort_num','asc')->get();
        $this->data['slug'] = '';
        
        $this->data['destination_category'] =0;
        
        //$media_id = DB::table('tb_container')->where('name', 'media-relations')->first();
        
        //$this->data['fid'] = $media_id->id;
        
		return view('frontend.themes.emporium.press.view',$this->data);	
	}
    
    function fetchPressTreeList($parent = 0, $user_tree_array = '', $wnd = '', $showType='thumb') {
 
		if (!is_array($user_tree_array))
		$user_tree_array = array();
	    
        $obj_media = DB::table('tb_container')->where('name','media-relations')->first();
        
		$uid = \Auth::user()->id;
		$filter = " AND id='".$obj_media->id."'";
		
		$params = array(
			'params'	=> $filter,
			'order'		=> 'asc'
		);
		// Get Query 
		$results = $this->model->getRows( $params );
		
	  if ($results) {
		 $user_tree_array[] = '<ul class="folders parent'.$parent.'" rel="pr_'.$parent.'">';
		 
		if(!empty($results['rows']))
		{
			usort($results['rows'], function($a, $b) {
				return $a->sort_num - $b->sort_num; 
			});
		}
		
		foreach($results['rows'] as $row) {
			$totfiles_temp = DB::table('tb_container_files')->select('id')->where('folder_id',$row->id);
			if(\Auth::user()->group_id==2 && $wnd!='iframe')
			{
				//$totfiles_temp->where('user_id',$uid);
			}
			$totfiles = $totfiles_temp->count();
			
			$totfolder_temp = DB::table('tb_container')->select('id')->where('parent_id',$row->id);
			if(\Auth::user()->group_id==2 && $wnd!='iframe')
			{
				//$totfolder_temp->where('user_id',$uid);
			}
			$totfolders = $totfolder_temp->count();
			if($wnd=='iframe')
			{
				$url = \URL::to('foldersiframe/'.$row->id.'/iframe');
			}
			else{
				$url = \URL::to('getFolderListAjax/'.$row->id.'?show='.$showType);
			}
			
			$active_cls = '';
			if($parent==$row->id){
				$active_cls = 'class="active"';
			}
			if($wnd=='iframe')
			{
				/*$childs = $this->fetchFolderChildListIds(30);
				if($row->id==30 || in_array($row->id,$childs))
				{*/ 
					$user_tree_array[] = '<li '.$active_cls.'><a href="'.$url.'" data-action="expend-folder-tree-iframe" class="expand" title="" rel="'.$row->id.'"><span>'. $row->display_name.'<span>('.$totfolders.', '.$totfiles.')</span></span></a></li>';
				//}
			}
			else
			{
				$user_tree_array[] = '<li '.$active_cls.'><a href="'.$url.'" class="expand" title="" data-action="expend-folder-tree" rel="'.$row->id.'"><span>'. $row->display_name.'<span>('.$totfolders.', '.$totfiles.')</span></span></a></li>';
			}
		 // $user_tree_array = $this->fetchFolderTreeList($row->id, $user_tree_array, $wnd, $showType);
		}
	    $user_tree_array[] = "</ul>";
	  }
	  return $user_tree_array;
	}
    
    public function PressShowfilesAjax( $fid = 0, $id = 0)
	{	  
		$file_temp = DB::table('tb_container_files')->join('tb_container', 'tb_container.id', '=', 'tb_container_files.folder_id')->join('tb_users', 'tb_users.id', '=', 'tb_container_files.user_id')->select('tb_users.first_name', 'tb_users.last_name', 'tb_container_files.*', 'tb_container.display_name as folderName')->where('tb_container_files.id', $id);
		
		$file = $file_temp->first();
		
		$spaceAllowed = \Auth::user()->storage_space;
		if($spaceAllowed==0){ $spaceAllowed = 1; }
		$usedSpaceBytes_temp = DB::table('tb_container_files');
		if(\Auth::user()->group_id==2)
		{
			$usedSpaceBytes_temp->where('user_id',$uid);
		}
		$usedSpaceBytes = $usedSpaceBytes_temp->sum('file_size');
		if(\Auth::user()->group_id!=3)
		{
			$usedSpaceMb = ($usedSpaceBytes/(1000*1000));
			$usedSpace = round($usedSpaceMb,2,PHP_ROUND_HALF_UP);
			$usedSpacePercentage = ($usedSpace*100)/$spaceAllowed;
			$this->data['allowStorage'] = $spaceAllowed;
			$this->data['usedStorage'] = $usedSpace;
			$this->data['usedStoragePerct'] = round($usedSpacePercentage,2,PHP_ROUND_HALF_UP);
		}
		
		if(isset($_REQUEST['show']) && trim($_REQUEST['show'])!="")
		{
			$showType = trim($_REQUEST['show']);
		}
		else
		{
			$showType = "thumb";
		}
		
		$this->data['showType'] = $showType;
		$this->data['tree'] = $this->fetchPressTreeList('','','', $showType);
		$this->data['access'] = $this->access;
		$this->data['prevfolder'] = $fid;
		$this->data['fileId'] = $id;
		$this->data['group'] = \Auth::user()->group_id;
		$this->data['rowFile'] = $file;
		$imgsrc = $this->getThumbpath($file->folder_id);
		$this->data['rowFile']->imgsrc = $imgsrc;
		if(\Auth::user()->group_id==3)
		{
			$this->data['userpermissions'] = \DB::table('tb_permissions')->where('user_id',$uid)->where('folder_id',$fid)->first();
		}
		$this->data['rel_files'] = '';
		if($file->file_type=="image/tiff")
		{
			$this->data['rel_files'] = \DB::table('tb_container_tiff_files')->where('file_id',$file->id)->get();
		}
		
		$AttrArr = array();
		$TagArr = array();
		$parentList = $this->fetchFolderParentListIds($fid);
		array_unshift($parentList, $id, $fid);
		foreach($parentList as $attrList)
		{
			$checkattr = \DB::table('tb_container_attributes')->where('container_id',$attrList)->get();
			if(!empty($checkattr))
			{
				$a=0;
				foreach($checkattr as $fetchattr)
				{
					$AttrArr[$a]['AttrType'] = $fetchattr->attr_type;
					$AttrArr[$a]['Attrs'] = \DB::table('tb_attributes')->where('id',$fetchattr->attr_id)->first();
					if($fetchattr->attr_type=="checkboxes" || $fetchattr->attr_type=="dropdown" || $fetchattr->attr_type=="radio")
					{
						$expAttrval = explode(',',$fetchattr->attr_value);
						$AttrArr[$a]['AttrVal'] = \DB::table('tb_attributes_options')->whereIn('id',$expAttrval)->get();
					}
					else{
						$AttrArr[$a]['AttrVal'] = $fetchattr->attr_value;
					}
					$a++;
				}
			}
			
			$checktag = \DB::table('tb_container_tags')->where('container_id',$attrList)->get();
			if(!empty($checktag))
			{
				foreach($checktag as $fetchtag)
				{
					$checktag = \DB::table('tb_tags_manager')->where('id',$fetchtag->tag_id)->first();
					if(!empty($checktag))
					{
						$TagArr[] = $checktag ;
					}
				}
			}
		}
		
		$this->data['sub_images'] = DB::table('tb_file_subimages')->where('file_id',$file->id)->get();
		$this->data['parentArr'] = array_reverse($this->fetchFolderParentListArray($fid));
		
		$this->data['AttrArr'] = $AttrArr;
		$this->data['TagArr'] = $TagArr;
		$sel_attributes = DB::table('tb_attributes')->where('attr_status',1);
		if(\Auth::user()->group_id==2 || \Auth::user()->group_id==3)
		{
			$sel_attributes->where('attr_permission',1);
		}
		$this->data['sel_attributes'] = $sel_attributes->get();
		
		$this->data['varients'] = DB::table('tb_file_varients')->where('file_id',$file->id)->get();
		$check_varint_attr = DB::table('tb_varient_attributes')->where('file_id',$file->id)->get();
		$var_attr = array();
		if(!empty($check_varint_attr))
		{
			foreach($check_varint_attr as $varint_attr)
			{
				$var_attr[$varint_attr->varient_id][$varint_attr->attr_id]['AttrType'] = $varint_attr->attr_type;
				$var_attr[$varint_attr->varient_id][$varint_attr->attr_id]['AttrId'] = $varint_attr->attr_id;
				$var_attr[$varint_attr->varient_id][$varint_attr->attr_id]['VarAttrId'] = $varint_attr->id;
				$var_attr[$varint_attr->varient_id][$varint_attr->attr_id]['Attrs'] = \DB::table('tb_attributes')->where('id',$varint_attr->attr_id)->where('attr_status',1)->first();
				if($varint_attr->attr_type=="checkboxes" || $varint_attr->attr_type=="dropdown" || $varint_attr->attr_type=="radio")
				{
					$var_attr[$varint_attr->varient_id][$varint_attr->attr_id]['AttrVal'] = $varint_attr->attr_value;
					$var_attr[$varint_attr->varient_id][$varint_attr->attr_id]['AttrOpts'] = DB::table('tb_attributes_options')->where('attr_id',$varint_attr->attr_id)->get();
				}
				else{
					$var_attr[$varint_attr->varient_id][$varint_attr->attr_id]['AttrVal'] = $varint_attr->attr_value;
				}
			}
		}
		
		//print "<pre>";
		//print_r($var_attr);
		
		$this->data['varient_attrs'] = $var_attr;
		
		$this->data['sel_tags'] = DB::table('tb_tags_manager')->where('tag_status',1)->get();
        
		$this->data['slider'] = \DB::table('tb_sliders')->where('slider_category', 'Hotel')->where('slider_status',1)->orderBy('sort_num','asc')->get();
        $this->data['slug'] = '';
        
        $this->data['destination_category'] =0;
        
        //$media_id = DB::table('tb_container')->where('name', 'media-relations')->first();
        
        //$this->data['fid'] = $media_id->id;
        
		return view('frontend.themes.emporium.press.view',$this->data); die;	
	}
    
    public function hotelcontainer( Request $request, $id = 0, $wnd = '' )
	{
        if($this->access['is_view'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
		$uid = \Auth::user()->id;
        
        
        
        $prop_id = 0;
        $property_name = '';
        $obj_property = \DB::table('tb_properties')->where('user_id', $uid)->orWhere('assigned_user_id', $uid)->first();
        if(!empty($obj_property)){
            $prop_id = $obj_property->id;
            $property_name = $obj_property->property_name;
        }
        $this->data['pid'] = $prop_id;
        
        $fileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*',  \DB::raw("(CASE WHEN (tb_container_files.file_display_name = '') THEN tb_container_files.file_name ELSE tb_container_files.file_display_name END) as file_display_name"), 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $prop_id)->get();
        if(!empty($fileArr)){
            $id = $fileArr[0]->folder_id;
        
        
		
    		$filter = " AND parent_id='".$id."'";
    		if(\Auth::user()->group_id==3 && $wnd!='iframe')
    		{
    			$filter .= " AND (id in (select folder_id from tb_permissions where user_id='".$uid."' and no_permission='0') or global_permission='1')";
    		}
    		if(\Auth::user()->group_id==2 && $wnd!='iframe')
    		{
    			//$filter .= " AND (user_id='".$uid."' or (user_id!='".$uid."' and global_permission='1'))";
    		}
    		$params = array(
    			'params'	=> $filter
    		);
    		// Get Query 
    		$results = $this->model->getRows( $params );
    		
    		$foldername = DB::table('tb_container')->where('id',$id);
    		$this->data['foldername'] = $foldername->select('display_name','parent_id','user_id', 'global_permission', 'title', 'description','display_name_eng','title_eng','description_eng')->first();
    		
    		$this->data['parentArr'] = array_reverse($this->fetchFolderParentListArray($id));
    
    		$filess_temp = DB::table('tb_container_files')->select('id','file_name','folder_id','file_title','file_description','file_display_name','file_sort_num','file_type')->where('folder_id',$id);
    		if(\Auth::user()->group_id==2 && (!empty($this->data['foldername'] && $this->data['foldername']->global_permission==0)) && $wnd!='iframe')
    		{
    			//$filess_temp->where('user_id',$uid);
    		}
    		$filess = $filess_temp->get();
    	
    		$ct=0; 
    		$this->data['rowData'] = array();
    		if(!empty($results['rows'])){
    		foreach($results['rows'] as $folderObj ){
    			if($wnd=='iframe')
    			{
    				/*$childs = $this->fetchFolderChildListIds(30);
    				if($folderObj->id==30 || in_array($folderObj->id,$childs))
    				{*/
    					$totfiles = DB::table('tb_container_files')->select('id')->where('folder_id',$folderObj->id)->count();
    					$totfolders = DB::table('tb_container')->select('id')->where('parent_id',$folderObj->id)->count();
    					$this->data['rowData'][$ct]['id'] = $folderObj->id;
    					$this->data['rowData'][$ct]['name'] = $folderObj->display_name;
    					$this->data['rowData'][$ct]['ftype'] = 'folder';
    					$this->data['rowData'][$ct]['imgsrc'] = '';
    					$this->data['rowData'][$ct]['foldercount'] = $totfolders;
    					$this->data['rowData'][$ct]['filecount'] = $totfiles;
    					$this->data['rowData'][$ct]['tiff_files'] = '';
    					$this->data['rowData'][$ct]['title'] = $folderObj->title;
    					$this->data['rowData'][$ct]['description'] = $folderObj->description;
    					$this->data['rowData'][$ct]['file_display_name'] = '';
    					$this->data['rowData'][$ct]['cover_img'] = $folderObj->cover_img;
    					$this->data['rowData'][$ct]['sort_num'] = $folderObj->sort_num;
    					$this->data['rowData'][$ct]['imgpath'] = '';
    					$this->data['rowData'][$ct]['hotel_help_update'] = $folderObj->hotel_help_update;
    					$ct++;
    				//}
    			}
    			else
    			{
    				$totfiles = DB::table('tb_container_files')->select('id')->where('folder_id',$folderObj->id)->count();
    				$totfolders = DB::table('tb_container')->select('id')->where('parent_id',$folderObj->id)->count();
    				$frontend = DB::table('tb_frontend_container')->select('id')->where('container_id',$folderObj->id)->where('container_type','folder')->first();
    				$this->data['rowData'][$ct]['id'] = $folderObj->id;
    				$this->data['rowData'][$ct]['name'] = $folderObj->display_name;
    				$this->data['rowData'][$ct]['ftype'] = 'folder';
    				$this->data['rowData'][$ct]['imgsrc'] = '';
    				$this->data['rowData'][$ct]['foldercount'] = $totfolders;
    				$this->data['rowData'][$ct]['filecount'] = $totfiles;
    				$this->data['rowData'][$ct]['tiff_files'] = '';
    				$this->data['rowData'][$ct]['title'] = $folderObj->title;
    				$this->data['rowData'][$ct]['description'] = $folderObj->description;
    				$this->data['rowData'][$ct]['file_display_name'] = '';
    				$this->data['rowData'][$ct]['sort_num'] = $folderObj->sort_num;
    				$this->data['rowData'][$ct]['assign_front'] = 'no';
    				$this->data['rowData'][$ct]['assign_lightbox'] = 'no';
    				$this->data['rowData'][$ct]['hotel_help_update'] = $folderObj->hotel_help_update;
    				if(!empty($frontend))
    				{
    					$this->data['rowData'][$ct]['assign_front'] = 'yes';
    				}
    				
    				if($folderObj->cover_img=="" && $folderObj->temp_cover_img=="")
    				{
    					$default_front_design = \DB::table('tb_settings')->select('content')->where('key_value', 'frontend_design')->first();
    					
    					// Set main image first image in folder
    					$checkfile = DB::table('tb_container_files')->select('file_name')->where('folder_id', $folderObj->id)->where(function ($query) { $query->where('file_type', 'image/jpeg')->orWhere('file_type', 'image/png')->orWhere('file_type', 'image/gif');})->orderBy('file_sort_num', 'asc')->first();
    					if(!empty($checkfile))
    					{
    						$destinationPath = $this->getContainerUserPath($folderObj->id);
    						$copytofolder = public_path().'/uploads/folder_cover_imgs/';
    						$find_prd=false;
    						$this->data['rowData'][$ct]['cover_img'] = '';
    						$fileName = $checkfile->file_name;
    													
    						$find_actualsize = getimagesize($destinationPath.$fileName);
    						if($find_actualsize[0]>$find_actualsize[1])
    						{
    							// image for backend
    							if (! \File::exists($copytofolder.'thumb_'.$fileName))
    							{
    								$bkimg = \Image::make($destinationPath.$fileName);
    								$bkimg->resize(128, 130);
    								$bkimgfile = 'thumb_'. $fileName;
    								$bkimg->save($copytofolder.$bkimgfile);
    							}
    							
    							if (! \File::exists($copytofolder.'format_'.$fileName))
    							{
    								$mdimg = \Image::make($destinationPath.$fileName);
    								$thactualsize = getimagesize($destinationPath.$fileName);
    								if($thactualsize[0]>$thactualsize[1])
    								{
    									$mdimg->resize(320, null, function ($constraint) {
    										$constraint->aspectRatio();
    									});
    								}
    								else
    								{
    									$mdimg->resize(null, 320, function ($constraint) {
    										$constraint->aspectRatio();
    									});
    								}
    								$thumbfile = 'format_'.$fileName;
    								$mdimg->save($copytofolder.$thumbfile);
    							}
    							
    							$tcmdata['temp_cover_img'] = $fileName;
    							$tcmdata['updated'] = date('y-m-d');
    							DB::table('tb_container')->where('id', $folderObj->id)->update($tcmdata);
    							
    							if(!empty($default_front_design) && $default_front_design->content=="grid")
    							{
    								$this->data['rowData'][$ct]['cover_img'] = $fileName;
    							}
    							$find_prd=true;
    						}
    					}
    					else{
    						$this->data['rowData'][$ct]['cover_img'] = '';
    					}
    				}
    				else
    				{
    					$this->data['rowData'][$ct]['cover_img'] = ($folderObj->cover_img!='') ? $folderObj->cover_img : $folderObj->temp_cover_img ;
    				}
    				
    				$ct++;
    			}
    			
    		}
            }
    		if(!empty($filess))
    		{
    			$imgsrc = $this->getThumbpath($filess[0]->folder_id);
    			$imgpath = $this->getContainerUserPath($filess[0]->folder_id);
    			if(\Auth::user()->group_id!=3 || (!empty($this->data['foldername'] && $this->data['foldername']->global_permission==1)) || $wnd=='iframe')
    			{
    				foreach($filess as $filesObj ){
    					$this->data['rowData'][$ct]['id'] = $filesObj->id;
    					$this->data['rowData'][$ct]['name'] = $filesObj->file_name;
    					$this->data['rowData'][$ct]['ftype'] = 'file';
    					$this->data['rowData'][$ct]['imgsrc'] = $imgsrc;
    					$this->data['rowData'][$ct]['filecount'] = '';
    					$this->data['rowData'][$ct]['foldercount'] = '';
    					$this->data['rowData'][$ct]['tiff_files'] = '';
    					$this->data['rowData'][$ct]['title'] = $filesObj->file_title;
    					$this->data['rowData'][$ct]['description'] = $filesObj->file_description;
    					$this->data['rowData'][$ct]['file_display_name'] = $filesObj->file_display_name;
    					$this->data['rowData'][$ct]['cover_img'] = '';
    					$this->data['rowData'][$ct]['sort_num'] = $filesObj->file_sort_num;
    					$this->data['rowData'][$ct]['assign_front'] = 'no';
    					$this->data['rowData'][$ct]['imgpath'] = $imgpath;
    					$this->data['rowData'][$ct]['assign_lightbox'] = 'no';
    					$this->data['rowData'][$ct]['hotel_help_update'] = '';
    					
    					$frontend_files = DB::table('tb_frontend_container')->select('id')->where('container_id',$filesObj->id)->where('container_type','file')->first();
    					if(!empty($frontend_files))
    					{
    						$this->data['rowData'][$ct]['assign_front'] = 'yes';
    					}
    					$frontend_lightbox = DB::table('tb_frontend_lightbox')->select('id')->where('container_id',$filesObj->id)->where('container_type','file')->first();
    					if(!empty($frontend_lightbox))
    					{
    						$this->data['rowData'][$ct]['assign_lightbox'] = 'yes';
    					}
    					
    					$exFtype = explode('/',$filesObj->file_type);
    					if($exFtype[1]=="tiff")
    					{
    						$this->data['rowData'][$ct]['tiff_files'] = DB::table('tb_container_tiff_files')->select('id','file_name')->where('file_id', $filesObj->id)->get();
    					}
    					if($exFtype[0]=="image")
    					{
    						if (!File::exists(public_path(). '/uploads/thumbs/thumb_'.$filesObj->folder_id.'_'.$filesObj->file_name))
    						{
    							$mdimg = \Image::make($imgpath.$filesObj->file_name);
    							$mdimg->resize(128, 130);
    							$thumbfile = 'thumb_'.$filesObj->folder_id.'_'.$filesObj->file_name;
    							$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
    						}
    						
    						if (!File::exists(public_path(). '/uploads/thumbs/format_'.$filesObj->folder_id.'_'.$filesObj->file_name))
    						{
    							$mdimg = \Image::make($imgpath.$filesObj->file_name);
    							$actualsize = getimagesize($imgpath.$filesObj->file_name);
    							if($actualsize[0]>$actualsize[1])
    							{
    								$mdimg->resize(320, null, function ($constraint) {
    									$constraint->aspectRatio();
    								});
    							}
    							else
    							{
    								$mdimg->resize(null, 320, function ($constraint) {
    									$constraint->aspectRatio();
    								});
    							}
    							$thumbfile = 'format_'.$filesObj->folder_id.'_'.$filesObj->file_name;
    							$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
    						}
    						if (!File::exists(public_path(). '/uploads/thumbs/highflip_'.$filesObj->folder_id.'_'.$filesObj->file_name))
    						{
    							$mdimg = \Image::make($imgpath.$filesObj->file_name);
    							$actualsize = getimagesize($imgpath.$filesObj->file_name);
    							if($actualsize[0]>$actualsize[1])
    							{
    								$mdimg->resize(1000, null, function ($constraint) {
    									$constraint->aspectRatio();
    								});
    							}
    							else
    							{
    								$mdimg->resize(null, 1000, function ($constraint) {
    									$constraint->aspectRatio();
    								});
    							}
    							$thumbfile = 'highflip_'.$filesObj->folder_id.'_'.$filesObj->file_name;
    							$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
    						}
    					}
    					
    					// delete landing_info view
    					if( File::exists(public_path() . '/uploads/thumbs/landing_info_'. $filesObj->folder_id.'_'.$filesObj->file_name))
    					{
    						File::delete(public_path() . '/uploads/thumbs/landing_info_'. $filesObj->folder_id.'_'.$filesObj->file_name);
    					}
    					
    					// delete front_slider view
    					if( File::exists(public_path() . '/uploads/thumbs/front_slider_'.$filesObj->file_name))
    					{
    						File::delete(public_path() . '/uploads/thumbs/front_slider_'.$filesObj->file_name);
    					}
    					
    					// delete product_detail_list 
    					if( File::exists(public_path() . '/uploads/thumbs/product_detail_list_'.$filesObj->file_name))
    					{
    						File::delete(public_path() . '/uploads/thumbs/product_detail_list_'.$filesObj->file_name);
    					}
    					
    					// delete product file
    					if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name))
    					{
    						File::delete(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name);
    					}
    					
    					// delete material file
    					if( File::exists(public_path() . '/uploads/folder_cover_imgs/material_file_'.$filesObj->file_name))
    					{
    						File::delete(public_path() . '/uploads/folder_cover_imgs/material_file_'.$filesObj->file_name);
    					}
    					
    					// delete masonry_product_file
    					if( File::exists(public_path() . '/uploads/folder_cover_imgs/masonry_product_file_'.$filesObj->file_name))
    					{
    						File::delete(public_path() . '/uploads/folder_cover_imgs/masonry_product_file_'.$filesObj->file_name);
    					}
    					
    					// delete product file
    					if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name))
    					{
    						File::delete(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name);
    					}
    					
    					// delete folder cover front file
    					if( File::exists(public_path() . '/uploads/folder_cover_imgs/front_'.$filesObj->file_name))
    					{
    						File::delete(public_path() . '/uploads/folder_cover_imgs/front_'.$filesObj->file_name);
    					}
    					
    					// delete folder cover product file
    					if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_'.$filesObj->file_name))
    					{
    						File::delete(public_path() . '/uploads/folder_cover_imgs/product_'.$filesObj->file_name);
    					}
    					
    					// delete folder cover masonry_product file
    					if( File::exists(public_path() . '/uploads/folder_cover_imgs/masonry_product_'.$filesObj->file_name))
    					{
    						File::delete(public_path() . '/uploads/folder_cover_imgs/masonry_product_'.$filesObj->file_name);
    					}
    					
    					// delete folder cover product_detail_cover file
    					if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_detail_cover_'.$filesObj->file_name))
    					{
    						File::delete(public_path() . '/uploads/folder_cover_imgs/product_detail_cover_'.$filesObj->file_name);
    					}
    					$ct++;
    				}
    			}
    			else{
    				$selfiles = DB::table('tb_permissions')->select('view','inherit')->where('folder_id',$id)->where('user_id',$uid)->first();
    				if(!empty($selfiles))
    				{
    					if($selfiles->view==1 || $selfiles->inherit==1)
    					{
    						foreach($filess as $filesObj ){
    							$this->data['rowData'][$ct]['id'] = $filesObj->id;
    							$this->data['rowData'][$ct]['name'] = $filesObj->file_name;
    							$this->data['rowData'][$ct]['ftype'] = 'file';
    							$this->data['rowData'][$ct]['imgsrc'] = $imgsrc;
    							$this->data['rowData'][$ct]['filecount'] = '';
    							$this->data['rowData'][$ct]['foldercount'] = '';
    							$this->data['rowData'][$ct]['tiff_files'] = '';
    							$this->data['rowData'][$ct]['title'] = $filesObj->file_title;
    							$this->data['rowData'][$ct]['description'] = $filesObj->file_description;
    							$this->data['rowData'][$ct]['file_display_name'] = $filesObj->file_display_name;
    							$this->data['rowData'][$ct]['cover_img'] = '';
    							$this->data['rowData'][$ct]['sort_num'] = $filesObj->file_sort_num;
    							$this->data['rowData'][$ct]['hotel_help_update'] = '';
    							
    							$exFtype = explode('/',$filesObj->file_type);
    							if($exFtype[1]=="tiff")
    							{
    								$this->data['rowData'][$ct]['tiff_files'] = DB::table('tb_container_tiff_files')->select('id','file_name')->where('file_id', $filesObj->id)->get();
    							}
    							if($exFtype[0]=="image")
    							{
    								if (!File::exists(public_path(). '/uploads/thumbs/thumb_'.$filesObj->folder_id.'_'.$filesObj->file_name))
    								{
    									$mdimg = \Image::make($imgpath.$filesObj->file_name);
    									$mdimg->resize(128, 130);
    									$thumbfile = 'thumb_'.$filesObj->folder_id.'_'.$filesObj->file_name;
    									$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
    								}
    								
    								if (!File::exists(public_path(). '/uploads/thumbs/format_'.$filesObj->folder_id.'_'.$filesObj->file_name))
    								{
    									$mdimg = \Image::make($imgpath.$filesObj->file_name);
    									$actualsize = getimagesize($imgpath.$filesObj->file_name);
    									if($actualsize[0]>$actualsize[1])
    									{
    										$mdimg->resize(320, null, function ($constraint) {
    											$constraint->aspectRatio();
    										});
    									}
    									else
    									{
    										$mdimg->resize(null, 320, function ($constraint) {
    											$constraint->aspectRatio();
    										});
    									}
    									$thumbfile = 'format_'.$filesObj->folder_id.'_'.$filesObj->file_name;
    									$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
    								}
    								if (!File::exists(public_path(). '/uploads/thumbs/highflip_'.$filesObj->folder_id.'_'.$filesObj->file_name))
    								{
    									$mdimg = \Image::make($imgpath.$filesObj->file_name);
    									$actualsize = getimagesize($imgpath.$filesObj->file_name);
    									if($actualsize[0]>$actualsize[1])
    									{
    										$mdimg->resize(1000, null, function ($constraint) {
    											$constraint->aspectRatio();
    										});
    									}
    									else
    									{
    										$mdimg->resize(null, 1000, function ($constraint) {
    											$constraint->aspectRatio();
    										});
    									}
    									$thumbfile = 'highflip_'.$filesObj->folder_id.'_'.$filesObj->file_name;
    									$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
    								}
    							}
    							
    							// delete landing_info view
    							if( File::exists(public_path() . '/uploads/thumbs/landing_info_'. $filesObj->folder_id.'_'.$filesObj->file_name))
    							{
    								File::delete(public_path() . '/uploads/thumbs/landing_info_'. $filesObj->folder_id.'_'.$filesObj->file_name);
    							}
    							
    							// delete front_slider view
    							if( File::exists(public_path() . '/uploads/thumbs/front_slider_'.$filesObj->file_name))
    							{
    								File::delete(public_path() . '/uploads/thumbs/front_slider_'.$filesObj->file_name);
    							}
    							
    							// delete product_detail_list 
    							if( File::exists(public_path() . '/uploads/thumbs/product_detail_list_'.$filesObj->file_name))
    							{
    								File::delete(public_path() . '/uploads/thumbs/product_detail_list_'.$filesObj->file_name);
    							}
    							
    							// delete product file
    							if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name))
    							{
    								File::delete(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name);
    							}
    							
    							// delete material file
    							if( File::exists(public_path() . '/uploads/folder_cover_imgs/material_file_'.$filesObj->file_name))
    							{
    								File::delete(public_path() . '/uploads/folder_cover_imgs/material_file_'.$filesObj->file_name);
    							}
    							
    							// delete masonry_product_file
    							if( File::exists(public_path() . '/uploads/folder_cover_imgs/masonry_product_file_'.$filesObj->file_name))
    							{
    								File::delete(public_path() . '/uploads/folder_cover_imgs/masonry_product_file_'.$filesObj->file_name);
    							}
    							
    							// delete product file
    							if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name))
    							{
    								File::delete(public_path() . '/uploads/folder_cover_imgs/product_file_'.$filesObj->file_name);
    							}
    							
    							// delete folder cover front file
    							if( File::exists(public_path() . '/uploads/folder_cover_imgs/front_'.$filesObj->file_name))
    							{
    								File::delete(public_path() . '/uploads/folder_cover_imgs/front_'.$filesObj->file_name);
    							}
    							
    							// delete folder cover product file
    							if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_'.$filesObj->file_name))
    							{
    								File::delete(public_path() . '/uploads/folder_cover_imgs/product_'.$filesObj->file_name);
    							}
    							
    							// delete folder cover masonry_product file
    							if( File::exists(public_path() . '/uploads/folder_cover_imgs/masonry_product_'.$filesObj->file_name))
    							{
    								File::delete(public_path() . '/uploads/folder_cover_imgs/masonry_product_'.$filesObj->file_name);
    							}
    							
    							// delete folder cover product_detail_cover file
    							if( File::exists(public_path() . '/uploads/folder_cover_imgs/product_detail_cover_'.$filesObj->file_name))
    							{
    								File::delete(public_path() . '/uploads/folder_cover_imgs/product_detail_cover_'.$filesObj->file_name);
    							}
    							$ct++;
    						}
    					}
    				}
    			}
    		}
            $this->data['check_images'] = true;
        }
        else{
            $this->data['check_images'] = false;
        }
                
		//print "<pre>";
		//print_r($this->data['rowData']);
		if(!empty($this->data['rowData']))
		{
			usort($this->data['rowData'], function($a, $b) {
				return $a['sort_num'] - $b['sort_num']; 
			});
		}
		
				
		if(\Auth::user()->group_id!=3 || $wnd=='iframe')
		{
			$spaceAllowed = \Auth::user()->storage_space;
			if($spaceAllowed==0){ $spaceAllowed = 1; }
			$usedSpaceBytes_temp = DB::table('tb_container_files');
			if(\Auth::user()->group_id==2)
			{
				//$usedSpaceBytes_temp->where('user_id',$uid);
			}
			$usedSpaceBytes = $usedSpaceBytes_temp->sum('file_size');
			$usedSpaceMb = ($usedSpaceBytes/(1000*1000));
			$usedSpace = round($usedSpaceMb,2,PHP_ROUND_HALF_UP);
			$usedSpacePercentage = ($usedSpace*100)/$spaceAllowed;
		}
		
		$subfoldertotal = DB::table('tb_container')->select('id')->where('parent_id',$id);
		if(\Auth::user()->group_id==2 && (!empty($this->data['foldername'] && $this->data['foldername']->global_permission==0)))
		{
			//$subfoldertotal->where('user_id',$uid);
		}
		$this->data['subfoldertotal'] = $subfoldertotal->count();
				
		$subfilestotal = DB::table('tb_container_files')->select('id')->where('folder_id',$id);
		if(\Auth::user()->group_id==2 && (!empty($this->data['foldername'] && $this->data['foldername']->global_permission==0)))
		{
			//$subfilestotal->where('user_id',$uid);
		}
		$this->data['subfilestotal'] = $subfilestotal->count();
		
		$subfileBytes_temp = DB::table('tb_container_files')->where('folder_id',$id);
		if(\Auth::user()->group_id==2 && (!empty($this->data['foldername'] && $this->data['foldername']->global_permission==0)))
		{
			//$subfileBytes_temp->where('user_id',$uid);
		}
		$subfileBytes = $subfileBytes_temp->sum('file_size');
		
		$subfileMb = ($subfileBytes/(1000*1000));
		$this->data['subfileSpace'] = round($subfileMb,2,PHP_ROUND_HALF_UP);
		
		$this->data['users'] = DB::table('tb_users')->select('id','first_name','last_name')->where('group_id',3)->where('active',1)->get();
		$emp = DB::table('employee')->select('Email')->where('Status',1)->get();
		$this->data['crmusers'] = '';
		if(!empty($emp))
		{
			$this->data['crmusers'] = $emp;
		}
		$permiss = array();
		$permission = DB::table('tb_permissions')->where('folder_id',$id)->get();
		foreach($permission as $permit)
		{
			$permiss[$permit->user_id] = $permit;
		}
		
		if(isset($_REQUEST['show']) && trim($_REQUEST['show'])!="")
		{
			$showType = trim($_REQUEST['show']);
		}
		else
		{
			$showType = "thumb";
		}
		
		$this->data['showType'] = $showType;
		$this->data['permissions'] = $permiss;
		//$this->data['tree'] = $this->fetchFolderTreeList('','',$wnd, $showType);
		//$this->data['seloptions'] = $this->fetchFolderTreeOptions();
		$this->data['tree'] = array();
		$this->data['fid'] = $id;
		$this->data['group'] = \Auth::user()->group_id;
		$sel_attributes = DB::table('tb_attributes')->select('attr_type','id','attr_title','attr_cat')->where('attr_status',1);
		if(\Auth::user()->group_id==2 || \Auth::user()->group_id==3)
		{
			$sel_attributes->where('attr_permission',1);
		}
		$this->data['sel_attributes'] = $sel_attributes->get();
		
		$this->data['sel_tags'] = DB::table('tb_tags_manager')->select('id','tag_title')->where('tag_status',1)->get();
		
		$this->data['sel_designer'] = DB::table('tb_designers')->select('id','designer_name')->where('designer_status',1)->get();
		
		$this->data['lightboxes'] = \DB::table('tb_lightbox')->select('id','box_name')->where('user_id', $uid)->get();
		
		$this->data['parent_tags'] = (new TagmanagerController)->fetchTagTree();
		
		$boxcontent = \DB::table('tb_lightbox_content')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_lightbox_content.file_id')->select('tb_lightbox_content.id', 'tb_container_files.file_name', 'tb_container_files.folder_id', 'tb_container_files.file_display_name', 'tb_container_files.file_title','tb_lightbox_content.lightbox_id')->where('tb_lightbox_content.user_id', $uid)->get();
		$boxcont = array();
		if(!empty($boxcontent))
		{
			foreach($boxcontent as $bcontent)
			{
				$boxcont[$bcontent->lightbox_id][] = $bcontent;
			}
		}
		$this->data['lightcontent'] = $boxcont;
		
		if(\Auth::user()->group_id!=3 || $wnd=='iframe')
		{
			$this->data['allowStorage'] = $spaceAllowed;
			$this->data['usedStorage'] = $usedSpace;
			$this->data['usedStoragePerct'] = round($usedSpacePercentage,2,PHP_ROUND_HALF_UP);
		}
		if(\Auth::user()->group_id==3 && $wnd!='iframe')
		{
			$this->data['userpermissions'] = DB::table('tb_permissions')->where('user_id',$uid)->where('folder_id',$id)->first();
			return view('container.user_index',$this->data);
		}
		else
		{
			if($wnd=='iframe')
			{
				return view('container.iframe',$this->data);
			}
			else
			{    
			    $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
                $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.container.index':'container.index';
                
				return view($file_name,$this->data);
			}
		}
	}
    function getThumbpathForSearch($id)
	{
		$fpath = '/uploads/container_user_files/';
		//echo $fpath; die;
		$folds = array_reverse($this->fetchFolderParentList($id));
		if(!empty($folds))
		{
			foreach($folds as $fold)
			{
				$fpath .= $fold.'/';
			}
		}
		return $fpath;
	}
}