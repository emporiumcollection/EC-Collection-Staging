<link href="{{ asset('sximo/css/frontend_templete/grid.css')}}" rel="stylesheet">
<section data-selector="section" id="text-2col2">
	<div class="container">
	
		<div class="row header-line2 about-sec">
		
		<h1 data-selector="h3" class="title"><a href="{{ URL::to('products') }}">Produktgruppen</a></h1>
		
		</div>
	</div>
</section>

<div class="container">
	@if(!empty($final_folders))
		@foreach($final_folders as $products)
			<section data-selector="section" id="text-2col">
				<div class="container">
					<div class="row about-sec">
					
						<h1 data-selector="h3" class="title">{{$products['data']->name}}</h1>
						
						<div class="panel-group accordion" id="accordion">
							<div class="panel panel-default repeatVar1">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
											<i class="fa fa-angle-right"></i> Download
										</a>
									</h4>
								</div>
								<div id="collapse1" class="panel-collapse collapse in" style="height: auto;">
									<div class="panel-body">
										<a href="{{URL::to('downloadaszip/'.$products['data']->id)}}">Download as Zip</a>
										@if(!empty($pdf_fileDetail))
											@foreach($pdf_fileDetail as $pdf_files) 
												<br><a href="{{$filepdfsrc . $pdf_files->file_name}}" title="Download" download="{{$pdf_files->file_name}}">Download  {{($pdf_files->file_display_name!='')?$pdf_files->file_display_name:$pdf_files->file_name}}</a>
											@endforeach
										@endif
									</div>
								</div>
							</div>
						</div>
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
									
									$name = (strlen($subproducts['data']['name']) > 23) ? substr($subproducts['data']['name'],0,20)."~":$subproducts['data']['name'];
									/*--}}
								@else
									{{--*/ $ProductcoverPic = ($subproducts['data']['cover_img']!='')? URL::to('uploads/folder_cover_imgs/masonry_product_file_'.$subproducts['data']['cover_img']): URL::to('uploads/images/product_no-image.jpg');
								
									$downloadProductPic = ($subproducts['data']['cover_img']!='')? $filepdfsrc.$subproducts['data']['cover_img'] : URL::to('uploads/images/product_no-image.jpg');

									$expFile = explode('.',$subproducts['data']['name']);
									$name = (strlen($subproducts['data']['name']) > 20) ? substr($subproducts['data']['name'],0,17)."~.". end($expFile):$subproducts['data']['name'];
									/*--}}
								@endif
								<div class="masonry-grid">
									<img src="{{$ProductcoverPic}}" alt="feature">
									<div class="masonry-grid-title">
										{{$name}}
										<p>{{$subproducts['data']['title']}}</p>
									</div>
									
									<p>{{substr($subproducts['data']['description'],0,100)}}</p>
									<p style="text-align:center;"><a href="{{ $downloadProductPic}}" title="Download" download="{{$name}}">Download</a></p>
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

<!-- footer include start -->
	@include('layouts/elliot/bottombar')
  <!-- footer include end -->