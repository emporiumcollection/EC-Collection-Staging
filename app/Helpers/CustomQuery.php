<?php
namespace App\Helpers;

class CustomQuery
{
    //Return All images path of Property
    static function getPropertyImages($propId){
		$propertyFile = 'property/'.$propId.'.json'; 
		$contents = Storage::get($propertyFile);
		$proertyObj = json_decode($contents);
		return $proertyObj;
    }

    
}