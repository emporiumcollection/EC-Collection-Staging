<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<script src="{{ asset('sximo/js/plugins/jquery.min.js') }}"></script>
<script src="{{ asset('sximo/js/plugins/jquery-ui.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('sximo/js/plugins/fancybox/jquery.fancybox.css') }}">
<script src="{{ asset('sximo/js/plugins/fancybox/jquery.fancybox.js') }}"></script>
<script src="{{ asset('sximo/js/tooltip_popup.js') }}"></script>
<link rel="stylesheet" href="{{ asset('sximo/js/plugins/fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5') }}">
<script src="{{ asset('sximo/js/plugins/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5') }}"></script>

<script type="text/javascript">

    $(document).ready(function () {
		$.fancybox.open([
			<?php foreach($imgfancy as $imgOBJ){
			
			echo '{href:'.'"'.$imgOBJ['imgpath'].'"},';
			
		}	?>
		], {
			helpers : {
				buttons	: {},
				overlay: { closeClick: false }
			}
		});
    })
</script>

</head>
<body>
</body>
</html>

