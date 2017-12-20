<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,
    Input,
    Redirect;
use App\Http\Controllers\ContainerController;
use Zipper;
use DB;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Http\Controllers\Controller;
use App\User;
use Socialize, ImageCache;

class HomeController extends Controller {

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

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index(Request $request) {

        if (CNF_FRONT == 'false' && $request->segment(1) == '') :
            return Redirect::to('dashboard');
        endif;
		$pageSlug = '';
        $page = $request->segment(1);
        if ($page == '') {
            $page = 'landing';
            $pageSlug = 'landing';
        }
        if ($page != '') :
            $content = \DB::table('tb_pages')->where('alias', '=', $page)->where('status', '=', 'enable')->get();
            //print_r($content);
            //return '';
            if (count($content) >= 1) {
                $row = $content[0];
                $this->data['pageTitle'] = $row->title;
                $this->data['pageNote'] = $row->note;
                $this->data['pageMetakey'] = ($row->metakey != '' ? $row->metakey : CNF_METAKEY);
                $this->data['pageMetadesc'] = ($row->metadesc != '' ? $row->metadesc : CNF_METADESC);

                $this->data['breadcrumb'] = 'active';

                if ($row->access != '') {
                    $access = json_decode($row->access, true);
                } else {
                    $access = array();
                }

                // If guest not allowed 
                if ($row->allow_guest != 1) {
                    $group_id = \Session::get('gid');
                    $isValid = (isset($access[$group_id]) && $access[$group_id] == 1 ? 1 : 0 );
                    if ($isValid == 0) {
                        return Redirect::to('')
                                        ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_restric')));
                    }
                }
                if ($row->template == 'backend') {
                    $page = 'pages.' . $row->filename;
                } else {
                    $page = 'layouts.' . CNF_THEME . '.index';
                }
                //print_r($this->data);exit;

                $filename = base_path() . "/resources/views/pages/" . $row->filename . ".blade.php";
                if (file_exists($filename)) {
                    $this->data['pages'] = 'pages.' . $row->filename;
                    //	print_r($this->data);exit;
                    // get plans
                    /* $plan = \DB::table('tb_membership')->where('status', 1)->get();
                      foreach ($plan as $memplan) {
                      $mod = explode(',', $memplan->package_modules);
                      $allowmodule = \DB::table('tb_module')->whereIn('module_id', $mod)->select('module_title', 'module_id')->get();
                      $plans[$memplan->id] = $memplan;
                      $plans[$memplan->id]->modules = $allowmodule;
                      }
                      if (!empty($plans)) {
                      $this->data['plans'] = $plans;
                      }
                     */

                    /*                     * *** Start Landing Page ** */
                    if (isset($pageSlug) && $pageSlug == 'landing') {
                        $this->data['landingads'] = \DB::table('tb_advertisement')->select('adv_img', 'adv_link')->where('adv_type', 'sidebar')->where('adv_position', 'landing')->get();

                        //include(public_path() . '/revolution_slider/embed.php');

                        $this->data['slider'] = \DB::table('tb_sliders')->select('slider_category', 'slider_title', 'slider_description', 'slider_img', 'slider_link', 'slider_video', 'slide_type')->where('slider_category', 'Landing')->get();

                        $destts = array();
                        $maindest = \DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name')->where('parent_category_id', 0)->where('id', '!=', 8)->get();
                        if (!empty($maindest)) {
                            $ctt = 0;
                            foreach ($maindest as $dest) {
                                //if ($dest->id != 8) {

                                $subdest = \DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name')->where('parent_category_id', $dest->id)->get();
                                $getcats = '';
                                $chldIds = array();
                                if (!empty($subdest)) {
                                    $chldIds = $this->fetchcategoryChildListIds($dest->id);
                                    array_unshift($chldIds, $dest->id);
                                } else {
                                    $chldIds[] = $dest->id;
                                }

                                if (!empty($chldIds)) {
                                    $getcats = " AND (" . implode(" || ", array_map(function($v) {
                                                        return sprintf("FIND_IN_SET('%s', property_category_id)", $v);
                                                    }, array_values($chldIds))) . ")";
                                }

                                $preprops = DB::select(DB::raw("SELECT COUNT(*) AS total_rows FROM tb_properties WHERE property_status = '1' $getcats"));

                                if (isset($preprops[0]->total_rows) && $preprops[0]->total_rows > 0) {
                                    $destts[$ctt]['maincat'] = $dest;

                                    if (!empty($subdest)) {
										$sd=0;
                                        foreach ($subdest as $subdestt) {

                                            $getcats = '';
                                            $chldIds = array();
                                            $chldIds[] = $subdestt->id;
                                            $chldIds = $this->fetchcategoryChildListIds($subdestt->id);
                                            array_unshift($chldIds, $subdestt->id);
                                            $getcats = " AND (" . implode(" || ", array_map(function($v) {
                                                                return sprintf("FIND_IN_SET('%s', property_category_id)", $v);
                                                            }, array_values($chldIds))) . ")";
                                            $preprops = DB::select(DB::raw("SELECT COUNT(*) AS total_rows FROM tb_properties WHERE property_status = '1' $getcats"));
                                            if (isset($preprops[0]->total_rows) && $preprops[0]->total_rows > 0) {
                                                $destts[$ctt]['child'][$sd] = $subdestt;
												
												$subchilddest = \DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name')->where('parent_category_id', $subdestt->id)->get();
												
												$getcats = '';
												$chldIds = array();
												if (!empty($subchilddest)) {
													$chldIds = $this->fetchcategoryChildListIds($subdestt->id);
													array_unshift($chldIds, $subdestt->id);
												} else {
													$chldIds[] = $subdestt->id;
												}
                                                                                                
                                                                                                $temp = array();
												if (!empty($chldIds)) {
                                                                                                    foreach ($chldIds as $chldId) {
                                                                                                        $cpreprops = DB::select(DB::raw("SELECT COUNT(*) AS total_rows FROM tb_properties WHERE property_status = '1' AND property_category_id = $chldId"));
                                                                                                        if (isset($cpreprops[0]->total_rows) && $cpreprops[0]->total_rows > 0) {
                                                                                                            $_temp = \DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name')->where('id', $chldId)->get();;
                                                                                                            if(!empty($_temp)) {
                                                                                                                foreach ($_temp as $t_key => $tmp) {
                                                                                                                    $_chldIds = array();
                                                                                                                    $_chldIds = $this->fetchcategoryChildListIds($tmp->id);
                                                                                                                    array_unshift($_chldIds, $tmp->id);
                                                                                                                    $sub_temp = array();
                                                                                                                    if (!empty($_chldIds)) {
                                                                                                                        foreach ($_chldIds as $_chldId) {
                                                                                                                            $cpreprops = DB::select(DB::raw("SELECT COUNT(*) AS total_rows FROM tb_properties WHERE property_status = '1' AND property_category_id = $_chldId"));
                                                                                                                            if (isset($cpreprops[0]->total_rows) && $cpreprops[0]->total_rows > 0) {
                                                                                                                                $_sub_temp = \DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name')->where('id', $_chldId)->get();;
                                                                                                                                if(!empty($_sub_temp)) {
                                                                                                                                    $sub_temp = array_merge($sub_temp, $_sub_temp);
                                                                                                                                }
                                                                                                                            }
                                                                                                                        }
                                                                                                                    }
                                                                                                                    $_temp[$t_key]->childs = $sub_temp;
                                                                                                                }
                                                                                                                $temp = array_merge($temp, $_temp);
                                                                                                            }
                                                                                                        }
                                                                                                    }
													/*$getcats = " AND (" . implode(" || ", array_map(function($v) {
																		return sprintf("FIND_IN_SET('%s', property_category_id)", $v);
																	}, array_values($chldIds))) . ")";*/
												}
                                                                                                if(!empty($temp)) {
                                                                                                    $destts[$ctt]['child'][$sd]->subchild = $temp;
                                                                                                    /*return array('$subchilddest' => $subchilddest, '$temp' => $temp);*/
                                                                                                }
                                                                                                                                                                                                
												/*$cpreprops = DB::select(DB::raw("SELECT COUNT(*) AS total_rows FROM tb_properties WHERE property_status = '1' $getcats"));
                                                                                                if (isset($cpreprops[0]->total_rows) && $cpreprops[0]->total_rows > 0) {
													$destts[$ctt]['child'][$sd]->subchild = $subchilddest;
												}*/
                                            }
											$sd++;
                                        }
                                    }
                                    $ctt++;
                                }
                                // }
                            }
                        }
                        //print "<pre>";
                        //print_r($destts);
                        $this->data['ourdesitnation'] = $destts;
                        $this->data['social_links'] = \DB::table('tb_social')->where('status', 1)->get();
                        $this->data['landing_menus'] = array();
                    } else {


                        $tags_Arr = \DB::table('tb_tags_manager')->where('tag_status', 1)->get();
                        $tagsArr = array();
                        if (!empty($tags_Arr)) {
                            foreach ($tags_Arr as $tags) {
                                $tagsArr[$tags->parent_tag_id][] = $tags;
                            }
                        }

                        $this->data['tagmenus'] = $tagsArr;

                        $propertiesArr = array();
                        if (Input::get('s', false)) {
                            $TagsObj = \DB::table('tb_tags_manager')->where('tag_title', Input::get('s', false))->first();
                            //print_r($TagsObj);
                            $TagsCon = \DB::table('tb_container_tags')->select('container_id')->where('container_type', 'folder')->where('tag_id', $TagsObj->id)->get();
                            //print_r($TagsObj);
                            foreach ($TagsCon as $TagsConObj) {
                                $TagsConId[] = $TagsConObj->container_id;
                            }
                            if (isset($TagsConId)) {
                                $container_id = implode(',', $TagsConId);

                                $ConObjs = \DB::table('tb_container')->select('display_name')->where('id', [$container_id])->get();

                                foreach ($ConObjs as $ConObj) {
                                    $ConName[] = $ConObj->display_name;
                                }
                                $container_names = implode(',', $ConName);
                                $props = \DB::table('tb_properties')->where('property_name', [$container_names])->where('property_status', 1)->get();
                            }
                        } else {
                            $props = \DB::table('tb_properties')->where('property_status', 1)->get();
                        }

                        if (!empty($props)) {
                            $pr = 0;
                            foreach ($props as $prop) {
                                $propertiesArr[$pr]['data'] = $prop;
                                //$fileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $prop->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->toSql(); 
                                $fileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $prop->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();

                                if (!empty($fileArr)) {
                                    $propertiesArr[$pr]['image'] = $fileArr;
                                    $propertiesArr[$pr]['image']->imgsrc = (new ContainerController)->getThumbpath($fileArr->folder_id);
                                }
                                $pr++;
                            }
                        }

                        $this->data['propertiesArr'] = $propertiesArr;

                        $socialpropertiesArr = array();
                        $socialpropertiessingle = '';
                        if (Input::get('sp', false)) {
                            $scprops = \DB::table('tb_properties')->where('property_slug', Input::get('sp', false))->where('property_status', 1)->get();
                            if (!empty($scprops)) {
                                foreach ($scprops as $scpr) {
                                    $socialpropertiessingle = $scpr->property_name;
                                }
                            }
                        } else {
                            $scprops = \DB::table('tb_properties')->where('property_status', 1)->get();
                        }

                        if (!empty($scprops)) {
                            $socialpropertiesArr = $scprops;
                        }

                        $this->data['socialpropertiesArr'] = $socialpropertiesArr;
                        $this->data['socialpropertiessingle'] = $socialpropertiessingle;

                        $channel_url = '';
                        if (Input::get('scy', false)) {
                            $cateObjsc = \DB::table('tb_categories')->where('category_name', Input::get('scy', false))->where('category_published', 1)->first();
                            if (!empty($cateObjsc)) {
                                $channel_url = $cateObjsc->category_youtube_channel_url;
                            }
                        }

                        $this->data['channel_url'] = $channel_url;

                        $mainArrdestts = array();
                        $maindest = \DB::table('tb_categories')->where('parent_category_id', 0)->where('id', '!=', 8)->get();
                        if (!empty($maindest)) {
                            $d = 0;
                            foreach ($maindest as $mdest) {

                                /*                                 * *********************************************** */

                                $getcats = '';
                                $chldIds = array();
                                $childdest = \DB::table('tb_categories')->where('parent_category_id', $mdest->id)->get();
                                if (!empty($childdest)) {
                                    $chldIds = $this->fetchcategoryChildListIds($mdest->id);
                                    array_unshift($chldIds, $mdest->id);
                                } else {
                                    $chldIds[] = $mdest->id;
                                }

                                $checkchanlchild = \DB::table('tb_categories')->where('category_youtube_channel_url', '!=', '')->whereIn('id', $chldIds)->get();

                                if (!empty($checkchanlchild)) {
                                    $mainArrdestts[$d] = $mdest;
                                    if (!empty($childdest)) {
                                        $c = 0;
                                        foreach ($childdest as $cdest) {
                                            $regchldIds = array();

                                            $regchilddest = \DB::table('tb_categories')->where('parent_category_id', $cdest->id)->get();
                                            if (!empty($regchilddest)) {
                                                $regchldIds = $this->fetchcategoryChildListIds($cdest->id);
                                                array_unshift($regchldIds, $cdest->id);
                                            } else {
                                                $regchldIds[] = $cdest->id;
                                            }

                                            $regcheckchanlchild = \DB::table('tb_categories')->where('category_youtube_channel_url', '!=', '')->whereIn('id', $regchldIds)->get();

                                            if (!empty($regcheckchanlchild)) {
                                                $mainArrdestts[$d]->childs[$c] = $cdest;
                                                if (!empty($regchilddest)) {
                                                    $cs = 0;
                                                    foreach ($regchilddest as $cntrchild) {
                                                        $cntrchldIds = array();

                                                        $cntrchilddest = \DB::table('tb_categories')->where('parent_category_id', $cntrchild->id)->get();
                                                        if (!empty($cntrchilddest)) {
                                                            $cntrchldIds = $this->fetchcategoryChildListIds($cntrchild->id);
                                                            array_unshift($cntrchldIds, $cntrchild->id);
                                                        } else {
                                                            $cntrchldIds[] = $cntrchild->id;
                                                        }

                                                        $cntrcheckchanlchild = \DB::table('tb_categories')->where('category_youtube_channel_url', '!=', '')->whereIn('id', $cntrchldIds)->get();

                                                        if (!empty($cntrcheckchanlchild)) {
                                                            $mainArrdestts[$d]->childs[$c]->subchild[$cs] = $cntrchild;
                                                            $citydest = \DB::table('tb_categories')->where('parent_category_id', $cntrchild->id)->get();
                                                            if (!empty($citydest)) {
                                                                foreach ($citydest as $ctdest) {
                                                                    if ($ctdest->category_youtube_channel_url != '') {
                                                                        $mainArrdestts[$d]->childs[$c]->subchild[$cs]->citychild[] = $ctdest;
                                                                    }
                                                                }
                                                            }
                                                            $cs++;
                                                        }
                                                    }
                                                }
                                                $c++;
                                            }
                                        }
                                        $c++;
                                    }
                                }
                                $d++;
                            }
                        }
                        $this->data['ourmaindesitnation'] = $mainArrdestts;
                        $this->data['continent'] = Input::get('continent', false);
                        $this->data['region'] = Input::get('region', false);
                        $this->data['country'] = Input::get('country', false);

                        $uid = isset(\Auth::user()->id) ? \Auth::user()->id : '';
                        $this->data['lightboxes'] = \DB::table('tb_lightbox')->where('user_id', $uid)->get();

                        $boxcontent = \DB::table('tb_lightbox_content')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_lightbox_content.file_id')->select('tb_lightbox_content.*', 'tb_container_files.file_name', 'tb_container_files.folder_id', 'tb_container_files.file_display_name')->where('tb_lightbox_content.user_id', $uid)->get();
                        $boxcont = array();
                        if (!empty($boxcontent)) {
                            foreach ($boxcontent as $bcontent) {
                                $boxcont[$bcontent->lightbox_id][] = $bcontent;
                            }
                        }
                        $this->data['lightcontent'] = $boxcont;

                        //for our collection on landing page
                        $OurCollection = \DB::table('tb_categories')->where('category_alias', 'our-collection')->first();
                        $OurCategory = array(); //\DB::table('tb_categories')->where('parent_category_id', $OurCollection->id)->where('category_featured', 1)->where('category_published', 1)->orderBy('category_order_num', 'asc')->get();

                        $this->data['propertyCategory'] = $OurCategory;
                    }
                    return view($page, $this->data);
                } else {
                    return Redirect::to('')
                                    ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
                }
            } else {
                return Redirect::to('')
                                ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
            }


        else :
            $this->data['pageTitle'] = 'Home';
            $this->data['pageNote'] = 'Welcome To Our Site';
            $this->data['breadcrumb'] = 'inactive';
            $this->data['pageMetakey'] = CNF_METAKEY;
            $this->data['pageMetadesc'] = CNF_METADESC;

            $this->data['ads_home'] = \DB::table('tb_advertisement')->where('adv_status', 1)->get();

            $this->data['pages'] = 'pages.home';
            $page = 'layouts.' . CNF_THEME . '.index';
            return view($page, $this->data);
        endif;
    }

    private function set_parents_enables($arr = array()) {
        $return = array();

        foreach ($arr as $key => $si_arr) {
            if (in_array($key, $this->data['enabled_parent_array'])) {
                $si_arr['is_enabled'] = true;
                if (isset($si_arr['child'])) {
                    $si_arr['child'] = $this->set_parents_enables($si_arr['child']);
                }

                $return[$key] = $si_arr;
            }
        }

        return $return;
    }

    function save_previous_page_image(Request $request) {
        $ai_previous_page = $request->input("ai_previous_page");
        list($type, $data) = explode(';', $ai_previous_page);
        list(, $ai_previous_page) = explode(',', $ai_previous_page);
        $ai_previous_page = base64_decode($ai_previous_page);

        $image = md5(date("YmdHis") . rand(0, 1000)) . '.jpg';

        file_put_contents(__DIR__ . "/../../../public/sximo/previous_page_image/" . $image, $ai_previous_page);
        \Session::put('ai_previous_page', $image);
        echo $image;
    }

    private function set_all_enabled_parent($str = '') {
        $return = array();
        $explode_arr = explode(',', $str);
        foreach ($explode_arr as $temp_parents) {
            $this->data['enabled_parent_array'][$temp_parents] = $temp_parents;
        }
    }

    private function get_all_child_folder($par_id = 0, $parent_var = '') {
        $return = array();
        $id = (int) $par_id;
        if ($id > 0) {
            $parent_query = \DB::table('tb_container')->where('parent_id', $id)->get();
            foreach ($parent_query as $parent_obj) {
                $temp_array = array();
                $temp_array['data']['id'] = $parent_obj->id;
                $temp_array['data']['folder_id'] = $parent_obj->id;
                $temp_array['data']['name'] = (\Session::get('newlang') == 'English') ? $parent_obj->display_name_eng : $parent_obj->display_name;
                $temp_array['data']['display_name'] = $parent_obj->display_name;
                $temp_array['data']['file_type'] = 'folder';
                //$temp_array['data']['cover_img'] = $parent_obj->cover_img;
                $temp_array['data']['title'] = (\Session::get('newlang') == 'English') ? $parent_obj->title_eng : $parent_obj->title;
                $temp_array['data']['description'] = (\Session::get('newlang') == 'English') ? $parent_obj->description_eng : $parent_obj->description;
                $temp_array['data']['created'] = $parent_obj->created;
                $temp_array['data']['user_id'] = $parent_obj->user_id;
                $temp_array['data']['sort_num'] = $parent_obj->sort_num;
                $temp_array['data']['designer'] = array();

                $check_designer = \DB::table('tb_container_designers')->join('tb_designers', 'tb_designers.id', '=', 'tb_container_designers.designer_id')->where('tb_container_designers.container_id', $parent_obj->id)->where('tb_container_designers.container_type', 'folder')->first();
                if (!empty($check_designer)) {
                    $temp_array['data']['designer'] = $check_designer;
                }

                if ($parent_obj->cover_img == "") {
                    $default_front_design = \DB::table('tb_settings')->where('key_value', 'frontend_design')->first();
                    if (!empty($default_front_design) && $default_front_design->content == "masonry") {
                        $temp_array['data']['cover_img'] = $parent_obj->temp_cover_img_masonry;
                    } elseif (!empty($default_front_design) && $default_front_design->content == "grid") {
                        $temp_array['data']['cover_img'] = $parent_obj->temp_cover_img;
                    } else {
                        $temp_array['data']['cover_img'] = $parent_obj->cover_img;
                    }
                } else {
                    $temp_array['data']['cover_img'] = $parent_obj->cover_img;
                }


                //$temp_array['data'] = $parent_obj;
                $temp_array['parents'] = $parent_var . ', ' . $parent_obj->parent_id;
                $is_enabled = false;
                $enabled_cnt = \DB::table('tb_frontend_container')->where('container_id', $parent_obj->id)->where('container_type', 'folder')->count();
                $enabled_file_cnt = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $parent_obj->id)->count();
                if (($enabled_cnt > 0) && ($enabled_file_cnt > 0)) {
                    $is_enabled = true;
                    $this->set_all_enabled_parent($temp_array['parents'] . ',' . $parent_obj->id);
                }

                $temp_array['is_enabled'] = $is_enabled;
                $child_cnt = \DB::table('tb_container')->where('parent_id', $parent_obj->id)->count();
                if ($child_cnt > 0) {
                    $temp_array['child'] = $this->get_all_child_folder($parent_obj->id, $temp_array['parents']);
                }
                //echo $parent_obj->id.' : '.$child_cnt.' : '.$enabled_cnt.'<br>';

                $return[$parent_obj->id] = $temp_array;
            }

            $file_query = \DB::table('tb_container_files')->where('folder_id', $id)->get();
            foreach ($file_query as $file_obj) {
                $temp_array = array();
                $extype = explode('/', $file_obj->file_type);
                if ($extype[0] == "image") {
                    $temp_array['data']['id'] = $file_obj->id;
                    $temp_array['data']['folder_id'] = $file_obj->folder_id;
                    $temp_array['data']['name'] = (\Session::get('newlang') == 'English') ? ($file_obj->file_display_name_eng != '') ? $file_obj->file_display_name_eng : $file_obj->file_name : ($file_obj->file_display_name != '') ? $file_obj->file_display_name : $file_obj->file_name;
                    $temp_array['data']['display_name'] = ($file_obj->file_display_name != '') ? $file_obj->file_display_name : $file_obj->file_name;
                    $temp_array['data']['file_type'] = 'file';
                    $temp_array['data']['cover_img'] = $file_obj->file_name;
                    $temp_array['data']['title'] = (\Session::get('newlang') == 'English') ? $file_obj->file_title_eng : $file_obj->file_title;
                    $temp_array['data']['description'] = (\Session::get('newlang') == 'English') ? $file_obj->file_description_eng : $file_obj->file_description;
                    $temp_array['data']['created'] = $file_obj->created;
                    $temp_array['data']['user_id'] = $file_obj->user_id;
                    $temp_array['data']['sort_num'] = $file_obj->file_sort_num;
                    $temp_array['data']['designer'] = array();

                    $dirPath = (new ContainerController)->getContainerUserPath($file_obj->folder_id);
                    $copytofolder = public_path() . '/uploads/folder_cover_imgs/';
                    if (!\File::exists($copytofolder . 'masonry_product_file_' . $file_obj->file_name)) {
                        // IMage for Product page
                        /* $pdimg = \Image::make($dirPath.$file_obj->file_name);
                          $pdimg->resize(305, 223);
                          $pdimgfile = 'product_file_'.$file_obj->file_name;
                          $pdimg->save($copytofolder.$pdimgfile); */

                        $mpimg = \Image::make($dirPath . $file_obj->file_name);
                        $mactualsize = getimagesize($dirPath . $file_obj->file_name);
                        if ($mactualsize[0] > $mactualsize[1]) {
                            $mpimg->resize(349, 228);
                        } else {
                            $mpimg->resize(349, 527);
                        }
                        $mpfile = 'masonry_product_file_' . $file_obj->file_name;
                        $mpimg->save($copytofolder . $mpfile);
                    }
                }
                //$temp_array['data'] = $file_obj;
                $temp_array['parents'] = $parent_var . ', ' . $file_obj->folder_id;
                $is_enabled = false;
                $enabled_cnt = \DB::table('tb_frontend_container')->where('container_id', $file_obj->id)->where('container_type', 'file')->count();
                if ($enabled_cnt > 0) {
                    $is_enabled = true;
                    $this->set_all_enabled_parent($temp_array['parents'] . ',i-' . $file_obj->id);
                }

                $temp_array['is_enabled'] = $is_enabled;


                $return['i-' . $file_obj->id] = $temp_array;
            }
        }

        return $return;
    }

    public function getLang($lang = 'Deutsch') {
        \Session::put('lang', $lang);
        return Redirect::back();
    }

    public function getSkin($skin = 'sximo') {
        \Session::put('themes', $skin);
        return Redirect::back();
    }

    public function postContact(Request $request) {

        $this->beforeFilter('csrf', array('on' => 'post'));
        $rules = array(
            'name' => 'required',
            'subject' => 'required',
            'message' => 'required|min:20',
            'sender' => 'required|email'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->passes()) {

            $data = array('name' => $request->input('name'), 'sender' => $request->input('sender'), 'subject' => $request->input('subject'), 'notes' => $request->input('message'));
            $message = view('emails.contact', $data);

            $to = CNF_EMAIL;
            $subject = $request->input('subject');
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: ' . $request->input('name') . ' <' . $request->input('sender') . '>' . "\r\n";
            //mail($to, $subject, $message, $headers);			

            return Redirect::to($request->input('redirect'))->with('message', \SiteHelpers::alert('success', 'Thank You , Your message has been sent !'));
        } else {
            return Redirect::to($request->input('redirect'))->with('message', \SiteHelpers::alert('error', 'The following errors occurred'))
                            ->withErrors($validator)->withInput();
        }
    }

    public function show_full_news($news_title, Request $request) {

        if (CNF_FRONT == 'false' && $request->segment(1) == '') :
            return Redirect::to('dashboard');
        endif;

        //$page = $request->segment(1);
        $page = 'post-detail';
        if ($page != '') :
            $content = \DB::table('tb_pages')->where('alias', '=', $page)->where('status', '=', 'enable')->get();
            //print_r($content); die;
            //return '';
            if ($news_title != '') {
                if (count($content) >= 1) {

                    $row = $content[0];
                    $this->data['pageTitle'] = $row->title;
                    $this->data['pageNote'] = $row->note;
                    $this->data['pageMetakey'] = ($row->metakey != '' ? $row->metakey : CNF_METAKEY);
                    $this->data['pageMetadesc'] = ($row->metadesc != '' ? $row->metadesc : CNF_METADESC);

                    $this->data['breadcrumb'] = 'active';

                    if ($row->access != '') {
                        $access = json_decode($row->access, true);
                    } else {
                        $access = array();
                    }

                    // If guest not allowed 
                    if ($row->allow_guest != 1) {
                        $group_id = \Session::get('gid');
                        $isValid = (isset($access[$group_id]) && $access[$group_id] == 1 ? 1 : 0 );
                        if ($isValid == 0) {
                            return Redirect::to('')
                                            ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_restric')));
                        }
                    }
                    if ($row->template == 'backend') {
                        $page = 'pages.' . $row->filename;
                    } else {
                        $page = 'layouts.' . CNF_THEME . '.index';
                    }
                    //print_r($this->data);exit;

                    $filename = base_path() . "/resources/views/pages/" . $row->filename . ".blade.php";
                    if (file_exists($filename)) {
                        $this->data['pages'] = 'pages.' . $row->filename;
                        //	print_r($this->data);exit;
                        $this->data['social_links'] = \DB::table('tb_social')->where('status', 1)->get();

                        $news_name = str_replace('-', ' ', $news_title);
                        $this->data['pageTitle'] = $news_name;
                        $curdate = date('Y-m-d');
                        $this->data['news_detail'] = \DB::table('tb_post_articles')->join('tb_users', 'tb_users.id', '=', 'tb_post_articles.user_id')->join('tb_news_categories', 'tb_news_categories.cat_id', '=', 'tb_post_articles.cat_id')->select('tb_post_articles.*', 'tb_news_categories.cat_name', 'tb_users.first_name', 'tb_users.last_name')->where('tb_post_articles.status', 1)->where('tb_post_articles.title_pos_1', $news_name)->where('tb_post_articles.publish_date', '<=', $curdate)->first();

                        $this->data['footer_text'] = \DB::table('tb_settings')->where('key_value', 'footer_text')->first();

                        return view($page, $this->data);
                    } else {
                        return Redirect::to('')
                                        ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
                    }
                } else {
                    return Redirect::to('')
                                    ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
                }
            } else {
                return Redirect::to('')
                                ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
            }

        else :
            $this->data['pageTitle'] = 'Home';
            $this->data['pageNote'] = 'Welcome To Our Site';
            $this->data['breadcrumb'] = 'inactive';
            $this->data['pageMetakey'] = CNF_METAKEY;
            $this->data['pageMetadesc'] = CNF_METADESC;

            $this->data['ads_home'] = \DB::table('tb_advertisement')->where('adv_status', 1)->get();

            $this->data['pages'] = 'pages.home';
            $page = 'layouts.' . CNF_THEME . '.index';
            return view($page, $this->data);
        endif;
    }

    function subProductPage($fid, Request $request) {
        if (CNF_FRONT == 'false' && $request->segment(1) == '') :
            return Redirect::to('dashboard');
        endif;

        //$page = $request->segment(1); 
        $page = 'subproduct';
        if ($page != '') :
            $content = \DB::table('tb_pages')->where('alias', '=', $page)->where('status', '=', 'enable')->get();
            //print_r($content); die;
            //return '';
            if ($fid != '' && $fid > 0) {
                if (count($content) >= 1) {
                    $row = $content[0];
                    $this->data['pageTitle'] = $row->title;
                    $this->data['pageNote'] = $row->note;
                    $this->data['pageMetakey'] = ($row->metakey != '' ? $row->metakey : CNF_METAKEY);
                    $this->data['pageMetadesc'] = ($row->metadesc != '' ? $row->metadesc : CNF_METADESC);

                    $this->data['breadcrumb'] = 'active';

                    if ($row->access != '') {
                        $access = json_decode($row->access, true);
                    } else {
                        $access = array();
                    }

                    // If guest not allowed 
                    if ($row->allow_guest != 1) {
                        $group_id = \Session::get('gid');
                        $isValid = (isset($access[$group_id]) && $access[$group_id] == 1 ? 1 : 0 );
                        if ($isValid == 0) {
                            return Redirect::to('')
                                            ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_restric')));
                        }
                    }
                    if ($row->template == 'backend') {
                        $page = 'pages.' . $row->filename;
                    } else {
                        $page = 'layouts.' . CNF_THEME . '.index';
                    }
                    //print_r($this->data);exit;

                    $filename = base_path() . "/resources/views/pages/" . $row->filename . ".blade.php";
                    if (file_exists($filename)) {
                        $this->data['pages'] = 'pages.' . $row->filename;
                        //	print_r($this->data);exit;
                        $this->data['social_links'] = \DB::table('tb_social')->where('status', 1)->get();
                        $this->data['footer_text'] = \DB::table('tb_settings')->where('key_value', 'footer_text')->first();
                        $this->data['parentArr'] = array_reverse($this->fetchFolderParentListArray($fid));

                        $default_front_design = \DB::table('tb_settings')->where('key_value', 'frontend_design')->first();
                        $this->data['final_folders'] = array();
                        $productgroup_folder = \DB::table('tb_container')->where('id', $fid)->first();
                        //echo '<pre>';
                        if (!empty($productgroup_folder)) {
                            //print_r($productgroup_folder);
                            $this->data['pageTitle'] = $productgroup_folder->display_name;
                            $par_folder = $productgroup_folder->id;
                            $parent_query = \DB::table('tb_container')->where('parent_id', $par_folder)->get();
                            $this->data['enabled_parent_array'] = array();
                            $temp_arr = array();
                            $temp_arr[$par_folder]['data'] = $productgroup_folder;
                            $temp_arr[$par_folder]['parents'] = $productgroup_folder->parent_id;

                            $p_is_enabled = false;
                            $enabled_cnt = \DB::table('tb_frontend_container')->where('container_id', $par_folder)->where('container_type', 'folder')->count();
                            if ($enabled_cnt > 0) {
                                $p_is_enabled = true;
                            }

                            $temp_arr[$par_folder]['is_enabled'] = $p_is_enabled;
                            if (!empty($parent_query)) {

                                foreach ($parent_query as $parent_obj) {
                                    $temp_array = array();
                                    $temp_array['data']['id'] = $parent_obj->id;
                                    $temp_array['data']['folder_id'] = $parent_obj->id;
                                    $temp_array['data']['name'] = (\Session::get('newlang') == 'English') ? $parent_obj->display_name_eng : $parent_obj->display_name;
                                    $temp_array['data']['display_name'] = $parent_obj->display_name;
                                    $temp_array['data']['file_type'] = 'folder';
                                    //$temp_array['data']['cover_img'] = $parent_obj->cover_img;
                                    $temp_array['data']['title'] = (\Session::get('newlang') == 'English') ? $parent_obj->title_eng : $parent_obj->title;
                                    $temp_array['data']['description'] = (\Session::get('newlang') == 'English') ? $parent_obj->description_eng : $parent_obj->description;
                                    $temp_array['data']['created'] = $parent_obj->created;
                                    $temp_array['data']['user_id'] = $parent_obj->user_id;
                                    $temp_array['data']['sort_num'] = $parent_obj->sort_num;
                                    $temp_array['data']['designer'] = array();

                                    $check_designer = \DB::table('tb_container_designers')->join('tb_designers', 'tb_designers.id', '=', 'tb_container_designers.designer_id')->where('tb_container_designers.container_id', $parent_obj->id)->where('tb_container_designers.container_type', 'folder')->first();
                                    if (!empty($check_designer)) {
                                        $temp_array['data']['designer'] = $check_designer;
                                    }

                                    if ($parent_obj->cover_img == "") {
                                        if (!empty($default_front_design) && $default_front_design->content == "masonry") {
                                            $temp_array['data']['cover_img'] = $parent_obj->temp_cover_img_masonry;
                                        } elseif (!empty($default_front_design) && $default_front_design->content == "grid") {
                                            $temp_array['data']['cover_img'] = $parent_obj->temp_cover_img;
                                        } else {
                                            $temp_array['data']['cover_img'] = $parent_obj->cover_img;
                                        }
                                    } else {
                                        $temp_array['data']['cover_img'] = $parent_obj->cover_img;
                                    }

                                    //$temp_array['data'] = $parent_obj;
                                    $temp_array['parents'] = $productgroup_folder->parent_id . ',' . $parent_obj->parent_id;
                                    $is_enabled = false;
                                    $enabled_cnt = \DB::table('tb_frontend_container')->where('container_id', $parent_obj->id)->where('container_type', 'folder')->count();
                                    $enabled_file_cnt = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $parent_obj->id)->count();
                                    if (($enabled_cnt > 0) && ($enabled_file_cnt > 0)) {
                                        $is_enabled = true;
                                        $this->set_all_enabled_parent($temp_array['parents'] . ',' . $parent_obj->id);
                                    }
                                    $temp_array['is_enabled'] = $is_enabled;
                                    $child_cnt = \DB::table('tb_container')->where('parent_id', $parent_obj->id)->count();
                                    if ($child_cnt > 0) {
                                        $temp_array['child'] = $this->get_all_child_folder($parent_obj->id, $temp_array['parents']);
                                    }


                                    $temp_arr[$par_folder]['child'][$parent_obj->id] = $temp_array;
                                }
                            }

                            $file_query = \DB::table('tb_container_files')->where('folder_id', $par_folder)->get();
                            foreach ($file_query as $file_obj) {
                                $temp_array = array();
                                $extype = explode('/', $file_obj->file_type);
                                if ($extype[0] == "image") {
                                    $temp_array['data']['id'] = $file_obj->id;
                                    $temp_array['data']['folder_id'] = $file_obj->folder_id;
                                    $temp_array['data']['name'] = (\Session::get('newlang') == 'English') ? ($file_obj->file_display_name_eng != '') ? $file_obj->file_display_name_eng : $file_obj->file_name : ($file_obj->file_display_name != '') ? $file_obj->file_display_name : $file_obj->file_name;
                                    $temp_array['data']['display_name'] = ($file_obj->file_display_name != '') ? $file_obj->file_display_name : $file_obj->file_name;
                                    $temp_array['data']['file_type'] = 'file';
                                    $temp_array['data']['cover_img'] = $file_obj->file_name;
                                    $temp_array['data']['title'] = (\Session::get('newlang') == 'English') ? $file_obj->file_title_eng : $file_obj->file_title;
                                    $temp_array['data']['description'] = (\Session::get('newlang') == 'English') ? $file_obj->file_description_eng : $file_obj->file_description;
                                    $temp_array['data']['created'] = $file_obj->created;
                                    $temp_array['data']['user_id'] = $file_obj->user_id;
                                    $temp_array['data']['sort_num'] = $file_obj->file_sort_num;
                                    $temp_array['data']['designer'] = array();

                                    $dirPath = (new ContainerController)->getContainerUserPath($file_obj->folder_id);
                                    $copytofolder = public_path() . '/uploads/folder_cover_imgs/';
                                    if (!\File::exists($copytofolder . 'masonry_product_file_' . $file_obj->file_name)) {
                                        // IMage for Product page
                                        /* $pdimg = \Image::make($dirPath.$file_obj->file_name);
                                          $pdimg->resize(305, 223);
                                          $pdimgfile = 'product_file_'.$file_obj->file_name;
                                          $pdimg->save($copytofolder.$pdimgfile); */

                                        $mpimg = \Image::make($dirPath . $file_obj->file_name);
                                        $mactualsize = getimagesize($dirPath . $file_obj->file_name);
                                        if ($mactualsize[0] > $mactualsize[1]) {
                                            $mpimg->resize(349, 228);
                                        } else {
                                            $mpimg->resize(349, 527);
                                        }
                                        $mpfile = 'masonry_product_file_' . $file_obj->file_name;
                                        $mpimg->save($copytofolder . $mpfile);
                                    }
                                }
                                //$temp_array['data'] = $file_obj;
                                $temp_array['parents'] = $productgroup_folder->parent_id . ',' . $file_obj->folder_id;
                                $is_enabled = false;
                                $enabled_cnt = \DB::table('tb_frontend_container')->where('container_id', $file_obj->id)->where('container_type', 'file')->count();
                                if ($enabled_cnt > 0) {
                                    $is_enabled = true;
                                    $this->set_all_enabled_parent($temp_array['parents'] . ',i-' . $file_obj->id);
                                }

                                $temp_array['is_enabled'] = $is_enabled;


                                $temp_arr[$par_folder]['child']['i-' . $file_obj->id] = $temp_array;
                            }

                            $this->data['final_folders'] = $this->set_parents_enables($temp_arr);
                            //print_r($this->data['final_folders']);
                        }

                        $front_design = "grid";
                        if (!empty($default_front_design) && $default_front_design->content != "") {
                            $front_design = $default_front_design->content;
                        }
                        $this->data['default_front_design'] = $front_design;

                        $this->data['parentsfolders'] = array();
                        $productgroup_folder = \DB::table('tb_container')->where('name', 'Produktgruppen')->first();
                        if (!empty($productgroup_folder)) {
                            $par_folder = $productgroup_folder->id;
                            $mainparent_query = \DB::table('tb_container')->where('parent_id', $par_folder)->get();
                            $this->data['enabled_parent_array'] = array();
                            if (!empty($mainparent_query)) {
                                //echo '<pre>';
                                $parent_temp_arr = array();
                                foreach ($mainparent_query as $parent_obj) {
                                    $parent_temp_array = array();
                                    $parent_temp_array['data'] = $parent_obj;
                                    $parent_temp_array['parents'] = $parent_obj->parent_id;
                                    $is_enabled = false;
                                    $enabled_cnt = \DB::table('tb_frontend_container')->where('container_id', $parent_obj->id)->where('container_type', 'folder')->count();
                                    $enabled_file_cnt = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $parent_obj->id)->count();
                                    if (($enabled_cnt > 0) && ($enabled_file_cnt > 0)) {
                                        $is_enabled = true;
                                        $this->set_all_enabled_parent($parent_temp_array['parents'] . ',' . $parent_obj->id);
                                    }
                                    $parent_temp_array['is_enabled'] = $is_enabled;
                                    $child_cnt = \DB::table('tb_container')->where('parent_id', $parent_obj->id)->count();
                                    if ($child_cnt > 0) {
                                        $parent_temp_array['child'] = $this->get_all_child_folder($parent_obj->id, $parent_temp_array['parents']);
                                    }


                                    $parent_temp_arr[$parent_obj->id] = $parent_temp_array;
                                }

                                $this->data['parentsfolders'] = $this->set_parents_enables($parent_temp_arr);
                                //print_r($this->data['parentsfolders']);
                            }
                        }

                        return view($page, $this->data);
                    } else {
                        return Redirect::to('')
                                        ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
                    }
                } else {
                    return Redirect::to('')
                                    ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
                }
            } else {
                return Redirect::to('')
                                ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
            }

        else :
            $this->data['pageTitle'] = 'Home';
            $this->data['pageNote'] = 'Welcome To Our Site';
            $this->data['breadcrumb'] = 'inactive';
            $this->data['pageMetakey'] = CNF_METAKEY;
            $this->data['pageMetadesc'] = CNF_METADESC;

            $this->data['ads_home'] = \DB::table('tb_advertisement')->where('adv_status', 1)->get();

            $this->data['pages'] = 'pages.home';
            $page = 'layouts.' . CNF_THEME . '.index';
            return view($page, $this->data);
        endif;
    }

    function ProductDetail($pid, Request $request) {
        if (CNF_FRONT == 'false' && $request->segment(1) == '') :
            return Redirect::to('dashboard');
        endif;

        //$page = $request->segment(1); 
        $page = 'feature';
        if ($page != '') :
            $content = \DB::table('tb_pages')->where('alias', '=', $page)->where('status', '=', 'enable')->get();
            //print_r($content); die;
            //return '';
            if ($pid != '' && $pid > 0) {
                if (count($content) >= 1) {

                    $row = $content[0];
                    $this->data['pageTitle'] = $row->title;
                    $this->data['pageNote'] = $row->note;
                    $this->data['pageMetakey'] = ($row->metakey != '' ? $row->metakey : CNF_METAKEY);
                    $this->data['pageMetadesc'] = ($row->metadesc != '' ? $row->metadesc : CNF_METADESC);

                    $this->data['breadcrumb'] = 'active';

                    if ($row->access != '') {
                        $access = json_decode($row->access, true);
                    } else {
                        $access = array();
                    }

                    // If guest not allowed 
                    if ($row->allow_guest != 1) {
                        $group_id = \Session::get('gid');
                        $isValid = (isset($access[$group_id]) && $access[$group_id] == 1 ? 1 : 0 );
                        if ($isValid == 0) {
                            return Redirect::to('')
                                            ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_restric')));
                        }
                    }
                    if ($row->template == 'backend') {
                        $page = 'pages.' . $row->filename;
                    } else {
                        $page = 'layouts.' . CNF_THEME . '.index';
                    }
                    //print_r($this->data);exit;

                    $filename = base_path() . "/resources/views/pages/" . $row->filename . ".blade.php";
                    if (file_exists($filename)) {
                        $this->data['pages'] = 'pages.' . $row->filename;
                        $this->data['social_links'] = \DB::table('tb_social')->where('status', 1)->get();
                        $this->data['footer_text'] = \DB::table('tb_settings')->where('key_value', 'footer_text')->first();

                        $sliderfolder = \DB::table('tb_container')->where('parent_id', $pid)->where('name', 'slider')->first();
                        if (!empty($sliderfolder)) {
                            $this->data['slider_images'] = \DB::table('tb_container_files')->where('folder_id', $sliderfolder->id)->where(function ($query) {
                                        $query->where('file_type', 'image/jpeg')->orWhere('file_type', 'image/png')->orWhere('file_type', 'image/gif');
                                    })->orderBy('file_sort_num', 'asc')->get();
                            $this->data['sliderimgpath'] = (new ContainerController)->getThumbpath($sliderfolder->id);
                            $this->data['slidercontainerpath'] = (new ContainerController)->getContainerUserPath($sliderfolder->id);
                        }

                        $check_custom_text = \DB::table('tb_container_attributes')->where('container_id', $pid)->where('container_type', 'folder')->first();
                        if (!empty($check_custom_text)) {
                            $this->data['custom_desciption'] = $check_custom_text;
                        }

                        $variantfolder = \DB::table('tb_container')->where('parent_id', $pid)->where('name', 'produktvarianten')->first();
                        if (!empty($variantfolder)) {
                            $variant_images = \DB::table('tb_container_files')->where('folder_id', $variantfolder->id)->where(function ($query) {
                                        $query->where('file_type', 'image/jpeg')->orWhere('file_type', 'image/png')->orWhere('file_type', 'image/gif');
                                    })->orderBy('file_sort_num', 'asc')->get();
                            $this->data['variantimgpath'] = (new ContainerController)->getThumbpath($variantfolder->id);
                            if (!empty($variant_images)) {
                                $this->data['variant_images'] = $variant_images;
                                $AttrArr = array();
                                foreach ($variant_images as $variant_image) {
                                    $checkattr = \DB::table('tb_container_attributes')->where('container_id', $variant_image->id)->where('container_type', 'file')->get();
                                    if (!empty($checkattr)) {
                                        $a = 0;
                                        foreach ($checkattr as $fetchattr) {
                                            $cat = \DB::table('tb_attributes')->where('id', $fetchattr->attr_id)->first();
                                            if (!empty($cat)) {
                                                $AttrArr[$variant_image->id][$cat->attr_cat][$a]['AttrType'] = $fetchattr->attr_type;
                                                $AttrArr[$variant_image->id][$cat->attr_cat][$a]['Attrs'] = $cat;
                                                if ($fetchattr->attr_type == "checkboxes" || $fetchattr->attr_type == "dropdown" || $fetchattr->attr_type == "radio") {
                                                    $expAttrval = explode(',', $fetchattr->attr_value);
                                                    $AttrArr[$variant_image->id][$cat->attr_cat][$a]['AttrVal'] = \DB::table('tb_attributes_options')->whereIn('id', $expAttrval)->get();
                                                } elseif ($fetchattr->attr_type == "group") {
                                                    $fetch_group = \DB::table('tb_group_content')->where('attr_id', $fetchattr->attr_id)->distinct()->get();
                                                    $AttrArr[$variant_image->id][$cat->attr_cat][$a]['grouphead'] = '';
                                                    if (!empty($fetch_group)) {
                                                        $grouphead = array();
                                                        foreach ($fetch_group as $grouphed) {
                                                            $grouphead[$grouphed->assign_attr_id] = \DB::table('tb_attributes')->where('id', $grouphed->assign_attr_id)->first();
                                                        }
                                                        $AttrArr[$variant_image->id][$cat->attr_cat][$a]['grouphead'] = $grouphead;
                                                    }

                                                    $fetch_groupdata = \DB::table('tb_group_content')->where('attr_id', $fetchattr->attr_id)->get();
                                                    $AttrArr[$variant_image->id][$cat->attr_cat][$a]['groupdata'] = '';
                                                    if (!empty($fetch_groupdata)) {
                                                        $groupdata = array();
                                                        foreach ($fetch_groupdata as $group) {
                                                            $sorting = \DB::table('tb_attributes')->where('id', $group->assign_attr_id)->first();
                                                            $exp_grp_Attrval = explode(',', $group->assign_attr_val);
                                                            $groupdata[$group->group_row_num][$sorting->sort_order] = \DB::table('tb_attributes_options')->whereIn('id', $exp_grp_Attrval)->get();
                                                        }
                                                        $AttrArr[$variant_image->id][$cat->attr_cat][$a]['groupdata'] = $groupdata;
                                                    }
                                                    /* print "<pre>";
                                                      print_r($AttrArr); */
                                                } else {
                                                    $AttrArr[$variant_image->id][$cat->attr_cat][$a]['AttrVal'] = $fetchattr->attr_value;
                                                }
                                                $a++;
                                            }
                                        }
                                    }
                                }
                                //print "<pre>";
                                //print_r($AttrArr);
                                $this->data['AttrArr'] = $AttrArr;
                            }
                        }

                        $folderDetail = \DB::table('tb_container')->where('id', $pid)->first();
                        $this->data['folderDetail'] = $folderDetail;
                        $this->data['pageTitle'] = $folderDetail->display_name;
                        $this->data['fileDetail'] = '';
                        $this->data['parentArr'] = array_reverse($this->fetchFolderParentListArray($pid));
                        /* $file = \DB::table('tb_container_files')->where('folder_id',$pid)->where(function ($query) { $query->where('file_type', 'image/jpeg')->orWhere('file_type', 'image/png')->orWhere('file_type', 'image/gif');})->get();
                          if(!empty($file))
                          {
                          $fileimgsrc = (new ContainerController)->getContainerUserPath($pid);
                          $this->data['fileDetail'] = $file;
                          foreach($file as $filesObj)
                          {
                          if (! \File::exists(public_path(). '/uploads/thumbs/product_detail_list_'.$filesObj->file_name))
                          {
                          // IMage for Product detail page
                          $pdlimg = \Image::make($fileimgsrc.$filesObj->file_name);
                          $pdlimg->resize(600, 500);
                          $pdlimgfile = 'product_detail_list_'.$filesObj->file_name;
                          $pdlimg->save(public_path(). '/uploads/thumbs/'.$pdlimgfile);
                          }
                          }

                          } */

                        /* $this->data['sub_images'] = \DB::table('tb_file_subimages')->where('file_id',$file->id)->where('status',0)->get();
                          $this->data['varients'] = \DB::table('tb_file_varients')->where('file_id',$file->id)->get();
                          $check_varint_attr = \DB::table('tb_varient_attributes')->where('file_id',$file->id)->get();
                          $var_attr = array();
                          if(!empty($check_varint_attr))
                          {
                          $a=0;
                          foreach($check_varint_attr as $fetchattr)
                          {
                          $var_attr[$fetchattr->varient_id][$a]['AttrType'] = $fetchattr->attr_type;
                          $var_attr[$fetchattr->varient_id][$a]['Attrs'] = \DB::table('tb_attributes')->where('id',$fetchattr->attr_id)->first();
                          if($fetchattr->attr_type=="checkboxes" || $fetchattr->attr_type=="dropdown" || $fetchattr->attr_type=="radio")
                          {
                          $expAttrval = explode(',',$fetchattr->attr_value);
                          $var_attr[$fetchattr->varient_id][$a]['AttrVal'] = \DB::table('tb_attributes_options')->whereIn('id',$expAttrval)->get();
                          }
                          else{
                          $var_attr[$fetchattr->varient_id][$a]['AttrVal'] = $fetchattr->attr_value;
                          }
                          $a++;
                          }

                          }

                          //print "<pre>";
                          //print_r($var_attr);

                          $this->data['varient_attrs'] = $var_attr; */

                        return view($page, $this->data);
                    } else {
                        return Redirect::to('')
                                        ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
                    }
                } else {
                    return Redirect::to('')
                                    ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
                }
            } else {
                return Redirect::to('')
                                ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
            }

        else :
            $this->data['pageTitle'] = 'Home';
            $this->data['pageNote'] = 'Welcome To Our Site';
            $this->data['breadcrumb'] = 'inactive';
            $this->data['pageMetakey'] = CNF_METAKEY;
            $this->data['pageMetadesc'] = CNF_METADESC;

            $this->data['ads_home'] = \DB::table('tb_advertisement')->where('adv_status', 1)->get();

            $this->data['pages'] = 'pages.home';
            $page = 'layouts.' . CNF_THEME . '.index';
            return view($page, $this->data);
        endif;
    }

    public function show_full_project($pro_id, Request $request) {

        if (CNF_FRONT == 'false' && $request->segment(1) == '') :
            return Redirect::to('dashboard');
        endif;

        $page = $request->segment(1);
        if ($page != '') :
            $content = \DB::table('tb_pages')->where('alias', '=', $page)->where('status', '=', 'enable')->get();
            //print_r($content); die;
            //return '';
            if ($pro_id != '' && $pro_id > 0) {
                if (count($content) >= 1) {

                    $row = $content[0];
                    $this->data['pageTitle'] = $row->title;
                    $this->data['pageNote'] = $row->note;
                    $this->data['pageMetakey'] = ($row->metakey != '' ? $row->metakey : CNF_METAKEY);
                    $this->data['pageMetadesc'] = ($row->metadesc != '' ? $row->metadesc : CNF_METADESC);

                    $this->data['breadcrumb'] = 'active';

                    if ($row->access != '') {
                        $access = json_decode($row->access, true);
                    } else {
                        $access = array();
                    }

                    // If guest not allowed 
                    if ($row->allow_guest != 1) {
                        $group_id = \Session::get('gid');
                        $isValid = (isset($access[$group_id]) && $access[$group_id] == 1 ? 1 : 0 );
                        if ($isValid == 0) {
                            return Redirect::to('')
                                            ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_restric')));
                        }
                    }
                    if ($row->template == 'backend') {
                        $page = 'pages.' . $row->filename;
                    } else {
                        $page = 'layouts.' . CNF_THEME . '.index';
                    }
                    //print_r($this->data);exit;

                    $filename = base_path() . "/resources/views/pages/" . $row->filename . ".blade.php";
                    if (file_exists($filename)) {
                        $this->data['pages'] = 'pages.' . $row->filename;
                        //	print_r($this->data);exit;
                        $this->data['social_links'] = \DB::table('tb_social')->where('status', 1)->get();
                        $this->data['footer_text'] = \DB::table('tb_settings')->where('key_value', 'footer_text')->first();
                        $curdate = date('Y-m-d');

                        $this->data['project_detail'] = \DB::table('tb_post_projects')->join('tb_users', 'tb_users.id', '=', 'tb_post_projects.user_id')->select('tb_post_projects.*', 'tb_users.first_name', 'tb_users.last_name')->where('tb_post_projects.status', 1)->where('tb_post_projects.id', $pro_id)->where('tb_post_projects.publish_date', '<=', $curdate)->first();

                        return view($page, $this->data);
                    } else {
                        return Redirect::to('')
                                        ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
                    }
                } else {
                    return Redirect::to('')
                                    ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
                }
            } else {
                return Redirect::to('')
                                ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
            }

        else :
            $this->data['pageTitle'] = 'Home';
            $this->data['pageNote'] = 'Welcome To Our Site';
            $this->data['breadcrumb'] = 'inactive';
            $this->data['pageMetakey'] = CNF_METAKEY;
            $this->data['pageMetadesc'] = CNF_METADESC;

            $this->data['ads_home'] = \DB::table('tb_advertisement')->where('adv_status', 1)->get();

            $this->data['pages'] = 'pages.home';
            $page = 'layouts.' . CNF_THEME . '.index';
            return view($page, $this->data);
        endif;
    }

    function fetchFolderParentListArray($id = 0, $parent_folders_array = '') {

        if (!is_array($parent_folders_array))
            $parent_folders_array = array();

        $results = \DB::table('tb_container')->where('id', $id)->get();
        if ($results) {
            foreach ($results as $row) {
                $parent_folders_array[] = $row;
                $parent_folders_array = $this->fetchFolderParentListArray($row->parent_id, $parent_folders_array);
            }
        }
        return $parent_folders_array;
    }

    function propertiesSearch(Request $request) {
        
        if (CNF_FRONT == 'false' && $request->segment(1) == '') :
            return Redirect::to('dashboard');
        endif;

        $keyword = trim($request->input('s'));
        $show = 'asc';

        if ($keyword!='') {
            $CityArrdestts = array();  
            $categoryObj = \DB::table('tb_categories')->where('category_name', $keyword)->first();
            dd($categoryObj);
            $citydest = \DB::table('tb_categories')->where('parent_category_id', $categoryObj->id)->get();
            if (!empty($citydest)) {
                $d = 0;
                foreach ($citydest as $cdest) {
                    $cityprops = DB::select(DB::raw("SELECT id FROM tb_properties WHERE tb_properties.property_type = 'Hotel' AND FIND_IN_SET('$cdest->id',property_category_id) AND property_status = '1'"));
                    if (!empty($cityprops)) {
                        $CityArrdestts[$d] = $cdest;
                        $CityArrdestts[$d]->totalproperty = count($cityprops);
                        $d++;
                    }
                }
            }
            $this->data['cities'] = $CityArrdestts;
        }
        /* if(!is_null($request->input('show')) && $request->input('show')!='')
          {
          $show = $request->input('show');
          } */

        $page = $request->segment(1);
        if ($page != '') :
            $content = \DB::table('tb_pages')->where('alias', '=', $page)->where('status', '=', 'enable')->get();

//			if($keyword!='')
            if (true) {
                if (count($content) >= 1) {
                    $row = $content[0];
                    $this->data['pageTitle'] = $row->title;
                    $this->data['pageNote'] = $row->note;
                    $this->data['pageMetakey'] = ($row->metakey != '' ? $row->metakey : CNF_METAKEY);
                    $this->data['pageMetadesc'] = ($row->metadesc != '' ? $row->metadesc : CNF_METADESC);

                    $this->data['breadcrumb'] = 'active';

                    if ($row->access != '') {
                        $access = json_decode($row->access, true);
                    } else {
                        $access = array();
                    }

                    // If guest not allowed 
                    if ($row->allow_guest != 1) {
                        $group_id = \Session::get('gid');
                        $isValid = (isset($access[$group_id]) && $access[$group_id] == 1 ? 1 : 0 );
                        if ($isValid == 0) {
                            return Redirect::to('')
                                            ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_restric')));
                        }
                    }
                    if ($row->template == 'backend') {
                        $page = 'pages.' . $row->filename;
                    } else {
                        $page = 'layouts.' . CNF_THEME . '.index';
                    }
                    //print_r($this->data);exit;

                    $filename = base_path() . "/resources/views/pages/" . $row->filename . ".blade.php";
                    if (file_exists($filename)) {
                        $this->data['pages'] = 'pages.' . $row->filename;
                        $arrive = $destination = $adult = $childs = '';
                        if (!is_null($request->input('arrive')) && $request->input('arrive') != '') {
                            \Session::put('arrive_date', $request->input('arrive'));
                            $this->data['arrive_date'] = $request->input('arrive');
                            $arrive = date("Y-m-d", strtotime(trim($request->input('arrive'))));
                        }
                        if (!is_null($request->input('destination')) && $request->input('destination') != '') {
                            \Session::put('destination_date', $request->input('destination'));
                            $this->data['destination_date'] = $request->input('destination');
                            $destination = date("Y-m-d", strtotime(trim($request->input('destination'))));
                        }
                        if (!is_null($request->input('adult')) && $request->input('adult') != '') {
                            \Session::put('adults', $request->input('adult'));
                            $this->data['adults'] = $request->input('adult');
                        }
                        if (!is_null($request->input('childs')) && $request->input('childs') != '') {
                            \Session::put('childs', $request->input('childs'));
                            $this->data['childs'] = $request->input('childs');
                        }
                        $propertiesArr = array();
                        $props = array();
                        $perPage = 40;
                        $currentPage = Input::get('page', 1) - 1;
                        $TagsObj = \DB::table('tb_tags_manager')->select('id')->where('tag_title', Input::get('s', false))->where('tag_status', 1)->first();
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
                                                        if ($destination != '') {
                                                            $propstemp->where('tb_properties_category_rooms.room_active_to', '>=', $destination);
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
                                                if ($destination != '') {
                                                    $propstemp->where('tb_properties_category_rooms.room_active_to', '>=', $destination);
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

                        if ($arrive != '') {
                            $seapropstemp = \DB::table('tb_properties')->join('tb_properties_category_rooms', 'tb_properties_category_rooms.property_id', '=', 'tb_properties.id')->select('tb_properties.editor_choice_property',
                                                            'tb_properties.feature_property',
                                                            'tb_properties.id',
                                                            'tb_properties.property_name',
                                                            'tb_properties.property_slug',
                                                            'tb_properties.property_category_id')->where('tb_properties_category_rooms.room_active_from', '<=', $arrive)->where('tb_properties.property_name', 'like', '%' . $keyword . '%')->where('tb_properties.property_status', 1)->where('tb_properties.property_type', 'Hotel');
                            if ($destination != '') {
                                $seapropstemp->where('tb_properties_category_rooms.room_active_to', '>=', $destination);
                            }
                            $seaprops = $seapropstemp->orderBy('tb_properties.editor_choice_property', 'desc')->orderBy('tb_properties.feature_property', 'desc')->get();
                        } else {
//                            $seaprops = \DB::table('tb_properties')->where('property_name', 'like', '%' . $keyword . '%')->where('property_status', 1)->where('tb_properties.property_type', 'Hotel')->get();
                            $query = "SELECT editor_choice_property,feature_property,id,property_name,property_slug,property_category_id FROM tb_properties WHERE property_name LIKE '%$keyword%' AND property_status = 1 AND tb_properties.property_type = 'Hotel' ";
                            $query .= "ORDER BY tb_properties.editor_choice_property desc, tb_properties.feature_property desc, (SELECT rack_rate FROM tb_properties_category_rooms_price WHERE tb_properties_category_rooms_price.property_id = tb_properties.id ORDER BY rack_rate DESC LIMIT 1) * 1 DESC ";
                            $seaprops = DB::select(DB::raw($query));
                        }

                        if (!empty($seaprops)) {
                            foreach ($seaprops as $sprop) {
                                $propertiesArr[$sprop->id]['data'] = $sprop;
                                $propertiesArr[$sprop->id]['data']->price = '';
                                $checkseasonPrice = \DB::table('tb_properties_category_rooms_price')->where('property_id', $sprop->id)->orderBy('rack_rate', 'DESC')->first();
                                if (!empty($checkseasonPrice)) {
                                    $propertiesArr[$sprop->id]['data']->price = $checkseasonPrice->rack_rate;
                                }
                                $sfileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.file_id', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $sprop->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();

                                if (!empty($sfileArr)) {
                                    $propertiesArr[$sprop->id]['image'] = $sfileArr;
                                    $propertiesArr[$sprop->id]['image']->imgsrc = (new ContainerController)->getThumbpath($sfileArr->folder_id);
                                }
                                $pr++;
                            }
                        }

                        $cateObj = \DB::table('tb_categories')->where('category_name', Input::get('s', false))->where('category_published', 1)->first();
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
                                                        return sprintf("FIND_IN_SET('%s', tb_properties.property_category_id)", $v);
                                                    }, array_values($chldIds))) . ")";
                                }
                                if ($destination != '') {
                                    $getdestind = " AND tb_properties_category_rooms.room_active_to <= '$destination'";
                                }
                                $catprops = \DB::select(DB::raw("SELECT tb_properties.editor_choice_property,
                                                            tb_properties.feature_property,
                                                            tb_properties.id,
                                                            tb_properties.property_name,
                                                            tb_properties.property_slug,
                                                            tb_properties.property_category_id FROM tb_properties JOIN tb_properties_category_rooms ON tb_properties_category_rooms.property_id = tb_properties.id WHERE tb_properties.property_status='1' AND tb_properties_category_rooms.room_active_from <= '$arrive' $getdestind  $getcats order by tb_properties.editor_choice_property desc, tb_properties.feature_property desc"));
                            } else {
                                $catprops = \DB::select(DB::raw("SELECT editor_choice_property,feature_property,id,property_name,property_slug,property_category_id FROM tb_properties WHERE property_status='1' $getcats order by editor_choice_property desc, feature_property desc"));
                            }
                            if (!empty($catprops)) {
                                foreach ($catprops as $cprop) {
                                    $propertiesArr[$cprop->id]['data'] = $cprop;
                                    $propertiesArr[$cprop->id]['data']->price = '';
                                    $checkseasonPrice = \DB::table('tb_properties_category_rooms_price')->where('property_id', $cprop->id)->orderBy('rack_rate', 'DESC')->first();
                                    if (!empty($checkseasonPrice)) {
                                        $propertiesArr[$cprop->id]['data']->price = $checkseasonPrice->rack_rate;
                                    }
                                    $sfileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.file_id', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $cprop->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();

                                    if (!empty($sfileArr)) {
                                        $propertiesArr[$cprop->id]['image'] = $sfileArr;
                                        $propertiesArr[$cprop->id]['image']->imgsrc = (new ContainerController)->getThumbpath($sfileArr->folder_id);
                                    }
                                    $pr++;
                                }
                            }
                        }
						
						$cityquery = "SELECT editor_choice_property,feature_property,id,property_name,property_slug,property_category_id FROM tb_properties WHERE city LIKE '%$keyword%' AND property_status = 1 ORDER BY tb_properties.editor_choice_property desc, tb_properties.feature_property desc, (SELECT rack_rate FROM tb_properties_category_rooms_price WHERE tb_properties_category_rooms_price.property_id = tb_properties.id ORDER BY rack_rate DESC LIMIT 1) * 1 DESC ";
                        $cityquery = DB::select(DB::raw($cityquery));
                        if (!empty($cityquery)) {
                            foreach ($cityquery as $ctprop) {
                                $propertiesArr[$ctprop->id]['data'] = $ctprop;
                                $propertiesArr[$ctprop->id]['data']->price = '';
                                $checkseasonPrice = \DB::table('tb_properties_category_rooms_price')->where('property_id', $ctprop->id)->orderBy('rack_rate', 'DESC')->first();
                                if (!empty($checkseasonPrice)) {
                                    $propertiesArr[$ctprop->id]['data']->price = $checkseasonPrice->rack_rate;
                                }
                                $sfileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.file_id', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $ctprop->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();

                                if (!empty($sfileArr)) {
                                    $propertiesArr[$ctprop->id]['image'] = $sfileArr;
                                    $propertiesArr[$ctprop->id]['image']->imgsrc = (new ContainerController)->getThumbpath($sfileArr->folder_id);
                                }
                                $pr++;
                            }
                        }

//                        usort($propertiesArr, function($a, $b) {
//                            return trim($a['data']->property_name) > trim($b['data']->property_name);
//                        });
                        //echo count($propertiesArr);
                        $pagedData = array_slice($propertiesArr, $currentPage * $perPage, $perPage);
                        $pagination = new Paginator($pagedData, count($propertiesArr), $perPage);
                        $pagination->setPath(\URL::to('search'));
                        //print_r($pagination);
                        $this->data['propertiesArr'] = $pagination;

                        $uid = isset(\Auth::user()->id) ? \Auth::user()->id : '';
                        $this->data['lightboxes'] = \DB::table('tb_lightbox')->select('box_name','id')->where('user_id', $uid)->get();

                        $boxcontent = \DB::table('tb_lightbox_content')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_lightbox_content.file_id')->select('tb_lightbox_content.file_id', 'tb_lightbox_content.id', 'tb_lightbox_content.lightbox_id', 'tb_container_files.file_name', 'tb_container_files.folder_id', 'tb_container_files.file_display_name', 'tb_container_files.file_title')->where('tb_lightbox_content.user_id', $uid)->get();

                        $boxcont = array();
                        if (!empty($boxcontent)) {
                            $l = 0;
                            foreach ($boxcontent as $bcontent) {
                                $boxcont[$bcontent->lightbox_id][$l]['lightbox'] = $bcontent;
                                $fetch_prop_img = \DB::table('tb_properties_images')->join('tb_properties','tb_properties_images.property_id','=','tb_properties.id')->select('property_name')->where('file_id', $bcontent->file_id)->first();
                                if (!empty($fetch_prop_img)) {
                                    $boxcont[$bcontent->lightbox_id][$l]['property'] = $fetch_prop_img;
                                }
                                $l++;
                            }
                        }
                        $this->data['lightcontent'] = $boxcont;

                        $tags_Arr = \DB::table('tb_tags_manager')->where('tag_status', 1)->get();
                        $tagsArr = array();
                        if (!empty($tags_Arr)) {
                            foreach ($tags_Arr as $tags) {
                                $tagsArr[$tags->parent_tag_id][] = $tags;
                            }
                        }

                        $mainArrdestts = array();
                        $maindest = \DB::table('tb_categories')->where('parent_category_id', 0)->where('id', '!=', 8)->get();
                        if (!empty($maindest)) {
                            $d = 0;
                            foreach ($maindest as $mdest) {

                                /*                                 * *********************************************** */

                                $getcats = '';
                                $chldIds = array();
                                $childdest = \DB::table('tb_categories')->where('parent_category_id', $mdest->id)->get();
                                if (!empty($childdest)) {
                                    $chldIds = $this->fetchcategoryChildListIds($mdest->id);
                                    array_unshift($chldIds, $mdest->id);
                                } else {
                                    $chldIds[] = $mdest->id;
                                }

                                if (!empty($chldIds)) {
                                    $getcats = " AND (" . implode(" || ", array_map(function($v) {
                                                        return sprintf("FIND_IN_SET('%s', property_category_id)", $v);
                                                    }, array_values($chldIds))) . ")";
                                }

                                $preprops = DB::select(DB::raw("SELECT COUNT(*) AS total_rows FROM tb_properties WHERE property_status = '1' $getcats"));

                                if (isset($preprops[0]->total_rows) && $preprops[0]->total_rows > 0) {
                                    $mainArrdestts[$d] = $mdest;
                                    if (!empty($childdest)) {
                                        $c = 0;
                                        foreach ($childdest as $cdest) {

                                            $getcats = '';
                                            $chldIds = array();
                                            $subchilddest = DB::select(DB::raw("SELECT * FROM tb_categories WHERE parent_category_id = '{$cdest->id}' AND (SELECT COUNT(*) AS total_rows FROM tb_properties WHERE property_status = '1' AND (FIND_IN_SET(tb_categories.id, property_category_id))) > 0 "));
                                            if (!empty($subchilddest)) {
                                                $chldIds = $this->fetchcategoryChildListIds($cdest->id);
                                                array_unshift($chldIds, $cdest->id);
                                            } else {
                                                $chldIds[] = $cdest->id;
                                            }

                                            if (!empty($chldIds)) {
                                                $getcats = " AND (" . implode(" || ", array_map(function($v) {
                                                                    return sprintf("FIND_IN_SET('%s', property_category_id)", $v);
                                                                }, array_values($chldIds))) . ")";
                                            }

                                            $preprops = DB::select(DB::raw("SELECT COUNT(*) AS total_rows FROM tb_properties WHERE property_status = '1' $getcats"));

                                            if (isset($preprops[0]->total_rows) && $preprops[0]->total_rows > 0) {
                                                $mainArrdestts[$d]->childs[$c] = $cdest;
                                                if (!empty($subchilddest)) {

                                                    foreach ($subchilddest as $key => $_subchilddest) {
                                                        $getcats = '';
                                                        $chldIds = array();
                                                        $temp = DB::select(DB::raw("SELECT * FROM tb_categories WHERE parent_category_id = '{$_subchilddest->id}' AND (SELECT COUNT(*) AS total_rows FROM tb_properties WHERE property_status = '1' AND (FIND_IN_SET(tb_categories.id, property_category_id))) > 0 "));
                                                        if (!empty($temp)) {
                                                            $chldIds = $this->fetchcategoryChildListIds($_subchilddest->id);
                                                            array_unshift($chldIds, $_subchilddest->id);
                                                        } else {
                                                            $chldIds[] = $_subchilddest->id;
                                                        }

                                                        if (!empty($chldIds)) {
                                                            $getcats = " AND (" . implode(" || ", array_map(function($v) {
                                                                                return sprintf("FIND_IN_SET('%s', property_category_id)", $v);
                                                                            }, array_values($chldIds))) . ")";
                                                        }
                                                        $preprops = DB::select(DB::raw("SELECT COUNT(*) AS total_rows FROM tb_properties WHERE property_status = '1' $getcats"));

                                                        if (isset($preprops[0]->total_rows) && $preprops[0]->total_rows > 0) {
                                                            $subchilddest[$key]->subchild = $temp;
                                                        }
                                                    }

                                                    $mainArrdestts[$d]->childs[$c]->subchild = $subchilddest;
                                                }
                                                $c++;
                                            }
                                        }
                                        $c++;
                                    }
                                }
                                $d++;
                            }
                        }

                        $this->data['categoryslider'] = \DB::table('tb_sliders')->where('slider_category', Input::get('s', false))->get();

                        $adscateObj = \DB::table('tb_categories')->where('category_name', Input::get('s', false))->where('category_published', 1)->first();
                        $resultads = array();
                        if (!empty($adscateObj)) {
                            $reultsgridAds = \DB::table('tb_advertisement')->where('adv_type', 'sidebar')->where('ads_cat_id', $adscateObj->id)->where('adv_position', 'grid_results')->get();

                            if (!empty($reultsgridAds)) {
                                foreach ($reultsgridAds as $ads) {
                                    $resultads[] = $ads;
                                }
                            }
                        }
                        $this->data['reultsgridAds'] = $resultads;
                        if (!empty($adscateObj)) {
                            $this->data['sidebargridAds'] = \DB::table('tb_advertisement')->where('adv_type', 'sidebar')->where('ads_cat_id', $adscateObj->id)->where('adv_position', 'grid_sidebar')->get();
                        } else {
                            $this->data['sidebargridAds'] = '';
                        }
                        $this->data['ourmaindesitnation'] = $mainArrdestts;
                        $this->data['continent'] = $request->continent;
                        $this->data['region'] = $request->region;
                        $this->data['tagmenus'] = $tagsArr;
                        $this->data['pager'] = $this->injectPaginate();
                        $this->data['currentPage'] = $currentPage;
                        $this->data['uid'] = $uid;
                        $this->data['show'] = $show;
                        $this->data['group_id'] = \Session::get('gid');
                        $this->data['keyword'] = $keyword;
                        $this->data['ttlcount'] = count($propertiesArr);
                        return view($page, $this->data);
                    } else {
                        return Redirect::to('')
                                        ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
                    }
                } else {
                    return Redirect::to('')
                                    ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
                }
            } else {
                return Redirect::to('')
                                ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
            }

        else :
            $this->data['pageTitle'] = 'Home';
            $this->data['pageNote'] = 'Welcome To Our Site';
            $this->data['breadcrumb'] = 'inactive';
            $this->data['pageMetakey'] = CNF_METAKEY;
            $this->data['pageMetadesc'] = CNF_METADESC;

            $this->data['ads_home'] = \DB::table('tb_advertisement')->where('adv_status', 1)->get();

            $this->data['pages'] = 'pages.home';
            $page = 'layouts.' . CNF_THEME . '.index';
            return view($page, $this->data);
        endif;
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

    function downloadProduct($parent, $pro_name, Request $request) {
        if (CNF_FRONT == 'false' && $request->segment(1) == '') :
            return Redirect::to('dashboard');
        endif;

        $page = $request->segment(1);
        if ($page != '') :
            $content = \DB::table('tb_pages')->where('alias', '=', $page)->where('status', '=', 'enable')->get();
            //print_r($content); die;
            //return '';
            if ($pro_name != '' && $parent != '') {
                if (count($content) >= 1) {
                    $row = $content[0];
                    $this->data['pageTitle'] = $row->title;
                    $this->data['pageNote'] = $row->note;
                    $this->data['pageMetakey'] = ($row->metakey != '' ? $row->metakey : CNF_METAKEY);
                    $this->data['pageMetadesc'] = ($row->metadesc != '' ? $row->metadesc : CNF_METADESC);

                    $this->data['breadcrumb'] = 'active';

                    if ($row->access != '') {
                        $access = json_decode($row->access, true);
                    } else {
                        $access = array();
                    }

                    // If guest not allowed 
                    if ($row->allow_guest != 1) {
                        $group_id = \Session::get('gid');
                        $isValid = (isset($access[$group_id]) && $access[$group_id] == 1 ? 1 : 0 );
                        if ($isValid == 0) {
                            return Redirect::to('')->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_restric')));
                        }
                    }
                    if ($row->template == 'backend') {
                        $page = 'pages.' . $row->filename;
                    } else {
                        $page = 'layouts.' . CNF_THEME . '.index';
                    }
                    //print_r($this->data);exit;

                    $filename = base_path() . "/resources/views/pages/" . $row->filename . ".blade.php";
                    if (file_exists($filename)) {
                        $uid = 0;
                        if (\Auth::check() == true) {
                            $uid = \Auth::user()->id;
                        }
                        $this->data['pages'] = 'pages.' . $row->filename;
                        //	print_r($this->data);exit;
                        $this->data['social_links'] = \DB::table('tb_social')->where('status', 1)->get();
                        $this->data['footer_text'] = \DB::table('tb_settings')->where('key_value', 'footer_text')->first();

                        $default_front_design = \DB::table('tb_settings')->where('key_value', 'frontend_design')->first();

                        $act_parent = str_replace('-', ' ', $parent);
                        $act_name = str_replace('-', ' ', $pro_name);

                        $this->data['pageTitle'] = $act_name;

                        $fetch_main_parent = \DB::table('tb_container')->where('name', 'Produktgruppen')->first();
                        if (!empty($fetch_main_parent)) {
                            $fetch_parent = \DB::table('tb_container')->where('display_name', $act_parent)->where('parent_id', $fetch_main_parent->id)->first();
                            if (!empty($fetch_parent)) {
                                $fetch_product = \DB::table('tb_container')->where('display_name', $act_name)->where('parent_id', $fetch_parent->id)->first();
                                if (!empty($fetch_product)) {
                                    $fid = $fetch_product->id;
                                    $this->data['parentArr'] = array_reverse($this->fetchFolderParentListArray($fid));
                                    $this->data['mainfoldersrc'] = (new ContainerController)->getThumbpath($fid);

                                    $this->data['final_folders'] = array();
                                    $this->data['prtfoldersname'] = \DB::table('tb_container')->where('id', $fid)->first();
                                    $productgroup_folder = \DB::table('tb_container')->where('parent_id', $fid)->where('name', 'jpg')->first();
                                    //echo '<pre>';
                                    if (!empty($productgroup_folder)) {
                                        //print_r($productgroup_folder);
                                        $par_folder = $productgroup_folder->id;
                                        $parent_query = \DB::table('tb_container')->where('parent_id', $par_folder)->get();
                                        $this->data['enabled_parent_array'] = array();
                                        $temp_arr = array();
                                        $temp_arr[$par_folder]['data'] = $productgroup_folder;
                                        $temp_arr[$par_folder]['parents'] = $productgroup_folder->parent_id;

                                        $p_is_enabled = false;
                                        $enabled_cnt = \DB::table('tb_frontend_container')->where('container_id', $par_folder)->where('container_type', 'folder')->count();
                                        if ($enabled_cnt > 0) {
                                            $p_is_enabled = true;
                                        }

                                        $temp_arr[$par_folder]['is_enabled'] = $p_is_enabled;
                                        if (!empty($parent_query)) {

                                            foreach ($parent_query as $parent_obj) {
                                                $temp_array = array();
                                                $temp_array['data']['id'] = $parent_obj->id;
                                                $temp_array['data']['folder_id'] = $parent_obj->id;
                                                $temp_array['data']['name'] = $parent_obj->display_name;
                                                $temp_array['data']['file_type'] = 'folder';
                                                //$temp_array['data']['cover_img'] = $parent_obj->cover_img;
                                                $temp_array['data']['title'] = $parent_obj->title;
                                                $temp_array['data']['description'] = $parent_obj->description;
                                                $temp_array['data']['created'] = $parent_obj->created;
                                                $temp_array['data']['user_id'] = $parent_obj->user_id;
                                                $temp_array['data']['sort_num'] = $parent_obj->sort_num;
                                                $temp_array['data']['assign_lightbox'] = 'no';
                                                $temp_array['data']['imgsrc'] = '';
                                                $temp_array['data']['downloadhigh'] = 'no';
                                                $temp_array['data']['reserved'] = 'no';

                                                if ($parent_obj->cover_img == "") {
                                                    if (!empty($default_front_design) && $default_front_design->content == "masonry") {
                                                        $temp_array['data']['cover_img'] = $parent_obj->temp_cover_img_masonry;
                                                    } elseif (!empty($default_front_design) && $default_front_design->content == "grid") {
                                                        $temp_array['data']['cover_img'] = $parent_obj->temp_cover_img;
                                                    } else {
                                                        $temp_array['data']['cover_img'] = $parent_obj->cover_img;
                                                    }
                                                } else {
                                                    $temp_array['data']['cover_img'] = $parent_obj->cover_img;
                                                }

                                                //$temp_array['data'] = $parent_obj;
                                                $temp_array['parents'] = $productgroup_folder->parent_id . ',' . $parent_obj->parent_id;
                                                $is_enabled = false;
                                                $enabled_cnt = \DB::table('tb_frontend_container')->where('container_id', $parent_obj->id)->where('container_type', 'folder')->count();
                                                $enabled_file_cnt = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $parent_obj->id)->count();
                                                if (($enabled_cnt > 0) && ($enabled_file_cnt > 0)) {
                                                    $is_enabled = true;
                                                    $this->set_all_enabled_parent($temp_array['parents'] . ',' . $parent_obj->id);
                                                }
                                                $temp_array['is_enabled'] = $is_enabled;
                                                $child_cnt = \DB::table('tb_container')->where('parent_id', $parent_obj->id)->count();
                                                if ($child_cnt > 0) {
                                                    $temp_array['child'] = $this->get_all_child_folder($parent_obj->id, $temp_array['parents']);
                                                }


                                                $temp_arr[$par_folder]['child'][$parent_obj->id] = $temp_array;
                                            }
                                        }

                                        //$file_query = \DB::table('tb_container_files')->where('folder_id',$par_folder)->where(function ($query) { $query->where('file_type', 'image/jpeg')->orWhere('file_type', 'image/png')->orWhere('file_type', 'image/gif');})->get();
                                        $file_query = \DB::table('tb_container_files')->where('folder_id', $par_folder)->get();
                                        foreach ($file_query as $file_obj) {
                                            $extype = explode('/', $file_obj->file_type);
                                            $temp_array = array();
                                            $temp_array['data']['id'] = $file_obj->id;
                                            $temp_array['data']['folder_id'] = $file_obj->folder_id;
                                            $temp_array['data']['name'] = ($file_obj->file_display_name != '') ? $file_obj->file_display_name : $file_obj->file_name;
                                            $temp_array['data']['file_type'] = $extype[1];
                                            $temp_array['data']['cover_img'] = $file_obj->file_name;
                                            $temp_array['data']['title'] = $file_obj->file_title;
                                            $temp_array['data']['description'] = $file_obj->file_description;
                                            $temp_array['data']['created'] = $file_obj->created;
                                            $temp_array['data']['user_id'] = $file_obj->user_id;
                                            $temp_array['data']['sort_num'] = $file_obj->file_sort_num;
                                            $temp_array['data']['assign_lightbox'] = 'no';
                                            $temp_array['data']['imgsrc'] = (new ContainerController)->getThumbpath($file_obj->folder_id);
                                            $temp_array['data']['downloadhigh'] = 'no';
                                            $temp_array['data']['reserved'] = 'no';

                                            $frontend_lightbox = \DB::table('tb_frontend_lightbox')->where('container_id', $file_obj->id)->where('container_type', 'file')->first();
                                            if (!empty($frontend_lightbox)) {
                                                $temp_array['data']['assign_lightbox'] = 'yes';
                                            }
                                            $curdate = date('Y-m-d');
                                            $frontend_reserved = \DB::table('tb_order_items')->where('file_id', $file_obj->id)->where('reserve_till', '>=', $curdate)->first();
                                            if (!empty($frontend_reserved)) {
                                                $temp_array['data']['reserved'] = 'yes';
                                            }

                                            $png_folder = \DB::table('tb_container')->where('parent_id', $fid)->where('name', 'jpg-highres')->first();
                                            if (!empty($png_folder)) {
                                                $png_folder_files = \DB::table('tb_container_files')->where('folder_id', $png_folder->id)->where('file_name', $file_obj->file_name)->first();
                                                if (!empty($png_folder_files)) {
                                                    $temp_array['data']['downloadhigh'] = 'yes';
                                                }
                                            }

                                            if ($extype[0] == "image") {
                                                $dirPath = (new ContainerController)->getContainerUserPath($file_obj->folder_id);
                                                $copytofolder = public_path() . '/uploads/folder_cover_imgs/';
                                                if (!\File::exists($copytofolder . 'masonry_product_file_' . $file_obj->file_name)) {
                                                    // IMage for Product page
                                                    /* $pdimg = \Image::make($dirPath.$file_obj->file_name);
                                                      $pdimg->resize(305, 223);
                                                      $pdimgfile = 'product_file_'.$file_obj->file_name;
                                                      $pdimg->save($copytofolder.$pdimgfile); */

                                                    $mpimg = \Image::make($dirPath . $file_obj->file_name);
                                                    $mactualsize = getimagesize($dirPath . $file_obj->file_name);
                                                    if ($mactualsize[0] > $mactualsize[1]) {
                                                        $mpimg->resize(349, 228);
                                                    } else {
                                                        $mpimg->resize(349, 527);
                                                    }
                                                    $mpfile = 'masonry_product_file_' . $file_obj->file_name;
                                                    $mpimg->save($copytofolder . $mpfile);
                                                }
                                            }

                                            //$temp_array['data'] = $file_obj;
                                            $temp_array['parents'] = $productgroup_folder->parent_id . ',' . $file_obj->folder_id;
                                            $is_enabled = false;
                                            $enabled_cnt = \DB::table('tb_frontend_container')->where('container_id', $file_obj->id)->where('container_type', 'file')->count();
                                            if ($enabled_cnt > 0) {
                                                $is_enabled = true;
                                                $this->set_all_enabled_parent($temp_array['parents'] . ',i-' . $file_obj->id);
                                            }

                                            $temp_array['is_enabled'] = $is_enabled;


                                            $temp_arr[$par_folder]['child']['i-' . $file_obj->id] = $temp_array;
                                        }

                                        $this->data['final_folders'] = $this->set_parents_enables($temp_arr);
                                        //print_r($this->data['final_folders']);
                                    }

                                    $front_design = "grid";
                                    if (!empty($default_front_design) && $default_front_design->content != "") {
                                        $front_design = $default_front_design->content;
                                    }
                                    $this->data['default_front_design'] = $front_design;

                                    $pdffile = \DB::table('tb_container_files')->where('folder_id', $productgroup_folder->id)->where(function ($query) {
                                                $query->where('file_type', 'application/pdf')->orWhere('file_type', 'application/vnd.openxmlformats-officedocument.word');
                                            })->get();
                                    $this->data['filepdfsrc'] = (new ContainerController)->getThumbpath($productgroup_folder->id);
                                    if (!empty($pdffile)) {
                                        foreach ($pdffile as $pdfs) {
                                            $enabled_pdf = \DB::table('tb_frontend_container')->where('container_id', $pdfs->id)->where('container_type', 'file')->count();
                                            if ($enabled_pdf > 0) {
                                                $this->data['pdf_fileDetail'][] = $pdfs;
                                            }
                                        }
                                    }
                                    //print_r($this->data['pdf_fileDetail']);
                                }
                            }
                        }

                        $this->data['lightboxes'] = \DB::table('tb_lightbox')->where('user_id', $uid)->get();

                        $boxcontent = \DB::table('tb_lightbox_content')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_lightbox_content.file_id')->select('tb_lightbox_content.*', 'tb_container_files.file_name', 'tb_container_files.folder_id', 'tb_container_files.file_display_name', 'tb_container_files.file_title')->where('tb_lightbox_content.user_id', $uid)->get();
                        $boxcont = array();
                        if (!empty($boxcontent)) {
                            foreach ($boxcontent as $bcontent) {
                                $boxcont[$bcontent->lightbox_id][] = $bcontent;
                            }
                        }
                        $this->data['lightcontent'] = $boxcont;

                        return view($page, $this->data);
                    } else {
                        return Redirect::to('')
                                        ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
                    }
                } else {
                    return Redirect::to('')
                                    ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
                }
            } else {
                return Redirect::to('')
                                ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
            }

        else :
            $this->data['pageTitle'] = 'Home';
            $this->data['pageNote'] = 'Welcome To Our Site';
            $this->data['breadcrumb'] = 'inactive';
            $this->data['pageMetakey'] = CNF_METAKEY;
            $this->data['pageMetadesc'] = CNF_METADESC;

            $this->data['ads_home'] = \DB::table('tb_advertisement')->where('adv_status', 1)->get();

            $this->data['pages'] = 'pages.home';
            $page = 'layouts.' . CNF_THEME . '.index';
            return view($page, $this->data);
        endif;
    }

    function downloadZip($fid) {
        $downFileName = 'zip-' . date('d-m-Y') . '.zip';
        if (\File::exists(public_path() . '/uploads/zip/' . $downFileName)) {
            \File::delete(public_path() . '/uploads/zip/' . $downFileName);
        }

        $files = array();
        $checkfolder = \DB::table('tb_container')->where('parent_id', $fid)->where('name', 'jpg')->first();
        if (!empty($checkfolder)) {
            $fetchfiles = \DB::table('tb_container_files')->where('folder_id', $checkfolder->id)->get();
            if (!empty($fetchfiles)) {
                $filedirPath = (new ContainerController)->getContainerUserPath($checkfolder->id);
                foreach ($fetchfiles as $file) {
                    $files[] = $filedirPath . $file->file_name;
                }
            }
        }

        Zipper::make('uploads/zip/' . $downFileName)->add($files);

        $headers = array(
            'Content-Type' => 'application/octet-stream',
        );

        $dopath = Zipper::getFilePath();
        Zipper::close();
        // Download .zip file.
        return Redirect::away(\URL::to($dopath));
        //$response = \Response::download( public_path() . '/'.$dopath, $downFileName, $headers );
        //return $response;
    }

    public function show_service_detail($ser_id, Request $request) {

        if (CNF_FRONT == 'false' && $request->segment(1) == '') :
            return Redirect::to('dashboard');
        endif;

        $page = $request->segment(1);
        if ($page != '') :
            $content = \DB::table('tb_pages')->where('alias', '=', $page)->where('status', '=', 'enable')->get();
            //print_r($content); die;
            //return '';
            if ($ser_id != '' && $ser_id > 0) {
                if (count($content) >= 1) {

                    $row = $content[0];
                    $this->data['pageTitle'] = $row->title;
                    $this->data['pageNote'] = $row->note;
                    $this->data['pageMetakey'] = ($row->metakey != '' ? $row->metakey : CNF_METAKEY);
                    $this->data['pageMetadesc'] = ($row->metadesc != '' ? $row->metadesc : CNF_METADESC);

                    $this->data['breadcrumb'] = 'active';

                    if ($row->access != '') {
                        $access = json_decode($row->access, true);
                    } else {
                        $access = array();
                    }

                    // If guest not allowed 
                    if ($row->allow_guest != 1) {
                        $group_id = \Session::get('gid');
                        $isValid = (isset($access[$group_id]) && $access[$group_id] == 1 ? 1 : 0 );
                        if ($isValid == 0) {
                            return Redirect::to('')
                                            ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_restric')));
                        }
                    }
                    if ($row->template == 'backend') {
                        $page = 'pages.' . $row->filename;
                    } else {
                        $page = 'layouts.' . CNF_THEME . '.index';
                    }
                    //print_r($this->data);exit;

                    $filename = base_path() . "/resources/views/pages/" . $row->filename . ".blade.php";
                    if (file_exists($filename)) {
                        $this->data['pages'] = 'pages.' . $row->filename;
                        //	print_r($this->data);exit;
                        $this->data['social_links'] = \DB::table('tb_social')->where('status', 1)->get();
                        $this->data['footer_text'] = \DB::table('tb_settings')->where('key_value', 'footer_text')->first();

                        $this->data['service_detail'] = \DB::table('tb_services')->where('status', 1)->where('id', $ser_id)->first();

                        return view($page, $this->data);
                    } else {
                        return Redirect::to('')
                                        ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
                    }
                } else {
                    return Redirect::to('')
                                    ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
                }
            } else {
                return Redirect::to('')
                                ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
            }

        else :
            $this->data['pageTitle'] = 'Home';
            $this->data['pageNote'] = 'Welcome To Our Site';
            $this->data['breadcrumb'] = 'inactive';
            $this->data['pageMetakey'] = CNF_METAKEY;
            $this->data['pageMetadesc'] = CNF_METADESC;

            $this->data['ads_home'] = \DB::table('tb_advertisement')->where('adv_status', 1)->get();

            $this->data['pages'] = 'pages.home';
            $page = 'layouts.' . CNF_THEME . '.index';
            return view($page, $this->data);
        endif;
    }

    public function custompages(Request $request) {

        if (CNF_FRONT == 'false' && $request->segment(1) == '') :
            return Redirect::to('dashboard');
        endif;

        $page = $request->segment(1);
        if ($page != '') :
            $content = \DB::table('tb_frontend_pages')->where('page_slug', '=', $page)->where('page_status', 1)->first();
            //print_r($content); die;
            //return '';
            if (count($content) >= 1) {

                $row = $content;
                $this->data['pageTitle'] = $row->page_name;
                $this->data['pageNote'] = '';
                $this->data['pageMetakey'] = CNF_METAKEY;
                $this->data['pageMetadesc'] = CNF_METADESC;

                $this->data['breadcrumb'] = 'active';
                $page = 'layouts.' . CNF_THEME . '.index';

                $filename = base_path() . "/resources/views/pages/user_custom_pages.blade.php";
                if (file_exists($filename)) {
                    $this->data['pages'] = 'pages.user_custom_pages';
                    //	print_r($this->data);exit;
                    $this->data['social_links'] = \DB::table('tb_social')->where('status', 1)->get();
                    $this->data['footer_text'] = \DB::table('tb_settings')->where('key_value', 'footer_text')->first();

                    $this->data['page_content'] = $content;

                    return view($page, $this->data);
                } else {
                    return Redirect::to('')
                                    ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
                }
            } else {
                return Redirect::to('')
                                ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
            }
        else :
            $this->data['pageTitle'] = 'Home';
            $this->data['pageNote'] = 'Welcome To Our Site';
            $this->data['breadcrumb'] = 'inactive';
            $this->data['pageMetakey'] = CNF_METAKEY;
            $this->data['pageMetadesc'] = CNF_METADESC;

            $this->data['ads_home'] = \DB::table('tb_advertisement')->where('adv_status', 1)->get();

            $this->data['pages'] = 'pages.home';
            $page = 'layouts.' . CNF_THEME . '.index';
            return view($page, $this->data);
        endif;
    }

    public function save_contact_queries(Request $request) {
        $rules['vorname'] = 'required';
        $rules['nachname'] = 'required';
        $rules['postal_code'] = 'required';
        $rules['ort'] = 'required';
        $rules['email'] = 'required';
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {

            $data['vorname'] = $request->input('vorname');
            $data['nachname'] = $request->input('nachname');
            $data['firma'] = $request->input('firma');
            $data['address'] = $request->input('address');
            $data['postal_code'] = $request->input('postal_code');
            $data['ort'] = $request->input('ort');
            $data['land'] = $request->input('land');
            $data['telefon'] = $request->input('telefon');
            $data['fax'] = $request->input('fax');
            $data['email'] = $request->input('email');
            $data['nachricht'] = $request->input('nachricht');
            /* if(!empty($request->input('kontaktieren')))
              {
              $data['kontaktieren'] = implode(',',$request->input('kontaktieren'));
              } */
            $data['created'] = date('Y-m-d h:i:s');
            \DB::table('tb_contact_queries')->insertGetId($data);

            return Redirect::to('contact-us')->with('messagetext', \Lang::get('core.note_success'))->with('msgstatus', 'success');
        } else {
            return Redirect::to('contact-us')->with('messagetext', \Lang::get('core.note_error'))->with('msgstatus', 'error')
                            ->withErrors($validator)->withInput();
        }
    }

    public function show_designer_detail($des_name, Request $request) {

        if (CNF_FRONT == 'false' && $request->segment(1) == '') :
            return Redirect::to('dashboard');
        endif;

        $page = $request->segment(1);
        if ($page != '') :
            $content = \DB::table('tb_pages')->where('alias', '=', $page)->where('status', '=', 'enable')->get();
            //print_r($content); die;
            //return '';
            if ($des_name != '') {
                if (count($content) >= 1) {

                    $row = $content[0];
                    $this->data['pageTitle'] = $row->title;
                    $this->data['pageNote'] = $row->note;
                    $this->data['pageMetakey'] = ($row->metakey != '' ? $row->metakey : CNF_METAKEY);
                    $this->data['pageMetadesc'] = ($row->metadesc != '' ? $row->metadesc : CNF_METADESC);

                    $this->data['breadcrumb'] = 'active';

                    if ($row->access != '') {
                        $access = json_decode($row->access, true);
                    } else {
                        $access = array();
                    }

                    // If guest not allowed 
                    if ($row->allow_guest != 1) {
                        $group_id = \Session::get('gid');
                        $isValid = (isset($access[$group_id]) && $access[$group_id] == 1 ? 1 : 0 );
                        if ($isValid == 0) {
                            return Redirect::to('')
                                            ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_restric')));
                        }
                    }
                    if ($row->template == 'backend') {
                        $page = 'pages.' . $row->filename;
                    } else {
                        $page = 'layouts.' . CNF_THEME . '.index';
                    }
                    //print_r($this->data);exit;

                    $filename = base_path() . "/resources/views/pages/" . $row->filename . ".blade.php";
                    if (file_exists($filename)) {
                        $this->data['pages'] = 'pages.' . $row->filename;
                        //	print_r($this->data);exit;
                        $this->data['social_links'] = \DB::table('tb_social')->where('status', 1)->get();
                        $this->data['footer_text'] = \DB::table('tb_settings')->where('key_value', 'footer_text')->first();

                        $act_name = str_replace('-', ' ', $des_name);
                        $maindesigner = \DB::table('tb_designers')->where('designer_status', 1)->where('designer_name', $act_name)->first();

                        $this->data['pageTitle'] = $maindesigner->designer_name;

                        $this->data['designer'] = $maindesigner;

                        $productAttrArr = array();
                        //print "<pre>";
                        $assignfolders = \DB::table('tb_container_designers')->where('designer_id', $maindesigner->id)->where('container_type', 'folder')->get();
                        if (!empty($assignfolders)) {
                            foreach ($assignfolders as $singlefolder) {
                                $variant_images = \DB::table('tb_container_files')->where('folder_id', $singlefolder->container_id)->where(function ($query) {
                                            $query->where('file_type', 'image/jpeg')->orWhere('file_type', 'image/png')->orWhere('file_type', 'image/gif');
                                        })->orderBy('file_sort_num', 'asc')->first();

                                if (!empty($variant_images)) {
                                    $productAttrArr[$variant_images->id]['productparentArr'] = array_reverse($this->fetchFolderParentListArray($variant_images->folder_id));

                                    $productAttrArr[$variant_images->id]['productfile'] = $variant_images;
                                    $checkattr = \DB::table('tb_container_attributes')->where('container_id', $variant_images->folder_id)->where('container_type', 'folder')->get();
                                    if (!empty($checkattr)) {
                                        $a = 0;
                                        foreach ($checkattr as $fetchattr) {
                                            $cat = \DB::table('tb_attributes')->where('id', $fetchattr->attr_id)->first();
                                            if (!empty($cat)) {
                                                $productAttrArr[$variant_images->id]['productAttr'][$cat->attr_cat][$a]['AttrType'] = $fetchattr->attr_type;
                                                $productAttrArr[$variant_images->id]['productAttr'][$cat->attr_cat][$a]['Attrs'] = $cat;
                                                if ($fetchattr->attr_type == "checkboxes" || $fetchattr->attr_type == "dropdown" || $fetchattr->attr_type == "radio") {
                                                    $expAttrval = explode(',', $fetchattr->attr_value);
                                                    $productAttrArr[$variant_images->id]['productAttr'][$cat->attr_cat][$a]['AttrVal'] = \DB::table('tb_attributes_options')->whereIn('id', $expAttrval)->get();
                                                } else {
                                                    $productAttrArr[$variant_images->id]['productAttr'][$cat->attr_cat][$a]['AttrVal'] = $fetchattr->attr_value;
                                                }
                                                $a++;
                                            }
                                        }
                                    }
                                }
                            }
                        }

                        //print_r($productAttrArr);
                        $this->data['productAttrArr'] = $productAttrArr;

                        return view($page, $this->data);
                    } else {
                        return Redirect::to('')
                                        ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
                    }
                } else {
                    return Redirect::to('')
                                    ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
                }
            } else {
                return Redirect::to('')
                                ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
            }

        else :
            $this->data['pageTitle'] = 'Home';
            $this->data['pageNote'] = 'Welcome To Our Site';
            $this->data['breadcrumb'] = 'inactive';
            $this->data['pageMetakey'] = CNF_METAKEY;
            $this->data['pageMetadesc'] = CNF_METADESC;

            $this->data['ads_home'] = \DB::table('tb_advertisement')->where('adv_status', 1)->get();

            $this->data['pages'] = 'pages.home';
            $page = 'layouts.' . CNF_THEME . '.index';
            return view($page, $this->data);
        endif;
    }

    function subMaterialsPage($fid, Request $request) {
        if (CNF_FRONT == 'false' && $request->segment(1) == '') :
            return Redirect::to('dashboard');
        endif;

        //$page = $request->segment(1);
        $page = 'submaterials';
        if ($page != '') :
            $content = \DB::table('tb_pages')->where('alias', '=', $page)->where('status', '=', 'enable')->get();
            //print_r($content); die;
            //return '';
            if ($fid != '' && $fid > 0) {
                if (count($content) >= 1) {
                    $row = $content[0];
                    $this->data['pageTitle'] = $row->title;
                    $this->data['pageNote'] = $row->note;
                    $this->data['pageMetakey'] = ($row->metakey != '' ? $row->metakey : CNF_METAKEY);
                    $this->data['pageMetadesc'] = ($row->metadesc != '' ? $row->metadesc : CNF_METADESC);

                    $this->data['breadcrumb'] = 'active';

                    if ($row->access != '') {
                        $access = json_decode($row->access, true);
                    } else {
                        $access = array();
                    }

                    // If guest not allowed 
                    if ($row->allow_guest != 1) {
                        $group_id = \Session::get('gid');
                        $isValid = (isset($access[$group_id]) && $access[$group_id] == 1 ? 1 : 0 );
                        if ($isValid == 0) {
                            return Redirect::to('')
                                            ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_restric')));
                        }
                    }
                    if ($row->template == 'backend') {
                        $page = 'pages.' . $row->filename;
                    } else {
                        $page = 'layouts.' . CNF_THEME . '.index';
                    }
                    //print_r($this->data);exit;

                    $filename = base_path() . "/resources/views/pages/" . $row->filename . ".blade.php";
                    if (file_exists($filename)) {
                        $this->data['pages'] = 'pages.' . $row->filename;
                        //	print_r($this->data);exit;
                        $this->data['social_links'] = \DB::table('tb_social')->where('status', 1)->get();
                        $this->data['footer_text'] = \DB::table('tb_settings')->where('key_value', 'footer_text')->first();
                        $this->data['parentArr'] = array_reverse($this->fetchFolderParentListArray($fid));

                        $default_front_design = \DB::table('tb_settings')->where('key_value', 'frontend_design')->first();
                        $this->data['final_material_folders'] = array();
                        $cur_folder = \DB::table('tb_container')->where('id', $fid)->first();
                        $this->data['current_material_folder'] = $cur_folder->name;
                        $productgroup_folder = \DB::table('tb_container')->where('name', $cur_folder->name)->first();
                        //echo '<pre>';
                        if (!empty($productgroup_folder)) {
                            //print_r($productgroup_folder);
                            $this->data['pageTitle'] = $productgroup_folder->display_name;
                            $par_folder = $productgroup_folder->id;
                            $parent_query = \DB::table('tb_container')->where('parent_id', $par_folder)->get();
                            $this->data['enabled_parent_array'] = array();
                            $temp_arr = array();
                            $temp_arr[$par_folder]['data'] = $productgroup_folder;
                            $temp_arr[$par_folder]['parents'] = $productgroup_folder->parent_id;

                            $p_is_enabled = false;
                            $enabled_cnt = \DB::table('tb_frontend_container')->where('container_id', $par_folder)->where('container_type', 'folder')->count();
                            if ($enabled_cnt > 0) {
                                $p_is_enabled = true;
                            }

                            $temp_arr[$par_folder]['is_enabled'] = $p_is_enabled;
                            if (!empty($parent_query)) {

                                foreach ($parent_query as $parent_obj) {
                                    $temp_array = array();
                                    $temp_array['data']['id'] = $parent_obj->id;
                                    $temp_array['data']['folder_id'] = $parent_obj->id;
                                    $temp_array['data']['name'] = (\Session::get('newlang') == 'English') ? $parent_obj->display_name_eng : $parent_obj->display_name;
                                    $temp_array['data']['file_type'] = 'folder';
                                    //$temp_array['data']['cover_img'] = $parent_obj->cover_img;
                                    $temp_array['data']['title'] = (\Session::get('newlang') == 'English') ? $parent_obj->title_eng : $parent_obj->title;
                                    $temp_array['data']['description'] = (\Session::get('newlang') == 'English') ? $parent_obj->description_eng : $parent_obj->description;
                                    $temp_array['data']['created'] = $parent_obj->created;
                                    $temp_array['data']['user_id'] = $parent_obj->user_id;
                                    $temp_array['data']['sort_num'] = $parent_obj->sort_num;
                                    $temp_array['data']['designer'] = array();

                                    $check_designer = \DB::table('tb_container_designers')->join('tb_designers', 'tb_designers.id', '=', 'tb_container_designers.designer_id')->where('tb_container_designers.container_id', $parent_obj->id)->where('tb_container_designers.container_type', 'folder')->first();
                                    if (!empty($check_designer)) {
                                        $temp_array['data']['designer'] = $check_designer;
                                    }

                                    if ($parent_obj->cover_img == "") {
                                        if (!empty($default_front_design) && $default_front_design->content == "masonry") {
                                            $temp_array['data']['cover_img'] = $parent_obj->temp_cover_img_masonry;
                                        } elseif (!empty($default_front_design) && $default_front_design->content == "grid") {
                                            $temp_array['data']['cover_img'] = $parent_obj->temp_cover_img;
                                        } else {
                                            $temp_array['data']['cover_img'] = $parent_obj->cover_img;
                                        }
                                    } else {
                                        $temp_array['data']['cover_img'] = $parent_obj->cover_img;
                                    }

                                    //$temp_array['data'] = $parent_obj;
                                    $temp_array['parents'] = $productgroup_folder->parent_id . ',' . $parent_obj->parent_id;
                                    $is_enabled = false;
                                    $enabled_cnt = \DB::table('tb_frontend_container')->where('container_id', $parent_obj->id)->where('container_type', 'folder')->count();
                                    $enabled_file_cnt = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $parent_obj->id)->count();
                                    if (($enabled_cnt > 0) && ($enabled_file_cnt > 0)) {
                                        $is_enabled = true;
                                        $this->set_all_enabled_parent($temp_array['parents'] . ',' . $parent_obj->id);
                                    }
                                    $temp_array['is_enabled'] = $is_enabled;
                                    $child_cnt = \DB::table('tb_container')->where('parent_id', $parent_obj->id)->count();
                                    if ($child_cnt > 0) {
                                        $temp_array['child'] = $this->get_all_child_folder($parent_obj->id, $temp_array['parents']);
                                    }

                                    $temp_arr[$par_folder]['child'][$parent_obj->id] = $temp_array;

                                    $file_query = \DB::table('tb_container_files')->where('folder_id', $parent_obj->id)->get();
                                    foreach ($file_query as $file_obj) {
                                        $temp_array = array();
                                        $extype = explode('/', $file_obj->file_type);
                                        if ($extype[0] == "image") {
                                            $enabled_cntfile = \DB::table('tb_frontend_container')->where('container_id', $file_obj->id)->where('container_type', 'file')->count();
                                            if ($enabled_cntfile > 0) {
                                                $temp_array['data']['id'] = $file_obj->id;
                                                $temp_array['data']['folder_id'] = $file_obj->folder_id;
                                                $temp_array['data']['name'] = (\Session::get('newlang') == 'English') ? ($file_obj->file_display_name_eng != '') ? $file_obj->file_display_name_eng : $file_obj->file_name : ($file_obj->file_display_name != '') ? $file_obj->file_display_name : $file_obj->file_name;
                                                $temp_array['data']['file_type'] = 'file';
                                                $temp_array['data']['cover_img'] = $file_obj->file_name;
                                                $temp_array['data']['title'] = (\Session::get('newlang') == 'English') ? $file_obj->file_title_eng : $file_obj->file_title;
                                                $temp_array['data']['description'] = (\Session::get('newlang') == 'English') ? $file_obj->file_description_eng : $file_obj->file_description;
                                                $temp_array['data']['created'] = $file_obj->created;
                                                $temp_array['data']['user_id'] = $file_obj->user_id;
                                                $temp_array['data']['sort_num'] = $file_obj->file_sort_num;
                                                $temp_array['data']['designer'] = array();

                                                $dirPath = (new ContainerController)->getContainerUserPath($file_obj->folder_id);
                                                $copytofolder = public_path() . '/uploads/folder_cover_imgs/';
                                                if (!\File::exists($copytofolder . 'masonry_product_file_' . $file_obj->file_name)) {
                                                    // IMage for Product page
                                                    /* $pdimg = \Image::make($dirPath.$file_obj->file_name);
                                                      $pdimg->resize(305, 223);
                                                      $pdimgfile = 'product_file_'.$file_obj->file_name;
                                                      $pdimg->save($copytofolder.$pdimgfile); */

                                                    $mpimg = \Image::make($dirPath . $file_obj->file_name);
                                                    $mactualsize = getimagesize($dirPath . $file_obj->file_name);
                                                    if ($mactualsize[0] > $mactualsize[1]) {
                                                        $mpimg->resize(349, 228);
                                                    } else {
                                                        $mpimg->resize(349, 527);
                                                    }
                                                    $mpfile = 'masonry_product_file_' . $file_obj->file_name;
                                                    $mpimg->save($copytofolder . $mpfile);
                                                }

                                                //$temp_array['data'] = $file_obj;
                                                $temp_array['parents'] = $productgroup_folder->parent_id . ',' . $file_obj->folder_id;
                                                $is_enabled = false;
                                                $enabled_cnt = \DB::table('tb_frontend_container')->where('container_id', $file_obj->id)->where('container_type', 'file')->count();
                                                if ($enabled_cnt > 0) {
                                                    $is_enabled = true;
                                                    $this->set_all_enabled_parent($temp_array['parents'] . ',i-' . $file_obj->id);
                                                }

                                                $temp_array['is_enabled'] = $is_enabled;


                                                //$temp_arr[$par_folder]['child']['i-'.$file_obj->id] = $temp_array;
                                                $temp_arr[$par_folder]['child'][$parent_obj->id]['subchild'][$file_obj->id] = $temp_array;
                                            }
                                        }
                                    }
                                }
                            }

                            $file_query = \DB::table('tb_container_files')->where('folder_id', $par_folder)->get();
                            foreach ($file_query as $file_obj) {
                                $temp_array = array();
                                $extype = explode('/', $file_obj->file_type);
                                if ($extype[0] == "image") {
                                    $temp_array['data']['id'] = $file_obj->id;
                                    $temp_array['data']['folder_id'] = $file_obj->folder_id;
                                    $temp_array['data']['name'] = (\Session::get('newlang') == 'English') ? ($file_obj->file_display_name_eng != '') ? $file_obj->file_display_name_eng : $file_obj->file_name : ($file_obj->file_display_name != '') ? $file_obj->file_display_name : $file_obj->file_name;
                                    $temp_array['data']['file_type'] = 'file';
                                    $temp_array['data']['cover_img'] = $file_obj->file_name;
                                    $temp_array['data']['title'] = (\Session::get('newlang') == 'English') ? $file_obj->file_title_eng : $file_obj->file_title;
                                    $temp_array['data']['description'] = (\Session::get('newlang') == 'English') ? $file_obj->file_description_eng : $file_obj->file_description;
                                    $temp_array['data']['created'] = $file_obj->created;
                                    $temp_array['data']['user_id'] = $file_obj->user_id;
                                    $temp_array['data']['sort_num'] = $file_obj->file_sort_num;
                                    $temp_array['data']['designer'] = array();

                                    $dirPath = (new ContainerController)->getContainerUserPath($file_obj->folder_id);
                                    $copytofolder = public_path() . '/uploads/folder_cover_imgs/';
                                    if (!\File::exists($copytofolder . 'masonry_product_file_' . $file_obj->file_name)) {
                                        // IMage for Product page
                                        /* $pdimg = \Image::make($dirPath.$file_obj->file_name);
                                          $pdimg->resize(305, 223);
                                          $pdimgfile = 'product_file_'.$file_obj->file_name;
                                          $pdimg->save($copytofolder.$pdimgfile); */

                                        $mpimg = \Image::make($dirPath . $file_obj->file_name);
                                        $mactualsize = getimagesize($dirPath . $file_obj->file_name);
                                        if ($mactualsize[0] > $mactualsize[1]) {
                                            $mpimg->resize(349, 228);
                                        } else {
                                            $mpimg->resize(349, 527);
                                        }
                                        $mpfile = 'masonry_product_file_' . $file_obj->file_name;
                                        $mpimg->save($copytofolder . $mpfile);
                                    }
                                }
                                //$temp_array['data'] = $file_obj;
                                $temp_array['parents'] = $productgroup_folder->parent_id . ',' . $file_obj->folder_id;
                                $is_enabled = false;
                                $enabled_cnt = \DB::table('tb_frontend_container')->where('container_id', $file_obj->id)->where('container_type', 'file')->count();
                                if ($enabled_cnt > 0) {
                                    $is_enabled = true;
                                    $this->set_all_enabled_parent($temp_array['parents'] . ',i-' . $file_obj->id);
                                }

                                $temp_array['is_enabled'] = $is_enabled;


                                $temp_arr[$par_folder]['child']['i-' . $file_obj->id] = $temp_array;
                            }

                            $this->data['final_material_folders'] = $this->set_parents_enables($temp_arr);
                            //print_r($this->data['final_material_folders']);
                        }

                        //print "<pre>";
                        //print_r($this->data['final_material_folders']);

                        $front_design = "grid";
                        if (!empty($default_front_design) && $default_front_design->content != "") {
                            $front_design = $default_front_design->content;
                        }
                        $this->data['default_front_design'] = $front_design;

                        $this->data['parentsfolders'] = array();
                        $productgroup_folder = \DB::table('tb_container')->where('name', 'Produktgruppen')->first();
                        if (!empty($productgroup_folder)) {
                            $par_folder = $productgroup_folder->id;
                            $mainparent_query = \DB::table('tb_container')->where('parent_id', $par_folder)->get();
                            $this->data['enabled_parent_array'] = array();
                            if (!empty($mainparent_query)) {
                                //echo '<pre>';
                                $parent_temp_arr = array();
                                foreach ($mainparent_query as $parent_obj) {
                                    $parent_temp_array = array();
                                    $parent_temp_array['data'] = $parent_obj;
                                    $parent_temp_array['parents'] = $parent_obj->parent_id;
                                    $is_enabled = false;
                                    $enabled_cnt = \DB::table('tb_frontend_container')->where('container_id', $parent_obj->id)->where('container_type', 'folder')->count();
                                    $enabled_file_cnt = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $parent_obj->id)->count();
                                    if (($enabled_cnt > 0) && ($enabled_file_cnt > 0)) {
                                        $is_enabled = true;
                                        $this->set_all_enabled_parent($parent_temp_array['parents'] . ',' . $parent_obj->id);
                                    }
                                    $parent_temp_array['is_enabled'] = $is_enabled;
                                    $child_cnt = \DB::table('tb_container')->where('parent_id', $parent_obj->id)->count();
                                    if ($child_cnt > 0) {
                                        $parent_temp_array['child'] = $this->get_all_child_folder($parent_obj->id, $parent_temp_array['parents']);
                                    }


                                    $parent_temp_arr[$parent_obj->id] = $parent_temp_array;
                                }

                                $this->data['parentsfolders'] = $this->set_parents_enables($parent_temp_arr);
                                //print_r($this->data['parentsfolders']);
                            }
                        }

                        return view($page, $this->data);
                    } else {
                        return Redirect::to('')
                                        ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
                    }
                } else {
                    return Redirect::to('')
                                    ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
                }
            } else {
                return Redirect::to('')
                                ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
            }

        else :
            $this->data['pageTitle'] = 'Home';
            $this->data['pageNote'] = 'Welcome To Our Site';
            $this->data['breadcrumb'] = 'inactive';
            $this->data['pageMetakey'] = CNF_METAKEY;
            $this->data['pageMetadesc'] = CNF_METADESC;

            $this->data['ads_home'] = \DB::table('tb_advertisement')->where('adv_status', 1)->get();

            $this->data['pages'] = 'pages.home';
            $page = 'layouts.' . CNF_THEME . '.index';
            return view($page, $this->data);
        endif;
    }

    public function create_newlightbox(Request $request) {
        $rep = array();
        if (\Auth::check() == true) {
            $l = 1;
            $uid = \Auth::user()->id;
            $check_light = \DB::table('tb_lightbox')->where('user_id', $uid)->count();
            if ($check_light > 0) {
                $l = $check_light + 1;
            }
            $newlight['box_name'] = 'Lightbox ' . $l;
            $newlight['user_id'] = $uid;
            $newlight['created'] = date('Y-m-d h:i:s');
            $light_id = \DB::table('tb_lightbox')->insertGetId($newlight);

            $fetch_light = \DB::table('tb_lightbox')->where('id', $light_id)->first();
            $rep['status'] = 'success';
            $rep['lightbox'] = $fetch_light;
            return json_encode($rep);
        } else {
            $rep['status'] = 'error';
            $rep['errors'] = 'please login';
            return json_encode($rep);
        }
    }

    public function lightboxdelete(Request $request) {
        $lid = $request->input('lightboxId');
        if ($lid != "" && $lid > 0) {
            $check_light = \DB::table('tb_lightbox')->where('id', $lid)->count();
            if ($check_light > 0) {
                $del_lightbox = \DB::table('tb_lightbox')->where('id', $lid)->delete();
                $del_lightbox_imgs = \DB::table('tb_lightbox_content')->where('lightbox_id', $lid)->delete();
                if ($del_lightbox) {
                    return 'success';
                }
            } else {
                return 'error';
            }
        } else {
            return 'error';
        }
    }

    public function lightboxupdatename(Request $request) {
        $lid = $request->input('lightboxId');
        $lname = $request->input('newname');
        if ($lid != "" && $lid > 0 && $lname != '') {
            $check_light = \DB::table('tb_lightbox')->where('id', $lid)->count();
            if ($check_light > 0) {
                $update_lightbox = \DB::table('tb_lightbox')->where('id', $lid)->update(["box_name" => $lname]);
                if ($update_lightbox) {
                    return 'success';
                }
            } else {
                return 'error';
            }
        } else {
            return 'error';
        }
    }

    public function lightboxAddcontents(Request $request) {
        $rep = array();
        $lid = $request->input('lightboxId');
        $lfile = $request->input('fileId');
        $lpeopid = $request->input('propId');
        if (\Auth::check() == true) {
            $l = 1;
            $uid = \Auth::user()->id;
            $check_light = \DB::table('tb_lightbox')->where('id', $lid)->count();
            if ($check_light > 0) {
                $fetch_items = \DB::table('tb_lightbox_content')->where('user_id', $uid)->where('lightbox_id', $lid)->where('file_id', $lfile)->count();
                if ($fetch_items == 0) {
                    $lightcontent['lightbox_id'] = $lid;
                    $lightcontent['file_id'] = $lfile;
                    $lightcontent['user_id'] = $uid;
                    $lightcontent['created'] = date('Y-m-d h:i:s');
                    $content_id = \DB::table('tb_lightbox_content')->insertGetId($lightcontent);

                    $fetch_lightcontent = \DB::table('tb_lightbox_content')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_lightbox_content.file_id')->select('tb_lightbox_content.*', 'tb_container_files.file_name', 'tb_container_files.folder_id', 'tb_container_files.file_display_name', 'tb_container_files.file_title')->where('tb_lightbox_content.id', $content_id)->first();

                    $fetch_prop = \DB::table('tb_properties')->where('id', $lpeopid)->first();

                    $rep['status'] = 'success';
                    $rep['lightboxcontent'] = $fetch_lightcontent;
                    $rep['propert'] = $fetch_prop;
                    return json_encode($rep);
                } else {
                    $rep['status'] = 'already';
                    return json_encode($rep);
                }
            } else {
                $rep['status'] = 'error';
                $rep['errors'] = 'Merkzettel not found';
                return json_encode($rep);
            }
        } else {
            $rep['status'] = 'error';
            $rep['errors'] = 'please login first.';
            return json_encode($rep);
        }
    }

    public function lightbox_content_delete(Request $request) {
        $cid = $request->input('contentId');
        if ($cid != "" && $cid > 0) {
            $check_lightcontent = \DB::table('tb_lightbox_content')->where('id', $cid)->count();
            if ($check_lightcontent > 0) {
                $del_lightbox_imgs = \DB::table('tb_lightbox_content')->where('id', $cid)->delete();
                if ($del_lightbox_imgs) {
                    return 'success';
                }
            } else {
                return 'error';
            }
        } else {
            return 'error';
        }
    }

    public function lightbox_content_downloadpdf(Request $request, $cid) {
        $downFileName = 'lightbox-' . date('d-m-Y') . '.pdf';
        //$cid = $request->input('contentId');
        if ($cid != "" && $cid > 0) {
            $check_lightcontent = \DB::table('tb_lightbox')->where('id', $cid)->count();
            if ($check_lightcontent > 0) {
                $fetch_lightcontent = \DB::table('tb_lightbox_content')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_lightbox_content.file_id')->select('tb_lightbox_content.*', 'tb_container_files.file_name', 'tb_container_files.folder_id', 'tb_container_files.file_display_name')->where('tb_lightbox_content.lightbox_id', $cid)->get();
                if (!empty($fetch_lightcontent)) {
                    $html = '<style>.page-break { page-break-after: always; } .header,.footer {width: 100%; position:fixed;}.header {top: -50px;}.footer {bottom: 150px;}.pagenum:after {content: counter(page);}.imgBox {	border:1px solid #000;padding:20px; text-align:center; width:520px; margin:0 auto;} .header img { height:150px; width:700px; } .footer img { height:250px; width:700px; } .Mrgtop20 {margin-top:20px;} .content{ margin-top:80px; } </style>';

                    foreach ($fetch_lightcontent as $boxcontent) {
                        $allfile = \DB::table('tb_container_files')->where('folder_id', $boxcontent->folder_id)->get();
                        if (!empty($allfile)) {
                            $folderInfo = \DB::table('tb_container')->where('id', $boxcontent->folder_id)->first();

                            $folderparInfo = \DB::table('tb_container')->where('id', $folderInfo->parent_id)->first();

                            $html .= '<div class="header"><img src="' . public_path() . '/sximo/images/number7even-header.jpg"><br><span class="Mrgtop20">Property: ' . $folderparInfo->display_name . '</span></div><br><br><br><div class="footer"><img src="' . public_path() . '/sximo/images/number7even-footer.jpg"><br><span class="pagenum">Page </span></div>';
                            $filedirPath = (new ContainerController)->getContainerUserPath($boxcontent->folder_id);
                            $i = 1;
                            $html .='<div class="content">';
                            foreach ($allfile as $alfiles) {
                                $html .='<div class="imgBox"><img src="' . $filedirPath . $alfiles->file_name . '" style="width:500px; height:300px;"></div><p style="text-align:center;">' . $alfiles->file_display_name . '</p><br>';
                                if (($i % 2) == 0 && end($allfile) != $alfiles) {
                                    $html .='</div><div class="page-break"></div><div class="content" style="margin-top:120px;">';
                                }
                                $i++;
                            }
                            $html .='</div>';
                        }
                    }
                    //echo $html; die;
                    $pdf = \App::make('dompdf.wrapper');
                    $pdf->loadHTML($html);
                    return $pdf->download($downFileName);
                }
            } else {
                return 'error';
            }
        } else {
            return 'error';
        }
    }

    function SendEmailLightbox(Request $request) {
        $items = Input::get('selecteditems');
        if ($items != '') {
            if ($request->input('emailids') != '') {
                $comsep = \DB::table('tb_lightbox_content')->where('lightbox_id', $items)->get();
                $fimgs = array();
                if (!empty($comsep)) {
                    foreach ($comsep as $sepr) {
                        $fimgs[] = $sepr->file_id;
                    }
                }

                if (!empty($fimgs)) {
                    //$msg = preg_replace('/[^A-Za-z0-9!@#$%^&*()<>]/u','', $request->input('message'));
                    $msg = $request->input('message');
                    $linkConvertmsg = $msg;
                    $fltype = 'high';
                    $etype = $request->input('emailType');
                    $fltype = $request->input('flipType');
                    $uniq = md5(uniqid(rand(), true));
                    $fdata['img_ids'] = implode(',', $fimgs);
                    $fdata['unique_code'] = $uniq;
                    $fdata['flip_type'] = $fltype;
                    \DB::table('tb_flipbooks')->insert($fdata);

                    foreach ($etype as $Type) {
                        if ($Type == 'flipbook') {
                            $linkConvertmsg .= ' <br> Als Flipbook ansehen <a href="' . \URL::to('getflipbook/' . $uniq) . '">hier klicken</a>';
                            $share_type = 'Flipbook';
                            $share_url = \URL::to('getflipbook/' . $uniq);
                        }

                        if ($Type == 'slideshow') {
                            $linkConvertmsg .= ' <br> Als Slideshow ansehen <a href="' . \URL::to('getslideshow/' . $uniq) . '">hier klicken</a>';
                            $share_type = 'Slideshow';
                            $share_url = \URL::to('getslideshow/' . $uniq);
                        }

                        if ($Type == 'download') {
                            $exp_type = explode('-', $request->input('downType'));
                            if ($exp_type[0] == "zip") {
                                $downFileName = 'zip-' . date('d-m-Y-h-i-s') . '.zip';
                                foreach ($fimgs as $files) {
                                    $file = \DB::table('tb_container_files')->where('id', $files)->first();
                                    if (!empty($file)) {
                                        $allfile = \DB::table('tb_container_files')->where('folder_id', $file->folder_id)->get();
                                        if (!empty($allfile)) {
                                            $filedirPath = (new ContainerController)->getContainerUserPath($file->folder_id);
                                            foreach ($allfile as $alfiles) {
                                                $imgfiles[] = $filedirPath . $alfiles->file_name;
                                            }
                                        }
                                    }
                                }
                                Zipper::make('uploads/zip/' . $downFileName)->add($imgfiles);
                                $dopath = Zipper::getFilePath();
                                Zipper::close();
                                $linkConvertmsg .= ' <br> Please click <a href="' . \URL::to($dopath) . '">here</a>';
                                $share_type = 'Download as Zip';
                                $share_url = \URL::to($dopath);
                                $patOFile = public_path() . '/uploads/zip/' . $downFileName;
                            } elseif ($exp_type[0] == "pdf") {
                                if ($exp_type[1] == "high") {
                                    $width = '580';
                                    $maxwidth = '540';
                                } elseif ($exp_type[1] == "low") {
                                    $width = '350';
                                    $maxwidth = '300';
                                }
                                $downFileName = 'download-' . date('d-m-Y-h-i-s') . '.pdf';

                                $i = 0;
                                $countArr = count($comsep);

                                foreach ($comsep as $sepr) {
                                    $i++;
                                    $file = \DB::table('tb_container_files')->where('id', $sepr->file_id)->first();
                                    $fold_id = $file->folder_id;
                                    if (!empty($file)) {
                                        $htmltemp = '';
                                        $allfile = \DB::table('tb_container_files')->where('folder_id', $file->folder_id)->get();
                                        if (!empty($allfile)) {
                                            $filedirPath = (new ContainerController)->getContainerUserPath($file->folder_id);
                                            $htmltemp .='<div class="content">';
                                            foreach ($allfile as $alfiles) {
                                                $htmltemp .='<div class="imgBox"><img src="' . $filedirPath . $alfiles->file_name . '" style="width:500px; height:300px;"></div><p style="text-align:center;">' . $alfiles->file_name . '</p><br>';
                                                if ($i < $countArr) {
                                                    $htmltemp .='</div><div class="page-break"></div><div class="content" style="margin-top:120px;">';
                                                }
                                            }
                                            $htmltemp .='</div>';
                                        }
                                    }
                                }

                                $folderInfo = \DB::table('tb_container')->where('id', $fold_id)->first();

                                $folderparInfo = \DB::table('tb_container')->where('id', $folderInfo->parent_id)->first();

                                $html = '<style>.page-break { page-break-after: always; } .header,.footer {width: 100%; position:fixed;}.header {top: -50px;}.footer {bottom: 150px;}.pagenum:after {content: counter(page);}.imgBox {	border:1px solid #000;padding:20px; text-align:center; width:520px; margin:0 auto;} .header img { height:150px; width:700px; } .footer img { height:250px; width:700px; } .Mrgtop20 {margin-top:20px;} .content{ margin-top:80px; } </style>';

                                $html .= '<div class="header"><img src="' . public_path() . '/sximo/images/number7even-header.jpg"><br><span>Property: ' . $folderparInfo->display_name . '</span></div><br><br><br><div class="footer"><img src="' . public_path() . '/sximo/images/number7even-footer.jpg"><br><span class="pagenum">Page </span></div>';

                                $html .= $htmltemp;

                                $pdf = \App::make('dompdf.wrapper');
                                $pdf->loadHTML($html);
                                $pdf->save(public_path() . '/uploads/container_pdfs/' . $downFileName);

                                $linkConvertmsg .= ' <br> Please click <a href="' . \URL::to('uploads/container_pdfs/' . $downFileName) . '">Here</a>';
                                $share_type = 'Download as Pdf';
                                $share_url = \URL::to('uploads/container_pdfs/' . $downFileName);
                                $patOFile = public_path() . '/uploads/container_pdfs/' . $downFileName;
                            }
                        }
                    }

                    $data['msg'] = html_entity_decode($linkConvertmsg);
                    $usersemail = $request->input('emailids');
                    $users = explode(',', $usersemail);
                    for ($i = 0; $i < count($users); $i++) {
                        $emp = \DB::table('employee')->where('Email', $users[$i])->where('Status', 1)->first();
                        if (empty($emp)) {
                            $emdata['Status'] = 1;
                            $emdata['flag_status'] = 'Shared';
                            $emdata['Email'] = $users[$i];
                            \DB::table('employee')->insert($emdata);

                            $invite_exist = \DB::table('tb_share_emails')->where('email_id', $users[$i])->where('user_id', \Auth::user()->id)->first();
                            if (empty($invite_exist)) {
                                $invdata['user_id'] = \Auth::user()->id;
                                $invdata['email_id'] = $users[$i];
                                \DB::table('tb_share_emails')->insert($invdata);
                            }
                        }

                        $toouser['email'] = $users[$i];
                        $toouser['subject'] = $request->input('subject');
                        $toouser['pathToFile'] = $patOFile;
                        $etemp = $request->input('emailTemplate');
                        \Mail::send('user.emails.' . $etemp, $data, function($message) use ($toouser) {
                            $message->from('info@design-locations.biz', CNF_APPNAME);

                            $message->to($toouser['email']);

                            $message->subject($toouser['subject']);

                            $message->attach($toouser['pathToFile']);
                        });


                        $sharedata['file_ids'] = implode(',', $fimgs);
                        $sharedata['share_type'] = $share_type;
                        $sharedata['share_email'] = $users[$i];
                        $sharedata['share_template'] = $request->input('emailTemplate');
                        $sharedata['share_url'] = $share_url;
                        $sharedata['user_id'] = \Auth::user()->id;
                        $sharedata['created'] = date('Y-m-d h:i:s');
                        \DB::table('tb_container_employee_share')->insert($sharedata);
                    }

                    $rep['status'] = 'success';
                    return json_encode($rep);

                    //return Redirect::to(Input::get('curnurl'))->with('messagetext','Message has been sent')->with('msgstatus','success');
                    //return Redirect::to(Input::get('curnurl'))->with(['info' => 'Your Lightbox Sent Successfully.']);
                } else {
                    $rep['status'] = 'error';
                    $rep['errors'] = 'Please Select Files First';
                    return json_encode($rep);
                    //return Redirect::to(Input::get('curnurl'))->with('messagetext','.')->with('msgstatus','error');
                }
            } else {
                $rep['status'] = 'error';
                $rep['errors'] = 'Please fill the email address';
                return json_encode($rep);
                //return Redirect::to(Input::get('curnurl'))->with('messagetext','Please fill the email id')->with('msgstatus','error');
            }
        } else {
            $rep['status'] = 'error';
            $rep['errors'] = 'Please Select Files First.';
            return json_encode($rep);
            //return Redirect::to(Input::get('curnurl'))->with('messagetext','Please Select Files First.')->with('msgstatus','error');
        }
    }

    function databankenPage($fid, Request $request) {
        if (CNF_FRONT == 'false' && $request->segment(1) == '') :
            return Redirect::to('dashboard');
        endif;

        $page = $request->segment(1);
        if ($page != '') :
            $content = \DB::table('tb_pages')->where('alias', '=', $page)->where('status', '=', 'enable')->get();
            //print_r($content); die;
            //return '';
            if ($fid != '' && $fid > 0) {
                if (count($content) >= 1) {
                    $row = $content[0];
                    $this->data['pageTitle'] = $row->title;
                    $this->data['pageNote'] = $row->note;
                    $this->data['pageMetakey'] = ($row->metakey != '' ? $row->metakey : CNF_METAKEY);
                    $this->data['pageMetadesc'] = ($row->metadesc != '' ? $row->metadesc : CNF_METADESC);

                    $this->data['breadcrumb'] = 'active';

                    if ($row->access != '') {
                        $access = json_decode($row->access, true);
                    } else {
                        $access = array();
                    }

                    // If guest not allowed 
                    if ($row->allow_guest != 1) {
                        $group_id = \Session::get('gid');
                        $isValid = (isset($access[$group_id]) && $access[$group_id] == 1 ? 1 : 0 );
                        if ($isValid == 0) {
                            return Redirect::to('')
                                            ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_restric')));
                        }
                    }
                    if ($row->template == 'backend') {
                        $page = 'pages.' . $row->filename;
                    } else {
                        $page = 'layouts.' . CNF_THEME . '.index';
                    }
                    //print_r($this->data);exit;

                    $filename = base_path() . "/resources/views/pages/" . $row->filename . ".blade.php";
                    if (file_exists($filename)) {
                        $uid = \Auth::user()->id;
                        $this->data['pages'] = 'pages.' . $row->filename;
                        //	print_r($this->data);exit;
                        $this->data['social_links'] = \DB::table('tb_social')->where('status', 1)->get();
                        $this->data['footer_text'] = \DB::table('tb_settings')->where('key_value', 'footer_text')->first();
                        $this->data['parentArr'] = array_reverse($this->fetchFolderParentListArray($fid));
                        $this->data['prtfoldersname'] = \DB::table('tb_container')->where('id', $fid)->first();
                        $this->data['fid'] = $fid;

                        $default_front_design = \DB::table('tb_settings')->where('key_value', 'frontend_design')->first();
                        $this->data['final_material_folders'] = array();

                        $productgroup_folder = \DB::table('tb_container')->where('id', $fid)->first();
                        //echo '<pre>';
                        if (!empty($productgroup_folder)) {
                            //print_r($productgroup_folder);
                            $par_folder = $productgroup_folder->id;
                            $parent_query = \DB::table('tb_container')->where('parent_id', $par_folder)->get();
                            $this->data['enabled_parent_array'] = array();
                            $temp_arr = array();
                            $temp_arr[$par_folder]['data'] = $productgroup_folder;
                            $temp_arr[$par_folder]['parents'] = $productgroup_folder->parent_id;

                            $p_is_enabled = false;
                            $enabled_cnt = \DB::table('tb_frontend_container')->where('container_id', $par_folder)->where('container_type', 'folder')->count();
                            if ($enabled_cnt > 0) {
                                $p_is_enabled = true;
                            }

                            $temp_arr[$par_folder]['is_enabled'] = $p_is_enabled;
                            if (!empty($parent_query)) {

                                foreach ($parent_query as $parent_obj) {
                                    $temp_array = array();
                                    $temp_array['data']['id'] = $parent_obj->id;
                                    $temp_array['data']['folder_id'] = $parent_obj->id;
                                    $temp_array['data']['name'] = $parent_obj->display_name;
                                    $temp_array['data']['file_type'] = 'folder';
                                    //$temp_array['data']['cover_img'] = $parent_obj->cover_img;
                                    $temp_array['data']['title'] = $parent_obj->title;
                                    $temp_array['data']['description'] = $parent_obj->description;
                                    $temp_array['data']['created'] = $parent_obj->created;
                                    $temp_array['data']['user_id'] = $parent_obj->user_id;
                                    $temp_array['data']['sort_num'] = $parent_obj->sort_num;
                                    $temp_array['data']['designer'] = array();
                                    $temp_array['data']['assign_lightbox'] = 'no';
                                    $temp_array['data']['imgsrc'] = '';
                                    $temp_array['data']['reserved'] = 'no';

                                    $check_designer = \DB::table('tb_container_designers')->join('tb_designers', 'tb_designers.id', '=', 'tb_container_designers.designer_id')->where('tb_container_designers.container_id', $parent_obj->id)->where('tb_container_designers.container_type', 'folder')->first();
                                    if (!empty($check_designer)) {
                                        $temp_array['data']['designer'] = $check_designer;
                                    }

                                    if ($parent_obj->cover_img == "") {
                                        if (!empty($default_front_design) && $default_front_design->content == "masonry") {
                                            $temp_array['data']['cover_img'] = $parent_obj->temp_cover_img_masonry;
                                        } elseif (!empty($default_front_design) && $default_front_design->content == "grid") {
                                            $temp_array['data']['cover_img'] = $parent_obj->temp_cover_img;
                                        } else {
                                            $temp_array['data']['cover_img'] = $parent_obj->cover_img;
                                        }
                                    } else {
                                        $temp_array['data']['cover_img'] = $parent_obj->cover_img;
                                    }

                                    //$temp_array['data'] = $parent_obj;
                                    $temp_array['parents'] = $productgroup_folder->parent_id . ',' . $parent_obj->parent_id;
                                    $is_enabled = false;
                                    $enabled_cnt = \DB::table('tb_frontend_container')->where('container_id', $parent_obj->id)->where('container_type', 'folder')->count();
                                    $enabled_file_cnt = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $parent_obj->id)->count();
                                    if (($enabled_cnt > 0) && ($enabled_file_cnt > 0)) {
                                        $is_enabled = true;
                                        $this->set_all_enabled_parent($temp_array['parents'] . ',' . $parent_obj->id);
                                    }
                                    $temp_array['is_enabled'] = $is_enabled;
                                    $child_cnt = \DB::table('tb_container')->where('parent_id', $parent_obj->id)->count();
                                    if ($child_cnt > 0) {
                                        $temp_array['child'] = $this->get_all_child_folder($parent_obj->id, $temp_array['parents']);
                                    }

                                    $temp_arr[$par_folder]['child'][$parent_obj->id] = $temp_array;

                                    $file_query = \DB::table('tb_container_files')->where('folder_id', $parent_obj->id)->get();
                                    foreach ($file_query as $file_obj) {
                                        $temp_array = array();
                                        $extype = explode('/', $file_obj->file_type);
                                        if ($extype[0] == "image") {
                                            $enabled_cntfile = \DB::table('tb_frontend_container')->where('container_id', $file_obj->id)->where('container_type', 'file')->count();
                                            if ($enabled_cntfile > 0) {
                                                $temp_array['data']['id'] = $file_obj->id;
                                                $temp_array['data']['folder_id'] = $file_obj->folder_id;
                                                $temp_array['data']['name'] = ($file_obj->file_display_name != '') ? $file_obj->file_display_name : $file_obj->file_name;
                                                $temp_array['data']['file_type'] = 'file';
                                                $temp_array['data']['cover_img'] = $file_obj->file_name;
                                                $temp_array['data']['title'] = $file_obj->file_title;
                                                $temp_array['data']['description'] = $file_obj->file_description;
                                                $temp_array['data']['created'] = $file_obj->created;
                                                $temp_array['data']['user_id'] = $file_obj->user_id;
                                                $temp_array['data']['sort_num'] = $file_obj->file_sort_num;
                                                $temp_array['data']['designer'] = array();
                                                $temp_array['data']['assign_lightbox'] = 'no';
                                                $temp_array['data']['imgsrc'] = (new ContainerController)->getThumbpath($file_obj->folder_id);
                                                $temp_array['data']['reserved'] = 'no';

                                                $frontend_lightbox = \DB::table('tb_frontend_lightbox')->where('container_id', $file_obj->id)->where('container_type', 'file')->first();
                                                if (!empty($frontend_lightbox)) {
                                                    $temp_array['data']['assign_lightbox'] = 'yes';
                                                }

                                                $curdate = date('Y-m-d');
                                                $frontend_reserved = \DB::table('tb_order_items')->where('file_id', $file_obj->id)->where('reserve_till', '>=', $curdate)->first();
                                                if (!empty($frontend_reserved)) {
                                                    $temp_array['data']['reserved'] = 'yes';
                                                }

                                                $dirPath = (new ContainerController)->getContainerUserPath($file_obj->folder_id);
                                                $copytofolder = public_path() . '/uploads/folder_cover_imgs/';
                                                if (!\File::exists($copytofolder . 'masonry_product_file_' . $file_obj->file_name)) {
                                                    // IMage for Product page
                                                    /* $pdimg = \Image::make($dirPath.$file_obj->file_name);
                                                      $pdimg->resize(305, 223);
                                                      $pdimgfile = 'product_file_'.$file_obj->file_name;
                                                      $pdimg->save($copytofolder.$pdimgfile); */

                                                    $mpimg = \Image::make($dirPath . $file_obj->file_name);
                                                    $mactualsize = getimagesize($dirPath . $file_obj->file_name);
                                                    if ($mactualsize[0] > $mactualsize[1]) {
                                                        $mpimg->resize(349, 228);
                                                    } else {
                                                        $mpimg->resize(349, 527);
                                                    }
                                                    $mpfile = 'masonry_product_file_' . $file_obj->file_name;
                                                    $mpimg->save($copytofolder . $mpfile);
                                                }

                                                //$temp_array['data'] = $file_obj;
                                                $temp_array['parents'] = $productgroup_folder->parent_id . ',' . $file_obj->folder_id;
                                                $is_enabled = false;
                                                $enabled_cnt = \DB::table('tb_frontend_container')->where('container_id', $file_obj->id)->where('container_type', 'file')->count();
                                                if ($enabled_cnt > 0) {
                                                    $is_enabled = true;
                                                    $this->set_all_enabled_parent($temp_array['parents'] . ',i-' . $file_obj->id);
                                                }

                                                $temp_array['is_enabled'] = $is_enabled;


                                                //$temp_arr[$par_folder]['child']['i-'.$file_obj->id] = $temp_array;
                                                $temp_arr[$par_folder]['child'][$parent_obj->id]['subchild'][$file_obj->id] = $temp_array;
                                            }
                                        }
                                    }
                                }
                            }

                            $file_query = \DB::table('tb_container_files')->where('folder_id', $par_folder)->get();
                            foreach ($file_query as $file_obj) {
                                $temp_array = array();
                                $extype = explode('/', $file_obj->file_type);
                                if ($extype[0] == "image") {
                                    $temp_array['data']['id'] = $file_obj->id;
                                    $temp_array['data']['folder_id'] = $file_obj->folder_id;
                                    $temp_array['data']['name'] = ($file_obj->file_display_name != '') ? $file_obj->file_display_name : $file_obj->file_name;
                                    $temp_array['data']['file_type'] = 'file';
                                    $temp_array['data']['cover_img'] = $file_obj->file_name;
                                    $temp_array['data']['title'] = $file_obj->file_title;
                                    $temp_array['data']['description'] = $file_obj->file_description;
                                    $temp_array['data']['created'] = $file_obj->created;
                                    $temp_array['data']['user_id'] = $file_obj->user_id;
                                    $temp_array['data']['sort_num'] = $file_obj->file_sort_num;
                                    $temp_array['data']['designer'] = array();
                                    $temp_array['data']['assign_lightbox'] = 'no';
                                    $temp_array['data']['imgsrc'] = (new ContainerController)->getThumbpath($file_obj->folder_id);
                                    $temp_array['data']['reserved'] = 'no';

                                    $frontend_lightbox = \DB::table('tb_frontend_lightbox')->where('container_id', $file_obj->id)->where('container_type', 'file')->first();
                                    if (!empty($frontend_lightbox)) {
                                        $temp_array['data']['assign_lightbox'] = 'yes';
                                    }

                                    $curdate = date('Y-m-d');
                                    $frontend_reserved = \DB::table('tb_order_items')->where('file_id', $file_obj->id)->where('reserve_till', '>=', $curdate)->first();
                                    if (!empty($frontend_reserved)) {
                                        $temp_array['data']['reserved'] = 'yes';
                                    }

                                    $dirPath = (new ContainerController)->getContainerUserPath($file_obj->folder_id);
                                    $copytofolder = public_path() . '/uploads/folder_cover_imgs/';
                                    if (!\File::exists($copytofolder . 'masonry_product_file_' . $file_obj->file_name)) {
                                        // IMage for Product page
                                        /* $pdimg = \Image::make($dirPath.$file_obj->file_name);
                                          $pdimg->resize(305, 223);
                                          $pdimgfile = 'product_file_'.$file_obj->file_name;
                                          $pdimg->save($copytofolder.$pdimgfile); */

                                        $mpimg = \Image::make($dirPath . $file_obj->file_name);
                                        $mactualsize = getimagesize($dirPath . $file_obj->file_name);
                                        if ($mactualsize[0] > $mactualsize[1]) {
                                            $mpimg->resize(349, 228);
                                        } else {
                                            $mpimg->resize(349, 527);
                                        }
                                        $mpfile = 'masonry_product_file_' . $file_obj->file_name;
                                        $mpimg->save($copytofolder . $mpfile);
                                    }
                                }
                                //$temp_array['data'] = $file_obj;
                                $temp_array['parents'] = $productgroup_folder->parent_id . ',' . $file_obj->folder_id;
                                $is_enabled = false;
                                $enabled_cnt = \DB::table('tb_frontend_container')->where('container_id', $file_obj->id)->where('container_type', 'file')->count();
                                if ($enabled_cnt > 0) {
                                    $is_enabled = true;
                                    $this->set_all_enabled_parent($temp_array['parents'] . ',i-' . $file_obj->id);
                                }

                                $temp_array['is_enabled'] = $is_enabled;


                                $temp_arr[$par_folder]['child']['i-' . $file_obj->id] = $temp_array;
                            }

                            $this->data['final_material_folders'] = $this->set_parents_enables($temp_arr);
                            //print_r($this->data['final_material_folders']);
                        }

                        //print "<pre>";
                        //print_r($this->data['final_material_folders']);

                        $front_design = "grid";
                        if (!empty($default_front_design) && $default_front_design->content != "") {
                            $front_design = $default_front_design->content;
                        }
                        $this->data['default_front_design'] = $front_design;

                        $this->data['parentsfolders'] = array();
                        $productgroup_folder = \DB::table('tb_container')->where('name', 'Produktgruppen')->first();
                        if (!empty($productgroup_folder)) {
                            $par_folder = $productgroup_folder->id;
                            $mainparent_query = \DB::table('tb_container')->where('parent_id', $par_folder)->get();
                            $this->data['enabled_parent_array'] = array();
                            if (!empty($mainparent_query)) {
                                //echo '<pre>';
                                $parent_temp_arr = array();
                                foreach ($mainparent_query as $parent_obj) {
                                    $parent_temp_array = array();
                                    $parent_temp_array['data'] = $parent_obj;
                                    $parent_temp_array['parents'] = $parent_obj->parent_id;
                                    $is_enabled = false;
                                    $enabled_cnt = \DB::table('tb_frontend_container')->where('container_id', $parent_obj->id)->where('container_type', 'folder')->count();
                                    $enabled_file_cnt = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $parent_obj->id)->count();
                                    if (($enabled_cnt > 0) && ($enabled_file_cnt > 0)) {
                                        $is_enabled = true;
                                        $this->set_all_enabled_parent($parent_temp_array['parents'] . ',' . $parent_obj->id);
                                    }
                                    $parent_temp_array['is_enabled'] = $is_enabled;
                                    $child_cnt = \DB::table('tb_container')->where('parent_id', $parent_obj->id)->count();
                                    if ($child_cnt > 0) {
                                        $parent_temp_array['child'] = $this->get_all_child_folder($parent_obj->id, $parent_temp_array['parents']);
                                    }


                                    $parent_temp_arr[$parent_obj->id] = $parent_temp_array;
                                }

                                $this->data['parentsfolders'] = $this->set_parents_enables($parent_temp_arr);
                                //print_r($this->data['parentsfolders']);
                            }
                        }

                        $this->data['lightboxes'] = \DB::table('tb_lightbox')->where('user_id', $uid)->get();

                        $boxcontent = \DB::table('tb_lightbox_content')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_lightbox_content.file_id')->select('tb_lightbox_content.*', 'tb_container_files.file_name', 'tb_container_files.folder_id', 'tb_container_files.file_display_name')->where('tb_lightbox_content.user_id', $uid)->get();
                        $boxcont = array();
                        if (!empty($boxcontent)) {
                            foreach ($boxcontent as $bcontent) {
                                $boxcont[$bcontent->lightbox_id][] = $bcontent;
                            }
                        }
                        $this->data['lightcontent'] = $boxcont;

                        return view($page, $this->data);
                    } else {
                        return Redirect::to('')
                                        ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
                    }
                } else {
                    return Redirect::to('')
                                    ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
                }
            } else {
                return Redirect::to('')
                                ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
            }

        else :
            $this->data['pageTitle'] = 'Home';
            $this->data['pageNote'] = 'Welcome To Our Site';
            $this->data['breadcrumb'] = 'inactive';
            $this->data['pageMetakey'] = CNF_METAKEY;
            $this->data['pageMetadesc'] = CNF_METADESC;

            $this->data['ads_home'] = \DB::table('tb_advertisement')->where('adv_status', 1)->get();

            $this->data['pages'] = 'pages.home';
            $page = 'layouts.' . CNF_THEME . '.index';
            return view($page, $this->data);
        endif;
    }

    function downloadHighresZip($fid) {
        $downFileName = 'zip-' . date('d-m-Y') . '.zip';
        if (\File::exists(public_path() . '/uploads/zip/' . $downFileName)) {
            \File::delete(public_path() . '/uploads/zip/' . $downFileName);
        }

        $files = array();
        $checkfolder = \DB::table('tb_container')->where('parent_id', $fid)->where('name', 'jpg-highres')->first();
        if (!empty($checkfolder)) {
            $fetchfiles = \DB::table('tb_container_files')->where('folder_id', $checkfolder->id)->get();
            if (!empty($fetchfiles)) {
                $filedirPath = (new ContainerController)->getContainerUserPath($checkfolder->id);
                foreach ($fetchfiles as $file) {
                    $files[] = $filedirPath . $file->file_name;
                }
            }
        }

        Zipper::make('uploads/zip/' . $downFileName)->add($files);

        $headers = array(
            'Content-Type' => 'application/octet-stream',
        );

        $dopath = Zipper::getFilePath();
        Zipper::close();
        // Download .zip file.
        return Redirect::away(\URL::to($dopath));
        //$response = \Response::download( public_path() . '/'.$dopath, $downFileName, $headers );
        //return $response;
    }

    public function lightboxReserveItems(Request $request) {
        $lid = $request->input('lightboxId');
        $uid = \Auth::user()->id;
        if (\Auth::check() == true) {
            $l = 1;
            $uid = \Auth::user()->id;
            $check_light = \DB::table('tb_lightbox')->where('id', $lid)->count();
            if ($check_light > 0) {
                $fetch_orderitems = \DB::table('tb_order_items')->where('user_id', $uid)->count();
                if ($fetch_orderitems < 3) {
                    $order['status'] = 1;
                    $order['lightbox_id'] = $lid;
                    $order['user_id'] = $uid;
                    $order['reserve_till'] = date('Y-m-d', strtotime('+7 days'));
                    $order['created'] = date('Y-m-d h:i:s');
                    $order_id = \DB::table('tb_orders')->insertGetId($order);

                    $fetch_lightcontent = \DB::table('tb_lightbox_content')->where('lightbox_id', $lid)->get();
                    if (!empty($fetch_lightcontent)) {
                        foreach ($fetch_lightcontent as $items) {
                            $fetch_orderitem = \DB::table('tb_order_items')->where('user_id', $uid)->count();
                            if ($fetch_orderitem < 3) {
                                $orderItems['file_id'] = $items->file_id;
                                $orderItems['order_id'] = $order_id;
                                $orderItems['user_id'] = $uid;
                                $orderItems['reserve_till'] = date('Y-m-d', strtotime('+7 days'));
                                $orderItems['created'] = date('Y-m-d h:i:s');
                                $order_item = \DB::table('tb_order_items')->insertGetId($orderItems);
                            } else {
                                break;
                            }
                        }

                        $fetch_user = \DB::table('tb_users')->where('id', $uid)->first();
                        $to = $fetch_user->email;
                        $subject = 'order placed';
                        $message = 'your lightbox order placed';
                        $headers = 'MIME-Version: 1.0' . "\r\n";
                        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                        $headers .= 'From: ' . CNF_APPNAME . ' <' . CNF_EMAIL . '>' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
                        mail($to, $subject, $message, $headers);

                        $to_app = CNF_EMAIL;
                        $subject_app = 'order placed';
                        $message_app = 'user placed a new order';
                        $headers_app = 'MIME-Version: 1.0' . "\r\n";
                        $headers_app .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                        $headers_app .= 'From: ' . CNF_APPNAME . ' <' . CNF_EMAIL . '>' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
                        mail($to_app, $subject_app, $message_app, $headers_app);

                        $reerseitems = array();
                        $fetch_orderItems = \DB::table('tb_order_items')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_order_items.file_id')->select('tb_order_items.*', 'tb_container_files.file_name', 'tb_container_files.folder_id', 'tb_container_files.file_display_name')->where('tb_order_items.order_id', $order_id)->get();
                        if (!empty($fetch_orderItems)) {
                            $reerseitems = $fetch_orderItems;
                        }
                        $rep['reserved'] = json_encode($reerseitems);
                        $rep['status'] = 'success';
                        return json_encode($rep);
                    }
                } else {
                    $rep['status'] = 'error';
                    $rep['errors'] = 'Sie können Maximal 3 Produkten Reservieren';
                    return json_encode($rep);
                }
            } else {
                $rep['status'] = 'error';
                $rep['errors'] = 'lightbox not found';
                return json_encode($rep);
            }
        } else {
            $rep['status'] = 'error';
            $rep['errors'] = 'please login first.';
            return json_encode($rep);
        }
    }

    public function changeLang($lang = 'en') {
        \Session::put('newlang', $lang);
        if ($lang == 'English') {
            \Session::put('lang', 'en');
        } else {
            \Session::put('lang', 'Deutsch');
        }

        return Redirect::back();
    }

    function ViewFlipbookFrontend($pdfId) {
        if ($pdfId != '' && $pdfId > 0) {
            $flipimgs = array();
            $fl = 0;
            $file = \DB::table('tb_container_files')->where('id', $pdfId)->first();
            $dirPath = (new ContainerController)->getThumbpath($file->folder_id);

            $flipimgs[$fl]['imgpath'] = $dirPath . $file->file_name;
            $flipimgs[$fl]['imgname'] = $file->file_name;
            $flipimgs[$fl]['file_type'] = $file->file_type;
            $flipimgs[$fl]['folder'] = $file->folder_id;

            $this->data['flips'] = $flipimgs;
            $this->data['fliptype'] = 'high';
            return view('container.flipbook', $this->data);
        } else {
            return Redirect::to('downloads')->with('messagetext', 'Invalid link.')->with('msgstatus', 'error');
        }
    }

    function MakeProductSeoUrls($pro_name, Request $request) {
        if ($pro_name != '') {
            $act_name = str_replace('-', ' ', $pro_name);
            $fetch_parent = \DB::table('tb_container')->where('name', 'Produktgruppen')->first();
            if (!empty($fetch_parent)) {
                $fetch_product = \DB::table('tb_container')->where('display_name', $act_name)->where('parent_id', $fetch_parent->id)->first();
                if (!empty($fetch_product)) {
                    echo $this->subProductPage($fetch_product->id, $request);
                } else {
                    return Redirect::to('')->with('messagetext', 'Invalid link.')->with('msgstatus', 'error');
                }
            }
        } else {
            return Redirect::to('')->with('messagetext', 'Invalid link.')->with('msgstatus', 'error');
        }
    }

    function MakeProductdetailSeoUrls($parent, $pro_name, Request $request) {
        if ($pro_name != '' && $parent != '') {
            $act_parent = str_replace('-', ' ', $parent);
            $act_name = str_replace('-', ' ', $pro_name);

            $fetch_main_parent = \DB::table('tb_container')->where('name', 'Produktgruppen')->first();
            if (!empty($fetch_main_parent)) {
                $fetch_parent = \DB::table('tb_container')->where('display_name', $act_parent)->where('parent_id', $fetch_main_parent->id)->first();
                if (!empty($fetch_parent)) {
                    $fetch_product = \DB::table('tb_container')->where('display_name', $act_name)->where('parent_id', $fetch_parent->id)->first();
                    if (!empty($fetch_product)) {
                        echo $this->ProductDetail($fetch_product->id, $request);
                    } else {
                        return Redirect::to('')->with('messagetext', 'Invalid link.')->with('msgstatus', 'error');
                    }
                } else {
                    return Redirect::to('')->with('messagetext', 'Invalid link.')->with('msgstatus', 'error');
                }
            }
        } else {
            return Redirect::to('')->with('messagetext', 'Invalid link.')->with('msgstatus', 'error');
        }
    }

    function MakeMaterialSeoUrls($mat_name, Request $request) {
        if ($mat_name != '') {
            $act_name = str_replace('-', ' ', $mat_name);

            $fetch_main_parent = \DB::table('tb_container')->where('name', 'material')->first();
            if (!empty($fetch_main_parent)) {
                $fetch_product = \DB::table('tb_container')->where('display_name', $act_name)->where('parent_id', $fetch_main_parent->id)->first();
                if (!empty($fetch_product)) {
                    echo $this->subMaterialsPage($fetch_product->id, $request);
                } else {
                    return Redirect::to('')->with('messagetext', 'Invalid link.')->with('msgstatus', 'error');
                }
            }
        } else {
            return Redirect::to('')->with('messagetext', 'Invalid link.')->with('msgstatus', 'error');
        }
    }

    public function place_shop_order(Request $request) {
        $productArr = $request->input('order_products');
        $quantityArr = $request->input('order_qtys');
        $uid = \Auth::user()->id;
        if ($productArr != '') {
            $ord_data['user_id'] = $uid;
            $ord_data['page'] = $request->input('order_page');
            $ord_data['created'] = date('Y-m-d h:i:s');
            $ord_id = \DB::table('tb_shop_order')->insertGetId($ord_data);

            $prodArr = explode(',', $productArr);
            $qtyArr = explode(',', $quantityArr);
            $q = 0;
            foreach ($prodArr as $prod) {
                $singleProd = explode('-', $prod);
                $ordcat = $singleProd[0];
                $ordproduct = $singleProd[1];

                $ord_itm_data['page'] = $request->input('order_page');
                $ord_itm_data['shop_order_id'] = $ord_id;
                $ord_itm_data['shop_cat_id'] = $ordcat;
                $ord_itm_data['product_id'] = $ordproduct;
                $ord_itm_data['product_qty'] = $qtyArr[$q];
                $ord_itm_data['user_id'] = $uid;
                $ord_itm_data['created'] = date('Y-m-d h:i:s');
                $ord_itm_id = \DB::table('tb_shop_order_products')->insertGetId($ord_itm_data);
                $q++;
            }

            $shopitems = array();
            $fetch_orderItems = \DB::table('tb_shop_order_products')->join('tb_shop_products', 'tb_shop_products.id', '=', 'tb_shop_order_products.product_id')->select('tb_shop_order_products.*', 'tb_shop_products.title', 'tb_shop_products.description', 'tb_shop_products.price', 'tb_shop_products.custom_description')->where('tb_shop_order_products.shop_order_id', $ord_id)->get();
            if (!empty($fetch_orderItems)) {
                $shopitems = $fetch_orderItems;
            }
            $rep['shopitems'] = json_encode($shopitems);
            $rep['status'] = 'success';
            return json_encode($rep);
        } else {
            $rep['status'] = 'error';
            $rep['errors'] = 'please select products first.';
            return json_encode($rep);
        }
    }

    //for quick view for inner propery listing 
    public function getPropertyQuickView(Request $request) {
        $propertiesArr = array();
        $props = \DB::table('tb_properties')->where('id', $request->id)->where('property_status', 1)->first();

        if (!empty($props)) {


            $propertiesArr['data'] = $props;
            $fileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->get();
            //print_r($fileArr);
            $pr = 0;
            foreach ($fileArr as $file) {
                $propertiesArr['image'][$pr] = $file;
                $propertiesArr['image'][$pr]->imgsrc = (new ContainerController)->getThumbpath($file->folder_id);
                $pr++;
            }
        }


        return response()->json($propertiesArr);
        exit;
    }

    public function getPropertyDetail(Request $request) {
        $propertiesArr = array();
		$crpropertiesArr = array();
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
            }
        }

        $this->data['sidebardetailAds'] = \DB::table('tb_advertisement')->select('adv_link','adv_img')->where('adv_type', 'sidebar')->where('adv_position', 'detail')->get();

        $uid = isset(\Auth::user()->id) ? \Auth::user()->id : '';
        $this->data['lightboxes'] = \DB::table('tb_lightbox')->select('box_name','id')->where('user_id', $uid)->get();

        $boxcontent = \DB::table('tb_lightbox_content')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_lightbox_content.file_id')->select('tb_lightbox_content.file_id', 'tb_lightbox_content.id', 'tb_lightbox_content.lightbox_id', 'tb_container_files.file_name', 'tb_container_files.folder_id', 'tb_container_files.file_display_name', 'tb_container_files.file_title')->where('tb_lightbox_content.user_id', $uid)->get();

        $boxcont = array();
        if (!empty($boxcontent)) {
            $l = 0;
            foreach ($boxcontent as $bcontent) {
                $boxcont[$bcontent->lightbox_id][$l]['lightbox'] = $bcontent;
                $fetch_prop_img = \DB::table('tb_properties_images')->join('tb_properties','tb_properties_images.property_id','=','tb_properties.id')->select('property_name')->where('file_id', $bcontent->file_id)->first();
                if (!empty($fetch_prop_img)) {
					$boxcont[$bcontent->lightbox_id][$l]['property'] = $fetch_prop_img;
                }
                $l++;
            }
        }
        $this->data['lightcontent'] = $boxcont;
		
		$this->data['restaurant_gallery'] = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_container_files.id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.type', 'Restrurants Gallery Images')->orderBy('tb_container_files.file_sort_num', 'asc')->count();
		
		$this->data['bar_gallery'] = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_container_files.id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.type', 'Bar Gallery Images')->orderBy('tb_container_files.file_sort_num', 'asc')->count();
		
		$this->data['spa_gallery'] = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_container_files.id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.type', 'Spa Gallery Images')->orderBy('tb_container_files.file_sort_num', 'asc')->count();

        //print "<pre>";
        //print_r($propertiesArr); die;
        $this->data['propertyDetail'] = $propertiesArr;
        $this->data['relatedproperties'] = $crpropertiesArr;
        $this->data['pageTitle'] = 'Details';
        $page = 'layouts.' . CNF_THEME . '.index';
        $this->data['pages'] = 'pages.editorial';
        return view($page, $this->data);
    }

    public function getPropertyDetail_pages(Request $request) {
        $propertiesArr = array();
        $props = \DB::table('tb_properties')->select('id','property_name','architecture_image','architecture_title','architecture_desciription','default_seasons')->where('property_slug', $request->slug)->first();

        $this->data['slug'] = $request->slug;
        if (!empty($props)) {
            $propertiesArr['data'] = $props;
				
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

            $this->data['currency'] = \DB::table('tb_settings')->select('content')->where('key_value', 'default_currency')->first();
        }

        $this->data['propertyDetail'] = $propertiesArr;
        $this->data['pageTitle'] = 'Details';
        $page = 'layouts.' . CNF_THEME . '.index';
        $this->data['pages'] = 'pages.editorial_' . $request->page;
        return view($page, $this->data);
    }

    public function bookProperty(Request $request) {
        $propertiesArr = array();

        /* $hotels = \DB::table('tb_properties')->where('property_type', 'Hotel')->get();
          $villas = \DB::table('tb_properties')->where('property_type', 'Villas')->get();
          $yachts = \DB::table('tb_properties')->where('property_type', 'Yachts')->get(); */

        $props = \DB::table('tb_properties')->where('property_slug', $request->slug)->first();

        if (!is_null($request->input('arrive')) && $request->input('arrive') != '') {
            \Session::put('arrive_date', $request->input('arrive'));
            $this->data['arrive_date'] = date("d.m.Y", strtotime(trim($request->input('arrive'))));
        }

        if (!is_null($request->input('destination')) && $request->input('destination') != '') {
            \Session::put('destination_date', $request->input('destination'));
            $this->data['destination_date'] = date("d.m.Y", strtotime(trim($request->input('destination'))));
        }

        if (!is_null($request->input('booking_adults')) && $request->input('booking_adults') != '') {
            \Session::put('adults', $request->input('booking_adults'));
            $this->data['adults'] = $request->input('booking_adults');
        }

        if (!is_null($request->input('booking_children')) && $request->input('booking_children') != '') {
            \Session::put('childs', $request->input('booking_children'));
            $this->data['childs'] = $request->input('booking_children');
        }

        if (!empty($props)) {
            $propertiesArr['data'] = $props;
            $fileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id', 'tb_container_files.file_title', 'tb_container_files.file_description')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->get();
            //print_r($fileArr);
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

        if (empty($propertiesArr['typedata'])) {
            return Redirect::to('')->with('message', \SiteHelpers::alert('error', 'Rooms not found'));
        }

        //print "<pre>";
        //print_r($propertiesArr); die;
        /* $this->data['hotels'] = $hotels;
          $this->data['villas'] = $villas;
          $this->data['yachts'] = $yachts; */

        $this->data['is_logged_in'] = 'false';
        if (\Auth::check()) {
            $this->data['is_logged_in'] = 'true';
        }

        $this->data['hotel_terms_n_conditions'] = \DB::table('td_property_terms_n_conditions')->where('property_id', $props->id)->first();

        $this->data['propertyDetail'] = $propertiesArr;
        $this->data['relatedproperties'] = $crpropertiesArr;
        $this->data['pageTitle'] = 'Details';
        $page = 'layouts.' . CNF_THEME . '.index';
        $this->data['pages'] = 'pages.booking-form';
        return view($page, $this->data);
    }

    public function listShopProducts(Request $request) {

        $cat_id = $request->cat;
        $this->data['activeCat'] = $cat_id;
        $this->data['activeCatTitle'] = $request->cat_title;
        $this->data['products_limit'] = 14;
        $this->data['editors_choice_limit'] = 2;
        $this->data['af_search'] = isset($_REQUEST['s']) ? $_REQUEST['s'] : '';

        $query = "SELECT * FROM sh_products WHERE status = 'Enabled' ";
        if ($cat_id != '') {
            $query .= "AND category = '{$cat_id}' ";
        }
        if (isset($_REQUEST['s']) && $_REQUEST['s'] != '') {
            $query .= "AND titile LIKE '%{$_REQUEST['s']}%' ";
        }
        $query .= "ORDER BY id DESC ";
        $query .= "LIMIT 0, {$this->data['products_limit']} ";

        if($cat_id != '') {
            $this->data['prev_category'] = \DB::table('sh_product_categories')->where('id', '<', $cat_id)->where('status', 'Enabled')->orderBy("id", 'ASC')->first();
            $this->data['next_category'] = \DB::table('sh_product_categories')->where('id', '>', $cat_id)->where('status', 'Enabled')->orderBy("id", 'ASC')->first();
        }
        
        if(empty($this->data['prev_category']) || $cat_id == '') {
            $this->data['prev_category'] = \DB::table('sh_product_categories')->where('status', 'Enabled')->orderBy("id", 'ASC')->first();
        }
        
        if(empty($this->data['prev_category']) && $cat_id != '') {
            $this->data['prev_category'] = \DB::table('sh_product_categories')->where('status', 'Enabled')->orderBy("id", 'DESC')->first();
        }
        
        if(empty($this->data['next_category']) || $cat_id == '') {
            $this->data['next_category'] = \DB::table('sh_product_categories')->where('status', 'Enabled')->orderBy("id", 'DESC')->first();
        }
        
        $this->data['categories'] = DB::select(DB::raw("SELECT * FROM sh_product_categories WHERE parent_id = '0' AND status = 'Enabled' ORDER BY category_title ASC"));
        $this->data['featured_products'] = DB::select(DB::raw("SELECT sh_products.id,sh_products.featured_slider_image,sh_products.titile,sh_products.description,sh_products.slug, sh_product_categories.category_title FROM sh_products join sh_product_categories on sh_product_categories.id = sh_products.category WHERE sh_products.featured_products = 'Yes' AND sh_products.status = 'Enabled' AND sh_products.featured_slider_image != '' ORDER BY sh_products.id DESC LIMIT 5 "));
        $this->data['editors_choice_products'] = DB::select(DB::raw("SELECT * FROM sh_products WHERE editors_choice = 'Yes' AND status = 'Enabled' ORDER BY id DESC LIMIT {$this->data['editors_choice_limit']} "));
        $this->data['products'] = DB::select(DB::raw($query));

        $this->data['categoryslider'] = \DB::table('tb_sliders')->where('slider_category', trim($request->cat_title))->get();

        $page = 'layouts.' . CNF_THEME . '.index';
        $this->data['pages'] = 'pages.product-grid-shuffle';
        $this->data['pageTitle'] = 'Products';
        return view($page, $this->data);
    }

    public function ajax_listShopProducts(Request $request) {

        $af_category = Input::get('af_category');
        $af_search = Input::get('af_search');
        $af_min_price = Input::get('af_min_price');
        $af_max_price = Input::get('af_max_price');
        $af_load_slider = Input::get('af_load_slider');
        $af_start = Input::get('af_start');
        $af_editors_choice_start = Input::get('af_editors_choice_start');

        $this->data['products_limit'] = 14;
        $this->data['editors_choice_limit'] = 2;

        $query = "SELECT * FROM sh_products WHERE status = 'Enabled' ";
        if ($af_category != '0') {
            $query .= "AND category = '{$af_category}' ";
        }
        if ($af_search != '') {
            $query .= "AND titile LIKE '%{$af_search}%' ";
        }
        if ($af_max_price != '0') {
            $query .= "AND ( price >= {$af_min_price} AND price <= '{$af_max_price}' ) ";
        }
        $query .= "ORDER BY id DESC ";
        $query .= "LIMIT {$af_start}, {$this->data['products_limit']} ";

        $data['editors_choice_products'] = DB::select(DB::raw("SELECT * FROM sh_products WHERE editors_choice = 'Yes' AND status = 'Enabled' ORDER BY id DESC LIMIT {$af_editors_choice_start}, {$this->data['editors_choice_limit']} "));
        $data['products'] = DB::select(DB::raw($query));

        if ($af_load_slider == '1' && $af_category != '0') {
            $category = \DB::table('sh_product_categories')->where('id', $af_category)->first();
            $data['categoryslider'] = \DB::table('tb_sliders')->where('slider_category', $category->category_title)->get();
        }

        return json_encode($data);
    }

    public function contentGridShuffle(Request $request) {

        $af_category = Input::get('af_category');
        $af_search = Input::get('af_search');
        $af_start = Input::get('af_start');
        $af_start = ($af_start != '')? $af_start : 0;
        
        $this->data['articles_limit'] = 6;
        $this->data['editors_choice_limit'] = 1;
        
        $query = "SELECT * FROM tb_post_articles WHERE 1 ";
        if ($af_search != '') {
            $query .= "AND title_pos_1 LIKE '%{$af_search}%' ";
        }
        if ($af_category != '') {
            $query .= "AND cat_id = {$af_category} ";
        }
        $query .= "ORDER BY id DESC ";
        $query .= "LIMIT {$af_start}, {$this->data['articles_limit']} ";
        
        $this->data['articles'] = DB::select(DB::raw($query));
        $this->data['editors_choice_article'] = \DB::table('tb_post_articles')->where('editor_choice', '1')->orderBy('id', 'DESC')->first();
        
        $this->data['new_hotels'] = DB::select(DB::raw("SELECT tb_properties.* FROM tb_properties WHERE property_type = 'Hotel' ORDER BY id DESC LIMIT 4"));
        if(!empty($this->data['new_hotels'])) {
            foreach ($this->data['new_hotels'] as $key => $hotel) {
                $price = \DB::table('tb_properties_category_rooms_price')->where('property_id', $hotel->id)->orderBy('rack_rate', 'ASC')->first();
                $this->data['new_hotels'][$key]->price = 0;
                if (!empty($price)) {
                    $this->data['new_hotels'][$key]->price = $price->rack_rate;
                }
            }
        }
        
        $this->data['featured_articles'] = DB::select(DB::raw("SELECT * FROM tb_post_articles WHERE featured_article = 1"));
        $this->data['categories'] = DB::select(DB::raw("SELECT * FROM tb_news_categories WHERE (SELECT COUNT(*) FROM tb_post_articles WHERE tb_post_articles.cat_id = tb_news_categories.cat_id) > 0 AND cat_status = '1' ORDER BY cat_name ASC"));
        
        $page = 'layouts.' . CNF_THEME . '.index';
        $this->data['pages'] = 'pages.content-grid-shuffle';
        $this->data['pageTitle'] = 'Content';
        return view($page, $this->data);
    }
    
    function ajax_contentGridShuffle(Request $requests) {
        
        $af_category = Input::get('af_category');
        $af_search = Input::get('af_search');
        $af_load_slider = Input::get('af_load_slider');
        $af_start = Input::get('af_start');
        $af_editors_choice_start = Input::get('af_editors_choice_start');

        $this->data['articles_limit'] = 6;
        $this->data['editors_choice_limit'] = 1;

        $query = "SELECT * FROM tb_post_articles WHERE 1 ";
        if ($af_search != '') {
            $query .= "AND title_pos_1 LIKE '%{$af_search}%' ";
        }
        if ($af_category != '') {
            $query .= "AND cat_id = {$af_category} ";
        }
        $query .= "ORDER BY id DESC ";
        $query .= "LIMIT {$af_start}, {$this->data['articles_limit']} ";
        
        $data['articles'] = DB::select(DB::raw($query));
        $data['editors_choice_article'] = DB::select(DB::raw("SELECT * FROM tb_post_articles WHERE editor_choice = 1 ORDER BY id DESC LIMIT {$af_editors_choice_start}, {$this->data['editors_choice_limit']} "));
        $data['new_hotels'] = DB::select(DB::raw("SELECT tb_properties.* FROM tb_properties WHERE property_type = 'Hotel' ORDER BY id DESC LIMIT 4"));
        
        return json_encode($data);
    }
    
    function viewArticleDetails(Request $request) {
        $this->data['row'] = \DB::table('tb_post_articles')->where('id', $request->id)->where('status', '1')->first();

        if (empty($this->data['row'])) {
            Redirect::to('content-grid-shuffle');
        }

        $this->data['category'] = \DB::table('tb_news_categories')->where('cat_id', $this->data['row']->cat_id)->first();
        $this->data['categories'] = DB::select(DB::raw("SELECT * FROM tb_news_categories WHERE (SELECT COUNT(*) FROM tb_post_articles WHERE tb_post_articles.cat_id = tb_news_categories.cat_id) > 0 AND cat_status = '1' ORDER BY cat_name ASC"));
        
        $page = 'layouts.' . CNF_THEME . '.index';
        $this->data['pages'] = 'pages.article_detail';
        $this->data['pageTitle'] = $this->data['row']->title_pos_1;
        return view($page, $this->data);
    }
    
    function getArticleByTitle(Request $request) {

        $title = Input::get('title');

        $data['article'] = \DB::table('tb_post_articles')->where('title_pos_1', $title)->where('status', '1')->first();
        $data['status'] = (empty($data['article'])) ? 'error' : 'ok';

        return json_encode($data);
    }
    
    function getProductByTitle(Request $request) {

        $title = Input::get('title');

        $data['product'] = \DB::table('sh_products')->where('titile', $title)->where('status', 'Enabled')->first();
        $data['status'] = (empty($data['product'])) ? 'error' : 'ok';

        return json_encode($data);
    }

    public function viewShopProduct(Request $request) {

        $this->data['row'] = \DB::table('sh_products')->where('id', $request->id)->where('status', 'Enabled')->first();

        if (empty($this->data['row'])) {
            Redirect::to('product-grid-shuffle');
        }

        if (isset($_POST['add_to_cart'])) {

            $sp_cart = \Session::get('sp_cart');

            if (isset($sp_cart[$this->data['row']->id])) {
                $sp_cart[$this->data['row']->id]->quantity = $_POST['quantity'] + $sp_cart[$this->data['row']->id]->quantity;
            } else {
                $sp_cart[$this->data['row']->id] = $this->data['row'];
                $sp_cart[$this->data['row']->id]->quantity = $_POST['quantity'];
            }

            \Session::put('sp_cart', $sp_cart);
            return Redirect::to('products/' . $this->data['row']->id . '/' . $this->data['row']->slug);
        }

        $this->data['sp_cart'] = \Session::get('sp_cart');

        $this->data['category'] = \DB::table('sh_product_categories')->where('id', $this->data['row']->category)->first();
        $this->data['sub_category'] = \DB::table('sh_product_categories')->where('id', $this->data['row']->sub_category)->first();

        if ($this->data['row']->related_products != '') {
            $this->data['related_products'] = DB::select(DB::raw("SELECT * FROM sh_products WHERE id IN({$this->data['row']->related_products}) AND status = 'Enabled' ORDER BY id DESC LIMIT 4 "));
        }
		
		$this->data['related_cat_products'] = DB::select(DB::raw("SELECT * FROM sh_products WHERE id!='".$this->data['row']->id."' AND category='".$this->data['row']->category."' AND status = 'Enabled' ORDER BY id DESC LIMIT 2 "));

        $this->data['activeCat'] = '';
        $this->data['activeCatTitle'] = '';
        $this->data['categoryslider'] = \DB::table('tb_sliders')->where('slider_category', $request->slug)->get();

        $page = 'layouts.' . CNF_THEME . '.index';
        $this->data['pages'] = 'pages.products';
        $this->data['pageTitle'] = $this->data['row']->titile;
        return view($page, $this->data);
    }

    public function getPropertyByCategory(Request $request) {

        
        $this->data['slug'] = $request->slug;

        if (strtolower($request->slug) == 'yachts') {
            $type = 'Yachts for Charter';
        }

        $propertiesArr = array();
        $page = 1;
        $perPage = 40;
        $currentPage = Input::get('page', 1) - 1;

        $query = "SELECT editor_choice_property,feature_property,id,property_name,property_slug,property_category_id FROM tb_properties WHERE property_type='" . $request->slug . "' AND property_status = '1' ";

        if (isset($request->type)) {
            $type = $request->type;
        }

        if (strtolower($request->slug) == 'yachts') {
            $this->data['type'] = $type;
            $query .= "AND yacht_category LIKE '%{$type}%' ";
        }

        if (isset($request->refine_search)) {
            $query .= "AND yacht_build_year LIKE '%{$request->yacht_build_year}%' ";
            $query .= "AND yachts_guest LIKE '%{$request->yachts_guest}%' ";
            $query .= "AND yacht_length LIKE '%{$request->yacht_length}%' ";
            $query .= "AND yacht_builder LIKE '%{$request->yacht_builder}%' ";
            $query .= "AND yacht_beam LIKE '%{$request->yacht_beam}%' ";
            $query .= "AND yacht_draft LIKE '%{$request->yacht_draft}%' ";
            $query .= "AND yacht_cabins LIKE '%{$request->yacht_cabins}%' ";
            $query .= "AND yacht_crew LIKE '%{$request->yacht_crew}%' ";
        }

        if (strtolower($request->slug) == 'yachts') {
            $query .= "ORDER BY yacht_for_charter * 1 DESC ";
        } else {
            $query .= "ORDER BY editor_choice_property desc, feature_property desc, (SELECT rack_rate FROM tb_properties_category_rooms_price WHERE tb_properties_category_rooms_price.property_id = tb_properties.id ORDER BY rack_rate DESC LIMIT 1) * 1 DESC ";
        }

        $props = DB::select(DB::raw($query));

        if (!empty($props)) {
            $pr = 0;
            foreach ($props as $prop) {
                $propertiesArr[$pr]['data'] = $prop;
                $propertiesArr[$pr]['data']->price = '';
                $checkseasonPrice = \DB::table('tb_properties_category_rooms_price')->select('rack_rate')->where('property_id', $prop->id)->orderBy('rack_rate', 'DESC')->first();
                if (!empty($checkseasonPrice)) {
                    $propertiesArr[$pr]['data']->price = $checkseasonPrice->rack_rate;
                }

                $propertiesArr[$pr]['data']->category_name = '';
                $cateObjtm = \DB::table('tb_categories')->select('category_name')->where('id', $prop->property_category_id)->where('category_published', 1)->first();
                if (!empty($cateObjtm)) {
                    $propertiesArr[$pr]['data']->category_name = $cateObjtm->category_name;
                }

                $fileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.file_id', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $prop->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();
                if (!empty($fileArr)) {
                    $propertiesArr[$pr]['image'] = $fileArr;
                    $propertiesArr[$pr]['image']->imgsrc = (new ContainerController)->getThumbpath($fileArr->folder_id);
                }
                $pr++;
            }
        }
        /* print "<pre>";
          print_r($propertiesArr); die; */

//        usort($propertiesArr, function($a, $b) {
//            return trim($a['data']->property_name) > trim($b['data']->property_name);
//        });

        $pagedData = array_slice($propertiesArr, $currentPage * $perPage, $perPage);
        $pagination = new Paginator($pagedData, count($propertiesArr), $perPage);
        $pagination->setPath(\URL::to('luxurytravel/' . $request->slug));

        $this->data['propertiesArr'] = $pagination;

        $uid = isset(\Auth::user()->id) ? \Auth::user()->id : '';
        $this->data['lightboxes'] = \DB::table('tb_lightbox')->select('box_name','id')->where('user_id', $uid)->get();

        $boxcontent = \DB::table('tb_lightbox_content')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_lightbox_content.file_id')->select('tb_lightbox_content.file_id', 'tb_lightbox_content.id', 'tb_lightbox_content.lightbox_id', 'tb_container_files.file_name', 'tb_container_files.folder_id', 'tb_container_files.file_display_name', 'tb_container_files.file_title')->where('tb_lightbox_content.user_id', $uid)->get();

        $boxcont = array();
        if (!empty($boxcontent)) {
            $l = 0;
            foreach ($boxcontent as $bcontent) {
                $boxcont[$bcontent->lightbox_id][$l]['lightbox'] = $bcontent;
                $fetch_prop_img = \DB::table('tb_properties_images')->join('tb_properties','tb_properties_images.property_id','=','tb_properties.id')->select('property_name')->where('file_id', $bcontent->file_id)->first();
                if (!empty($fetch_prop_img)) {
                    $boxcont[$bcontent->lightbox_id][$l]['property'] = $fetch_prop_img;
                }
                $l++;
            }
        }
        

        $mainArrdestts = array();
        $maindest = \DB::table('tb_categories')->select('id','category_name')->where('parent_category_id', 0)->where('id', '!=', 8)->get();
        if (!empty($maindest)) {
            $d = 0;
            foreach ($maindest as $mdest) {

                $getcats = '';
                $chldIds = array();
                $childdest = \DB::table('tb_categories')->select('id','category_name')->where('parent_category_id', $mdest->id)->get();
                if (!empty($childdest)) {
                    $chldIds = $this->fetchcategoryChildListIds($mdest->id);
                    array_unshift($chldIds, $mdest->id);
                } else {
                    $chldIds[] = $mdest->id;
                }

                if (!empty($chldIds)) {
                    $getcats = " AND (" . implode(" || ", array_map(function($v) {
                                        return sprintf("FIND_IN_SET('%s', property_category_id)", $v);
                                    }, array_values($chldIds))) . ")";
                }

                $preprops = DB::select(DB::raw("SELECT COUNT(*) AS total_rows FROM tb_properties WHERE property_status = '1' $getcats"));

                if (isset($preprops[0]->total_rows) && $preprops[0]->total_rows > 0) {
                    $mainArrdestts[$d] = $mdest;
                    if (!empty($childdest)) {
                        $c = 0;
                        foreach ($childdest as $cdest) {

                            $getcats = '';
                            $chldIds = array();
                            $subchilddest = DB::select(DB::raw("SELECT id,category_name FROM tb_categories WHERE parent_category_id = '{$cdest->id}' AND (SELECT COUNT(*) AS total_rows FROM tb_properties WHERE property_status = '1' AND (FIND_IN_SET(tb_categories.id, property_category_id))) > 0 "));
                            if (!empty($subchilddest)) {
                                $chldIds = $this->fetchcategoryChildListIds($cdest->id);
                                array_unshift($chldIds, $cdest->id);
                            } else {
                                $chldIds[] = $cdest->id;
                            }

                            if (!empty($chldIds)) {
                                $getcats = " AND (" . implode(" || ", array_map(function($v) {
                                                    return sprintf("FIND_IN_SET('%s', property_category_id)", $v);
                                                }, array_values($chldIds))) . ")";
                            }

                            $preprops = DB::select(DB::raw("SELECT COUNT(*) AS total_rows FROM tb_properties WHERE property_status = '1' $getcats"));

                            if (isset($preprops[0]->total_rows) && $preprops[0]->total_rows > 0) {
                                $mainArrdestts[$d]->childs[$c] = $cdest;
                                if (!empty($subchilddest)) {
                                    $mainArrdestts[$d]->childs[$c]->subchild = $subchilddest;
                                }
                                $c++;
                            }
                        }
                    }
                    $d++;
                }
            }
        }

        if (strtolower($request->slug) == 'yachts') {
            $query = "SELECT yacht_build_year FROM tb_properties WHERE property_status = '1' GROUP BY yacht_build_year ORDER BY CAST(yacht_build_year AS UNSIGNED), yacht_build_year ASC ";
            $this->data['yacht_build_years'] = DB::select(DB::raw($query));

            $query = "SELECT yachts_guest FROM tb_properties WHERE property_status = '1' GROUP BY yachts_guest ORDER BY CAST(yachts_guest AS UNSIGNED), yacht_build_year ASC ";
            $this->data['yachts_guests'] = DB::select(DB::raw($query));

            $query = "SELECT yacht_length FROM tb_properties WHERE property_status = '1' GROUP BY yacht_length ORDER BY CAST(yacht_length AS UNSIGNED), yacht_length ASC ";
            $this->data['yacht_lengths'] = DB::select(DB::raw($query));

            $query = "SELECT yacht_builder FROM tb_properties WHERE property_status = '1' GROUP BY yacht_builder ORDER BY yacht_builder ASC ";
            $this->data['yacht_builders'] = DB::select(DB::raw($query));

            $query = "SELECT yacht_beam FROM tb_properties WHERE property_status = '1' GROUP BY yacht_beam ORDER BY CAST(yacht_beam AS UNSIGNED), yacht_beam ASC ";
            $this->data['yacht_beams'] = DB::select(DB::raw($query));

            $query = "SELECT yacht_draft FROM tb_properties WHERE property_status = '1' GROUP BY yacht_draft ORDER BY CAST(yacht_draft AS UNSIGNED), yacht_draft ASC ";
            $this->data['yacht_drafts'] = DB::select(DB::raw($query));

            $query = "SELECT yacht_cabins FROM tb_properties WHERE property_status = '1' GROUP BY yacht_cabins ORDER BY CAST(yacht_cabins AS UNSIGNED), yacht_cabins ASC ";
            $this->data['yacht_cabins'] = DB::select(DB::raw($query));

            $query = "SELECT yacht_crew FROM tb_properties WHERE property_status = '1' GROUP BY yacht_crew ORDER BY CAST(yacht_crew AS UNSIGNED) ASC ";
            $this->data['yacht_crews'] = DB::select(DB::raw($query));
        }

        $this->data['ourmaindesitnation'] = $mainArrdestts;
        $this->data['continent'] = '';
        $this->data['region'] = '';

        $this->data['categoryslider'] = \DB::table('tb_sliders')->select('slider_category','slider_title','slider_description','slider_img','slider_link')->where('slider_category', $request->slug)->get();

        $reultsgridAds = \DB::table('tb_advertisement')->where('adv_type', 'sidebar')->where('ads_cat_id', $request->slug)->where('adv_position', 'grid_results')->get();
        $resultads = array();
        if (!empty($reultsgridAds)) {
            foreach ($reultsgridAds as $ads) {
                $resultads[] = $ads;
            }
        }
        $this->data['reultsgridAds'] = $resultads;

        $this->data['sidebargridAds'] = \DB::table('tb_advertisement')->where('adv_type', 'sidebar')->where('ads_cat_id', $request->slug)->where('adv_position', 'grid_sidebar')->get();

        $this->data['pager'] = $this->injectPaginate();
        $this->data['currentPage'] = $currentPage;
        $this->data['pagination'] = $pagination;
        $this->data['lightcontent'] = $boxcont;
        $this->data['pagecate'] = $request->slug;
        $this->data['uid'] = $uid;
        $this->data['group_id'] = \Session::get('gid');
        $this->data['ps_main_page_name'] = 'category';
        $this->data['pageTitle'] = $request->slug;
        $page = 'layouts.' . CNF_THEME . '.index';
        $this->data['pages'] = 'pages.filters-grid';
        return view($page, $this->data);
    }

    //For our collection 
    public function getPropertyByCategoryQuickView(Request $request) {
        $propertiesArr = array();


        $props = DB::select(DB::raw("SELECT * FROM tb_properties WHERE FIND_IN_SET('$request->id',property_category_id) AND feature_property = '1' ORDER BY editor_choice_property desc"));

        if (!empty($props)) {
            $pr = 0;
            foreach ($props as $prop) {
                $propertiesArr[$pr]['data'] = $prop;
                $fileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $prop->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();
                if (!empty($fileArr)) {
                    $propertiesArr[$pr]['image'] = $fileArr;
                    $propertiesArr[$pr]['image']->imgsrc = (new ContainerController)->getThumbpath($fileArr->folder_id);
                }
                $pr++;
            }
        }

        return response()->json($propertiesArr);
        exit;
    }

    public function getPropertyGalleryQuickView(Request $request) {
        $propertiesArr = array();
        $props = \DB::table('tb_properties')->where('id', $request->id)->where('property_status', 1)->first();

        if (!empty($props)) {
            $propertiesArr['data'] = $props;
            $fileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.type', $request->type)->orderBy('tb_container_files.file_sort_num', 'asc')->get();
            //print_r($fileArr);
            $pr = 0;
            foreach ($fileArr as $file) {
                $propertiesArr['image'][$pr] = $file;
                $propertiesArr['image'][$pr]->imgsrc = (new ContainerController)->getThumbpath($file->folder_id);
                $propertiesArr['image'][$pr]->imgsrc_cache = ImageCache::make(public_path(str_replace(url().'/', '', (new ContainerController)->getThumbpath($file->folder_id).$file->file_name)),100,1000,null);
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
                $propertiesArr['roomimgs']->imgsrc = (new ContainerController)->getThumbpath($roomfileArr->folder_id);
                $propertiesArr['roomimgs']->imgsrc_cache = ImageCache::make(public_path(str_replace(url().'/', '', (new ContainerController)->getThumbpath($roomfileArr->folder_id).$roomfileArr->file_name)),100,1000,null);
                
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

    public function getPropertyByCategoryDestination(Request $request) {

        $propertiesArr = array();
        $CityArrdestts = array();

        $filter_min_price = Input::get('filter_min_price');
        $filter_max_price = Input::get('filter_max_price');

        $getcats = '';
        if (!is_null($request->dest)) {
            $categoryObj = \DB::table('tb_categories')->where('id', $request->dest)->get();
            $cateObj = \DB::table('tb_categories')->where('parent_category_id', $request->dest)->where('category_published', 1)->get();
                        
            $chldIds = array();
            if (!empty($cateObj)) {
                $chldIds = $this->fetchcategoryChildListIds($request->dest);
                array_unshift($chldIds, $request->dest);
            } else {
                $chldIds[] = $request->dest;
            }

            if (!empty($chldIds)) {
                $getcats = " AND (" . implode(" || ", array_map(function($v) {
                                    return sprintf("FIND_IN_SET('%s', property_category_id)", $v);
                                }, array_values($chldIds))) . ")";
            }
        }

        if (isset($request->refine_search) && strtolower($request->cat) == 'yachts') {

            $query = "SELECT id, property_name, property_slug, yacht_for_charter, property_category_id "
                    . "FROM tb_properties "
                    . "WHERE property_type='" . $request->cat . "' "
                    . "AND property_status = '1' ";

            if ($filter_min_price != '' && $filter_max_price != '') {
                $query .= "AND (yacht_for_charter >= '{$filter_min_price}' AND yacht_for_charter <= '{$filter_max_price}') ";
            }

            if (isset($request->yacht_keywords)) {
                $query .= "AND property_name LIKE '%{$request->yacht_keywords}%' ";
            }

            if (isset($request->yacht_category)) {
                $query .= "AND yacht_category LIKE '%{$request->yacht_category}%' ";
            }

            $query .= "AND yacht_build_year LIKE '%{$request->yacht_build_year}%' "
                    . "AND yachts_guest LIKE '%{$request->yachts_guest}%' "
                    . "AND yacht_length LIKE '%{$request->yacht_length}%' "
                    . "AND yacht_builder LIKE '%{$request->yacht_builder}%' "
                    . "AND yacht_beam LIKE '%{$request->yacht_beam}%' "
                    . "AND yacht_draft LIKE '%{$request->yacht_draft}%' "
                    . "AND yacht_cabins LIKE '%{$request->yacht_cabins}%' "
                    . "AND yacht_crew LIKE '%{$request->yacht_crew}%' "
                    . "$getcats "
                    . "ORDER BY (yacht_for_charter * 1) DESC "
                    . "LIMIT $request->startIndex, $request->offset";

            $props = DB::select(DB::raw($query));
        } elseif (strtolower($request->cat) == 'yachts' && $filter_min_price != '' && $filter_max_price != '') {
            $props = DB::select(DB::raw("SELECT id, property_name, property_slug, yacht_for_charter, property_category_id FROM tb_properties WHERE (yacht_for_charter >= '{$filter_min_price}' AND yacht_for_charter <= '{$filter_max_price}') AND property_type='" . $request->cat . "' AND property_status = '1' $getcats ORDER BY CAST(yacht_for_charter AS UNSIGNED), yacht_for_charter DESC LIMIT $request->startIndex, $request->offset"));
        } elseif ($filter_min_price != '' && $filter_max_price != '') {
            $props = DB::select(DB::raw("SELECT id, property_name, property_slug, yacht_for_charter, property_category_id FROM tb_properties WHERE ((SELECT rack_rate FROM tb_properties_category_rooms_price WHERE tb_properties_category_rooms_price.property_id = tb_properties.id ORDER BY rack_rate DESC LIMIT 1) >= '{$filter_min_price}' AND (SELECT rack_rate FROM tb_properties_category_rooms_price WHERE tb_properties_category_rooms_price.property_id = tb_properties.id ORDER BY rack_rate DESC LIMIT 1) <= '{$filter_max_price}') AND property_type='" . $request->cat . "' AND property_status = '1' $getcats ORDER BY (SELECT rack_rate FROM tb_properties_category_rooms_price WHERE tb_properties_category_rooms_price.property_id = tb_properties.id ORDER BY rack_rate DESC LIMIT 1) * 1 DESC LIMIT $request->startIndex, $request->offset"));
        } else {
            $props = DB::select(DB::raw("SELECT id, property_name, property_slug, yacht_for_charter, property_category_id FROM tb_properties WHERE property_type='" . $request->cat . "' AND property_status = '1' $getcats ORDER BY (SELECT rack_rate FROM tb_properties_category_rooms_price WHERE tb_properties_category_rooms_price.property_id = tb_properties.id ORDER BY rack_rate DESC LIMIT 1) * 1 DESC LIMIT $request->startIndex, $request->offset"));
        }

        if (!empty($props)) {
            $pr = 0;
            foreach ($props as $prop) {

                $propertiesArr[$pr]['pdata'] = $prop;
                $propertiesArr[$pr]['pdata']->price = '';

                $checkseasonPrice = \DB::table('tb_properties_category_rooms_price')->where('property_id', $prop->id)->orderBy('rack_rate', 'DESC')->first();
                if (!empty($checkseasonPrice)) {
                    $propertiesArr[$pr]['pdata']->price = $checkseasonPrice->rack_rate;
                }
                if (strtolower($request->cat) == 'yachts') {
                    $propertiesArr[$pr]['pdata']->price = $prop->yacht_for_charter;
                }
                $fileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $prop->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();
                if (!empty($fileArr)) {
                    $propertiesArr[$pr]['image'] = $fileArr;
                    $propertiesArr[$pr]['image']->imgsrc = (new ContainerController)->getThumbpath($fileArr->folder_id);
                }

                $propertiesArr[$pr]['pdata']->category_name = '';
                $cateObjtm = \DB::table('tb_categories')->where('id', $prop->property_category_id)->where('category_published', 1)->first();
                if (!empty($cateObjtm)) {
                    $propertiesArr[$pr]['pdata']->category_name = $cateObjtm->category_name;
                }

                $pr++;
            }
        }

        if (!is_null($request->area)) {
            $citydest = \DB::table('tb_categories')->where('parent_category_id', $request->dest)->get();
            if (!empty($citydest)) {
                $d = 0;
                foreach ($citydest as $cdest) {
                    $cityprops = DB::select(DB::raw("SELECT id FROM tb_properties WHERE FIND_IN_SET('$cdest->id',property_category_id) AND property_type='" . $request->cat . "' AND property_status = '1'"));
                    if (!empty($cityprops)) {
                        $CityArrdestts[$d] = $cdest;
                        $CityArrdestts[$d]->totalproperty = count($cityprops);
                        $d++;
                    }
                }
            }
        }

        if (!empty($propertiesArr)) {
//            usort($propertiesArr, function($a, $b) {
//                return trim($a['pdata']->property_name) > trim($b['pdata']->property_name);
//            });
//            usort($propertiesArr, function($a, $b) {
//                return trim($a['pdata']->price) < trim($b['pdata']->price);
//            });

            $rep['status'] = 'success';
            $rep['properties'] = json_encode($propertiesArr);
            $rep['cities'] = json_encode($CityArrdestts);
            if(isset($cateObj[0]->category_name)) {
                $rep['category_name'] = $categoryObj[0]->category_name;
            }
            else {
                $rep['category_name'] = '';
            }
            return json_encode($rep);
        } else {
            $rep['status'] = 'error';
            $rep['errors'] = 'No ' . $request->cat . ' Found';
            return json_encode($rep);
        }
    }

    public function getPropertyBySearchDestination(Request $request) {
        $props = array();
        $perPage = 20;
        $currentPage = Input::get('page', 1) - 1;
        $propertiesArr = array();
        $CityArrdestts = array();
        $getcats = '';
        $keyword = Input::get('s');

        $filter_min_price = Input::get('filter_min_price');
        $filter_max_price = Input::get('filter_max_price');

        if (!is_null($request->dest)) {
            $cateObjtm = \DB::table('tb_categories')->where('id', $request->dest)->where('category_published', 1)->first();
            if (!empty($cateObjtm)) {
                $rep['searchdestname'] = $cateObjtm->category_name;
            }
            $cateObj = \DB::table('tb_categories')->where('parent_category_id', $request->dest)->where('category_published', 1)->get();
            $chldIds = array();
            if (!empty($cateObj)) {
                $chldIds = $this->fetchcategoryChildListIds($request->dest);
                array_unshift($chldIds, $request->dest);
            } else {
                $chldIds[] = $request->dest;
            }

            if (!empty($chldIds)) {
                $getcats = " AND (" . implode(" || ", array_map(function($v) {
                                    return sprintf("FIND_IN_SET('%s', property_category_id)", $v);
                                }, array_values($chldIds))) . ")";
            }
        }
        $TagsObj = \DB::table('tb_tags_manager')->where('tag_title', Input::get('s', false))->where('tag_status', 1)->first();
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
                                    //$props = \DB::table('tb_properties')->where('property_name',$ConObjs->display_name)->where('property_status',1)->first();

                                    $preprops = DB::select(DB::raw("SELECT id,property_name,property_slug FROM tb_properties WHERE tb_properties.property_type = 'Hotel' AND property_name='" . $ConObjs->display_name . "' AND property_status = '1' $getcats ORDER BY id asc LIMIT 1"));

                                    if (!empty($preprops)) {
                                        foreach ($preprops as $props) {

                                            if ($filter_min_price != '' && $filter_max_price != '') {
                                                $checkseasonPrice = \DB::table('tb_properties_category_rooms_price')->where('property_id', $props->id)->orderBy('rack_rate', 'DESC')->first();
                                                if (!empty($checkseasonPrice) && $checkseasonPrice->rack_rate >= $filter_min_price && $checkseasonPrice->rack_rate <= $filter_max_price) {

                                                    $propertiesArr[$props->id]['pdata'] = $props;
                                                    $propertiesArr[$props->id]['pdata']->price = $checkseasonPrice->rack_rate;
                                                    $fileArrT = \DB::table('tb_properties_images')->where('property_id', $props->id)->where('file_id', $TagsConObj->container_id)->where('tb_properties_images.type', 'Property Images')->first();
                                                    if (!empty($fileArrT)) {
                                                        $fileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.file_id', $fileArrT->file_id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();

                                                        if (!empty($fileArr)) {
                                                            $propertiesArr[$props->id]['image'] = $fileArr;
                                                            $propertiesArr[$props->id]['image']->imgsrc = (new ContainerController)->getThumbpath($fileArr->folder_id);
                                                        }
                                                        $pr++;
                                                    }
                                                }
                                            } else {
                                                $propertiesArr[$props->id]['pdata'] = $props;
                                                $propertiesArr[$props->id]['pdata']->price = '';
                                                $checkseasonPrice = \DB::table('tb_properties_category_rooms_price')->where('property_id', $props->id)->orderBy('rack_rate', 'DESC')->first();
                                                if (!empty($checkseasonPrice)) {
                                                    $propertiesArr[$props->id]['pdata']->price = $checkseasonPrice->rack_rate;
                                                }
                                                $fileArrT = \DB::table('tb_properties_images')->where('property_id', $props->id)->where('file_id', $TagsConObj->container_id)->where('tb_properties_images.type', 'Property Images')->first();
                                                if (!empty($fileArrT)) {
                                                    $fileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.file_id', $fileArrT->file_id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();

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
                        }
                    } else {
                        $ConObjs = \DB::table('tb_container')->select('display_name')->where('id', $TagsConObj->container_id)->first();

                        if (!empty($ConObjs)) {
                            //$props = \DB::table('tb_properties')->where('property_name',$ConObjs->display_name)->where('property_status',1)->first();
                            $preprops = DB::select(DB::raw("SELECT id,property_name,property_slug FROM tb_properties WHERE tb_properties.property_type = 'Hotel' AND property_name='" . $ConObjs->display_name . "' AND property_status = '1' $getcats ORDER BY id asc  LIMIT 1"));

                            if (!empty($preprops)) {
                                foreach ($preprops as $props) {

                                    if ($filter_min_price != '' && $filter_max_price != '') {
                                        $checkseasonPrice = \DB::table('tb_properties_category_rooms_price')->where('property_id', $props->id)->orderBy('rack_rate', 'DESC')->first();
                                        if (!empty($checkseasonPrice) && $checkseasonPrice->rack_rate >= $filter_min_price && $checkseasonPrice->rack_rate <= $filter_max_price) {

                                            $propertiesArr[$props->id]['pdata'] = $props;
                                            $propertiesArr[$props->id]['pdata']->price = $checkseasonPrice->rack_rate;
                                            $fileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();

                                            if (!empty($fileArr)) {
                                                $propertiesArr[$props->id]['image'] = $fileArr;
                                                $propertiesArr[$props->id]['image']->imgsrc = (new ContainerController)->getThumbpath($fileArr->folder_id);
                                            }
                                            $pr++;
                                        }
                                    } else {
                                        $propertiesArr[$props->id]['pdata'] = $props;
                                        $propertiesArr[$props->id]['pdata']->price = '';
                                        $checkseasonPrice = \DB::table('tb_properties_category_rooms_price')->where('property_id', $props->id)->orderBy('rack_rate', 'DESC')->first();
                                        if (!empty($checkseasonPrice)) {
                                            $propertiesArr[$props->id]['pdata']->price = $checkseasonPrice->rack_rate;
                                        }
                                        $fileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $props->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();

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
            }
        }

        //$seaprops = \DB::table('tb_properties')->where('property_name', 'like', '%'.$keyword.'%')->where('property_status',1)->get();
        $seaprops = DB::select(DB::raw("SELECT id,property_name,property_slug FROM tb_properties WHERE tb_properties.property_type = 'Hotel' AND property_name like '%$keyword%' AND property_status = '1' $getcats ORDER BY id asc"));
        if (!empty($seaprops)) {
            foreach ($seaprops as $sprop) {

                if ($filter_min_price != '' && $filter_max_price != '') {
                    $checkseasonPrice = \DB::table('tb_properties_category_rooms_price')->where('property_id', $sprop->id)->orderBy('rack_rate', 'DESC')->first();
                    if (!empty($checkseasonPrice) && $checkseasonPrice->rack_rate >= $filter_min_price && $checkseasonPrice->rack_rate <= $filter_max_price) {

                        $propertiesArr[$sprop->id]['pdata'] = $sprop;
                        $propertiesArr[$sprop->id]['pdata']->price = $checkseasonPrice->rack_rate;
                        $sfileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $sprop->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();

                        if (!empty($sfileArr)) {
                            $propertiesArr[$sprop->id]['image'] = $sfileArr;
                            $propertiesArr[$sprop->id]['image']->imgsrc = (new ContainerController)->getThumbpath($sfileArr->folder_id);
                        }
                        $pr++;
                    }
                } else {
                    $propertiesArr[$sprop->id]['pdata'] = $sprop;
                    $propertiesArr[$sprop->id]['pdata']->price = '';
                    $checkseasonPrice = \DB::table('tb_properties_category_rooms_price')->where('property_id', $sprop->id)->orderBy('rack_rate', 'DESC')->first();
                    if (!empty($checkseasonPrice)) {
                        $propertiesArr[$sprop->id]['pdata']->price = $checkseasonPrice->rack_rate;
                    }
                    $sfileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $sprop->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();

                    if (!empty($sfileArr)) {
                        $propertiesArr[$sprop->id]['image'] = $sfileArr;
                        $propertiesArr[$sprop->id]['image']->imgsrc = (new ContainerController)->getThumbpath($sfileArr->folder_id);
                    }
                    $pr++;
                }
            }
        }

        if (!is_null($request->dest)) {
            $catprops = DB::select(DB::raw("SELECT id,property_name,property_slug FROM tb_properties WHERE tb_properties.property_type = 'Hotel' AND property_status = '1' $getcats ORDER BY id asc"));
            if (!empty($catprops)) {
                foreach ($catprops as $cprop) {

                    if ($filter_min_price != '' && $filter_max_price != '') {
                        $checkseasonPrice = \DB::table('tb_properties_category_rooms_price')->where('property_id', $cprop->id)->orderBy('rack_rate', 'DESC')->first();
                        if (!empty($checkseasonPrice) && $checkseasonPrice->rack_rate >= $filter_min_price && $checkseasonPrice->rack_rate <= $filter_max_price) {

                            $propertiesArr[$cprop->id]['pdata'] = $cprop;
                            $propertiesArr[$cprop->id]['pdata']->price = $checkseasonPrice->rack_rate;
                            $sfileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $cprop->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();

                            if (!empty($sfileArr)) {
                                $propertiesArr[$cprop->id]['image'] = $sfileArr;
                                $propertiesArr[$cprop->id]['image']->imgsrc = (new ContainerController)->getThumbpath($sfileArr->folder_id);
                            }
                            $pr++;
                        }
                    } else {
                        $propertiesArr[$cprop->id]['pdata'] = $cprop;
                        $propertiesArr[$cprop->id]['pdata']->price = '';
                        $checkseasonPrice = \DB::table('tb_properties_category_rooms_price')->where('property_id', $cprop->id)->orderBy('rack_rate', 'DESC')->first();
                        if (!empty($checkseasonPrice)) {
                            $propertiesArr[$cprop->id]['pdata']->price = $checkseasonPrice->rack_rate;
                        }
                        $sfileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $cprop->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();

                        if (!empty($sfileArr)) {
                            $propertiesArr[$cprop->id]['image'] = $sfileArr;
                            $propertiesArr[$cprop->id]['image']->imgsrc = (new ContainerController)->getThumbpath($sfileArr->folder_id);
                        }
                        $pr++;
                    }
                }
            }
        } else {
            //$catprops = \DB::select( DB::raw("SELECT * FROM tb_properties WHERE FIND_IN_SET('".$chld."',property_category_id) AND property_status='1' ") );
            $scateObj = \DB::table('tb_categories')->where('category_name', Input::get('s', false))->where('category_published', 1)->first();
            $sgetcats = '';
            $schldIds = array();
            if (!empty($scateObj)) {
                $cateObjtemp = \DB::table('tb_categories')->where('parent_category_id', $scateObj->id)->where('category_published', 1)->get();
                if (!empty($cateObjtemp)) {
                    $schldIds = $this->fetchcategoryChildListIds($scateObj->id);
                    array_unshift($schldIds, $scateObj->id);
                } else {
                    $schldIds[] = $scateObj->id;
                }

                if (!empty($schldIds)) {
                    $sgetcats = " AND (" . implode(" || ", array_map(function($v) {
                                        return sprintf("FIND_IN_SET('%s', property_category_id)", $v);
                                    }, array_values($schldIds))) . ")";
                }

                $catprops = DB::select(DB::raw("SELECT id,property_name,property_slug FROM tb_properties WHERE tb_properties.property_type = 'Hotel' AND property_status = '1' $sgetcats ORDER BY id asc"));
                if (!empty($catprops)) {
                    foreach ($catprops as $cprop) {
                        if ($filter_min_price != '' && $filter_max_price != '') {
                            $checkseasonPrice = \DB::table('tb_properties_category_rooms_price')->where('property_id', $cprop->id)->orderBy('rack_rate', 'DESC')->first();
                            if (!empty($checkseasonPrice) && $checkseasonPrice->rack_rate >= $filter_min_price && $checkseasonPrice->rack_rate <= $filter_max_price) {

                                $propertiesArr[$cprop->id]['pdata'] = $cprop;
                                $propertiesArr[$cprop->id]['pdata']->price = $checkseasonPrice->rack_rate;
                                $sfileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $cprop->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();

                                if (!empty($sfileArr)) {
                                    $propertiesArr[$cprop->id]['image'] = $sfileArr;
                                    $propertiesArr[$cprop->id]['image']->imgsrc = (new ContainerController)->getThumbpath($sfileArr->folder_id);
                                }
                                $pr++;
                            }
                        } else {
                            $propertiesArr[$cprop->id]['pdata'] = $cprop;
                            $propertiesArr[$cprop->id]['pdata']->price = '';
                            $checkseasonPrice = \DB::table('tb_properties_category_rooms_price')->where('property_id', $cprop->id)->orderBy('rack_rate', 'DESC')->first();
                            if (!empty($checkseasonPrice)) {
                                $propertiesArr[$cprop->id]['pdata']->price = $checkseasonPrice->rack_rate;
                            }
                            $sfileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $cprop->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();

                            if (!empty($sfileArr)) {
                                $propertiesArr[$cprop->id]['image'] = $sfileArr;
                                $propertiesArr[$cprop->id]['image']->imgsrc = (new ContainerController)->getThumbpath($sfileArr->folder_id);
                            }
                            $pr++;
                        }
                    }
                }
            }
        }

        usort($propertiesArr, function($a, $b) {
            return trim($a['pdata']->property_name) > trim($b['pdata']->property_name);
        });
        usort($propertiesArr, function($a, $b) {
            return trim($a['pdata']->price) < trim($b['pdata']->price);
        });

        //echo count($propertiesArr);
        $pagedData = array_slice($propertiesArr, $currentPage * $perPage, $perPage);
        $pagination = new Paginator($pagedData, count($propertiesArr), $perPage);

        //print_r($pagination);

        if (!is_null($request->area)) {
            $citydest = \DB::table('tb_categories')->where('parent_category_id', $request->dest)->get();
            if (!empty($citydest)) {
                $d = 0;
                foreach ($citydest as $cdest) {
                    $cityprops = DB::select(DB::raw("SELECT id FROM tb_properties WHERE tb_properties.property_type = 'Hotel' AND FIND_IN_SET('$cdest->id',property_category_id) AND property_status = '1'"));
                    if (!empty($cityprops)) {
                        $CityArrdestts[$d] = $cdest;
                        $CityArrdestts[$d]->totalproperty = count($cityprops);
                        $d++;
                    }
                }
            }
        }

        if (!empty($pagination)) {
            $tempproperties = array();
            foreach ($pagination as $pag) {
                $tempproperties[] = $pag;
            }
            //print_r($tempproperties);
            $pager = $this->injectPaginate();

            if (!is_null($request->dest) && $request->current_filter == 'destination') {
                $cateObjtm = \DB::table('tb_categories')->where('id', $request->dest)->where('category_published', 1)->first();
                if (!empty($cateObjtm)) {
                    $rep['categoryslider'] = \DB::table('tb_sliders')->where('slider_category', $cateObjtm->category_name)->get();
                }
            } else {
                $rep['categoryslider'] = \DB::table('tb_sliders')->where('slider_category', Input::get('s', false))->get();
            }

            $rep['status'] = 'success';
            $rep['properties'] = json_encode($tempproperties);
            $rep['cities'] = json_encode($CityArrdestts);
            $rep['ttlpages'] = $pagination->appends($pager)->lastPage();
            $rep['ttl'] = count($propertiesArr);
            return json_encode($rep);
        } else {
            $rep['status'] = 'error';
            $rep['errors'] = 'No Record Found';
            return json_encode($rep);
        }
    }

    /*
     * AI booking function
     */

    function new_room_booking(Request $request) {

        $uid = 0;
        $rules['roomType'] = 'required';
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {

            if (\Auth::check()) {
                $uid = \Auth::user()->id;
                $userdet = \DB::table('tb_users')->where('id', $uid)->first();
            }
            $props = \DB::table('tb_properties')->where('id', $request->input('property'))->first();
            $curnDate = date('Y-m-d');
            $price = 0;
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
                        $checkseasonPrice = \DB::table('tb_properties_category_rooms_price')->where('season_id', $checkseason[$sc]->id)->where('property_id', $props->id)->where('category_id', $request->input('roomType'))->first();
                        if (!empty($checkseasonPrice)) {
                            $price = $checkseasonPrice->rack_rate;
                            $foundsean = true;
                        }
                    }
                }
                if ($foundsean != true) {
                    $checkseasonPrice_ifnotforloop = \DB::table('tb_properties_category_rooms_price')->where('season_id', 0)->where('property_id', $props->id)->where('category_id', $request->input('roomType'))->first();
                    if (!empty($checkseasonPrice_ifnotforloop)) {
                        $price = $checkseasonPrice_ifnotforloop->rack_rate;
                    }
                }
            } else {
                $checkseasonPrice_ifnotanyseason = \DB::table('tb_properties_category_rooms_price')->where('season_id', 0)->where('property_id', $props->id)->where('category_id', $request->input('roomType'))->first();
                if (!empty($checkseasonPrice_ifnotanyseason)) {
                    $price = $checkseasonPrice_ifnotanyseason->rack_rate;
                }
            }

            /*
             * Save reservation data
             */

            $data['property_id'] = $request->input('property');
            $data['checkin_date'] = date("Y-m-d", strtotime($request->input('booking_arrive')));
            $data['checkout_date'] = date("Y-m-d", strtotime($request->input('booking_destination')));
            $data['type_id'] = $request->input('roomType');
            $data['number_of_nights'] = $request->input('number_of_nights');
            $data['organizing_transfers'] = (!is_null($request->input('organizing_transfers')) && $request->input('organizing_transfers') != '') ? 'Yes' : 'No';
            $data['client_id'] = $uid;
            $data['source'] = 'Direct reservation';
            $data['guest_title'] = $request->input('guest_title');
            $data['guest_names'] = $request->input('guest_first_name') . ' ' . $request->input('guest_last_name');
            $data['guest_birthday'] = $request->input('guest_birthday_yyyy') . '-' . $request->input('guest_birthday_mm') . '-' . $request->input('guest_birthday_dd');
            $data['guest_address'] = $request->input('guest_address');
            $data['guest_city'] = $request->input('guest_city');
            $data['guest_zip_code'] = $request->input('guest_zip_code');
            $data['guest_country'] = $request->input('guest_country');
            $data['guest_landline_code'] = $request->input('guest_landline_code');
            $data['guest_landline_number'] = $request->input('guest_landline_number');
            $data['guest_mobile_code'] = $request->input('guest_mobile_code');
            $data['guest_mobile_number'] = $request->input('guest_mobile_number');
            $data['guest_email'] = $request->input('guest_email');
            $data['price'] = $price;
            $data['price_mode'] = 'daily';
            $data['created_by'] = $uid;
            $data['created_date'] = date('Y-m-d h:i:s');

            $resid = \DB::table('tb_reservations')->insertGetId($data);

            /*
             * Rooms data
             */

            $booking_adults = $request->input('booking_adults');
            $booking_children = $request->input('booking_children');

            if (!empty($booking_adults)) {
                foreach ($booking_adults as $key => $booking_adult) {
                    $rooms_data['reservation_id'] = $resid;
                    $rooms_data['type_id'] = $request->input('roomType');
                    $rooms_data['booking_adults'] = $booking_adult;
                    $rooms_data['booking_children'] = $booking_children[$key];
                    \DB::table('td_reserved_rooms')->insertGetId($rooms_data);
                }
            }

            /*
             * Save booking preferences
             */

            $bp_data['reservation_id'] = $resid;
            $bp_data['already_stayed'] = $request->input('already_stayed');
            $bp_data['arrival_time'] = $request->input('arrival_time_hh') . ':' . $request->input('arrival_time_mm');
            $bp_data['first_name'] = $request->input('bp_first_name');
            $bp_data['last_name'] = $request->input('bp_last_name');
            $bp_data['relationship'] = $request->input('relationship');
            $bp_data['purpose_of_stay'] = $request->input('purpose_of_stay');
            $bp_data['stay_details'] = $request->input('stay_details');
            $bp_data['desired_room_temperature'] = $request->input('desired_room_temperature');
            $bp_data['smoking_preference'] = $request->input('smoking_preference');
            $bp_data['rollaway_bed'] = (!is_null($request->input('rollaway_bed')) && $request->input('rollaway_bed') != '') ? 'Yes' : 'No';
            $bp_data['crib'] = (!is_null($request->input('crib')) && $request->input('crib') != '') ? 'Yes' : 'No';
            $bp_data['wheelchair_accessible'] = (!is_null($request->input('wheelchair_accessible')) && $request->input('wheelchair_accessible') != '') ? 'Yes' : 'No';
            $bp_data['generally_am_size'] = $request->input('generally_am_size');
            $bp_data['pillow_firmness'] = $request->input('pillow_firmness');
            $bp_data['pillow_type'] = $request->input('pillow_type');
            $bp_data['bed_style'] = $request->input('bed_style');
            $bp_data['generally_sleep_on'] = $request->input('generally_sleep_on');
            $bp_data['art'] = (!is_null($request->input('art')) && $request->input('art') != '') ? 'Yes' : 'No';
            $bp_data['architecture_interior_design'] = (!is_null($request->input('architecture_interior_design')) && $request->input('architecture_interior_design') != '') ? 'Yes' : 'No';
            $bp_data['cigars'] = (!is_null($request->input('cigars')) && $request->input('cigars') != '') ? 'Yes' : 'No';
            $bp_data['dance'] = (!is_null($request->input('dance')) && $request->input('dance') != '') ? 'Yes' : 'No';
            $bp_data['fashion'] = (!is_null($request->input('fashion')) && $request->input('fashion') != '') ? 'Yes' : 'No';
            $bp_data['gastronomy'] = (!is_null($request->input('gastronomy')) && $request->input('gastronomy') != '') ? 'Yes' : 'No';
            $bp_data['literature'] = (!is_null($request->input('literature')) && $request->input('literature') != '') ? 'Yes' : 'No';
            $bp_data['music'] = (!is_null($request->input('music')) && $request->input('music') != '') ? 'Yes' : 'No';
            $bp_data['nature'] = (!is_null($request->input('nature')) && $request->input('nature') != '') ? 'Yes' : 'No';
            $bp_data['photography'] = (!is_null($request->input('photography')) && $request->input('photography') != '') ? 'Yes' : 'No';
            $bp_data['science'] = (!is_null($request->input('science')) && $request->input('science') != '') ? 'Yes' : 'No';
            $bp_data['technology'] = (!is_null($request->input('technology')) && $request->input('technology') != '') ? 'Yes' : 'No';
            $bp_data['travel'] = (!is_null($request->input('travel')) && $request->input('travel') != '') ? 'Yes' : 'No';
            $bp_data['watches'] = (!is_null($request->input('watches')) && $request->input('watches') != '') ? 'Yes' : 'No';
            $bp_data['wines_spirits'] = (!is_null($request->input('wines_spirits')) && $request->input('wines_spirits') != '') ? 'Yes' : 'No';
            $bp_data['other_interests'] = $request->input('other_interests');
            $bp_data['snorkeling'] = (!is_null($request->input('snorkeling')) && $request->input('snorkeling') != '') ? 'Yes' : 'No';
            $bp_data['diving'] = (!is_null($request->input('diving')) && $request->input('diving') != '') ? 'Yes' : 'No';
            $bp_data['sailing'] = (!is_null($request->input('sailing')) && $request->input('sailing') != '') ? 'Yes' : 'No';
            $bp_data['tennis'] = (!is_null($request->input('tennis')) && $request->input('tennis') != '') ? 'Yes' : 'No';
            $bp_data['golf'] = (!is_null($request->input('golf')) && $request->input('golf') != '') ? 'Yes' : 'No';
            $bp_data['motorized_water_sports'] = (!is_null($request->input('motorized_water_sports')) && $request->input('motorized_water_sports') != '') ? 'Yes' : 'No';
            $bp_data['spa_treatments'] = (!is_null($request->input('spa_treatments')) && $request->input('spa_treatments') != '') ? 'Yes' : 'No';
            $bp_data['hair_treatments'] = (!is_null($request->input('hair_treatments')) && $request->input('hair_treatments') != '') ? 'Yes' : 'No';
            $bp_data['fitness'] = (!is_null($request->input('fitness')) && $request->input('fitness') != '') ? 'Yes' : 'No';
            $bp_data['pool'] = (!is_null($request->input('pool')) && $request->input('pool') != '') ? 'Yes' : 'No';
            $bp_data['yoga'] = (!is_null($request->input('yoga')) && $request->input('yoga') != '') ? 'Yes' : 'No';
            $bp_data['pilates'] = (!is_null($request->input('pilates')) && $request->input('pilates') != '') ? 'Yes' : 'No';
            $bp_data['meditation'] = (!is_null($request->input('meditation')) && $request->input('meditation') != '') ? 'Yes' : 'No';
            $bp_data['prefer_language'] = ($request->input('prefer_language') == 'Other') ? $request->input('prefer_language_other') : $request->input('prefer_language');
            $bp_data['vegetarian'] = (!is_null($request->input('vegetarian')) && $request->input('vegetarian') != '') ? 'Yes' : 'No';
            $bp_data['halal'] = (!is_null($request->input('halal')) && $request->input('halal') != '') ? 'Yes' : 'No';
            $bp_data['kosher'] = (!is_null($request->input('kosher')) && $request->input('kosher') != '') ? 'Yes' : 'No';
            $bp_data['gluten_free'] = (!is_null($request->input('gluten_free')) && $request->input('gluten_free') != '') ? 'Yes' : 'No';
            $bp_data['ovo_lactarian'] = (!is_null($request->input('ovo_lactarian')) && $request->input('ovo_lactarian') != '') ? 'Yes' : 'No';
            $bp_data['favourite_dishes'] = $request->input('favourite_dishes');
            $bp_data['food_allergies'] = $request->input('food_allergies');
            $bp_data['known_allergies'] = $request->input('known_allergies');
            $bp_data['savory_snacks'] = (!is_null($request->input('savory_snacks')) && $request->input('savory_snacks') != '') ? 'Yes' : 'No';
            $bp_data['any_sweet_snacks'] = (!is_null($request->input('any_sweet_snacks')) && $request->input('any_sweet_snacks') != '') ? 'Yes' : 'No';
            $bp_data['chocolate_based_pastries'] = (!is_null($request->input('chocolate_based_pastries')) && $request->input('chocolate_based_pastries') != '') ? 'Yes' : 'No';
            $bp_data['fruit_based_pastries'] = (!is_null($request->input('fruit_based_pastries')) && $request->input('fruit_based_pastries') != '') ? 'Yes' : 'No';
            $bp_data['seasonal_fruits'] = (!is_null($request->input('seasonal_fruits')) && $request->input('seasonal_fruits') != '') ? 'Yes' : 'No';
            $bp_data['exotic_fruits'] = (!is_null($request->input('exotic_fruits')) && $request->input('exotic_fruits') != '') ? 'Yes' : 'No';
            $bp_data['dried_fruits_and_nuts'] = (!is_null($request->input('dried_fruits_and_nuts')) && $request->input('dried_fruits_and_nuts') != '') ? 'Yes' : 'No';
            $bp_data['espresso'] = (!is_null($request->input('espresso')) && $request->input('espresso') != '') ? 'Yes' : 'No';
            $bp_data['cafe_au_lait'] = (!is_null($request->input('cafe_au_lait')) && $request->input('cafe_au_lait') != '') ? 'Yes' : 'No';
            $bp_data['tea'] = (!is_null($request->input('tea')) && $request->input('tea') != '') ? 'Yes' : 'No';
            $bp_data['herbal_tea'] = (!is_null($request->input('herbal_tea')) && $request->input('herbal_tea') != '') ? 'Yes' : 'No';
            $bp_data['hot_chocolate'] = (!is_null($request->input('hot_chocolate')) && $request->input('hot_chocolate') != '') ? 'Yes' : 'No';
            $bp_data['coca'] = (!is_null($request->input('coca')) && $request->input('coca') != '') ? 'Yes' : 'No';
            $bp_data['diet_coke'] = (!is_null($request->input('diet_coke')) && $request->input('diet_coke') != '') ? 'Yes' : 'No';
            $bp_data['pepsi'] = (!is_null($request->input('pepsi')) && $request->input('pepsi') != '') ? 'Yes' : 'No';
            $bp_data['diet_pepsi'] = (!is_null($request->input('diet_pepsi')) && $request->input('diet_pepsi') != '') ? 'Yes' : 'No';
            $bp_data['orange_soda'] = (!is_null($request->input('orange_soda')) && $request->input('orange_soda') != '') ? 'Yes' : 'No';
            $bp_data['lemon_soda'] = (!is_null($request->input('lemon_soda')) && $request->input('lemon_soda') != '') ? 'Yes' : 'No';
            $bp_data['served_with_lemon'] = (!is_null($request->input('served_with_lemon')) && $request->input('served_with_lemon') != '') ? 'Yes' : 'No';
            $bp_data['served_with_ice_cubes'] = (!is_null($request->input('served_with_ice_cubes')) && $request->input('served_with_ice_cubes') != '') ? 'Yes' : 'No';
            $bp_data['preferred_aperitif'] = $request->input('preferred_aperitif');
            $bp_data['upcoming_visit_remarks'] = $request->input('upcoming_visit_remarks');

            \DB::table('td_booking_preferences')->insertGetId($bp_data);

            /*
             * Save user info
             */

            $userData['title'] = $request->input('title');
            $userData['first_name'] = $request->input('first_name');
            $userData['last_name'] = $request->input('last_name');
            $userData['birthday'] = $request->input('birthday_yyyy') . '-' . $request->input('birthday_mm') . '-' . $request->input('birthday_dd');
            $userData['address'] = $request->input('address');
            $userData['city'] = $request->input('city');
            $userData['zip_code'] = $request->input('zip_code');
            $userData['country'] = $request->input('country');
            $userData['landline_code'] = $request->input('landline_code');
            $userData['landline_number'] = $request->input('landline_number');
            $userData['mobile_code'] = $request->input('mobile_code');
            $userData['mobile_number'] = $request->input('mobile_number');
            $userData['email'] = $request->input('email');
            $userData['prefer_communication_with'] = $request->input('prefer_communication_with');

            $userData['card_number'] = base64_encode($request->input('card_number'));
            $userData['card_type'] = base64_encode($request->input('card_type'));
            $userData['expiry_month'] = base64_encode($request->input('expiry_month'));
            $userData['expiry_year'] = base64_encode($request->input('expiry_year'));

            $checkUser = \DB::table('tb_users')->where('email', $request->input('email'))->get();

            if (empty($checkUser)) {

                $userData['username'] = $request->input('email');
                $userData['password'] = \Hash::make($request->input('password'));
                $userData['group_id'] = 3;
                $userData['active'] = 1;
                $userData['last_login'] = date("Y-m-d H:i:s");
                $userData['created_at'] = date('Y-m-d h:i:s');

                $user_id = \DB::table('tb_users')->insertGetId($userData);
                \DB::table('tb_reservations')->where('id', $resid)->update(array('client_id' => $user_id));
            } else {
                \DB::table('tb_users')->where('id', $uid)->update($userData);
            }

            /*
             * Send email notification
             */

            $reservation = \DB::table('tb_reservations')->where('id', $resid)->first();
            $preferences = \DB::table('td_booking_preferences')->where('reservation_id', $reservation->id)->first();
            $rooms = \DB::table('td_reserved_rooms')->where('reservation_id', $reservation->id)->get();
            $user_info = \DB::table('tb_users')->where('id', $reservation->client_id)->first();
            $property = \DB::table('tb_properties')->where('id', $reservation->property_id)->first();
            $type = \DB::table('tb_properties_category_types')->where('id', $reservation->type_id)->first();
            $type_image = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $reservation->property_id)->where('tb_properties_images.category_id', $reservation->type_id)->where('tb_properties_images.type', 'Rooms Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();
            $type_image->imgsrc = (new ContainerController)->getThumbpath($type_image->folder_id);
            $hotel_terms_n_conditions = \DB::table('td_property_terms_n_conditions')->where('property_id', $reservation->property_id)->first();
            $reserved_rooms = \DB::table('td_reserved_rooms')->where('reservation_id', $reservation->id)->get();

            $bookingEmail = base_path() . "/resources/views/user/emails/booking_notification.blade.php";
            $bookingEmailTemplate = file_get_contents($bookingEmail);

            $bookingEmailTemplate = str_replace('{reservation_id}', 'DL-' . date('d.m.y') . '-' . $reservation->id, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{checkin_date}', date('M d, Y', strtotime($reservation->checkin_date)), $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{checkout_date}', date('M d, Y', strtotime($reservation->checkout_date)), $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{price}', '€' . $reservation->price, $bookingEmailTemplate);

            $bookingEmailTemplate = str_replace('{already_stayed}', $preferences->already_stayed, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{family_name}', trim($preferences->first_name . ' ' . $preferences->last_name), $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{relationship}', $preferences->relationship, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{purpose_of_stay}', $preferences->purpose_of_stay, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{stay_details}', $preferences->stay_details, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{desired_room_temperature}', $preferences->desired_room_temperature, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{smoking_preference}', $preferences->smoking_preference, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{rollaway_bed}', $preferences->rollaway_bed, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{crib}', $preferences->crib, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{wheelchair_accessible}', $preferences->wheelchair_accessible, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{generally_am_size}', $preferences->generally_am_size, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{pillow_firmness}', $preferences->pillow_firmness, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{pillow_type}', $preferences->pillow_type, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{bed_style}', $preferences->bed_style, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{generally_sleep_on}', $preferences->generally_sleep_on, $bookingEmailTemplate);

            $cultural_interests_values = array();
            if ($preferences->art == 'Yes') {
                $cultural_interests_values[] = 'Art';
            }
            if ($preferences->architecture_interior_design == 'Yes') {
                $cultural_interests_values[] = 'Architecture & Interior Design';
            }
            if ($preferences->cigars == 'Yes') {
                $cultural_interests_values[] = 'Cigars';
            }
            if ($preferences->dance == 'Yes') {
                $cultural_interests_values[] = 'Dance';
            }
            if ($preferences->fashion == 'Yes') {
                $cultural_interests_values[] = 'Fashion';
            }
            if ($preferences->gastronomy == 'Yes') {
                $cultural_interests_values[] = 'Gastronomy';
            }
            if ($preferences->literature == 'Yes') {
                $cultural_interests_values[] = 'Literature';
            }
            if ($preferences->music == 'Yes') {
                $cultural_interests_values[] = 'Music';
            }
            if ($preferences->nature == 'Yes') {
                $cultural_interests_values[] = 'Nature';
            }
            if ($preferences->photography == 'Yes') {
                $cultural_interests_values[] = 'Photography';
            }
            if ($preferences->science == 'Yes') {
                $cultural_interests_values[] = 'Science';
            }
            if ($preferences->technology == 'Yes') {
                $cultural_interests_values[] = 'Technology';
            }
            if ($preferences->travel == 'Yes') {
                $cultural_interests_values[] = 'Travel';
            }
            if ($preferences->watches == 'Yes') {
                $cultural_interests_values[] = 'Watches';
            }
            if ($preferences->wines_spirits == 'Yes') {
                $cultural_interests_values[] = 'Wines & Spirits';
            }

            if (!empty($cultural_interests_values)) {
                $cultural_interests_list = '<ul style="float: left; width: calc(50% - 30px);">';
                foreach ($cultural_interests_values as $key => $cultural_interests_value) {
                    $cultural_interests_list .= '<li>' . $cultural_interests_value . '</li>';
                    if (($key + 1) == (round(count($cultural_interests_values) / 2))) {
                        $cultural_interests_list .= '</ul>';
                        $cultural_interests_list .= '<ul style="float: left;">';
                    }
                }
                $cultural_interests_list .= '</ul>';
            } else {
                $cultural_interests_list = '<p></p>';
            }

            $bookingEmailTemplate = str_replace('{cultural_interests_list}', $cultural_interests_list, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{other_interests}', $preferences->other_interests, $bookingEmailTemplate);

            $sports_preferences_values = array();
            if ($preferences->snorkeling == 'Yes') {
                $sports_preferences_values[] = 'Snorkeling';
            }
            if ($preferences->diving == 'Yes') {
                $sports_preferences_values[] = 'Diving';
            }
            if ($preferences->sailing == 'Yes') {
                $sports_preferences_values[] = 'Sailing';
            }
            if ($preferences->tennis == 'Yes') {
                $sports_preferences_values[] = 'Tennis';
            }
            if ($preferences->golf == 'Yes') {
                $sports_preferences_values[] = 'Golf';
            }
            if ($preferences->motorized_water_sports == 'Yes') {
                $sports_preferences_values[] = 'Motorized water sports';
            }

            if (!empty($sports_preferences_values)) {
                $sports_preferences_list = '<ul style="float: left; width: calc(50% - 30px);">';
                foreach ($sports_preferences_values as $key => $sports_preferences_value) {
                    $sports_preferences_list .= '<li>' . $sports_preferences_value . '</li>';
                    if (($key + 1) == (round(count($sports_preferences_values) / 2))) {
                        $sports_preferences_list .= '</ul>';
                        $sports_preferences_list .= '<ul style="float: left;">';
                    }
                }
                $sports_preferences_list .= '</ul>';
            } else {
                $sports_preferences_list = '<p></p>';
            }

            $bookingEmailTemplate = str_replace('{sports_preferences_list}', $sports_preferences_list, $bookingEmailTemplate);

            $wellbeing_preferences_values = array();
            if ($preferences->spa_treatments == 'Yes') {
                $wellbeing_preferences_values[] = 'Spa treatments';
            }
            if ($preferences->hair_treatments == 'Yes') {
                $wellbeing_preferences_values[] = 'Hair treatments';
            }
            if ($preferences->fitness == 'Yes') {
                $wellbeing_preferences_values[] = 'Fitness';
            }
            if ($preferences->pool == 'Yes') {
                $wellbeing_preferences_values[] = 'Pool';
            }
            if ($preferences->yoga == 'Yes') {
                $wellbeing_preferences_values[] = 'Yoga';
            }
            if ($preferences->pilates == 'Yes') {
                $wellbeing_preferences_values[] = 'Pilates';
            }
            if ($preferences->meditation == 'Yes') {
                $wellbeing_preferences_values[] = 'Meditation';
            }

            if (!empty($wellbeing_preferences_values)) {
                $wellbeing_preferences_list = '<ul style="float: left; width: calc(50% - 30px);">';
                foreach ($wellbeing_preferences_values as $key => $wellbeing_preferences_value) {
                    $wellbeing_preferences_list .= '<li>' . $wellbeing_preferences_value . '</li>';
                    if (($key + 1) == (round(count($wellbeing_preferences_values) / 2))) {
                        $wellbeing_preferences_list .= '</ul>';
                        $wellbeing_preferences_list .= '<ul style="float: left;">';
                    }
                }
                $wellbeing_preferences_list .= '</ul>';
            } else {
                $wellbeing_preferences_list = '<p></p>';
            }

            $bookingEmailTemplate = str_replace('{wellbeing_preferences_list}', $wellbeing_preferences_list, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{prefer_language}', $preferences->prefer_language, $bookingEmailTemplate);

            $dietary_preferences_values = array();
            if ($preferences->vegetarian == 'Yes') {
                $dietary_preferences_values[] = 'Vegetarian';
            }
            if ($preferences->halal == 'Yes') {
                $dietary_preferences_values[] = 'Halal';
            }
            if ($preferences->kosher == 'Yes') {
                $dietary_preferences_values[] = 'Kosher';
            }
            if ($preferences->gluten_free == 'Yes') {
                $dietary_preferences_values[] = 'Gluten-free';
            }
            if ($preferences->ovo_lactarian == 'Yes') {
                $dietary_preferences_values[] = 'Ovo-lactarian';
            }

            if (!empty($dietary_preferences_values)) {
                $dietary_preferences_list = '<ul style="float: left; width: calc(50% - 30px);">';
                foreach ($dietary_preferences_values as $key => $dietary_preferences_value) {
                    $dietary_preferences_list .= '<li>' . $dietary_preferences_value . '</li>';
                    if (($key + 1) == (round(count($dietary_preferences_values) / 2))) {
                        $dietary_preferences_list .= '</ul>';
                        $dietary_preferences_list .= '<ul style="float: left;">';
                    }
                }
                $dietary_preferences_list .= '</ul>';
            } else {
                $dietary_preferences_list = '<p></p>';
            }

            $bookingEmailTemplate = str_replace('{dietary_preferences_list}', $dietary_preferences_list, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{favourite_dishes}', $preferences->favourite_dishes, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{food_allergies}', $preferences->food_allergies, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{known_allergies}', $preferences->known_allergies, $bookingEmailTemplate);

            $snacks_preferences_values = array();
            if ($preferences->savory_snacks == 'Yes') {
                $snacks_preferences_values[] = 'Savory snacks';
            }
            if ($preferences->any_sweet_snacks == 'Yes') {
                $snacks_preferences_values[] = 'Any sweet snacks';
            }
            if ($preferences->chocolate_based_pastries == 'Yes') {
                $snacks_preferences_values[] = 'Chocolate based pastries';
            }
            if ($preferences->fruit_based_pastries == 'Yes') {
                $snacks_preferences_values[] = 'Fruit based pastries';
            }

            if (!empty($snacks_preferences_values)) {
                $snacks_preferences_list = '<ul style="float: left; width: calc(50% - 30px);">';
                foreach ($snacks_preferences_values as $key => $snacks_preferences_value) {
                    $snacks_preferences_list .= '<li>' . $snacks_preferences_value . '</li>';
                    if (($key + 1) == (round(count($snacks_preferences_values) / 2))) {
                        $snacks_preferences_list .= '</ul>';
                        $snacks_preferences_list .= '<ul style="float: left;">';
                    }
                }
                $snacks_preferences_list .= '</ul>';
            } else {
                $snacks_preferences_list = '<p></p>';
            }

            $bookingEmailTemplate = str_replace('{snacks_preferences_list}', $snacks_preferences_list, $bookingEmailTemplate);

            $fruits_preferences_values = array();
            if ($preferences->seasonal_fruits == 'Yes') {
                $fruits_preferences_values[] = 'Seasonal fruits';
            }
            if ($preferences->exotic_fruits == 'Yes') {
                $fruits_preferences_values[] = 'Exotic fruits';
            }
            if ($preferences->dried_fruits_and_nuts == 'Yes') {
                $fruits_preferences_values[] = 'Dried fruits and nuts';
            }

            if (!empty($fruits_preferences_values)) {
                $fruits_preferences_list = '<ul style="float: left; width: calc(50% - 30px);">';
                foreach ($fruits_preferences_values as $key => $fruits_preferences_value) {
                    $fruits_preferences_list .= '<li>' . $fruits_preferences_value . '</li>';
                    if (($key + 1) == (round(count($fruits_preferences_values) / 2))) {
                        $fruits_preferences_list .= '</ul>';
                        $fruits_preferences_list .= '<ul style="float: left;">';
                    }
                }
                $fruits_preferences_list .= '</ul>';
            } else {
                $fruits_preferences_list = '<p></p>';
            }

            $bookingEmailTemplate = str_replace('{fruits_preferences_list}', $fruits_preferences_list, $bookingEmailTemplate);

            $beverages_preferences_values = array();
            if ($preferences->seasonal_fruits == 'Yes') {
                $beverages_preferences_values[] = 'Seasonal fruits';
            }
            if ($preferences->exotic_fruits == 'Yes') {
                $beverages_preferences_values[] = 'Exotic fruits';
            }
            if ($preferences->dried_fruits_and_nuts == 'Yes') {
                $beverages_preferences_values[] = 'Dried fruits and nuts';
            }

            if (!empty($beverages_preferences_values)) {
                $beverages_preferences_list = '<ul style="float: left; width: calc(50% - 30px);">';
                foreach ($beverages_preferences_values as $key => $beverages_preferences_value) {
                    $beverages_preferences_list .= '<li>' . $beverages_preferences_value . '</li>';
                    if (($key + 1) == (round(count($beverages_preferences_values) / 2))) {
                        $beverages_preferences_list .= '</ul>';
                        $beverages_preferences_list .= '<ul style="float: left;">';
                    }
                }
                $beverages_preferences_list .= '</ul>';
            } else {
                $beverages_preferences_list = '<p></p>';
            }

            $bookingEmailTemplate = str_replace('{beverages_preferences_list}', $beverages_preferences_list, $bookingEmailTemplate);

            $sodas_preferences_values = array();
            if ($preferences->seasonal_fruits == 'Yes') {
                $sodas_preferences_values[] = 'Seasonal fruits';
            }
            if ($preferences->exotic_fruits == 'Yes') {
                $sodas_preferences_values[] = 'Exotic fruits';
            }
            if ($preferences->dried_fruits_and_nuts == 'Yes') {
                $sodas_preferences_values[] = 'Dried fruits and nuts';
            }

            if (!empty($sodas_preferences_values)) {
                $sodas_preferences_list = '<ul style="float: left; width: calc(50% - 30px);">';
                foreach ($sodas_preferences_values as $key => $sodas_preferences_value) {
                    $sodas_preferences_list .= '<li>' . $sodas_preferences_value . '</li>';
                    if (($key + 1) == (round(count($sodas_preferences_values) / 2))) {
                        $sodas_preferences_list .= '</ul>';
                        $sodas_preferences_list .= '<ul style="float: left;">';
                    }
                }
                $sodas_preferences_list .= '</ul>';
            } else {
                $sodas_preferences_list = '<p></p>';
            }

            $bookingEmailTemplate = str_replace('{sodas_preferences_list}', $sodas_preferences_list, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{preferred_aperitif}', $preferences->preferred_aperitif, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{upcoming_visit_remarks}', $preferences->upcoming_visit_remarks, $bookingEmailTemplate);

            $bookingEmailTemplate = str_replace('{property_name}', $property->property_name, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{property_city}', $property->city, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{property_country}', $property->country, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{property_website}', $property->website, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{property_phone}', $property->phone, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{property_email}', $property->email, $bookingEmailTemplate);

            $bookingEmailTemplate = str_replace('{category_name}', $type->category_name, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{category_image}', $type_image->imgsrc . $type_image->file_name, $bookingEmailTemplate);

            $bookingEmailTemplate = str_replace('{full_user_name}', trim($user_info->first_name . ' ' . $user_info->last_name), $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{title}', $user_info->title, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{birthday}', date("d/m/Y", strtotime($user_info->birthday)), $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{landline_number}', $user_info->landline_code . '-' . $user_info->landline_number, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{mobile_number}', $user_info->mobile_code . '-' . $user_info->mobile_number, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{prefer_communication_with}', $user_info->prefer_communication_with, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{email}', $user_info->email, $bookingEmailTemplate);

            $total_price = 0;
            $html = '';
            foreach ($reserved_rooms as $reserved_room) {
                $total_price += ($reservation->number_of_nights * $reservation->price);
                $html .= '<tr>
                            <th width="209" class="stack2" style="margin: 0;padding: 0;border-collapse: collapse;">
                                <table width="209" align="center" cellpadding="0" cellspacing="0" border="0" class="table60032" style="border-bottom-color: #C7AB84;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                    <tr>
                                        <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                        <!-- DESCRIPTION -->
                                        <td class="header2TD" style="border-collapse: collapse;" mc:edit="mcsec-25">' . $type->category_name . '
                                            <br/> </td>
                                        <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                    </tr>
                                </table>
                            </th>
                            <th width="139" class="stack3" style="border-left: 1px solid #C7AB84;margin: 0;padding: 0;border-collapse: collapse;">
                                <table width="139" align="center" cellpadding="0" cellspacing="0" border="0" class="table60033" style="border-bottom-color: #C7AB84;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                    <tr>
                                        <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                        <!-- PRICE -->
                                        <td class="RegularText5TD" style="border-collapse: collapse;" mc:edit="mcsec-26">€' . $reservation->price . '</td>
                                        <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                    </tr>
                                </table>
                            </th>
                            <th width="139" class="stack3" style="border-left: 1px solid #C7AB84;margin: 0;padding: 0;border-collapse: collapse;">
                                <table width="139" align="center" cellpadding="0" cellspacing="0" border="0" class="table60033" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                    <tr>
                                        <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                        <!-- QUANTITY -->
                                        <td class="RegularText5TD" style="border-collapse: collapse;" mc:edit="mcsec-27">' . $reservation->number_of_nights . '</td>
                                        <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                    </tr>
                                </table>
                            </th>
                            <th width="139" class="stack3" style="border-left: 1px solid #C7AB84;margin: 0;padding: 0;border-collapse: collapse;">
                                <table width="139" align="center" cellpadding="0" cellspacing="0" border="0" class="table60033" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                    <tr>
                                        <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                        <!-- TOTAL -->
                                        <td class="RegularText5TD" style="border-collapse: collapse;" mc:edit="mcsec-28">€' . ($reservation->number_of_nights * $reservation->price) . '</td>
                                        <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                    </tr>
                                </table>
                            </th>
                        </tr>';
            }

            $commission_due = $total_price * ($property->commission / 100);
            $grand_total = $commission_due + $total_price;

            $bookingEmailTemplate = str_replace('{reserved_rooms}', $html, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{total_price}', '€' . $total_price, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{commission_due}', '€' . $commission_due, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{grand_total}', '€' . $grand_total, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{hotel_terms_n_conditions}', $hotel_terms_n_conditions, $bookingEmailTemplate);
            $bookingEmailTemplate = str_replace('{property_email}', $property->email, $bookingEmailTemplate);

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: ' . CNF_APPNAME . '<info@design-locations.biz>' . "\r\n";

            mail($property->email, "Booking Confirmation", $bookingEmailTemplate, $headers);
            mail($user_info->email, "Booking Confirmation", $bookingEmailTemplate, $headers);

            /*             * ******************* Email notification end here **************************** */

            /*
             * Log in user
             */

            if (!\Auth::check()) {

                $temp = \Auth::attempt(array('email' => $request->input('email'), 'password' => $request->input('password')), 'false');

                if (\Auth::attempt(array('email' => $request->input('email'), 'password' => $request->input('password')), 'false')) {
                    if (\Auth::check()) {

                        $row = User::find(\Auth::user()->id);

                        \DB::table('tb_users')->where('id', '=', $row->id)->update(array('last_login' => date("Y-m-d H:i:s")));
                        \Session::put('uid', $row->id);
                        \Session::put('gid', $row->group_id);
                        \Session::put('eid', $row->email);
                        \Session::put('ll', $row->last_login);
                        \Session::put('fid', $row->first_name . ' ' . $row->last_name);
                        \Session::put('lang', 'Deutsch');
                    }
                }
            }

            $res['status'] = 'success';
            return json_encode($res);
        } else {

            $res['status'] = 'error';
            $res['errors'] = $validator->errors()->all();
            return json_encode($res);
        }
    }

    /*
     * AI ajax login
     */

    function ajax_login(Request $request) {
        if (\Auth::check()) {
            return "already_logged_in";
        }
        $remember = (!is_null($request->get('remember')) ? 'true' : 'false' );
        if (\Auth::attempt(array('email' => $request->input('email'), 'password' => $request->input('password')), $remember)) {
            if (\Auth::check()) {
                $row = User::find(\Auth::user()->id);

                if ($row->active == '0') {
                    // inactive 
                    \Auth::logout();
                    return "user_not_active";
                } else if ($row->active == '2') {
                    // BLocked users
                    \Auth::logout();
                    return "account_is_blocked";
                } else {
                    \DB::table('tb_users')->where('id', '=', $row->id)->update(array('last_login' => date("Y-m-d H:i:s")));
                    \Session::put('uid', $row->id);
                    \Session::put('gid', $row->group_id);
                    \Session::put('eid', $row->email);
                    \Session::put('ll', $row->last_login);
                    \Session::put('fid', $row->first_name . ' ' . $row->last_name);
                    \Session::put('lang', 'Deutsch');
                    return "logged_in";
                }
            }
        } else {
            return "invalid_details";
        }
    }

    //new reservation
    function new_booking(Request $request) {
        $uid = \Auth::user()->id;
        $rules['roomType'] = 'required';
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {

            $userdet = \DB::table('tb_users')->where('id', $uid)->first();
            $props = \DB::table('tb_properties')->where('id', $request->input('property'))->first();
            $curnDate = date('Y-m-d');
            $price = 0;
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
                        $checkseasonPrice = \DB::table('tb_properties_category_rooms_price')->where('season_id', $checkseason[$sc]->id)->where('property_id', $props->id)->where('category_id', $request->input('roomType'))->first();
                        if (!empty($checkseasonPrice)) {
                            $price = $checkseasonPrice->rack_rate;
                            $foundsean = true;
                        }
                    }
                }
                if ($foundsean != true) {
                    $checkseasonPrice_ifnotforloop = \DB::table('tb_properties_category_rooms_price')->where('season_id', 0)->where('property_id', $props->id)->where('category_id', $request->input('roomType'))->first();
                    if (!empty($checkseasonPrice_ifnotforloop)) {
                        $price = $checkseasonPrice_ifnotforloop->rack_rate;
                    }
                }
            } else {
                $checkseasonPrice_ifnotanyseason = \DB::table('tb_properties_category_rooms_price')->where('season_id', 0)->where('property_id', $props->id)->where('category_id', $request->input('roomType'))->first();
                if (!empty($checkseasonPrice_ifnotanyseason)) {
                    $price = $checkseasonPrice_ifnotanyseason->rack_rate;
                }
            }

            $data['property_id'] = $request->input('property');
            $data['checkin_date'] = date("Y-m-d", strtotime($request->input('booking_arrive')));
            $data['checkout_date'] = date("Y-m-d", strtotime($request->input('booking_destination')));
            $data['type_id'] = $request->input('roomType');
            $data['client_id'] = $uid;
            $data['source'] = 'Direct reservation';
            $data['adult'] = $request->input('booking_adults');
            $data['junior'] = $request->input('booking_children');
            $data['guest_names'] = $userdet->first_name . ' ' . $userdet->last_name;
            $data['price'] = $price;
            $data['price_mode'] = 'daily';
            $data['created_by'] = $uid;
            $data['created_date'] = date('Y-m-d h:i:s');
            $resid = \DB::table('tb_reservations')->insertGetId($data);

            $res['status'] = 'success';
            return json_encode($res);
        } else {

            $res['status'] = 'error';
            $res['errors'] = $validator->errors()->all();
            return json_encode($res);
        }
    }

    public function find_property_by_name(Request $request) {
        $props = array();
        $keyword = Input::get('pname');
        $seaprops = \DB::table('tb_properties')->select('id', 'property_name', 'property_slug')->where('property_name', $keyword)->where('property_status', 1)->first();
        if (!empty($seaprops)) {
            $rep['status'] = 'success';
            $rep['property'] = json_encode($seaprops);
            return json_encode($rep);
        } else {
            $rep['status'] = 'error';
            $rep['errors'] = 'No Record Found';
            return json_encode($rep);
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
                $propertiesArr['image'][$pr]->imgsrc = (new ContainerController)->getThumbpath($file->folder_id);
                $propertiesArr['image'][$pr]->imgsrc_cache = ImageCache::make(public_path(str_replace(url().'/', '', (new ContainerController)->getThumbpath($file->folder_id).$file->file_name)),100,1000,null);
                $pr++;
            }
        }


        return response()->json($propertiesArr);
        exit;
    }

}
