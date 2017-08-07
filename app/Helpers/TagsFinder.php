<?php
namespace App\Helpers;

class TagsFinder
{
    static function tags()
    {
		$tagStr ="";
		$tags = \DB::table('tb_tags_manager')->where('tag_status', 1)->get();
		foreach($tags as $tag){
			$tagStr .= "'".$tag->tag_title."',";
		}
		$proprty = \DB::table('tb_properties')->where('property_status',1)->get();
		foreach($proprty as $propt){
			$tagStr .= "'".$propt->property_name."',";
		}
		$categories = \DB::table('tb_categories')->where('category_published',1)->get();
		foreach($categories as $cats){
			$tagStr .= "'".$cats->category_name."',";
		}
		return substr($tagStr,0,-1);
    }
}