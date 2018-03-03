<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Properties;
use App\Models\Restaurant;
use App\Models\Bar;
use App\Models\Spa;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect,File;

class ImportdataController extends Controller { 



	public function getAlldata(Request $request) {

		$data = Properties::where('imported','=',0)->orderBy('id', 'asc')->paginate(1);
		$count = 1; 
		foreach($data as $val){
			$data = array();

			$restoArr = Restaurant::where('alias','=',str_slug($val->restaurant_title))->get();
			if(empty($restoArr)){
				$resto = new Restaurant();
				$resto->title = $val->restaurant_title;
				$resto->alias = str_slug($val->restaurant_title);
				$resto->desciription = $val->restaurant_desciription;
				$resto->video = $val->restaurant_video;
				$resto->video_type = $val->restaurant_video_type;
				$resto->video_link_type = $val->restaurant_video_link_type;
				$resto->video_link = $val->restaurant_video_link;
				$resto->designer = $val->restaurant_designer;
				$resto->url = $val->restaurant_url;
				$resto->usp_text = $val->restaurant_usp_text;
				$resto->usp_person = $val->restaurant_usp_person;
				$resto->save();
				$folderID = $this->createNewFolder(str_slug($val->restaurant_title),6230);
				$this->createNewFolder('gallery',$folderID);
				$this->createNewFolder('slider',$folderID);
				$this->createNewFolder('menu',$folderID);
			}

			$restoArr2 = Restaurant::where('alias','=',str_slug($val->restaurant2_title))->get();
			if(empty($restoArr2)){
				$resto = new Restaurant();
				$resto->title = $val->restaurant2_title;
				$resto->alias = $val->restaurant2_title;
				$resto->desciription = $val->restaurant2_desciription;
				$resto->video = $val->restaurant2_video;
				$resto->video_type = $val->restaurant2_video_type;
				$resto->video_link_type = $val->restaurant2_video_link_type;
				$resto->video_link = $val->restaurant2_video_link;
				$resto->designer = $val->restaurant2_designer;
				$resto->url = $val->restaurant2_url;
				$resto->usp_text = $val->restaurant2_usp_text;
				$resto->usp_person = $val->restaurant2_usp_person;
				$resto->save();
				$folderID = $this->createNewFolder(str_slug($val->restaurant_title),6230);
				$this->createNewFolder('gallery',$folderID);
				$this->createNewFolder('slider',$folderID);
				$this->createNewFolder('menu',$folderID);
			}

			$restoArr3 = Restaurant::where('alias','=',str_slug($val->restaurant3_title))->get();
			if(empty($restoArr3)){
				$resto = new Restaurant();
				$resto->title = $val->restaurant3_title;
				$resto->alias = str_slug($val->restaurant3_title);
				$resto->desciription = $val->restaurant3_desciription;
				$resto->video = $val->restaurant3_video;
				$resto->video_type = $val->restaurant3_video_type;
				$resto->video_link_type = $val->restaurant3_video_link_type;
				$resto->video_link = $val->restaurant3_video_link;
				$resto->designer = $val->restaurant3_designer;
				$resto->url = $val->restaurant3_url;
				$resto->usp_text = $val->restaurant3_usp_text;
				$resto->usp_person = $val->restaurant3_usp_person;
				$resto->save();
				$folderID = $this->createNewFolder(str_slug($val->restaurant_title),6230);
				$this->createNewFolder('gallery',$folderID);
				$this->createNewFolder('slider',$folderID);
				$this->createNewFolder('menu',$folderID);
			}

			$barArr = Bar::where('alias','=',str_slug($val->bar_title))->get();
			if(empty($barArr)){
				$bar = new Bar();
				$bar->title = $val->bar_title;
				$bar->alias = str_slug($val->bar_title);
				$bar->sub_title = $val->bar_sub_title;
				$bar->desciription = $val->bar_desciription;
				$bar->video = $val->bar_video;
				$bar->video_type = $val->bar_video_type;
				$bar->video_link_type = $val->bar_video_link_type;
				$bar->video_link = $val->bar_video_link;
				$bar->designer = $val->bar_designer;
				$bar->url = $val->bar_url;
				$bar->usp_text = $val->bar_usp_text;
				$bar->usp_person = $val->bar_usp_person;
				$bar->save();
				$folderID = $this->createNewFolder(str_slug($val->restaurant_title),6232);
				$this->createNewFolder('gallery',$folderID);
				$this->createNewFolder('slider',$folderID);
				$this->createNewFolder('menu',$folderID);
			}

			$barArr2 = Bar::where('alias','=',str_slug($val->bar2_title))->get();
			if(empty($barArr2)){
				$bar = new Bar();
				$bar->title = $val->bar2_title;
				$bar->alias = str_slug($val->bar2_title);
				$bar->sub_title = $val->bar2_sub_title;
				$bar->desciription = $val->bar2_desciription;
				$bar->video = $val->bar2_video;
				$bar->video_type = $val->bar2_video_type;
				$bar->video_link_type = $val->bar2_video_link_type;
				$bar->video_link = $val->bar2_video_link;
				$bar->designer = $val->bar2_designer;
				$bar->url = $val->bar2_url;
				$bar->usp_text = $val->bar2_usp_text;
				$bar->usp_person = $val->bar2_usp_person;
				$bar->save();
				$folderID = $this->createNewFolder(str_slug($val->restaurant_title),6232);
				$this->createNewFolder('gallery',$folderID);
				$this->createNewFolder('slider',$folderID);
				$this->createNewFolder('menu',$folderID);
			}

			$barArr3 = Bar::where('alias','=',str_slug($val->bar3_title))->get();
			if(empty($barArr3)){
				$bar = new Bar();
				$bar->title = $val->bar3_title;
				$bar->alias = str_slug($val->bar3_title);
				$bar->sub_title = $val->bar3_sub_title;
				$bar->desciription = $val->bar3_desciription;
				$bar->video = $val->bar3_video;
				$bar->video_type = $val->bar3_video_type;
				$bar->video_link_type = $val->bar3_video_link_type;
				$bar->video_link = $val->bar3_video_link;
				$bar->designer = $val->bar3_designer;
				$bar->url = $val->bar3_url;
				$bar->usp_text = $val->bar3_usp_text;
				$bar->usp_person = $val->bar3_usp_person;
				$bar->save();
				$folderID = $this->createNewFolder(str_slug($val->restaurant_title),6232);
				$this->createNewFolder('gallery',$folderID);
				$this->createNewFolder('slider',$folderID);
				$this->createNewFolder('menu',$folderID);
			}

			$spaArr = Spa::where('alias','=',str_slug($val->spa_title))->get();
			if(empty($barArr3)){
				$spa = new Spa();
				$spa->title = $val->spa_title;
				$spa->alias = str_slug($val->spa_title);
				$spa->desciription = $val->spa_desciription;
				$spa->video = $val->spa_video;
				$spa->video_type = $val->spa_video_type;
				$spa->video_link_type = $val->spa_video_link_type;
				$spa->video_link = $val->spa_video_link;
				$spa->designer = $val->spa_designer;
				$spa->url = $val->spa_url;
				$spa->usp_text = $val->spa_usp_text;
				$spa->usp_person = $val->spa_usp_person;
				$spa->manager_text = $val->spa_manager_text;
				$spa->opening_hrs = $val->spa_opening_hours;
				$spa->phonenumber = $val->spa_phone_number;
				$spa->save();
				$folderID = $this->createNewFolder(str_slug($val->restaurant_title),6231);
				$this->createNewFolder('gallery',$folderID);
				$this->createNewFolder('slider',$folderID);
				$this->createNewFolder('menu',$folderID);
			}

			$pro = Properties::find($val->id);
			$pro->imported = 1;
			$pro->save();

		}
		if($count>5){
			//header("refresh: 3;");
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
}