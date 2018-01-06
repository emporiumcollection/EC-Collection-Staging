<div class="header container-fluid">
    <div class="col-md-12">
        <div class="header-logo">
            <a href="{{url()}}">
                <img src="{{ asset('sximo/assets/images/logo-design_1.png')}}" class="img-responsive" alt="EMPORIUM VOYAGE"/>
            </a>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="header-navigation-container col-md-12">
                <div class="row">
                    <div class="col-md-0"></div>
                    <div class="col-md-3 col-sm-2 header-text-align">
                        <!-- <div class="hotel-select-breadcrumb">
                             <span>Dream Collection </span>
                             <p>Villa Orsula Dubrovnik</p>
                         </div>-->
                    </div>
                    <div class="col-md-7 col-sm-8">
                        @include('layouts/elliot/ai_navigation')
                    </div>

                    <div class="col-md-2">
                        <div class="row res-margin-align">
                            <div id="mySidenav" class="sidenav">
                                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                                <a href="{{url()}}/filters-grid">HOTELS</a>
                                <a href="{{url()}}/filters-grid">EXPERIENCE</a>
                                <!--<a href="{{url()}}/content-grid-shuffle">MAGAZINE</a>-->
                                <a href="{{url()}}/filters-grid">VILLAS</a>
                                <a href="{{url()}}/filters-grid">YACHTS</a>
                            </div>
                            <span class="hamburger-menu"  onclick="openNav()"><img src="{{ asset('sximo/assets/images/Hamburger-Menu.png')}}" alt="EMPORIUM VOYAGE"/></span>
                        </div>
                    </div>
                    <a class="book-now trigger-booking" href="#">Book your stay</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="sticky-header-offset"></div>