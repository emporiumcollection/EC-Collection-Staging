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
            $proertyObj->folder_src = $containerObj->getThumbpath($proertyObj->folder_id);
			$proertyObj->img_src = $proertyObj->folder_src.$proertyObj->file_name;
			$proertyObj->containerfolder_path_src = $containerObj->getContainerUserPath($proertyObj->folder_id);
			$proertyObj->containerfolder_src = $proertyObj->containerfolder_path_src.$proertyObj->file_name;			
		}
		return $proertyObj;
    }
    
    static function getPropertyImagesFromDBByFileId($fileId){
        $containerObj = new \App\Http\Controllers\ContainerController;
        $proertyObj = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.file_id', $fileId)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();
        if(!empty($proertyObj))
		{
            $proertyObj->folder_src = $containerObj->getThumbpath($proertyObj->folder_id);
			$proertyObj->img_src = $proertyObj->folder_src.$proertyObj->file_name;
			$proertyObj->containerfolder_path_src = $containerObj->getContainerUserPath($proertyObj->folder_id);
			$proertyObj->containerfolder_src = $proertyObj->containerfolder_path_src.$proertyObj->file_name;			
		}
		return $proertyObj;
    }
    
    static function getPropertyImagesFromDB($propId,$limit=0,$get_thumb_path=false,$get_containerpath=false){
		$containerObj = new \App\Http\Controllers\ContainerController;
        if($limit > 0){
            $proertyObj = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $propId)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->limit($limit)->get(); 
            if(empty($proertyObj)){
                $proertyObj = \DB::table('tb_container_files')->select('tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_container_files.folder_id', $propId)->orderBy('tb_container_files.file_sort_num', 'asc')->limit($limit)->get();
            }   
        }else
        {
            $proertyObj = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $propId)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->get();
            if(empty($proertyObj)){
                $proertyObj = \DB::table('tb_container_files')->select('tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_container_files.folder_id', $propId)->orderBy('tb_container_files.file_sort_num', 'asc')->get();
            }
        }
        
        $returnObj = array();
        if(!empty($proertyObj)){
            foreach($proertyObj as $row){
                if($get_thumb_path){
                    $row->folder_src = $containerObj->getThumbpath($row->folder_id);
                    $row->img_src = $row->folder_src.$row->file_name;
                }
                    
                if($get_containerpath){
                    $row->containerfolder_path_src = $containerObj->getContainerUserPath($row->folder_id);
                    $row->containerfolder_src = $row->containerfolder_path_src.$row->file_name;	
                }
                
                $returnObj[] = $row;
            }
        }        
        
		return $returnObj;
    }
    
}
