
@extends('frontend.layouts.ev.customer')
@section('content')
<style type="text/css">
    
.hotel-book-now {
                background: #ABA07C;
                color: #fff;
                font-size: 25px;
                height: 71px;
                margin: 0px 0px 10px 3px;
                opacity: 1;
                overflow-wrap: break-word;
                padding: 27px 5px;
                position: absolute;
                text-align: center;
                text-transform: uppercase;
                width: 174px;
                z-index: 99;
                float: left;
            }
	.disnon { display:none; }

</style>
<section class="wow fadeIn big-section cstmaiclass" id="align-to-top">
    <div class="container-fluid">
        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                    <a type="button" class="btn btn-primary btn-circle cursor">1</a>
                    <p>Step 1</p>
                </div>
                <div class="stepwizard-step">
                    <a type="button" class="btn btn-default btn-circle cursor" disabled="disabled">2</a>
                    <p>Step 2</p>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Advertisements Package</h5>
    <div class="cart-big-border">
        <div class="cart-small-border"></div>
    </div>
    <div class="row p-t-50">
        <div class="col-md-6 col-sm-12 ">
            <input type="hidden" name="ads_pkg_id"> 
            {!! Form::label('ads_category_id', 'Choose Advertise Category')  !!}
            {!! Form::select('ads_category_id', $category_list, null,['class' => 'bg-white medium-input'])  !!}
        </div>
        <div class="col-md-6 col-sm-12 ">
            {!! Form::label('ads_position', 'Choose Ads Position')  !!}
            {!! Form::select('ads_position', $ads_position_list, null,['class' => 'bg-white medium-input'])  !!}
        </div>
        <div class="col-md-6 col-sm-12 ">
            {!! Form::label('ads_pacakge_type', 'Choose Package Type')  !!}
            {!! Form::select('ads_pacakge_type', $ads_pacakge_type, null,['class' => 'bg-white medium-input'])  !!}
        </div>
        <div class="col-md-6 col-sm-12 ">
            {!! Form::label('ads_start_date', 'Start Date')  !!}
            <input type="date" name="ads_start_date" id="ads_start_date" class="bg-white medium-input"> 
        </div>
        
        <div class="col-md-6 col-sm-12 " data-ads-days="box" style="display: none;">
            {!! Form::label('ads_days', 'Choose Days')  !!}
            <input type="text" name="ads_days" value="1"   disabled="" class="bg-white medium-input">
             <input type="hidden" data-ads-days="per-unit"> 
        </div>
        <div class="col-md-6 col-sm-12 ">
            {!! Form::label('ads_package_price', 'Price')  !!}
            <input type="hidden" data-ads-price="per-unit">
            <div data-ads-price="list"> {!! isset($currency->content)?$currency->content:'$' !!} <span>0</span></div>
        </div>
    </div>

    <div class="row p-t-50">
        <div class="col-sm-12 text-right ads-total-price p-b-50" data-ads-price="total-list">Total : {!! isset($currency->content)?$currency->content:'$' !!} <span>0</span></div>
        <div class="col-sm-12 text-right">
            <input type="hidden" data-ads_package_total_price="list-unit">
            <button class="customGoldBtn btn nextBtn cursor" disabled="" data-ads-action="addToCartAdvert">Add To Cart & Continue  </button> <a class="customGoldBtn btn nextBtn" href="{{url('advertiser/cart')}}">Continue  </a>
        </div>
        
       
    </div>
</div>


<script>


function changePrice(){

    if($('#ads_category_id').val()!='' && $('#ads_position').val()!='' && $('#ads_pacakge_type').val()!=''){
        $.ajax({
                url: "{{ url('advertiser/getAdvertPrice')}}",
                type: "post",
                data: {
                    'category_id' : $('select[name="ads_category_id"]').val(),
                    'ads_position': $('select[name="ads_position"]').val()
                },
                dataType: "json",
                success: function (data) {
                    $('input[name="ads_pkg_id"]').val(data.id);
                    $('input[name="ads_days"]').val(1);
                    $('[data-ads-days="per-unit"]').val(1);
                    var price = 0;
                    if($('#ads_pacakge_type').val()=='cpc' && data.space_cpc_price>0){
                        price = data.space_cpc_price;
                    }
                    if($('#ads_pacakge_type').val()=='cpm' && data.space_cpm_price>0){
                        price = data.space_cpm_price;
                    }
                    if($('#ads_pacakge_type').val()=='cpd' && data.space_cpd_price>0){
                        price = data.space_cpd_price;
						$('input[name="ads_days"]').val(data.space_cpm_num_days);
                        $('[data-ads-days="per-unit"]').val(data.space_cpm_num_days);
                    }
                    $('[data-ads-price="list"] span').html((price).toFixed(2));
                    $('[data-ads-price="total-list"] span').html((price).toFixed(2));
                    $('[data-ads-price="per-unit"]').val(price);

                    $('[data-ads-action="addToCartAdvert"]').prop('disabled', false);
                    
                }
            });
    }

}

$(document).ready(function () {
    
    $(document).on('change', '#ads_pacakge_type', function () {
        if($(this).val()=='cpd'){
            $('[data-ads-days="box"]').show();
            $('input[name="ads_days"]').prop('disabled', false);
        }else{
            $('[data-ads-days="box"]').hide();
            $('input[name="ads_days"]').prop('disabled', true);
        }
        changePrice();
    }); 

     $(document).on('change', '#ads_category_id, #ads_position', function () {
        changePrice();
    });  

    $(document).on('keyup', 'input[name="ads_days"]', function () {


        var days = $(this).val();
        if(days<=0){
            if($('[data-ads-days="per-unit"]').val()>0){
                $(this).val($('[data-ads-days="per-unit"]').val());
            }else{
                 $(this).val(1);
            }
            return false
        }
        var prc = $.trim($('[data-ads-price="per-unit"]').val());
        var perUnit = prc/$.trim($('[data-ads-days="per-unit"]').val());
        var totalPrice = (perUnit * days).toFixed(2);
        $('[data-ads_package_total_price="list-unit"]').val(totalPrice);
        $('[data-ads-price="total-list"] span').html(totalPrice);

        console.log('days '+days + ' prc '+prc+' perUnit '+ perUnit +' totalPrice '+totalPrice);
    }); 
   

    $(document).on('click','[data-ads-action="addToCartAdvert"]',function(){

        addToCartAdvert();
    });

    
    //For set Defualt Start Date 
    document.getElementById("ads_start_date").valueAsDate = new Date(<?php echo date("Y, n - 1, d, H, i, s"); ?>);


});



    function addToCartAdvert(){
        $('[data-ads-action="addToCartAdvert"]').prop('disabled', true);
        $.ajax({
            url: "{{ url('advertiser/add_package_to_cart')}}",
            type: "get",
            data: {
                'cart[package][id]' : 'advert',
                'cart[package][price]':$('[data-ads-price="per-unit"]').val(), 
                'cart[package][content][id]': $('input[name="ads_pkg_id"]').val(),
                'cart[package][content][ads_category_id]': $('select[name="ads_category_id"]').val(),
                'cart[package][content][ads_position]': $('select[name="ads_position"]').val(),
                'cart[package][content][ads_pacakge_type]': $('select[name="ads_pacakge_type"]').val(),
                'cart[package][content][ads_start_date]': $('input[name="ads_start_date"]').val(),
                'cart[package][content][ads_package_price]': $('[data-ads-price="per-unit"]').val(),
                'cart[package][content][ads_package_total_price]':$('[data-ads_package_total_price="list-unit"]').val(),
                'cart[package][content][ads_days]': $('input[name="ads_days"]').val(),
                'cart[package][type]':'advert'
            },
            dataType: "json",
            success: function (data) {
                location.href='{{url("advertiser/cart")}}';
            }
        });
    }

</script>
@endsection


@section('css')

<!-- swiper carousel -->
<link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/swiper.min.css')}}">
<!-- style -->
<link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/style.css')}}" />
<!-- responsive css -->
<link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/responsive.css')}}" />
<!-- Custom style -->
<link href="{{ asset('sximo/assets/memform/css/custom-ai.css')}}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="{{ asset('sximo/css/hotel-membership/style.css')}}">
<style>
.has-error  {
    border-color: #a94442;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
}

.cart-small-border {
      height: 2px;
    width: 200px;
    background: #ABA07C;
    margin-top: -2px;
    z-index: 0;
}
.cart-big-border {
  
    width: 100%;
    background: #eaeaea;
    /* margin-top: -5px; */
    height: 2px;
    z-index: 9999;
}
.customGoldBtn {
    background-color: #ABA07C;
    border: none;
    color: #fff;
    text-transform: uppercase;
    font-weight: bold;
    font-family: Geomanist-Regular;
}
.customGoldBtn .btn i { margin-left: 0;}
.p-t-50{padding-top: 50px;}
.p-b-50{padding-bottom: 50px;}
.ads-total-price{ font-size: 20px; }
</style>
@endsection

@section('script')

<script type="text/javascript" src="{{ asset('sximo/assets/memform/js/smooth-scroll.js')}}"></script>
        <!-- animation -->
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/wow.min.js')}}"></script>
        <!-- swiper carousel -->
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/swiper.min.js')}}"></script>

        <!-- images loaded -->
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/imagesloaded.pkgd.min.js')}}"></script>
@endsection


