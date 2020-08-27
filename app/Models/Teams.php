<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class teams extends Sximo  {
	
	protected $table = 'tb_teams';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_teams.* FROM tb_teams  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_teams.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
