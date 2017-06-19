
<div class="container">
@if(!empty($news_detail))
	<div class="row page6-banner">
		{{--*/ $Topnews = ($news_detail->image_pos_1!='')? URL::to('uploads/article_imgs/'.$news_detail->image_pos_1): URL::to('uploads/images/news_top_no-image.png'); /*--}}
		<img class="img-responsive" src="{{$Topnews}}" alt="1.png" />
	</div>
	<div class="row container2">
		<div class="first-post">
			<span>Post - {{$news_detail->first_name.' '.$news_detail->last_name}}</span>
			<h3 class="poat-heading">{{$news_detail->title_pos_1}}</h3>
			<ul class="post-icon">
				<li><img class="img-responsive" src="{{URL::to('uploads/images/mailbox.png')}}" alt="2.png" /></li>
				<li><img class="img-responsive" src="{{URL::to('uploads/images/printer.png')}}" alt="2.png" /></li>
			</ul>
			<p>	{{ $news_detail->description_pos_1 }}</p>
		</div>
	</div>
	
	<div class="row second-post">
		@if($news_detail->image_pos_2!='')
		<div class="col-sm-6 lft">
			{{--*/ $newspos2 = ($news_detail->image_pos_2!='')? URL::to('uploads/article_imgs/'.$news_detail->image_pos_2): URL::to('uploads/images/front_no-image.jpg'); /*--}}
			<img class="img-responsive" src="{{$newspos2}}" alt="2.png" />
		</div>
		@endif
		@if($news_detail->image_pos_3!='')
		<div class="col-sm-6 rgt">
			{{--*/ $newspos3 = ($news_detail->image_pos_3!='')? URL::to('uploads/article_imgs/'.$news_detail->image_pos_3): URL::to('uploads/images/front_no-image.jpg'); /*--}}
			<img class="img-responsive" src="{{$newspos3}}" alt="3.png" />
		</div>
		@endif
	</div>
	
	<div class="row container2">
		<div class="second-post-text">
			<p>
			{{ $news_detail->description_pos_3 }}
			</p>
		</div>
	</div>
	
	@if($news_detail->image_pos_4!='')
	<div class="row third-post">
		{{--*/ $newspos4 = ($news_detail->image_pos_4!='')? URL::to('uploads/article_imgs/'.$news_detail->image_pos_4): URL::to('uploads/images/news_top_no-image.png'); /*--}}
		<img class="img-responsive" src="{{$newspos4}}" alt="4.png" />
	</div>
	@endif
	
	<div class="row fourth-post">
		@if($news_detail->image_pos_5!='')
		<div class="col-sm-6">
			{{--*/ $newspos5 = ($news_detail->image_pos_5!='')? URL::to('uploads/article_imgs/'.$news_detail->image_pos_5): URL::to('uploads/images/front_no-image.jpg'); /*--}}
			<img class="img-responsive" src="{{$newspos5}}" alt="5.png" />
		</div>
		@endif
		@if($news_detail->image_pos_6!='')
		<div class="col-sm-6">
			{{--*/ $newspos6 = ($news_detail->image_pos_6!='')? URL::to('uploads/article_imgs/'.$news_detail->image_pos_6): URL::to('uploads/images/front_no-image.jpg'); /*--}}
			<img class="img-responsive" src="{{$newspos6}}" alt="6.png" />
		</div>
		@endif
	</div>
		
	<div class="row container2">
		<div class="fifth-post">
			<h3 class="poat-heading">{{ $news_detail->title_pos_6 }}</h3>
			<p>
			{{ $news_detail->description_pos_6 }}
			</p>
		</div>
	</div>
@endif
</div>

<!-- footer include start -->
	@include('layouts/elliot/bottombar')
  <!-- footer include end -->