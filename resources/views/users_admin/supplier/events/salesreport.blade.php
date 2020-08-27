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
        <a href="{{ URL::to('salesreport')}}" class="m-nav__link"> 
            <span class="m-nav__link-text breadcrumb-end"> Sales & Marketing </span> 
        </a> 
    </li>    
@stop

@section('content')
<div class="row">
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        <h2>Sales & Marketing</h2>
    </div> 
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        The Emporium Collection Sales department solicits travel agents, corporations, group/meeting planners and other business-producing entities to develop new and repeat business for our discerning member hotels. This section highlights your sales reports.
    </div>
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        <hr />
    </div> 
    <div class="col-md-12 col-xs-12 m--align-right padding-30"> 
        <a href="{{ URL::to('downloadrequirementsheet/Emporium-Voyage-Sales-Marketing-help.pdf')}}" class="tips btn btn-xs btn-primary"><i class="fa icon-file-pdf "></i>Download Documentation</a>
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
									
								</div>
							</div>
						</div>
					</div>
					<div class="m-widget21__chart m-portlet-fit--sides" style="height:310px;">
                        <div class="col-sm-12 m--align-center" id="no_data" style="display: none;"></div>
                        <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                            <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                            </div>
                        </div>
						<canvas id="m_chart_salesreport_stats" width="502" height="310" class="chartjs-render-monitor" style="display: block; width: 502px; height: 310px;"></canvas>
					</div>
				</div>
			</div>
		</div>
		<!--end:: Widgets/Adwords Stats-->
    </div>	
    <div class="col-sm-12 col-md-8 col-xl-8">
        <div class="m-portlet m-portlet--mobile ">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							Sales Overview
						</h3>
					</div>
				</div>
                <div class="m-portlet__head-tools">
					<ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm">
                        <li class="nav-item m-tabs__item">
							<a class="nav-link m-tabs__link active m_tab1_content" data-reportfor='today'>
								Today
							</a>
						</li>
                        <li class="nav-item m-tabs__item">
							<a class="nav-link m-tabs__link m_tab1_content" data-reportfor='Week'>
								Week
							</a>
						</li>
                        <li class="nav-item m-tabs__item">
							<a class="nav-link m-tabs__link m_tab1_content" data-reportfor='month'>
								Month
							</a>
						</li>
						<!--<li class="nav-item m-tabs__item">
							<a class="nav-link m-tabs__link m_tab1_content" data-reportfor='all'>
								All
							</a>
						</li> -->
					</ul>
				</div>				
			</div>
			<div class="m-portlet__body">
				<!--begin: Datatable -->
				<!--<div class="m_datatable" id="m_datatable_latest_orders_2"></div>-->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_2">
						<thead>
							<tr>
								<th>
									Booking number
								</th>
								<th>
									Bookings
								</th>
								<th class="m--align-center">
									Channel
								</th>
								<th>
									Revenue
								</th>
								<th>
									Commission
								</th>
								<th>
									Market Segment
								</th>
							</tr>
						</thead>
					</table>
				<!--end: Datatable -->
			</div>
		</div>
    </div>					
			
</div>
@stop

{{-- For custom style  --}}
@section('style')
    @parent 
    <link href="{{ asset('metronic/assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />    
    <style>
    	.map-top{
    	   background-color:red;
    	}
    </style>
@endsection

@section('custom_js_script')  
 
<script src="{{ asset('sximo/js/jquery.validate.js')}}"></script>
<script src="{{ asset('metronic/assets/vendors/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('metronic/assets/app/js/app.js ') }}"></script>
<script>
    $(document).ready(function(){
                    
                 
                
            
    });
    var DatatablesDataSourceAjaxClient= {
        init:function(reportfor) { 
            $("#m_table_2").DataTable( {
                responsive:!0,
                destroy:true,
                ajax: {
                    url:"{{URL::to('salesoverview')}}", 
                    type:"POST", 
                    data: {
                        reportfor:reportfor,                        
                        pagination: {
                            perpage: 1
                        }
                    }
                }
                , columns:[ {
                    data: "booking_number"
                }
                , {
                    data: "total_adults"
                }
                , {
                    data: "checkin_date"
                }
                , {
                    data: "total_price"
                }
                , {
                    data: "total_commission"
                }
                , {
                    data: "checkout_date"
                }                
                
                ], columnDefs:[
                 {  className: 'm--align-center', targets: [0,1,2,3,4,5] },
                 {  className: 'm--align-right', targets: [] },
                 
                 {
                    targets:2, render:function(a, t, e, n) {                        
                        return 'Hotels'; 
                    }
                 }                ,
                 
                 {
                    targets:5, render:function(a, t, e, n) {                        
                        return 'OTA'; 
                    }
                 }                
                ]
            }
            )
            /*$("#m_datatable_latest_orders_2").mDatatable( {
                data: {
                    type:"remote", 
                    source: {
                        read: {
                            url: "{{URL::to('salesoverview')}}"
                        }
                    }
                    , 
                    pageSize:1, 
                    saveState: {
                        cookie: !1, webstorage: !0
                    }
                    , 
                    serverPaging:!0, 
                    serverFiltering:!0, 
                    serverSorting:!0,
                    reportfor:reportfor
                }, 
                layout: {
                    theme: "default", class: "", scroll: !0, height: 380, footer: !1
                }, 
                sortable:!0, 
                filterable:!1, 
                pagination:!0, 
                columns:[                                       
                    {
                        field:"booking_number", 
                        title:"Booking Number", 
                        width:125, 
                        responsive: {
                            visible: "lg"
                        }
                    },
                    {
                        field:"total_adults", title:"Bookings", sortable:"asc", filterable:!1, width:70
                    },
                    {
                        field:"", title:"Channel", sortable:"asc", filterable:!1, width:60, template:function(e, t, a){
                            return 'Hotels'; 
                        }
                    },
                     
                    {
                        field: "total_price", title: "Revenue", width:70 
                    }, 
                    {
                        field: "total_commission", title: "Commission", width:70 
                    },                
                    {
                        field: "checkout_date", title: "Market Segment", width:70, template:function(e, t, a){
                            return 'OTA'; 
                        }
                    }
                ]
            }); */
        }
    };
    
    $(document).ready(function() {
        var reportfor = $(".m_tab1_content.active").attr('data-reportfor');                
        DatatablesDataSourceAjaxClient.init(reportfor);
        
        fnsaleschart(reportfor);
        
        $(".m_tab1_content").click(function(){
            $(".m_tab1_content").removeClass('active');
            $(this).addClass('active');
            var reportfor = $(".m_tab1_content.active").attr('data-reportfor');                  
            DatatablesDataSourceAjaxClient.init(reportfor);
            fnsaleschart(reportfor);
        });
        
    });
    function fnsaleschart(reportfor){
        $.ajax({
            url: "{{ URL::to('salesstats')}}",
            type:'POST',            
            data: {reportfor:reportfor},
            dataType: "json",
            success: function(data){ 
                saleschart(data.data['bookings'], data.data['commission'], data.data['sales']);           
            }
		});
    }
    function saleschart(bookings, commission, sales){
        if(bookings.length > 0){
            
            $("#no_data").css('display', 'none');
            $("#no_data").html('');
            
            var e=document.getElementById("m_chart_salesreport_stats").getContext("2d"),
            t=e.createLinearGradient(0, 0, 0, 240);
            t.addColorStop(0, Chart.helpers.color("#ffefce").alpha(1).rgbString()),
            t.addColorStop(1, Chart.helpers.color("#ffefce").alpha(.3).rgbString());
            var a= {
                type:"line",
                data: {
                    labels:bookings,
                    datasets:[ {
                        label: "Commission", backgroundColor: mApp.getColor("brand"), borderColor: mApp.getColor("brand"), pointBackgroundColor: Chart.helpers.color("#000000").alpha(0).rgbString(), pointBorderColor: Chart.helpers.color("#000000").alpha(0).rgbString(), pointHoverBackgroundColor: mApp.getColor("danger"), pointHoverBorderColor: Chart.helpers.color("#000000").alpha(.1).rgbString(), data: commission
                    }
                    ,
                    {
                        label: "Sales", backgroundColor: mApp.getColor("accent"), borderColor: mApp.getColor("accent"), pointBackgroundColor: Chart.helpers.color("#000000").alpha(0).rgbString(), pointBorderColor: Chart.helpers.color("#000000").alpha(0).rgbString(), pointHoverBackgroundColor: mApp.getColor("danger"), pointHoverBorderColor: Chart.helpers.color("#000000").alpha(.1).rgbString(), data: sales
                    }
                    ]
                }
                ,
                options: {
                    title: {
                        display: !1
                    }
                    ,
                    tooltips: {
                        mode: "nearest", intersect: !1, position: "nearest", xPadding: 10, yPadding: 10, caretPadding: 10
                    }
                    ,
                    legend: {
                        display: !1
                    }
                    ,
                    responsive:!0,
                    maintainAspectRatio:!1,
                    scales: {
                        xAxes:[ {
                            display:!1,
                            gridLines:!1,
                            scaleLabel: {
                                display: !0, labelString: "Booking Number"
                            }
                        }
                        ],
                        yAxes:[ {
                            stacked:!0,
                            display:!1,
                            gridLines:!1,
                            scaleLabel: {
                                display: !0, labelString: "Value"
                            }
                            ,
                            ticks: {
                                beginAtZero: !0
                            }
                        }
                        ]
                    }
                    ,
                    elements: {
                        line: {
                            tension: 1e-7
                        }
                        ,
                        point: {
                            radius: 4, borderWidth: 12
                        }
                    }
                    ,
                    layout: {
                        padding: {
                            left: 0, right: 0, top: 10, bottom: 0
                        }
                    }
                }
            }
            ;
            new Chart(e, a)
        }else{
            $("#no_data").css('display', '');
            $("#no_data").html('No record found');
        }
    }
    
    
</script>
@stop