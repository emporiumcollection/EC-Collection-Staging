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
        <a href="{{ URL::to('advertising')}}" class="m-nav__link"> 
            <span class="m-nav__link-text breadcrumb-end"> Advertising </span> 
        </a> 
    </li>
@stop

@section('content')
<div class="row">
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        <h2>Advertising</h2>
    </div> 
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ornare diam at convallis lacinia. Duis a sapien et erat finibus molestie eu id nisi. Integer nibh elit, blandit ac volutpat eget, tempus eget enim. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas mollis dictum risus. Vivamus aliquam at elit non dictum. Integer nisi ante, interdum at purus vitae, rhoncus bibendum dui. Praesent pharetra augue at ultrices facilisis. Vestibulum erat urna, iaculis et purus in, fermentum varius nibh.
    </div>
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        <hr />
    </div> 
    <div class="col-md-12 col-xs-12 m--align-right padding-30"> 
        <a href="{{ URL::to('downloadrequirementsheet/Emporium-Voyage-Advertising-help.pdf')}}" class="tips btn btn-xs btn-primary"><i class="fa  icon-file-pdf "></i>Download Documentation</a>
    </div>
    <div class="col-sm-12 col-md-4 col-xl-4">
        <!--begin:: Widgets/Adwords Stats-->
		<div class="m-portlet m-portlet--full-height m-portlet--skin-light m-portlet--fit bg-gray">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							Sales Stats
						</h3>
					</div>
				</div>
				<div class="m-portlet__head-tools">
					<ul class="m-portlet__nav">
						<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
							<a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
								Select Range
							</a>
							<div class="m-dropdown__wrapper" style="z-index: 101;">
								<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 47px;"></span>
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
															Activity
														</span>
													</a>
												</li>
												<li class="m-nav__item">
													<a href="" class="m-nav__link">
														<i class="m-nav__link-icon flaticon-chat-1"></i>
														<span class="m-nav__link-text">
															Messages
														</span>
													</a>
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
												<li class="m-nav__separator m-nav__separator--fit"></li>
												<li class="m-nav__item">
													<a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
														Cancel
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
				<div class="m-widget21" style="min-height: 420px">
					<div class="row">
						<div class="col col-sm-12 col-md-6 col-xl-6">
							<div class="m-widget21__item m--pull-right">
								<span class="m-widget21__icon">
									<a href="#" class="btn btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
										<i class="fa flaticon-alert-2 m--font-light"></i>
									</a>
								</span>
								<div class="m-widget21__info">
									<span class="m-widget21__title">
										Sales
									</span>
									<br>
									<span class="m-widget21__sub">
										IPO, Margins, Transactions
									</span>
								</div>
							</div>
						</div>
						<div class="col col-sm-12 col-md-6 col-xl-6 m--align-left">
							<div class="m-widget21__item m--pull-left">
								<span class="m-widget21__icon">
									<a href="#" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
										<i class="fa flaticon-coins m--font-light m--font-light"></i>
									</a>
								</span>
								<div class="m-widget21__info">
									<span class="m-widget21__title">
										Commission Paid
									</span>
									<br>
									<span class="m-widget21__sub">
										Expenses, Loses, Profits
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="m-widget21__chart m-portlet-fit--sides" style="height:310px;"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
						<canvas id="m_chart_adwords_stats" width="502" height="310" class="chartjs-render-monitor" style="display: block; width: 502px; height: 310px;"></canvas>
					</div>
				</div>
			</div>
		</div>
		<!--end:: Widgets/Adwords Stats-->
    </div>         
    <div class="col-sm-12 col-md-8 col-xl-8">
        <div class="row" style="margin-left: 0px;">
            <div class="adv-top-dd">
                <select class="form-control">
                    <option value="">Select</option>
                    <option value="">Featured for destination</option>
                    <option value="">Featured for experience</option>
                    <option value="">Homepage Slider</option>
                </select>
            </div>
        </div>
        <div class="row" style="margin-left: 0px;">
            <div class="setting-box-advert">
                <a href="#">
                    <i class="grid_icon flaticon-plus"></i>																	
        			<span class="grid_link-text">
        				January
        			</span>
        		</a>
            </div>
            <div class="setting-box-advert">
                <a href="#">
                    <i class="grid_icon flaticon-plus"></i>																	
        			<span class="grid_link-text">
        				February
        			</span>
        		</a>
            </div>
            <div class="setting-box-advert">
                <a href="#">
        			<i class="grid_icon flaticon-plus"></i>																	
        			<span class="grid_link-text">
        				March
        			</span>
        		</a>
            </div>
            <div class="setting-box-advert">
                <a href="#">
        			<i class="grid_icon flaticon-plus"></i>																	
        			<span class="grid_link-text">
        				April
        			</span>
        		</a>
            </div>
            
            
            <div class="setting-box-green-advert">
                <a href="#">
                    <i class="grid_icon flaticon-plus"></i>																	
        			<span class="grid_link-text">
        				May
        			</span>
        		</a>
            </div>
            <div class="setting-box-green-advert">
                <a href="#">
                    <i class="grid_icon flaticon-plus"></i>																	
        			<span class="grid_link-text">
        				June
        			</span>
        		</a>
            </div>
            <div class="setting-box-green-advert">
                <a href="#">
        			<i class="grid_icon flaticon-plus"></i>																	
        			<span class="grid_link-text">
        				July
        			</span>
        		</a>
            </div>
            <div class="setting-box-advert">
                <a href="#">
        			<i class="grid_icon flaticon-plus"></i>																	
        			<span class="grid_link-text">
        				August
        			</span>
        		</a>
            </div>
            
            <div class="setting-box-advert">
                <a href="#">
                    <i class="grid_icon flaticon-plus"></i>																	
        			<span class="grid_link-text">
        				September
        			</span>
        		</a>
            </div>
            <div class="setting-box-advert">
                <a href="#">
                    <i class="grid_icon flaticon-plus"></i>																	
        			<span class="grid_link-text">
        				October
        			</span>
        		</a>
            </div>
            <div class="setting-box-advert">
                <a href="#">
        			<i class="grid_icon flaticon-plus"></i>																	
        			<span class="grid_link-text">
        				November
        			</span>
        		</a>
            </div>
            <div class="setting-box-advert">
                <a href="#">
        			<i class="grid_icon flaticon-plus"></i>																	
        			<span class="grid_link-text">
        				December
        			</span>
        		</a>
            </div>
            
        </div>
        <div class="row" style="margin-left: 0px;">
            <div class="tbl">
                <div class="tbl-row">
                    <div class="tbl-cell1 adv-bg-green"></div>
                    <div class="tbl-cell2 adv-apd-left">Advert placed</div>
                </div>
                <div class="tbl-row">
                    <div class="tbl-cell1 adv-bg-gray"></div>
                    <div class="tbl-cell2 adv-apd-left">Reserve this month</div>
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
    	
    </style>
@endsection

@section('custom_js_script')    
<script src="{{ asset('sximo/js/jquery.validate.js')}}"></script>
<script>
    
</script>
@stop