<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\ContainerController;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Http\Controllers\Controller;
use App\User;
use DB,Validator, Input, Redirect, CommonHelper, Mail;
class FrontendPagesController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->data['pageTitle'] = '';
        
    }
	
	 public function index(Request $request) {
       
       
    }

}
