@extends('layouts.app')

@section('content')
<link href="{{ asset('sximo/css/custom_ps.css')}}" rel="stylesheet">
<script src="{{ asset('sximo/js/imapper/frontend/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset('sximo/js/imapper/frontend/jquery.image_mapper.min.js') }}"></script>
<script src="{{ asset('sximo/js/imapper/frontend/jquery.mousewheel.min.js') }}"></script>
<script src="{{ asset('sximo/js/imapper/frontend/jquery.mCustomScrollbar.min.js') }}"></script>
<script src="{{ asset('sximo/js/imapper/frontend/rollover.js') }}"></script>
<script src="{{ asset('sximo/js/imapper/frontend/jquery.prettyPhotos.js') }}"></script>

<link href="{{ asset('sximo/css/imapper/style.css')}}" rel="stylesheet">
<link href="{{ asset('sximo/css/imapper/frontend/image_mapper.css')}}" rel="stylesheet">
<link href="{{ asset('sximo/css/imapper/frontend/jquery.mCustomScrollbar.css')}}" rel="stylesheet">
<link href="{{ asset('sximo/css/imapper/frontend/prettyPhoto.css')}}" rel="stylesheet">


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
						<a class="btn btn-primary btn-lg" href="{{ URL::to('ifiles/edit/'.$rowFile->folder_id.'/'.$rowFile->id)}}"> Edit Image</a>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<h1>{{$rowFile->file_name}}</h1>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div id="thumbnail-container-2758299">
							<div id="imagemapper1-wrapper" class="imagemapper-wrapper"> 
							<?php $expFile = explode('.',$rowFile->file_name); 
								$imgclass = $expFile[1];
								$isImg = 0;
								if($expFile[1]=="jpg" || $expFile[1]=="png" || $expFile[1]=="gif" || $expFile[1]=="bmp" || $expFile[1]=="jpeg" || $expFile[1]=="JPG") { 
								//list($width, $height) = getimagesize($rowFile->imgsrc.$rowFile->file_name);
								//echo $width.$height; die;
							?>
								<img id="imapper1-map-image" src="{{$rowFile->imgsrc.$rowFile->file_name}}" alt="{{$rowFile->file_name}}" class="img-responsive">
							@if(!empty($findPin))
								<?php $p=1; ?>
								@foreach($findPin as $pins)
								<?php $left = (($pins->cor_left/$datas[0])*100)+10;
									  $top = (($pins->cor_top/$datas[1])*100)+10;
								?>
								<div id="imapper1-pin{{$p}}-wrapper" class="imapper1-pin-wrapper imapper-pin-wrapper" data-left="{{$left}}%" data-top="{{$top}}%" data-open-position="bottom" > 
									<img id="imapper1-pin{{$p}}" class="imapper1-pin" src="{{URL::to('sximo/images/imapper/icons/pin-2.png')}}">
									
									<div id="imapper1-pin{{$p}}-content-wrapper" class="imapper1-pin-content-wrapper imapper-content-wrapper" data-text-color="#545454" data-back-color="#ffffff" data-border-color="#fff" data-border-radius="0" data-width="270px" data-height="140px" data-font="Open Sans"> 
										<div id="imapper1-pin{{$p}}-content" class="imapper-content">
											<p class="imapper-content-header">{{$pins->title}}</p>
											<div class="imapper-content-text">
												{!!html_entity_decode($pins->pin_data)!!} 
											</div>
										</div>
									</div> 
								</div>
								<?php $p++; ?>
								@endforeach
							@endif
							</div>
							<?php } else { ?>
								<img id="imapper1-map-image" src="{{URL::to('uploads/images/').'/no_thumb.gif'}}" alt="{{$rowFile->file_name}}" class="img-responsive">
							<?php } ?>
						</div>
					</div>
					<div class="col-sm-6 fileinfo">
						<h5 class="info">File info</h5>
						<table class="keyvalue">
							<tbody>
								<tr>
									<td class="label">Type:</td>
									<td><?php $exp = explode('/',$rowFile->file_type); echo strtoupper($exp[1]).' '.$exp[0]?></td>
								</tr>
								<tr>
									<td class="label">Date:</td>
									<td>{{date("d-m-Y h:i", strtotime($rowFile->created))}}</td>
								</tr>
								<tr>
									<td class="label">Size:</td>
									<td><?php $sizeKb = ($rowFile->file_size/1024); echo round($sizeKb,2,PHP_ROUND_HALF_UP);?> KB</td>
								</tr>
								<tr>
									<td class="label">Folder:</td>
									<td><a href="{{ URL::to('folders/').'/'.$rowFile->folder_id }}">{{$rowFile->folderName}}</a></td>
								</tr>
								<tr>
									<td class="label">Uploaded by:</td>
									<td title="91.209.190.140 (konlinux5.konformit.com)">
										{{$rowFile->first_name.' '.$rowFile->last_name }}
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
$(function(){
	$('#imagemapper1-wrapper').imageMapper({
    itemOpenStyle: 'click',
    itemDesignStyle: 'responsive',
	pinScalingCoefficient:1,
    categories: true,
    mapOverlay: true
});
});
</script>
@stop