<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 
use File;
use DB, Response;
use App\User;
use App\Http\Controllers\ContainerController; 


class PropertydataimportController extends Controller {

	protected $data = array();	
	
	public function __construct()
	{
		
	}
	
	public function Propertyimport( Request $request)
	{
		$sa_property_fetch = DB::table('sa_tb_properties')->where('import_status', 0)->take(100)->get();
		if(!empty($sa_property_fetch))
		{
			foreach($sa_property_fetch as $property)
			{
				$sa_pro_id = $property->id;
				
				$pdata['property_name'] = $property->property_name;
				$pdata['property_short_name'] = $property->property_short_name;
				$pdata['property_slug'] = $property->property_slug;
				$pdata['property_type'] = 'Villas';
				$pdata['booking_type'] = $property->booking_type;
				$pdata['city'] = $property->city;
				$pdata['country'] = $property->country;
				$pdata['website'] = $property->website;
				$pdata['phone'] = $property->phone;
				$pdata['email'] = $property->email;
				$pdata['city_tax'] = $property->city_tax;
				$pdata['about_property'] = $property->about_property;
				$pdata['assigned_user_id'] = $property->assigned_user_id;
				$pdata['owner_name'] = $property->owner_name;
				$pdata['owner_last_name'] = $property->owner_last_name;
				$pdata['owner_address'] = $property->owner_address;
				$pdata['owner_city'] = $property->owner_city;
				$pdata['owner_postal_code'] = $property->owner_postal_code;
				$pdata['owner_country'] = $property->owner_country;
				$pdata['owner_phone_primary'] = $property->owner_phone_primary;
				$pdata['owner_phone_emergency'] = $property->owner_phone_emergency;
				$pdata['owner_email_primary'] = $property->owner_email_primary;
				$pdata['owner_email_secondary'] = $property->owner_email_secondary;
				$pdata['owner_website'] = $property->owner_website;
				$pdata['owner_contact_person'] = $property->owner_contact_person;
				$pdata['agent_name'] = $property->agent_name;
				$pdata['agent_last_name'] = $property->agent_last_name;
				$pdata['agent_address'] = $property->agent_address;
				$pdata['agent_city'] = $property->agent_city;
				$pdata['agent_postal_code'] = $property->agent_postal_code;
				$pdata['agent_country'] = $property->agent_country;
				$pdata['agent_phone_primary'] = $property->agent_phone_primary;
				$pdata['agent_phone_emergency'] = $property->agent_phone_emergency;
				$pdata['agent_email_primary'] = $property->agent_email_primary;
				$pdata['agent_email_secondary'] = $property->agent_email_secondary;
				$pdata['agent_website'] = $property->agent_website;
				$pdata['agent_linked_in'] = $property->agent_linked_in;
				$pdata['user_id'] = $property->user_id;
				$pdata['created'] = $property->created;
				$pdata['updated'] = $property->updated;
				$pdata['property_category_id'] = $property->property_category_id;
				$pdata['feature_property'] = $property->feature_property;
				$pdata['editor_choice_property'] = $property->editor_choice_property;
				$pdata['property_detail_view'] = $property->property_detail_view;
				$pdata['property_status'] = $property->property_status;
				$pdata['property_category_id'] = '363';
				$new_prop_id = DB::table('tb_properties')->insertGetId($pdata);
				
				$existcobnatiner = DB::table('sa_tb_container')->where('name', $property->property_slug)->where('parent_id', '136')->first();
				if(!empty($existcobnatiner))
				{
					$cdata['parent_id'] = 6;
					$cdata['name'] = $existcobnatiner->name;
					$cdata['display_name'] = $existcobnatiner->display_name;
					$cdata['file_type'] = $existcobnatiner->file_type;
					$cdata['user_id'] = $existcobnatiner->user_id;
					$cdata['child_id'] = $existcobnatiner->child_id;
					$cdata['global_permission'] = $existcobnatiner->global_permission;
					$cdata['title'] = $existcobnatiner->title;
					$cdata['description'] = $existcobnatiner->description;
					$cdata['sort_num'] = $existcobnatiner->sort_num;
					$cdata['cover_img'] = $existcobnatiner->cover_img;
					$cdata['temp_cover_img'] = $existcobnatiner->temp_cover_img;
					$cdata['temp_cover_img_masonry'] = $existcobnatiner->temp_cover_img_masonry;
					$cdata['display_name_eng'] = $existcobnatiner->display_name_eng;
					$cdata['title_eng'] = $existcobnatiner->title_eng;
					$cdata['description_eng'] = $existcobnatiner->description_eng;
					$cdata['created'] = $existcobnatiner->created;
					$cdata['updated'] = $existcobnatiner->updated;
					$new_propcontainer_id = DB::table('tb_container')->insertGetId($cdata);
					
					$existcobnatinerchild = DB::table('sa_tb_container')->where('parent_id', $existcobnatiner->id)->get();
					if(!empty($existcobnatinerchild))
					{
						foreach($existcobnatinerchild as $container)
						{
							$ccdata['parent_id'] = $new_propcontainer_id;
							$ccdata['name'] = $container->name;
							$ccdata['display_name'] = $container->display_name;
							$ccdata['file_type'] = $container->file_type;
							$ccdata['user_id'] = $container->user_id;
							$ccdata['child_id'] = $container->child_id;
							$ccdata['global_permission'] = $container->global_permission;
							$ccdata['title'] = $container->title;
							$ccdata['description'] = $container->description;
							$ccdata['sort_num'] = $container->sort_num;
							$ccdata['cover_img'] = $container->cover_img;
							$ccdata['temp_cover_img'] = $container->temp_cover_img;
							$ccdata['temp_cover_img_masonry'] = $container->temp_cover_img_masonry;
							$ccdata['display_name_eng'] = $container->display_name_eng;
							$ccdata['title_eng'] = $container->title_eng;
							$ccdata['description_eng'] = $container->description_eng;
							$ccdata['created'] = $container->created;
							$ccdata['updated'] = $container->updated;
							$new_container_id = DB::table('tb_container')->insertGetId($ccdata);
							
							$existcobnatinerfile = DB::table('sa_tb_container_files')->where('folder_id', $container->id)->get();
							if(!empty($existcobnatinerfile))
							{
								foreach($existcobnatinerfile as $containerfile)
								{
									$cfdata['folder_id'] = $new_container_id;
									$cfdata['file_name'] = $containerfile->file_name;
									$cfdata['file_type'] = $containerfile->file_type;
									$cfdata['file_size'] = $containerfile->file_size;
									$cfdata['user_id'] = $containerfile->user_id;
									$cfdata['child_id'] = $containerfile->child_id;
									$cfdata['file_title'] = $containerfile->file_title;
									$cfdata['file_description'] = $containerfile->file_description;
									$cfdata['file_display_name'] = $containerfile->file_display_name;
									$cfdata['file_sort_num'] = $containerfile->file_sort_num;
									$cfdata['file_display_name_eng'] = $containerfile->file_display_name_eng;
									$cfdata['file_title_eng'] = $containerfile->file_title_eng;
									$cfdata['file_description_eng'] = $containerfile->file_description_eng;
									$cfdata['path'] = $containerfile->path;
									$cfdata['created'] = $containerfile->created;
									$cfdata['updated'] = $containerfile->updated;
									$new_containerfile_id = DB::table('tb_container_files')->insertGetId($cfdata);
									
									$pmdata['property_id'] = $new_prop_id;
									$pmdata['type'] = $container->display_name;
									$pmdata['file_id'] = $new_containerfile_id;
									$pmdata['user_id'] = $containerfile->user_id;
									$pmdata['created'] = $containerfile->created;
									$new_propimgfile_id = DB::table('tb_properties_images')->insertGetId($pmdata);
								}
							}
						}
					}
				}
				
				$update_prop_id = DB::table('sa_tb_properties')->where('id', $property->id)->update(["import_status"=>"1"]);
			}
			echo "Property Imported Sucessfully";
		}
		else
		{
			echo "Not Found New property";
		}
	}
	
	public function Propertyimagefixes( Request $request)
	{
		$existcobnatiner = DB::table('sa_tb_container')->where('parent_id', '136')->where('import_status', 0)->take(30)->get();
		if(!empty($existcobnatiner))
		{
			foreach($existcobnatiner as $container)
			{
				$existnewproperty = DB::table('tb_container')->where('name', $container->name)->first();
				if(!empty($existnewproperty))
				{
					$existcobnatinertag = DB::table('sa_tb_container_tags')->where('container_id', $container->id)->where('container_type', 'folder')->get();
					if(!empty($existcobnatinertag))
					{
						foreach($existcobnatinertag as $tags)
						{
							$tgdata['user_id'] = $tags->user_id;
							$tgdata['tag_id'] = $tags->tag_id;
							$tgdata['container_id'] = $existnewproperty->id;
							$tgdata['container_type'] = $tags->container_type;
							$tgdata['created'] = $tags->created;
							$tag_id = DB::table('tb_container_tags')->insertGetId($tgdata);
						}
					}
					
					$existcobnatinerchild = DB::table('sa_tb_container')->where('parent_id', $container->id)->get();
					if(!empty($existcobnatinerchild))
					{
						foreach($existcobnatinerchild as $subcontainer)
						{
							$oldID = $subcontainer->id;
							$existnewpropertyimg = DB::table('tb_container')->where('parent_id', $existnewproperty->id)->where('name', $subcontainer->name)->first();
							if(!empty($existnewpropertyimg))
							{
								$existchildcobnatinertag = DB::table('sa_tb_container_tags')->where('container_id', $subcontainer->id)->where('container_type', 'folder')->get();
								if(!empty($existchildcobnatinertag))
								{
									foreach($existchildcobnatinertag as $tags)
									{
										$tgdata['user_id'] = $tags->user_id;
										$tgdata['tag_id'] = $tags->tag_id;
										$tgdata['container_id'] = $existnewpropertyimg->id;
										$tgdata['container_type'] = $tags->container_type;
										$tgdata['created'] = $tags->created;
										$tag_id = DB::table('tb_container_tags')->insertGetId($tgdata);
									}
								}
								$existcobnatinerfiletag = DB::table('sa_tb_container_files')->where('folder_id', $subcontainer->id)->get();
								if(!empty($existcobnatinerfiletag))
								{
									foreach($existcobnatinerfiletag as $filestag)
									{
										$existcobnatinerfile = DB::table('tb_container_files')->where('folder_id', $existnewpropertyimg->id)->where('file_name',$filestag->file_name)->first();
										if(!empty($existcobnatinerfile))
										{
											$existchildcobnatinerfiletag = DB::table('sa_tb_container_tags')->where('container_id', $filestag->id)->where('container_type', 'file')->get();
											if(!empty($existchildcobnatinerfiletag))
											{
												foreach($existchildcobnatinerfiletag as $tags)
												{
													$tgdata['user_id'] = $tags->user_id;
													$tgdata['tag_id'] = $tags->tag_id;
													$tgdata['container_id'] = $existcobnatinerfile->id;
													$tgdata['container_type'] = $tags->container_type;
													$tgdata['created'] = $tags->created;
													$tag_id = DB::table('tb_container_tags')->insertGetId($tgdata);
												}
											}
											//container thumbs
											$oldfile_containerthumb = public_path(). '/uploads/thumbs/thumb_'.$oldID.'_'.$filestag->file_name;
											$newfile_containerthumb = public_path(). '/uploads/thumbs/thumb_'.$existcobnatinerfile->folder_id.'_'.$filestag->file_name; 
											if ((file_exists($oldfile_containerthumb)) && (!file_exists($newfile_containerthumb)))
											{
												rename($oldfile_containerthumb, $newfile_containerthumb);
											}
											
											//container hover
											$oldfile_containerhover = public_path(). '/uploads/thumbs/format_'.$oldID.'_'.$filestag->file_name;
											$newfile_containerhover = public_path(). '/uploads/thumbs/format_'.$existcobnatinerfile->folder_id.'_'.$filestag->file_name; 
											if ((file_exists($oldfile_containerhover)) && (!file_exists($newfile_containerhover)))
											{
												rename($oldfile_containerhover, $newfile_containerhover);
											}
											
											//container detail view page
											$oldfile_containerdetail = public_path(). '/uploads/thumbs/highflip_'.$oldID.'_'.$filestag->file_name;
											$newfile_containerdetail = public_path(). '/uploads/thumbs/highflip_'.$existcobnatinerfile->folder_id.'_'.$filestag->file_name; 
											if ((file_exists($oldfile_containerdetail)) && (!file_exists($newfile_containerdetail)))
											{
												rename($oldfile_containerdetail, $newfile_containerdetail);
											}
											
											//container folder cover thumb image
											$oldfile_containercoverthumb = public_path(). '/uploads/folder_cover_imgs/thumb_'.$filestag->file_name;
											$newfile_containercoverthumb = public_path(). '/uploads/folder_cover_imgs/thumb_'.$filestag->file_name; 
											if ((file_exists($oldfile_containercoverthumb)) && (!file_exists($newfile_containercoverthumb)))
											{
												rename($oldfile_containercoverthumb, $newfile_containercoverthumb);
											}
											
											//container folder cover hover image
											$oldfile_containercoverhover = public_path(). '/uploads/folder_cover_imgs/format_'.$filestag->file_name;
											$newfile_containercoverhover = public_path(). '/uploads/folder_cover_imgs/format_'.$filestag->file_name; 
											if ((file_exists($oldfile_containercoverhover)) && (!file_exists($newfile_containercoverhover)))
											{
												rename($oldfile_containercoverhover, $newfile_containercoverhover);
											}
											
											//property thumb image
											$oldfile_propertythumb = public_path(). '/uploads/property_imgs_thumbs/'.$filestag->file_name;
											$newfile_propertythumb = public_path(). '/uploads/property_imgs_thumbs/'.$filestag->file_name; 
											if ((file_exists($oldfile_propertythumb)) && (!file_exists($newfile_propertythumb)))
											{
												rename($oldfile_propertythumb, $newfile_propertythumb);
											}
											
											//property fornt image 
											$oldfile_propertyfront = public_path(). '/uploads/property_imgs_thumbs/front_property_'.$oldID.'_'.$filestag->file_name;
											$newfile_propertyfront = public_path(). '/uploads/property_imgs_thumbs/front_property_'.$existcobnatinerfile->folder_id.'_'.$filestag->file_name; 
											if ((file_exists($oldfile_propertyfront)) && (!file_exists($newfile_propertyfront)))
											{
												rename($oldfile_propertyfront, $newfile_propertyfront);
											}
											
											//property fornt large image 
											$oldfile_propertyfrontlarge = public_path(). '/uploads/property_imgs_thumbs/front_property_large_'.$oldID.'_'.$filestag->file_name;
											$newfile_propertyfrontlarge = public_path(). '/uploads/property_imgs_thumbs/front_property_large_'.$existcobnatinerfile->folder_id.'_'.$filestag->file_name; 
											if ((file_exists($oldfile_propertyfrontlarge)) && (!file_exists($newfile_propertyfrontlarge)))
											{
												rename($oldfile_propertyfrontlarge, $newfile_propertyfrontlarge);
											}
										}																
										
									}
								}
							}
						}
						
					}
					
				}
				$update_cont_id = DB::table('sa_tb_container')->where('id', $container->id)->update(["import_status"=>"1"]);
			}
			echo "IMage fixes Sucessfully";
		}
		else
		{
			echo "Not Found New image";
		}
	}

}