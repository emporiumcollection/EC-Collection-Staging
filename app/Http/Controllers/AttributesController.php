<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Attributes;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 


class AttributesController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'attributes';
	static $per_page	= '10';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Attributes();
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'attributes',
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
		$pagination->setPath('attributes');
		
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
		
		return view('attributes.index',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_attributes'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['forms']);
		
		$this->data['id'] = $id;
		
		// fetch attributes options 
		$this->data['fetch_attr_opt'] = \DB::table('tb_attributes_options')->where('attr_id', $id)->get();
		
		$this->data['fetch_tags'] = \DB::table('tb_tags_manager')->where('tag_status', 1)->get();
		
		return view('attributes.form',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tb_attributes'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['grid']);
		
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		return view('attributes.view',$this->data);	
	}	

	function postSave( Request $request)
	{
		$uid = \Auth::user()->id;
		$rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data = $this->validatePost('tb_attributes');
				
			if($request->input('id') =='')
			{
				$data['created'] = date('y-m-d h:i:s');
			}
			else
			{
				$data['updated'] = date('y-m-d h:i:s');
			}
			$data['attr_permission'] = $request->input('attr_permission');
			if($request->input('attr_cat')!="")
			{
				$data['attr_cat'] = $request->input('attr_cat');
			}
			else{
				$data['attr_cat'] = '';
			}
			
			if($request->input('tab_num'))
			{
				$data['tab_num'] = $request->input('tab_num');
			}
			
			$data['attr_title_eng'] = $request->input('attr_title_eng');
			$data['attr_desc_eng'] = $request->input('attr_desc_eng');
			
			$id = $this->model->insertRow($data , $request->input('id'));
			
			$edit_opts = $request->input('edit_opt');
			
			if($request->input('attr_type')=='dropdown' || $request->input('attr_type')=='radio' || $request->input('attr_type')=='checkboxes')
			{
				if(!empty($request->input('opt_values')))
				{
					$opt_val = $request->input('opt_values');
					$opt_name = $request->input('opt_name');
					$opt_imgs = $request->file('opt_imgs');
					$opt_val_eng = $request->input('opt_values_eng');
					$opt_name_eng = $request->input('opt_name_eng');
					for($op=0;$op<count($opt_val);$op++)
					{
						$opdata = array();
						if($opt_name[$op]!='' && $opt_val[$op]!='')
						{
							if($request->input('attr_cat')=='Materialien' || $request->input('attr_cat')=='Materialien_additional')
							{
								if(!is_null($opt_imgs[$op]))
								{
									$file = $opt_imgs[$op]; 
									$destinationPath = './uploads/attributes_imgs/';
									$filename = $file->getClientOriginalName();
									$extension = $file->getClientOriginalExtension(); //if you need extension of the file
									 $newfilename = rand(11111, 99999).'.'.$extension;
									$uploadSuccess = $opt_imgs[$op]->move($destinationPath, $newfilename);				 
									if( $uploadSuccess ) {
										$opdata['attr_img'] = $newfilename;
									}
								}
							}
							$opdata['user_id'] = $uid;
							$opdata['attr_id'] = $id;
							$opdata['attr_type'] = $request->input('attr_type');
							$opdata['option_name'] = $opt_name[$op];
							$opdata['option_value'] = $opt_val[$op];
							$opdata['option_name_eng'] = $opt_name_eng[$op];
							$opdata['option_value_eng'] = $opt_val_eng[$op];
							
							if($edit_opts[$op]=="")
							{
								$opdata['created'] = date('Y-m-d h:i:s');
								\DB::table('tb_attributes_options')->insert($opdata);
							}
							else{
								$opdata['updated'] = date('Y-m-d h:i:s');
								\DB::table('tb_attributes_options')->where('id',$edit_opts[$op])->update($opdata);
							}
						}
					}
				}
			}
			elseif($request->input('attr_type')=='text' || $request->input('attr_type')=='textarea')
			{
				$opdata['user_id'] = $uid;
				$opdata['attr_id'] = $id;
				$opdata['attr_type'] = $request->input('attr_type');
				$opdata['text_value'] = $request->input('assigned_text');
				
				if($edit_opts=="")
				{
					$opdata['created'] = date('Y-m-d h:i:s');
					\DB::table('tb_attributes_options')->insert($opdata);
				}
				else{
					$opdata['updated'] = date('Y-m-d h:i:s');
					\DB::table('tb_attributes_options')->where('id',$edit_opts)->update($opdata);
				}
			}
			elseif($request->input('attr_type')=='file')
			{
				$file = $request->file('assigned_file');
				for($fl=0;$fl<count($file);$fl++)
				{
					if(!is_null($file[$fl]))
					{
						$destinationPath = './uploads/attributes_imgs/';
						$filename = $file[$fl]->getClientOriginalName();
						$extension = $file[$fl]->getClientOriginalExtension(); //if you need extension of the file
						 $newfilename = rand(11111, 99999).'.'.$extension;
						$uploadSuccess = $file[$fl]->move($destinationPath, $newfilename);				 
						if( $uploadSuccess ) {
							$opdata['user_id'] = $uid;
							$opdata['attr_id'] = $id;
							$opdata['attr_type'] = $request->input('attr_type');
							$opdata['attr_img'] = $newfilename;
							if($edit_opts[$fl]=="")
							{
								$opdata['created'] = date('Y-m-d h:i:s');
								\DB::table('tb_attributes_options')->insert($opdata);
							}
							else{
								$opdata['updated'] = date('Y-m-d h:i:s');
								\DB::table('tb_attributes_options')->where('id',$edit_opts[$fl])->update($opdata);
							}
						}
					}
				}	
			}
			elseif($request->input('attr_type')=='tab')
			{
				return Redirect::to('tab_content/'.$id)->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
			}
			elseif($request->input('attr_type')=='group')
			{
				return Redirect::to('group_content/'.$id)->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
			}
			else
			{
				\DB::table('tb_attributes_options')->where('attr_id', $id)->delete();
			}
			
			if(!is_null($request->input('apply')))
			{
				$return = 'attributes/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'attributes?return='.self::returnUrl();
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

			return Redirect::to('attributes/update/'.$id)->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
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
			
			\DB::table('tb_attributes_options')->whereIn('attr_id',$request->input('ids'))->delete();
			
			\SiteHelpers::auditTrail( $request , "ID : ".implode(",",$request->input('ids'))."  , Has Been Removed Successfull");
			// redirect
			return Redirect::to('attributes')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success'); 
	
		} else {
			return Redirect::to('attributes')
        		->with('messagetext','No Item Deleted')->with('msgstatus','error');				
		}

	}

	function addTab(Request $request, $id = null)
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
			$this->data['row'] = $this->model->getColumnTable('tb_attributes'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['forms']);
		
		$this->data['id'] = $id;
		$this->data['groupType'] =$request->input('attrType');
		$this->data['attr_cat'] =$request->input('attr_cat');
		$seleted_attr = $request->input('selectedattr');
		\Session::put('tab_attr', $seleted_attr);
		return view('attributes.tabs',$this->data);
	}
	
	function TabContent($id = null)
	{
		if($id>0 && $id!='')
		{
			$fetch_attr = \DB::table('tb_attributes')->where('id', $id)->first();
			$fetch_tabdata = \DB::table('tb_tab_content')->where('attr_id', $id)->groupBy('tab_num')->get();
			$tabno = 1;
			if(!empty($fetch_tabdata))
			{
				if($fetch_attr->tab_num > count($fetch_tabdata))
				{
					$tabno = count($fetch_tabdata)+1;
				}
				elseif($fetch_attr->tab_num == count($fetch_tabdata))
				{
					return Redirect::to('attributes')->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
				}
			}
                       $this->data['tabtitle'] = '';
			$this->data['tabno'] = $tabno;
			$this->data['aid'] = $id;
			$attrs = \Session::get('tab_attr');
			$exp_attrids = explode(',',$attrs);
			$fetch_attrArr = \DB::table('tb_attributes')->whereIn('id', $exp_attrids)->get();
			if(!empty($fetch_attrArr))
			{
				$this->data['AttrArr'] = $fetch_attrArr;
			}
			$optsArr = array();
			$attr_opts = \DB::table('tb_attributes_options')->whereIn('attr_id',$exp_attrids)->get();
			if(!empty($attr_opts))
			{
				foreach($attr_opts as $opts)
				{
					$optsArr[$opts->attr_id][] = $opts;
				}
				$this->data['optsArr'] = $optsArr;
			}
			
			return view('attributes.tab_content',$this->data);
		}
	}
	
	function SaveTabContent(Request $request)
	{
		if(!empty($request->input('assign_attr_id')))
		{
			$assign_attr_id = $request->input('assign_attr_id');
			$assign_attr_val = $request->input('assign_attr_val');
			$assign_attr_type = $request->input('assign_attr_type');
			$edit_id = $request->input('edit_assign_attr_id');
			for($op=0;$op<count($assign_attr_id);$op++)
			{
				$opdata['tab_num'] = $request->input('tab_num');
				$opdata['attr_id'] = $request->input('attr_id');
				$opdata['tab_name'] = $request->input('tab_title');
				$opdata['assign_attr_id'] = $assign_attr_id[$op];
				if($assign_attr_type[$op]=="dropdown" || $assign_attr_type[$op]=="radio" || $assign_attr_type[$op]=="checkboxes")
				{
					$opdata['assign_attr_val'] = implode(',',$assign_attr_val[$assign_attr_id[$op]]);
				}
				elseif($assign_attr_type[$op]=="text" || $assign_attr_type[$op]=="textarea")
				{
					$opdata['assign_attr_val'] = $assign_attr_val[$assign_attr_id[$op]];
				}
				if($edit_id[$op]!='' && $edit_id[$op]>0)
				{
					\DB::table('tb_tab_content')->where('assign_attr_id',$assign_attr_id[$op])->where('attr_id',$request->input('attr_id'))->where('tab_num',$request->input('tab_num'))->update($opdata);
				}
				else{
					\DB::table('tb_tab_content')->insert($opdata);
				}
				
			}
			if(!empty($edit_id))
			{
				$tab = $request->input('tab_num')+1;
				return Redirect::to('edit_tab_content/'.$request->input('attr_id').'/'.$tab)->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
			}
			else
			{
				return Redirect::to('tab_content/'.$request->input('attr_id'))->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
			}
		}
	}
	
	function EditTabContent($id = null, $tab = null)
	{
		if($id>0 && $id!='')
		{
			$fetch_attr = \DB::table('tb_attributes')->where('id', $id)->first();
			$fetch_tab_total = \DB::table('tb_tab_content')->where('attr_id', $id)->groupBy('tab_num')->get();
			if(!empty($fetch_tab_total))
			{
				if($tab > count($fetch_tab_total))
				{
					return Redirect::to('attributes')->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
				}
			}
			$fetch_tabdata = \DB::table('tb_tab_content')->where('attr_id', $id)->where('tab_num', $tab)->get();
			$this->data['tabdata'] = '';
			$exp_attrids = array();
			if(!empty($fetch_tabdata))
			{
				$tabdata = array();
				foreach($fetch_tabdata as $tabs)
				{
					$tabdata[$tabs->assign_attr_id] = $tabs;
					$exp_attrids[] = $tabs->assign_attr_id;
					$tabTitle = $tabs->tab_name;
				}
				$this->data['tabdata'] = $tabdata;
			}
			$this->data['tabno'] = $tab;
			$this->data['aid'] = $id;
			$this->data['tabtitle'] = $tabTitle;
			$fetch_attrArr = \DB::table('tb_attributes')->whereIn('id', $exp_attrids)->get();
			if(!empty($fetch_attrArr))
			{
				$this->data['AttrArr'] = $fetch_attrArr;
			}
			$optsArr = array();
			$attr_opts = \DB::table('tb_attributes_options')->whereIn('attr_id',$exp_attrids)->get();
			if(!empty($attr_opts))
			{
				foreach($attr_opts as $opts)
				{
					$optsArr[$opts->attr_id][] = $opts;
				}
				$this->data['optsArr'] = $optsArr;
			}
			return view('attributes.tab_content',$this->data);
		}
	}
	
	function GroupContent($id = null)
	{
		if($id>0 && $id!='')
		{
			$fetch_attr = \DB::table('tb_attributes')->where('id', $id)->first();
			$this->data['aid'] = $id;
			$fetch_groupdata = \DB::table('tb_group_content')->where('attr_id', $id)->get();
			$this->data['groupdata'] = '';
			if(!empty($fetch_groupdata))
			{
				$groupdata = array();
				foreach($fetch_groupdata as $group)
				{
					$groupdata[$group->group_row_num][$group->assign_attr_id] = $group;
					$exp_attrids[] = $group->assign_attr_id;
				}
				$this->data['groupdata'] = $groupdata;
			}
			else{
				$attrs = \Session::get('tab_attr');
				$exp_attrids = explode(',',$attrs);
			}
			
			$fetch_attrArr = \DB::table('tb_attributes')->whereIn('id', $exp_attrids)->get();
			if(!empty($fetch_attrArr))
			{
				$this->data['AttrArr'] = $fetch_attrArr;
			}
			$optsArr = array();
			$attr_opts = \DB::table('tb_attributes_options')->whereIn('attr_id',$exp_attrids)->get();
			if(!empty($attr_opts))
			{
				foreach($attr_opts as $opts)
				{
					$optsArr[$opts->attr_id][] = $opts;
				}
				$this->data['optsArr'] = $optsArr;
			}
			
			return view('attributes.group_content',$this->data);
		}
	}
	
	function SaveGroupContent(Request $request)
	{
		if(!empty($request->input('assign_attr_id')))
		{
			\DB::table('tb_group_content')->where('attr_id', $request->input('attr_id'))->delete();
			$assign_attr_id = $request->input('assign_attr_id');
			$assign_attr_val = $request->input('assign_attr_val');
			$assign_attr_type = $request->input('assign_attr_type');
			$edit_id = $request->input('edit_assign_attr_id');
			$totgroups = $request->input('tot_group');
			for($op=1;$op<=$totgroups;$op++)
			{
				$opdata['group_row_num'] = $op;
				$opdata['attr_id'] = $request->input('attr_id');
				if (array_key_exists($op, $assign_attr_id))
				{
					for($ap=0;$ap<count($assign_attr_id[$op]);$ap++)
					{
						$opdata['assign_attr_id'] = $assign_attr_id[$op][$ap];
						if($assign_attr_type[$op][$ap]=="dropdown" || $assign_attr_type[$op][$ap]=="radio" || $assign_attr_type[$op][$ap]=="checkboxes" || $assign_attr_type[$op][$ap]=="file")
						{
							$opdata['assign_attr_val'] = implode(',',$assign_attr_val[$op][$assign_attr_id[$op][$ap]]);
						}
						elseif($assign_attr_type[$op][$ap]=="text" || $assign_attr_type[$op][$ap]=="textarea")
						{
							$opdata['assign_attr_val'] = $assign_attr_val[$op][$assign_attr_id[$op][$ap]];
						}
						/*if($edit_id[$op][$ap]!='' && $edit_id[$op][$ap]>0)
						{
							\DB::table('tb_group_content')->where('id',$edit_id[$op][$ap])->update($opdata);
						}
						else{
							\DB::table('tb_group_content')->insert($opdata);
						}*/
						
						\DB::table('tb_group_content')->insert($opdata);
					}
				}
			}
			return Redirect::to('attributes')->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
		}
	}
	
	public function remove_attribute_option(Request $request)
	{
		$optId = $request->input('optId');
		if($optId!="" && $optId>0)
		{
			$check_option = \DB::table('tb_attributes_options')->where('id', $optId)->count();
			if($check_option>0)
			{
				$del_option = \DB::table('tb_attributes_options')->where('id', $optId)->delete();
				if($del_option)
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
	
	
	public function copyAttribute(Request $request)
	{
		$Attrs = $request->input('selectedattr');
		if($Attrs!="")
		{
			$attr = explode(',',$Attrs);
			foreach($attr as $single)
			{
				$check_attr = \DB::table('tb_attributes')->where('id', $single)->first();
				if(!empty($check_attr))
				{
					$mainAttr['attr_type'] = $check_attr->attr_type;
					$mainAttr['attr_cat'] = $check_attr->attr_cat;
					$mainAttr['attr_title'] = $check_attr->attr_title;
					$mainAttr['attr_desc'] = $check_attr->attr_desc;
					$mainAttr['attr_status'] = $check_attr->attr_status;
					$mainAttr['attr_permission'] = $check_attr->attr_permission;
					$mainAttr['tab_num'] = $check_attr->tab_num;
					$mainAttr['sort_order'] = $check_attr->sort_order;
					$mainAttr['created'] = date('Y-m-d h:i:s');
					$newAttrId = \DB::table('tb_attributes')->insertGetId($mainAttr);
					
					if($check_attr->attr_type=='group')
					{
						$check_group_attr = \DB::table('tb_group_content')->where('attr_id', $single)->get();
						if(!empty($check_group_attr))
						{
							foreach($check_group_attr as $group_attr)
							{
								$groupAttr['attr_id'] = $newAttrId;
								$groupAttr['group_row_num'] = $group_attr->group_row_num;
								$groupAttr['assign_attr_id'] = $group_attr->assign_attr_id;
								$groupAttr['assign_attr_val'] = $group_attr->assign_attr_val;
								$groupAttrId = \DB::table('tb_group_content')->insertGetId($groupAttr);
							}
							
						}
					}
					elseif($check_attr->attr_type=='tab')
					{
						$check_tab_attr = \DB::table('tb_tab_content')->where('attr_id', $single)->get();
						if(!empty($check_tab_attr))
						{
							foreach($check_tab_attr as $tab_attr)
							{
								$tabAttr['attr_id'] = $newAttrId;
								$tabAttr['tab_num'] = $tab_attr->tab_num;
								$tabAttr['tab_name'] = $tab_attr->tab_name;
								$tabAttr['assign_attr_id'] = $tab_attr->assign_attr_id;
								$tabAttr['assign_attr_val'] = $tab_attr->assign_attr_val;
								$tabAttrId = \DB::table('tb_tab_content')->insertGetId($tabAttr);
							}
							
						}
					}
					else
					{
						$check_attr_opt = \DB::table('tb_attributes_options')->where('attr_id', $single)->get();
						if(!empty($check_attr_opt))
						{
							$uid = \Auth::user()->id;
							foreach($check_attr_opt as $attrOpt)
							{
								$AttrOpt['attr_id'] = $newAttrId;
								$AttrOpt['user_id'] = $uid;
								$AttrOpt['attr_type'] = $attrOpt->attr_type;
								$AttrOpt['option_name'] = $attrOpt->option_name;
								$AttrOpt['option_value'] = $attrOpt->option_value;
								$AttrOpt['text_value'] = $attrOpt->text_value;
								$AttrOpt['attr_img'] = $attrOpt->attr_img;
								$AttrOpt['option_name_eng'] = $attrOpt->option_name_eng;
								$AttrOpt['option_value_eng'] = $attrOpt->option_value_eng;
								$AttrOpt['created'] = date('Y-m-d h:i:s');
								$AttrOptId = \DB::table('tb_attributes_options')->insertGetId($AttrOpt);
							}
							
						}
					}
				}
			}
			return Redirect::to('attributes')->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
		}
		else{
			return Redirect::to('attributes')->with('messagetext','Please select Attributes First.')->with('msgstatus','error');
		}
	}
}