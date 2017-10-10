<?php

namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Properties;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator,
    Input,
    Redirect;
use File;

class PropertiesController extends Controller {

    protected $layout = "layouts.main";
    protected $data = array();
    public $module = 'properties';
    static $per_page = '500';

    public function __construct() {

        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->model = new Properties();

        $this->info = $this->model->makeInfo($this->module);
        $this->access = $this->model->validAccess($this->info['id']);

        $this->data = array(
            'pageTitle' => $this->info['title'],
            'pageNote' => $this->info['note'],
            'pageModule' => 'properties',
            'return' => self::returnUrl()
        );
    }

    public function getIndex(Request $request) {

        if ($this->access['is_view'] == 0)
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');

        $sort = (!is_null($request->input('sort')) ? $request->input('sort') : 'property_status');
        $order = (!is_null($request->input('order')) ? $request->input('order') : 'desc');
        // End Filter sort and order for query 
        // Filter Search for query		
        $filter = (!is_null($request->input('search')) ? $this->buildSearch() : '');
		$this->data['curntcat'] =  '';
		$this->data['curstatus'] =  '';
		if(!is_null($request->input('selcat')) && $request->input('selcat')!='')
		{
			$filter .= ' AND FIND_IN_SET('.$request->input('selcat').', property_category_id)';
			$this->data['curntcat'] = $request->input('selcat');
		}
		if(!is_null($request->input('selstatus')) && $request->input('selstatus')!='')
		{
			$pstatus = ($request->input('selstatus')=='active') ? 1 : 0;
			$filter .= ' AND property_status = '.$pstatus;
			$this->data['curstatus'] = $request->input('selstatus');
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
        $pagination->setPath('properties');
		
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
		$this->data['fetch_cat'] = \DB::table('tb_categories')->get();
        return view('properties.index', $this->data);
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
            $this->data['row'] = $this->model->getColumnTable('tb_properties');
        }
        $this->data['fields'] = \SiteHelpers::fieldLang($this->info['config']['forms']);

        $this->data['id'] = $id;
        $fetch_cat = \DB::table('tb_categories')->get();
        $parent_cat = array();
        if (!empty($fetch_cat)) {
            foreach ($fetch_cat as $cat) {
                $parent_cat[$cat->id] = $cat;
            }
        }

        $this->data['categories'] = $parent_cat;

        $this->data['amenties'] = \DB::table('tb_amenities')->where('amenity_status', '1')->get();
        $this->data['designers'] = \DB::table('tb_designers')->where('designer_status', '1')->get();

        $row_reservations = \DB::select(\DB::raw("SELECT COUNT(*) AS total_reservations FROM tb_reservations WHERE property_id = '$id' "));
        $row_reserved_rooms = \DB::select(\DB::raw("SELECT COUNT(*) AS total_reserved_rooms FROM td_reserved_rooms LEFT JOIN tb_reservations ON tb_reservations.id = td_reserved_rooms.reservation_id WHERE tb_reservations.property_id = '$id' "));
        $row_turnover = \DB::select(\DB::raw("SELECT SUM(number_of_nights * price) AS total_turnover FROM td_reserved_rooms LEFT JOIN tb_reservations ON tb_reservations.id = td_reserved_rooms.reservation_id WHERE tb_reservations.property_id = '$id' "));
		
		$this->data['total_turnover'] = 0;
		$this->data['total_reservations'] = 0;
		$this->data['total_commissions'] =0;
		$this->data['total_rooms_booked'] =0;
		if ($id != '') {
			$this->data['total_turnover'] = (isset($row_turnover[0]->total_turnover))? $row_turnover[0]->total_turnover : 0;
			$this->data['total_reservations'] = (isset($row_reservations[0]->total_reservations))? $row_reservations[0]->total_reservations : 0;
			$this->data['total_commissions'] = (isset($row_turnover[0]->total_turnover))? ($row_turnover[0]->total_turnover * ($this->data['row']->commission / 100)) : 0;
			$this->data['total_rooms_booked'] = (isset($row_reserved_rooms[0]->total_reserved_rooms))? $row_reserved_rooms[0]->total_reserved_rooms : 0;
		}
        return view('properties.form', $this->data);
    }

    public function getShow($id = null) {

        if ($this->access['is_detail'] == 0)
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');

        $row = $this->model->getRow($id);
        if ($row) {
            $this->data['row'] = $row;
        } else {
            $this->data['row'] = $this->model->getColumnTable('tb_properties');
        }
        $this->data['fields'] = \SiteHelpers::fieldLang($this->info['config']['grid']);

        $this->data['id'] = $id;
        $this->data['access'] = $this->access;
        return view('properties.view', $this->data);
    }

    function postSave(Request $request) {
        $uid = \Auth::user()->id;
        $id = $request->input('id');
        $rules = $this->validateForm();
        $rules['owner_name'] = 'required';
        $rules['owner_last_name'] = 'required';
        $rules['owner_address'] = 'required';
        $rules['owner_city'] = 'required';
        $rules['owner_postal_code'] = 'required';
        $rules['owner_country'] = 'required';
        $rules['owner_phone_primary'] = 'required';
        $rules['owner_email_primary'] = 'required';
        /* if($request->input('owner_contact_person')!='Owner')
          {
          $rules['agent_name'] = 'required';
          $rules['agent_last_name'] = 'required';
          $rules['agent_address'] = 'required';
          $rules['agent_city'] = 'required';
          $rules['agent_postal_code'] = 'required';
          $rules['agent_country'] = 'required';
          $rules['agent_phone_primary'] = 'required';
          $rules['agent_phone_emergency'] = 'required';
          $rules['agent_email_primary'] = 'required';
          $rules['agent_email_secondary'] = 'required';
          $rules['agent_website'] = 'required';
          } */
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $data = $this->validatePost('tb_properties');
            $alias = \SiteHelpers::seoUrl(Input::get('property_short_name'));
            $exha = false;
            for ($f = 1; $exha != true; $f++) {
                if ($request->input('id') == '') {
                    $check_alias = \DB::table('tb_properties')->where('property_slug', $alias)->count();
                } else {
                    $check_alias = \DB::table('tb_properties')->where('property_slug', $alias)->where('id', '!=', $id)->count();
                }
                if ($check_alias > 0) {
                    $alias = $alias . '-' . $f;
                } else {
                    $alias = $alias;
                    $exha = true;
                }
            }
            $data['user_id'] = $uid;
            $data['property_slug'] = $alias;

            if ($request->input('id') == '') {
                $data['created'] = date('Y-m-d h:i:s');
            } else {
                $data['updated'] = date('Y-m-d h:i:s');
            }

            $data['commission'] = $request->input('commission');
            $data['about_property'] = $request->input('about_property');
            $data['property_usp'] = $request->input('property_usp');
            $data['detail_section1_title'] = $request->input('detail_section1_title');
            $data['detail_section1_description_box1'] = $request->input('detail_section1_description_box1');
            $data['detail_section1_description_box2'] = $request->input('detail_section1_description_box2');
            $data['detail_section2_title'] = $request->input('detail_section2_title');
            $data['detail_section2_description_box1'] = $request->input('detail_section2_description_box1');
            $data['detail_section2_description_box2'] = $request->input('detail_section2_description_box2');
            $data['assign_detail_city'] = $request->input('assign_detail_city');

            $data['social_status'] = $request->input('social_status');
            $data['social_facebook'] = $request->input('social_facebook');
            $data['social_twitter'] = $request->input('social_twitter');
            $data['social_google'] = $request->input('social_google');
            $data['social_youtube'] = $request->input('social_youtube');
            $data['social_pinterest'] = $request->input('social_pinterest');
            $data['social_vimeo'] = $request->input('social_vimeo');
            $data['social_instagram'] = $request->input('social_instagram');

            if (!empty($request->input('assigned_amenities'))) {
                $data['assign_amenities'] = implode(',', $request->input('assigned_amenities'));
            } else {
                $data['assign_amenities'] = '';
            }

            if (!is_null($request->input('copy_amenities_rooms'))) {
                $data['copy_amenities_rooms'] = $request->input('copy_amenities_rooms');
            } else {
                $data['copy_amenities_rooms'] = 0;
            }

            if (!is_null($request->input('default_seasons'))) {
                $data['default_seasons'] = $request->input('default_seasons');
            } else {
                $data['default_seasons'] = 0;
            }
			
			if (!is_null($request->input('feature_property'))) {
                $data['feature_property'] = $request->input('feature_property');
            } else {
                $data['feature_property'] = 0;
            }
			
			if (!is_null($request->input('editor_choice_property'))) {
                $data['editor_choice_property'] = $request->input('editor_choice_property');
            } else {
                $data['editor_choice_property'] = 0;
            }

            if (!empty($request->input('destinations'))) {
                $data['property_category_id'] = implode(',', $request->input('destinations'));
            } else {
                $data['property_category_id'] = '';
            }

            $data['owner_name'] = $request->input('owner_name');
            $data['owner_last_name'] = $request->input('owner_last_name');
            $data['owner_address'] = $request->input('owner_address');
            $data['owner_city'] = $request->input('owner_city');
            $data['owner_postal_code'] = $request->input('owner_postal_code');
            $data['owner_country'] = $request->input('owner_country');
            $data['owner_phone_primary'] = $request->input('owner_phone_primary');
            $data['owner_phone_emergency'] = $request->input('owner_phone_emergency');
            $data['owner_email_primary'] = $request->input('owner_email_primary');
            $data['owner_email_secondary'] = $request->input('owner_email_secondary');
            $data['owner_website'] = $request->input('owner_website');
            $data['owner_contact_person'] = $request->input('owner_contact_person');
            /* if($request->input('owner_contact_person')!='Owner')
              {
              $data['agent_name'] = $request->input('agent_name');
              $data['agent_last_name'] = $request->input('agent_last_name');
              $data['agent_address'] = $request->input('agent_address');
              $data['agent_city'] = $request->input('agent_city');
              $data['agent_postal_code'] = $request->input('agent_postal_code');
              $data['agent_country'] = $request->input('agent_country');
              $data['agent_phone_primary'] = $request->input('agent_phone_primary');
              $data['agent_phone_emergency'] = $request->input('agent_phone_emergency');
              $data['agent_email_primary'] = $request->input('agent_email_primary');
              $data['agent_email_secondary'] = $request->input('agent_email_secondary');
              $data['agent_website'] = $request->input('agent_website');
              $data['agent_linked_in'] = $request->input('agent_linked_in');
              } */


            // Yachts info tab
            if ($request->input('property_type') == 'Yachts') {
                $yacht_category = $request->input('yacht_category');
                $data['yacht_category'] = implode(', ', $yacht_category);
                $data['yacht_build_year'] = $request->input('yacht_build_year');
                $data['yachts_guest'] = $request->input('yachts_guest');
                $data['yacht_length'] = $request->input('yacht_length');
                if (!empty($request->input('yacht_builder'))) {
                    $data['yacht_builder'] = implode(',', $request->input('yacht_builder'));
                }
                $data['yacht_beam'] = $request->input('yacht_beam');
                $data['yacht_draft'] = $request->input('yacht_draft');
                $data['yacht_grt'] = $request->input('yacht_grt');
                $data['yacht_cabins'] = $request->input('yacht_cabins');
                $data['yacht_crew'] = $request->input('yacht_crew');
                $data['yacht_for_sale'] = $request->input('yacht_for_sale');
                $data['yacht_for_charter'] = $request->input('yacht_for_charter');
            }

            $destinationPath = public_path() . '/uploads/properties_subtab_imgs/';

            //room & suites tab
            $data['rooms_suites_title'] = $request->input('rooms_suites_title');
            $data['rooms_suites_desciription'] = $request->input('rooms_suites_desciription');
            if ($request->input('rooms_suites_video_type') != '') {
                $data['rooms_suites_video_type'] = $request->input('rooms_suites_video_type');
            }
            if ($request->input('rooms_suites_video_link_type') != '') {
                $data['rooms_suites_video_link_type'] = $request->input('rooms_suites_video_link_type');
            }
            $data['rooms_suites_video_link'] = $request->input('rooms_suites_video_link');
            if (!is_null($request->file('rooms_suites_image'))) {
                $file = $request->file('rooms_suites_image');
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension(); //if you need extension of the file
                $room_suites_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $extension;
                $uploadSuccess = $file->move($destinationPath, $room_suites_filename);
                if ($uploadSuccess) {
                    $data['rooms_suites_image'] = $room_suites_filename;
                }
            }

            if (!is_null($request->file('rooms_suites_video'))) {
                $room_suites_vfile = $request->file('rooms_suites_video');
                $room_suites_vfilename = $room_suites_vfile->getClientOriginalName();
                $room_suites_vextension = $room_suites_vfile->getClientOriginalExtension(); //if you need extension of the file
                $room_suites_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $room_suites_vextension;
                $room_suites_vuploadSuccess = $room_suites_vfile->move($destinationPath, $room_suites_videofilename);
                if ($room_suites_vuploadSuccess) {
                    $data['rooms_suites_video'] = $room_suites_videofilename;
                }
            }
            //room & suites end
            // Architechure 
            $data['architecture_title'] = $request->input('architecture_title');
            $data['architecture_desciription'] = $request->input('architecture_desciription');
            if ($request->input('architecture_video_type') != '') {
                $data['architecture_video_type'] = $request->input('architecture_video_type');
            }
            if ($request->input('architecture_video_link_type') != '') {
                $data['architecture_video_link_type'] = $request->input('architecture_video_link_type');
            }
            $data['architecture_video_link'] = $request->input('architecture_video_link');
            if (!empty($request->input('assigned_architecture_designer'))) {
                $data['assigned_architecture_designer'] = implode(',', $request->input('assigned_architecture_designer'));
            }
            if (!is_null($request->file('architecture_image'))) {
                $architecture_file = $request->file('architecture_image');
                $architecture_filename = $architecture_file->getClientOriginalName();
                $architecture_extension = $architecture_file->getClientOriginalExtension(); //if you need extension of the file
                $architecture_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_extension;
                $architecture_uploadSuccess = $architecture_file->move($destinationPath, $architecture_filename);
                if ($architecture_uploadSuccess) {
                    $data['architecture_image'] = $architecture_filename;
                }
            }

            if (!is_null($request->file('architecture_video'))) {
                $architecture_vfile = $request->file('architecture_video');
                $architecture_vfilename = $architecture_vfile->getClientOriginalName();
                $architecture_vextension = $architecture_vfile->getClientOriginalExtension(); //if you need extension of the file
                $architecture_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_vextension;
                $architecture_vuploadSuccess = $architecture_vfile->move($destinationPath, $architecture_videofilename);
                if ($architecture_vuploadSuccess) {
                    $data['architecture_video'] = $architecture_videofilename;
                }
            }

            // Design 
            $data['architecture_design_title'] = $request->input('architecture_design_title');
            $data['architecture_design_desciription'] = $request->input('architecture_design_desciription');
            $data['architecture_design_url'] = $request->input('architecture_design_url');
            if ($request->input('architecture_design_video_type') != '') {
                $data['architecture_design_video_type'] = $request->input('architecture_design_video_type');
            }
            if ($request->input('architecture_design_video_link_type') != '') {
                $data['architecture_design_video_link_type'] = $request->input('architecture_design_video_link_type');
            }
            $data['architecture_design_video_link'] = $request->input('architecture_design_video_link');
            if (!is_null($request->file('architecture_design_image'))) {
                $architecture_design_file = $request->file('architecture_design_image');
                $architecture_design_filename = $architecture_design_file->getClientOriginalName();
                $architecture_design_extension = $architecture_design_file->getClientOriginalExtension(); //if you need extension of the file
                $architecture_design_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_design_extension;
                $architecture_design_uploadSuccess = $architecture_design_file->move($destinationPath, $architecture_design_filename);
                if ($architecture_design_uploadSuccess) {
                    $data['architecture_design_image'] = $architecture_design_filename;
                }
            }

            if (!is_null($request->file('architecture_design_video'))) {
                $architecture_design_vfile = $request->file('architecture_designer_video');
                $architecture_design_vfilename = $architecture_design_vfile->getClientOriginalName();
                $architecture_design_vextension = $architecture_design_vfile->getClientOriginalExtension(); //if you need extension of the file
                $architecture_design_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_design_vextension;
                $architecture_design_vuploadSuccess = $architecture_design_vfile->move($destinationPath, $architecture_design_videofilename);
                if ($architecture_design_vuploadSuccess) {
                    $data['architecture_design_video'] = $architecture_design_videofilename;
                }
            }

            // Designer
            $data['architecture_designer_title'] = $request->input('architecture_designer_title');
            $data['architecture_designer_desciription'] = $request->input('architecture_designer_desciription');
            $data['architecture_designer_url'] = $request->input('architecture_designer_url');
            if (!empty($request->input('architecture_designer_designer'))) {
                $data['architecture_designer_designer'] = implode(',', $request->input('architecture_designer_designer'));
            }
            if ($request->input('architecture_designer_video_type') != '') {
                $data['architecture_designer_video_type'] = $request->input('architecture_designer_video_type');
            }
            if ($request->input('architecture_designer_video_link_type') != '') {
                $data['architecture_designer_video_link_type'] = $request->input('architecture_designer_video_link_type');
            }
            $data['architecture_designer_video_link'] = $request->input('architecture_designer_video_link');

            if (!is_null($request->file('architecture_designer_image'))) {
                $architecture_designer_file = $request->file('architecture_designer_image');
                $architecture_designer_filename = $architecture_designer_file->getClientOriginalName();
                $architecture_designer_extension = $architecture_designer_file->getClientOriginalExtension(); //if you need extension of the file
                $architecture_designer_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_designer_extension;
                $architecture_designer_uploadSuccess = $architecture_designer_file->move($destinationPath, $architecture_designer_filename);
                if ($architecture_designer_uploadSuccess) {
                    $data['architecture_designer_image'] = $architecture_designer_filename;
                }
            }

            if (!is_null($request->file('architecture_designer_video'))) {
                $architecture_designer_vfile = $request->file('architecture_designer_video');
                $architecture_designer_vfilename = $architecture_designer_vfile->getClientOriginalName();
                $architecture_designer_vextension = $architecture_designer_vfile->getClientOriginalExtension(); //if you need extension of the file
                $architecture_designer_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_designer_vextension;
                $architecture_designer_vuploadSuccess = $architecture_designer_vfile->move($destinationPath, $architecture_designer_videofilename);
                if ($architecture_designer_vuploadSuccess) {
                    $data['architecture_designer_video'] = $architecture_designer_videofilename;
                }
            }

            // Spas
            $data['spa_title'] = $request->input('spa_title');
            $data['spa_desciription'] = $request->input('spa_desciription');
            $data['spa_url'] = $request->input('spa_url');
            $data['spa_usp_text'] = $request->input('spa_usp_text');
            $data['spa_usp_person'] = $request->input('spa_usp_person');
            $data['spa_manager_text'] = $request->input('spa_manager_text');
            $data['spa_opening_hours'] = $request->input('spa_opening_hours');
            $data['spa_phone_number'] = $request->input('spa_phone_number');
            if (!empty($request->input('spa_designer'))) {
                $data['spa_designer'] = implode(',', $request->input('spa_designer'));
            }
            if ($request->input('spa_video_type') != '') {
                $data['spa_video_type'] = $request->input('spa_video_type');
            }
            if ($request->input('spa_video_link_type') != '') {
                $data['spa_video_link_type'] = $request->input('spa_video_link_type');
            }
            $data['spa_video_link'] = $request->input('spa_video_link');
            if (!is_null($request->file('spa_image1'))) {
                $spa_file = $request->file('spa_image1');
                $spa_filename = $spa_file->getClientOriginalName();
                $spa_extension = $spa_file->getClientOriginalExtension(); //if you need extension of the file
                $spa_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $spa_extension;
                $spa_uploadSuccess = $spa_file->move($destinationPath, $spa_filename);
                if ($spa_uploadSuccess) {
                    $data['spa_image1'] = $spa_filename;
                }
            }

            if (!is_null($request->file('spa_image2'))) {
                $spa_file2 = $request->file('spa_image2');
                $spa_filename2 = $spa_file2->getClientOriginalName();
                $spa_extension2 = $spa_file2->getClientOriginalExtension(); //if you need extension of the file
                $spa_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $spa_extension2;
                $spa_uploadSuccess2 = $spa_file2->move($destinationPath, $spa_filename2);
                if ($spa_uploadSuccess2) {
                    $data['spa_image2'] = $spa_filename2;
                }
            }

            if (!is_null($request->file('spa_image3'))) {
                $spa_file3 = $request->file('spa_image3');
                $spa_filename3 = $spa_file3->getClientOriginalName();
                $spa_extension3 = $spa_file3->getClientOriginalExtension(); //if you need extension of the file
                $spa_filename3 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $spa_extension3;
                $spa_uploadSuccess3 = $spa_file3->move($destinationPath, $spa_filename3);
                if ($spa_uploadSuccess3) {
                    $data['spa_image3'] = $spa_filename3;
                }
            }

            if (!is_null($request->file('spa_image4'))) {
                $spa_file4 = $request->file('spa_image4');
                $spa_filename4 = $spa_file4->getClientOriginalName();
                $spa_extension4 = $spa_file4->getClientOriginalExtension(); //if you need extension of the file
                $spa_filename4 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $spa_extension4;
                $spa_uploadSuccess4 = $spa_file4->move($destinationPath, $spa_filename4);
                if ($spa_uploadSuccess4) {
                    $data['spa_image4'] = $spa_filename4;
                }
            }

            if (!is_null($request->file('spa_video'))) {
                $spa_vfile = $request->file('spa_video');
                $spa_vfilename = $spa_vfile->getClientOriginalName();
                $spa_vextension = $spa_vfile->getClientOriginalExtension(); //if you need extension of the file
                $spa_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $spa_vextension;
                $spa_vuploadSuccess = $spa_vfile->move($destinationPath, $spa_videofilename);
                if ($spa_vuploadSuccess) {
                    $data['spa_video'] = $spa_videofilename;
                }
            }

            // Resturants
            $data['restaurant_title'] = $request->input('restaurant_title');
            $data['restaurant_desciription'] = $request->input('restaurant_desciription');
            $data['restaurant_url'] = $request->input('restaurant_url');
            $data['restaurant_usp_text'] = $request->input('restaurant_usp_text');
            $data['restaurant_usp_person'] = $request->input('restaurant_usp_person');
            if (!empty($request->input('restaurant_designer'))) {
                $data['restaurant_designer'] = implode(',', $request->input('restaurant_designer'));
            }
            if ($request->input('restaurant_video_type') != '') {
                $data['restaurant_video_type'] = $request->input('restaurant_video_type');
            }
            if ($request->input('restaurant_video_link_type') != '') {
                $data['restaurant_video_link_type'] = $request->input('restaurant_video_link_type');
            }
            $data['restaurant_video_link'] = $request->input('restaurant_video_link');
            if (!is_null($request->file('restaurant_image'))) {
                $restaurant_file = $request->file('restaurant_image');
                $restaurant_filename = $restaurant_file->getClientOriginalName();
                $restaurant_extension = $restaurant_file->getClientOriginalExtension(); //if you need extension of the file
                $restaurant_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant_extension;
                $restaurant_uploadSuccess = $restaurant_file->move($destinationPath, $restaurant_filename);
                if ($restaurant_uploadSuccess) {
                    $data['restaurant_image'] = $restaurant_filename;
                }
            }

            if (!is_null($request->file('restaurant_image2'))) {
                $restaurant_file2 = $request->file('restaurant_image2');
                $restaurant_filename2 = $restaurant_file2->getClientOriginalName();
                $restaurant_extension2 = $restaurant_file2->getClientOriginalExtension(); //if you need extension of the file
                $restaurant_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant_extension2;
                $restaurant_uploadSuccess2 = $restaurant_file2->move($destinationPath, $restaurant_filename2);
                if ($restaurant_uploadSuccess2) {
                    $data['restaurant_image2'] = $restaurant_filename2;
                }
            }

            if (!is_null($request->file('restaurant_video'))) {
                $restaurant_vfile = $request->file('restaurant_video');
                $restaurant_vfilename = $restaurant_vfile->getClientOriginalName();
                $restaurant_vextension = $restaurant_vfile->getClientOriginalExtension(); //if you need extension of the file
                $restaurant_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant_vextension;
                $restaurant_vuploadSuccess = $restaurant_vfile->move($destinationPath, $restaurant_videofilename);
                if ($restaurant_vuploadSuccess) {
                    $data['restaurant_video'] = $restaurant_videofilename;
                }
            }

            //resturant 2

            $data['restaurant2_title'] = $request->input('restaurant2_title');
            $data['restaurant2_desciription'] = $request->input('restaurant2_desciription');
            $data['restaurant2_url'] = $request->input('restaurant2_url');
            $data['restaurant2_usp_text'] = $request->input('restaurant2_usp_text');
            $data['restaurant2_usp_person'] = $request->input('restaurant2_usp_person');
            if (!empty($request->input('restaurant2_designer'))) {
                $data['restaurant2_designer'] = implode(',', $request->input('restaurant2_designer'));
            }
            if ($request->input('restaurant2_video_type') != '') {
                $data['restaurant2_video_type'] = $request->input('restaurant2_video_type');
            }
            if ($request->input('restaurant2_video_link_type') != '') {
                $data['restaurant2_video_link_type'] = $request->input('restaurant2_video_link_type');
            }
            $data['restaurant2_video_link'] = $request->input('restaurant2_video_link');
            if (!is_null($request->file('restaurant2_image'))) {
                $restaurant2_file = $request->file('restaurant2_image');
                $restaurant2_filename = $restaurant2_file->getClientOriginalName();
                $restaurant2_extension = $restaurant2_file->getClientOriginalExtension(); //if you need extension of the file
                $restaurant2_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant2_extension;
                $restaurant2_uploadSuccess = $restaurant2_file->move($destinationPath, $restaurant2_filename);
                if ($restaurant2_uploadSuccess) {
                    $data['restaurant2_image'] = $restaurant2_filename;
                }
            }

            if (!is_null($request->file('restaurant2_image2'))) {
                $restaurant2_file2 = $request->file('restaurant2_image2');
                $restaurant2_filename2 = $restaurant2_file2->getClientOriginalName();
                $restaurant2_extension2 = $restaurant2_file2->getClientOriginalExtension(); //if you need extension of the file
                $restaurant2_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant2_extension2;
                $restaurant2_uploadSuccess2 = $restaurant2_file2->move($destinationPath, $restaurant2_filename2);
                if ($restaurant2_uploadSuccess2) {
                    $data['restaurant2_image2'] = $restaurant2_filename2;
                }
            }

            if (!is_null($request->file('restaurant2_video'))) {
                $restaurant2_vfile = $request->file('restaurant2_video');
                $restaurant2_vfilename = $restaurant2_vfile->getClientOriginalName();
                $restaurant2_vextension = $restaurant2_vfile->getClientOriginalExtension(); //if you need extension of the file
                $restaurant2_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant2_vextension;
                $restaurant2_vuploadSuccess = $restaurant2_vfile->move($destinationPath, $restaurant2_videofilename);
                if ($restaurant2_vuploadSuccess) {
                    $data['restaurant2_video'] = $restaurant2_videofilename;
                }
            }

            // bar
            $data['bar_title'] = $request->input('bar_title');
            $data['bar_sub_title'] = $request->input('bar_sub_title');
            $data['bar_desciription'] = $request->input('bar_desciription');
            $data['bar_url'] = $request->input('bar_url');
            $data['bar_usp_text'] = $request->input('bar_usp_text');
            $data['bar_usp_person'] = $request->input('bar_usp_person');
            if (!empty($request->input('bar_designer'))) {
                $data['bar_designer'] = implode(',', $request->input('bar_designer'));
            }
            if ($request->input('bar_video_type') != '') {
                $data['bar_video_type'] = $request->input('bar_video_type');
            }
            if ($request->input('bar_video_link_type') != '') {
                $data['bar_video_link_type'] = $request->input('bar_video_link_type');
            }
            $data['bar_video_link'] = $request->input('bar_video_link');
            if (!is_null($request->file('bar_image'))) {
                $bar_file = $request->file('bar_image');
                $bar_filename = $bar_file->getClientOriginalName();
                $bar_extension = $bar_file->getClientOriginalExtension(); //if you need extension of the file
                $bar_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar_extension;
                $bar_uploadSuccess = $bar_file->move($destinationPath, $bar_filename);
                if ($bar_uploadSuccess) {
                    $data['bar_image'] = $bar_filename;
                }
            }

            if (!is_null($request->file('bar_image2'))) {
                $bar_file2 = $request->file('bar_image2');
                $bar_filename2 = $bar_file2->getClientOriginalName();
                $bar_extension2 = $bar_file2->getClientOriginalExtension(); //if you need extension of the file
                $bar_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar_extension2;
                $bar_uploadSuccess2 = $bar_file2->move($destinationPath, $bar_filename2);
                if ($bar_uploadSuccess2) {
                    $data['bar_image2'] = $bar_filename2;
                }
            }

            if (!is_null($request->file('bar_image3'))) {
                $bar_file3 = $request->file('bar_image3');
                $bar_filename3 = $bar_file3->getClientOriginalName();
                $bar_extension3 = $bar_file3->getClientOriginalExtension(); //if you need extension of the file
                $bar_filename3 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar_extension3;
                $bar_uploadSuccess3 = $bar_file3->move($destinationPath, $bar_filename3);
                if ($bar_uploadSuccess3) {
                    $data['bar_image3'] = $bar_filename3;
                }
            }

            if (!is_null($request->file('bar_video'))) {
                $bar_vfile = $request->file('bar_video');
                $bar_vfilename = $bar_vfile->getClientOriginalName();
                $bar_vextension = $bar_vfile->getClientOriginalExtension(); //if you need extension of the file
                $bar_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar_vextension;
                $bar_vuploadSuccess = $bar_vfile->move($destinationPath, $bar_videofilename);
                if ($bar_vuploadSuccess) {
                    $data['bar_video'] = $bar_videofilename;
                }
            }

            // Video section
            $data['video_title'] = $request->input('video_title');
            $data['video_desciription'] = $request->input('video_desciription');
            $data['video_sub_title'] = $request->input('video_sub_title');
            if ($request->input('video_type') != '') {
                $data['video_type'] = $request->input('video_type');
            }
            if ($request->input('video_link_type') != '') {
                $data['video_link_type'] = $request->input('video_link_type');
            }
            $data['video_link'] = $request->input('video_link');
            if (!is_null($request->file('video_image'))) {
                $video_file = $request->file('video_image');
                $video_filename = $video_file->getClientOriginalName();
                $video_extension = $video_file->getClientOriginalExtension(); //if you need extension of the file
                $video_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $video_extension;
                $video_uploadSuccess = $video_file->move($destinationPath, $video_filename);
                if ($video_uploadSuccess) {
                    $data['video_image'] = $video_filename;
                }
            }

            if (!is_null($request->file('video_video'))) {
                $video_vfile = $request->file('video_video');
                $video_vfilename = $video_vfile->getClientOriginalName();
                $video_vextension = $video_vfile->getClientOriginalExtension(); //if you need extension of the file
                $video_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $video_vextension;
                $video_vuploadSuccess = $video_vfile->move($destinationPath, $video_videofilename);
                if ($video_vuploadSuccess) {
                    $data['video_video'] = $video_videofilename;
                }
            }

            $id = $this->model->insertRow($data, $request->input('id'));

            if (!is_null($request->input('copy_amenities_rooms')) && !empty($request->input('assigned_amenities'))) {
                $check_pcats = \DB::table('tb_properties_category_types')->where('property_id', $id)->get();
                if (!empty($check_pcats)) {
                    foreach ($check_pcats as $pcats) {
                        $check_pcats_exist = \DB::table('tb_properties_category_amenities')->where('property_id', $id)->where('cat_id', $pcats->id)->first();
                        $Amdata['property_id'] = $id;
                        $Amdata['cat_id'] = $pcats->id;
                        $Amdata['user_id'] = $uid;
                        $Amdata['amenity_ids'] = implode(',', $request->input('assigned_amenities'));
                        if (!empty($check_pcats_exist)) {
                            $Amdata['updated'] = date('Y-m-d h:i:s');
                            \DB::table('tb_properties_category_amenities')->where('id', $check_pcats_exist->id)->update($Amdata);
                        } else {
                            $Amdata['created'] = date('Y-m-d h:i:s');
                            \DB::table('tb_properties_category_amenities')->insertGetId($Amdata);
                        }
                    }
                }
            }


            if (!is_null($request->input('apply'))) {
                $return = 'properties/update/' . $id . '?return=' . self::returnUrl();
            } else {
                $return = 'properties?return=' . self::returnUrl();
            }

            // Insert logs into database
            if ($request->input('id') == '') {
                \SiteHelpers::auditTrail($request, 'New Data with ID ' . $id . ' Has been Inserted !');
            } else {
                \SiteHelpers::auditTrail($request, 'Data with ID ' . $id . ' Has been Updated !');
            }

            return Redirect::to($return)->with('messagetext', \Lang::get('core.note_success'))->with('msgstatus', 'success');
        } else {

            return Redirect::to('properties/update/' . $id)->with('messagetext', \Lang::get('core.note_error'))->with('msgstatus', 'error')
                            ->withErrors($validator)->withInput();
        }
    }

    public function postDelete(Request $request) {

        if ($this->access['is_remove'] == 0)
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');
        // delete multipe rows 
        if (count($request->input('ids')) >= 1) {
            $selids = $request->input('ids');
            $checkDir = \DB::table('tb_container')->where('name', 'locations')->first();
            foreach ($selids as $sids) {
                $checkProp = \DB::table('tb_properties')->where('id', $sids)->first();
                if (!empty($checkProp)) {
                    $foldName = trim($checkProp->property_name);
                    if ($foldName != "") {
                        $slug = \SiteHelpers::seoUrl(trim($foldName));
                        $checkPropFold = \DB::table('tb_container')->where('name', $slug)->where('parent_id', $checkDir->id)->first();
                        if (!empty($checkPropFold)) {
                            $childs = (new ContainerController)->fetchFolderChildListIds($checkPropFold->id);
                            $dirPath = (new ContainerController)->getContainerUserPath($checkPropFold->id);
                            if (is_dir($dirPath) === true) {
                                array_unshift($childs, $checkPropFold->id);
                                $deleteEfile = (new ContainerController)->delete_allextra_files($childs, 'folder');

                                File::deleteDirectory($dirPath);
                                \DB::table('tb_container')->whereIn('id', $childs)->delete();
                                \DB::table('tb_container_files')->whereIn('folder_id', $childs)->delete();
                            }
                        }
                    }
                }

                $checkType = \DB::table('tb_properties_category_types')->where('property_id', $sids)->count();
                if ($checkType > 0) {
                    \DB::table('tb_properties_category_types')->where('property_id', $sids)->delete();
                }
                $checkRooms = \DB::table('tb_properties_category_rooms')->where('property_id', $sids)->count();
                if ($checkRooms > 0) {
                    \DB::table('tb_properties_category_rooms')->where('property_id', $sids)->delete();
                }
                $checkRoomsprice = \DB::table('tb_properties_category_rooms_price')->where('property_id', $sids)->count();
                if ($checkRoomsprice > 0) {
                    \DB::table('tb_properties_category_rooms_price')->where('property_id', $sids)->delete();
                }
                $checkimages = \DB::table('tb_properties_images')->where('property_id', $sids)->count();
                if ($checkimages > 0) {
                    \DB::table('tb_properties_images')->where('property_id', $sids)->delete();
                }
                $checkamenties = \DB::table('tb_properties_category_amenities')->where('property_id', $sids)->count();
                if ($checkamenties > 0) {
                    \DB::table('tb_properties_category_amenities')->where('property_id', $sids)->delete();
                }
            }
            $this->model->destroy($request->input('ids'));

            \SiteHelpers::auditTrail($request, "ID : " . implode(",", $request->input('ids')) . "  , Has Been Removed Successfull");
            // redirect
            return Redirect::to('properties')
                            ->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus', 'success');
        } else {
            return Redirect::to('properties')
                            ->with('messagetext', 'No Item Deleted')->with('msgstatus', 'error');
        }
    }

    public function show_settings($property_id, $active, Request $request) {
        $this->data['active'] = $active;
        $this->data['pid'] = $property_id;
        $this->data['property_data'] = \DB::table('tb_properties')->where('id', $property_id)->first();
        $tabs = \DB::table('tb_properties_config_tabs')->where('tab_status', 1)->orderBy('id', 'asc')->get();
        if (!empty($tabs)) {
            foreach ($tabs as $tab) {
                $tabdata[$tab->tab_slug] = $tab;
            }
        }
        $this->data['tabss'] = $tabdata;
        if ($active == 'types') {
            $this->data['cat_types'] = $this->find_categories($property_id);
            return view('properties.settings_cats', $this->data);
        } elseif ($active == 'rooms') {
            $this->data['cat_types'] = $this->find_categories_room($property_id);
            $this->data['amenties'] = \DB::table('tb_amenities')->where('amenity_status', '1')->get();
            $this->data['room_amenties_desc'] = array();
            $room_amenties_desc = \DB::table('tb_properties_category_types')->select('id', 'room_desc')->where('property_id', $property_id)->get();
            if (!empty($room_amenties_desc)) {
                foreach ($room_amenties_desc as $roomdesc) {
                    $rooms_desc[$roomdesc->id] = $roomdesc->room_desc;
                }
                $this->data['room_amenties_desc'] = $rooms_desc;
            }
            return view('properties.settings_rooms', $this->data);
        } elseif ($active == 'price') {
            $seasonArr = array();
            if ($this->data['property_data']->default_seasons != 1) {
                $checkseason = \DB::table('tb_seasons')->where('property_id', $property_id)->orderBy('season_priority', 'asc')->get();
            } else {
                $checkseason = \DB::table('tb_seasons')->where('property_id', 0)->orderBy('season_priority', 'asc')->get();
            }

            $this->data['Seasons'] = $checkseason;
            $this->data['room_prices'] = $this->find_categories_room_price($property_id);
            //print "<pre>"; print_r($this->data['room_prices']);
            return view('properties.settings_price', $this->data);
        } elseif ($active == 'property_images') {
            $this->data['imgs'] = $this->get_property_files($property_id, 'Property Images');
            $this->data['slider_imgs'] = $this->get_property_files($property_id, 'Property Slider Images');
            return view('properties.settings_property_images', $this->data);
        } elseif ($active == 'property_documents') {
            $this->data['hotel_broch'] = $this->get_property_files($property_id, 'Hotel Brochure');
	    $this->data['restru_menu'] = $this->get_property_files($property_id, 'Restaurant Menu');
	    $this->data['spa_broch'] = $this->get_property_files($property_id, 'Spa Brochure');
		$this->data['hotelcontacts'] = $this->get_property_files($property_id, 'Hotel Contracts');
            return view('properties.settings_property_documents', $this->data);
        } elseif ($active == 'gallery_images') {
            $this->data['spaimgs'] = $this->get_property_files($property_id, 'Spa Gallery Images');
            $this->data['resturan_imgs'] = $this->get_property_files($property_id, 'Restrurants Gallery Images');
            $this->data['bar_imgs'] = $this->get_property_files($property_id, 'Bar Gallery Images');
            return view('properties.settings_gallery_images', $this->data);
        } elseif ($active == 'calendar') {
            $this->data['cat_types'] = $this->find_categories_room($property_id);
            return view('properties.settings_calendar', $this->data);
        } elseif ($active == 'terms_and_conditions') {
            if (!is_null($request->input('terms_n_conditions'))) {
                $row = \DB::table('td_property_terms_n_conditions')->where('property_id', $property_id)->first();
                if (!empty($row)) {
                    \DB::table('td_property_terms_n_conditions')->where('term_id', $row->term_id)->update(array('terms_n_conditions' => $request->input('terms_n_conditions')));
                } else {
                    \DB::table('td_property_terms_n_conditions')->insertGetId(array('property_id' => $property_id, 'terms_n_conditions' => $request->input('terms_n_conditions')));
                }
            }
            $this->data['row'] = \DB::table('td_property_terms_n_conditions')->where('property_id', $property_id)->first();
            return view('properties.settings_terms_and_conditions', $this->data);
        }
        if ($active == 'seasons') {
            $seasonArr = array();
            $checkseason = \DB::table('tb_seasons')->where('property_id', $property_id)->get();
            if (!empty($checkseason)) {
                $s = 0;
                foreach ($checkseason as $season) {
                    $seasonArr[$s] = $season;
                    $checkseasondates = \DB::table('tb_seasons_dates')->where('season_id', $season->id)->get();
                    if (!empty($checkseasondates)) {
                        $seasonArr[$s]->dates = $checkseasondates;
                    }
                    $s++;
                }
            }
            $this->data['Seasons'] = $seasonArr;
            return view('properties.settings_seasons', $this->data);
        }
    }

    function get_property_files($property_id, $filetype) {
        $fileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*',  \DB::raw("(CASE WHEN (tb_container_files.file_display_name = '') THEN tb_container_files.file_name ELSE tb_container_files.file_display_name END) as file_name"), 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $property_id)->where('tb_properties_images.type', $filetype)->get();
        $filen = array();
        if (!empty($fileArr)) {
            $f = 0;
            foreach ($fileArr as $file) {
                $filen[$f] = $file;
                $filen[$f]->imgsrc = (new ContainerController)->getThumbpath($file->folder_id);
                $f++;
            }
        }
        return $filen;
    }

    function find_categories($property_id) {
        $cat_types = \DB::table('tb_properties_category_types')->where('property_id', $property_id)->where('status', 0)->get();
        return $cat_types;
    }

    function find_categories_room($property_id) {
        $cats = array();
        $cat_types = \DB::table('tb_properties_category_types')->where('property_id', $property_id)->where('status', 0)->get();
        if (!empty($cat_types)) {
            $c = 0;
            foreach ($cat_types as $type) {
                $cats[$c]['data'] = $type;
                $cat_rooms = \DB::table('tb_properties_category_rooms')->where('property_id', $property_id)->where('category_id', $type->id)->get();
                if (!empty($cat_rooms)) {
                    foreach ($cat_rooms as $room) {
                        $cats[$c]['rooms'][] = $room;
                    }
                }
                $fileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $property_id)->where('tb_properties_images.category_id', $type->id)->where('tb_properties_images.type', 'Rooms Images')->get();
                $filen = array();
                if (!empty($fileArr)) {
                    $f = 0;
                    foreach ($fileArr as $file) {
                        $cats[$c]['imgs'][$f] = $file;
                        $cats[$c]['imgs'][$f]->imgsrc = (new ContainerController)->getThumbpath($file->folder_id);
                        $f++;
                    }
                }

                $cat_amenty = \DB::table('tb_properties_category_amenities')->where('property_id', $property_id)->where('cat_id', $type->id)->first();
                if (!empty($cat_amenty)) {
                    $cats[$c]['amenty'] = $cat_amenty;
                }

                $cat_amenty = \DB::table('tb_properties_category_amenities')->where('property_id', $property_id)->where('cat_id', $type->id)->first();
                if (!empty($cat_amenty)) {
                    $cats[$c]['amenties'] = $cat_amenty->amenity_ids;
                }
                $c++;
            }
        }

        return $cats;
    }

    function find_categories_room_price($property_id) {
        $cats = array();
        $cat_types = \DB::table('tb_properties_category_types')->where('property_id', $property_id)->where('status', 0)->get();
        if (!empty($cat_types)) {
            $c = 0;
            foreach ($cat_types as $type) {
                $cats[$c]['data'] = $type;
                $cat_rooms_price = \DB::table('tb_properties_category_rooms_price')->where('property_id', $property_id)->where('category_id', $type->id)->get();
                if (!empty($cat_rooms_price)) {
                    foreach ($cat_rooms_price as $room_price) {
                        $cats[$c]['rooms_price'][$room_price->season_id] = $room_price;
                    }
                }
                $c++;
            }
        }

        return $cats;
    }

    // category

    function save_property_type_data(Request $request) {
        $uid = \Auth::user()->id;
        $rules['cat_name'] = 'required';
        $rules['cat_short_name'] = 'required';
        $rules['guests_base_price'] = 'required|numeric';
        $rules['guests_total'] = 'required|numeric';
        $rules['guests_adult'] = 'required|numeric';
        $rules['guests_junior'] = 'required|numeric';
        $rules['guests_babies'] = 'required|numeric';
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $data['property_id'] = $request->input('property_id');
            $data['user_id'] = $uid;
            $data['category_name'] = $request->input('cat_name');
            $data['cat_short_name'] = $request->input('cat_short_name');
            $data['guests_in_base_price'] = $request->input('guests_base_price');
            $data['minimum_stay'] = $request->input('min_stay');
            $data['total_guests'] = $request->input('guests_total');
            $data['guests_adults'] = $request->input('guests_adult');
            $data['guests_juniors'] = $request->input('guests_junior');
            $data['guests_babies'] = $request->input('guests_babies');
            if (!is_null($request->input('count_baby'))) {
                $data['baby_count'] = $request->input('count_baby');
            } else {
                $data['baby_count'] = 0;
            }

            if (!is_null($request->input('show_booking'))) {
                $data['show_on_booking'] = $request->input('show_booking');
            } else {
                $data['show_on_booking'] = 0;
            }

            if ($request->input('edit_type_id') == '') {
                $data['created'] = date('Y-m-d h:i:s');
                $instype = 'add';
                $id = \DB::table('tb_properties_category_types')->insertGetId($data);
            } else {
                $data['updated'] = date('Y-m-d h:i:s');
                $instype = 'update';
                $id = \DB::table('tb_properties_category_types')->where('id', $request->input('edit_type_id'))->update($data);
            }

            $typdata = array();
            $checkType = \DB::table('tb_properties_category_types')->where('id', $id)->where('status', 0)->first();
            if (!empty($checkType)) {
                $typdata = $checkType;
            }

            $res['status'] = 'success';
            $res['category'] = $typdata;
            $res['type'] = $instype;
            return json_encode($res);
        } else {

            $res['status'] = 'error';
            $res['errors'] = $validator->errors()->all();
            return json_encode($res);
        }
    }

    function delete_property_type(Request $request) {
        $uid = \Auth::user()->id;
        $catId = $request->input('cat_id');
        $checkType = \DB::table('tb_properties_category_types')->where('id', $catId)->where('status', 0)->count();
        if ($checkType > 0) {
            \DB::table('tb_properties_category_types')->where('id', $catId)->delete();

            $checkRooms = \DB::table('tb_properties_category_rooms')->where('category_id', $catId)->count();
            if ($checkRooms > 0) {
                \DB::table('tb_properties_category_rooms')->where('category_id', $catId)->delete();
            }
            $checkRoomsprice = \DB::table('tb_properties_category_rooms_price')->where('category_id', $catId)->count();
            if ($checkRoomsprice > 0) {
                \DB::table('tb_properties_category_rooms_price')->where('category_id', $catId)->delete();
            }
            $checkimages = \DB::table('tb_properties_images')->where('category_id', $catId)->where('type', 'Rooms Images')->get();
            if (!empty($checkimages)) {
                foreach ($checkimages as $cimg) {
                    $deleteEfile = (new ContainerController)->delete_allextra_files($cimg->file_id, 'file');
                    $deleteFile = \DB::table('tb_container_files')->where('id', $cimg->file_id)->delete();
                    \DB::table('tb_properties_images')->where('category_id', $catId)->where('type', 'Rooms Images')->delete();
                }
            }
            $checkamenties = \DB::table('tb_properties_category_amenities')->where('cat_id', $catId)->count();
            if ($checkamenties > 0) {
                \DB::table('tb_properties_category_amenities')->where('cat_id', $catId)->delete();
            }

            $res['status'] = 'success';
            return json_encode($res);
        } else {
            $res['status'] = 'error';
            return json_encode($res);
        }
    }

    //rooms

    function save_property_rooms_data(Request $request) {
        $uid = \Auth::user()->id;
        $rules['room_name'] = 'required';
        $rules['room_active_from'] = 'required';
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $data['property_id'] = $request->input('property_id');
            $data['category_id'] = $request->input('category_id');
            $data['user_id'] = $uid;
            $data['room_name'] = $request->input('room_name');
            if (!is_null($request->input('room_active_full'))) {
                $data['active_full_year'] = $request->input('room_active_full');
                $data['room_active_from'] = date('Y-m-d');
                $data['room_active_to'] = date('Y') . '-12-31';
            } else {
                $data['active_full_year'] = 0;
                $data['room_active_from'] = $request->input('room_active_from');
                $data['room_active_to'] = $request->input('room_active_to');
            }
            if ($request->input('edit_room_id') == '') {
                $data['created'] = date('Y-m-d h:i:s');
                $instype = 'add';
                $id = \DB::table('tb_properties_category_rooms')->insertGetId($data);
            } else {
                $data['updated'] = date('Y-m-d h:i:s');
                $instype = 'update';
                $id = \DB::table('tb_properties_category_rooms')->where('id', $request->input('edit_room_id'))->update($data);
            }

            $romdata = array();
            $checkRoom = \DB::table('tb_properties_category_rooms')->where('id', $id)->first();
            if (!empty($checkRoom)) {
                $romdata = $checkRoom;
            }

            $res['status'] = 'success';
            $res['room'] = $romdata;
            $res['type'] = $instype;
            return json_encode($res);
        } else {

            $res['status'] = 'error';
            $res['errors'] = $validator->errors()->all();
            return json_encode($res);
        }
    }

    function delete_property_room(Request $request) {
        $uid = \Auth::user()->id;
        $roomId = $request->input('room_id');
        $checkRoom = \DB::table('tb_properties_category_rooms')->where('id', $roomId)->count();
        if ($checkRoom > 0) {
            $ups = \DB::table('tb_properties_category_rooms')->where('id', $roomId)->delete();

            $res['status'] = 'success';
            return json_encode($res);
        } else {
            $res['status'] = 'error';
            return json_encode($res);
        }
    }

    function copy_category_rooms(Request $request) {
        $uid = \Auth::user()->id;
        $roomId = $request->input('roomID');
        $retUrl = $request->input('curnurl');
        $nums = $request->input('copy_num');
        $checkRoom = \DB::table('tb_properties_category_rooms')->where('id', $roomId)->first();
        if (!empty($checkRoom)) {
            $rname = $checkRoom->room_name;
            for ($c = 0; $c < $nums; $c++) {
                $cdata = array();
                $cdata['property_id'] = $checkRoom->property_id;
                $cdata['category_id'] = $checkRoom->category_id;
                $cdata['user_id'] = $uid;
                $newname = substr($rname, -1) + 1;
                $rname = substr($rname, 0, -1) . $newname;
                $cdata['room_name'] = $rname;
                $cdata['active_full_year'] = $checkRoom->active_full_year;
                $cdata['room_active_from'] = $checkRoom->room_active_from;
                $cdata['room_active_to'] = $checkRoom->room_active_to;
                $cdata['created'] = date('Y-m-d h:i:s');
                $id = \DB::table('tb_properties_category_rooms')->insertGetId($cdata);
            }
            return Redirect::to($retUrl)
                            ->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus', 'success');
        } else {
            return Redirect::to($retUrl)
                            ->with('messagetext', 'No Room Found')->with('msgstatus', 'error');
        }
    }

    function property_images_uploads(Request $request) {
        $checkProp = \DB::table('tb_properties')->select('property_name')->where('id', $request->input('propId'))->first();
        if (!empty($checkProp)) {
            $checkDir = \DB::table('tb_container')->select('id')->where('name', 'locations')->first();
            if (!empty($checkDir)) {
                $foldVal = trim($checkProp->property_name);
                if ($foldVal != "") {
                    $foldName = trim($foldVal);
                    $slug = \SiteHelpers::seoUrl(trim($foldName));
                    $dirPath = (new ContainerController)->getContainerUserPath($checkDir->id);

                    $checkPropFold = \DB::table('tb_container')->select('id')->where('name', $slug)->where('parent_id', $checkDir->id)->first();
                    if (!empty($checkPropFold)) {
                        $propFoldId = $checkPropFold->id;
                    } else {
                        $newPropFolder = $this->createNewFolder($foldName, $checkDir->id);
                        if ($newPropFolder !== false) {
                            $propFoldId = $newPropFolder;
                        }
                    }

                    $imgFold = $request->input('uploadType');
                    $PropImgfoldName = trim($imgFold);
                    $PropImgslug = \SiteHelpers::seoUrl(trim($PropImgfoldName));
                    $checkPropImgFold = \DB::table('tb_container')->select('id')->where('name', $PropImgslug)->where('parent_id', $propFoldId)->first();
                    if (!empty($checkPropImgFold)) {
                        $newpropImgFoldId = $checkPropImgFold->id;
                    } else {
                        $newPropImgFolder = $this->createNewFolder($PropImgfoldName, $propFoldId);
                        if ($newPropImgFolder !== false) {
                            $newpropImgFoldId = $newPropImgFolder;
                        }
                    }

                    if ($imgFold == 'Rooms Images') {
                        $cat_id = $request->input('category_id');
                        $getcat = \DB::table('tb_properties_category_types')->select('category_name')->where('id', $cat_id)->where('status', 0)->first();
                        if (!empty($getcat)) {
                            $catFold = $getcat->category_name;
                            $CatfoldName = trim($catFold);
                            $Catslug = \SiteHelpers::seoUrl(trim($CatfoldName));
                            $checkCatFold = \DB::table('tb_container')->select('id')->where('name', $Catslug)->where('parent_id', $newpropImgFoldId)->first();
                            if (!empty($checkCatFold)) {
                                $CatFoldId = $checkCatFold->id;
                            } else {
                                $newCatFolder = $this->createNewFolder($CatfoldName, $newpropImgFoldId);
                                if ($newCatFolder !== false) {
                                    $CatFoldId = $newCatFolder;
                                }
                            }
                            $propImgFoldId = $CatFoldId;
                        } else {
                            $propImgFoldId = $newpropImgFoldId;
                        }
                    } else {
                        $propImgFoldId = $newpropImgFoldId;
                    }
                    // SET UPLOAD PATH
                    $destinationPath = (new ContainerController)->getContainerUserPath($propImgFoldId);
                    $file = $request->file('files');
                    // GET THE FILE EXTENSION
                    $extension = $file[0]->getClientOriginalExtension();
                    // RENAME THE UPLOAD WITH RANDOM NUMBER
                    $fileName = rand(11111111111, 99999999999) . '-' .rand(11111111111, 99999999999) . '.' . $extension;
                    $fileNamedis = $file[0]->getClientOriginalName();
                    $ftname = explode('.', $fileName);
                    $exha = false;

                    for ($f = 1; $exha != true; $f++) {
                        if (\File::exists($destinationPath . $fileName)) {
                            $fileName = $ftname[0] . '(' . $f . ').' . $extension;
                        } else {
                            $fileName = $fileName;
                            $exha = true;
                        }
                    }
                    // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
                    $upload_success = $file[0]->move($destinationPath, $fileName);
                    $ftype = $file[0]->getClientMimeType();
                    $exFtype = explode('/', $ftype);
                    if ($exFtype[0] == "image") {
                        // open an image file
                        $thimg = \Image::make($destinationPath . $fileName);
                        // now you are able to resize the instance
                        $thimg->resize(128, 130);
                        // finally we save the image as a new file
                        $thumbfile = 'thumb_' . $propImgFoldId . '_' . $fileName;
                        $thimg->save(public_path() . '/uploads/thumbs/' . $thumbfile);

                        // open an image file
                        $mdimg = \Image::make($destinationPath . $fileName);
                        // now you are able to resize the instance
                        $thactualsize = getimagesize($destinationPath . $fileName);
                        if ($thactualsize[0] > $thactualsize[1]) {
                            $mdimg->resize(320, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                        } else {
                            $mdimg->resize(null, 320, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                        }
                        // finally we save the image as a new file
                        $thumbfile = 'format_' . $propImgFoldId . '_' . $fileName;
                        $mdimg->save(public_path() . '/uploads/thumbs/' . $thumbfile);

                        // open an image file
                        $mdimg = \Image::make($destinationPath . $fileName);
                        // now you are able to resize the instance
                        $hfactualsize = getimagesize($destinationPath . $fileName);
                        if ($hfactualsize[0] > $hfactualsize[1]) {
                            $mdimg->resize(1000, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                        } else {
                            $mdimg->resize(null, 1000, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                        }
                        // finally we save the image as a new file
                        $thumbfile = 'highflip_' . $propImgFoldId . '_' . $fileName;
                        $mdimg->save(public_path() . '/uploads/thumbs/' . $thumbfile);

                        // open an image file
                        $pthimg = \Image::make($destinationPath . $fileName);
                        // now you are able to resize the instance
                        $pthimg->resize(80, 80);
                        // finally we save the image as a new file
                        $pthumbfile = $fileName;
                        $pthimg->save(public_path() . '/uploads/property_imgs_thumbs/' . $pthumbfile);

                        $fpimg = \Image::make($destinationPath . $fileName);
                        $thactualsize = getimagesize($destinationPath . $fileName);
                        if ($thactualsize[0] > $thactualsize[1]) {
                            $fpimg->resize(425, 283);
                        } else {
                            $fpimg->resize(212, 283);
                        }
                        $thumbfile = 'front_property_' . $propImgFoldId . '_' . $fileName;
                        $fpimg->save(public_path() . '/uploads/property_imgs_thumbs/' . $thumbfile);

                        // Set main image if uploaded file is first in folder
                        $countfile = \DB::table('tb_container_files')->where('folder_id', $propImgFoldId)->where(function ($query) {
                                    $query->where('file_type', 'image/jpeg')->orWhere('file_type', 'image/png')->orWhere('file_type', 'image/gif');
                                })->count();
                        if ($countfile == 0) {
                            $copytofolder = public_path() . '/uploads/folder_cover_imgs/';
                            // image for backend
                            $bkimg = \Image::make($destinationPath . $fileName);
                            $bkimg->resize(128, 130);
                            $bkimgfile = 'thumb_' . $fileName;
                            $bkimg->save($copytofolder . $bkimgfile);

                            // open an image file
                            $mdimg = \Image::make($destinationPath . $fileName);
                            $thactualsize = getimagesize($destinationPath . $fileName);
                            if ($thactualsize[0] > $thactualsize[1]) {
                                $mdimg->resize(320, null, function ($constraint) {
                                    $constraint->aspectRatio();
                                });
                            } else {
                                $mdimg->resize(null, 320, function ($constraint) {
                                    $constraint->aspectRatio();
                                });
                            }
                            $thumbfile = 'format_' . $fileName;
                            $mdimg->save($copytofolder . $thumbfile);

                            $cmdata['temp_cover_img'] = $fileName;
                            $cmdata['temp_cover_img_masonry'] = $fileName;
                            $cmdata['updated'] = date('y-m-d');
                            \DB::table('tb_container')->where('id', $propImgFoldId)->update($cmdata);
                        }
                    }

                    $data['folder_id'] = $propImgFoldId;
                    $data['file_name'] = $fileName;
					$data['file_display_name'] = $fileNamedis;
                    $data['file_type'] = $file[0]->getClientMimeType();
                    $data['file_size'] = $file[0]->getClientSize();
                    $data['user_id'] = \Auth::user()->id;
                    $data['created'] = date('y-m-d h:i:s');
                    $data['path'] = $destinationPath;
                    $fileID = \DB::table('tb_container_files')->insertGetId($data);

                    $imgdata['property_id'] = $request->input('propId');
                    $imgdata['type'] = $imgFold;
                    $imgdata['file_id'] = $fileID;
                    if ($imgFold == 'Rooms Images') {
                        $imgdata['category_id'] = $request->input('category_id');
                    }
                    $imgdata['user_id'] = \Auth::user()->id;
                    $imgdata['created'] = date('y-m-d h:i:s');
                    $imgID = \DB::table('tb_properties_images')->insertGetId($imgdata);

                    $getupfile = \DB::table('tb_container_files')->where('id', $fileID)->first();
                    if (!empty($getupfile)) {
                        $getfilejson['files'][0]['id'] = $imgID;
                        $getfilejson['files'][0]['name'] = ($getupfile->file_display_name!='') ? $getupfile->file_display_name : $getupfile->file_name;
                        $getfilejson['files'][0]['size'] = $getupfile->file_size;
                        if ($getupfile->file_type == "application/pdf") {
                            $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/images/bigpage_white_acrobat.png');
                        } elseif ($getupfile->file_type == "application/vnd.openxmlformats-officedocument.word") {
                            $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/images/doc.png');
                        } elseif ($getupfile->file_type == "application/vnd.openxmlformats-officedocument.spre") {
                            $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/images/xls.png');
                        } else {
                            $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/property_imgs_thumbs/' . $getupfile->file_name);
                        }
                        $getfilejson['files'][0]['type'] = $getupfile->file_type;
                        $getfilejson['files'][0]['url'] = (new ContainerController)->getThumbpath($getupfile->folder_id) . $getupfile->file_name;
                    }
                    return json_encode($getfilejson);
                }
            }
        }
    }

    function createNewFolder($Foldername, $ParentfolderId) {
        if ($Foldername != '') {
            $dirPath = (new ContainerController)->getContainerUserPath($ParentfolderId);
            $slug = \SiteHelpers::seoUrl(trim($Foldername));
            $result = \File::makeDirectory($dirPath . $slug, 0777, true);
            $fdata['parent_id'] = $ParentfolderId;
            $fdata['name'] = $slug;
            $fdata['display_name'] = $Foldername;
            $fdata['file_type'] = 'folder';
            $fdata['user_id'] = \Auth::user()->id;
            $fdata['created'] = date('y-m-d h:i:s');
            $fID = \DB::table('tb_container')->insertGetId($fdata);
            return $fID;
        } else {
            return false;
        }
    }

    function delete_property_image(Request $request) {
        $uid = \Auth::user()->id;
        $img_id = $request->input('img_id');
        $checkImg = \DB::table('tb_properties_images')->where('id', $img_id)->first();
        if (!empty($checkImg)) {
            $deleteEfile = (new ContainerController)->delete_allextra_files($checkImg->file_id, 'file');
            $deleteFile = \DB::table('tb_container_files')->where('id', $checkImg->file_id)->delete();
            $deleteImg = \DB::table('tb_properties_images')->where('id', $img_id)->delete();

            $res['status'] = 'success';
            return json_encode($res);
        } else {
            $res['status'] = 'error';
            return json_encode($res);
        }
    }

    function save_rooms_amenities(Request $request) {
        $uid = \Auth::user()->id;
        $rules['property_id'] = 'required';
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $data['property_id'] = $request->input('property_id');
            $data['cat_id'] = $request->input('category_id');
            $data['user_id'] = $uid;
            $data['amenities'] = $request->input('amenities_de');
            $data['amenities_eng'] = $request->input('amenities_eng');
            if (!empty($request->input('assigned_amenities'))) {
                $data['amenity_ids'] = implode(',', $request->input('assigned_amenities'));
            } else {
                $data['amenity_ids'] = '';
            }

            $check_pcats_exist = \DB::table('tb_properties_category_amenities')->where('property_id', $request->input('property_id'))->where('cat_id', $request->input('category_id'))->first();
            if (empty($check_pcats_exist)) {
                $data['created'] = date('Y-m-d h:i:s');
                $id = \DB::table('tb_properties_category_amenities')->insertGetId($data);
            } else {
                $data['updated'] = date('Y-m-d h:i:s');
                $id = \DB::table('tb_properties_category_amenities')->where('id', $check_pcats_exist->id)->update($data);
            }
            $desc = trim($request->input('room_amenities_desc'));
            if ($desc != '') {
                \DB::table('tb_properties_category_types')->where('property_id', $request->input('property_id'))->where('id', $request->input('category_id'))->update(["room_desc" => $desc]);
            }

            $res['status'] = 'success';
            return json_encode($res);
        } else {

            $res['status'] = 'error';
            $res['errors'] = $validator->errors()->all();
            return json_encode($res);
        }
    }

    //room prices

    function save_property_rooms_price_data(Request $request) {

        $uid = \Auth::user()->id;
        $rules['rack_rate'] = 'required';
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $seasonidArr = $request->input('seasonid');
            if (!empty($seasonidArr)) {
                for ($s = 0; $s < count($seasonidArr); $s++) {
                    if ($request->input('rack_rate')[$s] != '' && $request->input('rack_rate')[$s] > 0) {
                        $data['property_id'] = $request->input('property_id');
                        $data['category_id'] = $request->input('category_id');
                        $data['user_id'] = $uid;
                        $data['season_id'] = $request->input('seasonid')[$s];
                        $data['rack_rate'] = $request->input('rack_rate')[$s];
                        $data['single_price'] = $request->input('single_price')[$s];
                        $data['extra_adult'] = $request->input('extra_adult')[$s];
                        $data['extra_junior'] = $request->input('extra_junior')[$s];
                        $data['extra_baby'] = $request->input('extra_baby')[$s];
                        $data['monday_price'] = $request->input('monday_price')[$s];
                        $data['tuesday_price'] = $request->input('tuesday_price')[$s];
                        $data['wednesday_price'] = $request->input('wednesday_price')[$s];
                        $data['thursday_price'] = $request->input('thursday_price')[$s];
                        $data['friday_price'] = $request->input('friday_price')[$s];
                        $data['saturday_price'] = $request->input('saturday_price')[$s];
                        $data['sunday_price'] = $request->input('sunday_price')[$s];

                        if ($request->input('edit_room_price_id')[$s] == '') {
                            $data['created'] = date('Y-m-d h:i:s');
                            $id = \DB::table('tb_properties_category_rooms_price')->insertGetId($data);
                        } else {
                            $data['updated'] = date('Y-m-d h:i:s');
                            $id = \DB::table('tb_properties_category_rooms_price')->where('id', $request->input('edit_room_price_id')[$s])->update($data);
                        }
                    }
                }
                $res['status'] = 'success';
                return json_encode($res);
            }
        } else {

            $res['status'] = 'error';
            $res['errors'] = $validator->errors()->all();
            return json_encode($res);
        }
    }

    function change_property_type() {
        $uid = \Auth::user()->id;
        $items = Input::get('row_ids');
        $type = Input::get('type');
        if ($items != '') {
            $expo = explode(',', $items);
            foreach ($expo as $itmexp) {
                $exist = \DB::table('tb_properties')->where('id', $itmexp)->count();
                if ($exist > 0) {
                    \DB::table('tb_properties')->where('id', $itmexp)->update(['property_type' => $type]);
                }
            }
            return "success";
        } else {
            return "error";
        }
    }

    function enable_diable_propertystatus() {
        $uid = \Auth::user()->id;
        $items = Input::get('row_id');
        $filed_name = Input::get('filed_name');
        $action = Input::get('action');
        if ($items != '') {
            $exist = \DB::table('tb_properties')->where('id', $items)->count();
            if ($exist > 0) {
                \DB::table('tb_properties')->where('id', $items)->update([$filed_name => $action]);

                return "success";
            } else {
                return "error";
            }
        } else {
            return "error";
        }
    }

    function get_category_rooms_reservations(Request $request) {
        $property_id = $request->input('pid');
        $caltype = $request->input('caltype');

        if ($property_id != '' && $property_id > 0) {
            $cats = array();
            $cat_types_temp = \DB::table('tb_properties_category_types')->where('property_id', $property_id)->where('status', 0);
            if ($caltype != 'all') {
                $cat_types_temp->where('id', $caltype);
            }
            $cat_types = $cat_types_temp->get();
            if (!empty($cat_types)) {
                $c = 0;
                foreach ($cat_types as $type) {
                    $cat_rooms = \DB::table('tb_properties_category_rooms')->where('property_id', $property_id)->where('category_id', $type->id)->get();
                    if (!empty($cat_rooms)) {
                        $cats[$c]['data'] = $type;
                        foreach ($cat_rooms as $room) {
                            $cats[$c]['rooms'][] = $room;
                        }
                    }
                    /* $fileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $property_id)->where('tb_properties_images.category_id', $type->id)->where('tb_properties_images.type', 'Rooms Images')->get();
                      $filen = array();
                      if(!empty($fileArr))
                      {
                      $f=0;
                      foreach($fileArr as $file)
                      {
                      $cats[$c]['imgs'][$f] = $file;
                      $cats[$c]['imgs'][$f]->imgsrc = (new ContainerController)->getThumbpath($file->folder_id);
                      $f++;
                      }
                      }

                      $cat_amenty = \DB::table('tb_properties_category_amenities')->where('property_id', $property_id)->where('cat_id', $type->id)->first();
                      if(!empty($cat_amenty))
                      {
                      $cats[$c]['amenty'] = $cat_amenty;
                      }

                      $cat_amenty = \DB::table('tb_properties_category_amenities')->where('property_id', $property_id)->where('cat_id', $type->id)->first();
                      if(!empty($cat_amenty))
                      {
                      $cats[$c]['amenties'] = $cat_amenty->amenity_ids;
                      } */
                    $c++;
                }
            }

            if (empty($cats)) {
                $res['status'] = 'error';
                $res['errors'] = 'No Room Added For This Property.';
                return json_encode($res);
            } else {
                $res['status'] = 'success';
                $res['cat_types'] = $cats;
                return json_encode($res);
            }
        } else {
            $res['status'] = 'error';
            $res['errors'] = 'Property Not Found.';
            return json_encode($res);
        }
    }

    //new reservation
    function add_new_reservation(Request $request) {
        $uid = \Auth::user()->id;
        $rules['staytype'] = 'required';
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $clientdata = json_decode($request->input('clientData'));
            if ($clientdata->act == 'new') {
                $ctdata['client_title'] = $clientdata->title;
                $ctdata['client_company'] = $clientdata->company;
                $ctdata['client_firstname'] = $clientdata->firstname;
                $ctdata['client_lastname'] = $clientdata->lastname;
                $ctdata['client_email'] = $clientdata->email;
                $ctdata['client_cellphone'] = $clientdata->cellphone;
                $ctdata['client_country'] = $clientdata->country;
                $ctdata['client_comment'] = $clientdata->comment;
                $ctdata['client_status'] = 1;
                $ctdata['created_date'] = date('Y-m-d h:i:s');
                $ctdata['created_by'] = $uid;
                $ctid = \DB::table('tb_clients')->insertGetId($ctdata);
            } elseif ($clientdata->act == 'exist') {
                $ctid = $clientdata['id'];
            }

            $data['property_id'] = $request->input('property_id');
            $data['checkin_date'] = $request->input('chkin');
            $data['checkout_date'] = $request->input('chkout');
            $data['room_id'] = $request->input('roomid');
            $data['client_id'] = $ctid;
            $data['stay_type'] = $request->input('staytype');
            $data['source'] = $request->input('source');
            $data['comment'] = $request->input('comment');
            if (!is_null($request->input('pre'))) {
                $data['pre_reserve'] = 1;
            }
            $data['adult'] = $request->input('adult');
            $data['junior'] = $request->input('junior');
            $data['baby'] = $request->input('baby');
            $data['guest_names'] = $request->input('guest_list');
            $data['checkin_comment'] = $request->input('chkin_comment');
            $data['checkout_comment'] = $request->input('chkout_comment');
            if (!is_null($request->input('option1'))) {
                $data['option1'] = 1;
            }
            if (!is_null($request->input('option2'))) {
                $data['option2'] = 1;
            }
            $data['price'] = $request->input('price');
            $data['price_mode'] = $request->input('price_mode');
            $data['board'] = $request->input('board');
            $data['created_by'] = $uid;
            $data['created_date'] = date('Y-m-d h:i:s');
            $resid = \DB::table('tb_reservations')->insertGetId($data);

            $res['status'] = 'success';
            return json_encode($res);
        } else {

            $res['status'] = 'error';
            $res['errors'] = $validator->errors()->all();
            return json_encode($res);
        }
    }
	
	function delete_selectedproperty_image(Request $request) {
        $uid = \Auth::user()->id;
        $items = explode(',',$request->input('items'));
		if(!empty($items))
		{
			foreach($items as $item) 
			{
				$checkImg = \DB::table('tb_properties_images')->where('id', $item)->first();
				if (!empty($checkImg)) {
					$deleteEfile = (new ContainerController)->delete_allextra_files($checkImg->file_id, 'file');
					$deleteFile = \DB::table('tb_container_files')->where('id', $checkImg->file_id)->delete();
					$deleteImg = \DB::table('tb_properties_images')->where('id', $item)->delete();
				}
			}
			$res['status'] = 'success';
			$res['imgs'] = $items;
		}
		else {
			$res['status'] = 'error';
		}
		return json_encode($res);
    }

}
