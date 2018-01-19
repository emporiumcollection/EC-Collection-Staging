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
        \Session::put('lang', 'en');
        $getlang = \Session::get('newlang');
        $arrive_date = \Session::get('arrive_date');
        $destination_date = \Session::get('destination_date');
        $adults = \Session::get('adults');
        $childs = \Session::get('childs');
        $this->data['arrive_date'] = $this->data['destination_date'] = $this->data['childs'] = $this->data['adults'] = '';
        if (!isset($getlang)) {
            \Session::put('newlang', 'English');
        } else {
            \Session::put('lang', $getlang);
        }
        if (isset($arrive_date)) {
            $this->data['arrive_date'] = $arrive_date;
        }
        if (isset($destination_date)) {
            $this->data['destination_date'] = $destination_date;
        }
        if (isset($adults)) {
            $this->data['adults'] = $adults;
        }
        if (isset($childs)) {
            $this->data['childs'] = $childs;
        }
        $this->data['footer_text'] = \DB::table('tb_settings')->select('content')->where('key_value', 'footer_text')->first();
        $this->data['about_text'] = \DB::table('tb_settings')->select('content')->where('key_value', 'about_text')->first();
    }
    
    /* Method : getPropertyDetail
     *   Description : The Methos is using for property detai page (PDP)
    */
    public function getPropertyDetail(Request $request) {
        $propertiesArr = array();
		$crpropertiesArr = array();
		$relatedgridpropertiesArr = array();
        $props = \DB::table('tb_properties')->where('property_slug', $request->slug)->first();
      //  print_r($props); die;
        $this->data['slug'] = $request->slug;
        if (!empty($props)) {
            $propertiesArr['data'] = $props;
            $propertiesArr['propimage'] = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_container_files.id', 'tb_container_files.file_name', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->get();
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
                $relatedgridquery = "SELECT pr.editor_choice_property,pr.feature_property,pr.id,pr.property_name,pr.property_slug,pr.property_category_id, ";
                $relatedgridquery .= "(SELECT rack_rate FROM tb_properties_category_rooms_price pcrp where pr.id=pcrp.property_id order by rack_rate DESC limit 0,1 ) as price,";
                $relatedgridquery .= "(SELECT category_name FROM tb_categories ct where pr.property_category_id=ct.id limit 0,1 ) as category_name ";  
                $relatedgridquery .= "FROM tb_properties pr WHERE pr.property_type='Hotel' AND pr.assign_detail_city =  '".$props->assign_detail_city."' AND pr.property_status = '1' ORDER BY (SELECT rack_rate FROM tb_properties_category_rooms_price  WHERE tb_properties_category_rooms_price.property_id = pr.id ORDER BY rack_rate DESC LIMIT 1) * 1 DESC, pr.editor_choice_property desc, pr.feature_property desc LIMIT 4";
                $relatedgridpropertiesArr = DB::select(DB::raw($relatedgridquery));
               
            }
        }

        $this->data['sidebardetailAds'] = \DB::table('tb_advertisement')->select('adv_link','adv_img')->where('adv_type', 'sidebar')->where('adv_position', 'detail')->get();

        $uid = isset(\Auth::user()->id) ? \Auth::user()->id : '';
        
        $this->data['lightcontent'] = '';
		
		$this->data['restaurant_gallery'] = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_container_files.id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.type', 'Restrurants Gallery Images')->orderBy('tb_container_files.file_sort_num', 'asc')->count();
		
		$this->data['bar_gallery'] = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_container_files.id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.type', 'Bar Gallery Images')->orderBy('tb_container_files.file_sort_num', 'asc')->count();
		
		$this->data['spa_gallery'] = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_container_files.id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.type', 'Spa Gallery Images')->orderBy('tb_container_files.file_sort_num', 'asc')->count();

        //print "<pre>";
        //print_r($propertiesArr); die;
        $this->data['propertyDetail'] = $propertiesArr;
        $this->data['relatedproperties'] = $crpropertiesArr;
		$this->data['relatedgridpropertiesArr'] = $relatedgridpropertiesArr;
        $this->data['pageTitle'] = 'Details';
        $page = 'layouts.' . CNF_THEME . '.index';
        $this->data['pages'] = 'pages.editorial';
        //dd($this->data);
        
        return view($page, $this->data);
    }


}
