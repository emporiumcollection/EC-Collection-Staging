@extends('layouts.app')

@section('content')
<style>
.leng { display:none; }
.sf-viewport { margin-bottom:60px !important; }
</style>
<!-- Step Form Wizard plugin -->
<link rel="stylesheet" href="{{ asset('sximo/css/frontend_templete/step-form-wizard/css/step-form-wizard-all.css')}}" type="text/css" media="screen, projection">
<script src="{{ asset('sximo/js/frontend_templete/step-form-wizard/js/step-form-wizard.js')}}"></script>
<script>
        $(document).ready(function () {
            $("#wizard_example").stepFormWizard({
                theme: 'circle' // sea, sky, simple, circle, sun
            });
        })
        $(window).load(function () {
            /* only if you want use mcustom scrollbar */
            $(".sf-step").mCustomScrollbar({
                theme: "dark-3",
                scrollButtons: {
                    enable: true
                }
            });
        });
    </script>
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('postarticle?return='.$return) }}">{{ $pageTitle }}</a></li>
        <li class="active">{{ Lang::get('core.addedit') }} </li>
      </ul>
	  	  
    </div>
 
 	<div class="page-content-wrapper">

		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
<div class="sbox animated">
	<div class="sbox-title"> <h4> <i class="fa fa-table"></i> <span style="float:right;"> <a href="#" onclick="change_lang('dutch');">Deutsch</a> || <a href="#" onclick="change_lang('eng');">English</a></span> </h4></div>
	<div class="sbox-content"> 	
		 {!! Form::open(array('url'=>'postarticle/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ', 'id' => 'wizard_example')) !!}
			<div class="col-md-12">
				<fieldset>
					<legend>Basic information</legend>
					<div class="form-group hidethis " style="display:none;">
						<label for="Id" class=" control-label col-md-2 text-left"> Id </label>
						<div class="col-md-8">
							{!! Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					</div> 					
					<div class="form-group  " >
						<label for="Category" class=" control-label col-md-2 text-left"> Category <span class="asterix"> * </span></label>
						<div class="col-md-8">
						  <select name='cat_id' rows='5' id='cat_id' class='select2 ' required  ></select> 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					</div> 

					<div class="form-group  " >
						<label for="Featured Image" class=" control-label col-md-2 text-left"> Featured Image <span class="asterix"> * </span></label>
						<div class="col-md-8">
							<input  type='file' name='featured_image' id='featured_image' @if($row['featured_image'] =='') class='required' @endif style='width:150px !important;'  />
							<small> ( bitte beachten die Bilder soll 900 by 570 haben ) </small>
							<div >
							{!! SiteHelpers::showUploadedFile($row['featured_image'],'/uploads/article_imgs/') !!}
							
							</div>
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					</div>
					
					<div class="form-group  " >
						<label for="Title Position 1" class=" control-label col-md-2 text-left"> Title Position 1 <span class="asterix"> * </span></label>
						<div class="col-md-8">
						  {!! Form::text('title_pos_1', $row['title_pos_1'],array('class'=>'form-control ldutch', 'placeholder'=>'', 'required'=>'true'  )) !!} 
						  
						  {!! Form::text('title_pos_1_eng', $row['title_pos_1_eng'],array('class'=>'form-control leng', 'placeholder'=>''  )) !!}
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					</div> 					
					<div class="form-group  " >
						<label for="Description Position 1" class=" control-label col-md-2 text-left"> Description Position 1 <span class="asterix"> * </span></label>
						<div class="col-md-8 ldutch">
						  <textarea name='description_pos_1' rows='5' id='description_pos_1' class='form-control editor'  
			 required  >{{ $row['description_pos_1'] }}</textarea> 
						</div>
						<div class="col-md-8 leng">
						 <textarea name='description_pos_1_eng' rows='5' id='description_pos_1_eng' class='form-control editor'  
			   >{{ $row['description_pos_1_eng'] }}</textarea>
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					</div>
				</fieldset>
				<fieldset>
					<legend>Upload Images</legend>
					<div class="col-md-12">
						<div class="form-group image" >
							<label for="Image Position 1" class=" control-label col-md-2 text-left"> Image Position 1 </label>
							<div class="col-md-4">
								<input  type='file' name='image_pos_1' id='image_pos_1' @if($row['image_pos_1'] =='') class='required' @endif style='width:150px !important;'  />
								<small> ( Image size 1500 by 1000  ) </small>
								<div >
								{!! SiteHelpers::showUploadedFile($row['image_pos_1'],'/uploads/article_imgs/') !!}
								
								</div>
							 </div> 
							 <div class="col-md-4">
								<a href="#" data-toggle="modal" data-target="#openContainer" onclick="sendmotId(1);">Choose from container</a>
								<input type="hidden" name="container_image_pos_1" id="box1" value="">
								<span id="boxspan1"></span>
							 </div> 
							 
						</div>
						
						<div class="form-group image " >
							<label for="Image Position 2" class=" control-label col-md-2 text-left"> Image Position 2 </label>
							<div class="col-md-4">
								<input  type='file' name='image_pos_2' id='image_pos_2' @if($row['image_pos_2'] =='') class='required' @endif style='width:150px !important;'  />
								<small> ( Image size 1500 by 1000  ) </small>
								<div >
								{!! SiteHelpers::showUploadedFile($row['image_pos_2'],'/uploads/article_imgs/') !!}
								
								</div>
							</div> 
							<div class="col-md-4">
								<a href="#" data-toggle="modal" data-target="#openContainer" onclick="sendmotId(2);">Choose from container</a>
								<input type="hidden" name="container_image_pos_2" id="box2" value="">
								<span id="boxspan2"></span>
							 </div> 
							
						</div> 					
						<div class="form-group image " >
							<label for="Image Position 3" class=" control-label col-md-2 text-left"> Image Position 3 </label>
							<div class="col-md-4">
								<input  type='file' name='image_pos_3' id='image_pos_3' @if($row['image_pos_3'] =='') class='required' @endif style='width:150px !important;'  />
								<small> ( Image size 1500 by 1000  ) </small>
								<div >
								{!! SiteHelpers::showUploadedFile($row['image_pos_3'],'/uploads/article_imgs/') !!}
								
								</div>
							 </div>
							 <div class="col-md-4">
								<a href="#" data-toggle="modal" data-target="#openContainer" onclick="sendmotId(3);">Choose from container</a>
								<input type="hidden" name="container_image_pos_3" id="box3" value="">
								<span id="boxspan3"></span>
							 </div>
							 
						</div> 
						
						<div class="form-group image " >
							<label for="Image Position 4" class=" control-label col-md-2 text-left"> Image Position 4 </label>
							<div class="col-md-4">
								<input  type='file' name='image_pos_4' id='image_pos_4' @if($row['image_pos_4'] =='') class='required' @endif style='width:150px !important;'  />
								<small> ( Image size 1500 by 1000  ) </small>
								<div>
								{!! SiteHelpers::showUploadedFile($row['image_pos_4'],'/uploads/article_imgs/') !!}
								
								</div>
							 </div>
							<div class="col-md-4">
								<a href="#" data-toggle="modal" data-target="#openContainer" onclick="sendmotId(4);">Choose from container</a>
								<input type="hidden" name="container_image_pos_4" id="box4" value="">
								<span id="boxspan4"></span>
							 </div> 
							 
						</div> 					
						<div class="form-group image " >
							<label for="Image Position 5" class=" control-label col-md-2 text-left"> Image Position 5 </label>
							<div class="col-md-4">
								<input  type='file' name='image_pos_5' id='image_pos_5' @if($row['image_pos_5'] =='') class='required' @endif style='width:150px !important;'  />
								<small> ( Image size 1500 by 1000  ) </small>
								<div >
								{!! SiteHelpers::showUploadedFile($row['image_pos_5'],'/uploads/article_imgs/') !!}
								
								</div>
							</div> 
							<div class="col-md-4">
								<a href="#" data-toggle="modal" data-target="#openContainer" onclick="sendmotId(5);">Choose from container</a>
								<input type="hidden" name="container_image_pos_5" id="box5" value="">
								<span id="boxspan5"></span>
							 </div>
							
							
						</div> 					
						<div class="form-group image " >
							<label for="Image Position 6" class=" control-label col-md-2 text-left"> Image Position 6 </label>
							<div class="col-md-4">
								<input  type='file' name='image_pos_6' id='image_pos_6' @if($row['image_pos_6'] =='') class='required' @endif style='width:150px !important;'  />
								<small> ( Image size 1500 by 1000  ) </small>
								<div >
								{!! SiteHelpers::showUploadedFile($row['image_pos_6'],'/uploads/article_imgs/') !!}
								
								</div>
							 </div> 
							 <div class="col-md-4">
								<a href="#" data-toggle="modal" data-target="#openContainer" onclick="sendmotId(6);">Choose from container</a>
								<input type="hidden" name="container_image_pos_6" id="box6" value="">
								<span id="boxspan6"></span>
							 </div> 
							 
						</div>
					</div>
				</fieldset>
				<fieldset>
					<legend>Final step</legend>
					<div class="form-group image " >
						<label for="Title Detail 1" class=" control-label col-md-2 text-left"> Title Detail 1 <span class="asterix"> * </span></label>
						<div class="col-md-8">
						  {!! Form::text('title_detail_1', $row['title_detail_1'],array('class'=>'form-control ldutch', 'placeholder'=>''  )) !!} 
						  
						  {!! Form::text('title_detail_1_eng', $row['title_detail_1_eng'],array('class'=>'form-control leng', 'placeholder'=>''  )) !!}
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					</div> 					
					<div class="form-group image">
						<label for="Description Detail 1" class=" control-label col-md-2 text-left"> Description Detail 1 <span class="asterix"> * </span></label>
						<div class="col-md-8 ldutch">
						  <textarea name='description_detail_1' rows='5' id='description_detail_1' class='form-control editor'  
			  >{{ $row['description_detail_1'] }}</textarea> 
						</div>
						<div class="col-md-8 leng">
						<textarea name='description_detail_1_eng' rows='5' id='description_detail_1_eng' class='form-control editor'  
			   >{{ $row['description_detail_1_eng'] }}</textarea> 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					</div>
					<div class="form-group  image" >
						<label for="Description Position 3" class=" control-label col-md-2 text-left"> Description Position 3 </label>
						<div class="col-md-8 ldutch">
						  <textarea name='description_pos_3' rows='5' id='description_pos_3' class='form-control editor' >{{ $row['description_pos_3'] }}</textarea> 
						</div>
						<div class="col-md-8 leng">
						  <textarea name='description_pos_3_eng' rows='5' id='description_pos_3_eng' class='form-control editor' >{{ $row['description_pos_3_eng'] }}</textarea>
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					</div> 
					
					<div class="form-group image" >
						<label for="Image Description 1" class=" control-label col-md-2 text-left"> Image Description 1 </label>
						<div class="col-md-4">
							<input  type='file' name='image_pos_7' id='image_pos_7' @if($row['image_pos_7'] =='') class='required' @endif style='width:150px !important;'  />
							<small> ( Image size 900 by 570  ) </small>
							<div >
							{!! SiteHelpers::showUploadedFile($row['image_pos_7'],'/uploads/article_imgs/') !!}
							
							</div>
						 </div> 
						 <div class="col-md-4">
							<a href="#" data-toggle="modal" data-target="#openContainer" onclick="sendmotId(7);">Choose from container</a>
							<input type="hidden" name="container_image_pos_7" id="box7" value="">
							<span id="boxspan7"></span>
						 </div> 
						 
					</div>
					
					<div class="form-group image " >
						<label for="Image Description 2" class=" control-label col-md-2 text-left"> Image Description 2 </label>
						<div class="col-md-4">
							<input  type='file' name='image_pos_8' id='image_pos_8' @if($row['image_pos_8'] =='') class='required' @endif style='width:150px !important;'  />
							<small> ( Image size 900 by 570  ) </small>
							<div >
							{!! SiteHelpers::showUploadedFile($row['image_pos_8'],'/uploads/article_imgs/') !!}
							
							</div>
						</div> 
						<div class="col-md-4">
							<a href="#" data-toggle="modal" data-target="#openContainer" onclick="sendmotId(8);">Choose from container</a>
							<input type="hidden" name="container_image_pos_8" id="box8" value="">
							<span id="boxspan8"></span>
						 </div> 
						
					</div> 					
					<div class="form-group image " >
						<label for="Image Description 3" class=" control-label col-md-2 text-left"> Image Description 3 </label>
						<div class="col-md-4">
							<input  type='file' name='image_pos_9' id='image_pos_9' @if($row['image_pos_9'] =='') class='required' @endif style='width:150px !important;'  />
							<div >
							{!! SiteHelpers::showUploadedFile($row['image_pos_9'],'/uploads/article_imgs/') !!}
							
							</div>
						 </div>
						 <div class="col-md-4">
							<a href="#" data-toggle="modal" data-target="#openContainer" onclick="sendmotId(9);">Choose from container</a>
							<input type="hidden" name="container_image_pos_9" id="box9" value="">
							<span id="boxspan9"></span>
						 </div>
						 
					</div> 
					
					<div class="form-group image " >
						<label for="Title Position 6" class=" control-label col-md-2 text-left"> Title Position 6 </label>
						<div class="col-md-8">
						  {!! Form::text('title_pos_6', $row['title_pos_6'],array('class'=>'form-control ldutch', 'placeholder'=>''   )) !!} 
						  
						  {!! Form::text('title_pos_6_eng', $row['title_pos_6_eng'],array('class'=>'form-control leng', 'placeholder'=>''   )) !!} 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					</div> 					
					<div class="form-group image " >
						<label for="Description Position 6" class=" control-label col-md-2 text-left"> Description Position 6 </label>
						<div class="col-md-8 ldutch">
						  <textarea name='description_pos_6' rows='5' id='description_pos_6' class='form-control editor'  
			   >{{ $row['description_pos_6'] }}</textarea>
						</div>
						<div class="col-md-8 leng">
							<textarea name='description_pos_6_eng' rows='5' id='description_pos_6_eng' class='form-control editor'  
			   >{{ $row['description_pos_6_eng'] }}</textarea>
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					</div>
					<div class="form-group  " >
						<label for="Position Number" class=" control-label col-md-2 text-left"> Position Number </label>
						<div class="col-md-8">
						  {!! Form::text('position_num', ($row['position_num']>0)?$row['position_num']:'',array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					</div>
					
					<div class="form-group exlink">
						<label for="External Link" class=" control-label col-md-2 text-left"> External Link </label>
						<div class="col-md-8">
						  {!! Form::text('external_link', $row['external_link'],array('class'=>'form-control external_link', 'placeholder'=>'',   )) !!} 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					</div>
					<div class="form-group  " >
						<label for="Status" class=" control-label col-md-2 text-left"> Status <span class="asterix"> * </span></label>
						<div class="col-md-8"> 
							<label class='radio radio-inline'>
							<input type='radio' name='status' value ='0' required @if($row['status'] == '0') checked="checked" @endif > Inactive </label>
							<label class='radio radio-inline'>
							<input type='radio' name='status' value ='1' required @if($row['status'] == '1') checked="checked" @endif > Active </label> 
						</div> 
						<div class="col-md-2">
							
						</div>
					</div> 					
					<div class="form-group  " >
						<label for="Publish Date" class=" control-label col-md-2 text-left"> Publish Date <span class="asterix"> * </span></label>
						<div class="col-md-8">  
							<div class="input-group m-b">
								{!! Form::text('publish_date', ($row['publish_date']!='')?$row['publish_date']: date('Y-m-d'),array('class'=>'form-control date','required'=>'true')) !!}
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div> 
						</div> 
						<div class="col-md-2">
							
						 </div>
					</div>
				</fieldset>
			</div>
		 {!! Form::close() !!}
	</div>
</div>		 
</div>	
</div>	

<!-- open container Modal -->
<div class="modal fade" id="openContainer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
	  <div class="modal-content">
		  <div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <h4 class="modal-title" id="myModalLabel">Select Image</h4>
		  </div>
		  <div class="modal-body">
			 <iframe id="iframe_id_123" src="{{URL::to('containeriframe').'/0/iframe'}}" style="height: 430px;width: 553px;border: none;"></iframe>
		  </div>
		  <div class="modal-footer">
			  <input type="hidden" name="boxid" id="boxid" value="">
			  <button type="button" class="btn btn-primary" onclick="selectimg();">ok</button>
			  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>

	  </div>
  </div>
</div>		 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		
		$("#cat_id").jCombo("{{ URL::to('postarticle/comboselect?filter=tb_news_categories:cat_id:cat_name') }}",
		{  selected_value : '{{ $row["cat_id"] }}' });
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});	
		
		var cat = "{{$row['cat_id']}}";
		//show_overviewimage(cat);
		
		$('input[type="radio"][id="displayupload"]').on('ifChecked', function(){
			$(".videotypeupload").show();
			$(".videotypelink").hide();
		});
		
		$('input[type="radio"][id="displaylink"]').on('ifChecked', function(){
			$(".videotypeupload").hide();
			$(".videotypelink").show();
		});
		
		if($('input[type="radio"][id="displayupload"]').is(":checked"))
		{
			$(".videotypeupload").show();
			$(".videotypelink").hide();
		}
		
		if($('input[type="radio"][id="displaylink"]').is(":checked"))
		{
			$(".videotypeupload").hide();
			$(".videotypelink").show();
		}
		
	});
	
	function sendmotId(boxid)
	{
		$('#boxid').val(boxid);
	}
	
	function selectimg(obj)
	{
		var bid = $('#boxid').val();
		var cat = $('#cat_id').val();
		var sList='';
		var sListid='';
		var highrespath='';
		sList = $(obj).attr('rel2');
		imgname = $(obj).attr('rel');
		imagepath = $(obj).attr('rel3');
		$('#box'+bid).val(imagepath);
		$('#boxspan'+bid).html(imgname);
		$('#openContainer').modal('hide');
	}
	
	function show_overviewimage(cat)
	{
		if(cat==15 || cat==16)
		{
			$('.raplecate').hide();
			$('.overviewpage').show();
			$('.overviewpage input').removeAttr('disabled');
			$('.video').hide();
			$('.image').show();
			$(".videotypeupload").hide();
			$(".videotypelink").hide();
			$('input[type="radio"][id="displaylink"]').iCheck('uncheck');
			$('input[type="radio"][id="displayupload"]').iCheck('uncheck');
		}
		else if(cat==18)
		{
			$('.raplecate').hide();
			$('.overviewpage').hide();
			$('.overviewpage input').attr('disabled','disabled');
			$('.video').show();
			$('.image').hide();
		}
		else
		{
			if(cat==7 || cat==8 || cat==9  || cat==19)
			{
				$('.raplecate').show();	
			}
			else
			{
				$('.raplecate').hide();
			}
			$('.overviewpage').hide();
			$('.overviewpage input').attr('disabled','disabled');
			$('.video').hide();
			$('.image').show();
			$(".videotypeupload").hide();
			$(".videotypelink").hide();
			$('input[type="radio"][id="displaylink"]').iCheck('uncheck');
			$('input[type="radio"][id="displayupload"]').iCheck('uncheck');
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