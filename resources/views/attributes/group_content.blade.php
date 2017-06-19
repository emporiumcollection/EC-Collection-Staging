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

		 {!! Form::open(array('url'=>'save_group_content', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
		 <input type="hidden" name="attr_id" value="{{$aid}}" />
			<div class="col-md-12">
						<fieldset>
							<legend> {{ Lang::get('core.btn_group') }} {{ Lang::get('core.content') }} </legend>	
							@if(!empty($groupdata))
								{{--*/ $cln = 0 /*--}}
								@foreach($groupdata as $gdata)
									{{--*/ $cln++ /*--}}
								  <div class="form-group clone{{$cln}}" >
								  @if(!empty($AttrArr))
									@foreach($AttrArr as $attr)
									<div class="col-md-2">
										{{$attr->attr_title}}
											<input type="hidden" name="assign_attr_id[{{$cln}}][]" value="{{$attr->id}}" />
											<input type="hidden" name="assign_attr_type[{{$cln}}][]" value="{{$attr->attr_type}}" />
											<input type="hidden" name="edit_assign_attr_id[{{$cln}}][]" value="{{$gdata[$attr->id]->id}}" />
										<br>
											@if($attr->attr_type=="dropdown" || $attr->attr_type=="radio" || $attr->attr_type=="checkboxes")
											{{--*/ $expVal = explode(',',$gdata[$attr->id]->assign_attr_val) /*--}}
												<select name="assign_attr_val[{{$cln}}][{{$attr->id}}][]" class="selectdrop" required="required" style="width:100%;" multiple="multiple">
													<option value=""> --Select-- </option>
													@if(!empty($optsArr))
														@foreach($optsArr[$attr->id] as $attropt)
														  <option value="{{$attropt->id}}" {{(in_array($attropt->id, $expVal))?'selected="selected"':''}} >{{$attropt->option_name}}</option>
														@endforeach
													@endif
												</select>
											@elseif($attr->attr_type=="file")
												<select name="assign_attr_val[{{$cln}}][{{$attr->id}}][]" class="selectimgsdrop js-example-templating" required="required" style="width:100%;">
													<option value=""> --Select-- </option>
													@if(!empty($optsArr))
														@foreach($optsArr[$attr->id] as $attropt)
														  <option value="{{$attropt->id}}" rel="{{$attropt->attr_img}}" {{($attropt->id==$gdata[$attr->id]->assign_attr_val)?'selected="selected"':''}}>{{$attropt->attr_img}}</option>
														@endforeach
													@endif
												</select>
											@elseif($attr->attr_type=="text")
												<input class="form-control" type="text" name="assign_attr_val[{{$cln}}][{{$attr->id}}]" value="{{(!empty($gdata))?$gdata[$attr->id]->assign_attr_val:(!empty($optsArr))?$optsArr[$attr->id][0]->text_value:''}}" />
											@elseif($attr->attr_type=="textarea")
												<textarea class="form-control" name="assign_attr_val[{{$cln}}][{{$attr->id}}]">{{(!empty($gdata))?$gdata[$attr->id]->assign_attr_val:(!empty($optsArr))?$optsArr[$attr->id][0]->text_value:''}}</textarea>
											
											@else
											@endif
										</div>
									@endforeach
									<div class="col-md-2 butt">
										<br>
										@if(count($groupdata)==$cln)
											<button type="button" onclick="addGroup('{{$cln}}')" class="btn btn-success MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add More" id="add" data-original-title="Add more">
												<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
											</button>
										@else
											<button type="button" onclick="removeGroup('{{$cln}}')" class="btn btn-danger MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Remove" data-original-title="Remove">
												<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> 
											</button>
										@endif
									</div>
								   @endif
								   </div>
								@endforeach
							@else
								{{--*/ $cln = 1 /*--}}
								<div class="form-group clone1" >
								  @if(!empty($AttrArr))
									@foreach($AttrArr as $attr)
									<div class="col-md-2">
										{{$attr->attr_title}}
											<input type="hidden" name="assign_attr_id[1][]" value="{{$attr->id}}" />
											<input type="hidden" name="assign_attr_type[1][]" value="{{$attr->attr_type}}" />
											<input type="hidden" name="edit_assign_attr_id[1][]" value="" />
										<br>
											@if($attr->attr_type=="dropdown" || $attr->attr_type=="radio" || $attr->attr_type=="checkboxes")
												<select name="assign_attr_val[1][{{$attr->id}}][]" class="selectdrop" required="required" style="width:100%;" multiple="multiple">
													<option value=""> --Select-- </option>
													@if(!empty($optsArr))
														@foreach($optsArr[$attr->id] as $attropt)
														  <option value="{{$attropt->id}}">{{$attropt->option_name}}</option>
														@endforeach
													@endif
												</select>
											@elseif($attr->attr_type=="file")
												<select name="assign_attr_val[1][{{$attr->id}}][]" class="selectimgsdrop js-example-templating" required="required" style="width:100%;">
													<option value=""> --Select-- </option>
													@if(!empty($optsArr))
														@foreach($optsArr[$attr->id] as $attropt)
														  <option value="{{$attropt->id}}" rel="{{$attropt->attr_img}}">{{$attropt->attr_img}}</option>
														@endforeach
													@endif
												</select>
											@elseif($attr->attr_type=="text")
												<input class="form-control" type="text" name="assign_attr_val[1][{{$attr->id}}]" value="{{(!empty($optsArr))?$optsArr[$attr->id][0]->text_value:''}}" />
											@elseif($attr->attr_type=="textarea")
												<textarea class="form-control" name="assign_attr_val[1][{{$attr->id}}]">{{(!empty($optsArr))?$optsArr[$attr->id][0]->text_value:""}}</textarea>
											
											@else
											@endif
										</div>
									@endforeach
									<div class="col-md-2 butt">
										<br>
										<button type="button" onclick="addGroup(1)" class="btn btn-success MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add More" id="add" data-original-title="Add more"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
									</div>
								   @endif
								   </div>
							@endif
							<input type="hidden" name="tot_group" id="tot_group" value="{{$cln}}" />
						 </fieldset>
			</div>
			
			
			<div style="clear:both"></div>	
						
			<div class="form-group">
				<label class="col-sm-4 text-right">&nbsp;</label>
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
		
		$(".js-example-templating").select2({
		  templateResult: formatState,
		  templateSelection: formatState
		});
	});
	
	function formatState (state) {
	  if (!state.id) { return state.text; }
	  var $state = $(
		'<span><img src="<?php URL::to('uploads/attributes_imgs'); ?>/' + state.text + '" class="img-flag" /> ' + state.text + '</span>'
	  );
	  return $state;
	}
	
	function addGroup(id)
	{
		if(id!="")
		{
			$('.clone'+id+' .butt button').remove();
			var remBut = '<button type="button" onclick="removeGroup('+id+')" class="btn btn-danger MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Remove" data-original-title="Remove"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> </button>';
			$('.clone'+id+' .butt').append(remBut);
			var newid = parseInt(id) + 1;
			var html = '';
			html += '<div class="form-group clone'+newid+'">';
			<?php if(!empty($AttrArr)) {
			foreach($AttrArr as $attr2) { ?>
			html += '<div class="col-md-2">{{$attr2->attr_title}}<input type="hidden" name="assign_attr_id['+newid+'][]" value="{{$attr2->id}}" />	<input type="hidden" name="assign_attr_type['+newid+'][]" value="{{$attr2->attr_type}}" /><input type="hidden" name="edit_assign_attr_id['+newid+'][]" value="" /><br>';
			<?php if($attr2->attr_type=="dropdown" || $attr2->attr_type=="radio" || $attr2->attr_type=="checkboxes") { ?>
			html += '<select name="assign_attr_val['+newid+'][{{$attr2->id}}][]" class="selectdrop" required="required" style="width:100%;" multiple="multiple"><option value=""> --Select-- </option>';
			<?php if(!empty($optsArr)) {
					foreach($optsArr[$attr2->id] as $attropt) { ?>
						html += '<option value="{{$attropt->id}}">{{$attropt->option_name}}</option>';
			<?php } } ?>
			html += '</select>';
			<?php } elseif($attr2->attr_type=="file") { ?>
			html += '<select name="assign_attr_val['+newid+'][{{$attr2->id}}][]" class="selectimgsdrop js-example-templating" required="required" style="width:100%;"><option value=""> --Select-- </option>';
			<?php if(!empty($optsArr)) {
					foreach($optsArr[$attr2->id] as $attropt) { ?>
						html += '<option value="{{$attropt->id}}" rel="{{$attropt->attr_img}}">{{$attropt->attr_img}}</option>';
			<?php } } ?>
			html += '</select>';
			<?php } elseif($attr2->attr_type=="text") { ?>
			html += '<input class="form-control" type="text" name="assign_attr_val['+newid+'][{{$attr2->id}}]" value="{{(!empty($optsArr))?$optsArr[$attr2->id][0]->text_value:''}}" />';
			<?php } elseif($attr2->attr_type=="textarea") { ?>
			html += '<textarea class="form-control" name="assign_attr_val['+newid+'][{{$attr2->id}}]">{{(!empty($optsArr))?$optsArr[$attr2->id][0]->text_value:""}}</textarea>';
			<?php } else {} ?>
			html += '</div>';
			<?php } } ?>
			
			html += '<div class="col-md-2 butt">';
			html += '<br><button type="button" onclick="addGroup('+newid+')" class="btn btn-success MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add More" id="add" data-original-title="Add more"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>';
			html += '</div>';
			html += '</div>';
			$('.clone'+id).after(html);
			var totgroup = $('#tot_group').val();
			$('#tot_group').val(parseInt(totgroup) + 1);
			$(".clone"+newid+" .selectdrop").select2();
		
			$(".clone"+newid+" .js-example-templating").select2({
			  templateResult: formatState,
			  templateSelection: formatState
			});
		}
	}
	
	function removeGroup(id)
	{
		if(id!="")
		{
			$('.clone'+id).remove();
		}
	}
	
	</script>		 
@stop