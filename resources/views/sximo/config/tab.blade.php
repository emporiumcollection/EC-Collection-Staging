<?php

$tabs = array(
		'' 		=> Lang::get('core.tab_siteinfo'),
		'email'			=> Lang::get('core.tab_email'),
		'security'		=> Lang::get('core.tab_loginsecurity') ,
		'translation'	=> 'Translation',
		'log'			=> Lang::get('Clear Cache & Logs'),
		'invoice'			=> 'Invoice',
		'advertisement'			=> Lang::get('core.tab_advertisement'),
		'kontakte'			=> 'Kontakte',
		'container'			=> 'Container',
		'designer'			=> 'Designer',
        'contract'			=> 'Contract',
        'season'			=> 'Default Season',
        'citytax'			=> 'City Tax'
	);

?>

<ul class="nav nav-tabs" >
@foreach($tabs as $key=>$val)
	<li  @if($key == $active) class="active" @endif><a href="{{ URL::to('sximo/config/'.$key)}}"> {{ $val }}  </a></li>
@endforeach

</ul>