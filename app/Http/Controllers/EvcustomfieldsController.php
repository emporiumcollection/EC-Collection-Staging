<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Evcustomfields;
use App\Models\ModelsModcustomfieldgroup;
use App\Models\ModelsModcustomfieldvalue;
use App\Models\ModelsModcustomfield;
use App\Models\Sximo\Module;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 


class EvcustomfieldsController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'evcustomfields';
	static $per_page	= '10';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Evcustomfields();
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'evcustomfields',
			'return'	=> self::returnUrl(),
			'icon_class'=>'',
			'color_class'=>''
			
		);
		
	}

	

public function index(Request $request){ 
        //For list-clients permission 
        //$this->data['access'] =  $this->models->validAccess(Auth::id());
       // if(!isset($this->data['access']['list-clients']) && !isset($this->data['access']['all'])){return redirect('accessDenied');}
        $this->data['module_list'] = Module::select('module_id','module_title')->get();
        $this->data['module_selected'] = $this->data['module_list'][0]->module_id;
        return view('evcustomfields.index', $this->data);

    }
    public function edit($id){
         //For list-clients permission 
        $this->data['access'] =  $this->models->validAccess(Auth::id());
       // if(!isset($this->data['access']['list-clients']) && !isset($this->data['access']['all'])){return redirect('accessDenied');}
        $this->data['module_list'] = Module::select('module_id','module_title')->get();
        $this->data['module_selected'] = $id;
        return view('evcustomfields.index', $this->data);
    }
    
    //For create new group for custom fields
    public function createGroupAjax(Request $request){ 
        
        $rules = array('group_name' => 'required','module_id' => 'required');
        $messages = [
            'group_name.required' => trans('ev_custom_fields.admin_customfield_module_error_group'),
            'module_id.required' => trans('ev_custom_fields.admin_customfield_module_error_module_id')
            ];

        $validator = Validator::make($request->all(), $rules, $messages);

        // Validate the input and return correct response
        if ($validator->fails())
        {
            return response()->json(array(
                'error'=>true,
                'success' => false,
                'error_messages' => $validator->getMessageBag()

            )); // 400 being the HTTP code for an invalid request.
        }

        $group = new ModelsModcustomfieldgroup;
        $group->title_mfg = $request->input('group_name');
        $group->slug_mfg = str_slug($request->input('group_name'));
        $group->idmod_mfg = $request->input('module_id');
        $group->save();
          
        return response()->json(array('error'=>'true','success'=>'true','error_messages'=>''));

    }

     //For get groups for custom fields
    public function getGroupsAjax(Request $request,$id){ 
        $group = ModelsModcustomfieldgroup::select('id_modcustomfieldgroup','idmod_mfg','slug_mfg','title_mfg')->where('idmod_mfg','=',$id)->orderBy('orderby_mfg','asc')->get();
        $this->data['group_list'] = $group;
        return response()->json($this->data['group_list']);
    }

     //For get a custom  fields
    public function getCustomFieldsAjax(Request $request){ 
       
            $group = ModelsModcustomfieldgroup::select('id_modcustomfieldgroup')->where('slug_mfg','=',$request->input('gp'))->first();
          if(!empty($group)){
            $field = ModelsModcustomfield::select('title_mcf','id_modcustomfield')->where('idmfg_mcf','=',$group->id_modcustomfieldgroup)->orderBy('orderby_mcf','asc')->get();
          }else{
            $field = array();
          }
        $this->data['field_list']=$field;
        return response()->json($this->data['field_list']);
    }


    //For create new group for custom fields
    public function createFieldAjax(Request $request){ 
        $params = json_encode($request->input());

        $rules = array('group_slug' => 'required','module_id' => 'required','type' => 'required','title' => 'required');
        $messages = [
            'group_slug.required' => trans('ev_custom_fields.admin_customfield_module_error_group'),
            'module_id.required' => trans('ev_custom_fields.admin_customfield_module_error_module_id'),
            'type.required' => trans('ev_custom_fields.admin_customfield_module_error_group'),
            'title.required' => trans('ev_custom_fields.admin_customfield_module_error_module_id')
            ];

        $validator = Validator::make($request->input(), $rules, $messages);

        // Validate the input and return correct response
        if ($validator->fails())
        {
            return response()->json(array(
                'error'=>true,
                'success' => false,
                'error_messages' => $validator->getMessageBag()

            )); // 400 being the HTTP code for an invalid request.
        }

        $group =  ModelsModcustomfieldgroup::select('id_modcustomfieldgroup')->where('slug_mfg','=',$request->input('group_slug'))->first();
        $field = new ModelsModcustomfield;
        $field->title_mcf = $request->input('title');
        $field->slug_mcf = str_slug($request->input('title'));
        $field->idmfg_mcf = $group->id_modcustomfieldgroup;
        $field->option_mcf = $params;
        $field->save();
          
        return response()->json(array('error'=>'true','success'=>'true','error_messages'=>''));

    }
    //For remove group and group's custom fields
    public function removeGroupAjax(Request $request){
        $group =  ModelsModcustomfieldgroup::where('slug_mfg','=',$request->input('group'))->first();
        ModelsModcustomfield::where('idmfg_mcf','=',$group->id_modcustomfieldgroup)->delete();
        ModelsModcustomfieldgroup::destroy($group->id_modcustomfieldgroup);
        return response()->json(array('error'=>'true','success'=>'true','error_messages'=>''));
    }
    //For remove custom fields
    public function removeCustomFieldAjax($id){
        ModelsModcustomfield::destroy($id);
        return response()->json(array('error'=>'true','success'=>'true','error_messages'=>''));
    }
    //For edit custom field by ajax
    public function editCustomFieldAjax($id){
        $this->data['field'] = ModelsModcustomfield::find($id);
        return response()->json($this->data['field']);
    }

    //For edit custom field by ajax
    public function updateCustomFieldAjax(Request $request, $id){
        $params = json_encode($request->input());

        $rules = array('group_slug' => 'required','module_id' => 'required','type' => 'required','title' => 'required');
        $messages = [
            'group_slug.required' => trans('ev_custom_fields.admin_customfield_module_error_group'),
            'module_id.required' => trans('ev_custom_fields.admin_customfield_module_error_module_id'),
            'type.required' => trans('ev_custom_fields.admin_customfield_module_error_group'),
            'title.required' => trans('ev_custom_fields.admin_customfield_module_error_module_id')
            ];

        $validator = Validator::make($request->input(), $rules, $messages);

        // Validate the input and return correct response
        if ($validator->fails())
        {
            return response()->json(array(
                'error'=>true,
                'success' => false,
                'error_messages' => $validator->getMessageBag()

            )); // 400 being the HTTP code for an invalid request.
        }

        $field = ModelsModcustomfield::find($id);
        $field->title_mcf = $request->input('title');
        $field->slug_mcf = str_slug($request->input('title'));
        $field->option_mcf = $params;
        $field->save();
          
        return response()->json(array('error'=>'true','success'=>'true','error_messages'=>''));
    }
    //For update Order of Custom Field
    public function updateCustomFieldOrderAjax(Request $request){
        $orderByIds = explode(',',$request->input('order_by'));
        if(isset($orderByIds) && !empty($orderByIds)){
            foreach ($orderByIds as $keyCF => $valueCF) {
                $field = ModelsModcustomfield::find($valueCF);
                $field->orderby_mcf = $keyCF;
                $field->save();
            }
             return response()->json(array('error'=>'true','success'=>'true','error_messages'=>''));
        }
    }

    //For update Order of Custom Field's Group
    public function updateGroupOrderAjax(Request $request){
        $orderByIds = explode(',',$request->input('order_by'));
        if(isset($orderByIds) && !empty($orderByIds)){
            foreach ($orderByIds as $keyCF => $valueCF) {
                $group = ModelsModcustomfieldgroup::find($valueCF);
                $group->orderby_mfg = $keyCF;
                $group->save();
            }
             return response()->json(array('error'=>'true','success'=>'true','error_messages'=>''));
        }
    }			


}