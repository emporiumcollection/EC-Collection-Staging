<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class container extends Sximo  {
	
	protected $table = 'tb_container';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_container.* FROM tb_container  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_container.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	
	public static function insertRowFile($data){
		return DB::table('tb_container_files')->insertGetId($data);
	}
	

}
