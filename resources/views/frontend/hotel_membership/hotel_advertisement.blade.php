@extends('frontend.themes.emporium.layouts.home')
{{--  For Title --}}
@section('title', $pageTitle)
{{-- For Meta Keywords --}}
@section('meta_keywords', $pageMetakey)
{{-- For Meta Description --}}
@section('meta_description', $pageMetadesc)
{{-- For Page's Content Part --}}
@section('content')
<!-- End Slider form section -->

<section style="background-color:#f7f7f7;">
    <div class="container-fluid">
       <div class="row">
        <div class="col-xs-3">
            <div class="stepNumber ">
                <span>1</span>
                <p>STEP 1</p>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="stepNumber">
                <span>2</span>
                <p>STEP 2</p>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="stepNumber active">
                <span>3</span>
                <p>STEP 3</p>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="stepNumber">
                <span>4</span>
                <p>STEP 4</p>
            </div>
        </div>
    </div>

</div>
</section>
<section id="membershpipStepSec" class="membershpipStepSec">
    <div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
               <div class="hotelInfoSection">
                    <form>
                        <div class="row">
                        <h1>Advertisements Package</h1>
                            <div class="col-md-6 col-sm-12 no-padding-left">
                                <div class="form-group">
                                    
                                    <input type="hidden" name="ads_pkg_id"> 
                                    {!! Form::label('ads_category_id', '*Choose Advertise Category')  !!}
                                    {!! Form::select('ads_category_id', $category_list, null,['class' => 'form-control'])  !!}
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 no-padding-right">
                                <div class="form-group">
                                    <label>*Choose Ads Position</label>
                                    {!! Form::label('ads_position', 'Choose Ads Position')  !!}
                                    {!! Form::select('ads_position', $ads_position_list, null,['class' => 'form-control'])  !!}
                                                        
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 no-padding-left">
                                <div class="form-group">
                                   {!! Form::label('ads_pacakge_type', 'Choose Package Type')  !!}
                                 {!! Form::select('ads_pacakge_type', $ads_pacakge_type, null,['class' => 'form-control'])  !!}
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 no-padding-right">
                                <div class="form-group">
                                    {!! Form::label('ads_start_date', '*Start Date')  !!}
                                <div class="input-group date" data-provide="datepicker">
                                <input type="text" name="ads_start_date" id="ads_start_date" class="form-control"> 
                               
                                <div class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </div>
                            </div>
                                </div>
                            </div> 

                            <div class="col-md-6 col-sm-12 no-padding" style="display: none;">
                                <div class="form-group">
                                    <div class="form-group">
                                    <label>*Hotel Opening Date</label>
                                    <div class="input-group date" data-provide="datepicker">
                                <input type="text" class="form-control" id="data-date">
                                <div class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </div>
                            </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 no-padding-left">
                                <div class="form-group" data-ads-days="box" style="display: none;">
                                   

                                    {!! Form::label('ads_days', 'Choose Days')  !!}
                                    <input type="text" name="ads_days" value="1"   disabled="" class="form-control">
                                     <input type="hidden" data-ads-days="per-unit"> 
                                    
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 no-padding-left">
                                <div class="form-group text-right">

                                    <label>{!! Form::label('ads_package_price', 'Price')  !!}
                                    <input type="hidden" data-ads-price="per-unit">
                            <div data-ads-price="list"> {!! isset($currency->content)?$currency->content:'$' !!} <span>0</span></label></div>
     
                                    
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 no-padding-left">
                                <div class="form-group">

                                     <div class="pull-right ads-total-price p-b-50" data-ads-price="total-list">
                                        <label>Total : {!! isset($currency->content)?$currency->content:'$' !!} <span>0</span></label>
                                     </div>
                                    <input type="hidden" data-ads_package_total_price="list-unit">

                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 no-padding-left">
                            <div class="packagePriceSec">

                                <a href="{{url('hotel/cart')}}" class="btn btn-cstmBtn pull-right">Continue</a>
                                <button class="btn btn-cstmBtn pull-right" disabled="" data-ads-action="addToCartAdvert">Add To Cart & Continue  </button>
                            </div>
                                
                            </div>
                            </div>
                    </form>
                </div>
         </div>
    </div>  
    </div>

     

 </section> 
@endsection

{{--For Right Side Icons --}}
@section('right_side_iconbar')

    @parent
@show

{{-- For Include Top Bar --}}
@section('top_search_bar')
    @parent
@endsection

{{-- For Include Side Bar --}}
@section('sidebar')
    @include('frontend.themes.emporium.layouts.sections.common_sidebar')
@endsection

{{-- For Include style files --}}
@section('head')
    @parent
    <link href="{{ asset('themes/emporium/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/emporium/css/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/emporium/css/calendar.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/emporium/css/terms-and-conditions.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/emporium/css/membership-css.css') }}" rel="stylesheet">
     
@endsection

{{-- For custom style  --}}
@section('custom_css')

    @parent
<style>

.disnon { display:none; }


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

.has-error  {
    border-color: #a94442;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
}
.parsley-required{

    padding: 5px;
    margin-top: 5px;
    margin-bottom: 5px;
    border: 1px solid transparent;
    border-radius: 2px;
    color: #a94442;
    background-color: #f2dede;
    border-color: #ebccd1;

}
</style>
@endsection

{{-- For Include javascript files --}}
@section('javascript')
    @parent
    <script src="{{ asset('themes/emporium/js/smooth-scroll.js') }}"></script>
    <script src="{{ asset('sximo/js/parsley.min.js')}}" type="text/javascript"></script>

@endsection

{{-- For custom script --}}
@section('custom_js')
    @parent
<script>
       function changePrice(){

    if($('#ads_category_id').val()!='' && $('#ads_position').val()!='' && $('#ads_pacakge_type').val()!=''){
        $.ajax({
                url: "{{ url('hotel/getAdvertPrice')}}",
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
        url: "{{ url('hotel/add_package_to_cart')}}",
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
            location.href='{{url("hotel/cart")}}';
        }
    });
}
    </script>    
@endsection

{{-- For footer --}}
@section('footer')
    @parent
@endsection