<section data-selector="section" id="text-2col2">
	<div class="container">
	
		<div class="row header-line2 about-sec">
		
			<p id="folder_name" class="sub-cat hidden-xs">
				<a href="{{ URL::to('ber-janua') }}"><b class="@if(Request::is('ber-janua')) aactive @endif" >{{\Lang::get('core.menu_frontend_uber_janua')}}</b></a>/
				<a href="{{ URL::to('teamdetail') }}"><b class="@if(Request::is('teamdetail')) aactive @endif">{{\Lang::get('core.menu_frontend_team')}}</b></a>/
				<a href="{{ URL::to('designeroverview') }}"><b class="@if(Request::is('designeroverview')) aactive @endif">{{\Lang::get('core.menu_frontend_designer')}}</b></a>/
				<a href="{{ URL::to('produktion') }}"><b class="@if(Request::is('produktion')) aactive @endif">{{\Lang::get('core.menu_frontend_produktion')}}</b></a>/
				<a href="{{ URL::to('partner') }}"><b class="@if(Request::is('partner')) aactive @endif">{{\Lang::get('core.menu_frontend_partner')}}</b></a>/
				<a href="{{ URL::to('vertrieb') }}"><b class="@if(Request::is('vertrieb')) aactive @endif">{{\Lang::get('core.menu_frontend_vertrieb')}}</b></a>/
				<a href="{{ URL::to('showrooms') }}"><b class="@if(Request::is('showrooms')) aactive @endif">{{\Lang::get('core.menu_frontend_showroom')}}</b></a>/
				<a href="{{ URL::to('popupstores') }}"><b class="@if(Request::is('popupstores')) aactive @endif">{{\Lang::get('core.menu_frontend_popupstore')}}</b></a>/
				<a href="{{ URL::to('messe') }}"><b class="@if(Request::is('messe')) aactive @endif">{{\Lang::get('core.menu_frontend_messe')}}</b></a>/
				<a href="{{ URL::to('project') }}"><b class="@if(Request::is('project')) aactive @endif">{{\Lang::get('core.menu_frontend_projekte')}}</b></a>/
				<a href="{{ URL::to('videos') }}"><b class="@if(Request::is('videos')) aactive @endif">{{\Lang::get('core.menu_frontend_videos')}}</b></a>/
				<a href="{{ URL::to('projekteimhandel') }}"><b class="@if(Request::is('videos')) aactive @endif">{{\Lang::get('core.menu_frontend_project_im_handle')}}</b></a>
				
			</p>
			
			<div class="panel-group accordion visible-xs sub-cat" id="accordion" style="padding:0 10px;">
				<div class="panel panel-default repeatVar1">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
								<i class="fa fa-angle-right"></i> Menü
							</a>
						</h4>
					</div>
					<div id="collapse1" class="panel-collapse collapse" style="height: auto;">
						<div class="panel-body">
							<a href="{{ URL::to('ber-janua') }}"><b>{{\Lang::get('core.menu_frontend_uber_janua')}}</b></a><br>
							<a href="{{ URL::to('teamdetail') }}"><b>{{\Lang::get('core.menu_frontend_team')}}</b></a><br> 
							<a href="{{ URL::to('designeroverview') }}"><b>{{\Lang::get('core.menu_frontend_designer')}}</b></a><br>
							<a href="{{ URL::to('produktion') }}"><b>{{\Lang::get('core.menu_frontend_produktion')}}</b></a><br>
							<a href="{{ URL::to('partner') }}"><b>{{\Lang::get('core.menu_frontend_partner')}}</b></a><br>
							<a href="{{ URL::to('vertrieb') }}"><b>{{\Lang::get('core.menu_frontend_vertrieb')}}</b></a><br>
							<a href="{{ URL::to('showrooms') }}"><b>{{\Lang::get('core.menu_frontend_showroom')}}</b></a><br>
							<a href="{{ URL::to('popupstores') }}"><b>{{\Lang::get('core.menu_frontend_popupstore')}}</b></a><br>
							<a href="{{ URL::to('messe') }}"><b>{{\Lang::get('core.menu_frontend_messe')}}</b></a><br>
							<a href="{{ URL::to('project') }}"><b>{{\Lang::get('core.menu_frontend_projekte')}}</b></a><br>
							<a href="{{ URL::to('videos') }}"><b>{{\Lang::get('core.menu_frontend_videos')}}</b></a><br>
							<a href="{{ URL::to('projekteimhandel') }}"><b>{{\Lang::get('core.menu_frontend_project_im_handle')}}</b></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="container">
	@if(!empty($designer_overview))
		<section data-selector="section" id="text-2col">
			<div class="container">
				<div class="row about-sec">
				
				<h1 data-selector="h3" class="title">{{\Lang::get('core.menu_frontend_designer')}}</h1>
				
				</div>
			</div>
		</section>
			
		<section id="benefits-grid-images-left" class="new-padding">
			<div class="container">
				<div class="row no-dev">
					{{--*/ $pd=0; /*--}}
					@foreach($designer_overview as $designers)
						<div class="col-sm-4">
							<ul class="item-list overview">
								<li>
									{{--*/  $des_name = strtolower(str_replace(' ','-',$designers->designer_name));
											$dlink = URL::to('designer/'.$des_name); 
									/*--}}
									<a href="{{$dlink}}"><img src="{{URL::to('uploads/designer_images/'.$designers->featured_image)}}" alt="feature" class="screen img-circle"></a>
									<h3>
									
									<a href="{{$dlink}}">{{ (\Session::get('newlang')=='English') ? $designers->designer_name_eng : $designers->designer_name }}</a></h3>
									<p class="editContent">
									{{-- @if(\Session::get('newlang')=='English')
											@if(strlen($designers->designer_description_eng) > 170)
												{!! substr(strip_tags($designers->designer_description_eng),0,170).'...' !!}
											@else
												{!! substr(strip_tags($designers->designer_description_eng),0,-1) !!}
											@endif
										@else
											@if(strlen($designers->designer_description) > 170)
												{!! substr(strip_tags($designers->designer_description),0,170).'...' !!}
											@else
												{!! substr(strip_tags($designers->designer_description),0,-1) !!}
											@endif
									@endif --}}
									
										@if(\Session::get('newlang')=='English')
											{!! strip_tags($designers->designer_intro_text_eng) !!}
										@else
											{!! strip_tags($designers->designer_intro_text) !!}
										@endif
									</p>
								</li>
							</ul>
						</div>
						{{--*/ $pd++ /*--}}
						@if($pd%3==0)
							</div>
							<div class="row no-dev">
						@endif
					@endforeach
				</div>
			</div>
		</section>
		
		<section data-selector="section" id="text-2col">
			<div class="container2">
				<div class="row">
					<h3 class="poat-heading2">{{$designer_title->content}}</h1>
					<div>{{ $designer_desc->content }}</div>
				</div>
			</div>
		</section>
	@endif 
</div>