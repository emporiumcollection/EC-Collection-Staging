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
		$eventsArray=array();
		$eventPackagesArray=array();

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
							$fetchresgalleryfiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $fetchresgalleryfolder->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->get();
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
								$barturantArr[$bf]->dataslider = (new ContainerController)->getThumbpath($fetchbarsliderfiles->folder_id).$fetchbarsliderfiles->file_name;
							}
						}
						
						$fetchbargalleryfolder = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('tb_container.id')->where('tb_container.parent_id', $barfile->folder_id)->where('tb_container.name', 'gallery')->where('tb_frontend_container.container_type', 'folder')->first();
						if(!empty($fetchbargalleryfolder))
						{
							$fetchbargalleryfiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $fetchbargalleryfolder->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->get();
							if(!empty($fetchbargalleryfiles))
							{
								$barturantArr[$bf]->datagallery = $fetchbargalleryfiles;
							}
						}
						
						$fetchbarmenufolder = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('tb_container.id')->where('tb_container.parent_id', $barfile->folder_id)->where('tb_container.name', 'menu')->where('tb_frontend_container.container_type', 'folder')->first();
						if(!empty($fetchbarmenufolder))
						{
							$fetchbarmenufiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $fetchbarmenufolder->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->get();
							if(!empty($fetchbarmenufiles))
							{
								$barsArr[$bf]->datamenu = $fetchbarmenufiles;
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
								$spaturantArr[$sf]->dataslider = (new ContainerController)->getThumbpath($fetchspasliderfiles->folder_id).$fetchspasliderfiles->file_name;
							}
						}
						
						$fetchspagalleryfolder = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('tb_container.id')->where('tb_container.parent_id', $spafile->folder_id)->where('tb_container.name', 'gallery')->where('tb_frontend_container.container_type', 'folder')->first();
						if(!empty($fetchspagalleryfolder))
						{
							$fetchspagalleryfiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $fetchspagalleryfolder->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->get();
							if(!empty($fetchspagalleryfiles))
							{
								$spaturantArr[$sf]->datagallery = $fetchspagalleryfiles;
							}
						}
						
						$fetchspamenufolder = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('tb_container.id')->where('tb_container.parent_id', $spafile->folder_id)->where('tb_container.name', 'menu')->where('tb_frontend_container.container_type', 'folder')->first();
						if(!empty($fetchspamenufolder))
						{
							$fetchspamenufiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $fetchspamenufolder->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->get();
							if(!empty($fetchspamenufiles))
							{
								$spasArr[$sf]->datamenu = $fetchspamenufiles;
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
			
		}
		
		$this->data['propertiesArr'] = $propertiesArr;
		$this->data['resturantArr'] = $resturantArr;
		$this->data['barsArr'] = $barsArr;
		$this->data['spasArr'] = $spasArr;
		$this->data['eventsArray'] = $eventsArray;
		$this->data['eventPackagesArrayAll'] = $eventPackagesArray;
		
		return view('frontend.themes.emporium.properties.resto', $this->data);
	}
	
	public function restrurantDetail( Request $request )
	{
		$this->data['pagetitle'] = $request->slug;
		$resturantArr = array();
		 
		$resfileArr = \DB::table('tb_images_res_spa_bar')->join('tb_restaurants', 'tb_restaurants.id', '=', 'tb_images_res_spa_bar.parent_id')->select('tb_restaurants.*', 'tb_images_res_spa_bar.parent_id', 'tb_images_res_spa_bar.folder_id', 'tb_images_res_spa_bar.type')->where('tb_restaurants.alias', $request->slug)->where('tb_images_res_spa_bar.type', 'res')->first();
		if(!empty($resfileArr))
		{
			$rf=0;
			
			$resturantArr[$rf] = $resfileArr;
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
		}
		$this->data['resturantArr'] = $resturantArr;
		return view('frontend.themes.emporium.properties.resto-detail', $this->data);
	}
	
	public function barDetail( Request $request )
	{
		$this->data['pagetitle'] = $request->slug;
		
		$barsArr = array();
		$barfileArr = \DB::table('tb_images_res_spa_bar')->join('tb_bars', 'tb_bars.id', '=', 'tb_images_res_spa_bar.parent_id')->select('tb_bars.*', 'tb_images_res_spa_bar.parent_id', 'tb_images_res_spa_bar.folder_id', 'tb_images_res_spa_bar.type')->where('tb_bars.alias', $request->slug)->where('tb_images_res_spa_bar.type', 'bar')->first();
		if(!empty($barfileArr))
		{
			$bf=0;
			$barsArr[$bf] = $barfileArr;
			$fetchbarsliderfolder = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('tb_container.id')->where('tb_container.parent_id', $barfileArr->folder_id)->where('tb_container.name', 'slider')->where('tb_frontend_container.container_type', 'folder')->first();
			if(!empty($fetchbarsliderfolder))
			{
				$fetchbarsliderfiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->select('tb_container_files.folder_id','tb_container_files.file_name')->where('tb_container_files.folder_id', $fetchbarsliderfolder->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->first();
				if(!empty($fetchbarsliderfiles))
				{
					$barturantArr[$bf]->dataslider = (new ContainerController)->getThumbpath($fetchbarsliderfiles->folder_id).$fetchbarsliderfiles->file_name;
				}
			}
			
			$fetchbargalleryfolder = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('tb_container.id')->where('tb_container.parent_id', $barfileArr->folder_id)->where('tb_container.name', 'gallery')->where('tb_frontend_container.container_type', 'folder')->first();
			if(!empty($fetchbargalleryfolder))
			{
				$fetchbargalleryfiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $fetchbargalleryfolder->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->get();
				if(!empty($fetchbargalleryfiles))
				{
					$barturantArr[$bf]->datagallery = $fetchbargalleryfiles;
				}
			}
			
			$fetchbarmenufolder = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('tb_container.id')->where('tb_container.parent_id', $barfileArr->folder_id)->where('tb_container.name', 'menu')->where('tb_frontend_container.container_type', 'folder')->first();
			if(!empty($fetchbarmenufolder))
			{
				$fetchbarmenufiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $fetchbarmenufolder->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->get();
				if(!empty($fetchbarmenufiles))
				{
					$barsArr[$bf]->datamenu = $fetchbarmenufiles;
				}
			}
		}
		$this->data['barsArr'] = $barsArr;
		return view('frontend.themes.emporium.properties.bar-detail', $this->data);
	}
	
	public function spaDetail( Request $request )
	{
		$this->data['pagetitle'] = $request->slug;
		$spasArr = array();
		
		$spafileArr = \DB::table('tb_images_res_spa_bar')->join('tb_spas', 'tb_spas.id', '=', 'tb_images_res_spa_bar.parent_id')->select('tb_spas.*', 'tb_images_res_spa_bar.parent_id', 'tb_images_res_spa_bar.folder_id', 'tb_images_res_spa_bar.type')->where('tb_spas.alias', $request->slug)->where('tb_images_res_spa_bar.type', 'spa')->get();
		if(!empty($spafileArr))
		{
			$sf=0;
			$spasArr[$sf] = $spafileArr;
			$fetchspasliderfolder = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('tb_container.id')->where('tb_container.parent_id', $spafileArr->folder_id)->where('tb_container.name', 'slider')->where('tb_frontend_container.container_type', 'folder')->first();
			if(!empty($fetchspasliderfolder))
			{
				$fetchspasliderfiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->select('tb_container_files.folder_id','tb_container_files.file_name')->where('tb_container_files.folder_id', $fetchspasliderfolder->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->first();
				if(!empty($fetchspasliderfiles))
				{
					$spaturantArr[$sf]->dataslider = (new ContainerController)->getThumbpath($fetchspasliderfiles->folder_id).$fetchspasliderfiles->file_name;
				}
			}
			
			$fetchspagalleryfolder = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('tb_container.id')->where('tb_container.parent_id', $spafileArr->folder_id)->where('tb_container.name', 'gallery')->where('tb_frontend_container.container_type', 'folder')->first();
			if(!empty($fetchspagalleryfolder))
			{
				$fetchspagalleryfiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $fetchspagalleryfolder->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->get();
				if(!empty($fetchspagalleryfiles))
				{
					$spaturantArr[$sf]->datagallery = $fetchspagalleryfiles;
				}
			}
			
			$fetchspamenufolder = \DB::table('tb_container')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container.id')->select('tb_container.id')->where('tb_container.parent_id', $spafileArr->folder_id)->where('tb_container.name', 'menu')->where('tb_frontend_container.container_type', 'folder')->first();
			if(!empty($fetchspamenufolder))
			{
				$fetchspamenufiles = \DB::table('tb_container_files')->join('tb_frontend_container', 'tb_frontend_container.container_id', '=', 'tb_container_files.id')->where('tb_container_files.folder_id', $fetchspamenufolder->id)->where('tb_frontend_container.container_type', 'file')->orderBy('tb_container_files.file_sort_num','asc')->get();
				if(!empty($fetchspamenufiles))
				{
					$spasArr[$sf]->datamenu = $fetchspamenufiles;
				}
			}
		}
		$this->data['spasArr'] = $spasArr;
		return view('frontend.themes.emporium.properties.spa-detail', $this->data);
	}
	
	function reserveRestoTableRequest(Request $request)
	{
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
			
			$resArr = \DB::table('tb_restaurants')->where('id', $request->restoid)->first();
			if(!empty($resArr))
			{
				$emlData['to'] 	 = $resArr->reservation_email;
				$emlData['frmemail'] = $request->input('emailaddress');
				$emlData['subject'] = 'Table Reservation request';
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


}