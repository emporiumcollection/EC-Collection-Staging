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
		
		<h1 data-selector="h3" class="title bjproduct-title">{{\Lang::get('core.menu_frontend_project_im_handle')}}</h1>

		</div>
	</div>
</section>

<div class="container gg news-custom">
	@if(!empty($newspage_cat_projectimhandle))
		<section id="benefits-grid-images-left">
			<div class="container">
				<div class="row no-dev">
				
					{{--*/ $nw = 0 /*--}}
					@foreach($newspage_cat_projectimhandle as $news)
						{{--*/  $nwname = strtolower(str_replace(' ','-',$news->title_pos_1));
								$nwlink = URL::to('post/'.$nwname);
						/*--}}
						@if($nw<2)
							<div class="col-sm-6 MarBot10">
								<ul class="item-list2">
									<li>
										{{--*/ $Topnews = ($news->featured_image_top!='')? URL::to('uploads/article_imgs/'.$news->featured_image_top): URL::to('uploads/images/news_top_no-image.png');
										/*--}}
										<a href="{{$nwlink}}"><img src="{{$Topnews}}" alt="feature" class="screen img-circle" /></a>
										<h1><a href="{{$nwlink}}">
										{{-- @if(\Session::get('newlang')=='English')
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
										@endif	--}}
										
										{!! (\Session::get('newlang')=='English') ? strip_tags($news->description_pos_1_eng, '<span>') : strip_tags($news->description_pos_1, '<span>') !!}
										</p>
										<h6><span class="flt_lt"> Post </span><span class="middleline">&nbsp;</span><b>{{  date("d. m. Y", strtotime($news->publish_date)) }}</b></h6>
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
										<a href="{{$nwlink}}"><img src="{{$botnews}}" alt="feature" class="screen img-circle2"></a>
										<h6><span class="flt_lt"> Post </span><span class="middleline">&nbsp;</span> <b>{{  date("d. m. Y", strtotime($news->publish_date)) }}</b></h6>
										<h4><a href="{{$nwlink}}">
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
				
				</div>
			</div>
		</section>
		
		<section data-selector="section" id="text-2col">
			<div class="container2">
				<div class="row">
					<h3 class="poat-heading2">{{ (\Session::get('newlang')=='English') ? $newspage_cat_projectimhandle[0]->cat_title_eng : $newspage_cat_projectimhandle[0]->cat_title}}</h1>
					<div>{!! (\Session::get('newlang')=='English') ? $newspage_cat_projectimhandle[0]->cat_description_eng : $newspage_cat_projectimhandle[0]->cat_description !!}</div>
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