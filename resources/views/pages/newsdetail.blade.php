<style>
.jwlogo
{
	display: none; /* hidden as sits over volume on mp3s */
}
</style>
<div class="container">
@if(!empty($news_detail))
	<div class="container21">
		@if($news_detail->cat_id==18)
			@if($news_detail->video_type=="upload")
				{{--*/  $videolink = URL::to('uploads/article_imgs/'.$news_detail->video_upload); 
						$video_banner = ($news_detail->video_banner!='')? URL::to('uploads/article_imgs/'.$news_detail->video_banner): URL::to('sximo/images/mp4.png');
				/*--}}
				<script src="{{ asset('sximo/js/plugins/players/jwplayer/jwplayer.js')}}"></script>
				<div id="jwPlayerContainer">Loading media...</div>
				<script type="text/javascript">
					//<![CDATA[
					$(document).ready(function() {
						jwplayer("jwPlayerContainer").setup({
							file: "{{$videolink}}?download_token=050281d2027a1f662974fc3097b5dee0fa34ee19862c19b04976ddb7420615a7",
							type: "mp4",
							title: "{{$news_detail->title_pos_1}}",
							width: "100%",
							startparam: "start",
							abouttext: "{{$news_detail->title_pos_1}}",
							aboutlink: "{{$videolink}}",
							sharing: {
							link: "{{$videolink}}"
							},
							logo: {
							file: "",
									link: "{{URL::to('')}}",
									linktarget: "_blank",
									hide: "false"
							},
							aspectratio: "16:9",
							image: "{{$video_banner}}",
							autostart: true		
						});
					});
					//]]>
				</script>
			@elseif($news_detail->video_type=="link")
				{{--*/ $vlink = explode('/',$news_detail->video_link); $vimeoid = end($vlink); /*--}}
				@if($news_detail->link_type=="youtube")
					<iframe width="100%" height="535" src="https://www.youtube.com/embed/{{$vimeoid}}" frameborder="0" allowfullscreen></iframe>
				@elseif($news_detail->link_type=="vimeo")
					<iframe src="https://player.vimeo.com/video/{{$vimeoid}}?autoplay=1" width="100%" height="535" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
				@endif
			@endif
		@else
			{{--*/ $Topnews = ($news_detail->image_pos_1!='')? URL::to('uploads/article_imgs/'.$news_detail->image_pos_1): URL::to('uploads/images/news_top_no-image.png'); /*--}}
			<section data-selector="section" id="download-line-2" class="dark-bg2 cover-bg newcol backsiz" style="background-image: url('{{$Topnews}}');">
				
			</section>
		@endif
	</div>
	<div class="row container2" style="margin-top: 35px;">
		<div class="first-post">
			<span><span class="flt_lt"> Post </span><span class="middleline" style="margin:10px;">&nbsp;</span> {{  date("d. m. Y", strtotime($news_detail->publish_date)) }}</span>
			<h3 class="poat-heading">{{ (\Session::get('newlang')=='English') ? $news_detail->title_detail_1_eng : $news_detail->title_detail_1}}</h3>
			<p>	{!! (\Session::get('newlang')=='English') ? $news_detail->description_detail_1_eng : $news_detail->description_detail_1 !!}</p>
			@if($news_detail->external_link!="")
				<p>	<a onclick="return !window.open(this.href, '{{ $news_detail->external_link }}', 'width=900,height=500,left=100, top=100, scrollbars, resizable')" target="_blank" href="http://{{ $news_detail->external_link }}" >{{ $news_detail->external_link }}</a></p>
			@endif
		</div>
	</div>
	
	@if($news_detail->cat_id==7 || $news_detail->cat_id==8 || $news_detail->cat_id==9 || $news_detail->cat_id==19)
		
		<div class="row second-post MrgTop20">
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
		
		@if($news_detail->image_pos_4!='')
			<div class="row third-post MrgTop20">
				{{--*/ $newspos4 = ($news_detail->image_pos_4!='')? URL::to('uploads/article_imgs/'.$news_detail->image_pos_4): URL::to('uploads/images/news_top_no-image.png'); /*--}}
				<img class="img-responsive" src="{{$newspos4}}" alt="4.png" />
			</div>
		@endif
		
		<div class="row fourth-post MrgTop20">
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
		
		@if($news_detail->image_pos_7!='')
			<div class="container21 MrgTop20">
				{{--*/ $newspos7 = ($news_detail->image_pos_7!='')? URL::to('uploads/article_imgs/'.$news_detail->image_pos_7): URL::to('uploads/images/news_top_no-image.png'); /*--}}
				<section data-selector="section" id="download-line-2" class="dark-bg2 cover-bg newcol backsiz" style="background-image: url('{{$newspos7}}');">
				</section>
			</div>
		@endif
		
		<div class="row second-post MrgTop20">
			@if($news_detail->image_pos_8!='')
				<div class="col-sm-6 lft">
					{{--*/ $newspos8 = ($news_detail->image_pos_8!='')? URL::to('uploads/article_imgs/'.$news_detail->image_pos_8): URL::to('uploads/images/front_no-image.jpg'); /*--}}
					<img class="img-responsive" src="{{$newspos8}}" alt="8.png" />
				</div>
			@endif
			
			@if($news_detail->image_pos_9!='')
				<div class="col-sm-6 rgt">
					{{--*/ $newspos9 = ($news_detail->image_pos_9!='')? URL::to('uploads/article_imgs/'.$news_detail->image_pos_9): URL::to('uploads/images/front_no-image.jpg'); /*--}}
					<img class="img-responsive" src="{{$newspos9}}" alt="9.png" />
				</div>
			@endif
		</div>
		
		@if($news_detail->image_pos_10!='')
			<div class="row third-post MrgTop20">
				{{--*/ $newspos10 = ($news_detail->image_pos_10!='')? URL::to('uploads/article_imgs/'.$news_detail->image_pos_10): URL::to('uploads/images/news_top_no-image.png'); /*--}}
				<img class="img-responsive" src="{{$newspos10}}" alt="10.png" />
			</div>
		@endif
		
		<div class="row fourth-post MrgTop20">
			@if($news_detail->image_pos_11!='')
				<div class="col-sm-6">
					{{--*/ $newspos11 = ($news_detail->image_pos_11!='')? URL::to('uploads/article_imgs/'.$news_detail->image_pos_11): URL::to('uploads/images/front_no-image.jpg'); /*--}}
					<img class="img-responsive" src="{{$newspos11}}" alt="11.png" />
				</div>
			@endif
			
			@if($news_detail->image_pos_12!='')
				<div class="col-sm-6">
					{{--*/ $newspos12 = ($news_detail->image_pos_12!='')? URL::to('uploads/article_imgs/'.$news_detail->image_pos_12): URL::to('uploads/images/front_no-image.jpg'); /*--}}
					<img class="img-responsive" src="{{$newspos12}}" alt="12.png" />
				</div>
			@endif
		</div>
	
	@else
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
					{!! (\Session::get('newlang')=='English') ? $news_detail->description_pos_3_eng : $news_detail->description_pos_3 !!}
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
				<h3 class="poat-heading2">
					{{ (\Session::get('newlang')=='English') ? $news_detail->title_pos_6_eng : $news_detail->title_pos_6 }}
				</h3>
				<p>
					{!! (\Session::get('newlang')=='English') ? $news_detail->description_pos_6_eng : $news_detail->description_pos_6 !!}
				</p>
			</div>
		</div>
	@endif
	
	<div class="row container2">
		
		<p style="text-align:center; margin-top: 15px;"><a href="#" onclick="window.history.back();return false;"><i class="fa fa-reply"></i> Zurück zur Übersicht</a></p>
	</div>
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
