@extends('layouts.app')

@section('content')

<link href="{{ asset('sximo/css/custom_ps.css')}}" rel="stylesheet">
<script src="{{ asset('sximo/js/dropzone.js') }}"></script>
<link rel="stylesheet" href="{{ asset('sximo/css/dropzone.css') }}">
<script src="{{ asset('sximo/js/tooltip_popup.js') }}"></script>
<link rel="stylesheet" href="{{ asset('sximo/js/plugins/fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5') }}">
<script src="{{ asset('sximo/js/plugins/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5') }}"></script>
<style>
.size-bar-side{overflow: hidden;}
div[data-load="left-side-tree"]{max-height: 600px;    overflow: auto;}
.leng { display:none; }
.btn_orange, .btn_orange:hover, .btn_orange:focus, .btn_orange:active, .btn_orange.active, .open .dropdown-toggle.btn_orange {  background-color: orange; border-color: orange; }
.disnon { display:none; }
.lightboxmodal { z-index:1060; }
</style>

<?php $imgfancy = array();
	$filType = array('jpg'=>'JPEG image', 'jpeg'=>'JPEG image', 'JPG'=>'JPEG image', 'png'=>'PNG image', 'gif'=>'GIF image', 'xls'=>'Excel spreadsheet', 'eps'=>'EPS Image', 'mp4'=>'MPEG-4 video', 'mkv'=>'Matroska Video', 'flv'=>'Flash Video', 'avi'=>'Audio Video', 'wma'=>'Windows Media Audio', 'wmp'=>'Windows Media Player', 'psd'=>'PSD Image', 'pdf'=>'PDF document', 'ppt'=>'PowerPoint presentation', 'mp3'=>'MP3 audio', 'tif'=>'TIFF image', 'doc'=>'Word document', 'docx'=>'Word document', 'bmp'=>'Bitmap image', 'cad'=>'CAD image', 'zip'=>'Compress document');
 ?>
  <div class="page-content row" style="margin-bottom: 85px;">
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
				<div class="row">
					<div class="col-sm-12">
						<div class="size-bar-side">
							<div style="width: {{$usedStoragePerct}}%">&nbsp;</div>
						</div>
						<div class="size-txt-side">
							<em>{{$usedStorage}} MB</em> ({{$usedStoragePerct}}%) of <em> {{$allowStorage}} MB</em> used
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-9">
				
				<div class="row">
					<div class="col-sm-12">
						<button type="button" class="btn btn-success btn-lg" onclick="selectfolderfiles();" data-toggle="modal" data-target="#sendEmail">
							<span class="icn"><i class="icon-share"></i> {{\Lang::get('core.menu_share')}}</span>
						</button>
						<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#Directorypermission" @if($fid==0) disabled="disabled" @endif>
						  <span class="icn"><i class="icon-people"></i>{{\Lang::get('core.menu_permission')}}</span>
						</button>
						<button type="button" class="btn btn-primary btn-lg btn_orange" data-toggle="modal" data-target="#newDirectory">
							<span class="icn"><i class="icon-folder-plus"></i> {{\Lang::get('core.menu_new_folder')}}</span>
						</button>
						
						
						<!-- Operation button -->
						<div class="btn-group">
						  <button type="button" class="btn btn-primary btn-lg dropdown-toggle btn_orange" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icn"><i class="icon-settings"></i> {{\Lang::get('core.menu_operations')}}</span></button>
						  <button type="button" class="btn btn-primary btn-lg dropdown-toggle btn_orange" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="caret"></span>
							<span class="sr-only">Toggle Dropdown</span>
						  </button>
						  <ul class="dropdown-menu">
							<li><a href="#" onclick="selectfolderfiles_copy_move_fun();" data-toggle="modal" data-target="#copyFolderFile">{{\Lang::get('core.menu_copy_folder_file')}}</a></li>
							<li><a href="#" onclick="selectfolderfiles_copy_move_fun();" data-toggle="modal" data-target="#moveFolderFile">{{\Lang::get('core.menu_move_folder_file')}}</a></li>
							<li><a href="#" onclick="selectfolderfiles();" data-toggle="modal" data-target="#deleteFolderFile">{{\Lang::get('core.menu_delete_folder_file')}}</a></li>
							<li><a href="#" onclick="selectfolderfiles();" data-toggle="modal" data-target="#assignAttribute">{{\Lang::get('core.menu_assign_attribute_folder_file')}}</a></li>
							<li><a href="#" onclick="selectfolderfiles();" data-toggle="modal" data-target="#assignTags">{{\Lang::get('core.menu_assign_tag_folder_file')}}</a></li>
							<li><a href="#" onclick="selectfolderfiles_copy_move_fun();" data-toggle="modal" data-target="#assignMainImage">{{\Lang::get('core.menu_assign_main_image')}}</a></li>
							<li><a href="#" onclick="select_folderfilesfor_download('file_frontend');">{{\Lang::get('core.menu_frontend')}}</a></li>
							<li><a href="#" onclick="select_folderfilesfor_download('unassign_file_frontend');">{{\Lang::get('core.menu_deactivate_frontend')}}</a></li>
							<li><a href="#" onclick="selectfolderfiles();" data-toggle="modal" data-target="#assignDesigner">{{\Lang::get('core.menu_assign_designer')}}</a></li>
							<!--<li><a href="#" onclick="select_folderfilesfor_download('frontend_slider');" data-toggle="modal" data-target="#assignFrontendSlider">{{\Lang::get('core.menu_operation_frontend_slider')}}</a></li>-->
							<li><a href="#" onclick="submit_folder_form('create_folders', 'Slider');">{{\Lang::get('core.menu_operation_slider_folder')}}</a></li>
							<li><a href="#" onclick="submit_folder_form('create_folders', 'Produktvarianten');">{{\Lang::get('core.menu_operation_variant_folder')}}</a></li>
							<li><a href="#" onclick="submit_folder_form('create_folders', 'Jpg');">{{\Lang::get('core.menu_operation_jpg_folder')}}</a></li>
							<li><a href="#" onclick="select_folderfilesfor_download('assign_categories_landing');">{{\Lang::get('core.menu_operation_assign_landing')}}</a></li>
							<li><a href="#" onclick="select_folderfilesfor_download('activate_lightbox');">{{\Lang::get('core.menu_operation_activate_lightbox')}}</a></li>
							<li><a href="#" onclick="select_folderfilesfor_download('deactivate_lightbox');">{{\Lang::get('core.menu_operation_deactivate_lightbox')}}</a></li>
							<li><a href="#" onclick="submit_folder_form('create_folders', 'JPG Highres');">{{\Lang::get('core.menu_operation_png_folder')}}</a></li>
							<li><a href="#" onclick="selectfolderfiles();" data-toggle="modal" data-target="#assignPdfImage">{{\Lang::get('core.menu_assign_pdf_image')}}</a></li>
						  </ul>
						</div>
						
						<div class="btn-group">
						  <button type="button" class="btn btn-primary btn-lg dropdown-toggle btn_orange upbtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @if($fid==0) disabled="disabled" @endif><span class="icn"><i class="icon-upload3"></i> {{\Lang::get('core.menu_upload')}}</span></button>
						  <button type="button" class="btn btn-primary btn-lg dropdown-toggle btn_orange upbtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @if($fid==0) disabled="disabled" @endif>
							<span class="caret"></span>
							<span class="sr-only">Toggle Dropdown</span>
						  </button>
						  <ul class="dropdown-menu">
							<li><a href="#" data-toggle="modal" data-target="#newFile">{{\Lang::get('core.menu_upload')}}</a></li>
							<li><a href="#">{{\Lang::get('core.menu_upload_zip')}}</a></li>
						  </ul>
						</div>
						
						<!-- Download button -->
						<div class="btn-group">
						  <button type="button" class="btn btn-primary btn-lg dropdown-toggle btn_orange" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icn"><i class="icon-folder-download"></i> {{\Lang::get('core.menu_download')}}</span></button>
						  <button type="button" class="btn btn-primary btn-lg dropdown-toggle btn_orange" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="caret"></span>
							<span class="sr-only">Toggle Dropdown</span>
						  </button>
						  <ul class="dropdown-menu">
							<li><a href="#" onclick="select_folderfilesfor_download('file_download');">{{\Lang::get('core.menu_download_zip')}}</a></li>
							<li><a href="#" onclick="select_folderfilesfor_download('lowpdf_download');">{{\Lang::get('core.menu_download_low_pdf')}}</a></li>
							<li><a href="#" onclick="select_folderfilesfor_download('highpdf_download');">{{\Lang::get('core.menu_download_high_pdf')}}</a></li>
							<li><a href="#" onclick="entire_folderfilesfor_download();">{{\Lang::get('core.menu_download_entire_folder')}}</a></li>
						  </ul>
						</div>
						
						<button type="button" class="btn btn-primary btn-lg btn_orange" onclick="add_to_lightbox();">
							<span class="icn"><i class="icon-share"></i> Add to Merkzettel</span>
						</button>
												
						@if($group!=3) 
						<!-- permission button -->
						
						@endif
						@if($group==1 && (!empty($foldername) && $foldername->parent_id==0)) 
						<!-- global permission button -->
						<div class="btn-group">
						  <button type="button" class="btn btn-primary btn-lg dropdown-toggle btn_orange" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{\Lang::get('core.menu_global')}}</button>
						  <button type="button" class="btn btn-primary btn-lg dropdown-toggle btn_orange" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="caret"></span>
							<span class="sr-only">Toggle Dropdown</span>
						  </button>
						  <ul class="dropdown-menu">
							<li><a href="#" data-toggle="modal" data-target="#globalDirectorypermission">{{\Lang::get('core.menu_global_set')}}</a></li>
							<li><a href="#" data-toggle="modal" data-target="#RemoveglobalDirectorypermission">{{\Lang::get('core.menu_global_remove')}}</a></li>
						  </ul>
						</div>
						@endif
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div id="breadcrumb_line">
						@if($fid>0)
							<h2 class="folder">
								<span id="folder_name">
									<a href="{{ URL::to('container?show='.$showType) }}"><span>Files</span></a>
									@if(!empty($parentArr))
										@foreach($parentArr as $parArr)
											/ @if(end($parentArr)!=$parArr)<a href="{{ URL::to('folders/'.$parArr->id.'?show='.$showType) }}">{{$parArr->display_name}}</a>@else {{$parArr->display_name}} @endif
										@endforeach
									@endif
								</span>
								<em> &bull; {{$subfilestotal}} files &bull; {{$subfoldertotal}} folders &bull; {{$subfileSpace}} MB</em>&nbsp;&nbsp;
								<a href="#" data-toggle="modal" data-target="#editDirectory" class="foldout renamefolder" title="Edit this folder">
									<img src="{{URL::to('uploads/images/folder_edit.png')}}" alt="" width="16" height="16" title="" class="img-icon">
								</a>&nbsp;&nbsp;
								<a href="#" data-toggle="modal" data-target="#deleteFolder" class="foldout delete" title="Delete this folder">
									<img src="{{URL::to('uploads/images/folder_delete.png')}}" alt="" width="16" height="16" title="" class="img-icon">
								</a>
							</h2>
						@else
							<h2 class="folder">
								<span id="folder_name">Files</span>
								<em> &bull; {{$subfoldertotal}} folders</em>
							</h2>
						@endif
						</div>
						@if($showType=="thumb")	
							<div class="gallery-select-all">
								<label style="float:left;">
									<input type="checkbox" value="1" id="check_all" class="check-all"> Select all
								</label>
								<div class="row">
									{!! Form::open(array('url'=>'containersearch', 'class'=>'columns' ,'id' =>'search', 'method'=>'get' )) !!}
										<input type="hidden" name="show" value="{{ $showType }}">
										<div class="col-sm-4">
											<input type="text" name="searchkeyword" value="" class="form-control" placeholder="Enter your keyword here" style="height:37px !important;" />
										</div>
										<div class="col-sm-6" style="text-align:right; padding-right:0px;">
											<button type="submit" class="btn btn-primary btn-lg">
												<span class="icn"><i class="icon-search2"></i> {{\Lang::get('core.menu_search')}}</span>
											</button>
											<a href="{{ URL::to('container?show='.$showType) }}" class="btn btn-primary btn-lg">
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
							<div class="clear"></div>
							<!-- Load Folders -->
							<div id="folders_data_list"><p style="padding-top: 30px; text-align: center;">Loading...</p></div>
							
						@elseif($showType=="list")
							<div class="gallery-select-all">
								<label style="float:left;">
									<input type="checkbox" value="1" id="check_all" class="check-all"> Select all
								</label>
								<div class="row">
									{!! Form::open(array('url'=>'containersearch', 'class'=>'columns' ,'id' =>'search', 'method'=>'get' )) !!}
										<input type="hidden" name="show" value="{{ $showType }}">
										<div class="col-sm-4">
											<input type="text" name="searchkeyword" value="" class="form-control" placeholder="Enter your keyword here" style="height:37px !important;" />
										</div>
										<div class="col-sm-6" style="text-align:right; padding-right:0px;">
											<button type="submit" class="btn btn-primary btn-lg">
												<span class="icn"><i class="icon-search2"></i> {{\Lang::get('core.menu_search')}}</span>
											</button>
											<a href="{{ URL::to('container?show='.$showType) }}" class="btn btn-primary btn-lg">
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
<div id="fixed_wrapper">
	<!-- Lightbox Modal -->
	<div id="lightbox_basket_wrapper">
		<div id="lightbox_basket_trigger">
			<a href="#" class="link-to-show active" onclick="hide_show_lightbox('show');">Merkzettel<span class="arrow_down"></span></a>
			<a href="#" class="link-to-hide" onclick="hide_show_lightbox('hide');">Merkzetl<span class="arrow_down"></span></a>
		</div>

		<div id="lightbox_basket">
			<div id="lightbox_basket_content">
				<div id="lightbox_outer_wrapper">
					<!--<div id="create_lightbox" class="attached">
						
						<div class="lightbox_addon">
							<button type="button" class="textButton" onclick="createnewbox();">Neu Merkzettel erstellen +</button>
						</div>
					</div>-->
					{{--*/ $lb=0; $lb_itm=0; /*--}}
					@if(!empty($lightboxes))
						{{--*/ $lb= count($lightboxes); /*--}}
						@foreach($lightboxes as $lboxes)
							<div class="single_lightbox_wrapper{{$lboxes->id}} single_lightbox_wrappertemp attached">
								<input type="hidden" name="editlightboxid" id="editlightboxid" value="{{$lboxes->id}}" />
								<div class="single_lightbox_inner_wrapper">
									<div class="single_lightbox_wrapper_left">
										<div class="single_lightbox_title" data-lightbox-field="title">
											<span id="lightbox_title">{{$lboxes->box_name}}</span>
											<a href="#" class="lightbox_rename" onclick="show_rename_form({{$lboxes->id}});">Umbenennen</a>
											<div class="lightbox_rename_wrapper disnon">
												<input type="text" value="{{$lboxes->box_name}}" name="editval" class="textbox{{$lboxes->id}}" style="width:150px;">
												<button type="button" onclick="lightbox_update_name({{$lboxes->id}});">Save</button>
											</div>
										</div>
										<!--<div class="single_lightbox_controls">
											<button type="button" class="remove_lightbox textButton arrowButton" onclick="deletelightbox('{{$lboxes->id}}');">Entfernen</button>
										</div>-->

										<div class="single_lightbox_controls">
											<a href="{{URL::to('lightbox_content_downloadpdf/'.$lboxes->id)}}" class="textButton arrowButton default" ><i class="fa fa-download"></i> Download PDF</a>
											<a href="#" class="textButton arrowButton asLightbox lightbox_email cboxElement" data-toggle="modal" data-target="#sendEmail_lightbox" onclick="getlightbox($lboxes->id);"><i class="fa fa-envelope"></i>  Share Lightbox</a>
										</div>
									</div>

									<div class="single_lightbox_wrapper_right">
										<ul>										
											@if(!empty($lightcontent[$lboxes->id]))
												{{--*/ $lb_itm = count($lightcontent[$lboxes->id]); /*--}}
												@foreach($lightcontent[$lboxes->id] as $cont)
													<li id="imgfile{{$cont->id}}">
														<a href="#">
														{{--*/ $explFile = explode('.',$cont->file_name); 
															    $lext = end($explFile); 
														/*--}}
														
														@if($lext=="jpg" || $lext=="png" || $lext=="gif" || $lext=="bmp" || $lext=="jpeg" || $lext=="JPG")
															<img src="{{URL::to('uploads/thumbs/').'/thumb_'.$cont->folder_id.'_'.$cont->file_name}}" alt="{{$cont->file_display_name}}">
														@elseif($lext=="pdf")
															<img src="{{URL::to('uploads/images/pdf_icon_klein.png')}}" alt="{{$cont->file_display_name}}">
														@elseif($lext=="docx" || $lext=="doc")
															<img src="{{URL::to('uploads/images/doc_icon_klein.png')}}" alt="{{$cont->file_display_name}}">
														@endif
															<p>{{$cont->file_title}}</p>

														</a>
														
														<button type="button" class="remove_article" onclick="remove_boxcontent({{$cont->id}});">
															<img src="{{ asset('sximo/images/remove.gif')}}" alt="Delete">
														</button>
													</li>
												@endforeach
											@endif
										</ul>

										<div class="single_lightbox_showmore"><a class="arrowButton textButton" href="#">Show all</a></div>
									</div>
								</div>
							</div>
						@endforeach
					@endif
					<input type="hidden" name="tot_lb" id="tot_lb" value="{{$lb}}" />
					<input type="hidden" name="tot_lb_itm" id="tot_lb_itm" value="{{$lb_itm}}" />
				</div>
			</div>
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

	
	<script src="{{ asset('sximo/js/dynamitable.jquery.min.js') }}"></script>
	
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
                maxFilesize: 1024,
                params: {
                    _token: token,
					fold_id: localStorage.getItem('fold_id')
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
@stop