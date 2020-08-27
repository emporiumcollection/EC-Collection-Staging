<?php 
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use DB, Input, Redirect;
use App\Http\Controllers\ContainerController;
use File;

class RestaurantFrontController extends Controller {



	public function __construct()
	{
		parent::__construct();
		if(!isset(\Auth::user()->id)){
            Redirect::to('/')->send();
        }
	}

	public function propertyRestrurant( Request $request )
	{
		$this->data['pagetitle'] = $request->slug;
		
		$propertiesArr = array();
		$resturantArr = array();
		$spasArr = array();
		$barsArr = array();
		$eventsArray=array();
		$inspireArray=array();
		$eventPackagesArray=array();

		$props = \DB::table('tb_properties')->select('restaurant_ids','spa_ids','bar_ids','id', 'social_youtube')->where('property_slug', $request->slug)->first();
        if (!empty($props)) {
            $propertiesArr['data'] = $props;
			if($props->restaurant_ids!='')
			{
				$residArr = explode(',',$props->restaurant_ids);
				$resfileArr = \DB::table('tb_images_res_spa_bar')->join('tb_restaurants', 'tb_restaurants.id', '=', 'tb_images_res_spa_bar.parent_id')->select('tb_restaurants.*', 'tb_images_res_spa_bar.parent_id', 'tb_images_res_spa_bar.folder_id', 'tb_images_res_spa_bar.type')->whereIn('tb_images_res_spa_bar.parent_id', $residArr)->where('tb_images_res_spa_bar.type', 'res')->get();
                //print_r($resfileArr); die;
				if(!empty($resfileArr))
				{
					$rf=0;
					foreach($resfileArr as $resfile)
					{
						$resturantArr[$rf] = $resfile;
						$fetchressliderfolder = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('tb_container.id')->where('tb_container.parent_id', $resfile->folder_id)->where('tb_container.name', 'slider')->where('tb_frontend_container.container_type', 'folder')->first();
						if(!empty($fetchressliderfolder))
						{
							$fetchressliderfiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->select('tb_container_files.folder_id','tb_container_files.file_name')->where('tb_container_files.folder_id', $fetchressliderfolder->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->first();
							if(!empty($fetchressliderfiles))
							{
								$resturantArr[$rf]->dataslider = (new ContainerController)->getThumbpath($fetchressliderfiles->folder_id).$fetchressliderfiles->file_name;
							}
						}
						
						$fetchresgalleryfolder = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('tb_container.id')->where('tb_container.parent_id', $resfile->folder_id)->where('tb_container.name', 'gallery')->where('tb_frontend_container.container_type', 'folder')->first();
						if(!empty($fetchresgalleryfolder))
						{
							//$fetchresgalleryfiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.folder_id')->where('tb_container_files.folder_id', $fetchresgalleryfolder->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->get();
                            $fetchresgalleryfiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.folder_id')->where('tb_container_files.folder_id', $fetchresgalleryfolder->id)->orderBy('tb_container_files.file_sort_num','asc')->get();
							if(!empty($fetchresgalleryfiles))
							{
								$resturantArr[$rf]->datagallery = $fetchresgalleryfiles;
								$resturantArr[$rf]->datagallerypath = (new ContainerController)->getThumbpath($fetchresgalleryfolder->id);
							}
						}
						
						$fetchresmenufolder = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('tb_container.id')->where('tb_container.parent_id', $resfile->folder_id)->where('tb_container.name', 'menu')->where('tb_frontend_container.container_type', 'folder')->first();
						if(!empty($fetchresmenufolder))
						{
							$fetchresmenufiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $fetchresmenufolder->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->get();
							if(!empty($fetchresmenufiles))
							{
								$resturantArr[$rf]->datamenu = $fetchresmenufiles;
								$resturantArr[$rf]->datamenupath = (new ContainerController)->getThumbpath($fetchresmenufolder->id);
							}
						}
						$rf++;
					}
				}
			}
			
			if($props->bar_ids!='')
			{
				$baridArr = explode(',',$props->bar_ids);
				$barfileArr = \DB::table('tb_images_res_spa_bar')->join('tb_bars', 'tb_bars.id', '=', 'tb_images_res_spa_bar.parent_id')->select('tb_bars.*', 'tb_images_res_spa_bar.parent_id', 'tb_images_res_spa_bar.folder_id', 'tb_images_res_spa_bar.type')->whereIn('tb_images_res_spa_bar.parent_id', $baridArr)->where('tb_images_res_spa_bar.type', 'bar')->get();
				if(!empty($barfileArr))
				{
					$bf=0;
					foreach($barfileArr as $barfile)
					{
						$barsArr[$bf] = $barfile;
						$fetchbarsliderfolder = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('tb_container.id')->where('tb_container.parent_id', $barfile->folder_id)->where('tb_container.name', 'slider')->where('tb_frontend_container.container_type', 'folder')->first();
						if(!empty($fetchbarsliderfolder))
						{
							$fetchbarsliderfiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->select('tb_container_files.folder_id','tb_container_files.file_name')->where('tb_container_files.folder_id', $fetchbarsliderfolder->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->first();
							if(!empty($fetchbarsliderfiles))
							{
								$barsArr[$bf]->dataslider = (new ContainerController)->getThumbpath($fetchbarsliderfiles->folder_id).$fetchbarsliderfiles->file_name;
							}
						}
						
						$fetchbargalleryfolder = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('tb_container.id')->where('tb_container.parent_id', $barfile->folder_id)->where('tb_container.name', 'gallery')->where('tb_frontend_container.container_type', 'folder')->first();
						if(!empty($fetchbargalleryfolder))
						{
							$fetchbargalleryfiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $fetchbargalleryfolder->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->get();
							if(!empty($fetchbargalleryfiles))
							{
								$barsArr[$bf]->datagallery = $fetchbargalleryfiles;
								$barsArr[$bf]->datagallerypath = (new ContainerController)->getThumbpath($fetchbargalleryfolder->id);
							}
						}
						
						$fetchbarmenufolder = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('tb_container.id')->where('tb_container.parent_id', $barfile->folder_id)->where('tb_container.name', 'menu')->where('tb_frontend_container.container_type', 'folder')->first();
						if(!empty($fetchbarmenufolder))
						{
							$fetchbarmenufiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $fetchbarmenufolder->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->get();
							if(!empty($fetchbarmenufiles))
							{
								$barsArr[$bf]->datamenu = $fetchbarmenufiles;
								$barsArr[$bf]->datamenupath = (new ContainerController)->getThumbpath($fetchbarmenufolder->id);
							}
						}
						$bf++;
					}
				}
			}
			
			if($props->spa_ids!='')
			{
				$spaidArr = explode(',',$props->spa_ids);
				$spafileArr = \DB::table('tb_images_res_spa_bar')->join('tb_spas', 'tb_spas.id', '=', 'tb_images_res_spa_bar.parent_id')->select('tb_spas.*', 'tb_images_res_spa_bar.parent_id', 'tb_images_res_spa_bar.folder_id', 'tb_images_res_spa_bar.type')->whereIn('tb_images_res_spa_bar.parent_id', $spaidArr)->where('tb_images_res_spa_bar.type', 'spa')->get();
				if(!empty($spafileArr))
				{
					$sf=0;
					foreach($spafileArr as $spafile)
					{
						$spasArr[$sf] = $spafile;
						$fetchspasliderfolder = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('tb_container.id')->where('tb_container.parent_id', $spafile->folder_id)->where('tb_container.name', 'slider')->where('tb_frontend_container.container_type', 'folder')->first();
						if(!empty($fetchspasliderfolder))
						{
							$fetchspasliderfiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->select('tb_container_files.folder_id','tb_container_files.file_name')->where('tb_container_files.folder_id', $fetchspasliderfolder->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->first();
							if(!empty($fetchspasliderfiles))
							{
								$spasArr[$sf]->dataslider = (new ContainerController)->getThumbpath($fetchspasliderfiles->folder_id).$fetchspasliderfiles->file_name;
							}
						}
						
						$fetchspagalleryfolder = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('tb_container.id')->where('tb_container.parent_id', $spafile->folder_id)->where('tb_container.name', 'gallery')->where('tb_frontend_container.container_type', 'folder')->first();
						if(!empty($fetchspagalleryfolder))
						{
							$fetchspagalleryfiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $fetchspagalleryfolder->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->get();
							if(!empty($fetchspagalleryfiles))
							{
								$spasArr[$sf]->datagallery = $fetchspagalleryfiles;
								$spasArr[$sf]->datagallerypath = (new ContainerController)->getThumbpath($fetchspagalleryfolder->id);
							}
						}
						
						$fetchspamenufolder = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('tb_container.id')->where('tb_container.parent_id', $spafile->folder_id)->where('tb_container.name', 'menu')->where('tb_frontend_container.container_type', 'folder')->first();
						if(!empty($fetchspamenufolder))
						{
							$fetchspamenufiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $fetchspamenufolder->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->get();
							if(!empty($fetchspamenufiles))
							{
								$spasArr[$sf]->datamenu = $fetchspamenufiles;
								$spasArr[$sf]->datamenupath = (new ContainerController)->getThumbpath($fetchspamenufolder->id);
							}
						}
						$sf++;
					}
				}
			}


			$eventsArray = \DB::table('tb_events')->join('tb_event_packages', 'tb_events.id', '=', 'tb_event_packages.event_id')->where('tb_events.property_id', $props->id)->groupBy('tb_event_packages.event_id')->get();
			//\DB::table('tb_events')->where('property_id', $props->id)->get();

			if(count($eventsArray)>0){
				foreach ($eventsArray as $evValue) {

					$eventPackagesArray[$evValue->id]= \DB::table('tb_event_packages')->where('event_id', $evValue->id)->get();

				}
			}
			
			$inspirefolder = \DB::table('tb_container_files')->where('folder_id', 8691)->get();
			if(!empty($inspirefolder))
			{
				$this->data['inspirefolderpath'] = (new ContainerController)->getThumbpath(8691); 
				$inspireArray = $inspirefolder;
			}
			
		}
		
		$this->data['propertiesArr'] = $propertiesArr;
		$this->data['resturantArr'] = $resturantArr;
		$this->data['barsArr'] = $barsArr;
		$this->data['spasArr'] = $spasArr;
		$this->data['eventsArray'] = $eventsArray;
		$this->data['eventPackagesArrayAll'] = $eventPackagesArray;
		$this->data['inspireArray'] = $inspireArray;
		
		return view('frontend.themes.emporium.properties.resto', $this->data);
	}
	
	public function restrurantDetail( Request $request )
	{
		$this->data['pagetitle'] = $request->slug;
		$resturantArr = $relatedgridArr = array();
		 
		$resfileArr = \DB::table('tb_images_res_spa_bar')->join('tb_restaurants', 'tb_restaurants.id', '=', 'tb_images_res_spa_bar.parent_id')->select('tb_restaurants.*', 'tb_images_res_spa_bar.parent_id', 'tb_images_res_spa_bar.folder_id', 'tb_images_res_spa_bar.type')->where('tb_restaurants.alias', $request->slug)->where('tb_images_res_spa_bar.type', 'res')->first();
		if(!empty($resfileArr))
		{
			$rf=0;
			
			$resturantArr[$rf] = $resfileArr;
			if($resfileArr->part_of_hotel==1)
			{
				$resturantArr[$rf]->social_youtube = '';
				$qury = "Select social_youtube from tb_properties where FIND_IN_SET(".$resfileArr->id.",restaurant_ids) and restaurant_ids!='' and social_youtube !=''";
				$exequry = \DB::select($qury);
				//print_r($exequry); die;
				if(!empty($exequry))
				{
					$resturantArr[$rf]->social_youtube = $exequry[0]->social_youtube;
				}
			}
			
			$fetchressliderfolder = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('tb_container.id')->where('tb_container.parent_id', $resfileArr->folder_id)->where('tb_container.name', 'slider')->where('tb_frontend_container.container_type', 'folder')->first();
			if(!empty($fetchressliderfolder))
			{
				$fetchressliderfiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->select('tb_container_files.folder_id','tb_container_files.file_name')->where('tb_container_files.folder_id', $fetchressliderfolder->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->first();
				if(!empty($fetchressliderfiles))
				{
					$resturantArr[$rf]->dataslider = (new ContainerController)->getThumbpath($fetchressliderfiles->folder_id).$fetchressliderfiles->file_name;
				}
			}
			
			$fetchresgalleryfolder = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('tb_container.id')->where('tb_container.parent_id', $resfileArr->folder_id)->where('tb_container.name', 'gallery')->where('tb_frontend_container.container_type', 'folder')->first();
			if(!empty($fetchresgalleryfolder))
			{
				$fetchresgalleryfiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $fetchresgalleryfolder->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->get();
				if(!empty($fetchresgalleryfiles))
				{
					$resturantArr[$rf]->datagallery = $fetchresgalleryfiles;
					$resturantArr[$rf]->datagallerypath = (new ContainerController)->getThumbpath($fetchresgalleryfolder->id);
				}
			}
			
			$fetchresmenufolder = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('tb_container.id')->where('tb_container.parent_id', $resfileArr->folder_id)->where('tb_container.name', 'menu')->where('tb_frontend_container.container_type', 'folder')->first();
			if(!empty($fetchresmenufolder))
			{
				$fetchresmenufiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $fetchresmenufolder->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->get();
				if(!empty($fetchresmenufiles))
				{
					$resturantArr[$rf]->datamenu = $fetchresmenufiles;
					$resturantArr[$rf]->datamenupath = (new ContainerController)->getThumbpath($fetchresmenufolder->id);
				}
			}
			
			$relatedgridquery = "SELECT tb_restaurants.id, tb_restaurants.title, tb_restaurants.alias, tb_images_res_spa_bar.parent_id, tb_images_res_spa_bar.folder_id, tb_images_res_spa_bar.type FROM tb_restaurants join tb_images_res_spa_bar on tb_images_res_spa_bar.parent_id = tb_restaurants.id WHERE tb_restaurants.id != '". $resfileArr->id ."' AND FIND_IN_SET('". $resfileArr->category_id ."', tb_restaurants.category_id) AND tb_images_res_spa_bar.type = 'res' ORDER BY tb_restaurants.id DESC LIMIT 2";
			
			$relatedgrid = DB::select(DB::raw($relatedgridquery));
			if (!empty($relatedgrid)) {
				$pr = 0;
				foreach ($relatedgrid as $rgrest) {
					$relatedgridArr[$pr]['data']['alias'] = 'restaurants/'.$rgrest->alias;
					$relatedgridArr[$pr]['data']['title'] = $rgrest->title;
					$fetchresgallery = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('tb_container.id')->where('tb_container.parent_id', $rgrest->folder_id)->where('tb_container.name', 'gallery')->where('tb_frontend_container.container_type', 'folder')->first();
					if(!empty($fetchresgallery))
					{
						$resgalleryfiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $fetchresgallery->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->first();
						if(!empty($resgalleryfiles))
						{
							if (!File::exists(public_path(). '/uploads/thumbs/format_'.$resgalleryfiles->folder_id.'_'.$resgalleryfiles->file_name))
							{
								$imgpath = (new ContainerController)->getContainerUserPath($resgalleryfiles->folder_id);
								$mdimg = \Image::make($imgpath.$resgalleryfiles->file_name);
								$actualsize = getimagesize($imgpath.$resgalleryfiles->file_name);
								if($actualsize[0]>$actualsize[1])
								{
									$mdimg->resize(320, null, function ($constraint) {
										$constraint->aspectRatio();
									});
								}
								else
								{
									$mdimg->resize(null, 320, function ($constraint) {
										$constraint->aspectRatio();
									});
								}
								$thumbfile = 'format_'.$resgalleryfiles->folder_id.'_'.$resgalleryfiles->file_name;
								$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
							}
							$relatedgridArr[$pr]['data']['galleryimage'] = $resgalleryfiles;
						}
					}
					$pr++;
				}
			}
		}
		$this->data['resturantArr'] = $resturantArr;
		$this->data['relatedgridArr'] = $relatedgridArr;
		return view('frontend.themes.emporium.properties.resto-detail', $this->data);
	}
	
	public function barDetail( Request $request )
	{
		$this->data['pagetitle'] = $request->slug;
		
		$barsArr = $relatedgridArr = array();
		$barfileArr = \DB::table('tb_images_res_spa_bar')->join('tb_bars', 'tb_bars.id', '=', 'tb_images_res_spa_bar.parent_id')->select('tb_bars.*', 'tb_images_res_spa_bar.parent_id', 'tb_images_res_spa_bar.folder_id', 'tb_images_res_spa_bar.type')->where('tb_bars.alias', $request->slug)->where('tb_images_res_spa_bar.type', 'bar')->first();
		if(!empty($barfileArr))
		{
			$bf=0;
			$barsArr[$bf] = $barfileArr;
			if($barfileArr->part_of_hotel==1)
			{
				$barsArr[$bf]->social_youtube = '';
				$qury = "Select social_youtube from tb_properties where FIND_IN_SET(".$barfileArr->id.",bar_ids) and bar_ids!='' and social_youtube !=''";
				$exequry = \DB::select($qury);
				//print_r($exequry); die;
				if(!empty($exequry))
				{
					$barsArr[$bf]->social_youtube = $exequry[0]->social_youtube;
				}
			}
			
			$fetchbarsliderfolder = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('tb_container.id')->where('tb_container.parent_id', $barfileArr->folder_id)->where('tb_container.name', 'slider')->where('tb_frontend_container.container_type', 'folder')->first();
			if(!empty($fetchbarsliderfolder))
			{
				$fetchbarsliderfiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->select('tb_container_files.folder_id','tb_container_files.file_name')->where('tb_container_files.folder_id', $fetchbarsliderfolder->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->first();
				if(!empty($fetchbarsliderfiles))
				{
					$barsArr[$bf]->dataslider = (new ContainerController)->getThumbpath($fetchbarsliderfiles->folder_id).$fetchbarsliderfiles->file_name;
				}
			}
			
			$fetchbargalleryfolder = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('tb_container.id')->where('tb_container.parent_id', $barfileArr->folder_id)->where('tb_container.name', 'gallery')->where('tb_frontend_container.container_type', 'folder')->first();
			if(!empty($fetchbargalleryfolder))
			{
				$fetchbargalleryfiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $fetchbargalleryfolder->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->get();
				if(!empty($fetchbargalleryfiles))
				{
					$barsArr[$bf]->datagallery = $fetchbargalleryfiles;
					$barsArr[$bf]->datagallerypath = (new ContainerController)->getThumbpath($fetchbargalleryfolder->id);
				}
			}
			
			$fetchbarmenufolder = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('tb_container.id')->where('tb_container.parent_id', $barfileArr->folder_id)->where('tb_container.name', 'menu')->where('tb_frontend_container.container_type', 'folder')->first();
			if(!empty($fetchbarmenufolder))
			{
				$fetchbarmenufiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $fetchbarmenufolder->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->get();
				if(!empty($fetchbarmenufiles))
				{
					$barsArr[$bf]->datamenu = $fetchbarmenufiles;
					$barsArr[$bf]->datamenupath = (new ContainerController)->getThumbpath($fetchbarmenufolder->id);
				}
			}
			
			$relatedgridquery = "SELECT tb_bars.id, tb_bars.title, tb_bars.alias, tb_images_res_spa_bar.parent_id, tb_images_res_spa_bar.folder_id, tb_images_res_spa_bar.type FROM tb_bars join tb_images_res_spa_bar on tb_images_res_spa_bar.parent_id = tb_bars.id WHERE tb_bars.id != '". $barfileArr->id ."' AND FIND_IN_SET('". $barfileArr->category_id ."', tb_bars.category_id) AND tb_images_res_spa_bar.type = 'bar' ORDER BY tb_bars.id DESC LIMIT 2";
			
			$relatedgrid = DB::select(DB::raw($relatedgridquery));
			if (!empty($relatedgrid)) {
				$pr = 0;
				foreach ($relatedgrid as $rgrest) {
					$relatedgridArr[$pr]['data']['alias'] = 'bars/'.$rgrest->alias;
					$relatedgridArr[$pr]['data']['title'] = $rgrest->title;
					$fetchresgallery = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('tb_container.id')->where('tb_container.parent_id', $rgrest->folder_id)->where('tb_container.name', 'gallery')->where('tb_frontend_container.container_type', 'folder')->first();
					if(!empty($fetchresgallery))
					{
						$resgalleryfiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $fetchresgallery->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->first();
						if(!empty($resgalleryfiles))
						{
							if (!File::exists(public_path(). '/uploads/thumbs/format_'.$resgalleryfiles->folder_id.'_'.$resgalleryfiles->file_name))
							{
								$imgpath = (new ContainerController)->getContainerUserPath($resgalleryfiles->folder_id);
								$mdimg = \Image::make($imgpath.$resgalleryfiles->file_name);
								$actualsize = getimagesize($imgpath.$resgalleryfiles->file_name);
								if($actualsize[0]>$actualsize[1])
								{
									$mdimg->resize(320, null, function ($constraint) {
										$constraint->aspectRatio();
									});
								}
								else
								{
									$mdimg->resize(null, 320, function ($constraint) {
										$constraint->aspectRatio();
									});
								}
								$thumbfile = 'format_'.$resgalleryfiles->folder_id.'_'.$resgalleryfiles->file_name;
								$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
							}
							$relatedgridArr[$pr]['data']['galleryimage'] = $resgalleryfiles;
						}
					}
					$pr++;
				}
			}
		}
		$this->data['barsArr'] = $barsArr;
		$this->data['relatedgridArr'] = $relatedgridArr;
		return view('frontend.themes.emporium.properties.bar-detail', $this->data);
	}
	
	public function spaDetail( Request $request )
	{
		$this->data['pagetitle'] = $request->slug;
		$spasArr = $relatedgridArr = array();
		
		$spafileArr = \DB::table('tb_images_res_spa_bar')->join('tb_spas', 'tb_spas.id', '=', 'tb_images_res_spa_bar.parent_id')->select('tb_spas.*', 'tb_images_res_spa_bar.parent_id', 'tb_images_res_spa_bar.folder_id', 'tb_images_res_spa_bar.type')->where('tb_spas.alias', $request->slug)->where('tb_images_res_spa_bar.type', 'spa')->first();
		
		if(!empty($spafileArr))
		{
			$sf=0;
			$spasArr[$sf] = $spafileArr;
			if($spafileArr->part_of_hotel==1)
			{
				$spasArr[$sf]->social_youtube = '';
				$qury = "Select social_youtube from tb_properties where FIND_IN_SET(".$spafileArr->id.",spa_ids) and spa_ids!='' and social_youtube !=''";
				$exequry = \DB::select($qury);
				//print_r($exequry); die;
				if(!empty($exequry))
				{
					$spasArr[$sf]->social_youtube = $exequry[0]->social_youtube;
				}
			}
			
			$fetchspasliderfolder = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('tb_container.id')->where('tb_container.parent_id', $spafileArr->folder_id)->where('tb_container.name', 'slider')->where('tb_frontend_container.container_type', 'folder')->first();
			if(!empty($fetchspasliderfolder))
			{
				$fetchspasliderfiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->select('tb_container_files.folder_id','tb_container_files.file_name')->where('tb_container_files.folder_id', $fetchspasliderfolder->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->first();
				if(!empty($fetchspasliderfiles))
				{
					$spasArr[$sf]->dataslider = (new ContainerController)->getThumbpath($fetchspasliderfiles->folder_id).$fetchspasliderfiles->file_name;
				}
			}
			
			$fetchspagalleryfolder = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('tb_container.id')->where('tb_container.parent_id', $spafileArr->folder_id)->where('tb_container.name', 'gallery')->where('tb_frontend_container.container_type', 'folder')->first();
			if(!empty($fetchspagalleryfolder))
			{
				$fetchspagalleryfiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $fetchspagalleryfolder->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->get();
				if(!empty($fetchspagalleryfiles))
				{
					$spasArr[$sf]->datagallery = $fetchspagalleryfiles;
					$spasArr[$sf]->datagallerypath = (new ContainerController)->getThumbpath($fetchspagalleryfolder->id);
				}
			}
			
			$fetchspamenufolder = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('tb_container.id')->where('tb_container.parent_id', $spafileArr->folder_id)->where('tb_container.name', 'menu')->where('tb_frontend_container.container_type', 'folder')->first();
			if(!empty($fetchspamenufolder))
			{
				$fetchspamenufiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $fetchspamenufolder->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->get();
				if(!empty($fetchspamenufiles))
				{
					$spasArr[$sf]->datamenu = $fetchspamenufiles;
					$spasArr[$sf]->datamenupath = (new ContainerController)->getThumbpath($fetchspamenufolder->id);
				}
			}
			
			$relatedgridquery = "SELECT tb_spas.id, tb_spas.title, tb_spas.alias, tb_images_res_spa_bar.parent_id, tb_images_res_spa_bar.folder_id, tb_images_res_spa_bar.type FROM tb_spas join tb_images_res_spa_bar on tb_images_res_spa_bar.parent_id = tb_spas.id WHERE tb_spas.id != '". $spafileArr->id ."' AND FIND_IN_SET('". $spafileArr->category_id ."', tb_spas.category_id) AND tb_images_res_spa_bar.type = 'spa' ORDER BY tb_spas.id DESC LIMIT 2";
			
			$relatedgrid = DB::select(DB::raw($relatedgridquery));
			if (!empty($relatedgrid)) {
				$pr = 0;
				foreach ($relatedgrid as $rgrest) {
					$relatedgridArr[$pr]['data']['alias'] = 'spas/'.$rgrest->alias;
					$relatedgridArr[$pr]['data']['title'] = $rgrest->title;
					$fetchresgallery = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('tb_container.id')->where('tb_container.parent_id', $rgrest->folder_id)->where('tb_container.name', 'gallery')->where('tb_frontend_container.container_type', 'folder')->first();
					if(!empty($fetchresgallery))
					{
						$resgalleryfiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $fetchresgallery->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->first();
						if(!empty($resgalleryfiles))
						{
							if (!File::exists(public_path(). '/uploads/thumbs/format_'.$resgalleryfiles->folder_id.'_'.$resgalleryfiles->file_name))
							{
								$imgpath = (new ContainerController)->getContainerUserPath($resgalleryfiles->folder_id);
								$mdimg = \Image::make($imgpath.$resgalleryfiles->file_name);
								$actualsize = getimagesize($imgpath.$resgalleryfiles->file_name);
								if($actualsize[0]>$actualsize[1])
								{
									$mdimg->resize(320, null, function ($constraint) {
										$constraint->aspectRatio();
									});
								}
								else
								{
									$mdimg->resize(null, 320, function ($constraint) {
										$constraint->aspectRatio();
									});
								}
								$thumbfile = 'format_'.$resgalleryfiles->folder_id.'_'.$resgalleryfiles->file_name;
								$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
							}
							$relatedgridArr[$pr]['data']['galleryimage'] = $resgalleryfiles;
						}
					}
					$pr++;
				}
			}
		}
		$this->data['spasArr'] = $spasArr;
		$this->data['relatedgridArr'] = $relatedgridArr;
		return view('frontend.themes.emporium.properties.spa-detail', $this->data);
	}
	
	function reserveRestoTableRequest(Request $request)
	{
		$rules['reservetype'] = 'required';
		$rules['restoid'] = 'required';
		$rules['firstname'] = 'required';
		$rules['lastname'] = 'required';
		$rules['emailaddress'] = 'required';
		$rules['reserve_day'] = 'required';
		$rules['reserve_month'] = 'required';
		$rules['reserve_year'] = 'required';
		$rules['reserve_hour'] = 'required';
		$rules['reserve_minute'] = 'required';
		$rules['totalguest'] = 'required';
		$rules['agree'] = 'required';
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			
			$type = $request->input('reservetype');
			$srchtbl = 'tb_restaurants';
			if($type=="bar")
			{
				$srchtbl = 'tb_bars';
			}
			elseif($type=="spa")
			{
				$srchtbl = 'tb_spas';
			}
			
			$resArr = \DB::table($srchtbl)->where('id', $request->restoid)->first();
			if(!empty($resArr))
			{
				$rsdata['reservetype'] = $type;
				$rsdata['tbl_id'] = $request->restoid;
				$rsdata['firstname'] = $request->input('firstname');
				$rsdata['lastname'] = $request->input('lastname');
				$rsdata['emailaddress'] = $request->input('emailaddress');
				$rsdata['telephone_code'] = $request->input('telephone_code');
				$rsdata['telephone_number'] = $request->input('telephone_number');
				$rsdata['telephone_code2'] = $request->input('telephone_code2');
				$rsdata['telephone_number2'] = $request->input('telephone_number2');
				$rsdata['reserve_day'] = $request->input('reserve_day');
				$rsdata['reserve_month'] = $request->input('reserve_month');
				$rsdata['reserve_year'] = $request->input('reserve_year');
				$rsdata['reserve_hour'] = $request->input('reserve_hour');
				$rsdata['reserve_minute'] = $request->input('reserve_minute');
				$rsdata['totalguest'] = $request->input('totalguest');
				$rsdata['query'] = $request->input('query');
				$rsdata['created'] = date('Y-m-d h:i:s');
				\DB::table('tb_restro_spa_bar_reservation')->insertGetId($rsdata);
				
				$emlData['to'] 	 = $resArr->reservation_email;
				$emlData['frmemail'] =  "info@emporium-voyage.com";
				$emlData['subject'] = 'Table Reservation request for '.$resArr->title;
				$emessage = '<p><b>Name : '.$resArr->title.'</b></p>';
				$emessage = '<p><b>First name : '.$request->input('firstname').'</b></p>';
				$emessage .= '<p><b>last name : '.$request->input('lastname').'</b></p>';
				$emessage .= '<p><b>Date : '.$request->input('reserve_day').' '.$request->input('reserve_month').' '. $request->input('reserve_year').'</b></p>';
				$emessage .= '<p><b>Time : '.$request->input('reserve_hour').' '.$request->input('reserve_minute').'</b></p>';
				$emessage .= '<p><b>Guests : '.$request->input('totalguest').'</b></p>';
				$emessage .= '<p><b>Message : '.$request->input('query').'</b></p>';
				$edata['emessage'] = $emessage;
				
				\Mail::send('user.emails.contact', $edata, function($message) use ($emlData)
				{
					$message->from($emlData['frmemail'], CNF_APPNAME);

					$message->to( $emlData['to']);
					
					$message->subject($emlData['subject']);
				});
				
				$emlData['to'] 	= $request->input('emailaddress');
				$emlData['frmemail'] =  "info@emporium-voyage.com";
				\Mail::send('user.emails.contact', $edata, function($message) use ($emlData)
				{
					$message->from($emlData['frmemail'], CNF_APPNAME);

					$message->to( $emlData['to']);
					
					$message->subject($emlData['subject']);
				});
				
				$rep['status'] = 'success';
				return json_encode($rep);
			}
		}
		else {
			$rep['status'] = 'error';
			$rep['errors'] = $validator->errors()->all();
			return json_encode($rep);
		}
	}
	
	public function resturantSpaBarByTypeCityAjax(Request $request)
	{
		$res = array();
		$type = $request->type;
		$city = $request->city;
		if($type!='' && $city!='')
		{
			$srchtbl = 'tb_restaurants';
			if($type=="bar")
			{
				$srchtbl = 'tb_bars';
			}
			elseif($type=="spa")
			{
				$srchtbl = 'tb_spas';
			}
			
			$searchtable = \DB::table($srchtbl)->select('id','title','alias')->where('category_id', $city)->get();
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
		
		return response()->json($res);
	}
	
	public function resturantSpaBarSearchAjax(Request $request)
	{
		$res = array();
		$type = $request->type;
		$city = $request->city;
		$searchid = $request->searchid;
		if($type!='' && $city!='' && $searchid!='')
		{
			$srchtbl = 'tb_restaurants';
			if($type=="bar")
			{
				$srchtbl = 'tb_bars';
			}
			elseif($type=="spa")
			{
				$srchtbl = 'tb_spas';
			}
			
			$searchrecord = \DB::table($srchtbl)->where('id', $searchid)->first();
			if(!empty($searchrecord))
			{
				$res['status'] = 'success';
                $res['record'] = $searchrecord;
			}
		}
		else
		{
			$res['status'] = 'error';
			$res['errors'] = 'Not Found!';
		}
		
		return response()->json($res);
	}

public function getEventPackages( Request $request )
	{
			$res = array();
			$eventID = $request->eventID;
			
			if($eventID!='')
			{
				

				$eventsArray = \DB::table('tb_events')->join('tb_event_packages', 'tb_events.id', '=', 'tb_event_packages.event_id')->where('event_id', $eventID)->orderBy('tb_event_packages.event_id')->get();
				if(!empty($eventsArray))
				{
					$res['status'] = 'success';
	                $res['records'] = $eventsArray;
				}
			}
			else
			{
				$res['status'] = 'error';
				$res['errors'] = 'Please select event to view pacakges!';
		}
		
		return response()->json($res);	

	}
}