<?php 
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\ContainerController;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Http\Controllers\Controller;
use App\User;
use DB,Validator, Input, Redirect, CommonHelper, Mail;
class FrontendPagesController extends Controller {

    public function __construct() {
        parent::__construct();
        /*if(!isset(\Auth::user()->id)){
            Redirect::to('/')->send();
        }*/
    }
	
	 public function index(Request $request) {
		 
		 if ($request->segment(1) == '') :
            return Redirect::to('');
        endif;
		
       $page = trim($request->segment(1));
       if ($page != '') {
            $content = \DB::table('tb_pages_content')->where('alias', '=', $page)->where('status', '=', 'enable')->first();
			
			if (count($content) >= 1) {
                $row = $content;
                $this->data['pageTitle'] = $row->title;
                $this->data['pageMetakey'] = ($row->metakey != '' ? $row->metakey : CNF_METAKEY);
                $this->data['pageMetadesc'] = ($row->metadesc != '' ? $row->metadesc : CNF_METADESC);
				
				if ($row->access != '') {
                    $access = json_decode($row->access, true);
                } else {
                    $access = array();
                }

                // If guest not allowed 
                if ($row->allow_guest != 1) {
                    $group_id = \Session::get('gid');
                    $isValid = (isset($access[$group_id]) && $access[$group_id] == 1 ? 1 : 0 );
                    if ($isValid == 0) {
                        return Redirect::to('')
                                        ->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_restric')));
                    }
                }
				
				$this->data['pagecontent'] = $row->content;
				
				 $this->data['pageslider'] = \DB::table('tb_pages_sliders')->select( 'slider_title', 'slider_description', 'slider_img', 'slider_link', 'slider_video', 'slide_type')->where('slider_page_id', $row->pageID)->where('slider_status',1)->orderBy('sort_num','asc')->get();
				 
				 $this->data['whybookwithus'] = \DB::table('tb_whybookwithus')->select('id', 'title', 'sub_title')->where('status', 0)->get();
				 
				 $this->data['sidebargridAds'] = \DB::table('tb_advertisement')->select('adv_img', 'adv_link')->where('adv_type', 'sidebar')->where('adv_position', 'landing')->get();
				 
				 return view('frontend.themes.emporium.pages.page', $this->data);
			}
			else 
			{
				return Redirect::to('')
								->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
			}
	   }
	   else 
		{
			return Redirect::to('')
							->with('message', \SiteHelpers::alert('error', \Lang::get('core.note_noexists')));
		}
    }
	
	public function socialYoutube(Request $request)
	{
		$channel_url = '';
		$catid = '';
		if (trim($request->cat)!='' && !is_null($request->cat)) {
			$cateObjsc = \DB::table('tb_categories')->select('id', 'category_youtube_channel_url')->where('category_alias', trim($request->cat))->where('category_published', 1)->first();
		}
		else
		{
			$cateObjsc = \DB::table('tb_categories')->select('id', 'category_youtube_channel_url')->where('parent_category_id', 0)->where('category_published', 1)->where('id', '!=', 8)->orderBy('category_order_num','asc')->first();
		}
		
		if (!empty($cateObjsc)) {
			$channel_url = $cateObjsc->category_youtube_channel_url;
			$catid = $cateObjsc->id;
		}
		$this->data['channel_url'] = $channel_url;
		$this->data['catid'] = $catid;
		return view('frontend.themes.emporium.pages.social_youtube_page', $this->data);
	}

	public function socialStreamWall(Request $request)
	{
		$socialpropertiesArr = array();
		if (trim($request->input('sp'))!='' && !is_null($request->input('sp'))) {
			$scprops = \DB::table('tb_properties')->select('property_name', 'social_twitter', 'social_facebook','social_google','social_youtube','social_pinterest','social_vimeo')->where('property_slug', trim($request->input('sp')))->where('property_status', 1)->where(function ($query) { $query->where('social_twitter', '!=', '')->orWhere('social_facebook', '!=', '')->orWhere('social_youtube', '!=', '')->orWhere('social_vimeo', '!=', '')->orWhere('social_pinterest', '!=', '')->orWhere('social_google', '!=', ''); })->orderBy('property_name','asc')->first();
		} else {
			$scprops = \DB::table('tb_properties')->select('property_name', 'social_twitter', 'social_facebook','social_google','social_youtube','social_pinterest','social_vimeo')->where('property_status', 1)->where(function ($query) { $query->where('social_twitter', '!=', '')->orWhere('social_facebook', '!=', '')->orWhere('social_youtube', '!=', '')->orWhere('social_vimeo', '!=', '')->orWhere('social_pinterest', '!=', '')->orWhere('social_google', '!=', ''); })->orderBy('property_name','asc')->first();
		}

		if (!empty($scprops)) {
			$socialpropertiesArr = $scprops;
		}
		$this->data['socialpropertiesArr'] = $socialpropertiesArr;
		
		$this->data['propertiesArr'] = \DB::table('tb_properties')->select('property_name', 'property_slug')->where('property_status', 1)->where(function ($query) { $query->where('social_twitter', '!=', '')->orWhere('social_facebook', '!=', '')->orWhere('social_youtube', '!=', '')->orWhere('social_vimeo', '!=', '')->orWhere('social_pinterest', '!=', '')->orWhere('social_google', '!=', ''); })->get();
		
		return view('frontend.themes.emporium.pages.social_stream_page', $this->data);
	}

}
