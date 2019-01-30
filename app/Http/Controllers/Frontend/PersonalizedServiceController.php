<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\ContainerController;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Http\Controllers\Controller;
use App\User;
use DB,Validator, Input, Redirect, CommonHelper;
class PersonalizedServiceController extends Controller {

    public function __construct() {
        parent::__construct();
        if(!isset(\Auth::user()->id)){
            Redirect::to('/')->send();
        }
        $this->data['pageTitle'] = '';
        $this->data['data'] = CommonHelper::getInfo();
        $this->data['pageslider'] = \DB::table('tb_pages_sliders')->select( 'slider_title', 'slider_description', 'slider_img', 'slider_link', 'slider_video', 'slide_type')->where('slider_page_id', 35)->get();
        $this->data['pageTitle'] = "Personalized Service";
        $this->data['pageMetakey'] = "Personalized Service";
        $this->data['pageMetadesc'] = "Personalized Service";
    }
    
    /* Method : Index
     *   Description : The Methos is using for personalized page
    */
    public function index(Request $request) {
       
        /*if (!\Auth::check()):
            return Redirect::to('customer/login');
        endif;*/
        
        $temp = $this->get_destinations();
        
        $this->data['destinations'] = $temp['sub_destinations'];
        $this->data['inspirations'] = \DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name', 'category_image', 'category_custom_title')->where('category_published', 1)->where('parent_category_id', 627)->get();
        $this->data['experiences'] = \DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name', 'category_image', 'category_custom_title')->where('category_published', 1)->where('parent_category_id', 8)->get();
                
        return view('frontend.personalized.personalized_service', $this->data);
    }
    
    /*
     * AIC: List customer's personalized service
     */
    
    function list_my_services() {
        
        if (!\Auth::check()):
            return Redirect::to('customer/login');
        endif;
        
        $customer_id = \Auth::user()->id;
        
        $this->data['services'] = \DB::table('tb_personalized_services')->where('customer_id', $customer_id)->orderBy('ps_id', 'DESC')->get();
        return view('frontend.personalized.my_services', $this->data);
    }
    
    /*
     * AIC: edit customer's personalized service
     */
    
    function edit($ps_id) {
        
        if (!\Auth::check()):
            return Redirect::to('customer/login');
        endif;
        
        $customer_id = \Auth::user()->id;
        
        $temp = $this->get_destinations();
        
        $this->data['destinations'] = $temp['sub_destinations'];
        $this->data['inspirations'] = \DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name', 'category_image', 'category_custom_title')->where('category_published', 1)->where('parent_category_id', 627)->get();
        $this->data['experiences'] = \DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name', 'category_image', 'category_custom_title')->where('category_published', 1)->where('parent_category_id', 8)->get();
        $this->data['row'] = \DB::table('tb_personalized_services')->where('ps_id', $ps_id)->where('customer_id', $customer_id)->first();
        
        return view('frontend.personalized.edit', $this->data);
    }
    
    /*
     * AIC: delete customer's personalized service
     */
    
    function delete($ps_id) {
        
        if (!\Auth::check()):
            return Redirect::to('customer/login');
        endif;
        
        $customer_id = \Auth::user()->id;
        
        \DB::table('tb_personalized_services')->where('ps_id', $ps_id)->where('customer_id', $customer_id)->delete();
        return Redirect::to('personalized-service/my-services');
    }
    
    /*
     * AIC: Get destinations list
     */
    
    public function get_destinations($id = 0) {

        $_chldIds = array();
        
        if($id == 0) {
            $sub_destinations = \DB::table('tb_categories')->where('parent_category_id', 0)->where('id', '!=', 8)->get();
        }
        else {
            $sub_destinations = \DB::table('tb_categories')->where('parent_category_id', $id)->get();
        }
        
        if(!empty($sub_destinations)) {
            foreach ($sub_destinations as $key => $sub_destination) {
                
                $chldIds = array();
                
                $chldIds[] = $sub_destination->id;
                $temp = $this->get_destinations($sub_destination->id);
                $sub_destinations[$key]->sub_destinations = $temp['sub_destinations'];
                $chldIds = array_merge($chldIds, $temp['chldIds']);
                $_chldIds = array_merge($_chldIds, $chldIds);
                
                $getcats = '';
                if (!empty($chldIds)) {
                    $getcats = " AND (" . implode(" || ", array_map(function($v) {
                                        return sprintf("FIND_IN_SET('%s', property_category_id)", $v);
                                    }, array_values($chldIds))) . ")";
                    $preprops = DB::select(DB::raw("SELECT COUNT(*) AS total_rows FROM tb_properties WHERE property_status = '1' $getcats"));
                    if($preprops[0]->total_rows == 0) {
                        unset($sub_destinations[$key]);
                    }
                }
            }
        }
        
        return array('sub_destinations' => $sub_destinations, 'chldIds' => $_chldIds);
    }
    
    /*
     * AIC: Save from data in DB
     */
    
    public function save(Request $request) {
        
        if (!\Auth::check()):
            return Redirect::to('customer/login');
        endif;
        
        $customer_id = \Auth::user()->id;
        
        $params = array('customer_id' => $customer_id,
                        'salutation' => $request->input('salutation'),
                        'first_name' => $request->input('first_name'),
                        'surname' => $request->input('surname'),
                        'email' => $request->input('email'),
                        'adults' => $request->input('adults'),
                        'youth' => $request->input('youth'),
                        'children' => $request->input('children'),
                        'toddlers' => $request->input('toddlers'),
                        'earliest_arrival' => date("Y-m-d", strtotime($request->input('earliest_arrival'))),
                        'late_check_out' => date("Y-m-d", strtotime($request->input('late_check_out'))),
                        'stay_time' => $request->input('stay_time'),
                        'destinations' => implode(', ', $request->input('destinations')),
                        'inspirations' => implode(', ', $request->input('inspirations')),
                        'experiences' => implode(', ', $request->input('experiences')),
                        'note' => $request->input('note'),
                        'reservation_agent' => '0',
                        'status' => 'Pending',
                        'created' => date("Y-m-d H:i:s"),
                        'updated' => date("Y-m-d H:i:s")
                    );
        
        \DB::table('tb_personalized_services')->insert($params);
        return Redirect::to('personalized-service')->with(['info' => 'Your Info Saved Successfully.']);
    }
    
    public function ajax_save(Request $request) {
        
        if (!\Auth::check()):
            return Redirect::to('customer/login');
        endif;
        
        $customer_id = \Auth::user()->id;
        //echo $request->input('late_check_out');
        $ps_id = $request->input('ps_id');
        $params = array(
                        'customer_id' => $customer_id,
                        'adults' => $request->input('adults'),
                        'youth' => $request->input('youth'),
                        'children' => $request->input('children'),
                        'toddlers' => $request->input('toddlers'),
                        'earliest_arrival' => date("Y-m-d", strtotime($request->input('earliest_arrival'))),
                        'late_check_out' => date("Y-m-d", strtotime($request->input('late_check_out'))),
                        'stay_time' => $request->input('stay_time'),
                        'destinations' => $request->input('destinations'),
                        'inspirations' => $request->input('inspirations'),
                        'experiences' => $request->input('experiences'),
                        'note' => $request->input('note'),
                        'reservation_agent' => '0',
                        'status' => 'Pending',
                        'created' => date("Y-m-d H:i:s"),
                        'updated' => date("Y-m-d H:i:s"),
                        'data_policy'=>$request->input('data_policy'),
                        'privacy_policy'=>$request->input('privacy_policy'),
                        'cookies_policy'=>$request->input('cookies_policy'),
                    );
        //print_r($params); die;
        if(!empty($ps_id)){
            \DB::table('tb_personalized_services')->where('ps_id', $ps_id)->update($params);
            $return_array['status'] = 'success';
            $return_array['message'] = 'Personlized preferences has been updated!';
        }else{
            \DB::table('tb_personalized_services')->insert($params);
            
            $_user = User::find(\Session::get('uid'));
            $_user->form_wizard = $request->input('form_wizard');
            $_user->new_user = 0;
            $_user->save();
            
            //return Redirect::to('personalized-service')->with(['info' => 'Your Info Saved Successfully.']);
            $return_array['status'] = 'success';
            $return_array['message'] = 'Personlized preferences has been saved!';
        }
        echo json_encode($return_array);
        exit;
    }
    
    /*
     * AIC: Update from data in DB
     */
    
    public function update(Request $request) {
        
        if (!\Auth::check()):
            return Redirect::to('customer/login');
        endif;
        
        $ps_id = $request->input('ps_id');
        
        $params = array('salutation' => $request->input('salutation'),
                        'first_name' => $request->input('first_name'),
                        'surname' => $request->input('surname'),
                        'email' => $request->input('email'),
                        'adults' => $request->input('adults'),
                        'youth' => $request->input('youth'),
                        'children' => $request->input('children'),
                        'toddlers' => $request->input('toddlers'),
                        'earliest_arrival' => date("Y-m-d", strtotime($request->input('earliest_arrival'))),
                        'late_check_out' => date("Y-m-d", strtotime($request->input('late_check_out'))),
                        'stay_time' => $request->input('stay_time'),
                        'destinations' => implode(', ', $request->input('destinations')),
                        'inspirations' => implode(', ', $request->input('inspirations')),
                        'experiences' => implode(', ', $request->input('experiences')),
                        'note' => $request->input('note'),
                        'updated' => date("Y-m-d H:i:s")
                    );
        
        \DB::table('tb_personalized_services')->where('ps_id', $ps_id)->update($params);
        return Redirect::to('personalized-service/edit/'.$ps_id)->with(['info' => 'Your Info Saved Successfully.']);
    }

}
