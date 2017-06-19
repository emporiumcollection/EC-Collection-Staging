@extends('layouts.app')

@section('content')
<link href="{{ asset('sximo/css/custom_ps.css')}}" rel="stylesheet">
<script src="{{ asset('sximo/js/dropzone.js') }}"></script>
<link rel="stylesheet" href="{{ asset('sximo/css/dropzone.css') }}">

<?php $expFile = explode('.',$rowFile->file_name); 
      $imgclass = $expFile[1]; ?>
<div class="page-content row">
 <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>

      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}"> Dashboard </a></li>
        <li><a href="{{ URL::to('container') }}">{{ $pageTitle }}</a></li>
		<li class="active">view file</li>
      </ul>	  
    </div>
	
	<div class="page-content-wrapper m-t">	
		<div class="row">
			<div class="col-sm-3">	
				<div class="row">
					<div class="col-sm-12">
						<a href="{{ URL::to('container') }}" class="files label"><span>Files</span></a>
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
						<a class="btn btn-primary btn-lg" href="{{ URL::to('folders/').'/'.$prevfolder }}"> Back to folder</a>
						<a href="#" data-toggle="modal" data-target="#editFile" class="btn btn-primary btn-lg" title="Edit this file">
							Edit
						</a>
						@if($group==3)
							@if(!empty($userpermissions) && $userpermissions->download==1)
								<a class="btn btn-primary btn-lg" href="{{$rowFile->imgsrc.$rowFile->file_name}}" download="{{$rowFile->file_name}}"> Download</a>
								@if($expFile[1]=="tif" || $expFile[1]=="cad")
									<a class="btn btn-primary btn-lg" href="{{$rowFile->imgsrc.$expFile[0].'.jpg'}}" download="{{$expFile[0].'.jpg'}}"> Download as JPG</a>
									<a class="btn btn-primary btn-lg" href="{{$rowFile->imgsrc.$expFile[0].'.png'}}" download="{{$expFile[0].'.png'}}"> Download as PNG</a>
								@endif
							@endif
						@else
							<a class="btn btn-primary btn-lg" href="{{$rowFile->imgsrc.$rowFile->file_name}}" download="{{$rowFile->file_name}}"> Download</a>
							@if($expFile[1]=="tif" || $expFile[1]=="cad")
								<a class="btn btn-primary btn-lg" href="{{$rowFile->imgsrc.$expFile[0].'.jpg'}}" download="{{$expFile[0].'.jpg'}}"> Download as JPG</a>
								<a class="btn btn-primary btn-lg" href="{{$rowFile->imgsrc.$expFile[0].'.png'}}" download="{{$expFile[0].'.png'}}"> Download as PNG</a>
							@endif
						@endif
						<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#newFile">
						  Add slider images
						</button>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<h2 class="folder">
							<span id="folder_name">
								<a href="{{ URL::to('container') }}"><span>Files</span></a>
								@if(!empty($parentArr))
									@foreach($parentArr as $parArr)
										/ <a href="{{ URL::to('folders/'.$parArr->id) }}">{{$parArr->name}}</a>
									@endforeach
								@endif
							</span>
						</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<h1>{{($rowFile->file_display_name!='')? $rowFile->file_display_name:$rowFile->file_name}}</h1>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="row MrgTop10">
							<div class="col-sm-12">
								<div id="thumbnail-container-2758299">
									<?php 
										$isImg = 0;
										if($expFile[1]=="jpg" || $expFile[1]=="png" || $expFile[1]=="gif" || $expFile[1]=="bmp" || $expFile[1]=="jpeg" || $expFile[1]=="JPG") { 
									?>
										<img src="{{$rowFile->imgsrc.$rowFile->file_name}}" alt="{{$rowFile->file_name}}" class="img-responsive">
									<?php } else { ?>
										<img src="{{URL::to('uploads/images/').'/no_thumb.gif'}}" alt="{{$rowFile->file_name}}" class="img-responsive">
									<?php } ?>
								</div>
							</div>
						</div>
						@if(!empty($sub_images))
							<div class="row MrgTop10 MrgBot10">
								<div class="col-sm-12">
									<h3 class="title">Slider Images</h3>
								</div>
								<div class="col-sm-12 MrgBot30">
									@foreach($sub_images as $subs)
										<div class="col-sm-3 MrgBot10">
											<a href="{{URL::to('uploads/file_sub_images/'.$subs->sub_image)}}" target="_blank" class="previewImage">
												<img src="{{URL::to('uploads/file_sub_images/thumbs/thumb_'.$subs->sub_image)}}" alt="{{$subs->sub_image}}" class="img-responsive" />
											</a>
											@if($subs->status==0)
												<img src="{{URL::to('uploads/images/activated.png')}}" style="cursor:pointer; margin-left:5px;" title="Click to Deactivate" onclick="activate_deactivate_slider(this,'{{$subs->id}}',1);" />
											@else
												<img src="{{URL::to('uploads/images/not_activated.png')}}" style="cursor:pointer; margin-left:5px;" title="Click to Activate" onclick="activate_deactivate_slider(this,'{{$subs->id}}',0);" />
											@endif
											<img src="{{URL::to('uploads/images/delete.png')}}" style="cursor:pointer; margin-left:5px;" title="Click to Remove" onclick="remove_subimages(this,'{{$subs->id}}');" />
										</div>
									@endforeach
								</div>
							</div>
						@endif
						@if($expFile[1]=="tif" || $expFile[1]=="cad")
							@if(($rel_files!='') && (!empty($rel_files)))
								<div class="row MrgTop10 MrgBot10">
								@foreach($rel_files as $file)
									<div class="col-sm-6 MrgBot10">
										<a href="{{ URL::to('tfiles/view/').'/'.$file->folder_id.'/'.$file->id }}" title="{{$file->file_name}}">
											<img src="{{$rowFile->imgsrc.$file->file_name}}" alt="{{$file->file_name}}" class="img-responsive">
										</a>
									</div>
								@endforeach
								</div>
							@endif
						@endif
					</div>
					<div class="col-sm-6 fileinfo MrgBot100">
						<div class="box well">
							<div class="tab-container">
								<ul class="nav nav-tabs">
								  <li class="active"><a href="#info" data-toggle="tab">File info</a></li>
								  <li><a href="#tags" data-toggle="tab">Assigned Tags</a></li>
								  <li><a href="#attributes" data-toggle="tab">Assigned Attributes</a></li>
								</ul>
								<div class="tab-content">
								  <div class="tab-pane active use-padding" id="info">
									<table class="keyvalue MrgTop10">
										<tbody>
											<tr>
												<td class="label">Title:</td>
												<td>{{$rowFile->file_title}}</td>
											</tr>
											<tr>
												<td class="label">Description:</td>
												<td>{{$rowFile->file_description}}</td>
											</tr>
											<tr>
												<td class="label">Type:</td>
												<td><?php $exp = explode('/',$rowFile->file_type); echo strtoupper($exp[1]).' '.$exp[0]?></td>
											</tr>
											<tr>
												<td class="label">Date:</td>
												<td>{{date("d-m-Y h:i", strtotime($rowFile->created))}}</td>
											</tr>
											<tr>
												<td class="label">Size:</td>
												<td><?php $sizeKb = ($rowFile->file_size/1024); echo round($sizeKb,2,PHP_ROUND_HALF_UP);?> KB</td>
											</tr>
											<tr>
												<td class="label">Folder:</td>
												<td><a href="{{ URL::to('folders/').'/'.$rowFile->folder_id }}">{{$rowFile->folderName}}</a></td>
											</tr>
											<tr>
												<td class="label">Uploaded by:</td>
												<td title="91.209.190.140 (konlinux5.konformit.com)">
													{{$rowFile->first_name.' '.$rowFile->last_name }}
												</td>
											</tr>
										</tbody>
									</table>
								  </div>
								  <div class="tab-pane use-padding MrgTop10" id="tags">
										@if(!empty($TagArr))
											@foreach($TagArr as $assTag)
												<div class="row MrgTop10 tag{{$assTag->id}}">
													<div class="col-sm-9">
														<b>{{$assTag->tag_title}}</b>
													</div>
													<div class="col-sm-3">
														<a href="#" onclick="remove_tag({{$assTag->id}});" title="remove"><span class="icon-remove"></span></a>
													</div>
												</div>
											@endforeach
										@else
											<div class="col-sm-12 MrgBot10">No Tag Assigned Yet.</div>
										@endif
								  </div>
								  <div class="tab-pane use-padding MrgTop10" id="attributes">
										@if(!empty($AttrArr))
											@foreach($AttrArr as $assAttr)
												<div class="row attr{{$assAttr['Attrs']->id}}" style="border-bottom:1px solid #000;">
													<div class="col-sm-3">
														<b>{{$assAttr['Attrs']->attr_title}}:</b>
													</div>
													<div class="col-sm-7">
														@if($assAttr['AttrType']=="text" || $assAttr['AttrType']=="textarea")
															<p>{{$assAttr['AttrVal']}}</p>
														@elseif($assAttr['AttrType']=="file")
															<?php $exp_mul_file = explode('::',$assAttr['AttrVal']); ?>
															@foreach($exp_mul_file as $imgs)
																<a href="{{URL::to('uploads/attributes_imgs/'.trim($imgs))}}" target="_blank" class="previewImage">
																	<img src="{{URL::to('uploads/attributes_imgs/'.trim($imgs))}}" title="{{trim($imgs)}}" class="img-responsive" width="80" height="80"/>
																</a>, &nbsp;
															@endforeach	
														@elseif($assAttr['AttrType']=="dropdown" || $assAttr['AttrType']=="checkboxes" || $assAttr['AttrType']=="radio")
															@foreach($assAttr['AttrVal'] as $attropts)
																{{$attropts->option_name}}
																
																@if(strtolower($assAttr['Attrs']->attr_title)=="color" || strtolower($assAttr['Attrs']->attr_title)=="material")
																	@if($attropts->attr_img !='')
																		<?php $attrFile = explode('.',$attropts->attr_img); ?>
																		@if($attrFile[1]=="jpg" || $attrFile[1]=="png" || $attrFile[1]=="gif" || $attrFile[1]=="bmp" || $attrFile[1]=="jpeg" || $attrFile[1]=="JPG") 
																			<a href="{{URL::to('uploads/attributes_imgs/'.$attropts->attr_img)}}" target="_blank" class="previewImage">
																				<img src="{{URL::to('uploads/attributes_imgs/'.$attropts->attr_img)}}" title="{{$attropts->attr_img}}" class="img-responsive" width="80" height="80"/>
																			</a>
																		@else
																			<img src="{{URL::to('uploads/images/').'/no_thumb.gif'}}" class="img-responsive">
																		@endif
																	@endif
																@endif
																,&nbsp; 
															@endforeach
														@endif
													</div>
													<div class="col-sm-2">
														<a href="#" onclick="remove_attribute({{$assAttr['Attrs']->id}});" title="remove"><span class="icon-remove"></span></a>
													</div>
												</div>
											@endforeach
										@else
											<div class="col-sm-12 MrgBot10">No Attribute Assigned Yet.</div>
										@endif
								  </div>
								</div>
							  </div>
						  </div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	
	<!-- Edit File Modal -->
	<div class="modal fade" id="editFile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Edit this file</h4>
		  </div>
		  {!! Form::open(array('url'=>'editfile', 'class'=>'columns' ,'id' =>'file_edit', 'method'=>'post' )) !!}
		  <input type="hidden" name="file_id" value="{{$fileId}}">
		  <input type="hidden" name="curnurl" value="{{ Request::url() }}">
		  <div class="modal-body">
			<fieldset>
				<div class="field">
					<label>Name <em>*</em></label>
					<div class="field-input">
						<input name="file_display_name" class="form-control" type="text" value="<?php echo ($rowFile->file_display_name!='')? $rowFile->file_display_name:$rowFile->file_name;?>" required="required">
					</div>
				</div>
				<div class="field">
					<label>Title <em>*</em></label>
					<div class="field-input">
						<input name="file_title" class="form-control" type="text" size="30" value="<?php echo ($rowFile->file_title!='')? $rowFile->file_title:'';?>" required="required">
					</div>
				</div>
				<div class="field">
					<label>Description <em>*</em></label>
					<div class="field-input">
						<textarea name="file_desc" class="form-control" required="required"><?php echo ($rowFile->file_description!='')? $rowFile->file_description:'';?></textarea>
					</div>
				</div>
			</fieldset>
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Save File</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- Sub images Modal -->
	<div class="modal fade" id="newFile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Upload Slider images</h4>
		  </div>
		  {!! Form::open(array('url'=>'addsubimage', 'class'=>'columns' ,'id' =>'add_sub_image', 'method'=>'post', 'files'=>true )) !!}
		  <input type="hidden" name="file_id" id="file_id" value="{{$rowFile->id}}">
		  <input type="hidden" name="curnurl" value="{{ Request::url() }}">
		  <div class="modal-body">
			<fieldset>
				<div class="field">
					<label>Select Files <em>*</em></label>
				</div>
				 <div class="dropzone" id="dropzoneFileUpload"> </div>
			</fieldset>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" onclick="location.reload();">Save & Continue</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>

	<script>
		function remove_tag(tagId)
		{
			if(tagId>0)
			{
				$.ajax({
				  url: "{{ URL::to('remove_exist_tag')}}",
				  type: "post",
				  data: 'tag_id='+tagId+'&cont_id={{$fileId}}',
				  dataType: "json",
				  success: function(data){
					if(data!='error')
					{
						$('.tag'+tagId).remove();
					}
				  }
				});
			}
		}
		
		function remove_attribute(attrId)
		{
			if(attrId>0)
			{
				$.ajax({
				  url: "{{ URL::to('remove_exist_attribute')}}",
				  type: "post",
				  data: 'attr_id='+attrId+'&cont_id={{$fileId}}',
				  dataType: "json",
				  success: function(data){
					if(data!='error')
					{
						$('.attr'+attrId).remove();
					}
				  }
				});
			}
		}
		
		var baseUrl = "{{ url::to('addsubimage') }}";
        var token = "{{ Session::getToken() }}";
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("div#dropzoneFileUpload", {
            url: baseUrl,
			params: {
				_token: token,
				file_id:$("#file_id").val()
			},
			paramName: "file", // The name that will be used to transfer the file
			addRemoveLinks: true,
			success: function(file, response){
				
			}
		});
		
		function activate_deactivate_slider(img,img_id,act)
		{
			if(img_id!='' && img_id>0)
			{
				$.ajax({
				  url: "{{ URL::to('activate_deactivate_product_slider_images')}}",
				  type: "post",
				  data: 'img_id='+img_id+'&action='+act,
				  success: function(data){
					if(data!='error')
					{
						if(act==0)
						{
							$(img).attr("src","{{URL::to('uploads/images/activated.png')}}");
							$(img).attr("onclick","activate_deactivate_slider(this,'"+img_id+"',1)");
							$(img).attr("title","Click to Deactivate");
						}
						else if(act==1)
						{
							$(img).attr("src","{{URL::to('uploads/images/not_activated.png')}}");
							$(img).attr("onclick","activate_deactivate_slider(this,'"+img_id+"',0)");
							$(img).attr("title","Click to Activate");
						}
					}
				  }
				});
			}
		}
		
		function remove_subimages(img,img_id)
		{
			if(img_id!='' && img_id>0)
			{
				$.ajax({
				  url: "{{ URL::to('remove_subimage')}}",
				  type: "post",
				  data: 'img_id='+img_id,
				  success: function(data){
					if(data!='error')
					{
						$(img).parent('div').remove();
					}
				  }
				});
			}
		}
		
	</script>
@stop