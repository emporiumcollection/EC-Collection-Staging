<!--Footer-->
<div class="footer">
    <div class="container footer-padding-0">
        <div class="col-md-12 col-sm-12 col-xs-12 footer-padding-0">
            <div class="col-md-3 col-sm-3 col-xs-12 footer-sec-padding-left footer-padding-0">
                {{--*/ $footer_menus = SiteHelpers::menus('footer') /*--}}
				@foreach ($footer_menus as $fmenu)
					<div class="col-md-4 col-sm-4 col-xs-12 {{($fmenu!=$footer_menus[0]) ? 'footer-padding-0' : ''}}">
						<div class="row">
							<div class="accordion res-design-footer ghf">
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
            <div class="col-md-1 col-sm-1 col-xs-12"></div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <p class="footer-nav-menu-harding footer-res-margin-align">About EMPORIUM VOYAGE</p>
                <p class="footer-about-us-des">{{$about_text->content}}
                </p>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <p class="footer-nav-menu-harding footer-res-margin-align">Newsletter</p>
                <p class="subscription-line">Subscribe and get 10% off on your next reservation</p>
                <form>
                    <div class="res-form-align">
                        <input type="text" placeholder="Email" class="newsletter-style">
                        <input type="submit" value="Subscribe" class="nesletter-submit-btn">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12 copy-right-sec">
            <p>{{$footer_text->content}}</p>
        </div>
    </div>
</div>
