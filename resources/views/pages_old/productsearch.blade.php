<section data-selector="section" id="text-2col2">
	<div class="container">
	
		<div class="row header-line2 about-sec">
		
		<h1 data-selector="h3" class="title">Produktgruppen</h1>

		<p>Korpusmöbel von JANUA®</p>
		</div>
	</div>
</section>

<div class="container">
	@if(!empty($final_folders))
		@foreach($final_folders as $products)
			@if($default_front_design=="grid")		
				<section id="benefits-grid-images-left" class="new-padding">
					<div class="container">
						<div class="row no-dev">
							@if(!empty($products['child']))
								{{--*/ 
									$pd = 0;
								/*--}}
								@foreach($products['child'] as $subproducts)
									<div class="col-sm-4">
										<ul class="item-list">
											<li>
												@if($subproducts['data']['file_type']=="folder")
													{{--*/ $ProductcoverPic = ($subproducts['data']['cover_img']!='')? URL::to('uploads/folder_cover_imgs/product_'.$subproducts['data']['cover_img']): URL::to('uploads/images/product_no-image.jpg');
													
													$link = URL::to('feature/'.$subproducts['data']['id']);
													$name = (strlen($subproducts['data']['name']) > 23) ? substr($subproducts['data']['name'],0,20)."~":$subproducts['data']['name'];
													/*--}}
												@else
													{{--*/ $ProductcoverPic = ($subproducts['data']['cover_img']!='')? URL::to('uploads/folder_cover_imgs/product_file_'.$subproducts['data']['cover_img']): URL::to('uploads/images/product_no-image.jpg');

													$link = URL::to('feature/'.$subproducts['data']['id']);
													$expFile = explode('.',$subproducts['data']['name']);
													$name = (strlen($subproducts['data']['name']) > 20) ? substr($subproducts['data']['name'],0,17)."~.". end($expFile):$subproducts['data']['name'];
													/*--}}
												@endif
												<a href="{{$link}}"><img src="{{$ProductcoverPic}}" alt="feature" class="screen img-circle"></a>
												<h3><a href="{{$link}}">{{$name}}</a></h3>
												<h4>{{(strlen($subproducts['data']['title']) > 50) ? substr($subproducts['data']['title'],0,50).'...':$subproducts['data']['title']}}</h4>
												<p class="editContent">{{(strlen($subproducts['data']['description']) > 100) ? substr($subproducts['data']['description'],0,100).'...':$subproducts['data']['description']}}</p>
											</li>
										</ul>
									</div>
									{{--*/ $pd++ /*--}}
									@if($pd%3==0)
										</div>
										<div class="row no-dev">
									@endif
								@endforeach
							@else
								<div class="col-sm-12">
									<h1 style="text-align:center;">No product available</h1>
								</div>
							@endif
						</div>
					</div>
				</section>
			@elseif($default_front_design=="masonry")
				<link href="{{ asset('sximo/css/frontend_templete/grid.css')}}" rel="stylesheet">
				<section id="benefits-grid-images-left" class="new-padding">
					<div class="masonry-grid-main">
						<div class="container">
							<article>
							@if(!empty($products['child']))
								{{--*/ 
									$pd = 0;
								/*--}}
								@foreach($products['child'] as $subproducts)
								
									@if($subproducts['data']['file_type']=="folder")
										{{--*/ $ProductcoverPic = ($subproducts['data']['cover_img']!='')? URL::to('uploads/folder_cover_imgs/masonry_product_'.$subproducts['data']['cover_img']): URL::to('uploads/images/product_no-image.jpg');
										
										$link = URL::to('feature/'.$subproducts['data']['id']);
										$name = (strlen($subproducts['data']['name']) > 23) ? substr($subproducts['data']['name'],0,20)."~":$subproducts['data']['name'];
										/*--}}
									@else
										{{--*/ $ProductcoverPic = ($subproducts['data']['cover_img']!='')? URL::to('uploads/folder_cover_imgs/masonry_product_file_'.$subproducts['data']['cover_img']): URL::to('uploads/images/product_no-image.jpg');

										$link = URL::to('feature/'.$subproducts['data']['id']);
										$expFile = explode('.',$subproducts['data']['name']);
										$name = (strlen($subproducts['data']['name']) > 20) ? substr($subproducts['data']['name'],0,17)."~.". end($expFile):$subproducts['data']['name'];
										/*--}}
									@endif
									
									<div class="masonry-grid">
										<a href="{{$link}}"><img src="{{$ProductcoverPic}}" alt="feature"></a>
										<div class="masonry-grid-title">
											<a href="{{$link}}">{{$name}}</a>
											<p>{{(strlen($subproducts['data']['title']) > 50) ? substr($subproducts['data']['title'],0,50).'...':$subproducts['data']['title']}}</p>
										</div>
										
										<p>{{(strlen($subproducts['data']['description']) > 100) ? substr($subproducts['data']['description'],0,100).'...':$subproducts['data']['description']}}</p>
									</div>
								@endforeach
							@endif
							</article>
						</div>
					</div>
				</section>
			@endif
		@endforeach
	@endif 
</div>

<!-- footer include start -->
	@include('layouts/elliot/bottombar')
  <!-- footer include end -->