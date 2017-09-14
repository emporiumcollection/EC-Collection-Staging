<?php $imgfancy = array();
	$filType = array('jpg'=>'JPEG image', 'jpeg'=>'JPEG image', 'JPG'=>'JPEG image', 'png'=>'PNG image', 'gif'=>'GIF image', 'xls'=>'Excel spreadsheet', 'eps'=>'EPS Image', 'mp4'=>'MPEG-4 video', 'mkv'=>'Matroska Video', 'flv'=>'Flash Video', 'avi'=>'Audio Video', 'wma'=>'Windows Media Audio', 'wmp'=>'Windows Media Player', 'psd'=>'PSD Image', 'pdf'=>'PDF document', 'ppt'=>'PowerPoint presentation', 'mp3'=>'MP3 audio', 'tif'=>'TIFF image', 'doc'=>'Word document', 'docx'=>'Word document', 'bmp'=>'Bitmap image', 'cad'=>'CAD image', 'zip'=>'Compress document');
 ?>
<div class="row">
					<div class="col-sm-12">
						<button type="button" class="btn btn-success btn-lg" onclick="selectfolderfiles();" data-toggle="modal" data-target="#sendEmail">
						  <span class="icn"><i class="icon-share"></i> {{\Lang::get('core.menu_share')}}</span>
						</button>
						@if((!empty($userpermissions) && $userpermissions->upload==1) || (!empty($foldername) && $foldername->global_permission==1))
						<button type="button" class="btn btn-primary btn-lg btn_orange" data-toggle="modal" data-target="#newDirectory">
						  <span class="icn"><i class="icon-folder-plus"></i> {{\Lang::get('core.menu_new_folder')}}</span>
						</button>
						@endif
						@if(((!empty($userpermissions) && ($userpermissions->upload==1 || $userpermissions->delete==1))) || (!empty($foldername) && $foldername->global_permission==1))
						<!-- Operation button -->
						<div class="btn-group">
						  <button type="button" class="btn btn-primary btn-lg dropdown-toggle btn_orange" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icn"><i class="icon-settings"></i> {{\Lang::get('core.menu_operations')}}</span></button>
						  <button type="button" class="btn btn-primary btn-lg dropdown-toggle btn_orange" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="caret"></span>
							<span class="sr-only">Toggle Dropdown</span>
						  </button>
						  <ul class="dropdown-menu">
							@if((!empty($userpermissions) && $userpermissions->upload==1) || (!empty($foldername) && $foldername->global_permission==1))
							<li><a href="#" onclick="selectfolderfiles_copy_move_fun();" data-toggle="modal" data-target="#copyFolderFile">{{\Lang::get('core.menu_copy_folder_file')}}</a></li>
							@endif
							@if((!empty($userpermissions) && $userpermissions->delete==1) || (!empty($foldername) && $foldername->global_permission==1))
							<li><a href="#" onclick="selectfolderfiles_copy_move_fun();" data-toggle="modal" data-target="#moveFolderFile">{{\Lang::get('core.menu_move_folder_file')}}</a></li>
							<li><a href="#" onclick="selectfolderfiles();" data-toggle="modal" data-target="#deleteFolderFile">{{\Lang::get('core.menu_delete_folder_file')}}</a></li>
							@endif
						  </ul>
						</div>
						@endif
						
						@if((!empty($userpermissions) && $userpermissions->upload==1) || (!empty($foldername) && $foldername->global_permission==1))
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
						@endif
						
						@if((!empty($userpermissions) && $userpermissions->download==1) || (!empty($foldername) && $foldername->global_permission==1))
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
						@endif
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12"> 
 
 

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
								<em> &bull; {{$subfilestotal}} files &bull; {{$subfoldertotal}} folders &bull; {{$subfileSpace}} MB</em>
							</h2>
						@else
							<h2 class="folder">
								<span id="folder_name">Files</span>
								<em> &bull; {{$subfoldertotal}} folders</em>
							</h2>
						@endif

						
						
	@if($showType=="thumb")	
		
		@if(!empty($rowData))
			<div id="container_sortable">
			@foreach($rowData as $row)
				@if($row['ftype']=='folder')
				<div class="gallery-box">
					<div class="caption folder">
						<a data-action-open="folder" rel_row="{{$row['id']}}" href="{{ URL::to('getFolderListAjax/').'/'.$row['id'].'?show='.$showType }}">{{(strlen($row['name']) > 8) ? substr($row['name'],0,8)."~" : $row['name']}}</a>
						<img src="{{URL::to('uploads/images/information.png')}}" style="cursor:pointer;" class="screenshot" rel="{{($row['title']!='')?$row['title']:''}}" rel2="{{($row['description']!='')?$row['description']:''}}" title="{{$row['name']}}" />
					</div>
					<?php $folderPic = ($row['cover_img']!='')? URL::to('uploads/folder_cover_imgs/thumb_'.$row['cover_img']): URL::to('uploads/images/folder_big.png');
					
						$folderPicPopup = ($row['cover_img']!='')? URL::to('uploads/folder_cover_imgs/format_'.$row['cover_img']): URL::to('uploads/images/folder_big.png');
							
						$img_name = ($row['cover_img']!='')? 'format_'.$row['cover_img']: 'folder_big.png';	

					?>
					
					<div class="thumb folder" style="background: url('{{ $folderPic }}') no-repeat  center center; background-size:100px auto;">
						<a data-action-open="folder" rel_row="{{$row['id']}}" href="{{ URL::to('getFolderListAjax/').'/'.$row['id'].'?show='.$showType }}" rel="{{$folderPicPopup}}" rel2="{{$img_name}}" title="{{$row['name']}}" class="screenshot">&nbsp;</a>
					</div>
					<div class="info">
						<label><input type="checkbox" name="compont[]" id="compont" value="folder-{{$row['id']}}" class="no-border check-files"></label>
						<div>{{$row['filecount']}} files</div>
					</div>
				</div>
				@else
				<div class="gallery-box">
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
						<a data-action-open="file" rel_row="{{$row['id']}}" rel_fid="{{$fid}}" href="{{ URL::to('files/view/').'/'.$fid.'/'.$row['id'].'?show='.$showType }}" title="{{$row['name']}}">{{strlen($row['name']) > 8 ? substr($row['name'],0,5)."~.".$expFile[1] : $row['name']}}</a>
						<img src="{{URL::to('uploads/images/information.png')}}" style="cursor:pointer;" class="screenshot" rel="{{($row['title']!='')?$row['title']:''}}" rel2="{{($row['description']!='')?$row['description']:''}}" title="{{$fname}}" />
					</div>
					<?php if($expFile[1]=="pdf")
					{
						$imgclass = "bigpdf";
					}?>
					<div class="thumb cinner{{$imgclass}}" <?php if($isImg==1) { ?> style="background: url('{{URL::to('uploads/thumbs/').'/thumb_'.$fid.'_'.$row['name']}}') no-repeat  center center; background-size:100px auto;" <?php } ?>>
						<a data-action-open="file" rel_row="{{$row['id']}}" rel_fid="{{$fid}}" href="{{ URL::to('files/view/').'/'.$fid.'/'.$row['id'].'?show='.$showType }}" class="screenshot fancybox-buttons" rel="{{URL::to('uploads/thumbs/').'/medium_'.$row['name']}}" title="{{$row['name']}}" rel2="{{$fname}}" data-fancybox-group="button">
							&nbsp;
						</a>
					</div>
					<div class="info">
						<label><input type="checkbox" value="file-{{$row['id']}}" name="compont[]" id="compont" class="no-border check-files"></label>
						@if(($row['tiff_files']!='') && !empty($row['tiff_files']))
							<div style="border-right:none;">
							@foreach($row['tiff_files'] as $tif)
								<?php $expTif = explode('.',$tif->file_name); 
								$imgval = $expTif[1]; ?>
								<a data-action-open="file" rel_row="{{$tif->id}}" rel_fid="{{$fid}}" href="{{ URL::to('tfiles/view/').'/'.$fid.'/'.$tif->id.'?show='.$showType }}">&nbsp;&nbsp;{{strtoupper($imgval)}}&nbsp;&nbsp;</a>
							@endforeach
							</div>
						@endif
						<div class="action">
						@if((!empty($userpermissions) && $userpermissions->download==1))
							<a href="{{$row['imgsrc'].$row['name']}}" title="Download" download="{{$row['name']}}">
								<img src="{{URL::to('uploads/images/bullet_download.png')}}" width="16" height="16" alt="Download">
							</a>
						@endif
						</div>
					</div>
				</div>
				@endif
			@endforeach
			</div>
		@endif
	@elseif($showType=="list")
		
		<table class="list">
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
					<th width="20%">File Type</th>
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
									<a data-action-open="folder" rel_row="{{$row['id']}}" href="{{ URL::to('folders/').'/'.$row['id'].'?show='.$showType }}">{{strlen($row['name']) > 22 ? substr($row['name'],0,20)."~" : $row['name']}}</a>
								</td>
								<td></td>
								<td></td>
								<td>{{($row['title']!='')?$row['title']:''}}</td>
								<td>{{($row['description']!='')?substr($row['description'],0,20):''}}</td>
								<td>Folder</td>
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
									<label><input type="checkbox" value="file-{{$row['id']}}-{{$expFile[1]}}" name="compont[]" id="compont" class="no-border check-files ff"></label>
								</td>
								<td class="rowtitle {{$imgclass}}">
									<a data-action-open="file" rel_row="{{$row['id']}}" rel_fid="{{$fid}}" href="{{ URL::to('files/view/').'/'.$fid.'/'.$row['id'].'?show='.$showType }}" title="{{$row['name']}}">{{strlen($fname) > 22 ? substr($fname,0,18)."~.".$expFile[1] : $fname}}</a>
								</td>
								<td style="text-align:center;">
									<a href="#" class="screenshot fancybox-buttons" rel="{{URL::to('uploads/thumbs/').'/format_'.$fid.'_'.$row['name']}}" title="{{$fname}}" data-fancybox-group="button">
										<img src="{{URL::to('uploads/images/magnifier.png')}}" width="16" height="16" alt="Preview">
									</a>
								</td>
								<td style="text-align:center;">
									@if((!empty($userpermissions) && $userpermissions->download==1))
										<a href="{{$row['imgsrc'].$row['name']}}" title="Download" download="{{$row['name']}}">
											<img src="{{URL::to('uploads/images/bullet_download.png')}}" width="16" height="16" alt="Download">
										</a>
									@endif
								</td>
								<td>{{($row['title']!='')?$row['title']:''}}</td>
								<td>{{($row['description']!='')?substr($row['description'],0,20):''}}</td>
								<td>{{$filType[$ext]}}</td>
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

<div id="allmodal">
<!-- New Folder Modal -->
	<div class="modal fade" id="newDirectory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Create new folder</h4>
		  </div>
		  {!! Form::open(array('url'=>'addfolder', 'class'=>'columns' ,'id' =>'folder_new', 'method'=>'post' )) !!}
		  <input type="hidden" name="fold_id" value="{{$fid}}">
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
		  <input type="hidden" name="administrator_id" value="@if(!empty($foldername)){{ $foldername->user_id }}@endif">
		  <div class="modal-body">
			<fieldset>
				<div class="field">
					<label>Folder name <em>*</em></label>
					<div class="field-input">
						<input name="folder" type="text" size="30" value="" required="required">
					</div>
				</div>
			</fieldset>
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Create Folder</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- Edit Folder Modal -->
	<div class="modal fade" id="editDirectory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Edit this folder <span style="float:right; margin-right:10px;"> <a href="#" onclick="change_lang('dutch');">Deutsch</a> || <a href="#" onclick="change_lang('eng');">English</a></span></h4>
		  </div>
		  {!! Form::open(array('url'=>'editfolder', 'class'=>'columns' ,'id' =>'folder_edit', 'method'=>'post' )) !!}
		  <input type="hidden" name="fold_id" value="{{$fid}}">
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
		  <div class="modal-body">
			<fieldset>
				<div class="field">
					<label>Folder name <em>*</em></label>
					<div class="field-input">
						<input name="oldfolder" type="hidden" size="30" value="<?php echo ($fid>0 && !empty($foldername))? $foldername->display_name:'';?>">
						<input name="editfolder" type="text" size="30" value="<?php echo ($fid>0 && !empty($foldername))? $foldername->display_name:'';?>" required="required">
						
						<input name="editfolder_eng" class="form-control leng" type="text" size="30" value="<?php echo ($fid>0 && !empty($foldername))? $foldername->display_name_eng:'';?>" >
					</div>
				</div>
				<div class="field">
					<label>Title <em>*</em></label>
					<div class="field-input">
						<input name="folder_title" class="form-control" type="text" size="30" value="<?php echo ($fid>0 && !empty($foldername))? $foldername->title:'';?>" required="required">
						
						<input name="folder_title_eng" class="form-control leng" type="text" size="30" value="<?php echo ($fid>0 && !empty($foldername))? $foldername->title_eng:'';?>" >
					</div>
				</div>
				<div class="field">
					<label>Description <em>*</em></label>
					<div class="field-input">
						<textarea name="folder_desc" class="form-control" required="required"><?php echo ($fid>0 && !empty($foldername))? $foldername->description:'';?></textarea>
						
						<textarea name="folder_desc_eng" class="form-control leng" ><?php echo ($fid>0 && !empty($foldername))? $foldername->description_eng:'';?></textarea>
					</div>
				</div>
			</fieldset>
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Save Folder</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- Delete Folder Modal -->
	<div class="modal fade" id="deleteFolder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Delete this folder:</h4>
		  </div>
		  {!! Form::open(array('url'=>'folderdelete', 'class'=>'columns' ,'id' =>'folder_delete', 'method'=>'post' )) !!}
		  <input type="hidden" name="fold_id" value="{{$fid}}">
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
		  <div class="modal-body">
			Are you sure you want to delete the folder and all his files and subfolders?
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Delete folder</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
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
		  <input type="hidden" name="fold_id" value="{{$fid}}">
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
		  <input type="hidden" name="selecteditems" class="selecteditems" value="">
		  <input type="hidden" name="administrator_id" value="@if(!empty($foldername)){{ $foldername->user_id }}@endif">
		  <div class="modal-body">
			<fieldset>
				<div class="field">
					<label>Select folder <em>*</em></label>
					<div class="field-input">
						<select name="copy_to" class="form-control copymovefunsel" required="required">
						<option value=""> --Select Folder-- </option>
						
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
		  <input type="hidden" name="fold_id" value="{{$fid}}">
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
		  <input type="hidden" name="selecteditems" class="selecteditems" value="">
		  <div class="modal-body">
			<fieldset>
				<div class="field">
					<label>Select folder <em>*</em></label>
					<div class="field-input">
						<select name="move_to" class="form-control copymovefunsel" required="required">
						<option value=""> --Select Folder-- </option>
						
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
	
	<!-- Delete Folder File Modal -->
	<div class="modal fade" id="deleteFolderFile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Delete selected files:</h4>
		  </div>
		  {!! Form::open(array('url'=>'deletefilefolder', 'class'=>'columns' ,'id' =>'file_delete', 'method'=>'post' )) !!}
		  <input type="hidden" name="fold_id" value="{{$fid}}">
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
		  <input type="hidden" name="selecteditems" class="selecteditems" value="">
		  <div class="modal-body">
			Are you sure you want to delete the selected items?
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Delete</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- Selected Files/Folder downloaded as Zip Archive -->
	{!! Form::open(array('url'=>'seletedfileszip', 'class'=>'columns' ,'id' =>'file_download', 'method'=>'post' )) !!}
		<input type="hidden" name="selectedfiles" class="selectedfiles" value="">
		<input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
	</form>
	
	<!-- Selected Files/Folder downloaded as Low PDF -->
	{!! Form::open(array('url'=>'seletedfileslowPdf', 'class'=>'columns' ,'id' =>'lowpdf_download', 'method'=>'post' )) !!}
		<input type="hidden" name="selectedfiles" class="selectedfiles" value="">
		<input type="hidden" name="fold_id" value="{{$fid}}">
		<input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
	</form>
	
	<!-- Selected Files/Folder downloaded as High PDF -->
	{!! Form::open(array('url'=>'seletedfileshighPdf', 'class'=>'columns' ,'id' =>'highpdf_download', 'method'=>'post' )) !!}
		<input type="hidden" name="selectedfiles" class="selectedfiles" value="">
		<input type="hidden" name="fold_id" value="{{$fid}}">
		<input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
	</form>
	
	<!-- Entire Folder downloaded as Zip Archive -->
	{!! Form::open(array('url'=>'entirefolderzip', 'class'=>'columns' ,'id' =>'entire_download', 'method'=>'post' )) !!}
		<input type="hidden" name="fold_id" value="{{$fid}}">
		<input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
	</form>
	
	<!-- Selected Files in Flip book -->
	{!! Form::open(array('url'=>'makeflipbook', 'class'=>'columns' ,'id' =>'flipbook', 'method'=>'post' )) !!}
		<input type="hidden" name="selectedfiles" class="selectedfiles" value="">
		<input type="hidden" name="fold_id" value="{{$fid}}">
		<input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
		<input type="hidden" name="fliptype" id="fliptype" value="high">
	</form>
	
	<!-- Send Email Modal -->
	<div class="modal fade" id="sendEmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">SHARE</h4>
		  </div>
		  {!! Form::open(array('url'=>'sendemail_flipbook', 'class'=>'columns' ,'id' =>'send_email', 'method'=>'post' )) !!}
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
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
</div>				
	<script>
$(function(){
	<?php if($fid>0) { ?>
		$(document).on("click","#fancybox-manual-c", function() {
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
</script>

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
				$('input[type="checkbox"]').iCheck('check');
			});
			
			$('input[type="checkbox"][id="check_all"]').on('ifUnchecked', function(){
				$('input[type="checkbox"]').iCheck('uncheck');
			});
			
		
		
		function selectfolderfiles()
		{
			$('.selecteditems').val('');
			var sList = "";
			$('input[type=checkbox]').each(function () {
				if(this.checked)
				{
					sList += (sList=="" ? $(this).val() : "," + $(this).val());
				}
				
			});
			$('.selecteditems').val(sList);
		}
		
		function selectfolderfiles_copy_move_fun()
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
			
			if($('.copymovefunsel option').length <= 2)
			{
				$.ajax({
				  url: "{{ URL::to('getfolderlistforselectoptions')}}",
				  type: "post",
				  dataType: "json",
				  success: function(data){
					if(data!='error')
					{
						var str_sel = '';
						$.each(data, function(idx, obj) {
							str_sel += '<option value="'+obj.id+'">'+obj.name+'</option>';
						});
						
						$('.copymovefunsel').html(str_sel);
					}
				  }
				});
			}
		}
		
		function select_folderfilesfor_download(formId, typ)
		{
			var sList = "";
			$('input[type=checkbox]').each(function () {
				if(this.checked)
				{
					sList += (sList=="" ? $(this).val() : "," + $(this).val());
				}
				
			});
			
			$('.selectedfiles').val(sList);
			$('#fliptype').val(typ);
			$( "#"+formId ).submit();
			
		}
		
		function entire_folderfilesfor_download()
		{
			$( "#entire_download" ).submit();	
		}
		
		
		$( "#container_sortable" ).sortable({
				stop: function() {
				update_container_sort_num();
			  }
			});
			$( "#container_sortable" ).disableSelection();
		
		
		function update_container_sort_num()
		{
			$('#sort_num').val('');
			var fList = "";
			$('.gallery-box').each(function () {
				fList += (fList=="" ? $(this).find("input[type=checkbox].ff").val() : "," + $(this).find("input[type=checkbox].ff").val());
				
			});
			$('#sort_num').val(fList);
			
			$.ajax({
			  url: "{{ URL::to('update_container_sortnum')}}",
			  type: "post",
			  data: "items=" + $('#sort_num').val(),
			  dataType: "json",
			  success: function(data){
				if(data!='error')
				{
					console.log('sorting Done');
				}
			  }
			});
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
		});	 
	</script>