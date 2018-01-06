<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class emarketing extends Sximo  {
	
	protected $table = 'forms';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT forms.* FROM forms  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE forms.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
