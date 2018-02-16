<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class pagesmanagement extends Sximo  {
	
	protected $table = 'tb_pages_content';
	protected $primaryKey = 'pageID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_pages_content.* FROM tb_pages_content  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_pages_content.pageID IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
