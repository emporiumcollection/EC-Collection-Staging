<link rel="stylesheet" href="{{ asset('sximo/css/featherlight/featherlight.min.css') }}">
<link rel="stylesheet" href="{{ asset('sximo/css/featherlight/featherlight.gallery.min.css') }}">
<script src="{{ asset('sximo/js/featherlight/featherlight.min.js') }}"></script>
<script src="{{ asset('sximo/js/featherlight/featherlight.gallery.min.js') }}"></script>
<style>
	.item-list li { background:none !important; }
	.item-list h3 { font-size:16px !important; }
	.item-list p { font-size:13px !important; }
	.sub-cat a b { font-weight: normal !important; }
	.disnon { display:none; }
	.modal-dialog{ width:700px !important; }
	input[type="text"], input[type="email"], textarea, select {
		width: 600px;
	}
	.container.foo-copy-right {
		 margin-bottom: 78px;
	}
	
	#back-top > a
	{
		bottom:545px !important;
	}
	
.image {
    position:relative;
}
.image img {
    width:100%;
    vertical-align:top;
}
.image:after {
    content: '{{ (\Session::get('newlang')=='English') ? 'Reserved' : 'Reserviert' }}';
    color: #fff;
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: rgba(0,0,0,0.8);
    opacity: 0.9;
    transition: all 0.5s;
    -webkit-transition: all 0.5s;
    font-size: 40px;
    text-align: center;
    padding-top: 50%;
}
</style>
<style>
	.panel{ border:none; background-color: transparent;  }
	.panel-default > .panel-heading { text-align:left; background-color: transparent; }
	.panel-body { padding: 0px; border-top:none !important; }
	.page-1-head { width:100% !important; }
	.item-list { margin-top:20px; }
	.item-list img { margin-bottom:10px; }
	.editContent p { text-align:left; }
	.downtxt {
		text-align: left;
		color: #000;
		margin-top: 30px;
		font-weight:bold;
	}
	.presehead { font-size:18px; margin-bottom:10px !important; }
</style>
{{--*/ $imgfancy = array(); /*--}}
<section data-selector="section" id="text-2col2">
	<div class="container">
	
		<div class="row header-line2 about-sec">
		
		<p id="folder_name" class="sub-cat hidden-xs">
			@if(!empty($parentsfolders))
				{{--*/ 
					usort($parentsfolders, function($a, $b) {
						return $a['data']->sort_num - $b['data']->sort_num; 
					});
				/*--}}
				@foreach($parentsfolders as $catArr)
					<a href="{{ URL::to('subproduct/'.$catArr['data']->id) }}">
						<b>{{(\Session::get('newlang')=='English') ? $catArr['data']->display_name_eng : $catArr['data']->display_name}}</b></a>/
				@endforeach
					<a href="{{ URL::to('materials') }}"><b>{{\Lang::get('core.menu_frontend_materials')}}</b></a>
			@endif
		</p>
		@if(!empty($parentsfolders))
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
							@foreach($parentsfolders as $catArr)
								<a href="{{ URL::to('subproduct/'.$catArr['data']->id) }}">
									<b>{{$catArr['data']->display_name}}</b>
								</a><br>
							@endforeach
								<a href="{{ URL::to('materials') }}"><b>{{\Lang::get('core.menu_frontend_materials')}}</b></a>
						</div>
					</div>
				</div>
			</div>
		@endif
		</div>
	</div>
</section>

<div class="container">
	@if(!empty($final_material_folders))
		@foreach($final_material_folders as $material)
			@if(!empty($material['child']))
				{{--*/ 
					$pd = 0;
					usort($material['child'], function($a, $b) {
						return $a['data']['sort_num'] - $b['data']['sort_num']; 
					});
				/*--}}
				<section data-selector="section" id="text-2col">
					<div class="container">
						<div class="row about-sec">
						
						<h1 data-selector="h3" class="title">{{$material['data']->display_name}}</h1>
						
						</div>
					</div>
				</section>
				<div class="panel-group accordion" id="accordion" style="margin-top:70px;">
					@foreach($material['child'] as $submaterial)
						<div class="panel panel-default">
							<div class="panel-heading">
								{{--*/ reset($material['child']); /*--}}
								@if(current($material['child'])!=$submaterial)
									<hr style="width:100%; margin-bottom:20px;" />
								@endif
								<h3 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$submaterial['data']['id']}}">
									<i class="fa fa-arrow-right"></i> {{$submaterial['data']['name']}}
									</a>
								</h3>
							</div>
							<div id="collapse{{$submaterial['data']['id']}}" class="panel-collapse collapse" style="height: auto;">
								<div class="panel-body">
									@if(!empty($submaterial['subchild']))
										{{--*/ 
											$pd = 0;
											usort($submaterial['subchild'], function($a, $b) {
												return $a['data']['sort_num'] - $b['data']['sort_num']; 
											});
										/*--}}
										
										<ul>
											@foreach($submaterial['subchild'] as $submaterialfile)
												<li class="item-list col-xs-6 col-md-4 col-lg-4">
													@if($fid=='448')
														{{--*/ $ProductcoverPic = ($submaterialfile['data']['cover_img']!='')? URL::to('uploads/thumbs/format_'.$submaterialfile['data']['folder_id'].'_'.$submaterialfile['data']['cover_img']): URL::to('uploads/images/product_no-image.jpg'); /*--}}
													@else
														{{--*/ $ProductcoverPic = ($submaterialfile['data']['cover_img']!='')? URL::to('uploads/folder_cover_imgs/product_file_'.$submaterialfile['data']['cover_img']): URL::to('uploads/images/product_no-image.jpg'); /*--}}
													@endif
													{{--*/
													$imgfancy[] = $ProductcoverPic;
													$link = URL::to('feature/'.$submaterialfile['data']['id']);
													$expFile = explode('.',$submaterialfile['data']['name']);
													$name = (strlen($submaterialfile['data']['name']) > 20) ? substr($submaterialfile['data']['name'],0,17)."~.". end($expFile):$submaterialfile['data']['name'];
													$productimagelink = URL::to('uploads/thumbs/highflip_'.$submaterialfile['data']['folder_id'].'_'.$submaterialfile['data']['cover_img']);
													/*--}}
													
													<div class="{{($submaterialfile['data']['reserved']=='yes') ? 'image' : '' }}">	
														<a href="{{$productimagelink}}" title="Slideshow" class="gallery2"><img src="{{$ProductcoverPic}}" alt="feature" class="screen img-circle fancybox-buttons"></a>
													</div>
													<h3><a href="#">{{$submaterial['data']['name']}}</a></h3>
													@if($submaterialfile['data']['reserved']=='yes')
														<p style="text-align:left;"> {{ (\Session::get('newlang')=='English') ? 'Reserved' : 'Reserviert' }}</p>
													@elseif($submaterialfile['data']['assign_lightbox']=='yes')
														<p style="text-align:left;">
															<a href="#" title="lightbox" rel="{{$submaterialfile['data']['id']}}" onclick="add_to_lightbox({{ $submaterialfile['data']['id']}});">Zum Merkzettel hinzufügen und reservieren</a>
														</p>
													@endif
												</li>
											@endforeach
										</ul>
									@endif
								</div>
							</div>
						</div>
					@endforeach	
				</div>
				
			@endif
		@endforeach
	@endif
	
</div>

<div id="fixed_wrapper">
	<!-- Lightbox Modal -->
	<div id="lightbox_basket_wrapper">
		<div id="lightbox_basket_trigger">
			<a href="#" class="link-to-show active" onclick="hide_show_lightbox('show');">Merkzettel<span class="arrow_down"></span></a>
			<a href="#" class="link-to-hide" onclick="hide_show_lightbox('hide');">Merkzettel<span class="arrow_down"></span></a>
		</div>

		<div id="lightbox_basket">
			<div id="lightbox_basket_content">
				<div id="lightbox_outer_wrapper">
					<div id="create_lightbox" class="attached">
						<div class="lightbox_addon">
							<!--<button type="button" class="textButton" onclick="createnewbox();">Create new Merkzettel +</button>-->
						</div>
					</div>
					{{--*/ $lb=0; $lb_itm=0; /*--}}
					@if(!empty($lightboxes))
						{{--*/ $lb= count($lightboxes); /*--}}
						@foreach($lightboxes as $lboxes)
							<div class="single_lightbox_wrapper{{$lboxes->id}} single_lightbox_wrappertemp attached">
								<input type="hidden" name="editlightboxid" id="editlightboxid" value="{{$lboxes->id}}" />
								<div class="single_lightbox_inner_wrapper">
									<div class="single_lightbox_wrapper_left">
										<div class="single_lightbox_title" data-lightbox-field="title">
											<span id="lightbox_title">{{$lboxes->box_name}}</span>
											<a href="#" class="lightbox_rename" onclick="show_rename_form({{$lboxes->id}});">Umbenennen</a>
											<div class="lightbox_rename_wrapper disnon">
												<input type="text" value="{{$lboxes->box_name}}" name="editval" class="textbox{{$lboxes->id}}" style="width:150px;">
												<button type="button" onclick="lightbox_update_name({{$lboxes->id}});">Save</button>
											</div>
										</div>
										
										<p style="font-size:13px; margin-bottom: 5px;">Im Merkzettel können Sie maximal 3<br>  Produkte hinterlegen. Die Reservierung <br>erfolgt für 7 Tage. Wird in dieser Zeit <br>keine Bestellung an uns geschickt<br>erfolgt die Deaktivierung automatisch.</p>
										
										<div class="single_lightbox_controls">
											<!--<button type="button" class="remove_lightbox textButton arrowButton" onclick="deletelightbox('{{$lboxes->id}}');">Entfernen</button>-->
											<button type="button" class="remove_lightbox textButton arrowButton" onclick="make_reserve('{{$lboxes->id}}');" style="margin:0;"><i class="fa fa-arrow-right"></i> Reservieren</button> &nbsp;
											
										</div>
										<div class="single_lightbox_controls">
											
											<a href="{{URL::to('lightbox_content_downloadpdf/'.$lboxes->id)}}" class="textButton default" > <i class="fa fa-download"></i> Download Merkzettel</a>&nbsp;
											
										</div>
										<div class="single_lightbox_controls">
											
											<a href="#" class="textButton asLightbox lightbox_email cboxElement" data-toggle="modal" data-target="#sendEmail" onclick="getlightbox($lboxes->id);"><i class="fa fa-envelope"></i> Email als Zip</a>
											
										</div>
										

										<!--<div class="single_lightbox_controls">
											<a href="{{URL::to('lightbox_content_downloadpdf/'.$lboxes->id)}}" class="textButton arrowButton default" >Download PDF</a>
											<a href="#" class="textButton arrowButton asLightbox lightbox_email cboxElement" data-toggle="modal" data-target="#sendEmail" onclick="getlightbox($lboxes->id);">Email</a>
										</div>-->
									</div>

									<div class="single_lightbox_wrapper_right">
										<ul>
											@if(!empty($lightcontent[$lboxes->id]))
												{{--*/ $lb_itm = count($lightcontent[$lboxes->id]); /*--}}
												@foreach($lightcontent[$lboxes->id] as $cont)
													<li id="imgfile{{$cont->id}}">
														<a href="#">
															<img src="{{URL::to('uploads/thumbs/').'/thumb_'.$cont->folder_id.'_'.$cont->file_name}}" alt="{{$cont->file_display_name}}">
														</a>
														<button type="button" class="remove_article" onclick="remove_boxcontent({{$cont->id}});">
															<img src="{{ asset('sximo/images/remove.gif')}}" alt="Delete">
														</button>
													</li>
												@endforeach
											@endif
										</ul>

										<div class="single_lightbox_showmore"><a class="arrowButton textButton" href="#">Show all</a></div>
									</div>
								</div>
							</div>
						@endforeach
					@endif
					<input type="hidden" name="tot_lb" id="tot_lb" value="{{$lb}}" />
					<input type="hidden" name="tot_lb_itm" id="tot_lb_itm" value="{{$lb_itm}}" />
				</div>
			</div>
		</div>
	</div>
</div>


<!-- choose lightbox Modal -->
<div class="modal fade" id="chooselight" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-top:100px;">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Choose Merkzettel:</h4>
	  </div>
	  <div class="modal-body">
		<div class="field">
			<label>Please select a Merkzettel <em>*</em></label>
			<div class="field-input">
				<input type="hidden" name="chsfile" id="chsfile" value="" />
				<select name="chslightboxes" id="chslightboxes" class="form-control">
				@foreach($lightboxes as $opt)
				  <option value="<?php echo $opt->id; ?>"><?php echo $opt->box_name; ?></option>
				@endforeach
				</select>
			</div>
		</div>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-primary" onclick="selectlightbox();">Zum Merkzettel hinzufügen und reservieren</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	  </div>
	  </form>
	</div>
  </div>
</div>

<!-- Send Email Modal -->
	<div class="modal fade" id="sendEmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="text-align:left;">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Send Email</h4>
		  </div>
		  {!! Form::open(array('url'=>'sendemail_lightbox', 'class'=>'columns' ,'id' =>'send_email_lightbox', 'method'=>'post' )) !!}
		  <input type="hidden" name="curnurl" value="{{ Request::url() }}">
		  <input type="hidden" name="fold_id" value="{{$prtfoldersname->id}}">
		  <input type="hidden" name="selecteditems" class="selecteditems" id="share_selecteditems" value="">
		  <div class="modal-body">
			<fieldset>
				<div class="MarBot10">
					<label>{{ Lang::get('core.fr_emailtype') }} <em>*</em> </label>
					<div class="field-input">
						<input type="checkbox" value="download" name="emailType[]" id="displaydown" checked="checked" onclick="show_hide_downloadoptions();"> Download links &nbsp;
						<!--<input type="checkbox" value="slideshow" name="emailType[]"> Show slideshow of images &nbsp;
						<input type="checkbox" value="flipbook" name="emailType[]" id="displayres" onclick="show_hide_flipbookoptions();"> View flipbook &nbsp;-->
						
					</div>
				</div>
				<div class="MarBot10" id="dltype">
					<div class="field-input">
						<input type="radio" value="zip-zip" name="downType" checked="checked" required> Download as Zip archive.&nbsp;
						<!--<input type="radio" value="pdf-high" name="downType" required> Download as PDF high res.
						<input type="radio" value="pdf-low" name="downType" required> Download as PDF low res.&nbsp;-->
					</div>
				</div>
				<div class="MarBot10" id="fltype" style="display:none;">
					<div class="field-input">
						<input type="radio" value="high" name="flipType" checked="checked" required> Flipbook as high res.&nbsp;
						<input type="radio" value="low" name="flipType" required> Flipbook as low res.
						
					</div>
				</div>
				<div class="MarBot10">
					<label>{{ Lang::get('core.fr_emailto') }} <em>*</em> ( comma separated )</label>
					<div class="field-input">
						<input type="text" name="emailids" id="enteremail" value="" required="required" >
						
					</div>
				</div>
				<div class="MarBot10">
					<label>{{ Lang::get('core.fr_emailsubject') }} <em>*</em></label>
					<div class="field-input">
						{!! Form::text('subject',null,array('placeholder'=>'','required'=>'true')) !!}
					</div>
				</div>
				<div class="MarBot10">
					<label>{{ Lang::get('core.fr_emailtemplate') }} <em>*</em></label>
					<div class="field-input">
						<select name="emailTemplate" required="required">
							<option value=""> --Select -- </option>
							<option value="lightbox_template1"> Template One </option>
						</select>
					</div>
				</div>
				<div>
					<label>{{ Lang::get('core.fr_emailmessage') }}<em>*</em></label>
					<div class="field-input">
						<textarea class="editor" rows="15" required name="message">
							
						</textarea>
					</div>
				</div>
			</fieldset>
		  </div>
		  <div class="modal-footer">
			<span id="sharemasage" style="color:red; font-weight:bold; float:left;"></span>
			<button type="submit" class="btn btn-primary" onclick="return check_selecteditems();">Send</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	
	<!-- Show reserve items-->
<div class="modal fade" id="showresereitems" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-top:40px;">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Reserviert</h4>
	  </div>
	  <div class="modal-body">
		<p>Vielen Dank für Ihre Reservierung. Die Reservierung erfolgt für 7Tage und wird danach automatisch deaktiviert. </p>
		<p>Ihre Produkten :</p>
		<div class="row ord_items">
		
		</div>
	  </div>
	  <div class="modal-footer">
		<a href="{{URL::to('lightboxorders')}}" class="btn btn-primary">Ihre Reservierung ansehen</a>
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	  </div>
	  </form>
	</div>
  </div>
</div>

<script>

	$(function(){
		/*$(".fancybox-manual-c").click(function() {
			$.fancybox.open([
				<?php foreach($imgfancy as $imgOBJ){
				
				echo '{href:'.'"'.$imgOBJ.'"},';
				
			}	?>
			], {
				helpers : {
					buttons	: {},
					overlay: { closeClick: false }
				}
			});
		});*/
		
		$('.gallery2').featherlightGallery({
			gallery: {
				fadeIn: 300,
				fadeOut: 300
			},
			variant: 'featherlight-gallery2'
		});
	});

	function hide_show_lightbox(act)
	{
		if(act!='')
		{
			if(act=="show")
			{
				$('.link-to-show').removeClass('active');
				$('.link-to-hide').addClass('active');
				$('#lightbox_basket').show();
				$('.container.foo-copy-right').css('margin-bottom','480px');
			}
			else if(act=="hide")
			{
				$('.link-to-hide').removeClass('active');
				$('.link-to-show').addClass('active');
				$('#lightbox_basket').hide();
				$('.container.foo-copy-right').css('margin-bottom','78px');
			}
		}
	}
	
	function show_hide_downloadoptions()
	{
		if ($('#displaydown').is(":checked")) {
			$("#dltype").show();
		}
		
		if (!$('#displaydown').is(":checked")) {
			$("#dltype").hide();
		}
	}
	
	function show_hide_flipbookoptions()
	{
		if ($('#displayres').is(":checked")) {
			$("#fltype").show();
		}
		
		if (!$('#displayres').is(":checked")) {
			$("#fltype").hide();
		}
	}
	
	function createnewbox()
	{
		$.ajax({
		  url: "{{ URL::to('create_lightbox')}}",
		  type: "post",
		  dataType: "json",
		  success: function(data){
			if(data.status=='error')
			{
				alert(data.errors);
			}
			else if(data.status=='success')
			{
				var pdflink = "{{URL::to('lightbox_content_downloadpdf/"+data.lightbox.id+"')}}";
				var newlightdiv = '';
				newlightdiv += '<div class="single_lightbox_wrapper'+data.lightbox.id+' single_lightbox_wrappertemp attached">';
				newlightdiv += '<input type="hidden" name="editlightboxid" id="editlightboxid" value="'+data.lightbox.id+'" />';
				newlightdiv += '<div class="single_lightbox_inner_wrapper">';
				newlightdiv += '<div class="single_lightbox_wrapper_left">';
				newlightdiv += '<div class="single_lightbox_title" data-lightbox-field="title">';
				newlightdiv += '<span id="lightbox_title">'+data.lightbox.box_name+'</span>';
				newlightdiv += '<a href="#" class="lightbox_rename" onclick="show_rename_form('+data.lightbox.id+');">Umbenennen</a>';
				newlightdiv += '<div class="lightbox_rename_wrapper disnon">';
				newlightdiv += '<input type="text" value="'+data.lightbox.box_name+'" name="editval" class="textbox'+data.lightbox.id+'" style="width:150px;">';
				newlightdiv += '<button type="button" class="lightbox_rename" onclick="lightbox_update_name('+data.lightbox.id+');">Save</button>';
				newlightdiv += '</div>';
				newlightdiv += '</div>';
				newlightdiv += '<div class="single_lightbox_controls">';
				/*newlightdiv += '<button type="button" class="remove_lightbox textButton arrowButton" onclick="deletelightbox('+data.lightbox.id+')">Entfernen</button>';*/
				newlightdiv += '<button type="button" class="remove_lightbox textButton arrowButton" onclick="make_reserve('+data.lightbox.id+');"><i class="fa fa-arrow-right"></i> Reservieren</button>';
				newlightdiv += '</div>';
				newlightdiv += '<div class="single_lightbox_controls">';
				newlightdiv += '<a href="'+pdflink+'" class="textButton arrowButton default">Download PDF</a>';
				newlightdiv += '<a href="" class="textButton arrowButton asLightbox lightbox_email cboxElement" data-toggle="modal" data-target="#sendEmail" onclick="getlightbox('+data.lightbox.id+');">Email</a>';
				newlightdiv += '</div>';
				newlightdiv += '</div>';
				newlightdiv += '<div class="single_lightbox_wrapper_right">';
				newlightdiv += '<ul></ul>';
				newlightdiv += '</div>';
				newlightdiv += '</div>';
				newlightdiv += '</div>'; 
				
				$('#lightbox_outer_wrapper').append(newlightdiv);
				
				var get_tot_lb = parseInt($('#tot_lb').val());
				$('#tot_lb').val(get_tot_lb+1);
			}
		  }
		});
	}
	
	function deletelightbox(lightId)
	{
		if(lightId!="" && lightId > 0)
		{
			$.ajax({
			  url: "{{ URL::to('delete_lightbox')}}",
			  type: "post",
			  data: "lightboxId="+lightId,
			  success: function(data){
				if(data=='error')
				{
					alert('Merkzettel not found');
				}
				else if(data=='success')
				{
					$('.single_lightbox_wrapper'+lightId).remove();
					var get_tot_lb = parseInt($('#tot_lb').val());
					$('#tot_lb').val(get_tot_lb-1);
				}
			  }
			});
		}
		else
		{
			alert('Merkzettel not found');
		}			
	}
	
	function show_rename_form(boxid)
	{
		if(boxid!="" && boxid > 0)
		{
			$('.single_lightbox_wrapper'+boxid+' #lightbox_title').hide();
			$('.single_lightbox_wrapper'+boxid+' .lightbox_rename').hide();
			$('.single_lightbox_wrapper'+boxid+' .lightbox_rename_wrapper').show();
			//$('.single_lightbox_wrapper'+boxid+' .lightbox_rename').show();
		}
		else{
			alert('Merkzettel not found');
		}
	}
	
	function lightbox_update_name(lightId)
	{
		if(lightId!="" && lightId > 0)
		{
			var lightname = $.trim($('.textbox'+lightId).val());
			if(lightname!='')
			{
				$.ajax({
				  url: "{{ URL::to('lightboxupdatename')}}",
				  type: "post",
				  data: "lightboxId="+lightId+"&newname="+lightname,
				  success: function(data){
					if(data=='error')
					{
						alert('Merkzettel not found');
					}
					else if(data=='success')
					{
						$('.textbox'+lightId).val(lightname);
						$('.single_lightbox_wrapper'+lightId+' #lightbox_title').html(lightname);
						$('.single_lightbox_wrapper'+lightId+' #lightbox_title').show();
						$('.single_lightbox_wrapper'+lightId+' .lightbox_rename').show();
						$('.single_lightbox_wrapper'+lightId+' .lightbox_rename_wrapper').hide();
					}
				  }
				});
			}
		}
		else
		{
			alert('Merkzettel not found');
		}			
	}
	
	function add_to_lightbox(fileId)
	{
		if(fileId!="")
		{
			var tot_box = $('#tot_lb').val();
			var tot_box_itms = $('#tot_lb_itm').val();
			if(tot_box>0)
			{
				var lid = '';
				if(tot_box_itms < 3)
				{
					if(tot_box>1)
					{
						$('#chooselight #chsfile').val(fileId);	
						$('#chooselight').modal('show');
					}
					else
					{
						lid = $('#editlightboxid').val();
						add_lightbox_content(fileId, lid);
					}
				}
				else
				{
					alert('You can not add more than 3 products to Merkzettel.');
				}
			}
			else
			{
				alert('BITTE ERSTELLEN SIE ZUERST EINEN Merkzettel BEVOR SIE EIN PRODUKT HINZUFÜGEN');
			}
		}
	}
	
	function selectlightbox()
	{
		var chos_box = $('#chslightboxes').val();
		var chos_file = $('#chsfile').val();
		add_lightbox_content(chos_file, chos_box);
	}
	
	function add_lightbox_content(chos_file_id, chos_box_id)
	{
		if(chos_file_id > 0 && chos_box_id > 0)
		{
			$.ajax({
			  url: "{{ URL::to('lightbox_addcontent')}}",
			  type: "post",
			  data: "lightboxId="+chos_box_id+"&fileId="+chos_file_id+"&typeId={{$fid}}",
			  dataType: "json",
			  success: function(data){
				if(data.status=='error')
				{
					alert('Merkzettel not found');
				}
				else if(data.status=='success')
				{
					var newcont = '';
					var img = "{!!URL::to('uploads/thumbs/thumb_" + data.lightboxcontent.folder_id + "_" +  data.lightboxcontent.file_name + "')!!}";
					var remimg = "{{ asset('sximo/images/remove.gif')}}";
					newcont +='<li id="imgfile'+data.lightboxcontent.id+'">';
					newcont +='<a href="#">';
					newcont +='<img src="'+img+'" alt="'+data.lightboxcontent.file_display_name+'">';
					newcont +='<p style="position:fixed;">'+ data.lightboxcontent.file_title+'</p>';
					newcont +='</a>';
					newcont +='<button type="button" class="remove_article">';
					newcont +='<img src="'+remimg+'" alt="Delete" onclick="remove_boxcontent('+data.lightboxcontent.id+');">';
					newcont +='</button>';
					newcont +='</li>';
					$('.single_lightbox_wrapper'+chos_box_id+' .single_lightbox_wrapper_right ul').append(newcont);
					$('#chooselight').modal('hide');
					$('.link-to-show').removeClass('active');
					$('.link-to-hide').addClass('active');
					$('#lightbox_basket').show();
					$('.container.foo-copy-right').css('margin-bottom','480px');
					var get_tot_lb_itm = parseInt($('#tot_lb_itm').val());
					$('#tot_lb_itm').val(get_tot_lb_itm+1);
				}
			  }
			});
		}
		else{
			alert('Please choose a Merkzettel first');
		}
	}
	
	function remove_boxcontent(contentId)
	{
		if(contentId!="" && contentId > 0)
		{
			$.ajax({
			  url: "{{ URL::to('delete_lightbox_content')}}",
			  type: "post",
			  data: "contentId="+contentId,
			  success: function(data){
				if(data=='error')
				{
					alert('Merkzettel image not found');
				}
				else if(data=='success')
				{
					$('#imgfile'+contentId).remove();
					var get_tot_lb_itm = parseInt($('#tot_lb_itm').val());
					$('#tot_lb_itm').val(get_tot_lb_itm-1);
				}
			  }
			});
		}
		else
		{
			alert('Merkzettel not found');
		}			
	}
	
	function getlightbox(lid)
	{
		if(lid>0 && lid!='')
		{
			$('#share_selecteditems').val(lid);
		}
	}
	
	function make_reserve(lightboxId)
	{
		if(lightboxId > 0)
		{
			$.ajax({
			  url: "{{ URL::to('lightbox_reserve')}}",
			  type: "post",
			  data: "lightboxId="+lightboxId,
			  dataType: "json",
			  success: function(data){
				if(data.status=='error')
				{
					alert(data.errors);
				}
				else if(data.status=='success')
				{
					var newcont = '';
					var obj = data.reserved;
					var dataMin = eval(obj.replace(/[\r\n]/, ""));
					
					$.each(dataMin, function(i, val)
					{
						
						var img = "{!!URL::to('uploads/thumbs/thumb_" + val.folder_id + "_" +  val.file_name + "')!!}";
						newcont += '<div class="col-sm-3">';
						newcont += '<img src="'+img+'"><br>';
						newcont += '<span style="font-size:14px;">'+val.file_display_name+'</span>';
						newcont += '</div>';
					});
					
					$('.ord_items').append(newcont);
					$('.link-to-hide').removeClass('active');
					$('.link-to-show').addClass('active');
					$('#lightbox_basket').hide();
					$('.container.foo-copy-right').css('margin-bottom','78px');
					$('#showresereitems').modal('show');
				}
			  }
			});
		}
		else{
			alert('Please choose a Merkzettel first');
		}
	}
	
</script>

<script>
	function redirect_product_cat(proID)
	{
		if(proID!='' && proID>0)
		{
			window.location.href = '<?php echo URL::to('subproduct'); ?>'+'/'+proID;
		}
		else
		{
			window.location.href = '<?php echo URL::to('products'); ?>';
		}
	}
</script>