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
use Socialize, ImageCache, Storage;

class GenerateController  extends Controller {

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
   
    public function destinationGenerate()
    {
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




                $lineBreak = "\n";
                if(!empty($destts)){
                     $ourdesitnationHTML  = '';
                    foreach($destts as $destination){
                        $ourdesitnationHTML  .= '<div class="panel panel-default  destination-sub-menues">'.$lineBreak;
                        $ourdesitnationHTML  .= '<a class="collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse-inner'.$destination['maincat']->id.'">'.$lineBreak;
                        $ourdesitnationHTML  .= '<div class="destination-panel-heading">'.$lineBreak;
                        $ourdesitnationHTML  .= '<h4 class="panel-title menu-text accordion ">'.$lineBreak;
                        $ourdesitnationHTML  .= $destination['maincat']->category_name;
                        $ourdesitnationHTML  .= '</h4>'.$lineBreak;
                        $ourdesitnationHTML  .= '</div>'.$lineBreak;
                        $ourdesitnationHTML  .= '</a>'.$lineBreak;
                        $ourdesitnationHTML  .= '<div id="collapse-inner'.$destination['maincat']->id.'" class="panel-collapse collapse ">'.$lineBreak;
                        $ourdesitnationHTML  .= '<div class="panel-body">'.$lineBreak;
                        $ourdesitnationHTML  .= '<ul class="where-box-sub-menu">'.$lineBreak;
                                if (array_key_exists("child",$destination)){
                                        foreach($destination['child'] as $childDest){
                                            $ourdesitnationHTML  .= '<li><div class="panel-group destination-inner-accordian-outer" id="inner-level-accordian">'.$lineBreak;
                                            $ourdesitnationHTML  .= '<div class="panel panel-default">'.$lineBreak;
                                            $ourdesitnationHTML  .= '<div class="panel-heading">'.$lineBreak;
                                            $ourdesitnationHTML  .= '<h4 class="margin-top-15 panel-title pull-left">'.$lineBreak;
                                            $ourdesitnationHTML  .= '<a data-toggle="collapse" data-parent="#inner-level-accordian" href="#destination-child.'.$childDest->id.'">'.$childDest->category_name.'</a>'.$lineBreak;
                                            $ourdesitnationHTML  .= '</h4>';
                                            $ourdesitnationHTML  .= '</div>';
                                                if (array_key_exists("subchild",$childDest)){
                                                        $ourdesitnationHTML  .= '<div id="destination-child{{$childDest->id}}" class="panel-collapse collapse">'.$lineBreak;
                                                        $ourdesitnationHTML  .= '<ul class="where-box-sub-menu inner-level-sub-menu">';
                                                        foreach($childDest->subchild as $subchildDest){
                                                        $ourdesitnationHTML  .= '<li>';
                                                                    if (array_key_exists("childs",$childDest)){
                                                                        $ourdesitnationHTML  .= '<div class="panel-group destination-inner-accordian-outer" id="inner-level-accordian">'.$lineBreak;
                                                                        $ourdesitnationHTML  .= '<div class="panel panel-default">';
                                                                        $ourdesitnationHTML  .= '<div class="panel-heading">';
                                                                        $ourdesitnationHTML  .= '<h4 class="panel-title">';
                                                                        $ourdesitnationHTML  .= '<a data-toggle="collapse" data-parent="#inner-level-accordian" href="#destination-child'.$childDest->id.'-'.$subchildDest->id.'">'.$subchildDest->category_name.'</a>'.$lineBreak;
                                                                        $ourdesitnationHTML  .= '</h4>'.$lineBreak;
                                                                        $ourdesitnationHTML  .= '</div>'.$lineBreak;
                                                                                
                                                                        $ourdesitnationHTML  .= '<div id="destination-child'.$childDest->id.'-'.$subchildDest->id.'" class="panel-collapse collapse">'.$lineBreak;
                                                                        $ourdesitnationHTML  .= '<ul class="where-box-sub-menu inner-level-sub-menu">'.$lineBreak;
                                                                        foreach($childDest->childs as $_child){
                                                                            $ourdesitnationHTML  .= '<li><a href="'.url('luxury_destinations/'. str_replace(' ','_',$destination['maincat']->category_name).'/'. str_replace(' ','_',$childDest->category_name).'/'. str_replace(' ','_',$_child->category_name)).'">'.$_child->category_name.'</a></li>'.$lineBreak;
                                                                        }
                                                                        $ourdesitnationHTML  .= '</ul>'.$lineBreak;
                                                                        $ourdesitnationHTML  .= '</div>'.$lineBreak;
                                                                        $ourdesitnationHTML  .= '</div>'.$lineBreak;
                                                                        $ourdesitnationHTML  .= '</div>'.$lineBreak;
                                                                    }else{
                                                                        $ourdesitnationHTML  .= '<a href="'.url('luxury_destinations/'. str_replace(' ','_',$destination['maincat']->category_name).'/'. str_replace(' ','_',$childDest->category_name).'/'. str_replace(' ','_',$subchildDest->category_name)).'">'.$subchildDest->category_name.'</a>'.$lineBreak;
                                                                    }
                                                                $ourdesitnationHTML  .= '</li>'.$lineBreak;
                                                            }
                                                            $ourdesitnationHTML  .= '</ul>'.$lineBreak;
                                                            $ourdesitnationHTML  .= '</div>'.$lineBreak;
                                                }
                                            $ourdesitnationHTML  .= '</div>'.$lineBreak;
                                            $ourdesitnationHTML  .= '</div></li>'.$lineBreak;
                                        }
                                    }
                                    $ourdesitnationHTML  .= '</ul>'.$lineBreak;
                                $ourdesitnationHTML  .= '</div>'.$lineBreak;
                            $ourdesitnationHTML  .= '</div>'.$lineBreak;
                        $ourdesitnationHTML  .= '</div>'.$lineBreak;
                 }
                       
                 Storage::put('homeOurDestination.html', $ourdesitnationHTML); 
                 $exists = Storage::disk('local')->has('homeOurDestination.html');
                 if($exists){
                    echo 'File Generated  : homeOurDestination.html'.'<br>';
                 }
                   
        //For Home Page Mobile 
        

        
            $ourdesitnationMobileHTML  = '<div class="panel-group-" id="mobile-inner-accordian">'.$lineBreak;
            foreach($destts as $destination){

                $ourdesitnationMobileHTML  .= '<div class="panel panel-default  destination-sub-menues">'.$lineBreak;
                $ourdesitnationMobileHTML  .= '<a class="collapsed" data-toggle="collapse" data-parent="#mobile-inner-accordian" href="#mobile-inner'.$destination['maincat']->id.'">'.$lineBreak;
                $ourdesitnationMobileHTML  .= '<div class="destination-panel-heading">';
                $ourdesitnationMobileHTML  .= '<h4 class="panel-title menu-text accordion ">'.$destination['maincat']->category_name.'</h4>'.$lineBreak;
                $ourdesitnationMobileHTML  .= '</div>'.$lineBreak;
                $ourdesitnationMobileHTML  .= '</a>'.$lineBreak;
                $ourdesitnationMobileHTML  .= '<div id="mobile-inner'.$destination['maincat']->id.'" class="panel-collapse collapse ">'.$lineBreak;
                $ourdesitnationMobileHTML  .= '<div class="panel-body">'.$lineBreak;
                if (array_key_exists("child",$destination)){
                    $ourdesitnationMobileHTML  .= '<ul class="where-box-sub-menu">'.$lineBreak;
                        foreach($destination['child'] as $childDest){
                            $ourdesitnationMobileHTML  .= '<li><a href="'.url('luxury_destinations/'. str_replace(' ','_',$destination['maincat']->category_name).'/'. str_replace(' ','_',$childDest->category_name).'/'. str_replace(' ','_',$childDest->category_name)).'">'.$childDest->category_name.'</a></li>'.$lineBreak;
                        }
                    $ourdesitnationMobileHTML  .= '</ul>'.$lineBreak;
                }
                $ourdesitnationMobileHTML  .= '</div>'.$lineBreak;
                $ourdesitnationMobileHTML  .= '</div>'.$lineBreak;
                $ourdesitnationMobileHTML  .= '</div>'.$lineBreak;

            }
                $ourdesitnationHTML  .= '</div>'.$lineBreak;
            Storage::put('homeOurDestinationMobile.html', $ourdesitnationMobileHTML);   
            $exists = Storage::disk('local')->has('homeOurDestinationMobile.html');
            if($exists){
                echo 'File Generated  : homeOurDestinationMobile.html'.'<br>';
            } 
        }


        //For Search Page 
        $mainArrdestts = array();
        $maindest = \DB::table('tb_categories')->where('parent_category_id', 0)->where('id', '!=', 8)->get();
        if (!empty($maindest)) {
            $d = 0;
            foreach ($maindest as $mdest) {

               

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
        if(!empty($mainArrdestts)){
            
            $lineBreak = "\n";
            $ourdesitnationLeftSideHTML  = '<div class="panel panel-default custom-post-panel">'.$lineBreak;
            $ourdesitnationLeftSideHTML  .= '<a data-toggle="collapse" data-parent="#accordion" href="#maindestinations" class="heading-stying collapsed">'.$lineBreak;
            $ourdesitnationLeftSideHTML  .= '<div class="panel-heading custom-heading">Destinations</div></a>'.$lineBreak;
            $ourdesitnationLeftSideHTML  .= '<div id="maindestinations" class="panel-collapse collapse ">'.$lineBreak;
            $ourdesitnationLeftSideHTML  .= '<div class="panel-body custom-panel-body">'.$lineBreak;
            $ourdesitnationLeftSideHTML  .= '<div class="dl-filter">'.$lineBreak;
            $ourdesitnationLeftSideHTML  .= '<!--First Parent-->'.$lineBreak;
            foreach($mainArrdestts as $mndest){
                $ourdesitnationLeftSideHTML  .= '<div class="node post-filter-inputs">'.$lineBreak;
                $ourdesitnationLeftSideHTML  .= '<a class="node-btn" href="javascript:void(0)" onclick="filter_destination(\''.$mndest->id.'\', \'continent\');">'.$mndest->category_name.'</a>'.$lineBreak;
                if(array_key_exists('childs',$mndest) && !empty($mndest->childs)){
                    foreach($mndest->childs as $cddest){
                        $ourdesitnationLeftSideHTML  .= '<!--Second Level-->'.$lineBreak;
                        $ourdesitnationLeftSideHTML  .= '<div class="node" >'.$lineBreak;
                        $ourdesitnationLeftSideHTML  .= '<a class="node-btn" href="javascript:void(0)" onclick="filter_destination(\''.$cddest->id.'\', \'region\');">'.$cddest->category_name.'</a>'.$lineBreak;
                        if(array_key_exists('subchild',$cddest)){
                            foreach($cddest->subchild as $sbdest){
                                $ourdesitnationLeftSideHTML  .= '<!--Third Level-->'.$lineBreak;
                                $ourdesitnationLeftSideHTML  .= '<div class="node" >'.$lineBreak;
                                $ourdesitnationLeftSideHTML  .= '<a class="node-btn" href="javascript:void(0)" onclick="filter_destination(\''.$sbdest->id.'\', \'country\');">'.$sbdest->category_name.'</a>'.$lineBreak;
                                if(array_key_exists('subchild',$sbdest)){
                                    foreach($sbdest->subchild as $subchild){
                                        $ourdesitnationLeftSideHTML  .= '<div class="node" >'.$lineBreak;
                                        $ourdesitnationLeftSideHTML  .= '<a class="node-btn" href="javascript:void(0)" onclick="filter_destination(\''.$subchild->id.'\', \'country\');">'.$subchild->category_name.'</a>'.$lineBreak;
                                        $ourdesitnationLeftSideHTML  .= '</div>'.$lineBreak;
                                    }
                                }
                                $ourdesitnationLeftSideHTML  .=  '</div>'.$lineBreak;
                            }
                        }
                        $ourdesitnationLeftSideHTML  .= '</div>'.$lineBreak;
                    }
                }
                $ourdesitnationLeftSideHTML  .= '</div>'.$lineBreak;
            }
            $ourdesitnationLeftSideHTML  .= '</div>'.$lineBreak;
            $ourdesitnationLeftSideHTML  .= '</div>'.$lineBreak;
            $ourdesitnationLeftSideHTML  .= '</div>'.$lineBreak;
            //echo $ourdesitnationLeftSideHTML  .= '</div>';
           Storage::put('leftOurDestination.html', $ourdesitnationLeftSideHTML); 
           $exists = Storage::disk('local')->has('leftOurDestination.html');
            if($exists){
                echo 'File Generated s : leftOurDestination.html'.'<br>';
            } 
        }

        

    }

    // For genrate json file for hotel images path
    public function hotelGenerate(){
          // $propertyFile = 'property/43.json'; 
        //$contents = Storage::get($propertyFile);
       // $proertyObj = json_decode($contents);
        
        $catprops = DB::select(DB::raw("SELECT id,property_name,property_slug FROM tb_properties WHERE tb_properties.property_type = 'Hotel' AND property_status = '1' "));
        if (!empty($catprops)) {
            foreach ($catprops as $keyMain=>$cprop) {

                $sfileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $cprop->id)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->get();
                
                $propertiesArr = array();
                if (!empty($sfileArr)) {

                    foreach ( $sfileArr as $key => $value) {
                        $propertiesArr[$key] = $value;
                        $propertiesArr[$key]->imgsrc = (new ContainerController)->getThumbpath($value->folder_id);
                       
                    
                    }
                    
                }
                $propertyFile = 'property/'.$cprop->id.'.json';
                Storage::put($propertyFile, json_encode($propertiesArr)); 
                $exists = Storage::disk('local')->has($propertyFile);
                if($exists){
                    echo 'File '.($keyMain+1).' : '.$propertyFile.'<br>';
                }

            }
        }
    }

}
