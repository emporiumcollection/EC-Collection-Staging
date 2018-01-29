<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crmlayout extends Sximo
{
	 protected $softDelete = true;
    
	protected $table = 'ai_crm_layout';
	
	    protected $primaryKey = 'template_id';

    
}
