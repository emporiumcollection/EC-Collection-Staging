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
        <a href="{{ URL::to('events')}}" class="m-nav__link"> 
            <span class="m-nav__link-text  breadcrumb-end"> Event Management System </span> 
        </a> 
    </li>
@stop

@section('content')
  
<div class="row">    
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        <h2>Event Management System</h2>
    </div> 
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        Emporium Collection exclusively markets a selection of the luxury network's extraordinary Hotels & Luxury Partners, utilising a sophisticated mix of online and offline media to position properties for maximum exposure in an elite market. Members recognised for their agility, expertise and superior competence in both local and global markets.
    </div>        
    
    <div class="col-md-12 col-xs-12">
        <div class="m-portlet m-portlet--mobile ">
            <div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							Events
						</h3>
					</div>
				</div>
				<div class="m-portlet__head-tools">
					<ul class="m-portlet__nav">
						<li class="m-portlet__nav-item">
							<a href="{{URL::to('events/update')}}" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
								<span>
									<i class="la la-plus"></i>
									<span>
										Add Event
									</span>
								</span>
							</a>
						</li>						
					</ul>
				</div>
			</div>
            <div class="m-portlet__body">				
    			<table class="table table-striped- table-bordered table-hover table-checkable" id="tbl_events">
    				<thead>
    					<tr>
    						<th>
    							Title
    						</th>
    						<th>
    							Desciription
    						</th>
    						<th>
    							Start date
    						</th>
    						<th>
    							End date
    						</th>						
    						<th>
    							Organizer name
    						</th>
    						<th>
    							Organizer email
    						</th>
    						<th>
    							Venue
    						</th>
    						<th>
    							Status
    						</th>
    						<th>
    							Category
    						</th>
    						<th></th>
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
    <style type="text/css">        
        .dropdown-menu.show {            
            z-index: 100;
        }
    </style>
@endsection
@section('custom_js_script')
<script src="{{ asset('metronic/assets/vendors/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('metronic/assets/app/js/app.js ') }}"></script>
<script>
    
    var DatatablesDataSourceAjaxClient= {
        init:function() { 
            $("#tbl_events").DataTable( {
                responsive:!0,
                destroy:true,
                ajax: {
                    url:"{{URL::to('events/allevents')}}", 
                    type:"get", 
                    data: {                                             
                        pagination: {
                            perpage: 1
                        }
                    }
                }
                , columns:[ {
                    data: "title"
                }
                , {
                    data: "desciription"
                }
                , {
                    data: "start_date"
                }
                , {
                    data: "end_date"
                }
                , {
                    data: "organizer_name"
                }
                , {
                    data: "organizer_email"
                }
                , {
                    data: "name"
                }
                , {
                    data: "status"
                }                    
                , {
                    data: "category_name"
                }
                , {
                    data: "id"
                }
                ], columnDefs:[
                 {  className: 'm--align-center', targets: [0,1,2,3,4,5] },
                 {  className: 'm--align-right', targets: [] },
                 {
                    
                    targets:-1,
                    title:"Actions",
                    orderable:!1,
                    render:function(e,a,t,n){ 
                        if(t.status==0){
                            stss = 1
                        }else{
                            stss = 0
                        }
                        return'\n<span class="dropdown">\n<a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">\n<i class="la la-ellipsis-h"></i>\n</a>\n<div class="dropdown-menu dropdown-menu-right">\n<a class="dropdown-item" href="{{url("/")}}/events/update/'+t.id+'"><i class="la la-edit"></i> Edit Details</a>\n<a class="dropdown-item" href="{{url("/")}}/events/changestatus/'+t.id+'/'+stss+'" id="ev_status"><i class="la la-leaf"></i> Update Status</a>\n<a class="dropdown-item" href="{{url("/")}}/events/eventsettings/'+t.id+'/types"><i class="la la-cog"></i> Configration</a>\n<a class="dropdown-item" href="{{url("/")}}/events/copy/'+t.id+'" id="ev_copy"><i class="la la-copy"></i> Copy</a>\n</div>\n</span>\n'
                        
                    }
                    
                 },
                 {
                    targets:7, render:function(a, t, e, n) {                     
                        if(e.status=='1'){
                            return 'Active';
                        }else{
                            return 'Inactive';
                        } 
                    }
                 }                ,
                                
                ]
            }
            )            
        }
    };
    $(document).ready(function() {                        
        DatatablesDataSourceAjaxClient.init();        
    });    
$(document).ready(function () {
    
    $(".acceptcontractbtn").click(function(e){
        e.preventDefault();
        var btnObj = $(this);
        //loader start
        btnObj.prop('disabled',true);
        btnObj.html('Processing...');
        btnObj.addClass('m-loader m-loader--light m-loader--right');
        //End
        var hotelId = btnObj.data('id');
        var contractId = btnObj.data('contract-ids');
        
        var fdata = new FormData();
            fdata.append("hotel_id",hotelId);
            fdata.append("contract_id",contractId);
            
        $.ajax({
            type:"POST",
            url:"{{URL::to('properties/savehotelcontract')}}",
            dataType:'json',
            contentType: false,
            processData: false,
            data:fdata,                
            success: function(response){
                if(response.status == 'success'){
                    toastr.success(response.message);
                    btnObj.closest(".m-alert").parent().hide();
                }
                else{
                    if((typeof response.errors) != 'undefined'){
                        $.each(response.errors,function(index, value){
                            toastr.error(value);
                        });
                    }
                    
                    //loader start
                    btnObj.prop('disabled',false);
                    btnObj.html('Accept All');
                    btnObj.removeClass('m-loader m-loader--light m-loader--right');
                    //End                                                
                }
            },
            error: function(e){
                //loader start
                btnObj.prop('disabled',false);
                btnObj.html('Accept All');
                btnObj.removeClass('m-loader m-loader--light m-loader--right');
                //End
                toastr.error("Unexpected error occurred!");
            }
        });
        
        return false;
    });
    
    
    $(".accept-btn").click(function(e){
        e.preventDefault();
        var btnObj = $(this);
        //loader start
        btnObj.prop('disabled',true);
        btnObj.html('Processing...');
        btnObj.addClass('m-loader m-loader--light m-loader--right');
        //End
        var parentDiv = $(this).closest(".form-group");
        var ischeckedc = parentDiv.find('[name="commission_type"]').is(":checked");
        if(ischeckedc === true){
            var hotelId = btnObj.data('id');
            var contractId = btnObj.data('contract-id');
            var comType = parentDiv.find('[name="commission_type"]:checked').val();
            //console.log(hotelId+' : '+contractId+' : '+comType);
            var fdata = new FormData();
            fdata.append("hotel_id",hotelId);
            fdata.append("contract_id",contractId);
            fdata.append("commission_type",comType);
            $.ajax({
                type:"POST",
                url:"{{URL::to('properties/savecommissioncontract')}}",
                dataType:'json',
                contentType: false,
                processData: false,
                data:fdata,                
                success: function(response){
                    if(response.status == 'success'){
                        toastr.success(response.message);
                        parentDiv.closest(".commission-popup-main-div").hide();
                    }
                    else{
                        if((typeof response.errors) != 'undefined'){
                            $.each(response.errors,function(index, value){
                                toastr.error(value);
                            });
                        }
                        
                        //loader start
                        btnObj.prop('disabled',false);
                        btnObj.html('Accept');
                        btnObj.removeClass('m-loader m-loader--light m-loader--right');
                        //End                                                
                    }
                },
                error: function(e){
                    //loader start
                    btnObj.prop('disabled',false);
                    btnObj.html('Accept');
                    btnObj.removeClass('m-loader m-loader--light m-loader--right');
                    //End
                    toastr.error("Unexpected error occurred!");
                }
            });
        }else{
            //loader start
            btnObj.prop('disabled',false);
            btnObj.html('Accept');
            btnObj.removeClass('m-loader m-loader--light m-loader--right');
            //End
            toastr.error("Please select hotel availablity!");
        }
        
        return false;
    });
    
    
    $("#switch_property").click(function(){
      if($("#switch_property").is(":checked")){
        $("#property_approve_msg_modal").modal('show');  
      }else{
        $("#property_approve_msg_modal").modal('hide'); 
      }      
    });
});
function change_option(row,filed_name,row_id,act)
{
	if(row_id!='' && row_id>0)
	{
		$.ajax({
		  url: "{{ URL::to('enable_diable_propertystatus')}}",
		  type: "post",
		  data: 'filed_name='+filed_name+'&row_id='+row_id+'&action='+act,
		  success: function(data){
			if(data!='error')
			{
				if(act==1)
				{
					$(row).removeClass('btn-danger');
					$(row).addClass('btn-success');
					$(row).children( "i.fa" ).removeClass('fa-times');
					$(row).children( "i.fa" ).addClass('fa-check');
					$(row).attr("onclick","change_option(this,'"+filed_name+"','"+row_id+"',0)");
					$(row).attr("title","Click to Disable");
					$(row).attr("data-original-title","Click to Disable");
				}
				else if(act==0)
				{	
					$(row).removeClass('btn-success');
					$(row).addClass('btn-danger');
					$(row).children( "i.fa" ).removeClass('fa-check');
					$(row).children( "i.fa" ).addClass('fa-times');
					$(row).attr("onclick","change_option(this,'"+filed_name+"','"+row_id+"',1)");
					$(row).attr("title","Click to Enable");
					$(row).attr("data-original-title","Click to Enable");
				}
			}
		  }
		});
	}
}
$(document).on('click', '#ev_copy', function(e){
    e.preventDefault();
    var url = $(this).attr('href');    
    $.ajax({
	  url: url,
	  type: "post",
      dataType: "json",
	  //data: { eid:eid },
	  success: function(data){
        if(data.status=="success"){            
            var objev = data.obj;
            var table = $('#tbl_events').DataTable();
            table.row.add({
                "title": objev.title,
                "desciription": objev.desciription,
                "start_date": objev.start_date,
                "end_date": objev.end_date,
                "organizer_name": objev.organizer_name,
                "organizer_email": objev.organizer_email,
                "name": objev.name,
                "status": objev.status,
                "category_name": objev.category_name,
                "id": objev.id,
            }).draw();            
            toastr.success(data.message);
        }else{
            toastr.error(data.message);
        }  		
	  }
	});                
});
$(document).on('click', '#ev_status', function(e){
    e.preventDefault();
    var crr = $(this).closest('tr')[0]; 
    var url = $(this).attr('href');    
    $.ajax({
	  url: url,
	  type: "post",
      dataType: "json",	  
	  success: function(resp){
        if(resp.status=="success"){ 
            var table = $('#tbl_events').dataTable();            
            txtstatus=resp.ev_status;            
            var rowIndex = table.fnGetPosition(crr);            
            table.fnUpdate( txtstatus, rowIndex , 7);            
            toastr.success(resp.message);
        }else{
            toastr.error(resp.message);
        }  		
	  }
	});                
});
</script>
@stop