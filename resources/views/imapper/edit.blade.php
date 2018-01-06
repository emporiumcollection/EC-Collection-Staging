@extends('layouts.app')

@section('content')

<link href="{{ asset('sximo/css/custom_ps.css')}}" rel="stylesheet">
<link href="{{ asset('sximo/css/jquery.cropbox.css')}}" rel="stylesheet">

<script type="text/javascript" src="{{ asset('sximo/js/hammer.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('sximo/js/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('sximo/js/jquery.cropbox.js') }}"></script>
<style>
	.hide-tag
	{
		display:none;
	}
	
	#new_pin
	{
		position:absolute !important;
		top:35px;
		left:20px;
	}
	
	#imapper1-map-image:hover {
		cursor: -webkit-grab;
	}
</style>
<div class="page-content row">
 <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>

      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}"> Dashboard </a></li>
        <li><a href="{{ URL::to('container') }}">{{ $pageTitle }}</a></li>
		<li class="active">view file</li>
      </ul>	  
    </div>
	
	<div class="page-content-wrapper m-t">	
		<div class="row">
			<div class="col-sm-3">	
				<div class="row">
					<div class="col-sm-12">
						<a href="{{ URL::to('imapper') }}" class="files label"><span>Files</span></a>
						<?php foreach ($tree as $r) {
							echo $r;
						} ?>
					</div>
				</div>
			</div>
			
			<div class="col-sm-9">
				<div class="row">
					<div class="col-sm-12">
						<a class="btn btn-primary btn-lg" href="{{ URL::to('ifolders/').'/'.$prevfolder }}"> Back to folder</a>
						<a class="btn btn-primary btn-lg" href="{{ URL::to('ifiles/view/'.$rowFile->folder_id.'/'.$rowFile->id)}}"> Back to original file</a>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10">
						<h1>{{$rowFile->file_name}}</h1>
					</div>
					<div class="col-md-2" style="padding-left:40px;">
						
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12" >
						<div id="droppable" class="ui-widget-header" style="margin-bottom:50px;">
							<button id="price" onclick="show_pin();">Create New Pin</button><br><br>
							<div style="overflow: hidden;display:inline-block;width:800px;height:700px;position: relative">
							<?php $expFile = explode('.',$rowFile->file_name); 
								$imgclass = $expFile[1];
								$isImg = 0;
								if($expFile[1]=="jpg" || $expFile[1]=="png" || $expFile[1]=="gif" || $expFile[1]=="bmp" || $expFile[1]=="jpeg" || $expFile[1]=="JPG") { 
							?>
								<img class="cropimage" id="imapper1-map-image" src="{{$rowFile->imgsrc.$rowFile->file_name}}" alt="{{$rowFile->file_name}}" cropwidth="800" cropheight="700" >
							
							<?php } else { ?>
								<img id="imapper1-map-image" src="{{URL::to('uploads/images/').'/no_thumb.gif'}}" alt="{{$rowFile->file_name}}" class="img-responsive">
							<?php } ?>
							@if(!empty($findPin))
								@foreach($findPin as $pins)
								<div class="ui-widget-content pinsz" id="pin_id_{{$pins->id}}" style="position: absolute; top: {{$pins->cor_top}}px; left: {{$pins->cor_left}}px;" rel="{{$pins->cor_left}}" rel2="{{$pins->cor_top}}"> 
									<img src="{{URL::to('sximo/images/imapper/icons/pin-2.png')}}" onclick="editData('{{$pins->id}}');" data-toggle="modal" data-target="#modelpin">
								</div>
								@endforeach
							@endif
						</div>	
						</div>
						<div id="new_pin" class="ui-widget-content hide-tag"><img src="{{URL::to('sximo/images/imapper/icons/pin-2.png')}}" data-toggle="modal" data-target="#modelpin" /></div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	
	<!-- Pin Modal -->
	<div class="modal fade" id="modelpin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Save Pin data:</h4>
		  </div>
		  {!! Form::open(array('url'=>'savepin', 'class'=>'columns' ,'id' =>'savepin', 'method'=>'post' )) !!}
			<input type="hidden" name="cor_top" id="cor_top" value="">
			<input type="hidden" name="cor_left" id="cor_left" value="">
			<input type="hidden" name="editpin" value="">
			<input type="hidden" name="file_id" value="{{$rowFile->id}}">
			<input type="hidden" name="curnurl" value="{{ Request::url() }}">
		  <div class="modal-body">
			<fieldset>
				<div class="field">
					<label>Title<em>*</em></label>
					<div class="field-input">
						<input type="text" name="title" required="required" />
					</div>
				</div>
				<div class="field">
					<label>Content<em>*</em></label>
					<div class="field-input">
						<textarea name="pindata" id="pindata" class="editor" cols="30" rows="10"></textarea>
					</div>
				</div>
			</fieldset>
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Save</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
<script type="text/javascript">
$(function(){
	$( "#new_pin" ).draggable();
    $( "#droppable" ).droppable({
      drop: function( event, ui ) {
		  var ty = $('#pintype').val();
		  var image = $("#new_pin");
         $('#cor_top').val(image.position().top);
		$('#cor_left').val(image.position().left);
      }
    });

	$( '.cropimage' ).each( function () {
		
	var image = $(this),

	cropwidth = image.attr('cropwidth'),

	cropheight = image.attr('cropheight'),

	results = image.next('.results' ),

	x = $('.cropX', results),

	y = $('.cropY', results),

	w = $('.cropW', results),

	h = $('.cropH', results),

	download = results.next('.download').find('a');

	 

	image.cropbox( {width: cropwidth, height: cropheight, showControls: 'auto' } )

	.on('cropbox', function( event, results, img ) {

	x.text( results.cropX );

	y.text( results.cropY );

	w.text( results.cropW );

	h.text( results.cropH );

	//download.attr('href', img.getDataURL());

	});

	});

});

function show_pin()
{
	$('#new_pin').show();
	var image = $("#new_pin");
	$('#cor_top').val(image.position().top);
	$('#cor_left').val(image.position().left);
}

function editData(pinId)
{
	console.log('enter pin');
}
</script>
@stop