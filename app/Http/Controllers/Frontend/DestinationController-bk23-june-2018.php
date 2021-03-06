<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB,Validator, Input, Redirect;

class DestinationController_bkup extends Controller {

    public function __construct() {
        parent::__construct();
    }
	
	public function getDestinatinosAjax(Request $request) {
		
		$category_id = $request->catID;

		$res = array(); 
		if($category_id!='')
		{
			//$fetchchildsQuery = \DB::select("select tb_categories.id, tb_categories.parent_category_id, tb_categories.category_name, tb_categories.category_image, tb_categories.category_alias from  tb_categories, tb_properties where tb_categories.category_published = '1' and tb_categories.parent_category_id = '".$category_id."' and tb_categories.id != '8' and FIND_IN_SET(tb_categories.id,tb_properties.property_category_id) group by tb_categories.id");
            $fetchchilds = DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name', 'category_image', 'category_alias', 'category_youtube_channel_url')->where('category_published', 1)->where('parent_category_id', $category_id)->where('id', '!=', 8)->get();

            if(!empty($fetchchilds))
            {
				$destarr = array();
				foreach ($fetchchilds as $dest) {
                    $subdest = \DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name', 'category_youtube_channel_url')->where('parent_category_id', $dest->id)->get();
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
						$destarr[] = $dest;
					}
				}
				
				usort($destarr, function($a, $b) {
					return trim($a->category_name) > trim($b->category_name);
				});
				
                $res['status'] = 'success';
                $res['dests'] = $destarr;
            }
            else
            {
                $res['status'] = 'error';
                $res['errors'] = 'No child destination found!';
            }
            if($category_id>0){
                $currentCate = DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name', 'category_image', 'category_alias', 'category_instagram_tag', 'category_youtube_channel_url')->where('category_published', 1)->where('id', $category_id)->first();
                $res['current_category'] = $currentCate;
                $currentParentCate = DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name', 'category_image', 'category_alias', 'category_youtube_channel_url')->where('category_published', 1)->where('id', $currentCate->parent_category_id)->first();
                $res['current_category'] = $currentCate;
                $res['currentParentCate'] = $currentParentCate;
				$res['path'] = implode('/',array_reverse($this->fetchcategoryaliaspath($category_id)));
            }
		}
		else
		{
			$res['status'] = 'error';
			$res['errors'] = 'Please select destination first!';
		}
		return response()->json($res);
    }
	
	public function fetchcategoryChildListIds($id = 0, $child_category_array = '') {

        if (!is_array($child_category_array))
            $child_category_array = array();
        $results = \DB::table('tb_categories')->select('id')->where('parent_category_id', $id)->get();
        if ($results) {
            foreach ($results as $row) {
                $child_category_array[] = $row->id;
                $child_category_array = $this->fetchcategoryChildListIds($row->id, $child_category_array);
            }
        }
        return $child_category_array;
    }

    public function getExperiencesAjax(Request $request) {
		
		$res = array(); 
		if(isset($request->catID))
		{
			$category_id=$request->catID;
			
			$fetchexperience = DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name', 'category_image', 'category_alias')->where('category_published', 1)->where('parent_category_id', 8)->orderByRaw(DB::raw("FIELD(id, $category_id) desc, category_name "))->get();

		}
		else
		{
				$fetchexperience = DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name', 'category_image', 'category_alias')->where('category_published', 1)->where('parent_category_id', 8)->orderByRaw(DB::raw("category_name"))->get();
			
		}
		if(!empty($fetchexperience))
		{
			
			
			$res['status'] = 'success';
			$res['dests'] = $fetchexperience;
			
		}
		else
		{
			$res['status'] = 'error';
			$res['errors'] = 'No Experiences found!';
		}
        return response()->json($res);
    }
	
	public function getMenusAjax(Request $request) {
		$menu_id = $request->menuID;
		$menu_pos = $request->menu_pos;
		$res = array(); 
		$fetchmenu = DB::table('tb_menu')->where('parent_id', $menu_id)->where('position', $menu_pos)->where('active', 1)->orderBy('ordering','asc')->get();
		if(!empty($fetchmenu))
		{
			$res['status'] = 'success';
			$res['menus'] = $fetchmenu;
			
		}
		else
		{
			$res['status'] = 'error';
			$res['errors'] = 'No Menus found!';
		}
        if($request->menuID>0){
            $currentMenu = DB::table('tb_menu')->where('menu_id', $menu_id)->where('position', $menu_pos)->where('active', 1)->orderBy('ordering','asc')->first();;
            $res['current_menu'] = $currentMenu;
        }
        return response()->json($res);
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
	
	public function getGlobalSearchAjax(Request $request) {
		
		$keyword = trim($request->keyword);

		$res = $respns = array(); 
		if($keyword!='')
		{
            $fetchdestinations = DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name', 'category_image', 'category_alias')->where('category_published', 1)->where('category_name', 'like', '%'.$keyword.'%')->where('id', '!=', 8)->where('parent_category_id', '!=', 8)->get();

            if(!empty($fetchdestinations))
            {
                $res['dest'] = $fetchdestinations;
            }
			
			$fetchcollection = DB::table('tb_properties')->select('id', 'property_name', 'property_slug')->where('property_status', 1)->where('property_name', 'like', '%'.$keyword.'%')->get();

            if(!empty($fetchcollection))
            {
                $res['collection'] = $fetchcollection;
            }
			
			$fetchrestro = DB::table('tb_restaurants')->select('id', 'title', 'alias')->where('title', 'like', '%'.$keyword.'%')->get();

            if(!empty($fetchrestro))
            {
                $res['restro'] = $fetchrestro;
            }
			
			$fetchbars = DB::table('tb_bars')->select('id', 'title', 'alias')->where('title', 'like', '%'.$keyword.'%')->get();

            if(!empty($fetchbars))
            {
                $res['bar'] = $fetchbars;
            }
			
			$fetchspas = DB::table('tb_spas')->select('id', 'title', 'alias')->where('title', 'like', '%'.$keyword.'%')->get();

            if(!empty($fetchspas))
            {
                $res['spa'] = $fetchspas;
            }
			
			if(!empty($res))
			{
				$respns['status'] = 'success';
				$respns['data'] = $res;
			}
            else
			{
				$respns['status'] = 'error';
				$respns['errors'] = 'Not found!';
                $respns['data'] = array();
			}
		}
		else
		{
			$respns['status'] = 'error';
			$respns['errors'] = 'Not found!';
            $respns['data'] = array();
		}
		return response()->json($respns);
    }
	
	public function getAutoSuggestionAjax(Request $request) {
		
		$keyword = trim($request->keyword);

		$dataArr = $respns = array(); 
		$d=0;
		if($keyword!='')
		{
            $fetchdestinations = DB::table('tb_categories')->select('id', 'category_name', 'category_alias')->where('category_published', 1)->where('category_name', 'like', '%'.$keyword.'%')->get();

            if(!empty($fetchdestinations))
            {
                foreach($fetchdestinations as $destinations)
				{
					$dataArr[$d]['id'] = $destinations->category_alias;
					$dataArr[$d]['label'] = $destinations->category_name;
					$dataArr[$d]['value'] = $destinations->category_name;
					$dataArr[$d]['type'] = 'destination';
					$d++;
				}
            }
			
			$fetchcollection = DB::table('tb_properties')->select('id', 'property_name', 'property_slug')->where('property_status', 1)->where('property_name', 'like', '%'.$keyword.'%')->get();

            if(!empty($fetchcollection))
            {
                foreach($fetchcollection as $collection)
				{
					$dataArr[$d]['id'] = $collection->property_slug;
					$dataArr[$d]['label'] = $collection->property_name;
					$dataArr[$d]['value'] = $collection->property_name;
                    $dataArr[$d]['type'] = 'category';
					$d++;
				}
            }
			
			/*$fetchrestro = DB::table('tb_restaurants')->select('id', 'title', 'alias')->where('title', 'like', '%'.$keyword.'%')->get();

            if(!empty($fetchrestro))
            {
				foreach($fetchrestro as $restro)
				{
					$dataArr[$d]['id'] = $restro->alias;
					$dataArr[$d]['label'] = $restro->title;
					$dataArr[$d]['value'] = $restro->title;
                    $dataArr[$d]['type'] = 'restro';
					$d++;
				}
			}
			
			$fetchbars = DB::table('tb_bars')->select('id', 'title', 'alias')->where('title', 'like', '%'.$keyword.'%')->get();

            if(!empty($fetchbars))
            {
                foreach($fetchbars as $bar)
				{
					$dataArr[$d]['id'] = $bar->alias;
					$dataArr[$d]['label'] = $bar->title;
					$dataArr[$d]['value'] = $bar->title;
                    $dataArr[$d]['type'] = 'bar';
					$d++;
				}
            }
			
			$fetchspas = DB::table('tb_spas')->select('id', 'title', 'alias')->where('title', 'like', '%'.$keyword.'%')->get();

            if(!empty($fetchspas))
            {
                foreach($fetchspas as $spa)
				{
					$dataArr[$d]['id'] = $spa->alias;
					$dataArr[$d]['label'] = $spa->title;
					$dataArr[$d]['value'] = $spa->title;
                    $dataArr[$d]['type'] = 'spa';
					$d++;
				}
            }*/
		}

		$ajxData = json_encode($dataArr);
		echo $request->callback.'('.$ajxData.')';
    }
	
	public function getAutoSuggestionAjaxRdp(Request $request) {
		
		$keyword = trim($request->keyword);

		$dataArr = $respns = array(); 
		$d=0;
		if($keyword!='')
		{
            $fetchdestinations = DB::table('tb_categories')->select('id', 'category_name', 'category_alias')->where('category_published', 1)->where('category_name', 'like', '%'.$keyword.'%')->get();

            if(!empty($fetchdestinations))
            {
                foreach($fetchdestinations as $destinations)
				{
					$dataArr[$d]['id'] = $destinations->category_alias;
					$dataArr[$d]['label'] = $destinations->category_name;
					$dataArr[$d]['value'] = $destinations->category_name;
					$dataArr[$d]['ids'] = $destinations->id;
					$d++;
				}
            }
		}
		$ajxData = json_encode($dataArr);
		echo $request->callback.'('.$ajxData.')';
    }
	
	public function getResturantSpaBarByTypeCityAjax(Request $request)
	{
		$res = array();
		$type = $request->type;
		$city = $request->city;
		if($type!='' && $city!='')
		{
			$srchtbl = 'tb_restaurants';
			if($type=="bars")
			{
				$srchtbl = 'tb_bars';
			}
			elseif($type=="spas")
			{
				$srchtbl = 'tb_spas';
			}
			$checkcatid = \DB::table('tb_categories')->select('id')->where('category_name', $city)->first();
			if(!empty($checkcatid))
			{
				$searchtable = \DB::table($srchtbl)->select('id','title','alias')->where('category_id', $checkcatid->id)->get();
				if(!empty($searchtable))
				{
					$res['status'] = 'success';
					$res['records'] = $searchtable;
				}
			}
			else
			{
				$res['status'] = 'error';
				$res['errors'] = 'Please select city first!';
			}
		}
		else
		{
			$res['status'] = 'error';
			$res['errors'] = 'Please select city first!';
		}
		
		return response()->json($res);
	}
}
