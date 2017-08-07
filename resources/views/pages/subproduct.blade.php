<section data-selector="section" id="text-2col2">
	<div class="container">
	
		<div class="row header-line2 about-sec">
		
		<p id="folder_name" class="sub-cat hidden-xs">
			@if(!empty($parentsfolders))
				{{--*/ 
					usort($parentsfolders, function($a, $b) {
						return $a['data']->sort_num - $b['data']->sort_num; 
					});
				/*--}}
				@foreach($parentsfolders as $catArr)
					{{--*/  $act_name = strtolower(str_replace(' ','-',$catArr['data']->display_name));
							$plinkm = URL::to('product/'.$act_name); 
					/*--}}
					<a href="{{ $plinkm }}">
						<b class="@if(Request::is('subproduct/'.$catArr['data']->id)) aactive @endif">{{(\Session::get('newlang')=='English') ? $catArr['data']->display_name_eng : $catArr['data']->display_name}}</b></a>/
				@endforeach
					<a href="{{ URL::to('materials') }}"><b>{{\Lang::get('core.menu_frontend_materials')}}</b></a>
			@endif
		</p>
		@if(!empty($parentsfolders))
			<div class="panel-group accordion visible-xs sub-cat" id="accordion" style="padding:0 10px;">
				<div class="panel panel-default repeatVar1">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
								<i class="fa fa-angle-right"></i> Menü
							</a>
						</h4>
					</div>
					<div id="collapse1" class="panel-collapse collapse" style="height: auto;">
						<div class="panel-body">
							@foreach($parentsfolders as $catArr)
								{{--*/  $act_name = strtolower(str_replace(' ','-',$catArr['data']->display_name));
										$plinkm = URL::to('product/'.$act_name); 
								/*--}}
								<a href="{{ $plinkm }}">
									<b>{{ (\Session::get('newlang')=='English') ? $catArr['data']->display_name_eng : $catArr['data']->display_name}}</b>
								</a><br>
							@endforeach
								<a href="{{ URL::to('materials') }}"><b>{{\Lang::get('core.menu_frontend_materials')}}</b></a>
						</div>
					</div>
				</div>
			</div>
		@endif
		</div>
	</div>
</section>

<div class="container">
	@if(!empty($final_folders))
		@foreach($final_folders as $products)
			<section data-selector="section" id="text-2col">
				<div class="container">
					<div class="row about-sec">
					{{--*/  $act_name = strtolower(str_replace(' ','-',$products['data']->display_name));
							$plink = URL::to('product/'.$act_name); 
					/*--}}
					<h1 data-selector="h3" class="title"><a href="{{ $plink }}">{{(\Session::get('newlang')=='English') ? $products['data']->display_name_eng : $products['data']->display_name}}</a></h1>
					
					
					<!--<p class="sub-cat">
						@if(!empty($final_folders))
							@foreach($final_folders as $catArr)
								@if(!empty($catArr['child']))
									{{--*/ 
										usort($catArr['child'], function($a, $b) {
											return $a['data']['sort_num'] - $b['data']['sort_num']; 
										});
									/*--}}
									@foreach($catArr['child'] as $subcat)
										@if($subcat['data']['file_type']=="folder")
											{{--*/ $breadlink = URL::to('feature/'.$subcat['data']['id']); /*--}}
										@else
											{{--*/ $breadlink = URL::to('feature/'.$subcat['data']['id']); /*--}}
										@endif
										<a href="{{ $breadlink }}">
											<b>{{$subcat['data']['name']}}</b></a>
											@if(end($catArr['child'])!=$subcat) <span class="middlelineff"></span>@endif
									@endforeach
								@endif
							@endforeach
						@endif
					</p>
					<br>-->
					</div>
				</div>
			</section>
			@if($default_front_design=="grid")
				<section id="benefits-grid-images-left" class="new-padding">
					<div class="container">
						<div class="row no-dev">
							@if(!empty($products['child']))
								{{--*/ 
									$pd = 0;
									usort($products['child'], function($a, $b) {
										return $a['data']['sort_num'] - $b['data']['sort_num']; 
									});
								/*--}}
								@foreach($products['child'] as $subproducts)
									<div class="col-sm-4">
										<ul class="item-list">
											<li>
												@if($subproducts['data']['file_type']=="folder")
													{{--*/ $ProductcoverPic = ($subproducts['data']['cover_img']!='')? URL::to('uploads/folder_cover_imgs/product_'.$subproducts['data']['cover_img']): URL::to('uploads/images/product_no-image.jpg');
													
													//$link = URL::to('feature/'.$subproducts['data']['id']);
													$name = (strlen($subproducts['data']['name']) > 23) ? substr($subproducts['data']['name'],0,20)."~":$subproducts['data']['name'];
													/*--}}
												@else
													{{--*/ $ProductcoverPic = ($subproducts['data']['cover_img']!='')? URL::to('uploads/folder_cover_imgs/product_file_'.$subproducts['data']['cover_img']): URL::to('uploads/images/product_no-image.jpg');

													//$link = URL::to('feature/'.$subproducts['data']['id']);
													$expFile = explode('.',$subproducts['data']['name']);
													$name = (strlen($subproducts['data']['name']) > 20) ? substr($subproducts['data']['name'],0,17)."~.". end($expFile):$subproducts['data']['name'];
													/*--}}
												@endif
												
												{{--*/  $pro_name = strtolower(str_replace(' ','-',$subproducts['data']['display_name']));
														$link = URL::to('product/'.$act_name.'/'.$pro_name); 
												/*--}}
												<a href="{{$link}}"><img src="{{$ProductcoverPic}}" alt="feature" class="screen img-circle"></a>
												<h3><a href="{{$link}}">{{$name}}</a></h3>
												<p class="editContent">
													@if(strlen($subproducts['data']['title']) > 100)
														{{substr($subproducts['data']['title'],0,100)}}
													@else
													{{substr($subproducts['data']['title'],0,-1)}}
													@endif
												</p>
												<p style="text-align:left; height:35px;"> @if(!empty($subproducts['data']['designer'])) Designer : 
												{{--*/  $des_name = strtolower(str_replace(' ','-',$subproducts['data']['designer']->designer_name));
														$dlink = URL::to('designer/'.$des_name); 
												/*--}}
												<a href="{{$dlink}}">{{$subproducts['data']['designer']->designer_name }} </a> @else &nbsp; @endif</p>
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
										</div>
										
										<p>
											@if(strlen($subproducts['data']['title']) > 100)
												{{substr($subproducts['data']['title'],0,100)}}
											@else
											{{substr($subproducts['data']['title'],0,-1)}}
											@endif
										</p>
										<p> @if(!empty($subproducts['data']['designer'])) Designer : <a href="{{URL::to('designer/'.$subproducts['data']['designer']->id)}}"> {{$subproducts['data']['designer']->designer_name }} </a> @endif</p>
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

<script>
	function redirect_product_cat(proID)
	{
		if(proID!='' && proID>0)
		{
			window.location.href = '<?php echo URL::to('subproduct'); ?>'+'/'+proID;
		}
		else
		{
			window.location.href = '<?php echo URL::to('products'); ?>';
		}
	}
</script>