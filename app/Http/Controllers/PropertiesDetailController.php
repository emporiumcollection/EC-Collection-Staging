<?php

namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Properties;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator,
    Input,
    Redirect;
use App\Http\Controllers\ContainerController;
use Zipper;
use DB;
use App\User;
use Socialize;

class PropertiesDetailController extends Controller {
	public function __construct() {
	}

	public function getRoomsAjax($slug){


		$propertiesArr = array();
        $props = \DB::table('tb_properties')->where('property_slug', $slug)->first();

        $this->data['nextProps'] = array();
        if (!empty($props)) {
            
            $temp = DB::select("(select min(id) AS id from tb_properties where id > :id)", ['id' => $props->id]);
            $this->data['nextProps'] = \DB::table('tb_properties')->where("id", ">", $temp[0]->id)->first();
            
            if(!empty($this->data['nextProps'])) {
                $tempFileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id', 'tb_container_files.file_title', 'tb_container_files.file_description')->where('tb_properties_images.property_id', $this->data['nextProps']->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();
                if(!empty($tempFileArr)) {
                    $this->data['nextProps']->image = (new ContainerController)->getThumbpath($tempFileArr->folder_id).$tempFileArr->file_name;
                }
            }
            
            $propertiesArr['data'] = $props;
            $fileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id', 'tb_container_files.file_title', 'tb_container_files.file_description')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->get();
                        
            $pr = 0;
            foreach ($fileArr as $file) {
                $propertiesArr['propimage'][$pr] = $file;
                $propertiesArr['propimage'][$pr]->imgsrc = (new ContainerController)->getThumbpath($file->folder_id);
                $propertiesArr['propimage'][$pr]->imgsrccon = (new ContainerController)->getContainerUserPath($file->folder_id);
                $pr++;
            }
            $cat_types = \DB::table('tb_properties_category_types')->where('property_id', $props->id)->where('status', 0)->where('show_on_booking', 1)->get();
            if (!empty($cat_types)) {
                $c = 0;
                foreach ($cat_types as $type) {
                    $cat_rooms = \DB::table('tb_properties_category_rooms')->where('property_id', $props->id)->where('category_id', $type->id)->get();
                    if (!empty($cat_rooms)) {
                        foreach ($cat_rooms as $room) {
                            $propertiesArr['rooms'][$type->id][] = $room;
                        }
                    }
                    $roomfileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.category_id', $type->id)->where('tb_properties_images.type', 'Rooms Images')->orderBy('tb_container_files.file_sort_num', 'asc')->get();
                    $filen = array();
                    if (!empty($roomfileArr)) {
                        $propertiesArr['typedata'][$c] = $type;
                        $propertiesArr['typedata'][$c]->price = '';
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
                                    $checkseasonPrice = \DB::table('tb_properties_category_rooms_price')->where('season_id', $checkseason[$sc]->id)->where('property_id', $props->id)->where('category_id', $type->id)->first();
                                    if (!empty($checkseasonPrice)) {
                                        $propertiesArr['typedata'][$c]->price = $checkseasonPrice->rack_rate;
                                        $foundsean = true;
                                    }
                                }
                            }
                            if ($foundsean != true) {
                                $checkseasonPrice_ifnotforloop = \DB::table('tb_properties_category_rooms_price')->where('season_id', 0)->where('property_id', $props->id)->where('category_id', $type->id)->first();
                                if (!empty($checkseasonPrice_ifnotforloop)) {
                                    $propertiesArr['typedata'][$c]->price = $checkseasonPrice_ifnotforloop->rack_rate;
                                }
                            }
                        } else {
                            $checkseasonPrice_ifnotanyseason = \DB::table('tb_properties_category_rooms_price')->where('season_id', 0)->where('property_id', $props->id)->where('category_id', $type->id)->first();
                            if (!empty($checkseasonPrice_ifnotanyseason)) {
                                $propertiesArr['typedata'][$c]->price = $checkseasonPrice_ifnotanyseason->rack_rate;
                            }
                        }

                        $f = 0;
                        foreach ($roomfileArr as $rfile) {
                            $propertiesArr['roomimgs'][$type->id][$f] = $rfile;
                            $propertiesArr['roomimgs'][$type->id][$f]->imgsrc = (new ContainerController)->getThumbpath($rfile->folder_id);
                            $f++;
                        }
                        $c++;
                    }
                }

                usort($propertiesArr['typedata'], function($a, $b) {
                    return trim($a->price) < trim($b->price);
                });
            }

            $this->data['resgalleryArr'] = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.type', 'Restrurants Gallery Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();

            $this->data['spagalleryArr'] = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.type', 'Spa Gallery Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();

            $this->data['currency'] = \DB::table('tb_settings')->where('key_value', 'default_currency')->first();

            $crpropertiesArr = array();
            if ($props->property_category_id != '') {
                $catss = explode(',', $props->property_category_id);
                if (!empty($catss)) {
                    $getcats = " AND (" . implode(" || ", array_map(function($v) {
                                        return sprintf("FIND_IN_SET('%s', property_category_id)", $v);
                                    }, array_values($catss))) . ")";
                }

                $relateprops = DB::select(DB::raw("SELECT id,property_name,property_slug FROM tb_properties WHERE property_type='" . $props->property_type . "' AND property_status = '1' AND id!='" . $props->id . "' $getcats ORDER BY id asc LIMIT 1"));

                if (!empty($relateprops)) {
                    $crpr = 0;
                    foreach ($relateprops as $rprop) {
                        $crfileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $rprop->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();
                        if (!empty($crfileArr)) {
                            $crpropertiesArr[$crpr]['rpdata'] = $rprop;
                            $crpropertiesArr[$crpr]['image'] = $crfileArr;
                            $crpropertiesArr[$crpr]['image']->imgsrc = (new ContainerController)->getThumbpath($crfileArr->folder_id);
                        }
                        $crpr++;
                    }
                }
            }
        }

        $this->data['relatedproperties'] = $crpropertiesArr;
		return response()->json($this->data);

	}
}