@include('layouts/elliot/ai_header')
@include('layouts/elliot/ai_navigation_bar_style_2')

<link href="{{ asset('sximo/assets/css/footer-accordian.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/filters_grid.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/filter-bar.css')}}" rel="stylesheet" type="text/css"/>

<!--Main Page Start here-->
<div class="col-md-12 col-sm-12 col-xs-12 ">
    <div class="row">
	
		@if($propertiesArr)
			{{--*/ $nw = 0; /*--}}
			@foreach($propertiesArr as $props)
				@if($nw<5)
					
						@if($nw==0)
							<div class="col-md-12 col-sm-12 col-xs-12 padding-left-0 padding-right-0">
								<div class="col-md-6 col-sm-6 col-xs-12 res-margin-sub-box margin-bottom-10">
									@if(array_key_exists('image', $props))
										<img alt="{{$props['image']->file_name}}" src="{{URL::to('uploads/property_imgs_thumbs/front_property_large_'.$props['image']->folder_id.'_'.$props['image']->file_name)}}" class="img-responsive">
									@else
										<img class="img-responsive" src="{{URL::to('sximo/assets/images/img-1.jpg')}}" alt="">
									@endif
									<div class="col-md-6 col-sm-6 col-xs-6">
										<div class="row">
											<div class="image-hotels-tittle">{{$props['data']->property_name}}</div>
											<div class="add-to-lightbox-text"><a href="#">Add to lightbox</a></div>
											<div class="view-btn"><a href="#">View / Request</a></div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-6">
										<div class="row">
											<ul class="big-image-side-floating-icons">
												<li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i></a></li>
												<li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i></a></li>
												<li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="row">
						@else
										<div class="col-md-6 col-sm-6 col-xs-12 res-margin-sub-box margin-bottom-10">
											@if(array_key_exists('image', $props))
												<img alt="{{$props['image']->file_name}}" src="{{URL::to('uploads/property_imgs_thumbs/front_property_'.$props['image']->folder_id.'_'.$props['image']->file_name)}}" class="img-responsive">
											@else
												<img class="img-responsive" src="{{URL::to('sximo/assets/images/img-2.jpg')}}" alt="">
											@endif
											<div class="col-md-6 col-sm-12 col-xs-6">
												<div class="row">
													<div class="image-hotels-tittle">{{$props['data']->property_name}}</div>
													<div class="add-to-lightbox-text"><a href="#">Add to lightbox</a></div>
													<div class="view-btn"><a href="#">View / Request</a></div>
												</div>
											</div>
											<div class="col-md-6 col-sm-12 col-xs-6">
												<div class="row">
													<ul class="image-side-floating-icons">
														<li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i></a></li>
													</ul>
												</div>
											</div>
										</div>
								
						@endif
						@if($nw==4)
									</div>
								</div>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12 margin-top-15">
								<div class="row">
						@endif
				@else
					<!--Next Row-->
							<div class="col-md-3 col-sm-3 col-xs-12  res-margin-sub-box margin-bottom-10">
								@if(array_key_exists('image', $props))
									<img alt="{{$props['image']->file_name}}" src="{{URL::to('uploads/property_imgs_thumbs/front_property_'.$props['image']->folder_id.'_'.$props['image']->file_name)}}" class="img-responsive">
								@else
									<img class="img-responsive" src="{{URL::to('sximo/assets/images/img-2.jpg')}}" alt="">
								@endif
								<div class="col-md-6 col-sm-12 col-xs-6">
									<div class="row">
										<div class="image-hotels-tittle">{{$props['data']->property_name}}</div>
										<div class="add-to-lightbox-text"><a href="#">Add to lightbox</a></div>
										<div class="view-btn"><a href="#">View / Request</a></div>
									</div>
								</div>
								<div class="col-md-6 col-sm-12 col-xs-6">
									<div class="row">
										<ul class="image-side-floating-icons">
											<li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
					<!--Row End Here-->
				@endif
				@if($nw==19)
						</div>
					</div>
				@endif
				{{--*/ $nw++; /*--}}
			@endforeach
		@endif
    </div>
</div>
@include('layouts/elliot/ai_footer')