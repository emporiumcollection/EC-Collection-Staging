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
		<li><a href="{{ URL::to('personalizedservice?return='.$return) }}">{{ $pageTitle }}</a></li>
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

		 {!! Form::open(array('url'=>'personalizedservice/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-12">
						<fieldset><legend> Personalizedservice</legend>
									
								  <div class="hidden form-group  " >
									<label for="Ps Id" class=" control-label col-md-4 text-left"> Ps Id </label>
									<div class="col-md-6">
									  {!! Form::text('ps_id', $row['ps_id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Salutation" class=" control-label col-md-4 text-left"> Salutation </label>
									<div class="col-md-6">
									  {!! Form::text('salutation', $row['salutation'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="First Name" class=" control-label col-md-4 text-left"> First Name </label>
									<div class="col-md-6">
									  {!! Form::text('first_name', $row['first_name'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Surname" class=" control-label col-md-4 text-left"> Surname </label>
									<div class="col-md-6">
									  {!! Form::text('surname', $row['surname'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
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
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Adults" class=" control-label col-md-4 text-left"> Adults </label>
									<div class="col-md-6">
									  {!! Form::text('adults', $row['adults'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Youth" class=" control-label col-md-4 text-left"> Youth </label>
									<div class="col-md-6">
									  {!! Form::text('youth', $row['youth'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Children" class=" control-label col-md-4 text-left"> Children </label>
									<div class="col-md-6">
									  {!! Form::text('children', $row['children'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Toddlers" class=" control-label col-md-4 text-left"> Toddlers </label>
									<div class="col-md-6">
									  {!! Form::text('toddlers', $row['toddlers'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Earliest Arrival" class=" control-label col-md-4 text-left"> Earliest Arrival </label>
									<div class="col-md-6">
									  {!! Form::text('earliest_arrival', $row['earliest_arrival'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Late Check Out" class=" control-label col-md-4 text-left"> Late Check Out </label>
									<div class="col-md-6">
									  {!! Form::text('late_check_out', $row['late_check_out'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Stay Time" class=" control-label col-md-4 text-left"> Stay Time </label>
									<div class="col-md-6">
									  {!! Form::text('stay_time', $row['stay_time'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Destinations" class=" control-label col-md-4 text-left"> Destinations </label>
									<div class="col-md-6">
                                                                        <select name="destinations[]" data-placeholder="Ex: Argentina, South Africa, Cape Town" class="chosen-select chosen-select-input-style" multiple tabindex="4">
                                                                            <?php
                                                                            if(!empty($destinations)) {
                                                                                foreach ($destinations as $destination) {
                                                                                    echo '<option ', (in_array($destination->id, explode(', ', $row['destinations'])))? 'selected' : '', ' value="'.$destination->id.'">'.$destination->category_name.'</option>'.PHP_EOL;
                                                                                    if(!empty($destination->sub_destinations)) {
                                                                                        foreach ($destination->sub_destinations as $sub_destination) {
                                                                                            echo '<option ', (in_array($sub_destination->id, explode(', ', $row['destinations'])))? 'selected' : '', ' value="'.$sub_destination->id.'">'.$sub_destination->category_name.'</option>'.PHP_EOL;
                                                                                            if(!empty($sub_destination->sub_destinations)) {
                                                                                                foreach ($sub_destination->sub_destinations as $sub_dest) {
                                                                                                    echo '<option ', (in_array($sub_dest->id, explode(', ', $row['destinations'])))? 'selected' : '', ' value="'.$sub_dest->id.'">'.$sub_dest->category_name.'</option>'.PHP_EOL;
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Inspirations" class=" control-label col-md-4 text-left"> Inspirations </label>
									<div class="col-md-6">
                                                                            <select class="form-control" name="inspirations[]" multiple="">
                                                                                <?php
                                                                                if(!empty($inspirations)) {
                                                                                    foreach ($inspirations as $inspiration) {
                                                                                        echo '<option ', (in_array($inspiration->id, explode(', ', $row['inspirations'])))? 'selected' : '', ' value="'.$inspiration->id.'">'.$inspiration->category_name.'</option>';
                                                                                    }
                                                                                }
                                                                                ?>                                                                                
                                                                            </select>
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Experiences" class=" control-label col-md-4 text-left"> Experiences </label>
									<div class="col-md-6">
                                                                            <select class="form-control" name="experiences[]" multiple="">
                                                                                <?php
                                                                                if(!empty($experiences)) {
                                                                                    foreach ($experiences as $experience) {
                                                                                        echo '<option ', (in_array($experience->id, explode(', ', $row['experiences'])))? 'selected' : '', ' value="'.$experience->id.'">'.$experience->category_name.'</option>';
                                                                                    }
                                                                                }
                                                                                ?>                                                                                
                                                                            </select>
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Note" class=" control-label col-md-4 text-left"> Note </label>
									<div class="col-md-6">
									  <textarea name='note' rows='5' id='note' class='form-control '  
				           >{{ $row['note'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Created" class=" control-label col-md-4 text-left"> Created </label>
									<div class="col-md-6">
									  
				<div class="input-group m-b" style="width:150px !important;">
					{!! Form::text('created', $row['created'],array('class'=>'form-control datetime', 'style'=>'width:150px !important;')) !!}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>
				 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Updated" class=" control-label col-md-4 text-left"> Updated </label>
									<div class="col-md-6">
									  
				<div class="input-group m-b" style="width:150px !important;">
					{!! Form::text('updated', $row['updated'],array('class'=>'form-control datetime', 'style'=>'width:150px !important;')) !!}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>
				 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> </fieldset>
			</div>
			
			

		
			<div style="clear:both"></div>	
				
					
				  <div class="form-group">
					<label class="col-sm-4 text-right">&nbsp;</label>
					<div class="col-sm-8">	
					<button type="submit" name="apply" class="btn btn-info btn-sm" ><i class="fa  fa-check-circle"></i> {{ Lang::get('core.sb_apply') }}</button>
					<button type="submit" name="submit" class="btn btn-primary btn-sm" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
					<button type="button" onclick="location.href='{{ URL::to('personalizedservice?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
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