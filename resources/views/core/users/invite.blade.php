@extends('layouts.app')

@section('content')

<div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3>  {{ Lang::get('core.t_blastemail') }}  <small>{{ Lang::get('core.t_blastemailsmall') }}</small></h3>
      </div>

      <ul class="breadcrumb">
       <li><a href="{{ URL::to('dashboard') }}"> Dashboard </a></li>
        <li class="active">{{ Lang::get('core.t_blastemail') }}  </li>
      </ul>
    </div>
	
 <div class="page-content-wrapper m-t">  
  <ul class="nav nav-tabs" style="margin-bottom:10px;">
    <li ><a href="{{ URL::to('core/users')}}"><i class="fa fa-user"></i> Users </a></li>
    <li class=""><a href="{{ URL::to('core/groups')}}"><i class="fa fa-users"></i> Groups</a></li>
    <li class=""><a href="{{ URL::to('core/users/blast')}}"><i class="fa fa-envelope"></i> Send Email </a></li>
    <li class="active"><a href="{{ URL::to('core/users/invite')}}"><i class="fa fa-envelope"></i> Invite </a></li>
  </ul> 

  @if(Session::has('message'))    
       {{ Session::get('message') }}
  @endif  
    
    <!-- Start blast email -->

{!! Form::open(array('url'=>'core/users/doinvite/', 'class'=>'form-horizontal ','parsley-validate'=>' ' ,'novalidate'=>' ')) !!}
        <div class="form-group  " >
          <label for="ipt" class=" control-label col-md-3">  </label>
          <div class="col-md-12">
              <ul class="parsley-error-list">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>                
           </div> 
        </div> 
		  
        <div class="col-sm-6">
          <div class="form-group  " >
                <label for="ipt" class=" control-label col-md-3">  First Name   </label>
                <div class="col-md-9">
                   {!! Form::text('first_name',null,array('class'=>'form-control', 'placeholder'=>'','required'=>'true')) !!} 
                </div> 
          </div> 
          <div class="form-group  " >
                <label for="ipt" class=" control-label col-md-3">  Last Name   </label>
                <div class="col-md-9">
                   {!! Form::text('last_name',null,array('class'=>'form-control', 'placeholder'=>'','required'=>'true')) !!} 
                </div> 
          </div> 
          <div class="form-group  " >
                <label for="ipt" class=" control-label col-md-3">  Email   </label>
                <div class="col-md-9">
                   {!! Form::text('email',null,array('class'=>'form-control', 'placeholder'=>'','required'=>'true')) !!} 
                </div> 
          </div>
          <div class="form-group  " >
              <label for="ipt" class=" control-label col-md-3"> Message   </label>
              <div class="col-md-9">
               <textarea name="message" class="form-control"></textarea>
              </div> 
          </div>  		  
		  
        </div>
        
 
        <div class="col-sm-12">


          <div class="form-group" >
          <label for="ipt" class=" control-label col-md-3"> </label>
          <div class="col-md-9">
              <button type="submit" name="submit" class="btn btn-primary">Sent Invitation </button>
           </div> 
          </div> 
	   </div>	                   
        {!! Form::close() !!}


    <!-- / blast email -->

</div>




</div>      




@stop