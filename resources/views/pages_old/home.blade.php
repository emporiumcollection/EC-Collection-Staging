<link rel="stylesheet" href="{{ asset('sximo/css/supersized.css') }}" type="text/css" media="screen" />
<link rel="stylesheet" href="{{ asset('sximo/css/supersized.shutter.css') }}" type="text/css" media="screen" />
<script type="text/javascript" src="{{ asset('sximo/js/supersized.3.2.7.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('sximo/js/supersized.shutter.min.js') }}"></script>

<script type="text/javascript">

	jQuery(function ($) {

		$.supersized({

			// Functionality
			slide_interval: 3000,		// Length between transitions
			transition: 1, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
			transition_speed: 700,		// Speed of transition

			// Components
			slide_links: 'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
			slides: [			// Slideshow Images
			<?php if(!empty($ads_home)) { foreach($ads_home as $imgOBJ){
					
					echo '{image:"'.URL::to('uploads/users/advertisement').'/'.$imgOBJ->adv_img.'",title:"", thumb:"",url:"'.$imgOBJ->adv_link.'"},';
			} }	?>
			]

		});
	});

</script>