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
                                                    
                                                }
                                                                                                if(!empty($temp)) {
                                                                                                    $destts[$ctt]['child'][$sd]->subchild = $temp;
                                                                                                    
                                                                                                }
                                                                                                                                                                                                
                                                
                                            }
                                            $sd++;
                                        }
                                    }
                                    $ctt++;
                                }
                                // }
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
                                                            usort($temp, function($a, $b) {
                                                                return trim($a->category_name) > trim($b->category_name);
                                                            });
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
                        
                        
                 /******* Get Destination *******/       
                 
                     ob_start();         
                 if(!empty($mainArrdestts)) : 
                  
                        foreach($mainArrdestts as $destination):
                    ?>
                        <div class="panel panel-default  destination-sub-menues">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse-inner<?php echo $destination->id;?>">
                                <div class="destination-panel-heading">
                                    <h4 class="panel-title menu-text accordion ">
                                        <?php echo $destination->category_name;?>
                                    </h4>
                                </div>
                            </a>
                            <div id="collapse-inner<?php echo $destination->id;?>" class="panel-collapse collapse ">
                                <div class="panel-body">
                                    <ul class="where-box-sub-menu">
                                        <?php if (array_key_exists("childs",$destination)):
                                        foreach($destination->childs as $childDest) :?>
                                        <li><div class="panel-group destination-inner-accordian-outer" id="inner-level-accordian">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="margin-top-15 panel-title pull-left">
                                                        <a data-toggle="collapse" data-parent="#inner-level-accordian" href="#destination-child<?php echo $childDest->id;?>"><?php echo $childDest->category_name;?></a>
                                                    </h4>
                                                </div>
                                                <?php if (array_key_exists("subchild",$childDest)):?>
                                                    <div id="destination-child<?php echo $childDest->id;?>" class="panel-collapse collapse">
                                                        <ul class="where-box-sub-menu inner-level-sub-menu">
                                                            <?php foreach($childDest->subchild as $subchildDest):?>
                                                                <li>
                                                                    <?php if (array_key_exists("subchild",$subchildDest) && !empty($subchildDest->subchild)):?>
                                                                    <div class="panel-group destination-inner-accordian-outer" id="inner-level-accordian">
                                                                        <div class="panel panel-default">
                                                                            <div class="panel-heading">
                                                                                <h4 class="panel-title">
                                                                                    <a data-toggle="collapse" data-parent="#inner-level-accordian" href="#destination-child<?php echo $childDest->id; ?>-<?php echo $subchildDest->id; ?>"><?php echo $subchildDest->category_name; ?></a>
                                                                                </h4>
                                                                            </div>
                                                                            
                                                                                <div id="destination-child<?php echo $childDest->id;?>-<?php echo $subchildDest->id;?>" class="panel-collapse collapse">
                                                                                    <ul class="where-box-sub-menu inner-level-sub-menu">
                                                                                        <?php foreach($subchildDest->subchild as $_child):?>
                                                                                            <li><a href="<?php echo url('luxury_destinations/'. str_replace(' ','_',$destination->category_name).'/'. str_replace(' ','_',$childDest->category_name).'/'. str_replace(' ','_',$_child->category_name));?>"><?php echo $_child->category_name;?></a></li>
                                                                                        <?php endforeach;?>
                                                                                    </ul>
                                                                                </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php else : ?>
                                                                    <a href="<?php echo url('luxury_destinations/'. str_replace(' ','_',$destination->category_name).'/'. str_replace(' ','_',$childDest->category_name).'/'. str_replace(' ','_',$subchildDest->category_name));?>"><?php echo $subchildDest->category_name;?></a>
                                                                    <?php endif;?>
                                                                </li>
                                                            <?php endforeach;?>
                                                        </ul>
                                                    </div>
                                                <?php endif;?>
                                            </div>
                                        </div></li>
                                        <!--The menu code is commented please uncomment this when you make it dynamic-->
                                        <!--<li><a href="<?php echo url('search?continent='.$destination->category_name.'&region='.$childDest->category_name.'&s='.$childDest->category_name.'&ref=syd&destination_page=1');?>"><?php echo $childDest->category_name;?></a></li>-->
                                        <?php endforeach;?>
                                        <?php endif;?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                        <?php endif;
                        $ourdesitnationHTML = ob_get_contents();
                                                ob_end_clean();  


                 Storage::put('homeOurDestination.html', $ourdesitnationHTML); 
                 $exists = Storage::disk('local')->has('homeOurDestination.html');
                 if($exists){
                    echo 'File Generated  : homeOurDestination.html'.'<br>';
                 }
                   
        //For Home Page Mobile 
        

              
              if(!empty($destts)){
              
             ?>
                                                    <div class="panel-group-" id="mobile-inner-accordian">
                                                        <?php foreach($destts as $destination):?>
                                                        <div class="panel panel-default  destination-sub-menues">
                                                            <a class="collapsed" data-toggle="collapse" data-parent="#mobile-inner-accordian" href="#mobile-inner<?php echo $destination['maincat']->id;?>">
                                                                <div class="destination-panel-heading">
                                                                    <h4 class="panel-title menu-text accordion ">
                                                                        <?php echo $destination['maincat']->category_name;?>
                                                                    </h4>
                                                                </div>
                                                            </a>
                                                            <div id="mobile-inner<?php echo $destination['maincat']->id;?>" class="panel-collapse collapse ">
                                                                <div class="panel-body">
                                                                    <?php if (array_key_exists("child",$destination)):?>
                                                                    <ul class="where-box-sub-menu">
                                                                        <?php foreach($destination['child'] as $childDest):?>
                                                                        <li><a href="<?php echo url('luxury_destinations/'. str_replace(' ','_',$destination['maincat']->category_name).'/'. str_replace(' ','_',$childDest->category_name).'/'. str_replace(' ','_',$childDest->category_name));?>"><?php echo $childDest->category_name;?></a></li>
                                                                        <?php endforeach;?>
                                                                    </ul>
                                                                    <?php endif;?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php endforeach;?>
                                                    </div>
                                                    <?php 

                                                    }
                                                  $ourdesitnationMobileHTML = ob_get_contents();
                                                ob_end_clean();       


            Storage::put('homeOurDestinationMobile.html', $ourdesitnationMobileHTML);   
            $exists = Storage::disk('local')->has('homeOurDestinationMobile.html');
            if($exists){
                echo 'File Generated  : homeOurDestinationMobile.html'.'<br>';
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
                $ourdesitnationLeftSideHTML  .= '<a class="node-btn" href="javascript:void(0)" onclick="$(\'#maindestinations a.node-btn\').removeClass(\'active\');$(this).addClass(\'active\');filter_destination(\''.$mndest->id.'\', \'continent\');">'.$mndest->category_name.'</a>'.$lineBreak;
                if(array_key_exists('childs',$mndest) && !empty($mndest->childs)){
                    foreach($mndest->childs as $cddest){
                        $ourdesitnationLeftSideHTML  .= '<!--Second Level-->'.$lineBreak;
                        $ourdesitnationLeftSideHTML  .= '<div class="node" >'.$lineBreak;
                        $ourdesitnationLeftSideHTML  .= '<a class="node-btn" href="javascript:void(0)" onclick="$(\'#maindestinations a.node-btn\').removeClass(\'active\');$(this).addClass(\'active\');filter_destination(\''.$cddest->id.'\', \'region\');">'.$cddest->category_name.'</a>'.$lineBreak;
                        if(array_key_exists('subchild',$cddest)){
                            foreach($cddest->subchild as $sbdest){
                                $ourdesitnationLeftSideHTML  .= '<!--Third Level-->'.$lineBreak;
                                $ourdesitnationLeftSideHTML  .= '<div class="node" >'.$lineBreak;
                                $ourdesitnationLeftSideHTML  .= '<a class="node-btn" href="javascript:void(0)" onclick="$(\'#maindestinations a.node-btn\').removeClass(\'active\');$(this).addClass(\'active\');filter_destination(\''.$sbdest->id.'\', \'country\');">'.$sbdest->category_name.'</a>'.$lineBreak;
                                if(array_key_exists('subchild',$sbdest)){
                                    foreach($sbdest->subchild as $subchild){
                                        $ourdesitnationLeftSideHTML  .= '<div class="node" >'.$lineBreak;
                                        $ourdesitnationLeftSideHTML  .= '<a class="node-btn" href="javascript:void(0)" onclick="$(\'#maindestinations a.node-btn\').removeClass(\'active\');$(this).addClass(\'active\');filter_destination(\''.$subchild->id.'\', \'country\');">'.$subchild->category_name.'</a>'.$lineBreak;
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
            $ourdesitnationLeftSideHTML  .= '</div>';
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
