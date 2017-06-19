<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class projects extends Sximo  {
	
	protected $table = 'tb_projects';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_projects.* FROM tb_projects  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_projects.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
