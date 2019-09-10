<footer id="footer">
    <div class="container-fluid">
        {{--*/ $footer_menus = SiteHelpers::menus('footer') /*--}}
        @if (!empty($footer_menus))
            <div class="row">
                @foreach ($footer_menus as $fmenu)
                    <div class="col-sm-4">
                        <div class="footer-coloumn">
                            <h2>
                                @if(CNF_MULTILANG ==1 &&  isset($fmenu['menu_lang']['title'][Session::get('lang')]))
                                    {{ $fmenu['menu_lang']['title'][Session::get('lang')] }}
                                @else
                                    {{$fmenu['menu_name']}}
                                @endif
                            </h2>
                            @if(count($fmenu['childs']) > 0)
                                <ul class="footer-nav-menu">
                                    @foreach ($fmenu['childs'] as $fmenu2)
                                        <li> 
                                            <a @if($fmenu2['menu_type'] =='external') href="{{ URL::to($fmenu2['url'])}}" @else href="{{ URL::to($fmenu2['module'])}}" @endif >
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
                @endforeach
            </div>
        @endif
        <div class="row">
            <div class="col-sm-4">
                <div class="footer-coloumn">
                    <h2>{{--*/ $aboutHeaderText = CommonHelper::getAboutHeaderInfo(); /*--}}
                        {{$aboutHeaderText['about_header_text']->content}}</h2>
                    <p>{{--*/ $abouttext = CommonHelper::getAboutInfo(); /*--}}
                        {{$abouttext['about_text']->content}}</p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="footer-coloumn newsletter">
                    <h2>NEWSLETTER</h2>
                    <p>Subscribe and get 10% off on your next reservation</p>
                    <form action="http://just-emarketing.com/app/index.php/lists/za243dkcsjde0/subscribe" method="post" accept-charset="utf-8" target="_blank">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" placeholder="First Name" name="FNAME" class="form-control" required="required"/>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" placeholder="Last Name" name="LNAME" class="form-control" required="required"/>
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" placeholder="Email" name="EMAIL" class="form-control" required="required"/>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <button type="submit" class="newsletter-btn">Subscribe</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="footer-coloumn">
                    <h2>Follow us</h2>
                    <ul class="social-menu">
                        <li><a href="https://www.facebook.com/emporiumvoyage/"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://fr.linkedin.com/company/emporiumvoyage"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="https://www.pinterest.cl/emporiumvoyage/?redirected=1"><i class="fa fa-pinterest-p"></i></a></li>
                        <li><a href="https://www.instagram.com/emporiumvoyage/"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
