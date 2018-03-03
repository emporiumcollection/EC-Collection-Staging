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
        $this->data['pageTitle'] = '';
        $this->data['data'] = CommonHelper::getInfo();
		$this->data['about_text'] = \DB::table('tb_settings')->select('content')->where('key_value', 'about_text')->first();
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
				
				 $this->data['pageslider'] = \DB::table('tb_pages_sliders')->select( 'slider_title', 'slider_description', 'slider_img', 'slider_link', 'slider_video', 'slide_type')->where('slider_page_id', $row->pageID)->where('slider_status',1)->get();
				 
				 $this->data['whybookwithus'] = \DB::table('tb_whybookwithus')->select('id', 'title', 'sub_title')->where('status', 0)->get();
				 
				 $this->data['sidebargridAds'] = \DB::table('tb_advertisement')->select('adv_img', 'adv_link')->where('adv_type', 'sidebar')->where('adv_position', 'landing')->get();
				 
				 return view('frontend.frontendpages.defaultpage', $this->data);
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

}
