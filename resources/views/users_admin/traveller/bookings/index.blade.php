@extends('users_admin.traveller.layouts.app')

@section('page_name')
    My Reservations
@stop

@section('breadcrumb')
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('dashboard')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Dashboard </span> 
        </a> 
    </li>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="javascript:;" class="m-nav__link"> 
            <span class="m-nav__link-text"> My Reservations </span> 
        </a> 
    </li>
@stop

@section('content')

    <div class="row">
        <!--<div class="col-sm-12 col-md-4 col-xl-4">
            <div id="dv_reservation">
                
            </div>
        </div>-->
        <div class="col-sm-12 col-md-12 col-xl-12">
            <div id="map"></div>
            <div id="maprightside" class="map-rightside">
                <span id="maprightside_close" class="maprightside-close">
					<i class="la la-close"></i>
				</span>
                <div id="dv_reservation" class="maprightside-resv-view"></div>
            </div>
        </div>
        <!--<div class="col-sm-12 col-md-12 col-xl-12">
            <div id="dv_calendar"></div>
        </div> -->
    </div>

@stop
{{-- For custom style  --}}
@section('style')
    @parent
    <style>
        .map-rightside{
            position: fixed;
            right:0;
            top: 0px;
            width: 650px;
            height: 100%;            
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
            background-color: #fff;
            -webkit-box-shadow: 0 0 15px 1px rgba(69, 65, 78, .2);
            box-shadow: 0 0 15px 1px rgba(69, 65, 78, .2);
            overflow-y: auto;
            z-index: 1001;
        }
        .maprightside-close{
            position: absolute;
            font-size: 1.4rem;
            cursor: pointer;
            top: 16px;
            right: 30px;
            color: #cfcedb;
        }
        .maprightside-resv-view{
            padding-top: 50px;
        }
        #map {
            height: 400px;  /* The height is 400 pixels */
            width: 100%;  /* The width is the width of the web page */
        }
        .btn-mar{
            float: left;
            margin: 1px;
        }
        @media (max-width:767.98px) {
            .map-rightside{
                width: 100%;
            }
        }
    </style>
@endsection
@section('custom_js_script')    
    <script>
    var _base_url = '{{URL::to("/")}}'
    var location11 = '{{$list_booking}}';
    location12 = location11.replace(/&quot;/g, '"');    
    var locations = JSON.parse(location12);
    //console.log(j_v[0].property_name);
    //console.log(j_v);
    $(document).ready(function () {

        $('.do-quick-search').click(function () {
            $('#SximoTable').attr('action', '{{ URL::to("bookings/multisearch")}}');
            $('#SximoTable').submit();
        });
        var start_dt = new Date();
        bot_dates(start_dt);
        
        $(document).on('click', '#vw_reservations', function(e){
            e.preventDefault();
            url = $(this).attr('href');
            getFullDetail(url);
        });
        
        $(document).on('click', '#dt-back', function(){
            var id = $(this).attr('data-id');
            getprop(id);
        });
        
        $(document).on('click', '.btn-mar', function(){
           var cdt = $(this).attr('data-date'); 
      /*     console.log(cdt);
           var broadway = {
    		info: '<strong>Chipotle on Broadway</strong><br>\
    					5224 N Broadway St<br> Chicago, IL 60640<br>\
    					<a href="https://goo.gl/maps/jKNEDz4SyyH2">Get Directions</a>',
    		lat: 41.976816,
    		long: -87.659916
    	};
    
    	var belmont = {
    		info: '<strong>Chipotle on Belmont</strong><br>\
    					1025 W Belmont Ave<br> Chicago, IL 60657<br>\
    					<a href="https://goo.gl/maps/PHfsWTvgKa92">Get Directions</a>',
    		lat: 41.939670,
    		long: -87.655167
    	};
    
    	var sheridan = {
    		info: '<strong>Chipotle on Sheridan</strong><br>\r\
    					6600 N Sheridan Rd<br> Chicago, IL 60626<br>\
    					<a href="https://goo.gl/maps/QGUrqZPsYp92">Get Directions</a>',
    		lat: 42.002707,
    		long: -87.661236
    	};
    
    	var locations2 = [
          [broadway.info, broadway.lat, broadway.long, 0],
          [belmont.info, belmont.lat, belmont.long, 1],
          [sheridan.info, sheridan.lat, sheridan.long, 2],
        ];
           initMap(locations2);*/
        });
        $("#maprightside_close").click(function(){
           $("#maprightside").css('transform', 'translateX(100%)'); 
        });
        initMap(locations);
    });
    function initMap(locations) {
	
    	/*var broadway = {
    		info: '<strong>Chipotle on Broadway</strong><br>\
    					5224 N Broadway St<br> Chicago, IL 60640<br>\
    					<a href="https://goo.gl/maps/jKNEDz4SyyH2">Get Directions</a>',
    		lat: 41.976816,
    		long: -87.659916
    	};
    
    	var belmont = {
    		info: '<strong>Chipotle on Belmont</strong><br>\
    					1025 W Belmont Ave<br> Chicago, IL 60657<br>\
    					<a href="https://goo.gl/maps/PHfsWTvgKa92">Get Directions</a>',
    		lat: 41.939670,
    		long: -87.655167
    	};
    
    	var sheridan = {
    		info: '<strong>Chipotle on Sheridan</strong><br>\r\
    					6600 N Sheridan Rd<br> Chicago, IL 60626<br>\
    					<a href="https://goo.gl/maps/QGUrqZPsYp92">Get Directions</a>',
    		lat: 42.002707,
    		long: -87.661236
    	};
    
    	var locations = [
          [broadway.info, broadway.lat, broadway.long, 0],
          [belmont.info, belmont.lat, belmont.long, 1],
          [sheridan.info, sheridan.lat, sheridan.long, 2],
        ];*/
        var c_lt = 51.1657;
        var c_ln = 10.4515;
        if(locations.length > 0){
            c_lt = locations[0][1];
            c_ln = locations[0][2];
        }
    	var map = new google.maps.Map(document.getElementById('map'), {
    		zoom: 13,
    		center: new google.maps.LatLng(c_lt, c_ln),
    		mapTypeId: google.maps.MapTypeId.ROADMAP
    	});
    
    	var infowindow = new google.maps.InfoWindow({});
    
    	var marker, i;
    
    	for (i = 0; i < locations.length; i++) {
    		marker = new google.maps.Marker({
    			position: new google.maps.LatLng(locations[i][1], locations[i][2]),
    			map: map,
                id: locations[i][3]
    		});
    
    		google.maps.event.addListener(marker, 'click', (function (marker, i) {
    			return function () {
    			     console.log(marker.get('id'));
                    $rid = marker.get('id');
    				infowindow.setContent(locations[i][0]);
    				infowindow.open(map, marker);
                    getprop($rid);
                    //$("#maprightside").css('right', '250px');
                    $("#maprightside").css('transform', 'translateX(0)');
    			}
    		})(marker, i));
    	}
    }
    function geocodeAddress(geocoder, address) { console.log(address);
        var address = address;
        var ret = [];
        geocoder.geocode({'address': address}, function(results, status) {
            
          if (status === 'OK') {
            console.log(results[0].geometry.location.lng());
            ret["lat"] = results[0].geometry.location.lat();
            ret["lng"] = results[0].geometry.location.lng();
          } 
        });
        return ret;
    }
    function getprop(id){
        $.ajax({
            url:"{{URL::to('traveller/getMapReservation')}}",
            type:'GET',
            dataType:'json',
            data:{id:id},
            beforeSend: function() {
                // setting a timeout
                $("#dv_reservation").html('<div class="m-loader m-loader--lg"></div>');
            },
            success:function(response){
                var _html = '';
                var _img = response.category_image.imgsrc+'/'+response.category_image.file_name;
                var _ct = response.checkin_date;
                var url = _base_url+'/traveller/bookings/show/'+response.id;
                
                /*_html += '<div class="m-widget28__tab-items">';                                        
        								_html += '<div class="m-widget28__tab-item"><span>Hotel Name</span><span>'+response.props.property_name+'/'+response.category.category_name+'</span></div>';
        								_html += '<div class="m-widget28__tab-item"><span>Booking Confirmation Number</span><span>DL-'+response.created_date+response.id+'</span></div>';
        								_html += '<div class="m-widget28__tab-item"><span>Total Charges</span><span></span></div>';
                                        _html += '<div class="m-widget28__tab-item"><span>Hotel Terms</span><span><a href="#" data-toggle="modal" data-target="#hotel_term_popup"> Show hotel terms</a></span>';
                                        _html += '<a href="" id="show_more">View Reservation</a>';
                                        _html += '</div>';
        							_html += '</div>';
                */
                _html += "<div class='col-sm-12 col-md-12'><img src='"+_img+"' style='width:100%; height: 200px;' /></div><div class='col-sm-12 col-md-12 m--margin-top-10'><h6>"+ response.props.property_name+" / "+response.category.category_name +"</h6></div><div class='col-sm-12 col-md-12 m--margin-top-10 m--margin-bottom-10'>Price: <b>"+response.category.price+"</b></div><div class='col-sm-12 col-md-12 m--margin-top-10 m--margin-bottom-10'>Check In: <b>"+response.checkin_date+"</b></div><div class='col-sm-12 col-md-12 m--margin-top-10 m--margin-bottom-10'>Check Out: <b>"+response.checkout_date+"</b></div><div class='col-sm-12 col-md-12'><p>"+response.category.room_desc+"</p></div><div class='col-sm-12 col-md-12 m--align-right'><a class='btn btn-primary' href='"+url+"' id='vw_reservations'>View Reservatiton</a></div>"; 
                
                $("#dv_reservation").html('');
                $("#dv_reservation").html(_html);
            }
        });
    }
    
    function getFullDetail(_url){
        $.ajax({
            url:_url,
            type:'GET',
            dataType:'json',            
            beforeSend: function() {
                // setting a timeout
                $("#dv_reservation").html('<div class="m-loader m-loader--lg"></div>');
            },
            success:function(response){
                var _html = '';
                if(response.status=="success"){
                    $("#dv_reservation").html('');
                    $("#dv_reservation").html(response.vw_data);
                }
            }
        });
    }
    
    function bot_dates(start_dt){    
        $("#dv_reservation").html('');
        var dtmonth = (start_dt.getMonth()+1);
        var dtdate = (start_dt.getDate());
        var dtyear = (start_dt.getFullYear());
        var d= new Date(start_dt.getFullYear(), start_dt.getMonth()+1, 0);
        
        var daysInCurrentMonth = (d.getDate());
        
        var _days = '';
        var nwdt='';
        for(i=1; i<=daysInCurrentMonth;i++){
            nwdt= dtyear+"-"+dtmonth+"-"+i;
            _days+= '<div class=""><button class="btn btn-mar" data-date="'+nwdt+'">'+i+'</button></div>';
        }
        $("#dv_calendar").html(_days);
    }
    /*function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: {lat: -34.397, lng: 150.644}
        });
        var geocoder = new google.maps.Geocoder();

        //document.getElementById('submit').addEventListener('click', function() {
          geocodeAddress(geocoder, map);
        //});
    }
    function geocodeAddress(geocoder, resultsMap) {
        var address = 'new subash nagar ludhiana, india';
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location
            });
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
    }*/
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqf2xJGZFRECA_eVTNek_Y7sxBzmcgXrs"></script>		
@stop