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
		<li><a href="{{ URL::to('pagesmanagement?return='.$return) }}">{{ $pageTitle }}</a></li>
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

		 {!! Form::open(array('url'=>'pagesmanagement/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-12">
						<fieldset><legend> Pages Management</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="PageID" class=" control-label col-md-4 text-left"> PageID </label>
									<div class="col-md-6">
									  {!! Form::text('pageID', $row['pageID'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Title" class=" control-label col-md-4 text-left"> Title <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  {!! Form::text('title', $row['title'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Content" class=" control-label col-md-4 text-left"> Content <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  <textarea name='content' rows='5' id='editor' class='form-control editor '  
						required >{{ $row['content'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Status" class=" control-label col-md-4 text-left"> Status </label>
									<div class="col-md-6">
									  
					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='1'  @if($row['status'] == '1') checked="checked" @endif > Enable </label>
					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='0'  @if($row['status'] == '0') checked="checked" @endif > disabled </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Access" class=" control-label col-md-4 text-left"> Access </label>
									<div class="col-md-6">
									  <textarea name='access' rows='5' id='access' class='form-control '  
				           >{{ $row['access'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Allow Guest" class=" control-label col-md-4 text-left"> Allow Guest </label>
									<div class="col-md-6">
									  <?php $allow_guest = explode(",",$row['allow_guest']); ?>
					 <label class='checked checkbox-inline'>   
					<input type='checkbox' name='allow_guest[]' value ='1'   class='' 
					@if(in_array('1',$allow_guest))checked @endif 
					 />  Allow Guest ? </label>  
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Template" class=" control-label col-md-4 text-left"> Template </label>
									<div class="col-md-6">
									  
					<label class='radio radio-inline'>
					<input type='radio' name='template' value ='frontend'  @if($row['template'] == 'frontend') checked="checked" @endif > Frontend </label>
					<label class='radio radio-inline'>
					<input type='radio' name='template' value ='backend'  @if($row['template'] == 'backend') checked="checked" @endif > Backend </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Metakey" class=" control-label col-md-4 text-left"> Metakey </label>
									<div class="col-md-6">
									  <textarea name='metakey' rows='5' id='metakey' class='form-control '  
				           >{{ $row['metakey'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Metadesc" class=" control-label col-md-4 text-left"> Metadesc </label>
									<div class="col-md-6">
									  <textarea name='metadesc' rows='5' id='metadesc' class='form-control '  
				           >{{ $row['metadesc'] }}</textarea> 
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
					<button type="button" onclick="location.href='{{ URL::to('pagesmanagement?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
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