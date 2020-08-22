<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\ContainerController;
use App\Models\Container;
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
		return view('frontend.themes.emporium.properties.list_hotel', $this->data);
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
        $membershiptype =  $request->membershiptype;
                
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
			\Session::put('arrive', $request->arrive);
			$this->data['arrive_date'] = $request->arrive;
			$this->data['dateslug'] = $request->arrive;
			$arrive = date("Y-m-d", strtotime(trim($request->arrive)));
		}
		if (!is_null($request->departure) && $request->departure != '') {
			\Session::put('departure', $request->departure);
			$this->data['departure_date'] = $request->departure;
			$this->data['dateslug'] = $this->data['dateslug'].' to '.$request->departure;
			$departure = date("Y-m-d", strtotime(trim($request->departure)));
		}


		$catprops = '';   
        $catname = '';
        $catalias = '';
        $catid = '';
		/* Default package */
        $pckages_ids = '';
        $default_package = '';
        
        $public_package = \DB::table('tb_packages')->select('id')->where('package_category', 'B2C')->where('is_public', 1)->first();
        if(!empty($public_package)){
            $pckages_ids = $public_package->id;            
        } 
        
        $selected_category = '';
        
        if($membershiptype!=''){
            if($membershiptype!='lifestyle-collection'){
                $exp_membership = explode('-', $membershiptype);
                if(!empty($exp_membership)){
                    $_type = $exp_membership[0];
                    if($_type=='dedicated'){
                        $mem_package = \DB::table('tb_packages')->select('id')->where('package_title', 'Dedicated Membership')->first();
                        $pckages_ids = $mem_package->id;   
                    }else if($_type=='bespoke'){
                        $mem_package = \DB::table('tb_packages')->select('id')->where('package_title', 'Bespoke Membership')->first();
                        $pckages_ids = $mem_package->id;  
                    }
                }
                $public_package = \DB::table('tb_packages')->select('id')->where('package_category', 'B2C')->where('is_public', 1)->first();
            }
        }else{
            if (\Auth::check() == true) {
                if(\Auth::user()->group_id!=1){
                    $uid = \Auth::user()->id;
                    $memtype = str_replace('-', ' ', \Auth::user()->member_type); 
                    $arr_membershiptype = explode('-', \Auth::user()->member_type); 
                    if(count($arr_membershiptype)>0){
                        $membershiptype = $arr_membershiptype[0]."-collection";    
                    }    
                    //print_r($membershiptype);      
                    $mem_package = \DB::table('tb_packages')->select('id')->where('package_title', $memtype)->first();
                    //print_r($mem_package); die;  
                    if(!empty($mem_package)){
                        $pckages_ids = $mem_package->id;
                    }    
                }
            }            
        }
        $this->data['default_package'] = $default_package;
        //print_r($pckages_ids); die;   
        /* End */   
           
		$cateObj = \DB::table('tb_categories')->where('category_alias', $keyword)->where('category_published', 1)->first();
       
        
		$this->data['slug'] = $keyword;

		$this->data['action']=request()->segments(1);
        $this->data['destination_category'] =0;       
        
        $search_for = '';
        
        $destarr = array();
        $dd_destarr = array();
        
        $m_collection = \DB::table('tb_categories')->where('category_alias', 'our-collection')->where('category_approved', 1)->where('category_published', 1)->first();   
        $cat_collection = array();                
        if(!empty($m_collection)){
            $cat_collection = \DB::table('tb_categories')->where('parent_category_id', $m_collection->id)->where('category_approved', 1)->where('category_published', 1)->orderBy('category_order_num', 'asc')->get();
        }
        $this->data['collections'] = $cat_collection;
        
        $parent_cat = array();
        $channel_url = '';
        $instagram_url = '';
        $dest_url = array();
		if(request()->segment(1)=='luxury_destinations' || request()->segment(1)=='luxury_experience'){
            $channel_url = $cateObj->category_youtube_channel_url;
            
            $this->data['destination_category']=$cateObj->id;
            $instagram_url=$cateObj->category_instagram_channel;
			
            
            
            
            //$m_collection = \DB::table('tb_categories')->where('category_alias', 'our-collection')->where('category_approved', 1)->where('category_published', 1)->first();   
            //$cat_collection = array();  
            $destinations = array();           
            //if(!empty($m_collection)){
            //    $cat_collection = \DB::table('tb_categories')->where('parent_category_id', $m_collection->id)->where('category_approved', 1)->where('category_published', 1)->orderBy('category_order_num', 'asc')->get();
            //}
            //$this->data['collections'] = $cat_collection;
            
            
            if(request()->segment(1)=='luxury_destinations'){
                $search_for="destinations"; 
                               
                if (!empty($cateObj)) {
                    $destinations = \DB::table('tb_categories')->where('parent_category_id', $cateObj->id)->where('category_approved', 1)->where('category_published', 1)->get();
                    
                    $dest_has_prop = array();
                    if(!empty($destinations)){
                        $selected_category = $destinations[0]->category_name;
                        foreach($destinations as $dest){
                            $subdest = \DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name', 'category_youtube_channel_url')->where('parent_category_id', $dest->id)->get();
        					$getcats = '';
        					$chldIds = array();
        					if (!empty($subdest)) {
        						$chldIds = $this->fetchcategoryChildListIds($dest->id);
        						array_unshift($chldIds, $dest->id);
        					} else {
        						$chldIds[] = $dest->id;
        					}
                            
                            $getcats = "";
                            if (count($chldIds) > 0) { $getcats = " AND (category_id IN(".implode(",",$chldIds)."))"; }
                            $preprops = DB::select(DB::raw("SELECT COUNT(id) AS total_rows FROM property_categories_split_in_rows WHERE property_status = '1' ".$getcats));
        
        					if (isset($preprops[0]->total_rows) && $preprops[0]->total_rows > 0) {
        						$destarr[] = $dest;
        					}
                    
                        }
                    }                    
                    
                    
                }
                
                $cat = trim($request->cat);
                $country = trim($request->country);
                $region = trim($request->region);
                $continent = trim($request->continent);
                
                if (!empty($cateObj)) {
                    if($cateObj->id>0){                        
        				$dest_url = implode('/',array_reverse($this->fetchcategoryaliaspath($cateObj->id)));
                    }
                    $catname = $cateObj->category_name; 
                    $catalias = $cateObj->category_alias;
                    $catid =  $cateObj->id;                   
                }
                
                $this->data['dest_url'] = $dest_url;
                $this->data['dest_cat'] = trim($request->cat);
                
                
                //print_r($this->data); die; $parent_cat
                $parent_cat = \DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name', 'category_youtube_channel_url')->where('id', $cateObj->parent_category_id)->first();
                
            }
            if(request()->segment(1)=='luxury_experience'){
                $search_for="experience";
                $this->data['experiences'] = \DB::table('tb_categories')->where('parent_category_id', 8)->where('category_approved', 1)->where('category_published', 1)->get();
            }
                        
            
            $cObj = \DB::table('tb_categories')->where('category_alias', $request->cat)->where('category_published', 1)->first(); 
            //print_r($cObj);                   
            if (!empty($cObj)) {
                if($cObj->id>0){                        
    				$dest_url = array_reverse($this->fetchcategorybc($cObj->id));
                    //$bc_dest[]= $dest_url; 
                }                    
            }
            
        }
        $this->data['channel_url'] = $channel_url;
        $this->data['destination_category_instagram'] = $instagram_url;
        
        $dd_destinations = \DB::table('tb_categories')->where('id', '!=', 8)->where('parent_category_id', 0)->where('category_approved', 1)->where('category_published', 1)->get();
        
        if(!empty($dd_destinations)){
            
            foreach($dd_destinations as $dd_dest){
                $dd_subdest = \DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name', 'category_youtube_channel_url', 'category_instagram_channel')->where('parent_category_id', $dd_dest->id)->get();
				$dd_getcats = '';
				$dd_chldIds = array();
				if (!empty($dd_subdest)) {
					$dd_chldIds = $this->fetchcategoryChildListIds($dd_dest->id);
					array_unshift($dd_chldIds, $dd_dest->id);
				} else {
					$dd_chldIds[] = $dd_dest->id;
				}
                
                $dd_getcats = "";
                if (count($dd_chldIds) > 0) { $dd_getcats = " AND (category_id IN(".implode(",",$dd_chldIds)."))"; }
                $dd_preprops = DB::select(DB::raw("SELECT COUNT(id) AS total_rows FROM property_categories_split_in_rows WHERE property_status = '1' ".$dd_getcats));

				if (isset($dd_preprops[0]->total_rows) && $dd_preprops[0]->total_rows > 0) {
					$dd_destarr[] = $dd_dest;
				}
        
            }
        }
        $dd_channels = array();
        if(!empty($dd_destarr)){
            foreach($dd_destarr as $dd_chnl){
                if($dd_chnl->category_youtube_channel_url!=''){
                    $dd_channels[] = $dd_chnl;    
                }        
            }    
        }
        
        $dd_social = array();
        if(!empty($dd_destarr)){
            foreach($dd_destarr as $d_social){
                if($d_social->category_instagram_channel!=''){
                    $dd_social[] = $d_social;    
                }        
            }    
        }
        $this->data['dd_social'] = $dd_social;
        //print_r($dd_channels); die;
        
        $this->data['parent_cat'] = $parent_cat;
        
        $this->data['dd_channels'] = $dd_channels;
        
        $youtube_channels = array();
        if(!empty($destarr)){
            foreach($destarr as $sin_des){
                if($sin_des->category_youtube_channel_url!=''){
                    $youtube_channels[] = $sin_des;        
                }
            }
        }
        $this->data['youtube_channels'] = $youtube_channels;
        
        $instagram_channels = array();
        if(!empty($destarr)){
            foreach($destarr as $sin_des){
                if($sin_des->category_instagram_channel!=''){
                    $instagram_channels[] = $sin_des;        
                }
            }
        }
        $this->data['instagram_channels'] = $instagram_channels;
        
        $this->data['experiences'] = \DB::table('tb_categories')->where('parent_category_id', 8)->where('category_approved', 1)->where('category_published', 1)->get();
        
        $this->data['selected_category'] = $selected_category;
        $this->data['bc_dest'] = $dest_url; //print_r($this->data['bc_dest']); die;
        $this->data['destinations'] = $destarr;
        
        $this->data['dd_destinations'] = $dd_destarr;
        
        $this->data['search_for'] = $search_for;
        
        $this->data['req_for'] = request()->segment(1);
        $this->data['sel_exp'] = trim($request->cat);
        $this->data['catname'] = $catname;
        $this->data['catalias'] = $catalias;
        $this->data['catid'] = $catid;
        $this->data['m_type'] = ($membershiptype !='' ? $membershiptype : 'lifestyle-collection');
        if(!empty($cateObj)){
            $this->data['metatags'] = \DB::table('tb_category_metatags')->where('category_id', $cateObj->id)->first();
        }
		return view('frontend.themes.emporium.properties.list', $this->data);
                    
    }
    
    function propertySearch_latest(Request $request) {
        //print_r(date('Y-m-d', '1560988800000')); die;
        $membershiptype =  $request->membershiptype;
        
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
			\Session::put('arrive', $request->arrive);
			$this->data['arrive_date'] = $request->arrive;
			$this->data['dateslug'] = $request->arrive;
			$arrive = date("Y-m-d", strtotime(trim($request->arrive)));
		}
		if (!is_null($request->departure) && $request->departure != '') {
			\Session::put('departure', $request->departure);
			$this->data['departure_date'] = $request->departure;
			$this->data['dateslug'] = $this->data['dateslug'].' to '.$request->departure;
			$departure = date("Y-m-d", strtotime(trim($request->departure)));
		}


		$catprops = '';   

		/* Default package */
        $pckages_ids = '';
        
        $public_package = \DB::table('tb_packages')->select('id')->where('package_category', 'B2C')->where('is_public', 1)->first();
        if(!empty($public_package)){
            $pckages_ids = $public_package->id;
        } 
        
        if($membershiptype!=''){
            if($membershiptype!='lifestyle-collection'){
                $exp_membership = explode('-', $membershiptype);
                if(!empty($exp_membership)){
                    $_type = $exp_membership[0];
                    if($_type=='dedicated'){
                        $mem_package = \DB::table('tb_packages')->select('id')->where('package_title', 'Dedicated Membership')->first();
                        $pckages_ids = $mem_package->id;   
                    }else if($_type=='bespoke'){
                        $mem_package = \DB::table('tb_packages')->select('id')->where('package_title', 'Bespoke Membership')->first();
                        $pckages_ids = $mem_package->id;  
                    }
                }
                $public_package = \DB::table('tb_packages')->select('id')->where('package_category', 'B2C')->where('is_public', 1)->first();
            }
        }
        
        //print_r($pckages_ids); die;   
        /* End */   
           
		$cateObj = \DB::table('tb_categories')->where('category_alias', $keyword)->where('category_published', 1)->first();
//print_r($cateObj); die;
        $chldIds = array();
        $getcatsID = array();
        if (!empty($cateObj)) {
            $channel_url = $cateObj->category_youtube_channel_url;
            $this->data['channel_url'] = $channel_url;
            
            //get all children start
            $chldIds = $this->fetchcategoryChildListIds($cateObj->id);
            //End
            //print_r($chldIds); die;
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
            //$catprops = " OR pr.id in(".$timplod.") ";
            $catprops = " AND pr.id in(".$timplod.") ";
        }
		
		$perPage = 20;
		$pageNumber = 1;
		if(isset($request->page) && $request->page>0){
			$pageNumber = $request->page;
		}
		$pageStart = ($pageNumber -1) * $perPage;

		$query = "SELECT pr.editor_choice_property,pr.property_usp,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,pcrp.rack_rate as price, tb_properties_category_package.package_id ";
		$query .= " FROM tb_properties pr LEFT JOIN tb_properties_category_rooms_price pcrp ON pr.id = pcrp.property_id ";
        $query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
		//$whereClause =" WHERE ((pr.property_name LIKE '%".$keyword."%' AND pr.property_type = 'Hotel') OR city LIKE '%".$keyword."%' ".$catprops." ) AND pr.property_status = 1 AND  pr.feature_property = 0 AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ";
        $whereClause =" WHERE pr.property_type = 'Hotel' AND pr.property_status = 1 AND  pr.feature_property = 0 AND tb_properties_category_package.package_id IN (".$pckages_ids.") ".$catprops." ";
        //print_r($whereClause); die;
		$orderBy = "ORDER BY price DESC, editor_choice_property DESC  ";
		$limit = " LIMIT ". $pageStart.",".$perPage; 
        $finalQry = "SELECT * FROM (".$query.$whereClause." ORDER BY price DESC) tempX GROUP BY id ".$orderBy.$limit ;
        
        $whereClauseAll =" WHERE pr.property_type = 'Hotel' AND pr.property_status = 1 AND  pr.feature_property = 0 ".$catprops." "; 
        $finalQryAll = "SELECT * FROM (".$query.$whereClauseAll." ORDER BY price DESC) tempX GROUP BY id ".$orderBy ;
        
		$CountRecordQry = "Select count(*) as total_record from tb_properties pr  JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ".$whereClause ;
			
			//Feature Query
		$query = "SELECT pr.editor_choice_property,pr.property_usp,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,pcrp.rack_rate as price, tb_properties_category_package.package_id ";
		$query .= " FROM tb_properties pr LEFT JOIN tb_properties_category_rooms_price pcrp ON pr.id = pcrp.property_id ";
        $query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
		//$whereClause =" WHERE ((pr.property_name LIKE '%".$keyword."%' AND pr.property_type = 'Hotel') OR city LIKE '%".$keyword."%' ".$catprops." ) AND pr.property_status = 1 AND  pr.feature_property = 1 AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ";
        $whereClause =" WHERE pr.property_type = 'Hotel'  AND tb_properties_category_package.package_id IN (".$pckages_ids.") ".$catprops." AND pr.property_status = 1 AND  pr.feature_property = 1 ";
		$orderBy = "ORDER BY RAND()  ";
		$limit = " LIMIT 4";
		$featureQuery = "SELECT * FROM (".$query.$whereClause." ORDER BY price DESC) tempX GROUP BY id ".$orderBy.$limit ; 
		
		  //Editor choice editor_choice_property
        $query = "SELECT pr.editor_choice_property,pr.property_usp,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,pcrp.rack_rate as price, tb_properties_category_package.package_id ";
		$query .= " FROM tb_properties pr LEFT JOIN tb_properties_category_rooms_price pcrp ON pr.id = pcrp.property_id ";
        $query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
		//$whereClause =" WHERE ((pr.property_name LIKE '%".$keyword."%' AND pr.property_type = 'Hotel') OR city LIKE '%".$keyword."%' ".$catprops." ) AND pr.property_status = 1 AND  pr.editor_choice_property = 1 AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ";
        $whereClause =" WHERE  pr.property_type = 'Hotel'  AND tb_properties_category_package.package_id IN (".$pckages_ids.") ".$catprops." AND pr.property_status = 1 AND pr.editor_choice_property = 1 ";
		$orderBy = "ORDER BY RAND()  ";
		$limit = " LIMIT 4";
		$editorQuery = "SELECT * FROM (".$query.$whereClause." ORDER BY price DESC) tempX GROUP BY id ".$orderBy.$limit ; 

        $editorData = DB::select($editorQuery);
		//dd($editorData);
        $this->data['editorPropertiesArr']=$editorData;

		$property = DB::select($finalQry);
		$getRec = DB::select($CountRecordQry);
		$featureData = DB::select($featureQuery);
		
        /*--  Get all the property by membership  --*/
        //echo "<pre>";
        //print_r($property); die;
        $allProperty = DB::select($finalQryAll);
        
        /*-- End --*/
        
        $prop_by_package = array();
        $mem_packages =  \DB::table('tb_packages')->where('package_category', 'B2C')->where('package_status', 1)->orderby('order_num', 'asc')->get();
        if(!empty($mem_packages)){
            $arr_key = '';
            foreach($mem_packages as $pack){
                $pkg_ttl = $pack->package_title;
                $exp_ttl = explode(' ', $pkg_ttl);
                if(!empty($exp_ttl)){
                    $arr_key = $exp_ttl[0];       
                }
                if(!empty($allProperty)){
                    foreach($allProperty as $prop){                        
                        if($prop->package_id == $pack->id)
                            $prop_by_package[$arr_key][] = $prop;  
                    }    
                }            
            }
        }
        //echo "<pre>";
        //print_r($prop_by_package); die;
        $this->data['prop_packages'] = $prop_by_package;
        /*--  End --*/
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
        
        //set folder path
        $efolderArr = array();
        $finalEm = array();
        foreach($emotional_gallery_array as $erow){
            $efid = $erow->folder_id;
            $folderpath = '';
            if(isset($finalEm['f-'.$efid])){ $folderpath = $finalEm['f-'.$efid];}
            else{
                $folderpath = trim($this->getThumbpath($efid));
                $finalEm['f-'.$efid] = $folderpath;
            }
            $erow->imgsrc = $folderpath;
            $finalEm[] = $erow;
        }
        //echo "<pre>"; print_r($finalEm); die;
        //End
        
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
        
        $search_for = '';
        
        $destarr = array();
		if(request()->segment(1)=='luxury_destinations' || request()->segment(1)=='luxury_experience'){
            $this->data['destination_category']=$cateObj->id;
			$this->data['destination_category_instagram']=$cateObj->category_instagram_channel;
            
            
            $m_collection = \DB::table('tb_categories')->where('category_alias', 'our-collection')->where('category_approved', 1)->where('category_published', 1)->first();   
            $cat_collection = array();  
            $destinations = array();           
            if(!empty($m_collection)){
                $cat_collection = \DB::table('tb_categories')->where('parent_category_id', $m_collection->id)->where('category_approved', 1)->where('category_published', 1)->orderBy('category_order_num', 'asc')->get();
            }
            $this->data['collections'] = $cat_collection;
            
            
            if(request()->segment(1)=='luxury_destinations'){
                $search_for="destinations"; 
                               
                if (!empty($cateObj)) {
                    $destinations = \DB::table('tb_categories')->where('parent_category_id', $cateObj->id)->where('category_approved', 1)->where('category_published', 1)->get();
                    
                    $dest_has_prop = array();
                    if(!empty($destinations)){
                        foreach($destinations as $dest){
                            $subdest = \DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name', 'category_youtube_channel_url')->where('parent_category_id', $dest->id)->get();
        					$getcats = '';
        					$chldIds = array();
        					if (!empty($subdest)) {
        						$chldIds = $this->fetchcategoryChildListIds($dest->id);
        						array_unshift($chldIds, $dest->id);
        					} else {
        						$chldIds[] = $dest->id;
        					}
                            
                            $getcats = "";
                            if (count($chldIds) > 0) { $getcats = " AND (category_id IN(".implode(",",$chldIds)."))"; }
                            $preprops = DB::select(DB::raw("SELECT COUNT(id) AS total_rows FROM property_categories_split_in_rows WHERE property_status = '1' ".$getcats));
        
        					if (isset($preprops[0]->total_rows) && $preprops[0]->total_rows > 0) {
        						$destarr[] = $dest;
        					}
                    
                        }
                    }                    
                    
                    
                }
                
                $cat = trim($request->cat);
                $country = trim($request->country);
                $region = trim($request->region);
                $continent = trim($request->continent);
                
                if (!empty($cateObj)) {
                    if($cateObj->id>0){                        
        				$dest_url = implode('/',array_reverse($this->fetchcategoryaliaspath($cateObj->id)));
                    }                    
                }
                
                $this->data['dest_url'] = $dest_url;
                $this->data['dest_cat'] = trim($request->cat);
                //print_r($this->data); die;
            }
            if(request()->segment(1)=='luxury_experience'){
                $search_for="experience";
                $this->data['experiences'] = \DB::table('tb_categories')->where('parent_category_id', 8)->where('category_approved', 1)->where('category_published', 1)->get();
            }
        }
        $this->data['destinations'] = $destarr;
        $this->data['search_for'] = $search_for;
        
        $this->data['req_for'] = request()->segment(1);
        $this->data['sel_exp'] = trim($request->cat);
        $this->data['m_type'] = ($membershiptype !='' ? $membershiptype : 'lifestyle-collection');
        
		return view('frontend.themes.emporium.properties.list_latest', $this->data);
                    
    }
    
   	public function fetchcategoryaliaspath($id = 0, $child_category_array = '') {

        if (!is_array($child_category_array))
            $child_category_array = array();
		
        $results = \DB::table('tb_categories')->where('id', $id)->get();
        if ($results) {
            foreach ($results as $row) {
                $child_category_array[] = $row->category_alias;
                $child_category_array = $this->fetchcategoryaliaspath($row->parent_category_id, $child_category_array);
            }
        }
        return $child_category_array;
    }

	function propertySearch_old(Request $request) {

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
        
        //set folder path
        $efolderArr = array();
        $finalEm = array();
        foreach($emotional_gallery_array as $erow){
            $efid = $erow->folder_id;
            $folderpath = '';
            if(isset($finalEm['f-'.$efid])){ $folderpath = $finalEm['f-'.$efid];}
            else{
                $folderpath = trim($this->getThumbpath($efid));
                $finalEm['f-'.$efid] = $folderpath;
            }
            $erow->imgsrc = $folderpath;
            $finalEm[] = $erow;
        }
        //echo "<pre>"; print_r($finalEm); die;
        //End
        
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
        
        $props = \DB::table('tb_properties')->select('tb_properties.*')->whereRaw("TRIM(TRAILING '-' FROM property_slug ) = ?", [$this->data['slug']])->first(); 
        
        //$props = \DB::table('tb_properties')->select('tb_properties.*', 'tb_properties_category_package.package_id', 'tb_packages.package_title')->join('tb_properties_category_package','tb_properties_category_package.property_id','=','tb_properties.id')->join('tb_packages','tb_packages.id','=','tb_properties_category_package.package_id')->whereRaw("TRIM(TRAILING '-' FROM property_slug ) = ?", [$this->data['slug']])->first(); 
        
        
        
        /*if($is_access){
            $props = \DB::table('tb_properties')->select('tb_properties.*')->join('tb_properties_category_package','tb_properties_category_package.property_id','=','tb_properties.id')->whereRaw("TRIM(TRAILING '-' FROM property_slug ) = ?", [$this->data['slug']])->first();    
        }else{
            $props = \DB::table('tb_properties')->select('tb_properties.*')->join('tb_properties_category_package','tb_properties_category_package.property_id','=','tb_properties.id')->whereIn('tb_properties_category_package.package_id', explode(',',$this->pckages_ids))->whereRaw("TRIM(TRAILING '-' FROM property_slug ) = ?", [$this->data['slug']])->first();
        }*/
        
        //$query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
        if (!empty($props)) {
                        
            $propertiesArr['data'] = $props;
            
            /* Price on Rquest */
            $prcOnReq = false;
            $chkseasonset = \DB::table('tb_seasons')->where('property_id', $props->id)->orderBy('season_priority', 'asc')->get();
            if ($props->default_seasons == 1 || empty($chkseasonset)){
                $prcOnReq = true;    
            }                        
            $propertiesArr['data']->prcOnReq = $prcOnReq;
            /* End */
            
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
                    
                    /*------- Custom Plan ---------*/
                    $custom_plans = \DB::table('tb_properties_custom_plan')->where('property_id', $props->id)->get();
                    
                    $propertiesArr['cplans'][$type->id] = $custom_plans;
                    
                    //$globalcustomplan = \DB::table('tb_global_custom_plan')->join('tb_global_custom_plan_assined', 'tb_global_custom_plan.id', '=',  'tb_global_custom_plan_assined.global_plan_id')->where('tb_global_custom_plan_assined.property_id', $props->id)->get();
                    
                    $globalcustomplan = \DB::table('tb_global_custom_plan_assined')->join('tb_global_custom_plan', 'tb_global_custom_plan_assined.global_plan_id', '=', 'tb_global_custom_plan.id')->select('tb_global_custom_plan.*')->where('property_id', $props->id)->get();
                    
                    $override_plans = \DB::table('tb_global_custom_plan_override')->where('property_id', $props->id)->get();
                    //print_r($override_plans);
                    $over_arr = array();
                    $over_plan_obj = array();
                    if(!empty($override_plans)){
                        foreach($override_plans as $sio){
                            $over_arr[] = $sio->global_plan_id;
                            $over_plan_obj[$sio->global_plan_id] = $sio;
                        }
                    }
                    $gl_plans = array();
                    if(!empty($globalcustomplan)){
                        foreach($globalcustomplan as $sip){
                            if(in_array($sip->id, $over_arr)){
                                $gl_plans[] = $over_plan_obj[$sip->id];        
                            }else{
                                $gl_plans[] = $sip;    
                            }
                        }
                    }
                    $propertiesArr['overrideplans'][$type->id] = $gl_plans;
                    //echo "<pre>";
                    //print_r($propertiesArr); die;
                    //print_r($custom_plans); print_r($custom_aplans);
                    //print_r($custom_oplans); die;
                    /*-------End Custom Plan ---------*/
                    
                }

                usort($propertiesArr['typedata'], function($a, $b) {
                    return trim($a->price) < trim($b->price);
                });
            }
            //echo "<pre>";
            //print_r($propertiesArr);die;
            $prop_package = \DB::table('tb_properties_category_package')->join("tb_packages", "tb_packages.id", "=", "tb_properties_category_package.package_id")->where('property_id', $props->id)->first();
            $package_type = trim($prop_package->package_title);             
            $package_type = strtolower(str_replace(' ', '-', trim($package_type)));
            switch($package_type){
                case "lifestyle-membership":
                    $type = "lifestyle-collection";                            
                    break;
                case "dedicated-membership":
                    $type = "dedicated-collection";                            
                    break;
                case "bespoke-membership":
                    $type = "bespoke-collection";                            
                    break;                
            }
            /*if (\Auth::check()){
                $obj_user1 =  \DB::table('tb_users')->where('id', \Auth::user()->id)->first();
                
                if(!empty($obj_user1)){
                    if($obj_user1->member_type!=''){
                        $member_type1 = trim($obj_user->member_type);
                    }else{
                        $member_type1 = 'lifestyle-membership';
                    }
                    switch($member_type1){
                        case "lifestyle-membership":
                            $type = "lifestyle-collection";                            
                            break;
                        case "dedicated-membership":
                            $type = "dedicated-collection";                            
                            break;
                        case "bespoke-membership":
                            $type = "bespoke-collection";                            
                            break;                
                    }
                }
            }*/
            /*------- Custom Plan ---------*/
            /*$custom_plans = \DB::table('tb_properties_custom_plan')->where('property_id', $props->id)->get();
            
            $custom_aplans = \DB::table('tb_global_custom_plan')->join('tb_global_custom_plan_assined', 'tb_global_custom_plan.id', '=',  'tb_global_custom_plan_assined.global_plan_id')->where('tb_global_custom_plan_assined.property_id', $props->id)->get();
            
            $custom_oplans = \DB::table('tb_global_custom_plan_override')->where('property_id', $props->id)->get();
            //echo "<pre>";
            //print_r($custom_plans); print_r($custom_aplans);
            //print_r($custom_oplans); die;*/
            /*-------End Custom Plan ---------*/
            
            $arc_thumb_path = '';
            $arr_landscape = array();
            $arr_portrait = array();
            $system_module = \DB::table('tb_container')->select('id', 'name', 'display_name')->where('parent_id', 0)->where('name','system-module')->first();
            if(!empty($system_module)){
                $sub_sys_mod =  \DB::table('tb_container')->select('id', 'name', 'display_name')->where('parent_id', $system_module->id)->get();
                if(!empty($sub_sys_mod)){
                    foreach($sub_sys_mod as $mod){
                        if($mod->name=="architecture"){
                            $arc_mod =  \DB::table('tb_container')->select('id', 'name', 'display_name')->where('parent_id', $mod->id)->get();
                            
                            if(!empty($arc_mod)){
                                $arc_thumb_path = (new ContainerController)->getThumbpath($arc_mod[0]->id);
                                foreach($arc_mod as $a_mod){
                                    if($a_mod->name=="landscape"){
                                        $arr_landscape = \DB::table('tb_container')->select('tb_container_files.id','tb_container.display_name','tb_container_files.file_name','tb_container_files.folder_id','tb_container.name', 'tb_container.title', 'tb_container.description')->join('tb_container_files','tb_container_files.folder_id','=','tb_container.id')->where('tb_container.id',$a_mod->id)->orderby('tb_container_files.file_sort_num','asc')->get();
                                    }
                                    if($a_mod->name=="portraite"){
                                        $arr_portrait = \DB::table('tb_container')->select('tb_container_files.id','tb_container.display_name','tb_container_files.file_name','tb_container_files.folder_id','tb_container.name', 'tb_container.title', 'tb_container.description')->join('tb_container_files','tb_container_files.folder_id','=','tb_container.id')->where('tb_container.id',$a_mod->id)->orderby('tb_container_files.file_sort_num','asc')->get();
                                    }
                                }
                                //print_r($arc_mod);    
                            }            
                        }                            
                    }
                }
            }
            
            $this->data['ptype'] = $type;            
            
            $isPackage = $this->checkPropertyPackage($props->id);                        
            $this->data['propertyPackage'] = $isPackage;      
            //echo "<pre>";
            //print_r($this->data['propertyPackage']); die;      
            
            $this->data['propertyDetail'] = $propertiesArr;
            $this->data['relatedproperties'] = $crpropertiesArr;
    		$this->data['relatedgridpropertiesArr'] = $relatedgridpropertiesArr;
    	
    		$this->data['propertyEvents'] = \DB::table('tb_events')->where('property_id', $props->id)->get();
            
            $this->data['packages'] = \DB::table('tb_packages')->where('package_category', 'B2C')->where('package_status', 1)->get(); 
            
            $this->data['metatags'] = \DB::table('tb_property_metatags')->where('property_id',  $props->id)->first();
            //print_r($this->data['metatags']); die;           
            //print_r($this->data['propertyDetail']); die;
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
        
        $is_access = false;
        if(isset(\Auth::user()->group_id)){
            if(\Auth::user()->group_id==1){
                $is_access = true;
            }    
        }
        $this->data['is_access'] = $is_access;
        //print_r($is_access); die;
		$this->data['featurePropertiesArr']=$featureData;
        $this->data['propertiesArr'] = $propertiesArr;
        $this->data['total_record'] = $getRec[0]->total_record;
        $this->data['total_pages'] = (isset($getRec[0]->total_record) && $getRec[0]->total_record>0)?(int)ceil($getRec[0]->total_record / $perPage):0;
        $this->data['active_page']=$pageNumber;	
        //print_r($mtype);
        //print_r($type);
        //print_r($pckages); die;
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
        $currency = \DB::table('tb_settings')->select('content')->where('key_value', 'default_currency')->first();
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
                            $html .= '<td class="'.$c_date.' season-'.$sr.'" data-day="'.$j.'">'.$i.'<br /><span class="available">Available</span><br /><span class="price">'.(($currency->content!='') ? $currency->content : '$').intval($s_price).'</span></td>';
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
    public function roomavailability(Request $request) {
        
        $pid = $request->input('property');
        $arrive = $request->input('arrive');
        $departure = $request->input('departure');
        $booking_rooms = $request->input('booking_rooms');
        $booking_adults = $request->input('booking_adults');
        $booking_children = $request->input('booking_children');
        $roomType = $request->input('roomType');
        $travellerType = $request->input('travellerType');
        
        $child_age = $request->input('childrenAge');
        
        $tr_2_rooms = $request->input('tr_2_rooms');
        $tr_2_adults = $request->input('tr_2_adults');
        $tr_2_child = $request->input('tr_2_child');
        $child_2_ages = array();
        
        if($tr_2_child != ''){ 
            if($tr_2_child >0 ){  
                for($k=0; $tr_2_child > $k; $k++){  
                   // echo 'tr_2_ca_'.$k;
                   //echo $request->input('tr_2_ca_'.$k);
                   $child_2_ages[] = $request->input('tr_2_ca_'.$k);  
                }
            }
        }
        //print_r($child_2_ages); die;
        $tr_3_rooms = $request->input('tr_3_rooms');
        $tr_3_adults = $request->input('tr_3_adults');
        $tr_3_child = $request->input('tr_3_child');
        $child_3_ages = array();
        
        if($tr_3_child != ''){
            if($tr_3_child >0 ){
                for($k=0; $tr_3_child > $k; $k++){
                   $child_3_ages[] = $request->input('tr_3_ca_'.$k);  
                }
            }
        }
        $tr_4_rooms = $request->input('tr_4_rooms');
        $tr_4_adults = $request->input('tr_4_adults');
        
        $child_age = array();
        if($travellerType==2 || $travellerType==3){
            if($booking_children > 0){
                for($i=1; $i <=$booking_children; $i++){
                    $child_age[] = $request->input('child_'.$travellerType."_".$i);
                }
            }
        }
        //print_r($child_age); die;
        //echo $pid."-".$arrive."-".$departure."-".$booking_rooms."-".$booking_adults."-".$booking_children."-".$roomType; die;
        
        $propertiesArr = array();		
		$relatedgridpropertiesArr = array();
        $this->data['slug'] = rtrim($request->slug,'-');
        
        $props = \DB::table('tb_properties')->select('tb_properties.*')->join('tb_properties_category_package','tb_properties_category_package.property_id','=','tb_properties.id')->whereIn('tb_properties_category_package.package_id', explode(',',$this->pckages_ids))->whereRaw("TRIM(TRAILING '-' FROM property_slug ) = ?", [$this->data['slug']])->first();
        
        //$query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
        if (!empty($props)) {
            $propertiesArr['data'] = $props;
        //$props = \DB::table('tb_properties')->where('id', $pid)->first();
        }        
        $arrive_date = '';
        
        if (!is_null($arrive) && $arrive != '' && $arrive != 'null') {
            \Session::put('arrive', $arrive);
            $arrive_date = \CommonHelper::dateformat(trim($arrive));
        }
        $this->data['arrive_date']=$arrive_date;
        
        $departure_date ='';
        if (!is_null($departure) && $departure != '' && $departure != 'null') {
            \Session::put('departure', $departure);
            $departure_date = \CommonHelper::dateformat(trim($departure));
        }
        $this->data['departure'] = $departure_date;
        //echo Session::get('arrive'); die;
        $rooms = ''; 
        $adults = '';
        $child = ''; 
        if (!is_null($booking_rooms) && $booking_rooms != '') {    
            \Session::put('booking_rooms', $booking_rooms);
            $rooms = $booking_rooms;
        }          
        if (!is_null($booking_adults) && $booking_adults != '') {
            \Session::put('booking_adults', $booking_adults);
            $adults = $booking_adults;
        }        
        if (!is_null($booking_children) && $booking_children != '') {
            \Session::put('booking_children', $booking_children);
            $child = $booking_children;            
        }else{
            \Session::put('booking_children', 0);
        }
        if ($travellerType != '') { 
            \Session::put('travellerType', $travellerType);                       
        }
        if($tr_2_rooms!=''){
            \Session::put('tr_2_rooms', $tr_2_rooms);
        }
        if($tr_2_adults!=''){
            \Session::put('tr_2_adults', $tr_2_adults);
        }
        if($tr_2_child!=''){
            \Session::put('tr_2_child', $tr_2_child);
        }
        
        if($tr_3_rooms!=''){
            \Session::put('tr_3_rooms', $tr_3_rooms);
        }
        if($tr_3_adults!=''){
            \Session::put('tr_3_adults', $tr_3_adults);
        }
        if($tr_3_child!=''){
            \Session::put('tr_3_child', $tr_3_child);
        }
        
        if($tr_4_rooms!=''){
            \Session::put('tr_4_rooms', $tr_4_rooms);
        }
        if($tr_4_adults!=''){
            \Session::put('tr_4_adults', $tr_4_adults);
        }
        if(!empty($child_2_ages)){
            \Session::put('child_2_ages', $child_2_ages);
        }
        if(!empty($child_3_ages)){
            \Session::put('child_3_ages', $child_3_ages);
        }
        //print_r($child_3_ages); die;
        
        //Get Total guest
        $total_guests = (int)$adults + (int)(($child=='') ? 0 : $child);
        //End Toatal Guest
        //Get Number of night
        $number_of_nights = '';
        if($arrive_date != '' && $departure_date != '') {
            $date1 = date_create(date('Y-m-d H:i:s', strtotime($departure_date)));
            $date2 = date_create(date('Y-m-d H:i:s', strtotime($arrive_date)));
            $diff = date_diff($date1, $date2);
            $number_of_nights = $diff->format("%a");            
        }
        //End Number of night
        
        $result = array();
        $new_result = array();
        $available_cat = array();
        $available_rooms = array();
        $total_available_room = 0;
        $flag = 0;
        if (!empty($props)) {
            
            $cat_types = \DB::table('tb_properties_category_types')->select('id','category_name','room_desc')->where('property_id', $props->id)->where('status', 0)->where('show_on_booking', 1)->get();
            if (!empty($cat_types)) {
                $c = 0;
                foreach ($cat_types as $type) {
                    $roomfileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.category_id', $type->id)->where('tb_properties_images.type', 'Rooms Images')->orderBy('tb_container_files.file_sort_num', 'asc')->get();
                    
                    if (!empty($roomfileArr)) {
						$propertiesArr['roomimgs'][$type->id]['imgs'] = $roomfileArr;
						$propertiesArr['roomimgs'][$type->id]['imgsrc'] = (new ContainerController)->getThumbpath($roomfileArr[0]->folder_id);
						$propertiesArr['roomimgs'][$type->id]['imgsrc_dir'] = public_path(str_replace(url().'/', '', (new ContainerController)->getThumbpath($roomfileArr[0]->folder_id)));
                        $propertiesArr['typedata'][$c] = $type;                        
						$c++;
                    }                    
                    
                }
            }
            
            if($roomType==0){
                //$query = "SELECT COUNT(id) as noOfRooms, property_id, category_id FROM tb_properties_category_rooms where 1=1 and (CASE WHEN active_full_year = 0 THEN ";
                //$query .="( room_active_from <= '".$arrive_date."' AND room_active_to >= '".$departure_date."')";
                //$query .=" ELSE active_full_year = 1 END) and property_id=".$pid." GROUP BY category_id";
                
                $query = "SELECT COUNT(id) as noOfRooms, property_id, category_id FROM tb_properties_category_rooms where 1=1 and";
                $query .="( room_active_from <= '".$arrive_date."' AND room_active_to >= '".$departure_date."')";
                
                $query .=" and tb_properties_category_rooms.id not IN (select td_reserved_rooms.room_id from tb_reservations INNER join td_reserved_rooms on td_reserved_rooms.reservation_id=tb_reservations.id where '".$arrive_date."' BETWEEN checkin_date and checkout_date or '".$departure_date."' BETWEEN checkin_date and checkout_date)";
                
                $query .=" and property_id=".$pid." GROUP BY category_id";
                
                $result = DB::SELECT($query);
                
                if(!empty($result)){
                    foreach($result as $sin){
                        $new_result[$sin->category_id]=$sin;
                        $total_available_room = (int) $total_available_room + (int) $sin->noOfRooms;
                    }
                }
                //print_r($new_result); die;
                //echo $total_available_room;
                if( $total_available_room >= $rooms){
                    $category = \DB::table('tb_properties_category_types')->where('property_id', $pid)->where('show_on_booking', 1)->where('status', 0)->get();
                    foreach($category as $si){
                        if($number_of_nights >= $si->minimum_stay){
                            if(count($new_result)>0){
                                if(array_key_exists($si->id, $new_result)){
                                    $no_of_room = $new_result[$si->id]->noOfRooms;
                                    if($no_of_room >= $rooms){
                                        
                                        $maximum_guest = $rooms * $si->total_guests;
                                        $total_guest = (int)$adults + (int)(($child=='') ? 0 : $child);
                                        if($maximum_guest >= $total_guest){
                                            $available["rooms"] = $new_result[$si->id]->noOfRooms;
                                            $available["cat_id"] = $si->id;
                                            $available["cat_name"] = $si->category_name;
                                            $available["max_guest"] = $si->total_guests;
                                            $available["guests_child"] = $si->guests_juniors;
                                            
                                            $roomfileArr1 = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.category_id', $si->id)->where('tb_properties_images.type', 'Rooms Images')->orderBy('tb_container_files.file_sort_num', 'asc')->get();
                                        
                                            if(!empty($roomfileArr1)) {
                                                $imgsrc = (new ContainerController)->getThumbpath($roomfileArr1[0]->folder_id);
                                                $available["img_url"] = $imgsrc.$roomfileArr1[0]->file_name;
                                            }  
                                            
                                            
                                            $query11 = "SELECT * FROM tb_properties_category_rooms_price inner join tb_seasons on tb_seasons.id=tb_properties_category_rooms_price.season_id inner join tb_seasons_dates on tb_seasons.id=tb_seasons_dates.season_id  where ((season_from_date <= '".$arrive_date."' AND season_to_date >='".$departure_date."') OR (season_from_date BETWEEN '".$arrive_date."' AND '".$departure_date."') OR  (season_to_date BETWEEN '".$arrive_date."' AND '".$departure_date."')) and tb_properties_category_rooms_price.category_id=".$si->id." ORDER by tb_seasons.season_priority";
                                            //echo $query11; die;
                                            $check_season = \DB::select($query11);
                                            //print_r($check_season); die;
                                            if(!empty($check_season)){
                                                //foreach($check_season as $si_sea){ 
                                                   $available["price"] = $check_season[0]->rack_rate;            
                                                //}
                                            }else{
                                                
                                                $query2 = "SELECT *, 'default' as season_name FROM tb_properties_category_rooms_price inner join tb_properties_category_rooms on tb_properties_category_rooms_price.category_id=tb_properties_category_rooms.category_id where active_full_year=1 and tb_properties_category_rooms_price.category_id=".$si->id." and tb_properties_category_rooms_price.season_id=0";
                                                $check_room = \DB::select($query2);
                                                //print_r($check_room); die;
                                                if(!empty($check_room)){
                                                     $available["price"] = $check_room[0]->rack_rate;      
                                                }
                                            }
                                             
                                            
                                            $available_cat[] = $available;
                                            $available_rooms[] = $available;
                                        }
                                    }
                                }
                            }
                        }        
                    }
                    //print_r($available_cat);die;
                    $guest_cap = 0;
                    $req_rooms = $rooms;
                    if(empty($available_cat)){
                        foreach($category as $si_cat){
                            if(array_key_exists($si_cat->id, $new_result)){
                                if($req_rooms > 0){
                                    if($req_rooms > $new_result[$si_cat->id]->noOfRooms){
                                        $guest_cap = (int)$guest_cap + (int)($new_result[$si_cat->id]->noOfRooms * $si_cat->total_guests);
                                        $req_rooms = $req_rooms - $new_result[$si_cat->id]->noOfRooms;
                                    }else{
                                        $guest_cap = (int)$guest_cap + (int)($req_rooms * $si_cat->total_guests);
                                        $req_rooms = $req_rooms - $new_result[$si_cat->id]->noOfRooms;
                                    }
                                }
                            }
                        }
                        if($guest_cap >=$total_guests ){
                            foreach($category as $si){
                                if($number_of_nights >= $si->minimum_stay){
                                    if(count($new_result)>0){
                                        if(array_key_exists($si->id, $new_result)){
                                            $available["rooms"] = $new_result[$si->id]->noOfRooms;
                                            $available["cat_id"] = $si->id;
                                            $available["cat_name"] = $si->category_name;
                                            $available["max_guest"] = $si->total_guests;
                                            $available["guests_child"] = $si->guests_juniors;
                                            
                                            $roomfileArr2 = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.category_id', $si->id)->where('tb_properties_images.type', 'Rooms Images')->orderBy('tb_container_files.file_sort_num', 'asc')->get();
                                            
                                            if(!empty($roomfileArr2)) {
                                                $imgsrc = (new ContainerController)->getThumbpath($roomfileArr2[0]->folder_id);
                                                $available["img_url"] = $imgsrc.$roomfileArr2[0]->file_name;
                                            }   
                                            
                                            $query22 = "SELECT * FROM tb_properties_category_rooms_price inner join tb_seasons on tb_seasons.id=tb_properties_category_rooms_price.season_id inner join tb_seasons_dates on tb_seasons.id=tb_seasons_dates.season_id  where ((season_from_date <= '".$arrive_date."' AND season_to_date >='".$departure_date."') OR (season_from_date BETWEEN '".$arrive_date."' AND '".$departure_date."') OR  (season_to_date BETWEEN '".$arrive_date."' AND '".$departure_date."')) and tb_properties_category_rooms_price.category_id=".$si->id." ORDER by tb_seasons.season_priority";
                                                //echo $query11; die;
                                                $check_season = \DB::select($query22);
                                                //print_r($check_season); die;
                                                if(!empty($check_season)){
                                                    //foreach($check_season as $si_sea){ 
                                                       $available["price"] = $check_season[0]->rack_rate;            
                                                    //}
                                                }else{
                                                    
                                                    $query2 = "SELECT *, 'default' as season_name FROM tb_properties_category_rooms_price inner join tb_properties_category_rooms on tb_properties_category_rooms_price.category_id=tb_properties_category_rooms.category_id where active_full_year=1 and tb_properties_category_rooms_price.category_id=".$si->id." and tb_properties_category_rooms_price.season_id=0";
                                                    $check_room = \DB::select($query2);
                                                    //print_r($check_room); die;
                                                    if(!empty($check_room)){
                                                         $available["price"] = $check_room[0]->rack_rate;      
                                                    }
                                                }
                                            
                                            $available_cat[] = $available;
                                            $available_rooms[] = $available;
                                        }
                                    }
                                }
                            }
                        }
                    }
                    $retun_array = array('status'=>'success', 'room_available'=>$available_cat); 
                }else{
                    $retun_array = array('status'=>'error', 'message'=>'Unfortunately we have no rooms available for you date range, Please change you dates or we can suggest the following hotels');
                }           
            }            
            else{
                
                
                //$query = "SELECT COUNT(tb_properties_category_rooms.id) as noOfRooms, tb_properties_category_rooms.category_id, tb_properties_category_types.total_guests, tb_properties_category_types.minimum_stay, tb_properties_category_types.category_name, tb_properties_category_rooms.property_id, tb_properties_category_rooms.category_id FROM tb_properties_category_rooms";
                //$query .= " inner join tb_properties_category_types on tb_properties_category_types.id=tb_properties_category_rooms.category_id";
                //$query .=" where 1=1 and (CASE WHEN tb_properties_category_rooms.active_full_year = 0 THEN ";
                //$query .="( tb_properties_category_rooms.room_active_from <= '".$arrive_date."' AND tb_properties_category_rooms.room_active_to >= '".$departure_date."')";
                //$query .=" ELSE tb_properties_category_rooms.active_full_year = 1 END) and tb_properties_category_rooms.property_id=".$pid." and tb_properties_category_rooms.category_id=".$roomType." GROUP BY category_id";
                $query = "SELECT COUNT(tb_properties_category_rooms.id) as noOfRooms, tb_properties_category_rooms.category_id, tb_properties_category_types.total_guests, tb_properties_category_types.minimum_stay, tb_properties_category_types.guests_juniors, tb_properties_category_types.category_name, tb_properties_category_rooms.property_id, tb_properties_category_rooms.category_id FROM tb_properties_category_rooms";
                $query .= " inner join tb_properties_category_types on tb_properties_category_types.id=tb_properties_category_rooms.category_id";
                $query .=" where 1=1 and ";
                $query .="( tb_properties_category_rooms.room_active_from <= '".$arrive_date."' AND tb_properties_category_rooms.room_active_to >= '".$departure_date."')";
                
                $query .=" and tb_properties_category_rooms.id not IN (select td_reserved_rooms.room_id from tb_reservations INNER join td_reserved_rooms on td_reserved_rooms.reservation_id=tb_reservations.id where '".$arrive_date."' BETWEEN checkin_date and checkout_date or '".$departure_date."' BETWEEN checkin_date and checkout_date)";
                
                $query .=" and tb_properties_category_rooms.property_id=".$pid." and tb_properties_category_rooms.category_id=".$roomType." GROUP BY category_id";
                //echo $query; die;
                $result = DB::SELECT($query)[0];
                //print_r($result); die;
                if(!empty($result)){                   
                    $total_available_room = (int) $total_available_room + (int) $result->noOfRooms;
                    if( $total_available_room >= $rooms){
                        if($number_of_nights >= $result->minimum_stay){
                            $maximum_guest = $rooms * $result->total_guests;
                            $total_guest = (int)$adults + (int)(($child=='') ? 0 : $child);
                            if($maximum_guest >= $total_guest){
                                $available["rooms"] = $result->noOfRooms; 
                                $available["cat_id"] = $result->category_id;                        
                                $available["cat_name"] = $result->category_name;
                                $available["max_guest"] = $result->total_guests;
                                $available["guests_child"] = $result->guests_juniors;
                                
                                $roomfileArr3 = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.category_id', $roomType)->where('tb_properties_images.type', 'Rooms Images')->orderBy('tb_container_files.file_sort_num', 'asc')->get();
                                        
                                if(!empty($roomfileArr3)) {
                                    $imgsrc = (new ContainerController)->getThumbpath($roomfileArr3[0]->folder_id);
                                    $available["img_url"] = $imgsrc.$roomfileArr3[0]->file_name;
                                }   
                                
                                $query33 = "SELECT * FROM tb_properties_category_rooms_price inner join tb_seasons on tb_seasons.id=tb_properties_category_rooms_price.season_id inner join tb_seasons_dates on tb_seasons.id=tb_seasons_dates.season_id  where ((season_from_date <= '".$arrive_date."' AND season_to_date >='".$departure_date."') OR (season_from_date BETWEEN '".$arrive_date."' AND '".$departure_date."') OR  (season_to_date BETWEEN '".$arrive_date."' AND '".$departure_date."')) and tb_properties_category_rooms_price.category_id=".$roomType." ORDER by tb_seasons.season_priority";
                                //echo $query11; die;
                                $check_season = \DB::select($query33);
                                //print_r($check_season); die;
                                if(!empty($check_season)){
                                    //foreach($check_season as $si_sea){ 
                                       $available["price"] = $check_season[0]->rack_rate;            
                                    //}
                                }else{
                                    
                                    $query2 = "SELECT *, 'default' as season_name FROM tb_properties_category_rooms_price inner join tb_properties_category_rooms on tb_properties_category_rooms_price.category_id=tb_properties_category_rooms.category_id where active_full_year=1 and tb_properties_category_rooms_price.category_id=".$roomType." and tb_properties_category_rooms_price.season_id=0";
                                    $check_room = \DB::select($query2);
                                    //print_r($check_room); die;
                                    if(!empty($check_room)){
                                         $available["price"] = $check_room[0]->rack_rate;      
                                    }
                                }
                                
                                $available_cat[] = $available;
                                $available_rooms[] = $available;
                            }
                            $retun_array = array('status'=>'success', 'room_available'=>$available_cat);
                        } 
                    }else{
                        $retun_array = array('status'=>'error', 'message'=>'Unfortunately we have no rooms available for you date range, Please change you dates or we can suggest the following hotels');
                    }
                    
                }else{
                    $retun_array = array('status'=>'error', 'message'=>'Unfortunately we have no rooms available for you date range, Please change you dates or we can suggest the following hotels');
                }     
                          
            }     
            //echo $booking_children; die;   
            //echo json_encode($retun_array);
            //echo "<pre>";
            //print_r($available_rooms);
            usort($available_rooms, function($a, $b) {
               //echo($a['price']); echo($b['price']); die;
			   return (float)$a['price'] < (float)$b['price'];
		    });
            //print_r($available_rooms); die;
            $this->data['pid'] = $pid;
            $this->data['arrive'] = $arrive;
            $this->data['arrive_new'] = \CommonHelper::dateformat(trim($arrive));
            $this->data['departure'] = $departure;
            $this->data['departure_new'] = \CommonHelper::dateformat(trim($departure));
            $this->data['booking_rooms'] = $booking_rooms;
            $this->data['booking_adults'] = $booking_adults;
            $this->data['booking_children'] = $booking_children;
            $this->data['travellerType'] = $travellerType;
            $this->data['roomType'] = $roomType;
            $this->data['child_age'] = $child_age;
            
            $this->data['currency'] = \DB::table('tb_settings')->select('content')->where('key_value', 'default_currency')->first();       
            $this->data['propertyDetail'] = $propertiesArr;
            $this->data['relatedgridpropertiesArr'] = $relatedgridpropertiesArr;
            $this->data['roomavailability'] = $available_rooms;
            return view('frontend.themes.emporium.properties.roomavailability', $this->data);
        }else{            
            return response(view('errors.403'), 403);           
        }
    }
    
    private function getThumbpath($id)
	{
		$fpath = \URL::to('uploads/container_user_files').'/';
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
    
    private function fetchFolderParentList($id = 0, $parent_folders_array = '') {
 
		if (!is_array($parent_folders_array))
		$parent_folders_array = array();
	
		$filter = " AND id='".$id."'";
		
		$params = array(
			'params'	=> $filter,
			'order'		=> 'asc'
		);
		// Get Query 
        $ttmodel = new Container();
		$results = $ttmodel->getRows( $params );
	  if ($results) {
		foreach($results['rows'] as $row) {
			$parent_folders_array[] = $row->name;
			$parent_folders_array = $this->fetchFolderParentList($row->parent_id, $parent_folders_array);
		}
	  }
	  return $parent_folders_array;
	}
    
    function propertySearchAvailability(Request $request) {
        $membershiptype =  $request->membershiptype;
        $keyword = '';
        $show = 'asc';        

		$this->data['dateslug'] = '';
		$arrive = $departure = $adult = $childs = '';
        $arrive_new = $departure_new = '';
		if (!is_null($request->arrive) && $request->arrive != '') {
			\Session::put('arrive', $request->arrive);
			$this->data['arrive_date'] = $request->arrive;
			$this->data['dateslug'] = $request->arrive;
			$arrive = date("Y-m-d", strtotime(trim($request->arrive)));
            $arrive_new = \CommonHelper::dateformat(trim($request->arrive));
		}
		if (!is_null($request->departure) && $request->departure != '') {
			\Session::put('departure', $request->departure);
			$this->data['departure_date'] = $request->departure;
			$this->data['dateslug'] = $this->data['dateslug'].' to '.$request->departure;
			$departure = date("Y-m-d", strtotime(trim($request->departure)));
            $departure_new = \CommonHelper::dateformat(trim($request->departure));
		}
		
        /* Default package */
        $pckages_ids = '';
        $default_package = '';
        
        $public_package = \DB::table('tb_packages')->select('id')->where('package_category', 'B2C')->where('is_public', 1)->first();
        if(!empty($public_package)){
            $pckages_ids = $public_package->id;            
        } 
        
        if($membershiptype!=''){
            if($membershiptype!='lifestyle-collection'){
                $exp_membership = explode('-', $membershiptype);
                if(!empty($exp_membership)){
                    $_type = $exp_membership[0];
                    if($_type=='dedicated'){
                        $mem_package = \DB::table('tb_packages')->select('id')->where('package_title', 'Dedicated Membership')->first();
                        $pckages_ids = $mem_package->id;   
                    }else if($_type=='bespoke'){
                        $mem_package = \DB::table('tb_packages')->select('id')->where('package_title', 'Bespoke Membership')->first();
                        $pckages_ids = $mem_package->id;  
                    }
                }
                $public_package = \DB::table('tb_packages')->select('id')->where('package_category', 'B2C')->where('is_public', 1)->first();
            }
        }else{
            if (\Auth::check() == true) {
                if(\Auth::user()->group_id!=1){
                    $uid = \Auth::user()->id;
                    $memtype = str_replace('-', ' ', \Auth::user()->member_type); 
                    $arr_membershiptype = explode('-', \Auth::user()->member_type); 
                    if(count($arr_membershiptype)>0){
                        $membershiptype = $arr_membershiptype[0]."-collection";    
                    }    
                    //print_r($membershiptype);      
                    $mem_package = \DB::table('tb_packages')->select('id')->where('package_title', $memtype)->first();
                    //print_r($mem_package); die;  
                    $pckages_ids = $mem_package->id;    
                }
            }            
        }
        
        $m_collection = \DB::table('tb_categories')->where('category_alias', 'our-collection')->where('category_approved', 1)->where('category_published', 1)->first();   
        $cat_collection = array();                
        if(!empty($m_collection)){
            $cat_collection = \DB::table('tb_categories')->where('parent_category_id', $m_collection->id)->where('category_approved', 1)->where('category_published', 1)->orderBy('category_order_num', 'asc')->get();
        }
        $this->data['collections'] = $cat_collection;
        
        $this->data['default_package'] = $default_package;        
		$this->data['slug'] = $keyword;
		$this->data['destination_category'] =0;       
        $this->data['m_type'] = ($membershiptype !='' ? $membershiptype : 'lifestyle-collection');
		return view('frontend.themes.emporium.properties.searchavailabilitylist', $this->data);                    
    }
    
    function propertySearchAvailability_old(Request $request) { 
        $keyword = '';
        $show = 'asc';        

		$this->data['dateslug'] = '';
		$arrive = $departure = $adult = $childs = '';
        $arrive_new = $departure_new = '';
		if (!is_null($request->arrive) && $request->arrive != '') {
			\Session::put('arrive', $request->arrive);
			$this->data['arrive_date'] = $request->arrive;
			$this->data['dateslug'] = $request->arrive;
			$arrive = date("Y-m-d", strtotime(trim($request->arrive)));
            $arrive_new = \CommonHelper::dateformat(trim($request->arrive));
		}
		if (!is_null($request->departure) && $request->departure != '') {
			\Session::put('departure', $request->departure);
			$this->data['departure_date'] = $request->departure;
			$this->data['dateslug'] = $this->data['dateslug'].' to '.$request->departure;
			$departure = date("Y-m-d", strtotime(trim($request->departure)));
            $departure_new = \CommonHelper::dateformat(trim($request->departure));
		}
		
		$perPage = 20;
		$pageNumber = 1;
		if(isset($request->page) && $request->page>0){
			$pageNumber = $request->page;
		}
		$pageStart = ($pageNumber -1) * $perPage;
		
        $query = "Select pr.editor_choice_property,pr.property_usp,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,0 as price  ";
        $query .= " FROM tb_properties_category_rooms pcr INNER JOIN tb_properties pr ON pr.id = pcr.property_id ";
        $query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
        $whereClause =" WHERE 1=1 AND pr.property_status = 1 AND  pr.feature_property = 0 AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ";
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
		$whereClause =" WHERE 1=1 AND pr.property_status = 1 AND  pr.feature_property = 1 AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ";
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
		$whereClause =" WHERE 1=1 AND pr.property_status = 1 AND  pr.editor_choice_property = 1 AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ";
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
        /*$emtional_parentFolder = \DB::table('tb_container')->select('id')->where('name','emotion-gallery')->first();
        if(isset($emtional_parentFolder->id)){
            $peid = (int) $emtional_parentFolder->id;
            $emtional_containerfiles = \DB::table('tb_container')->select('tb_container_files.id','tb_container_files.file_name','tb_container_files.folder_id','tb_container.name')->join('tb_container_files','tb_container_files.folder_id','=','tb_container.id')->where('parent_id',$peid)->where('name',$keyword)->orderby('tb_container_files.file_sort_num','asc')->get();
            if((!empty($emtional_containerfiles)) && (is_array($emtional_containerfiles))){$emotional_gallery_array = $emtional_containerfiles;}
        }*/
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

		return view('frontend.themes.emporium.properties.searchavailabilitylist', $this->data);
                    
    }
    
    function checkPropertyPackage($propid){
        //$propid=46;
        $flag = true;
        $prop_package = array();
        if($propid > 0){
            $prop_package = \DB::table('tb_properties_category_package')->join("tb_packages", "tb_packages.id", "=", "tb_properties_category_package.package_id")->where('property_id', $propid)->first();
            $package_type = trim($prop_package->package_title);             
            $package_type = strtolower(str_replace(' ', '-', trim($package_type)));
            //print_r($package_type); die;
            if($package_type!='lifestyle-membership'){
                if (\Auth::check()){
                    if(\Auth::user()->group_id!=1){
                        $obj_user =  \DB::table('tb_users')->where('id', \Auth::user()->id)->first();
                        
                        if(!empty($obj_user)){
                            if($obj_user->member_type!=''){
                                $member_type = trim($obj_user->member_type);
                            }else{
                                $member_type = 'lifestyle-membership';
                            }
                        //print_r($package_type);
                        //print_r($member_type); die;
                            if($package_type!=$member_type){
                                $flag = false;
                            }
                        }
                    }
                }else{
                    $flag = false;
                }
            }
        }
        return $flag;
        //print_r($prop_package);
    }
    
    function propertyglobalavailability(Request $request) {       
        $coll_type = $request->input("coll_type");
        $coll_where = $request->input("coll_where");       
        $arrive = $request->input("gl_arrive");
        if($arrive!=''){
            $arrive = $request->input("gl_arrive");    
        }else{
            $arrive = date('m-d-Y');    
        }
        $departure = $request->input("gl_departure");
        if($departure!=''){
            $departure = $request->input("gl_departure");    
        }else{
            $departure = date('m-d-Y',strtotime("+1 day"));
        }
        
        
        $rooms = $request->input('rooms');
        $adults = $request->input('adult');
        $childs = $request->input('child');        
        
        $rac = '';
        if(count($rooms)>0){
            for($j=0; $j<count($rooms); $j++){                
                $rac .= 'r'.$j.'a'.$adults[$j].'c'.$childs[$j];
            }
        }
        
        $sitename = $request->input("sitename");        
        
        $site_url = '';
        if($sitename=='voyage'){
            //$site_url = 'https://emporium-voyage.com';              
            $site_url = 'http://staging.emporium-voyage.com';
        }elseif($sitename=='safari'){
            $site_url = 'https://emporium-safari.com';
        }elseif($sitename=='spa'){
            $site_url = 'https://emporium-spa.com'; 
        }elseif($sitename=='islands'){
            $site_url = 'https://emporium-islands.com';
        }
                
        $querry_string = $site_url."/globalsearchavailability?s=".$coll_where."&arrive=".$arrive."&departure=".$departure."&type=".$coll_type."&rac=".$rac;       
        
        return Redirect::to($querry_string); 
    }
    
    function propertyglobalavailability_20082020(Request $request) {
        print_r($request->all() ); die;
        //$ourHotels = $request->input("ourHotels");
        //$ourDestinations = $request->input("ourDestinations");
        $str_hotels = $request->input("hid_our_hotels");
        $str_destinations = $request->input("hid_our_destinations");
        
        
        //print_r($request->all()); die;
        
        $arrive = $request->input("gl_arrive");
        if($arrive!=''){
            $arrive = $request->input("gl_arrive");    
        }else{
            $arrive = date('m-d-Y');    
        }
        $departure = $request->input("gl_departure");
        if($departure!=''){
            $departure = $request->input("gl_departure");    
        }else{
            $departure = date('m-d-Y',strtotime("+1 day"));
        }
        $alternate_dates = $request->input('alternate_dates');
        $numberofdate = $request->input('numberofdate');
        
        $booking_rooms = $request->input('booking_rooms');
        $booking_adults = $request->input('booking_adults');
        $booking_children = $request->input('booking_children');
        $roomType = $request->input('roomType');
        $travellerType = $request->input('travellerType');
        
        $child_age = $request->input('childrenAge');
        
        $tr_2_rooms = $request->input('tr_2_rooms');
        $tr_2_adults = $request->input('tr_2_adults');
        $tr_2_child = $request->input('tr_2_child');
        $child_2_ages = array();
        
        if($tr_2_child != ''){ 
            if($tr_2_child >0 ){  
                for($k=0; $tr_2_child > $k; $k++){  
                   // echo 'tr_2_ca_'.$k;
                   //echo $request->input('tr_2_ca_'.$k);
                   $child_2_ages[] = $request->input('tr_2_ca_'.$k);  
                }
            }
        }
        //print_r($child_2_ages); die;
        $tr_3_rooms = $request->input('tr_3_rooms');
        $tr_3_adults = $request->input('tr_3_adults');
        $tr_3_child = $request->input('tr_3_child');
        $child_3_ages = array();
        
        if($tr_3_child != ''){
            if($tr_3_child >0 ){
                for($k=0; $tr_3_child > $k; $k++){
                   $child_3_ages[] = $request->input('tr_3_ca_'.$k);  
                }
            }
        }
        $tr_4_rooms = $request->input('tr_4_rooms');
        $tr_4_adults = $request->input('tr_4_adults');
        
        $child_age = array();
        if($travellerType==2 || $travellerType==3){
            if($booking_children > 0){
                for($i=1; $i <=$booking_children; $i++){
                    $child_age[] = $request->input('child_'.$travellerType."_".$i);
                }
            }
        }
        
        $sitename = $request->input("sitename");
        
        //$ourCollections = $request->input("ourCollections"); 
        
        
        //$ourExperiences = $request->input("ourExperiences");
        //$ourChannels = $request->input("ourChannels");        
        
        /*$arr_hotels = is_array($ourHotels) ? $ourHotels : array();
        $arr_destinations = is_array($ourDestinations) ? $ourDestinations : array();
        $str_hotels = '';
        if(!empty($arr_hotels)){
            $str_hotels = implode(',', $arr_hotels); 
        }
        
        $str_destinations = '';
        if(!empty($arr_destinations)){
            $str_destinations = implode(',', $arr_destinations);  
        }*/        
        
        $site_url = '';
        if($sitename=='voyage'){
            //$site_url = 'https://emporium-voyage.com';
            $site_url = 'http://localhost:8181/emporium-staging-forge/public'; 
            //$site_url = 'http://staging.emporium-voyage.com';  
        }elseif($sitename=='safari'){
            $site_url = 'https://emporium-safari.com';
        }elseif($sitename=='spa'){
            $site_url = 'https://emporium-spa.com'; 
        }elseif($sitename=='islands'){
            $site_url = 'https://emporium-islands.com';
        }
        //echo($arrive);
        //print_r($site_url); die;
        $querry_string = $site_url."/globalsearchavailability?arrive=".$arrive."&departure=".$departure."&hotels=".$str_hotels."&destinations=".$str_destinations."&booking_rooms=".$booking_rooms."&booking_adults=".$booking_adults."&booking_children=".$booking_children."&travellerType=".$travellerType."&childrenAge=&tr_2_rooms=".$tr_2_rooms."&tr_2_adults=".$tr_2_adults."&tr_2_child=".$tr_2_child."&tr_3_rooms=".$tr_3_rooms."&tr_3_adults=".$tr_3_adults."&tr_3_child=".$tr_3_child."&tr_4_rooms=".$tr_4_rooms."&tr_4_adults=".$tr_4_adults;
        
        //room-availability?property=69&arrive=07-11-2019&departure=07-20-2019&booking_rooms=1&booking_adults=1&travellerType=0&childrenAge=&tr_2_rooms=1&tr_2_adults=1&tr_2_child=1&tr_3_rooms=1&tr_3_adults=1&tr_3_child=1&tr_4_rooms=1&tr_4_adults=1&roomType=0
        
        return Redirect::to($querry_string); 
    }
    
    function globalsearchavailability(Request $request) {       
        $keyword = $request->input('s');
        $type = $request->input('type');        
        $arrive = $request->input('arrive');
        $departure = $request->input('departure');
        
        $arrive_date = '';
        if($arrive!=''){ 
            $arrive_date =  \CommonHelper::dateformat(trim($arrive));
        }        
        $departure_date ='';
        if($departure!=''){ 
            $departure_date =  \CommonHelper::dateformat(trim($departure));;
        }        
        
        $rooms = array();
        $adults = array();
        $childs = array();
        $total_guests = 0;
        $rac = $request->input('rac');
        if(strlen($rac)>0){
            $rac_arr = explode('r', $rac);
            if(count($rac_arr)>0){
                foreach($rac_arr as $rsp){
                    if(!empty($rsp)){
                        $rac_ad = explode('a', $rsp);
                        if(count($rac_ad)>0){
                            $rooms[] = $rac_ad[0];
                            $restac = $rac_ad[1];
                            //print_r($rac_ad);                        
                            $rac_ac_arr = explode('c', $restac);
                            if(count($rac_ac_arr)>1){                       
                                $adults[] = $rac_ac_arr[0];
                                $childs[] =  $rac_ac_arr[1];
                                $total_guests += ((int) $rac_ac_arr[0] + (int) $rac_ac_arr[1]);  
                            }
                        }                    
                    }
                }
            }
        }
        //print_r($keyword);
//        print_r($type); 
//        print_r($arrive_date);
//        print_r($departure_date);
//        print_r($total_guests);
//        print_r($childs);
//        print_r($adults);
//        print_r($rooms);        
        
        //Get Number of night
        $number_of_nights = '';
        if($arrive != '' && $departure != '') {
            $date1 = date_create(date('Y-m-d H:i:s', strtotime($departure)));
            $date2 = date_create(date('Y-m-d H:i:s', strtotime($arrive)));
            $diff = date_diff($date1, $date2);
            $number_of_nights = $diff->format("%a");            
        }        
        //$this->data['active_tab'] = $active_tab;
        //$this->data['allData'] = $allData;
        //$this->data['hotels'] = $hotels;
        //$this->data['destinations'] = $destinations;
        
        $this->data['keyword'] = $keyword;
        $this->data['type'] = $type;
        $this->data['arrive'] = $arrive;
        $this->data['departure'] = $departure;
        $this->data['arrive_date'] = $arrive_date;
        $this->data['departure_date'] = $departure_date;
        $this->data['total_guests'] = $total_guests;
        $this->data['rooms'] = $rooms;
        $this->data['adults'] = $adults;
        $this->data['childs'] = $childs;
        $this->data['number_of_nights'] = $number_of_nights;
        
        return view('frontend.themes.EC.properties.globalsearchavailability', $this->data);
                    
    }
    
    function globalsearchavailability_18082020(Request $request) {
        $allData = array();
        $hotels = $request->input('hotels');
        $destinations = $request->input('destinations');
        
        $arrive = $request->input('arrive');
        $departure = $request->input('departure');
        
        $arrive_date = '';
        if($arrive!=''){ 
            $arrive_date =  \CommonHelper::dateformat(trim($arrive));
        }
        
        $departure_date ='';
        if($departure!=''){ 
            $departure_date =  \CommonHelper::dateformat(trim($departure));;
        }
        
        
        $booking_rooms = $request->input('booking_rooms');
        $booking_adults = $request->input('booking_adults');
        $booking_children = $request->input('booking_children');
        $roomType = $request->input('roomType');
        $travellerType = $request->input('travellerType');
        
        $child_age = $request->input('childrenAge');
        
        $tr_2_rooms = $request->input('tr_2_rooms');
        $tr_2_adults = $request->input('tr_2_adults');
        $tr_2_child = $request->input('tr_2_child');
        $child_2_ages = array();
        
        if($tr_2_child != ''){ 
            if($tr_2_child >0 ){  
                for($k=0; $tr_2_child > $k; $k++){  
                   // echo 'tr_2_ca_'.$k;
                   //echo $request->input('tr_2_ca_'.$k);
                   $child_2_ages[] = $request->input('tr_2_ca_'.$k);  
                }
            }
        }
        //print_r($child_2_ages); die;
        $tr_3_rooms = $request->input('tr_3_rooms');
        $tr_3_adults = $request->input('tr_3_adults');
        $tr_3_child = $request->input('tr_3_child');
        $child_3_ages = array();
        
        if($tr_3_child != ''){
            if($tr_3_child >0 ){
                for($k=0; $tr_3_child > $k; $k++){
                   $child_3_ages[] = $request->input('tr_3_ca_'.$k);  
                }
            }
        }
        $tr_4_rooms = $request->input('tr_4_rooms');
        $tr_4_adults = $request->input('tr_4_adults');
        
        $child_age = array();
        if($travellerType==2 || $travellerType==3){
            if($booking_children > 0){
                for($i=1; $i <=$booking_children; $i++){
                    $child_age[] = $request->input('child_'.$travellerType."_".$i);
                }
            }
        }
        //print_r($child_age); die;
        //echo $pid."-".$arrive."-".$departure."-".$booking_rooms."-".$booking_adults."-".$booking_children."-".$roomType; die;
        
        $HotelDataArr = array();
        $DestinationDataArr = array();
        		
		$relatedgridpropertiesArr = array();
        $this->data['slug'] = rtrim($request->slug,'-');
        $arr_hotels = array();
        if($hotels!=''){
            \Session::put('hotels', $hotels);
            $arr_hotels = explode(',', $hotels);    
        }
        $arr_destinations = array();
        if($destinations!=''){
            \Session::put('destinations', $destinations);
            $arr_destinations = explode(',', $destinations);    
        }
        
        //print_r($arr_hotels);
        //print_r($arr_destinations);
        //die;
        
        $props = array();
        if(!empty($arr_hotels)){            
            
            $props = \DB::table('tb_properties')->select('tb_properties.*')->join('tb_properties_category_package','tb_properties_category_package.property_id','=','tb_properties.id')->whereIn('property_name', $arr_hotels)->get();
            //print_r($props);
            
        }  
        
        if(!empty($props)){            
            foreach($props as $sin){
                $query = "SELECT COUNT(id) as noOfRooms, property_id, category_id FROM tb_properties_category_rooms where 1=1";
                if($arrive_date!='' and $departure_date!=''){
                    $query .=" and (CASE WHEN tb_properties_category_rooms.active_full_year = 0 THEN ";
                    $query .="( tb_properties_category_rooms.room_active_from <= '".$arrive_date."' AND tb_properties_category_rooms.room_active_to >= '".$departure_date."')";
                    $query .=" ELSE tb_properties_category_rooms.active_full_year = 1 END) "; 
                                           
                    $query .=" and tb_properties_category_rooms.id not IN (select td_reserved_rooms.room_id from tb_reservations INNER join td_reserved_rooms on td_reserved_rooms.reservation_id=tb_reservations.id where '".$arrive_date."' BETWEEN checkin_date and checkout_date or '".$departure_date."' BETWEEN checkin_date and checkout_date)";
                }                
                $query .=" and property_id=".$sin->id." GROUP BY category_id";
                    
                $result = DB::SELECT($query);    
            }            
        } 
        
          
        //$props = \DB::table('tb_properties')->select('tb_properties.*')->join('tb_properties_category_package','tb_properties_category_package.property_id','=','tb_properties.id')->whereIn('tb_properties_category_package.package_id', explode(',',$this->pckages_ids))->whereRaw("TRIM(TRAILING '-' FROM property_slug ) = ?", [$this->data['slug']])->first();
        
        //$query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
        if (!empty($props)) {
            $propertiesArr['hoteldata'] = $props;
            
        //$props = \DB::table('tb_properties')->where('id', $pid)->first();
        }        
        $arrive_date = '';
        
        if (!is_null($arrive) && $arrive != '' && $arrive != 'null') {
            \Session::put('arrive', $arrive);
            $arrive_date = \CommonHelper::dateformat(trim($arrive));
        }
        $this->data['arrive_date']=$arrive_date;
        
        $departure_date ='';
        if (!is_null($departure) && $departure != '' && $departure != 'null') {
            \Session::put('departure', $departure);
            $departure_date = \CommonHelper::dateformat(trim($departure));
        }
        $this->data['departure'] = $departure_date;
        //echo Session::get('arrive'); die;
        $rooms = ''; 
        $adults = '';
        $child = ''; 
        if (!is_null($booking_rooms) && $booking_rooms != '') {    
            \Session::put('booking_rooms', $booking_rooms);
            $rooms = $booking_rooms;
        }          
        if (!is_null($booking_adults) && $booking_adults != '') {
            \Session::put('booking_adults', $booking_adults);
            $adults = $booking_adults;
        }        
        if (!is_null($booking_children) && $booking_children != '') {
            \Session::put('booking_children', $booking_children);
            $child = $booking_children;            
        }else{
            \Session::put('booking_children', 0);
        }
        if ($travellerType != '') { 
            \Session::put('travellerType', $travellerType);                       
        }
        if($tr_2_rooms!=''){
            \Session::put('tr_2_rooms', $tr_2_rooms);
        }
        if($tr_2_adults!=''){
            \Session::put('tr_2_adults', $tr_2_adults);
        }
        if($tr_2_child!=''){
            \Session::put('tr_2_child', $tr_2_child);
        }
        
        if($tr_3_rooms!=''){
            \Session::put('tr_3_rooms', $tr_3_rooms);
        }
        if($tr_3_adults!=''){
            \Session::put('tr_3_adults', $tr_3_adults);
        }
        if($tr_3_child!=''){
            \Session::put('tr_3_child', $tr_3_child);
        }
        
        if($tr_4_rooms!=''){
            \Session::put('tr_4_rooms', $tr_4_rooms);
        }
        if($tr_4_adults!=''){
            \Session::put('tr_4_adults', $tr_4_adults);
        }
        if(!empty($child_2_ages)){
            \Session::put('child_2_ages', $child_2_ages);
        }
        if(!empty($child_3_ages)){
            \Session::put('child_3_ages', $child_3_ages);
        }
        
        //print_r($child_3_ages); die;
        
        //Get Total guest
        $total_guests = (int)$adults + (int)(($child=='') ? 0 : $child);
        //End Toatal Guest
        //Get Number of night
        $number_of_nights = '';
        if($arrive_date != '' && $departure_date != '') {
            $date1 = date_create(date('Y-m-d H:i:s', strtotime($departure_date)));
            $date2 = date_create(date('Y-m-d H:i:s', strtotime($arrive_date)));
            $diff = date_diff($date1, $date2);
            $number_of_nights = $diff->format("%a");            
        }
        //End Number of night
        //print_r($total_guests); die;
        
        $m_collection = \DB::table('tb_categories')->where('category_alias', 'our-collection')->first();   
        $cat_collection = array();                
        if(!empty($m_collection)){
            $cat_collection = \DB::table('tb_categories')->where('parent_category_id', $m_collection->id)->where('category_approved', 1)->where('category_published', 1)->orderBy('category_order_num', 'asc')->get();
        }
        $this->data['collections'] = $cat_collection;
        
        $result = array();
        $new_result = array();
        $available_cat = array();
        $available_rooms = array();
        $total_available_room = 0;
        $flag = 0;
        
        
        $this->data['arrive'] = $arrive;
        $this->data['arrive_new'] = \CommonHelper::dateformat(trim($arrive));
        $this->data['departure'] = $departure;
        $this->data['departure_new'] = \CommonHelper::dateformat(trim($departure));
        $this->data['booking_rooms'] = $booking_rooms;
        $this->data['booking_adults'] = $booking_adults;
        $this->data['booking_children'] = $booking_children;
        $this->data['travellerType'] = $travellerType;
        $this->data['roomType'] = $roomType;
        $this->data['child_age'] = $child_age;
        
        $this->data['tr_2_rooms'] = $tr_2_rooms;
        $this->data['tr_2_adults'] = $tr_2_adults;
        $this->data['tr_2_child'] = $tr_2_child;
        $this->data['tr_3_rooms'] = $tr_3_rooms;
        $this->data['tr_3_adults'] = $tr_3_adults;        
        $this->data['tr_3_child'] = $tr_3_child;
        $this->data['tr_4_rooms'] = $tr_4_rooms;
        $this->data['tr_4_adults'] = $tr_4_adults;
        
        
        $this->data['currency'] = \DB::table('tb_settings')->select('content')->where('key_value', 'default_currency')->first();       
        $this->data['propertyDetail'] = $HotelDataArr;
        $this->data['relatedgridpropertiesArr'] = $relatedgridpropertiesArr;
        
        $membershiptype = '';
        
        $this->data['m_type'] = ($membershiptype !='' ? $membershiptype : 'lifestyle-collection');
        
        if($hotels!=''){
            $allData[] = array('name'=>'Hotel', 'ddSelected'=>$arr_hotels); 
        }
        if($destinations!=''){
            $allData[] = array('name'=>'Destination', 'ddSelected'=>$arr_destinations); 
        }
        $active_tab = '';
        if($hotels!=''){
            $active_tab = "hotel";    
        }elseif($destinations!=''){
            $active_tab = "destination";    
        }
        $this->data['active_tab'] = $active_tab;
        $this->data['allData'] = $allData;
        $this->data['hotels'] = $hotels;
        $this->data['destinations'] = $destinations;
        
        return view('frontend.themes.emporium.properties.globalsearchavailability', $this->data);
                    
    }
    
    
    function globalsearchavailability_old(Request $request) {
        $allData = array();
        $hotels = $request->input('hotels');
        $destinations = $request->input('destinations');
        
        $arrive = $request->input('arrive');
        $departure = $request->input('departure');
        $booking_rooms = $request->input('booking_rooms');
        $booking_adults = $request->input('booking_adults');
        $booking_children = $request->input('booking_children');
        $roomType = $request->input('roomType');
        $travellerType = $request->input('travellerType');
        
        $child_age = $request->input('childrenAge');
        
        $tr_2_rooms = $request->input('tr_2_rooms');
        $tr_2_adults = $request->input('tr_2_adults');
        $tr_2_child = $request->input('tr_2_child');
        $child_2_ages = array();
        
        if($tr_2_child != ''){ 
            if($tr_2_child >0 ){  
                for($k=0; $tr_2_child > $k; $k++){  
                   // echo 'tr_2_ca_'.$k;
                   //echo $request->input('tr_2_ca_'.$k);
                   $child_2_ages[] = $request->input('tr_2_ca_'.$k);  
                }
            }
        }
        //print_r($child_2_ages); die;
        $tr_3_rooms = $request->input('tr_3_rooms');
        $tr_3_adults = $request->input('tr_3_adults');
        $tr_3_child = $request->input('tr_3_child');
        $child_3_ages = array();
        
        if($tr_3_child != ''){
            if($tr_3_child >0 ){
                for($k=0; $tr_3_child > $k; $k++){
                   $child_3_ages[] = $request->input('tr_3_ca_'.$k);  
                }
            }
        }
        $tr_4_rooms = $request->input('tr_4_rooms');
        $tr_4_adults = $request->input('tr_4_adults');
        
        $child_age = array();
        if($travellerType==2 || $travellerType==3){
            if($booking_children > 0){
                for($i=1; $i <=$booking_children; $i++){
                    $child_age[] = $request->input('child_'.$travellerType."_".$i);
                }
            }
        }
        //print_r($child_age); die;
        //echo $pid."-".$arrive."-".$departure."-".$booking_rooms."-".$booking_adults."-".$booking_children."-".$roomType; die;
        
        $HotelDataArr = array();
        $DestinationDataArr = array();
        		
		$relatedgridpropertiesArr = array();
        $this->data['slug'] = rtrim($request->slug,'-');
        $arr_hotels = array();
        if($hotels!=''){
            $arr_hotels = explode(',', $hotels);    
        }
        $props = array();
        if(!empty($arr_hotels)){            
            
            $props = \DB::table('tb_properties')->select('tb_properties.*')->join('tb_properties_category_package','tb_properties_category_package.property_id','=','tb_properties.id')->whereIn('property_name', $arr_hotels)->get();
            //print_r($props);
            
        }  
          
        //$props = \DB::table('tb_properties')->select('tb_properties.*')->join('tb_properties_category_package','tb_properties_category_package.property_id','=','tb_properties.id')->whereIn('tb_properties_category_package.package_id', explode(',',$this->pckages_ids))->whereRaw("TRIM(TRAILING '-' FROM property_slug ) = ?", [$this->data['slug']])->first();
        
        //$query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
        if (!empty($props)) {
            $propertiesArr['hoteldata'] = $props;
            
        //$props = \DB::table('tb_properties')->where('id', $pid)->first();
        }        
        $arrive_date = '';
        
        if (!is_null($arrive) && $arrive != '' && $arrive != 'null') {
            \Session::put('arrive', $arrive);
            $arrive_date = \CommonHelper::dateformat(trim($arrive));
        }
        $this->data['arrive_date']=$arrive_date;
        
        $departure_date ='';
        if (!is_null($departure) && $departure != '' && $departure != 'null') {
            \Session::put('departure', $departure);
            $departure_date = \CommonHelper::dateformat(trim($departure));
        }
        $this->data['departure'] = $departure_date;
        //echo Session::get('arrive'); die;
        $rooms = ''; 
        $adults = '';
        $child = ''; 
        if (!is_null($booking_rooms) && $booking_rooms != '') {    
            \Session::put('booking_rooms', $booking_rooms);
            $rooms = $booking_rooms;
        }          
        if (!is_null($booking_adults) && $booking_adults != '') {
            \Session::put('booking_adults', $booking_adults);
            $adults = $booking_adults;
        }        
        if (!is_null($booking_children) && $booking_children != '') {
            \Session::put('booking_children', $booking_children);
            $child = $booking_children;            
        }else{
            \Session::put('booking_children', 0);
        }
        if ($travellerType != '') { 
            \Session::put('travellerType', $travellerType);                       
        }
        if($tr_2_rooms!=''){
            \Session::put('tr_2_rooms', $tr_2_rooms);
        }
        if($tr_2_adults!=''){
            \Session::put('tr_2_adults', $tr_2_adults);
        }
        if($tr_2_child!=''){
            \Session::put('tr_2_child', $tr_2_child);
        }
        
        if($tr_3_rooms!=''){
            \Session::put('tr_3_rooms', $tr_3_rooms);
        }
        if($tr_3_adults!=''){
            \Session::put('tr_3_adults', $tr_3_adults);
        }
        if($tr_3_child!=''){
            \Session::put('tr_3_child', $tr_3_child);
        }
        
        if($tr_4_rooms!=''){
            \Session::put('tr_4_rooms', $tr_4_rooms);
        }
        if($tr_4_adults!=''){
            \Session::put('tr_4_adults', $tr_4_adults);
        }
        if(!empty($child_2_ages)){
            \Session::put('child_2_ages', $child_2_ages);
        }
        if(!empty($child_3_ages)){
            \Session::put('child_3_ages', $child_3_ages);
        }
        //print_r($child_3_ages); die;
        
        //Get Total guest
        $total_guests = (int)$adults + (int)(($child=='') ? 0 : $child);
        //End Toatal Guest
        //Get Number of night
        $number_of_nights = '';
        if($arrive_date != '' && $departure_date != '') {
            $date1 = date_create(date('Y-m-d H:i:s', strtotime($departure_date)));
            $date2 = date_create(date('Y-m-d H:i:s', strtotime($arrive_date)));
            $diff = date_diff($date1, $date2);
            $number_of_nights = $diff->format("%a");            
        }
        //End Number of night
        //print_r($total_guests); die;
        $result = array();
        $new_result = array();
        $available_cat = array();
        $available_rooms = array();
        $total_available_room = 0;
        $flag = 0;
        if (!empty($props)) {
            
            foreach($props as $prop){ //print_r($prop); die;
                $propertiesArr = array();
                $propertiesArr['data'] = $prop;
                
                $cat_types = \DB::table('tb_properties_category_types')->select('id','category_name','room_desc')->where('property_id', $prop->id)->where('status', 0)->where('show_on_booking', 1)->get();
                if (!empty($cat_types)) {
                    $c = 0;
                    foreach ($cat_types as $type) {
                        $roomfileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $prop->id)->where('tb_properties_images.category_id', $type->id)->where('tb_properties_images.type', 'Rooms Images')->orderBy('tb_container_files.file_sort_num', 'asc')->get();
                        
                        if (!empty($roomfileArr)) {
    						$propertiesArr['roomimgs'][$type->id]['imgs'] = $roomfileArr;
    						$propertiesArr['roomimgs'][$type->id]['imgsrc'] = (new ContainerController)->getThumbpath($roomfileArr[0]->folder_id);
    						$propertiesArr['roomimgs'][$type->id]['imgsrc_dir'] = public_path(str_replace(url().'/', '', (new ContainerController)->getThumbpath($roomfileArr[0]->folder_id)));
                            $propertiesArr['typedata'][$c] = $type;                        
    						$c++;
                        }                    
                        
                    }
                }
                if($roomType==0){                    
                    
                    $query = "SELECT COUNT(id) as noOfRooms, property_id, category_id FROM tb_properties_category_rooms where 1=1 and";
                    $query .="( room_active_from <= '".$arrive_date."' AND room_active_to >= '".$departure_date."')";
                    
                    $query .=" and tb_properties_category_rooms.id not IN (select td_reserved_rooms.room_id from tb_reservations INNER join td_reserved_rooms on td_reserved_rooms.reservation_id=tb_reservations.id where '".$arrive_date."' BETWEEN checkin_date and checkout_date or '".$departure_date."' BETWEEN checkin_date and checkout_date)";
                    
                    $query .=" and property_id=".$prop->id." GROUP BY category_id";
                    
                    $result = DB::SELECT($query);
                    
                    if(!empty($result)){
                        foreach($result as $sin){
                            $new_result[$sin->category_id]=$sin;
                            $total_available_room = (int) $total_available_room + (int) $sin->noOfRooms;
                        }
                    }
                    //print_r($new_result); die;
                    //echo $total_available_room;
                    if( $total_available_room >= $rooms){
                        $category = \DB::table('tb_properties_category_types')->where('property_id', $prop->id)->where('show_on_booking', 1)->where('status', 0)->get();    
                        $maximum_guest = 0;
                        foreach($category as $si){
                            if($number_of_nights >= $si->minimum_stay){
                                if(count($new_result)>0){
                                    if(array_key_exists($si->id, $new_result)){
                                        $no_of_room = $new_result[$si->id]->noOfRooms;
                                        if($no_of_room >= $rooms){
                                            
                                            $maximum_guest = (int)$rooms * $si->total_guests;
                                            
                                            $total_guest = (int)$adults + (int)(($child=='') ? 0 : $child);
                                            if($maximum_guest >= $total_guest){
                                                $available["rooms"] = $new_result[$si->id]->noOfRooms;
                                                $available["cat_id"] = $si->id;
                                                $available["cat_name"] = $si->category_name;
                                                $available["max_guest"] = $si->total_guests;
                                                $available["guests_child"] = $si->guests_juniors;
                                                
                                                $roomfileArr1 = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $prop->id)->where('tb_properties_images.category_id', $si->id)->where('tb_properties_images.type', 'Rooms Images')->orderBy('tb_container_files.file_sort_num', 'asc')->get();
                                            
                                                if(!empty($roomfileArr1)) {
                                                    $imgsrc = (new ContainerController)->getThumbpath($roomfileArr1[0]->folder_id);
                                                    $available["img_url"] = $imgsrc.$roomfileArr1[0]->file_name;
                                                }  
                                                
                                                
                                                $query11 = "SELECT * FROM tb_properties_category_rooms_price inner join tb_seasons on tb_seasons.id=tb_properties_category_rooms_price.season_id inner join tb_seasons_dates on tb_seasons.id=tb_seasons_dates.season_id  where ((season_from_date <= '".$arrive_date."' AND season_to_date >='".$departure_date."') OR (season_from_date BETWEEN '".$arrive_date."' AND '".$departure_date."') OR  (season_to_date BETWEEN '".$arrive_date."' AND '".$departure_date."')) and tb_properties_category_rooms_price.category_id=".$si->id." ORDER by tb_seasons.season_priority";
                                                //echo $query11; die;
                                                $check_season = \DB::select($query11);
                                                //print_r($check_season); die;
                                                if(!empty($check_season)){
                                                    //foreach($check_season as $si_sea){ 
                                                       $available["price"] = $check_season[0]->rack_rate;            
                                                    //}
                                                }else{
                                                    
                                                    $query2 = "SELECT *, 'default' as season_name FROM tb_properties_category_rooms_price inner join tb_properties_category_rooms on tb_properties_category_rooms_price.category_id=tb_properties_category_rooms.category_id where active_full_year=1 and tb_properties_category_rooms_price.category_id=".$si->id." and tb_properties_category_rooms_price.season_id=0";
                                                    $check_room = \DB::select($query2);
                                                    //print_r($check_room); die;
                                                    if(!empty($check_room)){
                                                         $available["price"] = $check_room[0]->rack_rate;      
                                                    }
                                                }
                                                 
                                                
                                                $available_cat[] = $available;
                                                $available_rooms[] = $available;
                                            }
                                        }
                                    }
                                }
                            }        
                        }
                        //print_r($available_cat);die;
                        $guest_cap = 0;
                        $req_rooms = $rooms;
                        if(empty($available_cat)){
                            foreach($category as $si_cat){
                                if(array_key_exists($si_cat->id, $new_result)){
                                    if($req_rooms > 0){
                                        if($req_rooms > $new_result[$si_cat->id]->noOfRooms){
                                            $guest_cap = (int)$guest_cap + (int)($new_result[$si_cat->id]->noOfRooms * $si_cat->total_guests);
                                            $req_rooms = $req_rooms - $new_result[$si_cat->id]->noOfRooms;
                                        }else{
                                            $guest_cap = (int)$guest_cap + (int)($req_rooms * $si_cat->total_guests);
                                            $req_rooms = $req_rooms - $new_result[$si_cat->id]->noOfRooms;
                                        }
                                    }
                                }
                            }
                            if($guest_cap >=$total_guests ){
                                foreach($category as $si){
                                    if($number_of_nights >= $si->minimum_stay){
                                        if(count($new_result)>0){
                                            if(array_key_exists($si->id, $new_result)){
                                                $available["rooms"] = $new_result[$si->id]->noOfRooms;
                                                $available["cat_id"] = $si->id;
                                                $available["cat_name"] = $si->category_name;
                                                $available["max_guest"] = $si->total_guests;
                                                $available["guests_child"] = $si->guests_juniors;
                                                
                                                $roomfileArr2 = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.category_id', $si->id)->where('tb_properties_images.type', 'Rooms Images')->orderBy('tb_container_files.file_sort_num', 'asc')->get();
                                                
                                                if(!empty($roomfileArr2)) {
                                                    $imgsrc = (new ContainerController)->getThumbpath($roomfileArr2[0]->folder_id);
                                                    $available["img_url"] = $imgsrc.$roomfileArr2[0]->file_name;
                                                }   
                                                
                                                $query22 = "SELECT * FROM tb_properties_category_rooms_price inner join tb_seasons on tb_seasons.id=tb_properties_category_rooms_price.season_id inner join tb_seasons_dates on tb_seasons.id=tb_seasons_dates.season_id  where ((season_from_date <= '".$arrive_date."' AND season_to_date >='".$departure_date."') OR (season_from_date BETWEEN '".$arrive_date."' AND '".$departure_date."') OR  (season_to_date BETWEEN '".$arrive_date."' AND '".$departure_date."')) and tb_properties_category_rooms_price.category_id=".$si->id." ORDER by tb_seasons.season_priority";
                                                    //echo $query11; die;
                                                    $check_season = \DB::select($query22);
                                                    //print_r($check_season); die;
                                                    if(!empty($check_season)){
                                                        //foreach($check_season as $si_sea){ 
                                                           $available["price"] = $check_season[0]->rack_rate;            
                                                        //}
                                                    }else{
                                                        
                                                        $query2 = "SELECT *, 'default' as season_name FROM tb_properties_category_rooms_price inner join tb_properties_category_rooms on tb_properties_category_rooms_price.category_id=tb_properties_category_rooms.category_id where active_full_year=1 and tb_properties_category_rooms_price.category_id=".$si->id." and tb_properties_category_rooms_price.season_id=0";
                                                        $check_room = \DB::select($query2);
                                                        //print_r($check_room); die;
                                                        if(!empty($check_room)){
                                                             $available["price"] = $check_room[0]->rack_rate;      
                                                        }
                                                    }
                                                
                                                $available_cat[] = $available;
                                                $available_rooms[] = $available;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        $retun_array = array('status'=>'success', 'room_available'=>$available_cat); 
                    }else{
                        $retun_array = array('status'=>'error', 'message'=>'Unfortunately we have no rooms available for you date range, Please change you dates or we can suggest the following hotels');
                    }           
                }            
                else{
                    
                    $query = "SELECT COUNT(tb_properties_category_rooms.id) as noOfRooms, tb_properties_category_rooms.category_id, tb_properties_category_types.total_guests, tb_properties_category_types.minimum_stay, tb_properties_category_types.guests_juniors, tb_properties_category_types.category_name, tb_properties_category_rooms.property_id, tb_properties_category_rooms.category_id FROM tb_properties_category_rooms";
                    $query .= " inner join tb_properties_category_types on tb_properties_category_types.id=tb_properties_category_rooms.category_id";
                    $query .=" where 1=1 and ";
                    $query .="( tb_properties_category_rooms.room_active_from <= '".$arrive_date."' AND tb_properties_category_rooms.room_active_to >= '".$departure_date."')";
                    
                    $query .=" and tb_properties_category_rooms.id not IN (select td_reserved_rooms.room_id from tb_reservations INNER join td_reserved_rooms on td_reserved_rooms.reservation_id=tb_reservations.id where '".$arrive_date."' BETWEEN checkin_date and checkout_date or '".$departure_date."' BETWEEN checkin_date and checkout_date)";
                    
                    $query .=" and tb_properties_category_rooms.property_id=".$pid." and tb_properties_category_rooms.category_id=".$roomType." GROUP BY category_id";
                    //echo $query; die;
                    $result = DB::SELECT($query)[0];
                    //print_r($result); die;
                    if(!empty($result)){                   
                        $total_available_room = (int) $total_available_room + (int) $result->noOfRooms;
                        if( $total_available_room >= $rooms){
                            if($number_of_nights >= $result->minimum_stay){
                                $maximum_guest = $rooms * $result->total_guests;
                                $total_guest = (int)$adults + (int)(($child=='') ? 0 : $child);
                                if($maximum_guest >= $total_guest){
                                    $available["rooms"] = $result->noOfRooms; 
                                    $available["cat_id"] = $result->category_id;                        
                                    $available["cat_name"] = $result->category_name;
                                    $available["max_guest"] = $result->total_guests;
                                    $available["guests_child"] = $result->guests_juniors;
                                    
                                    $roomfileArr3 = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.category_id', $roomType)->where('tb_properties_images.type', 'Rooms Images')->orderBy('tb_container_files.file_sort_num', 'asc')->get();
                                            
                                    if(!empty($roomfileArr3)) {
                                        $imgsrc = (new ContainerController)->getThumbpath($roomfileArr3[0]->folder_id);
                                        $available["img_url"] = $imgsrc.$roomfileArr3[0]->file_name;
                                    }   
                                    
                                    $query33 = "SELECT * FROM tb_properties_category_rooms_price inner join tb_seasons on tb_seasons.id=tb_properties_category_rooms_price.season_id inner join tb_seasons_dates on tb_seasons.id=tb_seasons_dates.season_id  where ((season_from_date <= '".$arrive_date."' AND season_to_date >='".$departure_date."') OR (season_from_date BETWEEN '".$arrive_date."' AND '".$departure_date."') OR  (season_to_date BETWEEN '".$arrive_date."' AND '".$departure_date."')) and tb_properties_category_rooms_price.category_id=".$roomType." ORDER by tb_seasons.season_priority";
                                    //echo $query11; die;
                                    $check_season = \DB::select($query33);
                                    //print_r($check_season); die;
                                    if(!empty($check_season)){
                                        //foreach($check_season as $si_sea){ 
                                           $available["price"] = $check_season[0]->rack_rate;            
                                        //}
                                    }else{
                                        
                                        $query2 = "SELECT *, 'default' as season_name FROM tb_properties_category_rooms_price inner join tb_properties_category_rooms on tb_properties_category_rooms_price.category_id=tb_properties_category_rooms.category_id where active_full_year=1 and tb_properties_category_rooms_price.category_id=".$roomType." and tb_properties_category_rooms_price.season_id=0";
                                        $check_room = \DB::select($query2);
                                        //print_r($check_room); die;
                                        if(!empty($check_room)){
                                             $available["price"] = $check_room[0]->rack_rate;      
                                        }
                                    }
                                    
                                    $available_cat[] = $available;
                                    $available_rooms[] = $available;
                                }
                                $retun_array = array('status'=>'success', 'room_available'=>$available_cat);
                            } 
                        }else{
                            $retun_array = array('status'=>'error', 'message'=>'Unfortunately we have no rooms available for you date range, Please change you dates or we can suggest the following hotels');
                        }
                        
                    }else{
                        $retun_array = array('status'=>'error', 'message'=>'Unfortunately we have no rooms available for you date range, Please change you dates or we can suggest the following hotels');
                    }     
                              
                } 
                
                usort($available_rooms, function($a, $b) {                   
    			   return (float)$a['price'] < (float)$b['price'];
    		    });
                
                //$HotelDataArr[]['pid'] = $pid;
                //$HotelDataArr[]['roomavailability'] = $available_rooms;
                //$HotelDataArr[]['propertyDetail'] = $propertiesArr;
                
                $HotelDataArr[] = array('pid'=>$prop->id, 'roomavailability' => $available_rooms, 'propertyDetail' => $propertiesArr);
                
            }
            
            
                
            //echo $booking_children; die;   
            //echo json_encode($retun_array);
            //echo "<pre>";
            //print_r($available_rooms);
            
            //print_r($available_rooms); die;
            
            $this->data['arrive'] = $arrive;
            $this->data['arrive_new'] = \CommonHelper::dateformat(trim($arrive));
            $this->data['departure'] = $departure;
            $this->data['departure_new'] = \CommonHelper::dateformat(trim($departure));
            $this->data['booking_rooms'] = $booking_rooms;
            $this->data['booking_adults'] = $booking_adults;
            $this->data['booking_children'] = $booking_children;
            $this->data['travellerType'] = $travellerType;
            $this->data['roomType'] = $roomType;
            $this->data['child_age'] = $child_age;
            
            $this->data['currency'] = \DB::table('tb_settings')->select('content')->where('key_value', 'default_currency')->first();       
            $this->data['propertyDetail'] = $HotelDataArr;
            $this->data['relatedgridpropertiesArr'] = $relatedgridpropertiesArr;
            
            if($hotels!=''){
                $allData[] = array('name'=>'Hotel', 'data'=>$HotelDataArr); 
            }
            if($destinations!=''){
                $allData[] = array('name'=>'Destination', 'data'=>$DestinationDataArr); 
            }
            $this->data['allData'] = $allData;
            //$this->data['roomavailability'] = $available_rooms;
            
            //echo "<pre>";
            //print_r($this->data); die;
            return view('frontend.themes.emporium.properties.globalsearchavailability', $this->data);
        }else{            
            return response(view('errors.403'), 403);           
        }
                    
    }
    
    function globalPropertySearch(Request $request) {

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
			\Session::put('arrive', $request->arrive);
			$this->data['arrive_date'] = $request->arrive;
			$this->data['dateslug'] = $request->arrive;
			$arrive = date("Y-m-d", strtotime(trim($request->arrive)));
		}
		if (!is_null($request->departure) && $request->departure != '') {
			\Session::put('departure', $request->departure);
			$this->data['departure_date'] = $request->departure;
			$this->data['dateslug'] = $this->data['dateslug'].' to '.$request->departure;
			$departure = date("Y-m-d", strtotime(trim($request->departure)));
		}


		$catprops = '';   

		   
		$cateObj = \DB::table('tb_categories')->where('category_alias', $keyword)->where('category_published', 1)->first();
//print_r($cateObj); die;
        $chldIds = array();
        $getcatsID = array();
        if (!empty($cateObj)) {
            $channel_url = $cateObj->category_youtube_channel_url;
            $this->data['channel_url'] = $channel_url;
            
            //get all children start
            $chldIds = $this->fetchcategoryChildListIds($cateObj->id);
            //End
            //print_r($chldIds); die;
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
        
        //set folder path
        $efolderArr = array();
        $finalEm = array();
        foreach($emotional_gallery_array as $erow){
            $efid = $erow->folder_id;
            $folderpath = '';
            if(isset($finalEm['f-'.$efid])){ $folderpath = $finalEm['f-'.$efid];}
            else{
                $folderpath = trim($this->getThumbpath($efid));
                $finalEm['f-'.$efid] = $folderpath;
            }
            $erow->imgsrc = $folderpath;
            $finalEm[] = $erow;
        }
        //echo "<pre>"; print_r($finalEm); die;
        //End
        
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
    function propcollection(Request $request){
        $data_name = $request->input('d_name');
        //$exper = $request->input('exper');
        //echo $data_name."/".$exper;
        $coll_type = $request->input('coll_type');        
        
        $coll_name = '';
        $arr_mem_tab = explode('-', $data_name);     
        if(!empty($arr_mem_tab)){
            $coll_name = $arr_mem_tab[0];
        }
        //print_r($coll_name);
        $res = array();
        $mem_types = array();
        if (\Auth::check() == true) {
            if(\Auth::user()->group_id!=1){
                $uid = \Auth::user()->id;
                $mem_type = \Auth::user()->member_type;
                
                if($mem_type=="lifestyle-membership"){
                    $mem_types[] = '1';    
                }elseif($mem_type=="dedicated-membership"){
                    $mem_types[] = '1';  
                    $mem_types[] = '2';
                }elseif($mem_type=="bespoke-membership"){
                    $mem_types[] = '1';  
                    $mem_types[] = '2';
                    $mem_types[] = '3';
                }
                
            }else{
                $mem_types[] = '1';  
                $mem_types[] = '2';
                $mem_types[] = '3';
            }
        }else{
            if($coll_name!='lifestyle'){
                $mem_types[] = 1;
            }
        }
        if($coll_type=="destinations"){            
            $cat = $request->input('cat');
            $cateObj = \DB::table('tb_categories')->where('category_alias', $cat)->where('category_published', 1)->first();                    
            if (!empty($cateObj)) {
                if($cateObj->id>0){                        
    				$dest_url = implode('/',array_reverse($this->fetchcategoryaliaspath($cateObj->id)));
                    $res['dest_url']= $dest_url; 
                }                    
            }        
        }        
        //$res['status']= 'error';  
        $res['type']= $data_name;   
        $res['mem_types']= $mem_types;       
        echo json_encode($res);
        die;
    }
    
    function searchpropcollection(Request $request){
        $data_name = $request->input('d_name');
        //$exper = $request->input('exper');
        //echo $data_name."/".$exper;
        $coll_type = $request->input('coll_type');        
        
        $coll_name = '';
        $arr_mem_tab = explode('-', $data_name);     
        if(!empty($arr_mem_tab)){
            $coll_name = $arr_mem_tab[0];
        }
        //print_r($coll_name);
        $res = array();
        $mem_types = array();
        if (\Auth::check() == true) {
            if(\Auth::user()->group_id!=1){
                $uid = \Auth::user()->id;
                $mem_type = \Auth::user()->member_type;
                
                if($mem_type=="lifestyle-membership"){
                    $mem_types[] = '1';    
                }elseif($mem_type=="dedicated-membership"){
                    $mem_types[] = '1';  
                    $mem_types[] = '2';
                }elseif($mem_type=="bespoke-membership"){
                    $mem_types[] = '1';  
                    $mem_types[] = '2';
                    $mem_types[] = '3';
                }
                
            }else{
                $mem_types[] = '1';  
                $mem_types[] = '2';
                $mem_types[] = '3';
            }
        }else{
            if($coll_name!='lifestyle'){
                $mem_types[] = 1;
            }
        }          
        //$res['status']= 'error';  
        $res['type']= $data_name;   
        $res['mem_types']= $mem_types;       
        echo json_encode($res);
        die;
    }

    
    function topSearch(Request $request) {
        $check_in = $request->input('check_in');
        $check_out = $request->input('check_out');
        $check_in = date('Y-m-d', strtotime($check_in));
        $check_out = date('Y-m-d', strtotime($check_out)); 
        
        $req_page = $request->input('req_page');
        $mem_type = $request->input('mem_type');
        $cat = $request->input('cat');
        
        //echo $req_page."/".$mem_type."/".$cat;
        
        
        
        
        $membershiptype =  $mem_type;
        
        $keyword = trim($cat);
        $show = 'asc';
		

		$this->data['dateslug'] = '';
		$arrive = $departure = $adult = $childs = '';
		if (!is_null($check_in) && $check_in != '') {
			\Session::put('arrive', $check_in);			
			$arrive = $check_in;
		}
		if (!is_null($check_out) && $check_out != '') {
			\Session::put('departure', $check_out);			
			$departure = $check_out;
		}

		$catprops = '';   

		/* Default package */
        $pckages_ids = '';
        
        $public_package = \DB::table('tb_packages')->select('id')->where('package_category', 'B2C')->where('is_public', 1)->first();
        if(!empty($public_package)){
            $pckages_ids = $public_package->id;
        } 
        
        if($membershiptype!=''){
            if($membershiptype!='lifestyle-collection'){
                $exp_membership = explode('-', $membershiptype);
                if(!empty($exp_membership)){
                    $_type = $exp_membership[0];
                    if($_type=='dedicated'){
                        $mem_package = \DB::table('tb_packages')->select('id')->where('package_title', 'Dedicated Membership')->first();
                        $pckages_ids = $mem_package->id;   
                    }else if($_type=='bespoke'){
                        $mem_package = \DB::table('tb_packages')->select('id')->where('package_title', 'Bespoke Membership')->first();
                        $pckages_ids = $mem_package->id;  
                    }
                }                
            }
        }           
        /* End */   
           
		$cateObj = \DB::table('tb_categories')->where('category_alias', $keyword)->where('category_published', 1)->first();

        $chldIds = array();
        $getcatsID = array();
        if (!empty($cateObj)) {
            $channel_url = $cateObj->category_youtube_channel_url;
            $this->data['channel_url'] = $channel_url;
            
            //get all children start
            $chldIds = $this->fetchcategoryChildListIds($cateObj->id);
            //End
            //print_r($chldIds); die;
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
            //$catprops = " OR pr.id in(".$timplod.") ";
            $catprops = " AND pr.id in(".$timplod.") ";
        }
		
		$perPage = 20;
		$pageNumber = 1;
		if(isset($request->page) && $request->page>0){
			$pageNumber = $request->page;
		}
		$pageStart = ($pageNumber -1) * $perPage;

		$query = "SELECT pr.editor_choice_property,pr.property_usp,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,pcrp.rack_rate as price, tb_properties_category_package.package_id ";
		$query .= " FROM tb_properties pr LEFT JOIN tb_properties_category_rooms_price pcrp ON pr.id = pcrp.property_id ";
        $query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
		//$whereClause =" WHERE ((pr.property_name LIKE '%".$keyword."%' AND pr.property_type = 'Hotel') OR city LIKE '%".$keyword."%' ".$catprops." ) AND pr.property_status = 1 AND  pr.feature_property = 0 AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ";
        $whereClause =" WHERE pr.property_type = 'Hotel' AND pr.property_status = 1 AND  pr.feature_property = 0 AND tb_properties_category_package.package_id IN (".$pckages_ids.") ".$catprops." ";
        //print_r($whereClause); die;
		$orderBy = "ORDER BY price DESC, editor_choice_property DESC  ";
		$limit = " LIMIT ". $pageStart.",".$perPage; 
        $finalQry = "SELECT * FROM (".$query.$whereClause." ORDER BY price DESC) tempX GROUP BY id ".$orderBy.$limit ;
        
        $whereClauseAll =" WHERE pr.property_type = 'Hotel' AND pr.property_status = 1 AND  pr.feature_property = 0 ".$catprops." "; 
        $finalQryAll = "SELECT * FROM (".$query.$whereClauseAll." ORDER BY price DESC) tempX GROUP BY id ".$orderBy ;
        
		$CountRecordQry = "Select count(*) as total_record from tb_properties pr  JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ".$whereClause ;
			
			//Feature Query
		$query = "SELECT pr.editor_choice_property,pr.property_usp,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,pcrp.rack_rate as price, tb_properties_category_package.package_id ";
		$query .= " FROM tb_properties pr LEFT JOIN tb_properties_category_rooms_price pcrp ON pr.id = pcrp.property_id ";
        $query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
		//$whereClause =" WHERE ((pr.property_name LIKE '%".$keyword."%' AND pr.property_type = 'Hotel') OR city LIKE '%".$keyword."%' ".$catprops." ) AND pr.property_status = 1 AND  pr.feature_property = 1 AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ";
        $whereClause =" WHERE pr.property_type = 'Hotel'  AND tb_properties_category_package.package_id IN (".$pckages_ids.") ".$catprops." AND pr.property_status = 1 AND  pr.feature_property = 1 ";
		$orderBy = "ORDER BY RAND()  ";
		$limit = " LIMIT 4";
		$featureQuery = "SELECT * FROM (".$query.$whereClause." ORDER BY price DESC) tempX GROUP BY id ".$orderBy.$limit ; 
		
		  //Editor choice editor_choice_property
        $query = "SELECT pr.editor_choice_property,pr.property_usp,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,pcrp.rack_rate as price, tb_properties_category_package.package_id ";
		$query .= " FROM tb_properties pr LEFT JOIN tb_properties_category_rooms_price pcrp ON pr.id = pcrp.property_id ";
        $query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
		//$whereClause =" WHERE ((pr.property_name LIKE '%".$keyword."%' AND pr.property_type = 'Hotel') OR city LIKE '%".$keyword."%' ".$catprops." ) AND pr.property_status = 1 AND  pr.editor_choice_property = 1 AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ";
        $whereClause =" WHERE  pr.property_type = 'Hotel'  AND tb_properties_category_package.package_id IN (".$pckages_ids.") ".$catprops." AND pr.property_status = 1 AND pr.editor_choice_property = 1 ";
		$orderBy = "ORDER BY RAND()  ";
		$limit = " LIMIT 4";
		$editorQuery = "SELECT * FROM (".$query.$whereClause." ORDER BY price DESC) tempX GROUP BY id ".$orderBy.$limit ; 

        $editorData = DB::select($editorQuery);
		//dd($editorData);
        $this->data['editorPropertiesArr']=$editorData;

		$property = DB::select($finalQry);
		$getRec = DB::select($CountRecordQry);
		$featureData = DB::select($featureQuery);
		
        /*--  Get all the property by membership  --*/
        //echo "<pre>";
        //print_r($property); die;
        $allProperty = DB::select($finalQryAll);
        
        /*-- End --*/
        
        $prop_by_package = array();
        $mem_packages =  \DB::table('tb_packages')->where('package_category', 'B2C')->where('package_status', 1)->orderby('order_num', 'asc')->get();
        if(!empty($mem_packages)){
            $arr_key = '';
            foreach($mem_packages as $pack){
                $pkg_ttl = $pack->package_title;
                $exp_ttl = explode(' ', $pkg_ttl);
                if(!empty($exp_ttl)){
                    $arr_key = $exp_ttl[0];       
                }
                if(!empty($allProperty)){
                    foreach($allProperty as $prop){                        
                        if($prop->package_id == $pack->id)
                            $prop_by_package[$arr_key][] = $prop;  
                    }    
                }            
            }
        }
        //echo "<pre>";
        //print_r($prop_by_package); die;
        $this->data['prop_packages'] = $prop_by_package;
        /*--  End --*/
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
        
        //set folder path
        $efolderArr = array();
        $finalEm = array();
        foreach($emotional_gallery_array as $erow){
            $efid = $erow->folder_id;
            $folderpath = '';
            if(isset($finalEm['f-'.$efid])){ $folderpath = $finalEm['f-'.$efid];}
            else{
                $folderpath = trim($this->getThumbpath($efid));
                $finalEm['f-'.$efid] = $folderpath;
            }
            $erow->imgsrc = $folderpath;
            $finalEm[] = $erow;
        }
        //echo "<pre>"; print_r($finalEm); die;
        //End
        
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
            
            $this->data['experiences'] = \DB::table('tb_categories')->where('parent_category_id', 8)->where('category_approved', 1)->where('category_published', 1)->get();
            $m_collection = \DB::table('tb_categories')->where('category_alias', 'our-collection')->where('category_approved', 1)->where('category_published', 1)->first();   
            $cat_collection = array();             
            if(!empty($m_collection)){
                $cat_collection = \DB::table('tb_categories')->where('parent_category_id', $m_collection->id)->where('category_approved', 1)->where('category_published', 1)->orderBy('category_order_num', 'asc')->get();
            }
            $this->data['collections'] = $cat_collection;
        }
        
        $this->data['req_for'] = request()->segment(1);
        $this->data['sel_exp'] = trim($request->cat);
        $this->data['m_type'] = ($membershiptype !='' ? $membershiptype : 'lifestyle-collection');
        
		return view('frontend.themes.emporium.properties.ajax_list', $this->data);
                 
    }
    
    function propertybycollection(Request $request){             
        $coll_type = $request->input('coll_type'); 
        $cat = $request->input('cat');
        
        $membershiptype =  $coll_type;
        $keyword = $cat;
         
		$catprops = '';   
        
        $arrive = $departure = $adult = $childs = '';
		if (!is_null($request->arrive) && $request->arrive != '') {
			\Session::put('arrive', $request->arrive);
			$this->data['arrive_date'] = $request->arrive;
			$this->data['dateslug'] = $request->arrive;
			$arrive = date("Y-m-d", strtotime(trim($request->arrive)));
		}
		if (!is_null($request->departure) && $request->departure != '') {
			\Session::put('departure', $request->departure);
			$this->data['departure_date'] = $request->departure;
			$this->data['dateslug'] = $this->data['dateslug'].' to '.$request->departure;
			$departure = date("Y-m-d", strtotime(trim($request->departure)));
		}
        
        $req_for = $request->input('req_for');
		/* Default package */
        $pckages_ids = '';
        
        $public_package = \DB::table('tb_packages')->select('id')->where('package_category', 'B2C')->where('is_public', 1)->first();
        if(!empty($public_package)){
            $pckages_ids = $public_package->id;
        } 
        
        if($membershiptype!=''){
            if($membershiptype!='lifestyle-collection'){
                $exp_membership = explode('-', $membershiptype);
                if(!empty($exp_membership)){
                    $_type = $exp_membership[0];
                    if($_type=='dedicated'){
                        $mem_package = \DB::table('tb_packages')->select('id')->where('package_title', 'Dedicated Membership')->first();
                        $pckages_ids = $mem_package->id;   
                    }else if($_type=='bespoke'){
                        $mem_package = \DB::table('tb_packages')->select('id')->where('package_title', 'Bespoke Membership')->first();
                        $pckages_ids = $mem_package->id;  
                    }
                }
                $public_package = \DB::table('tb_packages')->select('id')->where('package_category', 'B2C')->where('is_public', 1)->first();
            }
        }
        
        //print_r($pckages_ids); die;   
        /* End */   
        //echo $keyword; die;   
		$cateObj = \DB::table('tb_categories')->where('category_alias', $keyword)->where('category_published', 1)->first();
//print_r($cateObj); die;
        $chldIds = array();
        $getcatsID = array();
        if (!empty($cateObj)) {
            $channel_url = $cateObj->category_youtube_channel_url;
            $this->data['channel_url'] = $channel_url;
            
            //get all children start
            $chldIds = $this->fetchcategoryChildListIds($cateObj->id);
            //End
            //print_r($chldIds); die;
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
            //$catprops = " OR pr.id in(".$timplod.") ";
            $catprops = " AND pr.id in(".$timplod.") ";
        }
		
		$perPage = 20;
		$pageNumber = 1;
		if(isset($request->page) && $request->page>0){
			$pageNumber = $request->page;
		}
		$pageStart = ($pageNumber -1) * $perPage;

		$query = "SELECT pr.editor_choice_property,pr.property_usp,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,pcrp.rack_rate as price, tb_properties_category_package.package_id ";
		$query .= " FROM tb_properties pr LEFT JOIN tb_properties_category_rooms_price pcrp ON pr.id = pcrp.property_id ";
        $query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
		//$whereClause =" WHERE ((pr.property_name LIKE '%".$keyword."%' AND pr.property_type = 'Hotel') OR city LIKE '%".$keyword."%' ".$catprops." ) AND pr.property_status = 1 AND  pr.feature_property = 0 AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ";
        $whereClause =" WHERE pr.property_type = 'Hotel' AND pr.property_status = 1 AND  pr.feature_property = 0 AND tb_properties_category_package.package_id IN (".$pckages_ids.") ".$catprops." ";
        //print_r($whereClause); die;
		$orderBy = "ORDER BY price DESC, editor_choice_property DESC  ";
		$limit = " LIMIT ". $pageStart.",".$perPage; 
        $finalQry = "SELECT * FROM (".$query.$whereClause." ORDER BY price DESC) tempX GROUP BY id ".$orderBy.$limit ;
        
        $whereClauseAll =" WHERE pr.property_type = 'Hotel' AND pr.property_status = 1 AND  pr.feature_property = 0 ".$catprops." "; 
        $finalQryAll = "SELECT * FROM (".$query.$whereClauseAll." ORDER BY price DESC) tempX GROUP BY id ".$orderBy ;
        
		$CountRecordQry = "Select count(*) as total_record from tb_properties pr  JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ".$whereClause ;
			
			//Feature Query
		$query = "SELECT pr.editor_choice_property,pr.property_usp,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,pcrp.rack_rate as price, tb_properties_category_package.package_id ";
		$query .= " FROM tb_properties pr LEFT JOIN tb_properties_category_rooms_price pcrp ON pr.id = pcrp.property_id ";
        $query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
		//$whereClause =" WHERE ((pr.property_name LIKE '%".$keyword."%' AND pr.property_type = 'Hotel') OR city LIKE '%".$keyword."%' ".$catprops." ) AND pr.property_status = 1 AND  pr.feature_property = 1 AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ";
        $whereClause =" WHERE pr.property_type = 'Hotel'  AND tb_properties_category_package.package_id IN (".$pckages_ids.") ".$catprops." AND pr.property_status = 1 AND  pr.feature_property = 1 ";
		$orderBy = "ORDER BY RAND()  ";
		$limit = " LIMIT 4";
		$featureQuery = "SELECT * FROM (".$query.$whereClause." ORDER BY price DESC) tempX GROUP BY id ".$orderBy.$limit ; 
		
		  //Editor choice editor_choice_property
        $query = "SELECT pr.editor_choice_property,pr.property_usp,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,pcrp.rack_rate as price, tb_properties_category_package.package_id ";
		$query .= " FROM tb_properties pr LEFT JOIN tb_properties_category_rooms_price pcrp ON pr.id = pcrp.property_id ";
        $query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
		//$whereClause =" WHERE ((pr.property_name LIKE '%".$keyword."%' AND pr.property_type = 'Hotel') OR city LIKE '%".$keyword."%' ".$catprops." ) AND pr.property_status = 1 AND  pr.editor_choice_property = 1 AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ";
        $whereClause =" WHERE  pr.property_type = 'Hotel'  AND tb_properties_category_package.package_id IN (".$pckages_ids.") ".$catprops." AND pr.property_status = 1 AND pr.editor_choice_property = 1 ";
		$orderBy = "ORDER BY RAND()  ";
		$limit = " LIMIT 4";
		$editorQuery = "SELECT * FROM (".$query.$whereClause." ORDER BY price DESC) tempX GROUP BY id ".$orderBy.$limit ; 

        $editorData = DB::select($editorQuery);
		//dd($editorData);
        $this->data['editorPropertiesArr']=$editorData;

		$property = DB::select($finalQry);
		$getRec = DB::select($CountRecordQry);
		$featureData = DB::select($featureQuery);
		
        /*--  Get all the property by membership  --*/
        //echo "<pre>";
        //print_r($property); die;
        $allProperty = DB::select($finalQryAll);
        
        /*-- End --*/
        
        $prop_by_package = array();
        $mem_packages =  \DB::table('tb_packages')->where('package_category', 'B2C')->where('package_status', 1)->orderby('order_num', 'asc')->get();
        if(!empty($mem_packages)){
            $arr_key = '';
            foreach($mem_packages as $pack){
                $pkg_ttl = $pack->package_title;
                $exp_ttl = explode(' ', $pkg_ttl);
                if(!empty($exp_ttl)){
                    $arr_key = strtolower($exp_ttl[0]);       
                }
                if(!empty($allProperty)){
                    foreach($allProperty as $prop){                        
                        if($prop->package_id == $pack->id)
                            $prop_by_package[$arr_key][] = $prop;  
                    }    
                }            
            }
        }
        //echo "<pre>";
        //print_r($prop_by_package); die;
        $this->data['prop_packages'] = $prop_by_package;
        /*--  End --*/
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
        
        //set folder path
        $efolderArr = array();
        $finalEm = array();
        foreach($emotional_gallery_array as $erow){
            $efid = $erow->folder_id;
            $folderpath = '';
            if(isset($finalEm['f-'.$efid])){ $folderpath = $finalEm['f-'.$efid];}
            else{
                $folderpath = trim($this->getThumbpath($efid));
                $finalEm['f-'.$efid] = $folderpath;
            }
            $erow->imgsrc = $folderpath;
            $finalEm[] = $erow;
        }
        //echo "<pre>"; print_r($finalEm); die;
        //End
        
        $this->data['emotional_gallery'] = $emotional_gallery_array;
        //End 
		$tags_Arr = \DB::table('tb_tags_manager')->where('tag_status', 1)->get();
		$tagsArr = array();
		if (!empty($tags_Arr)) {
			foreach ($tags_Arr as $tags) {
				$tagsArr[$tags->parent_tag_id][] = $tags;
			}
		}
        $this->data['destination_category'] =0;
        $resultads = array();
        if($req_for == 'luxury_destinations' || $req_for=='luxury_experience' ){
            if($cateObj->id > 0){
    		//if(request()->segment(1)=='luxury_destinations' || request()->segment(1)=='luxury_experience'){
                $this->data['destination_category']=$cateObj->id;
    			$this->data['destination_category_instagram']=$cateObj->category_instagram_channel;
            //}
            }
        
            if($cateObj->id > 0){
                $adscatid = ($cateObj->id > 0) ? $cateObj->id : 'Hotel'; 
                $resultads = \CommonHelper::getGridResultAds('grid_results', $adscatid);
                //$this->data['resultads'] = $resultads;
            }
        }
        $this->data['resultads'] = $resultads;
        $this->data['sel_exp'] = trim($keyword);        
        $this->data['slug'] = $keyword;
        $this->data['dateslug'] = '';
        
        echo json_encode(array('data'=>$this->data));
        exit();
		//return view('frontend.themes.emporium.properties.ajax_list', $this->data);
                
    }
 
    function searchpropertybycollection(Request $request){             
        $coll_type = $request->input('coll_type'); 
        $cat = $request->input('cat');
        
        $membershiptype =  $coll_type;
        $keyword = $cat;
         
		$catprops = '';   
        
        $arrive = $departure = $adult = $childs = '';
        $this->data['dateslug'] = '';
		if (!is_null($request->arrive) && $request->arrive != '') {
			\Session::put('arrive', $request->arrive);
			$this->data['arrive_date'] = $request->arrive;
			$this->data['dateslug'] = $request->arrive;
			$arrive = date("Y-m-d", strtotime(trim($request->arrive)));
            $arrive_new = \CommonHelper::dateformat(trim($request->arrive));
		}
		if (!is_null($request->departure) && $request->departure != '') {
			\Session::put('departure', $request->departure);
			$this->data['departure_date'] = $request->departure;
			$this->data['dateslug'] = $this->data['dateslug'].' to '.$request->departure;
			$departure = date("Y-m-d", strtotime(trim($request->departure)));
            $departure_new = \CommonHelper::dateformat(trim($request->departure));
		}
        
        $req_for = $request->input('req_for');
		/* Default package */
        $pckages_ids = '';
        $default_package = '';
        
        $public_package = \DB::table('tb_packages')->select('id')->where('package_category', 'B2C')->where('is_public', 1)->first();
        if(!empty($public_package)){
            $pckages_ids = $public_package->id;
        } 
        
        if($membershiptype!=''){
            if($membershiptype!='lifestyle-collection'){
                $exp_membership = explode('-', $membershiptype);
                if(!empty($exp_membership)){
                    $_type = $exp_membership[0];
                    if($_type=='dedicated'){
                        $mem_package = \DB::table('tb_packages')->select('id')->where('package_title', 'Dedicated Membership')->first();
                        $pckages_ids = $mem_package->id;   
                    }else if($_type=='bespoke'){
                        $mem_package = \DB::table('tb_packages')->select('id')->where('package_title', 'Bespoke Membership')->first();
                        $pckages_ids = $mem_package->id;  
                    }
                }
                $public_package = \DB::table('tb_packages')->select('id')->where('package_category', 'B2C')->where('is_public', 1)->first();
            }
        }else{
            if (\Auth::check() == true) {
                if(\Auth::user()->group_id!=1){
                    $uid = \Auth::user()->id;
                    $memtype = str_replace('-', ' ', \Auth::user()->member_type); 
                    $arr_membershiptype = explode('-', \Auth::user()->member_type); 
                    if(count($arr_membershiptype)>0){
                        $membershiptype = $arr_membershiptype[0]."-collection";    
                    }    
                    //print_r($membershiptype);      
                    $mem_package = \DB::table('tb_packages')->select('id')->where('package_title', $memtype)->first();
                    //print_r($mem_package); die;  
                    $pckages_ids = $mem_package->id;    
                }
            }            
        }
        $this->data['default_package'] = $default_package;
        
        //print_r($pckages_ids); die;   
        /* End */   
        //echo $keyword; die;   
		$cateObj = \DB::table('tb_categories')->where('category_alias', $keyword)->where('category_published', 1)->first();
//print_r($cateObj); die;
        $chldIds = array();
        $getcatsID = array();
        if (!empty($cateObj)) {
            $channel_url = $cateObj->category_youtube_channel_url;
            $this->data['channel_url'] = $channel_url;
            
            //get all children start
            $chldIds = $this->fetchcategoryChildListIds($cateObj->id);
            //End
            //print_r($chldIds); die;
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
            //$catprops = " OR pr.id in(".$timplod.") ";
            $catprops = " AND pr.id in(".$timplod.") ";
        }
		
		$perPage = 20;
		$pageNumber = 1;
		if(isset($request->page) && $request->page>0){
			$pageNumber = $request->page;
		}
		$pageStart = ($pageNumber -1) * $perPage;

		$query = "SELECT pr.editor_choice_property,pr.property_usp,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,0 as price, tb_properties_category_package.package_id";
        $query .= " FROM tb_properties_category_rooms pcr INNER JOIN tb_properties pr ON pr.id = pcr.property_id ";
        $query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
        
		//$whereClause =" WHERE ((pr.property_name LIKE '%".$keyword."%' AND pr.property_type = 'Hotel') OR city LIKE '%".$keyword."%' ".$catprops." ) AND pr.property_status = 1 AND  pr.feature_property = 0 AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ";
        $whereClause =" WHERE pr.property_type = 'Hotel' AND pr.property_status = 1 AND  pr.feature_property = 0 AND tb_properties_category_package.package_id IN (".$pckages_ids.") ";
        if($arrive_new != '' && $departure_new != ''){
            $whereClause .= " and pcr.room_active_from <='".$arrive_new."' and pcr.room_active_to >='".$departure_new."'";
            $whereClause .= "  and pcr.id not IN (select td_reserved_rooms.room_id from tb_reservations INNER join td_reserved_rooms on td_reserved_rooms.reservation_id=tb_reservations.id where '".$arrive_new."' BETWEEN checkin_date and checkout_date or '".$departure_new."' BETWEEN checkin_date and checkout_date)";
        }
        
        //print_r($whereClause); die;
		$orderBy = "ORDER BY price DESC, editor_choice_property DESC  ";
		$limit = " LIMIT ". $pageStart.",".$perPage; 
        $finalQry = "SELECT * FROM (".$query.$whereClause." ORDER BY price DESC) tempX GROUP BY id ".$orderBy.$limit ;
        
        $whereClauseAll =" WHERE pr.property_type = 'Hotel' AND pr.property_status = 1 AND  pr.feature_property = 0 ".$catprops." ";
        if($arrive_new != '' && $departure_new != ''){
            $whereClauseAll .= " and pcr.room_active_from <='".$arrive_new."' and pcr.room_active_to >='".$departure_new."'";
            $whereClauseAll .= "  and pcr.id not IN (select td_reserved_rooms.room_id from tb_reservations INNER join td_reserved_rooms on td_reserved_rooms.reservation_id=tb_reservations.id where '".$arrive_new."' BETWEEN checkin_date and checkout_date or '".$departure_new."' BETWEEN checkin_date and checkout_date)";
        } 
        $finalQryAll = "SELECT * FROM (".$query.$whereClauseAll." ORDER BY price DESC) tempX GROUP BY id ".$orderBy ;
        
		//$CountRecordQry = "Select count(*) as total_record from tb_properties pr  JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ".$whereClause ;
		$CountRecordQry = "Select count(*) as total_record from tb_properties_category_rooms pcr INNER JOIN tb_properties pr ON pr.id = pcr.property_id JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ".$whereClause ;
        //print_r($CountRecordQry); die;	
			//Feature Query
		$query = "SELECT pr.editor_choice_property,pr.property_usp,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,0 as price ";
		$query .= " FROM tb_properties_category_rooms pcr INNER JOIN tb_properties pr ON pr.id = pcr.property_id ";
        $query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
		//$whereClause =" WHERE ((pr.property_name LIKE '%".$keyword."%' AND pr.property_type = 'Hotel') OR city LIKE '%".$keyword."%' ".$catprops." ) AND pr.property_status = 1 AND  pr.feature_property = 1 AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ";
        $whereClause =" WHERE pr.property_type = 'Hotel'  AND tb_properties_category_package.package_id IN (".$pckages_ids.") AND pr.property_status = 1 AND  pr.feature_property = 1 ";
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
		//$whereClause =" WHERE ((pr.property_name LIKE '%".$keyword."%' AND pr.property_type = 'Hotel') OR city LIKE '%".$keyword."%' ".$catprops." ) AND pr.property_status = 1 AND  pr.editor_choice_property = 1 AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ";
        $whereClause =" WHERE  pr.property_type = 'Hotel'  AND tb_properties_category_package.package_id IN (".$pckages_ids.") ".$catprops." AND pr.property_status = 1 AND pr.editor_choice_property = 1 ";
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

		$property = DB::select($finalQry);
		$getRec = DB::select($CountRecordQry);
        //print_r($getRec); die;
		$featureData = DB::select($featureQuery);
		
        /*--  Get all the property by membership  --*/
        //echo "<pre>";
        //print_r($property); die;
        $allProperty = DB::select($finalQryAll);
        
        /*-- End --*/
        
        $prop_by_package = array();
        $mem_packages =  \DB::table('tb_packages')->where('package_category', 'B2C')->where('package_status', 1)->orderby('order_num', 'asc')->get();
        if(!empty($mem_packages)){
            $arr_key = '';
            foreach($mem_packages as $pack){
                $pkg_ttl = $pack->package_title;
                $exp_ttl = explode(' ', $pkg_ttl);
                if(!empty($exp_ttl)){
                    $arr_key = strtolower($exp_ttl[0]);       
                }
                if(!empty($allProperty)){
                    foreach($allProperty as $prop){                        
                        if($prop->package_id == $pack->id)
                            $prop_by_package[$arr_key][] = $prop;  
                    }    
                }            
            }
        }
        //echo "<pre>";
        //print_r($prop_by_package); die;
        $this->data['prop_packages'] = $prop_by_package;
        /*--  End --*/
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
        
        //set folder path
        $efolderArr = array();
        $finalEm = array();
        foreach($emotional_gallery_array as $erow){
            $efid = $erow->folder_id;
            $folderpath = '';
            if(isset($finalEm['f-'.$efid])){ $folderpath = $finalEm['f-'.$efid];}
            else{
                $folderpath = trim($this->getThumbpath($efid));
                $finalEm['f-'.$efid] = $folderpath;
            }
            $erow->imgsrc = $folderpath;
            $finalEm[] = $erow;
        }
        //echo "<pre>"; print_r($finalEm); die;
        //End
        
        $this->data['emotional_gallery'] = $emotional_gallery_array;
        //End 
		$tags_Arr = \DB::table('tb_tags_manager')->where('tag_status', 1)->get();
		$tagsArr = array();
		if (!empty($tags_Arr)) {
			foreach ($tags_Arr as $tags) {
				$tagsArr[$tags->parent_tag_id][] = $tags;
			}
		}
        $this->data['destination_category'] =0;
        $resultads = array();
        if($req_for == 'luxury_destinations' || $req_for=='luxury_experience' ){
            if($cateObj->id > 0){
    		//if(request()->segment(1)=='luxury_destinations' || request()->segment(1)=='luxury_experience'){
                $this->data['destination_category']=$cateObj->id;
    			$this->data['destination_category_instagram']=$cateObj->category_instagram_channel;
            //}
            }
        
            if($cateObj->id > 0){
                $adscatid = ($cateObj->id > 0) ? $cateObj->id : 'Hotel'; 
                $resultads = \CommonHelper::getGridResultAds('grid_results', $adscatid);
                //$this->data['resultads'] = $resultads;
            }
        }
        $this->data['resultads'] = $resultads;
        $this->data['sel_exp'] = trim($keyword);        
        $this->data['slug'] = $keyword;
        
        
        echo json_encode(array('data'=>$this->data));
        exit();
		//return view('frontend.themes.emporium.properties.ajax_list', $this->data);
                
    }
 
    
    function propertybycollection_old(Request $request){             
        $coll_type = $request->input('coll_type'); 
        $cat = $request->input('cat');
        
        $membershiptype =  $coll_type;
        $keyword = $cat;
         
		$catprops = '';   

		/* Default package */
        $pckages_ids = '';
        
        $public_package = \DB::table('tb_packages')->select('id')->where('package_category', 'B2C')->where('is_public', 1)->first();
        if(!empty($public_package)){
            $pckages_ids = $public_package->id;
        } 
        
        if($membershiptype!=''){
            if($membershiptype!='lifestyle-collection'){
                $exp_membership = explode('-', $membershiptype);
                if(!empty($exp_membership)){
                    $_type = $exp_membership[0];
                    if($_type=='dedicated'){
                        $mem_package = \DB::table('tb_packages')->select('id')->where('package_title', 'Dedicated Membership')->first();
                        $pckages_ids = $mem_package->id;   
                    }else if($_type=='bespoke'){
                        $mem_package = \DB::table('tb_packages')->select('id')->where('package_title', 'Bespoke Membership')->first();
                        $pckages_ids = $mem_package->id;  
                    }
                }
                $public_package = \DB::table('tb_packages')->select('id')->where('package_category', 'B2C')->where('is_public', 1)->first();
            }
        }
        
        //print_r($pckages_ids); die;   
        /* End */   
        //echo $keyword; die;   
		$cateObj = \DB::table('tb_categories')->where('category_alias', $keyword)->where('category_published', 1)->first();
//print_r($cateObj); die;
        $chldIds = array();
        $getcatsID = array();
        if (!empty($cateObj)) {
            $channel_url = $cateObj->category_youtube_channel_url;
            $this->data['channel_url'] = $channel_url;
            
            //get all children start
            $chldIds = $this->fetchcategoryChildListIds($cateObj->id);
            //End
            //print_r($chldIds); die;
            if(count($chldIds) <= 0){ $chldIds[] = $cateObj->id; }
            
            if (count($chldIds) > 0) { 
                $impload_ids = implode(',',$chldIds);
                $catcond = " AND (pr.category_id IN(".$impload_ids."))";
                /*$catcond = " AND (" . implode(" || ", array_map(function($v) {
									return sprintf("FIND_IN_SET('%s', pr.property_category_id)", $v);
								}, array_values($chldIds))) . ")";*/
                
                $ch_queries = "SELECT pr.id FROM property_categories_split_in_rows pr WHERE pr.property_status='1' ".$catcond." GROUP BY pr.id";
                
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
            //$catprops = " OR pr.id in(".$timplod.") ";
            $catprops = " AND pr.id in(".$timplod.") ";
        }
		
		$perPage = 20;
		$pageNumber = 1;
		if(isset($request->page) && $request->page>0){
			$pageNumber = $request->page;
		}
		$pageStart = ($pageNumber -1) * $perPage;

		$query = "SELECT pr.editor_choice_property,pr.property_usp,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,pcrp.rack_rate as price, tb_properties_category_package.package_id ";
		$query .= " FROM tb_properties pr LEFT JOIN tb_properties_category_rooms_price pcrp ON pr.id = pcrp.property_id ";
        $query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
		//$whereClause =" WHERE ((pr.property_name LIKE '%".$keyword."%' AND pr.property_type = 'Hotel') OR city LIKE '%".$keyword."%' ".$catprops." ) AND pr.property_status = 1 AND  pr.feature_property = 0 AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ";
        $whereClause =" WHERE pr.property_type = 'Hotel' AND pr.property_status = 1 AND  pr.feature_property = 0 AND tb_properties_category_package.package_id IN (".$pckages_ids.") ".$catprops." ";
        //print_r($whereClause); die;
		$orderBy = "ORDER BY price DESC, editor_choice_property DESC  ";
		$limit = " LIMIT ". $pageStart.",".$perPage; 
        $finalQry = "SELECT * FROM (".$query.$whereClause." ORDER BY price DESC) tempX GROUP BY id ".$orderBy.$limit ;
        
        $whereClauseAll =" WHERE pr.property_type = 'Hotel' AND pr.property_status = 1 AND  pr.feature_property = 0 ".$catprops." "; 
        $finalQryAll = "SELECT * FROM (".$query.$whereClauseAll." ORDER BY price DESC) tempX GROUP BY id ".$orderBy ;
        
		$CountRecordQry = "Select count(*) as total_record from tb_properties pr  JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ".$whereClause ;
			
			//Feature Query
		$query = "SELECT pr.editor_choice_property,pr.property_usp,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,pcrp.rack_rate as price, tb_properties_category_package.package_id ";
		$query .= " FROM tb_properties pr LEFT JOIN tb_properties_category_rooms_price pcrp ON pr.id = pcrp.property_id ";
        $query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
		//$whereClause =" WHERE ((pr.property_name LIKE '%".$keyword."%' AND pr.property_type = 'Hotel') OR city LIKE '%".$keyword."%' ".$catprops." ) AND pr.property_status = 1 AND  pr.feature_property = 1 AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ";
        $whereClause =" WHERE pr.property_type = 'Hotel'  AND tb_properties_category_package.package_id IN (".$pckages_ids.") ".$catprops." AND pr.property_status = 1 AND  pr.feature_property = 1 ";
		$orderBy = "ORDER BY RAND()  ";
		$limit = " LIMIT 4";
		$featureQuery = "SELECT * FROM (".$query.$whereClause." ORDER BY price DESC) tempX GROUP BY id ".$orderBy.$limit ; 
		
		  //Editor choice editor_choice_property
        $query = "SELECT pr.editor_choice_property,pr.property_usp,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,pcrp.rack_rate as price, tb_properties_category_package.package_id ";
		$query .= " FROM tb_properties pr LEFT JOIN tb_properties_category_rooms_price pcrp ON pr.id = pcrp.property_id ";
        $query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
		//$whereClause =" WHERE ((pr.property_name LIKE '%".$keyword."%' AND pr.property_type = 'Hotel') OR city LIKE '%".$keyword."%' ".$catprops." ) AND pr.property_status = 1 AND  pr.editor_choice_property = 1 AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ";
        $whereClause =" WHERE  pr.property_type = 'Hotel'  AND tb_properties_category_package.package_id IN (".$pckages_ids.") ".$catprops." AND pr.property_status = 1 AND pr.editor_choice_property = 1 ";
		$orderBy = "ORDER BY RAND()  ";
		$limit = " LIMIT 4";
		$editorQuery = "SELECT * FROM (".$query.$whereClause." ORDER BY price DESC) tempX GROUP BY id ".$orderBy.$limit ; 

        $editorData = DB::select($editorQuery);
		//dd($editorData);
        $this->data['editorPropertiesArr']=$editorData;

		$property = DB::select($finalQry);
		$getRec = DB::select($CountRecordQry);
		$featureData = DB::select($featureQuery);
		
        /*--  Get all the property by membership  --*/
        //echo "<pre>";
        //print_r($property); die;
        $allProperty = DB::select($finalQryAll);
        
        /*-- End --*/
        
        $prop_by_package = array();
        $mem_packages =  \DB::table('tb_packages')->where('package_category', 'B2C')->where('package_status', 1)->orderby('order_num', 'asc')->get();
        if(!empty($mem_packages)){
            $arr_key = '';
            foreach($mem_packages as $pack){
                $pkg_ttl = $pack->package_title;
                $exp_ttl = explode(' ', $pkg_ttl);
                if(!empty($exp_ttl)){
                    $arr_key = $exp_ttl[0];       
                }
                if(!empty($allProperty)){
                    foreach($allProperty as $prop){                        
                        if($prop->package_id == $pack->id)
                            $prop_by_package[$arr_key][] = $prop;  
                    }    
                }            
            }
        }
        //echo "<pre>";
        //print_r($prop_by_package); die;
        $this->data['prop_packages'] = $prop_by_package;
        /*--  End --*/
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
        
        //set folder path
        $efolderArr = array();
        $finalEm = array();
        foreach($emotional_gallery_array as $erow){
            $efid = $erow->folder_id;
            $folderpath = '';
            if(isset($finalEm['f-'.$efid])){ $folderpath = $finalEm['f-'.$efid];}
            else{
                $folderpath = trim($this->getThumbpath($efid));
                $finalEm['f-'.$efid] = $folderpath;
            }
            $erow->imgsrc = $folderpath;
            $finalEm[] = $erow;
        }
        //echo "<pre>"; print_r($finalEm); die;
        //End
        
        $this->data['emotional_gallery'] = $emotional_gallery_array;
        //End 
		$tags_Arr = \DB::table('tb_tags_manager')->where('tag_status', 1)->get();
		$tagsArr = array();
		if (!empty($tags_Arr)) {
			foreach ($tags_Arr as $tags) {
				$tagsArr[$tags->parent_tag_id][] = $tags;
			}
		}
        $this->data['destination_category'] =0;
        
		//if(request()->segment(1)=='luxury_destinations' || request()->segment(1)=='luxury_experience'){
            $this->data['destination_category']=$cateObj->id;
			$this->data['destination_category_instagram']=$cateObj->category_instagram_channel;
        //}
        $this->data['sel_exp'] = trim($keyword);
        
        $this->data['slug'] = $keyword;
        $this->data['dateslug'] = '';
		return view('frontend.themes.emporium.properties.ajax_list', $this->data);
                
    }
    public function fetchcategorybc($id = 0, $child_category_array = '') {

        if (!is_array($child_category_array))
            $child_category_array = array();
		
        $results = \DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name','category_alias')->where('id', $id)->get();
        if ($results) {
            foreach ($results as $row) {
                $child_category_array[] = $row;
                $child_category_array = $this->fetchcategorybc($row->parent_category_id, $child_category_array);
            }
        }
        return $child_category_array;
    }
    public function getDropdownBreadcrumb(Request $request){
        $res = array();
        $destarr = array();
        $dest_url = '';
        $catname = '';
        $catalias = '';
        $keyword = $request->input('cat');        
        $cateObj = \DB::table('tb_categories')->where('category_alias', $keyword)->where('category_published', 1)->first();
        $parent_cat = '';
        if(!empty($cateObj)){
            $destinations = \DB::table('tb_categories')->where('parent_category_id', $cateObj->id)->where('category_approved', 1)->where('category_published', 1)->get();
                    
            $dest_has_prop = array();
            if(!empty($destinations)){
                $selected_category = $destinations[0]->category_name;
                foreach($destinations as $dest){
                    $subdest = \DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name', 'category_youtube_channel_url')->where('parent_category_id', $dest->id)->get();
					$getcats = '';
					$chldIds = array();
					if (!empty($subdest)) {
						$chldIds = $this->fetchcategoryChildListIds($dest->id);
						array_unshift($chldIds, $dest->id);
					} else {
						$chldIds[] = $dest->id;
					}
                    
                    $getcats = "";
                    if (count($chldIds) > 0) { $getcats = " AND (category_id IN(".implode(",",$chldIds)."))"; }
                    $preprops = DB::select(DB::raw("SELECT COUNT(id) AS total_rows FROM property_categories_split_in_rows WHERE property_status = '1' ".$getcats));

					if (isset($preprops[0]->total_rows) && $preprops[0]->total_rows > 0) {
						$destarr[] = $dest;
					}
            
                }
            }
            if (!empty($cateObj)) {
                if($cateObj->id>0){    
                    $dest_url = array_reverse($this->fetchcategorybc($cateObj->id));
    				//$dest_url = implode('/',array_reverse($this->fetchcategoryaliaspath($cateObj->id)));
                }
                $catname = $cateObj->category_name;
                $catalias = $cateObj->category_alias;                                    
            }
            $parent_cat = \DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name', 'category_youtube_channel_url')->where('id', $cateObj->parent_category_id)->first();          
        }        
        $res['destinations'] = $destarr;
        $res['dest_url'] = $dest_url;
        $res['parent_cat'] = $parent_cat;        
        
        $youtube_channels = array();
        if(!empty($destarr)){
            foreach($destarr as $sin_des){
                if($sin_des->category_youtube_channel_url!=''){
                    $youtube_channels[] = $sin_des;        
                }
            }
        }
        $res['youtube_channels'] = $youtube_channels;
        
        $instagram_channels = array();
        if(!empty($destarr)){
            foreach($destarr as $sin_des){
                if($sin_des->category_instagram_channel!=''){
                    $instagram_channels[] = $sin_des;        
                }
            }
        }
        $res['instagram_channels'] = $instagram_channels;
        $res['catname'] = $catname;
        $res['catalias'] = $catalias;
        
        echo json_encode($res);    
    }
    public function getSearchDropdownBreadcrumb(Request $request){
        $res = array();
        $destarr = array();
        $dest_url = '';
        $catname = '';
        $catalias = '';
        $keyword = $request->input('cat');        
        $cateObj = \DB::table('tb_categories')->where('category_name', $keyword)->where('category_published', 1)->first();
        $parent_cat = '';
        if(!empty($cateObj)){
            $destinations = \DB::table('tb_categories')->where('parent_category_id', $cateObj->id)->where('category_approved', 1)->where('category_published', 1)->get();
                    
            $dest_has_prop = array();
            if(!empty($destinations)){
                $selected_category = $destinations[0]->category_name;
                foreach($destinations as $dest){
                    $subdest = \DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name', 'category_youtube_channel_url')->where('parent_category_id', $dest->id)->get();
					$getcats = '';
					$chldIds = array();
					if (!empty($subdest)) {
						$chldIds = $this->fetchcategoryChildListIds($dest->id);
						array_unshift($chldIds, $dest->id);
					} else {
						$chldIds[] = $dest->id;
					}
                    
                    $getcats = "";
                    if (count($chldIds) > 0) { $getcats = " AND (category_id IN(".implode(",",$chldIds)."))"; }
                    $preprops = DB::select(DB::raw("SELECT COUNT(id) AS total_rows FROM property_categories_split_in_rows WHERE property_status = '1' ".$getcats));

					if (isset($preprops[0]->total_rows) && $preprops[0]->total_rows > 0) {
						$destarr[] = $dest;
					}
            
                }
            }
            if (!empty($cateObj)) {
                if($cateObj->id>0){    
                    $dest_url = array_reverse($this->fetchcategorybc($cateObj->id));
    				//$dest_url = implode('/',array_reverse($this->fetchcategoryaliaspath($cateObj->id)));
                }
                $catname = $cateObj->category_name;
                $catalias = $cateObj->category_alias;                                    
            }
            $parent_cat = \DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name', 'category_youtube_channel_url')->where('id', $cateObj->parent_category_id)->first();          
        }        
        $res['destinations'] = $destarr;
        $res['dest_url'] = $dest_url;
        $res['parent_cat'] = $parent_cat;        
        
        $youtube_channels = array();
        if(!empty($destarr)){
            foreach($destarr as $sin_des){
                if($sin_des->category_youtube_channel_url!=''){
                    $youtube_channels[] = $sin_des;        
                }
            }
        }
        $res['youtube_channels'] = $youtube_channels;
        
        $instagram_channels = array();
        if(!empty($destarr)){
            foreach($destarr as $sin_des){
                if($sin_des->category_instagram_channel!=''){
                    $instagram_channels[] = $sin_des;        
                }
            }
        }
        $res['instagram_channels'] = $instagram_channels;
        $res['catname'] = $catname;
        $res['catalias'] = $catalias;
        
        echo json_encode($res);    
    }
    public function getpdppage(Request $request){
        $p_name = $request->input('item');
        
        $arrive_date = '';
        if(\Session::has('arrive')){ 
            $arrive_date =  \CommonHelper::dateformat(trim(\Session::get('arrive')));
        }
        
        $departure_date ='';
        if(\Session::has('departure')){ 
            $departure_date =  \CommonHelper::dateformat(trim(\Session::get('departure')));;
        }
        
        if(\Session::has('booking_rooms')){ 
            $rooms = \Session::get('booking_rooms');
        }else{
            $rooms = 1; 
        }
        
        if(\Session::has('booking_adults')){ 
            $adults = \Session::get('booking_adults');
        }else{
            $adults = 1; 
        }
        
        $child = '';
        if(\Session::has('booking_children')){ 
            $child = \Session::get('booking_children');
        }
        
        if(\Session::has('travellerType')){ 
            $travellerType = \Session::get('travellerType');
        }else{
            $travellerType = 0; 
        }
        
        $tr_2_rooms = "";
        if(\Session::has('tr_2_rooms')){ 
            $tr_2_rooms = \Session::get('tr_2_rooms');
        }
        
        $tr_2_adults = ""; 
        if(\Session::has('tr_2_adults')){ 
            $tr_2_adults = \Session::get('tr_2_adults');
        }
        
        $tr_2_child = "";
        if(\Session::has('tr_2_child')){ 
            $tr_2_child = \Session::get('tr_2_child');
        }
        
        $tr_3_rooms = "";
        if(\Session::has('tr_3_rooms')){ 
            $tr_3_rooms = \Session::get('tr_3_rooms');
        }
        
        $tr_3_adults = ""; 
        if(\Session::has('tr_3_adults')){ 
            $tr_3_adults = \Session::get('tr_3_adults');
        }
        
        $tr_3_child = "";
        if(\Session::has('tr_3_child')){ 
            $tr_3_child = \Session::get('tr_3_child');
        }
        
        $tr_4_rooms = 1; 
        if(\Session::has('tr_4_rooms')){ 
            $tr_4_rooms = \Session::get('tr_4_rooms');
        }
        
        $tr_4_adults = 1;
        if(\Session::has('tr_4_adults')){ 
            $tr_4_adults = \Session::get('tr_4_adults');
        }
        
        $child_2_ages = "";
        if(\Session::has('child_2_ages')){ 
            $child_2_ages = \Session::get('child_2_ages');
        }
        
        $child_3_ages = ""; 
        if(\Session::has('child_3_ages')){ 
            $child_3_ages = \Session::get('child_3_ages');
        }
        
        $total_guests = (int)$adults + (int)(($child=='') ? 0 : $child);
        
        $propertiesArr = array();
		$crpropertiesArr = array();
		$relatedgridpropertiesArr = array();
        $props = \DB::table('tb_properties')->select('tb_properties.*')->where("property_name", $p_name)->first();
        
        $number_of_nights = 1;
        if($arrive_date != '' && $departure_date != '') {
            $date1 = date_create(date('Y-m-d H:i:s', strtotime($departure_date)));
            $date2 = date_create(date('Y-m-d H:i:s', strtotime($arrive_date)));
            $diff = date_diff($date1, $date2);
            $number_of_nights = $diff->format("%a");            
        }
        
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
			$new_result = array();
            $no_of_rooms = '';
			//$cat_types = \DB::table('tb_properties_category_types')->select('id','category_name','room_desc')->where('property_id', $props->id)->where('status', 0)->where('show_on_booking', 1)->get();
            
            $query = "SELECT COUNT(id) as noOfRooms, property_id, category_id FROM tb_properties_category_rooms where 1=1 and ";
            $query .=" (CASE WHEN tb_properties_category_rooms.active_full_year = 0 THEN ";
            $query .="( tb_properties_category_rooms.room_active_from <= '".$arrive_date."' AND tb_properties_category_rooms.room_active_to >= '".$departure_date."')";
            $query .=" ELSE tb_properties_category_rooms.active_full_year = 1 END) ";                            
            $query .=" and tb_properties_category_rooms.id not IN (select td_reserved_rooms.room_id from tb_reservations INNER join td_reserved_rooms on td_reserved_rooms.reservation_id=tb_reservations.id where '".$arrive_date."' BETWEEN checkin_date and checkout_date or '".$departure_date."' BETWEEN checkin_date and checkout_date)";                
            $query .=" and property_id=".$props->id." GROUP BY category_id";
                
            $result = DB::SELECT($query);
            //print_r($result); die;
            if(!empty($result)){
                foreach($result as $sin){
                    $new_result[$sin->category_id]=$sin;                    
                }
            }    
            
            $cat_types = \DB::table('tb_properties_category_types')->where('property_id', $props->id)->where('status', 0)->where('show_on_booking', 1)->get();
            if (!empty($cat_types)) {
                $c = 0;
                foreach ($cat_types as $type) {
                    
                    if(array_key_exists($type->id, $new_result)){
                        $no_of_rooms =  $new_result[$type->id]->noOfRooms;   
                    }
                    if($no_of_rooms >= $rooms){
                        if($number_of_nights >= $type->minimum_stay){
                        
                            
                            
                            /*$query2 = "SELECT property_id, category_id FROM tb_properties_category_rooms where 1=1 and ";
                            $query2 .=" (CASE WHEN tb_properties_category_rooms.active_full_year = 0 THEN ";
                            $query2 .="( tb_properties_category_rooms.room_active_from <= '".$arrive_date."' AND tb_properties_category_rooms.room_active_to >= '".$departure_date."')";
                            $query2 .=" ELSE tb_properties_category_rooms.active_full_year = 1 END) ";                            
                            $query2 .=" and tb_properties_category_rooms.id not IN (select td_reserved_rooms.room_id from tb_reservations INNER join td_reserved_rooms on td_reserved_rooms.reservation_id=tb_reservations.id where '".$arrive_date."' BETWEEN checkin_date and checkout_date or '".$departure_date."' BETWEEN checkin_date and checkout_date)";
                            $query2 .=" and property_id=".$props->id." and category_id=".$type->id;
                            
                            $check_availability = DB::SELECT($query2);
                            
                            print_r($check_availability); die; */
                            
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
                                
                                $reserved_room_bytype = \DB::table('tb_reservations')->join('td_reserved_rooms','tb_reservations.id','=','td_reserved_rooms.reservation_id')->where('td_reserved_rooms.type_id', $type->id)->get();                                             
                                
                                $type_cale = $this->viewcalendar($type->id, $curnDate);
                                
                                $propertiesArr['typedata'][$c]->room_calendar = $type_cale;
                                
        						$c++;
                            }
                        
                        }
                    }
                    
                }
                if(!empty($propertiesArr['typedata'])){
                    usort($propertiesArr['typedata'], function($a, $b) {
                        return trim($a->price) < trim($b->price);
                    });
                }
            }
            
            $prop_package = \DB::table('tb_properties_category_package')->join("tb_packages", "tb_packages.id", "=", "tb_properties_category_package.package_id")->where('property_id', $props->id)->first();
            $package_type = trim($prop_package->package_title);             
            $package_type = strtolower(str_replace(' ', '-', trim($package_type)));
            switch($package_type){
                case "lifestyle-membership":
                    $type = "lifestyle-collection";                            
                    break;
                case "dedicated-membership":
                    $type = "dedicated-collection";                            
                    break;
                case "bespoke-membership":
                    $type = "bespoke-collection";                            
                    break;                
            }
                        
            $this->data['ptype'] = $type;
            $isPackage = $this->checkPropertyPackage($props->id);                        
            $this->data['propertyPackage'] = $isPackage;
            $this->data['propertyDetail'] = $propertiesArr;
            $this->data['relatedproperties'] = $crpropertiesArr;
    		$this->data['relatedgridpropertiesArr'] = $relatedgridpropertiesArr;
    		$this->data['propertyEvents'] = \DB::table('tb_events')->where('property_id', $props->id)->get();
            $this->data['packages'] = \DB::table('tb_packages')->where('package_category', 'B2C')->where('package_status', 1)->get(); 
        }
        echo json_encode($this->data);        
    }
    public function getdestinationpage(Request $request){
        $destDetails = array();
        $keyword = $request->input('item');
        
        $cateObj = \DB::table('tb_categories')->where('category_alias', $keyword)->where('category_published', 1)->first();       
        
		
        
        
        $this->data['keyword'] = $keyword;
        $this->data['destination'] = $destDetails;
        echo json_encode($this->data);    
    }
            
    
    public function propertysearchlistbycollection(Request $request){             
        $coll_type = $request->input('coll_type'); 
        $cat = $request->input('cat');
        
        $membershiptype =  $coll_type;
        $keyword = $cat;
         
		$catprops = '';   
        
        $arrive_date = '';
        if(\Session::has('arrive')){ 
            $arrive_date =  \CommonHelper::dateformat(trim(\Session::get('arrive')));
        }
        
        $departure_date ='';
        if(\Session::has('departure')){ 
            $departure_date =  \CommonHelper::dateformat(trim(\Session::get('departure')));;
        }
        
        if(\Session::has('booking_rooms')){ 
            $rooms = \Session::get('booking_rooms');
        }else{
            $rooms = 1; 
        }
        
        if(\Session::has('booking_adults')){ 
            $adults = \Session::get('booking_adults');
        }else{
            $adults = 1; 
        }
        
        $child = '';
        if(\Session::has('booking_children')){ 
            $child = \Session::get('booking_children');
        }
        
        if(\Session::has('travellerType')){ 
            $travellerType = \Session::get('travellerType');
        }else{
            $travellerType = 0; 
        }
        
        $tr_2_rooms = "";
        if(\Session::has('tr_2_rooms')){ 
            $tr_2_rooms = \Session::get('tr_2_rooms');
        }
        
        $tr_2_adults = ""; 
        if(\Session::has('tr_2_adults')){ 
            $tr_2_adults = \Session::get('tr_2_adults');
        }
        
        $tr_2_child = "";
        if(\Session::has('tr_2_child')){ 
            $tr_2_child = \Session::get('tr_2_child');
        }
        
        $tr_3_rooms = "";
        if(\Session::has('tr_3_rooms')){ 
            $tr_3_rooms = \Session::get('tr_3_rooms');
        }
        
        $tr_3_adults = ""; 
        if(\Session::has('tr_3_adults')){ 
            $tr_3_adults = \Session::get('tr_3_adults');
        }
        
        $tr_3_child = "";
        if(\Session::has('tr_3_child')){ 
            $tr_3_child = \Session::get('tr_3_child');
        }
        
        $tr_4_rooms = 1; 
        if(\Session::has('tr_4_rooms')){ 
            $tr_4_rooms = \Session::get('tr_4_rooms');
        }
        
        $tr_4_adults = 1;
        if(\Session::has('tr_4_adults')){ 
            $tr_4_adults = \Session::get('tr_4_adults');
        }
        
        $child_2_ages = "";
        if(\Session::has('child_2_ages')){ 
            $child_2_ages = \Session::get('child_2_ages');
        }
        
        $child_3_ages = ""; 
        if(\Session::has('child_3_ages')){ 
            $child_3_ages = \Session::get('child_3_ages');
        }
        
        $total_guests = (int)$adults + (int)(($child=='') ? 0 : $child);
        
        $propertiesArr = array();
		$crpropertiesArr = array();
		$relatedgridpropertiesArr = array();
        
        
        $number_of_nights = 1;
        if($arrive_date != '' && $departure_date != '') {
            $date1 = date_create(date('Y-m-d H:i:s', strtotime($departure_date)));
            $date2 = date_create(date('Y-m-d H:i:s', strtotime($arrive_date)));
            $diff = date_diff($date1, $date2);
            $number_of_nights = $diff->format("%a");            
        }
        
        /*$arrive = $departure = $adult = $childs = '';
		if (!is_null($request->arrive) && $request->arrive != '') {
			\Session::put('arrive', $request->arrive);
			$this->data['arrive_date'] = $request->arrive;
			$this->data['dateslug'] = $request->arrive;
			$arrive = date("Y-m-d", strtotime(trim($request->arrive)));
		}
		if (!is_null($request->departure) && $request->departure != '') {
			\Session::put('departure', $request->departure);
			$this->data['departure_date'] = $request->departure;
			$this->data['dateslug'] = $this->data['dateslug'].' to '.$request->departure;
			$departure = date("Y-m-d", strtotime(trim($request->departure)));
		}*/
        
        $req_for = $request->input('req_for');
		/* Default package */
        $pckages_ids = '';
        
        $public_package = \DB::table('tb_packages')->select('id')->where('package_category', 'B2C')->where('is_public', 1)->first();
        if(!empty($public_package)){
            $pckages_ids = $public_package->id;
        } 
        
        if($membershiptype!=''){
            if($membershiptype!='lifestyle-collection'){
                $exp_membership = explode('-', $membershiptype);
                if(!empty($exp_membership)){
                    $_type = $exp_membership[0];
                    if($_type=='dedicated'){
                        $mem_package = \DB::table('tb_packages')->select('id')->where('package_title', 'Dedicated Membership')->first();
                        $pckages_ids = $mem_package->id;   
                    }else if($_type=='bespoke'){
                        $mem_package = \DB::table('tb_packages')->select('id')->where('package_title', 'Bespoke Membership')->first();
                        $pckages_ids = $mem_package->id;  
                    }
                }
                $public_package = \DB::table('tb_packages')->select('id')->where('package_category', 'B2C')->where('is_public', 1)->first();
            }
        }else{
            if (\Auth::check() == true) {
                if(\Auth::user()->group_id!=1){
                    $uid = \Auth::user()->id;
                    if(\Auth::user()->member_type!=''){
                        $memtype = str_replace('-', ' ', \Auth::user()->member_type); 
                        $arr_membershiptype = explode('-', \Auth::user()->member_type); 
                        if(count($arr_membershiptype)>0){
                            $membershiptype = $arr_membershiptype[0]."-collection";    
                        }    
                        //print_r($membershiptype);      
                        $mem_package = \DB::table('tb_packages')->select('id')->where('package_title', $memtype)->first();
                        //print_r($mem_package); die;  
                        $pckages_ids = $mem_package->id; 
                    }  
                }
            }            
        }
        
        
        
        
        //print_r($pckages_ids); die;   
        /* End */   
        //echo $keyword; die;   
		$cateObj = \DB::table('tb_categories')->where('category_name', $keyword)->where('category_published', 1)->first();
       

        $chldIds = array();
        $getcatsID = array();
        if (!empty($cateObj)) {
            $channel_url = $cateObj->category_youtube_channel_url;
            $this->data['channel_url'] = $channel_url;
            
            $social_url = $cateObj->category_instagram_channel;
            $this->data['social_url'] = $social_url;
            
            $this->data['dest_id'] = $cateObj->id;
            
            $this->data['category_image'] = $cateObj->category_image;
            $this->data['category_instagram_tag'] = $cateObj->category_instagram_tag;
            $this->data['category_name'] = $cateObj->category_name;
            
            //get all children start
            $chldIds = $this->fetchcategoryChildListIds($cateObj->id);
            //End
            //print_r($chldIds); die;
            if(count($chldIds) <= 0){ 
                $chldIds[] = $cateObj->id; 
            }else{
                array_unshift($chldIds, $cateObj->id);
            }
            
            
            if (count($chldIds) > 0) { 
                $impload_ids = implode(',',$chldIds);
                $catcond = " AND (pr.category_id IN(".$impload_ids."))";
                /*$catcond = " AND (" . implode(" || ", array_map(function($v) {
									return sprintf("FIND_IN_SET('%s', pr.property_category_id)", $v);
								}, array_values($chldIds))) . ")";*/
                
                $ch_queries = "SELECT pr.id FROM property_categories_split_in_rows pr WHERE pr.property_status='1' ".$catcond." GROUP BY pr.id";
                
                if(strlen(trim($arrive_date)) > 0){
                    $ch_queries = "";
                    $getdestind = "";
                    if (strlen(trim($departure_date)) > 0) { $getdestind = " AND pctr.room_active_to <= '".$departure_date."'"; }
                    $ch_queries = "SELECT pr.id FROM property_categories_split_in_rows pr, tb_properties_category_rooms pctr, tb_properties_category_types pct WHERE pctr.property_id = pr.id AND  pct.property_id = pr.id AND pr.property_status='1' AND  (CASE WHEN pctr.active_full_year = 0 THEN pctr.room_active_from >= '".$arrive_date."' ".$getdestind." ELSE pctr.active_full_year = 1 END) and pct.minimum_stay<=".$number_of_nights." ".$catcond." GROUP BY pr.id";
                    
                }
                //print_r($ch_queries); die;
                $ch_queries = trim($ch_queries);
                if(strlen($ch_queries) > 0){
                    $childresult = DB::select($ch_queries);
                    
                    foreach($childresult as $siChild){
                        $getcatsID[] = $siChild->id;
                    }
                }
            }
        }
        
        $perPage = 20;
		$pageNumber = 1;
        
        if(isset($request->page) && $request->page>0){
			$pageNumber = $request->page;
		}
		$pageStart = ($pageNumber -1) * $perPage;
        
        $editorData = array();
        $property = array();
        $getRec = array();
        $featureData = array();
        $allProperty = array();
        
        $new_result = array();
        
        /*if(count($getcatsID) > 0){
            $timplod = implode(',',$getcatsID);            
            $catprops = " AND pr.id in(".$timplod.") ";		
            
            $objcat = \DB::table('tb_properties_category_types')->whereIn('property_id', $getcatsID)->get();
            //print_r($objcat); die;
            if(!empty($objcat)){
                foreach($objcat as $sin){
                                        
                }
            }    
        
            foreach($getcatsID as $pid){
                if(array_key_exists($pid, $new_result)){
                    if($new_result[$pid]->noOfRooms >=$rooms ){
                        
                    }else{
                        unset($getcatsID[array_search($pid,$getcatsID)]);    
                    }
                }
            }
        }*/
        
        if(count($getcatsID) > 0){
            $timplod = implode(',',$getcatsID);
            //$catprops = " OR pr.id in(".$timplod.") ";
            $catprops = " AND pr.id in(".$timplod.") ";
		
            
            $countquery = "SELECT COUNT(id) as noOfRooms, property_id, category_id FROM tb_properties_category_rooms where 1=1 and ";
            $countquery .=" (CASE WHEN tb_properties_category_rooms.active_full_year = 0 THEN ";
            $countquery .="( tb_properties_category_rooms.room_active_from <= '".$arrive_date."' AND tb_properties_category_rooms.room_active_to >= '".$departure_date."')";
            $countquery .=" ELSE tb_properties_category_rooms.active_full_year = 1 END) ";                            
            $countquery .=" and tb_properties_category_rooms.id not IN (select td_reserved_rooms.room_id from tb_reservations INNER join td_reserved_rooms on td_reserved_rooms.reservation_id=tb_reservations.id where '".$arrive_date."' BETWEEN checkin_date and checkout_date or '".$departure_date."' BETWEEN checkin_date and checkout_date)";                
            $countquery .=" and property_id IN(".$timplod.") GROUP BY category_id";              
               
            $roomCountResult = DB::SELECT($countquery);
            
            if(!empty($roomCountResult)){
                foreach($roomCountResult as $sin){
                    $new_result[$sin->property_id]=$sin;                    
                }
            }    
        
            foreach($getcatsID as $pid){
                if(array_key_exists($pid, $new_result)){
                    if($new_result[$pid]->noOfRooms >=$rooms ){
                        
                    }else{
                        unset($getcatsID[array_search($pid,$getcatsID)]);    
                    }
                }
            }
        }
        
        if(count($getcatsID) > 0){
            $timplod = implode(',',$getcatsID);
            //$catprops = " OR pr.id in(".$timplod.") ";
            $catprops = " AND pr.id in(".$timplod.") ";
		
            
            $query = "SELECT pr.editor_choice_property,pr.property_usp,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,pcrp.rack_rate as price, tb_properties_category_package.package_id ";
    		$query .= " FROM tb_properties pr LEFT JOIN tb_properties_category_rooms_price pcrp ON pr.id = pcrp.property_id ";
            $query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
    		//$whereClause =" WHERE ((pr.property_name LIKE '%".$keyword."%' AND pr.property_type = 'Hotel') OR city LIKE '%".$keyword."%' ".$catprops." ) AND pr.property_status = 1 AND  pr.feature_property = 0 AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ";
            $whereClause =" WHERE pr.property_type = 'Hotel' AND pr.property_status = 1 AND  pr.feature_property = 0 AND tb_properties_category_package.package_id IN (".$pckages_ids.") ".$catprops." ";
            //print_r($whereClause); die;
    		$orderBy = "ORDER BY price DESC, editor_choice_property DESC  ";
    		$limit = " LIMIT ". $pageStart.",".$perPage; 
            $finalQry = "SELECT * FROM (".$query.$whereClause." ORDER BY price DESC) tempX GROUP BY id ".$orderBy.$limit ;
            
            $whereClauseAll =" WHERE pr.property_type = 'Hotel' AND pr.property_status = 1 AND  pr.feature_property = 0 ".$catprops." "; 
            $finalQryAll = "SELECT * FROM (".$query.$whereClauseAll." ORDER BY price DESC) tempX GROUP BY id ".$orderBy ;
            
    		$CountRecordQry = "Select count(*) as total_record from tb_properties pr  JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ".$whereClause ;
    			
    			//Feature Query
    		$query = "SELECT pr.editor_choice_property,pr.property_usp,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,pcrp.rack_rate as price, tb_properties_category_package.package_id ";
    		$query .= " FROM tb_properties pr LEFT JOIN tb_properties_category_rooms_price pcrp ON pr.id = pcrp.property_id ";
            $query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
    		//$whereClause =" WHERE ((pr.property_name LIKE '%".$keyword."%' AND pr.property_type = 'Hotel') OR city LIKE '%".$keyword."%' ".$catprops." ) AND pr.property_status = 1 AND  pr.feature_property = 1 AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ";
            $whereClause =" WHERE pr.property_type = 'Hotel'  AND tb_properties_category_package.package_id IN (".$pckages_ids.") ".$catprops." AND pr.property_status = 1 AND  pr.feature_property = 1 ";
    		$orderBy = "ORDER BY RAND()  ";
    		$limit = " LIMIT 4";
    		$featureQuery = "SELECT * FROM (".$query.$whereClause." ORDER BY price DESC) tempX GROUP BY id ".$orderBy.$limit ; 
    		
    		  //Editor choice editor_choice_property
            $query = "SELECT pr.editor_choice_property,pr.property_usp,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,pcrp.rack_rate as price, tb_properties_category_package.package_id ";
    		$query .= " FROM tb_properties pr LEFT JOIN tb_properties_category_rooms_price pcrp ON pr.id = pcrp.property_id ";
            $query .= " JOIN tb_properties_category_package ON tb_properties_category_package.property_id = pr.id ";
    		//$whereClause =" WHERE ((pr.property_name LIKE '%".$keyword."%' AND pr.property_type = 'Hotel') OR city LIKE '%".$keyword."%' ".$catprops." ) AND pr.property_status = 1 AND  pr.editor_choice_property = 1 AND tb_properties_category_package.package_id IN (".$this->pckages_ids.") ";
            $whereClause =" WHERE  pr.property_type = 'Hotel'  AND tb_properties_category_package.package_id IN (".$pckages_ids.") ".$catprops." AND pr.property_status = 1 AND pr.editor_choice_property = 1 ";
    		$orderBy = "ORDER BY RAND()  ";
    		$limit = " LIMIT 4";
    		$editorQuery = "SELECT * FROM (".$query.$whereClause." ORDER BY price DESC) tempX GROUP BY id ".$orderBy.$limit ; 
    
            $editorData = DB::select($editorQuery);
    		$property = DB::select($finalQry);
    		$getRec = DB::select($CountRecordQry);
    		$featureData = DB::select($featureQuery);
    		
            /*--  Get all the property by membership  --*/
            //echo "<pre>";
            //print_r($property); die;
            $allProperty = DB::select($finalQryAll);
        
        }
        /*-- End --*/
        $this->data['editorPropertiesArr']=$editorData;
        
        $prop_by_package = array();
        $mem_packages =  \DB::table('tb_packages')->where('package_category', 'B2C')->where('package_status', 1)->orderby('order_num', 'asc')->get();
        if(!empty($mem_packages)){
            $arr_key = '';
            foreach($mem_packages as $pack){
                $pkg_ttl = $pack->package_title;
                $exp_ttl = explode(' ', $pkg_ttl);
                if(!empty($exp_ttl)){
                    $arr_key = strtolower($exp_ttl[0]);       
                }
                if(!empty($allProperty)){
                    foreach($allProperty as $prop){                        
                        if($prop->package_id == $pack->id)
                            $prop_by_package[$arr_key][] = $prop;  
                    }    
                }            
            }
        }
        //echo "<pre>";
        //print_r($prop_by_package); die;
        $this->data['prop_packages'] = $prop_by_package;
        /*--  End --*/
		$this->data['featurePropertiesArr']=$featureData;
		$this->data['propertiesArr'] = $property;
        $total_rec = 0;
        $total_pages = 0;
        if(!empty($getRec)){
            $total_rec =  $getRec[0]->total_record; 
            $total_pages = (isset($getRec[0]->total_record) && $getRec[0]->total_record>0)?(int)ceil($getRec[0]->total_record / $perPage):0;  
        }
		$this->data['total_record'] = $total_rec;
		$this->data['total_pages'] = $total_pages;
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
        
        //set folder path
        $efolderArr = array();
        $finalEm = array();
        foreach($emotional_gallery_array as $erow){
            $efid = $erow->folder_id;
            $folderpath = '';
            if(isset($finalEm['f-'.$efid])){ $folderpath = $finalEm['f-'.$efid];}
            else{
                $folderpath = trim($this->getThumbpath($efid));
                $finalEm['f-'.$efid] = $folderpath;
            }
            $erow->imgsrc = $folderpath;
            $finalEm[] = $erow;
        }
        //echo "<pre>"; print_r($finalEm); die;
        //End
        
        $this->data['emotional_gallery'] = $emotional_gallery_array;
        //End 
		$tags_Arr = \DB::table('tb_tags_manager')->where('tag_status', 1)->get();
		$tagsArr = array();
		if (!empty($tags_Arr)) {
			foreach ($tags_Arr as $tags) {
				$tagsArr[$tags->parent_tag_id][] = $tags;
			}
		}
        $this->data['destination_category'] =0;
        $resultads = array();
        if($req_for == 'luxury_destinations' || $req_for=='luxury_experience' ){
            if($cateObj->id > 0){
    		//if(request()->segment(1)=='luxury_destinations' || request()->segment(1)=='luxury_experience'){
                $this->data['destination_category']=$cateObj->id;
    			$this->data['destination_category_instagram']=$cateObj->category_instagram_channel;
            //}
            }
        
            if($cateObj->id > 0){
                $adscatid = ($cateObj->id > 0) ? $cateObj->id : 'Hotel'; 
                $resultads = \CommonHelper::getGridResultAds('grid_results', $adscatid);
                //$this->data['resultads'] = $resultads;
            }
        }
        $this->data['resultads'] = $resultads;
        $this->data['sel_exp'] = trim($keyword);        
        $this->data['slug'] = $keyword;
        $this->data['dateslug'] = '';
        
        echo json_encode(array('data'=>$this->data));
        exit();
		//return view('frontend.themes.emporium.properties.ajax_list', $this->data);
                
    }
    function allPropertySearch(Request $request) {        
        $membershiptype =  $request->membershiptype;
                
		$selCurrency=$request->input("currencyOption");
        \Session::put('currencyOption', $selCurrency);
		
		$this->data["convertedOneUnitPrice"]=0;
        
        $keyword = trim($request->cat);
        $show = 'asc';
        
        $this->data['dateslug'] = '';
		$arrive = $departure = $adult = $childs = '';
		if (!is_null($request->arrive) && $request->arrive != '') {
			\Session::put('arrive', $request->arrive);			
			$arrive = date("Y-m-d", strtotime(trim($request->arrive)));
		}
		if (!is_null($request->departure) && $request->departure != '') {
			\Session::put('departure', $request->departure);			
			$departure = date("Y-m-d", strtotime(trim($request->departure)));
		}


		$catprops = '';   
        $catname = '';
        $catalias = '';
        $catid = '';
		/* Default package */
        $pckages_ids = '';
        $default_package = '';
        
        $public_package = \DB::table('tb_packages')->select('id')->where('package_category', 'B2C')->where('is_public', 1)->first();
        if(!empty($public_package)){
            $pckages_ids = $public_package->id;            
        } 
        
        $selected_category = '';
        
        if($membershiptype!=''){
            if($membershiptype!='lifestyle-collection'){
                $exp_membership = explode('-', $membershiptype);
                if(!empty($exp_membership)){
                    $_type = $exp_membership[0];
                    if($_type=='dedicated'){
                        $mem_package = \DB::table('tb_packages')->select('id')->where('package_title', 'Dedicated Membership')->first();
                        $pckages_ids = $mem_package->id;   
                    }else if($_type=='bespoke'){
                        $mem_package = \DB::table('tb_packages')->select('id')->where('package_title', 'Bespoke Membership')->first();
                        $pckages_ids = $mem_package->id;  
                    }
                }
                $public_package = \DB::table('tb_packages')->select('id')->where('package_category', 'B2C')->where('is_public', 1)->first();
            }
        }else{
            if (\Auth::check() == true) {
                if(\Auth::user()->group_id!=1){
                    $uid = \Auth::user()->id;
                    if(\Auth::user()->member_type!=''){
                        $memtype = str_replace('-', ' ', \Auth::user()->member_type); 
                        $arr_membershiptype = explode('-', \Auth::user()->member_type); 
                        if(count($arr_membershiptype)>0){
                            $membershiptype = $arr_membershiptype[0]."-collection";    
                        }    
                        //print_r($membershiptype);      
                        $mem_package = \DB::table('tb_packages')->select('id')->where('package_title', $memtype)->first();
                        //print_r($mem_package); die;  
                        $pckages_ids = $mem_package->id;
                    }    
                }
            }            
        }
        $this->data['default_package'] = $default_package;           
        /* End */   
           
		//$cateObj = \DB::table('tb_categories')->where('category_alias', $keyword)->where('category_published', 1)->first();
       
        
		$this->data['slug'] = $keyword;

		$this->data['action']=request()->segments(1);
        $this->data['destination_category'] =0;       
        
        $search_for = '';
        
        $destarr = array();
        $dd_destarr = array();
        
        $m_collection = \DB::table('tb_categories')->where('category_alias', 'our-collection')->where('category_approved', 1)->where('category_published', 1)->first();   
        $cat_collection = array();                
        if(!empty($m_collection)){
            $cat_collection = \DB::table('tb_categories')->where('parent_category_id', $m_collection->id)->where('category_approved', 1)->where('category_published', 1)->orderBy('category_order_num', 'asc')->get();
        }
        $this->data['collections'] = $cat_collection;
        $this->data['selected_category'] = $selected_category;
        $this->data['bc_dest'] = $dest_url; //print_r($this->data['bc_dest']); die;
        $this->data['destinations'] = $destarr;
        
        $this->data['dd_destinations'] = $dd_destarr;
        
        $this->data['search_for'] = $search_for;
        
        $this->data['req_for'] = request()->segment(1);
        $this->data['sel_exp'] = trim($request->cat);
        $this->data['catname'] = $catname;
        $this->data['catalias'] = $catalias;
        $this->data['catid'] = $catid;
        $this->data['m_type'] = ($membershiptype !='' ? $membershiptype : 'lifestyle-collection');
        
		return view('frontend.themes.emporium.properties.list', $this->data);
                    
    }
    function featuredproperties(Request $request){
        $type = $request->input('type');
        $collection = $request->input('collection');
        /** Collection connection **/
        $voyageconn = "voyageconn";            
        $safariconn = "safariconn";          
        $spaconn = "spaconn";            
        $islandconn = "islandconn";
        /** End Connection */ 
        
        /** Start */
        $site_url = '';
        if($collection=='voyage'){
            $site_url = 'https://emporium-voyage.com';              
            //$site_url = 'http://staging.emporium-voyage.com/';
        }elseif($collection=='safari'){
            $site_url = 'https://emporium-safari.com';
        }elseif($collection=='spa'){
            $site_url = 'https://emporium-spa.com'; 
        }elseif($collection=='islands'){
            $site_url = 'https://emporium-islands.com';
        }
        /** End */
        $featured_hotel = array();
        $obj_featured_hotel = array();
        /*if($type=="hotel"){*/
            if($collection == 'voyage'){
                $featured_hotel = \DB::connection($voyageconn)->table('tb_properties')->where('feature_property', 1)->orderByRaw(DB::raw("RAND()"))->limit(2)->get();             
                foreach($featured_hotel as $props){                
                
                    $propimage = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_container_files.id', 'tb_container_files.file_name', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->get();
                    $propimage_thumbpath = '';
                    $propimage_thumbpath_dir= '';
                    $propimage_containerpath = '';
                    if(!empty($propimage)){
                        $propimage_thumbpath = $site_url.(new ContainerController)->getThumbpathForSearch($propimage[0]->folder_id);
            			//$propimage_thumbpath_dir = public_path(str_replace(url().'/', '', (new ContainerController)->getThumbpath($propimage[0]->folder_id))); 
                        //$propimage_containerpath = (new ContainerController)->getContainerUserPath($propimage[0]->folder_id);
        			}
                    $prop['propimage'] = $propimage;
                    $prop['thumb'] = $propimage_thumbpath;
                    //$prop['thumb_dir'] = $propimage_thumbpath_dir;
                    //$prop['containerpath'] = $propimage_thumbpath_dir;
                    $prop['objprop'] = $props;
                    
                    $obj_featured_hotel[] = $prop;
                }
                
            }elseif($collection == 'spa'){
                $featured_hotel = \DB::connection($spaconn)->table('tb_properties')->where('feature_property', 1)->orderByRaw(DB::raw("RAND()"))->limit(2)->get();
                foreach($featured_hotel as $props){                
                
                    $propimage = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_container_files.id', 'tb_container_files.file_name', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->get();
                    $propimage_thumbpath = '';
                    $propimage_thumbpath_dir= '';
                    $propimage_containerpath = '';
                    if(!empty($propimage)){
                        $propimage_thumbpath = $site_url.(new ContainerController)->getThumbpathForSearch($propimage[0]->folder_id);
            			//$propimage_thumbpath_dir = public_path(str_replace(url().'/', '', (new ContainerController)->getThumbpath($propimage[0]->folder_id))); 
                        //$propimage_containerpath = (new ContainerController)->getContainerUserPath($propimage[0]->folder_id);
        			}
                    $prop['propimage'] = $propimage;
                    $prop['thumb'] = $propimage_thumbpath;
                    //$prop['thumb_dir'] = $propimage_thumbpath_dir;
                    //$prop['containerpath'] = $propimage_thumbpath_dir;
                    $prop['objprop'] = $props;
                    
                    $obj_featured_hotel[] = $prop;
                }
            }elseif($collection == 'safari'){
                $featured_hotel = \DB::connection($safariconn)->table('tb_properties')->where('feature_property', 1)->orderByRaw(DB::raw("RAND()"))->limit(2)->get();
                foreach($featured_hotel as $props){                
                
                    $propimage = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_container_files.id', 'tb_container_files.file_name', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->get();
                    $propimage_thumbpath = '';
                    $propimage_thumbpath_dir= '';
                    $propimage_containerpath = '';
                    if(!empty($propimage)){
                        $propimage_thumbpath = $site_url.(new ContainerController)->getThumbpathForSearch($propimage[0]->folder_id);
            			//$propimage_thumbpath_dir = public_path(str_replace(url().'/', '', (new ContainerController)->getThumbpath($propimage[0]->folder_id))); 
                        //$propimage_containerpath = (new ContainerController)->getContainerUserPath($propimage[0]->folder_id);
        			}
                    $prop['propimage'] = $propimage;
                    $prop['thumb'] = $propimage_thumbpath;
                    //$prop['thumb_dir'] = $propimage_thumbpath_dir;
                    //$prop['containerpath'] = $propimage_thumbpath_dir;
                    $prop['objprop'] = $props;
                    
                    $obj_featured_hotel[] = $prop;
                }
            }elseif($collection == 'islands'){
                $featured_hotel = \DB::connection($islandconn)->table('tb_properties')->where('feature_property', 1)->orderByRaw(DB::raw("RAND()"))->limit(2)->get();
                foreach($featured_hotel as $props){                
                
                    $propimage = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_container_files.id', 'tb_container_files.file_name', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->get();
                    $propimage_thumbpath = '';
                    $propimage_thumbpath_dir= '';
                    $propimage_containerpath = '';
                    if(!empty($propimage)){
                        $propimage_thumbpath = $site_url.(new ContainerController)->getThumbpathForSearch($propimage[0]->folder_id);
            			//$propimage_thumbpath_dir = public_path(str_replace(url().'/', '', (new ContainerController)->getThumbpath($propimage[0]->folder_id))); 
                        //$propimage_containerpath = (new ContainerController)->getContainerUserPath($propimage[0]->folder_id);
        			}
                    $prop['propimage'] = $propimage;
                    $prop['thumb'] = $propimage_thumbpath;
                    //$prop['thumb_dir'] = $propimage_thumbpath_dir;
                    //$prop['containerpath'] = $propimage_thumbpath_dir;
                    $prop['objprop'] = $props;
                    
                    $obj_featured_hotel[] = $prop;
                }
            }             
        /*}else{
            
        }*/
        //echo "</pre>";
        //print_r($obj_featured_hotel); die;
        
        if(count($obj_featured_hotel)>0){
            $res['status'] = 'success';
            $res['data'] = $obj_featured_hotel;
        }else{
            $res['status'] = 'error';
        }
        
        echo json_encode($res);
    }
}
