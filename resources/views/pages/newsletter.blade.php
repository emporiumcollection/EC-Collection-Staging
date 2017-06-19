<section data-selector="section" id="text-2col2">
	<div class="container">
	
		<div class="row header-line2 about-sec">
		
		<h1 data-selector="h3" class="title bjproduct-title">
		@if(!empty($newspage_cat_Newsletter))
			Newsletter
		@endif
		</h1>

		</div>
	</div>
</section>

<div class="container gg news-custom">
	<section id="benefits-grid-images-left">
		<div class="container">
			<div class="row no-dev">
				@if(!empty($newspage_cat_Newsletter))
					{{--*/ $nw = 0 /*--}}
					@foreach($newspage_cat_Newsletter as $news)
						@if($nw<2)
							<div class="col-sm-6 MarBot10">
								<ul class="item-list2">
									<li>
										{{--*/ $Topnews = ($news->featured_image_top!='')? URL::to('uploads/article_imgs/'.$news->featured_image_top): URL::to('uploads/images/news_top_no-image.png');
										/*--}}
										<a href="{{URL::to('newsdetail/'.$news->id)}}"><img src="{{$Topnews}}" alt="feature" class="screen img-circle" /></a>
										<h1><a href="{{URL::to('newsdetail/'.$news->id)}}">
										{{--@if(\Session::get('newlang')=='English')
											{{(strlen($news->title_pos_1_eng) > 255) ? substr($news->title_pos_1_eng,0,255).'...':$news->title_pos_1_eng}}
										@else
											{{(strlen($news->title_pos_1) > 255) ? substr($news->title_pos_1,0,255).'...':$news->title_pos_1}}
										@endif --}}
										
										{{ (\Session::get('newlang')=='English') ? $news->title_pos_1_eng : $news->title_pos_1 }}
										</a></h1>
										<p class="editContent">
										{{-- @if(\Session::get('newlang')=='English')
											{{(strlen(strip_tags($news->description_pos_1_eng)) > 200) ? substr(strip_tags($news->description_pos_1_eng),0,200).'...':strip_tags($news->description_pos_1_eng)}}
										@else
											{{(strlen(strip_tags($news->description_pos_1)) > 200) ? substr(strip_tags($news->description_pos_1),0,200).'...':strip_tags($news->description_pos_1)}}
										@endif --}}
										
										{!! (\Session::get('newlang')=='English') ? strip_tags($news->description_pos_1_eng, '<span>') : strip_tags($news->description_pos_1, '<span>') !!}
										</p>
										<h6><span class="flt_lt"> Post </span><span class="middleline">&nbsp;</span> {{  date("d. m. Y", strtotime($news->publish_date)) }}</h6>
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
										<h6><span class="flt_lt"> Post </span><span class="middleline">&nbsp;</span> {{  date("d. m. Y", strtotime($news->publish_date)) }}</h6>
										<h4><a href="{{URL::to('newsdetail/'.$news->id)}}">
										{{-- @if(\Session::get('newlang')=='English')
											{{(strlen($news->title_pos_1_eng) > 50) ? substr($news->title_pos_1_eng,0,50).'...':$news->title_pos_1_eng}}
										@else
											{{(strlen($news->title_pos_1) > 50) ? substr($news->title_pos_1,0,50).'...':$news->title_pos_1}}
										@endif --}}
										
										{{ (\Session::get('newlang')=='English') ? $news->title_pos_1_eng : $news->title_pos_1 }}
										</a></h4>
										<p class="editContent">
										{{-- @if(\Session::get('newlang')=='English')
											{{(strlen(strip_tags($news->description_pos_1_eng)) > 235) ? substr(strip_tags($news->description_pos_1_eng),0,235).'...':strip_tags($news->description_pos_1_eng)}}
										@else
											{{(strlen(strip_tags($news->description_pos_1)) > 235) ? substr(strip_tags($news->description_pos_1),0,235).'...':strip_tags($news->description_pos_1)}}
										@endif --}}
										
										{!! (\Session::get('newlang')=='English') ? strip_tags($news->description_pos_1_eng, '<span>') : strip_tags($news->description_pos_1, '<span>') !!}
										</p>
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

	if(\Session::get('newlang')=='English')
	{
		$a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
					30 * 24 * 60 * 60       =>  'month', 
					24 * 60 * 60            =>  'day',
					60 * 60             =>  'hour',
					60                  =>  'minute',
					1                   =>  'second'
		);
	}
	else{
		
		$a = array( 12 * 30 * 24 * 60 * 60  =>  'jahr', //year
					30 * 24 * 60 * 60       =>  'monat', //month
					24 * 60 * 60            =>  'tag', //day
					60 * 60             =>  'stunde', //hour
					60                  =>  'minute', //minute
					1                   =>  'zweite' //second
		);
	}
	
	$plur = array('day'=>'days', 'month'=>'months', 'year'=>'years', 'hour'=>'hours', 'minute'=>'minutes', 'second'=>'seconds', 'tag'=>'tagen', 'monat'=>'monaten', 'jahr'=>'jahr(e)', 'stunde'=>'std.', 'minute'=>'protokoll', 'zweite'=>'Sekunden');

	foreach( $a as $secs => $str )
	{
		$d = $etime / $secs;

		if( $d >= 1 )
		{
			$r = round( $d );
			return ( $r > 1 ? 'vor '.$r.' '.$plur[$str] : 'vor einem '.$str );
		}
	}
}

 /*--}}