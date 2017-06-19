@include('layouts/elliot/ai_header')
@include('layouts/elliot/ai_navigation_bar_style_2')

<link href="{{ asset('sximo/assets/css/footer-accordian.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/filters_grid.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/filter-bar.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/ai_yachts-custom.css')}}" rel="stylesheet" type="text/css"/>
<style>
	.FltRgt { float:right; cursor:pointer; }
	.FltLft { float:left; }
	.MrgTop5 { margin-top:5px !important; }
	.searchcount { margin-left: 15px; font-size: 20px; }
	.carticon { float:right; margin-left:5px; }
</style>

<!--Main Page Start here-->
<div class="col-md-12 col-sm-12 col-xs-12 ">
	<div class="row">
		<div class="locator clear">
			<p class="searchcount"> {{$ttlcount}} Hotel(s) Found for {{$keyword}} </p>
		</div>
	</div>
	
	<div id="cityfilters"></div>
	
	<div id="listproperties">
		<div class="row">
			@if($propertiesArr)
				{{--*/ $rw = 1 /*--}}
				@foreach($propertiesArr as $props)
					<div class="productData col-xs-12 col-sm-6 col-md-4 col-lg-3 margin-bottom-10">
						<div class="wrapperforliineedforlightboxremoval">
							<div class="cat_product_medium1">
								<div class="pictureBox gridPicture">
									@if(array_key_exists('image', $props))
										<a title="{{$props['image']->file_name}}" class="picture_link detail_view" rel="{{$props['data']->id}}" href="#">
											
											<img alt="{{$props['image']->file_name}}" src="{{URL::to('uploads/property_imgs_thumbs/front_property_'.$props['image']->folder_id.'_'.$props['image']->file_name)}}" class="img-responsive">
											
											
										</a>
									@else
										<img class="img-responsive" src="{{URL::to('sximo/assets/images/img-1.jpg')}}" alt="">
									@endif
								</div>
								<div class="listDetails">
									<div class="photographBox">
										<h2>
											<a title="{{$props['data']->property_name}}" class="photograph FltLft" rel="{{$props['data']->id}}" href="{{URL::to('our-collection/'.$props['data']->property_slug)}}">
												{{$props['data']->property_name}}
											</a>
											<span class="FltRgt">
												<i class="fa fa-camera-retro colorGrey" aria-hidden="true" title="Add to Itinerary" @if(array_key_exists('image', $props)) onclick="add_to_lightbox({{$props['image']->file_id}}, {{$props['data']->id}});" @endif ></i>
												
												<a class="carticon" href="{{URL::to('our-collection/'.$props['data']->property_slug)}}"><i class="fa fa-shopping-cart colorGrey" aria-hidden="true" title="book this hotel"></i></a>
											</span>
										</h2>
										
									</div>
									
									<div class="entire_story MrgTop5">
										<a class="textButton arrowButton detail_view MrgTop5" rel="{{$props['data']->id}}" href="#">
											Quick View 
										</a>
										
										 <a class="textButton arrowButton MrgTop5" rel="{{$props['data']->id}}" href="{{URL::to('our-collection/'.$props['data']->property_slug)}}">
											Detail View 
										</a>
										
										@if($props['data']->price!='')
											<a class="textButton arrowButton MrgTop5" rel="{{$props['data']->id}}" href="{{URL::to('our-collection/'.$props['data']->property_slug)}}">
												From EUR {{$props['data']->price}} / night 
											</a>
										@endif
									</div>
						
									<div class="showOnHover">
										<div class="hover_request">
									   </div>   
									</div>
								</div>
							</div>
						</div>
					</div>
					@if($rw%4==0)
						</div>
						<div class="row">
					@endif
					{{--*/ $rw++ /*--}}
				@endforeach
				{{--*/ $totpage = $propertiesArr->appends($pager)->lastPage(); $newpage = $currentPage + 2; $prevnewpage = $newpage - 2; /*--}}
			@endif
		</div>
	</div>
	<div id="brgrid"></div>
	<input type="hidden" id="nxtpg" value="{{$newpage}}">
	<input type="hidden" id="ttlpg" value="{{$totpage}}">
</div>
<script>
    $(document).ready(function(){
       $(document).on('click', '.top-bar-filters li.select-all', function (){
            if($(this).hasClass("active")) {
                $('.top-bar-filters li').addClass("active");
                $(this).removeClass("active");
            }
            else {
                $('.top-bar-filters li').removeClass("active");
                $(this).addClass("active");
            }
        });
        $(document).on('click', '.top-bar-filters li', function (){
            if(!$(this).hasClass("select-all")) {
                $(this).toggleClass("active");
                $('.top-bar-filters li.select-all').removeClass("active");
            }
        });
       $(document).on('click', '.clear-all-filters a', function ( event ){
            event.preventDefault();
            $('.top-bar-filters li').removeClass("active");
            $('.top-bar-filters li.select-all').addClass("active");
        });
		
		var scrollTimer, lastScrollFireTime = 0;
		
		$(window).scroll(function () {
			var minScrollTime = 10000;
			var now = new Date().getTime();
			var totlpgs = $('#ttlpg').val();
			var nxtpg = $('#nxtpg').val();
			
			if(nxtpg<=totlpgs)
			{
				if (!scrollTimer) {
					var element_position = $('#brgrid').offset().top + $('#brgrid').outerHeight() - window.innerHeight;
					var y_scroll_pos = $(window).scrollTop();
					if( ( y_scroll_pos >= element_position )) {
						var it_scroll = true;
						scrollDownloadData(it_scroll);
					}
					scrollTimer = setTimeout(function() {
						scrollTimer = null;
						lastScrollFireTime = new Date().getTime();
						var it_scroll = true;
						scrollDownloadData(it_scroll);
					}, minScrollTime);
				}
			}
		});
    });
	
	
	 
	 function scrollDownloadData(it_scroll)
	 {
		 var nxtpg = $('#nxtpg').val();
		var offSet = 20, isPreviousEventComplete = true, isDataAvailable = true;
		var sIndex = $('#listrecrds').val(); 
		var queryStrng = '';
		var destnarea = $('#selDestn').val();
		if(destnarea!='')
		{
			var dest_area = destnarea.split("#:");
			queryStrng = '&dest='+dest_area[0]+'&area='+dest_area[1];
		}
		
		if (isPreviousEventComplete && isDataAvailable) {
			isPreviousEventComplete = false;
			//$(".LoaderImage").css("display", "block");
			
			$.ajax({
			  url: "{{ URL::to('filter_search_destionation')}}",
			  type: "post",
			  data: 's={{$keyword}}&page=' + nxtpg + queryStrng ,
			  dataType: "json",
			  success: function(data){
				var html = chtml = '';
				if(data.status=='error')
				{
					if(it_scroll==false)
					{
						$('#listproperties').html(data.errors);
					}
					else
					{
						('#listproperties').append(data.errors);
					}
					isDataAvailable = false;
				}
				else
				{
					html +='<div class="row">';
					var p=1;
					$.each($.parseJSON(data.properties), function(idx, obj) {
						html += '<div class="productData col-xs-12 col-sm-6 col-md-3 col-lg-3 margin-bottom-10">';
						html += '<div class="wrapperforliineedforlightboxremoval">';
						html += '<div class="cat_product_medium1">';
						html += '<div class="pictureBox gridPicture">';
						if( obj.hasOwnProperty("image")) {
							html += '<a title="'+obj.image.file_name+'" class="picture_link detail_view" rel="'+obj.pdata.id+'" href="#">';
							var pimg = "{{URL::to('uploads/property_imgs_thumbs/')}}/front_property_" + obj.image.folder_id + "_" + obj.image.file_name;
							html += '<img alt="'+obj.image.file_name+'" src="'+pimg+'" class="img-responsive">';
							html += '</a>';
						}else{
							var pimg = "{{URL::to('sximo/assets/images/img-1.jpg')}}";
							html += '<img class="img-responsive" src="'+pimg+'" alt="">';
						}
						
						html += '</div>';
						html += '<div class="listDetails">';
						html += '<div class="photographBox">';
						html += '<h2>';
						var detail_link = "{{URL::to('our-collection/')}}/"+obj.pdata.property_slug;
						html += '<a title="'+obj.pdata.property_name+'" class="photograph FltLft" rel="'+obj.pdata.id+'" href="'+detail_link+'">';
						html += obj.pdata.property_name;
						html += '</a>';
						html += '<span class="FltRgt">';
						if(  obj.hasOwnProperty("image") ) {
							html += '<i class="fa fa-camera-retro colorGrey" aria-hidden="true" title="Add to Itinerary" onclick="add_to_lightbox('+obj.image.file_id+','+obj.pdata.id+');" ></i>';
						}
						else{
							html += '<i class="fa fa-camera-retro colorGrey" aria-hidden="true" title="Add to Itinerary" ></i>';
						}
						html += '<a class="carticon" href="'+detail_link+'"><i class="fa fa-shopping-cart colorGrey" aria-hidden="true" title="book this hotel"></i></a>';
						html += '</span>';
						html += '</h2>';
						html += '</div>';
						html += '<div class="entire_story MrgTop5">';
						html += '<a class="textButton arrowButton detail_view MrgTop5" rel="'+obj.pdata.id+'" href="#">Quick View</a>';
						html += '<a class="textButton arrowButton MrgTop5" rel="'+obj.pdata.id+'" href="'+detail_link+'">Detail View </a>';
						if(obj.pdata.price!='')
						{
							html += '<a class="textButton arrowButton MrgTop5" rel="'+obj.pdata.id+'" href="'+detail_link+'"> From EUR '+obj.pdata.price+' / night </a>';
						}
						html += '</div>';
						html += '<div class="showOnHover">';
						html += '<div class="hover_request">';
						html += '</div>'; 
						html += '</div>';
						html += '</div>';
						html += '</div>';
						html += '</div>';
						html += '</div>';
						if(p%4==0)
						{
							html += '</div>';
							html += '<div class="row">';
						}
						p++;
					});
					html += '</div>';
					if(it_scroll==false)
					{
						$('#listproperties').html(html);
					}
					else{
						$('#listproperties').append(html);
					}
					if(destnarea!='')
					{
						$('#cityfilters').html('');
						var ttp = p - 1;
						if (typeof $.parseJSON(data.cities) !== 'undefined' && $.parseJSON(data.cities).length > 0) {
							chtml += '<div class="row">';
							chtml += '<div class="col-md-12">';
							chtml += '<div class="clear-all-filters"><a href="javascript:void(0)"><i class="fa fa-repeat" aria-hidden="true"></i>&nbsp;Clear Filters</a></div>';
							chtml += '<ul class="top-bar-filters">';
							chtml += '<li class="active select-all">';
							chtml += '<a href="javascript:void(0)" onclick="filter_destination(\''+dest_area[0]+'\',\'city\');">';
							chtml += '<div class="filter-bg">';
							chtml += '<div class="right-text">('+ttp+')</div>';
							chtml += '<div class="clearfix"></div>';
							chtml += '<div><i class="fa fa-home" aria-hidden="true"></i></div>';
							chtml += '<div class="top-filter-name">All Properties</div>';
							chtml += '</div>';
							chtml += '</a>';
							chtml += '</li>';
							$.each($.parseJSON(data.cities), function(idx, cobj) {
								var cimg = "{{URL::to('uploads/category_imgs/')}}/"+cobj.category_image;
								chtml += '<li>';
								chtml += '<a href="javascript:void(0)" onclick="filter_destination(\''+cobj.id+'\',\'city\');">';
								chtml += '<div class="filter-bg" style="background-image: url(\''+cimg+'\');">';
								chtml += '<div class="right-text">('+cobj.totalproperty+')</div>';
								chtml += '<div class="clearfix"></div>';
								chtml += '<div><i class="fa fa-home" aria-hidden="true"></i></div>';
								chtml += '<div class="top-filter-name">'+cobj.category_name+'</div>';
								chtml += '</div>';
								chtml += '</a>';
								chtml += '</li>';
							});	
							chtml += '</ul>';
							chtml += '</div>';
							chtml += '</div>';
							
							$('#cityfilters').html(chtml);
						}
						
						var searchcountdispl = ttp+' Hotel(s) Found for '+data.searchdestname;
						$('.searchcount').html(searchcountdispl);
					}
					
					sIndex = parseInt(sIndex) + offSet;
					$('#listrecrds').val(sIndex); 
					$('#nxtpg').val(parseInt(nxtpg)+1);
					$('#ttlpg').val(data.ttlpages);
					isPreviousEventComplete = true;
				}
			  },
			  error: function (error) {
				  alert(error);
			  }
			});
		}
	 }
</script>
@include('layouts/elliot/ai_footer')
@include('layouts/elliot/ai_lightbox_popups')