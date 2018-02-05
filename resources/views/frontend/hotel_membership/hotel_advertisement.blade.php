
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
                    <a type="button" class="btn btn-primary btn-circle cursor" disabled="disabled">1</a>
                    <p>Step 1</p>
                </div>
                <div class="stepwizard-step">
                    <a type="button" class="btn btn-default btn-circle cursor" disabled="disabled">2</a>
                    <p>Step 2</p>
                </div>
                <div class="stepwizard-step">
                    <a  type="button" class="btn btn-default btn-circle cursor" >3</a>
                    <p>Step 3</p>
                </div>
                <div class="stepwizard-step">
                    <a type="button" class="btn btn-default btn-circle cursor" disabled="disabled">4</a>
                    <p>Step 4</p>
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
            <input type="number" name="ads_days" value="1"  disabled="" class="bg-white medium-input"> 
        </div>
        <div class="col-md-6 col-sm-12 ">
            {!! Form::label('ads_package_price', 'Price')  !!}

            <div data-ads-price="list" class=" cart-total-amout"> {!! isset($currency->content)?$currency->content:'$' !!} <span>0</span></div>
        </div>
    </div>

    <div class="row p-t-50">
        <div class="col-sm-12 text-right">Total : {!! isset($currency->content)?$currency->content:'$' !!}</div>
        <div class="col-sm-12 text-right">
            <button class="customGoldBtn btn nextBtn cursor" data-ads-action="addToCartAdvert">Add To Cart & Continue  </button> <a class="customGoldBtn btn nextBtn" href="{{url('hotel/cart')}}">Continue  </a>
        </div>
    </div>
</div>


<script>


function changeprice(type){
    if(type!='')
    {
        $('#CPC').hide();
        $('#CPD').hide();
        $('#CPM').hide();
        $('#'+type).show();
        var prc = $.trim($('#' + type + ' .price').text());
        $('#pacprice').val(prc);
        var qty = $('#qtypac').val();
        $('#fnlprc .fprice').html((prc * qty).toFixed(2));
        $('#finalpacprice').val((prc * qty).toFixed(2));
    }
}

$(document).ready(function () {
    
    $(document).on('change', '#ads_pacakge_type', function () {
        /*var qty = $(this).val();
        var prc = $.trim($('#pacprice').val());
        $('#fnlprc .fprice').html((prc * qty).toFixed(2));
        $('#finalpacprice').val((prc * qty).toFixed(2));*/
        if($(this).val()=='cpd'){
            $('[data-ads-days="box"]').show();
            $('input[name="ads_days"]').prop('disabled', false);
        }else{
            $('[data-ads-days="box"]').hide();
            $('input[name="ads_days"]').prop('disabled', true);
        }
    }); 

    $(document).on('change', 'input[name="ads_days"]', function () {
        /*var qty = $(this).val();
        var prc = $.trim($('#pacprice').val());
        $('#fnlprc .fprice').html((prc * qty).toFixed(2));
        $('#finalpacprice').val((prc * qty).toFixed(2));*/

        alert($(this).val());
    }); 
   

    $(document).on('click','[data-ads-action="addToCartAdvert"]',function(){

        addToCartAdvert();
    });

    
    //For set Defualt Start Date 
    document.getElementById("ads_start_date").valueAsDate = new Date(<?php echo date("Y, n - 1, d, H, i, s"); ?>);


});



    function addToCartAdvert(){
        $.ajax({
            url: "{{ url('hotel/add_package_to_cart')}}",
            type: "post",
            data: {
                'cart[package][id]' : 100,
                'cart[package][price]':0, 
                'cart[package][content][ads_category_id]': $('input[name="ads_category_id"]').val(),
                'cart[package][content][ads_position]': $('input[name="ads_position"]').val(),
                'cart[package][content][ads_pacakge_type]': $('input[name="ads_pacakge_type"]').val(),
                'cart[package][content][ads_start_date]': $('input[name="ads_start_date"]').val(),
                'cart[package][content][ads_package_price]': $('input[name="ads_package_price"]').val(),
                'cart[package][content][ads_package_total_price]':$('input[name="ads_package_total_price"]').val(),
                'cart[package][content][ads_days]': $('input[name="ads_days"]').val(),
                'cart[package][type]':'advert'
            },
            dataType: "json",
            success: function (data) {
                
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


