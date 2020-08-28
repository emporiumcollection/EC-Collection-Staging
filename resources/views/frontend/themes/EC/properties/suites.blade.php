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
    <?php
        $jsonld = array(
            "@context"=>"https://schema.org/",
            "@type"=>"Recipe",
            "name"=>"Grandma's Holiday Apple Pie",
            "author"=>CNF_APPNAME,
            "image"=>"http://images.edge-generalmills.com/56459281-6fe6-4d9d-984f-385c9488d824.jpg",
            "description"=>"A classic apple pie.",        
        );
        //echo json_encode($jsonld);
        $jld = array();
        if (array_key_exists('typedata', $propertyDetail)){            
            foreach($propertyDetail['typedata'] as $type){
                if (array_key_exists($type->id, $propertyDetail['roomimgs'])){
                    //$totimg = count($propertyDetail['roomimgs'][$type->id]['imgs']); $divd2 = round($totimg/2);
                    $jlditem['@type']='Products';                    
                    $jlditem['name']=$type->category_name;
                    $jlditem['author']=CNF_APPNAME;
                    $image_url=$propertyDetail['roomimgs'][$type->id]['imgsrc'].$propertyDetail['roomimgs'][$type->id]['imgs'][0]->file_name;
                    $arr_img = getimagesize( $propertyDetail['roomimgs'][$type->id]['imgsrc'].$propertyDetail['roomimgs'][$type->id]['imgs'][0]->file_name );
                    if(!empty($arr_img)){
                        $imgobj['@type'] = "ImageObject";
                        $imgobj['url'] = $image_url;
                        $imgobj['width'] = $arr_img[0];
                        $imgobj['height'] = $arr_img[1]; 
                        $jlditem['image'] = $imgobj;          
                    }
                    $jlditem['description']=(strlen($type->room_desc) > 100) ? substr($type->room_desc,0,100) : $type->room_desc;
                    if($type->price!=''){
                        $jlditem['price'] = (($currency->content!='') ? $currency->content : '$').$type->price;
                    }
                    $jld[] = $jlditem;
                }
            }
        }
        echo json_encode($jld);
    ?>
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

@section('content')
<div class="content-em1">
    <div class="content-em">
    <div class="container-fluid pt-5">
      <div class="row mt-5">
        <div class="col-3">        
            <?php  ?>
            <ul class="nav flex-column nav-sidebar is-small onstick wow fadeInUp" data-wow-delay=".3s">
              <li class="nav-item">
                <a href="main-page.html">
                  <i class="ico ico-back mb-4"></i>
                </a>
              </li>
              <li class="nav-item">                
                <a class="nav-link suite-propa" data-toggle="collapse" href="suite.html" data-target="#suite" role="button" aria-expanded="false"
                  aria-controls="suite"> 
                  Suites
                </a>
                <div class="collapse show" id="suite">
                    <ul class="nav flex-column nav-sidebar is-small">                    
                        @if(!empty($propertyDetail))
                            @if(!empty($propertyDetail['typedata']))
                                @foreach($propertyDetail['typedata'] as $tdata)        
                                   <li class="nav-item">
                                      <a class="nav-link nav-link-sub" href="#">{{$tdata->category_name}}</a>
                                   </li>            
                                @endforeach
                            @endif
                        @endif                    
                    </ul>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="architecture.html">Architecture</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="spa.html">Spa & Wellness </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#restaurant" role="button" aria-expanded="false"
                  aria-controls="restaurant"> 
                  Restaurant & Bar
                </a>
                <div class="collapse " id="restaurant">
                  <ul class="nav flex-column nav-sidebar is-small">
                    <li class="nav-item">
                      <a class="nav-link nav-link-sub" href="restaurant.html">Restaurant Name</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link nav-link-sub" href="restaurant.html">Restaurant Name</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link nav-link-sub" href="restaurant.html">Restaurant Name</a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link @@locActive" href="location.html">Location</a>
              </li>
              <li class="nav-item">
                <a class="nav-link @@expActive" href="experience.html">Experiences</a>
              </li>
              <li class="nav-item">
                <a class="nav-link btn-sidebar" href="#" data-sidebar="#gallery">Gallery</a>
              </li>
              <li class="nav-item">
                <a class="nav-link @@sosActive" href="social.html">Social</a>
              </li>
              <li class="nav-item">
                <a class="nav-link @@comActive" href="compare.html">Compare</a>
              </li>
            </ul>
        </div>
        <div class="col-9">
          <div class="title-main offset-930 mb-4 wow fadeInUp" data-wow-delay=".3s">
            <h2>{{$propertyDetail['data']->property_name}}</h2>
          </div>
          <div class="container-hotel-list">
            
                <?php //echo "<pre/>"; print_r($propertyDetail['roomimgs']); die; ?>
                @if(!empty($propertyDetail['typedata']))
                    @foreach($propertyDetail['typedata'] as $sintype)
                        <div class="hotel-page-list mb-5">
                        <h3>{{$sintype->category_name}}</h3>
                        @if(!empty($propertyDetail['roomimgs']))
                            <div class="hotel-list-slide owl-carousel owl-theme suites-slider"> 
                            @if(array_key_exists($sintype->id, $propertyDetail['roomimgs']))
                            <?php
                                $path = '';
                                $path = $propertyDetail['roomimgs'][$sintype->id]['imgsrc'];
                            ?>                      
                            @foreach($propertyDetail['roomimgs'][$sintype->id]['imgs'] as $sinimg)
                                <?php 
                                    $imgpath = '';
                                    $imgpath = $path."/".$sinimg->file_name; 
                                ?> 
                                    <div class="item">
                                      <img src="{{$imgpath}}" class="img-fluid" alt="">
                                    </div>
                             @endforeach  
                             </div> 
                             @endif
                        @endif
                        
                        <div class="hotel-meta">
                            <a href="detail-page.html" class="view more">
                              VIEW DETAILS
                            </a>
                            <div class="hotel-title">
                              <p class="mb-0">2 Bedrooms</p>
                              <p class="mb-0 inc">Includes</p>
                            </div>
                            <div class="hotel-prices">
                              € 1499
                            </div>
                            <div class="action-hotel">
                              <a href="deals.html">View Deals</a>
                              | <a href="#">Add to Favorite</a> | <a href="#">Book this Suite</a>
                            </div>
                        </div>
                    </div>    
                    @endforeach
                @endif           
                
            
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>  
    
@endsection