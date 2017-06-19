<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<script src="{{ asset('sximo/js/plugins/jquery.min.js') }}"></script>
<script src="{{ asset('sximo/js/plugins/jquery-ui.min.js') }}"></script>
<link href="{{ asset('sximo/css/flipbook/flipbook.style.css')}}" rel="stylesheet">
<link href="{{ asset('sximo/fonts/awesome/css/font-awesome.min.css')}}" rel="stylesheet">
<script src="{{ asset('sximo/js/flipbook/flipbook.min.js') }}"></script>

<script type="text/javascript">

    $(document).ready(function () {
        $("#container").flipBook({
			<?php if($flips[0]['file_type']=="application/pdf") { foreach($flips as $imgOBJ){ 
			 echo 'pdfUrl:"'.$imgOBJ['imgpath'].'"'; ?>,
			pdfPageScale:1.5
			<?php } } else { ?>
            pages:[
				<?php $fp=1; $imgtyp = ($fliptype=="high")?'highflip_':'format_';
				foreach($flips as $imgOBJ){
					
					echo '{src:'.'"'.URL::to('uploads/thumbs').'/'.$imgtyp.$imgOBJ['folder'].'_'.$imgOBJ['imgname'].'",thumb:'.'"'.URL::to('uploads/thumbs').'/thumb_'.$imgOBJ['folder'].'_'.$imgOBJ['imgname'].'",title:'.'"Page '.$fp.'"},';
					$fp++;
				}	?>
            ],
			viewMode:'2d',
			pageFlipDuration:0.5,
			display: 'single',
			singlePageMode:true
			<?php } ?>
        });

    })
</script>

</head>
<body>
<div id="container"/></div>
</body>
</html>

