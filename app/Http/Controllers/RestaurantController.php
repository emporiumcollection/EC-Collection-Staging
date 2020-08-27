<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 


class RestaurantController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'restaurant';
	static $per_page	= '10';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Restaurant();
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'restaurant',
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
		$filter = (!is_null($request->input('search')) ? $this->buildSearch() : '');
		if(\Session::get('gid')!=1 && \Session::get('gid')!=2){
			$uid = \Auth::user()->id;
			$filter .= " AND user_id = '".$uid."'" ;
        }
		
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
		$pagination->setPath('restaurant');
		
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
		return view('restaurant.index',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_restaurants'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['forms']);
		
		$this->data['id'] = $id;
		$fetch_cat = \DB::table('tb_categories')->get();
        $parent_cat = array();
        if (!empty($fetch_cat)) {
            foreach ($fetch_cat as $cat) {
                $parent_cat[$cat->id] = $cat;
            }
        }

        $this->data['categories'] = $parent_cat;
        
        /** Images **/
        $res_gallery = array();
        $res_slider = array();
        $res_menu = array();
        if($id !='')
		{
            $res_gallery = $this->get_restaurant_files($id, 'res', 'gallery');
            $res_slider = $this->get_restaurant_files($id, 'res', 'slider');
            $res_menu = $this->get_restaurant_files($id, 'res', 'menu');
        }
        $this->data['res_gallery'] = $res_gallery;
        $this->data['res_slider'] = $res_slider;
        $this->data['res_menu'] = $res_menu;
        /** End images **/
        
        $this->data['designers'] = \DB::table('tb_designers')->where('designer_status', '1')->get();
		return view('restaurant.form',$this->data);
	}	

	public function getShow( $id = null)
	{
	
		if($this->access['is_detail'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
					
		$row = $this->model->getRow($id);
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('tb_restaurants'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['grid']);
		
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		return view('restaurant.view',$this->data);	
	}	

	function postSave( Request $request)
	{
		//print_r($request->all()); die;
		$rules = $this->validateForm();
		if($request->input('id')==''){
        	$data['alias'] = str_slug($request->input('title'));
        	$rules['title'] = 'required|unique:tb_restaurants';
    	}
		else
		{
			$rules['title'] = 'required|unique:tb_restaurants,title,'. $request->input('id');
		}
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			//$data = $this->validatePost('tb_restaurant');
			
			$data['title'] = $request->input('title');
			$data['description'] = $request->input('description');
			if (!is_null($request->input('video_type'))) {
				$data['video_type'] = $request->input('video_type');
			}
			if (!is_null($request->input('video_link_type'))) {
				$data['video_link_type'] = $request->input('video_link_type');
			}
			$data['video_link'] = $request->input('video_link');
    		if($request->input('id')==''){
    			$data['alias'] = str_slug($request->input('title'));
    		}
			/*if (!empty($request->input('designer'))) {
                $data['designer'] = implode(',', $request->input('designer'));
            } else {
                $data['designer'] = '';
            }*/
            $data['chefname'] = $request->input('chefname');
            if (!empty($request->input('category_id'))) {
                $data['category_id'] = implode(',', $request->input('category_id'));
            } else {
                $data['category_id'] = '';
            }
			$uid = \Auth::user()->id;
			$data['user_id'] = $uid;
            $data['reservation_email'] = $request->input('reservation_email');
            $data['reservation_contact'] = $request->input('reservation_contact');
            $data['website'] = $request->input('website');
            $data['opening_hrs'] = $request->input('opening_hrs');
            $data['instagram_id'] = $request->input('instagram_id');
            //$data['menu'] = $request->input('menu');
			$data['url'] = $request->input('url');
			$data['location'] = $request->input('location');            
            
            $destinationPath = public_path() . '/uploads/properties_subtab_imgs/';
                       
            if (!is_null($request->file('portraite_image1'))) {
                $portraitefile1 = $request->file('portraite_image1');
                $portraitefilename1 = $portraitefile1->getClientOriginalName();
                $portraiteextension1 = $portraitefile1->getClientOriginalExtension(); //if you need extension of the file
                $portraitefilename1 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $portraiteextension1;
                $portraiteuploadSuccess1 = $portraitefile1->move($destinationPath, $portraitefilename1);
                if ($portraiteuploadSuccess1) {
                    
                    // open an image file
					$mdimg = \Image::make($destinationPath.$portraitefilename1);
					// now you are able to resize the instance
					$thactualsize = getimagesize($destinationPath.$portraitefilename1);
                    
                    //print_r($thactualsize); die;
					if($thactualsize[0]>$thactualsize[1])
					{
						$mdimg->resize(800, null, function ($constraint) {
							$constraint->aspectRatio();
						});
					}
					else
					{
						$mdimg->resize(null, 600, function ($constraint) {
							$constraint->aspectRatio();
						});
					}
                    
                    // finally we save the image as a new file
					$thumbfile = 'thumb_'.$portraitefilename1;
					$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
                    
                    $data['portraite_image1'] = $portraitefilename1;
                }
            }
            if (!is_null($request->file('portraite_image2'))) {
                $portraitefile2 = $request->file('portraite_image2');
                $portraitefilename2 = $portraitefile2->getClientOriginalName();
                $portraiteextension2 = $portraitefile2->getClientOriginalExtension(); //if you need extension of the file
                $portraitefilename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $portraiteextension2;
                $portraiteuploadSuccess2 = $portraitefile2->move($destinationPath, $portraitefilename2);
                if ($portraiteuploadSuccess2) {
                    $data['portraite_image2'] = $portraitefilename2;
                }
            }
            if (!is_null($request->file('portraite_image3'))) {
                $portraitefile3 = $request->file('portraite_image3');
                $portraitefilename3 = $portraitefile3->getClientOriginalName();
                $portraiteextension3 = $portraitefile3->getClientOriginalExtension(); //if you need extension of the file
                $portraitefilename3 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $portraiteextension3;
                $portraiteuploadSuccess3 = $portraitefile3->move($destinationPath, $portraitefilename3);
                if ($portraiteuploadSuccess3) {
                    $data['portraite_image3'] = $portraitefilename3;
                }
            }
            if (!is_null($request->file('portraite_image4'))) {
                $portraitefile4 = $request->file('portraite_image4');
                $portraitefilename4 = $portraitefile4->getClientOriginalName();
                $portraiteextension4 = $portraitefile4->getClientOriginalExtension(); //if you need extension of the file
                $portraitefilename4 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $portraiteextension4;
                $portraiteuploadSuccess4 = $portraitefile4->move($destinationPath, $portraitefilename4);
                if ($portraiteuploadSuccess4) {
                    $data['portraite_image4'] = $portraitefilename4;
                }
            }
            if (!is_null($request->file('landscape_image1'))) {
                $landscapefile1 = $request->file('landscape_image1');
                $landscapefilename1 = $landscapefile1->getClientOriginalName();
                $landscapeextension1 = $landscapefile1->getClientOriginalExtension(); //if you need extension of the file
                $landscapefilename1 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $landscapeextension1;
                $landscapeuploadSuccess1 = $landscapefile1->move($destinationPath, $landscapefilename1);
                if ($landscapeuploadSuccess1) {
                    $data['landscape_image1'] = $landscapefilename1;
                }
            }
            if (!is_null($request->file('landscape_image2'))) {
                $landscapefile2 = $request->file('landscape_image2');
                $landscapefilename2 = $landscapefile2->getClientOriginalName();
                $landscapeextension2 = $landscapefile2->getClientOriginalExtension(); //if you need extension of the file
                $landscapefilename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $landscapeextension2;
                $landscapeuploadSuccess2 = $landscapefile2->move($destinationPath, $landscapefilename2);
                if ($landscapeuploadSuccess2) {
                    $data['landscape_image2'] = $landscapefilename2;
                }
            }
            
            $data['landscapehovertext_image1'] = $request->input('landscapehovertext_image1');
            $data['landscapehovertext_image2'] = $request->input('landscapehovertext_image2');
            
            
            /** Lat Long **/
            $address = $request->input('location');
            $latitude = '';
            $longitude = '';
            if($request->input('latitude')=='' && $request->input('longitude')==''){                
                if($address!=''){
                    $geo = file_get_contents("https://maps.google.com/maps/api/geocode/json?key=AIzaSyBqf2xJGZFRECA_eVTNek_Y7sxBzmcgXrs&address=".urlencode($address).'&sensor=false');
                    $geo = json_decode($geo, true); // Convert the JSON to an array                
                    if(isset($geo['status']) && ($geo['status'] == 'OK')) {
                      $latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
                      $longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
                    } 
                }   
            }else{
                $latitude = $request->input('latitude');
                $longitude = $request->input('longitude');        
            }
            $data['latitude'] = $latitude;
            $data['longitude'] = $longitude;            
            /** End Lat Long **/
			$data['usp_text'] = $request->input('usp_text');
			$data['usp_person'] = $request->input('usp_person');
            //$data['meta_keyword'] = $request->input('meta_keyword');
			//$data['meta_description'] = $request->input('meta_description');
			
			if (!is_null($request->file('video'))) {
                $room_suites_vfile = $request->file('video');
                $room_suites_vfilename = $room_suites_vfile->getClientOriginalName();
                $room_suites_vextension = $room_suites_vfile->getClientOriginalExtension(); //if you need extension of the file
                $room_suites_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $room_suites_vextension;
                $room_suites_vuploadSuccess = $room_suites_vfile->move($destinationPath, $room_suites_videofilename);
                if ($room_suites_vuploadSuccess) {
                    $data['video'] = $room_suites_videofilename;
                }
            }
			
			if (!is_null($request->input('part_of_hotel'))) {
				$data['part_of_hotel'] = 1;
			}
            
            /** Start Meta tags **/            
            $data['meta_title'] = $request->input('meta_title');
            $data['meta_description'] = $request->input('meta_description');
            $data['meta_keyword'] = $request->input('meta_keyword');            
            $data['og_title'] = $request->input('og_title');
            $data['og_description'] = $request->input('og_description');
            $data['og_url'] = $request->input('og_url');
            $data['og_type'] = $request->input('og_type');            
            $data['og_sitename'] = $request->input('og_sitename');
            $data['og_locale'] = $request->input('og_locale');
            $data['article_section'] = $request->input('article_section');
            $data['article_tags'] = $request->input('article_tags');
            $data['twitter_url'] = $request->input('twitter_url');
            $data['twitter_title'] = $request->input('twitter_title');
            $data['twitter_description'] = $request->input('twitter_description');
            $data['twitter_image'] = $request->input('twitter_image');
            $data['twitter_domain'] = $request->input('twitter_domain');
            $data['twitter_card'] = $request->input('twitter_card');
            $data['twitter_creator'] = $request->input('twitter_creator');
            $data['twitter_site'] = $request->input('twitter_site');                       
            $data['og_upload_type'] =  $request->input('og_image_type');
            if (!is_null($request->file('og_image_type_upload'))) {
                $og_image_type_file = $request->file('og_image_type_upload');
                $og_image_type_filename = $og_image_type_file->getClientOriginalName();
                $og_image_type_extension = $og_image_type_file->getClientOriginalExtension(); //if you need extension of the file
                $og_image_type_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $og_image_type_extension;
                $og_image_type_uploadSuccess = $og_image_type_file->move($destinationPath, $og_image_type_filename);
                if ($og_image_type_uploadSuccess) {
                    $data['og_image'] = $og_image_type_filename;
                    //$meta_data['og_image_width'] = $request->input('og_image_width');
                    //$meta_data['og_image_height'] = $request->input('og_image_height');
                }
            }
            $data['og_image_link'] =  $request->input('og_image_type_link');
            
            $data['twitter_upload_type'] =  $request->input('twitter_image_type');
            if (!is_null($request->file('twitter_image_type_upload'))) {
                $twitter_image_type_file = $request->file('twitter_image_type_upload');
                $twitter_image_type_filename = $twitter_image_type_file->getClientOriginalName();
                $twitter_image_type_extension = $twitter_image_type_file->getClientOriginalExtension(); //if you need extension of the file
                $twitter_image_type_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $twitter_image_type_extension;
                $twitter_image_type_uploadSuccess = $twitter_image_type_file->move($destinationPath, $twitter_image_type_filename);
                if ($twitter_image_type_uploadSuccess) {
                    $data['twitter_image'] = $twitter_image_type_filename;
                    //$meta_data['twitter_image_width'] = $request->input('twitter_image_width');
                    //$meta_data['twitter_image_height'] = $request->input('twitter_image_height');
                }
            }
            $data['twitter_image_link'] =  $request->input('twitter_image_type_link');
            /** End Meta tags **/
				
			$id = $this->model->insertRow($data , $request->input('id'));
			if($request->input('id')==''){
			    $checkDir = \DB::table('tb_container')->select('id')->where('name', 'restaurants')->first();
                if (!empty($checkDir)) {
                	$foldVal = $data['alias'];
                    if ($foldVal != "") {
                        $foldName = trim($foldVal);
                        $slug = \SiteHelpers::seoUrl(trim($foldName));
                        
                        $dirPath = (new ContainerController)->getContainerUserPath($checkDir->id);
    
                        $checkPropFold = \DB::table('tb_container')->select('id')->where('name', $slug)->where('parent_id', $checkDir->id)->first();
                        //print_r($checkPropFold); die;
                        if (!empty($checkPropFold)) {
                            $propFoldId = $checkPropFold->id;
                        } else {
                            $newPropFolder = $this->createNewFolder($foldName, $checkDir->id);
                            if ($newPropFolder !== false) {
                                $propFoldId = $newPropFolder;
                            }
                        }
                        if(!empty($propFoldId)){
                            $galleryID = $this->createNewFolder('gallery',$propFoldId);
        					$sliderID = $this->createNewFolder('slider',$propFoldId);
        					$menuID = $this->createNewFolder('menu',$propFoldId);
        					\DB::table('tb_images_res_spa_bar')->insertGetId(['parent_id'=>$id,'folder_id'=>$propFoldId,'type'=>'res']);
                        }
            		}
                }     
			}            
            
			if(!is_null($request->input('apply')))
			{
				$return = 'restaurant/update/'.$id.'?return='.self::returnUrl();
			} else {
			      
				$return = 'restaurant?return='.self::returnUrl();
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

			return Redirect::to('restaurant/update/'.$id)->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
			->withErrors($validator)->withInput();
		}	
	
	}	

	public function postDelete( Request $request)
	{
		
		if($this->access['is_remove'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
		// delete multipe rows 
		if(count($request->input('ids')) >=1)
		{   \DB::table('tb_images_res_spa_bar')->whereIn('parent_id', $request->input('ids'))->delete();
			$this->model->destroy($request->input('ids'));
			
			\SiteHelpers::auditTrail( $request , "ID : ".implode(",",$request->input('ids'))."  , Has Been Removed Successfull");
			// redirect
			return Redirect::to('restaurant')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success'); 
	
		} else {
			return Redirect::to('restaurant')
        		->with('messagetext','No Item Deleted')->with('msgstatus','error');				
		}

	}	

	public function getImages( $id = null)
	{	$this->data['restaurant'] =  Restaurant::find($id);
		$this->data['restaurant']['images'] =  \DB::table('tb_images_res_spa_bar')->where('type', 'res')->where('parent_id', $id)->get();
		$this->data['id'] = $id;	
		$this->data['access']		= $this->access;
		return view('restaurant.gallery_images',$this->data);	
	}	

	public function postUploadimages( Request $request)
	{
		$file = $request->file('files');
		
	    if($file) {

	        $destinationPath = public_path() . '/uploads/restaurants/';
	        $extension = $file[0]->getClientOriginalExtension();
	        $imageName = rand(11111111111, 99999999999) . '-' .rand(11111111111, 99999999999) . '.' . $extension;
	        $upload_success = $file[0]->move($destinationPath, $imageName);

	        if ($upload_success) {

	            // resizing an uploaded file
	            \Image::make($destinationPath . $imageName)->resize(100, 100)->save($destinationPath . "100x100_" . $imageName);
	            $imgdata = array();
	            $imgdata['parent_id'] = $request->input('parent_id');;
	            $imgdata['type'] = $request->input('uploadType');
	            $imgdata['name'] = $imageName;
	            $imgdata['status'] = 'Yes';
	            $imgdata['sorting'] = 0;
	            $imgdata['image_size'] = $file[0]->getClientSize();;
	            $imgdata['image_type'] = $file[0]->getClientMimeType();;
	            $imgdata['mark_main'] = 0;
	            $imgID = \DB::table('tb_images_res_spa_bar')->insertGetId($imgdata);
	            $getupfile = \DB::table('tb_images_res_spa_bar')->where('id', $imgID)->first();
                if (!empty($getupfile)) {
                    $getfilejson['files'][0]['id'] = $imgID;
                    $getfilejson['files'][0]['name'] = $getupfile->name;
                    $getfilejson['files'][0]['size'] = $getupfile->image_size;
                    $getfilejson['files'][0]['thumbnailUrl'] = url('uploads/restaurants/100x100_'.$getupfile->name);
                    $getfilejson['files'][0]['type'] = $getupfile->image_type;
                    $getfilejson['files'][0]['url'] = url('uploads/restaurants/'.$getupfile->name);
                }
                $getfilejson['status']= 'success';
	            return \Response::json($getfilejson, 200);
	        } else {
	        	$getfilejson['status']= 'error';
	            return \Response::json($getfilejson, 400);
	        }
	    }
	}	

	function postDeleteimage(Request $request) {
        $uid = \Auth::user()->id;
        $img_id = $request->input('img_id');
        
        $checkImg = \DB::table('tb_images_res_spa_bar')->where('id', $img_id)->first();
        if ($checkImg) {
        	$filename = public_path() . '/uploads/restaurants/'.$checkImg->name;
        	\File::delete($filename,'100x100_'.$filename);
        	\DB::table('tb_images_res_spa_bar')->where('id', $img_id)->delete();
            $res['status'] = 'success';
            return \Response::json($res);
        } else {
            $res['status'] = 'error';
            return \Response::json($res);
        }
    }

    function postDeleteselectedimage(Request $request) {
        $items = explode(',',$request->input('items'));
		if(!empty($items))
		{
			foreach($items as $item) 
			{
				$checkImg = \DB::table('tb_images_res_spa_bar')->where('id', $item)->first();
				if (!empty($checkImg)) {
					$deleteImg = \DB::table('tb_images_res_spa_bar')->where('id', $item)->delete();
					$filename = public_path() . '/uploads/restaurants/'.$checkImg->name;
					\File::delete($filename,'100x100_'.$filename);
				}
			}
			$res['status'] = 'success';
			$res['imgs'] = $items;
		}
		else {
			$res['status'] = 'error';
		}
		return \Response::json($res);
    }
	
	
	public function restroReservations( Request $request )
	{

		if($this->access['is_view'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');

		$sort = (!is_null($request->input('sort')) ? $request->input('sort') : 'id'); 
		$order = (!is_null($request->input('order')) ? $request->input('order') : 'asc');
		// End Filter sort and order for query 
		// Filter Search for query		
		$filter = (!is_null($request->input('search')) ? $this->buildSearch() : '');
		
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
		$this->data['reservedata'] = array();
		$checkData = \DB::table('tb_restro_spa_bar_reservation')->where('tbl_id', $request->id)->where('reservetype', 'restro')->get();
		if (!empty($checkData)) {
			$this->data['reservedata'] = $checkData;
		}		
		
		// Build pagination setting
		$page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;	
		$pagination = new Paginator($this->data['reservedata'], count($this->data['reservedata']), $params['limit']);	
		//$pagination->setPath('bar');
		
		//$this->data['rowData']		= $results['rows'];
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
		
		return view('restaurant.reservation_index',$this->data);
	}
    
    function resturant_images_uploads(Request $request) {
        $checkRest = \DB::table('tb_restaurants')->select('alias')->where('id', $request->input('propId'))->first();        
        if (!empty($checkRest)) {
            $checkDir = \DB::table('tb_container')->select('id')->where('name', 'restaurants')->first();
            if (!empty($checkDir)) {
                $foldVal = trim($checkRest->alias);
                if ($foldVal != "") {
                    $foldName = trim($foldVal);
                    $slug = \SiteHelpers::seoUrl(trim($foldName));
                    
                    $dirPath = (new ContainerController)->getContainerUserPath($checkDir->id);

                    $checkPropFold = \DB::table('tb_container')->select('id')->where('name', $slug)->where('parent_id', $checkDir->id)->first();
                    //print_r($checkPropFold); die;
                    if (!empty($checkPropFold)) {
                        $propFoldId = $checkPropFold->id;
                    } else {
                        $newPropFolder = $this->createNewFolder($foldName, $checkDir->id);
                        if ($newPropFolder !== false) {
                            $propFoldId = $newPropFolder;
                        }
                    }
                    
                    $imgFold = $request->input('uploadType');
                    $PropImgfoldName = trim($imgFold);
                    $PropImgslug = \SiteHelpers::seoUrl(trim($PropImgfoldName));
                    $checkPropImgFold = \DB::table('tb_container')->select('id')->where('name', $PropImgslug)->where('parent_id', $propFoldId)->first();
                    if (!empty($checkPropImgFold)) {
                        $newpropImgFoldId = $checkPropImgFold->id;
                    } else {
                        $newPropImgFolder = $this->createNewFolder($PropImgfoldName, $propFoldId);
                        if ($newPropImgFolder !== false) {
                            $newpropImgFoldId = $newPropImgFolder;
                        }
                    }
                    
                    /*if ($imgFold == 'Rooms Images') {
                        $cat_id = $request->input('category_id');
                        $getcat = \DB::table('tb_properties_category_types')->select('category_name')->where('id', $cat_id)->where('status', 0)->first();
                        if (!empty($getcat)) {
                            $catFold = $getcat->category_name;
                            $CatfoldName = trim($catFold);
                            $Catslug = \SiteHelpers::seoUrl(trim($CatfoldName));
                            $checkCatFold = \DB::table('tb_container')->select('id')->where('name', $Catslug)->where('parent_id', $newpropImgFoldId)->first();
                            if (!empty($checkCatFold)) {
                                $CatFoldId = $checkCatFold->id;
                            } else {
                                $newCatFolder = $this->createNewFolder($CatfoldName, $newpropImgFoldId);
                                if ($newCatFolder !== false) {
                                    $CatFoldId = $newCatFolder;
                                }
                            }
                            $propImgFoldId = $CatFoldId;
                        } else {
                            $propImgFoldId = $newpropImgFoldId;
                        }
                    } else {
                        $propImgFoldId = $newpropImgFoldId;
                    }*/
                    $propImgFoldId  = $newpropImgFoldId;
                    // SET UPLOAD PATH
                    $destinationPath = (new ContainerController)->getContainerUserPath($propImgFoldId);
                    $file = $request->file('files');
                    // GET THE FILE EXTENSION
                    $extension = $file[0]->getClientOriginalExtension();
                    // RENAME THE UPLOAD WITH RANDOM NUMBER
                    $fileName = rand(11111111111, 99999999999) . '-' .rand(11111111111, 99999999999) . '.' . $extension;
                    $fileNamedis = $file[0]->getClientOriginalName();
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
                    $upload_success = $file[0]->move($destinationPath, $fileName);
                    $ftype = $file[0]->getClientMimeType();
                    $exFtype = explode('/', $ftype);
                    if ($exFtype[0] == "image") {
                        // open an image file
                        $thimg = \Image::make($destinationPath . $fileName);
                        // now you are able to resize the instance
                        $thimg->resize(128, 130);
                        // finally we save the image as a new file
                        $thumbfile = 'thumb_' . $propImgFoldId . '_' . $fileName;
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
                        $thumbfile = 'format_' . $propImgFoldId . '_' . $fileName;
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
                        $thumbfile = 'highflip_' . $propImgFoldId . '_' . $fileName;
                        $mdimg->save(public_path() . '/uploads/thumbs/' . $thumbfile);

                        /*// open an image file
                        $pthimg = \Image::make($destinationPath . $fileName);
                        // now you are able to resize the instance
                        $pthimg->resize(80, 80);
                        // finally we save the image as a new file
                        $pthumbfile = $fileName;
                        $pthimg->save(public_path() . '/uploads/property_imgs_thumbs/' . $pthumbfile);

                        $fpimg = \Image::make($destinationPath . $fileName);
                        $thactualsize = getimagesize($destinationPath . $fileName);
                        if ($thactualsize[0] > $thactualsize[1]) {
                            $fpimg->resize(425, 283);
                        } else {
                            $fpimg->resize(212, 283);
                        }
                        $thumbfile = 'front_property_' . $propImgFoldId . '_' . $fileName;
                        $fpimg->save(public_path() . '/uploads/property_imgs_thumbs/' . $thumbfile);*/

                        // Set main image if uploaded file is first in folder
                        $countfile = \DB::table('tb_container_files')->where('folder_id', $propImgFoldId)->where(function ($query) {
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
                            \DB::table('tb_container')->where('id', $propImgFoldId)->update($cmdata);
                        }
                    }

                    $data['folder_id'] = $propImgFoldId;
                    $data['file_name'] = $fileName;
					$data['file_display_name'] = $fileNamedis;
                    $data['file_type'] = $file[0]->getClientMimeType();
                    $data['file_size'] = $file[0]->getClientSize();
                    $data['user_id'] = \Auth::user()->id;
                    $data['created'] = date('y-m-d h:i:s');
                    $data['path'] = $destinationPath;
                    $fileID = \DB::table('tb_container_files')->insertGetId($data);

                    /*$imgdata['property_id'] = $request->input('propId');
                    $imgdata['type'] = $imgFold;
                    $imgdata['file_id'] = $fileID;
                    if ($imgFold == 'Rooms Images') {
                        $imgdata['category_id'] = $request->input('category_id');
                    }
                    $imgdata['user_id'] = \Auth::user()->id;
                    $imgdata['created'] = date('y-m-d h:i:s');
                    $imgID = \DB::table('tb_properties_images')->insertGetId($imgdata);*/

                    $getupfile = \DB::table('tb_container_files')->where('id', $fileID)->first();
                    if (!empty($getupfile)) {
                        $getfilejson['files'][0]['id'] = $fileID;
                        $getfilejson['files'][0]['name'] = ($getupfile->file_display_name!='') ? $getupfile->file_display_name : $getupfile->file_name;
                        $getfilejson['files'][0]['size'] = $getupfile->file_size;
                        if ($getupfile->file_type == "application/pdf") {
                            $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/images/bigpage_white_acrobat.png');
                        } elseif ($getupfile->file_type == "application/vnd.openxmlformats-officedocument.word") {
                            $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/images/doc.png');
                        } elseif ($getupfile->file_type == "application/vnd.openxmlformats-officedocument.spre") {
                            $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/images/xls.png');
                        } else {
                            $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/thumbs/thumb_'.$propImgFoldId.'_'.$getupfile->file_name);
                        }
                        $getfilejson['files'][0]['type'] = $getupfile->file_type;
                        $getfilejson['files'][0]['url'] = (new ContainerController)->getThumbpath($getupfile->folder_id) . $getupfile->file_name;
                    }
                    return json_encode($getfilejson);
                }
            }
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
    
    function get_restaurant_files($r_id, $filetype, $foldertype='gallery') {
        /*$fileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*',  \DB::raw("(CASE WHEN (tb_container_files.file_display_name = '') THEN tb_container_files.file_name ELSE tb_container_files.file_display_name END) as file_display_name"), 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $r_id)->where('tb_properties_images.type', $filetype)->get();
        $filen = array();
        if (!empty($fileArr)) {
            $f = 0;
            foreach ($fileArr as $file) {
                $filen[$f] = $file;
                $filen[$f]->imgsrc = (new ContainerController)->getThumbpath($file->folder_id);
                $f++;
            }
        }
        return $filen;*/
        
        
        
        
        $filen = array();
        $fetchresgalleryfolder = array();
		$resfileArr = \DB::table('tb_images_res_spa_bar')->where('parent_id', $r_id)->where('type', $filetype)->first();
        if($foldertype=="menu"){
            if(!empty($resfileArr)){
                $fetchresgalleryfolder = \DB::table('tb_container_files')->select('tb_container_files.id', 'tb_container_files.file_display_name', 'tb_container_files.file_name', 'tb_container_files.folder_id', 'tb_restaurant_menu_title.title', 'tb_container_files.file_size', 'tb_container_files.file_type')->leftJoin('tb_restaurant_menu_title', 'tb_container_files.id', '=', 'tb_restaurant_menu_title.container_id')->join('tb_container', 'tb_container.id', '=', 'tb_container_files.folder_id')->where('tb_container.parent_id', $resfileArr->folder_id)->where('tb_container.name', $foldertype)->get();
            }
            //print_r($fetchresgalleryfolder); die;
            if (!empty($fetchresgalleryfolder)) {
                $f = 0;
                foreach ($fetchresgalleryfolder as $file) {
                    $filen[$f] = $file;
                    $filen[$f]->imgsrc = (new ContainerController)->getThumbpath($file->folder_id);
                    $f++;
                }
            }    
        }else{
            if(!empty($resfileArr)){
                $fetchresgalleryfolder = \DB::table('tb_container')->join('tb_container_files', 'tb_container.id', '=', 'tb_container_files.folder_id')->where('tb_container.parent_id', $resfileArr->folder_id)->where('tb_container.name', $foldertype)->get();
            }
            if (!empty($fetchresgalleryfolder)) {
                $f = 0;
                foreach ($fetchresgalleryfolder as $file) {
                    $filen[$f] = $file;
                    $filen[$f]->imgsrc = (new ContainerController)->getThumbpath($file->folder_id);
                    $f++;
                }
            }
        }
        return $filen;
        //echo "<pre>";
        //print_r($filen); die;
        //print_r($resfileArr); die;
        //print_r($resfileArr); die;
        
        
        
        
        
        
    }
    
    function delete_restaurant_image(Request $request) {
        $uid = \Auth::user()->id;
        $img_id = $request->input('img_id');
        //$checkImg = \DB::table('tb_properties_images')->where('id', $img_id)->first();
        if ($img_id!='') {
            //$deleteEfile = (new ContainerController)->delete_allextra_files($checkImg->file_id, 'file');
            $deleteFile = \DB::table('tb_container_files')->where('id', $img_id)->delete();
            //$deleteImg = \DB::table('tb_properties_images')->where('id', $img_id)->delete();

            $res['status'] = 'success';
            return json_encode($res);
        } else {
            $res['status'] = 'error';
            return json_encode($res);
        }
    }
    
    function delete_selected_image(Request $request) {
        $uid = \Auth::user()->id;
        $items = explode(',',$request->input('items'));
		if(!empty($items))
		{
			foreach($items as $item) 
			{
				//$checkImg = \DB::table('tb_properties_images')->where('id', $item)->first();
				//if (!empty($checkImg)) {
					//$deleteEfile = (new ContainerController)->delete_allextra_files($checkImg->file_id, 'file');
					$deleteFile = \DB::table('tb_container_files')->where('id', $item)->delete();
					//$deleteImg = \DB::table('tb_properties_images')->where('id', $item)->delete();
				//}
			}
			$res['status'] = 'success';
			$res['imgs'] = $items;
		}
		else {
			$res['status'] = 'error';
		}
		return json_encode($res);
    }
    
    function addmenutitle(Request $request){
        $mid = $request->input('mID');  
        $menuTitle = $request->input('menuTitle');
        
        if($mid!=''){
            $mdata['container_id'] = $mid;
            $mdata['title'] = $menuTitle;
            $mdata['created'] = date('Y-m-d H:i:s');
            $objMenu = \DB::table('tb_restaurant_menu_title')->where('container_id', $mid)->first();
            if(!empty($objMenu)){
                \DB::table('tb_restaurant_menu_title')->where('container_id', $mid)->update($mdata);    
            }else{            
                $id = \DB::table('tb_restaurant_menu_title')->insertGetId($mdata);
            }
            $result['status']='success';
            $result['mid'] = $mid;
            $result['menutitle'] = $menuTitle;
            $result['message'] ='Title Added Successfully';
        }else{
            $result['status']='error';
            $result['message'] ='Error! While adding title';
        }    
        echo json_encode($result);
    }
    
    function getMenutitle(Request $request){
        $mid = $request->input('mid');       
        
        if($mid!=''){
            $objMenu = \DB::table('tb_restaurant_menu_title')->where('container_id', $mid)->first();            
            $result['status']='success';
            $result['objmenu'] =$objMenu;
        }else{
            $result['status']='error';            
        }    
        echo json_encode($result);
        
    }
    
    function getOthersiterestaurant(){
        echo "<pre>";
        $arrImgs = array();
        $arrThumbs = array();
        $arrFormat = array();
        $arrHighflip = array();
        $arrFolderCoverImgs = array();
        $arr_Thumbs = array();
        $arr_Format = array();
        
        $allRest = \DB::table('tb_restaurants')->select('tb_restaurants.id', 'tb_images_res_spa_bar.folder_id')->join('tb_images_res_spa_bar', 'tb_images_res_spa_bar.parent_id', '=', 'tb_restaurants.id')->where('tb_images_res_spa_bar.type', 'res')->limit(2)->orderBy('tb_restaurants.id', 'DESC')->get(); 
        
        foreach($allRest as $sirest){     
            if (!empty($sirest)) {   //print_r($sirest->folder_id); die;             
                $dirRestPath = (new ContainerController)->getContainerUserPath($sirest->folder_id);                
                $checkRestFold = \DB::table('tb_container')->select('id')->where('parent_id', $sirest->folder_id)->get();                
                if(!empty($checkRestFold)){                    
                    foreach($checkRestFold as $subrest){ //echo $subrest->id; die;
                        $dirPath = (new ContainerController)->getContainerUserPath($subrest->id);
                        $restFoldFiles = \DB::table('tb_container_files')->where('folder_id', $subrest->id)->get();
                        
                        if(!empty($restFoldFiles)){
                            foreach($restFoldFiles as $sifile){
                                
                                $destinationPath = (new ContainerController)->getContainerUserPath($sifile->folder_id);
                                if($sifile->file_name!=''){
                                    $destinationPath = (new ContainerController)->getContainerUserPath($sifile->folder_id);
                                    $orgFilePath = $destinationPath."/".$sifile->file_name;
                                    if(file_exists($orgFilePath)){
                                        //$arrImgs[] = $orgFilePath; 
                                        \File::delete($orgFilePath);
                                    }
                                    if(file_exists(public_path() . '/uploads/thumbs/' . $sifile->file_name)){
                                       // $arrThumbs[] = public_path() . '/uploads/thumbs/' . $sifile->file_name;
                                       \File::delete(public_path() . '/uploads/thumbs/' . $sifile->file_name);
                                    }
                                    if(file_exists(public_path() . '/uploads/thumbs/' . 'format_' . $sifile->folder_id . '_' . $sifile->file_name)){
                                        \File::delete(public_path() . '/uploads/thumbs/' . 'format_' . $sifile->folder_id . '_' . $sifile->file_name);
                                        //$arrFormat[] = public_path() . '/uploads/thumbs/' . 'format_' . $sifile->folder_id . '_' . $sifile->file_name;
                                    }
                                    if(file_exists(public_path() . '/uploads/thumbs/' . 'highflip_' . $sifile->folder_id . '_' . $sifile->file_name)){
                                        \File::delete(public_path() . '/uploads/thumbs/' . 'highflip_' . $sifile->folder_id . '_' . $sifile->file_name);
                                        //$arrHighflip[] = public_path() . '/uploads/thumbs/' . 'highflip_' . $sifile->folder_id . '_' . $sifile->file_name;
                                    }
                                    //$arrFolderCoverImgs = public_path() . '/uploads/folder_cover_imgs/'
                                    if(file_exists(public_path() . '/uploads/folder_cover_imgs/thumb_' . $sifile->file_name)){
                                        \File::delete(public_path() . '/uploads/folder_cover_imgs/thumb_' . $sifile->file_name);
                                        //$arr_Thumbs[] = public_path() . '/uploads/folder_cover_imgs/thumb_' . $sifile->file_name;
                                    }
                                    if(file_exists(public_path() . '/uploads/folder_cover_imgs/format_' . $sifile->file_name)){
                                        \File::delete(public_path() . '/uploads/folder_cover_imgs/format_' . $sifile->file_name);
                                        //$arr_Format[] = public_path() . '/uploads/folder_cover_imgs/format_' . $sifile->file_name;
                                    }
                                }                                
                            }
                            \File::deleteDirectory($dirPath);
                            \DB::table('tb_container_files')->where('folder_id', $subrest->id)->delete();
                        }                              
                    }                    
                }                
                \File::deleteDirectory($dirRestPath);
                \DB::table('tb_container')->where('id', $sirest->folder_id)->delete();
                \DB::table('tb_images_res_spa_bar')->where('parent_id', $sirest->id)->where('type', 'res')->delete();
                \DB::table('tb_restaurants')->where('id', $sirest->id)->delete();                    
            }
             
        }                       
    }    
}