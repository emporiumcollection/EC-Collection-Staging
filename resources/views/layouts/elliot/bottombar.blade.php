<footer data-selector="footer" id="footer-list-subscribe-2" class="bg-color3">	
   <div class="container foo-social-icon">
		@if(!empty($social_links))
		<ul class="social-icons">
			@foreach($social_links as $social)
				<li><a href="{{$social->social_link}}"> <img src="{{URL::to('uploads/social_mod/'.$social->social_img)}}" alt="{{$social->social_name}}"> </a></li>
			@endforeach
		</ul> 
		@endif
   </div>

	<div class="container foo-border"> 
		<div class="row">
			<div class="col-md-12 sep-bottom">
				<div class="row">
					{{--*/ $footer_menus = SiteHelpers::menus('footer') /*--}}
					@foreach ($footer_menus as $fmenu)
						<div class="col-md-2 footer-menu">
							<h4 data-selector="h4"><a @if($fmenu['menu_type'] =='external') href="{{ URL::to($fmenu['url'])}}" @else href="{{ URL::to($fmenu['module'])}}"	@endif />
								@if(CNF_MULTILANG ==1 && isset($fmenu['menu_lang']['title'][Session::get('lang')]))
									{{ $fmenu['menu_lang']['title'][Session::get('lang')] }}
								@else
									{{$fmenu['menu_name']}}
								@endif
							</h4>
							@if(count($fmenu['childs']) > 0)
								<ul class="links-list">
									@foreach ($fmenu['childs'] as $fmenu2)
										<li><a @if($fmenu2['menu_type'] =='external') href="{{ URL::to($fmenu2['url'])}}" @else href="{{ URL::to($fmenu2['module'])}}" @endif>
											@if(CNF_MULTILANG ==1 && isset($fmenu2['menu_lang']['title'][Session::get('lang')]))
												{{ $fmenu2['menu_lang']['title'][Session::get('lang')] }}
											@else
												{{$fmenu2['menu_name']}}
											@endif
										</a></li>
									@endforeach
								</ul>
							@endif
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	
	<div class="container foo-copy-right">
		<p style="color:#9d9d9d;">{{(!empty($footer_text))?$footer_text->content:''}}</p>
	</div>
</footer>