<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\DestinationController;
use DB;

class SitemapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $subdestarr = array();
    public function index()
    {
        //$properties = \DB::table('tb_properties')->where('property_status', 1)->first();
        //$pages = \DB::table('tb_properties')->where('property_status', 1)->first();
        $all_sitemap = array('properties', 'destinations', 'experiences', 'channels', 'pages');
        return response()->view('sitemap.index', [
          'allsitemap' => $all_sitemap
        ])->header('Content-Type', 'text/xml');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     *
     * Properties Sitemap
     *  
     */
    public function properties(Request $request)
    {
        $type = $request->type;
        $dbdata = array();
        $data = array();
        switch($type){
            case 'properties':
                $dbdata = \DB::table('tb_properties')->select('property_slug AS slug', 'created')->where('property_status', 1)->get();
                $data['category'] = 'properties';
                $data['parent'] = '';
                $data['row'] = $dbdata;
            break;
            case 'destinations':
                //echo "<pre>";
                //$parent_categories = (new CategoriesController())->fetchDestinationTree();
                //print_r($parent_categories); die;
                //$category_id = 0;
               // $fetchchilds = \DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name', 'category_image', 'category_alias', 'category_youtube_channel_url')->where('category_published', 1)->where('parent_category_id', $category_id)->where('id', '!=', 8)->orderby('category_order_num', 'asc')->get();
                $drr = $this->checkchilds();
                //print_r($drr);
                /*if(!empty($fetchchilds))
                {    				
    				foreach ($fetchchilds as $dest) {
                        $destarr = $this->checkchilds($dest);    
                        print_r($destarr); die;
    				}                  
                }*/
                $data['category'] = 'destinations';
                $data['parent'] = 'luxury_destinations';
                $data['row'] = $drr;
                //$dbdata = \DB::table('tb_properties')->where('property_status', 1)->get();
                
            break;
            case 'experiences':
                $parent_cat = \DB::table('tb_categories')->select('id')->where('category_alias', 'experience')->first();
                $exp_arr = array();
                if(!empty($parent_cat)){
                    $exp_arr = \DB::table('tb_categories')->select('category_alias AS slug', 'created')->where('parent_category_id', $parent_cat->id)->get();    
                }
                $data['category'] = 'experiences';
                $data['parent'] = 'luxury_experience';
                $data['row'] = $exp_arr;                
            break;
            case 'channels':
                $channel_arr = $this->checkchannels();
                //print_r($channel_arr); die;
                $data['category'] = 'channels';
                $data['parent'] = 'social-youtube';
                $data['row'] = $channel_arr;  
                //echo "<pre>";
                //print_r($data['row']); die;  
            break;
            case 'pages':
                //echo "<pre>";
                $footer_menus = \SiteHelpers::menus('footer');
                $data['category'] = 'pages';
                $data['parent'] = '';
                $data['row'] = $footer_menus;  
                
                //print_r($footer_menus);
            break;
        }
        //print_r($data['row']); die;
        return response()->view('sitemap.properties', [
            'data' => $data,
        ])->header('Content-Type', 'text/xml');
    }
    function checkchilds($parent_id=0, $tree_array=''){
        $except_id = array(8, 627, 672, 713, 714);
        if(!is_array($tree_array)){
            $tree_array = array();
        }  
        $fetchchilds = \DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name', 'category_image', 'category_alias', 'category_youtube_channel_url', 'created')->where('category_published', 1)->where('parent_category_id', $parent_id)->whereNotIn('id', $except_id)->get();
        // "<pre>";
        //print_r($fetchchilds); die;
        //$parent = (new DestinationController())->fetchcategoryaliaspath(101); 
        //print_r(implode('/',array_reverse($parent)));
        //die;
        if(!empty($fetchchilds))
        {    				
			foreach ($fetchchilds as $dest) { //print_r($dest->id); 
			    $parent = (new DestinationController())->fetchcategoryaliaspath($dest->id); 
                //print_r($parent);
                $path = implode('/',array_reverse($parent));
                //print_r($path);
                $tree_array[] = array('id'=>$dest->id, 'parent_category_id'=>$dest->parent_category_id, 'created'=>$dest->created, 'slug'=>$path);
                $tree_array = $this->checkchilds($dest->id, $tree_array);    
                //print_r($destarr); die;
			}                  
        }
        return $tree_array;                                                                             ;
        /*$subdest = \DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name', 'category_youtube_channel_url')->where('parent_category_id', $dest->id)->get();
		$getcats = '';
		$chldIds = array();
		if (!empty($subdest)) {
			$chldIds = (new DestinationController)->fetchcategoryChildListIds($dest->id);            						
		}                      
        if (count($chldIds) > 0) { 
            $getcats = " AND (category_id IN(".implode(",",$chldIds)."))"; 
        }
        $preprops = DB::select(DB::raw("SELECT COUNT(id) AS total_rows FROM property_categories_split_in_rows WHERE property_status = '1' ".$getcats));    
		if (isset($preprops[0]->total_rows) && $preprops[0]->total_rows > 0) {
			$subdestarr[] = $dest;
           // print_r($subdest);
            foreach($subdest as $sbd){ //print_r($sbd);
                $this->checkchilds($sbd);
            }   
		} 
        print_r($subdestarr); die;
        return $subdestarr;*/    
    }
    function checkchannels($parent_id=0, $tree_array=''){
        
        if(!is_array($tree_array)){
            $tree_array = array();
        }  
        $fetchchilds = \DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name', 'category_image', 'category_alias', 'category_youtube_channel_url', 'created')->where('category_published', 1)->where('parent_category_id', $parent_id)->get();
        //echo "<pre>";
        //print_r($fetchchilds); die;
        if(!empty($fetchchilds))
        {    				
			foreach ($fetchchilds as $dest) {
			    $parent = (new DestinationController())->fetchcategoryaliaspath($dest->id);                
                $path = implode('/',array_reverse($parent));
                $tree_array[] = array('id'=>$dest->id, 'parent_category_id'=>$dest->parent_category_id, 'category_youtube_channel_url'=>$dest->category_youtube_channel_url, 'created'=>$dest->created, 'slug'=>$path);
                $tree_array = $this->checkchannels($dest->id, $tree_array);
			}                  
        }
        //echo "<pre>";
        //print_r($tree_array); die;
        return $tree_array;
                  
    }
}
