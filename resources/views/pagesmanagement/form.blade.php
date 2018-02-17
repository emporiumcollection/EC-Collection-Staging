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

		 {!! Form::open(array('url'=>'pagesmanagement/save?return='.$return, 'class'=>'form-vertical row','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-sm-8 ">
				<div class="sbox">
					<div class="sbox-title">Page Content </div>	
					<div class="sbox-content">		

						<ul class="nav nav-tabs" >
						  <li class="active"><a href="#info" data-toggle="tab"> Page Content </a></li>
						  <li ><a href="#meta" data-toggle="tab"> Meta & Description </a></li>
						</ul>	

						<div class="tab-content">
						  <div class="tab-pane active m-t" id="info">
							<div class="form-group">
								<?php echo "Please use '<h5>text</h5>' for Headings, '<label>text</label>' for Sub-headings and '<p>text</p>' for Paragraphs in the page."; ?>
							 </div>
							  <div class="form-group  " >
								<div class="" style="background:#fff;">
								  <textarea name='content' rows='35' id='content'    class='form-control markItUp'  
									 >{{ htmlentities($row['content']) }}</textarea> 
								 </div> 
							  </div> 						  
							<div class="form-group">
								<?php echo "Please use '<h5>text</h5>' for Headings, '<label>text</label>' for Sub-headings and '<p>text</p>' for Paragraphs in the page."; ?>
							 </div>
						  </div>

						  <div class="tab-pane m-t" id="meta">

					  		<div class="form-group  " >
								<label class=""> Metakey </label>
								<div class="" style="background:#fff;">
								  <textarea name='metakey' rows='5' id='metakey' class='form-control markItUp'>{{ $row['metakey'] }}</textarea> 
								 </div> 
							  </div> 

				  			<div class="form-group  " >
								<label class=""> Meta Description </label>
								<div class="" style="background:#fff;">
								  <textarea name='metadesc' rows='10' id='metadesc' class='form-control markItUp'>{{ $row['metadesc'] }}</textarea> 
								 </div> 
							  </div> 							  						  

						  </div>

						</div>  
						
	
					 </div>
				</div>	
		 	</div>	
			
			<div class="col-sm-4 ">
			<div class="sbox">
				<div class="sbox-title">Page Info </div>	
				<div class="sbox-content">						
				  <div class="form-group hidethis " style="display:none;">
					<label for="ipt" class=""> PageID </label>
					
					  {!! Form::text('pageID', $row['pageID'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
					
				  </div> 					
				  <div class="form-group  " >
					<label for="ipt" > Title </label>
					
					  {!! Form::text('title', $row['title'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!} 
					
				  </div> 					
				 					
				 
				  <div class="form-group  " >
				  <label for="ipt"> Who can view this page ? </label>
					@foreach($groups as $group) 
					<label class="checkbox">					
					  <input  type='checkbox' name='group_id[{{ $group['id'] }}]'    value="{{ $group['id'] }}"
					  @if($group['access'] ==1 or $group['id'] ==1)
					  	checked
					  @endif				 
					   /> 
					  {{ $group['name'] }}
					</label>  
					@endforeach	
						  
				  </div> 
				  <div class="form-group  " >
					<label> Show for Guest ? unlogged  </label>
					<label class="checkbox"><input  type='checkbox' name='allow_guest' 
 						@if($row['allow_guest'] ==1 ) checked  @endif	
					   value="1"	/> Allow Guest ?  </lable>
				  </div>


				  <div class="form-group  " >
					<label> Status </label>
					<label class="radio">					
					  <input  type='radio' name='status'  value="1" required
					  @if( $row['status'] =='enable')  	checked	  @endif				  
					   /> 
					  Enable
					</label> 
					<label class="radio">					
					  <input  type='radio' name='status'  value="0" required
					   @if( $row['status'] =='disabled')  	checked	  @endif				  
					   /> 
					  Disabled
					</label> 					 
				  </div> 

				  <div class="form-group  " >
					<label> Template </label>
					<label class="radio">					
					  <input  type='radio' name='template'  value="frontend" required
					  @if( $row['template'] =='frontend')  	checked	  @endif				  
					   /> 
					  Frontend
					</label> 
					<label class="radio">					
					  <input  type='radio' name='template'  value="backend" required
					   @if( $row['template'] =='backend')  	checked	  @endif				  
					   /> 
					  Backend
					</label> 					 
				  </div> 				  
				  
			  <div class="form-group">
				
				<button type="submit" class="btn btn-primary ">  Submit </button>
				 
		
			  </div> 
			  </div>
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