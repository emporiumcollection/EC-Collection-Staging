<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Postarticle;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 


class PostarticleController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'postarticle';
	static $per_page	= '10';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Postarticle();
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'postarticle',
			'return'	=> self::returnUrl()
			
		);
		
	}

	public function getIndex( Request $request )
	{
		$categ = '1';
		if(!is_null($request->input('selcat')))
		{
			$categ = ($request->input('selcat')!='') ? $request->input('selcat') : '1';
		}
		$this->data['curntcat'] = $categ;
		
		if($this->access['is_view'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');

		$sort = (!is_null($request->input('sort')) ? $request->input('sort') : 'publish_date'); 
		$order = (!is_null($request->input('order')) ? $request->input('order') : 'desc');
		// End Filter sort and order for query 
		// Filter Search for query		
		$filter = (!is_null($request->input('search')) ? $this->buildSearch() : '');
		//$filter .= ' AND cat_id="'.$categ.'"';

		
		$page = $request->input('page', 1);
		$params = array(
			'page'		=> $page ,
			/*'limit'		=> (!is_null($request->input('rows')) ? filter_var($request->input('rows'),FILTER_VALIDATE_INT) : static::$per_page ) ,*/
			'limit'		=> 100 ,
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
		$pagination->setPath('postarticle');
		
		/*if(!empty($results['rows']))
		{
			foreach($results['rows'] as $singleresult)
			{
				$this->data['rowData'][$singleresult->cat_id][] = $singleresult;
			}
		}*/
		
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
		
		//fetch ctegories
		$cat_names = \DB::table('tb_news_categories')->where('cat_status',1)->orderBy('cat_id','asc')->get();
		if(!empty($cat_names))
		{
			$this->data['allcategories'] = $cat_names;
		}
		
		return view('postarticle.index',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_post_articles'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['forms']);
		
		$this->data['id'] = $id;
		$this->data['fetch_cat'] = \DB::table('tb_categories')->get();
		return view('postarticle.form',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_post_articles'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['grid']);
		
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		return view('postarticle.view',$this->data);	
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
		$rules['image_pos_5'] = 'mimes:jpg,png,jpeg';
		$rules['image_pos_6'] = 'mimes:jpg,png,jpeg';
		$rules['featured_image'] = 'mimes:jpg,png,jpeg';
		$rules['image_pos_7'] = 'mimes:jpg,png,jpeg';
		$rules['image_pos_8'] = 'mimes:jpg,png,jpeg';
		$rules['image_pos_9'] = 'mimes:jpg,png,jpeg';
		$rules['image_pos_10'] = 'mimes:jpg,png,jpeg';
		$rules['image_pos_11'] = 'mimes:jpg,png,jpeg';
		
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			
			if(!is_null($request->file('featured_image')))
			{
				$featuredfile = $_FILES["featured_image"]['tmp_name'];
				/*list($width, $height) = getimagesize($featuredfile);

				if($width > "1350" || $height > "715") {
					return Redirect::to('postarticle/update/'.$id)->with('messagetext','bitte beachten die Bilder soll 1350 by 715 haben')->with('msgstatus','error')->withErrors($validator)->withInput();
				}*/
			}
			
			if(!is_null($request->file('image_pos_1')))
			{
				$featuredfile = $_FILES["image_pos_1"]['tmp_name'];
				/*list($width, $height) = getimagesize($featuredfile);

				if($width > "1500" || $height > "1000") {
					return Redirect::to('postarticle/update/'.$id)->with('messagetext','bitte beachten die Bilder soll 1500 by 100 haben')->with('msgstatus','error')->withErrors($validator)->withInput();
				}*/
			}
			
			if(!is_null($request->file('image_pos_2')))
			{
				$featuredfile = $_FILES["image_pos_2"]['tmp_name'];
				/*list($width, $height) = getimagesize($featuredfile);

				if($width > "1500" || $height > "1000") {
					return Redirect::to('postarticle/update/'.$id)->with('messagetext','bitte beachten die Bilder soll 1500 by 1000 haben')->with('msgstatus','error')->withErrors($validator)->withInput();
				}*/
			}
			
			if(!is_null($request->file('image_pos_3')))
			{
				$featuredfile = $_FILES["image_pos_3"]['tmp_name'];
				/*list($width, $height) = getimagesize($featuredfile);

				if($width > "1500" || $height > "1000") {
					return Redirect::to('postarticle/update/'.$id)->with('messagetext','bitte beachten die Bilder soll 1500 by 1000 haben')->with('msgstatus','error')->withErrors($validator)->withInput();
				}*/
			}
			
			if(!is_null($request->file('image_pos_4')))
			{
				$featuredfile = $_FILES["image_pos_4"]['tmp_name'];
				/*list($width, $height) = getimagesize($featuredfile);

				if($width > "1500" || $height > "1000") {
					return Redirect::to('postarticle/update/'.$id)->with('messagetext','bitte beachten die Bilder soll 1500 by 1000 haben')->with('msgstatus','error')->withErrors($validator)->withInput();
				}*/
			}
			
			if(!is_null($request->file('image_pos_5')))
			{
				$featuredfile = $_FILES["image_pos_5"]['tmp_name'];
				/*list($width, $height) = getimagesize($featuredfile);

				if($width > "1500" || $height > "1000") {
					return Redirect::to('postarticle/update/'.$id)->with('messagetext','bitte beachten die Bilder soll 1500 by 1000 haben')->with('msgstatus','error')->withErrors($validator)->withInput();
				}*/
			}
			
			if(!is_null($request->file('image_pos_6')))
			{
				$featuredfile = $_FILES["image_pos_6"]['tmp_name'];
				/*list($width, $height) = getimagesize($featuredfile);

				if($width > "1500" || $height > "1000") {
					return Redirect::to('postarticle/update/'.$id)->with('messagetext','bitte beachten die Bilder soll 1500 by 1000 haben')->with('msgstatus','error')->withErrors($validator)->withInput();
				}*/
			}
			
			if(!is_null($request->file('image_pos_7')))
			{
				$featuredfile = $_FILES["image_pos_7"]['tmp_name'];
				/*list($width, $height) = getimagesize($featuredfile);

				if($width > "900" || $height > "570") {
					return Redirect::to('postarticle/update/'.$id)->with('messagetext','bitte beachten die Bilder soll 900 by 570 haben')->with('msgstatus','error')->withErrors($validator)->withInput();
				}*/
			}
			
			if(!is_null($request->file('image_pos_8')))
			{
				$featuredfile = $_FILES["image_pos_8"]['tmp_name'];
				/*list($width, $height) = getimagesize($featuredfile);

				if($width > "900" || $height > "570") {
					return Redirect::to('postarticle/update/'.$id)->with('messagetext','bitte beachten die Bilder soll 900 by 570 haben')->with('msgstatus','error')->withErrors($validator)->withInput();
				}*/
			}
			
			if(!is_null($request->file('image_pos_10')))
			{
				$image_pos_10 = $_FILES["image_pos_10"]['tmp_name'];
				/*list($width, $height) = getimagesize($image_pos_10);

				if($width > "900" || $height > "570") {
					return Redirect::to('postarticle/update/'.$id)->with('messagetext','bitte beachten die Bilder soll 900 by 570 haben')->with('msgstatus','error')->withErrors($validator)->withInput();
				}*/
			}
			
			if(!is_null($request->file('image_pos_11')))
			{
				$image_pos_11 = $_FILES["image_pos_11"]['tmp_name'];
				/*list($width, $height) = getimagesize($image_pos_11);

				if($width > "900" || $height > "570") {
					return Redirect::to('postarticle/update/'.$id)->with('messagetext','bitte beachten die Bilder soll 900 by 570 haben')->with('msgstatus','error')->withErrors($validator)->withInput();
				}*/
			}
			
			$data = $this->validatePost('tb_postarticle');
			if($request->input('id') =='')
			{
				$data['created'] = date('y-m-d h:i:s');
			}
			else
			{
				$data['updated'] = date('y-m-d h:i:s');
			}
			$data['user_id'] = $uid;
			$data['title_detail_1'] = $request->input('title_detail_1');
			$data['description_detail_1'] = $request->input('description_detail_1');
			$destinationPath = public_path().'/uploads/article_imgs/';
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
			
			if(is_null($request->file('image_pos_5')))
			{
				if($request->input('container_image_pos_5')!="")
				{
					$container_image_pos5 = $request->input('container_image_pos_5');
					$explode_imagepos5 = explode('/', $container_image_pos5);
					$filename_pos5 = rand(11111, 99999).'-'. end($explode_imagepos5);
					$successfile5 = \File::copy($container_image_pos5, $destinationPath.$filename_pos5);
					if($successfile5)
					{
						$data['image_pos_5'] = $filename_pos5;
					}
				}
			}
			
			if(is_null($request->file('image_pos_6')))
			{
				if($request->input('container_image_pos_6')!="")
				{
					$container_image_pos6 = $request->input('container_image_pos_6');
					$explode_imagepos6 = explode('/', $container_image_pos6);
					$filename_pos6 = rand(11111, 99999).'-'. end($explode_imagepos6);
					$successfile6 = \File::copy($container_image_pos6, $destinationPath.$filename_pos6);
					if($successfile6)
					{
						$data['image_pos_6'] = $filename_pos6;
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
			
			if(!is_null($request->file('image_pos_7')))
			{
				$filepos7 = $request->file('image_pos_7');
				$filenamepos7 = $filepos7->getClientOriginalName();
				$extensionpos7 = $filepos7->getClientOriginalExtension(); //if you need extension of the file
				$filenamepos7 = rand(11111111, 99999999).'-'.rand(11111111, 99999999).'.'.$extensionpos7;
				$uploadSuccesspos7 = $filepos7->move($destinationPath, $filenamepos7);
				if($uploadSuccesspos7)
				{
					$data['image_pos_7'] = $filenamepos7;
				}
			}			
			elseif(is_null($request->file('image_pos_7')))
			{
				if($request->input('container_image_pos_7')!="")
				{
					$container_image_pos_7 = $request->input('container_image_pos_7');
					$explode_imagepos7 = explode('/', $container_image_pos_7);
					$filename_pos7 = rand(11111, 99999).'-'. end($explode_imagepos7);
					$successfile7 = \File::copy($container_image_pos_7, $destinationPath.$filename_pos7);
					if($successfile7)
					{
						$data['image_pos_7'] = $filename_pos7;
					}
				}
			}
			
			if(!is_null($request->file('image_pos_8')))
			{
				$filepos8 = $request->file('image_pos_8');
				$filenamepos8 = $filepos8->getClientOriginalName();
				$extensionpos8 = $filepos8->getClientOriginalExtension(); //if you need extension of the file
				$filenamepos8 = rand(11111111, 99999999).'-'.rand(11111111, 99999999).'.'.$extensionpos8;
				$uploadSuccesspos8 = $filepos8->move($destinationPath, $filenamepos8);
				if($uploadSuccesspos8)
				{
					$data['image_pos_8'] = $filenamepos8;
				}
			}			
			elseif(is_null($request->file('image_pos_8')))
			{
				if($request->input('container_image_pos_8')!="")
				{
					$container_image_pos_8 = $request->input('container_image_pos_8');
					$explode_imagepos8 = explode('/', $container_image_pos_8);
					$filename_pos8 = rand(11111, 99999).'-'. end($explode_imagepos8);
					$successfile8 = \File::copy($container_image_pos_8, $destinationPath.$filename_pos8);
					if($successfile8)
					{
						$data['image_pos_8'] = $filename_pos8;
					}
				}
			}
			
			if(!is_null($request->file('image_pos_9')))
			{
				$filepos9 = $request->file('image_pos_9');
				$filenamepos9 = $filepos9->getClientOriginalName();
				$extensionpos9 = $filepos9->getClientOriginalExtension(); //if you need extension of the file
				$filenamepos9 = rand(11111111, 99999999).'-'.rand(11111111, 99999999).'.'.$extensionpos9;
				$uploadSuccesspos9 = $filepos9->move($destinationPath, $filenamepos9);
				if($uploadSuccesspos9)
				{
					$data['image_pos_9'] = $filenamepos9;
				}
			}			
			elseif(is_null($request->file('image_pos_9')))
			{
				if($request->input('container_image_pos_9')!="")
				{
					$container_image_pos_9 = $request->input('container_image_pos_9');
					$explode_imagepos9 = explode('/', $container_image_pos_9);
					$filename_pos9 = rand(11111, 99999).'-'. end($explode_imagepos9);
					$successfile9 = \File::copy($container_image_pos_9, $destinationPath.$filename_pos9);
					if($successfile9)
					{
						$data['image_pos_9'] = $filename_pos9;
					}
				}
			}
			
			if(!is_null($request->file('image_pos_10')))
			{
				$filepos10 = $request->file('image_pos_10');
				$filenamepos10 = $filepos10->getClientOriginalName();
				$extensionpos10 = $filepos10->getClientOriginalExtension(); //if you need extension of the file
				$filenamepos10= rand(11111111, 99999999).'-'.rand(11111111, 99999999).'.'.$extensionpos10;
				$uploadSuccesspos10 = $filepos10->move($destinationPath, $filenamepos10);
				if($uploadSuccesspos10)
				{
					$data['image_pos_10'] = $filenamepos10;
				}
			}			
			elseif(is_null($request->file('image_pos_10')))
			{
				if($request->input('container_image_pos_10')!="")
				{
					$container_image_pos_10 = $request->input('container_image_pos_10');
					$explode_imagepos10 = explode('/', $container_image_pos_10);
					$filename_pos10 = rand(11111, 99999).'-'. end($explode_imagepos10);
					$successfile10 = \File::copy($container_image_pos_10, $destinationPath.$filename_pos10);
					if($successfile10)
					{
						$data['image_pos_10'] = $filename_pos10;
					}
				}
			}
			
			if(!is_null($request->file('image_pos_11')))
			{
				$filepos11 = $request->file('image_pos_11');
				$filenamepos11 = $filepos9->getClientOriginalName();
				$extensionpos11 = $filepos9->getClientOriginalExtension(); //if you need extension of the file
				$filenamepos11 = rand(11111111, 99999999).'-'.rand(11111111, 99999999).'.'.$extensionpos11;
				$uploadSuccesspos11 = $filepos11->move($destinationPath, $filenamepos11);
				if($uploadSuccesspos11)
				{
					$data['image_pos_11'] = $filenamepos11;
				}
			}			
			elseif(is_null($request->file('image_pos_11')))
			{
				if($request->input('container_image_pos_11')!="")
				{
					$container_image_pos_11 = $request->input('container_image_pos_11');
					$explode_imagepos11 = explode('/', $container_image_pos_11);
					$filename_pos11 = rand(11111, 99999).'-'. end($explode_imagepos11);
					$successfile11 = \File::copy($container_image_pos_11, $destinationPath.$filename_pos11);
					if($successfile11)
					{
						$data['image_pos_11'] = $filename_pos11;
					}
				}
			}
				
			$data['position_num'] = trim($request->input('position_num'));
			$data['external_link'] = trim($request->input('external_link'));
			
			// eng text fileds
			$data['title_pos_1_eng'] = trim($request->input('title_pos_1_eng'));
			$data['description_pos_1_eng'] = trim($request->input('description_pos_1_eng'));
			$data['title_detail_1_eng'] = trim($request->input('title_detail_1_eng'));
			$data['description_detail_1_eng'] = trim($request->input('description_detail_1_eng'));
			$data['description_pos_3_eng'] = trim($request->input('description_pos_3_eng'));
			$data['title_pos_6_eng'] = trim($request->input('title_pos_6_eng'));
			$data['description_pos_6_eng'] = trim($request->input('description_pos_6_eng'));
			$data['title_pos_7'] = trim($request->input('title_pos_7'));
			$data['title_pos_7_eng'] = trim($request->input('title_pos_7_eng'));
			$data['assign_destination'] = trim($request->input('assign_destination'));
			
			if(!is_null($request->input('featured_article')))
			{
				$data['featured_article'] = trim($request->input('featured_article'));
			}
			
			if(!is_null($request->input('editor_choice')))
			{
				$data['editor_choice'] = trim($request->input('editor_choice'));
			}
			
			if(!is_null($request->file('featured_slider_image')))
			{
				$featured_slider_image = $request->file('featured_slider_image');
				$featured_slider_image_namet = $featured_slider_image->getClientOriginalName();
				$featured_slider_image_ext = $featured_slider_image->getClientOriginalExtension(); //if you need extension of the file
				$featured_slider_image_name = rand(11111111, 99999999).'-'.rand(11111111, 99999999).'.'.$featured_slider_image_ext;
				$uploadSuccessposfsi = $featured_slider_image->move($destinationPath, $featured_slider_image_name);
				if($uploadSuccessposfsi)
				{
					$data['featured_slider_image'] = $featured_slider_image_name;
				}
			}
			
			if ($request->input('video_type') != '') {
                $data['video_type'] = $request->input('video_type');
            }
            if ($request->input('link_type') != '') {
                $data['link_type'] = $request->input('link_type');
            }
            $data['video_link'] = $request->input('video_link');
			
			if (!is_null($request->file('video_upload'))) {
                $video_vfile = $request->file('video_upload');
                $video_vfilename = $video_vfile->getClientOriginalName();
                $video_vextension = $video_vfile->getClientOriginalExtension(); //if you need extension of the file
                $video_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $video_vextension;
                $video_vuploadSuccess = $video_vfile->move($destinationPath, $video_videofilename);
                if ($video_vuploadSuccess) {
                    $data['video_upload'] = $video_videofilename;
                }
            }
			
			$id = $this->model->insertRow($data , $request->input('id'));
			
			if(!is_null($request->input('apply')))
			{
				$return = 'postarticle/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'postarticle?return='.self::returnUrl();
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

			return Redirect::to('postarticle/update/'.$id)->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
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
			return Redirect::to('postarticle')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success'); 
	
		} else {
			return Redirect::to('postarticle')
        		->with('messagetext','No Item Deleted')->with('msgstatus','error');				
		}

	}			


}