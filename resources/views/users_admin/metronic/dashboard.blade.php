@extends('users_admin.metronic.layouts.app')

@section('page_name')
    Dashboard
@stop

@section('breadcrumb')
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('dashboard')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Dashboard </span> 
        </a> 
    </li>
@stop

@section('content')
    Dashboard Content
@stop