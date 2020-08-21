@extends('frontend.themes.EC.layouts.home')

@section('content')
<form name="collection-search" method="post" action="{{URL::to('globalavailability')}}" id="collection_search">
<div class="where-container show">
    <div class="container-slide-search">
      <div class="form-fl-search">
        <div class="row">
          <div class="col ppls-0">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-ico"><i class="ico ico-search"></i></div>
              </div>
              <input type="text" name="coll_where" class="form-control form-control-em border-0 where" id="inlineFormInputGroup" placeholder="Where">
              <input type="hidden" name="sitename" id="sitename"  />
              <input type="hidden" name="coll_type" id="coll_type" />
              <!--<div class="input-group-prepend">
                <div class="input-group-ico color-search"> <span style="background-color: #00a000;"></span> Create
                  Itinerary ->
                </div>
              </div> -->
            </div>
          </div>
        </div>
        <div class="wherepopup">
          <div class="whereinner">
            <div class="row">
                <div class="col-6">
                    <h2 style="text-transform: uppercase; color: #FFF;">Destinations</h2>
                    <ul class="nav flex-column where-destination">
                        
                      <!--<li class="nav-item">
                        <a class="nav-link" href="#">
                          <span class="city-l">New York</span> <span class="cat-l">Hotels</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">
                          <span class="city-l">New York</span> <span class="cat-l">Map</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">
                          <span class="city-l">New York</span> <span class="cat-l">Private Jet</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">
                          <span class="city-l">New York</span> <span class="cat-l">Cuisine</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">
                          <span class="city-l">New York</span> <span class="cat-l">Channel</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">
                          <span class="city-l">New York</span> <span class="cat-l">Experiences</span>
                        </a>
                      </li>-->
                    </ul>
                </div>
                <div class="col-6">
                    <h2 style="text-transform: uppercase; color: #FFF;">Hotels</h2>
                    <ul class="nav flex-column where-hotel">
                           
                    </ul>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="owl-carousel owl-theme landing-slider ">
      @if(!empty($slider))
        @foreach($slider as $key => $slider_row)
            <div class="item">
                <img src="{{url('uploads/slider_images/'.$slider_row->slider_img)}}" alt="">
            </div>    
        @endforeach
      @endif
      
      <!--<div class="item">
        <img src="{{ asset('themes/EC/images/ecd67d87075247.5dad757ad6705.jpg') }}" alt="">
      </div>
      <div class="item">
        <img src="{{ asset('themes/EC/images/c52c5d91609529.5e36922fbff23.jpg') }}" alt="">
      </div>
      <div class="item">
        <img src="{{ asset('themes/EC/images/60c5a787075247-1.5dad757ad76ab.jpg') }}" alt="">
      </div>-->
    </div>
  </div>
  
  <div class="when-container">
    <div class="content-em">
      <div class="container-fluid is-lg-full pt-5">
        <div class="row">
          <div class="col-6">
            <div class="is-left-pad">
              <!--<div class="back">
                <i class="ico ico-back mb-4"></i>
              </div>-->
              <div class="title-with-icon">
                <i class="ico ico-calendar"></i>
                <h2>When</h2>
              </div>
              <div class="range-calendar" id="calendar-pick">
                <div id="daterangepicker-inline-container" class="daterangepicker-inline"></div>
                <input type="hidden" id="daterangepicker-inline">
                <input type="hidden" name="gl_arrive" /> 
                <input type="hidden" name="gl_departure" />
                <div class="clearfix"></div>
              </div>
              <div class="search-results">
                <h4>Your Selection</h4>
                <p>New York . -> <span class="onrange"></span></p>
              </div>
              <div class="mt-5 include-form">
                <!-- <div id="accordion">
                  <div class="accor">
                    <div class="accor-header" id="headingOne">
                      <div class="row align-items-center include-list">
                        <div class="col pr-0">
                          <div class="include">
                            <p class="inc-t">Include</p>
                            <p class="inc-f">Flight</p>
                            <p class="inc-s">Search</p>
                          </div>
                        </div>
                        <div class="col text-center">
                          <i class="ico-flight"></i>
                        </div>
                        <div class="col text-center">
                          <label class="container-checkbox mb-0 collapsed" data-toggle="collapse"
                            data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                          </label>
                        </div>
                      </div>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne">
                      <div class="accor-body">
                        <div class="d-flex align-items-center">
                          <div class="lolsp">
                            <div class="form-asd">Departing From :</div>
                          </div>
                          <div class="pl-3">
                            <input type="text" class="form-control">
                          </div>
                        </div>
                        <div class="d-flex align-items-center">
                          <div class="lolsp">
                            <div class="form-asd">Select Airport :</div>
                          </div>
                          <div class="pl-3">
                            <input type="text" class="form-control">
                          </div>
                        </div>
                        <div class="d-flex align-items-center">
                          <div class="lolsp">
                            <div class="form-asd">Select Guest :</div>
                          </div>
                          <div class="pl-3">
                            <input type="text" class="form-control">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="accor">
                    <div class="accor-header" id="headingTwo">
                      <div class="row align-items-center include-list">
                        <div class="col">
                          <div class="include">
                            <p class="inc-t">Include</p>
                            <p class="inc-f">Yacht</p>
                            <p class="inc-s">Search</p>
                          </div>
                        </div>
                        <div class="col text-center">
                          <i class="ico-yacht"></i>
                        </div>
                        <div class="col text-center">
                          <label class="container-checkbox mb-0 collapsed" data-toggle="collapse"
                            data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo">
                      <div class="accor-body">
                        <div class="d-flex align-items-center">
                          <div class="lolsp">
                            <div class="form-asd">Departing From :</div>
                          </div>
                          <div class="pl-3">
                            <input type="text" class="form-control">
                          </div>
                        </div>
                        <div class="d-flex align-items-center">
                          <div class="lolsp">
                            <div class="form-asd">Select Airport :</div>
                          </div>
                          <div class="pl-3">
                            <input type="text" class="form-control">
                          </div>
                        </div>
                        <div class="d-flex align-items-center">
                          <div class="lolsp">
                            <div class="form-asd">Select Guest :</div>
                          </div>
                          <div class="pl-3">
                            <input type="text" class="form-control">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="accor">
                    <div class="accor-header" id="headingThree">
                      <div class="row align-items-center include-list">
                        <div class="col">
                          <div class="include">
                            <p class="inc-t">Include</p>
                            <p class="inc-f">Limosine</p>
                            <p class="inc-s">Search</p>
                          </div>
                        </div>
                        <div class="col text-center">
                          <i class="ico-limosine"></i>
                        </div>
                        <div class="col text-center">
                          <label class="container-checkbox mb-0 collapsed" data-toggle="collapse"
                            data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree">
                      <div class="accor-body">
                        <div class="d-flex align-items-center">
                          <div class="lolsp">
                            <div class="form-asd">Departing From :</div>
                          </div>
                          <div class="pl-3">
                            <input type="text" class="form-control">
                          </div>
                        </div>
                        <div class="d-flex align-items-center">
                          <div class="lolsp">
                            <div class="form-asd">Select Airport :</div>
                          </div>
                          <div class="pl-3">
                            <input type="text" class="form-control">
                          </div>
                        </div>
                        <div class="d-flex align-items-center">
                          <div class="lolsp">
                            <div class="form-asd">Select Guest :</div>
                          </div>
                          <div class="pl-3">
                            <input type="text" class="form-control">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> -->
                <div class="guest-pick-footer mb-5 mt-4 pr-3">
                  <div class="text-right">
                    <a href="#" class="confirm-room confirm-room-when step-3 link-primary">Submit</a>
                  </div>
                </div>

                
              </div>
            </div>
          </div>
          <div class="col-6 pl-0 pr--md-0">
            <div class="img-left-when">
              <img src="{{ asset('themes/EC/images/af407b90485625.5e186bd4ca52b.jpg') }}" id="left-when-featured-img1" alt="">
            </div>

            <div class="fetaruer">
              <h3 class="title-3 title-i">- featured hotel -</h3>
              <h3 class="title-3 title-i when-hotel-name"></h3>
              <p class="font-2">
                <i>
                    <div id="left-when-featured-text">
                      Think about New York of the 1980s with its large artwork, early hip hop, and punk rock scenes. Then
                      translate that vitality to a lodge on the Decrease East Aspect. Put collectively you get The Ludlow
                      Resort.
                    </div>
                </i>
              </p>
            </div>
            
            <div class="herl">
                <div class="quick-prev-when when-quick-prev">
                    <div>
                        <img src="{{ asset('themes/EC/images/5ac27a91813631.5e3b3fe359ee2.jpg') }}" class="img-fluid" alt="" >
                    </div>
                </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="who-container">
    <div class="content-em">
      <div class="container-fluid is-lg-full pt-5">
        <div class="row">
          <div class="col-6">
            <div class="is-left-pad">
              <div class="title-with-icon">
                <i class="ico ico-profile-pp"></i>
                <h2>WHO</h2>
              </div>
              <div class="filter-container-fl filter-guest-2" id="guest-pick" style="display: block;">
                <div class="guest-pick-container">
                  <div class="guest-pick-header">
                    <div class="row align-items-center">
                      <div class="col-9">
                        <p class="mb-0"><b>Suites</b></p>
                      </div>
                      <div class="col-3">
                        <div class="row field-count-guest align-items-center">
                          <button type="button" class="min-room disable">-</button>
                          <div class="col text-center">
                            <span class="mr-1 room-val">1 </span>
                          </div>
                          <button type="button" class="plus-room mr-3">+</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="guest-pick-body">
                    <div class="row list-eoom">
                      <div class="col-12 col-ews mb-5" id="room-1">
                        <p><b>Suite 1</b></p>
                        <div class="row align-items-center py-2">
                          <div class="col-7">
                            <p class="mb-0"><b>Adults</b></p>
                          </div>
                          <div class="col-5">
                            <div class="row field-count-guest align-items-center">
                              <button type="button" class="min">-</button>
                              <div class="col text-center">
                                <span class="mr-1 adult-val">1 </span>
                                <input type="hidden" name="rooms[]"  />
                                <input type="hidden" name="adult[]" class="inp-adult" value="1" />
                              </div>
                              <button type="button" class="plus mr-3">+</button>
                            </div>
                          </div>
                        </div>
                        <div class="row align-items-center py-2">
                          <div class="col-7">
                            <p class="mb-0"><b>Children</b></p>
                          </div>
                          <div class="col-5">
                            <div class="row field-count-guest align-items-center">
                              <button type="button" class="min">-</button>
                              <div class="col text-center">
                                <span class="mr-1 child-val">1 </span>
                                <input type="hidden" name="child[]" class="inp-child" value="1" />
                              </div>
                              <button type="button" class="plus mr-3">+</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="guest-pick-footer">
                    <div class="text-right">
                      <a href="#" class="confirm-room confirm-room-submit">Confirm my Suite(s)</a>
                    </div>
                  </div>
                </div>

                <div class="oldo-o">
                  <div class="quick-prev who-quick-prev">
                    <!--<div>
                      <img src="{{ asset('themes/EC/images/d9710383434639.5d3c346168dd3.jpg') }}" class="img-fluid" alt="">
                    </div>
                    <div>

                      <img src="{{ asset('themes/EC/images/d9710383434639.5d3c346168dd3.jpg') }}" class="img-fluid" alt="">
                    </div>
                    <div>
                      <img src="{{ asset('themes/EC/images/d9710383434639.5d3c346168dd3.jpg') }}" class="img-fluid" alt="">
                    </div> -->
                  </div>
                </div>
              </div>

            </div>
          </div>
          <div class="col-6 pl-0 pr--md-0">
            <div class="img-left-when">
              <img src="{{ asset('themes/EC/images/60c5a787075247-1.5dad757ad76ab.jpg') }}" id="left-who-featured-img1" alt="">
            </div>

            <div class="fetaruer to-right">
              <h3 class="title-3 title-i">- featured hotel -</h3>
              <h3 class="title-3 title-i who-hotel-name"></h3>
              <p class="font-2">
                <i>
                    <div id="left-who-featured-text">
                      Think about New York of the 1980s with its large artwork, early hip hop, and punk rock scenes. Then
                      translate that vitality to a lodge on the Decrease East Aspect. Put collectively you get The Ludlow
                      Resort.
                    </div>
                </i>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </form>
@endsection