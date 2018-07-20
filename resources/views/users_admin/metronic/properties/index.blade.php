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
            <div class="col-md-4 col-xs-12">
            <!--begin:: Widgets/Activity-->
					<div class="m-portlet m-portlet--bordered-semi m-portlet--widget-fit m-portlet--full-height m-portlet--skin-light  m-portlet--rounded-force">
						<div class="m-portlet__head">
							<div class="m-portlet__head-caption">
								<div class="m-portlet__head-title">
									<h3 class="m-portlet__head-text m--font-light">
										{{$row->property_name}}
									</h3>
								</div>
							</div>
							<div class="m-portlet__head-tools">
								<ul class="m-portlet__nav">
									<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
										<a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon m-portlet__nav-link--icon-xl">
											<i class="fa fa-genderless m--font-light"></i>
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
                                                            @if($row->assign_detail_city!='0' && $row->assign_detail_city!='')
                                                                <li class="m-nav__item">
    																<a href="#" class="m-nav__link">
    																	<i class="m-nav__link-icon fa fa-check"></i>
    																	<span class="m-nav__link-text">
    																		City Assigned
    																	</span>
    																</a>
    															</li>
                                    							
                                    						@else
                                                                <li class="m-nav__item">
    																<a href="#" class="m-nav__link" title="please assign city">
    																	<i class="m-nav__link-icon fa fa-check"></i>
    																	<span class="m-nav__link-text">
                                    							             Assign city
                                                                        </span>
    																</a>
    															</li>
                                    						@endif
                                    						
                                    					 	@if($access['is_detail'] ==1)                                    						
                                                                <li class="m-nav__item">
    																<a href="{{ URL::to('properties/show/'.$row->id.'?return='.$return)}}" class="m-nav__link">
    																	<i class="m-nav__link-icon fa fa-search"></i>
    																	<span class="m-nav__link-text">
    																		{{ Lang::get('core.btn_view') }}
    																	</span>
    																</a>
															    </li>
                                    						@endif
                                    						@if($access['is_edit'] ==1)                                    						
                                                                <li class="m-nav__item">
    																<a href="{{ URL::to('properties/update/'.$row->id.'?return='.$return) }}" class="m-nav__link">
    																	<i class="m-nav__link-icon fa fa-edit"></i>
    																	<span class="m-nav__link-text">
    																		{{ Lang::get('core.btn_edit') }}
    																	</span>
    																</a>
															    </li>
                                    						@endif
                                                            <li class="m-nav__item">
																<a href="{{ URL::to('properties_settings/'.$row->id.'/types') }}" class="m-nav__link">
																	<i class="m-nav__link-icon fa fa-cogs"></i>
																	<span class="m-nav__link-text">
																		{{ Lang::get('core.btn_config') }}
																	</span>
																</a>
														    </li>
                                    											
                                    						@if($row->property_status==1)                                    							
                                                                <li class="m-nav__item">
    																<a href="#" class="m-nav__link" onclick="change_option(this,'property_status','{{$row->id}}',0);">
    																	<i class="m-nav__link-icon fa fa-check"></i>
    																	<span class="m-nav__link-text">
    																		Click to Disable
    																	</span>
    																</a>
    														    </li>
                                    						@else                                    							
                                                                <li class="m-nav__item">
    																<a href="#" class="m-nav__link" onclick="change_option(this,'property_status','{{$row->id}}',1);">
    																	<i class="m-nav__link-icon fa fa-check"></i>
    																	<span class="m-nav__link-text">
    																		Click to enable
    																	</span>
    																</a>
    														    </li>
                                    						@endif
                                                            <li class="m-nav__item">
																<a href="{{ URL::to('properties_settings/'.$row->id.'/property_images') }}" class="m-nav__link">
																	<i class="m-nav__link-icon fa fa-file-image-o"></i>
																	<span class="m-nav__link-text">
																		Property Images
																	</span>
																</a>
														    </li>
                                    						<li class="m-nav__item">
																<a href="#" class="m-nav__link" onclick="getseasonrates({{$row->id}});" data-toggle="modal" data-target="#psrModal">
																	<i class="m-nav__link-icon fa fa-usd"></i>
																	<span class="m-nav__link-text">
																		Rates
																	</span>
																</a>
														    </li>
                                    						
                                                            @if($row->approved==1)
                                                                <li class="m-nav__item">
    																<a href="#" class="m-nav__link" onclick="change_approval(this,'approved','{{$row->id}}',0);">
    																	<i class="m-nav__link-icon fa fa-check"></i>
    																	<span class="m-nav__link-text">
    																		Click to Unapprove
    																	</span>
    																</a>
    														    </li>
                                    						@else                                    							
                                                                <li class="m-nav__item">
    																<a href="#" class="m-nav__link" onclick="change_approval(this,'approved','{{$row->id}}',1);">
    																	<i class="m-nav__link-icon fa fa-times"></i>
    																	<span class="m-nav__link-text">
    																		Click to Approve
    																	</span>
    																</a>
    														    </li>
                                    						@endif															
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
									<div class="m-widget17__chart" style="height:50px;">										
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
												Hotel Group 2
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
												Hotel Group 3
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