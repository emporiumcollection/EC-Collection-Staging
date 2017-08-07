<div class="container slider-con">
	<header id="intro-slider" class="intro-block full-slider no-sep">
		<div id="carousel-full-header" class="carousel slide carousel-full" data-ride="carousel">
		
			<!-- Indicators -->
			<ol class="carousel-indicators">
			  <li data-target="#carousel-full-header" data-slide-to="0" class="active"></li>
			  <li data-target="#carousel-full-header" data-slide-to="1"></li>
			  <li data-target="#carousel-full-header" data-slide-to="2"></li>
			  
			</ol>
		
			<div class="carousel-inner" role="listbox" style="background:#d8d7d8;">
				@if(!empty($slider))
				{{--*/ $s = 0 /*--}}
					@foreach($slider as $slides)
						<!-- Slide 1 -->
						<div class="item cover-bg editBg {{($s==0)?'active':''}}" style="background-image: url('{{URL::to('uploads/slider_images/'.$slides->slider_img)}}');">
							<div class="container double-padding">
								<div class="row">
									<div class="col-md-5 editContent slider-heading">
										<h2 class="big-title">{{$slides->slider_title}}</h2>
										<p><a href="{{$slides->slider_link}}">{{$slides->slider_description}}</a></p>
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
		   
   <section data-selector="section" id="text-2col">
	<div class="container">
		<div class="row">
			@if(!empty($frontend_folder))
				@foreach($frontend_folder as $folder)
					<div class="col-sm-4 three-box-top">
					  <h1 data-selector="h3" class="title"><a href="{{URL::to('subproduct/'.$folder->id)}}">{{$folder->name}}</a></h1>
					  <div class="box-img">
						{{--*/ $FrontcoverPic = ($folder->cover_img!='')? URL::to('uploads/folder_cover_imgs/front_'.$folder->cover_img): URL::to('uploads/images/front_no-image.jpg'); /*--}}
						<a href="{{URL::to('feature/'.$folder->id)}}"><img class="img-responsive" src="{{$FrontcoverPic}}" alt="images-1" /></a>
					  </div>
					  <div class="text-section">
						  <span class="sm-heading">JANUA®- neu im team</span>
						  <h4 class="bottom-box-heading">{{$folder->title}}</h4>
						  <p>{{$folder->description}}</p>
						  <span class="sm-heading">{{ date("d. m. Y", strtotime($folder->created)) }}</span>
					  </div>
					</div>
				@endforeach
			@endif
		</div>
		@if(!empty($cat_aktuelles))
		<div class="row aktuelles">
			<div class="sction-head">
				<h1 class="title" data-selector="h3">Aktuelles</h1>
			</div>
				@foreach($cat_aktuelles as $aktuelles)
					<div class="col-sm-4 three-box-aktuelles">
						{{--*/ $FrontcatPic = ($aktuelles->image_pos_1!='')? URL::to('uploads/images/front_'.$aktuelles->image_pos_1): URL::to('uploads/images/front_cat_no-image.jpg'); /*--}}
						<a href="{{URL::to('newsdetail/'.$aktuelles->id)}}"><img class="img-responsive" src="{{$FrontcatPic}}" alt="images-1" /></a>
						<div class="text-section">
							<h4 class="bottom-aktuelles-heading"><a href="{{URL::to('newsdetail/'.$aktuelles->id)}}">{{$aktuelles->title_pos_1}}</a></h4>
							<p>{{ substr(strip_tags($aktuelles->description_pos_1),0,100)}}</p>
						</div>
					</div>
				@endforeach
		</div>
		@endif
		
		@if(!empty($cat_info))
		<div class="row aktuelles info">
			<div class="sction-head">
				<h1 class="title" data-selector="h3">Info</h1>
			</div>
				@foreach($cat_info as $info)
					<div class="col-sm-4 three-box-aktuelles">
						{{--*/ $FrontcatPic = ($info->image_pos_1!='')? URL::to('uploads/images/front_'.$info->image_pos_1): URL::to('uploads/images/front_cat_no-image.jpg'); /*--}}
						<a href="{{URL::to('newsdetail/'.$info->id)}}"><img class="img-responsive" src="{{$FrontcatPic}}" alt="images-1" /></a>
						<div class="text-section">
							<h4 class="bottom-aktuelles-heading"><a href="{{URL::to('newsdetail/'.$info->id)}}">{{$info->title_pos_1}}</a></h4>
							<p>{{ substr(strip_tags($info->description_pos_1),0,100)}}</p>
						</div>
					</div>
				@endforeach	
		</div>		
		@endif
		
		@if(!empty($cat_presse))
		<div class="row aktuelles Presse">
			<div class="sction-head">
				<h1 class="title" data-selector="h3">Presse</h1>
			</div>
				@foreach($cat_presse as $cpresse)
					<div class="col-sm-4 three-box-aktuelles">
					{{--*/ $FrontcatPic = ($cpresse->image_pos_1!='')? URL::to('uploads/images/front_'.$cpresse->image_pos_1): URL::to('uploads/images/front_cat_no-image.jpg'); /*--}}
						<a href="{{URL::to('newsdetail/'.$cpresse->id)}}"><img class="img-responsive" src="{{$FrontcatPic}}" alt="images-1" /></a>
						<div class="text-section">
							<h4 class="bottom-aktuelles-heading"><a href="{{URL::to('newsdetail/'.$cpresse->id)}}">{{$cpresse->title_pos_1}}</a></h4>
							<p>{{ substr(strip_tags($cpresse->description_pos_1),0,100)}}</p>
						</div>
					</div>
				@endforeach
		</div>
		@endif
   
		<div class="row page-service">
			<div class="sction-head">
				<h1 class="title" data-selector="h3">Service</h1>
			</div>
			<div class="col-sm-4 three-box-service">
				<a href="{{URL::to('service')}}">JANUA® in Ihrer Nähe Bestellung unseres Newsletters Log—in für Downloads</a>
			</div>
			<div class="col-sm-4 three-box-service">
				<a href="{{URL::to('serviceone')}}">Unser Material und Pflegehinweis Unser Bild- und Textmaterial Log—in für Bestellungen</a>
			</div>
			<div class="col-sm-4 three-box-service">
				<a href="{{URL::to('servicetwo')}}">Widerrufsrecht für Endkunden AGB und Datenschutz Alles über unseren Showroom</a>
			</div>
		</div>	
		
		<div class="row page-kontakte">
			<div class="sction-head">
				<h1 class="title" data-selector="h3">Kontakte</h1>
			</div>
			<div class="col-sm-4 three-box-kontakte">
				@if(!empty($head_office))
				{!! $head_office->content !!}
				@endif
			</div>
			<div class="col-sm-4 three-box-kontakte">
				@if(!empty($gesamtvertrieb))
				{!! $gesamtvertrieb->content !!}
				@endif
			</div>
			<div class="col-sm-4 three-box-kontakte">
				@if(!empty($presse))
				{!! $presse->content !!}
				@endif
			</div>
		</div>
   
	  
   
	</div>
  </section>
  
  <!-- footer include start -->
	@include('layouts/elliot/bottombar')
  <!-- footer include end -->