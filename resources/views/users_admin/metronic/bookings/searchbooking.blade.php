@extends('users_admin.metronic.layouts.app')

@section('page_name')
    
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
            <span class="m-nav__link-text breadcrumb-end"> My Reservations </span> 
        </a> 
    </li>
@stop

@section('content')
<div class="row">
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        <h2>Search Result</h2>
    </div>
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        <div class="m-portlet__body">
            <div class="m-widget11">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_2">
					<thead>
						<tr>
							<th>
								Booking number
							</th>
							<th>
								Guest Name
							</th>
							<th class="m--align-center">
								Adult #
							</th>
							<th>
								Child #
							</th>
							<th>
								Date of Arrival
							</th>
							<th>
								Date of Departure
							</th>										
							<th>
								Actions
							</th> 
						</tr>
					</thead>
				</table>
            </div>
        </div>
    </div>
</div>
@stop
{{-- For custom style  --}}
@section('style')
    @parent   
    <link href="{{ asset('metronic/assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />    
@endsection

@section('custom_js_script')    
<script src="{{ asset('sximo/js/jquery.validate.js')}}"></script>
<script src="{{ asset('metronic/assets/vendors/custom/datatables/datatables.bundle.js') }}"></script>
<script>
    var base_url = "{{URL::to('/')}}";
    var DatatablesDataSourceAjaxClient= {
        init:function(skeyword, arrive, departure) { 
            $("#m_table_2").DataTable( {
                responsive:!0,
                destroy:true,
                ajax: {
                    url:"{{URL::to('searchbookingresult')}}", 
                    type:"POST", 
                    data: {
                        skeyword:skeyword, 
                        arrive:arrive,
                        departure:departure,
                        pagination: {
                            perpage: 1
                        }
                    }
                }
                , columns:[ {
                    data: "booking_number"
                }
                , {
                    data: "first_name"
                }
                , {
                    data: "total_adults"
                }
                , {
                    data: "total_child"
                }
                , {
                    data: "checkin_date"
                }
                , {
                    data: "checkout_date"
                }                
                , {
                    data: "Actions"
                }
                ], columnDefs:[
                 {  className: 'm--align-center', targets: [0,2,3] },
                 {  className: 'm--align-right', targets: [4,5] },
                 
                 {
                    targets:-1, title:"Actions", orderable:!1, render:function(a, t, e, n) { 
                        return'\n<span class="dropdown">\n<a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">\n<i class="la la-ellipsis-h"></i>\n</a>\n<div class="dropdown-menu dropdown-menu-right">\n<a class="dropdown-item" href="'+base_url+'/bookingshow/'+e.id+'"><i class="la la-edit"></i> View</a>\n</div>\n</span>\n<a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">\n<i class="la la-edit"></i>\n</a>'
                    }
                }, {
                    targets:1, render:function(a, t, e, n) {                        
                        return e.first_name+" "+e.last_name;
                    }
                }                
                ]
            }
            )
        }
    };
    
    $(document).ready(function() {
        var skeyword = '<?php echo $_GET['s'] ?>';
        var arrive = '<?php echo $_GET['from'] ?>';
        var departure = '<?php echo $_GET['to'] ?>';        
        DatatablesDataSourceAjaxClient.init(skeyword, arrive, departure);           
    });
    
</script>	
@stop