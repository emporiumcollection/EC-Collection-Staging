@extends('layouts.app')
@section('content')
<link href="{{ asset('sximo/css/custom_ps.css')}}" rel="stylesheet">
<script src="{{ asset('sximo/js/dropzone.js') }}"></script>
<link rel="stylesheet" href="{{ asset('sximo/css/dropzone.css') }}">
<script src="{{ asset('sximo/js/tooltip_popup.js') }}"></script>
<link rel="stylesheet" href="{{ asset('sximo/js/plugins/fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5') }}">
<script src="{{ asset('sximo/js/plugins/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5') }}"></script>
<style>
.leng { display:none; }
.btn_orange, .btn_orange:hover, .btn_orange:focus, .btn_orange:active, .btn_orange.active, .open .dropdown-toggle.btn_orange {  background-color: orange; border-color: orange; }

</style>
<?php $imgfancy = array();
	$filType = array('jpg'=>'JPEG image', 'jpeg'=>'JPEG image', 'JPG'=>'JPEG image', 'png'=>'PNG image', 'gif'=>'GIF image', 'xls'=>'Excel spreadsheet', 'eps'=>'EPS Image', 'mp4'=>'MPEG-4 video', 'mkv'=>'Matroska Video', 'flv'=>'Flash Video', 'avi'=>'Audio Video', 'wma'=>'Windows Media Audio', 'wmp'=>'Windows Media Player', 'psd'=>'PSD Image', 'pdf'=>'PDF document', 'ppt'=>'PowerPoint presentation', 'mp3'=>'MP3 audio', 'tif'=>'TIFF image', 'doc'=>'Word document', 'docx'=>'Word document', 'bmp'=>'Bitmap image', 'cad'=>'CAD image', 'zip'=>'Compress document');
 ?>
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>

      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}"> Dashboard </a></li>
        <li class="active">{{ $pageTitle }}</li>
      </ul>	  
	  
    </div>

    <div class="page-content-wrapper m-t" style="padding-bottom:50px;">	
		<div class="row">
			<div class="col-sm-3">	
				<div class="row">
					<div class="col-sm-12">
						<a href="{{ URL::to('container?show='.$showType) }}" class="files label"><span>Files</span></a>
						<div data-load="left-side-tree"><p style="padding-top: 20px;">Loading...</p></div>
					</div>
				</div>
			</div>
			
			<div class="col-sm-9" id="folders_data_list">
				<p style="padding-top: 30px; text-align: center;">Loading...</p>
			</div>
		</div>
    </div>
<div id="showallmodals"> </div>

<!-- New File Modal -->
	<div class="modal fade" id="newFile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title" id="myModalLabel">Upload new file</h4>
		  </div>
		  {!! Form::open(array('url'=>'addfile', 'class'=>'columns' ,'id' =>'file_new', 'method'=>'post', 'files'=>true )) !!}
		  <input type="hidden" name="fold_id" id="uploadfile_fold_id" value="{{$fid}}">
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
		  <input type="hidden" name="administrator_id" id="administrator_id" value="@if(!empty($foldername)){{ $foldername->user_id }}@endif">
		  <div class="modal-body">
			<fieldset>
				<div class="field">
					<label>Select Files <em>*</em></label>
				</div>
				 <div class="dropzone" id="dropzoneFileUpload"> </div>
			</fieldset>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" onclick="containerdropreload();">Save & Continue</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<script>
		//Load folders and folder tree by Ajax
		function loadLeftSideTree(){
			$.ajax({
				url: '{{url("getFolderListAjaxonload/")}}/{{(isset($fid) && $fid!="")?$fid:0}}?show={{(isset($_GET["show"]))?$_GET["show"]:""}}',
				type: "get",
				dataType: "html",
				success: function(data){
					$('[data-load="left-side-tree"]').hide();
					$('[data-load="left-side-tree"]').fadeIn('slow');
					$('[data-load="left-side-tree"]').html(data);
				}
			});


			$.ajax({
					url: '{{url("getFoldersAjax/")}}/{{(isset($fid) && $fid!="")?$fid:0}}?show={{(isset($_GET["show"]))?$_GET["show"]:""}}',
					type: "get",
					dataType: "html",
					success: function(data){
						$('#folders_data_list').hide();
						$('#folders_data_list').html(data);
						$('#folders_data_list').fadeIn('slow');
						$('#folders_data_list').find('input[type=checkbox]').iCheck({checkboxClass: 'icheckbox_square-green'});
						$('#breadcrumb_line').html($('#folders_data_list').find('#get-breadcrumb').html());
						$('#showallmodals').html($('#folders_data_list').find('#allmodal').html());
						$('#allmodal').html('');
						if({{$fid}}>0) { $('[data-target="#Directorypermission"]').removeAttr('disabled');  $('.upbtn').removeAttr('disabled'); $('input[name="fold_id"]').val('{{$fid}}'); localStorage.setItem('fold_id','{{$fid}}'); $('input[name="curnurl"]').val('{{URL::to("folders")}}/{{$fid}}?show={{$showType}}'); }
						screenshotPreview();
						screenshotPreviewimg();
						screenshotPreviewimgclick();
						screenshotPreviewmaterialimg();
					}
				});
		}
		$(document).ready(function(){
			
			var baseUrl = "{{ url::to('addfile') }}";
            var token = "{{ Session::getToken() }}";
            Dropzone.autoDiscover = false;
             var myDropzone = new Dropzone("div#dropzoneFileUpload", {
                url: baseUrl,
                params: {
                    _token: token,
					fold_id: localStorage.getItem('fold_id'),
					administrator_id:$("#administrator_id").val()
                },
				paramName: "file", // The name that will be used to transfer the file
				addRemoveLinks: true,
				success: function(file, response){
					
				},
				init: function() {
					var thisDropzone = this;
					this.on("processing", function(file) {
						thisDropzone.options.params.fold_id = localStorage.getItem('fold_id');
						thisDropzone.options.url = baseUrl;
					});
				}
             });
			//Load folders and folder tree by Ajax
		loadLeftSideTree();

			//Load folders and folder tree on  extend tree 
			$(document).on('click','[data-action="expend-folder-tree"]',function(e){
				e.preventDefault();
				if($(this).attr('rel')>0) { $('.upbtn').removeAttr('disabled'); $('input[name="fold_id"]').val($(this).attr('rel')); localStorage.setItem('fold_id',$(this).attr('rel')); $('input[name="curnurl"]').val('{{URL::to("folders")}}/' + $(this).attr('rel')+'?show={{$showType}}'); }
				$('#folders_data_list').html('<p style="padding-top: 30px; text-align: center;">Loading...</p>');
				$('a[data-action="expend-folder-tree"]').removeClass('selected');
				$(this).addClass('selected');
				//$('a.selected[data-action="expend-folder-tree"]').next().after('<p class="loading">Loading...</p>');
				$.ajax({
					url: $(this).attr('href'),
					type: "get",
					dataType: "html",
					success: function(data){
						//$(this).closest('p.loading').remove();
						$('a.selected[data-action="expend-folder-tree"]').next('ul.folders').remove();
						$('a.selected[data-action="expend-folder-tree"]').after(data);
						$('a.selected[data-action="expend-folder-tree"]').next().fadeIn('slow');
					}
				});

				var relfid = $(this).attr('rel');
				$.ajax({
					url: '{{url("getFoldersAjax/")}}/'+$(this).attr('rel')+'?show={{(isset($_GET["show"]))?$_GET["show"]:""}}',
					type: "get",
					dataType: "html",
					success: function(data){
						$('#folders_data_list').hide();
						$('#folders_data_list').html(data);
						$('#folders_data_list').fadeIn('slow');
						$('#folders_data_list').find('input[type=checkbox]').iCheck({checkboxClass: 'icheckbox_square-green'});
						$('#breadcrumb_line').html($('#folders_data_list').find('#get-breadcrumb').html());
						$('#showallmodals').html($('#folders_data_list').find('#allmodal').html());
						$('#allmodal').html('');
						if(relfid>0) { $('[data-target="#Directorypermission"]').removeAttr('disabled');  $('.upbtn').removeAttr('disabled'); $('input[name="fold_id"]').val(relfid); localStorage.setItem('fold_id',relfid); $('input[name="curnurl"]').val('{{URL::to("folders")}}/' + relfid+'?show={{$showType}}'); }
						screenshotPreview();
						screenshotPreviewimg();
						screenshotPreviewimgclick();
						screenshotPreviewmaterialimg();
					}
				});
				

			});

			//Load folders  on  search option 

			 var $searchFrm = $('#search');

		   	$(document).on('submit','#search',function(e) {
		    	e.preventDefault();
		    	$('#folders_data_list').html('<p style="padding-top: 30px; text-align: center;">Loading...</p>');
		    	$.ajax({
					url: '{{url("containersearch")}}',
					type: "get",
					data:$(this).serialize(),
					dataType: "html",
					success: function(data){
						$('#folders_data_list').hide();
						$('#folders_data_list').html(data);
						$('#folders_data_list').fadeIn('slow');
						$('#folders_data_list').find('input[type=checkbox]').iCheck({checkboxClass: 'icheckbox_square-green'});
						$('#breadcrumb_line').html($('#folders_data_list').find('#get-breadcrumb').html());
						$('#showallmodals').html($('#folders_data_list').find('#allmodal').html());
						$('#allmodal').html('');
						screenshotPreview();
						screenshotPreviewimg();
						screenshotPreviewimgclick();
						screenshotPreviewmaterialimg();
					}
				});
		    });

		   	//Load folders by click on folder
		   
		    //Load folders and folder tree on  extend tree 
			$(document).on('click','[data-action-open="folder"]',function(e){
				e.preventDefault();
				if($(this).attr('rel_row')>0) { $('.upbtn').removeAttr('disabled'); $('input[name="fold_id"]').val($(this).attr('rel_row')); localStorage.setItem('fold_id',$(this).attr('rel_row')); $('input[name="curnurl"]').val('{{URL::to("folders")}}/' + $(this).attr('rel_row')+'?show={{$showType}}'); }
				$('#folders_data_list').html('<p style="padding-top: 30px; text-align: center;">Loading...</p>');
				$('a[data-action="expend-folder-tree"]').removeClass('selected');
				$(this).addClass('selected');
				//$('a.selected[data-action="expend-folder-tree"]').next().after('<p class="loading">Loading...</p>');
				$.ajax({
					url: '{{url("getFolderListAjaxonload/")}}/'+$(this).attr('rel_row')+'?show={{(isset($_GET["show"]))?$_GET["show"]:""}}',
					type: "get",
					dataType: "html",
					success: function(data){
						$('[data-load="left-side-tree"]').hide();
						$('[data-load="left-side-tree"]').fadeIn('slow');
						$('[data-load="left-side-tree"]').html(data);
					}
				});

				var relroid = $(this).attr('rel_row');
				$.ajax({
					url: '{{url("getFoldersAjax/")}}/'+$(this).attr('rel_row')+'?show={{(isset($_GET["show"]))?$_GET["show"]:""}}',
					type: "get",
					dataType: "html",
					success: function(data){
						$('#folders_data_list').hide();
						$('#folders_data_list').html(data);
						$('#folders_data_list').fadeIn('slow');
						$('#folders_data_list').find('input[type=checkbox]').iCheck({checkboxClass: 'icheckbox_square-green'});
						$('#breadcrumb_line').html($('#folders_data_list').find('#get-breadcrumb').html());
						$('#showallmodals').html($('#folders_data_list').find('#allmodal').html());
						$('#allmodal').html('');
						if(relroid>0) { $('[data-target="#Directorypermission"]').removeAttr('disabled'); $('.upbtn').removeAttr('disabled'); $('input[name="fold_id"]').val(relroid); localStorage.setItem('fold_id',relroid); $('input[name="curnurl"]').val('{{URL::to("folders")}}/' + relroid+'?show={{$showType}}'); }
						screenshotPreview();
						screenshotPreviewimg();
						screenshotPreviewimgclick();
						screenshotPreviewmaterialimg();
					}
				});
				

			});

			//Load folders and folder tree on  extend tree 
			$(document).on('click','ul.pagination li a',function(e){
				e.preventDefault();
				$('#folders_data_list').html('<p style="padding-top: 30px; text-align: center;">Loading...</p>');
				$.ajax({
					url: $(this).attr('href'),
					type: "get",
					dataType: "html",
					success: function(data){
						$('#folders_data_list').hide();
						$('#folders_data_list').html(data);
						$('#folders_data_list').fadeIn('slow');
						$('#folders_data_list').find('input[type=checkbox]').iCheck({checkboxClass: 'icheckbox_square-green'});
						$('#breadcrumb_line').html($('#folders_data_list').find('#get-breadcrumb').html());
						$('#showallmodals').html($('#folders_data_list').find('#allmodal').html());
						$('#allmodal').html('');
						screenshotPreview();
						screenshotPreviewimg();
						screenshotPreviewimgclick();
						screenshotPreviewmaterialimg();
					}
				});
				

			});

		});
		
		function containerdropreload()
		{
			window.location.href = $('input[name="curnurl"]').val();
		}
	</script>
@stop