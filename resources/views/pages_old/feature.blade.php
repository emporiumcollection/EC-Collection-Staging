
<div class="row new-box" >
	@if(empty($slider_images))
	<div class="container2">
		{{--*/ $coverimg = ($folderDetail->cover_img!='')?$folderDetail->cover_img:$folderDetail->temp_cover_img_masonry; 
			$imglink = 'uploads/folder_cover_imgs/product_detail_cover_'.$coverimg;  /*--}}
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
				  @for($sl=1; $sl < count($slider_images); $sl++)
					<li data-target="#carousel-full-header" data-slide-to="{{$sl}}"></li>
				  @endfor
				</ol>
			
				<div class="carousel-inner" role="listbox" style="background:#d8d7d8;">
					@if(!empty($slider_images))
					{{--*/ $s = 0 /*--}}
						@foreach($slider_images as $slides)
							<!-- Slide 1 -->
							<div class="item cover-bg editBg {{($s==0)?'active':''}}" style="background-image: url('{{$sliderimgpath.$slides->file_name}}');">
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
							/ 
							@if(end($parentArr)!=$parArr)	
								<a href="{{ URL::to('subproduct/'.$parArr->id) }}"><b>{{$parArr->name}} </b></a>
							@else
								{{$parArr->name}}
							@endif
						@endif
					@endforeach
				@endif
			</p>
			<p><a href="{{URL::to('downloadproduct/'.$folderDetail->id)}}">Download</a></p>
		</div>
	</section>
	
	<section data-selector="section" id="text-2col">
		<div class="row header-line about-sec">
			<h1 data-selector="h3" class="title" style="margin-top:50px !important;">{{$folderDetail->title}}</h1>
			<p></p>
		</div>
	</section>
		
	<section id="text-1col">
		
			<div class="row">
				<div class="col-md-12 editContent">
					
					<p>{{$folderDetail->description}}</p>
				</div>
			</div>
		
	</section>

	@if(!empty($variant_images))
		@foreach($variant_images as $files)
			<section data-selector="section" id="download-line-2" class="dark-bg cover-bg2" style="background-image: url('{{URL::to('uploads/thumbs/product_detail_list_'.$files->file_name)}}');">
			
					<div class="row">
						<div class="col-md-12">
						
						</div>
					</div>	
				
			</section>

			<header>
				<div class="page-1-head">
					<h4>{{ ($files->file_display_name!='') ? $files->file_display_name : $files->file_name }}</h4>
				</div>
			</header><!-- TEXT 2COL BLOCK -->
		@endforeach
	@endif
</div>
<br>
<!-- footer include start -->
	@include('layouts/elliot/bottombar')
  <!-- footer include end -->