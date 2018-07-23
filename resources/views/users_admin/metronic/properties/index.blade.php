@extends('users_admin.metronic.layouts.app')

@section('page_name')
    Property  <small>View</small>
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
        <a href="javascript:;" class="m-nav__link"> 
            <span class="m-nav__link-text"> Properties </span> 
        </a> 
    </li>
@stop

@section('content')
<div class="row" style="display: none;">
    <div class="col-md-12 col-xs-12">
        @if($access['is_add'] ==1)
   		<a href="{{ URL::to('properties/update') }}" class="tips btn btn-sm btn-white"  title="{{ Lang::get('core.btn_create') }}">
		<i class="fa fa-plus-circle "></i>&nbsp;{{ Lang::get('core.btn_create') }}</a>
		@endif  
		@if($access['is_remove'] ==1)
		<a href="javascript://ajax"  onclick="SximoDelete();" class="tips btn btn-sm btn-white" title="{{ Lang::get('core.btn_remove') }}">
		<i class="fa fa-minus-circle "></i>&nbsp;{{ Lang::get('core.btn_remove') }}</a>
		@endif 
		<a href="{{ URL::to( 'properties/search') }}" class="btn btn-sm btn-white" onclick="SximoModal(this.href,'Advance Search'); return false;" ><i class="fa fa-search"></i> Search</a>				
		@if($access['is_excel'] ==1)
		<a href="{{ URL::to('properties/download?return='.$return) }}" class="tips btn btn-sm btn-white" title="{{ Lang::get('core.btn_download') }}">
		<i class="fa fa-download"></i>&nbsp;{{ Lang::get('core.btn_download') }} </a>
		@endif			
		
		<select name='property_category' id='property_category' style="height: 28px; margin-left: 5px;" onchange="fetchpropertycategory(this.value);" > 
			<option value="">-Select-</option>
			@if(!empty($fetch_cat))
				@foreach($fetch_cat as $catlist)
					<option value="{{$catlist->id}}" <?php echo ($curntcat == $catlist->id) ? " selected='selected' " : '' ; ?>>{{$catlist->category_name}}</option>
				@endforeach
			@endif
		</select>

		<select name='selstatus' id='selstatus' style="height: 28px; margin-left: 5px;" onchange="filterstatus(this.value);" > 
			<option value="">-Status-</option>
			<option value="active" <?php echo ($curstatus == 'active') ? " selected='selected' " : "selected='selected'" ; ?>>Active</option>
			<option value="inactive" <?php echo ($curstatus == 'inactive') ? " selected='selected' " : '' ; ?>>Inactive</option>
		</select>

		<div id="searchform-navbar" class="searchform-navbar" style="float:right;">
			<input  class="bh-search-input typeahead search-navbar search-box" name="s" id="search-navbar" placeholder="Search" type="text">
		</div>
    </div>
</div>    
<div class="row">
    
        @foreach ($rowData as $row)
        <?php 
        
        ?>
            <div class="col-md-4 col-xs-12">
            <!--begin:: Widgets/Activity-->
					<div class="m-portlet m-portlet--bordered-semi m-portlet--widget-fit m-portlet--full-height m-portlet--skin-light  m-portlet--rounded-force">
						<div class="m-portlet__head">
							<div class="m-portlet__head-caption">
								<div class="m-portlet__head-title">
									<span class="m-switch m-switch--outline m-switch--success switch-btn-bot-pad">
    									<label>
    										<input type="checkbox" checked="checked" name="">
    										<span></span>
    									</label>
    								</span>                                    
								</div>
							</div>
                            <div class="m-portlet__head-tools">
								<ul class="m-portlet__nav">
									<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
										<a href="{{ URL::to('properties/show/'.$row->id.'?return='.$return)}}" title="View Online" class="m-portlet__nav-link m-portlet__nav-link--icon m-portlet__nav-link--icon-xl">
											<i class="fa fa-globe m--font-light"></i>
										</a>
										
									</li>
								</ul>
							</div>
							<div class="m-portlet__head-tools">
								<ul class="m-portlet__nav">
									<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
										<a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon m-portlet__nav-link--icon-xl">
											<i class="fa fa-bars m--font-light"></i>
										</a>
										<div class="m-dropdown__wrapper">
											<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
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
																<a href="{{ URL::to('properties/update/'.$row->id.'?return='.$return) }}" class="m-nav__link">
																	<i class="m-nav__link-icon fa fa-search"></i>
																	<span class="m-nav__link-text">
																		Manage Hotel/Property
																	</span>
																</a>
														    </li> 
                                                            <li class="m-nav__item">
																<a href="{{ URL::to('properties_settings/'.$row->id.'/types')}}" class="m-nav__link">
																	<i class="m-nav__link-icon fa fa-search"></i>
																	<span class="m-nav__link-text">
																		Manage Room Types
																	</span>
																</a>
														    </li> 
                                                            <li class="m-nav__item">
																<a href="{{ URL::to('properties_settings/'.$row->id.'/rooms')}}" class="m-nav__link">
																	<i class="m-nav__link-icon fa fa-search"></i>
																	<span class="m-nav__link-text">
																		Manage Rooms
																	</span>
																</a>
														    </li> 
                                                            <li class="m-nav__item">
																<a href="{{ URL::to('properties_settings/'.$row->id.'/seasons')}}" class="m-nav__link">
																	<i class="m-nav__link-icon fa fa-search"></i>
																	<span class="m-nav__link-text">
																		Manage Seasons
																	</span>
																</a>
														    </li> 
                                                            <li class="m-nav__item">
																<a href="{{ URL::to('properties_settings/'.$row->id.'/price')}}" class="m-nav__link">
																	<i class="m-nav__link-icon fa fa-search"></i>
																	<span class="m-nav__link-text">
																		Manage Price
																	</span>
																</a>
														    </li> 
                                                            <li class="m-nav__item">
																<a href="{{ URL::to('properties_settings/'.$row->id.'/property_documents')}}" class="m-nav__link">
																	<i class="m-nav__link-icon fa fa-search"></i>
																	<span class="m-nav__link-text">
																		Property Documents
																	</span>
																</a>
														    </li> 
                                                            <li class="m-nav__item">
																<a href="{{ URL::to('properties_settings/'.$row->id.'/property_images')}}" class="m-nav__link">
																	<i class="m-nav__link-icon fa fa-search"></i>
																	<span class="m-nav__link-text">
																		Manage Images
																	</span>
																</a>
														    </li> 
                                                            <li class="m-nav__item">
																<a href="{{ URL::to('properties_settings/'.$row->id.'/gallery_images')}}" class="m-nav__link">
																	<i class="m-nav__link-icon fa fa-search"></i>
																	<span class="m-nav__link-text">
																		Manage Galleries
																	</span>
																</a>
														    </li> 
                                                            <li class="m-nav__item">
																<a href="#" class="m-nav__link">
																	<i class="m-nav__link-icon fa fa-search"></i>
																	<span class="m-nav__link-text">
																		Become Featured
																	</span>
																</a>
														    </li> <li class="m-nav__item">
																<a href="#" class="m-nav__link">
																	<i class="m-nav__link-icon fa fa-search"></i>
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
							<div class="m-widget17">
								<div class="m-widget17__visual m-widget17__visual--chart m-portlet-fit--top m-portlet-fit--sides m--bg-danger">
									<div class="m-widget17__chart" style="height:300px;">
                                        
                                        <div class="" style="background: url(http://staging.emporium-voyage.com/uploads/container_user_files/locations/hh/property-images/64070036634-63502574132.jpeg); width: 100%; background-size: cover; height:300px; opacity: 50%;">
                                        <div class="hotel_name">
                                            {{$row->property_name}}
                                        </div>
                                        </div>								
									</div>
								</div>
								<div class="m-widget17__stats">
									<div class="m-widget17__items m-widget17__items-col1">
										<div class="m-widget17__item">
											<span class="m-widget17__icon">
												<i class="flaticon-truck m--font-brand"></i>
											</span>
											<span class="m-widget17__subtitle">
											     Hotel Group 1
											</span>
											<span class="m-widget17__desc">
												15 Users
											</span>
										</div>
										<div class="m-widget17__item">
											<span class="m-widget17__icon">
												<i class="flaticon-paper-plane m--font-info"></i>
											</span>
											<span class="m-widget17__subtitle">
												Hotel Group 3
											</span>
											<span class="m-widget17__desc">
												72 Users
											</span>
										</div>
									</div>
									<div class="m-widget17__items m-widget17__items-col2">
										<div class="m-widget17__item">
											<span class="m-widget17__icon">
												<i class="flaticon-pie-chart m--font-success"></i>
											</span>
											<span class="m-widget17__subtitle">
												Hotel Group 2
											</span>
											<span class="m-widget17__desc">
												72 Users
											</span>
										</div>
										<div class="m-widget17__item">
											<span class="m-widget17__icon">
												<i class="flaticon-paper-plane m--font-info"></i>
											</span>
											<span class="m-widget17__subtitle">
												Hotel Group 4
											</span>
											<span class="m-widget17__desc">
												72 Users
											</span>
										</div>
									</div>
                                    
								</div>
							</div>
						</div>
					</div>
					<!--end:: Widgets/Activity-->
            </div>
        @endforeach
    
</div>
@stop
{{-- For custom style  --}}
@section('style')
    @parent
    <style>
        .m-pertlet_head-switch-btn{
            vertical-align: middle;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -ms-flex-line-pack: start;
            align-content: flex-start;
        }
        .switch-btn-bot-pad label{
            margin-bottom: 0px;
        }
        .m-widget17 .m-widget17__visual .m-widget17__chart{
            padding-top: 5rem;
        }
        .hotel_name{
            position: relative;
            color: #000;
            background: #fff;
            /* width: 50%; */
            text-align: center;
            margin: 0px auto;
            /* padding-top: 50px; */
            /* margin-top: 50px; */
            font-size: 25px;
            opacity: 0.6;
        }
    </style>
@endsection
