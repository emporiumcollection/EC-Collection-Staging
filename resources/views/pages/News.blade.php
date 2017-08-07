<link href="{{ asset('sximo/videojsplayer/video-js.css')}}" rel="stylesheet">
<script src="{{ asset('sximo/videojsplayer/ie8/videojs-ie8.min.js')}}"></script>
<script src="{{ asset('sximo/videojsplayer/video.js')}}"></script>
<section data-selector="section" id="text-2col2">
	<div class="container">
	
		<div class="row header-line2 about-sec">
		
		<h1 data-selector="h3" class="title bjproduct-title">{{\Lang::get('core.menu_frontend_attribute_heading_news')}}</h1>

		</div>
	</div>
</section>

<div class="container gg news-custom">
	<section id="benefits-grid-images-left">
		<div class="container">
			<div class="row no-dev">
				@if(!empty($newspage_cat_news))
					{{--*/ $nw = 0; $bnw = 1; /*--}}
					@foreach($newspage_cat_news as $news)
						{{--*/  $nwname = strtolower(str_replace(' ','-',$news->title_pos_1));
								$nwlink = URL::to('post/'.$nwname);
						/*--}}
						@if($nw<2)
							<div class="col-sm-6 MarBot10">
								<ul class="item-list2">
									<li>
										{{--*/ $Topnews = ($news->featured_image_top!='')? URL::to('uploads/article_imgs/'.$news->featured_image_top): URL::to('uploads/images/news_top_no-image.png');
										/*--}}
										
										@if($news->cat_id==18)
											@if($news->video_type=="upload")
												{{--*/  $videolink = URL::to('uploads/article_imgs/'.$news->video_upload); 
														$video_banner = ($news->video_banner!='')? URL::to('uploads/article_imgs/'.$news->video_banner): URL::to('sximo/images/mp4.png');
												/*--}}
											@elseif($news->video_type=="link")
												{{--*/ $vlink = explode('/',$news->video_link); $vimeoid = end($vlink); /*--}}
												@if($news_detail->link_type=="youtube")
													{{--*/  $videolink = "https://www.youtube.com/embed/{{$vimeoid}}"; /*--}}
												@elseif($news_detail->link_type=="vimeo")
													{{--*/  $videolink = "https://player.vimeo.com/video/{{$vimeoid}}"; /*--}}
												@endif
												
											@endif
											<video id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered"  controls="controls" preload="none" poster="{{$video_banner}}" data-setup="{ }" width="505px" height="342px">
												<source src="{{$videolink}}" type="video/mp4">
											</video>
											
											<h1>
												{{ (\Session::get('newlang')=='English') ? $news->title_pos_1_eng : $news->title_pos_1 }}
											</h1>
										@else
											<a href="{{$nwlink}}"><img src="{{$Topnews}}" alt="feature" class="screen img-circle" /></a>
											<h1><a href="{{$nwlink}}">
											{{-- @if(\Session::get('newlang')=='English')
												{{(strlen($news->title_pos_1_eng) > 255) ? substr($news->title_pos_1_eng,0,255).'...':$news->title_pos_1_eng}}
											@else
												{{(strlen($news->title_pos_1) > 255) ? substr($news->title_pos_1,0,255).'...':$news->title_pos_1}}
											@endif --}}
											
											{{ (\Session::get('newlang')=='English') ? $news->title_pos_1_eng : $news->title_pos_1 }}
											</a></h1>
										@endif
										<p class="editContent">
										{{-- @if(\Session::get('newlang')=='English')
											{{(strlen(strip_tags($news->description_pos_1_eng)) > 200) ? substr(strip_tags($news->description_pos_1_eng),0,200).'...':strip_tags($news->description_pos_1_eng)}}
										@else
											{{(strlen(strip_tags($news->description_pos_1)) > 200) ? substr(strip_tags($news->description_pos_1),0,200).'...':strip_tags($news->description_pos_1)}}
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
								<ul class="item-list3 lowerposts">
									<li>
										{{--*/ $botnews = ($news->featured_image_bottom!='')? URL::to('uploads/article_imgs/'.$news->featured_image_bottom): URL::to('uploads/images/news_bot_no-image.png'); /*--}}
										
										@if($news->cat_id==18)
											@if($news->video_type=="upload")
												{{--*/  $videolink = URL::to('uploads/article_imgs/'.$news->video_upload); 
														$video_banner = ($news->video_banner!='')? URL::to('uploads/article_imgs/'.$news->video_banner): URL::to('sximo/images/mp4.png');
												/*--}}
											@elseif($news->video_type=="link")
												{{--*/ $vlink = explode('/',$news->video_link); $vimeoid = end($vlink); /*--}}
												@if($news_detail->link_type=="youtube")
													{{--*/  $videolink = "https://www.youtube.com/embed/{{$vimeoid}}"; /*--}}
												@elseif($news_detail->link_type=="vimeo")
													{{--*/  $videolink = "https://player.vimeo.com/video/{{$vimeoid}}"; /*--}}
												@endif
												
											@endif
											<video id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered"  controls="controls" preload="none" poster="{{$video_banner}}" data-setup="{ }" width="219px" height="161px">
												<source src="{{$videolink}}" type="video/mp4">
											</video>
											<h6><span class="flt_lt"> Post </span><span class="middleline">&nbsp;</span> {{  date("d. m. Y", strtotime($news->publish_date)) }}</h6>
											<h4>
												{{ (\Session::get('newlang')=='English') ? $news->title_pos_1_eng : $news->title_pos_1 }}
											</h4>
										@else
											<a href="{{$nwlink}}"><img src="{{$botnews}}" alt="feature" class="screen img-circle2"></a>
											<h6><span class="flt_lt"> Post </span><span class="middleline">&nbsp;</span> {{  date("d. m. Y", strtotime($news->publish_date)) }}</h6>
											<h4><a href="{{$nwlink}}">
											{{--@if(\Session::get('newlang')=='English')
												{{(strlen($news->title_pos_1_eng) > 50) ? substr($news->title_pos_1_eng,0,50).'...':$news->title_pos_1_eng}}
											@else
												{{(strlen($news->title_pos_1) > 50) ? substr($news->title_pos_1,0,50).'...':$news->title_pos_1}}
											@endif --}}
											
											{{ (\Session::get('newlang')=='English') ? $news->title_pos_1_eng : $news->title_pos_1 }}
											</a></h4>
										@endif
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
							@if(($bnw%4)==0)
								</div>
								<div class="row no-dev">
							@endif
							{{--*/ $bnw++ /*--}}
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