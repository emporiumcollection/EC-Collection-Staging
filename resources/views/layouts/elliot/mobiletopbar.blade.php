{{--*/ $menus = SiteHelpers::menus('top') /*--}}
 	<ul class="slimmenu">
	  <li>
		  <a href="#">home</a>
	  </li> 
	  @foreach ($menus as $menu)
		  <li>
			  <a class="@if(count($menu['childs']) > 0 ) sub-collapser @endif" 
				@if($menu['menu_type'] =='external')
					href="{{ URL::to($menu['url'])}}" 
				@else
					href="{{ URL::to($menu['module'])}}" 
				@endif >
					@if(CNF_MULTILANG ==1 && isset($menu['menu_lang']['title'][Session::get('lang')]))
						{{ $menu['menu_lang']['title'][Session::get('lang')] }}
					@else
						{{$menu['menu_name']}}
					@endif
				</a>
			@if(count($menu['childs']) > 0)
			  <ul>
				@foreach ($menu['childs'] as $menu2)
					<li>
						<a @if($menu2['menu_type'] =='external')
								href="{{ URL::to($menu2['url'])}}" 
							@else
								href="{{ URL::to($menu2['module'])}}" 
							@endif >
								@if(CNF_MULTILANG ==1 && isset($menu2['menu_lang']['title'][Session::get('lang')]))
									{{ $menu2['menu_lang']['title'][Session::get('lang')] }}
								@else
									{{$menu2['menu_name']}}
								@endif
						</a>
					</li>
				@endforeach
			  </ul>
			@endif
		  </li>
	  @endforeach
		@if(!Auth::check())
		<li><a href="{{ url('user/login')}}">Login</a></li>
		<li><a href="{{ url('plans')}}">Subscribe</a></li>
		@else
		<li>
			<a class="sub-collapser">Mein Konto<b class="caret"></b></a>
			<ul>
				<li><a href="{{ url('dashboard')}}"><i class="fa fa-desktop"></i> Systemübersicht</a></li>
				<li><a href="{{ url('user/profile')}}"><i class="fa fa-user"></i> Mein Konto</a></li>
				<li><a href="{{ url('user/logout')}}"><i class="icon-switch"></i> Abmelden</a></li>
			</div>
		</li>
		@endif
	</ul>
 