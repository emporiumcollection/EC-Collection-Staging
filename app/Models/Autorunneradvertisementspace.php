<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class autorunneradvertisementspace extends Sximo  {
	
	protected $table = 'tb_autorunner_advertisement_space';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_autorunner_advertisement_space.* FROM tb_autorunner_advertisement_space  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_autorunner_advertisement_space.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
