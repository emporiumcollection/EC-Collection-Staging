<style>
    
    .vegasFooter {
        width: 20%;
        float: left;
    }
    
    .vegasFooterSocial ul li a i {
    font-size: 14px;
    background: #ABA07C;
    /* border-radius: 831px; */
    padding: 6px 12px 4px 7px;
    color: #fff;
    margin-right: 0px;
    text-align: center;
    width: 25px;
    }
    
    .footer {
    background-color: #F7F7F4;
    font-size: 11px;
    margin-bottom: -15px;
    margin-top: 50px;
    padding-bottom: 15px;
    padding-top: 65px;
    }
    
    .noPadding {
        padding: 0px !important;
    }

    .vegasSocialUl {
        margin-left: 121px;
    }
    
    .VegasFooterMiddle p {
        margin-left: 58px;
    }
    
    .VegasFooterMiddle form {
        margin-left: 58px;
    }
    
    .marginBottom20 {
        margin-bottom: 20px;
    }
    
</style>                    


    <div class="container">
        <div class="col-md-12 pre-footer-sec-align">
            <p>Follow @Emporium-Voyage</p>
            <p>Premium Lifestyle Portfolio World Wide<br/>Carefully created to ensure the ultimate luxury</p>
        </div>
    </div>

    <!--Footer-->
    <div class="footer">
        <div class="container">
            <div class="col-md-12 col-sm-12 col-xs-12 footer-padding-0 noPadding noPadding">
                <div class="col-md-12 col-sm-5 col-xs-12  footer-padding-0 marginBottom20">
                    {{--*/ $footer_menus = SiteHelpers::menus('footer') /*--}}
                    @foreach ($footer_menus as $fmenu)
                        <div class="vegasFooter {{($fmenu!=$footer_menus[0]) ? 'footer-padding-0' : ''}}">
                            <div class="row-">
                                <div class="accordion res-design-footer">
                                    @if(CNF_MULTILANG ==1 &&  isset($fmenu['menu_lang']['title'][Session::get('lang')]))
                                        {{ $fmenu['menu_lang']['title'][Session::get('lang')] }}
                                    @else
                                        {{$fmenu['menu_name']}}
                                    @endif</div>
                                <div class="panel">
                                @if(count($fmenu['childs']) > 0)
                                    <ul class="footer-nav-menu footer-nav-menu-align">
                                        @foreach ($fmenu['childs'] as $fmenu2)
                                            <li>
                                                <a @if($fmenu2['menu_type'] =='external') href="{{ URL::to($fmenu2['url'])}}" @else href="{{ URL::to($fmenu2['module'])}}" @endif>
                                                    @if(CNF_MULTILANG ==1 && isset($fmenu2['menu_lang']['title'][Session::get('lang')]))
                                                        {{ $fmenu2['menu_lang']['title'][Session::get('lang')] }}
                                                    @else
                                                        {{$fmenu2['menu_name']}}
                                                    @endif
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                                                        
                </div>

                <div class="col-md-4 col-sm-3 col-xs-12">
                    <p class="footer-nav-menu-harding footer-res-margin-align">About EMPORIUM VOYAGE</p>
                    <p class="footer-about-us-des">{{$data['about_text']->content}}
                    </p>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 VegasFooterMiddle">
                    <p class="footer-nav-menu-harding footer-res-margin-align">Newsletter</p>
                    <p class="subscription-line">Subscribe and get 10% off on your next reservation</p>
                    <form action="https://just-emarketing.com/app/index.php/lists/fb5156qrasf4a/subscribe" method="post" accept-charset="utf-8" target="_blank">
                        <div class="">
                    
                        <input type="text" class="form-control newsletter-style" name="EMAIL" placeholder="First Name" value="" required="">
                        </div>

                        <div class="">
                        
                        <input type="text" class="form-control newsletter-style" name="FNAME" placeholder="Last Name" value="">
                        </div>

                        <div class="">
                        
                        <input type="text" class="form-control newsletter-style" name="LNAME" placeholder="Email" value="">
                        </div>

                        <div class="">
                        <button type="submit" class="nesletter-submit-btn">Subscribe</button>
                        </div>
                        
                    </form>
                    

                </div>
                
                <!-- AIC Harman footer social icons add -->
                <div class="col-md-4 vegasFooterSocial">
                    <ul class="list-inline vegasSocialUl">
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
                
            </div>
            <div class="col-md-12 copy-right-sec">
                <p>{{$data['footer_text']->content}}</p>
            </div>
        </div>
    </div>
                

<script src="{{ asset('sximo/js/typeahead.bundle.js')}}"></script>
<link href="{{ asset('sximo/assets/css/custom_ps.css')}}" rel="stylesheet" type="text/css"/>

<script>
    var substringMatcher = function(strs) {
      return function findMatches(q, cb) {
        var matches, substringRegex;

        // an array that will be populated with substring matches
        matches = [];

        // regex used to determine if a string contains the substring `q`
        substrRegex = new RegExp(q, 'i');

        // iterate through the pool of strings and for any string that
        // contains the substring `q`, add it to the `matches` array
        $.each(strs, function(i, str) {
          if (substrRegex.test(str)) {
            matches.push(str);
          }
        });

        cb(matches);
      };
    };

    var states = [{!! TagsFinder::tags() !!}];

    $('.searchform-navbar .typeahead').typeahead({
      hint: true,
      highlight: true,
      minLength: 1
    },
    {
      name: 'states',
      source: substringMatcher(states)
    });

    var substringDestination = function(strs) {
      return function findDestination(q, cb) {
        var dests, substringRegex;
        dests = [];
        substrRegex = new RegExp(q, 'i');

        $.each(strs, function(i, str) {
          if (substrRegex.test(str)) {
            dests.push(str);
          }
        });

        cb(dests);
      };
    };

        var dests = [{!! TagsFinder::finddestinations() !!}];

    $('.destinationsearchform-navbar .typeahead').typeahead({
      hint: true,
      highlight: true,
      minLength: 1
    },
    {
      name: 'destinations',
      source: substringDestination(dests)
    });

    $('.search-navbar').on('typeahead:selected', function (e, datum) {
        var propname = $(this);
    //        propname.parents('.searchform-navbar').submit();
    //        return;
    var sname = propname.val();
        $.ajax({    
          url: "{{ URL::to('find_property_by_name')}}",
          type: "post",
          data: 'pname='+propname.val(),
          dataType: "json",
          success: function(data){
            if(data.status=='error') {
                        window.location.href = "{{URL::to('luxury_hotels')}}/" + sname.replace(' ', '_');
                        //propname.parents('.searchform-navbar').submit();
                        return;
                        window.location.href = "{{URL::to('luxury_hotels')}}/" + sname.replace(' ', '_');
                        //propname.parents('.searchform-navbar').submit();
            }
            else {
                        var obj = JSON.parse(data.property);
                        window.location.href = "{{URL::to('')}}/" + obj.property_slug;
            }
          }
        });
    });
    </script>

    @include('layouts/elliot/ai_newsletter')
    @include('layouts/elliot/ai_cookie-bar')
        
        
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
            $(window).scroll(function () {
                if ($(this).scrollTop() > 200) {
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
        /* Toggle between adding and removing the "active" and "show" classes when the user clicks on one of the "Section" buttons. The "active" class is used to add a background color to the current button when its belonging panel is open. The "show" class is used to open the specific accordion panel */
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].onclick = function () {
                this.classList.toggle("active");
                this.nextElementSibling.classList.toggle("show");
            }
        }
        
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
        function goBack() {
            window.history.back();
        }
    </script>
    <script type="text/javascript" src="{{ asset('sximo/assets/js/slideshow.js')}}"></script>
    
    
    <!-- instagram -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.3/handlebars.runtime.min.js"></script>
    <link rel="stylesheet" href="{{ asset('sximo/instajs/instashow/jquery.instashow.css')}}">
    <script src="{{ asset('sximo/instajs/instashow/jquery.instashow.js')}}"></script>
        
    <style>
        #instaShowGallery_1 .instashow-gallery-media-cover {
            background: rgba(0, 0, 0, 0.9) !important;
        }
        #instaShowPopup_1 .instashow-popup-media-info-author {
            color: #000 !important;
        }
        #instaShowPopup_1 a.instashow-popup-media-info-original {
            display: none;
        }
        #instaShowGallery_1 .instashow-gallery-control-arrow::before, #instaShowGallery_1 .instashow-gallery-control-arrow::after {
            background: #000;
        }
        
        .editorial-custom-footer-style .newsletter-style {
            width: 44%;
            margin-top: 8px;
            float: left;
            margin-right: 15px;
            box-shadow: none;
            border-radius: 0;
            font-size: 11px;
        }
        
        .form-control:focus {
            border-color: #7a7a7a;
        }
    </style>
       
    </body>
</html>
