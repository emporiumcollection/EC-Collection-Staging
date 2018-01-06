
<section data-selector="section" id="text-2col2">
	<div class="container">
	
		<div class="row header-line2 about-sec">
		
		<h1 data-selector="h3" class="title bjproduct-title">Presse News</h1>

		</div>
	</div>
</section>

<div class="container gg news-custom">
	@if(!empty($newspage_cat_presse))
		<section id="benefits-grid-images-left">
			<div class="container">
				<div class="row no-dev">
				
					{{--*/ $nw = 0 /*--}}
					@foreach($newspage_cat_presse as $news)
						@if($nw<2)
							<div class="col-sm-6 MarBot10">
								<ul class="item-list2">
									<li>
										{{--*/ $Topnews = ($news->featured_image_top!='')? URL::to('uploads/article_imgs/'.$news->featured_image_top): URL::to('uploads/images/news_top_no-image.png');
											$nwname = strtolower(str_replace(' ','-',$news->title_pos_1));
											$nwlink = URL::to('post/'.$nwname);
										/*--}}
										<a href="{{$nwlink}}"><img src="{{$Topnews}}" alt="feature" class="screen img-circle" /></a>
										<h1><a href="{{$nwlink}}">
										@if(\Session::get('newlang')=='English')
											{{(strlen($news->title_pos_1_eng) > 255) ? substr($news->title_pos_1_eng,0,255).'...':$news->title_pos_1_eng}}
										@else
											{{(strlen($news->title_pos_1) > 255) ? substr($news->title_pos_1,0,255).'...':$news->title_pos_1}}
										@endif
										</a></h1>
										<p class="editContent">
										{{-- @if(\Session::get('newlang')=='English')
											{!!(strlen(strip_tags($news->description_pos_1_eng, '<span>')) > 200) ? substr(strip_tags($news->description_pos_1_eng, '<span>'),0,200).'...':strip_tags($news->description_pos_1_eng, '<span>')!!}
										@else
											{!!(strlen(strip_tags($news->description_pos_1, '<span>')) > 200) ? substr(strip_tags($news->description_pos_1, '<span>'),0,200).'...':strip_tags($news->description_pos_1, '<span>')!!}
										@endif --}}
										{!! (\Session::get('newlang')=='English') ? strip_tags($news->description_pos_1_eng, '<span>') : strip_tags($news->description_pos_1, '<span>') !!}
										</p>
										<h6><span class="flt_lt"> Post </span><span class="middleline">&nbsp;</span> <b>{{  date("d. m. Y", strtotime($news->publish_date)) }}</b></h6>
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
										{{--*/ $botnews = ($news->featured_image_bottom!='')? URL::to('uploads/article_imgs/'.$news->featured_image_bottom): URL::to('uploads/images/news_bot_no-image.png'); 
											$nwname = strtolower(str_replace(' ','-',$news->title_pos_1));
											$nwlink = URL::to('post/'.$nwname);
										/*--}}
										<a href="{{$nwlink}}"><img src="{{$botnews}}" alt="feature" class="screen img-circle2"></a>
										<h6><span class="flt_lt"> Post </span><span class="middleline">&nbsp;</span>{{  date("d. m. Y", strtotime($news->publish_date)) }}</h6>
										<h4><a href="{{$nwlink}}">
										@if(\Session::get('newlang')=='English')
											{{(strlen($news->title_pos_1_eng) > 50) ? substr($news->title_pos_1_eng,0,50).'...':$news->title_pos_1_eng}}
										@else
											{{(strlen($news->title_pos_1) > 50) ? substr($news->title_pos_1,0,50).'...':$news->title_pos_1}}
										@endif
										</a></h4>
										<p class="editContent">
										{{-- @if(\Session::get('newlang')=='English')
											{!!(strlen(strip_tags($news->description_pos_1_eng, '<span>')) > 235) ? substr(strip_tags($news->description_pos_1_eng, '<span>'),0,235).'...':strip_tags($news->description_pos_1_eng, '<span>')!!}
										@else
											{!!(strlen(strip_tags($news->description_pos_1, '<span>')) > 235) ? substr(strip_tags($news->description_pos_1, '<span>'),0,235).'...':strip_tags($news->description_pos_1, '<span>')!!}
										@endif --}}
										
										{!! (\Session::get('newlang')=='English') ? strip_tags($news->description_pos_1_eng, '<span>') : strip_tags($news->description_pos_1, '<span>') !!}
										</p>
									</li>
								</ul>
							</div>
						@endif
						{{--*/ $nw++ /*--}}
					@endforeach
				
				</div>
			</div>
		</section>
		
		<section data-selector="section" id="text-2col">
			<div class="container2">
				<div class="row">
					<h3 class="poat-heading2">{{ (\Session::get('newlang')=='English') ? $newspage_cat_presse[0]->cat_title_eng : $newspage_cat_presse[0]->cat_title}}</h1>
					<div>{!! (\Session::get('newlang')=='English') ? $newspage_cat_presse[0]->cat_description_eng : $newspage_cat_presse[0]->cat_description !!}</div>
				</div>
			</div>
		</section>
	
	@endif
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