<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 


class SliderController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'slider';
	static $per_page	= '20';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Slider();
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'slider',
			'return'	=> self::returnUrl()
			
		);
		
	}

	public function getIndex( Request $request )
	{
		$categ = '';
		if(!is_null($request->input('selcat')))
		{
			$categ = ($request->input('selcat')!='') ? $request->input('selcat') : 'Landing';
		}
		$this->data['curntcat'] = $categ;
		if($this->access['is_view'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');

		$sort = (!is_null($request->input('sort')) ? $request->input('sort') : 'sort_num');
		$order = (!is_null($request->input('order')) ? $request->input('order') : 'desc');
		// End Filter sort and order for query 
		// Filter Search for query		
		$filter = (!is_null($request->input('search')) ? $this->buildSearch() : '');
		if(is_null($request->input('search')))
		{
            if($categ!='') {
                $filter .= ' AND slider_category="' . $categ . '"';
            }
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
		$pagination->setPath('slider')->appends('selcat', $request->input('selcat'));
		
		/*if(!empty($results['rows']))
		{
			foreach($results['rows'] as $singleresult)
			{
				$this->data['rowData'][$singleresult->slider_category][] = $singleresult;
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
		
		$fetchcats = \DB::table('tb_categories')->where('category_published',1)->where('id','!=',8)->get();
		$cates = array();
		if(!empty($fetchcats))
		{
			foreach($fetchcats as $cats)
			{
				$cates[] = $cats->category_name;
			}
		}
		
		array_unshift($cates, 'Landing','Hotel','Villas','Yachts','Safari Lodges','Spas');
		
		foreach($cates as $cat)
		{
			$fetchslides = \DB::table('tb_sliders')->where('slider_category',$cat)->count();
			if($fetchslides>0)
			{
				$showcat[] = $cat;
			}
		}
		$this->data['allcategories'] = $showcat;
		return view('slider.index',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_sliders'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['forms']);
		
		$this->data['id'] = $id;
		
		$this->data['allcats'] = \DB::table('tb_categories')->where('category_published',1)->where('id','!=',8)->get();
		
		return view('slider.form',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_sliders'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['grid']);
		
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		return view('slider.view',$this->data);	
	}	

	function postSave( Request $request)
	{
		$id = $request->input('id');
		$rules = $this->validateForm();
		if($request->input('id') =='')
		{
			$rules['slider_img'] = 'required|mimes:jpeg,png';
		}
		else
		{
			$rules['slider_img'] = 'mimes:jpeg,png';
		}
		$rules['slider_category'] = 'required';
		
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			
			$data = $this->validatePost('tb_slider');
			$data['user_id'] = \Auth::user()->id;
			if($request->input('id') =='')
			{
				$data['created'] = date('y-m-d h:i:s');
				$check_ordering = \DB::table('tb_sliders')->where('slider_category',$request->input('slider_category'))->orderBy('sort_num', 'desc')->first();
				if(!empty($check_ordering)){
					$data['sort_num'] = $check_ordering->sort_num + 1;
				}
				else{
					$data['sort_num'] = 1;
				}
			}
			else
			{
				$data['updated'] = date('y-m-d h:i:s');
			}
			
			$data['slider_category'] = $request->input('slider_category');
			if(!is_null($request->input('slider_status')))
			{
				$data['slider_status'] = $request->input('slider_status');
			}
			else
			{
				$data['slider_status'] = 0;
			}
			
			$id = $this->model->insertRow($data , $request->input('id'));
			
			if(!is_null($request->input('apply')))
			{
				$return = 'slider/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'slider?selcat='.$request->input('slider_category').'&return='.self::returnUrl();
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

			return Redirect::to('slider/update/'.$id)->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
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
			$sel_ids = $request->input('ids');
			$exitdel = \DB::table('tb_sliders')->where('id',$sel_ids[0])->first();
			$this->model->destroy($request->input('ids'));
			
			if(!empty($exitdel))
			{
				$nextEntries = \DB::table('tb_sliders')->where('slider_category',$exitdel->slider_category)->where('sort_num', '>', $exitdel->sort_num)->orderBy('sort_num','asc')->get();
				if(!empty($nextEntries))
				{
					$next_order = $exitdel->sort_num;
					foreach($nextEntries as $next)
					{
						$update_ordering = \DB::table('tb_sliders')->where('id',$next->id)->update(['sort_num'=>$next_order]);
						$next_order = $next_order + 1;
					}
				}
			}
			
			\SiteHelpers::auditTrail( $request , "ID : ".implode(",",$request->input('ids'))."  , Has Been Removed Successfull");
			// redirect
			return Redirect::to('slider')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success'); 
	
		} else {
			return Redirect::to('slider')
        		->with('messagetext','No Item Deleted')->with('msgstatus','error');				
		}

	}			

	function enable_diable_sliderstatus() {
        $uid = \Auth::user()->id;
        $items = Input::get('row_id');
        $filed_name = Input::get('filed_name');
        $action = Input::get('action');
        if ($items != '') {
            $exist = \DB::table('tb_sliders')->where('id', $items)->count();
            if ($exist > 0) {
                \DB::table('tb_sliders')->where('id', $items)->update([$filed_name => $action]);

                return "success";
            } else {
                return "error";
            }
        } else {
            return "error";
        }
    }
	
	function change_sliders_ordering( Request $request )
	{
		$uid = \Auth::user()->id;
		$slider_id = Input::get('sliderID');
		$action = Input::get('order_type');
		$ret_url = Input::get('curnurl');
		if($slider_id!='' && $slider_id>0)
		{
			$exist = \DB::table('tb_sliders')->where('id', $slider_id)->first();
			if(!empty($exist))
			{
				if($action=='up')
				{
					$previous = \DB::table('tb_sliders')->where('slider_category',$exist->slider_category)->where('sort_num', '>', $exist->sort_num)->orderBy('sort_num','asc')->first();
					if(!empty($previous))
					{
						$previous_order = $previous->sort_num - 1;
						$update_ordering = \DB::table('tb_sliders')->where('id',$previous->id)->update(['sort_num'=>$previous_order]);
					}
					$new_ord_num = $exist->sort_num + 1;
				}
				elseif($action=='down')
				{
					$next = \DB::table('tb_sliders')->where('slider_category',$exist->slider_category)->where('sort_num', '<', $exist->sort_num)->orderBy('sort_num','desc')->first();
					if(!empty($next))
					{
						$next_order = $next->sort_num + 1;
						$update_ordering = \DB::table('tb_sliders')->where('id',$next->id)->update(['sort_num'=>$next_order]);
					}
					
					$new_ord_num = $exist->sort_num - 1;
				}
				if($new_ord_num<1) { $new_ord_num = 1; }
				$update_ordering = \DB::table('tb_sliders')->where('id',$slider_id)->update(['sort_num'=>$new_ord_num]);
				if($update_ordering)
				{
					return Redirect::to($ret_url)->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
				}
			}
			else
			{
				return Redirect::to($ret_url)->with('messagetext','No record found')->with('msgstatus','error');
			}
		}
		else
		{
			return Redirect::to($ret_url)->with('messagetext','No record found')->with('msgstatus','error');
		}
	}
	
}