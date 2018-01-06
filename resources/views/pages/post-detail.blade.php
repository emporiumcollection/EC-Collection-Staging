@include('layouts/elliot/ai_header')
@include('layouts/elliot/ai_navigation_bar_style_2')

<link href="{{ asset('sximo/assets/css/footer-accordian.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/filters_grid.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/filter-bar.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/stick-nav-arrows.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/detail-page.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/animate.css')}}" rel="stylesheet" type="text/css"/>

<script src="{{ asset('sximo/assets/js/animate.js')}}" type="text/javascript"></script>

@include('layouts/elliot/next_previous_arrow')
<!--Main Page Start here-->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="row">
        <div class="section-padding">
			@if(!empty($news_detail))
				<div>
					<div class="post-title">
						<h1><span>Design Locations</span></h1>
					</div>
					<div class="post-sub-titles">
						<h2 class="main-sub-title">{{$news_detail->title_detail_1}}</h2>
						<h2 class="sub-tittle-des">{!!$news_detail->description_detail_1!!} - <span>{{$news_detail->cat_name}}</span></h2>
					</div>
				</div>
				<div class="post-content" data-aos="fade-right">
					<div  class="slideshow-image">
						<a data-popup-id="gallery-popup"  class="video-popup-btn" href="#">
							@if($news_detail->image_pos_1!='')
								<img class="img-responsive" src="{{ URL::to('uploads/article_imgs/'.$news_detail->image_pos_1)}}" alt=""/>
							@endif
							<div class="silde-show-btn interior-gallery" data-aos="zoom-in">
								See Slideshow
							</div>
						</a>
					</div>
					<div class="about-project">
						{!!$news_detail->description_pos_3!!}
					</div>
					<div class="double-image-sec">
						<div class="left-image floating"  >
							@if($news_detail->image_pos_7!='')
								<img data-aos="fade-right" class="img-responsive" src="{{ URL::to('uploads/article_imgs/'.$news_detail->image_pos_7)}}" alt=""/>
							@endif
						</div>
						<div class="right-image floating"  >
							@if($news_detail->image_pos_8!='')
								<img data-aos="fade-right" class="img-responsive" src="{{ URL::to('uploads/article_imgs/'.$news_detail->image_pos_8)}}" alt=""/>
							@endif
							<p>{{$news_detail->title_pos_6}}</p>
						</div>
					</div>
					<div class="clearfix"></div>
					@if($news_detail->image_pos_10!='' || $news_detail->image_pos_11!='')
						<div class="double-image-sec">
							<div class="left-image floating"  >
								@if($news_detail->image_pos_10!='')
									<img data-aos="fade-right" class="img-responsive" src="{{ URL::to('uploads/article_imgs/'.$news_detail->image_pos_10)}}" alt=""/>
								@endif
							</div>
							<div class="right-image floating"  >
								@if($news_detail->image_pos_11!='')
									<img data-aos="fade-right" class="img-responsive" src="{{ URL::to('uploads/article_imgs/'.$news_detail->image_pos_11)}}" alt=""/>
								@endif
								<p>{{$news_detail->title_pos_7}}</p>
							</div>
						</div>
						<div class="clearfix"></div>
					@endif
					<div class="description-text">
						<p>{!!$news_detail->description_pos_6!!}
						</p>
					</div>
					<div class="below-post-image" data-aos="fade-right">
						@if($news_detail->image_pos_9!='')
							<img class="img-responsive" src="{{ URL::to('uploads/article_imgs/'.$news_detail->image_pos_9)}}" alt=""/>
						@endif
					</div>
				</div>
			@endif
        </div>
        <!--Gallery popup start-->
        <div id="gallery-popup" class="popup">
            <div class="popup-inner post-popup">
                <a href="#" class="popup-close-btn">CLOSE</a>
                <div class="popup-content res-gallery-sec-padding">
                    <div class="image-slider-container">

                        <div class="clearfix"></div>
                        <ul class="image-slider post-page-sideshow">
                            @if(!empty($news_detail) && $news_detail->image_pos_2!='')
								<li class="active">
									<a href="#"><img class="img-responsive" src="{{ URL::to('uploads/article_imgs/'.$news_detail->image_pos_2)}}" alt=""/></a>
								</li>
							@endif
							@if(!empty($news_detail) && $news_detail->image_pos_3!='')
								<li>
									<a href="#"><img class="img-responsive" src="{{ URL::to('uploads/article_imgs/'.$news_detail->image_pos_3)}}" alt=""/></a>
								</li>
							@endif
							@if(!empty($news_detail) && $news_detail->image_pos_4!='')
								<li>
									<a href="#"><img class="img-responsive" src="{{ URL::to('uploads/article_imgs/'.$news_detail->image_pos_4)}}" alt=""/></a>
								</li>
							@endif
							@if(!empty($news_detail) && $news_detail->image_pos_5!='')
								<li>
									<a href="#"><img class="img-responsive" src="{{ URL::to('uploads/article_imgs/'.$news_detail->image_pos_5)}}" alt=""/></a>
								</li>
							@endif
							@if(!empty($news_detail) && $news_detail->image_pos_6!='')
								<li>
									<a href="#"><img class="img-responsive" src="{{ URL::to('uploads/article_imgs/'.$news_detail->image_pos_6)}}" alt=""/></a>
								</li>
							@endif
                        </ul>
                        <div class="images-count">1 / 4</div>
                        <div class="image-slider-btns">
                            <a class="image-slider-previous-btn gallery-res-previous-btn" href="#">
                                <img src="{{ asset('sximo/assets/images/left-round-arrow.png')}}"  alt=""/>
                            </a>
                            <a class="image-slider-next-btn gallery-res-next-btn" href="#">
                                <img src="{{ asset('sximo/assets/images/right-round-arrow.png')}}" alt=""/>
                            </a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <script src="../dist/aos.js"></script>
        <script>
AOS.init({
    easing: 'ease-in-out-sine'
});
        </script>
        @include('layouts/elliot/ai_footer_social')
        <!--@include('layouts/elliot/ai_footer_3')
        @include('layouts/elliot/ai_footer_2')-->
        