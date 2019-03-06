<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\ContainerController;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Http\Controllers\Controller;
use App\User;
use DB,Validator, Input, Redirect, CustomQuery, Image;
class PropertyController extends Controller {
    
    var $pckages_id = array();
    var $pckages_ids = array();
    public function __construct() {
        parent::__construct();
        /*if(!isset(\Auth::user()->id)){
            Redirect::to('/')->send();
        }*/
        
        $package_cond = (array) $this->getPackagesIdsAccordingMembership();
        $this->pckages_ids = ((count($package_cond) > 0)?implode(',',$package_cond):'0');
    }
    
    /* Method : getPropertyDetail
     *   Description : The Methos is using for property detai page (PDP)
    */
	
	public function getPropertyGridListByCategory(Request $request)
	{
	   	   
		$this->data['slug'] = $request->slug;
		$this->data['dateslug'] = '';

        $this->data['slider'] = \DB::table('tb_sliders')->select('slider_category','slider_title','slider_description','slider_img','slider_link','slide_type')->where('slider_category', $request->slug)->where('slider_status',1)->orderBy('sort_num','asc')->get();

          $this->data['destination_category'] =0;
        $perPage = 42;
        $pageNumber = 1;
        if(isset($request->page) && $request->page>0){
            $pageNumber = $request->page;
        }
        $pageStart = ($pageNumber -1) * $perPage;

        $query = "SELECT pr.editor_choice_property,pr.property_usp,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,"; 
        $query .= " (SELECT rack_rate FROM tb_properties_category_rooms_price pcrp where pr.id=pcrp.property_id order by rack_rate DESC limit 0,1 ) as price ," ;
        $query .= " (SELECT category_name FROM tb_categories ct where pr.property_category_id=ct.id limit 0,1 ) as category_name ";
        $query .= " FROM tb_properties  pr";
        $query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
        $whereClause = " WHERE pr.property_type='" . $request->slug . "' AND pr.property_status = '1' AND pr.feature_property = 0 AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ";
        $OrderByQry =  "ORDER BY (SELECT rack_rate FROM tb_properties_category_rooms_price pcrp WHERE pcrp.property_id = pr.id ORDER BY rack_rate DESC LIMIT 1) * 1 DESC, pr.editor_choice_property desc LIMIT $pageStart, $perPage ";
        $fianlQry = $query.' '.$whereClause.' '.$OrderByQry;
        $CountRecordQry = " Select count(*) as total_record FROM tb_properties pr JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ".$whereClause;

        //featured Data
         $query = "SELECT pr.editor_choice_property,pr.property_usp,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,"; 
        $query .= " (SELECT rack_rate FROM tb_properties_category_rooms_price pcrp where pr.id=pcrp.property_id order by rack_rate DESC limit 0,1 ) as price ," ;
        $query .= " (SELECT category_name FROM tb_categories ct where pr.property_category_id=ct.id limit 0,1 ) as category_name ";
        $query .= " FROM tb_properties  pr";
        $query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
        $whereClause = " WHERE pr.property_type='" . $request->slug . "' AND pr.property_status = '1' AND pr.feature_property = 1 AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ";
        $OrderByQry =  " order by RAND() LIMIT 4 ";
        $featureQuery = $query.' '.$whereClause.' '.$OrderByQry;
        
        //Editor choice editor_choice_property
         $query = "SELECT pr.editor_choice_property,pr.property_usp,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,"; 
        $query .= " (SELECT rack_rate FROM tb_properties_category_rooms_price pcrp where pr.id=pcrp.property_id order by rack_rate DESC limit 0,1 ) as price ," ;
        $query .= " (SELECT category_name FROM tb_categories ct where pr.property_category_id=ct.id limit 0,1 ) as category_name ";
        $query .= " FROM tb_properties  pr";
        $query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
        $whereClause = " WHERE pr.property_type='" . $request->slug . "' AND pr.property_status = '1' AND pr.editor_choice_property = 1 AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ";
        $OrderByQry =  " order by RAND() LIMIT 4 ";

        
		$editorQuery = $query.' '.$whereClause.' '.$OrderByQry; 


        $editorData = DB::select($editorQuery);
        $this->data['editorPropertiesArr']=$editorData;

        $getRec = DB::select($CountRecordQry);
        $propertiesArr = DB::select($fianlQry);
        $featureData = DB::select($featureQuery);


		$this->data['featurePropertiesArr']=$featureData;
        $this->data['propertiesArr'] = $propertiesArr;
        $this->data['total_record'] = $getRec[0]->total_record;
        $this->data['total_pages'] = (isset($getRec[0]->total_record) && $getRec[0]->total_record>0)?(int)ceil($getRec[0]->total_record / $perPage):0;
        $this->data['active_page']=$pageNumber;	
		return view('frontend.themes.emporium.properties.list', $this->data);
	}
	
    function propertySearch_new(Request $request) {

		$selCurrency=$request->input("currencyOption");
        \Session::put('currencyOption', $selCurrency);
		
		$this->data["convertedOneUnitPrice"]=0;
        $keyword = trim($request->cat);
        $show = 'asc';
        if($request->segment(1)=='search'){
           $keyword = $request->s;
        }

		$sldkeyword = str_replace('-',' ',$keyword);
        
		$this->data['slider'] = \DB::table('tb_sliders')->where('slider_category', $sldkeyword)->where('slider_status',1)->orderBy('sort_num','asc')->get();
		

		$this->data['dateslug'] = '';
		$arrive = $departure = $adult = $childs = '';
        $arrive_new = $departure_new = '';
		if (!is_null($request->arrive) && $request->arrive != '') {
			\Session::put('arrive_date', $request->arrive);
			$this->data['arrive_date'] = $request->arrive;
			$this->data['dateslug'] = $request->arrive;
			$arrive = date("Y-m-d", strtotime(trim($request->arrive)));
            $arrive_new = \CommonHelper::dateformat(trim($request->arrive));
		}
		if (!is_null($request->departure) && $request->departure != '') {
			\Session::put('departure_date', $request->departure);
			$this->data['departure_date'] = $request->departure;
			$this->data['dateslug'] = $this->data['dateslug'].' to '.$request->departure;
			$departure = date("Y-m-d", strtotime(trim($request->departure)));
            $departure_new = \CommonHelper::dateformat(trim($request->departure));
		}
        
		$catprops = '';   

		   
		//$cateObj = \DB::table('tb_categories')->where('category_alias', $keyword)->where('category_published', 1)->first();
        $cateObj = \DB::table('tb_categories')->where('category_name', $sldkeyword)->where('category_published', 1)->first();

        $chldIds = array();
        $getcatsID = array();
        if (!empty($cateObj)) {
            $channel_url = $cateObj->category_youtube_channel_url;
            $this->data['channel_url'] = $channel_url;
            
            //get all children start
            $chldIds = $this->fetchcategoryChildListIds($cateObj->id);
            //End
            if(count($chldIds) <= 0){ $chldIds[] = $cateObj->id; }
            
            if (count($chldIds) > 0) {
                $impload_ids = implode(',',$chldIds);
                $catcond = " AND (pr.category_id IN(".$impload_ids."))";
                /*$catcond = " AND (" . implode(" || ", array_map(function($v) {
									return sprintf("FIND_IN_SET('%s', pr.property_category_id)", $v);
								}, array_values($chldIds))) . ")";*/
                
                $ch_queries = "SELECT pr.id FROM property_categories_split_in_rows pr WHERE pr.property_status='1' ".$catcond." GROUP BY pr.id";
                if(strlen(trim($arrive_new)) > 0){
                    $ch_queries = "";
                    $getdestind = "";
                    if (strlen(trim($departure_new)) > 0) { $getdestind = " AND pctr.room_active_to <= '".$departure_new."'"; }
                    $ch_queries = "SELECT pr.id FROM property_categories_split_in_rows pr, tb_properties_category_rooms pctr WHERE pctr.property_id = pr.id AND  pr.property_status='1' AND pctr.room_active_from <= '".$arrive_new."' ".$getdestind."  ".$catcond." GROUP BY pr.id";
                }
                
                $ch_queries = trim($ch_queries);
                if(strlen($ch_queries) > 0){
                    $childresult = DB::select($ch_queries);
                    
                    foreach($childresult as $siChild){
                        $getcatsID[] = $siChild->id;
                    }
                }
            }
        }
        
        if(count($getcatsID) > 0){
            $timplod = implode(',',$getcatsID);
            $catprops = " OR pr.id in(".$timplod.") ";
        }
		
		$perPage = 20;
		$pageNumber = 1;
		if(isset($request->page) && $request->page>0){
			$pageNumber = $request->page;
		}
		$pageStart = ($pageNumber -1) * $perPage;

		/*$query = "SELECT pr.editor_choice_property,pr.property_usp,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,pcrp.rack_rate as price ";
		$query .= " FROM tb_properties pr LEFT JOIN tb_properties_category_rooms_price pcrp ON pr.id = pcrp.property_id ";
        $query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
		$whereClause =" WHERE ((pr.property_name LIKE '%".$keyword."%' AND pr.property_type = 'Hotel') OR city LIKE '%".$keyword."%' ".$catprops." ) AND pr.property_status = 1 AND  pr.feature_property = 0 AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ";
		$orderBy = "ORDER BY price DESC, editor_choice_property DESC  ";
		$limit = " LIMIT ". $pageStart.",".$perPage; 
        $finalQry = "SELECT * FROM (".$query.$whereClause." ORDER BY price DESC) tempX GROUP BY id ".$orderBy.$limit ;*/ 
		//$CountRecordQry = "Select count(*) as total_record from tb_properties pr  JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ".$whereClause ;
		
        //print_r($finalQry); die;
        $query = "Select pr.editor_choice_property,pr.property_usp,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,0 as price  ";
        $query .= " FROM tb_properties_category_rooms pcr INNER JOIN tb_properties pr ON pr.id = pcr.property_id ";
        $query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
        $whereClause =" WHERE ((pr.property_name LIKE '%".$keyword."%' AND pr.property_type = 'Hotel') OR city LIKE '%".$keyword."%' ".$catprops." ) AND pr.property_status = 1 AND  pr.feature_property = 0 AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ";
        if($arrive_new != '' && $departure_new != ''){
            $whereClause .= " and pcr.room_active_from <='".$arrive_new."' and pcr.room_active_to >='".$departure_new."'";
            $whereClause .= "  and pcr.id not IN (select td_reserved_rooms.room_id from tb_reservations INNER join td_reserved_rooms on td_reserved_rooms.reservation_id=tb_reservations.id where '".$arrive_new."' BETWEEN checkin_date and checkout_date or '".$departure_new."' BETWEEN checkin_date and checkout_date)";
        }
        
        $orderBy = "ORDER BY price DESC, editor_choice_property DESC  ";
        $limit = " LIMIT ". $pageStart.",".$perPage; 
        $finalQry = "SELECT * FROM (".$query.$whereClause." ORDER BY price DESC) tempX GROUP BY id ".$orderBy.$limit ;
        
        $CountRecordQry = "Select count(*) as total_record from tb_properties_category_rooms pcr INNER JOIN tb_properties pr ON pr.id = pcr.property_id JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ".$whereClause ;
        //print_r($finalQry); die;	
			//Feature Query
		$query = "SELECT pr.editor_choice_property,pr.property_usp,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,0 as price ";
		$query .= " FROM tb_properties_category_rooms pcr INNER JOIN tb_properties pr ON pr.id = pcr.property_id ";
        $query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
		$whereClause =" WHERE ((pr.property_name LIKE '%".$keyword."%' AND pr.property_type = 'Hotel') OR city LIKE '%".$keyword."%' ".$catprops." ) AND pr.property_status = 1 AND  pr.feature_property = 1 AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ";
        if($arrive_new != '' && $departure_new != ''){
            $whereClause .= " and pcr.room_active_from <='".$arrive_new."' and pcr.room_active_to >='".$departure_new."'";
            $whereClause .= "  and pcr.id not IN (select td_reserved_rooms.room_id from tb_reservations INNER join td_reserved_rooms on td_reserved_rooms.reservation_id=tb_reservations.id where '".$arrive_new."' BETWEEN checkin_date and checkout_date or '".$departure_new."' BETWEEN checkin_date and checkout_date)";
        }
		$orderBy = "ORDER BY RAND()  ";
		$limit = " LIMIT 4";
		$featureQuery = "SELECT * FROM (".$query.$whereClause." ORDER BY price DESC) tempX GROUP BY id ".$orderBy.$limit ; 
		
		  //Editor choice editor_choice_property
        $query = "SELECT pr.editor_choice_property,pr.property_usp,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,0 as price ";
		$query .= " FROM tb_properties_category_rooms pcr INNER JOIN tb_properties pr ON pr.id = pcr.property_id ";
        $query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
		$whereClause =" WHERE ((pr.property_name LIKE '%".$keyword."%' AND pr.property_type = 'Hotel') OR city LIKE '%".$keyword."%' ".$catprops." ) AND pr.property_status = 1 AND  pr.editor_choice_property = 1 AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ";
        if($arrive_new != '' && $departure_new != ''){
            $whereClause .= " and pcr.room_active_from <='".$arrive_new."' and pcr.room_active_to >='".$departure_new."'";
            $whereClause .= "  and pcr.id not IN (select td_reserved_rooms.room_id from tb_reservations INNER join td_reserved_rooms on td_reserved_rooms.reservation_id=tb_reservations.id where '".$arrive_new."' BETWEEN checkin_date and checkout_date or '".$departure_new."' BETWEEN checkin_date and checkout_date)";
        }        
		$orderBy = "ORDER BY RAND()  ";
		$limit = " LIMIT 4";
		$editorQuery = "SELECT * FROM (".$query.$whereClause." ORDER BY price DESC) tempX GROUP BY id ".$orderBy.$limit ; 
        
        $editorData = DB::select($editorQuery);
		//dd($editorData);
        $this->data['editorPropertiesArr']=$editorData;
//echo $finalQry; die;
		$property = DB::select($finalQry);
		$getRec = DB::select($CountRecordQry);
		$featureData = DB::select($featureQuery);
		
		$this->data['featurePropertiesArr']=$featureData;
		$this->data['propertiesArr'] = $property;
		$this->data['total_record'] = $getRec[0]->total_record;
		$this->data['total_pages'] = (isset($getRec[0]->total_record) && $getRec[0]->total_record>0)?(int)ceil($getRec[0]->total_record / $perPage):0;
		$this->data['active_page']=$pageNumber;

		$uid = isset(\Auth::user()->id) ? \Auth::user()->id : '';

		//get emotional gallery
        $emotional_gallery_array = array();
        $emtional_parentFolder = \DB::table('tb_container')->select('id')->where('name','emotion-gallery')->first();
        if(isset($emtional_parentFolder->id)){
            $peid = (int) $emtional_parentFolder->id;
            $emtional_containerfiles = \DB::table('tb_container')->select('tb_container_files.id','tb_container_files.file_name','tb_container_files.folder_id','tb_container.name')->join('tb_container_files','tb_container_files.folder_id','=','tb_container.id')->where('parent_id',$peid)->where('name',$keyword)->orderby('tb_container_files.file_sort_num','asc')->get();
            if((!empty($emtional_containerfiles)) && (is_array($emtional_containerfiles))){$emotional_gallery_array = $emtional_containerfiles;}
        }
        $this->data['emotional_gallery'] = $emotional_gallery_array;
        //End 
		$tags_Arr = \DB::table('tb_tags_manager')->where('tag_status', 1)->get();
		$tagsArr = array();
		if (!empty($tags_Arr)) {
			foreach ($tags_Arr as $tags) {
				$tagsArr[$tags->parent_tag_id][] = $tags;
			}
		}
		
		$this->data['slug'] = $keyword;

		$this->data['action']=request()->segments(1);
        $this->data['destination_category'] =0;

		if(request()->segment(1)=='luxury_destinations' || request()->segment(1)=='luxury_experience'){
            $this->data['destination_category']=$cateObj->id;
			$this->data['destination_category_instagram']=$cateObj->category_instagram_channel;
        }

		return view('frontend.themes.emporium.properties.list', $this->data);
                    
    }
    
	function propertySearch(Request $request) {

		$selCurrency=$request->input("currencyOption");
        \Session::put('currencyOption', $selCurrency);
		
		$this->data["convertedOneUnitPrice"]=0;
        $keyword = trim($request->cat);
        $show = 'asc';
        if($request->segment(1)=='search'){
           $keyword = $request->s;
        }

		$sldkeyword = str_replace('-',' ',$keyword);
		$this->data['slider'] = \DB::table('tb_sliders')->where('slider_category', $sldkeyword)->where('slider_status',1)->orderBy('sort_num','asc')->get();
		

		$this->data['dateslug'] = '';
		$arrive = $departure = $adult = $childs = '';
		if (!is_null($request->arrive) && $request->arrive != '') {
			\Session::put('arrive_date', $request->arrive);
			$this->data['arrive_date'] = $request->arrive;
			$this->data['dateslug'] = $request->arrive;
			$arrive = date("Y-m-d", strtotime(trim($request->arrive)));
		}
		if (!is_null($request->departure) && $request->departure != '') {
			\Session::put('departure_date', $request->departure);
			$this->data['departure_date'] = $request->departure;
			$this->data['dateslug'] = $this->data['dateslug'].' to '.$request->departure;
			$departure = date("Y-m-d", strtotime(trim($request->departure)));
		}


		$catprops = '';   

		   
		$cateObj = \DB::table('tb_categories')->where('category_alias', $keyword)->where('category_published', 1)->first();

        $chldIds = array();
        $getcatsID = array();
        if (!empty($cateObj)) {
            $channel_url = $cateObj->category_youtube_channel_url;
            $this->data['channel_url'] = $channel_url;
            
            //get all children start
            $chldIds = $this->fetchcategoryChildListIds($cateObj->id);
            //End
            if(count($chldIds) <= 0){ $chldIds[] = $cateObj->id; }
            
            if (count($chldIds) > 0) {
                $impload_ids = implode(',',$chldIds);
                $catcond = " AND (pr.category_id IN(".$impload_ids."))";
                /*$catcond = " AND (" . implode(" || ", array_map(function($v) {
									return sprintf("FIND_IN_SET('%s', pr.property_category_id)", $v);
								}, array_values($chldIds))) . ")";*/
                
                $ch_queries = "SELECT pr.id FROM property_categories_split_in_rows pr WHERE pr.property_status='1' ".$catcond." GROUP BY pr.id";
                if(strlen(trim($arrive)) > 0){
                    $ch_queries = "";
                    $getdestind = "";
                    if (strlen(trim($departure)) > 0) { $getdestind = " AND pctr.room_active_to <= '".$departure."'"; }
                    $ch_queries = "SELECT pr.id FROM property_categories_split_in_rows pr, tb_properties_category_rooms pctr WHERE pctr.property_id = pr.id AND  pr.property_status='1' AND pctr.room_active_from <= '".$arrive."' ".$getdestind."  ".$catcond." GROUP BY pr.id";
                }
                
                $ch_queries = trim($ch_queries);
                if(strlen($ch_queries) > 0){
                    $childresult = DB::select($ch_queries);
                    
                    foreach($childresult as $siChild){
                        $getcatsID[] = $siChild->id;
                    }
                }
            }
        }
        
        if(count($getcatsID) > 0){
            $timplod = implode(',',$getcatsID);
            $catprops = " OR pr.id in(".$timplod.") ";
        }
		
		$perPage = 20;
		$pageNumber = 1;
		if(isset($request->page) && $request->page>0){
			$pageNumber = $request->page;
		}
		$pageStart = ($pageNumber -1) * $perPage;

		$query = "SELECT pr.editor_choice_property,pr.property_usp,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,pcrp.rack_rate as price ";
		$query .= " FROM tb_properties pr LEFT JOIN tb_properties_category_rooms_price pcrp ON pr.id = pcrp.property_id ";
        $query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
		$whereClause =" WHERE ((pr.property_name LIKE '%".$keyword."%' AND pr.property_type = 'Hotel') OR city LIKE '%".$keyword."%' ".$catprops." ) AND pr.property_status = 1 AND  pr.feature_property = 0 AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ";
		$orderBy = "ORDER BY price DESC, editor_choice_property DESC  ";
		$limit = " LIMIT ". $pageStart.",".$perPage; 
        $finalQry = "SELECT * FROM (".$query.$whereClause." ORDER BY price DESC) tempX GROUP BY id ".$orderBy.$limit ; 
		$CountRecordQry = "Select count(*) as total_record from tb_properties pr  JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ".$whereClause ;
			
			//Feature Query
		$query = "SELECT pr.editor_choice_property,pr.property_usp,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,pcrp.rack_rate as price ";
		$query .= " FROM tb_properties pr LEFT JOIN tb_properties_category_rooms_price pcrp ON pr.id = pcrp.property_id ";
        $query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
		$whereClause =" WHERE ((pr.property_name LIKE '%".$keyword."%' AND pr.property_type = 'Hotel') OR city LIKE '%".$keyword."%' ".$catprops." ) AND pr.property_status = 1 AND  pr.feature_property = 1 AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ";
		$orderBy = "ORDER BY RAND()  ";
		$limit = " LIMIT 4";
		$featureQuery = "SELECT * FROM (".$query.$whereClause." ORDER BY price DESC) tempX GROUP BY id ".$orderBy.$limit ; 
		
		  //Editor choice editor_choice_property
         $query = "SELECT pr.editor_choice_property,pr.property_usp,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,pcrp.rack_rate as price ";
		$query .= " FROM tb_properties pr LEFT JOIN tb_properties_category_rooms_price pcrp ON pr.id = pcrp.property_id ";
        $query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
		$whereClause =" WHERE ((pr.property_name LIKE '%".$keyword."%' AND pr.property_type = 'Hotel') OR city LIKE '%".$keyword."%' ".$catprops." ) AND pr.property_status = 1 AND  pr.editor_choice_property = 1 AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ";
		$orderBy = "ORDER BY RAND()  ";
		$limit = " LIMIT 4";
		$editorQuery = "SELECT * FROM (".$query.$whereClause." ORDER BY price DESC) tempX GROUP BY id ".$orderBy.$limit ; 

        $editorData = DB::select($editorQuery);
		//dd($editorData);
        $this->data['editorPropertiesArr']=$editorData;

		$property = DB::select($finalQry);
		$getRec = DB::select($CountRecordQry);
		$featureData = DB::select($featureQuery);
		
		$this->data['featurePropertiesArr']=$featureData;
		$this->data['propertiesArr'] = $property;
		$this->data['total_record'] = $getRec[0]->total_record;
		$this->data['total_pages'] = (isset($getRec[0]->total_record) && $getRec[0]->total_record>0)?(int)ceil($getRec[0]->total_record / $perPage):0;
		$this->data['active_page']=$pageNumber;

		$uid = isset(\Auth::user()->id) ? \Auth::user()->id : '';

		//get emotional gallery
        $emotional_gallery_array = array();
        $emtional_parentFolder = \DB::table('tb_container')->select('id')->where('name','emotion-gallery')->first();
        if(isset($emtional_parentFolder->id)){
            $peid = (int) $emtional_parentFolder->id;
            $emtional_containerfiles = \DB::table('tb_container')->select('tb_container_files.id','tb_container_files.file_name','tb_container_files.folder_id','tb_container.name')->join('tb_container_files','tb_container_files.folder_id','=','tb_container.id')->where('parent_id',$peid)->where('name',$keyword)->orderby('tb_container_files.file_sort_num','asc')->get();
            if((!empty($emtional_containerfiles)) && (is_array($emtional_containerfiles))){$emotional_gallery_array = $emtional_containerfiles;}
        }
        $this->data['emotional_gallery'] = $emotional_gallery_array;
        //End 
		$tags_Arr = \DB::table('tb_tags_manager')->where('tag_status', 1)->get();
		$tagsArr = array();
		if (!empty($tags_Arr)) {
			foreach ($tags_Arr as $tags) {
				$tagsArr[$tags->parent_tag_id][] = $tags;
			}
		}
		
		$this->data['slug'] = $keyword;

		$this->data['action']=request()->segments(1);
        $this->data['destination_category'] =0;

		if(request()->segment(1)=='luxury_destinations' || request()->segment(1)=='luxury_experience'){
            $this->data['destination_category']=$cateObj->id;
			$this->data['destination_category_instagram']=$cateObj->category_instagram_channel;
        }

		return view('frontend.themes.emporium.properties.list', $this->data);
                    
    }
	
	function fetchcategoryChildListIds($id = 0, $child_category_array = array()) {

        /*if (!is_array($child_category_array))
            $child_category_array = array();
        //$uid = \Auth::user()->id;
        // Get Query 
        $results = \DB::table('tb_categories')->where('parent_category_id', $id)->get();
        if ($results) {
            foreach ($results as $row) {
                $child_category_array[] = $row->id;
                $child_category_array = $this->fetchcategoryChildListIds($row->id, $child_category_array);
            }
        }*/
        
        /** new optimized query by aks (18/June/2018) start **/
        $child_category_array = array();
        $results1 = DB::select(DB::raw("call property_multi_level_child_proc(?)"),[$id]);
        foreach ($results1 as $row) {
            $child_category_array[] = $row->id;
        }
        /** new optimized query by aks end **/
        
        return $child_category_array;
    }
	
	public function getPropertyDetail(Request $request) {

        $propertiesArr = array();
		$crpropertiesArr = array();
		$relatedgridpropertiesArr = array();
        $this->data['slug'] = rtrim($request->slug,'-');
        //$props = \DB::table('tb_properties')->where('property_slug', $request->slug)->first();
        $props = \DB::table('tb_properties')->select('tb_properties.*')->join('tb_properties_category_package','tb_properties_category_package.property_id','=','tb_properties.id')->whereIn('tb_properties_category_package.package_id', explode(',',$this->pckages_ids))->whereRaw("TRIM(TRAILING '-' FROM property_slug ) = ?", [$this->data['slug']])->first();
        
        //$query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
        if (!empty($props)) {
            $propertiesArr['data'] = $props;
            $propertiesArr['propimage'] = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_container_files.id', 'tb_container_files.file_name', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->get();
            $propertiesArr['propimage_thumbpath'] = '';
            $propertiesArr['propimage_thumbpath_dir']= '';
            $propertiesArr['propimage_containerpath'] = '';
            if(!empty($propertiesArr['propimage'])){
                $propertiesArr['propimage_thumbpath'] = (new ContainerController)->getThumbpath($propertiesArr['propimage'][0]->folder_id);
    			$propertiesArr['propimage_thumbpath_dir'] = public_path(str_replace(url().'/', '', (new ContainerController)->getThumbpath($propertiesArr['propimage'][0]->folder_id))); 
                $propertiesArr['propimage_containerpath'] = (new ContainerController)->getContainerUserPath($propertiesArr['propimage'][0]->folder_id);
			}
			$this->data['currency'] = \DB::table('tb_settings')->select('content')->where('key_value', 'default_currency')->first();

            if ($props->property_category_id != '') {
                $catss = explode(',', $props->property_category_id);
                if (!empty($catss)) {
                    $getcats = " AND (" . implode(" || ", array_map(function($v) {
                                        return sprintf("FIND_IN_SET('%s', tb_properties.property_category_id)", $v);
                                    }, array_values($catss))) . ")";
                }
				
                $crpropertiesArr = DB::select(DB::raw("SELECT tb_properties.property_name, tb_properties.property_slug, tb_container_files.file_name, tb_container_files.folder_id FROM tb_properties JOIN tb_properties_images ON tb_properties_images.property_id = tb_properties.id JOIN tb_container_files ON tb_container_files.id = tb_properties_images.file_id JOIN tb_properties_category_package ON tb_properties_category_package.property_id = tb_properties.id WHERE tb_properties.property_type='" . $props->property_type . "' AND tb_properties.property_status = '1' AND tb_properties.id!='" . $props->id . "' AND tb_properties_images.type = 'Property Images' AND tb_properties_category_package.package_id IN (".$this->pckages_ids.")  $getcats GROUP BY  tb_properties.property_slug ORDER BY tb_properties.id desc, tb_container_files.file_sort_num asc LIMIT 2"));
				
				
				$relatedgridquery = "SELECT tb_properties.editor_choice_property,tb_properties.property_usp,tb_properties.feature_property,tb_properties.id,tb_properties.property_name,tb_properties.property_slug,tb_properties.property_category_id FROM tb_properties JOIN tb_properties_category_package ON tb_properties_category_package.property_id = tb_properties.id WHERE property_type='Hotel' AND tb_properties.assign_detail_city = '".$props->assign_detail_city."' AND property_status = '1' AND tb_properties.id != '".$props->id."' AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ORDER BY (SELECT rack_rate FROM tb_properties_category_rooms_price WHERE tb_properties_category_rooms_price.property_id = tb_properties.id ORDER BY rack_rate DESC LIMIT 1) * 1 DESC, editor_choice_property desc, feature_property desc LIMIT 4";

				$relatedgridprops = DB::select(DB::raw($relatedgridquery));
				if (!empty($relatedgridprops)) {
					$pr = 0;
					foreach ($relatedgridprops as $rgprop) {
						$relatedgridpropertiesArr[$pr]['data'] = $rgprop;
						$relatedgridpropertiesArr[$pr]['data']->price = '';
						$checkseasonPrice = \DB::table('tb_properties_category_rooms_price')->select('rack_rate')->where('property_id', $rgprop->id)->orderBy('rack_rate', 'DESC')->first();
						if (!empty($checkseasonPrice)) {
							$relatedgridpropertiesArr[$pr]['data']->price = $checkseasonPrice->rack_rate;
						}

						$relatedgridpropertiesArr[$pr]['data']->category_name = '';
						$cateObjtm = \DB::table('tb_categories')->select('category_name')->where('id', $rgprop->property_category_id)->where('category_published', 1)->first();
						if (!empty($cateObjtm)) {
							$relatedgridpropertiesArr[$pr]['data']->category_name = $cateObjtm->category_name;
						}

						$fileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.file_id', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $rgprop->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();
						if (!empty($fileArr)) {
							$relatedgridpropertiesArr[$pr]['image'] = $fileArr;
							$relatedgridpropertiesArr[$pr]['image']->imgsrc = (new ContainerController)->getThumbpath($fileArr->folder_id);
						}
						$pr++;
					}
				}
            }
			
			$cat_types = \DB::table('tb_properties_category_types')->select('id','category_name','room_desc')->where('property_id', $props->id)->where('status', 0)->where('show_on_booking', 1)->get();
            if (!empty($cat_types)) {
                $c = 0;
                foreach ($cat_types as $type) {
                    $roomfileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.category_id', $type->id)->where('tb_properties_images.type', 'Rooms Images')->orderBy('tb_container_files.file_sort_num', 'asc')->get();
					$type_cale = '';
                    $filen = array();
                    if (!empty($roomfileArr)) {
						$propertiesArr['roomimgs'][$type->id]['imgs'] = $roomfileArr;
						$propertiesArr['roomimgs'][$type->id]['imgsrc'] = (new ContainerController)->getThumbpath($roomfileArr[0]->folder_id);
						$propertiesArr['roomimgs'][$type->id]['imgsrc_dir'] = public_path(str_replace(url().'/', '', (new ContainerController)->getThumbpath($roomfileArr[0]->folder_id)));
                        $propertiesArr['typedata'][$c] = $type;
                        $propertiesArr['typedata'][$c]->price = '';
                        $curnDate = date('Y-m-d');
                        if ($props->default_seasons != 1) {
							$checkseason = \DB::table('tb_properties_category_rooms_price')->join('tb_seasons','tb_seasons.id','=','tb_properties_category_rooms_price.season_id')->join('tb_seasons_dates','tb_seasons_dates.season_id','=','tb_seasons.id')->select('tb_properties_category_rooms_price.rack_rate', 'tb_seasons.season_name')->where('tb_properties_category_rooms_price.property_id', $props->id)->where('tb_properties_category_rooms_price.category_id', $type->id)->where('tb_seasons.property_id', $props->id)->where('tb_seasons_dates.season_from_date', '<=', $curnDate)->where('tb_seasons_dates.season_to_date', '>=', $curnDate)->orderBy('tb_seasons.season_priority', 'asc')->first();
							//print_r($checkseason); die;
                        } else {
                            $checkseason = \DB::table('tb_properties_category_rooms_price')->join('tb_seasons','tb_seasons.id','=','tb_properties_category_rooms_price.season_id')->join('tb_seasons_dates','tb_seasons_dates.season_id','=','tb_seasons.id')->select('tb_properties_category_rooms_price.rack_rate', 'tb_seasons.season_name')->where('tb_properties_category_rooms_price.property_id', $props->id)->where('tb_properties_category_rooms_price.category_id', $type->id)->where('tb_seasons.property_id', 0)->where('tb_seasons_dates.season_from_date', '<=', $curnDate)->where('tb_seasons_dates.season_to_date', '>=', $curnDate)->first();
                        }
						
						if (!empty($checkseason)) {
							 $propertiesArr['typedata'][$c]->price = $checkseason->rack_rate;
                             $propertiesArr['typedata'][$c]->season = $checkseason->season_name;
                        } else {
                            $checkseasonPrice_ifnotanyseason = \DB::table('tb_properties_category_rooms_price')->select('rack_rate')->where('season_id', 0)->where('property_id', $props->id)->where('category_id', $type->id)->first();
                            if (!empty($checkseasonPrice_ifnotanyseason)) {
                                $propertiesArr['typedata'][$c]->price = $checkseasonPrice_ifnotanyseason->rack_rate;
                                $propertiesArr['typedata'][$c]->season = '';
                            }
                        }
                        
                        $cat_rooms_price = \DB::table('tb_properties_category_rooms_price')->leftJoin('tb_properties_category_types','tb_properties_category_types.id','=','tb_properties_category_rooms_price.category_id')->leftJoin('tb_seasons','tb_seasons.id','=','tb_properties_category_rooms_price.season_id')->select('tb_seasons.season_name','tb_properties_category_rooms_price.rack_rate','tb_properties_category_types.category_name')->where('tb_properties_category_rooms_price.category_id', $type->id)->get();                        
                        
                        $propertiesArr['typedata'][$c]->seasonwiseprice = $cat_rooms_price;
                        
                        //$room_availablity_bytype = \DB::table('tb_properties_category_rooms')->where('tb_properties_category_rooms.category_id', $type->id)->get();                       
                        //$propertiesArr['typedata'][$c]->room_availablity_bytype = $room_availablity_bytype;   
                        
                        $reserved_room_bytype = \DB::table('tb_reservations')->join('td_reserved_rooms','tb_reservations.id','=','td_reserved_rooms.reservation_id')->where('td_reserved_rooms.type_id', $type->id)->get();                                             
                        
                        $type_cale = $this->viewcalendar($type->id, $curnDate);
                        
                        $propertiesArr['typedata'][$c]->room_calendar = $type_cale;
                        
						$c++;
                    }
                    
                    
                }

                usort($propertiesArr['typedata'], function($a, $b) {
                    return trim($a->price) < trim($b->price);
                });
            }
            //echo "<pre>";
            //print_r($propertiesArr);die;
            $this->data['propertyDetail'] = $propertiesArr;
            $this->data['relatedproperties'] = $crpropertiesArr;
    		$this->data['relatedgridpropertiesArr'] = $relatedgridpropertiesArr;
    	
    		$this->data['propertyEvents'] = \DB::table('tb_events')->where('property_id', $props->id)->get();
            
            $this->data['packages'] = \DB::table('tb_packages')->where('package_category', 'B2C')->where('package_status', 1)->get();            
    
    		//dd($this->data['propertyEvents']);
            return view('frontend.themes.emporium.properties.detail', $this->data);

        }else
        {
            return response(view('errors.403'), 403);
        }        
    }
	
	public function getPropertyRoomimageGalleryView(Request $request) {
        $propertiesArr = array();
        
		if ($request->id!='') {
            $fileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.category_id', $request->id)->where('tb_properties_images.type', 'Rooms Images')->orderBy('tb_container_files.file_sort_num', 'asc')->get();
            //print_r($fileArr);
            $pr = 0;
            foreach ($fileArr as $file) {
                $propertiesArr['image'][$pr] = $file;
                $propertiesArr['image'][$pr]->imgsrc = (new ContainerController)->getThumbpath($file->folder_id).$file->file_name;
                $pr++;
            }
        }


        return response()->json($propertiesArr);
        exit;
    }
	
	public function getPropertyTypeQuickView(Request $request) {
        $propertiesArr = array();
        $cat_types = \DB::table('tb_properties_category_types')->where('id', $request->id)->where('status', 0)->first();
        if (!empty($cat_types)) {
            $propertiesArr['typedata'] = $cat_types;
            $propertiesArr['typedata']->price = '';
            $props = \DB::table('tb_properties')->where('id', $cat_types->property_id)->where('property_status', 1)->first();
            $curnDate = date('Y-m-d');
            if ($props->default_seasons != 1) {
                $checkseason = \DB::table('tb_seasons')->where('property_id', $props->id)->orderBy('season_priority', 'asc')->get();
            } else {
                $checkseason = \DB::table('tb_seasons')->where('property_id', 0)->orderBy('season_priority', 'asc')->get();
            }
            if (!empty($checkseason)) {
                $foundsean = false;
                for ($sc = 0; $foundsean != true; $sc++) {
                    $checkseasonDate = \DB::table('tb_seasons_dates')->where('season_id', $checkseason[$sc]->id)->where('season_from_date', '>=', $curnDate)->where('season_to_date', '<=', $curnDate)->count();
                    if ($checkseasonDate > 0) {
                        $checkseasonPrice = \DB::table('tb_properties_category_rooms_price')->where('season_id', $checkseason[$sc]->id)->where('property_id', $props->id)->where('category_id', $cat_types->id)->first();
                        if (!empty($checkseasonPrice)) {
                            $propertiesArr['typedata']->price = $checkseasonPrice->rack_rate;
                            $foundsean = true;
                        }
                    }
                }
                if ($foundsean != true) {
                    $checkseasonPrice_ifnotforloop = \DB::table('tb_properties_category_rooms_price')->where('season_id', 0)->where('property_id', $props->id)->where('category_id', $cat_types->id)->first();
                    if (!empty($checkseasonPrice_ifnotforloop)) {
                        $propertiesArr['typedata']->price = $checkseasonPrice_ifnotforloop->rack_rate;
                    }
                }
            } else {
                $checkseasonPrice_ifnotanyseason = \DB::table('tb_properties_category_rooms_price')->where('season_id', 0)->where('property_id', $props->id)->where('category_id', $cat_types->id)->first();
                if (!empty($checkseasonPrice_ifnotanyseason)) {
                    $propertiesArr['typedata']->price = $checkseasonPrice_ifnotanyseason->rack_rate;
                }
            }
            $roomfileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.category_id', $cat_types->id)->where('tb_properties_images.type', 'Rooms Images')->orderBy('file_sort_num', 'asc')->first();
            if (!empty($roomfileArr)) {
                $propertiesArr['roomimgs'] = $roomfileArr;
                $propertiesArr['roomimgs']->imgsrc = (new ContainerController)->getThumbpath($roomfileArr->folder_id).$roomfileArr->file_name;
                
            }

            $cat_amenities = \DB::table('tb_properties_category_amenities')->where('cat_id', $cat_types->id)->first();
            if (!empty($cat_amenities)) {
                $propertiesArr['amenities'] = $cat_amenities;
            }
            $propertiesArr['currency'] = \DB::table('tb_settings')->where('key_value', 'default_currency')->first();
        }

        return response()->json($propertiesArr);
        exit;
    }

    public function getSearchPropertyAjax(Request $request){

        $selCurrency=$request->input("currencyOption");
        \Session::put('currencyOption', $selCurrency);


        $keyword = trim($request->s);
        $show = 'asc';

        $arrive = $departure = $adult = $childs = '';
        if (!is_null($request->arrive) && $request->arrive != '') {
            $arrive = date("Y-m-d", strtotime(trim($request->arrive)));
        }
        if (!is_null($request->departure) && $request->departure != '') {
            $departure = date("Y-m-d", strtotime(trim($request->departure)));
        }
        if (!is_null($request->adult) && $request->adult != '') {
            $adult = $request->adult;
        }

        if (!is_null($request->childs) && $request->childs != '') {
            $childs = $request->childs;
        }
		$filter_max_price = '';
		if (!is_null($request->filter_max_price) && $request->filter_max_price != '') {
            $filter_max_price = $request->filter_max_price;
        }
		

        $catprops = '';


        $cateObj = \DB::table('tb_categories')->where('category_alias', $keyword)->where('category_published', 1)->first();

        $chldIds = array();
        if (!empty($cateObj)) {
            $cateObjtemp = \DB::table('tb_categories')->where('parent_category_id', $cateObj->id)->where('category_published', 1)->get();
            if (!empty($cateObjtemp)) {
                $chldIds = $this->fetchcategoryChildListIds($cateObj->id);
                array_unshift($chldIds, $cateObj->id);
            } else {
                $chldIds[] = $cateObj->id;
            }
            $getcats = '';
            if (!empty($chldIds)) {
                $getcats = " AND (" . implode(" || ", array_map(function($v) {
                        return sprintf("FIND_IN_SET('%s', property_category_id)", $v);
                    }, array_values($chldIds))) . ")";
            }

            if ($arrive != '') {
                $getcats = '';
                if (!empty($chldIds)) {
                    $getcats = " AND (" . implode(" || ", array_map(function($v) {
                            return sprintf("FIND_IN_SET('%s', pr.property_category_id)", $v);
                        }, array_values($chldIds))) . ")";
                }
                if ($departure != '') {
                    $getdestind = " AND pctr.room_active_to <= '$departure'";
                }
                $catprops = " OR pr.id in( SELECT pr.id FROM tb_properties pr, tb_properties_category_rooms pctr   WHERE pctr.property_id = pr.id AND  pr.property_status='1' AND pctr.room_active_from <= '".$arrive."' ".$getdestind."  ".$getcats." ) ";
            } else {
                $catprops = " OR pr.id in(SELECT id FROM tb_properties WHERE property_status='1' $getcats ) ";
            }

        }
		
		if ($filter_max_price != '') {
             
            $getPriceQry =" , (SELECT pcrp.rack_rate FROM tb_properties_category_rooms_price pcrp   where pr.id=pcrp.property_id and pcrp.rack_rate between '0' and '".$filter_max_price."' order by pcrp.rack_rate DESC limit 0,1 ) as price " ;
            $filterPriceQry = " and pr.id in(SELECT pr.id FROM tb_properties_category_rooms_price pcrp, tb_properties pr   where pr.id=pcrp.property_id and pcrp.rack_rate between '0' and '".$filter_max_price."' group by pr.id order by pcrp.rack_rate DESC) ";
        }else{
             $getPriceQry =" , (SELECT pcrp.rack_rate FROM tb_properties_category_rooms_price pcrp  where pr.id=pcrp.property_id  order by pcrp.rack_rate DESC limit 0,1 ) as price" ;
             $filterPriceQry = "";
        }

        $perPage = 40;
        $pageNumber = 1;
        if(isset($request->page) && $request->page>0){
            $pageNumber = $request->page;
        }
        $pageStart = ($pageNumber -1) * $perPage;

        $query = "SELECT pr.editor_choice_property,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id ";
		$query .= $getPriceQry;
        //$query .= ", (SELECT pcrp.rack_rate FROM tb_properties_category_rooms_price pcrp  where pr.id=pcrp.property_id  order by pcrp.rack_rate DESC limit 0,1 ) as price " ;
        $query .= " FROM tb_properties pr ";
        $whereClause =" WHERE ((pr.property_name LIKE '%".$keyword."%' AND pr.property_type = 'Hotel') OR city LIKE '%".$keyword."%' ".$catprops." ) AND pr.property_status = 1  ".$filterPriceQry;
        $orderBy = "ORDER BY (SELECT rack_rate FROM tb_properties_category_rooms_price pcrp WHERE pcrp.property_id = pr.id ORDER BY rack_rate DESC LIMIT 1) * 1 DESC, pr.editor_choice_property desc, pr.feature_property desc ";
        $limit = " LIMIT ". $pageStart.",".$perPage;
        $finalQry = $query.$whereClause.$orderBy.$limit ;
        $CountRecordQry = "Select count(*) as total_record from tb_properties pr ".$whereClause ;

        $property = DB::select($finalQry);
        $getRec = DB::select($CountRecordQry);
		
		/*foreach($property as $prop)
		{
			$containerObj = new \App\Http\Controllers\ContainerController;
			$proertyObj = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $prop->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();
			$prop->img_src = '';
			if(!empty($proertyObj))
			{
				$prop->img_src = $containerObj->getThumbpath($proertyObj->folder_id).$proertyObj->file_name;
			}	
		}*/
		
		usort($property, function($a, $b) {
			return trim($a->price) < trim($b->price);
		});

        $this->data['properties'] = $property;
        $this->data['total_record'] = $getRec[0]->total_record;
        $this->data['total_pages'] = (isset($getRec[0]->total_record) && $getRec[0]->total_record>0)?(int)ceil($getRec[0]->total_record / $perPage):0;
		$adscatid = 'Hotel';
		if (!empty($cateObj)) { $adscatid = $cateObj->id; }
		$this->data['resultads'] = \DB::table('tb_advertisement')->select('adv_img', 'adv_link', 'adv_title')->where('adv_type', 'sidebar')->where('adv_status', 1)->where('adv_position', 'grid_results')->where('ads_cat_id', $adscatid)->orderByRaw('RAND()')->first();
		
        return response()->json($this->data);
    }
	
	public function getContainerImageById(Request $request)
	{
	    $image = '';
		$propid = $request->id;
		$containerImgObj = \DB::table('tb_container_files')->select('id','file_name','folder_id')->where('id', $propid)->first();
        if(isset($containerImgObj->file_name)){
            $img_src = $containerObj->getThumbpath($containerImgObj->folder_id).$containerImgObj->file_name;
            header("Content-type: image/jpeg");
			$data = file_get_contents($img_src);
			$image = 'data:image/jpeg;base64,' . base64_encode($data);
        }else
        {
            return false;
        }
		return $image;
	}
	
	public function getPropertyImageById(Request $request)
	{
	
		$propid = $request->propid;
		$props = \DB::table('tb_properties')->select('property_name')->where('id', $propid)->first();
		$propertyName = strtolower(str_replace(' ','',$props->property_name));
		$propertyImage = CustomQuery::getPropertyImage($propid);	
		$remoteImage = $propertyImage->containerfolder_src;		
		$propertyNameImg = $propertyImage->containerfolder_path_src.'emporium-voyage_'.$propertyName.'.jpeg';
		if(file_exists($propertyNameImg)){
			header("Content-type: image/jpeg");
			$data = file_get_contents($propertyNameImg);
			$image = 'data:image/jpeg;base64,' . base64_encode($data);
		} else {
			if(!empty($propertyImage)) {
				$tObj = Image::make($remoteImage);
                $width = $tObj->width();
                $height = $tObj->height();
        
                $height1 = 400 * $height /$width;
				$image = $tObj->resize(400,$height1)->response('jpg');
			} else {
				return false;
			}
		}
		return $image;
	}
	public function getPropertySliderImageById(Request $request)
	{
	
		$propid = $request->propid;
		$props = \DB::table('tb_properties')->select('property_name')->where('id', $propid)->first();
		$propertyName = strtolower(str_replace(' ','',$props->property_name));
		$propertyImage = CustomQuery::getPropertyImage($propid);	
		$remoteImage = $propertyImage->containerfolder_src;		
		$propertyNameImg = $propertyImage->containerfolder_path_src.'emporium-voyage_'.$propertyName.'.jpeg';
		$width = Image::make($remoteImage)->width();
		$height = Image::make($remoteImage)->height();
		if(file_exists($propertyNameImg)){
			header("Content-type: image/jpeg");
			$data = file_get_contents($propertyNameImg);
			$image = 'data:image/jpeg;base64,' . base64_encode($data);
		} else {
			if(!empty($propertyImage)) {
				$height1 = 600 * $height /$width;
				$image = Image::make($remoteImage)->resize(600,$height1)->response('jpg');
			} else {
				return false;
			}
		}
		return $image;
	}
    
    public function getPropertyAjaxFilesByID(Request $request)
	{	
		$propid = $request->propid;
        $limit = (int) $request->limit;
        $limit = (($limit > 0)?$limit:0);
        
        
        $featuredpropertyr_images = CustomQuery::getPropertyImagesFromDB($propid,$limit);
        $featdatasrc = array();
        foreach($featuredpropertyr_images as $si_img){
            $featdatasrc[] = array('src'=> \URL::to('radtempimage/'.$propid.'/'.$si_img->file_id));
        }
        
		return json_encode($featdatasrc);
	}
    
    public function getPropertyImageByFileID(Request $request)
	{	
		$propid = $request->propid;
        $fileid = $request->fileid;
        
        $props = \DB::table('tb_properties')->select('property_name')->where('id', $propid)->first();
		$propertyName = strtolower(str_replace(' ','',$props->property_name));
		$propertyImage = CustomQuery::getPropertyImagesFromDBByFileId($fileid);	
		$remoteImage = $propertyImage->containerfolder_src;		
		$propertyNameImg = $propertyImage->containerfolder_path_src.'emporium-voyage_'.$propertyName.'.jpeg';
		$width = Image::make($remoteImage)->width();
		$height = Image::make($remoteImage)->height();
		if(file_exists($propertyNameImg)){
			header("Content-type: image/jpeg");
			$data = file_get_contents($propertyNameImg);
			$image = 'data:image/jpeg;base64,' . base64_encode($data);
		} else {
			if(!empty($propertyImage)) {
				$height1 = 600 * $height /$width;
				$image = Image::make($remoteImage)->resize(600,$height1)->response('jpg');
			} else {
				return false;
			}
		}
		return $image;
	}
	

	public function getEventsDetail(Request $request) {

        $propertiesArr = array();
		$crpropertiesArr = array();
		$relatedgridpropertiesArr = array();
        $props = \DB::table('tb_properties')->where('property_slug', $request->slug)->first();

        $this->data['slug'] = $request->slug;
        if (!empty($props)) {
            $propertiesArr['data'] = $props;
            $propertiesArr['propimage'] = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_container_files.id', 'tb_container_files.file_name', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->get();

            $propertiesArr['propimage_thumbpath'] = (new ContainerController)->getThumbpath($propertiesArr['propimage'][0]->folder_id);
			$propertiesArr['propimage_thumbpath_dir'] = public_path(str_replace(url().'/', '', (new ContainerController)->getThumbpath($propertiesArr['propimage'][0]->folder_id))); 
            $propertiesArr['propimage_containerpath'] = (new ContainerController)->getContainerUserPath($propertiesArr['propimage'][0]->folder_id);
			
			$this->data['currency'] = \DB::table('tb_settings')->select('content')->where('key_value', 'default_currency')->first();

         }
          $this->data['pageTitle'] = "Hotel Events";
        $this->data['pageMetakey'] = "Hotel Events";
        $this->data['pageMetadesc'] = "Hotel Events";
	
		$this->data['propertyEvents'] = \DB::table('tb_events')->where('property_id', $props->id)->get();

		return view('frontend.themes.emporium.properties.events', $this->data);
    }
    public function getPropertyGridListByCollectionCategory(Request $request)
	{	   	
		$this->data['slug'] = $request->slug;
        $this->data['type'] = $request->type;
        $type = $request->type;
        $f_type = "";
        $slug_type = "";
        $mtype = "";
        $s_type = "";
        //$f_type = str_replace('-', ' ', $type);
        $s_type = str_replace('-', ' ', $type);
        if($type=="lifestyle-collection"){
            
        }
        switch($type){
            case "lifestyle-collection":
                $f_type = "Lifestyle Membership";
                $mtype = 'lifestyle-membership';
                $slug_type = ucfirst(str_replace('-', ' ', $type));
                break;
            case "dedicated-collection":
                $f_type = "Dedicated Membership";
                $mtype = 'dedicated-membership';
                $slug_type = ucfirst(str_replace('-', ' ', $type));
                break;
            case "bespoke-collection":
                $f_type = "Bespoke Membership";
                $mtype = 'bespoke-membership';
                $slug_type = ucfirst(str_replace('-', ' ', $type));
                break;                
        }
        
        
        $property_package = \DB::table('tb_packages')->select('id')->where('package_title', $f_type)->first();
        if(!empty($property_package)){
            $this->pckages_id = $property_package->id;
        }else{
            $this->pckages_id = 0;
        }
        
		$this->data['dateslug'] = '';

        $this->data['slider'] = \DB::table('tb_sliders')->select('slider_category','slider_title','slider_description','slider_img','slider_link','slide_type')->where('slider_category', $s_type)->where('slider_status',1)->orderBy('sort_num','asc')->get();

        $this->data['destination_category'] =0;
        $perPage = 42;
        $pageNumber = 1;
        if(isset($request->page) && $request->page>0){
            $pageNumber = $request->page;
        }
        $pageStart = ($pageNumber -1) * $perPage;

        $query = "SELECT pr.editor_choice_property,pr.property_usp,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,"; 
        $query .= " (SELECT rack_rate FROM tb_properties_category_rooms_price pcrp where pr.id=pcrp.property_id order by rack_rate DESC limit 0,1 ) as price ," ;
        $query .= " (SELECT category_name FROM tb_categories ct where pr.property_category_id=ct.id limit 0,1 ) as category_name ";
        $query .= " FROM tb_properties  pr";
        $query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
        $whereClause = " WHERE pr.property_type='" . $request->slug . "' AND pr.property_status = '1' AND pr.feature_property = 0 AND tb_properties_category_package.package_id IN (".$this->pckages_id.") ";
        $OrderByQry =  "ORDER BY (SELECT rack_rate FROM tb_properties_category_rooms_price pcrp WHERE pcrp.property_id = pr.id ORDER BY rack_rate DESC LIMIT 1) * 1 DESC, pr.editor_choice_property desc LIMIT $pageStart, $perPage ";
        $fianlQry = $query.' '.$whereClause.' '.$OrderByQry;
        $CountRecordQry = " Select count(*) as total_record FROM tb_properties pr JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ".$whereClause;

        //featured Data
         $query = "SELECT pr.editor_choice_property,pr.property_usp,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,"; 
        $query .= " (SELECT rack_rate FROM tb_properties_category_rooms_price pcrp where pr.id=pcrp.property_id order by rack_rate DESC limit 0,1 ) as price ," ;
        $query .= " (SELECT category_name FROM tb_categories ct where pr.property_category_id=ct.id limit 0,1 ) as category_name ";
        $query .= " FROM tb_properties  pr";
        $query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
        $whereClause = " WHERE pr.property_type='" . $request->slug . "' AND pr.property_status = '1' AND pr.feature_property = 1 AND tb_properties_category_package.package_id IN (".$this->pckages_id.") ";
        $OrderByQry =  " order by RAND() LIMIT 4 ";
        $featureQuery = $query.' '.$whereClause.' '.$OrderByQry;
        
        //Editor choice editor_choice_property
         $query = "SELECT pr.editor_choice_property,pr.property_usp,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,"; 
        $query .= " (SELECT rack_rate FROM tb_properties_category_rooms_price pcrp where pr.id=pcrp.property_id order by rack_rate DESC limit 0,1 ) as price ," ;
        $query .= " (SELECT category_name FROM tb_categories ct where pr.property_category_id=ct.id limit 0,1 ) as category_name ";
        $query .= " FROM tb_properties  pr";
        $query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
        $whereClause = " WHERE pr.property_type='" . $request->slug . "' AND pr.property_status = '1' AND pr.editor_choice_property = 1 AND tb_properties_category_package.package_id IN (".$this->pckages_id.") ";
        $OrderByQry =  " order by RAND() LIMIT 4 ";
        
		$editorQuery = $query.' '.$whereClause.' '.$OrderByQry; 

        $editorData = DB::select($editorQuery);
        $this->data['editorPropertiesArr']=$editorData;

        $getRec = DB::select($CountRecordQry);
        $propertiesArr = DB::select($fianlQry);
        $featureData = DB::select($featureQuery);

        $pckages = $this->getPackagesIdByMembership();
        //print_r($pckages); die;
        $this->data['mpackage'] = $pckages;
        $this->data['pckages_ids'] = $this->pckages_ids;
        $this->data['ptype'] = $type;
        $this->data['slug_type'] = $slug_type;
        $this->data['mtype'] = $mtype;
        
		$this->data['featurePropertiesArr']=$featureData;
        $this->data['propertiesArr'] = $propertiesArr;
        $this->data['total_record'] = $getRec[0]->total_record;
        $this->data['total_pages'] = (isset($getRec[0]->total_record) && $getRec[0]->total_record>0)?(int)ceil($getRec[0]->total_record / $perPage):0;
        $this->data['active_page']=$pageNumber;	
        
        $this->data['currency'] = \DB::table('tb_settings')->select('content')->where('key_value', 'default_currency')->first();
        //print_r($this->data['pckages_ids']); die;
		return view('frontend.themes.emporium.properties.listbytype', $this->data);
	}
    
    function viewcalendar($type, $currentDt){
        //$current_date =  date('Y-m-d');
        //$current_date =  date('Y-m-d', strtotime($currentDt));
        $year = date('Y', strtotime($currentDt));
        $month = date('m', strtotime($currentDt));
        $monthname = date('F', strtotime($currentDt));
        $monthStartDate = $year."-".$month."-01";
        $dayNumber = date('w', strtotime($monthStartDate));
        
        $numberOfDayInMonth = date('t', strtotime($monthStartDate)); 
        //echo $current_date."-".$dayNumber."-".$year."-".$month."-".$numberOfDayInMonth."<br />";      
        $monthEndDate = $year."-".$month."-".$numberOfDayInMonth;
        $start_dt = '';
        $end_dt = '';
        
        //$room_availablity_bytype = \DB::table('tb_properties_category_rooms_price')->leftJoin('tb_properties_category_rooms', 'tb_properties_category_rooms_price.category_id', '=', 'tb_properties_category_rooms.category_id')->leftJoin('tb_seasons', 'tb_properties_category_rooms_price.season_id', '=', 'tb_seasons.id')->leftJoin('tb_seasons_dates', 'tb_seasons.id', '=', 'tb_seasons_dates.season_id')->where('tb_properties_category_rooms_price.category_id', $type)->orderBy('season_priority')->first();
        
        
        //$room_availablity_bytype = \DB::table('tb_properties_category_rooms_price')->join('tb_seasons', 'tb_properties_category_rooms_price.season_id', '=', 'tb_seasons.id')->join('tb_seasons_dates', 'tb_seasons.id', '=', 'tb_seasons_dates.season_id')->where('tb_properties_category_rooms_price.category_id', $type)->orderBy('season_priority')->first();
        
        //echo "<pre>";
        //print_r($room_availablity_bytype); die;
        $date_wise_arr = array();
        //$current_date = $year."-".$month."-".$k;
        //$curr_date = date('Y-m-d', strtotime($c_date));
        $query = "SELECT * FROM tb_properties_category_rooms_price inner join tb_seasons on tb_seasons.id=tb_properties_category_rooms_price.season_id inner join tb_seasons_dates on tb_seasons.id=tb_seasons_dates.season_id  where ((season_from_date <= '".$monthStartDate."' AND season_to_date >='".$monthEndDate."') OR (season_from_date BETWEEN '".$monthStartDate."' AND '".$monthEndDate."') OR  (season_to_date BETWEEN '".$monthStartDate."' AND '".$monthEndDate."')) and tb_properties_category_rooms_price.category_id=".$type." ORDER by tb_seasons.season_priority";
        $check_season = \DB::select($query);
        $arr_start_date = $monthStartDate;
        if(!empty($check_season)){
            foreach($check_season as $si_sea){
                for($m=1; $m<=$numberOfDayInMonth; $m++){
                    $m = (strlen($m)==1) ? str_pad($m, 2, '0', STR_PAD_LEFT) : $m;                        
                    $cu_date = $year."-".$month."-".$m;
                    $curre_date = date('Y-m-d', strtotime($cu_date)); 
                    if (!array_key_exists($curre_date, $date_wise_arr)){                   
                        if($si_sea->season_from_date <= $curre_date && $si_sea->season_to_date >= $curre_date){
                            $date_wise_arr[$curre_date]=$si_sea;
                        }
                    }                    
                }
                //$arr_start_date = date('Y-m-d', strtotime("+1 day", strtotime($arr_start_date)));             
            }
        }else{
            //$room_availablity_bytype = \DB::table('tb_properties_category_rooms_price')->leftJoin('tb_properties_category_rooms', 'tb_properties_category_rooms_price.category_id', '=', 'tb_properties_category_rooms.category_id')->leftJoin('tb_seasons', 'tb_properties_category_rooms_price.season_id', '=', 'tb_seasons.id')->leftJoin('tb_seasons_dates', 'tb_seasons.id', '=', 'tb_seasons_dates.season_id')->where('tb_properties_category_rooms_price.category_id', $type)->orderBy('season_priority')->first();
            //$query2 = "SELECT *, 'default' as season_name FROM tb_properties_category_rooms_price inner join tb_properties_category_rooms on tb_properties_category_rooms_price.category_id=tb_properties_category_rooms.category_id where ((room_active_from <= '".$monthStartDate."' AND room_active_to >='".$monthEndDate."') OR (room_active_from BETWEEN '".$monthStartDate."' AND '".$monthEndDate."') OR  (room_active_to BETWEEN '".$monthStartDate."' AND '".$monthEndDate."')) and tb_properties_category_rooms_price.category_id=".$type." and tb_properties_category_rooms_price.season_id=0";
            $query2 = "SELECT *, 'default' as season_name FROM tb_properties_category_rooms_price inner join tb_properties_category_rooms on tb_properties_category_rooms_price.category_id=tb_properties_category_rooms.category_id where active_full_year=1 and tb_properties_category_rooms_price.category_id=".$type." and tb_properties_category_rooms_price.season_id=0";
            $check_room = \DB::select($query2);
            //print_r($check_room); die;
            if(!empty($check_room)){
                foreach($check_room as $si_room){
                    for($m=1; $m<=$numberOfDayInMonth; $m++){
                        $m = (strlen($m)==1) ? str_pad($m, 2, '0', STR_PAD_LEFT) : $m;                        
                        $cu_date = $year."-".$month."-".$m;
                        $curre_date = date('Y-m-d', strtotime($cu_date)); 
                        if (!array_key_exists($curre_date, $date_wise_arr)){                   
                            //if($si_room->room_active_from <= $curre_date && $si_room->room_active_to >= $curre_date){
                                
                                $date_wise_arr[$curre_date]=$si_room;
                            //}
                        }                    
                    }
                    //$arr_start_date = date('Y-m-d', strtotime("+1 day", strtotime($arr_start_date)));             
                }
            }
        }
        if(count($date_wise_arr) < $numberOfDayInMonth){
            $query2 = "SELECT *, 'default' as season_name FROM tb_properties_category_rooms_price inner join tb_properties_category_rooms on tb_properties_category_rooms_price.category_id=tb_properties_category_rooms.category_id where ((room_active_from <= '".$monthStartDate."' AND room_active_to >='".$monthEndDate."') OR (room_active_from BETWEEN '".$monthStartDate."' AND '".$monthEndDate."') OR  (room_active_to BETWEEN '".$monthStartDate."' AND '".$monthEndDate."')) and tb_properties_category_rooms_price.category_id=".$type." and tb_properties_category_rooms_price.season_id=0";
            $check_room = \DB::select($query2);
            if(!empty($check_room)){
                foreach($check_room as $si_room){
                    for($m=1; $m<=$numberOfDayInMonth; $m++){
                        $m = (strlen($m)==1) ? str_pad($m, 2, '0', STR_PAD_LEFT) : $m;                        
                        $cu_date = $year."-".$month."-".$m;
                        $curre_date = date('Y-m-d', strtotime($cu_date)); 
                        if (!array_key_exists($curre_date, $date_wise_arr)){                   
                            if($si_room->room_active_from <= $curre_date && $si_room->room_active_to >= $curre_date){
                                
                                $date_wise_arr[$curre_date]=$si_room;
                            }
                        }                    
                    }
                    //$arr_start_date = date('Y-m-d', strtotime("+1 day", strtotime($arr_start_date)));             
                }
            }
        }
        //echo "<pre>";
        //print_r($date_wise_arr); die;
        //print_r($room_availablity_bytype); die;
        /*$defalt_season = array();
        $seasons = array();
        if(!empty($room_availablity_bytype)){
            
            foreach($room_availablity_bytype as $si){
              if($si->season_id==''){
                $defalt_season[] = $si;  
              }else{
                $seasons[] = $si;
              }  
            }
            if(count($seasons > 0)){
                
            }
            echo "<pre>";
            print_r($defalt_season);
            echo "--------------------------------";
            print_r($seasons);
            die;
            if(!empty($seasons)){
                foreach($seasons as $se){
                    
                }
                $season_start = $seasons->season_from_date;
                $season_end = $seasons->season_to_date;
            }else{
                $start_dt = $room_availablity_bytype->room_active_from;
                $end_dt = $room_availablity_bytype->room_active_to;
            }
        }*/
        //print_r($room_availablity_bytype); die;
        //$start_dt = $room_availablity_bytype->room_active_from;
        //$end_dt = $room_availablity_bytype->room_active_to;  
        
        $flag = 0;
        $cls = '';
        
        $arr_season_class = array(); 
        $sr = 0;
        
        $s_price = 0;
        $html = "<div class='season-header'>";
            $html .= "<div class='col-sm-4 txt-left'><a href='javascript:void(0);' class='prevMonth' data-month='".$month."' data-year='".$year."' data-type='".$type."'><i class='fa fa-angle-left'></i></a></div>";
            $html .= "<div class='col-sm-4 month-name'>".$monthname." ".$year."</div>";
            $html .= "<div class='col-sm-4 txt-right'><a href='javascript:void(0);' class='nextMonth' data-month='".$month."' data-year='".$year."' data-type='".$type."'><i class='fa fa-angle-right'></i></a></div>";
        $html .= "</div>";
        $html .= "<table id='tbl_".$type."' class='table'>";
        $html .= "<thead><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></thead>";
        for($i=1; $i<=$numberOfDayInMonth; $i++){
            $html .= "<tr>";
            for($j=0; $j<7; $j++){
                if($j==$dayNumber or $flag==1){                    
                    $flag = 1;
                    if($i <= $numberOfDayInMonth){
                        $k = (strlen($i)==1) ? str_pad($i, 2, '0', STR_PAD_LEFT) : $i;                        
                        $c_date = $year."-".$month."-".$k;
                        $curr_date = date('Y-m-d', strtotime($c_date));
                        //echo $start_dt."/".$c_date."/".$end_dt; die;
                        /*if($start_dt <= $curr_date && $end_dt >=$curr_date){
                            $html .= '<td class="'.$c_date.'">'.$i.'<br /><span class="available">Available</span></td>';
                        }else{
                            $html .= '<td class="'.$c_date.'">'.$i.'<br /><span class="not-available">Not Available</span></td>';
                        }*/
                        
                        if(array_key_exists($curr_date, $date_wise_arr)){   
                            $new_cls = $date_wise_arr[$curr_date]->season_name;
                            
                            switch ($j){
                                case 0:
                                    $s_price = ($date_wise_arr[$curr_date]->sunday_price > 0) ? $date_wise_arr[$curr_date]->sunday_price : $date_wise_arr[$curr_date]->rack_rate;
                                    break;
                                case 1:
                                    $s_price = ($date_wise_arr[$curr_date]->monday_price > 0) ? $date_wise_arr[$curr_date]->monday_price : $date_wise_arr[$curr_date]->rack_rate;
                                    break;
                                case 2:
                                    $s_price = ($date_wise_arr[$curr_date]->tuesday_price > 0) ? $date_wise_arr[$curr_date]->tuesday_price : $date_wise_arr[$curr_date]->rack_rate;
                                    break;
                                case 3:
                                    $s_price = ($date_wise_arr[$curr_date]->wednesday_price > 0) ? $date_wise_arr[$curr_date]->wednesday_price : $date_wise_arr[$curr_date]->rack_rate;
                                    break;
                                case 4:
                                    $s_price = ($date_wise_arr[$curr_date]->thursday_price > 0) ? $date_wise_arr[$curr_date]->thursday_price : $date_wise_arr[$curr_date]->rack_rate;
                                    break;
                                case 5:
                                    $s_price = ($date_wise_arr[$curr_date]->friday_price > 0) ? $date_wise_arr[$curr_date]->friday_price : $date_wise_arr[$curr_date]->rack_rate;
                                    break;
                                case 6:
                                    $s_price = ($date_wise_arr[$curr_date]->saturday_price > 0) ? $date_wise_arr[$curr_date]->saturday_price : $date_wise_arr[$curr_date]->rack_rate;
                                    break;
                            }
                            
                            if($cls!=$new_cls){
                                $cls = $new_cls;                                
                                $sr++;
                                $arr_season_class[] = array('c_name'=>$sr, 's_name'=>$cls);
                            }
                            $html .= '<td class="'.$c_date.' season-'.$sr.'" data-day="'.$j.'">'.$i.'<br /><span class="available">Available</span><br /><span class="price">'.intval($s_price).'</span></td>';
                        }else{
                            $html .= '<td class="na '.$c_date.'">'.$i.'<br /><span class="not-available">Not Available</span></td>';
                        }
                    }else{
                        $html .= '<td></td>';
                    }
                }else{
                   $html .= '<td></td>';
                   $i--;  
                }
                if($j==6){
                    //echo "<br />";
                    $i--; 
                }                
                $i++;               
            }
            $html .= "</tr>";
        }
        $html .= "</table>";
        if(!empty($arr_season_class)){
            $html .= "<div class='season-footer'>";            
            foreach($arr_season_class as $seas){
                $html .= "<div class='s-footer-item'>";
                    $html .= "<div class='s-footer-lable'>".$seas['s_name']."</div>";
                    $html .= "<div class='s-footer-box-".$seas['c_name']."'></div>";        
                $html .= "</div>";
            }            
            $html .= "</div>";
        }
        return $html;
    }
    function ajaxcalendar(Request $request){
        $type_id = $request->input('c_id');
        $s_date = $request->input('s_dt');
        $e_date = $request->input('e_dt');
        $s_date = \CommonHelper::dateformat(trim($s_date));
        $e_date = \CommonHelper::dateformat(trim($e_date));
        //echo $type_id."/".$s_date."/".$e_date;
        $v = $this->viewcalendar($type_id, $s_date);
        $return['data'] = $v;
        $return['status'] = "success";
        echo json_encode($return); 
        die;
    }
    function ajaxnextprevmonth(Request $request){
        $type_id = $request->input('c_id');
        $month = $request->input('mnth');
        $year = $request->input('yr');
        $s_date = $year."-".$month."-01";
        
        $v = $this->viewcalendar($type_id, $s_date);
        $return['data'] = $v;
        $return['status'] = "success";
        echo json_encode($return); 
        die;
    }
}
