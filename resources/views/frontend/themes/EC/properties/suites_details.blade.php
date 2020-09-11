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
                  
        
                    <ul class="nav flex-column nav-sidebar is-small onstick wow fadeInUp" data-wow-delay=".3s">
                      <li class="nav-item">
                        <a href="#">
                          <i class="ico ico-back mb-4"></i>
                        </a>
                      </li>
                      <li class="nav-item">                        
                        <a class="nav-link" data-toggle="collapse" href="#" data-target="#suite" role="button" aria-expanded="false" aria-controls="suite"> Suites</a>
                        <div class="collapse show" id="suite">
                          <ul class="nav flex-column nav-sidebar is-small">
                            <?php
                            if(!empty($ptypes)){                                
                                foreach($ptypes as $ptdata){
                            ?>
                                   <li class="nav-item">
                                      <a class="nav-link nav-link-sub" href="{{Url::to('/')}}{{$props->property_slug}}/{{$ptdata->category_name}}">{{$ptdata->category_name}}</a>
                                   </li>            
                            <?php                
                                }                                
                            }
                            ?>                            
                          </ul>
                        </div>
                      </li>
                      @if($props->architecture_title!='' && $props->architecture_desciription!='')
                      <li class="nav-item">
                        <a class="nav-link " href="architecture.html">Architecture</a>
                      </li>
                      @endif
                      @if($props->spa_ids!='')
                      <li class="nav-item">
                        <a class="nav-link " href="spa.html">Spa & Wellness </a>
                      </li>
                      @endif
                      @if($props->restaurant_ids!='')
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
                  <div class="container">
                    <div class="slider-container hotel-page-list">
                      <a href="#">
                        <i class="ico ico-diamon diamon-label"></i>
                      </a>
                      <div class="slider-detail">
                        @if(!empty($suitedata))
                            @foreach($suitedata['imgs'] as $sdata)
                                <div class="slider-item">
                                  <img src="{{$suitedata['imgsrc']}}/{{$sdata->file_name}}" class="img-fluid" alt="">
                                </div>
                            @endforeach
                        @endif                        
                      </div>
                      <div class="prev"><i class="ico ico-back"></i></div>
                      <div class="next"><i class="ico ico-next"></i></div>
                      <div class="hotel-meta">
                        <a data-toggle="collapse" href="#view-detail" role="button" aria-expanded="false" aria-controls="view-deal" class="view more">
                          VIEW DETAILS
                        </a>
                        <div class="hotel-title">
                          <p class="mb-0">2 Bedrooms</p>
                          <p class="mb-0 inc">Includes</p>
                        </div>
                        <div class="hotel-prices hotel-price-detail">
                          <div class="row align-items-center justify-content-center">
                            <h3 class="mb-0">
                              â‚¬ 1.299
                            </h3>
                            <div class="ml-1">
                              <i class="ico ico-info-green pointer" type="button" data-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="view-deal" data-target="#price-detail"></i>
                            </div>
                            <div class="ml-2">
                              <span class="pernight"></span>
                            </div>
                          </div>
                          <p><i><b>Includes breakfast</b></i></p>
                        </div>
                        <div class="action-hotel">
                          <a data-toggle="collapse" href="#view-deal" role="button" aria-expanded="false"
                            aria-controls="view-deal">View Deals</a>
                          | <a href="#">Add to Favorite</a> | <a href="#">Book this Suite</a>
                        </div>
                      </div>
                    </div>
                    <div class="collapse mb-5" id="view-detail">
                      <div class="card">
                        <div class="row suite-board-body">
                          <div class="col-4 suite-price-feature">
                            <div class="suite-board-main">
                              <h4>Breakfast on the Amalfi Coast </h4>
                              <ul class="pl-3">
                                <li>Accommodation</li>
                                <li>Daily breakfast</li>
                              </ul>
                            </div>
                            <div class="suite-board-footer">
                              <div class="collapse" id="breakfas">
                                <div class="card card-body border-0">
                                  <h4 class="mb-4">Details &amp; Policies</h4>
                                  <ul class="text-left pl-3">
                                    <li>
                                      CANCEL: <br>
                                      Cancel by 12PM local time 24 hours prior to arrival or
                                      pay 1 night plus tax
                                    </li>
                                    <li>
                                      GUARANTEE: <br>
                                      A credit card guarantee is required at time of booking
                                      unless otherwise stated in the rate description.
                                    </li>
                                    <li>
                                      MEAL PLAN: <br>
                                      Breakfast included
                                    </li>
                                    <li>
                                      SERVICE CHARGE: <br>
                                      Rates shown are inclusive of 10 percent Service Charge
                                      per room, per night. This will appear itemized in your
                                      shopping basket.
                                    </li>
                                    <li>
                                      GOVERNMENT TAX: <br>
                                      Rates shown are inclusive of 10 percent Government Tax
                                      per room, per night. This will appear itemized in your
                                      shopping basket.
                                    </li>
                                    <li>
                                      GOVERNMENT TAX AND SERVICE CHARGE: <br>
                                      Room rates do not include 11 percent Government Tax and
                                      10 percent Service Charge
                                    </li>
                                    <li>
                                      PACKAGE GOVERNMENT TAX: <br>
                                      Room rates do not include 10% Government Tax
                                    </li>
                                  </ul>
                                </div>
                              </div>
                              <a class="detail-policies" data-toggle="collapse" href="#breakfas" role="button"
                                aria-expanded="false" aria-controls="breakfas">Details
                                &amp; Policies</a>
                              <div class="footer-sdse">
                                <p>â‚¬1.099 per night inclusive of all taxes and fees</p>
                                <a href="#" class="btn btn-dark  btn-block rounded-0">Select</a>
                              </div>
                            </div>
                          </div>
                          <div class="col-4 suite-price-feature">
                            <div class="suite-board-main">
                              <h4>Half Board</h4>
                              <ul class="pl-3">
                                <li>Accommodation</li>
                                <li>Daily breakfast</li>
                                <li>Daily Ã  la carte lunch or dinner </li>
                                <li>Accommodation</li>
                                <li>Daily breakfast</li>
                                <li>Daily Ã  la carte lunch or dinner </li>
                              </ul>
                            </div>
                            <div class="suite-board-footer">
                              <div class="collapse" id="half">
                                <div class="card card-body border-0">
                                  <h4 class="mb-4">Details &amp; Policies</h4>
                                  <ul class="text-left pl-3">
                                    <li>
                                      CANCEL: <br>
                                      Cancel by 12PM local time 24 hours prior to arrival or
                                      pay 1 night plus tax
                                    </li>
                                    <li>
                                      GUARANTEE: <br>
                                      A credit card guarantee is required at time of booking
                                      unless otherwise stated in the rate description.
                                    </li>
                                    <li>
                                      MEAL PLAN: <br>
                                      Breakfast included
                                    </li>
                                    <li>
                                      SERVICE CHARGE: <br>
                                      Rates shown are inclusive of 10 percent Service Charge
                                      per room, per night. This will appear itemized in your
                                      shopping basket.
                                    </li>
                                    <li>
                                      GOVERNMENT TAX: <br>
                                      Rates shown are inclusive of 10 percent Government Tax
                                      per room, per night. This will appear itemized in your
                                      shopping basket.
                                    </li>
                                    <li>
                                      GOVERNMENT TAX AND SERVICE CHARGE: <br>
                                      Room rates do not include 11 percent Government Tax and
                                      10 percent Service Charge
                                    </li>
                                    <li>
                                      PACKAGE GOVERNMENT TAX: <br>
                                      Room rates do not include 10% Government Tax
                                    </li>
                                  </ul>
                                </div>
                              </div>
                              <a class="detail-policies" data-toggle="collapse" href="#half" role="button" aria-expanded="false"
                                aria-controls="half">Details &amp;
                                Policies</a>
                              <div class="footer-sdse">
                                <p>â‚¬1.099 per night inclusive of all taxes and fees</p>
                                <a href="#" class="btn btn-dark  btn-block rounded-0">Select</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="policies p-4" id="policies">
                          <h3>Policies</h3>
                          <div class="card card-body rounded-0">
                            <p><b>Suite 1</b></p>
                            <p><b>CANCEL</b> Cancel by 1pm local time 72 hours prior or pay 1 night for
                              every 3 nights booked plus tax. No show charged full stay.</p>
                            <p><b>GUARANTEE</b> A credit card guarantee is required at time of booking
                              unless otherwise started in the rate description.</p>
                            <p><b>MEAL PLAN</b> Breakfast included</p>
                            <p><b>VAT TAX</b> Rates shown are inclusive of 10 percent VAT Tax per room, per
                              night. this will appear itemized in your shopping basket.</p>
                            <p><b>CITY TAX</b> Rates shown are inclusive of EUR 5 city Tax per person, per
                              night for persons 8 years and older for up to 10 nights. Seasonal
                              adjustments may apply. This will appear itemized in your shopping basket.
                            </p>
                          </div>
                          <hr>
                          <div class="booking-tearms">
                            <h3>Booking teams and conditions</h3>
                            <div class="custom-control custom-checkbox mb-5">
                              <input type="checkbox" class="custom-control-input" id="customCheck22">
                              <label class="custom-control-label" for="customCheck22">
                                Your reservation is made subject to our
                                <a href="#" class="underline"><b>Terms &amp; Conditions</b> </a>(available
                                in other
                                languages <a href="#" class="underline"><b>here</b></a>), and the
                                specific
                                payment tearms (deposit, tax and cancellation) set out above, Please
                                check
                                this box to agrree to these tearms and proceed with your booking. By
                                confirming your booking, you agree with all provisions of the
                                <a href="#" class="underline"><b>privacy policy</b></a>
                              </label>
                            </div>
                            <p>
                              For further information about how we use your data, please see our
                              <a href="#" class="underline"><b>privacy policy</b></a>
                            </p>
                          </div>
                          <div class="row">
                            <div class="col-6">
                              <a href="#" class="btn btn-dark  px-5 btn-backwizard">Go back</a>
                            </div>
                            <div class="col-6 text-right">
                              <a href="#" class="btn btn-dark  px-5 btn-nextwizard">Confirm
                                booking</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="collapse mb-5" id="view-deal">
                      <div class="card p-5">
                        <h3 class="mb-4 color-dark-grey ">Add additional services</h3>
                        <div class="accordion accordion-ex" id="accordionExample">
                          <div class="card">
                            <div class="card-header" id="headingOne">
                              <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                                  data-target="#transfers" aria-expanded="true" aria-controls="transfers">
                                  Transfers
                                  <i class="fa fa-plus"></i>
                                  <i class="fa fa-minus" style="display: none"></i>
                                </button>
                              </h2>
                            </div>
                            <div id="transfers" class="collapse additional-collapse" aria-labelledby="headingOne"
                              data-parent="#accordionExample">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-4 mb-4">
                                    <div class="additional-list p-0">
                                      <div class="inner-wrapper mb-3">
                                        <div class="pr-lst result-grid">
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="p-4">
                                        <div class="add-txt">
                                          <h4 class="mb-4 added">Added to booking</h4>
                                          <h4 class="mb-4 title-additional-list">ONE WAY AIRPORT TRANSFER</h4>
                                          <p class="mb-4">
                                            Transfer to or from Ngurah Rai International Airport by
                                            private car. Suitable for up to four guests. Tax and
                                            service
                                            charge are not included. Price shown is for up to 4
                                            guests.
                                          </p>
                                        </div>
                                        <div class="booking-qty">
                                          <p class="qty-label">Quantity</p>
                                          <div class="qty-button mb-4">
                                            <button type="button" id="sub" class="sub btn-qty">-</button>
                                            <input class="form-qty" type="number" id="1" value="1" min="1" />
                                            <button type="button" id="add" class="add btn-qty">+</button>
                                          </div>
                                          <p class="qty-label">â‚¬16.00</p>
                                        </div>
                                        <div class="confirm-qty">
                                          <i class="fa fa-check" aria-hidden="true"></i>
                                        </div>
        
                                        <a href="#" class="btn btn-dark rounded-0 booking-select">Select</a>
                                        <a href="#" class="btn-red-link mt-2 remove-booking">Remove from booking</a>
        
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-4 mb-4">
                                    <div class="additional-list p-0">
                                      <div class="inner-wrapper mb-3">
                                        <div class="pr-lst result-grid">
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="p-4">
                                        <div class="add-txt">
                                          <h4 class="mb-4 added">Added to booking</h4>
                                          <h4 class="mb-4 title-additional-list">ROUNDTRIP AIRPORT TRANSFER</h4>
                                          <p class="mb-4">
                                            Relax with transfers to and from Ngurah Rai
                                            International
                                            Airport by private car. Suitable for up to four guests.
                                            Tax
                                            and service charge are not included. Price shown is for
                                            up
                                            to 4 guests.
                                          </p>
                                        </div>
                                        <div class="booking-qty">
                                          <p class="qty-label">Quantity</p>
                                          <div class="qty-button mb-4">
                                            <button type="button" id="sub" class="sub btn-qty">-</button>
                                            <input class="form-qty" type="number" id="1" value="1" min="1" />
                                            <button type="button" id="add" class="add btn-qty">+</button>
                                          </div>
                                          <p class="qty-label">â‚¬16.00</p>
                                        </div>
                                        <div class="confirm-qty">
                                          <i class="fa fa-check" aria-hidden="true"></i>
                                        </div>
        
                                         <a href="#" class="btn btn-dark rounded-0 booking-select">Select</a>
                                        <a href="#" class="btn-red-link mt-2 remove-booking">Remove from booking</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" id="headingTwo">
                              <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                                  data-target="#inroom-amenities" aria-expanded="false" aria-controls="inroom-amenities">
                                  In-Room Amenities
                                  <i class="fa fa-plus"></i>
                                  <i class="fa fa-minus" style="display: none"></i>
                                </button>
                              </h2>
        
                            </div>
                            <div id="inroom-amenities" class="collapse additional-collapse" aria-labelledby="headingTwo"
                              data-parent="#accordionExample">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-4 mb-4">
                                    <div class="additional-list p-0">
                                      <div class="inner-wrapper mb-3">
                                        <div class="pr-lst result-grid">
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="p-4">
                                        <div class="add-txt">
                                          <h4 class="mb-4 added">Added to booking</h4>
                                          <h4 class="mb-4 title-additional-list">BOTTLE OF ROSE BALINESE WINE</h4>
                                          <p class="mb-4">
                                            Find a bottle of sparkling Balinese rosÃ© in your room,
                                            awaiting your arrival.
                                          </p>
                                        </div>
                                        <div class="booking-qty">
                                          <p class="qty-label">Quantity</p>
                                          <div class="qty-button mb-4">
                                            <button type="button" id="sub" class="sub btn-qty">-</button>
                                            <input class="form-qty" type="number" id="1" value="1" min="1" />
                                            <button type="button" id="add" class="add btn-qty">+</button>
                                          </div>
                                          <p class="qty-label">â‚¬16.00</p>
                                        </div>
                                        <div class="confirm-qty">
                                          <i class="fa fa-check" aria-hidden="true"></i>
                                        </div>
        
                                         <a href="#" class="btn btn-dark rounded-0 booking-select">Select</a>
                                        <a href="#" class="btn-red-link mt-2 remove-booking">Remove from booking</a>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-4 mb-4">
                                    <div class="additional-list p-0">
                                      <div class="inner-wrapper mb-3">
                                        <div class="pr-lst result-grid">
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="p-4">
                                        <div class="add-txt">
                                          <h4 class="mb-4 added">Added to booking</h4>
                                          <h4 class="mb-4 title-additional-list">BALINESE ORNAMENTAL BAMBOO POLE</h4>
                                          <p class="mb-4">
                                            Delight someone special with this unique Balinese
                                            handcrafted penjor, a wonderful souvenir.
                                          </p>
                                        </div>
                                        <div class="booking-qty">
                                          <p class="qty-label">Quantity</p>
                                          <div class="qty-button mb-4">
                                            <button type="button" id="sub" class="sub btn-qty">-</button>
                                            <input class="form-qty" type="number" id="1" value="1" min="1" />
                                            <button type="button" id="add" class="add btn-qty">+</button>
                                          </div>
                                          <p class="qty-label">â‚¬16.00</p>
                                        </div>
                                        <div class="confirm-qty">
                                          <i class="fa fa-check" aria-hidden="true"></i>
                                        </div>
        
                                         <a href="#" class="btn btn-dark rounded-0 booking-select">Select</a>
                                        <a href="#" class="btn-red-link mt-2 remove-booking">Remove from booking</a>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-4 mb-4">
                                    <div class="additional-list p-0">
                                      <div class="inner-wrapper mb-3">
                                        <div class="pr-lst result-grid">
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="p-4">
                                        <div class="add-txt">
                                          <h4 class="mb-4 added">Added to booking</h4>
                                          <h4 class="mb-4 title-additional-list">ISLAND TROPICAL AMENITY</h4>
                                          <p class="mb-4">
                                            Step into your room and discover a true taste of Bali.
                                            This
                                            welcome platter includes fresh coconuts, seasonal fruit
                                            and
                                            assorted local desserts.
                                          </p>
                                        </div>
                                        <div class="booking-qty">
                                          <p class="qty-label">Quantity</p>
                                          <div class="qty-button mb-4">
                                            <button type="button" id="sub" class="sub btn-qty">-</button>
                                            <input class="form-qty" type="number" id="1" value="1" min="1" />
                                            <button type="button" id="add" class="add btn-qty">+</button>
                                          </div>
                                          <p class="qty-label">â‚¬16.00</p>
                                        </div>
                                        <div class="confirm-qty">
                                          <i class="fa fa-check" aria-hidden="true"></i>
                                        </div>
        
                                         <a href="#" class="btn btn-dark rounded-0 booking-select">Select</a>
                                        <a href="#" class="btn-red-link mt-2 remove-booking">Remove from booking</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" id="headingThree">
                              <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                                  data-target="#spa-service" aria-expanded="false" aria-controls="spa-service">
                                  Spa Services
                                  <i class="fa fa-plus"></i>
                                  <i class="fa fa-minus" style="display: none"></i>
                                </button>
                              </h2>
        
                            </div>
                            <div id="spa-service" class="collapse additional-collapse" aria-labelledby="headingThree"
                              data-parent="#accordionExample">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-4 mb-4">
                                    <div class="additional-list p-0">
                                      <div class="inner-wrapper mb-3">
                                        <div class="pr-lst result-grid">
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="p-4">
                                        <div class="add-txt">
                                          <h4 class="mb-4 added">Added to booking</h4>
                                          <h4 class="mb-4 title-additional-list">
                                            TRADITIONAL BALINESE MASSAGE
                                          </h4>
                                          <p class="mb-4">
                                            Relieve tension with a 60-minute traditional massage,
                                            combining long rhythmic strokes with acupressure and
                                            reflexology techniques. Please Note: This is a request
                                            and not a booking, our spa team will contact you to
                                            confirm your desired appointment. Price shown is per
                                            treatment, per person.
                                          </p>
                                        </div>
                                        <div class="booking-qty">
                                          <p class="qty-label">Quantity</p>
                                          <div class="qty-button mb-4">
                                            <button type="button" id="sub" class="sub btn-qty">-</button>
                                            <input class="form-qty" type="number" id="1" value="1" min="1" />
                                            <button type="button" id="add" class="add btn-qty">+</button>
                                          </div>
                                          <p class="qty-label">â‚¬16.00</p>
                                        </div>
                                        <div class="confirm-qty">
                                          <i class="fa fa-check" aria-hidden="true"></i>
                                        </div>
        
                                         <a href="#" class="btn btn-dark rounded-0 booking-select">Select</a>
                                        <a href="#" class="btn-red-link mt-2 remove-booking">Remove from booking</a>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-4 mb-4">
                                    <div class="additional-list p-0">
                                      <div class="inner-wrapper mb-3">
                                        <div class="pr-lst result-grid">
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="p-4">
                                        <div class="add-txt">
                                          <h4 class="mb-4 added">Added to booking</h4>
                                          <h4 class="mb-4 title-additional-list">
                                            ABHYANGA TREATMENT
                                          </h4>
                                          <p class="mb-4">
                                            Achieve inner harmony with this 60-minute massage
                                            ritual. Rhythmic pressure applied with herbal oils
                                            banishes toxins and impurities while boosting
                                            circulation. Please Note: This is a request and not a
                                            booking, our spa team will contact you to confirm your
                                            desired appointment. Price shown is per treatment, per
                                            person.
                                          </p>
                                        </div>
                                        <div class="booking-qty">
                                          <p class="qty-label">Quantity</p>
                                          <div class="qty-button mb-4">
                                            <button type="button" id="sub" class="sub btn-qty">-</button>
                                            <input class="form-qty" type="number" id="1" value="1" min="1" />
                                            <button type="button" id="add" class="add btn-qty">+</button>
                                          </div>
                                          <p class="qty-label">â‚¬16.00</p>
                                        </div>
                                        <div class="confirm-qty">
                                          <i class="fa fa-check" aria-hidden="true"></i>
                                        </div>
        
                                         <a href="#" class="btn btn-dark rounded-0 booking-select">Select</a>
                                        <a href="#" class="btn-red-link mt-2 remove-booking">Remove from booking</a>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-4 mb-4">
                                    <div class="additional-list p-0">
                                      <div class="inner-wrapper mb-3">
                                        <div class="pr-lst result-grid">
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="p-4">
                                        <div class="add-txt">
                                          <h4 class="mb-4 added">Added to booking</h4>
                                          <h4 class="mb-4 title-additional-list">
                                            REFLEXOLOGY FOOT MASSAGE
                                          </h4>
                                          <p class="mb-4">
                                            This 60-minute ancient holistic therapy applies gentle
                                            pressure to points on the feet â€“ as blissful as it is
                                            beneficial. Please Note: This is a request and not a
                                            booking, our spa team will contact you to confirm your
                                            desired appointment. Price shown is per treatment, per
                                            person.
                                          </p>
                                        </div>
                                        <div class="booking-qty">
                                          <p class="qty-label">Quantity</p>
                                          <div class="qty-button mb-4">
                                            <button type="button" id="sub" class="sub btn-qty">-</button>
                                            <input class="form-qty" type="number" id="1" value="1" min="1" />
                                            <button type="button" id="add" class="add btn-qty">+</button>
                                          </div>
                                          <p class="qty-label">â‚¬16.00</p>
                                        </div>
                                        <div class="confirm-qty">
                                          <i class="fa fa-check" aria-hidden="true"></i>
                                        </div>
        
                                         <a href="#" class="btn btn-dark rounded-0 booking-select">Select</a>
                                        <a href="#" class="btn-red-link mt-2 remove-booking">Remove from booking</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" id="headingfour">
                              <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                                  data-target="#experiences" aria-expanded="false" aria-controls="experiences">
                                  Experiences
                                  <i class="fa fa-plus"></i>
                                  <i class="fa fa-minus" style="display: none"></i>
                                </button>
                              </h2>
        
                            </div>
                            <div id="experiences" class="collapse additional-collapse" aria-labelledby="headingfour"
                              data-parent="#accordionExample">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-4 mb-4">
                                    <div class="additional-list p-0">
                                      <div class="inner-wrapper mb-3">
                                        <div class="pr-lst result-grid">
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="p-4">
                                        <div class="add-txt">
                                          <h4 class="mb-4 added">Added to booking</h4>
                                          <h4 class="mb-4 title-additional-list">
                                            TRADITIONAL BALINESE MASSAGE
                                          </h4>
                                          <p class="mb-4">
                                            Relieve tension with a 60-minute traditional massage,
                                            combining long rhythmic strokes with acupressure and
                                            reflexology techniques. Please Note: This is a request
                                            and not a booking, our spa team will contact you to
                                            confirm your desired appointment. Price shown is per
                                            treatment, per person.
                                          </p>
                                        </div>
                                        <div class="booking-qty">
                                          <p class="qty-label">Quantity</p>
                                          <div class="qty-button mb-4">
                                            <button type="button" id="sub" class="sub btn-qty">-</button>
                                            <input class="form-qty" type="number" id="1" value="1" min="1" />
                                            <button type="button" id="add" class="add btn-qty">+</button>
                                          </div>
                                          <p class="qty-label">â‚¬16.00</p>
                                        </div>
                                        <div class="confirm-qty">
                                          <i class="fa fa-check" aria-hidden="true"></i>
                                        </div>
        
                                         <a href="#" class="btn btn-dark rounded-0 booking-select">Select</a>
                                        <a href="#" class="btn-red-link mt-2 remove-booking">Remove from booking</a>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-4 mb-4">
                                    <div class="additional-list p-0">
                                      <div class="inner-wrapper mb-3">
                                        <div class="pr-lst result-grid">
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="p-4">
                                        <div class="add-txt">
                                          <h4 class="mb-4 added">Added to booking</h4>
                                          <h4 class="mb-4 title-additional-list">
                                            ABHYANGA TREATMENT
                                          </h4>
                                          <p class="mb-4">
                                            Achieve inner harmony with this 60-minute massage
                                            ritual. Rhythmic pressure applied with herbal oils
                                            banishes toxins and impurities while boosting
                                            circulation. Please Note: This is a request and not a
                                            booking, our spa team will contact you to confirm your
                                            desired appointment. Price shown is per treatment, per
                                            person.
                                          </p>
                                        </div>
                                        <div class="booking-qty">
                                          <p class="qty-label">Quantity</p>
                                          <div class="qty-button mb-4">
                                            <button type="button" id="sub" class="sub btn-qty">-</button>
                                            <input class="form-qty" type="number" id="1" value="1" min="1" />
                                            <button type="button" id="add" class="add btn-qty">+</button>
                                          </div>
                                          <p class="qty-label">â‚¬16.00</p>
                                        </div>
                                        <div class="confirm-qty">
                                          <i class="fa fa-check" aria-hidden="true"></i>
                                        </div>
        
                                         <a href="#" class="btn btn-dark rounded-0 booking-select">Select</a>
                                        <a href="#" class="btn-red-link mt-2 remove-booking">Remove from booking</a>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-4 mb-4">
                                    <div class="additional-list p-0">
                                      <div class="inner-wrapper mb-3">
                                        <div class="pr-lst result-grid">
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="p-4">
                                        <div class="add-txt">
                                          <h4 class="mb-4 added">Added to booking</h4>
                                          <h4 class="mb-4 title-additional-list">
                                            REFLEXOLOGY FOOT MASSAGE
                                          </h4>
                                          <p class="mb-4">
                                            This 60-minute ancient holistic therapy applies gentle
                                            pressure to points on the feet â€“ as blissful as it is
                                            beneficial. Please Note: This is a request and not a
                                            booking, our spa team will contact you to confirm your
                                            desired appointment. Price shown is per treatment, per
                                            person.
                                          </p>
                                        </div>
                                        <div class="booking-qty">
                                          <p class="qty-label">Quantity</p>
                                          <div class="qty-button mb-4">
                                            <button type="button" id="sub" class="sub btn-qty">-</button>
                                            <input class="form-qty" type="number" id="1" value="1" min="1" />
                                            <button type="button" id="add" class="add btn-qty">+</button>
                                          </div>
                                          <p class="qty-label">â‚¬16.00</p>
                                        </div>
                                        <div class="confirm-qty">
                                          <i class="fa fa-check" aria-hidden="true"></i>
                                        </div>
        
                                         <a href="#" class="btn btn-dark rounded-0 booking-select">Select</a>
                                        <a href="#" class="btn-red-link mt-2 remove-booking">Remove from booking</a>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-4 mb-4">
                                    <div class="additional-list p-0">
                                      <div class="inner-wrapper mb-3">
                                        <div class="pr-lst result-grid">
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="p-4">
                                        <div class="add-txt">
                                          <h4 class="mb-4 added">Added to booking</h4>
                                          <h4 class="mb-4 title-additional-list">
                                            ABHYANGA TREATMENT
                                          </h4>
                                          <p class="mb-4">
                                            Achieve inner harmony with this 60-minute massage
                                            ritual. Rhythmic pressure applied with herbal oils
                                            banishes toxins and impurities while boosting
                                            circulation. Please Note: This is a request and not a
                                            booking, our spa team will contact you to confirm your
                                            desired appointment. Price shown is per treatment, per
                                            person.
                                          </p>
                                        </div>
                                        <div class="booking-qty">
                                          <p class="qty-label">Quantity</p>
                                          <div class="qty-button mb-4">
                                            <button type="button" id="sub" class="sub btn-qty">-</button>
                                            <input class="form-qty" type="number" id="1" value="1" min="1" />
                                            <button type="button" id="add" class="add btn-qty">+</button>
                                          </div>
                                          <p class="qty-label">â‚¬16.00</p>
                                        </div>
                                        <div class="confirm-qty">
                                          <i class="fa fa-check" aria-hidden="true"></i>
                                        </div>
        
                                         <a href="#" class="btn btn-dark rounded-0 booking-select">Select</a>
                                        <a href="#" class="btn-red-link mt-2 remove-booking">Remove from booking</a>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-4 mb-4">
                                    <div class="additional-list p-0-">
                                      <div class="inner-wrapper mb-3">
                                        <div class="pr-lst result-grid">
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="p-4">
                                        <div class="add-txt">
                                          <h4 class="mb-4 added">Added to booking</h4>
                                          <h4 class="mb-4 title-additional-list">
                                            REFLEXOLOGY FOOT MASSAGE
                                          </h4>
                                          <p class="mb-4">
                                            This 60-minute ancient holistic therapy applies gentle
                                            pressure to points on the feet â€“ as blissful as it is
                                            beneficial. Please Note: This is a request and not a
                                            booking, our spa team will contact you to confirm your
                                            desired appointment. Price shown is per treatment, per
                                            person.
                                          </p>
                                        </div>
                                        <div class="booking-qty">
                                          <p class="qty-label">Quantity</p>
                                          <div class="qty-button mb-4">
                                            <button type="button" id="sub" class="sub btn-qty">-</button>
                                            <input class="form-qty" type="number" id="1" value="1" min="1" />
                                            <button type="button" id="add" class="add btn-qty">+</button>
                                          </div>
                                          <p class="qty-label">â‚¬16.00</p>
                                        </div>
                                        <div class="confirm-qty">
                                          <i class="fa fa-check" aria-hidden="true"></i>
                                        </div>
        
                                         <a href="#" class="btn btn-dark rounded-0 booking-select">Select</a>
                                        <a href="#" class="btn-red-link mt-2 remove-booking">Remove from booking</a>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-4 mb-4">
                                    <div class="additional-list p-0">
                                      <div class="inner-wrapper mb-3">
                                        <div class="pr-lst result-grid">
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="p-4">
                                        <div class="add-txt">
                                          <h4 class="mb-4 added">Added to booking</h4>
                                          <h4 class="mb-4 title-additional-list">
                                            ABHYANGA TREATMENT
                                          </h4>
                                          <p class="mb-4">
                                            Achieve inner harmony with this 60-minute massage
                                            ritual. Rhythmic pressure applied with herbal oils
                                            banishes toxins and impurities while boosting
                                            circulation. Please Note: This is a request and not a
                                            booking, our spa team will contact you to confirm your
                                            desired appointment. Price shown is per treatment, per
                                            person.
                                          </p>
                                        </div>
                                        <div class="booking-qty">
                                          <p class="qty-label">Quantity</p>
                                          <div class="qty-button mb-4">
                                            <button type="button" id="sub" class="sub btn-qty">-</button>
                                            <input class="form-qty" type="number" id="1" value="1" min="1" />
                                            <button type="button" id="add" class="add btn-qty">+</button>
                                          </div>
                                          <p class="qty-label">â‚¬16.00</p>
                                        </div>
                                        <div class="confirm-qty">
                                          <i class="fa fa-check" aria-hidden="true"></i>
                                        </div>
        
                                         <a href="#" class="btn btn-dark rounded-0 booking-select">Select</a>
                                        <a href="#" class="btn-red-link mt-2 remove-booking">Remove from booking</a>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-4 mb-4">
                                    <div class="additional-list p-0">
                                      <div class="inner-wrapper mb-3">
                                        <div class="pr-lst result-grid">
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                          <div>
                                            <img src="images/98d13b87078871.5dad9554e33ef.jpg" class="w-100" alt="">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="p-4">
                                        <div class="add-txt">
                                          <h4 class="mb-4 added">Added to booking</h4>
                                          <h4 class="mb-4 title-additional-list">
                                            REFLEXOLOGY FOOT MASSAGE
                                          </h4>
                                          <p class="mb-4">
                                            This 60-minute ancient holistic therapy applies gentle
                                            pressure to points on the feet â€“ as blissful as it is
                                            beneficial. Please Note: This is a request and not a
                                            booking, our spa team will contact you to confirm your
                                            desired appointment. Price shown is per treatment, per
                                            person.
                                          </p>
                                        </div>
                                        <div class="booking-qty">
                                          <p class="qty-label">Quantity</p>
                                          <div class="qty-button mb-4">
                                            <button type="button" id="sub" class="sub btn-qty">-</button>
                                            <input class="form-qty" type="number" id="1" value="1" min="1" />
                                            <button type="button" id="add" class="add btn-qty">+</button>
                                          </div>
                                          <p class="qty-label">â‚¬16.00</p>
                                        </div>
                                        <div class="confirm-qty">
                                          <i class="fa fa-check" aria-hidden="true"></i>
                                        </div>
        
                                         <a href="#" class="btn btn-dark rounded-0 booking-select">Select</a>
                                        <a href="#" class="btn-red-link mt-2 remove-booking">Remove from booking</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="collapse mb-5" id="price-detail">
                      <div class="card">
                        <div class="suite-board-header">
                          <a href="#" class="board-close"><i class="fa fa-times" aria-hidden="true"></i>
                            CLOSE</a>
                          <div class="row align-items-center">
                            <div class="col-2 col---s">
                              <img src="images/car-acc-room-superior-double-inroom-breakfast01_320x266.jpg" class="img-full"
                                alt="">
                            </div>
                            <div class="col">
                              <h3>Superior Double Room Garden or Village View </h3>
                            </div>
                          </div>
                        </div>
                        <div class="p-5">
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
                          <hr>
                          <div class="booking-tearms">
                            <h3><b>Booking teams and conditions</b></h3>
                            <div class="custom-control custom-checkbox mb-5">
                              <input type="checkbox" class="custom-control-input" id="policies43">
                              <label class="custom-control-label" for="policies43">
                                Your reservation is made subject to our
                                <a href="#" class="underline"><b>Terms & Conditions</b> </a>(available
                                in other
                                languages <a href="#" class="underline"><b>here</b></a>), and the
                                specific
                                payment tearms (deposit, tax and cancellation) set out above, Please
                                check
                                this box to agrree to these tearms and proceed with your booking. By
                                confirming your booking, you agree with all provisions of the
                                <a href="#" class="underline"><b>privacy policy</b></a>
                              </label>
                            </div>
                            <p>
                              For further information about how we use your data, please see our
                              <a href="#" class="underline"><b>privacy policy</b></a>
                            </p>
                            <div class="row mt-4">
                              <div class="col-6">
                                <a href="#" class="btn btn-dark  px-5 btn-backwizard">Go back</a>
                              </div>
                              <div class="col-6 text-right">
                                <a href="#" class="btn btn-dark  px-5 btn-nextwizard">Confirm
                                  booking</a>
                              </div>
                            </div>
                          </div>
                        </div>
        
                      </div>
                    </div>
        
                    <div class="row">
                      <div class="col-md-8">
                        <div class="title-main mt-0 mb-5">
                          <h2>{{$props->property_name}}</h2>
                        </div>
                        <h3 class="mb-4 color-dark-grey ">{{$proptype->category_name}}</h3>
                        <p>{{$proptype->room_desc}}</p>
                        <hr>
                        <div class="row">
                          <div class="col-5 ">Size</div>
                          <div class="col-7">43 M2 / 463 sq.ft</div>
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
                          <p>Free cancelation before <b>18 Feb 2020</b></p>
                          <p>Reserve now, pay at the Hotel</p>
                          <a href="#" class="btn btn-dark btn-block btn-sidebar" data-sidebar="#reservation">Reservation</a>
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
                                â‚¬ 1.299
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
                                â‚¬ 1.299
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
                                  â‚¬ 1.299
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