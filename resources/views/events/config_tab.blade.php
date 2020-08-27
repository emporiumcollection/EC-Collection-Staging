<ul class="nav nav-tabs">
	@if(!empty($tabss))
		@foreach($tabss as $key=>$val)
			<li @if($key == $active) class="active" @endif><a href="{{URL::to('events/eventsettings/'.$pid.'/'.$key)}}"> {{ $val->tab_name }}</a></li>
		@endforeach
	@endif
</ul>