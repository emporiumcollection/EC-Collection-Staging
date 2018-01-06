<link rel="stylesheet" type="text/css" href="{{ asset('sximo/themes/elliot/project7/css/project7.css') }}">	
<link rel="stylesheet" type="text/css" href="{{ asset('sximo/themes/elliot/project7/css/project7_ans.css') }}">
<link rel="stylesheet" type="text/safari" href="{{ asset('sximo/themes/elliot/project7/css/project7_safari.css') }}"> 

<style>
.disnon { display:none; }
.modal-dialog {
    width: 700px !important;
}
input[type="text"], input[type="email"], textarea, select {
    width: 600px;
	background:#000;
}
.btn-default
{
	border-radius: 0;
}
.lightbox_rename_wrapper  input[type="text"]{color:#fff;}
	.detail-tile-inner h3{
		    font-size: 23px;
    color: #fff;
    font-weight: 700;
	}
	.detail-tile-inner p{font-size: 18px;
    color: #fff;}
	#frontpage-layer-bj-header-logo {
    text-indent: -9999px;
    margin: 0 auto;
    display: block;
    width: 253px;
    height: 60px;
    background: url(/public/sximo/images/imgpsh_fullsize-logo.png) transparent no-repeat center top;
}
h3.popup-property-title{font-size:14px;margin-bottom:20px;font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;}
p.popup-property-desc{        font-style: italic; font-size: 12px;
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    line-height: 21px;}
</style>
<div id="content_wrapper" class="innerpage">
    <div class="left " id="left_wrapper">
        <div id="left">
    
	<div id="tree_toggle" class="">
    	<div id="tree_toggle_trigger">
        <span class="__hide" style="display: none;">Hide</span>
        <span class="__show" style="display: inline;">Show</span>
Menu </div>
    </div>
    
                                                                        
    @if(!empty($tagmenus))                           	                                        
		<ul class="tree" id="tree" style="display: none;">                
            @foreach($tagmenus[0] as $tagsm)                                                            
				<li class="expanded hidden hasSubCats level2" onclick="show_tag_childs(this, {{$tagsm->id}});">
					 <a href="#">{{$tagsm->tag_title}}</a> 
					@if (array_key_exists($tagsm->id, $tagmenus))
						 <ul id="child{{$tagsm->id}}"> 
							@foreach($tagmenus[$tagsm->id] as $tagsmc)
								<li class="hidden end level3"> <a href="{{URL::to('search?s='.$tagsmc->tag_title)}}">{{$tagsmc->tag_title}} </a></li>
							@endforeach
						  </ul>
					@endif
				</li>
			@endforeach
		</ul>
    @endif                                         


    	
                </div>					
            </div>
                <div id="content">
	
            <div class="locator clear">
            
	    
    <div id="quick_pager" class="pager topPopList">
        <div id="quick_pager_header">
            Jump to page
                    </div>
        <div style="display: none;" class="flyoutBox">
            <ul id="quick_pager_ul">
                                    <li data-id="1"> <span><a href="#">1</a></span></li>
                                    <li data-id="2"> <span><a href="#">2</a></span></li>
                                    <li data-id="3"> <span><a href="#">3</a></span></li>
                                    <li data-id="4"> <span><a href="#">4</a></span></li>
                                    <li data-id="5"> <span><a href="#">5</a></span></li>
                                    <li data-id="6"> <span><a href="#">6</a></span></li>
                                    <li data-id="7"> <span><a href="#">7</a></span></li>
                                    <li data-id="8"> <span><a href="#">8</a></span></li>
                                    <li data-id="9"> <span><a href="#">9</a></span></li>
                                    <li data-id="10"> <span><a href="#">10</a></span></li>
                             
                            </ul>
        </div>
    </div>
    <div id="itemsPager" class="pager">
                                               <a class="page active" href="#">1</a>
               	<span class="locator_sep">.</span><a class="page" href="#">2</a>
               	<span class="locator_sep">.</span> <a class="page" href="#">3</a>
               	<span class="locator_sep">.</span><a class="page" href="#">4</a>
               	<span class="locator_sep">.</span><a class="page" href="#">5</a>
               	<span class="locator_sep">.</span><span class="locator_sep">..</span>
               <a class="page" href="#">10</a>
               	<a href="#" class="next">
        	
        </a>
         </div>

    </div>
       
		<a name="list_top"></a>
		@if($propertiesArr)
			<ul id="productList" class="infogridView clear">
				@foreach($propertiesArr as $props)
					<li class="productData">
						<div class="wrapperforliineedforlightboxremoval">
							<div class="cat_product_medium1">
								<div class="pictureBox gridPicture">
									@if(array_key_exists('image', $props))
										<a title="{{$props['image']->file_name}}" class="picture_link " href="{{URL::to('property/'.$props['data']->property_slug)}}">		
											<img alt="{{$props['image']->file_name}}" src="{{URL::to('uploads/property_imgs_thumbs/front_property_'.$props['image']->folder_id.'_'.$props['image']->file_name)}}">
										</a>
									@endif
								</div>
								<div class="listDetails">
									<div class="photographBox">
										<a title="{{$props['data']->property_name}}" class="photograph" href="{{URL::to('property/'.$props['data']->property_slug)}}">
											<h2>{{$props['data']->property_name}}</h2>
										</a>
									</div>
									<a href="#" id="LearnMoreBtn1" @if(array_key_exists('image', $props)) onclick="add_to_lightbox({{$props['image']->file_id}});" @endif >Add to lightbox</a>

									<div class="entire_story">
										<a class="textButton arrowButton" href="{{URL::to('property/'.$props['data']->property_slug)}}">
											View more 
										</a>
										<a class="textButton arrowButton quick_view" rel="{{$props['data']->id}}"href="#">
											Quick View
										</a>
									</div>
						
									<div class="showOnHover">
										<div class="hover_request">
									   </div>   
									</div>
								</div>
							</div>
						</div>
					</li>
				@endforeach
			</ul>
		@endif
    </div>
</div>
</div>

<div id="fixed_wrapper">
	<!-- Lightbox Modal -->
	<div id="lightbox_basket_wrapper">
		<div id="lightbox_basket_trigger">
			<a href="#" class="link-to-show active" onclick="hide_show_lightbox('show');">Lightbox<span class="arrow_down"></span></a>
			<a href="#" class="link-to-hide" onclick="hide_show_lightbox('hide');">Hide Lightbox<span class="arrow_down"></span></a>
		</div>

		<div id="lightbox_basket">
			<div id="lightbox_basket_content">
				<div id="lightbox_outer_wrapper">
					<div id="create_lightbox" class="attached">
						<div class="lightbox_addon">
							<button type="button" class="textButton" onclick="createnewbox();">Create new Lightbox +</button>
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
											<a href="#" class="lightbox_rename" onclick="show_rename_form({{$lboxes->id}});">Rename</a>
											<div class="lightbox_rename_wrapper disnon">
												<input type="text" value="{{$lboxes->box_name}}" name="editval" class="textbox{{$lboxes->id}}" style="width:150px;">
												<button type="button" onclick="lightbox_update_name({{$lboxes->id}});">Save</button>
											</div>
										</div>
										<div class="single_lightbox_controls">
											
											<a href="{{URL::to('lightbox_content_downloadpdf/'.$lboxes->id)}}" class="textButton arrowButton default" > <i class="fa fa-download"></i> Download PDF</a>&nbsp;
											
										</div>
										<div class="single_lightbox_controls">
											
											<a href="#" class="textButton arrowButton asLightbox lightbox_email cboxElement" data-toggle="modal" data-target="#sendEmail" onclick="getlightbox({{$lboxes->id}});"><i class="fa fa-envelope"></i> Email</a>
											
										</div>
										
										<div class="single_lightbox_controls">
											<a href="#" class="textButton arrowButton default" onclick="deletelightbox({{$lboxes->id}});"><i class="fa fa-remove"></i> Delete</a>
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
	
	<div id="footer_wrapper">
            
    <div id="footer_links">
    				<a href="#" title="Imprint">Imprint</a>&nbsp;&nbsp;&nbsp; 
                        	<a href="#" title="Terms &amp; Conditions">Terms &amp; Conditions</a>&nbsp;&nbsp;&nbsp;
                        	<a href="#" title="About">About</a>&nbsp;&nbsp;&nbsp;
                            <a href="#" title="Jobs">Jobs</a>&nbsp;&nbsp;&nbsp;
                <a href="{{URL::to('contact-us')}}" rel="nofollow">Contact</a>&nbsp;&nbsp;&nbsp;
        <a href="#" title="Account" data-toggle="modal" data-target="#myModal">Account</a>
        </div>
        

    
        </div>
</div>

<!--<div id="fixed_wrapper">
	<div id="lightbox_basket_wrapper">
		<div id="lightbox_basket_trigger">
			<a href="#" class="link-to-show active">Lightbox</a>
			<a href="#" class="link-to-hide">Hide Lightbox<span class="arrow_down"></span></a>
		</div>
		
		<div id="lightbox_basket">
			<div id="lightbox_basket_content">
				<div id="lightbox_outer_wrapper" data-lightbox-field="outer-wrapper-element">
                    <div id="create_lightbox" class="attached" data-lightboxid="addOn-Recommlist" data-lightbox-field="wrapper-element">
					    <div class="lightbox_addon">
							<form action="#" data-form-function="addLightbox" class="sendPerAjax">
						        <input name="stoken" value="18D20F1B" type="hidden"><input name="force_sid" value="v9m1jfmdnkrnivc90eugujgfb1" type="hidden">
								<input name="lang" value="1" type="hidden">
							    <input name="ldtype" value="infogrid" type="hidden">
								<input name="cl" value="dd_ajax" type="hidden">
								<input name="fnc" value="dd_addLightbox" type="hidden">
					            <button type="submit" value="" class="textButton">Create new lightbox +</button>
							</form>
						</div>
					
					</div>
					<div class="single_lightbox_wrapper attached" data-lightboxid="ij4f6a94385b58e2a6d4d403a84ba207" data-lightbox-field="wrapper-element">
						<div class="single_lightbox_inner_wrapper">
							<div class="single_lightbox_wrapper_left">
								<div class="single_lightbox_title" data-lightbox-field="title">
									<span id="lightbox_title">Lightbox 04f</span>
									<a href="#" data-lightbox-field="rename-button" class="lightbox_rename">Rename</a>
									<div class="lightbox_rename_wrapper">
										<form action="#" data-form-function="renameLightbox" class="sendPerAjax" style="display: none;">
											<input name="stoken" value="18D20F1B" type="hidden"><input name="force_sid" value="v9m1jfmdnkrnivc90eugujgfb1" type="hidden">
					<input name="lang" value="1" type="hidden">
											<input name="ldtype" value="infogrid" type="hidden">

											<input name="cl" value="dd_ajax" type="hidden">
											<input name="fnc" value="dd_renameLightbox" type="hidden">
											<input name="editval[oxrecommlists__oxid]" value="ij4f6a94385b58e2a6d4d403a84ba207" type="hidden">
											<input value="Lightbox 04f" name="editval[oxrecommlists__oxtitle]" class="textbox" type="text">
											<button type="submit" value="" class="lightbox_rename">Save</button>
										</form>
									</div>
								</div>
								<div class="single_lightbox_controls">
									<a href="#" class="textButton arrowButton">View</a>
									<form action="#">
										<input name="stoken" value="18D20F1B" type="hidden"><input name="force_sid" value="v9m1jfmdnkrnivc90eugujgfb1" type="hidden">
					<input name="lang" value="1" type="hidden">
										<input name="ldtype" value="infogrid" type="hidden">

										<input name="cl" value="order" type="hidden">
										<input name="fnc" value="dd_setLightboxToBasket" type="hidden">
										<input name="editval[oxrecommlists__oxid]" value="ij4f6a94385b58e2a6d4d403a84ba207" type="hidden">
										<button type="submit" value="" class="textButton arrowButton">Request</button>
									</form>
									
									<form action="#" data-form-function="removeLightbox" class="sendPerAjax">
										<input name="stoken" value="18D20F1B" type="hidden"><input name="force_sid" value="v9m1jfmdnkrnivc90eugujgfb1" type="hidden">
					<input name="lang" value="1" type="hidden">
										<input name="ldtype" value="infogrid" type="hidden">

										<input name="cl" value="dd_ajax" type="hidden">
										<input name="fnc" value="dd_removeLightbox" type="hidden">
										<input name="editval[oxrecommlists__oxid]" value="ij4f6a94385b58e2a6d4d403a84ba207" type="hidden">
										<button type="submit" value="" class="remove_lightbox textButton arrowButton">Delete</button>
									</form>
								</div>

												<div class="single_lightbox_controls">
															<a href="#" class="textButton arrowButton default">Download PDF</a>
										<a href="#" class="textButton arrowButton asLightbox lightbox_email cboxElement">Email</a>

									</div>
										

							</div>

							<div class="single_lightbox_wrapper_right">
												<p>Die Lightbox ist leer.</p>
										</div>
						</div>
	
	
					</div>
					        
					    
					</div>
            	</div>
            </div>
        </div>
	
	

                
		        <div id="footer_wrapper">
            
    <div id="footer_links">
    				<a href="#" title="Imprint">Imprint</a>&nbsp;&nbsp;&nbsp; 
                        	<a href="#" title="Terms &amp; Conditions">Terms &amp; Conditions</a>&nbsp;&nbsp;&nbsp;
                        	<a href="#" title="About">About</a>&nbsp;&nbsp;&nbsp;
                            <a href="#" title="Jobs">Jobs</a>&nbsp;&nbsp;&nbsp;
                <a href="{{URL::to('contact-us')}}" rel="nofollow">Contact</a>&nbsp;&nbsp;&nbsp;
        <a href="#" title="Account" data-toggle="modal" data-target="#myModal">Account</a>
        </div>
        

    
        </div>
    </div>-->
	
	<div id="all_js_container">

	
    </div>
		
<!-- choose lightbox Modal -->
<div class="modal fade" id="chooselight" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-top:100px; color:#000;">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Choose Lightbox:</h4>
	  </div>
	  <div class="modal-body">
		<div class="field">
			<label>Please select a Lightbox <em>*</em></label>
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
		<button type="button" class="btn btn-primary" onclick="selectlightbox();">Add</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	  </div>
	  </form>
	</div>
  </div>
</div>

<!-- Send Email Modal -->
<div class="modal fade" id="sendEmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="text-align:left; color:#000;">
  <div class="modal-dialog" role="document">
	<div class="modal-content" style="background: #000;color: #fff;opacity: 0.9;border-radius: 0;">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Send Email</h4>
	  </div>
	  {!! Form::open(array('url'=>'sendemail_lightbox', 'class'=>'columns' ,'id' =>'send_email_lightbox', 'method'=>'post' )) !!}
	  <input type="hidden" name="curnurl" value="{{ Request::url() }}">
	  <input type="hidden" name="fold_id" value="">
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
					<textarea class="editor" rows="15" required name="message"></textarea>
				</div>
			</div>
		</fieldset>
	  </div>
	  <div class="modal-footer">
		<span id="sharemasage" style="color:red; font-weight:bold; float:left;"></span>
		<button type="submit" class="btn btn-default" onclick="return check_selecteditems();">Send</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	  </div>
	  </form>
	</div>
  </div>
</div>

<div class="modal fade" id="myModalCreateLightBox" tabindex="-1" role="dialog" aria-labelledby="myModalCreateLightBox" style="text-align:left; color:#000;">
	<div class="modal-dialog" role="document">
		<div class="modal-content" style="background: #000;color: #fff;opacity: 0.9;border-radius: 0;">
			You have to sign in/signup for creating new LightBox<br/>
		<p style="padding:5px 0px;"><button onclick="location.href='/public/user/login'" style="padding:5px 10px;  background:#fff; color:#000;">Login/SignUp</button></p>
		</div>
	</div>
</div>	
	         <script>
$(document).ready(function () {   
        
        $('#tree_toggle_trigger').click(function(){
  $(this).find('.__hide').toggle();
  $(this).find('.__show').toggle();
$('#tree').toggle('slideup');
});
});

	function show_tag_childs(tag, tagid)
	{
		if(tagid!='' && tagid > 0)
		{
			if ( $('#child'+tagid+' li').hasClass( "hidden" ) ) {
				$(tag).removeClass('hidden');
				$('#child'+tagid+' li').removeClass('hidden');
			}
			else
			{
				$(tag).addClass('hidden');
				$('#child'+tagid+' li').addClass('hidden');
			}
		}
	}
	
	function hide_show_lightbox(act)
	{
		if(act!='')
		{
			if(act=="show")
			{
				$('.link-to-show').removeClass('active');
				$('.link-to-hide').addClass('active');
				$('#lightbox_basket').show();
				//$('.container.foo-copy-right').css('margin-bottom','480px');
			}
			else if(act=="hide")
			{
				$('.link-to-hide').removeClass('active');
				$('.link-to-show').addClass('active');
				$('#lightbox_basket').hide();
				//$('.container.foo-copy-right').css('margin-bottom','78px');
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
		var loggedIn = '{{isset(\Auth::user()->id)?\Auth::user()->id:''}}';
		if(loggedIn==''){
			$('#myModalCreateLightBox').modal('show');
		}else{
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
				newlightdiv += '<a href="#" class="lightbox_rename" onclick="show_rename_form('+data.lightbox.id+');">Rename</a>';
				newlightdiv += '<div class="lightbox_rename_wrapper disnon">';
				newlightdiv += '<input type="text" value="'+data.lightbox.box_name+'" name="editval" class="textbox'+data.lightbox.id+'" style="width:150px;">';
				newlightdiv += '<button type="button" onclick="lightbox_update_name('+data.lightbox.id+');">Save</button>';
				newlightdiv += '</div>';
				newlightdiv += '</div>';
				newlightdiv += '<div class="single_lightbox_controls">';
				newlightdiv += '<a href="'+pdflink+'" class="textButton arrowButton default"><i class="fa fa-download"></i>  Download PDF</a>';
				newlightdiv += '</div>';
				newlightdiv += '<div class="single_lightbox_controls">';
				newlightdiv += '<a href="#" class="textButton arrowButton asLightbox lightbox_email cboxElement" data-toggle="modal" data-target="#sendEmail" onclick="getlightbox('+data.lightbox.id+');"><i class="fa fa-envelope"></i> Email</a>';
				newlightdiv += '</div>';
				newlightdiv += '<div class="single_lightbox_controls">';
				newlightdiv += '<a href="#" class="textButton arrowButton default" onclick="deletelightbox('+data.lightbox.id+');"><i class="fa fa-remove"></i>  Delete</a>';
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
					alert('Lightbox not found');
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
			alert('Lightbox not found');
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
			alert('Lightbox not found');
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
						alert('Lightbox not found');
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
			alert('Lightbox not found');
		}			
	}
	
	function add_to_lightbox(fileId)
	{
		if(fileId!="" && fileId > 0)
		{
			var tot_box = $('#tot_lb').val();
			var tot_box_itms = $('#tot_lb_itm').val();
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
				alert('BITTE ERSTELLEN SIE ZUERST EINEN Lightbox BEVOR SIE EIN PRODUKT HINZUFÜGEN');
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
					alert('Lightbox not found');
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
			alert('Please choose a Lightbox first');
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
					alert('Lightbox image not found');
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
			alert('Lightbox not found');
		}			
	}
	
	function getlightbox(lid)
	{
		if(lid>0 && lid!='')
		{
			$('#share_selecteditems').val(lid);
		}
	}
    </script>
	<script>
	$(document).ready(function () {
		$('.quick_view').click(function () {
			$.ajax({
			  url: "{{ URL::to('getproperty')}}"+'/'+$(this).attr('rel'),
			  type: "get",
			  success: function(data){
				  console.log(data);
				var imagesPro = '';
				imagesPro+='<li class="detail-tile" style="visibility:visible;background:#000;">';
				imagesPro+='<div class="detail-tile-inner">';
				imagesPro+='<h3 class="popup-property-title">'+data.data.property_name+'</h3>';
				imagesPro+='<p class="popup-property-desc">'+data.data.about_property+'</p>';
				imagesPro+='</div>';
				imagesPro+='</li>';
				$(data.image).each(function(i,val){
					imagesPro+='<li class="detail-tile" style="visibility:visible">';
					imagesPro+='<div class="detail-tile-inner">';
					imagesPro+='<img src="'+val+'"/>';
					imagesPro+='</div>';
					imagesPro+='</li>';
				}); 
				$('#frontpage-detail-tiles').html(imagesPro); 
			  } 
			});
			$('#frontpage-layer-bj').fadeIn('slow');
			$('#fixed_wrapper').hide();
			$('html').addClass('hidescroll');
			$('body').addClass('layerloaded');
			
			return false;
		});
		$('#frontpage-layer-bj-header-close').click(function () {
			$('#frontpage-layer-bj').fadeOut('slow');
			$('#fixed_wrapper').show();
			$('html').removeClass('hidescroll');
		});
	});
</script>	 
<div id="frontpage-layer-bj">
	<div id="frontpage-layer-bj-header-wrapper">
		<div id="frontpage-layer-bj-header">
			<a href="#" id="frontpage-layer-bj-header-logo">Project7</a>
		</div>
		<span id="frontpage-layer-bj-header-close"></span>
	</div>
    <div id="frontpage-layer-bj-content">
        <div class="frontpage-detail-content-top">
            <div class="frontpage-detail-content-top-link">
                <div class="frontpage-detail-content-top-link">
                    
                </div>
            </div>
        </div>
		<ul class="clearfix" id="frontpage-detail-tiles">
			
		</ul>
    </div>	