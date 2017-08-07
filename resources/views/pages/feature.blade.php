<link rel="stylesheet" href="{{ asset('sximo/css/featherlight/featherlight.min.css') }}">
<link rel="stylesheet" href="{{ asset('sximo/css/featherlight/featherlight.gallery.min.css') }}">
<script src="{{ asset('sximo/js/featherlight/featherlight.min.js') }}"></script>
<script src="{{ asset('sximo/js/featherlight/featherlight.gallery.min.js') }}"></script>
<style>
	.panel{ border:none; background-color: transparent; */ }
	.panel-default > .panel-heading { text-align:left; background-color: transparent; }
	.panel-body { padding: 0px; border-top:none !important; }
	.page-1-head { width:100% !important; }
	.material { margin-top:20px; }
	.material img { margin-bottom:10px; }
</style>
<div class="row new-box" >
	@if(empty($slider_images))
	<div class="container21">
		{{--*/ $coverimg = ($folderDetail->cover_img!='')?$folderDetail->cover_img:$folderDetail->temp_cover_img_masonry; 
			$imglink = 'uploads/folder_cover_imgs/product_detail_cover_'.$coverimg; 
			list($width, $height) = getimagesize(public_path().'/'.$imglink);
				$bgsize = 'backsiz'; /*--}}
				@if($height > $width)
					{{--*/ $bgsize = 'backsiz'; /*--}}
				@endif
		<section data-selector="section" id="download-line-2" class="dark-bg2 cover-bg newcol {{$bgsize}}" style="background-image: url('{{URL::to($imglink)}}');">
			
		</section>
	</div>
	@else
	<div class="container slider-con">
		<header id="intro-slider" class="intro-block full-slider no-sep feature-page-slider">
			<div id="carousel-full-header" class="carousel slide carousel-full" data-ride="carousel">
			
				<!-- Indicators -->
				<ol class="carousel-indicators">
				  <li data-target="#carousel-full-header" data-slide-to="0" class="active"></li>
				  @for($sl=1; $sl < count($slider_images); $sl++)
					<li data-target="#carousel-full-header" data-slide-to="{{$sl}}"></li>
				  @endfor
				</ol>
			
				<div class="carousel-inner feature-slidebj" role="listbox" style="background:#b6b6b6;">
					@if(!empty($slider_images))
					{{--*/ $s = 0 /*--}}
						@foreach($slider_images as $slides)
							<!-- Slide 1 -->
							{{--*/ list($width, $height) = getimagesize($slidercontainerpath.$slides->file_name);
							$bgsize = 'backsiz'; /*--}}
							@if($height > $width)
								{{--*/ $bgsize = 'backsiz'; /*--}}
							@endif
							<div class="item cover-bg editBg {{$bgsize}} {{($s==0)?'active':''}}" rel="{{$width}}" rel2="{{$height}}" style="background-image: url('{{$sliderimgpath.$slides->file_name}}');">
								<div class="container double-padding">
									<div class="row">
										<div class="col-md-5 editContent slider-heading">
											<h2 class="big-title"></h2>
											<p></p>
										</div>
									</div>
								</div>
							</div>
							{{--*/ $s++ /*--}}
						@endforeach
					@endif
				</div>
				<!-- Controls -->
				  <a class="left carousel-control" href="#carousel-full-header" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				  </a>
				  <a class="right carousel-control" href="#carousel-full-header" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				  </a>
		</header>
		</div>
	</div>
	@endif

		
<div class="container2">
	<section data-selector="section" id="text-2col">
		<div class="row header-line about-sec">
			<h1 data-selector="h3" class="title product-title" style="margin-top:50px !important;">{{ (\Session::get('newlang')=='English') ? $folderDetail->display_name_eng : $folderDetail->display_name }}</h1>
			<p style="margin-top:20px;">
				@if(!empty($parentArr))
					@foreach($parentArr as $parArr)
						@if(($parentArr[0])!=$parArr)
							@if(end($parentArr)!=$parArr)	
								{{--*/  $act_name = strtolower(str_replace(' ','-',$parArr->display_name));
										$plinkm = URL::to('product/'.$act_name);
								/*--}}
								<a href="{{ $plinkm }}"><b>{{ (\Session::get('newlang')=='English') ? $parArr->display_name_eng : $parArr->display_name}} </b></a> 
							@endif
						@endif
					@endforeach
				@endif
			</p>
		</div>
	</section>
		
	<section id="text-1col">
		
			<div class="row">
				<div class="col-md-12 editContent ghh" style="width:100%; font-size:15px;">
				<!--<p><b>{{$folderDetail->title}}</b></p>-->
				<p style="text-align:left;">{!! (\Session::get('newlang')=='English') ?  nl2br($folderDetail->description_eng) : nl2br($folderDetail->description)!!}</p>
				@if(!empty($custom_desciption))
					<br>
					<p>{{$custom_desciption->product_description}}</p>
				@endif
				<br><br>
				{{--*/  $pro_name = strtolower(str_replace(' ','-',$folderDetail->display_name));
				/*--}}
				<p><a href="#" onclick="window.history.back();return false;"><i class="fa fa-reply"></i> {{ (\Session::get('newlang')=='English') ? 'Previous' : 'Zurück zur Auswahl' }}</a>&nbsp; | &nbsp;<a href="{{(\Auth::check() == true)? URL::to('downloadproduct/'.$act_name.'/'.$pro_name):'#'}}" @if(\Auth::check() == false) data-dismiss="modal" data-toggle="modal" data-target="#myModal1" onclick="showLogin();" @endif ><i class="fa fa-download"></i> Download</a>&nbsp; | &nbsp; <a href="{{URL::to('productgallery/'.$act_name.'/'.$pro_name)}}" >  <img src="{{URL::to('sximo/images/ICON-GALERIE.png')}}" alt="gallery"> {{ (\Session::get('newlang')=='English') ? 'Gallery' : 'Galerie' }}</a>
				
				@if(\Auth::check() == true)
					@if($folderDetail->id==98)
						&nbsp; | &nbsp;<a href="{{URL::to('databanken/448')}}">Monolithdatenbank</a>
					@elseif($folderDetail->id==77)
						&nbsp; | &nbsp;<a href="{{URL::to('databanken/449')}}">Steindatenbank</a>
					@elseif($folderDetail->id==91)
						<!--&nbsp; | &nbsp;<a href="{{URL::to('databanken/450')}}">SK07 Datenbank</a>-->
					@endif
				@endif
				</p>
				</div>
			</div>
		
	</section>

	@if(!empty($variant_images))
		@foreach($variant_images as $files)
			<section data-selector="section" id="download-line-2" class="dark-bg cover-bg2" >
			
					<div class="row">
						<div class="col-md-12">
							<img src="{{URL::to('uploads/thumbs/product_detail_list_'.$files->file_name)}}" />
						</div>
					</div>	
				
			</section>

			<header>
				<div class="page-1-head">
					<div class="row">
						@if(!empty($parentArr))
							@foreach($parentArr as $parArr)
								@if(($parentArr[0])!=$parArr)
									@if(end($parentArr)!=$parArr)	
										<b>{{ (\Session::get('newlang')=='English') ? $parArr->display_name_eng : $parArr->display_name}} </b> / 
									@else
										<b>{{ (\Session::get('newlang')=='English') ? $parArr->display_name_eng : $parArr->display_name}}</b>
									@endif
								@endif
							@endforeach
						@endif
					</div>
					@if(!empty($AttrArr))
						@if(!empty($AttrArr[$files->id]['Material']))
							<br>
							<div class="row" style="margin: 0 auto;">
							@foreach($AttrArr[$files->id]['Material'] as $assAttr)
								@if($assAttr['AttrType']=="text" || $assAttr['AttrType']=="textarea")
									<b>{{(\Session::get('newlang')=='English') ? $assAttr['Attrs']->attr_title_eng : $assAttr['Attrs']->attr_title }}</b>
									<p>{{$assAttr['AttrVal']}}</p><br>
								@elseif($assAttr['AttrType']=="file")
									<?php $exp_mul_file = explode('::',$assAttr['AttrVal']); ?>
									@foreach($exp_mul_file as $imgs)
										<a href="{{URL::to('uploads/attributes_imgs/'.trim($imgs))}}" target="_blank" class="previewImage gallery2">
											<img src="{{URL::to('uploads/attributes_imgs/'.trim($imgs))}}" title="{{trim($imgs)}}" class="img-responsive" width="80" height="80"/>
										</a>
										@if(end($exp_mul_file)!=$imgs)
											,&nbsp;
										@endif
									@endforeach	
								@elseif($assAttr['AttrType']=="dropdown" || $assAttr['AttrType']=="checkboxes" || $assAttr['AttrType']=="radio")
									<b>{{ (\Session::get('newlang')=='English') ?  $assAttr['Attrs']->attr_title_eng : $assAttr['Attrs']->attr_title}}</b>
									@foreach($assAttr['AttrVal'] as $attropts)
										{{ (\Session::get('newlang')=='English') ? $attropts->option_name_eng : $attropts->option_name}}
										
										@if($assAttr['Attrs']->attr_cat=="Materialien")
											@if($attropts->attr_img !='')
												<?php $attrFile = explode('.',$attropts->attr_img); ?>
												@if($attrFile[1]=="jpg" || $attrFile[1]=="png" || $attrFile[1]=="gif" || $attrFile[1]=="bmp" || $attrFile[1]=="jpeg" || $attrFile[1]=="JPG") 
													<a href="{{URL::to('uploads/attributes_imgs/'.$attropts->attr_img)}}" target="_blank" class="previewImage gallery2">
														<img src="{{URL::to('uploads/attributes_imgs/'.$attropts->attr_img)}}" title="{{$attropts->attr_img}}" class="img-responsive" width="80" height="80"/>
													</a>
												@else
													<img src="{{URL::to('uploads/images/').'/no_thumb.gif'}}" class="img-responsive">
												@endif
											@endif
										@endif
										
										@if(end($assAttr['AttrVal'])!=$attropts)
											,&nbsp;
										@endif 
										
									@endforeach
									<br>
								@elseif($assAttr['AttrType']=="group")
									@if(!empty($assAttr['grouphead']))
										<p style="margin-left: 15px; text-align:left;"><b>{{ (\Session::get('newlang')=='English') ? $assAttr['Attrs']->attr_desc_eng : $assAttr['Attrs']->attr_desc }}</b></p>
										<table class="table sizetable" id="altered-measurements-table">
											<tr>
												@foreach($assAttr['grouphead'] as $ghead)
													<th>{{ (\Session::get('newlang')=='English') ? $ghead->attr_title_eng : $ghead->attr_title}}</th>
												@endforeach
											</tr>
											@if(!empty($assAttr['groupdata']))
												@foreach($assAttr['groupdata'] as $groupdata)
												<tr>
													@foreach($groupdata as $attval)
														@foreach($attval as $allAttrval)
															<td>
																{{ (\Session::get('newlang')=='English') ?  $allAttrval->option_name_eng : $allAttrval->option_name}} 
																@if(end($attval)!=$allAttrval)
																	,&nbsp;
																@endif
															</td>
														@endforeach
													@endforeach
												</tr>
												@endforeach
											@endif
										</table>
									@endif
								@endif
							@endforeach
							</div>
						@endif
						
						<div class="panel-group accordion" id="accordion" style="margin-top:50px;">
							@if(!empty($AttrArr[$files->id]['Materialien']))
								<div class="panel panel-default">
									<div class="panel-heading">
									<hr style="width:100%; margin-bottom:20px;" />
										<h3 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseM{{$files->id}}">
												{{\Lang::get('core.menu_frontend_attribute_heading_materialien')}}
											</a>
										</h3>
									</div>
									<div id="collapseM{{$files->id}}" class="panel-collapse in" style="height: auto;">
										<div class="panel-body">
											@foreach($AttrArr[$files->id]['Materialien'] as $assAttr)
												@if($assAttr['AttrType']=="text" || $assAttr['AttrType']=="textarea")
													<p>{{$assAttr['AttrVal']}}</p>
												@elseif($assAttr['AttrType']=="file")
													<?php $exp_mul_file = explode('::',$assAttr['AttrVal']); ?>
													@foreach($exp_mul_file as $imgs)
														<a href="{{URL::to('uploads/attributes_imgs/'.trim($imgs))}}" target="_blank" class="previewImage gallery2">
															<img src="{{URL::to('uploads/attributes_imgs/'.trim($imgs))}}" title="{{trim($imgs)}}" class="img-responsive" width="80" height="80"/>
														</a>
														@if(end($exp_mul_file)!=$imgs)
															,&nbsp;
														@endif
													@endforeach	
												@elseif($assAttr['AttrType']=="dropdown" || $assAttr['AttrType']=="checkboxes" || $assAttr['AttrType']=="radio")
													<h3 class="panel-title addMat">
														{{ (\Session::get('newlang')=='English') ?  $assAttr['Attrs']->attr_title_eng : $assAttr['Attrs']->attr_title}}
													</h3>
													<ul>
														@foreach($assAttr['AttrVal'] as $attropts)
															<li class="material col-xs-6 col-md-4 col-lg-3">
																@if($assAttr['Attrs']->attr_cat=="Materialien")
																	@if($attropts->attr_img !='')
																		<?php $attrFile = explode('.',$attropts->attr_img); ?>
																		@if($attrFile[1]=="jpg" || $attrFile[1]=="png" || $attrFile[1]=="gif" || $attrFile[1]=="bmp" || $attrFile[1]=="jpeg" || $attrFile[1]=="JPG") 
																			<a href="{{URL::to('uploads/attributes_imgs/'.$attropts->attr_img)}}" target="_blank" class="previewImage gallery2">
																				<img src="{{URL::to('uploads/attributes_imgs/'.$attropts->attr_img)}}" title="{{$attropts->attr_img}}" class="img-responsive" style="height:120px;"/>
																			</a>
																		@else
																			<img src="{{URL::to('uploads/images/').'/no_thumb.gif'}}" class="img-responsive">
																		@endif
																		<p class="mat_text">{{ (\Session::get('newlang')=='English') ?  $attropts->option_name_eng : $attropts->option_name}}</p>
																	@endif
																@endif
															</li>
														@endforeach
													</ul>
													
													
												@elseif($assAttr['AttrType']=="group")
													@if(!empty($assAttr['grouphead']))
														{{--*/ 
															usort($assAttr['grouphead'], function($a, $b) {
																return $a->sort_order - $b->sort_order; 
															});
														/*--}}
														<p style="margin-left: 15px; text-align:left;"><b>{{ (\Session::get('newlang')=='English') ? $assAttr['Attrs']->attr_desc_eng : $assAttr['Attrs']->attr_desc}}</b></p>
														<table class="table sizetable" id="altered-measurements-table">
															<tr>
																@foreach($assAttr['grouphead'] as $ghead)
																	<th>{{ (\Session::get('newlang')=='English') ?  $ghead->attr_title_eng : $ghead->attr_title}}</th>
																@endforeach
															</tr>
															@if(!empty($assAttr['groupdata']))
																@foreach($assAttr['groupdata'] as $groupdata)
																<tr>
																	{{--*/ 
																		ksort($groupdata);
																	/*--}}
																	@foreach($groupdata as $attval)
																		@foreach($attval as $allAttrval)
																			<td>
																				{{ (\Session::get('newlang')=='English') ? $allAttrval->option_name_eng : $allAttrval->option_name}} 
																				@if(end($attval)!=$allAttrval)
																					,&nbsp;
																				@endif
																			</td>
																		@endforeach
																	@endforeach
																</tr>
																@endforeach
															@endif
														</table>
													@endif
												@endif
											@endforeach
											@if(!empty($AttrArr[$files->id]['Materialien_additional']))
												@foreach($AttrArr[$files->id]['Materialien_additional'] as $assAttr)
													<h3 class="panel-title addMat">
														{{ (\Session::get('newlang')=='English') ?   $assAttr['Attrs']->attr_title_eng : $assAttr['Attrs']->attr_title}}
													</h3>
													@if($assAttr['AttrType']=="dropdown" || $assAttr['AttrType']=="checkboxes" || $assAttr['AttrType']=="radio")
														<ul class="addMat" style="margin-left:0px;">
															@foreach($assAttr['AttrVal'] as $attropts)
																<li class="material col-xs-6 col-md-4 col-lg-3">
																	@if($assAttr['Attrs']->attr_cat=="Materialien_additional")
																		@if($attropts->attr_img !='')
																			<?php $attrFile = explode('.',$attropts->attr_img); ?>
																			@if($attrFile[1]=="jpg" || $attrFile[1]=="png" || $attrFile[1]=="gif" || $attrFile[1]=="bmp" || $attrFile[1]=="jpeg" || $attrFile[1]=="JPG") 
																				<a href="{{URL::to('uploads/attributes_imgs/'.$attropts->attr_img)}}" target="_blank" class="previewImage gallery2">
																					<img src="{{URL::to('uploads/attributes_imgs/'.$attropts->attr_img)}}" title="{{$attropts->attr_img}}" class="img-responsive" style="height:120px;"/>
																				</a>
																			@else
																				<img src="{{URL::to('uploads/images/').'/no_thumb.gif'}}" class="img-responsive">
																			@endif
																			<p class="mat_text">{{ (\Session::get('newlang')=='English') ?  $attropts->option_name_eng : $attropts->option_name}}</p>
																		@endif
																	@endif
																</li>
															@endforeach
														</ul>
													@endif
												@endforeach
											@endif
										</div>
									</div>
								</div>	
							@endif
							
							@if(!empty($AttrArr[$files->id]['Size']))
								<div class="panel panel-default">
									<div class="panel-heading">
										<hr style="width:100%; margin-bottom:20px;" />
										<h3 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseS{{$files->id}}">
												{{\Lang::get('core.menu_frontend_attribute_heading_abmessungen')}}
											</a>
										</h3>
									</div>
									<div id="collapseS{{$files->id}}" class="panel-collapse in" style="height: auto;">
										<div class="panel-body">
											@foreach($AttrArr[$files->id]['Size'] as $assAttr)
												@if($assAttr['AttrType']=="text" || $assAttr['AttrType']=="textarea")
													<p>{{$assAttr['AttrVal']}}</p>
												@elseif($assAttr['AttrType']=="file")
													<?php $exp_mul_file = explode('::',$assAttr['AttrVal']); ?>
													@foreach($exp_mul_file as $imgs)
														<a href="{{URL::to('uploads/attributes_imgs/'.trim($imgs))}}" target="_blank" class="previewImage gallery2">
															<img src="{{URL::to('uploads/attributes_imgs/'.trim($imgs))}}" title="{{trim($imgs)}}" class="img-responsive" width="80" height="80"/>
														</a>
														@if(end($exp_mul_file)!=$imgs)
															,&nbsp;
														@endif
													@endforeach	
												@elseif($assAttr['AttrType']=="dropdown" || $assAttr['AttrType']=="checkboxes" || $assAttr['AttrType']=="radio")
													@foreach($assAttr['AttrVal'] as $attropts)
														{{ (\Session::get('newlang')=='English') ? $attropts->option_name_eng : $attropts->option_name}}
														
														@if($assAttr['Attrs']->attr_cat=="Materialien")
															@if($attropts->attr_img !='')
																<?php $attrFile = explode('.',$attropts->attr_img); ?>
																@if($attrFile[1]=="jpg" || $attrFile[1]=="png" || $attrFile[1]=="gif" || $attrFile[1]=="bmp" || $attrFile[1]=="jpeg" || $attrFile[1]=="JPG") 
																	<a href="{{URL::to('uploads/attributes_imgs/'.$attropts->attr_img)}}" target="_blank" class="previewImage gallery2">
																		<img src="{{URL::to('uploads/attributes_imgs/'.$attropts->attr_img)}}" title="{{$attropts->attr_img}}" class="img-responsive" width="80" height="80"/>
																	</a>
																@else
																	<img src="{{URL::to('uploads/images/').'/no_thumb.gif'}}" class="img-responsive">
																@endif
															@endif
														@endif
														
														@if(end($assAttr['AttrVal'])!=$attropts)
															,&nbsp;
														@endif 
														
													@endforeach
												@elseif($assAttr['AttrType']=="group")
													@if(!empty($assAttr['grouphead']))
														{{--*/ 
															usort($assAttr['grouphead'], function($a, $b) {
																return $a->sort_order - $b->sort_order; 
															});
														/*--}}
														<p style="margin-left: 15px; text-align:left;"><b>{{ (\Session::get('newlang')=='English') ?  $assAttr['Attrs']->attr_desc_eng : $assAttr['Attrs']->attr_desc}}</b></p>
														<table class="table sizetable" id="altered-measurements-table">
															<tr>
																@foreach($assAttr['grouphead'] as $ghead)
																	<th>{{ (\Session::get('newlang')=='English') ?  $ghead->attr_title_eng : $ghead->attr_title}}</th>
																@endforeach
															</tr>
															@if(!empty($assAttr['groupdata']))
																@foreach($assAttr['groupdata'] as $groupdata)
																<tr>
																	{{--*/ 
																		ksort($groupdata);
																	/*--}}
																	@foreach($groupdata as $attval)
																		@foreach($attval as $allAttrval)
																			<td>
																				{{ (\Session::get('newlang')=='English') ? $allAttrval->option_name_eng : $allAttrval->option_name}} 
																				@if(end($attval)!=$allAttrval)
																					,&nbsp;
																				@endif
																			</td>
																		@endforeach
																	@endforeach
																</tr>
																@endforeach
															@endif
														</table>
													@endif
												@endif
											@endforeach
										</div>
									</div>
								</div>
							@endif
						</div>
					@endif
				</div>
			</header><!-- TEXT 2COL BLOCK -->
		@endforeach
	@endif
</div>
<br>
<script>

	$(function(){
		$('.gallery2').featherlightGallery({
			gallery: {
				fadeIn: 300,
				fadeOut: 300
			},
			variant: 'featherlight-gallery2'
		});
	});
</script>
