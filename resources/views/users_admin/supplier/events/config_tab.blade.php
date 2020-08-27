<ul class="nav nav-tabs" role="tablist">
	@if(!empty($tabss))
		@foreach($tabss as $key=>$val)
            <li class="nav-item">
                 <a class="nav-link @if($key == $active) active @endif" href="{{URL::to('events/eventsettings/'.$pid.'/'.$key)}}"> 
                    {{ $val->tab_name }}
                 </a>
            </li>
		@endforeach
	@endif
</ul>