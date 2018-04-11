<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Properties;
use App\Models\Restaurant;
use App\Models\Bar;
use App\Models\Spa;
use Illuminate\Http\Request;
use Validator, Input, Redirect,File, DB;
use App\Http\Controllers\ContainerController;

class ImportdataController extends Controller { 



	public function getAlldata(Request $request) {

		$data = Properties::where('imported','=',0)->orderBy('id', 'asc')->paginate(5);
		$count = 1; 
		foreach($data as $val){
			
			if(trim($val->restaurant_title)!='')
			{
				$restoArr = DB::table('tb_restaurants')->where('alias','=',str_slug($val->restaurant_title))->get();
				if(empty($restoArr)){
					$data = array();
					$data['title'] = $val->restaurant_title;
					$data['alias'] = str_slug($val->restaurant_title);
					$data['desciription'] = $val->restaurant_desciription;
					$data['video'] = $val->restaurant_video;
					$data['video_type'] = $val->restaurant_video_type;
					$data['video_link_type'] = $val->restaurant_video_link_type;
					$data['video_link'] = $val->restaurant_video_link;
					$data['designer'] = $val->restaurant_designer;
					$data['url'] = $val->restaurant_url;
					$data['usp_text'] = $val->restaurant_usp_text;
					$data['usp_person'] = $val->restaurant_usp_person;
					
					$restoId = DB::table('tb_restaurants')->insertGetId($data);
					$folderID = $this->createNewFolder(str_slug($val->restaurant_title),6230);
					$galleryID = $this->createNewFolder('gallery',$folderID);
					$sliderID = $this->createNewFolder('slider',$folderID);
					$menuID = $this->createNewFolder('menu',$folderID);
					DB::table('tb_images_res_spa_bar')->insertGetId(['parent_id'=>$restoId,'folder_id'=>$folderID,'type'=>'res']);
					
					$restoimagArr = DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.file_id','tb_container_files.folder_id','tb_container_files.file_name')->where('tb_properties_images.property_id',$val->id)->where('tb_properties_images.type', 'Restrurants Gallery Images')->get();
					if(!empty($restoimagArr)){
						$dirPath = (new ContainerController)->getContainerUserPath($restoimagArr[0]->folder_id);
						$movetofolder = (new ContainerController)->getContainerUserPath($galleryID);
						if( is_dir($movetofolder) === true )
						{
							foreach($restoimagArr as $restoimag)
							{
								if(File::exists($dirPath.$restoimag->file_name))
								{
									$successfile = File::move($dirPath.$restoimag->file_name, $movetofolder.$restoimag->file_name);
									if($successfile)
									{
										DB::table('tb_container_files')->where('id', $restoimag->file_id)->update(['folder_id' => $galleryID]);
									}
								}
							}
						}
					}
				}
			}
			
			if(trim($val->restaurant2_title)!='')
			{
				$restoArr2 = DB::table('tb_restaurants')->where('alias','=',str_slug($val->restaurant2_title))->get();
				if(empty($restoArr2)){
					$data = array();
					$data['title'] = $val->restaurant2_title;
					$data['alias'] = str_slug($val->restaurant2_title);
					$data['desciription'] = $val->restaurant2_desciription;
					$data['video'] = $val->restaurant2_video;
					$data['video_type'] = $val->restaurant2_video_type;
					$data['video_link_type'] = $val->restaurant2_video_link_type;
					$data['video_link'] = $val->restaurant2_video_link;
					$data['designer'] = $val->restaurant2_designer;
					$data['url'] = $val->restaurant2_url;
					$data['usp_text'] = $val->restaurant2_usp_text;
					$data['usp_person'] = $val->restaurant2_usp_person;
					
					$restoId = DB::table('tb_restaurants')->insertGetId($data);
					$folderID = $this->createNewFolder(str_slug($val->restaurant2_title),6230);
					$galleryID = $this->createNewFolder('gallery',$folderID);
					$sliderID = $this->createNewFolder('slider',$folderID);
					$menuID = $this->createNewFolder('menu',$folderID);
					DB::table('tb_images_res_spa_bar')->insertGetId(['parent_id'=>$restoId,'folder_id'=>$folderID,'type'=>'res']);
				}
			}
			
			if(trim($val->restaurant3_title)!='')
			{
				$restoArr3 = DB::table('tb_restaurants')->where('alias','=',str_slug($val->restaurant3_title))->get();
				if(empty($restoArr3)){
					$data = array();
					$data['title'] = $val->restaurant3_title;
					$data['alias'] = str_slug($val->restaurant3_title);
					$data['desciription'] = $val->restaurant3_desciription;
					$data['video'] = $val->restaurant3_video;
					$data['video_type'] = $val->restaurant3_video_type;
					$data['video_link_type'] = $val->restaurant3_video_link_type;
					$data['video_link'] = $val->restaurant3_video_link;
					$data['designer'] = $val->restaurant3_designer;
					$data['url'] = $val->restaurant3_url;
					$data['usp_text'] = $val->restaurant3_usp_text;
					$data['usp_person'] = $val->restaurant3_usp_person;
					
					$restoId = DB::table('tb_restaurants')->insertGetId($data);
					$folderID = $this->createNewFolder(str_slug($val->restaurant3_title),6230);
					$galleryID = $this->createNewFolder('gallery',$folderID);
					$sliderID = $this->createNewFolder('slider',$folderID);
					$menuID = $this->createNewFolder('menu',$folderID);
					DB::table('tb_images_res_spa_bar')->insertGetId(['parent_id'=>$restoId,'folder_id'=>$folderID,'type'=>'res']);
				}
			}
			
			if(trim($val->bar_title)!='')
			{
				$barArr = DB::table('tb_bars')->where('alias','=',str_slug($val->bar_title))->get();
				if(empty($barArr)){
					$data = array();
					$data['title'] = $val->bar_title;
					$data['alias'] = str_slug($val->bar_title);
					$data['sub_title'] = $val->bar_sub_title;
					$data['desciription'] = $val->bar_desciription;
					$data['video'] = $val->bar_video;
					$data['video_type'] = $val->bar_video_type;
					$data['video_link_type'] = $val->bar_video_link_type;
					$data['video_link'] = $val->bar_video_link;
					$data['designer'] = $val->bar_designer;
					$data['url'] = $val->bar_url;
					$data['usp_text'] = $val->bar_usp_text;
					$data['usp_person'] = $val->bar_usp_person;
					
					$barId = DB::table('tb_bars')->insertGetId($data);
					$folderID = $this->createNewFolder(str_slug($val->bar_title),6232);
					$galleryID = $this->createNewFolder('gallery',$folderID);
					$sliderID = $this->createNewFolder('slider',$folderID);
					$menuID = $this->createNewFolder('menu',$folderID);
					DB::table('tb_images_res_spa_bar')->insertGetId(['parent_id'=>$barId,'folder_id'=>$folderID,'type'=>'bar']);
					
					$barimagArr = DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.file_id','tb_container_files.folder_id','tb_container_files.file_name')->where('tb_properties_images.property_id',$val->id)->where('tb_properties_images.type', 'Bar Gallery Images')->get();
					if(!empty($barimagArr)){
						$dirPath = (new ContainerController)->getContainerUserPath($barimagArr[0]->folder_id);
						$movetofolder = (new ContainerController)->getContainerUserPath($galleryID);
						if( is_dir($movetofolder) === true )
						{
							foreach($barimagArr as $barimag)
							{
								if(File::exists($dirPath.$barimag->file_name))
								{
									$successfile = File::move($dirPath.$barimag->file_name, $movetofolder.$barimag->file_name);
									if($successfile)
									{
										DB::table('tb_container_files')->where('id', $barimag->file_id)->update(['folder_id' => $galleryID]);
									}
								}
							}
						}
					}
				}
			}
			
			if(trim($val->bar2_title)!='')
			{
				$barArr2 = DB::table('tb_bars')->where('alias','=',str_slug($val->bar2_title))->get();
				if(empty($barArr2)){
					$data = array();
					$data['title'] = $val->bar2_title;
					$data['alias'] = str_slug($val->bar2_title);
					$data['sub_title'] = $val->bar2_sub_title;
					$data['desciription'] = $val->bar2_desciription;
					$data['video'] = $val->bar2_video;
					$data['video_type'] = $val->bar2_video_type;
					$data['video_link_type'] = $val->bar2_video_link_type;
					$data['video_link'] = $val->bar2_video_link;
					$data['designer'] = $val->bar2_designer;
					$data['url'] = $val->bar2_url;
					$data['usp_text'] = $val->bar2_usp_text;
					$data['usp_person'] = $val->bar2_usp_person;

					$barId = DB::table('tb_bars')->insertGetId($data);
					$folderID = $this->createNewFolder(str_slug($val->bar2_title),6232);
					$galleryID = $this->createNewFolder('gallery',$folderID);
					$sliderID = $this->createNewFolder('slider',$folderID);
					$menuID = $this->createNewFolder('menu',$folderID);
					DB::table('tb_images_res_spa_bar')->insertGetId(['parent_id'=>$barId,'folder_id'=>$folderID,'type'=>'bar']);
				}
			}
			
			if(trim($val->bar3_title)!='')
			{
				$barArr3 = DB::table('tb_bars')->where('alias','=',str_slug($val->bar3_title))->get();
				if(empty($barArr3)){
					$data = array();
					$data['title'] = $val->bar3_title;
					$data['alias'] = str_slug($val->bar3_title);
					$data['sub_title'] = $val->bar3_sub_title;
					$data['desciription'] = $val->bar3_desciription;
					$data['video'] = $val->bar3_video;
					$data['video_type'] = $val->bar3_video_type;
					$data['video_link_type'] = $val->bar3_video_link_type;
					$data['video_link'] = $val->bar3_video_link;
					$data['designer'] = $val->bar3_designer;
					$data['url'] = $val->bar3_url;
					$data['usp_text'] = $val->bar3_usp_text;
					$data['usp_person'] = $val->bar3_usp_person;
					
					$barId = DB::table('tb_bars')->insertGetId($data);
					$folderID = $this->createNewFolder(str_slug($val->bar3_title),6232);
					$galleryID = $this->createNewFolder('gallery',$folderID);
					$sliderID = $this->createNewFolder('slider',$folderID);
					$menuID = $this->createNewFolder('menu',$folderID);
					DB::table('tb_images_res_spa_bar')->insertGetId(['parent_id'=>$barId,'folder_id'=>$folderID,'type'=>'bar']);
				}
			}

			if(trim($val->spa_title)!='')
			{
				$spaArr = DB::table('tb_spas')->where('alias','=',str_slug($val->spa_title))->get();
				if(empty($spaArr)){
					$data = array();
					$data['title'] = $val->spa_title;
					$data['alias'] = str_slug($val->spa_title);
					$data['desciription'] = $val->spa_desciription;
					$data['video'] = $val->spa_video;
					$data['video_type'] = $val->spa_video_type;
					$data['video_link_type'] = $val->spa_video_link_type;
					$data['video_link'] = $val->spa_video_link;
					$data['designer'] = $val->spa_designer;
					$data['url'] = $val->spa_url;
					$data['usp_text'] = $val->spa_usp_text;
					$data['usp_person'] = $val->spa_usp_person;
					$data['manager_text'] = $val->spa_manager_text;
					$data['opening_hrs'] = $val->spa_opening_hours;
					$data['phonenumber'] = $val->spa_phone_number;

					$spaId = DB::table('tb_spas')->insertGetId($data);
					$folderID = $this->createNewFolder(str_slug($val->spa_title),6231);
					$galleryID = $this->createNewFolder('gallery',$folderID);
					$sliderID = $this->createNewFolder('slider',$folderID);
					$menuID = $this->createNewFolder('menu',$folderID);
					DB::table('tb_images_res_spa_bar')->insertGetId(['parent_id'=>$spaId,'folder_id'=>$folderID,'type'=>'spa']);
					
					$spaimagArr = DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.file_id','tb_container_files.folder_id','tb_container_files.file_name')->where('tb_properties_images.property_id',$val->id)->where('tb_properties_images.type', 'Spa Gallery Images')->get();
					if(!empty($spaimagArr)){
						$dirPath = (new ContainerController)->getContainerUserPath($spaimagArr[0]->folder_id);
						$movetofolder = (new ContainerController)->getContainerUserPath($galleryID);
						if( is_dir($movetofolder) === true )
						{
							foreach($spaimagArr as $spaimag)
							{
								if(File::exists($dirPath.$spaimag->file_name))
								{
									$successfile = File::move($dirPath.$spaimag->file_name, $movetofolder.$spaimag->file_name);
									if($successfile)
									{
										DB::table('tb_container_files')->where('id', $spaimag->file_id)->update(['folder_id' => $galleryID]);
									}
								}
							}
						}
					}
				}
			}
			DB::table('tb_properties')->where('id', $val->id)->update(['imported' => 1]);
			$count++;
		}
		if($count>5){
			header("refresh: 3;");
		}
		echo "Import Restaurants: ".Restaurant::count().'<br>';
		echo "Import Bars: ".Bar::count().'<br>';
		echo "Import Spas: ".Spa::count().'<br>';
	}

	public function getRestaurant(Request $request) {

	}
	public function getSpa(Request $request) {

	}

	public function getBar(Request $request) {

	}

	function createNewFolder($Foldername, $ParentfolderId) {
        if ($Foldername != '') {
            $dirPath = (new ContainerController)->getContainerUserPath($ParentfolderId);
            $slug = \SiteHelpers::seoUrl(trim($Foldername));
            $result = \File::makeDirectory($dirPath . $slug, 0777, true);
            $fdata['parent_id'] = $ParentfolderId;
            $fdata['name'] = $slug;
            $fdata['display_name'] = $Foldername;
            $fdata['file_type'] = 'folder';
            $fdata['user_id'] = \Auth::user()->id;
            $fdata['created'] = date('y-m-d h:i:s');
            $fID = \DB::table('tb_container')->insertGetId($fdata);
            return $fID;
        } else {
            return false;
        }
    }

    public function getUpadteAllData(Request $request)
    {

        $data = Properties::where('imported', '=', 0)->orderBy('id', 'asc')->paginate(5);
        $count = 1;
        foreach ($data as $val) {
            $restoId = array();
            $spaId = array();
            $barId = array();
            if (trim($val->restaurant_title) != '') {
                $restoArr = DB::table('tb_restaurants')->where('alias', '=', str_slug($val->restaurant_title))->get();
                if (!empty($restoArr)) {
                    $restoId[] = $restoArr->id;
                }
            }

            if (trim($val->restaurant2_title) != '') {
                $restoArr2 = DB::table('tb_restaurants')->where('alias', '=', str_slug($val->restaurant2_title))->get();
                if (!empty($restoArr2)) {
                    $restoId[] = $restoArr2->id;
                }
            }

            if (trim($val->restaurant3_title) != '') {
                $restoArr3 = DB::table('tb_restaurants')->where('alias', '=', str_slug($val->restaurant3_title))->get();
                if (!empty($restoArr3)) {
                    $restoId[] = $restoArr3->id;
                }
            }

            if (trim($val->bar_title) != '') {
                $barArr = DB::table('tb_bars')->where('alias', '=', str_slug($val->bar_title))->get();
                if (!empty($barArr)) {
                    $barId[] = $barArr->id;
                }
            }

            if (trim($val->bar2_title) != '') {
                $barArr2 = DB::table('tb_bars')->where('alias', '=', str_slug($val->bar2_title))->get();
                if (!empty($barArr2)) {
                    $barId[] = $barArr2->id;
                }
            }

            if (trim($val->bar3_title) != '') {
                $barArr3 = DB::table('tb_bars')->where('alias', '=', str_slug($val->bar3_title))->get();
                if (!empty($barArr3)) {
                    $barId[] = $barArr3->id;
                }
            }

            if (trim($val->spa_title) != '') {
                $spaArr = DB::table('tb_spas')->where('alias', '=', str_slug($val->spa_title))->get();
                if (!empty($spaArr)) {
                    $spaId[] = $spaArr->id;
                }
            }

            $restaurant_ids = implode(',',$restoId);
            $spa_ids = implode(',',$spaId);
            $bar_ids = implode(',',$barId);
            DB::table('tb_properties')->where('id', $val->id)->update(['imported' => 1,'restaurant_ids'=>$restaurant_ids,'spa_ids'=>$spa_ids,'bar_ids'=>$bar_ids]);
            $count++;
        }
        if ($count > 5) {
            header("refresh: 3;");
        }
        echo "Updated Properties: " . Properties::count() . '<br>';
    }

}