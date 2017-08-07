
<div class="row new-box" >
	@if(empty($sub_images))
	<div class="container2">
		{{--*/ $imglink = $fileDetail->imgsrc .$fileDetail->file_name;  /*--}}
		<section data-selector="section" id="download-line-2" class="dark-bg2 cover-bg newcol" style="background-image: url('{{URL::to($imglink)}}');">
			
		</section>
	</div>
	@else
	<div class="container slider-con">
		<header id="intro-slider" class="intro-block full-slider no-sep">
			<div id="carousel-full-header" class="carousel slide carousel-full" data-ride="carousel">
			
				<!-- Indicators -->
				<ol class="carousel-indicators">
				  <li data-target="#carousel-full-header" data-slide-to="0" class="active"></li>
				  @for($sl=1; $sl <= count($sub_images); $sl++)
					<li data-target="#carousel-full-header" data-slide-to="{{$sl}}"></li>
				  @endfor
				</ol>
			
				<div class="carousel-inner" role="listbox" style="background:#d8d7d8;">
					@if(!empty($sub_images))
					{{--*/ $s = 0 /*--}}
						<div class="item cover-bg editBg {{($s==0)?'active':''}}" style="background-image: url('{{URL::to($fileDetail->imgsrc .$fileDetail->file_name)}}');">
							<div class="container double-padding">
								<div class="row">
									<div class="col-md-5 editContent slider-heading">
										<h2 class="big-title"></h2>
										<p></p>
									</div>
								</div>
							</div>
						</div>
						
						@foreach($sub_images as $slides)
							<!-- Slide 1 -->
							<div class="item cover-bg editBg" style="background-image: url('{{URL::to('uploads/file_sub_images/'.$slides->sub_image)}}');">
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
		</header>
		</div>
	</div>
	@endif

		
<div class="container2">
	<section data-selector="section" id="text-2col">
		<div class="row header-line about-sec">
			<p style="margin-top:20px;">
				@if(!empty($parentArr))
					<a href="{{ URL::to('products') }}"><b>Produktgruppen </b></a>
					@foreach($parentArr as $parArr)
						@if(($parentArr[0])!=$parArr) 
						 / <a href="{{ URL::to('subproduct/'.$parArr->id) }}"><b>{{$parArr->name}} </b></a>
						@endif
					@endforeach
				@endif
			</p>
		</div>
	</section>
	
	<section data-selector="section" id="text-2col">
		<div class="row header-line about-sec">
			<h1 data-selector="h3" class="title" style="margin-top:50px !important;">{{$fileDetail->file_title}}</h1>
			<p></p>
		</div>
	</section>
		
	<section id="text-1col">
		
			<div class="row">
				<div class="col-md-12 editContent">
					
					<p>{{$fileDetail->file_description}}</p>
				</div>
			</div>
		
	</section>

	@if(!empty($varients))
		@foreach($varients as $varient)
			<section data-selector="section" id="download-line-2" class="dark-bg cover-bg2" style="background-image: url('{{URL::to('uploads/varients_imgs/'.$varient->varient_image)}}');">
			
					<div class="row">
						<div class="col-md-12">
						
						</div>
					</div>	
				
			</section>

			<header>
				<div class="page-1-head">
					<h4>{{$varient->varient_code}} / {{$varient->varient_name}}</h4>
					<p>
					@if(!empty($varient_attrs))
						@foreach($varient_attrs[$varient->id] as $assAttr)
							<div class="attr{{$assAttr['Attrs']->id}}" >
								<b>{{$assAttr['Attrs']->attr_title}}:</b>
								@if($assAttr['AttrType']=="text" || $assAttr['AttrType']=="textarea")
										{{$assAttr['AttrVal']}}
								@elseif($assAttr['AttrType']=="file")
									<?php $exp_mul_file = explode('::',$assAttr['AttrVal']); ?>
									@foreach($exp_mul_file as $imgs)
										<a href="{{URL::to('uploads/varients_imgs/attributes_imgs/'.trim($imgs))}}" target="_blank" class="previewImage">
											<img src="{{URL::to('uploads/varients_imgs/attributes_imgs/'.trim($imgs))}}" title="{{trim($imgs)}}" class="img-responsive" width="80" height="80"/>
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
										@if(end($assAttr['AttrVal'])!=$attropts)
											,&nbsp;
										@endif
									@endforeach
								@endif
							</div>
						@endforeach
					@endif
					</p>
				</div>
			</header><!-- TEXT 2COL BLOCK -->
		@endforeach
	@endif
</div>
<br>
<!-- footer include start -->
	@include('layouts/elliot/bottombar')
  <!-- footer include end -->