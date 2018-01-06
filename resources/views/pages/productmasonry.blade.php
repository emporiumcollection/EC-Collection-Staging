<link href="{{ asset('sximo/css/frontend_templete/grid.css')}}" rel="stylesheet">
<section data-selector="section" id="text-2col2">
	<div class="container">
	
		<div class="row header-line2 about-sec">
		
		<h1 data-selector="h3" class="title">Produktgruppen</h1>

		<p>
			@if(!empty($final_folders))
				{{--*/ 
					usort($final_folders, function($a, $b) {
						return $a['data']->sort_num - $b['data']->sort_num; 
					});
				/*--}}
				@foreach($final_folders as $catArr)
					<a href="{{ URL::to('subproduct/'.$catArr['data']->id) }}">
						<b>{{$catArr['data']->name}}
						@if(end($final_folders)!=$catArr) / @endif</b></a>
				@endforeach
			@endif
		</p>
		</div>
	</div>
</section>

<div class="container">
	@if(!empty($final_folders))
	{{--*/ 
		usort($final_folders, function($a, $b) {
			return $a['data']->sort_num - $b['data']->sort_num; 
		});
	/*--}}
		@foreach($final_folders as $products)
			<section data-selector="section" id="text-2col">
				<div class="container">
					<div class="row about-sec">
					
					<h1 data-selector="h3" class="title"><a href="{{URL::to('subproduct/'.$products['data']->id)}}">{{$products['data']->name}}</a></h1>
					
					</div>
				</div>
			</section>
			
			<section id="benefits-grid-images-left" class="new-padding">
				<div class="masonry-grid-main">
					<div class="container">
						<article>
						@if(!empty($products['child']))
							{{--*/ 
								$pd = 0;
								usort($products['child'], function($a, $b) {
									return $a['data']['sort_num'] - $b['data']['sort_num']; 
								});
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
										<p>{{$subproducts['data']['title']}}</p>
									</div>
									
									<p>{{substr($subproducts['data']['description'],0,100)}}</p>
								</div>
							@endforeach
						@endif
						</article>
					</div>
				</div>
			</section>
		@endforeach
	@endif 
</div>
