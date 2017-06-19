@include('layouts/elliot/ai_header')
@include('layouts/elliot/ai_navigation_bar_style_2')

<link href="{{ asset('sximo/assets/css/footer-accordian.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/filters_grid.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/filter-bar.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/ai_yachts-custom.css')}}" rel="stylesheet" type="text/css"/>

<!--Main Page Start here-->

<div class="col-md-12 col-sm-12 col-xs-12 yachts-main-bg">
    <div class="row">
        <div class="locator clear">
            <div id="quick_pager" class="pager topPopList">
                <div id="quick_pager_header">
                    <span><img class="jump-image-align" src="{{URL::to('sximo/assets/images/arrow-botom.gif')}}" alt="">jump to page</span>
                </div>
                <div style="display: none;" class="flyoutBox">
                    <ul id="quick_pager_ul">
                        {{--*/ $totpage = $propertiesArr->appends($pager)->lastPage(); /*--}}
                        @for($p=1;$p<=$totpage;$p++)
                        <li data-id="{{$p}}"><a href="{{URL::to('luxurytravel/'.$pagecate.'?page='.$p)}}">{{$p}}</a></li>
                        @endfor
                    </ul>
                </div>
            </div>
            <div id="itemsPager" class="pager hidden-xs">
                {!! $propertiesArr->appends($pager)->render() !!}
            </div>
        </div>
    </div>

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
                                <a title="{{$props['data']->property_name}}" class="photograph detail_view" rel="{{$props['data']->id}}" href="{{URL::to('our-collection/'.$props['data']->property_slug)}}">
                                    {{$props['data']->property_name}}
                                </a>
                                <span class="FltRgt">
                                    {{--*/ $assigncats = explode(',',$props['data']->property_category_id); /*--}}
                                    @if(in_array('5',$assigncats))
                                    <i class="icon-camera colorGrey" aria-hidden="true"></i>
                                    @endif
                                    @if(in_array('6',$assigncats))
                                    <i class="icon-bed colorGrey" aria-hidden="true"></i>
                                    @endif
                                    @if(in_array('7',$assigncats))
                                    <i class="icon-glass2 colorGrey" aria-hidden="true"></i>
                                    @endif
                                    @if($group_id==1 || $group_id==2 || $uid==$props['data']->user_id )

                                    <a title="Edit" target="_blank" href="{{URL::to('properties_settings/'.$props['data']->id.'/types')}}" >
                                        <i class="icon-trophy2 colorGrey"></i>
                                    </a>
                                    <a title="Edit" target="_blank" @if(array_key_exists('image', $props)) href="{{URL::to('folders/'.$props['image']->folder_id.'?show=thumb')}}" @else href="#" @endif>
                                       <i class="icon-images colorGrey"></i>
                                    </a>

                                    @endif
                                </span>
                            </h2>

                        </div>

                        <p id="LearnMoreBtn1" class="gridplt" @if(array_key_exists('image', $props)) onclick="add_to_lightbox({{$props['image']->file_id}}, {{$props['data']->id}});" @endif >Add to Itinerary</p>

                        <div class="entire_story MrgTop5">
                            <a class="textButton arrowButton detail_view" rel="{{$props['data']->id}}" href="#">
                                View / Request 
                            </a>
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
        <div class="productData col-xs-12 col-sm-6 col-md-4 col-lg-3 margin-bottom-10 locatorData">
            <div class="locator clear bottom">
                <div class="next_page_bottom">
                    @if($currentPage!=0)
                    <a href="{{URL::to('luxurytravel/'.$pagecate.'?page='.$prevnewpage)}}">
                        <img src="{{URL::to('sximo/images/prev_page_bottom.png')}}" alt="">
                    </a>
                    @endif
                    @if($currentPage<=$totpage)
                    <a href="{{URL::to('luxurytravel/'.$pagecate.'?page='.$newpage)}}">
                        <img src="{{URL::to('sximo/images/next_page_bottom.png')}}" alt="">
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@include('layouts/elliot/ai_footer')
@include('layouts/elliot/ai_lightbox_popups')