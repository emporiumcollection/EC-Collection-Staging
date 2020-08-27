<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class languages extends Sximo  {
	
	protected $table = 'tb_languages';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_languages.* FROM tb_languages  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_languages.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
