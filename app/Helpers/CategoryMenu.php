<?php
namespace App\Helpers;

class CategoryMenu
{
    static function menu()
    {
		$category ='';
		$cate = \DB::table('tb_categories')->where('parent_category_id', 0)->where('category_featured', 1)->orderBy('category_order_num', 'asc')->get();
		if(!empty($cate))
		{
			foreach($cate as $cateobj){
				$category .= '<li class="'.$cateobj->category_alias.'">';
				$category .= '<a href="'.url('category/'.$cateobj->category_alias).'">'.$cateobj->category_name.'</a>';
				
				$subcate = \DB::table('tb_categories')->where('parent_category_id', $cateobj->id)->orderBy('category_order_num', 'asc')->get();
				if(!empty($subcate))
				{
					$category .= '<div class="sub">';
					$category .= '<div class="sub_inner">';
					$category .= '<ul class="fotograf_overview_list">';
					foreach($subcate as $subcatObj)
					{
						$category .= '<li><a href="'.url('category/'.$subcatObj->category_alias).'">'.$subcatObj->category_name.'</a></li>';
						if((count($subcate)%5)==0)
						{
							$category .= '</ul>';
							$category .= '<ul class="fotograf_overview_list">';
						}
					}
					$category .= '</ul>';
					$category .= '</div>';
					$category .= '</div>';
				}
				
				$category .= '<span class="top_nav_sep">|</span>';
				$category .= '</li>';
			}
		}
		 
		return $category;
    }
}