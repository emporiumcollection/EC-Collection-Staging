@extends('frontend.themes.EC.layouts.main')

@if(!empty($metatags))
    @section('robots', "index,follow")
    {{--  For Title --}}
    @section('meta_title') {{$metatags->meta_title}} @endsection
    {{-- For Meta Keywords --}}
    @section('meta_keywords', $metatags->meta_keywords)
    {{-- For Meta Description --}}
    @section('meta_description', $metatags->meta_description)
    
    @section('meta_link_sitemap')
    @if(!empty($propertyDetail))
    <link rel="canonical" href="{{url('/')}}/{{$propertyDetail['data']->property_slug}}" />          
    @endif        
    <link rel="alternate" type="application/rss+xml" href="{{url('/')}}/sitemap.xml" />
    @endsection  
    
    @section('property="og:url" content="', $metatags->canonical_link)
    
    @section('og_url', $metatags->og_url)
    @section('og_title', $metatags->og_title)
    @section('og_description', $metatags->og_description)
    @section('og_type', $metatags->og_type)
    @section('og_image')
        @if($metatags->og_upload_type=='link')
            @if($metatags->og_image_link!='')
                <meta property="og:image" content="{{$metatags->og_image_link}}" />
            <?php 
                $arr_img = getimagesize($metatags->og_image_link);
                if(!empty($arr_img)){
            ?>
                    <meta property="og:image:width" content="{{$arr_img[0]}}" />
                    <meta property="og:image:height" content="{{$arr_img[1]}}" />
            <?php                    
                }
            ?>
            @endif    
        @else
            @if($metatags->og_image!='')                
            <?php 
                $oipath = url('/').'/uploads/properties_subtab_imgs/'.$metatags->og_image;
                $arr_img = getimagesize($oipath);
                if(!empty($arr_img)){
            ?>
                    <meta property="og:image" content="{{$oipath}}" />
                    <meta property="og:image:width" content="{{$arr_img[0]}}" />
                    <meta property="og:image:height" content="{{$arr_img[1]}}" />
            <?php                    
                }
            ?>   
            @endif 
        @endif
    @endsection
    @section('og_image_width', $metatags->og_image_width)
    @section('og_image_height', $metatags->og_image_height)
    @section('og_sitename', $metatags->og_sitename)
    @section('og_locale', $metatags->og_locale)
    
    @section('article_section', $metatags->article_section)
    
    @section('article_tags')
        @if($metatags->article_tags!='')
            {{--*/ 
                $arrAT = explode(',', $metatags->article_tags);
                if(!empty($arrAT)){
                    for($j=0; $j < count($arrAT); $j++){
            /*--}}
                        <meta property="article:tag" content="{{$arrAT[$j]}}"/>        
            {{--*/  
                    }    
                }
            /*--}}    
        @endif
    @endsection
     
    @section('twitter_url', $metatags->twitter_url)    
    @section('twitter_title', $metatags->twitter_title)
    @section('twitter_description', $metatags->twitter_description)
    
    @section('twitter_image')
        @if($metatags->twitter_upload_type=='link')
            @if($metatags->twitter_image_link!='')
                <meta property="twitter:image" content="{{$metatags->twitter_image_link}}" />
            <?php 
                        
                $arr_img = getimagesize($metatags->twitter_image_link);
                if(!empty($arr_img)){
            ?>
                    <meta property="twitter:width" content="{{$arr_img[0]}}" />
                    <meta property="twitter:height" content="{{$arr_img[1]}}" />
            <?php                    
                }
            ?>
            @endif    
        @else
            @if($metatags->twitter_image!='')
                
            <?php 
                $tipath = url('/').'/uploads/properties_subtab_imgs/'.$metatags->twitter_image;
                $arr_img = getimagesize($tipath);
                if(!empty($arr_img)){
            ?>
                    <meta property="twitter:image" content="{{$tipath}}" />                        
                    <meta property="twitter:width" content="{{$arr_img[0]}}" />
                    <meta property="twitter:height" content="{{$arr_img[1]}}" />
            <?php                    
                }
            ?>   
            @endif 
        @endif
    @endsection  
     
    @section('twitter_domain', $metatags->twitter_domain)
    @section('twitter_card', $metatags->twitter_card)
    @section('twitter_creator', $metatags->twitter_creator)
    @section('created', $metatags->created)
    
    @section('jsonld')
    
    @endsection
    
    
    {{-- For Page's Content Part --}}
@else
    {{--  For Title --}}
    @section('title')
    @if(!empty($propertyDetail))
        {{$propertyDetail['data']->property_name}}    
    @else
        PDP Page   
    @endif
    @endsection
    {{-- For Meta Keywords --}}
    @section('meta_keywords', '')
    {{-- For Meta Description --}}
    @section('meta_description', '')
    {{-- For Page's Content Part --}}
@endif

{{-- For Page's Content Part --}}
@section('content')
    <!-- Restaurant slider starts here -->
    <section id="search-result-slider" class="luxuryHotelSlider">
		 @if(!empty($slider))
			<div id="myCarousel" class="carousel" data-ride="carousel">
				<!-- Indicators -->
				{{--  Wrapper for slides --}}
				<div class="carousel-inner">
					@foreach($slider as $key => $slider_row)
						<div class="item {{($key == 0)? 'active' : ''}}" style="background-image:url({{url('uploads/slider_images/'.$slider_row->slider_img)}});">
							<div class="carousel-caption">
								<h6>{{$slug}}</h6>
								<h2>
									@if($slider_row->slider_link!='#' && $slider_row->slider_link!='')
										<a onclick="return !window.open(this.href, '{{ ((strpos($slider_row->slider_link, 'http://') || strpos($slider_row->slider_link, 'https://')) === false) ? $slider_row->slider_link : 'http://'.$slider_row->slider_link }}', 'width=900,height=500,left=100, top=100, scrollbars, resizable')" href="{{ ((strpos($slider_row->slider_link, 'http://') || strpos($slider_row->slider_link, 'https://')) === false) ? $slider_row->slider_link : 'http://'.$slider_row->slider_link }}">{{$slider_row->slider_title}}</a>
									@else
										{{$slider_row->slider_title}}
									@endif
								</h2>
								<p>@if($slider_row->slider_link!='#' && $slider_row->slider_link!='')
										<a onclick="return !window.open(this.href, '{{ ((strpos($slider_row->slider_link, 'http://') || strpos($slider_row->slider_link, 'https://')) === false) ? $slider_row->slider_link : 'http://'.$slider_row->slider_link }}', 'width=900,height=500,left=100, top=100, scrollbars, resizable')" href="{{ ((strpos($slider_row->slider_link, 'http://') || strpos($slider_row->slider_link, 'https://')) === false) ? $slider_row->slider_link : 'http://'.$slider_row->slider_link }}" style="color:white;	">{!! nl2br($slider_row->slider_description) !!}</a>
									@else
										{!! nl2br($slider_row->slider_description) !!}
									@endif


								</p>
							</div>
						</div>
					@endforeach
					{{--*/ $adscatid = ($destination_category > 0) ? $destination_category : 'Hotel'; $sliderads = CommonHelper::getSliderAds('grid_slider', $adscatid) /*--}}
					@if(!empty($sliderads['leftsidebarads']))
						@foreach($sliderads['leftsidebarads'] as $ads)
							<div class="item" style="background-image:url({{URL::to('uploads/users/advertisement/'.$ads->adv_img)}});">
								<div class="carousel-caption">
									<h6>Advertisement</h6>
									<h2>
										@if($ads->adv_link!='#' && $ads->adv_link!='')
											<a onclick="return !window.open(this.href, '{{ ((strpos($ads->adv_link, 'http://') || strpos($ads->adv_link, 'https://')) === false) ? $ads->adv_link : 'http://'.$ads->adv_link }}', 'width=900,height=500,left=100, top=100, scrollbars, resizable')" href="{{ ((strpos($ads->adv_link, 'http://') || strpos($ads->adv_link, 'https://')) === false) ? $ads->adv_link : 'http://'.$ads->adv_link }}">{{$ads->adv_title}}</a>
										@else
											{{$ads->adv_title}}
										@endif
									</h2>
									<p>@if($ads->adv_link!='#' && $ads->adv_link!='')
											<a onclick="return !window.open(this.href, '{{ ((strpos($ads->adv_link, 'http://') || strpos($ads->adv_link, 'https://')) === false) ? $ads->adv_link : 'http://'.$ads->adv_link }}', 'width=900,height=500,left=100, top=100, scrollbars, resizable')" href="{{ ((strpos($ads->adv_link, 'http://') || strpos($ads->adv_link, 'https://')) === false) ? $ads->adv_link : 'http://'.$ads->adv_link }}">{{$ads->adv_desc}}</a>
										@else
											{{$ads->adv_desc}}
										@endif


									</p>
								</div>
							</div>
						@endforeach
					@endif
				</div>
				@if(count($slider) > 1)
					<!-- Left and right controls -->
					<a class="left carousel-control" href="#myCarousel" data-slide="prev">
						<img src="{{ asset('themes/emporium/images/editorial-left-arrow.png') }}" alt="Icon"/>
					</a>
					<a class="right carousel-control" href="#myCarousel" data-slide="next">
						<img src="{{ asset('themes/emporium/images/editorial-right-arrow.png') }}" alt="Icon"/>
					</a>
				@endif
			</div>
		@endif
    </section>
    
    
    <?php if(!empty($search_for)){ ?>
    <section class="search-tab {{ $search_for=='experience' ? 'tab-show' : 'tab-hide' }} {{empty($slider) ? 'margin-top-100' : ''  }}">
        <?php 
            $sel_collection = '';
            $sel_experience = '';
            if($req_for=="luxury_experience"){
               $sel_experience = 'active';     
            }else{
               $sel_collection = 'active'; 
            } 
        ?>
        <ul class="nav nav-tabs">
            <?php /* <li class="{{$sel_collection}}"><a href="#ourCollection" data-toggle="tab">Our Collections</a></li> */ ?>
            <li class=""><a href="#tab-Home" data-toggle="tab">Home</a></li>
            <li class="{{$sel_experience}}"><a href="#experiences" data-toggle="tab">Experiences</a></li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Destination <span class="caret"></span></a>                                
                <ul class="dropdown-menu">                  
                  @if(!empty($dd_destinations))                  
                    @foreach($dd_destinations as $dd_des)
                        <li><a href="{{URL::to('luxury_destinations')}}/{{$dd_des->category_alias}}">{{$dd_des->category_name}}</a></li>
                    @endforeach 
                  @endif
                </ul>
            </li>               
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Channel <span class="caret"></span></a>
                <ul class="dropdown-menu">                  
                  @if(!empty($dd_channels))                  
                    @foreach($dd_channels as $dd_chnl)
                        <li><a href="{{URL::to('social-youtube')}}/{{$dd_chnl->category_alias}}">{{$dd_chnl->category_name}}</a></li>
                    @endforeach 
                  @endif
                </ul>
            </li> 
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Social <span class="caret"></span></a>
                <ul class="dropdown-menu">                  
                  @if(!empty($dd_social))                  
                    @foreach($dd_social as $dd_soc)
                        <li><a href="{{URL::to('social-instagram')}}/{{$dd_soc->category_alias}}">{{$dd_soc->category_name}}</a></li>
                    @endforeach 
                  @endif
                </ul>
            </li>                       
        </ul>
        <div class="tab-content">
            {{--*/ $i=1; $j=1; $k=1; $l=1; $arr_key=''; /*--}}
            <div class="search-breadcrum">
                <ul class="s-breadcrumb">
                    <li><a href="{{URL::to('/')}}">{{CNF_APPNAME}}</a></li>
                    <li>{{!empty($sel_exp) ? $sel_exp : ''}}</li>
                </ul>
            </div>
            
            <div id="experiences" class="tab-pane {{$sel_experience}} experinces">
                <select name="experience" id="experience">  
                    @if(!empty($experiences))                  
                        @foreach($experiences as $exp)
                            <option value="{{$exp->category_alias}}" <?php echo ($sel_exp==$exp->category_alias) ? 'selected="selected"' : '' ?>>{{$exp->category_name}}</option>   
                            {{--*/ $i++;  /*--}}
                        @endforeach 
                    @endif
                </select>
                <h5 class="margin-top-20">Choose your Membership Type to make a reservation</h5>                
                @if(!empty($collections))
                {{--*/ $i=1; $j=1; $k=1; $l=1; $arr_key=''; /*--}}
                <ul class="nav nav-tabs">
                    @foreach($collections as $coll)
                        <?php $exp_cat_name = explode(' ', $coll->category_name) ?>  
                        <li class="<?php echo ($m_type==$coll->category_alias) ? 'active' : '' ?> dest-collection" data-name="{{$coll->category_alias}}"><a href="{{URL::to('luxury_experience')}}/{{$sel_exp}}/{{$coll->category_alias}}" >{{$exp_cat_name[0]}} </a></li>
                        {{--*/ $k++;  /*--}}    
                    @endforeach                            
                </ul>                  
                @endif
                <div class="load_ajax">

                </div>           
            </div>
            
            
            <input type="hidden" name="m_type" id="m_type" value="{{@!empty($m_type) ? $m_type : ''}}" />
        </div>
    </section>
    
    <section class="search-tab {{ $search_for=='destinations' ? 'tab-show' : 'tab-hide' }}  {{empty($slider) ? 'margin-top-100' : ''  }}">        
        <ul class="nav nav-tabs" id="main_tab">    
            <li class=""><a href="#tab-Home" data-toggle="tab">Home</a></li>   
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Experience <span class="caret"></span></a>                
                <ul class="dropdown-menu">                  
                  @if(!empty($experiences))                  
                    @foreach($experiences as $exp)
                        <li><a href="{{URL::to('luxury_experience')}}/{{$exp->category_alias}}">{{$exp->category_name}}</a></li>
                    @endforeach 
                  @endif
                </ul>
            </li>      
            <li class="active" id="tb_destination"><a href="#tab-destination" data-toggle="tab">Destination</a></li>
            <li class="dropdown active" style="display: none;" id="tbd_destination">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Destination <span class="caret"></span></a>                                
                <ul class="dropdown-menu">                  
                  @if(!empty($dd_destinations))                  
                    @foreach($dd_destinations as $dd_des)
                        <li><a href="{{URL::to('luxury_destinations')}}/{{$dd_des->category_alias}}">{{$dd_des->category_name}}</a></li>
                    @endforeach 
                  @endif
                </ul>
            </li>            
            <li class="tb_channel"><a href="#tab-channel" data-toggle="tab">Channel</a></li>
            <li class="dropdown active tbd_Channel" style="display: none;">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Channel <span class="caret"></span></a>                                
                <ul class="dropdown-menu">                  
                  @if(!empty($dd_channels))                  
                    @foreach($dd_channels as $dd_chnl)
                        <li><a href="{{URL::to('social-youtube')}}/{{$dd_chnl->category_alias}}">{{$dd_chnl->category_name}}</a></li>
                    @endforeach 
                  @endif
                </ul>
            </li>              
            <li class="tb_Social"><a href="#tab-social" data-toggle="tab">Social</a></li>
            <li class="dropdown active tbd_Social" style="display: none;">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Social <span class="caret"></span></a>                                
                <ul class="dropdown-menu">                  
                  @if(!empty($dd_social))                  
                    @foreach($dd_social as $dd_soc)
                        <li><a href="{{URL::to('social-instagram')}}/{{$dd_soc->category_alias}}">{{$dd_soc->category_name}}</a></li>
                    @endforeach 
                  @endif
                </ul>
            </li> 
            <li class="tb_Social"><a href="#tab-social" data-toggle="tab">Map</a></li> 
            <!--<li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Channel <span class="caret"></span></a>
                <ul class="dropdown-menu">                  
                  @if(!empty($dd_channels))                  
                    @foreach($dd_channels as $dd_chnl)
                        <li><a href="{{URL::to('social-youtube')}}/{{$dd_chnl->category_alias}}">{{$dd_chnl->category_name}}</a></li>
                    @endforeach 
                  @endif
                </ul>
            </li>
            
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Social <span class="caret"></span></a>
                <ul class="dropdown-menu">                  
                  @if(!empty($dd_social))                  
                    @foreach($dd_social as $dd_soc)
                        <li><a href="{{URL::to('social-instagram')}}/{{$dd_soc->category_alias}}">{{$dd_soc->category_name}}</a></li>
                    @endforeach 
                  @endif
                </ul>
            </li>-->            
        </ul>
        <div class="tab-content">
            
            
            
            {{--*/ $i=1; $j=1; $k=1; $l=1; $arr_key=''; /*--}}                
            
            <div id="tab-destination" class="tab-pane active destinatin">
                <div class="search-breadcrum">
                    <ul class="s-breadcrumb destination-breadcrumb">
                        @if(!empty($bc_dest))
                            <li><a href="{{URL::to('/')}}">{{CNF_APPNAME}}</a></li>
                            <?php $path = 'luxury_destinations'; ?>
                            @foreach($bc_dest as $sin_bc)
                                <?php $path = $path.'/'.$sin_bc->category_alias; ?>
                                <li><a class="EGloader" href="{{URL::to($path)}}">{{$sin_bc->category_name}}</a></li>
                            @endforeach                        
                        @endif
                    </ul>
                </div>
                <select name="dd-destination" id="dd-destination">
                    <option value="{{$catalias}}" data-id="{{$catid}}">You are in {{$catname}}</option>     
                    @if(!empty($destinations))               
                        @foreach($destinations as $dest)
                            <option data-id="{{$dest->id}}" value="{{$dest->category_alias}}" <?php echo ($dest_cat==$dest->category_alias) ? 'selected="selected"' : '' ?>>{{$dest->category_name}}</option>   
                            {{--*/ $i++;  /*--}}
                        @endforeach
                    @endif 
                    @if(!empty($parent_cat)) 
                        <option data-id="{{$parent_cat->id}}" value="-1">&lt; Back to {{$parent_cat->category_name}}</option>
                    @else
                        <option value="0">&lt; Back to Destination</option>
                    @endif
                </select>
                <h5 class="margin-top-20">Choose your Membership Type to make a reservation</h5>              
                @if(!empty($collections))
                {{--*/ $i=1; $j=1; $k=1; $l=1; $arr_key=''; /*--}}
                <ul class="nav nav-tabs">
                    @foreach($collections as $coll)  
                        <?php $exp_cat_name = explode(' ', $coll->category_name) ?>                      
                        <li class="<?php echo ($m_type==$coll->category_alias) ? 'active' : '' ?> dest-collection" data-name="{{$coll->category_alias}}"><a href="{{URL::to('/')}}" >{{$exp_cat_name[0]}}</a></li>
                        {{--*/ $k++;  /*--}}    
                    @endforeach                            
                </ul>                  
                @endif
                
                <div class="load_ajax">

                </div>
                           
            </div>
            <div id="tab-channel" class="tab-pane">
                <div class="search-breadcrum">
                    <ul class="s-breadcrumb youtube-breadcrumb">
                        @if(!empty($bc_dest))
                            <li><a href="{{URL::to('/')}}">{{CNF_APPNAME}}</a></li>
                            <?php $path = 'social-youtube'; ?>
                            @foreach($bc_dest as $sin_bc)
                                <?php $path = $path.'/'.$sin_bc->category_alias; ?>
                                <li><a class="yt-bread" data-alias="{{$sin_bc->category_alias}}">{{$sin_bc->category_name}}</a></li>
                            @endforeach                        
                        @endif
                    </ul>
                </div>
                <select name="youtube_channel" id="youtube_channel">
                    <option value="{{$catalias}}" data-id="{{$catid}}">You are in {{$catname}}</option>     
                    @if(!empty($youtube_channels))               
                        @foreach($youtube_channels as $dest)
                            <option data-id="{{$dest->id}}" value="{{$dest->category_alias}}" <?php echo ($dest_cat==$dest->category_alias) ? 'selected="selected"' : '' ?>>{{$dest->category_name}}</option>   
                            {{--*/ $i++;  /*--}}
                        @endforeach
                    @endif 
                    @if(!empty($parent_cat)) 
                        <option data-id="{{$parent_cat->id}}" value="-1">&lt; Back to {{$parent_cat->category_name}}</option>
                    @else
                        <option value="0">&lt; Back to Channel</option>
                    @endif
                </select>
                              
                <div class="dv-youtube-channel">
        			
        		</div>
                           
            </div>
            <div id="tab-social" class="tab-pane">
                <div class="search-breadcrum">
                    <ul class="s-breadcrumb social-breadcrumb">
                        @if(!empty($bc_dest))
                            <li class="instagram"><a href="{{URL::to('/')}}">{{CNF_APPNAME}}</a></li>
                            <?php $path = 'social-instagram'; ?>
                            @foreach($bc_dest as $sin_bc)
                                <?php $path = $path.'/'.$sin_bc->category_alias; ?>
                                <li><a class="insta-bread" data-alias="{{$sin_bc->category_alias}}">{{$sin_bc->category_name}}</a></li>
                            @endforeach                        
                        @endif
                    </ul>
                </div>
                <select name="instagram_channel" id="instagram_channel">
                    <option value="{{$catalias}}" data-id="{{$catid}}">You are in {{$catname}}</option>     
                    @if(!empty($instagram_channels))               
                        @foreach($instagram_channels as $dest)
                            <option data-id="{{$dest->id}}" value="{{$dest->category_alias}}" <?php echo ($dest_cat==$dest->category_alias) ? 'selected="selected"' : '' ?>>{{$dest->category_name}}</option>   
                            {{--*/ $i++;  /*--}}
                        @endforeach
                    @endif 
                    @if(!empty($parent_cat)) 
                        <option data-id="{{$parent_cat->id}}" value="-1">&lt; Back to {{$parent_cat->category_name}}</option>
                    @else
                        <option value="0"> &gt; Back to Social</option>
                    @endif
                </select>    
                <div>
                    
        			<section id="instagran" class="sections-instagram">
                        <div class="full-width">
                            <div  class="dv-instagram-channel"></div>
                        </div>
                    </section>
                    
        		</div>
                           
            </div>
            
            <input type="hidden" name="" id="" value="" />
            
            <input type="hidden" name="dest_cat" id="dest_cat" value="{{@!empty($dest_cat)? $dest_cat : ''}}" />
            <input type="hidden" name="dest_url" id="dest_url" value="{{@!empty($dest_url)? $dest_url : ''}}" />
        </div>
    </section>
<?php } ?> 
<input type="hidden" name="sel_exp" id="sel_exp" value="{{!empty($sel_exp) ? $sel_exp : ''}}" />   
<input type="hidden" name="dest_collection" id="dest_collection" value="{{!empty($m_type) ? $m_type : ''}}" /> 
<input type="hidden" name="req_for" id="req_for" value="{{@!empty($req_for)? $req_for : ''}}" />


@endsection




