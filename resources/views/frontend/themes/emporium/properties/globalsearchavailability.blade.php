@extends('frontend.themes.emporium.layouts.home')
{{--  For Title --}}
@section('title', 'PDP Page')
{{-- For Meta Keywords --}}
@section('meta_keywords', '')
{{-- For Meta Description --}}
@section('meta_description', '')
{{-- For Page's Content Part --}}
@section('content')
<section id="globalSearchResult" class="globalSearchResultSection">
    {{-- */  $i=1; $j=1;  /* --}}
    <!--<div class="col-sm-12">
        <div class="heading">
            Search Results <br />                        
            <span class="sub-heading">The following suites are available for the selected criteria.</span>
        </div>
    </div>-->
    <ul class="nav nav-tabs main-nav-tab">
        @if(!empty($allData))
            @foreach($allData as $data) 
                @if(count($data['ddSelected'])>0)                               
                <li class="main-tab main-{{$data['name']}} {{ $i==1 ? 'active' : ''}}"><a href="#tab-{{$data['name']}}" data-toggle="tab">{{$data['name']}}</a></li>
                {{--*/ $i++ /*--}}
                @endif
            @endforeach
            <li id="channel_url" class="social-tab" style="display: none;"><a href="#tab-channel" data-toggle="tab">Channel</a></li>
            <li id="social_url" class="social-tab" style="display: none;"><a href="#tab-social" data-toggle="tab">Social</a></li>
        @endif
    </ul>
    <div class="tab-content">
        @if(!empty($allData))
            @foreach($allData as $data)   
                @if(count($data['ddSelected'])>0)              
                    <div id="tab-{{$data['name']}}" class="tab-pane main-tab-pane {{ $j==1 ? 'active' : ''}}">
                        <?php //echo("<pre>"); print_r($data['data']); die;  ?>                        
                        @if(!empty($data['ddSelected']))
                            <ul class="nav nav-tabs">
                            {{-- */  $i=1; /* --}}
                            @foreach($data['ddSelected'] as $seldd)
                                {{-- */ $rseldd = str_replace(' ', '-', $seldd); /* --}} 
                                <li class="right-{{$rseldd}} {{$data['name']}} {{ $i==1 ? 'active' : ''}}" data-name="{{$seldd}}">
                                    <a href="#tab-{{$rseldd}}" data-toggle="tab">{{$seldd}}</a>
                                </li>
                                
                                {{-- */  $i++; /* --}}
                            @endforeach
                            </ul>
                            <div class="tab-content">
                                {{-- */  $i=1; /* --}}
                                @foreach($data['ddSelected'] as $seldd) 
                                    {{-- */ $rseldd = str_replace(' ', '-', $seldd); /* --}} 
                                    @if($data['name']=='Hotel')
                                        @if($i==1) 
                                            <input type="hidden" name="activeHotel" value="{{$seldd}}" />
                                        @endif
                                    @endif                              
                                    <div id="tab-{{$rseldd}}" class="tab-pane {{ $i==1 ? 'active' : ''}}">
                                        
                                        @if($data['name']=='Destination')
                                            @if($i==1) 
                                                <input type="hidden" name="activeDestination" value="{{$seldd}}" />
                                            @endif
                                            
                                            <div class="search-breadcrum">
                                                <ul class="s-breadcrumb destination-breadcrumb">                                                
                                                </ul>
                                            </div>
                                            <select name="dd-destination" id="dd-destination">                                                
                                            </select>
                                            <h5 class="margin-top-20">Choose your Membership Type to make a reservation</h5>  
                                            
                                            @if(!empty($collections))
                                                {{--*/ $i=1; $j=1; $k=1; $l=1; $arr_key=''; /*--}}
                                                <ul class="nav nav-tabs collection-tabs">
                                                    @foreach($collections as $coll)  
                                                        <?php $exp_cat_name = explode(' ', $coll->category_name) ?>                      
                                                        <li class="<?php echo ($m_type==$coll->category_alias) ? 'active' : '' ?> dest-collection" data-name="{{$coll->category_alias}}"><a href="{{URL::to('/')}}" >{{$exp_cat_name[0]}}</a></li>
                                                        {{--*/ $k++;  /*--}}    
                                                    @endforeach                            
                                                </ul>
                                                <div class="load_ajax">
                                                
                                                </div>                  
                                            @endif
                                        @endif        
                                    </div>
                                    {{-- */  $i++; /* --}}
                                @endforeach        
                            </div>
                        @endif   
                    </div>
                    {{--*/ $j++ /*--}}
                @endif
            @endforeach
        @endif
         
        <input type="hidden" name="m_type" value="{{$m_type}}" />
        <input type="hidden" name="cat" value="" /> 
        <input type="hidden" name="active_tab" value="{{$active_tab}}" />
        
        <input type="hidden" name="arrive" value="{{$arrive}}" />
        <input type="hidden" name="departure" value="{{$departure}}" />
        
        <input type="hidden" name="booking_rooms" value="{{$booking_rooms}}" />
        <input type="hidden" name="booking_adults" value="{{$booking_adults}}" />  
        <input type="hidden" name="booking_children" value="{{$booking_children}}" />      
        <input type="hidden" name="travellerType" value="{{$travellerType}}" />        
        <input type="hidden" name="childrenAge" value="" />
        
        <input type="hidden" name="tr_2_rooms" value="{{$tr_2_rooms}}" />
        <input type="hidden" name="tr_2_adults" value="{{$tr_2_adults}}" />
        <input type="hidden" name="tr_2_child" value="{{$tr_2_child}}" />
        <input type="hidden" name="tr_3_rooms" value="{{$tr_3_rooms}}" />        
        <input type="hidden" name="tr_3_adults" value="{{$tr_3_adults}}" />
        <input type="hidden" name="tr_3_child" value="{{$tr_3_child}}" />
        <input type="hidden" name="tr_4_rooms" value="{{$tr_4_rooms}}" />
        <input type="hidden" name="tr_4_adults" value="{{$tr_4_adults}}" />
        <input type="hidden" name="roomType" value="{{$roomType}}" />            
         
    </div>        
</section>

	<!-- gallery Img Popup -->
	<div class="galleryImgPopup fullWidthPopup">
	  <a href="javascript:void(0);" class="loginPopupCloseButton">×</a>
	  <div class="searchDateInnerContent text-center">
		<div class="container-fluid">
		  <div class="row">
			  <div class="col-xs-12 text-center">
				  <div class="gallyPopupHeader">
					  <a href="{{URL::to('')}}"><img src="{{ asset('themes/emporium/images/emporium-voyage-logo.png') }}" alt="Emporium Voyage" class="img-responsive mCS_img_loaded"></a>
				  </div>
			  </div>
			  <div class="col-md-2 col-sm-3">
				  <div class="galleryPopupLeftSide">
					  <h1><a href="javascript:void(0);">New Hotel</a></h1>
					  <div class="popupHotelDetail text-center">
						  <h3>Hotel Zoo Berlin</h3>
						  <p>New York City</p>
						  <p>United States</p>
						  <a class="btn" href="javascript:void(0);">View Hotel</a>
					  </div>
					  <a class="bootomViewNextBtn" href="javascript:void(0);">View All Hotel DOI</a>
				  </div>
			  </div>
			  <div class="col-md-10 col-sm-9 galleryImgdata">
				  
			  </div>
		  </div>
		</div>
	  </div>
	</div>

	<!-- Show More Popup -->
	<div class="showMorePopup fullWidthPopup">
	  <a href="javascript:void(0);" class="loginPopupCloseButton">×</a>
		<div class="container-fluid">
		  <div class="row">
			  <div class="col-sm-4 col-md-6">
				  
			  </div>
			  <div class="col-md-6 col-sm-8 col-xs-12 noPadding">
				<div class="showMoreContent">
				  
				</div>
			  </div>
		  </div>
		</div>
	</div>
    <!-- Show Login Popup -->
	<div class="showLoginPopup fullWidthPopup">
	  <a href="javascript:void(0);" class="loginPopupCloseButton">×</a>
		<div class="container-fluid">
		  <div class="row">
			  <div class="col-sm-4 col-md-6">
				  
			  </div>
			  <div class="col-md-6 col-sm-8 col-xs-12 noPadding">
				<div class="showLoginContent">
				    Please Login to book  
				</div>
			  </div>
		  </div>
		</div>
	</div>
    <!-- Property Season Rates Modal -->
    <div class="modal fade" id="psrModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog" role="document">
    	<div class="modal-content">
    	  <div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    		<h4 class="modal-title" id="myModalLabel">Property Rates</h4>
    	  </div>
    	  <div class="modal-body" id="ratecomm">
    		
    	  </div>
    	  <div class="modal-footer">
    		<button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close">OK</button>
    	  </div>
    	  </form>
    	</div>
      </div>
    </div>
	
@endsection


{{--For Right Side Icons --}}
@section('right_side_iconbar')
    @include('frontend.themes.emporium.layouts.sections.pdp_right_iconbar')
@endsection

{{-- For Include Top Bar --}}
@section('top_search_bar')
    @include('frontend.themes.emporium.layouts.sections.global_search_top_bar')
@endsection

{{-- For Include Side Bar --}}
@section('sidebar')
    @include('frontend.themes.emporium.layouts.sections.globalsearch_sidebar')
@endsection

{{-- For Include style files --}}
@section('head')
    @parent
    
@endsection

{{-- For custom style  --}}
@section('custom_css')
    @parent
    <link href="{{ asset('themes/emporium/css/pdpage-css.css') }}" rel="stylesheet">
    <style>
    .HamYardHotelSection{
        height: auto;
    }
    .center-calendarbox .fa.fa-calendar{
        float: left;
    }
    .center-calendarbox span{ color: #fff !important; display: inline !important; }
    /*.t-day{ color: #000 !important; }*/
    
    .t-date-divide{
        float: left;
        width: 50%;
    }
    .center-calendarbox .t-check-in, .center-calendarbox .t-check-out{
        width: 98% !important;
        margin-top: 16px;
        margin-bottom: 40px;
    }
    .hotelBorderList .t-dates{
        background-color: transparent !important;
    }
    .hotelBorderList .t-datepicker-day{
        /*color: #000 !important;*/
    }
    .hotelBorderList .t-arrow-top{
        top: 65px;
    }
    </style>
@endsection

{{-- For Include javascript files --}}
@section('javascript')
    @parent
	<!-- instagram -->
    <script src="{{ asset('lib/yottie/jquery.yottie.bundled.js')}}"></script>
	<script src="{{ asset('sximo/instajs/instashow/elfsight-instagram-feed.js')}}"></script>
    
    <script src="{{ asset('themes/emporium/js/masonry.pkgd.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('themes/emporium/js/imagesloaded.pkgd.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('themes/emporium/js/slick.js')}}"></script>
    <script type="text/javascript" src="{{ asset('themes/emporium/js/rad-photos-swap.js')}}"></script>
    
@endsection

{{-- For custom script --}}
@section('custom_js')
    @parent
	<script>
     
        // init Masonry
        var $grid = $('.grid').masonry({
          // options...
        });
        // layout Masonry after each image loads
        $grid.imagesLoaded().progress( function() {
          $grid.masonry('layout');
        });
        
        var noImg = "{{ URL::to('sximo/images/noimg.jpg') }}";
        var logined = true;
        <?php
            if(isset(\Auth::user()->id)){
        ?>
                logined = false;    
        <?php
            }
        ?>
        
        function changeBreadcrumbDropdown(catt){
            $.ajax({
                url:'{{URL::to("getDropdownBreadcrumb/")}}',
                //dataType:'html',
                dataType:'json',
                data: {cat:catt},
                type: 'post',
                beforeSend: function(){
                    
                },
                success: function(data){ 
                    
                    var objdestinations = data.destinations; 
                    $("#dd-destination").empty();
                    $("#dd-destination").append('<option value="'+data.catalias+'">You are in '+data.catname+'</option>');
                    $.each(objdestinations, function(key, vlaue){
                        $("#dd-destination").append(
                            $('<option></option>').val(vlaue['category_alias']).html(vlaue['category_name'])
                        );
                    });
                    var objParentCat = data.parent_cat;
                    if(typeof objParentCat != undefined && objParentCat!=null){
                        $("#dd-destination").append('<option data-id="'+data.parent_cat['id']+'" value="-1">&lt; Back to '+data.parent_cat['category_name']+'</option>');
                    }else{
                        $("#dd-destination").append('<option value="-1">&lt; Back to Destination</option>');    
                    }  
                    
                    var breadcrumb = data.dest_url;
                    //console.log(breadcrumb);
                    var destUrl = '';
                    $(".destination-breadcrumb").empty();
                    $(".destination-breadcrumb").append('<li><a href="'+BaseURL+'">{{CNF_APPNAME}}</a></li>');
                    var destpath = 'luxury_destinations';
                    $.each(breadcrumb, function(key, vlaue){
                        if(destUrl==''){
                            destUrl = destUrl + vlaue['category_alias'];     
                        }else{
                            destUrl = destUrl +'/'+ vlaue['category_alias']; 
                        }
                        $("#dest_url").val(destUrl);
                        destpath = destpath+"/"+vlaue['category_alias'];
                        $(".destination-breadcrumb").append('<li><a href="'+BaseURL+'/'+destpath+'">'+vlaue['category_name']+'</a></li>');
                    });
                                  
                }
            });            
        }
        
        $(document).ready(function(){
           var active_tab = $("input[name='active_tab']").val();
           
           var arrive = $("input[name='arrive']").val();
           var departure = $("input[name='departure']").val();
           var booking_rooms = $("input[name='booking_rooms']").val();
           var booking_adults = $("input[name='booking_adults']").val();
           var booking_children = $("input[name='booking_children']").val();
           var roomType = $("input[name='roomType']").val();
           var travellerType = $("input[name='travellerType']").val();
           var tr_2_rooms = $("input[name='tr_2_rooms']").val();
           var tr_2_adults = $("input[name='tr_2_adults']").val();
           var tr_2_child = $("input[name='tr_2_child']").val();
           var tr_3_rooms = $("input[name='tr_3_rooms']").val();
           var tr_3_adults = $("input[name='tr_3_adults']").val();
           var tr_3_child = $("input[name='tr_3_child']").val();
           var tr_4_rooms = $("input[name='tr_3_adults']").val();
           var tr_4_adults = $("input[name='tr_4_adults']").val();
           
           //console.log(active_tab);
           var active_cat = '';
           if(active_tab=="hotel"){
                active_cat = $("input[name='activeHotel']").val(); 
                getPDPPage(active_cat); 
           }else if(active_tab=="destination"){
                active_cat = $("input[name='activeDestination']").val();
                getDestinationPage(active_cat);  
                
           }else{                
                getDestinationPage(active_cat); 
           }
           
           $('[href="#tab-Hotel"]').click(function(e){
                if($(".side-Hotel").hasClass('collapsed')){
                    $(".side-Hotel").trigger('click');
                }
                var active_cat = $("input[name='activeHotel']").val();                
                var sidetrigger = active_cat.replace(/ /gi, '-');                
                $(".side"+sidetrigger).trigger('click');      
           });
           
           $('[href="#tab-Destination"]').click(function(e){
                if($(".side-Destination").hasClass('collapsed')){
                    $(".side-Destination").trigger('click');
                }
                var active_cat = $("input[name='activeDestination']").val();
                var sidetrigger = active_cat.replace(/ /gi, '-');
                getDestinationPage(active_cat);        
           });
           
           
           $(".sd-Hotel").click(function(e){
                var nm = $(this).attr('data-name');  
                $("input[name='activeHotel']").val(nm);
                var rsidetrigger = nm.replace(/ /gi, '-');
                //console.log('[href="#tab-'+rsidetrigger+'"]');
                //$('a[href="#tab-'+rsidetrigger+'"]').triggerHandler('click');
                //$('.right-'+rsidetrigger).triggerHandler('click');
                
                $(".main-tab").removeClass('active');
                $(".main-Hotel").addClass('active');
                $('#tab-Hotel').addClass('active');
                
                $(".Hotel").removeClass('active');
                $('.right-'+rsidetrigger).addClass('active');  
                $("#tab-Hotel .tab-pane").removeClass('active');
                $('#tab-'+rsidetrigger).addClass('active');          
                getPDPPage(nm);     
           });
           $(".sd-Destination").click(function(e){
                var nm = $(this).attr('data-name');  
                $("input[name='activeDestination']").val(nm);
                var rsidetrigger = nm.replace(/ /gi, '-');
                //console.log('[href="#tab-'+rsidetrigger+'"]');
                //$('a[href="#tab-'+rsidetrigger+'"]').triggerHandler('click');
                //$('.right-'+rsidetrigger).triggerHandler('click');
                
                $(".main-tab").removeClass('active');
                $(".main-Destination").addClass('active');
                $(".main-tab-pane").removeClass('active');
                $('#tab-Destination').addClass('active');
                
                $(".Destination").removeClass('active');
                $('.right-'+rsidetrigger).addClass('active');  
                $("#tab-Destination .tab-pane").removeClass('active');
                $('#tab-'+rsidetrigger).addClass('active');          
                getDestinationPage(nm);     
           }); 
        });
        
        function getDestinationPage(item){            
            var mtype = $("input[name='m_type']").val();                    
            var _cat = item;                      
            getPropertyByCollection(mtype, _cat, 1, '');  
            
            changeBreadcrumbDropdown(_cat);  
            
            $('#gs_sb_navhead').addClass('navheadimage');
            $('#gs_sb_criteria').addClass('sdestination');                      
        }
        function getPropertyByCollection(coll_type, cat, page, req_for){ 
            $.ajax({
                url:'{{URL::to("propertysearchlistbycollection/")}}',
                //dataType:'html',
                dataType:'json',
                data: {coll_type:coll_type, cat:cat, page:page, req_for:req_for},
                type: 'post',
                beforeSend: function(){
                    $(".load_ajax").html('<div style="margin:0px auto; width:100%;"><img src="'+BaseURL+'/images/ajax-loader.gif" width="50%" /></div>');
                },
                success: function(data){  console.log(data);
                    $(".collection-tabs").css('display', ''); 
                    $("#channel_url").css('display', 'none');
                    $("#social_url").css('display', 'none');
                    var channel_url = data.data.channel_url;
                    if(channel_url!=null){
                        $("#channel_url").css('display', '');
                        $("#channel_url").attr('data-url', channel_url);       
                    }
                    var social_url = data.data.social_url;
                    if(social_url!=null){
                        $("#social_url").css('display', '');
                        $("#social_url").attr('data-url', social_url);    
                    }                   
                    
                    var datObj = {};
    				datObj.catID = data.data.dest_id;
    				var params = $.extend({}, doAjax_params_default);
    				params['url'] = BaseURL + '/destination/destinatinos-ajax';
    				params['data'] = datObj;
    				params['successCallbackFunction'] = renderSearchDestination;
    				doAjax(params); 
                    
                    listpagestructure(data);                    
                }
            });
        }
        $(document).on('click', "#channel_url", function(){
            $(".collection-tabs").css('display', 'none');             
            var channel_url = $(this).attr('data-url');            
            $(".load_ajax").html('<div class="yt-rvideos"></div>');                         
            $('.yt-rvideos').yottie({                                
                channel: channel_url,
                content: {
                    columns: 4,
                    rows: 2
                },
            }); 
        });
        $(document).on('click', "#social_url", function(){
            $(".collection-tabs").css('display', 'none');              
            var social_url = $(this).attr('data-url');            
            $(".load_ajax").html('<div class="insta_pic"></div>');                       
            $('.insta_pic').eappsInstagramFeed({
                api: '{{ url("runInsta")}}',
                source: social_url,                        
                columns: 5,
                rows: 2                        
            });
        });
        function listpagestructure(data){                    
            
            var _html = '';
            var jsonobj = data.data;
            if($.isEmptyObject(jsonobj)){
                    
            }else{ 
                
                
                var cat_image = jsonobj.category_image;
                var gs_side_image_path = BaseURL+'/uploads/category_imgs/'+cat_image;
                if(cat_image==''){
                    gs_side_image_path = BaseURL+'/themes/emporium/images/mountain-image.jpg';   
                }
                $(".gs-sidebar-criteria-image").html('');
                $(".gs-sidebar-criteria-image").html('<img src="'+gs_side_image_path+'" alt="" class="mCS_img_loaded desaturate">');
                
                var cat_insta_tag = jsonobj.category_instagram_tag;
                var cat_nm = jsonobj.category_name;
                $(".destinationTitle").html('');
                $(".destinationTitle").html(cat_nm+"<br><span class='hashTag'>"+cat_insta_tag+"</span>");
                
                
                var editorPropertiesArr = jsonobj.editorPropertiesArr;
                                                
                if (typeof editorPropertiesArr !== undefined && editorPropertiesArr.length > 0){
                     _html += '<div class="col-md-12 col-sm-12 col-xs-12">';
                        _html += '<div class="row">'
                            _html += '<h4 class="gridheading">'+ editorPropertiesArr.length +' <span class="newfont"> Editor\'s choice</span> Hotels Found for '+jsonobj.slug+' '+ jsonobj.dateslug +'</h4>';
                            _html += '<div class="slider multiple-items">'; 
                            $.each(editorPropertiesArr, function(key, value){
                                var property_slug = value['property_slug'];
                                var _url = BaseURL +"/"+ property_slug.replace(/-+$/g,"");
                                <?php                    				
                    				if(Request::has("departure") || Request::has("arrive"))
                    				{
             				    ?>
                    					//_url+='?arrive='+{{Request::input("arrive")}}+'&departure='+{{Request::input("departure")}};
                                <?php
                    				}
                    			?>
                                _html += '<div>';
                                    _html += '<div class="col-md-6 col-sm-6 col-xs-12">';
                                        _html += '<a  href="'+_url+'" >';
                                            _html += '<img src="{{ URL::to('sximo/images/transparent.png') }}" data-src="{{ URL::to('propertysliderimagebyid/')}}'+value['id']+'" class="img-responsive rad-img" alt="'+value['property_name']+'" title="'+value['property_name']+'" data-ajax-link="{{ URL::to('ajax-rproperty-images')}}'+value['id']+'/3" />';
                                        _html += '</a>';
                                    _html += '</div>';
                                    _html += '<div class="col-md-6 col-sm-6 col-xs-12 slidertext">';
                                        _html += '<h6 class="cat-links">';                                      
                                        _html += '</h6>';
                                
                                        _html += '<h5 class="entry-title">';
                                            _html += '<a href="'+_url+'" rel="bookmark" tabindex="0" style="outline: none;">'+value['property_name']+'</a>';
                                        _html += '</h5>';
                                        _html += '<p><a  href="'+_url+'" >'+value['property_usp']+'</a></p>';
                                        _html += '<a class="remoreslider" href="'+_url+'"><span class="newfont"> Discover</span></a>';
                                    _html += '</div>';
                                _html += '</div>';
                                
                            });
                            _html += '</div>'; 
                        _html += '</div>';       
                    _html += '</div>';  
                }
                _html += '<div class="col-md-12 col-sm-12 col-xs-12 misonrysection">'
                     _html += '<div class="row">';
                        var featurePropertiesArr = jsonobj.featurePropertiesArr;
                        var i=1; 
                        if(typeof featurePropertiesArr !== undefined && featurePropertiesArr.length > 0){                            
                            _html += '<h4 class="gridheading"> '+ featurePropertiesArr.length +' <span class="newfont"> Featured </span> Hotels Found for '+ jsonobj.slug +' '+ jsonobj.dateslug +'</h4>';
                            _html += '<div class="grid">';
                                $.each(featurePropertiesArr, function(key, value){ 
                                    var property_slug = value['property_slug'];                                    
                                    
                                    var _url = BaseURL +"/"+ property_slug.replace(/-+$/g,"");
                                    
                                    <?php                    				
                    				if(Request::has("departure") || Request::has("arrive"))
                    				{
                 				    ?>
                   					    //_url+='?arrive='+{{Request::input("arrive")}}+'&departure='+{{Request::input("departure")}};
                                    <?php
                     				}
                        			?>
                                    var femotional_gallery = [];
                                    var emotional_gallery = jsonobj.emotional_gallery;
                                    if(typeof emotional_gallery !== undefined){
                                        if(i==1 && emotional_gallery.length > 0){
                                            for(j=0; j<9; j++){
                                                if(emotional_gallery.length > 0){
                                                    femotional_gallery.push(emotional_gallery.shift());    
                                                }
                                            }
                                        }        
                                    }
                                    i++;
                                    _html += '<div class="col-md-6 col-sm-6 col-xs-12 biggrid">'; 
                                        _html += '<div class="row">';
                                            _html += '<div class="gridinner">';
                                                _html += '<a href="'+_url+'" title="'+value['property_name']+'">';
                                         	      _html += '<img src="{{ URL::to('themes/emporium/images/emporium-voyage-logo-white-loader.svg') }}" data-src="{{ URL::to('propertysliderimagebyid')}}/'+value['id']+'" class="img-responsive rad-img" alt="'+value['property_name']+'" title="'+value['property_name']+'" />';
                                                _html += '</a>';
                                                _html += '<div class="gridtext">';
                                                    _html += '<h5 class="entry-title">';
                                                        _html += '<a href="'+_url+'" rel="bookmark" style="">'+value['property_name']+' -- Featured  </a>';
                                                        //_html += '<a href="'+_url+'"><i class="fa fa-shopping-cart"></i></a>';
                                                    _html += '</h5>';
                                                    _html += '<p>'+  value['property_usp'] +'</p>';
                                                    _html += '<a class="read-more-link" href="'+_url+'"  title="Discover" ><span class="newfont"> Discover</span></a>';
                                                _html += '</div>';
                                            _html += '</div>';
                                        _html += '</div>';
                                    _html += '</div>';
                                    
                                    if(femotional_gallery.length > 0){
                                        var images_arr = [];
                                        $.each(femotional_gallery, function(key, value){                                            
                                            var _img = {src: value['imgsrc']+value['file_name']}; 
                                            images_arr.push(_img);
                                        }); 
                                        
                                        var img_str = '';
                                        _html += '<div class="col-md-6 col-sm-6 col-xs-12 biggrid">';
                                            _html += '<div class="row">';
                                                _html += '<div class="gridinner">';
                                                    _html += '<a href="javascript:false;">';
                                        	           _html += '<img src="{{ URL::to('themes/emporium/images/emporium-voyage-logo-white-loader.svg') }}" data-src="'+images_arr[0]['src']+'" data-imagessrc="'+img_str+'" class="img-responsive rad-img" alt="Emotional Gallery" title="Emotional Gallery" data-rad-auto-run="true" data-rad-effect-type="fade"  />';
                                                    _html += '</a>';
                                                    _html += '<div class="gridtext">';
                                                        _html += '<h5 class="entry-title"></h5>';
                                                        _html += '<p></p>';
                                                    _html += '</div>';
                                                _html += '</div>';
                                            _html += '</div>';
                                        _html += '</div>';
                                    }                                    
                                           
                                });
                            _html += '</div>';
                        }
                     
                
                        _html += '<div class="clearfix"></div>';
                        propertiesArr = jsonobj.propertiesArr;
                        if(typeof propertiesArr!==undefined && propertiesArr.length > 0 ){
                            _html += '<h4 class="gridheading">'+ jsonobj.total_record +'<span class="newfont"> Luxury Hotel(s)</span> Found for '+jsonobj.slug+' '+jsonobj.dateslug +'</h4>';
                        }
            
                        _html += '<div class="grid">';  
                        if(typeof propertiesArr!==undefined && propertiesArr.length > 0 ){  
                            var rw = 1;
                            
                            $.each(propertiesArr, function(key, value){
                                var property_slug = value['property_slug'];
                                var _url = BaseURL +"/"+ property_slug.replace(/-+$/g,"");
                                <?php                    				
                				if(Request::has("departure") || Request::has("arrive"))
                				{
             				    ?>
               					    //_url+='?arrive='+{{Request::input("arrive")}}+'&departure='+{{Request::input("departure")}};
                                <?php
                 				}
                    			?>
                                if(rw%19==0){
                                    var mresultads = jsonobj.resultads;
                                    if(typeof mresultads !== undefined){
                                    var resultads = jsonobj.resultads.resultads;
                                    
                                    if(typeof resultads !== undefined && resultads != null){
                                    
                                        _html += '<div class="col-md-4 col-sm-4 col-xs-12 grid-item">';
                				            _html += '<div class="row">';
                                                _html += '<div class="gridinner">';
                                                    _html += '<a href="#" >'
                                					   _html += '<img src="{{URL::to('uploads/users/advertisement/')}}/'+resultads['adv_img']+'" class="img-responsive" >';
                                                    _html += '</a>';
                                                    
                                                    _html += '<div class="gridtext">';
                                                        _html += '<h5 class="entry-title">';
                                                            var advUrl = resultads['adv_link'];
                                                            if(advUrl.indexOf("http") < 0){
                                                                advUrl = "http://" + advUrl;        
                                                            }
                                                            _html += '<a href="'+advUrl+'" rel="bookmark" style="">'+resultads['adv_title']+'</a>';
                                                            _html += '<a href="#">Advertisement</a>';
                                                        _html += '</h5>';
                                                        _html += '<a class="read-more-link" href="'+advUrl+'">'+resultads['adv_title']+'</a>';
                          						    _html += '</div>';
                                                    
                                                _html += '</div>';
                                            _html += '</div>';
                                        _html += '</div>';
                                    }
                                    }
                                }else{
                                
                                    _html += '<div class="col-md-4 col-sm-4 col-xs-12 grid-item">';
            				            _html += '<div class="row">';
                                            _html += '<div class="gridinner">';
            				           	        _html += '<div class="image">';                							           		    
                                                    _html += '<a href="'+_url+'" title="'+value['property_name']+'">';
                                                        _html += '<img src="{{ URL::to('themes/emporium/images/emporium-voyage-logo-white-loader.svg') }}" data-src="{{ URL::to('propertyimagebyid')}}/'+value['id']+'" class="img-responsive rad-img" alt="'+value['property_name']+'" title="'+value['property_name']+'"  />';
                                                    _html += '</a>';
                                                _html += '</div>';
            				                    _html += '<div class="gridtext">';
                                                    _html += '<h5 class="entry-title">';
                                                        _html += '<a href="'+_url+'" rel="bookmark" style="">'+value['property_name']+'</a>';
                                                        //_html += '<a href="'+_url+'"><i class="fa fa-shopping-cart"></i></a>';
                                                    _html += '</h5>';
                                                    _html += '<p>'+value['property_usp']+'</p>';
                                                    _html += '<a class="read-more-link" href="'+_url+'" title="discover"><span class="newfontsimple">Discover</span></a>';
                                                _html += '</div>';
                                            _html += '</div>';
            				            _html += '</div>';
                                    _html += '</div>';
                                }
                                rw++;
                                        
                            });    
                        }
                        _html += '</div>';
                    _html += '</div>';
                _html += '</div>';
                
                _html += '<div class="col-md-12 col-xs-12 col-xs-12 text-center">';
                    _html += '<div class="row">';
                        var total_pages = jsonobj.total_pages;
                        if(total_pages>1){
                    		_html += '<ul class="pagination">';
                    			for(i=1; i<=total_pages; i++){
                    				<?php
                    					$url=Request::url().'?';
                    					$queryStrings=Request::query();
                    					if(isset($queryStrings['page']))
                    					{
                    						unset($queryStrings['page']);
                    					}
                    					foreach($queryStrings as $keyQuery=>$querystring):
                    						$url.=$keyQuery.'='.$querystring.'&';
                    					endforeach;
                    				?>
                                    var act = (i==jsonobj.active_page) ? 'active' : '';
                    				_html += '<li class="'+act+' paging"><a href="{{ $url.'page='}}'+i+'" data-page="'+i+'">'+i+'</a></li>';
                    			}    
                    		_html += '</ul>';
                		}
                	_html += '</div>';
                _html += '</div>';                
                
            }
            $(".load_ajax").html('');
            $(".load_ajax").html(_html);
            $grid = $('.grid').masonry({
              // options...
            }); 
            $grid.imagesLoaded().progress( function() {
              $grid.masonry('layout');
            });
            $('img.rad-img').photoLoadAfterPageLoad(noImg);
        }
        
        $(document).ready(function(){            
            
            $(document).on('click', '.Hotel', function () { 
                var nm = $(this).attr("data-name");
                if($(".side-Hotel").hasClass('collapsed')){
                    $(".side-Hotel").trigger('click');
                }
                $("input[name='activeHotel']").val(nm);
                
                var h_alias = nm.replace(/ /gi, '-');
                var s_name = "side-"+h_alias;
                $("."+s_name).trigger('click');                
                console.log(h_alias);
                getPDPPage(nm);
            });       
            
            $(document).on('click', '.Destination', function () { 
                var nm = $(this).attr("data-name"); 
                $("#channel_url").removeClass('active');
                $("#social_url").removeClass('active');
                if($(".side-Destination").hasClass('collapsed')){
                    $(".side-Destination").trigger('click');
                }
                var h_alias = nm.replace(/ /gi, '-');
                var s_name = "side-"+h_alias;
                $("."+s_name).trigger('click');  
                
                var cat = $(this).closest("li").attr('data-name');
                $("input[name='cat']").val(cat);                   
                getDestinationPage(nm);    
            });
            
            $(document).on('click', '.btnMembershipType', function(e){
                e.preventDefault();
                $("#cont_connoiss").css('display', 'none')
                $("#cont_packages").css('display', '');
            });
            
            $(document).on('click', '.galleryImgBtn', function () {
    			var params = $.extend({}, doAjax_params_default);
    			params['url'] = BaseURL + '/getpropertyroomimages/' + $(this).attr('rel');
    			params['successCallbackFunction'] = renderRoomimages;
    			doAjax(params);
    
    		});
            
            $(document).on('click', '.showMoreSec, .moreButtonPopup', function () {
    			$('.showMorePopup').css("background-image", "");
    			$('.showMoreContent').html('');
    			var params = $.extend({}, doAjax_params_default);
    			params['url'] = BaseURL + '/getpropertytypedetail/' + $(this).attr('rel');
    			params['successCallbackFunction'] = renderRoomdetails;
    			doAjax(params);
    
    		});
            
            /*$(document).on("click", ".btnMembershipTypeJoin", function(e){
                e.preventDefault();
                //$(".clicktologin").trigger("click");
                $(".signInPopupButton").trigger('click');
            });*/
            
            $(document).on('click', '#loginasa', function(e){
                $(".clicktologin").trigger('click');
            });
            
            $(document).on('click', '.full-rate', function(e){
                e.preventDefault();
                var id = $(this).attr('data-id');
                $("#mem-accordion-"+id).toggle();                 
            });
            
            $(document).on('click', ".dest-collection", function(e){
                e.preventDefault();
                //var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var d_name = $(this).attr('data-name');
                var cat =  $("input[name='cat']").val();           
                var coll_type = 'destinations';
                var req_for = '';
                var cobj = $(this);
                //var token = $("input[name='_token']").val();
                
                $.ajax({
                    url:'{{URL::to("propcollection/")}}',
                    dataType:'json',
                    data: {d_name:d_name, coll_type:coll_type, cat:cat},
                    type: 'post',
                    success: function(response){
                        
                        if(response.type=='dedicated-collection'){                            
                            var mem_types = response.mem_types;                            
                            if(mem_types.indexOf("2")>0){
                                //window.location.href = '{{URL::to('luxury_destinations')}}/'+cat+'/dedicated-collection';
                                //cat = $("#dd-destination").val();
                                getPropertyByCollection('dedicated-collection', cat, 1, req_for);
                                $(".dest-collection").removeClass('active');
                                cobj.addClass('active');
                                $("#dest_collection").val('dedicated-collection');
                            }else{
                                show_modal_content(response.type);  
                                $("#showMemberLoginPopup").modal({backdrop: 'static', keyboard: false}, 'show');
                            }  
                        }else if(response.type=='bespoke-collection'){
                            var mem_types = response.mem_types;                            
                            if(mem_types.indexOf("3")>0){
                                //window.location.href = '{{URL::to('luxury_experience')}}/'+cat+'/bespoke-collection';
                                //cat = $("#dd-destination").val();
                                getPropertyByCollection('bespoke-collection', cat, 1, req_for);
                                $(".dest-collection").removeClass('active');
                                cobj.addClass('active');
                                $("#dest_collection").val('bespoke-collection');
                            }else{
                                show_modal_content(response.type);  
                                $("#showMemberLoginPopup").modal({backdrop: 'static', keyboard: false}, 'show');                               
                            }
                        }else{
                            //cat = $("#dd-destination").val();
                            getPropertyByCollection('lifestyle-collection', cat, 1, req_for);
                            $(".dest-collection").removeClass('active');
                            cobj.addClass('active');
                            $("#dest_collection").val('lifestyle-collection'); 
                            //window.location.href = '{{URL::to('luxury_experience')}}/'+cat+'/lifestyle-collection';
                        }
                    }
                });    
            });
            
            
            
        });
        
        /*$(document).on('click', '[href="#tab-Hamburg"]', function(){            
            
        });*/
        
        $(document).on('click', '#loginToView', function(e){
            //$(".clicktologin").trigger('click');
            $(".popupMainDiv").addClass('openPopup');
            var curr_link = window.location.href;
            $("input[name=ref_page]").val(curr_link);
        });
        $(document).on('click', '.prevMonth', function(e){
            e.preventDefault();
            var mnth = $(this).attr('data-month');
            var yr = $(this).attr('data-year');
            if(mnth > 0){
                mnth--;
            }else{
                mnth = 01;
                yr--;
            }          
            var c_id = $(this).attr('data-type');
            $.ajax({
                url:'{{URL::to("ajaxnextprevmonth")}}',
                dataType:'json',
                data: {c_id:c_id, mnth:mnth, yr:yr},
                type: 'get',
                success: function(response){
                    
                    $('#calendar-'+c_id).html('');
                    if(response.status=='success'){
                        $('#calendar-'+c_id).html(response.data);
                    }
                }
            });
        });
        $(document).on('click', '.nextMonth', function(e){
            e.preventDefault();
            var mnth = $(this).attr('data-month'); 
            var yr = $(this).attr('data-year');
            if(mnth < 12){
                mnth++;
            }else{
                mnth = 01;
                yr++;
            }           
            
            var c_id = $(this).attr('data-type');
            $.ajax({
                url:'{{URL::to("ajaxnextprevmonth")}}',
                dataType:'json',
                data: {c_id:c_id, mnth:mnth, yr:yr},
                type: 'get',
                success: function(response){
                    
                    $('#calendar-'+c_id).html('');
                    if(response.status=='success'){
                        $('#calendar-'+c_id).html(response.data);
                    }
                }
            });
        });
        function choose_room_type(type)
		{
            if(logined){
                show_modal_content('lifestyle-collection');
                $("#showMemberLoginPopup").modal({backdrop: 'static', keyboard: false}, 'show');
                //$("#showLoginPopup").modal();
            }else{
    			$('#roomType').val('');
    			if (type != '' && type > 0)
    			{
    				$('#roomType').val(type);
    				$(".detail-page-booking-form").trigger("submit");
    			}
            }
		}
        
        function show_modal_content(memtype){
            $.ajax({
                url:'{{URL::to("membershiptype/popup")}}',
                type: "POST",
                data: {memtype:memtype},
                dataType: "json",
                success: function (data, textStatus, jqXHR) {
                    var popupHtml = '';
                    if (data.status == 'success') {
                        var obj = data.mem_package;
                        popupHtml += '<div class="row">';
                        
                            popupHtml += '<div class="col-sm-6 col-md-6 col-lg-6">';
                                popupHtml += '<img class="img-responsive object-fit-size" src="{{URL::to("uploads/category_imgs")}}/'+obj.category_image+'" style="width: 100%;">';
                            popupHtml += '</div>';
                            popupHtml += '<div class="col-sm-6 col-md-6 col-lg-6">';
                                popupHtml += '<h2 class="popup-title">'+obj.category_name+'</h2>';
                                popupHtml += '<p>'+(obj.category_description).replace(/\n/g,"<br>")+'</p>';
                                //popupHtml += '<h6>{!! isset($currency->content)?$currency->content:"&euro;" !!}'+obj.package_price+'</h6>';
                                
                                str_mem = '';
                                if(memtype=="dedicated-collection"){
                                    str_mem = 'Dedicated';
                                    str_mem2 = 'dedicated';
                                }else if(memtype=="bespoke-collection"){
                                    str_mem = 'Bespoke';
                                    str_mem2 = 'bespoke';
                                }else if(memtype=="lifestyle-collection"){
                                    str_mem = 'Lifestyle';
                                    str_mem2 = 'lifestyle';
                                }
                                popupHtml += '<a class="btnMembershipTypeJoin" href="{{URL::to("memberships")}}?type='+str_mem2+'">View Membership Benefits</a>';
                                popupHtml += '<a class="btnMembershipTypeJoin" id="loginasa">Login as a '+str_mem+' Member</a>';
                                
                            popupHtml += '</div>';
                            popupHtml += '<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">';
                                popupHtml += '<a class="btnMembershipTypeBack" href="#" data-dismiss="modal" aria-hidden="true">Back</a>';
                                //popupHtml += '<a class="btnMembershipTypeBack" onclick="window.history.back();">Back</a>';
                            popupHtml += '</div>';
                            //popupHtml += '<div class="col-sm-6 col-md-6 col-lg-6  col-xs-12">';
                                
                            //popupHtml += '</div>';
                        popupHtml += '</div>';
                    }
                    $(".mem-modal-popup").html(popupHtml);
                }
            });
        }
        function renderRoomdetails(data) {
            
			var rimg = data.roomimgs.imgsrc;
			$('.showMorePopup').css("background-image", "url('" + rimg + "')");
			var imagesPro = '';
			imagesPro += '<h1>' + data.typedata.category_name + '</h1>';
			imagesPro += '<p>' + data.amenities.amenities_eng.replace(/\n/g, "<br />") + '</p>';
			imagesPro += '<p>' + data.typedata.room_desc + '</p>';
            
            
    			imagesPro += '<div class="shoMoreButtonSection">';
    			if (data.typedata.price != '')
    			{
    				imagesPro += '<h2>';
    				imagesPro += (data.currency.content != '') ? data.currency.content : '$';
    				imagesPro += (logined) ? 'Login to view' : data.typedata.price;
    				imagesPro += '</h2>';
    			}
    			imagesPro += '<a href="javascript:void(0);" onclick="choose_room_type(' + data.typedata.id + ');" class="button">Book</a>';
    			imagesPro += '</div>';
            
            
			$('.showMoreContent').html(imagesPro);
			$('.showMorePopup').addClass('openPopup');
		}
        function renderRoomimages(data) {
			$('.galleryImgdata').html('');
			var imagesPro = '';
			var im=0;
			var di=0;
			var lngimg = Math.round((data.image.length)/3);
			imagesPro += '<div class="row">';
			$(data.image).each(function (i, val) {
				var clsact = '';
				imagesPro += '<div class="col-sm-6 col-xs-6 col-md-4 col-lg-4">';
				imagesPro += '<div class="popupHetelImage"><img src="' + val.imgsrc + '" alt="Image"></div>';
				imagesPro += '</div>';
				if(di==lngimg)
				{
					di=0;
					imagesPro += ' </div>';
					imagesPro += '<div class="row">';
				}
				im++;
				di++;
			});
			imagesPro += ' </div>';
			$('.galleryImgdata').html(imagesPro);
			$('.galleryImgPopup').addClass('openPopup');
		}
        function getPDPPage(item){
            $.ajax({
                url:'{{URL::to("getpdppage")}}',
                //dataType:'html',
                dataType:'json',
                data: {item:item},
                type: 'post',
                beforeSend: function(){
                    
                },
                success: function(data){
                    createPdpPage(data, item);
                    
                    var chk_date = new Date();            
                    var chk_out_date = new Date();
                    
                    @if(!empty(Session::get("arrive")))
                        chk_date = '{{Session::get("arrive")}}';
                    @else 
                        chk_date = chk_date;            
                    @endif
                    
                    @if(!empty(Session::get("departure")))
                        chk_out_date = '{{Session::get("departure")}}'; 
                    @else  
                        chk_out_date = chk_out_date;
                    @endif
                    
                    
                    $('#t-middel-picker').tDatePicker({
                        'numCalendar':'2',
                        'autoClose':true,
                        'durationArrowTop':'200',
                        'formatDate':'mm-dd-yyyy',
                        'titleCheckIn':'Arrival',
                        'titleCheckOut':'Departure',
                        'inputNameCheckIn':'arrive',
                        'inputNameCheckOut':'departure',
                        'titleDateRange':'days',
                        'titleDateRanges':'days',
                        'iconDate':'<i class="fa fa-calendar"></i>',
                        'limitDateRanges':'365',
                        'dateCheckIn':chk_date,
                        'dateCheckOut':chk_out_date,
                        //'dateCheckIn':'@if(isset($_GET['arrive']) && $_GET['arrive']!=''){{$_GET['arrive']}}@else{{'null'}}@endif',
                        //'dateCheckOut':'@if(isset($_GET['departure']) && $_GET['departure']!=''){{$_GET['departure']}}@else{{'null'}}@endif'
                    });
                    
                    if(data.propertyDetail['data']['social_instagram']!=''){
                        var channel_url = data.propertyDetail['data']['social_instagram']; 
                        $('.sections-instagram').eappsInstagramFeed({
                            api: '{{ url("runInsta")}}',
                            source: channel_url,                        
                            columns: 5,
                            rows: 2                        
                        });
                    }
                    if(typeof data.propertyDetail['typedata']!== undefined){
                        
                        $.each(data.propertyDetail['typedata'], function(tkey, tvalue){
                            $('#season-dpicker-'+tvalue['id']).tDatePicker({
                                'numCalendar':'2',
                                'autoClose':true,
                                'durationArrowTop':'200',
                                'formatDate':'mm-dd-yyyy',
                                'titleCheckIn':'Arrival',
                                'titleCheckOut':'Departure',
                                'inputNameCheckIn':'arrive_'+tvalue['id'],
                                'inputNameCheckOut':'departure_'+tvalue['id'],
                                'titleDateRange':'days',
                                'titleDateRanges':'days',
                                'iconDate':'<i class="fa fa-calendar"></i>',
                                'limitDateRanges':'365',
                                'dateCheckIn':chk_date,
                                'dateCheckOut':chk_out_date,
                                //'dateCheckIn':'@if(isset($_GET['arrive']) && $_GET['arrive']!=''){{$_GET['arrive']}}@else{{'null'}}@endif',
                                //'dateCheckOut':'@if(isset($_GET['departure']) && $_GET['departure']!=''){{$_GET['departure']}}@else{{'null'}}@endif'
                            });                                  
                        });
                        
                    }
                    
                    
                    $('#gs_sb_navhead').removeClass('navheadimage');
                    $('#gs_sb_criteria').removeClass('sdestination');
                          
                    
                }
            });    
        }
        
        function createPdpPage(data, tabname){
            var _html ='';
            var propertydtl = data.propertyDetail;
            
            if(typeof propertydtl !== undefined ){ 
                var propimage = propertydtl.propimage;
                
                _html +='<section class="luxuryHotelSlider">';
                    _html +='<div id="myCarousel" class="carousel" data-ride="carousel">';
                        _html +='<!-- Wrapper for slides -->';
                        _html +='<div class="carousel-inner">';
                            $.each(propimage, function(key, value){ //Pending file exist and image size cond
                                var sldactive = '';
                                                                
                                if(propertydtl.propimage[0]==value){
                                    sldactive = 'active';    
                                }                              
                                _html +='<div class="item '+sldactive+'">';
                                    _html +='<img src="'+propertydtl['propimage_thumbpath']+value['file_name']+'" alt="'+propertydtl['data']['property_name']+'">';
                                    _html +='<div class="carousel-caption">';
                                        _html +='<h1>'+propertydtl['data']['property_name']+'</h1>';
                                        _html +='<p>'+propertydtl['data']['property_usp']+'</p>';
                                    _html +='</div>';
                                _html +='</div>';
                           }); 
                        _html +='</div>';
                            _html +='<a class="left carousel-control" href="#myCarousel" data-slide="prev">'
                                _html +='<img src="{{ asset('themes/emporium/images/editorial-left-arrow.png') }}" alt="Icon">';
                            _html +='</a>';
                            
                            _html +='<a class="right carousel-control" href="#myCarousel" data-slide="next">';
                                _html +='<img src="{{ asset('themes/emporium/images/editorial-right-arrow.png') }}" alt="Icon">';
                            _html +='</a>';                                  
                        
                    _html +='</div>';   
                    _html +='<span class="scrollNextDivHotel"><a href="#hotelInfo">Scroll Down</a></span>'; 
                _html +='</section>';
                
                
                _html +='<!-- HAM YARD HOTEL -->';
                _html +='<section id="hotelInfo" class="HamYardHotelSection">';
                    _html +='<div class="HamYardHotelInner HamYardHotelInnerfirst">';
                        _html +='<div class="container">';
                            _html +='<div class="row">';
                                _html +='<div class="col-md-6">';
                                    _html +='<div class="leftPaddingSec">';
                                        _html +='<h2>'+propertydtl['data']['detail_section1_title']+'</h2>';
                                    _html +='</div>';
                                _html +='</div>';
                            _html +='</div>';
                            _html +='<div class="row">';
                                _html +='<div class="col-md-6">';
                                    _html +='<div class="leftPaddingSec">';
                                        _html +='<p>'+propertydtl['data']['detail_section1_description_box1']+'</p>';
                                    _html +='</div>';
                                _html +='</div>';
                                _html +='<div class="col-md-6">';
                                    _html +='<div class="rightPaddingSec">';
                                        _html +='<p>'+propertydtl['data']['detail_section1_description_box2']+'</p>';
                                        _html +='<a class="viewRooms scrollpage" href="#roomsSuit">View Rooms</a>';
                                    _html +='</div>';
                                _html +='</div>';
                            _html +='</div>';
                        _html +='</div>';
                    _html +='</div>';
                _html +='</section>';
                
                
                _html +='<!-- HAM YARD HOTEL -->';
                _html +='<section class="HamYardHotelSection">';
                    _html +='<div class="HamYardHotelInner HamYardHotelInnersecond">';
                        _html +='<div class="container">';
                            _html +='<div class="row">';
                                _html +='<div class="col-md-6">';
                                    _html +='<div class="leftPaddingSec">';
                                        _html +='<h2>'+propertydtl['data']['detail_section2_title']+'</h2>';
                                    _html +='</div>';
                                _html +='</div>';
                            _html +='</div>';
                            _html +='<div class="row">';
                                _html +='<div class="col-md-6">';
                                    _html +='<div class="leftPaddingSec">';
                                        _html +='<p>'+propertydtl['data']['detail_section2_description_box1']+'</p>';
                                    _html +='</div>';
                                _html +='</div>';
                                _html +='<div class="col-md-6">';
                                    _html +='<div class="rightPaddingSec">';
                                        _html +='<p>'+propertydtl['data']['detail_section2_description_box2']+'</p>';
                                        _html +='<div class="image-showcase-below-big-text">'+propertydtl['data']['assign_detail_city']+'</div>';
                                    _html +='</div>';
                                _html +='</div>';
                            _html +='</div>';
                        _html +='</div>';
                    _html +='</div>';
                _html +='</section>';
                
                
                _html +='<!-- MEMBERSHIP SECTION -->';
                _html +='<setion class="HamYardHotelSection" id="cont_connoiss">';
                    _html +='<div class="HamYardHotelInner HamYardHotelInnerthird">';
                        _html +='<div class="container">';
                            _html +='<div class="row">';
                                _html +='<div class="col-md-6">';
                                    _html +='<div class="leftPaddingSec">';
                                        _html +='<h2>CONNOISSEUR OF LUXURY</h2>';
                                    _html +='</div>';
                                _html +='</div>';
                            _html +='</div>';
                            _html +='<div class="row">';
                                _html +='<div class="col-md-6">';
                                    _html +='<div class="leftPaddingSec">';
                                        _html +='<p>Whatever your heart desires, we make it happen! Our par excellence, tailored concierge services ensure that the vision of all our customers is realized and they enjoy nothing less than the vacation of their dreams.</p>';
                                    _html +='</div>';
                                _html +='</div>';
                                _html +='<div class="col-md-6">';
                                    _html +='<div class="rightPaddingSec">';
                                        _html +='<p>We make immense pride in our dense network of luxury associates who help make our members experiences exceptional whereever of contracts ensures that our members get the very best life has to offer -no matter where they are in the world.</p>';  
                                        _html +='<div>';
                                            _html +='<div class="colMembershipType">';                                        
                                                _html +='<div class="dropdown show">';
                                                    _html +='<a class="btnMembershipType dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                                                        _html +='Our Memberships';
                                                    _html +='</a>';
                                            
                                                    _html +='<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">';
                                                        _html +='<a class="dropdown-item" href="#">Lifestyle</a>';
                                                        _html +='<a class="dropdown-item" href="#">Bespoke</a>';
                                                        _html +='<a class="dropdown-item" href="#">Dedicated</a>';
                                                    _html +='</div>';
                                                _html +='</div>';
                                            _html +='</div>';
                                            _html +='<!--<div class="colMembershipType">';
                                                _html +='<a class="btnMembershipTypeJoin" href="#roomsSuit">Join The Club</a>';
                                            _html +='</div> -->';   
                                        _html +='</div>';                         
                                    _html +='</div>';
                                _html +='</div>';
                            _html +='</div>';
                        _html +='</div>';                
                    _html +='</div>';
                _html +='</setion>';
                
                
                
                _html +='<div class="row member-type-pad" id="cont_packages" style="display: none;">';
                var objpackages = data.packages; 
                if(typeof objpackages !== undefined){                        
                var k=1; 
                    _html +='<div id="mem-accordion" class="panel-group">';
                    $.each(objpackages, function(pkey, pvalue){                    
                
                        _html +='<div class="panel panel-default">';
                            _html +='<div class="panel-heading">';
                                _html +='<h4 class="panel-title">';
                                    _html +='<a class="click0" data-toggle="collapse" data-parent="#mem-accordion" href="#collapse_'+k+'">'+pvalue['package_title']+'</a>';
                                _html +='</h4>';
                            _html +='</div>';
                            var strin = '';
                            if(k==1){
                               strin="in"; 
                            }
                            _html +='<div id="collapse_'+k+'" class="panel-collapse collapse '+strin+'">';
                                _html +='<div class="panel-body magin-top-30">';
                                    _html +='<div class="row">';
								        _html +='<div class="col-sm-6 col-md-6 col-lg-6 pull-left">';
                                        if(pvalue['package_image'] != ''){
                                            _html +='<img class="img-responsive object-fit-size" src="{{URL::to('uploads/packages/')}}/'+pvalue['package_image']+'" alt="'+pvalue['package_image']+'" style="width: 100%;" >';
                                        }
                                        _html +='</div>';
                                        _html +='<div  class="col-sm-6 col-md-6 col-lg-6 pull-right">';
                                            _html +='<div class="row">';
                                                _html +='<div  class="col-sm-12 col-md-12 col-lg-12 border-2px">';
                                                    _html +='<p>'+pvalue['package_description']+'</p>';
                                                        _html +='<div class="row">';
                                                            _html +='<div class="col-sm-12 col-md-12 col-lg-12 top-margin-20">';
                                                  
                                                                _html +='<h6>{!! isset($currency->content)?$currency->content:'&euro;' !!}'+pvalue['package_price']+'</h6>';                                                
                                                            _html +='</div>';
                                                        _html +='</div>';
                                                    _html +='</div>';
                                                _html +='</div>';                
                                            _html +='<div class="row" style="margin-top: 10px;">';
                                                                                                                             
                                                _html +='<div class="col-lg-12 m--align-right">';
                                                    _html +='<div>';                                                                        
                                                        _html +='<a class="btnMembershipTypeJoin" href="javascript:void(0);">Join The Club</a>';
                                                    _html +='</div>';
                                                _html +='</div>';
                                       
                                            _html +='</div>';   
                                        _html +='</div>';
                                    _html +='</div>';
                                _html +='</div>';
                            _html +='</div>';
                        _html +='</div>';
                        k++;
                    });                    
                			
                    _html +='</div>';
                }
                _html +='</div>';
                
                
                
                var objtypedata = propertydtl.typedata; 
                if(typeof objtypedata !== undefined){ 
                    _html +='<!-- hotel slider 1 -->';
                    $.each(objtypedata, function(key, value){ 
                        
                        if(propertydtl.roomimgs[value['id']])
                        {
                            var totimg = (propertydtl.roomimgs[value['id']]['imgs']).length;
                             
                            var divd2 = Math.round(totimg/2);                                                                                                                                                                                                                                                                                                  
                            
                                _html +='<section id="roomsSuit" class="roomSuitSlider">';
                                    _html +='<div class="container-fluid">';
                                        _html +='<div class="row">';                                        
                                        
                                            _html +='<div class="col-sm-6 noPadding">';
                                                _html +='<div id="left'+value['id']+'" class="carousel slide leftSlider terraceSuiteSlider" data-ride="carousel">';
                                                    _html +='<div class="carousel-inner">';
                                                        for(rimg1=0; rimg1 < divd2; rimg1++){
                                                            strrimg1 = '';
                                                            if(rimg1==0){
                                                                strrimg1 = 'active';    
                                                            }
                                                            _html +='<div class="item '+strrimg1+'">';
                                                                _html +='<a href="javascript:void(0);" class="galleryImgBtn" rel="'+value['id']+'">';
                                                                    _html +='<img src="{{ asset('themes/emporium/images/photo-camera.png') }}" alt="Icon">';
                                                                _html +='</a>';
                                                                _html +='<img src="'+propertydtl.roomimgs[value['id']]['imgsrc']+propertydtl.roomimgs[value['id']]['imgs'][rimg1]['file_name']+'" alt="'+propertydtl.roomimgs[value['id']]['imgs'][rimg1]['file_name']+'">';
                                                            _html +='</div>';
                                                        }
            
                                                        for(rimg2=rimg1; rimg2 < totimg; rimg2++){
                                                            _html +='<div class="item">';
                                                                _html +='<a href="javascript:void(0);" class="galleryImgBtn" rel="'+value['id']+'">';
                                                                    _html +='<img src="{{ asset('themes/emporium/images/photo-camera.png') }}" alt="Icon">';
                                                                _html +='</a>';
                                                                _html +='<img src='+propertydtl.roomimgs[value['id']]['imgsrc']+propertydtl.roomimgs[value['id']]['imgs'][rimg2]['file_name']+'" alt="'+propertydtl.roomimgs[value['id']]['imgs'][rimg2]['file_name']+'" alt="'+propertydtl.roomimgs[value['id']]['imgs'][rimg2]['file_name']+'">';
                                                            _html +='</div>';
                                                        }
                                                    _html +='</div>';
                                                    
                                                    _html +='<a class="left carousel-control left01" href="#left'+value['id']+'" data-slide="prev">';
                                                        _html +='<span class="glyphicon glyphicon-chevron-left"></span>';
                                                        _html +='<span class="sr-only">Previous</span>';
                                                    _html +='</a>';
                                                    _html +='<a class="right carousel-control" href="#left'+value['id']+'" data-slide="next">';
                                                        _html +='<span class="glyphicon glyphicon-chevron-right"></span>';
                                                        _html +='<span class="sr-only">Next</span>';
                                                    _html +='</a>';
                                                    
                                                _html +='</div>';
                                            _html +='</div>';                                            
                                            
                                            _html +='<div class="col-sm-3 noPadding">';
                                                _html +='<div class="sliderContent">';
                                                    _html +='<h3>'+value['category_name']+'</h3>';
                                                    var room_desc = '';
                                                    if(value['room_desc'].length > 100){
                                                        room_desc = value['room_desc'].substr(0, 100)+'....';
                                                    }else{
                                                        room_desc = value['room_desc']; 
                                                    }
                                                    _html +='<p>'+room_desc+'</p>';
                                                    _html +='<button class="btn btn-default moreButtonPopup" type="button" rel="'+value['id']+'">More</button>';
                                                    _html +='<button class="btn btn-default bg-color" type="button" onclick="choose_room_type('+value['id']+');">Reservation</button>';
                                                    
                                                    if(value['price']!=''){
                                                        var prc_login = '';
                                                        @if(isset(\Auth::user()->id))
                                                            prc_login = value['price'];    
                                                        @else
                                                            prc_login = 'Login to view';
                                                        @endif
                                                        
                                                        _html +='<a class="btn btn-default" title="'+value['season']+'" id="loginToView"> {{($currency->content!='') ? $currency->content : '$'}} '+prc_login+' </a>';
                                                        @if(isset(\Auth::user()->id))                                                
                                                            _html +='<a  href="#" data-id="'+value['id']+'" class="btn btn-default full-rate" title="Rates">{{($currency->content!='') ? $currency->content : '$'}}/Availability</a>';
                                                        @endif                                           
                                                    }
                                                    
                                                    _html +='<div class="sliderArrow">';
                                                        _html +='<a href="javascript:void(0);" class="prevClick"><i class="fa fa-angle-left"></i></a>';
                                                        _html +='<a href="javascript:void(0);" class="nextClick"><i class="fa fa-angle-right"></i></a>';
                                                    _html +='</div>';
                                                _html +='</div>';
                                            _html +='</div>';
                                            
                                            _html +='<div class="col-sm-3 noPadding hidden-xs">';
                                                _html +='<div id="right'+value['id']+'" class="carousel slide rightSlider terraceSuiteSlider" data-ride="carousel">';
                                                    _html +='<div class="carousel-inner">';
                                                        for(rimg1=0; rimg1 < divd2; rimg1++){
                                                            strrimgdv2 = '';
                                                            if(rimg1==0){
                                                                strrimgdv2 = 'active';    
                                                            }
                                                            _html +='<div class="item '+strrimgdv2+'">';
                                                                _html +='<a href="javascript:void(0);" class="galleryImgBtn" rel="'+value['id']+'">';
                                                                    _html +='<img src="{{ asset('themes/emporium/images/photo-camera.png') }}" alt="Icon">';
                                                                _html +='</a>';
                                                                _html +='<img src="'+propertydtl.roomimgs[value['id']]['imgsrc']+propertydtl.roomimgs[value['id']]['imgs'][rimg1]['file_name']+'" alt="'+propertydtl.roomimgs[value['id']]['imgs'][rimg1]['file_name']+'" >';
                                                            _html +='</div>';
                                                        }
                                                        var sactive = '';
                                                        for(rimg2=rimg1; rimg2 < totimg; rimg2++){
                                                            
                                                            if(totimg<3){ sactive = 'active'; }
                                                            _html +='<div class="item '+sactive+'">';
                                                                _html +='<a href="javascript:void(0);" class="galleryImgBtn" rel="'+value['id']+'">';
                                                                    _html +='<img src="{{ asset('themes/emporium/images/photo-camera.png') }}" alt="Icon">';
                                                                _html +='</a>';
                                                                _html +='<img src="'+propertydtl.roomimgs[value['id']]['imgsrc']+propertydtl.roomimgs[value['id']]['imgs'][rimg2]['file_name']+'" alt="'+propertydtl.roomimgs[value['id']]['imgs'][rimg2]['file_name']+'" >';
                                                            _html +='</div>';
                                                        }
                                                    _html +='</div>';
                                                    _html +='<a class="left carousel-control left01" href="#right'+value['id']+'" data-slide="prev">';
                                                        _html +='<span class="glyphicon glyphicon-chevron-left"></span>';
                                                        _html +='<span class="sr-only">Previous</span>';
                                                    _html +='</a>';
                                                    _html +='<a class="right carousel-control" href="#right'+value['id']+'" data-slide="next">';
                                                        _html +='<span class="glyphicon glyphicon-chevron-right"></span>';
                                                        _html +='<span class="sr-only">Next</span>';
                                                    _html +='</a>';
                                                    
                                                _html +='</div>';                                                
                                            _html +='</div>';
                                            
                                        _html +='</div>';
                                        
                                        
                                        
                                        _html +='<div class="row season-accordion">';                                        
                                            if(typeof value['seasonwiseprice']!==undefined){                        
                                                var k=1; 
                                    			_html +='<div id="mem-accordion-'+value['id']+'" class="panel-group" style="display: none;">';
                                                    _html +='<div class="col-sm-6 calendar-left-box">';
                                                        _html +='<div class="col-sm-10 t-datepicker-box">';
                                                            _html +='<div id="season-dpicker-'+value['id']+'" class="t-datepicker">';
                                                                _html +='<div class="t-date-divide">';
                                                                    _html +='<div class="t-check-in"></div>';
                                                                _html +='</div>';
                                                                _html +='<div class="t-date-divide">';
                                                                    _html +='<div class="t-check-out"></div>';
                                                                _html +='</div>';
                                                            _html +='</div>'; 
                                                        _html +='</div>';
                                                        _html +='<div class="col-sm-2 pad-0">';
                                                            _html +='<button class="btn season-search" data-id="'+value['id']+'">Submit</button>';
                                                        _html +='</div>';
                                                        _html +='<div class="col-sm-12" style="margin-top: 20px;">';
                                                            var objseasonwiseprice = value['seasonwiseprice'];
                                                            $.each(objseasonwiseprice, function(skey, svalue){
                                                                _html +='<div class="panel panel-default">';
                                                                    _html +='<div class="panel-heading">';
                                                                        _html +='<h4 class="panel-title">';
                                                                            var season_name = '';
                                                                            if(svalue['season_name'] =='' || svalue['season_name']==null){
                                                                                season_name = 'Default';         
                                                                            }else{
                                                                                season_name = svalue['season_name']; 
                                                                            }
                                                                            _html +='<a class="click0" data-toggle="collapse" data-parent="#mem-accordion-'+value['id']+'" href="#collapse_'+value['id']+'_'+k+'">'+season_name+'</a>';
                                                                        _html +='</h4>';
                                                                    _html +='</div>';
                                                                    _html +='<div id="collapse_'+value['id']+'_'+k+'" class="panel-collapse collapse '+((k==1) ? 'in' : '') +'">';
                                                                        _html +='<div class="panel-body">';
                                                                            _html +='<div class="row">';
                                                                                _html +='<div  class="col-sm-12 col-md-12 col-lg-12">';
                                                                                    _html +='Base rate: {{($currency->content!='') ? $currency->content : '$'}}'+svalue['rack_rate'];                                                               
                                                                                _html +='</div>';
                                                                            _html +='</div>';
                                                                        _html +='</div>';
                                                                    _html +='</div>';
                                                                _html +='</div>'; 
                                                                k++;           
                                                            });
                                                            
                                                        _html +='</div>';
                                                    _html +='</div>';	
                                                    _html +='<div class="col-sm-6 season-calendar" id="calendar-'+value['id']+'">';
                                                        _html += value['room_calendar'];                                           
                                                    _html +='</div>';			
                                                _html +='</div>';
                                                }
                                            _html +='</div>';   
                                            
                                            
                                        _html +='</div>';
                                    _html +='</div>';
                                _html +='</section>';                                                                                                                                                                                                                                                                                                       }
                    });    
                }
                                
                                
                 _html +='<!-- Design and Architecture section -->';
                 if(propertydtl['data']['architecture_title']!='' && propertydtl['data']['architecture_desciription']!=''){
                     _html +='<section id="design-architecture">';
                         _html +='<div class="container">';
                            _html +='<figure class="design-image">';
                                if(propertydtl['data']['architecture_image']!=''){
                                     _html +='<img src="{{url('uploads/properties_subtab_imgs/')}}/'+propertydtl['data']['architecture_image']+'" alt="Design & Architecture" class="img-responsive"/>';
                                }else{
                                     _html +='<img class="architecture-sec-top-img" src="{{url('sximo/assets/images/Architecture-&-Design.png')}}" alt=""/>';
                                }
                            _html +='</figure>';
                             _html +='<div class="content-box">';
                                 _html +='<div class="quote-small-box">';
                                     _html +='<p>'+propertydtl['data']['architecture_title']+'</p>';
                                 _html +='</div>';
                                 _html +='<h2>Architecture & Design</h2>';
                                 _html +='<p>'+propertydtl['data']['architecture_desciription']+'</p>';
                             _html +='</div>';
                         _html +='</div>';
                     _html +='</section>';
                }
                
                
                _html +='<!-- Design and Architecture section End -->';
                var objtypedata2 = propertydtl.typedata;
                if(typeof objtypedata2 !== undefined){                                
                    _html +='<!-- terrace suit slider sec -->';
                    _html +='<div class="HamYardHotelSection">';
                        _html +='<div class="container">';
                            _html +='<div id="HamYardHotelSlider" class="carousel slide HamYardHotelSlider" data-ride="carousel">';
                                _html +='<div class="carousel-inner">';
                                    var k=1;
                                    
                                    var bgimg = '';
                                    $.each(objtypedata2, function(kkey, kvalue){ 
                                        if(propertydtl.roomimgs[kvalue['id']]){                                            
                                            var strks2active = '';
                                            if(k==1){
                                               strks2active='active';     
                                            }
                                            bgimg = propertydtl.roomimgs[kvalue['id']]['imgsrc'] + propertydtl.roomimgs[kvalue['id']]['imgs'][0]['file_name'];
                                            _html +='<div style="background-image: url(\''+bgimg+'\');" class="item '+strks2active+'">';
                                                _html +='<div class="carousalCaption">';
                                                    _html +='<h3>Experience '+propertydtl['data']['property_name']+'</h3>';
                                                    _html +='<h2>'+kvalue['category_name']+'</h2>';
                                                    var r_desc ='';
                                                    if(kvalue['room_desc'].length > 300){
                                                        r_desc = kvalue['room_desc'].substr(0, 300)+'...';    
                                                    }else{
                                                        r_desc = kvalue['room_desc'];
                                                    }
                                                    _html +='<p>'+r_desc+'</p>';
                                                _html +='</div>';
                                            _html +='</div>';
                                            k++; 
                                        }
                                    });
                                _html +='</div>';
                                _html +='<div class="HamYardHotelSliderOptions">';
                                    _html +='<div class="terraceSuitindicator">';
                                        _html +='<div class="terraceSuitarrow">';
                                            _html +='<div class="terraceSuitCounter">';
                                                _html +='<p></p>';
                                                _html +='<div class="num"></div>';
                                            _html +='</div>';
                                            _html +='<a class="left left1 carousel-control" href="#HamYardHotelSlider" data-slide="prev">';
                                                _html +='<img src="{{ asset('themes/emporium/images/editorial-left-arrow.png') }}" alt="icon">';
                                            _html +='</a>';
                                            _html +='<a class="right carousel-control" href="#HamYardHotelSlider" data-slide="next">';
                                                _html +='<img src="{{ asset('themes/emporium/images/editorial-right-arrow.png') }}" alt="icon">';
                                            _html +='</a>';
                                        _html +='</div>';
                                        _html +='<ol class="carousel-indicators">';
                                            var kn=0;
                                            var knbgimg='';
                                            $.each(objtypedata2, function(kkey, kvalue){ 
                                                if (propertydtl.roomimgs[kvalue['id']]){
                                                    var strkn = '';
                                                    if(kn==1){
                                                        strkn='active'    
                                                    }
                                                    knbgimg = propertydtl.roomimgs[kvalue['id']]['imgsrc'] + propertydtl.roomimgs[kvalue['id']]['imgs'][0]['file_name'];                                                    
                                                    _html +='<li data-target="#HamYardHotelSlider" data-slide-to="'+kn+'" class="'+strkn+'"><img src="'+knbgimg+'" alt="Image">';
        
                                                        _html +='<div rel="'+kvalue['id']+'" name="'+kvalue['category_name']+'" class="showMoreSec" style="display:inline-block;">';
                                                            _html +='<button type="button" class="btn buttonDefault">SHOW MORE</button>';
                                                        _html +='</div>';
        
                                                    _html +='</li>';
        
                                                    kn++;
                                                }
                                            });
                                        _html +='</ol>';
                                        
                                    _html +='</div>';
                                _html +='</div>';
                            _html +='</div>';
                        _html +='</div>';
                    _html +='</div>';
                }  
                
                
                
                
                
                
                if(propertydtl['data']['video_title']!=''){
                    _html +='<!-- Video Section starts here -->';
                    _html +='<section id="video" class="videoSection">'; 
                    if(propertydtl['data']['video_type']=="upload"){
                        var videolink = '"'+BaseURL+'uploads/properties_subtab_imgs/'+propertydtl['data']['video_video']+'"';
                        
                        var video_banner = '"'+BaseURL+((propertydtl['data']['video_image']!='')? 'uploads/properties_subtab_imgs/'+propertydtl['data']['video_image'] : 'sximo/images/mp4.png')+'"';
                        
                        _html +='<video id="videoPoster" controls poster="'+video_banner+'">';
                            _html +='<source src="'+videolink+'" type="video/mp4">';
                        _html +='</video>';
                    }else if(propertydtl['data']['video_type']=="link"){ 
                        var vlink = propertydtl['data']['video_link'].split('/'); var vimeoid = vlink[vlink.length-1]; 
                        
                        if(propertydtl['data']['video_link_type']=="youtube"){
                            var videolink = "https://www.youtube.com/embed/"+vimeoid; console.log(videolink);
                            _html +='<iframe width="100%" height="680px;" src="'+videolink+'" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
                        }else if(propertydtl['data']['video_link_type']=="vimeo"){
                            var videolink = "https://player.vimeo.com/video/"+vimeoid;
                            _html +='<iframe width="100%" height="680px;" src="'+videolink+'" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
                        }                        
                    }
                    _html +='</section>';
                    _html +='<!-- Video Section END here -->';
                }
        
        
                _html +='<section id="bookHotel" class="hotelSearchDateSection">';
                    _html +='<div class="HamYardHotelInner HamYardHotelInnerfooter">';
                        _html +='<div class="hotelSearchDateInnerContent text-center">';
                            _html +='<div class="container-fluid">';
                                _html +='<div class="row">';
                                    _html +='<div class="col-xs-12">';
                                        _html +='<div class="hotelPopupHeadings">';                                                            
                                            _html +='<h2>Connoisseurs of Luxury Lifestyle</h2>';
                                            _html +='<p class="planner-text">Emporium Collection provides a bespoke service that offers an extensive collection of some of the most exquisite and exclusive suites & experiences around the world.</p>';                                                     
                                        _html +='</div>';
                                    _html +='</div>';
                                _html +='</div>';
                                _html +='<form class="detail-page-booking-form" action="'+BaseURL+'/book-property/'+propertydtl['data']['property_slug']+'" method="get">';
                                    _html +='<input type="hidden" name="property" id="property" value="'+propertydtl['data']['id']+'"/>';
                                    _html +='<input type="hidden" name="roomType" id="roomType" value=""/>';
                                    _html +='<div class="row">';
                                        _html +='<ul class="hotelBorderList">';
                                            
                                            _html +='<li class="center-calendarbox t-picker-width">';
                                                _html +='<div id="t-middel-picker" class="t-datepicker">';
                                                    _html +='<div class="t-date-divide">';
                                                        _html +='<h3>Arrival</h3>';
                                                        _html +='<div class="t-check-in"></div>';
                                                    _html +='</div>';
                                                    _html +='<div class="t-date-divide">';
                                                        _html +='<h3>Departure</h3>';
                                                        _html +='<div class="t-check-out"></div>';
                                                    _html +='</div>';
                                                _html +='</div>';
                                            _html +='</li>';
                                            
                                            var adult = '';
                                            @if(!empty(Session::get('booking_adults'))) 
                                                adult = {{Session::get('booking_adults')}}; 
                                            @else
                                                adult = 1; 
                                            @endif
                                            
                                            _html +='<li>';
                                                _html +='<h3>Adults</h3>';
                                                _html +='<select name="booking_adults">';
                                                    _html +='<option >1</option>';
                                                    _html +='<option >2</option>';
                                                    _html +='<option >3</option>';
                                                    _html +='<option >4</option>';
                                                    _html +='<option >5</option>';
                                                    _html +='<option >6</option>';
                                                    _html +='<option >7</option>';
                                                    _html +='<option >8</option>';
                                                    _html +='<option >9</option>';
                                                    _html +='<option >10</option>';
                                                    _html +='<option >11</option>';
                                                    _html +='<option >12</option>';
                                                    _html +='<option >13</option>';
                                                    _html +='<option >14</option>';
                                                    _html +='<option >15</option>';                                            
                                                _html +='</select>';
                                            _html +='</li>';
                                            
                                            var child = '';
                                            @if(!empty(Session::get('booking_children'))) 
                                                child = {{Session::get('booking_children')}} 
                                            @else
                                                child = 0; 
                                            @endif
                                            _html +='<li>';
                                                _html +='<h3>Children</h3>';
                                                _html +='<select name="booking_children">';
                                                    _html +='<option >0</option>';
                                                    _html +='<option >1</option>';
                                                    _html +='<option >2</option>';
                                                    _html +='<option >3</option>';
                                                    _html +='<option >4</option>';
                                                    _html +='<option >5</option>';
                                                    _html +='<option >6</option>';                                            
                                                    _html +='<option >7</option>';
                                                    _html +='<option >8</option>';
                                                    _html +='<option >9</option>';
                                                    _html +='<option >10</option>';
                                                    _html +='<option >11</option>';
                                                    _html +='<option >12</option>';
                                                    _html +='<option >13</option>';
                                                    _html +='<option >14</option>';
                                                    _html +='<option >15</option>';
                                                _html +='</select>';
                                            _html +='</li>';
                                        _html +='</ul>';
                                        _html +='<div class="text-center hotelBookNowButton">';
                                            _html +='<button type="submit" class="btn">BOOK NOW</button>';
                                        _html +='</div>';
                                        _html +='<div class="hotelCancelBooking text-center">';
                                            _html +='<a href="javascript:void(0);">View, Modify or Cancel your Booking</a>';
                                        _html +='</div>';
                                        _html +='<ul class="hotelBookingFooter">';
                                            _html +='<li>';
                                                _html +='<a href="javascript:void(0);">';
                                                    _html +='<span>Join the worlds leading luxury club</span>';
                                                _html +='</a>';
                                                _html +='<a href="javascript:void(0);" class="enjoy_exclusive_member">';
                                                    _html +='<h6>Enjoy exclusive members only benefits</h6>';
                                                _html +='</a>';
                                            _html +='</li>';
                                            _html +='<li>';
                                                _html +='<a href="javascript:void(0);">';
                                                    _html +='<span>View or Modify Reserveration</span>';
                                                _html +='</a>';
                                                _html +='<a href="javascript:void(0);" class="login_hotel_pms">';
                                                    _html +='<h6>Login to Hotel PMS</h6>';
                                                _html +='</a>';
                                            _html +='</li>';
                                            _html +='<li>';
                                                _html +='<a href="javascript:void(0);">';
                                                    _html +='<span>Spa Treatment</span>';
                                                    _html +='<h6>Book</h6>';
                                                _html +='</a>';
                                            _html +='</li>';
                                        _html +='</ul>';
                                    _html +='</div>';
        
                                _html +='</form>';
                            
                            _html +='</div>';
                        _html +='</div>';
                    _html +='</div>';
                _html +='</section>';
                        
                if(propertydtl['data']['assign_detail_city']!=''){
                    var objrelatedprop = data.relatedgridpropertiesArr;
                    if(typeof objrelatedprop!==undefined){
                        _html +='<section id="luxury-hotel-selection">';
                            _html +='<div class="container-fluid">';
                                _html +='<div class="row">';
                                    _html +='<div class="col-sm-12 text-center">';
                                        _html +='<h2 class="heading" style="text-transform: uppercase;">view our selection of "related" luxury hotels in IN '+propertydtl['data']['assign_detail_city']+'</h2>';
                                    _html +='</div>';
                                _html +='</div>';
                                _html +='<div class="grid dsp-flex">';                        
                            
                                    $.each(objrelatedprop, function(key, value){
                                        _html +='<div class="col-md-3 col-sm-6 col-xs-12 grid-item">';
                                            _html +='<div class="row">';
                                                _html +='<div class="gridinner">';
                                                    _html +='<div class="image">';
                                                        _html +='<a class="showhide" href="'+BaseURL+'/'+value['data']['property_slug']+'" rel="bookmark" style="">'+value['data']['property_name']+'</a>';
                                                        _html +='<a href="'+BaseURL+'/'+value['data']['property_slug']+'" title="'+value['data']['property_name']+'">';
                                                            _html +='<img src="'+BaseURL+'/propertyimagebyid/'+value['data']['id']+'" class="img-responsive" alt="'+value['data']['property_name']+'" title="'+value['data']['property_name']+'">';
                                                  
                                                        _html +='</a>';
        
                                                    _html +='</div>';
                                                    _html +='<div class="gridtext">';
                                                        _html +='<h5 class="entry-title">';
                                                            _html +='<a href="'+value['data']['property_slug']+'" rel="bookmark" style="">'+value['data']['property_name']+'</a>';
                                                            _html +='<a href="'+value['data']['property_slug']+'"><i class="fa fa-shopping-cart"></i></a>';
                                                        _html +='</h5>';
                                                        _html +='<p>'+value['data']['property_usp']+'</p>';
                                                        _html +='<a class="read-more-link" href="'+BaseURL+'/'+value['data']['property_slug']+'" title="discover">discover</a>';
                                                    _html +='</div>';
                                                _html +='</div>';
                                            _html +='</div>';
                                        _html +='</div>';        
                                    });
                                      
                              _html +='</div>';  
                    		      
                    		      
                    		      
                            _html +='</div>';
                        _html +='</section>';
                                
                    }
                    
                }
                                
                                
                                
                                                                                                                                                                                  _html +='<!-- Selection of Luxury Hotels end -->';
                _html +='<!-- Instagram Gallery Section -->';
                if(propertydtl['data']['social_instagram']!=''){
                    _html +='<section id="instagram-section">';
                        _html +='<div class="col-sm-12 text-center">';
                            _html +='<h2 class="heading">GET SOCIAL</h2>';
                        _html +='</div>';
                        _html +='<section id="instagran" class="sections-instagram">';
                            _html +='<div class="full-width">';
                                _html +='<div data-is data-is-api="{{ url('runInsta')}}" data-is-source="'+propertydtl['data']['social_instagram']+'" data-is-rows="2" data-is-limit="0" data-is-columns="5"></div>';
                            _html +='</div>';
                        _html +='</section>';
                    _html +='</section>';
                }                                                                                                                                     
                        
                
            
                
                    
                    
                
        
        
        
                var tabname = tabname.replace(/ /gi, '-');        
                $('#tab-'+tabname).html(_html);
                
            }            
        }
        
        function getseasonrates(proid)
        {
        	if(proid!='' && proid>0)
        	{
        		$.ajax({
        		  url: "{{ URL::to('getPropertyTypeRates')}}",
        		  type: "post",
        		  data: 'propid='+proid,
        		  dataType: 'json',
        		  success: function(data){
        			if(data.status!='error')
        			{
        				var prorates = '';
        				var im=0;
                        prorates += "<table>";
                        prorates += "<tbody>";
                        
        				$(data.cat_rooms_price.cat_rooms).each(function (i, val) {
        					prorates += '<tr>';
        					//prorates += '<td>'+val.category_name+'</td>';
        					prorates += '<td>';
        					if(val.season_name==null)
        					{
        						prorates += 'Default';
        					}
        					else
        					{
        						prorates += val.season_name;
        					}	
        					prorates += '</td>';
        					prorates += '<td>'+val.rack_rate+'</td>';
        					//prorates += '<td>'+data.cat_rooms_price.usercomm.commission+'</td>';
        					prorates += '<td>';
        					/*if(data.cat_rooms_price.usercomm.commission!=null)
        					{
        						var pert = (val.rack_rate*data.cat_rooms_price.usercomm.commission)/100;
        						var finalvl = val.rack_rate - pert;
        						prorates += finalvl;
        					}*/						
        					prorates += '</td>';
        					prorates += '</tr>';
        				});
                        prorates += "</tbody>";
                        prorates += "</table>";
                        
        				$('#ratecomm').html(prorates);
        			}
        		  }
        		});
        	}
        }
        
    </script>
@endsection

{{-- For footer --}}
@section('footer')
    @parent
@endsection
