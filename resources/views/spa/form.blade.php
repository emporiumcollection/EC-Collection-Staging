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
			<li><a href="{{ URL::to('spa?return='.$return) }}">{{ $pageTitle }}</a></li>
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
			<div class="sbox-title"> <h4> <i class="fa fa-table"></i> {{($id)?'Edit':'Add'}} SPA<a href="{{url('spa')}}" class="tips btn btn-xs btn-default pull-right" title="" ><i class="fa fa-arrow-circle-left"></i>&nbsp;Zurück</a></h4></div>
			<div class="sbox-content">
				{!! Form::open(array('url'=>'spa/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
				{!! Form::hidden('id', $row['id']) !!}
				<div class="col-md-12">
					
					
					<div class="form-group  " >
						<label for="Title" class=" control-label col-md-4 text-left"> Title <span class="asterix"> * </span></label>
						<div class="col-md-6">
							{!! Form::text('title', $row['title'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!}
						</div>
						<div class="col-md-2">
							
						</div>
					</div>
					
					<div class="form-group  " >
						<label for="description" class=" control-label col-md-4 text-left"> Description <span class="asterix"> * </span></label>
						<div class="col-md-6">
							{!! Form::textarea('description', $row['description'], ['class' => 'form-control','size' => '30x5']) !!}


						</div>
						<div class="col-md-2">
							
						</div>
					</div>

					<div class="form-group  " >
						<label for="Url" class=" control-label col-md-4 text-left"> Website </label>
						<div class="col-md-6">
							{!! Form::text('website', $row['website'],array('class'=>'form-control', 'placeholder'=>'http://example.com',   )) !!}
						</div>
						<div class="col-md-2">
							
						</div>
					</div>
					<div class="form-group  " >
						<label for="Url" class=" control-label col-md-4 text-left"> Reservation Email </label>
						<div class="col-md-6">
							{!! Form::text('reservation_email', $row['reservation_email'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
						</div>
						<div class="col-md-2">
							
						</div>
					</div>
					<div class="form-group  " >
						<label for="Url" class=" control-label col-md-4 text-left"> Reservation Contact </label>
						<div class="col-md-6">
							{!! Form::text('reservation_contact', $row['reservation_contact'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
						</div>
						<div class="col-md-2">
							
						</div>
					</div>
					<div class="form-group  " >
						<label for="Category Id" class=" control-label col-md-4 text-left"> Category Id </label>
						<div class="col-md-6">
							<select name='category_id[]' id="category_id" rows='5'   class='select2 ' multiple="multiple"   >
								<option  value ="0">-- Select Category --</option>
								@foreach($categories as $val)
								<option  value ="{{$val->id}}" {{(isset($row['category_id']) && in_array($val->id,explode(',',$row['category_id']))) ? " selected='selected' " : '' }}>{{$val->category_name}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-2">
							
						</div>
					</div>
					
					<div class="form-group  " >
						<label for="Part of hotel" class=" control-label col-md-4 text-left"> Part of hotel </label>
						<div class="col-md-6">
							<input name="part_of_hotel" id="part_of_hotel" type="checkbox" class="form-control input-sm" value="1" {{($row['part_of_hotel'] == 1) ? " checked='checked' " : '' }}  /> 
						</div> 
						<div class="col-md-2">

						</div>
					</div> 
					
					<div class="form-group  " >
						<label for="Video Type" class=" control-label col-md-4 text-left"> Video Type </label>
						<div class="col-md-6">
							
							<label class='radio radio-inline'>
							<input type='radio' name='video_type' value ='upload'  @if($row['video_type'] == 'upload') checked="checked" @endif > Upload </label>
							<label class='radio radio-inline'>
							<input type='radio' name='video_type' value ='link'  @if($row['video_type'] == 'link') checked="checked" @endif > Link </label>
						</div>
						<div class="col-md-2">
							
						</div>
					</div>
					<div class="restaurant_videotypelink" style="display:none;" >
						<div class="form-group  " >
							<label for="Video Link Type" class=" control-label col-md-4 text-left"> Video Link Type </label>
							<div class="col-md-6">
								
								<label class='radio radio-inline'>
								<input type='radio' name='video_link_type' value ='youtube'  @if($row['video_link_type'] == 'youtube') checked="checked" @endif > Youtube </label>
								<label class='radio radio-inline'>
								<input type='radio' name='video_link_type' value ='vimeo'  @if($row['video_link_type'] == 'vimeo') checked="checked" @endif > Vimeo </label>
							</div>
							<div class="col-md-2">
								
							</div>
						</div>
						<div class="form-group  " >
							<label for="Video Link" class=" control-label col-md-4 text-left"> Video Link </label>
							<div class="col-md-6">
								{!! Form::text('video_link', $row['video_link'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
							</div>
							<div class="col-md-2">
								
							</div>
						</div>
					</div>
					<div class="form-group restaurant_videotypeupload" style="display:none;" >
						<label for="Video" class=" control-label col-md-4 text-left"> Video </label>
						<div class="col-md-6">
							<input  type='file' name='video' id='video' @if($row['video'] =='') class='required' @endif style='width:150px !important;'  />
							<div >
								{!! SiteHelpers::showUploadedFile($row['video'],'') !!}
								
							</div>
							
						</div>
						<div class="col-md-2">
							
						</div>
					</div>
					<div class="form-group  " >
						<label for="Designer" class=" control-label col-md-4 text-left"> Designer </label>
						<div class="col-md-6">
							<select name='designer[]' rows='5' id='restaurant_designer' class='select2 ' multiple="multiple"  >
								@if(!empty($designers))
								@foreach($designers as $designer)
								<option value="{{$designer->id}}" {{(isset($row['designer']) && in_array($designer->id,explode(',',$row['designer']))) ? " selected='selected' " : '' }}>{{$designer->designer_name}}</option>
								@endforeach
								@endif
							</select>
						</div>
						<div class="col-md-2">
							
						</div>
					</div>
					<div class="form-group  " >
						<label for="Url" class=" control-label col-md-4 text-left"> Url </label>
						<div class="col-md-6">
							{!! Form::text('url', $row['url'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
						</div>
						<div class="col-md-2">
							
						</div>
					</div>
					<div class="form-group  " >
						<label for="Spa location" class=" control-label col-md-4 text-left"> Spa Location </label>
						<div class="col-md-6">
							{!! Form::text('location', $row['location'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
						</div>
						<div class="col-md-2">
							
						</div>
					</div>

					<div class="form-group  " >
						<label for="SPA Usp Text" class=" control-label col-md-4 text-left"> SPA Usp Text </label>
						<div class="col-md-6">
							{!! Form::textarea('usp_text', $row['usp_text'], ['class' => 'form-control','size' => '30x5']) !!}

						</div>
						<div class="col-md-2">
							
						</div>
					</div>
					<div class="form-group  " >
						<label for="SPA Usp Person" class=" control-label col-md-4 text-left"> SPA Usp Person </label>
						<div class="col-md-6">
							{!! Form::textarea('usp_person',  $row['usp_text'], ['class' => 'form-control','size' => '30x5']) !!}
						</div>
						<div class="col-md-2">
							
						</div>
					</div>
					<div class="form-group  " >
						<label for="Manager Text" class=" control-label col-md-4 text-left"> Manager Text </label>
						<div class="col-md-6">

							{!! Form::textarea('manager_text', $row['manager_text'], ['class' => 'form-control','size' => '30x5']) !!}
						</div>
						<div class="col-md-2">
							
						</div>
					</div>
					<div class="form-group  " >
						<label for="Opening Hrs" class=" control-label col-md-4 text-left"> Opening Hrs </label>
						<div class="col-md-6">

							{!! Form::textarea('opening_hrs', $row['opening_hrs'], ['class' => 'form-control','size' => '30x5']) !!}

						</div>
						<div class="col-md-2">
							
						</div>
					</div>
					<div class="form-group  " >
						<label for="Phonenumber" class=" control-label col-md-4 text-left"> Phonenumber </label>
						<div class="col-md-6">
							{!! Form::text('phonenumber', $row['phonenumber'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
						</div>
						<div class="col-md-2">
							
						</div>
					</div>
					<div class="form-group  " >
						<label for="Meta Keyword" class=" control-label col-md-4 text-left"> Meta Keyword </label>
						<div class="col-md-6">
							{!! Form::text('meta_keyword', $row['meta_keyword'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
						</div>
						<div class="col-md-2">
							
						</div>
					</div>
					<div class="form-group  " >
						<label for="Meta Description" class=" control-label col-md-4 text-left"> Meta Description </label>
						<div class="col-md-6">

							{!!  Form::textarea('meta_description', $row['meta_description'], ['class' => 'form-control','size' => '30x5']) !!}
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
					<button type="button" onclick="location.href='{{ URL::to('spa?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
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
		//For choose video upload type
		$('input[type="radio"][name="video_type"]').on('ifChecked', function () {

if($(this).val()=='upload'){
	$(".restaurant_videotypeupload").show();
					$(".restaurant_videotypelink").hide();
}else{
					$(".restaurant_videotypeupload").hide();
					$(".restaurant_videotypelink").show();
				}
});

		
	});
</script>
@stop