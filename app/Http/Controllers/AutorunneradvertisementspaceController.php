<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Autorunneradvertisementspace;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 


class AutorunneradvertisementspaceController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'autorunneradvertisementspace';
	static $per_page	= '10';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Autorunneradvertisementspace();
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'autorunneradvertisementspace',
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
		$pagination->setPath('autorunneradvertisementspace');
		
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
		return view('autorunneradvertisementspace.index',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_autorunner_advertisement_space'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['forms']);
		
		$this->data['id'] = $id;
		return view('autorunneradvertisementspace.form',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_autorunner_advertisement_space'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['grid']);
		
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		return view('autorunneradvertisementspace.view',$this->data);	
	}	

	function postSave( Request $request)
	{
		$id = $request->input('id');
		$rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data = $this->validatePost('tb_autorunneradvertisementspace');
			$data['user_id'] = \Auth::user()->id;
			if($request->input('id') =='')
			{
				$data['created_at'] = date('y-m-d h:i:s');
			}
			else
			{
				$data['updated_at'] = date('y-m-d h:i:s');
			}
			$id = $this->model->insertRow($data , $request->input('id'));
			
			if($id)
			{
				$baseprc = number_format(trim($request->input('base_price')), 2, '.', '');
				$prcptg = (trim($request->input('price_percentage'))!='') ? number_format(trim($request->input('price_percentage')), 2, '.', '') : '';
				$fnlprc = ($prcptg!='') ? $baseprc + ($baseprc * $prcptg / 100) : $baseprc; 
				$cates = \DB::table('tb_categories')->select('id')->get();
				if(!empty($cates))
				{
					foreach($cates as $cat)
					{
						$checkspace = \DB::table('tb_advertisement_space')->select('id')->where('space_position',trim($request->input('position')))->where('space_category',$cat->id)->first();
						
						$slug = \SiteHelpers::seoUrl(trim($request->input('name')));
						$tslug = \SiteHelpers::seoUrl(trim($request->input('name')));
						$exha = false;
						for($f=1;$exha!=true;$f++)
						{
							if(!empty($checkspace))
							{
								$chkspaceslug = \DB::table('tb_advertisement_space')->where('space_slug', $slug)->count();
							}
							else
							{
								$chkspaceslug = \DB::table('tb_advertisement_space')->where('space_slug', $slug)->where('id', '!=', $checkspace->id)->count();
							}
							if ($chkspaceslug>0)
							{
								$slug = $tslug.'-'.$f;
							}
							else
							{
								$slug = $slug;
								$exha = true;
							}
						}
						$spdata['user_id'] = \Auth::user()->id;
						$spdata['space_name'] = trim($request->input('name'));
						$spdata['space_slug'] = trim($slug);
						$spdata['space_title'] = trim($request->input('name'));
						$spdata['space_cpc_price'] = number_format($fnlprc, 2, '.', '');
						$spdata['space_cpc_num_clicks'] = trim($request->input('target_click'));
						$spdata['space_cpm_price'] = number_format($fnlprc, 2, '.', '');
						$spdata['space_cpm_num_view'] = trim($request->input('target_view'));
						$spdata['space_cpd_price'] = number_format($fnlprc, 2, '.', '');
						$spdata['space_cpm_num_days'] = trim($request->input('target_days'));
						$spdata['space_position'] = trim($request->input('position'));
						$spdata['space_template'] = 'slider';
						$spdata['space_max_ads'] = 1;
						$spdata['space_specific_devices'] = implode(',',[1,2,3]);
						$spdata['space_category'] = $cat->id;
						$spdata['space_status'] = 1;
						
						
						if(!empty($checkspace))
						{
							$spdata['updated_at'] = date('y-m-d h:i:s');
							\DB::table('tb_advertisement_space')->where('id',$checkspace->id)->update($spdata);
						}
						else
						{
							$spdata['created_at'] = date('y-m-d h:i:s');
							\DB::table('tb_advertisement_space')->insertGetId($spdata);
						}
					}
				}
			}
			
			if(!is_null($request->input('apply')))
			{
				$return = 'autorunneradvertisementspace/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'autorunneradvertisementspace?return='.self::returnUrl();
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

			return Redirect::to('autorunneradvertisementspace/update/'.$id)->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
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
			return Redirect::to('autorunneradvertisementspace')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success'); 
	
		} else {
			return Redirect::to('autorunneradvertisementspace')
        		->with('messagetext','No Item Deleted')->with('msgstatus','error');				
		}

	}			


}