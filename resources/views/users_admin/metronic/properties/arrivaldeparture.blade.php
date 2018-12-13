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
    <div class="col-md-12 col-xs-12 m--align-right padding-30"> 
        <a href="{{ URL::to('downloadrequirementsheet/Emporium-Voyage-Arrivals-Departures-Cancelations-help.pdf')}}" class="tips btn btn-xs btn-primary"><i class="fa  icon-file-pdf "></i>Download Documentation</a>
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
                            <option value="cancel">Cancelations</option>
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
    $(document).ready(function(){            
        arrival_depart();
        $(".m_tab1_content").click(function(){
            $(".m_tab1_content").removeClass('active');
            $(this).addClass('active');
            arrival_depart();
        });
        function arrival_depart(){
            //$obj = $(".m_tab1_content.active");
            var reportfor = $(".m_tab1_content.active").attr('data-reportfor');
            var arrival_departure = $("#dd_arrival_departure").val();
            //console.log($obj);
            $.ajax({
                url:"{{URL::to('user_arrival_departure')}}",
                type:'POST',
                dataType:'json',
                data:{'reportfor':reportfor, 'arrival_departure':arrival_departure}, 
                beforeSend: function() {
                  $("#table_data").html('<tr class="m--align-center"><td colspan="5"><div class="m-loader m-loader--brand"></div></td></tr>');
                },                   
                success:function(response){
                    var html = '';
                    $("#table_data").html('');
                    if(response.status == 'success'){
                        
                        var reservations = response.reservations;
                        if(reservations.length > 0){
                            $.each(reservations, function(key, val){
                                console.log(val);
                                 
                                html += '<tr><td>'+val.first_name+' '+val.last_name+'</td><td class="m--align-center">'+val.total_adults+'</td><td class="m--align-center">'+val.total_child+'</td><td class="m--align-right m--font-brand">'+val.checkin_date+'</td><td class="m--align-right m--font-brand">'+val.checkout_date+'</td></tr>';													
							});	
                            			
                        }else{
                            html += '<tr class="m--align-center"><td colspan="5">Currently no record found</td></tr>';													
							
                        }
                        $("#table_data").html(html);
                    }
                    else{
                        toastr.error(response.message);
                    }
                }
            });
        }
    	
    });
</script>
@stop