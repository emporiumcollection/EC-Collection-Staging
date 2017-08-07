<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Imapper;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 
use File;
use DB;


class ImapperController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'imapper';
	static $per_page	= '10';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Imapper();
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'imapper',
			'return'	=> self::returnUrl()
			
		);
		
	}

	public function getIndex( Request $request, $id = 0)
	{
		if($this->access['is_view'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
		$uid = \Auth::user()->id;
		
		$filter = " AND parent_id='".$id."'";
		if(\Auth::user()->group_id==3)
		{
			$filter .= " AND (id in (select folder_id from tb_permissions where user_id='".$uid."' and no_permission='0') or global_permission='1')";
		}
		if(\Auth::user()->group_id==2)
		{
			$filter .= " AND (user_id='".$uid."' or (user_id!='".$uid."' and global_permission='1'))";
		}
		$params = array(
			'params'	=> $filter
		);
		// Get Query 
		$results = $this->model->getRows( $params );
		
		$foldername = DB::table('tb_container')->where('id',$id);
		$this->data['foldername'] = $foldername->select('name','parent_id','user_id', 'global_permission')->first();

		$filess_temp = DB::table('tb_container_files')->where('folder_id',$id);
		if(\Auth::user()->group_id==2 && (!empty($this->data['foldername'] && $this->data['foldername']->global_permission==0)))
		{
			$filess_temp->where('user_id',$uid);
		}
		$filess = $filess_temp->get();
	
		$ct=0; 
		$this->data['rowData'] = '';
		foreach($results['rows'] as $folderObj ){
			$totfiles = DB::table('tb_container_files')->where('folder_id',$folderObj->id)->count();
			$this->data['rowData'][$ct]['id'] = $folderObj->id;
			$this->data['rowData'][$ct]['name'] = $folderObj->name;
			$this->data['rowData'][$ct]['ftype'] = 'folder';
			$this->data['rowData'][$ct]['imgsrc'] = '';
			$this->data['rowData'][$ct]['filecount'] = $totfiles;
			$ct++;
		}
		if(\Auth::user()->group_id!=3 || (!empty($this->data['foldername'] && $this->data['foldername']->global_permission==1)))
		{
			foreach($filess as $filesObj ){
				$this->data['rowData'][$ct]['id'] = $filesObj->id;
				$this->data['rowData'][$ct]['name'] = $filesObj->file_name;
				$this->data['rowData'][$ct]['ftype'] = 'file';
				$imgsrc = $this->getThumbpath($filesObj->folder_id);
				$this->data['rowData'][$ct]['imgsrc'] = $imgsrc;
				$this->data['rowData'][$ct]['filecount'] = '';
				$ct++;
			}
		}
		else{
			$selfiles = DB::table('tb_permissions')->where('folder_id',$id)->where('user_id',$uid)->first();
			if(!empty($selfiles))
			{
				if($selfiles->view==1 || $selfiles->inherit==1)
				{
					foreach($filess as $filesObj ){
						$this->data['rowData'][$ct]['id'] = $filesObj->id;
						$this->data['rowData'][$ct]['name'] = $filesObj->file_name;
						$this->data['rowData'][$ct]['ftype'] = 'file';
						$imgsrc = $this->getThumbpath($filesObj->folder_id);
						$this->data['rowData'][$ct]['imgsrc'] = $imgsrc;
						$this->data['rowData'][$ct]['filecount'] = '';
						$ct++;
					}
				}
			}
		}
		
		$subfoldertotal = DB::table('tb_container')->where('parent_id',$id);
		if(\Auth::user()->group_id==2 && (!empty($this->data['foldername'] && $this->data['foldername']->global_permission==0)))
		{
			$subfoldertotal->where('user_id',$uid);
		}
		$this->data['subfoldertotal'] = $subfoldertotal->count();
				
		$subfilestotal = DB::table('tb_container_files')->where('folder_id',$id);
		if(\Auth::user()->group_id==2 && (!empty($this->data['foldername'] && $this->data['foldername']->global_permission==0)))
		{
			$subfilestotal->where('user_id',$uid);
		}
		$this->data['subfilestotal'] = $subfilestotal->count();
		
		$subfileBytes_temp = DB::table('tb_container_files')->where('folder_id',$id);
		if(\Auth::user()->group_id==2 && (!empty($this->data['foldername'] && $this->data['foldername']->global_permission==0)))
		{
			$subfileBytes_temp->where('user_id',$uid);
		}
		$subfileBytes = $subfileBytes_temp->sum('file_size');
		
		$subfileMb = ($subfileBytes/(1000*1000));
		$this->data['subfileSpace'] = round($subfileMb,2,PHP_ROUND_HALF_UP);
		
		$this->data['users'] = DB::table('tb_users')->where('group_id',3)->where('active',1)->get();
		$permiss = array();
		$permission = DB::table('tb_permissions')->where('folder_id',$id)->get();
		foreach($permission as $permit)
		{
			$permiss[$permit->user_id] = $permit;
		}
		
		$this->data['permissions'] = $permiss;
		$this->data['tree'] = $this->fetchFolderTreeList('','');
		$this->data['fid'] = $id;
		$this->data['group'] = \Auth::user()->group_id;
		if(\Auth::user()->group_id==3)
		{
			$this->data['userpermissions'] = DB::table('tb_permissions')->where('user_id',$uid)->where('folder_id',$id)->first();
			return view('imapper.index',$this->data);
		}
		else
		{
			return view('imapper.index',$this->data);
		}
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
				
		$this->data['access']		= $this->access;
		return view('imapper.form',$this->data);
	}	

	public function getShow( $id = null)
	{
	
		if($this->access['is_detail'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', Lang::get('core.note_restric'))->with('msgstatus','error');
					
		
		$this->data['access']		= $this->access;
		return view('imapper.view',$this->data);	
	}	

	function postSave( Request $request)
	{
		
	
	}	

	public function postDelete( Request $request)
	{
		
		if($this->access['is_remove'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
		
	}

	function fetchFolderTreeList($parent = 0, $user_tree_array = '') {
 
		if (!is_array($user_tree_array))
		$user_tree_array = array();
	
		$uid = \Auth::user()->id;
		$filter = " AND parent_id='".$parent."'";
		if(\Auth::user()->group_id==3)
		{
			$filter .= " AND (id in (select folder_id from tb_permissions where user_id='".$uid."' and no_permission='0') or global_permission='1')";
		}
		if(\Auth::user()->group_id==2)
		{
			$filter .= " AND (user_id='".$uid."' or (user_id!='".$uid."' and global_permission='1'))";
		}
		$params = array(
			'params'	=> $filter,
			'order'		=> 'asc'
		);
		// Get Query 
		$results = $this->model->getRows( $params );
		
	  if ($results) {
		 $user_tree_array[] = '<ul class="folders parent'.$parent.'">';
		foreach($results['rows'] as $row) {
			$totfiles_temp = DB::table('tb_container_files')->where('folder_id',$row->id);
			if(\Auth::user()->group_id==2)
			{
				$totfiles_temp->where('user_id',$uid);
			}
			$totfiles = $totfiles_temp->count();
			$url = \URL::to('ifolders/'.$row->id);
						
			$active_cls = '';
			if($parent==$row->id){
				$active_cls = 'class="active"';
			}
			$user_tree_array[] = '<li '.$active_cls.'><a href="'.$url.'" class="expand" title=""><span>'. $row->name.'<span>('.$totfiles.')</span></span></a></li>';
			
		  $user_tree_array = $this->fetchFolderTreeList($row->id, $user_tree_array);
		}
		$user_tree_array[] = "</ul>";
	  }
	  return $user_tree_array;
	}
	
	function getThumbpath($id)
	{
		$fuser = DB::table('tb_users')->join('tb_container', 'tb_users.id', '=', 'tb_container.user_id')->where('tb_container.id', $id)->first();
		$usrname = $fuser->username;
		$fpath = \URL::to('uploads/container_user/'.$usrname).'/';
		//echo $fpath; die;
		$folds = array_reverse($this->fetchFolderParentList($id));
		if(!empty($folds))
		{
			foreach($folds as $fold)
			{
				$fpath .= $fold.'/';
			}
		}
		return $fpath;
	}
	
	function fetchFolderParentList($id = 0, $parent_folders_array = '') {
 
		if (!is_array($parent_folders_array))
		$parent_folders_array = array();
	
		$filter = " AND id='".$id."'";
		
		$params = array(
			'params'	=> $filter,
			'order'		=> 'asc'
		);
		// Get Query 
		$results = $this->model->getRows( $params );
	  if ($results) {
		foreach($results['rows'] as $row) {
			$parent_folders_array[] = $row->name;
			$parent_folders_array = $this->fetchFolderParentList($row->parent_id, $parent_folders_array);
		}
	  }
	  return $parent_folders_array;
	}
	
	
	public function Showfiles( $fid = 0, $id = 0)
	{
		$uid = \Auth::user()->id;
		if($this->access['is_detail'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', Lang::get('core.note_restric'))->with('msgstatus','error');
					
		
		$file_temp = DB::table('tb_container_files')->join('tb_container', 'tb_container.id', '=', 'tb_container_files.folder_id')->join('tb_users', 'tb_users.id', '=', 'tb_container_files.user_id')->select('tb_users.first_name', 'tb_users.last_name', 'tb_container_files.*', 'tb_container.name as folderName')->where('tb_container_files.id', $id);
		
		$file = $file_temp->first();
		
		$spaceAllowed = \Auth::user()->storage_space;
		$usedSpaceBytes_temp = DB::table('tb_container_files');
		if(\Auth::user()->group_id==2)
		{
			$usedSpaceBytes_temp->where('user_id',$uid);
		}
		$usedSpaceBytes = $usedSpaceBytes_temp->sum('file_size');
		if(\Auth::user()->group_id!=3)
		{
			$usedSpaceMb = ($usedSpaceBytes/(1000*1000));
			$usedSpace = round($usedSpaceMb,2,PHP_ROUND_HALF_UP);
			$usedSpacePercentage = ($usedSpace*100)/$spaceAllowed;
			$this->data['allowStorage'] = $spaceAllowed;
			$this->data['usedStorage'] = $usedSpace;
			$this->data['usedStoragePerct'] = round($usedSpacePercentage,2,PHP_ROUND_HALF_UP);
		}
		$this->data['tree'] = $this->fetchFolderTreeList();
		$this->data['access'] = $this->access;
		$this->data['prevfolder'] = $fid;
		$this->data['group'] = \Auth::user()->group_id;
		$this->data['rowFile'] = $file;
		$imgsrc = $this->getThumbpath($file->folder_id);
		$this->data['rowFile']->imgsrc = $imgsrc;
		if(\Auth::user()->group_id==3)
		{
			$this->data['userpermissions'] = DB::table('tb_permissions')->where('user_id',$uid)->where('folder_id',$fid)->first();
		}
		$this->data['findPin'] = DB::table('tb_imapper_pins')->where('file_id',$id)->get();
		$imgsrc2 = $this->getContainerUserPath($file->folder_id);
		$this->data['datas'] = getimagesize($imgsrc2.$file->file_name);
		return view('imapper.view',$this->data);	
	}
	
	function getContainerUserPath($id)
	{
		$usrname = \Auth::user()->username;
		if($id>0)
		{
			$fuser = DB::table('tb_users')->join('tb_container', 'tb_users.id', '=', 'tb_container.user_id')->where('tb_container.id', $id)->first();
			$usrname = $fuser->username;
		}
		$publicpath = public_path();
		$fpath = '';
		$folds = array_reverse($this->fetchFolderParentList($id));
		if(!empty($folds))
		{
			foreach($folds as $fold)
			{
				$fpath .= $fold.'/';
			}
		}
		$actPath = $publicpath.'/uploads/container_user/'.$usrname.'/'.$fpath;
		return $actPath;
	}
	
	public function Editfiles( $fid = 0, $id = 0)
	{
		$uid = \Auth::user()->id;
		if($this->access['is_detail'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', Lang::get('core.note_restric'))->with('msgstatus','error');
					
		
		$file_temp = DB::table('tb_container_files')->join('tb_container', 'tb_container.id', '=', 'tb_container_files.folder_id')->join('tb_users', 'tb_users.id', '=', 'tb_container_files.user_id')->select('tb_users.first_name', 'tb_users.last_name', 'tb_container_files.*', 'tb_container.name as folderName')->where('tb_container_files.id', $id);
		
		$file = $file_temp->first();
		
		$spaceAllowed = \Auth::user()->storage_space;
		$usedSpaceBytes_temp = DB::table('tb_container_files');
		if(\Auth::user()->group_id==2)
		{
			$usedSpaceBytes_temp->where('user_id',$uid);
		}
		$usedSpaceBytes = $usedSpaceBytes_temp->sum('file_size');
		if(\Auth::user()->group_id!=3)
		{
			$usedSpaceMb = ($usedSpaceBytes/(1000*1000));
			$usedSpace = round($usedSpaceMb,2,PHP_ROUND_HALF_UP);
			$usedSpacePercentage = ($usedSpace*100)/$spaceAllowed;
			$this->data['allowStorage'] = $spaceAllowed;
			$this->data['usedStorage'] = $usedSpace;
			$this->data['usedStoragePerct'] = round($usedSpacePercentage,2,PHP_ROUND_HALF_UP);
		}
		$this->data['tree'] = $this->fetchFolderTreeList();
		$this->data['access'] = $this->access;
		$this->data['prevfolder'] = $fid;
		$this->data['group'] = \Auth::user()->group_id;
		$this->data['rowFile'] = $file;
		$imgsrc = $this->getThumbpath($file->folder_id);
		$this->data['rowFile']->imgsrc = $imgsrc;
		if(\Auth::user()->group_id==3)
		{
			$this->data['userpermissions'] = DB::table('tb_permissions')->where('user_id',$uid)->where('folder_id',$fid)->first();
		}
		$this->data['findPin'] = DB::table('tb_imapper_pins')->where('file_id',$id)->get();
		return view('imapper.edit',$this->data);	
	}
	
	function savePinData(Request $request)
	{
		$data['file_id'] = Input::get('file_id');
		$data['user_id'] = \Auth::user()->id;
		$data['cor_top'] = Input::get('cor_top');
		$data['cor_left'] = Input::get('cor_left');
		$data['pin_data'] = Input::get('pindata');
		$data['title'] = Input::get('title');
		//$findPin = DB::table('tb_imapper_pins')->where('file_id',Input::get('file_id'))->first();
		if(Input::get('editpin')!="")
		{
			$data['updated'] = date('y-m-d h:i:s');
			DB::table('tb_imapper_pins')->where('id', $findPin->id)->update($data);
		}
		else
		{
			$data['created'] = date('y-m-d h:i:s');
			DB::table('tb_imapper_pins')->insert($data);
		}
		
		return Redirect::to(Input::get('curnurl'))->with('messagetext','pin are updated')->with('msgstatus','success');
	}


}