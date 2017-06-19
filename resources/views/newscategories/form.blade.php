@extends('layouts.app')

@section('content')
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
		<li><a href="{{ URL::to('newscategories?return='.$return) }}">{{ $pageTitle }}</a></li>
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
	<div class="sbox-title"> <h4> <i class="fa fa-table"></i> <span style="float:right;"> <a href="#" onclick="change_lang('dutch');">Deutsch</a> || <a href="#" onclick="change_lang('eng');">English</a></span></h4></div>
	<div class="sbox-content"> 	

		 {!! Form::open(array('url'=>'newscategories/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-12">
						<fieldset><legend> News Categories</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Cat Id" class=" control-label col-md-3 text-left"> Cat Id </label>
									<div class="col-md-7">
									  {!! Form::text('cat_id', $row['cat_id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Name" class=" control-label col-md-3 text-left"> Name <span class="asterix"> * </span></label>
									<div class="col-md-7">
									  {!! Form::text('cat_name', $row['cat_name'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 
									
								  <div class="form-group  " >
									<label for="Name" class=" control-label col-md-3 text-left"> Title <span class="asterix"> * </span></label>
									<div class="col-md-7">
									  {!! Form::text('cat_title', $row['cat_title'],array('class'=>'form-control ldutch', 'placeholder'=>'', 'required'=>'true' )) !!}

									  {!! Form::text('cat_title_eng', $row['cat_title_eng'],array('class'=>'form-control leng', 'placeholder'=>'' )) !!}
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
								  <div class="form-group  " >
									<label for="Name" class=" control-label col-md-3 text-left"> Description <span class="asterix"> * </span></label>
									<div class="col-md-7 ldutch">
									  <textarea name='cat_description' rows='5' id='editor' class='form-control editor '  
						 >{{ $row['cat_description'] }}</textarea>
									 </div>

									<div class="col-md-7 leng">
									  <textarea name='cat_description_eng' rows='5' id='editor' class='form-control editor '  
						 >{{ $row['cat_description_eng'] }}</textarea>
									 </div>
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
								  <div class="form-group  " >
									<label for="Status" class=" control-label col-md-3 text-left"> Status <span class="asterix"> * </span></label>
									<div class="col-md-7">
									  
					<label class='radio radio-inline'>
					<input type='radio' name='cat_status' value ='0' required @if($row['cat_status'] == '0') checked="checked" @endif > Inactive </label>
					<label class='radio radio-inline'>
					<input type='radio' name='cat_status' value ='1' required @if($row['cat_status'] == '1') checked="checked" @endif > Active </label> 
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
					<button type="button" onclick="location.href='{{ URL::to('newscategories?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
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