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
        <a href="{{ URL::to('qualityassurances')}}" class="m-nav__link"> 
            <span class="m-nav__link-text breadcrumb-end"> Quality Assurance </span> 
        </a> 
    </li>
    
@stop

@section('content')
<div class="row">
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        <h2>Quality Assurance</h2>
    </div> 
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        Our Quality Assurance program ensures quality assurance audits for luxury service providers in the hotel, spa, safari and private charter niche. We conduct anonymous inspections of our Luxury Partners as part of the overall membership.
<br /><br />
The program ensures the member Hotels/Luxury Partners continue to uphold the highest level of quality in service and product.
    </div>
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        <hr />
    </div>    
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 padding-30">        
        <div style="float: right; margin: 0px 0px 0px 5px;">
            <a href="{{ URL::to('downloadrequirementsheet/Emporium-Voyage-Quality-Assurance-help.pdf')}}" class="tips btn btn-xs btn-primary"><i class="fa  icon-file-pdf "></i>Download Documentation</a>
        </div>
        <div style="width: 20%; float: right;">        
            <select class="form-control" name="dd_report">
                <option>Select Report</option>
            </select>
        </div>
    </div>            
    <?php /* <div class="col-sm-12 col-md-4 col-xl-4">
		<!--begin:: Widgets/Activity-->
		<div class="m-portlet m-portlet--bordered-semi m-portlet--widget-fit m-portlet--full-height m-portlet--skin-light  m-portlet--rounded-force">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text m--font-light">
							Quality Assurance
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
				<div class="m-widget17">
					<div class="m-widget17__visual m-widget17__visual--chart m-portlet-fit--top m-portlet-fit--sides m--bg-danger">
						<div class="m-widget17__chart" style="height:320px;">
							<canvas id="m_chart_activities3"></canvas>
						</div>
					</div>
					<div class="m-widget17__stats">
						<div class="m-widget17__items m-widget17__items-col1">
							<div class="m-widget17__item">
								<span class="m-widget17__icon">
									<i class="fa fa-check-square m--font-brand"></i>
								</span>
								<span class="m-widget17__subtitle">
									Quality Assurance
								</span>
								<span class="m-widget17__desc">
									<a href="#">View QA Module</a>
								</span>
							</div>
							
						</div>
						
					</div>
				</div>
			</div>
		</div>
		<!--end:: Widgets/Activity-->
	</div> */ ?>
                
    <div class="col-sm-12 col-md-12 col-xl-12">
        <div class="m-portlet m-portlet--tab">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<span class="m-portlet__head-icon m--hide">
							<i class="la la-gear"></i>
						</span>
						<h3 class="m-portlet__head-text">
							Quality Assurance Program
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div id="m_amcharts_13" style="height: 500px;"></div>
			</div>
		</div>					
    </div>						
			
</div>
@stop

{{-- For custom style  --}}
@section('style')
    <link href="//www.amcharts.com/lib/3/plugins/export/export.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('sximo/css/bookingSys.css')}}" rel="stylesheet">
    @parent    
    <style>
    	.cursor{cursor:col-resize;}
    	.selectedCell{background:pink;}
        .BookedCell{background:pink; cursor: pointer; }
        .selectedCell span{ cursor: pointer; }
    	.optionbox {
    		-moz-user-select: none;
    		-webkit-user-select: none;
    		-ms-user-select: none;
    		padding: 8px;
    		cursor: pointer;
    		background-color: #eee;
    		border-radius: 3px;
    		border: 1px solid #dadada;
    		line-height: 18px;
    		display: inline-block;
    	}
        .m-content>div:nth-child(even) .row {
            background: none !important;
            padding: 10px 15px;
        }
    </style>
@endsection

@section('custom_js_script')    
<script src="{{ asset('sximo/js/jquery.validate.js')}}"></script>
<script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
<script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
<script>
    
</script>
@stop
@section('script')
    <script src="//www.amcharts.com/lib/3/amcharts.js" type="text/javascript"></script>
	<script src="//www.amcharts.com/lib/3/serial.js" type="text/javascript"></script>
	<script src="//www.amcharts.com/lib/3/radar.js" type="text/javascript"></script>
	<script src="//www.amcharts.com/lib/3/pie.js" type="text/javascript"></script>
	<script src="//www.amcharts.com/lib/3/plugins/tools/polarScatter/polarScatter.min.js" type="text/javascript"></script>
	<script src="//www.amcharts.com/lib/3/plugins/animate/animate.min.js" type="text/javascript"></script>
	<script src="//www.amcharts.com/lib/3/plugins/export/export.min.js" type="text/javascript"></script>
	<script src="//www.amcharts.com/lib/3/themes/light.js" type="text/javascript"></script>
      
    <script>
    $(document).ready(function(){
        
        var e= {
            1:[ {
                sector: "Bedroom", size: 20, "color": "#d9a0af"
            }
            ,
            {
                sector: "Bathroom", size: 10, "color": "#D1DBBD"
            }
            ,
            {
                sector: "Exterior/Grounds", size: 14, "color": "#648da6"
            }
            ,
            {
                sector: "Lobby", size: 6, "color": "#90a2b6"
            }
            ,
            {
                sector: "Restaurants/Bars", size: 5, "color": "#f2ccc1"
            }
            ,
            {
                sector: "Guest Room Corridors", size: 5, "color": "#2B7379"
            }
            ,
            {
                sector: "Restrooms", size: 5, "color": "#6c5a7b"
            }
            ,
            {
                sector: "Elevators", size: 0, "color": "#c06c83"
            }
            ,
            {
                sector: "HE Employee - Behavioural Standards", size: 5, "color": "#d9a0af"
            }
            ,
            {
                sector: "Fitness Center", size: 5, "color": "#D1DBBD"
            }
            ,
            {
                sector: "Swimming Pool/Beach", size: 5, "color": "#648da6"
            }
            ,
            {
                sector: "Tennis/Squash Courts", size: 5, "color": "#90a2b6"
            }
            ,
            {
                sector: "Steam Room/Sauna/Jacuzzi", size: 5, "color": "#f2ccc1"
            }
            ,
            {
                sector: "Changing Rooms", size: 5, "color": "#2B7379"
            }
            ,
            {
                sector: "Other Fields", size: 5, "color": "#6c5a7b"
            }
            ],
            2:[ {
                sector: "Bedroom", size: 16, "color": "#d9a0af"
            }
            ,
            {
                sector: "Bathroom", size: 12, "color": "#D1DBBD"
            }
            ,
            {
                sector: "Exterior/Grounds", size: 10, "color": "#648da6"
            }
            ,
            {
                sector: "Lobby", size: 8, "color": "#90a2b6"
            }
            ,
            {
                sector: "Restaurants/Bars", size: 7, "color": "#f2ccc1"
            }
            ,
            {
                sector: "Guest Room Corridors", size: 6, "color": "#2B7379"
            }
            ,
            {
                sector: "Restrooms", size: 5, "color": "#6c5a7b"
            }
            ,
            {
                sector: "Elevators", size: 1, "color": "#c06c83"
            }
            ,
            {
                sector: "HE Employee - Behavioural Standards", size: 5, "color": "#d9a0af"
            }
            ,
            {
                sector: "Fitness Center", size: 5, "color": "#D1DBBD"
            }
            ,
            {
                sector: "Swimming Pool/Beach", size: 5, "color": "#648da6"
            }
            ,
            {
                sector: "Tennis/Squash Courts", size: 5, "color": "#90a2b6"
            }
            ,
            {
                sector: "Steam Room/Sauna/Jacuzzi", size: 5, "color": "#f2ccc1"
            }
            ,
            {
                sector: "Changing Rooms", size: 5, "color": "#2B7379"
            }
            ,
            {
                sector: "Other Fields", size: 5, "color": "#6c5a7b"
            }
            ],
            3:[ {
                sector: "Bedroom", size: 25, "color": "#d9a0af"
            }
            ,
            {
                sector: "Bathroom", size: 8, "color": "#D1DBBD"
            }
            ,
            {
                sector: "Exterior/Grounds", size: 10, "color": "#648da6"
            }
            ,
            {
                sector: "Lobby", size: 6, "color": "#90a2b6"
            }
            ,
            {
                sector: "Restaurants/Bars", size: 6, "color": "#f2ccc1"
            }
            ,
            {
                sector: "Guest Room Corridors", size: 5, "color": "#2B7379"
            }
            ,
            {
                sector: "Restrooms", size: 5, "color": "#6c5a7b"
            }
            ,
            {
                sector: "Elevators", size: 2, "color": "#c06c83"
            }
            ,
            {
                sector: "HE Employee - Behavioural Standards", size: 5, "color": "#d9a0af"
            }
            ,
            {
                sector: "Fitness Center", size: 5, "color": "#D1DBBD"
            }
            ,
            {
                sector: "Swimming Pool/Beach", size: 5, "color": "#648da6"
            }
            ,
            {
                sector: "Tennis/Squash Courts", size: 5, "color": "#90a2b6"
            }
            ,
            {
                sector: "Steam Room/Sauna/Jacuzzi", size: 5, "color": "#f2ccc1"
            }
            ,
            {
                sector: "Changing Rooms", size: 5, "color": "#2B7379"
            }
            ,
            {
                sector: "Other Fields", size: 3, "color": "#6c5a7b"
            }
            ],
            4:[ {
                sector: "Bedroom", size: 15, "color": "#d9a0af"
            }
            ,
            {
                sector: "Bathroom", size: 8, "color": "#D1DBBD"
            }
            ,
            {
                sector: "Exterior/Grounds", size: 12, "color": "#648da6"
            }
            ,
            {
                sector: "Lobby", size: 8, "color": "#90a2b6"
            }
            ,
            {
                sector: "Restaurants/Bars", size: 7, "color": "#f2ccc1"
            }
            ,
            {
                sector: "Guest Room Corridors", size: 10, "color": "#2B7379"
            }
            ,
            {
                sector: "Restrooms", size: 5, "color": "#6c5a7b"
            }
            ,
            {
                sector: "Elevators", size: 0, "color": "#c06c83"
            }
            ,
            {
                sector: "HE Employee - Behavioural Standards", size: 5, "color": "#d9a0af"
            }
            ,
            {
                sector: "Fitness Center", size: 5, "color": "#D1DBBD"
            }
            ,
            {
                sector: "Swimming Pool/Beach", size: 5, "color": "#648da6"
            }
            ,
            {
                sector: "Tennis/Squash Courts", size: 5, "color": "#90a2b6"
            }
            ,
            {
                sector: "Steam Room/Sauna/Jacuzzi", size: 5, "color": "#f2ccc1"
            }
            ,
            {
                sector: "Changing Rooms", size: 5, "color": "#2B7379"
            }
            ,
            {
                sector: "Other Fields", size: 5, "color": "#6c5a7b"
            }
            ],
            5:[ {
                sector: "Bedroom", size: 10, "color": "#d9a0af"
            }
            ,
            {
                sector: "Bathroom", size: 15, "color": "#D1DBBD"
            }
            ,
            {
                sector: "Exterior/Grounds", size: 14, "color": "#648da6"
            }
            ,
            {
                sector: "Lobby", size: 11, "color": "#90a2b6"
            }
            ,
            {
                sector: "Restaurants/Bars", size: 5, "color": "#f2ccc1"
            }
            ,
            {
                sector: "Guest Room Corridors", size: 5, "color": "#2B7379"
            }
            ,
            {
                sector: "Restrooms", size: 5, "color": "#6c5a7b"
            }
            ,
            {
                sector: "Elevators", size: 0, "color": "#c06c83"
            }
            ,
            {
                sector: "HE Employee - Behavioural Standards", size: 5, "color": "#d9a0af"
            }
            ,
            {
                sector: "Fitness Center", size: 5, "color": "#D1DBBD"
            }
            ,
            {
                sector: "Swimming Pool/Beach", size: 5, "color": "#648da6"
            }
            ,
            {
                sector: "Tennis/Squash Courts", size: 5, "color": "#90a2b6"
            }
            ,
            {
                sector: "Steam Room/Sauna/Jacuzzi", size: 5, "color": "#f2ccc1"
            }
            ,
            {
                sector: "Changing Rooms", size: 5, "color": "#2B7379"
            }
            ,
            {
                sector: "Other Fields", size: 5, "color": "#6c5a7b"
            }
            ]
        };
        a=1;
        AmCharts.makeChart("m_amcharts_13", {
            type:"pie", "hideCredits":true, theme:"light", dataProvider:[], valueField:"size", titleField:"sector", colorField: "color", startDuration:0, innerRadius:80, pullOutRadius:20, marginTop:30, titles:[ {
                text: "Quality Assurance"
            }
            ], allLabels:[ {
                y: "54%", align: "center", size: 25, bold: !0, text: "1", color: "#555"
            }
            , {
                y: "49%", align: "center", size: 15, text: "Q", color: "#555"
            }
            ], listeners:[ {
                event:"init", method:function(t) {
                    var i=t.chart;
                    !function t() {
                        i.allLabels[0].text=a;
                        var r=function() {
                            var t=e[a];
                            return++a>5&&(a=1), t
                        }
                        ();
                        i.animateData(r, {
                            duration:1e3, complete:function() {
                                setTimeout(t, 3e3)
                            }
                        }
                        )
                    }
                    ()
                }
            }
            ], export: {
                enabled: !0
            }
        });
    
    });
    </script>
@stop