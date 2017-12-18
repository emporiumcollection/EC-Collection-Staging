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
        background-color: none;
        overflow-x: hidden;
        overflow-y: hidden;
        }
        
        .vegasModelContent {
            background: rgba(0, 0, 0, 0.92) none repeat scroll 0 0;
            opacity: 1;
            border-radius: 0px;
        }
        
        .vegasModelHeader {
            border-bottom: none;
        }
        
        .vegasModelFooter {
            border-top: none;
        }
        
        .SlickVegasWidth {
            
            width: 17.667%;
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
                    <a data-popup-id="detail-page-rooms-popup-{{$type->id}}"  class="video-popup-btn" href="javascript:void(0);">
                        <img style="height: 370.688px; width: 659px;" src="{{\ImageCache::make($propertyDetail['roomimgs'][$type->id]['imgsrc_dir'].$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg1]->file_name,100,1000,null)}}" rel="1" alt="{{$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg1]->file_name}}">
                    </a>
                </div>
                @endfor

                @for($rimg2=$rimg1; $rimg2 < $totimg; $rimg2++)
                <div style="height: 370.688px;" class="foto2 clio2 " rel="clio" data-image="{{\ImageCache::make($propertyDetail['roomimgs'][$type->id]['imgsrc_dir'].$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg2]->file_name,100,1000,null)}}">
                    <a data-popup-id="detail-page-rooms-popup-{{$type->id}}"  class="video-popup-btn" href="javascript:void(0);">
                        <img style="height: 370.688px;" src="{{\ImageCache::make($propertyDetail['roomimgs'][$type->id]['imgsrc_dir'].$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg2]->file_name,100,1000,null)}}" rel="2" alt="{{$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg2]->file_name}}">
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
                        <a href="#" rel="{{$type->id}}" class="book-button open-show_more-page hotel-btn">Show More</a>
                        <!-- AIC Harman popup-->
                        <!-- Trigger the modal with a button -->
                        <a href="#" class="vogasRoomButton" data-toggle="modal" data-target="#myModal">harman test</a>

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
                                <img style="right: 0px; visibility: inherit; opacity: 1;" type="image/svg+xml" src="{{ asset('sximo/assets/images/freccetta_left.svg')}}" class="freccetta_left" alt="Annie Collection">
                                <img style="right: 0px; visibility: inherit; opacity: 1; transform: matrix(1, 0, 0, 1, 0, 0);" type="image/svg+xml" src="{{ asset('sximo/assets/images/cerchio_left.svg')}}" class="cerchio_left" alt="Annie Collection">
                            </div>
                            <div class="right">
                                <img style="left: 0px; visibility: inherit; opacity: 1;" type="image/svg+xml" src="{{ asset('sximo/assets/images/freccetta_right.svg')}}" class="freccetta_right" alt="Annie Collection">
                                <img style="left: 0px; visibility: inherit; opacity: 1; transform: matrix(1, 0, 0, 1, 0, 0);" type="image/svg+xml" src="{{ asset('sximo/assets/images/cerchio_right.svg')}}" class="cerchio_right" alt="Annie Collection">
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
                    <a data-popup-id="detail-page-rooms-popup-{{$type->id}}"  class="video-popup-btn" href="javascript:void(0);">
                        <img style="height: 370.688px; width: 659px;" src="{{\ImageCache::make($propertyDetail['roomimgs'][$type->id]['imgsrc_dir'].$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg1]->file_name,100,1000,null)}}" rel="3" alt="{{$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg1]->file_name}}">
                    </a>
                </div>
                @endfor
                @for($rimg2=$rimg1; $rimg2 < $totimg; $rimg2++)
                <div style="height: 370.688px; width: 100%;" class="foto1 clio4" rel="clio" data-image="{{\ImageCache::make($propertyDetail['roomimgs'][$type->id]['imgsrc_dir'].$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg2]->file_name,100,1000,null)}}">
                    <a data-popup-id="detail-page-rooms-popup-{{$type->id}}"  class="video-popup-btn" href="javascript:void(0);">
                        <img style="height: 370.688px;" src="{{\ImageCache::make($propertyDetail['roomimgs'][$type->id]['imgsrc_dir'].$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg2]->file_name,100,1000,null)}}" rel="4" alt="{{$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg1]->file_name}}">
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
@if (array_key_exists('typedata', $propertyDetail))
<?php
foreach ($propertyDetail['typedata'] as $type) {
    ?>
    <div id="detail-page-rooms-popup-{{$type->id}}" class="popup detail-page-room-pop-up-align">
        <div class="popup-inner">
            <a href="#" class="popup-close-btn">CLOSE</a>
            <div class="popup-content res-gallery-sec-padding">
                <div class="image-slider-container">

                    <div class="clearfix"></div>
                    <ul class="image-slider post-page-sideshow">
                        <?php
                        $index = 0;
                        if (!empty($propertyDetail['roomimgs'][$type->id]['imgs'])) {
                            foreach ($propertyDetail['roomimgs'][$type->id]['imgs'] as $image) {
				$imagePath = \ImageCache::make($propertyDetail['roomimgs'][$type->id]['imgsrc_dir'] . $image->file_name,100,800,null);
                                echo '<li class="', ($index == 0) ? 'active' : '', ' "><img class="img-responsive" src="' . $imagePath . '" alt=""/></li>';
                                $index++;
                            }
                        }
                        ?>

                    </ul>
                    <div class="images-count">1 / {{$index}}</div>
                    <div class="image-slider-btns">
                        <a class="image-slider-previous-btn room-res-previous-btn" href="#">
                            <img src="{{asset('sximo/assets/images/left-round-arrow.png')}}" alt=""/>
                        </a>
                        <a class="image-slider-next-btn room-res-next-btn" href="#">
                            <img src="{{asset('sximo/assets/images/right-round-arrow.png')}}" alt=""/>
                        </a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

<!--AIC harman: popup gallery Modal -->
    <div class="modal fade vegasModelFade" id="myModal" role="dialog">
      <div class="modal-dialog VegasModelDialog">

        <!-- Modal content-->
        <div class="modal-content vegasModelContent">
          <div class="modal-header vegasModelHeader">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            
            </div>
          <div class="modal-body">
              <div class="col-md-2 SlickVegasWidth">
                <section class="regular slider">
                    <div class="slick-cstm-width">
                            <div class="side-nav-next-hotel-img">
                                    <div class="side-next-and-perivious-hotel-arrow">
                                            <div class="arrows-commom  next-arrow">
                                                    <a href="http://www.emporium-voyage.com/hotel-zoo-berlin-" tabindex="0">
                                                        <span>New Hotels</span>
                                                    </a>
                                            </div>
                                    </div>
                                    <div class="new-hotel-image" style="background-image:url(http://www.emporium-voyage.com/uploads/property_imgs_thumbs/xfront_property_4505_Emporium-Voyage-Hotel-Zoo-Berlin00017.jpg.pagespeed.ic.nY-effTxow.jpg)">
                                            <div class="new-hotels-image-tittle">
                                                    <h2 class="new-hotel-name">Hotel Zoo Berlin</h2>
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
                                    <a class="bootom-view-next-btn" href="http://www.emporium-voyage.com/hotel-zoo-berlin-" tabindex="0">
                                        Visit All Hotels DOI
                                    </a>
                            </div>
                    </div>
                    @if(!empty($sidebardetailAds))
                    @foreach($sidebardetailAds as $adsdetail)
                    <div class="slick-cstm-width slick-slide slick-current slick-active" data-slick-index="1" aria-hidden="false" style="width: 206px;" tabindex="-1" role="option">
                        <a href="http://http://www.bessd.com" tabindex="0"><img src="http://www.emporium-voyage.com/uploads/users/advertisement/x1.png.pagespeed.ic.wgBqk8EoPv.jpg" data-pagespeed-url-hash="3725838879" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a>
                    </div>
                    @endforeach
                    @endif					
                </section>

             </div>
              <div id="frontpage-layer-bj-content">
        <div class="frontpage-detail-content-top">
            <div class="frontpage-detail-content-top-link">
                <div class="frontpage-detail-content-top-link">
                    
                </div>
            </div>
        </div>
		<ul class="clearfix frontpage-detail-tiles" id="frontpage-detail-tiles-detail"></p></div><div id="formerrors" class="formerrors"></div><form url="#" id="enquiryform" class="form-horizontal" method="post"><input name="property_id" value="29" type="hidden"><input name="property_name" value="Asara" type="hidden"><div class="col-md-12"><fieldset></div></div></div><div class="col-md-12"><input name="start_date" value="" class="datepic hasDatepicker" required="required" placeholder="Start Date" id="dp1513578671648" type="text"></div><div class="col-md-1"><span class="asterix"> * </span></div></div><div class="col-md-12"><input name="end_date" value="" class="datepic hasDatepicker" required="required" placeholder="End Start" id="dp1513578671649" type="text"></div><div class="col-md-1"><span class="asterix"> * </span></div></div><div class="col-md-12"><select name="use_type" required="required"><option value="">Type of use</option><option value="Advertising - Film">Advertising - Film</option><option value="Advertising - Photo">Advertising - Photo</option><option value="Editorial">Editorial</option><option value="Promotional use">Promotional use</option><option value="Advertorial">Advertorial</option><option value="Customer Magazine">Customer Magazine</option><option value="Test">Test</option><option value="Other">Other</option></select></div><div class="col-md-1"><span class="asterix"> * </span></div><div class="col-md-12"><input required="required" name="email" value="" placeholder="Your email address" type="email"></div><div class="col-md-1"><span class="asterix"> * </span></div><div class="col-md-12"><input required="required" name="phone" value="" placeholder="Your phone number" type="text"></div><div class="col-md-1"><span class="asterix"> * </span></div></div><div class="row MarBot10"><div class="col-md-12"><textarea name="notes" rows="5" cols="20" placeholder="Notes, Deadlines, Extras..." class="ai-textarea-width"></textarea></div></div> </div></fieldset></div></form></div></li><li class="detail-tile col-sm-6 col-xs-12 col-md-6 col-lg-4" style="visibility:visible"><div class="detail-tile-inner"><img src="http://southafricaphotolocations.com/uploads/container_user_files/locations/asara/property-images/Asara (8).jpg"></div></li><li class="detail-tile col-sm-6 col-xs-12 col-md-6 col-lg-4" style="visibility:visible"><div class="detail-tile-inner"><img src="http://southafricaphotolocations.com/uploads/container_user_files/locations/asara/property-images/Asara (10).jpg"></div></li><li class="detail-tile col-sm-6 col-xs-12 col-md-6 col-lg-4" style="visibility:visible"><div class="detail-tile-inner"><img src="http://southafricaphotolocations.com/uploads/container_user_files/locations/asara/property-images/Asara (17).jpg"></div></li><li class="detail-tile col-sm-6 col-xs-12 col-md-6 col-lg-4" style="visibility:visible"><div class="detail-tile-inner"><img src="http://southafricaphotolocations.com/uploads/container_user_files/locations/asara/property-images/Asara (16).jpg"></div></li><li class="detail-tile col-sm-6 col-xs-12 col-md-6 col-lg-4" style="visibility:visible"><div class="detail-tile-inner"><img src="http://southafricaphotolocations.com/uploads/container_user_files/locations/asara/property-images/Asara (15).jpg"></div></li><li class="detail-tile col-sm-6 col-xs-12 col-md-6 col-lg-4" style="visibility:visible"><div class="detail-tile-inner"><img src="http://southafricaphotolocations.com/uploads/container_user_files/locations/asara/property-images/Asara (14).jpg"></div></li><li class="detail-tile col-sm-6 col-xs-12 col-md-6 col-lg-4" style="visibility:visible"><div class="detail-tile-inner"><img src="http://southafricaphotolocations.com/uploads/container_user_files/locations/asara/property-images/Asara (19).jpg"></div></li><li class="detail-tile col-sm-6 col-xs-12 col-md-6 col-lg-4" style="visibility:visible"><div class="detail-tile-inner"><img src="http://southafricaphotolocations.com/uploads/container_user_files/locations/asara/property-images/Asara (18).jpg"></div></li><li class="detail-tile col-sm-6 col-xs-12 col-md-6 col-lg-4" style="visibility:visible"><div class="detail-tile-inner"><img src="http://southafricaphotolocations.com/uploads/container_user_files/locations/asara/property-images/Asara (23).jpg"></div></li><li class="detail-tile col-sm-6 col-xs-12 col-md-6 col-lg-4" style="visibility:visible"><div class="detail-tile-inner"><img src="http://southafricaphotolocations.com/uploads/container_user_files/locations/asara/property-images/Asara (21).jpg"></div></li><li class="detail-tile col-sm-6 col-xs-12 col-md-6 col-lg-4" style="visibility:visible"><div class="detail-tile-inner"><img src="http://southafricaphotolocations.com/uploads/container_user_files/locations/asara/property-images/Asara (22).jpg"></div></li><li class="detail-tile col-sm-6 col-xs-12 col-md-6 col-lg-4" style="visibility:visible"><div class="detail-tile-inner"><img src="http://southafricaphotolocations.com/uploads/container_user_files/locations/asara/property-images/Asara (20).jpg"></div></li><li class="detail-tile col-sm-6 col-xs-12 col-md-6 col-lg-4" style="visibility:visible"><div class="detail-tile-inner"><img src="http://southafricaphotolocations.com/uploads/container_user_files/locations/asara/property-images/Asara (11).jpg"></div></li><li class="detail-tile col-sm-6 col-xs-12 col-md-6 col-lg-4" style="visibility:visible"><div class="detail-tile-inner"><img src="http://southafricaphotolocations.com/uploads/container_user_files/locations/asara/property-images/Asara (13).jpg"></div></li><li class="detail-tile col-sm-6 col-xs-12 col-md-6 col-lg-4" style="visibility:visible"><div class="detail-tile-inner"><img src="http://southafricaphotolocations.com/uploads/container_user_files/locations/asara/property-images/Asara (5).jpg"></div></li><li class="detail-tile col-sm-6 col-xs-12 col-md-6 col-lg-4" style="visibility:visible"><div class="detail-tile-inner"><img src="http://southafricaphotolocations.com/uploads/container_user_files/locations/asara/property-images/Asara (6).jpg"></div></li><li class="detail-tile col-sm-6 col-xs-12 col-md-6 col-lg-4" style="visibility:visible"><div class="detail-tile-inner"><img src="http://southafricaphotolocations.com/uploads/container_user_files/locations/asara/property-images/Asara (2).jpg"></div></li><li class="detail-tile col-sm-6 col-xs-12 col-md-6 col-lg-4" style="visibility:visible"><div class="detail-tile-inner"><img src="http://southafricaphotolocations.com/uploads/container_user_files/locations/asara/property-images/Asara (4).jpg"></div></li><li class="detail-tile col-sm-6 col-xs-12 col-md-6 col-lg-4" style="visibility:visible"><div class="detail-tile-inner"><img src="http://southafricaphotolocations.com/uploads/container_user_files/locations/asara/property-images/Asara (3).jpg"></div></li><li class="detail-tile col-sm-6 col-xs-12 col-md-6 col-lg-4" style="visibility:visible"><div class="detail-tile-inner"><img src="http://southafricaphotolocations.com/uploads/container_user_files/locations/asara/property-images/Asara (7).jpg"></div></li><li class="detail-tile col-sm-6 col-xs-12 col-md-6 col-lg-4" style="visibility:visible"><div class="detail-tile-inner"><img src="http://southafricaphotolocations.com/uploads/container_user_files/locations/asara/property-images/Asara (12).jpg"></div></li><li class="detail-tile col-sm-6 col-xs-12 col-md-6 col-lg-4" style="visibility:visible"><div class="detail-tile-inner"><img src="http://southafricaphotolocations.com/uploads/container_user_files/locations/asara/property-images/Asara (9).jpg"></div></li><li class="detail-tile col-sm-6 col-xs-12 col-md-6 col-lg-4" style="visibility:visible"><div class="detail-tile-inner"><img src="http://southafricaphotolocations.com/uploads/container_user_files/locations/asara/property-images/Asara (1).jpg"></div></li></ul>
		
    </div>
            </div><!--
          <div class="modal-footer vegasModelFooter">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>-->
        </div>

      </div>
    </div>
<!-- model popup end -->

    <?php
}
?>
@endif
<script>
jQuery(document).ready(function ($) {
        $(".regular").slick({
                dots: false,
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                prevArrow: false,
                nextArrow: false,
                autoplay: true,
                autoplaySpeed: 3000
        });
});
</script>
<script type="text/javascript">
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
