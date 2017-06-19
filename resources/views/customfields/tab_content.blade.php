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

		 {!! Form::open(array('url'=>'save_customfield_tab_content', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
			<input type="hidden" name="tab_num" value="{{$tabno}}" />
			<input type="hidden" name="field_id" value="{{$fldid}}" />
			<div class="col-md-12">
				<fieldset>
					<legend> {{ Lang::get('core.btn_tab') }}{{$tabno}} {{ Lang::get('core.content') }} </legend>
							
					  <div class="form-group" >
						<label for="Title" class=" control-label col-md-4 text-left"> {{ Lang::get('core.tab_title') }} <span class="asterix"> * </span></label>
						<div class="col-md-6">
						  {!! Form::text('assign_tab_name', (!empty($tabdata)) ? $tabdata->assign_tab_name : '', array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true', 'id'=>'tab_title'  )) !!} 
						</div> 
						<div class="col-md-2">
							
						</div>
					  </div>
					@if(!empty($FieldArr))
						<div class="form-group repeatAttr1" >
							<label for="Title" class=" control-label col-md-4 text-left"> Tab Data <span class="asterix"> * </span>
							</label>
							<div class="col-md-6">
								<div class="row mainattr1 MrgBot10">
									<div class="col-md-12">
										<input type="hidden" name="edit_assign_field_id" value="{{(!empty($tabdata)) ? $tabdata->id : '' }}" />
										<select name="assign_field" required="required" class="form-control" style="width:100%;" onchange="customOptions(this.value, 1);">
											<option value=""> --Select-- </option>
											@foreach($FieldArr as $field)
												<option value="{{$field->type.'-'.$field->id}}" {{(!empty($tabdata)) ? ($tabdata->assign_field_id==$field->id) ? 'selected="selected"' : '' : ''}}>{{$field->caption}}</option>
											@endforeach
										</select>
									</div>
								</div>
								@if(!empty($tabdata))
									@if($tabdata->assign_field_type=='selectlist' || $tabdata->assign_field_type=='radiobutton' || $tabdata->assign_field_type=='checkbox')
										<div class="row MrgTop10 seloption">
											<div class="col-md-12">
												<select name="assign_field_val[]" class="js-example-basic-multiple1" required="required" multiple="multiple" style="width:100%">
													@if(!empty($FieldOPtArr[$tabdata->assign_field_id]))
														{{--*/ $optf = explode(',',$FieldOPtArr[$tabdata->assign_field_id]->option_values); 
														$assignoptsArr = explode(',', $tabdata->assign_field_values);
														/*--}}
														@foreach($optf as $fieldopt)
															<option value="{{$fieldopt}}" {{(in_array($fieldopt,$assignoptsArr)) ? 'selected="selected"' : ''}} >{{$fieldopt}}</option>
														@endforeach
													@endif
												});
												</select>
											</div>
										</div>
									@endif
								@endif
							</div>
						</div>
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
		$(".js-example-basic-multiple1").select2();
	});
	
	function customOptions(objVal, indx)
	{
		var str = '';
		var str_sel = '';
		if(objVal!='')
		{
			var exp_val = objVal.split("-");
			if(exp_val[0]=='selectlist' || exp_val[0]=='radiobutton' || exp_val[0]=='checkbox')
			{
				$('.repeatAttr'+indx+' div.seloption').remove();
				$.ajax({
				  url: "{{ URL::to('getCustomfieldOptions')}}",
				  type: "post",
				  data: "field_id="+exp_val[1],
				  dataType: "json",
				  success: function(data){
					if(data!='error')
					{
						str_sel += '<div class="row MrgTop10 seloption">';
						str_sel += '<div class="col-md-12">';
						str_sel += '<select name="assign_field_val[]" class="js-example-basic-multiple'+indx+'"  required="required" multiple="multiple" style="width:100%">';
						var opts = data.option_values.split(",");
						$.each(opts, function(idx, obj) {
							str_sel += '<option value="'+obj+'">'+obj+'</option>';
						});
						str_sel += '</select>';
						str_sel += '</div>';
						str_sel += '</div>';
						$('.mainattr'+indx).after(str_sel);
						$(".js-example-basic-multiple"+indx).select2();
					}
				  }
				});
			}
		}
		else
		{
			$('.repeatAttr'+indx+' div.seloption').remove();
		}
	}
	
	</script>		 
@stop