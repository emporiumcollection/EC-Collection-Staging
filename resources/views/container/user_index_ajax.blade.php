<?php $imgfancy = array();
	$filType = array('jpg'=>'JPEG image', 'jpeg'=>'JPEG image', 'JPG'=>'JPEG image', 'png'=>'PNG image', 'gif'=>'GIF image', 'xls'=>'Excel spreadsheet', 'eps'=>'EPS Image', 'mp4'=>'MPEG-4 video', 'mkv'=>'Matroska Video', 'flv'=>'Flash Video', 'avi'=>'Audio Video', 'wma'=>'Windows Media Audio', 'wmp'=>'Windows Media Player', 'psd'=>'PSD Image', 'pdf'=>'PDF document', 'ppt'=>'PowerPoint presentation', 'mp3'=>'MP3 audio', 'tif'=>'TIFF image', 'doc'=>'Word document', 'docx'=>'Word document', 'bmp'=>'Bitmap image', 'cad'=>'CAD image', 'zip'=>'Compress document');
 ?>
<div style="display: none;" id="get-breadcrumb">
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
</div>
						
						
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
						@if((!empty($userpermissions) && $userpermissions->download==1)
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
									@if((!empty($userpermissions) && $userpermissions->download==1)
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
					
	