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
		<li><a href="{{ URL::to('designerdetails?return='.$return) }}">{{ $pageTitle }}</a></li>
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

				{!! Form::open(array('url'=>'designerdetails/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
					<div class="col-md-12">
						<fieldset>
							<legend>Designer Details</legend>	
							<div class="form-group hidethis " style="display:none;">
								<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
								<div class="col-md-6">
									{!! Form::text('id', $id, array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
								</div> 
								<div class="col-md-2">
								
								</div>
							</div> 
							
							@if(!empty($assigned_products))
								<div id="container_sortable">	
									@foreach($assigned_products as $row)
										<div class="gallery-box ui-state-default">
											<div class="caption folder">
												<a href="#">{{strlen($row->name) > 8 ? substr($row->name,0,8)."~" : $row->name}}</a>
											</div>
											
											<?php $folderPic = ($row->cover_img!='')? URL::to('uploads/folder_cover_imgs/thumb_'.$row->cover_img): URL::to('uploads/images/folder_big.png');
											
												$folderPicPopup = ($row->cover_img!='')? URL::to('uploads/folder_cover_imgs/format_'.$row->cover_img): URL::to('uploads/images/folder_big.png');
												
												$img_name = ($row->cover_img!='')? 'format_'.$row->cover_img: 'folder_big.png';
											?>
											
											<div class="thumb folder" style="background: url('{{ $folderPic }}') no-repeat  center center; background-size:100px auto;" >
												<a href="#" rel="{{$folderPicPopup}}" rel2="{{$img_name}}" title="{{$row->name}}" class="screenshot">&nbsp;</a>
											</div>
											<div class="info">
												<label><input type="checkbox" name="compont[]" id="compont" value="{{$row->id}}" class="no-border check-files ff" checked="checked"></label>
											</div>
										</div>
									@endforeach
								</div>
							@endif
						</fieldset>
					</div>
					<div style="clear:both"></div>	
					<div class="form-group">
						<label class="col-sm-4 text-right">&nbsp;</label>
						<div class="col-sm-8">	
							<button type="submit" name="apply" class="btn btn-info btn-sm" ><i class="fa  fa-check-circle"></i> {{ Lang::get('core.sb_apply') }}</button>
							<button type="submit" name="submit" class="btn btn-primary btn-sm" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
							<button type="button" onclick="location.href='{{ URL::to('containerslider?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
						</div>
					</div> 
		 
				{!! Form::close() !!}
			</div>
		</div>		 
	</div>	
</div>	
@stop