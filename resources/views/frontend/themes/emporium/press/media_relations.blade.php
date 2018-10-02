@extends('frontend.themes.emporium.layouts.home')
{{--  For Title --}}
@section('title', 'Emporium Voyage Luxury Hotel Collection')
{{-- For Meta Keywords --}}
@section('meta_keywords', 'Emporium Voyage Luxury Hotel Collection')
{{-- For Meta Description --}}
@section('meta_description', 'Emporium Voyage Luxury Hotel Collection')
{{-- For Page's Content Part --}}
@section('content')

    <!-- Restaurant slider starts here -->
    <section id="search-result-slider" class="luxuryHotelSlider">
		 @if(!empty($slider))
			<div id="myCarousel" class="carousel" data-ride="carousel">
				<!-- Indicators -->
				{{--  Wrapper for slides --}}
				<div class="carousel-inner">
					@foreach($slider as $key => $slider_row)
						<div class="item {{($key == 0)? 'active' : ''}}" style="background-image:url({{url('uploads/slider_images/'.$slider_row->slider_img)}});">
							<div class="carousel-caption">
								<h6>{{$slug}}</h6>
								<h2>
									@if($slider_row->slider_link!='#' && $slider_row->slider_link!='')
										<a onclick="return !window.open(this.href, '{{ ((strpos($slider_row->slider_link, 'http://') || strpos($slider_row->slider_link, 'https://')) === false) ? $slider_row->slider_link : 'http://'.$slider_row->slider_link }}', 'width=900,height=500,left=100, top=100, scrollbars, resizable')" href="{{ ((strpos($slider_row->slider_link, 'http://') || strpos($slider_row->slider_link, 'https://')) === false) ? $slider_row->slider_link : 'http://'.$slider_row->slider_link }}">{{$slider_row->slider_title}}</a>
									@else
										{{$slider_row->slider_title}}
									@endif
								</h2>
								<p>@if($slider_row->slider_link!='#' && $slider_row->slider_link!='')
										<a onclick="return !window.open(this.href, '{{ ((strpos($slider_row->slider_link, 'http://') || strpos($slider_row->slider_link, 'https://')) === false) ? $slider_row->slider_link : 'http://'.$slider_row->slider_link }}', 'width=900,height=500,left=100, top=100, scrollbars, resizable')" href="{{ ((strpos($slider_row->slider_link, 'http://') || strpos($slider_row->slider_link, 'https://')) === false) ? $slider_row->slider_link : 'http://'.$slider_row->slider_link }}" style="color:white;	">{{$slider_row->slider_description}}</a>
									@else
										{{$slider_row->slider_description}}
									@endif


								</p>
							</div>
						</div>
					@endforeach
					{{--*/ $adscatid = ($destination_category > 0) ? $destination_category : 'Hotel'; $sliderads = CommonHelper::getSliderAds('grid_slider', $adscatid) /*--}}
					@if(!empty($sliderads['leftsidebarads']))
						@foreach($sliderads['leftsidebarads'] as $ads)
							<div class="item" style="background-image:url({{URL::to('uploads/users/advertisement/'.$ads->adv_img)}});">
								<div class="carousel-caption">
									<h6>Advertisement</h6>
									<h2>
										@if($ads->adv_link!='#' && $ads->adv_link!='')
											<a onclick="return !window.open(this.href, '{{ ((strpos($ads->adv_link, 'http://') || strpos($ads->adv_link, 'https://')) === false) ? $ads->adv_link : 'http://'.$ads->adv_link }}', 'width=900,height=500,left=100, top=100, scrollbars, resizable')" href="{{ ((strpos($ads->adv_link, 'http://') || strpos($ads->adv_link, 'https://')) === false) ? $ads->adv_link : 'http://'.$ads->adv_link }}">{{$ads->adv_title}}</a>
										@else
											{{$ads->adv_title}}
										@endif
									</h2>
									<p>@if($ads->adv_link!='#' && $ads->adv_link!='')
											<a onclick="return !window.open(this.href, '{{ ((strpos($ads->adv_link, 'http://') || strpos($ads->adv_link, 'https://')) === false) ? $ads->adv_link : 'http://'.$ads->adv_link }}', 'width=900,height=500,left=100, top=100, scrollbars, resizable')" href="{{ ((strpos($ads->adv_link, 'http://') || strpos($ads->adv_link, 'https://')) === false) ? $ads->adv_link : 'http://'.$ads->adv_link }}">{{$ads->adv_desc}}</a>
										@else
											{{$ads->adv_desc}}
										@endif


									</p>
								</div>
							</div>
						@endforeach
					@endif
				</div>
				@if(count($slider) > 1)
					<!-- Left and right controls -->
					<a class="left carousel-control" href="#myCarousel" data-slide="prev">
						<img src="{{ asset('themes/emporium/images/editorial-left-arrow.png') }}" alt="Icon"/>
					</a>
					<a class="right carousel-control" href="#myCarousel" data-slide="next">
						<img src="{{ asset('themes/emporium/images/editorial-right-arrow.png') }}" alt="Icon"/>
					</a>
				@endif
			</div>
		@endif
    </section>
	
    




<?php $imgfancy = array();
	$filType = array('jpg'=>'JPEG image', 'jpeg'=>'JPEG image', 'JPG'=>'JPEG image', 'png'=>'PNG image', 'gif'=>'GIF image', 'xls'=>'Excel spreadsheet', 'eps'=>'EPS Image', 'mp4'=>'MPEG-4 video', 'mkv'=>'Matroska Video', 'flv'=>'Flash Video', 'avi'=>'Audio Video', 'wma'=>'Windows Media Audio', 'wmp'=>'Windows Media Player', 'psd'=>'PSD Image', 'pdf'=>'PDF document', 'ppt'=>'PowerPoint presentation', 'mp3'=>'MP3 audio', 'tif'=>'TIFF image', 'doc'=>'Word document', 'docx'=>'Word document', 'bmp'=>'Bitmap image', 'cad'=>'CAD image', 'zip'=>'Compress document');
 ?>
  
<div class="col-md-12 col-sm-12 col-xs-12" style="background: #fff; padding-top: 25px; padding-bottom: 25px;">	
	<div class="row">
		<div class="col-sm-3">	
			<div class="row">
				<div class="col-sm-12">
					<a href="{{ URL::to('press?show='.$showType) }}" class="files label clor"><span>Files</span></a>
					<div data-load="left-side-tree"><p style="padding-top: 20px;">Loading...</p></div>
				</div>
			</div>			
		</div>
		<div class="col-sm-9">
			
			<div class="row">
				<div class="col-sm-12">
					<!-- Download button -->
					<div class="btn-group" id="page-download">
					  <button type="button" class="btn btn-primary btn-lg dropdown-toggle btn_orange" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icn"><i class="icon-folder-download"></i> Download</span></button>
					  <button type="button" class="btn btn-primary btn-lg dropdown-toggle btn_orange" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="caret"></span>
						<span class="sr-only">Toggle Dropdown</span>
					  </button>
					  <ul class="dropdown-menu">
						<li><a href="#" onclick="select_folderfilesfor_download('file_download');">As Zip Archive</a></li>
						<?php /* <li><a href="#" onclick="select_folderfilesfor_download('lowpdf_download');">{{\Lang::get('core.menu_download_low_pdf')}}</a></li>
						<li><a href="#" onclick="select_folderfilesfor_download('highpdf_download');">{{\Lang::get('core.menu_download_high_pdf')}}</a></li> */ ?>
						<li><a href="#" onclick="entire_folderfilesfor_download();">Folder as Zip</a></li>
					  </ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12" id="file-breadcrumb">
					<div id="breadcrumb_line">
					@if($fid>0)
						<h2 class="folder">
							<span id="folder_name">
								<a href="{{ URL::to('press?show='.$showType) }}"><span>Files</span></a>
								@if(!empty($parentArr))
									@foreach($parentArr as $parArr)
										/ @if(end($parentArr)!=$parArr)<a href="{{ URL::to('folders/'.$parArr->id.'?show='.$showType) }}">{{$parArr->display_name}}</a>@else {{$parArr->display_name}} @endif
									@endforeach
								@endif
							</span>
							<em> &bull; {{$subfilestotal}} files &bull; {{$subfoldertotal}} folders &bull; {{$subfileSpace}} MB</em>&nbsp;&nbsp;
						</h2>
					@else
						<h2 class="folder">
							<span id="folder_name">Files</span>
							<em> &bull; {{$subfoldertotal}} folders</em>
						</h2>
					@endif
					</div>
                </div>
                <div class="col-sm-12">
					@if($showType=="thumb")	
						<div class="gallery-select-all">
							<label style="float:left;">
								<input type="checkbox" value="1" id="check_all" class="check-all"> Select all
							</label>
							<div class="row" style="display: none;">
								{!! Form::open(array('url'=>'presssearch', 'class'=>'columns' ,'id' =>'search', 'method'=>'get' )) !!}
									<input type="hidden" name="show" value="{{ $showType }}">
									<div class="col-sm-4">
										<input type="text" name="searchkeyword" value="" class="form-control" placeholder="Enter your keyword here" style="height:37px !important;" />
									</div>
									<div class="col-sm-6" style="text-align:right; padding-right:0px;">
										<button type="submit" class="btn btn-primary btn-lg">
											<span class="icn"><i class="icon-search2"></i> {{\Lang::get('core.menu_search')}}</span>
										</button>
										<a href="{{ URL::to('press?show='.$showType) }}" class="btn btn-primary btn-lg">
											<span class="icn"><i class="icon-spinner8"></i> {{\Lang::get('core.menu_reset')}}</span>
										</a>
										<!-- View button -->
										<div class="btn-group">
										  <button type="button" class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icn"><i class="icon-screen2"></i> {{\Lang::get('core.menu_view')}}</span></button>
										  <button type="button" class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										  </button>
										  <ul class="dropdown-menu">
											<li><a href="{{ Request::url().'?show=list'}}">{{\Lang::get('core.menu_view_list')}}</a></li>
											<li><a href="{{ Request::url().'?show=thumb'}}">{{\Lang::get('core.menu_view_gallery')}}</a></li>
											<li><a href="#" id="fancybox-manual-c">{{\Lang::get('core.menu_view_slideshow')}}</a></li>
											<li><a href="#" onclick="select_folderfilesfor_download('flipbook', 'high');">{{\Lang::get('core.menu_view_high_flipbook')}}</a></li>
											<li><a href="#" onclick="select_folderfilesfor_download('flipbook', 'low');">{{\Lang::get('core.menu_view_low_flipbook')}}</a></li>
										  </ul>
										</div>
									</div>
								</form>
							</div>
						</div>
                    </div>
                    <div class="col-sm-12">
						<div class="clear"></div>
						<!-- Load Folders -->
						<div id="folders_data_list"><p style="padding-top: 30px; text-align: center;">Loading...</p></div>
						
					@elseif($showType=="list")
						<div class="gallery-select-all">
							<label style="float:left;">
								<input type="checkbox" value="1" id="check_all" class="check-all"> Select all
							</label>
							<div class="row" style="display: none;">
								{!! Form::open(array('url'=>'presssearch', 'class'=>'columns' ,'id' =>'search', 'method'=>'get' )) !!}
									<input type="hidden" name="show" value="{{ $showType }}">
									<div class="col-sm-4">
										<input type="text" name="searchkeyword" value="" class="form-control" placeholder="Enter your keyword here" style="height:37px !important;" />
									</div>
									<div class="col-sm-6" style="text-align:right; padding-right:0px;">
										<button type="submit" class="btn btn-primary btn-lg">
											<span class="icn"><i class="icon-search2"></i> {{\Lang::get('core.menu_search')}}</span>
										</button>
										<a href="{{ URL::to('press?show='.$showType) }}" class="btn btn-primary btn-lg">
											<span class="icn"><i class="icon-spinner8"></i> {{\Lang::get('core.menu_reset')}}</span>
										</a>
										<!-- View button -->
										<div class="btn-group">
										  <button type="button" class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icn"><i class="icon-screen2"></i> {{\Lang::get('core.menu_view')}}</span></button>
										  <button type="button" class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										  </button>
										  <ul class="dropdown-menu">
											<li><a href="{{ Request::url().'?show=list'}}">{{\Lang::get('core.menu_view_list')}}</a></li>
											<li><a href="{{ Request::url().'?show=thumb'}}">{{\Lang::get('core.menu_view_gallery')}}</a></li>
											<li><a href="#" id="fancybox-manual-c">{{\Lang::get('core.menu_view_slideshow')}}</a></li>
											<li><a href="#" onclick="select_folderfilesfor_download('flipbook', 'high');">{{\Lang::get('core.menu_view_high_flipbook')}}</a></li>
											<li><a href="#" onclick="select_folderfilesfor_download('flipbook', 'low');">{{\Lang::get('core.menu_view_low_flipbook')}}</a></li>
										  </ul>
										</div>
									</div>
								</form>
							</div>
						</div>
						<!-- Load Folders -->
						<div id="folders_data_list"><p style="padding-top: 30px; text-align: center;">Loading...</p></div>
						
					@endif
				</div>
			</div>
		</div>
	</div>
</div>

<div id="showallmodals"> </div>

<!-- New File Modal -->
	<div class="modal fade" id="newFile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Upload new file</h4>
		  </div>
		  {!! Form::open(array('url'=>'addfile', 'class'=>'columns' ,'id' =>'file_new', 'method'=>'post', 'files'=>true )) !!}
		  <input type="hidden" name="fold_id" id="uploadfile_fold_id" value="{{$fid}}">
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
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


<!-- choose lightbox Modal -->
<div class="modal fade" id="chooselight" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-top:100px;">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Choose Merkzettel:</h4>
	  </div>
	  <div class="modal-body">
		<div class="field">
			<label>Please select a Merkzettel <em>*</em></label>
			<div class="field-input">
				<input type="hidden" name="chsfile" id="chsfile" value="" />
				<select name="chslightboxes" id="chslightboxes" class="form-control">
				@foreach($lightboxes as $opt)
				  <option value="<?php echo $opt->id; ?>"><?php echo $opt->box_name; ?></option>
				@endforeach
				</select>
			</div>
		</div>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-primary" onclick="selectlightbox();">zur Lightbox hinzufügen</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	  </div>
	  </form>
	</div>
  </div>
</div>
    
    

@endsection

{{--For Right Side Icons --}}
@section('right_side_iconbar')

	@parent
@show

{{-- For Include Top Bar --}}
@section('top_search_bar')
    @parent
@endsection

{{-- For Include Side Bar --}}
@section('sidebar')
    @include('frontend.themes.emporium.layouts.sections.grid_sidebar')
@endsection

{{-- For Include style files --}}
@section('head')
    @parent
    
    <link href="{{ asset('sximo/css/custom_ps.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('sximo/css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('sximo/js/plugins/fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5') }}">
    
    <link href="{{ asset('sximo/js/plugins/iCheck/skins/square/green.css')}}" rel="stylesheet">
    
    <link href="{{ asset('themes/emporium/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('themes/emporium/css/pdpage-css.css') }}" rel="stylesheet">
	<link href="{{ asset('themes/emporium/css/search-result.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/emporium/css/rad-photos-swap.css') }}" rel="stylesheet">

@endsection

{{-- For custom style  --}}
@section('custom_css')
    @parent
    <style>
    .size-bar-side{overflow: hidden;}
    div[data-load="left-side-tree"]{max-height: 600px;    overflow: auto;}
    .leng { display:none; }
    .btn_orange, .btn_orange:hover, .btn_orange:focus, .btn_orange:active, .btn_orange.active, .open .dropdown-toggle.btn_orange {  background-color: #ABA07C; border-color: #ABA07C; }
    .disnon { display:none; }
    .lightboxmodal { z-index:1060; }
    .clor{
        color: #000 !important;    
    }
    </style>
@endsection
    
{{-- For Include javascript files --}}
@section('javascript')
    @parent    
    
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/jquery.cookie.js') }}"></script>			
					
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/iCheck/icheck.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/select2/select2.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/fancybox/jquery.fancybox.js') }}"></script>
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/prettify.js') }}"></script>
		<!--<script type="text/javascript" src="{{ asset('sximo/js/plugins/parsley.js') }}"></script>-->
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/datepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/switch.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
		
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('sximo/js/sximo.js') }}"></script>
        <script type="text/javascript" src="{{ asset('sximo/js/plugins/jquery.form.js') }}"></script>
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/jquery.jCombo.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/toastr/toastr.js') }}"></script>
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/bootstrap.summernote/summernote.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('sximo/js/simpleclone.js') }}"></script>
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/markitup/jquery.markitup.js') }}"></script>	
		<script type="text/javascript" src="{{ asset('sximo/js/plugins/markitup/sets/default/set.js') }}"></script>	
		
        <script src="{{ asset('sximo/crm_layout/jquery-minicolors/jquery.minicolors.min.js')}}" type="text/javascript"></script>
    
    
    <script src="{{ asset('sximo/js/tooltip_popup.js') }}"></script>
    
	<script src="{{ asset('sximo/js/dynamitable.jquery.min.js') }}"></script>
@endsection

{{-- For custom script --}}
@section('custom_js')
    @parent	
	<script>
		//Load folders and folder tree by Ajax
		function loadLeftSideTree(){ 
			$.ajax({
				url: '{{url("getPressFolderListAjaxonload/")}}/{{(isset($fid) && $fid!="")?$fid:0}}',
				type: "get",
				dataType: "html",
				success: function(data){
					$('[data-load="left-side-tree"]').hide();
					$('[data-load="left-side-tree"]').fadeIn('slow');
					$('[data-load="left-side-tree"]').html(data);
				}
			});


			$.ajax({
				url: '{{url("getPressFoldersAjax/")}}/{{(isset($fid) && $fid!="")?$fid:0}}?show={{(isset($_GET["show"]))?$_GET["show"]:""}}',
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
			
			 
			//Load folders and folder tree by Ajax
			loadLeftSideTree();

			//Load folders and folder tree on  extend tree 
			$(document).on('click','[data-action="expend-folder-tree"]',function(e){
				e.preventDefault();
				$('.gallery-select-all').css('display', '');
                $("#page-download").css('display', '');
                $("#file-breadcrumb").css('display', '');
                
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
					url: '{{url("getPressFoldersAjax/")}}/'+$(this).attr('rel')+'?show={{(isset($_GET["show"]))?$_GET["show"]:""}}',
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
					url: '{{url("presssearch")}}',
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
				$('.gallery-select-all').css('display', 'none');
                $("#page-download").css('display', '');
                $("#file-breadcrumb").css('display', '');
                
				$('#folders_data_list').html('<p style="padding-top: 30px; text-align: center;">Loading...</p>');
				$('a[data-action="expend-folder-tree"]').removeClass('selected');
				$(this).addClass('selected');
				//$('a.selected[data-action="expend-folder-tree"]').next().after('<p class="loading">Loading...</p>');
				$.ajax({
					url: '{{url("getPressFolderListAjaxonload/")}}/'+$(this).attr('rel_row'),
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
					url: '{{url("getPressFoldersAjax/")}}/'+$(this).attr('rel_row')+'?show={{(isset($_GET["show"]))?$_GET["show"]:""}}',
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
			$(document).on('click','[data-action-open="file"]',function(e){
				e.preventDefault();
				$('.gallery-select-all').css('display', 'none');
                $("#page-download").css('display', 'none');
                $("#file-breadcrumb").css('display', 'none');
				//$('#folders_data_list').html('<p style="padding-top: 30px; text-align: center;">Loading...</p>');
				$('a[data-action="expend-folder-tree"]').removeClass('selected');
				$(this).addClass('selected');
				//$('a.selected[data-action="expend-folder-tree"]').next().after('<p class="loading">Loading...</p>');
				$.ajax({
					url: '{{url("getPressFolderListAjaxonload/")}}/'+$(this).attr('rel_fid'),
					type: "get",
					dataType: "html",
					success: function(data){ 
						$('[data-load="left-side-tree"]').hide();
						$('[data-load="left-side-tree"]').fadeIn('slow');
						$('[data-load="left-side-tree"]').html(data);
					}
				});

				var relroid = $(this).attr('rel_row');
                var relrofid = $(this).attr('rel_fid');
				$.ajax({
					url: $(this).attr('href'),
					type: "get",
					dataType: "html",
					success: function(data){
						$('#folders_data_list').hide();
						$('#folders_data_list').html(data);
						$('#folders_data_list').fadeIn('slow');
						//$('#folders_data_list').find('input[type=checkbox]').iCheck({checkboxClass: 'icheckbox_square-green'});
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
			
			
			$(document).on('click','[data-target="#Directorypermission"]',function(e){
				e.preventDefault();
				
				var relfid = $(this).attr('rel');
				$.ajax({
					url: '{{url("getUserList/")}}',
					type: "get",
					dataType: "html",
					success: function(data){
						$('[data-user-list="data"]').hide();
						$('[data-user-list="data"]').html(data);
						$('[data-user-list="data"]').fadeIn('slow');
						$('[data-user-list="data"]').find('input[type=checkbox]').iCheck({checkboxClass: 'icheckbox_square-green'});
						$('[data-user-list="data"]').find('input[type=radio]').iCheck({radioClass: 'iradio_square-green'});
					}
				});
				

			});
			$(document).on('keyup','[data-search-user-list="row"]',function(e){
				var $rows = $('[data-user-list="data"] tr');
                    var val = '^(?=.*\\b' + $.trim($(this).val()).split(/\s+/).join('\\b)(?=.*\\b') + ').*$',
                        reg = RegExp(val, 'i'),
                        text;
                    
                    $rows.show().filter(function() {
                        text = $(this).text().replace(/\s+/g, ' ');
                        return !reg.test(text);
                    }).hide()
			});
			

		});
		
		function containerdropreload()
		{
			window.location.href = $('input[name="curnurl"]').val();
		}
	</script>
@endsection

{{-- For footer --}}
@section('footer')
    @parent
@endsection
