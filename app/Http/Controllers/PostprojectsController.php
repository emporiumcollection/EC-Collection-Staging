<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Postprojects;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 


class PostprojectsController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'postprojects';
	static $per_page	= '10';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Postprojects();
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'postprojects',
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
		$pagination->setPath('postprojects');
		
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
		return view('postprojects.index',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_post_projects'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['forms']);
		
		$this->data['id'] = $id;
		return view('postprojects.form',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_post_projects'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['grid']);
		
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		return view('postprojects.view',$this->data);	
	}	

	function postSave( Request $request)
	{
		$uid = \Auth::user()->id;
		$rules = $this->validateForm();
		$id = $request->input('id');
		$rules['image_pos_1'] = 'mimes:jpg,png,jpeg';
		$rules['image_pos_2'] = 'mimes:jpg,png,jpeg';
		$rules['image_pos_3'] = 'mimes:jpg,png,jpeg';
		$rules['image_pos_4'] = 'mimes:jpg,png,jpeg';
		$rules['featured_image'] = 'mimes:jpg,png,jpeg';
		
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			if(!is_null($request->file('featured_image')))
			{
				$featuredfile = $_FILES["featured_image"]['tmp_name'];
				list($width, $height) = getimagesize($featuredfile);

				if($width > "310" || $height > "372") {
					return Redirect::to('postprojects/update/'.$id)->with('messagetext','bitte beachten die Bilder soll 310 by 372 haben')->with('msgstatus','error')->withErrors($validator)->withInput();
				}
			}
			
			if(!is_null($request->file('image_pos_1')))
			{
				$imagepos1file = $_FILES["image_pos_1"]['tmp_name'];
				list($width, $height) = getimagesize($imagepos1file);

				if($width > "1200" || $height > "850") {
					return Redirect::to('postprojects/update/'.$id)->with('messagetext','bitte beachten die Bilder soll 1200 by 850 haben')->with('msgstatus','error')->withErrors($validator)->withInput();
				}
			}
		
			$data = $this->validatePost('tb_postprojects');
			if($request->input('id') =='')
			{
				$data['created'] = date('y-m-d h:i:s');
			}
			else
			{
				$data['updated'] = date('y-m-d h:i:s');
			}
			$data['user_id'] = $uid;
			$destinationPath = public_path().'/uploads/project_imgs/';
			if(is_null($request->file('image_pos_1')))
			{
				if($request->input('container_image_pos_1')!="")
				{
					$container_image_pos1 = $request->input('container_image_pos_1');
					$explode_imagepos1 = explode('/', $container_image_pos1);
					$filename_pos1 = rand(11111, 99999).'-'. end($explode_imagepos1);
					$successfile1 = \File::copy($container_image_pos1, $destinationPath.$filename_pos1);
					if($successfile1)
					{
						$data['image_pos_1'] = $filename_pos1;
					}
				}
			}
			
			if(is_null($request->file('image_pos_2')))
			{
				if($request->input('container_image_pos_2')!="")
				{
					$container_image_pos2 = $request->input('container_image_pos_2');
					$explode_imagepos2 = explode('/', $container_image_pos2);
					$filename_pos2 = rand(11111, 99999).'-'. end($explode_imagepos2);
					$successfile2 = \File::copy($container_image_pos2, $destinationPath.$filename_pos2);
					if($successfile2)
					{
						$data['image_pos_2'] = $filename_pos2;
					}
				}
			}
			
			if(is_null($request->file('image_pos_3')))
			{
				if($request->input('container_image_pos_3')!="")
				{
					$container_image_pos3 = $request->input('container_image_pos_3');
					$explode_imagepos3 = explode('/', $container_image_pos3);
					$filename_pos3 = rand(11111, 99999).'-'. end($explode_imagepos3);
					$successfile3 = \File::copy($container_image_pos3, $destinationPath.$filename_pos3);
					if($successfile3)
					{
						$data['image_pos_3'] = $filename_pos3;
					}
				}
			}
			
			if(is_null($request->file('image_pos_4')))
			{
				if($request->input('container_image_pos_4')!="")
				{
					$container_image_pos4 = $request->input('container_image_pos_4');
					$explode_imagepos4 = explode('/', $container_image_pos4);
					$filename_pos4 = rand(11111, 99999).'-'. end($explode_imagepos4);
					$successfile4 = \File::copy($container_image_pos3, $destinationPath.$filename_pos4);
					if($successfile4)
					{
						$data['image_pos_4'] = $filename_pos4;
					}
				}
			}
			
			if(is_null($request->file('pdf_file')))
			{
				if($request->input('container_pdf_file')!="")
				{
					$container_pdf_file = $request->input('container_pdf_file');
					$explode_pdf_file = explode('/', $container_pdf_file);
					$filename_pos5 = rand(11111, 99999).'-'. end($explode_pdf_file);
					$successfile5 = \File::copy($container_pdf_file, $destinationPath.$filename_pos5);
					if($successfile5)
					{
						$data['pdf_file'] = $filename_pos5;
					}
				}
			}
			
			if(!is_null($request->file('featured_image')))
			{
				$file = $request->file('featured_image');
				$filename = $file->getClientOriginalName();
				$extension = $file->getClientOriginalExtension(); //if you need extension of the file
				$featurefilename = rand(11111111, 99999999).'-'.rand(11111111, 99999999).'.'.$extension;
				$uploadSuccess = $file->move($destinationPath, $featurefilename);
				if($uploadSuccess)
				{
					$data['featured_image'] = $featurefilename;
				}
			}
			
			$id = $this->model->insertRow($data , $request->input('id'));
			
			$file = \DB::table('tb_post_projects')->where('id', $id)->first();
			$newfilename = $file->image_pos_1;
			
			if($newfilename!="")
			{
				if (! \File::exists($destinationPath.'project_'.$newfilename))
				{
					// IMage for projectpage bottom
					$ftimg = \Image::make($destinationPath.$newfilename);
					$ftimg->resize(310, 372);
					$ftimgfile = 'project_'.$newfilename;
					$ftimg->save($destinationPath.$ftimgfile);
				}
			}
			
			if(!is_null($request->input('apply')))
			{
				$return = 'postprojects/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'postprojects?return='.self::returnUrl();
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

			return Redirect::to('postprojects/update/'.$id)->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
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
			return Redirect::to('postprojects')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success'); 
	
		} else {
			return Redirect::to('postprojects')
        		->with('messagetext','No Item Deleted')->with('msgstatus','error');				
		}

	}			


}