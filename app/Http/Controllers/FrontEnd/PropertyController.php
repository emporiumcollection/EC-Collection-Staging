<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\ContainerController;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Http\Controllers\Controller;
use App\User;
use DB,Validator, Input, Redirect;
class PropertyController extends Controller {

    public function __construct() {
        parent::__construct();
        
    }
    
    /* Method : getPropertyDetail
     *   Description : The Methos is using for property detai page (PDP)
    */
	
	public function getPropertyGridListByCategory(Request $request)
	{
		$this->data['slug'] = $request->slug;

        $this->data['slider'] = \DB::table('tb_sliders')->select('slider_category','slider_title','slider_description','slider_img','slider_link','slide_type')->where('slider_category', $request->slug)->get();

        $reultsgridAds = \DB::table('tb_advertisement')->where('adv_type', 'sidebar')->where('ads_cat_id', $request->slug)->where('adv_position', 'grid_results')->get();
        $this->data['reultsgridAds'] = $reultsgridAds;

        $this->data['sidebargridAds'] = \DB::table('tb_advertisement')->where('adv_type', 'sidebar')->where('ads_cat_id', $request->slug)->where('adv_position', 'grid_sidebar')->get();
		
        $propertiesArr = array();
        
        $perPage = 12;
        $currentPage = $request->page;
        $pageNumber = 1;
        if(isset($request->page) && $request->page>0){
            $pageNumber = $request->page;
        }
        $pageStart = ($pageNumber -1) * $perPage;

        $query = "SELECT pr.editor_choice_property,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id,"; 
        $query .= " (SELECT rack_rate FROM tb_properties_category_rooms_price pcrp where pr.id=pcrp.property_id order by rack_rate DESC limit 0,1 ) as price ," ;
        $query .= " (SELECT category_name FROM tb_categories ct where pr.property_category_id=ct.id limit 0,1 ) as category_name ";
        $query .= " FROM tb_properties  pr";
        $whereClause = " WHERE pr.property_type='" . $request->slug . "' AND pr.property_status = '1' ";
        $OrderByQry =  "ORDER BY (SELECT rack_rate FROM tb_properties_category_rooms_price pcrp WHERE pcrp.property_id = pr.id ORDER BY rack_rate DESC LIMIT 1) * 1 DESC, pr.editor_choice_property desc, pr.feature_property desc LIMIT $pageStart, $perPage ";
        $fianlQry = $query.' '.$whereClause.' '.$OrderByQry;
        $CountRecordQry = " Select count(*) as total_record FROM tb_properties pr  ".$whereClause;
        $getRec = DB::select($CountRecordQry);
        $propertiesArr = DB::select($fianlQry);
       // print_r($propertiesArr); die;
        $this->data['propertiesArr'] = $propertiesArr;
        $this->data['total_record'] = $getRec[0]->total_record;
		
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
		
		$this->data['slider'] = \DB::table('tb_sliders')->where('slider_category', $keyword)->get();
		
		$this->data['reultsgridAds'] = array();
		$this->data['sidebargridAds'] = '';
		$adscateObj = \DB::table('tb_categories')->where('category_alias', $keyword)->where('category_published', 1)->first();
		$resultads = array();
		if (!empty($adscateObj)) {
			$reultsgridAds = \DB::table('tb_advertisement')->where('adv_type', 'sidebar')->where('ads_cat_id', $adscateObj->id)->where('adv_position', 'grid_results')->get();

			if (!empty($reultsgridAds)) {
				$this->data['reultsgridAds'] = $resultads;
			}
			
			$this->data['sidebargridAds'] = \DB::table('tb_advertisement')->where('adv_type', 'sidebar')->where('ads_cat_id', $adscateObj->id)->where('adv_position', 'grid_sidebar')->get();
		}
		
		$arrive = $departure = $adult = $childs = '';
		if (!is_null($request->arrive) && $request->arrive != '') {
			\Session::put('arrive_date', $request->arrive);
			$this->data['arrive_date'] = $request->arrive;
			$arrive = date("Y-m-d", strtotime(trim($request->arrive)));
		}
		if (!is_null($request->departure) && $request->departure != '') {
			\Session::put('departure_date', $request->departure);
			$this->data['departure_date'] = $request->departure;
			$departure = date("Y-m-d", strtotime(trim($request->departure)));
		}
		if (!is_null($request->adult) && $request->adult != '') {
			\Session::put('adults', $request->adult);
			$this->data['adults'] = $request->adult;
		}
		if (!is_null($request->childs) && $request->childs != '') {
			\Session::put('childs', $request->childs);
			$this->data['childs'] = $request->childs;
		}
		$propertiesArr = array();
		$props = array();
		$perPage = 40;
		$perPage = 12;

		$currentPage = Input::get('page', 1) - 1;
		$TagsObj = \DB::table('tb_tags_manager')->select('id')->where('tag_title', $keyword)->where('tag_status', 1)->first();
	  
		$TagsConId = array();
		$TagsFileConId = array();
		$pr = 0;
		if (!empty($TagsObj)) {
			$TagsCon = \DB::table('tb_container_tags')->select('container_id', 'container_type')->where('tag_id', $TagsObj->id)->get();
			if (!empty($TagsCon)) {
				foreach ($TagsCon as $TagsConObj) {
					if ($TagsConObj->container_type == "file") {
						$getfiled = \DB::table('tb_container_files')->select('folder_id', 'id')->where('id', $TagsConObj->container_id)->first();
						if (!empty($getfiled)) {
							$getfoldd = \DB::table('tb_container')->select('parent_id')->where('id', $getfiled->folder_id)->first();
							if (!empty($getfoldd)) {
								$ConObjs = \DB::table('tb_container')->select('display_name')->where('id', $getfoldd->parent_id)->first();

								if (!empty($ConObjs)) {
									if ($arrive != '') {
										$propstemp = \DB::table('tb_properties')->join('tb_properties_category_rooms', 'tb_properties_category_rooms.property_id', '=', 'tb_properties.id')->select('tb_properties.editor_choice_property',
											'tb_properties.feature_property',
											'tb_properties.id',
											'tb_properties.property_name',
											'tb_properties.property_slug',
											'tb_properties.property_category_id')->where('tb_properties_category_rooms.room_active_from', '<=', $arrive)->where('tb_properties.property_name', $ConObjs->display_name)->where('tb_properties.property_type', 'Hotel')->where('tb_properties.property_status', 1);
										if ($departure != '') {
											$propstemp->where('tb_properties_category_rooms.room_active_to', '>=', $departure);
										}
										$props = $propstemp->first();
									} else {
										$props = \DB::table('tb_properties')->select('editor_choice_property','feature_property','id','property_name','property_slug','property_category_id')->where('property_name', $ConObjs->display_name)->where('tb_properties.property_type', 'Hotel')->where('property_status', 1)->first();
									}
									if (!empty($props)) {
										$propertiesArr[$props->id]['data'] = $props;
										$propertiesArr[$props->id]['data']->price = '';
										$checkseasonPrice = \DB::table('tb_properties_category_rooms_price')->select('rack_rate')->where('property_id', $props->id)->orderBy('rack_rate', 'DESC')->first();
										if (!empty($checkseasonPrice)) {
											$propertiesArr[$props->id]['data']->price = $checkseasonPrice->rack_rate;
										}
										$fileArrT = \DB::table('tb_properties_images')->where('property_id', $props->id)->where('file_id', $TagsConObj->container_id)->where('tb_properties_images.type', 'Property Images')->first();
										if (!empty($fileArrT)) {
											$fileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.file_id', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.file_id', $fileArrT->file_id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();

											if (!empty($fileArr)) {
												$propertiesArr[$props->id]['image'] = $fileArr;
												$propertiesArr[$props->id]['image']->imgsrc = (new ContainerController)->getThumbpath($fileArr->folder_id);
											}
											$pr++;
										}
									}
								}
							}
						}
					} else {
						$ConObjs = \DB::table('tb_container')->select('display_name')->where('id', $TagsConObj->container_id)->first();

						if (!empty($ConObjs)) {
							if ($arrive != '') {
								$propstemp = \DB::table('tb_properties')->join('tb_properties_category_rooms', 'tb_properties_category_rooms.property_id', '=', 'tb_properties.id')->select('tb_properties.editor_choice_property',
											'tb_properties.feature_property',
											'tb_properties.id',
											'tb_properties.property_name',
											'tb_properties.property_slug',
											'tb_properties.property_category_id')->where('tb_properties_category_rooms.room_active_from', '<=', $arrive)->where('tb_properties.property_name', $ConObjs->display_name)->where('tb_properties.property_type', 'Hotel')->where('tb_properties.property_status', 1);
								if ($departure != '') {
									$propstemp->where('tb_properties_category_rooms.room_active_to', '>=', $departure);
								}
								$props = $propstemp->first();
							} else {
								$props = \DB::table('tb_properties')->select('editor_choice_property','feature_property','id','property_name','property_slug','property_category_id')->where('property_name', $ConObjs->display_name)->where('tb_properties.property_type', 'Hotel')->where('property_status', 1)->first();
							}
							if (!empty($props)) {
								$propertiesArr[$props->id]['data'] = $props;
								$propertiesArr[$props->id]['data']->price = '';
								$checkseasonPrice = \DB::table('tb_properties_category_rooms_price')->select('rack_rate')->where('property_id', $props->id)->orderBy('rack_rate', 'DESC')->first();
								if (!empty($checkseasonPrice)) {
									$propertiesArr[$props->id]['data']->price = $checkseasonPrice->rack_rate;
								}
								$fileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.file_id', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();

								if (!empty($fileArr)) {
									$propertiesArr[$props->id]['image'] = $fileArr;
									$propertiesArr[$props->id]['image']->imgsrc = (new ContainerController)->getThumbpath($fileArr->folder_id);
								}
								$pr++;
							}
						}
					}
				}
			}
		}

		
		/******* New Query by Ravinder ********/ 
		$catprops = '';   
		$arriveQry = '';
		if ($arrive != '') {

				$arriveQry = "SELECT pr.id "; 
				$arriveQry .=" from tb_properties pr, tb_properties_category_rooms pctr ";
				$arriveQry .=" WHERE pctr.property_id=pr.id AND pctr.room_active_from <= ".$arrive;
				$arriveQry .=" AND  pr.property_name like '%". $keyword."%' ";
				$arriveQry .=" AND  pr.property_status=1 ";
				$arriveQry .=" AND  pr.property_type='Hotel' ";
				if ($departure != '') {
					$arriveQry .=" AND  pctr.room_active_to >= ".$departure;
				}

			
		}
		   
		$cateObj = \DB::table('tb_categories')->where('category_alias', $keyword)->where('category_published', 1)->first();

        $chldIds = array();
		if (!empty($cateObj)) {
			$channel_url = $cateObj->category_youtube_channel_url;
			$this->data['channel_url'] = $channel_url;
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

		$perPage = 12;
		$pageNumber = 1;
		if(isset($request->page) && $request->page>0){
			$pageNumber = $request->page;
		}
		$pageStart = ($pageNumber -1) * $perPage;

		$query = "SELECT pr.editor_choice_property,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id ";
		$query .= ", (SELECT pcrp.rack_rate FROM tb_properties_category_rooms_price pcrp  where pr.id=pcrp.property_id  order by pcrp.rack_rate DESC limit 0,1 ) as price " ;
		$query .= " FROM tb_properties pr ";
		$whereClause =" WHERE ((pr.property_name LIKE '%$keyword%'AND pr.property_type = 'Hotel') OR city LIKE '%$keyword%' ".$catprops." ) AND pr.property_status = 1  ";
		$orderBy = "ORDER BY (SELECT rack_rate FROM tb_properties_category_rooms_price pcrp WHERE pcrp.property_id = pr.id ORDER BY rack_rate DESC LIMIT 1) * 1 DESC, pr.editor_choice_property desc, pr.feature_property desc ";
		$limit = " LIMIT ". $pageStart.",".$perPage; 
		$finalQry = $query.$whereClause.$orderBy.$limit ; 
		$CountRecordQry = "Select count(*) as total_record from tb_properties pr ".$whereClause ;
		
		$property = DB::select($finalQry);
		$getRec = DB::select($CountRecordQry);

		$this->data['propertiesArr'] = $property;
		$this->data['total_record'] = $getRec[0]->total_record;
		$this->data['record_per_page'] =  $perPage;
		$this->data['total_pages'] = (isset($getRec[0]->total_record) && $getRec[0]->total_record>0)?(int)ceil($getRec[0]->total_record / $perPage):0;

		$uid = isset(\Auth::user()->id) ? \Auth::user()->id : '';
		
		$tags_Arr = \DB::table('tb_tags_manager')->where('tag_status', 1)->get();
		$tagsArr = array();
		if (!empty($tags_Arr)) {
			foreach ($tags_Arr as $tags) {
				$tagsArr[$tags->parent_tag_id][] = $tags;
			}
		}
		
		
		$this->data['continent'] = $request->continent;
		$this->data['region'] = $request->region;
		$this->data['cat'] = $request->cat;
		$this->data['tagmenus'] = $tagsArr;
		$this->data['pager'] = $this->injectPaginate();
		$this->data['currentPage'] = $currentPage;
		$this->data['uid'] = $uid;
		$this->data['show'] = $show;
		$this->data['group_id'] = \Session::get('gid');
		$this->data['slug'] = $keyword;
		
		return view('frontend.themes.emporium.properties.list', $this->data);
                    
    }
	
	function fetchcategoryChildListIds($id = 0, $child_category_array = '') {

        if (!is_array($child_category_array))
            $child_category_array = array();
        //$uid = \Auth::user()->id;
        // Get Query 
        $results = \DB::table('tb_categories')->where('parent_category_id', $id)->get();
        if ($results) {
            foreach ($results as $row) {
                $child_category_array[] = $row->id;
                $child_category_array = $this->fetchcategoryChildListIds($row->id, $child_category_array);
            }
        }
        return $child_category_array;
    }
	
	public function getPropertyDetail(Request $request) {
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
				
            $cat_types = \DB::table('tb_properties_category_types')->select('id','category_name','room_desc')->where('property_id', $props->id)->where('status', 0)->where('show_on_booking', 1)->get();
            if (!empty($cat_types)) {
                $c = 0;
                foreach ($cat_types as $type) {
                    $roomfileArr = \DB::table('tb_properties_images')->select('id')->where('property_id', $props->id)->where('category_id', $type->id)->where('type', 'Rooms Images')->count();
                    if ($roomfileArr>0) {
                        $propertiesArr['typedata'][$c] = $type;
                        $propertiesArr['roomimgs'][$type->id] = 'yes';
						$c++;
                    }
                }
            }

            $hotel_brochure = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_container_files.file_name', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.type', 'Hotel Brochure')->orderBy('tb_container_files.file_sort_num', 'asc')->first();
            if (!empty($hotel_brochure)) {
                $this->data['hotel_brochure'] = $hotel_brochure;
                $this->data['hotel_brochure_pdfsrc'] = (new ContainerController)->getThumbpath($hotel_brochure->folder_id);
            }

            $restaurant_menu = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_container_files.file_name', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.type', 'Restaurant Menu')->orderBy('tb_container_files.file_sort_num', 'asc')->first();
            if (!empty($restaurant_menu)) {
                $this->data['restaurant_menu'] = $restaurant_menu;
                $this->data['restaurant_menu_pdfsrc'] = (new ContainerController)->getThumbpath($restaurant_menu->folder_id);
            }

            $spa_brochure = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select( 'tb_container_files.file_name', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.type', 'Spa Brochure')->orderBy('tb_container_files.file_sort_num', 'asc')->first();
            if (!empty($spa_brochure)) {
                $this->data['spa_brochure'] = $spa_brochure;
                $this->data['spa_brochure_pdfsrc'] = (new ContainerController)->getThumbpath($spa_brochure->folder_id);
            }

            $this->data['currency'] = \DB::table('tb_settings')->select('content')->where('key_value', 'default_currency')->first();

            if ($props->property_category_id != '') {
                $catss = explode(',', $props->property_category_id);
                if (!empty($catss)) {
                    $getcats = " AND (" . implode(" || ", array_map(function($v) {
                                        return sprintf("FIND_IN_SET('%s', tb_properties.property_category_id)", $v);
                                    }, array_values($catss))) . ")";
                }
				
                $crpropertiesArr = DB::select(DB::raw("SELECT tb_properties.property_name, tb_properties.property_slug, tb_container_files.file_name, tb_container_files.folder_id FROM tb_properties JOIN tb_properties_images ON tb_properties_images.property_id = tb_properties.id JOIN tb_container_files ON tb_container_files.id = tb_properties_images.file_id WHERE tb_properties.property_type='" . $props->property_type . "' AND tb_properties.property_status = '1' AND tb_properties.id!='" . $props->id . "' AND tb_properties_images.type = 'Property Images'  $getcats GROUP BY  tb_properties.property_slug ORDER BY tb_properties.id desc, tb_container_files.file_sort_num asc LIMIT 2"));
				
				
				$relatedgridquery = "SELECT editor_choice_property,feature_property,id,property_name,property_slug,property_category_id FROM tb_properties WHERE property_type='Hotel' AND tb_properties.assign_detail_city = '".$props->assign_detail_city."' AND property_status = '1' ORDER BY (SELECT rack_rate FROM tb_properties_category_rooms_price WHERE tb_properties_category_rooms_price.property_id = tb_properties.id ORDER BY rack_rate DESC LIMIT 1) * 1 DESC, editor_choice_property desc, feature_property desc LIMIT 4";

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
					
                    $filen = array();
                    if (!empty($roomfileArr)) {
						$propertiesArr['roomimgs'][$type->id]['imgs'] = $roomfileArr;
						$propertiesArr['roomimgs'][$type->id]['imgsrc'] = (new ContainerController)->getThumbpath($roomfileArr[0]->folder_id);
						$propertiesArr['roomimgs'][$type->id]['imgsrc_dir'] = public_path(str_replace(url().'/', '', (new ContainerController)->getThumbpath($roomfileArr[0]->folder_id)));
                        $propertiesArr['typedata'][$c] = $type;
                        $propertiesArr['typedata'][$c]->price = '';
                        $curnDate = date('Y-m-d');
                        if ($props->default_seasons != 1) {
							$checkseason = \DB::table('tb_properties_category_rooms_price')->join('tb_seasons','tb_seasons.id','=','tb_properties_category_rooms_price.season_id')->join('tb_seasons_dates','tb_seasons_dates.season_id','=','tb_seasons.id')->select('tb_properties_category_rooms_price.rack_rate')->where('tb_properties_category_rooms_price.property_id', $props->id)->where('tb_properties_category_rooms_price.category_id', $type->id)->where('tb_seasons.property_id', $props->id)->where('tb_seasons_dates.season_from_date', '>=', $curnDate)->where('tb_seasons_dates.season_to_date', '<=', $curnDate)->orderBy('tb_seasons.season_priority', 'asc')->first();
							
                        } else {
                            $checkseason = \DB::table('tb_properties_category_rooms_price')->join('tb_seasons','tb_seasons.id','=','tb_properties_category_rooms_price.season_id')->join('tb_seasons_dates','tb_seasons_dates.season_id','=','tb_seasons.id')->select('tb_properties_category_rooms_price.rack_rate')->where('tb_properties_category_rooms_price.property_id', $props->id)->where('tb_properties_category_rooms_price.category_id', $type->id)->where('tb_seasons.property_id', 0)->where('tb_seasons_dates.season_from_date', '>=', $curnDate)->where('tb_seasons_dates.season_to_date', '<=', $curnDate)->first();
                        }
						
						if (!empty($checkseason)) {
							 $propertiesArr['typedata'][$c]->price = $checkseason->rack_rate;
                        } else {
                            $checkseasonPrice_ifnotanyseason = \DB::table('tb_properties_category_rooms_price')->select('rack_rate')->where('season_id', 0)->where('property_id', $props->id)->where('category_id', $type->id)->first();
                            if (!empty($checkseasonPrice_ifnotanyseason)) {
                                $propertiesArr['typedata'][$c]->price = $checkseasonPrice_ifnotanyseason->rack_rate;
                            }
                        }
						$c++;
                    }
                }

                usort($propertiesArr['typedata'], function($a, $b) {
                    return trim($a->price) < trim($b->price);
                });
            }

        }

        $this->data['sidebardetailAds'] = \DB::table('tb_advertisement')->select('adv_link','adv_img')->where('adv_type', 'sidebar')->where('adv_position', 'detail')->get();

        $this->data['propertyDetail'] = $propertiesArr;
        $this->data['relatedproperties'] = $crpropertiesArr;
		$this->data['relatedgridpropertiesArr'] = $relatedgridpropertiesArr;
        return view('frontend.themes.emporium.properties.detail', $this->data);
    }


}
