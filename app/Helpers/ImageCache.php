<?php

namespace App\Helpers;

class ImageCache {

    static function make($path='',$quality=100, $width, $height) {
        $path = str_replace(public_path('uploads'), url('uploads'), $path);
        /*if($path!=''){
          
            if(strstr($path,'/uploads/')){
		$getNewImagePath = str_replace(public_path('uploads'), public_path('uploads/image_cache'), $path);
	    }else{
		$getNewImagePath = str_replace(public_path(), public_path('uploads/image_cache'), $path);
	    } 
            $getExtofOldFile = pathinfo($path, PATHINFO_EXTENSION);
            $get_old_filename_with_ext = basename($getNewImagePath); // "img1.jpg"
            $get_old_filename_without_ext = basename($getNewImagePath,'.'.$getExtofOldFile); // "img1.jpg"
            $newFileName = $quality.'_'.(($width!='')?$width.'_':'').(($height!='')?$height.'_':'').$get_old_filename_without_ext.'.jpg';
            $makeNewFilePath = str_replace('/'.$get_old_filename_with_ext,'/'.$newFileName,$getNewImagePath);
            $makeNewFolderPath = str_replace('/'.$get_old_filename_with_ext,'',$getNewImagePath);
            $newImageUrl = url(str_replace(public_path(), '', $makeNewFilePath));

            if(!file_exists($makeNewFolderPath)){
                $result = \File::makeDirectory($makeNewFolderPath, 07755, true);
            }   
            if(!file_exists($makeNewFilePath)){
                if(file_exists($path)){

                       \Image::make($path)->resize($width,$height,function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })->save($makeNewFilePath,$quality);
                    
                    return $newImageUrl;
                }
            } else{
                return $newImageUrl;
            } 
        }*/
        return $path;
    }

}
