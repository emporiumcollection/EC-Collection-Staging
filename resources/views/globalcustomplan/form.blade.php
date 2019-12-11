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
		<li><a href="{{ URL::to('globalcustomplan?return='.$return) }}">{{ $pageTitle }}</a></li>
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

    {!! Form::open(array('url'=>'globalcustomplan/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
        <div class="col-md-12">
            <fieldset><legend> Global Custom Plan</legend>
									
            <div class="form-group  "  style="display:none;">
                <label for="Id" class=" control-label col-md-4 text-left"> Id </label>
                <div class="col-md-6">
                  {!! Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                </div> 
                <div class="col-md-2">
                 	
                </div>
            </div> 					
            <div class="form-group  " >
                <label for="Title" class=" control-label col-md-4 text-left"> Title </label>
                <div class="col-md-6">
                  {!! Form::text('title', $row['title'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                </div> 
                <div class="col-md-2">
                 	
                </div>
            </div> 					
            <div class="form-group  " >
                <label for="Description" class=" control-label col-md-4 text-left"> Description </label>
                <div class="col-md-6">
                  {!! Form::text('description', $row['description'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                </div> 
                <div class="col-md-2">
                 	
                </div>
            </div> 
            <div class="form-group ">
				<label for="Property" class=" control-label col-md-4 text-left">Assigned to Property</label>
                <div class="col-md-6">
    				<select name="assignedtoproperty[]" id="assignedtoproperty" class="select2" multiple="multiple">
                        <option value="0"> Select </option>
                        @if(!empty($properties))                            
                            @foreach($properties as $si)
                                <option value="{{$si->id}}" {{ in_array($si->id, $assigned_properties) ? " selected='selected' " : '' }}>{{$si->property_name}}</option>
                            @endforeach
                        @endif                                            
                    </select>
                </div>					
			</div>	
            <div class="form-group ">
				<label for="Property" class=" control-label col-md-4 text-left">Assigned to Category</label>
                <div class="col-md-6">
    				<select name="assignedtocategory[]" id="assignedtocategory" class="select2" multiple="multiple">
                        <option value="0"> Select </option>                        
                        @if(!empty($categories))                            
                            @foreach($categories as $si)
                                <option value="{{$si['id']}}" {{ in_array($si['id'], $assigned_categories) ? " selected='selected' " : '' }}>{{$si['name']}}</option>
                            @endforeach
                        @endif                                            
                    </select>
                </div>					
			</div>					
            <div class="form-group  " >
                <label for="Terms And Condition" class=" control-label col-md-4 text-left"> Terms And Condition </label>
                <div class="col-md-6">
                  {!! Form::text('terms_and_condition', $row['terms_and_condition'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                </div> 
                <div class="col-md-2">
                 	
                </div>
            </div> 					
            <div class="form-group  " >
                <label for="Start Date" class=" control-label col-md-4 text-left"> Start Date </label>
                <div class="col-md-6">
                  
                	<div class="input-group m-b" style="width:150px !important;">
                		{!! Form::text('start_date', $row['start_date'],array('class'=>'form-control datetime', 'style'=>'width:150px !important;')) !!}
                		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                	</div>
                
                 </div> 
                 <div class="col-md-2">
                 	
                 </div>
            </div> 					
            <div class="form-group  " >
                <label for="End Date" class=" control-label col-md-4 text-left"> End Date </label>
                <div class="col-md-6">
                  
                	<div class="input-group m-b" style="width:150px !important;">
                		{!! Form::text('end_date', $row['end_date'],array('class'=>'form-control datetime', 'style'=>'width:150px !important;')) !!}
                		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                	</div>
                
                 </div> 
                 <div class="col-md-2">
                 	
                 </div>
            </div> 					
            <div class="form-group  " >
                <label for="No Of Days" class=" control-label col-md-4 text-left"> No Of Days </label>
                <div class="col-md-6">
                  {!! Form::text('no_of_days', $row['no_of_days'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                 </div> 
                 <div class="col-md-2">
                 	
                 </div>
            </div> 					
            <div class="form-group  " >
                <label for="Price Type" class=" control-label col-md-4 text-left"> Price Type </label>
                <div class="col-md-6">
                    <select name="price_type" id="price_type" class="form-control">
                        <option value="0">Percentage</option>
                        <option value="1">Fixed</option>
                    </select>
                 </div> 
                 <div class="col-md-2">
                 	
                 </div>
            </div> 					
            <div class="form-group  " >
                <label for="Plan Price" class=" control-label col-md-4 text-left"> Plan Price </label>
                <div class="col-md-6">
                  {!! Form::text('plan_price', $row['plan_price'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                 </div> 
                 <div class="col-md-2">
                 	
                 </div>
            </div> 					
            <div class="form-group  " >
                <label for="Status" class=" control-label col-md-4 text-left"> Status </label>
                <div class="col-md-6">
                    <select name="status" id="status" class="form-control">
                        <option value="0" {{$row['status']==0 ? "selected='selected'" : '' }}>Inactive</option>
                        <option value="1" {{$row['status']==1 ? "selected='selected'" : '' }}>Active</option>
                    </select>               
                 </div> 
                 <div class="col-md-2">
                 	
                 </div>
            </div> 					
            </fieldset>
        </div>
			
			

		
		<div style="clear:both"></div>	
				
					
        <div class="form-group">
            <label class="col-sm-4 text-right">&nbsp;</label>
            <div class="col-sm-8">	
            <button type="submit" name="apply" class="btn btn-info btn-sm" ><i class="fa  fa-check-circle"></i> {{ Lang::get('core.sb_apply') }}</button>
            <button type="submit" name="submit" class="btn btn-primary btn-sm" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
            <button type="button" onclick="location.href='{{ URL::to('globalcustomplan?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
        </div>	  
        
        </div> 
		 
		 {!! Form::close() !!}
	</div>
</div>		 
</div>	
</div>			 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
@stop