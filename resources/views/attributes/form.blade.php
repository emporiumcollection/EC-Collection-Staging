@extends('layouts.app')

@section('content')
<link href="{{ asset('sximo/css/custom_ps.css')}}" rel="stylesheet">
<style>
.leng { display:none; }
</style>
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
	<div class="sbox-title"> <h4> <i class="fa fa-table"></i>  <span style="float:right;"> <a href="#" onclick="change_lang('dutch');">Deutsch</a> || <a href="#" onclick="change_lang('eng');">English</a></span> </h4></div>
	<div class="sbox-content"> 	

		 {!! Form::open(array('url'=>'attributes/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-12">
						<fieldset><legend> Attributes</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
									<div class="col-md-6">
									  {!! Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								   					
								  <div class="form-group  " >
									<label for="Title" class=" control-label col-md-4 text-left"> Title <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  {!! Form::text('attr_title', $row['attr_title'],array('class'=>'form-control ldutch', 'placeholder'=>'', 'required'=>'true', 'id'=>'attr_title'  )) !!} 
									  
									  {!! Form::text('attr_title_eng', $row['attr_title_eng'],array('class'=>'form-control leng', 'placeholder'=>'', 'id'=>'attr_title_eng'  )) !!}
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for=" Description" class=" control-label col-md-4 text-left">  Description </label>
									<div class="col-md-6">
									  {!! Form::text('attr_desc', $row['attr_desc'],array('class'=>'form-control ldutch', 'placeholder'=>'',   )) !!}

									  {!! Form::text('attr_desc_eng', $row['attr_desc_eng'],array('class'=>'form-control leng', 'placeholder'=>'',   )) !!}
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 
									
								<div class="form-group  " >
									<label for="Type" class=" control-label col-md-4 text-left"> Category <span class="asterix"> * </span></label>
									<div class="col-md-6">
										<select name='attr_cat' id='attr_cat' class="form-control" required > 
											<option value="">-Select-</option>
											<option value="Size" <?php echo ($row['attr_cat'] == 'Size' ? " selected='selected' " : '' ); ?>>Size</option>
											<option value="Material" <?php echo ($row['attr_cat'] == 'Material' ? " selected='selected' " : '' ); ?>>Material</option>
											<option value="Materialien" <?php echo ($row['attr_cat'] == 'Materialien' ? " selected='selected' " : '' ); ?>>Materialien</option>
											<option value="Materialien_additional" <?php echo ($row['attr_cat'] == 'Materialien_additional' ? " selected='selected' " : '' ); ?>>Materialien Additional</option>
										</select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								</div>
								
								<div class="form-group  " >
									<label for="Type" class=" control-label col-md-4 text-left"> Type <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  
									<?php $attr_type = explode(',',$row['attr_type']);
									$attr_type_opt = array( 'dropdown' => 'Drop Down' ,  'radio' => 'Radio Buttons' ,  'checkboxes' => 'Check Boxes' ,  'text' => 'Input Field' ,  'textarea' => 'Textarea' ,  'file' => 'File Upload' , 'tab' => 'Tab', 'group' => 'Group'); ?>
									<select name='attr_type' id='Atype' required  class='select2 ' onchange="customOptions(this.value);" > 
										<option value="">-Select-</option>
										<?php 
										foreach($attr_type_opt as $key=>$val)
										{
											echo "<option  value ='$key' ".($row['attr_type'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
										}						
										?></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
								  <?php $pd=1; ?>
								  @if(!empty($fetch_attr_opt))
									  <?php $tot = count($fetch_attr_opt); ?>
									  <div class="form-group" id="custmOpt">
										<label for=" Custom" class=" control-label col-md-4 text-left">  Custom Values <span class="asterix"> * </span></label>
										<div class="col-md-8">
											<div class="row attrf">
												@foreach($fetch_attr_opt as $attr_opt)
													@if($attr_opt->attr_type=='dropdown' || $attr_opt->attr_type=='radio' || $attr_opt->attr_type=='checkboxes')
														{{--*/ $clsd = 'col-md-4' /*--}}
														@if($row['attr_cat']=='Materialien' || $row['attr_cat']=='Materialien_additional')
															{{--*/ $clsd = 'col-md-3' /*--}}
														@endif
														<div class="clone{{$pd}}">
															<input type="hidden" name="edit_opt[]" value="{{$attr_opt->id}}">
															<div class="{{$clsd}}">
															  <input type="text" name="opt_values[]" value="{{$attr_opt->option_value}}" placeholder="Value" class="form-control ldutch">

															  <input type="text" name="opt_values_eng[]" value="{{$attr_opt->option_value_eng}}" placeholder="Value" class="form-control leng">
															</div>
															<div class="{{$clsd}}">
															  <input type="text" name="opt_name[]" value="{{$attr_opt->option_name}}" placeholder="Display Name" class="form-control ldutch">
															  
															   <input type="text" name="opt_name_eng[]" value="{{$attr_opt->option_name_eng}}" placeholder="Display Name" class="form-control leng">
															</div>
															@if($row['attr_cat']=='Materialien' || $row['attr_cat']=='Materialien_additional')
																<div class="col-md-4">
																	<input type="file" name="opt_imgs[]" class="form-control">
																	{!! SiteHelpers::showUploadedFile($attr_opt->attr_img,'/uploads/attributes_imgs/',50,50) !!}
																</div>
															@endif
															 <div class="col-md-2 butt">
																@if($tot==$pd)
																	<button type="button" onclick="addItem('{{$pd}}')" class="btn btn-success MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add More" id="add" data-original-title="Add more">
																		<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
																	</button>
																@else
																	<button type="button" onclick="removeItem('{{$pd}}', '{{$attr_opt->id}}')" class="btn btn-danger MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Remove" data-original-title="Remove">
																		<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> 
																	</button>
																@endif
															 </div>
														</div>
													@elseif($attr_opt->attr_type=='text')
														<div class="col-md-9">
															<input type="text" name="assigned_text" value="{{$attr_opt->text_value}}" class="form-control" required="required" />
														</div>
													@elseif($attr_opt->attr_type=='textarea')
														<div class="col-md-9">
															<textarea name="assigned_text" class="form-control" required="required"> {{$attr_opt->text_value}}</textarea>
														</div>
													@elseif($attr_opt->attr_type=='file')
														<div class="clone{{$pd}}">
															<div class="col-md-7">
																<input type="file" name="assigned_file[]" class="form-control" required="required" />
																<br>
																{!! SiteHelpers::showUploadedFile($attr_opt->attr_img,'/uploads/attributes_imgs/',80,80) !!}
															</div>
															<div class="col-md-2 butt">
																@if($tot==$pd)
																	<button type="button" onclick="addItem('{{$pd}}')" class="btn btn-success MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add More" id="add" data-original-title="Add more">
																		<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
																	</button>
																@else
																	<button type="button" onclick="removeItem('{{$pd}}', '{{$attr_opt->id}}')" class="btn btn-danger MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Remove" data-original-title="Remove">
																		<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> 
																	</button>
																@endif
															</div>
														</div>
													@endif
												<?php $pd++; ?>
												@endforeach
											</div>
										</div>
									  </div>
									@else
									  <div class="form-group" id="custmOpt" style="display:{{($row['attr_type']=='dropdown' || $row['attr_type']=='radio' || $row['attr_type']=='checkboxes')?'block':'none'}};">
										<label for=" Custom" class=" control-label col-md-4 text-left">  Custom Values <span class="asterix"> * </span></label>
										<div class="col-md-8">
											<div class="row attrf">
												&nbsp;
											</div>
										</div>
									  </div>
									@endif
								 
								  <div class="form-group  " >
									<label for="Status" class=" control-label col-md-4 text-left"> Status <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  
										<label class='radio radio-inline'>
										<input type='radio' name='attr_status' value ='1' required @if($row['attr_status'] == '1') checked="checked" @endif > Active </label>
										<label class='radio radio-inline'>
										<input type='radio' name='attr_status' value ='0' required @if($row['attr_status'] == '0') checked="checked" @endif > Inactive </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
								  
								  <div class="form-group  " >
									<label for="Status" class=" control-label col-md-4 text-left"> Permission <span class="asterix"> * </span></label>
									<div class="col-md-6">
										<label class='radio radio-inline'>
										<input type='radio' name='attr_permission' value ='1' required @if($row['attr_permission'] == '1') checked="checked" @endif > Public </label>
										<label class='radio radio-inline'>
										<input type='radio' name='attr_permission' value ='0' required @if($row['attr_permission'] == '0') checked="checked" @endif > Private </label> 
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
					<button type="button" onclick="location.href='{{ URL::to('attributes?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
					@if($row['attr_type']=="group")
						<button type="button" onclick="location.href='{{ URL::to('group_content/'.$row['id']) }}' " class="btn btn-info btn-sm "><i class="fa  fa-check-circle "></i>  {{ Lang::get('core.sb_edit_group') }} </button>
					@endif
					@if($row['attr_type']=="tab")
						<button type="button" onclick="location.href='{{ URL::to('edit_tab_content/'.$row['id'].'/1') }}' " class="btn btn-info btn-sm "><i class="fa  fa-check-circle "></i>  {{ Lang::get('core.sb_edit_tab') }} </button>
					@endif
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
		//$(".js-example-basic-single").select2();
	});
	
	function addItem(id)
	{
		if(id!="")
		{
			$('.clone'+id+' .butt button').remove();
			var remBut = '<button type="button" onclick="removeItem('+id+', 0)" class="btn btn-danger MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Remove" data-original-title="Remove"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> </button>';
			$('.clone'+id+' .butt').append(remBut);
			var newid = parseInt(id) + 1;
			var Atype = $('#Atype').val();
			var html = '';
			if(Atype=="file")
			{
				html += '<div class="clone'+newid+'">';
				html += '<input type="hidden" name="edit_opt[]" value="">';
				html += '<div class="col-md-7"><input type="file" name="assigned_file[]" class="form-control" required="required" /></div>';
			}
			else{
				var cat = $('#attr_cat').val();
				var cls = 'col-md-4';
				if(cat=='Materialien' || cat=='Materialien_additional')
				{
					cls = 'col-md-3';
				}
				html += '<div class="clone'+newid+'">';
				html += '<input type="hidden" name="edit_opt[]" value="">';
				html += '<div class="'+cls+'">';
				html += '<input type="text" name="opt_values[]" value="" placeholder="Value" class="form-control ldutch">';
				html += '<input type="text" name="opt_values_eng[]" value="" placeholder="Value" class="form-control leng">';
				html += '</div>';
				html += '<div class="'+cls+'">';
				html += '<input type="text" name="opt_name[]" value="" placeholder="Display Name" class="form-control ldutch">';
				html += '<input type="text" name="opt_name_eng[]" value="" placeholder="Display Name" class="form-control leng">';
				html += '</div>';
				if(cat=='Materialien' || cat=='Materialien_additional')
				{
					html += '<div class="col-md-4">';
					html += '<input type="file" name="opt_imgs[]" class="form-control">';
					html += '</div>';
				}
			}
			
			html += '<div class="col-md-2 butt">';
			html += '<button type="button" onclick="addItem('+newid+')" class="btn btn-success MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add More" id="add" data-original-title="Add more"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>';
			html += '</div>';
			html += '</div>';
			$('.clone'+id).after(html);
		}
	}
	
	function removeItem(id, attrOpt)
	{
		if(id!="")
		{
			if(attrOpt!="" && attrOpt>0)
			{
				var conf = confirm('Are you sure you want to delete this option?');
				if(conf==true)
				{
					$.ajax({
					  url: "{{ URL::to('delete_attribute_option')}}",
					  type: "post",
					  data: "optId="+attrOpt,
					  success: function(data){
						if(data=='error')
						{
							alert('option not found');
						}
						else if(data=='success')
						{
							$('.clone'+id).remove();
						}
					  }
					});
				}
			}
			else{
				$('.clone'+id).remove();
			}
			
		}
		
	}
	
	function customOptions(objVal)
	{
		var str = '';
		if(objVal=='group' || objVal=='tab')
		{
			$('.attrf').html('');
			$('#custmOpt').hide();
		}
		else if(objVal!='')
		{
			if(objVal=='dropdown' || objVal=='radio' || objVal=='checkboxes')
			{
				var cat = $('#attr_cat').val();
				var cls = 'col-md-4';
				if(cat=='Materialien' || cat=='Materialien_additional')
				{
					cls = 'col-md-3';
				}
				
				str += '<div class="clone1">';
				str += '<input type="hidden" name="edit_opt[]" value="">';
				str += '<div class="'+cls+'">';
				str += '<input type="text" name="opt_values[]" value="" placeholder="Value" class="form-control ldutch">';
				str += '<input type="text" name="opt_values_eng[]" value="" placeholder="Value" class="form-control leng">';
				str += '</div>';
				str += '<div class="'+cls+'">';
				str += '<input type="text" name="opt_name[]" value="" placeholder="Display Name" class="form-control ldutch">';
				str += '<input type="text" name="opt_name_eng[]" value="" placeholder="Display Name" class="form-control leng">';
				str += '</div>';
				if(cat=='Materialien' || cat=='Materialien_additional')
				{
					str += '<div class="col-md-4">';
					str += '<input type="file" name="opt_imgs[]" class="form-control">';
					str += '</div>';
				}
				str += '<div class="col-md-2 butt">';
				str += '<button type="button" onclick="addItem(1)" class="btn btn-success MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add More" id="add" data-original-title="Add more"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>';
				str += '</div>';
				str += '</div>';
			}
			else if(objVal=='text')
			{
				str += '<div class="col-md-9"><input type="hidden" name="edit_opt" value=""><input type="text" name="assigned_text" value="" class="form-control" required="required" /></div>';
			}
			else if(objVal=='textarea')
			{
				str += '<div class="col-md-9"><input type="hidden" name="edit_opt" value=""><textarea name="assigned_text" class="form-control" required="required"></textarea></div>';
			}
			else if(objVal=='file')
			{
				str = '<div class="clone1">';
				str += '<input type="hidden" name="edit_opt[]" value="">';
				str += '<div class="col-md-7"><input type="file" name="assigned_file[]" class="form-control" required="required" /></div>';
				str += '<div class="col-md-2 butt">';
				str += '<button type="button" onclick="addItem(1)" class="btn btn-success MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add More" id="add" data-original-title="Add more"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>';
				str += '</div>';
				str += '</div>';
			}
			
			$('.attrf').html(str);
			$('#custmOpt').show();
			//$(".js-example-basic-single").select2();
		}
		else
		{
			$('.attrf').html('');
			$('#custmOpt').hide();
		}
	}
	
	function change_lang(lang)
	{
		if(lang=='dutch')
		{
			$('.ldutch').css('display', 'block');
			$('.leng').css('display', 'none');
		}
		else if(lang=='eng')
		{
			$('.ldutch').css('display', 'none');
			$('.leng').css('display', 'block');
		}
	}
	
	</script>		 
@stop