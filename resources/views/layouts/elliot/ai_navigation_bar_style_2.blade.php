<script src="{{ asset('sximo/assets/js/fliters.js')}}" type="text/javascript"></script>
<script src="{{ asset('sximo/assets/js/moment.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('sximo/assets/js/combodate.js')}}" type="text/javascript"></script>
<div class="header container-fluid" >
    <div class="col-md-12">
        <div class="header-logo">
            <a href="{{url()}}">
                <img src="{{ asset('sximo/assets/images/logo-design_1.png')}}" class="img-responsive" alt="EMPORIUM VOYAGE"/>
            </a>
        </div>
    </div>
    <div class="container" style="display:none;">
        <div class="row">
            <div class="header-navigation-container col-md-12">
                <div class="row">
                    <!--<div class="col-md-1"></div>
                    <div class="col-md-3 col-sm-2 header-text-align">
                        <!-- <div class="hotel-select-breadcrumb">
                             <span>Dream Collection </span>
                             <p>Villa Orsula Dubrovnik</p>
                         </div>-->
                        <!--                        <div>
                                                    <div id="mySidenav" class="sidenav hamburger-menu-left-align">
                                                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                                                        <a href="{{url()}}/filters-grid">HOTELS</a>
                                                        <a href="{{url()}}/filters-grid">EXPERIENCE</a>
                                                        <a href="{{url()}}/content-grid-shuffle">MAGAZINE</a>
                                                        <a href="{{url()}}/filters-grid">VILLAS</a>
                                                        <a href="{{url()}}/filters-grid">YACHTS</a>
                                                    </div>
                                                    <span class="left-hamburger-menu"  onclick="openNav()"><img class="hamburger-menu-align" src="{{ asset('sximo/assets/images/Hamburger-Menu.png')}}" alt=""/></span>
                                                </div>-->
                    <!--</div>
                    <div class="col-md-12 col-sm-12">
                        
                    </div>-->
                    <div class="col-md-2 col-sm-2">
                        <div class="row res-margin-align">
                            <div id="mySidenavpost" class="sidenavpost">
                                <div class="filter-width">
                                    <a href="javascript:void(0)" class="closebtn" onclick="closeNavpost()">&times;</a>
                                    <div class="design-locations-logo">
                                        <a href="{{URL::to('')}}"> <img class="img-responsive" src="{{ asset('sximo/assets/images/design-location-logo.png')}}" alt=""></a>

                                    </div>
                                    <div class="design-locations-logo">
                                        <form autocomplete="off" method="get" id="searchform-navbar" class="searchform-navbar" action="{{URL::to('search')}}">
                                            <input  class="bh-search-input typeahead search-navbar" name="s" id="search-navbar" placeholder="SEARCH" type="text">
                                        </form>
                                    </div>
                                    <div class="panel-group" id="accordion">
                                        <div class="panel panel-default custom-post-panel">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#filter-by-price" class="heading-stying collapsed">
                                                <div class="panel-heading custom-heading">
                                                    Filter BY Price
                                                </div>
                                            </a>
                                            <div id="filter-by-price" class="panel-collapse collapse">
                                                <div class="panel-body custom-panel-body">
                                                    <div class="dl-filter">
                                                        <div class="filter-by-price">
                                                            <div id="slider-range" class="filter-slider"></div>
                                                            <p>  
                                                                <input class="friltered-price" type="text" id="amount" style="border:0; color:#f6931f; font-weight:bold;" />
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default custom-post-panel">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#book-your-destination" class="heading-stying collapsed">
                                                <div class="panel-heading custom-heading">
                                                    Book Your Destination
                                                </div>
                                            </a>
                                            <div id="book-your-destination" class="panel-collapse collapse">
                                                <div class="panel-body custom-panel-body">
                                                    <div class="dl-filter">
                                                        <div>
                                                            <form class="filter-menu-booking">
                                                                <div class="form-group post-filter-inputs">
                                                                    <label>Arrive</label>
                                                                    <input id="filter-date-mobile" data-format="DD-MM-YYYY" data-template="DD MMM YYYY" name="date" value="25-02-2017" type="text">
                                                                </div>
                                                                <div class="form-group post-filter-inputs">
                                                                    <label>Depart</label>
                                                                    <input id="filter-date-mobile-departure" data-format="DD-MM-YYYY" data-template="DD MMM YYYY" name="date" value="30-03-2017" type="text">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default custom-post-panel">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="heading-stying collapsed">
                                                <div class="panel-heading custom-heading">
                                                    Experience
                                                </div>
                                            </a>
                                            <div id="collapse1" class="panel-collapse collapse">
                                                <div class="panel-body custom-panel-body">
                                                    <div class="dl-filter">
                                                        <form>
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a href="{{URL::to('search?s=Beach Hotels')}}">Go EMPORIUM VOYAGE</a></label>
                                                            </div> 
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a href="{{URL::to('search?s=Green Properties')}}">Go Green Hotels</a></label>
                                                            </div> 
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a href="{{URL::to('search?s=Go Urban Hotels')}}">Go Urban Hotels</a></label>
                                                            </div> 
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a href="{{URL::to('search?s=Infinity Pools')}}">Go Infinity Pools</a></label>
                                                            </div>
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a href="{{URL::to('search?s=Spa & Wellness Hotels')}}">Go Spa & Wellness Hotels</a></label>
                                                            </div> 
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a href="{{URL::to('search?s=Mountain  & Ski  Resorts')}}">Go Mountains and Skin Resorts</a></label>
                                                            </div> 
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a href="{{URL::to('search?s=Yoga Hotels')}}">Discover Yoga Hotels</a></label>
                                                            </div> 
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a href="{{URL::to('search?s=Culinary Delights')}}">Discover culinary Delight Hotels</a></label>
                                                            </div>
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a href="{{URL::to('search?s=Family Friendly')}}">Discover Family Friendly Hotels</a></label>
                                                            </div> 
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a href="{{URL::to('search?s=Unusual Adventure Hotels')}}">Unusual Adventure Hotels</a></label>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="selDestn" value="">
										<input type="hidden" id="listrecrds" value="21">
                                        @if(!empty($ourmaindesitnation))
                                        <div class="panel panel-default custom-post-panel">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#maindestinations" class="heading-stying {{($continent!='') ? '' : 'collapsed' }}">
                                                <div class="panel-heading custom-heading">
                                                    Destinations
                                                </div>
                                            </a>
                                            <div id="maindestinations" class="panel-collapse sachin collapse {{($continent!='') ? 'in' : '' }}">
                                                <div class="panel-body custom-panel-body">
                                                    <div class="dl-filter">
                                                        <!--New HTMl Start  Here-->
                                                        <!--First Parent
														@foreach($ourmaindesitnation as $mndest)
															<div class="node post-filter-inputs">
																<a class="node-btn" href="javascript:void(0)" onclick="filter_destination('{{$mndest->id}}','continent');">{{$mndest->category_name}}</a>
																@if(array_key_exists('childs',$mndest))
																	@foreach($mndest->childs as $cddest)
																		<div class="node" style="{{($continent==$mndest->category_name) ? 'display: block; padding-left: 10px; margin-top: 5px; text-transform: inherit;' : '' }}">
																			<a class="node-btn" href="javascript:void(0)" onclick="filter_destination('{{$cddest->id}}','region');">{{$cddest->category_name}}</a>
																			@if(array_key_exists('subchild',$cddest))
																				@foreach($cddest->subchild as $sbdest)
																					<div class="node" style="{{($region==$cddest->category_name) ? 'display: block; padding-left: 10px; margin-top: 5px; text-transform: inherit;' : '' }}">
																						<a class="node-btn" href="javascript:void(0)" onclick="filter_destination('{{$sbdest->id}}','country');">{{$sbdest->category_name}}</a>
																					</div>
																				@endforeach
																			@endif
																		</div>
																	@endforeach
																@endif
															</div>
														@endforeach
														
                                                        <!--New HTMl Start  Here-->
                                                       <!--Old HTMl Start  Here-->
                                                        <form>
                                                            @foreach($ourmaindesitnation as $maindest)
                                                                <div class="form-group post-filter-inputs">
                                                                    <label><input type="checkbox" name="continents[]" value="{{$maindest->category_name}}" {{((isset($selcontinent)) && ($selcontinent==$maindest->category_name)) ? 'checked="checked"' : '' }}> {{$maindest->category_name}}</label>
                                                                </div>
                                                            @endforeach			
                                                        </form>
                                                       Old HTML End  Here
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        
                                       <div class="panel panel-default custom-post-panel">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3" class="heading-stying collapsed">
                                                        <div class="panel-heading custom-heading">
                                                                Filter 3
                                                        </div>
                                                </a>
                                                <div id="collapse3" class="panel-collapse collapse">
                                                        <div class="panel-body custom-panel-body">
                                                                <div class="dl-filter">
                                                                        <form>
                                                                                <div class="form-group  post-filter-inputs">
                                                                                        <input  type="checkbox">
                                                                                        <label>Air Conditioning&nbsp;<i class="fa fa-user" aria-hidden="true"></i>&nbsp;individual with all cars</label>
                                                                                </div>  
                                                                                <div class="form-group  post-filter-inputs">
                                                                                        <input  type="checkbox">
                                                                                        <label>Automatic&nbsp;<i class="fa fa-user" aria-hidden="true"></i>&nbsp;(4)</label>
                                                                                </div>  
                                                                                <div class="form-group  post-filter-inputs">
                                                                                        <input  type="checkbox">
                                                                                        <label>4 Wheel Derive&nbsp;<i class="fa fa-user" aria-hidden="true"></i>&nbsp;(?)</label>
                                                                                </div>  
                                                                                <div class="form-group  post-filter-inputs">
                                                                                        <input  type="checkbox">
                                                                                        <label>4+ Doors&nbsp;<i class="fa fa-user" aria-hidden="true"></i>&nbsp;individual with all cars</label>
                                                                                </div>   
                                                                        </form>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="panel panel-default custom-post-panel">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse4" class="heading-stying collapsed">
                                                        <div class="panel-heading custom-heading">
                                                                Filter 4
                                                        </div>
                                                </a>
                                                <div id="collapse4" class="panel-collapse collapse">
                                                        <div class="panel-body custom-panel-body">
                                                                <div class="dl-filter">
                                                                        <form>
                                                                                <div class="form-group post-filter-inputs">
                                                                                        <input  type="checkbox">
                                                                                        <label>Full Fuel&nbsp;<i class="fa fa-user" aria-hidden="true"></i>&nbsp;individual with all cars</label>
                                                                                </div> 
                                                                        </form>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="panel panel-default custom-post-panel">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse5" class="heading-stying collapsed">
                                                        <div class="panel-heading custom-heading">
                                                                Filter 5
                                                        </div>
                                                </a>
                                                <div id="collapse5" class="panel-collapse collapse">
                                                        <div class="panel-body custom-panel-body">
                                                                <div class="dl-filter">
                                                                        <form>
                                                                                <div class="form-group post-filter-inputs">
                                                                                        <input  type="checkbox">
                                                                                        <label>Cities Office&nbsp;<i class="fa fa-user" aria-hidden="true"></i>&nbsp;individual with all cars</label>
                                                                                </div> 
                                                                        </form>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                    </div> 
                                    <div class="filter-footer">
                                        <div><a href="#" >View All Locations On Map</a></div>
                                        <div><a href="#"><i class="fa fa-repeat" aria-hidden="true"></i>&nbsp;Clear All</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="post-drop-btn" style="display:none;">
                                <span style="font-size:14px;cursor:pointer" onclick="toogleNavpost()"><img src="{{ asset('sximo/assets/images/arrow-botom.gif')}}" alt=""/>Filter Menu</span>
                            </div>
                        </div>
                    </div>
                    <a class="book-now trigger-booking" href="#">Book your stay</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="sticky-header-offset"></div>
<script>
    $(document).ready(function () {
        $(".social-share").click(function (event) {
            event.preventDefault();
            $(this).find("ul").toggle();
            $(this).toggleClass("open");
        });
    });
</script>
<script>
    $(document).ready(function () {
        $("header .menu > a").click(function (event) {
            event.preventDefault();
            $(this).parent().find("ul").toggle("slow");
        });
        $(".trigger-click-on-book-now").click(function (event) {
            event.preventDefault();
            $(".open-book-now-page").trigger("click");
        });
    });
</script>
<script>
    $(document).ready(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        $("#back-to-top").click(function (event) {
            event.preventDefault();
            $("html, body").animate({scrollTop: 0}, "slow");
        });
        $(".trigger-click-on-video-pop-up").click(function (event) {
            event.preventDefault();
            $(".open-video-pop-up").trigger("click");
        });
    });
</script>
<script>
    $('#two-inputs').dateRangePicker(
            {
                selectForward: (Boolean),
                stickyMonths: (Boolean),
                startDate: "12-01-2017",
                format: ' DD.MM.YYYY',
                separator: ' to ',
                getValue: function ()
                {
                    if ($('#date-range-destination').val() && $('#date-range-arrive').val())
                        return $('#date-range-destination').val() + ' to ' + $('#date-range-arrive').val();
                    else
                        return '';
                },
                setValue: function (s, s1, s2)
                {
                    $('#date-range-arrive').val(s1);
                    $('#date-range-destination').val(s2);
                }
            }
    ).bind('datepicker-first-date-selected', function (event, obj) {
        $("#date-range-destination").val('');
    });

</script>
<script>
    /* Toggle between adding and removing the "active" and "show" classes when the user clicks on one of the "Section" buttons. The "active" class is used to add a background color to the current button when its belonging panel is open. The "show" class is used to open the specific accordion panel */
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].onclick = function () {
            this.classList.toggle("active");
            this.nextElementSibling.classList.toggle("show");
        }
    }
</script>
<script>
   function toogleNavpost() {
                if (document.getElementById("mySidenavpost").style.width == "400px") {
                    return closeNavpost();
                }
                return openNavpost();
            }
            function openNavpost() {
                if ($(window).width() >= 768) {
                    document.getElementById("mySidenavpost").style.width = "400px";
                    document.getElementById("main").style.marginRight = "250px";
                }
                else{
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
                if ($(window).width() >= 768) {
                    document.getElementById("mySidenavpost").style.width = "100%";
                    document.getElementById("main").style.marginRight = "250px";
                }
                setTimeout(function () {
                    if ($(window).width() >= 768) {
                        document.getElementById("mySidenavpost").style.width = "0";
                        document.getElementById("main").style.marginRight = "0";
                        document.body.style.backgroundColor = "white";
                        document.body.style.transition = "all 0.5s ease 0s";
                    }
                }, 3000);

            };

            if ($(window).width() <= 767) {
                document.getElementById("mySidenavpost").style.width = "100%";
                document.getElementById("main").style.marginRight = "250px";
            }

            $(document).on('click', function (event) {
                if ($(window).width() <= 767) {
                    if ($(event.target).has('.filter-width').length) {
                        document.getElementById("mySidenavpost").style.width = "0";
                        document.getElementById("main").style.marginRight = "0";
                    }
                }
            });
</script>
<script>
$(".node-btn").click(function(){
        $(this).parent().find("> .node").toggle();
        $(this).parent().find("> .node").css({"padding-left": "10px", "margin-top": "5px", "text-transform": "inherit"});
        $(this).parent().find("> .node > a").css({"text-transform": "none"});
});
</script>
<script>
    $(function () {
        $('#filter-date-mobile').combodate();
    });
        $('#filter-date-mobile').combodate({
            minYear: 2016,
            maxYear: 2017,
        });
        $(function () {
            $('#filter-date-mobile-departure').combodate();
        });
        $('#filter-date-mobile-departure').combodate({
            minYear: 2016,
            maxYear: 2017,
        });
</script>
<style>
    .sidenavpost .bh-search-input
    {
        padding-left: 0px !important;
    }

    .sidenavpost .tt-menu
    {
        left: 0% !important;
        color:#fff !important;
    }

    .sidenavpost a
    {
        padding: 0 !important;
        font-size: 14px !important;
    }
    .sidenavpost .closebtn
    {
        font-size: 36px !important;
    }
</style>

<script>
	function filter_destination(destn,area)
	{
		if(destn!='' && destn>0)
		{
			$('#selDestn').val(destn+'#:'+area);
			$('#listrecrds').val(0);
			$('#nxtpg').val('1');
			var it_scroll = false;
			scrollDownloadData(it_scroll);
			$('#listrecrds').val(21);
			
		}
	}
</script>