@extends('users_admin.metronic.layouts.app')

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
            <a href="{{URL::to('flipviewpdf/Emporium-Voyage-Add-Suite-Price-help.pdf')}}" class="tips btn btn-xs btn-primary pull-right" title="" data-original-title="Add Suite Price" style="margin-right: 10px;" target="_blank"><i class="fa fa-edit"></i>&nbsp;View Documentation</a>
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
				<div class="tab-content">
					<div class="tab-pane active">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <h3 class="main-heading">{{ Lang::get('hotel-property.price-heading')}}</h3>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                                <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
                                   <div class="m-alert__icon">
                                        <i class="flaticon-exclamation-1"></i>
                                        <span></span>
                                   </div>
                                   <div class="m-alert__text">                
                                        {{ Lang::get('hotel-property.price-info')}}
                                   </div>
                                </div>
                            </div>
                        </div>
                        @if(!empty($room_prices))
						{{--*/ $p=1; /*--}}
						@foreach($room_prices as $cat)
							<form id="add_property_room_price_setup-{{$p}}" class="add_property_room_price_setup">
								<input type="hidden" name="property_id" value="{{$pid}}" >
								<input type="hidden" name="category_id" value="{{$cat['data']->id}}" >
								<input type="hidden" name="edit_room_price_id[]" value="{{ (array_key_exists('rooms_price', $cat)) ? $cat['rooms_price'][0]->id : '' }}" >
								<input type="hidden" name="seasonid[]" value="0" />
								<div class="row">
									<div class="col-lg-8">
										<h3>{{$cat['data']->category_name}}</h3>
									</div>
									<div class="col-lg-4 m--align-right">
										<div class="butt margin-top-10">
											<button type="submit" class="btn btn-success b-btn"><i class="fa fa-save"></i> Save</button>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-2">
										<label for="season">Season</label>
									</div>
									<div class="col-lg-10">
										<div class="row">
											<div class="col-lg-2">
												<label for="rack rate">Rack Rate</label>
											</div>
											<div class="col-lg-2">
												<label for="single price">Single Price</label>
											</div>
											<div class="col-lg-2">
												<label for="extra (adult)">Extra (Adult)</label>
											</div>
											<div class="col-lg-2">
												<label for="extra (junior)">Extra (Junior)</label>
											</div>
											<div class="col-lg-2">
												<label for="extra (baby)">Extra (Baby)</label>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-lg-2">
										<div style="background:#ccc; text-align:center; padding:40px 0;">Normal Price</div>
									</div>
									<div class="col-lg-10">
										<div class="row">
											<div class="col-lg-2">
												<input name="rack_rate[]" id="rack_rate" type="text" class="form-control input-sm priceinput" value="{{ (array_key_exists('rooms_price', $cat)) ? $cat['rooms_price'][0]->rack_rate : '' }}" data-rule-number="true" required="required" /> 
												<i class="fa fa-times iconmar"></i>
											</div>
											<div class="col-lg-2">
												<input name="single_price[]" id="single_price" type="text" class="form-control input-sm priceinput" value="{{ (array_key_exists('rooms_price', $cat)) ? $cat['rooms_price'][0]->single_price : '' }}" /> 
												<i class="fa fa-times iconmar"></i>
											</div>
											<div class="col-lg-2">
												<input name="extra_adult[]" id="extra_adult" type="text" class="form-control input-sm priceinput" value="{{ (array_key_exists('rooms_price', $cat)) ? ($cat['rooms_price'][0]->extra_adult>0) ? $cat['rooms_price'][0]->extra_adult : '' : '' }}" data-rule-number="true" /> 
												<i class="fa fa-times iconmar"></i>
											</div>
											<div class="col-lg-2">
												<input name="extra_junior[]" id="extra_junior" type="text" class="form-control input-sm priceinput" value="{{ (array_key_exists('rooms_price', $cat)) ? ($cat['rooms_price'][0]->extra_junior>0) ? $cat['rooms_price'][0]->extra_junior : '' : '' }}" data-rule-number="true"  /> 
												<i class="fa fa-times iconmar"></i>
											</div>
											<div class="col-lg-2">
												<input name="extra_baby[]" id="extra_baby" type="text" class="form-control input-sm priceinput" value="{{ (array_key_exists('rooms_price', $cat)) ? ($cat['rooms_price'][0]->extra_baby>0) ? $cat['rooms_price'][0]->extra_baby : '' : '' }}" data-rule-number="true" /> 
												<i class="fa fa-times iconmar"></i>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-12">
												<div class="daysinput">
													<label for="monday_price">Monday</label>
													<input name="monday_price[]" id="monday_price" type="text" class="form-control input-sm" value="{{ (array_key_exists('rooms_price', $cat)) ? ($cat['rooms_price'][0]->monday_price>0) ? $cat['rooms_price'][0]->monday_price : '' : '' }}" data-rule-number="true" />
													<i class="fa fa-times iconmar"></i>
												</div>
												<div class="daysinput">
													<label for="tuesday_price">Tuesday</label>
													<input name="tuesday_price[]" id="tuesday_price" type="text" class="form-control input-sm" value="{{ (array_key_exists('rooms_price', $cat)) ? ($cat['rooms_price'][0]->tuesday_price>0) ? $cat['rooms_price'][0]->tuesday_price : '' : '' }}" data-rule-number="true" />
													<i class="fa  fa-times iconmar"></i>
												</div>
												<div class="daysinput">
													<label for="wednesday_price">Wednesday</label>
													<input name="wednesday_price[]" id="wednesday_price" type="text" class="form-control input-sm" value="{{ (array_key_exists('rooms_price', $cat)) ? ($cat['rooms_price'][0]->wednesday_price>0) ? $cat['rooms_price'][0]->wednesday_price : '' : '' }}" data-rule-number="true" />
													<i class="fa fa-times iconmar"></i>
												</div>
												<div class="daysinput">
													<label for="thursday_price">Thursday</label>
													<input name="thursday_price[]" id="thursday_price" type="text" class="form-control input-sm" value="{{ (array_key_exists('rooms_price', $cat)) ? ($cat['rooms_price'][0]->thursday_price>0) ? $cat['rooms_price'][0]->thursday_price : '' : '' }}" data-rule-number="true" />
													<i class="fa  fa-times iconmar"></i>
												</div>
												<div class="daysinput">
													<label for="friday_price">Friday</label>
													<input name="friday_price[]" id="friday_price" type="text" class="form-control input-sm" value="{{ (array_key_exists('rooms_price', $cat)) ? ($cat['rooms_price'][0]->friday_price>0) ? $cat['rooms_price'][0]->friday_price : '' : '' }}" data-rule-number="true" />
													<i class="fa  fa-times iconmar"></i>
												</div>
												<div class="daysinput">
													<label for="saturday_price">Saturday</label>
													<input name="saturday_price[]" id="saturday_price" type="text" class="form-control input-sm" value="{{ (array_key_exists('rooms_price', $cat)) ? ($cat['rooms_price'][0]->saturday_price>0) ? $cat['rooms_price'][0]->saturday_price : '' : '' }}" data-rule-number="true" />
													<i class="fa  fa-times iconmar"></i>
												</div>
												<div class="daysinput">
													<label for="sunday_price">Sunday</label>
													<input name="sunday_price[]" id="sunday_price" type="text" class="form-control input-sm" value="{{ (array_key_exists('rooms_price', $cat)) ? ($cat['rooms_price'][0]->sunday_price>0) ? $cat['rooms_price'][0]->sunday_price : '' : '' }}" data-rule-number="true" />
													<i class="fa  fa-times iconmar"></i>
												</div>
											</div>
										</div>
									</div>
								</div>
								@if(!empty($Seasons))
									@foreach($Seasons as $season)
										<input type="hidden" name="seasonid[]" value="{{$season->id}}" />
										<input type="hidden" name="edit_room_price_id[]" value="{{ (array_key_exists('rooms_price', $cat) && array_key_exists($season->id, $cat['rooms_price'])) ? $cat['rooms_price'][$season->id]->id : '' }}" >
										<div class="row">
											<div class="col-lg-2">
												<div style="background:#ccc; text-align:center; padding:40px 0;">{{$season->season_name}}</div>
											</div>
											<div class="col-lg-10">
												<div class="row">
													<div class="col-lg-2">
														<input name="rack_rate[]" id="rack_rate" type="text" class="form-control input-sm priceinput" value="{{ (array_key_exists('rooms_price', $cat) && array_key_exists($season->id, $cat['rooms_price'])) ?  $cat['rooms_price'][$season->id]->rack_rate : '' }}" data-rule-number="true" /> 
														<i class="fa fa-times iconmar"></i>
													</div>
													<div class="col-lg-2">
														<input name="single_price[]" id="single_price" type="text" class="form-control input-sm priceinput" value="{{ (array_key_exists('rooms_price', $cat) && array_key_exists($season->id, $cat['rooms_price'])) ? $cat['rooms_price'][$season->id]->single_price : '' }}" /> 
														<i class="fa fa-times iconmar"></i>
													</div>
													<div class="col-lg-2">
														<input name="extra_adult[]" id="extra_adult" type="text" class="form-control input-sm priceinput" value="{{ (array_key_exists('rooms_price', $cat) && array_key_exists($season->id, $cat['rooms_price'])) ? ($cat['rooms_price'][$season->id]->extra_adult>0) ? $cat['rooms_price'][$season->id]->extra_adult : '' : '' }}" data-rule-number="true" /> 
														<i class="fa fa-times iconmar"></i>
													</div>
													<div class="col-lg-2">
														<input name="extra_junior[]" id="extra_junior" type="text" class="form-control input-sm priceinput" value="{{ (array_key_exists('rooms_price', $cat) && array_key_exists($season->id, $cat['rooms_price'])) ? ($cat['rooms_price'][$season->id]->extra_junior>0) ? $cat['rooms_price'][$season->id]->extra_junior : '' : '' }}" data-rule-number="true"  /> 
														<i class="fa fa-times iconmar"></i>
													</div>
													<div class="col-lg-2">
														<input name="extra_baby[]" id="extra_baby" type="text" class="form-control input-sm priceinput" value="{{ (array_key_exists('rooms_price', $cat) && array_key_exists($season->id, $cat['rooms_price'])) ? ($cat['rooms_price'][$season->id]->extra_baby>0) ? $cat['rooms_price'][$season->id]->extra_baby : '' : '' }}" data-rule-number="true" /> 
														<i class="fa fa-times iconmar"></i>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-12">
														<div class="daysinput">
															<label for="monday_price">Monday</label>
															<input name="monday_price[]" id="monday_price" type="text" class="form-control input-sm" value="{{ (array_key_exists('rooms_price', $cat) && array_key_exists($season->id, $cat['rooms_price'])) ? ($cat['rooms_price'][$season->id]->monday_price>0) ? $cat['rooms_price'][$season->id]->monday_price : '' : '' }}" data-rule-number="true" />
															<i class="fa fa-times iconmar"></i>
														</div>
														<div class="daysinput">
															<label for="tuesday_price">Tuesday</label>
															<input name="tuesday_price[]" id="tuesday_price" type="text" class="form-control input-sm" value="{{ (array_key_exists('rooms_price', $cat) && array_key_exists($season->id, $cat['rooms_price'])) ? ($cat['rooms_price'][$season->id]->tuesday_price>0) ? $cat['rooms_price'][$season->id]->tuesday_price : '' : '' }}" data-rule-number="true" />
															<i class="fa  fa-times iconmar"></i>
														</div>
														<div class="daysinput">
															<label for="wednesday_price">Wednesday</label>
															<input name="wednesday_price[]" id="wednesday_price" type="text" class="form-control input-sm" value="{{ (array_key_exists('rooms_price', $cat) && array_key_exists($season->id, $cat['rooms_price'])) ? ($cat['rooms_price'][$season->id]->wednesday_price>0) ? $cat['rooms_price'][$season->id]->wednesday_price : '' : '' }}" data-rule-number="true" />
															<i class="fa fa-times iconmar"></i>
														</div>
														<div class="daysinput">
															<label for="thursday_price">Thursday</label>
															<input name="thursday_price[]" id="thursday_price" type="text" class="form-control input-sm" value="{{ (array_key_exists('rooms_price', $cat) && array_key_exists($season->id, $cat['rooms_price'])) ? ($cat['rooms_price'][$season->id]->thursday_price>0) ? $cat['rooms_price'][$season->id]->thursday_price : '' : '' }}" data-rule-number="true" />
															<i class="fa  fa-times iconmar"></i>
														</div>
														<div class="daysinput">
															<label for="friday_price">Friday</label>
															<input name="friday_price[]" id="friday_price" type="text" class="form-control input-sm" value="{{ (array_key_exists('rooms_price', $cat) && array_key_exists($season->id, $cat['rooms_price'])) ? ($cat['rooms_price'][$season->id]->friday_price>0) ? $cat['rooms_price'][$season->id]->friday_price : '' : '' }}" data-rule-number="true" />
															<i class="fa  fa-times iconmar"></i>
														</div>
														<div class="daysinput">
															<label for="saturday_price">Saturday</label>
															<input name="saturday_price[]" id="saturday_price" type="text" class="form-control input-sm" value="{{ (array_key_exists('rooms_price', $cat) && array_key_exists($season->id, $cat['rooms_price'])) ? ($cat['rooms_price'][$season->id]->saturday_price>0) ? $cat['rooms_price'][$season->id]->saturday_price : '' : '' }}" data-rule-number="true" />
															<i class="fa  fa-times iconmar"></i>
														</div>
														<div class="daysinput">
															<label for="sunday_price">Sunday</label>
															<input name="sunday_price[]" id="sunday_price" type="text" class="form-control input-sm" value="{{ (array_key_exists('rooms_price', $cat) && array_key_exists($season->id, $cat['rooms_price'])) ? ($cat['rooms_price'][$season->id]->sunday_price>0) ? $cat['rooms_price'][$season->id]->sunday_price : '' : '' }}" data-rule-number="true" />
															<i class="fa  fa-times iconmar"></i>
														</div>
													</div>
												</div>
											</div>
										</div>										
									@endforeach
								@endif
							</form>
							<hr>
							{{--*/ $p++ /*--}}
						@endforeach
					@endif
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
    <style>
        .priceinput { width : 100px; float:left;}
        .daysinput { width : 100px; float:left; margin:10px;}
        .daysinput input { width : 80px; float:left;}
        .iconmar { margin: 8px 0 0 5px; }
        .daysinput .iconmar { margin: 8px 0 0 5px; float:left; }
    </style>
@endsection

@section('custom_js_script')
<script src="{{ asset('sximo/js/jquery.validate.js')}}"></script>
<script>
    $(document).ready(function () {
    	
    	$(document).on('click', '.btn', function (){
    		 var frmid = $(this).parents('form.add_property_room_price_setup').attr('id');
    		  $('#'+frmid).validate({
    			submitHandler: function (form) {
    				 save_rooms_price_tabdata(frmid);
    				 return false; // required to block normal submit since you used ajax
    			 }
    		 });
    	 });
    });

	function save_rooms_price_tabdata(formid)
	{
		if(formid!='')
		{
			$.ajax({
			  url: "{{ URL::to('add_property_category_rooms_price')}}",
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
                    toastr.error("Error occured while inserting.");
					window.scrollTo(0, 0);
				}
				else
				{
					html +='<div class="alert alert-success fade in block-inner">';
					html +='<button data-dismiss="alert" class="close" type="button">×</button>';
					html +='<i class="icon-checkmark-circle"></i> Record Updated Successfully </div>';
					$('.page-content-wrapper #formerrors').html(html);
                    toastr.success("Price Added Successfully");
					window.scrollTo(0, 0);
				}
			  }
			});
		}
	}
	
</script>
@stop
