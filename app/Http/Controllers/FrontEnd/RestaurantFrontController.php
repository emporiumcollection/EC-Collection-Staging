<?php 
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use DB,Validator, Input, Redirect, CommonHelper, Mail;


class RestaurantFrontController extends Controller {



	public function __construct()
	{
		
		parent::__construct();
		$this->data['pageTitle'] = '';
		$this->data['data'] = CommonHelper::getInfo();
		$this->data['pageslider'] = \DB::table('tb_pages_sliders')->select( 'slider_title', 'slider_description', 'slider_img', 'slider_link', 'slider_video', 'slide_type')->where('slider_page_id', 107)->get();
		$this->data['currency'] = \DB::table('tb_settings')->select('content')->where('key_value', 'default_currency')->first();
		
	}

	public function getIndex( Request $request )
	{
		$this->data['pageslider']="";
		 return view('frontend.restaurant.restaurant_detail', $this->data);
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
		
		$rules = $this->validateForm();
		$rules['title'] = 'required|unique:tb_restaurants,title,'. $request->input('id');
		if($request->input('id')==''){
        	$data['alias'] = str_slug($request->input('title'));
        	$rules['title'] = 'required|unique';
    	}
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data = $this->validatePost('tb_restaurant');
			
    		if($request->input('id')==''){
    			$data['alias'] = str_slug($request->input('title'));
    		}
			if (!empty($request->input('designer'))) {
                $data['designer'] = implode(',', $request->input('designer'));
            } else {
                $data['designer'] = '';
            }
            if (!empty($request->input('category_id'))) {
                $data['category_id'] = implode(',', $request->input('category_id'));
            } else {
                $data['category_id'] = '';
            }
            $data['reservation_email'] = $request->input('reservation_email');
            $data['reservation_contact'] = $request->input('reservation_contact');
            $data['website'] = $request->input('website');
            $data['menu'] = $request->input('menu');
            
				
			$id = $this->model->insertRow($data , $request->input('id'));
			
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

			return Redirect::to('restaurant/update/')->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
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


}