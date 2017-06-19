<section data-selector="section" id="text-2col2">
	<div class="container">
		<div class="row header-line2 about-sec">
		<h1 data-selector="h3" class="title">Projects</h1>
		</div>
	</div>
</section>
		   
   <section data-selector="section" id="text-2col">
	<div class="container">
		<div class="row">
			@if(!empty($projects))
				{{--*/ $pd = 0 /*--}}
				@foreach($projects as $project)
					<div class="col-sm-4 three-box-top">
					  <div class="box-img">
						{{--*/ $Topnews = ($project->image_pos_1!='')? URL::to('uploads/project_imgs/project_'.$project->image_pos_1): URL::to('uploads/images/front_no-image.jpg'); /*--}}
						<a href="{{URL::to('projectdetail/'.$project->id)}}"><img class="img-responsive" src="{{$Topnews}}" alt="images-1" /></a>
					  </div>
					  <div class="text-section">
						  <span class="sm-heading">JANUA®- {{($project->image_credit!='')?$project->image_credit: 'neu im team'}}</span>
						  <h4 class="bottom-box-heading"><a href="{{URL::to('projectdetail/'.$project->id)}}">{{$project->title_pos_1}}</a></h4>
						  <p>{{substr(strip_tags($project->description_pos_1),0,200)}}</p>
						  <span class="sm-heading"><a href="{{URL::to('projectdetail/'.$project->id)}}">{{ date("d. m. Y", strtotime($project->publish_date)) }}</a></span>
					  </div>
					</div>
					{{--*/ $pd++ /*--}}
					@if($pd%3==0)
						</div>
						<div class="row">
					@endif
				@endforeach
			@endif
		</div>
	</div>
  </section>
  
  <!-- footer include start -->
	@include('layouts/elliot/bottombar')
  <!-- footer include end -->