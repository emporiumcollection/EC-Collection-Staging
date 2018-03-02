<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Bar;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 


class BarController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'bar';
	static $per_page	= '10';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Bar();
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'bar',
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
		$pagination->setPath('bar');
		
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
		return view('bar.index',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_bars'); 
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

		return view('bar.form',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_bars'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['grid']);
		
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		return view('bar.view',$this->data);	
	}	

	function postSave( Request $request)
	{
		
		$rules = $this->validateForm();
		$rules['title'] = 'required|unique:tb_bars,title,'. $request->input('id');
		if($request->input('id')==''){
        	$data['alias'] = str_slug($request->input('title'));
        	$rules['title'] = 'required|unique:tb_bars';
    	}
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data = $this->validatePost('tb_bar');
			
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
            $data['sub_title'] = $request->input('sub_title');
            $data['menu'] = $request->input('menu');
            $data['reservation_email'] = $request->input('reservation_email');
            $data['reservation_contact'] = $request->input('reservation_contact');
            $data['website'] = $request->input('website');
				
			$id = $this->model->insertRow($data , $request->input('id'));
			
			if(!is_null($request->input('apply')))
			{
				$return = 'bar/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'bar?return='.self::returnUrl();
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

			return Redirect::to('bar/update/')->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
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
		{
			$this->model->destroy($request->input('ids'));
			
			\SiteHelpers::auditTrail( $request , "ID : ".implode(",",$request->input('ids'))."  , Has Been Removed Successfull");
			// redirect
			return Redirect::to('bar')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success'); 
	
		} else {
			return Redirect::to('bar')
        		->with('messagetext','No Item Deleted')->with('msgstatus','error');				
		}

	}	

	public function getImages( $id = null)
	{	$this->data['bar'] =  Bar::find($id);
		$this->data['bar']['images'] =  \DB::table('tb_images_res_spa_bar')->where('type', 'bar')->where('parent_id', $id)->get();
		$this->data['id'] = $id;	
		$this->data['access']		= $this->access;
		return view('bar.gallery_images',$this->data);	
	}	

	public function postUploadimages( Request $request)
	{
		$file = $request->file('files');
		
	    if($file) {

	        $destinationPath = public_path() . '/uploads/bars/';
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
                    $getfilejson['files'][0]['thumbnailUrl'] = url('uploads/bars/100x100_'.$getupfile->name);
                    $getfilejson['files'][0]['type'] = $getupfile->image_type;
                    $getfilejson['files'][0]['url'] = url('uploads/bars/'.$getupfile->name);
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
        	$filename = public_path() . '/uploads/bars/'.$checkImg->name;
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
					$filename = public_path() . '/uploads/bars/'.$checkImg->name;
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