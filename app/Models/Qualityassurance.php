<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class qualityassurance extends Sximo  {
	
	protected $table = 'tb_quality_assurance';
	protected $primaryKey = 'quality_assurance_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_quality_assurance.*, tb_properties.property_name AS hotel_name, tb_properties.city AS hotel_city, CONCAT((tb_users.first_name), (' '), (tb_users.last_name)) AS hotel_manager_name, , CONCAT((user2.first_name), (' '), (user2.last_name)) AS quality_assurer_name FROM tb_quality_assurance LEFT JOIN tb_properties ON tb_properties.id = tb_quality_assurance.property_id LEFT JOIN tb_users ON tb_users.id = tb_quality_assurance.hotel_manager LEFT JOIN tb_users AS user2 ON user2.id = tb_quality_assurance.quality_assurer  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_quality_assurance.quality_assurance_id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
