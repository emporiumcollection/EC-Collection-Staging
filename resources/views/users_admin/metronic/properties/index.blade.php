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
        <a href="{{ URL::to('properties')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Reservation & Distribution </span> 
        </a> 
    </li>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('properties')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Properties </span> 
        </a> 
    </li>
@stop

@section('content')
  
<div class="row">
    
        @foreach ($rowData as $row)
        <?php 
        
        ?>
            <div class="col-md-12 col-xs-12">
            <!--begin:: Widgets/Activity-->
					<div class="m-portlet m-portlet--bordered-semi m-portlet--widget-fit m-portlet--full-height m-portlet--skin-light  m-portlet--rounded-force">
						<div class="m-portlet__head">
							<div class="m-portlet__head-caption">
								<div class="m-portlet__head-title">
									<span class="m-switch m-switch--outline m-switch--success switch-btn-bot-pad">
    									<label>
    										<input type="checkbox" name="switch_property" id="switch_property" />
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
																	<i class="m-nav__link-icon"></i>
																	<span class="m-nav__link-text">
																		Hotel/Property
																	</span>
																</a>
														    </li> 
                                                            <li class="m-nav__item">
																<a href="{{ URL::to('properties_settings/'.$row->id.'/types')}}" class="m-nav__link">
																	<i class="m-nav__link-icon"></i>
																	<span class="m-nav__link-text">
																		Room Types
																	</span>
																</a>
														    </li> 
                                                            <li class="m-nav__item">
																<a href="{{ URL::to('properties_settings/'.$row->id.'/rooms')}}" class="m-nav__link">
																	<i class="m-nav__link-icon"></i>
																	<span class="m-nav__link-text">
																		Rooms
																	</span>
																</a>
														    </li> 
                                                            <li class="m-nav__item">
																<a href="{{ URL::to('properties_settings/'.$row->id.'/seasons')}}" class="m-nav__link">
																	<i class="m-nav__link-icon"></i>
																	<span class="m-nav__link-text">
																		Seasons
																	</span>
																</a>
														    </li> 
                                                            <li class="m-nav__item">
																<a href="{{ URL::to('properties_settings/'.$row->id.'/price')}}" class="m-nav__link">
																	<i class="m-nav__link-icon"></i>
																	<span class="m-nav__link-text">
																		Price
																	</span>
																</a>
														    </li> 
                                                            <li class="m-nav__item">
																<a href="{{ URL::to('properties_settings/'.$row->id.'/property_documents')}}" class="m-nav__link">
																	<i class="m-nav__link-icon"></i>
																	<span class="m-nav__link-text">
																		Property Documents
																	</span>
																</a>
														    </li> 
                                                            <li class="m-nav__item">
																<a href="{{ URL::to('properties_settings/'.$row->id.'/property_images')}}" class="m-nav__link">
																	<i class="m-nav__link-icon"></i>
																	<span class="m-nav__link-text">
																		Images
																	</span>
																</a>
														    </li> 
                                                            <li class="m-nav__item">
																<a href="{{ URL::to('properties_settings/'.$row->id.'/gallery_images')}}" class="m-nav__link">
																	<i class="m-nav__link-icon"></i>
																	<span class="m-nav__link-text">
																		Galleries
																	</span>
																</a>
														    </li> 
                                                            <li class="m-nav__item">
																<a href="#" class="m-nav__link">
																	<i class="m-nav__link-icon"></i>
																	<span class="m-nav__link-text">
																		Become Featured
																	</span>
																</a>
														    </li> 
                                                            <li class="m-nav__item">
																<a href="#" class="m-nav__link">
																	<i class="m-nav__link-icon"></i>
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
									<div class="m-widget17__chart" style="height:360px;">
                                        
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
												
											</span>
											<span class="m-widget17__subtitle">
											    <a href="{{ URL::to('properties/update/'.$row->id.'?return='.$return) }}">																	
                                        			<span class="m-nav__link-text">
                                        				Hotel/Property
                                        			</span>
                                        		</a>
											</span>
											
										</div>
										<div class="m-widget17__item">
											<span class="m-widget17__icon">
												
											</span>
											<span class="m-widget17__subtitle">
												<a href="{{ URL::to('properties_settings/'.$row->id.'/property_documents')}}">
                                        			<i class="m-nav__link-icon"></i>
                                        			<span class="m-nav__link-text">
                                        				Property Documents
                                        			</span>
                                        		</a>
											</span>
											
										</div>
									</div>
									<div class="m-widget17__items m-widget17__items-col1">
										<div class="m-widget17__item">
											<span class="m-widget17__icon">
												
											</span>
											<span class="m-widget17__subtitle">
												<a href="{{ URL::to('properties_settings/'.$row->id.'/types')}}">
                                        			<i class="m-nav__link-icon"></i>
                                        			<span class="m-nav__link-text">
                                        				Room Types
                                        			</span>
                                        		</a>
											</span>
											
										</div>
										<div class="m-widget17__item">
											<span class="m-widget17__icon">
												
											</span>
											<span class="m-widget17__subtitle">
												<a href="{{ URL::to('properties_settings/'.$row->id.'/property_images')}}">
                                        			<i class="m-nav__link-icon"></i>
                                        			<span class="m-nav__link-text">
                                        				Images
                                        			</span>
                                        		</a>
											</span>
											
										</div>
									</div>
                                    <div class="m-widget17__items m-widget17__items-col1">
										<div class="m-widget17__item">
											<span class="m-widget17__icon">
												
											</span>
											<span class="m-widget17__subtitle">
											     <a href="{{ URL::to('properties_settings/'.$row->id.'/rooms')}}">
                                        			<i class="m-nav__link-icon"></i>
                                        			<span class="m-nav__link-text">
                                        				Rooms
                                        			</span>
                                        		</a>
											</span>
											
										</div>
										<div class="m-widget17__item">
											<span class="m-widget17__icon">
												
											</span>
											<span class="m-widget17__subtitle">
											     <a href="{{ URL::to('properties_settings/'.$row->id.'/gallery_images')}}">
                                        			<i class="m-nav__link-icon"></i>
                                        			<span class="m-nav__link-text">
                                        				Galleries
                                        			</span>
                                        		</a>	
											</span>
											
										</div>
									</div>
                                    <div class="m-widget17__items m-widget17__items-col1">
										<div class="m-widget17__item">
											<span class="m-widget17__icon">
												
											</span>
											<span class="m-widget17__subtitle">
											     <a href="{{ URL::to('properties_settings/'.$row->id.'/seasons')}}">
                                        			<i class="m-nav__link-icon"></i>
                                        			<span class="m-nav__link-text">
                                        				Seasons
                                        			</span>
                                        		</a>
											</span>
											
										</div>
										<div class="m-widget17__item">
											<span class="m-widget17__icon">
												
											</span>
											<span class="m-widget17__subtitle">
												<a href="#">
                                        			<i class="m-nav__link-icon"></i>
                                        			<span class="m-nav__link-text">
                                        				Become Featured
                                        			</span>
                                        		</a>
											</span>											
										</div>
									</div>
                                    <div class="m-widget17__items m-widget17__items-col1">
										<div class="m-widget17__item">
											<span class="m-widget17__icon">
												
											</span>
											<span class="m-widget17__subtitle">
											     <a href="{{ URL::to('properties_settings/'.$row->id.'/price')}}">
                                        			<i class="m-nav__link-icon"></i>
                                        			<span class="m-nav__link-text">
                                        				Price
                                        			</span>
                                        		</a>
											</span>											
										</div>
										<div class="m-widget17__item">
											<span class="m-widget17__icon">
												
											</span>
											<span class="m-widget17__subtitle">
												<a href="#" class="m-nav__link">
                                        			<i class="m-nav__link-icon"></i>
                                        			<span class="m-nav__link-text">
                                        				Get Help
                                        			</span>
                                        		</a>
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
    </style>
@endsection
@section('custom_js_script')
<script>
$(document).ready(function () {
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
