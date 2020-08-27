@extends('layouts.app')

@section('content')

<link href="{{ asset('sximo/css/bookingSys.css')}}" rel="stylesheet">
<script src="{{ asset('sximo/js/jquery.validate.js')}}"></script>

<div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
        <div class="page-title">
            <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
        </div>

        <ul class="breadcrumb">
            <li><a href="{{ URL::to('dashboard') }}"> Dashboard </a></li>
            <li class="active">{{ $pageTitle }}</li>
        </ul>	  

    </div>
    <div class="page-content-wrapper">
        <div id="formerrors"></div>
        @if(Session::has('message'))

        {{ Session::get('message') }}

        @endif

        <div class="block-content">
            
            @include('events/config_tab')
            
            <div class="tab-content m-t">
                <div class="tab-pane active use-padding" id="addseasons">	
                    <div class="sbox  "> 
                        <div class="sbox-title">Terms and Conditions</div>
                        <div class="sbox-content"> 
                            <form id="frm_add_event_term" method="POST">
                                <input type="hidden" name="property_id" value="{{$pid}}" >
                                <div class="row">
                                    <div class="form-group col-lg-6">
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
    </div>
    
    <script>
    $(document).ready(function(){
        
    });
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
                }
            }
        });
    });
    </script>

    @stop
    
