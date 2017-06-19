<style>
	.panel{ border:none; background-color: transparent;  }
	.panel-default > .panel-heading { text-align:left; background-color: transparent; }
	.panel-body { padding: 0px; border-top:none !important; }
	.page-1-head { width:100% !important; }
	.material { margin-top:20px; }
	.material img { margin-bottom:10px; }
	.editContent p { text-align:left; }
	.downtxt {
		text-align: left;
		color: #000;
		margin-top: 30px;
		font-weight:bold;
	}
	.presehead { font-size:18px; margin-bottom:10px !important; }
</style>
<div class="row new-box" >
	@if(!empty($downloads_slider))
		<div class="container slider-con">
			<header id="intro-slider" class="intro-block full-slider no-sep feature-page-slider">
				<div id="carousel-full-header" class="carousel slide carousel-full" data-ride="carousel">
				
					<!-- Indicators -->
					<ol class="carousel-indicators">
					  <li data-target="#carousel-full-header" data-slide-to="0" class="active"></li>
					  @for($sl=1; $sl < count($downloads_slider); $sl++)
						<li data-target="#carousel-full-header" data-slide-to="{{$sl}}"></li>
					  @endfor
					</ol>
				
					<div class="carousel-inner">
						@if(!empty($downloads_slider))
						{{--*/ $s = 0 /*--}}
							@foreach($downloads_slider as $slides)
								<div class="item {{($s==0)?'active':''}}">
									<div style="background-image: url('{{URL::to('uploads/slider_images/'.$slides->slider_img)}}');" class="cover-bg editBg">
											<div class="container double-padding">
												<div class="row">
													<div class="col-md-5 editContent slider-heading">
														<h2 class="big-title">{{$slides->slider_title}}</h2>
														<p><a href="{{$slides->slider_link}}">{{$slides->slider_description}}</a></p>
													</div>
												</div>
											</div>
										</div>
								</div>
								{{--*/ $s++ /*--}}
							@endforeach
						@endif
					</div>
					<!-- Controls -->
					  <a class="left carousel-control" href="#carousel-full-header" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					  </a>
					  <a class="right carousel-control" href="#carousel-full-header" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					  </a>
			</header>
			</div>
		</div>
	@endif

		
<div class="container2">
	<section data-selector="section" id="text-2col">
		<div class="row header-line about-sec">
			<h1 data-selector="h3" class="title product-title" style="margin:50px 0 !important;">Downloads</h1>
		</div>
	</section>
		
	<section id="text-1col">
		
		<div class="row header-line about-sec">
			@if(!empty($publikationen_final_folders))
				<div class="panel-group accordion" id="accordion">
					@foreach($publikationen_final_folders as $pressedown)
						@foreach($pressedown['child'] as $pressedown_child)
							<div class="panel panel-default">
								<div class="panel-heading">
								{{--*/ reset($pressedown['child']); /*--}}
									@if(current($pressedown['child'])!=$pressedown_child)
										<hr style="width:100%; margin-bottom:20px;" />
									@endif
									<h3 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$pressedown_child['data']['id']}}">
										<i class="fa fa-arrow-right"></i> {{$pressedown_child['data']['name']}}
										</a>
									</h3>
								</div>
								<div id="collapse{{$pressedown_child['data']['id']}}" class="panel-collapse in" style="height: auto;">
									<div class="panel-body">
										@if(!empty($pressedown_child['subchild']))
											{{--*/ 
												usort($pressedown_child['subchild'], function($a, $b) {
													return $a['data']['sort_num'] - $b['data']['sort_num']; 
												});
											/*--}}
											<ul>
												@foreach($pressedown_child['subchild'] as $presse_subchild)
													<li class="material col-xs-6 col-md-4 col-lg-4">
													{{--*/ $pdfimg = ($presse_subchild['data']['pdfimg']!='') ? URL::to('uploads/pdf_imgs/downloadp_'.$presse_subchild['data']['pdfimg']) : URL::to('uploads/images/pdf_icon_klein.png'); /*--}}
														<img src="{{$pdfimg}}" title="{{$presse_subchild['data']['name']}}" class="img-responsive"/>
														<p style="font-size: 12px;">
															{{ (strlen($presse_subchild['data']['name']) > 20) ? substr($presse_subchild['data']['name'],0,17).'...':$presse_subchild['data']['name'] }}
														</p>
														<a href="{{URL::to('ViewFlipbookFrontend/'.$presse_subchild['data']['id'])}}" > <img src="http://viwago.com/janua/public/sximo/images/ICON-GALERIE.png" alt="gallery"> Ansehen</a><a href="{{$presse_subchild['data']['imgsrc'].$presse_subchild['data']['cover_img']}}" title="Download" download="{{$presse_subchild['data']['cover_img']}}" target="_self"> <i class="fa fa-download"></i> Download</a>
													</li>
												@endforeach
											</ul>
										@endif
										<p style="float:left; padding: 0 15px; margin-top:20px; width:100%; display:none;">{{$pressedown_child['data']['description']}}</p>
									</div>
								</div>
							</div>
						@endforeach
					@endforeach	
				</div>
			@endif
		</div>
			
		<hr/>
		<h3 style="font-size: 16px;">{{ (\Session::get('newlang')=='English') ? 'Product Information' : 'Produktinformation' }}</h3>
		<p style="margin: 20px 0 30px;">@if(!empty($produktinformation)){{$produktinformation->content }}@endif</p>
		
		<div class="row header-line about-sec">
			@if(!empty($final_folders))
				<div class="panel-group accordion" id="accordion">
					@foreach($final_folders as $products)
						<div class="panel panel-default">
							<div class="panel-heading">
								{{--*/ reset($final_folders); /*--}}
								@if(current($final_folders)!=$products)
									<hr style="width:100%; margin-bottom:20px;" />
								@endif
								<h3 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$products['data']->id}}">
									<i class="fa fa-arrow-right"></i> {{ (\Session::get('newlang')=='English') ?  $products['data']->display_name_eng : $products['data']->display_name }}
									</a>
								</h3>
							</div>
							<div id="collapse{{$products['data']->id}}" class="panel-collapse collapse" style="height: auto;">
								<div class="panel-body">
									@if(!empty($products['child']))
										{{--*/ 
											$pd = 0;
											usort($products['child'], function($a, $b) {
												return $a['data']['sort_num'] - $b['data']['sort_num']; 
											});
										/*--}}
										
										<ul>
											@foreach($products['child'] as $subproducts)
												<li class="material col-xs-6 col-md-4 col-lg-3">
													@if($subproducts['data']['file_type']=="folder")
														{{--*/ $ProductcoverPic = ($subproducts['data']['cover_img']!='')? URL::to('uploads/folder_cover_imgs/product_'.$subproducts['data']['cover_img']): URL::to('uploads/images/product_no-image.jpg');
														
														$link = URL::to('downloadproduct/'.$subproducts['data']['id']);
														$name = (strlen($subproducts['data']['name']) > 23) ? substr($subproducts['data']['name'],0,20)."~":$subproducts['data']['name'];
														/*--}}
													@else
														{{--*/ $ProductcoverPic = ($subproducts['data']['cover_img']!='')? URL::to('uploads/folder_cover_imgs/product_file_'.$subproducts['data']['cover_img']): URL::to('uploads/images/product_no-image.jpg');

														$link = URL::to('downloadproduct/'.$subproducts['data']['id']);
														$expFile = explode('.',$subproducts['data']['name']);
														$name = (strlen($subproducts['data']['name']) > 20) ? substr($subproducts['data']['name'],0,17)."~.". end($expFile):$subproducts['data']['name'];
														/*--}}
													@endif
													{{--*/ $act_name = strtolower(str_replace(' ','-',$products['data']->display_name));
														$pro_name = strtolower(str_replace(' ','-',$subproducts['data']['name']));
														$dlink = URL::to('downloadproduct/'.$act_name.'/'.$pro_name); 
													/*--}}
													<a href="{{$dlink}}"><img src="{{$ProductcoverPic}}" class="img-responsive" style="height:120px;"/></a>
													<a href="{{$dlink}}" style="font-size: 12px;">{{$name}}</a>
												</li>
											@endforeach
										</ul>
									@endif
								</div>
							</div>
						</div>
					@endforeach	
				</div>
			@endif
		</div>
	</section>
</div>
<br>
