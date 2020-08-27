<header>
  <div class="container-fluid pt-3 header-container">

    <div class="row align-items-end">
      <div class="col-12">
        <div class="dropdown top-menu-s">
          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Edition <span><b>Germany</b></span>
          </a>

          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
            <div class="row">
              <div class="col-3">
                <a class="dropdown-item" href="#">Action<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                <a class="dropdown-item" href="#">Another<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                <a class="dropdown-item" href="#">Something<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
              </div>
              <div class="col-3">
                <a class="dropdown-item" href="#">Action<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                <a class="dropdown-item" href="#">Another<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                <a class="dropdown-item" href="#">Something<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
              </div>
              <div class="col-3">
                <a class="dropdown-item" href="#">Action<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                <a class="dropdown-item" href="#">Another<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                <a class="dropdown-item" href="#">Something<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
              </div>
              <div class="col-3">
                <a class="dropdown-item" href="#">Action<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                <a class="dropdown-item" href="#">Another<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                <a class="dropdown-item" href="#">Something<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-5">
        <div id="menunav">
          <a href="#dashF" class="mr-2 menu-nav grid-f" data-toggle="collapse" role="button" aria-expanded="false"
            aria-controls="dashF">
            <i class="ico ico-dash"></i>
          </a>
          <a href="#searchF" class="menu-nav search-f" data-toggle="collapse" role="button" aria-expanded="false"
            aria-controls="searchF">
            <i class="ico ico-search"></i>
          </a>
          <a href="#cityList" class="menu-nav text-menu city-f" data-toggle="collapse" role="button"
            aria-expanded="false" aria-controls="cityList">
            <span class="label-city" style="background: green;"></span> {{--$keyword--}}
          </a>
          <a href="#calcF" class="menu-nav text-menu cal-f" data-toggle="collapse" role="button" aria-expanded="false"
            aria-controls="calcF">
            <span class="cal-date"></span>
          </a>
          <a href="#whoF" class="menu-nav text-menu who-f" data-toggle="collapse" role="button" aria-expanded="false"
            aria-controls="whoF">
            <div class="filter-lst expand filter-guest filter-white">
              <div class="input-group">
                <div class="gust-dropdown">
                  <div class="guest-option rto"><span class="guest-count">{{--$total_guests--}}</span> Guest</div>
                </div>
              </div>
            </div>
          </a>
          <div class="menunav-group">
            <div class="collapse clp dash-clp" id="dashF" data-parent="#menunav">
              <div class="drop-grid">
                <a href="#">
                  <div class="p-2 d-flex align-items-center">
                    <i class="ico ico-building mr-2"></i> <span>Voyage</span>
                  </div>
                </a>
                <a href="#">
                  <div class="p-2 d-flex align-items-center">
                    <i class="ico ico-safari mr-2"></i> <span>Safari</span>
                  </div>
                </a>
                <a href="#">
                  <div class="p-2 d-flex align-items-center">
                    <i class="ico ico-spa-i mr-2"></i> <span>Spa</span>
                  </div>
                </a>
                <a href="#">
                  <div class="p-2 d-flex align-items-center">
                    <i class="ico ico-islands mr-2"></i> <span>Islands</span>
                  </div>
                </a>
                <a href="#">
                  <div class="p-2 d-flex align-items-center">
                    <i class="ico ico-golf mr-2"></i> <span>Golf</span>
                  </div>
                </a>
              </div>
            </div>
            <div class="collapse clp" id="cityList" data-parent="#menunav">
              <ul class="nav flex-column py-2">
                <li class="nav-item">
                  <a class="nav-link" href="#"><span class="city-name-nav"><span class="label-city"
                        style="background: green;"></span> New York</span>. -> 2.6.20 -> 15.6.20</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#"><span class="city-name-nav"><span class="label-city"
                        style="background: red;"></span> San Diego</span>. -> 3.7.20 -> 5.7.20</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#"><span class="city-name-nav"><span class="label-city"
                        style="background: blue;"></span> San Francisco</span>. -> 12.8.20 -> 16.8.20</a>
                </li>
              </ul>
            </div>

            <div class="collapse clp" id="searchF" data-parent="#menunav">
              <div class="search-field">
                <div class="row">
                  <div class="col">
                    <div class="input-group align-items-center">
                      <div class="input-group-prepend">
                        <i class="ico ico-search"></i>
                      </div>
                      <input type="text" class="form-control form-control-em border-0 where" id="inlineFormInputGroup"
                        placeholder="Where">
                    </div>
                  </div>
                </div>
                <div class="wherepopup">
                  <div class="whereinner">
                    <ul class="nav flex-column">
                      <li class="nav-item">
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
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <div class="collapse clp" id="calcF" data-parent="#menunav">
              <div id="cal1"></div>
            </div>
            
            <div class="collapse clp" id="whoF" data-parent="#menunav">
              <div class="filter-container-fl filter-container-mm  w-100" id="guest-pick" style="display: block;">
                <div class="guest-pick-container mt-0">
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
                      <div class="col-12 col-ews mb-3" id="room-1">
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
                      <a href="#" class="confirm-room">Confirm my Suite(s)</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
                  
          </div>
        </div>
      </div>
      <div class="col-2 text-center">
        <a href="#">
          <i class="t-logo logo-2"></i>
        </a>
      </div>
      <div class="col-5 text-right">
        <!-- <div class="dropdown dropdown-auth">
          <a href="#" class="text-dark" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="ico ico-club"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
            <div class="dropdown-item">
              <a href="#" class="login-side">Login</a> | <a href="#" class="register-side">Register</a>
            </div>
          </div>
        </div> -->
        <a href="#" class="sidebar-nav">
          <i class="ico ico-club"></i>
        </a>
        <div class="d-flex justify-content-end align-items-center">

          <div class="humburger-menu">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
          </div>
          <div class="menu">
            <a href="#" class="close-menu">
              <svg fill="currentColor" focusable="false" height="40px" viewBox="0 0 24 24" width="24"
                xmlns="http://www.w3.org/2000/svg">
                <title>Close</title>
                <path
                  d="M10.586 12L3.793 5.206a1 1 0 1 1 1.413-1.413L12 10.586l6.794-6.793a1 1 0 1 1 1.413 1.413L13.414 12l6.793 6.794a1 1 0 1 1-1.413 1.413L12 13.414l-6.794 6.793a1 1 0 1 1-1.413-1.413L10.586 12z">
                </path>
              </svg>
            </a>
            <div class="container h-100 d-flex align-items-center">
              <div class="row w-100">
                <div class="col-4">
                  <ul class="nav flex-column nav-sidebar" data-wow-delay=".3s">
                    <?php 
                    $sr = 1;
                    if(!empty($experiences)){
                        foreach($experiences as $exp){
                            if($sr==1){
                    ?>
                                <li class="nav-item">
                                  <a class="nav-link active" href="#">{{ $exp->category_name }}</a>
                                </li>
                    <?php   
                                $sr++;             
                            }else{
                    ?>
                                <li class="nav-item">
                                  <a class="nav-link " href="#">{{ $exp->category_name }}</a>
                                </li>    
                    <?php   
                            }     
                        }                   
                    } 
                    ?>
                    <!--<li class="nav-item">
                      <a class="nav-link active" href="#">Boutique</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Design</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Lifestyle</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Beach</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Cullinary</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Urban</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Infinity</a>
                    </li>-->
                  </ul>

                  <div class="menu-media">
                    <a href="#" class="nav-sos"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    <a href="#" class="nav-sos"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    <a href="#" class="nav-sos"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                  </div>
                </div>
                <div class="col-4">
                  <div class="row">
                    <div class="col-6">
                      <ul class="nav flex-column">
                        <li class="nav-item">
                          <a class="nav-link" href="#">Active <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-6">
                      <ul class="nav flex-column">
                        <li class="nav-item">
                          <a class="nav-link" href="#">Active <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-4">
                  <div class="row">
                    <div class="col-6">
                      <ul class="nav flex-column">
                        <li class="nav-item">
                          <a class="nav-link" href="#">Active <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-6">
                      <ul class="nav flex-column">
                        <li class="nav-item">
                          <a class="nav-link" href="#">Active <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <hr class="mb-0">

    <div class="menu-s">
      <div class="d-flex align-items-center">
        <ul class="nav nav-left">
          <li class="nav-item">
            <a class="nav-link @@activeLoc" href="location-page.html">
              <i class="ico ico-place"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="ico ico-video"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="ico ico-instagram"></i>
            </a>
          </li>
        </ul>
        <ul class="nav nav-text">
          <li class="nav-item">
            <a class="nav-link" href="#">
              Dining
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              Yachts
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              Jet
            </a>
          </li>
        </ul>
        <ul class="nav nav-right ml-auto">
          <li class="nav-item">
            <a class="nav-link @@myLoc" href="my-collections.html">
              <i class="ico ico-diamon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="ico ico-mixer"></i>
            </a>
          </li>
        </ul>
      </div>

    </div>

  </div>
</header>