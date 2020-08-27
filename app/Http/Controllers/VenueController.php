<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 


class VenueController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'venue';
	static $per_page	= '10';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Venue();
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'venue',
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
		$pagination->setPath('venue');
		
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
		return view('venue.index',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_venue'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['forms']);
		
		$this->data['id'] = $id;
		return view('venue.form',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_venue'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['grid']);
		
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		return view('venue.view',$this->data);	
	}	

	function postSave( Request $request)
	{		
		$rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data = $this->validatePost('tb_venue');
			$destinationPath = public_path() . '/uploads/venue_meta_imgs/';
            /** Start Meta tags **/            
            $data['meta_title'] = $request->input('meta_title');
            $data['meta_description'] = $request->input('meta_description');
            $data['meta_keywords'] = $request->input('meta_keyword');            
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
			
			if(!is_null($request->input('apply')))
			{
				$return = 'venue/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'venue?return='.self::returnUrl();
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

			return Redirect::to('venue/update/'.$id)->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
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
			return Redirect::to('venue')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success'); 
	
		} else {
			return Redirect::to('venue')
        		->with('messagetext','No Item Deleted')->with('msgstatus','error');				
		}

	}
    public function postAddnewvenue(Request $request){
        
        /** Add New Venue **/
        $venue_data['name'] = $request->input('venue_name');
        $venue_data['email'] = $request->input('venue_email');
        $venue_data['phone'] = $request->input('venue_phone');
        $venue_data['website'] = $request->input('venue_website');
        $venue_data['youtube_channel'] = $request->input('venue_youtube_channel');
        $venue_data['instagram'] = $request->input('venue_instagram');
        $venue_data['address'] = $request->input('venue_address');
        
        /** Lat Long **/
        $venue_address = $request->input('venue_location');
        $venue_latitude = '';
        $venue_longitude = '';
        if($request->input('venue_latitude')=='' && $request->input('venue_longitude')==''){                
            if($venue_address!=''){
                $geo = file_get_contents("https://maps.google.com/maps/api/geocode/json?key=AIzaSyBqf2xJGZFRECA_eVTNek_Y7sxBzmcgXrs&address=".urlencode($venue_address).'&sensor=false');
                $geo = json_decode($geo, true); // Convert the JSON to an array                
                if(isset($geo['status']) && ($geo['status'] == 'OK')) {
                  $venue_latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
                  $venue_longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
                } 
            }   
        }else{
            $venue_latitude = $request->input('venue_latitude');
            $venue_longitude = $request->input('venue_longitude');        
        }
        $venue_data['location'] = $venue_address;
        $venue_data['latitude'] = $venue_latitude;
        $venue_data['longitude'] = $venue_longitude;
        /**  **/
        
        $venue_data['status'] = 1;
        $venue_data['created'] = date('Y-m-d H:i:s');
        $venue_data['updated'] = date('Y-m-d H:i:s');
        
        /** End Venue **/
        $destinationPath = public_path() . '/uploads/venue_meta_imgs/';
        /** Start Meta tags **/            
        $venue_data['meta_title'] = $request->input('pop_meta_title');
        $venue_data['meta_description'] = $request->input('pop_meta_description');
        $venue_data['meta_keywords'] = $request->input('pop_meta_keyword');            
        $venue_data['og_title'] = $request->input('pop_og_title');
        $venue_data['og_description'] = $request->input('pop_og_description');
        $venue_data['og_url'] = $request->input('pop_og_url');
        $venue_data['og_type'] = $request->input('pop_og_type');            
        $venue_data['og_sitename'] = $request->input('pop_og_sitename');
        $venue_data['og_locale'] = $request->input('pop_og_locale');
        $venue_data['article_section'] = $request->input('pop_article_section');
        $venue_data['article_tags'] = $request->input('pop_article_tags');
        $venue_data['twitter_url'] = $request->input('pop_twitter_url');
        $venue_data['twitter_title'] = $request->input('pop_twitter_title');
        $venue_data['twitter_description'] = $request->input('pop_twitter_description');
        $venue_data['twitter_image'] = $request->input('pop_twitter_image');
        $venue_data['twitter_domain'] = $request->input('pop_twitter_domain');
        $venue_data['twitter_card'] = $request->input('pop_twitter_card');
        $venue_data['twitter_creator'] = $request->input('pop_twitter_creator');
        $venue_data['twitter_site'] = $request->input('pop_twitter_site');                       
        $venue_data['og_upload_type'] =  $request->input('pop_og_image_type');
        if (!is_null($request->file('pop_og_image_type_upload'))) {
            $og_image_type_file = $request->file('pop_og_image_type_upload');
            $og_image_type_filename = $og_image_type_file->getClientOriginalName();
            $og_image_type_extension = $og_image_type_file->getClientOriginalExtension(); //if you need extension of the file
            $og_image_type_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $og_image_type_extension;
            $og_image_type_uploadSuccess = $og_image_type_file->move($destinationPath, $og_image_type_filename);
            if ($og_image_type_uploadSuccess) {
                $venue_data['og_image'] = $og_image_type_filename;
                //$meta_data['og_image_width'] = $request->input('og_image_width');
                //$meta_data['og_image_height'] = $request->input('og_image_height');
            }
        }
        $venue_data['og_image_link'] =  $request->input('pop_og_image_type_link');
        
        $venue_data['twitter_upload_type'] =  $request->input('pop_twitter_image_type');
        if (!is_null($request->file('pop_twitter_image_type_upload'))) {
            $twitter_image_type_file = $request->file('pop_twitter_image_type_upload');
            $twitter_image_type_filename = $twitter_image_type_file->getClientOriginalName();
            $twitter_image_type_extension = $twitter_image_type_file->getClientOriginalExtension(); //if you need extension of the file
            $twitter_image_type_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $twitter_image_type_extension;
            $twitter_image_type_uploadSuccess = $twitter_image_type_file->move($destinationPath, $twitter_image_type_filename);
            if ($twitter_image_type_uploadSuccess) {
                $venue_data['twitter_image'] = $twitter_image_type_filename;
                //$meta_data['twitter_image_width'] = $request->input('twitter_image_width');
                //$meta_data['twitter_image_height'] = $request->input('twitter_image_height');
            }
        }
        $venue_data['twitter_image_link'] =  $request->input('pop_twitter_image_type_link');
        /** End Meta tags **/
        
        
        $venue_id = \DB::table('tb_venue')->insertGetId($venue_data);            
        
        if($venue_id > 0){
            $res['status']='success';
            $res['newvenue'] = \DB::table('tb_venue')->where('id', $venue_id)->first();    
        }else{
            $res['status']='error'; 
        }
        
        echo json_encode($res);
        
    }			


}