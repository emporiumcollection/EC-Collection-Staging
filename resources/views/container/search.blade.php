@extends('layouts.app')

@section('content')

<link href="{{ asset('sximo/css/custom_ps.css')}}" rel="stylesheet">
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
						<?php foreach ($tree as $r) {
							echo $r;
						} ?>
					</div>
				</div>
				@if($group!=3)
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
				@endif
			</div>
			<div class="col-sm-9">
				<div class="row">
					<div class="col-sm-12">
						<button type="button" class="btn btn-success btn-lg" onclick="selectfolderfiles();" data-toggle="modal" data-target="#sendEmail">
							<span class="icn"><i class="icon-share"></i> {{\Lang::get('core.menu_share')}}</span>
						</button>
						<!-- Operation button -->
						<div class="btn-group">
						  <button type="button" class="btn btn-primary btn-lg dropdown-toggle btn_orange" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icn"><i class="icon-settings"></i> {{\Lang::get('core.menu_operations')}}</span></button>
						  <button type="button" class="btn btn-primary btn-lg dropdown-toggle btn_orange" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="caret"></span>
							<span class="sr-only">Toggle Dropdown</span>
						  </button>
						  <ul class="dropdown-menu">
							<li><a href="#" onclick="selectfolderfiles();" data-toggle="modal" data-target="#copyFolderFile">{{\Lang::get('core.menu_copy_folder_file')}}</a></li>
							<li><a href="#" onclick="selectfolderfiles();" data-toggle="modal" data-target="#moveFolderFile">{{\Lang::get('core.menu_move_folder_file')}}</a></li>
							<li><a href="#" onclick="selectfolderfiles();" data-toggle="modal" data-target="#assignAttribute">{{\Lang::get('core.menu_assign_attribute_folder_file')}}</a></li>
							<li><a href="#" onclick="selectfolderfiles();" data-toggle="modal" data-target="#assignTags">{{\Lang::get('core.menu_assign_tag_folder_file')}}</a></li>
							<li><a href="#" onclick="selectfolderfiles();" data-toggle="modal" data-target="#assignMainImage">{{\Lang::get('core.menu_assign_main_image')}}</a></li>
							<li><a href="#" onclick="select_folderfilesfor_download('file_frontend');">{{\Lang::get('core.menu_frontend')}}</a></li>
							<li><a href="#" onclick="select_folderfilesfor_download('unassign_file_frontend');">{{\Lang::get('core.menu_deactivate_frontend')}}</a></li>
							<li><a href="#" onclick="selectfolderfiles();" data-toggle="modal" data-target="#assignDesigner">{{\Lang::get('core.menu_assign_designer')}}</a></li>
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
						  </ul>
						</div>
						
					</div>
				</div>
				
				<div class="row MrgTop10">
					<div class="col-sm-12">
						@if($searchedkeyword!='')
							<p class="searchedres">Your search for "{{$searchedkeyword}}" returned {{(!empty($rowData))?count($rowData):0}} results.</p>
						@endif
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-12">
						@if($showType=="thumb")	
							<div class="gallery-select-all">
								<label style="float:left;">
									<input type="checkbox" value="1" id="check_all" class="check-all"> Select all
								</label>
								<div class="row">
									{!! Form::open(array('url'=>'containersearch', 'class'=>'columns' ,'id' =>'search', 'method'=>'get' )) !!}
										<input type="hidden" name="show" value="{{ $showType }}">
										<div class="col-sm-4">
											<input type="text" name="searchkeyword" value="{{($searchedkeyword!='')?$searchedkeyword:''}}" class="form-control" placeholder="Enter your keyword here" style="height:37px !important;" />
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
							@if(!empty($rowData))
								<div id="container_sortable">	
									@foreach($rowData as $row)
										@if($row['ftype']=='folder')
										<div class="gallery-box ui-state-default">
											<div class="caption folder">
												<a href="{{ URL::to('folders/').'/'.$row['id'].'?show='.$showType }}">{{strlen($row['name']) > 8 ? substr($row['name'],0,8)."~" : $row['name']}}</a>
												<img src="{{URL::to('uploads/images/information.png')}}" style="cursor:pointer;" class="screenshot" rel="{{($row['title']!='')?$row['title']:''}}" rel2="{{($row['description']!='')?$row['description']:''}}" title="{{$row['name']}}" />
												@if($group!=3)
													@if($row['assign_front']=='yes')
														<img src="{{URL::to('uploads/images/activated.png')}}" style="cursor:pointer; margin-left:5px;" title="Click to Deactivate" onclick="frontend_grid(this,'folder','{{$row['id']}}',1);" />
													@else
														<img src="{{URL::to('uploads/images/not_activated.png')}}" style="cursor:pointer; margin-left:5px;" title="Click to Activate" onclick="frontend_grid(this,'folder','{{$row['id']}}',0);" />
													@endif
												@endif
											</div>
											
											<?php $folderPic = ($row['cover_img']!='')? URL::to('uploads/folder_cover_imgs/thumb_'.$row['cover_img']): URL::to('uploads/images/folder_big.png');
											
												$folderPicPopup = ($row['cover_img']!='')? URL::to('uploads/folder_cover_imgs/format_'.$row['cover_img']): URL::to('uploads/images/folder_big.png');
												
												$img_name = ($row['cover_img']!='')? 'format_'.$row['cover_img']: 'folder_big.png';
											?>
											
											<div class="thumb folder" style="background: url('{{ $folderPic }}') no-repeat  center center; background-size:100px auto;" >
												<a href="{{ URL::to('folders/').'/'.$row['id'].'?show='.$showType }}" rel="{{$folderPicPopup}}" rel2="{{$img_name}}" title="{{$row['name']}}" class="screenshot">&nbsp;</a>
											</div>
											<div class="info">
												<label><input type="checkbox" name="compont[]" id="compont" value="folder-{{$row['id']}}" class="no-border check-files ff"></label>
												<div>{{$row['foldercount']}} folder</div>
												<div>{{$row['filecount']}} file</div>
											</div>
										</div>
										@else
										<div class="gallery-box ui-state-default">
											<?php $expFile = explode('.',$row['name']); 
											$imgclass = end($expFile);
											$ext = end($expFile);
											$isImg = 0;
											if($ext=="jpg" || $ext=="png" || $ext=="gif" || $ext=="bmp" || $ext=="jpeg" || $ext=="JPG") { 
												$imgclass = "img"; $isImg=1;
												$imgfancy[] = $row['imgsrc'].$row['name'];
											}
											$fname = ($row['file_display_name']!='')? $row['file_display_name']: $row['name'];
											?>
											
											<div class="caption {{$imgclass}}">
												<a href="{{ URL::to('files/view/').'/'.$row['folder_id'].'/'.$row['id'].'?show='.$showType }}" title="{{$row['name']}}">{{strlen($fname) > 8 ? substr($fname,0,5)."~.".$ext : $fname}}</a>
												<img src="{{URL::to('uploads/images/information.png')}}" style="cursor:pointer;" class="screenshot" rel="{{($row['title']!='')?$row['title']:''}}" rel2="{{($row['description']!='')?$row['description']:''}}" title="{{$fname}}" />
												@if($group!=3)
													@if($row['assign_front']=='yes')
														<img src="{{URL::to('uploads/images/activated.png')}}" style="cursor:pointer; margin-left:5px;" title="Click to Deactivate" onclick="frontend_grid(this,'file','{{$row['id']}}',1);" />
													@else
														<img src="{{URL::to('uploads/images/not_activated.png')}}" style="cursor:pointer; margin-left:5px;" title="Click to Activate" onclick="frontend_grid(this,'file','{{$row['id']}}',0);" />
													@endif
												@endif
											</div>
											<?php if($ext=="pdf")
											{
												$imgclass = "bigpdf";
											}?>
											<div class="thumb cinner{{$imgclass}}" <?php if($isImg==1) { ?> style="background: url('{{URL::to('uploads/thumbs/').'/thumb_'.$row['folder_id'].'_'.$row['name']}}') no-repeat  center center; background-size:100px auto;" <?php } ?>>
												<a href="{{ URL::to('files/view/').'/'.$row['folder_id'].'/'.$row['id'].'?show='.$showType }}" class="screenshot fancybox-buttons" rel="{{URL::to('uploads/thumbs/').'/format_'.$row['folder_id'].'_'.$row['name']}}" title="{{$fname}}" rel2="{{$fname}}" data-fancybox-group="button">
													&nbsp;
												</a>
											</div>
											<div class="info">
												<label><input type="checkbox" value="file-{{$row['id']}}-{{$ext}}" name="compont[]" id="compont" class="no-border check-files ff"></label>
												@if(($row['tiff_files']!='') && !empty($row['tiff_files']))
													<div style="border-right:none;">
													@foreach($row['tiff_files'] as $tif)
														<?php $expTif = explode('.',$tif->file_name); 
														$imgval = $expTif[1]; ?>
														<a href="{{ URL::to('tfiles/view/').'/'.$row['folder_id'].'/'.$tif->id.'?show='.$showType }}">&nbsp;&nbsp;{{strtoupper($imgval)}}&nbsp;&nbsp;</a>
													@endforeach
													</div>
												@endif
												<div class="action">
													<a href="{{$row['imgsrc'].$row['name']}}" title="Download" download="{{$row['name']}}">
														<img src="{{URL::to('uploads/images/bullet_download.png')}}" width="16" height="16" alt="Download">
													</a>
												</div>
											</div>
										</div>
										@endif
									@endforeach
								</div>
							@endif
						@elseif($showType=="list")
							<div class="gallery-select-all">
								<label style="float:left;">
									<input type="checkbox" value="1" id="check_all" class="check-all"> Select all
								</label>
								<div class="row">
									{!! Form::open(array('url'=>'search', 'class'=>'columns' ,'id' =>'search', 'method'=>'get' )) !!}
										<input type="hidden" name="show" value="{{ $showType }}">
										<div class="col-sm-4">
											<input type="text" name="searchkeyword" value="{{($searchedkeyword!='')?$searchedkeyword:''}}" class="form-control" placeholder="Enter your keyword here" style="height:37px !important;" />
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
							<table class="list js-dynamitable table table-bordered">
								<thead>
									<tr>
										<th class="check" width="5%">
											<label><input type="checkbox" value="1" id="check_all" class="check-all"></label>
										</th>
										<th width="25%">Name</th>
										<th width="5%"></th>
										<th width="5%"></th>
										<th width="20%">Title</th>
										<th width="20%">Description</th>
										<th width="15%">File Type</th>
										@if($group!=3)<th width="5%">Status</th>@endif
									</tr>
									<tr>
										<th></th>
										<th><input type="text" class="js-filter  form-control" value="" /></th>
										<th></th>
										<th></th>
										<th><input type="text" class="js-filter  form-control" value="" /></th>
										<th><input type="text" class="js-filter  form-control" value="" /></th>
										<th><input type="text" class="js-filter  form-control" value="" /></th>
										@if($group!=3)<th></th>@endif
									</tr>
								</thead>
								<tbody>
									@if(!empty($rowData))
									{{--*/ $al=1 /*--}}
										@foreach($rowData as $row)
										{{--*/ $alt = ($al%2==0)? 'alt' : ''; /*--}}
											@if($row['ftype']=='folder')
												<tr class="{{$alt}}">
													<td class="check">
														<label><input type="checkbox" name="compont[]" id="compont" value="folder-{{$row['id']}}" class="no-border check-files ff"></label>
													</td>
													<td class="rowtitle folder">
														<a href="{{ URL::to('folders/').'/'.$row['id'].'?show='.$showType }}">{{strlen($row['name']) > 22 ? substr($row['name'],0,20)."~" : $row['name']}}</a>
													</td>
													<td></td>
													<td></td>
													<td>{{($row['title']!='')?$row['title']:''}}</td>
													<td>{{($row['description']!='')?substr($row['description'],0,20):''}}</td>
													<td>Folder</td>
													@if($group!=3)
														<td style="text-align:center;">@if($row['assign_front']=='yes')
																<img src="{{URL::to('uploads/images/activated.png')}}" style="cursor:pointer; margin-left:5px;" title="Click to Deactivate" onclick="frontend_grid(this,'folder','{{$row['id']}}',1);" />
															@else
																<img src="{{URL::to('uploads/images/not_activated.png')}}" style="cursor:pointer; margin-left:5px;" title="Click to Activate" onclick="frontend_grid(this,'folder','{{$row['id']}}',0);" />
															@endif
														</td>
													@endif
												</tr>
											@else
												<?php $expFile = explode('.',$row['name']); 
												$imgclass = end($expFile);
												$ext = end($expFile);
												$isImg = 0;
												if($ext=="jpg" || $ext=="png" || $ext=="gif" || $ext=="bmp" || $ext=="jpeg" || $ext=="JPG") {
													$imgclass = "img"; $isImg=1;
													$imgfancy[] = $row['imgsrc'].$row['name'];
												}
												$fname = ($row['file_display_name']!='')? $row['file_display_name']: $row['name'];
												?>
												<tr class="{{$alt}}">
													<td class="check">
														<label><input type="checkbox" value="file-{{$row['id']}}-{{$ext}}" name="compont[]" id="compont" class="no-border check-files ff"></label>
													</td>
													<td class="rowtitle {{$imgclass}}">
														<a href="{{ URL::to('files/view/').'/'.$row['folder_id'].'/'.$row['id'].'?show='.$showType }}" title="{{$row['name']}}">{{strlen($fname) > 22 ? substr($fname,0,18)."~.".$ext : $fname}}</a>
													</td>
													<td style="text-align:center;">
														<a href="#" class="screenshot fancybox-buttons" rel="{{URL::to('uploads/thumbs/').'/format_'.$row['folder_id'].'_'.$row['name']}}" title="{{$fname}}" data-fancybox-group="button">
															<img src="{{URL::to('uploads/images/magnifier.png')}}" width="16" height="16" alt="Preview">
														</a>
													</td>
													<td style="text-align:center;">
														<a href="{{$row['imgsrc'].$row['name']}}" title="Download" download="{{$row['name']}}">
															<img src="{{URL::to('uploads/images/bullet_download.png')}}" width="16" height="16" alt="Download">
														</a>
													</td>
													<td>{{($row['title']!='')?$row['title']:''}}</td>
													<td>{{($row['description']!='')?substr($row['description'],0,20):''}}</td>
													<td>{{$filType[$ext]}}</td>
													@if($group!=3)
														<td style="text-align:center;">@if($row['assign_front']=='yes')
																<img src="{{URL::to('uploads/images/activated.png')}}" style="cursor:pointer; margin-left:5px;" title="Click to Deactivate" onclick="frontend_grid(this,'file','{{$row['id']}}',1);" />
															@else
																<img src="{{URL::to('uploads/images/not_activated.png')}}" style="cursor:pointer; margin-left:5px;" title="Click to Activate" onclick="frontend_grid(this,'file','{{$row['id']}}',0);" />
															@endif
														</td>
													@endif
												</tr>
											@endif
											{{--*/ $al++ /*--}}
										@endforeach
									@endif
								</tbody>
							</table>
						@endif
					</div>
				</div>
			</div>
		</div>
    </div>

	
	<!-- Copy Folder File Modal -->
	<div class="modal fade" id="copyFolderFile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Copy selected files to:</h4>
		  </div>
		  {!! Form::open(array('url'=>'copyfolderfile', 'class'=>'columns' ,'id' =>'file_copy', 'method'=>'post' )) !!}
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType.'&searchkeyword='.$searchedkeyword }}">
		  <input type="hidden" name="selecteditems" class="selecteditems" value="">
		  <div class="modal-body">
			<fieldset>
				<div class="field">
					<label>Select folder <em>*</em></label>
					<div class="field-input">
						<select name="copy_to" class="form-control" required="required">
						<option value=""> --Select Folder-- </option>
						@foreach($seloptions as $opt)
						  <option value="<?php echo $opt["id"]; ?>"><?php echo $opt["name"]; ?></option>
						@endforeach
						</select>
					</div>
				</div>
			</fieldset>
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Copy</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- Move Folder File Modal -->
	<div class="modal fade" id="moveFolderFile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Move selected files to:</h4>
		  </div>
		  {!! Form::open(array('url'=>'movefolderfile', 'class'=>'columns' ,'id' =>'file_move', 'method'=>'post' )) !!}
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType.'&searchkeyword='.$searchedkeyword }}">
		  <input type="hidden" name="selecteditems" class="selecteditems" value="">
		  <div class="modal-body">
			<fieldset>
				<div class="field">
					<label>Select folder <em>*</em></label>
					<div class="field-input">
						<select name="move_to" class="form-control" required="required">
						<option value=""> --Select Folder-- </option>
						@foreach($seloptions as $opt)
						  <option value="<?php echo $opt["id"]; ?>"><?php echo $opt["name"]; ?></option>
						@endforeach
						</select>
					</div>
				</div>
			</fieldset>
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Move</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
		
	<!-- Selected Files/Folder downloaded as Zip Archive -->
	{!! Form::open(array('url'=>'seletedfileszip', 'class'=>'columns' ,'id' =>'file_download', 'method'=>'post' )) !!}
		<input type="hidden" name="selectedfiles" class="selectedfiles" value="">
		<input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType.'&searchkeyword='.$searchedkeyword }}">
	</form>
	
	<!-- Selected Files in Flip book -->
	{!! Form::open(array('url'=>'makeflipbook', 'class'=>'columns' ,'id' =>'flipbook', 'method'=>'post' )) !!}
		<input type="hidden" name="selectedfiles" class="selectedfiles" value="">
		<input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType.'&searchkeyword='.$searchedkeyword }}">
		<input type="hidden" name="fliptype" id="fliptype" value="high">
	</form>
	
		
	<!-- Assign Attributes Folder File Modal -->
	<div class="modal fade" id="assignAttribute" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Assign attributes to selected files: <span style="float: right;margin-right: 10px;"><a href="{{URL::to('attributes/update')}}" target="_blank" >Create new attribute</a></span></h4>
			
		  </div>
		  {!! Form::open(array('url'=>'assignAttribute', 'class'=>'columns form-horizontal' ,'id' =>'assign_attribute', 'method'=>'post', 'files'=>true )) !!}
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType.'&searchkeyword='.$searchedkeyword }}">
		  <input type="hidden" name="selecteditems" class="selecteditems" value="">
		  <div class="modal-body">
			<fieldset>
				<div class="form-group repeatAttr1">
					<label class="col-md-2">Attributes <span class="asterix"> * </span></label>
					<div class="col-md-8">
						<div class="row mainattr1 MrgBot10">
							<div class="col-md-12">
								<select name="assigned_attributes[]" id="assigned_attributes1" class="form-control" required="required" onchange="customOptions(this.value, 1);">
									<option value=""> --Select-- </option>
									@if(!empty($sel_attributes))
										@foreach($sel_attributes as $attr)
										  <option value="<?php echo $attr->attr_type .'-'.$attr->id .'-'.$attr->attr_cat; ?>"><?php echo $attr->attr_title; ?></option>
										@endforeach
									@endif
								</select>
							</div>
						</div>
						<div class="row" id="custmOpt1" style="display:none;">
							<div class="col-md-12">
								<div class="row attrf">
									&nbsp;
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-2 mainButt">
						<button type="button" onclick="addAttribute(1)" class="btn btn-success MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add More" id="add" data-original-title="Add more"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
					</div>
				</div>
			</fieldset>
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Assign</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- Assign tags Folder File Modal -->
	<div class="modal fade" id="assignTags" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Assign tags to selected files:</h4>
		  </div>
		  {!! Form::open(array('url'=>'assignTags', 'class'=>'columns form-horizontal' ,'id' =>'assign_tags', 'method'=>'post', 'files'=>true )) !!}
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType.'&searchkeyword='.$searchedkeyword }}">
		  <input type="hidden" name="selecteditems" class="selecteditems" value="">
		  <div class="modal-body">
			<fieldset>
				<div class="form-group">
					<div class="col-md-7">
						<div class="row">
							<div class="col-md-12">
								<h4 class="modal-title">Add New Tag <small>(Add multiple tags seperated by comma(s).)</small></h4>
							</div>
							<div class="col-md-12 MrgTop10">
								<label class=" control-label col-md-4 text-left">Tag Title<em>*</em></label>
								<div class="field-input col-md-8">
									 {!! Form::text('tag_title', '',array('class'=>'form-control', 'placeholder'=>'', 'id'=>'tag_title'   )) !!}
								</div>
							</div>
							<div class="col-md-12 MrgTop10">
								<label class="col-sm-4 text-right">&nbsp;</label>
								<div class="col-sm-8">	
									<button type="button" name="newtag" class="btn btn-primary btn-sm" onclick="addnewTag();" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
								</div>
						  </div>
						</div>
					</div>
					<div class="col-md-5" style="border-left:1px solid #000;">
						<div class="row">
							<div class="col-md-12">
								<h4 class="modal-title">Search Tags</h4>
							</div>
							<div class="col-md-12 MrgTop10">
								<input type="text" name="searchtag" id="searchtag" value="" onkeyup="searchTags(this);" onkeydown="searchTags(this);" />
							</div>
							<div class="col-md-12 MrgTop10">
								<h4 class="modal-title">Tag List</h4>
							</div>
							<div class="col-md-12 MrgTop10 taglist">
							@if(!empty($sel_tags))
								@foreach($sel_tags as $tag)
									<div class="field-input MrgBot10">
										<input type="checkbox" value="{{$tag->id}}" name="selTag[]" id="{{$tag->id}}"> <label for="{{$tag->id}}">&nbsp;{{$tag->tag_title}}</label>
									</div>
								@endforeach
							@endif
							</div>
						</div>
						
					</div>
				</div>
			</fieldset>
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Assign Tag</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- Assign Main Image Folder Modal -->
	<div class="modal fade" id="assignMainImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Assign Main Image:</h4>
		  </div>
		  {!! Form::open(array('url'=>'assignMainImage', 'class'=>'columns' ,'id' =>'assignMainImage', 'method'=>'post', 'files'=>true )) !!}
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType.'&searchkeyword='.$searchedkeyword }}">
		  <input type="hidden" name="selecteditems" class="selecteditems" value="">
		  <div class="modal-body">
			<fieldset>
				<div class="form-group">
					<div class="col-md-6">
						<h4 class="modal-title MrgBot10">IF Image Selected:</h4>
						<label>Select folder <em>*</em></label>
						<div class="field-input">
							<select name="cover_fold" class="form-control">
							<option value=""> --Select Folder-- </option>
							@foreach($seloptions as $opt)
							  <option value="<?php echo $opt["id"]; ?>"><?php echo $opt["name"]; ?></option>
							@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-6" style="border-left:1px solid #000;">
						<h4 class="modal-title MrgBot10">IF Folder Selected:</h4>
						<label>Upload Image <em>*</em></label>
						<div class="field-input">
							<input type="file" name="main_img" class="form-control" />
						</div>
					</div>
				</div>
			</fieldset>
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Assign</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- Selected Files/Folder as frontend -->
	{!! Form::open(array('url'=>'seletedfilesfrontend', 'class'=>'columns' ,'id' =>'file_frontend', 'method'=>'post' )) !!}
		<input type="hidden" name="selectedfiles" class="selectedfiles" value="">
		<input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType.'&searchkeyword='.$searchedkeyword }}">
	</form>
	
	<!-- UNassign Selected Files/Folder as frontend -->
	{!! Form::open(array('url'=>'unassign_seletedfilesfrontend', 'class'=>'columns' ,'id' =>'unassign_file_frontend', 'method'=>'post' )) !!}
		<input type="hidden" name="selectedfiles" class="selectedfiles" value="">
		<input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType.'&searchkeyword='.$searchedkeyword }}">
	</form>
	
	<!-- Assign Designer Modal -->
	<div class="modal fade" id="assignDesigner" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Assign Designer:</h4>
		  </div>
		  {!! Form::open(array('url'=>'assignDesigner', 'class'=>'columns' ,'id' =>'assignDesigner', 'method'=>'post' )) !!}
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType.'&searchkeyword='.$searchedkeyword }}">
		  <input type="hidden" name="selecteditems" class="selecteditems" value="">
		  <div class="modal-body">
			<fieldset>
				<div class="form-group">
					<label>Select Designer <em>*</em></label>
					<div class="field-input">
						<select name="designer" class="form-control" required="required">
						<option value=""> --Select Designer-- </option>
							@if(!empty($sel_designer))
								@foreach($sel_designer as $designr)
									<option value="{{$designr->id}}">{{$designr->designer_name}}</option>
								@endforeach
							@endif
						</select>
					</div>					
				</div>
			</fieldset>
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Assign</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- Send Email Modal -->
	<div class="modal fade" id="sendEmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">SHARE</h4>
		  </div>
		  {!! Form::open(array('url'=>'sendemail_flipbook', 'class'=>'columns' ,'id' =>'send_email', 'method'=>'post' )) !!}
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType.'&searchkeyword='.$searchedkeyword }}">
		  <input type="hidden" name="fold_id" value="{{$fid}}">
		  <input type="hidden" name="selecteditems" class="selecteditems" id="share_selecteditems" value="">
		  <div class="modal-body">
			<fieldset>
				<div class="form-group">
					<label>{{ Lang::get('core.fr_emailtype') }} <em>*</em> </label>
					<div class="field-input">
						<input type="checkbox" value="download" name="emailType[]" id="displaydown" checked="checked"> Download links &nbsp;
						<input type="checkbox" value="slideshow" name="emailType[]"> Show slideshow of images &nbsp;
						<input type="checkbox" value="flipbook" name="emailType[]" id="displayres"> View flipbook &nbsp;
						
					</div>
				</div>
				<div class="form-group" id="dltype">
					<div class="field-input">
						<input type="radio" value="zip-zip" name="downType" checked="checked" required> Download as Zip archive.&nbsp;
						<input type="radio" value="pdf-high" name="downType" required> Download as PDF high res.
						<input type="radio" value="pdf-low" name="downType" required> Download as PDF low res.&nbsp;
					</div>
				</div>
				<div class="form-group" id="fltype" style="display:none;">
					<div class="field-input">
						<input type="radio" value="high" name="flipType" checked="checked" required> Flipbook as high res.&nbsp;
						<input type="radio" value="low" name="flipType" required> Flipbook as low res.
						
					</div>
				</div>
				<div class="form-group">
					<label>{{ Lang::get('core.fr_emailto') }} <em>*</em></label>
					<div class="field-input">
						<input type="hidden" name="emailids" id="enteremail" class="form-control" style="padding:0;" value="" >
						
					</div>
				</div>
				<div class="form-group">
					<label>{{ Lang::get('core.fr_emailsubject') }} <em>*</em></label>
					<div class="field-input">
						{!! Form::text('subject',null,array('class'=>'form-control', 'placeholder'=>'','required'=>'true')) !!}
					</div>
				</div>
				<div class="form-group">
					<label>{{ Lang::get('core.fr_emailtemplate') }} <em>*</em></label>
					<div class="field-input">
						<select name="emailTemplate" class="form-control" required="required">
							<option value=""> --Select -- </option>
							<option value="container_template1"> Template One </option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label>{{ Lang::get('core.fr_emailmessage') }}<em>*</em></label>
					<div class="field-input">
						<textarea class="form-control editor" rows="15" required name="message">
							
						</textarea>
					</div>
				</div>
			</fieldset>
		  </div>
		  <div class="modal-footer">
			<span id="sharemasage" style="color:red; font-weight:bold; float:left;"></span>
			<button type="submit" class="btn btn-primary" onclick="return check_selecteditems();">SHARE</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<script>
		$(function(){
			var fid = '<?php echo $fid; ?>';
			$('.parent'+fid).parents().show();
			$('.parent'+fid).show();
			
			$("#enteremail").select2({
			  tags: [
			  <?php if(!empty($crmusers)) { foreach($crmusers as $emailOBJ){
					
					echo '"'.$emailOBJ->Email .'",';
					
			  } }	?>
			  ],
			  tokenSeparators: [',', ' ']
			});
			
			
			$('input[type="checkbox"][id="displayres"]').on('ifChecked', function(){
				$("#fltype").show();
			});
			
			$('input[type="checkbox"][id="displayres"]').on('ifUnchecked', function(){
				$("#fltype").hide();
			});
			
			$('input[type="checkbox"][id="displaydown"]').on('ifChecked', function(){
				$("#dltype").show();
			});
			
			$('input[type="checkbox"][id="displaydown"]').on('ifUnchecked', function(){
				$("#dltype").hide();
			});
			
			$('input[type="checkbox"][id="check_all"]').on('ifChecked', function(){
				$('input[type="checkbox"].ff').iCheck('check');
			});
			
			$('input[type="checkbox"][id="check_all"]').on('ifUnchecked', function(){
				$('input[type="checkbox"].ff').iCheck('uncheck');
			});
			
			<?php if($fid>0) { ?>
			$("#fancybox-manual-c").click(function() {
				$.fancybox.open([
					<?php foreach($imgfancy as $imgOBJ){
					
					echo '{href:'.'"'.$imgOBJ.'"},';
					
				}	?>
				], {
					helpers : {
						buttons	: {},
						overlay: { closeClick: false }
					}
				});
			});
			<?php } ?>
		});
		
		function selectfolderfiles()
		{
			$('.selecteditems').val('');
			var sList = "";
			$('input[type=checkbox].ff').each(function () {
				if(this.checked)
				{
					sList += (sList=="" ? $(this).val() : "," + $(this).val());
				}
				
			});
			$('.selecteditems').val(sList);
		}
		
		function select_folderfilesfor_download(formId, typ)
		{
			var sList = "";
			$('input[type=checkbox].ff').each(function () {
				if(this.checked)
				{
					sList += (sList=="" ? $(this).val() : "," + $(this).val());
				}
				
			});
			$('.selectedfiles').val(sList);
			$('#fliptype').val(typ);
			$( "#"+formId ).submit();
			
		}
		
		function customOptions(objVal, indx)
		{
			var str = '';
			var str_sel = '';
			if(objVal!='')
			{
				var exp_val = objVal.split("-");
				if(exp_val[0]=='dropdown' || exp_val[0]=='radio' || exp_val[0]=='checkboxes')
				{
					$('.repeatAttr'+indx+' div.seloption').remove();
					$.ajax({
					  url: "{{ URL::to('getAttributeOptions')}}",
					  type: "post",
					  data: "attr_id="+exp_val[1],
					  dataType: "json",
					  success: function(data){
						if(data!='error')
						{
							str_sel += '<div class="row MrgBot10 seloption">';
							str_sel += '<div class="col-md-12">';
							str_sel += '<select name="selected_attributes['+exp_val[1]+'][]" class="js-example-basic-multiple'+indx+'"  required="required" multiple="multiple" style="width:100%">';
							$.each(data, function(idx, obj) {
								str_sel += '<option value="'+obj.id+'">'+obj.option_name+'</option>';
							});
							str_sel += '</select>';
							str_sel += '</div>';
							str_sel += '</div>';
							$('.mainattr'+indx).after(str_sel);
							$(".js-example-basic-multiple"+indx).select2();
						}
					  }
					});
					
					var cls = 'col-md-5';
					if(exp_val[2]=='Materialien')
					{
						cls = 'col-md-3';
					}
					str += '<div class="clone'+indx+'">';
					str += '<div class="'+cls+'">';
					str += '<input type="text" name="opt_values['+exp_val[1]+'][]" value="" placeholder="Value" class="form-control">';
					str += '</div>';
					str += '<div class="'+cls+'">';
					str += '<input type="text" name="opt_name['+exp_val[1]+'][]" value="" placeholder="Display Name" class="form-control">';
					str += '</div>';
					if(exp_val[2]=='Materialien')
					{
						str += '<div class="col-md-4">';
						str += '<input type="file" name="opt_imgs['+exp_val[1]+'][]" class="form-control">';
						str += '</div>';
					}
					str += '<div class="col-md-2 butt">';
					str += '<button type="button" onclick="addItem('+indx+', '+indx+')" class="btn btn-success MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add More" id="add" data-original-title="Add more"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>';
					str += '</div>';
					str += '</div>';
				}
				else if(exp_val[0]=='text')
				{
					$('.repeatAttr'+indx+' div.seloption').remove();
					str += '<div class="col-md-12"><input type="text" name="assigned_text['+exp_val[1]+']" value="" class="form-control" required /></div>';
				}
				else if(exp_val[0]=='textarea')
				{
					$('.repeatAttr'+indx+' div.seloption').remove();
					str += '<div class="col-md-12"><textarea name="assigned_textarea['+exp_val[1]+']" class="form-control" required></textarea></div>';
				}
				else if(exp_val[0]=='file')
				{
					$('.repeatAttr'+indx+' div.seloption').remove();
					str += '<div class="clone'+indx+'">';
					str += '<div class="col-md-10"><input type="file" name="assigned_file['+exp_val[1]+'][]" class="form-control" required="required" /></div>';
					str += '<div class="col-md-2 butt">';
					str += '<button type="button" onclick="addItem('+indx+', '+indx+')" class="btn btn-success MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add More" id="add" data-original-title="Add more"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>';
					str += '</div>';
					str += '</div>';
					//str += '<div class="col-md-12"><input type="file" name="assigned_file['+exp_val[1]+']" class="form-control" required /></div>';
				}
				$('#custmOpt'+indx+' .attrf').html(str);
				$('#custmOpt'+indx).show();
			}
			else
			{
				$('#custmOpt'+indx+' .attrf').html('');
				$('.repeatAttr'+indx+' div.seloption').remove();
				$('#custmOpt'+indx).hide();
			}
		}
		
		function addItem(id, mainid)
		{
			if(id!="")
			{
				$('.repeatAttr'+mainid+' .clone'+id+' .butt button').remove();
				var remBut = '<button type="button" onclick="removeItem('+id+')" class="btn btn-danger MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Remove" data-original-title="Remove"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> </button>';
				$('.repeatAttr'+mainid+' .clone'+id+' .butt').append(remBut);
				var newid = parseInt(id) + 1;
				var cls = 'col-md-5';
				var attrId = $('.repeatAttr'+mainid+' #assigned_attributes'+mainid).val();
				var exp_attrId = attrId.split("-");
				if(exp_attrId[0]=="file")
				{
					var html = '<div class="clone'+newid+'">';
					html += '<div class="col-md-10"><input type="file" name="assigned_file['+exp_attrId[1]+'][]" class="form-control" required="required" /></div>';
				}
				else{
					var title = $('.repeatAttr'+mainid+' #assigned_attributes'+mainid+' option:selected').text();
					if(exp_attrId[0]=='Materialien')
					{
						cls = 'col-md-3';
					}
					var html = '<div class="clone'+newid+'">';
					html += '<div class="'+cls+'">';
					html += '<input type="text" name="opt_values['+exp_attrId[1]+'][]" value="" placeholder="Value" class="form-control">';
					html += '</div>';
					html += '<div class="'+cls+'">';
					html += '<input type="text" name="opt_name['+exp_attrId[1]+'][]" value="" placeholder="Display Name" class="form-control">';
					html += '</div>';
					if(exp_attrId[0]=='Materialien')
					{
						html += '<div class="col-md-4">';
						html += '<input type="file" name="opt_imgs['+exp_attrId[1]+'][]" class="form-control">';
						html += '</div>';
					}
				}
				
				html += '<div class="col-md-2 butt">';
				html += '<button type="button" onclick="addItem('+newid+', '+mainid+')" class="btn btn-success MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add More" id="add" data-original-title="Add more"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>';
				html += '</div>';
				html += '</div>';
				$('.repeatAttr'+mainid+' .clone'+id).after(html);
			}
		}
		
		function removeItem(id)
		{
			if(id!="")
			{
				$('.clone'+id).remove();
			}
		}
		
		function addAttribute(id, mainid)
		{
			if(id!="")
			{
				$('.repeatAttr'+id+' .mainButt button').remove();
				var remBut = '<button type="button" onclick="removeAttributes('+id+')" class="btn btn-danger MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Remove" data-original-title="Remove"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> </button>';
				$('.repeatAttr'+id+' .mainButt').append(remBut);
				var newid = parseInt(id) + 1;
				
				var html = '';
				html += '<div class="form-group repeatAttr'+newid+'">';
				html += '<label class="col-md-2">Attributes <span class="asterix"> * </span></label>';
				html += '<div class="col-md-8">';
				html += '<div class="row mainattr'+newid+' MrgBot10">';
				html += '<div class="col-md-12">';
				html += '<select name="assigned_attributes[]" id="assigned_attributes'+newid+'" class="form-control" required="required" onchange="customOptions(this.value, '+newid+');">';
				html += '<option value=""> --Select-- </option>';
				<?php if(!empty($sel_attributes)) {
						foreach($sel_attributes as $attr) { ?>
							html += '<option value="<?php echo $attr->attr_type .'-'.$attr->id .'-'.$attr->attr_cat; ?>"><?php echo $attr->attr_title; ?></option>';
					<?php	}
					}
				?>
				html += '</select>';
				html += '</div>';
				html += '</div>';
				html += '<div class="row" id="custmOpt'+newid+'" style="display:none;">';
				html += '<div class="col-md-12">';
				html += '<div class="row attrf">&nbsp;</div>';
				html += '</div>';
				html += '</div>';
				html += '</div>';
				html += '<div class="col-md-2 mainButt">';
				html += '<button type="button" onclick="addAttribute('+newid+')" class="btn btn-success MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add More" id="add" data-original-title="Add more"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>';
				html += '</div>';
				html += '</div>';
				
				$('.repeatAttr'+id).after(html);
			}
		}
		
		function removeAttributes(id)
		{
			if(id!="")
			{
				$('.repeatAttr'+id).remove();
			}
		}
		
		function addnewTag()
		{
			var newtag = $.trim($("#tag_title").val());
			if(newtag!='')
			{
				$.ajax({
				  url: "{{ URL::to('addnewtag')}}",
				  type: "post",
				  data: 'addtag='+newtag,
				  dataType: "json",
				  success: function(data){
					if(data!='error')
					{
						var tagstr = '';
						$.each(data, function(idx, obj) {
							tagstr += '<div class="field-input MrgBot10"><input type="checkbox" value="'+obj.id+'" name="selTag[]" id="'+obj.id+'"> <label for="'+obj.id+'">&nbsp;'+obj.tag_title+'</label></div>';
						});
						$('.taglist').html(tagstr);
						$('.taglist').find('input[type="checkbox"]').iCheck({checkboxClass: 'icheckbox_square-green'});
						$("#tag_title").val('');
					}
				  }
				});
			}
		}
		
		function searchTags(keyword)
		{
			var keywordtag = $.trim($(keyword).val());
			if(keywordtag!='')
			{
				$.ajax({
				  url: "{{ URL::to('search_exist_tag')}}",
				  type: "post",
				  data: 'keyword_tag='+keywordtag,
				  dataType: "json",
				  success: function(data){
					if(data!='error')
					{
						var tagstr = '';
						$.each(data, function(idx, obj) {
							tagstr += '<div class="field-input MrgBot10"><input type="checkbox" value="'+obj.id+'" name="selTag[]" id="'+obj.id+'"> <label for="'+obj.id+'">&nbsp;'+obj.tag_title+'</label></div>';
						});
						$('.taglist').html(tagstr);
						$('.taglist').find('input[type="checkbox"]').iCheck({checkboxClass: 'icheckbox_square-green'});
					}
				  }
				});
			}
		}
		
		function frontend_grid(img,cont_type,cont_id,act)
		{
			if(cont_id!='' && cont_id>0)
			{
				$.ajax({
				  url: "{{ URL::to('activate_deactivate_product_frontend')}}",
				  type: "post",
				  data: 'cont_type='+cont_type+'&cont_id='+cont_id+'&action='+act,
				  success: function(data){
					if(data!='error')
					{
						if(act==0)
						{
							$(img).attr("src","{{URL::to('uploads/images/activated.png')}}");
							$(img).attr("onclick","frontend_grid(this,'"+cont_type+"','"+cont_id+"',1)");
							$(img).attr("title","Click to Deactivate");
						}
						else if(act==1)
						{
							$(img).attr("src","{{URL::to('uploads/images/not_activated.png')}}");
							$(img).attr("onclick","frontend_grid(this,'"+cont_type+"','"+cont_id+"',0)");
							$(img).attr("title","Click to Activate");
						}
					}
				  }
				});
			}
		}
		
		function check_selecteditems()
		{
			var selecteditems = $('#share_selecteditems').val();
			if(selecteditems!="")
			{
				if (selecteditems.indexOf("file") >= 0)
				{
					return true;
				}
				else
				{
					$('#sharemasage').html('Please select only files.');
					return false;
				}
			}
			else
			{
				$('#sharemasage').html('Please select files first.');
				return false;
			}
		}
			 
	</script>
	<script src="{{ asset('sximo/js/dynamitable.jquery.min.js') }}"></script>
@stop