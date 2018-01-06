<div class="container">
	@if(!empty($final_folders))
		<section id="benefits-grid-images-left" class="new-padding">
			<div class="container">
				<div class="row no-dev">
					@foreach($final_folders as $products)
						@if($default_front_design=="grid")		
							
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
												{{--*/  $mainpro_name = strtolower(str_replace(' ','-',$subproducts['data']['parentproduct']));
													$pro_name = strtolower(str_replace(' ','-',$subproducts['data']['display_name']));
														$link = URL::to('product/'.$mainpro_name.'/'.$pro_name); 
												/*--}}
												<a href="{{$link}}"><img src="{{$ProductcoverPic}}" alt="feature" class="screen img-circle"></a>
												<a href="{{$link}}"><h3>{{$name}}</h3></a>
												<p class="editContent">
													@if(strlen($subproducts['data']['title']) > 100)
														{{substr($subproducts['data']['title'],0,100).'...'}}
													@else
														{{substr($subproducts['data']['title'],0,-1)}}
													@endif
												</p>
												<p style="text-align:left; height:35px;"> @if(!empty($subproducts['data']['designer']))Designer : <a href="{{URL::to('designer/'.$subproducts['data']['designer']->id)}}">{{$subproducts['data']['designer']->designer_name }} </a> @else &nbsp; @endif</p>
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
												{{--*/  $mainpro_name = strtolower(str_replace(' ','-',$subproducts['data']['parentproduct']));
													$pro_name = strtolower(str_replace(' ','-',$subproducts['data']['display_name']));
														$link = URL::to('product/'.$mainpro_name.'/'.$pro_name); 
												/*--}}
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
				</div>
			</div>
		</section>
	@endif 
</div>