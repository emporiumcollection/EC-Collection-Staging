<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class advertisementspace extends Sximo  {
	
	protected $table = 'tb_advertisement_space';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_advertisement_space.* FROM tb_advertisement_space  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_advertisement_space.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
