<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class crmlayout extends Sximo  {
	
	protected $table = 'ai_crm_layout';
	protected $primaryKey = 'template_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT ai_crm_layout.* FROM ai_crm_layout  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE ai_crm_layout.template_id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
