
<section data-selector="section" id="text-2col2">
	<div class="container">
	
		<div class="row header-line2 about-sec">
		
		<p id="folder_name" class="sub-cat hidden-xs">
			@if(!empty($final_folders))
				{{--*/ 
					usort($final_folders, function($a, $b) {
						return $a['data']->sort_num - $b['data']->sort_num; 
					});
				/*--}}
				@foreach($final_folders as $catArr)
					{{--*/  $act_name = strtolower(str_replace(' ','-',$catArr['data']->display_name));
							$plinkm = URL::to('product/'.$act_name); 
					/*--}}
					<a href="{{ $plinkm }}">
						<b>{{(\Session::get('newlang')=='English') ? $catArr['data']->display_name_eng : $catArr['data']->display_name}}</b></a>/
				@endforeach
					<a href="{{ URL::to('materials') }}"><b class="@if(Request::is('materials')) aactive @endif">{{\Lang::get('core.menu_frontend_materials')}}</b></a>
			@endif
		</p>
		@if(!empty($final_folders))
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
							@foreach($final_folders as $catArr)
								{{--*/  $act_name = strtolower(str_replace(' ','-',$catArr['data']->display_name));
										$plinkm = URL::to('product/'.$act_name); 
								/*--}}
								<a href="{{ $plinkm }}">
									<b>{{$catArr['data']->display_name}}</b>
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
	@if(!empty($final_material_folders))
		@foreach($final_material_folders as $material)
			<section data-selector="section" id="text-2col">
				<div class="container">
					<div class="row about-sec">
					
					<h1 data-selector="h3" class="title product-title">{{\Lang::get('core.menu_frontend_materials')}}</h1>
					
					</div>
				</div>
			</section>
			
			@if($default_front_design=="grid")
				<section id="benefits-grid-images-left" class="new-padding">
					<div class="container">
						<div class="row no-dev">
							@if(!empty($material['child']))
								{{--*/ 
									$pd = 0;
									usort($material['child'], function($a, $b) {
										return $a['data']['sort_num'] - $b['data']['sort_num']; 
									});
								/*--}}
								@foreach($material['child'] as $submaterial)
									<div class="col-sm-4 three-box-products">
										<ul class="item-list">
											<li>
											@if($submaterial['data']['file_type']=="folder")
													{{--*/ $ProductcoverPic = ($submaterial['data']['cover_img']!='')? URL::to('uploads/folder_cover_imgs/product_'.$submaterial['data']['cover_img']): URL::to('uploads/images/product_no-image.jpg');
													
													//$link = URL::to('submaterials/'.$submaterial['data']['id']);
													$name = (strlen($submaterial['data']['name']) > 23) ? substr($submaterial['data']['name'],0,20)."~":$submaterial['data']['name'];
													/*--}}
												@else
													{{--*/ $ProductcoverPic = ($submaterial['data']['cover_img']!='')? URL::to('uploads/folder_cover_imgs/product_file_'.$submaterial['data']['cover_img']): URL::to('uploads/images/product_no-image.jpg');

													//$link = URL::to('submaterials/'.$submaterial['data']['id']);
													$expFile = explode('.',$submaterial['data']['name']);
													$name = (strlen($submaterial['data']['name']) > 20) ? substr($submaterial['data']['name'],0,17)."~.". end($expFile):$submaterial['data']['name'];
													/*--}}
												@endif
												
												{{--*/  $mat_name = strtolower(str_replace(' ','-',$submaterial['data']['display_name']));
														$link = URL::to('material/'.$mat_name); 
												/*--}}
												<a href="{{$link}}"><img src="{{$ProductcoverPic}}" alt="feature" class="screen img-circle"></a>
												<h3><a href="{{$link}}">{{$name}}</a></h3>
												<p class="editContent">
													@if(strlen($submaterial['data']['description']) > 230)
														{{substr($submaterial['data']['description'],0,230)}}
													@else
														{{substr($submaterial['data']['description'],0,-1)}}
													@endif
												</p>
											</li>
										</ul>
									</div>
									{{--*/ $pd++ /*--}}
									@if($pd%3==0)
										</div>
										<div class="row no-dev">
									@endif
								@endforeach
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
							@if(!empty($material['child']))
								{{--*/ 
									$pd = 0;
									usort($material['child'], function($a, $b) {
										return $a['data']['sort_num'] - $b['data']['sort_num']; 
									});
								/*--}}
								@foreach($material['child'] as $submaterial)
								
									@if($submaterial['data']['file_type']=="folder")
										{{--*/ $ProductcoverPic = ($submaterial['data']['cover_img']!='')? URL::to('uploads/folder_cover_imgs/masonry_product_'.$submaterial['data']['cover_img']): URL::to('uploads/images/product_no-image.jpg');
										
										//$link = URL::to('feature/'.$submaterial['data']['id']);
										$name = (strlen($submaterial['data']['name']) > 23) ? substr($submaterial['data']['name'],0,20)."~":$submaterial['data']['name'];
										/*--}}
									@else
										{{--*/ $ProductcoverPic = ($submaterial['data']['cover_img']!='')? URL::to('uploads/folder_cover_imgs/masonry_product_file_'.$submaterial['data']['cover_img']): URL::to('uploads/images/product_no-image.jpg');

										//$link = URL::to('feature/'.$submaterial['data']['id']);
										$expFile = explode('.',$submaterial['data']['name']);
										$name = (strlen($submaterial['data']['name']) > 20) ? substr($submaterial['data']['name'],0,17)."~.". end($expFile):$submaterial['data']['name'];
										/*--}}
									@endif
									
									{{--*/  $mat_name = strtolower(str_replace(' ','-',$submaterial['data']['display_name']));
											$link = URL::to('material/'.$mat_name); 
									/*--}}
									
									<div class="masonry-grid">
										<a href="#"><img src="{{$ProductcoverPic}}" alt="feature"></a>
										<div class="masonry-grid-title">
											<a href="#">{{$name}}</a>
										</div>
										
										<p>
											@if(strlen($submaterial['data']['title']) > 100)
												{{substr($submaterial['data']['title'],0,100)}}
											@else
											{{substr($submaterial['data']['title'],0,-1)}}
											@endif
										</p>
									</div>
								@endforeach
							@endif
							</article>
						</div>
					</div>
				</section>
			@endif
			
			<section data-selector="section" id="text-2col">
				<div class="container2">
					<div class="row">
						<h3 class="poat-heading2">{{ (\Session::get('newlang')=='English') ? $material['data']->title_eng : $material['data']->title }}</h1>
						<div>{{ (\Session::get('newlang')=='English') ? $material['data']->description_eng : $material['data']->description }}</div>
					</div>
				</div>
			</section>
			
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