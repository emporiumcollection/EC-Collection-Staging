@if (array_key_exists('typedata', $propertyDetail))

<style>

    .image-slider-container ul li.active img {
	width: 100%;
	height: 850px;
    }
    
    .VegasModelDialog {
	width: 100%;
	margin: 4px auto;
    }
    
    .vegasModelFade {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 1050;
        display: none;
        overflow: hidden;
        -webkit-overflow-scrolling: touch;
        outline: 0;
        background-color: black;
        opacity: 0.8;
        height: 100%;
        overflow-x: hidden;
        overflow-y: hidden;
        }
        
        .vegasModelContent {
            background: rgba(0, 0, 0, 0.92) none repeat scroll 0 0;
            opacity: 1;
            min-height: 63em;
            border-radius: 0px;
            float: left;
        }
        
        .vegasModelHeader {
            border-bottom: none;
        }
        
        .vegasModelFooter {
            border-top: none;
        }

        .vegasGallery1 {
            min-height: 500px;
            padding: 0px 0px 0px 0px !important;
            float: left;
            width: 81.333%;
        }
        
        .Vegasregular {
            width: 100%;
            margin: 0 auto;
            float: left;
            visibility: visible;
        }
        
        .VegasCloseButton {
            color: #ABA07C;
            opacity: 1;
            font-size: 50px;
            box-shadow: none;
            text-shadow: none;
        }
        
        .VegasCloseButton:hover {
            color: #ABA07C;
            opacity: 1;
            font-size: 50px;
            box-shadow: none;
            text-shadow: none;
        }
        
        .VegasPopLogo {
            width: 20%;
            margin: 0 auto;
            padding-top: 100px;
            text-align: center;
            display: block;
        }
        
        .VegasDetailInner {
            padding: 20px;
            padding-top: 0px;
        }
        
        .grid-item {
            height: auto;
        }
        
        .vogasThumbnail img {
            width: 100%;
        }
        
        .vogasThumbnail {
            padding: 0px;
            background: none;
            border: none;
        }
		
        .newbkbtn
        {
            float: left;
            margin-left: 10px;
            padding: 8px 10px;
            font-size: 15px;
        }
        
        .Sidenavimg {
	width: auto;
	min-width: 200px;
    }
    
</style>

    <div class="row gallery"></div>
    @foreach($propertyDetail['typedata'] as $type)
    @if (array_key_exists($type->id, $propertyDetail['roomimgs']))
    {{--*/ $totimg = count($propertyDetail['roomimgs'][$type->id]['imgs']); $divd2 = round($totimg/2); /*--}}
  
    <div class="row gallery">
        <div class="col-md-6 col-sm-6">
            <div style="height: 370.688px; opacity: 1; width: 100%;" class="principale1 prc">
                @for($rimg1=0; $rimg1 < $divd2; $rimg1++)

                <div style="height: 370.688px; width: 100%;" class="foto1 clio1" rel="clio" data-image="{{\ImageCache::make($propertyDetail['roomimgs'][$type->id]['imgsrc_dir'].$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg1]->file_name,100,1000,null)}}">
                    <a data-popup-id="detail-page-rooms-popup-{{$type->id}}"  class="roomimagdetail_view" href="javascript:void(0);" rel="{{$type->id}}">
                        <img style="height: 370.688px; width: 659px;" src="{{\ImageCache::make($propertyDetail['roomimgs'][$type->id]['imgsrc_dir'].$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg1]->file_name,100,1000,null)}}" rel="1" alt="{{$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg1]->file_name}}" title="View Gallery">
                    </a>
                </div>
                @endfor

                @for($rimg2=$rimg1; $rimg2 < $totimg; $rimg2++)
                <div style="height: 370.688px;" class="foto2 clio2 " rel="clio" data-image="{{\ImageCache::make($propertyDetail['roomimgs'][$type->id]['imgsrc_dir'].$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg2]->file_name,100,1000,null)}}">
                    <a data-popup-id="detail-page-rooms-popup-{{$type->id}}"  class="roomimagdetail_view" href="javascript:void(0);" rel="{{$type->id}}">
                        <img style="height: 370.688px;" src="{{\ImageCache::make($propertyDetail['roomimgs'][$type->id]['imgsrc_dir'].$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg2]->file_name,100,1000,null)}}" rel="2" alt="{{$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg2]->file_name}}" title="View Gallery">
                    </a>
                </div>
                @endfor
            </div>
        </div>
        <div class="col-md-3 col-sm-3">
            <div style="height: 390.688px; opacity: 1; width: 100%;" class="rosa">
                <div class="info1">
                    <h2><span style="top: 0px;">{{$type->category_name}}</span></h2>
                    <p>
                        {{(strlen($type->room_desc) > 100) ? substr($type->room_desc,0,100).'...':$type->room_desc}}
                    </p>
                    <div class="hotel-detail-slider-price-and-show-more">
                        <a href="#" rel="{{$type->id}}" class="book-button open-show_more-page hotel-btn">More</a>
						<a href="#" rel="{{$type->id}}" class="book-button hotel-btn newbkbtn" onclick="choose_room_type('{{$type->id}}');">Book Now</a>
                        <!-- AIC Harman popup-->
                        <!-- Trigger the modal with a button 
                        <a href="#" class="vogasRoomButton" data-toggle="modal" data-target="#myModal">harman test</a>-->

                        @if($type->price!='')
                        <div class="hotel-slider-price">
                            {{($currency->content!='') ? $currency->content : '$'}} {{$type->price}}
                        </div>
                        @endif
                    </div>
                    <div class="clearfix"></div>
                    <div class="viewmore">
                        <div class="arrow-slider">
                            <div class="left">
                                <img style="right: 0px; visibility: inherit; opacity: 1;" type="image/svg+xml" src="{{ asset('sximo/assets/images/freccetta_left.svg')}}" class="freccetta_left" alt="Previous Hotel Room">
                                <img style="right: 0px; visibility: inherit; opacity: 1; transform: matrix(1, 0, 0, 1, 0, 0);" type="image/svg+xml" src="{{ asset('sximo/assets/images/cerchio_left.svg')}}" class="cerchio_left" alt="Previous Hotel Room">
                            </div>
                            <div class="right">
                                <img style="left: 0px; visibility: inherit; opacity: 1;" type="image/svg+xml" src="{{ asset('sximo/assets/images/freccetta_right.svg')}}" class="freccetta_right" alt="Next hotel room">
                                <img style="left: 0px; visibility: inherit; opacity: 1; transform: matrix(1, 0, 0, 1, 0, 0);" type="image/svg+xml" src="{{ asset('sximo/assets/images/cerchio_right_2.svg')}}" class="cerchio_right" alt="Next hotel room">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3 editorial-room-slider-mobile-res">
            <div style="height: 370.688px; width: 100%;" class="nero"></div>
            <div style="height: 370.688px; opacity: 1; width: 100%;" class="secondaria1 sec next">
                @for($rimg1=0; $rimg1 < $divd2; $rimg1++)

                <div style="height: 370.688px;" class="foto2 clio3" rel="clio" data-image="{{\ImageCache::make($propertyDetail['roomimgs'][$type->id]['imgsrc_dir'].$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg1]->file_name,100,1000,null)}}">
                    <a data-popup-id="detail-page-rooms-popup-{{$type->id}}"  class="roomimagdetail_view" href="javascript:void(0);" rel="{{$type->id}}">
                        <img style="height: 370.688px; width: 659px;" src="{{\ImageCache::make($propertyDetail['roomimgs'][$type->id]['imgsrc_dir'].$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg1]->file_name,100,1000,null)}}" rel="3" alt="{{$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg1]->file_name}}" title="View Gallery">
                    </a>
                </div>
                @endfor
                @for($rimg2=$rimg1; $rimg2 < $totimg; $rimg2++)
                <div style="height: 370.688px; width: 100%;" class="foto1 clio4" rel="clio" data-image="{{\ImageCache::make($propertyDetail['roomimgs'][$type->id]['imgsrc_dir'].$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg2]->file_name,100,1000,null)}}">
                    <a data-popup-id="detail-page-rooms-popup-{{$type->id}}"  class="roomimagdetail_view" href="javascript:void(0);" rel="{{$type->id}}">
                        <img style="height: 370.688px;" src="{{\ImageCache::make($propertyDetail['roomimgs'][$type->id]['imgsrc_dir'].$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg2]->file_name,100,1000,null)}}" rel="4" alt="{{$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg1]->file_name}}" title="View Gallery">
                    </a>
                </div>
                @endfor
            </div>
        </div>
    </div>
    @endif
    @endforeach
    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endif

<!--AIC harman: popup gallery Modal -->
    <div class="modal fade vegasModelFade" id="myModal" role="dialog">
      <div class="modal-dialog VegasModelDialog">

        <!-- Modal content-->
        <div class="modal-content vegasModelContent">
          <div class="modal-header vegasModelHeader">
            <button type="button" class="close VegasCloseButton" data-dismiss="modal">&times;</button>
            <a href="#" id="frontpage-layer-bj-header-logo"> <img class="VegasPopLogo" alt="" src="data:image/png;base64,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" class="img-responsive" data-pagespeed-url-hash="2747997174" onload=""></a>
            </div>
          <div class="modal-body">
              <div class="col-md-2 SlickVegasWidth">
                <section class="Vegasregular slider">
                    <div class="slick-cstm-width">
					   @if(!empty($relatedproperties))
						<div class="side-nav-next-hotel-img Sidenavimg">
							<div class="side-next-and-perivious-hotel-arrow">
								<div class="arrows-commom  next-arrow">
									<a href="{{URL::to($relatedproperties[0]->property_slug)}}">
										<span>New Hotels</span>
									</a>
								</div>
							</div>
							{{--*/ $relatimg = URL::to('uploads/property_imgs_thumbs/front_property_'.$relatedproperties[0]->folder_id.'_'.$relatedproperties[0]->file_name); /*--}}
							<div class="new-hotel-image" style="background-image:url(http://www.emporium-voyage.com/uploads/property_imgs_thumbs/xfront_property_4505_Emporium-Voyage-Hotel-Zoo-Berlin00017.jpg.pagespeed.ic.nY-effTxow.jpg)">
                                                            <div class="new-hotels-image-tittle">
                                                                    <h2 class="new-hotel-name">Hotel Zoo Berlin </h2>
                                                                    <div class=" new-hotel-add">
                                                                            <p>New York City</p>
                                                                            <p>United States</p>
                                                                    </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <div class="new-hotel-view-more-btn">
                                                                    <a class="" href="http://www.emporium-voyage.com/hotel-zoo-berlin-" tabindex="0">
                                                                            View Hotel
                                                                    </a>
                                                            </div>
                                                    </div>
							
							<a class="bootom-view-next-btn" href="{{URL::to($relatedproperties[0]->property_slug)}}">
								Visit All Hotels DOI
							</a>
						</div>
						@endif
					</div>
					@if(!empty($sidebardetailAds))
					@foreach($sidebardetailAds as $adsdetail)
					<div class="slick-cstm-width">
						<a href="http://{{$adsdetail->adv_link}}"><img src="{{URL::to('uploads/users/advertisement/'.$adsdetail->adv_img)}}"></a>
					</div>
					@endforeach
					@endif					
                </section>

            </div>
              <div id="frontpage-layer-bj-content" class="col-md-10 vegasGallery1">
                    <div class="frontpage-detail-content-top">
                        <div class="frontpage-detail-content-top-link">
                            <div class="frontpage-detail-content-top-link"> 
                            </div>
                        </div>
                    </div>
                <div class="row masonry-grid vegasgalleryimg">
                    
                  </div>
                </div>
            </div><!--
          <div class="modal-footer vegasModelFooter">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>-->
        </div>

      </div>
    </div>
<!-- model popup end -->
        
        <!-- slick crousel -->
<script>
    $('.Vegasregular').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: false,
    prevArrow: false,
    nextArrow: false,
    infinite: true,
    autoplay: true,
});
</script>

<!-- asonary layout -->
<script>
// external js: masonry.pkgd.js

/*$('.grid').masonry({
  itemSelector: '.grid-item',
  columnWidth: 160
});*/
</script>


<script type="text/javascript">

	$(document).on('click', '.roomimagdetail_view', function () {
		$.ajax({
			url: "{{ URL::to('getpropertyroomimages')}}" + '/' + $(this).attr('rel'),
			type: "get",
			success: function (data) {
				var imagesPro = '';
				var im=0;
				var di=1;
				var lngimg = Math.round((data.image.length)/3);
				imagesPro += '<div class="col-md-6 col-lg-4 masonry-column">';
				$(data.image).each(function (i, val) {
					var clsact = '';
					imagesPro += '  <div>';
					imagesPro += '	<a href="#" class="thumbnail vogasThumbnail"><img class="img-responsive" src="' + val.imgsrc_cache + '"></a>';
					imagesPro += '  </div>';
					if(di==lngimg)
					{
						di=0;
						imagesPro += ' </div>';
						imagesPro += '<div class="col-md-6 col-lg-4 masonry-column">';
					}
					im++;
					di++;
				});
				imagesPro += ' </div>';
				$('#myModal .vegasgalleryimg').html(imagesPro);
				$('#myModal').modal('show');
			}
		});
		return false;
	});
	//$(document).on('click', '.video-popup-btn', function () {
		
    $(".video-popup-btn").on("click", function (event) {
        event.preventDefault();
        var popup_id = $(this).data("popup-id");
        $("#" + popup_id).fadeIn("slow");
        $("body").addClass("fixed");
    });
	
    $(".popup-close-btn").click(function (event) {
        event.preventDefault();
        $(this).parent().parent().fadeOut("slow");
        $("body").removeClass("fixed");
    });

    $("#video-popup .previous-round-btn").click(function (event) {
        event.preventDefault();

        var index = $(".featured-vieos > li.active").data("index");
        if (index == 0) {
            index = +$(".featured-vieos > li:last-child").data("index") + 1;
        }

        $(".featured-vieos > li.active").removeClass("active");
        $(".featured-vieos > li:nth-child(" + index + ")").addClass("active");

        $(this).parent().find(".videos-count").html(index + " / " + $(this).parent().find(".featured-vieos > li").length);

    });

    $("#video-popup .next-round-btn").click(function (event) {
        event.preventDefault();

        var index = $(".featured-vieos > li.active").data("index");
        if (index == $(".featured-vieos > li:last-child").data("index")) {
            index = -1;
        }

        $(".featured-vieos > li.active").removeClass("active");
        $(".featured-vieos > li:nth-child(" + (+index + 2) + ")").addClass("active");

        $(this).parent().find(".videos-count").html((+index + 2) + " / " + $(this).parent().find(".featured-vieos > li").length);

    });

    $(".room-res-previous-btn").click(function ( event ) {
        event.preventDefault();
        
        var index = $(this).parent().parent().find(".image-slider li.active").index();
		$(this).parent().parent().find(".image-slider li.active").removeClass("active");
        if (index == 0) {
			var lindex = $(this).parent().parent().find(".image-slider li:last-child").index() +1;
            $(this).parent().parent().find(".image-slider li:nth-child("+lindex+")").addClass("active");
			$(this).parent().parent().find(".images-count").html( lindex + " / " + $(this).parent().parent().find(".image-slider li").length);
        }
		else
		{
			var rlindex = index - 1;
			
			$(this).parent().parent().find(".image-slider li:eq("+rlindex+")").addClass("active");
			$(this).parent().parent().find(".images-count").html( index + " / " + $(this).parent().parent().find(".image-slider li").length);
		}
		
        
    });
    
    $(".room-res-next-btn").click(function ( event ) {
        event.preventDefault();

        var index = $(this).parent().parent().find(".image-slider li.active").index();
        if (index == $(this).parent().parent().find(".image-slider li:last-child").index()) {
            index = -1;
        }

        $(this).parent().parent().find(".image-slider li.active").removeClass("active");
        $(this).parent().parent().find(".image-slider li:nth-child(" + (+index + 2) + ")").addClass("active");
        
        $(this).parent().parent().find(".images-count").html( (+index + 2) + " / " + $(this).parent().parent().find(".image-slider li").length);
        
    });
    
    setInterval(function () {
        var index = $(".auto-slider ul.image-slider > li.active").index();
        if (index == $(".auto-slider ul.image-slider > li:last-child").index()) {
            index = -1;
        }

        $(".auto-slider ul.image-slider > li.active").removeClass("active");
        $(".auto-slider ul.image-slider > li:nth-child(" + (+index + 2) + ")").addClass("active");
        
        $(".auto-slider .images-count").html( (+index + 2) + " / " + $(".auto-slider ul.image-slider > li").length);
        
    }, 40000);

</script>
