<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Seasons;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 


class SeasonsController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'seasons';
	static $per_page	= '10';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Seasons();
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'seasons',
			'return'	=> self::returnUrl()
			
		);
		
	}

	public function getIndex( Request $request )
	{

		if($this->access['is_view'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');

		$seasonArr = array();
		$checkseason = \DB::table('tb_seasons')->where('property_id', 0)->get();
		if(!empty($checkseason))
		{
			$s = 0;
			foreach($checkseason as $season)
			{
				$seasonArr[$s] = $season;
				$checkseasondates = \DB::table('tb_seasons_dates')->where('season_id',$season->id)->get();
				if(!empty($checkseasondates))
				{
					$seasonArr[$s]->dates = $checkseasondates;
				}
				$s++;
			} 
		}
		$this->data['Seasons'] = $seasonArr;
		return view('seasons.index',$this->data);
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
		return view('seasons.form',$this->data);
	}	

	public function getShow( $id = null)
	{
	
		if($this->access['is_detail'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
					
		
		$this->data['access']		= $this->access;
		return view('seasons.view',$this->data);	
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


	function add_season_details( Request $request)
	{
		$uid = \Auth::user()->id;
		$rules['season_name'] = 'required';
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data['season_name'] = $request->input('season_name');
			$data['season_priority'] = $request->input('season_priority');
			$data['user_id'] = $uid;
			if(!is_null($request->input('property_id')))
			{
				$data['property_id'] = $request->input('property_id');
			}
			if($request->input('edit_season_id')=='')
			{
				$data['created'] = date('Y-m-d h:i:s');
				$instype = 'add';
				$id = \DB::table('tb_seasons')->insertGetId($data);
			}
			else
			{
				$data['updated'] = date('Y-m-d h:i:s');
				$instype = 'update';
				$id = \DB::table('tb_seasons')->where('id', $request->input('edit_season_id'))->update($data);
			}
			
			$seasondata = array();
			$checkSeason = \DB::table('tb_seasons')->where('id', $id)->first();
			if(!empty($checkSeason))
			{
				$seasondata = $checkSeason;
			}
			
			$res['status'] = 'success';
			$res['season'] = $seasondata;
			$res['type'] = $instype;
			return json_encode($res);
			
		} else {
			$res['status'] = 'error';
			$res['errors'] = $validator->errors()->all();
			return json_encode($res);
		}	
	
	}
		
	function delete_season_data( Request $request)
	{
		$uid = \Auth::user()->id;
		$season_Id = $request->input('season_Id');
		$checkseason = \DB::table('tb_seasons')->where('id', $season_Id)->count();
		if($checkseason>0)
		{
			$ups = \DB::table('tb_seasons')->where('id', $season_Id)->delete();
			
			$checkseasondates = \DB::table('tb_seasons_dates')->where('season_id', $season_Id)->count();
			if($checkseasondates>0)
			{
				$ups = \DB::table('tb_seasons_dates')->where('season_id', $season_Id)->delete();
			}
			$res['status'] = 'success';
			return json_encode($res);
		}
		else
		{
			$res['status'] = 'error';
			return json_encode($res);
		}
	}
	
	function add_season_dates_details( Request $request)
	{
		$uid = \Auth::user()->id;
		$rules['season_from_date'] = 'required';
		$rules['season_to_date'] = 'required';
		if($request->input('edit_season_dates_id')=='')
		{
			$rules['seasons'] = 'required';
		}
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data['season_from_date'] = $request->input('season_from_date');
			$data['season_to_date'] = $request->input('season_to_date');
			$data['user_id'] = $uid;
			if($request->input('edit_season_dates_id')=='')
			{
				$data['season_id'] = $request->input('seasons');
				$data['created'] = date('Y-m-d h:i:s');
				$instype = 'add';
				$id = \DB::table('tb_seasons_dates')->insertGetId($data);
			}
			else
			{
				$data['updated'] = date('Y-m-d h:i:s');
				$instype = 'update';
				$id = \DB::table('tb_seasons_dates')->where('id', $request->input('edit_season_dates_id'))->update($data);
			}
			
			$seasonDatesdata = array();
			$checkSeasonDates = \DB::table('tb_seasons_dates')->where('id', $id)->first();
			if(!empty($checkSeasonDates))
			{
				$seasonDatesdata = $checkSeasonDates;
			}
			
			$res['status'] = 'success';
			$res['seasonDates'] = $seasonDatesdata;
			$res['type'] = $instype;
			return json_encode($res);
			
		} else {
			$res['status'] = 'error';
			$res['errors'] = $validator->errors()->all();
			return json_encode($res);
		}	
	
	}
	
	function delete_season_dates_data( Request $request)
	{
		$uid = \Auth::user()->id;
		$date_Id = $request->input('date_Id');
		$checkseasondate = \DB::table('tb_seasons_dates')->where('id', $date_Id)->count();
		if($checkseasondate>0)
		{
			$ups = \DB::table('tb_seasons_dates')->where('id', $date_Id)->delete();
			
			$res['status'] = 'success';
			return json_encode($res);
		}
		else
		{
			$res['status'] = 'error';
			return json_encode($res);
		}
	}

    /** ----- **/
    
    function add_event_season_details( Request $request)
	{
		$uid = \Auth::user()->id;
		$rules['season_name'] = 'required';
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data['season_name'] = $request->input('season_name');
			$data['season_priority'] = $request->input('season_priority');
			$data['user_id'] = $uid;
			if(!is_null($request->input('property_id')))
			{
				$data['event_id'] = $request->input('property_id');
			}
			if($request->input('edit_season_id')=='')
			{
				$data['created'] = date('Y-m-d h:i:s');
				$instype = 'add';
				$id = \DB::table('tb_event_seasons')->insertGetId($data);
			}
			else
			{
				$data['updated'] = date('Y-m-d h:i:s');
				$instype = 'update';
				$id = \DB::table('tb_event_seasons')->where('id', $request->input('edit_season_id'))->update($data);
			}
			
			$seasondata = array();
			$checkSeason = \DB::table('tb_event_seasons')->where('id', $id)->first();
			if(!empty($checkSeason))
			{
				$seasondata = $checkSeason;
			}
			
			$res['status'] = 'success';
			$res['season'] = $seasondata;
			$res['type'] = $instype;
			return json_encode($res);
			
		} else {
			$res['status'] = 'error';
			$res['errors'] = $validator->errors()->all();
			return json_encode($res);
		}	
	
	}
		
	function delete_event_season_data( Request $request)
	{
		$uid = \Auth::user()->id;
		$season_Id = $request->input('season_Id');
		$checkseason = \DB::table('tb_event_seasons')->where('id', $season_Id)->count();
		if($checkseason>0)
		{
			$ups = \DB::table('tb_event_seasons')->where('id', $season_Id)->delete();
			
			$checkseasondates = \DB::table('tb_seasons_event_dates')->where('season_id', $season_Id)->count();
			if($checkseasondates>0)
			{
				$ups = \DB::table('tb_seasons_event_dates')->where('season_id', $season_Id)->delete();
			}
			$res['status'] = 'success';
			return json_encode($res);
		}
		else
		{
			$res['status'] = 'error';
			return json_encode($res);
		}
	}
	
	function add_event_season_dates_details( Request $request)
	{
		$uid = \Auth::user()->id;
		$rules['season_from_date'] = 'required';
		$rules['season_to_date'] = 'required';
		if($request->input('edit_season_dates_id')=='')
		{
			$rules['seasons'] = 'required';
		}
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data['season_from_date'] = $request->input('season_from_date');
			$data['season_to_date'] = $request->input('season_to_date');
			$data['user_id'] = $uid;
			if($request->input('edit_season_dates_id')=='')
			{
				$data['season_id'] = $request->input('seasons');
				$data['created'] = date('Y-m-d h:i:s');
				$instype = 'add';
				$id = \DB::table('tb_seasons_event_dates')->insertGetId($data);
			}
			else
			{
				$data['updated'] = date('Y-m-d h:i:s');
				$instype = 'update';
				$id = \DB::table('tb_seasons_event_dates')->where('id', $request->input('edit_season_dates_id'))->update($data);
			}
			
			$seasonDatesdata = array();
			$checkSeasonDates = \DB::table('tb_seasons_event_dates')->where('id', $id)->first();
			if(!empty($checkSeasonDates))
			{
				$seasonDatesdata = $checkSeasonDates;
			}
			
			$res['status'] = 'success';
			$res['seasonDates'] = $seasonDatesdata;
			$res['type'] = $instype;
			return json_encode($res);
			
		} else {
			$res['status'] = 'error';
			$res['errors'] = $validator->errors()->all();
			return json_encode($res);
		}	
	
	}
	
	function delete_event_season_dates_data( Request $request)
	{
		$uid = \Auth::user()->id;
		$date_Id = $request->input('date_Id');
		$checkseasondate = \DB::table('tb_seasons_event_dates')->where('id', $date_Id)->count();
		if($checkseasondate>0)
		{
			$ups = \DB::table('tb_seasons_event_dates')->where('id', $date_Id)->delete();
			
			$res['status'] = 'success';
			return json_encode($res);
		}
		else
		{
			$res['status'] = 'error';
			return json_encode($res);
		}
	}
    
    function get_event_seasons(Request $request){
        $id = $request->input('pid');
        $seasons = \DB::table('tb_event_seasons')->where('event_id', $id)->get();
        echo json_encode($seasons);    
    }

}