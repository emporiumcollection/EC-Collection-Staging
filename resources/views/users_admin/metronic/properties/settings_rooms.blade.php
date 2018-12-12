@extends('users_admin.metronic.layouts.app')

@section('page_name')
    Property  <small>Properties</small>
@stop

@section('breadcrumb')
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('dashboard')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Dashboard </span> 
        </a> 
    </li>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('properties')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Reservation & Distribution </span> 
        </a> 
    </li>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('properties')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Properties </span> 
        </a> 
    </li>
    @if(!empty($property_data))
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('properties')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> {{ucfirst($property_data->property_name)}}  </span> 
        </a> 
    </li>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="javascript:;" class="m-nav__link"> 
            <span class="m-nav__link-text breadcrumb-end"> {{ucfirst($active)}} </span> 
        </a> 
    </li>
    @endif
@stop

@section('content')
    
    <div class="row">
    
        @if(Session::has('message'))	  
		   {{ Session::get('message') }}	   
	    @endif
                
        <div class="col-xs-12 col-lg-12">
            <ul>
        		@foreach($errors->all() as $error)
        			<li>{{ $error }}</li>
        		@endforeach
        	</ul>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
            @if(!empty($property_data)) {{$property_data->property_name}} @endif 
        </div>
        <div class="col-sm-8 col-md-8 col-lg-8">
            <a href="{{URL::to('properties/update/'.$pid)}}" class="tips btn btn-xs btn-primary pull-right" title="" data-original-title="Property Management"><i class="fa fa-edit"></i>&nbsp;Property Management</a>
            <a href="{{URL::to('flipviewpdf/Emporium-Voyage-Add-Suites-help.pdf')}}" class="tips btn btn-xs btn-primary pull-right" title="" data-original-title="Add Suites" style="margin-right: 10px;" target="_blank"><i class="fa fa-edit"></i>&nbsp;View Documentation</a>
        </div>
        <!--begin::Portlet-->
		<div class="m-portlet">
            <div class="m-portlet__head">				
				<div class="m-portlet__head-tools margin-left-98">
					<ul class="m-portlet__nav bg-gray">
						<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
							<a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon m-portlet__nav-link--icon-xl">
								<i class="fa fa-bars m--font-light"></i>
							</a>
							<div class="m-dropdown__wrapper" style="z-index: 101;">
								<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 18px;"></span>
								<div class="m-dropdown__inner">
									<div class="m-dropdown__body">
										<div class="m-dropdown__content">
											<ul class="m-nav">
												<li class="m-nav__section m-nav__section--first">
													<span class="m-nav__section-text">
														Quick Actions
													</span>
												</li> 
                                                <li class="m-nav__item">
													<a href="http://localhost:8181/emporium-staging-forge/public/properties/update/2309?return=" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Hotel/Property
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="http://localhost:8181/emporium-staging-forge/public/properties_settings/2309/types" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Room Types
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="http://localhost:8181/emporium-staging-forge/public/properties_settings/2309/rooms" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Rooms
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="http://localhost:8181/emporium-staging-forge/public/properties_settings/2309/seasons" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Seasons
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="http://localhost:8181/emporium-staging-forge/public/properties_settings/2309/calendar" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Reservation Management
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="http://localhost:8181/emporium-staging-forge/public/properties_settings/2309/price" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Price
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="http://localhost:8181/emporium-staging-forge/public/properties_settings/2309/property_documents" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Property Documents
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="http://localhost:8181/emporium-staging-forge/public/properties_settings/2309/property_images" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Images
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="http://localhost:8181/emporium-staging-forge/public/properties_settings/2309/gallery_images" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Galleries
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="http://localhost:8181/emporium-staging-forge/public/advertising" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Become Featured
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="https://emporium-collection.com/" class="m-nav__link" target="_blank">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Get Help
														</span>
													</a>
											    </li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<div class="m-portlet__body">
				<ul class="nav nav-tabs" role="tablist">
                    @if(!empty($tabss))
        				@foreach($tabss as $key=>$val)
        					<li class="nav-item"> 
                                <a class="nav-link @if($key == $active) active @endif" href="{{URL::to('properties_settings/'.$pid.'/'.$key)}}"> {{ $val->tab_name }} </a>
                            </li>
        				@endforeach
        			@endif					
				</ul>
                
				<div class="tab-content">
					<div class="tab-pane active">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <h3 class="main-heading">{{ Lang::get('hotel-property.room-heading')}}</h3>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                                <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible show" role="alert">
                                   <div class="m-alert__icon">
                                        <i class="flaticon-exclamation-1"></i>
                                        <span></span>
                                   </div>
                                   <div class="m-alert__text">                
                                        {{ Lang::get('hotel-property.room-info')}}
                                   </div>
                                </div>
                            </div>
                        </div>
						@if(!empty($cat_types))
						<div class="box well">
							<div class="header">
								<p>Changing the name for existing rooms will change it in existing reservation and normally shouldn't be done Room active dates are used to determine when the room is available for booking, and used to calculate day to day occupancy statistics. Leave end date blank unless you want the room to expire at some point</p>
							</div> 
							<div class="tab-container">
								<ul class="nav nav-tabs" role="tablist">
									@foreach($cat_types as $cat)
										<li class="nav-item bg-gray">
                                            <a class="nav-link" href="#" data-target="#tab{{$cat['data']->id}}" data-toggle="tab">{{$cat['data']->category_name}}</a>
                                        </li>
									@endforeach
								</ul>
								<div class="tab-content">
									@foreach($cat_types as $cat)
										<div class="tab-pane use-padding" id="tab{{$cat['data']->id}}">
											<div class="tab-container">
												<ul class="nav nav-tabs" role="tablist">
													<li class="nav-item">
                                                        <a class="nav-link"  href="#" data-target="#rooms_details_cat{{$cat['data']->id}}" data-toggle="tab">Rooms Details</a>
                                                    </li>
													<li class="nav-item">
                                                        <a class="nav-link" href="#" data-target="#rooms_images_cat{{$cat['data']->id}}" data-toggle="tab">Rooms Images</a>
                                                    </li>
													<li class="nav-item">
                                                        <a class="nav-link"  href="#" data-target="#rooms_amenity_cat{{$cat['data']->id}}" data-toggle="tab">Amenities</a>
                                                    </li>
												</ul>
												
												<div class="tab-content">
													<div class="tab-pane use-padding" id="rooms_details_cat{{$cat['data']->id}}">
                                                        <div id="refresh_{{$cat['data']->id}}">
														@if(array_key_exists('rooms', $cat))
															{{--*/ $r=1; /*--}}
                                                            <div class="row">
                                                                <div class="col-md-12 col-xs-12">
                                                                    <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible" role="alert">
                                                                       <div class="m-alert__icon">
                                                                            <i class="flaticon-exclamation-1"></i>
                                                                            <span></span>
                                                                       </div>
                                                                       <div class="m-alert__text">                
                                                                            {{ Lang::get('hotel-property.room-detail-info')}}
                                                                       </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-sm-12 col-md-12 col-lg-12 fun-bg-gray">
                                                                <form id="add_property_room_setup{{$cat['data']->id}}-{{$r}}" class="add_property_room_setup">
    																<input type="hidden" name="property_id" value="{{$pid}}" >
    																<input type="hidden" name="category_id" value="{{$cat['data']->id}}" >
    																<input type="hidden" name="edit_room_id" value="" >
    																<div class="row">
    																	<div class="col-lg-8">
    																		<div class="row">
    																			<div class="form-group col-lg-4">
    																				<label for="room_name">Number/Name </label>
    																				<input name="room_name" id="room_name" type="text" class="form-control input-sm" value="" required="required" /> 
    																			</div>
    																			<div class="form-group col-lg-2">
    																				<label for="room_active_full">Active Full Year </label>
    																				 
                                                                                    <div class="m-checkbox-inline m--align-center">
                                            											<label class="m-checkbox m-checkbox--solid m-checkbox--brand">
                                            												<input name="room_active_full" id="room_active_full" type="checkbox" class="form-control" value="1">
                                            												<span></span>
                                            											</label>
                                            										</div>
    																			</div>
    																			<div class="form-group col-lg-3">
    																				<label for="room_active_from{{$cat['data']->id}}-{{$r}}">Active from </label>
    																				<input name="room_active_from" id="room_active_from{{$cat['data']->id}}-{{$r}}" type="text" class="form-control input-sm datepic" value="" required="required" /> 
    																			</div>
    																			<div class="form-group col-lg-3">
    																				<label for="room_active_to{{$cat['data']->id}}-{{$r}}">Active to</label>
    																				<input name="room_active_to" id="room_active_to{{$cat['data']->id}}-{{$r}}" type="text" class="form-control input-sm datepic" value="" /> 
    																			</div>
    																		</div>
    																	</div>
    																	<div class="col-lg-4 m--align-right">
    																		<div class="butt margin-top-10">
    																			<button type="submit" class="btn btn-success b-btn"><i class="fa fa-plus"></i> Add</button>
    																		</div>
    																	</div>
    																</div>
    															</form>
                                                            </div>
                                                            <div class="col-sm-12 col-md-12 col-lg-12 gray-seprator"></div>
                                                            
                                                            <div class="content-block">
															@foreach($cat['rooms'] as $room)
                                                                {{--*/ $r++ /*--}}
                                                                <div class="alt-bg">
																<form id="add_property_room_setup{{$cat['data']->id}}-{{$r}}" class="add_property_room_setup">
																	<input type="hidden" name="property_id" value="{{$pid}}" >
																	<input type="hidden" name="category_id" value="{{$cat['data']->id}}" >
																	<input type="hidden" name="edit_room_id" value="{{$room->id}}" >
																	<div class="row">
																		<div class="col-lg-8">
																			<div class="row">
																				<div class="form-group col-lg-4">
																					<label for="room_name">Number/Name </label>
																					<input name="room_name" id="room_name" type="text" class="form-control input-sm" value="{{$room->room_name}}" required="required" /> 
																				</div> 
																				<div class="form-group col-lg-2">
																					<label for="room_active_full">Active Full Year </label>
																					
                                                                                    
                                                                                    <div class="m-checkbox-inline m--align-center">
                                            											<label class="m-checkbox m-checkbox--solid m-checkbox--brand">
                                            												<input name="room_active_full" id="room_active_full" type="checkbox" class="form-control input-sm " value="1" {{($room->active_full_year==1) ? 'checked="checked"' : ''}}>
                                            												<span></span>
                                            											</label>
                                            										</div>
                                                                                    
																				</div>
																				<div class="form-group col-lg-3">
																					<label for="room_active_from{{$cat['data']->id}}-{{$r}}">Active from </label>
																					<input name="room_active_from" id="room_active_from{{$cat['data']->id}}-{{$r}}" type="text" class="form-control input-sm datepic" value="{{$room->room_active_from}}" required="required" /> 
																				</div>
																				<div class="form-group col-lg-3">
																					<label for="room_active_to{{$cat['data']->id}}-{{$r}}">Active to</label>
																					<input name="room_active_to" id="room_active_to{{$cat['data']->id}}-{{$r}}" type="text" class="form-control input-sm datepic" value="{{$room->room_active_to}}" /> 
																				</div>
																			</div>
																		</div>
																		<div class="col-lg-4 m--align-right">
																			<div class="butt margin-top-10">
																				<button type="button" class="btn btn-primary b-btn" onclick="copy_rooms_data({{$room->id}});" ><i class="fa fa-trash-0"></i> Copy</button>
																				<button type="button" class="btn btn-danger b-btn" onclick="delete_rooms_tabdata({{$room->id}},{{$r}},{{$cat['data']->id}}, {{$pid}});"><i class="fa fa-trash-0"></i> Delete</button>
																				<button type="submit" class="btn btn-success b-btn"><i class="fa fa-save"></i> Save</button>
																			</div>
																		</div>
																	</div>
																</form>
                                                                </div>
																
															@endforeach
															</div>
														@else
                                                            <div class="row">
                                                                <div class="col-md-12 col-xs-12">
                                                                    <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible" role="alert">
                                                                       <div class="m-alert__icon">
                                                                            <i class="flaticon-exclamation-1"></i>
                                                                            <span></span>
                                                                       </div>
                                                                       <div class="m-alert__text">                
                                                                            {{ Lang::get('hotel-property.room-detail-info')}}
                                                                       </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-12 col-md-12 col-lg-12 fun-bg-gray">
    															 <form id="add_property_room_setup{{$cat['data']->id}}-1" class="add_property_room_setup">
    																<input type="hidden" name="property_id" value="{{$pid}}" >
    																<input type="hidden" name="category_id" value="{{$cat['data']->id}}" >
    																<input type="hidden" name="edit_room_id" value="" >
    																<div class="row">
    																	<div class="col-lg-8">
    																		<div class="row">
    																			<div class="form-group col-lg-4">
    																				<label for="room_name">Number/Name </label>
    																				<input name="room_name" id="room_name" type="text" class="form-control input-sm" value="" required="required" /> 
    																			</div> 
    																			<div class="form-group col-lg-2">
    																				<label for="room_active_full">Active Full Year </label>
    																				
                                                                                    <div class="m-checkbox-inline m--align-center">
                                            											<label class="m-checkbox m-checkbox--solid m-checkbox--brand">
                                            												<input name="room_active_full" id="room_active_full" type="checkbox" value="1">
                                            												<span></span>
                                            											</label>
                                            										</div>
    																			</div>
    																			<div class="form-group col-lg-3">
    																				<label for="room_active_from{{$cat['data']->id}}-1">Active from </label>
    																				<input name="room_active_from" id="room_active_from{{$cat['data']->id}}-1" type="text" class="form-control input-sm datepic" value="" required="required" /> 
    																			</div>
    																			<div class="form-group col-lg-3">
    																				<label for="room_active_to{{$cat['data']->id}}-1">Active to</label>
    																				<input name="room_active_to" id="room_active_to{{$cat['data']->id}}-1" type="text" class="form-control input-sm datepic" value="" /> 
    																			</div>
    																		</div>
    																	</div>
    																	<div class="col-lg-4 m--align-right">
    																		<div class="butt margin-top-10">
    																			<button type="submit" class="btn btn-success b-btn"><i class="fa fa-plus"></i> Add</button>
    																		</div>
    																	</div>
    																</div>
    															</form>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-12 col-md-12 col-lg-12 gray-seprator"></div>
                                                            </div>
														@endif
                                                        </div>
													</div>
													<div class="tab-pane use-padding" id="rooms_images_cat{{$cat['data']->id}}">
                                                        <div class="row">
                                                            <div class="col-md-12 col-xs-12">
                                                                <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible" role="alert">
                                                                   <div class="m-alert__icon">
                                                                        <i class="flaticon-exclamation-1"></i>
                                                                        <span></span>
                                                                   </div>
                                                                   <div class="m-alert__text">                
                                                                        {{ Lang::get('hotel-property.room-image-info')}}
                                                                   </div>
                                                                </div>
                                                            </div>
                                                        </div>
														<!-- The file upload form used as target for the file upload widget -->
														<form class="fileupload" action="{{URL::to('property_images_uploads')}}" method="POST" enctype="multipart/form-data">
															<input type="hidden" name="propId" value="{{$pid}}" />
															<input type="hidden" name="uploadType" value="Rooms Images" />
															<input type="hidden" name="category_id" value="{{$cat['data']->id}}" >
															<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
															<div class="row fileupload-buttonbar">
																<div class="col-lg-7">
																	<!-- The fileinput-button span is used to style the file input field as button -->
																	<span class="btn btn-success fileinput-button">
																		<i class="glyphicon glyphicon-plus"></i>
																		<span>Add files...</span>
																		<input type="file" name="files[]" multiple>
																	</span>
																	<button type="submit" class="btn btn-primary start">
																		<i class="glyphicon glyphicon-upload"></i>
																		<span>Start upload</span>
																	</button>
																	<button type="reset" class="btn btn-warning cancel">
																		<i class="glyphicon glyphicon-ban-circle"></i>
																		<span>Cancel upload</span>
																	</button>
																	<a class="btn btn-success" title="Re-oder your images from the container after room setup has been completed" @if(array_key_exists('imgs', $cat)) href="{{URL::to('folders/'.$cat['imgs'][0]->folder_id.'?show=thumb')}}" @else href="#" @endif>
																		<span>Re-Order</span>
																	</a>
																	<button type="button" class="btn btn-danger" onclick="delete_selected_imgs('ff{{$cat['data']->id}}');" >
																		<i class="glyphicon glyphicon-trash"></i>
																		<span>Delete</span>
																	</button>
																	<!-- The global file processing state -->
																	<span class="fileupload-process"></span>
																</div>
																<!-- The global progress state -->
																<div class="col-lg-5 fileupload-progress fade">
																	<!-- The global progress bar -->
																	<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
																		<div class="progress-bar progress-bar-success" style="width:0%;"></div>
																	</div>
																	<!-- The extended global progress state -->
																	<div class="progress-extended"> </div>
																</div>
															</div>
															<!-- The table listing the files available for upload/download -->
															<table role="presentation" class="table table-striped prese">
																<tbody class="files">
																	@if(array_key_exists('imgs', $cat))
																		<tr>
																			<td colspan="5"><input type="checkbox" value="1" id="check_all" rel="{{$cat['data']->id}}" class="check-all"> Select all</td>
																		</tr>
																		@foreach($cat['imgs'] as $img)
																			<tr class="template-download fade in row{{$img->id}}">
																				<td>
																					<input type="checkbox" name="compont[]" id="compont" value="{{$img->id}}" class="no-border check-files ff{{$cat['data']->id}}">
																				</td>
																				<td>
																					<span class="preview">
																						<a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_name}}" download="{{$img->file_name}}" data-gallery="#blueimp-gallery{{$cat['data']->id}}">
																							<img src="{{URL::to('uploads/property_imgs_thumbs/'.$img->file_name)}}">
																						</a>
																					</span>
																				</td>
																				<td>
																					<p class="name">
																						<a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_display_name}}" download="{{$img->file_name}}" data-gallery="#blueimp-gallery{{$cat['data']->id}}">{{$img->file_display_name}}</a>
																					</p>
																				</td>
																				<td>
																					<span class="size">
																						{{--*/ $sizeKb = ($img->file_size/1024); /*--}} {{ round($sizeKb,2,PHP_ROUND_HALF_UP) }} KB
																					</span>
																				</td>
																				<td>
																					<button type="button" class="btn btn-danger" onclick="delete_property_image({{$img->id}});" >
																						<i class="glyphicon glyphicon-trash"></i>
																						<span>Delete</span>
																					</button>
																				</td>
																			</tr>
																		@endforeach
																	@endif
																</tbody>
															</table>
														</form>
														
														<!-- The blueimp Gallery widget -->
														<div id="blueimp-gallery{{$cat['data']->id}}" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
															<div class="slides"></div>
															<h3 class="title"></h3>
															<a class="prev"><</a>
															<a class="next">></a>
															<a class="close">x</a>
															<a class="play-pause"></a>
															<ol class="indicator"></ol>
														</div>
													</div>
													
													
													<div class="tab-pane use-padding" id="rooms_amenity_cat{{$cat['data']->id}}">
                                                        <div class="row">
                                                            <div class="col-md-12 col-xs-12">
                                                                <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible" role="alert">
                                                                   <div class="m-alert__icon">
                                                                        <i class="flaticon-exclamation-1"></i>
                                                                        <span></span>
                                                                   </div>
                                                                   <div class="m-alert__text">                
                                                                        {{ Lang::get('hotel-property.room-amenties-info')}}
                                                                   </div>
                                                                </div>
                                                            </div>
                                                        </div>
														<form id="add_amenities_room_setup{{$cat['data']->id}}" class="add_amenities_room_setup fun-bg-gray">
															<input type="hidden" name="property_id" value="{{$pid}}" >
															<input type="hidden" name="category_id" value="{{$cat['data']->id}}" >
															<div class="row margin-top-10">
																<div class="col-lg-8">
																	<div class="row">
																		<div class="form-group" style="width:100%;">
                                                                            <div class="col-lg-12" style="width:100%;">
																			<label for="room_name">Amenities </label>
																			<select name='assigned_amenities[]' rows='5' id='assigned_amenities' class='form-control m-input m-input--solid select2' multiple="multiple" required="required" style="width:100%;">
																			  @if(!empty($amenties))
																					@foreach($amenties as $amenty)
																						<option value="{{$amenty->id}}" {{(array_key_exists('amenty', $cat) && in_array($amenty->id,explode(',',$cat['amenties']))) ? " selected='selected' " : '' }}>{{$amenty->amenity_title}}</option>
																					@endforeach
																				@endif
																		    </select>
                                                                            <span class="m-form__help">
                    															Please select assign amenties, Type in the white box to search/select
                    														</span> 
                                                                            </div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="form-group col-lg-12">
																			<label for="room_name">Amenities DE </label>
																			
																		  <textarea name="amenities_de" class="form-control input-sm">{{(array_key_exists('amenty', $cat)) ? $cat['amenty']->amenities : '' }}</textarea>
																		</div>
																	</div>
																	<div class="row">
																		<div class="form-group col-lg-12">
																			<label for="room_name">Amenities EN </label>
																			<textarea name="amenities_eng" class="form-control input-sm">{{(array_key_exists('amenty', $cat)) ? $cat['amenty']->amenities_eng : '' }}</textarea>
																		</div>
																	</div>
																	<div class="row">
																		<div class="form-group col-lg-12">
																			<label for="room_name">Description </label>
																			<textarea name="room_amenities_desc" class="form-control input-sm">@if(!empty($room_amenties_desc)){{$room_amenties_desc[$cat['data']->id]}}@endif</textarea>
																		</div>
																	</div>
																</div>
																<div class="col-lg-4 m--align-right">
																	<div class="butt margin-top-10">
																		<button type="button" class="btn btn-success b-btn" onclick="save_amenities_data({{$cat['data']->id}});"><i class="fa fa-plus"></i> Save</button>
																	</div>
																</div>
															</div>
														</form>	
													</div>
												</div>
											</div>
										</div>
									@endforeach
								</div>
							</div>
						</div>
					@endif
					</div>
				</div>
			</div>
		</div>
		<!--end::Portlet-->
    </div>
<!-- Copy rooms Modal -->
<div class="modal fade" id="copyroom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		<h4 class="modal-title" id="myModalLabel">Copy Room</h4>
	  </div>
	  {!! Form::open(array('url'=>'copy_category_rooms', 'class'=>'columns' ,'id' =>'copy_category_rooms', 'method'=>'post', 'files'=>true )) !!}
	  <input type="hidden" name="roomID" id="roomID" value="">
	  <input type="hidden" name="curnurl" value="{{ Request::url() }}">
	  <div class="modal-body">
		<fieldset>
			<div class="col-md-6">
				<div class="field">
					<label>Number(s) of copies <em>*</em></label>
					<div class="field-input">
						<select name="copy_num" class="form-control" required="required">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
						</select>
					</div>
				</div>
			</div>
		</fieldset>
	  </div>
	  <div class="modal-footer">
		<button type="submit" class="btn btn-primary">Copy</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	  </div>
	  </form>
	</div>
  </div>
</div>
@stop
{{-- For custom style  --}}
@section('style')
    @parent
    <link href="{{ asset('sximo/css/bookingSys.css')}}" rel="stylesheet">
    <script src="{{ asset('sximo/js/jquery.validate.js')}}"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
    <link rel="stylesheet" href="{{ asset('sximo/file_upload/css/jquery.fileupload.css')}}">
    <link rel="stylesheet" href="{{ asset('sximo/file_upload/css/jquery.fileupload-ui.css')}}">
    
    <!-- CSS adjustments for browsers with JavaScript disabled -->
    <noscript><link rel="stylesheet" href="{{ asset('sximo/file_upload/css/jquery.fileupload-noscript.css')}}"></noscript>
    <noscript><link rel="stylesheet" href="{{ asset('sximo/file_upload/css/jquery.fileupload-ui-noscript.css')}}"></noscript> 
    
    <style>
        .fade {
          opacity: 0;
          transition:opacity .15s linear;
        }
        .fade.in {
            opacity: 1;
          }
    </style>
     
@endsection

@section('script')
<script src="{{ asset('metronic/assets/demo/demo6/base/toastr.js') }}"></script>
<script>

$(document).ready(function () {
    $(".select2").select2();
     /*$(".add_property_type_setup").validate({
		 errorPlacement: function(error, element) {
			// Append error within linked label
			$( element ).closest( "form" ).find( "label[for='" + element.attr( "id" ) + "']" ).addClass( 'lerror' );
		},
		 submitHandler: function (form) {
            // save_types_tabdata(formid);
             return false; // required to block normal submit since you used ajax
         }
     });*/
	 
		$('.datepic').datepicker({
				numberOfMonths: 2,
				showButtonPanel: true,
				format: 'yyyy-mm-dd'
		});
		
	$(document).on('click', '.btn', function (){
		 var frmid = $(this).parents('form.add_property_room_setup').attr('id');
		  $('#'+frmid).validate({
			submitHandler: function (form) {
				 save_rooms_tabdata(frmid);
				 return false; // required to block normal submit since you used ajax
			 }
		 });
	 });
});
    
    function get_property_rooms(id, cid){ 
        $.ajax({
		  url: "{{ URL::to('ajax_properties_setting_rooms')}}",
		  type: "post",
		  data: {id:id, cid:cid},
		  //dataType: "json",
		  success: function(data){ console.log(data);
           
		    $("#refresh_"+cid).html('');
			$("#refresh_"+cid).html(data);
            $('.datepic').datepicker({
    				numberOfMonths: 2,
    				showButtonPanel: true,
    				format: 'yyyy-mm-dd'
    		});
          }
        });        
    }
    
	function save_rooms_tabdata(formid)
	{
		if(formid!='')
		{
			$.ajax({
			  url: "{{ URL::to('add_property_category_rooms')}}",
			  type: "post",
			  data: $('#'+formid).serializeArray(),
			  dataType: "json",
			  success: function(data){
				var html = '';
				if(data.status=='error')
				{
					html +='<ul class="parsley-error-list">';
					$.each(data.errors, function(idx, obj) {
						html +='<li>'+obj+'</li>';
					});
					html +='</ul>';
					$('.page-content-wrapper #formerrors').html(html);
                    toastr.error(html);
					window.scrollTo(0, 0);
				}
				else
				{
					if(data.type=='update')
					{
						html +='<div class="alert alert-success fade in block-inner">';
						html +='<button data-dismiss="alert" class="close" type="button">×</button>';
						html +='<i class="icon-checkmark-circle"></i> Record Updated Successfully </div>';
						$('.page-content-wrapper #formerrors').html(html);
                        toastr.success("Record Updated Successfully");    
						window.scrollTo(0, 0);                                            
                        //window.location.reload();
					}
					else
					{
					   toastr.success("Record Inserted Successfully");
                       get_property_rooms(data.pid, data.category_id);
						/*splt = formid.split('-');
						newid = parseInt(splt[1]) + 1;
						
						$('#'+formid+' .butt button').remove();
						var remBut = '<button type="button" class="btn btn-primary b-btn" onclick="copy_rooms_data('+data.room.id+','+splt[1]+','+data.room.category_id+');"><i class="fa fa-trash-0"></i> Copy</button> <button type="button" class="btn btn-danger b-btn" onclick="delete_rooms_tabdata('+data.room.id+','+splt[1]+','+data.room.category_id+');"><i class="fa fa-trash-0"></i> Delete</button> <button type="submit" class="btn btn-success b-btn"><i class="fa fa-save"></i> Save</button>';
						$('#'+formid+' .butt').html(remBut);
						
						$('#'+formid+' input[name="edit_room_id"]').val(data.room.id);
						var categid = $('#'+formid+' input[name="category_id"]').val();
						
						html +='<form id="'+splt[0]+'-'+newid+'" class="add_property_room_setup">';
						html +='<input type="hidden" name="property_id" value="{{$pid}}" >';
						html +='<input type="hidden" name="category_id" value="'+categid+'" >';
						html +='<input type="hidden" name="edit_room_id" value="" >';
						html +='<div class="row">';
						html +='<div class="col-lg-8">';
						html +='<div class="row">';
						html +='<div class="form-group col-lg-4">';
						html +='<label for="room_name">Number/Name </label>';
						html +='<input name="room_name" id="room_name" type="text" class="form-control input-sm" value="" required="required" />'; 
						html +='</div>'; 
						html +='<div class="form-group col-lg-2">';
						html +='<label for="room_active_full">Active Full Year </label>';
						//html +='<input name="room_active_full" id="room_active_full" type="checkbox" class="form-control input-sm datepic" value="1"  />';
                        html +='<div class="m-checkbox-inline m--align-center">';
						html +='<label class="m-checkbox m-checkbox--solid m-checkbox--brand">';
						html +='<input name="room_active_full" id="room_active_full" type="checkbox" value="1">';
						html +='<span></span>';
						html +='</label>';
						html +='</div>';
                         
						html +='</div>';
						html +='<div class="form-group col-lg-3">';
						html +='<label for="room_active_from'+data.room.category_id+'-'+newid+'">Active from </label>';
						html +='<input name="room_active_from" id="room_active_from'+data.room.category_id+'-'+newid+'" type="text" class="form-control input-sm datepic" value="" required="required" />'; 
						html +='</div>';
						html +='<div class="form-group col-lg-3">';
						html +='<label for="room_active_to'+data.room.category_id+'-'+newid+'">Active to</label>';
						html +='<input name="room_active_to" id="room_active_to'+data.room.category_id+'-'+newid+'" type="text" class="form-control input-sm datepic" value="" />';
						html +='</div>';
						html +='</div>';
						html +='</div>';
						html +='<div class="col-lg-4 align-right">';
						html +='<div class="butt margin-top-10">';
						html +='<button type="submit" class="btn btn-success b-btn"><i class="fa fa-plus"></i> Add</button>';
						html +='</div>';
						html +='</div>';
						html +='</div>';
						html +='</form>';
						$('#'+formid).after(html);
						
						var htmli = '';
						htmli +='<div class="alert alert-success fade in block-inner">';
						htmli +='<button data-dismiss="alert" class="close" type="button">×</button>';
						htmli +='<i class="icon-checkmark-circle"></i> Record Inserted Successfully </div>';
						$('.page-content-wrapper #formerrors').html(htmli);
						window.scrollTo(0, 0);
						$('.datepic').datepicker({
								numberOfMonths: 2,
								showButtonPanel: true,
								dateFormat: 'yy-mm-dd'
						});*/
                        
                        
                        
					}
				}
			  }
			});
		}
	}
	
	function delete_rooms_tabdata(roomId,formid,catid, pid)
	{
		if(roomId!='' && roomId>0)
		{
			var conf = confirm("Are you sure? you want to delete this record!");
			if(conf==true)
			{
				$.ajax({
				  url: "{{ URL::to('delete_property_category_rooms')}}",
				  type: "post",
				  data: {room_id:roomId, catid:catid, pid:pid},
				  dataType: "json",
				  success: function(data){
					  var html ='';
					  if(data.status=='error')
					  {
							html +='<div class="alert alert-danger fade in block-inner">';
							html +='<button data-dismiss="alert" class="close" type="button">×</button>';
							html +='<i class="icon-checkmark-circle"></i> Record Not Found </div>';
							$('.page-content-wrapper #formerrors').html(html);
                            toastr.success("Record Not Found");
							//window.scrollTo(0, 0);
					  }
					  else{
							$('#add_property_room_setup'+catid+'-'+formid).remove();
							html +='<div class="alert alert-success fade in block-inner">';
							html +='<button data-dismiss="alert" class="close" type="button">×</button>';
							html +='<i class="icon-checkmark-circle"></i> Record Deleted Successfully </div>';
							$('.page-content-wrapper #formerrors').html(html);
                            toastr.success("Record Deleted Successfully");
							//window.scrollTo(0, 0);
                            get_property_rooms(data.pid, data.catid);
					  }
				  }
				});
			}
		}
	}
	
	function save_amenities_data(catid)
	{
		if(catid!='' && catid>0)
		{
			$.ajax({
			  url: "{{ URL::to('save_rooms_amenities')}}",
			  type: "post",
			  data: $('#add_amenities_room_setup'+catid).serialize(),
			  dataType: "json",
			  success: function(data){
				  var html ='';
				  if(data.status=='error')
				  {
						html +='<div class="alert alert-danger fade in block-inner">';
						html +='<button data-dismiss="alert" class="close" type="button">×</button>';
						html +='<i class="icon-checkmark-circle"></i> Record Not Found </div>';
						$('.page-content-wrapper #formerrors').html(html);
						//window.scrollTo(0, 0);
                        toastr.success("Record Not Found");
				  }
				  else{
						html +='<div class="alert alert-success fade in block-inner">';
						html +='<button data-dismiss="alert" class="close" type="button">×</button>';
						html +='<i class="icon-checkmark-circle"></i> Record Updated Successfully </div>';
						$('.page-content-wrapper #formerrors').html(html);
						//window.scrollTo(0, 0);
                        toastr.success("Record Updated Successfully");
				  }
			  }
			});
		}
	}
	
	function copy_rooms_data(roomID)
	{
		if(roomID!='' && roomID>0)
		{
			$('#roomID').val(roomID);
		}
        $('#copyroom').modal('show');
	}
</script>

<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
		<td></td>
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade row{%=file.id%}">
		<td></td>
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(parseInt(file.size))%}</span>
        </td>
        <td>
            <button type="button" class="btn btn-danger" onclick="delete_property_image({%=file.id%});">
				<i class="glyphicon glyphicon-trash"></i>
				<span>Delete</span>
			</button>
        </td>
    </tr>
{% } %}
</script>

<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="{{ asset('sximo/file_upload/js/vendor/jquery.ui.widget.js')}}"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!-- blueimp Gallery script -->
<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="{{ asset('sximo/file_upload/js/jquery.iframe-transport.js')}}"></script>
<!-- The basic File Upload plugin -->
<script src="{{ asset('sximo/file_upload/js/jquery.fileupload.js')}}"></script>
<!-- The File Upload processing plugin -->
<script src="{{ asset('sximo/file_upload/js/jquery.fileupload-process.js')}}"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="{{ asset('sximo/file_upload/js/jquery.fileupload-image.js')}}"></script>
<!-- The File Upload audio preview plugin -->
<script src="{{ asset('sximo/file_upload/js/jquery.fileupload-audio.js')}}"></script>
<!-- The File Upload video preview plugin -->
<script src="{{ asset('sximo/file_upload/js/jquery.fileupload-video.js')}}"></script>
<!-- The File Upload validation plugin -->
<script src="{{ asset('sximo/file_upload/js/jquery.fileupload-validate.js')}}"></script>
<!-- The File Upload user interface plugin -->
<script src="{{ asset('sximo/file_upload/js/jquery.fileupload-ui.js')}}"></script>
<!-- The main application script -->
<script> var baseUrl = "{{URL::to('property_images_uploads')}}"; </script>
<script src="{{ asset('sximo/file_upload/js/main.js')}}"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="js/cors/jquery.xdr-transport.js"></script>
<![endif]-->


<script>
	function delete_property_image(imgID)
	{
		if(imgID!='' && imgID>0)
		{
			var conf = confirm("Are you sure? you want to delete this record!");
			if(conf==true)
			{
				$.ajax({
					url: "{{ URL::to('delete_property_image')}}",
					type: "post",
					data: "img_id="+imgID,
					dataType: "json",
					success: function(data){
					  var html ='';
					  if(data.status=='error')
					  {
							html +='<div class="alert alert-danger fade in block-inner">';
							html +='<button data-dismiss="alert" class="close" type="button">×</button>';
							html +='<i class="icon-checkmark-circle"></i> Record Not Found </div>';
							$('.page-content-wrapper #formerrors').html(html);
							window.scrollTo(0, 0);
					  }
					  else{
							$('.prese tr.row'+imgID).remove();
							html +='<div class="alert alert-success fade in block-inner">';
							html +='<button data-dismiss="alert" class="close" type="button">×</button>';
							html +='<i class="icon-checkmark-circle"></i> Record Deleted Successfully </div>';
							$('.page-content-wrapper #formerrors').html(html);
							window.scrollTo(0, 0);
					  }
					}
				});
			}
		}
	}
	
	$(function(){
		$('input[type="checkbox"][id="check_all"]').on('ifChecked', function(){
			var reli = $(this).attr('rel');
			$('input[type="checkbox"].ff'+reli).iCheck('check');
		});
		
		$('input[type="checkbox"][id="check_all"]').on('ifUnchecked', function(){
			var reli = $(this).attr('rel');
			$('input[type="checkbox"].ff'+reli).iCheck('uncheck');
		});
	});
	
	function delete_selected_imgs(cls)
	{
		var conf = confirm("Are you sure? you want to delete this record!");
		if(conf==true)
		{
			var sList = "";
			$('input[type=checkbox].'+cls).each(function () {
				if(this.checked)
				{
					sList += (sList=="" ? $(this).val() : "," + $(this).val());
				}
				
			});
			
			$.ajax({
			  url: "{{ URL::to('delete_selected_image')}}",
			  type: "post",
			  data: "items=" + sList,
			  dataType: "json",
			  success: function(data){
				  var html ='';
				  if(data.status=='error')
				  {
						html +='<div class="alert alert-danger fade in block-inner">';
						html +='<button data-dismiss="alert" class="close" type="button">×</button>';
						html +='<i class="icon-checkmark-circle"></i> Record Not Found </div>';
						$('.page-content-wrapper #formerrors').html(html);
						window.scrollTo(0, 0);
				  }
				  else{
						$.each(data.imgs, function(idx, obj) {
							$('.prese tr.row'+obj).remove();
						});
						html +='<div class="alert alert-success fade in block-inner">';
						html +='<button data-dismiss="alert" class="close" type="button">×</button>';
						html +='<i class="icon-checkmark-circle"></i> Record Deleted Successfully </div>';
						$('.page-content-wrapper #formerrors').html(html);
						window.scrollTo(0, 0);
				  }
			  }
			});
		}
	}
</script>

@stop
