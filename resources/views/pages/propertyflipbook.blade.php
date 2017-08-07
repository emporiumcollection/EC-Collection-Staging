<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<script src="{{ asset('sximo/js/plugins/jquery.min.js') }}"></script>
<link href="{{ asset('sximo/css/flipbook/flipbook.style.css')}}" rel="stylesheet">
<link href="{{ asset('sximo/fonts/awesome/css/font-awesome.min.css')}}" rel="stylesheet">
<script src="{{ asset('sximo/js/flipbook/flipbook.min.js') }}"></script>

<script type="text/javascript">

    $(document).ready(function () {
        $("#container").flipBook({
			<?php if(isset($_GET['pdfname']) && $_GET['pdfname']!='') {  
			 echo 'pdfUrl:"'.$_GET['pdfname'].'"'; ?>,
			pdfPageScale:1.5
			<?php } ?>
        });

    })
</script>

</head>
<body>
<div id="container"/></div>
</body>
</html>