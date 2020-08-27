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
            <span class="m-nav__link-text"> Event Management System </span> 
        </a> 
    </li>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('events')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Events </span> 
        </a> 
    </li>   
    @if(!empty($event_data))  
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('properties')}}" class="m-nav__link"> 
            <span class="m-nav__link-text breadcrumb-end"> {{$event_data->title}} </span> 
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
        
        <div class="col-sm-12 col-md-12 col-lg-12">
        <!--begin::Portlet-->
		<div class="m-portlet">
            <div class="m-portlet__head">				
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							@if(!empty($event_data)) {{$event_data->title}} @endif
						</h3>
					</div>
				 </div>
			</div>
            <div class="m-portlet__body">
				@include('users_admin/supplier/events/config_tab')
                <div class="tab-content">
					<div class="tab-pane active">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <h3 class="main-heading">Terms and Conditions {{-- Lang::get('hotel-property.type-heading')--}}</h3>
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
                        <div class="col-sm-12 col-md-12 col-lg-12 fun-bg-gray">
                            <form id="frm_add_event_term" method="POST">
                                <input type="hidden" name="property_id" value="{{$pid}}" >
                                
                                <div class="row">
                                    <div class="form-group col-lg-12">
                                        <textarea class="form-control input-lg" name="terms_n_conditions"><?php echo isset($row->terms_n_conditions)? $row->terms_n_conditions : '' ?></textarea>
                                    </div>
                                </div>
                                <div class="butt">
                                    <button type="submit" class="btn btn-success b-btn addterm">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>			
		</div>
		<!--end::Portlet-->
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
<script src="{{ asset('metronic/assets/demo/demo6/base/toastr.js') }}"></script>
<script src="{{ asset('sximo/js/jquery.validate.js')}}"></script>
<script>
$(document).on('click', '.addterm', function(e){
    e.preventDefault();
    $.ajax({
        url: "{{ URL::to('add_event_term')}}",
        type: "post",
        data: $('#frm_add_event_term').serializeArray(),
        dataType: "json",
        success: function(data){
			var html = '';
			if(data.status=='success')
			{
                var htmli = '';
				htmli +='<div class="alert alert-success fade in block-inner">';
				htmli +='<button data-dismiss="alert" class="close" type="button">×</button>';
				htmli +='<i class="icon-checkmark-circle"></i> '+data.message+' </div>';
				$('.page-content-wrapper #formerrors').html(htmli); 
                toastr.success(data.message);    
            }
        }
    });
});
</script>
@stop
