<link href="{{ asset('sximo/css/frontend_templete/grid.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('sximo/css/featherlight/featherlight.min.css') }}">
<link rel="stylesheet" href="{{ asset('sximo/css/featherlight/featherlight.gallery.min.css') }}">
<script src="{{ asset('sximo/js/featherlight/featherlight.min.js') }}"></script>
<script src="{{ asset('sximo/js/featherlight/featherlight.gallery.min.js') }}"></script>
<style>
.disnon { display:none; }
.modal-dialog{ width:700px !important; }
#sendEmail input[type="text"], #sendEmail input[type="email"], textarea, select {
    width: 600px;
}
.container.foo-copy-right {
	 margin-bottom: 78px;
}

#back-top > a
{
	bottom:545px !important;
}

.fa
{
	display:inline !important;
}

.cust_size { width:160px !important; height:160px; }
.algCtr { text-align:center; }
.modal { z-index:999999; }
.social-buttons a { margin-right:10px; }
</style>
{{--*/ $imgfancy = array(); /*--}}
<div class="container">
	@if(!empty($final_folders))
		@foreach($final_folders as $products)
			<section data-selector="section" id="text-2col">
				<div class="container">
					<div class="row about-sec">
					
						<h1 data-selector="h3" class="title">{{$prtfoldersname->display_name}}</h1>

					</div>
				</div>
			</section>
			
			<section id="benefits-grid-images-left" class="new-padding" style="padding-top:20px;">
				<div class="masonry-grid-main">
					<div class="container">
						<article>
						@if(!empty($products['child']))
							{{--*/ 
								$pd = 0;
								
								usort($products['child'], function($a, $b) {
									return $a['data']['sort_num'] - $b['data']['sort_num']; 
								});
							/*--}}
							@foreach($products['child'] as $subproducts)
							
								@if($subproducts['data']['file_type']=="folder")
									{{--*/ $ProductcoverPic = ($subproducts['data']['cover_img']!='')? URL::to('uploads/folder_cover_imgs/masonry_product_'.$subproducts['data']['cover_img']): URL::to('uploads/images/product_no-image.jpg');
									$downloadProductPicLow = '';
									$downloadProductPicHigh = '';
									$name = (strlen($subproducts['data']['name']) > 23) ? substr($subproducts['data']['name'],0,20)."~":$subproducts['data']['name'];
									/*--}}
								@else
									@if($subproducts['data']['file_type']=="pdf")
										{{--*/ $ProductcoverPic = URL::to('uploads/images/pdf_icon_klein.png'); $custSize='cust_size'; $algcnt='algCtr'; /*--}}
									@elseif($subproducts['data']['file_type']=="vnd.openxmlformats-officedocument.word")
										{{--*/ $ProductcoverPic = URL::to('uploads/images/doc_icon_klein.png'); $custSize='cust_size'; $algcnt='algCtr'; /*--}}
									@else
										{{--*/ $imgfancy[] = $subproducts['data']['imgsrc'].$subproducts['data']['cover_img']; /*--}}
										@if($subproducts['data']['reserved']=='yes')
											{{--*/ $ProductcoverPic = URL::to('uploads/images/reserviert-neu.png'); $custSize=''; $algcnt=''; /*--}}
										@else
											{{--*/ $ProductcoverPic = ($subproducts['data']['cover_img']!='')? URL::to('uploads/thumbs/format_'.$subproducts['data']['folder_id'].'_'.$subproducts['data']['cover_img']): URL::to('uploads/images/product_no-image.jpg'); $custSize=''; $algcnt=''; /*--}}
										@endif
									@endif
									
									{{--*/ $downloadProductPicLow = ($subproducts['data']['cover_img']!='')? $subproducts['data']['imgsrc'].$subproducts['data']['cover_img'] : URL::to('uploads/images/product_no-image.jpg');
									
									$downloadProductPicHigh = ($subproducts['data']['cover_img']!='')? $mainfoldersrc.'jpg-highres/'.$subproducts['data']['cover_img'] : URL::to('uploads/images/product_no-image.jpg');

									$expFile = explode('.',$subproducts['data']['name']);
									$name = (strlen($subproducts['data']['name']) > 20) ? substr($subproducts['data']['name'],0,17)."~.". end($expFile):$subproducts['data']['name'];
									
									$productimagelink = URL::to('uploads/thumbs/highflip_'.$subproducts['data']['folder_id'].'_'.$subproducts['data']['cover_img']);
									/*--}}
								@endif
								
								@if($prtfoldersname->title!='')
									{{--*/ $title = (strlen($prtfoldersname->title) > 200)?substr($prtfoldersname->title,0,200): $prtfoldersname->title; /*--}}
								@elseif($subproducts['data']['title']!='')
									{{--*/ $title = (strlen($subproducts['data']['title']) > 200)?substr($subproducts['data']['title'],0,200): $subproducts['data']['title']; /*--}}
								@else
									{{--*/ $title = $pageTitle; /*--}}
								@endif
								
								@if($prtfoldersname->description!='')
									{{--*/ $descp = (strlen($prtfoldersname->description) > 255)?substr($prtfoldersname->description,0,255): $prtfoldersname->description; /*--}}
								@elseif($subproducts['data']['description']!='')
									{{--*/ $descp = (strlen($subproducts['data']['description']) > 255)?substr($subproducts['data']['description'],0,255): $subproducts['data']['description']; /*--}}
								@else
									{{--*/ $descp = ''; /*--}}
								@endif
								
								@if($subproducts['data']['file_type']!="pdf" && $subproducts['data']['file_type']!="vnd.openxmlformats-officedocument.word")
									<div class="masonry-grid {{$algcnt}}">
										<a href="{{$downloadProductPicLow}}" title="Slideshow" class="gallery2">
											<img src="{{$ProductcoverPic}}" alt="feature" class="{{$custSize}} fancybox-buttons" data-fancybox-group="button">
										</a>
										<p class="social-buttons">
											<a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}&title={{urlencode($title)}}&description={{urlencode($descp)}}"
											   target="_blank">
											   <i class="fa fa-facebook"></i>
											</a>
											<a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::url()) }}&text={{urlencode($title)}}"
											   target="_blank">
												<i class="fa fa-twitter"></i>
											</a>
											<!--<a href="https://plus.google.com/share?url={{ urlencode(Request::url()) }}"
											   target="_blank">
											   <i class="fa fa-google-plus"></i>
											</a>
											<a href="http://www.linkedin.com/shareArticle?mini=true&url={{urlencode(Request::url())}}&title={{urlencode($title)}}&summary={{urlencode($descp)}}"
											   target="_blank">
											   <i class="fa fa-linkedin"></i>
											</a>-->
											<a href="https://pinterest.com/pin/create/button/?{{
												http_build_query([
													'url' => Request::url(),
													'media' => $ProductcoverPic,
													'title' => $title,
													'description' => $descp
												])
												}}" target="_blank">
												<i class="fa fa-pinterest-p"></i>
											</a>
										</p>
									</div>
								@endif
							@endforeach
						@endif
						</article>
						<p style="text-align:center; margin-top: 15px;"><a href="#" onclick="window.history.back();return false;"><i class="fa fa-reply"></i> Zurück zur Übersicht</a></p>
					</div>
				</div>
			</section>
		@endforeach
	@endif

</div>

<div id="fixed_wrapper">
	<!-- Lightbox Modal -->
	<div id="lightbox_basket_wrapper">
		<div id="lightbox_basket_trigger">
			<a href="#" class="link-to-show active" onclick="hide_show_lightbox('show');">Merkzettl<span class="arrow_down"></span></a>
			<a href="#" class="link-to-hide" onclick="hide_show_lightbox('hide');">Merkzettl<span class="arrow_down"></span></a>
		</div>

		<div id="lightbox_basket">
			<div id="lightbox_basket_content">
				<div id="lightbox_outer_wrapper">
					<div id="create_lightbox" class="attached">
						
						<div class="lightbox_addon">
							<p>Im Merkzettl können maximal drei<br> Monolithplatten hinterlegt werden.<br> Die Reservierung erfolgt für 7Tage und <br> wird danach automatisch deaktiviert.</p>
							<button type="button" class="textButton" onclick="createnewbox();">Neu Merkzettl erstellen +</button>
						</div>
					</div>
					{{--*/ $lb=0; /*--}}
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
										<div class="single_lightbox_controls">
											<button type="button" class="remove_lightbox textButton arrowButton" onclick="deletelightbox('{{$lboxes->id}}');">Entfernen</button>
											<button type="button" class="remove_lightbox textButton arrowButton" onclick="make_reserve('{{$lboxes->id}}');"><i class="fa fa-arrow-right"></i> Bestellen</button>
											
										</div>

										<div class="single_lightbox_controls">
											<a href="{{URL::to('lightbox_content_downloadpdf/'.$lboxes->id)}}" class="textButton arrowButton default" >Download PDF</a>
											<a href="#" class="textButton arrowButton asLightbox lightbox_email cboxElement" data-toggle="modal" data-target="#sendEmail" onclick="getlightbox($lboxes->id);">Email</a>
										</div>
									</div>

									<div class="single_lightbox_wrapper_right">
										<ul>
											@if(!empty($lightcontent[$lboxes->id]))
												@foreach($lightcontent[$lboxes->id] as $cont)
													<li id="imgfile{{$cont->id}}">
														<a href="#">
															<img src="{{URL::to('uploads/thumbs/').'/thumb_'.$cont->folder_id.'_'.$cont->file_name}}" alt="{{$cont->file_display_name}}">
															<p>{{$cont->file_title}}</p>
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
		<h4 class="modal-title" id="myModalLabel">Choose Merkzettl:</h4>
	  </div>
	  <div class="modal-body">
		<div class="field">
			<label>Please select a Merkzettl <em>*</em></label>
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
		<button type="button" class="btn btn-primary" onclick="selectlightbox();">Add to Merkzettl</button>
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
			<button type="submit" class="btn btn-primary">Send</button>
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
		<?php if(\Auth::check() == false) { ?>
			$('.link-to-hide').removeClass('active');
			$('.link-to-show').addClass('active');
			$('#lightbox_basket').hide();
			$('.container.foo-copy-right').css('margin-bottom','78px');
			$('#myModal').modal('show');
		<?php } else { ?>
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
				newlightdiv += '<button type="button" class="remove_lightbox textButton arrowButton" onclick="deletelightbox('+data.lightbox.id+')">Entfernen</button>';
				newlightdiv += '<button type="button" class="remove_lightbox textButton arrowButton" onclick="make_reserve('+data.lightbox.id+');"><i class="fa fa-arrow-right"></i> Bestellen</button>';
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
		<?php } ?>
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
					alert('Merkzettl not found');
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
			alert('Merkzettl not found');
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
			alert('Merkzettl not found');
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
						alert('Merkzettl not found');
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
			alert('Merkzettl not found');
		}			
	}
	
	function add_to_lightbox(fileId)
	{
		if(fileId!="" && fileId > 0)
		{
			var tot_box = $('#tot_lb').val();
			if(tot_box>0)
			{
				var lid = '';
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
				alert('BITTE ERSTELLEN SIE ZUERST EINEN Merkzettl BEVOR SIE EIN PRODUKT HINZUFÜGEN');
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
			  data: "lightboxId="+chos_box_id+"&fileId="+chos_file_id,
			  dataType: "json",
			  success: function(data){
				if(data.status=='error')
				{
					alert('Merkzettl not found');
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
				}
			  }
			});
		}
		else{
			alert('Please choose a Merkzettl first');
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
					alert('Merkzettl image not found');
				}
				else if(data=='success')
				{
					$('#imgfile'+contentId).remove();
				}
			  }
			});
		}
		else
		{
			alert('Merkzettl not found');
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
					alert('Ihre Bestellung wir nun bearbeitet.');
				}
			  }
			});
		}
		else{
			alert('Please choose a Merkzettl first');
		}
	}
	
</script>