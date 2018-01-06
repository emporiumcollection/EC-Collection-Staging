<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Customfields;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 


class CustomfieldsController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'customfields';
	static $per_page	= '10';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Customfields();
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'customfields',
			'return'	=> self::returnUrl()
			
		);
		
	}

	public function getIndex( Request $request )
	{

		if($this->access['is_view'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');

		$sort = (!is_null($request->input('sort')) ? $request->input('sort') : 'order_num'); 
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
		$pagination->setPath('customfields');
		
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
		return view('customfields.index',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_custom_fields'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['forms']);
		
		$this->data['id'] = $id;
		$this->data['seloptions'] = (new ContainerController)->fetchFolderTreeOptions();
		
		$this->data['rowhdn'] = \DB::table('tb_custom_fields')->where('id', $id)->first();
		
		return view('customfields.form',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_custom_fields'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['grid']);
		
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		return view('customfields.view',$this->data);	
	}	

	function postSave( Request $request)
	{
		$uid = \Auth::user()->id;
		$id = $request->input('id');
		$rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data = $this->validatePost('tb_customfields');
			
			$fdtype = $request->input('type');
			$pdata[$fdtype] = $request->input($fdtype);
			$destinationPath = public_path().'/uploads/customfileds_imgs/';
			if($fdtype=="file")
			{
				if(!is_null($request->file('file_image')))
				{
					$file = $request->file('file_image');
					$filename = $file->getClientOriginalName();
					$extension = $file->getClientOriginalExtension(); //if you need extension of the file
					$filename = rand(11111111, 99999999).'-'.rand(11111111, 99999999).'.'.$extension;
					$uploadSuccess = $file->move($destinationPath, $filename);
					if($uploadSuccess)
					{
						$pdata[$fdtype]['image'] = $filename;
					}
				}			
				elseif(is_null($request->file('file_image')))
				{
					if($request->input('container_file_image')!="")
					{
						$container_file_image = $request->input('container_file_image');
						$explode_fileimage = explode('/', $container_file_image);
						$filename = rand(11111, 99999).'-'. end($explode_fileimage);
						$successfile = \File::copy($container_file_image, $destinationPath.$filename);
						if($successfile)
						{
							$pdata[$fdtype]['image'] = $filename;
						}
					}
					else{
						if($request->input('file_image_hidden')!="")
						{
							$pdata[$fdtype]['image'] = $request->input('file_image_hidden');
						}
						else{
							$pdata[$fdtype]['image'] = '';
						}
					}
				}
			}
			
			if($fdtype=="url")
			{
				if(!is_null($request->file('url_link_image')))
				{
					$file_url = $request->file('url_link_image');
					$filename_url = $file_url->getClientOriginalName();
					$extension_url = $file_url->getClientOriginalExtension(); //if you need extension of the file
					$filename_url = rand(11111111, 99999999).'-'.rand(11111111, 99999999).'.'.$extension_url;
					$uploadSuccess_url = $file_url->move($destinationPath, $filename_url);
					if($uploadSuccess_url)
					{
						$pdata[$fdtype]['link_image'] = $filename_url;
					}
				}			
				elseif(is_null($request->file('url_link_image')))
				{
					if($request->input('container_url_link_image')!="")
					{
						$container_file_image_url = $request->input('container_url_link_image');
						$explode_fileimage_url = explode('/', $container_file_image_url);
						$filename_url = rand(11111, 99999).'-'. end($explode_fileimage_url);
						$successfile_url = \File::copy($container_file_image_url, $destinationPath.$filename_url);
						if($successfile_url)
						{
							$pdata[$fdtype]['link_image'] = $filename_url;
						}
					}
					else{
						if($request->input('url_link_image_hidden')!="")
						{
							$pdata[$fdtype]['link_image'] = $request->input('url_link_image_hidden');
						}
						else{
							$pdata[$fdtype]['link_image'] = '';
						}
					}
				}
			}
			
			if($fdtype=="link")
			{
				if(!is_null($request->file('link_link_image')))
				{
					$file_link = $request->file('link_link_image');
					$filename_link = $file_link->getClientOriginalName();
					$extension_link = $file_link->getClientOriginalExtension(); //if you need extension of the file
					$filename_link = rand(11111111, 99999999).'-'.rand(11111111, 99999999).'.'.$extension_link;
					$uploadSuccess_link = $file->move($destinationPath, $filename_link);
					if($uploadSuccess_link)
					{
						$pdata[$fdtype]['link_image'] = $filename_link;
					}
				}			
				elseif(is_null($request->file('link_link_image')))
				{
					if($request->input('container_link_link_image')!="")
					{
						$container_file_image_link = $request->input('container_link_link_image');
						$explode_fileimage_link = explode('/', $container_file_image_link);
						$filename_link = rand(11111, 99999).'-'. end($explode_fileimage_link);
						$successfile_link = \File::copy($container_file_image_link, $destinationPath.$filename_link);
						if($successfile_link)
						{
							$pdata[$fdtype]['link_image'] = $filename_link;
						}
					}
					else{
						if($request->input('link_link_image_hidden')!="")
						{
							$pdata[$fdtype]['link_image'] = $request->input('link_link_image_hidden');
						}
						else{
							$pdata[$fdtype]['link_image'] = '';
						}
					}
				}
			}
			
			
			$data['parameters'] = json_encode($pdata);
			
			$alias = \SiteHelpers::seoUrl(Input::get('caption'));
			$exha = false;
			for($f=1;$exha!=true;$f++)
			{
				if($request->input('id') =='')
				{
					$check_alias = \DB::table('tb_custom_fields')->where('alias', $alias)->count();
				}
				else
				{
					$check_alias = \DB::table('tb_custom_fields')->where('alias', $alias)->where('id', '!=', $id)->count();
				}
				if ($check_alias>0)
				{
					$alias = $alias.'-'.$f;
				}
				else
				{
					$alias = $alias;
					$exha = true;
				}
			}
			if($request->input('id') =='')
			{
				$check_ordering = \DB::table('tb_custom_fields')->orderBy('order_num', 'desc')->first();
				if(!empty($check_ordering)){
					$data['order_num'] = $check_ordering->order_num + 1;
				}
				else{
					$data['order_num'] = 1;
				}
			}
			
			$data['alias'] = $alias;
			$data['user_id'] = $uid;
			if($request->input('id') =='')
			{
				$data['created'] = date('Y-m-d h:i:s');
			}
			else
			{
				$data['updated'] = date('Y-m-d h:i:s');
			}
			
			if($request->input('tab_nums'))
			{
				$data['tab_nums'] = $request->input('tab_nums');
			}
			
			$id = $this->model->insertRow($data , $request->input('id'));
			
			if($request->input('type')=='tabs')
			{
				return Redirect::to('customfields_tabs/'.$id)->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
			}
			elseif($request->input('type')=='group')
			{
				return Redirect::to('customfields_group/'.$id)->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
			}
			
			if(!is_null($request->input('apply')))
			{
				$return = 'customfields/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'customfields?return='.self::returnUrl();
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

			return Redirect::to('customfields/update/'.$id)->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
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
			$exitdel = \DB::table('tb_custom_fields')->where('id',$sel_ids[0])->first();
			$this->model->destroy($request->input('ids'));
			
			if(!empty($exitdel))
			{
				$nextEntries = \DB::table('tb_custom_fields')->where('order_num', '>', $exitdel->order_num)->orderBy('order_num','asc')->get();
				if(!empty($nextEntries))
				{
					foreach($nextEntries as $next)
					{
						$next_order = $exitdel->order_num;
						$update_ordering = \DB::table('tb_custom_fields')->where('id',$next->id)->update(['order_num'=>$next_order]);
						$next_order = $next_order + 1;
					}
				}
			}
			
			$checkadditional = \DB::table('tb_customfields_additional')->whereIn('field_id',$request->input('ids'))->get();
			if(!empty($checkadditional))
			{
				\DB::table('tb_customfields_additional')->whereIn('field_id',$request->input('ids'))->delete();
			}
			
			\SiteHelpers::auditTrail( $request , "ID : ".implode(",",$request->input('ids'))."  , Has Been Removed Successfull");
			// redirect
			return Redirect::to('customfields')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success'); 
	
		} else {
			return Redirect::to('customfields')
        		->with('messagetext','No Item Deleted')->with('msgstatus','error');				
		}

	}

	function enable_diable_field_option()
	{
		$uid = \Auth::user()->id;
		$items = Input::get('row_id');
		$filed_name = Input::get('filed_name');
		$action = Input::get('action');
		if($items!='')
		{
			$exist = \DB::table('tb_custom_fields')->where('id', $items)->count();
			if($exist>0)
			{
				\DB::table('tb_custom_fields')->where('id',$items)->update([$filed_name=>$action]);

				return "success";
			}
			else
			{
				return "error";
			}
		}
		else
		{
			return "error";
		}
	}
	
	function change_fileds_ordering( Request $request )
	{
		$uid = \Auth::user()->id;
		$filed_id = Input::get('fieldID');
		$action = Input::get('order_type');
		$ret_url = Input::get('curnurl');
		if($filed_id!='' && $filed_id>0)
		{
			$exist = \DB::table('tb_custom_fields')->where('id', $filed_id)->first();
			if(!empty($exist))
			{
				if($action=='up')
				{
					$previous = \DB::table('tb_custom_fields')->where('order_num', '<', $exist->order_num)->orderBy('order_num','desc')->first();
					if(!empty($previous))
					{
						$previous_order = $previous->order_num + 1;
						$update_ordering = \DB::table('tb_custom_fields')->where('id',$previous->id)->update(['order_num'=>$previous_order]);
					}
					$new_ord_num = $exist->order_num - 1;
				}
				elseif($action=='down')
				{
					$next = \DB::table('tb_custom_fields')->where('order_num', '>', $exist->order_num)->orderBy('order_num','asc')->first();
					if(!empty($next))
					{
						$next_order = $next->order_num - 1;
						$update_ordering = \DB::table('tb_custom_fields')->where('id',$next->id)->update(['order_num'=>$next_order]);
					}
					
					$new_ord_num = $exist->order_num + 1;
				}
				
				$update_ordering = \DB::table('tb_custom_fields')->where('id',$filed_id)->update(['order_num'=>$new_ord_num]);
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
	
	function addGroupTab(Request $request, $id = null)
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
			$this->data['row'] = $this->model->getColumnTable('tb_custom_fields'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['forms']);
		
		$this->data['id'] = $id;
		$this->data['addfieldType'] = $request->input('fieldType');
		$seleted_fields = $request->input('selectedField');
		\Session::put('tab_fields', $seleted_fields);
		return view('customfields.tab_group',$this->data);
	}
	
	function CustomfieldsTabs($id = null)
	{
		if($id>0 && $id!='')
		{
			$fetch_field = \DB::table('tb_custom_fields')->where('id', $id)->first();
			$fetch_tabdata = \DB::table('tb_customfields_additional')->where('field_id', $id)->where('field_type', 'tabs')->get();
			$tabno = 1;
			if(!empty($fetch_tabdata))
			{
				if($fetch_field->tab_nums > count($fetch_tabdata))
				{
					$tabno = count($fetch_tabdata)+1;
				}
				elseif($fetch_field->tab_nums == count($fetch_tabdata))
				{
					return Redirect::to('customfields')->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
				}
			}
			$this->data['tabtitle'] = '';
			$this->data['tabno'] = $tabno;
			$this->data['fldid'] = $id;
			$fields = \Session::get('tab_fields');
			$exp_fields = explode(',',$fields);
			$fetch_fieldArr = \DB::table('tb_custom_fields')->whereIn('id', $exp_fields)->get();
			if(!empty($fetch_fieldArr))
			{
				$this->data['FieldArr'] = $fetch_fieldArr;
			}
			
			return view('customfields.tab_content',$this->data);
		}
	}
	
	function CustomfieldsEditTabContent($id = null, $tab = null)
	{
		if($id>0 && $id!='')
		{
			$fetch_attr = \DB::table('tb_custom_fields')->where('id', $id)->first();
			$fetch_tab_total = \DB::table('tb_customfields_additional')->where('field_id', $id)->where('field_type', 'tabs')->get();
			if(!empty($fetch_tab_total))
			{
				if($tab > count($fetch_tab_total))
				{
					return Redirect::to('customfields')->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
				}
				$exp_fields = array();
				foreach($fetch_tab_total as $fetch_tabl)
				{
					$exp_fields[] = $fetch_tabl->assign_field_id;
				}
			}
			$fetch_tabdata = \DB::table('tb_customfields_additional')->where('field_id', $id)->where('assign_tab_num', $tab)->first();
			$this->data['tabdata'] = '';
			if(!empty($fetch_tabdata))
			{
				$this->data['tabdata'] = $fetch_tabdata;
			}
			$this->data['tabno'] = $tab;
			$this->data['fldid'] = $id;
			
			$fetch_fieldArr = \DB::table('tb_custom_fields')->whereIn('id', $exp_fields)->get();
			if(!empty($fetch_fieldArr))
			{
				$this->data['FieldArr'] = $fetch_fieldArr;
				foreach($fetch_fieldArr as $fetch_opt)
				{
					$fieldsOpts[$fetch_opt->id] = $fetch_opt;
				}
				$this->data['FieldOPtArr'] = $fieldsOpts;
			}
			
			return view('customfields.tab_content',$this->data);
		}
	}
	
	function SaveCustomfieldsTabContent(Request $request)
	{
		if($request->input('assign_field')!='')
		{
			$uid = \Auth::user()->id;
			$assign_field = $request->input('assign_field');
			$assign_field_val = $request->input('assign_field_val');
			$edit_id = $request->input('edit_assign_field_id');
			$assign_type_id = explode('-',$assign_field);
			
			$opdata['user_id'] = $uid;
			$opdata['field_id'] = $request->input('field_id');
			$opdata['field_type'] = 'tabs';
			$opdata['assign_field_type'] = $assign_type_id[0];
			$opdata['assign_field_id'] = $assign_type_id[1];
			$opdata['assign_field_values'] = implode(',',$assign_field_val);
			$opdata['assign_tab_num'] = $request->input('tab_num');
			$opdata['assign_tab_name'] = $request->input('assign_tab_name');
			
			if($edit_id!='' && $edit_id>0)
			{
				$opdata['updated'] = date('Y-m-d h:i:s');
				\DB::table('tb_customfields_additional')->where('id', $edit_id)->update($opdata);
			}
			else{
				$opdata['created'] = date('Y-m-d h:i:s');
				\DB::table('tb_customfields_additional')->insert($opdata);	
			}
			if($edit_id!='')
			{
				$tab = $request->input('tab_num')+1;
				return Redirect::to('customfields_edit_tab_content/'.$request->input('field_id').'/'.$tab)->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
			}
			else
			{
				return Redirect::to('customfields_tabs/'.$request->input('field_id'))->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
			}
		}
	}
	
	function CustomfieldsGroup($id = null)
	{
		if($id>0 && $id!='')
		{
			$fetch_field = \DB::table('tb_custom_fields')->where('id', $id)->first();
			$this->data['fldid'] = $id;
			$fetch_groupdata = \DB::table('tb_customfields_additional')->where('field_id', $id)->where('field_type', 'group')->get();
			$this->data['groupdata'] = '';
			if(!empty($fetch_groupdata))
			{
				$groupdata = array();
				foreach($fetch_groupdata as $group)
				{
					$groupdata[$group->assign_field_id] = $group;
					$exp_fields[] = $group->assign_field_id;
				}
				$this->data['groupdata'] = $groupdata;
			}
			else{
				$fields = \Session::get('tab_fields');
				$exp_fields = explode(',',$fields);
			}
			
			$fetch_fieldArr = \DB::table('tb_custom_fields')->whereIn('id', $exp_fields)->get();
			if(!empty($fetch_fieldArr))
			{
				$this->data['FieldArr'] = $fetch_fieldArr;
			}
			
			return view('customfields.group_content',$this->data);
		}
	}
	
	function SaveCustomfieldsGroupContent(Request $request)
	{
		$uid = \Auth::user()->id;
		if(!empty($request->input('assign_field_id')))
		{
			$assign_field_id = $request->input('assign_field_id');
			$assign_field_val = $request->input('assign_field_val');
			$assign_field_type = $request->input('assign_field_type');
			$edit_id = $request->input('edit_assign_field_id');
			for($op=0;$op<count($assign_field_id);$op++)
			{
				$opdata['user_id'] = $uid;
				$opdata['field_id'] = $request->input('field_id');
				$opdata['field_type'] = 'group';
				$opdata['assign_field_type'] = $assign_field_type[$op];
				$opdata['assign_field_id'] = $assign_field_id[$op];
				$opdata['assign_field_values'] = implode(',',$assign_field_val[$assign_field_id[$op]]);
				if($edit_id[$op]!='' && $edit_id[$op]>0)
				{
					$opdata['updated'] = date('Y-m-d h:i:s');
					\DB::table('tb_customfields_additional')->where('id', $edit_id[$op])->update($opdata);
				}
				else{
					$opdata['created'] = date('Y-m-d h:i:s');
					\DB::table('tb_customfields_additional')->insert($opdata);	
				}
			}
			return Redirect::to('customfields')->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
		}
	}
	
	function getCustomfieldOptions(Request $request)
	{
		$field_id = $request->input('field_id');
		$field_opts = \DB::table('tb_custom_fields')->where('id',$field_id)->first();
		if(!empty($field_opts))
		{
			return json_encode($field_opts);
		}
		else{
			return 'error';
		}
		
	}


}