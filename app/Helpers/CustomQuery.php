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

    
}