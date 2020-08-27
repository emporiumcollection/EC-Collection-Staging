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
    @if(!empty($property_data))
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('properties')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> {{ucfirst($property_data->property_name)}}  </span> 
        </a> 
    </li>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="javascript:;" class="m-nav__link"> 
            <span class="m-nav__link-text breadcrumb-end"> {{ucfirst(str_replace('_', ' ', $active))}} </span> 
        </a> 
    </li>
    @endif
@stop

@section('content')  
    
    <div class="row">
    
        @if(Session::has('message'))	  
		   {{ Session::get('message') }}	   
	    @endif
                
        <div class="col-xs-12 col-lg-12">
            <ul>
        		@foreach($errors->all() as $error)
        			<li>{{ $error }}</li>
        		@endforeach
        	</ul>
        </div>
        
        <div class="col-sm-4 col-md-4 col-lg-4">
            @if(!empty($property_data)) {{$property_data->property_name}} @endif 
        </div>
        <div class="col-sm-8 col-md-8 col-lg-8 m--align-right">            
            <a href="{{URL::to('hotelpackages')}}" class="tips btn btn-xs btn-primary" style="height: auto !important;">Upgrade to pro</a>        
        </div>
        
        <!--begin::Portlet-->
		<div class="m-portlet">
            <div class="m-portlet__head">				
				<div class="m-portlet__head-tools margin-left-98">
					<ul class="m-portlet__nav bg-gray">
						<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
							<a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon m-portlet__nav-link--icon-xl">
								<span class="desk_bars1"></span>
                                <span class="desk_bars2"></span>
                                <span class="desk_bars3"></span>
							</a>
							<div class="m-dropdown__wrapper" style="z-index: 101;">
								<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 18px;"></span>
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
													<a href="{{ URL::to('properties/update/'.$pid.'?return='.$return) }}" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Hotel/Property
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="{{ URL::to('properties_settings/'.$pid.'/types')}}" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Suite Type
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="{{ URL::to('properties_settings/'.$pid.'/rooms')}}" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Suites
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="{{ URL::to('properties_settings/'.$pid.'/seasons')}}" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Seasons
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="{{ URL::to('properties_settings/'.$pid.'/calendar')}}" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Reservation Management
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="{{ URL::to('properties_settings/'.$pid.'/price')}}" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Price
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="{{ URL::to('properties_settings/'.$pid.'/property_documents')}}" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Property Documents
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="{{ URL::to('properties_settings/'.$pid.'/property_images')}}" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Images
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="{{ URL::to('properties_settings/'.$pid.'/gallery_images')}}" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Galleries
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="{{URL::to('advertising')}}" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Become Featured
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="https://emporium-collection.com/" class="m-nav__link" target="_blank">
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
				<ul class="nav nav-tabs" role="tablist">
                    @if(!empty($tabss))
        				@foreach($tabss as $key=>$val)
        					<li class="nav-item"> 
                                <a class="nav-link @if($key == $active) active @endif" href="{{URL::to('properties_settings/'.$pid.'/'.$key)}}"> {{ $val->tab_name }} </a>
                            </li>
        				@endforeach
        			@endif					
				</ul>
                <div class="tab-content">
					<div class="tab-pane active">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <h3 class="main-heading">Custom Price {{-- Lang::get('hotel-property.type-heading')--}}</h3>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                                <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
                                   <div class="m-alert__icon">
                                        <i class="flaticon-exclamation-1"></i>
                                        <span></span>
                                   </div>
                                   <div class="m-alert__text">                
                                        {{-- Lang::get('hotel-property.type-info')--}}
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>			
		</div>
		<!--end::Portlet-->
    </div>
@stop

{{-- For custom style  --}}
@section('style')
    @parent
    <style>
        
    </style>
@endsection
@section('custom_js_script')
<script src="{{ asset('metronic/assets/demo/demo6/base/toastr.js') }}"></script>
<script src="{{ asset('sximo/js/jquery.validate.js')}}"></script>
<script>

</script>
@stop
