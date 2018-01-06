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
		<li><a href="{{ URL::to('attributes?return='.$return) }}">{{ $pageTitle }}</a></li>
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

		 {!! Form::open(array('url'=>'save_tab_content', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
		 <input type="hidden" name="tab_num" value="{{$tabno}}" />
		 <input type="hidden" name="attr_id" value="{{$aid}}" />
			<div class="col-md-12">
						<fieldset>
							<legend> {{ Lang::get('core.btn_tab') }}{{$tabno}} {{ Lang::get('core.content') }} </legend>
									
							  <div class="form-group" >
								<label for="Title" class=" control-label col-md-4 text-left"> {{ Lang::get('core.tab_title') }} <span class="asterix"> * </span></label>
								<div class="col-md-6">
								  {!! Form::text('tab_title',  ($tabtitle!='') ? $tabtitle : '', array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true', 'id'=>'tab_title'  )) !!} 
								</div> 
								<div class="col-md-2">
									
								</div>
							  </div>
							  @if(!empty($AttrArr))
								@foreach($AttrArr as $attr)
								<div class="form-group" >
									<label for="Title" class=" control-label col-md-4 text-left"> {{$attr->attr_title}} <span class="asterix"> * </span>
										<input type="hidden" name="assign_attr_id[]" value="{{$attr->id}}" />
										<input type="hidden" name="assign_attr_type[]" value="{{$attr->attr_type}}" />
										<input type="hidden" name="edit_assign_attr_id[]" value="{{(!empty($tabdata))?$tabdata[$attr->id]->id:''}}" />
									</label>
									<div class="col-md-6">
										@if($attr->attr_type=="dropdown" || $attr->attr_type=="radio" || $attr->attr_type=="checkboxes")
											{{--*/ (!empty($tabdata))?$expVal = explode(',',$tabdata[$attr->id]->assign_attr_val):$expVal = array(); /*--}}
											<select name="assign_attr_val[{{$attr->id}}][]" class="selectdrop" required="required" style="width:100%;" multiple="multiple">
												<option value=""> --Select-- </option>
												@if(!empty($optsArr))
													@foreach($optsArr[$attr->id] as $attropt)
													  <option value="{{$attropt->id}}" {{(in_array($attropt->id, $expVal))?'selected="selected"':''}}>{{$attropt->option_name}}</option>
													@endforeach
												@endif
											</select>
										@elseif($attr->attr_type=="text")
											<input type="text" class="form-control" name="assign_attr_val[{{$attr->id}}]" value="{{(!empty($tabdata))?$tabdata[$attr->id]->assign_attr_val:(!empty($optsArr))?$optsArr[$attr->id][0]->text_value:''}}" />
										@elseif($attr->attr_type=="textarea")
											<textarea name="assign_attr_val[{{$attr->id}}]" class="form-control">{{(!empty($tabdata))?$tabdata[$attr->id]->assign_attr_val:(!empty($optsArr))?$optsArr[$attr->id][0]->text_value:''}}</textarea>
										@elseif($attr->attr_type=="file")
											<a href="{{URL::to('uploads/attributes_imgs/'.$optsArr[$attr->id][0]->attr_img)}}" target="_blank" class="previewImage">
												<img src="{{URL::to('uploads/attributes_imgs/'.$optsArr[$attr->id][0]->attr_img)}}" title="{{$optsArr[$attr->id][0]->attr_img}}" class="img-responsive" width="80" height="80"/>
											</a>
										@else
										@endif
									</div>
								</div>
								@endforeach
							   @endif
						 </fieldset>
			</div>
			
			
			<div style="clear:both"></div>	
						
			<div class="form-group">
				<label class="col-sm-4 text-right"> </label>
				<div class="col-sm-8">	
				<button type="submit" name="apply" class="btn btn-info btn-sm" ><i class="fa  fa-check-circle"></i> {{ Lang::get('core.sb_apply') }}</button>
				<button type="submit" name="submit" class="btn btn-primary btn-sm" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
				<button type="button" onclick="location.href='{{ URL::to('attributes?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
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