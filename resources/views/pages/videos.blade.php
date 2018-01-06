<link href="{{ asset('sximo/videojsplayer/video-js.css')}}" rel="stylesheet">
<script src="{{ asset('sximo/videojsplayer/ie8/videojs-ie8.min.js')}}"></script>
<script src="{{ asset('sximo/videojsplayer/video.js')}}"></script>
<section data-selector="section" id="text-2col2">
	<div class="container">
	
		<div class="row header-line2 about-sec">
		
			<p id="folder_name" class="sub-cat hidden-xs">
				<a href="{{ URL::to('ber-janua') }}"><b class="@if(Request::is('ber-janua')) aactive @endif" >{{\Lang::get('core.menu_frontend_uber_janua')}}</b></a>/
				<a href="{{ URL::to('teamdetail') }}"><b class="@if(Request::is('teamdetail')) aactive @endif">{{\Lang::get('core.menu_frontend_team')}}</b></a>/
				<a href="{{ URL::to('designeroverview') }}"><b class="@if(Request::is('designeroverview')) aactive @endif">{{\Lang::get('core.menu_frontend_designer')}}</b></a>/
				<a href="{{ URL::to('produktion') }}"><b class="@if(Request::is('produktion')) aactive @endif">{{\Lang::get('core.menu_frontend_produktion')}}</b></a>/
				<a href="{{ URL::to('partner') }}"><b class="@if(Request::is('partner')) aactive @endif">{{\Lang::get('core.menu_frontend_partner')}}</b></a>/
				<a href="{{ URL::to('vertrieb') }}"><b class="@if(Request::is('vertrieb')) aactive @endif">{{\Lang::get('core.menu_frontend_vertrieb')}}</b></a>/
				<a href="{{ URL::to('showrooms') }}"><b class="@if(Request::is('showrooms')) aactive @endif">{{\Lang::get('core.menu_frontend_showroom')}}</b></a>/
				<a href="{{ URL::to('popupstores') }}"><b class="@if(Request::is('popupstores')) aactive @endif">{{\Lang::get('core.menu_frontend_popupstore')}}</b></a>/
				<a href="{{ URL::to('messe') }}"><b class="@if(Request::is('messe')) aactive @endif">{{\Lang::get('core.menu_frontend_messe')}}</b></a>/
				<a href="{{ URL::to('project') }}"><b class="@if(Request::is('project')) aactive @endif">{{\Lang::get('core.menu_frontend_projekte')}}</b></a>/
				<a href="{{ URL::to('videos') }}"><b class="@if(Request::is('videos')) aactive @endif">{{\Lang::get('core.menu_frontend_videos')}}</b></a>/
				<a href="{{ URL::to('projekteimhandel') }}"><b class="@if(Request::is('videos')) aactive @endif">{{\Lang::get('core.menu_frontend_project_im_handle')}}</b></a>
				
			</p>
			
			<div class="panel-group accordion visible-xs sub-cat" id="accordion" style="padding:0 10px;">
				<div class="panel panel-default repeatVar1">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
								<i class="fa fa-angle-right"></i> Menü
							</a>
						</h4>
					</div>
					<div id="collapse1" class="panel-collapse collapse" style="height: auto;">
						<div class="panel-body">
							<a href="{{ URL::to('ber-janua') }}"><b>{{\Lang::get('core.menu_frontend_uber_janua')}}</b></a><br>
							<a href="{{ URL::to('teamdetail') }}"><b>{{\Lang::get('core.menu_frontend_team')}}</b></a><br> 
							<a href="{{ URL::to('designeroverview') }}"><b>{{\Lang::get('core.menu_frontend_designer')}}</b></a><br>
							<a href="{{ URL::to('produktion') }}"><b>{{\Lang::get('core.menu_frontend_produktion')}}</b></a><br>
							<a href="{{ URL::to('partner') }}"><b>{{\Lang::get('core.menu_frontend_partner')}}</b></a><br>
							<a href="{{ URL::to('vertrieb') }}"><b>{{\Lang::get('core.menu_frontend_vertrieb')}}</b></a><br>
							<a href="{{ URL::to('showrooms') }}"><b>{{\Lang::get('core.menu_frontend_showroom')}}</b></a><br>
							<a href="{{ URL::to('popupstores') }}"><b>{{\Lang::get('core.menu_frontend_popupstore')}}</b></a><br>
							<a href="{{ URL::to('messe') }}"><b>{{\Lang::get('core.menu_frontend_messe')}}</b></a><br>
							<a href="{{ URL::to('project') }}"><b>{{\Lang::get('core.menu_frontend_projekte')}}</b></a><br>
							<a href="{{ URL::to('videos') }}"><b>{{\Lang::get('core.menu_frontend_videos')}}</b></a><br>
							<a href="{{ URL::to('projekteimhandel') }}"><b>{{\Lang::get('core.menu_frontend_project_im_handle')}}</b></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section data-selector="section" id="text-2col2">
	<div class="container">
	
		<div class="row header-line2 about-sec">
		
		<h1 data-selector="h3" class="title bjproduct-title">{{\Lang::get('core.menu_frontend_videos')}}</h1>

		</div>
	</div>
</section>

<div class="container gg news-custom">
	@if(!empty($newspage_cat_Videos))
		<section id="benefits-grid-images-left">
			<div class="container">
				<div class="row no-dev">
				
					{{--*/ $nw = 1 /*--}}
					@foreach($newspage_cat_Videos as $news)
						{{--*/  $nwname = strtolower(str_replace(' ','-',$news->title_pos_1));
								$nwlink = URL::to('post/'.$nwname);
						/*--}}
						
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
						
						<div class="col-sm-6 MarBot10">
							<ul class="item-list2">
								<li>
									{{--*/ $Topnews = ($news->featured_image_top!='')? URL::to('uploads/article_imgs/'.$news->featured_image_top): URL::to('uploads/images/news_top_no-image.png');
									/*--}}
									<video id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered"  controls="controls" preload="none" poster="{{$video_banner}}" data-setup="{ }" width="505px" height="342px">
										<source src="{{$videolink}}" type="video/mp4">
									</video>
									
									<h1>
									{{--@if(\Session::get('newlang')=='English')
										{{(strlen($news->title_pos_1_eng) > 255) ? substr($news->title_pos_1_eng,0,255).'...':$news->title_pos_1_eng}}
									@else
										{{(strlen($news->title_pos_1) > 255) ? substr($news->title_pos_1,0,255).'...':$news->title_pos_1}}
									@endif --}}
									
									{{ (\Session::get('newlang')=='English') ? $news->title_pos_1_eng : $news->title_pos_1 }}
									</h1>
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
						@if(($nw%2)==0)
							</div>
							<div class="row no-dev">
						@endif
					{{--*/ $nw++ /*--}}
					@endforeach
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