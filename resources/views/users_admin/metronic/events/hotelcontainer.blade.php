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
        <a href="{{ URL::to('hotelcontainer')}}" class="m-nav__link"> 
            <span class="m-nav__link-text breadcrumb-end"> Digital Media Management &amp; Distribution System </span> 
        </a> 
    </li>    
@stop

@section('content')
<div class="row">
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        <h2>Digital Media Management &amp; Distribution System</h2>
    </div> 
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        The Digital Media Management & Distribution System is the DeFacto travel industry digital media management, and is the only all-in-one solution that helps hotels with the storage, management and distribution of visual content across all marketing and distribution channels.
    </div>
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        <hr />
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