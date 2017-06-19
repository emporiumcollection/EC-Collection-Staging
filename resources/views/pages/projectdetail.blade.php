<div class="container">
@if(!empty($project_detail))
	<div class="row page6-banner page7">
		{{--*/ $Topnews = ($project_detail->image_pos_1!='')? URL::to('uploads/project_imgs/'.$project_detail->image_pos_1): URL::to('uploads/images/news_top_no-image.png'); /*--}}
		<img class="img-responsive" src="{{$Topnews}}" alt="1.png" />
		<span>Photo c {{$project_detail->image_credit}}</span>
	</div>
	<div class="row container2 page7">
		<div class="first-post page7">
			<h1 class="title">{{$project_detail->title_pos_1}}</h1>
			<p>	{!! $project_detail->description_pos_1 !!}</p>
			<span><b>Photogarphy:</b><br> {{$project_detail->image_credit}}</span>
		</div>
	</div>
	<div class="row second-post page7">
		@if($project_detail->image_pos_2!='')
		<div class="col-sm-6 lft">
			{{--*/ $projectpos2 = ($project_detail->image_pos_2!='')? URL::to('uploads/project_imgs/'.$project_detail->image_pos_2): URL::to('uploads/images/front_no-image.jpg'); /*--}}
			<img class="img-responsive" src="{{$projectpos2}}" alt="2.png" />
			<span>{{$project_detail->image_credit}}</span>
		</div>
		@endif
		
		@if($project_detail->image_pos_3!='')
		<div class="col-sm-6 rgt">
			{{--*/ $projectpos3 = ($project_detail->image_pos_3!='')? URL::to('uploads/project_imgs/'.$project_detail->image_pos_3): URL::to('uploads/images/front_no-image.jpg'); /*--}}
			<img class="img-responsive" src="{{$projectpos3}}" alt="2.png" />
			<span>{{$project_detail->image_credit}}</span>
		</div>
		@endif
	</div>
	
	<div class="row container2 page7">
		<div class="second-post-text page7">
			<p>	{!! $project_detail->description_pos_3 !!}
			</p>
		</div>
	</div>
	@if($project_detail->image_pos_4!='')
	<div class="row third-post page7">
		{{--*/ $projectpos4 = ($project_detail->image_pos_4!='')? URL::to('uploads/project_imgs/'.$project_detail->image_pos_4): URL::to('uploads/images/front_no-image.jpg'); /*--}}
		<img class="img-responsive" src="{{$projectpos4}}" alt="4.jpg" />
		<span>{{$project_detail->image_credit}}</span>
	</div>
	@endif
	
	<div class="row bor-bott">
		<div class="row container2 page7">
			<div class="fifth-post page7">
				<h3 class="poat-heading">{{ $project_detail->title_pos_4 }}</h3>
				<p>	{!! $project_detail->description_pos_4 !!}
				</p>
			</div>
		</div>
	</div>
	
@endif
</div>
