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
		<li><a href="{{ URL::to('pagecontent?return='.$return) }}">{{ $pageTitle }}</a></li>
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
	<div class="sbox-title"> <h4> <i class="fa fa-table"></i> <span style="float:right;"> <a href="#" onclick="change_lang('dutch');">Deutsch</a> || <a href="#" onclick="change_lang('eng');">English</a></span> </h4></div>
	<div class="sbox-content"> 	

		 {!! Form::open(array('url'=>'pagecontent/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-12">
						<fieldset><legend> Page Content</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Id" class=" control-label col-md-2 text-left"> Id </label>
									<div class="col-md-8">
									  {!! Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Page Name" class=" control-label col-md-2 text-left"> Page Name <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  {!! Form::text('page_name', $row['page_name'],array('class'=>'form-control ldutch', 'placeholder'=>'', 'required'=>'true'  )) !!}

									  {!! Form::text('page_name_eng', $row['page_name_eng'],array('class'=>'form-control leng', 'placeholder'=>'' )) !!}
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Number of blocks" class=" control-label col-md-2 text-left"> Number of blocks <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  
					<?php $columns = explode(',',$row['columns']);
					$columns_opt = array( '1' => 'Block 1' ,  '2' => 'Block 2' ,  '3' => 'Block 3' , ); ?>
					<select name='columns' id='columns' rows='5' required  class='select2 ' onchange="showblocks(this.value);" > 
						<?php 
						foreach($columns_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['columns'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Block 1" class=" control-label col-md-2 text-left"> Block 1 </label>
									<div class="col-md-8 ldutch">
									  <textarea name='content_column_1' rows='5' id='editor' class='form-control editor '  
						 >{{ $row['content_column_1'] }}</textarea> 
									 </div> 
									 <div class="col-md-8 leng">
									  <textarea name='content_column_1_eng' rows='5' id='editor' class='form-control editor '  
						 >{{ $row['content_column_1_eng'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group" id="block2" style="display:none;" >
									<label for="Block 2" class=" control-label col-md-2 text-left"> Block 2 </label>
									<div class="col-md-8 ldutch">
									  <textarea name='content_column_2' rows='5' id='editor' class='form-control editor '  
						 >{{ $row['content_column_2'] }}</textarea> 
									 </div> 
									 <div class="col-md-8 leng">
									  <textarea name='content_column_2_eng' rows='5' id='editor' class='form-control editor '  
						 >{{ $row['content_column_2_eng'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group" id="block3" style="display:none;" >
									<label for="Block 3" class=" control-label col-md-2 text-left"> Block 3 </label>
									<div class="col-md-8 ldutch">
									  <textarea name='content_column_3' rows='5' id='editor' class='form-control editor '  
						 >{{ $row['content_column_3'] }}</textarea> 
									 </div> 
									 
									 <div class="col-md-8 leng">
									  <textarea name='content_column_3_eng' rows='5' id='editor' class='form-control editor '  
						 >{{ $row['content_column_3_eng'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Page Status" class=" control-label col-md-2 text-left"> Page Status <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  
									<label class='radio radio-inline'>
									<input type='radio' name='page_status' value ='0' required @if($row['page_status'] == '0') checked="checked" @endif > Inactive </label>
									<label class='radio radio-inline'>
									<input type='radio' name='page_status' value ='1' required @if($row['page_status'] == '1') checked="checked" @endif > Active </label> 
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
					<button type="button" onclick="location.href='{{ URL::to('pagecontent?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
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
		var blocks = $('#columns').val();
		showblocks(blocks);
	});
	
	function showblocks(blockno)
	{
		if(blockno==1)
		{
			$('#block2').hide();
			$('#block3').hide();
		}
		if(blockno==2)
		{
			$('#block2').show();
			$('#block3').hide();
		}
		if(blockno==3)
		{
			$('#block2').show();
			$('#block3').show();
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