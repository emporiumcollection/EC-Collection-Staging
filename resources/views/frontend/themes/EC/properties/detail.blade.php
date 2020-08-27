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
        
        <?php //echo "<pre/>"; print_r($propertyDetail); //die;?>

<ul class="nav flex-column nav-sidebar is-small onstick wow fadeInUp" data-wow-delay=".3s">
  <li class="nav-item">
    <a href="#">
      <i class="ico ico-back mb-4"></i>
    </a>
  </li>
  <li class="nav-item">
    
    <a class="nav-link" data-toggle="collapse" href="#" data-target="#suite" role="button" aria-expanded="false"
      aria-controls="suite"> 
      Suites
    </a>
    <div class="collapse show" id="suite">
      <ul class="nav flex-column nav-sidebar is-small">
        <?php
        if(!empty($propertyDetail)){
            if(!empty($propertyDetail['typedata'])){
                foreach($propertyDetail['typedata'] as $tdata){
        ?>
                   <li class="nav-item">
                      <a class="nav-link nav-link-sub" href="#">{{$tdata->category_name}}</a>
                   </li>            
        <?php                
                }
            }
        }
        ?>
        
        <!--<li class="nav-item">
          <a class="nav-link nav-link-sub" href="detail-page.html">Suite Name</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-sub" href="detail-page.html">Suite Name</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-sub" href="detail-page.html">Suite Name</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-sub" href="detail-page.html">Suite Name</a>
        </li>-->
      </ul>
    </div>
  </li>
  @if($propertyDetail['data']->architecture_title!='' && $propertyDetail['data']->architecture_desciription!='')
  <li class="nav-item">
    <a class="nav-link " href="architecture.html">Architecture</a>
  </li>
  @endif
  @if($propertyDetail['data']->spa_ids!='')
  <li class="nav-item">
    <a class="nav-link " href="spa.html">Spa & Wellness </a>
  </li>
  @endif
  @if($propertyDetail['data']->restaurant_ids!='')
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
  @endif
  <li class="nav-item">
    <a class="nav-link @@locActive" href="#">Location</a>
  </li>
  <li class="nav-item">
    <a class="nav-link @@expActive" href="#">Experiences</a>
  </li>
  <li class="nav-item">
    <a class="nav-link @@galActive" href="#">Gallery</a>
  </li>
  <li class="nav-item">
    <a class="nav-link @@sosActive" href="#">Social</a>
  </li>
  <li class="nav-item">
    <a class="nav-link @@comActive" href="#">Compare</a>
  </li>
</ul>
        </div>
        <div class="col-9 pr-0 wow fadeInUp" data-wow-delay=".3s">
          <div class="title-main offset-930 mb-4 wow fadeInUp" data-wow-delay=".3s">
            <h2>{{$propertyDetail['data']->property_name}}</h2>
          </div>
          <div class="container">
            <div class="slider-container">
              <a href="#">
                <i class="ico ico-diamon diamon-label"></i>
              </a>
              <div class="slider-detail">
                <?php 
                    if(!empty($propertyDetail['propimage'])){
                        foreach($propertyDetail['propimage'] as $sinimg){
                            $path = '';
                            $path = $propertyDetail['propimage_thumbpath']."/".$sinimg->file_name;
                ?>
                           <div class="slider-item">
                              <img src="{{$path}}" class="img-fluid" alt="">
                           </div> 
                <?php                
                        }                    
                    } 
                ?>
                <!--<div class="slider-item">
                  <img src="images/29be6592342279.5e49609509d85.jpg" class="img-fluid" alt="">
                </div>
                <div class="slider-item">
                  <div class="videoWrapper">
                    <video width="640" height="360" style="max-width:100%;" poster="images/maxresdefault.webp"
                      preload="none" controls playsinline webkit-playsinline>
                      <source src="images/Emporium-Hotel-South-Bank.mp4" type="video/mp4">
                    </video>
                  </div>

                </div>
                <div class="slider-item">
                  <img src="images/29be6592342279.5e49609509d85.jpg" class="img-fluid" alt="">
                </div>-->
              </div>
                <div class="prev"><i class="ico ico-back"></i></div>
                <div class="next"><i class="ico ico-next"></i></div>
            </div>
            <?php 
                if(!empty($propertyDetail['typedata'])){
                    $first_room = $propertyDetail['typedata'][0];
                    //foreach($propertyDetail['typedata'] as $sinroom){
                    //    $path = '';
                    //    $path = $propertyDetail['propimage_thumbpath']."/".$sinimg->file_name;
            ?>
            <div class="row">
              <div class="col-md-8">
                <div class="title-main mt-0 mb-5">
                  <h2>{{$propertyDetail['data']->property_name}}</h2>
                </div>
                <h3 class="mb-4 color-dark-grey ">{{$first_room->category_name}}</h3>
                <p>Stylish and Glamourous afternoon tea in Oscar restaurant or in the
                  drawing room.</p>
                <hr>
                <div class="row">
                  <div class="col-5 ">
                    Size
                  </div>
                  <div class="col-7">
                    43 M2 / 463 sq.ft
                  </div>
                </div>
                <div class="row">
                  <div class="col-5 ">
                    View
                  </div>
                  <div class="col-7">
                    Ocean View
                  </div>
                </div>
                <div class="row">
                  <div class="col-5 ">
                    Location
                  </div>
                  <div class="col-7">
                    6th Floor
                  </div>
                </div>
                <div class="row">
                  <div class="col-5 ">
                    Bathroom
                  </div>
                  <div class="col-7">
                    Bathtub, Shower
                  </div>
                </div>
                <hr>
                <div id='calendar' class="mt-5"></div>
              </div>
              <div class="col-md-4">
                <div class="side-detail mb-3">
                  <div class="row align-items-center justify-content-center">
                    <h3>
                      € 1.299
                    </h3>
                    <div class="ml-1">
                      <i class="ico ico-info-green pointer" type="button" data-toggle="modal"
                        data-target="#priceModal"></i>
                    </div>
                    <div class="ml-2">
                      <span class="pernight"></span>
                    </div>
                  </div>
                  
                  <p><i><b>Includes breakfast</b></i></p>
                  <hr>
                  <p>Free cancelation before <b>18 Feb 2020</b></p>
                  <p>Reserve now, pay at the Hotel</p>
                  <a href="#" class="btn btn-dark btn-block">Reservation</a>
                </div>

                <div class="side-detail text-left mb-3 px-2">
                  <h3 class="text-center mt-2 mb-0">
                    <span class="why-we"></span>
                  </h3>
                  <ul class="pl-4">
                    <li class="mb-2">Stylish and Glamourous afternoon tea in Oscar
                      restaurant or in the drawing room.</li>
                    <li class="mb-2">Stylish and Glamourous afternoon tea in Oscar
                      restaurant or in the drawing room.</li>
                    <li class="mb-2">Stylish and Glamourous afternoon tea in Oscar
                      restaurant or in the drawing room.</li>
                    <li class="mb-2">Stylish and Glamourous afternoon tea in Oscar
                      restaurant or in the drawing room.</li>
                  </ul>
                </div>
              </div>
            </div>
            
            <div class="hotel-detail---02 my-5">
              <div class="row">
                <div class="col text-center">
                  <div class="i-touch">
                    <p><i class="ico ico-covid"></i></p>
                    <p>Corona Conscious</p>
                  </div>
                </div>
                <div class="col text-center">
                  <div class="i-touch">
                    <p><i class="ico ico-hotel-line"></i></p>
                    <p>Handpicked Collection</p>
                  </div>
                </div>
                <div class="col text-center">
                  <div class="i-touch">
                    <p><i class="ico ico-bells"></i></p>
                    <p>Personalize Service</p>
                  </div>
                </div>
                <div class="col text-center">
                  <div class="i-touch">
                    <p><i class="ico ico-gift"></i></p>
                    <p>Perks & Offers</p>
                  </div>
                </div>
                <div class="col text-center">
                  <div class="i-touch">
                    <p><i class="ico ico-shield"></i></p>
                    <p>Price Matching</p>
                  </div>
                </div>
                <div class="col text-center">
                  <div class="i-touch">
                    <p><i class="ico ico-pay"></i></p>
                    <p>Trusted by Visa</p>
                  </div>
                </div>
                <div class="col text-center">
                  <div class="i-touch">
                    <p><i class="ico ico-lock"></i></p>
                    <p>Secure Booking</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="hotel-deal">
              <h4>Hotel Deals</h4>
              <div class="container">
                <div class="row justify-content-between mb-4">
                  <div class="col-7">
                    <div class="hd-1">
                      <h3 class="heading-collsp hd-heading-b">Advanced Purchase: 10% off</h3>
                      <p class="mb-0"><b>Includes:</b></p>
                      <p>Collection box of chockolates </p>
                      <p class="mb-0"><b>Offer Details:</b></p>
                      <p class="mb-0">Available to book until <b>31 Dec 2020</b></p>
                      <p class="mb-0">Valid for stays from <b>31 Dec 2020</b> to <b>31 Dec
                          2020</b></p>
                      <p>This offer must be booked at least <b>14 days</b>
                        before your stay</p>

                      <p class="mb-0"><b>Terms and Conditions:</b></p>
                      <p><a href="#" class="text-dark">Click here <i class="ico ico-info-b"></i></a></p>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="hd-1-1 text-center">
                      <h3 class="mb-0">
                        € 1.299
                        <span class="dropdown">
                          <i class="ico ico-info-b pointer" type="button" data-toggle="modal"
                            data-target="#priceModal"></i>
                        </span>
                      </h3>
                      <p><i>p/night</i></p>
                      <a href="#" class="btn btn-dark btn-block">View Offer</a>
                    </div>
                  </div>
                </div>
                <div class="row justify-content-between">
                  <div class="col-7">
                    <div class="hd-2">
                      <div class="inner-collsp">
                        <h3 class=" heading-collsp hd-heading-w">Community Welcome Rate: 20%</h3>
                        <p class="mb-0"><b>Includes:</b></p>
                        <p>Collection box of chockolates </p>
                        <p class="mb-0"><b>Offer Details:</b></p>
                        <p class="mb-0">Available to book until <b>31 Dec 2020</b></p>
                        <p class="mb-0">Valid for stays from <b>31 Dec 2020</b> to <b>31 Dec
                            2020</b></p>
                        <p>This offer must be booked at least <b>14 days</b> before your
                          stay</p>
                        <p class="mb-0"><b>Terms and Conditions:</b></p>
                        <p><a href="#">Click here <i class="ico ico-info-w"></i></a></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="hd-2-2 text-center">
                      <h3 class="mb-0">
                        € 1.299
                        <span class="dropdown">
                          <i class="ico ico-info-w pointer" type="button" data-toggle="modal"
                          data-target="#priceModal"></i>
                        </span>
                      </h3>
                      <p><i>p/night</i></p>
                      <a href="#" class="btn btn-dark btn-block">View Offer</a>
                    </div>
                  </div>
                </div>

              </div>

            </div>
          </div>
          <?php 
                //}
          }
          ?>
          <div class="container">
            <h4 class="mt-5 mb-4 color-dark-grey ">Amenities</h4>
            <div class="row mb-4">
              <div class="col-md-3 col-sm-6 mb-4">
                <p class="mb-0">Pool</p>
                <p class="mb-0">Wlan</p>
                <p class="mb-0">Smart-TV</p>
                <p class="mb-0">Koffeemaschine</p>
                <p class="mb-0">Laundry service</p>
              </div>
              <div class="col-md-3 col-sm-6 mb-4">
                <p class="mb-0">Pool</p>
                <p class="mb-0">Wlan</p>
                <p class="mb-0">Smart-TV</p>
                <p class="mb-0">Koffeemaschine</p>
                <p class="mb-0">Laundry service</p>
              </div>
              <div class="col-md-3 col-sm-6 mb-4">
                <p class="mb-0">Pool</p>
                <p class="mb-0">Wlan</p>
                <p class="mb-0">Smart-TV</p>
                <p class="mb-0">Koffeemaschine</p>
                <p class="mb-0">Laundry service</p>
              </div>
              <div class="col-md-3 col-sm-6 mb-4">
                <p class="mb-0">Pool</p>
                <p class="mb-0">Wlan</p>
                <p class="mb-0">Smart-TV</p>
                <p class="mb-0">Koffeemaschine</p>
                <p class="mb-0">Laundry service</p>
              </div>
            </div>
            <div class="row align-items-end mb-4">
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-6">
                    <div class="aspect-ratio-box">
                      <div class="aspect-ratio-box-inside text-center">
                        <i class="ico ico-messager"></i>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="aspect-ratio-box">
                      <div class="aspect-ratio-box-inside">
                        <img src="images/QR-code.png" class="img-fluid" alt="">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="hotel-user mt-4 mb-5">
                  <div class="pp-prof-det">
                    <img src="images/img-profile.jpg" alt="">
                  </div>
                  <div class="usr-info">
                    <h4 class=" mb-2"><b>June</b> Davidson</h4>
                    <p class="dd--info mb-2">Luxury Lifstyle Agent</p>
                    <p class="dd-location-info mb-0"><i class="ico ico-place-2"></i> Munch</p>
                  </div>
                  <a href="#" class="plus-btn">+</a>
                </div>
              </div>
              <div class="col-md-6">
                <div class="kldk">
                  <div class="row align-items-center">
                    <div class="col-3 col-sks">
                      <div class="bulletos">
                        <i class="ico ico-user"></i>
                      </div>
                    </div>
                    <div class="col">
                      <div class="row align-items-center ml-0">
                        <h3>
                          € 1.299
                        </h3>
                        <div class="ml-1">
                          <i class="ico ico-info-green pointer" type="button" data-toggle="modal"
                            data-target="#priceModal"></i>
                        </div>
                        <div class="ml-2">
                          <span class="pernight"></span>
                        </div>
                      </div>
                      <h4>Included in this rate</h4>
                      <p>This room includes breakfast</p>
                      <div class="desc-sdk--11">
                        To view your exclusive benefits, don't forget sign in your
                        <span><b><i>Emporium Collection</i></b></span>
                        account
                      </div>
                    </div>
                  </div>
                  <div class="row align-items-center mb-4">
                    <div class="col-3 col-sks">
                    </div>
                    <div class="col col-lol-2">
                      Do you have an account? <span><b><i>Sign
                            in</i></b></span> or <span><b><i>Create an account</i></b></span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <select class="wide" name="" id="">
                          <option value="">1 - Suite Name</option>
                          <option value="">1 - Suite Name</option>
                          <option value="">1 - Suite Name</option>
                          <option value="">1 - Suite Name</option>
                          <option value="">1 - Suite Name</option>
                          <option value="">1 - Suite Name</option>
                          <option value="">1 - Suite Name</option>
                        </select>
                      </div>
                    </div>
                    <div class="col">
                      <button type="button" class="btn btn-primary btn-block btn-cs">Choose</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <h4 class="mt-5 mb-4 color-dark-grey">Inspiration</h4>
            <div class="row">
              <div class="col-md-4">
                <div class="mb-3">
                  <img src="images/ddumy.jpg" class="img-fluid" alt="">
                </div>
                <h4>Off the beaten track</h4>
                <p>Here are some of your favourite winter sun destinations</p>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <img src="images/ddumy.jpg" class="img-fluid" alt="">
                </div>
                <h4>Off the beaten track</h4>
                <p>Here are some of your favourite winter sun destinations</p>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <img src="images/ddumy.jpg" class="img-fluid" alt="">
                </div>
                <h4>Off the beaten track</h4>
                <p>Here are some of your favourite winter sun destinations</p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  <!-- Modal Info -->
  <div class="modal fade" id="priceModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-times" aria-hidden="true"></i>
          </button>
          <div class="row m-0 price-lst-table-head">
            <div class="col-6 pl-0">DETAILS</div>
            <div class="col-3 text-right">USD</div>
            <div class="col-3 pr-0 text-right">ZAR</div>
          </div>
          <div class="row m-0 list-prs">
            <div class="col-6 pl-0"><a href="#" class="btn-prc-title" data-price="#pr-1">Subtotal for
                7
                nights <span class="arrow-down"></span></a></div>
            <div class="col-3 text-right">$2,250</div>
            <div class="col-3 pr-0 text-right">R33,202</div>
            <div class="col-12 sub-price-content" id="pr-1">
              <div class="row subs-price">
                <div class="col-6">February 19, 2020</div>
                <div class="col-3 text-right">$375</div>
                <div class="col-3 text-right pr-0">R5,534</div>
              </div>
              <div class="row subs-price">
                <div class="col-6">February 19, 2020</div>
                <div class="col-3 text-right">$375</div>
                <div class="col-3 text-right pr-0">R5,534</div>
              </div>
              <div class="row subs-price">
                <div class="col-6">February 19, 2020</div>
                <div class="col-3 text-right">$375</div>
                <div class="col-3 text-right pr-0">R5,534</div>
              </div>
              <div class="row subs-price">
                <div class="col-6">February 19, 2020</div>
                <div class="col-3 text-right">$375</div>
                <div class="col-3 text-right pr-0">R5,534</div>
              </div>
            </div>
          </div>
          <div class="row m-0 list-prs">
            <div class="col-6 pl-0"><a href="#" class="btn-prc-title" data-price="#pr-2">Hotel
                taxes & fees <span class="arrow-down"></span></a></div>
            <div class="col-3 text-right">$2,250</div>
            <div class="col-3 pr-0 text-right">R33,202</div>
            <div class="col-12 sub-price-content" id="pr-2">
              <div class="row subs-price">
                <div class="col-6">February 19, 2020</div>
                <div class="col-3 text-right">$375</div>
                <div class="col-3 text-right pr-0">R5,534</div>
              </div>
              <div class="row subs-price">
                <div class="col-6">February 19, 2020</div>
                <div class="col-3 text-right">$375</div>
                <div class="col-3 text-right pr-0">R5,534</div>
              </div>
              <div class="row subs-price">
                <div class="col-6">February 19, 2020</div>
                <div class="col-3 text-right">$375</div>
                <div class="col-3 text-right pr-0">R5,534</div>
              </div>
              <div class="row subs-price">
                <div class="col-6">February 19, 2020</div>
                <div class="col-3 text-right">$375</div>
                <div class="col-3 text-right pr-0">R5,534</div>
              </div>
            </div>
          </div>
          <div class="row m-0 list-prs">
            <div class="col-6 pl-0">Total with taxes & fees</div>
            <div class="col-3 text-right">$2,250</div>
            <div class="col-3 pr-0 text-right">R33,202</div>
          </div>
          <div class="row m-0 mt-2 txt-do">
            <div class="col-12 pl-0">
              *All hotel prices are based on local currency. <br>
              Guests may be subject to additional fees and taxes.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Info End -->    
    
@endsection