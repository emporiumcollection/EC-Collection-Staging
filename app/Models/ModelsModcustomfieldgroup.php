<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelsModcustomfieldgroup extends Model
{
     /** Custom Table Name Convention
	*/
	protected $table = 'modcustomfieldgroup_mfg';

	/**
	 * Custom primary key convention
	  */
	protected $primaryKey = 'id_modcustomfieldgroup';

	/**
	 * if table support soft deletion ( deleted_at ) 
	 * https://laravel.com/docs/5.4/eloquent#soft-deleting
	 */
}
