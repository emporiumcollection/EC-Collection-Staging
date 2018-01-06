@extends('layouts.empty')
@section('content')
<link href="{{ asset('sximo/css/custom_ps.css')}}" rel="stylesheet">
<style>
	/*.gallery-box
	{
		width:100% !important;
	}*/
</style>
<div class="page-content row">
    <div class="page-content-wrapper m-t" style="padding-bottom:50px;">	
		<div class="row">
			<div class="col-sm-3">	
				<div class="row">
					<div class="col-sm-12">
						<a href="{{ URL::to('containeriframe/0/iframe')}}" class="files label"><span>Files</span></a>
						<?php foreach ($tree as $r) {
							echo $r;
						} ?>
					</div>
				</div>
				
			</div>
			<div class="col-sm-9">
				<div class="row">
					<div class="col-sm-12">
						<div id="get-breadcrumb"> </div>
						<div class="clear"></div>
						<div id="folders_data_list"><p style="padding-top: 30px; text-align: center;">Loading...</p></div>	
					</div>
				</div>
			</div>
		</div>
    </div>

	<script>
		$(function(){
			var fid = '<?php echo $fid; ?>';
			$('.parent'+fid).parents().show();
			$('.parent'+fid).show();
			
			loadiframeFolders(0);
			
			
			$(document).on('click','[data-action-open="folder"]',function(e){
				e.preventDefault();
				$('#folders_data_list').html('<p style="padding-top: 30px; text-align: center;">Loading...</p>');
				loadiframeFolders($(this).attr('rel_row'));
			});
        });
		function loadiframeFolders(id){
			
			$('#folders_data_list').html('<p style="padding-top: 30px; text-align: center;">Loading...</p>');

			$.ajax({
					url: '{{url("getFoldersAjax/")}}/'+id+'/iframe',
					type: "get",
					dataType: "html",
					success: function(data){
						$('#folders_data_list').hide();
						$('#folders_data_list').html(data);
						$('#folders_data_list').fadeIn('slow');
						//$('#folders_data_list').find('input[type=checkbox]').iCheck({checkboxClass: 'icheckbox_square-green'});
						$('#breadcrumb_line').html($('#folders_data_list').find('#get-breadcrumb').html());
					}
				});
		}
		
		
		
	</script>
@stop