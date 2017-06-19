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
	@if(!empty($presse_slider))
		<div class="container slider-con">
			<header id="intro-slider" class="intro-block full-slider no-sep feature-page-slider">
				<div id="carousel-full-header" class="carousel slide carousel-full" data-ride="carousel">
				
					<!-- Indicators -->
					<ol class="carousel-indicators">
					  <li data-target="#carousel-full-header" data-slide-to="0" class="active"></li>
					  @for($sl=1; $sl < count($presse_slider); $sl++)
						<li data-target="#carousel-full-header" data-slide-to="{{$sl}}"></li>
					  @endfor
					</ol>
				
					<div class="carousel-inner">
						@if(!empty($presse_slider))
						{{--*/ $s = 0 /*--}}
							@foreach($presse_slider as $slides)
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
			<h1 data-selector="h3" class="title product-title" style="margin-top:50px !important;">Presse Info</h1>
		</div>
	</section>
		
	<section id="text-1col">
		
			<div class="row">
				<div class="col-md-12 editContent ghh" style="width:100%; font-size:15px;">
					@if(!empty($presse_data))
						@if($presse_data->title1!='')
							<p class="presehead"><b>{{$presse_data->title1}}</b></p>
						@endif
						@if($presse_data->description1!='')
							<p style="text-align:left;">
								{{ $presse_data->description1 }}
							</p>
							<hr />
						@endif
						
						@if($presse_data->title2!='')
							<p class="presehead"><b>{{$presse_data->title2}}</b></p>
						@endif
						@if($presse_data->description2!='')
							<p style="text-align:left;">
								{{ $presse_data->description2 }}
							</p>
							<hr />
						@endif
						
						@if($presse_data->title3!='')
							<p class="presehead"><b>{{$presse_data->title3}}</b></p>
						@endif
						@if($presse_data->description3!='')
							<p style="text-align:left;">
								{{ $presse_data->description3 }}
							</p>
							<hr />
						@endif
						
						@if($presse_data->title4!='')
							<p class="presehead"><b>{{$presse_data->title4}}</b></p>
						@endif
						@if($presse_data->description4!='')
							<p style="text-align:left;">
								{{ $presse_data->description4 }}
							</p>
							
						@endif
					@endif
				</div>
			</div>
			
			<div class="row header-line about-sec">
				<div class="col-md-12" style="width:100%;">
					<h1 data-selector="h3" class="title product-title" style="margin-top:60px !important;">Downloads</h1>
				</div>
				<div class="col-md-12" style="width:100%;">
					<p class="downtxt">
						@if(!empty($presse_data))
							{{ $presse_data->download_text }}
						@endif
					</p>
					<p class="downtxt MarTop10" style="font-size:16px;">
						<i class="icon-users2"></i><a href="#" data-dismiss="modal" data-toggle="modal" data-target="#myModal1" onclick="showLogin();"> Bitte hier einmalig registrieren</a>
					</p>
				</div>
			</div>
			
			<div class="row header-line about-sec">
				@if(!empty($firme_temp_array))
					<div class="panel-group accordion" id="accordion">
						<div class="panel panel-default">
							<div class="panel-heading">
							<hr style="width:100%; margin-bottom:20px;" />
								<h3 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapsefirme">
										<i class="fa fa-arrow-right"></i> Firmenportrait und Firmenzeichnen
									</a>
								</h3>
							</div>
							<div id="collapsefirme" class="panel-collapse collapse" style="height: auto;">
								<div class="panel-body">
									<ul>
										@foreach($firme_temp_array as $firme)
											<li class="material col-xs-6 col-md-4 col-lg-3">
												<img src="{{URL::to('uploads/thumbs/format_'.$firme['folder_id'].'_'.$firme['cover_img'])}}" title="{{$firme['name']}}" class="img-responsive" />
												<a href="{{$firme['imgsrc'].$firme['cover_img']}}" title="Download" download="{{$firme['cover_img']}}" target="_self"> <i class="fa fa-download"></i> Download</a>
											</li>
										@endforeach
									</ul>
									<p style="float:left; padding: 10px 15px 0px 15px;">{{$firme_folder->description}}</p>
								</div>
							</div>
						</div>	
					</div>
				@endif
			</div>
			
			<hr/>
			<h3 style="font-size: 16px;">Redaktionelle Bilder und Texte</h3>
			<div class="row header-line about-sec">
				@if(!empty($presse_final_folders))
					<div class="panel-group accordion" id="accordion">
						@foreach($presse_final_folders as $pressedown)
							@foreach($pressedown['child'] as $pressedown_child)
								<div class="panel panel-default">
									<div class="panel-heading">
									<hr style="width:100%; margin-bottom:20px;" />
										<h3 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$pressedown_child['data']['id']}}">
											<i class="fa fa-arrow-right"></i> {{$pressedown_child['data']['name']}}
											</a>
										</h3>
									</div>
									<div id="collapse{{$pressedown_child['data']['id']}}" class="panel-collapse collapse" style="height: auto;">
										<div class="panel-body">
											@if(!empty($pressedown_child['subchild']))
												{{--*/ 
													usort($pressedown_child['subchild'], function($a, $b) {
														return $a['data']['sort_num'] - $b['data']['sort_num']; 
													});
												/*--}}
												<ul>
													@foreach($pressedown_child['subchild'] as $presse_subchild)
														<li class="material col-xs-6 col-md-4 col-lg-3">
															<img src="{{URL::to('uploads/thumbs/format_'.$presse_subchild['data']['folder_id'].'_'.$presse_subchild['data']['cover_img'])}}" title="{{$presse_subchild['data']['name']}}" class="img-responsive" />
															<a href="{{$pressedown_child['data']['imgsrc'].'jpg-highres/'.$presse_subchild['data']['cover_img']}}" title="Download" download="{{$presse_subchild['data']['cover_img']}}" target="_self"> <i class="fa fa-download"></i> Download</a>
														</li>
													@endforeach
												</ul>
											@endif
											<p style="float:left; padding: 0 15px;">{{$pressedown_child['data']['description']}}</p>
										</div>
									</div>
								</div>
							@endforeach
						@endforeach	
					</div>
				@endif
			</div>
			
			<hr/>
			<h3 style="font-size: 16px;">Produktbilder und Texte</h3>
			<div class="row header-line about-sec">
				@if(!empty($final_folders))
					<div class="panel-group accordion" id="accordion">
						@foreach($final_folders as $products)
							<div class="panel panel-default">
								<div class="panel-heading">
								<hr style="width:100%; margin-bottom:20px;" />
									<h3 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$products['data']->id}}">
										<i class="fa fa-arrow-right"></i> {{$products['data']->display_name}}
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
			
			<hr/>
			<h3 style="font-size: 16px;">Weitere Themen/Downloads</h3>
			<div class="row header-line about-sec">
				@if(!empty($weitere_final_folders))
					<div class="panel-group accordion" id="accordion">
						@foreach($weitere_final_folders as $weitere)
							@foreach($weitere['child'] as $weitere_child)
								<div class="panel panel-default">
									<div class="panel-heading">
									<hr style="width:100%; margin-bottom:20px;" />
										<h3 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$weitere_child['data']['id']}}">
											<i class="fa fa-arrow-right"></i> {{$weitere_child['data']['name']}}
											</a>
										</h3>
									</div>
									<div id="collapse{{$weitere_child['data']['id']}}" class="panel-collapse collapse" style="height: auto;">
										<div class="panel-body">
											@if(!empty($weitere_child['subchild']))
												<ul>
													@foreach($weitere_child['subchild'] as $weitere_subchild)
														<li class="material col-xs-6 col-md-4 col-lg-3">
															<img src="{{URL::to('uploads/thumbs/thumb_'.$weitere_child['data']['id'].'_'.$weitere_subchild['data']['cover_img'])}}" title="{{$weitere_subchild['data']['name']}}" class="img-responsive" style="height:120px;"/>
														</li>
													@endforeach
												</ul>
											@endif
											<p style="float:left; padding: 0 15px;">{{$weitere_child['data']['description']}}</p>
										</div>
									</div>
								</div>
							@endforeach
						@endforeach	
					</div>
				@endif
			</div>
	</section>
</div>
<br>
