@extends('users_admin.supplier.layouts.app')

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
            <span class="m-nav__link-text breadcrumb-end"> {{ucfirst(str_replace('_', ' ', $active))}} </span> 
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
            <a href="{{URL::to('flipviewpdf/Emporium-Voyage-Add-Property-Documents-help.pdf')}}" class="tips btn btn-xs btn-primary pull-right" title="" data-original-title="Add Property Documents" style="margin-right: 10px;" target="_blank"><i class="fa fa-edit"></i>&nbsp;View Documentation</a>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12">
        <!--begin::Portlet-->
		<div class="m-portlet">
            <div class="m-portlet__head">				
				<div class="m-portlet__head-tools margin-left-98">
					<ul class="m-portlet__nav bg-gray">
						<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
							<a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon m-portlet__nav-link--icon-xl">
								<span class="desk_bars1"></span>
                                <span class="desk_bars2"></span>
                                <span class="desk_bars3"></span>
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
													<a href="{{ URL::to('properties/update/'.$pid.'?return='.$return) }}" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Hotel/Property
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="{{ URL::to('properties_settings/'.$pid.'/types')}}" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Suite Types
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="{{ URL::to('properties_settings/'.$pid.'/rooms')}}" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Suites
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="{{ URL::to('properties_settings/'.$pid.'/seasons')}}" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Seasons
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="{{ URL::to('properties_settings/'.$pid.'/calendar')}}" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Reservation Management
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="{{ URL::to('properties_settings/'.$pid.'/price')}}" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Suite Price
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="{{ URL::to('properties_settings/'.$pid.'/property_documents')}}" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Property Documents
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="{{ URL::to('properties_settings/'.$pid.'/property_images')}}" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Property Images
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="{{ URL::to('properties_settings/'.$pid.'/gallery_images')}}" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Property Galleries
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
                <div class="m-portlet">
                    <div class="m-portlet__body">
                        <ul class="nav nav-tabs" role="tablist">
							<li class="nav-item">
                                <a class="nav-link active" href="#" data-target="#tab_hotel_brochure" data-toggle="tab">Hotel Brochure</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-target="#tab_restaurant_menu" data-toggle="tab">Restaurant Menu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-target="#tab_spa_brochure" data-toggle="tab">Spa Brochure</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-target="#tab_contracts" data-toggle="tab">Hotel Contracts</a>
                            </li>
                        </ul>
                        <div class="tab-content">
							<div class="tab-pane use-padding active" id="tab_hotel_brochure">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <h3 class="main-heading">{{ Lang::get('hotel-property.hotel-brochure-heading')}}</h3>
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
                                                {{ Lang::get('hotel-property.hotel-brochure-info')}}
                                           </div>
                                        </div>
                                    </div>
                                </div>
								<!-- The file upload form used as target for the file upload widget -->
								<form id="fileupload" class="fileupload" action="{{URL::to('property_images_uploads')}}" method="POST" enctype="multipart/form-data">
									<input type="hidden" name="propId" value="{{$pid}}" />
									<input type="hidden" name="uploadType" value="Hotel Brochure" />
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
											<a class="btn btn-success" @if(!empty($hotel_broch)) href="{{URL::to('folders/'.$hotel_broch[0]->folder_id.'?show=thumb')}}" @else href="#" @endif>
												<span>Re-Order</span>
											</a>
											<button type="button" class="btn btn-danger" onclick="delete_selected_imgs('hb');" >
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
											<div class="progress-extended">&nbsp;</div>
										</div>
									</div>
									<!-- The table listing the files available for upload/download -->
									<table role="presentation" class="table table-striped prese">
										<tbody class="files">
											@if(!empty($hotel_broch))
												<tr>
													<td colspan="5"><input type="checkbox" value="1" id="check_all_hb" class="check-all-hb"> Select all</td>
												</tr>
												@foreach($hotel_broch as $img)
													<tr class="template-download fade in row{{$img->id}}">
														<td>
															<input type="checkbox" name="compont[]" id="compont" value="{{$img->id}}" class="no-border check-files hb">
														</td>
														<td>
															<span class="preview">
																
																	@if($img->file_type=="application/pdf")
                                                                    <a href="{{URL::to('flipview')}}/{{$img->id}}" title="{{$img->file_name}}" target="_blank">
																		<img src="{{URL::to('uploads/images/bigpage_white_acrobat.png')}}">
                                                                    </a>
																	@elseif($img->file_type=="application/vnd.openxmlformats-officedocument.word")
                                                                    <a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_name}}" download="{{$img->file_name}}" data-gallery="#blueimp-gallery">
																		<img src="{{URL::to('uploads/images/doc.png')}}">
                                                                    </a>
																	@elseif($img->file_type=="application/vnd.openxmlformats-officedocument.spre")
                                                                    <a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_name}}" download="{{$img->file_name}}" data-gallery="#blueimp-gallery">
																		<img src="{{URL::to('uploads/images/xls.png')}}">
																	</a>	
																	@else
                                                                    <a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_name}}" download="{{$img->file_name}}" data-gallery="#blueimp-gallery">
																		<img src="{{URL::to('uploads/property_imgs_thumbs/'.$img->file_name)}}">
                                                                    </a>
																	@endif
																	
																
															</span>
														</td>
														<td>
															<p class="name">
																@if($img->file_type=="application/pdf")
                                                                <a href="{{URL::to('flipview')}}/{{$img->id}}" title="{{$img->file_display_name}}" target="_blank">
																	{{$img->file_display_name}}
                                                                </a>
																@elseif($img->file_type=="application/vnd.openxmlformats-officedocument.word")
                                                                <a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_display_name}}" download="{{$img->file_name}}" data-gallery="#blueimp-gallery">
																	{{$img->file_display_name}}
                                                                </a>
																@elseif($img->file_type=="application/vnd.openxmlformats-officedocument.spre")
                                                                <a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_display_name}}" download="{{$img->file_name}}" data-gallery="#blueimp-gallery">
																	{{$img->file_display_name}}
																</a>	
																@else
                                                                <a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_display_name}}" download="{{$img->file_name}}" data-gallery="#blueimp-gallery">
																	{{$img->file_display_name}}
                                                                </a>
																@endif
                                                                
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
								<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
									<div class="slides"></div>
									<h3 class="title"></h3>
									<a class="prev">‹</a>
									<a class="next">›</a>
									<a class="close">×</a>
									<a class="play-pause"></a>
									<ol class="indicator"></ol>
								</div>
							</div>
							
							<div class="tab-pane use-padding" id="tab_restaurant_menu">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <h3 class="main-heading">{{ Lang::get('hotel-property.hotel-menu-heading')}}</h3>
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
                                                {{ Lang::get('hotel-property.hotel-menu-info')}}
                                           </div>
                                        </div>
                                    </div>
                                </div>
								<!-- The file upload form used as target for the file upload widget -->
								<form id="fileupload" class="fileupload" action="{{URL::to('property_images_uploads')}}" method="POST" enctype="multipart/form-data">
									<input type="hidden" name="propId" value="{{$pid}}" />
									<input type="hidden" name="uploadType" value="Restaurant Menu" />
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
											<a class="btn btn-success" @if(!empty($restru_menu)) href="{{URL::to('folders/'.$restru_menu[0]->folder_id.'?show=thumb')}}" @else href="#" @endif>
												<span>Re-Order</span>
											</a>
											<button type="button" class="btn btn-danger" onclick="delete_selected_imgs('rm');" >
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
											<div class="progress-extended">&nbsp;</div>
										</div>
									</div>
									<!-- The table listing the files available for upload/download -->
									<table role="presentation" class="table table-striped prese">
										<tbody class="files">
											@if(!empty($restru_menu))
												<tr>
													<td colspan="5"><input type="checkbox" value="1" id="check_all_rm" class="check-all-rm"> Select all</td>
												</tr>
												@foreach($restru_menu as $img)
													<tr class="template-download fade in row{{$img->id}}">
														<td>
															<input type="checkbox" name="compont[]" id="compont" value="{{$img->id}}" class="no-border check-files rm">
														</td>
														<td>
															<span class="preview">
                                                                @if($img->file_type=="application/pdf")
                                                                <a href="{{URL::to('flipview')}}/{{$img->id}}" title="{{$img->file_name}}" target="_blank">
																	<img src="{{URL::to('uploads/images/bigpage_white_acrobat.png')}}">
                                                                </a>
																@elseif($img->file_type=="application/vnd.openxmlformats-officedocument.word")
                                                                <a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_name}}" download="{{$img->file_name}}" data-gallery="#data-gallery-resto">
																	<img src="{{URL::to('uploads/images/doc.png')}}">
                                                                </a>
																@elseif($img->file_type=="application/vnd.openxmlformats-officedocument.spre")
                                                                <a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_name}}" download="{{$img->file_name}}" data-gallery="#data-gallery-resto">
																	<img src="{{URL::to('uploads/images/xls.png')}}">
																</a>	
																@else
                                                                <a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_name}}" download="{{$img->file_name}}" data-gallery="#data-gallery-resto">
																	<img src="{{URL::to('uploads/property_imgs_thumbs/'.$img->file_name)}}">
                                                                </a>
																@endif
															</span>
														</td>
														<td>
															<p class="name">
																@if($img->file_type=="application/pdf")
                                                                <a href="{{URL::to('flipview')}}/{{$img->id}}" title="{{$img->file_display_name}}" target="_blank">
																	{{$img->file_display_name}}
                                                                </a>
																@elseif($img->file_type=="application/vnd.openxmlformats-officedocument.word")
                                                                <a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_display_name}}" download="{{$img->file_name}}" data-gallery="#data-gallery-resto">
																	{{$img->file_display_name}}
                                                                </a>
																@elseif($img->file_type=="application/vnd.openxmlformats-officedocument.spre")
                                                                <a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_display_name}}" download="{{$img->file_name}}" data-gallery="#data-gallery-resto">
																	{{$img->file_display_name}}
																</a>	
																@else
                                                                <a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_display_name}}" download="{{$img->file_name}}" data-gallery="#data-gallery-resto">
																	{{$img->file_display_name}}
                                                                </a>
																@endif
                                                                
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
								<div id="data-gallery-resto" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
									<div class="slides"></div>
									<h3 class="title"></h3>
									<a class="prev">‹</a>
									<a class="next">›</a>
									<a class="close">×</a>
									<a class="play-pause"></a>
									<ol class="indicator"></ol>
								</div>
							</div>
							<div class="tab-pane use-padding" id="tab_spa_brochure">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <h3 class="main-heading">{{ Lang::get('hotel-property.spa-brochure-heading')}}</h3>
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
                                                {{ Lang::get('hotel-property.spa-brochure-info')}}
                                           </div>
                                        </div>
                                    </div>
                                </div>
								<!-- The file upload form used as target for the file upload widget -->
								<form id="fileupload" class="fileupload" action="{{URL::to('property_images_uploads')}}" method="POST" enctype="multipart/form-data">
									<input type="hidden" name="propId" value="{{$pid}}" />
									<input type="hidden" name="uploadType" value="Spa Brochure" />
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
											<a class="btn btn-success" @if(!empty($spa_broch)) href="{{URL::to('folders/'.$spa_broch[0]->folder_id.'?show=thumb')}}" @else href="#" @endif>
												<span>Re-Order</span>
											</a>
											<button type="button" class="btn btn-danger" onclick="delete_selected_imgs('sb');" >
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
											<div class="progress-extended">&nbsp;</div>
										</div>
									</div>
									<!-- The table listing the files available for upload/download -->
									<table role="presentation" class="table table-striped prese">
										<tbody class="files">
											@if(!empty($spa_broch))
												<tr>
													<td colspan="5"><input type="checkbox" value="1" id="check_all_sb" class="check-all-sb"> Select all</td>
												</tr>
												@foreach($spa_broch as $img)
													<tr class="template-download fade in row{{$img->id}}">
														<td>
															<input type="checkbox" name="compont[]" id="compont" value="{{$img->id}}" class="no-border check-files sb">
														</td>
														<td>
															<span class="preview">
                                                                @if($img->file_type=="application/pdf")
                                                                <a href="{{URL::to('flipview')}}/{{$img->id}}" title="{{$img->file_name}}" target="_blank">
																	<img src="{{URL::to('uploads/images/bigpage_white_acrobat.png')}}">
                                                                </a>
																@elseif($img->file_type=="application/vnd.openxmlformats-officedocument.word")
                                                                <a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_name}}" download="{{$img->file_name}}" data-gallery="#data-gallery-spa">
																	<img src="{{URL::to('uploads/images/doc.png')}}">
                                                                </a>
																@elseif($img->file_type=="application/vnd.openxmlformats-officedocument.spre")
                                                                <a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_name}}" download="{{$img->file_name}}" data-gallery="#data-gallery-spa">
																	<img src="{{URL::to('uploads/images/xls.png')}}">
																</a>	
																@else
                                                                <a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_name}}" download="{{$img->file_name}}" data-gallery="#data-gallery-spa">
																	<img src="{{URL::to('uploads/property_imgs_thumbs/'.$img->file_name)}}">
                                                                </a>
																@endif
																
															</span>
														</td>
														<td>
															<p class="name">
                                                                @if($img->file_type=="application/pdf")
                                                                <a href="{{URL::to('flipview')}}/{{$img->id}}" title="{{$img->file_display_name}}" target="_blank">
																	{{$img->file_display_name}}
                                                                </a>
																@elseif($img->file_type=="application/vnd.openxmlformats-officedocument.word")
                                                                <a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_display_name}}" download="{{$img->file_name}}" data-gallery="#data-gallery-spa">
																	{{$img->file_display_name}}
                                                                </a>
																@elseif($img->file_type=="application/vnd.openxmlformats-officedocument.spre")
                                                                <a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_display_name}}" download="{{$img->file_name}}" data-gallery="#data-gallery-spa">
																	{{$img->file_display_name}}
																</a>	
																@else
                                                                <a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_display_name}}" download="{{$img->file_name}}" data-gallery="#data-gallery-spa">
																	{{$img->file_display_name}}
                                                                </a>
																@endif
																
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
								<div id="data-gallery-spa" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
									<div class="slides"></div>
									<h3 class="title"></h3>
									<a class="prev">‹</a>
									<a class="next">›</a>
									<a class="close">×</a>
									<a class="play-pause"></a>
									<ol class="indicator"></ol>
								</div>
							</div>
							<div class="tab-pane use-padding" id="tab_contracts">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <h3 class="main-heading">{{ Lang::get('hotel-property.contract-heading')}}</h3>
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
                                                {{ Lang::get('hotel-property.contract-info')}}
                                           </div>
                                        </div>
                                    </div>
                                </div>
								<!-- The file upload form used as target for the file upload widget -->
								<form id="fileupload" class="fileupload" action="{{URL::to('property_images_uploads')}}" method="POST" enctype="multipart/form-data">
									<input type="hidden" name="propId" value="{{$pid}}" />
									<input type="hidden" name="uploadType" value="Hotel Contracts" />
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
											<a class="btn btn-success" @if(!empty($hotelcontacts)) href="{{URL::to('folders/'.$hotelcontacts[0]->folder_id.'?show=thumb')}}" @else href="#" @endif>
												<span>Re-Order</span>
											</a>
											<button type="button" class="btn btn-danger" onclick="delete_selected_imgs('hc');" >
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
											<div class="progress-extended">&nbsp;</div>
										</div>
									</div>
									<!-- The table listing the files available for upload/download -->
									<table role="presentation" class="table table-striped prese">
										<tbody class="files">
											@if(!empty($hotelcontacts))
												<tr>
													<td colspan="5"><input type="checkbox" value="1" id="check_all_hc" class="check-all-hc"> Select all</td>
												</tr>
												@foreach($hotelcontacts as $img)
													<tr class="template-download fade in row{{$img->id}}">
														<td>
															<input type="checkbox" name="compont[]" id="compont" value="{{$img->id}}" class="no-border check-files hc">
														</td>
														<td>
															<span class="preview">
                                                                @if($img->file_type=="application/pdf")
                                                                <a href="{{URL::to('flipview')}}/{{$img->id}}" title="{{$img->file_name}}" target="_blank">
																	<img src="{{URL::to('uploads/images/bigpage_white_acrobat.png')}}">
                                                                </a>
																@elseif($img->file_type=="application/vnd.openxmlformats-officedocument.word")
                                                                <a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_name}}" download="{{$img->file_name}}" data-gallery="#data-gallery-contracts">
																	<img src="{{URL::to('uploads/images/doc.png')}}">
                                                                </a>
																@elseif($img->file_type=="application/vnd.openxmlformats-officedocument.spre")
                                                                <a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_name}}" download="{{$img->file_name}}" data-gallery="#data-gallery-contracts">
																	<img src="{{URL::to('uploads/images/xls.png')}}">
																</a>	
																@else
                                                                <a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_name}}" download="{{$img->file_name}}" data-gallery="#data-gallery-contracts">
																	<img src="{{URL::to('uploads/property_imgs_thumbs/'.$img->file_name)}}">
                                                                </a>
																@endif																
															</span>
														</td>
														<td>
															<p class="name">
																@if($img->file_type=="application/pdf")
                                                                <a href="{{URL::to('flipview')}}/{{$img->id}}" title="{{$img->file_display_name}}" target="_blank">
																	{{$img->file_display_name}}
                                                                </a>
																@elseif($img->file_type=="application/vnd.openxmlformats-officedocument.word")
                                                                <a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_display_name}}" download="{{$img->file_name}}" data-gallery="#data-gallery-contracts>
																	{{$img->file_display_name}}
                                                                </a>
																@elseif($img->file_type=="application/vnd.openxmlformats-officedocument.spre")
                                                                <a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_display_name}}" download="{{$img->file_name}}" data-gallery="#data-gallery-contracts">
																	{{$img->file_display_name}}
																</a>	
																@else
                                                                <a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_display_name}}" download="{{$img->file_name}}" data-gallery="#data-gallery-contracts">
																	{{$img->file_display_name}}
                                                                </a>
																@endif
                                                                
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
								<div id="data-gallery-contracts" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
									<div class="slides"></div>
									<h3 class="title"></h3>
									<a class="prev">‹</a>
									<a class="next">›</a>
									<a class="close">×</a>
									<a class="play-pause"></a>
									<ol class="indicator"></ol>
								</div>
							</div>
						</div>
                    </div>
                </div>
				
            </div>
        </div>
        </div>
     </div>
@stop
{{-- For custom style  --}}
@section('style')
    @parent
    <link href="{{ asset('sximo/css/bookingSys.css')}}" rel="stylesheet">
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
		$('input[type="checkbox"][id="check_all_hb"]').on('ifChecked', function(){
			$('input[type="checkbox"].hb').iCheck('check');
		});
		
		$('input[type="checkbox"][id="check_all_hb"]').on('ifUnchecked', function(){
			$('input[type="checkbox"].hb').iCheck('uncheck');
		});
		
		$('input[type="checkbox"][id="check_all_rm"]').on('ifChecked', function(){
			$('input[type="checkbox"].rm').iCheck('check');
		});
		
		$('input[type="checkbox"][id="check_all_rm"]').on('ifUnchecked', function(){
			$('input[type="checkbox"].rm').iCheck('uncheck');
		});
		
		$('input[type="checkbox"][id="check_all_sb"]').on('ifChecked', function(){
			$('input[type="checkbox"].sb').iCheck('check');
		});
		
		$('input[type="checkbox"][id="check_all_sb"]').on('ifUnchecked', function(){
			$('input[type="checkbox"].sb').iCheck('uncheck');
		});
		
		$('input[type="checkbox"][id="check_all_hc"]').on('ifChecked', function(){
			$('input[type="checkbox"].hc').iCheck('check');
		});
		
		$('input[type="checkbox"][id="check_all_hc"]').on('ifUnchecked', function(){
			$('input[type="checkbox"].hc').iCheck('uncheck');
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
