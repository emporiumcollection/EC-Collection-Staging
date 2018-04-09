<?php
namespace App\Helpers;
use Storage;
class CustomQuery
{
    //Return All images path of Property
    static function getPropertyImages($propId){
		$propertyFile = 'property/'.$propId.'.json'; 
		$exists = Storage::has($propertyFile);
		$proertyObj = '';
		if($exists==true){
			$contents = Storage::get($propertyFile);
			$proertyObj = json_decode($contents);
		}
		return $proertyObj;
    }

    static function getPropertyImage($propId){
		$containerObj = new \App\Http\Controllers\ContainerController;
		$proertyObj = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $propId)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();
		if(!empty($proertyObj))
		{
			$proertyObj->img_src = $containerObj->getThumbpath($proertyObj->folder_id).$proertyObj->file_name;
			$proertyObj->folder_src = $containerObj->getThumbpath($proertyObj->folder_id);
		}
		return $proertyObj;


    }

    
}