@extends('layouts.app')

@section('content')
<link href="{{ asset('sximo/css/custom_ps.css')}}" rel="stylesheet">

  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('customfields') }}">{{ $pageTitle }}</a></li>
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

		 {!! Form::open(array('url'=>'save_customfield_group_content', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
			<input type="hidden" name="field_id" value="{{$fldid}}" />
			<div class="col-md-12">
						<fieldset>
							<legend> Group </legend>	
							@if(!empty($FieldArr))
								@foreach($FieldArr as $field)
								<div class="form-group" >
									<label for="Title" class=" control-label col-md-4 text-left"> {{$field->caption}} <span class="asterix"> * </span>
										<input type="hidden" name="assign_field_id[]" value="{{$field->id}}" />
										<input type="hidden" name="assign_field_type[]" value="{{$field->type}}" />
										<input type="hidden" name="edit_assign_field_id[]" value="{{(!empty($groupdata)) ? $groupdata[$field->id]->id : '' }}" />
									</label>
									<div class="col-md-6">
										@if($field->type=="selectlist" || $field->type=="radiobutton" || $field->type=="checkbox")
											<select name="assign_field_val[{{$field->id}}][]" class="selectdrop" required="required" style="width:100%;" multiple="multiple">
												<option value=""> --Select-- </option>
												@if($field->option_values!=''))
													{{--*/ $optsArr = explode(',', $field->option_values);
														$assigned_values = (!empty($groupdata)) ? $groupdata[$field->id]->assign_field_values : '';
														$assignoptsArr = explode(',', $assigned_values);
													/*--}}
													@foreach($optsArr as $attropt)
													  <option value="{{$attropt}}" {{ (in_array($attropt,$assignoptsArr)) ? 'selected="selected"' : '' }}>{{$attropt}}</option>
													@endforeach
												@endif
											</select>
										@endif
									</div>
								</div>
								@endforeach
							@endif
						 </fieldset>
			</div>
			
			
			<div style="clear:both"></div>	
						
			<div class="form-group">
				<label class="col-sm-4 text-right">&nbsp;</label>
				<div class="col-sm-8">	
				<button type="submit" name="apply" class="btn btn-info btn-sm" ><i class="fa  fa-check-circle"></i> {{ Lang::get('core.sb_apply') }}</button>
				<button type="submit" name="submit" class="btn btn-primary btn-sm" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
				<button type="button" onclick="location.href='{{ URL::to('customfields?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
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
		$(".selectdrop").select2();
	});
	
	</script>		 
@stop