<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class newscategories extends Sximo  {
	
	protected $table = 'tb_news_categories';
	protected $primaryKey = 'cat_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_news_categories.* FROM tb_news_categories  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_news_categories.cat_id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
