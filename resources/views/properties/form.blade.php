@extends('layouts.app')

@section('content')
<style>
.radio-inline{ padding-left: 0px;}
</style>
<div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
        <div class="page-title">
            <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
        </div>
        <ul class="breadcrumb">
            <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
            <li><a href="{{ URL::to('properties?return='.$return) }}">{{ $pageTitle }}</a></li>
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
            <div class="sbox-title"> <h4> <i class="fa fa-table"></i> <a href="{{URL::to('properties_settings/'.$row['id'].'/types')}}" class="tips btn btn-xs btn-primary pull-right" title="" data-original-title="Reservation Management"><i class="fa fa-edit"></i>&nbsp;Reservation Management</a></h4></div>
            <div class="sbox-content"> 	

                {!! Form::open(array('url'=>'properties/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#LocationDetails" data-toggle="tab">Hotel Details</a></li>
                    <li class=""><a href="#HotelAdress" data-toggle="tab">Hotel Adress</a></li>
                    <li class=""><a href="#Owner" data-toggle="tab">Owner</a></li>
                    <li class=""><a href="#reports" data-toggle="tab">Reports</a></li>
                    <!--<li class="AgentAgency" ><a href="#AgentAgency" data-toggle="tab" >Agents</a></li>-->
                </ul>
                <div class="tab-content">
                    <div class="tab-pane m-t active" id="LocationDetails">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#propertyinfo" data-toggle="tab">Property Info</a></li>
                            <li class="yachtin" style="display:none;"><a href="#yachtinfo" data-toggle="tab">Yacht Info </a></li>
                            <li class=""><a href="#rooms_suites" data-toggle="tab">Rooms & Suites</a></li>
                            <li class=""><a href="#architecture_design" data-toggle="tab">Architecture & Design</a></li>
                            <li class="" ><a href="#spas" data-toggle="tab" >Spas</a></li>
                            <li class="" ><a href="#restaurant" data-toggle="tab" >Restaurant</a></li>
                            <li class="" ><a href="#bar" data-toggle="tab" >Bar</a></li>
                            <li class="" ><a href="#video" data-toggle="tab" >Video</a></li>
                            <li class="" ><a href="#socialmedia" data-toggle="tab" >Social Networks</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane m-t active" id="propertyinfo">

                                <div class="form-group hidethis " style="display:none;">
                                    <label for="Id" class=" control-label col-md-4 text-left"> Id </label>
                                    <div class="col-md-6">
                                        {!! Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 					
                                <div class="form-group  " >
                                    <label for="Property Name" class=" control-label col-md-4 text-left"> Property Name <span class="asterix"> * </span></label>
                                    <div class="col-md-6">
                                        {!! Form::text('property_name', $row['property_name'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>
                                
                                <div class="form-group  " >
									<label for="Property Category" class=" control-label col-md-4 text-left"> Property Category <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  <select name='property_category[]' multiple rows='5' id='property_cat_ids' class='select2 ' required  ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
							     </div>
                                  					
                                <div class="form-group  " >
                                    <label for="Property Short Name" class=" control-label col-md-4 text-left"> Property Short Name </label>
                                    <div class="col-md-6">
                                        {!! Form::text('property_short_name', $row['property_short_name'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 					
                                <div class="form-group  " >
                                    <label for="Property Type" class=" control-label col-md-4 text-left"> Property Type <span class="asterix"> * </span></label>
                                    <div class="col-md-6">

                                        <?php $property_type = explode(',', $row['property_type']);
                                        $property_type_opt = array('Hotel' => 'Hotel', 'Yachts' => 'Yachts', 'Villas' => 'Villas', 'Spas' => 'Spas', 'Safari Lodges' => 'Safari Lodges');
                                        ?>
                                        <select name='property_type' id='property_type' rows='5' required  class='select2 ' onchange="check_yachts(this.value)";  > 
                                            <?php
                                            foreach ($property_type_opt as $key => $val) {
                                                echo "<option  value ='$key' " . ($row['property_type'] == $key ? " selected='selected' " : '' ) . ">$val</option>";
                                            }
                                            ?></select> 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 					
                                <div class="form-group  " >
                                    <label for="Booking Type" class=" control-label col-md-4 text-left"> Booking Type <span class="asterix"> * </span></label>
                                    <div class="col-md-6">

                                        <?php $booking_type = explode(',', $row['booking_type']);
                                        $booking_type_opt = array('Rent' => 'Rent', 'Buy' => 'Buy', 'Both' => 'Both',);
                                        ?>
                                        <select name='booking_type' rows='5' required  class='select2 '  > 
                                            <?php
                                            foreach ($booking_type_opt as $key => $val) {
                                                echo "<option  value ='$key' " . ($row['booking_type'] == $key ? " selected='selected' " : '' ) . ">$val</option>";
                                            }
                                            ?></select> 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 					
                                <div class="form-group  " >
                                    <label for="City Tax ( in % )" class=" control-label col-md-4 text-left"> City Tax ( in % ) </label>
                                    <div class="col-md-6">
                                        <label class="radio-inline"><input type="radio" name="rdcitytax" value="no" {{$row['citytaxyesno']=='no' ? "checked='checked'" : '' }} >No</label>
                                        <label class="radio-inline"><input type="radio" name="rdcitytax" value="yes"  {{$row['citytaxyesno']=='yes' ? "checked='checked'" : '' }}>Yes</label>
                                        <div class="dvcitytax" style="{{$row['citytaxyesno']=='yes' ? "display: '';" : 'display: none;' }} padding: 8px 0px 0px 0px;">
                                            <div class="col-md-3">
                                                <label>Adult</label>
                                                {{-- */ $adult_tax  = ($row['adult_tax']!='' and $row['adult_tax']!=NULL) ? $row['adult_tax'] : $default_adult_tax->content; /* --}}
                                                {!! Form::text('adult_tax', $adult_tax, array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                            </div>                                            
                                            <div class="col-md-3">
                                                <label>Junior</label>
                                                {{-- */ $junior_tax  = ($row['junior_tax']!='' and $row['junior_tax']!=NULL) ? $row['junior_tax'] : $default_junior_tax->content; /* --}}
                                                {!! Form::text('junior_tax', $junior_tax, array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                            </div>
                                            <div class="col-md-3">
                                                <label>Infant</label>
                                                {{-- */ $baby_tax  = ($row['baby_tax']!='' and $row['baby_tax']!=NULL) ? $row['baby_tax'] : $default_baby_tax->content; /* --}}
                                                {!! Form::text('baby_tax', $baby_tax, array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>
                                <div class="form-group  " >
                                    <label for="Commission ( in % )" class=" control-label col-md-4 text-left"> Commission ( in % ) </label>
                                    <div class="col-md-6">
                                        {!! Form::text('commission', $row['commission'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group  " >
                                    <label for="about_property" class=" control-label col-md-4 text-left"> About </label>
                                    <div class="col-md-6">
                                        <textarea name="about_property" class="form-control">{{$row['about_property']}}</textarea> 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 

                                <div class="form-group  " >
                                    <label for="Property USP" class=" control-label col-md-4 text-left"> Property USP </label>
                                    <div class="col-md-6">
                                        <textarea name="property_usp" class="form-control">{{$row['property_usp']}}</textarea> 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 

                                <div class="form-group  " >
                                    <label for="Assign User" class=" control-label col-md-4 text-left"> Assign User <span class="asterix"> * </span></label>
                                    <div class="col-md-6">
                                        <select name='assigned_user_id[]' rows='5' id='assigned_user_id' class='select2 ' required  multiple="multiple" ></select> 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 

                                <div class="form-group  " >
                                    <label for="Assign Amenities" class=" control-label col-md-4 text-left"> Assign Amenities </label>
                                    <div class="col-md-6">
                                        <select name='assigned_amenities[]' rows='5' id='assigned_amenities' class='select2 ' multiple="multiple"  >
                                            @if(!empty($amenties))
                                            @foreach($amenties as $amenty)
                                            <option value="{{$amenty->id}}" {{(isset($row['assign_amenities']) && in_array($amenty->id,explode(',',$row['assign_amenities']))) ? " selected='selected' " : '' }}>{{$amenty->amenity_title}}</option>
                                            @endforeach
                                            @endif
                                        </select> 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 

                                <div class="form-group  " >
                                    <label for="Copy Amenities" class=" control-label col-md-4 text-left"> Copy Amenities to Rooms </label>
                                    <div class="col-md-6">
                                        <input name="copy_amenities_rooms" id="copy_amenities_rooms" type="checkbox" class="form-control input-sm" value="1" {{($row['copy_amenities_rooms'] == 1) ? " checked='checked' " : '' }}  /> 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 
                                <div class="form-group  " >
                                    <label for="Destinations" class=" control-label col-md-4 text-left"> Destinations</label>
                                    <div class="col-md-6">

                                        <select name='destinations[]' id="property_category_id" rows='5'   class='select2 ' multiple="multiple"   > 
                                            <option  value ="0">-- Select Category --</option> 
                                            @foreach($categories as $val)

                                            <option  value ="{{$val->id}}" {{(isset($row['property_category_id']) && in_array($val->id,explode(',',$row['property_category_id']))) ? " selected='selected' " : '' }}>{{$val->category_name}}</option> 						
                                            @endforeach						
                                        </select> 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group  " >
                                    <label for="Copy Amenities" class=" control-label col-md-4 text-left"> Use Default Seasons </label>
                                    <div class="col-md-6">
                                        <input name="default_seasons" id="default_seasons" type="checkbox" class="form-control input-sm" value="1" {{($row['default_seasons'] == 1) ? " checked='checked' " : '' }}  /> 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group" >
                                    <label for="Detail Section 1 Title" class=" control-label col-md-4 text-left"> Detail Section 1 Title </label>
                                    <div class="col-md-6">
                                        {!! Form::text('detail_section1_title', $row['detail_section1_title'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group" >
                                    <label for="Detail Section 1 Description Box 1" class=" control-label col-md-4 text-left"> Detail Section 1 Description Box 1 </label>
                                    <div class="col-md-6">
                                        <textarea name="detail_section1_description_box1" class="form-control">{{$row['detail_section1_description_box1']}}</textarea> 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 

                                <div class="form-group" >
                                    <label for="Detail Section 1 Description Box 2" class=" control-label col-md-4 text-left"> Detail Section 1 Description Box 2 </label>
                                    <div class="col-md-6">
                                        <textarea name="detail_section1_description_box2" class="form-control">{{$row['detail_section1_description_box2']}}</textarea> 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 

                                <div class="form-group" >
                                    <label for="Detail Section 2 Title" class=" control-label col-md-4 text-left"> Detail Section 2 Title </label>
                                    <div class="col-md-6">
                                        {!! Form::text('detail_section2_title', $row['detail_section2_title'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group" >
                                    <label for="Detail Section 2 Description Box 1" class=" control-label col-md-4 text-left"> Detail Section 2 Description Box 1 </label>
                                    <div class="col-md-6">
                                        <textarea name="detail_section2_description_box1" class="form-control">{{$row['detail_section2_description_box1']}}</textarea> 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group" >
                                    <label for="Detail Section 2 Description Box 2" class=" control-label col-md-4 text-left"> Detail Section 2 Description Box 2 </label>
                                    <div class="col-md-6">
                                        <textarea name="detail_section2_description_box2" class="form-control">{{$row['detail_section2_description_box2']}}</textarea> 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group  " >
                                    <label for="Assign Detail City" class=" control-label col-md-4 text-left"> Assign Detail City</label>
                                    <div class="col-md-6">

                                        <select name='assign_detail_city' id="assign_detail_city" rows='5' class='select2 ' > 
                                            <option  value ="0">-- Select --</option> 
                                            @foreach($categories as $val)

                                            <option  value ="{{$val->category_name}}" {{(isset($row['assign_detail_city']) && ($val->category_name==$row['assign_detail_city'])) ? " selected='selected' " : '' }}>{{$val->category_name}}</option> 						
                                            @endforeach						
                                        </select> 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>
								
								<div class="form-group  " >
                                    <label for="Featured Property" class=" control-label col-md-4 text-left"> Featured Property </label>
                                    <div class="col-md-6">
                                        <input name="feature_property" id="feature_property" type="checkbox" class="form-control input-sm" value="1" {{($row['feature_property'] == 1) ? " checked='checked' " : '' }}  /> 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>
								
								<div class="form-group  " >
                                    <label for="Editor's Choice" class=" control-label col-md-4 text-left"> Editor's Choice </label>
                                    <div class="col-md-6">
                                        <input name="editor_choice_property" id="editor_choice_property" type="checkbox" class="form-control input-sm" value="1" {{($row['editor_choice_property'] == 1) ? " checked='checked' " : '' }}  /> 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>
								
								<div class="form-group  " >
                                    <label for="Restaurants" class=" control-label col-md-4 text-left"> Restaurants</label>
                                    <div class="col-md-6">

                                        <select name='restaurantids[]' id="restaurantids" rows='5'   class='select2 ' multiple="multiple"   > 
                                            <option  value ="0">-- Select Restaurant --</option> 
                                            @foreach($restaurants as $val)

                                            <option  value ="{{$val->id}}" {{(isset($row['restaurant_ids']) && in_array($val->id,explode(',',$row['restaurant_ids']))) ? " selected='selected' " : '' }}>{{$val->title}}</option> 						
                                            @endforeach						
                                        </select> 
                                    </div> 
                                    <div class="col-md-2">
										<a href="{{URL::to('restaurant')}}" >Add Restaurants</a>
                                    </div>
                                </div>
								
								<div class="form-group  " >
                                    <label for="Bars" class=" control-label col-md-4 text-left"> Bars</label>
                                    <div class="col-md-6">

                                        <select name='barids[]' id="barids" rows='5'   class='select2 ' multiple="multiple"   > 
                                            <option  value ="0">-- Select Bar --</option> 
                                            @foreach($bars as $val)

                                            <option  value ="{{$val->id}}" {{(isset($row['bar_ids']) && in_array($val->id,explode(',',$row['bar_ids']))) ? " selected='selected' " : '' }}>{{$val->title}}</option> 						
                                            @endforeach						
                                        </select> 
                                    </div> 
                                    <div class="col-md-2">
										<a href="{{URL::to('bar')}}" >Add Bars</a>
                                    </div>
                                </div>
								
								<div class="form-group  " >
                                    <label for="Spas" class=" control-label col-md-4 text-left"> Spas</label>
                                    <div class="col-md-6">

                                        <select name='spaids[]' id="spaids" rows='5'   class='select2 ' multiple="multiple"   > 
                                            <option  value ="0">-- Select Spa --</option> 
                                            @foreach($spas as $val)

                                            <option  value ="{{$val->id}}" {{(isset($row['spa_ids']) && in_array($val->id,explode(',',$row['spa_ids']))) ? " selected='selected' " : '' }}>{{$val->title}}</option> 						
                                            @endforeach						
                                        </select> 
                                    </div> 
                                    <div class="col-md-2">
										<a href="{{URL::to('spa')}}" >Add Spas</a>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane m-t" id="yachtinfo">
                                <div class="form-group  " >
                                    <label for="Yachts Categories" class=" control-label col-md-4 text-left"> Yachts Categories </label>
                                    <div class="col-md-6">

                                        <?php $yacht_category = explode(',', $row['yacht_category']);
                                        $yacht_category_opt = array('Yachts for Charter' => 'Yachts for Charter', 'Sailing Yachts' => 'Sailing Yachts', 'Motor Yachts' => 'Motor Yachts', 'Yachts for Sale' => 'Yachts for Sale');
                                        ?>
                                        <select name='yacht_category[]' multiple="" rows='5' required  class='select2 '  > 
                                            <?php
                                            $yacht_category = explode(', ', $row['yacht_category']);
                                            foreach ($yacht_category_opt as $key => $val) {
                                                echo "<option  value ='$key' " . (in_array($key, $yacht_category) ? " selected='selected' " : '' ) . ">$val</option>";
                                            }
                                            ?></select> 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 					

                                <div class="form-group  " >
                                    <label for="Year of Build" class=" control-label col-md-4 text-left"> Year of Build</label>
                                    <div class="col-md-6">
                                        <select name='yacht_build_year' rows='5' id='yacht_build_year' class='select2'  >
                                            @for($year=1950;$year<=date('Y'); $year++)
                                            <option value="{{$year}}" {{ ($row['yacht_category']==$year) ? 'selected="selected"' : '' }}>{{$year}}</option>
                                            @endfor
                                        </select>
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 					
                                <div class="form-group  " >
                                    <label for="Guest" class=" control-label col-md-4 text-left"> Guest</label>
                                    <div class="col-md-6">
                                        {!! Form::text('yachts_guest', $row['yachts_guest'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 					


                                <div class="form-group  " >
                                    <label for="Length" class=" control-label col-md-4 text-left"> Length</label>
                                    <div class="col-md-6">
                                        {!! Form::text('yacht_length', $row['yacht_length'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group  " >
                                    <label for="Builder" class=" control-label col-md-4 text-left"> Builder </label>
                                    <div class="col-md-6">
                                        <select name='yacht_builder[]' rows='5' id='yacht_builder' class='select2 ' multiple="multiple"  >
                                            @if(!empty($designers))
                                            @foreach($designers as $designer)
                                            <option value="{{$designer->id}}" {{(isset($row['yacht_builder']) && in_array($designer->id,explode(',',$row['yacht_builder']))) ? " selected='selected' " : '' }}>{{$designer->designer_name}}</option>
                                            @endforeach
                                            @endif
                                        </select> 
                                    </div> 
                                    <div class="col-md-2">
                                        <a href="{{URL::to('designers/update')}}" target="_blank">Add Designer</a>
                                    </div>
                                </div> 

                                <div class="form-group  " >
                                    <label for="Beam" class=" control-label col-md-4 text-left"> Beam </label>
                                    <div class="col-md-6">
                                        {!! Form::text('yacht_beam', $row['yacht_beam'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group  " >
                                    <label for="Draft" class=" control-label col-md-4 text-left"> Draft </label>
                                    <div class="col-md-6">
                                        {!! Form::text('yacht_draft', $row['yacht_draft'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 

                                <div class="form-group  " >
                                    <label for="GRT" class=" control-label col-md-4 text-left"> GRT </label>
                                    <div class="col-md-6">
                                        {!! Form::text('yacht_grt', $row['yacht_grt'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group  " >
                                    <label for="Cabins" class=" control-label col-md-4 text-left"> Cabins </label>
                                    <div class="col-md-6">
                                        {!! Form::text('yacht_cabins', $row['yacht_cabins'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group  " >
                                    <label for="Crew" class=" control-label col-md-4 text-left"> Crew</label>
                                    <div class="col-md-6">
                                        <select name='yacht_crew' rows='5' id='yacht_crew' class='select2'  >
                                            @for($crew=1;$crew<=100; $crew++)
                                            <option value="{{$crew}}" {{ ($row['yacht_crew']==$crew) ? 'selected="selected"' : '' }}>{{$crew}}</option>
                                            @endfor
                                        </select>
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group  " >
                                    <label for="For Sale" class=" control-label col-md-4 text-left"> For Sale </label>
                                    <div class="col-md-6">
                                        {!! Form::text('yacht_for_sale', $row['yacht_for_sale'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group  " >
                                    <label for="For Charter" class=" control-label col-md-4 text-left"> For Charter </label>
                                    <div class="col-md-6">
                                        {!! Form::text('yacht_for_charter', $row['yacht_for_charter'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane m-t" id="rooms_suites">

                                <div class="form-group  " >
                                    <label for="Title" class=" control-label col-md-4 text-left"> Title </label>
                                    <div class="col-md-6">
                                        {!! Form::text('rooms_suites_title', $row['rooms_suites_title'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 

                                <div class="form-group  " >
                                    <label for="Description" class=" control-label col-md-4 text-left"> Description </label>
                                    <div class="col-md-6">
                                        <textarea name="rooms_suites_desciription" class="form-control">{{$row['rooms_suites_desciription']}}</textarea> 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 

                                <div class="form-group  " >
                                    <label for="Image" class=" control-label col-md-4 text-left"> Image </label>
                                    <div class="col-md-6">
                                        <input  type='file' name='rooms_suites_image' id='rooms_suites_image'  />
                                        <div >
                                            {!! SiteHelpers::showUploadedFile($row['rooms_suites_image'],'/uploads/properties_subtab_imgs/') !!}

                                        </div>					

                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Video Type" class=" control-label col-md-4 text-left"> Video Type </label>
                                    <div class="col-md-6"> 
                                        <label class='radio radio-inline'>
                                            <input type='radio' name='rooms_suites_video_type' value ='upload' id='rooms_suites_displayupload' @if($row['rooms_suites_video_type'] == 'upload') checked="checked" @endif > Upload </label>
                                        <label class='radio radio-inline'>
                                            <input type='radio' name='rooms_suites_video_type' value ='link' id='rooms_suites_displaylink' @if($row['rooms_suites_video_type'] == 'link') checked="checked" @endif > Link </label> 
                                    </div> 

                                </div>

                                <div class="form-group rooms_suites_videotypeupload" style="display:none;" >
                                    <label for="Video" class=" control-label col-md-4 text-left"> Video </label>
                                    <div class="col-md-6">
                                        <input  type='file' name='rooms_suites_video' id='rooms_suites_video'  />
                                        <div >
                                            {!! SiteHelpers::showUploadedFile($row['rooms_suites_video'],'/uploads/properties_subtab_imgs/') !!}

                                        </div>					

                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="rooms_suites_videotypelink" style="display:none;" >
                                    <div class="form-group">
                                        <label for="Link Type" class=" control-label col-md-4 text-left"> Link Type </label>
                                        <div class="col-md-8"> 
                                            <label class='radio radio-inline'>
                                                <input type='radio' name='rooms_suites_video_link_type' value ='youtube' @if($row['rooms_suites_video_link_type'] == 'youtube') checked="checked" @endif > Youtube </label>
                                            <label class='radio radio-inline'>
                                                <input type='radio' name='rooms_suites_video_link_type' value ='vimeo' @if($row['rooms_suites_video_link_type'] == 'vimeo') checked="checked" @endif > Vimeo </label> 
                                        </div> 

                                    </div>

                                    <div class="form-group" >
                                        <label for="Video Link" class=" control-label col-md-4 text-left"> Video Link </label>
                                        <div class="col-md-8">
                                            <input type='text' name='rooms_suites_video_link' id='rooms_suites_video_link' class="form-control" value="{{$row['rooms_suites_video_link']}}" />
                                        </div> 


                                    </div>
                                </div>


                            </div>

                            <div class="tab-pane m-t" id="architecture_design">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#architecture_design_architecture" data-toggle="tab">Architecture</a></li>
                                    <li class=""><a href="#architecture_design_design" data-toggle="tab">Design</a></li>
                                    <li class=""><a href="#architecture_design_designer" data-toggle="tab">Designer</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane m-t active" id="architecture_design_architecture">
                                        <div class="form-group  " >
                                            <label for="Title" class=" control-label col-md-4 text-left"> Title </label>
                                            <div class="col-md-6">
                                                {!! Form::text('architecture_title', $row['architecture_title'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div> 

                                        <div class="form-group  " >
                                            <label for="Description" class=" control-label col-md-4 text-left"> Description </label>
                                            <div class="col-md-6">
                                                <textarea name="architecture_desciription" class="form-control">{{$row['architecture_desciription']}}</textarea> 
                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div> 

                                        <div class="form-group  " >
                                            <label for="Image" class=" control-label col-md-4 text-left"> Image </label>
                                            <div class="col-md-6">
                                                <input  type='file' name='architecture_image' id='architecture_image'  />
                                                <div >
                                                    {!! SiteHelpers::showUploadedFile($row['architecture_image'],'/uploads/properties_subtab_imgs/') !!}

                                                </div>					

                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="Video Type" class=" control-label col-md-4 text-left"> Video Type </label>
                                            <div class="col-md-6"> 
                                                <label class='radio radio-inline'>
                                                    <input type='radio' name='architecture_video_type' value ='upload' id='architecture_displayupload' @if($row['architecture_video_type'] == 'upload') checked="checked" @endif > Upload </label>
                                                <label class='radio radio-inline'>
                                                    <input type='radio' name='architecture_video_type' value ='link' id='architecture_displaylink' @if($row['architecture_video_type'] == 'link') checked="checked" @endif > Link </label> 
                                            </div> 

                                        </div>

                                        <div class="form-group architecture_videotypeupload" style="display:none;" >
                                            <label for="Video" class=" control-label col-md-4 text-left"> Video </label>
                                            <div class="col-md-6">
                                                <input  type='file' name='architecture_video' id='architecture_video'  />
                                                <div >
                                                    {!! SiteHelpers::showUploadedFile($row['architecture_video'],'/uploads/properties_subtab_imgs/') !!}

                                                </div>					

                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div>

                                        <div class="architecture_videotypelink" style="display:none;" >
                                            <div class="form-group">
                                                <label for="Link Type" class=" control-label col-md-4 text-left"> Link Type </label>
                                                <div class="col-md-8"> 
                                                    <label class='radio radio-inline'>
                                                        <input type='radio' name='architecture_video_link_type' value ='youtube' @if($row['architecture_video_link_type'] == 'youtube') checked="checked" @endif > Youtube </label>
                                                    <label class='radio radio-inline'>
                                                        <input type='radio' name='architecture_video_link_type' value ='vimeo' @if($row['architecture_video_link_type'] == 'vimeo') checked="checked" @endif > Vimeo </label> 
                                                </div> 

                                            </div>

                                            <div class="form-group" >
                                                <label for="Video Link" class=" control-label col-md-4 text-left"> Video Link </label>
                                                <div class="col-md-8">
                                                    <input type='text' name='architecture_video_link' id='architecture_video_link' class="form-control" value="{{$row['architecture_video_link']}}" />
                                                </div> 


                                            </div>
                                        </div>


                                        <div class="form-group  " >
                                            <label for="Designer" class=" control-label col-md-4 text-left"> Designer </label>
                                            <div class="col-md-6">
                                                <select name='assigned_architecture_designer[]' rows='5' id='assigned_architecture_designer' class='select2 ' multiple="multiple"  >
                                                    @if(!empty($designers))
                                                    @foreach($designers as $designer)
                                                    <option value="{{$designer->id}}" {{(isset($row['assigned_architecture_designer']) && in_array($designer->id,explode(',',$row['assigned_architecture_designer']))) ? " selected='selected' " : '' }}>{{$designer->designer_name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select> 
                                            </div> 
                                            <div class="col-md-2">
                                                <a href="{{URL::to('designers/update')}}" target="_blank">Add Designer</a>
                                            </div>
                                        </div> 
                                    </div>

                                    <div class="tab-pane m-t" id="architecture_design_design">
                                        <div class="form-group  " >
                                            <label for="Title" class=" control-label col-md-4 text-left"> Title </label>
                                            <div class="col-md-6">
                                                {!! Form::text('architecture_design_title', $row['architecture_design_title'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div> 

                                        <div class="form-group  " >
                                            <label for="Description" class=" control-label col-md-4 text-left"> Description </label>
                                            <div class="col-md-6">
                                                <textarea name="architecture_design_desciription" class="form-control">{{$row['architecture_design_desciription']}}</textarea> 
                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div> 

                                        <div class="form-group  " >
                                            <label for="Image" class=" control-label col-md-4 text-left"> Image </label>
                                            <div class="col-md-6">
                                                <input  type='file' name='architecture_design_image' id='architecture_design_image'  />
                                                <div >
                                                    {!! SiteHelpers::showUploadedFile($row['architecture_design_image'],'/uploads/properties_subtab_imgs/') !!}

                                                </div>					

                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="Video Type" class=" control-label col-md-4 text-left"> Video Type </label>
                                            <div class="col-md-6"> 
                                                <label class='radio radio-inline'>
                                                    <input type='radio' name='architecture_design_video_type' value ='upload' id='architecture_design_displayupload' @if($row['architecture_design_video_type'] == 'upload') checked="checked" @endif > Upload </label>
                                                <label class='radio radio-inline'>
                                                    <input type='radio' name='architecture_design_video_type' value ='link' id='architecture_design_displaylink' @if($row['architecture_design_video_type'] == 'link') checked="checked" @endif > Link </label> 
                                            </div> 

                                        </div>

                                        <div class="form-group architecture_design_videotypeupload" style="display:none;" >
                                            <label for="Video" class=" control-label col-md-4 text-left"> Video </label>
                                            <div class="col-md-6">
                                                <input  type='file' name='architecture_design_video' id='architecture_design_video'  />
                                                <div >
                                                    {!! 	SiteHelpers::showUploadedFile($row['architecture_design_video'],'/uploads/properties_subtab_imgs/') !!}

                                                </div>					

                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div>

                                        <div class="architecture_design_videotypelink" style="display:none;" >
                                            <div class="form-group">
                                                <label for="Link Type" class=" control-label col-md-4 text-left"> Link Type </label>
                                                <div class="col-md-8"> 
                                                    <label class='radio radio-inline'>
                                                        <input type='radio' name='architecture_design_video_link_type' value ='youtube' @if($row['architecture_design_video_link_type'] == 'youtube') checked="checked" @endif > Youtube </label>
                                                    <label class='radio radio-inline'>
                                                        <input type='radio' name='architecture_design_video_link_type' value ='vimeo' @if($row['architecture_design_video_link_type'] == 'vimeo') checked="checked" @endif > Vimeo </label> 
                                                </div> 

                                            </div>

                                            <div class="form-group" >
                                                <label for="Video Link" class=" control-label col-md-4 text-left"> Video Link </label>
                                                <div class="col-md-8">
                                                    <input type='text' name='architecture_design_video_link' id='architecture_design_video_link' class="form-control" value="{{$row['architecture_design_video_link']}}" />
                                                </div> 


                                            </div>
                                        </div>

                                        <div class="form-group  " >
                                            <label for="URL" class=" control-label col-md-4 text-left"> URL </label>
                                            <div class="col-md-6">
                                                {!! Form::text('architecture_design_url', $row['architecture_design_url'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div> 
                                    </div>

                                    <div class="tab-pane m-t" id="architecture_design_designer">
                                        <div class="form-group  " >
                                            <label for="Title" class=" control-label col-md-4 text-left"> Title </label>
                                            <div class="col-md-6">
                                                {!! Form::text('architecture_designer_title', $row['architecture_designer_title'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div> 

                                        <div class="form-group  " >
                                            <label for="Description" class=" control-label col-md-4 text-left"> Description </label>
                                            <div class="col-md-6">
                                                <textarea name="architecture_designer_desciription" class="form-control">{{$row['architecture_designer_desciription']}}</textarea> 
                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div> 

                                        <div class="form-group  " >
                                            <label for="Image" class=" control-label col-md-4 text-left"> Image </label>
                                            <div class="col-md-6">
                                                <input  type='file' name='architecture_designer_image' id='architecture_designer_image'  />
                                                <div >
                                                    {!! SiteHelpers::showUploadedFile($row['architecture_designer_image'],'/uploads/properties_subtab_imgs/') !!}

                                                </div>					

                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="Video Type" class=" control-label col-md-4 text-left"> Video Type </label>
                                            <div class="col-md-6"> 
                                                <label class='radio radio-inline'>
                                                    <input type='radio' name='architecture_designer_video_type' value ='upload' id='architecture_designer_displayupload' @if($row['architecture_designer_video_type'] == 'upload') checked="checked" @endif > Upload </label>
                                                <label class='radio radio-inline'>
                                                    <input type='radio' name='architecture_designer_video_type' value ='link' id='architecture_designer_displaylink' @if($row['architecture_designer_video_type'] == 'link') checked="checked" @endif > Link </label> 
                                            </div> 

                                        </div>

                                        <div class="form-group architecture_designer_videotypeupload" style="display:none;" >
                                            <label for="Video" class=" control-label col-md-4 text-left"> Video </label>
                                            <div class="col-md-6">
                                                <input  type='file' name='architecture_designer_video' id='architecture_designer_video'  />
                                                <div >
                                                    {!! SiteHelpers::showUploadedFile($row['architecture_designer_video'],'/uploads/properties_subtab_imgs/') !!}

                                                </div>					

                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div>

                                        <div class="architecture_designer_videotypelink" style="display:none;" >
                                            <div class="form-group">
                                                <label for="Link Type" class=" control-label col-md-4 text-left"> Link Type </label>
                                                <div class="col-md-8"> 
                                                    <label class='radio radio-inline'>
                                                        <input type='radio' name='architecture_designer_video_link_type' value ='youtube' @if($row['architecture_designer_video_link_type'] == 'youtube') checked="checked" @endif > Youtube </label>
                                                    <label class='radio radio-inline'>
                                                        <input type='radio' name='architecture_designer_video_link_type' value ='vimeo' @if($row['architecture_designer_video_link_type'] == 'vimeo') checked="checked" @endif > Vimeo </label> 
                                                </div> 

                                            </div>

                                            <div class="form-group" >
                                                <label for="Video Link" class=" control-label col-md-4 text-left"> Video Link </label>
                                                <div class="col-md-8">
                                                    <input type='text' name='architecture_designer_video_link' id='architecture_designer_video_link' class="form-control" value="{{$row['architecture_designer_video_link']}}" />
                                                </div> 


                                            </div>
                                        </div>

                                        <div class="form-group  " >
                                            <label for="Designer" class=" control-label col-md-4 text-left"> Designer </label>
                                            <div class="col-md-6">
                                                <select name='architecture_designer_designer[]' rows='5' id='architecture_designer_designer' class='select2 ' multiple="multiple"  >
                                                    @if(!empty($designers))
                                                    @foreach($designers as $designer)
                                                    <option value="{{$designer->id}}" {{(isset($row['architecture_designer_designer']) && in_array($designer->id,explode(',',$row['architecture_designer_designer']))) ? " selected='selected' " : '' }}>{{$designer->designer_name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select> 
                                            </div> 
                                            <div class="col-md-2">
                                                <a href="{{URL::to('designers/update')}}" target="_blank">Add Designer</a>
                                            </div>
                                        </div>

                                        <div class="form-group  " >
                                            <label for="URL" class=" control-label col-md-4 text-left"> URL </label>
                                            <div class="col-md-6">
                                                {!! Form::text('architecture_designer_url', $row['architecture_designer_url'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane m-t" id="spas">
                                <div class="form-group  " >
                                    <label for="Title" class=" control-label col-md-4 text-left"> Title </label>
                                    <div class="col-md-6">
                                        {!! Form::text('spa_title', $row['spa_title'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 

                                <div class="form-group  " >
                                    <label for="Description" class=" control-label col-md-4 text-left"> Description </label>
                                    <div class="col-md-6">
                                        <textarea name="spa_desciription" class="form-control">{{$row['spa_desciription']}}</textarea> 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 

                                <div class="form-group  " >
                                    <label for="Image One" class=" control-label col-md-4 text-left"> Image One </label>
                                    <div class="col-md-6">
                                        <input  type='file' name='spa_image1' id='spa_image1'  />
                                        <div >
                                            {!! SiteHelpers::showUploadedFile($row['spa_image1'],'/uploads/properties_subtab_imgs/') !!}

                                        </div>					

                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group  " >
                                    <label for="Image Two" class=" control-label col-md-4 text-left"> Image Two </label>
                                    <div class="col-md-6">
                                        <input  type='file' name='spa_image2' id='spa_image2'  />
                                        <div >
                                            {!! SiteHelpers::showUploadedFile($row['spa_image2'],'/uploads/properties_subtab_imgs/') !!}

                                        </div>					

                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group  " >
                                    <label for="Image Three" class=" control-label col-md-4 text-left"> Image Three </label>
                                    <div class="col-md-6">
                                        <input  type='file' name='spa_image3' id='spa_image3'  />
                                        <div >
                                            {!! SiteHelpers::showUploadedFile($row['spa_image3'],'/uploads/properties_subtab_imgs/') !!}

                                        </div>					

                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group  " >
                                    <label for="Image Four" class=" control-label col-md-4 text-left"> Image Four </label>
                                    <div class="col-md-6">
                                        <input  type='file' name='spa_image4' id='spa_image4'  />
                                        <div >
                                            {!! SiteHelpers::showUploadedFile($row['spa_image4'],'/uploads/properties_subtab_imgs/') !!}

                                        </div>					

                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Video Type" class=" control-label col-md-4 text-left"> Video Type </label>
                                    <div class="col-md-6"> 
                                        <label class='radio radio-inline'>
                                            <input type='radio' name='spa_video_type' value ='upload' id='spa_displayupload' @if($row['spa_video_type'] == 'upload') checked="checked" @endif > Upload </label>
                                        <label class='radio radio-inline'>
                                            <input type='radio' name='spa_video_type' value ='link' id='spa_displaylink' @if($row['spa_video_type'] == 'link') checked="checked" @endif > Link </label> 
                                    </div> 

                                </div>

                                <div class="form-group spa_videotypeupload" style="display:none;" >
                                    <label for="Video" class=" control-label col-md-4 text-left"> Video </label>
                                    <div class="col-md-6">
                                        <input  type='file' name='spa_video' id='spa_video'  />
                                        <div >
                                            {!! SiteHelpers::showUploadedFile($row['spa_video'],'/uploads/properties_subtab_imgs/') !!}

                                        </div>					

                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="spa_videotypelink" style="display:none;" >
                                    <div class="form-group">
                                        <label for="Link Type" class=" control-label col-md-4 text-left"> Link Type </label>
                                        <div class="col-md-8"> 
                                            <label class='radio radio-inline'>
                                                <input type='radio' name='spa_video_link_type' value ='youtube' @if($row['spa_video_link_type'] == 'youtube') checked="checked" @endif > Youtube </label>
                                            <label class='radio radio-inline'>
                                                <input type='radio' name='spa_video_link_type' value ='vimeo' @if($row['spa_video_link_type'] == 'vimeo') checked="checked" @endif > Vimeo </label> 
                                        </div> 

                                    </div>

                                    <div class="form-group" >
                                        <label for="Video Link" class=" control-label col-md-4 text-left"> Video Link </label>
                                        <div class="col-md-8">
                                            <input type='text' name='spa_video_link' id='spa_video_link' class="form-control" value="{{$row['spa_video_link']}}" />
                                        </div> 


                                    </div>
                                </div>

                                <div class="form-group  " >
                                    <label for="Designer" class=" control-label col-md-4 text-left"> Designer </label>
                                    <div class="col-md-6">
                                        <select name='spa_designer[]' rows='5' id='spa_designer' class='select2 ' multiple="multiple"  >
                                            @if(!empty($designers))
                                            @foreach($designers as $designer)
                                            <option value="{{$designer->id}}" {{(isset($row['spa_designer']) && in_array($designer->id,explode(',',$row['spa_designer']))) ? " selected='selected' " : '' }}>{{$designer->designer_name}}</option>
                                            @endforeach
                                            @endif
                                        </select> 
                                    </div> 
                                    <div class="col-md-2">
                                        <a href="{{URL::to('designers/update')}}" target="_blank">Add Designer</a>
                                    </div>
                                </div>

                                <div class="form-group  " >
                                    <label for="URL" class=" control-label col-md-4 text-left"> URL </label>
                                    <div class="col-md-6">
                                        {!! Form::text('spa_url', $row['spa_url'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group  " >
                                    <label for="spa_usp_text" class=" control-label col-md-4 text-left"> Spa USP text </label>
                                    <div class="col-md-6">
                                        {!! Form::text('spa_usp_text', $row['spa_usp_text'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group  " >
                                    <label for="spa_usp_person" class=" control-label col-md-4 text-left"> Spa USP Person </label>
                                    <div class="col-md-6">
                                        {!! Form::text('spa_usp_person', $row['spa_usp_person'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group  " >
                                    <label for="spa_manager_text" class=" control-label col-md-4 text-left"> Spa manager's text </label>
                                    <div class="col-md-6">
                                        {!! Form::text('spa_manager_text', $row['spa_manager_text'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group  " >
                                    <label for="Opening Hours" class=" control-label col-md-4 text-left"> Opening Hours </label>
                                    <div class="col-md-6">
                                        <textarea name="spa_opening_hours" class="form-control">{{$row['spa_opening_hours']}}</textarea> 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 

                                <div class="form-group  " >
                                    <label for="spa_phone_number" class=" control-label col-md-4 text-left"> Spa phone number </label>
                                    <div class="col-md-6">
                                        {!! Form::text('spa_phone_number', $row['spa_phone_number'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane m-t" id="restaurant">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#restaurant1" data-toggle="tab">Restaurant 1</a></li>
                                    <li class=""><a href="#restaurant2" data-toggle="tab">Restaurant 2</a></li>
									<li class=""><a href="#restaurant3" data-toggle="tab">Restaurant 3</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane m-t active" id="restaurant1">
                                        <div class="form-group  " >
                                            <label for="Title" class=" control-label col-md-4 text-left"> Title </label>
                                            <div class="col-md-6">
                                                {!! Form::text('restaurant_title', $row['restaurant_title'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div> 

                                        <div class="form-group  " >
                                            <label for="Description" class=" control-label col-md-4 text-left"> Description </label>
                                            <div class="col-md-6">
                                                <textarea name="restaurant_desciription" class="form-control"> {{$row['restaurant_desciription']}}</textarea> 
                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div> 

                                        <div class="form-group  " >
                                            <label for="Image" class=" control-label col-md-4 text-left"> Image </label>
                                            <div class="col-md-6">
                                                <input  type='file' name='restaurant_image' id='restaurant_image'  />
                                                <div >
                                                    {!! SiteHelpers::showUploadedFile($row['restaurant_image'],'/uploads/properties_subtab_imgs/') !!}

                                                </div>					

                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div>

                                        <div class="form-group  " >
                                            <label for="Image 2" class=" control-label col-md-4 text-left"> Image 2 </label>
                                            <div class="col-md-6">
                                                <input  type='file' name='restaurant_image2' id='restaurant_image2'  />
                                                <div >
                                                    {!! SiteHelpers::showUploadedFile($row['restaurant_image2'],'/uploads/properties_subtab_imgs/') !!}

                                                </div>					

                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="Video Type" class=" control-label col-md-4 text-left"> Video Type </label>
                                            <div class="col-md-6"> 
                                                <label class='radio radio-inline'>
                                                    <input type='radio' name='restaurant_video_type' value ='upload' id='restaurant_displayupload' @if($row['restaurant_video_type'] == 'upload') checked="checked" @endif > Upload </label>
                                                <label class='radio radio-inline'>
                                                    <input type='radio' name='restaurant_video_type' value ='link' id='restaurant_displaylink' @if($row['restaurant_video_type'] == 'link') checked="checked" @endif > Link </label> 
                                            </div> 

                                        </div>

                                        <div class="form-group restaurant_videotypeupload" style="display:none;" >
                                            <label for="Video" class=" control-label col-md-4 text-left"> Video </label>
                                            <div class="col-md-6">
                                                <input  type='file' name='restaurant_video' id='restaurant_video'  />
                                                <div >
                                                    {!! SiteHelpers::showUploadedFile($row['restaurant_video'],'/uploads/properties_subtab_imgs/') !!}

                                                </div>					

                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div>

                                        <div class="restaurant_videotypelink" style="display:none;" >
                                            <div class="form-group">
                                                <label for="Link Type" class=" control-label col-md-4 text-left"> Link Type </label>
                                                <div class="col-md-8"> 
                                                    <label class='radio radio-inline'>
                                                        <input type='radio' name='restaurant_video_link_type' value ='youtube' @if($row['restaurant_video_link_type'] == 'youtube') checked="checked" @endif > Youtube </label>
                                                    <label class='radio radio-inline'>
                                                        <input type='radio' name='restaurant_video_link_type' value ='vimeo' @if($row['restaurant_video_link_type'] == 'vimeo') checked="checked" @endif > Vimeo </label> 
                                                </div> 

                                            </div>

                                            <div class="form-group" >
                                                <label for="Video Link" class=" control-label col-md-4 text-left"> Video Link </label>
                                                <div class="col-md-8">
                                                    <input type='text' name='restaurant_video_link' id='restaurant_video_link' class="form-control" value="{{$row['restaurant_video_link']}}" />
                                                </div> 


                                            </div>
                                        </div>

                                        <div class="form-group  " >
                                            <label for="Designer" class=" control-label col-md-4 text-left"> Designer </label>
                                            <div class="col-md-6">
                                                <select name='restaurant_designer[]' rows='5' id='restaurant_designer' class='select2 ' multiple="multiple"  >
                                                    @if(!empty($designers))
                                                    @foreach($designers as $designer)
                                                    <option value="{{$designer->id}}" {{(isset($row['restaurant_designer']) && in_array($designer->id,explode(',',$row['restaurant_designer']))) ? " selected='selected' " : '' }}>{{$designer->designer_name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select> 
                                            </div> 
                                            <div class="col-md-2">
                                                <a href="{{URL::to('designers/update')}}" target="_blank">Add Designer</a>
                                            </div>
                                        </div>

                                        <div class="form-group  " >
                                            <label for="URL" class=" control-label col-md-4 text-left"> URL </label>
                                            <div class="col-md-6">
                                                {!! Form::text('restaurant_url', $row['restaurant_url'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div> 

                                        <div class="form-group  " >
                                            <label for="restaurant_usp_text" class=" control-label col-md-4 text-left"> Restaurant USP text </label>
                                            <div class="col-md-6">
                                                {!! Form::text('restaurant_usp_text', $row['restaurant_usp_text'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div>

                                        <div class="form-group  " >
                                            <label for="restaurant_usp_person" class=" control-label col-md-4 text-left"> Restaurant USP Person </label>
                                            <div class="col-md-6">
                                                {!! Form::text('restaurant_usp_person', $row['restaurant_usp_person'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane m-t" id="restaurant2">
                                        <div class="form-group  " >
                                            <label for="Title" class=" control-label col-md-4 text-left"> Title </label>
                                            <div class="col-md-6">
                                                {!! Form::text('restaurant2_title', $row['restaurant2_title'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div> 

                                        <div class="form-group  " >
                                            <label for="Description" class=" control-label col-md-4 text-left"> Description </label>
                                            <div class="col-md-6">
                                                <textarea name="restaurant2_desciription" class="form-control"> {{$row['restaurant2_desciription']}}</textarea> 
                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div> 

                                        <div class="form-group  " >
                                            <label for="Image" class=" control-label col-md-4 text-left"> Image </label>
                                            <div class="col-md-6">
                                                <input  type='file' name='restaurant2_image' id='restaurant2_image'  />
                                                <div >
                                                    {!! SiteHelpers::showUploadedFile($row['restaurant2_image'],'/uploads/properties_subtab_imgs/') !!}

                                                </div>					

                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div>

                                        <div class="form-group  " >
                                            <label for="Image 2" class=" control-label col-md-4 text-left"> Image 2 </label>
                                            <div class="col-md-6">
                                                <input  type='file' name='restaurant2_image2' id='restaurant2_image2'  />
                                                <div >
                                                    {!! SiteHelpers::showUploadedFile($row['restaurant2_image2'],'/uploads/properties_subtab_imgs/') !!}

                                                </div>					

                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="Video Type" class=" control-label col-md-4 text-left"> Video Type </label>
                                            <div class="col-md-6"> 
                                                <label class='radio radio-inline'>
                                                    <input type='radio' name='restaurant2_video_type' value ='upload' id='restaurant2_displayupload' @if($row['restaurant2_video_type'] == 'upload') checked="checked" @endif > Upload </label>
                                                <label class='radio radio-inline'>
                                                    <input type='radio' name='restaurant2_video_type' value ='link' id='restaurant2_displaylink' @if($row['restaurant2_video_type'] == 'link') checked="checked" @endif > Link </label> 
                                            </div> 

                                        </div>

                                        <div class="form-group restaurant2_videotypeupload" style="display:none;" >
                                            <label for="Video" class=" control-label col-md-4 text-left"> Video </label>
                                            <div class="col-md-6">
                                                <input  type='file' name='restaurant2_video' id='restaurant2_video'  />
                                                <div >
                                                    {!! SiteHelpers::showUploadedFile($row['restaurant2_video'],'/uploads/properties_subtab_imgs/') !!}

                                                </div>					

                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div>

                                        <div class="restaurant2_videotypelink" style="display:none;" >
                                            <div class="form-group">
                                                <label for="Link Type" class=" control-label col-md-4 text-left"> Link Type </label>
                                                <div class="col-md-8"> 
                                                    <label class='radio radio-inline'>
                                                        <input type='radio' name='restaurant2_video_link_type' value ='youtube' @if($row['restaurant2_video_link_type'] == 'youtube') checked="checked" @endif > Youtube </label>
                                                    <label class='radio radio-inline'>
                                                        <input type='radio' name='restaurant2_video_link_type' value ='vimeo' @if($row['restaurant2_video_link_type'] == 'vimeo') checked="checked" @endif > Vimeo </label> 
                                                </div> 

                                            </div>

                                            <div class="form-group" >
                                                <label for="Video Link" class=" control-label col-md-4 text-left"> Video Link </label>
                                                <div class="col-md-8">
                                                    <input type='text' name='restaurant2_video_link' id='restaurant2_video_link' class="form-control" value="{{$row['restaurant2_video_link']}}" />
                                                </div> 


                                            </div>
                                        </div>

                                        <div class="form-group  " >
                                            <label for="Designer" class=" control-label col-md-4 text-left"> Designer </label>
                                            <div class="col-md-6">
                                                <select name='restaurant2_designer[]' rows='5' id='restaurant2_designer' class='select2 ' multiple="multiple"  >
                                                    @if(!empty($designers))
                                                    @foreach($designers as $designer)
                                                    <option value="{{$designer->id}}" {{(isset($row['restaurant2_designer']) && in_array($designer->id,explode(',',$row['restaurant2_designer']))) ? " selected='selected' " : '' }}>{{$designer->designer_name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select> 
                                            </div> 
                                            <div class="col-md-2">
                                                <a href="{{URL::to('designers/update')}}" target="_blank">Add Designer</a>
                                            </div>
                                        </div>

                                        <div class="form-group  " >
                                            <label for="URL" class=" control-label col-md-4 text-left"> URL </label>
                                            <div class="col-md-6">
                                                {!! Form::text('restaurant2_url', $row['restaurant2_url'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div> 

                                        <div class="form-group  " >
                                            <label for="restaurant_usp_text" class=" control-label col-md-4 text-left"> Restaurant USP text </label>
                                            <div class="col-md-6">
                                                {!! Form::text('restaurant2_usp_text', $row['restaurant2_usp_text'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div>

                                        <div class="form-group  " >
                                            <label for="restaurant_usp_person" class=" control-label col-md-4 text-left"> Restaurant USP Person </label>
                                            <div class="col-md-6">
                                                {!! Form::text('restaurant2_usp_person', $row['restaurant2_usp_person'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div>
                                    </div>
									
									<div class="tab-pane m-t" id="restaurant3">
                                        <div class="form-group  " >
                                            <label for="Title" class=" control-label col-md-4 text-left"> Title </label>
                                            <div class="col-md-6">
                                                {!! Form::text('restaurant3_title', $row['restaurant3_title'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div> 

                                        <div class="form-group  " >
                                            <label for="Description" class=" control-label col-md-4 text-left"> Description </label>
                                            <div class="col-md-6">
                                                <textarea name="restaurant3_desciription" class="form-control"> {{$row['restaurant3_desciription']}}</textarea> 
                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div> 

                                        <div class="form-group  " >
                                            <label for="Image" class=" control-label col-md-4 text-left"> Image </label>
                                            <div class="col-md-6">
                                                <input  type='file' name='restaurant3_image' id='restaurant3_image'  />
                                                <div >
                                                    {!! SiteHelpers::showUploadedFile($row['restaurant3_image'],'/uploads/properties_subtab_imgs/') !!}

                                                </div>					

                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div>

                                        <div class="form-group  " >
                                            <label for="Image 2" class=" control-label col-md-4 text-left"> Image 2 </label>
                                            <div class="col-md-6">
                                                <input  type='file' name='restaurant3_image2' id='restaurant3_image2'  />
                                                <div >
                                                    {!! SiteHelpers::showUploadedFile($row['restaurant3_image2'],'/uploads/properties_subtab_imgs/') !!}

                                                </div>					

                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="Video Type" class=" control-label col-md-4 text-left"> Video Type </label>
                                            <div class="col-md-6"> 
                                                <label class='radio radio-inline'>
                                                    <input type='radio' name='restaurant3_video_type' value ='upload' id='restaurant3_displayupload' @if($row['restaurant3_video_type'] == 'upload') checked="checked" @endif > Upload </label>
                                                <label class='radio radio-inline'>
                                                    <input type='radio' name='restaurant3_video_type' value ='link' id='restaurant3_displaylink' @if($row['restaurant3_video_type'] == 'link') checked="checked" @endif > Link </label> 
                                            </div> 

                                        </div>

                                        <div class="form-group restaurant3_videotypeupload" style="display:none;" >
                                            <label for="Video" class=" control-label col-md-4 text-left"> Video </label>
                                            <div class="col-md-6">
                                                <input  type='file' name='restaurant3_video' id='restaurant3_video'  />
                                                <div >
                                                    {!! SiteHelpers::showUploadedFile($row['restaurant3_video'],'/uploads/properties_subtab_imgs/') !!}

                                                </div>					

                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div>

                                        <div class="restaurant3_videotypelink" style="display:none;" >
                                            <div class="form-group">
                                                <label for="Link Type" class=" control-label col-md-4 text-left"> Link Type </label>
                                                <div class="col-md-8"> 
                                                    <label class='radio radio-inline'>
                                                        <input type='radio' name='restaurant3_video_link_type' value ='youtube' @if($row['restaurant3_video_link_type'] == 'youtube') checked="checked" @endif > Youtube </label>
                                                    <label class='radio radio-inline'>
                                                        <input type='radio' name='restaurant3_video_link_type' value ='vimeo' @if($row['restaurant3_video_link_type'] == 'vimeo') checked="checked" @endif > Vimeo </label> 
                                                </div> 

                                            </div>

                                            <div class="form-group" >
                                                <label for="Video Link" class=" control-label col-md-4 text-left"> Video Link </label>
                                                <div class="col-md-8">
                                                    <input type='text' name='restaurant3_video_link' id='restaurant3_video_link' class="form-control" value="{{$row['restaurant3_video_link']}}" />
                                                </div> 


                                            </div>
                                        </div>

                                        <div class="form-group  " >
                                            <label for="Designer" class=" control-label col-md-4 text-left"> Designer </label>
                                            <div class="col-md-6">
                                                <select name='restaurant3_designer[]' rows='5' id='restaurant3_designer' class='select2 ' multiple="multiple"  >
                                                    @if(!empty($designers))
                                                    @foreach($designers as $designer)
                                                    <option value="{{$designer->id}}" {{(isset($row['restaurant3_designer']) && in_array($designer->id,explode(',',$row['restaurant3_designer']))) ? " selected='selected' " : '' }}>{{$designer->designer_name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select> 
                                            </div> 
                                            <div class="col-md-2">
                                                <a href="{{URL::to('designers/update')}}" target="_blank">Add Designer</a>
                                            </div>
                                        </div>

                                        <div class="form-group  " >
                                            <label for="URL" class=" control-label col-md-4 text-left"> URL </label>
                                            <div class="col-md-6">
                                                {!! Form::text('restaurant3_url', $row['restaurant3_url'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div> 

                                        <div class="form-group  " >
                                            <label for="restaurant_usp_text" class=" control-label col-md-4 text-left"> Restaurant USP text </label>
                                            <div class="col-md-6">
                                                {!! Form::text('restaurant3_usp_text', $row['restaurant3_usp_text'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div>

                                        <div class="form-group  " >
                                            <label for="restaurant_usp_person" class=" control-label col-md-4 text-left"> Restaurant USP Person </label>
                                            <div class="col-md-6">
                                                {!! Form::text('restaurant3_usp_person', $row['restaurant3_usp_person'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                            </div> 
                                            <div class="col-md-2">

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane m-t" id="bar">
								<ul class="nav nav-tabs">
                                    <li class="active"><a href="#bar1" data-toggle="tab">Bar 1</a></li>
                                    <li class=""><a href="#bar2" data-toggle="tab">Bar 2</a></li>
									<li class=""><a href="#bar3" data-toggle="tab">Bar 3</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane m-t active" id="bar1">
										<div class="form-group  " >
											<label for="Title" class=" control-label col-md-4 text-left"> Title </label>
											<div class="col-md-6">
												{!! Form::text('bar_title', $row['bar_title'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
											</div> 
											<div class="col-md-2">

											</div>
										</div> 

										<div class="form-group  " >
											<label for="Sub Title" class=" control-label col-md-4 text-left"> Sub Title </label>
											<div class="col-md-6">
												{!! Form::text('bar_sub_title', $row['bar_sub_title'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
											</div> 
											<div class="col-md-2">

											</div>
										</div>

										<div class="form-group  " >
											<label for="Description" class=" control-label col-md-4 text-left"> Description </label>
											<div class="col-md-6">
												<textarea name="bar_desciription" class="form-control"> {{$row['bar_desciription']}}</textarea> 
											</div> 
											<div class="col-md-2">

											</div>
										</div> 

										<div class="form-group  " >
											<label for="Image One" class=" control-label col-md-4 text-left"> Image One</label>
											<div class="col-md-6">
												<input  type='file' name='bar_image' id='bar_image'  />
												<div >
													{!! SiteHelpers::showUploadedFile($row['bar_image'],'/uploads/properties_subtab_imgs/') !!}

												</div>					

											</div> 
											<div class="col-md-2">

											</div>
										</div>

										<div class="form-group  " >
											<label for="Image Two" class=" control-label col-md-4 text-left"> Image Two </label>
											<div class="col-md-6">
												<input  type='file' name='bar_image2' id='bar_image2'  />
												<div >
													{!! SiteHelpers::showUploadedFile($row['bar_image2'],'/uploads/properties_subtab_imgs/') !!}

												</div>					

											</div> 
											<div class="col-md-2">

											</div>
										</div>

										<div class="form-group  " >
											<label for="Image Three" class=" control-label col-md-4 text-left"> Image Three </label>
											<div class="col-md-6">
												<input  type='file' name='bar_image3' id='bar_image3'  />
												<div >
													{!! SiteHelpers::showUploadedFile($row['bar_image3'],'/uploads/properties_subtab_imgs/') !!}

												</div>					

											</div> 
											<div class="col-md-2">

											</div>
										</div>

										<div class="form-group">
											<label for="Video Type" class=" control-label col-md-4 text-left"> Video Type </label>
											<div class="col-md-6"> 
												<label class='radio radio-inline'>
													<input type='radio' name='bar_video_type' value ='upload' id='bar_displayupload' @if($row['bar_video_type'] == 'upload') checked="checked" @endif > Upload </label>
												<label class='radio radio-inline'>
													<input type='radio' name='bar_video_type' value ='link' id='bar_displaylink' @if($row['bar_video_type'] == 'link') checked="checked" @endif > Link </label> 
											</div> 

										</div>

										<div class="form-group bar_videotypeupload" style="display:none;" >
											<label for="Video" class=" control-label col-md-4 text-left"> Video </label>
											<div class="col-md-6">
												<input  type='file' name='bar_video' id='bar_video'  />
												<div >
													{!! SiteHelpers::showUploadedFile($row['bar_video'],'/uploads/properties_subtab_imgs/') !!}

												</div>					

											</div> 
											<div class="col-md-2">

											</div>
										</div>

										<div class="bar_videotypelink" style="display:none;" >
											<div class="form-group">
												<label for="Link Type" class=" control-label col-md-4 text-left"> Link Type </label>
												<div class="col-md-8"> 
													<label class='radio radio-inline'>
														<input type='radio' name='bar_video_link_type' value ='youtube' @if($row['bar_video_link_type'] == 'youtube') checked="checked" @endif > Youtube </label>
													<label class='radio radio-inline'>
														<input type='radio' name='bar_video_link_type' value ='vimeo' @if($row['bar_video_link_type'] == 'vimeo') checked="checked" @endif > Vimeo </label> 
												</div> 

											</div>

											<div class="form-group" >
												<label for="Video Link" class=" control-label col-md-4 text-left"> Video Link </label>
												<div class="col-md-8">
													<input type='text' name='bar_video_link' id='bar_video_link' class="form-control" value="{{$row['bar_video_link']}}" />
												</div> 


											</div>
										</div>

										<div class="form-group  " >
											<label for="Designer" class=" control-label col-md-4 text-left"> Designer </label>
											<div class="col-md-6">
												<select name='bar_designer[]' rows='5' id='bar_designer' class='select2 ' multiple="multiple"  >
													@if(!empty($designers))
													@foreach($designers as $designer)
													<option value="{{$designer->id}}" {{(isset($row['bar_designer']) && in_array($designer->id,explode(',',$row['bar_designer']))) ? " selected='selected' " : '' }}>{{$designer->designer_name}}</option>
													@endforeach
													@endif
												</select> 
											</div> 
											<div class="col-md-2">
												<a href="{{URL::to('designers/update')}}" target="_blank">Add Designer</a>
											</div>
										</div>

										<div class="form-group  " >
											<label for="URL" class=" control-label col-md-4 text-left"> URL </label>
											<div class="col-md-6">
												{!! Form::text('bar_url', $row['bar_url'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
											</div> 
											<div class="col-md-2">

											</div>
										</div> 

										<div class="form-group  " >
											<label for="bar_usp_text" class=" control-label col-md-4 text-left"> Bar USP text </label>
											<div class="col-md-6">
												{!! Form::text('bar_usp_text', $row['bar_usp_text'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
											</div> 
											<div class="col-md-2">

											</div>
										</div>

										<div class="form-group  " >
											<label for="bar_usp_person" class=" control-label col-md-4 text-left"> Bar USP Person </label>
											<div class="col-md-6">
												{!! Form::text('bar_usp_person', $row['bar_usp_person'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
											</div> 
											<div class="col-md-2">

											</div>
										</div>
									</div>
									
									<div class="tab-pane m-t" id="bar2">
										<div class="form-group  " >
											<label for="Title" class=" control-label col-md-4 text-left"> Title </label>
											<div class="col-md-6">
												{!! Form::text('bar2_title', $row['bar2_title'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
											</div> 
											<div class="col-md-2">

											</div>
										</div> 

										<div class="form-group  " >
											<label for="Sub Title" class=" control-label col-md-4 text-left"> Sub Title </label>
											<div class="col-md-6">
												{!! Form::text('bar2_sub_title', $row['bar2_sub_title'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
											</div> 
											<div class="col-md-2">

											</div>
										</div>

										<div class="form-group  " >
											<label for="Description" class=" control-label col-md-4 text-left"> Description </label>
											<div class="col-md-6">
												<textarea name="bar2_desciription" class="form-control"> {{$row['bar2_desciription']}}</textarea> 
											</div> 
											<div class="col-md-2">

											</div>
										</div> 

										<div class="form-group  " >
											<label for="Image One" class=" control-label col-md-4 text-left"> Image One</label>
											<div class="col-md-6">
												<input  type='file' name='bar2_image' id='bar2_image'  />
												<div >
													{!! SiteHelpers::showUploadedFile($row['bar2_image'],'/uploads/properties_subtab_imgs/') !!}

												</div>					

											</div> 
											<div class="col-md-2">

											</div>
										</div>

										<div class="form-group  " >
											<label for="Image Two" class=" control-label col-md-4 text-left"> Image Two </label>
											<div class="col-md-6">
												<input  type='file' name='bar2_image2' id='bar2_image2'  />
												<div >
													{!! SiteHelpers::showUploadedFile($row['bar2_image2'],'/uploads/properties_subtab_imgs/') !!}

												</div>					

											</div> 
											<div class="col-md-2">

											</div>
										</div>

										<div class="form-group  " >
											<label for="Image Three" class=" control-label col-md-4 text-left"> Image Three </label>
											<div class="col-md-6">
												<input  type='file' name='bar2_image3' id='bar2_image3'  />
												<div >
													{!! SiteHelpers::showUploadedFile($row['bar2_image3'],'/uploads/properties_subtab_imgs/') !!}

												</div>					

											</div> 
											<div class="col-md-2">

											</div>
										</div>

										<div class="form-group">
											<label for="Video Type" class=" control-label col-md-4 text-left"> Video Type </label>
											<div class="col-md-6"> 
												<label class='radio radio-inline'>
													<input type='radio' name='bar2_video_type' value ='upload' id='bar2_displayupload' @if($row['bar2_video_type'] == 'upload') checked="checked" @endif > Upload </label>
												<label class='radio radio-inline'>
													<input type='radio' name='bar2_video_type' value ='link' id='bar2_displaylink' @if($row['bar2_video_type'] == 'link') checked="checked" @endif > Link </label> 
											</div> 

										</div>

										<div class="form-group bar2_videotypeupload" style="display:none;" >
											<label for="Video" class=" control-label col-md-4 text-left"> Video </label>
											<div class="col-md-6">
												<input  type='file' name='bar2_video' id='bar2_video'  />
												<div >
													{!! SiteHelpers::showUploadedFile($row['bar2_video'],'/uploads/properties_subtab_imgs/') !!}

												</div>					

											</div> 
											<div class="col-md-2">

											</div>
										</div>

										<div class="bar2_videotypelink" style="display:none;" >
											<div class="form-group">
												<label for="Link Type" class=" control-label col-md-4 text-left"> Link Type </label>
												<div class="col-md-8"> 
													<label class='radio radio-inline'>
														<input type='radio' name='bar2_video_link_type' value ='youtube' @if($row['bar2_video_link_type'] == 'youtube') checked="checked" @endif > Youtube </label>
													<label class='radio radio-inline'>
														<input type='radio' name='bar2_video_link_type' value ='vimeo' @if($row['bar2_video_link_type'] == 'vimeo') checked="checked" @endif > Vimeo </label> 
												</div> 

											</div>

											<div class="form-group" >
												<label for="Video Link" class=" control-label col-md-4 text-left"> Video Link </label>
												<div class="col-md-8">
													<input type='text' name='bar2_video_link' id='bar2_video_link' class="form-control" value="{{$row['bar2_video_link']}}" />
												</div> 


											</div>
										</div>

										<div class="form-group  " >
											<label for="Designer" class=" control-label col-md-4 text-left"> Designer </label>
											<div class="col-md-6">
												<select name='bar2_designer[]' rows='5' id='bar2_designer' class='select2 ' multiple="multiple"  >
													@if(!empty($designers))
													@foreach($designers as $designer)
													<option value="{{$designer->id}}" {{(isset($row['bar2_designer']) && in_array($designer->id,explode(',',$row['bar2_designer']))) ? " selected='selected' " : '' }}>{{$designer->designer_name}}</option>
													@endforeach
													@endif
												</select> 
											</div> 
											<div class="col-md-2">
												<a href="{{URL::to('designers/update')}}" target="_blank">Add Designer</a>
											</div>
										</div>

										<div class="form-group  " >
											<label for="URL" class=" control-label col-md-4 text-left"> URL </label>
											<div class="col-md-6">
												{!! Form::text('bar2_url', $row['bar2_url'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
											</div> 
											<div class="col-md-2">

											</div>
										</div> 

										<div class="form-group  " >
											<label for="bar2_usp_text" class=" control-label col-md-4 text-left"> Bar USP text </label>
											<div class="col-md-6">
												{!! Form::text('bar2_usp_text', $row['bar2_usp_text'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
											</div> 
											<div class="col-md-2">

											</div>
										</div>

										<div class="form-group  " >
											<label for="bar_usp_person" class=" control-label col-md-4 text-left"> Bar USP Person </label>
											<div class="col-md-6">
												{!! Form::text('bar2_usp_person', $row['bar2_usp_person'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
											</div> 
											<div class="col-md-2">

											</div>
										</div>
									</div>
									
									<div class="tab-pane m-t" id="bar3">
										<div class="form-group  " >
											<label for="Title" class=" control-label col-md-4 text-left"> Title </label>
											<div class="col-md-6">
												{!! Form::text('bar3_title', $row['bar3_title'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
											</div> 
											<div class="col-md-2">

											</div>
										</div> 

										<div class="form-group  " >
											<label for="Sub Title" class=" control-label col-md-4 text-left"> Sub Title </label>
											<div class="col-md-6">
												{!! Form::text('bar3_sub_title', $row['bar3_sub_title'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
											</div> 
											<div class="col-md-2">

											</div>
										</div>

										<div class="form-group  " >
											<label for="Description" class=" control-label col-md-4 text-left"> Description </label>
											<div class="col-md-6">
												<textarea name="bar3_desciription" class="form-control"> {{$row['bar3_desciription']}}</textarea> 
											</div> 
											<div class="col-md-2">

											</div>
										</div> 

										<div class="form-group  " >
											<label for="Image One" class=" control-label col-md-4 text-left"> Image One</label>
											<div class="col-md-6">
												<input  type='file' name='bar3_image' id='bar3_image'  />
												<div >
													{!! SiteHelpers::showUploadedFile($row['bar3_image'],'/uploads/properties_subtab_imgs/') !!}

												</div>					

											</div> 
											<div class="col-md-2">

											</div>
										</div>

										<div class="form-group  " >
											<label for="Image Two" class=" control-label col-md-4 text-left"> Image Two </label>
											<div class="col-md-6">
												<input  type='file' name='bar3_image2' id='bar3_image2'  />
												<div >
													{!! SiteHelpers::showUploadedFile($row['bar3_image2'],'/uploads/properties_subtab_imgs/') !!}

												</div>					

											</div> 
											<div class="col-md-2">

											</div>
										</div>

										<div class="form-group  " >
											<label for="Image Three" class=" control-label col-md-4 text-left"> Image Three </label>
											<div class="col-md-6">
												<input  type='file' name='bar3_image3' id='bar3_image3'  />
												<div >
													{!! SiteHelpers::showUploadedFile($row['bar3_image3'],'/uploads/properties_subtab_imgs/') !!}

												</div>					

											</div> 
											<div class="col-md-2">

											</div>
										</div>

										<div class="form-group">
											<label for="Video Type" class=" control-label col-md-4 text-left"> Video Type </label>
											<div class="col-md-6"> 
												<label class='radio radio-inline'>
													<input type='radio' name='bar3_video_type' value ='upload' id='bar3_displayupload' @if($row['bar3_video_type'] == 'upload') checked="checked" @endif > Upload </label>
												<label class='radio radio-inline'>
													<input type='radio' name='bar3_video_type' value ='link' id='bar3_displaylink' @if($row['bar3_video_type'] == 'link') checked="checked" @endif > Link </label> 
											</div> 

										</div>

										<div class="form-group bar3_videotypeupload" style="display:none;" >
											<label for="Video" class=" control-label col-md-4 text-left"> Video </label>
											<div class="col-md-6">
												<input  type='file' name='bar3_video' id='bar3_video'  />
												<div >
													{!! SiteHelpers::showUploadedFile($row['bar3_video'],'/uploads/properties_subtab_imgs/') !!}

												</div>					

											</div> 
											<div class="col-md-2">

											</div>
										</div>

										<div class="bar3_videotypelink" style="display:none;" >
											<div class="form-group">
												<label for="Link Type" class=" control-label col-md-4 text-left"> Link Type </label>
												<div class="col-md-8"> 
													<label class='radio radio-inline'>
														<input type='radio' name='bar3_video_link_type' value ='youtube' @if($row['bar3_video_link_type'] == 'youtube') checked="checked" @endif > Youtube </label>
													<label class='radio radio-inline'>
														<input type='radio' name='bar3_video_link_type' value ='vimeo' @if($row['bar3_video_link_type'] == 'vimeo') checked="checked" @endif > Vimeo </label> 
												</div> 

											</div>

											<div class="form-group" >
												<label for="Video Link" class=" control-label col-md-4 text-left"> Video Link </label>
												<div class="col-md-8">
													<input type='text' name='bar3_video_link' id='bar3_video_link' class="form-control" value="{{$row['bar3_video_link']}}" />
												</div> 


											</div>
										</div>

										<div class="form-group  " >
											<label for="Designer" class=" control-label col-md-4 text-left"> Designer </label>
											<div class="col-md-6">
												<select name='bar3_designer[]' rows='5' id='bar3_designer' class='select2 ' multiple="multiple"  >
													@if(!empty($designers))
													@foreach($designers as $designer)
													<option value="{{$designer->id}}" {{(isset($row['bar3_designer']) && in_array($designer->id,explode(',',$row['bar3_designer']))) ? " selected='selected' " : '' }}>{{$designer->designer_name}}</option>
													@endforeach
													@endif
												</select> 
											</div> 
											<div class="col-md-2">
												<a href="{{URL::to('designers/update')}}" target="_blank">Add Designer</a>
											</div>
										</div>

										<div class="form-group  " >
											<label for="URL" class=" control-label col-md-4 text-left"> URL </label>
											<div class="col-md-6">
												{!! Form::text('bar3_url', $row['bar3_url'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
											</div> 
											<div class="col-md-2">

											</div>
										</div> 

										<div class="form-group  " >
											<label for="bar3_usp_text" class=" control-label col-md-4 text-left"> Bar USP text </label>
											<div class="col-md-6">
												{!! Form::text('bar3_usp_text', $row['bar3_usp_text'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
											</div> 
											<div class="col-md-2">

											</div>
										</div>

										<div class="form-group  " >
											<label for="bar3_usp_person" class=" control-label col-md-4 text-left"> Bar USP Person </label>
											<div class="col-md-6">
												{!! Form::text('bar3_usp_person', $row['bar3_usp_person'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
											</div> 
											<div class="col-md-2">

											</div>
										</div>
									</div>
								</div>
                            </div>

                            <div class="tab-pane m-t" id="video">
                                <div class="form-group  " >
                                    <label for="Title" class=" control-label col-md-4 text-left"> Title </label>
                                    <div class="col-md-6">
                                        {!! Form::text('video_title', $row['video_title'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group  " >
                                    <label for="Sub Title" class=" control-label col-md-4 text-left"> Sub Title </label>
                                    <div class="col-md-6">
                                        {!! Form::text('video_sub_title', $row['video_sub_title'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 									  

                                <div class="form-group  " >
                                    <label for="Description" class=" control-label col-md-4 text-left"> Description </label>
                                    <div class="col-md-6">
                                        <textarea name="video_desciription" class="form-control"> {{$row['video_desciription']}}</textarea> 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 

                                <div class="form-group  " >
                                    <label for="Image" class=" control-label col-md-4 text-left"> Video Cover Image </label>
                                    <div class="col-md-6">
                                        <input  type='file' name='video_image' id='video_image'  />
                                        <div >
                                            {!! SiteHelpers::showUploadedFile($row['video_image'],'/uploads/properties_subtab_imgs/') !!}

                                        </div>					

                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Video Type" class=" control-label col-md-4 text-left"> Video Type </label>
                                    <div class="col-md-6"> 
                                        <label class='radio radio-inline'>
                                            <input type='radio' name='video_type' value ='upload' id='displayupload' @if($row['video_type'] == 'upload') checked="checked" @endif > Upload </label>
                                        <label class='radio radio-inline'>
                                            <input type='radio' name='video_type' value ='link' id='displaylink' @if($row['video_type'] == 'link') checked="checked" @endif > Link </label> 
                                    </div> 

                                </div>

                                <div class="form-group videotypeupload" style="display:none;" >
                                    <label for="Video" class=" control-label col-md-4 text-left"> Video </label>
                                    <div class="col-md-6">
                                        <input  type='file' name='video_video' id='video_video'  />
                                        <div >
                                            {!! SiteHelpers::showUploadedFile($row['video_video'],'/uploads/properties_subtab_imgs/') !!}

                                        </div>					

                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="videotypelink" style="display:none;" >
                                    <div class="form-group">
                                        <label for="Link Type" class=" control-label col-md-4 text-left"> Link Type </label>
                                        <div class="col-md-8"> 
                                            <label class='radio radio-inline'>
                                                <input type='radio' name='video_link_type' value ='youtube' @if($row['video_link_type'] == 'youtube') checked="checked" @endif > Youtube </label>
                                            <label class='radio radio-inline'>
                                                <input type='radio' name='video_link_type' value ='vimeo' @if($row['video_link_type'] == 'vimeo') checked="checked" @endif > Vimeo </label> 
                                        </div> 

                                    </div>

                                    <div class="form-group" >
                                        <label for="Video Link" class=" control-label col-md-4 text-left"> Video Link </label>
                                        <div class="col-md-8">
                                            <input type='text' name='video_link' id='video_link' class="form-control" value="{{$row['video_link']}}" />
                                        </div> 


                                    </div>
                                </div>



                            </div>

                            <div class="tab-pane m-t" id="socialmedia">
                                <div class="form-group  " >
                                    <label for="Social Tab" class=" control-label col-md-4 text-left"> Social Tab </label>
                                    <div class="col-md-6">
                                        <input type="radio" name="social_status" value="0" {{($row['social_status'] == '0') ? " checked='checked' " : '' }} /> Disable  
                                        <input type="radio" name="social_status" value="1" {{($row['social_status'] == '1') ? " checked='checked' " : " checked='checked' " }} /> Enable  
                                    </div>
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group  " >
                                    <label for="Facebook" class=" control-label col-md-4 text-left"> Facebook </label>
                                    <div class="col-md-6">
                                        {!! Form::text('social_facebook', $row['social_facebook'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group  " >
                                    <label for="Twitter" class=" control-label col-md-4 text-left"> Twitter </label>
                                    <div class="col-md-6">
                                        {!! Form::text('social_twitter', $row['social_twitter'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group  " >
                                    <label for="Google+" class=" control-label col-md-4 text-left"> Google+ </label>
                                    <div class="col-md-6">
                                        {!! Form::text('social_google', $row['social_google'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group  " >
                                    <label for="Youtube" class=" control-label col-md-4 text-left"> Youtube </label>
                                    <div class="col-md-6">
                                        {!! Form::text('social_youtube', $row['social_youtube'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group  " >
                                    <label for="Pinterest" class=" control-label col-md-4 text-left"> Pinterest </label>
                                    <div class="col-md-6">
                                        {!! Form::text('social_pinterest', $row['social_pinterest'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group  " >
                                    <label for="Vimeo" class=" control-label col-md-4 text-left"> Vimeo </label>
                                    <div class="col-md-6">
                                        {!! Form::text('social_vimeo', $row['social_vimeo'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="form-group  " >
                                    <label for="Instagram" class=" control-label col-md-4 text-left"> Instagram </label>
                                    <div class="col-md-6">
                                        {!! Form::text('social_instagram', $row['social_instagram'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane m-t " id="HotelAdress"> 
                        <div class="form-group  " >
                            <label for="City" class=" control-label col-md-4 text-left"> Address </label>
                            <div class="col-md-6">
                                {!! Form::text('address', $row['address'],array('class'=>'form-control', 'placeholder'=>'Copy the address from google map to get lat long',   )) !!} 
                            </div> 
                            <div class="col-md-2">

                            </div>
                        </div> 	    
                        <div class="form-group  " >
                            <label for="City" class=" control-label col-md-4 text-left"> City </label>
                            <div class="col-md-6">
                                {!! Form::text('city', $row['city'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                            </div> 
                            <div class="col-md-2">

                            </div>
                        </div> 					
                        <div class="form-group  " >
                            <label for="Country" class=" control-label col-md-4 text-left"> Country </label>
                            <div class="col-md-6">
                                {!! Form::text('country', $row['country'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                            </div> 
                            <div class="col-md-2">

                            </div>
                        </div> 					
                        <div class="form-group  " >
                            <label for="Website" class=" control-label col-md-4 text-left"> Website </label>
                            <div class="col-md-6">
                                {!! Form::text('website', $row['website'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                            </div> 
                            <div class="col-md-2">

                            </div>
                        </div> 
                        
                        <div class="form-group  " >
                            <label for="Website" class=" control-label col-md-4 text-left"> Latitude </label>
                            <div class="col-md-6">
                                {!! Form::text('latitude', $row['latitude'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                            </div> 
                            <div class="col-md-2">

                            </div>
                        </div>
                        <div class="form-group  " >
                            <label for="Website" class=" control-label col-md-4 text-left"> Longitude </label>
                            <div class="col-md-6">
                                {!! Form::text('longitude', $row['longitude'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                            </div> 
                            <div class="col-md-2">

                            </div>
                        </div>
                        					
                        <div class="form-group  " >
                            <label for="Phone" class=" control-label col-md-4 text-left"> Phone </label>
                            <div class="col-md-6">
                                {!! Form::text('phone', $row['phone'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                            </div> 
                            <div class="col-md-2">

                            </div>
                        </div> 					
                        <div class="form-group  " >
                            <label for="Email" class=" control-label col-md-4 text-left"> Email </label>
                            <div class="col-md-6">
                                {!! Form::text('email', $row['email'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                            </div> 
                            <div class="col-md-2">
                                <a href="#" data-toggle="tooltip" placement="left" class="tips" title="Enter your Email"><i class="icon-question2"></i></a>
                            </div>
                        </div> 
                    </div>

                    <div class="tab-pane m-t " id="Owner"> 

                        <div class="form-group  " >
                            <label for="owner_name" class=" control-label col-md-4 text-left"> Name <span class="asterix"> * </span></label>
                            <div class="col-md-6">
                                {!! Form::text('owner_name', $row['owner_name'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'required'  )) !!} 
                            </div> 
                            <div class="col-md-2">

                            </div>
                        </div> 					
                        <div class="form-group  " >
                            <label for="owner_last_name" class=" control-label col-md-4 text-left"> Last name <span class="asterix"> * </span></label>
                            <div class="col-md-6">
                                {!! Form::text('owner_last_name', $row['owner_last_name'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'required'  )) !!} 
                            </div> 
                            <div class="col-md-2">

                            </div>
                        </div> 
                        <div class="form-group  " >
                            <label for="owner_address" class=" control-label col-md-4 text-left"> Address <span class="asterix"> * </span></label>
                            <div class="col-md-6">
                                {!! Form::text('owner_address', $row['owner_address'],array('class'=>'form-control', 'placeholder'=>'',  'required'=>'required'  )) !!} 
                            </div> 
                            <div class="col-md-2">

                            </div>
                        </div> 
                        <div class="form-group  " >
                            <label for="owner_city" class=" control-label col-md-4 text-left"> City <span class="asterix"> * </span></label>
                            <div class="col-md-6">
                                {!! Form::text('owner_city', $row['owner_city'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'required'  )) !!} 
                            </div> 
                            <div class="col-md-2">

                            </div>
                        </div> 
                        <div class="form-group  " >
                            <label for="owner_postal_code" class=" control-label col-md-4 text-left"> Postal Code <span class="asterix"> * </span></label>
                            <div class="col-md-6">
                                {!! Form::text('owner_postal_code', $row['owner_postal_code'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'required'  )) !!} 
                            </div> 
                            <div class="col-md-2">

                            </div>
                        </div> 
                        <div class="form-group  " >
                            <label for="owner_country" class=" control-label col-md-4 text-left"> Country <span class="asterix"> * </span></label>
                            <div class="col-md-6">
                                {!! Form::text('owner_country', $row['owner_country'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'required'   )) !!} 
                            </div> 
                            <div class="col-md-2">

                            </div>
                        </div> 
                        <div class="form-group  " >
                            <label for="owner_phone_primary" class=" control-label col-md-4 text-left"> Phone Primary <span class="asterix"> * </span></label>
                            <div class="col-md-6">
                                {!! Form::text('owner_phone_primary', $row['owner_phone_primary'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'required'  )) !!} 
                            </div> 
                            <div class="col-md-2">

                            </div>
                        </div> 
                        <div class="form-group  " >
                            <label for="owner_phone_emergency" class=" control-label col-md-4 text-left"> Emergency Phone / Fax </label>
                            <div class="col-md-6">
                                {!! Form::text('owner_phone_emergency', $row['owner_phone_emergency'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                            </div> 
                            <div class="col-md-2">

                            </div>
                        </div> 


                        <div class="form-group  " >
                            <label for="owner_email_primary" class=" control-label col-md-4 text-left"> E-mail Primary <span class="asterix"> * </span></label>
                            <div class="col-md-6">
                                {!! Form::text('owner_email_primary', $row['owner_email_primary'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'required'  )) !!} 
                            </div> 
                            <div class="col-md-2">

                            </div>
                        </div> 

                        <div class="form-group  " >
                            <label for="owner_email_secondary" class=" control-label col-md-4 text-left"> E-mail Secondary </label>
                            <div class="col-md-6">
                                {!! Form::text('owner_email_secondary', $row['owner_email_secondary'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                            </div> 
                            <div class="col-md-2">

                            </div>
                        </div> 

                        <div class="form-group  " >
                            <label for="owner_website" class=" control-label col-md-4 text-left"> Website </label>
                            <div class="col-md-6">
                                {!! Form::text('owner_website', $row['owner_website'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                            </div> 
                            <div class="col-md-2">

                            </div>
                        </div> 

                        <div class="form-group  " >
                            <label for="owner_contact_person" class=" control-label col-md-4 text-left"> Contact Person </label>
                            <div class="col-md-6">
                                <input type="radio" name="owner_contact_person" value="Agent" class="owner_contact_person" {{($row['owner_contact_person'] == 'Agent') ? " checked='checked' " : '' }} /> Agent  
                                <input type="radio" name="owner_contact_person" value="Agency" class="owner_contact_person" {{($row['owner_contact_person'] == 'Agency') ? " checked='checked' " : '' }} /> Agency  
                                <input type="radio" name="owner_contact_person" value="Owner" class="owner_contact_person" {{($row['owner_contact_person'] == 'Owner') ? " checked='checked' " : '' }} /> Owner
                            </div>
                            <div class="col-md-2">

                            </div>
                        </div>

                    </div>
                    <div id="reports" class="tab-pane m-t">

                        <div class="form-group  " >
                            <label class="control-label col-md-4 text-left">Total Turnover: €{{$total_turnover}}</label>
                            <div class="col-md-8"></div>
                        </div>
                        <div class="form-group  " >
                            <label class="control-label col-md-4 text-left">Total Reservations: {{$total_reservations}}</label>
                            <div class="col-md-8"></div>
                        </div>
                        <div class="form-group  " >
                            <label class="control-label col-md-4 text-left">Total Commissions: €{{$total_commissions}}</label>
                            <div class="col-md-8"></div>
                        </div>
                        <div class="form-group  " >
                            <label class="control-label col-md-4 text-left">Total Rooms Booked: {{$total_rooms_booked}}</label>
                            <div class="col-md-8"></div>
                        </div>

                    </div>

                    <!--<div class="tab-pane m-t" id="AgentAgency" >
                                                                    
                      <div class="form-group  " >
                            <label for="agent_name" class=" control-label col-md-4 text-left"> Name <span class="asterix"> * </span></label>
                            <div class="col-md-6">
                              {!! Form::text('agent_name', $row['agent_name'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'required'  )) !!} 
                             </div> 
                             <div class="col-md-2">
                                    
                             </div>
                      </div> 					
                      <div class="form-group  " >
                            <label for="agent_last_name" class=" control-label col-md-4 text-left"> Last name <span class="asterix"> * </span></label>
                            <div class="col-md-6">
                              {!! Form::text('agent_last_name', $row['agent_last_name'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'required'  )) !!} 
                             </div> 
                             <div class="col-md-2">
                                    
                             </div>
                      </div> 
                     <div class="form-group  " >
                            <label for="agent_address" class=" control-label col-md-4 text-left"> Address <span class="asterix"> * </span></label>
                            <div class="col-md-6">
                              {!! Form::text('agent_address', $row['agent_address'],array('class'=>'form-control', 'placeholder'=>'',  'required'=>'required'  )) !!} 
                             </div> 
                             <div class="col-md-2">
                                    
                             </div>
                      </div> 
                       <div class="form-group  " >
                            <label for="agent_city" class=" control-label col-md-4 text-left"> City <span class="asterix"> * </span></label>
                            <div class="col-md-6">
                              {!! Form::text('agent_city', $row['agent_city'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'required'  )) !!} 
                             </div> 
                             <div class="col-md-2">
                                    
                             </div>
                      </div> 
                       <div class="form-group  " >
                            <label for="agent_postal_code" class=" control-label col-md-4 text-left"> Postal Code <span class="asterix"> * </span></label>
                            <div class="col-md-6">
                              {!! Form::text('agent_postal_code', $row['agent_postal_code'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'required'  )) !!} 
                             </div> 
                             <div class="col-md-2">
                                    
                             </div>
                      </div> 
                       <div class="form-group  " >
                            <label for="agent_country" class=" control-label col-md-4 text-left"> Country <span class="asterix"> * </span></label>
                            <div class="col-md-6">
                              {!! Form::text('agent_country', $row['agent_country'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'required'   )) !!} 
                             </div> 
                             <div class="col-md-2">
                                    
                             </div>
                      </div> 
                      <div class="form-group  " >
                            <label for="agent_phone_primary" class=" control-label col-md-4 text-left"> Phone Primary <span class="asterix"> * </span></label>
                            <div class="col-md-6">
                              {!! Form::text('agent_phone_primary', $row['agent_phone_primary'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'required'  )) !!} 
                             </div> 
                             <div class="col-md-2">
                                    
                             </div>
                      </div> 
                      <div class="form-group  " >
                            <label for="agent_phone_emergency" class=" control-label col-md-4 text-left"> Emergency Phone / Fax <span class="asterix"> * </span> </label>
                            <div class="col-md-6">
                              {!! Form::text('agent_phone_emergency', $row['agent_phone_emergency'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'required'  )) !!} 
                             </div> 
                             <div class="col-md-2">
                                    
                             </div>
                      </div> 
                                                    
                                                            
                      <div class="form-group  " >
                            <label for="agent_email_primary" class=" control-label col-md-4 text-left"> E-mail Primary <span class="asterix"> * </span></label>
                            <div class="col-md-6">
                              {!! Form::text('agent_email_primary', $row['agent_email_primary'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'required'  )) !!} 
                             </div> 
                             <div class="col-md-2">
                                    
                             </div>
                      </div> 
                      
                        <div class="form-group  " >
                            <label for="agent_email_secondary" class=" control-label col-md-4 text-left"> E-mail Secondary <span class="asterix"> * </span> </label>
                            <div class="col-md-6">
                              {!! Form::text('agent_email_secondary', $row['agent_email_secondary'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'required'  )) !!} 
                             </div> 
                             <div class="col-md-2">
                                    
                             </div>
                      </div> 
                      
                       <div class="form-group  " >
                            <label for="agent_website" class=" control-label col-md-4 text-left"> Website <span class="asterix"> * </span></label>
                            <div class="col-md-6">
                              {!! Form::text('agent_website', $row['agent_website'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'required'   )) !!} 
                             </div> 
                             <div class="col-md-2">
                                    
                             </div>
                      </div> 

                       <div class="form-group  " >
                            <label for="agent_linked_in" class=" control-label col-md-4 text-left"> Linked-in <span class="asterix"> * </span></label>
                            <div class="col-md-6">
                              {!! Form::text('agent_linked_in', $row['agent_linked_in'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'required'  )) !!} 
                             </div> 
                             <div class="col-md-2">
                                    
                             </div>
                      </div>
                      
                    </div>-->


                    <div style="clear:both"></div>	


                    <div class="form-group">
                        <label class="col-sm-4 text-right"></label>
                        <div class="col-sm-8">	
                            <button type="submit" name="apply" class="btn btn-info btn-sm" ><i class="fa  fa-check-circle"></i> {{ Lang::get('core.sb_apply') }}</button>
                            <button type="submit" name="submit" class="btn btn-primary btn-sm" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
                            <button type="button" onclick="location.href ='{{ URL::to('properties?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
                        </div>	  

                    </div> 

                    {!! Form::close() !!}
                </div>
            </div>		 
        </div>	
    </div>			 
    <script type="text/javascript">
        $(document).ready(function () {

            $("#property_cat_ids").jCombo("{{ URL::to('properties/comboselect?filter=tb_packages:id:package_title') }}",
            {  input_param: 'allow_user_groups', parent_value: '{{\CommonHelper::getusertype("users-b2c")}}', selected_value : '{{ $property_category }}', condition_param: 'find_in_set' });

            if ($('input[type="radio"][id="displayupload"]').is(":checked"))
            {
                $(".videotypeupload").show();
                $(".videotypelink").hide();
            }

            if ($('input[type="radio"][id="displaylink"]').is(":checked"))
            {
                $(".videotypeupload").hide();
                $(".videotypelink").show();
            }

            $('input[type="radio"][id="displayupload"]').on('ifChecked', function () {
                $(".videotypeupload").show();
                $(".videotypelink").hide();
            });

            $('input[type="radio"][id="displaylink"]').on('ifChecked', function () {
                $(".videotypeupload").hide();
                $(".videotypelink").show();
            });

            /* room sutes video section */

            if ($('input[type="radio"][id="rooms_suites_displayupload"]').is(":checked"))
            {
                $(".rooms_suites_videotypeupload").show();
                $(".rooms_suites_videotypelink").hide();
            }

            if ($('input[type="radio"][id="rooms_suites_displaylink"]').is(":checked"))
            {
                $(".rooms_suites_videotypeupload").hide();
                $(".rooms_suites_videotypelink").show();
            }

            $('input[type="radio"][id="rooms_suites_displayupload"]').on('ifChecked', function () {
                $(".rooms_suites_videotypeupload").show();
                $(".rooms_suites_videotypelink").hide();
            });

            $('input[type="radio"][id="rooms_suites_displaylink"]').on('ifChecked', function () {
                $(".rooms_suites_videotypeupload").hide();
                $(".rooms_suites_videotypelink").show();
            });

            /* architecture video section */
            if ($('input[type="radio"][id="architecture_displayupload"]').is(":checked"))
            {
                $(".architecture_videotypeupload").show();
                $(".architecture_videotypelink").hide();
            }

            if ($('input[type="radio"][id="architecture_displaylink"]').is(":checked"))
            {
                $(".architecture_videotypeupload").hide();
                $(".architecture_videotypelink").show();
            }

            $('input[type="radio"][id="architecture_displayupload"]').on('ifChecked', function () {
                $(".architecture_videotypeupload").show();
                $(".architecture_videotypelink").hide();
            });

            $('input[type="radio"][id="architecture_displaylink"]').on('ifChecked', function () {
                $(".architecture_videotypeupload").hide();
                $(".architecture_videotypelink").show();
            });

            /* architecture_design video section */
            if ($('input[type="radio"][id="architecture_design_displayupload"]').is(":checked"))
            {
                $(".architecture_design_videotypeupload").show();
                $(".architecture_design_videotypelink").hide();
            }

            if ($('input[type="radio"][id="architecture_design_displaylink"]').is(":checked"))
            {
                $(".architecture_design_videotypeupload").hide();
                $(".architecture_design_videotypelink").show();
            }

            $('input[type="radio"][id="architecture_design_displayupload"]').on('ifChecked', function () {
                $(".architecture_design_videotypeupload").show();
                $(".architecture_design_videotypelink").hide();
            });

            $('input[type="radio"][id="architecture_design_displaylink"]').on('ifChecked', function () {
                $(".architecture_design_videotypeupload").hide();
                $(".architecture_design_videotypelink").show();
            });

            /* architecture_designer video section */
            if ($('input[type="radio"][id="architecture_designer_displayupload"]').is(":checked"))
            {
                $(".architecture_designer_videotypeupload").show();
                $(".architecture_designer_videotypelink").hide();
            }

            if ($('input[type="radio"][id="architecture_designer_displaylink"]').is(":checked"))
            {
                $(".architecture_designer_videotypeupload").hide();
                $(".architecture_designer_videotypelink").show();
            }

            $('input[type="radio"][id="architecture_designer_displayupload"]').on('ifChecked', function () {
                $(".architecture_designer_videotypeupload").show();
                $(".architecture_designer_videotypelink").hide();
            });

            $('input[type="radio"][id="architecture_designer_displaylink"]').on('ifChecked', function () {
                $(".architecture_designer_videotypeupload").hide();
                $(".architecture_designer_videotypelink").show();
            });

            /* spa video section */
            if ($('input[type="radio"][id="spa_displayupload"]').is(":checked"))
            {
                $(".spa_videotypeupload").show();
                $(".spa_videotypelink").hide();
            }

            if ($('input[type="radio"][id="spa_displaylink"]').is(":checked"))
            {
                $(".spa_videotypeupload").hide();
                $(".spa_videotypelink").show();
            }

            $('input[type="radio"][id="spa_displayupload"]').on('ifChecked', function () {
                $(".spa_videotypeupload").show();
                $(".spa_videotypelink").hide();
            });

            $('input[type="radio"][id="spa_displaylink"]').on('ifChecked', function () {
                $(".spa_videotypeupload").hide();
                $(".spa_videotypelink").show();
            });

            /* restaurant video section */
            if ($('input[type="radio"][id="restaurant_displayupload"]').is(":checked"))
            {
                $(".restaurant_videotypeupload").show();
                $(".restaurant_videotypelink").hide();
            }

            if ($('input[type="radio"][id="restaurant_displaylink"]').is(":checked"))
            {
                $(".restaurant_videotypeupload").hide();
                $(".restaurant_videotypelink").show();
            }

            $('input[type="radio"][id="restaurant_displayupload"]').on('ifChecked', function () {
                $(".restaurant_videotypeupload").show();
                $(".restaurant_videotypelink").hide();
            });

            $('input[type="radio"][id="restaurant_displaylink"]').on('ifChecked', function () {
                $(".restaurant_videotypeupload").hide();
                $(".restaurant_videotypelink").show();
            });

            /* restaurant2 video section */
            if ($('input[type="radio"][id="restaurant2_displayupload"]').is(":checked"))
            {
                $(".restaurant2_videotypeupload").show();
                $(".restaurant2_videotypelink").hide();
            }

            if ($('input[type="radio"][id="restaurant2_displaylink"]').is(":checked"))
            {
                $(".restaurant2_videotypeupload").hide();
                $(".restaurant2_videotypelink").show();
            }

            $('input[type="radio"][id="restaurant2_displayupload"]').on('ifChecked', function () {
                $(".restaurant2_videotypeupload").show();
                $(".restaurant2_videotypelink").hide();
            });

            $('input[type="radio"][id="restaurant2_displaylink"]').on('ifChecked', function () {
                $(".restaurant2_videotypeupload").hide();
                $(".restaurant2_videotypelink").show();
            });

            /* restaurant2 video section */
            if ($('input[type="radio"][id="bar_displayupload"]').is(":checked"))
            {
                $(".bar_videotypeupload").show();
                $(".bar_videotypelink").hide();
            }

            if ($('input[type="radio"][id="bar_displaylink"]').is(":checked"))
            {
                $(".bar_videotypeupload").hide();
                $(".bar_videotypelink").show();
            }

            $('input[type="radio"][id="bar_displayupload"]').on('ifChecked', function () {
                $(".bar_videotypeupload").show();
                $(".bar_videotypelink").hide();
            });

            $('input[type="radio"][id="bar_displaylink"]').on('ifChecked', function () {
                $(".bar_videotypeupload").hide();
                $(".bar_videotypelink").show();
            });

            $("#assigned_user_id").jCombo("{{ URL::to('properties/comboselect?filter=tb_users:id:first_name|last_name') }}",
                    {selected_value: '{{ $property_user }}'});


            $('.removeCurrentFiles').on('click', function () {
                var removeUrl = $(this).attr('href');
                $.get(removeUrl, function (response) {});
                $(this).parent('div').empty();
                return false;
            });

            $('input[type="radio"][class="owner_contact_person"]').on('ifChecked', function () {
                var contprs = $(this).val();
                //alert(contprs);
                if (contprs == 'Owner')
                {
                    $('.AgentAgency').css('display', 'none');
                    $('#AgentAgency input').removeAttr('required');
                } else
                {
                    $('.AgentAgency').css('display', 'block');
                    $('#AgentAgency input').attr('required', 'required');
                }
            });

            var propty = $('#property_type').val();
            check_yachts(propty);
        });

        function check_yachts(prop)
        {
            if (prop == 'Yachts')
            {
                $('.yachtin').show();
            } else
            {
                $('.yachtin').hide();
            }
        }
        $('input[type="radio"][name="rdcitytax"]').on('ifChecked', function (event) {
            var _val = event.target.value;
            if(_val=='yes'){
                $(".dvcitytax").show();    
            }else{
                $(".dvcitytax").hide();
            }
        });
        
        
    </script>		 
    @stop