<section data-selector="section" id="text-2col2">
	<div class="container">
	
		<div class="row header-line2 about-sec">
		
		<h1 data-selector="h3" class="title">Aktuelles</h1>

		</div>
	</div>
</section>

<div class="container">
	<section id="benefits-grid-images-left">
		<div class="container">
			<div class="row no-dev">
				@if(!empty($newspage_cat_news))
					{{--*/ $nw = 0 /*--}}
					@foreach($newspage_cat_news as $news)
						@if($nw<2)
							<div class="col-sm-6 MarBot10">
								<ul class="item-list2">
									<li>
										{{--*/ $Topnews = ($news->image_pos_1!='')? URL::to('uploads/article_imgs/news_top_'.$news->image_pos_1): URL::to('uploads/images/news_top_no-image.png'); /*--}}
										<a href="{{URL::to('newsdetail/'.$news->id)}}"><img src="{{$Topnews}}" alt="feature" class="screen img-circle" /></a>
										<h1><a href="{{URL::to('newsdetail/'.$news->id)}}">{{$news->title_pos_1}}</a></h1>
										<p class="editContent">{{substr(strip_tags($news->description_pos_1),0,300)}}</p>
										<h6>Post - {{$news->first_name.' '.$news->last_name}}</h6>
									</li>
								</ul>
							</div>
							@if($nw==1)
								</div>
								<div class="row no-dev">
							@endif
						@else
							<div class="col-sm-3 img-box MarTop10 MarBot10">
								<ul class="item-list3">
									<li>
										{{--*/ $botnews = ($news->image_pos_1!='')? URL::to('uploads/article_imgs/news_bot_'.$news->image_pos_1): URL::to('uploads/images/news_bot_no-image.png'); /*--}}
										<a href="{{URL::to('newsdetail/'.$news->id)}}"><img src="{{$botnews}}" alt="feature" class="screen img-circle2"></a>
										<h6>Post - {{$news->first_name.' '.$news->last_name}}</h6>
										<h4 style="height:40px;"><a href="{{URL::to('newsdetail/'.$news->id)}}">{{$news->title_pos_1}}</a></h4>
										<p class="editContent">{{substr(strip_tags($news->description_pos_1),0,200)}}</p>
									</li>
								</ul>
							</div>
						@endif
						{{--*/ $nw++ /*--}}
					@endforeach
				@endif
			</div>
		</div>
	</section>
</div>

<!-- footer include start -->
	@include('layouts/elliot/bottombar')
  <!-- footer include end -->