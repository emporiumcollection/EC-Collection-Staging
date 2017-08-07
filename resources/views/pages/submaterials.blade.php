<link rel="stylesheet" href="{{ asset('sximo/css/featherlight/featherlight.min.css') }}">
<link rel="stylesheet" href="{{ asset('sximo/css/featherlight/featherlight.gallery.min.css') }}">
<script src="{{ asset('sximo/js/featherlight/featherlight.min.js') }}"></script>
<script src="{{ asset('sximo/js/featherlight/featherlight.gallery.min.js') }}"></script>
<script src="{{ asset('sximo/js/tooltip_popup.js') }}"></script>
<style>
	.item-list li { background:none !important; }
	.item-list h3 { font-size:16px !important; }
	.sub-cat a b { font-weight: normal !important; }
	#screenshot {
		position: absolute;
		border: 1px solid #ccc;
		background: rgba(0, 0, 0, 0.8) !important;
		padding: 20px;
		display: none;
		color: #fff;
		z-index: 1;
		font-size:12px;
	}
</style>
{{--*/ $imgfancy = array(); /*--}}
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
						<b>{{(\Session::get('newlang')=='English') ? $catArr['data']->display_name_eng : $catArr['data']->display_name}}</b></a>/
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
			@if(!empty($material['child']))
				{{--*/ 
					$pd = 0;
					usort($material['child'], function($a, $b) {
						return $a['data']['sort_num'] - $b['data']['sort_num']; 
					});
				/*--}}
				@foreach($material['child'] as $submaterial)
					<section data-selector="section" id="text-2col">
						<div class="container">
							<div class="row about-sec">
							
							<h1 data-selector="h3" class="title">{{$submaterial['data']['name']}}</h1>
							
							</div>
						</div>
					</section>

					<section id="benefits-grid-images-left" class="new-padding">
						<div class="container">
							<div class="row no-dev">
								@if(!empty($submaterial['subchild']))
									{{--*/ 
										$pd = 0;
										usort($submaterial['subchild'], function($a, $b) {
											return $a['data']['sort_num'] - $b['data']['sort_num']; 
										});
									/*--}}
									
									@foreach($submaterial['subchild'] as $submaterialfile)
										<div class="col-sm-4">
											<ul class="item-list">
												<li>
													{{--*/ $ProductcoverPic = ($submaterialfile['data']['cover_img']!='')? URL::to('uploads/folder_cover_imgs/material_file_'.$submaterialfile['data']['cover_img']): URL::to('uploads/images/product_no-image.jpg');

													$link = URL::to('feature/'.$submaterialfile['data']['id']);
													$expFile = explode('.',$submaterialfile['data']['name']);
													$name = (strlen($submaterialfile['data']['name']) > 20) ? substr($submaterialfile['data']['name'],0,17)."~.". end($expFile):$submaterialfile['data']['name'];
													
													$imgfancy[] = $ProductcoverPic;
													
													/*--}}
													
													<a href="{{$ProductcoverPic}}" title="Slideshow" class="gallery2"><img src="{{$ProductcoverPic}}" alt="feature" class="screen img-circle fancybox-buttons"></a>
													<a href="#" style="font-size:13px;">{{($submaterialfile['data']['title']!="")?$submaterialfile['data']['title']:$submaterial['data']['name']}}</a>
													
													<img src="{{URL::to('uploads/images/Circle-Info.png')}}" style="cursor:pointer; float: right; margin-top:2px;" class="materialscreenshot" rel="{{$submaterialfile['data']['title']}}" rel2="{{$submaterialfile['data']['description']}}" title="{{$submaterialfile['data']['name']}}" >
													
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
				@endforeach
			@endif
		@endforeach
	@endif 
</div>

<script>

	$(function(){
		/*$(".fancybox-manual-c").click(function() {
			$.fancybox.open([
				<?php foreach($imgfancy as $imgOBJ){
				
				echo '{href:'.'"'.$imgOBJ.'"},';
				
			}	?>
			], {
				helpers : {
					buttons	: {},
					overlay: { closeClick: false }
				}
			});
		}); */
		
		$('.gallery2').featherlightGallery({
			gallery: {
				fadeIn: 300,
				fadeOut: 300
			},
			variant: 'featherlight-gallery2'
		});
	});
	
	
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