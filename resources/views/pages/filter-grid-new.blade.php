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
    .carticon { float:right; margin-left:5px; }
</style>
<!--Main Page Start here-->
@if($currentPage==0)
<div class="grid-page-category-slider-container">
@if(!empty($categoryslider))
<div class="bh-slideshow-thumbnail-split" data-uk-slideshow="{animation: 'slice-up', autoplay: true}">
    <ul style="height: 650px;" class="uk-slideshow uk-overlay-active">
        @foreach($categoryslider as $slides)
        <li style="height: 650px;" @if($categoryslider[0]==$slides) class="uk-active" @endif aria-hidden="true"><div style="background-image: url({{ URL::to('uploads/slider_images/'.$slides->slider_img)}});" class="uk-cover-background uk-position-cover"></div>
            <canvas style="width: 100%; height: 100%; opacity: 0;"></canvas>
            <div class="bh-slideshow-overlay uk-overlay-panel uk-overlay-fade uk-flex uk-flex-middle uk-flex-center">
                <div>
                    <ul class="bh-slideshow-overlay-meta uk-subnav uk-subnav-line">
                        <li>
                            <span>{{ date('M j, Y', strtotime($slides->created) )}}</span>
                        </li>
                        <li>
                            <span><a href="#" rel="category tag">{{$slides->slider_category}}</a></span>
                        </li>
                    </ul>
                    <h3 class="bh-slideshow-overlay-title">
                        <a href="#">{{$slides->slider_title}}</a>
                    </h3>
                    <div class="bh-slideshow-overlay-content">{{$slides->slider_description}}</div>
                    <a class="uk-margin-top uk-button uk-button-primary" href="#" title="Do it yourself">Read more <i class="zmdi zmdi-long-arrow-right uk-margin-small-left"></i></a>
                </div>
            </div>
            <div class="bh-slideshow-thumbnail-split-preview uk-overlay-panel uk-overlay-right uk-overlay-background uk-overlay-fade uk-width-2-5 uk-width-xxlarge-1-3 uk-flex uk-flex-middle uk-flex-center uk-visible-large">
                <div>
                    <ul class="bh-slideshow-thumbnail-split-preview-meta uk-subnav uk-subnav-line">
                        <li>
                            <span>{{ date('M j, Y', strtotime($slides->created) )}}</span>
                        </li>
                        <li>
                            <span><a href="#" rel="category tag">{{$slides->slider_category}}</a></span>
                        </li>
                    </ul>
                    <h3 class="bh-slideshow-thumbnail-split-preview-title">
                        <a href="#">{{$slides->slider_title}}</a>
                    </h3>
                    <div class="bh-slideshow-thumbnail-split-preview-content">{{$slides->slider_description}}</div>
                    <a class="uk-margin-top uk-button uk-button-primary" href="#">Read more <i class="zmdi zmdi-long-arrow-right uk-margin-small-left"></i></a>
                </div>
                <a href="" class="bh-slideshow-slidenav uk-slidenav uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
                <a href="" class="bh-slideshow-slidenav uk-slidenav uk-slidenav-next" data-uk-slideshow-item="next"></a>
            </div>
        </li>
        @endforeach
    </ul>
</div>
@endif
</div>
@endif


        <div class="col-md-12 col-sm-12 col-xs-12 yachts-main-bg">
            <div class="row">
                <div class="locator clear"></div>
            </div>
            <div id="cityfilters"></div>

            <div id="listproperties">
                <div class="row">
                    @if($propertiesArr)
                    {{--*/ $rw = 1 /*--}}
                    @foreach($propertiesArr as $props)
                    <div class="productData col-xs-12 col-sm-6 col-md-3 col-lg-3 margin-bottom-10">
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
                                <div class="listDetails dfs">
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
        </div>
<div class="clearfix"></div>
<script>
    $(document).ready(function () {
        $(document).on('click', '.top-bar-filters li.select-all', function () {
            if ($(this).hasClass("active")) {
                $('.top-bar-filters li').addClass("active");
                $(this).removeClass("active");
            } else {
                $('.top-bar-filters li').removeClass("active");
                $(this).addClass("active");
            }
        });
        $(document).on('click', '.top-bar-filters li', function () {
            if (!$(this).hasClass("select-all")) {
                $(this).toggleClass("active");
                $('.top-bar-filters li.select-all').removeClass("active");
            }
        });
        $(document).on('click', '.clear-all-filters a', function (event) {
            event.preventDefault();
            $('.top-bar-filters li').removeClass("active");
            $('.top-bar-filters li.select-all').addClass("active");
        });

        var scrollTimer, lastScrollFireTime = 0;

        $(window).scroll(function () {
            var minScrollTime = 4000;
            var now = new Date().getTime();
            if (!scrollTimer) {
                var element_position = $('#brgrid').offset().top + $('#brgrid').outerHeight() - window.innerHeight;
                var y_scroll_pos = $(window).scrollTop() + 100;
                if ((y_scroll_pos >= element_position)) {
                    var it_scroll = true;
                    scrollDownloadData(it_scroll);
                }
                scrollTimer = setTimeout(function () {
                    scrollTimer = null;
                    lastScrollFireTime = new Date().getTime();
                    var it_scroll = true;
                    scrollDownloadData(it_scroll);
                }, minScrollTime);
            }
        });
    });



    function scrollDownloadData(it_scroll)
    {
        var offSet = 20, isPreviousEventComplete = true, isDataAvailable = true;
        var sIndex = $('#listrecrds').val();
        var queryStrng = '';
        var destnarea = $('#selDestn').val();
        if (destnarea != '')
        {
            var dest_area = destnarea.split("#:");
            queryStrng = '&dest=' + dest_area[0] + '&area=' + dest_area[1];
        }

        if (isPreviousEventComplete && isDataAvailable) {
            isPreviousEventComplete = false;
            //$(".LoaderImage").css("display", "block");

            $.ajax({
                url: "{{ URL::to('filter_category_destionation')}}",
                type: "post",
                data: 'cat={{$pagecate}}&startIndex=' + sIndex + '&offset=' + offSet + queryStrng,
                dataType: "json",
                success: function (data) {
                    var html = chtml = '';
                    if (data.status == 'error')
                    {
                        if (it_scroll == false)
                        {
                            $('#listproperties').html(data.errors);
                        } else
                        {
                            ('#listproperties').append(data.errors);
                        }
                        isDataAvailable = false;
                    } else
                    {
                        
                        /*
                         * Slider HTML
                         */

                       var sliderHTML = '';

                       if(data.categoryslider) {
                           if(data.categoryslider.length > 0) {
                               sliderHTML += '<div class="bh-slideshow-thumbnail-split" data-uk-slideshow="{animation: \'slice-up\', autoplay: true}" style="margin-bottom:20px;margin-top:00px;">';
                               sliderHTML += '<ul style="" class="uk-slideshow uk-overlay-active">';
                               var activeClass = 'uk-active';
                               for(var si = 0; si < data.categoryslider.length; si++) {
                                   if(si != 0) {
                                       activeClass = '';
                                   }
                                   sliderHTML += '<li class="ai-uk-animation ' + activeClass + ' " aria-hidden="true">';
                                       if(data.categoryslider[si].slide_type == 'Image') {
                                           sliderHTML += '<div style="background-image: url({{ URL()}}/uploads/slider_images/' + data.categoryslider[si].slider_img + ');" class="uk-cover-background uk-position-cover"></div>';
                                       }
                                       else {
                                           sliderHTML += '<div  class="uk-cover-background uk-position-cover"> <iframe class="video-bg"  src="https://www.youtube.com/embed/' + data.categoryslider[si].slider_video + '?playlist=' + data.categoryslider[si].slider_video + '&iv_load_policy=3&enablejsapi=1&disablekb=1&autoplay=1&controls=0&showinfo=0&rel=0&loop=1&wmode=transparent" frameborder="0" allowfullscreen="allowfullscreen"></iframe></div>';
                                       }
                                       sliderHTML += '<canvas style="width: 100%; height: 100%; opacity: 0;"></canvas>';
                                       sliderHTML += '<div class="bh-slideshow-overlay uk-overlay-panel uk-overlay-fade uk-flex uk-flex-middle uk-flex-center">';
                                           sliderHTML += '<div>';
                                               sliderHTML += '<ul class="bh-slideshow-overlay-meta uk-subnav uk-subnav-line">';
                                                   sliderHTML += '<li>';
                                                       sliderHTML += '<span><a href="#" rel="category tag">' + data.categoryslider[si].slider_category + '</a></span>';
                                                   sliderHTML += '</li>';
                                               sliderHTML += '</ul>';
                                               sliderHTML += '<h3 class="bh-slideshow-overlay-title">';
                                                   sliderHTML += '<a href="#">' + data.categoryslider[si].slider_title + '</a>';
                                               sliderHTML += '</h3>';
                                               sliderHTML += '<div class="bh-slideshow-overlay-content">' + data.categoryslider[si].slider_description + '</div>';
                                               if(data.categoryslider[si].slider_link != '#') {
                                                   sliderHTML += '<a class="uk-margin-top uk-button uk-button-primary" href="http://' + data.categoryslider[si].slider_link + '" title="Do it yourself">Discover <i class="zmdi zmdi-long-arrow-right uk-margin-small-left"></i></a>';
                                               }
                                           sliderHTML += '</div>';
                                       sliderHTML += '</div>';
                                       sliderHTML += '<div class="bh-slideshow-thumbnail-split-preview uk-overlay-panel uk-overlay-right uk-overlay-background uk-overlay-fade uk-width-2-5 uk-width-xxlarge-1-3 uk-flex uk-flex-middle uk-flex-center uk-visible-large">';
                                           sliderHTML += '<div>';
                                               sliderHTML += '<ul class="bh-slideshow-thumbnail-split-preview-meta uk-subnav uk-subnav-line">';
                                                   sliderHTML += '<li>';
                                                       sliderHTML += '<span><a href="#" rel="category tag">' + data.categoryslider[si].slider_category + '</a></span>';
                                                   sliderHTML += '</li>';
                                               sliderHTML += '</ul>';
                                               sliderHTML += '<h3 class="bh-slideshow-thumbnail-split-preview-title">';
                                                   sliderHTML += '<a href="#">' + data.categoryslider[si].slider_title + '</a>';
                                               sliderHTML += '</h3>';
                                               sliderHTML += '<div class="bh-slideshow-thumbnail-split-preview-content">' + data.categoryslider[si].slider_description + '</div>';
                                               if(data.categoryslider[si].slider_link != '#') {
                                                   sliderHTML += '<a class="uk-margin-top uk-button uk-button-primary" href="http://' + data.categoryslider[si].slider_link + '">Discover <i class="zmdi zmdi-long-arrow-right uk-margin-small-left"></i></a>';
                                               }
                                           sliderHTML += '</div>';
                                           sliderHTML += '<a href="javascript:void(0);" class="bh-slideshow-slidenav uk-slidenav uk-slidenav-previous" data-uk-slideshow-item="previous"></a>';
                                           sliderHTML += '<a href="javascript:void(0);" class="bh-slideshow-slidenav uk-slidenav uk-slidenav-next" data-uk-slideshow-item="next"></a>';
                                       sliderHTML += '</div>';
                                   sliderHTML += '</li>';
                               }
                               sliderHTML += '</ul>';
                               sliderHTML += '</div>';
                               sliderHTML += '<script type="text/javascript" src="<?php echo asset('sximo/assets/js/slideshow.js'); ?>"><\/script>';
                           }
                       }
                        $(".grid-page-category-slider-container").html( sliderHTML );
                        html += '<div class="row">';
                        var p = 1;
                        $.each($.parseJSON(data.properties), function (idx, obj) {
                            html += '<div class="productData col-xs-12 col-sm-6 col-md-3 col-lg-3 margin-bottom-10">';
                            html += '<div class="wrapperforliineedforlightboxremoval">';
                            html += '<div class="cat_product_medium1">';
                            html += '<div class="pictureBox gridPicture">';
                            if (obj.hasOwnProperty("image")) {
                                html += '<a title="' + obj.image.file_name + '" class="picture_link detail_view" rel="' + obj.pdata.id + '" href="#">';
                                var pimg = "{{URL::to('uploads/property_imgs_thumbs/')}}/front_property_" + obj.image.folder_id + "_" + obj.image.file_name;
                                html += '<img alt="' + obj.image.file_name + '" src="' + pimg + '" class="img-responsive">';
                                html += '</a>';
                            } else {
                                var pimg = "{{URL::to('sximo/assets/images/img-1.jpg')}}";
                                html += '<img class="img-responsive" src="' + pimg + '" alt="">';
                            }

                            html += '</div>';
                            html += '<div class="listDetails">';
                            html += '<div class="photographBox">';
                            html += '<h2>';
                            var detail_link = "{{URL::to('our-collection/')}}/" + obj.pdata.property_slug;
                            html += '<a title="' + obj.pdata.property_name + '" class="photograph FltLft" rel="' + obj.pdata.id + '" href="' + detail_link + '">';
                            html += obj.pdata.property_name;
                            html += '</a>';
                            html += '<span class="FltRgt">';
                            if (obj.hasOwnProperty("image")) {
                                html += '<i class="fa fa-camera-retro colorGrey" aria-hidden="true" title="Add to Itinerary" onclick="add_to_lightbox(' + obj.image.file_id + ',' + obj.pdata.id + ');" ></i>';
                            } else {
                                html += '<i class="fa fa-camera-retro colorGrey" aria-hidden="true" title="Add to Itinerary" ></i>';
                            }
                            html += '<a class="carticon" href="' + detail_link + '"><i class="fa fa-shopping-cart colorGrey" aria-hidden="true" title="book this hotel"></i></a>';
                            html += '</span>';
                            html += '</h2>';
                            html += '</div>';
                            html += '<div class="entire_story MrgTop5">';
                            html += '<a class="textButton arrowButton detail_view MrgTop5" rel="' + obj.pdata.id + '" href="#">Quick View</a>';
                            html += '<a class="textButton arrowButton MrgTop5" rel="' + obj.pdata.id + '" href="' + detail_link + '">Detail View </a>';
                            if (obj.pdata.price != '')
                            {
                                html += '<a class="textButton arrowButton MrgTop5" rel="' + obj.pdata.id + '" href="' + detail_link + '"> From EUR ' + obj.pdata.price + ' / night </a>';
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
                            if (p % 4 == 0)
                            {
                                html += '</div>';
                                html += '<div class="row">';
                            }
                            p++;
                        });
                        html += '</div>';
                        if (it_scroll == false)
                        {
                            $('#listproperties').html(html);
                        } else {
                            $('#listproperties').append(html);
                        }
                        if (destnarea != '')
                        {
                            if (dest_area[1] == 'country' || dest_area[1] == 'region') {
                                $('#cityfilters').html('');
                            }
                            if (typeof $.parseJSON(data.cities) !== 'undefined' && $.parseJSON(data.cities).length > 0) {
                                var ttp = p - 1;
                                chtml += '<div class="row">';
                                chtml += '<div class="col-md-12">';
                                chtml += '<div class="clear-all-filters"><a href="javascript:void(0)"><i class="fa fa-repeat" aria-hidden="true"></i>&nbsp;Clear Filters</a></div>';
                                chtml += '<ul class="top-bar-filters">';
                                chtml += '<li class="active select-all">';
                                chtml += '<a href="javascript:void(0)" onclick="filter_destination(\'' + dest_area[0] + '\',\'city\');">';
                                chtml += '<div class="filter-bg">';
                                chtml += '<div class="right-text">(' + ttp + ')</div>';
                                chtml += '<div class="clearfix"></div>';
                                chtml += '<div><i class="fa fa-home" aria-hidden="true"></i></div>';
                                chtml += '<div class="top-filter-name">All Properties</div>';
                                chtml += '</div>';
                                chtml += '</a>';
                                chtml += '</li>';
                                $.each($.parseJSON(data.cities), function (idx, cobj) {
                                    var cimg = "{{URL::to('uploads/category_imgs/')}}/" + cobj.category_image;
                                    chtml += '<li>';
                                    chtml += '<a href="javascript:void(0)" onclick="filter_destination(\'' + cobj.id + '\',\'city\');">';
                                    chtml += '<div class="filter-bg" style="background-image: url(\'' + cimg + '\');">';
                                    chtml += '<div class="right-text">(' + cobj.totalproperty + ')</div>';
                                    chtml += '<div class="clearfix"></div>';
                                    chtml += '<div><i class="fa fa-home" aria-hidden="true"></i></div>';
                                    chtml += '<div class="top-filter-name">' + cobj.category_name + '</div>';
                                    chtml += '</div>';
                                    chtml += '</a>';
                                    chtml += '</li>';
                                });
                                chtml += '</ul>';
                                chtml += '</div>';
                                chtml += '</div>';

                                $('#cityfilters').html(chtml);
                            }
                        }

                        sIndex = parseInt(sIndex) + offSet;
                        $('#listrecrds').val(sIndex);
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
<script>
    function toogleNavpost() {
        if (document.getElementById("mySidenavpost").style.width == "342px") {
            return closeNavpost();
        }
        return openNavpost();
    }
    function openNavpost() {
        if ($(window).width() >= 768) {
            document.getElementById("mySidenavpost").style.width = "342px";
            document.getElementById("main").style.marginRight = "250px";
        } else {
            document.getElementById("mySidenavpost").style.width = "100%";
            document.getElementById("main").style.marginRight = "250px";
        }
    }
    function closeNavpost() {
        document.getElementById("mySidenavpost").style.width = "0";
        document.getElementById("main").style.marginRight = "0";
        document.body.style.backgroundColor = "white";
        document.body.style.transition = "all 0.5s ease 0s";
    }
    window.onload = function () {
//        if ($(window).width() >= 768) {
//            document.getElementById("mySidenavpost").style.width = "100%";
//            document.getElementById("main").style.marginRight = "250px";
//        }
//        setTimeout(function () {
//            if ($(window).width() >= 768) {
//                document.getElementById("mySidenavpost").style.width = "0";
//                document.getElementById("main").style.marginRight = "0";
//                document.body.style.backgroundColor = "white";
//                document.body.style.transition = "all 0.5s ease 0s";
//            }
//        }, 3000);

    };

    if ($(window).width() >= 320) {
        document.getElementById("mySidenavpost").style.width = "100%";
        document.getElementById("main").style.marginRight = "250px";
    }

    $(document).on('click', function (event) {
        if ($(window).width() >= 320) {
            if ($(event.target).has('.filter-width').length) {
                document.getElementById("mySidenavpost").style.width = "0";
                document.getElementById("main").style.marginRight = "0";
            }
        }
    });
</script>

@include('layouts/elliot/ai_footer_social')
@include('layouts/elliot/ai_lightbox_popups')
