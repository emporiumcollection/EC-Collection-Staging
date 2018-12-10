@extends('users_admin.metronic.layouts.app')

@section('page_name')
    Property  <small>Arrivals, Departures &amp; Cancelations</small>
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
        <a href="{{ URL::to('arrivaldeparture')}}" class="m-nav__link"> 
            <span class="m-nav__link-text breadcrumb-end"> Arrivals, Departures &amp; Cancelations </span> 
        </a> 
    </li>
@stop

@section('content')
<div class="row">
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        <h2>Arrivals, Departures &amp; Cancelations</h2>
    </div> 
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ornare diam at convallis lacinia. Duis a sapien et erat finibus molestie eu id nisi. Integer nibh elit, blandit ac volutpat eget, tempus eget enim. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas mollis dictum risus. Vivamus aliquam at elit non dictum. Integer nisi ante, interdum at purus vitae, rhoncus bibendum dui. Praesent pharetra augue at ultrices facilisis. Vestibulum erat urna, iaculis et purus in, fermentum varius nibh.
    </div>
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        <hr />
    </div> 
    <div class="col-sm-12 col-md-12 col-xl-12">
        <!--begin:: Widgets/Sale Reports-->
		<div class="m-portlet m-portlet--full-height ">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							Guest Arrivals, Departures &amp; Cancelations
						</h3>
					</div>
				</div>
				<div class="m-portlet__head-tools">
                    <div class="arrival_departure">
                        <select class="form-control" name="dd_arrival_departure" id="dd_arrival_departure">
                            <option value="arrival">Arrival</option>
                            <option value="departure">Departure</option>
                            <option value="departure">Cancelations</option>
                        </select>
                    </div>
					<ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm">
						<li class="nav-item m-tabs__item">
							<a class="nav-link m-tabs__link active m_tab1_content" data-reportfor='all'>
								All
							</a>
						</li>
                        <li class="nav-item m-tabs__item">
							<a class="nav-link m-tabs__link m_tab1_content" data-reportfor='today'>
								Today
							</a>
						</li>
						<li class="nav-item m-tabs__item">
							<a class="nav-link m-tabs__link m_tab1_content" data-reportfor='month'>
								Month
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="m-widget11">
							<div class="table-responsive">
								<!--begin::Table-->
								<table class="table">
									<!--begin::Thead-->
									<thead>
										<tr>														
											<td>
												Guest Name
											</td>
											<td>
												Adult #
											</td>	
                                            <td>
												Child #
											</td>													
											<td class="m--align-right">
												Date of Arrival
											</td>
                                            <td class="m--align-right">
												Date of Departure
											</td>
										</tr>
									</thead>
									<!--end::Thead-->
<!--begin::Tbody-->
									<tbody id="table_data">
										
									</tbody>
									<!--end::Tbody-->
								</table>
								<!--end::Table-->
							</div>
							
						</div>
			</div>
		</div> 
		<!--end:: Widgets/Sale Reports-->
    </div>	
    <?php /* <div class="col-sm-12 col-md-8 col-xl-8">
        <div class="m-portlet m-portlet--mobile ">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							Guest Arrivals | Departures | Cancelations
						</h3>
					</div>
				</div>
				<div class="m-portlet__head-tools">
					<ul class="m-portlet__nav">
						<li class="m-portlet__nav-item">
							<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
								<a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
									<i class="la la-ellipsis-h m--font-brand"></i>
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
														<a href="" class="m-nav__link">
															<i class="m-nav__link-icon flaticon-share"></i>
															<span class="m-nav__link-text">
																Create Post
															</span>
														</a>
													</li>
													<li class="m-nav__item">
														<a href="" class="m-nav__link">
															<i class="m-nav__link-icon flaticon-chat-1"></i>
															<span class="m-nav__link-text">
																Send Messages
															</span>
														</a>
													</li>
													<li class="m-nav__item">
														<a href="" class="m-nav__link">
															<i class="m-nav__link-icon flaticon-multimedia-2"></i>
															<span class="m-nav__link-text">
																Upload File
															</span>
														</a>
													</li>
													<li class="m-nav__section">
														<span class="m-nav__section-text">
															Useful Links
														</span>
													</li>
													<li class="m-nav__item">
														<a href="" class="m-nav__link">
															<i class="m-nav__link-icon flaticon-info"></i>
															<span class="m-nav__link-text">
																FAQ
															</span>
														</a>
													</li>
													<li class="m-nav__item">
														<a href="" class="m-nav__link">
															<i class="m-nav__link-icon flaticon-lifebuoy"></i>
															<span class="m-nav__link-text">
																Support
															</span>
														</a>
													</li>
													<li class="m-nav__separator m-nav__separator--fit m--hide"></li>
													<li class="m-nav__item m--hide">
														<a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
															Submit
														</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<div class="m-portlet__body">
				<!--begin: Datatable -->
				<div class="m_datatable" id="m_datatable_latest_orders"></div>
				<!--end: Datatable -->
			</div>
		</div>
    </div>	*/ ?>				
			
</div>
@stop

{{-- For custom style  --}}
@section('style')
    @parent    
    <style>
    	
    </style>
@endsection

@section('custom_js_script')    
<script src="{{ asset('sximo/js/jquery.validate.js')}}"></script>
<script>
    
</script>
@stop