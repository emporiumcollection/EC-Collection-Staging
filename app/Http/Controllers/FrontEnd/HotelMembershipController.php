<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\ContainerController;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Http\Controllers\Controller;
use App\User;
use DB,Validator, Input, Redirect, CommonHelper, Mail;
class HotelMembershipController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->data['pageTitle'] = '';
        $this->data['data'] = CommonHelper::getInfo();
        $this->data['pageslider'] = \DB::table('tb_pages_sliders')->select( 'slider_title', 'slider_description', 'slider_img', 'slider_link', 'slider_video', 'slide_type')->where('slider_page_id', 107)->get();

    }
    
    /* Method : Index
     *   Description : The Methos is using for personalized page
    */
    public function membershipSignup(Request $request) {

        return view('frontend.hotel_membership.hotel_membership_signup', $this->data);
    }

    public function hotelPackage(Request $request) {
       
        
        
        return view('frontend.hotel_membership.hotel_package', $this->data);
    }

    public function advertisementPackage(Request $request) {
       
        
        
        return view('frontend.hotel_membership.hotel_advertisement', $this->data);
    }

    public function hotelCart(Request $request) {
       
        
        
        return view('frontend.hotel_membership.hotel_cart', $this->data);
    }

    public function hotelCheckout(Request $request) {
       
        
        
        return view('frontend.hotel_membership.hotel_checkout', $this->data);
    }
    
    


}
