 <div style="display: none;" id="get-breadcrumb">
@if($fid>0)
	<h2 class="folder">
		<span id="folder_name">@if(!empty($foldername)){{$foldername->display_name}}@endif</span>
		<em> &bull; {{$subfilestotal}} files &bull; {{$subfoldertotal}} folders &bull; {{$subfileSpace}} MB</em>&nbsp;&nbsp;
	</h2>
@else
	<h2 class="folder">
		<span id="folder_name">Files</span>
		<em> &bull; {{$subfoldertotal}} folders</em>
	</h2>
@endif
</div>

@if(!empty($rowData))
	@foreach($rowData as $row)
		@if($row['ftype']=='folder')
		<div class="gallery-box">
			<div class="caption folder"><a href="{{ URL::to('foldersiframe/'.$row['id'].'/iframe')}}">{{strlen($row['name']) > 8 ? substr($row['name'],0,8)."~" : $row['name']}}</a></div>
			
			<?php $folderPic = ($row['cover_img']!='')? URL::to('uploads/folder_cover_imgs/thumb_'.$row['cover_img']): URL::to('uploads/images/folder_big.png');
						
				$folderPicPopup = ($row['cover_img']!='')? URL::to('uploads/folder_cover_imgs/format_'.$row['cover_img']): URL::to('uploads/images/folder_big.png');
				
				$img_name = ($row['cover_img']!='')? 'format_'.$row['cover_img']: 'folder_big.png';
			?>
			<div class="thumb folder" style="background: url('{{ $folderPic }}') no-repeat  center center; background-size:100px auto;" >
				<a  data-action-open="folder" rel_row="{{$row['id']}}" href="{{ URL::to('foldersiframe/'.$row['id'].'/iframe')}}" rel="{{$folderPicPopup}}" rel2="{{$img_name}}" title="{{$row['name']}}" class="screenshot">&nbsp;</a>
			</div>
			<div class="info">
				<div>{{$row['filecount']}} files</div>
			</div>
		</div>
		@else
		<?php $expFile = explode('.',$row['name']); 
			$imgclass = end($expFile);
			$ext = end($expFile);
			$isImg = 0;
			//if($ext=="jpg" || $ext=="png" || $ext=="gif" || $ext=="bmp" || $ext=="jpeg" || $ext=="JPG" || $ext=="pdf") { 
				$imgclass = "img"; $isImg=1;
				$imgfancy[] = $row['imgsrc'].$row['name'];
				$fname = ($row['file_display_name']!='')? $row['file_display_name']: $row['name'];
			?>
		<div class="gallery-box">
			<div class="caption {{$imgclass}}">
				<a href="#" title="{{$row['name']}}">
				{{strlen($row['name']) > 8 ? substr($row['name'],0,5)."~.".$expFile[1] : $row['name']}} </a>
			</div>
			<?php if($ext=="pdf")
				{
					$imgclass = "bigpdf";
				}?>
			<div class="thumb cinner{{$imgclass}}" <?php if($isImg==1) { ?> style="background: url('{{URL::to('uploads/thumbs/').'/thumb_'.$fid.'_'.$row['name']}}') no-repeat  center center; background-size:100px auto;" <?php } ?> onclick="parent.selectimg(this);" rel2="{{URL::to('uploads/thumbs/').'/medium_'.$row['name']}}" rel3="{{$row['imgpath'].$row['name']}}" rel="{{$row['name']}}">
				<a href="#" class="screenshot" rel="{{URL::to('uploads/thumbs/').'/format_'.$fid.'_'.$row['name']}}" title="{{$row['name']}}" data-fancybox-group="button">
					&nbsp;
				</a>
			</div>
			<div class="info">
				<label></label>
			</div>
		</div>
		<?php //} ?>
		@endif
	@endforeach
@endif