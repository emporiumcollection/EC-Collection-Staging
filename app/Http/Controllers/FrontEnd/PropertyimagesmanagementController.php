<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\ContainerController;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Http\Controllers\Controller;
use App\User;
use DB,Validator, Input, Redirect, CommonHelper, Mail;
class PropertyimagesmanagementController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->data['pageTitle'] = '';
        $this->data['data'] = CommonHelper::getInfo();
		\Session::put('lang', 'en');
        $getlang = \Session::get('newlang');
        $arrive_date = \Session::get('arrive_date');
        $destination_date = \Session::get('destination_date');
        $adults = \Session::get('adults');
        $childs = \Session::get('childs');
        $this->data['arrive_date'] = $this->data['destination_date'] = $this->data['childs'] = $this->data['adults'] = '';
        if (!isset($getlang)) {
            \Session::put('newlang', 'English');
        } else {
            \Session::put('lang', $getlang);
        }
        if (isset($arrive_date)) {
            $this->data['arrive_date'] = $arrive_date;
        }
        if (isset($destination_date)) {
            $this->data['destination_date'] = $destination_date;
        }
        if (isset($adults)) {
            $this->data['adults'] = $adults;
        }
        if (isset($childs)) {
            $this->data['childs'] = $childs;
        }
        $this->data['footer_text'] = \DB::table('tb_settings')->select('content')->where('key_value', 'footer_text')->first();
        $this->data['about_text'] = \DB::table('tb_settings')->select('content')->where('key_value', 'about_text')->first();

    }
	
	 public function propertyImageupload(Request $request) {
       
        $this->data['landingads'] = \DB::table('tb_advertisement')->select('adv_img', 'adv_link')->where('adv_type', 'sidebar')->where('adv_position', 'landing')->get();

		$this->data['slider'] = \DB::table('tb_sliders')->select('slider_category', 'slider_title', 'slider_description', 'slider_img', 'slider_link', 'slider_video', 'slide_type')->where('slider_category', 'Landing')->get();
		$this->data['categoryslider'] = \DB::table('tb_sliders')->where('slider_category', 'Landing')->get();
		
		$this->data['experiences'] = \DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name', 'category_image', 'category_custom_title')->where('category_published', 1)->where('parent_category_id', 8)->get();
		
		$this->data['whybookwithus'] = \DB::table('tb_whybookwithus')->select('id', 'title', 'sub_title')->where('status', 0)->get();
		/* Note:
			Now the our destinations will render from storage/app/homeOurDestination.html. 
			That file will be genrate from cron job or backend panel.  
		*/
		$this->data['ourdesitnation'] = '';
		$this->data['ourmaindesitnation'] = '';
		$this->data['social_links'] = \DB::table('tb_social')->where('status', 1)->get();
		$this->data['landing_menus'] = array();
        return view('frontend.propertyimagesmanagement.filesupload', $this->data);
    }
	
	function createNewFolder($Foldername, $ParentfolderId) {
        if ($Foldername != '') {
            $dirPath = (new ContainerController)->getContainerUserPath($ParentfolderId);
            $slug = \SiteHelpers::seoUrl(trim($Foldername));
            $result = \File::makeDirectory($dirPath . $slug, 0777, true);
            $fdata['parent_id'] = $ParentfolderId;
            $fdata['name'] = $slug;
            $fdata['display_name'] = $Foldername;
            $fdata['file_type'] = 'folder';
            $fdata['user_id'] = 1;
            $fdata['created'] = date('y-m-d h:i:s');
            $fID = \DB::table('tb_container')->insertGetId($fdata);
            return $fID;
        } else {
            return false;
        }
    }
    
    public function transferaddfile(Request $request)
	{
		$fold_id = $request->input('fold_id');
		$emailid = $request->input('emailaddress');
		$message = $request->input('message');
		$propertyname = $request->input('propertyname');
		$tdate = date('y-m-d-h-i-s');
		$curdate_propFolder = 0;
		$rules['emailaddress'] = 'required';
		$rules['propertyname'] = 'required';
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
			$newpropFolder = $this->createNewFolder($propertyname, $fold_id);
			if ($newpropFolder !== false) {
				$curdate_propFolder = $this->createNewFolder($tdate, $newpropFolder);
			}
			if($curdate_propFolder > 0) 
			{
				$dirPath = (new ContainerController)->getContainerUserPath($curdate_propFolder);
				if( is_dir($dirPath) === true )
				{
					$file = $request->file('file');
					$destinationPath = $dirPath;
					$extension = $file->getClientOriginalExtension();
					$fileName = $file->getClientOriginalName();
					$ftname = explode('.',$fileName);
					$exha = false;
					for($f=1;$exha!=true;$f++)
					{
						if (File::exists($destinationPath.$fileName))
						{
							$fileName = $ftname[0].'('.$f.').'.$extension;
						}
						else
						{
							$fileName = $fileName;
							$exha = true;
						}
					}
					// MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
					$upload_success = $file->move($destinationPath, $fileName);
					$ftype = $request->file('file')->getClientMimeType();
					$exFtype = explode('/',$ftype);
					if($exFtype[0]=="image")
					{
						$thimg = \Image::make($destinationPath.$fileName);
						$thimg->resize(128, 130);
						$thumbfile = 'thumb_'. Input::get('fold_id') .'_'.$fileName;
						$thimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
						
						$mdimg = \Image::make($destinationPath.$fileName);
						$thactualsize = getimagesize($destinationPath.$fileName);
						if($thactualsize[0]>$thactualsize[1])
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
						$thumbfile = 'format_'. Input::get('fold_id') .'_'.$fileName;
						$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
						
						$mdimg = \Image::make($destinationPath.$fileName);
						$hfactualsize = getimagesize($destinationPath.$fileName);
						if($hfactualsize[0]>$hfactualsize[1])
						{
							$mdimg->resize(1000, null, function ($constraint) {
								$constraint->aspectRatio();
							});
						}
						else
						{
							$mdimg->resize(null, 1000, function ($constraint) {
								$constraint->aspectRatio();
							});
						}
						$thumbfile = 'highflip_'. Input::get('fold_id') .'_'.$fileName;
						$mdimg->save(public_path(). '/uploads/thumbs/'.$thumbfile);
						
						$countfile = DB::table('tb_container_files')->where('folder_id', $curdate_propFolder)->where(function ($query) { $query->where('file_type', 'image/jpeg')->orWhere('file_type', 'image/png')->orWhere('file_type', 'image/gif');})->count();
						if($countfile==0)
						{
							$copytofolder = public_path().'/uploads/folder_cover_imgs/';
							$bkimg = \Image::make($destinationPath.$fileName);
							$bkimg->resize(128, 130);
							$bkimgfile = 'thumb_'. $fileName;
							$bkimg->save($copytofolder.$bkimgfile);
							
							$mdimg = \Image::make($destinationPath.$fileName);
							$thactualsize = getimagesize($destinationPath.$fileName);
							if($thactualsize[0]>$thactualsize[1])
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
							$thumbfile = 'format_'.$fileName;
							$mdimg->save($copytofolder.$thumbfile);
							
							$cmdata['temp_cover_img'] = $fileName;
							$cmdata['temp_cover_img_masonry'] = $fileName;
							$cmdata['updated'] = date('y-m-d');
							\DB::table('tb_container')->where('id', $curdate_propFolder)->update($cmdata);
						}
					}
					
					$data['folder_id'] = $curdate_propFolder;
					$data['file_name'] = $fileName;
					$data['file_type'] = $request->file('file')->getClientMimeType();
					$data['file_size'] = $request->file('file')->getClientSize();
					$data['user_id'] = \Auth::user()->id;
					$data['created'] = date('y-m-d h:i:s');
					$data['path'] = $destinationPath;
					$fileID = \DB::table('tb_container_files')->insertGetId($data);
					
					if($extension=='tif' || $extension=='cad')
					{
						$newtfname = $destinationPath.$fileName;
						$typArr = array('jpg','png');
						foreach($typArr as $imgtype)
						{
							$fileName = $ftname[0].'.'.$imgtype;
							$exha = false;
							for($f=1;$exha!=true;$f++)
							{
								if (File::exists($destinationPath.$fileName))
								{
									$fileName = $ftname[0].'('.$f.').'.$imgtype;
								}
								else
								{
									$fileName = $fileName;
									$exha = true;
								}
							}
							\Image::make($newtfname)->encode($imgtype, 100)->save($destinationPath.$fileName);
							
							$data['folder_id'] = $curdate_propFolder;
							$data['file_id'] = $fileID;
							$data['file_name'] = $fileName;
							if($imgtype=='jpg')
							{
								$data['file_type'] = 'image/jpeg';
							}
							else
							{
								$data['file_type'] = 'image/png';
							}
							
							$data['file_size'] = $request->file('file')->getClientSize();
							$data['user_id'] = \Auth::user()->id;
							$data['created'] = date('y-m-d h:i:s');
							$data['path'] = $destinationPath;
							\DB::table('tb_container_tiff_files')->insert($data);
						}
					}
					
					$data['msg'] = $message;
					$toouser['email'] = $emailid;
					$toouser['subject'] = "Files are uploaded.";
					\Mail::send('user.emails.frontend_upload', $data, function($message) use ($toouser) {
						$message->from('info@emporium-voyage.com', CNF_APPNAME);

						$message->to($toouser['email']);

						$message->subject($toouser['subject']);
					});
					
					\Mail::send('user.emails.frontend_upload', $data, function($message) use ($toouser) {
						$message->from($toouser['email']);

						$message->to('info@emporium-voyage.com');

						$message->subject($toouser['subject']);
					});
					
					return "success";
				}
				else
				{
					return "error";
				}
			}
			else
			{
				return "error";
			}
		}
		else
		{
			return $validator->withInput();
		}
	}

}
