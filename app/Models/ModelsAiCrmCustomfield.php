<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelsAiCrmCustomfield extends Model
{
     /** Custom Table Name Convention
	*/
	protected $table = 'ai_crm_customfield';

	/**
	 * Custom primary key convention
	  */
	protected $primaryKey = 'crm_customfield_id';

	/**
	 * if table support soft deletion ( deleted_at ) 
	 * https://laravel.com/docs/5.4/eloquent#soft-deleting
	 */
}
