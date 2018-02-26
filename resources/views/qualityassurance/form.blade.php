@extends('layouts.app')

@section('content')

<div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
        <div class="page-title">
            <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
        </div>
        <ul class="breadcrumb">
            <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
            <li><a href="{{ URL::to('qualityassurance?return='.$return) }}">{{ $pageTitle }}</a></li>
            <li class="active">{{ Lang::get('core.addedit') }} </li>
        </ul>
    </div>
    <div class="page-content-wrapper">
        <ul class="parsley-error-list">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <div class="sbox animated fadeInRight">
            <div class="sbox-title"> <h4> <i class="fa fa-table"></i> </h4></div>
            <div class="sbox-content"> 	
                {!! Form::open(array('url'=>'qualityassurance/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
                <input name="quality_assurance_id" value="{{$row['quality_assurance_id']}}" type="hidden">
                <div class="col-md-12">
                    <div id="qa-accordion" class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#qa-accordion" href="#qa-collapse1">Quality Assurance</a>
                                </h4>
                            </div>
                            <div id="qa-collapse1" class="panel-collapse collapse in">
                                <div class="panel-body">					
                                    <div class="form-group  " >
                                        <label for="Property Id" class=" control-label col-md-4 text-left"> Hotel </label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="property_id">
                                                <?php
                                                if(!empty($hotels)) {
                                                    foreach ($hotels as $hotel) {
                                                        echo '<option ', ($row['property_id'] == $hotel->id)? 'selected' : '', ' value="'.$hotel->id.'">'.$hotel->property_name.'</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div> 
                                        <div class="col-md-2">
                                        </div>
                                    </div> 					
                                    <div class="form-group  " >
                                        <label for="Hotel Manager" class=" control-label col-md-4 text-left"> Hotel Manager </label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="hotel_manager">
                                                <?php
                                                if(!empty($hotel_managers)) {
                                                    foreach ($hotel_managers as $hotel_manager) {
                                                        echo '<option ', ($row['hotel_manager'] == $hotel_manager->id)? 'selected' : '', ' value="'.$hotel_manager->id.'">'.$hotel_manager->first_name.' '.$hotel_manager->last_name.'</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div> 
                                        <div class="col-md-2">
                                        </div>
                                    </div> 					
                                    <div class="form-group  " >
                                        <label for="Quality Assurer" class=" control-label col-md-4 text-left"> Quality Assurer </label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="quality_assurer">
                                                <?php
                                                if(!empty($quality_assurers)) {
                                                    foreach ($quality_assurers as $quality_assurer) {
                                                        echo '<option ', ($row['quality_assurer'] == $quality_assurer->id)? 'selected' : '', ' value="'.$quality_assurer->id.'">'.$quality_assurer->first_name.' '.$quality_assurer->last_name.'</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div> 
                                        <div class="col-md-2">

                                        </div>
                                    </div> 					
                                    <div class="form-group  " >
                                        <label for="Hotel Score" class=" control-label col-md-4 text-left"> Hotel Score </label>
                                        <div class="col-md-6">
                                            {!! Form::text('hotel_score', $row['hotel_score'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                        </div> 
                                        <div class="col-md-2">

                                        </div>
                                    </div> 					
                                    <div class="form-group  " >
                                        <label for="Date" class=" control-label col-md-4 text-left"> Date </label>
                                        <div class="col-md-6">
                                            {!! Form::text('date', $row['date'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                        </div> 
                                        <div class="col-md-2">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#qa-accordion" href="#qa-collapse2">Bedroom</a>
                                </h4>
                            </div>
                            <div id="qa-collapse2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="table table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>STANDARD</th>
                                                    <th>PERFORMANCE CLASSIFICATION</th>
                                                    <th>MEET</th>
                                                    <th>BELOW</th>
                                                    <th>N/A</th>
                                                    <th>NOTE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if(!empty($bedrooms)) {
                                                    foreach ($bedrooms as $bedroom) {
                                                        echo '<tr>
                                                                <td>
                                                                    <div class="">
                                                                        <input name="category[]" value="bedroom" type="hidden" />
                                                                        <textarea class="form-control" name="standard[]">'.$bedroom->standard.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="performance_classificatoon[]">'.$bedroom->performance_classificatoon.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="meet[]">'.$bedroom->meet.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="below[]">'.$bedroom->below.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="na[]">'.$bedroom->na.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="note[]">'.$bedroom->note.'</textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>';
                                                    }
                                                }
                                                else {
                                                    echo '<tr>
                                                            <td>
                                                                <div class="">
                                                                    <input name="category[]" value="bedroom" type="hidden" />
                                                                    <textarea class="form-control" name="standard[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="performance_classificatoon[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="meet[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="below[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="na[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="note[]"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <a class="add-new-fields-row btn btn-primary btn-sm" data-category="bedroom" href="#">Add Row</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#qa-accordion" href="#qa-collapse3">Bathroom</a>
                                </h4>
                            </div>
                            <div id="qa-collapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="table table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>STANDARD</th>
                                                    <th>PERFORMANCE CLASSIFICATION</th>
                                                    <th>MEET</th>
                                                    <th>BELOW</th>
                                                    <th>N/A</th>
                                                    <th>NOTE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if(!empty($bathrooms)) {
                                                    foreach ($bathrooms as $qa_row) {
                                                        echo '<tr>
                                                                <td>
                                                                    <div class="">
                                                                        <input name="category[]" value="bathroom" type="hidden" />
                                                                        <textarea class="form-control" name="standard[]">'.$qa_row->standard.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="performance_classificatoon[]">'.$qa_row->performance_classificatoon.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="meet[]">'.$qa_row->meet.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="below[]">'.$qa_row->below.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="na[]">'.$qa_row->na.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="note[]">'.$qa_row->note.'</textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>';
                                                    }
                                                }
                                                else {
                                                    echo '<tr>
                                                            <td>
                                                                <div class="">
                                                                    <input name="category[]" value="bathroom" type="hidden" />
                                                                    <textarea class="form-control" name="standard[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="performance_classificatoon[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="meet[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="below[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="na[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="note[]"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <a class="add-new-fields-row btn btn-primary btn-sm" data-category="bathroom" href="#">Add Row</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#qa-accordion" href="#qa-collapse4">Exterior/Grounds</a>
                                </h4>
                            </div>
                            <div id="qa-collapse4" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="table table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>STANDARD</th>
                                                    <th>PERFORMANCE CLASSIFICATION</th>
                                                    <th>MEET</th>
                                                    <th>BELOW</th>
                                                    <th>N/A</th>
                                                    <th>NOTE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if(!empty($exterior_grounds)) {
                                                    foreach ($exterior_grounds as $qa_row) {
                                                        echo '<tr>
                                                                <td>
                                                                    <div class="">
                                                                        <input name="category[]" value="exterior_grounds" type="hidden" />
                                                                        <textarea class="form-control" name="standard[]">'.$qa_row->standard.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="performance_classificatoon[]">'.$qa_row->performance_classificatoon.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="meet[]">'.$qa_row->meet.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="below[]">'.$qa_row->below.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="na[]">'.$qa_row->na.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="note[]">'.$qa_row->note.'</textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>';
                                                    }
                                                }
                                                else {
                                                    echo '<tr>
                                                            <td>
                                                                <div class="">
                                                                    <input name="category[]" value="exterior_grounds" type="hidden" />
                                                                    <textarea class="form-control" name="standard[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="performance_classificatoon[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="meet[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="below[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="na[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="note[]"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <a class="add-new-fields-row btn btn-primary btn-sm" data-category="exterior_grounds" href="#">Add Row</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#qa-accordion" href="#qa-collapse5">Lobby</a>
                                </h4>
                            </div>
                            <div id="qa-collapse5" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="table table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>STANDARD</th>
                                                    <th>PERFORMANCE CLASSIFICATION</th>
                                                    <th>MEET</th>
                                                    <th>BELOW</th>
                                                    <th>N/A</th>
                                                    <th>NOTE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if(!empty($lobbys)) {
                                                    foreach ($lobbys as $qa_row) {
                                                        echo '<tr>
                                                                <td>
                                                                    <div class="">
                                                                        <input name="category[]" value="lobby" type="hidden" />
                                                                        <textarea class="form-control" name="standard[]">'.$qa_row->standard.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="performance_classificatoon[]">'.$qa_row->performance_classificatoon.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="meet[]">'.$qa_row->meet.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="below[]">'.$qa_row->below.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="na[]">'.$qa_row->na.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="note[]">'.$qa_row->note.'</textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>';
                                                    }
                                                }
                                                else {
                                                    echo '<tr>
                                                            <td>
                                                                <div class="">
                                                                    <input name="category[]" value="lobby" type="hidden" />
                                                                    <textarea class="form-control" name="standard[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="performance_classificatoon[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="meet[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="below[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="na[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="note[]"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <a class="add-new-fields-row btn btn-primary btn-sm" data-category="lobby" href="#">Add Row</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#qa-accordion" href="#qa-collapse6">Restaurants/Bars</a>
                                </h4>
                            </div>
                            <div id="qa-collapse6" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="table table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>STANDARD</th>
                                                    <th>PERFORMANCE CLASSIFICATION</th>
                                                    <th>MEET</th>
                                                    <th>BELOW</th>
                                                    <th>N/A</th>
                                                    <th>NOTE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if(!empty($restaurants_bars)) {
                                                    foreach ($restaurants_bars as $qa_row) {
                                                        echo '<tr>
                                                                <td>
                                                                    <div class="">
                                                                        <input name="category[]" value="restaurants_bars" type="hidden" />
                                                                        <textarea class="form-control" name="standard[]">'.$qa_row->standard.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="performance_classificatoon[]">'.$qa_row->performance_classificatoon.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="meet[]">'.$qa_row->meet.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="below[]">'.$qa_row->below.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="na[]">'.$qa_row->na.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="note[]">'.$qa_row->note.'</textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>';
                                                    }
                                                }
                                                else {
                                                    echo '<tr>
                                                            <td>
                                                                <div class="">
                                                                    <input name="category[]" value="restaurants_bars" type="hidden" />
                                                                    <textarea class="form-control" name="standard[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="performance_classificatoon[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="meet[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="below[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="na[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="note[]"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <a class="add-new-fields-row btn btn-primary btn-sm" data-category="restaurants_bars" href="#">Add Row</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#qa-accordion" href="#qa-collapse7">Guest Room Corridors</a>
                                </h4>
                            </div>
                            <div id="qa-collapse7" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="table table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>STANDARD</th>
                                                    <th>PERFORMANCE CLASSIFICATION</th>
                                                    <th>MEET</th>
                                                    <th>BELOW</th>
                                                    <th>N/A</th>
                                                    <th>NOTE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if(!empty($guest_room_corridors)) {
                                                    foreach ($guest_room_corridors as $qa_row) {
                                                        echo '<tr>
                                                                <td>
                                                                    <div class="">
                                                                        <input name="category[]" value="guest_room_corridors" type="hidden" />
                                                                        <textarea class="form-control" name="standard[]">'.$qa_row->standard.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="performance_classificatoon[]">'.$qa_row->performance_classificatoon.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="meet[]">'.$qa_row->meet.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="below[]">'.$qa_row->below.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="na[]">'.$qa_row->na.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="note[]">'.$qa_row->note.'</textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>';
                                                    }
                                                }
                                                else {
                                                    echo '<tr>
                                                            <td>
                                                                <div class="">
                                                                    <input name="category[]" value="guest_room_corridors" type="hidden" />
                                                                    <textarea class="form-control" name="standard[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="performance_classificatoon[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="meet[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="below[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="na[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="note[]"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <a class="add-new-fields-row btn btn-primary btn-sm" data-category="guest_room_corridors" href="#">Add Row</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#qa-accordion" href="#qa-collapse8">Restrooms</a>
                                </h4>
                            </div>
                            <div id="qa-collapse8" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="table table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>STANDARD</th>
                                                    <th>PERFORMANCE CLASSIFICATION</th>
                                                    <th>MEET</th>
                                                    <th>BELOW</th>
                                                    <th>N/A</th>
                                                    <th>NOTE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if(!empty($restrooms)) {
                                                    foreach ($restrooms as $qa_row) {
                                                        echo '<tr>
                                                                <td>
                                                                    <div class="">
                                                                        <input name="category[]" value="restrooms" type="hidden" />
                                                                        <textarea class="form-control" name="standard[]">'.$qa_row->standard.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="performance_classificatoon[]">'.$qa_row->performance_classificatoon.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="meet[]">'.$qa_row->meet.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="below[]">'.$qa_row->below.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="na[]">'.$qa_row->na.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="note[]">'.$qa_row->note.'</textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>';
                                                    }
                                                }
                                                else {
                                                    echo '<tr>
                                                            <td>
                                                                <div class="">
                                                                    <input name="category[]" value="restrooms" type="hidden" />
                                                                    <textarea class="form-control" name="standard[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="performance_classificatoon[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="meet[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="below[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="na[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="note[]"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <a class="add-new-fields-row btn btn-primary btn-sm" data-category="restrooms" href="#">Add Row</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#qa-accordion" href="#qa-collapse9">Elevators</a>
                                </h4>
                            </div>
                            <div id="qa-collapse9" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="table table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>STANDARD</th>
                                                    <th>PERFORMANCE CLASSIFICATION</th>
                                                    <th>MEET</th>
                                                    <th>BELOW</th>
                                                    <th>N/A</th>
                                                    <th>NOTE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if(!empty($elevators)) {
                                                    foreach ($elevators as $qa_row) {
                                                        echo '<tr>
                                                                <td>
                                                                    <div class="">
                                                                        <input name="category[]" value="elevators" type="hidden" />
                                                                        <textarea class="form-control" name="standard[]">'.$qa_row->standard.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="performance_classificatoon[]">'.$qa_row->performance_classificatoon.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="meet[]">'.$qa_row->meet.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="below[]">'.$qa_row->below.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="na[]">'.$qa_row->na.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="note[]">'.$qa_row->note.'</textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>';
                                                    }
                                                }
                                                else {
                                                    echo '<tr>
                                                            <td>
                                                                <div class="">
                                                                    <input name="category[]" value="elevators" type="hidden" />
                                                                    <textarea class="form-control" name="standard[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="performance_classificatoon[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="meet[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="below[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="na[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="note[]"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <a class="add-new-fields-row btn btn-primary btn-sm" data-category="elevators" href="#">Add Row</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#qa-accordion" href="#qa-collapse10">HE Employee - Behavioural Standards</a>
                                </h4>
                            </div>
                            <div id="qa-collapse10" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="table table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>STANDARD</th>
                                                    <th>PERFORMANCE CLASSIFICATION</th>
                                                    <th>MEET</th>
                                                    <th>BELOW</th>
                                                    <th>N/A</th>
                                                    <th>NOTE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if(!empty($he_employee_behavioural_standards)) {
                                                    foreach ($he_employee_behavioural_standards as $qa_row) {
                                                        echo '<tr>
                                                                <td>
                                                                    <div class="">
                                                                        <input name="category[]" value="he_employee_behavioural_standards" type="hidden" />
                                                                        <textarea class="form-control" name="standard[]">'.$qa_row->standard.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="performance_classificatoon[]">'.$qa_row->performance_classificatoon.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="meet[]">'.$qa_row->meet.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="below[]">'.$qa_row->below.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="na[]">'.$qa_row->na.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="note[]">'.$qa_row->note.'</textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>';
                                                    }
                                                }
                                                else {
                                                    echo '<tr>
                                                            <td>
                                                                <div class="">
                                                                    <input name="category[]" value="he_employee_behavioural_standards" type="hidden" />
                                                                    <textarea class="form-control" name="standard[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="performance_classificatoon[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="meet[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="below[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="na[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="note[]"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <a class="add-new-fields-row btn btn-primary btn-sm" data-category="he_employee_behavioural_standards" href="#">Add Row</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#qa-accordion" href="#qa-collapse11">Fitness Center</a>
                                </h4>
                            </div>
                            <div id="qa-collapse11" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="table table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>STANDARD</th>
                                                    <th>PERFORMANCE CLASSIFICATION</th>
                                                    <th>MEET</th>
                                                    <th>BELOW</th>
                                                    <th>N/A</th>
                                                    <th>NOTE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if(!empty($fitness_centers)) {
                                                    foreach ($fitness_centers as $qa_row) {
                                                        echo '<tr>
                                                                <td>
                                                                    <div class="">
                                                                        <input name="category[]" value="fitness_center" type="hidden" />
                                                                        <textarea class="form-control" name="standard[]">'.$qa_row->standard.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="performance_classificatoon[]">'.$qa_row->performance_classificatoon.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="meet[]">'.$qa_row->meet.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="below[]">'.$qa_row->below.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="na[]">'.$qa_row->na.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="note[]">'.$qa_row->note.'</textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>';
                                                    }
                                                }
                                                else {
                                                    echo '<tr>
                                                            <td>
                                                                <div class="">
                                                                    <input name="category[]" value="fitness_center" type="hidden" />
                                                                    <textarea class="form-control" name="standard[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="performance_classificatoon[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="meet[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="below[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="na[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="note[]"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <a class="add-new-fields-row btn btn-primary btn-sm" data-category="fitness_center" href="#">Add Row</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#qa-accordion" href="#qa-collapse12">Swimming Pool/Beach</a>
                                </h4>
                            </div>
                            <div id="qa-collapse12" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="table table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>STANDARD</th>
                                                    <th>PERFORMANCE CLASSIFICATION</th>
                                                    <th>MEET</th>
                                                    <th>BELOW</th>
                                                    <th>N/A</th>
                                                    <th>NOTE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if(!empty($swimming_pool_beachs)) {
                                                    foreach ($swimming_pool_beachs as $qa_row) {
                                                        echo '<tr>
                                                                <td>
                                                                    <div class="">
                                                                        <input name="category[]" value="swimming_pool_beach" type="hidden" />
                                                                        <textarea class="form-control" name="standard[]">'.$qa_row->standard.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="performance_classificatoon[]">'.$qa_row->performance_classificatoon.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="meet[]">'.$qa_row->meet.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="below[]">'.$qa_row->below.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="na[]">'.$qa_row->na.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="note[]">'.$qa_row->note.'</textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>';
                                                    }
                                                }
                                                else {
                                                    echo '<tr>
                                                            <td>
                                                                <div class="">
                                                                    <input name="category[]" value="swimming_pool_beach" type="hidden" />
                                                                    <textarea class="form-control" name="standard[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="performance_classificatoon[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="meet[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="below[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="na[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="note[]"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <a class="add-new-fields-row btn btn-primary btn-sm" data-category="swimming_pool_beach" href="#">Add Row</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#qa-accordion" href="#qa-collapse13">Tennis/Squash Courts</a>
                                </h4>
                            </div>
                            <div id="qa-collapse13" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="table table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>STANDARD</th>
                                                    <th>PERFORMANCE CLASSIFICATION</th>
                                                    <th>MEET</th>
                                                    <th>BELOW</th>
                                                    <th>N/A</th>
                                                    <th>NOTE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if(!empty($tennis_squash_courts)) {
                                                    foreach ($tennis_squash_courts as $qa_row) {
                                                        echo '<tr>
                                                                <td>
                                                                    <div class="">
                                                                        <input name="category[]" value="tennis_squash_courts" type="hidden" />
                                                                        <textarea class="form-control" name="standard[]">'.$qa_row->standard.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="performance_classificatoon[]">'.$qa_row->performance_classificatoon.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="meet[]">'.$qa_row->meet.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="below[]">'.$qa_row->below.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="na[]">'.$qa_row->na.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="note[]">'.$qa_row->note.'</textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>';
                                                    }
                                                }
                                                else {
                                                    echo '<tr>
                                                            <td>
                                                                <div class="">
                                                                    <input name="category[]" value="tennis_squash_courts" type="hidden" />
                                                                    <textarea class="form-control" name="standard[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="performance_classificatoon[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="meet[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="below[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="na[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="note[]"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <a class="add-new-fields-row btn btn-primary btn-sm" data-category="bedroom" href="#">Add Row</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#qa-accordion" href="#qa-collapse14">Steam Room/Sauna/Jacuzzi</a>
                                </h4>
                            </div>
                            <div id="qa-collapse14" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="table table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>STANDARD</th>
                                                    <th>PERFORMANCE CLASSIFICATION</th>
                                                    <th>MEET</th>
                                                    <th>BELOW</th>
                                                    <th>N/A</th>
                                                    <th>NOTE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if(!empty($steam_room_sauna_jacuzzis)) {
                                                    foreach ($steam_room_sauna_jacuzzis as $qa_row) {
                                                        echo '<tr>
                                                                <td>
                                                                    <div class="">
                                                                        <input name="category[]" value="steam_room_sauna_jacuzzi" type="hidden" />
                                                                        <textarea class="form-control" name="standard[]">'.$qa_row->standard.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="performance_classificatoon[]">'.$qa_row->performance_classificatoon.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="meet[]">'.$qa_row->meet.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="below[]">'.$qa_row->below.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="na[]">'.$qa_row->na.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="note[]">'.$qa_row->note.'</textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>';
                                                    }
                                                }
                                                else {
                                                    echo '<tr>
                                                            <td>
                                                                <div class="">
                                                                    <input name="category[]" value="steam_room_sauna_jacuzzi" type="hidden" />
                                                                    <textarea class="form-control" name="standard[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="performance_classificatoon[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="meet[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="below[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="na[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="note[]"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <a class="add-new-fields-row btn btn-primary btn-sm" data-category="steam_room_sauna_jacuzzi" href="#">Add Row</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#qa-accordion" href="#qa-collapse15">Changing Rooms</a>
                                </h4>
                            </div>
                            <div id="qa-collapse15" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="table table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>STANDARD</th>
                                                    <th>PERFORMANCE CLASSIFICATION</th>
                                                    <th>MEET</th>
                                                    <th>BELOW</th>
                                                    <th>N/A</th>
                                                    <th>NOTE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if(!empty($changing_rooms)) {
                                                    foreach ($changing_rooms as $qa_row) {
                                                        echo '<tr>
                                                                <td>
                                                                    <div class="">
                                                                        <input name="category[]" value="changing_rooms" type="hidden" />
                                                                        <textarea class="form-control" name="standard[]">'.$qa_row->standard.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="performance_classificatoon[]">'.$qa_row->performance_classificatoon.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="meet[]">'.$qa_row->meet.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="below[]">'.$qa_row->below.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="na[]">'.$qa_row->na.'</textarea>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
                                                                        <textarea class="form-control" name="note[]">'.$qa_row->note.'</textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>';
                                                    }
                                                }
                                                else {
                                                    echo '<tr>
                                                            <td>
                                                                <div class="">
                                                                    <input name="category[]" value="changing_rooms" type="hidden" />
                                                                    <textarea class="form-control" name="standard[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="performance_classificatoon[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="meet[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="below[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="na[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="">
                                                                    <textarea class="form-control" name="note[]"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <a class="add-new-fields-row btn btn-primary btn-sm" data-category="changing_rooms" href="#">Add Row</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#qa-accordion" href="#qa-collapse16">Other Fields</a>
                                </h4>
                            </div>
                            <div id="qa-collapse16" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <!--VC Start-->
                                    @include('layouts/crm_layout/ai_vc_fields')
                                    <!--VC End-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="clear:both"></div>
                <div class="form-group">
                    <label class="col-sm-4 text-right">&nbsp;</label>
                    <div class="col-sm-8">	
                        <button type="submit" name="apply" class="btn btn-info btn-sm" ><i class="fa  fa-check-circle"></i> {{ Lang::get('core.sb_apply') }}</button>
                        <button type="submit" name="submit" class="btn btn-primary btn-sm" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
                        <button type="button" onclick="location.href ='{{ URL::to('qualityassurance?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
                    </div>	  
                </div> 
                {!! Form::close() !!}
            </div>
        </div>		 
    </div>	
</div>			 
<script type="text/javascript">
    $(document).ready(function () {
        $('.removeCurrentFiles').on('click', function () {
            var removeUrl = $(this).attr('href');
            $.get(removeUrl, function (response) {});
            $(this).parent('div').empty();
            return false;
        });
        
        
        $(".add-new-fields-row").click(function( event ) {
            event.preventDefault();
            
            var category = $(this).data("category");
            
            var htmlRow = '<tr>';
                htmlRow += '<td>';
                    htmlRow += '<div class="">';
                        htmlRow += '<input name="category[]" value="' + category + '" type="hidden" />';
                        htmlRow += '<textarea class="form-control" name="standard[]"></textarea>';
                    htmlRow += '</div>';
                htmlRow += '</td>';
                htmlRow += '<td>';
                    htmlRow += '<div class="">';
                        htmlRow += '<textarea class="form-control" name="performance_classificatoon[]"></textarea>';
                    htmlRow += '</div>';
                htmlRow += '</td>';
                htmlRow += '<td>';
                    htmlRow += '<div class="">';
                        htmlRow += '<textarea class="form-control" name="meet[]"></textarea>';
                    htmlRow += '</div>';
                htmlRow += '</td>';
                htmlRow += '<td>';
                    htmlRow += '<div class="">';
                        htmlRow += '<textarea class="form-control" name="below[]"></textarea>';
                    htmlRow += '</div>';
                htmlRow += '</td>';
                htmlRow += '<td>';
                    htmlRow += '<div class="">';
                        htmlRow += '<textarea class="form-control" name="na[]"></textarea>';
                    htmlRow += '</div>';
                htmlRow += '</td>';
                htmlRow += '<td>';
                    htmlRow += '<div class="">';
                        htmlRow += '<textarea class="form-control" name="note[]"></textarea>';
                    htmlRow += '</div>';
                htmlRow += '</td>';
            htmlRow += '</tr>';
            
            $(this).parents(".panel-body").find("tbody").append( htmlRow );
        });
    });
</script>
@include('layouts/crm_layout/ai_vc')
@stop