<div class="row new-box" >
	@if(empty($designer))
	<div class="container21">
		<section data-selector="section" id="download-line-2" class="dark-bg2 cover-bg newcol backsiz" style="background-image: url('{{URL::to('uploads/images/111.png')}}');">
			
		</section>
	</div>
	@else
	<div class="container slider-con">
		<header id="intro-slider" class="intro-block full-slider no-sep feature-page-slider">
			<div id="carousel-full-header" class="carousel slide carousel-full" data-ride="carousel">
			
				<!-- Indicators -->
				<ol class="carousel-indicators">
				  <li data-target="#carousel-full-header" data-slide-to="0" class="active"></li>
					@if(!empty($designer->designer_image2))
						<li data-target="#carousel-full-header" data-slide-to="1"></li>
					@endif
					@if(!empty($designer->designer_image3))
						<li data-target="#carousel-full-header" data-slide-to="2"></li>
					@endif
					@if(!empty($designer->designer_image4))
						<li data-target="#carousel-full-header" data-slide-to="3"></li>
					@endif
				</ol>
			
				<div class="carousel-inner feature-slidebj" role="listbox" style="background:#b6b6b6;">
					@if(!empty($designer->designer_image))
						<div class="item cover-bg editBg backsiz active" style="background-image: url('{{URL::to('uploads/designer_images/'.$designer->designer_image)}}');">
							<div class="container double-padding">
								<div class="row">
									<div class="col-md-5 editContent slider-heading">
										<h2 class="big-title"></h2>
										<p></p>
									</div>
								</div>
							</div>
						</div>
					@endif
					@if(!empty($designer->designer_image2))
						<div class="item cover-bg editBg backsiz" style="background-image: url('{{URL::to('uploads/designer_images/'.$designer->designer_image2)}}');">
							<div class="container double-padding">
								<div class="row">
									<div class="col-md-5 editContent slider-heading">
										<h2 class="big-title"></h2>
										<p></p>
									</div>
								</div>
							</div>
						</div>
					@endif
					@if(!empty($designer->designer_image3))
						<div class="item cover-bg editBg backsiz" style="background-image: url('{{URL::to('uploads/designer_images/'.$designer->designer_image3)}}');">
							<div class="container double-padding">
								<div class="row">
									<div class="col-md-5 editContent slider-heading">
										<h2 class="big-title"></h2>
										<p></p>
									</div>
								</div>
							</div>
						</div>
					@endif
					@if(!empty($designer->designer_image4))
						<div class="item cover-bg editBg backsiz" style="background-image: url('{{URL::to('uploads/designer_images/'.$designer->designer_image4)}}');">
							<div class="container double-padding">
								<div class="row">
									<div class="col-md-5 editContent slider-heading">
										<h2 class="big-title"></h2>
										<p></p>
									</div>
								</div>
							</div>
						</div>
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
				
				<h1 data-selector="h3" class="title design-title">{{(!empty($designer))? (\Session::get('newlang')=='English') ? $designer->designer_name_eng : $designer->designer_name : 'Hoffmann & Kahleyss'}} </h1>

				
				</div>
			
		</section><!-- PORTFOLIO GRID FULL 2 BLOCK -->
	
	
    
    	<!-- TEXT 1COL BLOCK -->
		<section id="text-1col">
			<div class="row">
				<div class="col-md-12 editContent design-desc">
					
					<p>
					@if(!empty($designer))
						{!! (\Session::get('newlang')=='English') ? $designer->designer_description_eng : $designer->designer_description !!}
					@else
						{{'So, what is the secret of successful template design? First of all, it is its friendliness – both for the template’s owner and for his or her future targeted audience. UX and UI are not just empty phrases for us. It is very important for us that the user could understand correctly the message your project’s trying to say to him or her. But, correct giving of the information is just a half of success. Emotions that causes your project in visitor are no less important ticket to success. Modern solutions, interesting elements, unique approach to details make this template recognizable and interesting. You project will not look like a template bought in a store and adapted within couple of hours. Oh, no! This is not your case. You obtain qualitative, fascinating and juicy final product that is modern and actual. Qualitative and flexible code lays in base of this great product.'}}
					@endif
					</p>
				</div>
			</div>
			
		</section>
		
		@if(!empty($productAttrArr))
			@foreach($productAttrArr as $files)
				<section data-selector="section" id="download-line-2" class="dark-bg cover-bg2" >
				
						<div class="row">
							<div class="col-md-12">
								{{--*/ $linktext = ''; /*--}}
								@if(!empty($files['productparentArr']))
									@foreach($files['productparentArr'] as $parArr)
										@if(($files['productparentArr'][0])!=$parArr)
											@if(end($files['productparentArr'])!=$parArr)	
											{{--*/ $linktext .= $parArr->display_name.'/'; /*--}}
											@else
												{{--*/ $linktext .= $parArr->display_name; /*--}}
											@endif
										@endif
									@endforeach
								@endif
								{{--*/ $link = strtolower(str_replace(' ','-',$linktext)); /*--}}
								<a href="{{URL::to('product/'.$link)}}">
									<img src="{{URL::to('uploads/thumbs/product_detail_list_'.$files['productfile']->file_name)}}" />
								</a>
							</div>
						</div>	
					
				</section>

				<header>
					<div class="page-1-head">
						<div class="row">
							@if(!empty($files['productparentArr']))
								@foreach($files['productparentArr'] as $parArr)
									@if(($files['productparentArr'][0])!=$parArr)
										@if(end($files['productparentArr'])!=$parArr)	
											<b>{{ (\Session::get('newlang')=='English') ? $parArr->display_name_eng : $parArr->display_name }} </b> / 
										@else
											<b>{{ (\Session::get('newlang')=='English') ? $parArr->display_name_eng : $parArr->display_name }}</b>
										@endif
									@endif
								@endforeach
							@endif
						</div>
						@if(!empty($files['productAttr']))
							@if(!empty($files['productAttr']['Material']))
								<br>
								<b>Material:</b>
								@foreach($files['productAttr']['Material'] as $assAttr)
									
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
											{{ (\Session::get('newlang')=='English') ? $attropts->option_name_eng : $attropts->option_name }}
											
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
								@endforeach
							@endif
							
							@if(!empty($files['productAttr']['Size']))
								<br>
								<b>Size:</b>
								@foreach($files['productAttr']['Size'] as $assAttr)
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
											{{ (\Session::get('newlang')=='English') ? $attropts->option_name_eng : $attropts->option_name }}
											
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
								@endforeach
							@endif
						@endif
					</div>
				</header><!-- TEXT 2COL BLOCK -->
			@endforeach
		@endif
	
	</div>
