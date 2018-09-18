<?php $imgfancy = array();
	$filType = array('jpg'=>'JPEG image', 'jpeg'=>'JPEG image', 'JPG'=>'JPEG image', 'png'=>'PNG image', 'gif'=>'GIF image', 'xls'=>'Excel spreadsheet', 'eps'=>'EPS Image', 'mp4'=>'MPEG-4 video', 'mkv'=>'Matroska Video', 'flv'=>'Flash Video', 'avi'=>'Audio Video', 'wma'=>'Windows Media Audio', 'wmp'=>'Windows Media Player', 'psd'=>'PSD Image', 'pdf'=>'PDF document', 'ppt'=>'PowerPoint presentation', 'mp3'=>'MP3 audio', 'tif'=>'TIFF image', 'doc'=>'Word document', 'docx'=>'Word document', 'bmp'=>'Bitmap image', 'cad'=>'CAD image', 'zip'=>'Compress document');
 ?>					

<div style="display: none;" id="get-breadcrumb">
@if($searchedkeyword!='')
	<p class="searchedres">Your search for "{{$searchedkeyword}}" returned {{(!empty($rowData))?count($rowData):0}} results.</p>
@endif
</div>
 	@if(!empty($rowData))
						@if($showType=="thumb")	
							
							<div class="clear"></div>
							@if(!empty($rowData))
								<div id="container_sortable">	
									@foreach($rowData as $row)
										@if($row['ftype']=='folder')
										<div class="gallery-box ui-state-default">
											<div class="caption folder">
												<a data-action-open="folder" rel_row="{{$row['id']}}" href="{{ URL::to('getFolderListAjax/').'/'.$row['id'].'?show='.$showType }}">{{strlen($row['name']) > 8 ? substr($row['name'],0,8)."~" : $row['name']}}</a>
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
												<a data-action-open="file" rel_row="{{$row['id']}}" rel_fid="{{$row['folder_id']}}" href="{{ URL::to('files/view/').'/'.$row['folder_id'].'/'.$row['id'].'?show='.$showType }}" title="{{$row['name']}}">{{strlen($fname) > 8 ? substr($fname,0,5)."~.".$ext : $fname}}</a>
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
												<a data-action-open="file" rel_row="{{$row['id']}}" rel_fid="{{$row['folder_id']}}" href="{{ URL::to('files/view/').'/'.$row['folder_id'].'/'.$row['id'].'?show='.$showType }}" class="screenshot fancybox-buttons" rel="{{URL::to('uploads/thumbs/').'/format_'.$row['folder_id'].'_'.$row['name']}}" title="{{$fname}}" rel2="{{$fname}}" data-fancybox-group="button">
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
														<a data-action-open="file" rel_row="{{$row['id']}}" rel_fid="{{$row['folder_id']}}" href="{{ URL::to('tfiles/view/').'/'.$row['folder_id'].'/'.$tif->id.'?show='.$showType }}">&nbsp;&nbsp;{{strtoupper($imgval)}}&nbsp;&nbsp;</a>
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
														<a data-action-open="folder" rel_row="{{$row['id']}}" href="{{ URL::to('getFolderListAjax/').'/'.$row['id'].'?show='.$showType }}">{{strlen($row['name']) > 22 ? substr($row['name'],0,20)."~" : $row['name']}}</a>
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
														<a data-action-open="file" rel_row="{{$row['id']}}" rel_fid="{{$row['folder_id']}}" href="{{ URL::to('files/view/').'/'.$row['folder_id'].'/'.$row['id'].'?show='.$showType }}" title="{{$row['name']}}">{{strlen($fname) > 22 ? substr($fname,0,18)."~.".$ext : $fname}}</a>
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
						
					@if($pagination['total_page']>1)
							<div class="clear"></div>
							<div class="row">
								<div class="col-xs-12 text-center">
									<ul class="pagination">
										<?php if($pagination['prev_page']>0){ ?>
											
											<li><a href="{{url('containersearch')}}?searchedkeyword={{$searchedkeyword}}&page={{$pagination['prev_page']}}&show={{$showType}}" rel="prev">«</a></li>
										<?php }else{ ?>
											<li><span>«</span></li>
										<?php }?>
										

										<?php for($i=1;$i<$pagination['total_page'];$i++){?>

											<?php if($pagination['current_page']==$i){ ?>
												<li class="active"><span>{{$i}}</span></li>
											<?php }else{ ?>
												<li><a href="{{url('containersearch')}}?searchedkeyword={{$searchedkeyword}}&page={{$i}}&show={{$showType}}">{{$i}}</a></li>
											<?php }?>

										<?php }?>	

										<?php if($pagination['next_page']>0 && $pagination['total_page']>$pagination['next_page']){ ?>
											
											<li><a href="{{url('containersearch')}}?searchedkeyword={{$searchedkeyword}}&page={{$pagination['next_page']}}&show={{$showType}}" rel="next">»</a></li>
										<?php }else{ ?>
											<li><span>»</span></li>
										<?php }?>
										
										

									</ul>
								</div>
							</div>		
							<div class="clear"></div>
						@endif
			@else
				<div class="row">
					<div class="col-xs-12">
						Record Not Found
					</div>
				</div>	
			@endif
