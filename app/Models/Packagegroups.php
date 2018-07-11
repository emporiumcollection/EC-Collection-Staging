<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class packagegroups extends Sximo  {
	
	protected $table = 'tb_packages_user_groups';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_packages_user_groups.* FROM tb_packages_user_groups  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_packages_user_groups.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
