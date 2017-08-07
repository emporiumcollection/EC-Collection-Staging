<script>
    $(document).ready(function () {

    $('#quick_pager_header').mouseover(function () {
    $('.flyoutBox').show();
    });
    $('.flyoutBox').mouseover(function () {
    $('.flyoutBox').show();
    });
    $('#quick_pager_header').mouseout(function () {
    $('.flyoutBox').hide();
    });
    $('.flyoutBox').mouseout(function () {
    $('.flyoutBox').hide();
    });
    $(document).on('click', '.detail_view', function(){
    $('#frontpage-layer-bj').fadeOut('slow');
    $('#frontpage-detail-tile').html('');
    $.ajax({
    url: "{{ URL::to('getproperty')}}" + '/' + $(this).attr('rel'),
            type: "get",
            success: function(data){
            var imagesPro = '';
            imagesPro += '<li class="detail-tile ai-pop-detail-form col-sm-6 col-xs-12 col-md-6 col-lg-4" style="visibility:visible;background:#000;">';
            imagesPro += '<div class="detail-tile-inner ai-haeding-bg-style">';
            imagesPro += '<h3 class="popup-property-title">' + data.data.property_name + '</h3>';
            imagesPro += '<p class="popup-property-desc">' + data.data.about_property + '</p>';
            imagesPro += '</div>';
            imagesPro += '<div class="request_prop">';
            imagesPro += '<h3 class="popup-property-title">Request Property</h3>';
            imagesPro += '<div id="formerrors" class="formerrors"></div>';
            imagesPro += '<form url="#"  id="enquiryform" class="form-horizontal" method="post">';
            imagesPro += '<input type="hidden" name="property_id" value="' + data.data.id + '">';
            imagesPro += '<input type="hidden" name="property_name" value="' + data.data.property_name + '">';
            imagesPro += '<div class="col-md-12">';
            imagesPro += '<fieldset>';
            imagesPro += '<div class="row">';
            imagesPro += '<div class="calender-main-bg">';
            imagesPro += '<h2>Check Availability<br><span> & Reserve</span></h2>';
            imagesPro += '<p>Find the best accomodation for your upcoming stay.<a> Why book with us?</a></p>';
            imagesPro += '<div class="calender-input">';
            imagesPro += '<div id="book-hotel1" class="datePicker- dateFrom-" >Check In<span class="calender-icon"><i class="fa fa-calendar" aria-hidden="true"></i></span></div>';
            imagesPro += '</div>';
            imagesPro += '<div class="calender-input">';
            imagesPro += '<div id="book-hotel2" class="datePicker- dateFrom-" >Check Out<span class="calender-icon"><i class="fa fa-calendar" aria-hidden="true"></i></span></div>';
            imagesPro += '</div>';
            imagesPro += '<div class="dropdown">';
            imagesPro += '<div class="members-list"><span id="adults-val">2</span> Adults, <span id="childern-val">0</span> Children<span class="right-down-arrow"><i class="fa fa-angle-down" aria-hidden="true"></i></span></div>';
            imagesPro += '<ul class="members-drop-list">';
            imagesPro += '<li>';
            imagesPro += '<label>Adult</label>';
            imagesPro += '<input id="adult-input-value" class="input-right" type="number" value="2"  min="1" max="5">';
            imagesPro += '</li>';
            imagesPro += '<li>';
            imagesPro += '<label>Children</label>';
            imagesPro += '<input id="childerns-input-value" class="input-right" type="number" value="0"  min="1" max="5">';
            imagesPro += '</li>';
            imagesPro += '</ul>';
            imagesPro += '</div>';
            imagesPro += '<button class="check-hotel-btn">Check Availability</button>';
            imagesPro += '</div>';
            imagesPro += '</div>';
            imagesPro += '<div class="row MarBot10">';
            imagesPro += '<div class="col-md-12">';
            imagesPro += '<div class="row">';
            imagesPro += '<input required="required" name="name" type="text" value="" placeholder="Your First Name & Last Name" required="required">';
            imagesPro += '</div>';
            imagesPro += '</div>';
            imagesPro += '<div class="col-md-1">';
            imagesPro += '<div class="row">';
            imagesPro += '<span class="asterix"> * </span>';
            imagesPro += '</div>';
            imagesPro += '</div>';
            imagesPro += '</div>';
            imagesPro += '<div class="row MarBot10">';
            imagesPro += '<div class="col-md-12">';
            imagesPro += '<div class="row">';
            imagesPro += '<input required="required" name="email" type="email" value="" placeholder="Your email address" required="required">';
            imagesPro += '</div>';
            imagesPro += '</div>';
            imagesPro += '<div class="col-md-1">';
            imagesPro += '<div class="row">';
            imagesPro += '<span class="asterix"> * </span>';
            imagesPro += '</div>';
            imagesPro += '</div>';
            imagesPro += '</div>';
            imagesPro += '<div class="row MarBot10">';
            imagesPro += '<div class="col-md-12">';
            imagesPro += '<div class="row">';
            imagesPro += '<input required="required" name="phone" type="text" value="" placeholder="Your phone number" required="required">';
            imagesPro += '</div>';
            imagesPro += '</div>';
            imagesPro += '<div class="col-md-1">';
            imagesPro += '<div class="row">';
            imagesPro += '<span class="asterix"> * </span>';
            imagesPro += '</div>';
            imagesPro += '</div>';
            imagesPro += '</div>';
            imagesPro += '<div class="row MarBot10">';
            imagesPro += '<div class="col-md-12">';
            imagesPro += '<div class="row">';
            imagesPro += '<textarea class="ai-textarea-width" name="notes" rows="5" cols="20" placeholder="Special Requests"></textarea>';
            imagesPro += '</div>';
            imagesPro += '</div>';
            imagesPro += '</div>';
            imagesPro += '<div class="row MarBot10">';
            imagesPro += '<div class="col-sm-12">';
            imagesPro += '<div class="row">';
            imagesPro += '<button type="button" class="btn btn-default ai-yacht-form-submit-btn" onclick="submit_property_request();">Send</button>';
            imagesPro += '</div>';
            imagesPro += '</div>';
            imagesPro += ' </div>';
            imagesPro += '</fieldset>';
            imagesPro += '</div>';
            imagesPro += '</form>';
            imagesPro += '</div>';
            imagesPro += '</li>';
            $(data.image).each(function(i, val){
            //console.log(val);
            imagesPro += '<li class="detail-tile col-sm-6 col-xs-12 col-md-6 col-lg-4" style="visibility:visible">';
            imagesPro += '<div class="detail-tile-inner">';
            imagesPro += '<img src="' + val.imgsrc + val.file_name + '"/>';
            /*imagesPro+='<a href="#" id="LearnMoreBtn1" onclick="add_to_lightbox('+val.id+','+data.data.id+');">Add to lightbox</a>';*/
            imagesPro += '</div>';
            imagesPro += '</li>';
            });
            $('#frontpage-detail-tiles-detail').html(imagesPro);
            
                eval($('.dropdown').each(function () {
                    var $dropdown = $(this);
                    $(".members-list", $dropdown).click(function (e) {
                        e.preventDefault();
                        $div = $(".members-drop-list", $dropdown);
                        $div.toggle();
                        $(".members-drop-list").not($div).hide();
                        return false;
                    });
                }));

                eval($("#adult-input-value").change(function () {
                    var adults = $(this).val();
                    $('#adults-val').html(adults);
                }));

                eval($("#childerns-input-value").change(function () {
                    var childerns = $(this).val();
                    $('#childern-val').html(childerns);
                }));
                
                eval($('#book-hotel1').dateRangePicker({
                    startDate: "2017-01-11",
                    separator: ' to ',
                    getValue: function () {
                    if ($('#book-hotel1').val() && $('#book-hotel2').val())
                        return $('#book-hotel1').val() + ' to ' + $('#book-hotel2').val();
                    else
                        return '';
                    },
                    setValue: function (s, s1, s2) {
                        $('#book-hotel1').val(s1);
                        $('#book-hotel2').val(s2);
                    }
                }));
                eval($('#book-hotel2').dateRangePicker({
                    startDate: "2017-01-11",
                    separator: ' to ',
                    getValue: function () {
                    if ($('#book-hotel1').val() && $('#book-hotel2').val())
                        return $('#book-hotel1').val() + ' to ' + $('#book-hotel2').val();
                    else
                        return '';
                    },
                    setValue: function (s, s1, s2) {
                        $('#book-hotel1').val(s1);
                        $('#book-hotel2').val(s2);
                    }
                }));
            
            }
    });
    $('#frontpage-layer-bj-detail').fadeIn('slow');
    $('#fixed_wrapper').hide();
    $('html').addClass('hidescroll');
    $('body').addClass('layerloaded');
    return false;
    });
    $('.frontpage-layer-bj-header-close').click(function () {
    $('.frontpage-layer-bj').fadeOut('slow');
    $('#fixed_wrapper').show();
    $('html').removeClass('hidescroll');
    });
    });</script>
<div id="frontpage-layer-bj-detail" class="frontpage-layer-bj">
    <div id="frontpage-layer-bj-header-wrapper">
        <div id="frontpage-layer-bj-header">
            <a href="#" id="frontpage-layer-bj-header-logo"> <img alt="" src="{{ asset('sximo/assets/images/design-location-logo.png')}}" class="img-responsive yachts-pop-up-logo"></a>
        </div>
        <span id="frontpage-layer-bj-header-close" class="frontpage-layer-bj-header-close"></span>
    </div>
    <div id="frontpage-layer-bj-content">
        <div class="frontpage-detail-content-top">
            <div class="frontpage-detail-content-top-link">
                <div class="frontpage-detail-content-top-link">

                </div>
            </div>
        </div>
        <ul class="clearfix frontpage-detail-tiles" id="frontpage-detail-tiles-detail">

        </ul>

    </div>	
</div>


<div id="fixed_wrapper">
    <!-- Lightbox Modal -->
    <div id="lightbox_basket_wrapper">
        <div id="lightbox_basket_trigger">
            <a href="#" class="link-to-show active" onclick="hide_show_lightbox('show');">Travel Itinerary<span class="arrow_down"></span></a>
            <a href="#" class="link-to-hide" onclick="hide_show_lightbox('hide');">Hide Travel Itinerary<span class="arrow_down"></span></a>
        </div>

        <div id="lightbox_basket">
            <div id="lightbox_basket_content">
                <div id="lightbox_outer_wrapper">
                    <div id="create_lightbox" class="attached row">
                        <div class="lightbox_addon col-sm-12">
                            <button type="button" class="textButton" onclick="createnewbox();">Create new Itinerary +</button>
                        </div>
                    </div>
                    {{--*/ $lb=0; $lb_itm=0; /*--}}
                    @if(!empty($lightboxes))
                    {{--*/ $lb= count($lightboxes); /*--}}
                    @foreach($lightboxes as $lboxes)
                    <div class="single_lightbox_wrapper{{$lboxes->id}} single_lightbox_wrappertemp attached">
                        <input type="hidden" name="editlightboxid" id="editlightboxid" value="{{$lboxes->id}}" />
                        <div class="single_lightbox_inner_wrapper row">
                            <div class="single_lightbox_wrapper_left col-xs-12 col-sm-3 col-md-2 col-lg-2">
                                <div class="single_lightbox_title" data-lightbox-field="title">
                                    <span id="lightbox_title">{{$lboxes->box_name}}</span>
                                    <a href="#" class="lightbox_rename" onclick="show_rename_form({{$lboxes->id}});">Rename</a>
                                    <div class="lightbox_rename_wrapper disnon">
                                        <input type="text" value="{{$lboxes->box_name}}" name="editval" class="textbox{{$lboxes->id}}" style="width:75%;">
                                        <button type="button" onclick="lightbox_update_name({{$lboxes->id}});" style="float:right;">Save</button>
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
                            </div>

                            <div class="single_lightbox_wrapper_right col-xs-12 col-sm-9 col-md-10 col-lg-10">
                                <ul class="row">
                                    @if(!empty($lightcontent[$lboxes->id]))
                                    {{--*/ $lb_itm = count($lightcontent[$lboxes->id]); /*--}}
                                    @foreach($lightcontent[$lboxes->id] as $cont)
                                    <li id="imgfile{{$cont['lightbox']->id}}" class="col-xs-4 col-sm-3 col-md-3 col-lg-2">
                                        <a href="#">
                                            <img src="{{URL::to('uploads/thumbs/').'/thumb_'.$cont['lightbox']->folder_id.'_'.$cont['lightbox']->file_name}}" alt="{{$cont['lightbox']->file_display_name}}">
                                            <p style="position:fixed;">{{ (array_key_exists('property',$cont)) ? $cont['property']->property_name : '' }}</p>
                                        </a>
                                        <button type="button" class="remove_article" onclick="remove_boxcontent({{$cont['lightbox']->id}});">
                                            <img src="{{ asset('sximo/images/remove.gif')}}" alt="Delete">
                                        </button>
                                    </li>
                                    @endforeach
                                    @endif
                                </ul>
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
<div class="modal fade" id="chooselight" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-top:100px; color:#000;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel">Choose Travel Itinerary:</h3>
            </div>
            <div class="modal-body">
                <div class="field">
                    <label>Please select your Travel Itinerary <em>*</em></label>
                    <div class="field-input">
                        <input type="hidden" name="chsfile" id="chsfile" value="" />
                        <input type="hidden" name="chsproname" id="chsproname" value="" />
                        <select name="chslightboxes" id="chslightboxes" class="form-control">
                            @foreach($lightboxes as $opt)
                            <option value="<?php echo $opt->id; ?>"><?php echo $opt->box_name; ?></option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-black" onclick="selectlightbox();">Add</button>
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
                <div id="formerrorslight" class="formerrors" style="padding-left: 0;"></div>
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
                            <input type="radio" value="zip-zip" name="downType" checked="checked" required> Download as Zip archive.&nbsp;<br>
                            <input type="radio" value="pdf-high" name="downType" required> Download as PDF
                            <!--<input type="radio" value="pdf-low" name="downType" required> Download as PDF low res.&nbsp;-->
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
                                <option value="lightbox_template1"> Default Template </option>
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
                <button type="button" class="btn btn-default" onclick="send_lightbox();">Send</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="myModalCreateLightBox" tabindex="-1" role="dialog" aria-labelledby="myModalCreateLightBox" style="text-align:left; color:#000;">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background: #000;color: #fff;opacity: 0.9;border-radius: 0;">
            You have to Sign-in/Sign-up for creating new LightBox<br/>
            <p style="padding:5px 0px;"><button data-toggle="modal" data-target="#myModal" style="padding:5px 10px;  background:#fff; color:#000;">Log-in/Sign-Up</button></p>
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
    if (tagid != '' && tagid > 0)
    {
    if ($('#child' + tagid + ' li').hasClass("hidden")) {
    $(tag).removeClass('hidden');
    $('#child' + tagid + ' li').removeClass('hidden');
    }
    else
    {
    $(tag).addClass('hidden');
    $('#child' + tagid + ' li').addClass('hidden');
    }
    }
    }

    function hide_show_lightbox(act)
    {
    if (act != '')
    {
    if (act == "show")
    {
    $("body").removeClass("showmenu");
    $("#top_nav_wrapper").slideUp();
    $('.link-to-show').removeClass('active');
    $('.link-to-hide').addClass('active');
    $('#lightbox_basket').show();
    $('div#content_wrapper').css('margin', '190px 0 600px');
    }
    else if (act == "hide")
    {
    $("#top_nav_wrapper").slideDown(function(){
    $("body").addClass("showmenu");
    });
    $('.link-to-hide').removeClass('active');
    $('.link-to-show').addClass('active');
    $('#lightbox_basket').hide();
    $('div#content_wrapper').css('margin', '190px 0 170px');
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
    if (loggedIn == ''){
    $('#myModal1').modal('show');
    } else{
    $.ajax({
    url: "{{ URL::to('create_lightbox')}}",
            type: "post",
            dataType: "json",
            success: function(data){
            if (data.status == 'error')
            {
            alert(data.errors);
            }
            else if (data.status == 'success')
            {
            var pdflink = "{{URL::to('lightbox_content_downloadpdf/" + data.lightbox.id + "')}}";
            var newlightdiv = '';
            newlightdiv += '<div class="single_lightbox_wrapper' + data.lightbox.id + ' single_lightbox_wrappertemp attached">';
            newlightdiv += '<input type="hidden" name="editlightboxid" id="editlightboxid" value="' + data.lightbox.id + '" />';
            newlightdiv += '<div class="single_lightbox_inner_wrapper row">';
            newlightdiv += '<div class="single_lightbox_wrapper_left col-xs-12 col-sm-3 col-md-2 col-lg-2">';
            newlightdiv += '<div class="single_lightbox_title" data-lightbox-field="title">';
            newlightdiv += '<span id="lightbox_title">' + data.lightbox.box_name + '</span>';
            newlightdiv += '<a href="#" class="lightbox_rename" onclick="show_rename_form(' + data.lightbox.id + ');">Rename</a>';
            newlightdiv += '<div class="lightbox_rename_wrapper disnon">';
            newlightdiv += '<input type="text" value="' + data.lightbox.box_name + '" name="editval" class="textbox' + data.lightbox.id + '" style="width:75%;">';
            newlightdiv += '<button type="button" onclick="lightbox_update_name(' + data.lightbox.id + ');" style="float:right;">Save</button>';
            newlightdiv += '</div>';
            newlightdiv += '</div>';
            newlightdiv += '<div class="single_lightbox_controls">';
            newlightdiv += '<a href="' + pdflink + '" class="textButton arrowButton default"><i class="fa fa-download"></i>  Download PDF</a>';
            newlightdiv += '</div>';
            newlightdiv += '<div class="single_lightbox_controls">';
            newlightdiv += '<a href="#" class="textButton arrowButton asLightbox lightbox_email cboxElement" data-toggle="modal" data-target="#sendEmail" onclick="getlightbox(' + data.lightbox.id + ');"><i class="fa fa-envelope"></i> Email</a>';
            newlightdiv += '</div>';
            newlightdiv += '<div class="single_lightbox_controls">';
            newlightdiv += '<a href="#" class="textButton arrowButton default" onclick="deletelightbox(' + data.lightbox.id + ');"><i class="fa fa-remove"></i>  Delete</a>';
            newlightdiv += '</div>';
            newlightdiv += '</div>';
            newlightdiv += '<div class="single_lightbox_wrapper_right col-xs-12 col-sm-9 col-md-10 col-lg-10">';
            newlightdiv += '<ul class="row"></ul>';
            newlightdiv += '</div>';
            newlightdiv += '</div>';
            newlightdiv += '</div>';
            $('#lightbox_outer_wrapper').append(newlightdiv);
            $('#chooselight #chslightboxes').append('<option value="' + data.lightbox.id + '">' + data.lightbox.box_name + '</option>');
            var get_tot_lb = parseInt($('#tot_lb').val());
            $('#tot_lb').val(get_tot_lb + 1);
            }
            }
    });
    }
    }

    function deletelightbox(lightId)
    {
    if (lightId != "" && lightId > 0)
    {
    $.ajax({
    url: "{{ URL::to('delete_lightbox')}}",
            type: "post",
            data: "lightboxId=" + lightId,
            success: function(data){
            if (data == 'error')
            {
            alert('Lightbox not found');
            }
            else if (data == 'success')
            {
            $('.single_lightbox_wrapper' + lightId).remove();
            var get_tot_lb = parseInt($('#tot_lb').val());
            $('#tot_lb').val(get_tot_lb - 1);
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
    if (boxid != "" && boxid > 0)
    {
    $('.single_lightbox_wrapper' + boxid + ' #lightbox_title').hide();
    $('.single_lightbox_wrapper' + boxid + ' .lightbox_rename').hide();
    $('.single_lightbox_wrapper' + boxid + ' .lightbox_rename_wrapper').show();
    //$('.single_lightbox_wrapper'+boxid+' .lightbox_rename').show();
    }
    else{
    alert('Lightbox not found');
    }
    }

    function lightbox_update_name(lightId)
    {
    if (lightId != "" && lightId > 0)
    {
    var lightname = $.trim($('.textbox' + lightId).val());
    if (lightname != '')
    {
    $.ajax({
    url: "{{ URL::to('lightboxupdatename')}}",
            type: "post",
            data: "lightboxId=" + lightId + "&newname=" + lightname,
            success: function(data){
            if (data == 'error')
            {
            alert('Lightbox not found');
            }
            else if (data == 'success')
            {
            $('.textbox' + lightId).val(lightname);
            $('.single_lightbox_wrapper' + lightId + ' #lightbox_title').html(lightname);
            $('.single_lightbox_wrapper' + lightId + ' #lightbox_title').show();
            $('.single_lightbox_wrapper' + lightId + ' .lightbox_rename').show();
            $('.single_lightbox_wrapper' + lightId + ' .lightbox_rename_wrapper').hide();
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

    function add_to_lightbox(fileId, propname)
    {
    var loggedIn = '{{isset(\Auth::user()->id)?\Auth::user()->id:''}}';
    if (loggedIn == ''){
    $('#myModal1').modal('show');
    } else{
    if (fileId != "" && fileId > 0)
    {
    var tot_box = $('#tot_lb').val();
    var tot_box_itms = $('#tot_lb_itm').val();
    if (tot_box > 0)
    {
    var lid = '';
    if (tot_box > 1)
    {
    $('#chooselight #chsfile').val(fileId);
    $('#chooselight #chsproname').val(propname);
    $('#chooselight').modal('show');
    }
    else
    {
    lid = $('#editlightboxid').val();
    add_lightbox_content(fileId, propname, lid);
    }
    }
    else
    {
    $('.link-to-show').removeClass('active');
    $('.link-to-hide').addClass('active');
    $('#lightbox_basket').show();
    }
    }
    }
    }

    function selectlightbox()
    {
    var chos_box = $('#chslightboxes').val();
    var chos_file = $('#chsfile').val();
    var chos_prop = $('#chsproname').val();
    add_lightbox_content(chos_file, chos_prop, chos_box);
    }

    function add_lightbox_content(chos_file_id, propname, chos_box_id)
    {
    if (chos_file_id > 0 && chos_box_id > 0)
    {
    $.ajax({
    url: "{{ URL::to('lightbox_addcontent')}}",
            type: "post",
            data: "lightboxId=" + chos_box_id + "&fileId=" + chos_file_id + "&propId=" + propname,
            dataType: "json",
            success: function(data){
            if (data.status == 'error')
            {
            alert('Lightbox not found');
            }
            else if (data.status == 'already')
            {
            $('#chooselight').modal('hide');
            $('.link-to-show').removeClass('active');
            $('.link-to-hide').addClass('active');
            $('#lightbox_basket').show();
            }
            else if (data.status == 'success')
            {
            var newcont = '';
            var img = "{!!URL::to('uploads/thumbs/thumb_" + data.lightboxcontent.folder_id + "_" + data.lightboxcontent.file_name + "')!!}";
            var remimg = "{{ asset('sximo/images/remove.gif')}}";
            newcont += '<li id="imgfile' + data.lightboxcontent.id + '" class="col-xs-4 col-sm-3 col-md-3 col-lg-2">';
            newcont += '<a href="#">';
            newcont += '<img src="' + img + '" alt="' + data.lightboxcontent.file_display_name + '">';
            newcont += '<p>' + data.propert.property_name + '</p>';
            newcont += '</a>';
            newcont += '<button type="button" class="remove_article">';
            newcont += '<img src="' + remimg + '" alt="Delete" onclick="remove_boxcontent(' + data.lightboxcontent.id + ');">';
            newcont += '</button>';
            newcont += '</li>';
            $('.single_lightbox_wrapper' + chos_box_id + ' .single_lightbox_wrapper_right ul').append(newcont);
            $('#chooselight').modal('hide');
            $('.link-to-show').removeClass('active');
            $('.link-to-hide').addClass('active');
            $('#lightbox_basket').show();
            $('.container.foo-copy-right').css('margin-bottom', '480px');
            var get_tot_lb_itm = parseInt($('#tot_lb_itm').val());
            $('#tot_lb_itm').val(get_tot_lb_itm + 1);
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
    if (contentId != "" && contentId > 0)
    {
    $.ajax({
    url: "{{ URL::to('delete_lightbox_content')}}",
            type: "post",
            data: "contentId=" + contentId,
            success: function(data){
            if (data == 'error')
            {
            alert('Lightbox image not found');
            }
            else if (data == 'success')
            {
            $('#imgfile' + contentId).remove();
            var get_tot_lb_itm = parseInt($('#tot_lb_itm').val());
            $('#tot_lb_itm').val(get_tot_lb_itm - 1);
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
    if (lid > 0 && lid != '')
    {
    $('#share_selecteditems').val(lid);
    }
    }

    function send_lightbox()
    {
    $.ajax({
    url: "{{ URL::to('sendemail_lightbox')}}",
            type: "post",
            data: $('#send_email_lightbox').serialize(),
            dataType: "json",
            success: function(data){
            var html = '';
            if (data.status == 'error')
            {
            html += '<ul class="parsley-error-list">';
            html += '<li>' + data.errors + '</li>';
            html += '</ul>';
            $('#formerrorslight').html(html);
            }
            else{
            var htmli = '';
            htmli += '<div class="alert alert-success fade in block-inner">';
            htmli += '<button data-dismiss="alert" class="close" type="button">�</button>';
            htmli += '<i class="icon-checkmark-circle"></i> Lightbox Sent Successfully </div>';
            $('#formerrorslight').html(htmli);
            $('#send_email_lightbox')[0].reset();
            setTimeout(function(){ $('#formerrorslight').fadeOut('slow'); $('#formerrorslight').html(''); }, 5000);
            }
            }
    });
    }
</script>