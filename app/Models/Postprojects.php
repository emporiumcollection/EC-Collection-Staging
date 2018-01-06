<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class postprojects extends Sximo  {
	
	protected $table = 'tb_post_projects';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_post_projects.* FROM tb_post_projects  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_post_projects.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
