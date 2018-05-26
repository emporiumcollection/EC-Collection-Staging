<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelsAiCrmRows extends Model
{
     /** Custom Table Name Convention
	*/
	protected $table = 'ai_crm_rows';

	/**
	 * Custom primary key convention
	  */
	protected $primaryKey = 'crm_row_id';

	/**
	 * if table support soft deletion ( deleted_at ) 
	 * https://laravel.com/docs/5.4/eloquent#soft-deleting
	 */
}
