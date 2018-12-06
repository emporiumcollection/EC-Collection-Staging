@extends('users_admin.metronic.layouts.app')

@section('page_name')
    Property  <small>Advertising</small>
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
        <a href="{{ URL::to('advertising')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Advertising </span> 
        </a> 
    </li>
@stop

@section('content')
<div class="row">
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        <h2>Advertising</h2>
    </div> 
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ornare diam at convallis lacinia. Duis a sapien et erat finibus molestie eu id nisi. Integer nibh elit, blandit ac volutpat eget, tempus eget enim. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas mollis dictum risus. Vivamus aliquam at elit non dictum. Integer nisi ante, interdum at purus vitae, rhoncus bibendum dui. Praesent pharetra augue at ultrices facilisis. Vestibulum erat urna, iaculis et purus in, fermentum varius nibh.
    </div>
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        <hr />
    </div> 
    <div class="col-sm-12 col-md-4 col-xl-4">
        					
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