
<?php $expFilet = explode('.',$rowFile->file_name); 
	  $expFile = end($expFilet);
      $imgclass = $expFile;
 ?>  
	
				
				
				<div class="row">
					<div class="col-sm-12">
						<a class="btn btn-primary btn-lg dropdown-toggle btn_orange" href="{{$rowFile->imgsrc.$rowFile->file_name}}" download="{{$rowFile->file_name}}"> {{\Lang::get('core.menu_download')}}</a>
						@if($expFile=="tif" || $expFile=="cad")
							<a class="btn btn-primary btn-lg dropdown-toggle btn_orange" href="{{$rowFile->imgsrc.$expFilet[0].'.jpg'}}" download="{{$expFilet[0].'.jpg'}}"> {{\Lang::get('core.menu_download_jpg')}}</a>
							<a class="btn btn-primary btn-lg dropdown-toggle btn_orange" href="{{$rowFile->imgsrc.$expFilet[0].'.png'}}" download="{{$expFilet[0].'.png'}}"> {{\Lang::get('core.menu_download_png')}}</a>
						@endif
						
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<h2 class="folder">
							<span id="folder_name">
								<a href="{{ URL::to('press?show='.$showType) }}"><span>Files</span></a>
								@if(!empty($parentArr))
									@foreach($parentArr as $parArr)
										/ <a href="{{ URL::to('folders/'.$parArr->id.'?show='.$showType) }}">{{$parArr->display_name}}</a>
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
										if($expFile=="jpg" || $expFile=="png" || $expFile=="gif" || $expFile=="bmp" || $expFile=="jpeg" || $expFile=="JPG") { 
									?>
										<img src="{{$rowFile->imgsrc.$rowFile->file_name}}" alt="{{$rowFile->file_name}}" class="img-responsive">
									<?php } elseif($expFile=="mp4") { ?>
										{{--*/ $videolink = $rowFile->imgsrc.$rowFile->file_name; /*--}}
										<script src="{{ asset('sximo/js/plugins/players/jwplayer/jwplayer.js')}}"></script>
										<div id="jwPlayerContainer">Loading media...</div>
										<script type="text/javascript">
											//<![CDATA[
											$(document).ready(function() {
												jwplayer("jwPlayerContainer").setup({
													file: "{{$videolink}}?download_token=050281d2027a1f662974fc3097b5dee0fa34ee19862c19b04976ddb7420615a7",
													type: "mp4",
													title: "{{$rowFile->file_name}}",
													width: "100%",
													startparam: "start",
													abouttext: "{{$rowFile->file_name}}",
													aboutlink: "{{$videolink}}",
													sharing: {
													link: "{{$videolink}}"
													},
													logo: {
													file: "",
															link: "{{URL::to('')}}",
															linktarget: "_blank",
															hide: "false"
													},
													aspectratio: "16:9",
													image: "{{URL::to('sximo/images/mp4.png')}}",
													autostart: true		
												});
											});
											//]]>
										</script>
									<?php }	else { ?>
										<img src="{{URL::to('uploads/images/').'/no_thumb.gif'}}" alt="{{$rowFile->file_name}}" class="img-responsive">
									<?php } ?>
								</div>
							</div>
						</div>						
						@if($expFile=="tif" || $expFile=="cad")
							@if(($rel_files!='') && (!empty($rel_files)))
								<div class="row MrgTop10 MrgBot10">
								@foreach($rel_files as $file)
									<div class="col-sm-6 MrgBot10">
										<a href="{{ URL::to('tpress/view/').'/'.$file->folder_id.'/'.$file->id }}" title="{{$file->file_name}}">
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
								  <li><a href="#varients" data-toggle="tab">Varients</a></li>
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
												<td><a href="{{ URL::to('folders/').'/'.$rowFile->folder_id.'?show='.$showType }}">{{$rowFile->folderName}}</a></td>
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
																
																@if($assAttr['Attrs']->attr_cat=="Materialien"  || $assAttr['Attrs']->attr_cat=="Materialien_additional")
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
								  <div class="tab-pane use-padding MrgTop10" id="varients">
										@if(!empty($varients))
											@foreach($varients as $exvarient)
												<div class="row MrgTop10 varient{{$exvarient->id}}">
													<div class="col-sm-9">
														<b>{{$exvarient->varient_name}}</b>
													</div>
													<div class="col-sm-3">
														<a href="#" data-toggle="modal" data-target="#addVarients" title="edit" style="margin-right:10px;"><span class="icon-pencil3"></span></a>
														<a href="#" onclick="remove_existed_varient({{$exvarient->id}});" title="remove"><span class="icon-remove"></span></a>
													</div>
												</div>
											@endforeach
										@else
											<div class="col-sm-12 MrgBot10">No Varients Added Yet.</div>
										@endif
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
			<h4 class="modal-title" id="myModalLabel">Edit this file <span style="float:right; margin-right:10px;"> <a href="#" onclick="change_lang('dutch');">Deutsch</a> || <a href="#" onclick="change_lang('eng');">English</a></span></h4>
		  </div>
		  {!! Form::open(array('url'=>'editfile', 'class'=>'columns' ,'id' =>'file_edit', 'method'=>'post' )) !!}
		  <input type="hidden" name="file_id" value="{{$fileId}}">
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
		  <div class="modal-body">
			<fieldset>
				<div class="field">
					<label>Name <em>*</em></label>
					<div class="field-input">
						<input name="file_display_name" class="form-control ldutch" type="text" value="<?php echo ($rowFile->file_display_name!='')? $rowFile->file_display_name:$rowFile->file_name;?>" required="required">
						
						<input name="file_display_name_eng" class="form-control leng" type="text" value="<?php echo ($rowFile->file_display_name_eng!='')? $rowFile->file_display_name_eng:$rowFile->file_name;?>" >
					</div>
				</div>
				<div class="field">
					<label>Title <em>*</em></label>
					<div class="field-input">
						<input name="file_title" class="form-control ldutch" type="text" size="30" value="<?php echo ($rowFile->file_title!='')? $rowFile->file_title:'';?>" required="required">
						
						<input name="file_title_eng" class="form-control leng" type="text" size="30" value="<?php echo ($rowFile->file_title_eng!='')? $rowFile->file_title_eng:'';?>" >
					</div>
				</div>
				<div class="field">
					<label>Description <em>*</em></label>
					<div class="field-input">
						<textarea name="file_desc" class="form-control ldutch" required="required"><?php echo ($rowFile->file_description!='')? $rowFile->file_description:'';?></textarea>
						
						<textarea name="file_desc_eng" class="form-control leng" ><?php echo ($rowFile->file_description_eng!='')? $rowFile->file_description_eng:'';?></textarea>
						
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
		
	<!-- Add varients Folder File Modal -->
	<div class="modal fade" id="addVarients" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Add Varients to file:</h4>
		  </div>
		  {!! Form::open(array('url'=>'add_varients', 'class'=>'columns form-horizontal' ,'id' =>'add_varients', 'method'=>'post', 'files'=>true )) !!}
		  <input type="hidden" name="fold_id" value="{{$prevfolder}}">
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
		  <input type="hidden" name="file_id" value="{{$fileId}}">
		  <div class="modal-body">
			<fieldset>
				<div class="form-group">
					<div class="panel-group accordion" id="accordion">
					@if(!empty($varients))
					{{--*/ $vr=1; /*--}}
						@foreach($varients as $varient)
						<div class="panel panel-default repeatVar{{$vr}}">
							<input type="hidden" name="edit_varient_id[{{$vr}}]" value="{{$varient->id}}">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$vr}}" class="collapsed">
										<i class="fa fa-angle-right"></i> Existed Variant(s)
									</a>
									@if(end($varients)==$varient)
										<span class="var_add_Butt" onclick="addVarient({{$vr}});">
											<i class="fa fa-plus"></i> Add More
										</span>
									@endif
								</h4>
							</div>
							<div id="collapse{{$vr}}" class="panel-collapse collapse" style="height: 0px;">
								<div class="panel-body">
									<div class="row MrgBot10">
										<label class="col-md-3">Variant code <em>*</em></label>
										<div class="col-md-9">
											<input name="varient_code[{{$vr}}]" class="form-control" type="text" value="{{$varient->varient_code}}" required="required">
										</div>
									</div>
									<div class="row MrgBot10">
										<label class="col-md-3">Variant name <em>*</em></label>
										<div class="col-md-9">
											<input name="varient_name[{{$vr}}]" class="form-control" type="text" value="{{$varient->varient_name}}" required="required">
										</div>
									</div>
									<div class="row MrgBot10">
										<label class="col-md-3">Variant image</label>
										<div class="col-md-9">
											<input name="varient_image[{{$vr}}]" class="form-control" type="file">
											{!! SiteHelpers::showUploadedFile($varient->varient_image,'/uploads/varients_imgs/',50,50) !!}
										</div>
									</div>
									@if(!empty($varient_attrs[$varient->id]))
									{{--*/ $vratr=1; /*--}}
										@foreach($varient_attrs[$varient->id] as $var_attr)
											<div class="repeatAttr{{$vratr}}">
												<input type="hidden" name="edit_attr_id[{{$vr}}][{{$var_attr['AttrId']}}]" value="{{$var_attr['VarAttrId']}}">
												<div class="row MrgBot10">
													<label class="col-md-3">Variant Attributes <span class="asterix"> * </span></label>
													<div class="col-md-7">
														<div class="row mainattr{{$vratr}} MrgBot10">
															<div class="col-md-12">
																<select name="assigned_attributes[{{$vr}}][]" id="assigned_attributes{{$vratr}}" class="form-control" required="required" onchange="customOptions(this.value, {{$vratr}}, {{$vr}});">
																	<option value=""> --Select-- </option>
																	@if(!empty($sel_attributes))
																		@foreach($sel_attributes as $attr)
																		  <option value="<?php echo $attr->attr_type .'-'.$attr->id .'-'.$attr->attr_cat; ?>" <?php echo ($attr->id == $var_attr['AttrId'] ? " selected='selected' " : '' ); ?>><?php echo $attr->attr_title; ?></option>
																		@endforeach
																	@endif
																</select>
															</div>
														</div>
														@if($var_attr['AttrType']=='dropdown' || $var_attr['AttrType']=='radio' || $var_attr['AttrType']=='checkboxes')
															{{--*/ $expVal = explode(',',$var_attr['AttrVal']); /*--}}
														<div class="row MrgBot10 seloption">
															<div class="col-md-12">
																<select name="selected_attributes[{{$vr}}][{{$var_attr['AttrId']}}][]" class="selectdrop" required="required" style="width:100%;" multiple="multiple">
																	<option value=""> --Select-- </option>
																	@if(!empty($var_attr['AttrOpts']))
																		@foreach($var_attr['AttrOpts'] as $attr_opt)
																		  <option value="{{$attr_opt->id}}" {{(in_array($attr_opt->id, $expVal))?'selected="selected"':''}} >{{$attr_opt->option_name}}</option>
																		@endforeach
																	@endif
																</select>
															</div>
														</div>
														@endif
														<div class="row" id="custmOpt{{$vratr}}">
															<div class="col-md-12">
																<div class="row attrf">
																	@if($var_attr['AttrType']=='dropdown' || $var_attr['AttrType']=='radio' || $var_attr['AttrType']=='checkboxes')
																		{{--*/ $clsd = 'col-md-5';  /*--}}
																		@if($var_attr['Attrs']->attr_title=="Materialien" || $var_attr['Attrs']->attr_title=="Materialien_additional")
																				{{--*/ $clsd = 'col-md-3' /*--}}
																			@endif
																		<div class="clone{{$vratr}}">
																			<div class="{{$clsd}}">
																			  <input type="text" name="opt_values[{{$vr}}][{{$var_attr['AttrId']}}][]" value="" placeholder="Value" class="form-control">			
																			</div>
																			<div class="{{$clsd}}">
																			  <input type="text" name="opt_name[{{$vr}}][{{$var_attr['AttrId']}}][]" value="" placeholder="Display Name" class="form-control">
																			</div>
																			@if($var_attr['Attrs']->attr_title=="Materialien" || $var_attr['Attrs']->attr_title=="Materialien_additional")
																				<div class="col-md-4">
																					<input type="file" name="opt_imgs[{{$vr}}][{{$var_attr['AttrId']}}][]" class="form-control">
																				</div>
																			@endif
																			 <div class="col-md-2 butt">
																				<button type="button" onclick="addItem({{$vratr}}, {{$vratr}}, {{$vr}})" class="btn btn-success MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add More" id="add" data-original-title="Add more">
																					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
																				</button>
																			</div>
																		</div>
																	@elseif($var_attr['AttrType']=='text')
																		<div class="col-md-12">
																			<input type="text" name="assigned_text[{{$vr}}][{{$var_attr['AttrId']}}]" value="{{$var_attr['AttrVal']}}" class="form-control" required="required" />
																		</div>
																	@elseif($var_attr['AttrType']=='textarea')
																		<div class="col-md-12">
																			<textarea name="assigned_textarea[{{$vr}}][{{$var_attr['AttrId']}}]" class="form-control" required="required"> {{$var_attr['AttrVal']}}</textarea>
																		</div>
																	@elseif($var_attr['AttrType']=='file')
																	{{--*/ $expimg = explode(' :: ', $var_attr['AttrVal']); $pdf=1; $totimg = count($expimg); /*--}}
																		@foreach($expimg as $attimgs)
																		<div class="clone{{$pdf}}">
																			<div class="col-md-10">
																				<input type="file" name="assigned_file[{{$vr}}][{{$var_attr['AttrId']}}][]" class="form-control" />
																				<br>
																				{!! SiteHelpers::showUploadedFile($attimgs,'/uploads/varients_imgs/attributes_imgs/',50,50) !!}
																				<input type="hidden" name="edit_assigned_file[{{$vr}}][{{$var_attr['AttrId']}}][]" class="form-control" value="{{$attimgs}}" />
																			</div>
																			<div class="col-md-2 butt">
																				@if($totimg==$pdf)
																					<button type="button" onclick="addItem({{$pdf}}, {{$vratr}}, {{$vr}})" class="btn btn-success MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add More" id="add" data-original-title="Add more">
																						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
																					</button>
																				@else
																					<button type="button" onclick="removeItem({{$pdf}}, {{$vratr}}, {{$vr}})" class="btn btn-danger MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Remove" data-original-title="Remove">
																						<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> 
																					</button>
																				@endif
																			</div>
																		</div>
																		<?php $pdf++; ?>
																		@endforeach
																	@endif
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-2 mainButt">
														@if(end($varient_attrs[$varient->id])==$var_attr)
															<button type="button" onclick="addVarientAttribute({{$vratr}}, {{$vr}})" class="btn btn-success MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add More" id="add" data-original-title="Add more"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
														@else
															<button type="button" onclick="removeVarientAttributes({{$vratr}}, {{$vr}})" class="btn btn-danger MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Remove" data-original-title="Remove"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> </button>
														@endif
													</div>
												</div>
											</div>
											{{--*/ $vratr++; /*--}}
										@endforeach
									@endif
								</div>
							</div>
						</div>
						{{--*/ $vr++; /*--}}
					  @endforeach
					@else
					  <div class="panel panel-default repeatVar1">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="collapsed">
									<i class="fa fa-angle-right"></i> New Varient
								</a>
								<span class="var_add_Butt" onclick="addVarient(1);">
									<i class="fa fa-plus"></i> Add More
								</span>
							</h4>
						</div>
						<div id="collapse1" class="panel-collapse collapse in" style="height: 0px;">
							<div class="panel-body">
								<div class="row MrgBot10">
									<label class="col-md-3">Variant code <em>*</em></label>
									<div class="col-md-9">
										<input name="varient_code[1]" class="form-control" type="text" value="" required="required">
									</div>
								</div>
								<div class="row MrgBot10">
									<label class="col-md-3">Variant name <em>*</em></label>
									<div class="col-md-9">
										<input name="varient_name[1]" class="form-control" type="text" value="" required="required">
									</div>
								</div>
								<div class="row MrgBot10">
									<label class="col-md-3">Variant image <em>*</em></label>
									<div class="col-md-9">
										<input name="varient_image[1]" class="form-control" type="file" required="required">
									</div>
								</div>
								<div class="repeatAttr1">
									<div class="row MrgBot10">
										<label class="col-md-3">Variant Attributes <span class="asterix"> * </span></label>
										<div class="col-md-7">
											<div class="row mainattr1 MrgBot10">
												<div class="col-md-12">
													<select name="assigned_attributes[1][]" id="assigned_attributes1" class="form-control" required="required" onchange="customOptions(this.value, 1, 1);">
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
											<button type="button" onclick="addVarientAttribute(1, 1)" class="btn btn-success MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add More" id="add" data-original-title="Add more"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
										</div>
									</div>
								</div>
							</div>
						</div>
					  </div>
					@endif
					</div>
				</div>
			</fieldset>
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Save</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- Assign tags File Modal -->
	<div class="modal fade" id="assignTagsFile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Assign tags:</h4>
		  </div>
		  {!! Form::open(array('url'=>'assignTagsFile', 'class'=>'columns form-horizontal' ,'id' =>'assign_tags_file', 'method'=>'post')) !!}
		  <input type="hidden" name="file_id" value="{{$fileId}}">
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
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
    
    

    

	
	<script>
	
	$(document).ready(function() { 
		$(".selectdrop").select2();	
	});
		function remove_tag(tagId)
		{
			if(tagId>0)
			{
				var confrm = confirm("Are you sure you want to delete this tag!");
				if(confrm==true)
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
		}
		
		function remove_attribute(attrId)
		{
			if(attrId>0)
			{
				var confrm = confirm("Are you sure you want to delete this attribute!");
				if(confrm==true)
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
				var confrm = confirm("Are you sure you want to delete this sub image!");
				if(confrm==true)
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
		}
		
		function customOptions(objVal, indx, varnt)
		{
			var str = '';
			var str_sel = '';
			if(objVal!='')
			{
				var exp_val = objVal.split("-");
				if(exp_val[0]=='dropdown' || exp_val[0]=='radio' || exp_val[0]=='checkboxes')
				{
					$('.repeatVar'+varnt+' .repeatAttr'+indx+' div.seloption').remove();
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
							str_sel += '<select name="selected_attributes['+varnt+']['+exp_val[1]+'][]" class="js-example-basic-multiple'+indx+'"  required="required" multiple="multiple" style="width:100%">';
							$.each(data, function(idx, obj) {
								str_sel += '<option value="'+obj.id+'">'+obj.option_name+'</option>';
							});
							str_sel += '</select>';
							str_sel += '</div>';
							str_sel += '</div>';
							$('.repeatVar'+varnt+' .repeatAttr'+indx+' .mainattr'+indx).after(str_sel);
							$('.repeatVar'+varnt+' .repeatAttr'+indx+' .js-example-basic-multiple'+indx).select2();
						}
					  }
					});
					
					var cls = 'col-md-5';
					if(exp_val[2]=="Materialien" || exp_val[2]=="Materialien_additional")
					{
						cls = 'col-md-3';
					}
					str += '<div class="clone'+indx+'">';
					str += '<div class="'+cls+'">';
					str += '<input type="text" name="opt_values['+varnt+']['+exp_val[1]+'][]" value="" placeholder="Value" class="form-control">';
					str += '</div>';
					str += '<div class="'+cls+'">';
					str += '<input type="text" name="opt_name['+varnt+']['+exp_val[1]+'][]" value="" placeholder="Display Name" class="form-control">';
					str += '</div>';
					if(exp_val[2]=="Materialien" || exp_val[2]=="Materialien_additional")
					{
						str += '<div class="col-md-4">';
						str += '<input type="file" name="opt_imgs['+varnt+']['+exp_val[1]+'][]" class="form-control">';
						str += '</div>';
					}
					str += '<div class="col-md-2 butt">';
					str += '<button type="button" onclick="addItem('+indx+', '+indx+', '+varnt+')" class="btn btn-success MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add More" id="add" data-original-title="Add more"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>';
					str += '</div>';
					str += '</div>';
				}
				else if(exp_val[0]=='text')
				{
					$('.repeatVar'+varnt+' .repeatAttr'+indx+' div.seloption').remove();
					str += '<div class="col-md-12"><input type="text" name="assigned_text['+varnt+']['+exp_val[1]+']" value="" class="form-control" required /></div>';
				}
				else if(exp_val[0]=='textarea')
				{
					$('.repeatVar'+varnt+' .repeatAttr'+indx+' div.seloption').remove();
					str += '<div class="col-md-12"><textarea name="assigned_textarea['+varnt+']['+exp_val[1]+']" class="form-control" required></textarea></div>';
				}
				else if(exp_val[0]=='file')
				{
					$('.repeatVar'+varnt+' .repeatAttr'+indx+' div.seloption').remove();
					str += '<div class="clone'+indx+'">';
					str += '<div class="col-md-10"><input type="file" name="assigned_file['+varnt+']['+exp_val[1]+'][]" class="form-control" required="required" /></div>';
					str += '<div class="col-md-2 butt">';
					str += '<button type="button" onclick="addItem('+indx+', '+indx+', '+varnt+')" class="btn btn-success MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add More" id="add" data-original-title="Add more"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>';
					str += '</div>';
					str += '</div>';
					//str += '<div class="col-md-12"><input type="file" name="assigned_file['+exp_val[1]+']" class="form-control" required /></div>';
				}
				$('.repeatVar'+varnt+' .repeatAttr'+indx+' #custmOpt'+indx+' .attrf').html(str);
				$('.repeatVar'+varnt+' .repeatAttr'+indx+' #custmOpt'+indx).show();
			}
			else
			{
				$('.repeatVar'+varnt+' .repeatAttr'+indx+' #custmOpt'+indx+' .attrf').html('');
				$('.repeatVar'+varnt+' .repeatAttr'+indx+' div.seloption').remove();
				$('.repeatVar'+varnt+' .repeatAttr'+indx+' #custmOpt'+indx).hide();
			}
		}
		
		function addItem(id, mainid, varntid)
		{
			if(id!="")
			{
				$('.repeatVar'+varntid+' .repeatAttr'+mainid+' .clone'+id+' .butt button').remove();
				var remBut = '<button type="button" onclick="removeItem('+id+', '+mainid+', '+varntid+')" class="btn btn-danger MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Remove" data-original-title="Remove"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> </button>';
				$('.repeatVar'+varntid+' .repeatAttr'+mainid+' .clone'+id+' .butt').append(remBut);
				var newid = parseInt(id) + 1;
				var cls = 'col-md-5';
				var attrId = $('.repeatVar'+varntid+' .repeatAttr'+mainid+' #assigned_attributes'+mainid).val();
				var exp_attrId = attrId.split("-");
				if(exp_attrId[0]=="file")
				{
					var html = '<div class="clone'+newid+'">';
					html += '<div class="col-md-10"><input type="file" name="assigned_file['+varntid+']['+exp_attrId[1]+'][]" class="form-control" required="required" /></div>';
				}
				else{
					var title = $('.repeatVar'+varntid+' .repeatAttr'+mainid+' #assigned_attributes'+mainid+' option:selected').text();
					if(exp_attrId[2]=="Materialien" || exp_attrId[2]=="Materialien_additional")
					{
						cls = 'col-md-3';
					}
					var html = '<div class="clone'+newid+'">';
					html += '<div class="'+cls+'">';
					html += '<input type="text" name="opt_values['+varntid+']['+exp_attrId[1]+'][]" value="" placeholder="Value" class="form-control">';
					html += '</div>';
					html += '<div class="'+cls+'">';
					html += '<input type="text" name="opt_name['+varntid+']['+exp_attrId[1]+'][]" value="" placeholder="Display Name" class="form-control">';
					html += '</div>';
					if(exp_attrId[2]=="Materialien" || exp_attrId[2]=="Materialien_additional")
					{
						html += '<div class="col-md-4">';
						html += '<input type="file" name="opt_imgs['+varntid+']['+exp_attrId[1]+'][]" class="form-control">';
						html += '</div>';
					}
				}
				
				html += '<div class="col-md-2 butt">';
				html += '<button type="button" onclick="addItem('+newid+', '+mainid+', '+varntid+')" class="btn btn-success MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add More" id="add" data-original-title="Add more"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>';
				html += '</div>';
				html += '</div>';
				$('.repeatVar'+varntid+' .repeatAttr'+mainid+' .clone'+id).after(html);
			}
		}
		
		function removeItem(id, mainid, varntid)
		{
			if(id!="" && mainid!="" && varntid!="")
			{
				$('.repeatVar'+varntid+' .repeatAttr'+mainid+' .clone'+id).remove();
			}
		}
		
		function addVarientAttribute(id, varntid)
		{
			if(id!="" && varntid!="")
			{
				$('.repeatVar'+varntid+' .repeatAttr'+id+' .mainButt button').remove();
				var remBut = '<button type="button" onclick="removeVarientAttributes('+id+', '+varntid+')" class="btn btn-danger MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Remove" data-original-title="Remove"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> </button>';
				$('.repeatVar'+varntid+' .repeatAttr'+id+' .mainButt').append(remBut);
				var newid = parseInt(id) + 1;
				
				var html = '';
				html += '<div class="repeatAttr'+newid+'"><div class="row MrgBot10">';
				html += '<label class="col-md-3">Variant Attributes <span class="asterix"> * </span></label>';
				html += '<div class="col-md-7">';
				html += '<div class="row mainattr'+newid+' MrgBot10">';
				html += '<div class="col-md-12">';
				html += '<select name="assigned_attributes['+varntid+'][]" id="assigned_attributes'+newid+'" class="form-control" required="required" onchange="customOptions(this.value, '+newid+', '+varntid+');">';
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
				html += '<button type="button" onclick="addVarientAttribute('+newid+', '+varntid+')" class="btn btn-success MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add More" id="add" data-original-title="Add more"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>';
				html += '</div>';
				html += '</div></div>';
				
				$('.repeatVar'+varntid+' .repeatAttr'+id).after(html);
			}
		}
		
		function removeVarientAttributes(id, varntid)
		{
			if(id!="" && varntid!="")
			{
				$('.repeatVar'+varntid+' .repeatAttr'+id).remove();
			}
		}
		
		
		function addVarient(id)
		{
			if(id!="")
			{
				$('.repeatVar'+id+' .panel-title span').remove();
				var remBut = '<span class="var_remove_Butt" onclick="removeVarient('+id+');"><i class="fa fa-times"></i> Remove</span>';
				$('.repeatVar'+id+' .panel-title').append(remBut);
				var newid = parseInt(id) + 1;
				
				var html = '';
				html += '<div class="panel panel-default repeatVar'+newid+'">';
				html += '<div class="panel-heading">';
				html += '<h4 class="panel-title">';
				html += '<a data-toggle="collapse" data-parent="#accordion" href="#collapse'+newid+'" class="collapsed"><i class="fa fa-angle-right"></i> New Variant(s)</a>';
				html += '<span class="var_add_Butt" onclick="addVarient('+newid+');"><i class="fa fa-plus"></i> Add More</span>';
				html += '</h4>';
				html += '</div>';
				html += '<div id="collapse'+newid+'" class="panel-collapse collapse in" style="height: 0px;">';
				html += '<div class="panel-body">';
				html += '<div class="row MrgBot10">';
				html += '<label class="col-md-3">Variant code <em>*</em></label>';
				html += '<div class="col-md-9">';
				html += '<input name="varient_code['+newid+']" class="form-control" type="text" value="" required="required">';
				html += '</div>';
				html += '</div>';
				html += '<div class="row MrgBot10">';
				html += '<label class="col-md-3">Variant name <em>*</em></label>';
				html += '<div class="col-md-9">';
				html += '<input name="varient_name['+newid+']" class="form-control" type="text" value="" required="required">';
				html += '</div>';
				html += '</div>';
				html += '<div class="row MrgBot10">';
				html += '<label class="col-md-3">Variant image <em>*</em></label>';
				html += '<div class="col-md-9">';
				html += '<input name="varient_image['+newid+']" class="form-control" type="file" required="required">';
				html += '</div>';
				html += '</div>';
				html += '<div class="repeatAttr1"><div class="row MrgBot10">';
				html += '<label class="col-md-3">Variant Attributes <span class="asterix"> * </span></label>';
				html += '<div class="col-md-7">';
				html += '<div class="row mainattr1 MrgBot10">';
				html += '<div class="col-md-12">';
				html += '<select name="assigned_attributes['+newid+'][]" id="assigned_attributes1" class="form-control" required="required" onchange="customOptions(this.value, 1, '+newid+');">';
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
				html += '<div class="row" id="custmOpt1" style="display:none;">';
				html += '<div class="col-md-12">';
				html += '<div class="row attrf">&nbsp;</div>';
				html += '</div>';
				html += '</div>';
				html += '</div>';
				html += '<div class="col-md-2 mainButt">';
				html += '<button type="button" onclick="addVarientAttribute(1, '+newid+')" class="btn btn-success MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add More" id="add" data-original-title="Add more"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>';
				html += '</div>';
				html += '</div></div>';
				html += '</div>';
				html += '</div>';
				html += '</div>';
				
				$('.repeatVar'+id+' #collapse'+id).removeClass('in');
				$('.repeatVar'+id).after(html);
			}
		}
		
		function removeVarient(id)
		{
			if(id!="")
			{
				$('.repeatVar'+id).remove();
			}
		}
		
		function remove_existed_varient(varntId)
		{
			if(varntId>0)
			{
				var confrm = confirm("Are you sure you want to delete this variant!");
				if(confrm==true)
				{
					$.ajax({
					  url: "{{ URL::to('remove_exist_varients')}}",
					  type: "post",
					  data: 'varnt_id='+varntId+'&cont_id={{$fileId}}',
					  dataType: "json",
					  success: function(data){
						if(data!='error')
						{
							$('.varient'+varntId).remove();
							location.reload();
						}
					  }
					});
				}
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
