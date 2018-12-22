<?php

namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Bookings;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator,
    Input,
    Redirect;

class BookingsController extends Controller {

    protected $layout = "layouts.main";
    protected $data = array();
    public $module = 'bookings';
    static $per_page = '10';

    public function __construct() {

        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->model = new Bookings();

        $this->info = $this->model->makeInfo($this->module);
        $this->access = $this->model->validAccess($this->info['id']);

        $this->data = array(
            'pageTitle' => $this->info['title'],
            'pageNote' => $this->info['note'],
            'pageModule' => 'bookings',
            'return' => self::returnUrl()
        );
    }

    public function getIndex(Request $request) {

        $uid = \Auth::user()->id;
        $this->data['hide_email_btn'] = false;
        if ($this->access['is_view'] == 0)
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');

        $sort = (!is_null($request->input('sort')) ? $request->input('sort') : 'id');
        $order = (!is_null($request->input('order')) ? $request->input('order') : 'asc');
        // End Filter sort and order for query 
        // Filter Search for query		
        $filter = (!is_null($request->input('search')) ? $this->buildSearch() : '');
        if (\Auth::user()->group_id != 1) {
            $this->data['hide_email_btn'] = true;
            $filter .= " AND (client_id='" . $uid . "')";
        }
		if(\Session::get('gid')!=1 && \Session::get('gid')!=2){
            $uid = \Auth::user()->id;
			$checkallprop = \DB::table('tb_properties')->select('id')->where('user_id', $uid)->get();
			if(!empty($checkallprop))
			{
				$prpArr = array();
				foreach($checkallprop as $prp)
				{
					$prpArr[] = $prp->id;
				}
				if(!empty($prpArr))
				{
					$filter .= " AND property_id in (".implode(',',$prpArr).")";
				}
			}
		}
        $page = $request->input('page', 1);
        $params = array(
            'page' => $page,
            'limit' => (!is_null($request->input('rows')) ? filter_var($request->input('rows'), FILTER_VALIDATE_INT) : static::$per_page ),
            'sort' => $sort,
            'order' => $order,
            'params' => $filter,
            'global' => (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
        );

        // Get Query 
        $results = $this->model->getRows($params);

        // Build pagination setting
        $page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;
        $pagination = new Paginator($results['rows'], $results['total'], $params['limit']);
        $pagination->setPath('bookings');

        if (!empty($results['rows'])) {
            foreach ($results['rows'] as $key => $row) {
                $results['rows'][$key]->category = \DB::table('tb_properties_category_types')->where('id', $row->type_id)->where('status', 0)->where('show_on_booking', 1)->first();
                $results['rows'][$key]->category_image = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $results['rows'][$key]->category->property_id)->where('tb_properties_images.category_id', $row->type_id)->where('tb_properties_images.type', 'Rooms Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();
                $results['rows'][$key]->category_image->imgsrc = (new ContainerController)->getThumbpath($results['rows'][$key]->category_image->folder_id);

                $props = \DB::table('tb_properties')->where('id', $results['rows'][$key]->category->property_id)->first();
                $results['rows'][$key]->props = $props;
                
                if ($props->default_seasons != 1) {
                    $checkseason = \DB::table('tb_seasons')->where('property_id', $props->id)->orderBy('season_priority', 'asc')->get();
                } else {
                    $checkseason = \DB::table('tb_seasons')->where('property_id', 0)->orderBy('season_priority', 'asc')->get();
                }
                if (!empty($checkseason)) {
                    $foundsean = false;
                    $curnDate = date('Y-m-d');
                    for ($sc = 0; $foundsean != true; $sc++) {
                        $checkseasonDate = \DB::table('tb_seasons_dates')->where('season_id', $checkseason[$sc]->id)->where('season_from_date', '>=', $curnDate)->where('season_to_date', '<=', $curnDate)->count();
                        if ($checkseasonDate > 0) {
                            $checkseasonPrice = \DB::table('tb_properties_category_rooms_price')->where('season_id', $checkseason[$sc]->id)->where('property_id', $props->id)->where('category_id', $results['rows'][$key]->category->id)->first();
                            if (!empty($checkseasonPrice)) {
                                $results['rows'][$key]->category->price = $checkseasonPrice->rack_rate;
                                $foundsean = true;
                            }
                        }
                    }
                    if ($foundsean != true) {
                        $checkseasonPrice_ifnotforloop = \DB::table('tb_properties_category_rooms_price')->where('season_id', 0)->where('property_id', $props->id)->where('category_id', $results['rows'][$key]->category->id)->first();
                        if (!empty($checkseasonPrice_ifnotforloop)) {
                            $results['rows'][$key]->category->price = $checkseasonPrice_ifnotforloop->rack_rate;
                        }
                    }
                } else {
                    $checkseasonPrice_ifnotanyseason = \DB::table('tb_properties_category_rooms_price')->where('season_id', 0)->where('property_id', $props->id)->where('category_id', $results['rows'][$key]->category->id)->first();
                    if (!empty($checkseasonPrice_ifnotanyseason)) {
                        $results['rows'][$key]->category->price = $checkseasonPrice_ifnotanyseason->rack_rate;
                    }
                }
                $results['rows'][$key]->category->currency = \DB::table('tb_settings')->where('key_value', 'default_currency')->first();
                $results['rows'][$key]->user_info = \DB::table('tb_users')->where('id', $row->client_id)->first();
            }
        }

        $this->data['rowData'] = $results['rows'];
        // Build Pagination 
        $this->data['pagination'] = $pagination;
        // Build pager number and append current param GET
        $this->data['pager'] = $this->injectPaginate();
        // Row grid Number 
        $this->data['i'] = ($page * $params['limit']) - $params['limit'];
        // Grid Configuration 
        $this->data['tableGrid'] = $this->info['config']['grid'];
        $this->data['tableForm'] = $this->info['config']['forms'];
        $this->data['colspan'] = \SiteHelpers::viewColSpan($this->info['config']['grid']);
        // Group users permission
        $this->data['access'] = $this->access;
        // Detail from master if any
        // Master detail link if any 
        $this->data['subgrid'] = (isset($this->info['config']['subgrid']) ? $this->info['config']['subgrid'] : array());
        // Render into template

        if (\Auth::user()->group_id == 4) {
            return view('customer.bookings', $this->data);
        }
        if (\Auth::user()->group_id == 3) {
            return Redirect::to('traveller/bookings');
        }
        if (\Auth::user()->group_id == 5) {
            return Redirect::to('hotel/bookings');
        }
        //$is_demo6 = trim(\CommonHelper::isHotelDashBoard());        
        //$file_name = (strlen($is_demo6) > 0)?$is_demo6.'.bookings.index':'bookings.index';
        
        return view('bookings.index', $this->data);
    }

    function getUpdate(Request $request, $id = null) {

        if ($id == '') {
            if ($this->access['is_add'] == 0)
                return Redirect::to('dashboard')->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');
        }

        if ($id != '') {
            if ($this->access['is_edit'] == 0)
                return Redirect::to('dashboard')->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');
        }

        $row = $this->model->find($id);
        if ($row) {
            $this->data['row'] = $row;
        } else {
            $this->data['row'] = $this->model->getColumnTable('tb_reservations');
        }
        //print_r($row); die;        
        $this->data['fields'] = \SiteHelpers::fieldLang($this->info['config']['forms']);

        $this->data['id'] = $id;
        $this->data['preferences'] = \DB::table('td_booking_preferences')->where('reservation_id', $id)->first();
        $this->data['rooms'] = \DB::table('td_reserved_rooms')->where('reservation_id', $id)->get();
        
        if(isset($this->data['row']->client_id)){
            $this->data['user_info'] = \DB::table('tb_users')->where('id', $this->data['row']->client_id)->first();
        }
        
        $uid = \Auth::user()->id;
        $this->data['login_user'] = \DB::table('tb_users')->where('id', $uid)->first();
        
        if(isset($this->data['row']->type_id)){
        
            $this->data['category'] = \DB::table('tb_properties_category_types')->where('id', $this->data['row']->type_id)->where('status', 0)->where('show_on_booking', 1)->first();
            $this->data['category_image'] = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $this->data['category']->property_id)->where('tb_properties_images.category_id', $this->data['row']->type_id)->where('tb_properties_images.type', 'Rooms Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();
            $this->data['category_image']->imgsrc = (new ContainerController)->getThumbpath($this->data['category_image']->folder_id);
    
            $props = \DB::table('tb_properties')->where('id', $this->data['category']->property_id)->first();
    
            if ($props->default_seasons != 1) {
                $checkseason = \DB::table('tb_seasons')->where('property_id', $props->id)->orderBy('season_priority', 'asc')->get();
            } else {
                $checkseason = \DB::table('tb_seasons')->where('property_id', 0)->orderBy('season_priority', 'asc')->get();
            }
            if (!empty($checkseason)) {
                $foundsean = false;
                for ($sc = 0; $foundsean != true; $sc++) {
                    $checkseasonDate = \DB::table('tb_seasons_dates')->where('season_id', $checkseason[$sc]->id)->where('season_from_date', '>=', $curnDate)->where('season_to_date', '<=', $curnDate)->count();
                    if ($checkseasonDate > 0) {
                        $checkseasonPrice = \DB::table('tb_properties_category_rooms_price')->where('season_id', $checkseason[$sc]->id)->where('property_id', $props->id)->where('category_id', $this->data['category']->id)->first();
                        if (!empty($checkseasonPrice)) {
                            $this->data['category']->price = $checkseasonPrice->rack_rate;
                            $foundsean = true;
                        }
                    }
                }
                if ($foundsean != true) {
                    $checkseasonPrice_ifnotforloop = \DB::table('tb_properties_category_rooms_price')->where('season_id', 0)->where('property_id', $props->id)->where('category_id', $this->data['category']->id)->first();
                    if (!empty($checkseasonPrice_ifnotforloop)) {
                        $this->data['category']->price = $checkseasonPrice_ifnotforloop->rack_rate;
                    }
                }
            } else {
                $checkseasonPrice_ifnotanyseason = \DB::table('tb_properties_category_rooms_price')->where('season_id', 0)->where('property_id', $props->id)->where('category_id', $this->data['category']->id)->first();
                if (!empty($checkseasonPrice_ifnotanyseason)) {
                    $this->data['category']->price = $checkseasonPrice_ifnotanyseason->rack_rate;
                }
            }
        }
        $this->data['currency'] = \DB::table('tb_settings')->where('key_value', 'default_currency')->first();

        return view('bookings.form', $this->data);
    }

    public function getShow($id = null) {

        if ($this->access['is_detail'] == 0)
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');

        $row = $this->model->getRow($id);
        if ($row) {
            $this->data['row'] = $row;
        } else {
            $this->data['row'] = $this->model->getColumnTable('tb_reservations');
        }
        $this->data['fields'] = \SiteHelpers::fieldLang($this->info['config']['grid']);

        $this->data['id'] = $id;
        $this->data['access'] = $this->access;
        return view('bookings.view', $this->data);
    }

    public function getSendemail($id = null) {

        if ($this->access['is_detail'] == 0)
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');

        $row = $this->model->getRow($id);
        if ($row) {
            $reservation = $row;
        } else {
            $reservation = $this->model->getColumnTable('tb_reservations');
        }

        $this->data['access'] = $this->access;

        $preferences = \DB::table('td_booking_preferences')->where('reservation_id', $id)->first();
        $rooms = \DB::table('td_reserved_rooms')->where('reservation_id', $id)->get();
        $user_info = \DB::table('tb_users')->where('id', $reservation->client_id)->first();
        $property = \DB::table('tb_properties')->where('id', $reservation->property_id)->first();
        $type = \DB::table('tb_properties_category_types')->where('id', $reservation->type_id)->first();
        $type_image = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $reservation->property_id)->where('tb_properties_images.category_id', $reservation->type_id)->where('tb_properties_images.type', 'Rooms Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();
        $type_image->imgsrc = (new ContainerController)->getThumbpath($type_image->folder_id);
        $hotel_terms_n_conditions = \DB::table('td_property_terms_n_conditions')->where('property_id', $reservation->property_id)->first();
        $reserved_rooms = \DB::table('td_reserved_rooms')->where('reservation_id', $reservation->id)->get();

        /*
         * Send Email
         */

        $bookingEmail = base_path() . "/resources/views/user/emails/booking_notification.blade.php";
        $bookingEmailTemplate = file_get_contents($bookingEmail);

        $bookingEmailTemplate = str_replace('{reservation_id}', 'DL-' . date('d.m.y') . '-' . $reservation->id, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{checkin_date}', date('M d, Y', strtotime($reservation->checkin_date)), $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{checkout_date}', date('M d, Y', strtotime($reservation->checkout_date)), $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{price}', '€' . $reservation->price, $bookingEmailTemplate);

        $bookingEmailTemplate = str_replace('{already_stayed}', $preferences->already_stayed, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{family_name}', trim($preferences->first_name . ' ' . $preferences->last_name), $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{relationship}', $preferences->relationship, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{purpose_of_stay}', $preferences->purpose_of_stay, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{stay_details}', $preferences->stay_details, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{desired_room_temperature}', $preferences->desired_room_temperature, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{smoking_preference}', $preferences->smoking_preference, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{rollaway_bed}', $preferences->rollaway_bed, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{crib}', $preferences->crib, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{wheelchair_accessible}', $preferences->wheelchair_accessible, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{generally_am_size}', $preferences->generally_am_size, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{pillow_firmness}', $preferences->pillow_firmness, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{pillow_type}', $preferences->pillow_type, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{bed_style}', $preferences->bed_style, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{generally_sleep_on}', $preferences->generally_sleep_on, $bookingEmailTemplate);

        $cultural_interests_values = array();
        if ($preferences->art == 'Yes') {
            $cultural_interests_values[] = 'Art';
        }
        if ($preferences->architecture_interior_design == 'Yes') {
            $cultural_interests_values[] = 'Architecture & Interior Design';
        }
        if ($preferences->cigars == 'Yes') {
            $cultural_interests_values[] = 'Cigars';
        }
        if ($preferences->dance == 'Yes') {
            $cultural_interests_values[] = 'Dance';
        }
        if ($preferences->fashion == 'Yes') {
            $cultural_interests_values[] = 'Fashion';
        }
        if ($preferences->gastronomy == 'Yes') {
            $cultural_interests_values[] = 'Gastronomy';
        }
        if ($preferences->literature == 'Yes') {
            $cultural_interests_values[] = 'Literature';
        }
        if ($preferences->music == 'Yes') {
            $cultural_interests_values[] = 'Music';
        }
        if ($preferences->nature == 'Yes') {
            $cultural_interests_values[] = 'Nature';
        }
        if ($preferences->photography == 'Yes') {
            $cultural_interests_values[] = 'Photography';
        }
        if ($preferences->science == 'Yes') {
            $cultural_interests_values[] = 'Science';
        }
        if ($preferences->technology == 'Yes') {
            $cultural_interests_values[] = 'Technology';
        }
        if ($preferences->travel == 'Yes') {
            $cultural_interests_values[] = 'Travel';
        }
        if ($preferences->watches == 'Yes') {
            $cultural_interests_values[] = 'Watches';
        }
        if ($preferences->wines_spirits == 'Yes') {
            $cultural_interests_values[] = 'Wines & Spirits';
        }

        if (!empty($cultural_interests_values)) {
            $cultural_interests_list = '<ul style="float: left; width: calc(50% - 30px);">';
            foreach ($cultural_interests_values as $key => $cultural_interests_value) {
                $cultural_interests_list .= '<li>' . $cultural_interests_value . '</li>';
                if (($key + 1) == (round(count($cultural_interests_values) / 2))) {
                    $cultural_interests_list .= '</ul>';
                    $cultural_interests_list .= '<ul style="float: left;">';
                }
            }
            $cultural_interests_list .= '</ul>';
        } else {
            $cultural_interests_list = '<p></p>';
        }

        $bookingEmailTemplate = str_replace('{cultural_interests_list}', $cultural_interests_list, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{other_interests}', $preferences->other_interests, $bookingEmailTemplate);

        $sports_preferences_values = array();
        if ($preferences->snorkeling == 'Yes') {
            $sports_preferences_values[] = 'Snorkeling';
        }
        if ($preferences->diving == 'Yes') {
            $sports_preferences_values[] = 'Diving';
        }
        if ($preferences->sailing == 'Yes') {
            $sports_preferences_values[] = 'Sailing';
        }
        if ($preferences->tennis == 'Yes') {
            $sports_preferences_values[] = 'Tennis';
        }
        if ($preferences->golf == 'Yes') {
            $sports_preferences_values[] = 'Golf';
        }
        if ($preferences->motorized_water_sports == 'Yes') {
            $sports_preferences_values[] = 'Motorized water sports';
        }

        if (!empty($sports_preferences_values)) {
            $sports_preferences_list = '<ul style="float: left; width: calc(50% - 30px);">';
            foreach ($sports_preferences_values as $key => $sports_preferences_value) {
                $sports_preferences_list .= '<li>' . $sports_preferences_value . '</li>';
                if (($key + 1) == (round(count($sports_preferences_values) / 2))) {
                    $sports_preferences_list .= '</ul>';
                    $sports_preferences_list .= '<ul style="float: left;">';
                }
            }
            $sports_preferences_list .= '</ul>';
        } else {
            $sports_preferences_list = '<p></p>';
        }

        $bookingEmailTemplate = str_replace('{sports_preferences_list}', $sports_preferences_list, $bookingEmailTemplate);

        $wellbeing_preferences_values = array();
        if ($preferences->spa_treatments == 'Yes') {
            $wellbeing_preferences_values[] = 'Spa treatments';
        }
        if ($preferences->hair_treatments == 'Yes') {
            $wellbeing_preferences_values[] = 'Hair treatments';
        }
        if ($preferences->fitness == 'Yes') {
            $wellbeing_preferences_values[] = 'Fitness';
        }
        if ($preferences->pool == 'Yes') {
            $wellbeing_preferences_values[] = 'Pool';
        }
        if ($preferences->yoga == 'Yes') {
            $wellbeing_preferences_values[] = 'Yoga';
        }
        if ($preferences->pilates == 'Yes') {
            $wellbeing_preferences_values[] = 'Pilates';
        }
        if ($preferences->meditation == 'Yes') {
            $wellbeing_preferences_values[] = 'Meditation';
        }

        if (!empty($wellbeing_preferences_values)) {
            $wellbeing_preferences_list = '<ul style="float: left; width: calc(50% - 30px);">';
            foreach ($wellbeing_preferences_values as $key => $wellbeing_preferences_value) {
                $wellbeing_preferences_list .= '<li>' . $wellbeing_preferences_value . '</li>';
                if (($key + 1) == (round(count($wellbeing_preferences_values) / 2))) {
                    $wellbeing_preferences_list .= '</ul>';
                    $wellbeing_preferences_list .= '<ul style="float: left;">';
                }
            }
            $wellbeing_preferences_list .= '</ul>';
        } else {
            $wellbeing_preferences_list = '<p></p>';
        }

        $bookingEmailTemplate = str_replace('{wellbeing_preferences_list}', $wellbeing_preferences_list, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{prefer_language}', $preferences->prefer_language, $bookingEmailTemplate);

        $dietary_preferences_values = array();
        if ($preferences->vegetarian == 'Yes') {
            $dietary_preferences_values[] = 'Vegetarian';
        }
        if ($preferences->halal == 'Yes') {
            $dietary_preferences_values[] = 'Halal';
        }
        if ($preferences->kosher == 'Yes') {
            $dietary_preferences_values[] = 'Kosher';
        }
        if ($preferences->gluten_free == 'Yes') {
            $dietary_preferences_values[] = 'Gluten-free';
        }
        if ($preferences->ovo_lactarian == 'Yes') {
            $dietary_preferences_values[] = 'Ovo-lactarian';
        }

        if (!empty($dietary_preferences_values)) {
            $dietary_preferences_list = '<ul style="float: left; width: calc(50% - 30px);">';
            foreach ($dietary_preferences_values as $key => $dietary_preferences_value) {
                $dietary_preferences_list .= '<li>' . $dietary_preferences_value . '</li>';
                if (($key + 1) == (round(count($dietary_preferences_values) / 2))) {
                    $dietary_preferences_list .= '</ul>';
                    $dietary_preferences_list .= '<ul style="float: left;">';
                }
            }
            $dietary_preferences_list .= '</ul>';
        } else {
            $dietary_preferences_list = '<p></p>';
        }

        $bookingEmailTemplate = str_replace('{dietary_preferences_list}', $dietary_preferences_list, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{favourite_dishes}', $preferences->favourite_dishes, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{food_allergies}', $preferences->food_allergies, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{known_allergies}', $preferences->known_allergies, $bookingEmailTemplate);

        $snacks_preferences_values = array();
        if ($preferences->savory_snacks == 'Yes') {
            $snacks_preferences_values[] = 'Savory snacks';
        }
        if ($preferences->any_sweet_snacks == 'Yes') {
            $snacks_preferences_values[] = 'Any sweet snacks';
        }
        if ($preferences->chocolate_based_pastries == 'Yes') {
            $snacks_preferences_values[] = 'Chocolate based pastries';
        }
        if ($preferences->fruit_based_pastries == 'Yes') {
            $snacks_preferences_values[] = 'Fruit based pastries';
        }

        if (!empty($snacks_preferences_values)) {
            $snacks_preferences_list = '<ul style="float: left; width: calc(50% - 30px);">';
            foreach ($snacks_preferences_values as $key => $snacks_preferences_value) {
                $snacks_preferences_list .= '<li>' . $snacks_preferences_value . '</li>';
                if (($key + 1) == (round(count($snacks_preferences_values) / 2))) {
                    $snacks_preferences_list .= '</ul>';
                    $snacks_preferences_list .= '<ul style="float: left;">';
                }
            }
            $snacks_preferences_list .= '</ul>';
        } else {
            $snacks_preferences_list = '<p></p>';
        }

        $bookingEmailTemplate = str_replace('{snacks_preferences_list}', $snacks_preferences_list, $bookingEmailTemplate);

        $fruits_preferences_values = array();
        if ($preferences->seasonal_fruits == 'Yes') {
            $fruits_preferences_values[] = 'Seasonal fruits';
        }
        if ($preferences->exotic_fruits == 'Yes') {
            $fruits_preferences_values[] = 'Exotic fruits';
        }
        if ($preferences->dried_fruits_and_nuts == 'Yes') {
            $fruits_preferences_values[] = 'Dried fruits and nuts';
        }

        if (!empty($fruits_preferences_values)) {
            $fruits_preferences_list = '<ul style="float: left; width: calc(50% - 30px);">';
            foreach ($fruits_preferences_values as $key => $fruits_preferences_value) {
                $fruits_preferences_list .= '<li>' . $fruits_preferences_value . '</li>';
                if (($key + 1) == (round(count($fruits_preferences_values) / 2))) {
                    $fruits_preferences_list .= '</ul>';
                    $fruits_preferences_list .= '<ul style="float: left;">';
                }
            }
            $fruits_preferences_list .= '</ul>';
        } else {
            $fruits_preferences_list = '<p></p>';
        }

        $bookingEmailTemplate = str_replace('{fruits_preferences_list}', $fruits_preferences_list, $bookingEmailTemplate);

        $beverages_preferences_values = array();
        if ($preferences->seasonal_fruits == 'Yes') {
            $beverages_preferences_values[] = 'Seasonal fruits';
        }
        if ($preferences->exotic_fruits == 'Yes') {
            $beverages_preferences_values[] = 'Exotic fruits';
        }
        if ($preferences->dried_fruits_and_nuts == 'Yes') {
            $beverages_preferences_values[] = 'Dried fruits and nuts';
        }

        if (!empty($beverages_preferences_values)) {
            $beverages_preferences_list = '<ul style="float: left; width: calc(50% - 30px);">';
            foreach ($beverages_preferences_values as $key => $beverages_preferences_value) {
                $beverages_preferences_list .= '<li>' . $beverages_preferences_value . '</li>';
                if (($key + 1) == (round(count($beverages_preferences_values) / 2))) {
                    $beverages_preferences_list .= '</ul>';
                    $beverages_preferences_list .= '<ul style="float: left;">';
                }
            }
            $beverages_preferences_list .= '</ul>';
        } else {
            $beverages_preferences_list = '<p></p>';
        }

        $bookingEmailTemplate = str_replace('{beverages_preferences_list}', $beverages_preferences_list, $bookingEmailTemplate);

        $sodas_preferences_values = array();
        if ($preferences->seasonal_fruits == 'Yes') {
            $sodas_preferences_values[] = 'Seasonal fruits';
        }
        if ($preferences->exotic_fruits == 'Yes') {
            $sodas_preferences_values[] = 'Exotic fruits';
        }
        if ($preferences->dried_fruits_and_nuts == 'Yes') {
            $sodas_preferences_values[] = 'Dried fruits and nuts';
        }

        if (!empty($sodas_preferences_values)) {
            $sodas_preferences_list = '<ul style="float: left; width: calc(50% - 30px);">';
            foreach ($sodas_preferences_values as $key => $sodas_preferences_value) {
                $sodas_preferences_list .= '<li>' . $sodas_preferences_value . '</li>';
                if (($key + 1) == (round(count($sodas_preferences_values) / 2))) {
                    $sodas_preferences_list .= '</ul>';
                    $sodas_preferences_list .= '<ul style="float: left;">';
                }
            }
            $sodas_preferences_list .= '</ul>';
        } else {
            $sodas_preferences_list = '<p></p>';
        }

        $bookingEmailTemplate = str_replace('{sodas_preferences_list}', $sodas_preferences_list, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{preferred_aperitif}', $preferences->preferred_aperitif, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{upcoming_visit_remarks}', $preferences->upcoming_visit_remarks, $bookingEmailTemplate);

        $bookingEmailTemplate = str_replace('{property_name}', $property->property_name, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{property_city}', $property->city, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{property_country}', $property->country, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{property_website}', $property->website, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{property_phone}', $property->phone, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{property_email}', $property->email, $bookingEmailTemplate);

        $bookingEmailTemplate = str_replace('{category_name}', $type->category_name, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{category_image}', $type_image->imgsrc . $type_image->file_name, $bookingEmailTemplate);

        $bookingEmailTemplate = str_replace('{full_user_name}', trim($user_info->first_name . ' ' . $user_info->last_name), $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{title}', $user_info->title, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{birthday}', date("d/m/Y", strtotime($user_info->birthday)), $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{landline_number}', $user_info->landline_code . '-' . $user_info->landline_number, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{mobile_number}', $user_info->mobile_code . '-' . $user_info->mobile_number, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{prefer_communication_with}', $user_info->prefer_communication_with, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{email}', $user_info->email, $bookingEmailTemplate);

        $total_price = 0;
        $html = '';
        foreach ($reserved_rooms as $reserved_room) {
            $total_price += ($reservation->number_of_nights * $reservation->price);
            $html .= '<tr>
                        <th width="209" class="stack2" style="margin: 0;padding: 0;border-collapse: collapse;">
                            <table width="209" align="center" cellpadding="0" cellspacing="0" border="0" class="table60032" style="border-bottom-color: #C7AB84;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                <tr>
                                    <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                    <!-- DESCRIPTION -->
                                    <td class="header2TD" style="border-collapse: collapse;" mc:edit="mcsec-25">' . $type->category_name . '
                                        <br/> </td>
                                    <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                </tr>
                                <tr>
                                    <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                </tr>
                            </table>
                        </th>
                        <th width="139" class="stack3" style="border-left: 1px solid #C7AB84;margin: 0;padding: 0;border-collapse: collapse;">
                            <table width="139" align="center" cellpadding="0" cellspacing="0" border="0" class="table60033" style="border-bottom-color: #C7AB84;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                <tr>
                                    <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                    <!-- PRICE -->
                                    <td class="RegularText5TD" style="border-collapse: collapse;" mc:edit="mcsec-26">€' . $reservation->price . '</td>
                                    <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                </tr>
                                <tr>
                                    <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                </tr>
                            </table>
                        </th>
                        <th width="139" class="stack3" style="border-left: 1px solid #C7AB84;margin: 0;padding: 0;border-collapse: collapse;">
                            <table width="139" align="center" cellpadding="0" cellspacing="0" border="0" class="table60033" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                <tr>
                                    <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                    <!-- QUANTITY -->
                                    <td class="RegularText5TD" style="border-collapse: collapse;" mc:edit="mcsec-27">' . $reservation->number_of_nights . '</td>
                                    <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                </tr>
                                <tr>
                                    <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                </tr>
                            </table>
                        </th>
                        <th width="139" class="stack3" style="border-left: 1px solid #C7AB84;margin: 0;padding: 0;border-collapse: collapse;">
                            <table width="139" align="center" cellpadding="0" cellspacing="0" border="0" class="table60033" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                <tr>
                                    <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                    <!-- TOTAL -->
                                    <td class="RegularText5TD" style="border-collapse: collapse;" mc:edit="mcsec-28">€' . ($reservation->number_of_nights * $reservation->price) . '</td>
                                    <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                </tr>
                                <tr>
                                    <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                </tr>
                            </table>
                        </th>
                    </tr>';
        }

        $commission_due = $total_price * ($property->commission / 100);
        $grand_total = $commission_due + $total_price;

        $bookingEmailTemplate = str_replace('{reserved_rooms}', $html, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{total_price}', '€' . $total_price, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{commission_due}', '€' . $commission_due, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{grand_total}', '€' . $grand_total, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{hotel_terms_n_conditions}', $hotel_terms_n_conditions, $bookingEmailTemplate);
        $bookingEmailTemplate = str_replace('{property_email}', $property->email, $bookingEmailTemplate);

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: ' . CNF_APPNAME . '<marketing@emporium-voyage.com>' . "\r\n";

        mail($property->email, "Booking Confirmation", $bookingEmailTemplate, $headers);
        mail($user_info->email, "Booking Confirmation", $bookingEmailTemplate, $headers);

        return Redirect::to("bookings")->with('messagetext', "Email sent successfully.")->with('msgstatus', 'success');

//        return json_encode($property);
        return $bookingEmailTemplate;
    }

    function postSave(Request $request) {

        $rules = $this->validateForm();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $data = $this->validatePost('tb_reservations');

            if ($request->input('booking_preference_id') != '') {

                /*
                 * Save booking preferences
                 */

                $bp_data['already_stayed'] = $request->input('already_stayed');
                $bp_data['arrival_time'] = $request->input('arrival_time_hh') . ':' . $request->input('arrival_time_mm');
                $bp_data['first_name'] = $request->input('first_name');
                $bp_data['last_name'] = $request->input('last_name');
                $bp_data['relationship'] = $request->input('relationship');
                $bp_data['purpose_of_stay'] = $request->input('purpose_of_stay');
                $bp_data['stay_details'] = $request->input('stay_details');
                $bp_data['desired_room_temperature'] = $request->input('desired_room_temperature');
                $bp_data['smoking_preference'] = $request->input('smoking_preference');
                $bp_data['rollaway_bed'] = (!is_null($request->input('rollaway_bed')) && $request->input('rollaway_bed') != '') ? 'Yes' : 'No';
                $bp_data['crib'] = (!is_null($request->input('crib')) && $request->input('crib') != '') ? 'Yes' : 'No';
                $bp_data['wheelchair_accessible'] = (!is_null($request->input('wheelchair_accessible')) && $request->input('wheelchair_accessible') != '') ? 'Yes' : 'No';
                $bp_data['generally_am_size'] = $request->input('generally_am_size');
                $bp_data['pillow_firmness'] = $request->input('pillow_firmness');
                $bp_data['pillow_type'] = $request->input('pillow_type');
                $bp_data['bed_style'] = $request->input('bed_style');
                $bp_data['art'] = (!is_null($request->input('art')) && $request->input('art') != '') ? 'Yes' : 'No';
                $bp_data['architecture_interior_design'] = (!is_null($request->input('architecture_interior_design')) && $request->input('architecture_interior_design') != '') ? 'Yes' : 'No';
                $bp_data['cigars'] = (!is_null($request->input('cigars')) && $request->input('cigars') != '') ? 'Yes' : 'No';
                $bp_data['dance'] = (!is_null($request->input('dance')) && $request->input('dance') != '') ? 'Yes' : 'No';
                $bp_data['fashion'] = (!is_null($request->input('fashion')) && $request->input('fashion') != '') ? 'Yes' : 'No';
                $bp_data['gastronomy'] = (!is_null($request->input('gastronomy')) && $request->input('gastronomy') != '') ? 'Yes' : 'No';
                $bp_data['literature'] = (!is_null($request->input('literature')) && $request->input('literature') != '') ? 'Yes' : 'No';
                $bp_data['music'] = (!is_null($request->input('music')) && $request->input('music') != '') ? 'Yes' : 'No';
                $bp_data['nature'] = (!is_null($request->input('nature')) && $request->input('nature') != '') ? 'Yes' : 'No';
                $bp_data['photography'] = (!is_null($request->input('photography')) && $request->input('photography') != '') ? 'Yes' : 'No';
                $bp_data['science'] = (!is_null($request->input('science')) && $request->input('science') != '') ? 'Yes' : 'No';
                $bp_data['technology'] = (!is_null($request->input('technology')) && $request->input('technology') != '') ? 'Yes' : 'No';
                $bp_data['travel'] = (!is_null($request->input('travel')) && $request->input('travel') != '') ? 'Yes' : 'No';
                $bp_data['watches'] = (!is_null($request->input('watches')) && $request->input('watches') != '') ? 'Yes' : 'No';
                $bp_data['wines_spirits'] = (!is_null($request->input('wines_spirits')) && $request->input('wines_spirits') != '') ? 'Yes' : 'No';
                $bp_data['other_interests'] = $request->input('other_interests');
                $bp_data['snorkeling'] = (!is_null($request->input('snorkeling')) && $request->input('snorkeling') != '') ? 'Yes' : 'No';
                $bp_data['diving'] = (!is_null($request->input('diving')) && $request->input('diving') != '') ? 'Yes' : 'No';
                $bp_data['sailing'] = (!is_null($request->input('sailing')) && $request->input('sailing') != '') ? 'Yes' : 'No';
                $bp_data['tennis'] = (!is_null($request->input('tennis')) && $request->input('tennis') != '') ? 'Yes' : 'No';
                $bp_data['golf'] = (!is_null($request->input('golf')) && $request->input('golf') != '') ? 'Yes' : 'No';
                $bp_data['motorized_water_sports'] = (!is_null($request->input('motorized_water_sports')) && $request->input('motorized_water_sports') != '') ? 'Yes' : 'No';
                $bp_data['spa_treatments'] = (!is_null($request->input('spa_treatments')) && $request->input('spa_treatments') != '') ? 'Yes' : 'No';
                $bp_data['hair_treatments'] = (!is_null($request->input('hair_treatments')) && $request->input('hair_treatments') != '') ? 'Yes' : 'No';
                $bp_data['fitness'] = (!is_null($request->input('fitness')) && $request->input('fitness') != '') ? 'Yes' : 'No';
                $bp_data['yoga'] = (!is_null($request->input('yoga')) && $request->input('yoga') != '') ? 'Yes' : 'No';
                $bp_data['pilates'] = (!is_null($request->input('pilates')) && $request->input('pilates') != '') ? 'Yes' : 'No';
                $bp_data['meditation'] = (!is_null($request->input('meditation')) && $request->input('meditation') != '') ? 'Yes' : 'No';
                $bp_data['prefer_language'] = $request->input('prefer_language');
                $bp_data['vegetarian'] = (!is_null($request->input('vegetarian')) && $request->input('vegetarian') != '') ? 'Yes' : 'No';
                $bp_data['halal'] = (!is_null($request->input('halal')) && $request->input('halal') != '') ? 'Yes' : 'No';
                $bp_data['kosher'] = (!is_null($request->input('kosher')) && $request->input('kosher') != '') ? 'Yes' : 'No';
                $bp_data['gluten_free'] = (!is_null($request->input('gluten_free')) && $request->input('gluten_free') != '') ? 'Yes' : 'No';
                $bp_data['ovo_lactarian'] = (!is_null($request->input('ovo_lactarian')) && $request->input('ovo_lactarian') != '') ? 'Yes' : 'No';
                $bp_data['favourite_dishes'] = $request->input('favourite_dishes');
                $bp_data['food_allergies'] = $request->input('food_allergies');
                $bp_data['known_allergies'] = $request->input('known_allergies');
                $bp_data['savory_snacks'] = (!is_null($request->input('savory_snacks')) && $request->input('savory_snacks') != '') ? 'Yes' : 'No';
                $bp_data['any_sweet_snacks'] = (!is_null($request->input('any_sweet_snacks')) && $request->input('any_sweet_snacks') != '') ? 'Yes' : 'No';
                $bp_data['chocolate_based_pastries'] = (!is_null($request->input('chocolate_based_pastries')) && $request->input('chocolate_based_pastries') != '') ? 'Yes' : 'No';
                $bp_data['fruit_based_pastries'] = (!is_null($request->input('fruit_based_pastries')) && $request->input('fruit_based_pastries') != '') ? 'Yes' : 'No';
                $bp_data['seasonal_fruits'] = (!is_null($request->input('seasonal_fruits')) && $request->input('seasonal_fruits') != '') ? 'Yes' : 'No';
                $bp_data['exotic_fruits'] = (!is_null($request->input('exotic_fruits')) && $request->input('exotic_fruits') != '') ? 'Yes' : 'No';
                $bp_data['dried_fruits_and_nuts'] = (!is_null($request->input('dried_fruits_and_nuts')) && $request->input('dried_fruits_and_nuts') != '') ? 'Yes' : 'No';
                $bp_data['espresso'] = (!is_null($request->input('espresso')) && $request->input('espresso') != '') ? 'Yes' : 'No';
                $bp_data['cafe_au_lait'] = (!is_null($request->input('cafe_au_lait')) && $request->input('cafe_au_lait') != '') ? 'Yes' : 'No';
                $bp_data['tea'] = (!is_null($request->input('tea')) && $request->input('tea') != '') ? 'Yes' : 'No';
                $bp_data['herbal_tea'] = (!is_null($request->input('herbal_tea')) && $request->input('herbal_tea') != '') ? 'Yes' : 'No';
                $bp_data['hot_chocolate'] = (!is_null($request->input('hot_chocolate')) && $request->input('hot_chocolate') != '') ? 'Yes' : 'No';
                $bp_data['coca'] = (!is_null($request->input('coca')) && $request->input('coca') != '') ? 'Yes' : 'No';
                $bp_data['diet_coke'] = (!is_null($request->input('diet_coke')) && $request->input('diet_coke') != '') ? 'Yes' : 'No';
                $bp_data['pepsi'] = (!is_null($request->input('pepsi')) && $request->input('pepsi') != '') ? 'Yes' : 'No';
                $bp_data['diet_pepsi'] = (!is_null($request->input('diet_pepsi')) && $request->input('diet_pepsi') != '') ? 'Yes' : 'No';
                $bp_data['orange_soda'] = (!is_null($request->input('orange_soda')) && $request->input('orange_soda') != '') ? 'Yes' : 'No';
                $bp_data['lemon_soda'] = (!is_null($request->input('lemon_soda')) && $request->input('lemon_soda') != '') ? 'Yes' : 'No';
                $bp_data['served_with_lemon'] = (!is_null($request->input('served_with_lemon')) && $request->input('served_with_lemon') != '') ? 'Yes' : 'No';
                $bp_data['served_with_ice_cubes'] = (!is_null($request->input('served_with_ice_cubes')) && $request->input('served_with_ice_cubes') != '') ? 'Yes' : 'No';
                $bp_data['preferred_aperitif'] = $request->input('preferred_aperitif');
                $bp_data['upcoming_visit_remarks'] = $request->input('upcoming_visit_remarks');

                \DB::table('td_booking_preferences')->where('booking_preference_id', $request->input('booking_preference_id'))->update($bp_data);
            }

            if (isset($data['reservation_number'])) {
                unset($data['reservation_number']);
            }
            $data['guest_title'] = $request->input('guest_title');
            $data['guest_names'] = $request->input('guest_names');
            $data['guest_birthday'] = $request->input('guest_birthday');
            $data['guest_address'] = $request->input('guest_address');
            $data['guest_city'] = $request->input('guest_city');
            $data['guest_zip_code'] = $request->input('guest_zip_code');
            $data['guest_country'] = $request->input('guest_country');
            $data['guest_landline_code'] = $request->input('guest_landline_code');
            $data['guest_landline_number'] = $request->input('guest_landline_number');
            $data['guest_mobile_code'] = $request->input('guest_mobile_code');
            $data['guest_mobile_number'] = $request->input('guest_mobile_number');
            $data['guest_email'] = $request->input('guest_email');
            $data['price'] = $request->input('price');
            $data['price_mode'] = $request->input('price_mode');
            $data['organizing_transfers'] = $request->input('organizing_transfers');
            $data['booking_status'] = $request->input('booking_status');

            $id = $this->model->insertRow($data, $request->input('id'));

            $reserved_room_ids = $request->input('reserved_room_id');
            $booking_adults = $request->input('booking_adults');
            $booking_children = $request->input('booking_children');

            if (!empty($reserved_room_ids)) {
                foreach ($reserved_room_ids as $key => $reserved_room_id) {

                    $rooms_data['booking_adults'] = $booking_adults[$key];
                    $rooms_data['booking_children'] = $booking_children[$key];

                    \DB::table('td_reserved_rooms')->where('reserved_room_id', $reserved_room_id)->update($rooms_data);
                }
            }

            if (!is_null($request->input('apply'))) {
                $return = 'bookings/update/' . $id . '?return=' . self::returnUrl();
            } else {
                $return = 'bookings?return=' . self::returnUrl();
            }

            // Insert logs into database
            if ($request->input('id') == '') {
                \SiteHelpers::auditTrail($request, 'New Data with ID ' . $id . ' Has been Inserted !');
            } else {
                \SiteHelpers::auditTrail($request, 'Data with ID ' . $id . ' Has been Updated !');
            }

            return Redirect::to($return)->with('messagetext', \Lang::get('core.note_success'))->with('msgstatus', 'success');
        } else {

            return Redirect::to('bookings/update/' . $id)->with('messagetext', \Lang::get('core.note_error'))->with('msgstatus', 'error')
                            ->withErrors($validator)->withInput();
        }
    }

    public function postDelete(Request $request) {

        if ($this->access['is_remove'] == 0)
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');
        // delete multipe rows 
        if (count($request->input('ids')) >= 1) {
            $this->model->destroy($request->input('ids'));

            \SiteHelpers::auditTrail($request, "ID : " . implode(",", $request->input('ids')) . "  , Has Been Removed Successfull");
            // redirect
            return Redirect::to('bookings')
                            ->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus', 'success');
        } else {
            return Redirect::to('bookings')
                            ->with('messagetext', 'No Item Deleted')->with('msgstatus', 'error');
        }
    }
    
    public function travellerBookings(Request $request){ 
        $uid = \Auth::user()->id;
        $this->data['hide_email_btn'] = false;
        if ($this->access['is_view'] == 0)
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');

        $sort = (!is_null($request->input('sort')) ? $request->input('sort') : 'id');
        $order = (!is_null($request->input('order')) ? $request->input('order') : 'asc');
        // End Filter sort and order for query 
        // Filter Search for query		
        $filter = (!is_null($request->input('search')) ? $this->buildSearch() : '');
        $filter .= " AND tb_reservations.client_id = '".\Session::get('uid')."'" ;
        
        if (\Auth::user()->group_id != 1) {
            $this->data['hide_email_btn'] = true;
            $filter .= " AND (client_id='" . $uid . "')";
        }
		
        $page = $request->input('page', 1);
        $params = array(
            'page' => $page,
            'limit' => (!is_null($request->input('rows')) ? filter_var($request->input('rows'), FILTER_VALIDATE_INT) : static::$per_page ),
            'sort' => $sort,
            'order' => $order,
            'params' => $filter,
            'global' => (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
        );

        // Get Query 
        $results = $this->model->getRows($params);
        
        // Build pagination setting
        $page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;
        $pagination = new Paginator($results['rows'], $results['total'], $params['limit']);
        $pagination->setPath('traveller/bookings');

        if (!empty($results['rows'])) {
            foreach ($results['rows'] as $key => $row) {
                $results['rows'][$key]->category = \DB::table('tb_properties_category_types')->where('id', $row->type_id)->where('status', 0)->where('show_on_booking', 1)->first();
                $results['rows'][$key]->category_image = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $results['rows'][$key]->category->property_id)->where('tb_properties_images.category_id', $row->type_id)->where('tb_properties_images.type', 'Rooms Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();
                $results['rows'][$key]->category_image->imgsrc = (new ContainerController)->getThumbpath($results['rows'][$key]->category_image->folder_id);

                $props = \DB::table('tb_properties')->where('id', $results['rows'][$key]->category->property_id)->first();
                $results['rows'][$key]->props = $props;
                
                if ($props->default_seasons != 1) {
                    $checkseason = \DB::table('tb_seasons')->where('property_id', $props->id)->orderBy('season_priority', 'asc')->get();
                } else {
                    $checkseason = \DB::table('tb_seasons')->where('property_id', 0)->orderBy('season_priority', 'asc')->get();
                }
                if (!empty($checkseason)) {
                    $foundsean = false;
                    $curnDate = date('Y-m-d');
                    for ($sc = 0; $foundsean != true; $sc++) {
                        $checkseasonDate = \DB::table('tb_seasons_dates')->where('season_id', $checkseason[$sc]->id)->where('season_from_date', '>=', $curnDate)->where('season_to_date', '<=', $curnDate)->count();
                        if ($checkseasonDate > 0) {
                            $checkseasonPrice = \DB::table('tb_properties_category_rooms_price')->where('season_id', $checkseason[$sc]->id)->where('property_id', $props->id)->where('category_id', $results['rows'][$key]->category->id)->first();
                            if (!empty($checkseasonPrice)) {
                                $results['rows'][$key]->category->price = $checkseasonPrice->rack_rate;
                                $foundsean = true;
                            }
                        }
                    }
                    if ($foundsean != true) {
                        $checkseasonPrice_ifnotforloop = \DB::table('tb_properties_category_rooms_price')->where('season_id', 0)->where('property_id', $props->id)->where('category_id', $results['rows'][$key]->category->id)->first();
                        if (!empty($checkseasonPrice_ifnotforloop)) {
                            $results['rows'][$key]->category->price = $checkseasonPrice_ifnotforloop->rack_rate;
                        }
                    }
                } else {
                    $checkseasonPrice_ifnotanyseason = \DB::table('tb_properties_category_rooms_price')->where('season_id', 0)->where('property_id', $props->id)->where('category_id', $results['rows'][$key]->category->id)->first();
                    if (!empty($checkseasonPrice_ifnotanyseason)) {
                        $results['rows'][$key]->category->price = $checkseasonPrice_ifnotanyseason->rack_rate;
                    }
                }
                $results['rows'][$key]->category->currency = \DB::table('tb_settings')->where('key_value', 'default_currency')->first();
                $results['rows'][$key]->user_info = \DB::table('tb_users')->where('id', $row->client_id)->first();
                
                $results['rows'][$key]->reserved_rooms = \DB::table('td_reserved_rooms')->join('tb_properties_category_types', 'td_reserved_rooms.type_id', '=', 'tb_properties_category_types.id' )->where('reservation_id', $row->id)->get();
            }
        }

        $this->data['rowData'] = $results['rows'];
        // Build Pagination 
        $this->data['pagination'] = $pagination;
        // Build pager number and append current param GET
        $this->data['pager'] = $this->injectPaginate();
        // Row grid Number 
        $this->data['i'] = ($page * $params['limit']) - $params['limit'];
        // Grid Configuration 
        $this->data['tableGrid'] = $this->info['config']['grid'];
        $this->data['tableForm'] = $this->info['config']['forms'];
        $this->data['colspan'] = \SiteHelpers::viewColSpan($this->info['config']['grid']);
        // Group users permission
        $this->data['access'] = $this->access;
        // Detail from master if any
        // Master detail link if any 
        $this->data['subgrid'] = (isset($this->info['config']['subgrid']) ? $this->info['config']['subgrid'] : array());
        // Render into template

        if (\Auth::user()->group_id == 4) {
            return view('customer.bookings', $this->data);
        }
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());        
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.bookings.index':'bookings.index';
        
        return view($file_name, $this->data);
    }
    public function showBooking(Request $request, $id=''){
        if ($this->access['is_detail'] == 0)
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');

        $row = $this->model->getRow($id);
        if ($row) {
            
            
                $row->category = \DB::table('tb_properties_category_types')->where('id', $row->type_id)->where('status', 0)->where('show_on_booking', 1)->first();
                $row->category_image = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $row->category->property_id)->where('tb_properties_images.category_id', $row->type_id)->where('tb_properties_images.type', 'Rooms Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();
                $row->category_image->imgsrc = (new ContainerController)->getThumbpath($row->category_image->folder_id);

                $props = \DB::table('tb_properties')->where('id', $row->category->property_id)->first();
                $row->props = $props;
                
                if ($props->default_seasons != 1) {
                    $checkseason = \DB::table('tb_seasons')->where('property_id', $props->id)->orderBy('season_priority', 'asc')->get();
                } else {
                    $checkseason = \DB::table('tb_seasons')->where('property_id', 0)->orderBy('season_priority', 'asc')->get();
                }
                if (!empty($checkseason)) {
                    $foundsean = false;
                    $curnDate = date('Y-m-d');
                    for ($sc = 0; $foundsean != true; $sc++) {
                        $checkseasonDate = \DB::table('tb_seasons_dates')->where('season_id', $checkseason[$sc]->id)->where('season_from_date', '>=', $curnDate)->where('season_to_date', '<=', $curnDate)->count();
                        if ($checkseasonDate > 0) {
                            $checkseasonPrice = \DB::table('tb_properties_category_rooms_price')->where('season_id', $checkseason[$sc]->id)->where('property_id', $props->id)->where('category_id', $results['rows'][$key]->category->id)->first();
                            if (!empty($checkseasonPrice)) {
                                $row->category->price = $checkseasonPrice->rack_rate;
                                $foundsean = true;
                            }
                        }
                    }
                    if ($foundsean != true) {
                        $checkseasonPrice_ifnotforloop = \DB::table('tb_properties_category_rooms_price')->where('season_id', 0)->where('property_id', $props->id)->where('category_id', $row->category->id)->first();
                        if (!empty($checkseasonPrice_ifnotforloop)) {
                            $row->category->price = $checkseasonPrice_ifnotforloop->rack_rate;
                        }
                    }
                } else {
                    $checkseasonPrice_ifnotanyseason = \DB::table('tb_properties_category_rooms_price')->where('season_id', 0)->where('property_id', $props->id)->where('category_id', $row->category->id)->first();
                    if (!empty($checkseasonPrice_ifnotanyseason)) {
                        $row->category->price = $checkseasonPrice_ifnotanyseason->rack_rate;
                    }
                }
                $row->category->currency = \DB::table('tb_settings')->where('key_value', 'default_currency')->first();
                $row->user_info = \DB::table('tb_users')->where('id', $row->client_id)->first();
                
                $row->reserved_rooms = \DB::table('td_reserved_rooms')->join('tb_properties_category_types', 'td_reserved_rooms.type_id', '=', 'tb_properties_category_types.id' )->where('reservation_id', $row->id)->get();
                $row->preferences = \DB::table('td_booking_preferences')->where('reservation_id', $row->id)->first();
                
                $this->data['row'] = $row;
            
        } else {
            $this->data['row'] = $this->model->getColumnTable('tb_reservations');
        }
        $this->data['fields'] = \SiteHelpers::fieldLang($this->info['config']['grid']);

        $this->data['id'] = $id;
        $this->data['access'] = $this->access;
        
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());        
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.bookings.view':'bookings.view';
        
        return view($file_name, $this->data);
    }
    public function hotelBookings(Request $request){ 
        $uid = \Auth::user()->id;
        $this->data['hide_email_btn'] = false;
        if ($this->access['is_view'] == 0)
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');

        $sort = (!is_null($request->input('sort')) ? $request->input('sort') : 'id');
        $order = (!is_null($request->input('order')) ? $request->input('order') : 'asc');
        // End Filter sort and order for query 
        $ids = array();
        $assigned_properties =  \DB::table('tb_properties')->select('id')->where('assigned_user_id', \Session::get('uid'))->get();
        if(count($assigned_properties) > 0){
            foreach($assigned_properties as $prop){
                $ids[] = $prop->id;
            }
        }
        $str_ids = implode(',', $ids);
        //print_r($assigned_properties); die;
        // Filter Search for query		
        $filter = (!is_null($request->input('search')) ? $this->buildSearch() : '');
        $filter .= " AND tb_reservations.property_id in ('".$str_ids."')" ;
        //echo $filter; die;
        if (\Auth::user()->group_id != 1) {
            $this->data['hide_email_btn'] = true;
            //$filter .= " AND (client_id='" . $uid . "')";
        }
		
        $page = $request->input('page', 1);
        $params = array(
            'page' => $page,
            'limit' => (!is_null($request->input('rows')) ? filter_var($request->input('rows'), FILTER_VALIDATE_INT) : static::$per_page ),
            'sort' => $sort,
            'order' => $order,
            'params' => $filter,
            'global' => (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
        );

        // Get Query 
        $results = $this->model->getRows($params);
        
        // Build pagination setting
        $page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;
        $pagination = new Paginator($results['rows'], $results['total'], $params['limit']);
        $pagination->setPath('traveller/bookings');

        if (!empty($results['rows'])) {
            foreach ($results['rows'] as $key => $row) {
                $results['rows'][$key]->category = \DB::table('tb_properties_category_types')->where('id', $row->type_id)->where('status', 0)->where('show_on_booking', 1)->first();
                $results['rows'][$key]->category_image = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $results['rows'][$key]->category->property_id)->where('tb_properties_images.category_id', $row->type_id)->where('tb_properties_images.type', 'Rooms Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();
                $results['rows'][$key]->category_image->imgsrc = (new ContainerController)->getThumbpath($results['rows'][$key]->category_image->folder_id);

                $props = \DB::table('tb_properties')->where('id', $results['rows'][$key]->category->property_id)->first();
                $results['rows'][$key]->props = $props;
                
                if ($props->default_seasons != 1) {
                    $checkseason = \DB::table('tb_seasons')->where('property_id', $props->id)->orderBy('season_priority', 'asc')->get();
                } else {
                    $checkseason = \DB::table('tb_seasons')->where('property_id', 0)->orderBy('season_priority', 'asc')->get();
                }
                if (!empty($checkseason)) {
                    $foundsean = false;
                    $curnDate = date('Y-m-d');
                    for ($sc = 0; $foundsean != true; $sc++) {
                        $checkseasonDate = \DB::table('tb_seasons_dates')->where('season_id', $checkseason[$sc]->id)->where('season_from_date', '>=', $curnDate)->where('season_to_date', '<=', $curnDate)->count();
                        if ($checkseasonDate > 0) {
                            $checkseasonPrice = \DB::table('tb_properties_category_rooms_price')->where('season_id', $checkseason[$sc]->id)->where('property_id', $props->id)->where('category_id', $results['rows'][$key]->category->id)->first();
                            if (!empty($checkseasonPrice)) {
                                $results['rows'][$key]->category->price = $checkseasonPrice->rack_rate;
                                $foundsean = true;
                            }
                        }
                    }
                    if ($foundsean != true) {
                        $checkseasonPrice_ifnotforloop = \DB::table('tb_properties_category_rooms_price')->where('season_id', 0)->where('property_id', $props->id)->where('category_id', $results['rows'][$key]->category->id)->first();
                        if (!empty($checkseasonPrice_ifnotforloop)) {
                            $results['rows'][$key]->category->price = $checkseasonPrice_ifnotforloop->rack_rate;
                        }
                    }
                } else {
                    $checkseasonPrice_ifnotanyseason = \DB::table('tb_properties_category_rooms_price')->where('season_id', 0)->where('property_id', $props->id)->where('category_id', $results['rows'][$key]->category->id)->first();
                    if (!empty($checkseasonPrice_ifnotanyseason)) {
                        $results['rows'][$key]->category->price = $checkseasonPrice_ifnotanyseason->rack_rate;
                    }
                }
                $results['rows'][$key]->category->currency = \DB::table('tb_settings')->where('key_value', 'default_currency')->first();
                $results['rows'][$key]->user_info = \DB::table('tb_users')->where('id', $row->client_id)->first();
                
                $results['rows'][$key]->reserved_rooms = \DB::table('td_reserved_rooms')->join('tb_properties_category_types', 'td_reserved_rooms.type_id', '=', 'tb_properties_category_types.id' )->where('reservation_id', $row->id)->get();
            }
        }

        $this->data['rowData'] = $results['rows'];
        // Build Pagination 
        $this->data['pagination'] = $pagination;
        // Build pager number and append current param GET
        $this->data['pager'] = $this->injectPaginate();
        // Row grid Number 
        $this->data['i'] = ($page * $params['limit']) - $params['limit'];
        // Grid Configuration 
        $this->data['tableGrid'] = $this->info['config']['grid'];
        $this->data['tableForm'] = $this->info['config']['forms'];
        $this->data['colspan'] = \SiteHelpers::viewColSpan($this->info['config']['grid']);
        // Group users permission
        $this->data['access'] = $this->access;
        // Detail from master if any
        // Master detail link if any 
        $this->data['subgrid'] = (isset($this->info['config']['subgrid']) ? $this->info['config']['subgrid'] : array());
        // Render into template

        if (\Auth::user()->group_id == 4) {
            return view('customer.bookings', $this->data);
        }
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());        
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.bookings.index':'bookings.index';
        
        return view($file_name, $this->data);
    }
    public function bookingshow($id = null) {
        if ($this->access['is_detail'] == 0)
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');

        $row = $this->model->getRow($id);
        if ($row) {
            
            
                $row->category = \DB::table('tb_properties_category_types')->where('id', $row->type_id)->where('status', 0)->where('show_on_booking', 1)->first();
                $row->category_image = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $row->category->property_id)->where('tb_properties_images.category_id', $row->type_id)->where('tb_properties_images.type', 'Rooms Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();
                $row->category_image->imgsrc = (new ContainerController)->getThumbpath($row->category_image->folder_id);

                $props = \DB::table('tb_properties')->where('id', $row->category->property_id)->first();
                $row->props = $props;
                
                if ($props->default_seasons != 1) {
                    $checkseason = \DB::table('tb_seasons')->where('property_id', $props->id)->orderBy('season_priority', 'asc')->get();
                } else {
                    $checkseason = \DB::table('tb_seasons')->where('property_id', 0)->orderBy('season_priority', 'asc')->get();
                }
                if (!empty($checkseason)) {
                    $foundsean = false;
                    $curnDate = date('Y-m-d');
                    for ($sc = 0; $foundsean != true; $sc++) {
                        $checkseasonDate = \DB::table('tb_seasons_dates')->where('season_id', $checkseason[$sc]->id)->where('season_from_date', '>=', $curnDate)->where('season_to_date', '<=', $curnDate)->count();
                        if ($checkseasonDate > 0) {
                            $checkseasonPrice = \DB::table('tb_properties_category_rooms_price')->where('season_id', $checkseason[$sc]->id)->where('property_id', $props->id)->where('category_id', $results['rows'][$key]->category->id)->first();
                            if (!empty($checkseasonPrice)) {
                                $row->category->price = $checkseasonPrice->rack_rate;
                                $foundsean = true;
                            }
                        }
                    }
                    if ($foundsean != true) {
                        $checkseasonPrice_ifnotforloop = \DB::table('tb_properties_category_rooms_price')->where('season_id', 0)->where('property_id', $props->id)->where('category_id', $row->category->id)->first();
                        if (!empty($checkseasonPrice_ifnotforloop)) {
                            $row->category->price = $checkseasonPrice_ifnotforloop->rack_rate;
                        }
                    }
                } else {
                    $checkseasonPrice_ifnotanyseason = \DB::table('tb_properties_category_rooms_price')->where('season_id', 0)->where('property_id', $props->id)->where('category_id', $row->category->id)->first();
                    if (!empty($checkseasonPrice_ifnotanyseason)) {
                        $row->category->price = $checkseasonPrice_ifnotanyseason->rack_rate;
                    }
                }
                $row->category->currency = \DB::table('tb_settings')->where('key_value', 'default_currency')->first();
                $row->user_info = \DB::table('tb_users')->where('id', $row->client_id)->first();
                
                $row->reserved_rooms = \DB::table('td_reserved_rooms')->join('tb_properties_category_types', 'td_reserved_rooms.type_id', '=', 'tb_properties_category_types.id' )->where('reservation_id', $row->id)->get();
                $row->preferences = \DB::table('td_booking_preferences')->where('reservation_id', $row->id)->first();
                
                $this->data['row'] = $row;
            
        } else {
            $this->data['row'] = $this->model->getColumnTable('tb_reservations');
        }
        $this->data['fields'] = \SiteHelpers::fieldLang($this->info['config']['grid']);

        $this->data['id'] = $id;
        $this->data['access'] = $this->access;
        
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());        
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.bookings.view':'bookings.view';
        
        return view($file_name, $this->data);
        /*if ($this->access['is_detail'] == 0)
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');

        $row = $this->model->getRow($id);
        if ($row) {
            $this->data['row'] = $row;
        } else {
            $this->data['row'] = $this->model->getColumnTable('tb_reservations');
        }
        $this->data['fields'] = \SiteHelpers::fieldLang($this->info['config']['grid']);

        $this->data['row'] = \DB::table('tb_reservations')->select('tb_reservations.*', 'tb_users.first_name','tb_users.email', 'tb_users.last_name', \DB::raw("(Select count(td_reserved_rooms.reserved_room_id) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_rooms"), \DB::raw("(Select sum(td_reserved_rooms.booking_adults) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_adults"), \DB::raw("(Select sum(td_reserved_rooms.booking_children) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_child"))->join('tb_users', 'tb_reservations.client_id', '=', 'tb_users.id')->where('tb_reservations.id', $id)->first();

        $this->data['id'] = $id;
        $this->data['access'] = $this->access;
        //return view(, $this->data);
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());  
        if(strlen($is_demo6) > 0){      
            $file_name = $is_demo6.'.bookings.hotelbookingview';
            return view($file_name, $this->data);
        }else{
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');
        }*/
        
    }
   	function searchbooking(Request $request) {	
        $this->data['keyword'] = $request->s;
        
		$arrive = $departure = $adult = $childs = '';
		if (!is_null($request->arrive) && $request->arrive != '' && $request->arrive != 'null') {			
            $arrive = \CommonHelper::dateformat($request->arrive);
		}
		if (!is_null($request->departure) && $request->departure != '' && $request->departure != 'null') {			
            $departure = \CommonHelper::dateformat($request->departure);
		}
		$this->data['arrive'] = $arrive;
        $this->data['departure'] = $departure;
        
		$uid = \Session::get('uid');
        $prop_id = 0;
        $property_name = '';
        $obj_property = \DB::table('tb_properties')->where('user_id', $uid)->first();
        if(!empty($obj_property)){
            $prop_id = $obj_property->id;
            $property_name = $obj_property->property_name;
        }
        $this->data['pid'] = $prop_id;
        
        $this->data['hotel_name'] = $property_name;
        
        $this->data['cat_types'] = (new PropertiesController)->find_categories_room($prop_id);
            
        $this->data['currency'] = \DB::table('tb_settings')->where('key_value', 'default_currency')->first();
        
        //return json_encode($res);
		//return view('frontend.themes.emporium.properties.list', $this->data);
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());  
        if(strlen($is_demo6) > 0){      
            $file_name = $is_demo6.'.bookings.searchbooking';
            return view($file_name, $this->data);
        }else{
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');
        }
    }
    function searchbookingresult(Request $request) {	
        $keyword = $request->skeyword;	
		$arrive = $departure = $adult = $childs = '';
		if (!is_null($request->arrive) && $request->arrive != '') {			
            $arrive = \CommonHelper::dateformat($request->arrive);
		}
		if (!is_null($request->departure) && $request->departure != '') {		
            $departure = \CommonHelper::dateformat($request->departure);
		}
		$uid = \Session::get('uid');
        
        
        
        $property_ids = array();
        if($uid > 0){
            $assigned_property = \DB::table('tb_properties_users')->where('user_id', $uid)->get();
            if(!empty($assigned_property)){
                foreach($assigned_property as $prop){
                    $property_ids[] = $prop->property_id;
                }
            }
        }
        $final_properties = implode(',', $property_ids);
		$query = "SELECT tb_reservations.*, tb_users.first_name, tb_users.last_name, (Select count(td_reserved_rooms.reserved_room_id) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_rooms, (Select sum(td_reserved_rooms.booking_adults) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_adults,(Select sum(td_reserved_rooms.booking_children) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_child from tb_reservations inner join tb_users on tb_reservations.client_id=tb_users.id  where 1=1 and tb_reservations.property_id in($final_properties)";
        
        if(strlen(trim($keyword))>0){ 
            $query .= " and booking_number=".$keyword;
        }        
        if (!is_null($request->arrive) && $request->arrive != ''  && $request->arrive != 'null') {
            $query .= " and created_date >= '".$arrive."'";            
        }
        if (!is_null($request->departure) && $request->departure != '' && $request->departure != 'null') {
            $query .= " and created_date <= '".$departure."'";            
        }
        //echo $query; die;
        $booking = \DB::select($query);
        
        $res['status'] = 'success';
        $res['data'] = $booking;
        return json_encode($res);		
    }
}