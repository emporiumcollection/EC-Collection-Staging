<?php

namespace App\Helpers;

class TagsFinder {

    static function tags() {
        $tagStr = "";
        $tags = \DB::table('tb_tags_manager')->where('tag_status', 1)->get();
        foreach ($tags as $tag) {
            $tagStr .= "'" . $tag->tag_title . "',";
        }
        $proprty = \DB::table('tb_properties')->where('property_status', 1)->get();
        foreach ($proprty as $propt) {
            $tagStr .= "'" . $propt->property_name . "',";
        }
        $categories = \DB::table('tb_categories')->where('category_published', 1)->get();
        foreach ($categories as $cats) {
            $tagStr .= "'" . $cats->category_name . "',";
        }
        return substr($tagStr, 0, -1);
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

}