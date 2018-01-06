<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 


class ShopController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'shop';
	static $per_page	= '10';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Shop();
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'shop',
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
		$pagination->setPath('shop');
		
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
		return view('shop.index',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_shop'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['forms']);
		
		$this->data['id'] = $id;
		
		$this->data['fetch_products'] = \DB::table('tb_shop_products')->where('shop_id', $id)->get();
		
		return view('shop.form',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_shop'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['grid']);
		
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		return view('shop.view',$this->data);	
	}	

	function postSave( Request $request)
	{
		$uid = \Auth::user()->id;
		$rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data = $this->validatePost('tb_shop');
			if($request->input('id') =='')
			{
				$data['created'] = date('Y-m-d h:i:s');
			}
			else
			{
				$data['updated'] = date('Y-m-d h:i:s');
			}
			$data['user_id'] = $uid;
			
			$destinationPath = './uploads/shop_imgs/';
			if(is_null($request->file('product_pdf')))
			{
				if($request->input('container_product_pdf')!="")
				{
					$container_pdf = $request->input('container_product_pdf');
					$explode_pdf = explode('/', $container_pdf);
					$filename_pdf = rand(1111111, 9999999).'-'.rand(1111111, 9999999).'-'. end($explode_pdf);
					$successfilepdf = \File::copy($container_pdf, $destinationPath.$filename_pdf);
					if($successfilepdf)
					{
						$data['product_pdf'] = $filename_pdf;
					}
				}
			}
			$data['product_title_eng'] = $request->input('product_title_eng');
			$data['product_description_eng'] = $request->input('product_description_eng');
				
			$id = $this->model->insertRow($data , $request->input('id'));
			
			if(!empty($request->input('title')))
			{
				$title = $request->input('title');
				$desc = $request->input('description');
				$imgs = $request->file('product_image');
				$price = $request->input('price');
				$customdescription = $request->input('customdescription');
				$title_eng = $request->input('title_eng');
				$desc_eng = $request->input('description_eng');
				$customdescription_eng = $request->input('customdescription_eng');
				$edit_prd = $request->input('edit_prd');
				
				$cm=1;
				for($pr=0;$pr<count($title);$pr++)
				{
					$prdata = array();
					if($title[$pr]!='' && $desc[$pr]!='' && $price[$pr]!='')
					{
						if(!is_null($imgs[$pr]))
						{
							$file = $imgs[$pr]; 
							$filename = $file->getClientOriginalName();
							$extension = $file->getClientOriginalExtension(); //if you need extension of the file
							$newfilename = rand(1111111, 9999999).'-'.rand(1111111, 9999999).'.'.$extension;
							$uploadSuccess = $file->move($destinationPath, $newfilename);				 
							if( $uploadSuccess ) {
								$prdata['image'] = $newfilename;
							}
						}
						elseif(is_null($imgs[$pr]))
						{
							if($request->input('container_product_image_'.$cm)!="")
							{
								$container_product_image = $request->input('container_product_image_'.$cm);
								$explode_imagepos1 = explode('/', $container_product_image);
								$filename_pos1 = rand(1111111, 9999999).'-'.rand(1111111, 9999999).'-'. end($explode_imagepos1);
								$successfile1 = \File::copy($container_product_image, $destinationPath.$filename_pos1);
								if($successfile1)
								{
									$prdata['image'] = $filename_pos1;
								}
							}
						}
						
						$prdata['user_id'] = $uid;
						$prdata['shop_id'] = $id;
						$prdata['cat_id'] = $request->input('product_cat_id');
						$prdata['title'] = $title[$pr];
						$prdata['description'] = $desc[$pr];
						$prdata['price'] = $price[$pr];
						$prdata['custom_description'] = $customdescription[$pr];
						$prdata['title_eng'] = $title_eng[$pr];
						$prdata['description_eng'] = $desc_eng[$pr];
						$prdata['custom_description_eng'] = $customdescription_eng[$pr];
						
						if($edit_prd[$pr]=="")
						{
							$prdata['created'] = date('Y-m-d h:i:s');
							\DB::table('tb_shop_products')->insert($prdata);
						}
						else{
							$prdata['updated'] = date('Y-m-d h:i:s');
							\DB::table('tb_shop_products')->where('id',$edit_prd[$pr])->update($prdata);
						}
					}
					$cm++;
				}
			}
			
			$check_category = \DB::table('tb_shop_product_categories')->where('id', $request->input('product_cat_id'))->first();
			if(!empty($check_category))
			{
				if($check_category->cat_status==0)
				{
					\DB::table('tb_shop_product_categories')->where('id',$check_category->id)->update(['cat_status'=>'1']);
				}
			}
			
			if(!is_null($request->input('apply')))
			{
				$return = 'shop/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'shop?return='.self::returnUrl();
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

			return Redirect::to('shop/update/'.$id)->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
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
			return Redirect::to('shop')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success'); 
	
		} else {
			return Redirect::to('shop')
        		->with('messagetext','No Item Deleted')->with('msgstatus','error');				
		}

	}

	public function remove_shop_product(Request $request)
	{
		$prodID = $request->input('prodID');
		if($prodID!="" && $prodID>0)
		{
			$check_product = \DB::table('tb_shop_products')->where('id', $prodID)->count();
			if($check_product>0)
			{
				$del_product = \DB::table('tb_shop_products')->where('id', $prodID)->delete();
				if($del_product)
				{
					return 'success';
				}
			}
			else{
				return 'error';
			}
		}
		else{
			return 'error';
		}
	}
	
	public function shop_categories(Request $request)
	{
		$page = $request->input('page');
		if($page!="")
		{
			$check_category = \DB::table('tb_shop_product_categories')->where('page', $page)->get();
			if(!empty($check_category))
			{
				$retn['status'] = 'success';
				$retn['cats'] = $check_category;
			}
			else{
				$retn['status'] = 'error';
			}
		}
		else{
			$retn['status'] = 'error';
		}
		return $retn;
	}


}