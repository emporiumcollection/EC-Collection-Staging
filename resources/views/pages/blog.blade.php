<section data-selector="section" id="text-2col2">
	<div class="container">
	
		<div class="row header-line2 about-sec">
		
		<h1 data-selector="h3" class="title bjproduct-title">Blog</h1>

		</div>
	</div>
</section>

<div class="container gg news-custom">
	<section id="benefits-grid-images-left">
		<div class="container">
			<div class="row no-dev">
				@if(!empty($newspage_cat_Blog))
					{{--*/ $nw = 0 /*--}}
					@foreach($newspage_cat_Blog as $news)
						@if($nw<2)
							<div class="col-sm-6 MarBot10">
								<ul class="item-list2">
									<li>
										{{--*/ $Topnews = ($news->featured_image_top!='')? URL::to('uploads/article_imgs/'.$news->featured_image_top): URL::to('uploads/images/news_top_no-image.png');
										/*--}}
										<a href="{{URL::to('newsdetail/'.$news->id)}}"><img src="{{$Topnews}}" alt="feature" class="screen img-circle" /></a>
										<h1><a href="{{URL::to('newsdetail/'.$news->id)}}">{{(strlen($news->title_pos_1) > 255) ? substr($news->title_pos_1,0,255).'...':$news->title_pos_1}}</a></h1>
										<p class="editContent">{{(strlen(strip_tags($news->description_pos_1)) > 200) ? substr(strip_tags($news->description_pos_1),0,200).'...':strip_tags($news->description_pos_1)}}</p>
										<h6><span class="flt_lt"> Post </span><span class="middleline">&nbsp;</span> {{  get_timeago( strtotime($news->publish_date) ) }}</h6>
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
										{{--*/ $botnews = ($news->featured_image_bottom!='')? URL::to('uploads/article_imgs/'.$news->featured_image_bottom): URL::to('uploads/images/news_bot_no-image.png'); /*--}}
										<a href="{{URL::to('newsdetail/'.$news->id)}}"><img src="{{$botnews}}" alt="feature" class="screen img-circle2"></a>
										<h6><span class="flt_lt"> Post </span><span class="middleline">&nbsp;</span> {{  get_timeago( strtotime($news->publish_date) ) }}</h6>
										<h4><a href="{{URL::to('newsdetail/'.$news->id)}}">{{(strlen($news->title_pos_1) > 50) ? substr($news->title_pos_1,0,50).'...':$news->title_pos_1}}</a></h4>
										<p class="editContent">{{(strlen(strip_tags($news->description_pos_1)) > 235) ? substr(strip_tags($news->description_pos_1),0,235).'...':strip_tags($news->description_pos_1)}}</p>
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
{{--*/ 
function get_timeago( $ptime )
{
$etime = time() - $ptime;

if( $etime < 1 )
{
    return 'less than '.$etime.' second ago';
}

$a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
            30 * 24 * 60 * 60       =>  'month', //month
            24 * 60 * 60            =>  'Tagen', //day
            60 * 60             =>  'hour',
            60                  =>  'minute',
            1                   =>  'second'
);

foreach( $a as $secs => $str )
{
    $d = $etime / $secs;

    if( $d >= 1 )
    {
        $r = round( $d );
		if($str=="month")
		{
			return ( $r > 1 ? 'vor '.$r.' Monaten' : 'vor einem Monat' );
		}
		else{
			return 'vor '.$r . ' ' . $str;
		}
        
    }
}
}

 /*--}}