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
            <span class="m-nav__link-text breadcrumb-end"> Properties </span> 
        </a> 
    </li>
@stop

@section('content')

<div class="row">
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        @if(!empty($pageslider))
        <div id="Carousel" class="carousel slide">
             
            <ol class="carousel-indicators">
                @foreach($pageslider as $key => $slider_row)
                <li data-target="#Carousel" data-slide-to="{{$key}}" class="{{($key == 0)? 'active' : ''}}"></li>
                @endforeach
            </ol>
             
            <!-- Carousel items -->
            <div class="carousel-inner">
            @foreach($pageslider as $key => $slider_row)    
            <div class="item {{($key == 0)? 'active' : ''}}">
            	<div class="row">
            	  <div class="col-md-12">
                    <a href="{{$slider_row->slider_link}}" class="thumbnail">                            
                        <div class="b2c-banner-text">{{$slider_row->slider_title}}</div>
                        <img src="{{url('uploads/slider_images/'.$slider_row->slider_img)}}" alt="{{$slider_row->slider_title}}" style="max-width:100%;" />
                    </a>
                  </div>                	  
            	</div><!--.row-->
            </div><!--.item-->
            @endforeach 
             
            </div><!--.carousel-inner-->
              <a data-slide="prev" href="#Carousel" class="left carousel-control"><</a>
              <a data-slide="next" href="#Carousel" class="right carousel-control">></a>
        </div><!--.Carousel-->
        @endif
    </div> 
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center padding-30">
        Welcome to the Hotel PMS Dashboard.
    </div> 
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        In this section we will add all property related information. Please downlaod the 'Property Management Documentation' or View the documentation online. If you still have questions do not hesitate to contact support by writing a support ticket. Expect a prompt response.
    </div>

	<div class="col-sm-12 col-md-12 col-xl-12">
        
        <div class="row">
            <div class="setting-box-hotel">
                <a href="{{ URL::to('dashboard') }}">
                    <i class="grid_icon fa fa-dashboard"></i>																	
        			<span class="grid_link-text">
        				Hotel/Property
        			</span>
        		</a>
            </div>
            <div class="setting-box-hotel">
                <a href="#">
                    <i class="grid_icon fa fa-calendar"></i>																	
        			<span class="grid_link-text">
        				Room Types
        			</span>
        		</a>
            </div>
            <div class="setting-box-hotel">
                <a href="#">
        			<i class="grid_icon fa fa-flask"></i>																	
        			<span class="grid_link-text">
        				Suites
        			</span>
        		</a>
            </div>
            <div class="setting-box-hotel">
                <a href="#">
        			<i class="grid_icon fa fa-shopping-bag"></i>																	
        			<span class="grid_link-text">
        				Seasons
        			</span>
        		</a>
            </div>
            <div class="setting-box-hotel">
                <a href="#">
        			<i class="grid_icon fa fa-thumbs-up"></i>																	
        			<span class="grid_link-text">
        				Price
        			</span>
        		</a>
            </div>
            <div class="setting-box-hotel">
                <a href="#">
        			<i class="grid_icon fa fa-handshake"></i>																	
        			<span class="grid_link-text">
        				Property Documents
        			</span>
        		</a>
            </div>
            <div class="setting-box-hotel">
                <a href="#">
        			<i class="grid_icon fa fa-handshake"></i>																	
        			<span class="grid_link-text">
        				Images
        			</span>
        		</a>
            </div>
            <div class="setting-box-hotel">
                <a href="#">
        			<i class="grid_icon fa fa-handshake"></i>																	
        			<span class="grid_link-text">
        				Galleries
        			</span>
        		</a>
            </div>
            <div class="setting-box-hotel">
                <a href="#">
        			<i class="grid_icon fa fa-handshake"></i>																	
        			<span class="grid_link-text">
        				Become Featured
        			</span>
        		</a>
            </div>
            <div class="setting-box-hotel">
                <a href="#">
        			<i class="grid_icon fa fa-handshake"></i>																	
        			<span class="grid_link-text">
        				Get Help
        			</span>
        		</a>
            </div>
        </div>
    </div>
</div>  

@stop
{{-- For custom style  --}}
@section('style')
    @parent
    <style type="text/css">
        .box-property{
            background-color: #fff; padding: 10px; margin: 10px 20px; text-align: center; font-size: 15px;
        }
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
        .m-widget17 .m-widget17__stats .m-widget17__items.m-widget17__items-col1{
            width: 20% !important;
        }
        .m-widget17 .m-widget17__stats .m-widget17__items .m-widget17__item{
            height: 9em;
        }
        .m-widget17 .m-widget17__stats .m-widget17__items .m-widget17__item .m-widget17__subtitle{
            text-align: center;
            margin-left: 0px;
        }
        .commission-popup-main-div{ background-color: rgba(0, 0, 0, 0.5); position: absolute; z-index: 2; left: 0; right: 0; }
        .commission-popup-main-div .inner-r-div{ margin: 10% auto; }
    </style>
@endsection
@section('custom_js_script')
<script>
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
        
      }else{
        
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
</script>
@stop
