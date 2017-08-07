<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class tagmanager extends Sximo  {
	
	protected $table = 'tb_tags_manager';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_tags_manager.* FROM tb_tags_manager  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_tags_manager.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
