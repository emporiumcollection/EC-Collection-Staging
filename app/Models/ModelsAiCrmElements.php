<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelsAiCrmElements extends Model
{
     /** Custom Table Name Convention
	*/
	protected $table = 'ai_crm_elements';

	/**
	 * Custom primary key convention
	  */
	protected $primaryKey = 'crm_element_id';

	/**
	 * if table support soft deletion ( deleted_at ) 
	 * https://laravel.com/docs/5.4/eloquent#soft-deleting
	 */
}
