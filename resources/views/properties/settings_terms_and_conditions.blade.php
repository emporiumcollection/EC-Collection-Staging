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
            <ul class="nav nav-tabs" >
                @if(!empty($tabss))
                @foreach($tabss as $key=>$val)
                <li  @if($key == $active) class="active" @endif><a href="{{URL::to('properties_settings/'.$pid.'/'.$key)}}"> {{ $val->tab_name }}  </a></li>
                @endforeach
                @endif
            </ul>

            <div class="tab-content m-t">
                <div class="tab-pane active use-padding" id="addseasons">	
                    <div class="sbox  "> 
                        <div class="sbox-title">Terms and Conditions</div>
                        <div class="sbox-content"> 
                            <form id="add_season" class="add_season" method="POST">
                                <input type="hidden" name="property_id" value="{{$pid}}" >
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <textarea class="form-control input-lg" name="terms_n_conditions"><?php echo isset($row->terms_n_conditions)? $row->terms_n_conditions : '' ?></textarea>
                                    </div>
                                </div>
                                <div class="butt">
                                    <button type="submit" class="btn btn-success b-btn addseason">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>	 
                </div>
            </div>

        </div>	
    </div>

    @stop