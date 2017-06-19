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
@if(!empty($page_content))
<section data-selector="section" id="text-2col2">
	<div class="container">
	
		<div class="row header-line2 about-sec">
		
		<h1 data-selector="h3" class="title bjproduct-title">{{(\Session::get('newlang')=='English') ? $page_content->page_name_eng : $page_content->page_name}}</h1>

		</div>
	</div>
</section>

<div class="container">
	
	<section id="benefits-grid-images-left" class="new-padding" style="margin-top:50px;">
		<div class="container">
			<div class="row no-dev">
				@if($page_content->columns==3)
					<div class="col-sm-4">
						{!! (\Session::get('newlang')=='English') ? $page_content->content_column_1_eng : $page_content->content_column_1 !!}
					</div>
					<div class="col-sm-4">
						{!! (\Session::get('newlang')=='English') ? $page_content->content_column_2_eng : $page_content->content_column_2 !!}
					</div>
					<div class="col-sm-4">
						{!! (\Session::get('newlang')=='English') ? $page_content->content_column_3_eng : $page_content->content_column_3 !!}
					</div>
				@endif
				@if($page_content->columns==2)
					<div class="col-sm-6">
						{!! (\Session::get('newlang')=='English') ? $page_content->content_column_1_eng : $page_content->content_column_1 !!}
					</div>
					<div class="col-sm-6">
						{!! (\Session::get('newlang')=='English') ? $page_content->content_column_2_eng : $page_content->content_column_2 !!}
					</div>
				@endif
				@if($page_content->columns==1)
					<div class="col-sm-12">
						{!! (\Session::get('newlang')=='English') ? $page_content->content_column_1_eng : $page_content->content_column_1 !!}
					</div>
				@endif
			</div>
		</div>
	</section>
	
</div>
@endif 