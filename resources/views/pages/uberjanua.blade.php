<div class="container">
@if(!empty($newspage_cat_uberjanua))
	<div class="container21">
		{{--*/ $Topnews = ($newspage_cat_uberjanua->image_pos_1!='')? URL::to('uploads/article_imgs/'.$newspage_cat_uberjanua->image_pos_1): URL::to('uploads/images/news_top_no-image.png'); /*--}}
		<section data-selector="section" id="download-line-2" class="dark-bg2 cover-bg newcol backsiz" style="background-image: url('{{$Topnews}}');">
			
		</section>
	</div>
	<div class="row container2" style="margin-top: 35px;">
		<div class="first-post">
			<span><span class="flt_lt"> Post </span><span class="middleline" style="margin:10px;">&nbsp;</span> {{  get_timeago( strtotime($newspage_cat_uberjanua->publish_date) ) }}</span>
			<h3 class="poat-heading">{{(\Session::get('newlang')=='English')?$newspage_cat_uberjanua->title_detail_1_eng:$newspage_cat_uberjanua->title_detail_1}}</h3>
			<p>	{!! (\Session::get('newlang')=='English')?$newspage_cat_uberjanua->description_detail_1_eng:$newspage_cat_uberjanua->description_detail_1 !!}</p>
		</div>
	</div>
	
	<div class="row second-post">
		@if($newspage_cat_uberjanua->image_pos_2!='')
		<div class="col-sm-6 lft">
			{{--*/ $newspos2 = ($newspage_cat_uberjanua->image_pos_2!='')? URL::to('uploads/article_imgs/'.$newspage_cat_uberjanua->image_pos_2): URL::to('uploads/images/front_no-image.jpg'); /*--}}
			<img class="img-responsive" src="{{$newspos2}}" alt="2.png" />
		</div>
		@endif
		@if($newspage_cat_uberjanua->image_pos_3!='')
		<div class="col-sm-6 rgt">
			{{--*/ $newspos3 = ($newspage_cat_uberjanua->image_pos_3!='')? URL::to('uploads/article_imgs/'.$newspage_cat_uberjanua->image_pos_3): URL::to('uploads/images/front_no-image.jpg'); /*--}}
			<img class="img-responsive" src="{{$newspos3}}" alt="3.png" />
		</div>
		@endif
	</div>
	
	<div class="row container2">
		<div class="second-post-text">
			<p>
			{!! (\Session::get('newlang')=='English')?$newspage_cat_uberjanua->description_pos_3_eng:$newspage_cat_uberjanua->description_pos_3 !!}
			</p>
		</div>
	</div>
	
	@if($newspage_cat_uberjanua->image_pos_4!='')
	<div class="row third-post">
		{{--*/ $newspos4 = ($newspage_cat_uberjanua->image_pos_4!='')? URL::to('uploads/article_imgs/'.$newspage_cat_uberjanua->image_pos_4): URL::to('uploads/images/news_top_no-image.png'); /*--}}
		<img class="img-responsive" src="{{$newspos4}}" alt="4.png" />
	</div>
	@endif
	
	<div class="row fourth-post">
		@if($newspage_cat_uberjanua->image_pos_5!='')
		<div class="col-sm-6">
			{{--*/ $newspos5 = ($newspage_cat_uberjanua->image_pos_5!='')? URL::to('uploads/article_imgs/'.$newspage_cat_uberjanua->image_pos_5): URL::to('uploads/images/front_no-image.jpg'); /*--}}
			<img class="img-responsive" src="{{$newspos5}}" alt="5.png" />
		</div>
		@endif
		@if($newspage_cat_uberjanua->image_pos_6!='')
		<div class="col-sm-6">
			{{--*/ $newspos6 = ($newspage_cat_uberjanua->image_pos_6!='')? URL::to('uploads/article_imgs/'.$newspage_cat_uberjanua->image_pos_6): URL::to('uploads/images/front_no-image.jpg'); /*--}}
			<img class="img-responsive" src="{{$newspos6}}" alt="6.png" />
		</div>
		@endif
	</div>
		
	<div class="row container2">
		<div class="fifth-post">
			<h3 class="poat-heading2">{{ (\Session::get('newlang')=='English')?$newspage_cat_uberjanua->title_pos_6_eng:$newspage_cat_uberjanua->title_pos_6 }}</h3>
			<p>
			{!! (\Session::get('newlang')=='English')?$newspage_cat_uberjanua->description_pos_6_eng:$newspage_cat_uberjanua->description_pos_6 !!}
			</p>
		</div>
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
