<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelsModcustomfieldrows extends Model
{
     /** Custom Table Name Convention
	*/
	protected $table = 'modcustomfieldrows_mfg';

	/**
	 * Custom primary key convention
	  */
	protected $primaryKey = 'id_modcustomfieldrow';

	/**
	 * if table support soft deletion ( deleted_at ) 
	 * https://laravel.com/docs/5.4/eloquent#soft-deleting
	 */
}
