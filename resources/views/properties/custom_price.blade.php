@extends('layouts.app')

@section('content')
<style>
    /*.select2-container-multi .select2-choices{ height: 30px !important;}*/
    .tc-toppadding{padding-top: 15px;}
    .abs-padding{ padding: 5px 0px; }
    .boards span{ padding-left: 5px; }
</style>
<script src="{{ asset('sximo/js/jquery.validate.js')}}"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
    			<div class="tab-pane active use-padding" id="seasons"> 					
    				<div class="text-right" style="padding: 20px;">
                        <button type="button" class="btn btn-danger b-btn addplan" ><i class="fa fa-plus"></i> Add</button>
                    </div>	
					@if(!empty($customseasons))
                    <table class="table table-striped ">
                        <thead>
                        <tr>
                            <th width="20">Sr no.</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Price</th>
                            <th width="160">Action</th>
                        </tr>
                        </thead>
					    {{--*/ $c=1; /*--}}
                        <tbody>
						@foreach($customseasons as $cseason)
                            <tr class="rw-{{$cseason->id}}">
                                <td>{{$c}}</td>
                                <td>{{$cseason->title}}</td>
                                <td>{{$cseason->description}}</td>                                
                                <td>{{$cseason->start_date}}</td>
                                <td>{{$cseason->end_date}}</td>
                                <td>{{$cseason->plan_price}}</td>
                                <td>
                                    <button type="button" class="btn btn-danger b-btn" onclick="edit_cseason_data({{$cseason->id}});"><i class="fa fa-edit"></i> Edit</button>
                                    <button type="button" class="btn btn-danger b-btn" onclick="delete_cseason_data({{$cseason->id}});"><i class="fa fa-trash"></i> Delete</button>
                                </td>
                            </tr>	
							{{--*/ $c++; /*--}}
						@endforeach
                        </tbody>
                    </table>
					@endif
    						 
    			</div>
    		</div>
            <div style="clear:both"></div>
            	
            @if(!empty($globalcustomplan))
                <div class="tab-content m-t">
        			<div class="tab-pane active use-padding">       				
                        <table class="table table-striped ">
                            <thead>
                            <tr>
                                <th width="20">Sr no.</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Price</th>
                                <th width="160">Action</th>
                            </tr>
                            </thead>
    					    {{--*/ $d=1; /*--}}
                            <tbody>    						
                            
                                @foreach($globalcustomplan as $si)
                                    <tr class="rw-{{$si->id}}">
                                        <td>{{$d}}</td>
                                        <td>{{$si->title}}</td>
                                        <td>{{$si->description}}</td>                                
                                        <td>{{$si->start_date}}</td>
                                        <td>{{$si->end_date}}</td>
                                        <td>{{$si->plan_price}}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger b-btn" onclick="edit_gseason_data({{$si->id}});"><i class="fa fa-edit"></i> Edit</button>                                            
                                        </td>
                                    </tr>	
                					{{--*/ $d++; /*--}}    
                                @endforeach
                                
                            </tbody>
                        </table>
    					
        						 
        			</div>
        		</div>
            @endif
        	
            
        </div>
    </div>
</div>
<div class="modal fade" id="customplan_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-default">
            	
            	<button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            	<h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body" id="sximo-modal-content">
                <ul class="nav nav-tabs">
                    <li class="nav-item active">
                        <a class="nav-link" data-toggle="tab" href="#details">Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tags">Tags</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#available_periods">Available periods</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#description">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#terms_and_conditions">Terms and conditions</a>
                    </li>
                </ul>
                <form id="frm_add_custom_plan_details" class="add_custom_plan_details" enctype="multipart/form-data">                 
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane tc-toppadding active" id="details">
                                                      
                            <input type="hidden" name="property_id_details" value="{{$pid}}" />
                            <input type="hidden" name="edit_id_details" id="edit_id_details" />
        					<div class="row">						
        							
        						<div class="form-group col-lg-12">
        							<label for="Name">Title </label>
        							<input name="plan_title" id="plan_title" type="text" class="form-control" value="" required="required" /> 
        						</div>        						
                                <div class="form-group col-lg-12">
                                    <label for="Priority">Room Types</label>
									<select name="room_types[]" id="room_types" class="select2" multiple="multiple">
                                        <option value="0"> Select </option>
                                        @if(!empty($cattypes))
                                            @foreach($cattypes as $si)
                                                <option value="{{$si->id}}">{{$si->category_name}}</option>
                                            @endforeach
                                        @endif                                            
                                    </select>
                                </div>        				                                        
                                <div class="form-group col-lg-8">
        							<label for="Priority">Price</label>
        							<input type="text" name="plan_price" id="plan_price" class="form-control" />
        						</div>
                                <div class="form-group col-lg-4">
                                    <label for="Type">Price Type</label>
                                    <select name="price_type" id="price_type" class="form-control">
                                        <option value="0">Percentage</option>
                                        <option value="1">Fixed</option>
                                    </select>											
        						</div>	
                                
                                <div class="form-group col-lg-12">
                                    <label for="Type">Items</label>
                                    <div class="boards">
                                        @if(!empty($cp_items))
                                            @foreach($cp_items as $si)
                                            <div class="row abs-padding">
                                                <div class="col-sm-6">
                                                    {{$si->title}}
                                                    <input type="hidden" name="hid_item[]" value="{{$si->id}}">
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="radio-inline"><input type="radio" name="it_inc_exc_{{$si->id}}" value="0" checked="checked" ><span>Included</span></label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="radio-inline"><input type="radio" name="it_inc_exc_{{$si->id}}" value="1"><span>Excluded</span></label>
                                                </div>
                                            </div>    
                                            @endforeach
                                        @endif    
                                    </div>
                                </div>    
                                
                                <div class="form-group col-lg-12">
                                    <label for="Type">Available Boards</label>
                                    <select name="ab" class="select2">
                                        <option value="0">Select</option>
                                        @if(!empty($boards))
                                            @foreach($boards as $si)
                                                <option value="{{$si->id}}">{{$si->board_name}}</option>
                                            @endforeach
                                        @endif    
                                    </select>											
        						</div>	
                                <div class="form-group col-lg-12">
                                    <label for="Type">Card Rule</label>
                                    <select name="card_rule" id="card_rule" class="form-control">
                                        <option value="0">Select</option>
                                        <option value="1">Charge</option>
                                        <option value="2">Pre-authorize</option>
                                        <option value="3">Wait</option>
                                    </select>											
        						</div>   
                                <div class="form-group col-lg-6">
        							<label for="Name">Booking code </label>
        							<input name="booking_code" id="booking_code" type="text" class="form-control" value="" /> 
        						</div>   
                                <div class="form-group col-lg-6">
        							<label for="Priority">Days in Advance</label>
        							<input type="text" name="days_id_advance" id="days_id_advance" class="form-control" />
        						</div>                             
                                <div class="form-group col-lg-6">
        							<label for="Name">Min Stay </label>
        							<input name="min_stay" id="min_stay" type="text" class="form-control" value="" /> 
        						</div>   
                                <div class="form-group col-lg-6">
        							<label for="Name">Max Stay</label>
        							<input name="max_stay" id="max_stay" type="text" class="form-control" value="" /> 
        						</div>   
                                <div class="col-lg-12">
                                    <div class="smessage"></div>
                                </div>				 
        						<div class="col-lg-12 text-right">    
                                    <button type="button" class="btn btn-success b-btn detail_next">Next</button>									
        							<!--<button type="submit" class="btn btn-success b-btn addCustomPlanDetails">Update</button>-->    									
        						</div>                                    
        					</div>
        				    
                    </div>
                    <div class="tab-pane tc-toppadding fade" id="tags">
                        
        					<div class="row">						
        						<div class="col-lg-12">
                                    <h3>Section Cancellation</h3>
                                </div>	
        						<div class="form-group col-lg-12">
                                    <input type="checkbox" name="tag_pre_payment" value="1" >
                                    <label class="form-check-label">Pre-payment</label>        							
        						</div> 
        						<div class="form-group col-lg-12">
        							<input type="checkbox" name="tag_diposit" value="1" >
                                    <label class="form-check-label">Deposit</label> 
        						</div>
                                <div class="form-group col-lg-12">
        							<input type="checkbox" name="tag_non_refundable_diposit" value="1" >
                                    <label class="form-check-label">Non refundable deposit</label>
        						</div>
                                <div class="form-group col-lg-12">
        							<input type="checkbox" name="tag_non_refundable_rate" value="1" >
                                    <label class="form-check-label">Non refundable rate</label>					
        						</div>	
                                <div class="form-group col-lg-12">
        							<input type="checkbox" name="tag_no_credit_card_required" value="1" >
                                    <label class="form-check-label">No credit card required</label>
        						</div>                                						
        				        <div class="form-group col-lg-12">
        							<input type="checkbox" name="tag_free_cancellation" value="1" >
                                    <label class="form-check-label">Free cancellation</label>
        						</div>
                                   
                                <div class="col-lg-12">
                                    <h3>General Description</h3>
                                </div>
                                
        						<div class="form-group col-lg-12">
                                    <input type="checkbox" name="tag_most_popular_rate" value="1" >
                                    <label class="form-check-label">Most Popular Rates</label>        							
        						</div> 
        						<div class="form-group col-lg-12">
        							<input type="checkbox" name="tag_one_per_discount" value="1" >
                                    <label class="form-check-label">1% Discount</label> 
        						</div>
                                <div class="form-group col-lg-12">
        							<input type="checkbox" name="tag_discounted_rate" value="1" >
                                    <label class="form-check-label">Discounted rate</label>
        						</div>
                                <div class="form-group col-lg-12">
        							<input type="checkbox" name="tag_standard_rate" value="1" >
                                    <label class="form-check-label">Standard rate</label>					
        						</div>                                 
                                
                                <div class="col-lg-12">
                                    <h3>Board Description</h3>
                                </div>	
                                <div class="form-group col-lg-12">
                                    <input type="checkbox" name="tag_breakfast_included" value="1" >
                                    <label class="form-check-label">Breakfast included</label>        							
        						</div> 
        						<div class="form-group col-lg-12">
        							<input type="checkbox" name="tag_no_board_included" value="1" >
                                    <label class="form-check-label">No board included</label> 
        						</div>
                                <div class="form-group col-lg-12">
        							<input type="checkbox" name="tag_fullboard_included" value="1" >
                                    <label class="form-check-label">Fullboard included</label>
        						</div>
                                <div class="form-group col-lg-12">
        							<input type="checkbox" name="tag_all_inclusive" value="1" >
                                    <label class="form-check-label">All inclusive</label>					
        						</div>                                
                                                            
                                <div class="col-lg-12">
                                    <div class="smessage"></div>
                                </div>				 
        						<div class="col-lg-12 text-right">
                                    <button type="button" class="btn btn-success b-btn tags_prev">Previous</button> 
                                    <button type="button" class="btn btn-success b-btn tags_next">Next</button>    									
        							<!-- <button type="submit" class="btn btn-success b-btn editCustomPlan">Update</button> -->    									
        						</div>                                    
        					</div>
        				
                    </div>
                    <div class="tab-pane tc-toppadding fade" id="available_periods">
                        
        					<div class="row">						
        						<div class="form-group col-lg-12">
        							<label for="Name">Booking Periods</label>
        							<button type="button" id="btn_booking_period" class="btn btn-success"><i class="fa fa-plus"></i>Add</button> 
        						</div>
                                <div class="dv-booking-periods" style="display: none;">
                                    <div class="form-group col-lg-6">
            							<label for="Priority">Start Date</label>
            							<input type="text" name="plan_booking_start_date" id="plan_booking_start_date" class="form-control datepic" />
            						</div>	
                                    <div class="form-group col-lg-6">
            							<label for="Priority">End Date</label>
            							<input type="text" name="plan_booking_end_date" id="plan_booking_end_date" class="form-control datepic" />
            						</div>
                                    <div class="form-group col-lg-6">
            							<label for="Priority">Season</label>
            							<select name="plan_booking_season" id="plan_booking_season" class="select2">
                                            <option value="0"> Select </option>
                                            @if(!empty($seasons))
                                                @foreach($seasons as $si)
                                                    <option value="{{$si->id}}">{{$si->season_name}}</option>
                                                @endforeach
                                            @endif                                            
                                        </select>					
            						</div>	
                                    <div class="form-group col-lg-6">
            							<label for="Priority">Available Days</label>
            							<select name="booking_available_days[]" class="select2" multiple="multiple">
                                            <option value="1">Monday</option>
                                            <option value="2">Tuesday</option>
                                            <option value="3">Wednesday</option>
                                            <option value="4">Thursday</option>
                                            <option value="5">Friday</option>
                                            <option value="6">Saturday</option>
                                            <option value="7">Sunday</option>
                                        </select>
            						</div>	                                    
                                </div> 	
                                <div class="form-group col-lg-12">
        							<label for="Name">Staying Periods</label>
        							<button type="button" id="btn_staying_period" class="btn btn-success"><i class="fa fa-plus"></i>Add</button> 
        						</div> 	
                                <div class="dv-staying-periods" style="display: none;">
            						<div class="form-group col-lg-6">
            							<label for="Priority">Start Date</label>
            							<input type="text" name="plan_staying_start_date" id="plan_staying_start_date" class="form-control datepic" />
            						</div>	
                                    <div class="form-group col-lg-6">
            							<label for="Priority">End Date</label>
            							<input type="text" name="plan_staying_end_date" id="plan_staying_end_date" class="form-control datepic" />
            						</div>
                                    <div class="form-group col-lg-6">
            							<label for="Priority">Season</label>
            							<select name="plan_staying_season" id="plan_staying_season" class="select2" >
                                            <option value="0"> Select </option>
                                            @if(!empty($seasons))
                                                @foreach($seasons as $si)
                                                    <option value="{{$si->id}}">{{$si->season_name}}</option>
                                                @endforeach
                                            @endif                                            
                                        </select>					
            						</div>	
                                    <div class="form-group col-lg-6">
            							<label for="Priority">Available Days</label>
            							<select name="staying_available_days[]" class="select2" multiple="multiple">
                                            <option value="1">Monday</option>
                                            <option value="2">Tuesday</option>
                                            <option value="3">Wednesday</option>
                                            <option value="4">Thursday</option>
                                            <option value="5">Friday</option>
                                            <option value="6">Saturday</option>
                                            <option value="7">Sunday</option>
                                        </select>
            						</div>
                                </div>                                
                                
                                <div class="col-lg-12">
                                    <div class="smessage"></div>
                                </div>				 
        						<div class="col-lg-12 text-right">    									
                                    <button type="button" class="btn btn-success b-btn ap_prev">Previous</button> 
                                    <button type="button" class="btn btn-success b-btn ap_next">Next</button>
        							<!--<button type="submit" class="btn btn-success b-btn editCustomPlan">Update</button>-->    									
        						</div>                                    
        					</div>
        				
                    </div>
                    <div class="tab-pane tc-toppadding fade" id="description">
                        
        					<div class="row">        							
        						<div class="form-group col-lg-12">
        							<label for="Name">Description </label>        							
                                    <textarea name="plan_description" id="plan_description" class="form-control"></textarea> 
        						</div> 
                                <div class="form-group col-lg-12">
        							<label for="Name">Image1 </label>        							
                                    <input type="file" name="plan_image1" class="form-control" />  
        						</div>
                                <div class="form-group col-lg-12">
        							<label for="Name">Image2 </label>        							
                                    <input type="file" name="plan_image2" class="form-control" />  
        						</div>
                                <div class="form-group col-lg-12">
        							<label for="Name">Image3 </label>        							
                                    <input type="file" name="plan_image3" class="form-control" />  
        						</div>
                                <div class="form-group col-lg-12">
        							<label for="Name">Youtube Url </label>        							
                                    <input type="text" name="plan_youtube_url" id="plan_youtube_url" class="form-control" >
        						</div>
        						<div class="col-lg-12">
                                    <div class="smessage"></div>
                                </div>					 
        						<div class="col-lg-12 text-right">    									
                                    <button type="button" class="btn btn-success b-btn desc_prev">Previous</button> 
                                    <button type="button" class="btn btn-success b-btn desc_next">Next</button>
        							<!-- <button type="submit" class="btn btn-success b-btn editCustomPlan">Update</button> -->    									
        						</div>                                    
        					</div>
        				
                    </div>
                    <div class="tab-pane tc-toppadding fade" id="terms_and_conditions">
                        
        					<div class="row">        							
        						<div class="form-group col-lg-12">
        							<label for="Name">Terms and conditions </label>        							
                                    <textarea name="plan_terms_and_conditions" id="plan_terms_and_conditions" class="form-control"></textarea> 
        						</div> 
                                <div class="col-lg-12">
                                    <div class="smessage"></div>
                                </div>				 
        						<div class="col-lg-12 text-right">    									
                                    <button type="button" class="btn btn-success b-btn tac_prev">Previous</button> 
                                    <!--<button type="button" class="btn btn-success b-btn tac_next">Next</button> -->
        							<button type="submit" class="btn btn-success b-btn addCustomPlanDetails">Save</button>    									
        						</div>                                    
        					</div>
        				
                    </div>
                </div>
                </form>    
            </div>
        
        </div>
    </div>
</div>

<div class="modal fade" id="edit_customplan_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-default">
            	
            	<button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            	<h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body" id="sximo-modal-content">
                <ul class="nav nav-tabs">
                    <li class="nav-item active">
                        <a class="nav-link" data-toggle="tab" href="#edetails">Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#etags">Tags</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#eavailable_periods">Available periods</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#edescription">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#eterms_and_conditions">Terms and conditions</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane tc-toppadding active" id="edetails">
                        <form id="frm_edit_custom_plan_details" class="edit_custom_plan_details">                               
                            <input type="hidden" name="eproperty_id_details" value="{{$pid}}" />
                            <input type="hidden" name="eedit_id_details" id="eedit_id_details" />
        					<div class="row">						
        							
        						<div class="form-group col-lg-12">
        							<label for="Name">Title </label>
        							<input name="eplan_title" id="eplan_title" type="text" class="form-control" value="" required="required" /> 
        						</div>        						
                                <div class="form-group col-lg-12">
                                    <label for="Priority">Room Types</label>
									<select name="eroom_types[]" id="eroom_types" class="select2" multiple="multiple">
                                        <option value="0"> Select </option>
                                        @if(!empty($cattypes))
                                            @foreach($cattypes as $si)
                                                <option value="{{$si->id}}">{{$si->category_name}}</option>
                                            @endforeach
                                        @endif                                            
                                    </select>
                                </div>        				                                        
                                <div class="form-group col-lg-8">
        							<label for="Priority">Discount</label>
        							<input type="text" name="eplan_price" id="eplan_price" class="form-control" />
        						</div>
                                <div class="form-group col-lg-4">
                                    <label for="Type">Discount Type</label>
                                    <select name="eprice_type" id="eprice_type" class="form-control">
                                        <option value="0">Percentage</option>
                                        <option value="1">Fixed</option>
                                    </select>											
        						</div>	
                                
                                <div class="form-group col-lg-12">
                                    <label for="Type">Items</label>
                                    <div class="boards">
                                        @if(!empty($cp_items))
                                            @foreach($cp_items as $si)
                                            <div class="row abs-padding">
                                                <div class="col-sm-6">
                                                    {{$si->title}}
                                                    <input type="hidden" name="ehid_item[]" value="{{$si->id}}">
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="radio-inline"><input type="radio" name="eit_inc_exc_{{$si->id}}" value="0" checked="checked" class="eit_inc_exc" ><span>Included</span></label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="radio-inline"><input type="radio" name="eit_inc_exc_{{$si->id}}" value="1"><span>Excluded</span></label>
                                                </div>
                                            </div>    
                                            @endforeach
                                        @endif    
                                    </div>
                                </div>    
                                
                                <div class="form-group col-lg-12">
                                    <label for="Type">Available Boards</label>
                                    <select name="eab" id="eab" class="select2">
                                        <option value="0">Select</option>
                                        @if(!empty($boards))
                                            @foreach($boards as $si)
                                                <option value="{{$si->id}}">{{$si->board_name}}</option>
                                            @endforeach
                                        @endif    
                                    </select>											
        						</div>	
                                <div class="form-group col-lg-12">
                                    <label for="Type">Card Rule</label>
                                    <select name="ecard_rule" id="ecard_rule" class="form-control">
                                        <option value="0">Select</option>
                                        <option value="1">Charge</option>
                                        <option value="2">Pre-authorize</option>
                                        <option value="3">Wait</option>
                                    </select>											
        						</div>   
                                <div class="form-group col-lg-6">
        							<label for="Name">Booking code </label>
        							<input name="ebooking_code" id="booking_code" type="text" class="form-control" value="" /> 
        						</div>   
                                <div class="form-group col-lg-6">
        							<label for="Priority">Days in Advance</label>
        							<input type="text" name="edays_id_advance" id="edays_id_advance" class="form-control" />
        						</div>                             
                                <div class="form-group col-lg-6">
        							<label for="Name">Min Stay </label>
        							<input name="emin_stay" id="emin_stay" type="text" class="form-control" value="" /> 
        						</div>   
                                <div class="form-group col-lg-6">
        							<label for="Name">Max Stay</label>
        							<input name="emax_stay" id="emax_stay" type="text" class="form-control" value="" /> 
        						</div>   
                                <div class="col-lg-12">
                                    <div class="detailssmessage"></div>
                                </div>				 
        						<div class="col-lg-12 text-right">    
                                    <!--<button type="button" class="btn btn-success b-btn detail_next">Next</button>-->									
        							<button type="submit" class="btn btn-success b-btn editAddCustomPlanDetails">Update</button>    									
        						</div>                                    
        					</div>
        				</form>     
                    </div>
                    <div class="tab-pane tc-toppadding fade" id="etags">
                        <form id="add_custom_plan_tags" class="add_custom_plan_tags">                               
                            <input type="hidden" name="tag_property_id" value="{{$pid}}" />
                            <input type="hidden" name="tag_edit_id" id="tag_edit_id" value="" />
        					<div class="row">						
        						<div class="col-lg-12">
                                    <h3>Section Cancellation</h3>
                                </div>	
        						<div class="form-group col-lg-12">
                                    <input type="checkbox" name="etag_pre_payment" value="1" >
                                    <label class="form-check-label">Pre-payment</label>        							
        						</div> 
        						<div class="form-group col-lg-12">
        							<input type="checkbox" name="etag_diposit" value="1" >
                                    <label class="form-check-label">Deposit</label> 
        						</div>
                                <div class="form-group col-lg-12">
        							<input type="checkbox" name="etag_non_refundable_diposit" value="1" >
                                    <label class="form-check-label">Non refundable deposit</label>
        						</div>
                                <div class="form-group col-lg-12">
        							<input type="checkbox" name="etag_non_refundable_rate" value="1" >
                                    <label class="form-check-label">Non refundable rate</label>					
        						</div>	
                                <div class="form-group col-lg-12">
        							<input type="checkbox" name="etag_no_credit_card_required" value="1" >
                                    <label class="form-check-label">No credit card required</label>
        						</div>                                						
        				        <div class="form-group col-lg-12">
        							<input type="checkbox" name="etag_free_cancellation" value="1" >
                                    <label class="form-check-label">Free cancellation</label>
        						</div>
                                   
                                <div class="col-lg-12">
                                    <h3>General Description</h3>
                                </div>
                                
        						<div class="form-group col-lg-12">
                                    <input type="checkbox" name="etag_most_popular_rate" value="1" >
                                    <label class="form-check-label">Most Popular Rates</label>        							
        						</div> 
        						<div class="form-group col-lg-12">
        							<input type="checkbox" name="etag_one_per_discount" value="1" >
                                    <label class="form-check-label">1% Discount</label> 
        						</div>
                                <div class="form-group col-lg-12">
        							<input type="checkbox" name="etag_discounted_rate" value="1" >
                                    <label class="form-check-label">Discounted rate</label>
        						</div>
                                <div class="form-group col-lg-12">
        							<input type="checkbox" name="etag_standard_rate" value="1" >
                                    <label class="form-check-label">Standard rate</label>					
        						</div>                                 
                                
                                <div class="col-lg-12">
                                    <h3>Board Description</h3>
                                </div>	
                                <div class="form-group col-lg-12">
                                    <input type="checkbox" name="etag_breakfast_included" value="1" >
                                    <label class="form-check-label">Breakfast included</label>        							
        						</div> 
        						<div class="form-group col-lg-12">
        							<input type="checkbox" name="etag_no_board_included" value="1" >
                                    <label class="form-check-label">No board included</label> 
        						</div>
                                <div class="form-group col-lg-12">
        							<input type="checkbox" name="etag_fullboard_included" value="1" >
                                    <label class="form-check-label">Fullboard included</label>
        						</div>
                                <div class="form-group col-lg-12">
        							<input type="checkbox" name="etag_all_inclusive" value="1" >
                                    <label class="form-check-label">All inclusive</label>					
        						</div>                                
                                                            
                                <div class="col-lg-12">
                                    <div class="tagssmessage"></div>
                                </div>				 
        						<div class="col-lg-12 text-right">
                                    <!-- <button type="button" class="btn btn-success b-btn tags_prev">Previous</button> 
                                    <button type="button" class="btn btn-success b-btn tags_next">Next</button> -->    									
        							<button type="submit" class="btn btn-success b-btn editCustomPlanTags">Update</button>    									
        						</div>                                    
        					</div>
        				</form> 
                    </div>
                    <div class="tab-pane tc-toppadding fade" id="eavailable_periods">
                        <form id="add_custom_plan_available_periods" class="add_custom_plan_available_periods">                               
                            <input type="hidden" name="ap_property_id" value="{{$pid}}" />
                            <input type="hidden" name="ap_edit_id" id="ap_edit_id" value="" />
        					<div class="row">						
        						<div class="form-group col-lg-12">
        							<label for="Name">Booking Periods</label>
        							<button type="button" id="ebtn_booking_period" class="btn btn-success"><!--<i class="fa fa-plus"></i>-->Add</button> 
        						</div>
                                <div class="edv-booking-periods" style="display: none;">
                                    <div class="form-group col-lg-6">
            							<label for="Priority">Start Date</label>
            							<input type="text" name="eplan_booking_start_date" id="eplan_booking_start_date" class="form-control datepic" />
            						</div>	
                                    <div class="form-group col-lg-6">
            							<label for="Priority">End Date</label>
            							<input type="text" name="eplan_booking_end_date" id="eplan_booking_end_date" class="form-control datepic" />
            						</div>
                                    <div class="form-group col-lg-6">
            							<label for="Priority">Season</label>
            							<select name="eplan_booking_season" id="eplan_booking_season" class="select2">
                                            <option value="0"> Select </option>
                                            @if(!empty($seasons))
                                                @foreach($seasons as $si)
                                                    <option value="{{$si->id}}">{{$si->season_name}}</option>
                                                @endforeach
                                            @endif                                            
                                        </select>					
            						</div>	
                                    <div class="form-group col-lg-6">
            							<label for="Priority">Available Days</label>
            							<select name="ebooking_available_days[]" id="ebooking_available_days" class="select2" multiple="multiple">
                                            <option value="1">Monday</option>
                                            <option value="2">Tuesday</option>
                                            <option value="3">Wednesday</option>
                                            <option value="4">Thursday</option>
                                            <option value="5">Friday</option>
                                            <option value="6">Saturday</option>
                                            <option value="7">Sunday</option>
                                        </select>
            						</div>	                                    
                                </div> 	
                                <div class="form-group col-lg-12">
        							<label for="Name">Staying Periods</label>
        							<button type="button" id="ebtn_staying_period" class="btn btn-success"><!--<i class="fa fa-plus"></i>-->Add</button> 
        						</div> 	
                                <div class="edv-staying-periods" style="display: none;">
            						<div class="form-group col-lg-6">
            							<label for="Priority">Start Date</label>
            							<input type="text" name="eplan_staying_start_date" id="eplan_staying_start_date" class="form-control datepic" />
            						</div>	
                                    <div class="form-group col-lg-6">
            							<label for="Priority">End Date</label>
            							<input type="text" name="eplan_staying_end_date" id="eplan_staying_end_date" class="form-control datepic" />
            						</div>
                                    <div class="form-group col-lg-6">
            							<label for="Priority">Season</label>
            							<select name="eplan_staying_season" id="eplan_staying_season" class="select2">
                                            <option value="0"> Select </option>
                                            @if(!empty($seasons))
                                                @foreach($seasons as $si)
                                                    <option value="{{$si->id}}">{{$si->season_name}}</option>
                                                @endforeach
                                            @endif                                            
                                        </select>					
            						</div>	
                                    <div class="form-group col-lg-6">
            							<label for="Priority">Available Days</label>
            							<select name="estaying_available_days[]" id="estaying_available_days" class="select2" multiple="multiple">
                                            <option value="1">Monday</option>
                                            <option value="2">Tuesday</option>
                                            <option value="3">Wednesday</option>
                                            <option value="4">Thursday</option>
                                            <option value="5">Friday</option>
                                            <option value="6">Saturday</option>
                                            <option value="7">Sunday</option>
                                        </select>
            						</div>
                                </div>                                
                                
                                <div class="col-lg-12">
                                    <div class="apsmessage"></div>
                                </div>				 
        						<div class="col-lg-12 text-right">    									
                                    <!--<button type="button" class="btn btn-success b-btn ap_prev">Previous</button> 
                                    <button type="button" class="btn btn-success b-btn ap_next">Next</button> -->
        							<button type="submit" class="btn btn-success b-btn editCustomPlanAP">Update</button>    									
        						</div>                                    
        					</div>
        				</form>
                    </div>
                    <div class="tab-pane tc-toppadding fade" id="edescription">
                        <form id="add_custom_plan_description" class="add_custom_plan_description" enctype="multipart/form-data">                               
                            <input type="hidden" name="desc_property_id" value="{{$pid}}" />
                            <input type="hidden" name="desc_edit_id" id="desc_edit_id" value="" />
        					<div class="row">        							
        						<div class="form-group col-lg-12">
        							<label for="Name">Description </label>        							
                                    <textarea name="eplan_description" id="eplan_description" class="form-control"></textarea> 
        						</div>
                                <div class="form-group col-lg-12">
        							<label for="Image">Image 1 </label>        							
                                    <input type="file" name="eplan_image1" class="form-control" /> 
                                    <br />
                                    <img id="eplan_image_preview1" width="100px" /> 
        						</div>
                                <div class="form-group col-lg-12">
        							<label for="Image">Image 2 </label>        							
                                    <input type="file" name="eplan_image2" class="form-control" /> 
                                    <br />
                                    <img id="eplan_image_preview2" width="100px" /> 
        						</div>
                                <div class="form-group col-lg-12">
        							<label for="Image">Image 3 </label>        							
                                    <input type="file" name="eplan_image3" class="form-control" /> 
                                    <br />
                                    <img id="eplan_image_preview3" width="100px" /> 
        						</div>
                                <div class="form-group col-lg-12">
        							<label for="Name">Youtube Url </label>        							
                                    <input type="text" name="eplan_youtube_url" id="eplan_youtube_url" class="form-control" >
        						</div> 
        						<div class="col-lg-12">
                                    <div class="descsmessage"></div>
                                </div>					 
        						<div class="col-lg-12 text-right">    									
                                    <!--<button type="button" class="btn btn-success b-btn desc_prev">Previous</button> 
                                    <button type="button" class="btn btn-success b-btn desc_next">Next</button> -->
        							 <button type="submit" class="btn btn-success b-btn editCustomPlanDesc">Update</button>     									
        						</div>                                    
        					</div>
        				</form>
                    </div>
                    <div class="tab-pane tc-toppadding fade" id="eterms_and_conditions">
                        <form id="add_custom_plan_terms_and_conditions" class="add_custom_plan_terms_and_conditions">                               
                            <input type="hidden" name="property_id" value="{{$pid}}" />
                            <input type="hidden" name="tac_edit_id" id="tac_edit_id" value="" />
        					<div class="row">        							
        						<div class="form-group col-lg-12">
        							<label for="Name">Terms and conditions </label>        							
                                    <textarea name="eplan_terms_and_conditions" id="eplan_terms_and_conditions" class="form-control"></textarea> 
        						</div> 
                                <div class="col-lg-12">
                                    <div class="etac_smessage"></div>
                                </div>				 
        						<div class="col-lg-12 text-right">    									
                                    <!--<button type="button" class="btn btn-success b-btn tac_prev">Previous</button> 
                                    <button type="button" class="btn btn-success b-btn tac_next">Next</button> -->
        							<button type="submit" class="btn btn-success b-btn editCustomPlanTAC">Update</button>    									
        						</div>                                    
        					</div>
        				</form>
                    </div>
                </div>
                   
            </div>
        
        </div>
    </div>
</div>

<div class="modal fade" id="global_customplan_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-default">
            	
            	<button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            	<h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body" id="sximo-modal-content">
                <form id="global_add_custom_plan" class="global_add_custom_plan">                               
                    <input type="hidden" name="global_property_id" value="{{$pid}}" />
                    <input type="hidden" name="global_edit_customplan_id" id="global_edit_customplan_id" value="" />
					<div class="row">						
							
						<div class="form-group col-lg-12">
							<label for="Name">Title </label>
							<input name="global_plan_title" id="global_plan_title" type="text" class="form-control" value="" required="required" /> 
						</div> 
						<div class="form-group col-lg-12">
							<label for="Priority">Description </label>
							<textarea name="global_plan_desc" id="global_plan_desc" class="form-control"> </textarea> 
						</div>
                        <div class="form-group col-lg-12">
							<label for="Priority">Terms and condition</label>
							<textarea name="global_plan_tac" id="global_plan_tac" class="form-control"> </textarea>
						</div>
                        <div class="form-group col-lg-6" style="display: none;">
							<label for="Priority">Season</label>
							<select name="global_plan_season[]" id="global_plan_season" class="select2" multiple="multiple">
                                <option value="0"> Select </option>
                                @if(!empty($seasons))
                                    @foreach($seasons as $si)
                                        <option value="{{$si->id}}">{{$si->season_name}}</option>
                                    @endforeach
                                @endif                                            
                            </select>					
						</div>								
				        <div class="form-group col-lg-6">
							<label for="Priority">Start Date</label>
							<input type="text" name="global_plan_start_date" id="global_plan_start_date" class="form-control datepic" />
						</div>	
                        <div class="form-group col-lg-6">
							<label for="Priority">End Date</label>
							<input type="text" name="global_plan_end_date" id="global_plan_end_date" class="form-control datepic" />
						</div>
                        <div class="form-group col-lg-6">
							<label for="Priority">Number of days before early booking showing</label>
							<input type="text" name="global_plan_no_of_days" id="global_plan_no_of_days" class="form-control" />
						</div>
                        
                        <div class="form-group col-lg-2">
                            <label for="Priority">Type</label>
                            <select name="global_price_type" id="global_price_type" class="form-control">
                                <option value="0">Percentage</option>
                                <option value="1">Fixed</option>
                            </select>											
						</div>	
                        <div class="form-group col-lg-4">
							<label for="Priority">Price</label>
							<input type="text" name="global_plan_price" id="global_plan_price" class="form-control" />
						</div>
                        <div class="col-lg-12">
                            <div class="smessage"></div>
                        </div>				 
						<div class="col-lg-12 text-right">    									
							<button type="submit" class="btn btn-success b-btn editGlobalCustomPlan">Update</button>    									
						</div>                                    
					</div>
				</form>    
            </div>
        
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $('.datepic').datepicker({
			numberOfMonths: 2,
			showButtonPanel: true,
			dateFormat: 'yy-mm-dd'
	});
      
});
$(document).on('click', '#btn_booking_period', function(){
    $(".dv-booking-periods").show();            
});
$(document).on('click', '#btn_staying_period', function(){
    $(".dv-staying-periods").show();        
});


$(document).on('click', '.detail_next', function(){
    $('[href="#tags"]').trigger('click');    
});
$(document).on('click', '.tags_next', function(){
    $('[href="#available_periods"]').trigger('click');    
});
$(document).on('click', '.ap_next', function(){
    $('[href="#description"]').trigger('click');    
});
$(document).on('click', '.desc_next', function(){
    $('[href="#terms_and_conditions"]').trigger('click');    
});



$(document).on('click', '.tags_prev', function(){
    $('[href="#details"]').trigger('click');    
});
$(document).on('click', '.ap_prev', function(){
    $('[href="#tags"]').trigger('click');    
});
$(document).on('click', '.desc_prev', function(){
    $('[href="#available_periods"]').trigger('click');    
});
$(document).on('click', '.tac_prev', function(){
    $('[href="#description"]').trigger('click');    
});


$(document).on('click', '.addCustomPlan', function(){ console.log("hello");
    $("#add_custom_plan").validate({
        submitHandler: function (form) {
			 saveCustomPlan();
			 return false;
		}
    }); 
});
$(document).on('click', '.editCustomPlan', function(){
    //$(".editCustomPlan").text('Update');
    $("#modal_add_custom_plan").validate({
        submitHandler: function (form) {
			 editCustomPlan();
			 return false;
		}
    }); 
});

$(document).on('click', '.addCustomPlanDetails', function(){
    $("#frm_add_custom_plan_details").validate({
        submitHandler: function (form) {
			 addCustomPlanDetails();
			 return false;
		}
    });     
});

function addCustomPlanDetails(){ 

    var form = $('#frm_add_custom_plan_details')[0];
    var formData = new FormData(form);
    $.ajax({
        url: "{{ URL::to('customplan/updatecustomplandetails')}}",
        type: "post",
        //data: $("#frm_add_custom_plan_details").serializeArray(),
        processData: false,
        contentType: false,
        data: formData,
        dataType: "json",
        success: function(data){
            var html = '';
            if(data.status=='error'){
                html +='<div class="alert alert-danger fade in block-inner">';
				html +='<button data-dismiss="alert" class="close" type="button">×</button>';
				html +='<i class="icon-checkmark-circle"></i> '+data.msg+' </div>';
				$(".smessage").html(html);	
            }else{
                html +='<div class="alert alert-success fade in block-inner">';
    			html +='<button data-dismiss="alert" class="close" type="button">×</button>';    			
				html +='<i class="icon-checkmark-circle"></i> '+data.msg+' </div>';
				$(".smessage").html(html);
                
                $("#customplan_modal").modal('hide');
                window.location.reload();                    
            }        
        }
    });    
}

$(document).on('change', '#plan_season', function(){
    console.log("hello");    
});
$(document).on('click', '.addplan', function(e){ //console.log(navigator.userAgent);
    $(".editCustomPlan").text('Add');
    $("#customplan_modal").modal('show');    
});
function editCustomPlan()
{
    $.ajax({
        url: "{{ URL::to('customplan/updatecustomplan')}}",
        type: "post",
        data: $("#modal_add_custom_plan").serializeArray(),
        dataType: "json",
        success: function(data){
            var html = '';
            if(data.status=='error'){
                html +='<div class="alert alert-danger fade in block-inner">';
				html +='<button data-dismiss="alert" class="close" type="button">×</button>';
				html +='<i class="icon-checkmark-circle"></i> '+data.msg+' </div>';
				$(".smessage").html(html);	
            }else{
                html +='<div class="alert alert-success fade in block-inner">';
    			html +='<button data-dismiss="alert" class="close" type="button">×</button>';    			
				html +='<i class="icon-checkmark-circle"></i> '+data.msg+' </div>';
				$(".smessage").html(html);
                
                $("#customplan_modal").modal('hide');
                window.location.reload();                    
            }        
        }
    });	
}
function saveCustomPlan()
{
    $.ajax({
        url: "{{ URL::to('addcustomplan')}}",
        type: "post",
        data: $("#add_custom_plan").serializeArray(),
        dataType: "json",
        success: function(data){		
            if(data.status=='error'){
            	
            }        
        }
    });	
}
function edit_cseason_data(cseasonId){    
    
    if(cseasonId!='' && cseasonId>0)
	{
		$.ajax({
		  url: "{{ URL::to('customplan/editplan')}}",
		  type: "get",
		  data: "pid="+cseasonId,
		  dataType: "json",
		  success: function(data){
		      if(data.status=="success"){
		          console.log(data.plan);
                  var objplan = data.plan;
                  var objseason = data.seasons;
                  var objtags = data.cplan_tags;
                  var objcpab = data.cpab;
                  var objcp_ars = data.cp_ars;
                  
                  var objcp_booking_days = data.booking_days;
                  var objcp_staying_days = data.staying_days;
                  //console.log(objseason);
                  var objcpitems = data.cpitems;
                  console.log(objcpab);
                  
                  if(typeof objplan!='undefined'){
                    $("#eedit_id_details").val(cseasonId);
                    $("#tag_edit_id").val(cseasonId);
                    $("#ap_edit_id").val(cseasonId);
                    $("#desc_edit_id").val(cseasonId);
                    $("#tac_edit_id").val(cseasonId);
                    
                    
                    $("#edit_id_details").val(objplan.id);                    
                    $('#eplan_title').val(objplan.title);
                                        
                    $('#eroom_types').val(objcp_ars);
                    $('#eroom_types').trigger('change');
                    
                    $('#eplan_price').val(objplan.plan_price);
                    $('#eprice_type').val(objplan.price_type);
                    
                    //for(int i=0; i < )
                    if(objcpitems.length==0){                      
                        $(".eit_inc_exc").each(function(){
                           $(".eit_inc_exc").iCheck('check'); 
                        });      
                    }else{
                        $.each(objcpitems, function(index, value){
                            $('input:radio[name="eit_inc_exc_'+value.item_id+'"]').filter('[value="'+value.item_inc_ex+'"]').iCheck('check');      
                        });
                    }
                    if(objplan.available_board != null){
                        $('#eab').val(objplan.available_board);
                        $('#eab').trigger('change');
                    }else{
                         $('#eab').val('0');
                        $('#eab').trigger('change');    
                    }
                    //for(int i=0; i < )
                    $.each(objcpab, function(index, value){
                        $('input:radio[name="eab_inc_exc_'+value.board_id+'"]').filter('[value="'+value.board_inc_ex+'"]').iCheck('check');      
                    });
                                                        
                    $('#ecard_rule').val(objplan.card_rule);
                    $('input[name="ebooking_code"]').val(objplan.booking_code);
                    $('#edays_id_advance').val(objplan.no_of_days);
                    $('#emin_stay').val(objplan.min_stay);
                    $('#emax_stay').val(objplan.max_stay);
                    
                    if(objtags.pre_payment==1){
                        $('input[name="etag_pre_payment"]').iCheck('check'); 
                    }else{
                        $('input[name="etag_pre_payment"]').iCheck('uncheck');
                    }
                    if(objtags.deposit==1){
                        $('input[name="etag_diposit"]').iCheck('check');    
                    }else{
                        $('input[name="etag_diposit"]').iCheck('uncheck'); 
                    }
                    if(objtags.non_refundable_deposit==1){
                        $('input[name="etag_non_refundable_diposit"]').iCheck('check');    
                    }else{
                        $('input[name="etag_non_refundable_diposit"]').iCheck('uncheck'); 
                    }                                  
                    if(objtags.non_refundable_rate==1){
                        $('input[name="etag_non_refundable_rate"]').iCheck('check');    
                    }else{
                        $('input[name="etag_non_refundable_rate"]').iCheck('uncheck'); 
                    }
                    if(objtags.no_credit_card_required==1){
                        $('input[name="etag_no_credit_card_required"]').iCheck('check');    
                    }else{
                        $('input[name="etag_no_credit_card_required"]').iCheck('uncheck'); 
                    }      
                    if(objtags.free_cancellation==1){
                        $('input[name="etag_free_cancellation"]').iCheck('check');    
                    }else{
                        $('input[name="etag_free_cancellation"]').iCheck('uncheck'); 
                    }
                    if(objtags.most_popular_rates==1){
                        $('input[name="etag_most_popular_rate"]').iCheck('check');    
                    }else{
                        $('input[name="etag_most_popular_rate"]').iCheck('uncheck'); 
                    }                    
                    if(objtags.one_per_discount==1){
                        $('input[name="etag_one_per_discount"]').iCheck('check');    
                    }else{
                        $('input[name="etag_one_per_discount"]').iCheck('uncheck'); 
                    }
                    
                    if(objtags.discounted_rate==1){
                        $('input[name="etag_discounted_rate"]').iCheck('check');    
                    }else{
                        $('input[name="etag_discounted_rate"]').iCheck('uncheck'); 
                    }
                    
                    if(objtags.standard_rate==1){
                        $('input[name="etag_standard_rate"]').iCheck('check');    
                    }else{
                        $('input[name="etag_standard_rate"]').iCheck('uncheck'); 
                    }
                    
                    if(objtags.breakfast_included==1){
                        $('input[name="etag_breakfast_included"]').iCheck('check');    
                    }else{
                        $('input[name="etag_breakfast_included"]').iCheck('uncheck'); 
                    }                    
                    if(objtags.no_board_included==1){
                        $('input[name="etag_no_board_included"]').iCheck('check');    
                    }else{
                        $('input[name="etag_no_board_included"]').iCheck('uncheck'); 
                    }
                    if(objtags.fullboard_included==1){
                        $('input[name="etag_fullboard_included"]').iCheck('check');    
                    }else{
                        $('input[name="etag_fullboard_included"]').iCheck('uncheck'); 
                    }
                    if(objtags.all_inclusive==1){
                        $('input[name="etag_all_inclusive"]').iCheck('check');    
                    }else{
                        $('input[name="etag_all_inclusive"]').iCheck('uncheck'); 
                    } 
                    
                    $('input[name="eplan_booking_start_date"]').val(objplan.booking_start_date);
                    $('input[name="eplan_booking_end_date"]').val(objplan.booking_end_date);                    
                    $('#eplan_booking_season').val(objplan.booking_season);
                    $('#eplan_booking_season').trigger('change');
                    $('#ebooking_available_days').val(objcp_booking_days);
                    $('#ebooking_available_days').trigger('change');  console.log(objcp_booking_days);
                    
                    //$('input[name="ebooking_available_days"]').val(objplan.end_date);
                    $('input[name="eplan_staying_start_date"]').val(objplan.staying_start_date);
                    $('input[name="eplan_staying_end_date"]').val(objplan.staying_end_date);
                    $('#eplan_staying_season').val(objplan.staying_season);
                    $('#eplan_staying_season').trigger('change'); console.log(objcp_staying_days);
                    $('#estaying_available_days').val(objcp_staying_days);
                    $('#estaying_available_days').trigger('change');
                    //$('input[name="estaying_available_days"]').val(objplan.price_type);
                    
                    $('#eplan_description').val(objplan.description);
                    if(objplan.plan_img1!=null){
                        $('#eplan_image_preview1').attr('src', "{{Url('/')}}"+"/uploads/properties_customplan_imgs/"+objplan.plan_img1);
                        $('#eplan_image_preview1').css('display', '');
                    }else{
                        $('#eplan_image_preview1').attr('src', "");
                        $('#eplan_image_preview1').css('display', 'none');
                    }
                    if(objplan.plan_img2!=null){
                        $('#eplan_image_preview2').attr('src', "{{Url('/')}}"+"/uploads/properties_customplan_imgs/"+objplan.plan_img2);
                        $('#eplan_image_preview2').css('display', '');
                    }else{
                        $('#eplan_image_preview2').attr('src', "");
                        $('#eplan_image_preview2').css('display', 'none');
                    }
                    if(objplan.plan_img3!=null){
                        $('#eplan_image_preview3').attr('src', "{{Url('/')}}"+"/uploads/properties_customplan_imgs/"+objplan.plan_img3);
                        $('#eplan_image_preview3').css('display', '');
                    }else{
                        $('#eplan_image_preview3').attr('src', "");
                        $('#eplan_image_preview3').css('display', 'none');
                    }
                    $('#eplan_youtube_url').val(objplan.youtube_url);
                    $('#eplan_terms_and_conditions').val(objplan.terms_and_condition);
                     
                    
                    $(".editCustomPlan").text('Update');
                    //$('#modal_plan_season').trigger({ type: 'select2:select', params: { data: objseason } });                   
                  }
                  $("#edit_customplan_modal").modal('show');        
		      }    	  
		  }
		});		
	}    
}
function delete_cseason_data(cseasonId)
{
	if(cseasonId!='' && cseasonId>0)
	{
		var conf = confirm("Are you sure? you want to delete this record!");
		if(conf==true)
		{
			$.ajax({
			  url: "{{ URL::to('customplan/deleteplan')}}",
			  type: "post",
			  data: "cseason_Id="+cseasonId,
			  dataType: "json",
			  success: function(data){
				  var html ='';
				  if(data.status=='error')
				  {
						html +='<div class="alert alert-danger fade in block-inner">';
						html +='<button data-dismiss="alert" class="close" type="button">×</button>';
						html +='<i class="icon-checkmark-circle"></i> Record Not Found </div>';
						$('.page-content-wrapper #formerrors').html(html);
						window.scrollTo(0, 0);
				  }
				  else{		
				        $(".rw-"+cseasonId).remove();
						html +='<div class="alert alert-success fade in block-inner">';
						html +='<button data-dismiss="alert" class="close" type="button">×</button>';
						html +='<i class="icon-checkmark-circle"></i> Record Deleted Successfully </div>';
						$('.page-content-wrapper #formerrors').html(html);
						window.scrollTo(0, 0);
				  }
			  }
			});
		}
	}
}
function edit_gseason_data(cseasonId){    
    
    if(cseasonId!='' && cseasonId>0)
	{
		$.ajax({
		  url: "{{ URL::to('customplan/editglobalplan')}}",
		  type: "get",
		  data: "pid="+cseasonId,
		  dataType: "json",
		  success: function(data){
		      if(data.status=="success"){
		          console.log(data.plan);
                  var objplan = data.plan;
                  var objseason = data.seasons;
                  console.log(objseason);
                  if(typeof objplan!='undefined'){
                    $("#global_edit_customplan_id").val(objplan.id);                    
                    $('#global_plan_title').val(objplan.title);
                    $('#global_plan_desc').val(objplan.description);
                    $('#global_plan_tac').val(objplan.terms_and_condition);
                    $('#global_plan_start_date').val(objplan.start_date);
                    $('#global_plan_end_date').val(objplan.end_date);
                    $('#global_plan_no_of_days').val(objplan.no_of_days);
                    $('#global_price_type').val(objplan.price_type);
                    $('#global_plan_price').val(objplan.plan_price); 
                    $('#global_plan_season').val(objseason); 
                    $('#global_plan_season').trigger('change'); 
                    //$(".editCustomPlan").text('Update');
                    //$('#modal_plan_season').trigger({ type: 'select2:select', params: { data: objseason } });                   
                  }
                  $("#global_customplan_modal").modal('show');        
		      }    	  
		  }
		});		
	}    
}   
$(document).on('click', '.editGlobalCustomPlan', function(){
    //$(".editCustomPlan").text('Update');
    $("#global_add_custom_plan").validate({
        submitHandler: function (form) {
			 editGlobalCustomPlan();
			 return false;
		}
    }); 
});
function editGlobalCustomPlan()
{
    $.ajax({
        url: "{{ URL::to('customplan/updateglobalplan')}}",
        type: "post",
        data: $("#global_add_custom_plan").serializeArray(),
        dataType: "json",
        success: function(data){
            var html = '';
            if(data.status=='error'){
                html +='<div class="alert alert-danger fade in block-inner">';
				html +='<button data-dismiss="alert" class="close" type="button">×</button>';
				html +='<i class="icon-checkmark-circle"></i> '+data.msg+' </div>';
				$(".smessage").html(html);	
            }else{
                html +='<div class="alert alert-success fade in block-inner">';
    			html +='<button data-dismiss="alert" class="close" type="button">×</button>';    			
				html +='<i class="icon-checkmark-circle"></i> '+data.msg+' </div>';
				$(".smessage").html(html);
                
                $("#customplan_modal").modal('hide');
                window.location.reload();                    
            }        
        }
    });	
}
$(document).on('click', '#ebtn_booking_period', function(){
    $(".edv-booking-periods").toggle();    
});
$(document).on('click', '#ebtn_staying_period', function(){
    $(".edv-staying-periods").toggle();    
});


$(document).on('click', '.editAddCustomPlanDetails', function(e){
    e.preventDefault();
    $.ajax({
        url: "{{ URL::to('customplan/customplandetails')}}",
        type: "post",
        data: $("#frm_edit_custom_plan_details").serializeArray(),
        dataType: "json",
        success: function(data){
            var html = '';
            if(data.status=='error'){
                html +='<div class="alert alert-danger fade in block-inner">';
				html +='<button data-dismiss="alert" class="close" type="button">x</button>';
				html +='<i class="icon-checkmark-circle"></i> '+data.msg+' </div>';
				$(".detailssmessage").html(html);	
            }else{
                html +='<div class="alert alert-success fade in block-inner">';
    			html +='<button data-dismiss="alert" class="close" type="button">x</button>';    			
				html +='<i class="icon-checkmark-circle"></i> '+data.msg+' </div>';
				$(".detailssmessage").html(html);
                
                //$("#customplan_modal").modal('hide');
                //window.location.reload();                    
            }        
        }
    });            
});

$(document).on('click', '.editCustomPlanTags', function(e){
    e.preventDefault();
    $.ajax({
        url: "{{ URL::to('customplan/customplandtags')}}",
        type: "post",
        data: $("#add_custom_plan_tags").serializeArray(),
        dataType: "json",
        success: function(data){
            var html = '';
            if(data.status=='error'){
                html +='<div class="alert alert-danger fade in block-inner">';
				html +='<button data-dismiss="alert" class="close" type="button">x</button>';
				html +='<i class="icon-checkmark-circle"></i> '+data.msg+' </div>';
				$(".tagssmessage").html(html);	
            }else{
                html +='<div class="alert alert-success fade in block-inner">';
    			html +='<button data-dismiss="alert" class="close" type="button">x</button>';    			
				html +='<i class="icon-checkmark-circle"></i> '+data.msg+' </div>';
				$(".tagssmessage").html(html);
                
                //$("#customplan_modal").modal('hide');
                //window.location.reload();                    
            }        
        }
    });            
});
$(document).on('click', '.editCustomPlanAP', function(e){
    e.preventDefault();
    $.ajax({
        url: "{{ URL::to('customplan/editcustomplanap')}}",
        type: "post",
        data: $("#add_custom_plan_available_periods").serializeArray(),
        dataType: "json",
        success: function(data){
            var html = '';
            if(data.status=='error'){
                html +='<div class="alert alert-danger fade in block-inner">';
				html +='<button data-dismiss="alert" class="close" type="button">x</button>';
				html +='<i class="icon-checkmark-circle"></i> '+data.msg+' </div>';
				$(".apsmessage").html(html);	
            }else{
                html +='<div class="alert alert-success fade in block-inner">';
    			html +='<button data-dismiss="alert" class="close" type="button">x</button>';    			
				html +='<i class="icon-checkmark-circle"></i> '+data.msg+' </div>';
				$(".apsmessage").html(html);
                
                //$("#customplan_modal").modal('hide');
                //window.location.reload();                    
            }        
        }
    });            
});
$(document).on('click', '.editCustomPlanDesc', function(e){
    e.preventDefault();
    var form = $('#add_custom_plan_description')[0];
    var formData = new FormData(form);
    $.ajax({
        url: "{{ URL::to('customplan/editcustomplandesc')}}",
        type: "post",
        //data: $("#add_custom_plan_description").serializeArray(),
        data: formData,
        processData: false,
        contentType: false, 
        dataType: "json",
        success: function(data){
            var html = '';
            if(data.status=='error'){
                html +='<div class="alert alert-danger fade in block-inner">';
				html +='<button data-dismiss="alert" class="close" type="button">x</button>';
				html +='<i class="icon-checkmark-circle"></i> '+data.msg+' </div>';
				$(".descsmessage").html(html);	
            }else{
                html +='<div class="alert alert-success fade in block-inner">';
    			html +='<button data-dismiss="alert" class="close" type="button">x</button>';    			
				html +='<i class="icon-checkmark-circle"></i> '+data.msg+' </div>';
				$(".descsmessage").html(html);
                
                //$("#customplan_modal").modal('hide');
                //window.location.reload();                    
            }        
        }
    });            
});
$(document).on('click', '.editCustomPlanTAC', function(e){
    e.preventDefault();
    $.ajax({
        url: "{{ URL::to('customplan/editcustomplantac')}}",
        type: "post",
        data: $("#add_custom_plan_terms_and_conditions").serializeArray(),
        dataType: "json",
        success: function(data){
            var html = '';
            if(data.status=='error'){
                html +='<div class="alert alert-danger fade in block-inner">';
				html +='<button data-dismiss="alert" class="close" type="button">x</button>';
				html +='<i class="icon-checkmark-circle"></i> '+data.msg+' </div>';
				$(".etac_smessage").html(html);	
            }else{
                html +='<div class="alert alert-success fade in block-inner">';
    			html +='<button data-dismiss="alert" class="close" type="button">x</button>';    			
				html +='<i class="icon-checkmark-circle"></i> '+data.msg+' </div>';
				$(".etac_smessage").html(html);
                
                //$("#customplan_modal").modal('hide');
                //window.location.reload();                    
            }        
        }
    });            
});

</script>
@stop