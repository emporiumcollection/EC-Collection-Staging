<?php

namespace App\Helpers;
use App\Http\Controllers\HomeController;
use DB;

class TagsFinder {

    static function tags() {
        $tagStr = "";
        $tags = \DB::table('tb_tags_manager')->where('tag_status', 1)->get();
        foreach ($tags as $tag) {
			/*$TagsCon = \DB::table('tb_container_tags')->where('tag_id', $tag->id)->count();
			if($TagsCon>0)
			{*/
				$tagStr .= "'" . $tag->tag_title . "',";
			//}
        }
        $proprty = \DB::table('tb_properties')->select('id','property_name')->where('property_status', 1)->get();
        foreach ($proprty as $propt) {
            $tagStr .= "'" . $propt->property_name . "',";
        }
        $categories = \DB::table('tb_categories')->where('category_published', 1)->get();
        foreach ($categories as $cats) {
			/*$subdest = \DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name')->where('parent_category_id', $cats->id)->get();
			$getcats = '';
			$chldIds = array();
			if (!empty($subdest)) {
				$chldIds = (new HomeController)->fetchcategoryChildListIds($cats->id);
				array_unshift($chldIds, $cats->id);
			} else {
				$chldIds[] = $cats->id;
			}

			if (!empty($chldIds)) {
				$getcats = " AND (" . implode(" || ", array_map(function($v) {
									return sprintf("FIND_IN_SET('%s', property_category_id)", $v);
								}, array_values($chldIds))) . ")";
			}

			$preprops = DB::select(DB::raw("SELECT COUNT(*) AS total_rows FROM tb_properties WHERE property_status = '1' $getcats"));

			if (isset($preprops[0]->total_rows) && $preprops[0]->total_rows > 0) {*/
				$tagStr .= "'" . $cats->category_name . "',";
			//}
        }
        return substr($tagStr, 0, -1);
    }
	
	static function findProperties() {
        $tagStr = "";
        if(\Session::get('gid')!=1 && \Session::get('gid')!=2){
			$uid = \Auth::user()->id;
			$proprty = \DB::table('tb_properties')->select('id','property_name')->where('property_status', 1)->where('user_id', $uid)->get();
        }
		else
		{
			$proprty = \DB::table('tb_properties')->select('id','property_name')->where('property_status', 1)->get();
		}
        foreach ($proprty as $propt) {
            $tagStr .= '"' . $propt->property_name . '",';
        }
        return substr($tagStr, 0, -1);
    }
	
	static function finddestinations() {
        $destStr = "";
        $categories = \DB::table('tb_categories')->where('category_published', 1)->where('parent_category_id', '!=', 8)->where('id', '!=', 8)->get();
        foreach ($categories as $cats) {
			/*$subdest = \DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name')->where('parent_category_id', $cats->id)->get();
			$getcats = '';
			$chldIds = array();
			if (!empty($subdest)) {
				$chldIds = (new HomeController)->fetchcategoryChildListIds($cats->id);
				array_unshift($chldIds, $cats->id);
			} else {
				$chldIds[] = $cats->id;
			}

			if (!empty($chldIds)) {
				$getcats = " AND (" . implode(" || ", array_map(function($v) {
									return sprintf("FIND_IN_SET('%s', property_category_id)", $v);
								}, array_values($chldIds))) . ")";
			}

			$preprops = DB::select(DB::raw("SELECT COUNT(*) AS total_rows FROM tb_properties WHERE property_status = '1' $getcats"));

			if (isset($preprops[0]->total_rows) && $preprops[0]->total_rows > 0) {*/
				$destStr .= "'" . $cats->category_name . "',";
			//}
        }
        return substr($destStr, 0, -1);
    }

    static function product_suggestions() {
        $tagStr = "";
        $tags = \DB::table('sh_products')->where('status', 'Enabled')->get();
        if(!empty($tags)) {
            foreach ($tags as $tag) {
                $tagStr .= "'" . str_replace("'", "\'", $tag->titile) . "',";
            }
        }
        return rtrim($tagStr, ',');
    }

    static function article_suggestions() {
        $tagStr = "";
        $tags = \DB::table('tb_post_articles')->where('status', '1')->get();
        if(!empty($tags)) {
            foreach ($tags as $tag) {
                $tagStr .= "'" . str_replace("'", "\'", $tag->title_pos_1) . "',";
            }
        }
        return rtrim($tagStr, ',');
    }
    
    static function findLeadProperties() {
        $tagStr = "";
        if(\Session::get('gid')!=1 && \Session::get('gid')!=2){
			$uid = \Auth::user()->id;
			$proprty = \DB::table('tb_properties')->select('id','property_name')->where('property_status', 1)->where('user_id', $uid)->get();
        }
		else
		{
			$proprty = \DB::table('tb_properties')->select('id','property_name')->where('property_status', 1)->get();
		}
        foreach ($proprty as $propt) {
            $tagStr .= "'" . $propt->property_name . "',";
        }
        return substr($tagStr, 0, -1);
    }
    static function findLeadListing() {
        $tagStr = "";
        $gp_id = \CommonHelper::getusertype('new-lead');
        
		$proprty = \DB::table('tb_users')->select('id','first_name')->where('group_id', $gp_id)->get();
		
        foreach ($proprty as $propt) {
            $tagStr .= "'" . $propt->first_name . "',";
        }
        return substr($tagStr, 0, -1);
    }

}