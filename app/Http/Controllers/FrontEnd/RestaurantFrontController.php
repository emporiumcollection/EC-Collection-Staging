<?php 
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use DB, Input, Redirect;


class RestaurantFrontController extends Controller {



	public function __construct()
	{
		parent::__construct();
		
	}

	public function propertyRestrurant( Request $request )
	{
		$this->data['pagetitle'] = $request->slug;
		
		$propertiesArr = array();
		$resturantArr = array();
		$spasArr = array();
		$barsArr = array();
		$props = \DB::table('tb_properties')->select('restaurant_ids','spa_ids','bar_ids','id')->where('property_slug', $request->slug)->first();
        if (!empty($props)) {
            $propertiesArr['data'] = $props;
			if($props->restaurant_ids!='')
			{
				$residArr = explode(',',$props->restaurant_ids);
				$resfileArr = \DB::table('tb_images_res_spa_bar')->join('tb_restaurants', 'tb_restaurants.id', '=', 'tb_images_res_spa_bar.parent_id')->select('tb_restaurants.*', 'tb_images_res_spa_bar.parent_id', 'tb_images_res_spa_bar.folder_id', 'tb_images_res_spa_bar.type')->whereIn('tb_images_res_spa_bar.parent_id', $residArr)->where('tb_images_res_spa_bar.type', 'res')->get();
				if(!empty($resfileArr))
				{
					$rf=0;
					foreach($resfileArr as $resfile)
					{
						$resturantArr[$rf] = $resfile;
						$fetchressliderfolder = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('id')->where('tb_container.parent_id', $resfile->folder_id)->where('tb_container.name', 'slider')->where('tb_frontend_container.container_type', 'folder')->first();
						if(!empty($fetchressliderfolder))
						{
							$fetchressliderfiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $fetchressliderfolder->id)->where('tb_frontend_container.container_type', 'file')->get();
							if(!empty($fetchressliderfiles))
							{
								$resturantArr[$rf]->dataslider = $fetchressliderfiles;
							}
						}
						
						$fetchresgalleryfolder = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('id')->where('tb_container.parent_id', $resfile->folder_id)->where('tb_container.name', 'gallery')->where('tb_frontend_container.container_type', 'folder')->first();
						if(!empty($fetchresgalleryfolder))
						{
							$fetchresgalleryfiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $fetchresgalleryfolder->id)->where('tb_frontend_container.container_type', 'file')->get();
							if(!empty($fetchresgalleryfiles))
							{
								$resturantArr[$rf]->datagallery = $fetchresgalleryfiles;
							}
						}
						
						$fetchresmenufolder = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('id')->where('tb_container.parent_id', $resfile->folder_id)->where('tb_container.name', 'menu')->where('tb_frontend_container.container_type', 'folder')->first();
						if(!empty($fetchresmenufolder))
						{
							$fetchresmenufiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $fetchresmenufolder->id)->where('tb_frontend_container.container_type', 'file')->get();
							if(!empty($fetchresmenufiles))
							{
								$resturantArr[$rf]->datamenu = $fetchresmenufiles;
							}
						}
					}
				}
			}
			
		}
		print_r($resturantArr);
		return view('frontend.themes.emporium.properties.resto', $this->data);
	}


}